<?php 
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool1.inc.php';
$link=connect();
$member_id=is_login($link);
$is_manage_login=is_manage_login($link);
if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
	skip('index.php', 'onError.gif', '帖子id参数不合法!');
}
$query="select * from content where id={$_GET['id']}";
$result_content=execute($link, $query);
if(mysqli_num_rows($result_content)==1){
	$data_content=mysqli_fetch_assoc($result_content);
	$data_content['title']=htmlspecialchars($data_content['title']);
	if(check_user($member_id,$data_content['member_id'],$is_manage_login)){
		if(isset($_POST['submit'])){
			include 'inc/check_publish.inc.php';
			$_POST=escape($link, $_POST);
			$query="update content set module_id={$_POST['module_id']},title='{$_POST['title']}',content='{$_POST['content']}' where id={$_GET['id']}";
			execute($link, $query);
			if(isset($_GET['return_url'])){
				$return_url=$_GET['return_url'];
			}else{
				$return_url="member.php?id={$member_id}";
			}
			if(mysqli_affected_rows($link)==1){
				skip($return_url, 'onCorrect.gif', '帖子修改成功！');
			}else{
				skip($return_url, 'onError.gif', '帖子修改失败，请重试！');
			}
		}
	}else{
		skip('index.php', 'onError.gif', '这帖子你没有操作权限!');
	}
}else{
	skip('index.php', 'onError.gif', '帖子不存在!');
}
$template['title']='帖子修改页';
$template['css']=array('style/public.css','style/publish.css');
?>
<?php include 'inc/header.inc.php'?>
<div id="position" class="auto">
	 <a href="index.php">首页</a> &gt; 修改帖子
</div>
<div id="publish">
	<form method="post">
		<select name="module_id">
			<option value='-1'>请选择一个子版块</option>
			<?php 
			$query="select * from father_module order by sort desc";
			$result_father=execute($link, $query);
			while ($data_father=mysqli_fetch_assoc($result_father)){
				echo "<optgroup label='{$data_father['module_name']}'>";
				$query="select * from son_module where father_module_id={$data_father['Id']} order by sort desc";
				$result_son=execute($link, $query);
				while ($data_son=mysqli_fetch_assoc($result_son)){
					if($data_son['Id']==$data_content['module_id']){
						echo "<option selected='selected' value='{$data_son['Id']}'>{$data_son['module_name']}</option>";
					}else{
						echo "<option value='{$data_son['Id']}'>{$data_son['module_name']}</option>";
					}
				}
				echo "</optgroup>";
			}
			?>
		</select>
		<input class="title" placeholder="请输入标题" value="<?php echo $data_content['title']?>" name="title" type="text" />
		<textarea name="content" class="content"><?php echo $data_content['content']?></textarea>
		<input class="publish" type="submit" name="submit" value="" />
		<div style="clear:both;"></div>
	</form>
</div>
<?php include 'inc/footer.inc.php'?>