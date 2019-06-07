<?php 
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool1.inc.php';
$link=connect();
if(!$member_id=is_login($link)){
	skip('login.php', 'onFocus.gif', '请登录之后再回复!');
}
if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
	skip('index.php', 'onError.gif', '您要回复的帖子id参数不合法!');
}
$query="select c.id,c.title,m.username from content c,member m where c.id={$_GET['id']} and c.member_id=m.id";
$result_content=execute($link, $query);
if(mysqli_num_rows($result_content)!=1){
	skip('index.php', 'onError.gif', '您要回复的帖子不存在!');
}
$data_content=mysqli_fetch_assoc($result_content);
$data_content['title']=htmlspecialchars($data_content['title']);
if(isset($_POST['submit'])){
	include 'inc/check_reply.inc.php';
	$_POST=escape($link,$_POST);
	$query="insert into reply(content_id,content,time,member_id) values({$_GET['id']},'{$_POST['content']}',now(),{$member_id})";
	execute($link, $query);
	if(mysqli_affected_rows($link)==1){
		skip("show.php?id={$_GET['id']}", 'onCorrect.gif', '回复成功!');
	}else{
		skip($_SERVER['REQUEST_URI'], 'onError.gif', '回复失败,请重试!');
	}
}
$template['title']='帖子回复页';
$template['css']=array('style/public.css','style/publish.css');
?>
<?php include 'inc/header.inc.php'?>
<div id="position" class="auto">
	 <a>首页</a> &gt; 回复帖子
</div>
<div id="publish">
	<div>回复：由 <?php echo $data_content['username']?> 发布的： <?php echo $data_content['title']?></div>
	<form method="post">
		<textarea name="content" class="content"></textarea>
		<input class="reply" type="submit" name="submit" value="" />
		<div style="clear:both;"></div>
	</form>
</div>
<?php include 'inc/footer.inc.php'?>