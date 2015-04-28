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
			<h2>關於意志曆</h2>
			<p style="margin-top:30px;">有聽過<a href="http://www.google.com.tw/search?q=好寶寶印章" target="_blank"><b>好寶寶印章</b></a>嗎？意志歷最一開始的靈感就是來自於此。</p>
			<p>只不過這一次，幫忙蓋印章的不是老師或父母，而是自己。</p>
			<p>在月曆上的那些紀錄，將象徵著自己對自己所立下的誓約、榮譽與尊嚴。</p>
			<p>這是一場可能是畢生最大的戰爭，向自己所提出的終極挑戰。</p>
			<p>為自己而戰，也對自己負責。讓自己在回顧一切時，能享受著「已征服了自我」的那種成就感。</p>
			<p style="margin-top:30px;">相信自己，給自己一次改變的機會。</p>
			<p>現在就<a href="login"><b>開始紀錄您的意志曆</b></a>！</p>
			<h2 style="margin-top:50px;">產品設計理念</h2>
			<p style="margin-top:30px;">意志曆打從最初的草創時期，就已立定了以下三大堅持。</p>
			<div class="well"style="margin-bottom:10px;">
				<p><b>一、意志曆無論是產品設計還是行銷策略上，都以「不干擾使用者」為最高原則。</b></p>
				<p><b>二、意志曆將會竭盡所能以最輕鬆簡單的操作方式，提供使用者最需要的功能。</b></p>
				<b>三、意志曆以協助更多人砥礪自我、達成目標為使命。</b>
			</div>
			<p>任何違反上述原則的決定，都將盡力排除。</p>
			<p>其目的無非是希望使用者能毫無障礙的紀錄意志曆，畢竟任何人來此處最終的目標，就是訓練自己、讓自己更具恆心和毅力，以便完成心願。</p>
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