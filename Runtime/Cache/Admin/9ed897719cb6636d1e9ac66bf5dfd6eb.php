<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="/Public/Admin/css/base.css" />
<link rel="stylesheet" href="/Public/Admin/css/info-reg.css" />
<title>移动办公自动化系统</title>
</head>

<body>
<div class="title"><h2>信息登记</h2></div>
<form action="/index.php/Admin/Dept/editOk" method="post">
	<div class="main">
	    <p class="short-input ue-clear">
	    	<label>部门名称：</label>
	        <input type="text" name="name" value="<?php echo ($rst["name"]); ?>" placeholder="部门名称" />
	        <input type="hidden" name="id" value="<?php echo ($rst["id"]); ?>"></input>
	    </p>
	    <div class="short-input select ue-clear">
	    	<label>上级部门：</label>
	        <div class="select-wrap">
	        	<select name="pid">
	                <option value="0">顶级部门</option>
	                <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol["id"]); ?>" <?php if($vol['id']==$rst['pid']): ?>selected='selected'<?php endif; ?>><?php echo ($vol["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
	            </select>
	        </div>
	    </div>
	    <p class="short-input ue-clear">
	    	<label>排序：</label>
	        <input type="text" name="sort" value="<?php echo ($rst["sort"]); ?>" placeholder="排序" />
	    </p>
	    <p class="short-input ue-clear">
	    	<label>备注：</label>
	        <textarea placeholder="备注" name="remark"><?php echo ($rst["remark"]); ?></textarea>
	    </p>
	</div>
	<div class="btn ue-clear">
		<a href="javascript:;" id="btnsubmit" class="confirm">确定</a>
	    <a href="javascript:;" id="btncancel" class="clear">清空内容</a>
	</div>
</form>
</body>
<script type="text/javascript" src="/Public/Admin/js/jquery.js"></script>
<script type="text/javascript" src="/Public/Admin/js/common.js"></script>
<script type="text/javascript" src="/Public/Admin/js/WdatePicker.js"></script>
<script type="text/javascript">
$(".select-title").on("click",function(){
	$(".select-list").toggle();
	return false;
});
$(".select-list").on("click","li",function(){
	var txt = $(this).text();
	$(".select-title").find("span").text(txt);
});


showRemind('input[type=text], textarea','placeholder');
//jQuery事件
$(function(){
	//给确定按钮添加点击事件
	$('#btnsubmit').on('click',function(){
		//提交表单
		$('form').submit();
	});
	//给取消按钮添加事件
	$('#btncancel').on('click',function(){
		//还原表单
		$('form')[0].reset();
	})
})
</script>
</html>