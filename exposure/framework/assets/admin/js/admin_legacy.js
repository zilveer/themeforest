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

jQuery.thb = {};

jQuery(document).ready(function($) {
	$.page();
	$('.thb-btn-upload').thb_upload();
	$.wpPost();
	$.thb.notifications();
	$.thb.message('');
});

/**
 * Alert messages
 * -----------------------------------------------------------------------------
 */
(function($) {
	$.thb.message = function( message, args ) {
		var args = $.extend({
			'type': 'success',
			'delay': 1500,
			'transition': 150
		}, args);

		var msg = $('.thb-msg-container');

		if( msg.data('type') != '' ) {
			args.type = msg.data('type');
		}

		if( msg.data('message') != '' ) {
			message = msg.data('message');
		}

		if( message == '' ) {
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
	}
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
	}
})(jQuery);

/**
 * Post formats metaboxes
 * -----------------------------------------------------------------------------
 */
(function($) {
	$.wpPost = function() {
	    var postFormatsMetaboxes = $('#metabox_post_gallery, #metabox_post_quote, #metabox_post_video, #metabox_post_audio, #metabox_post_link'),
	    	group = $('#post-formats-select input'),
	    	slideshowType = $('.thb-metabox [name="slideshow_type"]'),
	    	slideshowOptions = [];

	    slideshowType.find('option').each(function() {
	    	var opt = $("#thb-fields-container-" + $(this).attr("value") + "_options");

	    	if( opt.length > 0 ) {
	    		slideshowOptions.push(opt);
	    	}
	    });

		group.change( function() {
			postFormatsMetaboxes.hide();
			var val = $(this).val();

			if( val != 'gallery' ) {
				$('#metabox_post_' + val).show();
			}
		});

		group.each(function() {
			if( $(this).is(':checked') ) {
				postFormatsMetaboxes.hide();
				var val = $(this).val();
				
				if( val != 'gallery' ) {
					$('#metabox_post_' + val).show();
				}
				return;
			}
		});

		function slideshowTypeChange() {
			var type = $('.thb-metabox [name="slideshow_type"]').val(),
				opt = $("#thb-fields-container-" + type + "_options"),
				slideshowOptions = [];

			$('.thb-metabox [name="slideshow_type"]').find('option').each(function() {
				var opt = $("#thb-fields-container-" + $(this).attr("value") + "_options");

				if( opt.length > 0 ) {
					slideshowOptions.push(opt);
				}
			});

			jQuery.each(slideshowOptions, function() {
				jQuery(this).hide();

				if( opt.length > 0 ) {
					if( jQuery(this).is(opt) ) {
						opt.show();
					}
				}
			});
		}
	}
})(jQuery);

/**
 * Upload fields
 * -----------------------------------------------------------------------------
 */
(function($) {
	$.fn.thb_upload = function() {
		/**
		 * The selector.
		 */
		var selector = $(this).selector;

		/**
		 * Media Library elements customizations.
		 *
		 * @param Object win The iframe window.
		 * @return void
		 */
		function customizeMediaLibrary( win ) {
			var $ = win.jQuery;

			if( $ == undefined )
				return;

			var hide = ["image_alt", "align", "post_title", "post_excerpt", "post_content", "image-size", "url"];
			var style = "";
			
			for( i=0; i<hide.length; i++ ) {
				hide[i] = "tr." + hide[i];
			}

			var fn = $('.filename.new');

			fn.each(function() {
				var f = $(this);

				f.append('<input type="button" class="thb-use-this button alignright" value="' + $.thb.translate('use-this-image') + '">')
				
				f.find('.thb-use-this')
					.click(function() {
						var table = f.next('table');
						var src = table.find('.button.urlfile').data('link-url');

						window.send_to_editor( '<div><img src="' + src + '"></div>' );
						return false;
					});
			});

			style += '.thb-use-this { margin-top: 7px !important; } ';
			style += hide.join() + " { display: none !important; } ";

			$("body").append('<style type="text/css">'+style+'</style>');

	    	$("td.field input").removeAttr("checked");
	    	$("td.field input[value='full']").attr("checked", "checked");
	    	$("form").submit(function() {
	    		$("td.field input").removeAttr("checked");
	    		$("td.field input[value='full']").attr("checked", "checked");
	    		return true;
	    	});
		}

		/**
		 * Open the WP Media Library.
		 *
		 * @param string text The window text.
		 * @return void
		 */
		function openMediaLibrary( text ) {
			var tb_show_temp = window.tb_show;
			window.tb_show = function() {
				tb_show_temp.apply(null, arguments);

				var iframe = jQuery('#TB_iframeContent');
				iframe.load(function() {
					var win = iframe[0].contentWindow;
					customizeMediaLibrary(win);
				});
			};

			tb_show(text, 'media-upload.php?post_id=0&amp;title='+text+'&amp;TB_iframe=true');
			window.tb_show = tb_show_temp;
		}

		/**
		 * Show or hide the upload remove button.
		 *
		 * @param string selector The button selector.
		 * @return void
		 */
		function showHideRemove( selector ) {
			var button = $(selector),
				field = button.parents('.thb-field'),
				remove = field.find('.thb-upload-remove'),
				uploadURL = field.find( button.data('target-url') ),
				previewImg = field.find( button.data('target-preview') );

			if( !remove.length ) {
				return;
			}

			remove.find('a').on('click', function() {
				previewImg.attr('src', 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==');
				uploadURL.val('');

				remove.hide();

				return false;
			});

			if( uploadURL.val() != '' ) {
				remove.show();
			}
		}

		/**
		 * When clicking on the upload button, bind events for the remove button
		 * and open the media library popup.
		 * 
		 * @return boolean
		 */
		$(document).on('click', selector, function() {
			button = $(this),
			field = $(this).parents('.thb-field'),
			label = field.find('> label'),
			remove = field.find('.thb-upload-remove'),
			uploadURL = field.find( button.data('target-url') ),
			previewImg = field.find( button.data('target-preview') ),
			old_sent_to_editor = window.send_to_editor;

			showHideRemove(button);
			openMediaLibrary(label.text());

			window.send_to_editor = function(html) {
				html = "<div>" + html + "</div>";
				var src = $("img", html).attr("src");

				// When the upload is done and the image has been selected, valorize the URL field
				if( uploadURL.length ) {
					uploadURL.val(src);
				}

				// ...and the image preview
				if( previewImg.length ) {
					$.ajax({
						type: 'post',
						url: ajaxurl,
						async: false,
						data: {
							action: 'thb_image_get_sizes',
							'width': '80',
							'height': '80',
							'src': src.replace( /^\D+/g, '')
						},
						success: function( newSrc ) {
							src = newSrc;

							if( remove.length ) {
								remove.show();
							}
						}
					});

					previewImg.attr('src', src);
				}

				tb_remove();
				window.send_to_editor = old_sent_to_editor;
			}

			return false;
		});

		showHideRemove(selector);
	};

})(jQuery);

/**
 * Options pages
 * -----------------------------------------------------------------------------
 */
(function($) {

	var tabs_nav = null,
		tabs = null,
		forms = null;

	/**
	 * Handles the forms submission via AJAX.
	 * 
	 * @return void
	 */
	function handleForms() {
		forms.submit(function() {
			var button = $(this).find('input[type="submit"]'),
				button_val = button.val();

			button
				.attr("disabled", "disabled")
				.val( $.thb.translate('saving') );

			$.post($(this).attr("action"), $(this).serialize().replace(/%5B%5D/g, '[]'), function(response) {
				if( response.data ) {
					for( container in response.data ) {
						var ids = response.data[container];
						$.each(ids, function(i) {
							$('[data-slug="' + container+ '"] input[data-uniqid]').eq(i).val(this);
						});
					}
				}

				$.thb.message(response.message);

				button
					.removeAttr("disabled")
					.val(button_val);
			}, 'json');
			
			return false;
		});
	}

	/**
	 * Handles the tab switching on options pages.
	 * 
	 * @return void
	 */
	function handleTabsNav() {
		tabs_nav.find('a').click(function() {
			var href = $(this).attr('href'),
				target = tabs.filter(href),
				parent = $(this).parent('li');

			// Hide everything
			tabs.hide();
			tabs_nav.removeClass('active');

			// Show the tab
			target.show();
			parent.addClass('active');

			return false;
		});
	}

	/**
	 * Handles duplicable fields generation
	 *
	 * @return void
	 */
	function handleDuplicableFields() {
		$('.thb-fields-container.duplicable').each(function() {
			if( !$(this).find('.thb-field').length ) {
				$(this).addClass('no-fields');
			}
			else {
				$(this).removeClass('no-fields');
			}
		});

		$('.thb-fields-container.duplicable .thb-controls .thb-btn').click(function() {
			var context = $(this).parents('.thb-fields-container.duplicable'),
				fields_container = context.find('.thb-container');

			var options = {
				'action': 'thb_get_field_template',
				'container': context.data('slug'),
				'subtemplate': ''
			};

			if( $(this).data('tpl') != '' ) {
				options.subtemplate = $(this).data('tpl');
			}

			if( $(this).parents('.thb-metabox').length ) {
				var metabox = $(this).parents('.thb-metabox');

				options.posttype = metabox.data('post-type');
				options.metabox = metabox.data('slug');
			}
			else {
				var tab = $(this).parents('.thb-page-tab');

				options.page = tab.data('page');
				options.tab = tab.data('slug');
			}

			$.post(ajaxurl, options, function(data) {
				fields_container.append( data );
				context.removeClass('no-fields');
			}, 'html');

			return false;
		});

		$('.thb-fields-container.duplicable.sortable .thb-container').sortable();

		$(document).on('click', '.thb-fields-container.duplicable .thb-field .thb-remove', function() {
			var fields_container = $(this).parents('.thb-fields-container');
			$(this).parents('.thb-field').remove();

			if( !fields_container.find('.thb-field').length ) {
				fields_container.addClass('no-fields');
			}
			else {
				fields_container.removeClass('no-fields');
			}

			return false;
		});
	}

	/**
	 * Define tab-container min-height based on tabs-nav height
	 */
	
	function tabs_min_height() {
		var nav_height = $('.thb-page-tabs-nav').outerHeight(),
			container = $('.thb-page-tabs-container');

		container.css('min-height', nav_height);
	}

	/**
	 * $.page();
	 * 
	 * @return void
	 */
	$.page = function() {
		tabs_nav = $('.thb-page-tabs-nav li');
		tabs = $('.thb-page-tab');
		forms = tabs.find('form.thb-ajax');

		handleForms();
		handleTabsNav();
		handleDuplicableFields();
		tabs_min_height();
		
		$('textarea.code').thb_textarea();

		$('.widget').each(function() {
			if($(this).attr('id') && $(this).attr('id').indexOf('_thb_') != -1)
				$(this).addClass('thb');
		})
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
	}
})(jQuery);

/**
 * jQuery textarea
 * -----------------------------------------------------------------------------
 */
(function($) {
	$.fn.thb_textarea = function() {
		return this.each(function() {
			$(this).keydown(function(e) {
				if(e.keyCode == 9) {
					var start = $(this).get(0).selectionStart;
					$(this).val($(this).val().substring(0, start) + "\t" + $(this).val().substring($(this).get(0).selectionEnd));
					$(this).get(0).selectionStart = $(this).get(0).selectionEnd = start + 1;
					return false;
				}
			});
		});
	}
})(jQuery);