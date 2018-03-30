(function($) {





if(global.header_search != 'hide') {
$('#mega_main_menu_ul').append('<li class="nav-search"><i class="icons icon-search-1"></i></li>');
$('#main_menu_ul').append('<li class="nav-search"><i class="icons icon-search-1"></i></li>');
}









	
$(window).load(function(){

		/**
		* Fix Closes prettyPhoto.
		*/
		if( $.prettyPhoto ) {
		$.prettyPhoto.close = function(){
			if($pp_overlay.is(":animated")) return;

			$.prettyPhoto.stopSlideshow();

			$pp_pic_holder.stop().find('object,embed').css('visibility','hidden');

			$('div.pp_pic_holder,div.ppt,.pp_fade').fadeOut(settings.animation_speed,function(){ $(this).remove(); });

			$pp_overlay.fadeOut(settings.animation_speed, function(){

				//if(settings.hideflash) $('object,embed,iframe[src*=youtube],iframe[src*=vimeo]').css('visibility','visible'); // Show the flash

				$(this).remove(); // No more need for the prettyPhoto markup

				$(window).unbind('scroll.prettyphoto');

				//clearHashtag();

				//settings.callback();

				doresize = true;

				pp_open = false;

				delete settings;
			});
		};

		}









	var container_blog = document.querySelector('#container-blog');
	
	if(container_blog) {
		var msnry = new Masonry( container_blog, {
		  itemSelector: '.item'
		});
	}

	
	 // var container_product = document.querySelector('#container-product');
	
	 // if(container_product) {
		 // var msnry = new Masonry( container_product, {
		   // itemSelector: '.product'
		 // });
	 // }
	

         /* SearchBar Fadein Effect */
		var searchButton = $('.nav-search');
		var searchBar = $('#search-bar');
		
		
		
		searchButton.click(function(){
		
		
		
			if(searchBar.hasClass('searchbar-visible')){
				searchButton.removeClass('searchbar-visible');
				searchBar.animate({opacity:0, left:-200, right:200},200, function(){
					$(this).removeClass('searchbar-visible').hide();
				});
			}else{
				searchButton.addClass('searchbar-visible');
				searchBar.css('opacity', 0).css('left', -200).css('right',200).show().animate({opacity:1, left:0, right:1},300, function(){
					$(this).addClass('searchbar-visible');
					var config = {
						'.chosen-select-search' : {disable_search_threshold:10, width:'100%'}
					}
					for (var selector in config) {
					  $(selector).chosen(config[selector]);
					}
				});
			}
			
		});
			
});	








$(document).ready(function($){
	"use strict";
	
	var windowWidth = $(window).width();
	var windowHeight = $(window).height();
	
	
	
	
	$('.yith-similar-products').addClass('products-row row');
	$('.yith-similar-products h2').wrap('<div class="carousel-heading"></div>');
	$('.yith-similar-products .carousel-heading').wrap('<div class="col-lg-12 col-md-12 col-sm-12"></div>');
	$('.yith-similar-products .carousel-heading').append('<div class="carousel-arrows"><i class="icons icon-left-dir"></i><i class="icons icon-right-dir"></i></div>');
	$('.yith-similar-products ul').wrap('<div class="carousel owl-carousel-wrap col-lg-12 col-md-12 col-sm-12"></div>');
	$('.yith-similar-products ul').addClass('owl-carousel');
	$('.yith-similar-products ul li').removeClass('col-lg-4 col-md-4 col-sm-4');
	$('.yith-similar-products ul li').removeClass('col-lg-3 col-md-6 col-sm-6');
	$('.main-content.col-lg-9 .yith-similar-products ul').attr('data-max-items',3);
	$('.main-content.col-lg-12 .yith-similar-products ul').attr('data-max-items',4);
	
	
	
	
	
	
	
	$('.dhvc-form-select select').addClass('chosen-select');
	
	$('.woocommerce-checkout select').addClass('chosen-select');
	
	
	$('.woocommerce.columns-4').addClass('row');
	
	
	$('.woo_compare_remove_product').addClass('remove');

	/* Quick View */
	quickViewModal($('a.product-hover'));

	
	selectBox(); // Select Boxes (Chosen plugin)
	
	backToTop(); // Back to top arrow
	
	backToTopEvent(); // Initialize back to top event
	
	tabsOn(); // Turn Tabs On
	
	accordionsOn(); // Turn Accordions On

	installCarousels(); // Install Owl Carousels

	
	singleProduct(); // Cloud Zoom
	
	
	
	
	
	
	
	
	
if($('body').hasClass('woocommerce')) {
	
	
	/* Grid/List View */
	$('#grid').click(function() {
		$(this).addClass('active');
		$('#list').removeClass('active');
		$.cookie('gridcookie','grid', { path: '/' });
		$('ul.products').fadeOut(0, function() {
			$(this).addClass('grid').removeClass('list').fadeIn(0);
			
		});
		
		
		 // var container_product = document.querySelector('#container-product');
	
		 // if(container_product) {
			 // var msnry = new Masonry( container_product, {
			   // itemSelector: '.product'
			 // });
		 // }
		
		
		return false;
	});

	$('#list').click(function() {
		$(this).addClass('active');
		$('#grid').removeClass('active');
		$.cookie('gridcookie','list', { path: '/' });
		$('ul.products').fadeOut(0, function() {
			$(this).removeClass('grid').addClass('list').fadeIn(0);

		});
		
		
		 // var container_product = document.querySelector('#container-product');
	
		 // if(container_product) {
			 // var msnry = new Masonry( container_product, {
			   // itemSelector: '.product'
			 // });
		 // }
		
		return false;
	});
	
	if ($.cookie('gridcookie')) {
        $('ul.products').addClass($.cookie('gridcookie'));
    }

    if ($.cookie('gridcookie') == 'grid') {
        $('.category-buttons #grid').addClass('active');
        $('.category-buttons #list').removeClass('active');
    }

    if ($.cookie('gridcookie') == 'list') {
        $('.category-buttons #list').addClass('active');
        $('.category-buttons #grid').removeClass('active');
    }

	
}
	
	
	
	
	
	
	$('#category-buttons a').click(function(event) {
	    event.preventDefault();
	});
	
	
	
	/* Window Scroll */
	$(window).scroll(function(){
		
		backToTop(); // Back to top
				
	});
	
	
	
	/* Window Resize */
	$(window).resize(function(){
	
		// Set the new Window Width and Height
		windowWidth = $(window).width();
		windowHeight = $(window).height();

	});
	
	
	

	
	
	
	
	/* Tooltips */
	$('.tooltip-hover').tooltip();
	
	
	
/* TinyNav.js 1  */
	$('#main-navigation>ul').tinyNav({
		active: 'current-item',
		header: navigation_text,
		indent: '→',
		label: menu_text
	});
	
	 
	
	
	
	
	

	
	
	
	/* IOS Slider */
	$('.iosSlider').iosSlider({
		scrollbar: true,
		snapToChildren: true,
		desktopClickDrag: true,
		scrollbarMargin: '5px 40px 0 40px',
		scrollbarBorderRadius: 0,
		scrollbarHeight: '2px',
		navPrevSelector: $('.prevButton'),
		navNextSelector: $('.nextButton')
	});
	
	
	
	
	
	
	/* FlexSlider */
	$('.flexslider').flexslider({
		animation: "slide",
		controlNav: false,
		prevText: "",           
		nextText: "",
		start: function(slider){
			$('body').removeClass('loading');
			}
	});
	
	 
	 
	 $('.flexslider-post').flexslider({
		animation: "slide",
		controlNav: false,
		prevText: "",           
		nextText: ""
	});
	 
	 

	

	
	/* Rating */
	
	// Read Only
	$('.rating.readonly-rating').raty({ 
		readOnly: true,
		path: global.paththeme + '/js/img',
		score: function() {
			return $(this).attr('data-score');
		}
	 });
	 
	// Rate
	$('.rating.rate').raty({ 
		path: global.paththeme + '/js/img',
		score: function() {
			return $(this).attr('data-score');
		}
	});
	
	
	
	
	/* Fix Revolution Slider Arrows */
	function fixRevolutionArrows() {
		
		$('.tp-banner').each(function(){
			
			setTimeout(function(){
			
				var arrow_l = $('.tp-banner').find('.tp-leftarrow');
				var arrow_r = $('.tp-banner').find('.tp-rightarrow');
				
				var tp_height = $('.tp-banner').height();
				var arrow_height = $(arrow_l).height();
				var arrow_top = (tp_height/2)-(arrow_height/2);
				
				
				$(arrow_l).css('top', arrow_top);
				$(arrow_r).css('top', arrow_top);
				
			},1000);
			
		});
	
	}
	
	
	
	
	/* Navigation Height Fix */
	function fixNavigation(){
		
		var nav = $('#main-navigation>ul>li');
		$(nav).find('>a').attr('style', '');
		var nav_height = $(nav).height();
		
		$(nav).each(function(){
		
			$(this).find('>a').innerHeight(nav_height);
			
		});
	
	}
	
	
	
	
	
	
	/* Product Grid View */
	function fixGridView(){
		
		if($('.grid-view').length>0){
			
			$('.grid-view.product .product-content').attr('style', '');
			
			var product_height = $('.grid-view.product img').height();
			var previous_height = $('.grid-view.product .product-content').innerHeight();
			
			if(previous_height < product_height){
				$('.grid-view.product .product-content').innerHeight(product_height);
			}
		}
		
	}
	
	
	
	
	
	
	/* Single Product Page */
	function singleProduct(){
	
		
		/* Product Images Carousel */
		$('#product-carousel').flexslider({
			animation: "slide",
			controlNav: false,
			animationLoop: false,
			directionNav: false,
			slideshow: false,
			itemWidth: 80,
			itemMargin: 0,
			start: function(slider){
			
				setActive($('#product-carousel li:first-child img'));
				slider.find('.right-arrow').click(function(){
					slider.flexAnimate(slider.getTarget("next"));
				});
				
				slider.find('.left-arrow').click(function(){
					slider.flexAnimate(slider.getTarget("prev"));
				});
				
				slider.find('img').click(function(){
					var large = $(this).attr('data-large');
					setActive($(this));
					$('#product-slider img').fadeOut(300, changeImg(large, $('#product-slider img')));
					$('#product-slider a.fullscreen-button').attr('href', large);
				});
				
				function changeImg(large, element){
					var element = element;
					var large = large;
					setTimeout(function(){ startF()},300);
					function startF(){
						element.attr('src', large)
						element.attr('data-large', large)
						element.fadeIn(300);
					}
					
				}
				
				function setActive(el){
					var element = el;
					$('#product-carousel img').removeClass('active-item');
					element.addClass('active-item');
				}
				
			}
			
		});

		
		/* Cloud Zoom */
		$(".cloud-zoom").imagezoomsl({
			zoomrange: [3, 3]
		});

	}
	
	
	
	
	
	
	
	/* Set Carousels */
	function installCarousels(){

		$('.owl-carousel').each(function(){
		
			/* Max items counting */
			var max_items = $(this).attr('data-max-items');
			var tablet_items = max_items;
			if(max_items > 1){
				tablet_items = max_items - 1;
			}
			var mobile_items = 1;
			
			
			/* Install Owl Carousel */
			$(this).owlCarousel({
				items:max_items,
				direction:is_rtl,
				pagination : false,
				itemsDesktop : [1199,max_items],
				itemsDesktopSmall : [1000,max_items],
				itemsTablet: [920,tablet_items],
				itemsMobile: [560,mobile_items],
			});
		
			
			var owl = $(this).data('owlCarousel');
			
			/* Arrow next */
			$(this).parent().parent().find('.icon-left-dir').click(function(e){
				owl.prev();
			});
			
			/* Arrow previous */
			$(this).parent().parent().find('.icon-right-dir').click(function(e){
				owl.next(); 
			});
			
		});
		
	}
	
	
	
	
	

	
	
	
	
	
	/* Product Actions Accordion */
	var productButtons = $('.product-actions').not('.full-width');
	var productButtons1 = $('.product-single .product-actions').not('.full-width');
	productButtons.find('>span:first-child').addClass('current');
	
	productButtons1.find('span.add-to-favorites').addClass('current');
	
	productButtons.find('>span').hover(function(){
		
		$(this).parent().find('>span').removeClass('current');
		$(this).addClass('current');
		
	}, function(){
		
		$(this).removeClass('current');
		
	});
	
	productButtons.hover(function(){
		
	}, function(){
		$(this).find('>span:first-child').addClass('current');
		productButtons1.find('span.add-to-favorites').addClass('current');
	});
	
	
	
	
	
	/* NAVIGATION DROPDOWN EFFECTS */
	function dropdownsNavigation(){
		
		var mainNav = $('#main-navigation');
		var mainNavItems = $('#main-navigation>ul>li');
		var sideNavItems = $('.sidebar-box-content>ul>li');
		
		
		mainNav.find('ul.normalAnimation').removeClass('normalAnimation');
		
		
		/* Navigation FadeIn Dropdown Effect */
		mainNavItems.hover(function(){
			
			var dropdown = $(this).find('>ul');
			if(!dropdown.hasClass('animating') && windowWidth>767){
				
				dropdown.css('opacity',0).css('top','150%').show().animate({opacity:1, top:100+'%'},300);
				
			}
			
		}, function(){
			
			var dropdown = $(this).find('>ul');
			if(!dropdown.hasClass('animating')){
				
				dropdown.addClass('animating').animate({opacity:0, top:150+'%'},300, function(){
					$(this).hide().removeClass('animating');;	
				});
				
			}
			
		});
		
		
		
		
		
		
		
		/* Navigation SlideDown Dropdown Effect */
		sideNavItems.hover(function(){
			
			var dropdown = $(this).find('>ul');
			if(!dropdown.hasClass('animating') && windowWidth>767){
				
				dropdown.hide().fadeIn(200);
			}
			
		}, function(){
			
			var dropdown = $(this).find('>ul');
			if(!dropdown.hasClass('animating')){
				$(this).find('>ul').addClass('animating').show().fadeOut(100, function(){
					$(this).removeClass('animating');	
				});
			}
			
		});
		
		
		
		
		
		
		/* Navigation Fadein Dropdown Effect 2 */
		mainNav.find('ul.normal-dropdown>li').hover(function(){
			
			var dropdown = $(this).find('>ul');
			if(!dropdown.hasClass('animating') && windowWidth>767){
				
				dropdown.hide().fadeIn(200);
			}
			
		}, function(){
			
			var dropdown = $(this).find('>ul');
			if(!dropdown.hasClass('animating')){
				$(this).find('>ul').addClass('animating').show().fadeOut(100, function(){
					$(this).removeClass('animating');	
				});
			}
			
		});	
		
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	/* Back to top button */
	function backToTop(){
		
		var button = $('#back-to-top');
		var w_scroll = $(window).scrollTop();
		
		if(w_scroll > 150  && windowWidth>767){
			button.fadeIn(400);	
		}else{
			button.fadeOut(400);	
		}
		
	}
	
	
	/* Back to top button event */
	function backToTopEvent(){
		
		var button = $('#back-to-top');
		
		
		
		button.click(function(){
			
			$('html,body').animate({scrollTop:0}, 600);
			
		});
		
	}
	
	
	
	
	var tabReview = $('.product-action a');
				tabReview.click(function(e){
					var tab = $('#products_tabs .tabs');
					
					//e.preventDefault();
					tab.find('.tab-content > div').hide();
					tab.find('.tab-heading>a').removeClass('active');

					$('.tab-heading>a[href="#tab-reviews"]').addClass('active');
					$('.tab-content > div#tab-reviews').show();
					
				});


	
	/* Tabs */
	function tabsOn(){
		
		$('.tabs').each(function(){
			
			var tab = $(this);
			tab.find('.tab-content > div').hide();
			tab.find('.tab-heading>a:first-child').addClass('active');
			tab.find('.tab-content > div:first-child').show();


			var tabMenuItems = tab.find('.tab-heading>a');
			
				
			
			tabMenuItems.click(function(e){
				
				e.preventDefault();
				
				var target = $(this).attr('href');
				
				tab.find('.tab-content > div').hide();
				tab.find('.tab-heading>a').removeClass('active');
				
				$(this).addClass('active');
				tab.find(target).show();
				
			});
			
		});
			
	}
	
	
	
	
	
	
	
	
	/* Accordions */
	function accordionsOn(){
		
		$('.accordion').each(function(){
			
			var accordion = $(this);
			accordion.find('.accordion-content').hide();
			accordion.find('>ul>li:first-child').addClass('accordion-active').find('.accordion-content').show();
			accordion.find('.accordion-header').click(function(){
				
				if($(this).parent().hasClass('accordion-active')){
					$(this).parent().removeClass('accordion-active');
					$(this).parent().find('.accordion-content').slideUp(300);
				}else{
					$(this).parent().parent().find('li.accordion-active').removeClass('accordion-active').find('.accordion-content').slideUp(300);
					$(this).parent().addClass('accordion-active').find('.accordion-content').slideDown(300)
				}
				
			});
			
		});
		
	}
	
	
	
	
	
	
	
	/* Select Box Styles */
	function selectBox(){
	
		var config = {
		  '.chosen-select'           : {disable_search_threshold:10},
		  '.chosen-select-full-width'           : {disable_search_threshold:10, width:'100%'},
		  '.chosen-select-search' : {disable_search_threshold:10, width:'100%'}
		}
		for (var selector in config) {
		  $(selector).chosen(config[selector]);
		}
		
	}
	
	
	
	
	
	
	
	
	/* Wuick View */
	function quickViewModal(el){
		
		$('body').append('<div id="quick-view-modal"><div id="quick-view-content"><div id="quick-view-close"></div><div class="quick-view-content"><div class="quick-view-container col-lg-12 col-md-12 col-sm-12"></div></div></div></div>');
		$('#quick-view-modal').hide();
		
		$('#quick-view-close').click(function(){
			
			$('#quick-view-modal').fadeOut(300);
			
		});
		
		/* Scroll Bar */
		$('.quick-view-content').perfectScrollbar({wheelSpeed: 40, suppressScrollX:true});
		
		var elements = el;
		elements.click(function(e){
		
			e.preventDefault();
			var target = $(this).attr('href');
			
			$('#quick-view-content .quick-view-container').load(target+' #product-single', function(){
				
				
				/* Rating Box */
				$('#quick-view-modal .rating.readonly-rating').raty({ readOnly: true, path: global.paththeme + '/js/img',score: function() {
					return $(this).attr('data-score');
				}});
				$('#quick-view-modal .rating.rate').raty({ path: global.paththeme + '/js/img',score: function() {
					return $(this).attr('data-score');
				}});
				
				// Star ratings for comments
				$( '#quick-view-modal #rating' ).hide().before( '<p class="stars"><span><a class="star-1" href="#">1</a><a class="star-2" href="#">2</a><a class="star-3" href="#">3</a><a class="star-4" href="#">4</a><a class="star-5" href="#">5</a></span></p>' );
				$( 'body #quick-view-modal' )
					.on( 'click', '#respond p.stars a', function() {
						var $star   = $( this ),
							$rating = $( this ).closest( '#respond' ).find( '#rating' );

						$rating.val( $star.text() );
						$star.siblings( 'a' ).removeClass( 'active' );
						$star.addClass( 'active' );

						return false;
					})
					
		
				/* Accordions */
				var productButtons = $('#quick-view-content .product-actions').not('.full-width');
				productButtons.find('>span:first-child').addClass('current');
				
				
	productButtons.find('>span:first-child').addClass('current');
	
	productButtons.find('span.add-to-favorites').addClass('current');
				
				
				
				
				
				
				
				
				
				
				
				productButtons.find('>span').hover(function(){
					
					$(this).parent().find('>span').removeClass('current');
					$(this).addClass('current');
					//$(this).parent().find('>span.add-to-favorites').removeClass('current');
				}, function(){
					
					$(this).removeClass('current');
					$(this).parent().find('span.add-to-favorites').addClass('current');
				});
				
				productButtons.hover(function(){
					
				}, function(){
					$(this).find('>span:first-child').addClass('current');
					$(this).find('>span.add-to-favorites').addClass('current');
				});
				
				
				/* Tabs */
				tabsOn();
				
				accordionsOn();
				
				
				/* Numeric Input */
				$('#quick-view-modal .numeric-input').each(function(){
		
					var el = $(this);
					numericInput(el);
					
				});
				
				/* Char Counter */
				$('#quick-view-modal .char-counter').each(function(){
					
					var el = $(this);
					charCounter(el);
					
				});
				
				
				var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
				po.src = 'https://apis.google.com/js/platform.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
				
				
				/* Product Carousel */
				$('#quick-view-modal #product-carousel').flexslider({
					animation: "slide",
					controlNav: false,
					animationLoop: false,
					directionNav: false,
					slideshow: false,
					itemWidth: 80,
					itemMargin: 0,
					start: function(slider){
							setActive($('#product-carousel li:first-child img'));
							slider.find('.right-arrow').click(function(){
								slider.flexAnimate(slider.getTarget("next"));
							});
							slider.find('.left-arrow').click(function(){
								slider.flexAnimate(slider.getTarget("prev"));
							});
							slider.find('img').click(function(){
								var large = $(this).attr('data-large');
								setActive($(this));
								$('#product-slider img').fadeOut(300, changeImg(large, $('#product-slider img')));
							});
							function changeImg(large, element){
								var element = element;
								var large = large;
								setTimeout(function(){ startF()},300);
								function startF(){
									element.attr('src', large)
									element.attr('data-large', large)
									element.fadeIn(300);
								}
								
							}
							function setActive(el){
								var element = el;
								$('#product-carousel img').removeClass('active-item');
								element.addClass('active-item');
							}
						}
				});
				
				$('#quick-view-modal').fadeIn(300);
				
				
				/* Positioning */
				var q_width = $('#quick-view-content').width();
				var q_height = $('#quick-view-content').height();
				var q_margin = ($(window).height() - q_height)/2;
				
				$('#quick-view-content').css('margin-top',q_margin+'px');
				
				
				/* Cloud Zoom */
				$("#quick-view-modal .cloud-zoom").imagezoomsl({
					 zoomrange: [3, 3]
				  });
				
				
				
				
				$('.quick-view-content').perfectScrollbar('update');
				$('.quick-view-content').css('overflow','hidden');
				
				$('.quick-view-content').click(function(){
					$(this).perfectScrollbar('update');
				});
				
				/* Select Box */
				var config = {
					'#quick-view-content .chosen-select' : {disable_search_threshold:10}
				}
				for (var selector in config) {
				  $(selector).chosen(config[selector]);
				}
				
				
				
			});
			
		});
		
	}
	
	

	
	/* Numeric Input */
	$('.numeric-input').each(function(){
		
		var el = $(this);
		numericInput(el);
		
	});
	
	
	/* Numeric Input */
	function numericInput(el){
		
		var element = el;
		var input = $(element).find('input');
		
		$(element).find('.arrow-up').click(function(){
			var value = parseInt(input.val());
			input.val(value+1);
		});
		
		$(element).find('.arrow-down').click(function(){
			var value = parseInt(input.val());
			input.val(value-1);
		});
		
		input.keypress(function(e){
			
			var value = parseInt(String.fromCharCode(e.which));
			if(isNaN(value)){
				e.preventDefault();
			}
			
		});
		
	}
	
	
	
	
	
	
	/* Char Counter */
	$('.char-counter').each(function(){
		
		var el = $(this);
		charCounter(el);
		
	});
	
	
	function charCounter(el){
		
		var element = el;
		var counter = $(element).find('input');
		var target = $(counter).attr('data-target');
		
		$(target).bind("change paste keyup",function(){
			
			var value = $(this).val();
			var length = value.length;
			
			counter.val(length);
			
		});
		
	}
		
});







$('form#newsletter').submit(function(e) {
		e.preventDefault();

		var successMSG = "<p>"+added_text+"</p>";  //"<p>You've been added to our sign-up list.</p>";
		var errorMSG = "<p>There was an error. Please try again.</p>";
		var invalidEmailMSG = "<p>"+added_text2+"</p>";  //"<p>That does not look like a valid email.</p>";
		var alreadySubscribedMSG = "<p>You have already subscribed to our sign-up list.</p>";
		
		
		$('.ajax-loader').show();
		$(this).ajaxSubmit({
			success	: function (responseText) {
				if (responseText === 'added') {
					$('form#newsletter').fadeOut('slow');
					$('#mailchimp-sign-up1 p').replaceWith(successMSG).fadeIn('slow');
				} else if (responseText === 'already subscribed') {
					$('form#newsletter').fadeOut('slow');
					$('#mailchimp-sign-up1 p').replaceWith(alreadySubscribedMSG).fadeIn('slow');
				} else if (responseText === 'invalid email') {
					$('#mailchimp-sign-up1 p').replaceWith(invalidEmailMSG).fadeIn('slow');
				} else {
					$('#mailchimp-sign-up1 p').replaceWith(errorMSG).fadeIn('slow');
				}
				$('.ajax-loader').hide();
				
			},
			url		: ajaxVars.ajaxurl,
			data	: { ajax_nonce : ajaxVars.ajax_nonce, action : 'add_to_mailchimp_list' },
			type	: 'POST',
			timeout	: 50000,
		});
	});



})(jQuery);	





	


/**
 * jQuery Validation Plugin 1.9.0
 *
 * http://bassistance.de/jquery-plugins/jquery-plugin-validation/
 * http://docs.jquery.com/Plugins/Validation
 *
 * Copyright (c) 2006 - 2011 Jörn Zaefferer
 *
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 */
(function(c){c.extend(c.fn,{validate:function(a){if(this.length){var b=c.data(this[0],"validator");if(b)return b;this.attr("novalidate","novalidate");b=new c.validator(a,this[0]);c.data(this[0],"validator",b);if(b.settings.onsubmit){a=this.find("input, button");a.filter(".cancel").click(function(){b.cancelSubmit=true});b.settings.submitHandler&&a.filter(":submit").click(function(){b.submitButton=this});this.submit(function(d){function e(){if(b.settings.submitHandler){if(b.submitButton)var f=c("<input type='hidden'/>").attr("name",
b.submitButton.name).val(b.submitButton.value).appendTo(b.currentForm);b.settings.submitHandler.call(b,b.currentForm);b.submitButton&&f.remove();return false}return true}b.settings.debug&&d.preventDefault();if(b.cancelSubmit){b.cancelSubmit=false;return e()}if(b.form()){if(b.pendingRequest){b.formSubmitted=true;return false}return e()}else{b.focusInvalid();return false}})}return b}else a&&a.debug&&window.console&&console.warn("nothing selected, can't validate, returning nothing")},valid:function(){if(c(this[0]).is("form"))return this.validate().form();
else{var a=true,b=c(this[0].form).validate();this.each(function(){a&=b.element(this)});return a}},removeAttrs:function(a){var b={},d=this;c.each(a.split(/\s/),function(e,f){b[f]=d.attr(f);d.removeAttr(f)});return b},rules:function(a,b){var d=this[0];if(a){var e=c.data(d.form,"validator").settings,f=e.rules,g=c.validator.staticRules(d);switch(a){case "add":c.extend(g,c.validator.normalizeRule(b));f[d.name]=g;if(b.messages)e.messages[d.name]=c.extend(e.messages[d.name],b.messages);break;case "remove":if(!b){delete f[d.name];
return g}var h={};c.each(b.split(/\s/),function(j,i){h[i]=g[i];delete g[i]});return h}}d=c.validator.normalizeRules(c.extend({},c.validator.metadataRules(d),c.validator.classRules(d),c.validator.attributeRules(d),c.validator.staticRules(d)),d);if(d.required){e=d.required;delete d.required;d=c.extend({required:e},d)}return d}});c.extend(c.expr[":"],{blank:function(a){return!c.trim(""+a.value)},filled:function(a){return!!c.trim(""+a.value)},unchecked:function(a){return!a.checked}});c.validator=function(a,
b){this.settings=c.extend(true,{},c.validator.defaults,a);this.currentForm=b;this.init()};c.validator.format=function(a,b){if(arguments.length==1)return function(){var d=c.makeArray(arguments);d.unshift(a);return c.validator.format.apply(this,d)};if(arguments.length>2&&b.constructor!=Array)b=c.makeArray(arguments).slice(1);if(b.constructor!=Array)b=[b];c.each(b,function(d,e){a=a.replace(RegExp("\\{"+d+"\\}","g"),e)});return a};c.extend(c.validator,{defaults:{messages:{},groups:{},rules:{},errorClass:"error",
validClass:"valid",errorElement:"label",focusInvalid:true,errorContainer:c([]),errorLabelContainer:c([]),onsubmit:true,ignore:":hidden",ignoreTitle:false,onfocusin:function(a){this.lastActive=a;if(this.settings.focusCleanup&&!this.blockFocusCleanup){this.settings.unhighlight&&this.settings.unhighlight.call(this,a,this.settings.errorClass,this.settings.validClass);this.addWrapper(this.errorsFor(a)).hide()}},onfocusout:function(a){if(!this.checkable(a)&&(a.name in this.submitted||!this.optional(a)))this.element(a)},
onkeyup:function(a){if(a.name in this.submitted||a==this.lastElement)this.element(a)},onclick:function(a){if(a.name in this.submitted)this.element(a);else a.parentNode.name in this.submitted&&this.element(a.parentNode)},highlight:function(a,b,d){a.type==="radio"?this.findByName(a.name).addClass(b).removeClass(d):c(a).addClass(b).removeClass(d)},unhighlight:function(a,b,d){a.type==="radio"?this.findByName(a.name).removeClass(b).addClass(d):c(a).removeClass(b).addClass(d)}},setDefaults:function(a){c.extend(c.validator.defaults,
a)},messages:{required:"This field is required.",remote:"Please fix this field.",email:"Please enter a valid email address.",url:"Please enter a valid URL.",date:"Please enter a valid date.",dateISO:"Please enter a valid date (ISO).",number:"Please enter a valid number.",digits:"Please enter only digits.",creditcard:"Please enter a valid credit card number.",equalTo:"Please enter the same value again.",accept:"Please enter a value with a valid extension.",maxlength:c.validator.format("Please enter no more than {0} characters."),
minlength:c.validator.format("Please enter at least {0} characters."),rangelength:c.validator.format("Please enter a value between {0} and {1} characters long."),range:c.validator.format("Please enter a value between {0} and {1}."),max:c.validator.format("Please enter a value less than or equal to {0}."),min:c.validator.format("Please enter a value greater than or equal to {0}.")},autoCreateRanges:false,prototype:{init:function(){function a(e){var f=c.data(this[0].form,"validator"),g="on"+e.type.replace(/^validate/,
"");f.settings[g]&&f.settings[g].call(f,this[0],e)}this.labelContainer=c(this.settings.errorLabelContainer);this.errorContext=this.labelContainer.length&&this.labelContainer||c(this.currentForm);this.containers=c(this.settings.errorContainer).add(this.settings.errorLabelContainer);this.submitted={};this.valueCache={};this.pendingRequest=0;this.pending={};this.invalid={};this.reset();var b=this.groups={};c.each(this.settings.groups,function(e,f){c.each(f.split(/\s/),function(g,h){b[h]=e})});var d=
this.settings.rules;c.each(d,function(e,f){d[e]=c.validator.normalizeRule(f)});c(this.currentForm).validateDelegate("[type='text'], [type='password'], [type='file'], select, textarea, [type='number'], [type='search'] ,[type='tel'], [type='url'], [type='email'], [type='datetime'], [type='date'], [type='month'], [type='week'], [type='time'], [type='datetime-local'], [type='range'], [type='color'] ","focusin focusout keyup",a).validateDelegate("[type='radio'], [type='checkbox'], select, option","click",
a);this.settings.invalidHandler&&c(this.currentForm).bind("invalid-form.validate",this.settings.invalidHandler)},form:function(){this.checkForm();c.extend(this.submitted,this.errorMap);this.invalid=c.extend({},this.errorMap);this.valid()||c(this.currentForm).triggerHandler("invalid-form",[this]);this.showErrors();return this.valid()},checkForm:function(){this.prepareForm();for(var a=0,b=this.currentElements=this.elements();b[a];a++)this.check(b[a]);return this.valid()},element:function(a){this.lastElement=
a=this.validationTargetFor(this.clean(a));this.prepareElement(a);this.currentElements=c(a);var b=this.check(a);if(b)delete this.invalid[a.name];else this.invalid[a.name]=true;if(!this.numberOfInvalids())this.toHide=this.toHide.add(this.containers);this.showErrors();return b},showErrors:function(a){if(a){c.extend(this.errorMap,a);this.errorList=[];for(var b in a)this.errorList.push({message:a[b],element:this.findByName(b)[0]});this.successList=c.grep(this.successList,function(d){return!(d.name in a)})}this.settings.showErrors?
this.settings.showErrors.call(this,this.errorMap,this.errorList):this.defaultShowErrors()},resetForm:function(){c.fn.resetForm&&c(this.currentForm).resetForm();this.submitted={};this.lastElement=null;this.prepareForm();this.hideErrors();this.elements().removeClass(this.settings.errorClass)},numberOfInvalids:function(){return this.objectLength(this.invalid)},objectLength:function(a){var b=0,d;for(d in a)b++;return b},hideErrors:function(){this.addWrapper(this.toHide).hide()},valid:function(){return this.size()==
0},size:function(){return this.errorList.length},focusInvalid:function(){if(this.settings.focusInvalid)try{c(this.findLastActive()||this.errorList.length&&this.errorList[0].element||[]).filter(":visible").focus().trigger("focusin")}catch(a){}},findLastActive:function(){var a=this.lastActive;return a&&c.grep(this.errorList,function(b){return b.element.name==a.name}).length==1&&a},elements:function(){var a=this,b={};return c(this.currentForm).find("input, select, textarea").not(":submit, :reset, :image, [disabled]").not(this.settings.ignore).filter(function(){!this.name&&
a.settings.debug&&window.console&&console.error("%o has no name assigned",this);if(this.name in b||!a.objectLength(c(this).rules()))return false;return b[this.name]=true})},clean:function(a){return c(a)[0]},errors:function(){return c(this.settings.errorElement+"."+this.settings.errorClass,this.errorContext)},reset:function(){this.successList=[];this.errorList=[];this.errorMap={};this.toShow=c([]);this.toHide=c([]);this.currentElements=c([])},prepareForm:function(){this.reset();this.toHide=this.errors().add(this.containers)},
prepareElement:function(a){this.reset();this.toHide=this.errorsFor(a)},check:function(a){a=this.validationTargetFor(this.clean(a));var b=c(a).rules(),d=false,e;for(e in b){var f={method:e,parameters:b[e]};try{var g=c.validator.methods[e].call(this,a.value.replace(/\r/g,""),a,f.parameters);if(g=="dependency-mismatch")d=true;else{d=false;if(g=="pending"){this.toHide=this.toHide.not(this.errorsFor(a));return}if(!g){this.formatAndAdd(a,f);return false}}}catch(h){this.settings.debug&&window.console&&console.log("exception occured when checking element "+
a.id+", check the '"+f.method+"' method",h);throw h;}}if(!d){this.objectLength(b)&&this.successList.push(a);return true}},customMetaMessage:function(a,b){if(c.metadata){var d=this.settings.meta?c(a).metadata()[this.settings.meta]:c(a).metadata();return d&&d.messages&&d.messages[b]}},customMessage:function(a,b){var d=this.settings.messages[a];return d&&(d.constructor==String?d:d[b])},findDefined:function(){for(var a=0;a<arguments.length;a++)if(arguments[a]!==undefined)return arguments[a]},defaultMessage:function(a,
b){return this.findDefined(this.customMessage(a.name,b),this.customMetaMessage(a,b),!this.settings.ignoreTitle&&a.title||undefined,c.validator.messages[b],"<strong>Warning: No message defined for "+a.name+"</strong>")},formatAndAdd:function(a,b){var d=this.defaultMessage(a,b.method),e=/\$?\{(\d+)\}/g;if(typeof d=="function")d=d.call(this,b.parameters,a);else if(e.test(d))d=jQuery.format(d.replace(e,"{$1}"),b.parameters);this.errorList.push({message:d,element:a});this.errorMap[a.name]=d;this.submitted[a.name]=
d},addWrapper:function(a){if(this.settings.wrapper)a=a.add(a.parent(this.settings.wrapper));return a},defaultShowErrors:function(){for(var a=0;this.errorList[a];a++){var b=this.errorList[a];this.settings.highlight&&this.settings.highlight.call(this,b.element,this.settings.errorClass,this.settings.validClass);this.showLabel(b.element,b.message)}if(this.errorList.length)this.toShow=this.toShow.add(this.containers);if(this.settings.success)for(a=0;this.successList[a];a++)this.showLabel(this.successList[a]);
if(this.settings.unhighlight){a=0;for(b=this.validElements();b[a];a++)this.settings.unhighlight.call(this,b[a],this.settings.errorClass,this.settings.validClass)}this.toHide=this.toHide.not(this.toShow);this.hideErrors();this.addWrapper(this.toShow).show()},validElements:function(){return this.currentElements.not(this.invalidElements())},invalidElements:function(){return c(this.errorList).map(function(){return this.element})},showLabel:function(a,b){var d=this.errorsFor(a);if(d.length){d.removeClass(this.settings.validClass).addClass(this.settings.errorClass);
d.attr("generated")&&d.html(b)}else{d=c("<"+this.settings.errorElement+"/>").attr({"for":this.idOrName(a),generated:true}).addClass(this.settings.errorClass).html(b||"");if(this.settings.wrapper)d=d.hide().show().wrap("<"+this.settings.wrapper+"/>").parent();this.labelContainer.append(d).length||(this.settings.errorPlacement?this.settings.errorPlacement(d,c(a)):d.insertAfter(a))}if(!b&&this.settings.success){d.text("");typeof this.settings.success=="string"?d.addClass(this.settings.success):this.settings.success(d)}this.toShow=
this.toShow.add(d)},errorsFor:function(a){var b=this.idOrName(a);return this.errors().filter(function(){return c(this).attr("for")==b})},idOrName:function(a){return this.groups[a.name]||(this.checkable(a)?a.name:a.id||a.name)},validationTargetFor:function(a){if(this.checkable(a))a=this.findByName(a.name).not(this.settings.ignore)[0];return a},checkable:function(a){return/radio|checkbox/i.test(a.type)},findByName:function(a){var b=this.currentForm;return c(document.getElementsByName(a)).map(function(d,
e){return e.form==b&&e.name==a&&e||null})},getLength:function(a,b){switch(b.nodeName.toLowerCase()){case "select":return c("option:selected",b).length;case "input":if(this.checkable(b))return this.findByName(b.name).filter(":checked").length}return a.length},depend:function(a,b){return this.dependTypes[typeof a]?this.dependTypes[typeof a](a,b):true},dependTypes:{"boolean":function(a){return a},string:function(a,b){return!!c(a,b.form).length},"function":function(a,b){return a(b)}},optional:function(a){return!c.validator.methods.required.call(this,
c.trim(a.value),a)&&"dependency-mismatch"},startRequest:function(a){if(!this.pending[a.name]){this.pendingRequest++;this.pending[a.name]=true}},stopRequest:function(a,b){this.pendingRequest--;if(this.pendingRequest<0)this.pendingRequest=0;delete this.pending[a.name];if(b&&this.pendingRequest==0&&this.formSubmitted&&this.form()){c(this.currentForm).submit();this.formSubmitted=false}else if(!b&&this.pendingRequest==0&&this.formSubmitted){c(this.currentForm).triggerHandler("invalid-form",[this]);this.formSubmitted=
false}},previousValue:function(a){return c.data(a,"previousValue")||c.data(a,"previousValue",{old:null,valid:true,message:this.defaultMessage(a,"remote")})}},classRuleSettings:{required:{required:true},email:{email:true},url:{url:true},date:{date:true},dateISO:{dateISO:true},dateDE:{dateDE:true},number:{number:true},numberDE:{numberDE:true},digits:{digits:true},creditcard:{creditcard:true}},addClassRules:function(a,b){a.constructor==String?this.classRuleSettings[a]=b:c.extend(this.classRuleSettings,
a)},classRules:function(a){var b={};(a=c(a).attr("class"))&&c.each(a.split(" "),function(){this in c.validator.classRuleSettings&&c.extend(b,c.validator.classRuleSettings[this])});return b},attributeRules:function(a){var b={};a=c(a);for(var d in c.validator.methods){var e;if(e=d==="required"&&typeof c.fn.prop==="function"?a.prop(d):a.attr(d))b[d]=e;else if(a[0].getAttribute("type")===d)b[d]=true}b.maxlength&&/-1|2147483647|524288/.test(b.maxlength)&&delete b.maxlength;return b},metadataRules:function(a){if(!c.metadata)return{};
var b=c.data(a.form,"validator").settings.meta;return b?c(a).metadata()[b]:c(a).metadata()},staticRules:function(a){var b={},d=c.data(a.form,"validator");if(d.settings.rules)b=c.validator.normalizeRule(d.settings.rules[a.name])||{};return b},normalizeRules:function(a,b){c.each(a,function(d,e){if(e===false)delete a[d];else if(e.param||e.depends){var f=true;switch(typeof e.depends){case "string":f=!!c(e.depends,b.form).length;break;case "function":f=e.depends.call(b,b)}if(f)a[d]=e.param!==undefined?
e.param:true;else delete a[d]}});c.each(a,function(d,e){a[d]=c.isFunction(e)?e(b):e});c.each(["minlength","maxlength","min","max"],function(){if(a[this])a[this]=Number(a[this])});c.each(["rangelength","range"],function(){if(a[this])a[this]=[Number(a[this][0]),Number(a[this][1])]});if(c.validator.autoCreateRanges){if(a.min&&a.max){a.range=[a.min,a.max];delete a.min;delete a.max}if(a.minlength&&a.maxlength){a.rangelength=[a.minlength,a.maxlength];delete a.minlength;delete a.maxlength}}a.messages&&delete a.messages;
return a},normalizeRule:function(a){if(typeof a=="string"){var b={};c.each(a.split(/\s/),function(){b[this]=true});a=b}return a},addMethod:function(a,b,d){c.validator.methods[a]=b;c.validator.messages[a]=d!=undefined?d:c.validator.messages[a];b.length<3&&c.validator.addClassRules(a,c.validator.normalizeRule(a))},methods:{required:function(a,b,d){if(!this.depend(d,b))return"dependency-mismatch";switch(b.nodeName.toLowerCase()){case "select":return(a=c(b).val())&&a.length>0;case "input":if(this.checkable(b))return this.getLength(a,
b)>0;default:return c.trim(a).length>0}},remote:function(a,b,d){if(this.optional(b))return"dependency-mismatch";var e=this.previousValue(b);this.settings.messages[b.name]||(this.settings.messages[b.name]={});e.originalMessage=this.settings.messages[b.name].remote;this.settings.messages[b.name].remote=e.message;d=typeof d=="string"&&{url:d}||d;if(this.pending[b.name])return"pending";if(e.old===a)return e.valid;e.old=a;var f=this;this.startRequest(b);var g={};g[b.name]=a;c.ajax(c.extend(true,{url:d,
mode:"abort",port:"validate"+b.name,dataType:"json",data:g,success:function(h){f.settings.messages[b.name].remote=e.originalMessage;var j=h===true;if(j){var i=f.formSubmitted;f.prepareElement(b);f.formSubmitted=i;f.successList.push(b);f.showErrors()}else{i={};h=h||f.defaultMessage(b,"remote");i[b.name]=e.message=c.isFunction(h)?h(a):h;f.showErrors(i)}e.valid=j;f.stopRequest(b,j)}},d));return"pending"},minlength:function(a,b,d){return this.optional(b)||this.getLength(c.trim(a),b)>=d},maxlength:function(a,
b,d){return this.optional(b)||this.getLength(c.trim(a),b)<=d},rangelength:function(a,b,d){a=this.getLength(c.trim(a),b);return this.optional(b)||a>=d[0]&&a<=d[1]},min:function(a,b,d){return this.optional(b)||a>=d},max:function(a,b,d){return this.optional(b)||a<=d},range:function(a,b,d){return this.optional(b)||a>=d[0]&&a<=d[1]},email:function(a,b){return this.optional(b)||/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))$/i.test(a)},
url:function(a,b){return this.optional(b)||/^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(a)},
date:function(a,b){return this.optional(b)||!/Invalid|NaN/.test(new Date(a))},dateISO:function(a,b){return this.optional(b)||/^\d{4}[\/-]\d{1,2}[\/-]\d{1,2}$/.test(a)},number:function(a,b){return this.optional(b)||/^-?(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test(a)},digits:function(a,b){return this.optional(b)||/^\d+$/.test(a)},creditcard:function(a,b){if(this.optional(b))return"dependency-mismatch";if(/[^0-9 -]+/.test(a))return false;var d=0,e=0,f=false;a=a.replace(/\D/g,"");for(var g=a.length-1;g>=
0;g--){e=a.charAt(g);e=parseInt(e,10);if(f)if((e*=2)>9)e-=9;d+=e;f=!f}return d%10==0},accept:function(a,b,d){d=typeof d=="string"?d.replace(/,/g,"|"):"png|jpe?g|gif";return this.optional(b)||a.match(RegExp(".("+d+")$","i"))},equalTo:function(a,b,d){d=c(d).unbind(".validate-equalTo").bind("blur.validate-equalTo",function(){c(b).valid()});return a==d.val()}}});c.format=c.validator.format})(jQuery);



(function(c){var a={};if(c.ajaxPrefilter)c.ajaxPrefilter(function(d,e,f){e=d.port;if(d.mode=="abort"){a[e]&&a[e].abort();a[e]=f}});else{var b=c.ajax;c.ajax=function(d){var e=("port"in d?d:c.ajaxSettings).port;if(("mode"in d?d:c.ajaxSettings).mode=="abort"){a[e]&&a[e].abort();return a[e]=b.apply(this,arguments)}return b.apply(this,arguments)}}})(jQuery);


(function(c){!jQuery.event.special.focusin&&!jQuery.event.special.focusout&&document.addEventListener&&c.each({focus:"focusin",blur:"focusout"},function(a,b){function d(e){e=c.event.fix(e);e.type=b;return c.event.handle.call(this,e)}c.event.special[b]={setup:function(){this.addEventListener(a,d,true)},teardown:function(){this.removeEventListener(a,d,true)},handler:function(e){arguments[0]=c.event.fix(e);arguments[0].type=b;return c.event.handle.apply(this,arguments)}}});c.extend(c.fn,{validateDelegate:function(a,
b,d){return this.bind(b,function(e){var f=c(e.target);if(f.is(a))return d.apply(f,arguments)})}})})(jQuery);










// file jquery.validate.min.js end
