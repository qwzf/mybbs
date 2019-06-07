<?php
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
	echo"<script type='text/javascript'>alert('id参数错误!');location='member_list.php';</script>";
	exit();
}
$link=connect();
include_once 'inc/is_manage_login.inc.php';
$query="delete from member where id={$_GET['id']}";
execute($link,$query);
if(mysqli_affected_rows($link)==1){
	skip('member_list.php','onCorrect.gif','恭喜你删除成功！');
}else{
	skip('member_list.php','onError.gif','对不起删除失败，请重试！');
}
?>