function info_box_resize(){
	var info_box_height = jQuery('.info-box').height();
	jQuery('.info-box').css({ 'margin-top' : ~info_box_height+5 });
	
	if(Modernizr.touch){
		jQuery('.info-box').off('click');
		jQuery('.info-box').on('click', function(e){
			console.log(e);
			jQuery(this).toggleClass('visible');
		});
	}else{
		jQuery('.info-box').off('mouseenter');
		jQuery('.info-box').off('mouseleave');
		jQuery('.info-box').on('mouseenter', function(){
			jQuery(this).stop().animate({ 'margin-top' : 0 }, 300);
		});
		jQuery('.info-box').on('mouseleave', function(){
			jQuery(this).stop().animate({ 'margin-top' : ~info_box_height+5 }, 300);
		});
		/* jQuery('.info-box').hover(
		  function () {
			jQuery(this).stop().animate({ 'margin-top' : 0 }, 300);
		  },
		  function () {
			jQuery(this).stop().animate({ 'margin-top' : ~info_box_height+5 }, 300);
		  }
		); */
	}
}
jQuery(window).load(function(){
	info_box_resize();
	jQuery(window).on("resize.infobox", function(){
		info_box_resize();
	});
});
