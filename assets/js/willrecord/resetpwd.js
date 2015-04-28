$(document).ready(function(){
	$("#inputPassword1").focus(function(){
		$("#inputPassword2").val("");
		$("#inputPassword2").parent().removeClass("has-error");
		$("#inputPassword2").parent().removeClass("has-success");
		$("#inputPassword2").next().hide();
	});

	$("#inputPassword1").focusout(function(){
		if( !checkPassword1() ) {
			return false;
		}
	});

	$("#inputPassword2").focusout(function(){
		if( !checkPassword2() ) {
			return false;
		}
	});

	
	// 送出註冊資料
	$("#resetPwdSubmit").click(function(){
		submitPwdReset();
	});
	
	$('.form-control').keyup(function(event){
		if(event.keyCode == 13){
			submitPwdReset();
		}
	});
	
	// 註冊成功動畫
	$('#successMsg').fadeIn('slow');
});

// 密碼驗證
function submitPwdReset(){
	var checkStr = '';
	
	if( !checkPassword1() ) {
		checkStr += 'Password1 ';
	}
	if( !checkPassword2() ) {
		checkStr += 'Password2 ';
	}
	if( checkStr != '' ) {
		var tempStr = checkStr.split(" ");
		$('#input'+tempStr[0]).focus();
		return false;
	}
	else {
		document.resetdoneForm.submit();
		$('.registerArea').fadeOut('slow');
	}
}

// 驗證詳細
function checking(item,alertMsg) {
	if( $('#'+item).val() == '' ) {
		unpassItem(item,alertMsg);
		return false;
	} 
	else {
		passItem(item,alertMsg);
		return true;
	}
}

// 驗證密碼
function checkPassword1(){
	if( $('#inputPassword1').val().length < 4 || !checkVal($('#inputPassword1').val())) {
		unpassItem('inputPassword1','密碼請大於4個英文或數字');
		return false;
	}
	else {
		passItem('inputPassword1','');
		return true;
	}
}
function checkPassword2(){
	if( $('#inputPassword1').val() == $('#inputPassword2').val() && $('#inputPassword1').val().length >= 4 ) {
		passItem('inputPassword2','');
		return true;
	}
	else {
		unpassItem('inputPassword2','密碼不符');
		return false;
	}
}

// 通過
function passItem(DOM,alertText) {
	$('#'+DOM).parent().removeClass('has-error');
	$('#'+DOM).parent().addClass('has-success');
	$('#'+DOM).next().hide();
}

// 不通過
function unpassItem(DOM,alertText) {
	$('#'+DOM).parent().removeClass('has-success');
	$('#'+DOM).parent().addClass('has-error');
	$('#'+DOM).next().html(alertText);
	$('#'+DOM).next().show();
}

// email格式
function validEmail(emailtoCheck) {
	var regExp = /^[^@^\s]+@[^\.@^\s]+(\.[^\.@^\s]+)+$/;
	if ( emailtoCheck.match(regExp) )
		return true;
	else
		return false;
}

// 驗證英數字
function checkVal( str ) {
    var regExp = /^[\d|a-zA-Z]+$/;
    if ( regExp.test(str) ) {
        return true;
	}
    else{
        return false;
	}
}
