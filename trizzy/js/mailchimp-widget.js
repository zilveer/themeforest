//'use strict';

(function ($) {

	$.fn.ns_mc_widget = function (options) {

		var defaults, eL, opts;
		defaults = {
			'url' : '/',
			'cookie_id' : false,
			'cookie_value' : ''
		};
		opts = jQuery.extend(defaults, options);
		eL = $(this);
		eL.submit(function () {

			var ajax_loader;
			ajax_loader = jQuery('<div></div>');
			ajax_loader.css({
				'background-image' : 'url(' + opts.loader_graphic + ')',
				'background-position' : 'center center',
				'background-repeat' : 'no-repeat',
				'height' : '100%',
				'background-color': 'rgba(255,255,255,0.8)',
				'left' : '0',
				'position' : 'absolute',
				'top' : '0',
				'width' : '100%',
				'z-index' : '100'
			});

			eL.css({
				'height' : '100%',
				'position' : 'relative',
				'width' : '100%'
			});
			console.log(eL);
			//eL.children().hide();
			eL.append(ajax_loader);

			$.getJSON(opts.url, eL.serialize(), function (data, textStatus) {
				var cookie_date, error_container, new_content;
				if ('success' === textStatus) {
					if (true === data.success) {
						new_content = jQuery('<div class="notification closeable success"><p>' + data.success_message + '</p></div>');
						new_content.hide();
						eL.fadeTo(400, 0, function () {
							eL.html(new_content);
							new_content.show();
							eL.fadeTo(400, 1);

						});

					/*	if (false !== opts.cookie_id) {
							cookie_date = new Date();
							cookie_date.setTime(cookie_date.getTime() + '3153600000');
							document.cookie = opts.cookie_id + '=' + opts.cookie_value + '; expires=' + cookie_date.toGMTString() + ';';
						}*/
					} else {
						error_container = jQuery('.error', eL);
						if (0 === error_container.length) {
							ajax_loader.remove();
							eL.children().show();
							error_container = jQuery('<div class="notification closeable error"></div>');
							error_container.prependTo(eL);
						} else {
							ajax_loader.remove();
							eL.children().show();
						}
						error_container.html(data.error);
					}
				}
				return false;
			});
			return false;
		});
	};
}(jQuery));
