jQuery(document).ready(function($) {

	"use strict";

	var menuNavForm = $('#update-nav-menu');

	menuNavForm.on('change', '[data-grve-menu-item]', function() {

		var dataArrayString = '';
		var menuNavForm = $('#update-nav-menu');
		var menuItemsData = menuNavForm.find("[data-grve-menu-name]");
		menuItemsData.each(function() {
			var attributeName = $(this).data('grve-menu-name');
			var attributeVal  = $(this).val();

			if(attributeVal !== '') {
				dataArrayString += attributeName+"="+attributeVal+'&';
			}
		});

		dataArrayString = dataArrayString.substr(0, dataArrayString.length - 1);

		if( $('input[name=grve_menu_options]').length ) {
			$('input[name=grve_menu_options]').val( encodeURIComponent( dataArrayString ) );
		} else {
			var hiddenMenuItem = '<input type="hidden" name="grve_menu_options" value="'+encodeURIComponent(dataArrayString)+'">';
			menuNavForm.append(hiddenMenuItem);
		}

	});

	$(document).on( 'change', '.grve-menu-item-megamenu', function() {
		var megamenuField = $(this),
			container = megamenuField.parents('.menu-item');

		if ( '' != megamenuField.val() ) {
			container.addClass('grve-megamenu-active');
		} else {
			container.removeClass('grve-megamenu-active');
		}
	});

	$(document).on( 'change', '.grve-menu-item-style', function() {
		var menuItemField = $(this),
			container = menuItemField.parents('.menu-item');
		if ( '' != menuItemField.val() ) {
			container.find('.grve-menu-item-color-container').show();
			container.find('.grve-menu-item-hover-color-container').show();
		} else {
			container.find('.grve-menu-item-color-container').hide();
			container.find('.grve-menu-item-hover-color-container').hide();
		}
	});

	function grveCalculateMenu() {

		var menuItems = $('.grve-menu-item-megamenu');
		menuItems.each(function(i) {
			var megamenuField = $(this),
				container = megamenuField.parents('.menu-item');
			if ( '' != megamenuField.val() ) {
				container.addClass('grve-megamenu-active');
			} else {
				container.removeClass('grve-megamenu-active');
			}
		});

		var menuStyleItems = $('.grve-menu-item-style');
		menuStyleItems.each(function(i) {
			var menuItemField = $(this),
				container = menuItemField.parents('.menu-item');
			if ( '' != menuItemField.val() ) {
				container.find('.grve-menu-item-color-container').show();
				container.find('.grve-menu-item-hover-color-container').show();
			} else {
				container.find('.grve-menu-item-color-container').hide();
				container.find('.grve-menu-item-hover-color-container').hide();
			}
		});

	}

	grveCalculateMenu();



});