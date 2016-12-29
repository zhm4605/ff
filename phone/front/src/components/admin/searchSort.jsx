import React from 'react';
import ReactDOM from 'react-dom';
import { Input, Select, Button, Icon } from 'antd';

const Option = Select.Option;

export default class SearchSort extends React.Component{
  constructor(props) {
    super(props);
    this.state = {
      data: [],
      focus: false
    };
    this.handleChange = this.handleChange.bind(this);
    this.handleSearch = this.handleSearch.bind(this);
  }
  handleChange(value) {
    this.setState({ value });
  }
  handleSearch(name) {
    const data = [
      {
        id:1,
        name:"红色"
      },
      {
        id:2,
        name:"白色"
      }
    ];
    this.setState({data});
  }
  render() {
    const options = this.state.data.map(d => <Option key={d.id}>{d.name}</Option>);
    return (
      <div className="ant-search-input-wrapper" style={this.props.style}>
          <Select
            showSearch
            placeholder={this.props.placeholder}
            optionFilterProp="children"
            onChange={this.handleChange}
            onSearch={this.handleSearch}
          >
            {options}
          </Select>
      </div>
    );
  }
};
