<?php
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
$link=connect();
include_once 'inc/is_manage_login.inc.php';
if(isset($_POST['submit'])){
	$link=connect();
	include 'inc/check_manage.inc.php';
	$query="insert into manage(username,password,create_time,level) values('{$_POST['username']}',md5({$_POST['password']}),now(),{$_POST['level']})";
	execute($link,$query);
	if(mysqli_affected_rows($link)==1){
		skip('manage.php','onCorrect.gif','恭喜你，添加成功！');
	}else{
		skip('manage.php','onError.gif','对不起，添加失败，请重试！');
	}
}
$template['title']='管理员添加页';
?>
<?php
include_once 'inc/header.inc.php';//top
include_once 'inc/sidebar.inc.php';//sidebar
?>
<div class="main-wrap">
        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="manage.php">管理员列表</a><span class="crumb-step">&gt;</span><span class="crumb-name">添加管理员</span></div>
        </div>
		<form method="post">
		<div class="result-content">
                    <table class="result-tab" width="70%">
                        <tr>
                            <th class="tc" width="7%"><input class="allChoose" name="" type="checkbox"></th>
							<td>管理员名称</td>
							<td><input type="text" name="username" class="common-text" /></td>
							<td>版块名称不能为空，最多不超过32个字符</td>
						</tr>
						<tr>
							<th class="tc" width="7%"><input class="allChoose" type="checkbox"></th>
                            <td>密码</td>
							<td><input type="text" name="password" class="common-text" /></td>
							<td>不能少于6位</td>
                        </tr>
						<tr>
							<th class="tc" width="7%"><input class="allChoose" type="checkbox"></th>
                            <td>等级</td>
							<td>
								<select name="level">
									<option value="1">普通管理员</option>
									<option value="0">超级管理员</option>
								</select>
							</td>
							<td>请选择管理员等级,默认为普通管理员(不具备后台管理员管理权限)</td>
                        </tr>
					</table>
					<br />
					<input class="btn btn-primary btn6 mr10" type="submit" name="submit" value="添加" />
		</div>
		</form>
  </div>
</div>
<?php include_once 'inc/footer.inc.php';//footer?>