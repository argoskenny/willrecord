<?php
class Ajax extends CI_Controller {
	
	// 建構子
	public function __construct(){
		parent::__construct();
		$this->load->database();
		
		// 引入連結
		$this->load->helper('url');
		
		// 引入SESSION
		$this->load->library('nativesession');
		
		// 引入COOKIE
		$this->load->helper('cookie');
	}
	
	// 登入
	function login(){
		$password_coded = md5($_POST['password']);
		$whereArr = array(	'account' => $_POST['account'],
							'password' => $password_coded
							);
		$query = $this->db->get_where('w_member',$whereArr);
		$dataArr = $query->result_array();
		if( count($dataArr) > 0 ) {
			$memberaccount = $dataArr[0]['account'];
			$this->nativesession->set('LOGIN_ID',$dataArr[0]['id']);
			
			// 下次自動登入 存入COOKIE
			$key = 'cookiekey';
			$COOKIE_login_info = $dataArr[0]['id'].'-'.$dataArr[0]['account'].'-'.$dataArr[0]['reg_time'];
			if( !empty($_POST['remember']) && $_POST['remember'] == 1 ) {
				$COOKIE_encrypt = $this->authcode($COOKIE_login_info,'ENCODE',$key);
				$LOGIN_COOKIE = array(
					'name'   => 'cookiedata',
					'value'  => $COOKIE_encrypt,
					'expire' => 865000,
					'secure' => FALSE
				);
				$this->input->set_cookie($LOGIN_COOKIE);
			}
			echo json_encode(array("status"=>"success","memberaccount"=>$memberaccount));
		}
		else {
			echo json_encode(array("status"=>"fail"));
		}
	}
	
	// 儲存基本資料
	function save_profile(){
		$mid = $this->nativesession->get('LOGIN_ID');
		if( empty($mid) ) {
			$returnData['status'] = 'fail';
			$returnData['msg'] = '發生錯誤，請稍後再試。';
			echo json_encode($returnData);
			return;
		}
		$whereArr = array('id' => $mid);
		$query = $this->db->get_where('w_member',$whereArr);
		$dataArr = $query->result_array();
		
		// 資料驗證
		$nameNum = mb_strlen($_POST['memberName']);
		$memberName = ( $nameNum > 10 ) ? '' : mysql_real_escape_string($_POST['memberName']);
		$memberGender = $_POST['memberGender'];
		
		$month = str_pad($_POST['birthday_month'],2,'0',STR_PAD_LEFT);
		$day = str_pad($_POST['birthday_day'],2,'0',STR_PAD_LEFT);
		$birthday = $_POST['birthday_year'].$month.$day;
		
		$description = $_POST['memberDescription'];
		
		$updateArr = array(	'name' => $memberName,
							'gender' => $memberGender,
							'birthday' => $birthday,
							'description' => $description);
		$this->db->where('id', $mid);
		if( $this->db->update('w_member',$updateArr) == true ) {
			$returnData['status'] = 'success';
			echo json_encode($returnData);
		}
		else {
			$returnData['status'] = 'fail';
			$returnData['msg'] = '發生錯誤，請稍後再試。';
			echo json_encode($returnData);
		}
	}

	// 創建新計劃
	function createNewTopic(){
		$mid = $this->nativesession->get('LOGIN_ID');
				
		$goal_array = array($_POST['goal_1'],
							$_POST['goal_2'],
							$_POST['goal_3']);
		foreach ($goal_array as $key => $value) {
			if ($value != '') {
				$insert_goal_array[] = $value;
			}
		}
		$final_goal = empty($_POST['final_goal']) ? '' : $_POST['final_goal'];
		$insert_goal_array[1] = (empty($insert_goal_array[1])) ? '' : $insert_goal_array[1];
		$insert_goal_array[2] = (empty($insert_goal_array[2])) ? '' : $insert_goal_array[2];

		if ( empty($insert_goal_array[0]) OR empty($_POST['title']) ) {
			$returnData['status'] = 'fail';
			echo json_encode($returnData);
			return;
		}

		$dataInsert = array(
			'm_id' => $mid,
			'title' => $_POST['title'],
			'final_goal' => $final_goal,
			'goal_1' => $insert_goal_array[0],
			'goal_2' => $insert_goal_array[1],
			'goal_3' => $insert_goal_array[2],
			'duration' => $_POST['duration'],
			'add_time' => time(),
			'update_time' => time()
		);
		$this->db->insert('w_topic',$dataInsert);
		$returnData['status'] = 'success';
		echo json_encode($returnData);
		return;
	}

	// 結束計劃
	function set_end_topic(){
		$mid = $this->nativesession->get('LOGIN_ID');
		if ( empty($_POST['select_status']) OR empty($_POST['topic_id']) ) {
			$returnData['select_status'] = 'fail';
			echo json_encode($returnData);
			return;
		}

		$topicUpdate['is_close'] = '0';
		$topicUpdate['is_success'] = $_POST['select_status'];
		$topicUpdate['end_time'] = time();
		$this->db->update('w_topic',$topicUpdate, array('id'=>$_POST['topic_id'],'m_id'=>$mid));
		
		$returnData['status'] = 'success';
		echo json_encode($returnData);
		return;
	}
	
	// 更新 今日紀錄
	function set_record(){
		$mid = $this->nativesession->get('LOGIN_ID');
		
		// 驗證計劃編號
		$topicwhereArr = array(	'id' => $_POST['topic_id'], 'm_id' => $mid );
		$topicQuery = $this->db->get_where('w_topic',$topicwhereArr);
		$topicArr = $topicQuery->result_array();
		if ( count($topicArr) == 0 ) {
			$returnData['status'] = 'fail';
			$returnData['msg'] = '計劃錯誤，請稍後再試！';
			echo json_encode($returnData);
		}

		// group_id
		$group_id =  ( ($mid % 999) == 0 ) ? '999' : ($mid % 999); 

		// 存入
		$dataInsert = array(
			'm_id' => $mid,
			't_id' => $_POST['topic_id'],
			'status_tag' => $_POST['condition'],
			'record_date' => date('Ymd',time()),
			'update_time' => time(),
			'group_id' => $group_id
		);
		$this->db->insert('w_dayrecord',$dataInsert);
		
		$returnData['status'] = 'success';
		echo json_encode($returnData);
	}
	
	// 更新 過去紀錄
	function set_past_record(){
		$mid = $this->nativesession->get('LOGIN_ID');
		
		// 驗證計劃編號
		$topicwhereArr = array(	'id' => $_POST['topic_id'], 'm_id' => $mid );
		$topicQuery = $this->db->get_where('w_topic',$topicwhereArr);
		$topicArr = $topicQuery->result_array();
		if ( count($topicArr) == 0 ) {
			$returnData['status'] = 'fail';
			$returnData['msg'] = '計劃錯誤，請稍後再試！';
			echo json_encode($returnData);
		}

		// group_id
		$group_id =  ( ($mid % 999) == 0 ) ? '999' : ($mid % 999); 

		// 存入
		$dataInsert = array(
			'm_id' => $mid,
			't_id' => $_POST['topic_id'],
			'status_tag' => $_POST['condition'],
			'record_date' => $_POST['past_record_date'],
			'update_time' => time(),
			'group_id' => $group_id
		);
		$this->db->insert('w_dayrecord',$dataInsert);
		
		$returnData['status'] = 'success';
		echo json_encode($returnData);
	}

	// 月曆翻頁
	function calendar_change(){
		// 上一頁 下一頁
		$half_month = 86400 * 20;
		switch ($_POST['action']) {
			case 'prev':
				$month_time = strtotime($_POST['nowdate'].'15') - $half_month;
				break;
			
			case 'next':
				$month_time = strtotime($_POST['nowdate'].'15') + $half_month;
				break;

			case 'manual':
				$month_time = strtotime($_POST['nextdate'].'15');
				break;
		}
		$changed_Y = date('Y',$month_time);
		$changed_M = date('m',$month_time);
		$changed_YM = date('Ym',$month_time);

		// 抓取月份為過去或未來
		$month_last_time = strtotime( date('Ym',$month_time).date('t',$month_time).' 23:59:59');
		$month_next_date = $month_last_time + ( 86400 * 15 );
		if ( time() > $month_last_time ) {
			$time_condition = 'past';
		}
		else {
			$time_condition = 'future';
		}

		// 存取登入者
		$LOGIN_ID = $this->nativesession->get('LOGIN_ID');
		
		// 若為非登入者 存取該會員計劃資料
		if ( $LOGIN_ID != $_POST['topic_mid'] ) {
			$record_condition = 'other';
		}
		else {
			$record_condition = 'self';
		}

		$topicWhereArr = array( 'm_id' => $_POST['topic_mid'], 'id' => $_POST['topic_id'] , 'end_time' => '0', 'is_close' => '1' );
		$queryTopic = $this->db->get_where('w_topic',$topicWhereArr);
		$topicDataArr = $queryTopic->result_array();

		// 至少有一項計劃
		if ( count($topicDataArr) > 0 ) {
			$topic_id = $topicDataArr[0]['id'];

			// 存取本月份每日紀錄
			$recordWhereArr = array( 'm_id' => $_POST['topic_mid'],
									 't_id' => $topic_id );
			// 如果為過去
			if ( $time_condition == 'past' ) {
				$recordWhereArr['record_date <'] = date('Ymd',$month_next_date);
			}
			$this->db->where($recordWhereArr);
			$this->db->order_by('record_date','DESC');
			if ( $time_condition == 'past' ) {
				$this->db->limit(80);
			}
			$recordTopic = $this->db->get('w_dayrecord');
			$recordDataArr = $recordTopic->result_array();

			if ( count($recordDataArr) == 0 ) {
				$record = array();
			}
			else {
				foreach ($recordDataArr as $key => $recordDayData) {
					// 本月份資料陣列
					$record[$recordDayData['record_date']] = $recordDayData;
				}
			}

			// 月曆
			$this->load->library('tool_calendar');
			$record_calender_html = $this->tool_calendar->getTableCalendar( $changed_Y, $changed_M, $topicDataArr, $record, $record_condition );

			$returnData['status'] = 'success';
			$returnData['next_date'] = $changed_YM;
			$returnData['calendar_html'] = $record_calender_html;
			echo json_encode($returnData);
		}
		else {
			$returnData['status'] = 'fail';
			echo json_encode($returnData);
		}
	}

	// 計劃公開或隱藏
	function set_topic_show(){
		$mid = $this->nativesession->get('LOGIN_ID');
		
		// 驗證計劃編號
		$topicwhereArr = array(	'id' => $_POST['topic_id'], 'm_id' => $mid );
		$topicQuery = $this->db->get_where('w_topic',$topicwhereArr);
		$topicArr = $topicQuery->result_array();
		if ( count($topicArr) == 0 ) {
			$returnData['status'] = 'fail';
			$returnData['msg'] = '計劃錯誤，請稍後再試！';
			echo json_encode($returnData);
		}

		// 存入
		$topicUpdate = array(
			'is_show' => $_POST['is_show'],
			'update_time' => time()
		);
		$this->db->update('w_topic',$topicUpdate,array( 'id' => $_POST['topic_id'], 'm_id' => $mid ));
		
		$returnData['status'] = 'success';
		$returnData['msg'] = ($_POST['is_show'] == '0') ? '計劃已設定為隱藏' : '計劃已設定為公開';
		echo json_encode($returnData);
	}

	// 收藏
	function set_collect(){
		$whereArr['tm_id'] = $_POST['topic_mid'];
		$whereArr['m_id'] = $_POST['login_mid'];
		$checkQuery = $this->db->get_where('w_collect',$whereArr);
		$checkArr = $checkQuery->result_array();

		if ( count($checkArr) > 0 ) {
			$this->db->delete('w_collect', $whereArr);
			
			$returnData['status'] = 'success';
			$returnData['remove_class'] = 'glyphicon glyphicon-star';
			$returnData['add_class'] = 'glyphicon glyphicon-star-empty';
			echo json_encode($returnData);
		}
		else {
			$tmemberQuery = $this->db->get_where( 'w_member' , array('id'=>$_POST['topic_mid']) );
			$tmemberArr = $tmemberQuery->result_array();
			
			$insertArr['tm_id'] = $_POST['topic_mid'];
			$insertArr['t_account'] = $tmemberArr[0]['account'];
			$insertArr['m_id'] = $_POST['login_mid'];
			$insertArr['collect_time'] = time();
			$this->db->insert('w_collect',$insertArr);
			
			$returnData['status'] = 'success';
			$returnData['remove_class'] = 'glyphicon glyphicon-star-empty';
			$returnData['add_class'] = 'glyphicon glyphicon-star';
			echo json_encode($returnData);
		}
	}

	// 更新頭像
	function upload_pic(){
		$mid = $this->nativesession->get('LOGIN_ID');
		
		// 刪除舊照片
		$whereArr['id'] = $mid;
		$query = $this->db->get_where('w_member',$whereArr);
		$dataArr = $query->result_array();
		$memberDir = 'assets/pics/head/'.date('Ymd',$dataArr[0]['reg_time']);
		if( !file_exists( $memberDir ) ) {
			mkdir($memberDir,0777,TRUE);
		}
		$memberDir = $memberDir.'/'.$mid;
		if( !file_exists( $memberDir ) ) {
			mkdir($memberDir,0777,TRUE);
		}

		if( $dataArr[0]['picture'] != '' ) {
			unlink($memberDir.'/'.$dataArr[0]['picture']);
		}
		if( $dataArr[0]['e_picture'] != '' ) {
			unlink($memberDir.'/'.$dataArr[0]['e_picture']);
		}
		
		// 照片處理
		$resize_Img = "";
		$resize_ori_Img = "";
		if( !empty($_FILES['pic_upload']) )
		{
			if ($_FILES['pic_upload']['error'] > 0)
			{
				$upload_Error = $_FILES['pic_upload']['error'];
			}
			else
			{
				$tmp_file = 'assets/tmp/'.$_FILES['pic_upload']['name'];
				$img_type = explode(".",$_FILES["pic_upload"]["name"]);
				$resize_Img = 'preview_'.time().'.'.$img_type[1];
				$rezsize_path = $memberDir.'/'.$resize_Img;
				move_uploaded_file($_FILES['pic_upload']['tmp_name'],$tmp_file);
				
				$config['image_library'] = 'gd2';
				$config['source_image']	= $tmp_file;
				$config['new_image'] = $rezsize_path;
				$config['maintain_ratio'] = TRUE;
				$config['width'] = 300;
				$config['height'] = 300;
				
				$this->load->library('image_lib'); // 圖像處理類別
				$this->image_lib->initialize($config); 
				$this->image_lib->resize();
				
				$resize_ori_Img = "";
			}
			$picUpdate = array('picture'=>$resize_Img,'e_picture'=>'');
			$this->db->update('w_member',$picUpdate, array('id'=>$mid));
			$returnData = array('status'=>'success',
								'img'=>$rezsize_path
								);
			echo json_encode($returnData); 
		}
		else{
			$returnData = array('status'=>'fail');
			echo json_encode($returnData); 
		}
	}
	
	// 編輯頭像
	function crop_pic(){
		// 存取會員資料
		$mid = $this->nativesession->get('LOGIN_ID');
		$whereArr['id'] = $mid;
		$query = $this->db->get_where('w_member',$whereArr);
		$dataArr = $query->result_array();
		
		// 原頭像
		$src = 'assets/pics/head/'.date('Ymd',$dataArr[0]['reg_time']).'/'.$mid.'/'.$dataArr[0]['picture'];
		$img_type = explode(".",$dataArr[0]['picture']);
		switch($img_type[1]) {
			case 'jpg':
			case 'jpeg':
			case 'JPG':
			case 'JPEG':
				$img_r = imagecreatefromjpeg($src);
			break;
			case 'png':
			case 'PNG':
				$img_r = imagecreatefrompng($src);
			break;
		}
		// 已編輯裁切後的圖片設定
		$targ_w = 300;
		$targ_h = 300;
		$jpeg_quality = 90;
		$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
		$crop_filename = 'edited_'.time().'.jpg';
		$crop_path = 'assets/pics/head/'.date('Ymd',$dataArr[0]['reg_time']).'/'.$mid.'/'.$crop_filename;
		
		imagecopyresampled($dst_r,$img_r,0,0,$_POST['adjust_crop_x'],$_POST['adjust_crop_y'],$targ_w,$targ_h,$_POST['adjust_crop_w'],$_POST['adjust_crop_h']);
		imagejpeg($dst_r, $crop_path, $jpeg_quality);
		
		$picUpdate = array('e_picture'=>$crop_filename);
		$this->db->update('w_member',$picUpdate, array('id'=>$mid));
		
		$returnData['status'] = 'success';
		$returnData['src'] = $crop_path;
		echo json_encode($returnData); 
	}
	
	// 帳號驗證
	function checkAccount(){
		$whereArr['account'] = $_POST['accountVal'];
		$query = $this->db->get_where('w_member', $whereArr);
		$query_arr = $query->result_array();
		if( count($query_arr) > 0 ) {
			echo 'fail';
		}
		else {
			echo 'success';
		}
	}
	
	// 電子郵件驗證
	function checkEmail(){
		$whereArr['email'] = $_POST['mailVal'];
		$query = $this->db->get_where('w_member', $whereArr);
		$query_arr = $query->result_array();
		if( count($query_arr) > 0 ) {
			echo 'fail';
		}
		else {
			echo 'success';
		}
	}
	
	// 提供地區option
	function get_section(){
		// 載入地區與類型設定檔
		require(APPPATH .'config/area.inc.php');

		$r_id = $_POST['regionid'];
		$HTML = '';

		foreach( $Area_rel[$r_id] as $key => $val ) {
			$HTML .= '<option value="'.$val.'" >'.$Sectionid[$val].'</option>';
		}

		echo $HTML;
	}
	
	// 驗證碼檢查
	function check_captcha() {
		if($this->nativesession->get('check_number') == $_POST['captcha']) {
			echo 'success';
		}
		else {
			echo 'fail';
		}
	}

	/**
	 * discuz 加密解密函數
	 *
	 * @param String $string 需要加密解密的字符串
	 * @param String $operation 類型 DECODE(解密)
	 * @param String $key 密鈅
	 * @return unknown
	 */
	function authcode($string, $operation, $key = '') {

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