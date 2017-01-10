import React from 'react';
import ReactDOM from 'react-dom';
import { Input, Select, Button, Icon } from 'antd';

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
      data.unshift({id:"0",name:"无"});
    },
    error:function(msg){
      //console.log(msg);
      document.body.innerHTML = msg.responseText;
    }
  })

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
  handleChange(value) {
    //this.setState({ value });
  }
  handleSearch(name) {
    //this.setState({ value: '5'});
  }
  render() {
    const options = data.map(d => <Option key={d.id}>{d.name}</Option>);

    return (
      <div className="ant-search-input-wrapper" style={this.props.style}>
          <Select
            showSearch
            placeholder={this.props.placeholder}
            onChange={this.handleChange}
            onSearch={this.handleSearch}
            defaultValue={this.state.hasOwnProperty('defaultValue')?this.state.defaultValue:'0'}
          >
            {options}
          </Select>
      </div>
    );
    
  }
};
