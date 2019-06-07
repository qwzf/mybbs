<?php 
if(empty($_POST['username'])){
	skip('login.php', 'onError.gif', '用户名不得为空！');
}
if(mb_strlen($_POST['username'])>32){
	skip('login.php', 'onError.gif', '用户名长度不要超过32个字符！');
}
if(empty($_POST['password'])){
	skip('login.php', 'onError.gif', '密码不得为空！');
}
if(strtolower($_POST['vcode'])!=strtolower($_SESSION['vcode'])){
	skip('login.php', 'onError.gif','验证码输入错误！');
}
if(empty($_POST['time']) || is_numeric($_POST['time']) || $_POST['time']>2592000){
	$_POST['time']=2592000;
}
?>