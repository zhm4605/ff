import { addLocaleData, IntlProvider, FormattedMessage } from 'react-intl';
import intl from 'intl';

import { Menu, Icon, Select, Dropdown } from 'antd';
const SubMenu = Menu.SubMenu;
const MenuItemGroup = Menu.ItemGroup;
const {Option} = Select;



export default class header extends React.Component{
	constructor(props) {
    super(props);
    this.logout = this.logout.bind(this);
    this.handleClick = this.handleClick.bind(this);

    this.state = {
    	login:login(),
    }
  }
  componentWillReceiveProps() {
    this.setState({login:login()});
  }
  toggleLang(value)
  {
    window.location.hash = window.location.hash.split('?')[0]+'?lang='+value;
  }
  handleClick(e)
  {
  	if(e.key=='logout')
  	{
  		this.logout();
  	}
  }
  logout()
  {
  	const that = this;
  	$.ajax({
	    url:"/register/logout",
	    dataType:"json",
	    success:function(login)
	    {
	    	//that.setState({login});
        window.location.href='#/login';
	    },
	    error:function(msg){
	      document.body.innerHTML = msg.responseText;
	    }
	  })
  }
  render() {
  	const {lang} = this.props;
  	const {login} = this.state;

  	return(
  		<header>
        <div className="logo">logo</div>
        <Menu mode="horizontal" className='menu'>
          <Menu.Item key="home">
            <a href='#/home'><Icon type="home" /><FormattedMessage id='home'/></a>
          </Menu.Item>
          <SubMenu title={<span><a href='#/list'><Icon type="mobile" /><FormattedMessage id='phone_brand'/></a></span>}>
              <Menu.Item key="setting:1"><a href='#/list'>苹果</a></Menu.Item>
          </SubMenu>
          <Menu.Item key="hot">
            <a href="#/list"><Icon type="like" /><FormattedMessage id='hot_good'/></a>
          </Menu.Item>
        </Menu>
        <div className='pull-right'>
	        {//切换语言
	        }
	        <Select className='toggle-language' onChange={this.toggleLang} defaultValue={lang}>
	          <Option value='zh-CN'><FormattedMessage id='lang_zh'/></Option>
	          <Option value='en-US'><FormattedMessage id='lang_en'/></Option>
	        </Select>
	        <div className='my'>
	        {//登录状态
	        	login.state==1?
	        		<Dropdown overlay={
	        			 <Menu onClick={this.handleClick}>
                  <Menu.Item key="cart"><a href="#/cart">购物车</a></Menu.Item>
					        <Menu.Item key="mycentr"><a href="#/mycenter">个人中心</a></Menu.Item>
					        <Menu.Item key="logout" onClick={this.logout}>退出登录</Menu.Item>
					      </Menu>
	        		} >
			          <a>
			            hello,{login.info.name}<Icon type="down" />
			          </a>
			        </Dropdown>
	        	:<span><a href={'#/login?from='+encodeURIComponent(window.location.href)}><FormattedMessage id='login'/></a> | <a href='#/register'><FormattedMessage id='register'/></a></span>
	        }
	        </div>
        </div>
      </header>
  	)
  }
}

function login()
{
	let login = {};
	$.ajax({
    url:"/home/get_login_state",
    dataType:"json",
    async: false,
    success:function(msg)
    {
      console.log(msg);
      login = msg;
    },
    error:function(msg){
      document.body.innerHTML = msg.responseText;
    }
  })
	return login;
}