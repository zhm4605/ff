import React from 'react';
import ReactDOM from 'react-dom';

import { Card, Form, Icon, Input,InputNumber,Button, Checkbox,DatePicker,Col,Row,Tabs } from 'antd';

import UploadPic from './uploadPic.jsx';
import Ueditor from './ueditor.jsx';

const FormItem = Form.Item;

const TabPane = Tabs.TabPane;

export default class AddGood extends React.Component{
  constructor(props) {
    super(props);
    this.handleSearch = this.handleSearch.bind(this);
  }
  handleSearch() {
    
  }
  handleSubmit() {

  }

  render() {
    const { getFieldProps, getFieldError,getFieldDecorator } = this.props.form;
    const formItemLayout = {
      labelCol: { span: 2 }
    };
    const formData = {
      content: 'aa'
    };

    return (
      <Card title="添加商品">
        <Tabs defaultActiveKey="description">
          <TabPane tab="基本信息" key="basic">
            <Form horizontal onSubmit={this.handleSubmit}>
              <FormItem
                {...formItemLayout}
                wrapperCol={{ span: 14 }}
                label="商品名称"
              >
                {getFieldDecorator('name', {
                  rules: [{ required: true, message: '请输入商品名称' }],
                })(
                  <Input />
                )}
              </FormItem>
              <FormItem
                {...formItemLayout}
                wrapperCol={{ span: 14 }}
                label="商品价格"
              >
              <Row gutter={20}>
                <Col span={7}>
                  {getFieldDecorator('priceO', {
                    rules: [{ required: true, message: '请输入原价' }],
                  })(
                    <Input type='number' placeholder='请输入原价' addonAfter='元'/>
                  )}
                  
                </Col>
                <Col span={7}>
                  {getFieldDecorator('priceMin', {
                    rules: [{ required: true, message: '请输入现价' }],
                  })(
                    <Input type='number' placeholder='请输入现价' addonAfter='元'/>
                  )}
                </Col>
              </Row>
              </FormItem>
              <FormItem
                {...formItemLayout}
                wrapperCol={{ span: 3 }}
                label="库存"
              >
                {getFieldDecorator('name', {
                  rules: [{required: true, message: '请输入库存'}],
                })(
                  <Input type='number' placeholder='' addonAfter='件'/>
                )}
              </FormItem>
              <FormItem
                {...formItemLayout}
                wrapperCol={{ span: 5 }}
                label="上架时间"
                extra="不填写则在编辑完成后立马上架"
              >
                {getFieldDecorator('putawayTime', {
                  rules: [{ type: 'object'}]
                })(
                  <DatePicker showTime format="YYYY-MM-DD HH:mm:ss"/>
                )}
              </FormItem>
              <FormItem
                {...formItemLayout}
                wrapperCol={{ span: 22 }}
                label="商品图片"
              >
                {getFieldDecorator('pics', {
                  rules: [{ type: 'object'}]
                })(
                  <UploadPic />
                )}
              </FormItem>
              <FormItem 
                 wrapperCol={{
                  span: 10,
                  offset: 2,
                }}
              >
                <Button type="primary" htmlType="submit" size="large">提交</Button>
              </FormItem>
            </Form> 
          </TabPane>
          <TabPane tab="商品描述" key="description">aa
            <Ueditor value={formData.content} id="content" height="800" /> 
          </TabPane>
          <TabPane tab="设置分类" key="sorts">
          </TabPane>
        </Tabs>
      </Card>
     )
  }
}

AddGood = Form.create({})(AddGood);
