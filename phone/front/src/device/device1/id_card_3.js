/////////////////////device start/////////////////////////////////

define(function(require, exports) {
    var comm = require("./comm");
    var $ = require("jquery");

    var Device = function() {
        message: ""
    };


    //工厂
    var DeviceFactory = {
            createDevice: function(button) {
                var device;
                switch (button) {
                    case "Cert":
                        device = new Cert();
                        break;
                    case "Scanner":
                        device = new Scanner();
                        break;
                    case "Barcode":
                    default:
                        device = new BarcodeScanner();
                        break;
                }
                return device;
            }
        }
        //设备工厂
    Device.prototype.createDevice = function(button) {
        return DeviceFactory.createDevice(button);
    };
    //信息显示
    Device.prototype.setMessage = function() {
        setting.Methods.showMessage(msgType.loading, this.message);
    };

    //处理硬件返回值
    Device.prototype.dealDeviceInfo = function(result) {
        // if(result === null||result.ret===null)
        // {
        // setting.Methods.showMessage("error","设备连接异常");
        // //alert("设备连接异常");
        // return;
        // }
        // //信息提示
        // var info = this.interfaceResult[result.ret];
        // if(info == undefined)
        // {
        // setting.Methods.showMessage("error","设备连接异常");
        // return;
        // }
        // if(info.notShow == undefined)
        // {
        // setting.Methods.showMessage(info.type,info.message);
        // }
        // //处理数据
        // if("success" === info.type)
        // {
        // this.dealDeviceData(result);
        // }
        this.dealDeviceData(result);

    }

    //html5使用ajax方式访问服务
    Device.prototype.ajaxAccess = function(url) {
        var result = null;
        var parent = this;
        $.ajax({
            type: "GET",
            url: issOnlineUrl + url,
            dataType: "text",
            async: true,
            timeout: 10000,
            success: function(data) {
                data = data.replace(/\\/g, "/");
                result = JSON.parse(data);
                parent.dealDeviceInfo(result);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {

                console.info(errorThrown + "url:" + url);
                if (textStatus == "timeout" && url != "/info") {
                    setting.Methods.showMessage("warning", "未读取到身份证，请重新刷卡！");
                } else if (typeof parent.installDrive == "function") {
                    if (parent.installDrive()) {
                        setting.Methods.showMessage("error", "设备连接异常");
                    }
                } else {
                    setting.Methods.showMessage("error", "设备连接异常");
                }
            },

        });
    }

    //IE8、IE9访问服务
    Device.prototype.xDomainAccess = function(url) {
        var parent = this;
        var xDomainRequest = new XDomainRequest();
        if (xDomainRequest) {
            xDomainRequest.timeout = 10000;
            xDomainRequest.open('GET', issOnlineUrl + url);
            xDomainRequest.onload = function() {
                var resultData = xDomainRequest.responseText;
                resultData = resultData.replace(/\\/g, "/");
                var obj = JSON.parse(resultData);
                parent.dealDeviceInfo(obj);
            };
            xDomainRequest.onerror = function() {
                //用完后，将对象置为空
                xDomainRequest = null;
                setting.Methods.showMessage("error", "设备连接异常");
            };
            xDomainRequest.ontimeout = function() {
                //用完后，将对象置为空
                xDomainRequest = null;
                setting.Methods.showMessage("error", "设备连接异常");
            };
            xDomainRequest.send();
        }
    }

    //驱动检测
    Device.prototype.installDrive = function() {
            return true;
        }
        //设备通信,得到硬件返回的数据
    Device.prototype.accessDevice = function() {
        $("#iss").css("width", "25%");
        if (browserFlag == "html5") {
            this.ajaxAccess(this.url);
        } else if (browserFlag == "simple") {
            this.xDomainAccess(this.url);
        } else {
            if (window.console) {
                console.error("browserFlag is missing");
            }
        }
    };

    /////////////////////baseISSObject end/////////////////////////////////


    /////////////////////baseISSObject start/////////////////////////////////

    var ZK = {
        extend: function() {
            // inline overrides  
            var io = function(o) {
                for (var m in o) {
                    this[m] = o[m];
                }
            };
            var oc = Object.prototype.constructor;

            return function(sb, sp, overrides) {
                if (typeof sp == 'object') {
                    overrides = sp;
                    sp = sb;
                    sb = overrides.constructor != oc ? overrides.constructor : function() {
                        sp.apply(this, arguments);
                    };
                }
                var F = function() {},
                    sbp, spp = sp.prototype;
                F.prototype = spp;
                sbp = sb.prototype = new F();
                sbp.constructor = sb;
                sb.superclass = spp;
                if (spp.constructor == oc) {
                    spp.constructor = sp;
                }
                sb.override = function(o) {
                    ZK.override(sb, o);
                };
                sbp.override = io;
                ZK.override(sb, overrides);
                sb.extend = function(o) {
                    ZK.extend(sb, o);
                };
                return sb;
            };
        }(),

        override: function(origclass, overrides) {
            if (overrides) {
                var p = origclass.prototype;
                for (var method in overrides) {
                    p[method] = overrides[method];
                }
            }
        },

        apply: function(o, c, defaults) {
            if (defaults) {
                // no "this" reference for friendly out of scope calls  
                ZK.apply(o, defaults);
            }
            if (o && c && typeof c == 'object') {
                for (var p in c) {
                    o[p] = c[p];
                }
            }
            return o;
        }
    };

    /////////////////////baseISSObject end/////////////////////////////////

    /////////////////////baseISSOnline start/////////////////////////////////

    function createISSonlineDevice(setting) {
        var ISSOnline = "ZKIDROnline";
        var browserFlag = getBrowserType() || "";
        //刷卡信息返回默认方法
        if (typeof setting.Methods == "object") {
            //检查驱动安装默认方法
            if (typeof setting.Methods.checkWebServer != "function") {
                setting.Methods.checkWebServer = function(myDevice) {
                    var ISSVersion = function() {};
                    ZK.extend(ISSVersion, Device, {
                        message: "",
                        url: "/info",
                        interfaceResult: {
                            0: { mean: "成功", message: "二代身份证读取成功！", type: "success", notShow: true }
                        },
                        dealDeviceData: function(result) {
                            var existVersion = result.data.server_version; //2.7.1
                            var curVersion = "${application['fpDriver.version']}"; //3.5.2
                            var existVersionArr = existVersion.split(".");
                            var curVersionArr = curVersion.split(".");
                            var isLast = true;
                            var len = existVersionArr.length;
                            for (var i = len; i > 0; i--) {
                                var existVersionTemp = parseInt(existVersionArr[i - 1]);
                                var curVersionTemp = parseInt(curVersionArr[i - 1]);
                                if (existVersionTemp < curVersionTemp) {
                                    isLast = false;
                                } else if (existVersionTemp > curVersionTemp) {
                                    isLast = true;
                                } else {
                                    //等于 忽略
                                }
                            }

                            //if(result.data.server_version >= "${application['fpDriver.version']}")
                            if (isLast) {
                                if (typeof setting.Methods.detectSuccess == "function") {
                                    setting.Methods.detectSuccess();
                                }
                                if (typeof myDevice == "object") {
                                    //连接设备，处理返回信息
                                    setTimeout(function() {
                                        myDevice.accessDevice();
                                    }, 100);
                                }
                            } else {
                                if (typeof setting.Methods.detectWarning == "function") {
                                    setting.Methods.detectWarning();
                                }
                                if (typeof myDevice == "object") {
                                    //连接设备，处理返回信息
                                    setTimeout(function() {
                                        myDevice.accessDevice();
                                    }, 100);
                                } else {
                                    if (typeof setting.Methods.notInstall == "function") {
                                        setting.Methods.notInstall();
                                    }
                                }
                            }
                        },
                        installDrive: function() {
                            if (typeof setting.Methods.detectError == "function") {
                                setting.Methods.detectError();
                            }
                            if (typeof myDevice == "object") {
                                closeMessage();
                                //驱动未安装
                                setting.Methods.downloadDrive();
                            } else {
                                if (typeof setting.Methods.notInstall == "function") {
                                    setting.Methods.notInstall();
                                }
                            }

                            return false;
                        }
                    });

                    var version = new ISSVersion();
                    version.accessDevice();
                }
            }

        }
        /**
         * 设备
         */


        // $.each(buttonNames, function(key, value){
        // if(value)
        // {
        // $(document).off("click",value);
        // $(document).on("click",value,function(e){ 
        // $(value).blur();
        // //创建设备
        // var device = new Device();
        // var myDevice = device.createDevice(key);
        // //显示提示信息
        // myDevice.setMessage();
        // setting.Methods.checkWebServer(myDevice);
        // });
        // }

        // }); 

        setting.Methods.checkWebServer();
    }


    /////////////////////baseISSOnline end/////////////////////////////////



    var issOnlineUrl = "http://127.0.0.1:24010/ZKIDROnline";
    var browserFlag = getBrowserType();
    var btn_callback = null;
    var global_sfz = {
        'isfresh': false,
        'Base64Photo': true
    };
    var interfaceResult = {
        0: { mean: "成功", message: "二代身份证读取成功！", type: "success" },
        1: { mean: "端口打开失败", message: "未检测到二代身份证阅读器！", type: "warning" },
        2: { mean: "数据传输超时", message: "未检测到二代身份证阅读器！", type: "error" },
        10: { mean: "没有找到卡", message: "未读取到身份证，请重新刷卡！", type: "warning" },
        11: { mean: "读卡操作失败", message: "未检测到二代身份证阅读器！", type: "error" },
        20: { mean: "自检失败", message: "二代身份证读取失败！", type: "error" },
        30: { mean: "其他错误", message: "二代身份证读取失败！", type: "error" },
        40: { mean: "相片解码失败", message: "二代身份证读取失败！", type: "error" },
        100: { mean: "超时", message: "未读取到身份证，请重新刷卡！", type: "warning" },
        200: { mean: "GetBase64PhotoData", message: "二代身份证读取失败！", type: "error" }
    };

    var setting = {
        Cert: {
            callBack: function(result) {
                global_sfz.isfresh = false;
                if (result === null || result.ret === null) {
                    lobal_sfz.msg = '设备连接异常';
                } else {
                    if (result.ret == 0) {
                        global_sfz.isfresh = true;
                        global_sfz.CardNo = result.Certificate.IDNumber;
                        global_sfz.NameL = result.Certificate.Name;
                        global_sfz.Address = result.Certificate.Address;
                        global_sfz.Nation = result.Certificate.Nation;
                        global_sfz.HeaderPhoto = comm.submitImageFile(result.Certificate.Base64Photo,"photo");
                        //this.dealDeviceData(result);



                    } else {
                        var info = interfaceResult[result.ret];
                        if (info != undefined) {
                            global_sfz.msg = info.mean;
                        } else {
                            global_sfz.msg = '未知异常发生';
                        }

                    }
                }!!btn_callback && btn_callback(global_sfz);

            },
            select: "#button_readID"
        },
        Methods: {
            showMessage: function(type, message) {
                //$("#cert_message").text(message);
                //$("#cert_message_type").text(msgType[type]);
                alert(message);
            },
            downloadDrive: function() {
                // $.jBox.closeTip();
                // messageBox({messageType: "confirm", text: "请安装相关硬件驱动！点击确定下载驱动。", 
                // callback: function(result){
                // if(result)
                // {
                // window.location.href = "middleware/ZKIDROnline.exe";
                // }
                // closeMessage();
                // }});
                alert("请安装相关硬件驱动！点击确定下载驱动。");
            }
        }
    }

    if (typeof setting.Cert == "object") {
        //身份证阅读器
        var Cert = function() {};
        ZK.extend(Cert, Device, {
            //提示信息
            message: "请将二代身份证放到读卡区域...",
            //服务url
            url: "/ScanReadIdCardInfo?OP-DEV=1&CMD-URL=4&common=1" + "&random=" + getRandomNum(),
            //接口返回值
            interfaceResult: {
                0: { mean: "成功", message: "二代身份证读取成功！", type: "success" },
                1: { mean: "端口打开失败", message: "未检测到二代身份证阅读器！", type: "warning" },
                2: { mean: "数据传输超时", message: "未检测到二代身份证阅读器！", type: "error" },
                10: { mean: "没有找到卡", message: "未读取到身份证，请重新刷卡！", type: "warning" },
                11: { mean: "读卡操作失败", message: "未检测到二代身份证阅读器！", type: "error" },
                20: { mean: "自检失败", message: "二代身份证读取失败！", type: "error" },
                30: { mean: "其他错误", message: "二代身份证读取失败！", type: "error" },
                40: { mean: "相片解码失败", message: "二代身份证读取失败！", type: "error" },
                100: { mean: "超时", message: "未读取到身份证，请重新刷卡！", type: "warning" },
                200: { mean: "GetBase64PhotoData", message: "二代身份证读取失败！", type: "error" }
            },
            dealDeviceData: setting.Cert.callBack
        });

    }



    function read_card(callback) {
        //ZK.extend(Cert, Device, {dealDeviceData:callback});
        btn_callback || (btn_callback = callback);
        var device = new Device();
        var myDevice = device.createDevice('Cert');
        // //显示提示信息
        //myDevice.setMessage();
        setting.Methods.checkWebServer(myDevice);
    }

    function device_init() {
        createISSonlineDevice(setting);
    }

    function setCertificateData(result) {
        $("#birthday").val(result.Certificate.Birthday.replace(/\./g, "-").substr(0, 10));
        $("#certNumber").val(result.Certificate.IDNumber);
        $("#idIssued").val(result.Certificate.IDIssued);
        $("#issuedValidDate").val(result.Certificate.IssuedData + "-" + result.Certificate.ValidDate);

        imgData = result.Certificate.Base64Photo;
        $("#id_img_pers").attr("src", "data:image/jpg;base64," + imgData);
        $("#personIdPhoto").val(imgData);
        $("#personPhoto").val("");

        $("#personName").val(result.Certificate.Name);
        $("#gender").val(result.Certificate.Sex);
        $("#nation").val(result.Certificate.Nation);
        $("#address").val(result.Certificate.Address);
    }

    function getRandomNum() {
        var random = parseInt(Math.random() * 10000);
        return random;
    }

    //消息控件的使用类型的类
    var msgType = {
        info: "info",
        success: "success",
        warning: "warning",
        error: "error",
        loading: "loading"
    };

    function getBrowserType() {
        var browserFlag = "";
        //是否支持html5的cors跨域
        if (typeof(Worker) !== "undefined") {
            browserFlag = "html5";
        }
        //此处判断ie8、ie9
        else if (navigator.userAgent.indexOf("MSIE 8.0") > 0 || navigator.userAgent.indexOf("MSIE 9.0") > 0) {
            browserFlag = "simple";
        } else {
            browserFlag = "upgradeBrowser"; //当前浏览器不支持该功能,请升级浏览器
        }
        return browserFlag;
    }


    function openMessage(type, text, ptimeout) {
        text = (text == "" ? null : text);
        var timeout = 1000;
        if (type == msgType.warning || type == msgType.info) //警告
        {
            timeout = 3000;
        } else if (type == msgType.success) //成功 
        {

            text = (text && text != null ? text : "操作成功"); //${common_op_succeed}:操作成功
            var num = strlen(text) / 30;
            num = num > 8 ? 8 : num;
            timeout = Math.ceil(num) * timeout; //动态判断显示字符数的长度来延长显示时间
        } else if (type == msgType.error) //失败
        {
            text = (text && text != null) ? text : "操作失败"; //${common_op_failed}:操作失败，程序出现异常
            timeout = 3000;
        } else if (type == msgType.loading) //处理中
        {
            timeout = 0; //当为'loading'时，timeout值会被设置为0，表示不会自动关闭。
            text = text && text != null ? text : "处理中"; //${common_op_processing}:处理中
        }
        var width = strlen(text) * 6.1 + 45; //按字符计算宽度
        timeout = ptimeout ? ptimeout : timeout;
        $.jBox.tip(text, type, { timeout: timeout, width: (width > 400 ? 400 : "auto") }); //设定最大宽度为400
    }


    function closeMessage(timeout) {
        timeout = timeout ? timeout : 1000;
        window.setTimeout("$.jBox.closeTip();", timeout); //设定最小等待时间
    }

    function strlen(str) {
        var len = 0;
        if (str != null) {
            for (var i = 0; i < str.length; i++) {
                var c = str.charCodeAt(i);
                if ((c >= 0x0001 && c <= 0x007e) || (0xff60 <= c && c <= 0xff9f)) {
                    len++;
                } else {
                    len += 2;
                }
            }
        }
        return len;
    }

    function messageBox(paramsJson) {

        this.messageType = paramsJson.messageType ? $.trim(paramsJson.messageType) : "confirm";
        this.types = "";
        if (paramsJson.type) {
            this.typeArray = paramsJson.type.split(" ");
            for (var i = 0; i < this.typeArray.length; i++) {
                this.types += this.typeArray[i] + " ";
            }
        }
        switch (this.messageType) {
            case "confirm":
                $.jBox.confirm(paramsJson.text, "提示", function(v, h, f) {
                    if (v == "ok") {
                        paramsJson.callback(true);
                    }
                });
                break;
        }
    }


    exports.Load = function(){
    	device_init&&device_init();
    };
    exports.Unload = function() {};
    exports.read_card = read_card;
})
