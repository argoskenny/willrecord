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
			<h2>忘記密碼？</h2>
			<form role="form" action="send_forget_pwd_mail" method="POST">
				<div class="form-group">
					<label for="forgetpwd_account" class="remind_forgetpwd">請輸入您的帳號。系統將寄信至您註冊時所填寫的Email，內含可讓您重設密碼的連結。</label>
					<input type="text" class="form-control" id="forgetpwd_account" name="forgetpwd_account" placeholder="請輸入帳號">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-success">寄送電子郵件</button>
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
</body> 
</html>