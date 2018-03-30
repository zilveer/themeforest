

"use strict";

function desktopMenu(){
	if(!isResponsive(641)){
		// only run at 640px+
		jQuery('.nav-menu-main').find('li').each(function(){
			if(jQuery(this).find('ul.sub-menu').length){
				// item has a submenu
				jQuery(this).addClass('has-submenu');
			}
		});

		popupDesktopMenu();

		androidDesktopMenuFix();
	}
}

function responsiveMenu(){
	if(isResponsive(640)){
		// only run at 640px-
		jQuery('.main-nav .menu-toggle').bind('touchstart MSPointerDown', function(){
			if(jQuery('.main-nav .nav-menu-main').hasClass('menu-opened')){
				jQuery('.main-nav .nav-menu-main').hide();
			} else {
				jQuery('.main-nav .nav-menu-main').show();
			}
			jQuery('.main-nav .nav-menu-main').toggleClass('menu-opened');

			return false;
		});

		//iphoneMenuFix();
	}
}

function iphoneMenuFix(){
	if(isUserAgent('iphone')){
		jQuery('.main-nav li a').each(function(){
			jQuery(this).on('touchstart', function(){
				window.location.href = jQuery(this).attr('href');
			});
		});
	}
}

function androidDesktopMenuFix(){
	if(isAndroid()){
		jQuery('.nav-menu-main').find('li').each(function(){
			jQuery(this).bind('click', function(e){
				e.stopPropagation();
				if(jQuery(this).hasClass('has-submenu')){
					var itemID = jQuery(this).attr('id');
					if(jQuery(this).hasClass('clicked-once')){
						// the second click on target
					} else {
						// if there was clicked on other item reset all except current
						jQuery('.nav-menu-main').find('li').each(function(){
							if(jQuery(this).attr('id') != itemID){
								jQuery(this).removeClass('clicked-once');
							}
						});
						// first click on target
						e.preventDefault();
						jQuery(this).addClass('clicked-once');
					}
				} else {
					// normal flow
				}
			});
		});
	}
}

function popupDesktopMenu(){
	if(jQuery('body').hasClass('sticky-menu-enabled')){
		var clonedMenu = jQuery('header.site-header .nav-menu-main').clone();
		if(typeof clonedMenu.find('ul.nav-menu').attr('id') != "undefined"){
			clonedMenu.find('ul.nav-menu').attr({'id':clonedMenu.find('ul.nav-menu').attr('id')+'-clone'});
		}
		clonedMenu.find('ul.nav-menu').children('li').each(function(){
			if(typeof jQuery(this).attr('id') != "undefined"){
				jQuery(this).attr({'id': jQuery(this).attr('id')+"-clone"});
			}
		});
		jQuery('div.sticky-menu .main-nav').append(clonedMenu);

		var container = jQuery('#masthead');
		var menu = {offset: container.offset(), height: container.outerHeight(true)};
		var page = jQuery('body');
		var scroll = (menu.offset.top + menu.height);
		if(!isResponsive(641)){
			var win = jQuery(window);
			/*win.scroll(function(){
				if(win.scrollTop() > scroll){
					page.addClass('header-scrolled');
				} else {
					page.removeClass('header-scrolled');
				}
			});*/

			setInterval(function(){
				if(win.scrollTop() > scroll){
					page.addClass('header-scrolled');
				} else {
					page.removeClass('header-scrolled');
				}
			},200);
		}
	}
}
