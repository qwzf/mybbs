<?php
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
$link=connect();
include_once 'inc/is_manage_login.inc.php';
$query="select * from info where Id=1";
$result_info=execute($link, $query);
$data_info=mysqli_fetch_assoc($result_info);
if(isset($_POST['submit'])){
	$_POST=escape($link,$_POST);
	$query="update info set title='{$_POST['title']}',keywords='{$_POST['keywords']}',description='{$_POST['description']}' where Id=1";
	execute($link, $query);
	if(mysqli_affected_rows($link)==1){
		skip('system.php','onCorrect.gif','修改成功！');
	}else{
		skip('system.php','onError.gif','修改失败,请重试！');
	}
}
$template['title']='站点设置页';
?>

<?php
include_once 'inc/header.inc.php';//top
include_once 'inc/sidebar.inc.php';//sidebar
?>
    <div class="main-wrap">
        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="index.php">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">站点设置</span></div>
        </div>
        <div class="result-wrap">
            <form method="post">
                <div class="config-items">
                    <div class="config-title">
                        <h1><i class="icon-font">&#xe00a;</i>网站信息设置</h1>
                    </div>
                    <div class="result-content">
                        <table width="100%" class="insert-tab">
                                <tr>
                                    <th><i class="require-red">*</i>网站标题：</th>
                                    <td><input type="text" id="" value="<?php echo $data_info['title']?>" size="85" name="title" class="common-text"></td>
                                </tr>
                                <tr>
                                    <th><i class="require-red">*</i>关键字：</th>
                                    <td><input type="text" id="" value="<?php echo $data_info['keywords']?>" size="85" name="keywords" class="common-text"></td>
                                </tr>
                                <tr>
                                    <th><i class="require-red">*</i>描述：</th>
                                    <td><input type="text" id="" value="<?php echo $data_info['description']?>" size="85" name="description" class="common-text"></td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td>
                                        <input type="submit" value="提交" name="submit" class="btn btn-primary btn6 mr10">
                                        <input type="button" value="返回" onclick="history.go(-1)" class="btn btn6">
                                    </td>
                                </tr>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--/main-->
</div>
<?php
include_once 'inc/footer.inc.php';//footer
?>