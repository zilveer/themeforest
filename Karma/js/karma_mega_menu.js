/**
 * This file holds the main javascript functions needed to improve the karma mega menu backend
 */
(function($) {
	var karma_mega_menu = { 
		recalcTimeout: false,

		recalc : function() {
			var menuItems = $('.menu-item','#menu-to-edit');

			menuItems.each(function(i) {
				var item = $(this),
					megaMenuCheckbox = $('.menu-item-karma-megamenu', this);

				if(!item.is('.menu-item-depth-0')) {
					var checkItem = menuItems.filter(':eq('+(i-1)+')');
					if(checkItem.is('.karma_mega_active')) {
						item.addClass('karma_mega_active');
						megaMenuCheckbox.attr('checked','checked');
					} else {
						item.removeClass('karma_mega_active');
						megaMenuCheckbox.attr('checked','');
					}
				}
			});
		},

		//clone of the jqery menu-item function that calls a different ajax admin action so we can insert our own walker
		addItemToMenu : function(menuItem, processMethod, callback) {
			var menu = $('#menu').val(),
				nonce = $('#menu-settings-column-nonce').val();

			processMethod = processMethod || function(){};
			callback = callback || function(){};

			params = {
				'action': 'karma_ajax_switch_menu_walker',
				'menu': menu,
				'menu-settings-column-nonce': nonce,
				'menu-item': menuItem
			};

			$.post( ajaxurl, params, function(menuMarkup) {
				var ins = $('#menu-instructions');
				processMethod(menuMarkup, params);
				if( ! ins.hasClass('menu-instructions-inactive') && ins.siblings().length )
					ins.addClass('menu-instructions-inactive');
				callback();
			});
		}

	};



	$(function() {
		$(document).on('click', '.menu-item-karma-megamenu,#menu-to-edit', function() {
			var checkbox = $(this),
				container = checkbox.parents('.menu-item:eq(0)');

			if(checkbox.is(':checked')) {
				container.addClass('karma_mega_active');
			} else {
				container.removeClass('karma_mega_active');
			}

			//check if anything in the dom needs to be changed to reflect the (de)activation of the mega menu
			karma_mega_menu.recalc();

		});

		$(document).on('mouseup', '.menu-item-bar', function(event, ui) {
			if(!$(event.target).is('a')) {
				clearTimeout(karma_mega_menu.recalcTimeout);
				karma_mega_menu.recalcTimeout = setTimeout(karma_mega_menu.recalc, 500);
			}
		});

		karma_mega_menu.recalc();
		if(typeof wpNavMenu != 'undefined'){ wpNavMenu.addItemToMenu = karma_mega_menu.addItemToMenu; }
 	});


})(jQuery);
