<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<title>作品详情</title>
	<meta name="keywords" content="约发">
	<meta name="description" content="约发">
	
	<!-- 浏览器配置 -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<meta name="renderer" content="webkit">
	<meta http-equiv="Cache-Control" content="no-siteapp"/>

	<!-- 样式和图标引入 -->
	<link rel="stylesheet" href="/temp/Public/yf/css/style/style.css">
</head>
<body>
	<header class="headbar">
		<a href="" onclick="javascript:history.go(-1)">返回</a>
		<h3><?php echo $barber['name'];?>的作品</h3>
	</header>

	<nav class="booknow">
		<p>已有<?php echo $ordernum;?>人预约</p>
		<a href="<?php echo U('Yuefa/Index/Sure');?>?bid=<?php echo $bid;?>" id="bookbutton">立即预约</a>
	</nav>

	<section class="bigworksshow">
		<img class="bigheadpic" src="<?php echo $style['pic_url'];?>">
		<p class="headdesc"><?php echo $style['details'];?></p>
		<p class="fixedface">适合脸型：<?php echo $style['fit'];?></p>
		<img class="heart" src="/temp/Public/yf/images/style/heart.png">
		<span><?php echo $style['likes'];?></span>
	</section>

	<section class="masterpic">
		<div class="masterbg" style="background-image:url(<?php echo $barber['headpic_url'];?>)" alt="masterpic"></div>
		<div class="mastercicle" style="background-image:url(<?php echo $barber['headpic_url'];?>)" alt="masterpic"></div>
		<h2><?php echo $barber['name'];?></h2>
	</section>

	<section class="masterdesc">
		<p class="masterdetail">个人简介：<?php echo $barber['details'];?></p>
		<p class="goodat">擅长：<?php echo $barber['expert'];?></p>
		<p class="masterdetail">店铺位置：<?php echo $barber['position'];?></p>
	</section>

	<section class="masterprice">
		<h3>价目表</h3>
		<div class="pricelist">
			<?php if(is_array($books)): foreach($books as $key=>$vo): ?><span><?php echo ($vo['type_name']); ?>：<?php echo ($vo['cost']); ?>元</span><?php endforeach; endif; ?>
		</div>
	</section>

	<section class="masterworksshow">
		<h3>作品展示</h3>
		<div class="workscardwrap">
			<div class="inlinecol">
				<?php $__FOR_START_1657783060__=0;$__FOR_END_1657783060__=count($styles);for($i=$__FOR_START_1657783060__;$i < $__FOR_END_1657783060__;$i+=2){ ?><div class="workscard">
						<img src="<?php echo ($styles[$i]['pic_url']); ?>">
						<div class="carddetail">
							<div class="headpic" style="background-image:url(<?php echo $barber['headpic_url'];?>)" alt="masterpic" ></div>
							<h3><?php echo ($styles[$i]['style_name']); ?></h3>
							<img src="/temp/Public/yf/images/barber/heart.png">
							<span><?php echo ($styles[$i]['likes']); ?></span>
						</div>
					</div><?php } ?>				
			</div>
			<div class="inlinecol">
				<?php if(count($styles) >= 2): $__FOR_START_39611322__=1;$__FOR_END_39611322__=count($styles);for($i=$__FOR_START_39611322__;$i < $__FOR_END_39611322__;$i+=2){ ?><div class="workscard">
						<img src="<?php echo ($styles[$i]['pic_url']); ?>">
						<div class="carddetail">
							<div class="headpic" style="background-image:url(<?php echo $barber['headpic_url'];?>)" alt="masterpic" ></div>
							<h3><?php echo ($styles[$i]['style_name']); ?></h3>
							<img src="/temp/Public/yf/images/barber/heart.png">
							<span><?php echo ($styles[$i]['likes']); ?></span>
						</div>
					</div><?php } endif; ?>
			</div>
		</div>
	</section>

</body>
</html>