import React from 'react';
import ReactDOM from 'react-dom';
import { Card, Form, Icon, Input, Button, Checkbox } from 'antd';

const FormItem = Form.Item;

class Login extends React.Component{
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
      <Card title="登录" style={card_style}>
        <Form onSubmit={this.handleSubmit} className="Login-form">
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
            Or <a>Login now!</a>
          </FormItem>
        </Form> 
      </Card>
     )
  }
}

Login = Form.create({})(Login);
ReactDOM.render(<Login />, document.getElementById('container'));
