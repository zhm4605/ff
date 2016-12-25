import React from 'react';
import ReactDOM from 'react-dom';
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
    this.setState({
      current: e.key,
    });
    this.renderMain(e.key);
  }
  renderMain(key)
  {
    let Page = require("./"+key+".jsx");
    ReactDOM.render(<Page />, document.getElementById('main'));
  }
  componentDidMount()
  {
    this.renderMain(this.state.current);
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
            <Menu.Item key="goodList">商品列表</Menu.Item>
            <Menu.Item key="addGood">添加商品</Menu.Item>
          </SubMenu>
          <Menu.Item key="sortList"><span><Icon type="appstore" /><span>分类管理</span></span></Menu.Item>
          <SubMenu key="home" title={<span><Icon type="home" /><span>首页设置</span></span>}>
            <Menu.Item key="slide">轮播图</Menu.Item>
            <Menu.Item key="hotGood">热门商品</Menu.Item>
          </SubMenu>
          <SubMenu key="chart" title={<span><Icon type="line-chart" /><span>统计报表</span></span>}>
            <Menu.Item key="">浏览量</Menu.Item>
          </SubMenu>
        </Menu>
    );
  }
};

