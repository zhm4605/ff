import { Upload, Icon, Modal, message } from 'antd';

export default class PicturesWall extends React.Component {
  constructor(props)
  {
    super(props);
    this.state = {
      previewVisible: false,
      previewImage: '',
      fileList: props.fileList||[],
      text: ''
    };

    this.handleChange = this.handleChange.bind(this);
    this.handlePreview = this.handlePreview.bind(this);
    this.handleCancel = this.handleCancel.bind(this);
    //this.handleRemove = this.handleRemove.bind(this);
    this.triggerChange = this.triggerChange.bind(this);
  }

  handleCancel() {
    this.setState({ previewVisible: false })
  }
  handlePreview(file){
    this.setState({
      previewImage: file.url || file.thumbUrl,
      previewVisible: true,
    });
  }

  handleChange(info){
    let fileList = info.fileList;


    // 2. read from response and show file link
    fileList = fileList.map((file) => {
      if (file.response) {
        // Component will show file.url as link
        file.url = file.response.url;
        file.thumbUrl = file.response.thumbUrl;
      }
      return file;
    });

    // 3. filter successfully uploaded files according to response from server
    fileList = fileList.filter((file) => {
      console.log(file.response);
      if (file.response) {
        return file.response.state == '1';
      }
      return true;
    });

    this.setState({ fileList },this.triggerChange);
  }

  triggerChange(){
    // Should provide an event to pass value to Form.
    const onChange = this.props.onChange;
    const fileList = this.state.fileList;
    if (onChange) {
      onChange(fileList);
    }
  }

  render() {
    const { previewVisible, previewImage, fileList } = this.state;
    const uploadButton = (
      <div>
        <Icon type="plus" />
        <div className="ant-upload-text">Upload</div>
      </div>
    );
    return (
      <div className="clearfix">
        <Upload
          accept="image/jpeg,image/png,image/jpg"
          action="/admin_good/uploadPic"
          listType="picture-card"
          fileList={fileList}
          onPreview={this.handlePreview}
          onChange={this.handleChange}
          multiple
        >
          {fileList.length >= 3 ? null : uploadButton}
        </Upload>
        <Modal visible={previewVisible} footer={null} onCancel={this.handleCancel}>
          <img alt="example" style={{ width: '100%' }} src={previewImage} />
        </Modal>
      </div>
    );
  }
}