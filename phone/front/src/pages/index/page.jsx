
import {render} from 'react-dom';

import { addLocaleData, IntlProvider, FormattedMessage } from 'react-intl';
import intl from 'intl';

import './style.less';

import { Menu, Icon, Select } from 'antd';
const SubMenu = Menu.SubMenu;
const MenuItemGroup = Menu.ItemGroup;
const {Option} = Select;


import Header from 'componentsDir/common/header.jsx';
class Page extends React.Component{
  constructor(props) {
    super(props);

  }
  render() {
    const query = this.props.location.query;
    const lang = query.lang?query.lang:'zh-CN';
    return (
      <IntlProvider locale='en'messages={require('../../language/'+lang+'.js')}>
        <div className="layout">
          <Header lang={lang}/>
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

