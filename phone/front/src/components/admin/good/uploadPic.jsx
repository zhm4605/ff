import { Upload, Icon, Modal, message } from 'antd';

export default class PicturesWall extends React.Component {
  constructor(props)
  {
    super(props);
    this.state = {
      previewVisible: false,
      previewImage: '',
      fileList: props.fileList||[],
      text: '',
      good_id: props.good_id
    };

    this.handleChange = this.handleChange.bind(this);
    this.handlePreview = this.handlePreview.bind(this);
    this.handleCancel = this.handleCancel.bind(this);
    this.handleRemove = this.handleRemove.bind(this);
    this.triggerChange = this.triggerChange.bind(this);
  }
  componentWillReceiveProps(nextProps) {
    if(nextProps.good_id!=this.state.good_id)
    {
      this.setState({
        previewVisible: false,
        previewImage: '',
        fileList: nextProps.fileList||[],
        text: '',
        good_id: nextProps.good_id
      });
    }
    
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
  handleRemove(file)
  {
    //console.log(info);
     $.ajax({
      url:"/admin/good/removePic/"+file.uid,
      dataType:"json",
      success:function(msg)
      {

      },
      error:function(msg){
        document.body.innerHTML = msg.responseText;
      }
    })
  }

  handleChange(info){
    let {file,fileList} = info;
    fileList = fileList.map((file) => {
      if (file.response) {
        file.url = file.response.url;
        file.thumbUrl = file.response.thumbUrl;
        //file.uid = file.response.id;
      }
      return file;
    });

    fileList = fileList.filter((file) => {
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
      let list = [];
      fileList.map((file,i) => {
        list[i] = {};
        list[i]["url"] = file.url; 
      });
      onChange(list);
    }
  }

  render() {
    const { previewVisible, previewImage, fileList, good_id } = this.state;
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
          action={"/admin/good/uploadPic/"+good_id}
          listType="picture-card"
          fileList={fileList}
          onPreview={this.handlePreview}
          onChange={this.handleChange}
          onRemove={this.handleRemove}
          multiple
        >
          {fileList.length >= 5 ? null : uploadButton}
        </Upload>
        <Modal visible={previewVisible} footer={null} onCancel={this.handleCancel}>
          <img alt="example" style={{ width: '100%' }} src={previewImage} />
        </Modal>
      </div>
    );
  }
}