$(function(){
	$("#username,#phonenumber,#headkind").keyup(function(){
		verification();
	}).click(function(){
		verification();
	}).blur(function(){
		verification();
	}).change(function(){
		verification();
	}).focus(function(){
		verification();
	});



	$("#bookbutton").click(function(){
		$("#yuefaform").submit();
	});



	// $('#my-alert').modal('open').on('closed.modal.amui', 
	// 	function(){
	// 		window.location.href="http://www.baidu.com"; 
	// 	}
	// );

});

function verification(){
	var username = $("#username").val();
	var phonenumber = $("#phonenumber").val();
	var date = $("#date").val();
	var time = $("#time").val();
	var phonenormallength = 11;
	var headkindnullvalue = "0";
	var usernameIsOK = false;
	var phonenumberIsOK = false;
	var headkindIsOK = false;
	var dateIsOK = false;

	if (username.length<2||username.length>30) {
		$(".usernameinput span").show();
		usernameIsOK = false;
	}else{
		$(".usernameinput span").hide();
		usernameIsOK = true;
	}

	if (phonenumber.length!== phonenormallength) {
		$(".phonenumberinput span").show();
		phonenumberIsOK = false;
	}else{
		$(".phonenumberinput span").hide();
		phonenumberIsOK = true;
	};
	
	if ($("#headkind").val()===headkindnullvalue){
		$(".headkindselect span").show();
		headkindIsOK = false;
	}else{
		$(".headkindselect span").hide();
		headkindIsOK = true;
	};

	console.log(date.length);
	console.log(time.length);

	if ((date.length==0)||(time.length==0)){
		$(".dateinput span").show();
		dateIsOK = false;
	}else{
		$(".dateinput span").hide();
		dateIsOK = true;
	};

	console.log("usernameIsOK:"+usernameIsOK);
	console.log("phonenumberIsOK:"+phonenumberIsOK);
	console.log("headkindIsOK:"+headkindIsOK);
	console.log(phonenumberIsOK&&usernameIsOK&&headkindIsOK);
	console.log("\n");

	return phonenumberIsOK&&usernameIsOK&&headkindIsOK&&dateIsOK;

}