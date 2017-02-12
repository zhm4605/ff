

import { Form, Icon, Input,InputNumber,Button,Col,Row,Tabs,Tag,Table,message } from 'antd';

import SearchSort from '../sort/searchSort.jsx';
import EditSortChild from './editSortChild.jsx';

const FormItem = Form.Item;
const { Column, ColumnGroup } = Table;

export default class EditSort extends React.Component{
  constructor(props) {
    super(props);
    const that = this;
    /*
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
    })*/
    //console.log(props);
    this.state = {
      list: props.data.sorts?props.data.sorts:[],
      sort_list: props.data.sort_list?props.data.sort_list:[]
    };
    //console.log(props.data.sort_list);
    this.addSort = this.addSort.bind(this);
    this.addSortValue = this.addSortValue.bind(this);
    this.updateRender = this.updateRender.bind(this);
    this.changeRemain = this.changeRemain.bind(this);
    this.changePrice = this.changePrice.bind(this);
    this.updateSortList = this.updateSortList.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);
    this.removeSort = this.removeSort.bind(this);
  }
  addSortValue(value,label)
  {
    this.setState({label});
  }
  //添加分类
  addSort()
  {
    let {list,label} = this.state;
    if(label)
    {
      label = label[label.length-1];
      //console.log(label);
      let is_repeat = 0;
      list.forEach(function(item, index, arr){
        if(item.id==label.id)
        {
          is_repeat=1;
          return;
        }
      })
      if(!is_repeat)
      {
        list.push(label);
        this.setState({list});
        this.updateSortList(list)
      }
    }
    else
    {
      message.info('请选择要添加的分类');
    }
    
    
  }

  updateRender(index,children)
  {
    let list = this.state.list;
    list[index]['children'] = children;
    this.setState({list});
    this.updateSortList(list);
  }

  changeRemain(e,i)
  {
    let {sort_list} = this.state;
    sort_list[i]["remain"] = e.target.value;
    this.setState({sort_list});
  }

  changePrice(e,i)
  {
    let {sort_list} = this.state;
    sort_list[i]["price"] = e.target.value;
    console.log(sort_list);
    this.setState({sort_list});
  }

  /**生成所有种类**/
  updateSortList(list)
  {
    let num = 0;
    let sort_list = [];
    const validList = list.filter((item) => {
      return item.children.length>0;
    });
    const default_price = this.props.data.priceMin;
    const loop = function(i){
      let item = {};
      for(var j=0; j<validList[i].children.length; j++){
        item = validList[i].children[j];
        if(i<validList.length)
        {
          if(!sort_list.hasOwnProperty(num))
          {
            sort_list[num] = {};
            sort_list[num]['sorts'] = {};
          }
          sort_list[num]['sorts'][validList[i].id] = item;
          if(i==validList.length-1)
          {
            sort_list[num]['remain'] = 0;
            sort_list[num]['price'] = default_price;
            num++;
            sort_list[num] = {};
            sort_list[num]['sorts'] = $.extend({},sort_list[num-1]['sorts']);
          }
        }
        if(i<validList.length-1)
        {
          loop(i+1);
        }
      }
    }

    if(validList.length>0)
    {
      loop(0);
    }
    
    sort_list.pop();
    console.log(sort_list);
    this.setState({sort_list});
  }

  //保存分类
  handleSubmit()
  {
    const {goodId} = this.props;
    //console.log(goodId);

    const data = {
      sorts: this.state.list,
      sort_list: this.state.sort_list
    };
    $.ajax({
        url:"/admin_good/editGoodSorts/"+goodId,
        dataType:"json",
        type: "post",
        data: data,
        success:function(msg)
        {
          console.log(msg);
          window.location.href='/good/'+goodId;
        },
        error:function(msg){
          console.log(msg);
          document.body.innerHTML = msg.responseText;
        }
      })
  }
  //删除分类
  removeSort(i)
  {
    let {list} = this.state;
    list.splice(i,1);
    this.setState({list});
    this.updateSortList(list);
  }
  render() {
    const {list,sort_list} = this.state;

    const validList = list.filter((item) => {
      return item.children.length>0;
    });

    //分类选择
    const sorts = list.map((d,i) => 
	    		<Row key={d.id} className='good-sort-wrap'>
			      <Col span={2} className='sort-name'>{d.name}：</Col>
			      <Col span={20}>
			      	<EditSortChild index={i} id={d.id} name={d.name} children={d.children} onChanged={this.updateRender}/>
			      </Col>
            <Icon type="minus-square-o" className='remove' title='删除' onClick={()=>this.removeSort(i)}/>
			    </Row>
				);

    //种类表格
    const columns = validList.map((d,i) => 
          <Column title={d.name} key={d.id} render={(text, record) => (
              <span>{record["sorts"][d.id]['name']}</span>
            )}/>
        );
    const sort_table = sort_list.length>0?<div>
      <Table dataSource={sort_list} pagination={false} bordered style={{marginTop:10}}>
         {columns}
         <Column title="库存" kwy='remain' render={(text, record, i) => (
              <Input type='number' addonAfter='件' onChange={(e)=>this.changeRemain(e,i)} value={record.remain}/>
            )}/>
         <Column title="价格" render={(text, record,i) => (
              <Input type='number' addonAfter='元' onChange={(e)=>this.changePrice(e,i)} value={record.price}/>
            )}/>
        </Table>
        <Button type="primary" htmlType="submit" size="large" style={{marginTop:10,float:'right'}} onClick={this.handleSubmit}>提交</Button></div>:'';

    return (
    	<div>
	    	<div style={{textAlign:'left',marginBottom:15}}>
	    		<SearchSort placeholder="搜索要添加的分类" style={{width:200,textAlign:'left'}} onChoosed = {this.addSortValue}/>
	    		<Button type='primary' onClick={this.addSort} style={{marginLeft:5,verticalAlign:'middle'}}>添加</Button>
	      </div>
	      <div>{sorts}</div>
        {sort_table}
	    </div>
    )
  }
}

EditSort = Form.create({})(EditSort);