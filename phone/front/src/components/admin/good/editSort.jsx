

import { Form, Icon, Input,InputNumber,Button,Checkbox,DatePicker,Col,Row,Tabs,Radio  } from 'antd';

import SearchSort from '../sort/searchSort.jsx';

const FormItem = Form.Item;

export default class EditSort extends React.Component{
  constructor(props) {
    super(props);
  }

  handleSubmit() {

  }

  render() {
    const { getFieldProps, getFieldError,getFieldDecorator } = this.props.form;
    const formItemLayout = {
      labelCol: { span: 2 }
    };
    return (
    	<div>
	    	<div style={{textAlign:'center',marginBottom:10}}>
	        <SearchSort placeholder="搜索要添加的分类" style={{ width: 250,marginBottom:10,textAlign:'left' }} />
	      </div>
	    	<Form horizontal onSubmit={this.handleSubmit}>
		      <FormItem
		        {...formItemLayout}
		        wrapperCol={{ span: 14 }}
		        label="颜色"
		      >
		        {getFieldDecorator('name', {
		          initialValue:"a",
		          rules: [{ required: true, message: '请选择颜色' }],
		        })(
		          <RadioGroup>
		            <RadioButton value="a">Hangzhou</RadioButton>
		            <RadioButton value="b">Shanghai</RadioButton>
		            <RadioButton value="c">Beijing</RadioButton>
		            <RadioButton value="d">Chengdu</RadioButton>
		          </RadioGroup>
		        )}
		      </FormItem>
		      <FormItem
		        {...formItemLayout}
		        wrapperCol={{ span: 4 }}
		        label="价格"
		      >
		          {getFieldDecorator('priceO', {
		            rules: [{ required: true, message: '请输入价格' }],
		          })(
		            <Input type='number' placeholder='' addonAfter='元'/>
		          )}
		      </FormItem>
		      <FormItem
		        {...formItemLayout}
		        wrapperCol={{ span: 4 }}
		        label="库存"
		      >
		        {getFieldDecorator('name', {
		          rules: [{required: true, message: '请输入库存'}],
		        })(
		          <Input type='number' placeholder='' addonAfter='件'/>
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
	    </div>
    )
  }
}

EditSort = Form.create({})(EditSort);