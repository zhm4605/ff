import React from 'react';
import ReactDOM from 'react-dom';

import { Button, Menu, Dropdown, Icon, Form, Modal, Input, message } from 'antd';

const FormItem = Form.Item;

export default class MyCenter extends React.Component{
  constructor(props) {
    super(props);
    this.state = {
      defaultOpenKeys: 'good',
      current: 'good_list',
      visible: false
    };
    const that = this;
    $.ajax({
      url:"/admin/admin/adminInfo",
      dataType:"json",
      async:false,
      success:function(msg)
      {
       that.name=msg.name;
      },
      error:function(msg){
        document.body.innerHTML = msg.responseText;
      }
    })
    this.handleClick = this.handleClick.bind(this);
    this.handleOk = this.handleOk.bind(this);
    this.handleCancel = this.handleCancel.bind(this);
  }
  handleClick(e) {
    if(e.key=='edit_password')
    {
      this.setState({
        visible: true,
      });
    }
  }
  handleOk()
  {
    const that = this;
    this.props.form.validateFields((err, values) => {
      if (!err) 
      {
        console.log('Received values of form: ', values);
        if(values.password!=values.repeatPassword)
        {
          message.error("两次密码输入不同");
        }
        else
        {
          $.ajax({
            url: "/admin/admin/updatePassword",
            dataType: "json",
            type: "post",
            data: values,
            success:function(msg)
            {
              //console.log(msg); 
              if(msg.state)
              {
                message.success(msg.info);
                setTimeout(function(){
                  window.location.href = '/admin_welcome'
                },1500);
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
        
      }
    })
  }
  handleCancel(e) {
    console.log(e);
    this.setState({
      visible: false,
    });
  }
  render() {
    const menu = (
      <Menu onClick={this.handleClick}>
        <Menu.Item key="edit_password">修改密码</Menu.Item>
        <Menu.Item key="logout"><a href='/admin_welcome/logout'>退出登录</a></Menu.Item>
      </Menu>
    ); 
    const { getFieldProps, getFieldError,getFieldDecorator } = this.props.form;
    const formItemLayout = {
      labelCol: { span: 5 },
      wrapperCol: { span: 16 }
    };
    return (
      <div>
        <Dropdown overlay={menu} >
          <a id="mycenter">
            hello,{this.name}<Icon type="down" />
          </a>
        </Dropdown>
        <Modal title="修改密码" visible={this.state.visible} onOk={this.handleOk} onCancel={this.handleCancel} width='500'>
          <Form horizontal>
            <FormItem
              {...formItemLayout}
              label="旧密码"
            >
              {getFieldDecorator('originPassword', {
                rules: [{ type:'string', required: true, message: '请输入旧密码' }],
              })(
                <Input type='password'/>
              )}
            </FormItem>
            <FormItem
              {...formItemLayout}
              label="新密码"
            >
              {getFieldDecorator('password', {
                rules: [{ type:'string', required: true, message: '请输入新密码' }],
              })(
                <Input type='password'/>
              )}
            </FormItem>
            <FormItem
              {...formItemLayout}
              label="重复新密码"
            >
              {getFieldDecorator('repeatPassword', {
                rules: [{ type:'string', required: true, message: '请再次输入新密码' }],
              })(
                <Input type='password'/>
              )}
            </FormItem>
          </Form>
        </Modal>
      </div>
    );
  }
};

MyCenter = Form.create({})(MyCenter);

