/**
 * Custom scripts needed for the colorpicker, image button selectors,
 * and navigation tabs.
 */

jQuery(document).ready(function($) {

	// Checkboxes with hidden inputs
	$('.has_hidden_child').find('input:checkbox').each(function(){
		if ( $(this).is(":checked")) {
				$(this).parents('.section').next().show();
		}
		$(this).change(function() {
				$(this).parents('.section').next().fadeToggle(400);
		});
	});

	$('.has_hidden_childs').find('input:checkbox').each(function(){
		if ( $(this).is(":checked")) {
				$(this).parents('.section').nextUntil('.section:not(.hidden)').show();
		}
		$(this).change(function() {
				$(this).parents('.section').nextUntil('.section:not(.hidden)').fadeToggle(400);
		});
	});

	$('.has_hidden_childs_radio').find('input:radio').each(function(){
		if ( $(this).is(":checked") && $(this).val()=='on' ) {
			$(this).parents('.section').nextUntil('.section:not(.hidden)').show();
		}
	});

	$('.has_hidden_childs_radio').find('input:radio').change(function () {
		if ( $(this).val()=="on" ) {
				$(this).parents('.section').nextUntil('.section:not(.hidden)').show();
		} else {
				$(this).parents('.section').nextUntil('.section:not(.hidden)').hide(400);
		}
	});

	// Blog layout radiobuttons
	$('.hidden-radio-control').find('input:radio').change(function () {
    if( $(this).val()=="grid" ) {
      $(this).parents('.section').next().show();
			if ( $(this).parents('.section').next().next().is(':visible') ) {
				$(this).parents('.section').next().next().hide(400);
			}
    } else
		if ( $(this).val()=="isotope" ) {
			$(this).parents('.section').next().show();
      $(this).parents('.section').next().next().show();
    } else {
			$(this).parents('.section').nextUntil('.section:not(.hidden)').hide(400);
		}
  });

	$('.hidden-radio-control').find('input:radio').each(function () {
		if ( $(this).val()=="grid" && $(this).is(":checked") ) {
			$(this).parents('.section').next().show();
		}
		if ( $(this).val()=="isotope" && $(this).is(":checked") ) {
			$(this).parents('.section').next().show();
      $(this).parents('.section').next().next().show();
		}
	});

	// Loads the color pickers
	$('.of-color').wpColorPicker();

	// Image Options
	$('.of-radio-img-img').click(function(){
		$(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
		$(this).addClass('of-radio-img-selected');
	});

	$('.of-radio-img-label').hide();
	$('.of-radio-img-img').show();
	$('.of-radio-img-radio').hide();

	// Color Scheme Options - These array names should match
	// Green Color Options
	var green_default = new Array();
	green_default['primary_text_typography_color']='#6a6a6a';
	green_default['secondary_text_color']='#b1b1b1';
	green_default['content_headings_typography_color']='#151515';
	green_default['sidebar_headings_typography_color']='#151515';
	green_default['footer_headings_typography_color']='#ffffff';
	green_default['footer_text_color']='#aeb4bc';
	green_default['link_color']='#000000';
	green_default['link_color_hover']='#C2D44E';
	green_default['button_typography_color']='#ffffff';
	green_default['button_background_color']='#e1e1e1';
	green_default['button_text_hovered_color']='#ffffff';
	green_default['main_decor_color']='#C2D44E';
	green_default['main_border_color']='#e1e1e1';
	green_default['sec_decor_color']='#81cfdc';
	// Turquoise Color Options
	var turquoise = new Array();
	turquoise['primary_text_typography_color']='#858585';
	turquoise['secondary_text_color']='#a3a2a2';
	turquoise['content_headings_typography_color']='#484747';
	turquoise['sidebar_headings_typography_color']='#484747';
	turquoise['footer_headings_typography_color']='#ffffff';
	turquoise['footer_text_color']='#b1aa9f';
	turquoise['link_color']='#151515';
	turquoise['link_color_hover']='#62c5b8';
	turquoise['button_typography_color']='#ffffff';
	turquoise['button_background_color']='#87d1c7';
	turquoise['button_text_hovered_color']='#ffffff';
	turquoise['main_decor_color']='#62c5b8';
	turquoise['main_border_color']='#f5f5f5';
	turquoise['sec_decor_color']='#81cfdc';
	// Dark Red Color Options
	var dark_red = new Array();
	dark_red['primary_text_typography_color']='#858585';
	dark_red['secondary_text_color']='#a3a2a2';
	dark_red['content_headings_typography_color']='#484747';
	dark_red['sidebar_headings_typography_color']='#484747';
	dark_red['footer_headings_typography_color']='#ffffff';
	dark_red['footer_text_color']='#aeaeae';
	dark_red['link_color']='#151515';
	dark_red['link_color_hover']='#cc0002';
	dark_red['button_typography_color']='#ffffff';
	dark_red['button_background_color']='#000000';
	dark_red['button_text_hovered_color']='#ffffff';
	dark_red['main_decor_color']='#cc0002';
	dark_red['main_border_color']='#e7e4d9';
	dark_red['sec_decor_color']='#81cfdc';
	// Blue Color Options
	var blue = new Array();
	blue['primary_text_typography_color']='#646565';
	blue['secondary_text_color']='#898e91';
	blue['content_headings_typography_color']='#484747';
	blue['sidebar_headings_typography_color']='#151515';
	blue['footer_headings_typography_color']='#ffffff';
	blue['footer_text_color']='#f8f8f6';
	blue['link_color']='#151515';
	blue['link_color_hover']='#009cd5';
	blue['button_typography_color']='#444444';
	blue['button_background_color']='#fafafa';
	blue['button_text_hovered_color']='#ffffff';
	blue['main_decor_color']='#009cd5';
	blue['main_border_color']='#f5f5f5';
	blue['sec_decor_color']='#81cfdc';

	$('#base_color_scheme').change(function() {
	  colorscheme = $(this).val();
		if (colorscheme == 'green_default') { colorscheme = green_default; }
	  if (colorscheme == 'turquoise') { colorscheme = turquoise; }
	  if (colorscheme == 'dark_red') { colorscheme = dark_red; }
	  if (colorscheme == 'blue') { colorscheme = blue; }
	  for (id in colorscheme) {
	    of_update_color(id,colorscheme[id]);
	  }
	});
	// This does the heavy lifting of updating all the colorpickers and text
	function of_update_color(id,hex) {
	  $('#' + id).wpColorPicker('color',hex);
	}

	// Loads tabbed sections if they exist
	if ( $('.nav-tab-wrapper').length > 0 ) {
		options_framework_tabs();
	}

	function options_framework_tabs() {

		var $group = $('.group'),
			$navtabs = $('.nav-tab-wrapper a'),
			active_tab = '';

		// Hides all the .group sections to start
		$group.hide();

		// Find if a selected tab is saved in localStorage
		if ( typeof(localStorage) != 'undefined' ) {
			active_tab = localStorage.getItem('active_tab');
		}

		// If active tab is saved and exists, load it's .group
		if ( active_tab != '' && $(active_tab).length ) {
			$(active_tab).fadeIn();
			$(active_tab + '-tab').addClass('nav-tab-active');
		} else {
			$('.group:first').fadeIn();
			$('.nav-tab-wrapper a:first').addClass('nav-tab-active');
		}

		// Bind tabs clicks
		$navtabs.click(function(e) {

			e.preventDefault();

			// Remove active class from all tabs
			$navtabs.removeClass('nav-tab-active');

			$(this).addClass('nav-tab-active').blur();

			if (typeof(localStorage) != 'undefined' ) {
				localStorage.setItem('active_tab', $(this).attr('href') );
			}

			var selected = $(this).attr('href');

			$group.hide();
			$(selected).fadeIn();

		});
	}

});
