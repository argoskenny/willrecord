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
		<div class="container">
			<div class="registerArea">
				<h2>註冊會員</h2>
				<form role="form" action="newreg" method="POST" name="registerFrom">
					<div class="form-group">
						<input type="text" class="form-control" id="inputAccount" name="inputAccount" placeholder="請輸入帳號">
						<span class="alertText" id="alertAccount"></span>
					</div>
					<div class="form-group">
						<input type="password" class="form-control" id="inputPassword1" name="inputPassword1" placeholder="請輸入密碼">
						<span class="alertText" id="alertPassword1"></span>
					</div>
					<div class="form-group">
						<input type="password" class="form-control" id="inputPassword2" name="inputPassword2" placeholder="請確認密碼">
						<span class="alertText" id="alertPassword2"></span>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="inputEmail" name="inputEmail" placeholder="請輸入電子郵件">
						<span class="alertText" id="alertEmail"></span>
					</div>
					<div class="btnMiddle">
						<a class="btn btn-success" id="registerSubmit">免費註冊</a>
						<a class="btn btn-default" disabled="disabled" id="registerLoading">處理中 <img src="assets/img/backgrounds/loading_small.gif"></a>
					</div>
				</form>
				<p class="reg_attention">注意事項：請妥善保管您的密碼，並使用真實的電子郵件，以免遺失密碼時無法重新設定。意志曆絕不會寄送任何無聊又煩人的電子報，敬請安心註冊。</p>
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