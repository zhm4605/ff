import React from 'react';
import ReactDOM from 'react-dom';

import { Table,Switch,Button } from 'antd';

const { Column, ColumnGroup } = Table;

let data = [];
$.ajax({
        url:"/good/good_list",
        dataType:"json",
        async: false,
        success:function(msg)
        {
          console.log(msg);
          data = msg;
        },
        error:function(msg){
          console.log(msg);
          document.body.innerHTML = msg.responseText;
        }
      })

export default class GoodList extends React.Component{
  constructor(props) {
    super(props);
    this.state = {
      filteredInfo: null,
      sortedInfo: null,
    };
    this.handleChange = this.handleChange.bind(this);
    this.clearFilters = this.clearFilters.bind(this);
    this.clearAll = this.clearAll.bind(this);
    this.setAgeSort = this.setAgeSort.bind(this);
  }
  handleChange(pagination, filters, sorter) {
    console.log('Various parameters', pagination, filters, sorter);
    this.setState({
      filteredInfo: filters,
      sortedInfo: sorter,
    });
  }
  clearFilters(e) {
    e.preventDefault();
    this.setState({ filteredInfo: null });
  }
  clearAll(e) {
    e.preventDefault();
    this.setState({
      filteredInfo: null,
      sortedInfo: null,
    });
  }
  setAgeSort(e) {
    e.preventDefault();
    this.setState({
      sortedInfo: {
        order: 'descend',
        columnKey: 'age',
      },
    });
  }
  render() {
    let { sortedInfo, filteredInfo } = this.state;
    sortedInfo = sortedInfo || {};
    filteredInfo = filteredInfo || {};

    return (
      <div>
        <div className="table-operations">
          <a href="#" onClick={this.setAgeSort}>Age descending order</a>
          <a href="#" onClick={this.clearFilters}>清除筛选</a>
          <a href="#" onClick={this.clearAll}>清除筛选和排序</a>
          <Button type="primary">添加商品</Button>
        </div>
        <Table dataSource={data} onChange={this.handleChange}>
          <Column title="名称" dataIndex="name" key="name" />
          <Column width='20%' title="分类" dataIndex="sorts" key="sorts" />
          <Column title="价格（元）" key="price" render={(text, record) => (
              <span>￥{record.priceMin} ~ ￥{record.priceMax}</span>
            )}/>
          <Column title="上架时间" dataIndex="putawayTime" key="putawayTime" />
          <Column title="库存" dataIndex="remain" key="remain" />
          <Column title="锁定" key="lock" render={(text, record) => (
              <Switch defaultChecked={record.lock?true:false}/>
            )}/>
          <Column title="操作" key="excute" render={(text, record) => (
                <div>
                  <Button>删除</Button>
                  <Button type="ghost"><a href='#addGood/1'>修改</a></Button>
                </div>
            )}/>
        </Table>
      </div>
    );
  }
};

//ReactDOM.render(<Sider />, document.getElementById('container'));
