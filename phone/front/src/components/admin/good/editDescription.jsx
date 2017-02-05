

import { Button } from 'antd';

export default class AddGood extends React.Component{
  constructor(props) {
    super(props);
    this.handleSubmit = this.handleSubmit.bind(this);
  }
  componentDidMount(){
        const editor = UE.getEditor("content", {
             //工具栏
                toolbars: [[
                    'fullscreen', 'source', '|', 'undo', 'redo', '|',
                    'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch',  
                    '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
                    'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
                    'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
                    'directionalityltr', 'directionalityrtl', 'indent', '|',
                    'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|', 
                    'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
                    'simpleupload',  
                    'horizontal', 'date', 'time',  
                ]]
                ,lang:"zh-cn"
                //字体
                ,'fontfamily':[
                   { label:'',name:'songti',val:'宋体,SimSun'},
                   { label:'',name:'kaiti',val:'楷体,楷体_GB2312, SimKai'},
                   { label:'',name:'yahei',val:'微软雅黑,Microsoft YaHei'},
                   { label:'',name:'heiti',val:'黑体, SimHei'},
                   { label:'',name:'lishu',val:'隶书, SimLi'},
                   { label:'',name:'andaleMono',val:'andale mono'},
                   { label:'',name:'arial',val:'arial, helvetica,sans-serif'},
                   { label:'',name:'arialBlack',val:'arial black,avant garde'},
                   { label:'',name:'comicSansMs',val:'comic sans ms'},
                   { label:'',name:'impact',val:'impact,chicago'},
                   { label:'',name:'timesNewRoman',val:'times new roman'}
                ]
                //字号
                ,'fontsize':[10, 11, 12, 14, 16, 18, 20, 24, 36]
                , enableAutoSave : false
                , autoHeightEnabled : false
                , initialFrameHeight: 600
                , initialFrameWidth: '100%'
                ,readonly:this.props.disabled
        });
        //this.setState({editor});
        this.editor  = editor;
        let me = this;
        editor.ready( function( ueditor ) {
            let description = me.props.description?me.props.description:'<p></p>';
            editor.setContent(description); 
        }); 
    }
  handleSubmit() {
    console.log(this.editor.getContent());
    const description = this.editor.getContent();
    const that = this;
     $.ajax({
      url:"/admin_good/editGood/"+that.props.goodId||'',
      dataType:"json",
      type:"post",
      data:{description},
      success:function(msg)
      {
        console.log(msg);
        if(msg.state)
        {
          that.props.finish&&that.props.finish();
        }
        
      },
      error:function(msg){
        document.body.innerHTML = msg.responseText;
      }
    })
  }
  render() {
    const formData = {
      content: 'aa'
    };

    return (
      <div>
        <script id="content" name="content" type="text/plain"></script>
        <Button type="primary" htmlType="submit" size="large" style={{float:'right',marginTop:10}} onClick={this.handleSubmit}>提交</Button>
      </div>
     )
  }
}

//AddGood = Form.create({})(AddGood);<EditSort />
