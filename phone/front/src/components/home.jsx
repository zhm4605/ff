import { Carousel,Input,Button,Card,Icon } from 'antd';

import SearchGood from './common/searchGood.jsx'; 
import GoodList from './common/goodList.jsx'; 

export default class Home extends React.Component{
  constructor(props) {
    super(props);
    this.previous = this.previous.bind(this)
  }
  previous() {
    this.slider.slickPrev()
  }
  handleSearch(value)
  {
  	console.log(value);
  }
  render() {
    return (
    	<div>
    		<SearchGood />
			  {//autoplay 
			  }
	      <Carousel  className='top-slide' ref={c => this.slider = c }>
	      	<div>
			    	<a className='item'><img src='/imgs/1.jpg'/></a>
			    </div>
			    <div>
			    	<a className='item'><img src='/imgs/2.jpg'/></a>
			    </div>
			  </Carousel>
			  <Card title="热门商品" extra={<a href="#">More</a>} className='hot-good-wrap'>
			    <GoodList />
			  </Card>
		  </div>
    );
  }
};
