jQuery(document).ready(function(){

	var is_mobile = false;
	if( navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i)
		|| navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i)
		|| navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) ){
		is_mobile = true;
	}

	var header_area = jQuery('.header-wrapper').filter(':first');
	var navigation_area = jQuery('.navigation-wrapper').filter(':first');

	// Menu Navigation
	navigation_area.css('display','block');
	navigation_area.find('#main-superfish-wrapper ul.sf-menu').supersubs({
		minWidth: 14.5, maxWidth: 27, extraWidth: 3
	}).superfish({
		delay: 400, speed: 'fast', animation: {opacity:'show',height:'show'}, 
		onInit: function(){ navigation_area.css('display', 'none'); }
	});
	
	// Scroll Navigation
	jQuery(window).scroll(function(){
		var cur_pos = jQuery(this).scrollTop();
		var header_height = header_area.outerHeight();
		
		if( cur_pos > header_height ){
			navigation_area.slideDown(200);		
		}else{
			navigation_area.slideUp(200);	
		}
	});
	
	// Init the submenu height
	jQuery('.header-navigation-wrapper').each(function(){
		var header_nav = jQuery(this).children('.header-navigation');
		var height = 0;
		var bottom_margin = 0;
		header_nav.each(function(){
			if( jQuery(this).children('ul').height() > height ){
				height = jQuery(this).children('ul').height();
				bottom_margin = parseInt(jQuery(this).children('ul').css("margin-bottom").replace("px", ""));
			}
		});

		header_nav.children('ul').children('li').children('ul').css('min-height', height + bottom_margin - 6 );
	});
	
	// Header Menu Scroll
	if( is_mobile ){
		jQuery('.header-navigation a').click(function(){
			var sub_menu = jQuery(this).siblings('ul.sub-menu');
			if( sub_menu.length > 0 && !jQuery(this).hasClass('clicked') ){
				jQuery(this).addClass('clicked');
				return false;
			}
		});
	}
	jQuery('.header-navigation ul li').hoverIntent({
		over: 
			function(){
				var parent_width = jQuery(this).outerWidth();
				jQuery(this).children('ul').css('left', parent_width).delay(100).fadeIn(200); 
			},
		timeout: 100, 	
		out: 
			function(){
				jQuery(this).children('ul').css('display', 'none');
			}
	});
	
	// Search Default text
	jQuery('.search-text input').live("blur", function(){
		var default_value = jQuery(this).attr("data-default");
		if (jQuery(this).val() == ""){
			jQuery(this).val(default_value);
		}	
	}).live("focus", function(){
		var default_value = jQuery(this).attr("data-default");
		if (jQuery(this).val() == default_value){
			jQuery(this).val("");
		}
	});	

	// Social Hover
	jQuery("#gdl-social-icon .social-icon").hover(function(){
		jQuery(this).animate({ opacity: 1 }, 150);
	}, function(){
		jQuery(this).animate({ opacity: 0.6 }, 150);
	});
	
	// Accordion
	var gdl_accordion = jQuery('ul.gdl-accordion');
	gdl_accordion.find('li').not('.active').each(function(){
		jQuery(this).children('.accordion-content').css('display', 'none');
	});
	gdl_accordion.find('li').click(function(){
		if( !jQuery(this).hasClass('active') ){
			jQuery(this).addClass('active').children('.accordion-content').slideDown();
			jQuery(this).siblings('li').removeClass('active').children('.accordion-content').slideUp();
		}
	});
	
	// Toggle Box
	var gdl_toggle_box = jQuery('ul.gdl-toggle-box');
	gdl_toggle_box.find('li').not('.active').each(function(){
		jQuery(this).children('.toggle-box-content').css('display', 'none');
	});
	gdl_toggle_box.find('li').click(function(){
		if( jQuery(this).hasClass('active') ){
			jQuery(this).removeClass('active').children('.toggle-box-content').slideUp();
		}else{
			jQuery(this).addClass('active').children('.toggle-box-content').slideDown();
		}
	});	
	
	// Tab
	var gdl_tab = jQuery('div.gdl-tab');
	gdl_tab.find('li a').click(function(e){
		if( jQuery(this).hasClass('active') ) return;
		
		var data_tab = jQuery(this).attr('data-tab');
		var tab_title = jQuery(this).parents('ul.gdl-tab-title');
		var tab_content = tab_title.siblings('ul.gdl-tab-content');
		
		// tab title
		tab_title.find('a.active').removeClass('active');
		jQuery(this).addClass('active');
		
		// tab content
		tab_content.find('li.active').removeClass('active').css('display', 'none');
		tab_content.find('li[data-tab="' + data_tab + '"]').fadeIn().addClass('active');
		
		e.preventDefault();
	});
	
	// Scroll Top
	jQuery('div.scroll-top').click(function() {
		jQuery('html, body').animate({ scrollTop:0 }, { duration: 600, easing: "easeOutExpo"});
		return false;
	});
	
	// Blog Hover
	jQuery(".blog-media-wrapper.gdl-image img, .port-media-wrapper.gdl-image img, .gdl-gallery-image img").hover(function(){
		jQuery(this).animate({ opacity: 0.55 }, 150);
	}, function(){
		jQuery(this).animate({ opacity: 1 }, 150);
	});
	
	// Port Hover
	jQuery(".portfolio-item .portfolio-media-wrapper.gdl-image .thumbnail-hover").hover(function(){
		jQuery(this).animate({ opacity: 1 }, 200);
		jQuery(this).children().animate({ opacity: 1 }, 200);
	}, function(){
		jQuery(this).animate({ opacity: 0 }, 300);
		jQuery(this).children().animate({ opacity: 0 }, 300);
	});
	
	// Search Box
	var search_button = jQuery("#gdl-search-button");
	search_button.click(function(){
		if(jQuery(this).hasClass('active')){
			jQuery(this).removeClass('active');
			jQuery(this).siblings('.search-wrapper').slideUp(200);
		}else{
			jQuery(this).addClass('active');
			jQuery(this).siblings('.search-wrapper').slideDown(200);
		}
		return false;
	});
	jQuery("#gdl-search-button, .search-wrapper").click(function(e){
		if (e.stopPropagation){ e.stopPropagation();
		}else if(window.event){ window.event.cancelBubble = true; }
	});
	jQuery(document).click(function(){
		search_button.removeClass('active');
		search_button.siblings('.search-wrapper').slideUp(200);			
	});	
	
	// JW Player Responsive
	responsive_jwplayer();
	function responsive_jwplayer(){
		jQuery('[id^="jwplayer"][id$="wrapper"]').each(function(){
			var data_ratio = jQuery(this).attr('data-ratio');
			if( !data_ratio || data_ratio.length == 0 ){
				data_ratio = jQuery(this).height() / jQuery(this).width();
				jQuery(this).css('max-width', '100%');
				jQuery(this).attr('data-ratio', data_ratio);
			}
			jQuery(this).height(jQuery(this).width() * data_ratio);
		});
	}
	jQuery(window).resize(function(){
		responsive_jwplayer();
	});

});
jQuery(window).load(function(){

	// Center the portfolio context
	function set_portfolio_context_position(){
		jQuery('div.portfolio-context').each(function(){
			var height = jQuery(this).height() -14;
			jQuery(this).css('margin-top', -(height/2));
		});
	}
	set_portfolio_context_position();

	// Personnal Item Height
	function set_personnal_height(){
		jQuery(".personnal-item-holder .row").each(function(){
			var max_height = 0;
			jQuery(this).find('.personnal-item').height('auto');
			jQuery(this).find('.personnal-item-wrapper').each(function(){
				if( max_height < jQuery(this).height()){
					max_height = jQuery(this).height();
				}
			});
			jQuery(this).find('.personnal-item').height(max_height);
		});		
	}
	set_personnal_height();
	
	// Price Table Height
	function set_price_table_height(){
		jQuery(".price-table-wrapper .row").each(function(){
			var max_height = 0;
			jQuery(this).find('.best-price').removeClass('best-active');
			jQuery(this).find('.price-item').height('auto');
			jQuery(this).find('.price-item-wrapper').each(function(){
				if( max_height < jQuery(this).height()){
					max_height = jQuery(this).height();
				}
			});
			jQuery(this).find('.price-item').height(max_height);
			jQuery(this).find('.best-price').addClass('best-active');
		});		
	}	
	set_price_table_height();
	
	// set the page header gimmick
	function set_page_header(){
		jQuery('.gdl-header-wrapper').each(function(){
			var temp_height = jQuery(this).children('.gdl-header-title').height();
			var temp_width = jQuery(this).width() - jQuery(this).children('.gdl-header-title').width();
			
			if( temp_width > 0 ){ 
				jQuery(this).children('.gdl-header-gimmick').css({ 'width': temp_width / 2, 'height': temp_height});
			}else{
				jQuery(this).children('.gdl-header-gimmick').css({ 'width': '0px'});
			}			
		});
	}
	set_page_header();
	
	// When window resize, set all function again
	jQuery(window).resize(function(){
		set_portfolio_context_position()	
		set_personnal_height();
		set_price_table_height();
		set_page_header();
	});	
	
});