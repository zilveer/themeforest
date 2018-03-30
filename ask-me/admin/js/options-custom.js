/**
 * Custom scripts needed for the colorpicker, image button selectors,
 * and navigation tabs.
 */

jQuery(document).ready(function($) {

	// Loads the color pickers
	$('.of-color').wpColorPicker();
	
	$('.of-datepicker').datepicker();
	
	$("#your-profile .form-table td").addClass("rwmb-input");

	// Image Options
	$('.of-radio-img-img').click(function(){
		$(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
		$(this).addClass('of-radio-img-selected');
	});
	
	$('.v_sliderui').each(function() {
		
		var obj   = $(this);
		var sId   = "#" + obj.data('id');
		var val   = parseInt(obj.data('val'));
		var min   = parseInt(obj.data('min'));
		var max   = parseInt(obj.data('max'));
		var step  = parseInt(obj.data('step'));
		
		//slider init
		obj.slider({
			value: val,
			min: min,
			max: max,
			step: step,
			range: "min",
			slide: function( event, ui ) {
				$(sId).val( ui.value );
			}
		});
		
	});

	$('.of-radio-img-label').hide();
	$('.of-radio-img-img').show();
	$('.of-radio-img-radio').hide();

	// Loads tabbed sections if they exist
	if ( $('.optionsframework-content .nav-tab-wrapper').length > 0 ) {
		options_framework_tabs();
	}

	function options_framework_tabs() {

		// Hides all the .group sections to start
		$('.group').hide();

		// Find if a selected tab is saved in localStorage
		var ask_v = '';
		if ( typeof(localStorage) != 'undefined' ) {
			ask_v = localStorage.getItem("ask_v");
		}

		// If active tab is saved and exists, load it's .group
		if (ask_v != '' && $(ask_v).length ) {
			$(ask_v).fadeIn();
			$(ask_v + '-tab').addClass('nav-tab-active');
		} else {
			$('.group:first').fadeIn();
			$('.optionsframework-content .nav-tab-wrapper a:first').addClass('nav-tab-active');
		}
		// Bind tabs clicks
		$('.optionsframework-content .nav-tab-wrapper a').click(function(evt) {

			evt.preventDefault();

			// Remove active class from all tabs
			$('.optionsframework-content .nav-tab-wrapper a').removeClass('nav-tab-active');

			$(this).addClass('nav-tab-active').blur();

			var group = $(this).attr('href');

			if (typeof(localStorage) != 'undefined' ) {
				localStorage.setItem("ask_v", $(this).attr('href') );
			}

			$('.group').hide();
			$(group).fadeIn();

			// Editor height sometimes needs adjustment when unhidden
			$('.wp-editor-wrap').each(function() {
				var editor_iframe = $(this).find('iframe');
				if ( editor_iframe.height() < 30 ) {
					editor_iframe.css({'height':'auto'});
				}
			});

		});
	}

});