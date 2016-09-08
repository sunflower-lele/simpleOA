<?php 
//声明命名空间
namespace Admin\Controller;
//引入父类控制器的类元素
use Think\Controller;

class UserController extends CommonController {

	// 定义add方法,展示职员添加的模板，并显示出部门信息
	public function add()
	{
		//实例化模型
		$model = M('Dept');
		//查询部门信息
		$data = $model -> select();
		//引入无限极分类的文件
		load('@/tree');
		$data =getTree($data);
		//变量分配
		$this->assign('data', $data);
		//展示模板
		$this->display();
	}
	//编写addok的方法，用于保存添加后的数据
	public function addOk()
	{
		//接受数据
		$post = I('post.');
		//实例化模型
		$model = M('User');
		//添加时间
		$post['addtime'] = time();
		$rt = $model -> add($post);
		if($rt) {
			//添加成功
			$this->success('太棒啦，添加成功',U('showList') ,2);
		} else {
			// 添加失败
			$this->error('你是猪头吗，失败喽',U('add') ,2);
		}
	}
	//显示showlist页面
	public function showList()
	{
		//实例化模型
		$model = M('User');
		//查询总的记录数
		$count = $model ->count();
		//实例化分页类，传递总的记录数和每页显示的条数
		$page = new \Think\Page($count,2);//每页显示两条
		// 定制分页信息
		$page->setConfig('prev', '上一页');
		$page->setConfig('next' , '下一页');
		$page->setConfig('first' ,'首页');
		$page->setConfig('last' , '末页');
		//将末页从数字的显示方式切换成汉字显示
		$page->lastSuffix = false;

		// 生成页码等信息
		$show = $page->show();

		//核心步骤,使用limit查询
		$data = $model -> limit($page -> firstRow , $page -> listRows) -> select();
		//查询,此处只能做出职员的信息
		// $data = $model -> select();
		//连表查询出部门的信息
		$dept = M('Dept');
		foreach ($data as $key => $value) {
			//关联部门表
			$info = $dept->find($value['dept_id']);
			$data[$key]['deptName'] = $info['name'];
		}
		//展示数据
		$this->assign('data' , $data);
		$this->assign('show' , $show);
		//渲染模板
		$this->display();
	}

	//编辑列表页
	public function edit()
	{
		//获取需要编辑的id
		$id = I('get.id');
		//实例化模型
		$model = M('User');
		$dept = M('Dept');
		//查询之前职员的数据
		$data = $model -> find($id);
		//查询部门的信息
		$depts = $dept -> select();
		//传递给模板
		$this->assign('data' , $data);
		$this->assign('depts', $depts);

		//渲染模板
		$this->display();

	}

	// 编辑editOk事件
	public function editOk()
	{
		//接收数据
		$post = I('post.');
		//实例化模型
		$model = M('User');
		//判断密码是否为空
		if($post['password']==''){
			unset($post['password']);
		}
		//保存修改后的结果
		$rt = $model ->save($post);
		//判断是否修改成功
		if($rt!==false) {
			$this->success('棒棒哒,修改成功', U('showList') , 2);
		} else {
			$this->error('大锤，又失败喽', U('edit' , array('id' =>$post['id'])), 2);
		}

	}

	//编写删除的方法
	public function del()
	{
		//接收要删除的ids
		$ids = I('get.ids');
		//实例化模型
		$model = M('User');
		//删除选中的用户信息
		$rt = $model -> delete($ids);
		//做出是否删除的判断
		if($rt){
			$this->success('恭喜你，删除成功' , U('showList') , 2);
		} else {
			$this->error('猪头，删除失败' , U('showList') , 2);
		}
	}

	//查询每个部门有多少人
	public function charts()
	{
		//实例化模型
		$model = M();

		//组装sql语句
		$sql = "select t1.name as dept_name,count(t2.id)as count from tp_dept as t1 left join tp_user as t2 on t1.id=t2.dept_id group by dept_name having count>0;";
		//执行sql语句
		$data = $model -> query($sql);
		//dump($data);die;
		// 拼凑数据
		$str = '[';
		foreach($data as $key => $value) {
			$str.="['".$value['dept_name']."',".$value['count']."],";
		}

		//取出最后一个多余的逗号
		$str = rtrim($str , ',');
		//连上最后一个中括号
		$str.=']';
		//变量的分配
		$this->assign('str',$str);
		//展示模板
		$this->display();
	}
}

