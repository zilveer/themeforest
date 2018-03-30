/**
 * @package    WordPress
 * @subpackage Drone
 * @since      4.1
 */

// -----------------------------------------------------------------------------

(function($) {

	'use strict';

	// jQuery
	$(document).ready(function($) {

		// Disable theme update
		$('#update-themes-table tr:has(.check-column input[value="' + drone_update_core.template + '"])').each(function() {

			var
				update  = $(this),
				input   = $('.check-column input', update),
				content = $('.plugin-title', update);

			if ($('> p', content).length > 0) {
				content = $('> p', content);
			}

			input
				.prop('disabled', true)
				.prop('checked', false);

			content.append('<br />' + drone_update_core.notice);

		});

		// Select all - disable fix
		$('#themes-select-all, #themes-select-all-2').change(function() {
			$('#update-themes-table .check-column input:disabled').prop('checked', false);
		});

	});

})(jQuery);