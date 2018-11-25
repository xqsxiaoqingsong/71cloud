<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:94:"D:\PHPTutorial\WWW\71cloud\PHP\public/../application/branchadmin\view\dangyuan\permission.html";i:1539929730;}*/ ?>
<style type="text/css">
	/* 分页部分的css代码 */
	.pagination li{list-style:none;float:left;margin-left:10px;
		padding:0 10px;
		background-color:#5a98de;
		border:1px solid #ccc;
		height:26px;
		line-height:26px;
		width:35px;
		text-align: center;
		cursor:pointer;color:#fff;
	}
	.pagination li a{color:white;padding: 0;line-height: inherit;border: none;}
	.pagination li a:hover{background-color: #5a98de;}
	.pagination li.active{background-color:white;color:gray;}
	.pagination li.disabled{background-color:white;color:gray;}
</style>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="/favicon.ico" >
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
<!--[if IE 6]>
<script type="text/javascript" src="/static/admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>管理员列表</title>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span>党员管理<span class="c-gray en">&gt;</span> 党员审批列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="text-c">
		<input type="text" class="input-text" style="width:250px" placeholder="输入管理员名称" id="" name="">
		<button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜用户</button>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20">
		<span class="l">
			<a href=""  class="btn btn-danger radius">
				<i class="Hui-iconfont">&#xe6e2;</i> 批量删除
			</a>
			<a href="<?php echo url('dangyuan/memberadd'); ?>"  class="btn btn-primary radius">
				<i class="Hui-iconfont">&#xe600;</i> 添加党员
			</a>
		</span>
		<span class="r">共有数据：<strong>1000</strong> 条</span>
	</div>
	<table class="table table-border table-bordered table-bg">
		<thead>
			<tr>
				<th scope="col" colspan="9">员工列表</th>
			</tr>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="40">ID</th>
				<th width="300">所属组织</th>
				<th width="200">党员姓名</th>
				<th width="100">党员职称</th>
				<th width="100">照片</th>
				<th width="150">审核状态</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($data as $v): ?>
				<tr class="text-c">
					<td><input type="checkbox" value="1" name=""></td>
					<td class="status"><?php echo $v['id']; ?></td>
					<td width="300"><?php echo $v['branchs_name']; ?></td>
					<td><?php echo $v['member_name']; ?></td>
					<td width="200"><?php echo $v['job_name']; ?></td>
					<td width="150"><img src="<?php echo $v['member_img']; ?>"></td>
					<td id="status<?php echo $v['id']; ?>"><?php echo $v['member_is']; ?></td>
					<td class="td-manage" rel="">
					<?php if(($v['member_is'] == '未审核')): ?>
                      <span id="btnpass" class="btn btn-primary radius" dangyuan_id = <?php echo $v['id']; ?>>通过</span>
                      <span id="btnnopass" class="btn btn-primary radius" dangyuan_id = <?php echo $v['id']; ?>>不通过</span>
					<?php endif; ?>
					<button class="btn btn-primary radius" onclick='editinfo(<?php echo $v['id']; ?>)' >编辑</button> 
					<button class="btn btn-primary radius" id="delete"  dangyuan_id=<?php echo $v['id']; ?> >删除</button> 
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>

<!--page页码显示位置-->
<div>
	<?php echo $data->render(); ?>
</div>

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/static/admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/static/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/static/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/static/admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
/*
	参数解释：
	title	标题
	url		请求的url
	id		需要操作的数据id
	w		弹出层宽度（缺省调默认值）
	h		弹出层高度（缺省调默认值）
*/
/*管理员-增加*/
function admin_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*/!*管理员-删除*!/
function admin_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){

		$.ajax({
			type: 'POST',
			url: "<?php echo Url('admin/admindel'); ?>",
			dataType: 'json',
			success: function(data){
				$(obj).parents("tr").remove();
				layer.msg('已删除!',{icon:1,time:1000});
			},
			error:function(data) {
				console.log(data.msg);
			},
		});		
	});
}*/

/*管理员-编辑*/
function admin_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*管理员-停用*/
function admin_stop(obj,id){
	layer.confirm('确认要停用吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		$.ajax({
					type:"post",
					url:"<?php echo Url('admin/statu'); ?>",
					data:{id:id,status:0,},
					dataType:'json',
					success:function(msg){
						if(msg.error==1){
							alert("停用失败")
						}else{
								$(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_start(this,'+id+')" href="javascript:;" title="启用" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>');
								$(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">已禁用</span>');
								$(obj).remove();
								layer.msg('已停用!',{icon: 5,time:1000});
						}
					}
				})

	});
}

/*管理员-启用*/
function admin_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……


		$.ajax({
            type:"post",
            url:"<?php echo Url('admin/status'); ?>",
            data:{id:id,status:1,},
            dataType:'json',
            success:function(msg){
                if(msg.error==1){
                    alert("启用失败")
                }else{
                    $(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_stop(this,'+id+')" href="javascript:;" title="停用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
                    $(obj).remove();
                    layer.msg('已启用!', {icon: 6,time:1000});
                }
            }
		})
	});
}



// 党员信息编辑模块
function editinfo(id){
	location.href ='<?php echo url("edit"); ?>?id=' + id;
}


$(function(){
	$('tr').find('td:nth-child(8)').find('#btnpass').click(function(){
		// console.log($(this).attr('dangyuan_id')); // 获取对应的党员id
		var id = $(this).attr('dangyuan_id');
		var that = this;
		$.ajax({
		type:'post',
		url:'<?php echo Url("Dangyuan/status"); ?>',
		data:{id:id,member_is:1},
		dataType:'json',
		success:function(msg){
			if (msg.code == 1) {
				$('#status'+id).html('通过');
				$(that).closest('td').find('span').remove();
				return true;
			}
			alert('请求失败');
			}
		})
	})
})

$(function(){
	$('tr').find('td:nth-child(8)').find('#btnnopass').click(function(){
		// console.log($(this).attr('dangyuan_id')); // 获取对应的党员id
		var id = $(this).attr('dangyuan_id');
		var that = this;
		$.ajax({
		type:'post',
		url:'<?php echo Url("Dangyuan/status"); ?>',
		data:{id:id,member_is:2},
		dataType:'json',
		success:function(msg){
			if (msg.code == 1) {
				$('#status'+id).html('未通过');
				$(that).closest('tr').find('span').remove();
				return true;
			}
			alert('请求失败');
			}
		})
	})
})


$(function(){
    $('tr').find('td:nth-child(8)').find('#delete').click(function(){
        // console.log($(this).attr('dangyuan_id'));
		if(window.confirm("确认要删除吗？"))
		{
		    var dangyuan_id = $(this).attr('dangyuan_id');
		    var data = {id:dangyuan_id};
		    var that = this;
		    $.ajax({
				url:'<?php echo url("delete"); ?>',
				type:'post',
				dataType:"json",
				data:data,
				success:function(res){
                    if (res.msg == 'success')
					{
					    $(that).closest('tr').remove();
					    alert("党员删除成功！");
					}
				}
			})
		}else{
		    console.log("您点击了取消！");
		}
	})
})


</script>
</body>
</html>