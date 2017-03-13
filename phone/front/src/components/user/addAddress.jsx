import { Icon,Row,Col,Card,message,Button,Form,Input,Checkbox} from 'antd';
const FormItem = Form.Item;

export default class AddAddress extends React.Component{
  constructor(props) {
    super(props);
    const that = this;
    const id = props.params.hasOwnProperty('id')?props.params.id:0;
    this.state = {
      item:{},
      id
    };

    
    if(id>0)
    {
      $.ajax({
        url:"/user/get_address/"+id,
        dataType:"json",
        async: false,
        success:function(msg)
        {
          console.log(msg);
          if(msg.state==1)
          {
            that.state.item = msg.info;
          }
          else
          {
            message.info(msg.info);
          }
        },
        error:function(msg){
          console.log(msg);
          document.body.innerHTML = msg.responseText;
        }
      })
    }
  
    this.handleSubmit = this.handleSubmit.bind(this);
  }
  handleSubmit()
  {
    const that = this;
    
    this.props.form.validateFields((err, values) => {
      if (!err) 
      {
        values.default = values.default?1:0;
        $.ajax({
          url:"/user/update_address/"+that.state.id,
          dataType:"json",
          type:"post",
          data:values,
          success:function(msg)
          {
            console.log(msg);
            if(msg.state==1)
            {
              window.location.href="#/mycenter";
            }
            
          },
          error:function(msg){
            document.body.innerHTML = msg.responseText;
          }
        })
      }
    })
  }
  render() {
    const { getFieldProps, getFieldError,getFieldDecorator } = this.props.form;
    const formItemLayout = {
      labelCol: { span: 4 }
    };

    const {item} = this.state;

    return (
    <div id='addaddress-page'>
      <Card className='card' title={<h2>编辑收货地址</h2>} extra={<a href="javascript:history.go(-1)"><Button type="dashed">返回</Button></a>} style={{'marginTop':20
      }}>
        <Form onSubmit={this.handleSubmit}>
          <FormItem
            {...formItemLayout}
            wrapperCol={{ span: 16 }}
            label="收货人"
          >
            {getFieldDecorator('name', {
              initialValue:item.name,
              rules: [{required: true, message: '请输入名称'}],
            })(
              <Input />
            )}
          </FormItem>
          <FormItem
            {...formItemLayout}
            wrapperCol={{ span: 16 }}
            label="联系电话"
          >
            {getFieldDecorator('mobile', {
              initialValue:item.mobile,
              rules: [{required: true, message: '请输入名称'}],
            })(
              <Input />
            )}
          </FormItem>
          <FormItem
            {...formItemLayout}
            wrapperCol={{ span: 16 }}
            label="地址"
            style={{'marginBottom':5}}
          >
            {getFieldDecorator('areatext', {
              initialValue:item.areatext,
              rules: [{required: true, message: '请输入名称'}],
            })(
              <Input type="textarea" rows={2} />
            )}
          </FormItem>
          <FormItem
            {...formItemLayout}
            wrapperCol={{ offset: 4,span:16 }}
          >
            {getFieldDecorator('default', {
              valuePropName: 'checked',
              initialValue:item.default==1?true:false
            })(
              <Checkbox>设为默认收货地址</Checkbox>
            )}
          </FormItem>
          <FormItem
            {...formItemLayout}
            wrapperCol={{ offset: 4,span:16 }}
          >
            <Button  style={{float:'right'}} type="primary" htmlType="submit" size="large">提交</Button>
          </FormItem>
        </Form>
      </Card>
    </div>
    	
    )
  }
}

AddAddress= Form.create({})(AddAddress);