<style type="text/css">

<?php
	$pp_logo_margin_left = get_option('pp_logo_margin_left');
	if(!empty($pp_logo_margin_left))
	{
?>
.logo_wrapper img
{
	margin-left: <?php echo $pp_logo_margin_left; ?>px;
}
<?php
	}
?>

<?php
	$pp_logo_margin_top = get_option('pp_logo_margin_top');
	if(!empty($pp_logo_margin_top))
	{
?>
.logo_wrapper img
{
	margin-top: <?php echo $pp_logo_margin_top; ?>px;
}
<?php
	}
?>

<?php
	$pp_logo_margin_right = get_option('pp_logo_margin_right');
	if(!empty($pp_logo_margin_right))
	{
?>
.logo_wrapper img
{
	margin-right: <?php echo $pp_logo_margin_right; ?>px;
}
<?php
	}
?>

<?php
	$pp_frame_color = get_option('pp_frame_color');
	if(!empty($pp_frame_color))
	{
?>
.top_bar, .footer_bar, .left_bar, .right_bar, .nav li ul
{
	background-color: <?php echo $pp_frame_color; ?>;
}
<?php
	}
?>

<?php
	$pp_content_color = get_option('pp_content_color');
	$ori_pp_content_color = $pp_content_color;
	if(!empty($pp_content_color))
	{
		$pp_content_opacity_color = get_option('pp_content_opacity_color');
		$pp_content_opacity_color = $pp_content_opacity_color/100;
		$pp_content_color = HexToRGB($pp_content_color);
	
?>
#page_content_wrapper
{
	background: <?php echo $ori_pp_content_color; ?>;
	background: rgb(<?php echo $pp_content_color['r']; ?>, <?php echo $pp_content_color['g']; ?>, <?php echo $pp_content_color['b']; ?>, <?php echo $pp_content_opacity_color; ?>);
	background: rgba(<?php echo $pp_content_color['r']; ?>, <?php echo $pp_content_color['g']; ?>, <?php echo $pp_content_color['b']; ?>, <?php echo $pp_content_opacity_color; ?>);
}
<?php
	}
?>

<?php
	$pp_h1_font_color = get_option('pp_h1_font_color');
	if(!empty($pp_h1_font_color))
	{
?>
.post_header h2, h1, h2, h3, h4, h5, #page_caption h1, #page_content_wrapper .sidebar .content .sidebar_widget li h2, #contact_form label, #commentform label
{
	color: <?php echo $pp_h1_font_color; ?>;
}
<?php
	}
?>

<?php
	$pp_menu_font_size = get_option('pp_menu_font_size');
	
	if(!empty($pp_menu_font_size))
	{
?>
.nav li a { font-size:<?php echo $pp_menu_font_size; ?>px; }
<?php
	}
	
?>

<?php
	$pp_submenu_font_size = get_option('pp_submenu_font_size');
	
	if(!empty($pp_submenu_font_size))
	{
?>
.nav li ul li a { font-size:<?php echo $pp_submenu_font_size; ?>px; }
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
	$pp_button_bg_color = get_option('pp_button_bg_color');
	
	if(!empty($pp_button_bg_color))
	{
?>
input[type=submit], input[type=button], a.button { 
	background: <?php echo $pp_button_bg_color; ?>;
}
<?php
	}
	
?>

<?php
	$pp_button_font_color = get_option('pp_button_font_color');
	
	if(!empty($pp_button_font_color))
	{
?>
input[type=submit], input[type=button], a.button { 
	color: <?php echo $pp_button_font_color; ?>;
}
input[type=submit]:hover, input[type=button]:hover, a.button:hover
{
	color: <?php echo $pp_button_font_color; ?>;
}
<?php
	}
	
?>

<?php
	$pp_button_border_color = get_option('pp_button_border_color');
	
	if(!empty($pp_button_border_color))
	{
?>
input[type=submit], input[type=button], a.button { 
	border: 1px solid <?php echo $pp_button_border_color; ?>;
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
h1, h2, h3, h4, h5, h6, #kenburns_title, #kenburns_desc { font-family: '<?php echo $pp_font_family; ?>'; }		
<?php
}

$pp_menu_lower = get_option('pp_menu_lower');

if(!empty($pp_menu_lower))
{
?>
h1, h2, h3, h4, h5, h6, .nav li a, #gallery_title, #gallery_desc, .nav li a, .nav_page_number li { text-transform: none; }		
<?php
}

$pp_menu_font_color = get_option('pp_menu_font_color');

if(!empty($pp_menu_font_color))
{
?>
.nav li a, .nav_page_number li { color: <?php echo $pp_menu_font_color; ?>; }
<?php
}

$pp_active_menu_font_color = get_option('pp_active_menu_font_color');

if(!empty($pp_active_menu_font_color))
{
?>
.nav li.current-menu-item > a, .nav li > a:hover, .nav li > a.hover, .nav li > a:active, .nav li.current-menu-parent > a, .nav li.current-menu-item ul li a:hover, .nav li ul li a:hover, .nav li ul li:hover a, .nav li ul li.current-menu-item a { color: <?php echo $pp_active_menu_font_color; ?>; }
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
	$pp_portfolio_enable_gallery_info = get_option('pp_portfolio_enable_gallery_info');
	
	if(empty($pp_portfolio_enable_gallery_info))
	{
?>
#kenburns_title, #kenburns_desc { 
	display: none;
}
<?php
	}
	
?>

</style>