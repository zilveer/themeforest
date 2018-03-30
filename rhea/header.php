<?php
/**
 * The Header for the template.
 *
 * @package WordPress
 */

$pp_advance_enable_switcher = get_option('pp_advance_enable_switcher');

if(!empty($pp_advance_enable_switcher))
{
	session_start();
}
 
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
		$pp_favicon = THEMEUPLOADURL.$pp_favicon;
?>
		<link rel="shortcut icon" href="<?php echo $pp_favicon; ?>" />
<?php
	}
?>

<?php    
    $pp_advance_combine_css = get_option('pp_advance_combine_css');
	
	if(!empty($pp_advance_combine_css))
	{	
		if(!file_exists(get_stylesheet_directory_uri()."/cache/combined.css"))
		{
			$cssmin = new CSSMin();
    		
			$css_arr = array(
				get_template_directory().'/js/colorpicker/css/colorpicker.css',
			    get_template_directory().'/css/screen.css',
			    get_template_directory().'/js/fancybox/jquery.fancybox-1.3.0.css',
			    get_template_directory().'/js/video-js.css',
			    get_template_directory().'/js/skins/vim.css',
			    get_template_directory().'/css/supersized.css',
			);
			
   			$cssmin->addFiles($css_arr);
 			
    		// Set original CSS from all files
    		$cssmin->setOriginalCSS();
    		$cssmin->compressCSS();
 			
    		$css = $cssmin->printCompressedCSS();
    		
    		file_put_contents(get_template_directory()."/cache/combined.css", $css);
    	}
    	
		wp_enqueue_style("combined_css", get_stylesheet_directory_uri()."/cache/combined.css", false, THEMEVERSION);
	}
	else
	{
		wp_enqueue_style("colorpicker.css", get_stylesheet_directory_uri()."/js/colorpicker/css/colorpicker.css", false, THEMEVERSION, "all");
		wp_enqueue_style("videojs_css", get_stylesheet_directory_uri()."/js/video-js.css", false, THEMEVERSION, "all");
		wp_enqueue_style("vim_css", get_stylesheet_directory_uri()."/js/skins/vim.css", false, THEMEVERSION, "all");
		wp_enqueue_style("fancybox_css", get_stylesheet_directory_uri()."/js/fancybox/jquery.fancybox-1.3.0.css", false, THEMEVERSION, "all");
		wp_enqueue_style("supersized_css", get_stylesheet_directory_uri()."/css/supersized.css", false, THEMEVERSION, "all");
	}
	
	//Get Google Web font CSS
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
		wp_enqueue_style('google_fonts', "http://fonts.googleapis.com/css?family=".$pp_font."&subset=latin,cyrillic-ext,greek-ext,cyrillic", false, "", "all");
	}
	else
	{
		wp_enqueue_style('google_fonts', get_stylesheet_directory_uri()."/css/gfont.css", false, "", "all");
	}
	
	if(isset($_SESSION['pp_skin']))
	{
	    $pp_skin = $_SESSION['pp_skin'];
	}
	else
	{
	    $pp_skin = get_option('pp_skin');
	}
	
	if($pp_skin == 'light')
	{
		wp_enqueue_style("light.css", get_stylesheet_directory_uri()."/css/light.css", false, THEMEVERSION, "all");
	}
	
	if(isset($_SESSION['pp_menu']))
	{
	    $pp_menu = $_SESSION['pp_menu'];
	}
	else
	{
	    $pp_menu = get_option('pp_menu');
	}
	
	if($pp_menu > 1)
	{
		wp_enqueue_style("menu".$pp_menu.".css", get_stylesheet_directory_uri()."/css/menu".$pp_menu.".css", false, THEMEVERSION, "all");
	}
	
	//Check if enable responsive layout
	$pp_enable_responsive = get_option('pp_enable_responsive');
	
	if(!empty($pp_enable_responsive))
	{
		wp_enqueue_style('grid', get_stylesheet_directory_uri()."/css/grid.css", false, "", "all");
	}
?>
<?php
	//Enqueue javascripts
	wp_enqueue_script("jquery");
	wp_enqueue_script("google_maps", "http://maps.google.com/maps/api/js?sensor=false", false, THEMEVERSION);
	wp_enqueue_script("swfobject", "http://ajax.googleapis.com/ajax/libs/swfobject/2.1/swfobject.js", false, THEMEVERSION);
	wp_enqueue_script("jquery.ui", get_stylesheet_directory_uri()."/js/jquery.ui.js", false, THEMEVERSION);
	wp_enqueue_script("colorpicker", get_stylesheet_directory_uri()."/js/colorpicker.js", false, THEMEVERSION);
	wp_enqueue_script("jquery.easing", get_stylesheet_directory_uri()."/js/jquery.easing.js", false, THEMEVERSION);
	wp_enqueue_script("jquery-mousewheel-3.0.4/jquery.mousewheel.min", get_stylesheet_directory_uri()."/js/jquery-mousewheel-3.0.4/jquery.mousewheel.min.js", false, THEMEVERSION);
	wp_enqueue_script("jquery.jplayer", get_stylesheet_directory_uri()."/js/jquery.jplayer.min.js", false, THEMEVERSION);
	wp_enqueue_script("kenburns", get_stylesheet_directory_uri()."/js/kenburns.js", false, THEMEVERSION);
	
	$js_path = get_template_directory()."/js/";
	$js_arr = array(
	    'fancybox/jquery.fancybox-1.3.0.js',
	    'gmap.js',
	    'jquery.validate.js',
	    'jquery.tubular.js',
	    'browser.js',
	    'video.js',
	    'jquery.backstretch.js',
	    'hint.js',
	    'jquery.flip.min.js',
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

		wp_enqueue_script("combined_js", get_stylesheet_directory_uri()."/cache/combined.js", false, THEMEVERSION);
	}
	else
	{
		foreach($js_arr as $file) {
			if($file != 'jquery.js' && $file != 'jquery-ui.js')
			{
				wp_enqueue_script($file, get_stylesheet_directory_uri()."/js/".$file, false, THEMEVERSION);
			}
		}
	}
	
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
?>

<style type="text/css">

<?php
	$pp_enable_hide_menu = get_option('pp_enable_hide_menu');
	
	if(empty($pp_enable_hide_menu))
	{
?>
.nav, .subnav { display: block; }
<?php
	}
	
	$pp_menu_font_size = get_option('pp_menu_font_size');
	
	if(!empty($pp_menu_font_size))
	{
?>
.nav li a { font-size:<?php echo $pp_menu_font_size; ?>px; }
<?php
	}
	
	$pp_sub_menu_font_size = get_option('pp_sub_menu_font_size');
	
	if(!empty($pp_sub_menu_font_size))
	{
?>
.nav li ul li a { font-size:<?php echo $pp_sub_menu_font_size; ?>px; }
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
h1, h2, h3, h4, h5, h6, .nav li a, #gallery_title, #gallery_desc { font-family: '<?php echo $pp_font_family; ?>'; }		
<?php
}

$pp_menu_lower = get_option('pp_menu_lower');

if(!empty($pp_menu_lower))
{
?>
h1, h2, h3, h4, h5, h6, .nav li a, #gallery_title, #gallery_desc { text-transform: none; }		
<?php
}
?>

</style>

</head>

<body <?php body_class(); ?>>

	<input type="hidden" id="pp_enable_hide_menu" name="pp_enable_hide_menu" value="<?php echo $pp_enable_hide_menu; ?>"/>
	
	<?php
		$pp_bg_overlay = get_option('pp_bg_overlay');
	?>
	<input type="hidden" id="pp_bg_overlay" name="pp_bg_overlay" value="<?php echo $pp_bg_overlay; ?>"/>
	<input type="hidden" id="pp_skin" name="pp_skin" value="<?php echo $pp_skin; ?>"/>
	<input type="hidden" id="pp_css_dir" name="pp_css_dir" value="<?php echo get_stylesheet_directory_uri(); ?>"/>

	<!-- Begin template wrapper -->
	<div id="wrapper">
	
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
		    	$pp_logo = THEMEUPLOADURL.$pp_logo;
		    }

		?>
		    		
		<a id="custom_logo" class="logo_wrapper" href="<?php echo home_url(); ?>">
		    <img src="<?php echo $pp_logo?>" alt=""/>
		    <?php
		    	if(!empty($pp_enable_hide_menu))
		    	{
		    ?>
		    <img id="logo_arrow_right" src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_arrow_right.png" alt=""/>
		    <img id="logo_arrow_left" src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_arrow_left.png" alt="" style="display:none"/>
		    <?php
		    	}
		    ?>
		</a>
		    		
		<!-- End logo -->
	
		<div id="menu_wrapper">
		
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
		
		<?php
			$pp_advance_enable_switcher = get_option('pp_advance_enable_switcher');

		    if(!empty($pp_advance_enable_switcher))
		    {
		?>
		<form action="<?php echo get_stylesheet_directory_uri(); ?>/option.php" method="get" id="form_option" name="form_option">
		    <div id="option_wrapper">
		    <div class="inner">
		    	<h4>Options Panel</h4><hr/>
		    
		    	Which Theme Skins color should be used?<br/>
		    	<select name="pp_skin_opt" id="pp_skin_opt" style="margin-top:5px">
					<option <?php if($pp_skin=='dark') { echo 'selected="selected"'; } ?> value="dark">Dark</option>
					<option <?php if($pp_skin=='light') { echo 'selected="selected"'; } ?> value="light">Light</option>
				</select>
		    	<br/><br/>
		    	
		    	Which main menu effect style should be used?<br/>
		    	<select name="pp_menu" id="pp_menu" style="margin-top:5px">
					<option <?php if($pp_menu=='1') { echo 'selected="selected"'; } ?> value="1">Blur effect</option>
					<option <?php if($pp_menu=='2') { echo 'selected="selected"'; } ?> value="2">Glowing effect</option>
					<option <?php if($pp_menu=='3') { echo 'selected="selected"'; } ?> value="3">Transparent Background</option>
				</select>
		    	<br/><br/>
		    	
		    	<?php
					// Get Google font list
					$pp_font_arr = array();
					
					$font_cache_path = TEMPLATEPATH.'/fonts/gg_fonts.cache';
					$file = file_get_contents($font_cache_path, true);
					$pp_font_arr = unserialize($file);
				?>
		    	
		    	<?php
		    		if(isset($_SESSION['pp_font_family']))
					{
						$pp_font_family = $_SESSION['pp_font_family'];
					}
					else
					{
						$pp_font_family = get_option('pp_font_family');
					}

				?>
		    	Sample Header Fonts from Google Web Fonts<br/>
		    	<select name="pp_font" id="pp_font" style="margin-top:5px">
					<option value="" data-family="">Default</option>
					<?php 
						foreach ($pp_font_arr as $key => $option) { 
					?>
					<option <?php if($option['css-name']==$pp_font) { echo 'selected="selected"'; } ?> value="<?php echo $option['css-name']; ?>" data-family="<?php echo $option['font-name']; ?>"><?php echo $option['font-name']; ?></option>
					<?php } ?>
				</select> 
				<input type="hidden" id="pp_font_family" name="pp_font_family" value="<?php echo $pp_font_family; ?>"/>
				<br/><br/>
				<a href="<?php echo get_stylesheet_directory_uri(); ?>/option.php?reset=1">Reset styles</a>
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