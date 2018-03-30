<?php
/**
 * Monarch Customizer functionality
 *
 * @package WordPress
 * @subpackage Monarch_Theme
 * @since Monarch 1.3
 */

/**
 * Enqueues front-end CSS for font scheme.
 *
 * @since Monarch 1.1
 *
 * @see wp_add_inline_style()
 */
function monarch_get_font_scheme_css() {
	$monarch_font_primary             = get_theme_mod( 'monarch_font_primary', 'Merriweather' );
	$monarch_font_secondary           = get_theme_mod( 'monarch_font_secondary', 'Playfair Display' );
	$monarch_font_logo                = get_theme_mod( 'monarch_font_logo', 'UnifrakturCook' );
	$monarch_font_size_logo           = get_theme_mod( 'monarch_font_size_logo', '29' );
	$monarch_font_letter_spacing_logo = get_theme_mod( 'monarch_font_letter_spacing_logo', '8' );
	$monarch_font_weight_logo         = get_theme_mod( 'monarch_font_weight_logo', 'normal' );

	$css = <<<CSS

/* GOOGLE FONT */
#buddypress .standard-form .radio ul,
#settings-form td,
.bbp-forum-description .bbp-author-name,
.bbp-topic-description .bbp-author-name,
.bbp-topic-description, .bbp-forum-description,
.gallery-caption,
.rtmedia-popup label,
.tooltip,
.wp-polls label,
body {
	font-family: '{$monarch_font_primary}', serif;
}

#bbpress-forums ul li.bbp-forum-info .bbp-forums-list li a,
#buddypress #message-thread .activity,
#buddypress #message-thread strong,
#buddypress div#message-thread strong a,
#buddypress div.error,
#buddypress p.success,
#buddypress p.updated,
#buddypress p.warning,
body.buddydrive #buddydrive-main .subsubsub,
#latest-update,
#link-modal-title,
#message,
#rtmedia_create_new_album,
#settings-form,
.aboutwidget,
.ac-reply-cancel,
.acomment-meta,
.acomment-options a,
.activity-comments li.show-all a,
.activity-greeting,
.activity-header,
.activity-read-more a,
.bbp-author-name,
.bbp-breadcrumb,
.bbp-footer,
.bbp-form legend,
.bbp-forum-title,
.bbp-header,
.bbp-pagination,
.bbp-reply-header,
.bbp-topic-meta,
.bbp-topic-permalink,
.bbp-topic-tags,
.bp-avatar-nav,
.bp-login-widget-user-link,
.bp-login-widget-user-logout .logout,
.btn,
.button,
.comment-meta,
.drag-drop-info,
.forum-titles,
.generic-button a,
.generic-button a,
.item-list-tabs,
.item-options,
.item-title,
.load-more a,
.load-more,
.load-newest a,
.nav-links,
.notifications a.delete,
.notifications a.mark-read,
.notifications a.mark-unread,
.page-numbers,
.pager,
.pagination,
.popover,
.post-categories,
.post-category,
.post-date,
.post-footer,
.post-format,
.post-navigation .nav-links .meta-nav,
.post-tags,
.relatedposts .relatedpost .post-info .category,
.reply a,
.rtm-album-privacy label,
.rtm-comment-wrap .rtmedia-comment-author,
.rtm-comment-wrap .rtmedia-comment-date,
.rtm-ltb-action-container,
.rtm-options,
.rtm-user-meta-details,
.rtmedia-gallery-item-actions a,
.rtmedia-success,
.rtmedia-uploader .drag-drop .drag-drop-info,
.rtmedia-warning,
.standard-form .error,
.sticky-post,
.subscription-toggle,
.tagcloud,
.thread-options a.delete,
.thread-options a.read,
.thread-options a.unread,
.user-panel,
.users-who-like,
.widget.widget_comments ul li a .commauth,
.widget.widget_display_replies,
.widget.widget_display_stats,
.widget.widget_display_views,
.widget_polls-widget a,
.wp-caption-text,
.wp-polls a,
body.buddydrive div#buddydrive-main #buddydrive-status div.buddydrive-feedback p.info,
body .rtm-media-options .rtm-media-options-list .rtmedia-action-buttons,
body .rtm-pagination,
body .rtm-tabs li a,
body .rtmedia-actions-before-comments .rtmedia-comment-link,
body .rtmedia-add-media-button,
body .rtmedia-container .rtm-load-more a,
body .rtmedia-success,
body .rtmedia-upload-media-link,
body .rtmedia-warning,
body a.rtmedia-upload-media-link,
body.buddydrive div#buddydrive-main #buddydrive-uploader #bp-upload-ui:not(.drag-drop) #bp-browse-button,
body.buddydrive div#buddydrive-main .button-primary,
body.buddydrive .error,
body.buddydrive div#buddydrive-main form.buddydrive-item-details #buddydrive-object-selection .buddydrive-item,
body.buddydrive div#buddydrive-main ul#buddydrive-browser li .buddydrive-content .buddydrive-title,
body.buddydrive div#buddydrive-main ul#buddydrive-browser li.buddydrive-item .buddydrive-share-content p.description,
body.buddydrive div#buddydrive-main #buddydrive-load-more,
h1,
h2,
h3,
h4,
h5,
h6,
input,
input.ed_button,
label,
select,
table,
.header-panel {
	font-family: '{$monarch_font_secondary}', serif;
}

.site-branding h1.site-title {
	font-family: '{$monarch_font_logo}', serif;
}

.header-panel .site-branding h1 a {
	font-size: {$monarch_font_size_logo}px;
	letter-spacing: {$monarch_font_letter_spacing_logo}px;
	font-weight: {$monarch_font_weight_logo};
}

body #drupalchat * {
	font-family: '{$monarch_font_secondary}', serif!important;
}

body #drupalchat .chatboxcontent .drupalchat_dpic p {
	font-family: '{$monarch_font_primary}', serif!important;
}

CSS;
	return $css;
}

/**
 * Enqueues front-end CSS.
 *
 * @since Monarch 1.2
 *
 * @see wp_add_inline_style()
 */
function monarch_get_style_settings_css() {
	$css = '';
	  // BuddyPress Members
if ( get_theme_mod( 'monarch_responsive_bp_members' ) ) {
	$css .= <<<CSS
		@media only screen and (min-width: 1200px) and (max-width: 1670px) { body.single .widget.widget_bp_core_members_widget, body.category .widget.widget_bp_core_members_widget, body.blog .widget.widget_bp_core_members_widget { display: none; } }
CSS;
	} // BuddyPress Groups
if ( get_theme_mod( 'monarch_responsive_bp_groups' ) ) {
	$css .= <<<CSS
		@media only screen and (min-width: 1200px) and (max-width: 1670px) { body.single .widget.widget_bp_groups_widget, body.category .widget.widget_bp_groups_widget, body.blog .widget.widget_bp_groups_widget { display: none; } }
CSS;
	} // Monarch Posts
if ( get_theme_mod( 'monarch_responsive_monarch_posts' ) ) {
	$css .= <<<CSS
		@media only screen and (min-width: 1200px) and (max-width: 1670px) { body.single .widget.widget_posts, body.category .widget.widget_posts, body.blog .widget.widget_posts { display: none; } }
CSS;
	} // Monarch Comments
if ( get_theme_mod( 'monarch_responsive_monarch_comments' ) ) {
	$css .= <<<CSS
		@media only screen and (min-width: 1200px) and (max-width: 1670px) { body.single .widget.widget_comments, body.category .widget.widget_comments, body.blog .widget.widget_comments { display: none; } }
CSS;
	} // Calendar
if ( get_theme_mod( 'monarch_responsive_calendar' ) ) {
	$css .= <<<CSS
		@media only screen and (min-width: 1200px) and (max-width: 1670px) { body.single .widget.widget_calendar, body.category .widget.widget_calendar, body.blog .widget.widget_calendar { display: none; } }
CSS;
	} // Tag Cloud
if ( get_theme_mod( 'monarch_responsive_tag_cloud' ) ) {
	$css .= <<<CSS
		@media only screen and (min-width: 1200px) and (max-width: 1670px) { body.single .widget.widget_tag_cloud, body.category .widget.widget_tag_cloud, body.blog .widget.widget_tag_cloud { display: none; } }
CSS;
	} // Archives
if ( get_theme_mod( 'monarch_responsive_archives' ) ) {
	$css .= <<<CSS
		@media only screen and (min-width: 1200px) and (max-width: 1670px) { body.single .widget.widget_archive, body.category .widget.widget_archive, body.blog .widget.widget_archive { display: none; } }
CSS;
	} // Hide post meta
if ( get_theme_mod( 'monarch_hide_post_meta' ) ) {
	$css .= <<<CSS
		.post-wrap .post-footer { display: none; } .post-wrap .post-content { margin-bottom: 30px; } .single .post-wrap .post-content { border-bottom: 1px dashed #e4e4e4; }
CSS;
	}

	return $css;
}

/**
 * Returns CSS for the color schemes.
 *
 * @since Monarch 1.0
 *
 * @param array $colors Color scheme colors.
 * @return string Color scheme CSS.
 */
function monarch_get_color_scheme_css( $colors ) {
	$colors = wp_parse_args( $colors, array(
		'background_color'            => '',
		'panels_background_color'     => '',
		'main_hue'                    => '',
		'light_main_hue'              => '',
		'light_panels_bg_color'       => '',
	) );

	$css = <<<CSS

/* COLOR SCHEME */
body .rtm-media-single-comments,
body .mfp-content .rtm-single-meta,
body,
.wrapper {
	background-color: {$colors['background_color']};
}

.toolbar-scrollup .wp-admin,
.toolbar-scrollup .scrollup,
.header-panel .nav-primary .current-menu-item > a::before {
	border-color: {$colors['background_color']};
}

.author-info::after,
.page-header .page-header-content::after,
.post-wrap .hentry.format-audio::after,
.post-wrap .hentry.format-gallery::after,
.post-wrap .hentry.format-standard::after,
.post-wrap .hentry.format-video::after,
.post-wrap .hentry.type-attachment::after,
.post-wrap .page.type-page::after,
.relatedposts .relatedpost::after,
body #item-body .rtm-lightbox-container .rtm-single-media::after,
.widget::after {
	background: -webkit-linear-gradient(135deg, {$colors['background_color']} 45%, #eaeaea 50%, #eaeaea 56%, #eaeaea 80%);
	background: linear-gradient(315deg, {$colors['background_color']} 45%, #eaeaea 50%, #eaeaea 56%, #eaeaea 80%);
}

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
	background-color: {$colors['panels_background_color']};
}

.post-wrap .fost-format-bg {
	border-bottom-color: {$colors['panels_background_color']};
}

@media only screen and (max-width: 1530px) {
	.cover .item-list-tabs {
		background: {$colors['panels_background_color']};
	}
	.cover .item-list-tabs ul li ul.flexMenu-popup {
		background: {$colors['panels_background_color']};
	}
}

body .rtmedia-popup,
.bbpress #wp-link-wrap,
.modal-login .modal-dialog {
	-webkit-box-shadow: 1px 1px rgba(255, 255, 255, 0.1), 2px 2px {$colors['light_panels_bg_color']}, 3px 3px rgba(255, 255, 255, 0.1), 4px 4px {$colors['light_panels_bg_color']};
	box-shadow: 1px 1px rgba(255, 255, 255, 0.1), 2px 2px {$colors['light_panels_bg_color']}, 3px 3px rgba(255, 255, 255, 0.1), 4px 4px {$colors['light_panels_bg_color']};
}

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
	color: {$colors['main_hue']};
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
	background-color: {$colors['main_hue']};
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
	border-color: {$colors['main_hue']};
}

.post-wrap .fost-format-bg {
	border-top-color: {$colors['main_hue']};
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
	border-color: {$colors['light_main_hue']};
}

.icheckbox::before,
.infinite-loader .spinner,
.infinite-loader .spinner::before,
.infinite-loader .spinner::after {
	background: {$colors['light_main_hue']};
}

@-webkit-keyframes infload {
	0%, 80%, 100% {
		-webkit-box-shadow: 0 0 {$colors['light_main_hue']};
		height: 4em;
	} 40% {
		-webkit-box-shadow: 0 -2em {$colors['light_main_hue']};
		height: 5em;
	}
}

@-moz-keyframes infload {
	0%, 80%, 100% {
		-moz-box-shadow: 0 0 {$colors['light_main_hue']};
		height: 4em;
	} 40% {
		-moz-box-shadow: 0 -2em {$colors['light_main_hue']};
		height: 5em;
	}
}

@-ms-keyframes infload {
	0%, 80%, 100% {
		box-shadow: 0 0 {$colors['light_main_hue']};
		height: 4em;
	} 40% {
		box-shadow: 0 -2em {$colors['light_main_hue']};
		height: 5em;
	}
}

@-o-keyframes infload {
	0%, 80%, 100% {
		box-shadow: 0 0 {$colors['light_main_hue']};
		height: 4em;
	} 40% {
		box-shadow: 0 -2em {$colors['light_main_hue']};
		height: 5em;
	}
}

@keyframes infload {
	0%, 80%, 100% {
		box-shadow: 0 0 {$colors['light_main_hue']};
		height: 4em;
	} 40% {
		box-shadow: 0 -2em {$colors['light_main_hue']};
		height: 5em;
	}
}

@media only screen and (min-width: 1200px) and (max-width: 1360px), (max-width: 768px) {
	.user-panel .nav-buddy li.current-menu-item a,
	.user-panel .nav-buddy li.current-menu-item a::before {
		background-color: {$colors['main_hue']};
	}

	.user-panel .nav-buddy li a:focus,
	.user-panel .nav-buddy li a:hover {
		background: {$colors['main_hue']};
	}
}

::-webkit-scrollbar-thumb,
::-webkit-scrollbar-thumb:window-inactive,
::selection {
	background-color: {$colors['main_hue']};
}

CSS;

	return $css;
}