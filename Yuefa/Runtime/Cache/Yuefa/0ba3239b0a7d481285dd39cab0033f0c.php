<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<title>我的预约</title>
	<meta name="keywords" content="约发">
	<meta name="description" content="约发">
	
	<!-- 浏览器配置 -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<meta name="renderer" content="webkit">
	<meta http-equiv="Cache-Control" content="no-siteapp"/>

	<!-- 样式和图标引入 -->
	<link rel="stylesheet" href="/temp/Public/yf/css/orders/style.css">
</head>
<body>
	<header class="headbar">
		<a href="" onclick="javascript:history.go(-1)">返回</a>
		<h3>我的预约</h3>
	</header>

	<nav class="headmanager">
		<a href="/temp/index.php/Index/index.html">
			<div class="headcol activeheadcol">
				<img src="/temp/Public/yf/images/index/toufa.png">
				<span>选发型</span>
			</div>
		</a>
		<a href="/temp/index.php/Index/home.html">
			<div class="headcol">
				<img src="/temp/Public/yf/images/index/yonghu.png">
				<span>我的约发</span>
			</div>
		</a>
	</nav>

	<section class="bookcontent">
		<?php if(is_array($orders)): foreach($orders as $key=>$vo): ?><div class="bookcard">
					<div class="booktime">
						<h4><?php echo (date("Y-m-d",$vo['order_time'])); ?></h4>
						<h5><?php echo (date("H:i",$vo['order_time'])); ?></h5>
					</div>
					<div class="bookdetail">
						<p>预约昵称：<?php echo ($vo['name']); ?></p>
						<p>预约电话：<?php echo ($vo['tel']); ?></p>
						<p>预约老师：<?php echo ($vo['barber_name']); ?></p>
						<p>美发类型：<?php echo ($vo['type_name']); ?></p>
						<p>店铺位置：<?php echo ($vo['position']); ?></p>
						<span class="price"><?php echo ($vo['cost']); ?>元</span>
					</div>
				</div><?php endforeach; endif; ?>
	</section>









</body>
</html>