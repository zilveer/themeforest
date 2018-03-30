<?php header("Content-type: text/css; charset: UTF-8"); ?> 

<?php
define('WP_DEBUG', false);
@ini_set('log_errors','On'); 
@ini_set('display_errors','Off'); 
require_once( '../../../../wp-load.php' );
?>

<?php
	//Hack animation CSS for Safari
	$current_browser = getBrowser();
	
	if(isset($current_browser['name']) && $current_browser['name'] != 'Apple Safari' && $current_browser['name'] != 'Google Chrome')
	{
?>
@-webkit-keyframes fadeIn { from { opacity:0; } to { opacity:0.99; } }
@-moz-keyframes fadeIn { from { opacity:0; } to { opacity:0.99; } }
@keyframes fadeIn { from { opacity:0; } to { opacity:0.99; } }
 
.fade-in {
    opacity:0;  
    -webkit-animation:fadeIn ease-in 1;  
    -moz-animation:fadeIn ease-in 1;
    animation:fadeIn ease-in 1;
 
    -webkit-animation-fill-mode:forwards; 
    -moz-animation-fill-mode:forwards;
    animation-fill-mode:forwards;
 
    -webkit-animation-duration:0.7s;
    -moz-animation-duration:0.7s;
    animation-duration:0.7s;
}
 
.fade-in.one {
	-webkit-animation-delay: 0.7s;
	-moz-animation-delay: 0.7s;
	animation-delay: 0.7s;
}

.fade-in.two {
	-webkit-animation-delay: 1.2s;
	-moz-animation-delay:1.2s;
	animation-delay: 1.2s;
}
 
.fade-in.three {
	-webkit-animation-delay: 1.6s;
	-moz-animation-delay: 1.6s;
	animation-delay: 1.6s;
}
#supersized { 
	opacity:0;  /* make things invisible upon start */
	-webkit-animation:fadeIn ease-in 1;  /* call our keyframe named fadeIn, use animattion ease-in and repeat it only 1 time */
	-moz-animation:fadeIn ease-in 1;
	animation:fadeIn ease-in 1;
	
	-webkit-animation-fill-mode:forwards;  /* this makes sure that after animation is done we remain at the last keyframe value (opacity: 1)*/
	-moz-animation-fill-mode:forwards;
	animation-fill-mode:forwards;
	
	-webkit-animation-duration:1s;
	-moz-animation-duration:1s;
	animation-duration:1s;
	
	-webkit-animation-delay: 1.2s;
	-moz-animation-delay: 1.2s;
	animation-delay: 1.2s;
}

#gallery_caption {
	opacity:0;  /* make things invisible upon start */
	-webkit-animation:fadeIn ease-in 1;  /* call our keyframe named fadeIn, use animattion ease-in and repeat it only 1 time */
	-moz-animation:fadeIn ease-in 1;
	animation:fadeIn ease-in 1;
	
	-webkit-animation-fill-mode:forwards;  /* this makes sure that after animation is done we remain at the last keyframe value (opacity: 1)*/
	-moz-animation-fill-mode:forwards;
	animation-fill-mode:forwards;
	
	-webkit-animation-duration:1s;
	-moz-animation-duration:1s;
	animation-duration:1s;
	
	-webkit-animation-delay: 1.2s;
	-moz-animation-delay: 1.2s;
	animation-delay: 1.2s;
}
<?php
	}
	else
	{
?>
.fade-in, #supersized, #gallery_caption { opacity: 1; }
<?php
	}
?>

<?php
	$pp_h1_font_color = get_option('pp_h1_font_color');
	if(!empty($pp_h1_font_color))
	{
?>
.post_header h2, h1, h2, h3, h4, h5, h6, h7, #page_caption h1, #page_content_wrapper .sidebar .content .sidebar_widget li h2, #contact_form label, #commentform label, #page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, .post_date, .pagination span, .pagination a:hover, #page_caption h2, .filter li a.active, .filter li a:hover
{
	color: <?php echo $pp_h1_font_color; ?> !important;
}
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
	$pp_page_header_font_size = get_option('pp_page_header_font_size');
	
	if(!empty($pp_page_header_font_size))
	{
?>
#page_caption h1 { font-size:<?php echo $pp_page_header_font_size; ?>px; }
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
	$pp_image_title_font_size = get_option('pp_image_title_font_size');
	
	if(!empty($pp_image_title_font_size))
	{
?>
#gallery_caption h2 { font-size:<?php echo $pp_image_title_font_size; ?>px; }
<?php
	}
	
?>

<?php
	$pp_link_color = get_option('pp_link_color');
	
	if(!empty($pp_link_color))
	{
?>
a { color:<?php echo $pp_link_color; ?>; }
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
#page_content_wrapper .inner .sidebar_wrapper a { color:<?php echo $pp_sidebar_link_color; ?>; }
<?php
	}
?>

<?php
	$pp_sidebar_hover_link_color = get_option('pp_sidebar_hover_link_color');
	
	if(!empty($pp_sidebar_link_color))
	{
?>
#page_content_wrapper .inner .sidebar_wrapper a:hover, #page_content_wrapper .inner .sidebar_wrapper a:active { color:<?php echo $pp_sidebar_hover_link_color; ?>; }
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
	$pp_button_bg_color = get_option('pp_button_bg_color');
	
	if(!empty($pp_button_bg_color))
	{
?>
input[type=submit], input[type=button], a.button, .button, #toTop:hover { 
	background: <?php echo $pp_button_bg_color; ?>;
}
.widget_tag_cloud div a:hover, .meta-tags a:hover, #footer .widget_tag_cloud div a:hover, #footer .meta-tags a:hover, .tag_cloud a:hover, .woocommerce ul.products li.product a.add_to_cart_button, .woocommerce-page ul.products li.product a.add_to_cart_button, .woocommerce ul.products li.product a.add_to_cart_button.loading, .woocommerce-page ul.products li.product a.add_to_cart_button.loading, .woocommerce ul.products li.product a.add_to_cart_button:hover, .woocommerce-page ul.products li.product a.add_to_cart_button:hover, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit, .woocommerce #content input.button, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button, .woocommerce-page #respond input#submit, .woocommerce-page #content input.button, .woocommerce .widget_shopping_cart .widget_shopping_cart_content a.button, .woocommerce table.cart td.actions .button.alt.checkout-button, .woocommerce #payment #place_order, .woocommerce-page #payment #place_order, .woocommerce table.cart td.actions .button.alt {
	background: <?php echo $pp_button_bg_color; ?> !important;
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
input[type=submit]:hover, input[type=button]:hover, a.button:hover, .button:hover
{
	color: <?php echo $pp_button_font_color; ?> !important;
}
.widget_tag_cloud div a:hover, .meta-tags a:hover, #footer .widget_tag_cloud div a:hover, #footer .meta-tags a:hover, .tag_cloud a:hover, .woocommerce ul.products li.product a.add_to_cart_button, .woocommerce-page ul.products li.product a.add_to_cart_button, .woocommerce ul.products li.product a.add_to_cart_button.loading, .woocommerce-page ul.products li.product a.add_to_cart_button.loading, .woocommerce ul.products li.product a.add_to_cart_button:hover, .woocommerce-page ul.products li.product a.add_to_cart_button:hover, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit, .woocommerce #content input.button, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button, .woocommerce-page #respond input#submit, .woocommerce-page #content input.button, .woocommerce .widget_shopping_cart .widget_shopping_cart_content a.button, .woocommerce table.cart td.actions .button.alt.checkout-button, .woocommerce #payment #place_order, .woocommerce-page #payment #place_order, .woocommerce table.cart td.actions .button.alt {
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

$pp_h1_font_color = get_option('pp_h1_font_color');
if(!empty($pp_h1_font_color))
{
?>
.post_header h2, h1, h2, h3, h4, h5, .portfolio_header h6, pre, code, tt
{
	color: <?php echo $pp_h1_font_color; ?>;
}
<?php
}
if(isset($_SESSION['pp_font_family']))
{
    $pp_font_family = $_SESSION['pp_font_family'];
}
else
{
    $pp_font_family = get_option('pp_font_family');
}

if(!empty($pp_font_family))
{
?>
h1, h2, h3, h4, h5, h6, #gallery_caption h2, #menu_wrapper .nav ul li a, #menu_wrapper div .nav li a, #copyright, .fancybox-title-outside-wrap { font-family: '<?php echo $pp_font_family; ?>' !important; }		
<?php
}

$pp_menu_lower = get_option('pp_menu_lower');

if(!empty($pp_menu_lower))
{
?>
.nav li a, #menu_close { text-transform: none; }		
<?php
}

$pp_menu_font_color = get_option('pp_menu_font_color');

if(!empty($pp_menu_font_color))
{
?>
#menu_wrapper .nav ul li a, #menu_wrapper div .nav li a { color: <?php echo $pp_menu_font_color; ?>; }
<?php
}

$pp_submenu_font_color = get_option('pp_submenu_font_color');

if(!empty($pp_submenu_font_color))
{
?>
#menu_wrapper div .nav li ul li a, #menu_wrapper div .nav li.current-menu-item ul li a, #menu_wrapper div .nav li ul li.current-menu-item a, #menu_wrapper .nav ul li ul li a, #menu_wrapper .nav ul li.current-menu-item ul li a, #menu_wrapper .nav ul li ul li.current-menu-item a, #menu_wrapper div .nav li.current-menu-parent ul li a, #menu_wrapper div .nav li ul li.current-menu-parent a { color: <?php echo $pp_submenu_font_color; ?>;  }
<?php
}

$pp_menu_hover_font_color = get_option('pp_menu_hover_font_color');

if(!empty($pp_menu_hover_font_color))
{
?>
#menu_wrapper .nav ul li a.hover, #menu_wrapper .nav ul li a:hover, #menu_wrapper div .nav li a.hover, #menu_wrapper div .nav li a:hover, #menu_wrapper .nav ul li ul li a:hover, #menu_wrapper .nav ul li ul li a:hover, #menu_wrapper div .nav li ul li a:hover, #menu_wrapper div .nav li ul li a:hover, #menu_wrapper div .nav li.current-menu-item ul li a:hover, #menu_wrapper div .nav li.current-menu-parent ul li a:hover { color: <?php echo $pp_menu_hover_font_color; ?>;  }
#menu_wrapper .nav ul li a.hover, #menu_wrapper .nav ul li a:hover, #menu_wrapper div .nav li a.hover, #menu_wrapper div .nav li a:hover, #menu_wrapper div .nav li.current-menu-item > a, #menu_wrapper div .nav li.current-menu-parent > a, #menu_wrapper div .nav li.current-menu-ancestor > a, #menu_wrapper div .nav li ul li.current-menu-ancestor a
{
	border-color: <?php echo $pp_menu_hover_font_color; ?>;
}
<?php
}

$pp_menu_active_font_color = get_option('pp_menu_active_font_color');

if(!empty($pp_menu_active_font_color))
{
?>
#menu_wrapper div .nav li.current-menu-item > a, #menu_wrapper div .nav li.current-menu-parent > a, #menu_wrapper div .nav li.current-menu-ancestor > a { color: <?php echo $pp_menu_active_font_color; ?>;  }
<?php
}

$pp_font_color = get_option('pp_font_color');

if(!empty($pp_font_color))
{
?>
body { color: <?php echo $pp_font_color; ?>; }
<?php
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
	$pp_submenu_bg_color = get_option('pp_submenu_bg_color');
	$ori_pp_submenu_bg_color = $pp_submenu_bg_color;

	if(!empty($pp_submenu_bg_color))
	{
		$pp_menu_opacity_color = get_option('pp_menu_opacity_color');
		$pp_menu_opacity_color = $pp_menu_opacity_color/100;
		$pp_submenu_bg_color = HexToRGB($pp_submenu_bg_color);
?>
#menu_wrapper .nav ul li ul, #menu_wrapper div .nav li ul
{
	background: <?php echo $ori_pp_submenu_bg_color; ?>;
	background: rgb(<?php echo $pp_submenu_bg_color['r']; ?>, <?php echo $pp_submenu_bg_color['g']; ?>, <?php echo $pp_submenu_bg_color['b']; ?>, <?php echo $pp_menu_opacity_color; ?>);
	background: rgba(<?php echo $pp_submenu_bg_color['r']; ?>, <?php echo $pp_submenu_bg_color['g']; ?>, <?php echo $pp_submenu_bg_color['b']; ?>, <?php echo $pp_menu_opacity_color; ?>);
}
<?php
	}
?>

<?php
	$pp_submenu_border_color = get_option('pp_submenu_border_color');

	if(!empty($pp_submenu_border_color))
	{
	
?>
#menu_wrapper div .nav li ul li a, #menu_wrapper div .nav li.current-menu-item ul li a, #menu_wrapper div .nav li ul li.current-menu-item a,#menu_wrapper .nav ul li ul li a, #menu_wrapper .nav ul li.current-menu-item ul li a, #menu_wrapper .nav ul li ul li.current-menu-item a, #menu_wrapper div .nav li.current-menu-parent ul li a, #menu_wrapper div .nav li ul li.current-menu-parent a, #menu_wrapper .nav ul li ul li a, #menu_wrapper div .nav li ul li a, #menu_wrapper div .nav li.current-menu-parent ul li a, #menu_wrapper .nav ul li ul li a:hover, #menu_wrapper .nav ul li ul li a:hover, #menu_wrapper div .nav li ul li a:hover, #menu_wrapper div .nav li ul li a:hover, #menu_wrapper div .nav li.current-menu-item ul li a:hover, #menu_wrapper div .nav li.current-menu-parent ul li a:hover
{
	border-color: <?php echo $pp_submenu_border_color; ?>;
}
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
	color: <?php echo $pp_submenu_hover_font_color; ?>;
}
<?php
	}
?>

<?php
	$pp_portfolio_hover_bg_color = get_option('pp_portfolio_hover_bg_color');
	$pp_portfolio_hover_bg_color_rgb = HexToRGB($pp_portfolio_hover_bg_color);

	if(!empty($pp_portfolio_hover_bg_color))
	{
	
?>
.one_half.gallery2 .mask, .one_third.gallery3 .mask, .one_fourth.gallery4 .mask, .wall_thumbnail .mask, .mansory_thumbnail .mask
{
	background: <?php echo $pp_portfolio_hover_bg_color; ?>;
	background-color: rgba(<?php echo $pp_portfolio_hover_bg_color_rgb['r']; ?>,<?php echo $pp_portfolio_hover_bg_color_rgb['g']; ?>,<?php echo $pp_portfolio_hover_bg_color_rgb['b']; ?>, 0.7);
}
<?php
	}
?>

<?php
	$pp_portfolio_hover_font_color = get_option('pp_portfolio_hover_font_color');

	if(!empty($pp_portfolio_hover_font_color))
	{
	
?>
.one_half.gallery2 h4, .one_half.gallery2 span.caption, .one_third.gallery3 h5, .one_third.gallery3 span.caption, .one_fourth.gallery4 h6, .one_fourth.gallery4 span.caption, .wall_thumbnail h6, .wall_thumbnail span.caption, .mansory_thumbnail h6, .mansory_thumbnail span.caption
{
	color: <?php echo $pp_portfolio_hover_font_color; ?>;
}
<?php
	}
?>

<?php
	$pp_content_bg_color = get_option('pp_content_bg_color');

	if($pp_content_bg_color == 'light')
	{
	
?>
#supersized_overlay
{
	background: transparent url('<?php echo get_template_directory_uri(); ?>/images/fff_90.png') repeat;
}
.portfolio_desc { background: #fff; }
.portfolio_desc { background: rgba(256,256,256,256.6); }
.footer_bar { background: #fff; background: rgba(0,0,0,0.8);  }
input[type=text], input[type=password], .woocommerce table.cart td.actions .coupon .input-text, .woocommerce-page table.cart td.actions .coupon .input-text, .woocommerce #content table.cart td.actions .coupon .input-text, .woocommerce-page #content table.cart td.actions .coupon .input-text, textarea
{
	background: #ddd;
	border-color: #ddd !important;
	color: #777;
}
.woocommerce table.shop_table th, .woocommerce-page table.shop_table th
{
	background: #ddd;
	border-color: #ddd;
}

<?php
	}
	else
	{
?>
#supersized_overlay
{
	background: transparent url('<?php echo get_template_directory_uri(); ?>/images/000_70.png') repeat;
}
.portfolio_desc { background: #000; }
.portfolio_desc { background: rgba(0,0,0,0.6); }
.footer_bar { background:#000; background: rgba(0,0,0,0.6);  }
input[type=text], input[type=password], .woocommerce table.cart td.actions .coupon .input-text, .woocommerce-page table.cart td.actions .coupon .input-text, .woocommerce #content table.cart td.actions .coupon .input-text, .woocommerce-page #content table.cart td.actions .coupon .input-text, textarea
{
	background: rgba(0, 0, 0, 0.9);
	color: #999;
}
.woocommerce table.shop_table th, .woocommerce-page table.shop_table th
{
	background: #222;
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