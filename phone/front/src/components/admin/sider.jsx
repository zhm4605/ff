import React from 'react';
import ReactDOM from 'react-dom';
import { Menu, Icon } from 'antd';


const SubMenu = Menu.SubMenu;
const MenuItemGroup = Menu.ItemGroup;

export default class Sider extends React.Component{
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
        <Menu onClick={this.handleClick}
          style={{ width: 150 }}
          defaultOpenKeys={[this.state.defaultOpenKeys]}
          selectedKeys={[this.state.current]}
          mode="inline"
         id='sider' >
          <SubMenu key="good" title={<span><Icon type="mobile" /><span>商品管理</span></span>}>
            <Menu.Item key="good_list">商品列表</Menu.Item>
            <Menu.Item key="add_good">添加商品</Menu.Item>
          </SubMenu>
          <SubMenu key="sort" title={<span><Icon type="appstore" /><span>分类管理</span></span>}>
            <Menu.Item key="add_aort">添加分类</Menu.Item>
          </SubMenu>
          <SubMenu key="home" title={<span><Icon type="home" /><span>首页设置</span></span>}>
            <Menu.Item key="slide">轮播图</Menu.Item>
            <Menu.Item key="hot_good">热门商品</Menu.Item>
          </SubMenu>
          <SubMenu key="chart" title={<span><Icon type="line-chart" /><span>统计报表</span></span>}>
          </SubMenu>
        </Menu>
    );
  }
};

//ReactDOM.render(<Sider />, document.getElementById('container'));
