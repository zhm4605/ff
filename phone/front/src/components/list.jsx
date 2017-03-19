import { Breadcrumb,Tag,Card,Icon,Pagination,BackTop,Row,Col } from 'antd';
import { replaceUrlParams } from 'utilsDir/common.jsx';
const CheckableTag = Tag.CheckableTag;

import SearchGood from './common/searchGood.jsx'; 
import GoodList from './common/goodList.jsx'; 
import  Category from './common/category.jsx';
export default class List extends React.Component{
	constructor(props) {
    super(props);

    this.get_data = this.get_data.bind(this);

    let data = this.get_data();
    this.state = data;

    this.changePage = this.changePage.bind(this);
    this.changeCategory = this.changeCategory.bind(this);
    this.handleSearch = this.handleSearch.bind(this);
  }
  changePage(page,pageSize){
  	window.location.href = replaceUrlParams(window.location.href,'page',page);
  	this.setState(this.get_data(page));
  }
  changeCategory(category)
  {
  	window.location.href = replaceUrlParams(window.location.href,'page',1);
  	this.setState(this.get_data(1,{category}));
  }
  get_data(page,where)
  {
  	let query = this.props.location.query;
  	query.page=page?page:(query.page?query.page:1);
  	//query.category=category?category:(query.category?query.category:"0");
  	Object.assign(query,where);
  	console.log(query);
  	let data  = {};
  	$.ajax({
      url: "/good/goodList",
      dataType: "json",
      async: false,
      type: 'post',
      data: query,
      success:function(msg)
      {
        data = msg;
      },
      error:function(msg){
        document.body.innerHTML = msg.responseText;
      }
    })
    return data;
  }
  handleSearch(name)
 	{
 		window.location.href = replaceUrlParams(window.location.href,'name',name);
 		this.setState(this.get_data(1,{name}));
 	}
  render() {
  	const {list,total,pageSize,page} = this.state;
  	const query = this.props.location.query;
    const selectedKeys = query.category?query.category:"0";
    //console.log(selectedKeys);

    return (
    	<div id='list-page'>
    		<SearchGood onSearch={this.handleSearch} value={query.name}/>
			  <div>
			  	<div className='category-menu'>
			  		<Category selectedKeys={[selectedKeys]} onChanged={this.changeCategory}/>
			  	</div>
			  	<div className='list'>
				    <div className='rank-good'>
				    	<a href='#'>按销量排序<Icon type='arrow-up' /></a>
				    	<a href='#'>按时间排序</a>
				    </div>
				    <div className='good-list-wrap'>
				    	<GoodList list={list}/>
				    	<Pagination className='list-pagination' current={parseInt(page)} total={total} defaultPageSize={pageSize} onChange={this.changePage}/>
				    </div>
				  </div>
		    </div>
		    <BackTop />
    	</div>
  	)
  }

}