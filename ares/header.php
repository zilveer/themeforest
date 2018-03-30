<?php
/**
 * The Header for the template.
 *
 * @package WordPress
 */

session_start();
$pp_theme_version = THEMEVERSION;

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
	$pp_favicon = get_option('pp_favicon2');
	
	if(!empty($pp_favicon))
	{
?>
		<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/data/<?php echo $pp_favicon; ?>" />
<?php
	}
?>

<!-- Template stylesheet -->
<?php
	wp_enqueue_style("jqueryui_css", get_bloginfo( 'stylesheet_directory' )."/css/jqueryui/custom.css", false, $pp_theme_version, "all");
	wp_enqueue_style("screen_css", get_bloginfo( 'stylesheet_directory' )."/css/screen.css", false, $pp_theme_version, "all");
	wp_enqueue_style("tipsy_css", get_bloginfo( 'stylesheet_directory' )."/css/tipsy.css", false, $pp_theme_version, "all");
	wp_enqueue_style("fancybox_css", get_bloginfo( 'stylesheet_directory' )."/js/fancybox/jquery.fancybox-1.3.0.css", false, $pp_theme_version, "all");
	wp_enqueue_style("flexslider_css", get_stylesheet_directory_uri()."/js/flexslider/flexslider.css", false, $pp_theme_version, "all");
	wp_enqueue_style("grid_css", get_stylesheet_directory_uri()."/css/grid.css", false, $pp_theme_version, "all");
	
	if(isset($_SESSION['pp_menu_style']))
	{
		$pp_menu_style = $_SESSION['pp_menu_style'];
	}
	else
	{
		$pp_menu_style = get_option('pp_menu_style');
	}
	
	wp_enqueue_style("pp_menu_style", get_stylesheet_directory_uri()."/css/menu".$pp_menu_style.".css", false, $pp_theme_version, "all");
	wp_enqueue_style("colorpicker.css", get_stylesheet_directory_uri()."/js/colorpicker/css/colorpicker.css", false, $pp_theme_version, "all");
	
	wp_enqueue_script("jquery", get_bloginfo( 'stylesheet_directory' )."/js/jquery.js", false, $pp_theme_version);
	wp_enqueue_script("jQuery_UI_js", get_bloginfo( 'stylesheet_directory' )."/js/jquery-ui.js", false, $pp_theme_version);
	wp_enqueue_script("colorpicker.js", get_stylesheet_directory_uri()."/js/colorpicker.js", false, $pp_theme_version);
	wp_enqueue_script("eye.js", get_stylesheet_directory_uri()."/js/eye.js", false, $pp_theme_version);
	wp_enqueue_script("utils.js", get_stylesheet_directory_uri()."/js/utils.js", false, $pp_theme_version);
	wp_enqueue_script("fancybox_js", get_bloginfo( 'stylesheet_directory' )."/js/fancybox/jquery.fancybox-1.3.0.js", false, $pp_theme_version);
	wp_enqueue_script("jQuery_easing", get_bloginfo( 'stylesheet_directory' )."/js/jquery.easing.js", false, $pp_theme_version);
	wp_enqueue_script("jQuery_nivo", get_bloginfo( 'stylesheet_directory' )."/js/jquery.nivo.slider.js", false, $pp_theme_version);
	wp_enqueue_script("jQuery_hint", get_bloginfo( 'stylesheet_directory' )."/js/hint.js", false, $pp_theme_version);
	wp_enqueue_script("jQuery_validate", get_bloginfo( 'stylesheet_directory' )."/js/jquery.validate.js", false, $pp_theme_version);
	wp_enqueue_script("jQuery_tipsy", get_bloginfo( 'stylesheet_directory' )."/js/jquery.tipsy.js", false, $pp_theme_version);
	wp_enqueue_script("browser_js", get_bloginfo( 'stylesheet_directory' )."/js/browser.js", false, $pp_theme_version);
	wp_enqueue_script("flexslider_js", get_bloginfo( 'stylesheet_directory' )."/js/flexslider/jquery.flexslider-min.js", false, $pp_theme_version);
	wp_enqueue_script("custom_js", get_bloginfo( 'stylesheet_directory' )."/js/custom.js", false, $pp_theme_version);
	
	wp_register_script("script-contact-form", get_stylesheet_directory_uri()."/js/contact_form.js", false, THEMEVERSION, true);
	$params = array(
	  'ajaxurl' => curPageURL(),
	  'ajax_nonce' => wp_create_nonce('tgajax-post-contact-nonce'),
	);
	wp_localize_script( 'script-contact-form', 'tgAjax', $params );
	wp_enqueue_script("script-contact-form", get_stylesheet_directory_uri()."/js/contact_form.js", false, THEMEVERSION, true);

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?> 

<!--[if IE 7]>
<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/ie7.css" type="text/css" media="all"/>
<![endif]-->

<style type="text/css">
<?php
	if(isset($_SESSION['pp_skin']))
	{
		$pp_skin = $_SESSION['pp_skin'];
	}
	else
	{
		$pp_skin = get_option('pp_skin');
	}
	
	if(!empty($pp_skin))
	{
?>
#header_wrapper, #nivo_caption_wrapper .caption_cat, #content_wrapper .sidebar .content .sidebar_widget li h2.widgettitle, h2.widgettitle, .post_img .caption_cat, .pagination span.current, .pagination a:hover, table tr th, .flex-control-nav li a.active
{ 
	background: <?php echo $pp_skin; ?>; 
}
.pagination span.current, .pagination a:hover
{
	border: 1px solid <?php echo $pp_skin; ?>;
}
#footer h2.widgettitle
{
	color: <?php echo $pp_skin; ?>;
}
<?php
	}
	
?>
</style>

<?php
	/**
	*	Get custom CSS
	**/
	$pp_custom_css = get_option('pp_custom_css');
	
	
	if(!empty($pp_custom_css))
	{
		echo '<style>';
		echo stripslashes($pp_custom_css);
		echo '</style>';
	}
?>

</head>

<?php

/**
*	Get Current page object
**/
$page = get_page($post->ID);


/**
*	Get current page id
**/
$current_page_id = '';

if(isset($page->ID))
{
    $current_page_id = $page->ID;
}

$pp_homepage_slider_trans = get_option('pp_homepage_slider_trans');
if(empty($pp_homepage_slider_trans))
{
	$pp_homepage_slider_trans = 'fade';
}

?>

<body <?php body_class(); ?>>
	
	<input type="hidden" id="pp_homepage_slider_trans" name="pp_homepage_slider_trans" value="<?php echo $pp_homepage_slider_trans; ?>"/>
	
	<!-- Begin template wrapper -->
	<div id="wrapper">
			
		<!-- Begin header -->
		<div id="header_wrapper"></div>
		<!-- End header -->
					
		<br class="clear"/>
		
		<div class="standard_wrapper header">
			<div class="logo">
				<!-- Begin logo -->
						
				<?php
				    //get custom logo
				    $pp_logo = get_option('pp_logo');
				    
				    if(empty($pp_logo))
				    {
				    	if($pp_menu_style != 3 && $pp_menu_style != 6)
				    	{
				    		$pp_logo = get_stylesheet_directory_uri().'/images/logo.png';
				    	}
				    	else
				    	{
				    		$pp_logo = get_stylesheet_directory_uri().'/images/logo_dark.png';
				    	}
				    }
				    else
				    {
				    	$pp_logo = get_stylesheet_directory_uri().'/data/'.$pp_logo;
				    }
				
				?>
				
				<a id="custom_logo" href="<?php echo home_url(); ?>"><img src="<?php echo $pp_logo?>" alt=""/></a>
				
				<!-- End logo -->
			</div>
			<div class="header_ads">
				<?php
				    $pp_top_banner = get_option('pp_top_banner');
	
				    if(!empty($pp_top_banner))
				    {
				    	echo stripslashes($pp_top_banner);
				    }
				?>
			</div>
			
			<br class="clear"/>
		</div>

		<?php
			$pp_advance_enable_switcher = get_option('pp_advance_enable_switcher');
		
		    if(!empty($pp_advance_enable_switcher))
		    {
		?>
		<form action="<?php echo get_stylesheet_directory_uri(); ?>/s.php" method="get" id="form_option" name="form_option">
		    <div id="option_wrapper">
		    <div class="inner">
		    	<h4 style="color:#000">Options Panel</h4><hr/><br/>
		    	
		    	Which main menu style you want to used?<br/><br/>
		    	<div class="option_menu_style">
					<div class="option_menu">
						<div style="float:left;width:90px">
						<a href="<?php echo get_stylesheet_directory_uri(); ?>/switcher.php?pp_menu_style=1" class="preview" name="<?php echo get_stylesheet_directory_uri(); ?>/functions/menu1.png">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/functions/menu1.png" alt=""/>	
						</a>
						</div>
					</div>
					<div class="option_menu">
						<div style="float:left;width:90px">
						<a href="<?php echo get_stylesheet_directory_uri(); ?>/switcher.php?pp_menu_style=2" class="preview" name="<?php echo get_stylesheet_directory_uri(); ?>/functions/menu2.png">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/functions/menu2.png" alt=""/>	
						</a>
						</div>
					</div>
					<div class="option_menu">
						<div style="float:left;width:90px">
						<a href="<?php echo get_stylesheet_directory_uri(); ?>/switcher.php?pp_menu_style=3" class="preview" name="<?php echo get_stylesheet_directory_uri(); ?>/functions/menu3.png">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/functions/menu3.png" alt=""/>
						</a>	
						</div>	
					</div>
					<div class="option_menu">
						<div style="float:left;width:90px">
						<a href="<?php echo get_stylesheet_directory_uri(); ?>/switcher.php?pp_menu_style=4" class="preview" name="<?php echo get_stylesheet_directory_uri(); ?>/functions/menu4.png">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/functions/menu4.png" alt=""/>
						</a>	
						</div>	
					</div>
					<div class="option_menu">
						<div style="float:left;width:90px">
						<a href="<?php echo get_stylesheet_directory_uri(); ?>/switcher.php?pp_menu_style=5" class="preview" name="<?php echo get_stylesheet_directory_uri(); ?>/functions/menu5.png">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/functions/menu5.png" alt=""/>
						</a>	
						</div>
					</div>
					<div class="option_menu">
						<div style="float:left;width:90px">
						<a href="<?php echo get_stylesheet_directory_uri(); ?>/switcher.php?pp_menu_style=6" class="preview" name="<?php echo get_stylesheet_directory_uri(); ?>/functions/menu6.png">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/functions/menu6.png" alt=""/>
						</a>	
						</div>	
					</div>
				</div>
				
				<br class="clear"/><br/>
		    
		    	Which skin color you want to used?<br/>
		    	<div id="pp_skin_preview" class="colorpicker_preview" style="background:<?php echo $pp_skin; ?>;margin-top:5px">&nbsp;</div>
		    	<input type="hidden" id="pp_skin" name="pp_skin" value="<?php echo $pp_skin; ?>" />
		    	
		    	<br/><br/>
		    	<a class="button" href="<?php echo get_stylesheet_directory_uri(); ?>/switcher.php?reset=1" style="width:54px">Reset</a>
		    </div>
		    </div>
		    <div id="option_btn">
		    	<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/color.png"/>
		    </div>
		</form>
		<?php
		    }
		?>
		
		<br class="clear"/>
					
		<div class="standard_wrapper">
			<?php 	
				//Get page nav
				wp_nav_menu( 
				    	array( 
				    		'menu_id'			=> 'main_menu',
				    		'menu_class'		=> 'main_nav',
				    		'theme_location' 	=> 'main-menu',
				    	) 
				); 
			?>
		</div>
		
		<div id="menu_border_wrapper"></div>
		
