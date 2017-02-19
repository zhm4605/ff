


export default class Price extends React.Component{
	constructor(props) {
    super(props);
  }

  render() {
  	let {price_min,price_max,rate} = this.props;
  	//const currency = this.props.query.currency?this.props.query.currency:'CNR';
    const currency = 'CNR';
  	if(currency=='EUR')
  	{
  		price_min = (price_min*rate).toFixed(2);
  		price_max = (price_max*rate).toFixed(2);
  	}
    return (
    	<span>
    		{
    			(price_min==price_max||!price_max)?price_min:price_min+'~'+price_max+currency
    		}
    	</span>
  	)
  }

}