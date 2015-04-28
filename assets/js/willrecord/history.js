$(document).ready(function(){
	// 成功訊息 跳轉
	$('.saveok_btn').click(function() {
		location.reload();
	});
	$('#save_success').click(function() {
		location.reload();
	});
});

// 設定計劃公開或隱藏
function set_topic_show(is_show,topic_id) {
	var queryData = {is_show:is_show,
					topic_id:topic_id
					};
	$.ajax({
		type: "POST",
		url: 'ajax/set_topic_show',
		data: queryData,
		dataType: 'JSON',
		success: function(data) {
			if( data['status'] == 'success' ){
				$('#save_title').html(data['msg']);
				$('#save_success').modal('show');
			}
			else {
				alert(data['msg']);
			}
		}
	});
}
