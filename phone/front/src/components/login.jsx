import { Card, Form, Icon, Input, Button, message } from 'antd';
import { addLocaleData, IntlProvider, FormattedMessage } from 'react-intl';
import intl from 'intl';

const FormItem = Form.Item;

export default class Login extends React.Component{
  constructor(props) {
    super(props);
    this.handleSubmit = this.handleSubmit.bind(this);
  }
  handleSearch() {
    
  }
  handleSubmit() {
  	const that = this;
    this.props.form.validateFields((err, values) => {
      if (!err) {
        console.log('Received values of form: ', values);

        $.ajax({
          url:"/register/login/",
          dataType:"json",
          type:"post",
          data:values,
          success:function(msg)
          {
            console.log(msg);
            if(msg.state)
            {
            	const query = that.props.location.query;
            	if(query.from)
            	{
            		window.location.href='#/'+query.from;
            	}
            	else
            	{
            		window.location.href='#/home';
            	}
              
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
    });
  }
  render() {
    const { getFieldProps, getFieldError,getFieldDecorator } = this.props.form;
    const card_style = {
      width: '400px',
      margin: '50px auto',
    }
    return (
      <Card title={<FormattedMessage id='user_login'/>} style={card_style}>
        <Form onSubmit={this.handleSubmit} className="Login-form">
          <FormItem>
            {getFieldDecorator('name', {
              rules: [{ required: true, message: '请输入用户名' }],
            })(
              <Input addonBefore={<Icon type="user" />} placeholder='name'/>
            )}
          </FormItem>
          <FormItem>
            {getFieldDecorator('password', {
              rules: [{ required: true, message: '请输入密码' }],
            })(
              <Input addonBefore={<Icon type="lock" />} type="password" placeholder='password'/>
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

