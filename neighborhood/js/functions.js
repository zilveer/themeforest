/*global jQuery,google,G_vmlCanvasManager:false */

/* ==================================================

Custom jQuery functions.

================================================== */

// Use SF namespace for all swift framework functions
var SF = {};

(function(){
	
	// USE STRICT
	"use strict";
	
	/////////////////////////////////////////////
	// PAGE FUNCTIONS
	/////////////////////////////////////////////
	
	SF.page = {
		init: function () {
			
			jQuery.browser = {};
			jQuery.browser.mozilla = /mozilla/.test(navigator.userAgent.toLowerCase()) && !/webkit/.test(navigator.userAgent.toLowerCase());
			jQuery.browser.webkit = /webkit/.test(navigator.userAgent.toLowerCase());
			jQuery.browser.opera = /opera/.test(navigator.userAgent.toLowerCase());
			jQuery.browser.msie = /msie/.test(navigator.userAgent.toLowerCase());
			jQuery.browser.msieMobile10 = /iemobile\/10\.0/.test(navigator.userAgent.toLowerCase());
			
			if (SF.opts.agentID) {
				body.addClass("mobile-browser");
			} else {
				body.addClass("standard-browser");
			}
			
			if (jQuery.browser.msie && (parseInt(jQuery.browser.version, 10) <= 10)) {
				body.addClass("browser-ie");
			}
		
			if (jQuery.browser.mozilla) {
				body.addClass('browser-ff');
			}
			
			if (jQuery.browser.opera) {
				body.addClass("browser-opera");
			}
			
			if (body.hasClass("woocommerce-page") && !body.hasClass("woocommerce")) {
				body.addClass("woocommerce");
			}
			
			// MOVE MODALS TO BOTTOM OF PAGE
			SF.page.moveModals();
			
			// REFRESH MODAL IFRAME ON CLOSE (FOR VIDEOS)
			SF.page.modalClose();
									
			// FITVIDS
			jQuery('.portfolio-items:not(.carousel-items),.blog-items:not(.carousel-items),article.type-portfolio,article.type-post,article.type-team,.spb_video_widget,.infocus-item,.recent-posts,.full-width-detail').fitVids();
										
			// FOOTER BEAM ME UP LINK
			jQuery('.beam-me-up').on('click', 'a', function(e) {
				e.preventDefault();
				jQuery('body,html').animate({scrollTop: 0}, 800);
			});
		},
		moveModals: function() {
			jQuery(".modal").each(function(){
				jQuery(this).appendTo("body");
			});
		},
		modalClose: function() {
			jQuery(".modal-backdrop, .modal .close, .modal .btn").on("click", function() {
				jQuery(".modal iframe").each(function() {
					var thisModal = jQuery(this);
					thisModal.attr("src", thisModal.attr("src"));
				});
			});
		},
	};
	
	/////////////////////////////////////////////
	// SUPER SEARCH
	/////////////////////////////////////////////
		
	SF.superSearch = {
		init: function() {
			
			jQuery('.search-options .ss-dropdown').on('click', function(e) {
				e.preventDefault();
				
				var option = jQuery(this),
					dropdown = option.find( 'ul' );
				
				jQuery('.ss-dropdown ul').removeClass('show-dropdown');
					
				if (SF.opts.isMobileAlt) {
					if (dropdown.hasClass('show-dropdown')) {
						dropdown.removeClass('show-dropdown');
					} else {
						dropdown.addClass('show-dropdown');							
					}
				} else {
					if (dropdown.hasClass('show-dropdown')) {
						dropdown.css('top', 30).removeClass('show-dropdown');
					} else {
						dropdown.css('top', -10).addClass('show-dropdown');							
					}
				}
			});
						
			jQuery('.ss-option').on('click', function(e) {
				e.preventDefault();
				
				var thisOption = jQuery(this),
					selectedOption = thisOption.attr('data-attr_value'),
					parentOption = thisOption.parent().parent().parent();
								
				parentOption.find('li').removeClass('selected');
				thisOption.parent().addClass('selected');
				
				parentOption.attr('data-attr_value', selectedOption);
				parentOption.find('span').text(thisOption.text());
				
				setTimeout(function() {
					thisOption.parents('ul').first().css('top', 30).removeClass('show-dropdown');
				}, 100);
			});
			
			jQuery('.swift-search-link').on('click', function(e) {
				e.preventDefault();
				var superSearch = jQuery('#super-search');
				
				if (!superSearch.is(":visible")) {
					superSearch.slideDown(400);
				}
			});
			
			jQuery('.swift-search-link-alt').on('click', function(e) {
				e.preventDefault();
				var superSearch = jQuery('#super-search');
				
				if (!superSearch.is(":visible")) {
					jQuery('body,html').animate({scrollTop: 0}, 200);
					superSearch.slideDown(400);
				}
			});
			
			
			jQuery('.super-search-go').on('click', function(e) {
				e.preventDefault();
				var parentSearch = jQuery(this).parents('.sf-super-search').first(),
					filterURL = SF.superSearch.urlBuilder(parentSearch),
					homeURL = jQuery(this).attr('data-home_url'),
					shopURL = jQuery(this).attr('data-shop_url');
				
				if (filterURL.indexOf("product_cat") >= 0) {
				location.href = homeURL + filterURL;
				} else {
				location.href = shopURL + filterURL;
				}
				
			});
			
			jQuery('.super-search-close').on('click', function(e) {
				e.preventDefault();
				jQuery('#super-search').slideUp(300);
			});
		
		},
		urlBuilder: function(searchInstance) {
			
			var queryString = "";
			
			jQuery(searchInstance).find('.search-options .ss-dropdown').each(function() {
				
				var attr = jQuery(this).attr('id');
				var attrValue = jQuery(this).attr('data-attr_value');
				if (attrValue !== "") {
					if (attr === "product_cat") {
						if (queryString === "") {
							queryString += "?product_cat=" + attrValue;
						} else {
							queryString += "&product_cat=" + attrValue;
						}
					} else {
						if (queryString === "") {
						queryString += "?filter_" + attr + "=" + attrValue;				
						} else {
						queryString += "&filter_" + attr + "=" + attrValue;									
						}
					}
				}
			});
			
			jQuery('.search-options input').each(function() {
				var attr = jQuery(this).attr('name');
				var attrValue = jQuery(this).attr('value');
				if (queryString === "") {
					queryString += "?"+ attr + "=" + attrValue;				
				} else {
					queryString += "&" + attr + "=" + attrValue;									
				}
			});
			
			return queryString;
		}
	};
	
	
	/////////////////////////////////////////////
	// HEADER
	/////////////////////////////////////////////
	
	var navSearch = jQuery('#nav-search').find('input'),
		navSearchLink = jQuery('.nav-search-link'),		
		miniHeader = jQuery('#mini-header'),
		miniHeaderSearch = jQuery('#mini-search').find('input'),
		miniHeaderSearchLink = jQuery('.mini-search-link');
		
	SF.header = {
		init: function() {
			
			if (body.hasClass('header-overlay')) {
				SF.header.headerOverlaySet();
				$window.smartresize(function(){  
					SF.header.headerOverlaySet();
				});
			}
			
			
			SF.header.miniHeaderInit();
			
			navSearchLink.on('click', function(e) {
				if (jQuery('#container').width() > 979 || body.hasClass('responsive-fixed')) {
					e.preventDefault();
					navSearch.animate({
						opacity: 1,
						width: 140
					}, 200);
					navSearch.focus();
				}
			});
			
			navSearch.focus(function() {
				if (jQuery('#container').width() > 979 || body.hasClass('responsive-fixed')) {
					navSearch.css('display', 'inline-block').animate({
						opacity: 1,
						width: 140
					}, 200);
				}
			});
					
			navSearch.blur(function() {
				if (jQuery('#container').width() > 979 || body.hasClass('responsive-fixed')) {
					jQuery(this).animate({
						opacity: 0,
						width: 1
					}, 200);
					setTimeout(function() {
						navSearch.css('display', 'none');
					}, 300);
				}
			});
						
			miniHeaderSearchLink.on('click', function(e) {
				e.preventDefault();
				miniHeaderSearch.animate({
					opacity: 1,
					width: 140
				}, 200);
				miniHeaderSearch.focus();
			});
			
			miniHeaderSearch.focus(function() {
				jQuery(this).animate({
					opacity: 1,
					width: 140
				}, 200);
			});
					
			miniHeaderSearch.blur(function() {
				jQuery(this).animate({
					opacity: 0,
					width: 1
				}, 200);
			});
			
			jQuery(window).scroll(function() { 
				if ((jQuery(this).scrollTop() > 300) && !body.hasClass('has-mini-header')) {
					SF.header.miniHeaderShow();
				} else if ((jQuery(this).scrollTop() < 250) && body.hasClass('has-mini-header')) {
					SF.header.miniHeaderHide();
				}
			});
			
			jQuery('.mobile-search-link').on('click', function() {
				
				var isVisible = jQuery('.mobile-search-form').is(":visible");
				
				jQuery('.mobile-search-form').slideToggle();
				
				if (isVisible) {
					jQuery('.mobile-search-link').removeClass('active');
				} else {
					jQuery('.mobile-search-form input').focus();
					jQuery('.mobile-search-link').addClass('active');
				}
			});
							
		},
		miniHeaderInit: function() {
			miniHeader.find('a[title="home"]').html('<i class="fa-home"></i>');
		},
		miniHeaderShow: function() {
			body.addClass('has-mini-header');
			miniHeader.css('display', 'block');
			miniHeader.animate({
				"top": "0"
			}, 400);
		},
		miniHeaderHide: function() {
			body.removeClass('has-mini-header');
			miniHeader.animate({
				"top": "-80"
			}, 400);
			setTimeout(function() {
				miniHeader.css('display', 'none');
			}, 600);
		},
		headerOverlaySet: function() {
			var headerWrapHeight = jQuery('.header-wrap').height();
							
			if (jQuery('#main-container').find('#swift-slider').length === 0 && jQuery('#main-container').find('.home-slider-wrap').length === 0 && jQuery('#page-wrap').find('.page-heading').length === 0) {
				jQuery('.inner-page-wrap').animate({
					'padding-top': headerWrapHeight + 20
				}, 300);
			} else {
				jQuery('.page-heading').animate({
					'padding-top': headerWrapHeight + 25
				}, 300);
			}
		}
	};
	
	
	/////////////////////////////////////////////
	// NAVIGATION
	/////////////////////////////////////////////
	
	SF.nav = {
		init: function() {
			
			var lastAjaxSearchValue = "",
				searchTimer = false;
		
			// Add parent class to items with sub-menus
			jQuery("ul.sub-menu").parent().addClass('parent');
			
			// Menu parent click function
			jQuery('.menu li.parent > a').on('click', function(e) {
				
				if ((jQuery('#container').width() < 1024 && body.hasClass('mh-tabletland')) || (jQuery('#container').width() < 979 && !body.hasClass('mh-tabletland')) || body.hasClass('standard-browser')) {
					return e;
				}
				
				var directDropdown = jQuery(this).parent().find('ul.sub-menu').first();
				if (directDropdown.css('opacity') == 1) {
					return e;
				} else {
					e.preventDefault();
				}
			});
			
			// Enable hover dropdowns for window size above tablet width
			jQuery("nav").find(".menu li.parent").not(".no-hover").hoverIntent({
				over: function() {
					if ((jQuery('#container').width() > 1024 && body.hasClass('mh-tabletland')) || (jQuery('#container').width() > 979 && !body.hasClass('mh-tabletland')) || body.hasClass('responsive-fixed')) {
						jQuery(this).find('ul.sub-menu,.mega-menu-sub').first().fadeIn(200);
					}
				},
				out:function() {
					if ((jQuery('#container').width() > 1024 && body.hasClass('mh-tabletland')) || (jQuery('#container').width() > 979 && !body.hasClass('mh-tabletland')) || body.hasClass('responsive-fixed')) {
						jQuery(this).find('ul.sub-menu,.mega-menu-sub').first().fadeOut(150);
					}
				},
				timeout: 0
			});
			
			jQuery(document).on("mouseenter", ".shopping-bag-item", function() {	
				jQuery(this).find('ul.sub-menu').first().fadeIn(200);
			}).on("mouseleave", ".shopping-bag-item", function() {
				if ((jQuery('#container').width() > 1024 && body.hasClass('mh-tabletland')) || (jQuery('#container').width() > 979 && !body.hasClass('mh-tabletland')) || body.hasClass('responsive-fixed')) {
					jQuery(this).find('ul.sub-menu').first().fadeOut(150);
				}
			});
		
			// Toggle Mobile Nav show/hide			
			jQuery('a.show-main-nav').on('click', function(e) {
				e.preventDefault();
				if (jQuery('#main-navigation').is(':visible')) {
				jQuery('.header-overlay .header-wrap').css('position', '');
				} else {
				jQuery('.header-overlay .header-wrap').css('position', 'relative');
				}
				jQuery('#main-navigation').toggle();
			});
			
			$window.smartresize(function(){  
				if ((jQuery('#container').width() > 1024 && body.hasClass('mh-tabletland')) || (jQuery('#container').width() > 767 && !body.hasClass('mh-tabletland')) || body.hasClass('responsive-fixed')) {
					jQuery('#main-navigation').css('display', '');
					var menus = jQuery('nav').find('ul.menu');
					menus.each(function() {
						jQuery(this).css("display", "");
					});
				}
			});
			
			// Set current language to top bar item
			var currentLanguage = jQuery('li.aux-languages').find('.current-language').html();
			if (currentLanguage !== "") {
				jQuery('li.aux-languages > a').html(currentLanguage);
			}
			
			
			// AJAX SEARCH
			jQuery('li.menu-search a').on('click', function(e) {
				e.preventDefault();
				
				var subSearchMenu = jQuery(this).parent().find('.sub-menu'),
					menuContainer = jQuery(this).closest('nav');

				if (!subSearchMenu.hasClass('show-dropdown')) {
					subSearchMenu.addClass('show-dropdown');
					subSearchMenu.fadeIn(200);
					subSearchMenu.find('input').focus();
				} else {
					if ((jQuery('#container').width() > 1024 && body.hasClass('mh-tabletland')) || (jQuery('#container').width() > 979 && !body.hasClass('mh-tabletland')) || body.hasClass('responsive-fixed')) {
						subSearchMenu.removeClass('show-dropdown').fadeOut(150);
					}
				}
				
			});
			
			jQuery('.ajax-search-form input[name=s]').on('keyup', function(e) {
				var searchvalue = e.currentTarget.value;

				clearTimeout(searchTimer);								
	            if (lastAjaxSearchValue != jQuery.trim(searchvalue) && searchvalue.length >= 3) {
	                searchTimer = setTimeout( function() {
	                	SF.nav.ajaxSearch(e);
	                }, 400);
	            }
			});
			
			
			// Mobile Menu click handling
			jQuery('.menu-item').on('click', 'a', function(e) {
				
				if ((jQuery('#container').width() < 1024 && body.hasClass('mh-tabletland')) || (jQuery('#container').width() < 979 && !body.hasClass('mh-tabletland'))) {			
					var parentMenuItem = jQuery(this).parent(),
						linkHref = jQuery(this).attr('href'),
						subMenu = parentMenuItem.find('ul.sub-menu').first();
	
					if (!parentMenuItem.hasClass('parent')) {
						return e;
					}
	
					if (linkHref === "#" && parentMenuItem.hasClass('sub-menu-open')) {
						parentMenuItem.removeClass('sub-menu-open');
						subMenu.slideUp();
						e.preventDefault();
					} else if (parentMenuItem.hasClass('sub-menu-open')) {
						return e;
					} else {
						parentMenuItem.addClass('sub-menu-open');
						subMenu.slideDown();
						e.preventDefault();
					}
				} else {
					return e;
				}
				
			});
		},
		hideNav: function(subnav) {
			setTimeout(function() {
				if (subnav.css("opacity") === "0") {
					subnav.css("display", "none");
				}
			}, 300);
		},
		ajaxSearch: function(e) {			
			var searchInput = jQuery(e.currentTarget),
				searchValues = searchInput.parents('form').serialize() + '&action=sf_ajaxsearch',
				results = jQuery('.ajax-search-results'),
				loadingIndicator = jQuery('.ajax-search-wrap .ajax-loading');

			jQuery.ajax({
				url: ajaxurl,
				type: "POST",
				data: searchValues,
				beforeSend: function() {
					loadingIndicator.fadeIn(50);
				},
				success: function(response) {
				    if (response === 0) {
				    	response = "";
			        } else {
			        	results.html(response);
					}
				},
				complete: function() {
				    loadingIndicator.fadeOut(200);
				    results.slideDown(400);
				}
			});
		}
	};
	
	
	/////////////////////////////////////////////
	// WOOCOMMERCE FUNCTIONS
	/////////////////////////////////////////////
	
	SF.woocommerce = {
		init: function() {
			
			// QUANTITY FUNCTIONS
			SF.woocommerce.productQuantityAdjust();
			
			//Wishlist Reload
			jQuery(document).on('click', '.add_to_wishlist', function(){
				 
				var data = {action: 'sf_add_to_wishlist', product_id: jQuery(this).attr('data-product-id')};
							 	   			      
				jQuery(this).parent().parent().find('.yith-wcwl-wishlistaddedbrowse').show().removeClass("hide").addClass("show");
				jQuery(this).hide().addClass("hide").removeClass("show");
				
				jQuery.post(ajaxurl, data, function(response) {  
					var json = jQuery.parseJSON(response);
					jQuery('.wishlist-empty').remove();
					jQuery('.wishlist-item .bag-contents').prepend(json.whishlist_output);
				    jQuery('.wishlist-link span').first().text(parseInt(jQuery('.wishlist-link span').first().text())+1);
										
				});
											
			});
			
			//Wishlist Remove a Product
			jQuery(document).on('click', '.remove_from_wishlist', function(e){  
				e.preventDefault();
			});
			
			//Wishlist Remove a Product
			jQuery(document).on('click', '.wishlist_table .remove', function(){  
					alert("teste");
			       jQuery(".prod-"+jQuery(this).attr('data-product-id')).remove();
			       var wishcounter = parseInt(jQuery('.wishlist-link span').first().text())-1;
			       jQuery('.wishlist-link span').first().text(wishcounter);
			       if ( wishcounter === 0 ) {
				   		jQuery('.wishlist-item .bag-contents').prepend('<div class="wishlist-empty">Your wishlist is currently empty.</div>');
				   }		      	
			
			});
			
			jQuery('figcaption .ajax_add_to_cart').on('click', function() {
				var button = jQuery(this);
				var added_text = button.attr("data-added_text");
				button.addClass("product-added");
				button.text(added_text);
			});
			
			jQuery('.show-products-link').on('click', function(e) {
				e.preventDefault();
				var linkHref = jQuery(this).attr('href').replace('?', ''),
					currentURL = document.location.href.replace(/\/page\/\d+/, ''),
					currentQuery = document.location.search;
				
				if (currentQuery.indexOf('?show') >= 0) {				
					window.location = jQuery(this).attr('href');
				} else if (currentQuery.indexOf('?') >= 0) {
					window.location = currentURL + '&' + linkHref;
				} else {
					window.location = currentURL + '?' + linkHref;
				}
			});
						
			jQuery('ul.products li').hover(function() {
				var imageOverlay = jQuery(this).find('.image-overlay');
				imageOverlay.animate({
					top: jQuery(this).height()*-1
				}, 400);
			}, function() {
				var imageOverlay = jQuery(this).find('.image-overlay');
				imageOverlay.animate({
					top: 0
				}, 400);
			});
			
			if (jQuery.fn.imagesLoaded) {
				SF.woocommerce.productSetup();
				$window.smartresize(function(){  
					SF.woocommerce.productSetup();
				});
			}
			
	        jQuery('.shipping-calculator-form input').keypress(function(e) {
	            if(e.which == 10 || e.which == 13) {
	            	jQuery(".update-totals-button button").click();
	            }
	        });
	        
		},
		productSetup: function() {
			jQuery('ul.products').each(function() {
				
				var products = jQuery(this);
				
				products.imagesLoaded(function() {
					setTimeout(function() {
						var product = products.find('li.type-product').first();
						var productImageHeight = product.find('.product-image > img').height();
						if (jQuery('#container').width() <= 1024 && product.find('figure > figcaption').is(":visible")) {
							productImageHeight = productImageHeight + 20;
						}
						if (!productImageHeight || productImageHeight === 0) {
						productImageHeight = 270;
						}
						products.find('li.type-product').each(function() {
							jQuery(this).find('figure').css('padding-bottom', productImageHeight  + 'px');
						});
					}, 300);
				});
			});
		},
		variations: function() {
			jQuery('.single_variation_wrap').on("show_variation", function() {
				if (SF.opts.hasProductZoom) {
					setTimeout(function() {
						if (SF.productSlider) {
							jQuery('.product-slider-image').each(function() {
								jQuery(this).data('zoom-image', jQuery(this).parent().find('a.zoom').attr('href'));
							});
							var firstImage = jQuery('#product-img-slider li:first').find('.product-slider-image');
							SF.woocommerce.productZoom(firstImage);
							SF.productSlider.goToSlide(0);
						}
					}, 500);
				} else {
					setTimeout(function() {
						if (SF.productSlider) {
							SF.productSlider.goToSlide(0);
						}
					}, 500);
				}
				setTimeout(function() {
					// Update lightbox image
					jQuery('.product-slider-image').each(function() {
						var zoomImage = jQuery(this).attr('src');
						jQuery(this).parent().find('a.zoom').attr('href', zoomImage).attr('data-o_href', '').attr('data-o_href', zoomImage);
						jQuery('[data-rel="ilightbox[product]"]').removeClass('ilightbox-enabled').iLightBox().destroy();
						SF.lightbox.init();
					});
				}, 600);
			});
		},
		productZoom: function(zoomObject) {
			if ( SF.opts.isMobileAlt ) {
				return;
			}
			zoomObject.parent().zoom({
				duration: 400
			});
		},
		productQuantityAdjust: function() {

			// Increase
			jQuery(document).on('click', '.qty-plus', function(e) {
				e.preventDefault();
				var quantityInput = jQuery(this).parents('.quantity').find('input.qty'),
					newValue = parseInt(quantityInput.val(), 10) + 1,
					maxValue = parseInt(quantityInput.attr('max'), 10);
					
				if (!maxValue) {
					maxValue = 9999999999;
				}	
		
				if ( newValue <= maxValue ) {
					quantityInput.val(newValue);
					quantityInput.change();
				}
			});

			// Decrease
			jQuery(document).on('click', '.qty-minus', function(e) {
				e.preventDefault();
				var quantityInput = jQuery(this).parents('.quantity').find('input.qty'),
					newValue = parseInt(quantityInput.val(), 10) - 1,
					minValue = parseInt(quantityInput.attr('min'), 10);

				if (!minValue) {
					minValue = 1;
				}

				if ( newValue >= minValue ) {
					quantityInput.val(newValue);
					quantityInput.change();
				}
			});

		}
	};
	
	/////////////////////////////////////////////
	// FLEXSLIDER FUNCTION
	/////////////////////////////////////////////
	
	SF.flexSlider = {		
		init: function() {
			
			if(jQuery('.recent-posts').length > 0) {
				SF.flexSlider.thumb();
			}
					
			jQuery('.item-slider').flexslider({
				animation: "slide",              //String: Select your animation type, "fade" or "slide"
				slideDirection: "horizontal",   //String: Select the sliding direction, "horizontal" or "vertical"
				slideshow: true,	//Boolean: Animate slider automatically
				slideshowSpeed: 6000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
				animationDuration: 500,			//Integer: Set the speed of animations, in milliseconds
				smoothHeight: true,         
				directionNav: true,             //Boolean: Create navigation for previous/next navigation? (true/false)
				controlNav: true,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
				keyboardNav: false,              //Boolean: Allow slider navigating via keyboard left/right keys
				mousewheel: false,              //Boolean: Allow slider navigating via mousewheel
				prevText: "Prev",           //String: Set the text for the "previous" directionNav item
				nextText: "Next",               //String: Set the text for the "next" directionNav item
				pausePlay: true,               //Boolean: Create pause/play dynamic element
				pauseText: '',             //String: Set the text for the "pause" pausePlay item
				playText: '',               //String: Set the text for the "play" pausePlay item
				randomize: false,               //Boolean: Randomize slide order
				slideToStart: 0,                //Integer: The slide that the slider should start on. Array notation (0 = first slide)
				animationLoop: true,            //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
				pauseOnAction: true,            //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
				pauseOnHover: false,            //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
				controlsContainer: "",          //Selector: Declare which container the navigation elements should be appended too. Default container is the flexSlider element. Example use would be ".flexslider-container", "#container", etc. If the given element is not found, the default action will be taken.
				manualControls: "",             //Selector: Declare custom control navigation. Example would be ".flex-control-nav li" or "#tabs-nav li img", etc. The number of elements in your controlNav should match the number of slides/tabs.
				start: function(){},            //Callback: function(slider) - Fires when the slider loads the first slide
				before: function(){},           //Callback: function(slider) - Fires asynchronously with each slider animation
				after: function(){},            //Callback: function(slider) - Fires after each slider animation completes
				end: function(){}               //Callback: function(slider) - Fires when the slider reaches the last slide (asynchronous)
			});
			jQuery('#swift-slider').flexslider({
				animation: "slide",              //String: Select your animation type, "fade" or "slide"
				slideDirection: "horizontal",   //String: Select the sliding direction, "horizontal" or "vertical"
				slideshow: false,	//Boolean: Animate slider automatically
				slideshowSpeed: 8000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
				animationDuration: 600,         //Integer: Set the speed of animations, in milliseconds
				directionNav: true,             //Boolean: Create navigation for previous/next navigation? (true/false)
				controlNav: false,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
				keyboardNav: false,              //Boolean: Allow slider navigating via keyboard left/right keys
				mousewheel: false,              //Boolean: Allow slider navigating via mousewheel
				prevText: "Prev",           //String: Set the text for the "previous" directionNav item
				nextText: "Next",               //String: Set the text for the "next" directionNav item
				pausePlay: false,               //Boolean: Create pause/play dynamic element
				animationLoop: true,            //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
				pauseOnAction: true,            //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
				pauseOnHover: true,
				start: function(postsSlider) {
					jQuery('.swift-slider-loading').fadeOut(200);
					if (postsSlider.slides) {
						postsSlider.slides.eq(postsSlider.currentSlide).addClass('flex-active-slide'); 
						if (postsSlider.slides.eq(postsSlider.currentSlide).has('.flex-caption-large')) {
							var chart = postsSlider.slides.eq(postsSlider.currentSlide).find('.fw-chart');
							if (body.hasClass("browser-ie")) {
							chart = postsSlider.slides.eq(postsSlider.currentSlide).find('.chart');
							}
							chart.each( function() {
								var countValue = parseInt(jQuery(this).attr('data-count'), 10);
								jQuery(this).data('easyPieChart').update(80);
								jQuery(this).find('span').replaceWith("<span>0</span>");
								jQuery(this).find('span').animateNumber(countValue);
							});
						}
						postsSlider.slides.eq(postsSlider.currentSlide).find('.comment-chart:not(.fw-chart) span').replaceWith("<span>0</span>");
					}
				},
				before: function(postsSlider) {
					if (postsSlider.slides) {
						if (postsSlider.slides.eq(postsSlider.currentSlide).has('.flex-caption-large')) {
							var chart = postsSlider.slides.eq(postsSlider.currentSlide).find('.fw-chart');
							if (body.hasClass("browser-ie")) {
							chart = postsSlider.slides.eq(postsSlider.currentSlide).find('.chart');
							}
							chart.each( function() {
								jQuery(this).data('easyPieChart').update(0);
								jQuery(this).find('span').replaceWith("<span>0</span>");
							});
						}
						setTimeout( function() {
							postsSlider.slides.eq(postsSlider.currentSlide).addClass('flex-active-slide');
							if (postsSlider.slides.eq(postsSlider.currentSlide).has('.flex-caption-large')) {
								var chart = postsSlider.slides.eq(postsSlider.currentSlide).find('.fw-chart');
								if (body.hasClass("browser-ie")) {
								chart = postsSlider.slides.eq(postsSlider.currentSlide).find('.chart');
								}
								chart.each( function() {
									var countValue = parseInt(jQuery(this).attr('data-count'), 10);
									jQuery(this).data('easyPieChart').update(80);
									jQuery(this).find('span').animateNumber(countValue);
								});
							}
						}, 1000);
					}
				}
			});
			jQuery('.content-slider').each(function() {
				var sliderAnimation = jQuery(this).attr('data-animation');
				var autoplay = jQuery(this).attr('data-autoplay');
				autoplay = ((autoplay === "yes") ? true : false);
				
				jQuery(this).flexslider({
					animation: sliderAnimation,              //String: Select your animation type, "fade" or "slide"
					slideshow: autoplay,	//Boolean: Animate slider automatically
					slideshowSpeed: 6000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
					animationDuration: 1000,			//Integer: Set the speed of animations, in milliseconds
					smoothHeight: true,         
					directionNav: true,             //Boolean: Create navigation for previous/next navigation? (true/false)
					controlNav: false               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
				});
			});
						
			// LOAD THE LOVE-IT CHARTS
			jQuery('#swift-slider li').each( function() {
				jQuery(this).find('.chart').each( function() {
					jQuery(this).easyPieChart({
						animate: 1000,
						size: 70,
						barColor: jQuery(this).attr('data-barcolor'),
						trackColor: 'transparent',
						scaleColor: false
					});
					jQuery(this).find('span').replaceWith("<span>0</span>");
				});
			});
			
			// CAPTION HOVER ADD/REMOVE CLASSES
			jQuery('#swift-slider li').hover(function() {
				jQuery(this).find('.flex-caption-details').removeClass('closing');
				jQuery(this).find('.flex-caption-details').addClass('open');
			}, function() {
				jQuery(this).find('.flex-caption-details').addClass('closing');
				jQuery(this).find('.flex-caption-details').removeClass('open');
			});
						
			// CAPTION TRANSITION LISTENERS
			jQuery('.caption-details-inner').on('transitionend webkitTransitionEnd oTransitionEnd otransitionend MSTransitionEnd', function() {
				var chart = jQuery(this).find('.chart');
				if (jQuery(this).parent().hasClass('closing')) {
					chart.each( function() {
						jQuery(this).data('easyPieChart').update(0);
						jQuery(this).find('span').replaceWith("<span>0</span>");
					});
					jQuery(this).parent().removeClass('closing');
				} else if (jQuery(this).parent().hasClass('open')) {
					chart.each( function() {
						var countValue = parseInt(jQuery(this).attr('data-count'), 10);
						jQuery(this).data('easyPieChart').update(80);
						jQuery(this).find('span').animateNumber(countValue);
					});
				}
			});
			
		},
		thumb: function() {
			jQuery('.thumb-slider').flexslider({
				animation: "fade",              //String: Select your animation type, "fade" or "slide"
				slideDirection: "horizontal",   //String: Select the sliding direction, "horizontal" or "vertical"
				slideshow: true,	//Boolean: Animate slider automatically
				slideshowSpeed: 6000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
				animationDuration: 600,         //Integer: Set the speed of animations, in milliseconds
				directionNav: true,             //Boolean: Create navigation for previous/next navigation? (true/false)
				controlNav: false,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
				keyboardNav: false              //Boolean: Allow slider navigating via keyboard left/right keys
			});
		}
	};
	
	/////////////////////////////////////////////
	// LIGHTSLIDER FUNCTION
	/////////////////////////////////////////////
	
	SF.sliders = {		
		init: function() {
			
			if ( jQuery('#product-img-slider').length > 0 ) {
				SF.sliders.productSlider();
			}
			
		},
		productSlider: function() {
			var galleryMode = jQuery('#product-img-slider > ul > li').length > 1 ? true : false,
				galleryVertical = false,
				sliderVertHeight = parseInt(SF.opts.productSliderVertHeight, 10),
				thumbItems = 6;
			
			if ( SF.opts.productSliderThumbsPos === "left" ) {
				galleryVertical = true;
				thumbItems = 8;
			}

			SF.productSlider = jQuery('#product-img-slider > ul').lightSlider({
	            item: 1,
	            gallery: galleryMode,
	            autoWidth: false,
	            slideMargin: 0,
	            speed: 400, //ms'
	            auto: false,
	            loop: false,
	            vThumbWidth: 70,
	            vertical: galleryVertical,
	            verticalHeight: sliderVertHeight,
	            slideEndAnimation: true,
	            pause: 2000,
	            keyPress: true,
	            controls: true,
	            rtl: SF.opts.isRTL,
	            adaptiveHeight: true,
	            thumbItem: thumbItems,
	            thumbMargin: 30,
	            freeMove: false,
	            currentPagerPosition: 'middle',
	            swipeThreshold: 40,
	            responsive : [
		            {
		                breakpoint: 1024,
		                settings: {
		                    thumbItem: 3,
		                }
		            }
		        ],
	            onSliderLoad: function (el) {
		            el.addClass('slider-loaded');
		            if (SF.opts.hasProductZoom) {
						var currentImage = jQuery('#product-img-slider').find('.lslide.active > .product-slider-image');
						SF.woocommerce.productZoom(currentImage);
					}
	            },
	            onAfterSlide: function (el) {
		            if (SF.opts.hasProductZoom) {
						var currentImage = jQuery('#product-img-slider').find('.lslide.active > .product-slider-image');
						SF.woocommerce.productZoom(currentImage);
					}
	            }
	        });
		},	
	};
	
	/////////////////////////////////////////////
	// PORTFOLIO
	/////////////////////////////////////////////
	
	var portfolioContainer = jQuery('.portfolio-wrap').find('.filterable-items');
	
	SF.portfolio = {
		init: function() {
			SF.portfolio.standardSetup();
			
			
			// SET ITEM HEIGHTS
			SF.portfolio.setItemHeight();
			
			// PORTFOLIO WINDOW RESIZE
			$window.smartresize(function(){  
					SF.portfolio.windowResized();
			});
			
			// Enable filter options on when there are items from that skill
			jQuery('.filtering li').each( function() {
				var itemCount = 0;
				var filter = jQuery(this),
					filterName = jQuery(this).find('a').attr('class'),
					portfolioItems = jQuery(this).parent().parent().parent().next('.filterable-items');
				
				portfolioItems.find('li').each( function() {
					if ( jQuery(this).hasClass(filterName) ) {
						filter.addClass('has-items');
						itemCount++;
					}
				});
				
				if (jQuery(this).hasClass('all')) {
					itemCount = portfolioItems.children('li').length;
					jQuery(this).find('.item-count').text(itemCount);
				} else {
					jQuery(this).find('.item-count').text(itemCount);
				}
			});
	
			// filter items when filter link is clicked
			jQuery('.filtering li').on('click', 'a', function(e) {
				e.preventDefault();
				jQuery(this).parent().parent().find('li').removeClass('selected');
				jQuery(this).parent().addClass('selected');
				var selector = jQuery(this).attr('data-filter');
				var portfolioItems = jQuery(this).parent().parent().parent().parent().next('.filterable-items');
				portfolioItems.isotope({ filter: selector });
			});  
			
			jQuery('.filter-wrap > a').on('click', function(e) {
				e.preventDefault();
				jQuery(this).parent().find('.filter-slide-wrap').slideToggle();
			});
		},
		standardSetup: function() {
			portfolioContainer.isotope({
				animationEngine: 'best-available',
				animationOptions: {
					duration: 300,
					easing: 'easeInOutQuad',
					queue: false
				},
				resizable: true,
				layoutMode: 'fitRows'
			});
			SF.flexSlider.thumb();
			portfolioContainer.isotope("layout");
		},
		setItemHeight: function() {
			if (!portfolioContainer.hasClass('single-column')) {
				portfolioContainer.children().css('min-height','0');
				portfolioContainer.equalHeights();
				portfolioContainer.isotope("layout");
			}
		},
		windowResized: function() {
			if (!portfolioContainer.hasClass('single-column')) {
				SF.portfolio.setItemHeight();
			}
		}
	};
	
	
	/////////////////////////////////////////////
	// BLOG
	/////////////////////////////////////////////
	
	var blogItems = jQuery('.blog-wrap').find('.blog-items'),
		masonryPagination = jQuery('.blog-wrap').find('.masonry-pagination');
	
	SF.blog = {
		init: function() {
		
			// BLOG ITEM SETUP
			if (blogItems.hasClass('masonry-items')) {
				jQuery('.masonry-items').fitVids();
				SF.blog.masonrySetup();
				blogItems.imagesLoaded(function () {
					blogItems.animate({opacity: 1}, 800);
					masonryPagination.fadeIn(1000);
					SF.blog.masonrySetup();
				});
				SF.flexSlider.thumb();
				blogItems.isotope("layout");
				
				// BLOG WINDOW RESIZE
				$window.smartresize(function(){  
						SF.blog.windowResized();
				});
			} else {
				SF.flexSlider.thumb();
			}
			
			
			// BLOG AUX SLIDEOUT
			jQuery('.blog-slideout-trigger').on('click', function(e) {
				e.preventDefault();
				
				// VARIABLES
				var blogWrap = jQuery(this).parent().parent().parent().parent();
				var filterPanel = blogWrap.find('.filter-wrap .filter-slide-wrap');
				var auxType = jQuery(this).attr('data-aux');
								
				// ADD COLUMN SIZE AND REMOVE BRACKETS FROM COUNT
				blogWrap.find('.aux-list li').addClass('span2');
				blogWrap.find('.aux-list li a span').each(function() {
					jQuery(this).html(jQuery(this).html().replace("(","").replace(")",""));
				});
				
				// IF SELECTING AN OPTION THAT IS OPEN, CLOSE THE PANEL
				if (jQuery(this).parent().hasClass('selected') && !filterPanel.is(':animated')) {
					blogWrap.find('.blog-aux-options li').removeClass('selected');
					filterPanel.slideUp(400);
					return;
				}
				
				// AUX BUTTON SELECTED STATE
				blogWrap.find('.blog-aux-options li').removeClass('selected');	
				jQuery(this).parent().addClass('selected');
				
				// IF SLIDEOUT IS OPEN
				if (filterPanel.is(':visible')) {
					
					filterPanel.slideUp(400);
					setTimeout(function() {
						blogWrap.find('.aux-list').css('display', 'none');
						blogWrap.find('.aux-'+auxType).css('display', 'block');
						filterPanel.slideDown();
					}, 600);
					
				// IF SLIDEOUT IS CLOSED
				} else {
					
					blogWrap.find('.aux-list').css('display', 'none');
					blogWrap.find('.aux-'+auxType).css('display', 'block');
					filterPanel.slideDown();
					
				}
			});
			
		},
		masonrySetup: function() {
			blogItems.isotope({
				itemSelector : '.blog-item',
				masonry : {
					columnWidth : 0
				},
				animationEngine: 'best-available',
				animationOptions: {
					duration: 300,
					easing: 'easeInOutQuad',
					queue: false
				},
				transformsEnabled: false,
				resizable: true
			});
		},
		windowResized: function() {
			blogItems.isotope("layout");
		}	
	};
	
	/////////////////////////////////////////////
	// CAROUSEL FUNCTIONS
	/////////////////////////////////////////////

	SF.carouselWidgets = {
		init: function() {

			// CAROUSELS
			var carousel = jQuery('.carousel-items'),
				carouselAuto = false,
				carouselPSpeed = 800,
				carouselSSpeed = 200,
				carouselPagination = false,
				carouselPDirection = 'ltr',
				desktopWidth = 1169;

			if (SF.opts.isRTL) {
				carouselPDirection = 'rtl';
			}

			carousel.each(function() {
				var carouselInstance = jQuery('#'+jQuery(this).attr('id')),
					carouselColumns = parseInt(carouselInstance.attr("data-columns"), 10),
					desktopCarouselItems = 4 > carouselColumns ? carouselColumns : 4,
					desktopSmallCarouselItems = 3 > carouselColumns ? carouselColumns : 3,
					mobileCarouselItems = 1;

				if (carouselInstance.hasClass('clients-items')) {
					mobileCarouselItems = 2;
				}
				if (carouselInstance.hasClass('testimonials')) {
					desktopCarouselItems = 1;
					desktopSmallCarouselItems = 1;
					mobileCarouselItems = 1;
				}

				carouselInstance.imagesLoaded(function () {
					
					var leftMargin = 30;
					
					if ( $window.width() >= 1200 ) {
						leftMargin = 30;
					}

					if (!carouselInstance.hasClass('no-gutters')) {
						var carouselWidth = carouselInstance.width();
						carouselInstance.css('margin-left', '-15px').css('width', carouselWidth + leftMargin);
					}

					carouselInstance.owlCarousel({
						items : carouselColumns,
						itemsDesktop: [desktopWidth,desktopCarouselItems],
						itemsDesktopSmall: [desktopWidth-220,desktopSmallCarouselItems],
						itemsMobile: [479,mobileCarouselItems],
						paginationSpeed: carouselPSpeed,
						slideSpeed: carouselSSpeed,
						autoPlay: carouselAuto,
						autoPlayDirection : carouselPDirection,
						pagination: carouselPagination,
						autoHeight : false,
						beforeUpdate: function() {
							var leftMargin = 30;
							
							if ( $window.width() >= 1200 ) {
								leftMargin = 30;
							}
							if (!carouselInstance.hasClass('no-gutters')) {
								var carouselWidth = carouselInstance.parent().width();
								carouselInstance.css('width', carouselWidth + leftMargin);
							}
						},
						afterUpdate: function () {
							setTimeout(function() {
								carouselInstance.fitVids();
								SF.flexSlider.thumb();
							}, 200);
						},
						afterInit: function() {
							SF.flexSlider.thumb();
							$window.trigger('resize');
						},
						afterAction: function(){
							var carouselNext = carouselInstance.parents('.carousel-wrap').find('.carousel-next'),
								carouselPrev = carouselInstance.parents('.carousel-wrap').find('.carousel-prev');
								
						    if ( this.itemsAmount > this.visibleItems.length ) {
						        carouselNext.show();
						        carouselPrev.show();
						
						        carouselNext.removeClass('disabled');
						        carouselPrev.removeClass('disabled');
						        if ( this.currentItem == 0 ) {
						            carouselPrev.addClass('disabled');
						        }
						        if ( this.currentItem == this.maximumItem ) {
						            carouselNext.addClass('disabled');
						        }
						
						    } else {
						        carouselNext.hide();
						        carouselPrev.hide();
						    }
						}
					}).animate({
						'opacity': 1
					},800);
				});
			});

			// Previous
			jQuery('.carousel-next').click( function(e) {
				e.preventDefault();
				var carousel = jQuery(this).closest('.spb_content_element').find('.owl-carousel');
				if (SF.opts.isRTL) {
				carousel.data( 'owlCarousel' ).prev();
				} else {
				carousel.data( 'owlCarousel' ).next();
				}
			});

			// Next
			jQuery('.carousel-prev').click( function(e) {
				e.preventDefault();
				var carousel = jQuery(this).closest('.spb_content_element').find('.owl-carousel');
				if (SF.opts.isRTL) {
				carousel.data( 'owlCarousel' ).next();
				} else {
				carousel.data( 'owlCarousel' ).prev();
				}
			});
		},
		carouselMinHeight: function(carousel) {
			var minHeight = parseInt(carousel.find('.carousel-item:not(.no-thumb)').eq(0).css('height'));
			carousel.find('.owl-item').each(function () {
				jQuery(this).css('min-height',minHeight+'px');
			});
		}
	};
	
	
	/////////////////////////////////////////////
	// WIDGET FUNCTIONS
	/////////////////////////////////////////////
	
	SF.widgets = {
		init: function() {
			
			// CHARTS
			if (SF.opts.included.hasClass('has-chart')) {
				jQuery('.chart-shortcode').each(function(){
					jQuery(this).easyPieChart({
						animate: 1000,
						lineCap: 'square',
						lineWidth: jQuery(this).attr('data-linewidth'),
						size: jQuery(this).attr('data-size'),
						barColor: jQuery(this).attr('data-barcolor'),
						trackColor: jQuery(this).attr('data-trackcolor'),
						scaleColor: false
					});
				});
			}
			
			// LOAD WIDGETS
			SF.widgets.accordion();
			SF.widgets.tabs();
			SF.widgets.toggle();	
			SF.widgets.introAnimations();
			
			if (SF.opts.included.hasClass('has-imagebanner')) {
			SF.widgets.imageBanners();
			}
			
			// RESIZE ASSETS
			SF.widgets.resizeAssets();
			$window.smartresize(function() {  
				SF.widgets.resizeAssets();
			});
			
			// SF TOOLTIPS
			jQuery('[rel=tooltip]').tooltip();
			
		},
		resizeAssets: function() {	
			var carousels = jQuery('.carousel-active .carousel-items,.carousel-active .products');
			var assets = jQuery('.alt-bg');
			var assetWidth = 0;
			
			if (jQuery('#container').width() < 460 && body.hasClass('responsive-fluid')) {
				assetWidth = jQuery('#container').width() - 40;			
				carousels.find('.carousel-item,.product').each(function() {
					jQuery(this).css("width", assetWidth + "px");
					
				});
			} else if (jQuery('#container').width() < 768 && body.hasClass('responsive-fluid')) {
				if (carousels.hasClass('testimonials')) {
				assetWidth = jQuery('#container').width() - 40;	
				} else {
				assetWidth = Math.floor(jQuery('#container').width() / 2) - 35;	
				}
				carousels.find('.carousel-item,.product').each(function() {
					jQuery(this).css("width", assetWidth + "px");
				});
			} else if (body.hasClass('responsive-fluid')) {
				carousels.find('.carousel-item,.product').each(function() {
					jQuery(this).css("width", "");
				});
			}
			
			if (jQuery('#container').width() < 768 && body.hasClass('responsive-fluid')) {
				assetWidth = jQuery('#container').width();
				assets.each(function() {
					jQuery(this).css("width", assetWidth + "px");
				});	
			} else {
				assets.each(function() {
					jQuery(this).css("width", "");
				});	
			}
		},
		accordion: function() {
			jQuery('.spb_accordion').each(function() {
				var spb_tabs,				
					active_tab = false,
					active_attr = parseInt(jQuery(this).attr('data-active'), 10);
							
				if (jQuery.type( active_attr ) === "number") { active_tab = active_attr; }
							
				spb_tabs = jQuery(this).find('.spb_accordion_wrapper').accordion({
					header: "> div > h3",
					autoHeight: true,
					collapsible: true,
					active: active_tab,
					heightStyle: "content"
				});
			});
		},
		tabs: function() {
			// SET ACTIVE TABS PANE
			jQuery('.spb_tabs').each(function() {
				jQuery(this).find('.tab-pane').first().addClass('active');
			});
			
			// SET ACTIVE TOUR PANE
			jQuery('.spb_tour').each(function() {
				jQuery(this).find('.tab-pane').first().addClass('active');
			});
		},
		toggle: function() {
			jQuery(".spb_toggle").click(function() {
				if ( jQuery(this).hasClass('spb_toggle_title_active') ) {
					jQuery(this).removeClass('spb_toggle_title_active').next().slideUp(500);
				} else {
					jQuery(this).addClass('spb_toggle_title_active').next().slideDown(500);
				}
			});
			jQuery('.spb_toggle_content').each(function() {
				if ( jQuery(this).next().is('h4.spb_toggle') === false ) {
					jQuery('<div class="last_toggle_el_margin"></div>').insertAfter(this);
				}
			});
		},
		initSkillBars: function() {		
			// SKILL BARS
			SF.widgets.animateSkillBars();			
			jQuery(window).scroll(function() { 
				SF.widgets.animateSkillBars();
			});
		},
		animateSkillBars: function() {
			jQuery('.progress:in-viewport').each(function(){
				var progressBar = jQuery(this),
				progressValue = progressBar.find('.bar').attr('data-value');
				if (!progressBar.hasClass('animated')) {
					progressBar.addClass('animated');
					progressBar.find('.bar').animate({
						width: progressValue + "%"
					}, 600, function() {
						progressBar.find('.bar-text').fadeIn(400);
					});
				}
			});
		},
		charts: function() {
			SF.widgets.animateCharts();
			jQuery(window).scroll(function() { 
				SF.widgets.animateCharts();
			});	
		},
		animateCharts: function() {
			jQuery('.chart-shortcode:in-viewport').each(function(){
				if (!jQuery(this).hasClass('animated')) {
					jQuery(this).addClass('animated');
					var animatePercentage = parseInt(jQuery(this).attr('data-animatepercent'), 10);
					jQuery(this).data('easyPieChart').update(animatePercentage);
				}
			});
		},
		introAnimations: function() {
			if (!SF.opts.isMobileAlt) {
				jQuery('.sf-animation').each(function() {
	
					var animatedItem = jQuery(this),
						itemAnimation = animatedItem.data('animation'),
						itemDelay = animatedItem.data('delay');
										
					animatedItem.appear(function() {			
						if (itemAnimation == 'fade-from-left') {
							animatedItem.delay(itemDelay).animate({
								'opacity' : 1,
								'left' : '0px'
							}, 600, 'easeOutCubic');
						} else if (itemAnimation == 'fade-from-right') {
							animatedItem.delay(itemDelay).animate({
								'opacity' : 1,
								'right' : '0px'
							}, 600, 'easeOutCubic');
						} else if(itemAnimation == 'fade-from-bottom') {
							if (animatedItem.hasClass('image-banner-content')) {
								animatedItem.delay(itemDelay).animate({
									'opacity' : 1,
									'bottom' : '50%'
								}, 1000, 'easeOutCubic');
							} else {
								animatedItem.delay(itemDelay).animate({
									'opacity' : 1,
									'bottom' : '0px'
								}, 600, 'easeOutCubic');
							}
						} else if (itemAnimation == 'fade-in') {
							animatedItem.delay(itemDelay).animate({
								'opacity' : 1
							}, 600, 'easeOutCubic');
						} else if (itemAnimation == 'grow') {
							setTimeout(function(){ 
								animatedItem.addClass('sf-animate');
							}, itemDelay);
						} else {
							setTimeout(function() {
								animatedItem.addClass('sf-animate');						
							}, itemDelay);
						}
					}, {accX: 0, accY: -150}, 'easeInCubic');
				
				});
			}
		},
		imageBanners: function() {
			jQuery('.sf-image-banner').each(function() {
				jQuery(this).find('.image-banner-content').vCenter();
			});
		}
	};
	
	
	/////////////////////////////////////////////
	// TEAM MEMBERS FUNCTION
	/////////////////////////////////////////////
	
	SF.teamMembers = {
		init: function() {
			// TEAM EQUAL HEIGHTS
			var team = jQuery('.team-members:not(.carousel-items)');
			team.imagesLoaded(function () {
				if ($window.width() > 767) {
					team.equalHeights();
				}
			});

			// TEAM ASSETS
			$window.smartresize( function() {
				jQuery('.team-members:not(.carousel-items)').children().css('min-height','0');
				if ($window.width() > 767) {
					jQuery('.team-members:not(.carousel-items)').equalHeights();
				}
			});
		}
	};
	
	/////////////////////////////////////////////
	// PARALLAX FUNCTION
	/////////////////////////////////////////////

	SF.parallax = {
		init: function(reset) {

			jQuery('.spb_parallax_asset').each(function(reset) {

				var parallaxAsset = jQuery(this);

				if (parallaxAsset.hasClass('sf-parallax-video')) {

					if (!SF.opts.isMobileAlt) {
						SF.parallax.parallaxVideoInit();
					} else {
						parallaxAsset.find('video').remove();

						// Fade in
						parallaxAsset.transition({
							opacity: 1
						}, 300);
					}

					// Add resize handler
					$window.smartresize( function() {
						SF.parallax.parallaxVideoResize(parallaxAsset);
					});

				} else if (parallaxAsset.hasClass('parallax-window-height')) {

					parallaxAsset.css('height', '');
					var assetHeight = $window.height();

					if (parallaxAsset.height() > assetHeight && !reset) {
						assetHeight = parallaxAsset.height();
					}

					parallaxAsset.height(assetHeight - (parseInt(parallaxAsset.css('padding-top'), 10) * 2));
					if (parallaxAsset.data('v-center') === "true") {
						parallaxAsset.find('div:first').vCenterTop();
					}

					// Fade in
					parallaxAsset.transition({
						opacity: 1
					}, 300);

					// Add resize handler
					SF.parallax.windowImageResize(parallaxAsset);
					$window.smartresize( function() {
						SF.parallax.windowImageResize(parallaxAsset);
					});
				}
			});
		},
		load: function() {
			jQuery.stellar({
				horizontalScrolling: false,
				responsive: true,
				verticalOffset: 200,
			});
		},
		videoScroll: function(asset) {

			var offsetTop = asset.offset().top,
				windowTop = $window.scrollTop(),
				defaultHeight = parseInt(asset.data('height-default'), 10),
				diff = windowTop - offsetTop,
				currentTop = asset.find('.spb_content_wrapper').css('top'),
				heightDifference = defaultHeight - diff * 1.5;

			if (windowTop > offsetTop) {
				asset.css('height', heightDifference);
				asset.find('.spb_content_wrapper').css('opacity', 1 - (diff / 300));
				if (asset.hasClass('parallax-window-height') && asset.data('v-center') === "true") {
				asset.find('.spb_content_wrapper').css('top', currentTop + (diff / 4));
				} else if (asset.data('v-center') === "true") {
				asset.find('.spb_content_wrapper').css('top', (diff / 3));
				}
			} else {
				asset.css('height', defaultHeight);
				asset.find('.spb_content_wrapper').css('opacity', 1);
				if (asset.hasClass('parallax-video-height') && asset.data('v-center') === "true") {
				asset.find('.spb_content_wrapper').css('top', '50%');
				} else {
				asset.find('.spb_content_wrapper').css('top', 0);
				}
			}

		},
		windowImageResize: function(asset) {

			if (asset.hasClass('spb-row-container')) {

				var rowContentHeight = asset.find('> .spb_content_element').height();

				if (asset.hasClass('parallax-window-height')) {

					if (rowContentHeight < $window.height()) {
						rowContentHeight = $window.height();
					}
				}

				asset.height(rowContentHeight);

				if (asset.data('v-center')) {
				asset.find('> .spb_content_element').vCenterTop();
				}

			} else {

				var assetHeight = asset.height();

				if (asset.hasClass('parallax-window-height')) {

					if (assetHeight < $window.height()) {
						assetHeight = $window.height();
					}
				}

				asset.height(assetHeight - asset.css('padding-top') / 2);
				asset.find('.spb_content_wrapper').vCenterTop();
			}

		},
		parallaxVideoInit: function() {
			jQuery('.spb_parallax_asset.sf-parallax-video').each(function() {
				var parallaxAsset = jQuery(this),
					parallaxVideo = parallaxAsset.find('video'),
					parallaxVideoWidth = parallaxVideo.width(),
					parallaxContent = parallaxAsset.find('div:first'),
					parallaxAssetHeight = 0;

				if (parallaxAsset.hasClass('parallax-window-height')) {

					if (parallaxContent.height() > $window.height()) {
						parallaxAssetHeight = parallaxContent.height();
					} else {
						parallaxAssetHeight = $window.height();
					}

					parallaxAsset.animate({
						'height': parallaxAssetHeight
					}, 400);

					setTimeout(function() {

						// Scale video
						SF.parallax.parallaxVideoResize(parallaxAsset);

						// Fade in
						parallaxAsset.transition({
							opacity: 1
						}, 300);

					}, 500);

					setTimeout(function() {
						parallaxAsset.find('.video-overlay').animate({
							'opacity': 0.8
						}, 200);
					}, 100);

					if (parallaxAsset.data('v-center') === "true") {
					parallaxContent.vCenterTop();
					}

					setTimeout(function() {
						parallaxContent.animate({
							'opacity': 1,
							'top': '50%'
						}, 600, 'easeOutExpo');
					}, 600);

					parallaxAsset.attr('data-height-default', parallaxVideo.height());

				} else {
					SF.parallax.scaleVideo(parallaxAsset);
				}

				if ($window.width() < parallaxVideoWidth) {
					parallaxVideo.css('left', - (parallaxVideoWidth - $window.width()) /2);
				}

			});
		},
		parallaxVideoResize: function(parallaxAsset) {
			var parallaxContent = parallaxAsset.find('div:first'),
				parallaxAssetHeight = 0;

			if (parallaxAsset.hasClass('parallax-window-height')) {
				if (parallaxContent.height() > $window.height()) {
					parallaxAssetHeight = parallaxContent.height();
				} else {
					parallaxAssetHeight = $window.height();
				}

				parallaxAsset.animate({
					'height': parallaxAssetHeight
				}, 400);

				if (parallaxAsset.data('v-center') === "true") {
				parallaxContent.vCenterTop();
				}
			}

			SF.parallax.scaleVideo(parallaxAsset);
		},
		scaleVideo: function(parallaxAsset) {

			var video = parallaxAsset.find('video'),
				assetHeight = parallaxAsset.outerHeight(),
				assetWidth = parallaxAsset.width(),
				videoWidth = video[0].videoWidth,
				videoHeight = video[0].videoHeight;

			// Use the largest scale factor of horizontal/vertical
			var scale_h = assetWidth / videoWidth;
			var scale_v = assetHeight / videoHeight;
			var scale = scale_h > scale_v ? scale_h : scale_v;

			// Update minium width to never allow excess space
			var min_w = videoWidth/videoHeight * (assetHeight+20);

			// Don't allow scaled width < minimum video width
			if (scale * videoWidth < min_w) {scale = min_w / videoWidth;}

			// Scale the video
			video.width(Math.ceil(scale * videoWidth +2));
			video.height(Math.ceil(scale * videoHeight +50));
			video.css('margin-top', - (video.height() - assetHeight) /2);
			video.css('margin-left', - (video.width() - assetWidth) /2);
		},

	};

	
	/////////////////////////////////////////////
	// LIGHTBOX FUNCTION
	/////////////////////////////////////////////
	
	SF.lightbox = {
		init: function() {
			// Lightbox Social
			var lightboxSocial = {};
			if (SF.opts.lightboxSharing) {
				lightboxSocial = {
					facebook: {
						source: 'https://www.facebook.com/sharer/sharer.php?u={URL}',
						text: 'Share on Facebook'
					},
					twitter: true,
					googleplus: true,
					pinterest: {
						source: "https://pinterest.com/pin/create/button/?url={URL}&media={URL}",
						text: "Share on Pinterest"
					}
				};
			}
					
			// Lightbox Galleries
			var galleryArr = [];
			jQuery('[data-rel^="ilightbox["]').each(function () {
				var attr = this.getAttribute("data-rel");
				if ( jQuery(this).hasClass( 'ilightbox-enabled' ) ) {
					return;
				}
				if (jQuery.inArray(attr, galleryArr) == -1 ) {
					galleryArr.push(attr);
				}
			});
			jQuery.each(galleryArr, function (b, c) {
				jQuery('[data-rel="' + c + '"]').iLightBox({
					skin: SF.opts.lightboxSkin,
					social: {
						buttons: lightboxSocial
					},
					path: 'horizontal',
					thumbnails: {
						maxWidth: 120,
						maxHeight: 120
					},
					controls: {
						arrows: SF.opts.lightboxControlArrows,
						thumbnail: SF.opts.lightboxThumbs
					}
				});
				jQuery('[data-rel="' + c + '"]').addClass( 'ilightbox-enabled' );
			});
		}
	};
	
	
	/////////////////////////////////////////////
	// MAP FUNCTIONS
	/////////////////////////////////////////////
	
	SF.map = {
		init:function() {
			
			var maps = jQuery('.map-canvas');
			maps.each(function(index, element) {
				var mapContainer = element,
					mapAddress = mapContainer.getAttribute('data-address'),
					mapZoom = mapContainer.getAttribute('data-zoom'),
					mapType = mapContainer.getAttribute('data-maptype'),
					pinLogoURL = mapContainer.getAttribute('data-pinimage');
				
				SF.map.getCoordinates(mapAddress, mapContainer, mapZoom, mapType, pinLogoURL);
								
			});
			
			SF.map.fullscreenMap();
			$window.smartresize(function(){
				SF.map.fullscreenMap();
			});
			
			jQuery('ul.nav-tabs li a').click(function(){
				var thisTabHref = jQuery(this).attr('href');
				if (jQuery(thisTabHref).find('.spb_gmaps_widget').length > 0) {
					map.init();
				}
			});
			
		},
		getCoordinates: function(address, mapContainer, mapZoom, mapType, pinLogoURL) {
			var geocoder, geocodeReturn;
			geocoder = new google.maps.Geocoder();			
			geocoder.geocode({
				'address': address
			}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					
					var mapTypeIdentifier = "",
						companyPos = "",
						mapCoordinates = results[0].geometry.location,
						latitude = results[0].geometry.location.lat(),
						longitude = results[0].geometry.location.lng();				
					
					if (mapType === "SATELLITE") {
					mapTypeIdentifier = google.maps.MapTypeId.SATELLITE;
					} else if (mapType === "TERRAIN") {
					mapTypeIdentifier = google.maps.MapTypeId.TERRAIN;
					} else if (mapType === "HYBRID") {
					mapTypeIdentifier = google.maps.MapTypeId.HYBRID;
					} else {
					mapTypeIdentifier = google.maps.MapTypeId.ROADMAP;
					}
							
					var latlng = new google.maps.LatLng(latitude, longitude);
					var settings = {
						zoom: parseInt(mapZoom, 10),
						scrollwheel: false,
						center: latlng,
						mapTypeControl: true,
						mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
						navigationControl: true,
						navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
						mapTypeId: mapTypeIdentifier
					};
					var mapInstance = new google.maps.Map(mapContainer, settings);
					var companyMarker = "";
					if (pinLogoURL) {
						var companyLogo = new google.maps.MarkerImage(pinLogoURL,
							new google.maps.Size(150,75),
							new google.maps.Point(0,0),
							new google.maps.Point(75,75)
						);
						companyPos = new google.maps.LatLng(latitude, longitude);
						companyMarker = new google.maps.Marker({
							position: mapCoordinates,
							map: mapInstance,
							icon: companyLogo
						});
					} else { 
						companyPos = new google.maps.LatLng(latitude, longitude);
						companyMarker = new google.maps.Marker({
							position: mapCoordinates,
							map: mapInstance
						});
					}
					google.maps.event.addListener(companyMarker, 'click', function() {
						window.open('http://maps.google.com/maps?q='+companyPos);
					});
					
					google.maps.event.addDomListener(window, 'resize', function() {
						mapInstance.setCenter(companyPos);
					});
				}
			});			
		},
		fullscreenMap: function() {
			var fullscreenMap = jQuery('.fullscreen-map'),
				container = jQuery('#page-wrap'),
				mapOffset = container.offset().left,
				windowWidth = jQuery(window).width();

			if (windowWidth > 768) {
				mapOffset = mapOffset;
			} else {
				mapOffset = 20;
			}
						
			fullscreenMap.find('.map-canvas').css('width', windowWidth);
			fullscreenMap.css('margin-left', '-' + mapOffset + 'px');
			
		}
	};
		
	
	/////////////////////////////////////////////
	// RELOAD FUNCTIONS
	/////////////////////////////////////////////
	
	SF.reloadFunctions = {
		init:function() {	
	
			// Remove title attributes from images to avoid showing on hover 
			jQuery('img[title]').each(function() {
				jQuery(this).removeAttr('title');
			});
			
			if (!SF.opts.appleAgentID) {
				jQuery('embed').show();
			}
						
			// Animate Top Links
			jQuery('.animate-top').on('click', function(e) {
				e.preventDefault();
				jQuery('body,html').animate({scrollTop: 0}, 800);           
			});
		},
		load:function() {
				
			if (!SF.opts.agentID) {
			
				// Button hover tooltips
				jQuery('.tooltip').each( function() {
					jQuery(this).css( 'marginLeft', '-' + Math.round( (jQuery(this).outerWidth(true) / 2) ) + 'px' );
				});
				
				jQuery('.comment-avatar').hover( function() {
					jQuery(this).find('.tooltip' ).stop().animate({
						bottom: '44px',
						opacity: 1
					}, 500, 'easeInOutExpo');
				}, function() {
						jQuery(this).find('.tooltip').stop().animate({
							bottom: '25px',
							opacity: 0
						}, 400, 'easeInOutExpo');
				});
				
				jQuery('.grid-image').hover( function() {
					jQuery(this).find('.tooltip' ).stop().animate({
						bottom: '85px',
						opacity: 1
					}, 500, 'easeInOutExpo');
				}, function() {
						jQuery(this).find('.tooltip').stop().animate({
							bottom: '65px',
							opacity: 0
						}, 400, 'easeInOutExpo');
				});
			
			}	
		}
	};
	
	
	/////////////////////////////////////////////
	// GLOBAL VARIABLES
	/////////////////////////////////////////////
		
	var $window = jQuery(window),
		body = jQuery('body');
	
	/////////////////////////////////////////////
	// SF VARIABLES
	/////////////////////////////////////////////
	
	var sfOptParams = jQuery('#sf-option-params');
	var sfOpts = {
		isRTL: body.hasClass('rtl'),
		included: jQuery('#sf-included'),
		deviceAgent: navigator.userAgent.toLowerCase(),
		productSliderVertHeight: 600,
		productSliderThumbsPos: "bottom",
		lightboxSkin: sfOptParams.data('lightbox-skin'),
		lightboxControlArrows: sfOptParams.data('lightbox-nav'),
		lightboxThumbs: sfOptParams.data('lightbox-thumbs'),
		lightboxSharing: sfOptParams.data('lightbox-sharing'),
	};

	if ( typeof sfOptParams.data() !== "undefined" ) {
		SF.opts = jQuery.merge( sfOpts, sfOptParams.data() );
	} else {
		var opsData = {
			"lightbox-nav" : jQuery('#sf-option-params').attr('data-lightbox-nav'),
			"lightbox-thumbs" : jQuery('#sf-option-params').attr('data-lightbox-thumbs'),
			"lightbox-skin" : jQuery('#sf-option-params').attr('data-lightbox-skin'),
			"lightbox-sharing" : jQuery('#sf-option-params').attr('data-lightbox-sharing'),
		};
		SF.opts = jQuery.merge(sfOpts, opsData);
	}
	SF.opts.lightboxControlArrows = (SF.opts.lightboxControlArrows === "arrows") ? true : false;
	SF.opts.lightboxSkin = (SF.opts.lightboxSkin === "dark") ? "metro-black" : "metro-white";

	SF.opts.isMobile = SF.opts.deviceAgent.match(/(iphone|ipod|android|iemobile)/);
	SF.opts.agentID = SF.opts.isMobileAlt = SF.opts.deviceAgent.match(/(iphone|ipod|ipad|android|iemobile)/);
	SF.opts.appleAgentID = SF.opts.deviceAgent.match(/(iphone|ipod|ipad)/);
	
	SF.opts.hasProductZoom = SF.opts.included.hasClass('has-productzoom') && !body.hasClass('mobile-browser');
	SF.productSlider = false;
	
	/////////////////////////////////////////////
	// LOAD + READY FUNCTION
	/////////////////////////////////////////////
	
	SF.onReady = {
		init: function(){
			SF.page.init();
			SF.sliders.init();
			SF.superSearch.init();
			SF.header.init();
			SF.nav.init();
			if (SF.opts.included.hasClass('has-products') || body.hasClass('woocommerce-cart') || body.hasClass('woocommerce-account') || body.hasClass('single-tribe_events') ) {
			SF.woocommerce.init();
			}
			if (SF.opts.included.hasClass('has-team')) {
			SF.teamMembers.init();
			}
			SF.lightbox.init();
			if (SF.opts.included.hasClass('has-carousel')) {
			SF.carouselWidgets.init();
			}
			SF.widgets.init();
			if (SF.opts.included.hasClass('has-parallax')) {
			SF.parallax.init();
			}
			SF.reloadFunctions.init();       
		}
	};
	SF.onLoad = {
		init: function(){
			SF.flexSlider.init();
			if (SF.opts.included.hasClass('has-portfolio')) {
			SF.portfolio.init();
			}
			if (SF.opts.included.hasClass('has-parallax')) {
			SF.parallax.load();
			}
			if (SF.opts.included.hasClass('has-blog')) {
			SF.blog.init();
			}
			if (SF.opts.included.hasClass('has-chart')) {
				SF.widgets.charts();
			}
			if (SF.opts.included.hasClass('has-progress-bar')) {
				SF.widgets.initSkillBars();
			}
			if (SF.opts.included.hasClass('has-map')) {
			SF.map.init();
			}
			SF.reloadFunctions.load();
			SF.woocommerce.variations();
		}
	};
	
	jQuery(document).ready(SF.onReady.init);
	jQuery(window).load(SF.onLoad.init);
	
})(jQuery);

/////////////////////////////////////////////
// SMARTRESIZE PLUGIN
/////////////////////////////////////////////

(function($,sr){

	// USE STRICT
	"use strict";
	
	// debouncing function from John Hann
	// http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
	var debounce = function (func, threshold, execAsap) {
		var timeout;
		
		return function debounced () {
			var obj = this, args = arguments;
			function delayed () {
				if (!execAsap) {
					func.apply(obj, args);
					timeout = null;
				}
			}
			
			if (timeout) {
				clearTimeout(timeout);
			} else if (execAsap) {
				func.apply(obj, args);
			}
			
			timeout = setTimeout(delayed, threshold || 100); 
		};
	};
	
	// smartresize 
	jQuery.fn[sr] = function(fn){  return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr); };
 
})(jQuery,'smartresize');


/////////////////////////////////////////////
// EQUALHEIGHTS PLUGIN
/////////////////////////////////////////////

(function($) {

	// USE STRICT
	"use strict";
	
	$.fn.equalHeights = function(px) {
		$(this).each(function(){
			var currentTallest = 0;
			$(this).children().each(function(){
				if ($(this).height() > currentTallest) { currentTallest = $(this).height(); }
			});
			if (!px && Number.prototype.pxToEm) {
				currentTallest = currentTallest.pxToEm(); //use ems unless px is specified
			}
			// for ie6, set height since min-height isn't supported
			if ($.browser.msie && $.browser.version === 6.0) {
				(this).children().css({'height': currentTallest});
			}
			$(this).children().css({'min-height': currentTallest}); 
		});
		return this;
	};
})(jQuery);


/////////////////////////////////////////////
// EASYPIECHART PLUGIN
/////////////////////////////////////////////

(function($) {
	// USE STRICT
	"use strict";
	$.easyPieChart = function(el, options) {
		var addScaleLine, animateLine, drawLine, easeInOutQuad, renderBackground, renderScale, renderTrack,
		_this = this;
		this.el = el;
		this.$el = $(el);
		this.$el.data("easyPieChart", this);
		this.init = function() {
			var percent;
			_this.options = $.extend({}, $.easyPieChart.defaultOptions, options);
			percent = parseInt(_this.$el.data('percent'), 10);
			_this.percentage = 0;
			_this.canvas = $("<canvas width='" + _this.options.size + "' height='" + _this.options.size + "'></canvas>").get(0);
			_this.$el.append(_this.canvas);
			if (typeof G_vmlCanvasManager !== "undefined" && G_vmlCanvasManager !== null) {
				G_vmlCanvasManager.initElement(_this.canvas);
			}
			_this.ctx = _this.canvas.getContext('2d');
			if (window.devicePixelRatio > 1.5) {
				$(_this.canvas).css({
					width: _this.options.size,
					height: _this.options.size
				});
				_this.canvas.width *= 2;
				_this.canvas.height *= 2;
				_this.ctx.scale(2, 2);
			}
			_this.ctx.translate(_this.options.size / 2, _this.options.size / 2);
			_this.$el.addClass('easyPieChart');
			_this.$el.css({
				width: _this.options.size,
				height: _this.options.size,
				lineHeight: "" + _this.options.size + "px"
			});			
			_this.update(percent);
			return _this;
		};
		this.update = function(percent) {
			if (_this.options.animate === false) {
				return drawLine(percent);
			} else {
				if (percent === 0) {
					return animateLine(0, 0);	
				} else {
					return animateLine(_this.percentage, percent);	
				}
			}
		};
		renderScale = function() {
			var i, _i, _results;
			_this.ctx.fillStyle = _this.options.scaleColor;
			_this.ctx.lineWidth = 1;
			_results = [];
			for (i = _i = 0; _i <= 24; i = ++_i) {
				_results.push(addScaleLine(i));
			}
			return _results;
		};
		addScaleLine = function(i) {
			var offset;
			offset = i % 6 === 0 ? 0 : _this.options.size * 0.017;
			_this.ctx.save();
			_this.ctx.rotate(i * Math.PI / 12);
			_this.ctx.fillRect(_this.options.size / 2 - offset, 0, -_this.options.size * 0.05 + offset, 1);
			return _this.ctx.restore();
		};
		renderTrack = function() {
			var offset;
			offset = _this.options.size / 2 - _this.options.lineWidth / 2;
			if (_this.options.scaleColor !== false) {
				offset -= _this.options.size * 0.08;
			}
			_this.ctx.beginPath();
			_this.ctx.arc(0, 0, offset, 0, Math.PI * 2, true);
			_this.ctx.closePath();
			_this.ctx.strokeStyle = _this.options.trackColor;
			_this.ctx.lineWidth = _this.options.lineWidth;
			return _this.ctx.stroke();
		};
		renderBackground = function() {
//			if (_this.options.scaleColor !== false) {
//				renderScale();
//			}
			if (_this.options.trackColor !== false) {
				return renderTrack();
			}
		};
		drawLine = function(percent) {
			var offset;
			renderBackground();
			_this.ctx.strokeStyle = $.isFunction(_this.options.barColor) ? _this.options.barColor(percent) : _this.options.barColor;
			_this.ctx.lineCap = _this.options.lineCap;
			_this.ctx.lineWidth = _this.options.lineWidth;
			offset = _this.options.size / 2 - _this.options.lineWidth / 2;
			if (_this.options.scaleColor !== false) {
				offset -= _this.options.size * 0.08;
			}
			_this.ctx.save();
			_this.ctx.rotate(-Math.PI / 2);
			_this.ctx.beginPath();
			_this.ctx.arc(0, 0, offset, 0, Math.PI * 2 * percent / 100, false);
			_this.ctx.stroke();
			return _this.ctx.restore();
		};
		animateLine = function(from, to) {
			var currentStep, fps, steps;
			fps = 30;
			steps = fps * _this.options.animate / 1000;
			currentStep = 0;
			_this.options.onStart.call(_this);
			_this.percentage = to;
			if (_this.animation) {
				clearInterval(_this.animation);
				_this.animation = false;
			}
			_this.animation = setInterval(function() {
				_this.ctx.clearRect(-_this.options.size / 2, -_this.options.size / 2, _this.options.size, _this.options.size);
				renderBackground.call(_this);
				drawLine.call(_this, [easeInOutQuad(currentStep, from, to - from, steps)]);
				currentStep++;
				if ((currentStep / steps) > 1) {
					clearInterval(_this.animation);
					_this.animation = false;
					return _this.options.onStop.call(_this);
				}
			}, 1000 / fps);
			return _this.animation;
		};
		easeInOutQuad = function(t, b, c, d) {
			var easeIn, easing;
			easeIn = function(t) {
				return Math.pow(t, 2);
			};
			easing = function(t) {
				if (t < 1) {
					return easeIn(t);
				} else {
					return 2 - easeIn((t / 2) * -2 + 2);
				}
			};
			t /= d / 2;
			return c / 2 * easing(t) + b;
		};
		return this.init();
	};
	$.easyPieChart.defaultOptions = {
		barColor: '#ef1e25',
		trackColor: '#f2f2f2',
		scaleColor: false,
		lineCap: 'round',
		size: 110,
		lineWidth: 3,
		animate: false,
		onStart: $.noop,
		onStop: $.noop
	};
	$.fn.easyPieChart = function(options) {
		return $.each(this, function(i, el) {
		var $el;
		$el = $(el);
		if (!$el.data('easyPieChart')) {
			return $el.data('easyPieChart', new $.easyPieChart(el, options));
		}
		});
	};
	return void 0;
})(jQuery);


/////////////////////////////////////////////
// ANIMATE NUMBER PLUGIN
/////////////////////////////////////////////

(function($) {
	
	// USE STRICT
	"use strict";
	
    $.fn.animateNumber = function(to) {
        var $ele = $(this),
            num = parseInt($ele.html(), 10),
            up = to > num,
            num_interval = Math.abs(num - to) / 90;

        var loop = function() {
            num = up ? Math.ceil(num+num_interval) : Math.floor(num-num_interval);
            if ( (up && num > to) || (!up && num < to) ) {
                num = to;
                clearInterval(animation);
            }
            $ele.html(num);
        };
        
        var intervalTime = to <= 5 ? intervalTime = 100 : to <= 25 ? intervalTime = 50 : to <= 50 ? intervalTime = 25 : 10;

        var animation = setInterval(loop, intervalTime);
    };
})(jQuery);


/////////////////////////////////////////////
// VIEWPORT PLUGIN
/////////////////////////////////////////////

(function($) {

	// USE STRICT
	"use strict";
    
    $.belowthefold = function(element, settings) {
        var fold = $(window).height() + $(window).scrollTop();
        return fold <= $(element).offset().top - settings.threshold;
    };

    $.abovethetop = function(element, settings) {
        var top = $(window).scrollTop();
        return top >= $(element).offset().top + $(element).height() - settings.threshold;
    };
    
    $.rightofscreen = function(element, settings) {
        var fold = $(window).width() + $(window).scrollLeft();
        return fold <= $(element).offset().left - settings.threshold;
    };
    
    $.leftofscreen = function(element, settings) {
        var left = $(window).scrollLeft();
        return left >= $(element).offset().left + $(element).width() - settings.threshold;
    };
    
    $.inviewport = function(element, settings) {
        return !$.rightofscreen(element, settings) && !$.leftofscreen(element, settings) && !$.belowthefold(element, settings) && !$.abovethetop(element, settings);
    };
    
    $.extend($.expr[':'], {
        "below-the-fold": function(a) {
            return $.belowthefold(a, {threshold : 0});
        },
        "above-the-top": function(a) {
            return $.abovethetop(a, {threshold : 0});
        },
        "left-of-screen": function(a) {
            return $.leftofscreen(a, {threshold : 0});
        },
        "right-of-screen": function(a) {
            return $.rightofscreen(a, {threshold : 0});
        },
        "in-viewport": function(a) {
            return $.inviewport(a, {threshold : 0});
        }
    });

    
})(jQuery);

/////////////////////////////////////////////
// APPEAR PLUGIN
/////////////////////////////////////////////
(function($) {
    $.fn.appear = function(fn, options) {

        var settings = $.extend({

            //arbitrary data to pass to fn
            data: undefined,

            //call fn only on the first appear?
            one: true,

            // X & Y accuracy
            accX: 0,
            accY: 0

        }, options);

        return this.each(function() {

            var t = $(this);

            //whether the element is currently visible
            t.appeared = false;

            if (!fn) {

                //trigger the custom event
                t.trigger('appear', settings.data);
                return;
            }

            var w = $(window);

            //fires the appear event when appropriate
            var check = function() {

                //is the element hidden?
                if (!t.is(':visible')) {

                    //it became hidden
                    t.appeared = false;
                    return;
                }

                //is the element inside the visible window?
                var a = w.scrollLeft();
                var b = w.scrollTop();
                var o = t.offset();
                var x = o.left;
                var y = o.top;

                var ax = settings.accX;
                var ay = settings.accY;
                var th = t.height();
                var wh = w.height();
                var tw = t.width();
                var ww = w.width();

                if (y + th + ay >= b &&
                    y <= b + wh + ay &&
                    x + tw + ax >= a &&
                    x <= a + ww + ax) {

                    //trigger the custom event
                    if (!t.appeared) t.trigger('appear', settings.data);

                } else {

                    //it scrolled out of view
                    t.appeared = false;
                }
            };

            //create a modified fn with some additional logic
            var modifiedFn = function() {

                //mark the element as visible
                t.appeared = true;

                //is this supposed to happen only once?
                if (settings.one) {

                    //remove the check
                    w.unbind('scroll', check);
                    var i = $.inArray(check, $.fn.appear.checks);
                    if (i >= 0) $.fn.appear.checks.splice(i, 1);
                }

                //trigger the original fn
                fn.apply(this, arguments);
            };

            //bind the modified fn to the element
            if (settings.one) t.one('appear', settings.data, modifiedFn);
            else t.bind('appear', settings.data, modifiedFn);

            //check whenever the window scrolls
            w.scroll(check);

            //check whenever the dom changes
            $.fn.appear.checks.push(check);

            //check now
            (check)();
        });
    };

    //keep a queue of appearance checks
    $.extend($.fn.appear, {

        checks: [],
        timeout: null,

        //process the queue
        checkAll: function() {
            var length = $.fn.appear.checks.length;
            if (length > 0) while (length--) ($.fn.appear.checks[length])();
        },

        //check the queue asynchronously
        run: function() {
            if ($.fn.appear.timeout) clearTimeout($.fn.appear.timeout);
            $.fn.appear.timeout = setTimeout($.fn.appear.checkAll, 20);
        }
    });

    //run checks when these methods are called
    $.each(['append', 'prepend', 'after', 'before', 'attr',
        'removeAttr', 'addClass', 'removeClass', 'toggleClass',
        'remove', 'css', 'show', 'hide'], function(i, n) {
        var old = $.fn[n];
        if (old) {
            $.fn[n] = function() {
                var r = old.apply(this, arguments);
                $.fn.appear.run();
                return r;
            }
        }
    });

})(jQuery);


/////////////////////////////////////////////
// vCenter PLUGIN
/////////////////////////////////////////////

(function($) {$.fn.vCenter = function() {return this.each(function(){var height = $(this).outerHeight();$(this).css('margin-bottom',-height/2);});};})(jQuery);
(function($) {$.fn.vCenterTop = function() {return this.each(function(){var height = $(this).outerHeight();$(this).css('margin-top',-height/2);});};})(jQuery);
