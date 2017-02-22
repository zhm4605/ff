import { Form, Input, Tooltip, Icon, Cascader, Select, Row, Col, Checkbox, Button, Card, message } from 'antd';

import { addLocaleData, IntlProvider, FormattedMessage } from 'react-intl';

import intl from 'intl';
const FormItem = Form.Item;
const Option = Select.Option;

export default class Register extends React.Component{
	constructor(props) {
    super(props);
    this.handleSubmit = this.handleSubmit.bind(this);
    this.handlePasswordBlur = this.handlePasswordBlur.bind(this);
    this.checkPassword = this.checkPassword.bind(this);
    this.checkConfirm = this.checkConfirm.bind(this);
    this.get_captcha = this.get_captcha.bind(this);

    this.state = {
      passwordDirty: false,
      captcha_send: false
    };
  }
  //提交
  handleSubmit(e){
  	e.preventDefault();
    this.props.form.validateFieldsAndScroll((err, values) => {
      if (!err) {
        console.log(values);
        delete values.confirm;
        $.ajax({
		      url:"/register",
		      dataType:"json",
		      type: "post",
		      data: values,
		      success:function(msg)
		      {
		      	if(msg.state)
		      	{
		      		message.success(msg.info);
		      		window.location.href='#/login';
		      	}
		      	else
		      	{
		      		message.error(msg.info);
		      	}
		      },
		      error:function(msg){
		        console.log(msg);
		        document.body.innerHTML = msg.responseText;
		      }
		    })
      }
    });
  }
  handlePasswordBlur(e) {
    const value = e.target.value;
    this.setState({ passwordDirty: this.state.passwordDirty || !!value });
  }
  checkPassword(rule, value, callback) {
    const form = this.props.form;
    if (value && value !== form.getFieldValue('password')) {
      callback('Two passwords that you enter is inconsistent!');
    } else {
      callback();
    }
  }
  checkConfirm(rule, value, callback) {
    const form = this.props.form;
    if (value && this.state.passwordDirty) {
      form.validateFields(['confirm'], { force: true });
    }
    callback();
  }
  //获取验证码
  get_captcha()
  {
  	const email = this.props.form.getFieldValue('email');
  	const that = this;
  	$.ajax({
      url:"/register/send_email",
      dataType:"json",
      type: 'post',
      data: {email},
      success:function(msg)
      {
      	if(msg.state)
      	{
      		that.setState({captcha_send:true});
      		setTimeout(function(){
      			that.setState({captcha_send:false});
      		},2000);

      	}
      	else
      	{
      		message.error(msg.info);
      	}
      },
      error:function(msg){
        console.log(msg);
        document.body.innerHTML = msg.responseText;
      }
    })

  }
  render(){
  	const { getFieldDecorator } = this.props.form;
    const formItemLayout = {
      labelCol: { span: 5 },
      wrapperCol: { span: 18 },
    };
    const tailFormItemLayout = {
      wrapperCol: {
        span: 14,
        offset: 8,
      },
    };
    //<div><FormattedMessage id='nickname_hint'/></div>
    return (
    	<Card title={<FormattedMessage id='user_register'/>} extra={<a href='#/login'><FormattedMessage id='login'/>>></a>} style={{margin:'50px auto',width:600}}>
	      <Form onSubmit={this.handleSubmit}>
	      	<FormItem
	          {...formItemLayout}
	          label={<FormattedMessage id='nickname'/>}
	          hasFeedback
	        >
	          {getFieldDecorator('nickname', {
	            rules: [{ required: true, message:  <b>Name is required</b>}],
	          })(
	            <Input />
	          )}
	        </FormItem>
	        <FormItem
	          {...formItemLayout}
	          label= {<FormattedMessage id='password'/>}
	          hasFeedback
	        >
	          {getFieldDecorator('password', {
	            rules: [{
	              required: true, message:  <FormattedMessage id='password_hint'/>,
	            }, {
	              validator: this.checkConfirm,
	            }],
	          })(
	            <Input type="password" onBlur={this.handlePasswordBlur} />
	          )}
	        </FormItem>
	        <FormItem
	          {...formItemLayout}
	          label= {<FormattedMessage id='confirm_password'/>}
	          hasFeedback
	        >
	          {getFieldDecorator('confirm', {
	            rules: [{
	              required: true, message: <FormattedMessage id='confirm_password_hint'/>,
	            }, {
	              validator: this.checkPassword,
	            }],
	          })(
	            <Input type="password" />
	          )}
	        </FormItem>
	        <FormItem
	          {...formItemLayout}
	          label= {<FormattedMessage id='email'/>}
	          hasFeedback
	        >
	          {getFieldDecorator('email', {
	            rules: [{
	              type: 'email', message: '',
	            }, {
	              required: true, message: <FormattedMessage id='email_hint'/>,
	            }],
	          })(
	            <Input />
	          )}
	        </FormItem>
	        <FormItem
	          {...formItemLayout}
	          label={<FormattedMessage id='captcha'/>}
	        >
	          <Row gutter={8}>
	            <Col span={12}>
	              {getFieldDecorator('captcha', {
	                rules: [{ required: true, message: <FormattedMessage id='captcha_hint'/> }],
	              })(
	                <Input size="large" />
	              )}
	            </Col>
	            <Col span={12}>
	            	{
	            		this.state.captcha_send?
	            		<FormattedMessage id='captcha_has_send'/>
	            		:<Button size="large" onClick={this.get_captcha}><FormattedMessage id='get_captcha'/></Button>
	            	}
	            </Col>
	          </Row>
	        </FormItem>
	        <FormItem {...tailFormItemLayout}>
	          <Button type="primary" htmlType="submit" size="large"><FormattedMessage id='register'/></Button>
	        </FormItem>
	      </Form>
	    </Card>
    );
  }
}
Register = Form.create({})(Register);