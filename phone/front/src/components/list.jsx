import { Breadcrumb,Tag,Card,Icon,Pagination,BackTop } from 'antd';

const CheckableTag = Tag.CheckableTag;

import SearchGood from './common/searchGood.jsx'; 
import GoodList from './common/goodList.jsx'; 

export default class List extends React.Component{
	constructor(props) {
    super(props);

    const that = this;
    $.ajax({
      url:"/good/goodList",
      dataType:"json",
      async: false,
      success:function(msg)
      {
        console.log(msg);
        that.state = {
          data:msg,
        }
      },
      error:function(msg){
        document.body.innerHTML = msg.responseText;
      }
    })
  }
  render() {
    return (
    	<div id='list-page'>
    		<SearchGood />
    		<Breadcrumb>
			    <Breadcrumb.Item>所有分类</Breadcrumb.Item>
			    <Breadcrumb.Item><a href="">苹果</a></Breadcrumb.Item>
			    <Breadcrumb.Item>An Application</Breadcrumb.Item>
			  </Breadcrumb>
			  <ul className='filter-good'>
				  <li>
		        <div className='title'>品牌：</div>
		        <div className='children'>
			          <CheckableTag
			            checked={false}
			            onChange={checked => this.handleChange(checked)}
			            className='tag'
			          >
			            苹果
			          </CheckableTag>
		         </div>
		       </li>
		       <li>
		        <div className='title'>品牌：</div>
		        <div className='children'>
			          <CheckableTag
			            checked={false}
			            onChange={checked => this.handleChange(checked)}
			            className='tag'
			          >
			            苹果
			          </CheckableTag>
		        </div>
		      </li>
		    </ul>
		    <div className='rank-good'>
		    	<a href='#'>按销量排序<Icon type='arrow-up' /></a>
		    	<a href='#'>按时间排序</a>
		    </div>
		    <Card title="" className='good-list-wrap'>
		    	<GoodList />
		    	<Pagination defaultCurrent={1} total={50} />
		    </Card>
		    <BackTop />
    	</div>
  	)
  }

}