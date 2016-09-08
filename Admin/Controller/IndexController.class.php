<?php 
//声明命名空间
namespace Admin\Controller;
//引入父类控制器的类元素
use Think\Controller;

class IndexController extends Controller {

	// 定义index方法
	public function index()
	{
		//展示模板
		$this->display();
	}
	//前台的显示
	public function home()
	{
		$this->display();
	}
	//空操作
	public function _empty()
	{
		echo ACTION_NAME . '<br/>';
		echo '非法操作';
	}
}

