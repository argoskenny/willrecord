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
</head>

<body ontouchstart="">
	
	<?php $this->load->view('willrecord/menu'); ?>
	
	<div class="main">
		<div class="container">
			<h2>使用條款</h2>
			<p>如不同意以下使用條款，請勿使用本站之服務及產品。意志曆將有權對違反使用條款之相關內容進行修改或刪除。會員資料亦可能進行停權或關閉。</p>
			<p>1. 使用意志曆網站服務，包括創建計劃、留言、上傳圖片或基本資料...等，請注意是否已違反中華民國法律及社會善良風俗，請勿張貼具爭議性、反社會性之相關內容。</p>
			<p>2. 請勿張貼或上傳違反版權之相關內容。</p>
			<p>3. 請勿張貼或上傳廣告或進行其它商業交易。</p>
			<p>4. 請勿以任何方式張貼大量無用內容。</p>
			<p>5. 請誠實使用，勿自欺欺人。</p>
			<p>6. 請勿輕易放棄計劃。加油你可以的。</p>
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