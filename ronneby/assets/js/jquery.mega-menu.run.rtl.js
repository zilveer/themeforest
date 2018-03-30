(function($){
	"use strict";
	var $window = $(window);
	$.runMegaMenu = function() {
		$("nav.mega-menu")
			.accessibleMegaMenu({
				/* prefix for generated unique id attributes, which are required 
				 to indicate aria-owns, aria-controls and aria-labelledby */
				uuidPrefix: "accessible-megamenu",
				/* css class used to define the megamenu styling */
				menuClass: "nav-menu",
				/* css class for a top-level navigation item in the megamenu */
				topNavItemClass: "nav-item",
				/* css class for a megamenu panel */
				panelClass: "sub-nav",
				/* css class for a group of items within a megamenu panel */
				panelGroupClass: "sub-nav-group",
				/* css class for the hover state */
				hoverClass: "hover",
				/* css class for the focus state */
				focusClass: "focus",
				/* css class for the open state */
				openClass: "open"
			})
			.on('megamenu:open', function(e, el) {
				if ($window.width() <= screen_medium) return false;
		
				var $menu = $(this),
					$el = $(el),
					$sub_nav;

				if ($el.is('.main-menu-link.open') && $el.siblings('div.sub-nav').length>0) {
					$sub_nav = $el.siblings('div.sub-nav');
				} else if ($el.is('div.sub-nav')) {
					$sub_nav = $el;
					$el = $sub_nav.siblings('.main-menu-link');
				} else {
					return true;
				}
				
				$sub_nav.removeAttr('style').removeClass('sub-nav-onecol');

				if($sub_nav.parents('#header-container').hasClass('header-style-1') || $sub_nav.parents('#header-container').hasClass('header-style-2') || $sub_nav.parents('#header-container').hasClass('header-style-3') || $sub_nav.parents('#header-container').hasClass('header-style-4')) {
					$sub_nav.find('ul.sub-menu-wide').each(function(){
						var $ul = $(this);
						var total_width = 1;

						$ul.children().each(function(){
							total_width += $(this).outerWidth();
						});

						$ul.innerWidth(total_width);
					});

					var w_width = $window.width();
					var sub_nav_width = $sub_nav.width();
					var sub_nav_margin = 0;

					$sub_nav.css({'max-width': w_width});

					if (sub_nav_width > w_width) {
						$sub_nav.addClass('sub-nav-onecol');

						sub_nav_width = $sub_nav.width();
					}
					var el_width = $el.outerWidth();
					var el_offset_left = $el.offset().left;
					var el_offset_right = w_width - $el.offset().left - el_width;

					if(el_offset_right < 0) {		//change for RTL
						sub_nav_margin = -(el_offset_right -sub_nav_width/2 + el_width/2);
					}
					if(el_offset_left < (sub_nav_width - el_width)) {		//change for RTL
						sub_nav_margin = -(sub_nav_width - el_width - el_offset_left);
					}
					$sub_nav.css('margin-right', sub_nav_margin);	//change for RTL
				}
			});
	};
	/*  to add MORE button in header menu start */
	/*
	$.cloneMenuItems = function() {
		var main_mega_menu = $('nav.mega-menu');
		var more_menu_item = $('<li id="nav-menu-item-more" class="menu-item-more mega-menu-item nav-item menu-item-depth-0 has-submenu" style="display: none">\n\
			<a class="menu-link main-menu-link item-title" href="#">More</a>\n\
			<div class="sub-nav">\n\
				<ul class="menu-depth-1 sub-menu sub-nav-group"></ul>\n\
			</div></li>');
		
		$('> ul > li', main_mega_menu).each(function() {
			$('> div.sub-nav > ul', more_menu_item).append($(this).clone().hide().removeClass('current-menu-parent current-menu-ancestor current-menu-item'));
		});
		
		
		var depth_reg = /(menu-item-|menu-)depth-(\d+)/;
		$('ul, li', more_menu_item).each(function() {
			var depth = depth_reg.exec($(this).attr('class'));
			if (depth != null) {
				var old_depth = depth[2];
				var new_depth = parseInt(old_depth) + 1;
				
				$(this).removeClass(depth[0]).addClass(depth[0].replace(old_depth, new_depth));
			}
		});
		
		// 2-й уровень
		$('> div.sub-nav > ul > li', more_menu_item).addClass('sub-nav-item').children('a').removeClass('main-menu-link').addClass('sub-menu-link');
		
		// 3-й уровень
		$('> div.sub-nav > ul > li > div.sub-nav > ul', more_menu_item).unwrap().removeClass('sub-menu sub-nav-group').addClass('sub-sub-menu');
		
		$('> ul', main_mega_menu).append(more_menu_item);
	};
	
	$.hideShowMenuItems = function() {
		var main_mega_menu = $('nav.mega-menu').parent('.header-col-fluid');
		var main_mena_menu_width = main_mega_menu.width();
		var items_width = 0;
		var nav_menu_item_more = $('#nav-menu-item-more');
		
		$('nav > ul > li', main_mega_menu).each(function() {
			var menu_item = $(this);
			
			if (menu_item.hasClass('menu-item-more')) {
				return false;
			}
			
			if (menu_item.is(':visible')) {
				items_width += menu_item.outerWidth(true);
			}
			
			if (items_width > main_mena_menu_width) {
				menu_item.prev().hide().end().hide();
				
				nav_menu_item_more.find('#'+menu_item.prev().attr('id')).show();
				nav_menu_item_more.find('#'+menu_item.attr('id')).show();
				
				if (!nav_menu_item_more.is(':visible')) {
					nav_menu_item_more.show();
				}
			} else {
				var first_hidden_menu_item = $('nav > ul > li:hidden:first', main_mega_menu);
				if (main_mena_menu_width - items_width > first_hidden_menu_item.outerWidth(true)) {
					first_hidden_menu_item.show();
					nav_menu_item_more.find('#'+first_hidden_menu_item.attr('id')).hide();
				}
			}
		});
		
		if ($('nav > ul > li.mega-menu-item:hidden', main_mega_menu).length === 0) {
			nav_menu_item_more.hide();
		}
	};
	*/
   /*  to add MORE button in header menu end */
   
   /* menu items slider */
   
	
	var initSlider = function(slider) {
		//var slider = $('#main_mega_menu, #top_left_mega_menu, #top_right_mega_menu');
		var innerWrap = slider.find('> ul');
		var slider_prev = $('.carousel-nav.next', slider);
		var slider_next = $('.carousel-nav.prev', slider);
		var menu_width = slider.innerWidth();
		var items_width = 0;
		
		$('.menu-item-depth-0', slider).each(function() {
			var menu_item = $(this);

			items_width += menu_item.outerWidth(true);
			
			if (items_width > menu_width) {
				menu_item.hide();
			} else {
				menu_item.show();
			}
		});
		if(items_width > menu_width) {
			slider.addClass('menu-with-slider');
			slider.find('.carousel-nav').css('display', 'block');
			slider_prev.unbind('click').on('click touchend',function() {
				var toHidePrev = innerWrap.find('.menu-item-depth-0:visible:first');
				var toShowPrev = innerWrap.find('.menu-item-depth-0:visible:last').next('.menu-item-depth-0');
				if(toShowPrev.length > 0) {
					toHidePrev.hide('fast');
					toShowPrev.show('fast');
				}
			});
			slider_next.unbind('click').on('click touchend',function() {
				var toHideNext = innerWrap.find('.menu-item-depth-0:visible:last');
				var toShowNext = innerWrap.find('.menu-item-depth-0:visible:first').prev('.menu-item-depth-0');
				if(toShowNext.length > 0) {
					toHideNext.hide('fast');
					toShowNext.show('fast');
				}
			});
		} else {
			slider.removeClass('menu-with-slider');
			slider.find('.carousel-nav').css('display', 'none');
		}
	};
	
/*
	var scrollTimerId;
	$window.scroll(function() {
		if (!scrollTimerId)
			$('#header-container nav.mega-menu').addClass('dfd-hide-overflow');

		clearTimeout(scrollTimerId);
		scrollTimerId = setTimeout(function(){
			$('#header-container nav.mega-menu').removeClass('dfd-hide-overflow');
			scrollTimerId = undefined;
		},150);
	});
	*/
	$window.on('load resize scroll', function() {
		$('#header-container .onclick-menu-wrap .onclick-menu-cover').css('height', $window.height()*.7);
		if(!$('#header-container').hasClass('header-style-5') && !$('#header-container').hasClass('header-style-7') && !$('#header-container').hasClass('header-style-8')) {
			setTimeout(function() {
				initSlider($('#main_mega_menu'));
				initSlider($('#top_left_mega_menu'));
				initSlider($('#top_right_mega_menu'));
			}, 500);
		}
	});
   
	$('document').ready(function() {
		/*$('#side-area .widget.widget_nav_menu .item-title').click(function(e){
			e.preventDefault();
			$(this).parent().trigger('click');
		});
*/
		var dfdInitClickMenu = function(elem) {
			elem.click(function(e){
				e.preventDefault();

				var $a = $(this);
				var $sub_nav = $a.siblings('div.sub-nav');

				if ($sub_nav.length === 0) {
					$sub_nav = $a.siblings('ul');
				}

				$sub_nav.slideToggle();
				$a.toggleClass('open');
			});
		};
		
		/*dfdInitClickMenu($('#side-area .onclick-nav-menu li.has-submenu > a'));*/
		dfdInitClickMenu($('#header .onclick-nav-menu li.has-submenu > a'));
		dfdInitClickMenu($('.widget.widget_nav_menu li.has-submenu > a'));
	});
})(jQuery);