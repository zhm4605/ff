import React from 'react';
import ReactDOM from 'react-dom';

import { Card, Form, Icon, Input,Button,Modal } from 'antd';

import SearchSort from './searchSort.jsx';

const FormItem = Form.Item;

export default class AddSort extends React.Component{
  constructor(props) {
    super(props);
    this.state = {
      visible: false
    }
    this.showModal = this.showModal.bind(this);
    this.handleOk = this.handleOk.bind(this);
    this.handleCancel = this.handleCancel.bind(this);
  }
  showModal() {
    this.setState({visible:true});
  }
  handleOk(e) {
    console.log(e);
    this.setState({
      ModalText: 'The modal dialog will be closed after two seconds',
      confirmLoading: true,
    });

    //e.preventDefault();
    console.log(this.props.form);
    this.props.form.validateFields((err, values) => {
      console.log(values);
      if (!err) {
        console.log('Received values of form: ', values);
      }
    });
    /*
    setTimeout(() => {
      this.setState({
        visible: false,
        confirmLoading: false,
      });
    }, 2000);*/
  }
  handleCancel() {
    console.log('Clicked cancel button');
    this.setState({
      visible: false,
    });
  }

  render() {
    const { getFieldProps, getFieldError,getFieldDecorator } = this.props.form;
    const formItemLayout = {
      labelCol: { span: 4 }
    };

    return (
      <div style={{display:'inline-block'}}>
        <Button type="primary" style={{marginLeft:'20%'}} onClick={this.showModal}>添加分类</Button>
        <Modal title="添加分类" 
          onOk={this.handleOk}
          confirmLoading={this.state.confirmLoading}
          onCancel={this.handleCancel}
          visible={this.state.visible}
        >
          <Form horizontal onSubmit={this.handleSubmit}>
            <FormItem
              {...formItemLayout}
              wrapperCol={{ span: 16 }}
              label="父分类"
            >
              {getFieldDecorator('parentId', {
                initialValue:'品牌'
              })(
                <SearchSort placeholder="选择父分类" style={{width:200}}/>
              )}
            </FormItem>
            <FormItem
              {...formItemLayout}
              wrapperCol={{ span: 16 }}
              label="名称"
            >
              {getFieldDecorator('name', {
                rules: [{required: true, message: '请输入名称'}],
              })(
                <Input />
              )}
            </FormItem>
            <FormItem
              {...formItemLayout}
              wrapperCol={{ span: 16 }}
              label="描述"
            >
              {getFieldDecorator('description', {
                
              })(
                <Input type="textarea" rows={2} />
              )}
            </FormItem>
            <FormItem
              {...formItemLayout}
              wrapperCol={{ span: 4 }}
              label="排序"
            >
              {getFieldDecorator('order', {
                initialValue:'999'
              })(
                <Input type='number'/>
              )}
            </FormItem>
          </Form> 
        </Modal>
      </div>
     )
  }
}

AddSort = Form.create({})(AddSort);
