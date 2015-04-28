<?php
if ( ! defined('BASEPATH') )
    exit( 'No direct script access allowed' );
/**
*   月曆製作
*   @author argos
*   @package tool
*   @param string 本月年份 0000
*   @param string 本月月份 00
*   @param string 是否為登入者 可否編輯
*   @param array 計劃資料
*   @param array 每日資料 key值為Ymd格式的陣列 欲輸出的資料
*
*   @return string 月曆HTML編碼     
*   
**/
class Tool_calendar
{
    /**
    * 本月份參數
    * $thisMonth_Y              :   // 本月年份 [需先指定]
    * $thisMonth_M              :   // 本月月份 [需先指定]
    *
    * $thisMonth_YM             :   // 本月年月
    * $thisMonth_FirstDate      :   // 本月份第一天日期
    * $thisMonth_TotalDays      :   // 本月份總天數
    * $thisMonth_LastDate       :   // 本月份最後一天日期
    * $thisMonth_FirstWeekday   :   // 本月份第一天星期
    * $thisMonth_LastWeekday    :   // 本月份最後一天星期
    **/ 
    var $thisMonth_Y = '';
    var $thisMonth_M = '';
    
    var $thisMonth_YM = '';
    var $thisMonth_FirstDate = '';
    var $thisMonth_TotalDays = '';
    var $thisMonth_LastDate = '';
    var $thisMonth_FirstWeekday = '';
    var $thisMonth_LastWeekday = '';

    /**
    * 上月份參數
    * $lastMonth_YM             :   // 上月份年月
    * $lastMonth_TotalDays      :   // 上月份總天數
    * $lastMonth_LastWeekday    :   // 上月份最後一天星期
    **/ 
    var $lastMonth_YM = '';
    var $lastMonth_TotalDays = '';
    var $lastMonth_LastWeekday = '';

    /**
    * 下月份參數
    * $nextMonth_YM             :   // 下月份年份
    * $nextMonth_FirstWeekday   :   // 下月份第一天星期
    **/
    var $nextMonth_YM = '';
    var $nextMonth_FirstWeekday = '';

    // 計劃資料
    var $topicDataArr = array();

    // 每日資料
    var $record = array();

    // 月曆暫存資料
    var $calendarTmp = array();

    // 登入者狀態
    var $loginCondition = '';

    // 選單資料
    var $date_menu = '';

    // 編輯過去紀錄icon
    var $edit_png = 'assets/img/backgrounds/edit_icon.png';

    // 產出月曆 使用TABLE
    public function getTableCalendar( $year, $month, $topicArr, $dataArr, $cond )
    {
        $this->setVar( $year, $month, $topicArr, $dataArr, $cond );
        $this->lastMonth();
        $this->thisMonth();
        $this->nextMonth();
        $this->getDateMenu();
        return $this->table_html();
    }

    // 產出月曆 使用DIV
    public function getDivCalendar( $year, $month )
    {
    }

    // 設定各參數
    public function setVar( $year, $month, $topicArr, $dataArr, $cond )
    {
        $month = str_pad($month,2,'0',STR_PAD_LEFT);

        // 本月參數
        $thisMonth_FirstTime = strtotime($year.$month.'01');

        $this->thisMonth_Y = $year;
        $this->thisMonth_M = $month;
        $this->thisMonth_YM = date( 'Ym' , $thisMonth_FirstTime );
        $this->thisMonth_FirstDate = $year.$month.'01';
        $this->thisMonth_TotalDays = date( 't' , $thisMonth_FirstTime );
        $this->thisMonth_LastDate = $year.$month.$this->thisMonth_TotalDays;
        $this->thisMonth_FirstWeekday = date( 'w' , $thisMonth_FirstTime );
        $this->thisMonth_LastWeekday = date( 'w' , strtotime($this->thisMonth_LastDate) );

        // 上月參數
        $lastMonth_LastTime = $thisMonth_FirstTime - 86400;

        $this->lastMonth_YM = date( 'Ym' , $lastMonth_LastTime );
        $this->lastMonth_TotalDays = date( 't' , $lastMonth_LastTime );
        $this->lastMonth_LastWeekday = date( 'w' , $lastMonth_LastTime );

        // 下月參數
        $nextMonth_FirstTime = strtotime($this->thisMonth_LastDate) + 86400;

        $this->nextMonth_YM = date( 'Ym' , $nextMonth_FirstTime);
        $this->nextMonth_FirstWeekday = date( 'w' , $nextMonth_FirstTime);

        // 陣列資料
        $this->topicDataArr = $topicArr;
        $this->record = $dataArr;

        // 登入資料
        $this->loginCondition = $cond;
    }

    // 上月結尾
    public function lastMonth()
    {
        if ( $this->lastMonth_LastWeekday >= 0 ) {
            $lastMonthStart = $this->lastMonth_TotalDays - $this->lastMonth_LastWeekday;
            for ($d = $lastMonthStart; $d <= $this->lastMonth_TotalDays ; $d++) {
                // 狀態樣式
                $status_calss = 'active';
                
                $dayfix = str_pad($d,2,'0',STR_PAD_LEFT);
                $record_date = $this->lastMonth_YM.$dayfix;
                
                if ( !empty($this->record[$record_date]['status_tag']) ) {
                    $status_tag = $this->switch_record_tag($this->record[$record_date]['status_tag']);
                    $status_calss = 'active '.$status_tag;
                }
                $this->calendarTmp[] = '<td class="'.$status_calss.'">
                                            <span class="not_current_month">'.$d.'</span>
                                        </td>';
            }
        }
    }
    
    // 本月所有
    public function thisMonth()
    {
        for ($d=1; $d<=$this->thisMonth_TotalDays; $d++) { 
            // 狀態樣式
            $status_calss = 'normal';
            $status_tag = '';

            // 尚未紀錄圖示
            $editIcon = '';
            
            $dayfix = str_pad($d,2,'0',STR_PAD_LEFT);
            $record_date = $this->thisMonth_YM.$dayfix;
            
            // 資料不存在 可能為未來或未輸入
            if ( empty($this->record[$record_date]['status_tag']) ) {
                // 計劃開啟時間之後
                if ( $this->topicDataArr[0]['add_time'] < strtotime($record_date.' 23:59:59') ) {
                    // 過去
                    if ( time() > strtotime($record_date.' 23:59:59') ) {
                        if ( $this->loginCondition == 'self' ) {
                            $editIcon = '<a href="javascript:;" onclick="set_past_modal('.$record_date.')" id="editicon_'.$record_date.'">
                                            <img src="'.$this->edit_png.'" class="edit_past_icon">
                                        </a>';
                        }
                    }
                    // 未來
                    else {
                         $status_calss = 'active';
                    }
                }
                // 計劃開啟時間之前
                else {
                    $status_calss = 'active';
                }
            }
            // 資料存在
            else {
                $status_tag = $this->switch_record_tag($this->record[$record_date]['status_tag']);
            }

            // 今日
            if ( $this->thisMonth_YM == date( 'Ym' ) && $d == date('d') ) {
                $status_calss  = 'today';
            }

            $this->calendarTmp[] = '<td class="'.$status_calss.$status_tag.'" id="td_'.$record_date.'">
                                        '.$d.$editIcon.'
                                    </td>';
        }
    }

    // 下月開頭
    public function nextMonth()
    {
        if ( $this->thisMonth_LastWeekday < 6) {
            $nextMonthMax = 6 - $this->thisMonth_LastWeekday;
            for ($d = 1; $d <= $nextMonthMax; $d++) {
                $status_calss = 'active';

                $dayfix = str_pad($d,2,'0',STR_PAD_LEFT);
                $record_date = $this->nextMonth_YM.$dayfix;
                
                if ( !empty($this->record[$record_date]['status_tag']) ) {
                    $status_tag = $this->switch_record_tag($this->record[$record_date]['status_tag']);
                    $status_calss = 'active '.$status_tag;
                }

                // 下個月一號
                $monthNextHtml = ( $d == 1 ) ? str_replace('0', '', date('m',strtotime($this->nextMonth_YM.$dayfix))).'月'.$d.'日' : $d;
                
                $this->calendarTmp[] = '<td class="'.$status_calss.'">
                                            <span class="not_current_month">'.$monthNextHtml.'</span>
                                        </td>';
            }
        }
    }
    
    // 抓取日期選單
    public function getDateMenu(){
        $month_flag = strtotime($this->thisMonth_YM.'01') - ( 86400 * 190 );
        for ($i=0; $i<12 ; $i++) { 
            $month_flag = $month_flag + ( 86400 * 20 );
            $disable = ( $this->thisMonth_YM == date('Ym',$month_flag) ) ? 'class="disabled"' : '';
            $this->date_menu .=    '<li '.$disable.'>
                                        <a href="javascript:;" onclick="calendar_change(\'manual\',\''.date('Ym',$month_flag).'\');">
                                            '.date('Y',$month_flag).'年'.date('m',$month_flag).'月
                                        </a>
                                    </li>';
            $month_flag = strtotime(date('Ym',$month_flag).'15');
        }
    }

    // 列印TABLE
    public function table_html(){
        /* 年曆
        <div class="btn-group switch_panel">
            <button type="button" class="btn btn-default">年</button>
            <button type="button" class="btn btn-default active">月</button>
        </div>
        */
        $weekCount = 0;
        $record_calender_html = '<div id="table_'.$this->thisMonth_YM.'">
                                    <div class="calerder_panel">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default" onclick="calendar_change(\'prev\',\'\');">«</button>
                                            <button type="button" class="btn btn-default" data-toggle="dropdown">
                                                '.$this->thisMonth_Y.'年'.$this->thisMonth_M.'月
                                            </button>
                                            <button type="button" id="last_menu" class="btn btn-default" onclick="calendar_change(\'next\',\'\');">»</button>
                                            <ul class="dropdown-menu">'.$this->date_menu.'</ul>
                                        </div>
                                    </div>
                                    <div class="loading_div">
                                        <img src="assets/img/backgrounds/loading.gif" width="50" height="50">
                                    </div>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>週日</th>
                                            <th>週一</th>
                                            <th>週二</th>
                                            <th>週三</th>
                                            <th>週四</th>
                                            <th>週五</th>
                                            <th>週六</th>
                                        </tr>
                                        <tr>';
        foreach ($this->calendarTmp as $key => $html) {
            if ($weekCount == 6) {
                $record_calender_html .= $html.'</tr><tr>';
                $weekCount = 0;
            }
            else {
                $record_calender_html .= $html;
                $weekCount++;
            }
        }
        $record_calender_html .= '</tr></table></div>';

        return $record_calender_html;
    }

    // 每日紀錄轉換文字
    public function switch_record_tag($tag){
        switch ($tag) {
            case '0':
                $str = '';
            break;
            case '1':
                $str = ' success_tag';
            break;
            case '2':
                $str = ' fail_tag';
            break;
        }
        return $str;
    }
}
?>