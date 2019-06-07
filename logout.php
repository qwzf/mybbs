<?php
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool1.inc.php';
header('Content-type:text/html;charset=utf-8');
$link=connect();
$member_id=is_login($link);
if(!$member_id){
	skip('index.php','onFocus.gif','你未登录，不需要注销！');
}else{
setcookie('user[username]','',time()-3600);
setcookie('pwd[password]','',time()-3600);
skip('index.php','onCorrect.gif','注销成功！');
}
?>