(function ($) {
	"use strict";


	/**
	 * File uploading using media library
	 */
	$(document).ready(function () {

		$(document).on("click", ".azl_upload_image_button", function (e) {
			e.preventDefault();
			var $button = $(this);


			// Create the media frame.
			var file_frame = wp.media.frames.file_frame = wp.media({
				title: $(this).data('uploader_title'),
				library: { // remove these to show all
					type: 'image' // specific mime
				},
				button: {
					text: $(this).data('uploader_button_text')
				},
				multiple: false  // Set to true to allow multiple files to be selected
			});

			// When an image is selected, run a callback.
			file_frame.on('select', function () {
				// We set multiple to false so only get one image from the uploader

				var attachment = file_frame.state().get('selection').first().toJSON();
				var thumb_url = (attachment.sizes && attachment.sizes.thumbnail != undefined) ? attachment.sizes.thumbnail.url : attachment.url;

				$button.siblings('.azl_field_image_id').val(attachment.id);
				$button.siblings('.azl_field_image_preview').html('<img src="' + thumb_url + '">');
				$button.siblings('.azl_remove_image_button').removeClass('hidden');

			});

			// Finally, open the modal
			file_frame.open();
		});

		// Remove image
		$('.azl_remove_image_button').click(function (e) {
			e.preventDefault();
			$(this).siblings('.azl_field_image_id').val('');
			$(this).siblings('.azl_field_image_preview').empty();
			$(this).addClass('hidden');
		});

        // Add Video
        $(document).on("click", ".azl_upload_video_button", function (e) {
            e.preventDefault();
            var $button = $(this);
            var ids     = [];
            var urls    = [];

            // Create the media frame.
            var file_frame = wp.media.frames.file_frame = wp.media({
                title: $(this).data('uploader_title'),
                library: { // remove these to show all
                    type: 'video' // specific mime
                },
                button: {
                    text: $(this).data('uploader_button_text')
                },
                multiple: true  // Set to true to allow multiple files to be selected
            });

            // When an video is selected, run a callback.
            file_frame.on('select', function () {

                var selection = file_frame.state().get('selection');

                if (!selection) {
                    return;
                }

                selection.each(function(attachment){
                    attachment = attachment.toJSON();
                    ids.push(attachment.id);
                    urls.push(attachment.url);
                });

                $button.siblings('.azl_field_video_url').val(urls.join());
                $button.siblings('.azl_field_video_id').val(ids.join());
                $button.siblings('.azl_remove_video_button').removeClass('hidden');

            });

            // Finally, open the modal
            file_frame.open();
        });

        // Remove Video
        $('.azl_remove_video_button').click(function (e) {
            e.preventDefault();
            $(this).siblings('.azl_field_video_id').val('');
            $(this).siblings('.azl_field_video_url').val('');
            $(this).addClass('hidden');
        });

	}); // Document ready


	/**
	 * Theme settings metabox tabs
	 */
	$(document).ready(function () {
		// category tabs
		$('.azl_tabs a').click(function () {
			var t = $(this).attr('href');
			$(this).parent().addClass('tabs').siblings('li').removeClass('tabs');
			$(this).closest('.categorydiv').find('.tabs-panel').hide();
			$(t).show();
			return false;
		});

	});


	/**
	 * Theme settings metabox "Override" checkbox auto check
	 */
	$(document).ready(function () {

		$('.azl-metabox-tab input, .azl-metabox-tab select, .azl-metabox-tab textarea').not('.azl-override-checkbox').change(function(){
			$(this).closest('tr').find('.azl-override-checkbox').prop('checked', true);
		});

	});


	/**
	 * Theme settings social links control
	 */
	$(document).ready(function () {

		if (!$.fn.sortable) return;

		$('.azl_social_links').sortable({
			items: '.azl_social_item',
			handle: '.azl_social_item_drag',
			stop: function (event, ui) {
				refresh_post_array_names($(this));
			}
		});//.disableSelection();

		$('.azl_add_social_item').click(function (e) {
			e.preventDefault;
			var $this = $(this);
			var $container = $this.siblings('.azl_social_links');
			var $new_item = $this.siblings('.azl_social_item_template').clone()
				.removeClass('azl_social_item_template').addClass('azl_social_item')
				.appendTo($container);
			$new_item.find('input').removeAttr('disabled');
			refresh_post_array_names($container);
		});

		$('.azl_social_links').on('click', '.azl_social_item_remove', function () {
			$(this).closest('.azl_social_item').remove();
			refresh_post_array_names($(this).closest('.azl_social_links'));
			return false;
		});

		function refresh_post_array_names($container) {
			$container.find('.azl_social_item').map(function (i) {
				$(this).find('input').each(function () {
					$(this).attr('name', $(this).attr('name').replace(/\[[0-9]+\]/, '[' + i + ']'));
				});
			});
		}
	});


	/**
	 * Theme settings colorpicker
	 */
	$(document).ready(function () {
		$('input.azl-colorpicker').each(function () {
			var $this = $(this),
				 opacity = $this.attr('data-has-opacity'),
				 opacity = typeof opacity !== typeof undefined && opacity !== false;

			$this.minicolors({
				opacity: opacity,
				format: opacity ? 'rgba' : 'hex'
			});

		});
	});


	/**
	 * Theme settings font loader
	 */
	$(document).ready(function () {

		$('.azl-font-loader').on('click', '.azl-fl-item-toggler', function(){
			$(this).closest('.azl-fl-item').toggleClass('opened');
		});

		$('.azl-font-loader').on('change', '.azl-fl-type-selector', function () {
			var value = $(this).val();

			var $font_item = $(this).closest('.azl-fl-item');

			$font_item.find('.azl-fl-var').hide();
			if (value == 'google') {
				$font_item.find('.azl-fl-name-google').show();
                                $font_item.find('.azl-subset-google').show();
				$font_item.find('.azl-fl-style').show();
			} else if (value == 'typekit') {
				$font_item.find('.azl-fl-typekit-id').show();
				$font_item.find('.azl-fl-name').show();
			} else if (value == 'custom') {
				$font_item.find('.azl-fl-name').show();
				$font_item.find('.azl-fl-style').show();
				$font_item.find('.azl-fl-upload').show();
                                $font_item.find('.azl-subset-google').hide();
			}

			update_title($font_item);
		});

		$('.azl-font-loader .azl-fl-type-selector').change();

		$('.azl-font-loader').on('click', '.azl-fl-removefont', function(){
			$(this).closest('.azl-fl-item').remove();
			refresh_post_array_names($(this).closest('.azl-fl-fonts-container'));
		});

		$('.azl-fl-addfont').click(function(){
			var $font_loader = $(this).closest('.azl-font-loader');
			var $container = $font_loader.find('.azl-fl-fonts-container');
			var $new_font_item = $font_loader.find('.azl-fl-font-template .azl-fl-item').first().clone();

			$new_font_item.find('input, select').removeAttr('disabled');


			$new_font_item.addClass('opened');
			$container.append($new_font_item);
			$new_font_item.find('.azl-fl-type-selector').change();

			refresh_post_array_names($container);
			update_title($new_font_item);
		});

		function update_title($font_item)
		{
			var font_name = '';
			var type = $font_item.find('.azl-fl-type-selector').val();

			if(type == 'google'){
				font_name = $font_item.find('.azl-fl-input-name-google').val();
				font_name += ' ('+$font_item.find('.azl-fl-input-style :selected').text()+'/'+$font_item.find('.azl-fl-input-weight :selected').text()+')';
			}else if(type == 'typekit'){
				font_name = $font_item.find('.azl-fl-input-name').val();
			}else if(type == 'custom'){
				font_name = $font_item.find('.azl-fl-input-name').val();
				font_name += ' ('+$font_item.find('.azl-fl-input-style :selected').text()+'/'+$font_item.find('.azl-fl-input-weight :selected').text()+')';
			}

			$font_item.find('.azl-fl-item-toggler h3').text(
				$font_item.find('.azl-fl-type-selector :selected').text() + (font_name ? ' : ' + font_name : '')
			);
		}

		function refresh_post_array_names($container)
		{
			$container.find('.azl-fl-item').map(function (i) {
				$(this).find('input, select').each(function () {
					$(this).attr('name', $(this).attr('name').replace(/\[[0-9]+\]/, '[' + i + ']'));
				});
			});
		}


		$('.azl-font-loader').on("click", ".azl-fl-upload-font", function (e) {
			e.preventDefault();
			var $button = $(this);

			// Create the media frame.
			var file_frame = wp.media.frames.file_frame = wp.media({
				title: $button.data('title'),
				library: { // remove these to show all
					//type: 'application' // specific mime
				},
				button: {
					text: 'Select'
				},
				multiple: false  // Set to true to allow multiple files to be selected
			});

			// When an image is selected, run a callback.
			file_frame.on('select', function () {
				// We set multiple to false so only get one image from the uploader

				var attachment = file_frame.state().get('selection').first().toJSON();

				$button.siblings('input').val(attachment.url);
			});

			// Finally, open the modal
			file_frame.open();
		});

	});

	/**
	 * Theme settings Skins
	 */
	$(document).ready(function () {

		$('.azl-skins').on('click', '.azl-sk-item-toggler', function(){
			$(this).closest('.azl-sk-item').toggleClass('opened');
		});


		$('.azl-skins').on('click', '.azl-sk-removeskin', function(){
			$(this).closest('.azl-sk-item').remove();
			refresh_post_array_names($(this).closest('.azl-sk-items-container'));
		});

		$('.azl-sk-addskin').click(function(){
			var $skins = $(this).closest('.azl-skins');
			var $container = $skins.find('.azl-sk-items-container');
			var $new_item = $skins.find('.azl-sk-item-template .azl-sk-item').first().clone();

			$new_item.find('input, select').removeAttr('disabled');

			$new_item.addClass('opened');
			$container.append($new_item);

			refresh_post_array_names($container);
			init_colorpicker($container);
		});

		$('.azl-sk-items-container').on('change', 'input', function(){
			update_title($(this).closest('.azl-sk-item'));
		});

		$('.azl-sk-items-container .azl-sk-item').each(function() {
			update_title($(this));
		});

		function refresh_post_array_names($container)
		{
			$container.find('.azl-sk-item').map(function (i) {
				$(this).find('input, select').each(function () {
					console.log(this);
					$(this).attr('name', $(this).attr('name').replace(/\[[0-9]+\]/, '[' + i + ']'));
				});
			});
		}

		function update_title($item)
		{
			var $previews = $item.find('.azl-sk-colors-preview');
			var colors = [];
			$item.find('.azl-colorpicker').each(function(){
				colors.push($(this).val());
			});

			var title = $item.find('.azl-skin-title').val();
			$item.find('.azl-sk-item-toggler h3 span').text(title);

			$previews.empty();
			for(var i in colors) {
				var $item = $('<div class="azl-sk-cp-item"></div>');
				$previews.append($item);
				$item.css({'background-color': colors[i]});
			}

		}

		function init_colorpicker($container)
		{
			$container.find('input.azl-colorpicker-template').each(function () {
				var $this = $(this),
					opacity = $this.attr('data-has-opacity'),
					opacity = typeof opacity !== typeof undefined && opacity !== false;

				$this.removeClass('azl-colorpicker-template').addClass('azl-colorpicker');
				$this.minicolors({
					opacity: opacity,
					format: opacity ? 'rgba' : 'hex'
				});

			});
		}

	});


	/**
	 * Sticky submit panel
	 */
	$(document).ready(function () {
		var $submit_panel = $('.azl-sticky-submit');
		if (!$submit_panel.length) return;
		var baseOffsetBottom = $submit_panel.offset().top + $submit_panel.outerHeight(true) + 15;
		var leftPos = $submit_panel.offset().left;

		$(window).scroll(function () {
			var scrollBottom = $(window).scrollTop() + window.innerHeight;
			if (scrollBottom < baseOffsetBottom) {
				$submit_panel.css({width: $submit_panel.width() + 'px', left: leftPos + 'px'})
					.addClass('azl-submit-fixed');
			} else {
				$submit_panel.removeClass('azl-submit-fixed')
					.css({width: '', left: ''});
			}
		}).scroll();
	});



})(jQuery);

/**
 * HEX to RGB convertor
 *
 * @param colour
 * @returns {{r: Number, g: Number, b: Number}}
 */
function hex2rgb(colour) {
	var r, g, b;
	if (colour.charAt(0) == '#') {
		colour = colour.substr(1);
	}
	if (colour.length == 3) {
		colour = colour.substr(0, 1) + colour.substr(0, 1) + colour.substr(1, 2) + colour.substr(1, 2) + colour.substr(2, 3) + colour.substr(2, 3);
	}
	r = colour.charAt(0) + '' + colour.charAt(1);
	g = colour.charAt(2) + '' + colour.charAt(3);
	b = colour.charAt(4) + '' + colour.charAt(5);
	r = parseInt(r, 16);
	g = parseInt(g, 16);
	b = parseInt(b, 16);
	return {
		r: r, g: g, b: b
	};
}


/**
 * Get color brightness from 0 to 255
 *
 * @param hex
 * @returns {number}
 */
function getBrightness(hex) {
	var rgb = hex2rgb(hex);
	return (rgb.r * 299 + rgb.g * 587 + rgb.b * 114) / 1000;
}