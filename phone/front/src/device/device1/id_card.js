function plugin0()
{
	return document.getElementById('plugin0');
}
plugin = plugin0;
function addEvent(obj, name, func)
{
	if (obj.attachEvent) {
		obj.attachEvent("on"+name, func);
	} else {
		obj.addEventListener(name, func, false); 
	}
}
function AutoRead() {
	plugin().State = 0;
	plugin().SetPortNo(1001);	//设置端口，串口1~16，USB 1001~1016
	plugin().SetReadType(1);
}
function StopAutoRead() {
	plugin().SetReadType(0);
}

var Base64Photo='';
function read_card(callback)
{
	plugin().SetReadType(0);
	plugin().SetPortNo(1001);	//设置端口，串口1~16，USB 1001~1016
	plugin().ReadCard();
	//存参
	var CardState = plugin().State;
	if (CardState == 2) {
		/*$('#jt_name').val(plugin().NameL);
		$('#jt_idNum').val(plugin().CardNo);
		$('#jt_hAddress').val(plugin().Address);
		$('#jt_hPhoto').attr('src',"data:image/jpeg;base64,"+plugin().Base64Photo);
		Base64Photo=plugin().Base64Photo;*/
		callback&&callback();
	}else if(CardState == 3){
		alert("请重新放置好身份证！");
	}else if(CardState == 4){
		alert("请打开身份证读卡器！");
	}else{
		alert("身份证信息读取失败，请重试！");
	}
	plugin().State = 0;
}
		

