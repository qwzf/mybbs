<?php 
if(empty($_POST['username'])){
	skip('register.php', 'onError.gif', '用户名不得为空！');
}
if(mb_strlen($_POST['username'])>32){
	skip('register.php', 'onError.gif', '用户名长度不要超过32个字符！');
}
if(mb_strlen($_POST['password'])<6){
	skip('register.php', 'onError.gif','密码不得少于6位！');
}
if($_POST['password']!=$_POST['confirm_pw']){
	skip('register.php', 'onError.gif','两次密码输入不一致！');
}
if(strtolower($_POST['vcode'])!=strtolower($_SESSION['vcode'])){
	skip('register.php', 'onError.gif','验证码输入错误！');
}
$_POST=escape($link,$_POST);
$query="select * from member where username='{$_POST['username']}'";
$result=execute($link, $query);
if(mysqli_num_rows($result)){
	skip('register.php', 'onError.gif', '这个用户名已经被别人注册了！');
}
?>