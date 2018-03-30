jQuery(document).ready(function ($) {
	"use strict";

/* masonry
---------------------------------------------------------------------------------------------*/
	var $masonry_container = $('.masonry_container,.woocommerce ul.products');
	// initialize Masonry after all images have loaded  
	$masonry_container.imagesLoaded( function() {
	  $masonry_container.masonry();
	});

	
/* scroll
---------------------------------------------------------------------------------------------*/
	if( window.niceScroll === 1 ){
		$(window).load(function(){
			$("body").imagesLoaded(function(){
				$("html").niceScroll({
				cursorcolor:activeColor,
				autohidemode:false,
				cursoropacitymin:0.2,
				scrollspeed:70,
				mousescrollstep :40,
				cursorborder:"0",
				cursoropacitymax:0.7,
				cursorborderradius:"0",
				cursorwidth:6,
				background:"none"
				});
			})	
			
		});
		
		
		$("body").imagesLoaded(function(){
			setInterval(function(){
				$("html").getNiceScroll().resize();
			},500);
			
		});	
	}

	

/* waypoint animation
---------------------------------------------------------------------------------------------*/
	$('.animate-init').waypoint(function() {
		 var animation = $(this).attr('data-animation');
		$(this).css('opacity','1');
		$(this).addClass("animated " + animation);
	}, {
		offset: '80%',
		context: window,
        triggerOnce: true
	});

	
/* prettyPhoto for lightbox
---------------------------------------------------------------------------------------------*/	
	$("a[data-rel^='prettyPhoto'], a[rel^='prettyPhoto']").prettyPhoto({
		animation_speed: 'fast',
		slideshow: 10000,
		default_width: 800,
		deeplinking: false
	});
	
/* Full width background of promobox
---------------------------------------------------------------------------------------------*/	
	function PromoFullBg(){	
		$(".promobg-full").each(function(){	
				var pos = $(this).closest('.promobox').offset();						
				var FullWidth = $('body').width();
				$(this).css('width',FullWidth+'px').css('left','-'+pos.left+'px');
			
		});
	}
	
	PromoFullBg();
	
	$(window).resize(function() {
		PromoFullBg();
	});
	
	$(window).load(function() {
		PromoFullBg();
	});

	
/* Caroufredsel
---------------------------------------------------------------------------------------------*/		
	if($('.latest-post').length>0){
		$('.latest-post').each( function(){
			$(this).carouFredSel({
				responsive: true,
				auto: false,
				prev: $(this).parents('.carousel-box').find('.prev'),
				next:  $(this).parents('.carousel-box').find('.next'),
				width: "100%",
				mousewheel: false,
				scroll : {
						easing          : "easeInCubic",
						duration        : 800,                         
						pauseOnHover    : true
				  },
				swipe: {
								onMouse: true,
								onTouch: true
							},
				items: {
					width: 400,
					visible: {
						min: 1,
						max: 4
					}
				}
			});	
		});	
	}

	
	
	// related post
	if($('#related-posts').length>0){
		$('#related-posts').carouFredSel({
			responsive: true,
			auto: false,
			prev: $(this).find('.prev'),
			next:  $(this).find('.next'),
			width: "100%",
			mousewheel: false,
			scroll : {
					easing          : "easeInCubic",
					duration        : 1000,                         
					pauseOnHover    : true
			  },  
			swipe: {
							onMouse: true,
							onTouch: true
						},
			items: {
				width: 365,
				visible: {
					min: 1,
					max: 4
				}
			}
		});	
	}
	
	//related product
	
  if($('.related.products').length>0){
	$('.related.products > .products').carouFredSel({
			responsive: true,
			auto: false,
			prev: $(this).find('.pre'),
			next:  $(this).find('.nex'),
			width: "100%",
			mousewheel: false,
			scroll : {
					easing          : "easeInCubic",
					duration        : 200,                         
					pauseOnHover    : true
			  },  
			swipe: {
							onMouse: true,
							onTouch: true
						},
			items: {
				width: 365,
				visible: {
					min: 1,
					max: 4
				}
			}
		});	
  }
  
  	
	//linked product
	
  if($('.linked-products .products').length>0){
	$('.linked-products .products').carouFredSel({
			responsive: true,
			auto: false,
			prev: $(this).find('.prev'),
			next:  $(this).find('.next'),
			width: "100%",
			mousewheel: false,
			scroll : {
					easing          : "easeInCubic",
					duration        : 700,                         
					pauseOnHover    : true
			  },  
			swipe: {
							onMouse: true,
							onTouch: true
						},
			items: {
				width: 365,
				visible: {
					min: 1,
					max: 4
				}
			}
		});	
  }


/* Accordion
---------------------------------------------------------------------------------------------*/	
	$('.unik-accordion').each(function(){
		$('.unik-accordion h5.active').next('div').show();	
	});
	
		
	$('.unik-accordion h5.accordion').click(function(){
		var thisTitle = $(this);
		if(thisTitle.hasClass('active')){
				thisTitle.removeClass('active').next('div.accordion-content').slideUp(400);
		}
		else{
			thisTitle.addClass('active').next('div.accordion-content').slideDown(400);
			if(! thisTitle.parents('.unik-accordion:first').hasClass('multi-active')){
				thisTitle.siblings().removeClass('active').next('div.accordion-content').slideUp(400);
			}
			
		}
		});
	
/* BOOTSTRAP TOOLTIP
---------------------------------------------------------------------------------------------*/	
	$('footer a').tooltip();
	$("[data-toggle^='tooltip']").tooltip();
	$('.tagcloud a').tooltip();
	
	
	$('[data-rel=popimg]').popover({
		html: true,
		placement : 'top',
		selector : $(this),
		trigger: 'hover',
		content: function () {
		return $(this).html();
		}
	});
	
/* FLEX SLIDER.
---------------------------------------------------------------------------------------------*/

	$('.thumbnail-carousel').flexslider({
		animation: "slide",
		animationLoop: true,
		controlNav: true,
		smoothHeight: true
	});
	
	// testimonial
	
	$('.testimonial').flexslider({
		animation: "fade",
		startAt: 0,                    
		slideshow: true,                
		slideshowSpeed: 7000,           
		animationSpeed: 600,            
		initDelay: 0,
		animationLoop: true,
		controlNav: false,
		smoothHeight: true,
		directionNav: false,
	});
	
	// product slide on hover
	
	$('.product-slides').flexslider({
		animation: "fade",
		slideshowSpeed: 1800,
		slideshow: false,
		animationLoop: true,
		controlNav: false,
		smoothHeight: true,
		directionNav: false,
	});
	
	$('.product-slides').hover(
		function(){
			$('.product-slides').flexslider("play");
		},
		function(){
			$('.product-slides').flexslider("pause");
		}
	);
			
	// product single image gallery
	$('.product-img-gal').flexslider({
    animation: "slide",
    animationLoop: false,
    itemWidth: 100,
    itemMargin: 5
  });
		 
/* fit vid for responsive video
---------------------------------------------------------------------------------------------*/	
	$('.post-video').fitVids();
	$('.video').fitVids();
	
	



/* product-gallery
---------------------------------------------------------------------------------------------*/	
	$('.product-img-gal a').click(function(e){
		e.preventDefault();
		var smallImage = $(this).children('img').attr('src');
		var largeImage = $(this).attr('data-zoom-image');
		if(largeImage !== $('#product-img-zoom').attr('src')){
			$('.product-img-box').append('<div class="refresh" style="display: block; opacity: 1;"><i class="icon-spin3 animate-spin"></i></div>');
			var ez = $('#product-img-zoom').data('elevateZoom');
			ez.swaptheimage(largeImage, largeImage);
			
			
	
			$('.product-img-box').imagesLoaded(function(){
				$('.product-img-box .refresh').hide();
				
				$('.zoomWindowContainer div').css('height',$('#product-img-zoom').height()+'px');
			});
		}				
	});
	

	$('#product-img-zoom').elevateZoom({
		zoomType: "inner",
		cursor: "crosshair",
		zoomWindowFadeIn: 500,
		zoomWindowFadeOut: 750,
		gallery:'product-img-gal', 
		galleryActiveClass: "active"
	}); 
	
	setTimeout(
		function(){
			$('.audio-autoplay-yes:last').find('.cp-play').trigger('click');
		},3000
	);
	

});