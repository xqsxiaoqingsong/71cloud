<<<<<<< HEAD
<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:89:"D:\PHPTutorial\WWW\71cloud\PHP\public/../application/branchadmin\view\branchs\create.html";i:1541982889;}*/ ?>
=======
<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:89:"D:\PHPTutorial\WWW\71cloud\PHP\public/../application/branchadmin\view\branchs\create.html";i:1541574067;}*/ ?>
>>>>>>> 785d9aef838ee57f91184b4930cfeff4e8641118
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
    <script type="text/javascript" src="/static/admin/lib/html5shiv.js"></script>
<script type="text/javascript" src="/static/admin/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/static/admin/static/h-ui/css/H-ui.min.css" />

<!--[if IE 6]>
    <script type="text/javascript" src="/static/admin/lib/DD_belatedPNG_0.0.8a-min.js"></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>添加管理员 - 管理员管理 - H-ui.admin v3.1</title>
<meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
<article class="page-container">
     <form action="<?php echo url('save'); ?>"  class="form form-horizontal" id="form-admin-add" method="post">
	<div class="row cl">
               <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>上级支部：</label>
                <select name="pid" class="input-xlarge" onchange="getbBranchs($(this).val())">
                    <?php foreach($list as $v): if(($v['level'] > 0)): ?>
                            <option value="<?php echo $v['id']; ?>"><?php echo str_repeat('&nbsp;',$v['level']).$v['branchs_name']?></option>
                        <?php else: ?>
                            <option value="<?php echo $v['id']; ?>"><?php echo $v['branchs_name']; ?></option>
                    <?php endif; endforeach; ?>
                </select>
	</div>
		<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>党支部名称：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="" placeholder="" id="branchs_name" name="branchs_name">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>电话号码：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="" placeholder="" id="phone" name="phone">
		</div>
	</div>

	<div class="row cl">
<<<<<<< HEAD
		<label class="form-label col-xs-4 col-sm-3">权限功能角色：</label>
		<div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">
            <select class="select" name="roles_id" size="1">
                <option value="0">权限功能角色</option>
=======
		<label class="form-label col-xs-4 col-sm-3">角色id：</label>
		<div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">
            <select class="select" name="roles_id" size="1">
                <option value="0">支部角色</option>
>>>>>>> 785d9aef838ee57f91184b4930cfeff4e8641118
                    <?php foreach($data as $l): ?>
                    <option value="<?php echo $l['id']; ?>"><?php echo $l['roles_name']; ?></option>
                    <?php endforeach; ?>
            </select>
			</span> </div>
	</div>

	<div class="row cl">
		<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
			 <input name="" type="submit" class="btn btn-success radius size-L" value="&nbsp;提&nbsp;&nbsp;&nbsp;&nbsp;交&nbsp;">
		</div>
	</div>
	</form>
</article>






<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>