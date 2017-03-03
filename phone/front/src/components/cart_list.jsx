import { Breadcrumb,Icon,Row,Col,Card,message,Button} from 'antd';

export default class CartList extends React.Component{
  constructor(props) {
    super(props);
    this.state = {
      list:[]
    }
    const that = this;
    $.ajax({
      url:"/cart/cart_list/",
      dataType:"json",
      async: false,
      success:function(msg)
      {
        console.log(msg);
        if(msg.state==1)
        {
          that.state = {
            list:msg.info.list
          }
        }
        else
        {
          message.info(msg.info);
        }
        
      },
      error:function(msg){
        console.log(msg);
        document.body.innerHTML = msg.responseText;
      }
    })
    this.go_account = this.go_account.bind(this);
  }
  go_account() {
    const { list } = this.state;
    let str = "";
    list.map ((good,i)=>{
      if(i!=0)
      {
        str += ",";
      }
      str += good.good_id+':'+good.number; 
    })
    window.location.href='#/order?details='+str;
  }
  render() {
    const { list } = this.state;
    return (
    <div id='cart-page'>
      <Card className='card' title={<h2>购物车</h2>} extra={<a href="javascript:history.go(-1)"><Button type="dashed">返回</Button></a>} style={{ width: '100%',minHeight:'500px',marginTop:'20px'}}>
      {
        list.map((good,i)=>
          <a href={'/home/#/good/'+good.good_id} style={{cusor:'pointer'}} target='_blank' key={good.id}>
          <Row className='cart-item'>
            <Col span={3} className='pic'>
              <img src={good.good_pic} width='100'/>
            </Col>
            <Col span={9} className='good-name'>
              {good.good_name}
            </Col>
            <Col span={12} className='price'>
              <div>单价：{good.price}</div>
              <div>数量：*{good.number}</div>
              <h3 className='total'>￥{good.price*good.number}</h3>
            </Col>
          </Row>
          </a>
        )
      }
      <Button type="primary" size="large" className='btn-account' style={{float:'right'}} onClick={this.go_account}>去结算</Button>
      </Card>
      
    </div>
    	
    )
  }
}