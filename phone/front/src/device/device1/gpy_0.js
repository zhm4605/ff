//<embed id="VideoInputCtl" type="application/x-vnd.newimage.videoinput" style="width: 480px; height: 640px;"/>

define(function(require, exports) {

    var comm = require("./comm");
    
    var szDefaultDevice = "[1a3c:010d]"; // 525
    var iDeviceIndex = -1;
    var szDefaultResolutionSize = '1280 x 1024';
    var iResolutionIndex = -1;

    function initialize() {
        var nDeviceCount = VideoInputCtl.GetDeviceCount();
        if (nDeviceCount > 0) iDeviceIndex = 0;
        for (var i = 0; i < nDeviceCount; i++) {
            var szDeviceName = VideoInputCtl.GetDeviceName(i);
            if (szDefaultDevice.length > 0 && szDeviceName.indexOf(szDefaultDevice) >= 0)
                iDeviceIndex = i;
        }
        if (iDeviceIndex > -1)
            opendevice();
        else
            alert('未找到设备');
    }

    function opendevice() {
        if (iDeviceIndex < 0) return;

        if (!VideoInputCtl.IsDeviceOpened(iDeviceIndex))
            VideoInputCtl.OpenDevice(iDeviceIndex);

        var nFormatCount = VideoInputCtl.GetDeviceFormatCount(iDeviceIndex);
        if (nFormatCount > 0) iResolutionIndex = nFormatCount - 1;
        for (var i = 0; i < nFormatCount; i++) {

            var szFormatName = VideoInputCtl.GetDeviceFormatName(iDeviceIndex, i);
            if (szFormatName.indexOf(szDefaultResolutionSize) >= 0)
                iResolutionIndex = i;
        }
        if (iResolutionIndex > -1) {
            VideoInputCtl.StartPlayDevice(iDeviceIndex);
            rotateangle(270);
        } else {
            alert('未找到设备');
        }
    }

    function rotateangle(angle) {
        var nDeviceIndex = VideoInputCtl.GetDeviceIndex();
        VideoInputCtl.SetDeviceRotate(nDeviceIndex, angle);
    }

    function Scan(callback) {
        if (iDeviceIndex > -1 && iResolutionIndex > -1) {
            var base64 = VideoInputCtl.GrabToBase64('.jpg');
            //callback && callback({ 'Base64Photo': base64 });
            callback && callback(JSON.parse(comm.submitImageFile(base64, "enclosure")));
        } else {

        }
    }

    function Load()
    {
    		var id = "VideoInputCtl";
    		var el = document.getElementById(id);
        if(el)
        {
            el.parentNode.removeChild(el);
        }
        var ob = document.createElement('object');
        ob.id = id;
        ob.type = "application/x-vnd.newimage.videoinput";
        ob.width = 260;
        ob.height = 220;
        document.getElementById("gpy-wrap").appendChild(ob);

        if(typeof VideoInputCtl.GetDeviceCount === 'function')
        {
            initialize();
            exports.Scan = Scan;
            exports.Unload = Unload;
        }
        
    }

    exports.Load = Load;
    exports.Unload = function(){}
    exports.Scan = function(){
        alert("未安装高拍仪插件");
    }
})
