

import { Card,Tabs,Breadcrumb } from 'antd';

import EditBasic from './good/editBasic.jsx';
import EditDescription from './good/editDescription.jsx'; 
import EditSort from './good/editSort.jsx'; 

const TabPane = Tabs.TabPane;

export default class AddGood extends React.Component{
  constructor(props) {
    super(props);
    this.state = {
      defaultActiveKey: "basic",
      activeKey: "basic"
    };
    let that = this;
    this.data = {};
    if(props.params.hasOwnProperty('id'))
    {
      $.ajax({
        url:"/admin_good/goodDetails/"+props.params.id,
        dataType:"json",
        async: false,
        success:function(msg)
        {
          that.data = msg;
        },
        error:function(msg){
          console.log(msg);
          document.body.innerHTML = msg.responseText;
        }
      })
    }
    
    this.switchTab = this.switchTab.bind(this);
  }

  switchTab(activeKey) {
    this.setState({activeKey})
  }

  render() {
    const data = this.data;
    const goodId = this.props.params.hasOwnProperty('id')?this.props.params.id:0;

    return (
      <Card title={goodId>0?
        <Breadcrumb separator='>'>
          <Breadcrumb.Item><a href="#/goodList">商品列表</a></Breadcrumb.Item>
          <Breadcrumb.Item><a >编辑商品</a></Breadcrumb.Item>
        </Breadcrumb>:"添加商品"}
      >
        <Tabs defaultActiveKey={this.state.defaultActiveKey} activeKey={this.state.activeKey} onTabClick={this.switchTab}>
          <TabPane tab="基本信息" key="basic">
            <EditBasic finish={()=>{this.switchTab("description")}} data={data} goodId={goodId}/>
          </TabPane>
          <TabPane tab="商品描述" key="description" disabled={goodId==0}>
            <EditDescription finish={()=>{this.switchTab("sorts")}} description={data.description} goodId={goodId}/>
          </TabPane>
          <TabPane tab="设置分类" key="sorts" disabled={goodId==0}>
            <EditSort finish={()=>{window.location.hash = '#/good'}} goodId={goodId} data={data}/>
          </TabPane>
        </Tabs>
      </Card>
     )
  }
}

//AddGood = Form.create({})(AddGood);<EditSort />
