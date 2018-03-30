// This file doesn't actually load on the front-end...it's minified and included inline via metabox.php
( function( $ ) {
	"use strict";

	$( document ).on( 'ready', function() {

		// Date picker
		var $date = $( '.wpex-date-meta' );
		if ( $date.length && $.datepicker ) {
			$date.datepicker( {
				dateFormat: "<?php echo esc_html( $date_format ); ?>"
			});
		}

		// Tabs
		$( 'div#wpex-metabox ul.wp-tab-bar a').click( function() {
			var lis = $( '#wpex-metabox ul.wp-tab-bar li' ),
				data = $( this ).data( 'tab' ),
				tabs = $( '#wpex-metabox div.wp-tab-panel');
			$( lis ).removeClass( 'wp-tab-active' );
			$( tabs ).hide();
			$( data ).show();
			$( this ).parent( 'li' ).addClass( 'wp-tab-active' );
			return false;
		} );

		// Color picker
		$('div#wpex-metabox .wpex-mb-color-field').wpColorPicker();

		// Media uploader
		var _custom_media = true,
		_orig_send_attachment = wp.media.editor.send.attachment;

		$('div#wpex-metabox .wpex-mb-uploader').click(function(e) {
			var send_attachment_bkp	= wp.media.editor.send.attachment,
				button = $(this),
				id = button.prev();
			wp.media.editor.send.attachment = function(props, attachment){
				if ( _custom_media ) {
					$( id ).val( attachment.id );
				} else {
					return _orig_send_attachment.apply( this, [props, attachment] );
				};
			}
			wp.media.editor.open( button );
			return false;
		} );

		$( 'div#wpex-metabox .add_media' ).on('click', function() {
			_custom_media = false;
		} );

		// Reset
		$( 'div#wpex-metabox div.wpex-mb-reset a.wpex-reset-btn' ).click( function() {
			var $confirm = $( 'div.wpex-mb-reset div.wpex-reset-checkbox' ),
				$txt     = $confirm.is(':visible') ? "<?php esc_html_e(  'Reset Settings', 'total' ); ?>" : "<?php esc_html_e(  'Cancel Reset', 'total' ); ?>";
			$( this ).text( $txt );
			$( 'div.wpex-mb-reset div.wpex-reset-checkbox input' ).attr('checked', false);
			$confirm.toggle();
		});

		// Show hide title options
		var titleMainSettings   = $( '#wpex_disable_header_margin_tr, #wpex_post_subheading_tr,#wpex_post_title_style_tr'),
			titleStyleField     = $( 'div#wpex-metabox select#wpex_post_title_style' ),
			titleStyleFieldVal  = titleStyleField.val(),
			pageTitleBgSettings = $( '#wpex_post_title_background_color_tr, #wpex_post_title_background_redux_tr,#wpex_post_title_height_tr,#wpex_post_title_background_overlay_tr,#wpex_post_title_background_overlay_opacity_tr'),
			solidColorElements  = $( '#wpex_post_title_background_color_tr');

		// Show hide title style settings
		if ( titleStyleFieldVal === 'background-image' ) {
			pageTitleBgSettings.show();
		} else if ( titleStyleFieldVal === 'solid-color' ) {
			solidColorElements.show();
		}

		titleStyleField.change(function () {
			pageTitleBgSettings.hide();
			if ( $(this).val() == 'background-image' ) {
				pageTitleBgSettings.show();
			}
			else if ( $(this).val() === 'solid-color' ) {
				solidColorElements.show();
			}
		} );

		// Show hide Overlay options
		var overlayField = $( 'div#wpex-metabox select#wpex_overlay_header' ),
			overlayFieldDependents = $( '#wpex_overlay_header_style_tr, #wpex_overlay_header_font_size_tr,#wpex_overlay_header_logo_tr,#wpex_overlay_header_logo_retina_tr,#wpex_overlay_header_logo_retina_height_tr,#wpex_overlay_header_dropdown_style_tr');
		if ( overlayField.val() === 'on' ) {
			overlayFieldDependents.show();
		} else {
			overlayFieldDependents.hide();
		}
		overlayField.change(function () {
			if ( $(this).val() === 'on' ) {
				overlayFieldDependents.show();
			} else {
				overlayFieldDependents.hide();
			}
		} );


	} );

} ) ( jQuery );