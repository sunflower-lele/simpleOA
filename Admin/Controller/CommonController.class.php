<?php 
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller{
	public function _initialize()
	{
		//判断session是否存在
		$uid = session('uid');
		if(empty($uid)){
			//为空则表示没有登录，需要跳转到登录页面
			$url = U('Public/login');
			//通过Javascript实现
			$script = "<script>window.top.location.href='$url';</script>";
			echo $script;exit;
		}
		//RBAC权限判断
		$cname = strtolower(CONTROLLER_NAME);
		$aname = strtolower(ACTION_NAME);

		//控制器/*
		//控制器/方法
		//获取权限的数组
		$auths = C('RBAC_AUTHS');
		//获取用户的权限
		$roleid = session('role_id');
		//取出当前用户的权限
		$auth = $auths['auth' . $roleid];
		//判断权限
		if($roleid !=1){
			if(! in_array($cname . '/*' , $auth) && !in_array($cname .'/'.$aname, $auth)){
				$this->error('抱歉你没有权限' , U('Index/home'), 2);
			}
		}
	}
}


 ?>