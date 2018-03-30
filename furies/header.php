<?php
/**
 * The Header for the template.
 *
 * @package WordPress
 */
 
if ( ! isset( $content_width ) ) $content_width = 960;

if(session_id() == '') {
	session_start();
}
 
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

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

<?php
	//Enqueue javascripts
	wp_enqueue_script("jquery");
	wp_enqueue_script("google_maps", "http://maps.google.com/maps/api/js?sensor=false", false, THEMEVERSION, true);
	wp_enqueue_script("swfobject", "http://ajax.googleapis.com/ajax/libs/swfobject/2.1/swfobject.js", false, THEMEVERSION, true);
	wp_enqueue_script("jquery.ui", get_template_directory_uri()."/js/jquery.ui.js", false, THEMEVERSION, true);
	
	$js_path = get_template_directory()."/js/";
	$js_arr = array(
		'jwplayer.js',
	    'fancybox/jquery.fancybox.pack.js',
	    'fancybox/jquery.fancybox-thumbs.js',
	    'fancybox/jquery.mousewheel-3.0.6.pack.js',
	    'jquery.touchwipe.1.1.1.js',
	    'gmap.js',
	    'jquery.validate.js',
	    'browser.js',
	    'jquery.backstretch.js',
	    'hint.js',
	    'jquery.flip.min.js',
	    'jquery.ppflip.js',
	    'jquery.isotope.js',
	    'supersized.3.1.3.js',
	    'supersized.shutter.js',
	    'custom.js',
	);
	$js = "";

	$pp_advance_combine_js = get_option('pp_advance_combine_js');
	
	if(!empty($pp_advance_combine_js))
	{	
		if(!file_exists(get_template_directory()."/cache/combined.js"))
		{
			foreach($js_arr as $file) {
				if($file != 'jquery.js' && $file != 'jquery-ui.js')
				{
    				$js .= JSMin::minify(file_get_contents($js_path.$file));
    			}
			}
			
			file_put_contents(get_template_directory()."/cache/combined.js", $js);
		}

		wp_enqueue_script("combined_js", get_template_directory_uri()."/cache/combined.js", false, THEMEVERSION, true);
	}
	else
	{
		foreach($js_arr as $file) {
			if($file != 'jquery.js' && $file != 'jquery-ui.js')
			{
				wp_enqueue_script($file, get_template_directory_uri()."/js/".$file, false, THEMEVERSION, true);
			}
		}
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

</head>

<?php
//Check homepage style for demo purpose
if(isset($_SESSION['pp_homepage_style']))
{
    $pp_homepage_style = $_SESSION['pp_homepage_style'];
}
else
{
    $pp_homepage_style = get_option('pp_homepage_style');
}
?>
<body <?php body_class(); ?> <?php if(is_home() && $pp_homepage_style == 'flow') { ?>data-gallery="flow"<?php } ?>>
	<?php
		//Check if disable right click
		$pp_enable_right_click = get_option('pp_enable_right_click');
		$pp_right_click_text = get_option('pp_right_click_text');
	?>
	<input type="hidden" id="pp_enable_right_click" name="pp_enable_right_click" value="<?php echo $pp_enable_right_click; ?>"/>
	<input type="hidden" id="pp_right_click_text" name="pp_right_click_text" value="<?php echo $pp_right_click_text; ?>"/>
	<input type="hidden" id="pp_image_path" name="pp_image_path" value="<?php echo get_template_directory_uri(); ?>/images/"/>
	
	<?php
		//Check footer sidebar columns
		$pp_footer_style = get_option('pp_footer_style');
	?>
	<input type="hidden" id="pp_footer_style" name="pp_footer_style" value="<?php echo $pp_footer_style; ?>"/>

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
					$pp_logo = get_template_directory_uri().'/images/logo.png';
				}

			?>
						
			<a id="custom_logo" class="logo_wrapper" href="<?php echo home_url(); ?>">
				<img src="<?php echo $pp_logo?>" alt=""/>
			</a>
						
			<!-- End logo -->
			
			<img id="mobile_menu" src="<?php echo get_template_directory_uri(); ?>/images/mobile_menu.png" alt=""/>
			
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