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
	wp_enqueue_style("colorpicker.css", get_stylesheet_directory_uri()."/js/colorpicker/css/colorpicker.css", false, $pp_theme_version, "all");
	wp_enqueue_style("screen_css", get_stylesheet_directory_uri()."/css/screen.css", false, $pp_theme_version, "all");
	wp_enqueue_style("fancybox_css", get_stylesheet_directory_uri()."/js/fancybox/jquery.fancybox-1.3.0.css", false, $pp_theme_version, "all");
	wp_enqueue_style("videojs_css", get_stylesheet_directory_uri()."/js/video-js.css", false, $pp_theme_version, "all");
	wp_enqueue_style("vim_css", get_stylesheet_directory_uri()."/js/skins/vim.css", false, $pp_theme_version, "all");
?>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" charset="utf-8" src="http://ajax.googleapis.com/ajax/libs/swfobject/2.1/swfobject.js"></script>

<?php
	wp_enqueue_script("jquery", get_stylesheet_directory_uri()."/js/jquery.js", false, $pp_theme_version);
	wp_enqueue_script("jquery.ui_js", get_stylesheet_directory_uri()."/js/jquery.ui.js", false, $pp_theme_version);
	wp_enqueue_script("colorpicker.js", get_stylesheet_directory_uri()."/js/colorpicker.js", false, $pp_theme_version);
	wp_enqueue_script("fancybox_js", get_stylesheet_directory_uri()."/js/fancybox/jquery.fancybox-1.3.0.js", false, $pp_theme_version);
	wp_enqueue_script("jQuery_easing", get_stylesheet_directory_uri()."/js/jquery.easing.js", false, $pp_theme_version);
	wp_enqueue_script("jQuery_nivo", get_stylesheet_directory_uri()."/js/jquery.nivoslider.js", false, $pp_theme_version);
	wp_enqueue_script("jQuery_gmap", get_stylesheet_directory_uri()."/js/gmap.js", false, $pp_theme_version);
	wp_enqueue_script("jQuery_validate", get_stylesheet_directory_uri()."/js/jquery.validate.js", false, $pp_theme_version);
	wp_enqueue_script("jquery.tubular.js", get_stylesheet_directory_uri()."/js/jquery.tubular.js", false, $pp_theme_version);
	wp_enqueue_script("browser_js", get_stylesheet_directory_uri()."/js/browser.js", false, $pp_theme_version);
	wp_enqueue_script("video_js", get_stylesheet_directory_uri()."/js/video.js", false, $pp_theme_version);
	wp_enqueue_script("jquery_backstretch", get_stylesheet_directory_uri()."/js/jquery.backstretch.js", false, $pp_theme_version);
	wp_enqueue_script("hint.js", get_stylesheet_directory_uri()."/js/hint.js", false, $pp_theme_version);
	wp_enqueue_script("jquery.flip.min.js", get_stylesheet_directory_uri()."/js/jquery.flip.min.js", false, $pp_theme_version);
	wp_enqueue_script("jquery.mousewheel.min.js", get_stylesheet_directory_uri()."/js/jquery-mousewheel-3.0.4/jquery.mousewheel.min.js", false, $pp_theme_version);
	wp_enqueue_script("jquery.jplayer.min.js", get_stylesheet_directory_uri()."/js/jquery.jplayer.min.js", false, $pp_theme_version);
	wp_enqueue_script("kenburns.js", get_stylesheet_directory_uri()."/js/kenburns.js", false, $pp_theme_version);
	wp_enqueue_script("custom_js", get_stylesheet_directory_uri()."/js/custom.js", false, $pp_theme_version);
	
	wp_register_script("script-contact-form", get_stylesheet_directory_uri()."/js/contact_form.js", false, THEMEVERSION, true);
	$params = array(
	  'ajaxurl' => curPageURL(),
	  'ajax_nonce' => wp_create_nonce('tgajax-post-contact-nonce'),
	);
	wp_localize_script( 'script-contact-form', 'tgAjax', $params );
	wp_enqueue_script("script-contact-form", get_stylesheet_directory_uri()."/js/contact_form.js", false, THEMEVERSION, true);
	
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
		wp_enqueue_style('google_fonts', "http://fonts.googleapis.com/css?family=".$pp_font."&subset=latin,cyrillic", false, "", "all");
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

<!--[if IE 7]>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/ie7.css" type="text/css" media="all"/>
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
	$pp_logo_height = get_option('pp_logo_height');
	
	if(!empty($pp_logo_height))
	{
?>
.logo_wrapper { height:<?php echo $pp_logo_height; ?>px; }
<?php
	}
	
	$pp_enable_hide_menu = get_option('pp_enable_hide_menu');
	
	if(empty($pp_enable_hide_menu))
	{
?>
.nav, .subnav { display: block; }
<?php
	}

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
	
	$pp_logo_bg_color = get_option('pp_logo_bg_color');
	if(!empty($pp_logo_bg_color))
	{
?>
.logo_wrapper, .nav, .subnav, .nav li ul, .nav li ul li ul
{
	background: <?php echo $pp_logo_bg_color; ?>;
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
	
	$pp_active_skin_color = get_option('pp_active_skin_color');
	
	if(!empty($pp_active_skin_color))
	{
?>
.nav li.current-menu-item > a, .nav li > a:hover, .nav li > a.hover, .nav li > a:active, .nav li.current-menu-parent > a, .nav li.current-menu-item > a, .nav li > a:hover, .nav li > a.hover, .nav li > a:active, .nav li.current-menu-parent > a { border-bottom: 2px solid <?php echo $pp_active_skin_color; ?>; }
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
	text-shadow: -1px 0 1px #333;
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

$pp_timer_bar = get_option('pp_timer_bar');

if(empty($pp_timer_bar))
{
?>
#progress-back { visibility:hidden; }		
<?php
}

$iPhone = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
$iPad = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");

if( $iPad OR $iPhone )
{
?>
#supersized_overlay { visibility: hidden; }
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

	<div class="social_wrapper">
	    <ul>
	    	<?php
	    		$pp_twitter_username = get_option('pp_twitter_username');
	    		
	    		if(!empty($pp_twitter_username))
	    		{
	    	?>
	    	<li><a href="http://twitter.com/<?php echo $pp_twitter_username; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/social/twitter.png" alt=""/></a></li>
	    	<?php
	    		}
	    	?>
	    	<?php
	    		$pp_facebook_username = get_option('pp_facebook_username');
	    		
	    		if(!empty($pp_facebook_username))
	    		{
	    	?>
	    	<li><a href="http://facebook.com/<?php echo $pp_facebook_username; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/social/facebook.png" alt=""/></a></li>
	    	<?php
	    		}
	    	?>
	    	<?php
	    		$pp_flickr_username = get_option('pp_flickr_username');
	    		
	    		if(!empty($pp_flickr_username))
	    		{
	    	?>
	    	<li class="flickr"><a href="http://flickr.com/people/<?php echo $pp_flickr_username; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/social/flickr.png" alt=""/></a></li>
	    	<?php
	    		}
	    	?>
	    	<?php
	    		$pp_youtube_username = get_option('pp_youtube_username');
	    		
	    		if(!empty($pp_youtube_username))
	    		{
	    	?>
	    	<li><a href="http://youtube.com/user/<?php echo $pp_youtube_username; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/social/youtube.png" alt=""/></a></li>
	    	<?php
	    		}
	    	?>
	    	<?php
	    		$pp_vimeo_username = get_option('pp_vimeo_username');
	    		
	    		if(!empty($pp_vimeo_username))
	    		{
	    	?>
	    	<li><a href="http://vimeo.com/<?php echo $pp_vimeo_username; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/social/vimeo.png" alt=""/></a></li>
	    	<?php
	    		}
	    	?>
	    	<?php
	    		$pp_tumblr_username = get_option('pp_tumblr_username');
	    		
	    		if(!empty($pp_tumblr_username))
	    		{
	    	?>
	    	<li><a href="http://<?php echo $pp_tumblr_username; ?>.tumblr.com"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/social/tumblr.png" alt=""/></a></li>
	    	<?php
	    		}
	    	?>
	    </ul>
	</div>

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
		    
		    	Active Skin Color<br/>
		    	<div id="pp_active_skin_color_preview" class="colorpicker_preview" style="background:#e6040c;margin-top:5px">&nbsp;</div>
		    	<input type="hidden" id="pp_active_skin_color" name="pp_active_skin_color" value="#e6040c" />
		    	
		    	<br/>
		    	
		    	Menu BG Color<br/>
		    	<div id="pp_logo_bg_color_preview" class="colorpicker_preview" style="background:#000000;margin-top:5px">&nbsp;</div>
		    	<input type="hidden" id="pp_logo_bg_color" name="pp_logo_bg_color" value="#000000" />
		    	
		    	<br/>
		    	
		    	Slide Control BG Color<br/>
		    	<div id="pp_control_bg_color_preview" class="colorpicker_preview" style="background:#000000;margin-top:5px">&nbsp;</div>
		    	<input type="hidden" id="pp_control_bg_color" name="pp_control_bg_color" value="#000000" />
		    	
		    	<br/>
		    	
		    	<?php
					// Get Google font list
					$pp_font_arr = array();
					
					$font_cache_path = TEMPLATEPATH.'/cache/gg_fonts.cache';
					
					if(file_exists($font_cache_path))
					{
					    $font_cache_timer = intval((time()-filemtime($font_cache_path))/60);
					}
					else
					{
					    $font_cache_timer = 0;
					}
					
					
					if(!file_exists($font_cache_path) OR $font_cache_timer > 1440)
					{
						$fonts_seraliazed = file_get_contents('http://phat-reaction.com/googlefonts.php?format=php');
						$pp_font_arr = unserialize($fonts_seraliazed);
						
						if(file_exists($font_cache_path))
						{
						    unlink($font_cache_path);
						}
						
						$myFile = $font_cache_path;
						$fh = fopen($myFile, 'w') or die("can't open file");
						fwrite($fh, $fonts_seraliazed);
						fclose($fh);
					}
					else
					{
						$file = file_get_contents($font_cache_path, true);
						$pp_font_arr = unserialize($file);
					}
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
		    	Sample Header Fonts from Google Web Fonts (200+ fonts you can choose from DK Theme)<br/>
		    	<select name="pp_font" id="pp_font" style="margin-top:5px">
					<option value="" data-family="">Default</option>
					<?php 
						foreach ($pp_font_arr as $key => $option) { 
					?>
					<option <?php if($option['css-name']==$pp_font) { echo 'selected="selected"'; } ?> value="<?php echo $option['css-name']; ?>" data-family="<?php echo $option['font-name']; ?>"><?php echo $option['font-name']; ?></option>
					<?php } ?>
				</select> 
				<input type="hidden" id="pp_font_family" name="pp_font_family" value="<?php echo $pp_font_family; ?>"/>
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