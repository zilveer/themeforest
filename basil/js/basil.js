jQuery(document).ready(function($) {


	var $window = $(window);
	
	
	/***************** WOW ANIMATIONS ******************/
	if ($('.wow').length){
		new WOW().init();
	}
	
	
	/***************** NAVIGATION DROPDOWNS ******************/
	if ($('ul.basilNav').length){
		
		$('ul.basilNav').find('> li').each(function(){
			if ( $(this).has('ul.sub-menu').length ){
				$(this).find('> a').append('<i class="fa fa-angle-down"></i>');
			}
		});
		
		$('ul.basilNav ul.sub-menu').find('> li').each(function(){
			if ( $(this).has('ul.sub-menu').length ){
				$(this).find('> a').append('<i class="fa fa-angle-right"></i>');
			}
		});
		
		$('ul.basilNav li').hover(function(){
			if ( $(this).has('ul.sub-menu').length ){
				$(this).find('> ul.sub-menu').fadeIn('fast');
			}
		},function(){
			if ( $(this).has('ul.sub-menu').length ){
				$(this).find('> ul.sub-menu').hide();
			}
		});
		
	}
	
	
	/* Search Button Click */
	$('body').on('click','.searchsubmit',function(e){
		e.preventDefault();
		var searchValue = $(this).parent().find('input[type=text]').val();
		if (searchValue){
			$(this).parents('form').trigger('submit');
		} else {
			return false;
		}
	});
	
	
	if ($('#cooked-video-lb').length){
		$('.fancy-video').fancybox({
			fitToView	: true,
			width		: '90%',
			height		: 'auto',
			autoSize	: false,
			type		: 'inline',
			beforeShow	: function(){
				$('#cooked-video-lb').fitVids();
			},
		});
	}
	
	
	/***************** FITVIDS ******************/
    if ($('.basilPageContent .post').length){
    	$('.basilPageContent .post').fitVids();
    }
    
    
    /***************** SLICKNAV ******************/
    $('ul#mobileNav').slicknav({
		label: '',
		duration: 400,
		easingOpen: "easeOutExpo", //available with jQuery UI
		easingClose: "easeOutExpo",
		prependTo:'#mobileSlickNav'
	});
    
    
    /***************** ISOTOPE FOR BLOG PANELS ******************/
	
	if ($('.basilPostPanels').length){
		var $blogPanels = $('.basilPostPanels');
		
		// initialize Isotope
		function blogMasonry() {
			var column;
			if ( $window.width() > 770 ){
				column = 3;
			} else if ( $window.width() < 770 && $window.width() > 519 ){
				column = 2;
			} else {
				column = 1;
			}
			
			$blogPanels.isotope({
			  resizable: false,
			  masonry: { columnWidth: $blogPanels.width() / column }
			});
		}
	
		setTimeout(function(){
			blogMasonry();
		},100);
		
		setInterval(function(){
			blogMasonry();
		},3000);
		
		$window
		.on('resize', function(){
			setTimeout(function() {
				blogMasonry();
			}, 100);
		});
	}
	
	
	/***************** ISOTOPE FOR FEATURED RECIPES ******************/
	if ($('.basilFeatured').length){
		var $featured = $('.basilFeatured .result-section .loading-content');
		
		// initialize Isotope
		function featuredMasonry() {
			var column;
			if ( $window.width() > 770 ){
				column = 3;
			} else if ( $window.width() < 770 && $window.width() > 519 ){
				column = 2;
			} else {
				column = 1;
			}
			
			$featured.isotope({
			  resizable: false,
			  masonry: { columnWidth: $featured.width() / column }
			});
		}
	
		setTimeout(function(){
			featuredMasonry();
		},100);
		
		setInterval(function(){
			featuredMasonry();
		},3000);
		
		$window
		.on('resize', function(){
			setTimeout(function() {
				featuredMasonry();
			}, 100);
		});
	}
	
	

	/* Initiate the Slider */
	basilSlider_cycle_speed = 6000;
	
	$window
	.on('load', function(){
	
		if ($('.basilSlider').length){
			if ($window.width() < 770){
				$(".basilRecipeSlider").trigger("destroy");
				$(".basilImageSlider").trigger("destroy");
				initBasilResponsiveCarousel();
			} else {
				$(".basilRecipeSlider").trigger("destroy");
				$(".basilImageSlider").trigger("destroy");
				initBasilCarousel();
			}
		}
		if ($('.basilTweetsCarousel').length){
			initTweetsCarousel();
		}
	    
	})
	.on('resize', function(){
		if ($('.basilSlider').length){
			if ($window.width() < 770){
				$(".basilRecipeSlider").trigger("destroy");
				$(".basilImageSlider").trigger("destroy");
				initBasilResponsiveCarousel();
			} else {
				$(".basilRecipeSlider").trigger("destroy");
				$(".basilImageSlider").trigger("destroy");
				initBasilCarousel();
			}
		}
	});
		
	// Basil Slider Buttons
	if ($('.basilSlider').length){
		$('.basilSlider').on('mouseenter', function(){
			jQuery(this).find('.basilImageSlider').trigger('pause');
			jQuery(this).find('.basilRecipeSlider').trigger('pause');	
		}).on('mouseleave', function(){
			jQuery(this).find('.basilImageSlider').trigger('play');
			jQuery(this).find('.basilRecipeSlider').trigger('play');	
		});	
		$('.basilSlider .basilSliderPrev').on('click', function(){
			jQuery(this).parents('.basilSlider').find('.basilImageSlider').trigger('prev', 1);
			jQuery(this).parents('.basilSlider').find('.basilRecipeSlider').trigger('prev', 1);
			return false;
		});
		$('.basilSlider .basilSliderNext').on('click', function(){
			jQuery(this).parents('.basilSlider').find('.basilImageSlider').trigger('next', 1);
			jQuery(this).parents('.basilSlider').find('.basilRecipeSlider').trigger('next', 1);
			return false;
		});
	}
	
	// Tweet Slider Buttons
	if ($('.basilTweetsCarousel').length){
		$('.basilTweetsCarousel').on('mouseenter', function(){
			$(this).parent().find('.basilTweetsCarousel').trigger('pause');
		}).on('mouseleave', function(){
			$(this).parent().find('.basilTweetsCarousel').trigger('play');	
		});	
		$('.basilTweetsPrev').on('click', function(){
			$(this).parent().find('.basilTweetsCarousel').trigger('prev', 1);
			return false;
		});
		$('.basilTweetsNext').on('click', function(){
			$(this).parent().find('.basilTweetsCarousel').trigger('next', 1);
			return false;
		});
	}
	
	/***************** PARALLAX SECTIONS ******************/

	var $window = $(window);
	var windowHeight = $window.height();
	
	$window.resize(function () {
		windowHeight = $window.height();
	});
	
	$.fn.parallax = function(xpos, speedFactor, outerHeight) {
		var $this = $(this);
		var getHeight;
		var firstTop;
		var paddingTop = 0;
		
		//get the starting position of each element to have parallax applied to it		
		$this.each(function(){
		    firstTop = $this.offset().top;
		});
		
		$window.resize(function () {
			$this.each(function(){
		  	    firstTop = $this.offset().top;
			});
		});
		
		$window.load(function(){
			$this.each(function(){
		  	    firstTop = $this.offset().top;
			}); 
		});
	 
		$window.scroll(function(){
			$this.each(function(){
				firstTop = $this.offset().top;
			}); 
		});
	
		getHeight = function(jqo) {
			return jqo.outerHeight(true);
		};
		 
			
		// setup defaults if arguments aren't specified
		if (arguments.length < 1 || xpos === null) xpos = "50%";
		if (arguments.length < 2 || speedFactor === null) speedFactor = 0.1;
		if (arguments.length < 3 || outerHeight === null) outerHeight = true;
		
		// function to be called whenever the window is scrolled or resized
		function update(){
			var pos = $window.scrollTop();				
	
			$this.each(function(){
				var $element = $(this);
				var top = $element.offset().top;
				var height = getHeight($element);
				// Check if totally above or totally below viewport
				if (top + height < pos || top > pos + windowHeight) {
					return;
				}
	
				$this.css('backgroundPosition', xpos + " " + Math.round((firstTop - pos) * speedFactor) + "px");
			});
		}		
	
		$window.bind('scroll', update).resize(update);
		update();
	};
	
	if ($('.basilParallax-zone').length){
		$('.basilParallax-zone').each(function(){
			var $id = $(this).attr('id');
			$('#'+$id + ".basilParallax-zone").parallax("50%", 0.4);
		});
    }


});

// Initiate Basil Carousel
function initBasilCarousel() {

	if ( jQuery('.basilSlider').length ){
		
		jQuery('.basilImageSlider').each(function(){
			jQuery(this).carouFredSel({
				auto: basilSlider_cycle_speed,
			    responsive: true,
			    scroll: {
			    	duration: 800,
			    	easing: 'easeInOutExpo',
			    	fx: 'crossfade',
			    }
			});
		});
		
		jQuery('.basilRecipeSlider').each(function(){
			jQuery(this).carouFredSel({
				auto : basilSlider_cycle_speed,
			    width : 492,
			    height : 398,
			    items: {
			        visible: 1,
			        width: 492,
			        height : 398,
			    },
			    scroll: {
			    	duration: 800,
			    	easing: 'easeInOutExpo'
			    },
			    onCreate: function(){
				    jQuery('.basilRecipeSlider,.basilSliderNav,.basilRecipeSliderBG').addClass('shown');
			    }
			});
		});
		
	}
		
}

// Initiate Responsive Basil Carousel
function initBasilResponsiveCarousel() {

	if ( jQuery('.basilSlider').length ){
		
		jQuery('.basilImageSlider').each(function(){
			jQuery(this).carouFredSel({
				auto: basilSlider_cycle_speed,
			    responsive: true,
			    scroll: {
			    	duration: 800,
			    	easing: 'easeInOutExpo',
			    	fx: 'crossfade',
			    }
			});
		});
		
		jQuery('.basilRecipeSlider').each(function(){
			jQuery(this).carouFredSel({
				auto : basilSlider_cycle_speed,
				height: 620,
			    responsive: true,
			    items: {
			        visible: 1,
			    },
			    scroll: {
			    	duration: 800,
			    	easing: 'easeInOutExpo'
			    },
			    onCreate: function(){
				    jQuery('.basilRecipeSlider,.basilSliderNav,.basilRecipeSliderBG').addClass('shown');
			    }
			});
		});
		
	}
		
}

// Initiate Tweets Carousel
function initTweetsCarousel(){

	if (jQuery('.basilTweetsCarousel').length){
	
		jQuery('.basilTweetsCarousel').each(function(){
			jQuery(this).carouFredSel({
				auto: false,
				width: 1440,
				height: 'variable',
			    responsive: true,
			    items: {
			        visible: 1,
			        width: 1440,
			    },
			    scroll: {
			    	duration: 700,
			    	easing: 'easeInOutExpo'
			    }
			});
			
		});
		
		jQuery('.basilTweetsCarousel').on('mouseenter', function(){
			jQuery(this).parent().find('.basilTweetsCarousel').trigger('pause');
		}).on('mouseleave', function(){
			jQuery(this).parent().find('.basilTweetsCarousel').trigger('play');	
		});	
		jQuery('.basilTweetsPrev').on('click', function(){
			jQuery(this).parent().find('.basilTweetsCarousel').trigger('prev', 1);
			return false;
		});
		jQuery('.basilTweetsNext').on('click', function(){
			jQuery(this).parent().find('.basilTweetsCarousel').trigger('next', 1);
			return false;
		});
		
	}
	
}