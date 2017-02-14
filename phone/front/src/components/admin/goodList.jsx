import React from 'react';
import ReactDOM from 'react-dom';

import { Table,Switch,Button,message } from 'antd';

const { Column, ColumnGroup } = Table;

//let data = [];

export default class GoodList extends React.Component{
  constructor(props) {
    super(props);
    const that = this;
    $.ajax({
      url:"/good/goodList",
      dataType:"json",
      async: false,
      success:function(msg)
      {
        console.log(msg);
        that.state = {
          data:msg,
        }
      },
      error:function(msg){
        document.body.innerHTML = msg.responseText;
      }
    })

    this.handleChange = this.handleChange.bind(this);
    this.removeGood = this.removeGood.bind(this);
  }
  handleChange()
  {

  }
  //锁定、解锁
  changeLock(checked,id)
  {
    const text = checked?'锁定':'解锁';
    $.ajax({
      url:"/admin_good/editGood/"+id,
      dataType:"json",
      type:"post",
      data:{lock:checked?1:0},
      success:function(msg)
      {
        if(msg.id)
        {
          message.success(text+'成功');
        }
      },
      error:function(msg){
        document.body.innerHTML = msg.responseText;
      }
    })

  }
  //删除
  removeGood(index)
  {
    const data = [...this.state.data];
    const that = this;
    $.ajax({
      url:"/admin_good/removeGood/"+data[index].id,
      dataType:"json",
      type:"post",
      success:function(msg)
      {
        if(msg.state)
        {
          message.success(msg.info);
          data.splice(index, 1);
          that.setState({ data });
        }
        else
        {
          message.error(msg.info);
        }
      },
      error:function(msg){
        document.body.innerHTML = msg.responseText;
      }
    })

  }
  render() {
    //console.log(this.state);
    const data = [...this.state.data];

    return (
      <div>
        <div className="table-operations">
          <Button type="primary"><a href='#/addGood'>添加商品</a></Button>
        </div>
        <Table dataSource={data} onChange={this.handleChange}>
          <Column title="名称" dataIndex="name" key="name" render={(text, record) => (
            <a href={'/home/#/good/'+record.id} style={{cusor:'pointer'}} target='_blank'>{record.name}</a>
          )}/>
          <Column width='20%' title="分类" dataIndex="sorts" key="sorts" render={(text, record) => (
              text.map((d,i) => 
                <div key={i}>
                   {d.name}：{d.children.map((child,j)=>
                      <span key={j}>{j==0?'':' | '}{child.name}</span>
                    )}
                </div>
              )
            )}/>
          <Column title="价格（元）" dataIndex="price" key="price" render={(text, record) => (
              <span>￥{record.priceMin} ~ ￥{record.priceMax}</span>
            )}/>
          <Column title="上架时间" dataIndex="putawayTime" key="putawayTime" />
          <Column title="库存" dataIndex="remain" key="remain" />
          <Column title="锁定" dataIndex="lock" key="lock" render={(text, record) => (
              <Switch defaultChecked={record.lock==1?true:false} onChange={(checked)=>this.changeLock(checked,record.id)}/>
            )}/>
          <Column title="操作" key="id" render={(id,record,i) => (
                <div>
                  <Button onClick={()=>this.removeGood(i)}>删除</Button>
                  <Button type="ghost"><a href={'#addGood/'+record.id}>编辑</a></Button>
                </div>
            )}/>
        </Table>
      </div>
    );
  }
};

