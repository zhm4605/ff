import { Tag, Input, Tooltip, Button, Table } from 'antd';

const { Column, ColumnGroup } = Table;

import SearchSort from '../sort/searchSort.jsx';

function removeRepeat(msg,children)
{
  let no_repeat = true;
  const msg1 = msg.filter((item) => {
    no_repeat = true;
    children.forEach(function(child){
      if(item.id===child.id)
      {
        no_repeat = false;
        return false;
      }
    })
    return no_repeat;
  });
  return msg1;
}

export default class EditSortChild extends React.Component {
  constructor(props) {
    super(props);
    const that = this;
    $.ajax({
      url:"/admin_sort/sortList/true/"+props.id,
      dataType:"json",
      async: false,
      success:function(msg)
      {
        that.msg = msg;
        that.state = {
          children: props.children||[],
          inputVisible: false,
          inputValue: '',
        };
      },
      error:function(msg){
        document.body.innerHTML = msg.responseText;
      }
    })

    this.handleClose = this.handleClose.bind(this);
    this.showInput = this.showInput.bind(this);
    this.handleInputConfirm = this.handleInputConfirm.bind(this);
  }
  handleClose(removeId){
    const children = this.state.children.filter(tag => tag.id !== removeId);
    this.setState({ children });

    const onChanged = this.props.onChanged;
    if(onChanged)
    {
      onChanged(this.props.index,children);
    }
  }

  showInput(){
    this.setState({ inputVisible: true });
  }

  handleInputConfirm(value,label){
    const state = this.state;

    let children = state.children;
    const target = label[label.length-1];

    children = [...children,target];
    this.setState({
      children,
      inputVisible: false,
      inputValue: ''
    });

    const onChanged = this.props.onChanged;
    if(onChanged)
    {
      onChanged(this.props.index,children);
    } 
  }

  render() {
    const { children, inputVisible, inputValue} = this.state;
    const selectList = removeRepeat(this.msg,children);

    return (
      <div>
        {children.map((tag, index) => {
          const isLongTag = tag.name.length > 20;
          const tagElem = (
            <Tag key={tag.id} closable afterClose={() => this.handleClose(tag.id)}>
              {isLongTag ? `${tag.name.slice(0, 20)}...` : tag.name}
            </Tag>
          );
          return isLongTag ? <Tooltip title={tag.name}>{tagElem}</Tooltip> : tagElem;
        })}
        {inputVisible && selectList.length>0 && (
          <SearchSort list={selectList} placeholder={"添加"+this.props.name||'分类'} style={{width:111,textAlign:'left'}} onChoosed={this.handleInputConfirm}/>
        )}
        {!inputVisible && selectList.length>0 && <Button size="small" type="dashed" onClick={this.showInput}>{"添加"+this.props.name}</Button>}
      </div>
    );
  }
}
