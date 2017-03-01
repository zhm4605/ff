

import { Card,Tabs,Breadcrumb,message } from 'antd';

import { replaceUrlParams } from 'utilsDir/common.jsx';

import EditBasic from './good/editBasic.jsx';
import EditDescription from './good/editDescription.jsx'; 
import EditSort from './good/editSort.jsx'; 

const TabPane = Tabs.TabPane;

export default class AddGood extends React.Component{
  constructor(props) {
    super(props);
    this.getData = this.getData.bind(this);
    this.switchTab = this.switchTab.bind(this);

    this.state = this.getData(props);
  }
  componentDidMount(){
    //设置汇率
    /*
    $.ajax({
      url:"/common/get_rate/"+props.params.id,
      dataType:"json",
      async: false,
      success:function(msg)
      {
        that.data = msg;
      },
      error:function(msg){
        console.log(msg);
        document.body.innerHTML = msg.responseText;
      }
    })*/
  }
  componentWillReceiveProps(nextProps) {
    const good_id = nextProps.params.hasOwnProperty('id')?nextProps.params.id:0;
    if(good_id!=this.state.good_id)
    {
      this.setState(this.getData(nextProps));
    }
  }
  getData(props) {
    const query = props.location.query;
    const defaultActiveKey = query.nav?query.nav:"basic";

    const good_id = props.params.hasOwnProperty('id')?props.params.id:0;
    let data = {};
    if(good_id>0)
    {
      $.ajax({
        url:"/admin/good/goodDetails/"+good_id,
        dataType:"json",
        async: false,
        success:function(msg)
        {
          data = msg;
        },
        error:function(msg){
          console.log(msg);
          document.body.innerHTML = msg.responseText;
        }
      })
    }
    else if(defaultActiveKey!='basic')
    {
      //新增商品切换到basic
      this.switchTab(activeKey);
    }

    return {
      defaultActiveKey,
      activeKey: defaultActiveKey,
      data,
      good_id
    };
  }

  switchTab(activeKey) {
    this.setState({activeKey});
    window.location.href = replaceUrlParams(window.location.href,'nav',activeKey)
  }

  render() {
    const {data,good_id} = this.state;
    //const good_id = this.props.params.hasOwnProperty('id')?this.props.params.id:0;

    return (
      <Card title={good_id>0?
        <Breadcrumb separator='>'>
          <Breadcrumb.Item><a href="#/goodList">商品列表</a></Breadcrumb.Item>
          <Breadcrumb.Item><a >编辑商品</a></Breadcrumb.Item>
        </Breadcrumb>:"添加商品"}
        extra={<a href={"/home/#/good/"+good_id} target='_blank'>查看商品</a>}
      >
        <Tabs defaultActiveKey={this.state.defaultActiveKey} activeKey={this.state.activeKey} onTabClick={this.switchTab}>
          <TabPane tab="基本信息" key="basic">
            <EditBasic finish={(good_id)=>{this.switchTab("description",good_id)}} data={data} good_id={good_id}/>
          </TabPane>
          <TabPane tab="商品描述" key="description" disabled={good_id==0}>
            <EditDescription finish={()=>{this.switchTab("sorts")}} description={data.description} good_id={good_id}/>
          </TabPane>
          <TabPane tab="设置分类" key="sorts" disabled={good_id==0}>
            <EditSort finish={()=>{window.location.hash = '#/good'}} good_id={good_id} data={data}/>
          </TabPane>
        </Tabs>
      </Card>
     )
  }
}

//AddGood = Form.create({})(AddGood);<EditSort />
