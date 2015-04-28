$(document).ready(function(){
	// 登入
	$("#loginForm").keyup(function(event){
		if(event.keyCode == 13){
			accountLogin();
		}
	});
	$('#send').click(function() {
		accountLogin();
	});
});

// 登入
function accountLogin(){
	if( $('#account').val() == '' ) {
			$('#alertMsg').show();
			return false;
		}
		if( $('#password').val() == '' ) {
			$('#alertMsg').show();
			return false;
		}

		var account = $('#account').val();
		var password = $('#password').val();
		var remember = 0;
		if( $('#remember_checkbox').is(":checked") ) {
			remember = 1;
		}
		$.ajax({
			type: 'POST',
			url: 'ajax/login',
			dataType: 'JSON',
			data: 	{account:account,
					password:password,
					remember:remember},
			success:function(data) {
				if( data['status'] == 'success' ) {
					window.location = BASE+'record/'+data['memberaccount'];
				}
				else {
					$('#alertMsg').show();
					return false;
				}
			},
			error:function() {
				alert('發生錯誤！');
			}
		});
}

// 捲動到最上面
function gotop() {
	$("html,body").animate({scrollTop:0},900);
}