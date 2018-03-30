(function ($) {
	
/*--------------------------------------------------
First Load Page
---------------------------------------------------*/

	var current_url = $(location).attr('href');
	
	$('body').waitForImages({
		finished: function() {
			
			setTimeout(function(){
				$('header').removeClass('first-load');
				setTimeout(function(){
					$('#header-wrapper').animate({opacity : 1},200);
				}, 200);
				openWebsite();
			},1000);
		},
		waitForAll: true
	});
	
	
	
/*--------------------------------------------------
Change Ajax Pages
---------------------------------------------------*/

	$(".ajax-link").live("click", function(){
		$this = $(this);
		var link = $this.attr('href');
		if( link != current_url && link != '#' ) { 
			$.ajax({
				url:link,
				processData:true, 
				dataType:'html', 
				success:function(data){
					document.title = $(data).filter('title').text(); 
					current_url = link;
					if (typeof history.pushState != 'undefined') history.pushState( data, 'Page', link );  
					var content_to_display = "#content-ajax";
					var current_container = $( content_to_display );
					var header_to_display = "#header-wrapper";
					var current_header = $( header_to_display );
					var footer_to_display = "#footer-content";
					var current_footer = $( footer_to_display );					
					
					delay = 0;					
					
					setTimeout(function(){						
						
						$(".clapat-mask").fadeIn(500);
						$("#clapatloader").delay(50).fadeIn(100);
						$('html, body').delay(600).animate({ scrollTop:  0  },50);						
						
						setTimeout(function(){
							$("body").attr("class", /body([^>]*)class=(["']+)([^"']*)(["']+)/gi.exec(data.substring(data.indexOf("<body"), data.indexOf("</body>") + 7))[3]);
							if( $('body').hasClass('woocommerce')) {
								location.reload();
							}
							current_container.html(' ');
							current_container.html( $(data).find( content_to_display ).html() );
							current_header.html(' ');
							current_header.html( $(data).find( header_to_display ).html() );
							current_footer.html(' ');
							current_footer.html( $(data).find( footer_to_display ).html() );
							
							if( $('#hero').length > 0 ){
								$('#hero').waitForImages({
									finished: function() {
										openWebsite();
										if (typeof _gaq != 'undefined') _gaq.push(['_trackPageview'], '/'+current_url); 
									},										
									waitForAll: true
								});
							} else {
								$('body').waitForImages({
									finished: function() {
										openWebsite();
										if (typeof _gaq != 'undefined') _gaq.push(['_trackPageview'], '/'+current_url); 
									},										
									waitForAll: true
								});
							}
								
								
							
						},1100);
					},delay);
				}
			});
		}
		return false;
	});
	
	

/*--------------------------------------------------
Initialization Function Open Page
---------------------------------------------------*/

	function openWebsite() {
		$("header").removeClass("hbg");
		initScripts();		
		setTimeout(function(){
			$("#clapatloader").fadeOut(100);			
			$(".clapat-mask").fadeOut(500);							
		},1000);
		
	}//End openWebsite
	
	
	
/*--------------------------------------------------
Initialization General Scripts for all pages
---------------------------------------------------*/

    function initScripts() {
		
		$(document).ready(function(){			
			HeaderBackground();
			SmoothScroll();
			BackToTop();
			HideShowMenu();
			MenuOverlay();
			HeroHeight();
			HeroParallax();
			FullScreenSlider();
			SliderBg();
			ClassicSlider();	
			MasonryPortfolio();
			ToggleSecondaryMenu();
			InitContactMap();
			BlogPost();
			AppearIteam();
			VideoHeader();
			ShowCart();
			ShopColumns();
			Shortcodes();
			TwitterFeed();
		});
		
		$(window).ready(function() {
			MenuOverlayResponsive();			
		});
		
		$(window).on( 'resize', function () {
			MenuOverlayResponsive();
			HeroHeight();			
		});
		
	} //End initScripts
	
	
	
/*--------------------------------------------------
Function SmoothScroll
---------------------------------------------------*/
	
	function SmoothScroll() {

		$(function () {
			var platform = navigator.platform.toLowerCase();
			if (platform.indexOf('win') == 0 || platform.indexOf('linux') == 0) {
				if ($.browser.webkit) {
					$.srSmoothscroll();
				}
			}
		});

	}//End SmoothScroll
	
	
	
/*--------------------------------------------------
Function Back To Top Button
---------------------------------------------------*/
	
	function BackToTop() {
	
		$(window).scroll(function(){
			if ($(this).scrollTop() > $(window).height() *0.7 ) {
				$('.scrolltotop').fadeIn();
			} else {
				$('.scrolltotop').fadeOut();
			}
		});
		
		//Click event to scroll to top
		$('.scrolltotop').click(function(){
			$('html, body').animate({scrollTop : 0},800);
			return false;
		});
	
	}//End BackToTop
	
	
	
/*--------------------------------------------------
Function Change Hader Background On Scroll
---------------------------------------------------*/
	
	function HeaderBackground() {
	
		if ($("#hero").length <= 0) {
			$("#secondary-menu").removeClass("hide-secondary");
			$("header").addClass("hbg");
		};
	
		$(window).scroll(function() {    
			var scroll = $(window).scrollTop();
		
			if (scroll >= $("#hero").height()) {
				$("header").addClass("hbg");
				$("#secondary-menu").removeClass("hide-secondary");
			} else {
				$("header").removeClass("hbg");
				$("#secondary-menu").addClass("hide-secondary");
			}
		});
	
	}//End HeaderBackground



/*--------------------------------------------------
Function Hide Show Menu
---------------------------------------------------*/
	
	function HideShowMenu() {
		
		
			
			var didScroll;
			var lastScrollTop = 0;
			var delta = 5;
			var navbarHeight = $('header').outerHeight();
			var navbarHideAfter = 20
			
			$(window).scroll(function(event){
				didScroll = true;
			});
			
			
			if( $('.hsm').length > 0 ){
				
				setInterval(function() {
					if (didScroll) {
						hasScrolled();
						didScroll = false;
					}
				}, 100);
			
			}
		
			return false;
			
			function hasScrolled() {
				var st = $(this).scrollTop();
				
				// Make sure they scroll more than delta
				if(Math.abs(lastScrollTop - st) <= delta)
					return;
				
				// If they scrolled down and are past the navbar, add class .nav-up.
				// This is necessary so you never see what is "behind" the navbar.
				if (st > lastScrollTop && st > navbarHideAfter){
					// Scroll Down
					if( $('.hsm').length > 0 ){
					$('header').removeClass('nav-down').addClass('nav-up');
					}
				} else {
					// Scroll Up
					if( $('.hsm').length > 0 ){
					if(st + $(window).height() < $(document).height()) {
						$('header').removeClass('nav-up').addClass('nav-down');
					}
					}
				}
				
				lastScrollTop = st;
			}
			
		
		
	}//End HideShowMenu
	
	
	
/*--------------------------------------------------
Function Menu Overlay
---------------------------------------------------*/	
	
	function MenuOverlay() {	
	
		var Menu = {
			settings: {
				menubtn: $(".clapat-menubtn"),
				menu: $(".clapat-overlay-menu"),
				navigation: $("header"),
				closebtn: $(".clapat-menuclosebtn"),
				bg: $(".clapat-menubg"),
				container: $(".clapat-menu-container"),
				menuitem: $('a.no-action'),
				submenuitem: $('.sub-menu'),
				isOpen: !1,
				isAnimating: !1
			},
			init: function() {
				this.bindUIActions()
			},
			bindUIActions: function() {
				var e = this.settings;
				e.menubtn.click(function() {
					Menu.toggle()
				});
				e.bg.click(function() {
					Menu.close()
				});
				e.container.click(function() {
					Menu.close()
				});
				e.closebtn.click(function() {
					Menu.close()
				});
				$(window).keydown(function(e) {
					e.which === 27 && Menu.close()
				});				
				e.submenuitem.click(function() {
					Menu.close()
				});				
				e.menuitem.click(function() {
					return false
				});
			},
			toggle: function() {
				var e = this.settings;
				e.isOpen ? Menu.close() : Menu.open()
			},
			open: function() {
				function t() {
					e.menu.addClass("is-active");
					e.closebtn.addClass("is-active");
					e.navigation.addClass("nav-up");
					e.isAnimating = !1,
					$.each($('.clapat-menu-item'), function(i, el){setTimeout(function(){$(el).animate({'opacity':1.0});},500 + ( i * 80 ));});				
				}
				var e = this.settings;
				if (e.isAnimating === !1) {
					e.isOpen = !0;
					e.isAnimating = !0;
					e.menu.css("display", "block");
					setTimeout(t, 100)
				}
			},
			close: function() {
				$.each($('.clapat-menu-item').get().reverse(), function(i, el){setTimeout(function(){$(el).css({'opacity':0});},1 + ( i * 60 ));});
				function t() {
					e.menu.css("display", "none");
					e.isAnimating = !1
				}
				var e = this.settings;
				if (e.isAnimating === !1) {
					e.isOpen = !1;
					e.isAnimating = !0;
					e.menu.removeClass("is-active");
					e.closebtn.removeClass("is-active");
					e.navigation.removeClass("nav-up");
					setTimeout(t, 1200)
				}
			}
		};
		
		if( $('.clapat-overlay-menu').length > 0 ){
		
		Menu.init();
		
		}
		
		$(".sub-menu").hover(
			function () {
			 	$(this).parent().children('a').addClass("active");
			}, function () {
			 	$(this).parent().children('a').removeClass("active");
			}
		);
	
	
	}//End MenuOverlay
	


/*--------------------------------------------------
Function Menu Overlay Responsive
---------------------------------------------------*/	
	
	function MenuOverlayResponsive() {
	
		var winHeight = window.innerHeight
		var winWidth = window.innerWidth
		if (winWidth > 750) {
			$('.scr_menu').css( { 
				height : winHeight -250 + 'px',
				width : winWidth + 25 + 'px' 
			});
		} else {
			$('.scr_menu').css( { 
				height : winHeight -200 + 'px',
				width : winWidth + 25 + 'px' 
			});
		}
	
	}//End MenuOverlayNavPos
	
	
	
/*--------------------------------------------------
Function Hero Height
---------------------------------------------------*/	
	
	function HeroHeight() {
		if( $('#hero').length > 0 ){
			
			if ($('#hero').hasClass('hero-big')) {
				var heights = window.innerHeight;
				document.getElementById("hero").style.height = heights * 0.85 + "px";
			} else if ($('#hero').hasClass('hero-small')) {
				var heights = window.innerHeight;
				document.getElementById("hero").style.height = heights * 0.40 + "px";				
			} else  {			
				var heights = window.innerHeight;
				document.getElementById("hero").style.height = heights + "px";
			} 
			
		}
		
		if( $('#video-container').length > 0 ){
		
			$("#playmovie").css({'height':($("#hero").height()+'px')});
		
		}
		
	}//End HeroParallax
	
	
	
/*--------------------------------------------------
Function Hero Parallax
---------------------------------------------------*/	
	
	function HeroParallax() {
	
		var page_title = $('body');
			var block_intro = page_title.find('#hero');
			if( block_intro.length > 0 ) var block_intro_top = block_intro.offset().top;	
		$( window ).scroll(function() {
			var current_top = $(document).scrollTop(); 
			var hero_height = $('#hero').height();
			if( $('#hero').hasClass('parallax-hero')){			  
				block_intro.css('top', (current_top*0.5));			
			}
			if( $('#hero').hasClass('static-hero')){			  
				block_intro.css('top', (current_top*1));			
			}
			if( $('#hero').hasClass('opacity-hero')){				 
				block_intro.css('opacity', (1 - current_top/hero_height*1));
			}
		});
	
	}//End HeroParallax
	
	
	
/*--------------------------------------------------
Function Full Screen Slider
---------------------------------------------------*/	
		
	function FullScreenSlider() {
		
		if( $('.clapat-slider').length > 0 ){

			var fullscreen_slider_transition    = "fade";
			var fullscreen_slider_auto          = true;
			var fullscreen_slider_speed         = 5000;
			var fullscreen_slider_direction     = "horizontal";
			var fullscreen_slider_controls     	= "";
			if( typeof FullScreenSliderOptions != 'undefined' ){
				fullscreen_slider_transition    = FullScreenSliderOptions.slider_transition;
				fullscreen_slider_speed         = FullScreenSliderOptions.slider_speed;
				fullscreen_slider_auto          = FullScreenSliderOptions.slider_autoplay;
				fullscreen_slider_direction     = FullScreenSliderOptions.slider_direction;
				fullscreen_slider_controls		= FullScreenSliderOptions.slider_controls;
			}
			
			$('.clapat-slider').flexslider({
				animation: fullscreen_slider_transition,
				direction: fullscreen_slider_direction,
				slideshow: fullscreen_slider_auto,
				slideshowSpeed: fullscreen_slider_speed,
				animationSpeed: 1000,
				animationLoop: true,
				controlNav: false,
				controlsContainer: fullscreen_slider_controls,				
				before: function(slider) {
					$('.clapat-caption').fadeOut().animate({top:'-80px'},{queue:false, easing: 'easeOutQuad', duration: 500});
					slider.slides.eq(slider.currentSlide).delay(500);
					slider.slides.eq(slider.animatingTo).delay(500);
				},
				after: function(slider) {
					$('.clapat-caption').fadeIn().animate({top:'0'},{queue:false, easing: 'easeOutQuad', duration: 500});			
				},
				useCSS: true			
			});
		}
		
		
	
	}//End FullScreenSlider
	
	
	
/*--------------------------------------------------
Function Slider Background Change Logo and Menu Color 
---------------------------------------------------*/	
		
	function SliderBg() {
		
		if ($('li.dark-bg').hasClass("flex-active-slide")){
		   //$("#logo img").attr('src', 'images/logo_white.png');
		   
		   $("#logo").addClass('show-negative');
		   $(".clapat-menubtn .btn_menu_line").css('background-color', '#fff');			   
		}
		
		if ($('#hero').hasClass("dark-bg")){
		   $("#logo").addClass('show-negative');
		   $(".clapat-menubtn .btn_menu_line").css('background-color', '#fff');			   
		}
			
		$('.flex-direction-nav').on("click touchstart",function(){
			if($('li.dark-bg').hasClass("flex-active-slide")){
				setTimeout(function(){
					$("#logo").addClass('show-negative');
					$(".clapat-menubtn .btn_menu_line").css('background-color', '#fff');
				},900);
			}
			else {       
				setTimeout(function(){
					$("#logo").removeClass('show-negative');
					$(".clapat-menubtn .btn_menu_line").css('background-color', '#222');
				},900);
			}
		});
		
		$(window).scroll(function() {    
			var scroll = $(window).scrollTop();
		
			if (scroll >= $("#hero").height()) {
				$("#logo").removeClass('show-negative');
				$(".clapat-menubtn .btn_menu_line").css('background-color', '#222');
			} else {				
				if($('li.dark-bg').hasClass("flex-active-slide")) {
					$("#logo").addClass('show-negative');
					$(".clapat-menubtn .btn_menu_line").css('background-color', '#fff');
				}
				if ($('#hero').hasClass("dark-bg")){
				   $("#logo").addClass('show-negative');
				   $(".clapat-menubtn .btn_menu_line").css('background-color', '#fff');			   
				}
			}
		});
	
	}//End SliderBg	
	
	
	
/*--------------------------------------------------
Function Classic Slider
---------------------------------------------------*/	
		
	function ClassicSlider() {
		
		if( $('.classic-slider').length > 0 ){	
			$('.classic-slider').flexslider({
				animation: "slide",
				direction: "horizontal",
				animationSpeed: 1000,
				animationLoop: true,
				controlNav: false,
				slideshow: false,						
			});
		}
		
	}//End ClassicSlider	
	
	
	
/*--------------------------------------------------
Function Masonry Portfolio
---------------------------------------------------*/	
		
	function MasonryPortfolio() {	
	
		if( $('#portfolio-wrap').length > 0 ){	
		
			var $container = $('#portfolio');
		
			$container.isotope({
			  itemSelector: '.item',
			  gutter:0,
			  transitionDuration: "0.5s"
			});
			
			$('#filters a').click(function(){
				$('#filters a').removeClass('active');
				$(this).addClass('active');
				var selector = $(this).attr('data-filter');
				$container.isotope({ filter: selector });		
				return false;
			});
				
			
			
			$(document).scroll(function () {
				if($('.auto-construct').length > 0 ){
					var y = $(this).scrollTop();
					var t = $('#portfolio').offset().top + $('#portfolio').height() - window.innerHeight;
					if (y > t) {
						$('#portfolio').removeClass('auto-construct')
					} 
				}
			});
			
			$(window).on( 'resize', function () {
			
				var winWidth = window.innerWidth;
				columnNumb = 1;			
				var attr_col = $('#portfolio').attr('data-col');
					
				 if (winWidth >= 1466) {
					
					$('#portfolio-wrap').css( {width : 1360  + 'px'});
					$('#portfolio-wrap.no-gutter').css( {width : 1280  + 'px'});			
					var portfolioWidth = $('#portfolio-wrap').width();
					
					if (typeof attr_col !== typeof undefined && attr_col !== false) {
						columnNumb = $('#portfolio').attr('data-col');
					} else columnNumb = 3;
						
					postWidth = Math.floor(portfolioWidth / columnNumb)			
					$container.find('.item').each(function () { 
						$('.item').css( { 
							width : postWidth - 80 + 'px',
							height : postWidth * 0.75 - 80 + 'px',
							margin : 40 + 'px' 
						});
						$('.no-gutter .item').css( {
							width : postWidth  + 'px',
							height : postWidth * 0.75  + 'px',
							margin : 0 + 'px' 
						});
						$('.item.wide').css( { 
							width : postWidth * 2 - 80 + 'px'  
						});
						$('.no-gutter .item.wide').css( { 
							width : postWidth * 2 + 'px'  
						});
						$('.item.tall').css( {
							height : postWidth * 1.5 - 80 + 'px'  
						});
						$('.no-gutter .item.tall').css( {
							height : postWidth * 1.5  + 'px'  
						});
						$('.item.wide-tall').css( {
							width : postWidth * 2 - 80 + 'px',
							height : postWidth * 1.5 - 80 + 'px'  
						});
						$('.no-gutter .item.wide-tall').css( {
							width : postWidth * 2 + 'px',
							height : postWidth * 1.5  + 'px'  
						});
					});
					
					
				} else if (winWidth > 1024) {
					
					$('#portfolio-wrap').css( {width : 1000  + 'px'});
					$('#portfolio-wrap.no-gutter').css( {width : 940  + 'px'});			
					var portfolioWidth = $('#portfolio-wrap').width();
								
					if (typeof attr_col !== typeof undefined && attr_col !== false) {
						columnNumb = $('#portfolio').attr('data-col');
					} else columnNumb = 3;
					
					postWidth = Math.floor(portfolioWidth / columnNumb)			
					$container.find('.item').each(function () { 
						$('.item').css( { 
							width : postWidth - 60 + 'px',
							height : postWidth * 0.75 - 60 + 'px',
							margin : 30 + 'px' 
						});
						$('.no-gutter .item').css( {
							width : postWidth  + 'px',
							height : postWidth * 0.75  + 'px',
							margin : 0 + 'px' 
						});
						$('.item.wide').css( { 
							width : postWidth * 2 - 60 + 'px'  
						});
						$('.no-gutter .item.wide').css( { 
							width : postWidth * 2 + 'px'  
						});
						$('.item.tall').css( {
							height : postWidth * 1.5 - 60 + 'px'  
						});
						$('.no-gutter .item.tall').css( {
							height : postWidth * 1.5  + 'px'  
						});
						$('.item.wide-tall').css( {
							width : postWidth * 2 - 60 + 'px',
							height : postWidth * 1.5 - 60 + 'px'  
						});
						$('.no-gutter .item.wide-tall').css( {
							width : postWidth * 2 + 'px',
							height : postWidth * 1.5  + 'px'  
						});
					});
					
					
				} else if (winWidth > 767) {
					
					$('#portfolio-wrap').css( {width : 640  + 'px'});
					$('#portfolio-wrap.no-gutter').css( {width : 600  + 'px'});
					
					var portfolioWidth = $('#portfolio-wrap').width(),
					
					columnNumb = 2;
					postWidth = Math.floor(portfolioWidth / columnNumb)			
					$container.find('.item').each(function () { 
						$('.item').css( { 
							width : postWidth - 40 + 'px',
							height : postWidth * 0.75 - 40 + 'px',
							margin : 20 + 'px' 
						});
						$('.no-gutter .item').css( {
							width : postWidth  + 'px',
							height : postWidth * 0.75  + 'px',
							margin : 0 + 'px' 
						});
						$('.item.wide').css( { 
							width : postWidth * 2 - 40 + 'px'  
						});
						$('.no-gutter .item.wide').css( { 
							width : postWidth * 2 + 'px'  
						});
						$('.item.tall').css( {
							height : postWidth * 1.5 - 40 + 'px'  
						});
						$('.no-gutter .item.tall').css( {
							height : postWidth * 1.5  + 'px'  
						});
						$('.item.wide-tall').css( {
							width : postWidth * 2 - 40 + 'px',
							height : postWidth * 1.5 - 40 + 'px'  
						});
						$('.no-gutter .item.wide-tall').css( {
							width : postWidth * 2 + 'px',
							height : postWidth * 1.5  + 'px'  
						});
					});
					
					
				}	else if (winWidth > 479) {
					
					$('#portfolio-wrap').css( {width : 440  + 'px'});
					$('#portfolio-wrap.no-gutter').css( {width : 400  + 'px'});
					
					var portfolioWidth = $('#portfolio-wrap').width(),
					
					columnNumb = 1;
					postWidth = Math.floor(portfolioWidth / columnNumb)			
					$container.find('.item').each(function () { 
						$('.item').css( { 
							width : postWidth - 40 + 'px',
							height : postWidth * 0.75 - 40 + 'px',
							margin : 20 + 'px' 
						});
						$('.no-gutter .item').css( {
							width : postWidth  + 'px',
							height : postWidth * 0.75  + 'px',
							margin : 0 + 'px' 
						});
						$('.item.wide').css( { 
							width : postWidth - 40 + 'px'  
						});
						$('.no-gutter .item.wide').css( { 
							width : postWidth + 'px'  
						});
						$('.item.tall').css( {
							height : postWidth * 1.5 - 40 + 'px'  
						});
						$('.no-gutter .item.tall').css( {
							height : postWidth * 1.5  + 'px'  
						});
						$('.item.wide-tall').css( {
							width : postWidth - 40 + 'px',
							height : postWidth * 0.75 - 40 + 'px'  
						});
						$('.no-gutter .item.wide-tall').css( {
							width : postWidth  + 'px',
							height : postWidth * 0.75  + 'px'  
						});
					});
					
					
				}
				
				else if (winWidth <= 479) {
					
					$('#portfolio-wrap').css( {width : 280  + 'px'});
					$('#portfolio-wrap.no-gutter').css( {width : 240  + 'px'});
					
					var portfolioWidth = $('#portfolio-wrap').width(),
					
					columnNumb = 1;
					postWidth = Math.floor(portfolioWidth / columnNumb)			
					$container.find('.item').each(function () { 
						$('.item').css( { 
							width : postWidth - 40 + 'px',
							height : postWidth * 0.75 - 40 + 'px',
							margin : 20 + 'px' 
						});
						$('.no-gutter .item').css( {
							width : postWidth  + 'px',
							height : postWidth * 0.75  + 'px',
							margin : 0 + 'px' 
						});
						$('.item.wide').css( { 
							width : postWidth - 40 + 'px'  
						});
						$('.no-gutter .item.wide').css( { 
							width : postWidth + 'px'  
						});
						$('.item.tall').css( {
							height : postWidth * 1.5 - 40 + 'px'  
						});
						$('.no-gutter .item.tall').css( {
							height : postWidth * 1.5  + 'px'  
						});
						$('.item.wide-tall').css( {
							width : postWidth - 40 + 'px',
							height : postWidth * 0.75 - 40 + 'px'  
						});
						$('.no-gutter .item.wide-tall').css( {
							width : postWidth + 'px',
							height : postWidth * 0.75  + 'px'  
						});
					});
					
					
				}		
				return columnNumb;
				
			
			}).resize();
		
			$("#all").click();	
			
			
			if (window.innerWidth >= 1466) {
					if($('.auto-construct').length > 0 ){		
						$('.item').each(function(i){
							$(this).css({'opacity':0, 'margin-top':180 + 'px', 'margin-bottom':80 + 'px'});	
							
							if($('.auto-construct').length > 0 ){		
								$(this).appear(function() {	
									if($("#portfolio-wrap").hasClass("no-gutter")) {						
										$(this).delay(i*50).animate({'opacity':1, 'margin-top':0 + 'px', 'margin-bottom':0 + 'px'},300,'easeOutSine');
									} else {
										$(this).delay(i*50).animate({'opacity':1, 'margin-top':40 + 'px', 'margin-bottom':40 + 'px'},300,'easeOutSine');
									}
								});
								
								$('#portfolio').removeClass('.auto-construct');
							}					
							
						}); 
					}
				} else if (window.innerWidth > 1024) {
					if($('.auto-construct').length > 0 ){		
						$('.item').each(function(i){
							$(this).css({'opacity':0, 'margin-top':180 + 'px', 'margin-bottom':80 + 'px'});	
							
							if($('.auto-construct').length > 0 ){		
								$(this).appear(function() {							
									if($("#portfolio-wrap").hasClass("no-gutter")) {						
										$(this).delay(i*50).animate({'opacity':1, 'margin-top':0 + 'px', 'margin-bottom':0 + 'px'},300,'easeOutSine');
									} else {
										$(this).delay(i*50).animate({'opacity':1, 'margin-top':30 + 'px', 'margin-bottom':30 + 'px'},300,'easeOutSine');
									}
								});
							}					
							
						});
					}
			}
			
			
		}
	
	}//End MasonryPortfolio



/*--------------------------------------------------
Function Toggle Secondary Menu
---------------------------------------------------*/	
		
	function ToggleSecondaryMenu() {		
	
	var filters_on 	= "Hide";
	var filters_off = "Filters";
	var contact_on 	= "Hide";
	var contact_off = "Contact";
	var search_on 	= "Hide";
	var search_off 	= "Search";
	var share_on 	= "Hide";
	var share_off 	= "Share";
	var prod_filters_on  = "Hide";
	var prod_filters_off = "Filters";
	if( typeof ClapatSecondaryMenuOptions != 'undefined' ){
		
		filters_on 	= ClapatSecondaryMenuOptions.filters_on;
		filters_off = ClapatSecondaryMenuOptions.filters_off;
		contact_on 	= ClapatSecondaryMenuOptions.contact_on;
		contact_off = ClapatSecondaryMenuOptions.contact_off;
		search_on 	= ClapatSecondaryMenuOptions.search_on;
		search_off 	= ClapatSecondaryMenuOptions.search_off;
		share_on 	= ClapatSecondaryMenuOptions.share_on;
		share_off 	= ClapatSecondaryMenuOptions.share_off;
		prod_filters_on  = ClapatSecondaryMenuOptions.prod_filters_on;
		prod_filters_off = ClapatSecondaryMenuOptions.prod_filters_off;
	}
	
	$('.toggle-filters').click(function() {
		
		if ($("#filters").hasClass('filters-hide')){
			$("#filters").toggleClass("filters-hide");
			setTimeout(function(){
				$('html, body').animate({ scrollTop: $("#main").offset().top +1 }, 500);
			},( 100 ));		
		} else {
			$("#filters").toggleClass("filters-hide");
		}		
		if($(this).text()==filters_off)
		{
			$(this).text(filters_on);
		} else {
			$(this).text(filters_off);
		}
		return false;
	});
	
	
	$('.toggle-sm').click(function() {
		
		if ($("#contact-info").hasClass('contact-hide')){		
			$("#contact-info").toggleClass("contact-hide");	
			setTimeout(function(){
				$('html, body').animate({ scrollTop: $("#main").offset().top +1 }, 500);
			},( 100 ));			
		} else {
			$("#contact-info").toggleClass("contact-hide");
		}		
		if($(this).text()==contact_off)
		{
			$(this).text(contact_on);
		} else {
			$(this).text(contact_off);
		}
		return false;
	});	
	
	
	$('.toggle-search').click(function() {
		
		if ($("#search-box").hasClass('search-hide')){		
			$("#search-box").toggleClass("search-hide");	
			setTimeout(function(){
				$('html, body').animate({ scrollTop: $("#main").offset().top +1 }, 500);
			},( 100 ));			
		} else {
			$("#search-box").toggleClass("search-hide");
		}		
		if($(this).text()==search_on)
		{
			$(this).text(search_off);
		} else {
			$(this).text(search_on);
		}
		return false;
	});
	
	
	$('.toggle-share').click(function() {
		
		if ($("#post-sharing").hasClass('share-hide')){		
			$("#post-sharing").toggleClass("share-hide");	
			setTimeout(function(){
				$('html, body').animate({ scrollTop: $("#main").offset().top +1 }, 500);
			},( 100 ));			
		} else {
			$("#post-sharing").toggleClass("share-hide");
		}		
		if($(this).text()==share_off)
		{
			$(this).text(share_on);
		} else {
			$(this).text(share_off);
		}
		return false;
	});		
	
	$('.toggle-shop-filters').click(function() {
		
		if ($("#shop-filters").hasClass('filters-shop-hide')){
			$("#shop-filters").toggleClass("filters-shop-hide");
			setTimeout(function(){
				$('html, body').animate({ scrollTop: $("#main").offset().top +1 }, 500);
			},( 100 ));		
		} else {
			$("#shop-filters").toggleClass("filters-shop-hide");
		}		
		if($(this).text()==prod_filters_off)
		{
			$(this).text(prod_filters_on);
		} else {
			$(this).text(prod_filters_off);
		}
		return false;
	});
	
	}//End ToggleSecondaryMenu

	
/*--------------------------------------------------
Function BlogPost
---------------------------------------------------*/
	
	function BlogPost() {

		$("a.post-title").hover(
			 function () {
				 $(this).parent().parent().addClass("post-hover");
			 }, function () {
				 $(this).parent().parent().removeClass("post-hover");
			 }
		 );
		 
	}//End BlogPost	
	
	
	
/*--------------------------------------------------
Function AppearIteam
---------------------------------------------------*/	
		
	function AppearIteam() {		
		
		$('.has-animation').each(function() {	
			$(this).appear(function() {
				if($(this).attr('data-animation') == 'fade-in-from-left'){
					$(this).delay($(this).attr('data-delay')).animate({
						'opacity' : 1,
						'left' : '0px'
					},500,'easeOutSine');
				} else if($(this).attr('data-animation') == 'fade-in-from-right'){
					$(this).delay($(this).attr('data-delay')).animate({
						'opacity' : 1,
						'right' : '0px'
					},500,'easeOutSine');
				} else if($(this).attr('data-animation') == 'fade-in-from-bottom'){
					$(this).delay($(this).attr('data-delay')).animate({
						'opacity' : 1,
						'bottom' : '0px'
					},500,'easeOutSine');
				} else if($(this).attr('data-animation') == 'fade-in') {
					$(this).delay($(this).attr('data-delay')).animate({
						'opacity' : 1
					},500,'easeOutSine');	
				} else if($(this).attr('data-animation') == 'grow-in') {
					var $that = $(this);
					setTimeout(function(){ 
						$that.transition({ scale: 1, 'opacity':1 },900,'easeInCubic');
					},$that.attr('data-delay'));
				}			
			},{accX: 0, accY: -105},'easeInCubic');
		
		});		
	
	}//End AppearIteam
	
	
/*--------------------------------------------------
Function VideoHeader
---------------------------------------------------*/
	
	function VideoHeader() {
		
		if( $('#video-container').length > 0 ){
		
			var onMobile = false;
				if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) { onMobile = true; }
		
				if( ( onMobile === false ) ) {
		
					$(".player").mb_YTPlayer();
					
					setTimeout(function() {
						  $('#bgndVideo').pauseYTP();
					}, 1000);		
					
					$('#playmovie').click(function() {			
							$('#playmovie').addClass('hidden-play');
							setTimeout(function(){
								$('#playmovie').fadeOut();	
							}, 600);
							$('#bgndVideo').playYTP();
										
					});			
					
					$('#stopmovie').click(function() {			
						$('#playmovie').fadeIn(1);
						setTimeout(function(){
							$('#playmovie').removeClass('hidden-play');				
							$('#bgndVideo').pauseYTP();				
						}, 100);
					});	
			
				} else {
				
					/* as a fallback we add a special class to the header which displays a poster image */ 
					$('#home').addClass('video-section');
					
					/* hide player */
					$(".player").hide();
					
					$(".play-icon").hide();
					
				}
				
		}
				 
	}//End VideoHeader	

	
/*--------------------------------------------------
Function ShowCart
---------------------------------------------------*/
	
	function ShowCart() {
		
		if( $('.site-header-cart').length > 0 ){
		
			$(".site-header-cart").hover(
				 function () {
					 $(".widget_shopping_cart").addClass("active").delay(10).queue(function(next){$(this).addClass("visible");next();});
				 }, function () {
					 $(".widget_shopping_cart").removeClass("visible").delay(100).queue(function(next){$(this).removeClass("active");next();});
				 }
			 );	
				
		}
		
		
				 
	}//End ShowCart
	
	
	
/*--------------------------------------------------
Function ShopColumns
---------------------------------------------------*/
	
	function ShopColumns() {
		
		if( $('#shop-wrapper').length > 0 ){
			
			$(window).on( 'resize', function () {
			
				shopColumns = 1;			
				var attr_col = $('#shop-wrapper').attr('data-col');
				
				var winWidth = window.innerWidth;
				
				if (winWidth >= 1466) {
				 
						$('#shop-wrapper').css( {width : 1360  + 'px'});					
						var shopWidth = $('#shop-wrapper').width(); 
											
						if (typeof attr_col !== typeof undefined && attr_col !== false) {
							shopColumns = $('#shop-wrapper').attr('data-col');
						} else shopColumns = 3;
						
						productWidth = Math.floor(shopWidth / shopColumns)			
						$('#shop-wrapper').find('.product').each(function () { 
							$('.product').css( { 
								width : productWidth - 80 + 'px'
							});
						});
					
				} else if (winWidth > 1024) {
					
						$('#shop-wrapper').css( {width : 1000  + 'px'});					
						var shopWidth = $('#shop-wrapper').width(); 
											
						if (typeof attr_col !== typeof undefined && attr_col !== false) {
							shopColumns = $('#shop-wrapper').attr('data-col');
						} else shopColumns = 3;
						
						productWidth = Math.floor(shopWidth / shopColumns)			
						$('#shop-wrapper').find('.product').each(function () { 
							$('.product').css( { 
								width : productWidth - 60 + 'px'
							});
						});
						
				} else if (winWidth > 767) {					
					
						$('#shop-wrapper').css( {width : 660  + 'px'});					
						var shopWidth = $('#shop-wrapper').width(); 
											
						shopColumns = 2;
						
						productWidth = Math.floor(shopWidth / shopColumns)			
						$('#shop-wrapper').find('.product').each(function () { 
							$('.product').css( { 
								width : productWidth - 60 + 'px'
							});
						});
						
				} else if (winWidth <= 767) {
					
					$('#shop-wrapper').css( {width : 100  + '%'});					
						var shopWidth = $('#shop-wrapper').width(); 
											
						shopColumns = 1;
						
						productWidth = Math.floor(shopWidth / shopColumns)			
						$('#shop-wrapper').find('.product').each(function () { 
							$('.product').css( { 
								width : productWidth + 'px'
							});
						});
					
				}
	
				return shopColumns;
			
			}).resize();
				
		}
				 
	}//End ShopColumns	
	
				
/*--------------------------------------------------
Function Shortcodes
---------------------------------------------------*/	
		
	function Shortcodes() {			
		
		//Progress bar animations	
		$('.progress-bar li').each(function(i){		
			$(this).appear(function(){			
				var percent = $(this).find('span').attr('data-width');
				var $endNum = parseInt($(this).find('span strong i').text());
				var $that = $(this);			
				$(this).find('span').animate({
					'width' : percent + '%'
				},1600, function(){
				});			
				$(this).find('span strong').animate({
					'opacity' : 1
				},1400);			
				$(this).find('span strong i').countTo({
					from: 0,
					to: $endNum,
					speed: 1200,
					refreshInterval: 30,
					onComplete: function(){}
				});	 
				if(percent == '100'){
					$that.find('span strong').addClass('full');
				}	
			});
		});	
		
		
		// Accordion	  
		$('dl.accordion dt').filter(':first-child').addClass('accordion-active');
		$('dd.accordion-content').filter(':nth-child(n+3)').slideUp(1).addClass('hide');		
		$('dl.accordion').on('click', 'dt', function() {
			$(this).addClass('accordion-active').next().slideDown(200).siblings('dd.accordion-content').slideUp(200).prev().removeClass('accordion-active');						
		});	
		$('dl.accordion').on('click', 'dt.accordion-active', function() {
			$(this).removeClass('accordion-active').siblings('dd.accordion-content').slideUp(200);
		});
		
		
		// Toggle	
		$(".toggle_container").hide(); 
		$("span.toggle-title").click(function(){
			$(this).toggleClass("toggle-active").next().slideToggle("normal");
			return false; 
		});
		
		
		// Tabs	
		$(".tab_container").hide(); 
		$("ul.tabs li:first").addClass("tab-active").show(); 
		$(".tab_container:first").show(); 		
		$("ul.tabs li").click(function() {
			$("ul.tabs li").removeClass("tab-active"); 
			$(this).addClass("tab-active"); 
			$(".tab_container").hide(); 
			var activeTab = $(this).find("a").attr("href"); 
			$(activeTab).fadeIn(); 
			return false;
		});
			
			
		// Milestone counters
		$('.clapat-counter').each(function() {
			$(this).appear(function() {
				var $endNum = parseInt($(this).find('.number').text());
				$(this).find('.number').countTo({
					from: 0,
					to: $endNum,
					speed: 1500,
					refreshInterval: 30
				});
			},{accX: 0, accY: 0});
		});
		
		
		//Fading Out AlertBox
		$('.shortcode_alertbox').find('.box_close').click(function(){
			$(this).parents('.alertboxes').animate({opacity:0},300).animate({height:"0px"});
		});	
		
		
		//ColorBox
		$('a.gallery').colorbox({rel:'gal', maxWidth: "95%", maxHeight: "95%"});
		
		
		//Parallax
		$('.parallax').each(function(){	
			$(this).parallax("30%", 0.1);	
		});
		
		
		// Radial Counters	
		if( jQuery('.radial-counter').length > 0 ){		
			$(".knob").knob({
				width: 140,
				height: 140,
				fgColor: '#eee',
				bgColor: '#fff',
				inputColor: '#fff',
				dynamicDraw: true,
				thickness: 0.05,
				tickColorizeValues: true,
				skin:'tron',
				readOnly:true,
			});	
			$(".knob").appear(function(e){			
				var $this = $(this);
				var myVal = $this.attr("data-gal");	
			   $({value: 0}).animate({value: myVal}, {
				   duration: 2000,
				   easing: 'swing',
				   step: function () {
					   $this.val(Math.ceil(this.value)).trigger('change');
				   }
			   })			
			});	
		}
		
		
		//Video Image Play Cover
		$('.vimeo a,.youtube a').click(function (e) {
			e.preventDefault();
			var videoLink = $(this).attr('href');
			var classeV = $(this).parent();
			var PlaceV = $(this).parent();
			if ($(this).parent().hasClass('youtube')) {
				$(this).parent().wrapAll('<div class="cntVid">');
				$(PlaceV).html('<iframe frameborder="0" height="333" src="' + videoLink + '?autoplay=1&showinfo=0" title="YouTube video player" width="547"></iframe>');
			} else {
				$(this).parent().wrapAll('<div class="cntVid">');
				$(PlaceV).html('<iframe src="' + videoLink + '?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=1&amp;color=ffffff" width="500" height="281" frameborder="0"></iframe>');
			}
		});
			
		//Shop Filters
		if( $('#shop-filters').length > 0 ){		
		
			//Select Options
			$('.orderby').selectric();

			var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ? true : false;
	
			$(".variables select").each(function() {
				if(!isMobile) {
					var sb = new SelectBox({
						selectbox: $(this)
					});
					void(sb);
	
				}
			});
	
			if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
				$(".variables select").css({'display':'block'});
			}
			
		}
		
		
		var thisrowfield;
		$('.plus').click(function(e){
			e.preventDefault();
			thisrowfield = $(this).parent().parent().parent().find('.qty');

			var currentVal = parseInt(thisrowfield.val());
			if (!isNaN(currentVal)) {
				thisrowfield.val(currentVal + 1);
			} else {
				thisrowfield.val(0);
			}
		});

		$(".minus").click(function(e) {
			e.preventDefault();
			thisrowfield = $(this).parent().parent().parent().find('.qty');
			var currentVal = parseInt(thisrowfield.val());
			if (!isNaN(currentVal) && currentVal > 0) {
				thisrowfield.val(currentVal - 1);
			} else {
				thisrowfield.val(0);
			}
		});
		
		
	}//End Shortcodes
	
	
/*--------------------------------------------------
Function TwitterFeed
---------------------------------------------------*/	
		
	function TwitterFeed() {
		
		if ($('#twitter-feed').length > 0 ){
			
			$('#twitter-feed').find('ul').addClass('slides');
			$('#twitter-feed').find('ul li').addClass('slide');
			$('.twitter-slider').flexslider({
				animation: "slide",
				direction: "horizontal",
				smoothHeight: true,
				controlNav: true,
				controlsContainer:".twitter-nav",
				directionNav: false,
				start: function(slider){
					$('body').removeClass('loading');
				}
			});
		};
	
	
	}//End TwitterFeed
	

})(jQuery);//End All

/*--------------------------------------------------
Function Contact Map
---------------------------------------------------*/	

function ContactMap() {	
	
	if( jQuery('#map_canvas').length > 0 ){
		
		var map_marker_image 	= 'images/marker.png';
        var map_address 		= 'New York City'
        var map_zoom			= 16;
        var marker_title 		= 'Hello Friend!';
		var marker_text			= 'Here we are. Come to drink a coffee!';
		var map_type			= google.maps.MapTypeId.SATELLITE;
		
		if( typeof ClapatMapOptions != 'undefined' ){
		
			map_marker_image 	= ClapatMapOptions.map_marker_image;
			map_address 		= ClapatMapOptions.map_address;
			map_zoom			= Number(ClapatMapOptions.map_zoom);
			marker_title 		= ClapatMapOptions.marker_title;
			marker_text			= ClapatMapOptions.marker_text;
			if( ClapatMapOptions.map_type == 0 ){
			
				map_type = google.maps.MapTypeId.SATELLITE;
			}
			else{
			
				map_type = google.maps.MapTypeId.ROADMAP;
			}
			
		}
				
		var settings = {
			zoom: map_zoom,
			center: new google.maps.LatLng(43.270441,6.640888),
			mapTypeControl: false,
			scrollwheel: false,
			draggable: true,
			panControl:false,
			scaleControl: false,
			zoomControl: false,
			streetViewControl:false,
			navigationControl: false,
			mapTypeId: map_type};		
		var map = new google.maps.Map(document.getElementById("map_canvas"), settings);	
		google.maps.event.addDomListener(window, "resize", function() {
			var center = map.getCenter();
			google.maps.event.trigger(map, "resize");
			map.setCenter(center);
		});	
		var contentString = '<div id="content-map-marker" style="text-align:left; padding-top:10px; padding-left:10px">'+
			'<div id="siteNotice">'+
			'</div>'+
			'<h4 id="firstHeading" class="firstHeading" style="color:#000; margin-bottom:0px;"><strong>' + marker_title + '</strong></h4>'+
			'<div id="bodyContent">'+
			'<p style="font-family:Verdana; color:#999; font-size:12px; margin-bottom:10px">' + marker_text + '</p>'+
			'</div>'+
			'</div>';
		var infowindow = new google.maps.InfoWindow({
			content: contentString
		});	
		var companyImage = new google.maps.MarkerImage(map_marker_image,
			new google.maps.Size(58,63),<!-- Width and height of the marker -->
			new google.maps.Point(0,0),
			new google.maps.Point(35,20)<!-- Position of the marker -->
		);
		
		var latitude = 43.270441;
        var longitude = 6.640888;
		var geocoder = new google.maps.Geocoder();
		geocoder.geocode({'address':map_address}, function(results, status) {
 			if(status == google.maps.GeocoderStatus.OK) {
			
				map.setCenter(results[0].geometry.location);
				
                latitude = results[0].geometry.location.lat();
                longitude = results[0].geometry.location.lng();
				
				var companyPos = new google.maps.LatLng(latitude, longitude);	
				var companyMarker = new google.maps.Marker({
									position: companyPos,
									map: map,
									icon: companyImage,               
									title:"Our Office",
									zIndex: 3});	
								google.maps.event.addListener(companyMarker, 'click', function() {
									infowindow.open(map,companyMarker);
								});	
			}
		});
		
	}
	
	return false
	
}

function InitContactMap() {
	
	if( jQuery('#map_canvas').length > 0 ){
		
		if (typeof google != 'undefined' && typeof google.maps != 'undefined'){
			
			// google maps already loaded, call the function which draws the map
			ContactMap();
			
		} else {
		
			var map_api_key = '';
			if( typeof ClapatMapOptions != 'undefined' ){
				map_api_key = 'key=' + ClapatMapOptions.map_api_key;
			}
			var script = document.createElement('script');
			script.type = 'text/javascript';
			script.src = 'https://maps.googleapis.com/maps/api/js?' + map_api_key +
			      		'&callback=ContactMap';
			document.body.appendChild(script);
		}
		
	}
}

//End ContactMap

//Social Sharing
var completed = 0;
////facebook
if( jQuery('a.clapat-facebook-share').length > 0 ){
    ////facebook
    //load share count on load
    jQuery.getJSON("http://graph.facebook.com/?id="+ window.location +'&callback=?', function(data) {
        if((data.shares != 0) && (data.shares != undefined) && (data.shares != null)) {
            jQuery('.clapat-facebook-share a span.count, a.clapat-facebook-share span.count').html( data.shares );
        }
        else {
            jQuery('.clapat-facebook-share a span.count, a.clapat-facebook-share span.count').html( 0 );
        }
        completed++;
    });
    function facebookShare(){
        window.open( 'https://www.facebook.com/sharer/sharer.php?u='+window.location, "facebookWindow", "height=380,width=660,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" )
        return false;
    }
    jQuery('.clapat-facebook-share').click(facebookShare);
}

////twitter
if( jQuery('a.clapat-twitter-share').length > 0 ){
    //load tweet count on load
    jQuery.getJSON('http://urls.api.twitter.com/1/urls/count.json?url='+window.location+'&callback=?', function(data) {
        if((data.count != 0) && (data.count != undefined) && (data.count != null)) {
            jQuery('.clapat-twitter-share a span.count, a.clapat-twitter-share span.count').html( data.count );
        }
        else {
            jQuery('.clapat-twitter-share a span.count, a.clapat-twitter-share span.count').html( 0 );
        }
        completed++;
    });
    function twitterShare(){
        window.open( 'http://twitter.com/intent/tweet?text='+jQuery(".post-header h1").text() +' '+window.location, "twitterWindow", "height=380,width=660,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" )
        return false;
    }
    jQuery('.clapat-twitter-share').click(twitterShare);
}

 ////pinterest
if(jQuery('a.clapat-pinterest-share').length > 0){
    //load pin count on load
    jQuery.getJSON('http://api.pinterest.com/v1/urls/count.json?url='+window.location+'&callback=?', function(data) {
        if((data.count != 0) && (data.count != undefined) && (data.count != null)) {
            jQuery('.clapat-pinterest-share a span.count, a.clapat-pinterest-share span.count').html( data.count );
        }
        else {
            jQuery('.clapat-pinterest-share a span.count, a.clapat-pinterest-share span.count').html( 0 );
        }
        completed++;
    });
    function pinterestShare(){
        var jQuerysharingImg = '';
        if ( (jQuery('#clapat-share-image').length > 0) && (jQuery('#clapat-share-image').attr('clapat-data-img') != 'empty' )){
            jQuerysharingImg = jQuery('#clapat-share-image').attr('clapat-data-img');
        }
        window.open( 'http://pinterest.com/pin/create/button/?url='+window.location+'&media='+jQuerysharingImg+'&description='+jQuery('.post-header h1').text(), "pinterestWindow", "height=640,width=660,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" )
        return false;
    }
    jQuery('.clapat-pinterest-share').click(pinterestShare);
}
//End Social Sharing