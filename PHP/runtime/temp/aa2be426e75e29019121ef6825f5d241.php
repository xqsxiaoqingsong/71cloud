<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:80:"D:\PHPTutorial\WWW\71cloud\PHP\public/../application/admin\view\index\index.html";i:1542856851;s:65:"D:\PHPTutorial\WWW\71cloud\PHP\application\admin\view\layout.html";i:1539913150;s:72:"D:\PHPTutorial\WWW\71cloud\PHP\application\admin\view\public\header.html";i:1541574066;s:72:"D:\PHPTutorial\WWW\71cloud\PHP\application\admin\view\public\footer.html";i:1541387770;}*/ ?>
<!DOCTYPE HTML>
<html>
<head>
    <title>七一云党建</title>
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
    <link rel="stylesheet" type="text/css" href="/static/admin/lib/valid/css/style.css"/>
    <script  src="/static/admin/lib/jquery/1.9.1/jquery.min.js"></script>
    <!--[if IE 6]>
    <script type="text/javascript" src="/static/admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script type="text/javascript" src="/static/admin/lib/jquery-1.11.3.min.js" ></script>
    <script type="text/javascript" src="/static/admin/lib/ueditor/1.4.3/ueditor.config.js" ></script>
    <script type="text/javascript" src="/static/admin/lib/ueditor/1.4.3/ueditor.all.js" ></script>
    <script type="text/javascript" src="/static/admin/lib/valid/js/Validform_v5.3.2_min.js"></script>

    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
</head>
﻿<!--<script  src="/static/admin/lib/jquery/1.9.1/jquery.min.js"></script>-->
<body>
<header class="navbar-wrapper">
	<div class="navbar navbar-fixed-top">
		<div class="container-fluid cl">
			<a class="logo navbar-logo f-l mr-10 hidden-xs" href="<?php echo Url('index/index'); ?>">七一云党建</a>
			<a class="logo navbar-logo-m f-l mr-10 visible-xs" href="/aboutHui.html"></a>
			<span class="logo navbar-slogan f-l mr-10 hidden-xs"></span>
			<a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:;">&#xe667;</a>
			<!--<nav class="nav navbar-nav">
				<ul class="cl">
					<li class="dropDown dropDown_hover"><a href="javascript:;" class="dropDown_A"><i class="Hui-iconfont">&#xe600;</i> 新增 <i class="Hui-iconfont">&#xe6d5;</i></a>
						<ul class="dropDown-menu menu radius box-shadow">
							<li><a href="javascript:;" onclick="article_add('添加资讯','article-add.html')"><i class="Hui-iconfont">&#xe616;</i> 资讯</a></li>
							<li><a href="javascript:;" onclick="picture_add('添加资讯','picture-add.html')"><i class="Hui-iconfont">&#xe613;</i> 图片</a></li>
							<li><a href="javascript:;" onclick="product_add('添加资讯','product-add.html')"><i class="Hui-iconfont">&#xe620;</i> 产品</a></li>
							<li><a href="javascript:;" onclick="member_add('添加用户','member-add.html','','510')"><i class="Hui-iconfont">&#xe60d;</i> 用户</a></li>
						</ul>
				</li>
			</ul>
		</nav>-->
		<nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
			<ul class="cl">
				<li>超级管理员</li>
				<li class="dropDown dropDown_hover">
					<a href="#" class="dropDown_A"><?php echo input('session.admin.username'); ?><i class="Hui-iconfont">&#xe6d5;</i></a>
					<ul class="dropDown-menu menu radius box-shadow">
						<!--<li><a href="javascript:;" onClick="myselfinfo()">个人信息</a></li>
						<li><a href="#">切换账户</a></li>-->
						<li><a href="<?php echo Url('login/loginout'); ?>">退出</a></li>
					</ul>
				</li>
				<li id="Hui-msg"> <a href="<?php echo Url('Message/index'); ?>" title="消息"><span class="badge badge-danger"> </span><i class="Hui-iconfont" style="font-size:18px">&#xe68a;</i></a> </li>

			</ul>
		</nav>
	</div>
</div>
</header>
<aside class="Hui-aside">
	<div class="menu_dropdown bk_2">
		<!--<dl id="menu-article">
			<dt><i class="Hui-iconfont">&#xe616;</i> 资讯管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="article-list.html" data-title="资讯管理" href="javascript:void(0)">资讯管理</a></li>
			</ul>
		</dd>
	</dl>
		<dl id="menu-picture">
			<dt><i class="Hui-iconfont">&#xe613;</i> 图片管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="picture-list.html" data-title="图片管理" href="javascript:void(0)">图片管理</a></li>
			</ul>
		</dd>
	</dl>
		<dl id="menu-product">
			<dt><i class="Hui-iconfont">&#xe620;</i> 产品管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="product-brand.html" data-title="品牌管理" href="javascript:void(0)">品牌管理</a></li>
					<li><a data-href="product-category.html" data-title="分类管理" href="javascript:void(0)">分类管理</a></li>
					<li><a data-href="product-list.html" data-title="产品管理" href="javascript:void(0)">产品管理</a></li>
			</ul>
		</dd>
	</dl>
		<dl id="menu-comments">
			<dt><i class="Hui-iconfont">&#xe622;</i> 评论管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="http://h-ui.duoshuo.com/admin/" data-title="评论列表" href="javascript:;">评论列表</a></li>
					<li><a data-href="feedback-list.html" data-title="意见反馈" href="javascript:void(0)">意见反馈</a></li>
			</ul>
		</dd>
	</dl>
		<dl id="menu-member">
			<dt><i class="Hui-iconfont">&#xe60d;</i> 会员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="member-list.html" data-title="会员列表" href="javascript:;">会员列表</a></li>
					<li><a data-href="member-del.html" data-title="删除的会员" href="javascript:;">删除的会员</a></li>
					<li><a data-href="member-level.html" data-title="等级管理" href="javascript:;">等级管理</a></li>
					<li><a data-href="member-scoreoperation.html" data-title="积分管理" href="javascript:;">积分管理</a></li>
					<li><a data-href="member-record-browse.html" data-title="浏览记录" href="javascript:void(0)">浏览记录</a></li>
					<li><a data-href="member-record-download.html" data-title="下载记录" href="javascript:void(0)">下载记录</a></li>
					<li><a data-href="member-record-share.html" data-title="分享记录" href="javascript:void(0)">分享记录</a></li>
			</ul>
		</dd>
	</dl>-->
		<dl id="menu-admin">
			<dt><i class="Hui-iconfont">&#xe60a;</i> 后台账号管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="<?php echo Url('admin/adminindex'); ?>" data-title="后台账号列表" href="javascript:void(0)">后台账号列表</a></li>
					<!--<li><a data-href="<?php echo Url('admin/Weixin'); ?>" data-title="账号绑定" href="javascript:void(0)">账号绑定</a></li>-->
				</ul>
			</dd>
		</dl>
		<dl id="menu-admin">
			<dt><i class="Hui-iconfont">&#xe643;</i> 公司管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="<?php echo Url('Company/adminlist'); ?>" data-title="公司管理员" href="javascript:void(0)">公司列表</a></li>
					<!--<li><a data-href="<?php echo Url('admin/Weixin'); ?>" data-title="账号绑定" href="javascript:void(0)">账号绑定</a></li>-->
				</ul>
				<!--<ul>
					<li><a data-href="<?php echo Url('Company/companylist'); ?>" data-title="公司列表" href="javascript:void(0)">公司列表</a></li>
					&lt;!&ndash;<li><a data-href="<?php echo Url('admin/Weixin'); ?>" data-title="账号绑定" href="javascript:void(0)">账号绑定</a></li>&ndash;&gt;
				</ul>-->
			</dd>
		</dl>
		<dl id="menu-admin">
			<dt><i class="Hui-iconfont">&#xe62d;</i>公众号菜单管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="<?php echo Url('Permission/index'); ?>" data-title="角色管理" href="javascript:void(0)">角色管理</a></li>
					<li><a data-href="<?php echo Url('Permission/permission'); ?>" data-title="权限管理" href="javascript:void(0)">公众号菜单管理</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-admin">
			<dt><i class="Hui-iconfont">&#xe705;</i> 用户后台权限管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="<?php echo Url('Auth/index'); ?>" data-title="用户后台权限管理" href="javascript:void(0)">用户后台权限管理</a></li>
					<!--<li><a data-href="<?php echo Url('Auth/binding'); ?>" data-title="用户后台权限绑定" href="javascript:void(0)">用户后台权限绑定</a></li>-->
				</ul>
			</dd>
		</dl>
		<dl id="menu-admin">
			<dt><i class="Hui-iconfont">&#xe626;</i> 页面模块管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="<?php echo Url('Pagemodule/index'); ?>" data-title="页面模块管理" href="javascript:void(0)">页面模块管理</a></li>
					<!--<li><a data-href="<?php echo Url('Permission/permission'); ?>" data-title="权限管理" href="javascript:void(0)">权限管理</a></li>-->
				</ul>
			</dd>
		</dl>
		<dl id="menu-admin">
			<dt><i class="Hui-iconfont">&#xe63b;</i> 消息管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="<?php echo Url('Message/index'); ?>" data-title="消息管理" href="javascript:void(0)">消息列表</a></li>
					<!--<li><a data-href="<?php echo Url('Permission/permission'); ?>" data-title="权限管理" href="javascript:void(0)">权限管理</a></li>-->
				</ul>
			</dd>
		</dl>
		<dl id="menu-admin">
			<dt><i class="Hui-iconfont">&#xe616;</i> 新闻管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="<?php echo Url('NewCate/index'); ?>" data-title="分类管理" href="javascript:void(0)">分类管理</a></li>
					<li><a data-href="<?php echo Url('News/index'); ?>" data-title="新闻管理" href="javascript:void(0)">新闻管理</a></li>
				</ul>
			</dd>
		</dl>
		<!--<dl id="menu-admin">
			<dt><i class="Hui-iconfont">&#xe62d;</i> 活动管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="<?php echo Url('Activity/index'); ?>" data-title="分类管理" href="javascript:void(0)">活动管理</a></li>
				</ul>
			</dd>
		</dl>-->


		<dl id="menu-admin">
			<dt><i class="Hui-iconfont">&#xe68c;</i> 广告位管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="<?php echo Url('Ad/index','type=1'); ?>" data-title="广告位管理" href="javascript:void(0)">广告位管理</a></li>
					<li><a data-href="<?php echo Url('Ad/index','type=2'); ?>" data-title="banner管理" href="javascript:void(0)">banner管理</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-admin">
			<dt><i class="Hui-iconfont">&#xe613;</i> 党建相册<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="<?php echo Url('Photo/index'); ?>" data-title="相册管理" href="javascript:void(0)">相册管理</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-admin">
			<dt><i class="Hui-iconfont">&#xe630;</i> 党校管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="<?php echo Url('ClassCate/index'); ?>" data-title="分类管理" href="javascript:void(0)">分类管理</a></li>
					<li><a data-href="<?php echo Url('ClassCourse/index'); ?>" data-title="课程管理" href="javascript:void(0)">课程管理</a></li>
					<li><a data-href="<?php echo Url('ClassChapter/index'); ?>" data-title="视频管理" href="javascript:void(0)">视频管理</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-admin">
			<dt><i class="Hui-iconfont">&#xe630;</i> 答题小程序管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="<?php echo Url('Exambank/index'); ?>" data-title="题目管理" href="javascript:void(0)">题目管理</a></li>
					<li><a data-href="<?php echo Url('Examcate/index'); ?>" data-title="题目分类" href="javascript:void(0)">题目分类</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-admin">
			<dt><i class="Hui-iconfont">&#xe630;</i> 小程序应用商店<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="<?php echo Url('Applets/index'); ?>" data-title="小程序列表" href="javascript:void(0)">小程序列表</a></li>
					<li><a data-href="<?php echo Url('Applets/create'); ?>" data-title="小程序列表" href="javascript:void(0)">添加小程序</a></li>
					<li><a data-href="<?php echo Url('Applets/classification'); ?>" data-title="小程序列表" href="javascript:void(0)">小程序分类</a></li>
					<li><a data-href="<?php echo Url('Applets/banner'); ?>" data-title="小程序列表" href="javascript:void(0)">轮播banner</a></li>
					<li><a data-href="<?php echo Url('Applets/banner_create'); ?>" data-title="小程序列表" href="javascript:void(0)">添加banner</a></li>
				</ul>
			</dd>
		</dl>
		<!--<dl id="menu-admin">
			<dt><i class="Hui-iconfont">&#xe62d;</i> 公众号管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="<?php echo Url('Weixin/index'); ?>" data-title="公众号列表" href="javascript:void(0)">公众号列表</a></li>

				</ul>
			</dd>
		</dl>-->
		<!--<dl id="menu-tongji">
			<dt><i class="Hui-iconfont">&#xe61a;</i> 系统统计<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="charts-1.html" data-title="折线图" href="javascript:void(0)">折线图</a></li>
					<li><a data-href="charts-2.html" data-title="时间轴折线图" href="javascript:void(0)">时间轴折线图</a></li>
					<li><a data-href="charts-3.html" data-title="区域图" href="javascript:void(0)">区域图</a></li>
					<li><a data-href="charts-4.html" data-title="柱状图" href="javascript:void(0)">柱状图</a></li>
					<li><a data-href="charts-5.html" data-title="饼状图" href="javascript:void(0)">饼状图</a></li>
					<li><a data-href="charts-6.html" data-title="3D柱状图" href="javascript:void(0)">3D柱状图</a></li>
					<li><a data-href="charts-7.html" data-title="3D饼状图" href="javascript:void(0)">3D饼状图</a></li>
			</ul>
		</dd>
	</dl>
		<dl id="menu-system">
			<dt><i class="Hui-iconfont">&#xe62e;</i> 系统管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="system-base.html" data-title="系统设置" href="javascript:void(0)">系统设置</a></li>
					<li><a data-href="system-category.html" data-title="栏目管理" href="javascript:void(0)">栏目管理</a></li>
					<li><a data-href="system-data.html" data-title="数据字典" href="javascript:void(0)">数据字典</a></li>
					<li><a data-href="system-shielding.html" data-title="屏蔽词" href="javascript:void(0)">屏蔽词</a></li>
					<li><a data-href="system-log.html" data-title="系统日志" href="javascript:void(0)">系统日志</a></li>
				</ul>
		</dd>
	</dl>-->
</div>
</aside>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
<section class="Hui-article-box">
	<div id="Hui-tabNav" class="Hui-tabNav hidden-xs">
		<div class="Hui-tabNav-wp">
			<ul id="min_title_list" class="acrossTab cl">
				<li class="active">
					<span title="我的桌面" data-href="<?php echo Url('index/welcome'); ?>">我的桌面</span>
					<em></em></li>
		</ul>
	</div>
		<div class="Hui-tabNav-more btn-group"><a id="js-tabNav-prev" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a><a id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d7;</i></a></div>
</div>
	<div id="iframe_box" class="Hui-article">
		<div class="show_iframe">
			<div style="display:none" class="loading"></div>
			<iframe scrolling="yes" frameborder="0" src="<?php echo Url('index/welcome'); ?>"></iframe>
	</div>
</div>
</section>

<div class="contextMenu" id="Huiadminmenu">
	<ul>
		<li id="closethis">关闭当前 </li>
		<li id="closeall">关闭全部 </li>
</ul>
</div>


<!--请在下方写此页面业务相关的脚本-->
<!--<script  src="/static/admin/lib/jquery/1.9.1/jquery.min.js"></script>-->
<script type="text/javascript" src="/static/admin/lib/jquery.contextmenu/jquery.contextmenu.r2.js"></script>
<script type="text/javascript">
$(function(){
	$("#min_title_list li").contextMenu('Huiadminmenu', {
		bindings: {
			'closethis': function(t) {
				console.log(t);
				if(t.find("i")){
					t.find("i").trigger("click");
				}
			},
			'closeall': function(t) {
				alert('Trigger was '+t.id+'\nAction was Email');
			},
		}
	});
});
/*个人信息*/
function myselfinfo(){
	layer.open({
		type: 1,
		area: ['300px','200px'],
		fix: false, //不固定
		maxmin: true,
		shade:0.4,
		title: '查看信息',
		content: '<div>管理员信息</div>'
	});
}

/*资讯-添加*/
function article_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*图片-添加*/
function picture_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*产品-添加*/
function product_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*用户-添加*/
function member_add(title,url,w,h){
	layer_show(title,url,w,h);
}


</script>


</body>
</html>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/static/admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/static/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/static/admin/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/static/admin/static/h-ui.admin/js/H-ui.admin.js"></script><!--/_footer 作为公共模版分离出去-->