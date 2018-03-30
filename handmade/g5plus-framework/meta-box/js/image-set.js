jQuery( function ( $ )
{
	'use strict';

	$('.rwmb-image-set label').click(function() {
		var $wrapper = $(this).parent().parent();
		var $parent = $(this).parent();

		var old_val = $('input[type="hidden"]', $wrapper).val();
		var new_val = $(this).attr('data-value');

		if (old_val == new_val) {
			if ($parent.hasClass('allow-clear')) {
				if ($(this).hasClass('selected')) {
					$(this).removeClass('selected');
					var clear_value = '';
					if (typeof ($parent.attr('data-clear-value') != "undefined")) {
						clear_value = $parent.attr('data-clear-value');
					}

					$('input[type="hidden"]', $wrapper).val(clear_value);
					$('input[type="hidden"]', $wrapper).trigger('change');
				}
				else {
					$(this).addClass('selected');
					$('input[type="hidden"]', $wrapper).val(new_val);
					$('input[type="hidden"]', $wrapper).trigger('change');
				}
			}
			return;
		}

		$('input[type="hidden"]', $wrapper).val(new_val);
		$('label', $wrapper).removeClass('selected');
		$(this).addClass('selected');
		$('input[type="hidden"]', $wrapper).trigger('change');
	});
} );
