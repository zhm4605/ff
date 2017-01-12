

import { Upload, Icon, Modal, message } from 'antd';

export default class UploadPic extends React.Component {
  constructor(props)
  {
    super(props);
    this.state = {
      previewVisible: false,
      previewImage: '',
      fileList: [{
        uid: -1,
        name: 'xxx.png',
        status: 'done',
        url: 'https://zos.alipayobjects.com/rmsportal/jkjgkEfvpUPVyRjUImniVslZfWPnJuuZ.png',
      }],
      text: ''
    };

    this.handlePreview = this.handlePreview.bind(this);
    this.handleCancel = this.handleCancel.bind(this);
    this.handleChange = this.handleChange.bind(this);
    this.handleRemove = this.handleRemove.bind(this);
  }

  handleCancel() {
    this.setState({ previewVisible: false })
  }

  handlePreview(file) {
    this.setState({
      previewImage: file.url || file.thumbUrl,
      previewVisible: true,
    });
  }

  handleChange(info) {
    this.setState({ fileList: info.fileList })

    if(info.file.status=='done')
    {
      console.log(info);
      this.setState({
        text: '提示'+info.file.response,
        previewVisible: true,
      });
    }
    
  }

  handleRemove(file) {
    console.log(file);
  }

  render() {
    const { previewVisible, previewImage, fileList, text } = this.state;
    const uploadButton = (
      <div>
        <Icon type="plus" />
        <div className="ant-upload-text">Upload</div>
      </div>
    );
    return (
      <div className="clearfix">
        <Upload
          multiple
          accept="image/*"
          action="/?app=home&act=upload"
          listType="picture-card"
          fileList={fileList}
          onPreview={this.handlePreview}
          onChange={this.handleChange}
          onRemove={this.handleRemove}
        >
          {fileList.length >= 3 ? null : uploadButton}
        </Upload>
        <Modal visible={previewVisible} footer={null} onCancel={this.handleCancel}>
          <img alt="example" style={{ width: '100%' }} src={previewImage} />
          <div>{text}</div>
        </Modal>
      </div>
    );
  }
}

