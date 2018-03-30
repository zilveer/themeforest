(function($) {

	"use strict"; // Start of use strict

	// 01. BROWSER AGENT FUNCTION		
	//==================================================================================
	
	// 01.1 Check Chrome (Mobile / Tablet)
	var isChromeMobile = function isChromeMobile() {
		if (device.tablet() || device.mobile()) {
			if (window.navigator.userAgent.indexOf("Chrome") > 0 || window.navigator.userAgent.indexOf("CriOS") > 0){
				return 1;
			}
		}
	}
	
	// 01.2 Check IOS
	var isIOS = function isIOS() {
		if (window.navigator.userAgent.indexOf("iPhone") > 0 || window.navigator.userAgent.indexOf("iPad") > 0 || window.navigator.userAgent.indexOf("iPod") > 0){
			return 1;
		}
	}
	
	// 01.3 Check FIREFOX 
	var is_firefox = function is_firefox() {
		if (navigator.userAgent.toLowerCase().indexOf('firefox') > -1){
			return 1;
		}
	}
	
	// 01.4 Check IE (< IE10)
	var isIE = function isIE() {
 		if (window.navigator.userAgent.indexOf("MSIE ") > 0 || !!navigator.userAgent.match(/Trident\/7\./)) {
   		 	return 1;
		}
	}
	
	// 01.5 Check IE11
	var isIE11 = function isIE11() {	
 		if (!!navigator.userAgent.match(/Trident\/7\./)) {
   		 	return 1;
		}
	}
	
	// 01.6 Check IE11 (Not Windows Phone)
	var isIE11desktop = function isIE11desktop() {	
 		if (!!navigator.userAgent.match(/Trident\/7\./) && window.navigator.userAgent.indexOf("Windows Phone") < 0) {
   		 	return 1;
		}
	}
	
	// 01.7 Check IE10
	var isIE10 = function isIE10() {
 		if (window.navigator.userAgent.indexOf("MSIE 10.0") > 0) {
   		 	return 1;
		}
	}
	
	// 01.8 Check IE9
	var isIE9 = function isIE9() {
 		if (window.navigator.userAgent.indexOf("MSIE 9.0") > 0) {
   		 	return 1;
		}
	}
	
	// 01.9 Check Safari/Chrome Mac
	var isSafari = function isSafari() {
	 	if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Mac') != -1) {
   		 	return 1;
		}
	}

	/*Ajax Form*/
	if($("form[data-fw-form-id]").length) {
		fwForm.initAjaxSubmit({
			selector: 'form[data-fw-form-id][data-fw-ext-forms-type="contact-forms"]',
		});
	}

	// 02. Sliders		
	//==================================================================================
	// 02.1 3d Intro


	// 02.2 Parallax Effect
	if( !device.tablet() && !device.mobile() && !isIE9() ) {
		$("*[data-stellar-background-ratio]").css("background-attachment","fixed");
	 	$(window).stellar({
		 	horizontalScrolling: false,
			responsive: true,
	 	});
	 }

	

	// 02.4 OWL Carousel in Intro
	$(".idy_intro_owl_slider").owlCarousel({
 		navigation : true, 
 		responsive: true, 
 		responsiveRefreshRate : 200, 
 		responsiveBaseElement:window, 
 		slideSpeed : 200, 
 		addClassActive:true,
		paginationSpeed : 200, 
		rewindSpeed : 200, 
		singleItem:true, 
		autoplay : true, 
		touchDrag:false,
		transitionStyle:"fade",
	});

	// 02.4.2 OWL Carousel in Gallery
	$(".idy_gallery").owlCarousel({
 		dots : true,
 		slideBy: 1,
 		addClassActive:true,
		autoplay : true,
		stagePadding:50,
		loop:true,
		touchDrag:true,
		center:true,
		responsive : {
		    0 : {
		        items:1,
		    },
		    480 : {
		        items:2,
		    },
		    768 : {
		        items:2,
		    },
		    920 : {
		        items:3,
		    }
		},
	});

	// 02.3.2 OWL Carousel in About Block
	$(".idy_ab_slider").owlCarousel({
 		dots : false, 
 		addClassActive:true,
		autoplay : true,
		autoplayTimeout:1000,
		autoplayHoverPause:true,
		loop:true,
		touchDrag:true,
		center:true,
		items:1,
		animateOut: 'fadeOut'
	});

	// 02.3.3 OWL Carousel in Great Slider
	$(".idy_great_slider").owlCarousel({
		autoplay : true,
		autoplayHoverPause:false,
		loop: true,
		items:1,
		animateOut: 'fadeOut'
	});

	// 02.3.4 OWL Carousel in Slider
	$(".idy_slider").owlCarousel({
 		dots : true, 
 		addClassActive:true,
		autoplay : true,
		items:4,
		loop: true, 
		touchDrag:true,
		responsive : {
		    0 : {
		        items:1,
		    },
		    480 : {
		        items:2,
		    },
		    768 : {
		        items:2,
		    },
		    920 : {
		        items:3,
		    }
		}
	});

	// 02.3.5 OWL Carousel in Blog
	$(".idy_blog").owlCarousel({
 		dots : true, 
		autoplay : true,
		slideBy: 1,
		loop: true, 
		touchDrag:true,
		responsive : {
		    0 : {
		        items:1,
		    },
		    480 : {
		        items:2,
		    },
		    768 : {
		        items:2,
		    },
		    920 : {
		        items:3,
		    }
		}
	});

	// 02.5 Parallax
	if( !device.tablet() && !device.mobile() && !isIE9() ) {
		var s = skrollr.init({
			forceHeight: false
		});
	}


	// 03. Header		
	//==================================================================================
	// 03.1 Menu Links
	$('.idy_top_menu a[href=\\#], .idy_mobile_menu_content a[href=\\#]').on("click", function(e){
		e.preventDefault();
	});

	// 03.2 Top Menu
	$('.idy_top_menu').each(function(){
		var menu_items = $(this).find('ul.menu').children().length;
		var menu_item_middle = Math.ceil(menu_items/2);
		var menu_items_li = $(this).find('ul.menu').children();
		for (var i=0; i<menu_items_li.length; i=i+menu_item_middle) {
			menu_items_li.slice(i,i+menu_item_middle).wrapAll('<div class="idy_top_menu_ul"></div>');
		}
		$(this).find('li.menu-item-has-children, li.page_item_has_children').on({
			mouseenter:function(){
				$(this).find('> ul').stop().slideDown('fast');
			},
			mouseleave:function(){
				$(this).find('> ul').stop().slideUp('fast');
			}
		});
	})
	/* Top Menu Click to Section */
	$('.idy_mobile_menu_content a[href*=\\#]:not([href=\\#])').on("click", function(){
		$(".idy_mobile_menu").trigger('click');
		$('.idy_mobile_menu_content a[href*=\\#]:not([href=\\#])').removeClass('active');
		$(this).addClass('active');
		
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') 
	        || location.hostname == this.hostname) {

	        var target = $(this.hash);
	        target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
	           if (target.length) {
	             $('html,body').animate({
	                 scrollTop: target.offset().top
	            }, 1000);
	            return false;
	        }
	    }
	});

	// 03.3 Mobile Menu Button
	$('.idy_mobile_menu').on("click", function(e){
		$(this).toggleClass('idy_mobile_menu_open');
		$('.idy_mobile_menu_content').parents('.idy_header_menu').toggleClass('idy_mobile_menu_content_open');
		e.preventDefault();
	});

	// 03.4 Mobile Menu Links
	var i = 0;
	$('.idy_mobile_menu_content ul:not(ul.sub-menu) > li').each(function(){
		$(this).css('transition-delay','0.'+i+'s');
		i++;
	});
	$('.idy_mobile_menu_content .menu-item-has-children > a, .idy_mobile_menu_content .page_item_has_children > a').on("click", function(e){
		$(this).parents('li').siblings('li').find('ul').slideUp();
		$(this).parents('li').siblings('li').removeClass('active');
		$(this).next('ul').slideDown();
		$(this).parents('li').addClass('active');
		e.preventDefault();
	});

	// 03.5 Preloader
	$(window).load(function(){
		$(".idy_preloader").fadeOut("slow");
	})

	// 03.6 Content Wrapper
	if($('.fw-page-builder-content').length) {
		$('.fw-page-builder-content').attr('id','idy_main_section');
	}

	// 04. Other		
	//==================================================================================

	// 04.1 Scroll Effect
	$('.idy_go, .idy_onepage_menu a').on("click", function(e){
		var anchor = $(this);
		$('html, body').stop().animate({
			scrollTop: $(anchor.attr('href')).offset().top
		}, 1000);
		e.preventDefault();
	});

    // 04.2 Countdown
	$('.idy_countdown').each(function(){
		var year = $(this).attr('data-year');
		var month = $(this).attr('data-month');
		var day = $(this).attr('data-day');
		$(this).countdown({until: new Date(year,month-1,day)});

	});

	
	 // 04.4 Accomodation Mobile Blocks
	 if( device.mobile() && $(".idy_bg.fw-col-sm-6").length ) {
		$(".idy_bg.fw-col-sm-6").each(function(){
			$(this).parents('.fw-row').append(this);
		});
	 }

	// 04.5 Section Background
	$('.idy_image_bck').each(function(){
		var image = $(this).attr('data-image');
		var gradient = $(this).attr('data-gradient');
		var color = $(this).attr('data-color');
		var blend = $(this).attr('data-blend');
		var opacity = $(this).attr('data-opacity');
		var position = $(this).attr('data-position');
		if (image){
			$(this).css('background-image', 'url('+image+')');	
		}
		if (gradient){
			$(this).css('background-image', gradient);	
		}
		if (color){
			$(this).css('background-color', color);	
		}
		if (blend){
			$(this).css('background-blend-mode', blend);	
		}
		if (position){
			$(this).css('background-position', position);	
		}
		if (opacity){
			$(this).css('opacity', opacity);	
		}
	});

	// 04.6 Over
	$('.idy_over, .idy_head_bck').each(function(){
		var color = $(this).attr('data-color');
		var image = $(this).attr('data-image');
		var opacity = $(this).attr('data-opacity');
		var blend = $(this).attr('data-blend');
		if (color){
			$(this).css('background-color', color);	
		}
		if (image){
			$(this).css('background-image', 'url('+image+')');	
		}
		if (opacity){
			$(this).css('opacity', opacity);	
		}
		if (blend){
			$(this).css('mix-blend-mode', blend);	
		}
	});
	
	// 04.7 Anchor Scroll
	$(window).scroll(function(){
		if ($(window).scrollTop() > 200) {
			$('body').addClass('idy_open');
		}
		else {
			$('body').removeClass('idy_open');
		}
	});

	// 04.8 AutoHeight Blocks
	$('.idy_box_full').each(function(){
		setEqualHeight($(this).find('.simple_block'));
	});
	$('.idy_gallery').each(function(){
		setEqualHeight($(this).find('.col-md-4'));
	});
	$( window ).resize(function() {
		$('.idy_box_full').each(function(){
			setEqualHeight($(this).find('.simple_block'));
		});
		$('.idy_gallery').each(function(){
			setEqualHeight($(this).find('.col-md-4'));
		});
	});

	// 04.9 Gallery Lightbox
	$('.lightbox').magnificPopup({ 
	  type: 'image',
	  gallery:{
	    enabled:true
	  }
	});
	$('.video').magnificPopup({
	  type: 'iframe',
	  iframe: {
		  markup: '<div class="mfp-iframe-scaler">'+
		            '<div class="mfp-close"></div>'+
		            '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
		          '</div>', // HTML markup of popup, `mfp-close` will be replaced by the close button

		  patterns: {
		    youtube: {
		      index: 'youtube.com/', // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).

		      id: 'v=', // String that splits URL in a two parts, second part should be %id%
		      // Or null - full URL will be returned
		      // Or a function that should return %id%, for example:
		      // id: function(url) { return 'parsed id'; } 

		      src: 'http://www.youtube.com/embed/%id%?autoplay=1' // URL that will be set as a source for iframe. 
		    },
		    vimeo: {
		      index: 'vimeo.com/',
		      id: '/',
		      src: 'http://player.vimeo.com/video/%id%?autoplay=1'
		    },
		    gmaps: {
		      index: '//maps.google.',
		      src: '%id%&output=embed'
		    }

		    // you may add here more sources

		  },

		  srcAction: 'iframe_src', // Templating object key. First part defines CSS selector, second attribute. "iframe_src" means: find "iframe" and set attribute "src".
		}  
	  
	});

	// 04.10 FireFly in Intro
	if($('.idy_firefly').length) {
		$.firefly({
			color: '#fff', minPixel: 1, maxPixel: 3, total : 55, on: '.idy_firefly'
		});
	}


	

	// 04.11 Boxes AutoHeight
	function setEqualHeight(columns)
	{
		var tallestcolumn = 0;
		columns.each(
			function()
			{
				$(this).css('height','auto');
				var currentHeight = $(this).height();
				if(currentHeight > tallestcolumn)
					{
					tallestcolumn = currentHeight;
					}
			}
		);
	columns.height(tallestcolumn);
	}

	// 04.12 Music Player
	$('.idy_music_ico').on('click',function(){
		$(this).find('.idy_music_container').fadeToggle();
	});

})(jQuery);



