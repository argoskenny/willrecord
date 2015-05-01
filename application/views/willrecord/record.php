<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
	
	<meta name="author" content="AsuraWorks" />
	<meta name="dcterms.rightsHolder" content="AsuraWorks" />
	<meta name="description" content="<?php echo $title;?>，<?php echo $fb_description;?>" />
	<meta name="robots" content="all" />
	<meta name="googlebot" content="all" />
	
	<meta property="og:title" content="<?php echo $title;?>"/>
	<meta property="og:type" content="website"/>
	<meta property="og:image" content="<?php echo base_url();?>assets/img/logo/oglogo.png"/>
	<meta property="og:url" content="<?php echo base_url();?>record/<?php echo $shareaccount;?>"/>
	<meta property="og:description" content="<?php echo $title;?>，<?php echo $fb_description;?>"/>
	
	<title><?php echo $title;?></title>
	<base href="<?php echo base_url();?>"/>
	
	<link rel="shortcut icon" href="<?php echo base_url();?>assets/img/logo/willrecord.ico" >
	<link href="assets/css/common/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/willrecord/public.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/willrecord/record.css" rel="stylesheet" type="text/css" />
</head>

<body ontouchstart="">
	<input type="hidden" id="calender_date" value="<?php echo $calender_date;?>">
	<input type="hidden" id="topic_mid" value="<?php echo $topic_mid;?>">
	<input type="hidden" id="topic_id" value="<?php echo $topic_id;?>">
	<input type="hidden" id="past_record_date" value="">
	<input type="hidden" id="login_mid" value="<?php echo $login_mid;?>">
	<?php $this->load->view('willrecord/menu'); ?>
	
	<div class="main">
		<div class="container">
			
			<?php echo $record_topic_html;?>
			
			<?php if ($topic_condition == 'data_exists') { 
				echo $record_update_html.$record_calender_html.$record_count_html.$intro_self.$disqus_html;
			} elseif ($topic_condition == 'none' && $record_condition == 'self') { ?>
				<div class="jumbotron newtopc">
					<h2>尚無任何新計劃</h2>
					<p>只要簡單的三個步驟，即可建立新的計劃，並馬上開始向您的偉大目標邁進！</p>
					<a data-toggle="modal" href="#step1" class="btn btn-lg btn-success" >創建一項新計劃</a>
				</div>
			<?php } else { ?>
				<div class="jumbotron newtopc">
					<h2>尚無任何新計劃</h2>
				</div>
			<?php } ?>
		</div>
	</div>

<!-- 彈跳視窗 -->
	<!-- 創建計劃 STEP 1 -->
	<div class="modal fade" id="step1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<div class="struction">
						<div class="step action1 stepactive">計劃名稱</div><div class="step action2">每日目標</div><div class="step action3">終極目標</div><div class="step action4">計劃確認</div>
					</div>
				</div>
				
				<div class="modal-body">
					<p>請於下方填寫計劃名稱。</p>
					<input type="text" class="form-control" id="topic_title" name="topic_title" placeholder="請填寫計劃名稱">
					<div class="alert alert-block alert-danger" id="step_1_alert" style="display:none;">
						<p>請填寫計劃名稱。</p>
					</div>
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-lg btn-success" id="step_1_next_btn">下一步</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>

	<!-- 創建計劃 STEP 2 -->
	<div class="modal fade" id="step2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<div class="struction">
						<div class="step action1">計劃名稱</div><div class="step action2 stepactive">每日目標</div><div class="step action3">終極目標</div><div class="step action4">計劃確認</div>
					</div>
				</div>
				
				<div class="modal-body">
					<p>請於下方填寫至少一項每日需達成之目標，並努力實踐。</p>
					<input type="text" class="form-control" id="goal_1" name="goal_1" placeholder="請輸入第一項每日目標">
					<input type="text" class="form-control" id="goal_2" name="goal_2" placeholder="請輸入第二項每日目標">
					<input type="text" class="form-control" id="goal_3" name="goal_3" placeholder="請輸入第三項每日目標">
					<div class="alert alert-block alert-danger" id="step_2_alert" style="display:none;">
						<p>請至少填寫一項目標。</p>
					</div>
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-lg btn-warning" id="step_1_prev_btn">上一步</button>
					<button type="button" class="btn btn-lg btn-success" id="step_2_next_btn">下一步</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>

	<!-- 創建計劃 STEP 3 -->
	<div class="modal fade" id="step3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<div class="struction">
						<div class="step action1">計劃名稱</div><div class="step action2">每日目標</div><div class="step action3 stepactive">終極目標</div><div class="step action4">計劃確認</div>
					</div>
				</div>
				
				<div class="modal-body">
					<p>請於下方填寫終極目標。（選填）</p>
					<input type="text" class="form-control" id="final_goal" name="final_goal" placeholder="請填寫終極目標">
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-lg btn-warning" id="step_2_prev_btn">上一步</button>
					<button type="button" class="btn btn-lg btn-success" id="step3_next_btn">下一步</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>

	<!-- 創建計劃 確認 -->
	<div class="modal fade" id="topic_result" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<div class="struction">
						<div class="step action1">計劃名稱</div><div class="step action2">每日目標</div><div class="step action3">終極目標</div><div class="step action4 stepactive">計劃確認</div>
					</div>
				</div>
				
				<div class="modal-body">
					<p>請於下方確認您的新計劃！</p>
					<div class="panel panel-primary">
						<!-- Default panel contents -->
						<div class="panel-heading">
							計劃名稱：<b id="title_check"></b>
						</div>
						<!-- List group -->
						<ul class="list-group">
							<span id="goal_check"></span>
						</ul>
					</div>
				</div>
				
				<div class="modal-footer">
					<div id="complete_btn_area">
						<button type="button" class="btn btn-lg btn-warning" id="step_3_prev_btn">上一步</button>
						<button type="button" class="btn btn-lg btn-success" id="complete_btn">確定送出</button>
					</div>
					<div id="loading_area">
						<button type="button" class="btn btn-default btn-lg" disabled="disabled">處理中 <img src="assets/img/backgrounds/loading_small.gif"></button>
					</div>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>

	<!-- 結束計劃 -->
	<div class="modal fade" id="end_topic_pop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title">結束計劃</h4>
				</div>
				
				<div class="modal-body end_select">
					<h2>您已達成目標了嗎？</h2>
					<button type="button" class="btn btn-lg btn-success" id="topic_success">成功</button>
					<button type="button" class="btn btn-lg btn-danger" id="topic_fail">失敗</button>
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-lg btn-default" id="close_end_topic_pop">取消</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>

	<!-- 過去紀錄 -->
	<div class="modal fade" id="past_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title">過去紀錄</h4>
				</div>
				<div class="modal-body end_select">
					<h2><span id="past_date"></span>，那天您達成目標了嗎？</h2>
					<button type="button" class="btn btn-lg btn-success" id="past_success">成功</button>
					<button type="button" class="btn btn-lg btn-danger" id="past_fail">失敗</button>
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-lg btn-default" id="close_past_record">取消</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>

	<!-- 儲存成功 紀錄使用 -->
	<div class="modal fade" id="record_save" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content saveok_content">
				已儲存成功！<br />
				<button type="button" class="btn btn-default record_ok" data-dismiss="modal">關閉</button>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<!-- 儲存成功 計劃使用 -->
	<div class="modal fade" id="save_success" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content saveok_content">
				<span id="save_title"></span><br />
				<button type="button" class="btn btn-default saveok_btn" data-dismiss="modal">關閉</button>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
<!-- 彈跳視窗 -->

<!-- FOOTER -->
<?php $this->load->view('willrecord/footer'); ?>

<script type="text/javascript" src="assets/js/common/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="assets/js/common/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/common/holder.js"></script>
<script type="text/javascript">var BASE = '<?php echo base_url();?>';</script>
<script type="text/javascript" src="assets/js/willrecord/public.js"></script>
<script type="text/javascript" src="assets/js/willrecord/record.js"></script> 
</body>
</html>