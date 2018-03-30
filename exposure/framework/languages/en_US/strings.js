/**
 * English language controller.
 *
 * This file is entitled to manage all the Javascript-side english translations.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Languages\JS
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

(function($) {
	$.thb.translations = {
		'saving': 'Saving...',
		'use-this-image': 'Use this image',
		'image-help-text': 'Select or upload a Featured Image for your post.',
		'gallery-help-text': 'Use the Select gallery images button to select or upload images for your gallery.',
		'link-help-text': 'Add a link destination URL. Use the editor to compose optional text to accompany the link.',
		'video-help-text': 'Insert a YouTube or Vimeo video URL in the URL field.',
		'audio-help-text': 'Insert the URL to an audio file.',
		'quote-help-text': 'Add an Author name and link if you have them. Use the Text field to compose the quote.'
	};
})(jQuery);

/**
 * jQuery UI datepicker
 * -----------------------------------------------------------------------------
 */
(function($) {
	$.thb.dayNames = [ "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday" ];
	$.thb.dayNamesShort = [ "Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat" ];
	$.thb.monthNames = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];
	$.thb.monthNamesShort = [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec" ];
})(jQuery);