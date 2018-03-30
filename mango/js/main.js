/* ================================================
----------- Mango ---------- */
(function ($) {
	"use strict";
	$("html[dir='rtl'] body").addClass("rtl");
	 var zoommer_active = jQuery('.product-zoom').data('zoom-active');
	var mango_rtl = false;
 if($("body").hasClass("rtl")){
  mango_rtl =  true;
 }
	var Mango = {
		initialised: false,
		version: 1.0,
		mobile: false,
		container : $('#portfolio-item-container'),
		blogContainer: $('#blog-item-container'),
		productContainer:  $('#product-container'),
		init: function () {

			if(!this.initialised) {
				this.initialised = true;
			} else {
				return;
			}

			// Call Mango Functions
			this.checkMobile();
			this.menuHover();
			this.stickyMenu();
			this.toggleMobileMenu();
			this.menuDisplay();
			this.toggleShopSide();
			this.fullHeight();
			this.sideMenuCollapse();
			this.scrollToTopAnimation();
			this.scrollToClass();
			this.filterColorBg();
			if(zoommer_active){

			this.productZoomImage();

			}else{
			this.productZoomImage_deactive();
			}
			this.selectBox();
			this.boostrapSpinner();
			this.tooltip();
			this.popover();
			this.progressBars();
			this.registerKnob();
			this.parallax();
			this.tabLavaHover();
			this.collapseWidget();

			/* Call function if Owl Carousel plugin is included */
			if ( $.fn.owlCarousel ) {
				this.owlCarousels();
			}

			/* Call function if Magnific Popup plugin is included */
			if ( $.fn.magnificPopup) {
				this.newsletterPopup();
				this.lightBox();
			}

			/* Call function if Media element plugin is included */
			if ($.fn.mediaelementplayer) {
				this.mediaElement();
			}

			/* Call function if Media noUiSlider plugin is included */
			if ($.fn.noUiSlider) {
				this.priceSlider();
			}

			var self = this;
			/* Imagesloaded plugin included in isotope.pkgd.min.js */
			/* Portfolio isotope + Blog masonry with images loaded plugin */
			if (typeof imagesLoaded === 'function') {
				/* */
				imagesLoaded(self.container, function() {
					self.isotopeActivate();
					// recall for plugin support
					self.isotopeFilter();
				});

				/* check images for blog masonry/grid */
				imagesLoaded(self.blogContainer, function() {
					self.blogMasonry();
				});

				/* check images for product masonry/grid index11 */
				imagesLoaded(self.productContainer, function() {
					$("#product-container .product-top").addClass("no-margin");
					self.productMasonry();
				});
			}

		},
		checkMobile: function () {
			/* Mobile Detect*/
			if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
				this.mobile = true;
			} else {
				this.mobile = false;
			}
		},
		toggleMobileMenu: function () {
			var self = this;
			/* Mobile menu open */
			$('#mobile-menu-btn, #mobile-menu-overlay, #mobile-menu-close').on('click', function (e) {
				self.toggleClass();
				e.preventDefault();
			});
		},
		toggleClass: function () {
			$('#mobile-menu, #mobile-menu-btn').toggleClass('opened');
			$('body').toggleClass('no-scroll');
		},
		fullHeight: function () {
			/* make a section full window height with predefined class */
			$('.fullheight').each(function () {
				var winHeight = $(window).height();

				$(this).css('height', winHeight);
			});
		},
		menuHover: function () {
			// Sub menu show/hide with hoverIntent plugin
			if ($.fn.hoverIntent) {
				$('ul.menu').hoverIntent({
					over: function() {
						$(this).addClass('open');

					},
					out: function() {
						$(this).removeClass('open');
					},
					selector: 'li',
					timeout: 145,
					interval: 55
				});
			}
		},
		stickyMenu: function () {
			// Stickymenu with waypoint and waypoint sticky plugins
			if ($.fn.waypoint && $(window).width() > 768) {

				$('.sticky-menu').waypoint('sticky', {
					stuckClass:'fixed',
					offset: -200
				});
			}
			
		},
		sideMenuCollapse: function () {
			/* toggle side menu + mobile menu sub menus */
			$('.side-menu, #mobile-menu').find('.smenu, .mobile-menu').find('a').on('click', function(e) {

				if ($(this).siblings('ul').length) {
					$(this).siblings('ul').slideToggle(400, function () {
						$(this).closest('li').toggleClass('open');
					});
					e.preventDefault();
				} else {
					return;
				}

			});
		},
		menuScrollbar: function () {
			if ($.fn.slimScroll) {
				/* For Side Menu*/
				if ( $('.side-menu').hasClass('dark') ) {
					/* check for dark side menu and change color of scrollbar */
					var bgColor = '#606060';
				}

				$('.side-menu-wrapper').slimScroll({
					height: 'auto',
					color: (bgColor) ? bgColor : '#2e2e2e',
					opacity: 0.6,
					size: '3px',
					alwaysVisible: false
				});

				/* Mobile menu*/
				$('#mobile-menu-wrapper').slimScroll({
					height: 'auto',
					color: '#fff',
					opacity: 0.2,
					size: '4px',
					alwaysVisible: false,
					distance: '2px'
				});
			}
		},
		menuDisplay: function () {
			// Menu Display via btn (see: index4.hmtl)
			$('#menu-display-btn').on('click', function (e) {
				$(this).toggleClass('open');
				$('#menu-container').find('.nav-center').toggleClass('open');
				e.preventDefault();
			});	
		},
		
		
			sidebarScrollbar: function () {
				if ($.fn.slimScroll) {
					/* For Sidebar Filter*/
					$('#shop-side-wrapper').slimScroll({
						height: 'auto',
						color: '#fff',
						opacity: 2,
						size: '4px',
						alwaysVisible: false,
						distance: '2px'
					});
				}
			},
		
		
			toggleShopSide: function () {
			var self = this;
			
			$('#shop-side-btn, #shop-side-overlay, #shop-side-close').on('click', function (e) {
				self.toggleClasses();
				e.preventDefault();
			});
		},
		toggleClasses: function () {
			$('#shop-side, #shop-side-btn').toggleClass('opened');
			$('body').toggleClass('no-scroll');
		},
		
		tabLavaHover: function () {
			/* Require jquery.lavalamp.min.js file */
			/* Hover Animation which is used for tabs ( checkout elements-tabs.html page to see ) */
			if ($.fn.lavalamp) {
				$('.nav-lava').lavalamp({
					setOnClick: true,
					duration: 500,
					autoUpdate: true
				});
			}
		},
		owlCarousels: function () {
			var self = this;
            var attributepro = $('.owl-carousel.home-newarrivals-carousel').data('number-of-pro-cols');
			/* Product newarrivals carousel (shoes)  - (index.html - homepage) */
            var Size_768 = (attributepro <= 3 )?attributepro:attributepro-1;
            var Size_992 = (attributepro <= 3 )?attributepro:attributepro-1;
            $('.owl-carousel.home-newarrivals-carousel').owlCarousel({
				loop:true,
				rtl:mango_rtl,
				center :false, 
				margin:30,
				itemsCustom : false,
				//stagePadding: 45,
				//goToFirst: true,
				responsiveClass:true,
				nav:false,
				dots: false,
                responsive:{
                    0:{
                        items:1
                    },
                    520:{
                        items:1
                    },
                    768: {
                        items:Size_768
                    },
                    992: {
                        items:Size_992
                    },
                    1200: {
                        items:attributepro
                    }
                }
			});

			/* Latest Blog Posts Carousels - (index.html - homepage) */
			   var attributes = $('.home-latestblog-carousel').data('number-of-col');
				var Size_768_a = (attributes <= 2 )?attributes:attributes-2;
				var Size_992_a = (attributes <= 3 )?attributes:attributes-1;
			   $('.owl-carousel.home-latestblog-carousel').owlCarousel({
			    
			  
			    items : attributes,
			     loop:false,
			    margin:30,
			    
			    nav:false,
			    dots: false,
			    autoplay: false,
			    autoplayTimeout: 10000,
			    responsive:{
			     0:{
			      items:1
			     },
			     520:{
			      items:2
			     },
			     768: {
			      items:Size_768_a
			     },
			     992: {
			      items:Size_992_a
			     },
			     1200: {
			      items:attributes
			     }
			    }
			      });

			/* index14.html - Lookbook carousel */
			$('.owl-carousel.lookbook-carousel').owlCarousel({
	            loop:false,
				margin:30,
				responsiveClass:true,
				nav:false,
				dots: false,
				autoplay: true,
				autoplayTimeout: 10000,
				center: true,
				responsive:{
					0:{
						items:1
					},
					520:{
						items:2
					},
					768: {
						items:3
					},
					992: {
						items:4
					}
				}
	        });

	        /* Latest Blog Posts Carousels - (index20.html - homepage) */
			$('.owl-carousel.home-latestposts-carousel').owlCarousel({
				loop:false,
				margin:30,
				responsiveClass:true,
				nav:false,
				dots: false,
				responsive:{
					0:{
						items:1
					},
					520:{
						items:2
					},
					768: {
						items:3
					},
					992: {
						items:4
					}
				}
			});

			/* Latest Blog Posts Carousels - (index8html - homepage) */
			$('.owl-carousel.home-latestposts-carousel-sm').owlCarousel({
				loop:false,
				margin:30,
				responsiveClass:true,
				nav:false,
				dots: false,
				responsive:{
					0:{
						items:1
					},
					520:{
						items:2
					},
					768: {
						items:3
					}
				}
			});

			/* Product.html -  Product carousel to zoom product section */
			$('.owl-carousel.product-gallery').owlCarousel({
	            loop:false,
				margin:15,
			
				responsiveClass:true,
				nav:false,
				dots: false,
				autoplay: true,
				autoplayTimeout: 10000,
				responsive:{
					0:{
						items:3
					},
					480: {
						items:4
					}
				}
	        });

			/* Portfolio - Related Projects Carousel - (single-portfolio.html) */
			$('.owl-carousel.portfolio-related-carousel').owlCarousel({
				loop:false,
				margin:30,
				responsiveClass:true,
				nav:true,
				navText: ['<i class="fa fa-angle-left">', '<i class="fa fa-angle-right">'],
				dots: false,
				autoplay: true,
				autoplayTimeout: 10000,
				responsive:{
					0:{
						items:1
					},
					600: {
						items:2
					},
					992:{
						items:3
					}
				}
			});


			/* Product featured carousel  - (product.html - homepages) */
			$('.owl-carousel.product-featured-carousel').owlCarousel({
				loop:false,
				
				margin:30,
				responsiveClass:true,
				nav:false,
				dots: false,
				responsive:{
					0:{
						items:2
					},
					768:{
						items:3
					},
					992:{
						items:4
					},
					1200:{
						items:5
					}
				}
			});

			/* Product popular carousel  - (product.html - homepages) */
			$('.owl-carousel.product-popular-carousel').owlCarousel({
				loop:false,
				margin:30,
				responsiveClass:true,
				nav:false,
				dots: false,
				responsive:{
					0:{
						items:2
					},
					768:{
						items:3
					},
					992:{
						items:4
					},
					1200:{
						items:5
					}
				}
			});

			/* Product newarrivals carousel  - (product.html - homepages) */
			$('.owl-carousel.product-newarrivals-carousel').owlCarousel({
				loop:false,
				margin:30,
			
				center : false,
				responsiveClass:true,
				nav:false,
				goToFirst: true,
				itemsCustom: true,
				stagePadding: 40,
				dots: false,
				responsive:{
					0:{
						items:2
					},
					768:{
						items:3
					},
					992:{
						items:4
					},
					1200:{
						items:5
					}
				}
			});

			/* Product featured carousel  - (index2.html - homepages) */
			$('.owl-carousel.product-featured-carousel-sm').owlCarousel({
				loop:false,
				margin:24,
				responsiveClass:true,
				nav:false,
				dots: false,
				responsive:{
					0:{
						items:2
					},
					768:{
						items:3
					},
					992:{
						items:4
					}
				}
			});

			/* Product popular carousel  - (index2.html - homepages) */
			$('.owl-carousel.product-popular-carousel-sm').owlCarousel({
				loop:false,
				margin:24,
				responsiveClass:true,
				nav:false,
				dots: false,
				responsive:{
					0:{
						items:2
					},
					768:{
						items:3
					},
					992:{
						items:4
					}
				}
			});

			/* Product newarrivals carousel  - (index2.html - homepages) */
			$('.owl-carousel.product-newarrivals-carousel-sm').owlCarousel({
				loop:false,
				margin:24,
				responsiveClass:true,
				nav:false,
				dots: false,
				responsive:{
					0:{
						items:2
					},
					768:{
						items:3
					},
					992:{
						items:4
					}
				}
			});

			/* Sale products carousel  - (index2.html - homepages) */
			$('.owl-carousel.product-sale-carousel').owlCarousel({
				loop:false,
				margin:24,
				responsiveClass:true,
				nav:false,
				dots: false,
				responsive:{
					0:{
						items:2
					},
					768:{
						items:3
					},
					992:{
						items:4
					}
				}
			});

			/* Testimonial Slider Sidebar - widget  - (index2.html) */
			$('.owl-carousel.testimonials-slider').owlCarousel({
				loop:false,
			    rtl:mango_rtl,
				margin: 0,
				responsiveClass: true,
				nav: false,
				dots: false,
				items: 1,
				autoplay: true,
				autoplayTimeout: 8000
			});

			/* Product featured carousel  - (index16.html - homepages) */
			$('.owl-carousel.product-featured-carousel-lg').owlCarousel({
				loop:false,
				margin:45,
			
				responsiveClass:true,
				nav:false,
				dots: false,
				responsive:{
					0:{
						items:1
					},
					480:{
						items:2,
						margin:30
					},
					768:{
						items:3,
						margin:30
					},
					992:{
						items:4
					},
					1200:{
						items:5
					}
				}
			});

			/* Product popular carousel  - (index16.html - homepages) */
			$('.owl-carousel.product-popular-carousel-lg').owlCarousel({
				loop:false,
				margin:45,
				responsiveClass:true,
				nav:false,
				dots: false,
				responsive:{
					0:{
						items:1
					},
					480:{
						items:2,
						margin:30
					},
					768:{
						items:3,
						margin:30
					},
					992:{
						items:4
					},
					1200:{
						items:5
					}
				}
			});

			/* Product newarrivals carousel  - (index16.html - homepages) */
			$('.owl-carousel.product-newarrivals-carousel-lg').owlCarousel({
				loop:false,
				margin:45,
			
				responsiveClass:true,
				nav:false,
				dots: false,
				responsive:{
					0:{
						items:1
					},
					480:{
						items:2,
						margin:30
					},
					768:{
						items:3,
						margin:30
					},
					992:{
						items:4
					},
					1200:{
						items:5
					}
				}
			});

			/* Product clearance carousel  - (index16.html - homepages) */
			$('.owl-carousel.product-clearance-carousel').owlCarousel({
				loop:false,
				margin:45,
				responsiveClass:true,
				nav:false,
				dots: false,
				responsive:{
					0:{
						items:1
					},
					480:{
						items:2,
						margin:30
					},
					768:{
						items:3,
						margin:30
					},
					992:{
						items:4
					},
					1200:{
						items:5
					}
				}
			});

			/* Product featured carousel  - (index5.html - homepages) */
			$('.owl-carousel.product-featured-carousel-xlg').owlCarousel({
				loop:false,
				margin:25,
				responsiveClass:true,
				nav:false,
				dots: false,
				responsive:{
					0:{
						items:2
					},
					768:{
						items:3
					},
					992:{
						items:4
					},
					1200:{
						items:5
					},
					1400: {
						items:6
					}
				}
			});

			/* Product popular carousel  - (index5.html - homepages) */
			$('.owl-carousel.product-popular-carousel-xlg').owlCarousel({
				loop:false,
				margin:25,
				responsiveClass:true,
				nav:false,
				dots: false,
				responsive:{
					0:{
						items:2
					},
					768:{
						items:3
					},
					992:{
						items:4
					},
					1200:{
						items:5
					},
					1400: {
						items:6
					}
				}
			});

			/* Product newarrivals carousel  - (index5.html - homepages) */
			$('.owl-carousel.product-newarrivals-carousel-xlg').owlCarousel({
				loop:false,
				margin:25,
				responsiveClass:true,
				nav:false,
				dots: false,
				responsive:{
					0:{
						items:2
					},
					768:{
						items:3
					},
					992:{
						items:4
					},
					1200:{
						items:5
					},
					1400: {
						items:6
					}
				}
			});

			/* Product newarrivals carousel  - (index18.html - homepages) */
			$('.owl-carousel.presentation-newarrivals-carousel').owlCarousel({
				loop:false,
				margin:30,
				responsiveClass:true,
				nav:false,
				dots: false,
				responsive:{
					0:{
						items:2
					},
					768:{
						items:3
					}
				}
			});

			/* Product featured carousel  - (index18.html - homepages) */
			$('.owl-carousel.presentation-featured-carousel').owlCarousel({
				loop:false,
				margin:30,
				responsiveClass:true,
				nav:false,
				dots: false,
				responsive:{
					0:{
						items:2
					},
					768:{
						items:3
					}
				}
			});

			/* Banner row first carousel  - (index6.html - homepages) */
			$('.owl-carousel.banner-row-carousel-first').owlCarousel({
				loop:false,
				margin:0,
				responsiveClass:true,
				nav:false,
				dots: false,
				responsive:{
					0:{
						items:1
					},
					480: {
						items:2
					},
					768:{
						items:2
					},
					992:{
						items:3
					},
					1400: {
						items:4
					},
					1650: {
						items:5
					}
				}
			});

			/* Banner row second carousel  - (index6.html - homepages) */
			$('.owl-carousel.banner-row-carousel-second').owlCarousel({
				loop:false,
				margin:0,
				responsiveClass:true,
				nav:false,
				dots: false,
				responsive:{
					0:{
						items:1
					},
					480: {
						items:2
					},
					768:{
						items:2
					},
					992:{
						items:3
					},
					1400: {
						items:4
					},
					1650: {
						items:5
					}
				}
			});

			/* Banner row third carousel  - (index6.html - homepages) */
			$('.owl-carousel.banner-row-carousel-third').owlCarousel({
				loop:false,
				margin:0,
				responsiveClass:true,
				nav:false,
				dots: false,
				responsive:{
					0:{
						items:1
					},
					480: {
						items:2
					},
					768:{
						items:2
					},
					992:{
						items:3
					},
					1400: {
						items:4
					},
					1650: {
						items:5
					}
				}
			});

			/* Product featured carousel  - (index12.html - homepages) */
			$('.owl-carousel.product-featured-carousel-6col').owlCarousel({
				loop:false,
				margin:30,
					
				responsiveClass:true,
				nav:false,
				dots: false,
				responsive:{
					0:{
						items:2
					},
					480:{
						items:3
					},
					768:{
						items:4
					},
					992:{
						items:5
					},
					1200:{
						items:6
					}
				}
			});

			/* Product popular carousel  - (index12.html - homepages) */
			$('.owl-carousel.product-popular-carousel-6col').owlCarousel({
				loop:false,
				margin:30,
		
				responsiveClass:true,
				nav:false,
				dots: false,
				responsive:{
					0:{
						items:2
					},
					480:{
						items:3
					},
					768:{
						items:4
					},
					992:{
						items:5
					},
					1200:{
						items:6
					}
				}
			});

			/* Product newarrivals carousel  - (index12.html - homepages) */
			$('.owl-carousel.product-newarrivals-carousel-6col').owlCarousel({
				loop:false,
				
				margin:30,
				responsiveClass:true,
				nav:false,
				dots: false,
				responsive:{
					0:{
						items:2
					},
					480:{
						items:3
					},
					768:{
						items:4
					},
					992:{
						items:5
					},
					1200:{
						items:6
					}
				}
			});

			/* Product featured carousel  - (index17.html - homepages) */
			$('.owl-carousel.product-featured-carousel-side').owlCarousel({
				loop:false,
				margin:23,
				responsiveClass:true,
				nav:false,
				dots: false,
				responsive:{
					0:{
						items:1
					},
					480:{
						items:2
					},
					768:{
						items:3
					},
					1200:{
						items:4
					}
				}
			});

			/* Product popular carousel  - (index17.html - homepages) */
			$('.owl-carousel.product-popular-carousel-side').owlCarousel({
				loop:false,
				margin:23,
				responsiveClass:true,
				nav:false,
				dots: false,
				responsive:{
					0:{
						items:1
					},
					480:{
						items:2
					},
					768:{
						items:3
					},
					1200:{
						items:4
					}
				}
			});

			/* Product newarrivals carousel  - (index17.html - homepages) */
			$('.owl-carousel.product-newarrivals-carousel-side').owlCarousel({
				loop:false,
				margin:23,
				responsiveClass:true,
				nav:false,
				dots: false,
				responsive:{
					0:{
						items:1
					},
					480:{
						items:2
					},
					768:{
						items:3
					},
					1200:{
						items:4
					}
				}
			});

			/* Latest Blog Posts Carousels - (index17.html - homepage) */
			$('.owl-carousel.home-blog-post-carousel').owlCarousel({
				loop:false,
				margin:30,
				responsiveClass:true,
				nav:false,
				dots: false,
				responsive:{
					0:{
						items:1
					},
					520:{
						items:2
					},
					768: {
						items:3
					}
				}
			});


			/*Caution This carousel function has to be called after the function above
			You must call this function after the carousel inside of tabs (for example product.html lava tab)*/
			/* Product - Products Carousel */
			var productCarousel = $('.owl-carousel.product-slider').owlCarousel({
				rtl:mango_rtl,
				loop:false,
				margin:0,
                onInitialize : mango_before_shop_owl_carousel,
				items:1,
				responsiveClass:true,
				animateOut: 'fadeOut', // Choose a calls form animated.css and change then tada
				nav:false,
				navText: ['Previous', 'Next'],
				dots: false
			});


			/* index.html - Clients -partners carousel  */
			$('.owl-carousel.our-partners').owlCarousel({
				loop:false,
				margin:0,
				responsiveClass:true,
				nav:true,
				navText: ['<i class="fa fa-angle-left">', '<i class="fa fa-angle-right">'],
				dots: false,
				responsive:{
					0:{
						items:2,
						nav:false
					},
					420: {
						items:3,
						nav:false
					},
					520: {
						items:4
					},
					992:{
						items:5,
					},
					1199:{
						items:6,
					}
				}
			});

		},
		scrollTopBtnAppear: function () {
			// This will be triggered at the bottom of code with window scroll event
			var windowTop = $(window).scrollTop(),
		            scrollTop = $('#scroll-top');

	        if (windowTop >= 300) {
	            scrollTop.addClass('fixed');
	        } else {
	            scrollTop.removeClass('fixed');
	        }
		    
		},
		scrollToAnimation: function (speed, offset, e) {
			/* General scroll to function */
			var targetEl = $(this).attr('href'),
				toTop = false;

			if (!$(targetEl).length) {
				if (targetEl === '#header' || targetEl === '#top' || targetEl === '#wrapper') {
					targetPos = 0;
					toTop = true;
				} else {
					return;
				}
			} else {
				var elem = $(targetEl),
					targetPos = offset ? ( elem.offset().top + offset ) : elem.offset().top;
			}
			
			if (targetEl || toTop) {
				$('html, body').animate({
		            'scrollTop': targetPos
		        }, speed || 1200);
		        e.preventDefault();
			}
		},
		scrollToTopAnimation: function () {
			var self = this;
			// Scroll to top animation when the scroll-top button is clicked
			$('#scroll-top').on('click', function (e) {
		        self.scrollToAnimation.call(this, 1200, 0, e);
		    });
		},
		scrollToClass: function () {
			var self = this;
			// Scroll to animation - predefined class
			// Just add this class to any element and 
			// add href attribute with target id (#targer like so ) for target 
			// you can change 0 offset to -60 (height of fixed header)
			$('.scrollto, .section-btn').on('click', function (e) {
		        self.scrollToAnimation.call(this, 1200, 0, e);
		    });
		},
		priceSlider:function () {
			// Slider For category pages / filter price
			$('#price-range').noUiSlider({
				start: [0, 2990],
				handles: 2,
				connect: true,
				range: {
					'min': 0,
					'max': 4000
				}
			});

			$("#price-range").Link('lower').to( $('#slider-low-value') )
			$("#price-range").Link('upper').to( $('#slider-high-value') );
		},
		filterColorBg: function () {
			/* Category-item filter color box background */
			$('.filter-color-box').each(function() {
				var $this = $(this),
					bgColor = $this.data('bgcolor');

					$this.css('background-color', bgColor);
			});
		},
		productZoomImage: function () {
		
			var self = this,width = $(window).width(),scrollzoomer;
			
			if(width > 768){
			 scrollzoomer =	 true				
			}else{
			 scrollzoomer =	 false					
			}
			// Product page zoom plugin settings
			if ($.fn.elevateZoom) {
				$('.product-zoom').elevateZoom({
					responsive: true,
					zoomType: 'inner', // lens or window can be used - options already set below
					borderColour: '#d0d0d0',
					zoomWindowPosition: 1,
					zoomWindowOffetx: 30,
					cursor: "crosshair", //
					zoomWindowFadeIn: 400,
					zoomWindowFadeOut: 250,
					lensBorderSize: 3, // lens border size
					lensOpacity: 1,
					lensColour: 'rgba(255, 255, 255, 0.5)', // lens color
					lensShape : "square", // circle lens shape can be uses
					lensSize : 200,
					scrollZoom : scrollzoomer
				});

				/* swap images for zoom on click event */
				$('.product-gallery , .gallery_images').find('a').on('click', function (e) {

				var ez = $('.product-zoom').data('elevateZoom'),
						smallImg = $(this).data('image'),
						bigImg = $(this).data('zoom-image');

						ez.swaptheimage(smallImg, bigImg);
					e.preventDefault();
				});
			}
		},productZoomImage_deactive:function(){
			
			jQuery('.product-gallery').find('a').on('click', function (e) {
				jQuery(".product-zoom").removeAttr("srcset");
					var ez = jQuery('.product-zoom'),
						smallImg = jQuery(this).data('image'),
						bigImg = jQuery(this).data('zoom-image');
					
					
					ez.attr('src',bigImg);
					//	ez.swaptheimage(smallImg, bigImg);
					
					e.preventDefault();
				});
		},
		selectBox: function () {
			// Custom select box via selectbox plugin
			// Be sure to include jquery.selectbox.css and jquery.selectbox.min.js files
			if ($.fn.selectbox) {
				$('.selectbox').selectbox({
					effect: "fade"
				});
			}
		},
		boostrapSpinner: function () { 
			// Custom spinners
			// Include jquery.bootstrap-touchspin.min.min.js file
			if ($.fn.TouchSpin) {
				// Vertical Spinner
				$(".vertical-spinner").TouchSpin({
					verticalbuttons: true
				});

				//Horizontal spinner
				$(".horizontal-spinner").TouchSpin();
			}
		},
		tooltip: function () {
			// Bootstrap tooltip
			if($.fn.tooltip) {
				$('.add-tooltip').tooltip();
			}
		},
		popover: function () {
			// Bootstrap tooltip
			if($.fn.popover) {
				$('.add-popover').popover({
					trigger: 'focus'
				});
			}
		},
		newsletterPopup : function () {
			// Newsletter form popup - require magnific-popup plugin on page load

			if ( ! document.getElementById('newsletter-popup-form') ) {
				return;
			}

			jQuery.magnificPopup.open({
				items: {
					src: '#newsletter-popup-form'
				},
				type: 'inline'
			}, 0);
		},
		lightBox: function () {
			/* Popup for gallery items and videso and etc.. */
			/* magnific-popup.css and jquery.magnific.popup.mi.js files need to be included */

			/* This is for gallery images */
			$('.popup-gallery').magnificPopup({
				delegate: '.zoom-item',
				type: 'image',
				closeOnContentClick: false,
				closeBtnInside: true,
				mainClass: 'mfp-fade',
				removalDelay: 100,
				gallery: {
					enabled: true
				}
			});


			/* This is for iframe - youtube - vimeo videos - goole maps  with fade animation */
			$('.popup-iframe').magnificPopup({
				disableOn: 700,
				type: 'iframe',
				mainClass: 'mfp-fade',
				removalDelay: 160,
				preloader: false,
				fixedContentPos: false
			});

		},
		progressBars: function () {
			var self = this;
			// Calculate and Animate Progress 
			// With waypoing plugin calculate width of the progress bar
			if ($.fn.waypoint) {
				$('.progress-animate').waypoint(function () {
					if (!$(this).hasClass('circle-progress')) {
						var $this = $(this),
						progressVal = $(this).data('width'),
						progressText = $this.find('.progress-text, .progress-tooltip');

						$this.css({ 'width' : progressVal + '%'}, 400);

						setTimeout(function() {
							progressText.fadeIn(400, function () {
								$this.removeClass('progress-animate');
							});
						}, 100);
						
					} else {
						// Animate knob --- Circle progrss bars
						self.animateKnob();
					}
				}, {
					offset: function() {
						return ( $(window).height() - 10);
					}
				});
				

			} else {
				// Fallback if the waypoint plugin isn't included
				// Get the value and calculate width of progress bar
				$('.progress-animate').each(function () {
					var $this = $(this),
						progressVal = $(this).data('width'),
						progressText = $this.find('.progress-text');

					$this.css({ 'width' : progressVal + '%'}, 400);
					progressText.fadeIn(500);
				});

			}
		},
		registerKnob: function() {
			// Register knob plugin
			if ($.fn.knob) {
				$('.knob').knob({
					bgColor : '#ebebeb'
				});
			}
		},
		animateKnob: function() {
			// Animate knob
			if ($.fn.knob) {
				$('.knob').each(function() {
					var $this = $(this),
						container = $this.closest('.progress-animate'),
						animateTo = $this.data('animateto'),
						animateSpeed = $this.data('animatespeed')
					$this.animate(
			                { value: animateTo }, 
			                {   duration: animateSpeed,
			                    easing: 'swing',
		                    progress: function() {
		                      $this.val(Math.round(this.value)).trigger('change');
		                    },
		                    complete: function () {
		                    	container.removeClass('progress-animate');
		                    }
	               		});

				});
			}
		},
		mediaElement: function () {
			/* Media element plugin for video and audio support and styling */
			$('video, audio').mediaelementplayer();
		},
		scrollAnimations: function () {

			/* 	// Wowy Plugin
				Add Html elements wow and animation class 
				And you can add duration via data attributes
				data-wow-duration: Change the animation duration
				data-wow-delay: Delay before the animation starts
				data-wow-offset: Distance to start the animation (related to the browser bottom)
				data-wow-iteration: Number of times the animation is repeated
			*/

			// Check for class WOW // You need to call wow.min.js and animate.css for scroll animations to work
			if (typeof WOW === 'function') {
				new WOW({
					boxClass:     'wow',      // default
					animateClass: 'animated', // default
					offset:       0          // default
				}).init();
			}

		},
		parallax: function () {
			// Parallax - if not mobile  with skrollr js plugin 
			if ( !this.mobile && typeof skrollr === 'object') {
				skrollr.init({
					forceHeight: false
				});
			} 

			if ( this.mobile ) {
				/* if mobile, delete background attachment fixed from parallax class */
				$('.parallax, .parallax-fixed').css('background-attachment', 'initial')
			}

		},
		isotopeActivate: function() {
			// Trigger for isotope plugin
			if($.fn.isotope) {
				var container = this.container,
					layoutMode = container.data('layoutmode');

				container.isotope({
                	itemSelector: '.portfolio-item',
                	layoutMode: (layoutMode) ? layoutMode : 'masonry',
                	transitionDuration: 0
            	});

            	
			}
		},
		isotopeReinit: function () {
			// Recall for isotope plugin
			if($.fn.isotope) {
				this.container.isotope('destroy');
				this.isotopeActivate();
			}
		},
		isotopeFilter: function () {
			// Isotope plugin filter handle
			var self = this,
				filterContainer = $('#portfolio-filter');

			filterContainer.find('a').on('click', function(e) {
				var $this = $(this),
					selector = $this.attr('data-filter');

				filterContainer.find('.active').removeClass('active');

				// And filter now
				self.container.isotope({
					filter: selector,
					transitionDuration: '0.8s'
				});
				
				$this.closest('li').addClass('active');
				e.preventDefault();
			});
		},
		blogMasonry: function () {
			/* Masonry - Grid for blog pages with isotope.pkgd.min.js file */

			// This is defined at the top of the this file
			var blogContainer = this.blogContainer;

			blogContainer.isotope({
				itemSelector: '.entry',
				masonry: {
					gutter: 30
				}
			});
		},
		productMasonry: function () {
			/* Masonry - Grid for product homepages with isotope.pkgd.min.js file */
			var productContainer = this.productContainer;

			productContainer.isotope({
				itemSelector: '.product',
				layoutmode: 'fitRows'
			});
		},
		collapseWidget : function () {

			// Sidebar category collapse (category.html )
			$('.category-widget-btn').on('click', function (e) {
				var $this = $(this),
					parent= $this.closest('li');

				if (parent.hasClass('open')) {
					parent.find('ul').slideUp(400, function() {
						parent.removeClass('open');
					});
				} else {
					parent.find('ul').slideDown(400, function() {
						parent.addClass('open');
					});
				}
				e.preventDefault();
			});
		},

	};

	Mango.init();

	// Load Event
	$(window).on('load', function() {
		/* Trigger side menu scrollbar */
		Mango.menuScrollbar();
		Mango.sidebarScrollbar();
		/* Trigger Scroll Animations */
		Mango.scrollAnimations();
	});
	
	
/*On Quyick View Function Start*/
	
$(document).on('click','.open-product',function(e){

	Mango.boostrapSpinner();
	var pid = $(this).attr('data-id');
	var he =  $("#product-popup_"+pid ).find(".bootstrap-touchspin-down");
	var zoommer_active = jQuery('.product-zoom').data('zoom-active');

	$('.zoomWindowContainer').css('display','block');
	$('.zoomContainer').css('display','block');			
	if(he.size()>1){
		$('.bootstrap-touchspin').addClass('bpp');	
	}

	var self = this,width = $(window).width(),scrollzoomer;
	if(width > 768){
		scrollzoomer =	 true				
	}else{
		scrollzoomer =	 false					
	}

	if(zoommer_active){
		$('.product-zoom').elevateZoom({
		responsive: true,
		zoomType: false, // lens or window can be used - options already set below
	});
	}else{
		$('.product-zoom').elevateZoom({
		responsive: true,
		zoomType: false // lens or window can be used - options already set below
		});

	}
	/* swap images for zoom on click event */
	$('.product-quick').find('a').on('click', function (e) {
		var ez = $('.product-zoom').data('elevateZoom'),
		smallImg = $(this).data('image'),
		bigImg = $(this).data('zoom-image');
		ez.swaptheimage(smallImg, bigImg);
		e.preventDefault();
	});

	$('.overlay-popup').css('display','block');
	var pid = jQuery(this).attr('data-id');
	$.magnificPopup.open({
	items: {
		src: '#product-popup_'+pid
	},
		type: 'inline'
	}, 0);
	e.preventDefault();
});
		/*On Quyick View  End */

		
	$(document).on('click','button.mfp-close,.mfp-content',function(){
	
			$('.bootstrap-touchspin').removeClass('bpp');	
			$('.zoomWindowContainer').css('display','none');
			$('.zoomWindowContainer').parent().remove();
	});
	
	
	// Scroll Event
	$(window).on('scroll', function () {
		/* Display Scrol to Top Button */
		Mango.scrollTopBtnAppear();

	});

	// Resize Event 
	// Smart resize if plugin not found window resize event
	if($.event.special.debouncedresize) {
		$(window).on('debouncedresize', function() {

			/* Full Height recall */
			Mango.fullHeight();

	    });
	} else {
		$(window).on('resize', function () {
			
			/* Full Height recall */
			Mango.fullHeight();

		});
	}

	/* Do not delete - this is trigger for owl carousels which used in bootstrap tab plugin */
	/* This is update for carousels  example (product.html) */
    $('.nav-lava').find('a[data-toggle="tab"]').on('shown.bs.tab', function (event) {
		/* Trigger resize event for to owl carousels fit */
		var evt = document.createEvent('UIEvents');
		evt.initUIEvent('resize', true, false,window,0);
		window.dispatchEvent(evt);
    });

    //custom js start here

      //custom js start here

    var header17 =  $("header.mango_header17,header.mango_header9").parents("body").find(".mango_banner div,.mango_banner img");
    if(header17.length == 0 ){
          $("header.mango_header17,header.mango_header9").addClass("no_banner_bg");
		  $(".header-absolute-container .sticky-wrapper").addClass("azee");	
	}
	
	 var bannerbg =  $("body").hasClass("search");
 if(bannerbg == true){
       $("header.mango_header17,header.mango_header9").addClass("no_banner_bg");
 }

    ///shop page categories
    var mango_shop_cats_columns = parseInt($(".mango_products_container").data("columns"));

    var categories = $(".mango_products_container  li.product-category");
    categories.find("img").addClass("img-responsive img-rounded");
    categories.find("mark.count").addClass("badge");
    if(mango_shop_cats_columns == 5){
		var class1 = 'mango_product_5_col col-xs-12';
	}else{
		var cat_classes = (12 / mango_shop_cats_columns);
		var cat_class1 = "col-sm-" + (cat_classes);
			cat_class1 += " col-xs-12";
			
	}
    categories.addClass(cat_class1);
    var category_cols = $(".mango_products_container>li.product-category");
    for (var i = 0; i < category_cols.length; i += mango_shop_cats_columns) {
        category_cols.slice(i, i + mango_shop_cats_columns).wrapAll('<ul class="row"></ul>');
    }
    //$("owl-carousel.product-slider").on("onInitialize.owl","mango_before_shop_owl_carousel");
    var owl_run_count = "no";
    var owl_upsell_run = 'no';
    var owl_related_run = 'no';
    function mango_before_shop_owl_carousel() {
        if(typeof (owl_run_count)=='undefined'){
            owl_run_count = "done";
            //custom jquery code for theme
            var mango_shop_view = $(".mango_products_container").data("view");
            var mango_shop_columns = parseInt($(".mango_products_container").data("columns"));
            if (mango_shop_view == "grid") {
				//var mango_shop_columns = 5;
				var products = $(".mango_products_container .mango_product");
                                     
                if(mango_shop_columns == 5){
						var class1 = 'mango_product_5_col col-xs-12';
				}else{
					var classes = (12 / mango_shop_columns);
						var class1 = "col-md-" + (classes);
						class1 += " col-sm-6";
				}
                products .wrap("<div class='" + class1 + "'></div>");
                var products_cols = $(".mango_products_container>div");
                for (var i = 0; i < products_cols.length; i += mango_shop_columns) {
                    products_cols.slice(i, i + mango_shop_columns).wrapAll('<div class="row"></div>');
                }
            }
        }

    }
    //shop page buttons

    //list buttons and single product
    $(".product-details .yith-wcwl-add-to-wishlist a.add_to_wishlist, .product-action .yith-wcwl-add-to-wishlist a.add_to_wishlist").addClass("list-btn list-btn-wishlist").prepend("<i class='fa fa-heart'></i>");
    $(".product-details .yith-wcwl-wishlistaddedbrowse a,.product-details .yith-wcwl-wishlistexistsbrowse a,.product-action .yith-wcwl-wishlistaddedbrowse a,.product-action .yith-wcwl-wishlistexistsbrowse a").addClass("list-btn list-btn-wishlist").prepend("<i class='fa fa-folder-open'></i>");
    $(".product-details a.compare.button,.product-action .woocommerce.product.compare-button a.compare.button").addClass("list-btn list-btn-wishlist").prepend("<i class='fa fa-retweet'></i>");
    $(".yith-wcwl-add-to-wishlist + div.clear").remove();

    //grids
    $(".product-top .yith-wcwl-add-to-wishlist>.yith-wcwl-add-button>a.add_to_wishlist").addClass("product-btn btn-icon top-right").html("<i class='fa fa-heart'></i>");
    $(".product-top .yith-wcwl-add-to-wishlist>.yith-wcwl-wishlistexistsbrowse>a,.product-top .yith-wcwl-add-to-wishlist>.yith-wcwl-wishlistaddedbrowse>a").addClass("product-btn btn-icon top-right").html("<i class='fa fa-folder-open'></i>");
    $(".product-top .yith-wcwl-add-to-wishlist .feedback").remove();
    $(".product-top .woocommerce.product.compare-button a.compare.button").addClass("product-btn btn-icon").html('<i class="fa fa-retweet"></i>');
    $(".product-top .product-action-container.action-group .yith-wcwl-add-to-wishlist>.yith-wcwl-add-button>a.add_to_wishlist,.product-top .product-action-container.action-group .yith-wcwl-add-to-wishlist>.yith-wcwl-wishlistexistsbrowse>a,.product-top .product-action-container.action-group .yith-wcwl-add-to-wishlist>.yith-wcwl-wishlistaddedbrowse>a,.product-top .product-action-container.action-group .woocommerce.product.compare-button a.compare.button").addClass("dark");
    $(".product-action-container.action-group-vertical .product-btn.btn-icon").addClass("dark");
    $(".product-action-container.action-group-vertical .yith-wcwl-add-to-wishlist").addClass("clear-margin").find(".ajax-loading").hide();
    $(".woocommerce-message .button.wc-forward").addClass("btm btn-custom");

    //rating
    setTimeout(function(){
        $(".comment-form-rating>.stars").addClass("product-ratings");
        $(".comment-form-rating>.stars.product-ratings a").addClass("star");
        $(".stars.product-ratings>span>a").on("click",function(){
           // alert("a");
            $(".stars.product-ratings>span>a").removeClass("prev_active");
            $(this).prevAll("a").addClass("prev_active");
        });
        $(".shipping-calculator-form,.checkout_coupon").show("fast");
    },400);

    //after add to cart
    $("body").on("added_to_cart",function(frg,cart, thisbutton){
        $(".product-action-container .added_to_cart.wc-forward").not(".product-btn.product-add-btn").addClass(" product-btn product-add-btn").prepend("<i class='fa fa-sign-in'></i>");
        $(".product-action-container.action-group .added_to_cart.wc-forward").not(".dark").addClass("dark").prev(".add_to_cart_button.product_type_simple").hide();
        $(".product-action .added_to_cart.wc-forward").not(".list-btn.list-btn-add").addClass("list-btn list-btn-add margin_left_15");
        $(".product-action-container .added_to_cart.wc-forward.product-btn.product-add-btn").html("<i class='fa fa-sign-in'></i>");
	//	$(".woocommerce.widget_shopping_cart>.widget_shopping_cart_content").addClass("widget widget-products");
	});

    var newsletter = $('.newsletter-box-form form input[type="submit"]');
    var nl_type = newsletter.attr('type');
    var nl_name = newsletter.attr('name');
    var nl_con  = '<i class="fa fa-plus"></i>';
    var nl_val  = newsletter.attr('value');
	newsletter.replaceWith('<button class="btn" type="'+ nl_type +'" value="'+ nl_val +'" title="Join" name="'+ nl_name +'">'+ nl_con +'</button>');
    $('.mango_bootstrap_slider div.item:first').addClass('active');
    $('.owl-carousel.home-newarrivals-carousel .owl-stage').css(  'transform', '');
	$('.mango_flipbook div.item:first').addClass('active');
	$('.yith-woocompare-widget a.clear-all').addClass( "btn-sm btn btn-custom4 m_top10" );
	$('.yith-woocompare-widget a.compare ').addClass( "btn-sm btn btn-custom m_top10" );

	//Mobile menu and side menu
	$("ul.mobile-menu li.menu-item-has-children>a").prepend("<i class='fa fa-angle-right'></i>");
	$("nav.menu-main-menu-container >ul.smenu li.menu-item-has-children>a").append("<i class='fa fa-angle-down'></i>");
	setTimeout(function() {
	//	$(".woocommerce.widget_shopping_cart>.widget_shopping_cart_content").addClass("widget widget-products");
	},1000);
	$(document).on("yith-wcan-ajax-filtered",function(){

		$(".product-details .yith-wcwl-add-to-wishlist a.add_to_wishlist, .product-action .yith-wcwl-add-to-wishlist a.add_to_wishlist").addClass("list-btn list-btn-wishlist").prepend("<i class='fa fa-heart'></i>");
		$(".product-details .yith-wcwl-wishlistaddedbrowse a,.product-details .yith-wcwl-wishlistexistsbrowse a,.product-action .yith-wcwl-wishlistaddedbrowse a,.product-action .yith-wcwl-wishlistexistsbrowse a").addClass("list-btn list-btn-wishlist").prepend("<i class='fa fa-folder-open'></i>");
		$(".product-details a.compare.button,.product-action .woocommerce.product.compare-button a.compare.button").addClass("list-btn list-btn-wishlist").prepend("<i class='fa fa-retweet'></i>");
		$(".yith-wcwl-add-to-wishlist + div.clear").remove();
        //
		////grids
		$(".product-top .yith-wcwl-add-to-wishlist>.yith-wcwl-add-button>a.add_to_wishlist").addClass("product-btn btn-icon top-right").html("<i class='fa fa-heart'></i>");
		$(".product-top .yith-wcwl-add-to-wishlist>.yith-wcwl-wishlistexistsbrowse>a,.product-top .yith-wcwl-add-to-wishlist>.yith-wcwl-wishlistaddedbrowse>a").addClass("product-btn btn-icon top-right").html("<i class='fa fa-folder-open'></i>");
		$(".product-top .yith-wcwl-add-to-wishlist .feedback").remove();
		$(".product-top .woocommerce.product.compare-button a.compare.button").addClass("product-btn btn-icon").html('<i class="fa fa-retweet"></i>');
		$(".product-top .product-action-container.action-group .yith-wcwl-add-to-wishlist>.yith-wcwl-add-button>a.add_to_wishlist,.product-top .product-action-container.action-group .yith-wcwl-add-to-wishlist>.yith-wcwl-wishlistexistsbrowse>a,.product-top .product-action-container.action-group .yith-wcwl-add-to-wishlist>.yith-wcwl-wishlistaddedbrowse>a,.product-top .product-action-container.action-group .woocommerce.product.compare-button a.compare.button").addClass("dark");
		$(".product-action-container.action-group-vertical .product-btn.btn-icon").addClass("dark");
		$(".product-action-container.action-group-vertical .yith-wcwl-add-to-wishlist").addClass("clear-margin").find(".ajax-loading").hide();
		var mango_shop_view = $(".mango_products_container").data("view");
		var mango_shop_columns = parseInt($(".mango_products_container").data("columns"));
		if (mango_shop_view == "grid") {
		var products = $(".mango_products_container .mango_product");
			if(mango_shop_columns == 5){
				var class1 = 'mango_product_5_col col-xs-12';
			}else{
				var classes = (12 / mango_shop_columns);
				var class1 = "col-sm-" + (classes);
				class1 += " col-xs-12";
			}
			products.wrap("<div class='" + class1 + "'></div>");
			var products_cols = $(".mango_products_container>div");
			for (var i = 0; i < products_cols.length; i += mango_shop_columns) {
				products_cols.slice(i, i + mango_shop_columns).wrapAll('<div class="row"></div>');
			}
		}
		$(".woocommerce-pagination").css("display","inline");
		var productCarousel = $('.owl-carousel.product-slider').owlCarousel({
			loop:false,
			margin:0,
			//onInitialize : mango_before_shop_owl_carousel,
			items:1,
			responsiveClass:true,
			animateOut: 'fadeOut', // Choose a calls form animated.css and change then tada
			nav:false,
			navText: ['Previous', 'Next'],
			dots: false
		});

	});

	//code for single product zoom
	jQuery( document ).on( 'found_variation reset_image', 'form.variations_form', function( event, variation ) {
		var img =  $(".product-zoom");
		$(".product-gallery .owl-item>.product-gallery-item").each(function(){
			var zoom_img = $(this).data("zoom-image");
			var simple_img =$(this).data("image");
			var zooming = img.attr("src");
			$(".zoomWindow").css("background-image",'url('+zooming+')');
			//if(img.attr("src") == simple_img){
			//	if(img.data("zoom-image") != zoom_img ){
			//		img.attr("data-zoom-image",zoom_img );
				//	$(".zoomWindow").css("background-image",'url('+zoom_img+')');
				//}
			//}
		});
	});
	
	$("body.rtl .fa-angle-right").removeClass('fa-angle-right').addClass('fa-angle-left');
	$("body.rtl .fa-angle-double-right").removeClass('fa-angle-double-right').addClass('fa-angle-double-left');
	 $('.s2_form_widget').addClass("custom-btn");
	
	
	var bannercolor = $(".banner-head").attr('data-custom');
 $(".banner-head").css("color", bannercolor);
	
})(jQuery);
	jQuery(document).ready(function(){
	
  jQuery(".panel-default").click(function(){
	  	  jQuery(this).find('span i').toggleClass('fa-angle-down fa-angle-up');	  
  });	
       jQuery('.tab-content #tab-description').addClass('active');
	   
	   jQuery('.product-type-simple .add_to_cart_button').addClass('ajax_add_to_cart'); 
  });
  
  jQuery(document).load(function() {jQuery(".loader").fadeOut("slow");
  });
  
  jQuery(".prod-dropdown").hover(function () {
	jQuery(this).toggleClass("active");
 });