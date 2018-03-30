/**
 * Admin controller.
 *
 * This file is entitled to manage all the interactions in the admin interface.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Assets\Admin\JS
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

if( !jQuery.thb ) {
	jQuery.thb = {};
}

var page = null,
	post = null,
	fc = null,
	fields = new Hashtable();

jQuery(document).ready(function($) {
	page = new THB_Page();
	post = new THB_Post();

	$.thb.notifications();
	$.thb.message('');
});

/**
 * Alert messages
 * -----------------------------------------------------------------------------
 */
(function($) {
	$.thb.message = function( message, args ) {
		args = $.extend({
			'type': 'success',
			'delay': 1500,
			'transition': 150
		}, args);

		var msg = $('.thb-msg-container');

		if( msg.data('type') !== '' ) {
			args.type = msg.data('type');
		}

		if( msg.data('message') !== '' ) {
			message = msg.data('message');
		}

		if( message === '' ) {
			return;
		}

		msg
			.attr('data-type', args.type)
			.addClass('on')
			.html('<div class="thb-msg"><p>' + message + '</p></div>')
			.fadeIn(args.transition)
			.delay(args.delay)
			.fadeOut(args.transition, function() {
				msg
					.html('')
					.attr('data-type', '')
					.attr('data-message', '')
					.removeClass('on');
			});
	};
})(jQuery);

/**
 * Admin notification messages
 * -----------------------------------------------------------------------------
 */
(function($) {
	$.thb.notifications = function() {
		var msgs = $('.thb-admin-message');

		msgs.each(function() {
			var msg = $(this),
				discard = msg.find('.thb-discard');

			discard.on('click', function() {
				var key = $(this).data('key');

				$.post(ajaxurl, {
					'action': 'thb_discard_message',
					'key': key
				}, function() {
					msg.remove();
				});
			});
		});
	};
})(jQuery);

/**
 * Translations
 * -----------------------------------------------------------------------------
 */
(function($) {
	$.thb.translate = function( key ) {
		if( $.thb.translations[key] ) {
			return $.thb.translations[key];
		}

		return key;
	};
})(jQuery);