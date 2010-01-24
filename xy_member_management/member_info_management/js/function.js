function checkForm() {
	var theForm = document.form1;
	var userName = theForm.user_name.value.replace(/^\s+/,"");
	if (userName == "") {
		alert("Please input UserName!");
	} else if (theForm.user_pwd.value == "") {
		alert("Please input Password!");
	} else {
		theForm.submit();
	}
}

function check() {
	var theForm = document.form2;
	var pwd = theForm.member_pwd.value;
	var pwd_cfm = theForm.member_pwd_confirm.value;
	if (pwd == "") {
		alert("Password is required!");
		return false;	
	}
	if (pwd_cfm != "" && pwd != pwd_cfm) {
		alert("Two password inconsistent!");
		theForm.member_pwd_confirm.value = "";
		theForm.member_pwd_confirm.focus();
	} else {
		theForm.submit();	
	}
}

var aImg = new Image();
var photo_width, photo_height;
var srcPath;
var preSize = 180; // 尺寸不能超过200 * 200
var maxSize = 512 * 1000; // 最大为512KB
function getSize() {   
	if (aImg.readyState == "complete") {
		// 判断图片是否是jpeg
		var index = srcPath.lastIndexOf('.'); // 右边第一个'.'的序号
		var len = srcPath.length; // 取得总长度
        var str = srcPath.substring(len, index + 1); // 取得后缀名
		var exName = "JPG,JPEG"; // 允许的后缀名
		var flag = exName.indexOf(str.toUpperCase()); // 转成大写后判断
		if(flag == -1) {
		     alert("Only 'JPEG' type could be uploaded!");
		     return false;
		}
		
		if (aImg.fileSize > maxSize) { // 限制图片大小
			alert("Image size must be less than 512KB!");
			return false;	
		}
		if (aImg.width > preSize) { // 调整图片尺寸
			photo_width = preSize;   
			photo_height = preSize * (aImg.height / aImg.width);   
			aImg.height = photo_height;
			aImg.width = photo_width;
		}
		if (aImg.height > preSize) {
			photo_height = preSize;
			photo_width = preSize * (aImg.width / aImg.height);
		}    
		document.getElementById("showImg").src = srcPath;
		document.getElementById("showImg").width = photo_width;
		document.getElemtntById("shwoImg").height = photo_height;
	} else {
  		setTimeout("getSize()","100");   
  	}
}

function goto(path) {
	srcPath = path;
	aImg.src = srcPath;   
	getSize();   
}
