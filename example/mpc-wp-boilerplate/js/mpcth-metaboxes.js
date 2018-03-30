jQuery(document).ready(function($) {

/* ---------------------------------------------------------------- */
/*	Custom Meta Boxes
/* ---------------------------------------------------------------- */

	// Move Post Settings below Post Editor
	var post_settings = $('.mpcth-meta-box');
	var composer = post_settings.siblings('#wpb_visual_composer');

	if(composer.length) {
		post_settings.insertAfter(composer);
	} else {
		post_settings.siblings().first().before(post_settings);
	}

	// Display footer columns
	var custom_footer = $('#mpcth_otc_custom_footer'),
		custom_footer_next = custom_footer.parents('.mpcth-of-section').next('.mpcth-of-section');

	custom_footer.on('click', function() {
		custom_footer.is(':checked') ? custom_footer_next.slideDown() : custom_footer_next.slideUp();
	});

	custom_footer.is(':checked') ? custom_footer_next.slideDown() : custom_footer_next.slideUp();

	// Display custom lightbox
	var custom_lightbox = $('#mpcth_otc_lightbox_enabled'),
		custom_lightbox_next = custom_lightbox.parents('.mpcth-of-section').nextAll();

	custom_lightbox.on('click', function() {
		custom_lightbox.is(':checked') ? custom_lightbox_next.slideDown() : custom_lightbox_next.slideUp();
	});

	custom_lightbox.is(':checked') ? custom_lightbox_next.slideDown() : custom_lightbox_next.slideUp();

	// Display custom page size
	var custom_page_size = $('#mpcth_otc_custom_page_size'),
		custom_page_size_next = custom_page_size.parents('.mpcth-of-section').next();

	custom_page_size.on('click', function() {
		custom_page_size.is(':checked') ? custom_page_size_next.stop().slideDown() : custom_page_size_next.stop().slideUp();
	});

	custom_page_size.is(':checked') ? custom_page_size_next.slideDown() : custom_page_size_next.slideUp();

	// Display custom sidebar
	var custom_sidebar = $('#mpcth_otc_sidebar_right, #mpcth_otc_sidebar_none, #mpcth_otc_sidebar_left'),
		custom_sidebar_next = custom_sidebar.parents('.mpcth-of-section').next('.mpcth-of-section');

	custom_sidebar.on('click', function() {
		$(this).val() != 'none' ? custom_sidebar_next.slideDown() : custom_sidebar_next.slideUp();
	});

	custom_sidebar.filter(':checked').val() != 'none' ? custom_sidebar_next.slideDown() : custom_sidebar_next.slideUp();

	var custom_sidebar_position = $('#mpcth_otc_custom_sidebar_position'),
		custom_sidebar_position_next = custom_sidebar_position.parents('.mpcth-of-section').nextAll();

	custom_sidebar_position.on('click', function() {
		custom_sidebar_position.is(':checked') ? custom_sidebar_position_next.stop().slideDown() : custom_sidebar_position_next.stop().slideUp();
		if(custom_sidebar_position.is(':checked'))
			custom_sidebar.filter(':checked').val() != 'none' ? custom_sidebar_next.slideDown() : custom_sidebar_next.slideUp();
	});

	custom_sidebar_position.is(':checked') ? custom_sidebar_position_next.slideDown() : custom_sidebar_position_next.slideUp();

	// Swap Background Sources
	var background_type = $('#mpcth_otc_background_type'),
		backbround_embed = $('#mpcth_otc_background_embed_source').parents('.mpcth-of-section'),
		backbround_image = $('#mpcth_otc_background_image_source, #mpcth_otc_background_image_pattern').parents('.mpcth-of-section');

	background_type.on('change', function() {
		if($(this).val() == 'image') {
			backbround_embed.slideUp();
			backbround_image.slideDown();
		} else if($(this).val() == 'embed') {
			backbround_embed.slideDown();
			backbround_image.slideUp();
		} else {
			backbround_embed.slideUp();
			backbround_image.slideUp();
		}
	});

	background_type.trigger('change');

/* ---------------------------------------------------------------- */
/* Custom Post Types
/* ---------------------------------------------------------------- */

	if($('#post-formats-select').length) {
		displayPostFormatType($('#post-formats-select input:checked').val());

		$('#post-formats-select input').on('change', function() {
			displayPostFormatType($(this).val());
		});
	}

	function displayPostFormatType(type) {
		if(type == 0) type = 'standard';

		$('.mpcth-meta-box .mpcth-post-format-setup .mpcth-of-section').stop().slideUp();
		$('.mpcth-meta-box div.mpcth-post-format-all, .mpcth-meta-box div.mpcth-post-format-' + type).stop().slideDown();
	}

/* ---------------------------------------------------------------- */
/* Disable Lightbox On Post Types Different Then Image/Gallery
/* ---------------------------------------------------------------- */

	if($('#post-formats-select').length) {
		toggleLightboxSettings($('#post-formats-select input:checked').val());

		$('#post-formats-select input').on('change', function() {
			toggleLightboxSettings($(this).val());
		});
	}

	function toggleLightboxSettings(type) {
		if(type == 0) type = 'standard';
		var $section = $('.mpcth-of-lightbox-settings');

		if(type == 'image' || type == 'gallery' || type == 'standard') {
			$('.mpcth-of-lightbox-settings').stop().slideDown();
		} else {
			$('.mpcth-of-lightbox-settings').stop().slideUp();

			if($section.hasClass('mpcth-of-ac-open'))
				$section.click();

			if($('#mpcth_otc_lightbox_enabled').is(':checked'))
				$('#mpcth_otc_lightbox_enabled').click();
		}
	}

/* ---------------------------------------------------------------- */
/* Gallery Upload
/* ---------------------------------------------------------------- */

	$('.upload_gallery_button').on('click', function(e) {
		var $this = $(this);
			ids = $this.siblings('.mpcth-gallery-images-val').val();
		if(ids == '') ids = ' ';

		var $gallery = wp.media.gallery.edit('[gallery ids="' + ids + '"]');

		$gallery.on('update', function(obj) {
			var images = obj.models;
			var list = [];
			var markup = '';

			for(i = 0; i < images.length; i++) {
				list[i] = images[i].id;
				markup += '<img width="100" height="100" src="' + images[i].attributes.sizes.thumbnail.url + '" class="mpcth-gallery-image" alt="Gallery image ' + i + '">';
			}

			$this.siblings('.mpcth-gallery-images-val').val(list.join(','));
			$this.siblings('.mpcth-gallery-images-wrap').html(markup);
		})

		e.preventDefault();
	});

/* ---------------------------------------------------------------- */
/* Custom Page Template
/* ---------------------------------------------------------------- */

	if($('#page_template').length) {
		displayPageFormatType($('#page_template').val());

		$('#page_template').on('change', function() {
			displayPageFormatType($(this).val());
		});
	}

	function displayPageFormatType(type) {
		switch(type) {
			case 'blog-template.php':
				var id = '#mpcth_blog_settings';
				break;
			case 'portfolio-template.php':
				var id = '#mpcth_portfolio_settings';
				break;
			default:
				var id = '';
		}

		var $pageSize = $('.mpcth-of-section-default-page');
		var $pageSidebar = $('.mpcth-of-section-sidebar');

		$('.mpcth-meta-box:not(#mpcth_page_settings)').stop().fadeOut();
		$(id).stop().delay(200).fadeIn();

		if(id == '') {
			$pageSize.stop().slideDown();
			$pageSidebar.stop().slideDown();

			custom_page_size.is(':checked') ? custom_page_size_next.slideDown() : custom_page_size_next.slideUp();
		} else {
			if(custom_page_size.is(':checked')) custom_page_size.click();
			$('#mpcth_otc_page_align').val('default');

			$pageSize.stop().slideUp();

			if(id == '#mpcth_portfolio_settings')
				$pageSidebar.stop().slideUp();
			else
				$pageSidebar.stop().slideDown();
		}
	}
});