

import { Card, Form, Icon, Input,InputNumber,Button, Checkbox,DatePicker,Col,Row,Tabs,Radio  } from 'antd';

import EditBasic from './good/editBasic.jsx'; 
import EditSort from './good/editSort.jsx'; 

import Ueditor from './good/ueditor.jsx';



const FormItem = Form.Item;

const TabPane = Tabs.TabPane;

const RadioButton = Radio.Button;
const RadioGroup = Radio.Group;

export default class AddGood extends React.Component{
  constructor(props) {
    super(props);
    this.handleSearch = this.handleSearch.bind(this);
    this.switchTab = this.switchTab.bind(this);
  }
  handleSearch() {
    
  }
  switchTab() {

  }

  render() {

    const formData = {
      content: 'aa'
    };

    return (
      <Card title="添加商品">
        <Tabs defaultActiveKey="basic">
          <TabPane tab="基本信息" key="basic">
            <EditBasic finish={this.switchTab}/>
          </TabPane>
          <TabPane tab="商品描述" key="description">
            <Ueditor value={formData.content} id="content" height="800" /> 
            <div><Button type="primary" htmlType="submit" size="large">提交</Button></div>
          </TabPane>
          <TabPane tab="设置分类" key="sorts">
            
          </TabPane>
        </Tabs>
      </Card>
     )
  }
}

//AddGood = Form.create({})(AddGood);<EditSort />
