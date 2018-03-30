<?php header("Content-type: text/css; charset: UTF-8"); ?> 

<?php
require_once( '../../../../wp-load.php' );
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
.transparentbg
{
	background: <?php echo $ori_pp_content_color; ?>;
	background: rgb(<?php echo $pp_content_color['r']; ?>, <?php echo $pp_content_color['g']; ?>, <?php echo $pp_content_color['b']; ?>, <?php echo $pp_content_opacity_color; ?>);
	background: rgba(<?php echo $pp_content_color['r']; ?>, <?php echo $pp_content_color['g']; ?>, <?php echo $pp_content_color['b']; ?>, <?php echo $pp_content_opacity_color; ?>);
}

@media only screen and (max-width: 768px) {
	#nav_wrapper
	{
		background: <?php echo $ori_pp_content_color; ?>;
		background: rgb(<?php echo $pp_content_color['r']; ?>, <?php echo $pp_content_color['g']; ?>, <?php echo $pp_content_color['b']; ?>, <?php echo $pp_content_opacity_color; ?>);
		background: rgba(<?php echo $pp_content_color['r']; ?>, <?php echo $pp_content_color['g']; ?>, <?php echo $pp_content_color['b']; ?>, <?php echo $pp_content_opacity_color; ?>);
	}
}
<?php
	}
?>

<?php
	$pp_h1_font_color = get_option('pp_h1_font_color');
	if(!empty($pp_h1_font_color))
	{
?>
.post_header h2, h1, h2, h3, h4, h5, #page_caption h1, #page_content_wrapper .sidebar .content .sidebar_widget li h2, #contact_form label, #commentform label, #page_content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, .post_date, .pagination span, .pagination a:hover
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
	$pp_button_bg_color = get_option('pp_button_bg_color');
	
	if(!empty($pp_button_bg_color))
	{
?>
input[type=submit], input[type=button], a.button, .button { 
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
input[type=submit], input[type=button], a.button, .button { 
	color: <?php echo $pp_button_font_color; ?>;
}
input[type=submit]:hover, input[type=button]:hover, a.button:hover, .button:hover
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
input[type=submit], input[type=button], a.button, .button { 
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
h1, h2, h3, h4, h5, h6, #gallery_caption h2, div.home_header, .nav li a, .nav_page_number li, #footer { font-family: '<?php echo $pp_font_family; ?>'; }		
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