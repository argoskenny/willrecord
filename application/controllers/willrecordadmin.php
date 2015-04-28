<?php
class Willrecordadmin extends CI_Controller {
	
	// 建構子
	public function __construct(){
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
	}
	
	// 首頁
	public function admin_login(){
		$data['title'] = '意志曆';
		$this->load->view('willrecordadmin/admin_login',$data);
	}

	// 登入
	public function admin_loginset(){
		if ( $_POST['adminID'] == ADMIN_ID && md5($_POST['password']) == ADMIN_PWD ) {
			$this->nativesession->set('ADMIN_ID',ADMIN_ID);
			header('location:'.base_url().'willrecordadmin/admin_index');
		}
		else{
			header('location:'.base_url().'willrecordadmin/admin_login');
		}
	}
	
	// 主頁
	public function admin_index(){
		// 存取登入者計劃資料
		$this->sessioncheck();
		$data = $this->sidebarActive();
		$data['title'] = '後台主頁';

		$this->load->view('willrecordadmin/admin_index',$data);
	}

	// 會員列表
	public function admin_memberlist($page){
		// 存取登入者計劃資料
		$this->sessioncheck();
		$data = $this->sidebarActive('memberlist');

		// 列表
		$listHtml = '';
		$where_arr 	= array();
		$page = ( $page == 1 ) ? 0 : ( $page - 1 ) * 20; // 頁數轉換
		if( !empty($where_arr) ) {
			$this->db->where($where_arr);
		}
		$this->db->order_by('reg_time','DESC');
		$this->db->limit(20,$page);
		$query = $this->db->get('w_member');
		$query_arr = $query->result_array();
		foreach ( $query_arr as $key => $value ) {
			$listHtml .= 	'<tr>
								<td>'.$value['id'].'</td>
								<td><a href="record/'.$value['account'].'" target="_blank">'.$value['account'].'</a></td>
								<td>'.$value['name'].'</td>
								<td>'.$value['email'].'</td>
								<td>'.date('Y-m-d H:i:s',$value['reg_time']).'</td>
							</tr>';
		}

		// 分頁
		if( !empty($where_arr) ) {
			$this->db->where($where_arr);
		}
		$allmember = $this->db->count_all_results('w_member');
		$this->load->library('pagination');
		$config = $this->pagestyle();
		$config['base_url'] = base_url().'admin_memberlist'; // 設定頁面輸出網址
		
		$config['first_url'] = 'willrecordadmin/admin_memberlist/1';
		//$config['suffix'] = $sufix_q.http_build_query($_GET, '', '&');
		$config['total_rows'] = $allmember; // 計算所有筆數
		$config['per_page'] = '20'; // 一個分頁的數量
		$config["uri_segment"] = 1;
		$config['num_links'] = 3;
		$config['use_page_numbers']	= TRUE;
		
		$this->pagination->initialize($config);
		$data['pages'] = $this->pagination->create_links();
		$data['listHtml'] = $listHtml;
		$data['title'] = '會員列表';

		$this->load->view('willrecordadmin/admin_memberlist',$data);
	}

	// 問題與建議
	public function admin_feedback(){
		// 存取登入者計劃資料
		$this->sessioncheck();
		$data = $this->sidebarActive('feedback');
		$data['title'] = '問題與建議';
		
		$this->load->view('willrecordadmin/admin_feedback',$data);
	}

	public function admin_logout(){
		$this->nativesession->delete('ADMIN_ID');
		header('location:'.base_url().'willrecordadmin/admin_login');
	}

	// 通用函式 ================================

	// 分頁樣式
	function pagestyle(){
		$config['full_tag_open']	= '<ul class="pagination">';
		$config['full_tag_close']	= '</ul>';
		$config['cur_tag_open']		= '<li class="active"><span>';
		$config['cur_tag_close']	= '<span class="sr-only">(current)</span></span>';
		$config['num_tag_open']		= '<li>';
		$config['num_tag_close']	= '</li>';
		
		$config['first_link']		= '&laquo;';
		$config['first_tag_open']	= '<li>';
		$config['first_tag_close']	= '</li>';
		$config['last_link']		= '&raquo;';
		$config['last_tag_open']	= '<li>';
		$config['last_tag_close']	= '</li>';
		
		$config['prev_link']		= '&lsaquo;';
		$config['prev_tag_open']	= '<li>';
		$config['prev_tag_close']	= '</li>';
		$config['next_link']		= '&rsaquo;';
		$config['next_tag_open']	= '<li>';
		$config['next_tag_close']	= '</li>';
		return $config;
	}

	// 登入驗證
	function sessioncheck(){
		$ADMIN_ID = $this->nativesession->get('ADMIN_ID');
		if( !empty($ADMIN_ID) ) {
			return;
		}
		else{
			header('location:'.base_url().'willrecordadmin/admin_login');
		}
	}

	// 存取計劃統計資料
	function topic_record_count($topicid, $tag){
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

	// 側欄列表
	function sidebarActive($page=''){
		$sidebarArray = array();
		$sidebarArray['sideActive']['memberlist'] = '';
		$sidebarArray['sideActive']['feedback'] = '';

		$sidebarArray['sideActive'][$page] = 'class="active"';
		return $sidebarArray;
	}

	// 每日紀錄轉換文字
	function switch_record_tag($tag){
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
	function chinese_number($sel_num = ''){
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