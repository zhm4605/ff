
import {render} from 'react-dom';

import './style.less';

import Sider from 'componentsDir/admin/sider.jsx';
import MyCenter from 'componentsDir/admin/myCenter.jsx';

//React.Component
class Page extends React.Component{
  constructor(props) {
    super(props);
  }
  render() {
    return (
      <div>
        <header>
          <h1>管理系统 </h1>
          <MyCenter />
        </header>
        <Sider defaultOpenKeys='sortList' current='sortList'/>
        <div id='main'>
          {this.props.children}
        </div>
      </div>
    );
  }
};

import { Router, Route, hashHistory } from 'react-router';



const routes = <Router history={hashHistory}>
                <Route path="/" component={Page}>
                  <Route path="/addGood/:id" component={require('componentsDir/admin/addGood.jsx')}/>
                  <Route path="/addGood" component={require('componentsDir/admin/addGood.jsx')}/>
                  <Route path="/goodList" component={require('componentsDir/admin/goodList.jsx')}/>
                  <Route path="/sortList" component={require('componentsDir/admin/sortList.jsx')}/>
                </Route>
              </Router>

render(routes, document.getElementById('container'));


//window.location.hash = '#/addGood';

//console.log(window.location)

