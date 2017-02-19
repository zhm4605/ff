import UploadPic from './uploadPic.jsx';

import moment from 'moment';

// 推荐在入口文件全局设置 locale
import 'moment/locale/zh-cn';
moment.locale('zh-cn');

import SearchSort from '../sort/searchSort.jsx';

import { Form, Icon, Input,InputNumber,Button,Checkbox,DatePicker,Row,Col,message} from 'antd';

const FormItem = Form.Item;

export default class EditBasic extends React.Component{
  constructor(props) {
    super(props);
    this.state = props;
    this.handleSubmit = this.handleSubmit.bind(this);
  }
  componentWillReceiveProps(nextProps) {
  	this.setState(nextProps);
  }
  handleSubmit() {
  	const that = this;
  	const good_id = this.state.good_id>0?this.state.good_id:0;
  	this.props.form.validateFields((err, values) => {
      if (!err) 
      {
        values['putaway_time'] = values['putaway_time']?values['putaway_time'].format('YYYY-MM-DD HH:mm:ss'):"";

        $.ajax({
          url:"/admin_good/editGood/"+good_id,
          dataType:"json",
          type:"post",
          data:values,
          success:function(msg)
          {
            if(msg.id)
            {
			  			that.props.finish&&that.props.finish();
			  			if(good_id==0)
			  			{
			  				message.success('保存成功');
			  				window.location.href = "#/addGood/"+msg.id+"?nav=description";
			  			}
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
  	const data = this.state.data||{};
  	//console.log(data);
    const { getFieldProps, getFieldError,getFieldDecorator } = this.props.form;
    const formItemLayout = {
      labelCol: { span: 3 }
    };
    //console.log(moment(data.putaway_time,"YYYY-MM-DD HH:mm:ss"));
    return (
    	<Form horizontal onSubmit={this.handleSubmit}>
    		<FormItem
	        {...formItemLayout}
	        wrapperCol={{ span: 14 }}
	        label="商品分类"
	      >
	        {getFieldDecorator('category', {
	        	initialValue: data.category
	        })(
	          <SearchSort placeholder="选择分类" style={{width:200,textAlign:'left'}}/>
	        )}
	      </FormItem>
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
	          {getFieldDecorator('price_origin', {
	          	initialValue: data.price_origin,
	            //rules: [{ type:'number', required: true, message: '请输入原价' }],
	          })(
	            <Input type='number' placeholder='请输入原价' addonAfter='元'/>
	          )}
	          
	        </Col>
	        <Col span={7}>
	          {getFieldDecorator('price_min', {
	          	initialValue: data.price_min,
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
	        {getFieldDecorator('putaway_time', {
	        	initialValue: moment(data.putaway_time,"YYYY-MM-DD HH:mm:ss")._isValid?moment(data.putaway_time,"YYYY-MM-DD HH:mm:ss"):null,
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
	          <UploadPic good_id={this.state.good_id}/>
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