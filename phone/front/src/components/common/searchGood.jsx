import { Input } from 'antd';

const Search = Input.Search;

export default class SearchGood extends React.Component{
	constructor(props) {
    super(props);
    this.handleSearch = this.handleSearch.bind(this);
  }
  handleSearch(name)
  {
    const onSearch = this.props.onSearch;
    onSearch&&onSearch(name);
  }
  render() {
    return (
    	<Search
          className='search-good'
          placeholder="搜索商品名称"
          onSearch={this.handleSearch}
          defaultValue={this.props.value}
        />
  	)
  }

}