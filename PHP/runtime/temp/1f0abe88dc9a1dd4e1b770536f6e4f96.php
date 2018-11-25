<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:91:"D:\PHPTutorial\WWW\71cloud\PHP\public/../application/branchadmin\view\examrecord\index.html";i:1542588877;}*/ ?>
﻿
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
	<meta http-equiv="Cache-Control" content="no-siteapp" />
	<link rel="Bookmark" href="/favicon.ico">
	<link rel="Shortcut Icon" href="/favicon.ico" />
	<!--[if lt IE 9]>
	<script type="text/javascript" src="/static/admin/lib/html5shiv.js"></script>
	<script type="text/javascript" src="/static/admin/lib/respond.min.js"></script>
	<![endif]-->
	<link rel="stylesheet" type="text/css" href="/static/admin/static/h-ui/css/H-ui.min.css" />
	<link rel="stylesheet" type="text/css" href="/static/admin/static/h-ui.admin/css/H-ui.admin.css" />
	<link rel="stylesheet" type="text/css" href="/static/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
	<link rel="stylesheet" type="text/css" href="/static/admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
	<link rel="stylesheet" type="text/css" href="/static/admin/static/h-ui.admin/css/style.css" />
	<link rel="stylesheet" href="/static/admin/lib/zTree/v3/css/zTreeStyle/zTreeStyle.css" type="text/css">
	<script  src="/static/admin/lib/jquery/1.9.1/jquery.min.js"></script>
	<!--[if IE 6]>
	<script type="text/javascript" src="/static/admin/lib/DD_belatedPNG_0.0.8a-min.js"></script>
	<script>DD_belatedPNG.fix('*');</script>
	<![endif]-->
	<title>考试记录</title>
</head>


<body class="pos-r">

<div>
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 题目管理 <span class="c-gray en">&gt;</span> 题目分类 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
	<div class="page-container">

		<div class="text-c">
			<form action="<?php echo Url('index'); ?>" method="get">

				<input type="text" name="exampaper_name" id="" placeholder=" 题目分类" style="width:250px" value="<?php echo \think\Request::instance()->get('exampaper_name'); ?>" class="input-text">

				<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜分类名称</button>
			</form>
		</div>
		<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l">
			<a class="btn btn-primary radius"   href="<?php echo Url('add'); ?>"><i class="Hui-iconfont">&#xe600;</i> 添加分类</a></span> <span class="r">共有数据：<strong><?php echo $count; ?></strong> 条</span> </div>
		<div class="mt-20">
			<table class="table table-border table-bordered table-bg table-hover table-sort">
				<thead>
					<tr class="text-c">
						<th width="40"><input name="" type="checkbox" value=""></th>
						<th width="40">ID</th>
						<th width="40">用户名称</th>
						<th width="100">活动名称</th>
						<th width="100">关卡名称</th>
						<th width="50">考试得分</th>
						<th width="50">满分</th>
						<th width="50">及格分数</th>
						<th width="50">题目数量</th>
						<th width="50">答对题数</th>
						<th width="50">答题用时</th>
						<th width="50">答题时间</th>
						<th width="100">操作</th>
					</tr>
				</thead>
				<tbody>
					<?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$v): ?>
						<tr class="text-c va-m">
							<td><input name="" type="checkbox" value=""></td>
							<td class="status"><?php echo $v['id']; ?></td>
							<td class="text-l"><?php echo $v['username']; ?></td>
							<td><?php echo $v['exam_activity_name']; ?></td>
							<td><?php echo $v['exampaper_name']; ?></td>
							<td><?php echo $v['result_score']; ?></td>
							<td><?php echo $v['score']; ?></td>
							<td><?php echo $v['pass_score']; ?></td>
							<td><?php echo $v['exam_questions_num']; ?></td>
							<td><?php echo $v['right_num']; ?></td>
							<td><?php echo $v['use_time']; ?></td>
							<td><?php echo date("Y-m-d,H:i:s",$v['create_time']); ?></td>
							<td class="td-manage"><a style="text-decoration:none" class="ml-5"  href="<?php echo Url('Examcate/edit',array('id'=>$v['id'])); ?>" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>
								<a style="text-decoration:none" class="ml-5" onclick="del(this,'$v.id')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
						</tr>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>



<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/static/admin/lib/zTree/v3/js/jquery.ztree.all-3.5.min.js"></script>
<script type="text/javascript" src="/static/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/static/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/static/admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript" src="/static/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript">

//分页排序搜索
$('.table-sort').dataTable({
	"aaSorting": [[ 1, "desc" ]],//默认第几个排序
	"bStateSave": true,//状态保存
	"aoColumnDefs": [
	  {"orderable":false,"aTargets":[0,2,3,8]}// 制定列不参与排序
	]
});
/*添加*/
function add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}

/*编辑*/
function edit(title,url,id){
    var index = layer.open({
        type: 2,
        title: title,
        content: url+'?id='+id
    });
    layer.full(index);
}


/*推荐*/
function recommend(obj,id){
	layer.confirm('确认推荐吗？',function(){
		$.ajax({
			'url' 		: "<?php echo Url('recommend'); ?>",
			'data' 		: {id:id},
			'dataType'	: 'json',
			'type' 		: 'post',
			success		: function (msg) {
			    if(msg.code == 1){
                    $(obj).parent('td').html('<span class="btn  btn-danger radius size-MINI" onclick="cancel_recommend(this,{id})" >取消推荐</span>');
                    layer.msg(msg.msg,{icon: 1,time:1000});
                    window.location.reload();
				}else{
                    layer.msg(msg.msg,{icon: 2,time:1000});
                    window.location.reload();
				}
            }

		})

	});
}

/*取消推荐*/
function cancel_recommend(obj,id){
	layer.confirm('确认取消推荐吗？',function(){
		$.ajax({
			'url' 		: "<?php echo Url('cancel_recommend'); ?>",
		    'data'		: {id:id},
			'dataType'  : 'json',
			'type' 		: 'post',
			success		: function (msg) {
				if(msg.code == 1){
					$(obj).parents("td").html('<span class="btn  btn-success radius size-MINI" onclick="recommend(this,{id})">推荐</span>');
					layer.msg(msg.msg,{icon: 1,time:1000});
                    window.location.reload();
				}else{
                    layer.msg(msg.msg,{icon: 2,time:1000});
                    window.location.reload();
				}
			}

		})

	});
}

/*删除*/
function del(obj,id){
    layer.confirm('确认删除吗？',function(){
        $.ajax({
            'url' 		: "<?php echo Url('del'); ?>",
            'data'		: {id:id},
            'dataType'  : 'json',
            'type' 		: 'post',
            success		: function (msg) {
                if(msg.code == 1){
                    $(obj).parent().parent().remove();
                    layer.msg(msg.msg,{icon: 1,time:1000});
                }else{
                    layer.msg(msg.msg,{icon: 2,time:1000});
                }
            }

        })

    });
}




</script>
</body>
</html>