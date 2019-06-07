<?php 
if(empty($_POST['username'])){
	skip('login.php','onError.gif','管理员名称不得为空！');
}
if(mb_strlen($_POST['username'])>32){
	skip('login.php','onError.gif','管理员名称不得多余32个字符！');
}
if(mb_strlen($_POST['password'])<6){
	skip('login.php','onError.gif','密码不得少于6位！');
}
if(strtolower($_POST['vcode'])!=strtolower($_SESSION['vcode'])){
	skip('login.php', 'onError.gif','验证码输入错误！');
}
?>