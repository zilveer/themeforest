<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/library/shortcodes/tinymce/lists/window.php
 * @file	 	1.0
 */
?>
<?php

$wp_include = "../wp-load.php";
$i = 0;
while (!file_exists($wp_include) && $i++ < 10) {
  $wp_include = "../$wp_include";
}

// let's load WordPress
require($wp_include);

if ( !is_user_logged_in() || !current_user_can('edit_posts') ) 
	wp_die(__("You are not allowed to be here",'prostore-theme'));
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>List Shortcode Generator</title>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl'); ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
<script language="javascript" type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl'); ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl'); ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/library/shortcodes/tinymce/lists/tinymce.js?1.1"></script>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/icons.css">
<style type="text/css">
legend, label, select, input { font-size:11px; }
fieldset { margin:18px 0; padding:11px; }
select, input[type=text] { float:left; width:100%; }
select optgroup { font:bold 11px Tahoma, Verdana, Arial, Sans-serif; padding: 6px 0 3px 10px;}
select optgroup option { font:normal 11px/18px Tahoma, Verdana, Arial, Sans-serif; padding: 1px 0 1px 20px;}


.of-radio-tile-img {
	width:20px;
	height:20px;
	border:3px solid #f9f9f9;
	margin:0 5px 10px 0;
	display:none;
	cursor:pointer;
	float:left;
	font-size: 20px;
	text-align: center;
}
.of-radio-tile-img em {
	font-size: 20px;
	line-height: 20px;
	width: 20px;
	height: 20px;
	vertical-align: bottom;
}
.of-radio-tile-selected {
	border:3px solid #ccc
}
.of-radio-tile-img:hover {
	opacity:.8;
}
input.checkbox {
	width: 20px;
	margin-top:3px;
}
input.of-radio {
	width: 20px;
}
</style>
</head>
<body id="link" onLoad="tinyMCEPopup.executeOnLoad('init();');">
<form name="mtheme_list" action="#">
	<!-- style_panel -->
	<fieldset>
		<legend>Icon</legend>

		<input name="list_type" type="radio" value="icon-plus
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-plus
"></em></div>
<input name="list_type" type="radio" value="icon-minus
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-minus
"></em></div>
<input name="list_type" type="radio" value="icon-at
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-at
"></em></div>
<input name="list_type" type="radio" value="icon-info
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-info
"></em></div>
<input name="list_type" type="radio" value="icon-left
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-left
"></em></div>
<input name="list_type" type="radio" value="icon-up
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-up
"></em></div>
<input name="list_type" type="radio" value="icon-right
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-right
"></em></div>
<input name="list_type" type="radio" value="icon-down
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-down
"></em></div>
<input name="list_type" type="radio" value="icon-home
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-home
"></em></div>
<input name="list_type" type="radio" value="icon-pause
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-pause
"></em></div>
<input name="list_type" type="radio" value="icon-fast-fw
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-fast-fw
"></em></div>
<input name="list_type" type="radio" value="icon-fast-bw
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-fast-bw
"></em></div>
<input name="list_type" type="radio" value="icon-to-end
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-to-end
"></em></div>
<input name="list_type" type="radio" value="icon-to-start
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-to-start
"></em></div>
<input name="list_type" type="radio" value="icon-stop
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-stop
"></em></div>
<input name="list_type" type="radio" value="icon-play
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-play
"></em></div>
<input name="list_type" type="radio" value="icon-star
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-star
"></em></div>
<input name="list_type" type="radio" value="icon-star-empty
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-star-empty
"></em></div>
<input name="list_type" type="radio" value="icon-check
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-check
"></em></div>
<input name="list_type" type="radio" value="icon-th-list-summary
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-th-list-summary
"></em></div>
<input name="list_type" type="radio" value="icon-th-list
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-th-list
"></em></div>
<input name="list_type" type="radio" value="icon-heart-empty
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-heart-empty
"></em></div>
<input name="list_type" type="radio" value="icon-heart
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-heart
"></em></div>
<input name="list_type" type="radio" value="icon-th-grid
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-th-grid
"></em></div>
<input name="list_type" type="radio" value="icon-th
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-th
"></em></div>
<input name="list_type" type="radio" value="icon-flag
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-flag
"></em></div>
<input name="list_type" type="radio" value="icon-cog
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-cog
"></em></div>
<input name="list_type" type="radio" value="icon-attention
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-attention
"></em></div>
<input name="list_type" type="radio" value="icon-flash
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-flash
"></em></div>
<input name="list_type" type="radio" value="icon-record
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-record
"></em></div>
<input name="list_type" type="radio" value="icon-key
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-key
"></em></div>
<input name="list_type" type="radio" value="icon-mail
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-mail
"></em></div>
<input name="list_type" type="radio" value="icon-edit
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-edit
"></em></div>
<input name="list_type" type="radio" value="icon-pencil
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-pencil
"></em></div>
<input name="list_type" type="radio" value="icon-feather
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-feather
"></em></div>
<input name="list_type" type="radio" value="icon-ok
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-ok
"></em></div>
<input name="list_type" type="radio" value="icon-ok-circle
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-ok-circle
"></em></div>
<input name="list_type" type="radio" value="icon-cancel
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-cancel
"></em></div>
<input name="list_type" type="radio" value="icon-cancel-circle
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-cancel-circle
"></em></div>
<input name="list_type" type="radio" value="icon-help
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-help
"></em></div>
<input name="list_type" type="radio" value="icon-quote-left
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-quote-left
"></em></div>
<input name="list_type" type="radio" value="icon-quote-right
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-quote-right
"></em></div>
<input name="list_type" type="radio" value="icon-quote-right-1
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-quote-right-1
"></em></div>
<input name="list_type" type="radio" value="icon-plus-circle
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-plus-circle
"></em></div>
<input name="list_type" type="radio" value="icon-minus-circle
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-minus-circle
"></em></div>
<input name="list_type" type="radio" value="icon-forward
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-forward
"></em></div>
<input name="list_type" type="radio" value="icon-cw
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-cw
"></em></div>
<input name="list_type" type="radio" value="icon-left-circle
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-left-circle
"></em></div>
<input name="list_type" type="radio" value="icon-right-circle
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-right-circle
"></em></div>
<input name="list_type" type="radio" value="icon-up-circle
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-up-circle
"></em></div>
<input name="list_type" type="radio" value="icon-down-circle
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-down-circle
"></em></div>
<input name="list_type" type="radio" value="icon-user-add
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-user-add
"></em></div>
<input name="list_type" type="radio" value="icon-help-circle
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-help-circle
"></em></div>
<input name="list_type" type="radio" value="icon-info-circle
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-info-circle
"></em></div>
<input name="list_type" type="radio" value="icon-back-alt
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-back-alt
"></em></div>
<input name="list_type" type="radio" value="icon-th-large
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-th-large
"></em></div>
<input name="list_type" type="radio" value="icon-eye
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-eye
"></em></div>
<input name="list_type" type="radio" value="icon-tag
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-tag
"></em></div>
<input name="list_type" type="radio" value="icon-upload-cloud
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-upload-cloud
"></em></div>
<input name="list_type" type="radio" value="icon-reply
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-reply
"></em></div>
<input name="list_type" type="radio" value="icon-reply-all
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-reply-all
"></em></div>
<input name="list_type" type="radio" value="icon-print
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-print
"></em></div>
<input name="list_type" type="radio" value="icon-comment-alt
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-comment-alt
"></em></div>
<input name="list_type" type="radio" value="icon-chat
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-chat
"></em></div>
<input name="list_type" type="radio" value="icon-address
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-address
"></em></div>
<input name="list_type" type="radio" value="icon-location
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-location
"></em></div>
<input name="list_type" type="radio" value="icon-map
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-map
"></em></div>
<input name="list_type" type="radio" value="icon-trash
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-trash
"></em></div>
<input name="list_type" type="radio" value="icon-archive
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-archive
"></em></div>
<input name="list_type" type="radio" value="icon-rss
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-rss
"></em></div>
<input name="list_type" type="radio" value="icon-rss-alt
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-rss-alt
"></em></div>
<input name="list_type" type="radio" value="icon-rss-alt-1
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-rss-alt-1
"></em></div>
<input name="list_type" type="radio" value="icon-share
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-share
"></em></div>
<input name="list_type" type="radio" value="icon-basket
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-basket
"></em></div>
<input name="list_type" type="radio" value="icon-calendar-alt
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-calendar-alt
"></em></div>
<input name="list_type" type="radio" value="icon-logout
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-logout
"></em></div>
<input name="list_type" type="radio" value="icon-resize-full
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-resize-full
"></em></div>
<input name="list_type" type="radio" value="icon-resize-full-2
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-resize-full-2
"></em></div>
<input name="list_type" type="radio" value="icon-resize-small
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-resize-small
"></em></div>
<input name="list_type" type="radio" value="icon-resize-small-1
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-resize-small-1
"></em></div>
<input name="list_type" type="radio" value="icon-popup
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-popup
"></em></div>
<input name="list_type" type="radio" value="icon-zoom-in
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-zoom-in
"></em></div>
<input name="list_type" type="radio" value="icon-zoom-out
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-zoom-out
"></em></div>
<input name="list_type" type="radio" value="icon-down-open
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-down-open
"></em></div>
<input name="list_type" type="radio" value="icon-left-open
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-left-open
"></em></div>
<input name="list_type" type="radio" value="icon-right-open
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-right-open
"></em></div>
<input name="list_type" type="radio" value="icon-up-open
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-up-open
"></em></div>
<input name="list_type" type="radio" value="icon-arrows-cw
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-arrows-cw
"></em></div>
<input name="list_type" type="radio" value="icon-font
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-font
"></em></div>
<input name="list_type" type="radio" value="icon-chart-pie
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-chart-pie
"></em></div>
<input name="list_type" type="radio" value="icon-updown-circle
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-updown-circle
"></em></div>
<input name="list_type" type="radio" value="icon-progress
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-progress
"></em></div>
<input name="list_type" type="radio" value="icon-terminal
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-terminal
"></em></div>
<input name="list_type" type="radio" value="icon-basket-alt
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-basket-alt
"></em></div>
<input name="list_type" type="radio" value="icon-facebook
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-facebook
"></em></div>
<input name="list_type" type="radio" value="icon-facebook-rect
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-facebook-rect
"></em></div>
<input name="list_type" type="radio" value="icon-twitter-bird
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-twitter-bird
"></em></div>
<input name="list_type" type="radio" value="icon-icq
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-icq
"></em></div>
<input name="list_type" type="radio" value="icon-yandex
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-yandex
"></em></div>
<input name="list_type" type="radio" value="icon-yandex-rect
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-yandex-rect
"></em></div>
<input name="list_type" type="radio" value="icon-github-text
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-github-text
"></em></div>
<input name="list_type" type="radio" value="icon-github
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-github
"></em></div>
<input name="list_type" type="radio" value="icon-googleplus-rect
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-googleplus-rect
"></em></div>
<input name="list_type" type="radio" value="icon-vkontakte-rect
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-vkontakte-rect
"></em></div>
<input name="list_type" type="radio" value="icon-skype
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-skype
"></em></div>
<input name="list_type" type="radio" value="icon-odnoklassniki
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-odnoklassniki
"></em></div>
<input name="list_type" type="radio" value="icon-odnoklassniki-rect
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-odnoklassniki-rect
"></em></div>
<input name="list_type" type="radio" value="icon-vimeo-rect
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-vimeo-rect
"></em></div>
<input name="list_type" type="radio" value="icon-vimeo
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-vimeo
"></em></div>
<input name="list_type" type="radio" value="icon-tumblr-rect
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-tumblr-rect
"></em></div>
<input name="list_type" type="radio" value="icon-tumblr
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-tumblr
"></em></div>
<input name="list_type" type="radio" value="icon-friendfeed
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-friendfeed
"></em></div>
<input name="list_type" type="radio" value="icon-friendfeed-rect
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-friendfeed-rect
"></em></div>
<input name="list_type" type="radio" value="icon-blogger
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-blogger
"></em></div>
<input name="list_type" type="radio" value="icon-blogger-rect
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-blogger-rect
"></em></div>
<input name="list_type" type="radio" value="icon-deviantart
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-deviantart
"></em></div>
<input name="list_type" type="radio" value="icon-jabber
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-jabber
"></em></div>
<input name="list_type" type="radio" value="icon-lastfm
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-lastfm
"></em></div>
<input name="list_type" type="radio" value="icon-lastfm-rect
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-lastfm-rect
"></em></div>
<input name="list_type" type="radio" value="icon-linkedin
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-linkedin
"></em></div>
<input name="list_type" type="radio" value="icon-linkedin-rect
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-linkedin-rect
"></em></div>
<input name="list_type" type="radio" value="icon-picasa
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-picasa
"></em></div>
<input name="list_type" type="radio" value="icon-wordpress
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-wordpress
"></em></div>
<input name="list_type" type="radio" value="icon-globe
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-globe
"></em></div>
<input name="list_type" type="radio" value="icon-picture
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-picture
"></em></div>
<input name="list_type" type="radio" value="icon-video-play
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-video-play
"></em></div>
<input name="list_type" type="radio" value="icon-video
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-video
"></em></div>
<input name="list_type" type="radio" value="icon-award
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-award
"></em></div>
<input name="list_type" type="radio" value="icon-user
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-user
"></em></div>
<input name="list_type" type="radio" value="icon-users
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-users
"></em></div>
<input name="list_type" type="radio" value="icon-money
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-money
"></em></div>
<input name="list_type" type="radio" value="icon-dollar
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-dollar
"></em></div>
<input name="list_type" type="radio" value="icon-folder
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-folder
"></em></div>
<input name="list_type" type="radio" value="icon-calendar
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-calendar
"></em></div>
<input name="list_type" type="radio" value="icon-chart
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-chart
"></em></div>
<input name="list_type" type="radio" value="icon-chart-bar
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-chart-bar
"></em></div>
<input name="list_type" type="radio" value="icon-book
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-book
"></em></div>
<input name="list_type" type="radio" value="icon-phone
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-phone
"></em></div>
<input name="list_type" type="radio" value="icon-download
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-download
"></em></div>
<input name="list_type" type="radio" value="icon-mobile
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-mobile
"></em></div>
<input name="list_type" type="radio" value="icon-camera
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-camera
"></em></div>
<input name="list_type" type="radio" value="icon-shuffle
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-shuffle
"></em></div>
<input name="list_type" type="radio" value="icon-volume-off
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-volume-off
"></em></div>
<input name="list_type" type="radio" value="icon-volume-down
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-volume-down
"></em></div>
<input name="list_type" type="radio" value="icon-volume-up
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-volume-up
"></em></div>
<input name="list_type" type="radio" value="icon-search-1
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-search-1
"></em></div>
<input name="list_type" type="radio" value="icon-search
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-search
"></em></div>
<input name="list_type" type="radio" value="icon-lock
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-lock
"></em></div>
<input name="list_type" type="radio" value="icon-lock-open
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-lock-open
"></em></div>
<input name="list_type" type="radio" value="icon-bookmark
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-bookmark
"></em></div>
<input name="list_type" type="radio" value="icon-link
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-link
"></em></div>
<input name="list_type" type="radio" value="icon-wrench-1
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-wrench-1
"></em></div>
<input name="list_type" type="radio" value="icon-wrench
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-wrench
"></em></div>
<input name="list_type" type="radio" value="icon-clock-alt
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-clock-alt
"></em></div>
<input name="list_type" type="radio" value="icon-clock
" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-clock
"></em></div>
<input name="list_type" type="radio" value="icon-block" class="checkbox of-radio-tile-radio" />
<div class="of-radio-tile-img"><em class="icon-block"></em></div>

	</fieldset>
	<input type="button" id="cancel" name="cancel" value="Cancel" onClick="tinyMCEPopup.close();"  style="float:left; padding:10px; width:auto; height:auto;"/>
	<input type="submit" id="insert" name="insert" value="Generate shortcode" onClick="insertShortcode();" style="float:right; padding:10px; width:auto; height:auto;"/>
</form>
<script type="text/javascript">

jQuery(document).ready(function($){
	//Masked Inputs (images as radio buttons)
	$('.of-radio-img-img').click(function(){
		$(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
		$(this).addClass('of-radio-img-selected');
	});
	$('.of-radio-img-label').hide();
	$('.of-radio-img-img').show();
	$('.of-radio-img-radio').hide();
	
	//Masked Inputs (background images as radio buttons)
	$('.of-radio-tile-img').click(function(){
		$(this).parent().parent().find('.of-radio-tile-img').removeClass('of-radio-tile-selected');
		$(this).addClass('of-radio-tile-selected');
	});
	$('.of-radio-tile-label').hide();
	$('.of-radio-tile-img').show();
	$('.of-radio-tile-radio').hide();
	$('.of-radio-tile-img').live("click", function(){
  		$(this).prev().attr("checked", "checked");
	});
}); //end doc ready
</script>
</body>
</html>
