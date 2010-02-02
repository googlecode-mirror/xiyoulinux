var checkflag = "false"; 	
function check(field){ 
	if (checkflag=="false"){   
		for(i =0; i<field.chk.length;i++){  
			field.chk[i].checked = true;   
		} 
		field.chkAll[0].checked=true;
		field.chkAll[1].checked=true;  
		checkflag="true";   
	}else{   
			for(i=0;i<field.chk.length;i++){   
			field.chk[i].checked=false;  
		}
		field.chkAll[0].checked=false;
		field.chkAll[1].checked=false;   
		checkflag="false";     
	}   
}  
function reflush()
{
    document.getElementById("photo").src=document.getElementById("img").value;
}
