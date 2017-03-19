import { Row,Col,Tag,Input,Button,Card,Tabs,message,Icon} from 'antd';

import  Price from './common/price.jsx';

const TabPane = Tabs.TabPane;
export default class Good extends React.Component{
	constructor(props) {
    super(props);
    const that = this;
    $.ajax({
      url:"/good/goodDetails/"+props.params.id,
      dataType:"json",
      async: false,
      success:function(msg)
      {
      	console.log(msg);
        that.data = msg;
      },
      error:function(msg){
        console.log(msg);
        document.body.innerHTML = msg.responseText;
      }
    })
    window.scrollTo(0,0);
    this.state = {count:1};
    this.setCount = this.setCount.bind(this);
    this.addCart = this.addCart.bind(this);
  }
  setCount(e)
  {
  	this.setState({count:e.target.value});
  }
  addCart(good_id)
  {
  	const data = {good_id,number:this.state.count};
  	$.ajax({
      url:"/cart/add_good/",
      dataType:"json",
      type: "post",
      data: data,
      success:function(msg)
      {
      	console.log(msg);
      	message.info(msg.info);
      	if(msg.state==2)
      	{
      		window.location.href='#/login?from='+encodeURIComponent(window.location.href);
      	}
      	else if(msg.state==1)
      	{
      		window.location.href='#/cart';
      	}
      	
      },
      error:function(msg){;
        document.body.innerHTML = msg.responseText;
      }
    })
  }
  render() {
  	const data = this.data;
  	//console.log(data);

  	const description = {
            __html: data.description
          };
    console.log(description);
    return (
    	<div id='good-page'>
    		<a href="javascript:history.go(-1)" className='back'><Button type="dashed"><Icon type="left" />返回</Button></a>
		    <Row>
		      <Col span={20} className='good-main'>
		      	<Row>
		      		<Col className='pics' span={10}>
		      			<img className='big-pic' src={data.pics.length>0?data.pics[0].url:''}/>
		      			<ul className='pic-list clearfix'>
		      			{
		      				data['pics'].map((d,i)=>
		      				<li key={d.id}>
		      					<img src={d.url}/>
		      				</li>
		      				)
		      			}
		      			{//<div className='pic-name'>正面</div>
		      			}
		      			</ul>
		      		</Col>
		      		<Col className='good-text' span={14}>
		      			<h3 className='name'>{data.name}</h3>
		      			<div className='price'>价格：<Price {...data} /></div>
		      			<div>
		      			{
		      				data['sorts'].map((d,i)=>
			      				<div className='sorts' key={d.id}>
				      				{d.name}：
				      				<div className='tags'>{
					      				d.children.map((child,j)=>
						      					<Tag key={child.id}>{child.name}</Tag>				      				
					      				)
				      				}
				      				</div>		      				
				      			</div>
			      			)
		      			}
		      			</div>
		      			<div className='remain'>
		      				数量：
		      				<Input type='number' defaultValue='1' style={{width:100}} onChange={this.setCount}/>
		      				<span className='tips'>库存{data.remain}件</span>
		      			</div>
		      			<div className='hot'>100</div>
		      			<div className='buttons-wrap'>
		      				{ //<Button className='btn-love' size='large'>收藏</Button>
		      				}
		      				<Button className='btn-add-cart' size='large' type='primary' onClick={()=>this.addCart(data.id)}>加入购物车</Button>
		      			</div>
		      		</Col>
		      	</Row>
		      </Col>
		      <Col span={4} className='related-good'>
		      	 <div className='title'>相关产品</div>
				      <ul>
				      	<li>
				      		<a href='#'>
				      			<img src='/imgs/phone.jpg'/>
				      		</a>
				      	</li>
				      </ul>
		      </Col>
		    </Row>
		    <Tabs type="card" className='good-intro' >
			    <TabPane tab="商品详细" key="1">
			    	<div dangerouslySetInnerHTML={description}></div>
			    </TabPane>
			    <TabPane tab="产品参数" key="2">产品参数</TabPane>
			  </Tabs>
		  </div>
   )
 }
}