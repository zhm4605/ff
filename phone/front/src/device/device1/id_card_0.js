//<object id="plugin0" type="application/x-syncard" width="0" height="0"></object> 在body里面用


define(function(require, exports) {
    var comm = require("./comm");
    var global_sfz = {
        'isfresh': false,
    	'Base64Photo':true
    };

    var has_plugin = 0; 

    function plugin() {
        return document.getElementById('plugin0');
    }
    //plugin = plugin0;

    function AutoRead() {
        plugin().State = 0;
        plugin().SetPortNo(1001); //设置端口，串口1~16，USB 1001~1016
        plugin().SetReadType(1);
    }
    function StopAutoRead() {
        plugin()&&plugin().SetReadType(0);
    }

    var Base64Photo = '';
    function read_card(callback) {
        //plugin().SetReadType(0);
        plugin().SetPortNo(1001); //设置端口，串口1~16，USB 1001~1016
        plugin().ReadCard();
        //存参
        var CardState = plugin().State;
        if (CardState == 2) {
            global_sfz.HeaderPhoto = comm.submitImageFile(plugin().Base64Photo,"photo");
    		//global_sfz.HeaderPhoto = plugin().Base64Photo;
    		global_sfz.CardNo =plugin().CardNo;
    		global_sfz.NameL = plugin().NameL;
    		global_sfz.Address = plugin().Address;
    		global_sfz.Nation = plugin().NationL;
            callback && callback(global_sfz);
        } else if (CardState == 3) {
            alert("请重新放置好身份证！");
        } else if (CardState == 4) {
            alert("请打开身份证读卡器！");
        } else {
            alert("身份证信息读取失败，请重试！");
        }
        plugin().State = 0;
    }
    function Load(){
        var el = document.getElementById('plugin0');
        if(el)
        {
            el.parentNode.removeChild(el);
        }
        var ob = document.createElement('object');
        ob.id = "plugin0";
        ob.type = "application/x-syncard";
        ob.width = 0;
        ob.height = 0;
        document.body.appendChild(ob);

        //AutoRead();
        if(typeof plugin().SetReadType === "object")
        {
            has_plugin = 1;
            StopAutoRead();
            exports.Unload = Unload;
            exports.read_card = read_card;
        }
    }
    function Unload(){
        StopAutoRead();
    }

    exports.Load = Load;
    exports.Unload = function(){}
    exports.read_card = function()
    {
        alert("未安装身份证设备插件");
    } 
    
})