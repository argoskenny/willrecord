$(document).ready(function(){
	// 成功訊息 跳轉
	$('.saveok_btn').click(function() {
		location.reload();
	});
	$('#save_success').click(function() {
		location.reload();
	});
});

// 刪除收藏
function set_collect_del(topic_mid) {
	var login_mid = $('#login_mid').val();
	if (login_mid == '') {
		alert('請先登入才能收藏');
		return;
	};
	var queryData = {topic_mid:topic_mid,
					login_mid:login_mid};
	$.ajax({
		type: "POST",
		url: 'ajax/set_collect',
		data: queryData,
		dataType: 'JSON',
		success: function(data) {
			if( data['status'] == 'success' ){
				$('#save_success').modal('show');
			}
			else {
				alert('發生錯誤，請稍後再試');
			}
		}
	});
}
