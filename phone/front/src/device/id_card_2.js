//<embed id="RoutonReader" type="application/mozilla-npruntime-scriptable-plugin" width="0" height="0" /> 在body里面用
define(function(require, exports) {
  var comm = require("./comm");
  var global_sfz = {
      'isfresh': false,
      'Base64Photo': true
  };

  function byId(id) {
      return document.getElementById(id);
  }
  var isInit = false;

  function read_card(callback) {
      var obj = byId("RoutonReader"); //Routon Card Reader

      obj.setPortNum(0);
      if (false == isInit) {
          //设置端口号，1表示串口1，2表示串口2，依此类推；1001表示USB。0表示自动选择
          var port = obj.setPortNum(0); //changed args
          if (port == 0) {
              alert("端口初始化失败！");
              return;
          }
          isInit = true;
      }

      //使用重复读卡功能
      obj.Flag = 0;
      //obj.BaudRate=115200;
      //设置照片保存路径，默认路径为系统临时目录, 照片文件名：photo.bmp, photo.jpg。

      //读卡
      var rst = obj.ReadCard();
      //获取各项信息
      if (rst == 0x90) {
          global_sfz.CardNo = obj.CardNo();
          global_sfz.NameL = obj.NameL();
          global_sfz.Address = obj.Address();
          global_sfz.Nation = obj.NationL();
          global_sfz.HeaderPhoto = comm.submitImageFile(obj.GetImage(),"photo");
          global_sfz.isfresh = true;
          callback && callback(global_sfz);

      } else {
          global_sfz.isfresh = false;
          if (rst == 0x02) alert("请重新将卡片放到读卡器上！");
          if (rst == 0x41) alert("读取数据失败！");
      }
  }

  function Load() {
    var el = document.getElementById('RoutonReader');
    if(el)
    {
        el.parentNode.removeChild(el);
    }
    var ob = document.createElement('embed');
    ob.id = "RoutonReader";
    ob.type = "application/mozilla-npruntime-scriptable-plugin";
    ob.width = 0;
    ob.height = 0;
    document.body.appendChild(ob);

    if(typeof byId("RoutonReader").setPortNum === "object")
    {
      exports.read_card = read_card;
    }
  }

  exports.Load = Load;
  exports.Unload = function(){}
  exports.read_card = function()
  {
      alert("未安装身份证设备插件");
  } 
})
