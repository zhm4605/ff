define(function(require, exports) {

    var comm = require("./comm");

    function addEvent(obj, name, func) {
        if (obj.attachEvent) {
            obj.attachEvent("on" + name, func);
        } else {
            obj.addEventListener(name, func, false);
        }
    }
    var mainIndex = 0;
    var iResolution = 4; //分辨率 768*1024
    var iFileType = 1; //文件类型，jpg
    var bOpened = false;

    function Unload() {
        if(typeof CmCaptureOcx.Destory==="function" )
        {
            CmCaptureOcx.Destory();
        }
        
        //CmCaptureOcxAssistant.Destory();
    }

   function Scan(callback) {
        if (bOpened) {
            var base64 = CmCaptureOcx.CaptureToBase64();
            //callback && callback({ 'Base64Photo': base64 });
            callback && callback(JSON.parse(comm.submitImageFile(base64, "enclosure")));
        } else {

        }
    }

     function Load() {
        var id = "CmCaptureOcx";
        var el = document.getElementById(id);
        if (el) {
            el.parentNode.removeChild(el);
        }
        var ob = document.createElement('object');
        ob.id = id;
        ob.type = "application/xhanhan-activex";
        ob.width = 260;
        ob.height = 220;
        ob.setAttribute("clsid","{3CA842C5-9B56-4329-A7CA-35CA77C7128D}");
        document.getElementById("gpy-wrap").appendChild(ob);

        if(typeof CmCaptureOcx.Initial==="function" )
        {
            
           mainIndex = CmCaptureOcx.Initial();

            var total = CmCaptureOcx.GetDevCount();

            if (total < 1) {
                alert('请先连接好拍摄设备！');
                return;
            }

            CmCaptureOcx.RotateVideo(1);
            CmCaptureOcx.StartRun(mainIndex);

            CmCaptureOcx.SetResolution(iResolution);
            CmCaptureOcx.SetFileType(iFileType);
            bOpened = true;
            exports.Scan = Scan;
            exports.Unload = Unload;
        } 
    }

    

    exports.Load = Load;
    exports.Unload = function(){}
    exports.Scan = function(){
        alert("未安装高拍仪插件");
    }

    //addEvent(window, 'unload', Unload);

})
