import { Menu, Icon } from 'antd';
import { replaceUrlParams } from 'utilsDir/common.jsx';
const SubMenu = Menu.SubMenu;
const MenuItemGroup = Menu.ItemGroup;

export default class Category extends React.Component{
  constructor(props) {
    super(props);
    console.log(props);
   
    this.state = {
      selectedKeys:props.selectedKeys,
      activeKey:this.get_activeKey(props.selectedKeys)
    }

    const that = this;
    $.ajax({
      url:"/common/get_category",
      dataType:"json",
      async: false,
      success:function(msg)
      {
      	console.log(msg);
        that.data = msg;
      },
      error:function(msg){
        console.log(msg);
        document.body.innerHTML = msg.responseText;
      }
    })
    
    this.switchCatgory = this.switchCatgory.bind(this);
  }
  get_activeKey(selectedKeys)
  {
    //console.log(selectedKeys);
    const arr = selectedKeys[0]?selectedKeys[0].split(","):[];
    return arr[0]?arr[0]:'';
  }
  switchCatgory(e)
  {
    const category = e.key;
    window.location.href = replaceUrlParams(window.location.href,'category',category);
    this.setState({
      selectedKeys:[category],
      activeKey:this.get_activeKey([category])
    });

    const onChanged = this.props.onChanged;
    onChanged&&onChanged(category);

  }

  render() {
    const {selectedKeys,activeKey}=this.state;
    console.log(activeKey);
    const data = this.data;
    const loop = data => data.map((d,i)=>{
      const ids = [...d.parent_ids,d.id].join(',');
      if (d.children.length>0) {
        return (
          <SubMenu key={ids} title={<span>{d.name}</span>} onTitleClick={this.switchCatgory}>
            {loop(d.children)}
          </SubMenu>
        );
      }

      return <Menu.Item key={ids}>{d.name}</Menu.Item>;
    })
    let defaultOpenKeys  = [];
    data.map((d,i)=>{
      defaultOpenKeys.push(d.id)
    })
    return (
    	<Menu onClick={this.switchCatgory} mode="vertical" selectedKeys={selectedKeys} activeKey={activeKey}>
        <Menu.Item key="0">所有分类</Menu.Item>
        {loop(data)}
      </Menu>
    )
  }
}