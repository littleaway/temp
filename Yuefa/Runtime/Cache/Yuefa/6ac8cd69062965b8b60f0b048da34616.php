<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<title>发型师详情</title>
	<meta name="keywords" content="约发">
	<meta name="description" content="约发">
	
	<!-- 浏览器配置 -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<meta name="renderer" content="webkit">
	<meta http-equiv="Cache-Control" content="no-siteapp"/>

	<!-- 样式和图标引入 -->
	<link rel="stylesheet" href="/temp/Public/yf/css/barber/style.css">
</head>
<body>
	<header class="headbar">
		<a href="" onclick="javascript:history.go(-1)">返回</a>
		<h3><?php echo $barber['name'];?>的主页</h3>
	</header>

	<nav class="booknow">
		<p>已有<?php echo $ordernum;?>人预约</p>
		<a href="<?php echo U('Yuefa/Index/Sure');?>?bid=<?php echo $bid;?>" id="bookbutton">立即预约</a>
	</nav>

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
				<?php $__FOR_START_869241695__=0;$__FOR_END_869241695__=count($styles);for($i=$__FOR_START_869241695__;$i < $__FOR_END_869241695__;$i+=2){ ?><div class="workscard">
						<img src="<?php echo ($styles[$i]['pic_url']); ?>">
						<div class="carddetail">
							<div class="headpic" style="background-image:url(<?php echo $barber['headpic_url'];?>)" alt="masterpic"></div>
							<h3><?php echo ($styles[$i]['style_name']); ?></h3>
							<img src="/temp/Public/yf/images/barber/heart.png">
							<span><?php echo ($styles[$i]['likes']); ?></span>
						</div>
					</div><?php } ?>				
			</div>
			<div class="inlinecol">
				<?php if(count($styles) >= 2): $__FOR_START_203430901__=1;$__FOR_END_203430901__=count($styles);for($i=$__FOR_START_203430901__;$i < $__FOR_END_203430901__;$i+=2){ ?><div class="workscard">
						<img src="<?php echo ($styles[$i]['pic_url']); ?>">
						<div class="carddetail">
							<div class="headpic" style="background-image:url(<?php echo $barber['headpic_url'];?>)" alt="masterpic"></div>
							<h3><?php echo ($styles[$i]['style_name']); ?></h3>
							<img src="/temp/Public/yf/images/barber/heart.png">
							<span><?php echo ($styles[$i]['likes']); ?></span>
						</div>
					</div><?php } endif; ?>
			</div>
		</div>
	</section>
<!--	<section class="masterworksshow">
		<div class="workscardwrap">
			<div class="inlinecol linecol1">
			</div>
			<div class="inlinecol linecol2">
			</div>
		</div>
	</section>

	<script type="text/javascript">
		$(function(){
			var scrollflag = true;

			//瀑布流功能
			var	page=1;
			//var col=1;
			var col;


			var getmore = function(pagenow,lid){
				$.getJSON(
						'<?php echo U("Yuefa/Api/Style");?>?page='+pagenow+'&labelid='+lid,
						function(Results, textStatus) {
							if(Results.status!=404){
								$.each(Results.result.details, function(index, card) {
									var picurl=card['picurl'];
									var piclink=card['piclink'];
									var headurl=card['headurl'];
									var headlink=card['headlink'];
									var mastername=card['mastername'];
									var likednumber=card['likednumber'];
									var id=card['id'];
									var str = "<div id='"+id+"' class='workscard'><a href="+piclink+"><img src='"+picurl+"'></a><div class='carddetail'><a href='"+headlink+"'><div class='headpic' style=\"background-image: url('"+headurl+"');\"></div></a><h3>"+mastername+"</h3><img src='/temp/Public/yf/images/index/heart.png'><span>"+likednumber+"</span></div></div>"
									// if($(".linecol1").style.height>$(".linecol2").style.height){
									// 	col=2;

									// }else {
									// 	col=1;
									// }
									// alert($(".headtabs").style.height);
									$(".linecol"+col).append(str);
									col=(col===1?2:1);
								});
							}else{
								if(scrollflag==true){
									var strerror = "<div class='nomore'><p>没有更多啦 （▼へ▼メ）  </p></div>"
									$('.masterworksshow').append(strerror);
									$('.nomore').css({
										'width':'100%',
										'font-size':'5vw',
										'text-align':'center'
									});
									scrollflag=false;
								}
							}

							//page++;
						}
				);
			}

			window.onload = function(event){
				getmore(1,lid);
			};
			window.onscroll=function(event) {
				var scrollTop = document.body.scrollTop;
				var viewH = document.documentElement.clientHeight;
				var contentH = document.body.scrollHeight;

				if(contentH-(viewH+scrollTop)<10){

					//function ajaxPic(){
					// if ($("#loadpic").length==0) {
					// $(".masterworksshow").append("<p id='loadpic'>正在加载...</p>");
					// }
					// 写入获取信息的URL
					// col=($(".linecol1").offsetHeight<$(".linecol2").offsetHeight?1:2);
					page++;
					getmore(page,lid);

					// })();
				}
			};

		});
	</script>-->

</body>
</html>