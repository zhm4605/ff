import React from 'react';
import ReactDOM from 'react-dom';
import './style.less';
import { Card, Form, Icon, Input, Button, Checkbox } from 'antd';

const FormItem = Form.Item;

class Register extends React.Component{
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
    const card_style = {
      width: '500px',
      margin: '0 auto'
    }
    return (
      <Card title="添加用户" style={card_style}>
        <Form onSubmit={this.handleSubmit} className="register-form">
          <FormItem>
            {getFieldDecorator('userName', {
              rules: [{ required: true, message: 'Please input your username!' }],
            })(
              <Input addonBefore={<Icon type="user" />} placeholder="Username" />
            )}
          </FormItem>
          <FormItem>
              <Input addonBefore={<Icon type="user" />} placeholder="Username" />
          </FormItem>
          <FormItem>
            {getFieldDecorator('remember', {
              valuePropName: 'checked',
              initialValue: true,
            })(
              <Checkbox>Remember me</Checkbox>
            )}
            <a className="login-form-forgot">Forgot password</a>
            <Button type="primary" htmlType="submit" className="login-form-button">
              Log in
            </Button>
            Or <a>register now!</a>
          </FormItem>
        </Form> 
      </Card>
     )
  }
}

Register = Form.create({})(Register);
ReactDOM.render(<Register />, document.getElementById('container'));
