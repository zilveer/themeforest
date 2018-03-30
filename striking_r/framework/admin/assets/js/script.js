jQuery(document).ready(function($) {
	/* meta-box tabs init */
	$('.theme-metabox.with-tabs').each(function(){
		var container = this;
		$(this).find(".theme-tabs li").each(function(i){
			$(this).on('click',function(e){
				$(this).siblings().removeClass('is-active');
				$(this).addClass('is-active');
				$('.theme-panes > li',container).removeClass('is-active').eq(i).addClass('is-active');
			});
		});
	});
	
	/* options-page tabs init */
	$('.theme-page').each(function(){
		var currentTab = '';
		var match = RegExp('[?&]tab=([^&]*)')
	                .exec(window.location.search);
		if(match){
			currentTab = decodeURIComponent(match[1].replace(/\+/g, ' '));
		}
		
		if(currentTab === ''){
			currentTab = $(this).find(".theme-tabs li:first").data('tab');
		}
		var container = this;
		$(this).find(".theme-tabs li").each(function(i){
			var slug = $(this).data('tab');

			$(this).on('click',function(e){
				$(this).trigger('active');
				
				if (window.history && window.history.pushState && window.history.replaceState) {					
					window.history.pushState({tab:slug}, "", window.location.search.replace(/&*tab=[^&]+/,'') + "&tab="+slug);
				}
			});

			$(this).on('active',function(e){
				$(this).siblings().removeClass('is-active');
				$(this).addClass('is-active');
				$('.theme-panes > li',container).removeClass('is-active').eq(i).addClass('is-active');
			});

			if(currentTab == slug){
				$(this).trigger('click');
			}
		});
	});
	$(window).on('popstate', function (event) {
		if (event.originalEvent.state !== null) {
			if(typeof event.originalEvent.state.tab != 'undefined'){
				$('.theme-tabs').children('[data-tab="'+event.originalEvent.state.tab+'"]').trigger('active');
				event.preventDefault();
			}
		}
    });
	$(".theme-subtabs").each(function(i){
		$(this).find('li').each(function(i){
			$(this).on('click',function(e){
				$(this).siblings().removeClass('is-active');
				$(this).addClass('is-active');
				$(this).parent().siblings('.theme-subpanes').find('.theme-subpane').removeClass('is-active').eq(i).addClass('is-active');
			});
		});
	});
	theme.init();
});