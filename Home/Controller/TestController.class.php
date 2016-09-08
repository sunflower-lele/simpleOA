<?php
namespace Home\Controller;
//引入父类控制器的类元素
use Think\Controller;
class TestController extends Controller{
	//默认方法
	public function index()
	{
		echo "后台控制器的方法";
	}

	//模板中格式化时间戳
	public function test7()
	{
		$time = time();
		// //传递给模板
		$this->assign('time',$time);
		// //定义字符串
		// // $str = 'ahahiubksg';
		// // //传递给模板
		// // $this->assign('str',$str);
		// //渲染模板
	    $this->display();
		// 一维数组的分配
		//echo "你好啊";
		// $arr1=array('window','apache','mysql','php');
		// //传递索引数组
		// $this->assign('arr1',$arr1);
		// //渲染模板
		// $this->display();
	}
}