import { Breadcrumb,Icon } from 'antd';
export default class Home extends React.Component{
  constructor(props) {
    super(props);
  }
  render() {
    return (
    	<ul className='good-card-list clearfix'>
	    	<li>
	    		<a href="#">
		    		<div className="custom-image">
				      <img alt="example" width="100%" src="https://os.alipayobjects.com/rmsportal/QBnOOoLaAfKPirc.png" />
				      <div className='name'>iphone7</div>
				    </div>
				    <div className="custom-card">
				      <div className='price'>6899</div>
				      <div className='hot'><Icon type='like'/>100</div>
				      <div className='desc'>描述</div>
				    </div>
			    </a>
	    	</li>
	    	<li>
	    		<a href="#">
		    		<div className="custom-image">
				      <img alt="example" width="100%" src="https://os.alipayobjects.com/rmsportal/QBnOOoLaAfKPirc.png" />
				      <div className='name'>iphone7</div>
				    </div>
				    <div className="custom-card">
				      <div className='price'>6899</div>
				      <div className='hot'><Icon type='like'/>100</div>
				      <div className='desc'>描述</div>
				    </div>
			    </a>
	    	</li>
	    	<li>
	    		<a href="#">
		    		<div className="custom-image">
				      <img alt="example" width="100%" src="https://os.alipayobjects.com/rmsportal/QBnOOoLaAfKPirc.png" />
				      <div className='name'>iphone7</div>
				    </div>
				    <div className="custom-card">
				      <div className='price'>6899</div>
				      <div className='hot'><Icon type='like'/>100</div>
				      <div className='desc'>描述</div>
				    </div>
			    </a>
	    	</li>
	    	<li>
	    		<a href="#">
		    		<div className="custom-image">
				      <img alt="example" width="100%" src="https://os.alipayobjects.com/rmsportal/QBnOOoLaAfKPirc.png" />
				      <div className='name'>iphone7</div>
				    </div>
				    <div className="custom-card">
				      <div className='price'>6899</div>
				      <div className='hot'><Icon type='like'/>100</div>
				      <div className='desc'>描述</div>
				    </div>
			    </a>
	    	</li>
	    	<li>
	    		<a href="#">
		    		<div className="custom-image">
				      <img alt="example" width="100%" src="https://os.alipayobjects.com/rmsportal/QBnOOoLaAfKPirc.png" />
				      <div className='name'>iphone7</div>
				    </div>
				    <div className="custom-card">
				      <div className='price'>6899</div>
				      <div className='hot'><Icon type='like'/>100</div>
				      <div className='desc'>描述</div>
				    </div>
			    </a>
	    	</li>
	    </ul>
    )
  }
}