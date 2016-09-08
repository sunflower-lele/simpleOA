<?php
namespace Admin\Controller;
//引入父类控制器的类元素
use Think\Controller;
class TestController extends Controller{
	//默认方法
	public function index()
	{
		echo "后台控制器的方法";
	}
	
	#使用普通方法实例化自定义的模型
	// public function test7()
	// {
	// 	$model1 = new \Admin\Model\DeptModel();
	// 	dump($model1);
	// } 

	#使用快速实例化方法
	public function test1()
	{
		#实例化
		$model = D('Dept');
		dump($model);
	}
	//增加数据操作
	public function test2()
	{
		//实例化模型
		$model = M('Dept');
		//定义数据
		$data = array(
				'name' => '总裁部',
				'pid' => '0',
				'sort' => 2,
				'remark' => '集团的技术部'
			);
		//添加操作
		$rst = $model -> add($data);
		//打印
		dump($rst);
	}
	//修改操作
	 public function test3()
	 {
	 	//实例化模型
	 	$model = M('Dept');
	 	//定义数据
	 	$data = array(
	 			'id' => 3,
	 			'name' => '会计部'
	 		);
	 	$rst = $model -> save($data);
	 	//打印返回值
	 	dump($rst);
	 }

	 //select查询
	 public function test4()
	 {
	 	//实例化模型
	 	 $model = M('Dept');
	 	 //查询全部
	 	 $data = $model -> select('1,4');
	 	 dump($data);
	 }

	 //删除操作
	 public function delete()
	 {
	 	//实例化模型
	 	$model = M('Dept');
	 	//可以删除指定id或者多个id
	 	$rst = $model -> delete('6');
	 	dump($rst);
	 }

	 //使用G方法统计代码的执行消耗时间
	  public function test5()
	  {
	  	//开启统计标记
	  	G('start');
	  	$a = 0;
	  	for($i =0;$i<1000000;$i++) {
	  		$a++;
	  	}
	  	//结束标记
	  	G('end');
	  	//输出统计结果
	  	echo G('start' ,'end',6).'s';
	  }

	  //使用AR模式往部门表中添加一行记录
	  public function test6()
	  {
	  	//实例化
	  	$model = D('Dept');
	  	//AR模式
	  	$model ->name = '公关部';
	  	$model ->pid  = '0';
	  	$model ->sort ='20';
	  	$model ->remark = '公关部，有要来的吗';
	  	//添加操作
	  	$rt = $model ->add();
	  	dump($rt);

	  }
	  
	  // 使用AR模式修改部门表中的记录id为*的信息
	  public function test7()
	  {
	  	//实例化
	  	 $model = D('Dept');
	  	 //AR模式开始
	  	 $model -> id ='2';
	  	 $model -> remark = '都是大牛';
	  	 //更新操作
	  	 $rt = $model -> save();
	  	 dump($rt);
	  }

	  //验证AR模式中存在AR模式的查询操作(没有作用)
	  public function test8()
	  {
	  	//实例化模型
	  	$model = D('Dept');
	  	//AR模式查询
	  	$model -> id ='7';
	  	//查询操作
	  	$rt = $model -> select();
	  	dump($rt);
	  }

	  //AR模式中的删除操作
	  public function test9()
	  {
	  	// 实例化模型
	  	$model = D('Dept');
	  	//AR模式中的删除操作
	  	$model->id='2';
	  	//删除操作
	  	$rt = $model ->delete();
	  	dump($rt);
	  }

	  public function test10()
	  {
	  	//实例胡模型
	  	$model = D('Dept');
	  	// 查询操作
	  	$model ->find(8);
	  	//删除操作
	  	$rt = $model->delete();
	  	dump($rt);
	  }

	  //按id升序排列
	  public function test11()
	  {
	  	//实例化模型
	  	$model = D('Dept');
	  	//升序排列
	  	$model ->order('id ASC');
	  	// 更新操作
	  	$rt = $model ->select();
	  	dump($rt);
	  }

	  public function test12()
	  {
	  	//实例化模型
	  	$model = D('Dept');
	  	$rt=$model -> max('id');	  
	  	dump($rt);
	  }

	  //使用group方法分组统计每个部门出现的次数
	  public function test13()
	  {
	  	//实例化模型
	  	$model = D('Dept');
	  	//指定查询的字段
	  	$model -> field('name,count(*) as count');
	  	//分组统计
	  	$model ->group('name');
	  	//查询
	  	 $rt = $model ->select();
	  	 dump($rt);
	  	//
	  }
	  //使用limit查询部门表中的第一条信息
	  public function test14()
	  {
	  	//实例化模型
	  	$model = D('Dept');
	  	//设置limit
	  	$model -> limit(1);
	  	//查询
	  	$rt = $model -> select();
	  	dump($rt);
	  }
	  //使用limit方法查询部门表中第一条记录往后的一条记录
	  public function test15()
	  {
	  	//实例化
	  	$model = D('Dept');
	  	//设置limit
	  	$model -> limit(1,3);
	  	//查询
	  	$rt = $model -> select();
	  	dump($rt);
	  }

	  //使用field方法查询部门表中id和那么字段的信息
	  public function test16()
	  {
	  	//实例化模型
	  	$model = D('Dept');
	  	//限制需要输出的字段名
	  	$model -> field('id,name');
	  	//查询
	  	$rt = $model ->select();
	  	dump($rt);
	  }
	  //使用连贯操作
	  public function test17()
	  {
	  	//实例化模型
	  	$model = D('Dept');

	  	//连贯操作的写法
	  	$rt = $model ->field('name, count(*) as count') -> group('name')->select();
	  	dump($rt);
	  }

	  //求出部门表中的总记录数
	  public function test18()
	  {
	  	$model = D('Dept');
	  	$rt = $model -> count();
	  	dump($rt);
	  }

	  //查出部门表中最大的id最大值
	  public function test19()
	  {
	  	$model = D('Dept');
	  	$rt = $model -> max('id');
	  	dump($rt);
	  }
	  //查出id和  sum方法
	   public function test20()
	  {
	  	$model = D('Dept');
	  	$rt = $model -> sum('id');
	  	dump($rt);
	  }

	  //id的平均值
	   public function test21()
	  {
	  	$model = D('Dept');
	  	$rt = $model -> avg('id');
	  	dump($rt);
	  }

	  //查出id的最小值
	  public function test22()
	  {
	  	//实例化模型
	  	$model = D('Dept');
	  	$rt = $model-> min('id');
	  	dump($rt);
	  }

	  // 使用自定义函数库中的自定义函数gbk2utf8
	  public function test23()
	  {
	  	//应用层级函数库中的自定义函数
	  	gbk2utf8();
	  }

	  //使用load_ext_file动态加载函数库文件
	  public function test24()
	  {
	  	//动态使用phpinfo.php中 的info函数
	  	info();
	  }

	  //使用load方法加载文件phptest.php
	  public function test25()
	  {
	  	//语法要求load（'@/filename'）
	  load('@/phptest');
	  //调用test25方法
	  test25();
	  }

	  //在thinkPHP中执行原生的sql语句，使用table多表连接查询
	  public function test26()
	  {
	  	//实例化模型
	  	$model = M();
	  	// 原生的sql语句
	  	$sql = "select t1.*,t2.name from tp_user as t1,tp_dept as t2 where t1.dept_id=t2.id;";
	  	//执行sql语句
	  	$rt=$model -> query($sql);
	  	//使用连表查询
	  	//$rt = $model -> field('t1.*,t2.name') ->table('tp_dept as t2, tp_user as t1') ->where('t1.dept_id=t2.id')->select();
	  	dump($rt);
	  }

	  public function test27()
	  {
	  	//实例化模型
	  	$model = M();
	  	// 原生的sql语句
	  	//$sql = "select t1.*,t2.name from tp_user as t1,tp_dept as t2 where t1.dept_id=t2.id;";
	  	//执行sql语句
	  	//$rt=$model -> query($sql);
	  	//使用连表查询
	  	$rt = $model -> field('t1.*,t2.name') ->table('tp_dept as t2, tp_user as t1') ->where('t1.dept_id=t2.id')->select();
	  	dump($rt);
	  }

	  //join多表连接查询
	  public function test28()
	  {
	  	//实例化模型
	  	$model = M('Dept');
	  	//原生的sql语句
	  	//$sql = "select t1.*,t2.name as dept_name from tp_dept as t1 left join tp_dept as t2 on t1.pid=t2.id";
	  	//$rt = $model->query($sql);
	  	//连贯操作写法
	  	$rt = $model ->alias('t1')
	  				->field('t1.*,t2.name as dept_name')
	  				->join('left join tp_dept as t2 on t1.pid=t2.id')
	  				->select();
	  	dump($rt);
	  }

	  //

}