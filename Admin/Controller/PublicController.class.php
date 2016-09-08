<?php
namespace Admin\Controller;
//引入父类控制器的类元素
use Think\Controller;
class PublicController extends Controller{
	public function login()
	{
		//加载模板
		$this->display();
	}

	//生成验证码
	 public function captcha()
	 {
	 	//配置
	 	$cf = array(
	 		'fontSize'  =>  14,              // 验证码字体大小(px)
        	'useCurve'  =>  false,            // 是否画混淆曲线
        	'useNoise'  =>  false,  			// 是否添加杂点	
        	  
        	'length'    =>  4,               // 验证码位数
        	'fontttf'   =>  '4.ttf',   //验证码字体，不设置随机
	 		);

	 	// 实例化验证码
	 	$verify = new \Think\Verify($cf);

	 	//生成验证码
	 	$verify -> entry();
	 }

	 //index 方法实现用户的登录
	 
	 public function index()
	 {
	 	//要想实现登录，首先要判断验证码是否正确
	 	//接收post传过去的数据
		$post = I('post.');
		//实例化验证码	 
		$verify = new \Think\Verify();
		//验证
		$rt = $verify -> check($post['captcha']);
		//如果验证成功，下一步验证用户名和密码
		if($rt) {
			//实例化模型
			$model = M('user');

			//查询用户信息(连贯查询)
			$result = $model -> where(array('username' => $post['username'],'password' => $post['password'])) ->find();

			//用户的持久化登录
			if($result) {
				session('uid', $result['id']);
				session('uname', $result['username']);
				session('role_id', $result['role_id']);//用户组id
				$this->success('人品爆表，登录成功', U('Index/index'),2);
			} else {
				//登录失败
				$this->error('逼格太低，登录失败', U('login'),2);
			}

		} else {
			//验证码错误
			$this->error('验证码竟然都能写错，本神表示服了', U('login') , 2);
		}
		
	 }

	 // 退出事件
	 public function logout()
	 {
	 	//删除全部的session
	 	session(null);
	 	//跳转到登录页
	 	$this->success('退出成功~', U('login') , 2);
	 }
}