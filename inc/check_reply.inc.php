<?php
if(mb_strlen($_POST['content'])<2){
	skip($_SERVER['REQUEST_URI'], 'onError.gif', '回复内容不得少于2个字符！');
}
?>