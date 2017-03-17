import { Icon,Row,Col,Card,message,Button,Pagination} from 'antd';


export default class MyCenter extends React.Component{
  constructor(props) {
    super(props);
    this.state = {
      address_list:[],
      orders:false
    }

    const that = this;
    $.ajax({
      url: "/user/address_list/",
      dataType: "json",
      async: false,
      success:function(msg)
      {
        console.log(msg);
        if(msg.state==1)
        {
          that.state.address_list = msg.info;
        }
        else
        {
          message.info(msg.info);
          window.location.href="#/login?from="+encodeURIComponent(window.location.href);
        }
        
      },
      error:function(msg){
        console.log(msg);
        document.body.innerHTML = msg.responseText;
      }
    })
    
    this.removeAddress = this.removeAddress.bind(this);
    this.changeOrderPage = this.changeOrderPage.bind(this);
  }

  componentDidMount(){
    const that = this;
    $.ajax({
      url:"/order/order_list/",
      dataType:"json",
      async: false,
      success:function(msg)
      {
        console.log(msg);
        if(msg.state==1)
        {
          that.setState({orders:msg.info});
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
  changeOrderPage(page)
  {
    //console.log(e);
    const that = this;
    $.ajax({
      url:"/order/order_list/"+page,
      dataType:"json",
      async: false,
      success:function(msg)
      {
        console.log(msg);
        if(msg.state==1)
        {
          that.setState({orders:msg.info});
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
  removeAddress(i) {
    const {address_list} = this.state;
    const item = address_list[i];
    const that = this;
    $.ajax({
      url: "/user/remove_address/"+item.id,
      dataType: "json",
      async: false,
      success:function(msg)
      {
        console.log(msg);
        if(msg.state==1)
        {
          message.success(msg.info);
          address_list.splice(i, 1);
          that.setState({ address_list });
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
    const { address_list,orders } = this.state;
    console.log(orders);
    return (
    <div id='mycenter-page'>
      <Card className='card' title={<h2>个人中心</h2>} style={{'marginTop':20}} bordered={false} extra={<a href="javascript:history.go(-1)"><Button type="dashed">返回</Button></a>}>
        <Row gutter={16}>
          <Col span={8} className="gutter-row">
            <Card className='gutter-box card' title='个人资料' extra={<a href="#/user/add_address/0"><Button size='small'>新增收货地址</Button></a>}>
              <p>收货地址：</p>
              <ul className='address-list'>
                {
                  address_list.map((d,i)=>
                    <li key={d.id} className={d.default==0?'':'default'}>
                      <p>
                        <span className="name">{d.name}</span>
                        <span className="mobile">{d.mobile}</span>
                      </p>
                      <p>{d.areatext}</p>
                      <div className="execute">
                        <a className='remove' onClick={()=>this.removeAddress(i)}><Icon type="delete" /></a>
                        <a href={"#/user/add_address/"+d.id} className='edit'><Icon type="edit" /></a>
                      </div>
                    </li>
                  )
                }
              </ul>
            </Card>
          </Col>
          <Col span={16} className="gutter-row">
            <Card className='gutter-box card' title='我的订单'>
              <ul className='order-list'>
                {
                  orders&&orders.list.map((d,i)=>
                    <li key={d.id}>
                      <Row>
                        <Col span={8}>订单编号：{d.order_num}</Col>
                        <Col span={8} className='create_time'>生成时间：{d.create_time}</Col>
                        <Col span={8} className='state'>{d.state}</Col>
                      </Row>
                      <Row>
                        <Col span={4}>收货信息：</Col>
                        <Col span={20}>
                          <div className='address'>
                            <p><span className="name">{d.name}</span><span className="mobile">{d.mobile}</span></p>
                            <p className="area">{d.address}</p>
                          </div>
                        </Col>
                      </Row>
                      <ul className='item-list'>
                        {
                          d.items.map((item)=>
                            <li key={item.good_id}>
                              <a href={'#/good/'+item.good_id} target='_blank'>
                                <Row>
                                  <Col span={4} className='pic'><img src={item.good_pic} width='90%'/></Col>
                                  <Col span={16} className='name'>{item.good_name}</Col>
                                  <Col span={4} className='price'>
                                    <p>{item.unit_price}</p>
                                    <p>X{item.number}</p>
                                  </Col>
                                </Row>
                              </a>
                            </li>
                          )
                        }
                      </ul>
                      <div className='total-price'>合计：{d.total_price}</div>
                    </li>
                  )
                }
              </ul>
              {orders&&
              <Row>
                <Pagination style={{float:'right',marginTop:5}} current={parseInt(orders.page)} total={orders.total} defaultPageSize={orders.pageSize} onChange={this.changeOrderPage}/>
              </Row>
              }
            </Card>
          </Col>
        </Row>
      </Card>
    </div>	
    )
  }
}