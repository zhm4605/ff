
import {render} from 'react-dom';

import { addLocaleData, IntlProvider, FormattedMessage } from 'react-intl';


import intl from 'intl';
//addLocaleData([...en,...zh]);
import './style.less';

import { Menu, Icon, Select } from 'antd';
const SubMenu = Menu.SubMenu;
const MenuItemGroup = Menu.ItemGroup;
const {Option} = Select;

class Page extends React.Component{
  constructor(props) {
    super(props);

  }
  toggleLang(value)
  {
    window.location.hash = window.location.hash.split('?')[0]+'?lang='+value;
  }
  render() {
    //console.log(this.props);
    const query = this.props.location.query;
    const lang = query.lang?query.lang:'zh-CN';
    //const lang = 'zh-CN'; 
    return (
      <IntlProvider 
            locale='en'
            messages={require('../../language/'+lang+'.js')}
        >
      <div className="layout">
        <header>
          <div className="logo">logo</div>
         <Menu mode="horizontal" className='menu'>
            <Menu.Item key="home">
              <a href='#/home'><Icon type="home" /><FormattedMessage id='home'/></a>
            </Menu.Item>
            <SubMenu title={<span><a href='#/list'><Icon type="mobile" /><FormattedMessage id='phone_brand'/></a></span>}>
                <Menu.Item key="setting:1"><a href='#/list'>苹果</a></Menu.Item>
            </SubMenu>
            <Menu.Item key="alipay">
              <a href="#/list" target="_blank" rel="noopener noreferrer"><Icon type="like" /><FormattedMessage id='hot_good'/></a>
            </Menu.Item>
          </Menu>
          <Select className='toggle-language' onChange={this.toggleLang} defaultValue={lang}>
            <Option value='zh-CN'><FormattedMessage id='lang_zh'/></Option>
            <Option value='en-US'><FormattedMessage id='lang_en'/></Option>
          </Select>
        </header>
        <div className='content'>{this.props.children}</div>
        <footer style={{ textAlign: 'center' }}>版权所有</footer>
      </div>
      </IntlProvider>
    );
  }
};

import { Router, Route, hashHistory } from 'react-router';



const routes = <Router history={hashHistory}>
                  <Route path="/" component={Page}>
                    <Route path="/home" component={require('componentsDir/home.jsx')}/>
                    <Route path="/good/:id" component={require('componentsDir/good.jsx')}/>
                    <Route path="/list" component={require('componentsDir/list.jsx')}/>
                    <Route path="/register" component={require('componentsDir/register.jsx')}/>
                    <Route path="/login" component={require('componentsDir/login.jsx')}/>
                  </Route>
              </Router>

render(routes, document.getElementById('container'));

//window.location.hash = '#/home';

//console.log(window.location)

