$(function(){
	$(".workscardwrap").delegate(".carddetail>img","click", function(){
		var thisRef = $(this);
		var likednumber = thisRef.parent().find("span").text();
		var id = thisRef.parents(".workscard").attr("id");
		likednumber++

		if (thisRef.data("done")===undefined) {
			
			thisRef.data("done",true);
			$.post("???.php", { "id": id },function(){
				thisRef.parent().find("span").text(likednumber);
			});
		}
	});
});