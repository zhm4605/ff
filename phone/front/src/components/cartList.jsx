import { Breadcrumb,Icon,Row,Col,Card,message,Button,Input} from 'antd';
import {render} from 'react-dom';
import OrderTransfer from './common/orderTransfer.jsx';

export default class CartList extends React.Component{
  constructor(props) {
    super(props);
    this.state = {
      list:[],
      account:false
    }

    this.goAccount = this.goAccount.bind(this);
    this.editGood = this.editGood.bind(this);
    this.removeGood = this.removeGood.bind(this);
    this.cancelEditGood = this.cancelEditGood.bind(this);
    this.finishEditGood = this.finishEditGood.bind(this);
  }
  goAccount() {
    this.setState({'account':true});
  }
  componentDidMount(){
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
          that.setState({list:msg.info.list});
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
  changeNumber(e,i)
  {
    console.log(e.target.value);
    const {list} = this.state;
    list[i]['number'] = e.target.value; 
    this.setState({list});

    console.log(i);
  }
  editGood(i)
  {
    const {list} = this.state;
    list[i]['edit'] = true; 
    this.setState({list});
  }
  cancelEditGood(i)
  {
    const {list} = this.state;
    list[i]['edit'] = false; 
    this.setState({list});
  }
  finishEditGood(i)
  {
    const {list} = this.state;
    list[i]['edit'] = false; 
    //this.setState({list});
    const good = list[i];
    const data = {
      "number":good.number
    };
    const that = this;
    $.ajax({
      url:"/cart/update_good/"+good.id,
      dataType:"json",
      type:"post",
      data:data,
      success:function(msg)
      {
        console.log(msg);
        if(msg.state==1)
        {
          that.setState({list});
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
  removeGood(i)
  {
    const list = [...this.state.list];
    const good = list[i];
    list.splice(i, 1);
    const that = this;
    $.ajax({
      url:"/cart/remove_good/"+good.id,
      dataType:"json",
      success:function(msg)
      {
        console.log(msg);
        if(msg.state==1)
        {
          that.setState({ list });
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
    const { list,account } = this.state;
    return (
    <div id='cart-page'>
      <Card bordered={false} className='card' title={<h2>购物车</h2>} extra={<a href="javascript:history.go(-1)"><Button type="dashed">返回</Button></a>} style={{ width: '100%',minHeight:'500px',marginTop:'20px'}}>
      {list.length==0?
        <div className='no-good'>你的购物车空空的</div>
        :
      <div>
        <ul className='cart-good-list'>
        {
          list.map((good,i)=>
            <li className={'cart-item '+(good.edit?'edit':'')} key={good.good_id}>
              <Row>
                <Col span={3} className='pic'>
                  <a href={'/home/#/good/'+good.good_id} style={{cusor:'pointer'}}>
                    <img src={good.good_pic} width='100'/>
                  </a>
                </Col>
                <Col span={9} className='good-name'>
                  <a href={'/home/#/good/'+good.good_id} style={{cusor:'pointer'}}>
                    {good.good_name}
                  </a>
                </Col>
                {good.edit?
                  <Col span={4} className='price'>
                    <div>单价：{good.price}</div>
                    <div>数量: X <Input type='number' defaultValue={good.number} onChange={(e)=>this.changeNumber(e,i)} style={{width:80}}/></div>
                    <h3 className='total'>￥{good.price*good.number}</h3>
                  </Col>
                  :
                  <Col span={4} className='price'>
                    <div>单价：{good.price}</div>
                    <div>数量：X {good.number}</div>
                    <h3 className='total'>￥{good.price*good.number}</h3>
                  </Col>
                }
                {good.edit?'':
                <Col className="execute" span={4}>
                  <a className='remove' onClick={()=>this.removeGood(i)}><Icon type="delete" /></a>
                  <a className='edit' onClick={()=>this.editGood(i)}><Icon type="edit" /></a>
                </Col>
                }
              </Row>
              {good.edit?
                <div className='sure'>
                  <a onClick={()=>this.cancelEditGood(i)}><Button>取消</Button></a>
                  <a onClick={()=>this.finishEditGood(i)}><Button>完成</Button></a>
                </div>:''
              }
              
            </li>
          )
        }
        </ul>
        <Button type="primary" size="large" className='btn-account' style={{float:'right'}} onClick={this.goAccount}>去结算</Button>
      </div>}
      </Card>
      {account?
        <OrderTransfer list={list}/>
        :''}
    </div>
    	
    )
  }
}