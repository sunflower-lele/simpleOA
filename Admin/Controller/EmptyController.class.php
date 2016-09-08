<?php 
//命名空间
namespace Admin\Controller;
use Think\Controller;

//定义控制器并继承父类
class EmptyController extends Controller{
	//空操作方法
	public function _empty()
	{
		$this->display('Empty/error');
;	}
}


 ?>