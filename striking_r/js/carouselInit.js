jQuery(document).ready(function($) {
	 jQuery(".carousel_wrap").each(function(){
	 	var container = jQuery(this).find('.carousel');
		var tabs = container.parents('.toggle, .tabs_container,.mini_tabs_container,.vertical_tabs_container,.accordion, .theme_accordion');
		container.bind('initCarousel',function(){
			container.carousel({
				lazyload: true,
				nav: false,
				pager: false,
				responsive: true
			});
			container.parent().parent().find('.carousel_nav').each(function(){
				jQuery(this).find('.carousel_nav_prev').click(function(){
					container.carousel('prev');
					return false;
				});
				jQuery(this).find('.carousel_nav_next').click(function(){
					container.carousel('next');
					return false;
				});
			});
			jQuery(this).data("carouselInited",true);
		}).data("carouselInited",false);

		if(tabs.length!=0){
			tabs.each(function(){
				var api = null;
				if($(this).is('.toggle')){
					$(this).on('toggle::open', function(){
						$(this).find('.carousel').each(function(){
							if(jQuery(this).data("carouselInited")==false){
								jQuery(this).trigger('initCarousel');
							}
						});
					});
					return;
				}
				if($(this).is('.accordion, .theme_accordion')){
					api = $(this).data("tabs");
				} else {
					api = $(this).find('.tabs, .theme_tabs, .mini_tabs, .theme_mini_tabs, .vertical_tabs, .theme_vertical_tabs').data("tabs");
				}
				api.onClick(function(index) {
					this.getCurrentPane().find('.carousel').each(function(){
						if(jQuery(this).data("carouselInited")==false){
							jQuery(this).trigger('initCarousel');
						}
					});
				});
			});
		} else {
			container.trigger('initCarousel');
		}
	});
});