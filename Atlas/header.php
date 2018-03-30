<?php
/**
 * The Header for the template.
 *
 * @package WordPress
 */
 
$pp_theme_version = THEMEVERSION;
session_start();
 
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php wp_title('&lsaquo;', true, 'right'); ?><?php bloginfo('name'); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php
	/**
	*	Get favicon URL
	**/
	$pp_favicon = get_option('pp_favicon');
	
	if(!empty($pp_favicon))
	{
		$pp_favicon = get_stylesheet_directory_uri().'/data/'.$pp_favicon;
?>
		<link rel="shortcut icon" href="<?php echo $pp_favicon; ?>" />
<?php
	}
?>

<!-- Template stylesheet -->
<?php
	wp_enqueue_style("screen_css", get_stylesheet_directory_uri()."/css/screen.css", false, $pp_theme_version, "all");
	
	if(isset($_SESSION['pp_menu_style']))
	{
		$pp_menu_style = $_SESSION['pp_menu_style'];
	}
	else
	{
		$pp_menu_style = get_option('pp_menu_style');
	}
	
	if($pp_menu_style != 'grediant')
	{
		wp_enqueue_style("skin_css", get_stylesheet_directory_uri()."/css/".$pp_menu_style.".css", false, $pp_theme_version, "all");
	}
	
	wp_enqueue_style("fancybox_css", get_stylesheet_directory_uri()."/js/fancybox/jquery.fancybox-1.3.0.css", false, $pp_theme_version, "all");
	wp_enqueue_style("videojs_css", get_stylesheet_directory_uri()."/js/video-js.css", false, $pp_theme_version, "all");
	wp_enqueue_style("vim_css", get_stylesheet_directory_uri()."/js/skins/vim.css", false, $pp_theme_version, "all");
?>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" charset="utf-8" src="http://ajax.googleapis.com/ajax/libs/swfobject/2.1/swfobject.js"></script>

<?php
	wp_enqueue_script("jquery", get_stylesheet_directory_uri()."/js/jquery.js", false, $pp_theme_version);
	wp_enqueue_script("jquery.ui_js", get_stylesheet_directory_uri()."/js/jquery.ui.js", false, $pp_theme_version);
	wp_enqueue_script("fancybox_js", get_stylesheet_directory_uri()."/js/fancybox/jquery.fancybox-1.3.0.js", false, $pp_theme_version);
	wp_enqueue_script("jQuery_easing", get_stylesheet_directory_uri()."/js/jquery.easing.js", false, $pp_theme_version);
	wp_enqueue_script("jQuery_nivo", get_stylesheet_directory_uri()."/js/jquery.nivoslider.js", false, $pp_theme_version);
	wp_enqueue_script("jQuery_gmap", get_stylesheet_directory_uri()."/js/gmap.js", false, $pp_theme_version);
	wp_enqueue_script("jQuery_validate", get_stylesheet_directory_uri()."/js/jquery.validate.js", false, $pp_theme_version);
	wp_enqueue_script("jQuery_cufon", get_stylesheet_directory_uri()."/js/cufon.js", false, $pp_theme_version);
	
	/**
	*	Check selected font
	**/
	$pp_font = get_option('pp_font');
	if(empty($pp_font))
	{
		$pp_font = 'Josefin_Sans_Std_300.font';
	}
	
	wp_enqueue_script("jquery.tubular.js", get_stylesheet_directory_uri()."/js/jquery.tubular.js", false, $pp_theme_version);
	wp_enqueue_script("cufon_font", get_stylesheet_directory_uri()."/fonts/".$pp_font.".js", false, $pp_theme_version);
	wp_enqueue_script("browser_js", get_stylesheet_directory_uri()."/js/browser.js", false, $pp_theme_version);
	wp_enqueue_script("video_js", get_stylesheet_directory_uri()."/js/video.js", false, $pp_theme_version);
	wp_enqueue_script("jquery_backstretch", get_stylesheet_directory_uri()."/js/jquery.backstretch.js", false, $pp_theme_version);
	wp_enqueue_script("hint.js", get_stylesheet_directory_uri()."/js/hint.js", false, $pp_theme_version);
	wp_enqueue_script("supersized.3.1.3.min.js", get_stylesheet_directory_uri()."/js/supersized.3.1.3.min.js", false, $pp_theme_version);
	wp_enqueue_script("jquery.flip.min.js", get_stylesheet_directory_uri()."/js/jquery.flip.min.js", false, $pp_theme_version);
	wp_enqueue_script("jquery.mousewheel.min.js", get_stylesheet_directory_uri()."/js/jquery-mousewheel-3.0.4/jquery.mousewheel.min.js", false, $pp_theme_version);
	wp_enqueue_script("kenburns.js", get_stylesheet_directory_uri()."/js/kenburns.js", false, $pp_theme_version);
	wp_enqueue_script("custom_js", get_stylesheet_directory_uri()."/js/custom.js", false, $pp_theme_version);
	
	wp_register_script("script-contact-form", get_stylesheet_directory_uri()."/js/contact_form.js", false, THEMEVERSION, true);
	$params = array(
	  'ajaxurl' => curPageURL(),
	  'ajax_nonce' => wp_create_nonce('tgajax-post-contact-nonce'),
	);
	wp_localize_script( 'script-contact-form', 'tgAjax', $params );
	wp_enqueue_script("script-contact-form", get_stylesheet_directory_uri()."/js/contact_form.js", false, THEMEVERSION, true);
?> 

<?php
	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>

<!--[if IE]>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/ie.css" type="text/css" media="all"/>
<![endif]-->

<!--[if IE 7]>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/ie7.css" type="text/css" media="all"/>
<![endif]-->

<?php
$pp_enable_right_click = get_option('pp_enable_right_click');
$pp_right_click_text = get_option('pp_right_click_text');

if(empty($pp_enable_right_click))
{
?>
<script type="text/javascript" language="javascript">
    $j(function() {
        $j(this).bind("contextmenu", function(e) {
        	<?php
        		if(!empty($pp_right_click_text))
        		{
        	?>
        		alert('<?php echo $pp_right_click_text; ?>');
        	<?php
        		}
        	?>
            e.preventDefault();
        });
    }); 
</script>
<?php
}
?>

<style type="text/css">

<?php

$pp_h1_font_color = get_option('pp_h1_font_color');
if(!empty($pp_h1_font_color))
{
?>
.post_header h2, h1, h2, h3, h4, h5
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
.nav, .subnav { font-size:<?php echo $pp_menu_font_size; ?>px; }
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
a:hover, a:active { color:<?php echo $pp_hover_link_color; ?>; }
<?php
	}
	
?>

<?php
	$pp_button_bg_color = get_option('pp_button_bg_color');
	
	if(!empty($pp_button_bg_color))
	{
		$pp_button_bg_color_light = '#'.hex_lighter(substr($pp_button_bg_color, 1), 50);
?>
input[type=submit], input[type=button], a.button, a.comment-reply-link { 
	background: <?php echo $pp_button_bg_color; ?>;
	background: -webkit-gradient(linear, left top, left bottom, from(<?php echo $pp_button_bg_color_light; ?>), to(<?php echo $pp_button_bg_color; ?>));
	background: -moz-linear-gradient(top,  <?php echo $pp_button_bg_color_light; ?>,  <?php echo $pp_button_bg_color; ?>);
	filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $pp_button_bg_color_light; ?>', endColorstr='<?php echo $pp_button_bg_color; ?>');
	text-shadow: -1px 0 1px #333;
}
input[type=submit]:active, input[type=button]:active, a.button:active, a.comment-reply-link:active
{
	background: <?php echo $pp_button_bg_color; ?>;
	background: -webkit-gradient(linear, left top, left bottom, from(<?php echo $pp_button_bg_color; ?>), to(<?php echo $pp_button_bg_color_light; ?>));
	background: -moz-linear-gradient(top,  <?php echo $pp_button_bg_color; ?>,  <?php echo $pp_button_bg_color_light; ?>);
	filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $pp_button_bg_color_light; ?>', endColorstr='<?php echo $pp_button_bg_color; ?>');
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
.post_header h2, h1, h2, h3, h4, h5
{
	color: <?php echo $pp_h1_font_color; ?>;
}
<?php
}
?>

</style>

</head>

<body <?php body_class(); ?>>

	<!-- Begin template wrapper -->
	<div id="wrapper">
	
		<div id="menu_wrapper">
			
			<!-- Begin logo -->
					
			<?php
				//get custom logo
				$pp_logo = get_option('pp_logo');
							
				if(empty($pp_logo))
				{
					$pp_logo = get_stylesheet_directory_uri().'/images/logo.png';
				}
				else
				{
					$pp_logo = get_stylesheet_directory_uri().'/data/'.$pp_logo;
				}

			?>
						
			<a id="custom_logo" class="logo_wrapper" href="<?php echo home_url(); ?>"><img src="<?php echo $pp_logo?>" alt=""/></a>
						
			<!-- End logo -->
		
		    <!-- Begin main nav -->
		    <?php 	
		    			//Get page nav
		    			wp_nav_menu( 
		    					array( 
		    						'menu_id'			=> 'main_menu',
		    						'menu_class'		=> 'nav',
		    						'theme_location' 	=> 'primary-menu',
		    					) 
		    			); 
		    ?>
		    
		    <!-- End main nav -->
		    
		</div>
