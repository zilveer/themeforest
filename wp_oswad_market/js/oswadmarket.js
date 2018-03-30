function em_search_bar(){
	jQuery(".search-input").val('search entries store ...');
	searchinput = jQuery(".search-input");
	searchvalue = searchinput.val();
	searchinput.click(function(){
		if (jQuery(this).val() === searchvalue) jQuery(this).val("");
	});
	searchinput.blur(function(){
		if (jQuery(this).val() === "") jQuery(this).val(searchvalue);
	});
}

if (typeof checkIfTouchDevice != 'function') { 
    function checkIfTouchDevice(){
        touchDevice = !!("ontouchstart" in window) ? 1 : 0; 
		if( jQuery.browser.wd_mobile ) {
			touchDevice = 1;
		}
		return touchDevice;      
    }
}

function number_animate(val_){
	var	text	= jQuery(val_),endVal	= 0,currVal	= 0,obj	= {};
	var value = jQuery(val_).text();
	obj.getTextVal = function() {
		return parseInt(currVal, 10);
	};

	obj.setTextVal = function(val) {
		currVal = parseInt(val, 10);
		text.text(currVal);
	};

	obj.setTextVal(0);
	currVal = 0; // Reset this every time
	endVal = value;

	TweenLite.to(obj, 2, {setTextVal: endVal, ease: Power2.easeInOut});
}

function sticky_main_menu( on_touch ){
		var _topSpacing = 0;
		var _topBegin = jQuery('#header .header-middle').height();
		if( jQuery('body').hasClass('logged-in') && jQuery('body').hasClass('admin-bar') && jQuery('#wpadminbar').length > 0 ){
			_topSpacing = jQuery('#wpadminbar').height();
		}
		if( jQuery('#header .header-top').length > 0 ){
			_topBegin += jQuery('#header .header-top').height();
		}
		
		if( jQuery('#header .header-logo-bottom').length > 0 ){
			_topBegin += jQuery('#header .header-logo-bottom').height();
		}
		
		setTimeout(function(){
			if( !on_touch && jQuery(window).width() > 768 ){
				jQuery("#header").sticky({
					topSpacing:_topSpacing
					,topBegin: _topBegin
					,scrollOnTop : function (){
						var _container_offet = jQuery('.header-bottom-content').offset();
						setTimeout(function(){
							jQuery('.menu-item-level0.wd-mega-menu.fullwidth-menu,.menu-item-level0.wd-mega-menu.columns-6').each(function(index,value){
								var _cur_offset = jQuery(value).offset();
								var _margin_left = _cur_offset.left - _container_offet.left ;
								_margin_left = _margin_left - (jQuery('.header-bottom-content').outerWidth() - jQuery('.header-bottom-content').width() ) /2;//Bo + 1 cho theme khac oswad
								jQuery(value).children('ul.sub-menu').css('width',jQuery('.header-bottom-content').width()).css('left','-'+_margin_left +'px');
							});	
						},0);
					}
					,scrollOnBottom : function (){
						var _container_offet = jQuery('.header-bottom-content').offset();
						setTimeout(function(){
							jQuery('.menu-item-level0.wd-mega-menu.fullwidth-menu,.menu-item-level0.wd-mega-menu.columns-6').each(function(index,value){
								var _cur_offset = jQuery(value).offset();
								var _margin_left = _cur_offset.left - _container_offet.left ;
								_margin_left = _margin_left - (jQuery('.header-bottom-content').outerWidth() - jQuery('.header-bottom-content').width() ) /2;//Bo + 1 cho theme khac oswad
								jQuery(value).children('ul.sub-menu').css('width',jQuery('.header-bottom-content').width()).css('left','-'+_margin_left +'px');
							});	
						},0);
					}					
				});
			}
		},1000);
		
		setTimeout(function(){
			if( typeof _sticky_menu_class != "undefined" )
				jQuery("#header-sticky-wrapper").addClass(_sticky_menu_class);
		},1200);
		
		jQuery(window).bind( 'resize', jQuery.debounce( 250, function(){
			var _header_height = jQuery("#header").outerHeight();
			jQuery("#header-sticky-wrapper").height( _header_height );
		}));
		
		jQuery(window).bind('scroll', function(){
			if ( !(jQuery.browser.msie && jQuery.browser.version < 10) ) {
				var scrollTop = jQuery(this).scrollTop();
				if( scrollTop < _topBegin){
					var _header_height = jQuery("#header").outerHeight();
					jQuery("#header-sticky-wrapper").height( _header_height );
				}
			}
		});
		
}




function hexToRgb(hex) {
    // Expand shorthand form (e.g. "03F") to full form (e.g. "0033FF")
    var shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
    hex = hex.replace(shorthandRegex, function(m, r, g, b) {
        return r + r + g + g + b + b;
    });

    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    return result ? {
        r: parseInt(result[1], 16),
        g: parseInt(result[2], 16),
        b: parseInt(result[3], 16)
    } : null;
}

function set_header_bottom(){
    var header_bottom_height = jQuery(".header-bottom").outerHeight();
    //console.log(header_bottom_height);
    jQuery(".header-bottom").css("bottom","-"+header_bottom_height+"px");
    jQuery(".main-slideshow").css("min-height",header_bottom_height + "px");
}

function set_cloud_zoom(){
	var clz_width = jQuery('#qs-zoom,.wd-qs-cloud-zoom,.cloud-zoom, .cloud-zoom-gallery').width();
	var clz_img_width = jQuery('#qs-zoom,.wd-qs-cloud-zoom,.cloud-zoom, .cloud-zoom-gallery').children('img').width();
	var cl_zoom = jQuery('#qs-zoom,.wd-qs-cloud-zoom,.cloud-zoom, .cloud-zoom-gallery').not('.on_pc');
	var temp = (clz_width-clz_img_width)/2;
	if(cl_zoom.length > 0 ){
		cl_zoom.data('zoom',null).siblings('.mousetrap').unbind().remove();
		cl_zoom.CloudZoom({ 
			adjustX:temp	
		});
	}
}

function get_layout_config( container_width, number_item){
	ret_value = new Array(283,'100%');
	if( container_width >= 960 ){
		var _num_show = Math.min(number_item,4);
		ret_value[1] = _num_show*25 + "%";
		return ret_value;
	}
	if( container_width > 600 && container_width < 960 ){
		var _num_show = Math.min(number_item,3);
		ret_value[0] = 300;
		ret_value[1] = _num_show*33.3333333333 + "%";
		return ret_value;
	}
	if( container_width <= 500 && container_width > 300 ){
		ret_value[0] = 300;
		var _num_show = Math.min(number_item,2);
		ret_value[1] = _num_show*50 + "%";
		return ret_value;
	}
	ret_value[0] = 300;
	return ret_value;
}


/*function onSizeChange(windowWidth){
	if( windowWidth >= 768 ) {
			jQuery('a.block-control').removeClass('active').hide();
			jQuery('a.block-control').parent().siblings().show();
	}
	if( windowWidth < 768 ) {
			jQuery('a.block-control').removeClass('active').show();
			jQuery('a.block-control').parent().siblings().hide();
	}		

}*/


function change_cart_items_mobile(){
	var html_cart = jQuery( '.wd_tini_cart_wrapper .cart_size_value_head').html();
	jQuery('.mobile_cart_container .cart_size_value_head').html('');
	jQuery('.mobile_cart_container .cart_size_value_head').html(html_cart);
	/*
	var _cart_items = parseInt(jQuery( ".wd_tini_cart_wrapper .cart_size_value_head:first .num_item" ).text());
	_cart_items = isNaN(_cart_items) ? 0 : _cart_items;
	jQuery('.mobile_cart_container .cart_size_value_head .num_item').text(_cart_items);
	*/
}
function home_parallax_sroll(element){
	jQuery(element).each(function( i, val){
		var offset = 0;
		offset = jQuery(window).scrollTop() - jQuery(val).offset().top;
		offset = offset * 0.5;
		jQuery(val).css({'background-position':'50%' + offset + 'px'});
	});
}
function home_parallax(element){
	home_parallax_sroll(element); 
	jQuery(window).scroll(function() {
		home_parallax_sroll(element); 
	});   	
}
function toggle_menu_open(){
	
	var admin_bar_height = 0;
	if( jQuery('#wpadminbar').length > 0 ){
		admin_bar_height = jQuery('#wpadminbar').height(); 
	}
	
	jQuery('.toggle-menu-wrapper').css({'top': admin_bar_height});
	jQuery(window).scroll(function(){
		var window_width = jQuery(window).width();
		if( jQuery(this).scrollTop() == 0 || window_width >= 600 ){
			jQuery('.toggle-menu-wrapper').css({'top': admin_bar_height});
		}
		else{
			jQuery('.toggle-menu-wrapper').css({'top': 0});
		}
	});
	
	var window_height = jQuery(window).height();
	
	jQuery(".mobile-main-menu.toggle-menu").css({'height': window_height - 60 - admin_bar_height, 'overflow-y': 'auto'});
	jQuery(".toggle-menu-wrapper").css({'height': window_height + 100});
	
}
function toggle_menu_close(){
	
}

function wd_bind_added_to_cart(){
	jQuery('ul.products li.product .product_item_wrapper').each(function(index,value){
			jQuery(value).unbind('wd_added_to_cart');
			jQuery(value).bind('wd_added_to_cart', function() {
				var _loading_mark_up = jQuery(value).find('.loading-mark-up').remove();
				jQuery(value).removeClass('adding_to_cart').addClass('added_to_cart').append('<span class="loading-text"></span>');
				var _load_text = jQuery(value).find('.loading-text').css({'width' : jQuery(value).width()+ 18 +'px','height' : jQuery(value).height()+ 10 +'px'}).delay(2000).fadeOut();
				setTimeout(function(){
					_load_text.hide().remove();
				},2000);
				//delete view cart		
				jQuery('.list_add_to_cart .added_to_cart').remove();
			});	
		});	
}
function wd_update_header_tini_wishlist(){
	if( typeof _ajax_uri == 'undefined')
		return;
	jQuery('.wd_tini_wishlist_wrapper').addClass("loading");
	jQuery.ajax({
		type : 'POST'
		,url : _ajax_uri	
		,data : {action : 'update_tini_wishlist'}
		,success : function(respones){
			if( jQuery('.wd_tini_wishlist_wrapper').length > 0 ){
				jQuery('.wd_tini_wishlist_wrapper').html(respones);
			}
			jQuery('.wd_tini_wishlist_wrapper').removeClass("loading");
		}
	});
}


jQuery(document).ready(function($) {
		"use strict";
        /* Paralax */
		home_parallax('.background_full_screen,.fourth-footer-widget-area,.bg-full-paralax');
		/********************** menu phone ***************************/
		jQuery('.toggle-menu-control-open,.toggle-menu-control-close').click(function(){
			if( !jQuery('.toggle-menu-wrapper').hasClass('active') ){
				jQuery('.toggle-menu-wrapper').css({"width":"75%"});
				jQuery('.toggle-menu-wrapper').css({"height":jQuery('body').height()});
				jQuery('.toggle-menu-wrapper').css({"left":"-75%"});
				
				TweenMax.to( jQuery('.toggle-menu-wrapper'), .6, { css:{left: "0px"},  ease:Sine.easeInOut, onComplete:toggle_menu_open });
				TweenMax.to( jQuery('.wd-content,.phone-header-bar-wrapper'), .6, { css:{ left:"75%"},  ease:Sine.easeInOut });
				
			}else{
				TweenMax.to( jQuery('.toggle-menu-wrapper'), .6, { css:{ left:"-75%"},  ease:Sine.easeInOut, onComplete:toggle_menu_close });
				TweenMax.to( jQuery('.wd-content,.phone-header-bar-wrapper'), .6, { css:{ left:"0px"},  ease:Sine.easeInOut });
			}
			jQuery('.toggle-menu-wrapper').toggleClass('active');
		});
		/********************** end menu phone ***************************/
		
		var on_touch = checkIfTouchDevice();
		
		if (jQuery.browser.msie && jQuery.browser.version <= 10) {
			jQuery("html").addClass('ie ie' + parseInt(jQuery.browser.version));
		} else {
			if (jQuery("html").attr('id') == 'wd_ie' && jQuery.browser.version == 11) {
				jQuery("html").addClass("ie ie11");
			}
		}

		/*************** Start Woo Add On *****************/
		jQuery('body').bind( 'adding_to_cart', function() {
			jQuery('.cart_dropdown').addClass('disabled working');
		} );		
        
        //set min height main slider
        var header_bottom_height = jQuery(".header-bottom").outerHeight();
		jQuery(".main-slideshow").css("min-height",header_bottom_height + "px");
        
        
        //social
        jQuery("ul.social-share > li > a > span").css("position","relative").css('display', 'inline-block').css("left","500px").css("visibility","0");
		jQuery("ul.social-share > li > a > span").each(function(index,value){
			TweenMax.to( jQuery(value),0.0, { css:{left:"0px",opacity:1 },  ease:Power2.easeInOut ,delay:index*0.9});
		});
		      
        
		jQuery('.add_to_cart_button').live('click',function(event){
			var _li_prod = jQuery(this).parent().parent().parent();
			_li_prod.trigger('wd_adding_to_cart');
		});
		
		jQuery('ul.products li.product,div.products div.product').bind('wd_adding_to_cart', function() {
			jQuery(this).addClass('adding_to_cart').append('<div class="loading-mark-up"><div class="loading-image"></div></div>');
			var _loading_mark_up = jQuery(this).find('.loading-mark-up').css({'width' : jQuery(this).width()+'px','height' : jQuery(this).height()+'px'}).show();
			var isiPhone = navigator.userAgent.toLowerCase().indexOf("iphone");
			if( isiPhone > -1 ){
				setTimeout(function(){
					jQuery('body').trigger( 'wd_added_to_cart_on_idevice');
				}, 2000);
			}
		});
		wd_bind_added_to_cart();
		
		jQuery('body').bind( 'added_to_cart wd_added_to_cart_on_idevice', function(event) {
			if( typeof _ajax_uri == "undefined" )
				return;
			var _added_btn = jQuery('ul.products li.product,div.products div.product').find('.add_to_cart_button.added').removeClass('added').addClass('added_btn');
			var _added_li = _added_btn.parent().parent().parent();
			_added_li.each(function(index,value){
				jQuery(value).trigger('wd_added_to_cart');
			});
			
			jQuery('.wd_tini_cart_wrapper').addClass('loading-cart');
			
			jQuery.ajax({
				type : 'POST'
				,url : _ajax_uri	
				,data : {action : 'update_tini_cart'}
				,success : function(respones){
					if( jQuery('.shopping-cart-wrapper').length > 0 ){
						jQuery('.shopping-cart-wrapper').html(respones);
						jQuery('.cart_dropdown,.form_drop_down').hide();
						jQuery('body').trigger('mini_cart_change');
						change_cart_items_mobile();
						setTimeout(function(){
							jQuery('.wd_tini_cart_wrapper').removeClass('loading-cart');
						},1000);
					}
				}
			});			
		} );			
		jQuery('.cart_dropdown,.form_drop_down').hide();
		change_cart_items_mobile();

		
		jQuery('.wd_tini_cart_wrapper,.wd_tini_account_wrapper').hoverIntent(
			function(){
				jQuery(this).children('.drop_down_container').slideDown(300);
			}
			,function(){
				jQuery(this).children('.drop_down_container').slideUp(300);
			}
		
		);

		jQuery('body').live('mini_cart_change',function(){
			jQuery('.wd_tini_cart_wrapper,.wd_tini_account_wrapper').hoverIntent(
				function(){
					jQuery(this).children('.drop_down_container').slideDown(300);
				}
				,function(){
					jQuery(this).children('.drop_down_container').slideUp(300);
				}
			
			);
		});	
		
		jQuery(".mobile_cart_container").live('click',function(){
			window.location.href = jQuery(this).find(".cart_size a:first").attr("href");
		});
			
		
		/*Tini wishlist update*/
		jQuery('body').bind('added_to_wishlist',function(){
			wd_update_header_tini_wishlist();
		});
        
		
		jQuery('#yith-wcwl-form table tbody tr td a.remove, #yith-wcwl-form table tbody tr td a.add_to_cart_button').live('click',function(){
			var _old_num_product = jQuery('#yith-wcwl-form table tbody tr[id^="yith-wcwl-row"]').length;
			var _count = 1;
			var _time_interval = setInterval(function(){
				_count++;
				var _new_num_product = jQuery('#yith-wcwl-form table tbody tr[id^="yith-wcwl-row"]').length;
				if( _old_num_product != _new_num_product || _count == 20 ){
					clearInterval(_time_interval);
					wd_update_header_tini_wishlist();
				}
			},500);
		});
		
		/* Fix Wishlist Label */
		if( jQuery('.woocommerce-message').length > 0 && typeof yith_wcwl_l10n != 'undefined' ){
			yith_wcwl_l10n.labels.added_to_cart_message = '<div class="woocommerce-message">' + jQuery('.woocommerce-message').html() + '</div>';
		}
		
		
        /*detail page*/
        if(jQuery("button.virtual.single_add_to_cart_button").length > 0){
			 jQuery("button.virtual.single_add_to_cart_button").click(function(){
    			 if(jQuery("div.quantity.buttons_added:visible").length > 0) {
    				    jQuery("form.product_detail").submit(); 
                    }
			 });
		}
        jQuery('.variations select').on('change',function(){
			setTimeout(function(){ 
				if(jQuery('div.single_variation_wrap').css('display') == 'block') {
					jQuery('button.single_add_to_cart_button.hidden-phone').removeClass('variable_hidden');
				} else {
					jQuery('button.single_add_to_cart_button.hidden-phone').addClass('variable_hidden');
				}
			}, 500);
		});
		
		setTimeout(function () {
			jQuery("div.shipping-calculator-form").show(400);
		}, 1500);
		
        
        /***** W3 Total Cache & Wp Super Cache Fix *****/
		if( typeof wc_add_to_cart_params != 'undefined' ){
			jQuery('body').trigger('added_to_cart');
		}
        /***** End Fix *****/
        
		/***** Start Re-init Cloudzoom on Variation Product  *****/
		jQuery('form.variations_form').live('found_variation',function( event, variation ){
			jQuery('#qs-zoom,.wd-qs-cloud-zoom,.cloud-zoom, .cloud-zoom-gallery').CloudZoom({}); 
		}).live('reset_image',function(){
			jQuery('#qs-zoom,.wd-qs-cloud-zoom,.cloud-zoom, .cloud-zoom-gallery').CloudZoom({}); 
		});
		/***** End Re-init Cloudzoom on Variation Product  *****/        
        
        /*************** End Woo Add On *****************/
        
        /*************** Disable QS in Main Menu *****************/
        jQuery('ul.menu').find('ul.products').addClass('no_quickshop');
        /*************** Disable QS in Main Menu *****************/
	 
        
		//product_label
		
		
		// _s_controller = jQuery.superscrollorama({triggerAtCenter: true});
		// jQuery('span.product_label').each(function(index,value){
			// _ele_bgcolor = jQuery(value).css('background-color');
			// _s_controller.addTween(jQuery(value), TweenMax.to( jQuery(value), .5, {css:{scare:1.5,opacity:1,top:26,height:"60px",width:"60px",right:-30,boxShadow: "0px 0px 6px 3px "+_ele_bgcolor,fontSize : 16 }, immediateRender:false,yoyo:true,repeat:1, ease:Power3.easeInOut}),100,0,true);
		// });
		
		
		// jQuery('.custom_category_shortcode > ul.products').children('li.product').hover(
			// function(){
				// TweenMax.to( jQuery(this), .9, {css:{opacity:1}})
			// }
			// ,function(){
				// TweenMax.to( jQuery(this), .9, {css:{opacity:0.7}})
			// }
		// );
		jQuery('div.custom_category_shortcode').each(function(index,value){
			// jQuery(value).children('ul.products').children('li.product').not('.featured_product_wrapper').each(function(li_index,li_value){
				// _s_controller.addTween(jQuery(li_value), TweenMax.from( jQuery(li_value), .9, {css:{opacity:0.7}, immediateRender:true, ease:Power3.easeInOut}));
			// });		
			// var _big_ele = jQuery(value).find('.featured_product_wrapper');
			// var _haft_container_width = _big_ele.width()/2;
			// _s_controller.addTween(jQuery(_big_ele), TweenMax.from( jQuery(_big_ele), .9, {css:{left:_haft_container_width}, immediateRender:true, ease:Power3.easeInOut}));
			// jQuery(value).children('ul.products').children('li.product').not('.featured_product_wrapper').each(function(li_index,li_value){
				// _s_controller.addTween(jQuery(li_value), TweenMax.from( jQuery(li_value), .9, {css:{opacity:0,right:"-100px"}, immediateRender:true, ease:Power3.easeInOut}));
			// });
		});
		
		
		/*************** End Woo Add On *****************/
		
		
		/*************** Start Product Rotate On *****************/
		
		// jQuery('li.product > a').hover(
			// function(event){
				// // TweenMax.to(jQuery(this).children('.product-image-front'), 3, {rotationY:180,ease:Power2.easeInOut});
				// // TweenMax.to(jQuery(this).children('.product-image-back'), 3, {css:{ opacity:1 },shortRotation:{rotationY:0,rotationX:0},ease:Power2.easeInOut });
				// // TweenMax.to( jQuery(value), 0.9, { css:{ right:"0px",opacity:1 },  ease:Power2.easeInOut ,delay:index*0.9});
			// }
			// ,function(event){
				// // TweenMax.to(jQuery(this).children('.product-image-front'), 3, {rotationY:0, transformOrigin:"left  50% -200"});
				// // TweenMax.to(jQuery(this).children('.product-image-back'), 3, {rotationY:180, transformOrigin:"left  50% -200"});
			// }
		// );
	
		
		/*************** End Product Rotate On *****************/
		
		
		if (jQuery.browser.msie && ( parseInt( jQuery.browser.version, 10 ) == 7 )){
			alert("Your browser is too old to view this interactive experience. You should take the next 30 seconds or so and upgrade your browser! We promise you'll thank us after doing so in having a much better and safer web browsing experience! ");
		}

		
		// jQuery('#MobileMainNavigation').live('change',function(event) {	
			// event.preventDefault();
			// window.location.href = jQuery(this).find('option:selected').val();
			
		// });
		//em_search_bar();
		var windowWidth = jQuery(window).width();
		
		setTimeout(function () {
			  onSizeChange(windowWidth);
		}, 1000);	
		
        jQuery('a.block-control').click(function(){
            jQuery(this).parent().siblings().slideToggle(300);
            jQuery(this).toggleClass('active');
            return false;
        });
		
		
	
		
		jQuery('.tabbable > ul.nav.nav-tabs > li').bind('click',function(e){
			//e.isDefaultPrevented();
			if( !jQuery(this).hasClass('active') ){
				jQuery(".tabbable").triggerHandler('tabs_change');
			}
			//e.isPropagationStopped()
		});

		
		jQuery('li.shortcode').hover(function(){
			jQuery(this).addClass('shortcode_hover')},function(){jQuery(this).removeClass('shortcode_hover');});
		



		
		////////// Generate Tab System /////////
		if(jQuery('.tabs-style').length > 0){
			jQuery('.tabs-style').each(function(){
				var ul = jQuery('<ul></ul>');
				var divPanel = jQuery('<div></div>');
				var liChildren = jQuery(this).find('li.tab-item');
				var length = liChildren.length;
				divPanel.addClass('panel');
				jQuery(this).find('li.tab-item').each(function(index){
					jQuery(this).children('div').appendTo(divPanel);
					if(index == 0)
						jQuery(this).addClass('first');
					if(index == length - 1)
						jQuery(this).addClass('last');
					jQuery(this).appendTo(ul);
					
				});
				jQuery(this).append(ul);
				jQuery(this).append(divPanel);
				
					jQuery( this ).tabs({ fx: { opacity: 'toggle', duration:'slow'} }).addClass( 'ui-tabs-vertical ui-helper-clearfix' );
				
			});		
		}
		

		
		// Toggle effect for ew_toggle shortcode
		jQuery( '.toggle_container a.toggle_control' ).click(function(){
			if(jQuery(this).parent().parent().parent().hasClass('show')){
				jQuery(this).parent().parent().parent().removeClass('show');
				jQuery(this).parent().parent().parent().addClass('hide');
				jQuery(this).parent().parent().children('.toggle_content ').hide('slow');
			}
			else{
				jQuery(this).parent().parent().parent().addClass('show');
				jQuery(this).parent().parent().parent().removeClass('hide');
				jQuery(this).parent().parent().children('.toggle_content ').show('slow');
			}
				
		});
		
        
        
        //fancy box
        var fancy_wd = jQuery("a.fancybox").fancybox({
			// 'openEffect'	: 'elastic'
			// ,'closeEffect'	: 'elastic'
			// ,'openEasing'   : 'easeOutBack'
			// ,'closeEasing'  : 'easeOutBack'
			// ,'nextEasing'   : 'easeOutBack'
			// ,'prevEasing'	: 'easeOutBack'		
			// 'openSpeed'    : 500
			// ,'openSpeed'	: 500
			// ,'nextSpeed'	: 1000
			// ,'prevSpeed'    : 1000
			'scrolling'	: 'no'
			,'mouseWheel'	: false

			,beforeLoad  : function(){
					tmp_href = this.href;
					if( this.href.indexOf('youtube.com') >= 0 || this.href.indexOf('youtu.be') >= 0 ){
						this.type = 'iframe';
						this.scrolling = 'no';
						//&html5=1&wmode=opaque
						this.href = this.href.replace(new RegExp("watch\\?v=", "i"), 'embed/') + '?autoplay=1';
					}
					else if( this.href.indexOf('vimeo.com') >= 0 ){
						this.type = 'iframe';
						this.scrolling = 'no';					
						//this.href = this.href.replace(new RegExp("([0-9])","i"),'moogaloop.swf?clip_id=$1') + '&autoplay=1';
						var regExp = /http:\/\/(www\.)?vimeo.com\/(\d+)($|\/)/;
						var match = this.href.match(regExp);
						this.href = 'http://player.vimeo.com/video/' + match[2] + '?portrait=0&color=ffffff';
					}
					else{
						//this.type = null;
					}
					
					
			}
			,afterClose : function(){
					this.href = tmp_href;
			}		
			,afterShow  : function(){
				jQuery('.fancybox-wrap').wipetouch({
					tapToClick: true, // if user taps the screen, triggers a click event
					wipeLeft: function(result) { 
						jQuery.fancybox.next();
					},
					wipeRight: function(result) {
						jQuery.fancybox.prev();
					}
				});					
				if( jQuery('.fancybox-prev-clone').length <= 0 )
					jQuery('.fancybox-prev').clone().removeClass('fancybox-nav fancybox-prev').addClass('fancybox-prev-clone').appendTo(".fancybox-overlay");
				
				if( jQuery('.fancybox-next-clone').length <= 0 )
					jQuery('.fancybox-next').clone().removeClass('fancybox-nav fancybox-next').addClass('fancybox-next-clone').appendTo(".fancybox-overlay");
				
				if( jQuery('.fancybox-close-clone').length <= 0 )
					jQuery('.fancybox-close').clone().removeClass('fancybox-item fancybox-close').addClass('fancybox-close-clone').appendTo(".fancybox-overlay");
			
				if( jQuery('.fancybox-title-clone').length <= 0 )
					jQuery('.fancybox-title').clone().addClass('fancybox-title-clone').appendTo(".fancybox-overlay");
				else{
					jQuery('.fancybox-title-clone').html( jQuery('.fancybox-wrap').find('.fancybox-title').html() );
				}	
				jQuery('.fancybox-wrap').find('.fancybox-title').hide();				
				
				jQuery('.fancybox-wrap').find('.fancybox-prev').hide();
				jQuery('.fancybox-wrap').find('.fancybox-next').hide();
				jQuery('.fancybox-wrap').find('.fancybox-close').hide();
				
			}			
			
		}); 
        
        jQuery('.fancybox-prev-clone').live('click',function(){
			jQuery('.fancybox-wrap').find('.fancybox-prev').trigger('click');
		});
		jQuery('.fancybox-next-clone').live('click',function(){
			jQuery('.fancybox-wrap').find('.fancybox-next').trigger('click');
		});
		jQuery('.fancybox-close-clone').live('click',function(){
			jQuery('.fancybox-wrap').find('.fancybox-close').trigger('click');
		});
        
        

		jQuery('p:empty').remove();
		
		// button state demo
		jQuery('.btn-loading')
		  .click(function () {
			var btn = jQuery(this)
			btn.button('loading')
			setTimeout(function () {
			  btn.button('reset')
			}, 3000)
		  });
		
		if( jQuery('html').offset().top < 100 ){
			jQuery("#to-top").hide();
			jQuery("#to-top").addClass("off");
		}
		jQuery(window).scroll(function () {
			
			if (jQuery(this).scrollTop() > 100) {
				//jQuery("#to-top").fadeIn();
				jQuery("#to-top").removeClass("off");
				jQuery("#to-top").addClass("on");
			} else {
				jQuery("#to-top").removeClass("on");
				jQuery("#to-top").addClass("off");
				//jQuery("#to-top").fadeOut();
			}
		});
		jQuery('.scroll-button').click(function(){
			jQuery('body,html').animate({
			scrollTop: '0px'
			}, 1000);
			return false;
		});			

		
		jQuery('#myTab a').click(function (e) {
			e.preventDefault();
			jQuery(this).tab('show');
		});
	
		

			
		jQuery('.carousel').each(function(index,value){
			jQuery(value).wipetouch({
				tapToClick: false, // if user taps the screen, triggers a click event
				wipeLeft: function(result) { 
					jQuery(value).find('a.carousel-control.right').trigger('click');
					//jQuery(value).carousel('next');
				},
				wipeRight: function(result) {
					jQuery(value).find('a.carousel-control.left').trigger('click');
					//jQuery(value).carousel('prev');
				}
			});	
		});
		
		
		// jQuery("ul.social-share > li > a > span").css("position","relative").css("right","500px").css("opacity","0");
		// jQuery("ul.social-share > li > a > span").each(function(index,value){
			// TweenMax.to( jQuery(value), 0.9, { css:{ right:"0px",opacity:1 },  ease:Power2.easeInOut ,delay:index*0.9});
		// });
		
        set_cloud_zoom();
		// Set menu on top
		if(typeof(_enable_sticky_menu) != "undefined"){
			if(_enable_sticky_menu==1)
				sticky_main_menu( on_touch );
		}
		else{
			sticky_main_menu( on_touch );
		}
		if( on_touch == 0 ){
			jQuery(window).bind('resize',jQuery.throttle( 250, 
				function(){
					if( !( jQuery.browser.msie &&  parseInt( jQuery.browser.version, 10 ) <= 7 ) ){
						onSizeChange( jQuery(window).width() );
                        set_header_bottom();
						set_cloud_zoom();
						menu_change_state( jQuery('body').innerWidth() );	
					}
				})
			);
		}else{
			jQuery(window).bind('orientationchange',function(event) {	
					onSizeChange( jQuery(window).width() );
                    set_header_bottom();
					set_cloud_zoom();
					menu_change_state( jQuery('body').innerWidth() );				
			});
		}

		if(jQuery('body.single-post').length > 0)	{
			var left_height = 0;
			var  right_height = 0;
			var  main_height = 0;
			if(jQuery('#left-sidebar').length > 0 )
				left_height = jQuery('#left-sidebar').height();
			if(jQuery('#right-sidebar').length > 0 )
				right_height = jQuery('#right-sidebar').height();
			if(jQuery('#main').length > 0 )
				main_height = jQuery('#main').height();
			var max = Math.max(left_height,right_height,main_height);	
			
			if(jQuery('#left-sidebar').length > 0 )
				jQuery('style#custom-background-css').append('#left-sidebar:after{height:'+max+'px;}');
            if(jQuery('#right-sidebar').length > 0 )
				jQuery('style#custom-background-css').append('#right-sidebar:before{height:'+max+'px;}');
		}
        
		jQuery(".right-sidebar-content > ul > li:first").addClass('first');
		jQuery(".right-sidebar-content > ul > li:last").addClass('last');
		
		
		jQuery(".product_upsells > ul").each(function( index,value ){
			jQuery(value).children("li:last").addClass('last');
		});
		

		jQuery("ul.product_list_widget").each(function(index,value){
			jQuery(value).children("li:first").addClass('first');
			jQuery(value).children("li:last").addClass('last');
		});
		jQuery(".related.products > ul > li:last").addClass('last');
		
		//jQuery(".circle_small_holder").each(function(index,value){
			//jQuery(value).addClass('wd_animate');
			//TweenMax.to( jQuery(value),0.0, { css:{opacity:1},  ease:Power2.easeInOut ,delay:index*0.9});
		//});
		
		jQuery("a.wd-prettyPhoto").prettyPhoto({
				social_tools: false,
				theme: 'pp_woocommerce',
				horizontal_padding: 40,
				opacity: 0.9,
				deeplinking: false
			});
			
		/**/
		 jQuery('#products-tabs-wrapper > ul.nav.nav-tabs > li').bind('click',function(){
			 if(!jQuery(this).hasClass("active")){
				  jQuery("#products-tabs-wrapper").trigger('tabs_change');
			  }
		 });
		 
		 jQuery(".payment_methods input.input-radio").live("click", function(){
			if (jQuery(this).is(':checked')) {
				jQuery(".payment_methods li.active").removeClass("active");
                jQuery(this).parents("li").addClass("active");
			}
		 });
		 
		 /* Search product by category */
		 if( typeof jQuery.fn.select2 == 'function' ){
			jQuery(".wd_search_form_by_category select.select_category").select2();
			jQuery('body:not(.select2-choice)').bind('click', function(){
				jQuery('.select2-container').removeClass('select2-dropdown-open');
				jQuery('.select2-drop').hide();
			});
		}

		custom_mobile_menu();		
		fix_contact_form_on_dialog();
		wd_custom_yith_compare();
		
		/* FIX FILTER PRICE WIDGET */
		setTimeout(function () {
		
			if( jQuery('.shipping-calculator-form').length > 0 ){
				jQuery('.shipping-calculator-form').show();
			}
		}, 1000);
		
		/* Milestone */
		if( typeof jQuery.fn.waypoint == 'function' && typeof jQuery.fn.countTo == 'function' && 
			typeof _on_phone != 'undefined' && !_on_phone && typeof _on_tablet != 'undefined' && !_on_tablet ){
			setTimeout( function(){
				jQuery('.wd_milestone').each(function(index, element){
					jQuery(element).waypoint(function(direction) {
						if( jQuery(element).hasClass('loaded') ){
							return;
						}
						var end_num = parseInt(jQuery(element).find('.number').text());
						jQuery(element).find('.number').countTo({
							from: 0
							,to: end_num
							,speed: 1500
							,refreshInterval: 30
						});
						jQuery(element).addClass('loaded');
					}, { offset: '105%', triggerOnce: true });
				});
			}, 100);
		}
		
		/* Content animaion */
		if( typeof jQuery.fn.waypoint == 'function' && typeof _on_phone != 'undefined' && !_on_phone && typeof _on_tablet != 'undefined' && !_on_tablet ){
			setTimeout(function(){
				 wd_content_animation();
			}, 100);
		}
		
		$(window).resize(function(){
			wd_content_animation();
		});
		
		/* One page - SmoothScroll */
		if( typeof $.smoothScroll == 'function' ){
			$('.wd-mega-menu-wrapper a, .mobile-main-menu a').bind('click', function(e){
				var href = $(this).attr('href');
				if( href.length >= 1 && href.substring(0, 1) == '#' ){
					e.preventDefault();
					
					var offset = -150;
					var is_sticky = $('.is-sticky').length > 0;
					var header = $('#header');
					if( is_sticky ){
						if( header.length > 0 ){
							offset = - (header.height() + 50);
						}
					}					
					
					$.smoothScroll({
						offset : offset
						,scrollTarget: href
						,speed: 1000
					});
		
				} 
			});
		}
		
		/** WooCommerce Increase Quantity **/
		// Quantity buttons
		$( 'div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)' ).addClass( 'buttons_added' ).append( '<input type="button" value="+" class="plus" />' ).prepend( '<input type="button" value="-" class="minus" />' );

		$( document ).on( 'click', '.plus, .minus', function() {

			// Get values
			var $qty		= $( this ).closest( '.quantity' ).find( '.qty' ),
				currentVal	= parseFloat( $qty.val() ),
				max			= parseFloat( $qty.attr( 'max' ) ),
				min			= parseFloat( $qty.attr( 'min' ) ),
				step		= $qty.attr( 'step' );

			// Format values
			if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
			if ( max === '' || max === 'NaN' ) max = '';
			if ( min === '' || min === 'NaN' ) min = 0;
			if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

			// Change the value
			if ( $( this ).is( '.plus' ) ) {

				if ( max && ( max == currentVal || currentVal > max ) ) {
					$qty.val( max );
				} else {
					$qty.val( currentVal + parseFloat( step ) );
				}

			} else {

				if ( min && ( min == currentVal || currentVal < min ) ) {
					$qty.val( min );
				} else if ( currentVal > 0 ) {
					$qty.val( currentVal - parseFloat( step ) );
				}

			}

			// Trigger change event
			$qty.trigger( 'change' );

		});
		
		/* Fix Payment Methods Selected */
		$( '.payment_methods input.input-radio' ).live('click', function(){
			var target_payment_box = $( 'div.payment_box.' + $( this ).attr( 'ID' ) );

			if ( $( this ).is( ':checked' ) && ! target_payment_box.is( ':visible' ) ) {
				$( 'div.payment_box' ).filter( ':visible' ).slideUp( 250 );

				if ( $( this ).is( ':checked' ) ) {
					$( 'div.payment_box.' + $( this ).attr( 'ID' ) ).slideDown( 250 );
				}
			}
		});
		
		/* Blog image slider */
		$('.blog-image-slider').owlCarousel({
			loop : true
			,items : 1
			,nav : true
			,dots : false
			,navSpeed : 1000
			,slideBy: 1
			,rtl:jQuery('body').hasClass('rtl')
			,navRewind: false
			,autoplay: true
			,autoplayTimeout: 5000
			,autoplayHoverPause: true
			,autoplaySpeed: false // or number
			,mouseDrag: true
			,touchDrag: true
			,responsiveRefreshRate: 1000
			,onInitialized: function(){
				$('.blog-image-slider').removeClass('loading');
			}
		});
		
		/* Single Post Video */
		$('.single-post .thumbnail > iframe, .blog-personal-template .list-posts .thumbnail > iframe').each(function(){
			$(this).parent('.thumbnail').addClass('video');
		});
	
});

function wd_content_animation(){
	jQuery('.has-animation').each(function( index, element ) {
					
		if( jQuery(element).css('opacity') == 1 ){
			return;
		}
		
		if( jQuery.browser.msie && parseInt( jQuery.browser.version, 10 ) < 10 ){
			if( jQuery(element).hasClass('flip-in') || jQuery(element).hasClass('grow-in') ){
				jQuery(element).removeClass('flip-in grow-in');
				jQuery(element).addClass('fade-in');
			}
		}
		
		jQuery(element).waypoint(function(direction) {
			
			if( jQuery(element).css('opacity') != '1' ) {
			
				switch( true ){
					case jQuery(element).hasClass('fade-in-from-left'):
						jQuery(element).delay(200).animate({
							'opacity' : 1,
							'left' : '0px'
						}, 800, 'easeOutSine');
					break;
					case jQuery(element).hasClass('fade-in-from-right'):
						jQuery(element).delay(200).animate({
							'opacity' : 1,
							'right' : '0px'
						},800,'easeOutSine');
					break;
					case jQuery(element).hasClass('fade-in-from-bottom'):
						jQuery(element).delay(200).animate({
							'opacity' : 1,
							'bottom' : '0px'
						},800,'easeOutSine');
					break;
					case jQuery(element).hasClass('grow-in'):
						var that = jQuery(element);
						setTimeout(function(){ 
							that.transition({ scale: 1, 'opacity':1 },900,'cubic-bezier(0.15, 0.84, 0.35, 1.25)');
						},200);
					break;
					case jQuery(element).hasClass('flip-in'):
						var that = jQuery(element);
						setTimeout(function(){ 
							that.transition({  rotateY: 0, 'opacity':1 },1100);
						},200);
					break;
					default:
						jQuery(element).delay(200).animate({
							'opacity' : 1
						},800,'easeOutSine');
				}
			}

		}, { offset: '90%', triggerOnce: true });
	
	});
}

function fix_contact_form_on_dialog(){
	if( jQuery("#wd_contact_content .wpcf7-response-output").length > 0 ){
		if( jQuery.trim(jQuery("#wd_contact_content .wpcf7-response-output").text()) !== "" ){
			jQuery("#feedback a").trigger("click");
		}
	}
}

/* MENU PHONE */
function onSizeChange(windowWidth){
	if( typeof obj_nice_scroll == "undefined" ){
		windowWidth += scrollbarWidth();
	}
	if( windowWidth >= 768 ) {
		jQuery('a.block-control').removeClass('active').hide();
		jQuery('a.block-control').parent().siblings().show();
		if( jQuery('.toggle-menu-wrapper').hasClass('active') ){
			TweenMax.to( jQuery('.toggle-menu-wrapper'), 0, { css:{ width:"0px",height:"0px"},  ease:Sine.easeInOut, onComplete:toggle_menu_close });
			TweenMax.to( jQuery('.wd-content,.phone-header-bar-wrapper'), 0, { css:{ left:"0px"},  ease:Sine.easeInOut });
			jQuery('.toggle-menu-wrapper').toggleClass('active');	
		}	
	}
	if( windowWidth < 768 ) {
		setTimeout(function(){
			jQuery('a.block-control').removeClass('active').show();
			jQuery('a.block-control').parent().siblings().hide();
		}, 1000);
	}		

}
function scrollbarWidth() {
    var $inner = jQuery('<div style="width: 100%; height:200px;">test</div>'),
        $outer = jQuery('<div style="width:200px;height:150px; position: absolute; top: 0; left: 0; visibility: hidden; overflow:hidden;"></div>').append($inner),
        inner = $inner[0],
        outer = $outer[0];
     
    jQuery('body').append(outer);
    var width1 = inner.offsetWidth;
    $outer.css('overflow', 'scroll');
    var width2 = outer.clientWidth;
    $outer.remove();
 
    return (width1 - width2);
}

function custom_mobile_menu(){
    var _li_have_sub_menu_mobile = jQuery(".toggle-menu-wrapper .mobile-main-menu ul.menu ul.sub-menu").parents("li");
    var _button_toggle_menu_html = "<span class='menu-drop-icon-mobile'></span>";
    jQuery(_button_toggle_menu_html).insertAfter(_li_have_sub_menu_mobile.find("a:first"));
    jQuery(".toggle-menu-wrapper .mobile-main-menu ul.menu li.current-menu-item").parents("ul.sub-menu").show();
    jQuery(".toggle-menu-wrapper .mobile-main-menu ul.menu li.current-menu-item").parents("ul.sub-menu").prev().addClass("active");
    jQuery(".toggle-menu-wrapper .mobile-main-menu ul.menu span.menu-drop-icon-mobile").bind("click",function(){
        if(!jQuery(this).hasClass("active")){
            jQuery(this).parents("li:first").find("ul.sub-menu:first").slideDown("slow",function(){toggle_menu_open();});
            jQuery(this).addClass("active");
        }
        else{
            jQuery(this).parents("li:first").find("ul.sub-menu:first").slideUp("slow",function(){toggle_menu_open();});
            jQuery(this).find("ul.sub-menu").hide();
            jQuery(this).removeClass("active");
        }
		
    });
}

function wd_custom_yith_compare(){
	if( typeof yith_woocompare !== "object" )
		return;
	jQuery("#cboxOverlay, #cboxClose").live("click",function(){
		jQuery('body').trigger('added_to_cart');
	});
}
