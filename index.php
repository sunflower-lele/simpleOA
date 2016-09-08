<?php
header("content-Type:text/html;charset=utf-8");
//
define('BUILD_DIR_SECURE',false);
//定义当前文件所在的工作目录
define('WORKING_PATH', str_replace('\\', '/', __DIR__));
//定义上传的根目录（相对站点的根目录）
define('UPLOAD_ROOT_PATH','/Public/Upload/');
// 开启调试模式 
define('APP_DEBUG', true);
include "./ThinkPHP/ThinkPHP.php";