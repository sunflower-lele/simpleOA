<?php 
namespace Admin\Controller;
use Think\Controller;

class KnowledgeController extends CommonController{

	//创建add方法
	public function add()
	{
		//渲染模板
		$this->display();
	}
	//创建addok方法
	public function addOk()
	{
		//接收数据
		$post = I('post.');
		//上传操作
		if($_FILES['thumb']['size'] > 0){
			#上传的处理
			#配置上传
			$cfg = array(
					'rootPath' => WORKING_PATH . UPLOAD_ROOT_PATH
				);
			#实例化上传类
			$upload = new \Think\Upload($cfg);
			#上传
			$info = $upload -> uploadOne($_FILES['thumb']);
			#判断返回结果
			if($info){
				#上传成功的处理
				#picture字段
				$post['picture'] = UPLOAD_ROOT_PATH . $info['savepath'] . $info['savename'];
				#生成缩略图
				#实例化图片处理类
				$img = new \Think\Image();
				#打开图片
				$pic = WORKING_PATH . $post['picture'];
				$img -> open($pic);
				#制作缩略图
				$img -> thumb(100,100);	//等比缩放原则2000x2500  100 125
				#保存图片
				$pos = WORKING_PATH . UPLOAD_ROOT_PATH . $info['savepath'] . 'thumb_' . $info['savename'];
				$img -> save($pos);
				#拼凑thumb字段的数据
				$post['thumb'] = UPLOAD_ROOT_PATH .$info['savepath'] . 'thumb_' . $info['savename'];
			}
		}
		//实例化模型
		$model = M('Knowledge');
		//添加时间
		$post['addtime'] = time();
		//添加操作
		$rt = $model -> add($post);
		//判断是否添加成功
		if($rt){
		//成功
		$this->success('数据添加成功',U('showList'),2);	
		} else {
			//失败
			$this->error('数据添加失败',U('add'),2);
		} 
	}

	//知识列表的实现
	public function showList()
	{
		//实例化模型
		$model = M('Knowledge');
		//添加分页信息
		//查询总的记录数
		$count = $model ->count();
		//引入分页类
		$page =new  \Think\Page($count , 2);
		//定制分页信息
		$page->setConfig('prev' , '上一页');
		$page->setConfig('next' , '下一页');
		$page->setConfig('last' , '末页');
		$page->setConfig('first', '首页');
		//将末页的信息变成数字
		$page->lastSuffix = false;
		//生成页码信息
		$show = $page->show();
		//使用limit查询
		$data = $model -> limit($page ->firstRow , $page ->listRows) ->select();
		//查询数据
		//$data = $model -> select();
		//展示模板
		$this->assign('data',$data);
		$this->assign('show' ,$show);
		//渲染模板
		$this->display();
	}

	//实现知识列表的删除
	public function del()
	{
		//获取需要删除的id
		$ids = I('get.ids');
		//实例化模型
		$model = M('Knowledge');
		// 删除操作
		$rt = $model -> delete($ids);
		//判断
		if($rt){
			// 删除成功
			$this->success('数据删除成功',U('showList'),2);
		} else{
			//删除失败
			$this->error('数据删除失败',U('showList'),2);
		}
	}

	//实现知识列表的编辑操作
	public function edit()
	{
		//获取需要编辑的id
		$id = I('get.id');
		//实例化模型
		$model = M('Knowledge');
		//查询
		$data = $model ->find($id);
		//变量的分配
		$this->assign('data',$data);
		//展示模板
		$this->display();

	}

	//editok方法，获取数据，图片上传以及制作缩略图
	public function editOk()
	{
		//获取数据
		$post = I('post.');
		//附件上传，制作缩略图
		if($_FILES['thumb']['size'] > 0){
			//配置
			$cf = array(
					'rootPath' => WORKING_PATH . UPLOAD_ROOT_PATH
				);
		// 传入配置数组，并且实例化上传类
		$upload =new  \Think\Upload($cf);
		//开始执行上传操作
		$info = $upload ->uploadOne($_FILES['thumb']);
		//判断上传结果
		if($info){
			//修改picture字段
			$post['picture'] = UPLOAD_ROOT_PATH.$info['savepath'].$info['savename']; 
			//制作缩略图
			$img = new \Think\Image();
			//打开一幅图片
			$path = WORKING_PATH .$post['picture'];
			$img ->open($path);
			//制作缩略图
			$img ->thumb(100,100);
			//保存图片
			$pic =WORKING_PATH.UPLOAD_ROOT_PATH.$info['savepath'].'thumb_'.$info['savename'];
			$img->save($pic);
			//设置thumb字段的值
			$post['thumb'] = UPLOAD_ROOT_PATH.$info['savepath'].'thumb_'.$info['savename'];
		}
		}
		//实例化模型
		//dump($post);die;
		$model = M('Knowledge');
		//查询
		$rt = $model ->save($post);
		//判断
		if($rt !== false){
			//成功
			$this->success('数据修改成功',U('showList') , 2);
		} else {
			$this->error('数据修改失败', U('edit', array('id' =>$post['id'])) , 2);
		}
	}
}


?>