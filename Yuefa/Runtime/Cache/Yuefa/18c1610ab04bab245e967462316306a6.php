<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<title>约发</title>
	<meta name="keywords" content="约发">
	<meta name="description" content="约发">
	
	<!-- 浏览器配置 -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<meta name="renderer" content="webkit">
	<meta http-equiv="Cache-Control" content="no-siteapp"/>

	<!-- 样式和图标引入 -->
	<link rel="stylesheet" href="/temp/Public/yf/css/index/style.css">
</head>
<body>
	<header class="headbar">
		<h3>约发</h3>
	</header>

	<nav class="headmanager">
		<a href="<?php echo U('Yuefa/Index/index');?>">
			<div class="headcol activeheadcol">
				<img src="/temp/Public/yf/images/index/toufa.png">
				<span>选发型</span>
			</div>
		</a>
		<a href="<?php echo U('Yuefa/Index/home');?>">
			<div class="headcol">
				<img src="/temp/Public/yf/images/index/yonghu.png">
				<span>我的约发</span>
			</div>
		</a>
	</nav>
	
	<section class="worksslider">
		<div class="banner">
			<ul>
				<?php if(is_array($banner)): foreach($banner as $key=>$vo): ?><li style="background-image: url('<?php echo ($vo["url"]); ?>');" alt="<?php echo ($vo["content"]); ?>"></li><?php endforeach; endif; ?>
			</ul>
		</div>
	</section>

	<section class="headtabs">
		<?php if(is_array($label)): foreach($label as $key=>$vo): ?><button type="button" class="tabbtn" data-labelid="<?php echo ($vo["lid"]); ?>"><?php echo ($vo["name"]); ?></button><?php endforeach; endif; ?>
	</section>

	<section class="masterworksshow">
		<div class="workscardwrap">
			<div class="inlinecol linecol1">
			</div>
			<div class="inlinecol linecol2">
			</div>
		</div>
		

	</section>

<script type="text/javascript" src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript" src="/temp/Public/yf/js/index/unslider.min.js"></script>
<script type="text/javascript" src="/temp/Public/yf/js/index/index.js"></script>

<script type="text/javascript">
	var getmoreURL = '<?php echo U("Yuefa/Api/Style");?>?page=';
	var getlikeURL = "<?php echo U('Yuefa/Api/Like');?>";
	var heartURL = '/temp/Public/yf/images/index/heart.png';
	$(function() {
	    $('.banner').unslider({
			speed: 500,
			fluid: true   
	    });
	});
</script>

</body>
</html>