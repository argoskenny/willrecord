<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="none" />
	<meta name="googlebot" content="none" />
	<title><?php echo $title;?></title>
	<base href="<?php echo base_url();?>"/>
	<link href="assets/css/common/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/willrecordadmin/admin.css" rel="stylesheet" type="text/css" />
	<link rel="shortcut icon" href="<?php echo base_url();?>assets/img/logo/admin.ico" >
</head>

<body ontouchstart="">
	
	<?php $this->load->view('willrecordadmin/adminmenu'); ?>

	<div class="container-fluid">

		<?php $this->load->view('willrecordadmin/sidebar'); ?>

		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<h1 class="page-header">意志曆 <?php echo $title;?></h1>
		</div>
	</div>
</body>
<script type="text/javascript" src="assets/js/common/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="assets/js/common/bootstrap.min.js"></script>
<script type="text/javascript">
</script>
</html>