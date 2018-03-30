<?php
/*------------------------------------------------*/
/* Custom CSS Output */
/*------------------------------------------------*/
/*
* function to push in custom font type.
* for use in truethemes_settings_css()
* @since version 2.6 development
* @param string $option_value, option value from database
* @paran string $css_code, for custom css font code
*/
function truethemes_push_custom_font($option_value,$css_code){
global $css_array;
global $css_link_container;
$google_font_types = array(
'Droid+Sans',
'Cabin',
'Cantarell',
'Cuprum',
'Oswald',
'Neuton',
'Orbitron',
'Arvo',
'Kreon',
'Indie+Flower',
'Josefin Sans'
);

if( ($option_value != 'nofont' && $option_value != '')){
$custom_logo_font_link = '<link rel="stylesheet" href="//fonts.googleapis.com/css?family='.$option_value.'" />'."\n";	
$custom_logo_font_code = $css_code;			
//check if font is google font, if yes, we provide font link
if(in_array($option_value,$google_font_types)){

if(!in_array($custom_logo_font_link,$css_link_container)){
//check if already in link container, if not then we add the css link.
array_push($css_link_container,$custom_logo_font_link);
}

}

array_push($css_array,$custom_logo_font_code);
}

}

/*
*  set global css array and css link container
*  for use in truethemes_setting_css() and truethemes_push_custom_css
*  @since version 2.6 development
*/

if(!isset($css_array)){
$css_array = array();
}

if(!isset($css_link_container)){
$css_link_container = array();
}

function truethemes_settings_css(){
//modified version 2.6 development

global $css_array;
global $css_link_container;

//get all css settings
//htmlspecialchars_decode and stripslashes function added in version 3.0.2 to prevent sanitize of custom css codes!
global $ttso;
$custom_css             = htmlspecialchars_decode(stripslashes($ttso->ka_custom_css),ENT_QUOTES);
$dropdown_css           = $ttso->ka_dropdown;
$nav_description        = $ttso->ka_nav_description;
$google_font            = $ttso->ka_google_font;
$custom_google_font     = $ttso->ka_custom_google_font;
$blog_image_frame       = $ttso->ka_blog_image_frame;
$responsive             = $ttso->ka_responsive;
$ubermenu               = $ttso->ka_ubermenu;                    //check if ubermenu is active
$ubermenu_styling       = $ttso->ka_ubermenu_karma_styling;      //check if ubermenu-enable-karma-styling is active
$ubermenu_karma_mobile  = $ttso->ka_ubermenu_karma_mobile_menu;  //check if ubermenu-enable-karma-mobile-menu is active

//theme designer settings
$boxedlayout                              = $ttso->ka_boxedlayout;
$boxedlayout_shadow                       = $ttso->ka_boxedlayout_shadow;
$body_bg_color                            = $ttso->ka_body_bg_color;
$body_bg_image                            = $ttso->ka_body_bg_image;
$body_bg_image_select                     = $ttso->ka_select_body_bg;
$body_designer_page_background_position   = $ttso->ka_designer_page_background_position;
$body_designer_page_background_repeat     = $ttso->ka_designer_page_background_repeat;
$body_designer_page_background_fixed      = $ttso->ka_designer_page_background_fixed;
$div_main_custom_color                    = $ttso->ka_div_main_custom_color;
$content_separator_dark                   = $ttso->ka_content_separator_dark;
$content_separator_light                  = $ttso->ka_content_separator_light;
$header_transparent_overlay               = $ttso->ka_header_transparent_overlay;
$footer_transparent_overlay               = $ttso->ka_footer_transparent_overlay;
$footer_callout_linkhover                 = $ttso->ka_footer_callout_link_hover_bg;
$footer_callout_main_bg                   = $ttso->ka_footer_callout_main_bg;
$header_transparent_overlay_upload        = $ttso->ka_header_transparent_overlay_upload;
$footer_transparent_overlay_upload        = $ttso->ka_footer_transparent_overlay_upload;
$header_height_adjust                     = $ttso->ka_header_height_adjust;
$font_kit_modern                          = $ttso->ka_font_kit_modern;
$font_kit_serif                           = $ttso->ka_font_kit_serif;
$font_kit_organic                         = $ttso->ka_font_kit_organic;
$jquery3_transparent_overlay              = $ttso->ka_jquery3_transparent_overlay;
$retina_logo                              = $ttso->ka_sitelogo_retina;
$sitelogo_width                           = $ttso->ka_sitelogo_width;
$sitelogo_height                          = $ttso->ka_sitelogo_height;
/**
 *
 * Color Scheme Customization Values
 * 
 * removed the need for checkbox to activate custom color scheme.
 * added more color-pickers for greater customization
 *
 * @since Karma 4.6
 */

//check if custom scheme is active - @since 4.6 deprecated
$old_custom_primary                               = $ttso->ka_activate_custom_primary_color_scheme;
$old_custom_secondary                             = $ttso->ka_activate_custom_secondary_color_scheme;

// primary color scheme
$custom_scheme_primary_toolbar                    = $ttso->ka_custom_scheme_primary_toolbar;
$custom_scheme_primary_gradient_light             = $ttso->ka_custom_scheme_primary_gradient_light; //@since 4.6 deprecated
$custom_scheme_primary_gradient_dark              = $ttso->ka_custom_scheme_primary_gradient_dark; //@since 4.6 deprecated
$custom_scheme_primary_border_top                 = $ttso->ka_custom_scheme_primary_border_top; //@since 4.6 deprecated
$custom_scheme_primary_footer_text                = $ttso->ka_custom_scheme_primary_footer_text;
$custom_scheme_primary_footer_bottom              = $ttso->ka_custom_scheme_primary_footer_bottom;
$custom_scheme_primary_menu_dropdown_bg           = $ttso->ka_custom_scheme_primary_menu_dropdown_bg;
$custom_scheme_primary_menu_dropdown_linkhover_bg = $ttso->ka_custom_scheme_primary_menu_dropdown_linkhover_bg;

// primary color scheme - ie8
$custom_scheme_primary_ie8_toolbar_text           = $ttso->ka_custom_scheme_primary_ie8_toolbar_text;
$custom_scheme_primary_ie8_navi_text              = $ttso->ka_custom_scheme_primary_ie8_toolbar;

// primary color scheme - images
$custom_scheme_image_footer_bottom                = $ttso->ka_custom_scheme_image_footer_bottom;

// secondary color scheme
$custom_scheme_secondary_gradient_light           = $ttso->ka_custom_scheme_secondary_gradient_light;
$custom_scheme_secondary_gradient_dark            = $ttso->ka_custom_scheme_secondary_gradient_dark;
$custom_scheme_secondary_active_horz_link         = $ttso->ka_custom_scheme_secondary_active_horz_link;
$custom_scheme_secondary_link_color               = $ttso->ka_custom_scheme_secondary_link_color;

// secondary color scheme - ie8
$custom_scheme_secondary_ie8_footer_links         = $ttso->ka_custom_scheme_secondary_ie8_footer_links;
$custom_scheme_secondary_ie8_footer_headings      = $ttso->ka_custom_scheme_secondary_ie8_footer_headings;

// secondary color scheme - images
$custom_scheme_image_footer_bottom                = $ttso->ka_custom_scheme_image_footer_bottom;
$custom_scheme_image_jquery_banner                = $ttso->ka_custom_scheme_image_jquery_banner;
$custom_scheme_image_nav_state                    = $ttso->ka_custom_scheme_image_nav_state;
$custom_scheme_image_top                          = $ttso->ka_custom_scheme_image_top;
$custom_scheme_image_middle                       = $ttso->ka_custom_scheme_image_middle;
$custom_scheme_image_bottom                       = $ttso->ka_custom_scheme_image_bottom;

// new @since 4.6
$design_header_flat                               = $ttso->ka_design_header_flat;
$design_header_border_bottom                      = $ttso->ka_design_header_border_bottom;
$design_top_toolbar_link                          = $ttso->ka_design_top_toolbar_link;
$design_top_toolbar_link_hover                    = $ttso->ka_design_top_toolbar_link_hover;
$design_top_toolbar_dropdown_menu                 = $ttso->ka_design_top_toolbar_dropdown_menu;
$design_top_toolbar_dropdown_menu_linkbg_hover    = $ttso->ka_design_top_toolbar_dropdown_menu_linkbg_hover;
$design_header_menu_link                          = $ttso->ka_design_header_menu_link;
$design_header_menu_link_hover                    = $ttso->ka_design_header_menu_link_hover;
$design_header_menu_link_description              = $ttso->ka_design_header_menu_link_description;
$design_header_menu_dropdown_link                 = $ttso->ka_design_header_menu_dropdown_link;
$design_header_menu_dropdown_linkhover            = $ttso->ka_design_header_menu_dropdown_linkhover;
$design_header_menu_dropdown_currentlink          = $ttso->ka_design_header_menu_dropdown_currentlink;
$design_footer_flat                               = $ttso->ka_design_footer_flat;
$design_footer_gradient_top                       = $ttso->ka_design_footer_gradient_top;
$design_footer_gradient_bottom                    = $ttso->ka_design_footer_gradient_bottom;
$design_footer_border_top                         = $ttso->ka_design_footer_border_top;
$design_footer_border_bottom                      = $ttso->ka_design_footer_border_bottom;
$design_footer_link                               = $ttso->ka_design_footer_link;
$design_footer_link_hover                         = $ttso->ka_design_footer_link_hover;
$design_footer_bottom_link                        = $ttso->ka_design_footer_bottom_link;
$design_footer_bottom_link_hover                  = $ttso->ka_design_footer_bottom_link_hover;
$design_footer_scroll_top_bg                      = $ttso->ka_design_footer_scroll_top_bg;
$design_footer_scroll_top_bg_hover                = $ttso->ka_design_footer_scroll_top_bg_hover;
$design_jquery1_flat                              = $ttso->ka_design_jquery1_flat;
$design_jquery1_gradient_inner                    = $ttso->ka_design_jquery1_gradient_inner;
$design_jquery1_gradient_outer                    = $ttso->ka_design_jquery1_gradient_outer;
$design_page_titlebar_flat                        = $ttso->ka_design_page_titlebar_flat;
$design_page_titlebar_gradient_inner              = $ttso->ka_design_page_titlebar_gradient_inner;
$design_page_titlebar_gradient_outer              = $ttso->ka_design_page_titlebar_gradient_outer;
$design_page_postcomments_flat                    = $ttso->ka_design_page_postcomments_flat;
$design_page_postcomments_gradient_inner          = $ttso->ka_design_page_postcomments_gradient_inner;
$design_page_postcomments_gradient_outer          = $ttso->ka_design_page_postcomments_gradient_outer;

// new @since 4.8
$karma_header_style       = $ttso->ka_header_design_style;
$footer_shadow_style      = get_option('ka_footer_shadow_style');//@since 4.8
$footer_shadow_style      = apply_filters('footer_shadow_style',$footer_shadow_style); //karma filter
$header_shadow_style      = get_option('ka_header_shadow_style');//@since 4.8
$header_shadow_style      = apply_filters('header_shadow_style',$header_shadow_style); //karma filter


//@since 4.0 pre-define for backward-compatibility
if('' == $header_transparent_overlay): 'overlay-rays.png' == $header_transparent_overlay; endif; //maintain "rays" image
if('' == $footer_transparent_overlay): 'overlay-none'     == $footer_transparent_overlay; endif;

//push in css if not empty from setting
//custom css
if(!empty($custom_css)){
array_push($css_array,$custom_css);
}

$retina_logo_code = '
#header .tt-retina-logo {
	width: '.$sitelogo_width .';
 	height: '.$sitelogo_height.';
  	url: "'.$retina_logo.'";
}
';
array_push($css_array,$retina_logo_code);
//responsive css
if('true' == $responsive ){
$responsive_css_code = '#tt-mobile-menu-wrap, #tt-mobile-menu-button {display:none !important;}';
array_push($css_array,$responsive_css_code);	
}

//google font css
if( ($google_font != 'nofont' && $custom_google_font == '')){
$google_font_link = '<link rel="stylesheet" href="//fonts.googleapis.com/css?family='.$google_font.'" />'."\n";	
$google_font_code = 'h1, h2, h3, h4, h5 #main .comment-title, .four_o_four, .callout-wrap span, .search-title,.callout2, .comment-author-about, .logo-text {font-family:\''.$google_font.'\', Arial, sans-serif;}'."\n";
array_push($css_link_container,$google_font_link);
array_push($css_array,$google_font_code);
}

if($custom_google_font != ''){

//remove space and add + sign if there is space found in user entered custom font name.
//the google font name in css link has a plus sign.
$custom_google_font_name = str_replace(" ","+",$custom_google_font); 
$google_custom_link =  '<link rel="stylesheet" href="//fonts.googleapis.com/css?family='.$custom_google_font_name.'">'."\n";	

$sanitize = array('+','-'); //some font name have plus parameter, such as Special+Elite
// remove the plus and add space to custom font name, if there is a plus between the font name.
$sanitized_google_font_name = str_replace($sanitize,' ',$custom_google_font);
//the google font name in css item, does not have plus sign and needs a space.

$google_custom_font_code = 'h1, h2, h3, h4, h5 #main .comment-title, .four_o_four, .callout-wrap span, .search-title,.callout2, .comment-author-about, .logo-text {font-family:\''.$sanitized_google_font_name.'\', Arial, sans-serif;}'."\n";
array_push($css_link_container,$google_custom_link);
array_push($css_array,$google_custom_font_code);			
}

//blog shadow frame
if('shadow' == $blog_image_frame){
$nav_com_css = '.post_thumb {background-position: 0 -396px;}.post_thumb img {margin: 6px 0 0 6px;}';
array_push($css_array,$nav_com_css);		
}

/*--------------------------------------------------------------------*/
/* UberMenu */
/*--------------------------------------------------------------------*/
//ubermenu plugin styles
if('true' == $ubermenu_styling ){
$ubermenu_css_code = '
.ubermenu {
	background: none;
}
.ubermenu ul.ubermenu-nav > li.ubermenu-item > a,
.ubermenu ul.ubermenu-nav > li.ubermenu-item > span.um-anchoremulator {
	border-left: none;
}
ul.ubermenu-nav {
	margin-top: 8px !important;
}
.ubermenu ul.ubermenu-nav > li.ubermenu-item > a span.ubermenu-target-title {
    color: #FFFFFF;
    display: block;
    font-size: 13px;
    font-weight: bold;
	text-transform: uppercase;
	letter-spacing: 0.6px;
}
.ubermenu ul.ubermenu-nav li.ubermenu-item > a span.ubermenu-target-description {
	color: rgba(255,255,255, 0.5);
	font-size: 12px;
	padding-top: 4px;
}
#wrapper.tt-uberstyling-enabled .ubermenu ul.ubermenu-nav > li.ubermenu-item.tt-uber-parent {
	border-top-left-radius: 3px;
	border-top-right-radius: 3px;
}
.ubermenu ul li.ubermenu-item ul.ubermenu-submenu li.ubermenu-item,
.ubermenu ul li.ubermenu-item ul.ubermenu-submenu li.widget {
	font-size: inherit !important;	
}
.header-area .ubermenu ul.ubermenu-nav li a {
	padding-top: 7px !important;	
}
.header-area .ubermenu ul li.ubermenu-item ul li.ubermenu-item {
	padding:0 10px;	
}
.header-area .ubermenu ul.ubermenu-nav > li.ubermenu-item > ul.ubermenu-submenu {
	-webkit-border-radius: 5px;
       -moz-border-radius: 5px;
            border-radius: 5px;
}
.header-area .ubermenu ul li.ubermenu-item ul.ubermenu-submenu li.ubermenu-item > a {
	-webkit-border-radius: 2px;
	   -moz-border-radius: 2px;
	        border-radius: 2px;
}
.header-area .ubermenu ul li.ubermenu-item ul.ubermenu-submenu {
	padding: 12px 0;
}
.ubermenu ul.ubermenu-nav a {
	color: #FFF;	
}
.header-area .ubermenu ul li.ubermenu-item ul.ubermenu-submenu li.ubermenu-item > a {
	display: block;
	padding: 7px 13px;
	height: 1%;
	cursor: pointer;
}
.ubermenu ul.ubermenu-nav > li.ubermenu-item.tt-uber-parent:hover {
	-webkit-border-radius: 5px 5px 0px 0px;
	   -moz-border-radius: 5px 5px 0px 0px;
	        border-radius: 5px 5px 0px 0px;
}
';
array_push($css_array,$ubermenu_css_code);	
}

//if true, hide uber mobile menu
if('true' == $ubermenu_karma_mobile ){
$ubermenu_css_mobile_code = '
@media only screen and (max-width:767px) {

.ubermenu,
#tt-mobile-menu-wrap .megaMenu img,
#tt-mobile-menu-wrap .megaMenu .wpmega-item-description {
	display: none !important;
}

#tt-mobile-menu-wrap .megaMenu ul.sub-menu {
	display: block !important;
}

	
}
';
array_push($css_array,$ubermenu_css_mobile_code);	
}

//if false, hide karma mobile menu
if(('false' == $ubermenu_karma_mobile) && ('true' == $ubermenu)){
$ubermenu_css_mobile_2_code = '
#tt-mobile-menu-button {display: none !important;}	
';
array_push($css_array,$ubermenu_css_mobile_2_code);	
}


/*--------------------------------------------------------------------*/
/* Theme Designer */
/*--------------------------------------------------------------------*/

//content area - custom bg color
$main_custom_color_css_code = '
#main, #footer-top, .content-custom-bg .heading-horizontal span {background-color:'.$div_main_custom_color.';}.tools .breadcrumb .current_crumb:after { color: '.$div_main_custom_color.';}';
truethemes_push_custom_css($div_main_custom_color,$main_custom_color_css_code);

//content area - custom bg color - separator lines
$content_separator_css_code = '
.callout-wrap,
.post_footer {
	border-top: 1px solid '.$content_separator_light.';
	border-bottom: 1px solid '.$content_separator_light.';
}
.heading-horizontal:before {
	border-top: 1px solid '.$content_separator_dark.';
	border-bottom: 1px solid '.$content_separator_light.';
}
.hr,
.hr_top_link {
	border-top: 1px solid '.$content_separator_light.';
}
.callout-wrap:before,
.post_footer:before,
.hr:before,
.hr_top_link:before {
   border-top: 1px solid '.$content_separator_dark.';
}
.callout-wrap:after,
.post_footer:after,
#horizontal_nav:after,
.member-wrap:after {
   border-bottom: 1px solid '.$content_separator_dark.';
}
#horizontal_nav,
.sidebar-widget,
#sub_nav ul a,
.member-wrap {
	border-bottom: 1px solid '.$content_separator_light.';
}
#sidebar {
	border-left: 1px solid '.$content_separator_dark.';
}
#sidebar:before {
   border-left: 1px solid '.$content_separator_light.';
}
#sidebar.left_sidebar {
	border-right: 1px solid '.$content_separator_light.';
}
#sidebar.left_sidebar:after {
   border-right: 1px solid '.$content_separator_dark.';
}
#sidebar.left_sidebar,
#sidebar.left_sidebar:before {
	border-left: none;	
}
.sidebar-widget:after,
#sub_nav ul a:after {
   border-bottom: 1px solid '.$content_separator_dark.';
}
#sub_nav ul a:hover,
#sub_nav ul a:hover:after {
	border-color: transparent;
}';
truethemes_push_custom_css($content_separator_light,$content_separator_css_code);	

//header - transparent overlay - custom upload
if('' != $header_transparent_overlay_upload) {
$header_transparent_overlay_upload_code = '
.header-overlay {
	background: url('.$header_transparent_overlay_upload.') 50% 50% no-repeat;
}';
array_push($css_array,$header_transparent_overlay_upload_code);
}

//header - transparent overlay
if ('overlay-none' != $header_transparent_overlay) {
$header_transparent_overlay_code = '
.header-overlay {
	background: url('.get_template_directory_uri().'/images/_global/'.$header_transparent_overlay.') 50% 50% no-repeat;
}';
array_push($css_array,$header_transparent_overlay_code);
}

//header - transparent overlay - custom "overlay-rays.png" settings
if('overlay-rays.png' == $header_transparent_overlay) {
$header_transparent_overlay_code_rays = '
.header-overlay {
	background-size: auto 100%;
}';
array_push($css_array,$header_transparent_overlay_code_rays);
}

//header - height adjust
if(!empty($header_height_adjust)) {
$header_height_adjust_code = '
#header .header-area {
	padding: '.$header_height_adjust.' 0;
}';
array_push($css_array,$header_height_adjust_code);
}
/*-------------------------------------------------------------- 
header shadow
--------------------------------------------------------------*/
//header - shadow style
if(('no-shadow' != $header_shadow_style) && ('shadow-1.png' != $header_shadow_style)){
$header_shadow_style_code = '
div.karma-header-shadow {
	background: url('.get_template_directory_uri().'/images/_global/'.$header_shadow_style.') no-repeat scroll center top;
}';
array_push($css_array,$header_shadow_style_code);
}
//header - shadow style - custom background repeat for shadow-1.png
if('shadow-1.png' == $header_shadow_style){
$header_shadow_style_code = '
div.karma-header-shadow {
	background: url('.get_template_directory_uri().'/images/_global/'.$header_shadow_style.') repeat-x scroll center top;
}';
array_push($css_array,$header_shadow_style_code);
}
/*-------------------------------------------------------------- 
footer shadow
--------------------------------------------------------------*/
//header - shadow style
if(('no-shadow' != $footer_shadow_style) && ('shadow-1.png' != $footer_shadow_style)){
$footer_shadow_style_code = '
div.karma-footer-shadow {
	background: url('.get_template_directory_uri().'/images/_global/'.$footer_shadow_style.') no-repeat scroll center top;
}';
array_push($css_array,$footer_shadow_style_code);
}
//header - shadow style - custom background repeat for shadow-1.png
if('shadow-1.png' == $footer_shadow_style){
$footer_shadow_style_code = '
div.karma-footer-shadow {
	background: url('.get_template_directory_uri().'/images/_global/'.$footer_shadow_style.') repeat-x scroll center top;
}';
array_push($css_array,$footer_shadow_style_code);
}



//-----
//-----boxed layout settings
//-----

//boxed layout - drop shadow
if('true' == $boxedlayout  ){
$custom_boxedlayout_shadow_code = '
#tt-boxed-layout {
-moz-box-shadow: 0 0 20px 0 rgba(0, 0, 0, '.$boxedlayout_shadow.');
-webkit-box-shadow: 0 0 20px 0 rgba(0, 0, 0, '.$boxedlayout_shadow.');
box-shadow: 0 0 20px 0 rgba(0, 0, 0, '.$boxedlayout_shadow.');
}';
truethemes_push_custom_css($boxedlayout_shadow,$custom_boxedlayout_shadow_code);
}

//boxed layout - body bg color
if('' != $body_bg_color ){
$custom_body_bg_code = 'body{background-color:'.$body_bg_color.' !important;}';
truethemes_push_custom_css($body_bg_color,$custom_body_bg_code);
}

//boxed layout - body bg image
if($body_bg_image_select!='null'){	
$custom_body_image_select_code = 'body{background-image:url('.get_template_directory_uri().'/images/body-backgrounds/'.$body_bg_image_select.'.png) !important;background-position:'.$body_designer_page_background_position.' !important;background-repeat:'.$body_designer_page_background_repeat.' !important;}';
truethemes_push_custom_css($body_bg_image_select,$custom_body_image_select_code);
}

//boxed layout - body bg image - custom upload	
$custom_body_image_code = 'body{background-image:url('.$body_bg_image.') !important;background-repeat:repeat !important;background-position:'.$body_designer_page_background_position.' !important;background-repeat:'.$body_designer_page_background_repeat.' !important;}';
truethemes_push_custom_css($body_bg_image,$custom_body_image_code);

//boxed layout - body bg image - fixed position
if('true' == $body_designer_page_background_fixed){	
$custom_body_designer_page_background_fixed_code = 'body{background-attachment:fixed;}';
truethemes_push_custom_css($body_designer_page_background_fixed,$custom_body_designer_page_background_fixed_code);
}

//jquery3 - transparent overlay
if ('overlay-none' != $jquery3_transparent_overlay) {
$jquery3_transparent_overlay_code = '
#tt-slider-full-width {
	background-image: url('.get_template_directory_uri().'/images/_global/'.$jquery3_transparent_overlay.');
	background-position: 50% 50%;
	background-repeat: no-repeat;
}';
array_push($css_array,$jquery3_transparent_overlay_code);
}


/*--------------------------------------------------------------------*/
/* Typography */
/*--------------------------------------------------------------------*/
//font-kit-modern
if('true' == $font_kit_modern){
$font_kit_modern_code = '
body,
.testimonials blockquote,
.testimonials_static blockquote {
	font-family: \'Open Sans\', Arial, sans-serif;
}
#tt-parallax-banner h1,
#tt-parallax-banner h2,
#tt-parallax-banner h3,
#tt-parallax-banner h4,
#tt-parallax-banner h5,
#tt-parallax-banner h6 {
	font-family: \'Open Sans\', Arial, sans-serif;
	font-weight: 600;
}
#tt-parallax-banner h1,
#tt-parallax-banner h2,
#tt-parallax-banner h3 {
	font-size: 28px;
}
h1, h2, h3, h4, h5, #footer h3, #menu-main-nav li strong, .ubermenu ul.ubermenu-nav > li.ubermenu-item > a span.ubermenu-target-title, p.footer-callout-heading, #tt-mobile-menu-button span , .post_date .day, .karma_mega_div span.karma-mega-title {font-family: \'Lato\', Arial, sans-serif;}
h1, h2, h3, h4, h5, h6 {margin-bottom:12px;}
h2.entry-title {margin-bottom:20px;}
p {line-height: 2;margin-bottom:20px;font-size: 13px;}
#content ol li,
#content ul li,
.content_full_width ol li,
.content_full_width ul li {font-size: 13px;}
#content p.callout2 span {font-size: 15px;}
.callout2,
.callout-wrap span {line-height:1.8;}
.slider-content-main p {font-size:1em;line-height:2;margin-bottom: 14px;}
.jquery3-slider-wrap .slider-content-main p {font-size:1.1em;line-height:1.8em;}
.callout-wrap span, .portfolio_content h3 {font-size: 1.4em;}
.testimonials blockquote, .testimonials_static blockquote, p.team-member-title {font-size: 13px;font-style: normal;}
.ka_button, .ka_button:hover {letter-spacing: 0.6px;}
#footer h3, #menu-main-nav li strong, .ubermenu ul.ubermenu-nav > li.ubermenu-item > a span.ubermenu-target-title {letter-spacing: 0.7px;font-size:12.4px;}
#footer h3 {font-weight: 300;}
#footer p.footer-callout-heading {font-size: 18px;}
#footer .blogroll a,
#footer ul.tt-recent-posts h4 {
	font-weight: normal;
	color:rgba(255,255,255,0.8);
}
#footer ul.tt-recent-posts h4,
#sidebar ul.tt-recent-posts h4 {
	font-size: 13px !important;	
}
.tools .breadcrumb .current_crumb:after, .woocommerce-page .tt-woocommerce .breadcrumb span:last-child:after {bottom: -16px;}
.post_title span {font-weight: normal;}
.post_date .day {font-size:28px;font-weight:normal;}
.post_date .month {font-size: 15px;margin-top:-15px;}
.tools .search-form {margin-top: 1px;}
.accordion .opener strong {font-weight: normal;}
.tools .breadcrumb a:after {top:0;}
p.comment-author-about {font-weight: bold;}
';
array_push($css_array,$font_kit_modern_code);	
}

//font-kit-serif
if('true' == $font_kit_serif){
$font_kit_serif_code = '
html {font-size: 70%;}
p {line-height: 24px;margin-bottom:21px;}
p,ul,ol,.callout-wrap span, div.comment-text, label, .ka_button, .ka_button:hover, #tt-mobile-menu-button span {font-family: \'Source Sans Pro\', Arial, sans-serif;}
h1, h2, h3, h4, h5, h6, #footer h3, #menu-main-nav li strong, .ubermenu ul.ubermenu-nav > li.ubermenu-item > a span.ubermenu-target-title, p.footer-callout-heading, #footer ul.tt-recent-posts h4, .karma_mega_div span.karma-mega-title {font-family: \'PT Serif\', Georgia, serif;}
h1 {margin-bottom:29px;}
h3, h4 {margin-bottom:25px;}
#tt-parallax-banner h1,
#tt-parallax-banner h2,
#tt-parallax-banner h3 {
	font-size: 28px;
}
.testimonials blockquote, .testimonials_static blockquote, p.team-member-title {font-size: 13px;font-style: normal;}
.callout-wrap span {font-size: 1.3em;}
#content p.callout2 span {font-size: 16px;}
.slider-content-main p {font-size: 1em;}
.slider-content-main h2 {font-size: 1.8em;}
#footer h3, #menu-main-nav li strong, .ubermenu ul.ubermenu-nav > li.ubermenu-item > a span.ubermenu-target-title  {font-weight: normal;}
#footer p.footer-callout-heading {font-size: 16px;}
#main .tools h1 {font-size: 18px;} 
.tools .breadcrumb .current_crumb:after, .woocommerce-page .tt-woocommerce .breadcrumb span:last-child:after {bottom: -9px;}
.post_title span {font-weight: normal;}
.tools .search-form {margin-top: 1px;}
';
array_push($css_array,$font_kit_serif_code);	
}

//font-kit-organic
if('true' == $font_kit_organic){
$font_kit_organic_code = '
p,ul,ol,.callout-wrap span, div.comment-text, label, .post_date .month, .post_comments, #footer ul.tt-recent-posts h4 {font-family: \'Open Sans\', Arial, sans-serif;}
h1, h2, h3, h4, h5, h6 #footer h3, #menu-main-nav li strong, .ubermenu ul.ubermenu-nav > li.ubermenu-item > a span.ubermenu-target-title, p.footer-callout-heading, .ka_button, .ka_button:hover, #tt-mobile-menu-button span, .post_date .day, .karma_mega_div span.karma-mega-title {font-family: \'Varela Round\', Arial, sans-serif;}
#tt-parallax-banner h1,
#tt-parallax-banner h2,
#tt-parallax-banner h3 {
	font-size: 28px;
}
p {line-height:23px;}
.callout-wrap span {font-size: 1.4em;}
#content p.callout2 span {font-size: 16px;}
.testimonials blockquote, .testimonials_static blockquote, p.team-member-title {font-size: 13px;font-style: normal;}
.ka_button, .ka_button:hover {letter-spacing: 0px;}
#footer h3, #menu-main-nav li strong, .ubermenu ul.ubermenu-nav > li.ubermenu-item > a span.ubermenu-target-title {font-weight: normal;letter-spacing: 0.7px;font-size:12.4px;}
#footer h3 {font-size: 14px;text-transform:none;}
#footer p.footer-callout-heading {font-size: 16px;}
#footer .blogroll a,
#footer ul.tt-recent-posts h4 {font-weight: normal;}
.tools .breadcrumb .current_crumb:after, .woocommerce-page .tt-woocommerce .breadcrumb span:last-child:after {bottom: -8px;}
.post_title span {font-weight: normal;}
.post_date .day {font-size:28px;font-weight:normal;}
.post_date .month {font-size: 15px;margin-top:-15px;}
.tools .search-form {margin-top: 1px;}
';
array_push($css_array,$font_kit_organic_code);	
}

//grab custom font settings
//color
$custom_logo_font_color      = $ttso->ka_custom_logo_font_color;
$side_navigation_color       = $ttso->ka_side_menu_font_color;
$h1_color                    = $ttso->ka_h1_font_color;
$h2_color                    = $ttso->ka_h2_font_color;
$h3_color                    = $ttso->ka_h3_font_color;
$h4_color                    = $ttso->ka_h4_font_color;
$h5_color                    = $ttso->ka_h5_font_color;
$h6_color                    = $ttso->ka_h6_font_color;
$main_content_font_color     = $ttso->ka_main_content_font_color;
$footer_content_font_color   = $ttso->ka_footer_content_font_color;
$link_font_color             = $ttso->ka_link_font_color;
$link_hover_font_color       = $ttso->ka_link_hover_font_color;
//size
$custom_logo_font_size       = $ttso->ka_custom_logo_font_size;
$main_content_font_size      = $ttso->ka_main_content_font_size;
$main_menu_font_size         = $ttso->ka_main_menu_font_size;
$side_menu_font_size         = $ttso->ka_side_menu_font_size;
$h1_font_size                = $ttso->ka_h1_font_size;
$h2_font_size                = $ttso->ka_h2_font_size;
$h3_font_size                = $ttso->ka_h3_font_size;
$h4_font_size                = $ttso->ka_h4_font_size;
$h5_font_size                = $ttso->ka_h5_font_size;
$h6_font_size                = $ttso->ka_h6_font_size;
$footer_content_font_size    = $ttso->ka_footer_content_font_size;
//font-family
$custom_logo_font            = $ttso->ka_custom_logo_font;
$main_content_font           = $ttso->ka_main_content_font;
$main_navigation_font        = $ttso->ka_main_navigation_font;
$side_navigation_font        = $ttso->ka_sidebar_menu_font;
$h1_font                     = $ttso->ka_h1_font;
$h2_font                     = $ttso->ka_h2_font;
$h3_font                     = $ttso->ka_h3_font;
$h4_font                     = $ttso->ka_h4_font;
$h5_font                     = $ttso->ka_h5_font;
$h6_font                     = $ttso->ka_h6_font;
$footer_content_font         = $ttso->ka_footer_content_font;

//custom logo font color
$custom_logo_font_color_code = '.logo-text{color:'.$custom_logo_font_color.'!important;}';
truethemes_push_custom_css($custom_logo_font_color,$custom_logo_font_color_code);

//side_navigation_color
$side_navigation_color_code = '#sub_nav .sub-menu li a span{color:'.$side_navigation_color.'!important;}';	
truethemes_push_custom_css($side_navigation_color,$side_navigation_color_code);	

//Headers color
$h1_color_code = 'h1{color:'.$h1_color.'!important;}';	
truethemes_push_custom_css($h1_color,$h1_color_code);

$h2_color_code = 'h2{color:'.$h2_color.'!important;}';	
truethemes_push_custom_css($h2_color,$h2_color_code);

$h3_color_code = 'h3{color:'.$h3_color.'!important;}';	
truethemes_push_custom_css($h3_color,$h3_color_code);

$h4_color_code = 'h4{color:'.$h4_color.'!important;}';	
truethemes_push_custom_css($h4_color,$h4_color_code);	

$h5_color_code = 'h5{color:'.$h5_color.'!important;}';	
truethemes_push_custom_css($h5_color,$h5_color_code);

$h6_color_code = 'h6{color:'.$h6_color.'!important;}';	
truethemes_push_custom_css($h6_color,$h6_color_code);

//main_content_font_color
$main_content_font_code = '#content p, .content_full_width p, .slider-content-main p, .contact-form label, #content ol li, #content ul li, .content_full_width ol li, .content_full_width ul li, em{color:'.$main_content_font_color.'!important;}
#content .colored_box p, .content_full_width .colored_box p {color: #FFF !important;}';	
truethemes_push_custom_css($main_content_font_color,$main_content_font_code);	

//footer_content_font_color
$footer_content_font_code = '#footer, #footer ul li a, #footer ul li, #footer h3{color:'.$footer_content_font_color.'!important;}';	
truethemes_push_custom_css($footer_content_font_color,$footer_content_font_code);	

//link_font_color
$link_font_code = 'a{color:'.$link_font_color.'!important;}';	
truethemes_push_custom_css($link_font_color,$link_font_code);

//link_hover_font_color
$link_hover_font_code = 'a:hover{color:'.$link_hover_font_color.'!important;}';	
truethemes_push_custom_css($link_hover_font_color,$link_hover_font_code);

//custom logo font size
$custom_logo_font_code = '.logo-text{font-size:'.$custom_logo_font_size.'!important;}';
truethemes_push_custom_css($custom_logo_font_size,$custom_logo_font_code);

//main content font size
$main_content_font_size_code = '#main{font-size:'.$main_content_font_size.'!important;}';
truethemes_push_custom_css($main_content_font_size,$main_content_font_size_code);	

//main navigation font size
$main_menu_font_size_code = '#menu-main-nav, #menu-main-nav li a span strong{font-size:'.$main_menu_font_size.'!important;}';
truethemes_push_custom_css($main_menu_font_size,$main_menu_font_size_code);

//side navigation font size
$side_menu_font_size_code = '#sub_nav{font-size:'.$side_menu_font_size.'!important;}';
truethemes_push_custom_css($side_menu_font_size,$side_menu_font_size_code);

//Header's font size
$h1_font_size_code = 'h1{font-size:'.$h1_font_size.'!important;}';
truethemes_push_custom_css($h1_font_size,$h1_font_size_code);

$h2_font_size_code = 'h2{font-size:'.$h2_font_size.'!important;}';
truethemes_push_custom_css($h2_font_size,$h2_font_size_code);

$h3_font_size_code = 'h3{font-size:'.$h3_font_size.'!important;}';
truethemes_push_custom_css($h3_font_size,$h3_font_size_code);

$h4_font_size_code = 'h4{font-size:'.$h4_font_size.'!important;}';
truethemes_push_custom_css($h4_font_size,$h4_font_size_code);

$h5_font_size_code = 'h5{font-size:'.$h5_font_size.'!important;}';
truethemes_push_custom_css($h5_font_size,$h5_font_size_code);	

$h6_font_size_code = 'h6{font-size:'.$h6_font_size.'!important;}';
truethemes_push_custom_css($h6_font_size,$h6_font_size_code);

$footer_content_font_size_code = '#footer{font-size:'.$footer_content_font_size.'!important;}';
truethemes_push_custom_css($footer_content_font_size,$footer_content_font_size_code);

//custom logo font type
$custom_logo_font_code = '.logo-text {font-family:\''.$custom_logo_font.'\', Arial, sans-serif;}'."\n";	
truethemes_push_custom_font($custom_logo_font,$custom_logo_font_code);	

//main_content_font
$main_content_font_code = '#main{font-family:\''.$main_content_font.'\', Arial, sans-serif;}'."\n";		
truethemes_push_custom_font($main_content_font,$main_content_font_code);	

//main navigation font type
$main_navigation_font_code = '#menu-main-nav{font-family:\''.$main_navigation_font.'\', Arial, sans-serif;}'."\n";		
truethemes_push_custom_font($main_navigation_font,$main_navigation_font_code);

//side navigation font type
$side_navigation_font_code = '#sub_nav{font-family:\''.$side_navigation_font.'\', Arial, sans-serif;}'."\n";		
truethemes_push_custom_font($side_navigation_font,$side_navigation_font_code);

//Header's font type
$h1_font_code = 'h1{font-family:\''.$h1_font.'\', Arial, sans-serif;}'."\n";	
truethemes_push_custom_font($h1_font,$h1_font_code);		

$h2_font_code = 'h2{font-family:\''.$h2_font.'\', Arial, sans-serif;}'."\n";	
truethemes_push_custom_font($h2_font,$h2_font_code);		

$h3_font_code = 'h3{font-family:\''.$h3_font.'\', Arial, sans-serif;}'."\n";	
truethemes_push_custom_font($h3_font,$h3_font_code);	

$h4_font_code = 'h4{font-family:\''.$h4_font.'\', Arial, sans-serif;}'."\n";	
truethemes_push_custom_font($h4_font,$h4_font_code);		

$h5_font_code = 'h5{font-family:\''.$h5_font.'\', Arial, sans-serif;}'."\n";	
truethemes_push_custom_font($h5_font,$h5_font_code);		

$h6_font_code = 'h6{font-family:\''.$h6_font.'\', Arial, sans-serif;}'."\n";	
truethemes_push_custom_font($h6_font,$h6_font_code);		

$footer_content_font_code = '#footer{font-family:\''.$footer_content_font.'\', Arial, sans-serif;}'."\n";	
truethemes_push_custom_font($footer_content_font,$footer_content_font_code);

/**
 *
 * Color Scheme Customization
 *
 * @since Karma 4.6
 */
/*--------------------------------------------------------------
Top Toolbar
--------------------------------------------------------------*/
$color_customize_top_toolbar = '
.top-block,
.top-block ul.sf-menu li ul,
#tt-slider-full-width,
body.karma-header-custom .top-block,
body.karma-header-custom .top-block ul.sf-menu li ul {
	background: '.$custom_scheme_primary_toolbar.';
}';	
truethemes_push_custom_css($custom_scheme_primary_toolbar,$color_customize_top_toolbar);

$design_top_toolbar_link_code = '
.top-block .toolbar-left a,
.top-block .toolbar-right a {color: '.$design_top_toolbar_link.';}';	
truethemes_push_custom_css($design_top_toolbar_link,$design_top_toolbar_link_code);

$design_top_toolbar_link_hover_code = '
.top-block .toolbar-left a:hover,
.top-block .toolbar-right a:hover,
.top-block .toolbar-left li.sfHover a,
.top-block .toolbar-right li.sfHover a {color: '.$design_top_toolbar_link_hover.' !important;}';	
truethemes_push_custom_css($design_top_toolbar_link_hover,$design_top_toolbar_link_hover_code);

$design_top_toolbar_dropdown_menu_code = '
.top-block ul.sf-menu li ul {background: '.$design_top_toolbar_dropdown_menu.';}';	
truethemes_push_custom_css($design_top_toolbar_dropdown_menu,$design_top_toolbar_dropdown_menu_code);

$design_top_toolbar_dropdown_menu_linkbg_hover_code = '
.top-block .top-holder ul.sf-menu li .sub-menu li a:hover {background: '.$design_top_toolbar_dropdown_menu_linkbg_hover.' !important;}';	
truethemes_push_custom_css($design_top_toolbar_dropdown_menu_linkbg_hover,$design_top_toolbar_dropdown_menu_linkbg_hover_code);
/*--------------------------------------------------------------
Header
--------------------------------------------------------------*/
/*
$old_custom_primary   = old karma checkbox to activate primary color scheme                            
$old_custom_secondary = old karma checkbox to activate secondary color scheme

if set, user has checked the
$old_custom_primary box, we apply those colors
to both header and footer
*/
if ('true' == $old_custom_primary) {

	$color_customize_old_header_footer = '
	.header-holder,
	body.karma-flat-cs .header-holder,
	body.karma-flat-cs .header-holder.tt-header-holder-tall,
	.header-holder.tt-header-holder-tall,
	#footer,
	body.karma-flat-cs #footer {
	border-top: 1px solid '.$custom_scheme_primary_border_top.';
	background-color: '.$custom_scheme_primary_gradient_dark.';
	background-image: linear-gradient(to bottom, '.$custom_scheme_primary_gradient_light.', '.$custom_scheme_primary_gradient_dark.');
	background-image: -webkit-gradient(linear, left top, left bottom, from('.$custom_scheme_primary_gradient_light.'), to('.$custom_scheme_primary_gradient_dark.'));
	background-image: -webkit-linear-gradient(top, '.$custom_scheme_primary_gradient_light.', '.$custom_scheme_primary_gradient_dark.');
	background-image: -moz-linear-gradient(top, '.$custom_scheme_primary_gradient_light.', '.$custom_scheme_primary_gradient_dark.');
	background-image: -webkit-linear-gradient(top, '.$custom_scheme_primary_gradient_light.', '.$custom_scheme_primary_gradient_dark.');
	background-image: -o-linear-gradient(top, '.$custom_scheme_primary_gradient_light.', '.$custom_scheme_primary_gradient_dark.');
	background-image: ms-linear-gradient(to bottom, '.$custom_scheme_primary_gradient_light.', '.$custom_scheme_primary_gradient_dark.');
	-pie-background: linear-gradient(to bottom, '.$custom_scheme_primary_gradient_light.', '.$custom_scheme_primary_gradient_dark.');
	}';	
	truethemes_push_custom_css($custom_scheme_primary_gradient_light,$color_customize_old_header_footer);

} else { //apply only to header

	$color_customize_old_header_footer = '
	.header-holder,
	body.karma-flat-cs .header-holder,
	body.karma-flat-cs .header-holder.tt-header-holder-tall,
	.header-holder.tt-header-holder-tall {
	border-top: 1px solid '.$custom_scheme_primary_border_top.';
	background-color: '.$custom_scheme_primary_gradient_dark.';
	background-image: linear-gradient(to bottom, '.$custom_scheme_primary_gradient_light.', '.$custom_scheme_primary_gradient_dark.');
	background-image: -webkit-gradient(linear, left top, left bottom, from('.$custom_scheme_primary_gradient_light.'), to('.$custom_scheme_primary_gradient_dark.'));
	background-image: -webkit-linear-gradient(top, '.$custom_scheme_primary_gradient_light.', '.$custom_scheme_primary_gradient_dark.');
	background-image: -moz-linear-gradient(top, '.$custom_scheme_primary_gradient_light.', '.$custom_scheme_primary_gradient_dark.');
	background-image: -webkit-linear-gradient(top, '.$custom_scheme_primary_gradient_light.', '.$custom_scheme_primary_gradient_dark.');
	background-image: -o-linear-gradient(top, '.$custom_scheme_primary_gradient_light.', '.$custom_scheme_primary_gradient_dark.');
	background-image: ms-linear-gradient(to bottom, '.$custom_scheme_primary_gradient_light.', '.$custom_scheme_primary_gradient_dark.');
	-pie-background: linear-gradient(to bottom, '.$custom_scheme_primary_gradient_light.', '.$custom_scheme_primary_gradient_dark.');
	}';	
	truethemes_push_custom_css($custom_scheme_primary_gradient_light,$color_customize_old_header_footer);

} //end_if $old_custom_primary

//header flat bg
$design_header_flat_code = '
.header-holder,
body.karma-flat-cs .header-holder,
body.karma-flat-cs .header-holder.tt-header-holder-tall,
.header-holder.tt-header-holder-tall {
background-color: '.$design_header_flat.';
background-image: none;
}';	
truethemes_push_custom_css($design_header_flat,$design_header_flat_code);

//header top border
$custom_scheme_primary_border_top_code = '
.header-holder,
body.karma-flat-cs .header-holder {
border-top: 1px solid '.$custom_scheme_primary_border_top.';
}';	
truethemes_push_custom_css($custom_scheme_primary_border_top,$custom_scheme_primary_border_top_code);

//header bottom border
$design_header_border_bottom_code = '
.header-holder,
body.karma-flat-cs .header-holder {
border-bottom: 1px solid '.$design_header_border_bottom.';
}';	
truethemes_push_custom_css($design_header_border_bottom,$design_header_border_bottom_code);

/*--------------------------------------------------------------
Mobile Menu Stack (vector icon)
--------------------------------------------------------------*/
$color_customize_mobile_stack = '
#tt-mobile-menu-button span:after,
.tt-icon-box span.fa-stack {
	color: '.$custom_scheme_primary_gradient_light.';
}';	
truethemes_push_custom_css($custom_scheme_primary_gradient_light,$color_customize_mobile_stack);

/*-------------------------------------------------------------- 
Header Menu
--------------------------------------------------------------*/
$color_customize_dropdown_menu = '
#menu-main-nav a span.navi-description,
.search-header #menu-main-nav li.current_page_parent a span.navi-description,
.error-header #menu-main-nav li.current_page_parent a span.navi-description,
.top-block .top-holder ul.sf-menu li .sub-menu li a:hover {
	color: rgba(255,255,255, 0.4);
}

/* dropdown menu bg color */
#menu-main-nav.sf-menu li ul,
#menu-main-nav li.parent:hover,
body.karma-header-light #menu-main-nav.sf-menu li ul,
body.karma-header-light #menu-main-nav li.parent:hover,
.tt-logo-center #menu-main-nav li.parent:first-child:hover,
#wrapper.tt-uberstyling-enabled .ubermenu ul.ubermenu-nav > li.ubermenu-item.tt-uber-parent:hover,
#wrapper.tt-uberstyling-enabled .ubermenu ul.ubermenu-nav li.ubermenu-item ul.ubermenu-submenu {
	background: '.$custom_scheme_primary_menu_dropdown_bg.';
}

/* dropdown link:hover bg color */
#menu-main-nav li ul a:hover,
#menu-main-nav li ul li.current-menu-item.hover a,
#menu-main-nav li ul li.parent.hover a,
#menu-main-nav li ul li.parent.hover a:hover,
#menu-main-nav li ul li.hover ul li.hover a,
#menu-main-nav li ul li.hover ul li.hover a:hover,
#menu-main-nav li ul li.current-menu-ancestor.hover a,
#menu-main-nav li ul li.current-menu-ancestor.hover ul a:hover,
#menu-main-nav li ul li.current-menu-ancestor ul li.current-menu-ancestor ul li.current-menu-item a:hover,
#wrapper.tt-uberstyling-enabled .header-area .ubermenu ul li.ubermenu-item ul.ubermenu-submenu li.ubermenu-item > a:hover {
	background: '.$custom_scheme_primary_menu_dropdown_linkhover_bg.' !important;
	color:#FFF;
}

/* reset dropdown link:hover on non-active items */
#menu-main-nav li ul li.parent.hover ul a,
#menu-main-nav li ul li.hover ul li.hover ul li a,
#menu-main-nav li ul li.current-menu-ancestor.hover ul a {
	background:none;	
}';	truethemes_push_custom_css($custom_scheme_primary_menu_dropdown_bg,$color_customize_dropdown_menu);

/* @since 4.6 */
//top-level link
$design_header_menu_link_code = '
#menu-main-nav li strong,
ul#menu-main-nav li.menu-item-has-children a::after,
ul#menu-main-nav li.menu-item-has-children strong::after {
	color: '.$design_header_menu_link.';
}';
truethemes_push_custom_css($design_header_menu_link,$design_header_menu_link_code);

//top-level link hover
$design_header_menu_link_hover_code = '
#menu-main-nav li:hover strong,
ul#menu-main-nav li.menu-item-has-children:hover a::after,
ul#menu-main-nav li.menu-item-has-children:hover strong::after {
	color: '.$design_header_menu_link_hover.';
}';
truethemes_push_custom_css($design_header_menu_link_hover,$design_header_menu_link_hover_code);

//link description
$design_header_menu_link_description_code = '
#menu-main-nav a span.navi-description,
.search-header #menu-main-nav li.current_page_parent a span.navi-description,
.error-header #menu-main-nav li.current_page_parent a span.navi-description {
	color: '.$design_header_menu_link_description.' !important;
}';
truethemes_push_custom_css($design_header_menu_link_description,$design_header_menu_link_description_code);

//dropdown menu link color
$design_header_menu_dropdown_link_code = '
#menu-main-nav .sub-menu a,
#menu-main-nav li ul li.current-menu-item a,
#menu-main-nav .sub-menu li.current-menu-item ul li a,
#menu-main-nav .sub-menu li.current-menu-ancestor ul li.current-menu-item ul li a,
#menu-main-nav li ul li.current-menu-parent ul li.current-menu-item a,
#menu-main-nav .sub-menu li.parent a::after,
#menu-main-nav .sub-menu li.parent .sub-menu li.parent a::after {
	color: '.$design_header_menu_dropdown_link.' !important;
}';
truethemes_push_custom_css($design_header_menu_dropdown_link,$design_header_menu_dropdown_link_code);

//dropdown menu link hover color
$design_header_menu_dropdown_linkhover_code = '
#menu-main-nav.sf-menu li .sub-menu li a:hover,
#menu-main-nav .sub-menu li.parent a:hover:after,
#menu-main-nav .sub-menu li.parent .sub-menu li.parent a:hover:after {
	color: '.$design_header_menu_dropdown_linkhover.' !important;
}';
truethemes_push_custom_css($design_header_menu_dropdown_linkhover,$design_header_menu_dropdown_linkhover_code);

//dropdown menu current page link color
$design_header_menu_dropdown_currentlink_code = '
#menu-main-nav li ul li.current-menu-item a,
#menu-main-nav li ul li.current-menu-ancestor a,
#menu-main-nav li ul li.current-menu-parent ul li.current-menu-item a,
#menu-main-nav li ul li.current-menu-ancestor ul li.current-menu-ancestor a,
#menu-main-nav li ul li.current-menu-ancestor ul li.current-menu-ancestor ul li.current-menu-item a {
	color: '.$design_header_menu_dropdown_currentlink.';
}';
truethemes_push_custom_css($design_header_menu_dropdown_currentlink,$design_header_menu_dropdown_currentlink_code);


/*-------------------------------------------------------------- 
Footer
--------------------------------------------------------------*/
$color_customize_footer = '
#footer_bottom,
body.karma-flat-cs #footer_bottom {
	background: '.$custom_scheme_primary_footer_bottom.' url('.$custom_scheme_image_footer_bottom.') top center repeat-x;
}
.footer-content a,
#footer_bottom a,
#footer .blogroll li,
#mc_signup .mc_required,
.mc_required,
#mc-indicates-required,
#footer ul.tt-recent-posts li p {
	color: rgba(255,255,255, 0.35);
}
#footer .blogroll a,
#footer ul.tt-recent-posts h4 {
	color: #FFF;
}
#footer h3 { border-bottom: 1px solid rgba(255,255,255, 0.2); }
#footer,
#footer p,
#footer ul,
#footer_bottom,
#footer_bottom p,
#footer_bottom ul,
#footer #mc_signup_form label {
	color: '.$custom_scheme_primary_footer_text.';
}';	
truethemes_push_custom_css($custom_scheme_primary_footer_bottom,$color_customize_footer);

//footer - transparent overlay - custom upload
if('' != $footer_transparent_overlay_upload) {
$footer_transparent_overlay_upload_code = '
.footer-overlay {
	background: url('.$footer_transparent_overlay_upload.') 50% 50% no-repeat;
}';
array_push($css_array,$footer_transparent_overlay_upload_code);
}

//footer - transparent overlay
if ('overlay-none' != $footer_transparent_overlay) {
$footer_transparent_overlay_code = '
.footer-overlay {
	background: url('.get_template_directory_uri().'/images/_global/'.$footer_transparent_overlay.') 50% 50% no-repeat;
}';
array_push($css_array,$footer_transparent_overlay_code);
}

//footer - transparent overlay - custom "overlay-rays.png" settings
if ('overlay-rays.png' == $footer_transparent_overlay) {
$footer_transparent_overlay_code_rays = '
.footer-overlay {
	background-size: auto 100%;
}';
array_push($css_array,$footer_transparent_overlay_code_rays);
}

//footer callout linkhover bg
$footer_callout_linkhover_code = '
#footer #footer-callout-content a.footer-callout-link:hover {
	background:'.$footer_callout_linkhover.'
}';
truethemes_push_custom_css($footer_callout_linkhover,$footer_callout_linkhover_code);

//footer callout bg
$footer_callout_main_bg_code = '
#footer-callout {
	background:'.$footer_callout_main_bg.'
}';
truethemes_push_custom_css($footer_callout_main_bg,$footer_callout_main_bg_code);

//footer gradient bg
$design_footer_gradient_code = '
#footer,
body.karma-flat-cs #footer {
background-color: '.$design_footer_gradient_bottom.';
background-image: linear-gradient(to bottom, '.$design_footer_gradient_top.', '.$design_footer_gradient_bottom.');
background-image: -webkit-gradient(linear, left top, left bottom, from('.$design_footer_gradient_top.'), to('.$design_footer_gradient_bottom.'));
background-image: -webkit-linear-gradient(top, '.$design_footer_gradient_top.', '.$design_footer_gradient_bottom.');
background-image: -moz-linear-gradient(top, '.$design_footer_gradient_top.', '.$design_footer_gradient_bottom.');
background-image: -webkit-linear-gradient(top, '.$design_footer_gradient_top.', '.$design_footer_gradient_bottom.');
background-image: -o-linear-gradient(top, '.$design_footer_gradient_top.', '.$design_footer_gradient_bottom.');
background-image: ms-linear-gradient(to bottom, '.$design_footer_gradient_top.', '.$design_footer_gradient_bottom.');
-pie-background: linear-gradient(to bottom, '.$design_footer_gradient_top.', '.$design_footer_gradient_bottom.');
}';	
truethemes_push_custom_css($design_footer_gradient_top,$design_footer_gradient_code);

//footer flat bg
$design_footer_flat_code = '
#footer,
body.karma-flat-cs #footer {
background-color: '.$design_footer_flat.';
background-image: none;
}';	
truethemes_push_custom_css($design_footer_flat,$design_footer_flat_code);

//footer bottom border
$design_footer_border_bottom_code = '
.footer-overlay {
border-bottom: 1px solid '.$design_footer_border_bottom.';
}';	
truethemes_push_custom_css($design_footer_border_bottom,$design_footer_border_bottom_code);

//footer top border
$design_footer_border_top_code = '
.footer-overlay {
border-top: 1px solid '.$design_footer_border_top.';
}
#footer-callout {
border-bottom: 0;
}';
truethemes_push_custom_css($design_footer_border_top,$design_footer_border_top_code);

//footer text
$custom_scheme_primary_footer_text_code = '
#footer,
#footer p,
#footer ul,
#footer_bottom,
#footer_bottom p,
#footer_bottom ul,
#footer #mc_signup_form label {
	color: '.$custom_scheme_primary_footer_text.';
}';
truethemes_push_custom_css($custom_scheme_primary_footer_text,$custom_scheme_primary_footer_text_code);

//footer link
$design_footer_link_code = '
.footer-content a {
	color: '.$design_footer_link.';
}';
truethemes_push_custom_css($design_footer_link,$design_footer_link_code);

//footer link hover
$design_footer_link_hover_code = '
.footer-content a:hover {
	color: '.$design_footer_link_hover.';
}
.footer-content ul.true-business-contact a::after,
#footer ul.social_icons.tt_vector_social_icons a::after,
.footer-content ul.true-business-contact a:hover::after,
#footer ul.social_icons.tt_vector_social_icons a:hover::after {
	color: rgba(255,255,255, 0.35);
}';
truethemes_push_custom_css($design_footer_link_hover,$design_footer_link_hover_code);

//footer bottom link
$design_footer_bottom_link_code = '
#footer_bottom a {
	color: '.$design_footer_bottom_link.';
}';
truethemes_push_custom_css($design_footer_bottom_link,$design_footer_bottom_link_code);

//footer bottom link hover
$design_footer_bottom_link_hover_code = '
#footer_bottom a:hover {
	color: '.$design_footer_bottom_link_hover.';
}';
truethemes_push_custom_css($design_footer_bottom_link_hover,$design_footer_bottom_link_hover_code);

//footer scroll top background
$design_footer_scroll_top_bg_code = '
.karma-scroll-top {
	background: '.$design_footer_scroll_top_bg.';
}';
truethemes_push_custom_css($design_footer_scroll_top_bg,$design_footer_scroll_top_bg_code);

//footer scroll top background hover
$design_footer_scroll_top_bg_hover_code = '
.karma-scroll-top:hover {
	background: '.$design_footer_scroll_top_bg_hover.';
}';
truethemes_push_custom_css($design_footer_scroll_top_bg_hover,$design_footer_scroll_top_bg_hover_code);




/* 
//header light - menu - top_level_links
if ('light' == $karma_header_style) {
	$karma_header_style_light_menulinks = '
	body.karma-header-light #menu-main-nav li strong,
	body.karma-header-light #menu-main-nav a {
		color: #444;
	}
	body.karma-header-light #menu-main-nav ul a {
		color: #808080;
	}';
array_push($css_array,$karma_header_style_light_menulinks);
}


//header light - menu - navi_description
if ('light' == $karma_header_style) {
	$karma_header_style_light_menudesc = '
	body.karma-header-light #menu-main-nav a span.navi-description,
	body.karma-header-light .search-header #menu-main-nav li.current_page_parent a span.navi-description,
	body.karma-header-light .error-header #menu-main-nav li.current_page_parent a span.navi-description {
		color: #808080;
	}';
array_push($css_array,$karma_header_style_light_menudesc);
}


//header light - menu - dropdown
if ('light' == $karma_header_style) {
	$karma_header_style_light_menudropdown = '
	body.karma-header-light #menu-main-nav.sf-menu li ul,
	body.karma-header-light #menu-main-nav li.parent:hover,
	body.karma-header-light .tt-logo-center #menu-main-nav li.parent:first-child:hover,
	body.karma-header-light #wrapper.tt-uberstyling-enabled .ubermenu ul.ubermenu-nav > li.ubermenu-item.tt-uber-parent:hover,
	body.karma-header-light #wrapper.tt-uberstyling-enabled .ubermenu ul.ubermenu-nav li.ubermenu-item ul.ubermenu-submenu {
		background: #fff;
		box-shadow: 0 6px 10px rgba(0, 0, 0, 0.25);
	}';
array_push($css_array,$karma_header_style_light_menudropdown);
}
*/

/*-------------------------------------------------------------- 
OLD - "Secondary Color Scheme"
--------------------------------------------------------------*/
/*
$old_custom_primary   = old karma checkbox to activate primary color scheme                            
$old_custom_secondary = old karma checkbox to activate secondary color scheme

if set, user has checked the
$old_custom_secondary box, we apply their selected colors
to page-title bar, post comments, and jQuery-1 slider bg
*/

if ('true' == $old_custom_secondary) {

$old_jquery_tools = '
.jquery1-slider-wrap,
.tools,
body.karma-flat-cs .jquery1-slider-wrap,
body.karma-flat-cs .tools {
background-color: '.$custom_scheme_secondary_gradient_light.';
background: -webkit-gradient(radial, center center, 0, center center, 460, from('.$custom_scheme_secondary_gradient_light.'), to('.$custom_scheme_secondary_gradient_dark.'));
background: -webkit-radial-gradient(circle, '.$custom_scheme_secondary_gradient_light.', '.$custom_scheme_secondary_gradient_dark.');
background: -moz-radial-gradient(circle, '.$custom_scheme_secondary_gradient_light.', '.$custom_scheme_secondary_gradient_dark.');
background: -ms-radial-gradient(circle, '.$custom_scheme_secondary_gradient_light.', '.$custom_scheme_secondary_gradient_dark.');
}
.jquery1-slider-wrap {
	-webkit-box-shadow: inset 0 0 7px rgba(0, 0, 0, 0.3);
       -moz-box-shadow: inset 0 0 7px rgba(0, 0, 0, 0.3);
            box-shadow: inset 0 0 7px rgba(0, 0, 0, 0.3);
}
.post_comments,
body.karma-flat-cs .post_comments {
	box-shadow: 0 0 0 1px '.$custom_scheme_secondary_gradient_light.', 0 0 0 2px '.$custom_scheme_secondary_gradient_dark.';
	background-color: '.$custom_scheme_secondary_gradient_dark.';
	background-image: linear-gradient(to bottom, '.$custom_scheme_secondary_gradient_dark.', '.$custom_scheme_secondary_gradient_light.');
	background-image: -webkit-gradient(linear, left top, left bottom, from('.$custom_scheme_secondary_gradient_dark.'), to('.$custom_scheme_secondary_gradient_light.'));
	background-image: -webkit-linear-gradient(top, '.$custom_scheme_secondary_gradient_dark.', '.$custom_scheme_secondary_gradient_light.');
	background-image: -moz-linear-gradient(top, '.$custom_scheme_secondary_gradient_dark.', '.$custom_scheme_secondary_gradient_light.');
	background-image: -webkit-linear-gradient(top, '.$custom_scheme_secondary_gradient_dark.', '.$custom_scheme_secondary_gradient_light.');
	background-image: -o-linear-gradient(top, '.$custom_scheme_secondary_gradient_dark.', '.$custom_scheme_secondary_gradient_light.');
	background-image: ms-linear-gradient(to bottom, '.$custom_scheme_secondary_gradient_dark.', '.$custom_scheme_secondary_gradient_light.');
	filter: progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr=\''.$custom_scheme_secondary_gradient_dark.'\', endColorstr=\''.$custom_scheme_secondary_gradient_light.'\');
}';	
truethemes_push_custom_css($custom_scheme_secondary_gradient_light,$old_jquery_tools);

$old_jquery_fallback = '
.ie7 .jquery1-slider-wrap,
.ie8 .jquery1-slider-wrap,
.ie9 .jquery1-slider-wrap {
	background: transparent url('.$custom_scheme_image_jquery_banner.') 0 0 no-repeat;
}';	
truethemes_push_custom_css($custom_scheme_image_jquery_banner,$old_jquery_fallback);

$old_ie_frame_top = '
.ie8 span.tools-top,
.ie9 span.tools-top {
	background: url('.$custom_scheme_image_top.') no-repeat;
}';	
truethemes_push_custom_css($custom_scheme_image_top,$old_ie_frame_top);

$old_ie_frame_middle = '
.ie8 .tools .frame,
.ie9 .tools .frame {
	background: url('.$custom_scheme_image_middle.') repeat-y;
}';	
truethemes_push_custom_css($custom_scheme_image_top,$old_ie_frame_middle);

$old_ie_frame_bottom = '
.ie8 span.tools-bottom,
.ie9 span.tools-bottom {
	background: url('.$custom_scheme_image_bottom.') 0 100% no-repeat;
}';	
truethemes_push_custom_css($custom_scheme_image_bottom,$old_ie_frame_bottom);

} // end_if $old_custom_secondary


/*-------------------------------------------------------------- 
IE8 primary
--------------------------------------------------------------*/
$color_customize_ie8_primary = '
/* IE8 does not support rgba. hex# colors provided below */
.ie8 .top-block,
.ie8 .top-block a,
.ie8 #header .toolbar-left li,
.ie8 #header .toolbar-right li {
	color: '.$custom_scheme_primary_ie8_toolbar_text.';
}
.ie8 #menu-main-nav a span.navi-description,
/* reset search/404 navi-description so "blog" isn\'t active */
.ie8 .search-header #menu-main-nav li.current_page_parent a span.navi-description,
.ie8 .error-header #menu-main-nav li.current_page_parent a span.navi-description,
.top-block .top-holder ul.sf-menu li .sub-menu li a:hover {
	color: '.$custom_scheme_primary_ie8_navi_text.';
}';	
truethemes_push_custom_css($custom_scheme_primary_ie8_toolbar_text,$color_customize_ie8_primary);

/*-------------------------------------------------------------- 
jQuery-1 Slider
--------------------------------------------------------------*/
$design_jquery1_flat_code = '
body.karma-flat-cs .jquery1-slider-wrap,
.jquery1-slider-wrap {
	background-image: none;
	background-color:'.$design_jquery1_flat.' ;
	box-shadow: none;
}';	
truethemes_push_custom_css($design_jquery1_flat,$design_jquery1_flat_code);

$design_jquery1_gradient_code = '
.jquery1-slider-wrap,
body.karma-flat-cs .jquery1-slider-wrap {
background-color: '.$design_jquery1_gradient_inner.';
background: -webkit-gradient(radial, center center, 0, center center, 460, from('.$design_jquery1_gradient_inner.'), to('.$design_jquery1_gradient_outer.'));
background: -webkit-radial-gradient(circle, '.$design_jquery1_gradient_inner.', '.$design_jquery1_gradient_outer.');
background: -moz-radial-gradient(circle, '.$design_jquery1_gradient_inner.', '.$design_jquery1_gradient_outer.');
background: -ms-radial-gradient(circle, '.$design_jquery1_gradient_inner.', '.$design_jquery1_gradient_outer.');
}';	
truethemes_push_custom_css($design_jquery1_gradient_inner,$design_jquery1_gradient_code);
/*-------------------------------------------------------------- 
Page Title Bar
--------------------------------------------------------------*/
$design_page_titlebar_code = '
.tools.full-width-page-title-bar,
.tools,
body.karma-flat-cs .tools.full-width-page-title-bar,
body.karma-flat-cs .tools {
	background-image: none;
	background-color:'.$design_page_titlebar_flat.' ;
}';	
truethemes_push_custom_css($design_page_titlebar_flat,$design_page_titlebar_code);

$design_page_titlebar_gradient_code = '
.tools.full-width-page-title-bar,
.tools,
body.karma-flat-cs .tools.full-width-page-title-bar,
body.karma-flat-cs .tools {
	background-color: '.$design_page_titlebar_gradient_inner.';
	background: -webkit-gradient(radial, center center, 0, center center, 460, from('.$design_page_titlebar_gradient_inner.'), to('.$design_page_titlebar_gradient_outer.'));
	background: -webkit-radial-gradient(circle, '.$design_page_titlebar_gradient_inner.', '.$design_page_titlebar_gradient_outer.');
	background: -moz-radial-gradient(circle, '.$design_page_titlebar_gradient_inner.', '.$design_page_titlebar_gradient_outer.');
	background: -ms-radial-gradient(circle, '.$design_page_titlebar_gradient_inner.', '.$design_page_titlebar_gradient_outer.');
}';	
truethemes_push_custom_css($design_page_titlebar_gradient_inner,$design_page_titlebar_gradient_code);
/*-------------------------------------------------------------- 
Post Comments
--------------------------------------------------------------*/
$design_post_comments_flat_code = '
body.karma-flat-cs .post_comments {
    background-image: none;
    background: '.$design_page_postcomments_flat.';
}';	
truethemes_push_custom_css($design_page_postcomments_flat,$design_post_comments_flat_code);

$design_post_comments_gradient_code = '
.post_comments,
body.karma-flat-cs .post_comments {
	box-shadow: 0 0 0 1px '.$design_page_postcomments_gradient_outer.', 0 0 0 2px '.$design_page_postcomments_gradient_inner.';
	background-color: '.$design_page_postcomments_gradient_inner.';
	background-image: linear-gradient(to bottom, '.$design_page_postcomments_gradient_inner.', '.$design_page_postcomments_gradient_outer.');
	background-image: -webkit-gradient(linear, left top, left bottom, from('.$design_page_postcomments_gradient_inner.'), to('.$design_page_postcomments_gradient_outer.'));
	background-image: -webkit-linear-gradient(top, '.$design_page_postcomments_gradient_inner.', '.$design_page_postcomments_gradient_outer.');
	background-image: -moz-linear-gradient(top, '.$design_page_postcomments_gradient_inner.', '.$design_page_postcomments_gradient_outer.');
	background-image: -webkit-linear-gradient(top, '.$design_page_postcomments_gradient_inner.', '.$design_page_postcomments_gradient_outer.');
	background-image: -o-linear-gradient(top, '.$design_page_postcomments_gradient_inner.', '.$design_page_postcomments_gradient_outer.');
	background-image: ms-linear-gradient(to bottom, '.$design_page_postcomments_gradient_inner.', '.$design_page_postcomments_gradient_outer.');
}';	
truethemes_push_custom_css($design_page_postcomments_gradient_inner,$design_post_comments_gradient_code);

/*-------------------------------------------------------------- 
Sub Menus
--------------------------------------------------------------*/
$color_customize_sub_menu = '
/* horizontal */
#horizontal_nav ul a:hover,
#horizontal_nav ul .current_page_item,
#horizontal_nav.tt-gallery-nav-wrap .active,
/* tabs */
.tabset .ui-state-active,
.tabset .active,
.tabset a:hover,
/* wp-page-navi */
.karma-pages span.current,
.wp-pagenavi span.current {
	background: '.$custom_scheme_secondary_active_horz_link.';
}
/* overwrite box-shadow from style.css (for lighter color schemes only) */
#horizontal_nav ul a:hover,
#horizontal_nav ul .current_page_item a,
/* tabs */
.tabset .ui-state-active,
.tabset .active,
.tabset a:hover,
/* wp-page-navi */
.karma-pages span.current,
.wp-pagenavi span.current {
	-webkit-box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.3);
       -moz-box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.3);
            box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.3);
}';	
truethemes_push_custom_css($custom_scheme_secondary_active_horz_link,$color_customize_sub_menu);

$color_customize_sub_menu_vertical = '
/* vertical */
#sub_nav ul a:hover,
#sub_nav ul li.current_page_item a,
#sub_nav.nav_right_sub_nav ul a:hover,
#sub_nav.nav_right_sub_nav ul li.current_page_item a {
	background: url('.$custom_scheme_image_nav_state.') 0px 0px no-repeat;
}';	
truethemes_push_custom_css($custom_scheme_image_nav_state,$color_customize_sub_menu_vertical);

/*-------------------------------------------------------------- 
Links / Lists
--------------------------------------------------------------*/
$color_customize_links = '
/* links */
a,
p a strong,
.link-top,
.tt_comment_required,
ul.tt-recent-posts h4,
span.required,
/* lists */
ul.list li,
ul.list1 li:before,
ul.list2 li:before,
ul.list3 li:before,
ul.list4 li:before,
ul.list5 li:before,
ul.list6 li:before,
ul.list7 li:before,
ul.list8 li:before,
#sidebar ul li:before,
#sub_nav ul li .sub-menu li:before,
#sub_nav ul li .sub-menu li .sub-menu li:before,
#sidebar ul li,
/* left nav */
#sub_nav ul li .sub-menu a,
#sub_nav ul li .sub-menu li.current_page_item a,
#sub_nav ul ul a,
#sub_nav ul ul a:hover,
#sub_nav ul li.current_page_item ul li a,
#sub_nav ul li.current_page_parent ul li.current_page_item a,
/* right nav */
#sub_nav.nav_right_sub_nav ul ul a,
#sub_nav.nav_right_sub_nav ul ul a:hover,
#sub_nav.nav_right_sub_nav ul li.current_page_item ul li a,
#sub_nav.nav_right_sub_nav ul li.current_page_parent ul li.current_page_item a,
#sub_nav .sub_nav_sidebar .textwidget ul li,
#sub_nav .sub_nav_sidebar a,
i.discussion-title,
#sidebar ul.social_icons.tt_vector_social_icons a:after,
#content p.team-member-title {
	color: '.$custom_scheme_secondary_link_color.';
}';	
truethemes_push_custom_css($custom_scheme_secondary_link_color,$color_customize_links);
/*-------------------------------------------------------------- 
Secondary IE8
--------------------------------------------------------------*/
$color_customize_secondary_ie8 = '
.ie8 .footer-content a,
.ie8 #footer_bottom a,
.ie8 #footer .blogroll li,
.ie8 #mc_signup .mc_required,
.ie8 .mc_required,
.ie8 #mc-indicates-required {
	color: '.$custom_scheme_secondary_ie8_footer_links.';
}
.ie8 #footer h3 {
	border-bottom: 1px solid '.$custom_scheme_secondary_ie8_footer_headings.';
}';	
truethemes_push_custom_css($custom_scheme_secondary_ie8_footer_links,$color_customize_secondary_ie8);

/**
 *
 * TrueThemes CSS Generator
 * construct all css to print in <head>
 *
 */
//if not empty css_link_container
    if(!empty($css_link_container)){
       foreach($css_link_container as $css_link){
        echo $css_link."\n";
       }
    }		
	
//if not empty $css_array, print it out in <head>	
	if(!empty($css_array)){
	  echo "<!--styles generated by site options-->\n";
	  echo"<style type='text/css'>\n";
	        foreach($css_array as $css_item){
	         echo $css_item."\n";	        
	        }
	  echo"</style>\n";
	}

}
add_action('wp_head','truethemes_settings_css',90);
/*-------------------------------------------------------------- 
Custom Login Logo
--------------------------------------------------------------*/
function truethemes_custom_login_logo(){
        global $ttso;
		$loginlogo = $ttso->ka_loginlogo;
        echo '<style>
            .login h1 a {
				background-image:url('.$loginlogo.') !important;
				background-size:inherit !important;
				width: auto !important;
			}
        </style>';
}
add_action('login_head', 'truethemes_custom_login_logo');
/*-------------------------------------------------------------- 
Custom Login Logo URL
--------------------------------------------------------------*/
function truethemes_change_wp_login_url() {
   //since version 3.0
   $wordpress_version = get_bloginfo('version');
   if($wordpress_version > '3.3.4'){
    return site_url();
   }   
}
add_filter('login_headerurl', 'truethemes_change_wp_login_url');
    
function truethemes_change_wp_login_title() {
   //updated version 2.7.0
   $wordpress_version = get_bloginfo('version');
   if($wordpress_version >= '3.3.4'){
    return get_option('blogname');
   }else{
    echo get_option('blogname');
   }
}
add_filter('login_headertitle', 'truethemes_change_wp_login_title');


/*
* function to push in custom css font color and font-size etc..
* for use in truethemes_settings_css()
* @since version 2.6 development
* @param string $option_value, assigned option value from database
* @param string $css_code, for custom css code.
*/
function truethemes_push_custom_css($option_value,$css_code){

global $css_array;

	if($option_value!=''&&$option_value!='--select--'){	
	 $option_value_code = $css_code;
	 array_push($css_array,$option_value_code);	
	}


}
/*-------------------------------------------------------------- 
Favicon
--------------------------------------------------------------*/
function karma_favicon() {
	$GLOBALS['favicon'] = get_option('ka_favicon');
	          if($GLOBALS['favicon'] != '')
	        echo '<link rel="shortcut icon" href="'.  $GLOBALS['favicon'] .'"/>'."\n";
	    }

add_action('wp_head', 'karma_favicon');
/*-------------------------------------------------------------- 
Footer Analytics
--------------------------------------------------------------*/
function karma_analytics(){
	
	$GLOBALS['google']          = get_option('ka_google_analytics');
	$GLOBALS['customcode_body'] = get_option('ka_customcode_body');
			
			if($GLOBALS['google'] != '')          echo stripslashes($GLOBALS['google']) . "\n";
			if($GLOBALS['customcode_body'] != '') echo stripslashes($GLOBALS['customcode_body']) . "\n";
			
			}
add_action('wp_footer','karma_analytics');
/*-------------------------------------------------------------- 
Hide Meta Boxes (if_enabled)
--------------------------------------------------------------*/
function karma_metaboxes(){
	$GLOBALS['hide_metaboxes'] = get_option('ka_hidemetabox');
	          if($GLOBALS['hide_metaboxes'] == "true"){				  
				  
/* pages */
remove_meta_box('commentstatusdiv','page','normal'); // Comments
remove_meta_box('commentsdiv','page','normal');      // Comments
remove_meta_box('trackbacksdiv','page','normal');    // Trackbacks
remove_meta_box('postcustom','page','normal');       // Custom Fields
remove_meta_box('authordiv','page','normal');        // Author

/* posts */
remove_meta_box('commentsdiv','post','normal'); // Comments
remove_meta_box('postcustom','post','normal');  // Custom Fields
//remove_meta_box('new-meta-boxes','post','normal');  // Karma Custom Settings from < 4.0
		
}
}
add_action('admin_menu','karma_metaboxes',90);

//CSS to hide metaboxes
function karma_css_hide_slug_metabox(){
	$GLOBALS['hide_metaboxes'] = get_option('ka_hidemetabox');
	          if($GLOBALS['hide_metaboxes'] == "true"){
	echo"<style>#slugdiv, #slugdiv-hide, label[for='slugdiv-hide']{display:none!important;}</style>";
	}          
}
add_action('admin_head','karma_css_hide_slug_metabox');


/*
* function to auto update WordPress (allow people to post comments on new articles) setting, under WordPress admin settings/discussion.
* 
* checks for user setting in site option.
* @since version 2.6 development
*
*/
function truethemes_disable_comments(){
if(is_admin()):
global $ttso;
$show_posts_comments = '';
$show_posts_comments = $ttso->ka_post_comments;

	if($show_posts_comments !='false'){
	update_option('default_comment_status','open');
	}else{
	update_option('default_comment_status','closed');
	}
endif;	
}
add_action('init','truethemes_disable_comments');
?>