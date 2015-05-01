<?php
class Willrecord extends CI_Controller {
	
	// 建構子
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		
		// 引入偵測瀏覽環境
		$this->load->library('user_agent');

		// 引入連結
		$this->load->helper('url');
		
		// 引入SESSION
		$this->load->library('nativesession');
		
		// 引入COOKIE
		$this->load->helper('cookie');

		// 自動登入
		$this->cookie_check();	
	}
	
	// 首頁
	public function index()
	{
		$dataArr = $this->session_info();
		if ( count($dataArr) > 0 )
		{
			$data['account'] = $dataArr[0]['account'];
		}

		$data['title'] = '意志曆';
		$this->load->view('willrecord/index',$data);
	}
	
	// 紀錄頁
	public function record($account)
	{
		// 存取登入者計劃資料
		$uncheckArr = $this->session_info();
		
		// 頁籤處理
		$checkedArr = $this->get_data_info_public($account,$uncheckArr);
		$login_account = $checkedArr['login_account'];
		$record_condition = $checkedArr['record_condition'];
		$login_mid = $checkedArr['login_mid'];
		$dataArr = $checkedArr['dataArr'];
		$headPic = $this->get_headimg($dataArr);
		$tab_title = ( !empty($dataArr[0]['name']) ) ? $dataArr[0]['name'] : $account;
		$record_topic_html = $this->get_tab_html('record',$headPic,$tab_title,$account,$record_condition);
		
		// 計劃資料
		$topicWhereArr = array( 'm_id' => $dataArr[0]['id'], 'end_time' => '0', 'is_close' => '1' );
		$queryTopic = $this->db->get_where('w_topic',$topicWhereArr);
		$topicDataArr = $queryTopic->result_array();
		
		// 計劃存在
		if ( count($topicDataArr) > 0) {
			if ( $record_condition == 'self' ) {
				$display = 'show';
			}
			else {
				// 是否公開
				$display = ($topicDataArr[0]['is_show'] == '1') ? 'show' : 'hide';
			}
		}
		else {
			$display = 'hide';
		}

		// 是否顯示
		switch ($display) {
			case 'show':
				$data['topic_condition'] = 'data_exists';
				$topic_id = $topicDataArr[0]['id'];

				// 收藏
				$collect_sum = 0;
				if ($record_condition == 'other' && $login_mid != '') {
					$collectWhereArr['tm_id'] = $topicDataArr[0]['m_id'];
					$collectWhereArr['m_id'] = $login_mid;
					$checkCollectQuery = $this->db->get_where('w_collect',$collectWhereArr);
					$checkCollectArr = $checkCollectQuery->result_array();
					$collect_class = ( count($checkCollectArr) > 0 ) ? 'glyphicon-star' : 'glyphicon-star-empty';
					$collect_tip = 'data-toggle="tooltip" data-placement="right" title="收藏 '.$tab_title.' 的意志曆"';
					$collect_html = '<a href="javascript:;" class="btn btn-default" id="collect_account" '.$collect_tip.'>
										<span class="glyphicon '.$collect_class.'" id="collect_star"></span>收藏
									</a>';
				}
				else {
					$this->db->where('tm_id',$topicDataArr[0]['m_id']);
					$this->db->from('w_collect');
					$collect_sum = $this->db->count_all_results();
					$collect_html = '<span class="glyphicon glyphicon-star" id="collect_star"></span>已有 <b>'.$collect_sum.'</b> 人關注';
				}

				$share_html = '<div class="share_links">分享至：
									<a href="javascript:;" onclick=\'window.open("https://www.facebook.com/sharer.php?u='.base_url().'/record/'.$account.'", "facebook_frm","height=450,width=540");\' title="分享至Facebook">
										<img src="assets/img/logo/fb_share.png" title="分享至Facebook" alt="Facebook share"/>
									</a>
									<a href="javascript:;" onclick="share_to_twitter();" title="分享至twitter">
										<img src="assets/img/logo/twitter_share.png" title="分享至Twitter" alt="Twitter share"/>
									</a>
									<a href="javascript:;" onclick="share_to_plurk();" title="分享至PLURK">
										<img src="assets/img/logo/plurk_share.png" title="分享至Plurk" alt="Plurk share"/>
									</a>
									<a target="_blank" href="javascript:;" onclick="share_to_google();">
										<img src="assets/img/logo/google_share.png" title="分享至Google+" alt="Google PLus share"/>
									</a>
								</div>';

				$record_option = '<div class="record_option">
									'.$collect_html.$share_html.'
								</div>';

				// 公開或隱藏標記
				$public_setting = ($topicDataArr[0]['is_show'] == '1') ? '<span class="glyphicon glyphicon-ok"></span>' : '';
				$private_setting = ($topicDataArr[0]['is_show'] == '0') ? '<span class="glyphicon glyphicon-ok"></span>' : '';

				// 計劃設定
				$topic_setup = '';
				if ( $record_condition == 'self' ) {
					$topic_setup = '<div class="btn-group">
										<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
										<span class="caret"></span>
										</button>
										<ul class="dropdown-menu" role="menu">
											<li>
												<a href="javascript:;" id="topic_set_publict">
													<span class="glyphicon glyphicon-globe"></span>公開'.$public_setting.'
												</a>
											</li>
											<li>
												<a href="javascript:;" id="topic_set_private">
													<span class="glyphicon glyphicon-lock"></span>隱藏'.$private_setting.'
												</a>
												</li>
											<li class="divider"></li>
											<li><a href="javascript:;" id="end_topic"><span class="glyphicon glyphicon-off"></span>結束計劃</a></li>
										</ul>
									</div>';
				}

				// 計劃資料
				$goal_li = '';
				for ($i=1; $i<11 ; $i++) { 
					if ( !empty($topicDataArr[0]['goal_'.$i]) ) {
						$goal_num = $this->chinese_number($i);
						$goal_li .= '<li class="list-group-item">
										第'.$goal_num.'目標：<b>'.$topicDataArr[0]['goal_'.$i].'</b>
									</li>';
					}
				}

				$final_goal_li = '';
				if ($topicDataArr[0]['final_goal'] != '') {
					$final_goal_li = '<li class="list-group-item list-group-item-danger">
										終極目標：<b>'.$topicDataArr[0]['final_goal'].'
										</b>
									</li>';
				}

				$record_topic_html .= 	$record_option.
										'<div class="panel panel-primary">
											<div class="panel-heading">
												計劃名稱：'.$topicDataArr[0]['title'].'
												<span class="topic_start_date">開始日期：'.date('Y-m-d',$topicDataArr[0]['add_time']).$topic_setup.'</span>
											</div>
											<ul class="list-group">
												'.$goal_li.$final_goal_li.'
											</ul>
										</div>';

				// 存取本月份每日紀錄
				$recordWhereArr = array( 'm_id' => $dataArr[0]['id'],
										 't_id' => $topic_id );
				$this->db->where($recordWhereArr);
				$this->db->order_by('record_date','DESC');
				$this->db->limit(60);
				$recordTopic = $this->db->get('w_dayrecord');
				$recordDataArr = $recordTopic->result_array();

				$todayDate = date('Ymd',time());
				if ( count($recordDataArr) == 0 ) {
					$record = array();
				}
				else {
					foreach ($recordDataArr as $key => $recordDayData) {
						// 本月份資料陣列
						$record[$recordDayData['record_date']] = $recordDayData;
					}
				}

				// 今日是否已更新
				$record_update_html = '';
				if ( $record_condition == 'self' && empty($record[$todayDate]) ) {
					$record_update_html = 	'<div class="jumbotron goal_set" id="set_day_record">
												<h1>您今日是否已達成目標？</h1>
												<p>
													<a class="btn btn-success btn-lg" role="button" id="day_success">成功</a>
													<a class="btn btn-danger btn-lg" role="button" id="day_fail">失敗</a>
												</p>
											</div>';
				}

				// 月曆
				$this->load->library('tool_calendar');
				$record_calender_html = $this->tool_calendar->getTableCalendar( date('Y'), date('m'), $topicDataArr, $record, $record_condition );
				$record_calender_html = '<div id="calendar_area">'.$record_calender_html.'</div>';

				// FB分享介紹
				$fb_goal = '';
				for ($i=1; $i<11 ; $i++) { 
					if ( !empty($topicDataArr[0]['goal_'.$i]) ) {
						$fb_goal_num = $this->chinese_number($i);
						$fb_goal .= '第'.$fb_goal_num.'目標：'.$topicDataArr[0]['goal_'.$i].' ';
					}
				}
				$fb_finalgoal = ( $topicDataArr[0]['final_goal'] != '' ) ? '，終極目標：'.$topicDataArr[0]['final_goal'] : '';
				$fb_description = '目前計劃：'.$topicDataArr[0]['title'].'，'.$fb_goal.$fb_finalgoal;

				// 統計資料
				$successRecord = $this->topic_record_count($topic_id,1);
				$failRecord = $this->topic_record_count($topic_id,2);
				$successNum = ( empty($successRecord[$topicDataArr[0]['id']]) ) ? '0' : $successRecord[$topicDataArr[0]['id']];
				$failNum = ( empty($failRecord[$topicDataArr[0]['id']]) ) ? '0' : $failRecord[$topicDataArr[0]['id']];
				$start_time = strtotime(date('Ymd',$topicDataArr[0]['add_time']).' 00:00:00');
				$end_time = strtotime(date('Ymd').' 23:59:59');
				$allNum = @ceil( ($end_time - $start_time) / 86400 );
				$unsetNum = $allNum - $successNum - $failNum;
				$record_count_html = '<div class="panel panel-default">
										<div class="panel-body">
											<div class="col-xs-12 col-sm-2 unset_days">未設定：<span id="unset_num">'.$unsetNum.'</span> 天</div> 
											<div class="col-xs-12 col-sm-2 success_days">成功：<span id="success_num">'.$successNum.'</span> 天</div> 
											<div class="col-xs-12 col-sm-2 fail_days">失敗：<span id="fail_num">'.$failNum.'</span> 天</div> 
											<div class="col-xs-12 col-sm-6 all_days">總天數：'.$allNum.' 天</div>
										</div>
									</div>';

				// 留言板 Disqus外掛
				$identifier = $account.'_topicid_'.$topic_id;
				$disqus_html = '<div id="disqus_thread"></div>
								<script type="text/javascript">
									/* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
									var disqus_shortname = "yiizu"; // required: replace example with your forum shortname
								    var disqus_identifier = "'.$identifier.'";
								    var disqus_disable_mobile = true;

									/* * * DONT EDIT BELOW THIS LINE * * */
									(function() {
										var dsq = document.createElement("script"); dsq.type = "text/javascript"; dsq.async = true;
										dsq.src = "//" + disqus_shortname + ".disqus.com/embed.js";
										(document.getElementsByTagName("head")[0] || document.getElementsByTagName("body")[0]).appendChild(dsq);
									})();
								</script>
								<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
								<a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>';
				break;
			
			case 'hide':
				$data['topic_condition'] = 'none';
				$topic_id = '';
				$record_update_html = '';
				$record_calender_html = '';
				$record_count_html = '';
				$disqus_html = '';

				// FB分享介紹
				$fb_description = '目前尚無任何計劃';
				break;
		}

		// 個人簡介
		$intro_self = '';
		if ( !empty($dataArr[0]['description']) ) {
			$intro_self = 	'<div class="panel panel-default intro_self">
								<div class="panel-heading">'.$tab_title.'的簡介</div>
								<div class="panel-body">'.nl2br($dataArr[0]['description']).'</div>
							</div>';
		}

		$data['shareaccount'] = $account;
		$data['account'] = $login_account;
		$data['login_mid'] = $login_mid;
		$data['record_condition'] = $record_condition;
		$data['title'] = $tab_title.'的意志曆';
		$data['fb_description'] = $fb_description;
		$data['calender_date'] = date('Ym');
		$data['topic_mid'] = $dataArr[0]['id'];
		$data['topic_id'] = $topic_id;
		$data['record_topic_html'] = $record_topic_html;
		$data['record_update_html'] = $record_update_html;
		$data['record_calender_html'] = $record_calender_html;
		$data['record_count_html'] = $record_count_html;
		$data['disqus_html'] = $disqus_html;
		$data['intro_self'] = $intro_self;
		$this->load->view('willrecord/record',$data);
	}

	// 歷史頁
	public function history($account)
	{
		// 存取登入者計劃資料
		$uncheckArr = $this->session_info();
		
		// 頁籤處理
		$checkedArr = $this->get_data_info_public($account,$uncheckArr);
		$login_account = $checkedArr['login_account'];
		$login_mid = $checkedArr['login_mid'];
		$record_condition = $checkedArr['record_condition'];
		$dataArr = $checkedArr['dataArr'];
		$headPic = $this->get_headimg($dataArr);
		$tab_title = ( !empty($dataArr[0]['name']) ) ? $dataArr[0]['name'] : $account;
		$record_topic_html = $this->get_tab_html('history',$headPic,$tab_title,$account,$record_condition);

		// 計劃資料
		$topicWhereArr = array( 'm_id' => $dataArr[0]['id'], 'end_time !=' => '0', 'is_close' => '0' );
		$this->db->where($topicWhereArr);
		$this->db->order_by('end_time','DESC');
		$this->db->limit(20);
		$queryTopic = $this->db->get('w_topic');
		$topicDataArr = $queryTopic->result_array();

		// 存在歷史計劃
		$history_topic = '';
		if ( count($topicDataArr) > 0 ) {
			// 存取計劃詳細資料
			foreach ($topicDataArr as $key => $value) {
				$topicIdCheck[$value['id']] = $value['id'];
			}
			$topicid = implode(",", $topicIdCheck);
			$successRecord = $this->topic_record_count($topicid,1);
			$failRecord = $this->topic_record_count($topicid,2);

			foreach ($topicDataArr as $key => $value) {
				// 計劃是否隱藏
				if ( $value['is_show'] == '0' && $record_condition == 'other' ) {
					continue;
				}

				// 公開或隱藏標記
				$public_setting = ($value['is_show'] == '1') ? '<span class="glyphicon glyphicon-ok"></span>' : '';
				$private_setting = ($value['is_show'] == '0') ? '<span class="glyphicon glyphicon-ok"></span>' : '';

				// 計劃設定
				$topic_setup = '';
				if ( $record_condition == 'self' ) {
					$topic_setup = '<div class="btn-group">
										<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
										<span class="caret"></span>
										</button>
										<ul class="dropdown-menu" role="menu">
											<li>
												<a href="javascript:;" onclick="set_topic_show(1,'.$value['id'].');">
													<span class="glyphicon glyphicon-globe"></span>公開'.$public_setting.'
												</a>
											</li>
											<li>
												<a href="javascript:;" onclick="set_topic_show(0,'.$value['id'].');">
													<span class="glyphicon glyphicon-lock"></span>隱藏'.$private_setting.'
												</a>
											</li>
										</ul>
									</div>';
				}

				// 計劃資料
				$goal_li = '';
				for ($i=1; $i<11 ; $i++) { 
					if ( !empty($value['goal_'.$i]) ) {
						$goal_num = $this->chinese_number($i);
						$goal_li .= '<li class="list-group-item">
										第'.$goal_num.'目標：<b>'.$value['goal_'.$i].'</b>
									</li>';
					}
				}

				$final_goal_li = '';
				if ($value['final_goal'] != '') {
					$final_goal_li = '<li class="list-group-item list-group-item-danger">
										終極目標：<b>'.$value['final_goal'].'
										</b>
									</li>';
				}

				// 計劃成功或失敗
				if ( $value['is_success'] == '1' ) {
					$is_success = '<span class="label label-success">成功</span>';
				}
				else {
					$is_success = '<span class="label label-danger">失敗</span>';
				}

				// 統計資料
				$successNum = ( empty($successRecord[$value['id']]) ) ? '0' : $successRecord[$value['id']];
				$failNum = ( empty($failRecord[$value['id']]) ) ? '0' : $failRecord[$value['id']];
				$start_time = strtotime(date('Ymd',$value['add_time']).' 00:00:00');
				$end_time = strtotime(date('Ymd',$value['end_time']).' 23:59:59');
				$allNum = @ceil( ($end_time - $start_time) / 86400 );
				$unsetNum = $allNum - $successNum - $failNum;
				$record_count = '<li class="list-group-item topic_count">
									<table class="table">
										<tr>
											<td width="110px">統計資料</td>
											<td></td>
										</tr>
										<tr class="unset_days">
											<td>未設定：</td>
											<td>'.$unsetNum.' 天</td>
										</tr>
										<tr class="success_days">
											<td>成功：</td>
											<td>'.$successNum.' 天</td>
										</tr>
										<tr class="fail_days">
											<td>失敗：</td>
											<td>'.$failNum.' 天</td>
										</tr>
										<tr>
											<td>計劃總天數：</td>
											<td>'.$allNum.' 天</td>
										</tr>
									</table>
								</li>';

				$history_topic .= 	'<div class="panel panel-primary">
											<!-- Default panel contents -->
											<div class="panel-heading">'.$is_success.'計劃名稱：'.$value['title'].'
												<span class="topic_time">'.date('Y-m-d',$value['add_time']).' ~ '.date('Y-m-d',$value['end_time']).$topic_setup.'</span>
											</div>

											<!-- List group -->
											<ul class="list-group">
												'.$goal_li.$final_goal_li.$record_count.'
											</ul>
										</div>';
			}
		}
		if ( $history_topic == '' ) {
		 	$history_topic = 	'<div class="jumbotron newtopc">
									<h2>尚無任何歷史紀錄</h2>
								</div>';
		}

		$data['account'] = $login_account;
		$data['login_mid'] = $login_mid;
		$data['record_topic_html'] = $record_topic_html;
		$data['history_topic'] = $history_topic;
		$data['title'] = $tab_title.'的意志曆';
		$this->load->view('willrecord/history',$data);
	}

	// 收藏列表
	public function collect($mid)
	{
		// 存取登入者計劃資料
		$uncheckArr = $this->session_info();
		
		// 頁籤處理
		$checkedArr = $this->get_data_info_private($mid,$uncheckArr);
		$account = $checkedArr['account'];
		$login_mid = $checkedArr['login_mid'];
		$record_condition = $checkedArr['record_condition'];
		$dataArr = $checkedArr['dataArr'];
		$headPic = $this->get_headimg($dataArr);
		$tab_title = ( !empty($dataArr[0]['name']) ) ? $dataArr[0]['name'] : $account;
		$record_topic_html = $this->get_tab_html('collect',$headPic,$tab_title,$account,$record_condition);

		// 收藏處理
		$whereArr['m_id'] = $mid;
		$collectQuery = $this->db->get_where('w_collect',$whereArr);
		$collectArr = $collectQuery->result_array();

		$collect_list_html = '';
		if ( count($collectArr) > 0 ) {
			$collect_list_html .= '<div class="list-group">
									<a href="collect/'.$mid.'" class="list-group-item active">收藏列表</a>';
			foreach ($collectArr as $key => $value) {
				$collect_list_html .= 	'<a href="record/'.$value['t_account'].'" class="list-group-item">
											'.$value['t_account'].' 的意志曆
										</a>';
			}
			$collect_list_html .= '</div>';
		}
		else {
			$collect_list_html = '<div class="jumbotron newtopc">
									<h2>尚無任何收藏</h2>
								</div>';
		}

		$data['account'] = $account;
		$data['login_mid'] = $login_mid;
		$data['record_topic_html'] = $record_topic_html;
		$data['collect_list_html'] = $collect_list_html;
		$data['title'] = $tab_title.'的意志曆';
		$this->load->view('willrecord/collect',$data);
	}

	// 個人設定頁
	public function setup($mid)
	{
		// 存取登入者計劃資料
		$uncheckArr = $this->session_info();
		
		// 頁籤處理
		$checkedArr = $this->get_data_info_private($mid,$uncheckArr);
		$account = $checkedArr['account'];
		$login_mid = $checkedArr['login_mid'];
		$record_condition = $checkedArr['record_condition'];
		$dataArr = $checkedArr['dataArr'];
		$headPic = $this->get_headimg($dataArr);
		$tab_title = ( !empty($dataArr[0]['name']) ) ? $dataArr[0]['name'] : $account;
		$record_topic_html = $this->get_tab_html('setup',$headPic,$tab_title,$account,$record_condition);

		// 頭像編輯
		$updateLock = '';
		$head_img_src = 'assets/pics/head/'.date('Ymd',$dataArr[0]['reg_time']).'/'.$mid.'/'.$dataArr[0]['picture'];
		if ($headPic == 'assets/img/head/defaultHead.jpg') {
			$updateLock = 'disabled';
			$head_img_src = '';
		}

		// 基本資料
		$memberEmail = $dataArr[0]['email'];
		$memberName = ( $dataArr[0]['name'] == '' ) ? '' : $dataArr[0]['name'];
		$memberGender[1] = ( $dataArr[0]['gender'] == '1' ) ? 'checked' : '';
		$memberGender[2] = ( $dataArr[0]['gender'] == '2' ) ? 'checked' : '';
		$memberBirthday_y = '';
		$memberBirthday_m = '';
		$memberBirthday_d = '';
		for ($y = 1900; $y <= date('Y'); $y++) { 
			$selected_y = '';
			if ( (int)substr($dataArr[0]['birthday'],0,4) == $y ) {
				$selected_y = 'selected';
			}
			$memberBirthday_y .= '<option value="'.$y.'" '.$selected_y.'>'.$y.'</option>';
		}
		for ($m = 1; $m <= 12; $m++) { 
			$selected_m = '';
			if ( (int)substr($dataArr[0]['birthday'],4,2) == $m ) {
				$selected_m = 'selected';
			}
			$memberBirthday_m .= '<option value="'.$m.'" '.$selected_m.'>'.$m.'</option>';
		}
		for ($d = 1; $d <= 31; $d++) { 
			$selected_d = '';
			if ( (int)substr($dataArr[0]['birthday'],6,2) == $d ) {
				$selected_d = 'selected';
			}
			$memberBirthday_d .= '<option value="'.$d.'" '.$selected_d.'>'.$d.'</option>';
		}
		$memberDescription = ( $dataArr[0]['description'] == '' ) ? '' : $dataArr[0]['description'];

		// 編輯照片
		$editpic = ( !empty($_GET['edit']) && $_GET['edit'] == 'on' ) ? $_GET['edit'] : '';

		$data['account'] = $account;
		$data['login_mid'] = $login_mid;
		$data['record_topic_html'] = $record_topic_html;
		$data['head_img'] = $headPic;
		$data['head_img_src'] = $head_img_src;
		$data['updateLock'] = $updateLock;
		$data['mid'] = $dataArr[0]['id'];

		$data['memberEmail'] = $memberEmail;
		$data['memberName'] = $memberName;
		$data['memberGender'] = $memberGender;
		$data['memberBirthday_y'] = $memberBirthday_y;
		$data['memberBirthday_m'] = $memberBirthday_m;
		$data['memberBirthday_d'] = $memberBirthday_d;
		$data['memberDescription'] = $memberDescription;

		$data['editpic'] = $editpic;

		$data['title'] = $tab_title.'的意志曆';
		$this->load->view('willrecord/setup',$data);
	}
	
	// 註冊
	public function register()
	{
		$this->session_check();
		
		$data['title'] = '會員註冊';
		$this->load->view('willrecord/register',$data);
	}
	
	// 新註冊會員儲存
	public function newreg()
	{
		$this->session_check();

		$inputAccount = $_POST['inputAccount'];
		$inputPassword1 = $_POST['inputPassword1'];
		$inputPassword2 = $_POST['inputPassword2'];
		$inputEmail = $_POST['inputEmail'];

		// 驗證格式
		if( ctype_alnum($inputAccount) == true 
		&& ctype_alnum($inputPassword1) == true 
		&& ctype_alnum($inputPassword2) == true ) {
			if( strlen($inputAccount) < 3 ) {
				header('location:'.base_url().'/register');
			}
			if( strlen($inputPassword1) < 4 ) {
				header('location:'.base_url().'/register');
			}
			if( $inputPassword1 != $inputPassword2 ) {
				header('location:'.base_url().'/register');
			}
			if( !filter_var($inputEmail, FILTER_VALIDATE_EMAIL) ) {
				header('location:'.base_url().'/register');
			}
		}
		else {
			header('location:'.base_url().'/register');
		}
		$password_coded = md5($inputPassword1);
		$checkWhere = array('account'=>$inputAccount);
		$queryCheck = $this->db->get_where('w_member',$checkWhere);
		$checkArr = $queryCheck->result_array();
		if( count($checkArr) == 0 ) {
			$dataInsert = array(
				'account' => $inputAccount,
				'password' => $password_coded,
				'email' => $inputEmail,
				'reg_time' => time()
			);
			$this->db->insert('w_member',$dataInsert); 
			$id = $this->db->insert_id();
			
		}
		$data['title'] = '會員註冊';
		$this->load->view('willrecord/newreg',$data);
	}

	// 登入
	public function login()
	{
		$this->session_check();
		
		// 自動登入預設選項 行動裝置自動勾選
		if ( $this->agent->is_mobile() ) {
			$data['autochecked'] = 'checked';
		} else {
			$data['autochecked'] = '';
		}
		
		$data['title'] = '會員登入';
		$this->load->view('willrecord/login',$data);
	}

	// 登出
	public function logout()
	{
		$this->nativesession->delete('LOGIN_ID');
		delete_cookie('cookiedata');
		header('location:'.base_url());
	}

	// 忘記密碼
	public function forgetpwd()
	{
		$this->session_check();
			
		$data['title'] = '忘記密碼';
		$this->load->view('willrecord/forgetpwd',$data);
	}

	// 忘記密碼 寄信
	public function send_forget_pwd_mail()
	{
		if( $_POST['forgetpwd_account'] == '' ) {
			$data['status'] = '無此帳號';
			$data['action'] = '返回<a href="forgetpwd">重設密碼頁面</a>';

			$data['title'] = '忘記密碼';
			$this->load->view('willrecord/send_forget_pwd_mail',$data);
			return;
		}

		$whereArr = array( 'account' => $_POST['forgetpwd_account'] );
		$queryMember = $this->db->get_where('w_member',$whereArr);
		$dataArr = $queryMember->result_array();
		if ( count($dataArr) == 0 ) {
			$data['status'] = '無此帳號';
			$data['action'] = '返回<a href="forgetpwd">重設密碼頁面</a>';

			$data['title'] = '忘記密碼';
			$this->load->view('willrecord/send_forget_pwd_mail',$data);
			return;
		}
		$time_start = strtotime(date('Y-m-d').' 00:00:00');
		$time_end = strtotime(date('Y-m-d').' 23:59:59');
		$pwdWhereArr = array( 'm_id' => $dataArr[0]['id'],
								'p_time >=' => $time_start,
								'p_time <=' => $time_end );
		$queryPwdreset = $this->db->get_where('w_pwdreset',$pwdWhereArr);
		$pwdresetArr = $queryPwdreset->result_array();
		if ( count($pwdresetArr) == 1 ) {
			$updatePwdCancelLastArr['p_status'] = '1';
			$wherePwdCancelLastArr['id'] = $pwdresetArr[0]['id'];
			$this->db->update('w_pwdreset',$updatePwdCancelLastArr, $wherePwdCancelLastArr);
		}
		if ( count($pwdresetArr) > 1 ) {
			$data['status'] = '一天內不得重設超過兩次密碼。';
			$data['action'] = '如有任何問題，請至<a href="question">問題與建議</a>';

			$data['title'] = '忘記密碼';
			$this->load->view('willrecord/send_forget_pwd_mail',$data);
			return;
		}

		// 儲存目前狀態
		$insertArr['m_id'] = $dataArr[0]['id'];
		$insertArr['p_email'] = $dataArr[0]['email'];
		$insertArr['p_time'] = time();
		$insertArr['p_ip'] = $this->input->ip_address();
		$this->db->insert('w_pwdreset',$insertArr);
		$resetpwd_id = $this->db->insert_id();

		// 產生加密連結
		$key = 'jaming';
		$string = $dataArr[0]['id'].'-'.$dataArr[0]['account'].'-'.$dataArr[0]['reg_time'].'-'.$resetpwd_id;
		do{
			$confirm_key = base64_encode( $this->authcode($string,'ENCODE',$key) );
			} while ( strpos($confirm_key,'+') !== FALSE OR strpos($confirm_key,'/') !== FALSE );
		$token_link = 'http://willrecord.jazamila.com/resetpwd?token='.$confirm_key;
		
		$emailto = $dataArr[0]['email'];
		$toname = $dataArr[0]['account'];
		$emailfrom = 'service@willrecord.jazamila.com';
		$fromname = '意志曆';
		$subject = '重新設定您的密碼';
		$messagebody = $dataArr[0]['account'].' 您好，以下為您的重設密碼連結，請於三天內點選該連結至指定頁面重新設定密碼。
'.$token_link.'

(此為系統通知信，請勿回覆)';
		$headers = 
		    'Return-Path: ' . $emailfrom . "\r\n" . 
		    'From: ' . $fromname . ' <' . $emailfrom . '>' . "\r\n" . 
		    'X-Priority: 3' . "\r\n" . 
		    'X-Mailer: PHP ' . phpversion() .  "\r\n" . 
		    'Reply-To: ' . $fromname . ' <' . $emailfrom . '>' . "\r\n" .
		    'MIME-Version: 1.0' . "\r\n" . 
		    'Content-Transfer-Encoding: 8bit' . "\r\n" . 
		    'Content-Type: text/plain; charset=UTF-8' . "\r\n";
		$params = '-f ' . $emailfrom;
		$test = mail($emailto, $subject, $messagebody, $headers, $params);
		if ($test == TRUE) {
			$data['status'] = '已寄送重設密碼連結至您的信箱，請前往收信';
			$data['action'] = '返回<a href="" class="alert-link">首頁</a>';
			
			$data['title'] = '忘記密碼';
			$this->load->view('willrecord/send_forget_pwd_mail',$data);
			return;
		}
	}

	// 重設密碼
	public function resetpwd()
	{
		// 檢查token
		if ( $_GET['token'] == '' ) {
			header('location:'.base_url());
			return;
		}
		$key = 'jaming';
		$string = base64_decode($_GET['token']);
		$string = $this->authcode($string,'DECODE',$key);
		$dataToken = explode('-',$string);

		// 檢查會員
		$whereArr['id'] = $dataToken[0];
		$whereArr['account'] = $dataToken[1];
		$whereArr['reg_time'] = $dataToken[2];
		$queryMember = $this->db->get_where('w_member',$whereArr);
		$dataArr = $queryMember->result_array();
		if ( count($dataArr) == 0 ) {
			header('location:'.base_url());
			return;
		}

		// 檢查連結是否失效
		$pwdWhereArr['id'] = $dataToken[3];
		$pwdWhereArr['p_status'] = '0';
		$queryPwd = $this->db->get_where('w_pwdreset',$pwdWhereArr);
		$pwdArr = $queryPwd->result_array();
		if ( count($pwdArr) == 0 ) {
			header('location:'.base_url());
			return;
		}

		// 檢查時間
		$period = time() - $pwdArr[0]['p_time'];
		$three = 86400 * 3;
		if ( $period > $three ) {
			$updatePwdArr['p_status'] = '2';
			$updatePwdWhereArr['id'] = $dataToken[3];
			$this->db->update('w_pwdreset',$updatePwdArr, $updatePwdWhereArr);
			header('location:'.base_url());
			return;
		}

		// 通過
		$this->nativesession->set('PWD_RESET_MID',$dataArr[0]['id']);
		$this->nativesession->set('PWD_RESET_REGTIME',$dataArr[0]['reg_time']);
		$data['accountReset'] = $dataToken[1];
		$data['title'] = '重設密碼';
		$this->load->view('willrecord/resetpwd',$data);
	}

	// 重設密碼 完成
	public function resetdone()
	{
		$RESET_ID = '';
		$RESET_REGTIME = '';
		$RESET_ID = $this->nativesession->get('PWD_RESET_MID');
		$RESET_REGTIME = $this->nativesession->get('PWD_RESET_REGTIME');
		if ( $_POST['inputPassword1'] != $_POST['inputPassword2'] ) {
			header('location:'.base_url());
			return;
		}
		if ( $RESET_ID == '' OR $RESET_REGTIME == '' ) {
			header('location:'.base_url());
			return;
		}

		// 檢查是否可以修改
		$pwdWhereArr['m_id'] = $RESET_ID;
		$pwdWhereArr['p_status'] = '0';
		$queryPwd = $this->db->get_where('w_pwdreset',$pwdWhereArr);
		$pwdArr = $queryPwd->result_array();
		if ( count($pwdArr) == 0 ) {
			header('location:'.base_url());
			return;
		}

		$resetPwd = md5($_POST['inputPassword1']);
		$updateArr['password'] = $resetPwd;
		$whereArr['id'] = $RESET_ID;
		$whereArr['reg_time'] = $RESET_REGTIME;
		$this->db->update('w_member',$updateArr, $whereArr);

		$updatePwdArr['m_id'] = $RESET_ID;
		$updatePwdArr['p_status'] = '0';
		$wherePwdArr['p_status'] = '1';
		$this->db->update('w_pwdreset',$wherePwdArr, $updatePwdArr);

		$data['title'] = '重設密碼';
		$this->load->view('willrecord/resetdone',$data);
	}
	
	// 隱私權政策
	public function privatelaw()
	{
		$dataArr = $this->session_info();
		if ( count($dataArr) > 0 ) {
			$data['account'] = $dataArr[0]['account'];
		}

		$data['title'] = '隱私權政策';
		$this->load->view('willrecord/privatelaw',$data);
	}

	// 使用條款
	public function tou()
	{
		$dataArr = $this->session_info();
		if ( count($dataArr) > 0 ) {
			$data['account'] = $dataArr[0]['account'];
		}

		$data['title'] = '使用條款';
		$this->load->view('willrecord/tou',$data);
	}

	// 關於意志曆
	public function about()
	{
		$dataArr = $this->session_info();
		if ( count($dataArr) > 0 ) {
			$data['account'] = $dataArr[0]['account'];
		}

		$data['title'] = '關於意志曆';
		$this->load->view('willrecord/about',$data);
	}

	// 反服貿
	public function foolmow()
	{
		$this->load->view('willrecord/foolmow');
	}

	// 主要頁籤 ================================

	// 資料處裡 公開頁面
	function get_data_info_public($account,$dataArr)
	{
		if ( count($dataArr) > 0 ) {
			$login_account = $dataArr[0]['account'];
			$login_mid = $dataArr[0]['id'];
		}
		else {
			$login_account = '';
			$login_mid = '';
		}

		// 若為登入者
		if ( $account == $login_account ) {
			$record_condition = 'self';
		}
		// 非登入者 存取該會員計劃資料
		else{
			$record_condition = 'other';

			unset($dataArr);
			$whereArr = array( 'account' => $account );
			$queryMember = $this->db->get_where('w_member',$whereArr);
			$dataArr = $queryMember->result_array();

			// 無此會員
			if ( count($dataArr) == 0 ) {
				header('location:'.base_url());
			}
		}

		$returnArr['login_account'] = $login_account;
		$returnArr['login_mid'] = $login_mid;
		$returnArr['record_condition'] = $record_condition;
		// array
		$returnArr['dataArr'] = $dataArr;

		return $returnArr;
	}

	// 資料處理 私人頁面
	function get_data_info_private($mid,$dataArr)
	{
		if ( count($dataArr) > 0 && $mid == $dataArr[0]['id'] ) {
			$returnArr['account'] = $dataArr[0]['account'];
			$returnArr['login_mid'] = $dataArr[0]['id'];
			$returnArr['record_condition'] = 'self';
			$returnArr['dataArr'] = $dataArr;
			return $returnArr;
		}
		else {
			header('location:'.base_url());
			return;
		}
	}

	// 頭像處理
	function get_headimg($dataArr)
	{
		$memberDir = date('Ymd',$dataArr[0]['reg_time']);
		if( $dataArr[0]['picture'] == '' ) {
			$headPic = 'assets/img/head/defaultHead.jpg';
		}
		else {
			if( $dataArr[0]['e_picture'] == '' ) {
				$headPic = 'assets/pics/head/'.$memberDir.'/'.$dataArr[0]['id'].'/'.$dataArr[0]['picture'];
			}
			else {
				$headPic = 'assets/pics/head/'.$memberDir.'/'.$dataArr[0]['id'].'/'.$dataArr[0]['e_picture'];
			}
		}
		return $headPic;
	}

	/** 頁籤處理
	 *
	 * @param String 該頁面名稱
	 * @param String 頭像連結
	 * @param String 目前瀏覽帳號
	 * @param String 登入狀況 self:登入者 other:非登入者
	 * @return 頁籤HTML碼
	 */
	function get_tab_html($target_page,$headPic,$tab_title,$account,$record_condition)
	{
		$LOGIN_ID = $this->nativesession->get('LOGIN_ID');
		
		$public_tab = array('record' => '',
							'history' => '',
							'collect' => '',
							'setup' => '' );
		switch ($target_page) {
			case 'record':
				$public_tab['record'] = 'class="active"';
				break;
			case 'history':
				$public_tab['history'] = 'class="active"';
				break;
			case 'collect':
				$public_tab['collect'] = 'class="active"';
				break;
			case 'setup':
				$public_tab['setup'] = 'class="active"';
				break;
		}
		
		// 私人頁籤
		$private_tab = '';
		if ( $record_condition == 'self' ) {
			$private_tab = '<li '.$public_tab['collect'].'>
								<a href="collect/'.$LOGIN_ID.'"><span class="glyphicon glyphicon-star"></span>收藏列表</a>
							</li>
							<li '.$public_tab['setup'].'>
								<a href="setup/'.$LOGIN_ID.'"><span class="glyphicon glyphicon-cog"></span>個人設定</a>
							</li>';
		}
		
		$html = '<div class="record_title">
					<img src="'.$headPic.'" alt="'.$tab_title.'" class="img-circle">
					<br/>
					<b><span id="tab_name">'.$tab_title.'</span>的意志曆</b>
				</div>
				<ul class="nav nav-tabs nav-justified">
					<li '.$public_tab['record'].'><a href="record/'.$account.'"><span class="glyphicon glyphicon-calendar"></span>目前計劃</a></li>
					<li '.$public_tab['history'].'><a href="history/'.$account.'"><span class="glyphicon glyphicon-folder-open"></span>歷史紀錄</a></li>
					'.$private_tab.'
				</ul>';
		return $html;
	}

	// 通用函式 ================================

	// COOKIE登入驗證
	function cookie_check()
	{
		$LOGIN_ID = $this->nativesession->get('LOGIN_ID');
		$cookiedata = $this->input->cookie('cookiedata');

		// 自動登入
		if( empty($LOGIN_ID) && !empty($cookiedata) ) {
			// 解碼
			$key = 'cookiekey';
			$COOKIE_decrypt = $this->authcode($cookiedata,'DECODE',$key);
			$login_data_arr = explode('-', $COOKIE_decrypt);

			// 驗證會員
			$whereArr['id'] = $login_data_arr[0];
			$whereArr['account'] = $login_data_arr[1];
			$whereArr['reg_time'] = $login_data_arr[2];
			$query = $this->db->get_where('w_member',$whereArr);
			$dataArr = $query->result_array();
			if ( count($dataArr) > 0 ) {
				$this->nativesession->set('LOGIN_ID',$dataArr[0]['id']);
			}
		}
		return;
	}

	// 登入驗證
	function session_check()
	{
		$LOGIN_ID = $this->nativesession->get('LOGIN_ID');
		if( !empty($LOGIN_ID) ) {
			$whereArr = array( 'id' => $LOGIN_ID );
			$query = $this->db->get_where('w_member',$whereArr);
			$dataArr = $query->result_array();
			$memberaccount = $dataArr[0]['account'];
			header('location:'.base_url().'record/'.$memberaccount);
		}
		return;
	}

	// 登入資訊
	function session_info()
	{
		$LOGIN_ID = $this->nativesession->get('LOGIN_ID');
		if( empty($LOGIN_ID) ) {
			$dataArr = array();
			return $dataArr;
		}
		else {
			$whereArr = array( 'id' => $LOGIN_ID );
			$query = $this->db->get_where('w_member',$whereArr);
			$dataArr = $query->result_array();
			return $dataArr;
		}
	}

	// 存取計劃統計資料
	function topic_record_count($topicid, $tag)
	{
		$record = array();
		$sql = "SELECT t_id, COUNT(*) AS C 
				FROM w_dayrecord 
				WHERE status_tag = '".$tag."' 
				AND t_id IN (".$topicid.") 
				GROUP BY t_id";
		$queryRecord = $this->db->query($sql);
		$recordDataArr = $queryRecord->result_array();
		if ( count($recordDataArr) > 0 ) {
			foreach ($recordDataArr as $key => $value) {
				$record[$value['t_id']] = $value['C'];
			}
		}
		return $record;
	}

	// 每日紀錄轉換文字
	function switch_record_tag($tag)
	{
		switch ($tag) {
			case '0':
				$str = '尚未紀錄';
			break;
			case '1':
				$str = '<span class="tag_success">成功</span>';
			break;
			case '2':
				$str = '<span class="tag_fail">失敗</span>';
			break;
		}
		return $str;
	}

	// 數字的中文化
	function chinese_number($sel_num = '')
	{
		$result = '';
		if( !empty($sel_num) ) {
			switch( intval($sel_num) ) {
				case 1:
					$result = '一';	
				break;
				case 2:
					$result = '二';	
				break;
				case 3:
					$result = '三';	
				break;
				case 4:
					$result = '四';	
				break;
				case 5:
					$result = '五';	
				break;
				case 6:
					$result = '六';	
				break;
				case 7:
					$result = '七';	
				break;
				case 8:
					$result = '八';	
				break;
				case 9:
					$result = '九';	
				break;
				case 10:
					$result = '十';	
				break;
				default:
					$result = $sel_num;
				break;
			}
		}
		return $result;
	}

	/** discuz 加密解密函數
	 *
	 * @param String $string 需要加密解密的字符串
	 * @param String $operation 類型 DECODE(解密)
	 * @param String $key 密鈅
	 * @return unknown
	 */
	function authcode($string, $operation, $key = '')
	{
		$key = md5($key ? $key : 'cn_7c91');
		$key_length = strlen($key);

		$string = $operation == 'DECODE' ? base64_decode($string) : substr(md5($string.$key), 0, 8).$string;
		$string_length = strlen($string);

		$rndkey = $box = array();
		$result = '';

		for($i = 0; $i <= 255; $i++) {
			$rndkey[$i] = ord($key[$i % $key_length]);
			$box[$i] = $i;
		}

		for($j = $i = 0; $i < 256; $i++) {
			$j = ($j + $box[$i] + $rndkey[$i]) % 256;
			$tmp = $box[$i];
			$box[$i] = $box[$j];
			$box[$j] = $tmp;
		}

		for($a = $j = $i = 0; $i < $string_length; $i++) {
			$a = ($a + 1) % 256;
			$j = ($j + $box[$a]) % 256;
			$tmp = $box[$a];
			$box[$a] = $box[$j];
			$box[$j] = $tmp;
			$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
		}

		if($operation == 'DECODE') {
			if(substr($result, 0, 8) == substr(md5(substr($result, 8).$key), 0, 8)) {
				return substr($result, 8);
			} else {
				return '';
			}
		} else {
			return str_replace('=', '', base64_encode($result));
		}
	}
}