<?php 
function skip($url,$pic,$message){
$html=<<<A
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8" />
<meta http-equiv="refresh" content="3;URL={$url}" />
<title>正在跳转中</title>
<link rel="stylesheet" type="text/css" href="style/remind.css" />
</head>
<body>
<div><img src="../admin/images/{$pic}">{$message}<a href="{$url}">3秒后自动跳转中!</a></div>
</body>
</html>
A;
echo $html;
exit();
}
//验证会员是否登录
function is_login($link){
	if(isset($_COOKIE['user']['username']) && isset($_COOKIE['pwd']['password'])){
		$query="select * from member where username='{$_COOKIE['user']['username']}' and sha1(password)='{$_COOKIE['pwd']['password']}'";
		$result=execute($link,$query);
		if(mysqli_num_rows($result)==1){
			$data=mysqli_fetch_assoc($result);
			return $data['Id'];
		}else{
			return false;
		}
	}else{
		return false;
	}
}
//验证后台管理员是否登录
function is_manage_login($link){
	if(isset($_SESSION['manage']['username']) && isset($_SESSION['manage']['password'])){
		$query="select * from manage where username='{$_SESSION['manage']['username']}' and sha1(password)='{$_SESSION['manage']['password']}'";
		$result=execute($link,$query);
		if(mysqli_num_rows($result)==1){
			return true;
		}else{
			return false;
		}
	}else{
		return false;
	}
}
function check_user($member_id,$content_member_id,$is_manage_login){
	if($member_id==$content_member_id||$is_manage_login){
		return true;
	}else{
		return false;
	}
}
?>