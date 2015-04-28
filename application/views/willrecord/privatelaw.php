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
			<h2>隱私權政策</h2>
			<p>1. 意志曆將不會以任何方式，包括以電子郵件、電話或是通訊軟體...等，向會員要求私密性資料。</p>
			<p>2. 除了需要重新設定密碼以外，意志曆將不會主動寄送任何電子郵件或電子報給會員。</p>
			<p>3. 除非會員已違反相關法律及收到正式調查函文，意志曆將不會提供會員之任何資料給任何第三方人士、單位或機關。</p>
			<p>4. 強烈建議會員絕對不要將密碼告知任何人，意志曆也不會以任何形式詢問或提供與密碼相關之任何資料。</p>
			<p>5. 會員上傳之圖片所有版權均為該圖片版權人所有，會員需自行注意上傳之圖片是否違反相關法律，此將由該會員自行負責。</p>
			<p>6. 意志曆將會使用會員所提供之資料及數據進行內部相關之研究與分析。相關之研究數據結果將可能於意志曆網站上公開。</p>
			<p>7. 本隱私政策可能於未來進行修改，並將不另行通知。</p>
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