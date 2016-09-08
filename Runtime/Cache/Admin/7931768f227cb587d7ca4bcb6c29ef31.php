<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="/Public/Admin/css/base.css" />
<link rel="stylesheet" href="/Public/Admin/css/info-mgt.css" />
<link rel="stylesheet" href="/Public/Admin/css/WdatePicker.css" />
<title>移动办公自动化系统</title>
</head>

<body>
<div class="title"><h2>信息管理</h2></div>
<div class="table-operate ue-clear">
	<a href="javascript:;" id="btnadd" class="add">添加</a>
    <a href="javascript:;" id="btndel" class="del">删除</a>
    <a href="javascript:;" id="btnedit" class="edit">编辑</a>
    <a href="javascript:;" class="count">统计</a>
    <a href="javascript:;" class="check">审核</a>
</div>
<div class="table-box">
	<table>
    	<thead>
        	<tr>
            	<th class="num">序号</th>
                <th class="name">部门</th>
                <th class="process">所属部门</th>
                <th class="node">排序</th>
                <th class="time">备注</th>
                <th class="operate">操作</th>
            </tr>
        </thead>
        <tbody>
        <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr>
            	<td class="num"><?php echo ($vol[id]); ?></td>
               <td class="name"><?php echo (str_repeat('&emsp;',$vol["level"]*2)); echo ($vol["name"]); ?></td>
                <td class="process">
                <?php if($vol["pid"] == 0): ?>顶级部门
                <?php else: ?>
                <?php echo ($vol["parentName"]); endif; ?>
                </td>
                <td class="node"><?php echo ($vol["sort"]); ?></td>
                <td class="time"><?php echo ($vol["remark"]); ?></td>
                <td class="operate">
                <input type="checkbox" value="<?php echo ($vol["id"]); ?>"></input></td>

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
<!-- <script type="text/javascript" src="/Public/Admin/js/jquery.pagination.js"></script>
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

$('.pagination').pagination(100,{
    callback: function(page){
        alert(page);    
    },
    display_msg: true,
    setPageNo: true
});

$("tbody").find("tr:odd").css("backgroundColor","#eff6fa");

showRemind('input[type=text], textarea','placeholder'); -->
<script type="text/javascript">
//事件的jquery代码
$(function() {
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
        window.location.href = '/index.php/Admin/Dept/del/ids/' + ids;
    });

    //给编辑按钮添加事件
    $('#btnedit').on('click',function(){
        //获取复选框的值
        var id = $(':checkbox:checked').val();
        // 跳转
        window.location.href = '/index.php/Admin/Dept/edit/id/' + id;
    });
    //给添加按钮添加事件
    $('#btnadd').on('click',function(){
        //跳转
        window.location.href = '/index.php/Admin/Dept/add/';
    });
});
</script>
</html>