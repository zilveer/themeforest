/*
Name: 			Theme Initializer
Written by: 	JanXcode Themes - (http://www.janxcode.com)
Version: 		1.0
*/

(function() {

	"use strict";

	var Theme = {

		initialized: false,

		initialize: function() {

			if (this.initialized) return;
			this.initialized = true;

			this.build();
			this.events();

		},

		build: function() {

			this.megaMenu();
			
			//Items on ready
			this.onReady();
			
			//Items on load
			this.onLoad();			
		
			// Nav Menu
			this.stickyMenu();
			
			//Mobile Menu
			jQuery('#jx-ievent-main-menu,#jx-ievent-main-menu-2').slicknav();

			// ScrollTop
			this.scrollTop();

			// Word Rotate
			this.wordAnimate();
			
			// Animation
			this.animation();

			
			// Toggle
			this.toggle();
			
			// Tabs
			this.tabs();	
		
			// Lightbox
			this.prettyPhoto();
			
			// Parallax
			this.parallax();
			
			// Isotope
			this.isotope();
			
			//Counter
			this.counter();
			
			//Bouncy 
			this.bouncy();
			
			//Theme Styler
			//this.themestyler();

		},

		events: function() {
			
			// Window Resize
			jQuery(window).afterResize(function() {


			});


		},
		
		megaMenu: function(){
		
			jQuery(document).ready(function(){
				//Mega Menu
				jQuery('.menu > li > .submenu').each(function() {
				var sub_menu_width= 264;
				var sub_menu=jQuery('submenu',this);
				var numItems = jQuery('li.col',this).length;			
				
				
				//Remove Border from cols > 1
				
				if (numItems > 1){
				jQuery('li.col li',this).css({'border':'none'});
				jQuery('li.col',this).css({'border-right':'1px solid #333'});
				}				
				
				//calculate total columns width
				var new_sub_menu_width=sub_menu_width * numItems;			
				jQuery(this).css('width',new_sub_menu_width+'px');		

				//reposition submenu
				var pos = jQuery(this).parent().position().left;
				var menu_pos = jQuery('.menu').offset().left;		
		
				// Fixed Sidebar
				jQuery('#sidebar').theiaStickySidebar({
						additionalMarginTop: 30
					});
				
				//Get Right Position
				var $whatever = jQuery(this);
				var right_pos = (jQuery(window).width() - ($whatever.offset().left + $whatever.outerWidth()));
				var width_pos = new_sub_menu_width;
				var docW = jQuery(".container").width();
				var menu_width_pos=pos + new_sub_menu_width + menu_pos;
				var screen_size=jQuery(window).width();
				//console.log(menu_width_pos);
				//console.log(docW);
				//console.log();
				
				if (menu_width_pos > screen_size){	
				
				var left_pos = menu_width_pos - screen_size;				
				jQuery(this).css({'left':pos-left_pos-30});
				}
				
				});
				
			});
		
		},
		
		//Items on Ready
		onReady: function(){				
			
			
			jQuery(document).ready(function(){
											
				var value;
							
				/*Point of interest */
				//open interest point description
				jQuery('.jx-ievent-single-point').children('a').on('click', function(){
					var selectedPoint = jQuery(this).parent('li');
					if( selectedPoint.hasClass('is-open') ) {
						selectedPoint.removeClass('is-open').addClass('visited');
					} else {
						selectedPoint.addClass('is-open').siblings('.jx-ievent-single-point.is-open').removeClass('is-open').addClass('visited');
					}
				});
				//close interest point description
				jQuery('.jx-ievent-close-info').on('click', function(event){
					event.preventDefault();
					jQuery(this).parents('.jx-ievent-single-point').eq(0).removeClass('is-open').addClass('visited');
				});	
											
				/* Grid Switcher */
				jQuery('.jx-ievent-switcher-btn').on('click',function() {
					
				});
				
				if (jQuery(".select-box,.wpcf7-select").length > 0){
					jQuery(".select-box,.wpcf7-select").selectbox();
					
					jQuery(".select-box,.wpcf7-select").find("option[value='" + value + "']").prop("selected", "selected");
					
				}
				
				
				///Count Down
				if (jQuery(".jx-ievent-countdown-box").length > 0){					
					
					var time_1 = jQuery( ".jx-ievent-countdown-box" ).data( "time" );
					
					
					jQuery(".jx-ievent-countdown-box .countdown").jCounter({
						date: time_1.replace(/\-/g, " "), 
						timezone: "Europe/Bucharest",
						format: "dd:hh:mm:ss",
						twoDigits: 'on',
						fallback: function() { console.log("Counter finished!") }
					});
				}
				
				
				///Count Down
				if (jQuery(".jx-ievent-countdown-box-2").length > 0){					
					
					var time_2 = jQuery( ".jx-ievent-countdown-box-2" ).data( "time" );
					
					
					jQuery(".jx-ievent-countdown-box-2 .countdown").jCounter({
						date: time_2.replace(/\-/g, " "), 
						timezone: "Europe/Bucharest",
						format: "dd:hh:mm:ss",
						twoDigits: 'on',
						fallback: function() { console.log("Counter finished!") }
					});
				}
				
				
				//Count Down
				if (jQuery(".jx-ievent-event-box-counter").length > 0){					
					
					var time_2 = jQuery( ".jx-ievent-event-box-counter" ).data( "time" );
				
					jQuery(".jx-ievent-event-box-counter .jx-ievent-countdown").jCounter({
						date: time_2.replace(/\-/g, " "),					 
						timezone: "Europe/Bucharest",
						format: "dd:hh:mm:ss",
						twoDigits: 'on',
						fallback: function() { console.log("Counter finished!") }
					});
				}
				
				//Mobile Menu
				jQuery('.slicknav_nav li.col > ul').children().unwrap();
				jQuery('.slicknav_nav li.col').children().unwrap();
				jQuery('.slicknav_nav li.clear').remove();
				//jQuery('.slicknav_nav ul.submenu a.slicknav_item').remove();
				
				
				//Mobile Chk
				var isMobile = {
					Android: function() {
						return navigator.userAgent.match(/Android/i);
					},
					BlackBerry: function() {
						return navigator.userAgent.match(/BlackBerry/i);
					},
					iOS: function() {
						return navigator.userAgent.match(/iPhone|iPad|iPod/i);
					},
					Opera: function() {
						return navigator.userAgent.match(/Opera Mini/i);
					},
					Windows: function() {
						return navigator.userAgent.match(/IEMobile/i);
					},
					any: function() {
						return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
					}
				};
				
				if( isMobile.any() ) {
				   jQuery('.jx-ievent-rev-slider-holder').removeClass('jx-ievent-animate-header');
				}			
			
			});
			
			// Menu Active
			var pgurl = window.location.href.substr(window.location.href.lastIndexOf("/")+1);
				 jQuery(".menu > li").each(function(){
					  if(jQuery(this).find("a").attr("href") == pgurl || jQuery(this).find("a").attr("href") == '' )
					  jQuery(this).addClass("active");
				 });
				 
			//Form validator
			
			
			//Form Popup
			jQuery('.open-popup-link').magnificPopup({
			  type:'inline',
			  midClick: true, // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
			closeBtnInside: true	
			});
			
			//Mailchimp
			jQuery('form#mailchimp').submit(function(e) {
				e.preventDefault();
		
				var successMSG = "<p>You've been added to our sign-up list.<br />We have sent an email, asking you to confirm the same.</p>";
				var errorMSG = "<p>There was an error. Please try again.</p>";
				var invalidEmailMSG = "<p>That does not look like a valid email.</p>";
				var alreadySubscribedMSG = "<p>You have already subscribed to our sign-up list.</p>";
		
				jQuery('.ajax-loader').show();
				jQuery(this).ajaxSubmit({
					success	: function (responseText) {
						
						alert(responseText);
						
						if (responseText === 'added') {
							jQuery('form#mailchimp').fadeOut('fast');
							jQuery('#mailchimp-sign-up p').replaceWith(successMSG).fadeIn('slow');
						} else if (responseText === 'already subscribed') {
							jQuery('form#mailchimp').fadeOut('fast');
							jQuery('#mailchimp-sign-up p').replaceWith(alreadySubscribedMSG).fadeIn('slow');
						} else if (responseText === 'invalid email') {
							jQuery('#mailchimp-sign-up p').replaceWith(invalidEmailMSG).fadeIn('slow');
						} else {
							jQuery('#mailchimp-sign-up p').replaceWith(errorMSG).fadeIn('slow');
							//jQuery('#mailchimp-sign-up p').replaceWith(responseText).fadeIn('slow');
						}
						jQuery('.ajax-loader').hide();
					},
					url		: ajaxVars.ajaxurl,
					data	: { ajax_nonce : ajaxVars.ajax_nonce, action : 'add_to_mailchimp_list' },
					type	: 'POST',
					timeout	: 50000,
				});
			});
			
			//Menu Classes
			
			
			jQuery(".header-4 .main-menu ul li").hover(function() {
				jQuery(this).find("a").toggleClass("hovered");
			});			
			
				 
		},	
		//Items on windows load
		onLoad: function(){
			
			jQuery(window).on("load",function(){

				"use strict";
				jQuery('.spinner').fadeOut(); // will first fade out the loading animation
				jQuery('.loader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
				jQuery('body').delay(350).css({'overflow':'visible'});
		
				
				[].slice.call(document.querySelectorAll('img.tilt-effect')).forEach(function(img) {
					new TiltFx(img, JSON.parse(img.getAttribute('data-tilt-options')));
				});
						
				
				
				getWidthAndHeight();
				
				/* Page Scroll to id fn call */
				jQuery("a[href='#top'],.menu li a").mPageScroll2id({
					
				});
	
				
							
				//Main Slider			
				jQuery('.jx-ievent-main-slider .flexslider').flexslider({
					animation: "slide",
					controlNav: true,
					directionNav:true,
					slideshowSpeed:"8000",
					minItems: 1,
					maxItems: 1,
					prevText:'',
					nextText:''
				});
				
				//Main Slider RTL				
				jQuery('.jx-ievent-main-slider .flexslider.rtl').flexslider({
					animation: "slide",
					controlNav: true,
					directionNav:true,
					slideshowSpeed:"8000",
					minItems: 1,
					maxItems: 1,
					prevText:'',
					nextText:'',
					rtl: true
				});
				
				
				//Blog Slider			
				jQuery('.jx-ievent-blog-image.flexslider').flexslider({
					animation: "slide",
					controlNav: true,
					directionNav:true,
					slideshowSpeed:"8000",
					minItems: 1,
					maxItems: 1,
					prevText:'',
					nextText:''
				});
				
				//Blog RTL
				jQuery('.jx-ievent-blog-image.flexslider.rtl').flexslider({
					animation: "slide",
					controlNav: true,
					directionNav:true,
					slideshowSpeed:"8000",
					minItems: 1,
					maxItems: 1,
					prevText:'',
					nextText:'',
					rtl: true
				});
				
				
				
				//Testimonial #1
				jQuery('.jx-ievent-protfolio.jx-ievent-flexslider').flexslider({
					animation: "slide",
					controlNav: true,
					directionNav:true,
					slideshowSpeed:"8000",
					manualControls: ".flex-custom-control-nav li"
				});		
				
				//RTL
				jQuery('.jx-ievent-protfolio.jx-ievent-flexslider.rtl').flexslider({
					animation: "slide",
					controlNav: true,
					directionNav:true,
					slideshowSpeed:"8000",
					manualControls: ".flex-custom-control-nav li",
					rtl: true
				});		
								
				
				//Partners Logo			
				jQuery('.jx-ievent-sponsor.flexslider').flexslider({
					animation: "slide",
					controlNav: true,
					directionNav:false,
					slideshowSpeed:"8000",
					itemWidth: 191,
					minItems: 2,
					maxItems: 5,
					prevText:'',
					nextText:''
					
				});
				
				//RTL
				jQuery('.jx-ievent-sponsor.flexslider.rtl').flexslider({
					animation: "slide",
					controlNav: true,
					directionNav:false,
					slideshowSpeed:"8000",
					itemWidth: 191,
					minItems: 2,
					maxItems: 5,
					prevText:'',
					nextText:'',
					rtl: true
					
				});
				
							
				//Testimonial #1
				jQuery('.jx-ievent-testimonial .flexslider').flexslider({
					animation: "slide",
					controlNav: true,
					directionNav:false,
					slideshowSpeed:"8000",
					prevText:'',
					nextText:''
				});	
				
				//RTL
				jQuery('.jx-ievent-testimonial .flexslider.rtl').flexslider({
					animation: "slide",
					controlNav: true,
					directionNav:false,
					slideshowSpeed:"8000",
					prevText:'',
					nextText:'',
					rtl: true
				});
				
				
				if (jQuery(window).height() < 800){
					jQuery('.jx-ievent-parallax-fullwidth').css({'height':'100%'});	
					jQuery('.jx-ievent-parallax-fullwidth .slides > li').css({'height':'100%'});   	
				}else{					
					jQuery('.jx-ievent-parallax-fullwidth').css({'height':((jQuery(window).height()))+'px'});
					 jQuery('.jx-ievent-parallax-fullwidth .slides > li').css({'height':((jQuery(window).height()))+'px'});
				}
				
				
				getWidthAndHeight();
				
				function getWidthAndHeight (){
					var winWidth = jQuery(window).width();
					var winHeight = jQuery(window).height();
					jQuery('.jx-ievent-middle').css({'height': winHeight});
					
					jQuery('.jx-ievent-middle').each(function(){	
						  var $pa = jQuery(this);
						  var $ch = $pa.find('.jx-ievent-counting-down');
						  var paH = $pa.innerHeight();
						  var chH = $ch.innerHeight();
						
						  $ch.css({marginTop: (paH-chH)/2});
						
						});
				}
							
				});
				
				jQuery(window).resize(function(){ // On resize
					
					if (jQuery(window).height() < 670){
						jQuery('.jx-ievent-parallax-fullwidth').css({'height':'100%'});		
					}else{					
						jQuery('.jx-ievent-parallax-fullwidth').css({'height':((jQuery(window).height()))+'px'});
					}
					
					getWidthAndHeight();
					
					function getWidthAndHeight (){
					var winWidth = jQuery(window).width();
					var winHeight = jQuery(window).height();
					jQuery('.jx-ievent-middle').css({'height': winHeight});
					
					jQuery('.jx-ievent-middle').each(function(){	
						  var $pa = jQuery(this);
						  var $ch = $pa.find('.jx-ievent-counting-down');
						  var paH = $pa.innerHeight();
						  var chH = $ch.innerHeight();
						
						  $ch.css({marginTop: (paH-chH)/2});
						
						});
					}
					
					
					
								
				});					
			
		},

		stickyMenu: function() {
			//Menu
			 var s = jQuery(".jx-ievent-sticky");
    		 var pos = s.position();  
			 var top = s.css('top');

			 //Page Header
			 var nav_height = s.height();
			 
			 jQuery(window).on("scroll",function() {

				var scroll = getCurrentScroll();
					
				
				if ((s.length >0)){	
				
					if ( scroll >= pos.top+1){
						s.addClass('fixed');						
						
					}else{
						s.removeClass('fixed');
						
					}
				  
				 }
				 
				
			});
			
		
			function getCurrentScroll() {
				return window.pageYOffset || document.documentElement.scrollTop;
			}
			
		},
		
		animation:function(){

			// Animation Appear
			jQuery("[data-appear-animation]").each(function() {

				var $this = $(this);

				$this.addClass("appear-animation");

				if(!$("html").hasClass("no-csstransitions") && $(window).width() > 767) {

					$this.appear(function() {

						var delay = ($this.attr("data-appear-animation-delay") ? $this.attr("data-appear-animation-delay") : 1);

						if(delay > 1) $this.css("animation-delay", delay + "ms");
						$this.addClass($this.attr("data-appear-animation"));

						setTimeout(function() {
							$this.addClass("appear-animation-visible");
						}, delay);

					}, {accX: 0, accY: -150});

				} else {

					$this.addClass("appear-animation-visible");

				}

			});
			
			
			//Sill Bar
			// Animation Progress Bars
			jQuery("[data-progress-animate]").each(function() {

				var $this = jQuery(this);

				$this.appear(function() {

					var delay = ($this.attr("data-appear-animation-delay") ? $this.attr("data-appear-animation-delay") : 1);

					if(delay > 1) $this.css("animation-delay", delay + "ms");
					$this.addClass($this.attr("data-appear-animation"));

					setTimeout(function() {

						$this.animate(
						{
							width: $this.attr("data-progress-animate")
						}, 1500, "easeOutQuad", function() {
							$this.find(".percenttext").animate({opacity: 1,left:$this.attr("data-progress-animate")}, 500, "easeOutQuad");
						});

					}, delay);

				}, {accX: 0, accY: -50});

			});
			
			
			//circle Progressbar			
			jQuery('.circliful').appear();
			
		},

		
		scrollTop: function(){
		
			jQuery.scrollUp({
						scrollName: 'scrollUp', // Element ID
						scrollDistance: 300, // Distance from top/bottom before showing element (px)
						scrollFrom: 'top', // 'top' or 'bottom'
						scrollSpeed: 300, // Speed back to top (ms)
						easingType: 'linear', // Scroll to top easing (see http://easings.net/)
						animation: 'fade', // Fade, slide, none
						animationInSpeed: 200, // Animation in speed (ms)
						animationOutSpeed: 200, // Animation out speed (ms)
						scrollTitle: false, // Set a custom <a> title if required. Defaults to scrollText
						scrollImg: false, // Set true to use image
						activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
						zIndex: 2147483647 // Z-Index for the overlay
					});
					
			jQuery(function($){
				jQuery('.destroy').on("click",function($){
					$.scrollUp.destroy();
				})
			});			
			
		},

		wordAnimate: function(){
		//set animation timing
			var animationDelay = 2500,
				//loading bar effect
				barAnimationDelay = 3800,
				barWaiting = barAnimationDelay - 3000, //3000 is the duration of the transition on the loading bar - set in the scss/css file
				//letters effect
				lettersDelay = 50,
				//type effect
				typeLettersDelay = 150,
				selectionDuration = 500,
				typeAnimationDelay = selectionDuration + 800,
				//clip effect 
				revealDuration = 600,
				revealAnimationDelay = 1500;
			
			initHeadline();
			
		
			function initHeadline() {
				//insert <i> element for each letter of a changing word
				singleLetters(jQuery('.jx-ievent-headline.letters').find('b'));
				//initialise headline animation
				animateHeadline(jQuery('.jx-ievent-headline'));
			}
		
			function singleLetters($words) {
				$words.each(function(){
					var word = $(this),
						letters = word.text().split(''),
						selected = word.hasClass('is-visible');
					for (i in letters) {
						if(word.parents('.rotate-2').length > 0) letters[i] = '<em>' + letters[i] + '</em>';
						letters[i] = (selected) ? '<i class="in">' + letters[i] + '</i>': '<i>' + letters[i] + '</i>';
					}
					var newLetters = letters.join('');
					word.html(newLetters).css('opacity', 1);
				});
			}
		
			function animateHeadline($headlines) {
				var duration = animationDelay;
				$headlines.each(function(){
					var headline = jQuery(this);
					
					if(headline.hasClass('loading-bar')) {
						duration = barAnimationDelay;
						setTimeout(function(){ headline.find('.jx-ievent-words-wrapper').addClass('is-loading') }, barWaiting);
					} else if (headline.hasClass('clip')){
						var spanWrapper = headline.find('.jx-ievent-words-wrapper'),
							newWidth = spanWrapper.width() + 10
						spanWrapper.css('width', newWidth);
					} else if (!headline.hasClass('type') ) {
						//assign to .jx-ievent-words-wrapper the width of its longest word
						var words = headline.find('.jx-ievent-words-wrapper b'),
							width = 0;
						words.each(function(){
							var wordWidth = jQuery(this).width();
							if (wordWidth > width) width = wordWidth;
						});
						headline.find('.jx-ievent-words-wrapper').css('width', width);
					};
		
					//trigger animation
					setTimeout(function(){ hideWord( headline.find('.is-visible').eq(0) ) }, duration);
				});
			}
		
			function hideWord($word) {
				var nextWord = takeNext($word);
				
				if($word.parents('.jx-ievent-headline').hasClass('type')) {
					var parentSpan = $word.parent('.jx-ievent-words-wrapper');
					parentSpan.addClass('selected').removeClass('waiting');	
					setTimeout(function(){ 
						parentSpan.removeClass('selected'); 
						$word.removeClass('is-visible').addClass('is-hidden').children('i').removeClass('in').addClass('out');
					}, selectionDuration);
					setTimeout(function(){ showWord(nextWord, typeLettersDelay) }, typeAnimationDelay);
				
				} else if($word.parents('.jx-ievent-headline').hasClass('letters')) {
					var bool = ($word.children('i').length >= nextWord.children('i').length) ? true : false;
					hideLetter($word.find('i').eq(0), $word, bool, lettersDelay);
					showLetter(nextWord.find('i').eq(0), nextWord, bool, lettersDelay);
		
				}  else if($word.parents('.jx-ievent-headline').hasClass('clip')) {
					$word.parents('.jx-ievent-words-wrapper').animate({ width : '2px' }, revealDuration, function(){
						switchWord($word, nextWord);
						showWord(nextWord);
					});
		
				} else if ($word.parents('.jx-ievent-headline').hasClass('loading-bar')){
					$word.parents('.jx-ievent-words-wrapper').removeClass('is-loading');
					switchWord($word, nextWord);
					setTimeout(function(){ hideWord(nextWord) }, barAnimationDelay);
					setTimeout(function(){ $word.parents('.jx-ievent-words-wrapper').addClass('is-loading') }, barWaiting);
		
				} else {
					switchWord($word, nextWord);
					setTimeout(function(){ hideWord(nextWord) }, animationDelay);
				}
			}
		
			function showWord($word, $duration) {
				if($word.parents('.jx-ievent-headline').hasClass('type')) {
					showLetter($word.find('i').eq(0), $word, false, $duration);
					$word.addClass('is-visible').removeClass('is-hidden');
		
				}  else if($word.parents('.jx-ievent-headline').hasClass('clip')) {
					$word.parents('.jx-ievent-words-wrapper').animate({ 'width' : $word.width() + 10 }, revealDuration, function(){ 
						setTimeout(function(){ hideWord($word) }, revealAnimationDelay); 
					});
				}
			}
		
			function hideLetter($letter, $word, $bool, $duration) {
				$letter.removeClass('in').addClass('out');
				
				if(!$letter.is(':last-child')) {
					setTimeout(function(){ hideLetter($letter.next(), $word, $bool, $duration); }, $duration);  
				} else if($bool) { 
					setTimeout(function(){ hideWord(takeNext($word)) }, animationDelay);
				}
		
				if($letter.is(':last-child') && $('html').hasClass('no-csstransitions')) {
					var nextWord = takeNext($word);
					switchWord($word, nextWord);
				} 
			}
		
			function showLetter($letter, $word, $bool, $duration) {
				$letter.addClass('in').removeClass('out');
				
				if(!$letter.is(':last-child')) { 
					setTimeout(function(){ showLetter($letter.next(), $word, $bool, $duration); }, $duration); 
				} else { 
					if($word.parents('.jx-ievent-headline').hasClass('type')) { setTimeout(function(){ $word.parents('.jx-ievent-words-wrapper').addClass('waiting'); }, 200);}
					if(!$bool) { setTimeout(function(){ hideWord($word) }, animationDelay) }
				}
			}
		
			function takeNext($word) {
				return (!$word.is(':last-child')) ? $word.next() : $word.parent().children().eq(0);
			}
		
			function takePrev($word) {
				return (!$word.is(':first-child')) ? $word.prev() : $word.parent().children().last();
			}
		
			function switchWord($oldWord, $newWord) {
				$oldWord.removeClass('is-visible').addClass('is-hidden');
				$newWord.removeClass('is-hidden').addClass('is-visible');
			}	
		},
		
		toggle: function(){		
			
				
			jQuery('.jx-ievent-accordion-box [data-accordion]').accordion({
			  singleOpen: false
			});
			
			jQuery('.jx-accordion [data-accordion]').accordion({
			  singleOpen: true
			});
			
			jQuery('.jx-accordion-open [data-accordion]').accordion({
			  singleOpen: false
			});
			
			
		},
		tabs:function(){

			
		 jQuery('#ParentTab').easyResponsiveTabs({ 
			type: 'horizontal', //Types: default, vertical, accordion 
			width: 'auto', //auto or any width like 600px 
			fit: true, // 100% fit in a container 
			closed: 'accordion', // Start closed if in accordion view 
			tabidentify: 'parenttab_1'
						 
		 }); 
		 
		 jQuery('#ChildTab-1').easyResponsiveTabs({ 
			type: 'horizontal', //Types: default, vertical, accordion 
			width: 'auto', //auto or any width like 600px 
			fit: true, // 100% fit in a container 
			tabidentify: 'childtab_1'
			 
		 }); 
		 
		 jQuery('#ChildTab-2').easyResponsiveTabs({ 
			type: 'horizontal', //Types: default, vertical, accordion 
			width: 'auto', //auto or any width like 600px 
			fit: true, // 100% fit in a container 
			tabidentify: 'childtab_1'
			 
		 }); 
		  
		 jQuery('#ChildTab-3').easyResponsiveTabs({ 
			type: 'horizontal', //Types: default, vertical, accordion 
			width: 'auto', //auto or any width like 600px 
			fit: true, // 100% fit in a container 
			tabidentify: 'childtab_1'
			 
		 }); 
		 
		 jQuery('#ChildTab-4').easyResponsiveTabs({ 
			type: 'horizontal', //Types: default, vertical, accordion 
			width: 'auto', //auto or any width like 600px 
			fit: true, // 100% fit in a container 
			tabidentify: 'childtab_1'
			 
		 }); 
		 
		 jQuery('#ChildTab-5').easyResponsiveTabs({ 
			type: 'horizontal', //Types: default, vertical, accordion 
			width: 'auto', //auto or any width like 600px 
			fit: true, // 100% fit in a container 
			tabidentify: 'childtab_1'
			 
		 }); 
		   
		 
		
		},	
		prettyPhoto: function(){
			
		var prettyPhoto_parameters = {
					animation_speed: 'fast',
					slideshow: true, /* false OR interval time in ms */
					theme:'facebook',
					opacity: 1,
					show_title:true, /* true/false */
					allow_resize: true, /* Resize the photos bigger than viewport. true/false */
					default_width: 920,
					default_height: 540,
				    counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
					hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
					wmode: 'opaque', /* Set the flash wmode attribute */
					autoplay: true, /* Automatically start videos: True/False */
					modal: false, /* If set to true, only the close button will close the window */
					overlay_gallery: true
				};	
				
			if (jQuery(window).width() >= 768) { 

			jQuery('a[href$=jpg], a[href$=JPG], a[href$=jpeg], a[href$=JPEG], a[href$=png], a[href$=gif], a[href$=bmp]:has(img),a[class^="prettyPhoto"],a[data-rel^="prettyPhoto"]').prettyPhoto(prettyPhoto_parameters);				
			jQuery('a[class^="prettyPhoto"],a[data-rel^="prettyPhoto"]').prettyPhoto(prettyPhoto_parameters); 	
			}
		},
		
		parallax: function(){
		
		jQuery('.parallax,.jx-ievent-page-header-parallax').scrolly({bgParallax: true});
			
		},
		
		isotope: function(){
		
			jQuery(window).on("load",function(){
			
			// FAQ Page
			var $container = jQuery('.jx-ievent-portfolio-grid');		
			var $item = $container.find('.grid-item').not('.item-w2').eq(0);
			
			$container.isotope({
				itemSelector: '.grid-item',
				
			  });
		 
			jQuery('.jx-ievent-accordion-filter a').on("click",function(){
				jQuery('.jx-ievent-accordion-filter .current').removeClass('current');
				jQuery(this).addClass('current');
		 
				var selector = jQuery(this).attr('data-filter');
				$container.isotope({
					layoutMod: 'straightDown',
					itemSelector: '.jx-ievent-accordion-item',
					filter: selector,
					animationOptions: {
						duration: 750,
						easing: 'linear',
						queue: false
					}
				 });
				 return false;
			});			
			
			});	
			
			
		
		},
	
		counter: function(){
		
		jQuery(".jx-ievent-counter-up").counterUp({ 
                delay: 10, 
                time: 1000 
            }); 	
		
		},
	
		

		bouncy: function(){
			
		
			//switch from monthly to annual pricing tables
			bouncy_filter(jQuery('.jx-ievent-pricing-container'));
		
			function bouncy_filter(container) {
				container.each(function(){
					var pricing_table = jQuery(this);
					var filter_list_container = pricing_table.children('.jx-ievent-pricing-switcher'),
						filter_radios = filter_list_container.find('input[type="radio"]'),
						pricing_table_wrapper = pricing_table.find('.jx-ievent-pricing-wrapper');
		
					//store pricing table items
					var table_elements = {};
					filter_radios.each(function(){
						var filter_type = jQuery(this).val();
						table_elements[filter_type] = pricing_table_wrapper.find('li[data-type="'+filter_type+'"]');
					});
		
					//detect input change event
					filter_radios.on('change', function(event){
						event.preventDefault();
						//detect which radio input item was checked
						var selected_filter = jQuery(event.target).val();
		
						//give higher z-index to the pricing table items selected by the radio input
						show_selected_items(table_elements[selected_filter]);
		
						//rotate each jx-ievent-pricing-wrapper 
						//at the end of the animation hide the not-selected pricing tables and rotate back the .jx-ievent-pricing-wrapper
						
						if( !Modernizr.cssanimations ) {
							hide_not_selected_items(table_elements, selected_filter);
							pricing_table_wrapper.removeClass('is-switched');
						} else {
							pricing_table_wrapper.addClass('is-switched').eq(0).one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function() {		
								hide_not_selected_items(table_elements, selected_filter);
								pricing_table_wrapper.removeClass('is-switched');
								//change rotation direction if .jx-ievent-pricing-list has the .jx-ievent-bounce-invert class
								if(pricing_table.find('.jx-ievent-pricing-list').hasClass('jx-ievent-bounce-invert')) pricing_table_wrapper.toggleClass('reverse-animation');
							});
						}
					});
				});
			}
			function show_selected_items(selected_elements) {
				selected_elements.addClass('is-selected');
			}
		
			function hide_not_selected_items(table_containers, filter) {
				jQuery.each(table_containers, function(key, value){
					if ( key != filter ) {	
						jQuery(this).removeClass('is-visible is-selected').addClass('is-hidden');
		
					} else {
						jQuery(this).addClass('is-visible').removeClass('is-hidden is-selected');
					}
				});
			}	
		},
		
		themestyler: function(){
			
		var $b = jQuery('body'),
			$h = jQuery('head'),
			$w = jQuery(window);
		
		
		$b.append('<div style="left: 0px;" id="ievent-styleswitcher"> <div class="ievent-styleswitcher-body"> <div class="toggle-switchme"> <div class="ievent-styleswitcher-toogle"><i class="fa fa-gear fa-gear-animate"></i></div><div class="ievent-styleswitcher-head">Style Switcher</div></div><div class="ievent-styleswitcher-section"> <strong>Layout Style</strong> <select name="layout"> <option>Wide</option> <option>Boxed</option> </select> </div><div class="ievent-styleswitcher-section colors clearfix"> <strong>Color Versions</strong> <a href="#" title="Blue"> <div class="color_css" id="3ea7d7"style="background:#3ea7d7; width:20px; height:20px;"></div></a> <a href="#" title="Green Crayola"> <div class="color_css" id="1DA879"style="background:#1DA879; width:20px; height:20px;"></div></a> <a href="#" title="Red"> <div class="color_css" id="d80000"style="background:#d80000; width:20px; height:20px;"></div></a> <a href="#" title="Orange"> <div class="color_css" id="E5493A"style="background:#E5493A; width:20px; height:20px;"></div></a> <a href="#" title="Pink"> <div class="color_css" id="E22467"style="background:#E22467; width:20px; height:20px;"></div></a> <a href="#" title="Sun"> <div class="color_css" id="f5a823"style="background:#f5a823; width:20px; height:20px;"></div></a> <a href="#" title="GreenTea"> <div class="color_css" id="9dc032"style="background:#9dc032; width:20px; height:20px;"></div></a> <a href="#" title="Torquze"> <div class="color_css" id="32b4c0"style="background:#32b4c0; width:20px; height:20px;"></div></a> </div><div class="ievent-styleswitcher-section patterns clearfix"> <strong>Patterns for Boxed Version</strong> <a href="#" title="bg1"> <div class="bg2"></div></a> <a href="#" title="bg2"> <div class="bg17"></div></a> <a href="#" title="bg3"> <div class="bg3"></div></a> <a href="#" title="bg4"> <div class="bg4"></div></a> <a href="#" title="bg5"> <div class="bg5"></div></a> <a href="#" title="bg6"> <div class="bg6"></div></a> <a href="#" title="bg7"> <div class="bg7"></div></a> <a href="#" title="bg8"> <div class="bg8"></div></a> <a href="#" title="bg9"> <div class="bg9"></div></a> <a href="#" title="bg10"> <div class="bg10"></div></a> <a href="#" title="bg11"> <div class="bg11"></div></a> <a href="#" title="bg12"> <div class="bg12"></div></a> <a href="#" title="bg13"> <div class="bg13"></div></a> <a href="#" title="bg14"> <div class="bg14"></div></a> <a href="#" title="bg15"> <div class="bg15"></div></a> </div><div class="ievent-styleswitcher-section patterns clearfix"> <strong>Images for Boxed Version</strong> <a href="#" title="bg_demo1" class="fullimage"> <div class="bg_demo1_thumb"></div></a> <a href="#" title="bg_demo2" class="fullimage"> <div class="bg_demo2_thumb"></div></a> <a href="#" title="bg_demo3" class="fullimage"> <div class="bg_demo3_thumb"></div></a> <a href="#" title="bg_demo4" class="fullimage"> <div class="bg_demo4_thumb"></div></a> <a href="#" title="bg_demo5" class="fullimage"> <div class="bg_demo5_thumb"></div></a> <a href="#" title="bg_demo6" class="fullimage"> <div class="bg_demo6_thumb"></div></a> <a href="#" title="bg_demo7" class="fullimage"> <div class="bg_demo7_thumb"></div></a> <a href="#" title="bg_demo8" class="fullimage"> <div class="bg_demo8_thumb"></div></a> <a href="#" title="bg_demo9" class="fullimage"> <div class="bg_demo9_thumb"></div></a> </div><div class="ievent-styleswitcher-section reset clearfix last"> <strong>Reset Options</strong> <div class="jx-btn jx-btn-reset">Reset</div></div></div></div>');
		
		
		$h.append('<style type="text/css">.bg0,.bg10,.bg11,.bg12,.bg13,.bg14,.bg15,.bg16,.bg17,.bg18,.bg2,.bg3,.bg4,.bg5,.bg6,.bg7,.bg8,.bg9,.bg_demo1_thumb,.bg_demo2_thumb,.bg_demo3_thumb,.bg_demo4_thumb,.bg_demo5_thumb,.bg_demo6_thumb,.bg_demo7_thumb,.bg_demo8_thumb,.bg_demo9_thumb{background:url(http://janxcode.com/ievent/images/background_setting_sprite.png) no-repeat}.bg4{background-position:-51px 0;width:19px;height:19px;border:1px solid #999}.bg0{background-position:0 0;width:19px;height:19px;border:1px solid #999}.bg2{background-position:-95px -1px;width:19px;height:19px;border:1px solid #999}.bg3{background-position:-145px 0;width:19px;height:19px;border:1px solid #999}.bg5{background-position:-196px 0;width:19px;height:19px;border:1px solid #999}.bg6{background-position:-250px -1px;width:19px;height:19px;border:1px solid #999}.bg7{background-position:-299px 0;width:19px;height:19px;border:1px solid #999}.bg8{background-position:-345px -1px;width:19px;height:19px;border:1px solid #999}.bg12{background-position:-394px -3px;width:19px;height:19px;border:1px solid #999}.bg9{background-position:-447px -1px;width:19px;height:19px;border:1px solid #999}.bg10{background-position:-498px 0;width:19px;height:19px;border:1px solid #999}.bg11{background-position:-550px -3px;width:19px;height:19px;border:1px solid #999}.bg13{background-position:-602px -3px;width:19px;height:19px;border:1px solid #999}.bg14{background-position:-2px -50px;width:19px;height:19px;border:1px solid #999}.bg15{background-position:-48px -50px;width:19px;height:19px;border:1px solid #999}.bg16{background-position:-95px -50px;width:19px;height:19px;border:1px solid #999}.bg18{background-position:-146px -51px;width:19px;height:19px;border:1px solid #999}.bg17{background-position:-198px -53px;width:19px;height:19px;border:1px solid #999}.bg_demo9_thumb{background-position:-1px -102px;width:19px;height:19px;border:1px solid #999}.bg_demo1_thumb{background-position:-599px -53px;width:19px;height:19px;border:1px solid #999}.bg_demo2_thumb{background-position:-548px -55px;width:19px;height:19px;border:1px solid #999}.bg_demo3_thumb{background-position:-500px -52px;width:19px;height:19px;border:1px solid #999}.bg_demo4_thumb{background-position:-451px -55px;width:19px;height:19px;border:1px solid #999}.bg_demo5_thumb{background-position:-402px -52px;width:19px;height:19px;border:1px solid #999}.bg_demo6_thumb{background-position:-352px -50px;width:19px;height:19px;border:1px solid #999}.bg_demo7_thumb{background-position:-301px -50px;width:19px;height:19px;border:1px solid #999}.bg_demo8_thumb{background-position:-252px -51px;width:19px;height:19px;border:1px solid #999}#loginform p{margin:10px 0 0;padding:0}.login_new_registration{margin-top:-45px;text-align:right}.login_new_registration a:hover{color:#CCC}#ievent-styleswitcher{position:fixed;z-index:99999;top:120px;left:-240px!important;width:240px}.ievent-styleswitcher-toogle{float:right;background: #EE163A;;width:52px;height:52px;margin-right:-50px;border-radius:0 5px 5px 0;padding-top:11px;font-size:23px;color:#fff;cursor:pointer;-webkit-box-shadow:0 0 5px 0 rgba(0,0,0,.2);box-shadow:0 0 5px 0 rgba(0,0,0,.2);text-align:center}.ievent-styleswitcher-head{background:#333;color:#fff;padding:18px 20px;margin-right:0;font-size:18px;font-weight:700;cursor:pointer;position:relative;z-index:1;height:52px}.ievent-styleswitcher-body{background: rgba(0,0,0,0.95);-webkit-border-radius:0 0 3px;border-radius:0 0 3px;color:#fff;-webkit-box-shadow:0 0 5px 0 rgba(0,0,0,.2);box-shadow:0 0 5px 0 rgba(0,0,0,.2);position:relative;z-index:0}.ievent-styleswitcher-section{padding:10px 25px 20px;border-bottom:1px dashed #666;margin-bottom:5px}.ievent-styleswitcher-section.last{border:none;color:#333}.ievent-styleswitcher-section select{background:#555;color:#fff;margin:0;padding:6px;height: 30px;}.ievent-styleswitcher-section a{float:left;margin:10px 5px 0}.ievent-styleswitcher-section a img{display:block;width:20px;height:20px;border:2px solid #999}.ievent-styleswitcher-body strong{display:block;margin-bottom:10px;color:#f9f9f9}.previewoptions{color:#ccc;font-size:11px;line-height:19px}.ievent-styleswitcher-section .color_css{padding:5px;border:2px solid #999;width:37px!important;height:37px!important}@media only screen and (max-width:767px){#ievent-styleswitcher{display:none}}@media only screen and (max-width:1000px){#boxed-layout #header,#boxed-layout #header-v2 #navigation,#boxed-layout #header-v3,#boxed-layout #header-v4 #navigation,#boxed-layout #header-v5 #navigation,#boxed-layout #header-v6{width:100%!important}}.fa-gear-animate{animation:rotation 2s infinite steps(30);-webkit-animation:rotation 2s infinite steps(30);-moz-animation:rotation 2s infinite steps(30)}@keyframes rotation{0%{transform:rotate(0)}100%{transform:rotate(360deg)}}@-webkit-keyframes rotation{0%{-webkit-transform:rotate(0)}100%{-webkit-transform:rotate(360deg)}}@-moz-keyframes rotation{0%{-moz-transform:rotate(0)}100%{-moz-transform:rotate(360deg)}}.jx-btn a{width:100%;padding: 10px 15px;background: #333 none repeat scroll 0% 0%;text-align: center;color: #FFF !important;}.jx-btn-reset{background:#333;padding:10px;width:100%;display: block;text-align: center;cursor: pointer;color:#fff;}</style>');
		
	if(jQuery.cookie("css")) {
		jQuery("#skin-css").attr("href",jQuery.cookie("css"));
	}
	
	if(jQuery.cookie("body-layout")) {
		if(jQuery.cookie("body-layout") == 'boxed') {
			$b.addClass('boxed');			
			$b.css('background', 'url(http://ievent.janxcode.com/wp-content/themes/ievent/images/bg/bg12.png) repeat fixed center center transparent');
			$b.css('background-size', 'auto');
			$w.resize();
			
		}else if(jQuery.cookie("body-layout") == 'Wide') {
			$b.removeClass('boxed');
			$w.resize();			
		}
		
	}
			
	var i=0;
	jQuery('#ievent-styleswitcher .toggle-switchme').click(function(){	
	if (i==0){ 
		jQuery(this).parent().animate({'left' : '240px'}, 300, 'easeOutExpo');
		i=1;
	}else{
		jQuery(this).parent().animate({'left' : '0px'}, 300, 'easeOutExpo');
		i=0;		
	}
	});
	
	jQuery('#ievent-styleswitcher select[name=layout]').change(function() {
		var current = jQuery(this).find('option:selected').val();
		

		if(current == 'Boxed') {
			$b.addClass('boxed');			
			$b.css('background', 'url(http://ievent.janxcode.com/wp-content/themes/ievent/images/bg/bg12.png) repeat fixed center center transparent');
			$b.css('background-size', 'auto');
			$w.resize();
			jQuery.cookie("body-layout","boxed", {expires: 365, path: '/'});
			
		}else if(current == 'Wide') {
			$b.removeClass('boxed');
			jQuery.cookie("body-layout","wide", {expires: 365, path: '/'});			
			$w.resize();			
		}

	});
	
	
		
	jQuery('.patterns a').click(function() {
		var current = jQuery('#ievent-styleswitcher select[name=layout]').find('option:selected').val();

		if(current == 'Boxed') {
			
			var pattern = jQuery(this).attr('title');
			
			if(jQuery(this).hasClass('fullimage')) {
				$b.css('background', 'url(http://ievent.janxcode.com/wp-content/themes/ievent/images/bg-image/'+pattern+'.jpg) no-repeat center center fixed');
				$b.css('background-size', 'cover');
			} else {
				$b.css('background', 'url(http://ievent.janxcode.com/wp-content/themes/ievent/images/bg/'+pattern+'.png) repeat center center fixed');
				$b.css('background-size', 'auto');
			}
		}else {
		alert('Please select Boxed Layout');
		}
	});

	//Color Skin Switcher
	
	jQuery('.color_css').click(function(e) {
	
	var color = jQuery(this).attr('id');
      
	  if (color == "3ea7d7") {
      var skin_link="http://ievent.janxcode.com/wp-content/themes/ievent/css/skins/blue.css";
	  jQuery('#skin-css').attr('href', skin_link);
      $b.css('background-color',color);
	  jQuery.cookie("css",skin_link, {expires: 365, path: '/'});
	  return false;   
	  }
	  
	  if (color == "1DA879") {
      var skin_link="http://ievent.janxcode.com/wp-content/themes/ievent/css/skins/green.css";
	  jQuery('#skin-css').attr('href', skin_link);
      $b.css('background-color',color);
	  jQuery.cookie("css",skin_link, {expires: 365, path: '/'});
	  return false;      
	  }
	  
	  if (color == "d80000") {
      var skin_link="http://ievent.janxcode.com/wp-content/themes/ievent/css/skins/red.css";
	  jQuery('#skin-css').attr('href', skin_link);
      $b.css('background-color',color);
	  jQuery.cookie("css",skin_link, {expires: 365, path: '/'});
	  return false;      
	  }
	  
	  if (color == "E5493A") {
      var skin_link="http://ievent.janxcode.com/wp-content/themes/ievent/css/skins/orange.css";
	  jQuery('#skin-css').attr('href', skin_link);
      $b.css('background-color',color);
	  jQuery.cookie("css",skin_link, {expires: 365, path: '/'});
	  return false;      
	  }
	  
	  if (color == "E22467") {
      var skin_link="http://ievent.janxcode.com/wp-content/themes/ievent/css/skins/pink.css";
	  jQuery('#skin-css').attr('href', skin_link);
      $b.css('background-color',color);
	  jQuery.cookie("css",skin_link, {expires: 365, path: '/'});
	  return false;    
	  }
	  
	  if (color == "f5a823") {
      var skin_link="http://ievent.janxcode.com/wp-content/themes/ievent/css/skins/sun.css";
	  jQuery('#skin-css').attr('href', skin_link);
      $b.css('background-color',color);
	  jQuery.cookie("css",skin_link, {expires: 365, path: '/'});
	  return false;     
	  }
	  
	  if (color == "9dc032") {
      var skin_link="http://ievent.janxcode.com/wp-content/themes/ievent/css/skins/greentea.css";
	  jQuery('#skin-css').attr('href', skin_link);
      $b.css('background-color',color);
	  jQuery.cookie("css",skin_link, {expires: 365, path: '/'});
	  return false;   
	  }
	  
	  if (color == "32b4c0") {
      var skin_link="http://ievent.janxcode.com/wp-content/themes/ievent/css/skins/torquze.css";
	  jQuery('#skin-css').attr('href', skin_link);
      $b.css('background-color',color);
	  jQuery.cookie("css",skin_link, {expires: 365, path: '/'});
	  return false;    
	  }
	
	 }); 
	 
	 //reset
	jQuery('.jx-btn-reset').on('click',function() {		
		alert("Reset Done");
		jQuery.cookie("body-layout",'', {expires: 365, path: '/'});
		jQuery.cookie("css",'', {expires: 365, path: '/'});
		location.reload(true);
	});	 

		
		}		

	};

	Theme.initialize();

})();