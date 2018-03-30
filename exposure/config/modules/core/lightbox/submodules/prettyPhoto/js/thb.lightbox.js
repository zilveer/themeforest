jQuery.thb.config.set('thb_lightbox', 'prettyPhoto', {
	allow_resize: true,
	hideflash: true,
	show_title: false,
	theme: 'pp_default',
	social_tools: ''
});

(function($) {
	if( typeof String.prototype.endsWith !== 'function' ) {
		String.prototype.endsWith = function(suffix) {
			return this.indexOf(suffix, this.length - suffix.length) !== -1;
		};
	}

	$(document).ready(function() {
		var images = $.thb.config.get('thb_lightbox', 'images');
		var videos = $.thb.config.get('thb_lightbox', 'videos');
		var elements_selector = [];

		if( images.elements ) {
			elements_selector.push(images.elements);
		}

		if( videos.elements ) {
			elements_selector.push(videos.elements);
		}

		if( elements_selector.length === 0 ) {
			return;
		}

		var elements = $(elements_selector.join(','));

		/**
		 * Filters and NexGEN Gallery compatibility fix
		 */
		elements = elements.filter(function() {
			var is_next_gen = $(this).parents('[class*="ngg-"]').length > 0;
			var is_no_thb_lightbox = $(this).hasClass('thb-no_lightbox');

			return !is_next_gen && !is_no_thb_lightbox;
		});

		elements.attr('rel', 'prettyPhoto');

		// Galleries
		if( images.elements ) {
			$('.gallery, .thb-gallery, .thb-slideshow').each(function() {
				var id = $(this).attr('id'),
					links = $(this).find('a:has(img)');

				links.each(function() {
					if( $(this).is( $(images.elements) ) ) {
						$(this).attr('rel', 'prettyPhoto[' + id + ']');
					}
				});
			});
		}

		var objects = $("a[rel^='prettyPhoto']");
		objects.prettyPhoto($.thb.config.get('thb_lightbox', 'prettyPhoto'));
	});
})(jQuery);