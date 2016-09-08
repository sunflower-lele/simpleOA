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
<div class="title"><h2>邮件管理</h2></div>
<div class="table-operate ue-clear">
	<a href="/index.php/Admin/Email/send" class="add">添加</a>
    <a href="javascript:;" id="btndel" class="del">删除</a>
    <a href="javascript:;" class="edit">编辑</a>
    <a href="javascript:;" class="check">审核</a>
</div>
<div class="table-box">
	<table>
    	<thead>
        	<tr>
            	<th class="id">序号</th>
                <th class="name">收件人</th>
				<th class="name">标题</th>
                <th class="file">附件</th>
                <th class="content">内容</th>
				<th class="addtime">发送时间</th>
                <th class="status">状态</th>
                <th class="operate">操作</th>
            </tr>
        </thead>
        <tbody>
          <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr>
            	<td class="id"><?php echo ($vol["id"]); ?></td>
                <td class="name"><?php echo ($vol["truename"]); ?></td>
                <td class="name"><?php echo ($vol["title"]); ?></td>
				<td class="file"><?php echo ($vol["filename"]); if($vol["hasfile"] == 1): ?>【<a href='javascript:;' class="download" data="<?php echo ($vol["id"]); ?>">下载</a>】<?php endif; ?></td>
                <td class="content"><?php echo (msubstr($vol["content"],0,20)); ?></td>
                <td class="addtime"><?php echo (date('Y-m-d H:i:s',$vol["addtime"])); ?></td>
                <td class="status">
                    <?php if($vol.isread==0): ?><span style="color:red">未读</span>
                        <?php else: ?>
                        <span style="color:green">已读</span><?php endif; ?>
                </td>
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
	<div class="pxofy">共 <?php echo ($count); ?> 条记录</div>
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

$("tbody").find("tr:odd").css("backgroundColor","#eff6fa");

showRemind('input[type=text], textarea','placeholder');

//jQuery代码实现下载
$(function(){ 
    //给下载按钮添加点击事件
    $('.download').on('click',function(){
        //事件的处理程序
        var id= $(this).attr('data');
        //跳转到下载页面
        window.location.href = '/index.php/Admin/Email/download/id/' + id;
    });

    //给删除按钮添加点击事件
     $('#btndel').on('click',function(){
        //获取复选框的id值
        var id = $(':checkbox:checked');//jquery对象，类数组的对象
        var ids = '';//要求IDS的形式是12345
        for(var i=0; i< id.length;i++) {
            ids = ids +id[i].value + ',';
        }
        //删除右边的逗号(还可以用rtrim)
        ids = ids.substring(0,ids.length-1);
        //跳转
        window.location.href = '/index.php/Admin/Email/delete/ids/' + ids;
    });

});
</script>
</html>