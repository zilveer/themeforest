var check_orientationchange = 0;
if (typeof checkIfTouchDevice != 'function') { 
    function checkIfTouchDevice(){
        touchDevice = !!("ontouchstart" in window) ? 1 : 0; 
		if( jQuery.browser.wd_mobile ) {
			touchDevice = 1;
		}
		return touchDevice;      
    }
}
function triggerGoogleMapReload( _income_obj ){
	if( _income_obj.length > 0 ){
		_income_obj.each(function(index,value){
		var _map_id = jQuery(value).find('.mapp-canvas').length > 0 ? jQuery(value).find('.mapp-canvas').attr('id') : 0;
			if( _map_id !== 0 ){
				var _value_map = window[_map_id];
				if( typeof _value_map.display == 'function' ){
					_value_map.display();
				}
			}
		});
	}
}
function triggerHoverIntent(_show_effect,_show_duration){
	if( typeof _show_effect == "undefined" )
		var _show_effect = "dropdown";
	if(typeof _show_duration == "undefined")
		var _show_duration = 200;
	var _cur_left = "0px";
	jQuery('.nav > div > ul').find('li').hoverIntent(
			function(){
				var child_ul = jQuery(this).children('ul.sub-menu');
				if( jQuery(this).hasClass('wd-mega-menu') ){
					//child_ul.slideDown(200);
					var _gg_maps = jQuery(this).children('ul').find('.mapp-layout');
					triggerGoogleMapReload(_gg_maps);
				}else if( jQuery(this).hasClass('wd-fly-menu') ){
					//child_ul.slideDown(200);
				}
				if( jQuery(this).hasClass('wd-mega-menu') || jQuery(this).hasClass('wd-fly-menu') ){
					switch(_show_effect){
						case "bottom_to_top":
							var _width = child_ul.width();
							child_ul.css('top','200%').show();
							child_ul.animate({'top': '100%'},_show_duration);
							break;
						case "left_to_right":
							var _width = child_ul.width();
							_cur_left = child_ul.css('left');
							var _left = (jQuery(this).hasClass('wd-mega-menu'))?child_ul.css('left'):'0px';
							child_ul.css('left',-_width).show();
							child_ul.animate({'left': _left},_show_duration);
							break;
						case "right_to_left":
							var _width = child_ul.width();
							_cur_left = child_ul.css('left');
							var _left = (jQuery(this).hasClass('wd-mega-menu'))?child_ul.css('left'):'0px';
							child_ul.css('left',_width).show();
							child_ul.animate({'left': _left},_show_duration);
							break;
						default:
							child_ul.slideDown(_show_duration);
					}
				}
				
				jQuery(this).children('span.menu-drop-icon').removeClass('active').addClass('active');	
			},
			function(){
				var child_ul = jQuery(this).children('ul.sub-menu');
				if( jQuery(this).hasClass('wd-mega-menu') || jQuery(this).hasClass('wd-fly-menu') ){
					//child_ul.slideUp(200);
					switch(_show_effect){
						case "bottom_to_top":
							var _width = child_ul.width();
							child_ul.animate({'top': '200%'}, _show_duration, function(){child_ul.hide();});
							break;
						case "left_to_right":
							var _width = child_ul.width();
							child_ul.animate({'left': -_width}, _show_duration, function(){child_ul.hide();child_ul.css('left',_cur_left);});
							break;
						case "right_to_left":
							var _width = child_ul.width();
							child_ul.animate({'left': _width}, _show_duration, function(){child_ul.hide();child_ul.css('left',_cur_left);});
							break;
						default:
							child_ul.slideUp(_show_duration);
					}
				}
				jQuery(this).children('span.menu-drop-icon').removeClass('active');	
			}
	);
}
function triggerHoverIpad(){
    //alert('update');
	jQuery('.nav > div > ul').find('li')/*.die('hover').on('hover',*/ .hover(function() {	
        var current_li = jQuery(this);
	    var child_ul = jQuery(this).children('ul.sub-menu');

        //alert(current_li.attr('class'));
		var menu_drop = jQuery(this).children('span.menu-drop-icon');
		
//		if(menu_drop.hasClass('drop-icon-lv0')){
        jQuery(this).children('span.menu-drop-icon')/*.toggleClass('active')*/.toggle(
//			menu_drop.toggle(
			function(){ 
				var li_parent = jQuery(this).parent(); 
				if( jQuery(this).parent().hasClass('wd-mega-menu') || jQuery(this).hasClass('wd-fly-menu') ){
					var _gg_maps = jQuery(this).parent().children('ul').find('.mapp-layout');
					if(_gg_maps.length > 0)
						triggerGoogleMapReload(_gg_maps);
				  }
				if(	li_parent.hasClass('menu-item-level0')){		
					if(jQuery('.nav > div > ul').find('li').children('ul.sub-menu').is(':visible')){
						//jQuery('.nav > div > ul').find('li').not(li_parent).children('ul.sub-menu').slideUp(400);
						jQuery('.nav > div > ul').children('li').not(li_parent).children('ul.sub-menu').hide();
	//					jQuery('.nav > div > ul').children('span.menu-drop-icon').removeClass('active');
					}
					jQuery('.nav > div > ul').find('li').removeClass('li_active');
					current_li.addClass('li_active');
				}	else {
					//li_parent.parent('ul').find('li').not(li_parent).children('ul.sub-menu').slideUp(400);
					li_parent.parent('ul').find('li').not(li_parent).children('ul.sub-menu').hide();
					current_li.children('span.menu-drop-icon').removeClass('active').addClass('active');
				}
	
	//			var li_menu_ = jQuery(this).parent('.menu-item menu-item-level0');
	//			jQuery('.nav > div > ul').find('li').not(li_menu_).children('ul.sub-menu').slideUp(400);

//				current_li.children('span.menu-drop-icon').removeClass('active').addClass('active');
				child_ul.slideDown(400);

			}, function(){
				var li_parent = jQuery(this).parent(); 
				if(	li_parent.hasClass('menu-item-level0')){	
					jQuery('.nav > div > ul').find('li').removeClass('li_active');
				}
				current_li.children('span.menu-drop-icon').removeClass('active');
				child_ul.hide();
				//child_ul.slideUp(400);
			});
//		}
			
    });

		jQuery(".wd_tini_account_wrapper .wd_tini_account_control").hover(function(){
			jQuery(this).find("span.login-drop-icon").toggle(function(){
				var _div_parent = jQuery(this).parents(".wd_tini_account_wrapper");
				_div_parent.find(".form_drop_down").slideDown(400);
				jQuery(this).addClass("active");
			},
			function(){
				var _div_parent = jQuery(this).parents(".wd_tini_account_wrapper");
				_div_parent.find(".form_drop_down").hide();
				jQuery(this).removeClass("active");
			});
		});
		
		jQuery(".shopping-cart-wrapper").hover(function(){
			jQuery(this).find("span.cart-drop-icon").toggle(function(){
				var _div_pre = jQuery(this).prev();
				_div_pre.find(".drop_down_container").slideDown(400);
				jQuery(this).addClass("active");
			},function(){
				var _div_pre = jQuery(this).prev();
				_div_pre.find(".drop_down_container").hide();
				jQuery(this).removeClass("active");
			});
		});
}

function triggerMobileClick(){
	jQuery('.nav > div > ul.sub-menu').hide(300);
	jQuery('span.menu-drop-icon').click(function(event){
		event.preventDefault();
		var _li_items = jQuery(this).parent();
		if(	jQuery(this).hasClass('active') ){
			_li_items.children('ul').slideUp(300);
			var _gg_maps = _li_items.children('ul').find('.mapp-layout');
			_on_menu_open = false;
		}else{
			jQuery('.nav > div > ul.sub-menu').hide(300);
			_on_menu_open = true;
			top_parent = _li_items;
			if( !_li_items.hasClass('menu-item-level0') ){
				top_parent = _li_items.parentsUntil('.menu-item-level0');
			}
			top_parent.siblings('li.wd-mega-menu').children('ul.sub-menu').hide(300);
			top_parent.siblings('li.wd-mega-menu').find('span.menu-drop-icon').removeClass('active');
			top_parent.siblings('li.wd-fly-menu').find('ul.sub-menu').hide(300);
			top_parent.siblings('li.wd-fly-menu').find('span.menu-drop-icon').removeClass('active');
			_li_items.children('ul').slideDown(300);
			var _gg_maps = _li_items.children('ul').find('.mapp-layout');
			triggerGoogleMapReload(_gg_maps);
		}
		jQuery(this).toggleClass('active');
        jQuery(this).parent('li').toggleClass('li_active');
		jQuery(this).closest('li.menu-item-level0').toggleClass('current-menu-item').siblings('li.menu-item-level0').removeClass('current-menu-item');
		//jQuery(this).parentsUntil('menu-item-level0').toggleClass('menu_active');
	});
	
}

function menu_change_state( case_size ){
	/* Fix no nice scroll */
	if( typeof obj_nice_scroll == "undefined" && typeof scrollbarWidth == 'function' ){
		case_size += scrollbarWidth();
	}
	
	using_mobile_ = checkIfTouchDevice();
	if (using_mobile_ && case_size > 767 && case_size <=1024){
	//	jQuery('.wd-mega-menu-wrapper > ul.menu').show(300);
	//	jQuery('.mega-control-menu').removeClass('active').hide(300);
		
		var _container_offet = jQuery('.header-bottom-content').offset();
		setTimeout(function(){
			jQuery('.menu-item-level0.wd-mega-menu.fullwidth-menu,.menu-item-level0.wd-mega-menu.columns-6').each(function(index,value){
				var _cur_offset = jQuery(value).offset();
				var _left = _cur_offset.left - _container_offet.left ;
				_left = _left - (jQuery('.header-bottom-content').outerWidth() - jQuery('.header-bottom-content').width() ) /2;//Bo + 1 cho theme khac oswad
				jQuery(value).children('ul.sub-menu').css('width',jQuery('.header-bottom-content').width()).css('left','-'+_left +'px');
				
			});	
			
		},0);
	} else {
		jQuery('.wd-mega-menu-wrapper > ul.menu').children('li.wd-mega-menu').removeClass('li_active').children('ul.sub-menu').hide(300);
		jQuery('.wd-mega-menu-wrapper > ul.menu').children('li').not('.wd-mega-menu').removeClass('li_active').find('ul.sub-menu').hide(300);
		jQuery('span.menu-drop-icon').removeClass('active');
		jQuery('span.menu-drop-icon').removeClass('current-menu-item');	
		if( case_size < 768 ){
			jQuery('.wd-mega-menu-wrapper > ul.menu').hide(300);
			jQuery('li.menu-item-level0').removeClass('active').show(300);
			
			jQuery('.menu-item-level0.wd-mega-menu.fullwidth-menu,.menu-item-level0.wd-mega-menu.columns-6').children('ul.sub-menu').css('width','').css('left',0);

		}else{
			jQuery('.wd-mega-menu-wrapper > ul.menu').show(300);
			jQuery('.mega-control-menu').removeClass('active').hide(300);
			
			var _container_offet = jQuery('.header-bottom-content').offset();
			setTimeout(function(){
				jQuery('.menu-item-level0.wd-mega-menu.fullwidth-menu,.menu-item-level0.wd-mega-menu.columns-6').each(function(index,value){
					var _cur_offset = jQuery(value).offset();
					var _left = _cur_offset.left - _container_offet.left ;
					_left = _left - (jQuery('.header-bottom-content').outerWidth() - jQuery('.header-bottom-content').width() ) /2;//Bo + 1 cho theme khac oswad
					jQuery(value).children('ul.sub-menu').css('width',jQuery('.header-bottom-content').width()).css('left','-'+_left+'px');
					
				});	
				
				/* Check menu overflow */
				jQuery('.nav > .main-menu > ul.menu').children('.menu-item-level0.wd-mega-menu.columns-5,.menu-item-level0.wd-mega-menu.columns-4,.menu-item-level0.wd-mega-menu.columns-3,.menu-item-level0.wd-mega-menu.columns-2').each(function(index,value){
					if( jQuery('#header').css('display') == 'none' )
						return;
						
					jQuery(value).children('ul.sub-menu').css({'margin-left': 0});
					
					var sub_menu_width = jQuery(value).children('ul.sub-menu').outerWidth();
					
					var nav_left = jQuery('.header-bottom-content .nav').offset().left;
					var nav_width = jQuery('.header-bottom-content .nav').outerWidth();
					var nav_right = nav_left + nav_width;
					var item_left = jQuery(value).offset().left;
					var item_width = jQuery(value).outerWidth();
					
					var overflow_right = ((sub_menu_width + item_left) > nav_right);
					
					if( overflow_right ){
						var margin_left = sub_menu_width / 2 - item_width / 2; 
						jQuery(value).children('ul.sub-menu').css({'max-width': nav_width + 'px', 'margin-left':-margin_left + 'px'});
						
						if( (item_left - margin_left) < nav_left ){ /* Overflow left */
							margin_left = item_left - nav_left;
							jQuery(value).children('ul.sub-menu').css({'max-width': nav_width + 'px', 'margin-left':-margin_left + 'px', 'left': 0});
						}
						if( (item_left + item_width / 2 + sub_menu_width / 2) > nav_right ){ /* Overflow right */
							margin_left += (item_left + item_width / 2 + sub_menu_width / 2) - nav_right;
							jQuery(value).children('ul.sub-menu').css({'max-width': nav_width + 'px', 'margin-left':-margin_left + 'px', 'left': 0});
						}
					}
					
				});
			
			},1000);

		}	
	}
	
	
	
	//jQuery('.wd-mega-menu-wrapper').children('ul').slideDown(300);
}

function menuAction(case_size,using_mobile){
	if( typeof _sub_menu_show_effect == 'undefined' )
		_sub_menu_show_effect = 'dropdown';
	if( typeof _sub_menu_show_duration == 'undefined' )
		_sub_menu_show_duration = 200;
	
	// if( using_mobile && case_size <= 768 || true ){
	if( using_mobile && case_size <= 767 ){
		triggerMobileClick();
	} else if (using_mobile && case_size > 767 && case_size <=1024){
        triggerHoverIpad();
	}
    else{
		triggerHoverIntent(_sub_menu_show_effect,_sub_menu_show_duration);
	}
	jQuery('.mega-control-menu').click(function(){
		if( jQuery(this).hasClass('active') ){
			jQuery(this).siblings('ul').slideUp(300);
			
		}else{
			jQuery(this).siblings('ul').children('li').not('.menu-dropdown').show(300);
			jQuery(this).siblings('ul').slideDown(300);
		}	
		jQuery(this).toggleClass('active')
	});	
}
//input : jQuery Object
function append_menu_control( wrapper_obj ){
	var _inside_html = wrapper_obj.children('ul.menu').children('li').eq(0).html();
	jQuery('<div id="wd-menu-item-dropdown-div" class="mega-control-menu visible-xs"></div>').html( _inside_html ).prependTo(wrapper_obj);
}

jQuery(document).ready( function(){
	"use strict";
	
	var using_mobile = checkIfTouchDevice();
	append_menu_control( jQuery('.wd-mega-menu-wrapper') );
	menu_change_state( jQuery('body').innerWidth() );
	menuAction( jQuery('body').innerWidth(),using_mobile );		
	// if( using_mobile == 0 ){
		// jQuery(window).bind('resize',function(event) {
			// menu_change_state( jQuery('body').innerWidth() );
		// });
	// }else{
		// jQuery(window).bind('orientationchange',function(event) {	
			// menu_change_state( jQuery('body').innerWidth() );
		// });
	// }
});




/**
 * jQuery.browser.wd_mobile (http://detectmobilebrowser.com/)
 *
 * jQuery.browser.wd_mobile will be true if the browser is a mobile device
 *
 **/
(function(a){jQuery.browser.wd_mobile=/android.+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))})(navigator.userAgent||navigator.vendor||window.opera);