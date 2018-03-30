<?php header("Content-Type: text/css");
$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];
if(THEMEDEMO)
{
	session_start();
}
require_once( $path_to_wp.'/wp-load.php' );

$pp_advance_combine_css = get_option('pp_advance_combine_css');

if(!empty($pp_advance_combine_css))
{
	//Function for compressing the CSS as tightly as possible
	function compress($buffer) {
	    //Remove CSS comments
	    $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
	    //Remove tabs, spaces, newlines, etc.
	    $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
	    return $buffer;
	}

	//This GZIPs the CSS for transmission to the user
	//making file size smaller and transfer rate quicker
	ob_start("ob_gzhandler");
	ob_start("compress");
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
	$pp_fixed_menu = get_option('pp_fixed_menu');
	
	if(!empty($pp_fixed_menu))
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
	top: <?php echo $menu_top_value; ?>px;
}

.top_bar.fixed.header_style1, .top_bar.fixed.header_style2
{
	height: 70px;
}

.top_bar.fixed.header_style1 .logo_wrapper, .top_bar.fixed.header_style2 .logo_wrapper
{
	margin: 24px 0 10px 0;
}

.top_bar.fixed.header_style1 #menu_wrapper .nav > ul, .top_bar.fixed.header_style1 #menu_wrapper div > .nav, .top_bar.fixed.header_style2 #menu_wrapper .nav > ul, .top_bar.fixed.header_style2 #menu_wrapper div > .nav
{
	margin-top: 19px;
}

.top_bar.fixed.header_style1 #menu_wrapper .nav > ul > li, .top_bar.fixed.header_style1 #menu_wrapper div > .nav > li, .top_bar.fixed.header_style2 #menu_wrapper .nav > ul > li, .top_bar.fixed.header_style2 #menu_wrapper div > .nav > li
{
	padding-bottom: 12px;
}

.top_bar.fixed.header_style1 #searchform, .top_bar.fixed.header_style2 #searchform
{
	margin-top: 6px;
	padding-bottom: 5px;
}
<?php
}
?>

<?php
	//Hack animation CSS for Safari
	$current_browser = getBrowser();
	
	//If enable animation
	$pp_animation = get_option('pp_animation');
	
	if($pp_animation && isset($current_browser['name']) && $current_browser['name'] != 'Internet Explorer')
	{
?>
@-webkit-keyframes fadeIn { from { opacity:0; } to { opacity:0.99; } }
@-moz-keyframes fadeIn { from { opacity:0; } to { opacity:0.99; } }
@-ms-keyframes fadeIn { from { opacity:0; } to { opacity:0.99; } }
@keyframes fadeIn { from { opacity:0; } to { opacity:0.99; } }
 
.fade-in {
    animation-name: fadeIn;
	-webkit-animation-name: fadeIn;
	-ms-animation-name: fadeIn;	

	animation-duration: 0.7s;	
	-webkit-animation-duration: 0.7s;
	-ms-animation-duration: 0.7s;

	animation-timing-function: ease-out;	
	-webkit-animation-timing-function: ease-out;	
	-ms-animation-timing-function: ease-out;	

	-webkit-animation-fill-mode:forwards; 
    -moz-animation-fill-mode:forwards;
    -ms-animation-fill-mode:forwards;
    animation-fill-mode:forwards;
    
    visibility: visible !important;
}
<?php
	}
	else
	{
?>
	.fadeIn, .fade-in, #supersized, #blog_grid_wrapper .post.type-post, #galleries_grid_wrapper .gallery.type-gallery, .one_half.portfolio2_wrapper, .one_third.portfolio3_wrapper, .one_fourth.portfolio4_wrapper, .mansory_thumbnail, #photo_wall_wrapper .wall_entry, #portfolio_filter_wrapper .element, .gallery_type, .portfolio_type, .one_fourth.gallery4 .mask .mask_circle, .one_half.gallery2 .mask .mask_circle, .one_third.gallery3 .mask .mask_circle, .one_fourth.gallery4 .mask .mask_circle, .post_img .mask .mask_circle, .mansory_thumbnail .mask .mask_circle, .wall_thumbnail .mask .mask_circle, .gallery_img { opacity: 1 !important; visibility: visible !important; }
.isotope-item { z-index: 2 !important; }

.isotope-hidden.isotope-item { pointer-events: none; display: none; z-index: 1 !important; }
<?php
	}
?>

<?php
	if(isset($current_browser['name']) && $current_browser['name'] != 'Internet Explorer')
	{
		for($i=1;$i<=50;$i++)
		{
?>
.animated<?php echo $i; ?>
{
	-webkit-animation-delay: <?php echo $i/5; ?>s;
	-moz-animation-delay: <?php echo $i/5; ?>s;
	animation-delay: <?php echo $i/5; ?>s;
}
<?php
		}
	}
?>

<?php
	if(isset($current_browser['name']) && $current_browser['name'] == 'Internet Explorer')
	{
?>
.mobile_menu_wrapper
{
    display: none;
}
body.js_nav .mobile_menu_wrapper 
{
    display: block;
}
body.js_nav #wrapper, body.js_nav .footer_wrapper
{
	margin-left: 70%;
}
<?php
	}
?>

<?php
$pp_menu_font = get_option('pp_menu_font');

if(!empty($pp_menu_font))
{
?>
#menu_wrapper .nav ul li a, #menu_wrapper div .nav li a { font-family: '<?php echo urldecode($pp_menu_font); ?>' !important; }		
<?php
}
?>

<?php
	$pp_menu_font_size = get_option('pp_menu_font_size');
	
	if(!empty($pp_menu_font_size))
	{
?>
#menu_wrapper .nav ul li a, #menu_wrapper div .nav li a { font-size:<?php echo $pp_menu_font_size; ?>px; }
<?php
	}
	
?>

<?php
	$pp_submenu_font_size = get_option('pp_submenu_font_size');
	
	if(!empty($pp_submenu_font_size))
	{
?>
#menu_wrapper .nav ul li ul li a, #menu_wrapper div .nav li ul li a, #menu_wrapper div .nav li.current-menu-parent ul li a { font-size:<?php echo $pp_submenu_font_size; ?>px; }
<?php
	}	
?>

<?php
	$pp_menu_upper = get_option('pp_menu_upper');

	if(empty($pp_menu_upper))
	{
?>
#menu_wrapper .nav ul li a, #menu_wrapper div .nav li a { text-transform: none; }		
<?php
	}

	$pp_submenu_upper = get_option('pp_submenu_upper');

	if(!empty($pp_submenu_upper))
	{
?>
#menu_wrapper .nav ul li ul li a, #menu_wrapper div .nav li ul li a, #menu_wrapper div .nav li.current-menu-parent ul li a { text-transform: uppercase; }		
<?php
	}
?>

<?php
	$pp_menu_bold = get_option('pp_menu_bold');

	if(!empty($pp_menu_bold))
	{
?>
#menu_wrapper .nav ul li a, #menu_wrapper div .nav li a { font-weight: bold; }		
<?php
	}
?>

<?php
	$pp_page_title_align = get_option('pp_page_title_align');

	if(!empty($pp_page_title_align) && $pp_page_title_align == 'center')
	{
	
?>
#page_caption .page_title_wrapper
{
	text-align: center;
}
#page_caption:after
{
	border-top: 2px solid #333;
	position: absolute;
}
#page_caption h1, #crumbs
{
	float: none;
	margin: auto;
}
<?php
	}
?>

<?php
	$pp_page_title_paddingtop = get_option('pp_page_title_paddingtop');
?>
#page_caption
{
	padding-top: <?php echo $pp_page_title_paddingtop; ?>px;
}

<?php
	$pp_page_title_paddingbottom = get_option('pp_page_title_paddingbottom');
?>
#page_caption
{
	padding-bottom: <?php echo $pp_page_title_paddingbottom; ?>px;
}

<?php
	$pp_page_title_bgcolor = get_option('pp_page_title_bgcolor');

	if(!empty($pp_page_title_bgcolor))
	{
	
?>
#page_caption
{
	background: <?php echo $pp_page_title_bgcolor; ?>;
}
<?php
	}
?>

<?php
	$pp_page_title_fontcolor = get_option('pp_page_title_fontcolor');

	if(!empty($pp_page_title_fontcolor))
	{
	
?>
#page_caption h1
{
	color: <?php echo $pp_page_title_fontcolor; ?>;
}
<?php
	}
?>

<?php
	$pp_page_title_font_size = get_option('pp_page_title_font_size');
	
	if(!empty($pp_page_title_font_size))
	{
?>
#page_caption h1 { font-size:<?php echo $pp_page_title_font_size; ?>px; }
<?php
	}
?>

<?php
	$pp_page_title_upper = get_option('pp_page_title_upper');

	if(empty($pp_page_title_upper))
	{
?>
#page_caption h1 { text-transform: none; }		
<?php
	}
?>

<?php
	$pp_page_title_bold = get_option('pp_page_title_bold');

	if(!empty($pp_page_title_bold))
	{
?>
#page_caption h1 { font-weight: bold; }		
<?php
	}
?>

<?php
	$pp_breadcrumbs_display = get_option('pp_breadcrumbs_display');

	if(empty($pp_breadcrumbs_display))
	{
	
?>
#crumbs
{
	display: none;
}
<?php
	}
?>

<?php
	$pp_breadcrumbs_fontcolor = get_option('pp_breadcrumbs_fontcolor');

	if(!empty($pp_breadcrumbs_fontcolor))
	{
	
?>
#crumbs, #crumbs a, #crumbs a:hover, #crumbs a:active
{
	color: <?php echo $pp_breadcrumbs_fontcolor; ?>;
}
<?php
	}
?>

<?php
	$pp_footer_social_display = get_option('pp_footer_social_display');

	if(empty($pp_footer_social_display))
	{
	
?>
.footer_bar .footer_bar_wrapper .social_wrapper
{
	display: none;
}
<?php
	}
?>

<?php
	$pp_footer_totop_display = get_option('pp_footer_totop_display');

	if(empty($pp_footer_totop_display))
	{
	
?>
#toTop
{
	display: none !important;
}
<?php
	}
?>

<?php
	$pp_header_font = get_option('pp_header_font');
	
	if(!empty($pp_header_font))
	{
?>
	h1, h2, h3, h4, h5, h6, h7, #imageFlow .title, #contact_form label, .above_top_bar .top_contact_info { font-family: '<?php echo urldecode($pp_header_font); ?>'; }		
<?php
	}
?>

<?php
	$pp_h1_size = get_option('pp_h1_size');
	
	if(!empty($pp_h1_size))
	{
?>
h1 { font-size:<?php echo $pp_h1_size; ?>px; }
<?php
	}
	
?>

<?php
	$pp_h2_size = get_option('pp_h2_size');
	
	if(!empty($pp_h2_size))
	{
?>
h2 { font-size:<?php echo $pp_h2_size; ?>px; }
<?php
	}
	
?>

<?php
	$pp_h3_size = get_option('pp_h3_size');
	
	if(!empty($pp_h3_size))
	{
?>
h3 { font-size:<?php echo $pp_h3_size; ?>px; }
<?php
	}
	
?>

<?php
	$pp_h4_size = get_option('pp_h4_size');
	
	if(!empty($pp_h4_size))
	{
?>
h4 { font-size:<?php echo $pp_h4_size; ?>px; }
<?php
	}
	
?>

<?php
	$pp_h5_size = get_option('pp_h5_size');
	
	if(!empty($pp_h5_size))
	{
?>
h5 { font-size:<?php echo $pp_h5_size; ?>px; }
<?php
	}
	
?>

<?php
	$pp_h6_size = get_option('pp_h6_size');
	
	if(!empty($pp_h6_size))
	{
?>
h6 { font-size:<?php echo $pp_h6_size; ?>px; }
<?php
	}
	
?>

<?php
	$pp_body_font = get_option('pp_body_font');
	
	if(!empty($pp_body_font))
	{
?>
	body, .fancybox-title-outside-wrap { font-family: '<?php echo urldecode($pp_body_font); ?>'; }		
<?php
	}
?>

<?php
	$pp_body_font_size = get_option('pp_body_font_size');
	
	if(!empty($pp_body_font_size))
	{
?>
body { font-size:<?php echo $pp_body_font_size; ?>px; }
<?php
	}
?>

<?php
	$pp_ppb_header_font_size = get_option('pp_ppb_header_font_size');
	
	if(!empty($pp_ppb_header_font_size))
	{
?>
h2.ppb_title { font-size:<?php echo $pp_ppb_header_font_size; ?>px; }
<?php
	}
	
?>

<?php
	$pp_ppb_tagline_font_size = get_option('pp_ppb_tagline_font_size');
	
	if(!empty($pp_ppb_tagline_font_size))
	{
?>
.page_caption_desc { font-size:<?php echo $pp_ppb_tagline_font_size; ?>px; }
<?php
	}
	
?>

<?php
	$pp_fullscreen_image_title_font_size = get_option('pp_fullscreen_image_title_font_size');
	
	if(!empty($pp_fullscreen_image_title_font_size))
	{
?>
.imageFlow_gallery_info_wrapper h1 { font-size:<?php echo $pp_fullscreen_image_title_font_size; ?>px; }
<?php
	}
?>

<?php
	$pp_sidebar_title_font_size = get_option('pp_sidebar_title_font_size');
	
	if(!empty($pp_sidebar_title_font_size))
	{
?>
#page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle { font-size:<?php echo $pp_sidebar_title_font_size; ?>px; }
<?php
	}
?>

<?php
	$pp_sidebar_title_upper = get_option('pp_sidebar_title_upper');

	if(empty($pp_sidebar_title_upper))
	{
?>
#page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle { text-transform: none; }		
<?php
	}
?>

<?php
	$pp_sidebar_title_bold = get_option('pp_sidebar_title_bold');

	if(!empty($pp_sidebar_title_bold))
	{
?>
#page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle { font-weight: bold; }		
<?php
	}
?>

<?php
	$pp_sidebar_title_font = get_option('pp_sidebar_title_font');
	
	if(!empty($pp_sidebar_title_font))
	{
?>
#page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle { font-family: '<?php echo urldecode($pp_sidebar_title_font); ?>'; }		
<?php
	}
?>

<?php
	$pp_menu_font_color = get_option('pp_menu_font_color');

if(!empty($pp_menu_font_color))
{
?>
#menu_wrapper .nav ul li a, #menu_wrapper div .nav li a, .top_bar #searchform button i, #searchform label { color: <?php echo $pp_menu_font_color; ?>; }
#mobile_nav_icon { border-color: <?php echo $pp_menu_font_color; ?>; }
<?php
}
?>

<?php
//Check if display active BG
$pp_menu_active_bg = get_option('pp_menu_active_bg');
$pp_menu_hover_font_color = get_option('pp_menu_hover_font_color');

if(!empty($pp_menu_hover_font_color))
{
	if(!empty($pp_menu_active_bg))
	{
?>
#menu_wrapper .nav ul li a.hover, #menu_wrapper .nav ul li a:hover, #menu_wrapper div .nav li a.hover, #menu_wrapper div .nav li a:hover { background: <?php echo $pp_menu_hover_font_color; ?>; color: #ffffff;  }
<?php
	}
	else
	{
?>
#menu_wrapper .nav ul li a.hover, #menu_wrapper .nav ul li a:hover, #menu_wrapper div .nav li a.hover, #menu_wrapper div .nav li a:hover { color: <?php echo $pp_menu_hover_font_color; ?>;  }
<?php
	}
}
?>

<?php
$pp_menu_active_font_color = get_option('pp_menu_active_font_color');

if(!empty($pp_menu_active_font_color))
{
	if(!empty($pp_menu_active_bg))
	{
?>
#menu_wrapper div .nav > li.current-menu-item > a, #menu_wrapper div .nav > li.current-menu-parent > a, #menu_wrapper div .nav > li.current-menu-ancestor > a { background: <?php echo $pp_menu_active_font_color; ?>; color: #ffffff; }
<?php
	}
	else
	{
?>
#menu_wrapper div .nav > li.current-menu-item > a, #menu_wrapper div .nav > li.current-menu-parent > a, #menu_wrapper div .nav > li.current-menu-ancestor > a { color: <?php echo $pp_menu_active_font_color; ?>;  }
<?php		
	}
}
?>

<?php
	$pp_menu_bg_color = get_option('pp_menu_bg_color');

	if(!empty($pp_menu_bg_color))
	{
	
?>
.top_bar
{
	background: <?php echo $pp_menu_bg_color; ?>;
}
<?php
	}
?>

<?php
	$pp_menu_bg_color = get_option('pp_menu_bg_color');
	$ori_pp_menu_bg_color = $pp_menu_bg_color;
	
	if(!empty($pp_menu_bg_color))
	{
		$pp_menu_opacity_color = get_option('pp_menu_opacity_color');
		$pp_menu_opacity_color = $pp_menu_opacity_color/100;
		$pp_menu_bg_color = HexToRGB($pp_menu_bg_color);
	
?>
.top_bar
{
	background: <?php echo $ori_pp_menu_bg_color; ?>;
	background: rgb(<?php echo $pp_menu_bg_color['r']; ?>, <?php echo $pp_menu_bg_color['g']; ?>, <?php echo $pp_menu_bg_color['b']; ?>, <?php echo $pp_menu_opacity_color; ?>);
	background: rgba(<?php echo $pp_menu_bg_color['r']; ?>, <?php echo $pp_menu_bg_color['g']; ?>, <?php echo $pp_menu_bg_color['b']; ?>, <?php echo $pp_menu_opacity_color; ?>);
}
<?php
	}
?>

<?php
	$pp_menu_full_bg_color = get_option('pp_menu_full_bg_color');

	if($pp_menu_full_bg_color == 'dark')
	{
	
?>
.top_bar.fullscreen, .top_bar.flip, .top_bar.fullscreen
{
	background: transparent url('<?php echo get_template_directory_uri(); ?>/images/fullscreen_menu_bg_dark.png') repeat-x !important;
}
<?php
	}
?>

<?php
	$pp_menu_border_color = get_option('pp_menu_border_color');

	if(!empty($pp_menu_border_color))
	{
	
?>
.top_bar
{
	border-color: <?php echo $pp_menu_border_color; ?>;
}
<?php
	}
?>

<?php
	$pp_submenu_font_color = get_option('pp_submenu_font_color');

if(!empty($pp_submenu_font_color))
{
?>
#menu_wrapper div .nav li ul li a, #menu_wrapper div .nav li.current-menu-item ul li a, #menu_wrapper div .nav li ul li.current-menu-item a, #menu_wrapper .nav ul li ul li a, #menu_wrapper .nav ul li.current-menu-item ul li a, #menu_wrapper .nav ul li ul li.current-menu-item a, #menu_wrapper div .nav li.current-menu-parent ul li a, #menu_wrapper div .nav li ul li.current-menu-parent a, #autocomplete a, #autocomplete a:hover, #autocomplete a:active, #autocomplete li.view_all a { color: <?php echo $pp_submenu_font_color; ?>;  }
<?php
}
?>

<?php
	$pp_submenu_hover_font_color = get_option('pp_submenu_hover_font_color');

	if(!empty($pp_submenu_hover_font_color))
	{
	
?>
#menu_wrapper .nav ul li ul li a:hover, #menu_wrapper .nav ul li ul li a:hover, #menu_wrapper div .nav li ul li a:hover, #menu_wrapper div .nav li ul li a:hover, #menu_wrapper div .nav li.current-menu-item ul li a:hover, #menu_wrapper div .nav li.current-menu-parent ul li a:hover
{
	background: <?php echo $pp_submenu_hover_font_color; ?>;
	color: #ffffff;
}
<?php
	}
?>

<?php
	$pp_submenu_bg_color = get_option('pp_submenu_bg_color');

	if(!empty($pp_submenu_bg_color))
	{
?>
#menu_wrapper .nav ul li ul, #menu_wrapper div .nav li ul, #autocomplete ul, .mobile_menu_wrapper, body.js_nav
{
	background: <?php echo $pp_submenu_bg_color; ?>;
}
#menu_wrapper .nav ul li ul:before, #menu_wrapper div .nav li ul:before, #autocomplete.visible:before
{
	border-color: <?php echo $pp_submenu_bg_color; ?> transparent;
}
<?php
	}
?>

<?php
$pp_content_bg_color = get_option('pp_content_bg_color');

if(!empty($pp_content_bg_color))
{
?>
body, #wrapper, body[data-style=fullscreen], body[data-style=flow], body[data-style=flip], body[data-style=carousel], body[data-style=fullscreen_video] { background-color: <?php echo $pp_content_bg_color; ?>; }
#supersized li { background-color: <?php echo $pp_content_bg_color; ?> !important; }
.mobile_main_nav li.current-menu-item:after { border-right-color: <?php echo $pp_content_bg_color; ?> !important; }
<?php
}

//Calculate background color for fullscreen content
$ori_pp_content_bg_color = $pp_content_bg_color;
$pp_content_bg_color = HexToRGB($pp_content_bg_color);
?>
#imageFlow_gallery_info, #slidecaption
{
	background: <?php echo $ori_pp_content_bg_color; ?>;
	background: rgb(<?php echo $pp_content_bg_color['r']; ?>, <?php echo $pp_content_bg_color['g']; ?>, <?php echo $pp_content_bg_color['b']; ?>, 0.9);
	background: rgba(<?php echo $pp_content_bg_color['r']; ?>, <?php echo $pp_content_bg_color['g']; ?>, <?php echo $pp_content_bg_color['b']; ?>, 0.9);
}

<?php
$pp_font_color = get_option('pp_font_color');

if(!empty($pp_font_color))
{
?>
body { color: <?php echo $pp_font_color; ?>; }
.woocommerce #payment div.payment_box, .woocommerce-page #payment div.payment_box { color: <?php echo $pp_font_color; ?> !important; }
<?php
}
?>

<?php
	$pp_link_color = get_option('pp_link_color');
	
	if(!empty($pp_link_color))
	{
?>
a { color:<?php echo $pp_link_color; ?>; }
.woocommerce div.product form.cart .button.single_add_to_cart_button { background-color:<?php echo $pp_link_color; ?> !important; }
<?php
	}
?>

<?php
	$pp_hover_link_color = get_option('pp_hover_link_color');
	
	if(!empty($pp_hover_link_color))
	{
?>
#page_content_wrapper a:hover, #page_content_wrapper a:active { color:<?php echo $pp_hover_link_color; ?>; }
<?php
	}
?>

<?php
$pp_h1_font_color = get_option('pp_h1_font_color');
if(!empty($pp_h1_font_color))
{
?>
.post_header h2, h1, h2, h3, h4, h5, pre, code, tt, blockquote, .post_header h5 a, .post_header h3 a, .post_header.grid h6 a
{
	color: <?php echo $pp_h1_font_color; ?>;
}
<?php
}
?>

<?php
	$pp_hr_color = get_option('pp_hr_color');

	if(!empty($pp_hr_color))
	{
	
?>
#social_share_wrapper, hr, #social_share_wrapper, .post.type-post, #page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, h5.widgettitle, .comment .right, .widget_tag_cloud div a, .meta-tags a, .tag_cloud a, #footer, #post_more_wrapper, .woocommerce ul.products li.product, .woocommerce-page ul.products li.product, .woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price
{
	border-color: <?php echo $pp_hr_color; ?>;
}
.woocommerce div.product .woocommerce-tabs ul.tabs li, .woocommerce #content div.product .woocommerce-tabs ul.tabs li, .woocommerce-page div.product .woocommerce-tabs ul.tabs li, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li, .woocommerce div.product .woocommerce-tabs .panel, .woocommerce-page div.product .woocommerce-tabs .panel, .woocommerce #content div.product .woocommerce-tabs .panel, .woocommerce-page #content div.product .woocommerce-tabs .panel, .woocommerce table.shop_table, .woocommerce-page table.shop_table, table tr td, .woocommerce .cart-collaterals .cart_totals, .woocommerce-page .cart-collaterals .cart_totals, .woocommerce .cart-collaterals .shipping_calculator, .woocommerce-page .cart-collaterals .shipping_calculator, .woocommerce .cart-collaterals .cart_totals tr td, .woocommerce .cart-collaterals .cart_totals tr th, .woocommerce-page .cart-collaterals .cart_totals tr td, .woocommerce-page .cart-collaterals .cart_totals tr th, table tr th, .woocommerce #payment, .woocommerce-page #payment, .woocommerce #payment ul.payment_methods li, .woocommerce-page #payment ul.payment_methods li, .woocommerce #payment div.form-row, .woocommerce-page #payment div.form-row
{
	border-color: <?php echo $pp_hr_color; ?> !important;
}
<?php
	}
?>

<?php
	$pp_sidebar_font_color = get_option('pp_sidebar_font_color');
	
	if(!empty($pp_sidebar_font_color))
	{
?>
#page_content_wrapper .inner .sidebar_wrapper .sidebar .content { color:<?php echo $pp_sidebar_font_color; ?>; }
<?php
	}
?>

<?php
	$pp_sidebar_link_color = get_option('pp_sidebar_link_color');
	
	if(!empty($pp_sidebar_link_color))
	{
?>
#page_content_wrapper .inner .sidebar_wrapper a, #post_more_close i.fa { color:<?php echo $pp_sidebar_link_color; ?>; }
<?php
	}
?>

<?php
	$pp_sidebar_hover_link_color = get_option('pp_sidebar_hover_link_color');
	
	if(!empty($pp_sidebar_hover_link_color))
	{
?>
#page_content_wrapper .inner .sidebar_wrapper a:hover, #page_content_wrapper .inner .sidebar_wrapper a:active { color:<?php echo $pp_sidebar_hover_link_color; ?>; }
<?php
	}
?>

<?php
	$pp_footer_bg_color = get_option('pp_footer_bg_color');
	
	if(!empty($pp_footer_bg_color))
	{
?>
#footer { background:<?php echo $pp_footer_bg_color; ?>; }
<?php
	}
?>

<?php
	$pp_footer_header_color = get_option('pp_footer_header_color');
	
	if(!empty($pp_footer_header_color))
	{
?>
#footer .sidebar_widget li h2.widgettitle { color:<?php echo $pp_footer_header_color; ?>; }
<?php
	}
?>

<?php
	$pp_footer_font_color = get_option('pp_footer_font_color');
	
	if(!empty($pp_sidebar_font_color))
	{
?>
#footer { color:<?php echo $pp_footer_font_color; ?>; }
<?php
	}
?>

<?php
	$pp_footer_link_color = get_option('pp_footer_link_color');
	
	if(!empty($pp_footer_link_color))
	{
?>
#footer a { color:<?php echo $pp_footer_link_color; ?>; }
<?php
	}
?>

<?php
	$pp_footer_hover_link_color = get_option('pp_footer_hover_link_color');
	
	if(!empty($pp_footer_hover_link_color))
	{
?>
#footer a:hover, #footer a:active { color:<?php echo $pp_footer_hover_link_color; ?>; }
<?php
	}
?>

<?php
	$pp_copyright_bg_color = get_option('pp_copyright_bg_color');
	
	if(!empty($pp_footer_bg_color))
	{
?>
.footer_bar { background:<?php echo $pp_copyright_bg_color; ?>; }
<?php
	}
?>

<?php
	$pp_copyright_font_color = get_option('pp_copyright_font_color');
	
	if(!empty($pp_copyright_font_color))
	{
?>
#copyright { color:<?php echo $pp_copyright_font_color; ?>; }
<?php
	}
?>

<?php
	$pp_copyright_link_color = get_option('pp_copyright_link_color');
	
	if(!empty($pp_copyright_link_color))
	{
?>
#copyright a { color:<?php echo $pp_copyright_link_color; ?>; }
<?php
	}
?>

<?php
	$pp_copyright_hover_color = get_option('pp_copyright_hover_color');
	
	if(!empty($pp_copyright_hover_color))
	{
?>
#copyright a:hover, #copyright a:active { color:<?php echo $pp_copyright_hover_color; ?>; }
<?php
	}
?>

<?php
	$pp_input_bg_color = get_option('pp_input_bg_color');

	if(!empty($pp_input_bg_color))
	{
	
?>
input[type=text], input[type=password], .woocommerce table.cart td.actions .coupon .input-text, .woocommerce-page table.cart td.actions .coupon .input-text, .woocommerce #content table.cart td.actions .coupon .input-text, .woocommerce-page #content table.cart td.actions .coupon .input-text, textarea
{
	background: <?php echo $pp_input_bg_color; ?>;
}
<?php
	}
?>

<?php
	$pp_input_font_color = get_option('pp_input_font_color');

	if(!empty($pp_input_font_color))
	{
	
?>
input[type=text], input[type=password], .woocommerce table.cart td.actions .coupon .input-text, .woocommerce-page table.cart td.actions .coupon .input-text, .woocommerce #content table.cart td.actions .coupon .input-text, .woocommerce-page #content table.cart td.actions .coupon .input-text, textarea
{
	color: <?php echo $pp_input_font_color; ?>;
}
<?php
	}
?>

<?php
	$pp_input_border_color = get_option('pp_input_border_color');

	if(!empty($pp_input_border_color))
	{
	
?>
input[type=text], input[type=password], .woocommerce table.cart td.actions .coupon .input-text, .woocommerce-page table.cart td.actions .coupon .input-text, .woocommerce #content table.cart td.actions .coupon .input-text, .woocommerce-page #content table.cart td.actions .coupon .input-text, textarea
{
	border-color: <?php echo $pp_input_border_color; ?>;
}
.woocommerce table.cart td.actions .coupon .input-text#coupon_code
{
	border-color: <?php echo $pp_input_border_color; ?> !important;
}
<?php
	}
?>

<?php
	$pp_input_focus_border_color = get_option('pp_input_focus_border_color');

	if(!empty($pp_input_border_color))
	{
	
?>
input[type=text]:focus, input[type=password]:focus, .woocommerce table.cart td.actions .coupon .input-text:focus, .woocommerce-page table.cart td.actions .coupon .input-text:focus, .woocommerce #content table.cart td.actions .coupon .input-text:focus, .woocommerce-page #content table.cart td.actions .coupon .input-text:focus, textarea:focus
{
	border-color: <?php echo $pp_input_focus_border_color; ?>;
}
<?php
	}
?>

<?php
	$pp_button_bg_color = get_option('pp_button_bg_color');
	
	if(!empty($pp_button_bg_color))
	{
?>
input[type=submit], input[type=button], a.button, .button, #toTop:hover{ 
	background: <?php echo $pp_button_bg_color; ?>;
}
.widget_tag_cloud div a:hover, .meta-tags a:hover, #footer .widget_tag_cloud div a:hover, #footer .meta-tags a:hover, .tag_cloud a:hover, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit, .woocommerce #content input.button, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button, .woocommerce-page #respond input#submit, .woocommerce-page #content input.button, .woocommerce .widget_shopping_cart .widget_shopping_cart_content a.button, .woocommerce table.cart td.actions .button.alt.checkout-button, .woocommerce #payment #place_order, .woocommerce-page #payment #place_order, .woocommerce table.cart td.actions .button.alt {
	background: <?php echo $pp_button_bg_color; ?> !important;
}
.pagination span, .pagination a:hover
{
	background: <?php echo $pp_button_bg_color; ?> !important;
	border-color: <?php echo $pp_button_bg_color; ?>;
}
<?php
	}
	
?>

<?php
	$pp_button_font_color = get_option('pp_button_font_color');
	
	if(!empty($pp_button_font_color))
	{
?>
input[type=submit], input[type=button], a.button, .button { 
	color: <?php echo $pp_button_font_color; ?>;
}
.widget_tag_cloud div a:hover, .meta-tags a:hover, #footer .widget_tag_cloud div a:hover, #footer .meta-tags a:hover, .tag_cloud a:hover, .woocommerce-page ul.products li.product a.add_to_cart_button.loading, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit, .woocommerce #content input.button, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button, .woocommerce-page #respond input#submit, .woocommerce-page #content input.button, .woocommerce .widget_shopping_cart .widget_shopping_cart_content a.button, .woocommerce table.cart td.actions .button.alt.checkout-button, .woocommerce #payment #place_order, .woocommerce-page #payment #place_order, .woocommerce table.cart td.actions .button.alt {
	color: <?php echo $pp_button_font_color; ?> !important;
}
<?php
	}
	
?>

<?php
	$pp_button_border_color = get_option('pp_button_border_color');
	
	if(!empty($pp_button_border_color))
	{
?>
input[type=submit], input[type=button], a.button, .button { 
	border: 1px solid <?php echo $pp_button_border_color; ?>;
}
.widget_tag_cloud div a:hover, .meta-tags a:hover, #footer .widget_tag_cloud div a:hover, #footer .meta-tags a:hover, .tag_cloud a:hover {
	border: 1px solid <?php echo $pp_button_border_color; ?> !important;
}
<?php
	}	
?>

<?php
	$pp_header_bg_color = get_option('pp_header_bg_color');

	if(!empty($pp_header_bg_color))
	{
	
?>
.above_top_bar
{
	background: <?php echo $pp_header_bg_color; ?>;
}
<?php
	}
?>

<?php
	$pp_header_border_color = get_option('pp_header_border_color');

	if(!empty($pp_header_border_color))
	{
	
?>
.above_top_bar, #nav_wrapper.header_style3, #nav_wrapper.header_style4
{
	border-color: <?php echo $pp_header_border_color; ?>;
}
<?php
	}
?>

<?php
	$pp_header_font_color = get_option('pp_header_font_color');

	if(!empty($pp_header_font_color))
	{
	
?>
.above_top_bar
{
	color: <?php echo $pp_header_font_color; ?>;
}
<?php
	}
?>

<?php
	$pp_filterable_bg_color = get_option('pp_filterable_bg_color');

	if(!empty($pp_filterable_bg_color))
	{
	
?>
.filter, .shop_filter
{
	background: <?php echo $pp_filterable_bg_color; ?>;
}
<?php
	}
?>

<?php
	$pp_filterable_font_color = get_option('pp_filterable_font_color');

	if(!empty($pp_filterable_font_color))
	{
	
?>
.filter li a, .shop_filter li a, .filter li a:hover, .shop_filter li a:hover
{
	color: <?php echo $pp_filterable_font_color; ?>;
}
<?php
	}
?>

<?php
	$pp_filterable_active_color = get_option('pp_filterable_active_color');

	if(!empty($pp_filterable_active_color))
	{
	
?>
.filter li a.active, .shop_filter li a.active
{
	color: <?php echo $pp_filterable_active_color; ?>;
}
<?php
	}
?>

<?php
	$pp_filterable_font = get_option('pp_filterable_font');
	
	if(!empty($pp_filterable_font))
	{
?>
.filter li a, .shop_filter li a { font-family: '<?php echo urldecode($pp_filterable_font); ?>'; }		
<?php
	}
?>

<?php
	$pp_filterable_font_size = get_option('pp_filterable_font_size');
	
	if(!empty($pp_filterable_font_size))
	{
?>
.filter li a, .shop_filter li a { font-size:<?php echo $pp_filterable_font_size; ?>px; }
<?php
	}
?>

<?php
	$pp_portfolio_info_bg_color = get_option('pp_portfolio_info_bg_color');

	if(!empty($pp_portfolio_info_bg_color))
	{
	
?>
div.thumb_content
{
	background: <?php echo $pp_portfolio_info_bg_color; ?> !important;
}
<?php
	}
?>

<?php
	$pp_portfolio_info_font_color = get_option('pp_portfolio_info_font_color');

	if(!empty($pp_portfolio_info_font_color))
	{
	
?>
div.thumb_content h3, div.thumb_content h4, div.thumb_content h5, div.thumb_content h6, div.thumb_content span
{
	color: <?php echo $pp_portfolio_info_font_color; ?> !important;
}
<?php
	}
?>

<?php
	$pp_portfolio_hover_bg_color = get_option('pp_portfolio_hover_bg_color');

	if(!empty($pp_portfolio_hover_bg_color))
	{
	
?>
.mask .mask_circle
{
	background: <?php echo $pp_portfolio_hover_bg_color; ?> !important;
}
<?php
	}
?>

<?php
	$pp_portfolio_hover_icon_color = get_option('pp_portfolio_hover_icon_color');

	if(!empty($pp_portfolio_hover_icon_color))
	{
	
?>
.mask .mask_circle i
{
	color: <?php echo $pp_portfolio_hover_icon_color; ?> !important;
}
<?php
	}
?>

<?php
	$pp_pricing_header_bg_color = get_option('pp_pricing_header_bg_color');

	if(!empty($pp_pricing_header_bg_color))
	{
	
?>
.pricing_wrapper li.title_row, .pricing_wrapper li.price_row
{
	background: <?php echo $pp_pricing_header_bg_color; ?>;
}
<?php
	}
?>

<?php
	$pp_pricing_header_font_color = get_option('pp_pricing_header_font_color');

	if(!empty($pp_pricing_header_font_color))
	{
	
?>
.pricing_wrapper li.title_row, .pricing_wrapper li.price_row
{
	color: <?php echo $pp_pricing_header_font_color; ?>;
}
<?php
	}
?>

<?php
	$pp_pricing_header_font = get_option('pp_pricing_header_font');
	
	if(!empty($pp_pricing_header_font))
	{
?>
.pricing_wrapper li.title_row, .pricing_wrapper li.price_row { font-family: '<?php echo urldecode($pp_pricing_header_font); ?>'; }		
<?php
	}
?>

<?php
	$pp_pricing_border_color = get_option('pp_pricing_border_color');

	if(!empty($pp_pricing_border_color))
	{
	
?>
.pricing_wrapper li
{
	border-color: <?php echo $pp_pricing_border_color; ?>;
}
<?php
	}
?>

<?php
	$pp_pricing_featured_header_bg_color = get_option('pp_pricing_featured_header_bg_color');

	if(!empty($pp_pricing_featured_header_bg_color))
	{
	
?>
.pricing_wrapper li.title_row.featured
{
	background: <?php echo $pp_pricing_featured_header_bg_color; ?>;
}
<?php
	}
?>

<?php
	$pp_service_icon1_bg_color = get_option('pp_service_icon1_bg_color');

	if(!empty($pp_service_icon1_bg_color))
	{
	
?>
.service_icon
{
	background: <?php echo $pp_service_icon1_bg_color; ?>;
}
<?php
	}
?>

<?php
	$pp_service_icon1_font_color = get_option('pp_service_icon1_font_color');

	if(!empty($pp_service_icon1_font_color))
	{
	
?>
.service_icon i
{
	color: <?php echo $pp_service_icon1_font_color; ?>;
}
<?php
	}
?>

<?php
	$pp_service_icon2_bg_color = get_option('pp_service_icon2_bg_color');

	if(!empty($pp_service_icon2_bg_color))
	{
	
?>
.service_wrapper.center .service_icon
{
	background: <?php echo $pp_service_icon2_bg_color; ?>;
}
<?php
	}
?>

<?php
	$pp_service_icon2_font_color = get_option('pp_service_icon2_font_color');

	if(!empty($pp_service_icon2_font_color))
	{
	
?>
.service_wrapper.center .service_icon i
{
	color: <?php echo $pp_service_icon2_font_color; ?>;
}
<?php
	}
?>

<?php
	$pp_team_info_bg_color = get_option('pp_team_info_bg_color');

	if(!empty($pp_team_info_bg_color))
	{
	
?>
.post_img.animate div.thumb_content
{
	background: <?php echo $pp_team_info_bg_color; ?> !important;
}
<?php
	}
?>

<?php
	$pp_team_info_font_color = get_option('pp_team_info_font_color');

	if(!empty($pp_team_info_font_color))
	{
	
?>
.post_img.animate div.thumb_content
{
	color: <?php echo $pp_team_info_font_color; ?>;
}
<?php
	}
?>

<?php
	$pp_social_share_bg_color = get_option('pp_social_share_bg_color');

	if(!empty($pp_social_share_bg_color))
	{
	
?>
#social_share_wrapper, .social_share_wrapper
{
	background: <?php echo $pp_social_share_bg_color; ?>;
}
<?php
	}
?>

<?php
	$pp_shop_highlight_color = get_option('pp_shop_highlight_color');

	if(!empty($pp_shop_highlight_color))
	{
	
?>
.woocommerce span.onsale, .woocommerce-page span.onsale
{
	background: <?php echo $pp_shop_highlight_color; ?> !important;
}
.woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price, .woocommerce #content div.product p.price, .woocommerce #content div.product span.price, .woocommerce div.product p.price, .woocommerce div.product span.price, .woocommerce-page #content div.product p.price, .woocommerce-page #content div.product span.price, .woocommerce-page div.product p.price, .woocommerce-page div.product span.price
{
	color: <?php echo $pp_shop_highlight_color; ?> !important;
}
<?php
	}
?>

<?php
	$pp_social_share_font_color = get_option('pp_social_share_font_color');

	if(!empty($pp_social_share_font_color))
	{
	
?>
#social_share_wrapper ul li i, .social_share_wrapper.shortcode ul li i, #social_share_wrapper h5, .social_share_wrapper.shortcode h5, #social_share_wrapper a, .social_share_wrapper.shortcode a
{
	color: <?php echo $pp_social_share_font_color; ?>;
}
<?php
	}
?>

<?php
	//Get content layout
	if(isset($_SESSION['pp_layout']) && !empty($_SESSION['pp_layout']))
	{
		$pp_layout = $_SESSION['pp_layout'];
	}
	else
	{
		$pp_layout = get_option('pp_layout');
	}
	
	if($pp_layout=='boxed')
	{
?>
#wrapper, .footer_bar { width: 1020px; margin: auto; float: none; }
body[data-style=fullscreen] #wrapper, body[data-style=flip] #wrapper, body[data-style=flow] #wrapper, body[data-style=fullscreen_video] #wrapper { width: 100%; }
.top_bar.fixed { width: 1020px; }

@media only screen and (min-width: 768px) and (max-width: 960px) {
	#wrapper, .footer_bar { width: 100%; }
}

@media only screen and (max-width: 767px) {
	#wrapper, .footer_bar { width: 100%; }
}

.footer_bar { margin-top: -15px; }
body { background: #d6d6d6; background-position: center center; }

	<?php
		if(isset($_SESSION['pp_boxed_bg_image']) && !empty($_SESSION['pp_boxed_bg_image']))
		{
			$pp_boxed_bg_image = $_SESSION['pp_boxed_bg_image'];
		}
		else
		{
			$pp_boxed_bg_image = get_option('pp_boxed_bg_image');
		}
	
		if(!empty($pp_boxed_bg_image))
		{
	?>
	body
	{
		background-image: url('<?php echo $pp_boxed_bg_image; ?>');
		background-size: contain;
	}
	<?php
		}
	?>
	
	<?php
		$pp_boxed_bg_image_cover = get_option('pp_boxed_bg_image_cover');
	
		if(!empty($pp_boxed_bg_image_cover))
		{
	?>
	body
	{
		background-size: cover !important;
		background-attachment:fixed;
	}
	<?php
		}
	?>
	
	<?php
		$pp_boxed_bg_image_repeat = get_option('pp_boxed_bg_image_repeat');
	
		if(empty($pp_boxed_bg_image_repeat))
		{
			$pp_boxed_bg_image_repeat = 'no-repeat';
		}
	?>
	body
	{
		background-repeat: <?php echo $pp_boxed_bg_image_repeat; ?>;
	}

	<?php
		$pp_boxed_bg_color = get_option('pp_boxed_bg_color');
	
		if(!empty($pp_boxed_bg_color))
		{
	?>
	body
	{
		background-color: <?php echo $pp_boxed_bg_color; ?>;
	}
	<?php
		}
	?>
	
<?php
	} //End if boxed layout
?>

<?php
	$pp_mobile_menu_bg_color = get_option('pp_mobile_menu_bg_color');

	if(!empty($pp_mobile_menu_bg_color))
	{
	
?>
.mobile_menu_wrapper, body.js_nav
{
	background: <?php echo $pp_mobile_menu_bg_color; ?>;
}
<?php
	}
?>

<?php
	$pp_mobile_menu_font_color = get_option('pp_mobile_menu_font_color');

	if(!empty($pp_mobile_menu_font_color))
	{
	
?>
.mobile_main_nav li a
{
	color: <?php echo $pp_mobile_menu_font_color; ?> !important;
}
<?php
	}
?>

<?php
	$pp_mobile_menu_hover_font_color = get_option('pp_mobile_menu_hover_font_color');

	if(!empty($pp_mobile_menu_hover_font_color))
	{
	
?>
.mobile_main_nav li a:hover
{
	background: <?php echo $pp_mobile_menu_hover_font_color; ?>;
	color: #ffffff;
}
<?php
	}
?>

<?php
	$pp_mobile_menu_border_color = get_option('pp_mobile_menu_border_color');

	if(!empty($pp_mobile_menu_border_color))
	{
	
?>
.mobile_main_nav li
{
	border-color: <?php echo $pp_mobile_menu_border_color; ?>;
}
<?php
	}
?>

<?php
	$pp_mobile_menu_upper = get_option('pp_mobile_menu_upper');

	if(!empty($pp_mobile_menu_upper))
	{
	
?>
.mobile_main_nav li a
{
	text-transform: uppercase;
}
<?php
	}
?>

<?php
	$pp_mobile_menu_bold = get_option('pp_mobile_menu_bold');

	if(!empty($pp_mobile_menu_bold))
	{
	
?>
.mobile_main_nav li a
{
	font-weight: bold;
}
<?php
	}
?>

<?php
	//If enable animation
	$pp_animation = get_option('pp_animation');
	
	if(empty($pp_animation))
	{
?>
.animated { visibility: visible !important; }
<?php
	}
?>

<?php
	//If disble animation on mobile
	$pp_disable_mobile_animation = get_option('pp_disable_mobile_animation');
	
	if(!empty($pp_disable_mobile_animation))
	{
?>
@media only screen and (max-width: 767px) {
	.fadeIn, .fade-in, #supersized, #blog_grid_wrapper .post.type-post, .gallery_img, .animated { opacity: 1 !important; visibility: visible !important; }
.isotope-item { z-index: 2 !important; }

.isotope-hidden.isotope-item { pointer-events: none; display: none; z-index: 1 !important; }
}
<?php
	}
?>

<?php
/**
*	Get custom CSS
**/
$pp_custom_css = get_option('pp_custom_css');


if(!empty($pp_custom_css))
{
    echo stripslashes($pp_custom_css);
}
?>

<?php
if(!empty($pp_advance_combine_css))
{
	ob_end_flush();
	ob_end_flush();
}
?>