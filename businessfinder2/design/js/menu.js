

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

/*function iphoneMenuFix(){
	if(isUserAgent('iphone')){
		jQuery('.main-nav li a').each(function(){
			jQuery(this).on('touchstart', function(){
				window.location.href = jQuery(this).attr('href');
			});
		});
	}
}*/

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
		if(typeof clonedMenu.find('ul.ait-megamenu').attr('id') != "undefined"){
			clonedMenu.find('ul.ait-megamenu').attr({'id':clonedMenu.find('ul.ait-megamenu').attr('id')+'-clone'});
		}
		clonedMenu.find('ul.ait-megamenu').children('li').each(function(){
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


			setInterval(function(){
				if(win.scrollTop() > scroll){
					page.addClass('header-scrolled');
				} else {
					page.removeClass('header-scrolled');
				}
			},200);
		}
	}

	/*if(!isResponsive(768)){
		if(jQuery('body').hasClass('sticky-menu-enabled')){

			var stickyMenu = jQuery('.menu-container');
			var stickyOffset = 72;//stickyMenu.height();

			if (stickyMenu.next('div').length) {
				stickyMenu.next().css('margin-top', stickyOffset);
			} else {
				jQuery('.page-content').css('margin-top', stickyOffset);
			}
		}
	}*/
}

function menuOverlay() {
	var menuContainer = jQuery(".site-header .menu-container");
	jQuery(".ait-megamenu > li.has-submenu, .ait-megamenu > li.menu-item-wrapper").hover(function() {
		menuContainer.toggleClass("hover");
	});
}

/* new burger menu logic */
function burgerMenus(menus){
	jQuery.each(menus, function(index, menu){

		jQuery(menu.selectors.join(', ')).each(function(){
			var $container = jQuery(this);
			var $navContainer = $container.find('nav');
			var $menuContainer = $navContainer.find('.nav-menu-container').children('ul');

			var testWidth = !isMobile() ? 623 : 640;
			
			// update avalaible space
			var widthNav = $navContainer.width();
			$navContainer.attr('data-avalaibleSpace', widthNav);
			// this is stupid xD
			var widthAvalaible = widthNav - parseInt($navContainer.attr('data-reservedSpace'));
			var avalaibleSpace = widthAvalaible;

			if(!isResponsive(testWidth)){

				if(parseInt($menuContainer.attr('data-liWidth')) > avalaibleSpace){
					// the menu is bigger than the space
					var fittingWidth = avalaibleSpace;
					//var lastFittableLi = null;
					$menuContainer.children('li:not(.menu-item-wrapper)').each(function(){
						// for every li, get his width and try to fit it
						var liWidth = parseInt(jQuery(this).attr('data-width')) == 0 ? jQuery(this).outerWidth(true) : parseInt(jQuery(this).attr('data-width'));
						fittingWidth = parseInt(fittingWidth - liWidth);
						var liID = jQuery(this).attr('id');
						if(fittingWidth > 0){
							// no problem .. li fits
							// hide this in the wrapmenu
							jQuery(this).show();
							jQuery('#'+liID+'-wrapclone').hide();
						} else {
							// problem .. li doesnt fit
							// show this in the wrapmenu
							jQuery(this).hide();
							jQuery('#'+liID+'-wrapclone').show();
						}
					});

					$menuContainer.find('.menu-item-wrapper').css({'display': 'inline-block'});
				} else {
					var fittingWidth = avalaibleSpace;
					$menuContainer.children('li:not(.menu-item-wrapper)').each(function(){
						var liWidth = parseInt(jQuery(this).attr('data-width')) == 0 ? jQuery(this).width() : parseInt(jQuery(this).attr('data-width'));
						fittingWidth = parseInt(fittingWidth - liWidth);
						var liID = jQuery(this).attr('id');
						if(fittingWidth > 0){
							// no problem .. li fits
							// hide this in the wrapmenu
							jQuery(this).show();
							jQuery('#'+liID+'-wrapclone').hide();
						}
					});
					// hide wrapping menu
					$menuContainer.find('.menu-item-wrapper').css({'display': 'none'});
				}

			} else {
				$menuContainer.children('li:not(.menu-item-wrapper)').css({'display': 'inline-block'});
				$menuContainer.find('.menu-item-wrapper').css({'display': 'none'});
			}
		});
	});
}

function prepareBurgerMenus(menus){
	jQuery.each(menus, function(index, menu){

		jQuery(menu.selectors.join(', ')).each(function(){
			
			var $container = jQuery(this);
			var $navContainer = $container.find('nav');

			// before computing, display hidden menus .. no need this is default
			//$navContainer.css({'display':'block', 'visibility':'hidden'});

			// menu items widths
			var $menuContainer = $navContainer.find('.nav-menu-container').children('ul');
			var widthLiAll = 0;
			$menuContainer.children('li').each(function(){
				var widthLi = jQuery(this).outerWidth(true);
				jQuery(this).attr('data-width', widthLi);
				widthLiAll = widthLiAll + widthLi;
			});
			$menuContainer.attr('data-liWidth', widthLiAll);

			// append burger li .. burger is always created
			$menuContainer.append('<li class="menu-item-wrapper sub-menu-right-position"><a><i class="fa fa-bars"></i></a><ul class="menu-items-wrap"></ul></li>');
			var $burgerMenuWrapper = $menuContainer.find('li.menu-item-wrapper');
			var $burgerMenuContainer = $burgerMenuWrapper.find('.menu-items-wrap');

			// fill up burger menu with data
			var $menuContainerChildren = $menuContainer.children('li:not(.menu-item-wrapper)').clone(true);
			$menuContainerChildren.appendTo($burgerMenuContainer);

			$burgerMenuWrapper.find('li').each(function(){
				// update id
				var oldId = jQuery(this).attr('id');
				if(typeof oldId !== "undefined"){
					jQuery(this).attr('id', jQuery(this).attr('id')+'-wrapclone');
				}
				// update class
				if(jQuery(this).hasClass('menu-item-has-columns')){
					jQuery(this).removeAttr('class');
					jQuery(this).addClass('menu-item-wrapped menu-item-has-columns');
				} else {
					jQuery(this).removeAttr('class');
					jQuery(this).addClass('menu-item-wrapped');
				}
			});

			// clear up all megamenu classes
			if($burgerMenuContainer.find('li.menu-item-has-columns').length > 0){
				$burgerMenuContainer.find('li.menu-item-has-columns ul li').each(function(){
					if(jQuery(this).children('a').length > 0){
						jQuery(this).addClass('leave-me-alone');
					}
				});

				$burgerMenuContainer.find('li.menu-item-has-columns').each(function(){
					var $lis = jQuery(this).find('li.leave-me-alone').clone(true);
					var $con = jQuery(this).find('ul');
					$con.children().remove();
					$con.append($lis);
				});
				$burgerMenuContainer.find('li.leave-me-alone').removeClass('leave-me-alone');
			}

			// add new classes
			$burgerMenuContainer.find('li').each(function(){
				if(jQuery(this).children('ul').length > 0){
					jQuery(this).addClass('menu-item-has-children');
				}
			});

			// compute and store widths
			var widthContainer = $container.width();
			var widthNav = $navContainer.width();

			var widthAvalaible = widthNav;
			$navContainer.attr('data-avalaibleSpace', widthAvalaible);

			// compute reserverd space from defined selectors
			var reservedSize = 0;
			jQuery(menu.reservedSelectors.join(', ')).each(function(){
				reservedSize = reservedSize + jQuery(this).outerWidth(true);
			});
			$navContainer.attr('data-reservedSpace', reservedSize);

			widthAvalaible = widthAvalaible - reservedSize;	

			// will the burger be shown by default
			if(widthAvalaible < widthLiAll){
				$burgerMenuWrapper.css({'display': 'inline-block'});
			} else {
				$burgerMenuWrapper.css({'display': 'none'});
			}

			// reset all styles added by script
			//$navContainer.css({'display':'block', 'visibility':''});
			$navContainer.removeClass('menu-hidden');
		});

	});
}