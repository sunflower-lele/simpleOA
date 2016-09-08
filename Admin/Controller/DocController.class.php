<?php
#命名空间
namespace Admin\Controller;
#定义并继承父类控制器
use Think\Controller;

class DocController extends CommonController{
	//公文添加
	public function add()
	{
		// 渲染模板
		$this->display();
	}
	//保存数据，addok方法
	public function addOk()
	{
		//接收数据
		$post = I('post.');
		//实例化模型
		$model = M('Doc');
		//添加时间
		$post['addtime'] = time();
		//实例化上传类
		$cfg = array(
			'rootPath' => WORKING_PATH . UPLOAD_ROOT_PATH
			);
		$upload = new \Think\Upload($cfg);
		//上传
		$info = $upload->uploadOne($_FILES['file']);
		//dump($upload->getError());die;
		//根据上传的结果，上传失败返回false
		if($info){
			//设置表中的filepath字段
			$post['filepath'] = UPLOAD_ROOT_PATH.$info['savepath'].$info['savename'];
			//设置表中的filename字段
			$post['filename'] = $info['savename'];
			//设置表中的hasfile字段
			$post['hasfile'] = 1;
			
		}
		//添加操作
		$rt = $model -> add($post);
		
		//判断
		if($rt) {
			//成功
			$this->success('恭喜你，数据添加成功' , U('showList'), 2);
		} else {
			//失败
			 $this->error('你又失败了', U('add') , 2);
		}
	}

	//公文的列表
	public function showList()
	{
		//实例化模型
		$model = M('Doc');
		//查询总的记录数
		$count = $model ->count();
		//实例化分页类，传递总的记录数和每页显示的条数
		$page = new \Think\Page($count,2);
		//定制分页信息
		$page ->setConfig('prev','上一页');
		$page ->setConfig('next','下一页');
		$page ->setConfig('first','首页');
		$page ->setConfig('last','末页');

		//将末页从数字的显示方式切换为汉字显示
		$page ->lastSuffix = false;
		//生成页码信息
		$show = $page->show();
		//使用limit查询
		$data = $model ->limit($page -> firstRow,$page->listRows) ->select();
		//获取数据
		//$data = $model -> select();
		// 传递给模板
		$this->assign('data' , $data);
		$this->assign('show',  $show);
		//渲染模板
		$this-> display();
	}

	//公文的删除
	public function del()
	{
		//接收要删除的ids
		$ids = I('get.ids');
		//实例化模型
		$model = M('Doc');
		//查询
		$rt = $model->delete($ids);
		//判断
		if($rt){
			//成功
			$this->success('恭喜你，数据删除成功',U('showList'),2);
		} else{
			//失败
			$this->error('你又失败了',U('showList'),2);
		}
	}

	// download方法，下载附件
	public function download()
	{
		//接收附件的id
		$id = I('get.id');
		// 实例化模型
		$model = M('Doc');
		//查询
		$data = $model->find($id);
		//拼凑文件的完整路径
		$file = WORKING_PATH.$data['filepath'];
		//将文件输出
		header("Content-type: application/octet-stream");//文件下载的数据流
		header('Content-Disposition: attachment; filename="' . basename($file) . '"');//文件下载的位置
		header("Content-Length: ". filesize($file));//文件的大小
		readfile($file);
	}
	
	//查看的公文的内容
	public function getContent()
	{
		//接收id
		$id = I('get.id');
		//实例化模型
		$model = M('Doc');
		//查询公文的信息
		$data = $model -> find($id);
		//输出
		echo htmlspecialchars_decode($data['content']);
	}

	//公文的编辑
	public function edit()
	{
		//接收需要编辑的id
		$id = I('get.id');
		//实例化模型
		$model = M('Doc');
		//查询
		$data  = $model ->find($id);
		//传递给模板
		$this->assign('data',$data);
		//渲染模板
		$this->display();
	}
	public function editOk()
	{
		//接收数据
		$post = I('post.');
		
		//判断是否有文件上传
		if($_FILES['file']['size'] > 0){
			//执行新文件的上传操作
			//配置上传
			$cf = array(
					//上传的保存目录
					'rootPath' => WORKING_PATH . UPLOAD_ROOT_PATH
				);
			//实例化上传类
			$upload = new \Think\Upload($cf);
			//上传操作
			$info = $upload -> uploadOne($_FILES['file']);
			//判断上传效果
			if($info){
				//上传成功需要进行的操作
				//filepath字段的更新
				$post['filepath'] = UPLOAD_ROOT_PATH.$info['savepath'].$info['savename'];
				//filename字段的更新
				$post['filename'] = $info['savename'];
				//hasfile字段的更新
				$post['hasfile'] = 1;
			} 
		}
		//实例化模型
		$model = M('Doc');
		//保存数据
		$rt = $model -> save($post);
		// 做出判断
		if($rt !== false){
			//成功
			$this->success('数据添加成功', U('showList'), 2);
		} else {
			//失败
			$this->error('数据添加失败', U('edit',array('id' => $post['id'])),2);
		}
	}
}


?>