<?php 
header('Content-type: text/css');

$pp_advance_combine_css = get_option('pp_advance_combine_css');

if(!empty($pp_advance_combine_css))
{
	//Function for compressing the CSS as tightly as possible
	function grandportfolio_compress($buffer) {
	    //Remove CSS comments
	    $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
	    //Remove tabs, spaces, newlines, etc.
	    $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
	    return $buffer;
	}

	//This GZIPs the CSS for transmission to the user
	//making file size smaller and transfer rate quicker
	ob_start("ob_gzhandler");
	ob_start("grandportfolio_compress");
}
?>

<?php
	//Check if hide portfolio navigation
	$pp_portfolio_single_nav = get_option('pp_portfolio_single_nav');
	if(empty($pp_portfolio_single_nav))
	{
?>
.portfolio_nav { display:none; }
<?php
	}
?>
<?php
	$tg_fixed_menu = kirki_get_option('tg_fixed_menu');
	
	if(!empty($tg_fixed_menu))
	{
		//Check if Wordpress admin bar is enabled
		$menu_top_value = 0;
		if(is_admin_bar_showing())
		{
			$menu_top_value = 30;
		}
?>
.top_bar.fixed
{
	position: fixed;
	animation-name: slideDown;
	-webkit-animation-name: slideDown;	
	animation-duration: 0.5s;	
	-webkit-animation-duration: 0.5s;
	z-index: 999;
	visibility: visible !important;
	top: <?php echo intval($menu_top_value); ?>px;
}

<?php
	$pp_menu_font = get_option('pp_menu_font');
	$pp_menu_font_diff = 16-$pp_menu_font;
?>
.top_bar.fixed #menu_wrapper div .nav
{
	margin-top: <?php echo intval($pp_menu_font_diff); ?>px;
}

.top_bar.fixed #searchform
{
	margin-top: <?php echo intval($pp_menu_font_diff-8); ?>px;
}

.top_bar.fixed .header_cart_wrapper
{
	margin-top: <?php echo intval($pp_menu_font_diff+5); ?>px;
}

.top_bar.fixed #menu_wrapper div .nav > li > a
{
	padding-bottom: 24px;
}

.top_bar.fixed .logo_wrapper img
{
	max-height: 40px;
	width: auto;
}
<?php
	}
	
	//Hack animation CSS for Safari
	$current_browser = grandportfolio_get_browser();

	if(isset($current_browser['name']) && $current_browser['name'] == 'Internet Explorer')
	{
?>
#wrapper
{
	overflow-x: hidden;
}
.mobile_menu_wrapper
{
    display: none;
}
body.js_nav .mobile_menu_wrapper 
{
    display: block;
}
.gallery_type, .portfolio_type
{
	opacity: 1;
}
#searchform input[type=text]
{
	width: 75%;
}
.woocommerce .logo_wrapper img
{
	max-width: 50%;
}
<?php
	}
?>

<?php
	$tg_sidemenu = kirki_get_option('tg_sidemenu');
	
	if(empty($tg_sidemenu))
	{
?>
#mobile_nav_icon
{
    display: none;
}
<?php
	}
?>

<?php

?>

<?php
if(THEMEDEMO)
{
?>
#option_btn
{
	position: fixed;
	top: 120px;
	right: -2px;
	cursor:pointer;
	z-index: 9;
	background: #fff;
	border-right: 0;
	width: 45px;
	height: 160px;
	text-align: center;
	border-radius: 5px 0px 0px 5px;
	box-shadow: 0 3px 15px rgba(0, 0, 0, 0.1);
}

#option_btn i
{
	font-size: 18px;
	line-height: 40px;
	color: #000;
}

#option_btn a
{
	display: block;
}

#option_wrapper
{
	position: fixed;
	top: 0;
	right:-290px;
	width: 280px;
	height: 100%;
	background: #fff;
	border: 1px solid #e1e1e1;
	border-left: 0;
	z-index: 99999;
	color: #222;
	font-size: 13px;
	box-shadow: 0px -4px 30px rgba(0, 0, 0, 0.1);
	overflow: auto;
}

#option_wrapper:hover
{
	overflow-y: auto;
}

#option_wrapper .button.buy
{
	width: 100%;
	box-sizing: border-box;
}

#option_wrapper select
{
	width: 100%;
	margin-top: 5px;
}

#option_wrapper .note_icon
{
	color: #ff3e36;
	margin-right: 5px;
}

strong.label, div.label
{
	font-weight: normal;
	margin-bottom: 5px;
	color: #000;
	display: block;
}

.demo_list
{
	list-style: none;
	display: block;
	margin: 30px 0 0 0;
}

.demo_list li
{
	display: block;
	position: relative;
	margin-bottom: 15px;
	width: 100%;
	overflow: hidden;
	line-height: 0;
}

.demo_list li img
{
	max-width: 260px;
	height: auto;
	line-height: 0;
}

.demo_list li:hover img
{
	-webkit-transition: all 0.2s ease-in-out;
	-moz-transition: all 0.2s ease-in-out;
	-o-transition: all 0.2s ease-in-out;
	-ms-transition: all 0.2s ease-in-out;
	transition: all 0.2s ease-in-out;
	-webkit-filter: blur(2px);
	filter: blur(2px);
	-moz-filter: blur(2px);
}

.demo_list li:hover .demo_thumb_hover_wrapper 
{
	opacity: 1;
}

.demo_thumb_hover_wrapper 
{
	background-color: rgba(0, 0, 0, 0.5);
	height: 100%;
	left: 0;
	opacity: 0;
	overflow: hidden;
	position: absolute;
	top: 0;
	transition: opacity 0.4s ease-in-out;
	-o-transition: opacity 0.4s ease-in-out;
	-ms-transition: opacity 0.4s ease-in-out;
	-moz-transition: opacity 0.4s ease-in-out;
	-webkit-transition: opacity 0.4s ease-in-out;
	visibility: visible;
	width: 100%;
	line-height: normal;
}

.demo_thumb_hover_inner
{
	display: table;
	height: 100%;
	width: 100%;
	text-align: center;
	vertical-align: middle;
}

.demo_thumb_desc
{
	display: table-cell;
	height: 100%;
	text-align: center;
	vertical-align: middle;
	width: 100%;
	padding: 0 10% 0 10%;
	box-sizing: border-box;
}

#option_wrapper .inner h6
{
	margin: 10px 0 0 0;
}

.demo_thumb_hover_inner h6
{
	color: #fff !important;
	line-height: 24px;
	font-size: 18px;
}

.demo_thumb_desc .button.white
{
	margin-top: 10px;
	font-size: 12px !important;
}

.demo_thumb_desc .button.white:hover
{
	background: #fff !important;
	color: #000 !important;
	border-color: #fff !important;
}

#option_wrapper .inner
{
	padding: 25px 15px 0 15px;
	box-sizing: border-box;
}

#option_wrapper .button.buy
{
	background: #000;
	border-color: #000;
}
<?php
}
?>

@media only screen and (max-width: 768px) {
	html[data-menu=leftmenu] .mobile_menu_wrapper
	{
		right: 0;
		left: initial;
		
		-webkit-transform: translate(360px, 0px);
		-ms-transform: translate(360px, 0px);
		transform: translate(360px, 0px);
		-o-transform: translate(360px, 0px);
	}
}

<?php
	$tg_full_arrow = kirki_get_option('tg_full_arrow');
	
	if(!empty($tg_full_arrow))
	{
?>
a#prevslide:before
{
	font-family: "FontAwesome";
	font-size: 24px;
	line-height: 45px;
	display: block;
	content: '\f104';
	color: #fff;
	margin-top: 0px;
}
a#nextslide:before
{
	font-family: "FontAwesome";
	font-size: 24px;
	line-height: 45px;
	display: block;
	content: '\f105';
	color: #fff;
	margin-top: 0px;
}
body.page-template-gallery a#prevslide, body.single-galleries a#prevslide
{ 
	z-index:999; cursor: pointer; display: block; position: fixed; left: 20px; top: 46%; padding: 0 20px 0 20px; width: initial; height: initial; border: 2px solid #fff; opacity: 0.5; 
	-webkit-transition: .2s ease-in-out;
	-moz-transition: .2s ease-in-out;
	-o-transition: .2s ease-in-out;
	transition: .2s ease-in-out;
	width: 50px;
	height: 50px;
	box-sizing: border-box;
	
	border-radius: 250px;
}

body.page-template-gallery a#nextslide, body.single-galleries a#nextslide
{ 
	z-index:999; cursor: pointer;  display: block; position: fixed; right: 20px; top: 46%; padding: 0 20px 0 20px; width: initial; height: initial; border: 2px solid #fff; opacity: 0.5; 
	-webkit-transition: .2s ease-in-out;
	-moz-transition: .2s ease-in-out;
	-o-transition: .2s ease-in-out;
	transition: .2s ease-in-out;
	width: 50px;
	height: 50px;
	box-sizing: border-box;
	
	border-radius: 250px;
}

body.page-template-gallery a#prevslide:hover, body.page-template-gallery a#nextslide:hover, body.single-galleries a#prevslide:hover, body.single-galleries a#nextslide:hover { opacity: 1; }
<?php
	}
?>

<?php
	$tg_footer_copyright_layout = kirki_get_option('tg_footer_copyright_layout');
	
	if($tg_footer_copyright_layout == 'center')
	{
?>
#copyright, .footer_bar_wrapper .social_wrapper
{
	float: none;
	margin: auto;
	width: 100%;
	text-align: center;
}

.footer_bar_wrapper .social_wrapper ul, #page_content_wrapper .footer_bar_wrapper .social_wrapper ul
{
	text-align: center;
	margin-bottom: 20px;
}

.footer_bar_wrapper .social_wrapper ul li
{
	float: none;
}

.footer_bar
{
	padding: 30px 0 30px 0;
}
<?php
	}
?>

<?php
	$tg_blog_header_align = kirki_get_option('tg_blog_header_align');
	
	if(!empty($tg_blog_header_align))
	{
?>
.post_header_title, .post_header.grid
{
	text-align: <?php echo esc_attr($tg_blog_header_align); ?>;
}
<?php
	if($tg_blog_header_align != 'center')
	{
?>
.post_header_title hr.title_break, .post_header.grid hr.title_break
{
	float: <?php echo esc_attr($tg_blog_header_align); ?>;
}
<?php
	}
?>
<?php
	}
?>

<?php
	//Check topbar content option
    $tg_topbar_content = kirki_get_option('tg_topbar_content');
    
    if($tg_topbar_content == 'center_menu')
    {
?>
.above_top_bar .page_content_wrapper
{
	text-align:center;
}

#top_menu
{
	float: none;
	margin: auto;
}

#top_menu li
{
	float: none;
	display: inline-block;
}
<?php
	}
?>

<?php
	//Get side menu layout
	$tg_sidemenu_layout = kirki_get_option('tg_sidemenu_layout');
	
	if($tg_sidemenu_layout == 'menu_center')
	{
?>
.mobile_main_nav li a .menu-description
{
	line-height: 0em;
	font-size: 13px;
	opacity: 0.7;
}

.mobile_main_nav li, #sub_menu li
{
	margin: 30px 0 30px 0;
}

.mobile_main_nav li a, #sub_menu li a
{
	line-height: 2.2em;
}

.mobile_main_nav, #sub_menu
{
	margin: 0;
	overflow: visible;
}

.mobile_menu_wrapper .mobile_menu_content
{
	display: table;
	width: 100%;
	height: 100%;
}

.mobile_menu_wrapper .mobile_menu_content .mobile_main_nav, .mobile_menu_wrapper .mobile_menu_content #sub_menu
{
	width: 100%;
	display: table-cell;
	vertical-align: middle;
}
<?php
	}
?>

<?php
	//Get side menu layout
	$tg_fixed_menu_border = kirki_get_option('tg_fixed_menu_border');
	
	if(empty($tg_fixed_menu_border))
	{
?>
html[data-style=fullscreen] .top_bar.hasbg, .top_bar.hasbg, .top_bar.scroll.black
{
	border: 0;
}
<?php
	}
?>

<?php
	//Get transparent menu opacity
	$tg_transparent_menu_opacity = kirki_get_option('tg_transparent_menu_opacity');
	$tg_transparent_menu_opacity_val = number_format((float)$tg_transparent_menu_opacity/100, 2);
?>
.top_bar.hasbg
{
	background: rgba(0,0,0,<?php echo esc_attr($tg_transparent_menu_opacity_val); ?>);
}

<?php
	//Get header alignment
	$tg_page_header_alignment = kirki_get_option('tg_page_header_alignment');
	
	if($tg_page_header_alignment == 'left')
	{
?>
#page_caption, #page_caption .page_title_wrapper
{
	text-align: left;
	float: left;
}

#page_caption .page_title_wrapper .page_title_inner
{
	position: relative;
    float: left;
    width: 100%;
    box-sizing: border-box;
    margin-top: 10px;
    margin-bottom: 10px;
}

.post_caption 
{
	position: relative;
}

#page_caption hr.title_break, .post_caption hr.title_break
{
	display: none;
}

#page_caption h1
{
	width: 55%;
    display: block;
    float: left;
}

#page_caption .page_tagline, .post_caption .page_tagline
{
	width: 45%;
    text-align: right;
    position: absolute;
    right: 0;
    bottom: 0.5em;
}

.post_caption
{
	text-align: left;
	float: left;
	width: 100%;
}

.page_tagline
{
	font-style: normal;
}

.post_caption .page_tagline
{
	right: 30px;
}

#portfolio_wall_filters
{
	width: 45%;
	float: right;
	text-align: right;
	margin-left: 0 !important;
}

@media only screen and (min-width: 1100px) {
	#page_caption .page_tagline 
	{
		right: 90px;
	}
}
<?php
	}
	elseif($tg_page_header_alignment == 'absolute left')
	{
?>
	#page_caption
	{
		clear: both;
	}
	
	#page_caption .page_title_wrapper
	{
		text-align: left;
	}

	#page_caption h1
	{
		display: block;
		width: 60%;
	}
	
	#page_caption hr.title_break
	{
		display: block;
		margin-left: 0;
	}
	
	#page_caption .page_tagline, #page_caption.hasbg .page_tagline
	{
		position: relative;
	    display: block;
	    width: 100%;
	    clear: both;
	    text-align: left;
	    right: 0;
	    max-width: 50%;
	    bottom: 0;
	    margin-left: 0;
	}
	
	#page_caption hr.title_break
	{
		margin: 30px 0 30px 0;
	}
	
	#page_caption.hasbg .page_title_wrapper
	{
		padding-bottom: 30px;
	}
	
	#page_caption .page_tagline, #page_caption.hasbg .page_tagline
	{
		margin-top: 20px;
	}
<?php
	}
?>

<?php
//Get Footer Sidebar
$tg_footer_sidebar = kirki_get_option('tg_footer_sidebar');

if(empty($tg_footer_sidebar))
{
?>
#footer
{
	padding: 0;
}
<?php
}
?>

<?php
	//Menu layout custom CSS
	$tg_menu_layout = grandportfolio_menu_layout();
	
	if($tg_menu_layout == 'centeralign')
	{
?>
@media only screen and (max-width: 767px) {
	body .top_bar
	{
		padding: 20px;
	}
}
<?php
	}
?>

<?php
	//Check topbar content option
    $tg_topbar = kirki_get_option('tg_topbar');
    
    if(!empty($tg_topbar))
    {
?>
@media only screen and (max-width: 960px) and (min-width: 768px) {
	body #logo_right_button, html[data-menu=leftalign_center] body #logo_right_button
	{
		top: 62px;
	}
}
<?php
	}
?>

<?php
	//Check if disable kenburns hover effect
	$tg_disable_hover_kenburns = kirki_get_option('tg_disable_hover_kenburns');
	
	if(empty($tg_disable_hover_kenburns))
	{
?>
.two_cols.gallery .element:hover img, .three_cols.gallery .element:hover img, .four_cols.gallery .element:hover img, .five_cols.gallery .element:hover img, .one_half.gallery2.classic a:hover img, .one_third.gallery3.classic a:hover img, .one_fourth.gallery4.classic a:hover img
{
	-ms-transform: scale(1);
    -moz-transform: scale(1);
    -o-transform: scale(1);
    -webkit-transform: scale(1);
    transform: scale(1);
}
<?php
	}
	
	$tg_portfolio_hover_timer = kirki_get_option('tg_portfolio_hover_timer');
	
	if(!empty($tg_portfolio_hover_timer))
	{
?>
.two_cols.gallery .element img, .three_cols.gallery .element img, .four_cols.gallery .element img, .five_cols.gallery .element img, .two_cols.gallery .element:hover img, .three_cols.gallery .element:hover img, .four_cols.gallery .element:hover img, .five_cols.gallery .element:hover img, .post_img img, .post_img:hover img, #horizontal_gallery_wrapper .gallery_image_wrapper.archive img, .horizontal_gallery_wrapper .gallery_image_wrapper.archive img
{
	transition: all <?php echo $tg_portfolio_hover_timer; ?>s ease-out;
    -webkit-transition: all <?php echo $tg_portfolio_hover_timer; ?>s ease-out;
}
<?php
	}
	
	$tg_portfolio_hover_style = kirki_get_option('tg_portfolio_hover_style');
	
	//If center title style
	if($tg_portfolio_hover_style == 'center_title')
	{
?>
.one_half.gallery2.portfolio_type a:after, .one_third.gallery3.portfolio_type a:after, .one_fourth.gallery4.portfolio_type a:after, .one_fifth.gallery5.portfolio_type a:after
{
	display: none;
}
.two_cols.gallery .element .portfolio_title, .three_cols.gallery .element .portfolio_title, .four_cols.gallery .element .portfolio_title, .five_cols.gallery .element .portfolio_title
{
	background: rgba(0,0,0,0.7);
	height: 100%;
	bottom: 0;
	transform: translate3d(0, 0px, 0);
    -webkit-transform: translate3d(0, 0px, 0);
    -moz-transform: translate3d(0, 0px, 0);
    
    transition: all <?php echo $tg_portfolio_hover_timer; ?>s ease-out;
    -webkit-transition: all <?php echo $tg_portfolio_hover_timer; ?>s ease-out;
}

.two_cols.gallery .element .portfolio_title .table, .three_cols.gallery .element .portfolio_title .table, .four_cols.gallery .element .portfolio_title .table, .five_cols.gallery .element .portfolio_title .table
{
	bottom: 0;
	display: table;
	width: 100%;
	height: 100%;
}

.two_cols.gallery .element .portfolio_title .table .cell, .three_cols.gallery .element .portfolio_title .table .cell, .four_cols.gallery .element .portfolio_title .table .cell, .five_cols.gallery .element .portfolio_title .table .cell
{
	display: table-cell;
	vertical-align: middle;
}
<?php
	}
?>

<?php
	$tg_portfolio_grayscale = kirki_get_option('tg_portfolio_grayscale');
	
	if(!empty($tg_portfolio_grayscale))
	{
?>
.two_cols.gallery .element img, .three_cols.gallery .element img, .four_cols.gallery .element img, .fifth_cols.gallery .element img, #horizontal_gallery_wrapper .gallery_image_wrapper.archive img, .horizontal_gallery_wrapper .gallery_image_wrapper.archive img
{ 
  -webkit-filter: grayscale(100%);
  -moz-filter: grayscale(100%);
  -ms-filter: grayscale(100%);
  -o-filter: grayscale(100%);
  filter: grayscale(100%);
  filter: gray; /* IE 6-9 */
  
  transition: all 0.6s ease-out !important;
  -webkit-transition: all 0.6s ease-out !important;
}

.two_cols.gallery .element:hover img, .three_cols.gallery .element:hover img, .four_cols.gallery .element:hover img, .fifth_cols.gallery .element:hover img, #horizontal_gallery_wrapper .gallery_image_wrapper.archive:hover img, .horizontal_gallery_wrapper .gallery_image_wrapper.archive:hover img
{ 
  -webkit-filter: grayscale(0%);
  -moz-filter: grayscale(0%);
  -ms-filter: grayscale(0%);
  -o-filter: grayscale(0%);
  filter: grayscale(0%);
  filter: initial; /* IE 6-9 */
}
<?php
	}
?>

<?php
/**
*	Get custom CSS for Desktop View
**/
$pp_custom_css = get_option('pp_custom_css');


if(!empty($pp_custom_css))
{
    echo stripslashes($pp_custom_css);
}
?>

<?php
/**
*	Get custom CSS for iPad Portrait View
**/
$pp_custom_css_tablet_portrait = get_option('pp_custom_css_tablet_portrait');


if(!empty($pp_custom_css_tablet_portrait))
{
?>
@media only screen and (min-width: 768px) and (max-width: 959px) {
<?php
    echo stripslashes($pp_custom_css_tablet_portrait);
?>
}
<?php
}
?>

<?php
/**
*	Get custom CSS for iPhone Portrait View
**/
$pp_custom_css_mobile_portrait = get_option('pp_custom_css_mobile_portrait');


if(!empty($pp_custom_css_mobile_portrait))
{
?>
@media only screen and (max-width: 767px) {
<?php
    echo stripslashes($pp_custom_css_mobile_portrait);
?>
}
<?php
}
?>

<?php
/**
*	Get custom CSS for iPhone Landscape View
**/
$pp_custom_css_mobile_landscape = get_option('pp_custom_css_mobile_landscape');


if(!empty($pp_custom_css_tablet_portrait))
{
?>
@media only screen and (min-width: 480px) and (max-width: 767px) {
<?php
    echo stripslashes($pp_custom_css_mobile_landscape);
?>
}
<?php
}
?>

<?php
if(!empty($pp_advance_combine_css))
{
	ob_end_flush();
	ob_end_flush();
}
?>