<?php

/*------------------------------------------------------------
 * Customized Style
 * Get settings from WP Customizer, compile <style>
 * Print in head of the document
 * Fallback when WP-LESS missing
 *------------------------------------------------------------*/

if ( !class_exists('WPLessPlugin') ){
	add_action( 'wp_head', 'sleek_customized_style' );
}

function sleek_customized_style() {
$theme_settings = sleek_theme_settings();
?>

<style type="text/css">

/* Backgrounds
 *------------------------------------------------------------*/

html, body { background: <?php echo $theme_settings->style['color']['color_white'] ?>; }

.header .nano-content {
	background: <?php echo sleek_split_bg_setting($theme_settings->style['bg']['bg_header'],'bg'); ?>;
	-webkit-background-size: <?php echo sleek_split_bg_setting($theme_settings->style['bg']['bg_header'],'bg_size'); ?>;
	background-size: <?php echo sleek_split_bg_setting($theme_settings->style['bg']['bg_header'],'bg_size'); ?>;
}

.main-content .nano-content {
	background: <?php echo sleek_split_bg_setting($theme_settings->style['bg']['bg_content'],'bg'); ?>;
	-webkit-background-size: <?php echo sleek_split_bg_setting($theme_settings->style['bg']['bg_content'],'bg_size'); ?>;
	background-size: <?php echo sleek_split_bg_setting($theme_settings->style['bg']['bg_content'],'bg_size'); ?>;
}

.sidebar {
	background: <?php echo sleek_split_bg_setting($theme_settings->style['bg']['bg_sidebar'],'bg'); ?>;
	-webkit-background-size: <?php echo sleek_split_bg_setting($theme_settings->style['bg']['bg_sidebar'],'bg_size'); ?>;
	background-size: <?php echo sleek_split_bg_setting($theme_settings->style['bg']['bg_sidebar'],'bg_size'); ?>;
}

.sleek-blog--style-masonry,
.sleek-blog--style-newspaper {
	background: <?php echo sleek_split_bg_setting($theme_settings->style['bg']['bg_masonry'],'bg'); ?>;
	-webkit-background-size: <?php echo sleek_split_bg_setting($theme_settings->style['bg']['bg_masonry'],'bg_size'); ?>;
	background-size: <?php echo sleek_split_bg_setting($theme_settings->style['bg']['bg_masonry'],'bg_size'); ?>;
}


.js & > ul > .menu-item-has-children.active > ul,
.js & > ul > .menu-item-language.active > ul,
.no-js & > ul > .menu-item-has-children:hover > ul,
.no-js & > ul > .menu-item-language:hover > ul,
.js-ajax-load-pages--false & .current-menu-ancestor > ul,
.header:before { background: <?php echo sleek_split_bg_setting($theme_settings->style['bg']['bg_sidebar'],'bg'); ?>; }



/* Layout and widths
 *------------------------------------------------------------*/

@media only screen and (min-width: 1200px) {
	.header { width: <?php echo $theme_settings->layout['header_width'] ?>px; }
	.init-load-animation--true.ajax-content-wrapper-loading-start .sleek-loader--body,
	.init-load-animation--true.ajax-content-wrapper-loading-end .sleek-loader--body,
	.init-load-animation--true.ajax-main-content-loading-start .sleek-loader--body {
		left: <?php echo $theme_settings->layout['header_width'] ?>px;
	}
}

@media only screen and (min-width: 768px) {
	.sidebar--true .sidebar { width: <?php echo $theme_settings->layout['sidebar_width'] ?>px; }
	.sidebar--true .main-content { margin-right: -<?php echo $theme_settings->layout['sidebar_width'] ?>px;}
	.sidebar--true .main-content__inside { margin-right: <?php echo $theme_settings->layout['sidebar_width'] ?>px;}
}

@media only screen and (min-width: 1400px) {
	.sidebar--true .sidebar { width: <?php echo $theme_settings->layout['sidebar_width_big'] ?>px; }
	.sidebar--true .main-content { margin-right: -<?php echo $theme_settings->layout['sidebar_width_big'] ?>px;}
	.sidebar--true .main-content__inside { margin-right: <?php echo $theme_settings->layout['sidebar_width_big'] ?>px;}
}



/* Typography
 *------------------------------------------------------------*/

body {
	font-family: <?php echo $theme_settings->typo['body'][0]; ?>;
	font-weight: <?php echo sleek_split_font_style($theme_settings->typo['body'][1],'weight'); ?>;
	font-style: <?php echo sleek_split_font_style($theme_settings->typo['body'][1],'style'); ?>;
	font-size: <?php echo $theme_settings->typo['body'][2]; ?>px;
	line-height: <?php echo $theme_settings->typo['body'][3]; ?>;
	color: <?php echo $theme_settings->style['color']['color_grey']; ?>;
}

b, strong { color: <?php echo $theme_settings->style['color']['color_black']; ?>; }
a { color: <?php echo $theme_settings->style['color']['color_primary']; ?>; }
a:hover { color: <?php echo $theme_settings->style['color']['color_black']; ?>; }

h1,h2,h3,h4,h5,h6 { color: <?php echo $theme_settings->style['color']['color_black']; ?>; }
h1 a,h2 a,h3 a,h4 a,h5 a,h6 a { color: <?php echo $theme_settings->style['color']['color_black']; ?>; }
h1 a:hover,h2 a:hover,h3 a:hover,h4 a:hover,h5 a:hover,h6 a:hover { color: <?php echo $theme_settings->style['color']['color_primary']; ?>; }

h1 {
	font-family: <?php echo $theme_settings->typo['h1'][0]; ?>;
	font-weight: <?php echo sleek_split_font_style($theme_settings->typo['h1'][1],'weight'); ?>;
	font-style: <?php echo sleek_split_font_style($theme_settings->typo['h1'][1],'style'); ?>;
	line-height: <?php echo $theme_settings->typo['h1'][3]; ?>;
}
.main-content--m-plus h1 { font-size: <?php echo $theme_settings->typo['h1'][2]; ?>px; }

h2,
.loop-container--style-list .format-standard h2,
.loop-container--style-list .format-video h2,
.loop-container--style-list .format-audio h2,
.loop-container--style-list .type-page h2,
.loop-container--style-list .format-image h2,
.loop-container--style-list .format-link h2,
.loop-container--style-list .format-aside h2,
.loop-container--style-slider h2 {
	font-family: <?php echo $theme_settings->typo['h2'][0]; ?>;
	font-weight: <?php echo sleek_split_font_style($theme_settings->typo['h2'][1],'weight'); ?>;
	font-style: <?php echo sleek_split_font_style($theme_settings->typo['h2'][1],'style'); ?>;
	line-height: <?php echo $theme_settings->typo['h2'][3]; ?>;
}
@media only screen and (min-width: 1200px) {
	h2, .loop-container--style-list .format-standard h2, .loop-container--style-list .format-video h2, .loop-container--style-list .format-audio h2, .loop-container--style-list .type-page h2, .loop-container--style-list .format-image h2, .loop-container--style-list .format-link h2, .loop-container--style-list .format-aside h2, .loop-container--style-slider h2  { font-size: <?php echo $theme_settings->typo['h2'][2]; ?>px; }
}

h1 .above, h2 .above {
	color: <?php echo $theme_settings->style['color']['color_grey_light']; ?>;
}

.dark-mode h1 .above, .dark-mode h2 .above {
	color: <?php echo $theme_settings->style['color']['color_grey_sidebar']; ?>;
}

h3 {
	font-family: <?php echo $theme_settings->typo['h3'][0]; ?>;
	font-weight: <?php echo sleek_split_font_style($theme_settings->typo['h3'][1],'weight'); ?>;
	font-style: <?php echo sleek_split_font_style($theme_settings->typo['h3'][1],'style'); ?>;
	font-size: <?php echo $theme_settings->typo['h3'][2]; ?>px;
	line-height: <?php echo $theme_settings->typo['h3'][3]; ?>;
}
h4 {
	font-family: <?php echo $theme_settings->typo['h4'][0]; ?>;
	font-weight: <?php echo sleek_split_font_style($theme_settings->typo['h4'][1],'weight'); ?>;
	font-style: <?php echo sleek_split_font_style($theme_settings->typo['h4'][1],'style'); ?>;
	font-size: <?php echo $theme_settings->typo['h4'][2]; ?>px;
	line-height: <?php echo $theme_settings->typo['h4'][3]; ?>;
}
h5 {
	font-family: <?php echo $theme_settings->typo['h5'][0]; ?>;
	font-weight: <?php echo sleek_split_font_style($theme_settings->typo['h5'][1],'weight'); ?>;
	font-style: <?php echo sleek_split_font_style($theme_settings->typo['h5'][1],'style'); ?>;
	font-size: <?php echo $theme_settings->typo['h5'][2]; ?>px;
	line-height: <?php echo $theme_settings->typo['h5'][3]; ?>;
}
h6 {
	font-family: <?php echo $theme_settings->typo['h6'][0]; ?>;
	font-weight: <?php echo sleek_split_font_style($theme_settings->typo['h6'][1],'weight'); ?>;
	font-style: <?php echo sleek_split_font_style($theme_settings->typo['h6'][1],'style'); ?>;
	font-size: <?php echo $theme_settings->typo['h6'][2]; ?>px;
	line-height: <?php echo $theme_settings->typo['h6'][3]; ?>;
}

.custom-heading {
	font-family: <?php echo $theme_settings->typo['custom_heading'][0]; ?>;
	font-weight: <?php echo sleek_split_font_style($theme_settings->typo['custom_heading'][1],'weight'); ?>;
	font-style: <?php echo sleek_split_font_style($theme_settings->typo['custom_heading'][1],'style'); ?>;
	font-size: <?php echo $theme_settings->typo['custom_heading'][2]; ?>px;
	line-height: <?php echo $theme_settings->typo['custom_heading'][3]; ?>;
	color: <?php echo $theme_settings->style['color']['color_black']; ?>
}

h1 .above,
h2 .above,
.button,
.sleek-carousel .sleek-ui--arrows .sleek-ui__arrow,
.comment__list .comment_links a,
.comment .comment-respond h3,
.pagination--continue,
.format-head--quote .author,
.format-head--status .author,
.gallery--lightbox .gallery-icon:after,
.header__nav a,
.sleek-lightbox__info,
.loop-container--style-list .post__meta,
.pagination--classic .page-numbers,
.pagination-message,
.sidebar .sidebar__tabs a,
.article-single .post__navigation,
.article-single--post .post__head .post__meta,
.sleek-slider .sleek-ui--slider-arrows .sleek-ui__slider-info,
.social-nav__title,
.read-more--continue,
ol li:before,
.dropcap,
blockquote cite,
.widget__title {
	font-family: <?php echo $theme_settings->typo['navigation'][0]; ?>;
	font-weight: <?php echo sleek_split_font_style($theme_settings->typo['navigation'][1],'weight'); ?>;
	font-style: <?php echo sleek_split_font_style($theme_settings->typo['navigation'][1],'style'); ?>;
}

.wp-caption-text, .gallery-caption { color: <?php echo $theme_settings->style['color']['color_black']; ?>; }

.dropcap { color: <?php echo $theme_settings->style['color']['color_black']; ?>; }
.dropcap.hexagon { color: <?php echo $theme_settings->style['color']['color_primary']; ?>; }
blockquote { border-left: 3px solid <?php echo $theme_settings->style['color']['color_primary']; ?>; }
blockquote cite { color: <?php echo $theme_settings->style['color']['color_black']; ?>; }
blockquote.blockquote--custom .blockquote__icon i:before { color: <?php echo $theme_settings->style['color']['color_primary']; ?>; }
blockquote.blockquote--custom:before, blockquote.blockquote--custom:after { border-right:1px solid <?php echo $theme_settings->style['color']['color_grey']; ?>; }
.highlighted-p { color: <?php echo $theme_settings->style['color']['color_black']; ?>; }
.dark-mode .highlighted-p { color: <?php echo $theme_settings->style['color']['color_white']; ?>; }
.highlighted-text, code, pre {	color: <?php echo $theme_settings->style['color']['color_black']; ?>; }

.dark-mode { color: <?php echo $theme_settings->style['color']['color_grey_sidebar']; ?>; }
.dark-mode b, .dark-mode strong { color: <?php echo $theme_settings->style['color']['color_white']; ?>; }
.dark-mode a:hover { color: <?php echo $theme_settings->style['color']['color_white']; ?>; }
.dark-mode h1,.dark-mode h2,.dark-mode h3,.dark-mode h4,.dark-mode h5,.dark-mode h6 { color: <?php echo $theme_settings->style['color']['color_white']; ?>; }
.dark-mode h1 a,.dark-mode h2 a,.dark-mode h3 a,.dark-mode h4 a,.dark-mode h5 a,.dark-mode h6 a { color: <?php echo $theme_settings->style['color']['color_white']; ?>; }
.dark-mode h1 a:hover,.dark-mode h2 a:hover,.dark-mode h3 a:hover,.dark-mode h4 a:hover,.dark-mode h5 a:hover,.dark-mode h6 a:hover { color: <?php echo $theme_settings->style['color']['color_primary']; ?>; }



/* Buttons */
.button--solid { background: <?php echo $theme_settings->style['color']['color_black']; ?>; color: <?php echo $theme_settings->style['color']['color_white']; ?>; }
.button--solid:hover { background: <?php echo $theme_settings->style['color']['color_primary']; ?>; color: <?php echo $theme_settings->style['color']['color_white']; ?>; }

.button--solid--light,
.dark-mode .button--solid { background: <?php echo $theme_settings->style['color']['color_white']; ?>; color: <?php echo $theme_settings->style['color']['color_black']; ?>; }
.button--solid--light:hover,
.dark-mode .button--solid:hover { background: <?php echo $theme_settings->style['color']['color_primary']; ?>; color: <?php echo $theme_settings->style['color']['color_white']; ?>; }

.button--solid--color { background: <?php echo $theme_settings->style['color']['color_primary']; ?>; color: <?php echo $theme_settings->style['color']['color_white']; ?>; }
.button--solid--color:hover { background: <?php echo $theme_settings->style['color']['color_black']; ?>; color: <?php echo $theme_settings->style['color']['color_white']; ?>; }

.button--solid--color--light,
.dark-mode .button--solid--color { background: <?php echo $theme_settings->style['color']['color_primary']; ?>; color: <?php echo $theme_settings->style['color']['color_white']; ?>; }
.button--solid--color--light:hover,
.dark-mode .button--solid--color:hover { background: <?php echo $theme_settings->style['color']['color_white']; ?>; color: <?php echo $theme_settings->style['color']['color_black']; ?>; }

.button--outline { border: 2px solid <?php echo $theme_settings->style['color']['color_black']; ?>; color: <?php echo $theme_settings->style['color']['color_black']; ?>; }
.button--outline:hover { background: <?php echo $theme_settings->style['color']['color_black']; ?>; color: <?php echo $theme_settings->style['color']['color_white']; ?>; }

.button--outline--light,
.dark-mode .button--outline { border: 2px solid <?php echo $theme_settings->style['color']['color_white']; ?>; color: <?php echo $theme_settings->style['color']['color_white']; ?>; }
.button--outline--light:hover,
.dark-mode .button--outline:hover { background: <?php echo $theme_settings->style['color']['color_white']; ?>; color: <?php echo $theme_settings->style['color']['color_black']; ?>; }

button--outline--color { border: 2px solid <?php echo $theme_settings->style['color']['color_primary']; ?>; color: <?php echo $theme_settings->style['color']['color_primary']; ?>; }
button--outline--color:hover { background: <?php echo $theme_settings->style['color']['color_primary']; ?>; color: <?php echo $theme_settings->style['color']['color_white']; ?>; }

.button--outline--color--light,
.dark-mode .button--outline--color { border: 2px solid <?php echo $theme_settings->style['color']['color_primary']; ?>; color: <?php echo $theme_settings->style['color']['color_primary']; ?>; }
.button--outline--color--light:hover,
.dark-mode .button--outline--color:hover { background: <?php echo $theme_settings->style['color']['color_primary']; ?>; color: <?php echo $theme_settings->style['color']['color_white']; ?>; }



/* Forms */
input.error,
input.wpcf7-not-valid,
select.error,
select.wpcf7-not-valid,
textarea.error,
textarea.wpcf7-not-valid { border-color: #ff0000 !important; }

input[type="submit"], button[type="submit"], input[type="button"], button[type="button"] {
	background: <?php echo $theme_settings->style['color']['color_primary']; ?>; color: <?php echo $theme_settings->style['color']['color_white']; ?>
}



/* Mejs */
.mejs-container .mejs-controls .mejs-button.mejs-playpause-button.mejs-pause { background: <?php echo $theme_settings->style['color']['color_primary']; ?>; }



/* WPML */
.theme-sleek #lang_sel a.lang_sel_sel,
.theme-sleek #lang_sel_click a.lang_sel_sel { color: <?php echo $theme_settings->style['color']['color_black']; ?>; }

theme-sleek #lang_sel ul ul a,
.theme-sleek #lang_sel_click ul ul a,
.theme-sleek #lang_sel_list.lang_sel_list_vertical a,
.theme-sleek #lang_sel_list.lang_sel_list_horizontal a,
.theme-sleek .dark-mode #lang_sel ul ul a:hover,
.theme-sleek .dark-mode #lang_sel_click ul ul a.lang_sel_sel,
.theme-sleek .dark-mode #lang_sel ul ul a:hover,
.theme-sleek .dark-mode #lang_sel_click ul ul a.lang_sel_sel,
.theme-sleek .dark-mode #lang_sel_list.lang_sel_list_vertical a:hover,
.theme-sleek .dark-mode #lang_sel_list.lang_sel_list_horizontal a:hover,
.theme-sleek .dark-mode #lang_sel_list.lang_sel_list_vertical a.lang_sel_sel,
.theme-sleek .dark-mode #lang_sel_list.lang_sel_list_horizontal a.lang_sel_sel { background: <?php echo $theme_settings->style['color']['color_white']; ?>; color: <?php echo $theme_settings->style['color']['color_black']; ?>; }

.theme-sleek #lang_sel ul ul a:hover,
.theme-sleek #lang_sel_click ul ul a:hover,
.theme-sleek #lang_sel_list.lang_sel_list_vertical a:hover,
.theme-sleek #lang_sel_list.lang_sel_list_horizontal a:hover,
.theme-sleek #lang_sel_list.lang_sel_list_vertical a.lang_sel_sel,
.theme-sleek #lang_sel_list.lang_sel_list_horizontal a.lang_sel_sel,
.theme-sleek .dark-mode #lang_sel a.lang_sel_sel,
.theme-sleek .dark-mode #lang_sel_click a.lang_sel_sel,
.theme-sleek .dark-mode #lang_sel ul ul a,
.theme-sleek .dark-mode #lang_sel_click ul ul a { background: <?php echo $theme_settings->style['color']['color_black']; ?>; color: <?php echo $theme_settings->style['color']['color_white']; ?>; }



/* Sidebar */
.sidebar .sidebar__tabs a { color: <?php echo $theme_settings->style['color']['color_grey']; ?>; }
.sidebar .sidebar__tabs a:hover, .sidebar .sidebar__tabs a.active { color: <?php echo $theme_settings->style['color']['color_black']; ?>; }

.dark-mode .sidebar .sidebar__tabs a { color: <?php echo $theme_settings->style['color']['color_grey_sidebar']; ?>; }
.dark-mode .sidebar .sidebar__tabs a:hover, .dark-mode .sidebar .sidebar__tabs a.active { color: <?php echo $theme_settings->style['color']['color_white']; ?>; }



/* Tooltip */
.tooltip:after { background: <?php echo $theme_settings->style['color']['color_black']; ?>; color: <?php echo $theme_settings->style['color']['color_white']; ?>; }
.dark-mode .tooltip:after { background: <?php echo $theme_settings->style['color']['color_white']; ?>; color: <?php echo $theme_settings->style['color']['color_black']; ?>; }
.tooltip--right:before { border-right-color: <?php echo $theme_settings->style['color']['color_black']; ?>; }
.dark-mode .tooltip--right:before { border-right-color: <?php echo $theme_settings->style['color']['color_white']; ?>; }
.tooltip--left:before { border-left-color: <?php echo $theme_settings->style['color']['color_black']; ?>; }
.dark-mode .tooltip--left:before { border-left-color: <?php echo $theme_settings->style['color']['color_white']; ?>; }
.tooltip--top:before { border-top-color: <?php echo $theme_settings->style['color']['color_black']; ?>; }
.dark-mode .tooltip--top:before { border-top-color: <?php echo $theme_settings->style['color']['color_white']; ?>; }
.tooltip--bottom:before { border-bottom-color: <?php echo $theme_settings->style['color']['color_black']; ?>; }
.dark-mode .tooltip--bottom:before { border-bottom-color: <?php echo $theme_settings->style['color']['color_white']; ?>; }



/* Social Nav */
.social-nav__title { color: <?php echo $theme_settings->style['color']['color_grey_light']; ?>; }
.social-nav .social-nav__link:hover { background: <?php echo $theme_settings->style['color']['color_primary']; ?>; color: <?php echo $theme_settings->style['color']['color_white']; ?>; }
.social-nav--big .social-nav__link { color: <?php echo $theme_settings->style['color']['color_black']; ?>; }
.social-nav--big .social-nav__link:hover { color: <?php echo $theme_settings->style['color']['color_primary']; ?>; background: none; }
.dark-mode .social-nav--big .social-nav__link { color: <?php echo $theme_settings->style['color']['color_white']; ?>; }
.dark-mode .social-nav--big .social-nav__link:hover { color: <?php echo $theme_settings->style['color']['color_primary']; ?>; background: none; }



/* CTA */
.sleek-cta .button { background: <?php echo $theme_settings->style['color']['color_primary']; ?>; color: <?php echo $theme_settings->style['color']['color_white']; ?>; }
.sleek-cta .button:hover { background: <?php echo $theme_settings->style['color']['color_black']; ?>; color: <?php echo $theme_settings->style['color']['color_white']; ?>; }
.dark-mode.sleek-cta .button { background: <?php echo $theme_settings->style['color']['color_primary']; ?>; color: <?php echo $theme_settings->style['color']['color_white']; ?>; }
.dark-mode.sleek-cta .button:hover { background: <?php echo $theme_settings->style['color']['color_white']; ?>; color: <?php echo $theme_settings->style['color']['color_black']; ?>; }



/* Progress Bar */
.progress-bar .bar { background: php; }
.progress-bar .bar div { background: <?php echo $theme_settings->style['color']['color_grey_light']; ?>; }
.progress-bar.color-black .bar div { background: <?php echo $theme_settings->style['color']['color_black']; ?>; }
.progress-bar.color-primary .bar div { background: <?php echo $theme_settings->style['color']['color_primary']; ?>; }
.progress-bar.color-white .bar div { background: <?php echo $theme_settings->style['color']['color_white']; ?>; }



/* Header */
.header__toggle div, .header__toggle div:before, .header__toggle div:after { background: <?php echo $theme_settings->style['color']['color_primary']; ?>; }
body.touchscreen-header-open .header__toggle div:before, body.touchscreen-header-open .header__toggle div:after { background: <?php echo $theme_settings->style['color']['color_white']; ?>; }
.header__nav a { color: <?php echo $theme_settings->style['color']['color_grey']; ?>; }
.header__nav a:hover { color: <?php echo $theme_settings->style['color']['color_primary']; ?>; }

.js .header__nav .menu-item-has-children.active a,
.js .header__nav .menu-item-language.active a,
.no-js .header__nav .menu-item-language:hover a,
.no-js .header__nav .menu-item-has-children:hover a,
.js-ajax-load-pages--false .header__nav .current-menu-ancestor a { color: <?php echo $theme_settings->style['color']['color_black']; ?>; }

.js .header__nav .menu-item-has-children.active a:hover,
.js .header__nav .menu-item-language.active a:hover,
.no-js .header__nav .menu-item-language:hover a:hover,
.no-js .header__nav .menu-item-has-children:hover a:hover,
.js-ajax-load-pages--false .header__nav .current-menu-ancestor a:hover { color: <?php echo $theme_settings->style['color']['color_primary']; ?>; }

.js .header__nav > ul > .menu-item-has-children.active > ul a,
.js .header__nav > ul > .menu-item-language.active > ul a,
.no-js .header__nav > ul > .menu-item-has-children:hover > ul a,
.no-js .header__nav > ul > .menu-item-language:hover > ul a,
.js-ajax-load-pages--false .header__nav .current-menu-ancestor > ul a {
	color: <?php echo $theme_settings->style['color']['color_white']; ?>
}

.js .header__nav > ul > .menu-item-has-children.active > ul a:hover,
.js .header__nav > ul > .menu-item-language.active > ul a:hover,
.no-js .header__nav > ul > .menu-item-has-children:hover > ul a:hover,
.no-js .header__nav > ul > .menu-item-language:hover > ul a:hover,
.js-ajax-load-pages--false .header__nav .current-menu-ancestor > ul a:hover {
	color: <?php echo $theme_settings->style['color']['color_primary']; ?>;
}

.js-ajax-load-pages--false .header__nav .current-menu-item > a { color: <?php echo $theme_settings->style['color']['color_primary']; ?>; !important; }
.copyright i { color: <?php echo $theme_settings->style['color']['color_primary']; ?>; }



/* Comments */
.comment__list .comment__links a { color: <?php echo $theme_settings->style['color']['color_black']; ?>; }
.comment__list .comment__links a:hover { color: <?php echo $theme_settings->style['color']['color_primary']; ?>; }
.comment__list .comment__links a.comment-reply-link { color: <?php echo $theme_settings->style['color']['color_primary']; ?>; }
.comment__list .comment__links a.comment-reply-link:hover { color: <?php echo $theme_settings->style['color']['color_black']; ?>; }
.comment__list .comments > comment { background: php; }
.comment__list .comment__pager a { background: <?php echo $theme_settings->style['color']['color_primary']; ?>; color: <?php echo $theme_settings->style['color']['color_white']; ?>; }
.dark-mode .comment__list .comment__content a,
.dark-mode .comment__list .comment__links a,
.dark-mode .comment__list .comment__links a.comment-reply-link:hover { color: <?php echo $theme_settings->style['color']['color_white']; ?>; }
.dark-mode .comment__list .comment__content a:hover,
.dark-mode .comment__list .comment__links a:hover,
.dark-mode .comment__list .comment__links a.comment-reply-link,
.comment__list .comment__content a:hover { color: <?php echo $theme_settings->style['color']['color_primary']; ?>; }
.dark-mode .comment__list .comments .comment p { color: <?php echo $theme_settings->style['color']['color_grey_light']; ?>; }

.comment-respond h3 {
	font-family: <?php echo $theme_settings->typo['h2'][0]; ?>;
	font-weight: <?php echo sleek_split_font_style($theme_settings->typo['h2'][1],'weight'); ?>;
	font-style: <?php echo sleek_split_font_style($theme_settings->typo['h2'][1],'style'); ?>;
	line-height: <?php echo $theme_settings->typo['h2'][3]; ?>;
}
@media only screen and (min-width: 1200px) {
	.comment-respond h3 { font-size: <?php echo $theme_settings->typo['h2'][2]; ?>px; }
}
.dark-mode .comment-respond h3,
.dark-mode .comment-respond h3 a,
.dark-mode .comment-respond .logged-in-as a { color: <?php echo $theme_settings->style['color']['color_white']; ?>; }
.comment-respond .logged-in-as a { color: <?php echo $theme_settings->style['color']['color_black']; ?>; }
.dark-mode .comment-respond h3 a:hover,
.comment-respond .logged-in-as a:hover,
.dark-mode .comment-respond .logged-in-as a:hover { color: <?php echo $theme_settings->style['color']['color_primary']; ?>; }



/* Slider */
.sleek-slider .sleek-ui--slider-pager a.active,
.sleek-slider .sleek-ui__loader { background: <?php echo $theme_settings->style['color']['color_primary']; ?>; }
.sleek-slider .sleek-ui--slider-arrows .sleek-ui__slider-info,
.sleek-slider .sleek-ui--slider-arrows .sleek-ui__arrow { color: <?php echo $theme_settings->style['color']['color_white']; ?>; }



/* Carousel */
.sleek-carousel .sleek-ui--arrows .sleek-ui__arrow { color: <?php echo $theme_settings->style['color']['color_grey_light']; ?>; }
.sleek-carousel .sleek-ui--arrows .sleek-ui__arrow:hover { color: <?php echo $theme_settings->style['color']['color_black']; ?>; }



/* Post Badge */
.post__badge--colored { background: <?php echo $theme_settings->style['color']['color_primary']; ?>; }



/* Format Heads */
.image-dark .format-head--overlay h1,
.image-dark .format-head--overlay h2,
.image-dark .format-head--overlay a,
.image-dark .format-head--overlay .post__text { color: <?php echo $theme_settings->style['color']['color_white']; ?>; }
.image-dark .format-head--overlay a:hover,
.image-light .format-head--overlay a:hover { color: <?php echo $theme_settings->style['color']['color_primary']; ?>; }
.image-light .format-head--overlay .post__text { color: <?php echo $theme_settings->style['color']['color_black']; ?>; }
.image-dark .format-head--overlay .post__text { color: <?php echo $theme_settings->style['color']['color_white']; ?>; }

.format-head--aside .format-head__inwrap { color: <?php echo $theme_settings->style['color']['color_black']; ?>; background: <?php echo $theme_settings->style['color']['color_grey_pale']; ?>; }
.format-head--aside .format-head__inwrap:before { background: <?php echo $theme_settings->style['color']['color_grey_pale']; ?> ; }
.format-head--aside .format-head__inwrap:after { border-color: <?php echo $theme_settings->style['color']['color_grey_pale']; ?> transparent transparent transparent; }



/* Gallery */
.gallery--lightbox .gallery-icon:after { background: <?php echo $theme_settings->style['color']['color_primary']; ?>; color: <?php echo $theme_settings->style['color']['color_white']; ?>; }



/* Single */
.article-single .post__navigation a { color: <?php echo $theme_settings->style['color']['color_grey_light']; ?>; }
.article-single .post__navigation a:hover { color: <?php echo $theme_settings->style['color']['color_black']; ?>; }
.article-single--post .post__head .post__meta .meta--item { color: <?php echo $theme_settings->style['color']['color_grey_light']; ?>; }
.article-single--post .post__head .post__meta a:hover { color: <?php echo $theme_settings->style['color']['color_primary']; ?>; }
.article-single--post .post__tags a { color: <?php echo $theme_settings->style['color']['color_black']; ?>; }
.dark-mode .article-single--post .post__tags a { color: <?php echo $theme_settings->style['color']['color_white']; ?>; }
.article-single--post .post__tags a:hover { color: <?php echo $theme_settings->style['color']['color_white']; ?>; background: <?php echo $theme_settings->style['color']['color_primary']; ?>; border-color: <?php echo $theme_settings->style['color']['color_primary']; ?>; }
.dark-mode .article-single--post .post__tags a:hover { color: <?php echo $theme_settings->style['color']['color_primary']; ?>; background: <?php echo $theme_settings->style['color']['color_white']; ?>; border-color: <?php echo $theme_settings->style['color']['color_white']; ?>; }



/* Loop */
.loop-container .post__meta .meta--item { color: <?php echo $theme_settings->style['color']['color_grey_light']; ?>; }
.loop-container .post__meta .meta--item a { color: <?php echo $theme_settings->style['color']['color_black']; ?>; }
.loop-container .post__meta .meta--item a:hover { color: <?php echo $theme_settings->style['color']['color_primary']; ?>; }
.loop-container--style-list .format-image h2 a,
.loop-container--style-list .format-link h2 a,
.loop-container--style-list .format-aside h2 a { color: <?php echo $theme_settings->style['color']['color_white']; ?>; }
.loop-container--style-list .format-image h2 a:hover,
.loop-container--style-list .format-link h2 a:hover,
.loop-container--style-list .format-aside h2 a:hover { color: <?php echo $theme_settings->style['color']['color_primary']; ?>; }

.loop-container--style-newspaper .post__inwrap,
.loop-container--style-masonry .post__inwrap,
.loop-container--style-carousel .post,
.loop-container--style-carousel .post__inwrap,
.loop-container--style-slider .post { background: <?php echo $theme_settings->style['color']['color_white']; ?>; }

.loop-container--style-slider .post__text .excerpt { color: <?php echo $theme_settings->style['color']['color_grey']; ?>; }
.loop-container--style-slider_overlay .post__text a { color: <?php echo $theme_settings->style['color']['color_white']; ?>; }
.loop-container--style-slider_overlay .post__text a:hover { color: <?php echo $theme_settings->style['color']['color_primary']; ?>; }

.loop-container.loop-container--style-masonry .post__inwrap:before,
.loop-container.loop-container--style-newspaper .post__inwrap:before,
.loop-container.loop-container--related .post__inwrap:before {
	background: <?php echo $theme_settings->style['color']['color_primary']; ?>;
}

.loop-container--featured .post .post__media { background: <?php echo $theme_settings->style['color']['color_black']; ?>; }
.loop-container--featured .post .post__text { color: <?php echo $theme_settings->style['color']['color_white']; ?>; }
.loop-container--featured .post h2 a { color: <?php echo $theme_settings->style['color']['color_white']; ?>; }
.loop-container--featured .post h2 a:hover { color: <?php echo $theme_settings->style['color']['color_primary']; ?>; }

.loop-container--related .post .post__text .meta--item { color: <?php echo $theme_settings->style['color']['color_grey']; ?>; }
.main-content--m-plus .loop-container--related .post .post__text { background: <?php echo $theme_settings->style['color']['color_white']; ?>; }

.sleek-slider .sleek-ui--slider-arrows .sleek-ui__arrow:hover { background: <?php echo $theme_settings->style['color']['color_black']; ?>; }

.loop-container--style-list .format-standard h2 a, .loop-container--style-list .format-video h2 a, .loop-container--style-list .format-audio h2 a, .loop-container--style-list .type-page h2 a { color: <?php echo $theme_settings->style['color']['color_black']; ?>; }
.loop-container--style-list .format-standard h2 a:hover, .loop-container--style-list .format-video h2 a:hover, .loop-container--style-list .format-audio h2 a:hover, .loop-container--style-list .type-page h2 a:hover { color: <?php echo $theme_settings->style['color']['color_primary']; ?>; }

.loop-container--style-slider_overlay .post__text .excerpt {
	color: <?php echo $theme_settings->style['color']['color_white']; ?>;
}



/* Pagination */
.pagination--classic .page-numbers { color: <?php echo $theme_settings->style['color']['color_grey']; ?>; }
.pagination--classic .page-numbers:hover { color: <?php echo $theme_settings->style['color']['color_black']; ?>; }
.pagination--classic .page-numbers.current { color: <?php echo $theme_settings->style['color']['color_white']; ?>; background: <?php echo $theme_settings->style['color']['color_primary']; ?>; }
.pagination-message { color: <?php echo $theme_settings->style['color']['color_grey_light']; ?>; }



/* Widgets */
.dark-mode .widget__title { color: <?php echo $theme_settings->style['color']['color_grey_sidebar']; ?>; }


.widget_nav_menu a, .widget_pages a, .widget_archive a, .widget_categories a, .widget_meta a, .widget_recent_comments a, .widget_recent_entries a { color: <?php echo $theme_settings->style['color']['color_black']; ?>; }
.widget_nav_menu a:hover, .widget_pages a:hover, .widget_archive a:hover, .widget_categories a:hover, .widget_meta a:hover, .widget_recent_comments a:hover, .widget_recent_entries a:hover, .dark-mode .widget_nav_menu a:hover, .dark-mode .widget_pages a:hover, .dark-mode .widget_archive a:hover, .dark-mode .widget_categories a:hover, .dark-mode .widget_meta a:hover, .dark-mode .widget_recent_comments a:hover, .dark-mode .widget_recent_entries a:hover, .main-content .widget_nav_menu a:hover, .main-content .widget_pages a:hover, .main-content .widget_archive a:hover, .main-content .widget_categories a:hover, .main-content .widget_meta a:hover, .main-content .widget_recent_comments a:hover, .main-content .widget_recent_entries a:hover { color: <?php echo $theme_settings->style['color']['color_primary']; ?>; }
.dark-mode .widget_nav_menu a, .dark-mode .widget_pages a, .dark-mode .widget_archive a, .dark-mode .widget_categories a, .dark-mode .widget_meta a, .dark-mode .widget_recent_comments a, .dark-mode .widget_recent_entries a { color: <?php echo $theme_settings->style['color']['color_white']; ?>; }
.main-content .widget_nav_menu a, .main-content .widget_pages a, .main-content .widget_archive a, .main-content .widget_categories a, .main-content .widget_meta a, .main-content .widget_recent_comments a, .main-content .widget_recent_entries a { color: <?php echo $theme_settings->style['color']['color_grey']; ?>; }

.widget_tag_cloud a { color: <?php echo $theme_settings->style['color']['color_black']; ?>; }
.dark-mode .widget_tag_cloud a { color: <?php echo $theme_settings->style['color']['color_white']; ?>; }
.widget_tag_cloud a:hover { color: <?php echo $theme_settings->style['color']['color_white']; ?>; background: <?php echo $theme_settings->style['color']['color_primary']; ?>; border-color: <?php echo $theme_settings->style['color']['color_primary']; ?>; }
.dark-mode .widget_tag_cloud a:hover { color: <?php echo $theme_settings->style['color']['color_primary']; ?>; background: <?php echo $theme_settings->style['color']['color_white']; ?>; border-color: <?php echo $theme_settings->style['color']['color_white']; ?>; }



/* Loader */
.sleek-loader:before,
.sleek-loader:after {
	background: <?php echo $theme_settings->style['color']['color_primary']; ?>;
}



/* Lightbox */
.sleek-lightbox__close, .sleek-lightbox__arrow { color: <?php echo $theme_settings->style['color']['color_white']; ?>; }
.sleek-lightbox__arrow:hover { background: <?php echo $theme_settings->style['color']['color_primary']; ?>; }
.sleek-lightbox__close:hover { background: <?php echo $theme_settings->style['color']['color_white']; ?>; color: <?php echo $theme_settings->style['color']['color_black']; ?>; }
.sleek-lightbox__info { color: <?php echo $theme_settings->style['color']['color_white']; ?>; }



/* Elements  */
.read-more { border: 1px solid <?php echo $theme_settings->style['color']['color_black']; ?>; color: <?php echo $theme_settings->style['color']['color_black']; ?>; }
.read-more:before, .read-more:after { background: <?php echo $theme_settings->style['color']['color_black']; ?>; }
.read-more:hover { border-color: <?php echo $theme_settings->style['color']['color_primary']; ?>; background: <?php echo $theme_settings->style['color']['color_primary']; ?>; }
.read-more:hover:before, .read-more:hover:after { background: <?php echo $theme_settings->style['color']['color_white']; ?>; }
.read-more--continue { color: <?php echo $theme_settings->style['color']['color_primary']; ?>; }
.read-more--continue:hover { color: <?php echo $theme_settings->style['color']['color_black']; ?>; }





/* Custom CSS: Advanced CSS
 * Still in header.php to support wp-less
 *------------------------------------------------------------*/

<?php /*
	if( !empty( $theme_settings->advanced['custom_css'] ) ){
		echo $theme_settings->advanced['custom_css'];
	}
	*/
?>

</style>
<?php
}
