<?php
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
$link=connect();
include_once 'inc/is_manage_login.inc.php';
$template['title']='管理员列表页';
?>
<?php
include_once 'inc/header.inc.php';//top
include_once 'inc/sidebar.inc.php';//sidebar
?>
<div class="main-wrap">
        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="index.php">后台首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">管理员列表</span></div>
        </div>
        <div class="result-wrap">
            <form name="myform" id="myform" method="post">
                <div class="result-title">
                    <div class="result-list">
                        <a href="manage_add.php"><i class="icon-font"></i>新增管理员</a>
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                            <th class="tc" width="5%"><input class="allChoose" name="" type="checkbox"></th>
							<th>ID</th>
                            <th>名称</th>	 	 	
							<th>等级</th>
							<th>创建日期</th>
							<th>操作</th>
                        </tr>
						<?php
						$query="select*from manage";
						$result=execute($link,$query);
						while ($data=mysqli_fetch_assoc($result)){
							if($data['level']==0){
								$data['level']='超级管理员';
							}else{
								$data['level']='普通管理员';
							}
							
							$url=urlencode("manage_delete.php?id={$data['Id']}");
							$return_url=urlencode($_SERVER['REQUEST_URI']);
							$message="你真的要删除管理员 {$data['username']} 吗？";
							$delete_url="confirm.php?url={$url}&return_url={$return_url}&message={$message}";
							
$html=<<<A
							<tr>
								<td class="tc"><input name="id[]" value="59" type="checkbox"></td>
								<td>{$data['Id']}</td>
								<td>{$data['username']}</td>
								<td>{$data['level']}</td>
								<td>{$data['create_time']}</td>
								<td><a href="{$delete_url}">[删除]</a></td>
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
<?php include_once 'inc/footer.inc.php';//footer?>