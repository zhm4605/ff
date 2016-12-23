//<object id="view1" type="application/x-eloamplugin" width="600" height="800" name="view"></object>

define(function(require, exports) {
    
    var comm = require("./comm");

    var DeviceMain; //主头
    var DeviceAssist; //副头
    var Video; //视频
    var sDevice = '';
    var sSubType = '';
    var iResolution = 0;
    var sResolution = [];

    function plugin() {
        return document.getElementById('view1');
    }

    function view() {
        return document.getElementById('view1');
    }

    function OpenVideo() {

        var dev;
        var SelectType;

        if (sDevice.length > 0) {
            CloseVideo()

            var devName = sDevice;
            if (devName == plugin().Device_GetFriendlyName(DeviceMain)) {
                dev = DeviceMain; //选中主头
            } else if (devName == plugin().Device_GetFriendlyName(DeviceAssist)) {
                dev = DeviceAssist; //选中副头
            }

            var SubtypeName;
            if (sSubType.length > 0) {
                var SubtypeName = sSubType;
                if (SubtypeName == "YUY2") {
                    SelectType = 1;
                } else if (SubtypeName == "MJPG") {
                    SelectType = 2;
                } else if (SubtypeName == "UYVY") {
                    SelectType = 4;
                }
            }

            Video = plugin().Device_CreateVideo(dev, iResolution, SelectType);
            if (Video) {
                view().View_SelectVideo(Video);
                view().View_SetText("打开视频中，请等待...", 0);
                plugin().Video_RotateLeft(Video);

            }
        }
    }

    function CloseVideo() {
        if (Video) {
            view().View_SetText("", 0);
            plugin().Video_Release(Video);
            Video = null;
        }
    }

    //切换设备
    function changeDev() {

        var dev;
        if (sDevice.length > 0) {
            var devName = sDevice;
            if (devName == plugin().Device_GetFriendlyName(DeviceMain)) {
                dev = DeviceMain; //选中主头
            } else if (devName == plugin().Device_GetFriendlyName(DeviceAssist)) {
                dev = DeviceAssist; //选中副头
            }

            //sSubType.options.length = 0;
            var subType = plugin().Device_GetSubtype(dev);
            if (subType & 1) {
                sSubType = "YUY2";
                SelectType = 1;
            }
            if (subType & 2) {
                sSubType = "MJPG";
                SelectType = 2;
            }
            if (subType & 4) {
                sSubType = "UYVY";
                SelectType = 4;
            }

            var nResolution = plugin().Device_GetResolutionCountEx(dev, SelectType); //根据出图模式获取分辨率
            //sResolution.options.length = 0; 
            for (var i = 0; i < nResolution; i++) {
                var width = plugin().Device_GetResolutionWidthEx(dev, SelectType, i);
                var heigth = plugin().Device_GetResolutionHeightEx(dev, SelectType, i);
                if (width == 1024) {
                    iResolution = i;
                }
                sResolution.push(width.toString() + "*" + heigth.toString());
                //sResolution.add(new Option(width.toString() + "*" + heigth.toString())); 
            }
            //sResolution.selectedIndex = 0;
        }
    }

    //切换出图模式
    function changesubType() {
        var sSubType = document.getElementById('subType');
        var sResolution = document.getElementById('selRes');
        var lDeviceName = document.getElementById('lab1');
        var sDevice = document.getElementById('device');
        var dev;

        if (sDevice.selectedIndex != -1) {
            var devName = sDevice.options[sDevice.options.selectedIndex].text;
            if (devName == plugin().Device_GetFriendlyName(DeviceMain)) {
                dev = DeviceMain; //选中主头
            } else if (devName == plugin().Device_GetFriendlyName(DeviceAssist)) {
                dev = DeviceAssist; //选中副头
            }

            var SubtypeName;
            if (sSubType.options.selectedIndex != -1) {
                var SubtypeName = sSubType.options[sSubType.options.selectedIndex].text;
                if (SubtypeName == "YUY2") {
                    SelectType = 1;
                } else if (SubtypeName == "MJPG") {
                    SelectType = 2;
                } else if (SubtypeName == "UYVY") {
                    SelectType = 4;
                }
            }

            var nResolution = plugin().Device_GetResolutionCountEx(dev, SelectType); //根据出图模式获取分辨率
            sResolution.options.length = 0;
            for (var i = 0; i < nResolution; i++) {
                var width = plugin().Device_GetResolutionWidthEx(dev, SelectType, i);
                var heigth = plugin().Device_GetResolutionHeightEx(dev, SelectType, i);
                sResolution.add(new Option(width.toString() + "*" + heigth.toString()));
            }
            sResolution.selectedIndex = 0;
        }
    }

    function Load() {
        //设备接入和丢失
        //type设备类型， 1 表示视频设备， 2 表示音频设备
        //idx设备索引
        //dbt 1 表示设备到达， 2 表示设备丢失
        var el = document.getElementById('view1');
        if(el)
        {
            el.parentNode.removeChild(el);
        }
        var ob = document.createElement('object');
        ob.id = "view1";
        ob.type = "application/x-eloamplugin";
        ob.width = 260;
        ob.height = 220;
        ob.name = "view";
        document.getElementById("gpy-wrap").appendChild(ob);

        comm.addEvent(plugin(), 'DevChange', function(type, idx, dbt) {
            if (1 == type) //视频设备
            {
                if (1 == dbt) //设备到达
                {
                    var deviceType = plugin().Global_GetEloamType(1, idx);
                    if (1 == deviceType) //主摄像头
                    {
                        if (null == DeviceMain) {
                            DeviceMain = plugin().Global_CreateDevice(1, idx);
                            if (DeviceMain) {
                                //var sSubType = document.getElementById('subType'); 								
                                //var sResolution = document.getElementById('selRes'); 	
                                //var lDeviceName =  document.getElementById('lab1');
                                //var sDevice =   document.getElementById('device');
                                sDevice = plugin().Device_GetFriendlyName(DeviceMain);
                                //sDevice.add(new Option(plugin().Device_GetFriendlyName(DeviceMain)));
                                //sDevice.selectedIndex = idx;//选中主头
                                changeDev();

                                OpenVideo(); //是主头自动打开视频
                            }
                        }
                    } else if (2 == deviceType || 3 == deviceType) //辅摄像头
                    {
                        if (null == DeviceAssist) {
                            DeviceAssist = plugin().Global_CreateDevice(1, idx);
                            if (DeviceAssist) {
                                DeviceAssist = plugin().Global_CreateDevice(1, idx);
                                if (DeviceAssist) {
                                    // var sSubType = document.getElementById('subType'); 								
                                    // var sResolution = document.getElementById('selRes'); 	
                                    // var lDeviceName =  document.getElementById('lab1');
                                    // var sDevice =   document.getElementById('device');
                                    // sDevice.add(new Option(plugin().Device_GetFriendlyName(DeviceAssist)));	
                                    sDevice = plugin().Device_GetFriendlyName(DeviceAssist);
                                }
                            }
                        }
                    }
                } else if (2 == dbt) //设备丢失
                {
                    if (DeviceMain) {
                        if (plugin().Device_GetIndex(DeviceMain) == idx) {
                            CloseVideo();
                            plugin().Device_Release(DeviceMain);
                            DeviceMain = null;

                            // document.getElementById('device').options.length = 0; 
                            // document.getElementById('subType').options.length = 0; 
                            // document.getElementById('selRes').options.length = 0; 
                            sDevice = '';
                            sSubType = '';
                        }
                    }

                    if (DeviceAssist) {
                        if (plugin().Device_GetIndex(DeviceAssist) == idx) {
                            CloseVideo();
                            plugin().Device_Release(DeviceAssist);
                            DeviceAssist = null;

                            // document.getElementById('device').options.length = 0; 
                            // document.getElementById('subType').options.length = 0; 
                            // document.getElementById('selRes').options.length = 0; 
                            sDevice = '';
                            sSubType = '';
                        }
                    }
                }
            }
        });

        if(typeof view().Global_SetWindowName === 'object')
        {
            Unload();
            view().Global_SetWindowName("view");
    
            if (!plugin().Global_InitDevs()) 
            {
                //ob.innerText = "初始化高拍仪失败！";
                alert("初始化高拍仪失败！");
            }

            exports.Scan = Scan;
            exports.Unload = Unload;
        }
     }   

    function Unload() {
        if (Video) {
            view().View_SetText("", 0);
            plugin()&&plugin().Video_Release(Video);
            Video = null;
        }
        if (DeviceMain) {
            plugin()&&plugin().Device_Release(DeviceMain);
            DeviceMain = null;
        }
        if (DeviceAssist) {
            plugin()&&plugin().Device_Release(DeviceAssist);
            DeviceAssist = null;
        }
        plugin()&&plugin().Global_DeinitDevs();
    }

    function Scan(callback) {
        var div_id = comm.uuid(18, 16);
        var filename = div_id + ".jpg";
        if (Video) {
            var img = plugin().Video_CreateImage(Video, 0, view().View_GetObject());
            if (img) {
                var http = plugin().Global_CreateHttp(comm.receive_folder+"receive_enclosure.php"); 
                if (http) {
                    var b = plugin().Http_UploadImage(http, img, 2, 0, filename);
                    if (b) {
                       	callback && callback(JSON.parse(plugin().Http_GetServerInfo(http)));							
                    } else {
                        alert("上传失败");
                    }

                    plugin().Http_Release(http);
                }

                plugin().Image_Release(img);
            }
        }
    }

    //comm.addEvent(window, 'load', Load);
    //comm.addEvent(window, 'unload', Unload);

    exports.Load = Load;
    exports.Unload = function(){}
    exports.Scan = function(){
        alert("未安装高拍仪插件");
    }
    
})