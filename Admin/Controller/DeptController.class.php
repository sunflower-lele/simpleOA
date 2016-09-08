<?php 
#命名空间
namespace Admin\Controller;
#定义并继承父类控制器
use Think\Controller;
class DeptController extends CommonController{
	#showList方法，展示部门列表
	public function getList()
	{
		//获取数据
		$model = M('Dept');//实例化模型
		//查询总的记录数
		$count = $model ->count();
		//引入分页类
		$page = new \Think\Page($count ,2);
		// 定制分页信息
		$page ->setConfig('prev' , '上一页');
		$page ->setConfig('next' ,'下一页');
		$page ->setConfig('first', '首页');
		$page ->setConfig('last' ,'末页');
		//将末页由汉字转化为数字
		$page ->lastSuffix = false;
		//显示分页
		 $show = $page ->show();
		 //使用limit查询
		 $data = $model ->limit($page ->firstRow, $page ->listRows) ->select();

		//查询数据
		//$data = $model -> select();
		//echo $model->getLastSql();//显示sql语句
		
		foreach ($data as $key => $value) {
			//二次查询，通过查询pid的值，获取其中的name字段
			$info = $model ->find($value['pid']);

			//获取name字段并存到data中去
			$data[$key]['parentName']= $info['name'];
		}

		//引入无限极分类的文件，使用load方法
		load('@/tree');
		//无限极分类
		$data = getTree($data);
		//给模板传递数据
		$this->assign('data',$data);
		$this->assign('show',$show);
		 //展示模板
		$this->display();
		
	}

	#add添加方法，添加数据
	public function add()
	{
		//读取出已经有的部门信息
		$model = D('Dept');
		//全部读取
		$rst = $model -> select();
		//变量的分配
		$this->assign('rst', $rst);
		#渲染模板
		$this->display();

	}

	#addOk添加成功的方法
	public function addOk()
	{
		//使用I方法接受数据
		$post = I('post.');
		//实例化模型
		$model = M('Dept');
		//保存数据
		$rst = $model -> add($post);
		// 判断返回值
		if($rst) {
			//添加成功
			$this->success('恭喜你，数据添加成功',U('getList'),2);
		} else {
			//添加失败
			$this->error('添加失败，你脑子不好使',U('add'),2);
		}
	}

	//getlist页面的删除功能
	public function del()
	{
		//接收要删除的id
		$ids = I('get.ids');
		//删除操作
		$model = D('Dept');
		$rst = $model -> delete($ids);// 类似于in语句
		//判断是否删除成功
		if($rst) {
			//删除成功
			$this->success('恭喜你，运气爆表，删除成功',U('getList'),2);
		} else {
			$this->error('删除失败，你真low',U('getList'),2);
		}
	}

	// 展示edit的模板
	public function edit()
	{
		//接收需要编辑的id
		$id = I('get.id');
		//实例化模型
		$model = D('Dept');
		//查询原来未编辑之前的数据
		$rst = $model -> find($id);
		//dump($rst);die;
		//传递给模板
		$this->assign('rst' , $rst);
		//查询出原来的部门
		$data = $model ->select();

		//传递给模板
		$this->assign('data',$data);

		//渲染模板
		$this->display();
	}

	//保存数据
	public function editOk()
	{
		//接受数据
		$post = I('post.');
		//实例化模型
		$model = D('Dept');
		$rst = $model -> save($post);
		//判断并返回结果
		if($rst !=false) {
			$this->success('修改成功啦',U('getList'),2);
		} else {
			$this->error('修改失败，猪头',U('edit',array('id'=>$post['id'])),2);
		}
	}
}

 ?>