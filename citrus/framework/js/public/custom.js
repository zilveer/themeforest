jQuery.noConflict();
jQuery(document).ready(function($){
	
	"use strict";
	
	var isMobile = (navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)) || (navigator.userAgent.match(/iPad/i)) || (navigator.userAgent.match(/Android/i)) || (navigator.userAgent.match(/Blackberry/i)) || (navigator.userAgent.match(/Windows Phone/i)) ? true : false;
	var currentWidth = window.innerWidth || document.documentElement.clientWidth;
	
	/* Sticky Header */
	var default_offset = 0;
	if(mytheme_urls.stickynav === "enable" && !isMobile && currentWidth > 767) {
		$("#header-wrapper").sticky({ topSpacing: 0 });
		var default_offset = 85;
	}

	$('.portfolio-load-more').css({"cursor":"pointer"});
	$('.blog-load-more').css({"cursor":"pointer"});
	
	$('.top-content .scroll-down a').click(function(e){
		$.scrollTo($('.top-content .scroll-down a').attr('href'), 1400, { offset: { top: -85 }});
		e.preventDefault();
	});
	
	if($('body').hasClass('page-template-tpl-onepage-php')) {
		$('.dt-global-home a:first, .dt-vertical-menu .dt-global-home a:first').click(function(e){
			$.scrollTo('#'+$('.top-content').attr('id'), 1400);
			e.preventDefault();
		});
	}
	
	/* Navigation Section */
	if(!isMobile && currentWidth > 767) {

		if(mytheme_urls.header_styles == 'type1') {
			
			if($('.top-content').length > 0) {
				var menu = $('#header3');
				$(window).scroll(function () {
					var y = $(this).scrollTop();
					var homeH = $('.top-content').outerHeight();
					var headerH = $('#header3').outerHeight();
					var z = $('.top-content').offset().top + homeH - headerH;
					if (y >= z) {
						menu.removeClass('first-nav').addClass('second-nav');
					}
					else{
						menu.removeClass('second-nav').addClass('first-nav');
					}
				});
			}
			
		} else if(mytheme_urls.header_styles == 'type2' || mytheme_urls.header_styles == 'type3') {
			
			$.slidebars();	
			
		} else if(mytheme_urls.header_styles == 'type4' || mytheme_urls.header_styles == 'type5') {
			
			if(mytheme_urls.stickynav === "enable")
				var nav_offset = -85;
			else
				var nav_offset = 40;
				
			$('.dt-vertical-menu li:first').addClass('current_page_item');
			$('.dt-vertical-menu li a').click(function() {
				if(!$(this).hasClass('external') && !$(this).parents('li').hasClass('dt-global-home')) {
					$('.dt-vertical-menu li').removeClass('current_page_item');
					$.scrollTo($(this).attr('href'), 1400, { offset: { top: nav_offset }});
					$(this).parents('li').addClass('current_page_item');
				}
				if($(this).parents('li').hasClass('dt-global-home')) {
					$('.dt-vertical-menu li').removeClass('current_page_item');
					$(this).parents('li').addClass('current_page_item');
				}
			});	
			
			$('.dt-vertical-menu-nav nav#main-menu li a').click(function () {
				$('#tiptip_holder').hide();
			});
			
			var href_tag = ''; var href_alert = 1;
			$(window).scroll(function () {
				$("#header .container nav#main-menu li").each(function() {
					if($(this).hasClass('current_page_item')) {
						if(href_tag == $(this).find('a').attr('href')) {
							href_alert = -1;
						} else {
							href_tag = $(this).find('a').attr('href');
							href_alert = 1;
						}
					}
				});
				if(href_tag != '' && href_alert != -1) {
					$("#header .dt-vertical-menu-nav nav#main-menu li").removeClass('current_page_item');
					$("#header .dt-vertical-menu-nav nav#main-menu li").each(function() {
						if($(this).find('a').attr('href') == href_tag) {
							$(this).addClass('current_page_item');
						}
					});
				}
			});
				
		} else if(mytheme_urls.header_styles == 'type6') {
		
			//TOGGLE PANEL...
			$("#toggle-panel").click(function(){
				if($('#toggle i').hasClass('fa-minus')) {
					$('#toggle i').removeClass('fa-minus');
					$('#toggle i').addClass('fa-plus');
				} else {
					$('#toggle i').removeClass('fa-plus');
					$('#toggle i').addClass('fa-minus');
				}
		
				$("#header .container").slideToggle("medium");
				return false;
			}); 
		
		} else if(mytheme_urls.header_styles == 'type7') {
			
			var headerH = $('#header').height();
			$(document).bind('ready scroll', function() {
				var docScroll = $(document).scrollTop();
				if($('#header').hasClass('dt-menuoverslider') && docScroll >= headerH) {
					if (!$('#header').hasClass('header-animate')) {
						$('#header').addClass('header-animate').css({ top: '-100px' }).stop().animate({ top: 0 }, 500);
					}
				} else {
					$('#header').removeClass('header-animate').removeAttr('style');
				}
			});
			
		}
		
	} else{
		
		$('header').attr('id', 'header');
		$('header').attr('class', '');
		$("div.sb-toggle-left.navbar-left").remove();
		$("div.sb-toggle-right.navbar-right").remove();
		$('div#menu-container').attr('class', '');
		
	}
	
	/* One page navigation */
	$('#main-menu').onePageNav({
		currentClass : 'current_page_item',
		filter		 : ':not(.external)',
		scrollSpeed  : 750,
		scrollOffset : default_offset
	});
	
	/* Mean Menu for Mobile */
	$('nav#main-menu').meanmenu({
		meanMenuContainer :  $('#menu-container'),
		meanRevealPosition:  'right',
		meanScreenWidth   :  767
	});
	
	var isMacLike = navigator.platform.match(/(Mac|iPhone|iPod|iPad)/i)?true:false;
	if( mytheme_urls.scroll === "enable" && !isMacLike ) {
		jQuery("html").niceScroll({zindex:99999,cursorborder:"1px solid #424242"});
	}

	/* Goto Top */
	$().UItoTop({ easingType: 'easeOutQuart' });
	
	//Portfolio Single page Slider
	if( ($(".portfolio-slider").length) && ($(".portfolio-slider li").length > 1) ) {
		$('.portfolio-slider').bxSlider({ 
		auto:false, useCSS:false, autoHover:true, adaptiveHeight:true });
	}//Portfolio Single page Slider
	
	
	/* PrettyPhoto For Portfolio */
	if($(".gallery").length) {
		$(".gallery a[data-gal^='prettyPhoto']").prettyPhoto({hook:'data-gal', animation_speed:'normal',theme:'light_square',slideshow:3000, autoplay_slideshow: false,social_tools: false,deeplinking:false});		
	}
	
    if( ($("ul.entry-gallery-post-slider").length) && ( $("ul.entry-gallery-post-slider li").length > 1 ) ){
	  	$("ul.entry-gallery-post-slider").bxSlider({auto:false, video:true, useCSS:false, pager:'', autoHover:true, adaptiveHeight:true});
    }	
	
	
	if( $(".apply-isotope").length ){
		$(".apply-isotope").each(function(){
			if( $('#primary').hasClass('page-with-both-sidebar') ) var $gw = 12; else var $gw = 15;
			$(this).isotope({itemSelector : '.column',transformsEnabled:false,masonry: { gutterWidth: $gw} });
		});
	}

	//Smart Resize Start
	$(window).smartresize(function(){
		/* Blog Template Isotope */
		if( $(".apply-isotope").length ){
			$(".apply-isotope").each(function(){
				if( $('#primary').hasClass('page-with-both-sidebar') ) var $gw = 12; else var $gw = 15;
				$(this).isotope({itemSelector : '.column',transformsEnabled:false,masonry: { gutterWidth: $gw} });
			});
		}
		
	});//Smart Resize End
	
	//Window Load Start
	$(window).load(function(){
		
		/* Blog Template Isotope */
		if( $(".apply-isotope").length ){
			$(".apply-isotope").each(function(){
				if( $('#primary').hasClass('page-with-both-sidebar') ) var $gw = 12; else var $gw = 15;
				$(this).isotope({itemSelector : '.column',transformsEnabled:false,masonry: { gutterWidth: $gw} });
			});
		}
		
		var $container = $('.portfolio-container');
		if( $container.length) {
			
			if( $('#primary').hasClass('page-with-both-sidebar') ) var $gw = 15; else var $gw = 18;
			var $width = $container.hasClass("no-space") ? 0 : $gw;

			$(window).smartresize(function(){
				$container.css({overflow:'hidden'}).isotope({itemSelector : '.column',masonry: { gutterWidth: $width } });
			});
			
			$container.isotope({
			  filter: '*',
			  masonry: { gutterWidth: $width },
			  animationOptions: { duration: 750, easing: 'linear', queue: false  }
			});
			
		}

		if($("div.sorting-container").length){
			$("div.sorting-container a").click(function(){
				if( $('#primary').hasClass('page-with-both-sidebar') ) var $gw = 15; else var $gw = 18;
				var $width = $container.hasClass("no-space") ? 0 : $gw;				
				$("div.sorting-container a").removeClass("active-sort");
				var selector = $(this).attr('data-filter');
				$(this).addClass("active-sort");
				$container.isotope({
					filter: selector,
					masonry: { gutterWidth: $width },
					animationOptions: { duration:750, easing: 'linear',  queue: false }
				});
			return false;	
			});
		}

		$("ul.products li .product-wrapper").each(function(){
			var liHeight = $(this).height(); 
			$(this).css("height", liHeight);
	  	});

	});//Window Load End
		
	
	$('.portfolio-load-more').click(function(){
		
		if(!$(this).hasClass('disable_click')) {
			var postid = $(this).attr('data-postid'),
				postperpage = $(this).attr('data-post-per-page'),
				page = $(this).attr('data-page'),
				pagelayout = $(this).attr('data-page-layout'),
				tax = $(this).attr('data-taxonomy'),
				more_text = $(this).html();
				
			$.ajax({
				type: "POST",
				url : mytheme_urls.ajaxurl,
				data:
				{
					action: "dt_ajax_load_portfolio_posts",
					postid: postid,
					postperpage: postperpage,
					page: page,
					pagelayout: pagelayout,
					tax: tax,
				},
				beforeSend: function(){
					$('.portfolio-load-more').html('Loading...');
				},
				error: function (xhr, status, error) {
					$('.portfolio-load-more').html('No More Posts to Show!');
				},
				success: function (response) {
					if(response == 'NoData') {
						$('.portfolio-load-more').html('No More Posts to Show!');
						$('.portfolio-load-more').addClass('disable_click');
						$('.portfolio-load-more').css({"cursor":"default"});
					} else {
						$('.portfolio-container').append(response);
						page = parseInt(page)+1;
						$('.portfolio-load-more').attr('data-page', page)
						$('.portfolio-container').isotope( 'reloadItems' ).isotope();
						$(window).trigger( 'resize' );	
						$('.portfolio-load-more').html(more_text);
						if($(".gallery").length) {
							$(".gallery a[data-gal^='prettyPhoto']").prettyPhoto({hook:'data-gal', animation_speed:'normal',theme:'light_square',slideshow:3000, autoplay_slideshow: false,social_tools: false,deeplinking:false});		
						}
					}
				},
			});
			//Isotope relayout...
			setTimeout(function() {
				$('.portfolio-container').isotope('reLayout');
			}, 3000);
			
		}
		
	});
		
		
	$('.blog-load-more').click(function(){
		
		if(!$(this).hasClass('disable_click')) {
			var postid = $(this).attr('data-postid'),
				page = $(this).attr('data-page'),
				more_text = $(this).html();

			$.ajax({
				type: "POST",
				url : mytheme_urls.ajaxurl,
				data:
				{
					action: "dt_ajax_load_blog_posts",
					postid: postid,
					page: page,
				},
				beforeSend: function(){
					$('.blog-load-more').html('Loading...');
				},
				error: function (xhr, status, error) {
					$('.blog-load-more').html('No More Posts to Show!');
				},
				success: function (response) {
					if(response == 'NoData') {
						$('.blog-load-more').html('No More Posts to Show!');
						$('.blog-load-more').addClass('disable_click');
						$('.blog-load-more').css({"cursor":"default"});
					} else {
						$('.blog-items').append(response);
						page = parseInt(page)+1;
						$('.blog-load-more').attr('data-page', page)
						$('.blog-items').isotope( 'reloadItems' ).isotope();
						if($(".blog-items ul.entry-gallery-post-slider").attr('style') === undefined ) {
							$(".blog-items ul.entry-gallery-post-slider").bxSlider({auto:false, video:true, useCSS:false, pager:'', autoHover:true, adaptiveHeight:true});
						}
						$('.wp-video').css('width', '100%');
						$('.wp-video').css('height', '100%');
						$("div.dt-video-wrap").fitVids();
						$('audio').attr('style', 'visibility: visible');
						$('audio source').attr('style', 'visibility: visible');
						$(window).trigger( 'resize' );
						$('.blog-load-more').html(more_text);
						if( ($("ul.entry-gallery-post-slider").length) && ( $("ul.entry-gallery-post-slider li").length > 1 ) ){
							$("ul.entry-gallery-post-slider").bxSlider({auto:false, video:true, useCSS:false, pager:'', autoHover:true, adaptiveHeight:true});
						}	
					}
				},
			});
			//Isotope relayout...
			setTimeout(function() {
				$('.blog-items').isotope('reLayout');
			}, 3000);
		}
	});

	//Parallax Sections...
	jQuery('.dt-sc-breadcrumb-parallax').each(function(){
		jQuery(this).bind('inview', function (event, visible) {
			if(visible == true) {
				jQuery(this).parallax("0%", 0);
			} else {
				jQuery(this).css('background-position','');
			}
		});
	});	
		
	$('.wp-video').css('width', '100%');
	$('.wp-video-shortcode').css('width', '100%');
	$('.wp-video-shortcode').css('height', '100%');
	$("div.dt-video-wrap").fitVids();

	$("select").each(function(){
		if($(this).css('display') != 'none') {
			$(this).wrap( '<div class="selection-box"></div>' );
		}
	});
		
});

		
//MeanMenu Custom Scroll...
function funtoScroll(x, e) {
	"use strict";
	var str = new String(e.target);
	var pos = str.indexOf('#');
	var t = str.substr(pos);
	
	var eleclass = jQuery(e.target).prop("class");
	
	if(eleclass == "external") {
		window.location.href = e.target;	
	} else {
		jQuery.scrollTo(t, 750, { offset: { top: -53 }});
	}
	
	jQuery(x).parent('.mean-bar').next('.mean-push').remove();		
	jQuery(x).parent('.mean-bar').remove();

	jQuery('nav#main-menu').meanmenu({
		meanMenuContainer :  jQuery('#menu-container'),
		meanRevealPosition:  'right',
		meanScreenWidth   :  767	
	});
	
	e.preventDefault();
}(jQuery);