import UploadPic from './uploadPic.jsx';

import moment from 'moment';

// 推荐在入口文件全局设置 locale
import 'moment/locale/zh-cn';
moment.locale('zh-cn');

import { Form, Icon, Input,InputNumber,Button,Checkbox,DatePicker,Row,Col} from 'antd';

const FormItem = Form.Item;

export default class EditBasic extends React.Component{
  constructor(props) {
    super(props);
    this.handleSubmit = this.handleSubmit.bind(this);
  }

  handleSubmit() {
  	const that = this;
  	this.props.form.validateFields((err, values) => {
      //console.log(values);
      if (!err) 
      {
        //console.log('Received values of form: ', values);
        values['putawayTime'] = values['putawayTime'].format('YYYY-MM-DD HH:mm:ss');
        $.ajax({
          url:"/admin_good/editGood/"+that.props.goodId||'',
          dataType:"json",
          type:"post",
          data:values,
          success:function(msg)
          {
            console.log(msg);
            if(msg.state)
            {
			  			that.props.finish&&that.props.finish();
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
  	const data = this.props.data||{};
    const { getFieldProps, getFieldError,getFieldDecorator } = this.props.form;
    const formItemLayout = {
      labelCol: { span: 3 }
    };
    return (
    	<Form horizontal onSubmit={this.handleSubmit}>
	      <FormItem
	        {...formItemLayout}
	        wrapperCol={{ span: 14 }}
	        label="商品名称"
	      >
	        {getFieldDecorator('name', {
	        	initialValue: data.name,
	          rules: [{ type:'string', required: true, max:50, message: '请输入商品名称（0~50字）' }],
	        })(
	          <Input/>
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
	          	initialValue: data.priceO,
	            //rules: [{ type:'number', required: true, message: '请输入原价' }],
	          })(
	            <Input type='number' placeholder='请输入原价' addonAfter='元'/>
	          )}
	          
	        </Col>
	        <Col span={7}>
	          {getFieldDecorator('priceMin', {
	          	initialValue: data.priceMin,
	            //rules: [{ type:'number',required: true, message: '请输入现价' }],
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
	        {getFieldDecorator('remain', {
	        	initialValue: data.remain,
	          //rules: [{type:'number',required: true, message: '请输入库存'}],
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
	        	initialValue: moment(data.putawayTime,"YYYY-MM-DD HH:mm:ss"),
	          //rules: [{ type: 'date'}]
	        })(
	          <DatePicker showTime format="YYYY-MM-DD HH:mm:ss"/>
	        )}
	      </FormItem>
	      <FormItem
	        {...formItemLayout}
	        wrapperCol={{ span: 21 }}
	        label="商品图片"
	      >
	        {getFieldDecorator('pics', {
	        	initialValue: data.pics,
	          valuePropName: 'fileList'
	        })(
	          <UploadPic goodId={this.props.goodId}/>
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
    )
  }
}

EditBasic = Form.create({})(EditBasic);