<?php

/**
 * Insert custom css from options panel settings
 *
 * From version 1.0
 */
if(!function_exists('epic_insert_custom_css')){
function epic_insert_custom_css(){

	// DEFINE CONSTANTS
	
	// Global options
	define('EPIC_DISABLE_SEARCH', get_option('epic_disable_search'));
	$headerlogo =  get_option('epic_header_logo_url');
	
	
	$sitelayout = get_option('epic_site_layout');
	
	/* Header graphic */
	$headergraphic =  get_option('epic_header_graphic');
		
	/* Logo position  */
	
	$epic_logo_x_pos = get_option('epic_logo_x_pos');
	$epic_logo_y_pos = get_option('epic_logo_y_pos');
	
	/* WPML position  */
	
	$epic_wpml_x_pos = get_option('epic_wpml_x_pos');
	$epic_wpml_y_pos = get_option('epic_wpml_y_pos');
	
	/* Buddypress menu position  */
	
	$epic_bp_menu_x_pos = get_option('epic_bp_menu_x_pos');
	$epic_bp_menu_y_pos = get_option('epic_bp_menu_y_pos');
	
	/* Searchform position */
	
	$epic_searchform_x_pos = get_option('epic_searchform_x_pos');
	$epic_searchform_y_pos = get_option('epic_searchform_y_pos');
	
	/* Header textbox position */
	
	$epic_header_textbox_x_pos = get_option('epic_header_textbox_x_pos');
	$epic_header_textbox_y_pos = get_option('epic_header_textbox_y_pos');
	$epic_header_textbox_width = get_option('epic_header_textbox_width');
	$epic_header_textbox_height = get_option('epic_header_textbox_height');

	/* Social media position */
	
	$epic_socialmedia_x_pos = get_option('epic_socialmedia_x_pos');
	$epic_socialmedia_y_pos = get_option('epic_socialmedia_y_pos');
	
	/* Secondary menu position */
	
	$epic_primary_x_pos = get_option('epic_primary_x_pos');
	$epic_primary_y_pos = get_option('epic_primary_y_pos');
	
	/* Secondary menu position */
	
	$epic_secondary_x_pos = get_option('epic_secondary_x_pos');
	$epic_secondary_y_pos = get_option('epic_secondary_y_pos');

	
	/* Header height */
	
	$epic_header_height = get_option('epic_header_height');
		
	
	// Secondary menu
	
	$epic_sm_width = get_option('epic_sm_width').'px';
	if($epic_sm_width == 'px'){$epic_sm_width = 'auto';}
	
	$epic_sm_align = get_option('epic_sm_align');
	if(empty($epic_sm_align )){$epic_sm_align = 'left';}

	$epic_sm_textalign = get_option('epic_sm_textalign');
	if(empty($epic_sm_textalign )){$epic_sm_textalign = 'left';}

	
	//$footerlogo =  get_option('epic_footer_logo_url');
	
	
	// Get font options
	define('EPIC_CUSTOM_CSS', get_option('epic_custom_css'));
	//define('EPIC_TITLE_FONT_RENDERING', get_option('epic_title_font_rendering'));
	//define('EPIC_BODY_FONT_RENDERING', get_option('epic_body_font_rendering'));
	//define('EPIC_CUFON_FONT', get_option('epic_cufon_title_font'));
	//define('EPIC_CUSTOM_CUFON_FONT', get_option('epic_custom_cufon_title_font'));
	//define('EPIC_HTML_FONT', get_option('epic_html_font'));
	//define('EPIC_TITLE_FONT', get_option('epic_websafe_title_font'));


	// Style and layout
	
	define('EPIC_LISTED_BACKGROUNDIMAGE', get_option('epic_background_texture'));
	define('EPIC_CUSTOM_BACKGROUNDIMAGE', get_option('epic_custom_background_image'));
	define('EPIC_CUSTOM_BACKGROUNDCOLOR', get_option('epic_custom_background_color'));
	define('EPIC_DISABLE_TILED_BACKGROUND', get_option('epic_disable_tiled_background'));
	define('EPIC_BACKGROUND_REPEAT', get_option('epic_body_background_repeat'));
	define('EPIC_BACKGROUND_POSITION', get_option('epic_body_background_position'));
		
	// Font colors
	define('EPIC_LINK_COLOR', get_option('epic_custom_link_color'));
	define('EPIC_HOVER_COLOR', get_option('epic_custom_link_hover_color'));
	define('EPIC_PARAGRAPH_COLOR', get_option('epic_p_color'));
	define('EPIC_H1_COLOR', get_option('epic_h1_color'));
	define('EPIC_H2_COLOR', get_option('epic_h2_color'));
	define('EPIC_H3_COLOR', get_option('epic_h3_color'));
	define('EPIC_H4_COLOR', get_option('epic_h4_color'));
	define('EPIC_H5_COLOR', get_option('epic_h5_color'));
	define('EPIC_H6_COLOR', get_option('epic_h6_color'));
	
	define('EPIC_PARAGRAPH_SIZE', get_option('epic_p_size'));
	define('EPIC_H1_SIZE', get_option('epic_h1_size'));
	define('EPIC_H2_SIZE', get_option('epic_h2_size'));
	define('EPIC_H3_SIZE', get_option('epic_h3_size'));
	define('EPIC_H4_SIZE', get_option('epic_h4_size'));
	define('EPIC_H5_SIZE', get_option('epic_h5_size'));
	define('EPIC_H6_SIZE', get_option('epic_h6_size'));
	
	/* Font weights */
	$bold_h1 = get_option('epic_h1_weight');
	$bold_h2 = get_option('epic_h2_weight');
	$bold_h3 = get_option('epic_h3_weight');
	$bold_h4 = get_option('epic_h4_weight');
	$bold_h5 = get_option('epic_h5_weight');
	$bold_h6 = get_option('epic_h6_weight');
	$bold_p  = get_option('epic_p_weight');
	
	
	/* Color settings */
	
	$epic_page_background = get_option ("epic_page_background");
	$epic_header_background = get_option ("epic_header_background");
	$epic_footer_background = get_option ("epic_footer_background");
	
	$epic_link_color = get_option ("epic_link_color");
	$epic_link_color_hover = get_option ("epic_link_color_hover");
	$epic_header_link_color = get_option ("epic_header_link_color");
	$epic_header_link_color_hover = get_option ("epic_header_link_color_hover");
	$epic_footer_link_color = get_option ("epic_footer_link_color");
	$epic_footer_link_color_hover = get_option ("epic_footer_link_color_hover");
				
	$epic_primary_background = get_option ("epic_primary_background");
	$epic_primary_border = get_option ("epic_primary_border");
	$epic_primary_border_hover = get_option ("epic_primary_border_hover");
	$epic_primary_background_hover = get_option ("epic_primary_background_hover");
	$epic_primary_link = get_option ("epic_primary_link");
	$epic_primary_link_hover = get_option ("epic_primary_link_hover");
	
	$epic_twittermodule_background = get_option ("epic_twittermodule_background");
	$epic_tickermodule_background = get_option ("epic_tickermodule_background");
	$epic_searchmodule_background = get_option ("epic_searchmodule_background");
	$epic_signupmodule_background = get_option ("epic_signupmodule_background");
	
	
$out = '';

// Site layout

if($sitelayout == 'left'){
	$out.= '#content-inner { margin-left:0;}'."\n";
	}
	
if($sitelayout == 'right'){
	$out.= '#content-inner { margin-right:0;}'."\n";
	}

// Main menu

if(!empty($epic_primary_link)){
	$out.= 'ul#menu-primary li a { color:' . $epic_primary_link . ';}'."\n";
	}
	
if(!empty($epic_primary_link_hover)){
	$out.= 'ul#menu-primary li a:hover { color:' . $epic_primary_link_hover . ';}'."\n";
	}
	
if(!empty($epic_primary_background)){
	$out.= '#primary { background-color:' . $epic_primary_background . ';}'."\n";
	}
		
if(!empty($epic_primary_border)){
	$out.= '#primary { border-color:' . $epic_primary_border . ';}'."\n";
	}
	
if(!empty($epic_primary_background_hover)){
	$out.= 'ul#menu-primary li a:hover{ background-color:' . $epic_primary_background_hover . ';}'."\n";
	}
	
if(!empty($epic_primary_border_hover)){
	$out.= 'ul#menu-primary li a:hover, ul#menu-primary li.current-menu-item a, ul#menu-primary li.current-menu-ancestor a { border-color:' . $epic_primary_border_hover . ';}'."\n";
	}
	
/* Links */
if(!empty($epic_link_color)){
	$out.= 'a { color:' . $epic_link_color . ';}'."\n";
	$out.= '.module-header .module-content {border-top-color:'.$epic_link_color.';}'."\n";
	$out.= '.flex-caption h3 {background:'.$epic_link_color.';}';
	$out.= '
ul#menu-primary > li.current-menu-item a,
ul#menu-primary > li.current-menu-ancestor > a,
ul#menu-primary > li.current-menu-item a:hover,
ul#menu-primary > li.current-menu-ancestor > a:hover,
ul#menu-primary li a:hover,
ul#menu-primary li a.active { border-bottom-color:'.$epic_link_color.';}';
	$out.= 'ul#menu-primary li .sub-menu { border-top-color:'.$epic_link_color.';}';
	$out .= 'ul.portfolio-items li:hover {border-color:'.$epic_link_color.';}';
	$out .= '.module-featured .page:hover {border-color:'.$epic_link_color.';}';
	$out.= 'a.epic_link:hover { border-bottom-color:'.$epic_link_color.';}';
	}
	
if(!empty($epic_link_color_hover)){
	$out.= 'a:hover { color:' . $epic_link_color_hover . ';}'."\n";
	}
	
if(!empty($epic_header_link_color)){
	$out.= '#header a { color:' . $epic_header_link_color . ';}'."\n";
	}
	
if(!empty($epic_header_link_color_hover)){
	$out.= '#header a:hover { color:' . $epic_header_link_color_hover . ';}'."\n";
	}
	
if(!empty($epic_footer_link_color)){
	$out.= '#footer a { color:' . $epic_footer_link_color . ';}'."\n";
	}
	
if(!empty($epic_footer_link_color_hover)){
	$out.= '#footer a:hover { color:' . $epic_footer_link_color_hover . ';}'."\n";
	}


// Header background

if(!empty($epic_header_background)){
	$out.= '#header { background-color:' . $epic_header_background . ';}'."\n";
	}
	

// Footer background

if(!empty($epic_footer_background)){
	$out.= '#footer { background-color:' . $epic_footer_background . ';}'."\n";
	}
	
// Ticker module background

if(!empty($epic_tickermodule_background)){
	$out.= '#module-ticker .module-content { background-color:' . $epic_tickermodule_background . ';}'."\n";
	}
	
// Twitter module background

if(!empty($epic_twittermodule_background)){
	$out.= '#module-twitter .module-content { background-color:' . $epic_twittermodule_background . ';}'."\n";
	}
	
// Search module background

if(!empty($epic_searchmodule_background)){
	$out.= '#module-search .module-content { background-color:' . $epic_searchmodule_background . ';}'."\n";
	}
	
// Signup module background

if(!empty($epic_signupmodule_background)){
	$out.= '#module-signup .module-content { background-color:' . $epic_signupmodule_background . ';}'."\n";
	}

// Fonts


if(get_option('epic_p_size')){
	$out.= 'body,html,p{font-size:' .get_option('epic_p_size') . ';}'."\n";
	}

if(get_option('epic_picto_color')){
	$out.= '.symbol figure{background-color:'.get_option('epic_picto_color').';}'."\n";
	}
	

// Title fonts for h1,h2,h3 and h4
if(get_option('epic_title_font_rendering') == 'google' && get_option('epic_google_title_fontfamily') != ''){
	
	$out.= '#wrapper h1, #wrapper h2, #wrapper h3, #wrapper h4, #wrapper h5 {font-family:'. stripslashes(get_option('epic_google_title_fontfamily')) . '; }'."\n";
}

elseif(get_option('epic_title_font_rendering') == 'websafe'){
	$out.= '#wrapper h1, #wrapper h2, #wrapper h3, #wrapper h4, #wrapper h5 {font-family:' .get_option('epic_websafe_title_font') . ';}'."\n";
}

// Body

if(get_option('epic_body_font_rendering') == 'google' && get_option('epic_body_google_fontfamily') != ''){
	
	$out.= 'body,html { font-family:' . stripslashes(get_option('epic_body_google_fontfamily')) . ';}'."\n";
}

elseif(get_option('epic_body_font_rendering') == 'websafe'){
	
	$out.= 'body,html, #wrapper h5, #wrapper h6{font-family:'.get_option('epic_body_websafe_font').'}'."\n";
}



/* Logo position */
if($epic_logo_x_pos || $epic_logo_y_pos){
	$out.= '#logo{left:'.$epic_logo_x_pos.'px; top:'.$epic_logo_y_pos.'px;}'."\n";
}

/* Buddypress mene position */
if($epic_bp_menu_x_pos || $epic_bp_menu_y_pos){
	$out.= '#epic_bp_menu{left:'.$epic_bp_menu_x_pos.'px; top:'.$epic_bp_menu_y_pos.'px;}'."\n";
}

/* WPML language selector position */
if($epic_wpml_x_pos || $epic_wpml_y_pos){
	$out.= '#epic_wpml_lang_selector{left:'.$epic_wpml_x_pos.'px; top:'.$epic_wpml_y_pos.'px;}'."\n";
}

/* Searchform position */
if($epic_searchform_x_pos || $epic_searchform_y_pos){
	//$out.= '#header .epic_searchform { left:'.$epic_searchform_x_pos.'px; top:'.$epic_searchform_y_pos.'px; }'."\n";
}

/* Social media position */
if($epic_socialmedia_x_pos || $epic_socialmedia_y_pos){
	//$out.= '#header .epic_socialmedia { left:'.$epic_socialmedia_x_pos.'px; top:'.$epic_socialmedia_y_pos.'px; }'."\n";
}

/* Header text box size and position */
if($epic_header_textbox_x_pos || $epic_header_textbox_y_pos || $epic_header_textbox_width || $epic_header_textbox_height){
	$out.= '#header #header-textbox  { left:'.$epic_header_textbox_x_pos.'px; top:'.$epic_header_textbox_y_pos.'px; width:'.$epic_header_textbox_width.'px; height:'.$epic_header_textbox_height.'px}'."\n";
}

/* Primary menu position */
if($epic_primary_x_pos || $epic_primary_y_pos){
	//$out.= '#primary { left:'.$epic_primary_x_pos.'px; top:'.$epic_primary_y_pos.'px; }'."\n";
}


/* Secondary menu position */
if($epic_secondary_x_pos || $epic_secondary_y_pos){
	$out.= '#secondary { left:'.$epic_secondary_x_pos.'px; top:'.$epic_secondary_y_pos.'px; }'."\n";
}

if($epic_header_height){
	$out.= '.module-header .module-content{height:'.$epic_header_height.'px;}'."\n";
}



// Background color
if($epic_page_background){ $out.= '#wrapper{background-color:'.$epic_page_background.'} '."\n";}

//Background position
if(EPIC_BACKGROUND_POSITION){ 
$out.= '#wrapper{'.EPIC_BACKGROUND_POSITION.'}'."\n";
}

// Background repeat
if(EPIC_BACKGROUND_REPEAT){ 
$out.= '#wrapper{'.EPIC_BACKGROUND_REPEAT.'}'."\n";
}

// Background image
if( EPIC_LISTED_BACKGROUNDIMAGE != ''){ 
$out.= '#wrapper{background-image:url('.get_template_directory_uri(). '/library/images/textures/'.EPIC_LISTED_BACKGROUNDIMAGE. ')}'."\n";
}
// Alternative background-image
else if(EPIC_CUSTOM_BACKGROUNDIMAGE){ $out.= '#wrapper{background-image:url('.EPIC_CUSTOM_BACKGROUNDIMAGE.') }'."\n"; } 
	
	

// FONT SIZES:

if(EPIC_PARAGRAPH_SIZE){
	$out.= 'body,p{font-size:'.EPIC_PARAGRAPH_SIZE.'px}'."\n";
	}
if(EPIC_H1_SIZE){
	$out.= 'h1{font-size:'.EPIC_H1_SIZE.'px;}'."\n";
	}
if(EPIC_H2_SIZE){
	$out.= 'h2{font-size:'.EPIC_H2_SIZE.'px;}'."\n";
	}
if(EPIC_H3_SIZE){
	$out.= 'h3{font-size:'.EPIC_H3_SIZE.'px;}'."\n";
	}
if(EPIC_H4_SIZE){
	$out.= 'h4{font-size:'.EPIC_H4_SIZE.'px;}'."\n";
	}
if(EPIC_H5_SIZE){
	$out.= 'h5{font-size:'.EPIC_H5_SIZE.'px;}'."\n";
	}
if(EPIC_H6_SIZE){
	$out.= 'h6{font-size:'.EPIC_H6_SIZE.'px;}'."\n";
	}
	
// FONT WEIGHTS:

if($bold_h1){
	$out.= 'h1{font-weight:bold;}'."\n";
	}
if($bold_h2){
	$out.= 'h2{font-weight:bold;}'."\n";
	}
if($bold_h3){
	$out.= 'h3{font-weight:bold;}'."\n";
	}
if($bold_h4){
	$out.= 'h4{font-weight:bold;}'."\n";
	}
if($bold_h5){
	$out.= 'h5{font-weight:bold;}'."\n";
	}
if($bold_h6){
	$out.= 'h6{font-weight:bold;}'."\n";
	}
if($bold_p){
	$out.= 'p{font-weight:bold;}'."\n";
	}
	
// FONT COLORS:

if(EPIC_PARAGRAPH_COLOR){
	$out.= 'body,p{color:'.EPIC_PARAGRAPH_COLOR.'}'."\n";
	}
	
if(EPIC_H1_COLOR){
	$out.= 'h1 {color:'.EPIC_H1_COLOR.';}'."\n";
	}
if(EPIC_H2_COLOR){
	$out.= 'h2{color:'.EPIC_H2_COLOR.';}'."\n";
	}
if(EPIC_H3_COLOR){
	$out.= 'h3{color:'.EPIC_H3_COLOR.';}'."\n";
	}
if(EPIC_H4_COLOR){
	$out.= 'h4{color:'.EPIC_H4_COLOR.';}'."\n";
	}
if(EPIC_H5_COLOR){
	$out.= 'h5{color:'.EPIC_H5_COLOR.';}'."\n";
	}
if(EPIC_H6_COLOR){
	$out.= 'h6{color:'.EPIC_H6_COLOR.';}'."\n";
	}
	
if(EPIC_LINK_COLOR){
	$out.= 'a{color:'.EPIC_LINK_COLOR.';}'."\n";
	
	
	}
	
if(EPIC_HOVER_COLOR){
	$out.= 'a:hover{color:'.EPIC_HOVER_COLOR.'}'."\n";
	
	}
	

if(EPIC_CUSTOM_CSS){
	
	$out.= stripslashes(EPIC_CUSTOM_CSS); 

}


return $out;

}

}

?>