import { Breadcrumb,Icon } from 'antd';
import  Price from './price.jsx';

export default class GoodList extends React.Component{
  constructor(props) {
    super(props);
    //const that = this;
  }
  render() {

    return (
    	<ul className='good-card-list clearfix'>
    		{
    			this.props.list.map((good,i)=>
    				<li key={good.id}>
			    		<a href={"#/good/"+good.id+'?'+(window.location.hash.split('?')[1]?window.location.hash.split('?')[1]:'lang=zh-CN')}>
				    		<div className="custom-image">
						      <img alt="example" src={good.pic_url} />
						      <div className='name'>{good.name}</div>
						    </div>
						    <div className="custom-card">
						      <div className='price'>价格：<Price {...good} /></div>
						      <div className='hot'><Icon type='eye'/>{good.hot}</div>
						    </div>
					    </a>
			    	</li>
    			)
    		}
	    	
	    </ul>
    )
  }
}