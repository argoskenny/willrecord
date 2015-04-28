$(document).ready(function(){
	// 新增計劃
	$("#step_1_next_btn").click(function(){
		if ( $('#topic_title').val() == '' ) {
			$('#step_1_alert').show();
		}
		else {
			$('#step_1_alert').hide();
			$('#step1').modal('hide');
			$('#step2').modal('show');
		}
	});

	$('#step_1_prev_btn').click(function(){
		$('#step1').modal('show');
		$('#step2').modal('hide');
	});

	$("#step_2_next_btn").click(function(){
		if ( $('#goal_1').val() == '' && 
			$('#goal_2').val() == '' && 
			$('#goal_3').val() == '' ) {
			$('#step_2_alert').show();
		}
		else {
			$('#step_2_alert').hide();
			$('#step2').modal('hide');
			$('#step3').modal('show');
		}
	});

	$('#step_2_prev_btn').click(function(){
		$('#step2').modal('show');
		$('#step3').modal('hide');
	});

	$("#step3_next_btn").click(function(){
		$('#step3').modal('hide');

		// 計劃名稱呈現
		$('#title_check').html($('#topic_title').val());
		
		// 每日目標呈現
		var goal_array = new Array(	$('#goal_1').val(),
									$('#goal_2').val(),
									$('#goal_3').val() );
		var goal_exists = 1;
		var goal_item = '';
		var goal_html = '';
		for ( var key in goal_array ) {
			if ( goal_array[key] != '' ) {
				switch( goal_exists ){
					case 1:
						goal_item = '一';
					break;
					case 2:
						goal_item = '二';
					break;
					case 3:
						goal_item = '三';
					break;
				}
				goal_html += '<li class="list-group-item">第'+goal_item+'目標：<b>'+goal_array[key]+'</b></li>';
				goal_exists++;
			};
		};
		// 終極目標呈現
		if ( $('#final_goal').val() != '' ) {
			goal_html += '<li class="list-group-item list-group-item-danger">終極目標：<b>'+$('#final_goal').val()+'</b></li>';
		};
		
		$('#goal_check').html(goal_html);
		$('#topic_result').modal('show');
	});

	$('#step_3_prev_btn').click(function(){
		$('#step3').modal('show');
		$('#topic_result').modal('hide');
	});

	// 送出
	$('#complete_btn').click(function(){
		var title = $('#topic_title').val();
		var goal_1 = $('#goal_1').val();
		var goal_2 = $('#goal_2').val();
		var goal_3 = $('#goal_3').val();
		var final_goal = $('#final_goal').val();

		if ( title == '' ) {
			alert('請輸入計劃名稱');
			return;
		};
		if ( goal_1 == '' ) {
			goal_1 = '';
		};
		if ( goal_2 == '' ) {
			goal_2 = '';
		};
		if ( goal_3 == '' ) {
			goal_3 = '';
		};
		if ( final_goal == '' ) {
			final_goal = '';
		};

		var queryData = {title:title,
						goal_1:goal_1,
						goal_2:goal_2,
						goal_3:goal_3,
						final_goal:final_goal
						};
		$('#complete_btn_area').hide();
		$('#loading_area').show();
		$.ajax({
			type: "POST",
			url: 'ajax/createNewTopic',
			dataType: 'JSON',
			data: queryData,
			success: function(data) {
				if( data['status'] == 'success' ){
					$('#save_title').html('您已成功建立一項新計劃！');
					$('#topic_result').modal('hide');
					$('#save_success').modal('show');
				}
			}
		});
	});

	// 今日是否成功
	$('#day_success').click(function(){
		set_record(1);
	});
	$('#day_fail').click(function(){
		set_record(2);
	});

	// 關閉過去紀錄視窗
	$('#close_past_record').click(function() {
		$('#past_record_modal').modal('hide');
	});

	// 過去是否成功
	$('#past_success').click(function() {
		set_past_record(1);
	});
	$('#past_fail').click(function() {
		set_past_record(2);
	});

	// 計劃隱藏或公開
	$('#topic_set_publict').click(function() {
		set_topic_show(1);
	});
	$('#topic_set_private').click(function() {
		set_topic_show(0);
	});

	// 結束計劃提示
	$('#end_topic').tooltip('hide');

	// 結束計劃視窗
	$('#end_topic').click(function() {
		$('#end_topic_pop').modal('show');
	});

	// 關閉結束視窗
	$('#close_end_topic_pop').click(function() {
		$('#end_topic_pop').modal('hide');
	});

	// 計劃成功
	$('#topic_success').click(function() {
		set_end_topic(1);
	});

	// 計劃失敗
	$('#topic_fail').click(function() {
		set_end_topic(2);
	});

	// 收藏
	$('#collect_account').click(function(event) {
		set_collect();
	});

});
// 設定今日目標
function set_record(condition){
	if (condition == 1) {
		var tag = 'success_tag';
	}
	else{
		var tag = 'fail_tag';
	}
	var topic_id = $('#topic_id').val();
	var queryData = {condition:condition,
					topic_id:topic_id};
	$.ajax({
		type: "POST",
		url: 'ajax/set_record',
		data: queryData,
		dataType: 'JSON',
		success: function(data) {
			if( data['status'] == 'success' ){
				$('#record_save').modal('show');
				$('#set_day_record').hide();
				$('.today').addClass(tag);
				$('#unset_num').html( parseInt($('#unset_num').html(),10) - 1 );
				
				// 統計數字
				if ( condition == 1 ) {
					$('#success_num').html( parseInt($('#success_num').html(),10) + 1 );
				}
				else{
					$('#fail_num').html( parseInt($('#fail_num').html(),10) + 1 );
				}
			}
			else {
				alert('發生錯誤，請稍後再試');
			}
		}
	});
}

// 設定過去紀錄
function set_past_modal(past_date){
	$('#past_record_date').val(past_date);
	var past_date_str = past_date.toString();
	var past_year = past_date_str.substr('0','4');
	var past_month = past_date_str.substr('4','2');
	var past_day = past_date_str.substr('6','2');
	$('#past_date').html(past_year+'年'+past_month+'月'+past_day+'號');
	$('#past_record_modal').modal('show');
}
function set_past_record(condition){
	if (condition == 1) {
		var tag = 'success_tag';
	}
	else{
		var tag = 'fail_tag';
	}
	var topic_id = $('#topic_id').val();
	var past_record_date = $('#past_record_date').val();
	var queryData = {condition:condition,
					topic_id:topic_id,
					past_record_date:past_record_date};
	$.ajax({
		type: "POST",
		url: 'ajax/set_past_record',
		data: queryData,
		dataType: 'JSON',
		success: function(data) {
			if( data['status'] == 'success' ){
				$('#past_record_modal').modal('hide');
				$('#record_save').modal('show');
				$('#td_'+past_record_date).addClass(tag);
				$('#editicon_'+past_record_date).remove();
				$('#unset_num').html( parseInt($('#unset_num').html(),10) - 1 );
				
				// 統計數字
				if ( condition == 1 ) {
					$('#success_num').html( parseInt($('#success_num').html(),10) + 1 );
				}
				else{
					$('#fail_num').html( parseInt($('#fail_num').html(),10) + 1 );
				}
			}
			else {
				alert(data['msg']);
			}
		}
	});	
}

// 設定計劃公開或隱藏
function set_topic_show(is_show) {
	var topic_id = $('#topic_id').val();
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

// 月曆 上一頁 下一頁
function calendar_change(action,nextdate) {
	var nowdate = $('#calender_date').val();
	var topic_mid = $('#topic_mid').val();
	var topic_id = $('#topic_id').val();
	var queryData = {action:action,
					nowdate:nowdate,
					nextdate:nextdate,
					topic_mid:topic_mid,
					topic_id:topic_id
					};
	$('.table-bordered').hide();
	$('.loading_div').show();
	$.ajax({
		type: "POST",
		url: 'ajax/calendar_change',
		data: queryData,
		dataType: 'JSON',
		success: function(data) {
			if( data['status'] == 'success' ){
				$('#calender_date').val(data['next_date']);
				$('#calendar_area').html(data['calendar_html']);
			}
			else {
				alert('發生錯誤，請稍後再試');
			}
		}
	});
}

// 結束計劃
function set_end_topic(select_status){
	var topic_id = $('#topic_id').val();
	var queryData = {select_status:select_status,
					topic_id:topic_id};
	$.ajax({
		type: "POST",
		url: 'ajax/set_end_topic',
		data: queryData,
		dataType: 'JSON',
		success: function(data) {
			if( data['status'] == 'success' ){
				if (select_status == 1) {
					$('#save_title').html('恭喜您！計劃成功！');
					$('#save_success').modal('show');
					$('#end_topic_pop').modal('hide');
				};
				if (select_status == 2) {
					$('#save_title').html('計劃失敗！請不要氣餒，再接再厲！');
					$('#save_success').modal('show');
					$('#end_topic_pop').modal('hide');
				};
			}
			else {
				alert('發生錯誤，請稍後再試');
			}
		}
	});
}
$('#record_ok').click(function() {
	$('#record_save').modal('hide');
});
// 成功訊息 跳轉
$('.saveok_btn').click(function() {
	location.reload();
});
$('#save_success').click(function() {
	location.reload();
});

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

// 收藏提示
$('#collect_account').tooltip();

function set_collect () {
	var topic_mid = $('#topic_mid').val();
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
				$('#collect_star').removeClass(data['remove_class']);
				$('#collect_star').addClass(data['add_class']);
			}
			else {
				alert('發生錯誤，請稍後再試');
			}
		}
	});
}

// 分享
function share_to_twitter () {
	javascript:desc='';
	if(window.getSelection)desc=window.getSelection();
	if(document.getSelection)desc=document.getSelection();
	if(document.selection)desc=document.selection.createRange().text;
	void(open('http://twitter.com/?status='+encodeURIComponent(location.href+' ('+document.title.split('@')[0].replace(/([\s]*$)/g,'')+')')));
}
function share_to_plurk () {
	javascript:desc='';
	if(window.getSelection)desc=window.getSelection();
	if(document.getSelection)desc=document.getSelection();
	if(document.selection)desc=document.selection.createRange().text;void(open('http://www.plurk.com/?qualifier=shares&amp;status='+encodeURIComponent(location.href+' ('+document.title.split('@')[0].replace(/([\s]*$)/g,'')+')')));
}
function share_to_google () {
	javascript:void(window.open('https://plus.google.com/share?url='.concat(encodeURIComponent(location.href)), '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'));
}