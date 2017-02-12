import React from 'react';

import { Menu, Icon } from 'antd';


const SubMenu = Menu.SubMenu;
const MenuItemGroup = Menu.ItemGroup;

export default class Sider extends React.Component{
  constructor(props) {
    super(props);
    this.state = props;
    this.handleClick = this.handleClick.bind(this);
  }
  handleClick(e) {
    /*this.setState({
      current: e.key,
    });*/
    //window.location.hash = '#/'+e.key;
  }
  render() {
    //console.log(this.props);
    const key = window.location.hash.substring(2);
    //console.log(key);
    return (
        <Menu onClick={this.handleClick}
          style={{ width: 150 }}
          defaultOpenKeys={['good']}
          selectedKeys={[key]}
          mode="inline"
          id='sider' >
          <SubMenu key="good" title={<span><Icon type="mobile" /><span>商品管理</span></span>}>
            <Menu.Item key="goodList"><a href="#/goodList">商品列表</a></Menu.Item>
            <Menu.Item key="addGood"><a href="#/addGood">添加商品</a></Menu.Item>
          </SubMenu>
          <Menu.Item key="sortList"><a href="#/sortList"><Icon type="appstore" />分类管理</a></Menu.Item>
          <SubMenu key="home" title={<span><Icon type="home" /><span>首页设置</span></span>}>
            <Menu.Item key="slide"><a href="#/slide">轮播图</a></Menu.Item>
            <Menu.Item key="hotGood"><a href="#/hotGood">热门商品</a></Menu.Item>
          </SubMenu>
          <SubMenu key="chart" title={<span><Icon type="line-chart" /><span>统计报表</span></span>}>
            <Menu.Item key="">浏览量</Menu.Item>
          </SubMenu>
          <Menu.Item key="gohome"><a href='/home#/home' target='_blank'><Icon type="home" />站点首页</a></Menu.Item>
        </Menu>
    );
  }
};

