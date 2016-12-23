
const receive_folder = window.location.origin+"/ajax/";

function uuid(len, radix) {
    var chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.split('');
    var uuid = [],
    i;
    radix = radix || chars.length;

    if (len) {
        // Compact form
        for (i = 0; i < len; i++) uuid[i] = chars[0 | Math.random() * radix];
    } else {
        // rfc4122, version 4 form
        var r;

        // rfc4122 requires these characters
        uuid[8] = uuid[13] = uuid[18] = uuid[23] = '-';
        uuid[14] = '4';

        // Fill in random data.  At i==19 set the high bits of clock sequence as
        // per rfc4122, sec. 4.1.5
        for (i = 0; i < 36; i++) {
            if (!uuid[i]) {
                r = 0 | Math.random() * 16;
                uuid[i] = chars[(i == 19) ? (r & 0x3) | 0x8: r];
            }
        }
    }

    return uuid.join('');
}


function addEvent(obj, name, func) {
    if (obj.attachEvent) {
        obj.attachEvent("on" + name, func);
    } else {
        obj.addEventListener(name, func, false);
    }
}


/**@param base64Codes图片的base64编码*/
function submitImageFile(base64Codes, type){

    var formData = new FormData();   //这里连带form里的其他参数也一起提交了,如果不需要提交其他参数可以直接FormData无参数的构造函数

    //convertBase64UrlToBlob函数是将base64编码转换为Blob
    formData.append("file",convertBase64UrlToBlob(base64Codes));  //append函数的第一个参数是后台获取数据的参数名,和html标签的input的name属性功能相同

    var aa;
    //ajax 提交form
    $.ajax({
        url : receive_folder+"receive_"+type+".php",
        async: false,
        type : "POST",
        data : formData,
        processData : false,         // 告诉jQuery不要去处理发送的数据
        contentType : false,        // 告诉jQuery不要去设置Content-Type请求头
        success:function(data){
            //window.location.href="${ctx}"+data;
            console.log(data);
            aa = data;

            //$('body').html(data);
        },
        error: function(result){
            console.log(result);
            $('body').html(result.responseText);
        }
    });
    return aa;
}


/**
* 将以base64的图片url数据转换为Blob
* @param urlData
*            用url方式表示的base64图片数据
*/
function convertBase64UrlToBlob(urlData){

    //var bytes=window.atob(urlData.split(',')[1]);        //去掉url的头，并转换为byte

    var bytes=window.atob(urlData);
    //处理异常,将ascii码小于0的转换为大于0
    var ab = new ArrayBuffer(bytes.length);
    var ia = new Uint8Array(ab);
    for (var i = 0; i < bytes.length; i++) {
        ia[i] = bytes.charCodeAt(i);
    }

    return new Blob( [ab] , {type : 'image/png'});
}

export {receive_folder,uuid,addEvent,submitImageFile};
