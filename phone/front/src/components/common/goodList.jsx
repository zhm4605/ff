import { Breadcrumb,Icon } from 'antd';
export default class Home extends React.Component{
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
        that.data = msg;
      },
      error:function(msg){
        console.log(msg);
        document.body.innerHTML = msg.responseText;
      }
    })
  }
  render() {

  	//<div className='desc'>{good.description}</div>
    return (
    	<ul className='good-card-list clearfix'>
    		{
    			list.map((good,i)=>
    				<li>
			    		<a href="#">
				    		<div className="custom-image">
						      <img alt="example" width="100%" src={good.picUrl} />
						      <div className='name'>{good.name}</div>
						    </div>
						    <div className="custom-card">
						      <div className='price'>{((good.priceMin==good.priceMax)||(!good.priceMax))?
						      	'￥'+good.priceMin:'￥'+good.priceMin+'~'+"￥"+good.priceMax}</div>
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