<?php 
if(empty($_POST['username'])){
	skip('manage_add.php','onError.gif','管理员名称不得为空！');
}
if(mb_strlen($_POST['username'])>32){
	skip('manage_add.php','onError.gif','管理员名称不得多余32个字符！');
}
if(mb_strlen($_POST['password'])<6){
	skip('manage_add.php','onError.gif','密码不得少于6位！');
}
$_POST=escape($link,$_POST);
$query="select * from manage where username='{$_POST['username']}'";
$result=execute($link,$query);
if(mysqli_num_rows($result)){
	skip('manage_add.php','onError.gif','这个名称已经有了！');
}
if(!isset($_POST['level'])){
	$_POST['level']=1;
}elseif ($_POST['level']=='0'){
	$_POST['level']=0;
}elseif ($_POST['level']=='1'){
	$_POST['level']=1;
}else{
	$_POST['level']=1;
}
?>