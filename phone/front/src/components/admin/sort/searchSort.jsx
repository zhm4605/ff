import { Input, Select, Button, Icon, Cascader } from 'antd';

const Option = Select.Option;

let data = []; 
$.ajax({
  url:"/admin_sort/sortList/true",
  dataType:"json",
  async: false,
  success:function(msg)
  {
    console.log(msg);
    data = msg;
  },
  error:function(msg){
    //console.log(msg);
    document.body.innerHTML = msg.responseText;
  }
})


//数组中的 id->value name->label  const loop = data =>
function changeKey(list)
{ 
  list.forEach(function(item, index, arr){
    arr[index]["value"] = arr[index]["id"];
    arr[index]["label"] = arr[index]["name"];
    if(item.children&&item.children.length>0)
    {
      changeKey(item.children);
    }
  })
  return list;
}

export default class SearchSort extends React.Component{
  constructor(props) {
    super(props);
    this.state = {
      focus: false,
      defaultValue: props.value
    };

    this.handleChange = this.handleChange.bind(this);
    this.handleSearch = this.handleSearch.bind(this);
  }
  componentWillReceiveProps(nextProps) {
    this.setState({ defaultValue: nextProps.value});
  }
  handleChange(value,label) {
    const onChoosed = this.props.onChoosed;
    if(onChoosed)
    {
      onChoosed(value,label);
    }
    console.log(value);
    const onChange = this.props.onChange;
    if (onChange) {
      onChange(value);
    }
  }
  handleSearch(name) {
  }
  render() {
    const options = changeKey(this.props.list||data);
    //console.log(options);
    //defaultValue={this.state.hasOwnProperty('defaultValue')?this.state.defaultValue:[]}
    return (
      <div className="ant-search-input-wrapper" style={this.props.style}>
        <Cascader
          options={options}
          onChange={this.handleChange}
          placeholder={this.props.placeholder}
          showSearch
          style={{width:'100%'}}
          expandTrigger='hover'
          value={this.props.value}
          changeOnSelect
        />
      </div>
    );
    
  }
};
