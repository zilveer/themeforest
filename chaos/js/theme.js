/* Theme JS */

(function($) {
	"use strict";
	
	jQuery(document).mouseup(function (e) {
		
		var container = jQuery('.atc-notice-wrapper');
		if (!container.is(e.target) && container.has(e.target).length === 0 ) {
			jQuery('.atc-notice-wrapper').fadeOut();
		}
		
		//hide search input if need
		container = jQuery('#searchform');
		if (!container.is(e.target) && container.has(e.target).length === 0 ) {
			jQuery("#ws").removeClass("show");
		}
	});
	
	jQuery(document).ready(function(){
		
		// Show/hide search input
		jQuery("#wsearchsubmit").click(function(){
			if(jQuery("#ws").width()==0){
				if(jQuery("#ws").hasClass("show")){
					jQuery("#ws").removeClass("show");
				} else {
					jQuery("#ws").addClass("show");
					return false;
				}
			}
		});
		
		//Horizontal dropdown menu
			//default, not selected locations
		jQuery('.horizontal-menu .nav-menu > ul').superfish({
			delay: 100,
			speed: 'fast'
		});
			//default, selected locations
		jQuery('.primary-menu-container ul.nav-menu').superfish({
			delay: 100,
			speed: 'fast'
		});
		
		//Mobile Menu
		var mobileMenuWrapper = jQuery('.mobile-menu-container');
		mobileMenuWrapper.find('.menu-item-has-children').each(function(){
			var linkItem = jQuery(this).find('a').first();
			linkItem.after('<i class="fa fa-plus"></i>');
		});
		//calculate the init height of menu
		var totalMenuLevelFirst = jQuery('.mobile-menu-container .nav-menu > li').length;
		var mobileMenuH = totalMenuLevelFirst*40 + 10; //40 is height of one item, 10 is padding-top + padding-bottom;
		
		jQuery('.mbmenu-toggler').on('click', function(){
			if(mobileMenuWrapper.hasClass('open')) {
				mobileMenuWrapper.removeClass('open');
				mobileMenuWrapper.animate({'height': 0}, 'fast');
			} else {
				mobileMenuWrapper.addClass('open');
				mobileMenuWrapper.animate({'height': mobileMenuH}, 'fast');
			}
		});
			//set the height of all li.menu-item-has-children items
		jQuery('.mobile-menu-container li.menu-item-has-children').each(function(){
			jQuery(this).css({'height': 40, 'overflow': 'hidden'});
		});
			//process the parent items
		jQuery('.mobile-menu-container li.menu-item-has-children').each(function(){
			var parentLi = jQuery(this);
			var dropdownUl = parentLi.find('ul.sub-menu').first();
			
			parentLi.find('.fa').first().on('click', function(){
				//set height is auto for all parents dropdown
				parentLi.parents('li.menu-item-has-children').css('height', 'auto');
				//set height is auto for menu wrapper
				mobileMenuWrapper.css({'height': 'auto'});
				
				var dropdownUlheight = dropdownUl.outerHeight() + 40;
				
				if(parentLi.hasClass('opensubmenu')) {
					parentLi.removeClass('opensubmenu');
					parentLi.animate({'height': 40}, 'fast', function(){
						//calculate new height of menu wrapper
						mobileMenuH = mobileMenuWrapper.outerHeight();
					});
					parentLi.find('.fa').first().removeClass('fa-minus');
					parentLi.find('.fa').first().addClass('fa-plus');
				} else {
					parentLi.addClass('opensubmenu');
					parentLi.animate({'height': dropdownUlheight}, 'fast', function(){
						//calculate new height of menu wrapper
						mobileMenuH = mobileMenuWrapper.outerHeight();
					});
					parentLi.find('.fa').first().addClass('fa-minus');
					parentLi.find('.fa').first().removeClass('fa-plus');
				}
				
			});
		});
		
		//Mini Cart
		if(jQuery(window).width() > 1024){
			jQuery('.widget_shopping_cart').on('mouseover', function(){
				var mCartHeight = jQuery('.mini_cart_inner').outerHeight();
				var cCartHeight = jQuery('.mini_cart_content').outerHeight();
				if(cCartHeight < mCartHeight) {
					jQuery('.mini_cart_content').stop(true, false).animate({'height': mCartHeight});
				}
			});
			jQuery('.widget_shopping_cart').on('mouseleave', function(){
				jQuery('.mini_cart_content').animate({'height':'0'});
			});
		}
			//For tablet & mobile
		jQuery('.widget_shopping_cart').on('click', function(event){
			if(jQuery(window).width() < 1025){
				var closed = false;
				var mCartHeight = jQuery('.mini_cart_inner').outerHeight();
				var mCartToggler = jQuery('.cart-toggler a:first-child');
				if(jQuery('.mini_cart_content').height() == 0 ) {
					closed = true;
				}
				if (mCartToggler.is(event.target) || mCartToggler.has(event.target).length != 0 || mCartToggler.is(event.target) ) {
					event.preventDefault();
					if(closed) {
						jQuery('.mini_cart_content').animate({'height': mCartHeight});
						closed = false;
					} else {
						jQuery('.mini_cart_content').animate({'height':'0'}, function(){
							closed = true;
						});
					}
				}
			}
		});
		jQuery('.cart-toggler .checkout').on('click', function(){
			var checkoutURL = jQuery(this).attr('href');
			window.location.href = checkoutURL;
		});
		//add to cart callback
		jQuery('body').append('<div class="atc-notice-wrapper"><div class="atc-notice"></div><div class="close"><i class="fa fa-times-circle"></i></div></div>');
		
		jQuery('.atc-notice-wrapper .close').on('click', function(){
			jQuery('.atc-notice-wrapper').fadeOut();
			jQuery('.atc-notice').html('');
		});
		jQuery('body').on( 'adding_to_cart', function(event, button, data) {
			var ajaxPId = button.attr('data-product_id');
			var ajaxPQty = button.attr('data-quantity');
			
			//get product info by ajax
			jQuery.post(
				ajaxurl, 
				{
					'action': 'get_productinfo',
					'data':   {'pid': ajaxPId,'quantity': ajaxPQty}
				},
				function(response){
					jQuery('.atc-notice').html(response);
				}
			);
		});
		jQuery('body').on( 'added_to_cart', function(event, fragments, cart_hash) {
			//show product info after added
			jQuery('.atc-notice-wrapper').fadeIn();
		});
		
		//Product images on details page
		jQuery('.single-images').slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: true,
			dots: false,
			fade: true,
			asNavFor: '.single-thumbnails'
		});
		jQuery('.single-thumbnails').slick({
			slidesToShow: 4,
			slidesToScroll: 1,
			asNavFor: '.single-images',
			arrows: false,
			dots: true,
			centerMode: true,
			focusOnSelect: true,
			infinite: true
		});
		
		//Thumbnails click
		jQuery('a.yith_magnifier_thumbnail').live('click', function(){
			jQuery('a.yith_magnifier_thumbnail').removeClass('active');
			jQuery(this).addClass('active');
		});
		
		// Shop toolbar sort
		jQuery('.toolbar .orderby').chosen({disable_search: true, width: "auto"});
		
		//currency switcher
		jQuery('.wcml_currency_switcher').chosen({disable_search: true, width: "auto"});
		
		//Count down carousel 1
		jQuery('.countdown-carousel .shop-products').slick({
			infinite: false,
			slidesToShow: 1,
			slidesToScroll: 1,
			speed: 1000,
			easing: 'linear',
			swipeToSlide: true,
			autoplaySpeed: 3000
		});
		jQuery('.countbox.hastime').each(function(){
			var countTime = jQuery(this).attr('data-time');
			
			jQuery(this).countdown(countTime, function(event) {
				jQuery(this).html(
					'<span class="timebox day"><strong>'+event.strftime('%D')+'</strong>days</span><span class="timebox hour"><strong>'+event.strftime('%H')+'</strong>hrs</span><span class="timebox minute"><strong>'+event.strftime('%M')+'</strong>mins</span><span class="timebox second"><strong>'+event.strftime('%S')+'</strong>secs</span>'
				);
			});
			//jQuery(this).countdown('stop');
		});
		
		//Products carousel
		jQuery('.products-carousel .wpb_wrapper > h3').each(function(){
			var pwidgetTitle = jQuery(this).html();
			jQuery(this).html('<span>'+pwidgetTitle+'</span>');
		});
		jQuery('.products-carousel .shop-products').slick({
			infinite: false,
			slidesToShow: 4,
			slidesToScroll: 1,
			speed: 500,
			easing: 'linear',
			swipeToSlide: true,
			autoplaySpeed: 1000,
			responsive: [
				{
				  breakpoint: 1200,
				  settings: {
					slidesToShow: 3,
					slidesToScroll: 1
				  }
				},
				{
				  breakpoint: 992,
				  settings: {
					slidesToShow: 3,
					slidesToScroll: 1
				  }
				},
				{
				  breakpoint: 767,
				  settings: {
					slidesToShow: 2,
					slidesToScroll: 1
				  }
				},
				{
				  breakpoint: 600,
				  settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				  }
				}
			]
		});
		
		//Latest posts carousel - layout 1
		jQuery('.latest-posts .wpb_wrapper > h3').each(function(){
			var pwidgetTitle = jQuery(this).html();
			jQuery(this).html('<span>'+pwidgetTitle+'</span>');
		});
		jQuery('.latest-posts .posts-carousel').slick({
			arrows: false,
			dots: true,
			infinite: false,
			slidesToShow: 2,
			slidesToScroll: 1,
			speed: road_bloganimate,
			easing: 'linear',
			autoplay: road_blogscroll,
			swipeToSlide: true,
			autoplaySpeed: road_blogpause,
			responsive: [
				{
				  breakpoint: 1200,
				  settings: {
					slidesToShow: 2,
					slidesToScroll: 1
				  }
				},
				{
				  breakpoint: 992,
				  settings: {
					slidesToShow: 2,
					slidesToScroll: 1
				  }
				},
				{
				  breakpoint: 767,
				  settings: {
					slidesToShow: 2,
					slidesToScroll: 1
				  }
				},
				{
				  breakpoint: 600,
				  settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				  }
				}

			]
		});
		
		//Testimonials carousel
		jQuery('.testimonials .wpb_wrapper > h3').each(function(){
			var pwidgetTitle = jQuery(this).html();
			jQuery(this).html('<span>'+pwidgetTitle+'</span>');
		});
		jQuery('.testimonials-list').slick({
			arrows: false,
			dots: true,
			infinite: false,
			slidesToShow: 1,
			slidesToScroll: 1,
			speed: road_testianimate,
			easing: 'linear',
			autoplay: road_testiscroll,
			swipeToSlide: true,
			autoplaySpeed: road_testipause
		});
		
		//Cross-sells Products carousel
		jQuery('.cross-carousel .shop-products').slick({
			infinite: false,
			slidesToShow: 3,
			slidesToScroll: 1,
			speed: 1000,
			easing: 'linear',
			swipeToSlide: true,
			autoplaySpeed: 3000,
			responsive: [
				{
				  breakpoint: 1200,
				  settings: {
					slidesToShow: 2,
					slidesToScroll: 1
				  }
				},
				{
				  breakpoint: 992,
				  settings: {
					slidesToShow: 3,
					slidesToScroll: 1
				  }
				},
				{
				  breakpoint: 767,
				  settings: {
					slidesToShow: 2,
					slidesToScroll: 1
				  }
				},
				{
				  breakpoint: 600,
				  settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				  }
				}
			]
		});
		
		//Image zoom
		jQuery('.zoom_in_marker').on('click', function(){
			jQuery.fancybox({
				href: jQuery('.woocommerce-main-image').attr('href'),
				openEffect: 'elastic',
				closeEffect: 'elastic'
			});
		});
		
		//Upsells Products carousel
		jQuery('.upsells .shop-products').slick({
			infinite: false,
			slidesToShow: 4,
			slidesToScroll: 1,
			speed: 1000,
			easing: 'linear',
			swipeToSlide: true,
			autoplaySpeed: 3000,
			responsive: [
				{
				  breakpoint: 1200,
				  settings: {
					slidesToShow: 4,
					slidesToScroll: 1
				  }
				},
				{
				  breakpoint: 992,
				  settings: {
					slidesToShow: 3,
					slidesToScroll: 1
				  }
				},
				{
				  breakpoint: 767,
				  settings: {
					slidesToShow: 2,
					slidesToScroll: 1
				  }
				},
				{
				  breakpoint: 600,
				  settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				  }
				}
			]
		});
		
		//Related Products carousel
		jQuery('.related .shop-products').slick({
			infinite: false,
			slidesToShow: 4,
			slidesToScroll: 1,
			speed: 1000,
			easing: 'linear',
			swipeToSlide: true,
			autoplaySpeed: 3000,
			responsive: [
				{
				  breakpoint: 1200,
				  settings: {
					slidesToShow: 4,
					slidesToScroll: 1
				  }
				},
				{
				  breakpoint: 992,
				  settings: {
					slidesToShow: 3,
					slidesToScroll: 1
				  }
				},
				{
				  breakpoint: 767,
				  settings: {
					slidesToShow: 2,
					slidesToScroll: 1
				  }
				},
				{
				  breakpoint: 600,
				  settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				  }
				}
			]
		});
		
		//Projects carousel
		
		//Category view mode
		jQuery('.view-mode').each(function(){
			jQuery(this).find('.grid').on('click', function(event){
				event.preventDefault();
				
				jQuery('.view-mode').find('.grid').addClass('active');
				jQuery('.view-mode').find('.list').removeClass('active');
				
				jQuery('#archive-product .shop-products').removeClass('list-view');
				jQuery('#archive-product .shop-products').addClass('grid-view');
				
				jQuery('.list-col4').removeClass('col-xs-12 col-sm-4');
				jQuery('.list-col8').removeClass('col-xs-12 col-sm-8');
			});
			jQuery(this).find('.list').on('click', function(event){
				event.preventDefault();
			
				jQuery('.view-mode').find('.list').addClass('active');
				jQuery('.view-mode').find('.grid').removeClass('active');
				
				jQuery('#archive-product .shop-products').addClass('list-view');
				jQuery('#archive-product .shop-products').removeClass('grid-view');
				
				jQuery('.list-col4').addClass('col-xs-12 col-sm-4');
				jQuery('.list-col8').addClass('col-xs-12 col-sm-8');
			});
		});
		
		//Tooltip
		jQuery('.yith-wcwl-add-to-wishlist a').each(function(){
			roadtip(jQuery(this), 'html');
		});
		jQuery('.compare-button a').each(function(){
			roadtip(jQuery(this), 'html');
		});
		jQuery('.add_to_cart_inline a').each(function(){
			roadtip(jQuery(this), 'html');
		});
		jQuery('.quickviewbtn .quickview').each(function(){
			roadtip(jQuery(this), 'html');
		});
		jQuery('.sharefriend a').each(function(){
			roadtip(jQuery(this), 'html');
		});
		jQuery('.social-icons a').each(function(){
			roadtip(jQuery(this), 'title');
		});
		
		// Contact form show/hide
		jQuery('.contact-page .vc_column_container').each(function(){
			var contactBtn = jQuery(this).find('.contactbtn');
			var contactForm = jQuery(this).find('.wpcf7');
			contactBtn.click(function(event){
				event.preventDefault();
				
				if(contactForm.hasClass('show')){
					contactForm.removeClass('show');
				} else {
					contactForm.addClass('show');
				}
			});
		});
		
		//Quickview
		jQuery('.product-wrapper').each(function(){
			
			jQuery(this).on('mouseover click', function(){
				jQuery(this).addClass('hover');
			});
			jQuery(this).on('mouseleave', function(){
				jQuery(this).removeClass('hover');
			});
		});
			//Add quick view box
		jQuery('body').append('<div class="quickview-wrapper"><div class="quick-modal"><span class="closeqv"><i class="fa fa-times"></i></span><div id="quickview-content"></div><div class="clearfix"></div></div></div>');
			//show quick view
		jQuery('.quickview').each(function(){
			var quickviewLink = jQuery(this);
			var productID = quickviewLink.attr('data-quick-id');
			quickviewLink.on('click', function(event){
				event.preventDefault();
				
				jQuery('#quickview-content').html(''); /*clear content*/
				
				jQuery('body').addClass('quickview');
				window.setTimeout(function(){
					jQuery('.quickview-wrapper').addClass('open');
					jQuery('.quick-modal').addClass('loading');
					
					jQuery.post(
						ajaxurl, 
						{
							'action': 'product_quickview',
							'data':   productID
						}, 
						function(response){
							jQuery('#quickview-content').html(response);
							
							jQuery('.quick-modal').removeClass('loading');
							/*variable product form*/
							jQuery( '.variations_form' ).wc_variation_form();
							jQuery( '.variations_form .variations select' ).change();
							
							/*thumbnails carousel*/
							jQuery('.quick-thumbnails')
							jQuery('.quick-thumbnails').slick({
								slidesToScroll: 1,
								slidesToShow: 4
							});
							/*thumbnail click*/
							jQuery('.quick-thumbnails a').each(function(){
								var quickThumb = jQuery(this);
								var quickImgSrc = quickThumb.attr('href');
								
								quickThumb.on('click', function(event){
									event.preventDefault();
									
									jQuery('.main-image').find('img').attr('src', quickImgSrc);
								});
							});
							/*review link click*/
							
							jQuery('.woocommerce-review-link').on('click', function(event){
								event.preventDefault();
								var reviewLink = jQuery('.see-all').attr('href');
								
								window.location.href = reviewLink + '#reviews';
							});
						}
					);
				}, 300);
			});
		});
		jQuery('.closeqv').on('click', function(event){
			jQuery('.quickview-wrapper').removeClass('open');
			
			window.setTimeout(function(){
				jQuery('body').removeClass('quickview');
			}, 500);
		});
		
		//Fancy box
		jQuery(".fancybox").fancybox({
			openEffect: 'elastic',
			closeEffect: 'fade',
			beforeShow: function () {
				if (this.title) {
					// New line
					this.title += '<div class="fancybox-social">';
					
					// Add tweet button
					this.title += '<a href="https://twitter.com/share" class="twitter-share-button" data-count="none" data-url="' + this.href + '">Tweet</a> ';
					
					// Add FaceBook like button
					this.title += '<iframe src="//www.facebook.com/plugins/like.php?href=' + this.href + '&amp;layout=button_count&amp;show_faces=true&amp;width=500&amp;action=like&amp;font&amp;colorscheme=light&amp;height=23" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:110px; height:23px;" allowTransparency="true"></iframe></div>';
				}
			},
			afterShow: function() {
				// Render tweet button
				twttr.widgets.load();
			},
			helpers:  {
				title : {
					type : 'inside'
				},
				overlay : {
					showEarly : false
				}
			}
		});
		
		//show newsletter popup
		jQuery('.newsletterbtn').click(function(event){
			event.preventDefault();
			roadShowNLPopup();
		});
		jQuery('.newsletterpopup .close-popup').click(function(){
			roadHideNLPopup();
		});
		jQuery('.popupshadow').click(function(){
			roadHideNLPopup();
		});
		
		//Go to top
		jQuery('#back-top').on('click', function(){
			jQuery("html, body").animate({ scrollTop: 0 }, "slow");
		});
	});

	// Scroll
	var currentP = 0;
	jQuery(window).scroll(function(){
		var headerH = jQuery('.header-container').height();
		var navH = jQuery('.nav-container').height();
		headerH+=navH;
		var scrollP = jQuery(window).scrollTop();
		if(jQuery(window).width() > 1024){
			if(scrollP != currentP){
				//Back to top
				if(scrollP >= headerH){
					jQuery('#back-top').addClass('show');
					jQuery('.nav-container').addClass('ontop');
				} else {
					jQuery('#back-top').removeClass('show');
					jQuery('.nav-container').removeClass('ontop');
				}
				currentP = jQuery(window).scrollTop();
			}
		}
	});
	
})(jQuery);

"use strict";

//Product tabs carousel
function roadtabCarousel(element, itemnumber) {
	//jQuery(element).unslick();
	jQuery(element).slick({
		infinite: false,
		slidesToShow: itemnumber,
		slidesToScroll: 1,
		speed: 700,
		easing: 'linear',
		swipeToSlide: true,
		autoplaySpeed: 2000,
		responsive: [
			{
			  breakpoint: 1200,
			  settings: {
				slidesToShow: 3,
				slidesToScroll: 1
			  }
			},
			{
			  breakpoint: 992,
			  settings: {
				slidesToShow: 2,
				slidesToScroll: 1
			  }
			},
			{
			  breakpoint: 767,
			  settings: {
				slidesToShow: 2,
				slidesToScroll: 1
			  }
			},
			{
			  breakpoint: 600,
			  settings: {
				slidesToShow: 1,
				slidesToScroll: 1
			  }
			}
		]
	});
}

//remove item from mini cart by ajax
function roadMiniCartRemove(url, itemid) {
	jQuery('.mini_cart_content').addClass('loading');
	jQuery('.cart-form').addClass('loading');
	
	jQuery.get( url, function(data,status){
		if(status=='success'){
			//update mini cart info
			jQuery.post(
				ajaxurl,
				{
					'action': 'get_cartinfo'
				}, 
				function(response){
					var cartinfo = response.split("|");
					var itemAmount = cartinfo[0];
					var cartTotal = cartinfo[1];
					var orderTotal = cartinfo[2];
					
					jQuery('.cart-quantity').html(itemAmount);
					jQuery('.cart-total .amount').html(cartTotal);
					jQuery('.total .amount').html(cartTotal);
					
					jQuery('.cart-subtotal .amount').html(cartTotal);
					jQuery('.order-total .amount').html(orderTotal);
				}
			);
			//remove item line from mini cart & cart page
			jQuery('#mcitem-' + itemid).animate({'height': '0', 'margin-bottom': '0', 'padding-bottom': '0', 'padding-top': '0'});
			setTimeout(function(){
				jQuery('#mcitem-' + itemid).remove();
				jQuery('#lcitem-' + itemid).remove();
				//set new height
				var mCartHeight = jQuery('.mini_cart_inner').outerHeight();
				jQuery('.mini_cart_content').animate({'height': mCartHeight});
			}, 1000);
			
			jQuery('.mini_cart_content').removeClass('loading');
			jQuery('.cart-form').removeClass('loading');
		}
	});
}
function roadtip(element, content) {
	if(content=='html'){
		var tipText = element.html();
	} else {
		var tipText = element.attr('title');
	}
	element.on('mouseover', function(){
		if(jQuery('.roadtip').length == 0) {
			element.before('<span class="roadtip">'+tipText+'</span>');
			
			var tipWidth = jQuery('.roadtip').outerWidth();
			var tipPush = -(tipWidth/2 - element.outerWidth()/2);
			jQuery('.roadtip').css('margin-left', tipPush);
		}
	});
	element.on('mouseleave', function(){
		jQuery('.roadtip').remove();
	});
}
function roadShowNLPopup() {
	jQuery('.newsletterpopup').fadeIn();
	jQuery('.popupshadow').fadeIn();
}
function roadHideNLPopup(){
	jQuery('.newsletterpopup').fadeOut();
	jQuery('.popupshadow').fadeOut();
}