

import { Card,Tabs } from 'antd';

import EditBasic from './good/editBasic.jsx';
import EditDescription from './good/editDescription.jsx'; 
import EditSort from './good/editSort.jsx'; 

const TabPane = Tabs.TabPane;

export default class AddGood extends React.Component{
  constructor(props) {
    super(props);
    this.handleSearch = this.handleSearch.bind(this);
    this.switchTab = this.switchTab.bind(this);
  }
  handleSearch() {
    
  }
  switchTab(activeKey) {
    this.setState({activeKey})
  }

  render() {

    const formData = {
      content: 'aa'
    };

    return (
      <Card title="添加商品">
        <Tabs defaultActiveKey="sorts">
          <TabPane tab="基本信息" key="basic">
            <EditBasic finish={()=>{this.switchTab("description")}}/>
          </TabPane>
          <TabPane tab="商品描述" key="description">
            <EditDescription finish={()=>{this.switchTab("sorts")}}/>
          </TabPane>
          <TabPane tab="设置分类" key="sorts">
            <EditSort finish={()=>{window.location.hash = '#/good'}}/>
          </TabPane>
        </Tabs>
      </Card>
     )
  }
}

//AddGood = Form.create({})(AddGood);<EditSort />
