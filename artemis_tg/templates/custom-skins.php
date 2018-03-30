<style>
<?php
$custom_skin_arr = array();

wp_reset_query();
global $wpdb;

$pp_skins_obj = array();

$wpdb->query("SELECT * FROM `wp_options` WHERE `option_name` = '".$_SESSION['pp_skin']."'");
$pp_skins_obj = $wpdb->last_result;
$skin_settings_arr = unserialize($pp_skins_obj[0]->option_value);

foreach($skin_settings_arr['settings'] as $key => $skin_setting)
{
    if(!in_array($key, $pp_exclude_from_skin_arr))
    {
    	if(!empty($skin_setting))
    	{
    		$custom_skin_arr[$key] = $skin_setting;
    	}
    }
}

?>

<?php
	$pp_frame_color = $custom_skin_arr['pp_frame_color'];
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
	$pp_content_color = $custom_skin_arr['pp_content_color'];
	$ori_pp_content_color = $pp_content_color;
	if(!empty($pp_content_color))
	{
		$pp_content_opacity_color = $custom_skin_arr['pp_content_opacity_color'];
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
	$pp_h1_font_color = $custom_skin_arr['pp_h1_font_color'];
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
	$pp_link_color = $custom_skin_arr['pp_link_color'];
	
	if(!empty($pp_link_color))
	{
?>
a { color:<?php echo $pp_link_color; ?>; }
<?php
	}
	
?>

<?php
	$pp_hover_link_color = $custom_skin_arr['pp_hover_link_color'];
	
	if(!empty($pp_hover_link_color))
	{
?>
#page_content_wrapper a:hover, #page_content_wrapper a:active { color:<?php echo $pp_hover_link_color; ?>; }
<?php
	}
?>

<?php
	$pp_button_bg_color = $custom_skin_arr['pp_button_bg_color'];
	
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
	$pp_button_font_color = $custom_skin_arr['pp_button_font_color'];
	
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
	$pp_button_border_color = $custom_skin_arr['pp_button_border_color'];
	
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

$pp_h1_font_color = $custom_skin_arr['pp_h1_font_color'];
if(!empty($pp_h1_font_color))
{
?>
.post_header h2, h1, h2, h3, h4, h5, .portfolio_header h6, pre, code, tt
{
	color: <?php echo $pp_h1_font_color; ?>;
}
<?php
}

$pp_menu_font_color = $custom_skin_arr['pp_menu_font_color'];

if(!empty($pp_menu_font_color))
{
?>
.nav li a, .nav_page_number li { color: <?php echo $pp_menu_font_color; ?>; }
<?php
}

$pp_active_menu_font_color = $custom_skin_arr['pp_active_menu_font_color'];

if(!empty($pp_active_menu_font_color))
{
?>
.nav li.current-menu-item > a, .nav li > a:hover, .nav li > a.hover, .nav li > a:active, .nav li.current-menu-parent > a, .nav li.current-menu-item ul li a:hover, .nav li ul li a:hover, .nav li ul li:hover a, .nav li ul li.current-menu-item a { color: <?php echo $pp_active_menu_font_color; ?>; }
<?php
}

$pp_font_color = $custom_skin_arr['pp_font_color'];

if(!empty($pp_font_color))
{
?>
body { color: <?php echo $pp_font_color; ?>; }
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
?>
</style>