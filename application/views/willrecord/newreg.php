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
	<base href="<?php echo base_url();?>"/><!--[if IE]></base><![endif]-->
	
	<link rel="shortcut icon" href="<?php echo base_url();?>assets/img/logo/willrecord.ico" >
	<link href="assets/css/common/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/willrecord/public.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/willrecord/register.css" rel="stylesheet" type="text/css" />
</head>

<body ontouchstart="">
	
	<?php $this->load->view('willrecord/menu'); ?>

	<div class="main">
		<div class="container registerArea">
			<div class="alert alert-success success-msg" id="successMsg">
				<strong>恭喜！您已完成註冊囉！</strong><br/>
				請<a href="login" class="alert-link">點擊此連結並登入帳號</a>，開始戰鬥吧！
			</div>
		</div>
	</div>

	<!-- FOOTER -->
	<?php $this->load->view('willrecord/footer'); ?>

<script type="text/javascript" src="assets/js/common/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="assets/js/common/bootstrap.min.js"></script>
<script type="text/javascript">var BASE = '<?php echo base_url();?>';</script>
<script type="text/javascript" src="assets/js/willrecord/public.js"></script>
<script type="text/javascript" src="assets/js/willrecord/register.js"></script> 
</body> 
</html>