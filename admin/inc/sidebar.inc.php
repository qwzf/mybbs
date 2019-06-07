<div class="container clearfix">
    <div class="sidebar-wrap">
        <div class="sidebar-title">
            <h1>菜单</h1>
        </div>
        <div class="sidebar-content">
            <ul class="sidebar-list">
                <li>
                    <a href="#"><i class="icon-font">&#xe018;</i>系统</a>
                    <ul class="sub-menu">
                        <li><a href="index.php"><i class="icon-font">&#xe017;</i>系统信息</a></li>
                        <li><a href="manage.php"><i class="icon-font">&#xe014;</i>管理员</a></li>
                        <li><a href="manage_add.php"><i class="icon-font">&#xe068;</i>添加管理员</a></li>
                        <li><a href="system.php"><i class="icon-font">&#xe002;</i>站点设置</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-font">&#xe009;</i>内容管理</a>
                    <ul class="sub-menu">
                        <li><a href="father_module.php"><i class="icon-font">&#xe006;</i>父版块列表</a></li>
                        <li><a href="father_module_add.php"><i class="icon-font">&#xe005;</i>添加父版块</a></li>
						<?php
						if(basename($_SERVER['SCRIPT_NAME'])=='father_module_update.php'){
							echo '<li><a href="#"><i class="icon-font">&#xe002;</i>编辑父板块</a></li>';
						}
						?>
                        <li><a href="son_module.php"><i class="icon-font">&#xe006;</i>子版块列表</a></li>
                        <li><a href="son_module_add.php"><i class="icon-font">&#xe005;</i>添加子版块</a></li>
						<?php
						if(basename($_SERVER['SCRIPT_NAME'])=='son_module_update.php'){
							echo '<li><a href="#"><i class="icon-font">&#xe002;</i>编辑子板块</a></li>';
						}
						?>
                        <li><a href="../index.php"><i class="icon-font">&#xe012;</i>帖子管理</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-font">&#xe003;</i>用户管理</a>
                    <ul class="sub-menu">
                        <li><a href="member_list.php"><i class="icon-font">&#xe041;</i>用户列表</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>