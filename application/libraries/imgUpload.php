<?php


/*
 *
 * 抓取要縮圖的比例, 下述只處理 jpeg
 * $from_filename : 來源路徑, 檔名, ex: /tmp/xxx.jpg
 * $save_filename : 縮圖完要存的路徑, 檔名, ex: /tmp/ooo.jpg
 * $in_width : 縮圖預定寬度
 * $in_height: 縮圖預定高度
 * $quality  : 縮圖品質(1~100)
 *
 * Usage:
 *   ImageResize('ram/xxx.jpg', 'ram/ooo.jpg');
 */
function ImageResize($from_filename, $save_filename, $in_width=400, $in_height=300, $quality=100)
{
    $allow_format = array('jpeg', 'png', 'gif');
    $sub_name = $t = '';

    // Get new dimensions
    $img_info = getimagesize($from_filename);
    $width    = $img_info['0'];
    $height   = $img_info['1'];
    $imgtype  = $img_info['2'];
    $imgtag   = $img_info['3'];
    $bits     = $img_info['bits'];
    $channels = $img_info['channels'];
    $mime     = $img_info['mime'];

    list($t, $sub_name) = split('/', $mime);
    if ($sub_name == 'jpg') {
        $sub_name = 'jpeg';
    }

    if (!in_array($sub_name, $allow_format)) {
        return false;
    }

    // 取得縮在此範圍內的比例
    $percent = getResizePercent($width, $height, $in_width, $in_height);
    $new_width  = $width * $percent;
    $new_height = $height * $percent;

    // Resample
    $image_new = imagecreatetruecolor($new_width, $new_height);

    // $function_name: set function name
    //   => imagecreatefromjpeg, imagecreatefrompng, imagecreatefromgif
    /*
    // $sub_name = jpeg, png, gif
    $function_name = 'imagecreatefrom' . $sub_name;

    if ($sub_name=='png')
        return $function_name($image_new, $save_filename, intval($quality / 10 - 1));

    $image = $function_name($from_filename); //$image = imagecreatefromjpeg($from_filename);
    */
    $image = imagecreatefromjpeg($from_filename);

    imagecopyresampled($image_new, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

    return imagejpeg($image_new, $save_filename, $quality);
}

/**
 * 抓取要縮圖的比例
 * $source_w : 來源圖片寬度
 * $source_h : 來源圖片高度
 * $inside_w : 縮圖預定寬度
 * $inside_h : 縮圖預定高度
 *
 * Test:
 *   $v = (getResizePercent(1024, 768, 400, 300));
 *   echo 1024 * $v . "\n";
 *   echo  768 * $v . "\n";
 */
function getResizePercent($source_w, $source_h, $inside_w, $inside_h)
{
    if ($source_w < $inside_w && $source_h < $inside_h) {
        return 1; // Percent = 1, 如果都比預計縮圖的小就不用縮
    }

    $w_percent = $inside_w / $source_w;
    $h_percent = $inside_h / $source_h;

    return ($w_percent > $h_percent) ? $h_percent : $w_percent;
}

/**
*   圖片編輯上傳
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
class ImgUpload
{
    /**
    *
    * $thisMonth_LastWeekday    :   // 本月份最後一天星期
    **/ 
    
    // 產出月曆 使用TABLE
    public function getTableCalendar( $year, $month, $topicArr, $dataArr, $cond ) {
    }

    // 產出月曆 使用DIV
    public function getDivCalendar( $year, $month ) {
    }

    // 設定各參數
    public function setVar( $year, $month, $topicArr, $dataArr, $cond ) {
    }

    // 上月結尾
    public function lastMonth() {
    }
    
    // 本月所有
    public function thisMonth() {
        
    }

    // 下月開頭
    public function nextMonth() {
        
    }
    
    // 抓取日期選單
    public function getDateMenu() {
        
    }

    // 
    public function table_html() {
        
    }

    // 
    public function switch_record_tag($tag) {
        
    }
}
?>