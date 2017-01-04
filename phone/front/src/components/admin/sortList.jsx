
import ReactDOM from 'react-dom';

import { Tree, Input, Button, Modal } from 'antd';

import AddSort from './addSort.jsx';

const TreeNode = Tree.TreeNode;
const Search = Input.Search;

const x = 3;
const y = 2;
const z = 1;

/*
const gData = [
  {
    key:'aa',
    title:'12',
    children:[
      {
        key:'0-1',
        title:'0-1',
      },
      {
        key:'0-2',
        title:'0-2',
      }
    ]
  },
  {
    key:'bb',
    title:'12',
    children:[
      {
        key:'22',
        title:'0-1',
      },
      {
        key:'0-2',
        title:'0-2',
      }
    ]
  }
];
*/

let gData = [];
let dataList = [];
const generateList = (data) => {
  for (let i = 0; i < data.length; i++) {
    const node = data[i];
    const key = node.key;
    const title = node.title;
    dataList.push({ key, title});
    if (node.children) {
      generateList(node.children, node.key);
    }
  }
};


const getParentKey = (key, tree) => {
  let parentKey;
  for (let i = 0; i < tree.length; i++) {
    const node = tree[i];
    if (node.children) {
      if (node.children.some(item => item.key === key)) {
        parentKey = node.key;
      } else if (getParentKey(key, node.children)) {
        parentKey = getParentKey(key, node.children);
      }
    }
  }
  return parentKey;
};


export default class SortList extends React.Component {
  constructor(props) {
    super(props);
    let that = this;
    that.state = {
        gData,
        expandedKeys: ['aa','bb'],
        searchValue: '',
        autoExpandParent: true,
        visible: false
      };

    fetch("/admin_sort/sortList").then(function(response) {
      return response.json();
    }).then(function(data) {
      console.log(data);
      
      gData = data;
      that.setState({
        gData,
        expandedKeys: ['aa','bb'],
        searchValue: '白色',
        autoExpandParent: true,
        visible: false
      });
      generateList(gData);
    }).catch(function(e) {
      console.log(e);
    });

    this.onExpand = this.onExpand.bind(this);
    this.onChange = this.onChange.bind(this);
    this.onDragEnter = this.onDragEnter.bind(this);
    this.onDrop = this.onDrop.bind(this);
    this.openModal = this.openModal.bind(this);
  }
  onExpand(expandedKeys){
    this.setState({
      expandedKeys,
      autoExpandParent: false,
    });
  }
  onChange(e){

    const value = e.target.value;
    const expandedKeys = [];
    dataList.forEach((item) => {
      if (item.title.indexOf(value) > -1) {
        expandedKeys.push(getParentKey(item.key, gData));
      }
    });
    const uniqueExpandedKeys = [];
    expandedKeys.forEach((item) => {
      if (item && uniqueExpandedKeys.indexOf(item) === -1) {
        uniqueExpandedKeys.push(item);
      }
    });
    this.setState({
      expandedKeys: uniqueExpandedKeys,
      searchValue: value,
      autoExpandParent: true,
    });
  }
  onDragEnter(info) {
    //console.log(info);
    // expandedKeys 需要受控时设置
    // this.setState({
    //   expandedKeys: info.expandedKeys,
    // });
  }
  onDrop(info) {
    console.log(info);
    const dropKey = info.node.props.eventKey;
    const dragKey = info.dragNode.props.eventKey;
    // const dragNodesKeys = info.dragNodesKeys;
    const loop = (data, key, callback) => {
      data.forEach((item, index, arr) => {
        if (item.key === key) {
          return callback(item, index, arr);
        }
        if (item.children) {
          return loop(item.children, key, callback);
        }
      });
    };
    const data = [...this.state.gData];
    let dragObj;
    loop(data, dragKey, (item, index, arr) => {
      arr.splice(index, 1);
      dragObj = item;
    });
    if (info.dropToGap) {
      let ar;
      let i;
      loop(data, dropKey, (item, index, arr) => {
        ar = arr;
        i = index;
      });
      ar.splice(i, 0, dragObj);
    } else {
      loop(data, dropKey, (item) => {
        item.children = item.children || [];
        // where to insert 示例添加到尾部，可以是随意位置
        item.children.push(dragObj);
      });
    }
    this.setState({
      gData: data,
    });
  }
  openModal(){
    this.setState({visible:true});
  }
  render() {
    const { searchValue, expandedKeys, autoExpandParent } = this.state;
    const loop = data => data.map((item) => {
      const index = item.title.search(searchValue);
      const beforeStr = item.title.substr(0, index);
      const afterStr = item.title.substr(index + searchValue.length);
      const title = index > -1 ? (
        <span>
          {beforeStr}
          <span className="ant-tree-searchable-filter">{searchValue}</span>
          {afterStr}
        </span>
      ) : <span>{item.title}</span>;

      const line = <div>{title}<span>编辑</span></div>

      if (item.children) {
        return (
          <TreeNode key={item.key} title={line}>
            {loop(item.children)}
          </TreeNode>
        );
      }

      return <TreeNode key={item.key} title={line} />;
    });
    return (
      <div>
        <Search
          style={{ width: 200,display:'inline-block' }}
          placeholder="Search"
          onChange={this.onChange}
        />
       <AddSort />
        <Tree
          onExpand={this.onExpand}
          expandedKeys={expandedKeys}
          autoExpandParent={autoExpandParent}
          draggable
          onDragEnter={this.onDragEnter}
          onDrop={this.onDrop}
        >
          {loop(this.state.gData)}
        </Tree>

      </div>
    );
  }
}





