import { Icon,Row,Col,Card,message,Button} from 'antd';


export default class OrderTransfer extends React.Component{
  constructor(props) {
    super(props);
    const that = this;
    $.ajax({
      url:"/user/address_list/",
      dataType:"json",
      async: false,
      success:function(msg)
      {
        console.log(msg);
        if(msg.state==1)
        {
          const address_list = msg.info;
          let address_id = 0;
          address_list.map((d)=>
            {
              if(d.default==1)
              {
                address_id = d.id;
              }
            }
          )
          that.state = {
            address_list,address_id
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
    this.create_order = this.create_order.bind(this);
    this.change_address = this.change_address.bind(this);
  }
  goBack()
  {
    $('#account-page').remove();
  }
  change_address(address_id)
  {
    this.setState({address_id});
  }
  create_order()
  {
    const { address_id } = this.state;
    const data = {
      address_id,
      list: this.props.list
    };
    $.ajax({
      url:"/order/create_order/",
      dataType:"json",
      type:"post",
      data:data,
      success:function(msg)
      {
        console.log(msg);
        if(msg.state==1)
        {

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
  }
  render() {
    const { list } = this.props;
    const { address_list,address_id } = this.state;
    return (
    <div id='account-wrap'>
      <Card className='card' title={<h2>确认订单</h2>} extra={<Button type="dashed" onClick={this.goBack}>返回</Button>} bordered={false}>
      <Row className='choose-address-list' gutter={10}>
        {
          address_list.map((d,i)=>
            <Col key={d.id} className='gutter-row ' span={6}>
              <div className={'gutter-box item '+(d.id==address_id?'choosed':'')} onClick={()=>this.change_address(d.id)}>
                <p>
                  <span className="name">{d.name}</span>
                  <span className="mobile">{d.mobile}</span>
                </p>
                <p>{d.areatext}</p>
              </div>
            </Col>
          )
        }
        <Col className='gutter-row add' span={6} key='0'>
          <div className="gutter-box item">添加收货地址</div>
        </Col>
      </Row>
      <div className='order-transfer-list'>
        {
          //商品列表
          list.map((good,i)=>
            <Row className='item' key={good.id}>
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
          )
        }
      </div>
      <div className='amount'>合计：</div>
      <Row>
          <Button type="primary" size="large" className='btn-submit-order' onClick={this.create_order} style={{float:'right','marginTop':5}}>提交订单</Button>
      </Row>
      </Card>
    </div>
    	
    )
  }
}