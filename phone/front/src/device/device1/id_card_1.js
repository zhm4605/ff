//<object id="view1" type="application/x-eloamplugin" width="0" height="0" name="view"></object> 在body里面用

define(function(require, exports) {
    //var $ = require("jquery");
    var comm = require("./comm");

    var global_sfz = {
        'isfresh': false
    };

    function plugin() {
        return document.getElementById('view1');
    }

    function Load() {

        var el = document.getElementById('view1');
        if(el)
        {
            el.parentNode.removeChild(el);
        }
        var ob = document.createElement('object');
        ob.id = "view1";
        ob.type = "application/x-eloamplugin";
        ob.name = "view";
        ob.width = 0;
        ob.height = 0;

        document.body.appendChild(ob);

        comm.addEvent(plugin(), 'IdCard', function(ret){
            if (1 == ret) 
            {
                var image = plugin().Global_GetIdCardImage(1); //1表示头像， 2表示正面， 3表示反面 ...

                global_sfz.HeaderPhoto = my_upload(image);
                plugin().Image_Release(image);

                global_sfz.CardNo = plugin().Global_GetIdCardData(8);
                global_sfz.NameL = plugin().Global_GetIdCardData(1);
                global_sfz.Address = plugin().Global_GetIdCardData(7);
                global_sfz.Nation = plugin().Global_GetIdCardData(3);
                global_sfz.isfresh = true;

            }
        });

        if(typeof plugin().Global_InitDevs === "object")
        {
            Unload();
            var ret = plugin().Global_InitDevs();
            StartIDCard();

            exports.Unload = Unload;
            exports.read_card = read_card;
        }
        
    }

    function Unload() {
        StopIDCard();
    }

    /******************二代证阅读器********************/
    function StartIDCard() {
        if (!plugin().Global_InitIdCard()) {
            //alert("初始化二代证阅读器失败！");
            return;
        }
        if (plugin().Global_DiscernIdCard()) {
            //alert("请刷卡！");
        } else {
            alert("启动二代证阅读失败！");
        }
    }
    function StopIDCard() {
        plugin()&&plugin().Global_StopIdCardDiscern();
        plugin()&&plugin().Global_DeinitIdCard();
    }
    function device_init(){
    	//Load();
    }
    //comm.addEvent(window, 'load', Load);
    //comm.addEvent(window, 'unload', Unload);

    function read_card(callback) {

        if (global_sfz.isfresh) {
            callback && callback(global_sfz);
        } else {
            alert("身份证信息读取失败，请重新放置身份证！");
        }
    }

    function my_upload(img) {
        var div_id = comm.uuid(18, 16);
        var filename = div_id + ".jpg";
        var http = plugin().Global_CreateHttp(window.location.origin+"/ajax/receive_photo.php");
        var ret = false;
        if (http) {
            var b = plugin().Http_UploadImage(http, img, 2, 0, filename);
            
            if (b) {
                //ret = '../uploads/enclosure/' + filename;
                ret = plugin().Http_GetServerInfo(http);
            } else {
                //alert("上传失败");
            }
            plugin().Http_Release(http);
        }
        return ret;
    }

    exports.Load = Load;
    exports.Unload = function(){}
    exports.read_card = function()
    {
        alert("未安装身份证设备插件");
    } 
})