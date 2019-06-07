<?php
header('Content-type:text/html;charset:utf-8');//设置编码
function vcode($width=120,$height=40,$fontSize=19,$countElement=4,$countPixel=100,$countLine=4){
header('Content-type:image/jpeg');//输出图像为jpeg时
$element=array('a','b','c','d','e','f','g','h','i','j','k','m','n','o','p','q','r','s','t','u','v','w','x','y','z','0','1','2','3','4','5','6','7','8','9');//字符串所包含字符
$string='';//初始化字符
for ($i=0;$i<$countElement;$i++){//字符串字符个数
	$string.=$element[rand(0,count($element)-1)];//每次在$element随机选择字符并赋给$string
}

$img=imagecreatetruecolor($width, $height);//创建图像

$colorBg=imagecolorallocate($img,rand(200,255),rand(200,255),rand(200,255));//背景颜色，RGB格式，且RGB在200到255随机
$colorBorder=imagecolorallocate($img,rand(200,255),rand(200,255),rand(200,255));//边框颜色，RGB格式，且RGB在200到255随机
$colorString=imagecolorallocate($img,rand(10,100),rand(10,100),rand(10,100));//字符串颜色，RGB格式，且RGB在10到100随机

imagefill($img,0,0,$colorBg);//区域填充
for($i=0;$i<$countPixel;$i++){//画了100个点，并在矩形里随机分布。点的颜色，RGB格式，且RGB在100到200随机
	imagesetpixel($img,rand(0,$width-1),rand(0,$height-1),imagecolorallocate($img,rand(100,200),rand(100,200),rand(100,200)));
}
for($i=0;$i<$countLine;$i++){//画了3条线
	imageline($img,rand(0,$width/2),rand(0,$height),rand($width/2,$width),rand(0,$height),imagecolorallocate($img,rand(100,200),rand(100,200),rand(100,200)));
}
//imagestring($img,5,0,0,'abcd',$colorString);//不太常用，一般用下面这种方式
imagettftext($img,$fontSize,rand(-5,5),rand(5,15),rand(30,35),$colorString,'font/Inkfree.ttf',$string);
//19是字体大小  rand(-5,5)是偏转角度从-5到5的随机角度  rand(5,15)和rand(30,35)是宽和高的范围  $colorString是字体颜色  'font/SketchyComic.ttf'是使用字体样式的路径  $string是字符串
imagejpeg($img);//输出图像
imagedestroy($img);//释放资源
return $string;
}
?>