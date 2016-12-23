define(function(require, exports) {
	exports.Load = function(){
		var el = document.createElement("div");
		el.className = "img-bg";

		document.getElementById("gpy-wrap").appendChild(el);
	}
	exports.Unload = function(){}
	exports.Scan = function(){
		alert("无拍照设备");
	}
})