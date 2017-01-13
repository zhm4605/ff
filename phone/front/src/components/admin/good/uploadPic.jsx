

import { Upload, Icon, Modal, message } from 'antd';

/*
  [{
        uid: -1,
        name: 'xxx.png',
        status: 'done',
        url: 'https://zos.alipayobjects.com/rmsportal/jkjgkEfvpUPVyRjUImniVslZfWPnJuuZ.png',
      }]
*/

export default class UploadPic extends React.Component {
  constructor(props)
  {
    super(props);
    this.state = {
      previewVisible: false,
      previewImage: '',
      fileList: props.fileList||[],
      text: ''
    };

    this.handlePreview = this.handlePreview.bind(this);
    this.handleCancel = this.handleCancel.bind(this);
    this.handleChange = this.handleChange.bind(this);
    this.handleRemove = this.handleRemove.bind(this);
    this.triggerChange = this.triggerChange.bind(this);
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
    //this.setState({ fileList: info.fileList })
    console.log(info);
    if(info.file.status=='done')
    {
      console.log(info);
      //const fileList = this.state.fileList.push
      //this.setState({fileList},this.triggerChange());

      document.body.innerHTML=info.file.response;
    }
    
  }

  handleRemove(file) {
    console.log(file);
  }

  triggerChange(){
    // Should provide an event to pass value to Form.
    const onChange = this.props.onChange;
    if (onChange) {
      onChange(this.state.fileList);
    }
  }

  render() {
    const { previewVisible, previewImage, fileList, text } = this.state;
    const uploadButton = (
      <div>
        <Icon type="plus" />
        <div className="ant-upload-text">上传图片</div>
      </div>
    );
    return (
      <div className="clearfix">
        <Upload
          multiple
          accept="image/*"
          action="/admin_good/uploadPic"
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

