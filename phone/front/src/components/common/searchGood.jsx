import { Input } from 'antd';

const Search = Input.Search;

export default class SearchGood extends React.Component{
	constructor(props) {
    super(props);
    this.handleSearch = this.handleSearch.bind(this);
  }
  handleSearch()
  {

  }
  render() {
    return (
    	<Search
          className='search-good'
          placeholder="请输入商品名称"
          onSearch={this.handleSearch}
        />
  	)
  }

}