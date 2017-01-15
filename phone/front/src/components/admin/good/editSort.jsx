

import { Form, Icon, Input,InputNumber,Button,Col,Row,Tabs,Tag  } from 'antd';

import SearchSort from '../sort/searchSort.jsx';
import EditSortChild from './editSortChild.jsx';

const FormItem = Form.Item;

export default class EditSort extends React.Component{
  constructor(props) {
    super(props);
    const that = this;
    $.ajax({
      url:"/admin_good/default_sort/",
      dataType:"json",
      async: false,
      success:function(msg)
      {
        console.log(msg);
        that.state = {
        	list:msg
        };
      },
      error:function(msg){
        document.body.innerHTML = msg.responseText;
      }
    })

    this.addSort = this.addSort.bind(this);
  }

  handleSubmit() {

  }

  addSort()
  {
  	//this.refs.sort.value
  }

  updateRender(data)
  {
  	console.log(data)
  }

  render() {
    const {list} = this.state;
    const sorts = list.map((d) => 
	    		<Row key={d.id} style={{padding:'5px 0'}}>
			      <Col span={4} style={{textAlign:'right',paddingRight:5}}>{d.name}：</Col>
			      <Col span={20}>
			      	<EditSortChild id={d.id} name={d.name} children={d.children} onChange={this.updateRender}/>
			      </Col>
			    </Row>
				);
    //
    return (
    	<div>
	    	<div style={{textAlign:'left',marginBottom:15}}>
	    		<SearchSort placeholder="搜索要添加的分类" style={{width:200,textAlign:'left'}} ref='sort'/>
	    		<Button type='primary' onClick={this.addSort} style={{marginLeft:5,verticalAlign:'middle'}}>添加</Button>
	      </div>
	      {sorts}
	    </div>
    )
  }
}

EditSort = Form.create({})(EditSort);