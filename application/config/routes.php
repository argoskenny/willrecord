<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

// 前台
$route['login']					= 'willrecord/login';
$route['logout']				= 'willrecord/logout';
$route['register']				= 'willrecord/register';
$route['newreg']				= 'willrecord/newreg';

$route['record/(:any)']			= 'willrecord/record/$1';
$route['history/(:any)']		= 'willrecord/history/$1';
$route['collect/(:any)']		= 'willrecord/collect/$1';
$route['setup/(:any)']			= 'willrecord/setup/$1';

$route['forgetpwd']				= 'willrecord/forgetpwd';
$route['send_forget_pwd_mail']	= 'willrecord/send_forget_pwd_mail';
$route['resetpwd']				= 'willrecord/resetpwd';
$route['resetdone']				= 'willrecord/resetdone';

$route['privatelaw']			= 'willrecord/privatelaw';
$route['tou']					= 'willrecord/tou';
$route['about']					= 'willrecord/about';

$route['willrecord/footer']		= 'willrecord/footer';
$route['willrecord/menu']		= 'willrecord/menu';
$route['default_controller']	= 'willrecord/index';

// 前台 AJAX
$route['ajax/set_collect']		= 'ajax/set_collect';
$route['ajax/set_topic_show']	= 'ajax/set_topic_show';
$route['ajax/set_record']		= 'ajax/set_record';
$route['ajax/set_past_record']	= 'ajax/set_past_record';
$route['ajax/calendar_change']	= 'ajax/calendar_change';
$route['ajax/set_end_topic']	= 'ajax/set_end_topic';
$route['ajax/createNewTopic'] 	= 'ajax/createNewTopic';
$route['ajax/login'] 			= 'ajax/login';
$route['ajax/checkAccount'] 	= 'ajax/checkAccount';
$route['ajax/checkEmail'] 		= 'ajax/checkEmail';
$route['ajax/get_section'] 		= 'ajax/get_section';
$route['ajax/save_profile'] 	= 'ajax/save_profile';
$route['ajax/upload_pic']		= 'ajax/upload_pic';
$route['ajax/crop_pic']			= 'ajax/crop_pic';
$route['ajax/update_record'] 	= 'ajax/update_record';

// 後台
$route['willrecordadmin/adminmenu'] 		= 'willrecrodadmin/adminmenu';
$route['willrecordadmin/sidebar'] 			= 'willrecrodadmin/sidebar';
$route['willrecordadmin/admin_login'] 		= 'willrecordadmin/admin_login';
$route['willrecordadmin/admin_logout'] 		= 'willrecordadmin/admin_logout';
$route['willrecordadmin/admin_loginset'] 	= 'willrecordadmin/admin_loginset';
$route['willrecordadmin/admin_index'] 		= 'willrecordadmin/admin_index';
$route['willrecordadmin/admin_memberlist/(:any)'] = 'willrecordadmin/admin_memberlist/$1';
$route['willrecordadmin/admin_feedback'] 	= 'willrecordadmin/admin_feedback';

// 後台 AJAX

$route['(:any)']				= 'willrecord/index';

// 反服貿
$route['foolmow']				= 'willrecord/foolmow';

/* End of file routes.php */
/* Location: ./application/config/routes.php */