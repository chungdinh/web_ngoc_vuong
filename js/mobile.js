$(document).ready(function() {
	$(".navtabs li").click(function(event){
		var _this = $(this),_tabs = _this.attr('id-tabs');
		$(".navtabs li").removeClass('active');
		_this.addClass('active');
		$(".tab-content div").removeClass('active');
		$("#"+_tabs).addClass('active');
	});
	$(window).bind('load',function(){
		$(".opacity").css({'opacity':'1','visibility':'visible','max-height':'100%'});
		// var heights = $(".box-sp").map(function (){
		// 	return $(this).height();
		// }).get(),
		// maxHeight = Math.max.apply(null, heights);
		// $(".box-sp").height(maxHeight);
	});
	$(".block-head").sticky({topSpacing:0});
	$("#menu").mmenu();
	$('[data-fancybox]').fancybox();
});
