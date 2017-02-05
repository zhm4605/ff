

import { Card,Tabs } from 'antd';

import EditBasic from './good/editBasic.jsx';
import EditDescription from './good/editDescription.jsx'; 
import EditSort from './good/editSort.jsx'; 

const TabPane = Tabs.TabPane;

export default class AddGood extends React.Component{
  constructor(props) {
    super(props);
    console.log(props.params);
    let that = this;
    this.data = {};
    if(props.params.hasOwnProperty('id'))
    {
      $.ajax({
        url:"/good/good_details/"+props.params.id,
        dataType:"json",
        async: false,
        success:function(msg)
        {
          //console.log(msg);
          //data = msg;
          that.data = msg;
        },
        error:function(msg){
          console.log(msg);
          document.body.innerHTML = msg.responseText;
        }
      })
    }
    

    this.handleSearch = this.handleSearch.bind(this);
    this.switchTab = this.switchTab.bind(this);
  }
  handleSearch() {
    
  }
  switchTab(activeKey) {
    this.setState({activeKey})
  }

  render() {
    const data = this.data;
    const goodId = this.props.params.hasOwnProperty('id')?this.props.params.id:'';
    const formData = {
      content: 'aa'
    };

    return (
      <Card title="添加商品">
        <Tabs defaultActiveKey="sorts">
          <TabPane tab="基本信息" key="basic">
            <EditBasic finish={()=>{this.switchTab("description")}} data={data} goodId={goodId}/>
          </TabPane>
          <TabPane tab="商品描述" key="description">
            <EditDescription finish={()=>{this.switchTab("sorts")}} description={data.description} goodId={goodId}/>
          </TabPane>
          <TabPane tab="设置分类" key="sorts">
            <EditSort finish={()=>{window.location.hash = '#/good'}} goodId={goodId} data={data}/>
          </TabPane>
        </Tabs>
      </Card>
     )
  }
}

//AddGood = Form.create({})(AddGood);<EditSort />
