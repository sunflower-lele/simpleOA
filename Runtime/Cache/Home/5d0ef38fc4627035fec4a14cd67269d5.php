<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-cn">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>test7</title>
	<meta name="keywords" content="关键字列表" />
	<meta name="description" content="网页描述" />
	<link rel="stylesheet" type="text/css" href="" />
	<style type="text/css"></style>
	<script type="text/javascript"></script>
</head>
<body>
	现在的时间是:<?php echo (date('Y-m-d H:i:s',$time)); ?><br>
	<!-- 转化并截取后的字符串是：<?php echo (substr(strtoupper($str),0,5)); ?> -->
	索引数组：<br/>
	<?php echo ($arr1[0]); ?>--<?php echo ($arr1[1]); ?>--<?php echo ($arr1[2]); ?>--<?php echo ($arr1[3]); ?>
</body>
</html>