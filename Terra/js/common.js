// Bind the possible Add to Cart btns with event to position top links
jQuery(document).ready(function($){

	// MENU LOGIC - Customize to keep HTML logic the same
	$('#menu .sub-menu').not('#menu .sub-menu .sub-menu').before('<span class="nav_arrow"></span>');
	$('#menu .sub-menu').wrap('<div/>');
	$('#menu .sub-menu li a').wrapInner('<span/>');
	$('#menu .sub-menu > li:last-child > a').addClass('last_submenu_item');
	
	$('#menu .sub-menu > li > div').addClass('subsub_menu');

	$('#menu .children').prev().append('<span></span>');
	$('#menu .children').wrap('<div/>');
	$('#menu .children li a').wrapInner('<span/>');
	$('#menu .children > li:last-child > a').addClass('last_submenu_item');
	
	$('#menu .children > li > div').addClass('subsub_menu');
	
	
	$('#menu .subsub_menu > ul > li > div').removeClass('subsub_menu').addClass('subsubsub_menu');
	$('#menu .subsubsub_menu > ul > li > div').addClass('subsubsub_menu');
	// MENU LOGIC :: END
	
	// Sidebar Menu 
	$('#sidebar .widget_categories > ul, #sidebar .widget_nav_menu  > div > ul, #sidebar .widget_pages ul:first, #sidebar .widget_meta ul, #sidebar .widget_recent_entries ul').addClass('side_bar_menu');
	$('#sidebar ul.side_bar_menu a').wrapInner('<span class="link_span"/>');

	$('.more-link').before('<p></p>');
	$('.more-link').wrap('<p/>');

	
	// Top Comment class
	$('.single_comment:first').addClass('first_comment');
	
	// Footer Navigation pushoff
	$('#footer .menu').addClass('margined_left');
	$('#footer .menu').parent().prev('h3').addClass('margined_left');
	
	
	// Menu Animation
    $('#menu ul li').hover(
        function() {
            $(this).addClass("active");
            $(this).find('div').not('.subsub_menu, .subsubsub_menu').stop(false, true).slideDown({
            	duration:300,
            	easing:"easeOutExpo"});
        },
        function() {
            $(this).removeClass("active");
            $(this).find('div').not('.subsub_menu, .subsubsub_menu').stop(false, true).slideUp({
            	duration:100,
            	easing:"easeOutExpo"});
        }
    );

    
	// Sub Menu Animation
    $('#menu ul li li').hover(
        function() {
            $(this).find('.subsub_menu').stop(false, true).slideDown({
            	duration:300,
            	easing:"easeOutExpo"});
        },
        function() {        
            $(this).find('.subsub_menu').stop(false, true).hide();
        }
    );	
    
    // Subsub Menu Animation
    $('#menu ul li li li').hover(
    		function() {
    			$(this).find('.subsubsub_menu').stop(false, true).slideDown({
    				duration:300,
    				easing:"easeOutExpo"});
    		},
    		function() {        
    			$(this).find('.subsubsub_menu').stop(false, true).hide();
    		}
    );	
	

	
	// Sidebar Nav effects	
	$('.side_bar_nav a').not(".active").hover(
		function() {
			$(this).children('.hover_span').stop().animate({width:'100%'},500,'easeOutExpo');
		},
		function() {
			$(this).children('.hover_span').stop().animate({width:'0'},200,'easeOutExpo');
		}
	);



	// Header popup
	if (jQuery("#header_toggler").length){
		$('#header_toggler').bind('click', function() {
			if($('#hidden_header').css('display') == 'none'){
				$('#hidden_header').slideDown({duration:500,easing:"easeOutExpo"});
				$('.header_toggler_holder').addClass('header_toggler_holder_on');
	
				if($('#header_toggler').hasClass('header_toggler_off')){
					$('#header_toggler').removeClass('header_toggler_off').addClass('header_toggler_on');	
				}else{
					$('#header_toggler').removeClass('header_toggler_on').addClass('header_toggler_off');				
				}
	
			}else {
				$('#hidden_header').slideUp({duration:500,easing:"easeOutExpo"});
				$('.header_toggler_holder').removeClass('header_toggler_holder_on');
	
				if($('#header_toggler').hasClass('header_toggler_off')){
					$('#header_toggler').removeClass('header_toggler_off').addClass('header_toggler_on');	
				}else{
					$('#header_toggler').removeClass('header_toggler_on').addClass('header_toggler_off');				
				}
	
			}	
		});
	}
		
	/* Wrap h2 in big heading in a span */
	$('.section_big_title h2').each(function(){
		var has_span = $(this).has( "span" ).length ? true : false;
		if(!has_span){
			$(this).wrapInner('<span/>');
		}
	});
	
	/* Accordions */
	$(".acc_item").click(function(){
		
		$(this).siblings().children(".accordion_content").not($(this).find(".accordion_content")).slideUp(600,'easeInOutExpo');
		$(this).siblings().children(".accordion").not($(this).find(".accordion")).removeClass("active_acc");

		$(this).find(".accordion").next(".accordion_content").slideToggle(600,'easeInOutExpo');
		
		if($(this).find(".accordion").hasClass('active_acc')){
			$(this).find(".accordion").removeClass("active_acc");
		}else{
			$(this).find(".accordion").addClass("active_acc");
		}
	});
	
	// Open First item if accordion whenever set so
	setTimeout(function(){$(".acc_is_open").delay(1500).click();},600);	
	/* Accordions::END */
	
	
	/* Testimonials */
    $(".testimonials_carousel").each(function(){
    	var is_auto_scroll = $(this).hasClass('auto_scroll');
	    $(this).jcarousel({
	    	auto: (is_auto_scroll ? 6 : 0),
	    	wrap: (is_auto_scroll ? "last" : ""),
	    	scroll: 1,
	    	easing: "easeInOutExpo",
	    	animation: 600
	    });
    });   
    /* Testimonials::END */
	
	
	/* Info Messages */
	$(".closable").each(function(){
		$(this).prepend('<a class="close_img"></a>');		
	});
	
	$(".close_img").click(function(){
		$(this).parent().fadeOut(600);
	});
	
	
	
	// Tabs
	$('.tabs a').tabs();
	
	
	// Tooltips
	$('.tooltipsy').tipsy({fade: true, gravity: 's'});
	
	
	// Slider
	$(window).load(function(){
	    $('.flexslider').flexslider({
		      animation: "slide",
		      controlNav: false,
		      start: function(slider){
		    	  $('body').removeClass('loading');
		      }
	    });
	 });
    // PrettyPhoto
    $("a[rel^='prettyPhoto']").prettyPhoto({
		animation_speed:'normal',
		overlay_gallery: false,
		social_tools: false
	});
    
    
    
    // Animate logos fading
    var fading_logos = true;
	jQuery('.client_info img').hover(
		function() {
			if(typeof(fading_logos) != "undefined" && fading_logos){
				jQuery(this).parents('.client_info:first').siblings('.client_info').each(function (i, e) {
					jQuery(['-webkit-', '-moz-', '-o-', '-ms-', '']).each(function (i, p) {
						jQuery(e).css(p + 'transition-delay' , 0 + 'ms');
					});
				});
				jQuery(this).parents('.client_info:first').siblings('.client_info').stop().fadeTo(150, 0.4);
			}
		},
		function() {
			if(typeof(fading_logos) != "undefined" && fading_logos){
				jQuery(this).parents('.client_info:first').siblings('.client_info').stop().fadeTo(150, 1);
			}
		}	
	);
    

    
    // Animate icons fading
	jQuery('.header_soc_search a').hover(
		function() {
			jQuery(this).siblings('a').stop().fadeTo(100, 0.3);
			jQuery(this).stop().fadeTo(100, 1);
		},
		function() {
			jQuery(this).siblings('a').stop().fadeTo(100, 0.7);
			jQuery(this).stop().fadeTo(100, 0.7);
		}	
	);
     
    // Animate icons fading
	jQuery('.footer_btm_inner a').hover(
		function() {
			jQuery(this).siblings('a').stop().fadeTo(100, 0.35);
		},
		function() {
			jQuery(this).siblings('a').stop().fadeTo(100, 1);
		}	
	);   
    
    // Resize Videos
    jQuery(function() {
        
        var $allVideos = jQuery("iframe[src^='http://player.vimeo.com'], iframe[src^='http://www.youtube.com'], object, embed").not('.rev_slider iframe'),
        $fluidEl = jQuery(".video_max_scale");
    	    	
    	$allVideos.each(function() {
    	
    		jQuery(this)
    	    // jQuery .data does not work on object/embed elements
    	    .attr('data-aspectRatio', this.height / this.width)
    	    .removeAttr('height')
    	    .removeAttr('width');
    	
    	});
    	
    	jQuery(window).resize(function() {
    		
    	  $allVideos.each(function() {
  			
    		    var nWidth = $(this).parent().width();
    	    	var $el = jQuery(this);
    	    	$el
    	    	    .width(nWidth)
    	    	    .height(nWidth * $el.attr('data-aspectRatio'));
    	    	  
    	   });
    	
    	}).resize();

    });
    

	 // Reload carousels on window resize
	 if (jQuery(".testimonials_carousel").length){
	 	jQuery(window).resize(function() {
	 		 var el = jQuery(".testimonials_carousel"), carousel = el.data('jcarousel'), win_width = jQuery(window).width();
	 		   carousel.options.visible = 1;
	 		   carousel.options.scroll = 1;
	 		   carousel.reload();
	 	});
	 }

        
});

/* TABS */
jQuery.fn.tabs = function() {
	var selector = this;
	
	this.each(function() {
		var obj = jQuery(this); 
		
		jQuery(obj.attr('href')).hide();
		
		jQuery(obj).click(function() {

			jQuery(obj).siblings().removeClass('selected');
			jQuery(obj.attr('href')).siblings('.tab-content').hide();
			
			jQuery(this).addClass('selected');
			
			jQuery(jQuery(this).attr('href')).fadeIn();
			
			return false;
		});
	});

	jQuery(this).show();
	jQuery(this).parent().children('a:first-child').click();
};





//On Page load calculate dimensions of the Hover Info squares
jQuery(window).load(function(){
	   
	 jQuery('.type1 .info_overlay_padding').each(function(i,el){

		 var new_overlay_w = jQuery(el).parents('.pic_info:first').width() - 20;
		 var new_overlay_h = jQuery(el).parents('.pic_info:first').height() - 20;
		 
		 jQuery(el).css({'width':new_overlay_w,'height':new_overlay_h});
	 });		
	 
	 jQuery('a .img_overlay').each(function(i,el){
			
		 var new_overlay_w = jQuery(el).parents('.pic:first').width() - 12;
		 var new_overlay_h = jQuery(el).parents('.pic:first').height() - 12;
		 
		 jQuery(el).css({'width':new_overlay_w,'height':new_overlay_h});
	 });	 
	 
	 jQuery('a .img_overlay_zoom').each(function(i,el){
		 
		 var new_overlay_w = jQuery(el).parents('.pic:first').width() - 12;
		 var new_overlay_h = jQuery(el).parents('.pic:first').height() - 12;
		 
		 jQuery(el).css({'width':new_overlay_w,'height':new_overlay_h});
	 });
	 
	 jQuery('a .img_overlay_icon').each(function(i,el){
			
		 var new_overlay_w = jQuery(el).prev('img:first').width() - 12;
		 var new_overlay_h = jQuery(el).prev('img:first').height() - 12;
		 
		 jQuery(el).css({'width':new_overlay_w,'height':new_overlay_h});
	 });	 
});

//On resize recalculate dimensions of the Hover Info squares
jQuery(window).load(function(){
  jQuery(window).resize(function() {
	   
	 jQuery('.type1 .info_overlay_padding').each(function(i,el){

		 var new_overlay_w = jQuery(el).parents('.pic_info:first').width() - 20;
		 var new_overlay_h = jQuery(el).parents('.pic_info:first').height() - 20;
		 
		 jQuery(el).css({'width':new_overlay_w,'height':new_overlay_h});
	 });		
	 
	 jQuery('a .img_overlay').each(function(i,el){
			
		 var new_overlay_w = jQuery(el).parents('.pic:first').width() - 12;
		 var new_overlay_h = jQuery(el).parents('.pic:first').height() - 12;
		 
		 jQuery(el).css({'width':new_overlay_w,'height':new_overlay_h});
	 });

	 
	 jQuery('a .img_overlay_zoom').each(function(i,el){
		 
		 var new_overlay_w = jQuery(el).parents('.pic:first').width() - 12;
		 var new_overlay_h = jQuery(el).parents('.pic:first').height() - 12;
		 
		 jQuery(el).css({'width':new_overlay_w,'height':new_overlay_h});
	 });
	 
	 
	 jQuery('a .img_overlay_icon').each(function(i,el){
			
		 var new_overlay_w = jQuery(el).prev('img:first').width() - 12;
		 var new_overlay_h = jQuery(el).prev('img:first').height() - 12;
		 
		 jQuery(el).css({'width':new_overlay_w,'height':new_overlay_h});
	 });
	 
	 // Disable the transitions that mess up Live resizing (carousels + info Items etc)
	 jQuery('.info_block .info_item').each( function (i, e) {
		jQuery(['-webkit-', '-moz-', '-o-', '-ms-', '']).each(function (i, p) {
			jQuery(e).css(p + 'transition','0ms');
		});
	 });
	 
  });
});

// For appear transitions
jQuery.fn.trans = function () {
	var t = arguments[0],
		d = arguments[1] || '';
	if (t) {
		jQuery.each(this, function (i, e) {
			jQuery(['-webkit-', '-moz-', '-o-', '-ms-', '']).each(function (i, p) {
				jQuery(e).css(p + 'transition' + d, t);
			});
		});
	}
};	

function preloadImages(imgs, callback) {
	var cache = [],
		imgsTotal = imgs.length,
		imgsLoaded = 0;

	// If IE start off animations right away
	var ua = window.navigator.userAgent;
    var msie = ua.indexOf('MSIE ');	
	var trident = ua.indexOf('Trident/');
	
	if (msie > 0) {
        // IE 10 or older => return version number
        callback();
    }

    if (trident > 0) {
        // IE 11 (or newer) => return version number
        callback();
    }
		
	if(jQuery(imgs).length){
		jQuery(imgs).each(function (i, img) {
			var cacheImage = document.createElement('img');
			cacheImage.onload = function () {
				if (++imgsLoaded == imgsTotal) callback();
			};
			cacheImage.src = jQuery(img).attr('src');
			cache.push(cacheImage);
		});
	}else {
		callback();
	}
}