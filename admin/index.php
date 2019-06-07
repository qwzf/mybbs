<?php
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
$link=connect();
include_once 'inc/is_manage_login.inc.php';

$query="select * from manage where id={$_SESSION['manage']['id']}";
$result_manage=execute($link, $query);
$data_manage=mysqli_fetch_assoc($result_manage);

$query="select count(*) from father_module";
$count_father_module=num($link,$query);

$query="select count(*) from son_module";
$count_son_module=num($link,$query);

$query="select count(*) from content";
$count_content=num($link,$query);

$query="select count(*) from reply";
$count_reply=num($link,$query);

$query="select count(*) from member";
$count_member=num($link,$query);

$query="select count(*) from manage";
$count_manage=num($link,$query);

if($data_manage['level']=='0'){
	$data_manage['level']='超级管理员';
}else{
	$data_manage['level']='普通管理员';
}
$template['title']='系统信息';
?>

<?php
include_once 'inc/header.inc.php';//top
include_once 'inc/sidebar.inc.php';//sidebar
?>
    <div class="main-wrap">
        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font">&#xe06b;</i><span>欢迎管理员</span></div>
        </div>
        <div class="result-wrap">
            <div class="result-title">
                <h1>系统基本信息</h1>
            </div>
            <div class="result-content">
                <ul class="sys-info-list">
					<li>
						<label class="res-lab">您好: </label><span class="res-info"><?php echo $data_manage['username']?></span>
					</li>
					<li>
						<label class="res-lab">所属角色：</label><<span class="res-info"><?php echo $data_manage['level']?> </span>
					</li>
					<li>
						<label class="res-lab">创建时间：</label><span class="res-info"><?php echo $data_manage['create_time']?></span>
					</li>
                </ul>
			</div>
			<br />
			<div class="result-content">
				<ul>
					<li> 
						<span class="res-info">
							父版块(<?php echo $count_father_module?>)
							子版块(<?php echo $count_son_module?>)
							帖子(<?php echo $count_content?>)
							回复(<?php echo $count_reply?>)
							会员(<?php echo $count_member?>)
							管理员(<?php echo $count_manage?>)
						</span>
					</li>
				</ul>
			</div>
			<br />
			<div class="result-content">
				<ul>
					<li>
						<label class="res-lab">服务器操作系统：</label><span class="res-info"><?php echo PHP_OS?></span>
					</li>
					<li>
						<label class="res-lab">服务器软件：</label><span class="res-info"><?php echo $_SERVER['SERVER_SOFTWARE']?></span>
					</li>
					<li>
						<label class="res-lab">MySQL 版本：</label><span class="res-info"><?php echo  mysqli_get_server_info($link)?></span>
					</li>
					<li>
						<label class="res-lab">最大上传文件：</label><span class="res-info"><?php echo ini_get('upload_max_filesize')?></span>
					</li>
					<li>
						<label class="res-lab">内存限制：</label><span class="res-info"><?php echo ini_get('memory_limit')?></span>
					</li>
					<li>
						<span class="res-info"><a target="_blank" href="phpinfo.php">PHP 配置信息</a></span>
					</li>
				</ul>
			</div>
			<br />
			<div class="result-content">
				<ul>
					<li>
						<label class="res-lab">程序安装位置(绝对路径)：</label><span class="res-info"><?php echo SA_PATH?></span>
					</li>
					<li>
						<label class="res-lab">程序在web根目录下的位置(首页的url地址)：</label><span class="res-info"><?php echo SUB_URL?></span>
					</li>
					<li>
						<label class="res-lab">程序版本：</label><span class="res-info">Qwzf V1.0 <a target="_blank" href="#">[查看最新版本]</a></span>
					</li>
					<li>
						<label class="res-lab">程序作者：</label><span class="res-info">Qwzf </span>
					</li>
				</ul>
            </div>
			<br />
        </div>
    </div>
    <!--/main-->
</div>
<?php
include_once 'inc/footer.inc.php';//footer
?>