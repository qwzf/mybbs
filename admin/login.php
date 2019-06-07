<?php
header('Content-type:text/html;charset=utf-8');
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
$link=connect();
if(is_manage_login($link)){
	skip('index.php','onCorrect.gif','您已经登录，请不要重复登录！');
}
if(isset($_POST['submit'])){
	include_once 'inc/check_login.inc.php';
	$_POST=escape($link,$_POST);
	$query="select * from manage where username='{$_POST['username']}' and password=md5('{$_POST['password']}')";
	$result=execute($link, $query);
	if(mysqli_num_rows($result)==1){
		$data=mysqli_fetch_assoc($result);
		$_SESSION['manage']['username']=$data['username'];
		$_SESSION['manage']['password']=sha1($data['password']);
		$_SESSION['manage']['id']=$data['Id'];
		$_SESSION['manage']['level']=$data['level'];
		skip('index.php','onCorrect.gif','登录成功！');
	}else{
		skip('login.php','onError.gif','用户名或者密码错误，请重试！');
	}
}
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>后台管理登录</title>
    <link href="css/admin_login.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="admin_login_wrap">
    <h1>后台管理登录</h1>
    <div class="adming_login_border">
        <div class="admin_input">
            <form method="post">
                <ul class="admin_items">
                    <li>
                        <label for="username">用户名：</label>
                        <input type="text" name="username" id="username" size="40" class="admin_input_style" />
                    </li>
                    <li>
                        <label for="password">密 码：</label>
                        <input type="password" name="password" id="password" size="40" class="admin_input_style" />
                    </li>
					<li>
						<label for="vcode">验证码:</label>
						<input name="vcode" type="text" size="40" class="admin_input_style" />
						<a href="login.php"><img class="vcode" src="../show_code.php" /></a>
					</li>
                    <li>
                        <input type="submit" name="submit" tabindex="3" value="提交" class="btn btn-primary" />
                    </li>
                </ul>
            </form>
        </div>
    </div>
    <p class="admin_copyright"><a tabindex="5" href="index.php" target="_blank">返回首页</a> &copy; 2019 Powered by <a href="http://qwzf.github.io" target="_blank">Q子枫</a></p>
</div>
</body>
</html>