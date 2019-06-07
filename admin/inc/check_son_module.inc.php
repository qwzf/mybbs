<?php 
if(!is_numeric($_POST['father_module_id'])){
	skip('son_module_add.php','onError.gif','所属父版块不得为空！');
}
$query="select * from father_module where Id={$_POST['father_module_id']}";
$result=execute($link,$query);
if(mysqli_num_rows($result)==0){
	skip('son_module_add.php','onError.gif','所属父版块不存在！');
}
if(empty($_POST['module_name'])){
	skip('son_module_add.php','onError.gif','子版块名称不得为空！');
}
if(mb_strlen($_POST['module_name'])>40){
	skip('son_module_add.php','onError.gif','子版块名称不得多余40个字符！');
}
$_POST=escape($link,$_POST);
switch ($check_flag){
	case 'add':
		$query="select * from son_module where module_name='{$_POST['module_name']}'";
		break;
	case 'update':
		$query="select * from father_module where module_name='{$_POST['module_name']}' and id!={$_GET['id']}";
		break;
	default:
		skip('father_module_add.php','onError.gif','$check_flag参数错误！');
}
$result=execute($link,$query);
if(mysqli_num_rows($result)){
	skip('son_module_add.php','onError.gif','这个子版块已经有了！');
}
if(mb_strlen($_POST['info'])>300){
	skip('son_module_add.php','onError.gif','子版块简介不得多于300个字符！');
}
if(!is_numeric($_POST['sort'])){
	skip('son_module_add.php','onError.gif','排序只能是数字！');
}
?>