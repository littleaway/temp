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
	<link rel="stylesheet" href="/aliyunyun/Public/yf/css/index/style.css">
</head>
<body>
	<header class="headbar">
		<h3>约发</h3>
	</header>

	<nav class="headmanager">
		<a href="<?php echo U('Yuefa/Index/index');?>">
			<div class="headcol activeheadcol">
				<img src="/aliyunyun/Public/yf/images/index/toufa.png">
				<span>选发型</span>
			</div>
		</a>
		<a href="<?php echo U('Yuefa/Index/home');?>">
			<div class="headcol">
				<img src="/aliyunyun/Public/yf/images/index/yonghu.png">
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
		<?php if(is_array($label)): foreach($label as $key=>$vo): ?><button><?php echo ($vo["name"]); ?></button><?php endforeach; endif; ?>
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
<script type="text/javascript" src="/aliyunyun/Public/yf/js/index/unslider.min.js"></script>
<script type="text/javascript">
$(function(){

	// 点赞功能
	$(".workscardwrap").delegate(".carddetail>img","click", function(){
		var thisRef = $(this);
		var likednumber = thisRef.parent().find("span").text();
		var id = thisRef.parents(".workscard").attr("id");
		likednumber++

		if (thisRef.data("done")===undefined) {
			
			// 写入提交赞的URL
			thisRef.data("done",true);
			$.post(
				"<?php echo U('Yuefa/Api/Like');?>"
				, { "id": id },function(){
				thisRef.parent().find("span").text(likednumber);
			});
		}
	});

	//瀑布流功能
	var	page=1;
	//var col=1;
	var col;
	var labelid;
	var getmore = function(pagenow){
		$.getJSON(
					'<?php echo U("Yuefa/Api/Style");?>?page='+pagenow+'&labelid='+labelid,
					function(Results, textStatus) {
						$.each(Results.result.details, function(index, card) {
							var picurl=card['picurl'];
							var piclink=card['piclink'];
							var headurl=card['headurl'];
							var headlink=card['headlink'];
							var mastername=card['mastername'];
							var likednumber=card['likednumber'];
							var id=card['id'];
							var str = "<div id='"+id+"' class='workscard'><a href="+piclink+"><img src='"+picurl+"'></a><div class='carddetail'><a href='"+headlink+"'><div class='headpic' style=\"background-image: url('"+headurl+"');\"></div></a><h3>"+mastername+"</h3><img src='/aliyunyun/Public/yf/images/index/heart.png'><span>"+likednumber+"</span></div></div>"
							// if($(".linecol1").style.height>$(".linecol2").style.height){
							// 	col=2;

							// }else {
							// 	col=1;
							// }
							// alert($(".headtabs").style.height);
							$(".linecol"+col).append(str);
							col=(col===1?2:1);
											
						}
						);
						//page++;
					}
				);
	}

	window.onload = function(event){
		labelid=0;
		getmore(1);
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
				getmore(page);

			 // })();
		}
	};

	// for (var i = 0; i<10 ; i++) {
	// 	ajaxPic();
	// };
});
</script>
<script type="text/javascript">
	$(function() {
	    $('.banner').unslider({
			speed: 500,
			fluid: true   
	    });
	});
</script>



</body>
</html>