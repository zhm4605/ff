

import { Form, Icon, Input,InputNumber,Button,Col,Row,Tabs,Tag,Table  } from 'antd';

import SearchSort from '../sort/searchSort.jsx';
import EditSortChild from './editSortChild.jsx';

const FormItem = Form.Item;
const { Column, ColumnGroup } = Table;

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
    this.updateRender = this.updateRender.bind(this);
  }

  handleSubmit() {

  }

  addSort()
  {
  	//this.refs.sort.value
  }

  updateRender(index,children)
  {
    console.log(index);
    console.log(children);
    let list = this.state.list;
    list[index]['children'] = children;
    this.setState({list});
  }

  render() {
    const {list} = this.state;
    console.log(list);
    const sorts = list.map((d,i) => 
	    		<Row key={d.id} style={{padding:'5px 0'}}>
			      <Col span={4} style={{textAlign:'right',paddingRight:5}}>{d.name}：</Col>
			      <Col span={20}>
			      	<EditSortChild index={i} id={d.id} name={d.name} children={d.children} onChanged={this.updateRender}/>
			      </Col>
			    </Row>
				);
    const sort_table = list.map((d,i) =>
        <td rowspan={d.children.length}>{d.name}</td>
        <Column title="价格（元）" key="price" render={(text, record) => (
              <span>￥{record.priceMin} ~ ￥{record.priceMax}</span>
            )}/>
      );
    //
    return (
    	<div>
	    	<div style={{textAlign:'left',marginBottom:15}}>
	    		<SearchSort placeholder="搜索要添加的分类" style={{width:200,textAlign:'left'}} ref='sort'/>
	    		<Button type='primary' onClick={this.addSort} style={{marginLeft:5,verticalAlign:'middle'}}>添加</Button>
	      </div>
	      {sorts}
        <Table>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        </Table>
	    </div>
    )
  }
}

EditSort = Form.create({})(EditSort);