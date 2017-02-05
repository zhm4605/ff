import { Row,Col,Tag,Input,Button,Card,Tabs} from 'antd';

const TabPane = Tabs.TabPane;
export default class Good extends React.Component{
	constructor(props) {
    super(props);
  }
  render() {
    return (
    	<div id='good-page'>
		    <Row>
		      <Col span={20} className='good-main'>
		      	<Row>
		      		<Col className='pics' span={10}>
		      			<img className='big-pic' src='/imgs/phone.jpg'/>
		      			<ul className='pic-list clearfix'>
		      				<li>
		      					<img src='/imgs/phone.jpg'/>
		      					<div className='pic-name'>正面</div>
		      				</li>
		      				<li>
		      					<img src='/imgs/phone.jpg'/>
		      					<div className='pic-name'>正面</div>
		      				</li>
		      			</ul>
		      		</Col>
		      		<Col className='good-text' span={14}>
		      			<h3 className='name'>iphone7</h3>
		      			<div className='price'>价格：￥6899</div>
		      			<div className='sorts'>
		      				颜色：
		      				<div className='tags'>
		      					<Tag>白色</Tag>
		      					<Tag>黑色</Tag>
		      				</div>
		      			</div>
		      			<div className='remain'>
		      				数量：
		      				<Input type='number' value='1' style={{width:100}}/>
		      				<span className='tips'>库存100件</span>
		      			</div>
		      			<div className='hot'>100</div>
		      			<div className='buttons-wrap'>
		      				<Button className='btn-love' size='large'>收藏</Button>
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
		    <Tabs type="card" className='good-intro' animated={false}>
			    <TabPane tab="商品详细" key="1">Content of Tab Pane 1</TabPane>
			    <TabPane tab="产品参数" key="2">Content of Tab Pane 2</TabPane>
			  </Tabs>
		  </div>
   )
 }
}