<?php
/**
 * Custom Header functionality for Monarch
 *
 * @package WordPress
 * @subpackage Monarch_Theme
 * @since Monarch 1.0
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses monarch_header_style()
 */
function monarch_custom_header_setup() {
	$color_scheme        = monarch_get_color_scheme();
	$default_text_color  = trim( $color_scheme[2], '#' );

	/**
	 * Filter Monarch custom-header support arguments.
	 *
	 * @since Monarch 1.0
	 *
	 * @param array $args {
	 *     An array of custom-header support arguments.
	 *
	 *     @type string $default_text_color     Default color of the header text.
	 *     @type int    $width                  Width in pixels of the custom header image. Default 954.
	 *     @type int    $height                 Height in pixels of the custom header image. Default 1300.
	 *     @type string $wp-head-callback       Callback function used to styles the header image and text
	 *                                          displayed on the blog.
	 * }
	 */
	add_theme_support( 'custom-header', apply_filters( 'monarch_custom_header_args', array(
		'default-text-color'     => $default_text_color,
		'width'                  => 520,
		'height'                 => 210,
		'wp-head-callback'       => 'monarch_header_style',
		'default-image'          => get_template_directory_uri() . '/css/img/logo.png',
		'uploads'                => true,
	) ) );
}
add_action( 'after_setup_theme', 'monarch_custom_header_setup' );

/**
 * Convert HEX to RGB.
 *
 * @since Monarch 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function monarch_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) == 3 ) {
		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} else if ( strlen( $color ) == 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

if ( ! function_exists( 'monarch_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @since Monarch 1.0
 *
 * @see monarch_custom_header_setup()
 */
function monarch_header_style() {
	$header_image = get_header_image();

	// If no custom options for text are set, let's bail.
	if ( empty( $header_image ) && display_header_text() ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css" id="monarch-header-css">

		.site-branding h1 a {

			/*
			 * No shorthand so the Customizer can override individual properties.
			 * @see https://core.trac.wordpress.org/ticket/31460
			 */
			background-image: url(<?php header_image(); ?>);
			background-repeat: no-repeat;
			background-position: 50% 50%;
			text-indent: -99999px;
			color: transparent;
		}

	</style>
	<?php
}
endif; // monarch_header_style

/**
 * Enqueues front-end CSS for the header background color.
 *
 * @since Monarch 1.0
 *
 * @see wp_add_inline_style()
 */
function monarch_panels_background_color_css() {
	$color_scheme            = monarch_get_color_scheme();
	$default_color           = $color_scheme[1];
	$panels_background_color = get_theme_mod( 'panels_background_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $panels_background_color === $default_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	$panels_background_color_rgb = monarch_hex2rgb( $panels_background_color );
	$light_panels_bg_color       = vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.3)', $panels_background_color_rgb );

	$css = '
		/* Custom Panels Background Color */

		#share,
		.activation .wrapper,
		.bbpress #wp-link-wrap,
		.body-bg,
		.error404 .page-header .page-title > span,
		.error404 .wrapper,
		.fost-format-bg,
		.header-panel .hp-footer,
		.header-panel,
		.modal-backdrop.in,
		.modal-login .modal-content,
		.modal-login .modal-dialog,
		.modal-search .search-form,
		.post-wrap .post-front-block .post-header,
		.registration .wrapper,
		.toolbar-scrollup .scrollup,
		.toolbar-scrollup .wp-admin,
		.user-panel,
		.user-panel::before,
		.widget.widget_bp_core_friends_widget .item-list li:hover .item,
		.widget.widget_bp_core_members_widget .item-list li:hover .item,
		body #drupalchat .chatboxcontent,
		body #drupalchat .chatboxinput,
		body #drupalchat .subpanel .chat_options,
		body #drupalchat .subpanel .drupalchat_search .drupalchat_searchinput,
		body #drupalchat .subpanel .drupalchat_search,
		body #drupalchat .subpanel li,
		body #drupalchat ul li a.active,
		body .mfp-bg,
		body .rtmedia-popup,
		body.buddydrive div#buddydrive-main ul#buddydrive-browser li.buddydrive-item .buddydrive-share-dialog,
		.widget.widget_bp_groups_widget .item-list li:hover .item {
			background-color: %1$s;
		}

		.post-wrap .fost-format-bg {
			border-bottom-color: %1$s;
		}

		@media only screen and (max-width: 1530px) {
			.cover .item-list-tabs {
				background: %1$s;
			}
			.cover .item-list-tabs ul li ul.flexMenu-popup {
				background: %1$s;
			}
		}

		body .rtmedia-popup,
		.bbpress #wp-link-wrap,
		.modal-login .modal-dialog {
			-webkit-box-shadow: 1px 1px rgba(255, 255, 255, 0.1), 2px 2px %2$s, 3px 3px rgba(255, 255, 255, 0.1), 4px 4px %2$s;
			box-shadow: 1px 1px rgba(255, 255, 255, 0.1), 2px 2px %2$s, 3px 3px rgba(255, 255, 255, 0.1), 4px 4px %2$s;
		}

	';

	wp_add_inline_style( 'monarch-style', sprintf( $css, $panels_background_color, $light_panels_bg_color ) );
}
add_action( 'wp_enqueue_scripts', 'monarch_panels_background_color_css', 11 );

/**
 * Enqueues front-end CSS for the sidebar text color.
 *
 * @since Monarch 1.0
 */
function monarch_main_hue_css() {
	$color_scheme       = monarch_get_color_scheme();
	$default_color      = $color_scheme[2];
	$main_hue           = get_theme_mod( 'main_hue', $default_color );

	// Don't do anything if the current color is the default.
	if ( $main_hue === $default_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	$main_hue_rgb   = monarch_hex2rgb( $main_hue );
	$light_main_hue = vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.3)', $main_hue_rgb );

	$css = '
		/* Custom Main Color */

		.activation #buddypress input[type="submit"],
		.header-panel .nav-info > li > a:hover,
		.header-panel .nav-primary .sub-menu a:focus,
		.header-panel .nav-primary .sub-menu a:hover,
		.header-panel .nav-primary > li > a:hover,
		.header-panel .nav-primary li a:focus .menu-item-description,
		.header-panel .nav-primary li a:hover .menu-item-description,
		.header-panel .nav-social li a:hover,
		.navbar-monarch .navbar-nav > li > a:hover,
		.navbar-monarch .navbar-nav > li.dropdown .dropdown-menu a:hover,
		.post-wrap .format-quote .post-title blockquote cite a,
		.post-wrap .format-quote .post-title blockquote cite a:hover,
		.post-wrap .format-quote .post-title blockquote cite,
		.registration #buddypress input[type="submit"],
		.relatedposts h3 a:hover,
		.widget.widget_comments ul li a:hover .post,
		.widget.widget_posts ul li h4 a:hover,
		a:focus,
		a:hover,
		body .plupload_file_action .dashicons,
		body .plupload_file_name .dashicons,
		body .plupload_file_name .dashicons-yes,
		a {
			color: %1$s;
		}

		#bp-uploader-warning::before,
		#buddypress #pass-strength-result::before,
		#buddypress div.error::before,
		#buddypress p.success::before,
		#buddypress p.updated::before,
		#buddypress p.warning::before,
		#message::before,
		#sitewide-notice::before,
		.icheckbox.checked::before,
		.indicator-hint::before,
		.iradio.checked::before,
		body .rtmedia-no-media-found::before,
		body .rtmedia-success::before,
		body.buddydrive .error::before,
		body.buddydrive div#buddydrive-main #buddydrive-status div.buddydrive-feedback p.info::before,
		body .rtmedia-warning::before,

		.bbp-forum-content ul.sticky::after,
		.bbp-topics ul.sticky::after,
		.bbp-topics ul.super-sticky::after,
		.bbp-topics-front ul.super-sticky::after,

		#rtmedia_create_new_album:focus,
		#subscription-toggle a:focus,
		.acomment-options a:focus,
		.activation #buddypress input[type="submit"]:focus,
		.activity-comments li.show-all a:focus,
		.activity-read-more a:focus,
		.bbpress #wp-link-cancel .button:focus,
		.bbpress #wp-link-submit:focus,
		.bp-login-widget-user-logout .logout:focus,
		.bp-title-button:focus,
		.btn.btn-default:focus,
		.btn.btn-primary:focus,
		.btn:focus,
		.button-nav li a:focus,
		.button:focus,
		.generic-button a:focus,
		.load-more a:focus,
		.load-newest a:focus,
		.notifications a.delete:focus,
		.notifications a.mark-read:focus,
		.notifications a.mark-unread:focus,
		.registration #buddypress input[type="submit"]:focus,
		.thread-options a.delete:focus,
		.thread-options a.read:focus,
		.thread-options a.unread:focus,
		.user-panel li.current-menu-item a:focus,
		.wp-social-login-widget a:focus,
		body #buddypress #rtm-media-options-list .rtm-options .button:focus,
		body #buddypress .rtmedia-actions-before-comments .rtmedia-like:focus,
		body.buddydrive div#buddydrive-main ul#buddydrive-manage-actions li a:focus,
		body.buddydrive div#buddydrive-main .button-primary:focus,
		body.buddydrive div#buddydrive-main #buddydrive-load-more:focus,
		body.buddydrive div#buddydrive-main #buddydrive-uploader #bp-upload-ui:not(.drag-drop) #bp-browse-button:focus,
		body #rtm-media-options-list .rtm-options.rtm-options .rtmedia-delete-album:focus,
		body.buddydrive div#buddydrive-main .buddydrive-actions a:focus,
		body #whats-new-submit #aw-whats-new-submit:focus,
		body .imgedit-group .dashicons.imgedit-help-toggle:focus,
		body .rtm-media-options .rtm-media-options-list .rtmedia-action-buttons:focus,
		body .rtm-media-options .rtmedia-upload-media-link:focus,
		body .rtm-options.rtm-options a:focus,
		body .rtm-tabs a:focus,
		body .rtmedia-actions-before-comments .rtmedia-comment-link:focus,
		body .rtmedia-add-media-button:focus,
		body .rtmedia-container .rtm-load-more .rtmedia-page-link.button:focus,
		body .rtmedia-container .rtm-load-more a#rtMedia-galary-next:focus,
		body .rtmedia-edit-media-tabs .rtm-tabs a:focus,
		body .rtmedia-gallery-item-actions a:focus,
		body .rtmedia-single-container button.rtmedia-like:focus,
		body .rtmedia-upload-media-link:focus,
		body .wp-polls .Buttons:focus,
		body a.rtmedia-upload-media-link:focus,
		button[type="submit"]:focus,
		input[type="button"]:focus,
		input[type="submit"]:focus,

		#rtmedia_create_new_album:hover,
		#subscription-toggle a:hover,
		.acomment-options a:hover,
		.activation #buddypress input[type="submit"]:hover,
		.activity-comments li.show-all a:hover,
		.activity-read-more a:hover,
		.bbpress #wp-link-cancel .button:hover,
		.bbpress #wp-link-submit:hover,
		.bp-login-widget-user-logout .logout:hover,
		.bp-title-button:hover,
		.btn.btn-default:hover,
		.btn.btn-primary:hover,
		.btn:hover,
		.button-nav li a:hover,
		.button:hover,
		.cover-image-container #item-buttons .generic-button a:hover,
		.generic-button a:hover,
		.load-more a:hover,
		.load-newest a:hover,
		.notifications a.delete:hover,
		.notifications a.mark-read:hover,
		.notifications a.mark-unread:hover,
		.registration #buddypress input[type="submit"]:hover,
		.thread-options a.delete:hover,
		.thread-options a.read:hover,
		.thread-options a.unread:hover,
		.user-panel li.current-menu-item a:hover,
		.wp-social-login-widget a:hover,
		body #buddypress #rtm-media-options-list .rtm-options .button:hover,
		body #buddypress #rtmedia-single-media-container.rtmedia-single-media .rtm-options .button:hover,
		body.buddydrive div#buddydrive-main ul#buddydrive-manage-actions li a:hover,
		body.buddydrive div#buddydrive-main .button-primary:hover,
		body.buddydrive div#buddydrive-main .buddydrive-actions a:hover,
		body.buddydrive div#buddydrive-main #buddydrive-load-more:hover,
		body.buddydrive div#buddydrive-main #buddydrive-uploader #bp-upload-ui:not(.drag-drop) #bp-browse-button:hover,
		body #buddypress .rtmedia-actions-before-comments .rtmedia-like:hover,
		body #rtm-media-options-list .rtm-options.rtm-options .rtmedia-delete-album:hover,
		body #whats-new-submit #aw-whats-new-submit:hover,
		body .imgedit-group .dashicons.imgedit-help-toggle:hover,
		body .plupload_file_progress,
		body .rtm-media-options .rtm-media-options-list .rtmedia-action-buttons:hover,
		body .rtm-media-options .rtmedia-upload-media-link:hover,
		body .rtm-options.rtm-options a:hover,
		body .rtm-tabs a:hover,
		body .rtmedia-actions-before-comments .rtmedia-comment-link:hover,
		body .rtmedia-add-media-button:hover,
		body .rtmedia-container .rtm-load-more .rtmedia-page-link.button:hover,
		body .rtmedia-container .rtm-load-more a#rtMedia-galary-next:hover,
		body .rtmedia-edit-media-tabs .rtm-tabs a:hover,
		body .rtmedia-gallery-item-actions a:hover,
		body .rtmedia-single-container button.rtmedia-like:hover,
		body .rtmedia-upload-media-link:hover,
		body .wp-polls .Buttons:hover,
		body a.rtmedia-upload-media-link:hover,
		button[type="submit"]:hover,
		input[type="button"]:hover,
		input[type="submit"]:hover,

		.activation #buddypress input[type="submit"]:active,
		.registration #buddypress input[type="submit"]:active,

		#bbpress-forums div.bbp-forum-author .bbp-author-role,
		#bbpress-forums div.bbp-reply-author .bbp-author-role,
		#bbpress-forums div.bbp-topic-author .bbp-author-role,
		#buddypress .item-list-tabs ul li a span,
		.cover-image-container,
		.header-panel .site-branding,
		.post-wrap .post-format,
		.post-wrap .sticky-post,
		.post-wrap article .post-categories li a,
		.relatedposts .relatedpost .post-info .category,
		.scrollbar-inner > .scroll-element .scroll-bar,
		.tooltip-inner,
		.user-panel .buddy-avatar .notifications,
		.user-panel li.current-menu-item a,
		.widget-title span,
		div.bp-avatar-status .bp-bar,
		div.bp-cover-image-status .bp-bar {
			background-color: %1$s;
		}

		#bp-uploader-warning,
		#buddypress div.error,
		#buddypress p.success,
		#buddypress p.updated,
		#buddypress p.warning,
		#message,
		#pass-strength-result,
		#sitewide-notice,
		.activation .content,
		.bbp-forum-content ul.sticky::before,
		.bbp-topics ul.sticky::before,
		.bbp-topics ul.super-sticky::before,
		.bbp-topics-front ul.super-sticky::before,
		.bbpress #wp-link .query-notice .query-notice-default,
		.bbpress #wp-link .query-notice .query-notice-hint,
		.error404 .wrapper,
		.indicator-hint,
		.post-wrap .post-format::after,
		.post-wrap .sticky-post::after,
		.registration .content,
		.tooltip.bottom .tooltip-arrow,
		.tooltip.left .tooltip-arrow,
		.tooltip.right .tooltip-arrow,
		.tooltip.top .tooltip-arrow,
		.widget-title,
		body.buddydrive div#buddydrive-main #buddydrive-status div.buddydrive-feedback p.info,
		body.buddydrive .error,
		body .rtmedia-no-media-found,
		body .rtmedia-success,
		body .rtmedia-warning {
			border-color: %1$s;
		}

		.post-wrap .fost-format-bg {
			border-top-color: %1$s;
		}

		#rtmedia_create_new_album,
		#subscription-toggle a,
		.activation #buddypress input[type="submit"],
		.activity-comments li.show-all a,
		.activity-read-more a,
		.bbpress #wp-link-cancel .button,
		.bbpress #wp-link-submit,
		.bp-title-button,
		.btn,
		.btn.btn-default,
		.btn.btn-primary,
		.button-nav li a,
		.icheckbox,
		.registration #buddypress input[type="submit"],
		.wp-social-login-widget a,
		body #whats-new-submit #aw-whats-new-submit,
		body.buddydrive div#buddydrive-main .button-primary,
		body.buddydrive div#buddydrive-main .buddydrive-actions a,
		body.buddydrive div#buddydrive-main #buddydrive-load-more,
		body.buddydrive div#buddydrive-main #buddydrive-uploader #bp-upload-ui:not(.drag-drop) #bp-browse-button,
		body.buddydrive div#buddydrive-main ul#buddydrive-browser.bulk-select li.buddydrive-item.bulk-selected .buddydrive-icon,
		body.buddydrive div#buddydrive-main ul#buddydrive-browser.bulk-select li.buddydrive-item.bulk-selected .buddydrive-content,
		body .rtmedia-add-media-button,
		body .rtmedia-container .rtm-load-more .rtmedia-page-link.button,
		body .rtmedia-gallery-item-actions a,
		body .rtmedia-single-container button.rtmedia-like,
		body .wp-polls .Buttons,
		button[type="submit"],
		input[type="button"],
		input[type="submit"] {
			border-color: %2$s;
		}

		.icheckbox::before,
		.infinite-loader .spinner,
		.infinite-loader .spinner::before,
		.infinite-loader .spinner::after {
			background: %2$s;
		}

		@media only screen and (min-width: 1200px) and (max-width: 1360px), (max-width: 768px) {
			.user-panel .nav-buddy li.current-menu-item a,
			.user-panel .nav-buddy li.current-menu-item a::before {
				background-color: %1$s;
			}

			.user-panel .nav-buddy li a:focus,
			.user-panel .nav-buddy li a:hover {
				background: %1$s;
			}
		}

		::-webkit-scrollbar-thumb,
		::-webkit-scrollbar-thumb:window-inactive,
		::selection {
			background-color: %1$s;
		}
	';

	wp_add_inline_style( 'monarch-style', sprintf( $css, $main_hue, $light_main_hue ) );
}
add_action( 'wp_enqueue_scripts', 'monarch_main_hue_css', 11 );
