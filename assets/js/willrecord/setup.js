$(document).ready(function(){
	// 儲存基本資料
	$('#memberSave').click(function() {
		$('#m_loading').show();
		$('#memberSave').hide();
		var memberName = $('#memberName').val();
		var memberGender = $('input[name=memberGender]:checked').val();
		if (memberGender == '') {
			memberGender = 0;
		};
		var birthday_year = $('#birthday_year').val();
		var birthday_month = $('#birthdaty_month').val();
		var birthday_day = $('#birthdaty_day').val();
		var memberDescription = $('#memberDescription').val();
		var querySting = {	memberName:memberName,
							memberGender:memberGender,
							birthday_year:birthday_year,
							birthday_month:birthday_month,
							birthday_day:birthday_day,
							memberDescription:memberDescription
						};
		$.ajax({
			type: 'POST',
			url: 'ajax/save_profile',
			data: querySting,
			dataType: 'json',
			success: function(data) {
				if( data['status'] == 'success' ) {
					$('#m_loading').hide();
					$('#memberSave').show();
					$('#tab_name').html(memberName);
					alert('儲存成功');
				}
				else {
					alert('發生錯誤，請稍後再試');
				}
			}
		});
	});
});
// 上傳頭像
$('#pic_upload').change(function(){
	var ext = new Array();
	var filearr = new Array();
	if( $('#pic_upload').val() == '' ) {
		alert('請選取檔案');
	}
	ext = $('#pic_upload').val().split('.');
	filearr = ext[0].split('\\');
	if( !checkChinese(filearr[2]) ){
		alert('檔名不得為中文');
		return;
	}
	var filetype = ext[1].toLowerCase();
	if($.inArray(filetype, ['png','jpg','jpeg','gif']) == -1) {
		alert('只允許上傳 JPG 或 PNG 或 GIF 影像檔');
		return;
	}
	if ( !checkpics() ) {
		alert('圖片請勿超過 5MB');
		return;
	}
	
	$('#loading').show();
	$('#my_image').attr('src','');
	$.ajaxFileUpload({
		url: 'ajax/upload_pic', 
		secureuri: false,
		fileElementId: 'pic_upload',
		dataType: 'json',
		success: function(data) {
			if( data['status'] == 'success' ) {
				$('#loading').hide();
				window.location = BASE+'setup/'+$('#mid').val()+'?edit=on';
			}
			else {
				alert('發生錯誤，請稍後再試。');
			}
		}
	});
});
function checkpics(){
	var size = 0;

	if( navigator.userAgent.indexOf("MSIE") > -1) {
		var obj = new ActiveXObject("Scripting.FileSystemObject");
		size = obj.getFile(document.getElementById("pic_upload").value).size;
	}
	else if ( navigator.userAgent.indexOf("Firefox") > -1 
			 || navigator.userAgent.indexOf("Chrome") > -1 
			 || navigator.userAgent.indexOf(".NET") > -1 
			 ||  navigator.userAgent.indexOf("Safari") > -1 ) {
		size = document.getElementById("pic_upload").files.item(0).size;
	}
	else {
		return false;
	}
	
	if( size > 5000000 ){
		alert("上傳檔案不得超過 5MB ");
		return false;
	}
		return true;
}
function checkChinese( str ) {
	// 驗證是否有中文字
	var regExp = /^[\u4E00-\u9FA5]+$/;
	if ( regExp.test(str) ) {
		return false;
	}
    else {
		return true;
	}
}

// 上傳頭像後自動開啟編輯
if ( $('#editpic').val() == 'on' ) {
	$('#avaterPic').hide();
	$('#edit_show').hide();
	$('.imgeditarea').show();
	$('.edit_submit').show();
};

// 裁切頭像
$('#edit_show').click(function() {
	$('#avaterPic').hide();
	$('#edit_show').hide();
	$('.imgeditarea').show();
	$('.edit_submit').show();
});
$('#edit_cancel').click(function(event) {
	$('#avaterPic').show();
	$('#edit_show').show();
	$('.imgeditarea').hide();
	$('.edit_submit').hide();
});
$('#imageEdit').Jcrop({
	onSelect : pasteCropValue,
	minSize : [200,200],
	maxSize : [400,400],
	setSelect : [0, 0, 400, 400],
	aspectRatio: 1 / 1
});
function pasteCropValue(c){
	var cw = Math.round(c.w);
	var ch = Math.round(c.h);
	$('#cropx').val(c.x);
	$('#cropy').val(c.y);
	$('#cropw').val(cw);
	$('#croph').val(ch);
}
$('#position_save').click(function(){
	var mid = $('#mid').val();
	
	var adjust_crop_x = $('#cropx').val();
	var adjust_crop_y = $('#cropy').val();
	var adjust_crop_w = $('#cropw').val();
	var adjust_crop_h = $('#croph').val();
	
	$('#loading').show();
	var querySting = {	mid:mid,
						adjust_crop_x:adjust_crop_x,
						adjust_crop_y:adjust_crop_y,
						adjust_crop_w:adjust_crop_w,
						adjust_crop_h:adjust_crop_h
					};
	$.ajax({
		type: 'POST',
		url: 'ajax/crop_pic',
		data: querySting,
		dataType: 'json',
		success: function(data) {
			if( data['status'] == 'success' ) {
				$('#loading').hide();

				$('#avaterPic').show();
				$('#edit_show').show();
				$('.imgeditarea').hide();
				$('.edit_submit').hide();

				$('#my_image').attr("src",data['src']);
				$('.img-circle').attr("src",data['src']);
			}
			else {
				alert('發生錯誤，請稍後再試');
			}
		}
	});
});