(function($, undefined) {
	"use strict";

	tinymce.PluginManager.add('wpv_shortcodes', function(editor) {
		var open_shortcode = function(slug) {
			if ($('#shortcodes').length === 0) {
				$('body').append('<div id="shortcodes">');
			}

			$('body').attr('data-wpvshortcode', slug);

			$.get(ajaxurl, {
				action: 'wpv-shortcode-generator',
				slug: slug,
				nocache: +(new Date())
			}, function(data) {
				$('#shortcodes').html(data);

				$(window).trigger('wpv_shortcodes_loaded');

				$.magnificPopup.open({
					type: 'inline',
					items: {
						src: '#' + $('#shortcodes > div').attr('id'),
						titleSrc: WpvTmceShortcodes.title
					},
					closeOnBgClick: false
				});
			});
		};

		var menu_items = [];

		var create_menu_item = function(shortcode) {
			return {
				text: shortcode.title,
				onclick: function() {
					open_shortcode(shortcode.slug);
				}
			};
		};

		for(var i = 0; i < WpvTmceShortcodes.shortcodes.length; ++i) {
			menu_items.push( create_menu_item( WpvTmceShortcodes.shortcodes[i] ) );
		}

		editor.addButton('wpv_shortcodes', {
			type: 'menubutton',
			text: '',
			tooltip: WpvTmceShortcodes.title,
			icon: WpvTmceShortcodes.button,
			classes: 'widget btn wpv_shortcodes',
			menu: menu_items
		});
	});
})(jQuery);