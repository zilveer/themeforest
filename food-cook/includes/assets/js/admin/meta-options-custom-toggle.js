/*-------------------------------------------------------------------------------------

FILE INFORMATION

Description: Custom toggle logic for "Meta Options".
Date Created: 2011-07-06.
Author: Cobus, Matty.
Since: 4.3.0


TABLE OF CONTENTS

- Logic for toggling of the "Slide Page" option, depending on page template.

-------------------------------------------------------------------------------------*/

jQuery(document).ready(function(){

/*-----------------------------------------------------------------------------------*/
/* - Logic for toggling of the "Slide Page" option, depending on page template. */
/*-----------------------------------------------------------------------------------*/

	var showValue = 'template-home.php';
	var elementName = 'select#page_template';
	var toggleElements = 'select[name="_revolutionslider"] ';
	
	// Hide elements to be hidden.
	jQuery( toggleElements ).parents( 'tr' ).hide();
	
	// Toggle the main elements on load.
	if ( jQuery( elementName ).val() == showValue ) {
		jQuery( toggleElements ).parents( 'tr' ).show();
	}
	
	// Toggle the "Slide Page" option on change.
	jQuery( elementName ).change( function ( e ) {
		if ( jQuery( elementName ).val() == showValue ) {
			jQuery( toggleElements ).parents( 'tr' ).show();
		} else {
			jQuery( toggleElements ).parents( 'tr' ).hide();
		}
	});

}); // End jQuery()

jQuery(window).on('load', function($) {
    var $ = jQuery,
            show = $('[name="df_metabox_header_style"][value="show"]'),
            hide = $('[name="df_metabox_header_style"][value="hide"]'),
            fancy = $('[name="df_metabox_header_style"][value="fancy"]'),
            normal = $('[name="df_metabox_background_options"][value="normal"]'),
            parallax = $('[name="df_metabox_background_options"][value="parallax"]'),
            horParallax = $('[name="df_metabox_background_options"][value="horizontal-parallax"]'),
            revo = $('[name="df_metabox_slider_options"][value="rev"]');

    /* ================================================================================================= */
    /* Header Options                                                                                    */
    /* ================================================================================================= */
    // Fancy Header
    function showFancyHeaderStyleOptions() {
        $('[name="df_metabox_header_align"]').parent().parent().parent().removeClass('df-metabox-hidden');
        $('#df_metabox_title').parent().parent().removeClass('df-metabox-hidden');
        $('#df_metabox_title_color').parent().parent().parent().parent().removeClass('df-metabox-hidden');
        $('#df_metabox_subtitle').parent().parent().removeClass('df-metabox-hidden');
        $('#df_metabox_subtitle_color').parent().parent().parent().parent().removeClass('df-metabox-hidden');
        $('[name="df_metabox_background_options"]').parent().parent().parent().removeClass('df-metabox-hidden');
        $('#df_metabox_background_color').parent().parent().parent().parent().removeClass('df-metabox-hidden');
        $('[data-field_id="df_metabox_upload_image_fancy_title"]').parent().parent().removeClass('df-metabox-hidden');
        $('[data-field_id="df_metabox_upload_video_fancy_title"]').parent().parent().removeClass('df-metabox-hidden');
        $('#df_metabox_repeat_options').parent().parent().removeClass('df-metabox-hidden');
        $('#df_metabox_repeat_x').parent().parent().removeClass('df-metabox-hidden');
        $('#df_metabox_repeat_y').parent().parent().removeClass('df-metabox-hidden');
        $('#df_metabox_fancy_parallax_speed').parent().parent().removeClass('df-metabox-hidden');
        $('#df_metabox_header_height_setting').parent().parent().removeClass('df-metabox-hidden');
        $('#df_metabox_header_border').parent().parent().removeClass('df-metabox-hidden');
        $('#df_metabox_header_border_color_setting').parent().parent().parent().parent().removeClass('df-metabox-hidden');

        if (normal.is(':checked')) {
            showNormalOptions();
            hideParallaxOptions();
            hideVideoOptions();
        } else if (parallax.is(':checked') || horParallax.is(':checked')) {
            showParallaxOptions();
            hideNormalOptions();
            hideVideoOptions();
        } else {
            showVideoOptions();
            hideNormalOptions();
            hideParallaxOptions();
        }
        if ($('#df_metabox_header_border').is(':checked')) {
            showHeaderBorderOptions();
        } else {
            hideHeaderBorderOptions();
        }
    }

    function hideFancyHeaderStyleOptions() {
        $('[name="df_metabox_header_align"]').parent().parent().parent().addClass('df-metabox-hidden');
        $('#df_metabox_title').parent().parent().addClass('df-metabox-hidden');
        $('#df_metabox_title_color').parent().parent().parent().parent().addClass('df-metabox-hidden');
        $('#df_metabox_subtitle').parent().parent().addClass('df-metabox-hidden');
        $('#df_metabox_subtitle_color').parent().parent().parent().parent().addClass('df-metabox-hidden');
        $('[name="df_metabox_background_options"]').parent().parent().parent().addClass('df-metabox-hidden');
        $('#df_metabox_background_color').parent().parent().parent().parent().addClass('df-metabox-hidden');
        $('[data-field_id="df_metabox_upload_image_fancy_title"]').parent().parent().addClass('df-metabox-hidden');
        $('[data-field_id="df_metabox_upload_video_fancy_title"]').parent().parent().addClass('df-metabox-hidden');
        $('#df_metabox_repeat_options').parent().parent().addClass('df-metabox-hidden');
        $('#df_metabox_repeat_x').parent().parent().addClass('df-metabox-hidden');
        $('#df_metabox_repeat_y').parent().parent().addClass('df-metabox-hidden');
        $('#df_metabox_fancy_parallax_speed').parent().parent().addClass('df-metabox-hidden');
        $('#df_metabox_header_height_setting').parent().parent().addClass('df-metabox-hidden');
        $('#df_metabox_header_border').parent().parent().addClass('df-metabox-hidden');
        $('#df_metabox_header_border_color_setting').parent().parent().parent().parent().addClass('df-metabox-hidden');

        hideNormalOptions();
        hideParallaxOptions();
        hideVideoOptions();
        hideHeaderBorderOptions();
    }

    // Background Options
    function showNormalOptions() {
        $('[data-field_id="df_metabox_upload_image_fancy_title"]').parent().parent().removeClass('df-metabox-hidden');
        $('#df_metabox_repeat_options').parent().parent().removeClass('df-metabox-hidden');
        $('#df_metabox_repeat_x').parent().parent().removeClass('df-metabox-hidden');
        $('#df_metabox_repeat_y').parent().parent().removeClass('df-metabox-hidden');
    }
    function hideNormalOptions() {
        $('#df_metabox_repeat_options').parent().parent().addClass('df-metabox-hidden');
        $('#df_metabox_repeat_x').parent().parent().addClass('df-metabox-hidden');
        $('#df_metabox_repeat_y').parent().parent().addClass('df-metabox-hidden');
    }
    function showParallaxOptions() {
        $('[data-field_id="df_metabox_upload_image_fancy_title"]').parent().parent().removeClass('df-metabox-hidden');
        $('#df_metabox_fancy_parallax_speed').parent().parent().removeClass('df-metabox-hidden');
    }
    function hideParallaxOptions() {
        $('#df_metabox_fancy_parallax_speed').parent().parent().addClass('df-metabox-hidden');
    }
    function showVideoOptions() {
        $('[data-field_id="df_metabox_upload_image_fancy_title"]').parent().parent().addClass('df-metabox-hidden');
        $('[data-field_id="df_metabox_upload_video_fancy_title"]').parent().parent().removeClass('df-metabox-hidden');
    }
    function hideVideoOptions() {
        $('[data-field_id="df_metabox_upload_video_fancy_title"]').parent().parent().addClass('df-metabox-hidden');
    }
    // Background Options

    // border
    function showHeaderBorderOptions() {
        $('#df_metabox_header_border_color_setting').parent().parent().parent().parent().removeClass('df-metabox-hidden');
    }
    function hideHeaderBorderOptions() {
        $('#df_metabox_header_border_color_setting').parent().parent().parent().parent().addClass('df-metabox-hidden');
    }
    // border
    // Fancy Header

    // Slider Header
    function showSliderHeaderStyleOptions() {
        $('[name="df_metabox_slider_options"]').parent().parent().parent().removeClass('df-metabox-hidden');
        $('#df_metabox_revolution_slider').parent().parent().removeClass('df-metabox-hidden');
        $('#df_metabox_royal_slider').parent().parent().removeClass('df-metabox-hidden');

        if (revo.is(':checked')) {
            showRevoSlideOptions();
            hideRoyalSlideOptions();
        } else {
            hideRevoSlideOptions();
            showRoyalSlideOptions();
        }
    }

    function hideSliderHeaderStyleOptions() {
        $('[name="df_metabox_slider_options"]').parent().parent().parent().addClass('df-metabox-hidden');
        $('#df_metabox_revolution_slider').parent().parent().addClass('df-metabox-hidden');
        $('#df_metabox_royal_slider').parent().parent().addClass('df-metabox-hidden');

        hideRevoSlideOptions();
        hideRoyalSlideOptions();
    }

    function showRevoSlideOptions() {
        $('#df_metabox_revolution_slider').parent().parent().removeClass('df-metabox-hidden');
    }
    function hideRevoSlideOptions() {
        $('#df_metabox_revolution_slider').parent().parent().addClass('df-metabox-hidden');
    }
    function showRoyalSlideOptions() {
        $('#df_metabox_royal_slider').parent().parent().removeClass('df-metabox-hidden');
    }
    function hideRoyalSlideOptions() {
        $('#df_metabox_royal_slider').parent().parent().addClass('df-metabox-hidden');
    }
    // Slider Header

    // Conditional
    if (show.is(':checked') || hide.is(':checked')) {
        hideSliderHeaderStyleOptions();
        hideFancyHeaderStyleOptions();
    } else if (fancy.is(':checked')) {
        showFancyHeaderStyleOptions();
        hideSliderHeaderStyleOptions();
    } else {
        hideFancyHeaderStyleOptions();
        showSliderHeaderStyleOptions();
    }

    $('[name="df_metabox_header_style"]').change(function() {
        if (this.value === 'show' || this.value === 'hide') {
            hideSliderHeaderStyleOptions();
            hideFancyHeaderStyleOptions();
        } else if (this.value === 'fancy') {
            showFancyHeaderStyleOptions();
            hideSliderHeaderStyleOptions();
        } else {
            hideFancyHeaderStyleOptions();
            showSliderHeaderStyleOptions();
        }
    });

    $('[name="df_metabox_background_options"]').change(function() {
        if (this.value === 'normal') {
            showNormalOptions();
            hideParallaxOptions();
            hideVideoOptions();
        } else if (this.value === 'parallax' || this.value === 'horizontal-parallax') {
            hideNormalOptions();
            showParallaxOptions();
            hideVideoOptions();
        } else {
            hideNormalOptions();
            hideParallaxOptions();
            showVideoOptions();
        }
    });

    $('#df_metabox_header_border').change(function() {
        if (this.checked) {
            showHeaderBorderOptions();
        } else {
            hideHeaderBorderOptions();
        }
    });

    $('[name="df_metabox_slider_options"]').change(function() {
        if (this.value === 'rev') {
            showRevoSlideOptions();
            hideRoyalSlideOptions();
        } else {
            hideRevoSlideOptions();
            showRoyalSlideOptions();
        }
    });
    /* ================================================================================================= */
    /* Header Options                                                                                    */
    /* ================================================================================================= */
});