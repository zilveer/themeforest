/**
 * @package    WordPress
 * @subpackage Drone
 * @since      5.6.7
 */

// -----------------------------------------------------------------------------

'use strict';

// -----------------------------------------------------------------------------

(function($) {

	// jQuery
	$(document).ready(function($) {

		// Facebook
		// https://developers.facebook.com/docs/plugins/page-plugin
		// https://developers.facebook.com/docs/javascript/reference/FB.init/v2.6
		if ($('.fb-like, .fb-page').length > 0) {
			$('<div />', {id: 'fb-root'}).prependTo('body');
			$.getScript('//connect.facebook.net/' + drone_social_media_api.locale + '/sdk.js', function() {
				FB.init({
					xfbml:   true,
					version: 'v2.6'
				});
			});
		}

		// Twitter
		// https://dev.twitter.com/docs/tweet-button
		if ($('.twitter-share-button').length > 0) {
			$.getScript('//platform.twitter.com/widgets.js');
		}

		// Google
		// https://developers.google.com/+/plugins/+1button/
		if ($('.g-plusone').length > 0) {
			$.getScript('https://apis.google.com/js/plusone.js');
		}

		// Pinterest
		// http://business.pinterest.com/widget-builder/#do_pin_it_button
		if ($('[data-pin-do]').length > 0) {
			$.getScript('//assets.pinterest.com/js/pinit.js');
		}

		// LinkedIN
		// http://developer.linkedin.com/plugins/share-plugin-generator
		if ($('.inshare').length > 0) {
			$.getScript('//platform.linkedin.com/in.js');
		}

	});

})(jQuery);