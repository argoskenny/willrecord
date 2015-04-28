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
	<link href="assets/css/willrecord/index.css" rel="stylesheet" type="text/css" />
</head>

<body ontouchstart="">
	
	<?php $this->load->view('willrecord/menu'); ?>

	<div class="main">
		<div class="container">
			<div class="intro_top">
				<h1>邁步向前吧！</h1>
				<p>紀錄您的恆心與毅力，留下您的辛勞與汗水。意志曆將協助您實現心願、改變一切！</p>
				<p>使用意志曆能夠以最輕鬆簡單的方式，寫下您努力不懈的足跡！讓您能夠將心力專注於個人計劃之上！</p>
				<p>請放一百二十個心，這裡的一切<strong>完全免費！</strong></p>
				<a class="btn btn-lg btn-success" href="register" role="button">免費註冊</a>
			</div>
			<div class="move">
				<a href="#intro_begin">
					<img src="assets/img/backgrounds/move.png" class="img-circle">
				</a>
			</div>
		</div><!-- /.container -->
	</div>
	<a name="intro_begin"></a>
	<div class="intro_question">
		<div class="bot_shadow">
			<ul id="question_scene">
				<li class="layer" data-depth="0.00">
					<div class="title">
						<h1>您有什麼心願呢？</h1><br>
						點選方塊中的選項，或是於最下方輸入您個人想完成的事。
					</div>
				</li>
				<li class="layer" data-depth="0.20">
					<a href="#intro_one" id="smoke_btn" rel="1">
						<div class="change smoke">我想<span>戒煙戒酒</span></div>
					</a>
				</li>
				<li class="layer" data-depth="0.40">
					<a href="#intro_one" id="diet_btn" rel="2">
						<div class="change diet">我想<span>瘦身減重</span></div>
					</a>
				</li>
				<li class="layer" data-depth="0.60">
					<a href="#intro_one" id="excercise_btn" rel="3">
						<div class="change excercise">我想<span>鍛鍊體魄</span></div>
					</a>
				</li>
				<li class="layer" data-depth="0.80">
					<a href="#intro_one" id="study_btn" rel="4">
						<div class="change study">我想<span>努力用功</span></div>
					</a>
				</li>
				<li class="layer" data-depth="0.90">
					<a href="#intro_one" id="save_btn" rel="5">
						<div class="change save">我想<span>存錢省錢</span></div>
					</a>
				</li>
				<li class="layer" data-depth="1.00">
					<div class="custom">我想<input type="text" id="answer" class="underline_input"></div>
				</li>
			</ul>
		</div>
	</div>
	<a name="intro_one"></a>
	<div class="intro_project">
		<div class="container">
			<div class="col-md-7 mobile_area">
				<h2>簡單三步驟，輕鬆建立新計劃！</h2>
				<p>註冊並登入會員後，無需再進行任何其它設定或認證，馬上即可開始建立您的個人計劃！</p>
			</div>
			<div class="col-md-5">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<span id="project_title">計劃名稱：存錢出國旅遊去！</span>
						<span class="topic_start_date">開始日期：<?php echo date('Y-m-d');?></span>
					</div>
					<ul class="list-group">
						<li class="list-group-item">第一目標：<b id="goal1">非假日午餐禁止超過100元</b></li>
						<li class="list-group-item">第二目標：<b id="goal2">隨手關燈、關水，節能省電費</b></li>
						<li class="list-group-item">第三目標：<b id="goal3">戒除咖啡、菸、酒非必要開支，</b></li>
						<li class="list-group-item list-group-item-danger">終極目標：<b id="finalgoal">存到旅行預算5萬元</b></li>
					</ul>
				</div>
			</div>
			<div class="col-md-7 pc_area">
				<h2>簡單三步驟，輕鬆建立新計劃！</h2>
				<p>註冊並登入會員後，無需再進行任何其它設定或認證，馬上即可開始建立您的個人計劃！</p>
			</div>
		</div>
	</div>
	<div class="intro_dayrecord">
		<div class="bot_shadow">
			<div class="container">
				<div class="jumbotron goal_set" id="set_day_record">
					<h1>您今日是否已達成目標？</h1>
					<p>
						<a class="btn btn-success btn-lg" role="button" id="day_success" href="#intro_two">成功</a>
						<a class="btn btn-danger btn-lg" role="button" id="day_fail" href="#intro_two">失敗</a>
					</p>
				</div>
			</div>
		</div>
	</div>
	<a name="intro_two"></a>
	<div class="intro_record">
		<div class="container">
			<div class="col-md-7">
				<h2>每日一動作，回顧紀錄方便又好用！</h2>
				<p>在建立了的個人計劃後，每天只需要選擇是否已達成當日目標，即可輕鬆紀錄您的意志曆！</p>
			</div>
			<div class="col-md-5">
				<table class="table table-bordered">
					<tbody>
					<tr>
					    <th>週日</th>
					    <th>週一</th>
					    <th>週二</th>
					    <th>週三</th>
					    <th>週四</th>
					    <th>週五</th>
					    <th>週六</th>
					</tr>
					<tr>
						<td class="active"><span class="not_current_month">23</span></td>
						<td class="active"><span class="not_current_month">24</span></td>
						<td class="active"><span class="not_current_month">25</span></td>
						<td class="active"><span class="not_current_month">26</span></td>
						<td class="active"><span class="not_current_month">27</span></td>
						<td class="active"><span class="not_current_month">28</span></td>
						<td class="normal success_tag" id="td_20140301">1</td>
					</tr>
					<tr>
						<td class="normal fail_tag" id="td_20140302">2</td>
						<td class="normal success_tag" id="td_20140303">3</td>
						<td class="normal success_tag" id="td_20140304">4</td>
						<td class="normal fail_tag" id="td_20140305">5</td>
						<td class="normal success_tag" id="td_20140306">6</td>
						<td class="normal success_tag" id="td_20140307">7</td>
						<td class="normal success_tag" id="td_20140308">8</td>
					</tr>
					<tr>
						<td class="normal success_tag" id="td_20140309">9</td>
						<td class="normal success_tag" id="td_20140310">10</td>
						<td class="normal" id="td_20140311">11
							<a href="javascript:;">
	                        	<img src="assets/img/backgrounds/edit_icon.png" class="edit_past_icon">
	                    	</a>
	                    </td>
	                    <td class="today" id="td_20140312">12</td>
	                    <td class="active" id="td_20140313">13</td>
	                    <td class="active" id="td_20140314">14</td>
	                    <td class="active" id="td_20140315">15</td>
	                </tr>
	                <tr>
	                	<td class="active" id="td_20140316">16</td>
	                	<td class="active" id="td_20140317">17</td>
	                	<td class="active" id="td_20140318">18</td>
	                	<td class="active" id="td_20140319">19</td>
	                	<td class="active" id="td_20140320">20</td>
	                	<td class="active" id="td_20140321">21</td>
	                	<td class="active" id="td_20140322">22</td>
	                </tr>
	                <tr>
	                	<td class="active" id="td_20140323">23</td>
	                	<td class="active" id="td_20140324">24</td>
	                	<td class="active" id="td_20140325">25</td>
	                	<td class="active" id="td_20140326">26</td>
	                	<td class="active" id="td_20140327">27</td>
	                	<td class="active" id="td_20140328">28</td>
	                	<td class="active" id="td_20140329">29</td>
	                </tr>
	                <tr>
	                	<td class="active" id="td_20140330">30</td>
	                	<td class="active" id="td_20140331">31</td>
	                	<td class="active"><span class="not_current_month">4月1日</span></td>
	                	<td class="active"><span class="not_current_month">2</span></td>
	                	<td class="active"><span class="not_current_month">3</span></td>
	                	<td class="active"><span class="not_current_month">4</span></td>
	                	<td class="active"><span class="not_current_month">5</span></td>
	                </tr>
	                </tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="intro_other">
		<div class="container marketing">
			<div class="row">
				<div class="col-lg-4">
					<div class="transparent_lock">
						<img class="img-rounded" alt="140x140" src="assets/img/backgrounds/other_setting.png" style="width: 140px; height: 140px;">
						<h2>個人資料</h2>
						<p>您可自由選擇是否要輸入個人暱稱、性別、生日以及自我簡介，讓其它人能夠輕易的認識您！</p>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="transparent_lock">
						<img class="img-rounded" alt="140x140" src="assets/img/backgrounds/other_collect.png" style="width: 140px; height: 140px;">
						<h2>收藏列表</h2>
						<p>讓您能夠輕鬆收藏朋友們的意志曆，互相激勵打氣，共同完成彼此的願望！</p>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="transparent_lock">
						<img class="img-rounded" alt="140x140" src="assets/img/backgrounds/other_private.png" style="width: 140px; height: 140px;">
						<h2>隱私設定</h2>
						<p>私人計劃不便公開？沒問題！您可隨時設定公開或隱藏計劃！一切由您決定！</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- FOOTER -->
	<?php $this->load->view('willrecord/footer'); ?>

<script type="text/javascript" src="assets/js/common/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="assets/js/common/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/common/holder.js"></script>
<script type="text/javascript" src="assets/js/common/jquery.parallax.js"></script>
<script type="text/javascript" src="assets/js/willrecord/public.js"></script>
<script type="text/javascript" src="assets/js/willrecord/index.js"></script>
</body> 
</html>