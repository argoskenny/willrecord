<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
	
	<meta name="author" content="AsuraWorks" />
	<meta name="dcterms.rightsHolder" content="AsuraWorks" />
	<meta name="robots" content="none" />
	<meta name="googlebot" content="none" />
	
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
			<h2>重設密碼</h2>
			<form role="form" action="resetdone" method="POST" name="resetdoneForm">
				<div class="form-group">
					<input type="password" class="form-control" id="inputPassword1" name="inputPassword1" placeholder="請輸入密碼">
					<span class="alertText" id="alertPassword1"></span>
				</div>
				<div class="form-group">
					<input type="password" class="form-control" id="inputPassword2" name="inputPassword2" placeholder="請確認密碼">
					<span class="alertText" id="alertPassword2"></span>
				</div>
				<div class="btnMiddle">
					<button type="button" class="btn btn-success" id="resetPwdSubmit">確定送出</button>
				</div>
			</form>
		</div>
	</div>

	<!-- FOOTER -->
	<?php $this->load->view('willrecord/footer'); ?>

<script type="text/javascript" src="assets/js/common/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="assets/js/common/bootstrap.min.js"></script>
<script type="text/javascript">var BASE = '<?php echo base_url();?>';</script>
<script type="text/javascript" src="assets/js/willrecord/public.js"></script>
<script type="text/javascript" src="assets/js/willrecord/resetpwd.js"></script> 
</body> 
</html>