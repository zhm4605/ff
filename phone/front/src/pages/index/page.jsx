
import {render} from 'react-dom';

import './style.less';

import { Menu, Icon } from 'antd';
const SubMenu = Menu.SubMenu;
const MenuItemGroup = Menu.ItemGroup;

class Page extends React.Component{
  constructor(props) {
    super(props);
  }
  render() {
    return (
      <div className="layout">
        <header>
          <div className="logo">logo</div>
           <Menu mode="horizontal" className='menu'>
              <Menu.Item key="home">
                <a href='#/home'><Icon type="home" />首页</a>
              </Menu.Item>
              <SubMenu title={<span><a href='#/list'><Icon type="mobile" />手机</a></span>}>
                  <Menu.Item key="setting:1"><a href='#/list'>苹果</a></Menu.Item>
              </SubMenu>
              <Menu.Item key="alipay">
                <a href="#/list" target="_blank" rel="noopener noreferrer"><Icon type="like" />热门</a>
              </Menu.Item>
            </Menu>
        </header>
        <div className='content'>{this.props.children}</div>
        <footer style={{ textAlign: 'center' }}>版权所有</footer>
      </div>
    );
  }
};

import { Router, Route, hashHistory } from 'react-router';



const routes = <Router history={hashHistory}>
                  <Route path="/" component={Page}>
                    <Route path="/home" component={require('componentsDir/home.jsx')}/>
                    <Route path="/good/:id" component={require('componentsDir/good.jsx')}/>
                    <Route path="/list" component={require('componentsDir/list.jsx')}/>
                  </Route>
              </Router>

render(routes, document.getElementById('container'));

//window.location.hash = '#/home';

//console.log(window.location)

