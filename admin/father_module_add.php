<?php
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
$link=connect();
include_once 'inc/is_manage_login.inc.php';
if(isset($_POST['submit'])){
	$link=connect();
	//验证用户填写的信息
	$check_flag='add';
	include 'inc/check_father_module.inc.php';
	$query="insert into father_module(module_name,sort) values('{$_POST['module_name']}',{$_POST['sort']})";
	execute($link,$query);
	if(mysqli_affected_rows($link)==1){
		skip('father_module.php','onCorrect.gif','恭喜你，添加成功！');
	}else{
		skip('faher_module_add.php','onError.gif','对不起，添加失败，请重试！');
	}
}
$template['title']='父版块添加页';
?>
<?php
include_once 'inc/header.inc.php';//top
include_once 'inc/sidebar.inc.php';//sidebar
?>
  <div class="main-wrap">
        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="father_module.php">父板块列表</a><span class="crumb-step">&gt;</span><span class="crumb-name">添加父版块</span></div>
        </div>
		<form method="post">
		<div class="result-content">
                    <table class="result-tab" width="70%">
                        <tr>
                            <th class="tc" width="7%"><input class="allChoose" name="" type="checkbox"></th>
							<td>版块名称</td>
							<td><input type="text" name="module_name" class="common-text" /></td>
							<td>版块名称不能为空，最多不超过40个字符</td>
						</tr>
						<tr>
							<th class="tc" width="7%"><input class="allChoose" type="checkbox"></th>
                            <td>排序</td>
							<td><input type="text" name="sort" class="common-text" /></td>
							<td>填入一个数字即可</td>
                        </tr>
					</table>
					<br />
					<input class="btn btn-primary btn6 mr10" type="submit" name="submit" value="添加" />
		</div>
		</form>
  </div>
</div>
<?php
include_once 'inc/footer.inc.php';//footer
?>