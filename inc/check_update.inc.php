<?php 
if(empty($_POST['password'])){
	skip('member_update.php', 'onError.gif', '新密码不得为空！');
}
if(mb_strlen($_POST['password'])<6){
	skip('member_update.php', 'onError.gif','新密码不得少于6位！');
}
if($_POST['password']!=$_POST['confirm_pw']){
	skip('member_update.php', 'onError.gif','两次密码输入不一致！');
}
if(strtolower($_POST['vcode'])!=strtolower($_SESSION['vcode'])){
	skip('member_update.php', 'onError.gif','验证码输入错误！');
}
?>