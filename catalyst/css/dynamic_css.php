<?php
require_once( '../../../../wp-load.php' );
Header("Content-type: text/css");

// Logo
if ( of_get_option ('logo_top_spacing') <>"" ) {
	echo '.logo { margin-top: ' . of_get_option( 'logo_top_spacing') . 'px; } ';
}

if ( of_get_option ('logo_left_spacing') <>"" ) {
	echo '.logo { margin-left: ' . of_get_option ('logo_left_spacing') . 'px; } ';
}

//*
//* Colors
//*
if ( !DEMO_STATUS ) {

	// background color
	if ( of_get_option ('theme_bg_color') <>"" ) {
		echo ' body { background-color: ' . of_get_option ('theme_bg_color') . '; } ';
	}

	// background color
	if ( of_get_option ('theme_bg_pattern') <>"" && of_get_option ('theme_bg_pattern') <>"none" ) {
		echo 'body { background-image: url("' . MTHEME_PATH . '/images/backgrounds/' . of_get_option ('theme_bg_pattern') . '"); background-repeat: repeat; background-attachment:fixed; } ';
	}

}

// Mainpage Welcome title color
if ( of_get_option ('welcome_title_color') <>"" ) {
	echo '.mainblock-2 h2 { color: ' . of_get_option ('welcome_title_color') . '; } ';
}
// Mainpage Welcome subtitle color
if ( of_get_option ('welcome_subtitle_color') <>"" ) {
	echo '.mainblock-2 h3 { color: ' . of_get_option ('welcome_subtitle_color') . '; } ';
}
// Mainpage Quotation
if ( of_get_option ('quotation_color') <>"" ) {
	echo '.quotes-block { color: ' . of_get_option ('quotation_color') . '; } ';
}

// Page color
if ( of_get_option ('page_color') <>"" ) {
	echo '#header,.main-contents, .page-contents, .contents-wrap, .contents-wrap, .contents-wrap { background: ' . of_get_option ('page_color') . '; } ';
}

// menu background
if ( of_get_option ('menu_background_color') <>"" ) {
	echo '#topmenu .homemenu ul ul li { background: ' . of_get_option ('menu_background_color') . '; } ';
}
//menu top level link color
if ( of_get_option ('menu_dropdown_top_text_color') <>"" ) {
	echo '#topmenu .homemenu a { color: ' . of_get_option ('menu_dropdown_top_text_color') . '; } ';
}
//menu top level hover text color
if ( of_get_option ('menu_dropdown_top_hover_text_color') <>"" ) {
	echo '#topmenu .homemenu ul li:hover>a{ color: ' . of_get_option ('menu_dropdown_top_hover_text_color') . '; } ';
}
//menu top level hover background
if ( of_get_option ('menu_dropdown_top_hover_bg_color') <>"" ) {
	echo '#topmenu .homemenu ul li:hover>a{ background: ' . of_get_option ('menu_dropdown_top_hover_bg_color') . '; } ';
}
// menu dropdown selected background color
if ( of_get_option ('menu_dropdown_current_item_bg_color') <>"" ) {
	echo '#topmenu .homemenu ul ul li.current-menu-item a { background: ' . of_get_option ('menu_dropdown_current_item_bg_color') . ' !important; } ';
}
// menu dropdown selected text color
if ( of_get_option ('menu_dropdown_current_item_text_color') <>"" ) {
	echo '#topmenu .homemenu ul ul li.current-menu-item a { color: ' . of_get_option ('menu_dropdown_current_item_text_color') . ' !important; } ';
}
// menu dropdown item color
if ( of_get_option ('menu_dropdown_item_color') <>"" ) {
	echo '#topmenu .homemenu ul ul li a { color: ' . of_get_option ('menu_dropdown_item_color') . ' !important; } ';
}
// menu dropdown item hover
if ( of_get_option ('menu_dropdown_item_hover_color') <>"" ) {
	echo '#topmenu .homemenu ul ul li:hover>a { color: ' . of_get_option ('menu_dropdown_item_hover_color') . ' !important; text-shadow:none;} ';
}
// menu dropdown background hover
if ( of_get_option ('menu_dropdown_hover_color') <>"" ) {
	echo '#topmenu .homemenu ul ul li:hover>a { background: ' . of_get_option ('menu_dropdown_hover_color') . '; } ';
}

// Title link color
if ( of_get_option ('title_link_color') <>"" ) {
	echo '.text-block-1 h3 a,.mblocktitle a,ul#portfolio-list h4 a,ul#portfolio-small h4 a,ul#portfolio-large h4 a,ul#portfolio-small-sidebar h4 a,ul#portfolio-one h4 a,ul#portfolio-one-sidebar h4 a,.postsummarytitle h2 a { color: ' . of_get_option ('title_link_color') . '; } ';
}
// Title link hover color
if ( of_get_option ('title_link_hover_color') <>"" ) {
	echo '.text-block-1 h3 a:hover,.mblocktitle a:hover,ul#portfolio-list h4 a:hover,ul#portfolio-small h4 a:hover,ul#portfolio-large h4 a:hover,ul#portfolio-small-sidebar h4 a:hover,ul#portfolio-one h4 a:hover,ul#portfolio-one-sidebar h4 a:hover,.postsummarytitle h2 a:hover { color: ' . of_get_option ('title_link_hover_color') . '; } ';
}

// Page Titles
if ( of_get_option ('page_title_color') <>"" ) {
	echo 'h1.entry-title,.entry-mainpost-title,.entry-single-title h1,h1.page-title,h2.entry-title { color: ' . of_get_option ('page_title_color') . '; } ';
}

// Post detail
if ( of_get_option ('post_detail') <>"" ) {
	echo '.postedin,.posted-date { color: ' . of_get_option ('post_detail') . '; } ';
}
// Post detail links
if ( of_get_option ('post_detail_links') <>"" ) {
	echo '.postedin a,span.comments a { color: ' . of_get_option ('post_detail_links') . '; } ';
}
// Post detail hover links
if ( of_get_option ('post_detail_hover_links') <>"" ) {
	echo '.postedin a:hover,span.comments a:hover { color: ' . of_get_option ('post_detail_hover_links') . '; } ';
}

// Readmore link
if ( of_get_option ('readmore_link_color') <>"" ) {
	echo '.readmore_link a { color: ' . of_get_option ('readmore_link_color') . '; } ';
}
// Readmore hover link
if ( of_get_option ('readmore_hover_link_color') <>"" ) {
	echo '.readmore_link a:hover { color: ' . of_get_option ('readmore_hover_link_color') . '; } ';
}

// Sidebar titles
if ( of_get_option ('sidebar_title_color') <>"" ) {
	echo '.sidebar h3 { color: ' . of_get_option ('sidebar_title_color') . '; } ';
}
// Sidebar links
if ( of_get_option ('sidebar_link_color') <>"" ) {
	echo '.sidebar a,.recentpost_title { color: ' . of_get_option ('sidebar_link_color') . ' !important; } ';
}
if ( of_get_option ('sidebar_hover_link_color') <>"" ) {
	echo '.sidebar a:hover,.recentpost_title:hover { color: ' . of_get_option ('sidebar_hover_link_color') . ' !important; } ';
}

?>