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