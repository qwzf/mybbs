<?php
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
$link=connect();
include_once 'inc/is_manage_login.inc.php';
$template['title']='用户列表页';
$query="select*from member";
$result=execute($link,$query);
?>
<?php
include_once 'inc/header.inc.php';//top
include_once 'inc/sidebar.inc.php';//sidebar
?>
<div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="index.php">后台首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">用户列表</span></div>
        </div>
        <div class="result-wrap">
            <form name="myform" id="myform" method="post">
                <div class="result-title">
                    <div class="result-list">
                        <a href="../register.php" target="_blank"><i class="icon-font"></i>新增用户</a>
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                            <th class="tc" width="5%"><input class="allChoose" name="" type="checkbox"></th>
							<th>ID</th>
                            <th>用户</th>
							<th>头像</th>
							<th>注册时间</th>
                            <th>操作</th>
                        </tr>
						<?php
						while($data=mysqli_fetch_assoc($result)){
							$url=urlencode("member_list_delete.php?id={$data['Id']}");
							$return_url=urlencode($_SERVER['REQUEST_URI']);
							$message="你真的要删除用户 {$data['username']} 吗？";
							$delete_url="confirm.php?url={$url}&return_url={$return_url}&message={$message}";
$html=<<<A
							<tr>
								<td class="tc"><input name="id[]" value="59" type="checkbox"></td>
								<td>{$data['Id']}</td>
								<td>{$data['username']}</td>
								<td><img width="60" height="60"src="../{$data['photo']}"></td>
								<td>{$data['register_time']}</td>
								<td><a class="link-del" href="$delete_url">[删除]</a></td>
							</tr>
A;
							echo $html;
						}
						?>
                    </table>
                </div>
            </form>
        </div>
    </div>
    <!--/main-->
</div>
<?php
include_once 'inc/footer.inc.php';//footer
?>