<?php
/**
 * The Header for the template.
 *
 * @package WordPress
 */

$pp_theme_version = THEMEVERSION;

$pp_advance_enable_switcher = get_option('pp_advance_enable_switcher');
if(!empty($pp_advance_enable_switcher))
{
	session_start();
}
 
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />

<?php
$pp_seo_enable = get_option('pp_seo_enable');

if(!empty($pp_seo_enable))
{
	if(is_home())
	{
		$pp_seo_home_title = get_option('pp_seo_home_title');
	}
	else if(is_single())
	{
		$page = get_page($post->ID);
		$current_page_id = $page->ID;
		
		$pp_seo_home_title = get_post_meta($current_page_id, 'post_seo_title', true);
	}
}
else
{
	$pp_seo_home_title = '';
}

if(empty($pp_seo_home_title))
{
?>
<title><?php wp_title('&lsaquo;', true, 'right'); ?><?php bloginfo('name'); ?></title>
<?php
} else {
?>
<title><?php echo $pp_seo_home_title; ?></title>
<?php
}
?>

<link rel="profile" href="http://gmpg.org/xfn/11"/>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>


<?php
if(!empty($pp_seo_enable))
{
	if(is_single())
	{
		$page = get_page($post->ID);
		$current_page_id = $page->ID;
		
		$pp_seo_meta_desc = get_post_meta($current_page_id, 'post_seo_desc', true);
	}
	else
	{
		$pp_seo_meta_desc = get_option('pp_seo_meta_desc');
	}
}
else
{
	$pp_seo_meta_desc = '';
}

if(!empty($pp_seo_meta_desc))
{
?>
<meta name="description" content="<?php echo $pp_seo_meta_desc; ?>" />
<?php
}
?>
<?php
if(!empty($pp_seo_enable))
{
	if(is_single())
	{
		$page = get_page($post->ID);
		$current_page_id = $page->ID;
		
		$pp_seo_meta_key = get_post_meta($current_page_id, 'post_seo_keyword', true);
	}
	else
	{
		$pp_seo_meta_key = get_option('pp_seo_meta_key');
	}
}
else
{
	$pp_seo_meta_key = '';
}

if(!empty($pp_seo_meta_key))
{
?>
<meta name="keywords" content="<?php echo $pp_seo_meta_key; ?>" />
<?php
}
?>

<?php
	/**
	*	Get favicon URL
	**/
	$pp_favicon = get_option('pp_favicon');
	
	if(!empty($pp_favicon))
	{
?>
		<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/cache/<?php echo $pp_favicon; ?>" />
<?php
	}
?>

<!-- Template stylesheet -->
<?php    
    $pp_advance_combine_css = get_option('pp_advance_combine_css');
	
	if(!empty($pp_advance_combine_css))
	{	
		if(!file_exists(TEMPLATEPATH."/cache/combined.css"))
		{
			$cssmin = new CSSMin();
    		
			$css_arr = array(
			    TEMPLATEPATH.'/css/jqueryui/custom.css',
			    TEMPLATEPATH.'/css/screen.css',
			    TEMPLATEPATH.'/js/fancybox/jquery.fancybox-1.3.0.css',
			    TEMPLATEPATH.'/js/video-js.css',
			    TEMPLATEPATH.'hint.js',
			    TEMPLATEPATH.'/js/skins/vim.css',
			);
			
   			$cssmin->addFiles($css_arr);
 			
    		// Set original CSS from all files
    		$cssmin->setOriginalCSS();
    		$cssmin->compressCSS();
 			
    		$css = $cssmin->printCompressedCSS();
    		
    		file_put_contents(TEMPLATEPATH."/cache/combined.css", $css);
    	}
    	
		wp_enqueue_style("combined_css", get_stylesheet_directory_uri()."/cache/combined.css", false, $pp_theme_version);
		wp_enqueue_style("colorpicker.css", get_stylesheet_directory_uri()."/js/colorpicker/css/colorpicker.css", false, $pp_theme_version, "all");
	}
	else
	{
		wp_enqueue_style("jqueryui_css", get_stylesheet_directory_uri()."/css/jqueryui/custom.css", false, $pp_theme_version, "all");
		wp_enqueue_style("screen_css", get_stylesheet_directory_uri()."/css/screen.css", false, $pp_theme_version, "all");
		wp_enqueue_style("fancybox_css", get_stylesheet_directory_uri()."/js/fancybox/jquery.fancybox-1.3.0.css", false, $pp_theme_version, "all");
		wp_enqueue_style("videojs_css", get_stylesheet_directory_uri()."/js/video-js.css", false, $pp_theme_version, "all");
		wp_enqueue_style("vim_css", get_stylesheet_directory_uri()."/js/skins/vim.css", false, $pp_theme_version, "all");
		wp_enqueue_style("colorpicker.css", get_stylesheet_directory_uri()."/js/colorpicker/css/colorpicker.css", false, $pp_theme_version, "all");
	}
?>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

<?php
	wp_enqueue_script("jquery", get_stylesheet_directory_uri()."/js/jquery.js", false, $pp_theme_version);
	wp_enqueue_script("jquery_UI_js", get_stylesheet_directory_uri()."/js/jquery-ui.js", false, $pp_theme_version);
	wp_enqueue_script("jquery_cufon", get_stylesheet_directory_uri()."/js/cufon.js", false, $pp_theme_version);
	wp_enqueue_script("colorpicker.js", get_stylesheet_directory_uri()."/js/colorpicker.js", false, $pp_theme_version);
	wp_enqueue_script("eye.js", get_stylesheet_directory_uri()."/js/eye.js", false, $pp_theme_version);
	wp_enqueue_script("utils.js", get_stylesheet_directory_uri()."/js/utils.js", false, $pp_theme_version);
	wp_enqueue_script("galleria-1.2.3.js", get_stylesheet_directory_uri()."/js/galleria/galleria-1.2.3.js", false, $pp_theme_version);
	wp_enqueue_script("galleria.classic.js", get_stylesheet_directory_uri()."/js/galleria/themes/classic/galleria.classic.js", false, $pp_theme_version);
	wp_enqueue_script("swfobject.js", get_stylesheet_directory_uri()."/swfobject/swfobject.js", false, $pp_theme_version);
		
	/**
	*	Check selected font
	**/
	if(!empty($pp_advance_enable_switcher) && isset($_SESSION['pp_font']))
	{
		$pp_font = $_SESSION['pp_font'];
	}
	else
	{
		$pp_font = get_option('pp_font');
	}
	
	if(empty($pp_font))
	{
		$pp_font = 'Vegur_300.font';
	}
		
	wp_enqueue_script("cufon_font", get_stylesheet_directory_uri()."/fonts/".$pp_font.".js", false, $pp_theme_version);
	
	$js_path = TEMPLATEPATH."/js/";
	$js_arr = array(
	    'fancybox/jquery.fancybox-1.3.0.js',
	    'jquery.easing.js',
	    'anythingSlider.js',
	    'gmap.js',
	    'hint.js',
	    'jquery.validate.js',
	    'browser.js',
	    'video.js',
	    'jquery.tipsy.js',
	    'jquery.quicksand.js',
	    'jquery.nivoslider.js',
	    'jquery.kwicks.js',
	    'jquery.roundabout.js',
	    'jquery.animate-shadow-min.js',
	    'custom.js',
	);
	$js = "";

	$pp_advance_combine_js = get_option('pp_advance_combine_js');
	
	if(!empty($pp_advance_combine_js))
	{	
		if(!file_exists(TEMPLATEPATH."/cache/combined.js"))
		{
			foreach($js_arr as $file) {
				if($file != 'jquery.js' && $file != 'jquery-ui.js')
				{
    				$js .= JSMin::minify(file_get_contents($js_path.$file));
    			}
			}
			
			file_put_contents(TEMPLATEPATH."/cache/combined.js", $js);
		}

		wp_enqueue_script("combined_js", get_stylesheet_directory_uri()."/cache/combined.js", false, $pp_theme_version);
	}
	else
	{
		foreach($js_arr as $file) {
			if($file != 'jquery.js' && $file != 'jquery-ui.js')
			{
				wp_enqueue_script($file, get_stylesheet_directory_uri()."/js/".$file, false, $pp_theme_version);
			}
		}
	}
	
	wp_register_script("script-contact-form", get_stylesheet_directory_uri()."/js/contact_form.js", false, $pp_theme_version);
	$params = array(
	  'ajaxurl' => curPageURL(),
	  'ajax_nonce' => wp_create_nonce('tgajax-post-contact-nonce'),
	);
	wp_localize_script( 'script-contact-form', 'tgAjax', $params );
	wp_enqueue_script("script-contact-form", get_stylesheet_directory_uri()."/js/contact_form.js", false, $pp_theme_version);
?>

<?php
	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>

<!--[if lte IE 8]>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/ie.css?v=<?php echo $pp_theme_version; ?>.css" type="text/css" media="all"/>
<![endif]-->

<!--[if lt IE 8]>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/ie7.css?v=<?php echo $pp_theme_version; ?>" type="text/css" media="all"/>
<![endif]-->

<style>
<?php
	if(!empty($pp_advance_enable_switcher) && isset($_SESSION['pp_body_font']))
	{
		$pp_body_font = $_SESSION['pp_body_font'];
	}
	else
	{
		$pp_body_font = get_option('pp_body_font');
	}
	
	if(!empty($pp_body_font))
	{
?>
body, input[type=submit], input[type=button], a.button, input[type=submit].medium, input[type=button].medium, a.button.medium, input[type=submit].large, input[type=button].large, a.button.large { font-family:<?php echo $pp_body_font; ?>; }
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
	if(!empty($pp_advance_enable_switcher) && isset($_SESSION['pp_bg_color']))
	{
		$pp_bg = $_SESSION['pp_bg_color'];
	}
	else
	{
		$pp_bg = get_option('pp_bg');
	}
	
	if($pp_theme_style == 'fx' && !empty($pp_bg))
	{
?>
body { background-color:<?php echo $pp_bg; ?>; }
<?php
	}
	
?>

<?php
	if(!empty($pp_advance_enable_switcher) && isset($_SESSION['pp_bg_pattern']))
	{
		$pp_bg_pattern = $_SESSION['pp_bg_pattern'];
	}
	else
	{
		$pp_bg_pattern = get_option('pp_bg_pattern');
	}
	
	if(!empty($pp_advance_enable_switcher) && isset($_SESSION['pp_header_bg']))
	{
		$pp_header_bg = $_SESSION['pp_header_bg'];
	}
	else
	{
		$pp_header_bg = get_option('pp_header_bg');
	}
	
	if(empty($pp_header_bg))
	{
		$pp_header_bg = '#333a3d';
	}

	if(!empty($pp_bg_pattern))
	{
?>
body .page_caption
{
	background: <?php echo $pp_header_bg; ?> url('<?php echo get_stylesheet_directory_uri(); ?>/images/header_bg.png') no-repeat top center;
}

body #header_pattern
{
	background: transparent url('<?php echo get_stylesheet_directory_uri(); ?>/images/skins/<?php echo $pp_bg_pattern; ?>_pattern.png') repeat;
}

body.home #header_wrapper
{
	background: <?php echo $pp_header_bg; ?> url('<?php echo get_stylesheet_directory_uri(); ?>/images/header_bg.png') no-repeat top center;
}

body.home #header_pattern
{
	background: transparent url('<?php echo get_stylesheet_directory_uri(); ?>/images/skins/<?php echo $pp_bg_pattern; ?>_pattern.png') repeat;
}
<?php
	
	}
	else
	{
?>
body .page_caption
{
	background: <?php echo $pp_header_bg; ?> url('<?php echo get_stylesheet_directory_uri(); ?>/images/header_bg.png') no-repeat top center;
}

body #header_pattern
{
	background: none;
}

body.home #header_wrapper
{
	background: <?php echo $pp_header_bg; ?> url('<?php echo get_stylesheet_directory_uri(); ?>/images/header_bg.png') no-repeat top center;
}

body.home #header_pattern
{
	background: none;
}
<?php
	}
?>

<?php
	$pp_menu_color = get_option('pp_menu_color');
	
	if(!empty($pp_menu_color))
	{
?>
#menu_wrapper .nav ul li a, #menu_wrapper div .nav li a { color:<?php echo $pp_menu_color; ?>; }
<?php
	}
	
?>

<?php
	$pp_tagline_font_size = get_option('pp_tagline_font_size');
	
	if(!empty($pp_tagline_font_size))
	{
?>
.tagline_inner { font-size:<?php echo $pp_tagline_font_size; ?>px; }
<?php
	}
	
?>

<?php
	$pp_footer_header_font_size = get_option('pp_footer_header_font_size');
	
	if(!empty($pp_footer_header_font_size))
	{
?>
#footer ul li.widget .widgettitle { font-size:<?php echo $pp_footer_header_font_size; ?>px; }
<?php
	}
	
?>

<?php
	$pp_sidebar_header_font_size = get_option('pp_sidebar_header_font_size');
	
	if(!empty($pp_sidebar_header_font_size))
	{
?>
#content_wrapper .sidebar .content .sidebar_widget li .widgettitle, h2.widgettitle { font-size:<?php echo $pp_sidebar_header_font_size; ?>px; }
<?php
	}
	
?>

<?php
	$pp_post_title_font_size = get_option('pp_post_title_font_size');
	
	if(!empty($pp_post_title_font_size))
	{
?>
.post_header h3 { font-size:<?php echo $pp_post_title_font_size; ?>px; }
<?php
	}
	
?>

<?php
	$pp_tagline_font_color = get_option('pp_tagline_font_color');
	
	if(!empty($pp_tagline_font_color))
	{
?>
h1.tagline_header { color:<?php echo $pp_tagline_font_color; ?>; }
<?php
	}
	
?>

<?php
	$pp_h1_font_color = get_option('pp_h1_font_color');
	
	if(!empty($pp_h1_font_color))
	{
?>
h1,h2,h3,h4,h5,h6 { color:<?php echo $pp_h1_font_color; ?>; }
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
	$pp_font_color = get_option('pp_font_color');
	
	if(!empty($pp_font_color))
	{
?>
body { color:<?php echo $pp_font_color; ?>; }
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
		$pp_button_bg_color_light = '#'.hex_lighter(substr($pp_button_bg_color, 1), 30);
?>
input[type=submit], input[type=button], a.button { 
	background: <?php echo $pp_button_bg_color; ?>;
	background: -webkit-gradient(linear, left top, left bottom, from(<?php echo $pp_button_bg_color_light; ?>), to(<?php echo $pp_button_bg_color; ?>));
	background: -moz-linear-gradient(top,  <?php echo $pp_button_bg_color_light; ?>,  <?php echo $pp_button_bg_color; ?>);
	filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $pp_button_bg_color_light; ?>', endColorstr='<?php echo $pp_button_bg_color; ?>');
}
input[type=submit]:active, input[type=button]:active, a.button:active
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
	$pp_page_caption_align = get_option('pp_page_caption_align');
	if(!empty($pp_page_caption_align))
	{
?>
.caption_inner { text-align: <?php echo $pp_page_caption_align; ?> }
<?php
	}
?>

<?php
    $pp_footer_display_sidebar = get_option('pp_footer_display_sidebar');
    
    if(empty($pp_footer_display_sidebar))
    {
?>
#footer { background-image: none; }
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

?>

<body <?php body_class(); ?>>

	<?php
		$pp_slider_timer = get_option('pp_slider_timer'); 
				
		if(empty($pp_slider_timer))
		{
		    $pp_slider_timer = 5;
		}
	?>
	<input type="hidden" id="slider_timer" name="slider_timer" value="<?php echo $pp_slider_timer; ?>"/>
	
	<input type="hidden" id="pp_blogurl" name="pp_blogurl" value="<?php echo home_url(); ?>"/>
	
	<input type="hidden" id="pp_stylesheet_directory" name="pp_stylesheet_directory" value="<?php echo get_stylesheet_directory_uri(); ?>"/>
	<?php
		$pp_portfolio_sorting = get_option('pp_portfolio_sorting');
	?>
	<input type="hidden" id="pp_portfolio_sorting" name="pp_portfolio_sorting" value="<?php echo $pp_portfolio_sorting; ?>"/>
	<?php
		$pp_footer_style = get_option('pp_footer_style');
	?>
	<input type="hidden" id="pp_footer_style" name="pp_footer_style" value="<?php echo $pp_footer_style; ?>"/>
	
	<!-- Begin template wrapper -->
	<div id="wrapper">
			
		<!-- Begin header -->
		<div id="header_wrapper">
		
		<div id="top_bg">
			<div id="top_bar">
					
					<!-- Begin main nav -->
					<div id="menu_wrapper">
					
						<div class="logo">
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
									$pp_logo = get_stylesheet_directory_uri().'/cache/'.$pp_logo;
								}
						
							?>
							
							<a id="custom_logo" href="<?php echo home_url(); ?>"><img src="<?php echo $pp_logo?>" alt=""/></a>
							
							<!-- End logo -->
						</div>
					
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
					
					</div>
					<!-- End main nav -->
					
				</div>
			<br class="clear"/>
		</div>
				
				<?php
					if(!empty($pp_advance_enable_switcher))
					{
				?>
				<form action="<?php echo get_stylesheet_directory_uri(); ?>/option.php" method="get" id="form_option" name="form_option">
					<div id="option_wrapper">
					<div class="inner">
						Header Color<br/>
						<div id="bg_header_preview" class="colorpicker_preview" style="background:<?php echo $pp_header_bg; ?>;margin-top:5px">&nbsp;</div>
						<input type="hidden" id="pp_header_bg" name="pp_header_bg" value="<?php echo $pp_header_bg; ?>" />
						
						<br/>
						
						Pattern<br/>	
							<select name="pp_bg_pattern" id="pp_bg_pattern" style="margin-top:5px">
								<option value="" <?php if(empty($pp_bg_pattern)) { ?>selected=selected<?php } ?>>None</option>
								<option value="ver_strip" <?php if($pp_bg_pattern == 'ver_strip') { ?>selected=selected<?php } ?>>Vertical Strip</option>
								<option value="hor_strip" <?php if($pp_bg_pattern == 'hor_strip') { ?>selected=selected<?php } ?>>Horizontal Strip</option>
								<option value="right_strip" <?php if($pp_bg_pattern == 'right_strip') { ?>selected=selected<?php } ?>>Right Strip</option>
								<option value="left_strip" <?php if($pp_bg_pattern == 'left_strip') { ?>selected=selected<?php } ?>>Left Strip</option>
								<option value="square" <?php if($pp_bg_pattern == 'square') { ?>selected=selected<?php } ?>>Square</option>
								<option value="square2" <?php if($pp_bg_pattern == 'square2') { ?>selected=selected<?php } ?>>Square2</option>
								<option value="dot" <?php if($pp_bg_pattern == 'dot') { ?>selected=selected<?php } ?>>Dot</option>
								<option value="circle" <?php if($pp_bg_pattern == 'circle') { ?>selected=selected<?php } ?>>Circle</option>
								<option value="flower" <?php if($pp_bg_pattern == 'flower') { ?>selected=selected<?php } ?>>Flower1</option>
								<option value="flower2" <?php if($pp_bg_pattern == 'flower2') { ?>selected=selected<?php } ?>>Flower2</option>
								<option value="flower3" <?php if($pp_bg_pattern == 'flower3') { ?>selected=selected<?php } ?>>Flower3</option>
								<option value="flower4" <?php if($pp_bg_pattern == 'flower4') { ?>selected=selected<?php } ?>>Flower4</option>
								<option value="flower5" <?php if($pp_bg_pattern == 'flower5') { ?>selected=selected<?php } ?>>Flower5</option>
								<option value="flower6" <?php if($pp_bg_pattern == 'flower6') { ?>selected=selected<?php } ?>>Flower6</option>
								<option value="gear" <?php if($pp_bg_pattern == 'gear') { ?>selected=selected<?php } ?>>Gear</option>
								<option value="mosaic" <?php if($pp_bg_pattern == 'mosaic') { ?>selected=selected<?php } ?>>Mosaic</option>
								<option value="metal" <?php if($pp_bg_pattern == 'metal') { ?>selected=selected<?php } ?>>Metal</option>
								<option value="jeans" <?php if($pp_bg_pattern == 'jeans') { ?>selected=selected<?php } ?>>Jeans</option>
								<option value="bokeh" <?php if($pp_bg_pattern == 'bokeh') { ?>selected=selected<?php } ?>>Bokeh</option>
							</select>
						
						<br/><br/><br/>
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