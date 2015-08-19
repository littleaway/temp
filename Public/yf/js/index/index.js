
$(function(){

	var lid;

	var scrollflag = true;

	var page=0;

	var col=1;

	//to load more from db

	var getmore = function(pagenow,lid){


		$.getJSON(

			getmoreURL+pagenow+'&labelid='+lid,

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

						var str = "<div id='"+id+"' class='workscard'><a href="+piclink+"><img src='"+picurl+"'></a><div class='carddetail'><a href='"+headlink+"'><div class='headpic' style=\"background-image: url('"+headurl+"');\"></div></a><h3>"+mastername+"</h3><img src="+heartURL+"><span>"+likednumber+"</span></div></div>";

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

			}

		);

	};



	//click the label and load information

	$('.tabbtn').on('click',function(){

		lid = $(this).attr('data-labelid');

		//window.localStorage.lid = lid;

		//alert(localStorage.lid);

		scrollflag=true;

		$('.inlinecol').empty(); 

		$('.nomore').remove();

		getmore(0,lid);

	});



	//click the heart 

	$(".carddetail>img").on("click", function(){

		var thisRef = $(this);

		var likednumber = thisRef.parent().find("span").text();

		var id = thisRef.parents(".workscard").attr("id");

		likednumber++;



		if (thisRef.data("done")===undefined) {			

			// get the likednumber

			thisRef.data("done",true);

			$.post(

				getlikeURL, { "id": id },function(){

				thisRef.parent().find("span").text(likednumber);

			});

		}

	});



	//load

	window.onload = function(event){

		getmore(0,0);

		window.localStorage.lid = 0;

	};



	//scroll

	window.onscroll=function(event) {

		var scrollTop = document.body.scrollTop;

		var viewH = document.documentElement.clientHeight;

		var contentH = document.body.scrollHeight;

	

		if(contentH-(viewH+scrollTop)<10){

			page++;

			getmore(page,lid);

		}

	};



});
