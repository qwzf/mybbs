<?php
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
$link=connect();
include_once 'inc/is_manage_login.inc.php';
$template['title']='子板块列表页';
$query="select sm.id,sm.module_name,fm.module_name father_module_name,sm.member_id,sm.sort from son_module sm,father_module fm where sm.father_module_id=fm.id order by fm.id";
$result=execute($link,$query);
?>
<?php
include_once 'inc/header.inc.php';//top
include_once 'inc/sidebar.inc.php';//sidebar
?>
<div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="index.php">后台首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">子版块列表</span></div>
        </div>
        <div class="result-wrap">
            <form name="myform" id="myform" method="post">
                <div class="result-title">
                    <div class="result-list">
                        <a href="son_module_add.php"><i class="icon-font"></i>新增板块</a>
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                            <th class="tc" width="5%"><input class="allChoose" name="" type="checkbox"></th>
                            <th>排序</th>
							<th>ID</th>
                            <th>版块名称</th>
							<th>所属父版块</th>
							<th>版主</th>
                            <th>操作</th>
                        </tr>
						<?php
						while($data=mysqli_fetch_assoc($result)){
							$url=urlencode("son_module_delete.php?id={$data['id']}");
							$return_url=urlencode($_SERVER['REQUEST_URI']);
							$message="你真的要删除父版块 {$data['module_name']} 吗？";
							$delete_url="confirm.php?url={$url}&return_url={$return_url}&message={$message}";
$html=<<<A
							<tr>
								<td class="tc"><input name="id[]" value="59" type="checkbox"></td>
								<td>
									<input class="common-input sort-input" name="ord[]" value="{$data['sort']}" type="text">
								</td>
								<td>{$data['id']}</td>
								<td>{$data['module_name']}</td>
								<td>{$data['father_module_name']}</td>
								<td>{$data['member_id']}</td>
								<td>
									<a class="link-update" href="#">[访问]</a>
									<a class="link-update" href="son_module_update.php?id={$data['id']}">[修改]</a>
									<a class="link-del" href="$delete_url">[删除]</a>
								</td>
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