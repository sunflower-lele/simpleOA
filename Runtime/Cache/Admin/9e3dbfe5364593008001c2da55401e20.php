<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="/Public/Admin/css/base.css" />
<link rel="stylesheet" href="/Public/Admin/css/info-mgt.css" />
<link rel="stylesheet" href="/Public/Admin/css/WdatePicker.css" />
<title>移动办公自动化系统</title>
<style type='text/css'>
	table tr .id{ width:63px; text-align: center;}
	table tr .name{ width:118px; padding-left:17px;}
	table tr .nickname{ width:63px; padding-left:17px;}
	table tr .dept_id{ width:63px; padding-left:13px;}
	table tr .sex{ width:63px; padding-left:13px;}
	table tr .birthday{ width:80px; padding-left:13px;}
	table tr .tel{ width:113px; padding-left:13px;}
	table tr .email{ width:160px; padding-left:13px;}
	table tr .addtime{ width:160px; padding-left:13px;}
	table tr .operate{ padding-left:13px;}
</style>
</head>

<body>
<div class="title"><h2>信息管理</h2></div>
<div class="table-operate ue-clear">
	<a href="javascript:;" id="btnadd" class="add">添加</a>
    <a href="javascript:;" id="btndel" class="del">删除</a>
    <a href="javascript:;" id="btnedit" class="edit">编辑</a>
    <a href="/index.php/Admin/User/charts" class="count">统计</a>
    <a href="javascript:;" class="check">审核</a>
</div>
<div class="table-box">
	<table>
    	<thead>
        	<tr>
            	<th class="id">序号</th>
                <th class="name">姓名</th>
				<th class="nickname">昵称</th>
                <th class="dept_id">所属部门</th>
				<th class="sex">性别</th>
				<th class="birthday">生日</th>
                <th class="tel">电话</th>
				<th class="email">邮箱</th>

                <th class="addtime">添加时间</th>
                <th class="operate">操作</th>
            </tr>
        </thead>
        <tbody>
        <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr>
            	<td class="id"><?php echo ($vol["id"]); ?></td>
                <td class="name"><?php echo ($vol["username"]); ?></td>
				<td class="nickname"><?php echo ($vol["nickname"]); ?></td>
                <td class="dept_id"><?php echo ($vol["deptName"]); ?></td>
                <td class="sex"><?php echo ($vol["sex"]); ?></td>
				<td class="birthday"><?php echo ($vol["birthday"]); ?></td>
				<td class="tel"><?php echo ($vol["tel"]); ?></td>
				<td class="email"><?php echo ($vol["email"]); ?></td>
                <td class="addtime"><?php echo (date('Y-m-d H:i:s',$vol["addtime"])); ?></td>
                <td class="operate">
                	<input type="checkbox" value="<?php echo ($vol["id"]); ?>"></input>
                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
</div>
<div class="pagination ue-clear">
	<div class="pagin-list">
		<?php echo ($show); ?>

	</div>
	<div class="pxofy">显示第 1 条到 10 条记录，总共<?php echo ($count); ?>条记录</div>
</div>
</body>
<script type="text/javascript" src="/Public/Admin/js/jquery.js"></script>
<script type="text/javascript" src="/Public/Admin/js/common.js"></script>
<script type="text/javascript" src="/Public/Admin/js/WdatePicker.js"></script>

<script type="text/javascript">
$(".select-title").on("click",function(){
	$(".select-list").hide();
	$(this).siblings($(".select-list")).show();
	return false;
})
$(".select-list").on("click","li",function(){
	var txt = $(this).text();
	$(this).parent($(".select-list")).siblings($(".select-title")).find("span").text(txt);
})

// $('.pagination').pagination(100,{
// 	callback: function(page){
// 		alert(page);	
// 	},
// 	display_msg: true,
// 	setPageNo: true
// });

$("tbody").find("tr:odd").css("backgroundColor","#eff6fa");

showRemind('input[type=text], textarea','placeholder');

//添加jQuery编辑事件
$(function() {
	//给编辑事件添加点击按钮
	$('#btnedit').on('click' , function() {
	//先获取需要编辑的id
	var id = $(':checkbox:checked').val();
	//跳转到编辑页面
	window.location.href = '/index.php/Admin/User/edit/id/' + id;
	});
	//给删除事件添加按钮
	$('#btndel').on('click' , function(){
		//获取删除的id值
		var id = $(':checkbox:checked');
		var ids = '';//输出1,2,3,4
		//循环遍历jQuery对象
		for(var i= 0; i<id.length;i++){
			ids = ids +id[i].value + ',';
		}
		//取出多余 的逗号
		ids = ids.substring(0 ,ids.length-1);
		//  跳转
		window.location.href = '/index.php/Admin/User/del/ids/' + ids;
	});

	//给添加按钮添加事件
	$('#btnadd').on('click' , function(){
		// 跳转添加页面
		window.location.href= '/index.php/Admin/User/add/';
	})

});
</script>
</html>