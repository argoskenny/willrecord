<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
	<meta name="robots" content="none" />
	<meta name="googlebot" content="none" />
	<title><?php echo $title;?></title>
	<base href="<?php echo base_url();?>"/>
	<link href="assets/css/common/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/willrecordadmin/admin_login.css" rel="stylesheet" type="text/css" />
	<link rel="shortcut icon" href="<?php echo base_url();?>assets/img/logo/admin.ico" >
</head>

<body ontouchstart="">
	<div class="container">

		<form class="form-signin" action="willrecordadmin/admin_loginset" method="POST">
			<h2 class="form-signin-heading">意志曆 登入</h2>
			<input type="text" class="form-control" name="adminID" placeholder="id">
			<input type="password" class="form-control" name="password" placeholder="Password">
			<button class="btn btn-lg btn-primary btn-block" type="submit">登入</button>
		</form>
		
    </div>
</body>
<script type="text/javascript" src="assets/js/common/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="assets/js/common/bootstrap.min.js"></script>
<script type="text/javascript">
</script>
</html>