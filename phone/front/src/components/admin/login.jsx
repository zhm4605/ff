import { Card, Form, Icon, Input, Button, message } from 'antd';

const FormItem = Form.Item;

export default class Login extends React.Component{
  constructor(props) {
    super(props);
    this.handleSubmit = this.handleSubmit.bind(this);
  }
  handleSearch() {
    
  }
  handleSubmit() {
    //e.preventDefault();
    this.props.form.validateFields((err, values) => {
      if (!err) {
        console.log('Received values of form: ', values);

        $.ajax({
          url:"/welcome/login/",
          dataType:"json",
          type:"post",
          data:values,
          success:function(msg)
          {
            console.log(msg);
            if(msg.state)
            {
              window.location.href='/admin/';
            }
            else
            {
              message.error(msg.msg, 5000)
            }
            
          },
          error:function(msg){
            document.body.innerHTML = msg.responseText;
          }
        })
      }
    });
  }
  render() {
    const { getFieldProps, getFieldError,getFieldDecorator } = this.props.form;
    const card_style = {
      width: '400px',
      margin: '0 auto',
      top: '100px'
    }
    return (
      <Card title="登录" style={card_style}>
        <Form onSubmit={this.handleSubmit} className="Login-form">
          <FormItem>
            {getFieldDecorator('name', {
              rules: [{ required: true, message: '请输入用户名' }],
            })(
              <Input addonBefore={<Icon type="user" />} placeholder="用户名" />
            )}
          </FormItem>
          <FormItem>
            {getFieldDecorator('password', {
              rules: [{ required: true, message: '请输入密码' }],
            })(
              <Input addonBefore={<Icon type="lock" />} type="password" placeholder="密码" />
            )}
          </FormItem>
          <FormItem >
            <Button style={{width:'100%'}} type="primary" htmlType="submit" className="login-form-button">确定</Button>
          </FormItem>
        </Form> 

      </Card>
     )
  }
}

Login = Form.create({})(Login);

