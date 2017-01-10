import React from 'react';
import ReactDOM from 'react-dom';

import { Card, Form, Icon, Input,Button,Modal } from 'antd';

import SearchSort from './searchSort.jsx';

const FormItem = Form.Item;

export default class SortModal extends React.Component{
  constructor(props) {
    super(props);
    this.state = this.props;
    this.showModal = this.showModal.bind(this);
    this.handleOk = this.handleOk.bind(this);
    this.handleCancel = this.handleCancel.bind(this);
  }
  showModal() {
    this.setState({visible:true});
  }

  componentWillReceiveProps(nextProps) {
    //console.log(nextProps);
    this.setState(nextProps);
  }
  handleOk(e) {
    const that = this;
    this.setState({
        confirmLoading: true,
      });
    this.props.form.validateFields((err, values) => {
      console.log(values);
      if (!err) 
      {
        console.log('Received values of form: ', values);
        const id = this.state.item.id;
        $.ajax({
          url:"/admin_sort/editSort/"+id,
          dataType:"json",
          type:"post",
          data:values,
          success:function(msg)
          {
            console.log(msg);
            if(msg.state)
            {
              that.setState({
                confirmLoading: false,
                visible:false
              },()=>{that.props.onOk(msg.list,that.state.visible)});
              //更新父组件
              
            }
            
          },
          error:function(msg){
            document.body.innerHTML = msg.responseText;
          }
        })
        
      }
    })
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
                initialValue:this.state.item.parentId
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
                initialValue:this.state.item.name,
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
                initialValue:this.state.item.description
              })(
                <Input type="textarea" rows={2} />
              )}
            </FormItem>
            <FormItem
              {...formItemLayout}
              wrapperCol={{ span: 4 }}
              label="排序"
            >
              {getFieldDecorator('orderId', {
                initialValue:this.state.item.orderId
              })(
                <Input type='number'/>
              )}
            </FormItem>
          </Form> 
        </Modal>
     )
  }
}

SortModal = Form.create({})(SortModal);
