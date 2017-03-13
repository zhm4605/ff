import { Icon,Row,Col,Card,message,Button} from 'antd';


export default class MyCenter extends React.Component{
  constructor(props) {
    super(props);
    this.state = {
      address_list:[]
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
          that.state = ({
            address_list:msg.info
          })
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
    
    this.removeAddress = this.removeAddress.bind(this);
  }

  componentDidMount(){
    
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
    const { address_list } = this.state;
    return (
    <div id='mycenter-page'>
      <Card className='card' title={<h2>个人中心</h2>} style={{'marginTop':20}} bordered={false}>
        <Row>
          <Col span={11}>
            <Card className='card' title='个人资料' extra={<a href="#/user/add_address/0"><Button size='small'>新增收货地址</Button></a>}>
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
          <Col span={1}></Col>
          <Col span={12}>
            <Card className='card' title='我的订单'>
              <ul>
              </ul>
            </Card>
          </Col>
        </Row>
      </Card>
    </div>	
    )
  }
}