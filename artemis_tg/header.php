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
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">

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
?>
		<link rel="shortcut icon" href="<?php echo $pp_favicon; ?>" />
<?php
	}
?>

<!-- Template stylesheet -->
<?php
	wp_enqueue_style("colorpicker.css", get_stylesheet_directory_uri()."/js/colorpicker/css/colorpicker.css", false, $pp_theme_version, "all");
	wp_enqueue_style("screen_css", get_stylesheet_directory_uri()."/css/screen.css", false, $pp_theme_version, "all");
	wp_enqueue_style("fancybox_css", get_stylesheet_directory_uri()."/js/fancybox/jquery.fancybox.css", false, $pp_theme_version, "all");
	wp_enqueue_style("fancybox_thumb_css", get_stylesheet_directory_uri()."/js/fancybox/jquery.fancybox-thumbs.css", false, $pp_theme_version, "all");
	
	$pp_enable_responsive = get_option('pp_enable_responsive');
	
	if(!empty($pp_enable_responsive))
	{
		wp_enqueue_style("grid_css", get_stylesheet_directory_uri()."/css/grid.css", false, $pp_theme_version, "all");	
	}
?>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" charset="utf-8" src="http://ajax.googleapis.com/ajax/libs/swfobject/2.1/swfobject.js"></script>

<?php
	wp_enqueue_script("jquery", get_stylesheet_directory_uri()."/js/jquery.js", false, $pp_theme_version);
	wp_enqueue_script("jquery.ui_js", get_stylesheet_directory_uri()."/js/jquery.ui.js", false, $pp_theme_version);
	wp_enqueue_script("colorpicker.js", get_stylesheet_directory_uri()."/js/colorpicker.js", false, $pp_theme_version);
	wp_enqueue_script("fancybox_js", get_stylesheet_directory_uri()."/js/fancybox/jquery.fancybox.pack.js", false, $pp_theme_version);
	wp_enqueue_script("fancybox_thumb_js", get_stylesheet_directory_uri()."/js/fancybox/jquery.fancybox-thumbs.js", false, $pp_theme_version);
	wp_enqueue_script("jQuery_easing", get_stylesheet_directory_uri()."/js/jquery.easing.js", false, $pp_theme_version);
	wp_enqueue_script("jquery.touchwipe.1.1.1", get_stylesheet_directory_uri()."/js/jquery.touchwipe.1.1.1.js", false, $pp_theme_version);
	wp_enqueue_script("jQuery_gmap", get_stylesheet_directory_uri()."/js/gmap.js", false, $pp_theme_version);
	wp_enqueue_script("jQuery_validate", get_stylesheet_directory_uri()."/js/jquery.validate.js", false, $pp_theme_version);
	wp_enqueue_script("browser_js", get_stylesheet_directory_uri()."/js/browser.js", false, $pp_theme_version);
	wp_enqueue_script("jquery_backstretch", get_stylesheet_directory_uri()."/js/jquery.backstretch.js", false, $pp_theme_version);
	wp_enqueue_script("hint.js", get_stylesheet_directory_uri()."/js/hint.js", false, $pp_theme_version);
	wp_enqueue_script("jquery.flip.min.js", get_stylesheet_directory_uri()."/js/jquery.flip.min.js", false, $pp_theme_version);
	wp_enqueue_script("jquery.mousewheel.min.js", get_stylesheet_directory_uri()."/js/fancybox/jquery.mousewheel-3.0.6.pack.js", false, $pp_theme_version);
	wp_enqueue_script("jquery.jplayer.min.js", get_stylesheet_directory_uri()."/js/jquery.jplayer.min.js", false, $pp_theme_version);
	wp_enqueue_script("kenburns.js", get_stylesheet_directory_uri()."/js/kenburns.js", false, $pp_theme_version);
	wp_enqueue_script("jwplayer.js", get_stylesheet_directory_uri()."/js/jwplayer.js", false, $pp_theme_version);
	wp_enqueue_script("jquery.ppflip.js", get_stylesheet_directory_uri()."/js/jquery.ppflip.js", false, $pp_theme_version);
	wp_enqueue_script("custom_js", get_stylesheet_directory_uri()."/js/custom.js", false, $pp_theme_version);
	
	wp_register_script("script-contact-form", get_stylesheet_directory_uri()."/templates/script-contact-form.php", false, THEMEVERSION, true);
	$params = array(
	  'ajaxurl' => get_permalink($current_page->ID),
	  'ajax_nonce' => wp_create_nonce('tgajax-post-contact-nonce'),
	);
	wp_localize_script( 'script-contact-form', 'tgAjax', $params );
	wp_enqueue_script("script-contact-form", get_stylesheet_directory_uri()."/templates/script-contact-form.php", false, THEMEVERSION, true);
	
	if(isset($_SESSION['pp_font']))
	{
		$pp_font = $_SESSION['pp_font'];
	}
	else
	{
		$pp_font = get_option('pp_font');
	}
	
	if(!empty($pp_font))
	{
		wp_enqueue_style('google_fonts', "http://fonts.googleapis.com/css?family=".$pp_font, false, "", "all");
	}
	else
	{
		wp_enqueue_style('google_fonts', "http://fonts.googleapis.com/css", false, "", "all");
	}
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

<?php
$pp_enable_right_click = get_option('pp_enable_right_click');
$pp_right_click_text = get_option('pp_right_click_text');

if(!empty($pp_enable_right_click))
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

//Get custom CSS template
if(isset($_SESSION['pp_skin']) && !empty($_SESSION['pp_skin']))
{
	include (get_template_directory() . "/templates/custom-skins.php");
}
else
{
	include (get_template_directory() . "/templates/custom-css.php");
}
?>

</head>

<body <?php body_class(); ?>>

	<!-- Begin template wrapper -->
	<div id="wrapper">
	
	<div class="top_bar">
	
		<div id="menu_wrapper">
			
			<!-- Begin logo -->
					
			<?php
				//get custom logo
				$pp_logo = get_option('pp_logo');
							
				if(empty($pp_logo))
				{
					$pp_logo = get_stylesheet_directory_uri().'/images/logo.png';
				}

			?>
						
			<a id="custom_logo" class="logo_wrapper" href="<?php echo home_url(); ?>">
				<img src="<?php echo $pp_logo?>" alt=""/>
			</a>
						
			<!-- End logo -->
		
		    <!-- Begin main nav -->
		    <div id="nav_wrapper">
		    	<div class="nav_wrapper_inner">
		    		<div id="menu_border_wrapper">
		    			<?php 	
		    				if ( has_nav_menu( 'primary-menu' ) ) 
		    				{
			    			    //Get page nav
			    			    wp_nav_menu( 
			    			        	array( 
			    			        		'menu_id'			=> 'main_menu',
			    			        		'menu_class'		=> 'nav',
			    			        		'theme_location' 	=> 'primary-menu',
			    			        	) 
			    			    ); 
			    			}
			    			else
						    {
						     		echo '<div class="notice">Please setup "Main Menu" using Wordpress Dashboard > Appearance > Menus</div>';
						    }
		    			?>
		    		</div>
		    	</div>
		    </div>
		    <!-- End main nav -->
		    
		    </div>
		</div>

		<br class="clear"/>