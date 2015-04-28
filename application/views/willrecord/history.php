<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
	
	<meta name="author" content="AsuraWorks" />
	<meta name="dcterms.rightsHolder" content="AsuraWorks" />
	<meta name="description" content="意志曆，紀錄您的恆心與毅力，留下您的辛勞與汗水。意志曆將協助您實現心願、改變一切！不論您是希望能瘦身減重，還是想戒除陋習，您都能免費利用意志曆幫助您達成您的目標！" />
	<meta name="robots" content="all" />
	<meta name="googlebot" content="all" />
	
	<meta property="og:title" content="意志曆"/>
	<meta property="og:type" content="website"/>
	<meta property="og:image" content="<?php echo base_url();?>assets/img/logo/oglogo.png"/>
	<meta property="og:url" content="<?php echo base_url();?>"/>
	<meta property="og:description" content="意志曆，紀錄您的恆心與毅力，留下您的辛勞與汗水。意志曆將協助您實現心願、改變一切！不論您是希望能瘦身減重，還是想戒除陋習，您都能免費利用意志曆幫助您達成您的目標！"/>
	
	<title><?php echo $title;?></title>
	<base href="<?php echo base_url();?>"/>
	
	<link rel="shortcut icon" href="<?php echo base_url();?>assets/img/logo/willrecord.ico" >
	<link href="assets/css/common/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/willrecord/public.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/willrecord/history.css" rel="stylesheet" type="text/css" />
</head>

<body ontouchstart="">
	<?php $this->load->view('willrecord/menu'); ?>
	
	<div class="main">
		<div class="container">
			<?php echo $record_topic_html.$history_topic; ?>
		</div>
	</div>

	<!-- 儲存成功 計劃使用 -->
	<div class="modal fade" id="save_success" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content saveok_content">
				<span id="save_title"></span><br />
				<button type="button" class="btn btn-default saveok_btn" data-dismiss="modal">關閉</button>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
	<!-- FOOTER -->
	<?php $this->load->view('willrecord/footer'); ?>

<script type="text/javascript" src="assets/js/common/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="assets/js/common/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/common/holder.js"></script>
<script type="text/javascript">var BASE = '<?php echo base_url();?>';</script>
<script type="text/javascript" src="assets/js/willrecord/public.js"></script>
<script type="text/javascript" src="assets/js/willrecord/history.js"></script> 
</body>
</html>