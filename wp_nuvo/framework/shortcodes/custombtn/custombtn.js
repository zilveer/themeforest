jQuery(document).ready(function($){
	$('.smooth2pager').click(function(){
		var selector = $(this).data('el-selector');
		var top = $(selector).offset().top;
		$("html,body").animate({scrollTop: top }, 500);
	})
})