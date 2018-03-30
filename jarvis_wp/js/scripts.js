var testMobile,
    i = true,
    loadingError = '<p class="error">The Content cannot be loaded.</p>',
    current,
    next,
    prev,
    target,
    hash,
    url,
    page,
    title,
    wrapperHeight,
    projectIndex,
    scrollPostition,
    projectLength,
    ajaxLoading = false,
    pageRefresh = true,
    content = false,
    loader = jQuery('div#loader'),
    portfolioGrid = jQuery('div#portfolio-wrap'),
    projectContainer = jQuery('div#ajax-content-inner'),
    projectNav = jQuery('#project-navigation ul'),
    exitProject = jQuery('div#closeProject a'),
    folderName = 'portfolio-item',
    headerH = jQuery('nav.navigation').height(),
    rnrSafari = (jQuery.browser.webkit && !(/chrome/.test(navigator.userAgent.toLowerCase())));		

	 
/*----------------------------------------------------*/
/* PAGE LOADER
/*----------------------------------------------------*/
jQuery('#load').delay(600).fadeOut();   
/*----------------------------------------------------*/
// PRELOADER CALLING
/*----------------------------------------------------*/    
    jQuery("body[data-preoload='0'].onepage").queryLoader2({
        barColor: "#111111",
        backgroundColor: "#ffffff",
        percentage: true,
        barHeight: 3,
        completeAnimation: "fade",
        minimumTime: 1000
    });  


/*----------------------------------------------------*/
/* HOME PARALLAX FUNCTION
/*----------------------------------------------------*/	
function rnrHomeParallax() {
	  jQuery(window).scroll(function() {
		  var yPos = -(jQuery(window).scrollTop() / 2); 
  
		  var coords = '50%'+ yPos + 'px';
		  jQuery('.home-parallax').css({ backgroundPosition: coords });
	  
	  }); 
}

/*----------------------------------------------------*/
/* SLAB TEXT FUNCTION
/*----------------------------------------------------*/	
function rnrSlabtext() {	  
	  jQuery(".home-quote h1").slabText({
			"viewportBreakpoint":300			
	  });
}


/*----------------------------------------------------*/
/* PORTFOLIO ISOTOPE
/*----------------------------------------------------*/
function rnrPortfolio(){	

			var loadMoreButton = jQuery('#port-infinite a');
		/*----------------------------------------------------*/
		/* ISOTOPE FUNCTION
		/*----------------------------------------------------*/	
			portfolioGrid.isotope({
				animationEngine : 'best-available',
				animationOptions: {
					duration: 200,
					queue: true
				},
				onLayout: function() {
                    jQuery(window).trigger("scroll");
                },
				layoutMode: 'masonry'
			});
			
			
			 loadMoreButton.on('click', function() {
				if (!jQuery(this).hasClass('pagination-loading')) {
				  jQuery(this).addClass('pagination-loading');
				}
		
			  });
		
		
		/*----------------------------------------------------*/
		/* INFINITE SCROLL FUNCTION
		/*----------------------------------------------------*/		
			portfolioGrid.infinitescroll({
					navSelector : '#port-pagination',
					nextSelector : '#port-pagination a ',
					itemSelector : '.portfolio-item',
					bufferPx: 70,
					appendCallback: true,
					
					loading: {
					  finishedMsg: "",
					  img: "",
					  msg: null,
					  msgText: "",
					  selector: loadMoreButton,
					  speed: 300,
					  start: undefined         
				   },
				   
					errorCallback: function(){
							jQuery('#port-infinite a').remove();	
												
						},
			 
					finish: function(){
					  	
					},
				},
				
				function(newElements) {
				  var newElems = jQuery(newElements);
				  
                  newElems.hide();
				  newElems.imagesLoaded(function(){
					portfolioGrid.isotope('appended', newElems );
					
					setTimeout(function() {
					  newElems.show();					
					  setColumns();
					  rnrPortfolioLazyLoad();
					  rnrPrettyPhoto();	
					  portfolioGrid.isotope('layout');
					  
					}, 450);
			
				  });
				}
			);	
			
			jQuery(window).unbind('.infscr');	
			loadMoreButton.on('click',function() {

			  portfolioGrid.infinitescroll('retrieve');
			  return false;
	
			});
		
			jQuery('#filters a').click(function(){
				jQuery('#filters a').removeClass('active');
				jQuery(this).addClass('active');
				var selector = jQuery(this).attr('data-filter');
				portfolioGrid.isotope({ filter: selector });	
				return false;
			});		
		
			function setColumns() { 
				portfolioGrid.isotope('reLayout');
			}	
			setColumns();		
			
			
			portfolioGrid.waitForImages(function () { 
				setColumns();
			});
			
			
			jQuery(window).bind('resize', function () { 
				setColumns();			
			});						
 }

/*----------------------------------------------------*/
/* LAZY LOADING
/*----------------------------------------------------*/
function rnrLazyLoad(){
        var rnrLazy = jQuery("img.rnr-lazyload");
    
        rnrLazy.lazyload({
            effect: 'fadeIn',
            event : 'scroll',
			threshold : 200,

			load : function() {
				jQuery.waypoints("refresh");
				jQuery("img.rnr-lazyload").each(function() {
					    jQuery(this).appear(function(i) {
					     jQuery(this).animate({opacity: 1 }, 2*i);
						});	
					   
				  });				
	
				  			
			},
            failure_limit: Math.max(rnrLazy.length - 1, 0)
        });		
}

/*----------------------------------------------------*/
/* PORTFOLIO LAZY LOADING
/*----------------------------------------------------*/
function rnrPortfolioLazyLoad(){
var rnrPortfolioLazy = jQuery("img.portfolio-lazyload, img.rnr-lazyLoad");
jQuery('.portfolio-lazyLoad').lazyload({
            effect: 'fadeIn',
			threshold : 200,
            event : 'scroll',
			load : function() {
				jQuery.waypoints("refresh");				
				
					portfolioGrid.isotope('reLayout');	
			},
            failure_limit: Math.max(rnrPortfolioLazy.length - 1, 0)
        });	
		
}


   


/*----------------------------------------------------*/
/* FULLSCREEN IMAGE HEIGHT
/*----------------------------------------------------*/
function rnrFullScreen(){
	window_height = jQuery(window).height();
	jQuery('.fullscreen, .background-video').css({height:window_height});		  
}

/*----------------------------------------------------*/
/* FULLWIDTH SECTION
/*----------------------------------------------------*/	
function rnrFullWidth(){
		$offset_block = ((jQuery(window).width() - parseInt(jQuery('.sixteen').width())) / 2); 
		
		jQuery('.full-width').each(function(){		
				jQuery(this).css({
					'margin-left': - $offset_block,
					'padding-left': $offset_block,
					'padding-right': $offset_block
				});			
			
		});
	
		jQuery('html[dir="rtl"] .full-width').each(function(){		
				jQuery(this).css({
					'margin-right': - $offset_block,
					'padding-left': $offset_block,
					'padding-right': $offset_block
				});			
			
		});		
}	
rnrFullScreen();
 
	
/*----------------------------------------------------*/
/* FALLBACK FOR IPHONE
/*----------------------------------------------------*/   
function rnrFullVideo() { 
	var winWidth = jQuery(window).width();
	
	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
		jQuery('.home-video .rnr-video').empty();
	} 
}

 
/*----------------------------------------------------*/
/* FLEXSLIDER FUNCTION
/*----------------------------------------------------*/   
function rnrFlexSlider() {	 

		  jQuery('.flexslider').flexslider({						
				  animation: "slide",
				  direction: "horizontal", 
				  slideshow: false,
				  slideshowSpeed: 3500,
				  animationDuration: 500,
				  directionNav: true,
				  controlNav: false
					  
		   });	
			jQuery('.flexslider .flex-direction-nav li a.flex-next').html('<i class="fa fa-angle-right"></i>');
			jQuery('.flexslider .flex-direction-nav li a.flex-prev').html('<i class="fa fa-angle-left"></i>');		   	 

} 	

/*----------------------------------------------------*/
/* TEXT SLIDER FUNCTION
/*----------------------------------------------------*/   
function rnrHomeTextSlider() {	
		
		jQuery('#home-slider').flexslider({						
				animation: "slide",
				direction: "vertical", 
				slideshow: true,
				slideshowSpeed: 3500,
				animationDuration: 1000,
				directionNav: false,
				controlNav: true,
				start: function () {
				 jQuery(window).trigger('resize'); 
			    },
				after: function(slider){
                 jQuery('#home-slider').resize();
                }
		 });
		 jQuery('#home-slider .home-slide-content').fitText(1.5);				   
}

	
/* ------------------------------------------------------------------------ */
/* TRANSPARENT NAV */
/* ------------------------------------------------------------------------ */ 
function rnrTransparentNav() {	
        var admin_bar_height = 0;
 
	headerH = jQuery('nav.navigation').height();
		var home_height =  jQuery('.home-parallax, .home-video, .home-fullscreenslider').outerHeight();
	
	if (jQuery(window).scrollTop() > home_height-headerH-1){
		jQuery('nav.transparent').addClass('scroll');		
	} else {
		jQuery('nav.transparent').removeClass('scroll');				
	}
	
	jQuery('body:not(.page-template-frontpage) nav.transparent').addClass('scroll');
	
	
	
	
	jQuery(window).on("scroll", function(){
		var winHeight = jQuery(window).height();
		var windowWidth = jQuery(window).width();
		var windowScroll = jQuery(window).scrollTop();
		var home_height =  jQuery('.home-parallax, .home-video, .home-fullscreenslider').outerHeight();

			if (jQuery(window).scrollTop() > home_height-headerH-1){
				jQuery('nav.transparent').addClass('scroll');										
			} else {
				jQuery('nav.transparent').removeClass('scroll');									
			}

		
	  });
}

/* ------------------------------------------------------------------------ */
/* DROP DOWN SUPERFISH MENU */
/* ------------------------------------------------------------------------ */ 
function rnrDropDownMenu() {	
	jQuery("#nav").superfish({
		delay:       500,
		animation:   {opacity:'show',height:'show'},
		speed:       300,
		autoArrows:  false, 
		dropShadows: false,
	});
}

/* ------------------------------------------------------------------------ */
/* MEMBER BIO RESIZE */
/* ------------------------------------------------------------------------ */ 
function rnrMemberBioHeight() {	
	jQuery('.member-bio').each(function(){
	    var bioHeight = window.innerHeight - 100;
	    jQuery(this).css('max-height', bioHeight);
	});
}

/* ------------------------------------------------------------------------ */
/* BACK TO TOP 
/* ------------------------------------------------------------------------ */
function rnrBackToTop() {	
	jQuery(window).scroll(function(){
		if(jQuery(window).scrollTop() > 800){
			jQuery("#back-to-top").fadeIn(200);
		} else{
			jQuery("#back-to-top").fadeOut(200);
		}
	});
	
	jQuery('#back-to-top, .back-to-top').click(function() {
		  jQuery('html, body').animate({ scrollTop:0 }, '800');
		  return false;
	});
}

isAnimating = true;

/* ------------------------------------------------------------------------ */
/* MENU SCROLL FUNCTION
/* ------------------------------------------------------------------------ */ 
function rnrMenuScroll() {	
	jQuery('.main-menu a, .logo a, .home-logo-text a, .home-logo a, .scroll-to').click( function(event) { 		
			  var home_height =  jQuery('.home-parallax').outerHeight();
				 headerH = jQuery('nav.navigation').height();		
			   if ((jQuery(window).scrollTop() <= home_height)){
				 headerH = jQuery('nav.navigation').height();					 
			  }
	
					
		if(this.hash) {			
				jQuery.scrollTo( jQuery(jQuery(this).attr('href')), 1300, { easing: "easeInOutExpo" , offset:  -headerH, 'axis':'y' } );	
				event.preventDefault();									
			}			
				
     	headerH = jQuery('nav.navigation').height(); 
    });
 
	
	
	  if( window.location.hash ) {	
	  var mod = window.location.hash;			
		  setTimeout ( function () {
		  
          jQuery("nav.navigation").sticky({ topSpacing: 0, className: 'sticky', wrapperClassName: 'main-menu-wrapper' }); 
		  headerH = jQuery('nav.navigation').height(); 															
			  jQuery.scrollTo( window.location.hash , 10, { easing: "easeInOutExpo" , offset:  -headerH, 'axis':'y' } );	
		  
		  
		  }, 200 );	
		  
		   
		    setTimeout(function() {
				jQuery.scrollTo( window.location.hash, 1000, { easing: "easeInOutExpo" , offset:  -headerH+3, 'axis':'y' } );
			},1000);
	  }
	  
	jQuery('.rnr-offset').each(function() {        	
		jQuery(this).waypoint( function( direction ) {				
			if( direction === 'down' ) {				
				var rnrSection = jQuery(this).data('section');
				
				if( jQuery(this).data('parent') ) {
					rnrSection = jQuery(this).data('parent');
				}
				
				jQuery('.navigation li').removeClass('active');
				jQuery(".navigation a[href*=#"+rnrSection+"]").parent().addClass("active");
								
			}
						
		} , { offset: headerH });			  	  
	});
	
	jQuery('.rnr-scroll-up').each(function() {        	
		jQuery(this).waypoint( function( direction ) {				
			if( direction === 'up' ) {					
				var rnrSection = jQuery(this).data('section');					
				if( jQuery(this).data('parent') ) {
					rnrSection = jQuery(this).data('parent');
				}
				jQuery('.navigation li').removeClass('active');
				jQuery(".navigation a[href*=#"+rnrSection+"]").parent().addClass("active");									
			}
						
		} , { offset: headerH });			  	  
	});	
	  
}


/*----------------------------------------------------*/
// ADD PRETTYPHOTO
/*----------------------------------------------------*/
function rnrPrettyPhoto() {	


		jQuery("a[data-rel^='prettyPhoto'], a[rel^='prettyPhoto'], a[data-rel^='prettyPhoto[product-gallery]']").prettyPhoto({
			theme: 'dark_rounded',
			allow_resize: true,
			default_width: 690,
			opacity: 0.85, 
			animation_speed: 'normal',
			deeplinking: false,
			default_height: 388,
			social_tools: '',
			markup: '<div class="pp_pic_holder"> \
						   <div class="ppt">&nbsp;</div> \
							<div class="pp_details"> \
								<div class="pp_nav"> \
								    <a href="#" class="pp_arrow_previous"> <i class="fa-angle-left fa icon-default-style"></i> </a> \
									<a href="#" class="pp_arrow_next"> <i class="fa-angle-right fa icon-default-style"></i> </a> \
									<p class="currentTextHolder">0/0</p> \
								</div> \
								<a class="pp_close" href="#"><span class="fa fa-times icon-default-style"></span></a> \
							</div> \
							<div class="pp_content_container"> \
								<div class="pp_left"> \
								<div class="pp_right"> \
									<div class="pp_content"> \
										<div class="pp_fade"> \
											<div class="pp_hoverContainer"> \
											</div> \
											<div id="pp_full_res"></div> \
										</div> \
									</div> \
								</div> \
								</div> \
							</div> \
						</div> \
						<div class="pp_loaderIcon"></div> \
						<div class="pp_overlay"></div>'
		});
		//add galleries to portfolios
		jQuery('.portfolio-item').each(function(){
			var $unique_id = Math.floor(Math.random()*10000);
			jQuery(this).find('.portfolio-gallery-image').attr('data-rel','prettyPhoto['+$unique_id+'_gal]');
		});

		jQuery('.gallery').each(function(){
			var $gallery_id = Math.floor(Math.random()*1000);
			jQuery(this).find('.gallery-item a').attr('rel','prettyPhoto['+$gallery_id+'_gallery]');
		});
		
		jQuery('.flexslider').each(function(){
			var $slider_id = Math.floor(Math.random()*1000);
			jQuery(this).find('li a').attr('rel','prettyPhoto['+$slider_id+'_slider]');
		});	
		
		jQuery('.woocommerce .product .images').each(function(){
			var $unique_id = Math.floor(Math.random()*10000);
			jQuery(this).find('a').attr('rel','prettyPhoto['+$unique_id+'_product]');
		});	

		
}

rnrPrettyPhoto();



/*----------------------------------------------------*/
// MILESTONE COUNTER
/*----------------------------------------------------*/  
 (function($) {
    $.fn.countTo = function(options) {
        // merge the default plugin settings with the custom options
        options = $.extend({}, $.fn.countTo.defaults, options || {});

        // how many times to update the value, and how much to increment the value on each update
        var loops = Math.ceil(options.speed / options.refreshInterval),
            increment = (options.to - options.from) / loops;

        return jQuery(this).delay(1000).each(function() {
            var _this = this,
                loopCount = 0,
                value = options.from,
                interval = setInterval(updateTimer, options.refreshInterval);

            function updateTimer() {
                value += increment;
                loopCount++;
                jQuery(_this).html(value.toFixed(options.decimals));

                if (typeof(options.onUpdate) == 'function') {
                    options.onUpdate.call(_this, value);
                }

                if (loopCount >= loops) {
                    clearInterval(interval);
                    value = options.to;

                    if (typeof(options.onComplete) == 'function') {
                        options.onComplete.call(_this, value);
                    }
                }
            }
        });
    };

    $.fn.countTo.defaults = {
        from: 0,  // the number the element should start at
        to: 100,  // the number the element should end at
        speed: 1000,  // how long it should take to count between the target numbers
        refreshInterval: 100,  // how often the element should be updated
        decimals: 0,  // the number of decimal places to show
        onUpdate: null,  // callback method for every time the element is updated,
        onComplete: null,  // callback method for when the element finishes updating
    };
	
})(jQuery);

       

/* ------------------------------------------------------------------------ */
/* CAROUSEL */
/* ------------------------------------------------------------------------ */
function rnrCarousel() {	
jQuery('.rnr-carousel').each(function(){
	if( jQuery(this).length > 0 ){
		
		var nav_class = jQuery(this).data('carousel-id')
	
		jQuery(this).carouFredSel({
			width: '100%',
			height: '100%',
			prev: '#' + nav_class + 'prev',
			next: '#' +nav_class + 'next',
			align: "left",
			fx: "scroll",
			items: {
				height: '100%'
			},
			scroll : {
				items           : 1,
				easing          : "easeInOutExpo",
				duration        : 1000,                         
				pauseOnHover    : true
			},
			auto: false,
			visible: {
				min: 1,
				max: 10
			},
			circular: false
		});
	
	}	
});
}
	 
	 		
jQuery(window).load(function(){  
 
/* ------------------------------------------------------------------------ */
/* STICKY NAVIGATION */
/* ------------------------------------------------------------------------ */ 
jQuery("nav.sticky-nav").sticky({ topSpacing: 0, className: 'sticky', wrapperClassName: 'main-menu-wrapper' }); 


  rnrAjaxPortfolio(); 
  rnrSlabtext();


 jQuery(document).ready(function(){ 	
		jQuery(window).trigger( 'resize' );	
		jQuery(window).trigger( 'hashchange' );	
  rnrFlexSlider();
        rnrCarousel();  
        rnrHomeTextSlider();
		rnrHomeParallax();
		rnrFullWidth();
		rnrPortfolio();
		rnrTransparentNav();
		rnrDropDownMenu();
        rnrLazyLoad();
        rnrShortcodes();
		rnrMemberBioHeight();
		rnrBackToTop();
		rnrPortfolioLazyLoad();	
		rnrFullVideo();

     });	  
  setTimeout(rnrSlabtext, 5);
 

if ( !rnrSafari ) {
	jQuery('.home3').children('.container').addClass('no-safari');
}

		  








/* ------------------------------------------------------------------------ */
/* TEAM POP UP FIX */
/* ------------------------------------------------------------------------ */
jQuery('.team-member').parents('.section').css('z-index','inherit');
	  

/* ------------------------------------------------------------------------ */
/* SELECTNAV - A DROPDOWN NAVIGATION FOR SMALL SCREENS */
/* ------------------------------------------------------------------------ */ 
selectnav('nav', {
	nested: true,
	indent: '-'
});  
	
	
/*----------------------------------------------------*/
// ADD VIDEOS TO FIT ANY SCREEN
/*----------------------------------------------------*/
jQuery(".container").fitVids();	



  
});

//END OF DOCUMENT LOAD FUNCTION

 jQuery(window).bind('resize',function() {	  
	rnrFullScreen();	
	rnrFullWidth();
	rnrMemberBioHeight();
	
	var slider = jQuery('#home-slider');
	if(slider.find('.home-slide').length > 1) {
       	rnrHomeTextSlider();
	}
	
	
});	

jQuery(window).load(function(){  
    rnrMenuScroll();
});


