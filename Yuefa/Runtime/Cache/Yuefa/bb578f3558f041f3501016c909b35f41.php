<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<title>确认预约</title>
	<meta name="keywords" content="约发">
	<meta name="description" content="约发">
	
	<!-- 浏览器配置 -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<meta name="renderer" content="webkit">
	<meta http-equiv="Cache-Control" content="no-siteapp"/>

	<!-- 样式和图标引入 -->
	<link rel="stylesheet" type="text/css" href="http://cdn.amazeui.org/amazeui/2.4.1/css/amazeui.min.css">
	<link rel="stylesheet" href="/temp/Public/yf/css/sure/style.css">
</head>
<body>
	<header class="headbar">
		<a href="" onclick="javascript:history.go(-1)">返回</a>
		<h3>确认预约</h3>
	</header>

	<nav class="booknow">
		<button id="bookbutton">提交</button>
	</nav>

	<section class="bookform">
		<form id="yuefaform">
			<fieldset>
				<legend>约发预定表单</legend>

				<label for="username">称呼</label>
				<label for="tel">手机号</label>
				<label for="headkind">下拉多选框</label>
				<label for="datetime">下拉多选框</label>

				<div class="inputwrap usernameinput">
					<input type="text" class="" id="username" placeholder="填写自己的称呼，下次预约我们会为你自动填写">
					<span>请填写你的昵称，4到30个字符</span>
				</div>

				<div class="inputwrap phonenumberinput">
					<input type="text" class="" id="phonenumber" placeholder="填写自己的手机号，下次预约我们会为你自动填写">
					<span>请填写您的11位手机号</span><br>
				</div>

				<div class="inputwrap headkindselect">
					<select id="headkind">
						<option value="0">--请选择--</option>
						<?php if(is_array($books)): foreach($books as $key=>$vo): ?><option value="<?php echo ($vo['otid']); ?>"><?php echo ($vo['type_name']); ?>：<?php echo ($vo['cost']); ?>元</option><?php endforeach; endif; ?>
					</select>
					<span>请选择你的服务项目</span>
				</div>

				<div class="inputwrap dateinput">
					<input type="text" class="am-form-field" placeholder="请选择日期" id="date"
					value="" name="user_date" readonly>

					<input placeholder="请选择具体时间" type="time" id="time" name="user_time" />
					<span>请选择日期与时间</span>
				</div>
				<input type="hidden" id="bid" name="barberid" value="<?php echo $bid;?>"/>
			</fieldset>
		</form>
	</section>

	<section class="booknotic">
		<p>
			确定预约后，我们的工作人员会单独和您联系
		</p>
	</section>


	<div class="am-modal am-modal-alert" tabindex="-1" id="my-alert">
		<div class="am-modal-dialog">
			<div class="am-modal-hd">预约成功</div>
			<div class="am-modal-footer">
				<span class="am-modal-btn">确定</span>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="/temp/Public/yf/js/sure/jquery.min.js"></script>
	<script type="text/javascript" src="http://cdn.amazeui.org/amazeui/2.4.1/js/amazeui.min.js"></script>
	<script type="text/javascript" src="/temp/Public/yf/js/sure/form.js"></script>
	<script type="text/javascript" src="/temp/Public/yf/js/sure/date.js"></script>
	<script type="text/javascript">
	$(function(){
		$("#yuefaform").submit(function(){
			var isOK = verification();
			var bid = $("#bid").val();
			var username = $("#username").val();
			var tel = $("#phonenumber").val();
			var headkind = $("#headkind").val();
			var date = $("#date").val();
			var time = $("#time").val();
			alert(tel);
			alert(headkind);
			if (isOK) {
				// 要写入的url
				$.post(
					"<?php echo U('Yuefa/Api/Order');?>"
					,{
						"bid": bid,
						"username": username,
						"tel": tel,
						"headkind": headkind,
						"date": date,
						"time": time
					},function(data){
						$('#my-alert').modal('open').on('closed.modal.amui', 
							function(){
								window.location.href="<?php echo U('Yuefa/Index/Orders');?>"; 
							}
						);
					},"json");
			}else{
				alert("请正确输入表单内容")
				return false;
			};
		});
	});
	</script>


</body>
</html>