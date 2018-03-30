(function($, undefined) {
	'use strict';

	$.WPV = $.WPV || {};

	$.WPV.horizontal_blocks = {
		init: function() {
			$('.horizontal_blocks .wpv-range-input').change(function() {
				$.WPV.horizontal_blocks.set_active($(this).val(), $(this).attr('id'));
			});

			$('.horizontal_blocks select').change(function() {
				$.WPV.horizontal_blocks.resize($(this).parents('.block').parent(), $(this).val());
			});

			$('.horizontal_blocks [name*="last"]').change(function() {
				var block = $(this).parents('.block').parent();

				if (block.is('.last') !== $(this).is(':checked')) {
					$.WPV.horizontal_blocks.toggle_last(block);
				}
			});
		},
		set_active: function(number, group) {
			$('[rel="' + group + '"]').removeClass('active');
			$('[rel="' + group + '"]:lt(' + number + ')').addClass('active');
		},
		resize: function(block, new_width) {
			block.removeClass(block.attr('data-width')).addClass(new_width).attr('data-width', new_width);
			if (new_width === 'full') {
				block.find('label').hide();
			} else {
				block.find('label').show();
			}
		},
		toggle_last: function(block) {
			if (block.is('.last')) {
				block.removeClass('last').next().remove();
			} else {
				block.addClass('last').after('<div class="clearboth"></div>');
			}
		}
	};
})(jQuery);