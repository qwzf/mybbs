<?php 
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool1.inc.php';
$link=connect();
$is_manage_login=is_manage_login($link);
if(!$member_id=is_login($link)){
	skip('login.php', 'onFocus.gif', '请登录之后再修改密码!');
}
$query="select * from member where id={$member_id}";
$result_memebr=execute($link,$query);
$data_member=mysqli_fetch_assoc($result_memebr);
if(isset($_POST['submit'])){
	include 'inc/check_update.inc.php';
	$_POST=escape($link, $_POST);
	$query="update member set password=md5('{$_POST['password']}') where id={$member_id}";
	execute($link, $query);
	if(mysqli_affected_rows($link)==1){
		skip('login.php','onCorrect.gif','密码修改成功,请重新登录！');
	}else{
		skip('member_update.php','onError.gif','密码修改失败,请重试！');
	}
}
$template['title']='修改密码页';
$template['css']=array('style/public.css','style/register.css');
?>
<?php include 'inc/header.inc.php' ?>
	<div id="register" class="auto">
		<h2>请修改密码</h2>
		<form method="post">
			<label>新密码：<input type="password" name="password" /><span>*密码不得少于6位</span></label>
			<label>确认新密码：<input type="password" name="confirm_pw" /><span>*请输入与上面一致</span></label>
			<label>验证码：<input name="vcode" name="vocode" type="text"  /><span>*请输入下方验证码</span></label>
			<a href="register.php"><img class="vcode" src="show_code.php" /></a>
			<div style="clear:both;"></div>
			<input class="btn" name="submit" type="submit" value="确定修改" />
		</form>
	</div>
<?php include 'inc/footer.inc.php'?>