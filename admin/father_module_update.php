<?php
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
$link=connect();
include_once 'inc/is_manage_login.inc.php';
if(!isset($_GET['Id'])||!is_numeric($_GET['Id'])){
	skip('father_module.php','onError.gif','id参数错误！');
}
$query="select*from father_module where Id={$_GET['Id']}";
$result=execute($link,$query);
if(!mysqli_num_rows($result)){
	skip('father_module.php','onShow.gif','这个版块信息不存在！');
}
if(isset($_POST['submit'])){
	//验证用户填写的信息
	$check_flag='update';
	include 'inc/check_father_module.inc.php';
	$query="update father_module set module_name='{$_POST['module_name']}',sort={$_POST['sort']} where Id={$_GET['Id']}";
	execute($link,$query);
	if(mysqli_affected_rows($link)==1){
		skip('father_module.php','onCorrect.gif','修改成功！');
	}else{
		skip('father_module.php','onError.gif','修改失败,请重试！');
	}
}
$data=mysqli_fetch_assoc($result);
$template['title']='父板块修改页';
?>
<?php
include_once 'inc/header.inc.php';//top
include_once 'inc/sidebar.inc.php';//sidebar
?>
  <div class="main-wrap">
        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="father_module.php">父版块列表</a><span class="crumb-step">&gt;</span><span class="crumb-name">修改父版块-<?php echo $data['module_name']?></span></div>
        </div>
		<form method="post">
		<div class="result-content">
                    <table class="result-tab" width="70%">
                        <tr>
                            <th class="tc" width="7%"><input class="allChoose" name="" type="checkbox"></th>
							<td>版块名称</td>
							<td><input type="text" name="module_name" class="common-text" value="<?php echo $data['module_name']?>"/></td>
							<td>版块名称不能为空，最多不超过40个字符</td>
						</tr>
						<tr>
							<th class="tc" width="7%"><input class="allChoose" type="checkbox"></th>
                            <td>排序</td>
							<td><input type="text" name="sort" class="common-text" value="<?php echo $data['sort']?>"/></td>
							<td>填入一个数字即可</td>
                        </tr>
					</table>
					<br />
					<input class="btn btn-primary btn6 mr10" type="submit" name="submit" value="修改" />
		</div>
		</form>
  </div>
</div>
<?php
include_once 'inc/footer.inc.php';//footer
?>