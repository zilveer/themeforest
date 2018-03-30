jQuery(document).ready(function($) {

	"use strict";
	
	$('.vc_custom_select_custom li').on('click', function() {
		if( $(this).hasClass('selected') ) {
			return true;
		}
		var prevVal = $('.vc_custom_select_custom_val').val();
		if (prevVal != '') {
			prevVal += ',';
		}
		$('.vc_custom_select_custom_val').val( prevVal + $(this).attr('data-val') );

		$('.vc_custom_select_custom_vals').html($('.vc_custom_select_custom_vals').html() + '<li data-val="' + $(this).attr('data-val') + '">' + $(this).html() + '<button>×</button></li>');

		$('.vc_custom_select_custom_vals li button').on('click', function() {
			custom_select_Remove($(this).parent());
			custom_select_Change();
		});

		custom_select_Change();
	});

	/* On remove */

	function custom_select_Remove(el) {
		var vals = $('.vc_custom_select_custom_val').val().split(",");
		var newVals = '';
		for (var i = 0; i < vals.length; i++) {
			if( vals[i] != el.attr('data-val') ) {
				if(newVals != '') {
					newVals += ','; 
				}
				newVals += vals[i];
			}
		};
		$('.vc_custom_select_custom_val').val(newVals);
		el.remove();
	}

	/* On change */

	function custom_select_Change() {
		$('.vc_custom_select_custom li').removeClass('selected');
		var vals = $('.vc_custom_select_custom_val').val().split(",");
		for (var i = 0; i < vals.length; i++) {
			$('.vc_custom_select_custom li[data-val="' + vals[i] + '"]').addClass('selected');
		};
	}

	/* If values are already added */

	$('.vc_custom_select_custom_vals li button').on('click', function() {
		custom_select_Remove($(this).parent());
		custom_select_Change();
	});

	/* Hide */

	$('body').on('click', function() {
		$('.vc_custom_select_custom_vals').removeClass('active');
	});

	/* Focus */

	$('.vc_custom_select_custom_vals, .vc_custom_select_custom').on('click', function(e) {
		$('.vc_custom_select_custom_vals').addClass('active');
		e.stopPropagation();
	});
	
})