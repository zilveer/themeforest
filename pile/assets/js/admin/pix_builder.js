(function ($) {
	"use strict";

	$(document).ready(function () {
		// classify the gallery number
		$('#pixgallery, #pixvideos').on('html-change-post', function() {
			var $gallery = $( this ).children('ul'),
				nr_of_images = $gallery.children('li').length,
				metabox_class = '',
				options_container = $('#pile_project_header_area_slideshow tr:not(.display_on.hidden):not(:first-child)');

			if ( nr_of_images == 0 ) {
				metabox_class = 'no-image';
			} else if ( nr_of_images == 1 ) {
				metabox_class = 'single-image';
			} else {
				metabox_class = 'multiple-images';
			}

			if ( metabox_class !== '' ) {
				$( '#_project_aside')
					.removeClass('no-image single-image multiple-images')
					.addClass(metabox_class);
			}

			toggleSliderOptions(nr_of_images, options_container);
		});


		// Show/Hide "Slideshow Options"
		var toggleSliderOptions = function(no, el) {
			if (no <= 1) {
				el.slideUp();
			} else {
				el.slideDown();
			}
		};
		
		// Hide Slideshow Options by default
		var hideSlideshowOptions = function(el) {
			$('#pile_project_header_area_slideshow tr').not(":eq(0)").hide();
			$('#pile_project_header_area_slideshow tr:eq(1) td input').hide();
		};

		hideSlideshowOptions();
	});


	$(window).load(function () {

		// remove pixtypes hide/show and do our own
		if ( typeof cmb_ajax_data !== "undefined" && cmb_ajax_data.post_type === "product") {
			$('.pix_builder_container > style').remove();
		}

		var $page_template = $('#page_template');

		var pile_page_template_switch = function ( $page_template ) {
			if ($page_template.val() === 'page-templates/page-builder.php') {
				$('#postdivrich').hide();
			} else {
				$('#postdivrich').show();
				// tinyMce will be messed, a simple resize will do the job
				$(window).resize();
			}

			if ( typeof cmb_ajax_data !== "undefined" && cmb_ajax_data.post_type === "pile_portfolio") {
				$('#postdivrich').hide();
			} else if ( typeof cmb_ajax_data !== "undefined" && cmb_ajax_data.post_type === "product") {
				if ( 'off' === $('#enable_builder').val() ) {
					$('#postdivrich').show();
					// tinyMce will be messed, a simple resize will do the job
					$(window).resize();
				} else {
					$('#postdivrich').hide();
				}
			}
		};

		$page_template.on('change', function() {
			pile_page_template_switch( $page_template );
		});

		$('#enable_builder').on('change', function() {
			pile_page_template_switch( $('#enable_builder') );
		});


		pile_page_template_switch( $page_template );

	});
})(jQuery);