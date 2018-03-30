var wpv_shortcode_last_update = 0;

(function($, undefined) {
	"use strict";

	var shortcode = {
		preview: function() {
			if (Date.parse(new Date()) - wpv_shortcode_last_update > 1000) {
				wpv_shortcode_last_update = Date.parse(new Date());

				$('#shortcode_preview_content').val(shortcode.generate()).parent().submit();
			}
		},

		init: function() {
			$('#shortcodes .wpv-range-input').uirange();

			$('.shortcode_send').click(function() {
				$.magnificPopup.close();

				tinymce.activeEditor.execCommand( 'mceInsertContent', false, "\n" + shortcode.generate() + "\n" );

				return false;
			});

			$('.shortcode_content *').change(function() {
				shortcode.preview();
			}).change();

			$('a[href="#shortcode_preview"]').click(function() {
				shortcode.preview();
			});

			$('.shortcode_sub_selector select').val('');
			$('.shortcode_sub_selector select').change(function() {
				$('.sub_shortcode_wrap').hide();
				if ($(this).val() !== '') $("#sub_shortcode_" + $(this).val()).show();
			}).change();

			if (window.tinyMCE && tinyMCE.activeEditor) {
				var selection = tinyMCE.activeEditor.selection.getContent();

				var fill_with_selection = [
					'tooltip_content',
					'blockquote_content',
					'list_content',
					'highlight_content'
				];

				for(var i in fill_with_selection) {
					$('#sc_' + fill_with_selection[i]).val(selection).change();
				}
			}

			$('body')
				.wpvColorPicker()
				.wpvIconsSelector()
				.wpvBackgroundOption();
		},

		fields: {
			blockquote: {
				atts: ['cite'],
				content: 'content'
			},
			button: {
				atts: ['id', 'style', 'class', 'align', 'link', 'linkTarget', 'bgColor', 'hover_color', 'font', 'icon', 'icon_placement', 'icon_color'],
				content: 'text'
			},
			chart: {
				atts: ['data', 'labels', 'colors', 'bg', 'size', 'title', 'type', 'advanced']
			},
			dropcap: {
				atts: ['type'],
				content: 'text'
			},
			highlight: {
				atts: ['type'],
				content: 'content'
			},
			inline_divider: {
				atts: ['type']
			},
			icon: {
				atts: ['name', 'style', 'color', 'size', 'inverted_colors']
			},
			image: {
				atts: ['title', 'align', 'lightbox', 'group', 'width', 'height', 'autoHeight', 'link', 'frame', 'underline', 'link_class'],
				content: 'src'
			},
			lightbox: {
				atts: ['href', 'title', 'group', 'iframe'],
				content: 'content'
			},
			list: {
				atts: ['style', 'color'],
				content: 'content'
			},
			push: {
				atts: ['h']
			},
			tooltip: {
				atts: ['tooltip_content'],
				content: 'content'
			}
		},

		generate: function() {
			var type = $('body').attr('data-wpvshortcode');

			if (shortcode.fields[type]) return shortcode.build(type, shortcode.fields[type]);

			return '';
		},

		def: function(condition, on_true, on_false) {
			if (condition) return on_true;
			return on_false || '';
		},

		getVal: function(a, b, c) {
			var name = $.grep([a, b, c], function(n) {
				return n !== undefined;
			}).join('_');

			var target = $('[name="sc_' + name + '"]');
			if (target.is(':radio')) return target.filter(':checked').val();

			if (target.size() === 0) {
				var in_target = $('[name*="sc_' + name + '"]');
				if (in_target.size() === 1) {
					return in_target.val();
				} else if (in_target.size() > 1) {
					var data = [];
					in_target.each(function() {
						var sub = {
							name: $(this).attr('name').replace('sc_' + name + '-', ''),
							val: $(this).val().replace(/'/, "&#39;")
						};

						data.push("'" + sub.name + "':'" + sub.val + "'");
					});

					return data.join(',');
				}
			}
			return target.val();
		},

		build: function(id, fields, parent) {
			function getAttr(attr, prefix) {
				if (prefix === undefined) prefix = '';

				var val = shortcode.getVal(parent, id, prefix + attr);
				if (val !== undefined) {
					if (val === null) val = '';

					return attr + '="' + val + '"';
				}

				return '';
			}

			var open = [id];
			var i;
			for(i in fields.atts) {
				open.push(getAttr(fields.atts[i]));
			}
			open = open.join(' ');

			var content = '';
			var close = '';
			if (fields.content !== undefined) {
				if (typeof fields.content === 'string') {
					content = shortcode.getVal(parent, id, fields.content);
				} else if (typeof fields.content === 'object') {

					var number = shortcode.getVal(parent, id, fields.content.number);

					for (var sub = 1; sub <= number; sub++) {

						var sub_open = [fields.content.code];
						for (i in fields.content.atts) {
							sub_open.push(getAttr(fields.content.atts[i], sub + '_'));
						}
						sub_open = sub_open.join(' ');

						var sub_close = '';

						if (fields.content.content !== undefined) {
							var sub_content = shortcode.getVal(parent, id, sub + '_' + fields.content.content);
							sub_close = sub_content + '[/' + fields.content.code + ']\n';
						}

						content += '\n[' + sub_open + ']' + sub_close;
					}
				}

				close = (fields.content !== undefined ? (content + '[/' + id + ']') : '');
			}

			return '[' + open + ']' + close;
		}

	};

	$(function() {
		shortcode.init();
	});

	$(window).bind('wpv_shortcodes_loaded', function() {
		shortcode.init();
	});

})(jQuery);