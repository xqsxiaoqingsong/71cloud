<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:104:"D:\PHPTutorial\WWW\71cloud\PHP\public/../application/branchadmin\view\content\ContentNewClass\index.html";i:1541574067;}*/ ?>
﻿<!DOCTYPE HTML>
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
    <!--[if IE 6]>
    <script type="text/javascript" src="/static/admin/lib/DD_belatedPNG_0.0.8a-min.js"></script>
<script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
</head>
<title>分类列表</title>
<script type="text/javascript" src="/static/admin/lib/jquery/1.9.1/jquery.min.js"></script>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页1 <span class="c-gray en">&gt;</span> 分类管理 <span class="c-gray en">&gt;</span> 分类列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新"><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">

	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l">
		<!-- <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>  -->
		<a href="<?php echo Url('add'); ?>" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加分类</a></span> </div>
	<table class="table table-border table-bordered table-bg">
		<thead>
			<tr>
				<th scope="col" colspan="10">分类列表</th>
			</tr>
			<tr class="text-c">
				<th width="100"><input type="checkbox" name="" value="">&nbsp; 展示</th>
				<th>分类名称</th>
				<th width="200">操作</th>
			</tr>
		</thead>
		<tbody>
            <?php if(is_array($CompanyNewCate) || $CompanyNewCate instanceof \think\Collection || $CompanyNewCate instanceof \think\Paginator): $i = 0; $__LIST__ = $CompanyNewCate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?>
				<tr class="text-c">
                    <?php if(in_array($vo1['id'],$company)): ?>
					    <td><input type="checkbox" class="company" value="<?php echo $vo1['id']; ?>" checked="checked" name=""></td>
                    <?php else: ?>
					    <td><input type="checkbox" class="company" value="<?php echo $vo1['id']; ?>"  name=""></td>
                    <?php endif; ?>
					<td style="text-align: left;"><?php echo str_repeat( '----',$vo1['level']); ?><?php echo $vo1['name']; ?></td>
					<td class="td-manage">
                        <a title="编辑" href="<?php echo Url('NewCate/edit',array('id'=>$vo1['id'])); ?>" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
						<a title="删除" href="javascript:;" onclick="cate_del(this,'<?php echo $vo1['id']; ?>')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
					</td>
				</tr>
			<?php endforeach; endif; else: echo "" ;endif; if(is_array($NewCate) || $NewCate instanceof \think\Collection || $NewCate instanceof \think\Paginator): $i = 0; $__LIST__ = $NewCate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
				<tr class="text-c">
					<?php if(in_array($vo['id'],$admin)): ?>
					    <td><input type="checkbox" class="admin" value="<?php echo $vo['id']; ?>" checked="checked" name=""></td>
                    <?php else: ?>
					    <td><input type="checkbox" class="admin" value="<?php echo $vo['id']; ?>" name=""></td>
                    <?php endif; ?>
					<td style="text-align: left;"><?php echo str_repeat( '----',$vo['level']); ?><?php echo $vo['name']; ?></td>
					<td class="td-manage">
					</td>
				</tr>
			<?php endforeach; endif; else: echo "" ;endif; ?>
   
		</tbody>
	</table>
 
    <input class="btn radius btn-warning sub_btn" type="button" value="确认修改所选">
</div>


<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/static/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<!--<script type="text/javascript" src="/static/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>-->
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

/*分类-增加*/
function cate_add(title, url, w, h) {
    layer_show(title, url, w, h);
}

/*分类-编辑*/
function cate_edit(title, url, id, w, h) {
    layer_show(title, url + '?id=' + id, w, h);
}


/*删除*/
function cate_del(obj, id) {
    layer.confirm('确认删除吗？', function () {
        $.ajax({
            'url': "<?php echo Url('del'); ?>",
            'data': {id: id},
            'dataType': 'json',
            'type': 'post',
            success: function (msg) {
                if (msg.code == 1) {
                    $(obj).parent().parent().remove();
                    layer.msg(msg.msg, {icon: 1, time: 1000});
                } else {
                    layer.msg(msg.msg, {icon: 2, time: 1000});
                }
            }

        })

    });
}

/**
 * 企业选择自己公众号对应的资源
 */

$(".sub_btn").click(function () {
    var company_arr=[]
    var admin_arr =[]
    for(var i=0; i<$('.company').length; i++){
        if($('.company').eq(i).is(':checked')){
            company_arr.push($('.company').eq(i).val())
        }
    }
    for(var i=0; i<$('.admin').length; i++){
        if($('.admin').eq(i).is(':checked')){
            admin_arr.push($('.admin').eq(i).val())
        }
    }
    $.ajax({
        'url':"<?php echo Url('wechatcontent/resources'); ?>",
        'data':{admin:admin_arr,company:company_arr,type:"newcate"},//newcate 新闻分类字段
        'type':"post",
        success:function (msg) {
            if (msg.code == 1){
                layer.msg(msg.msg, {icon: 1, time: 1000});
            } else {
                layer.msg(msg.msg, {icon: 2, time: 1000});
            }
        }
    })

})


</script>
</body>
</html>