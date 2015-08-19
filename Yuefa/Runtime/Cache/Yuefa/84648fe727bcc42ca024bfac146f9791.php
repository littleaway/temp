<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<title>我赞过的</title>
	<meta name="keywords" content="约发">
	<meta name="description" content="约发">
	
	<!-- 浏览器配置 -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<meta name="renderer" content="webkit">
	<meta http-equiv="Cache-Control" content="no-siteapp"/>

	<!-- 样式和图标引入 -->
	<link rel="stylesheet" href="/temp/Public/yf/css/likes/style.css">
</head>
<body>
	<header class="headbar">
		<a href="" onclick="javascript:history.go(-1)">返回</a>
		<h3>我赞过的</h3>
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

	<section class="masterworksshow">
		<div class="workscardwrap">
			<div class="inlinecol linecol1">
			</div>
			<div class="inlinecol linecol2">
			</div>
		</div>
	</section>


<script type="text/javascript" src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
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
	var scrollflag=true;
        var page = 0;
        var col = 1;
        var getmore = function (pagenow) {
            $.getJSON(
                    '<?php echo U("Yuefa/Api/GetLikes");?>?page=' + pagenow,
                    function (Results, textStatus) {
                        if (Results.status != 404) {
                            $.each(Results.result.details, function (index, card) {
                                var picurl = card['picurl'];
                                var piclink = card['piclink'];
                                var headurl = card['headurl'];
                                var headlink = card['headlink'];
                                var mastername = card['mastername'];
                                var likednumber = card['likednumber'];
                                var id = card['id'];
                                var str = "<div id='" + id + "' class='workscard'><a href=" + piclink + "><img src='" + picurl + "'></a><div class='carddetail'><a href='" + headlink + "'><div class='headpic' style=\"background-image: url('" + headurl + "');\"></div></a><h3>" + mastername + "</h3><img src='/temp/Public/yf/images/index/heart.png'><span>" + likednumber + "</span></div></div>"
                                $(".linecol" + col).append(str);
                                col = (col === 1 ? 2 : 1);
                            });
                        } else {
                            if (scrollflag == true) {
                                var strerror = "<div class='nomore'><p>没有更多啦 （▼へ▼メ）  </p></div>"
                                $('.masterworksshow').append(strerror);
                                $('.nomore').css({
                                    'width': '100%',
                                    'font-size': '5vw',
                                    'text-align': 'center'
                                });
                                scrollflag = false;
                            }
                        }
                    }
            );
        }

        window.onload = function (event) {
            getmore(0);
        };
        window.onscroll = function (event) {

            scrollTop = document.body.scrollTop;
            viewH = document.documentElement.clientHeight;
            contentH = document.body.scrollHeight;

            if (contentH - (viewH + scrollTop) < 10) {
                page++;
                getmore(page);
            }
        };
	
});
</script>

</body>
</html>