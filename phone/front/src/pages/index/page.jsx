import React from 'react';
import ReactDOM from 'react-dom';

import { Button, Menu, Dropdown, Icon } from 'antd';

import './style.less';

import Sider from 'componentsDir/admin/sider.jsx';
import MyCenter from 'componentsDir/admin/myCenter.jsx';


class Page extends React.Component{
  constructor(props) {
    super(props);
    this.state = {
      defaultOpenKeys: 'good',
      current: 'good_list',
    };

    this.handleClick = this.handleClick.bind(this);
  }
  handleClick(e) {
    //console.log('click ', e);
    this.setState({
      current: e.key,
    });
  }
  render() {
    
    return (
      <div>
        <header>
          <h1>管理系统 </h1>
          <MyCenter />
        </header>
        <Sider defaultOpenKeys='sort' current='sortList'/>
        <div id='main'>
        </div>
      </div>
    );
  }
};

ReactDOM.render(<Page />, document.getElementById('container'));
