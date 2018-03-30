(function ($) { 
  "use strict"; 
  
	function caroufredselPreloadImages( $caroufredselImages, caroufredselImagesCount ) {		
		var loaded	= 0;				
		return $.Deferred(				
			function(dfd) {				
				$caroufredselImages.each( function( i ) {	
						$('<img/>').load( function() {
							if( ++loaded === caroufredselImagesCount ) {
								dfd.resolve();										
							}								
						}).attr( 'src', $(this).attr('src') );				
				});
			}					
		).promise();
	} // end preload
  
	jQuery(document).ready(function($) {		
			//fix for iOS orientation change
			if (navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i)) {
			  var viewportmeta = document.querySelector('meta[name="viewport"]');
			  if (viewportmeta) {
				viewportmeta.content = 'width=device-width, minimum-scale=1.0, maximum-scale=1.0';
				document.body.addEventListener('gesturestart', function() {
				  viewportmeta.content = 'width=device-width, minimum-scale=0.25, maximum-scale=1.6';
				}, false);
			  }
			}				
			
			//fix for image captions when blank, remove dark background
			$('.image-caption').each( function() {
				var imgCap = $(this);			
				if(imgCap.find('p').text() === ''){
					imgCap.css("padding-bottom", 0).css("padding-top", 0);
				}
			});
				
			// fix adding of <p> tag on blog post
			$('.entry-content p:empty').first().addClass('first-p');
			
			// activate first child of tabs
			$('.tabs-content li:first-child').addClass('active');
			
			// make button black
			$('form#commentform').find('input#submit').addClass('button');		
			 
			if($('body').hasClass('light-skin')){		
				$('input[type=submit]').addClass('black');
				$('button[type=submit]').addClass('black');
				$('button[type=reset]').addClass('black');				
			}		
			if($('body').hasClass('dark-skin')){			
				$('input[type=submit]').addClass('orange');
				$('button[type=submit]').addClass('orange');
				$('button[type=reset]').addClass('orange');	
			}
			
		/* -------------- Navigation Menu to Drop-down Menu on Mobile Browsers --------------*/
			if( caroufredsel_slider_settings.responsive !== '1' ) {		
				// Create the dropdown base
				$("<select />").appendTo("nav#access");
				// Create default option "Go to..."
				$("<option />", {
				   "selected": "selected",
				   "value"   : "",
				   "text"    : caroufredsel_slider_settings.go_to_string,
				}).appendTo("nav#access select");
				// Populate dropdown with menu items
				$("nav a").each(function() {
				 var el = $(this);
				 $("<option />", {
					 "value"   : el.attr("href"),
					 "text"    : el.text()
				 }).appendTo("nav#access select");
				});						
				$("nav#access select").change(function() {
				  window.location = $(this).find("option:selected").val();
				});			
			}	
		
		/* -------------- prettyPhoto jQuery Plugin for Images lightbox --------------*/	
			$("a[rel^='prettyPhoto']").prettyPhoto({	
				callback: function() {},
				changepicturecallback: function(){					
					$pp_pic_holder = $(".pp_pic_holder");		
					var $media_src = encodeURI($pp_pic_holder.find('#pp_full_res').children(':first-child').attr('src'));		
					var $encoded_URL = encodeURI(window.location.hostname + window.location.pathname);				
					$('.pp_social').append('<div class="pinterest-posts"><a href="http://pinterest.com/pin/create/button/?url=' + $encoded_URL + '&media=' + $media_src + '" class="pin-it-button" count-layout="horizontal">Pin It</a><script type="text/javascript" src="http://assets.pinterest.com/js/pinit.js"></script></div>');
				}, /* Called everytime an item is shown/changed */			
			});		
			
		/* -------------- clearfix for comment list --------------*/
			$('.comment-wrap .inner-content').append('<div class="clear"></div>');		
					
		/* -------------- Menu Navigation hover effect --------------*/
			var configMenu = { 
				over: function() {			
					var menuli = $(this);
					menuli.children('ul').stop(true, true).slideDown(200);	
					menuli.closest('li').children('a').addClass('current-selected');
				},
				timeout: 400,
				out: function() {
					var menuli = $(this);
					menuli.children('ul').stop(true, true).fadeOut(100);			
					menuli.closest('li').children('a').removeClass('current-selected');
				}
			}		
			$("#nav-container .menu li").hoverIntent( configMenu );
			
		/* -------------- Scroll to Top plugin --------------*/
			$('a.to-top').on( 'click', function(){				
				 $("html, body").animate({ scrollTop: 0 }, "slow");
			});
			
		/* -------------- Simple Hover Effect on Images -----------------*/
			$('.simple-hover, .slide-hover-effect').find('img').hover(
				function(){
					$(this).stop().animate({opacity: 0.8}, 750, 'easeOutCubic');					
				},function(){
					$(this).stop().animate({opacity: 1}, 750, 'easeOutCubic');										
				}
			);			
		
		/* -------------- Image Overlay Effects  --------------*/			
			$('.overlay').hover(			
				function(){				
					$(this).find('img').animate({ opacity:'0.8' }, 450, 'easeInOutCubic');
					$(this).find('.icon-view').stop(true, true).animate({ opacity: '0.75' }, 10, 'swing'); //, marginTop: '-0.5em'
					$(this).find('.icon-link').stop(true, true).animate({ opacity: '0.75' }, 10, 'swing'); //, marginTop: '-0.5em'
					$(this).find('h5').animate({ opacity: '1' }, 10, 'linear');
				},function(){					
					$(this).find('h5').animate({ opacity: '0.0' }, 300, 'linear');
					$(this).find('.icon-view').stop(true, true).animate({ opacity: '0.0' }, 10, 'swing'); //, marginTop: parentHeight
					$(this).find('.icon-link').stop(true, true).animate({ opacity: '0.0' }, 10, 'swing');//, marginTop: parentHeight					
					$(this).find('img').animate({ opacity: '1' }, 450, 'easeInOutCubic');
				}
			);	
			/* Overlay icons hover effect */
			$('.overlay .icon-view, .overlay .icon-link').hover(			
				function(){				
					$(this).stop(true, true).animate({ opacity: '1' }, 20);					
				},function(){
					$(this).stop(true, true).animate({ opacity: '0.75' }, 20);	
				}
			);		
					
		/* -------------- Accordion  --------------*/			
			// Hide first All Div Content
			$(".accordion-content").hide();		
			//Add Inactive Class To All Accordion Headers
			$('.accordion-button').toggleClass('inactive-header');				
			//Open The First Accordion Section When Page Loads
			$('.accordion-button').first().toggleClass('active-header').toggleClass('inactive-header');
			$('.accordion-content').first().slideDown().toggleClass('open-content');		
			//The Accordion Effect
			$('.accordion-button').click(function ( event ) {
				event.preventDefault();
				if($(this).is('.inactive-header')) {
					$('.active-header').toggleClass('active-header').toggleClass('inactive-header').next().slideToggle().toggleClass('open-content');
					$(this).toggleClass('active-header').toggleClass('inactive-header');
					$(this).next().slideToggle().toggleClass('open-content');
				}			
				else {
					$(this).toggleClass('active-header').toggleClass('inactive-header');
					$(this).next().slideToggle().toggleClass('open-content');
				}
			});
			
		/* -------------- Info Boxes  --------------*/
			$('.info-close-icon').click(function(event){
				event.preventDefault();			
				$(this).closest('#info-box').fadeOut('normal');			
			});		
			
		/* -------------- Border Radius plugin  --------------*/			
			$.fn.roundThis = function(radius) {
			return this.each(function(e) {
					$(this).css({
					   "border-radius": radius,
					   "-moz-border-radius": radius,
					   "-webkit-border-radius": radius
					});
				});
			};
			
			// Border Radius portfolio based on parent width or height (responsive)			
			var recentWorks = $("#recent-works").find('.overlay');
			$(recentWorks).roundThis($(this).width());		
			$(recentWorks).find('img').roundThis($(this).width());		
			
			// Portfolio circles		
			if (roundThisBlog.imageRounding == '0' || roundThisBlog.imageRounding == 'null' || roundThisBlog.imageRounding == null) { 
				$("#latest-blogs").find('.overlay').find('img').roundThis($(this).width());				
				$("#latest-blogs").find('.overlay').roundThis($(this).width());		
			}	
			$("#latest-blogs").find('.overlay.squared').find('img').roundThis(0);	
			$('.pic').roundThis($(this).width());				
			$(".portfolio-items").find('.overlay').find('img').roundThis($(this).width());		
			$(".avatar").find('img').roundThis($(this).width());		
					
		/* -------------- Social Icons  --------------*/			
			$('.social-icon')
				.css( {backgroundPosition: "0px 0px"} )
				.mouseover(function(){
					$(this).css({backgroundPosition: "0 -33px"});
				})
				.mouseout(function(){
					$(this).css({backgroundPosition: "0 0px"});
			});
				
		/* -------------- "Blog Page - 2" Post Format Gallery slider --------------*/	
			if(jQuery().carouFredSel && $('#post-format-slides-2').length != 0) {					
				$('#post-format-slides-2').carouFredSel({	
					circular: true,
					responsive: true,
					items 		: { 
						width : 220,
						height: 'auto',
						visible: 1
					},
					pagination: "#slider-pagination",
					auto : {
						easing		: "linear",
						duration	: 1300,
						pauseDuration: 4000,
						pauseOnHover: true,
					},
					scroll : {
						fx : 'crossfade'
					}
				});				
			}		
			
		/* -------------- Home Page - carouFredSel Slider --------------*/
			if(jQuery().carouFredSel && $('.slides-carousel').length != 0) {						
				var $caroufredselImages = $('.slides-carousel').find('img');
				var caroufredselImagesCount = $caroufredselImages.length;
				
				caroufredselPreloadImages( $caroufredselImages, caroufredselImagesCount );				
				$('.caroufredsel-preloader').show();			
				
				$.when( caroufredselPreloadImages( $caroufredselImages, caroufredselImagesCount ) ).done( function() {
				$('.caroufredsel-preloader').hide();
				$('.main-slider-caroufredsel').fadeIn();
					$('.slides-carousel').carouFredSel({								
						responsive: true,
						items 		: { 
							width : 1600,
							height: 'auto',
							visible: 1
						},								
						prev: '#prev',
						next: '#next',
						onCreate: function(items) {
							$(items).find('h3').animate({ opacity: 1 }, 500, 'easeInOutBack');																			
							$(items).find('p').animate({ opacity: 1 }, 500, 'easeInOutBack');																			
							$(items).find('a').animate({ opacity: 1 }, 500, 'easeInOutBack');																			
						},
						scroll: {						
							duration: parseInt(caroufredsel_slider_settings.duration),					
							easing: caroufredsel_slider_settings.easing,
							pauseDuration: parseInt(caroufredsel_slider_settings.pauseDuration),
							onBefore: function(oldI, newI) {							
								$(this).delay(900);							
								oldI.find('h3')
									.delay(200)
									.animate({
										opacity: 0 
									});
								oldI.find('p')
									.delay(100)
									.animate({
										opacity: 0 
									});
								oldI.find('a')
									.animate({
										opacity: 0 
									});
							},
							onAfter: function(oldI, newI) {							
								newI.find('h3')
									.delay(200)
									.animate({
										opacity: 1 
									});
								newI.find('p')
									.delay(100)
									.animate({
										opacity: 1 
									});
								newI.find('a')							
									.animate({
										opacity: 1 
									});						
							},						
							pauseOnHover: true,
							fx: caroufredsel_slider_settings.fx
						}
					});				
				});			
			}	
			
		/* -------------- "Recent Works" carousel slider --------------*/		
			if(jQuery().carouFredSel && $('#carousel-portfolio').length != 0) {	
				var $caroufredselWorksImages = $('#carousel-portfolio').find('img');
				var caroufredselWorksImagesCount = $caroufredselWorksImages.length;
				
				caroufredselPreloadImages( $caroufredselWorksImages, caroufredselWorksImagesCount );									
				$('.caroufredselWorks-preloader').show();			
				
				$.when( caroufredselPreloadImages( $caroufredselWorksImages, caroufredselWorksImagesCount ) ).done( function() {			
					$('.caroufredselWorks-preloader').hide();
					$('.caroufredselWorks').fadeIn();				
					var rW = (function() {
						var $recentWorksCont = $('#carousel-portfolio'),
						boxCount = 1,
						init = function() {
							var n = changeboxCount();
							initEvents();
							initPlugins( n );
						},
						changeboxCount = function() {
							var w_w = $(window).width(), n;
							if( w_w <= 479 ) {						
								if( caroufredsel_slider_settings.responsive == '1' ) {
									n = 3;
								} else {
									n = 1;			
								}
							} else if(  w_w >= 480 && w_w <= 848 ) {
								if( caroufredsel_slider_settings.responsive == '1' ) {
									n = 3;
								} else {
									n = 2;			
								}
							} else if(  w_w >= 849  && w_w <= 1040 ) {
								n = 3;
							} else {
								n = 3;
							}	
							return n;
						},
						initEvents = function() {
							$(window).on( 'smartresize.linky', function( event ) {
								var n = changeboxCount();
								initPlugins( n );
							});
						},
						initPlugins = function( n ) {
							$recentWorksCont.carouFredSel({
								responsive: true,
								circular: true,
								infinite: true,
								items 		: { 
									width : 300,
									height: 'auto',
									visible: n
								},		
								auto 	: { 
									pauseOnHover: true
								},
								pagination: "#carousel-pagination",
								scroll	: {
									items: n,
									pauseDuration: 5000
								}
							});								
						};
						return { init: init };
					})();
						
					rW.init();							
				});						
			}		
		
		/* -------------- "Responsive Vidoes" --------------*/				
			$(".youtube-video, .frame-responsive").fitVids();	
			$(".video-fitvids").fitVids();
				
		/* -------------- Placeholder on IE -------------- */
			if(!Modernizr.input.placeholder) {
				$('[placeholder]').focus(function() {
				  var input = $(this);
				  if (input.val() == input.attr('placeholder')) {
					input.val('');
					input.removeClass('placeholder');
				  }
				}).blur(function() {
				  var input = $(this);
				  if (input.val() == '' || input.val() == input.attr('placeholder')) {
					input.addClass('placeholder');
					input.val(input.attr('placeholder'));
				  }
				}).blur();
				$('[placeholder]').parents('form').submit(function() {
				  $(this).find('[placeholder]').each(function() {
					var input = $(this);
					if (input.val() == input.attr('placeholder')) {
					  input.val('');
					}
				  })
				});
			}
		
		/* -------------- WooCommerce product columns clearer -------------- */
			var product_cat_item = $('li.product-category');
			product_cat_item.each( function(){
				el = $(this);		
				if( el.hasClass( 'last' ) ) {
					var product_cat_clearer = $('<div class="clear"></div>');
					el.after(product_cat_clearer);
				}
			});		
	});
})(jQuery);

jQuery(document).ready(function($) {
	// fix for web fonts on google chrome
	$('body, p, a, ul li, h1, h2, h3, h4, h5, h6').hide().show();
});