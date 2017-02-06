import React from 'react';
import ReactDOM from 'react-dom';

import { Button, Menu, Dropdown, Icon } from 'antd';




export default class MyCenter extends React.Component{
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
    const menu = (
      <Menu onClick={this.handleClick}>
        <Menu.Item key="edit_password">修改密码</Menu.Item>
        <Menu.Item key="logout"><a href='/welcome/logout'>退出登录</a></Menu.Item>
      </Menu>
    );
    return (
      <Dropdown overlay={menu} >
        <a id="mycenter">
          hello,zz <Icon type="down" />
        </a>
      </Dropdown>
    );
  }
};

