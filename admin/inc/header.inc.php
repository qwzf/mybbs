<?php
$query="select * from info where id=1";
$result_info=execute($link, $query);
$data_info=mysqli_fetch_assoc($result_info);
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $template['title'] ?> - <?php echo $data_info['title']?></title>
	<meta name="keywords" content="<?php echo $data_info['keywords']?>" />
	<meta name="description" content="<?php echo $data_info['description']?>" />
    <link rel="stylesheet" type="text/css" href="css/common.css"/>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
</head>
<body>
<div class="topbar-wrap white">
    <div class="topbar-inner clearfix">
        <div class="topbar-logo-wrap clearfix">
            <h1 class="topbar-logo none"><a href="index.html" class="navbar-brand">后台管理</a></h1>
            <ul class="navbar-list clearfix">
                <li><a class="on" href="login.html">后台首页</a></li>
                <li><a href="../index.php" target="_blank">网站首页</a></li>
            </ul>
        </div>
        <div class="top-info-wrap">
            <ul class="top-info-list clearfix">
                <li>管理员<?php echo $_SESSION['manage']['username']?></li>
                <li><a href="logout.php">注销</a></li>
            </ul>
        </div>
    </div>
</div>