<?php 
namespace Admin\Controller;
use Think\Controller;
class EmailController extends Controller{
	//发送邮件
	public function send()
	{
		//实例化模型(列出收件人)
		$model = M('User');
		//查询
		$data = $model ->select();
		//变量分配
		$this->assign('data' , $data);
		//渲染模板
		$this->display();
	}
	//创建sendok方法
	public function sendOk()
	{
		//接收数据
		$post = I('post.');
		//处理上传，如果附近大小大于0，则表示有附件
		if($_FILES['file']['size']>0){
			//配置上传
			$cf = array(
					'rootPath' => WORKING_PATH . UPLOAD_ROOT_PATH
				);
		//实例化上传类
		$upload = new \Think\Upload($cf);
		//上传操作
		$info = $upload ->uploadOne($_FILES['file']);
		//判断上传结果
		if($info){
			//file字段处理
			$post['file'] = UPLOAD_ROOT_PATH . $info['savepath'].$info['savename'];
			//hasfile字段处理
			$post['hasfile'] = 1;
			//filename字段处理
			$post['filename'] = $info['savename'];
		}
	  }
	  //保存数据
	  $model = M('Email');
	  //补充数据表中的两个字段
	  //发件人的id
	  $post['from_id'] = session('uid');
	  //时间
	  $post['addtime'] = time();
	  //dump($post);die;
	  $rt = $model ->add($post);
	  //判断保存结果
	  if($rt){
	  	//保存成功
	  	$this->success('数据添加成功',U('sendbox') , 2);
	  } else {
	  	//保存失败
	  	$this->error('数据添加失败', U('send') , 2);
	  }

	}

	//发件箱
	public function sendbox()
	{
		//实例化模型
		$model = M('Email');
		//查询总的记录数
		// $count = $model ->count();
		// //引入分页类
		// $page = new \Think\Page($count ,2);
		// // 定制分页信息
		// $page ->setConfig('prev' , '第一页');
		// $page ->setConfig('next' ,'下一页');
		// $page ->setConfig('first', '首页');
		// $page ->setConfig('last' ,'末页');
		// //将末页由汉字转化为数字
		// $page ->lastSuffix = false;
		// //显示分页
		//  $show = $page ->show();
		//  //使用limit查询
		//  $data = $model ->limit($page ->firstRow, $page ->lastRows) ->select();
		//连表查询，用table
		$data = $model ->field('t1.*,t2.truename')
					->table('tp_email as t1,tp_user as t2')
					->where('t1.to_id=t2.id and from_id =' .session('uid'))
					->select();
		//变量分配
		$this->assign('data',$data);

		//$this->assign('show' ,$show);
		//渲染模板
		$this->display();
	}

	//download方法，文件下载
	 public function download()
	 {
	 	//获取邮件id
	 	$id = I('get.id');
	 	//实例化模型
	 	$model = M('Email');
	 	//查询
	 	 $data = $model -> find($id);
	 	 //组装file的完整路径
	 	 $file = WORKING_PATH . $data['file'];
	 	 // 定义header头
	 	 header("Content-type: application/octet-stream");
	 	 header('Content-Disposition:attachment; filename= "' . basename($file) . '"');
	 	 header("Content-Length:" . filesize($file));
	 	 //将文件输出缓冲区
	 	 readfile($file);
	 }

	//收件箱
	public function recbox()
	{
		// 实例化模型
		$model = M('Email');
		
		//从数据库里读取数据
		$data = $model -> field('t1.*,t2.truename')
					-> table('tp_email as t1,tp_user as t2')
					-> where('t1.from_id = t2.id and to_id = ' . session('uid'))
					-> select();
		//变量分配
		//dump($data);die;
		$this->assign('data' , $data);
		//渲染模板
		$this->display();
		
	}

	//查看内容
	public function getContent(){
		#获取get中的id信息
		$id = I('get.id');
		#实例化模型
		$model = M('Email');
		#查询邮件的信息
		$data = $model -> where("id = $id and to_id = " . session('uid')) -> find();
		if($data){
			$model -> save(array('id' => $id,'isread' => 1));
		}
		#输出邮件的内容
		echo $data['content'];
	}

	//站内未读数量
	public function getMesCount()
	{
		if(IS_AJAX){
			//实例化
			$model = M('Email');
			//查询未读数量
			$data = $model ->where("isread = 0 and to_id = " . session('uid')) -> count();
			echo $data;
		} else {
			echo 'Access Denied';
		}
	}
	//发件箱邮件的删除
	public function delete()
	{
		// 接收要删除的id
		$ids = I('get.ids');
		//实例化模型
		$model =M('Email');
		//保存数据
		$rt = $model ->delete($ids);
		//判断
		if($rt){
			//成功
			$this->success('数据删除成功',U('sendbox'),2);
		} else{
			$this->error('数据删除失败',U('sendbox') , 2);
		}
	}
}



 ?>