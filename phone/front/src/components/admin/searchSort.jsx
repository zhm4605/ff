import React from 'react';
import ReactDOM from 'react-dom';
import { Input, Select, Button, Icon } from 'antd';

const Option = Select.Option;

export default class SearchSort extends React.Component{
  constructor(props) {
    super(props);
    this.state = {
      data: [],
      value: props.value,
      focus: false,
    };
    this.handleSubmit = this.handleSubmit.bind(this);
    this.handleChange = this.handleChange.bind(this);
    this.handleFocus = this.handleFocus.bind(this);
    this.handleBlur = this.handleBlur.bind(this);
  }
  handleChange(value) {
    this.setState({ value });
    const data = [
      {
        value:1,
        text:"红色"
      },
      {
        value:2,
        text:"白色"
      }
    ];
    this.setState({data});
    //fetch(value, data => this.setState({ data }));
  }
  handleSubmit() {
    console.log('输入框内容是: ', this.state.value);
  }
  handleFocus() {
    this.setState({ focus: true });
  }
  handleBlur() {
    this.setState({ focus: false });
  }
  render() {
    /*
    const btnCls = classNames({
      'ant-search-btn': true,
      'ant-search-btn-noempty': !!this.state.value.trim(),
    });
    const searchCls = classNames({
      'ant-search-input': true,
      'ant-search-input-focus': this.state.focus,
    });*/
    const options = this.state.data.map(d => <Option key={d.value}>{d.text}</Option>);
    return (
      <div className="ant-search-input-wrapper" style={this.props.style}>
        <Input.Group className="ant-search-input ant-search-input-focus">
          <Select
            combobox
            value={this.state.value}
            placeholder={this.props.placeholder}
            notFoundContent=""
            defaultActiveFirstOption={false}
            showArrow={false}
            filterOption={false}
            onChange={this.handleChange}
            onFocus={this.handleFocus}
            onBlur={this.handleBlur}
          >
            {options}
          </Select>
          <div className="ant-input-group-wrap">
            <Button className="ant-search-btn" onClick={this.handleSubmit}>
              <Icon type="search" />
            </Button>
          </div>
        </Input.Group>
      </div>
    );
  }
};
