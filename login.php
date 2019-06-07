<?php 
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool1.inc.php';
$link=connect();
$member_id=is_login($link);
if($member_id){
	skip('index.php','onFocus.gif','你已经登录，请不要重新登录！');
}
if(isset($_POST['submit'])){
	include 'inc/check_login.inc.php';
	escape($link,$_POST);
	$query="select * from member where username='{$_POST['username']}' and password=md5('{$_POST['password']}')";
	$result=execute($link, $query);
	if(mysqli_num_rows($result)==1){
		setcookie('user[username]',$_POST['username'],time()+$_POST['time']);
		setcookie('pwd[password]',sha1(md5($_POST['password'])),time()+$_POST['time']);
		skip('index.php','onCorrect.gif','登录成功！');
	}else{
		skip('login.php', 'onError.gif', '用户名或密码填写错误！');
	}
}
$template['title']='欢迎登录';
$template['css']=array('style/public.css','style/register.css');
?>
<?php include 'inc/header.inc.php'?>
	<div id="register" class="auto">
		<h2>请登录</h2>
		<form method="post">
			<label>用户名：<input type="text" name="username"  /><span>*请输入用户名</span></label>
			<label>密码：<input type="password" name="password"  /><span>*请输入密码</span></label>
			<label>验证码：<input name="vcode" type="text"  /><span>*请输入下方验证码</span></label>
			<a href="login.php"><img class="vcode" src="show_code.php" /></a>
			<label>自动登录：
				<select style="width:236px;height:25px;" name="time">
					<option value="300">5分钟内</option>
					<option value="3600">1小时内</option>
					<option value="86400">1天内</option>
					<option value="259200">3天内</option>
					<option value="2592000">30天内</option>
				</select>
				<span>*公共电脑上请勿长期自动登录</span>
			</label>
			<div style="clear:both;"></div>
			<input class="btn" type="submit" name="submit" value="登录" />
		</form>
	</div>
<?php include 'inc/footer.inc.php'?>