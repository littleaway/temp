<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<title>我的约发</title>
	<meta name="keywords" content="约发">
	<meta name="description" content="约发">
	
	<!-- 浏览器配置 -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<meta name="renderer" content="webkit">
	<meta http-equiv="Cache-Control" content="no-siteapp"/>

	<!-- 样式和图标引入 -->
	<link rel="stylesheet" href="/aliyun_2/Public/yf/css/ucenter/style.css">
</head>
<body>
	<header class="headbar">
		<a href="" onclick="javascript:history.go(-1)">返回</a>
		<h3>我的约发</h3>
	</header>

	<nav class="headmanager">
		<a href="<?php echo U('Yuefa/Index/index');?>">
			<div class="headcol">
				<img src="/aliyun_2/Public/yf/images/ucenter/toufa2.png">
				<span>选发型</span>
			</div>
		</a>
		<a href="<?php echo U('Yuefa/Index/home');?>">
			<div class="headcol activeheadcol">
				<img src="/aliyun_2/Public/yf/images/ucenter/yonghu2.png">
				<span>我的约发</span>
			</div>
		</a>
	</nav>

	<section class="centercontent">
		<a href="<?php echo U('Yuefa/Index/Orders');?>">
			<span>我的预约</span>
			<img src="/aliyun_2/Public/yf/images/ucenter/arrow.png">
		</a>
		<a href="<?php echo U('Yuefa/Index/likes');?>">
			<span>我赞过的</span>
			<img src="/aliyun_2/Public/yf/images/ucenter/arrow.png">
		</a>
	</section>









</body>
</html>