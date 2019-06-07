<?php 
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool1.inc.php';
$link=connect();
$member_id=is_login($link);
if(isset($_POST['submit'])){
	include 'inc/check_register.inc.php';
	$query="insert into member(username,password,register_time) values('{$_POST['username']}',md5('{$_POST['password']}'),now())";
	execute($link,$query);
	if(mysqli_affected_rows($link)==1){
		setcookie('user[username]',$_POST['username']);
		setcookie('pwd[password]',sha1(md5($_POST['password'])));
		skip('index.php','onCorrect.gif','注册成功！');
	}else{
		skip('register.php','onError.gif','注册失败,请重试！');
	}
}
$template['title']='会员注册页';
$template['css']=array('style/public.css','style/register.css');
?>
<?php include 'inc/header.inc.php' ?>
	<div id="register" class="auto">
		<h2>欢迎注册成为会员</h2>
		<form method="post">
			<label>用户名：<input type="text" name="username" /><span>*用户名不得为空，并且长度不得超过32个字符</span></label>
			<label>密码：<input type="password" name="password" /><span>*密码不得少于6位</span></label>
			<label>确认密码：<input type="password" name="confirm_pw" /><span>*请输入与上面一致</span></label>
			<label>验证码：<input name="vcode" name="vocode" type="text"  /><span>*请输入下方验证码</span></label>
			<a href="register.php"><img class="vcode" src="show_code.php" /></a>
			<div style="clear:both;"></div>
			<input class="btn" name="submit" type="submit" value="确定注册" />
		</form>
	</div>
	<div id="footer" class="auto">
		<div class="bottom">
			<a>Q子枫</a>
		</div>
		<div class="copyright">Powered by qwzf ©2019</div>
	</div>
<?php include 'inc/footer.inc.php'?>