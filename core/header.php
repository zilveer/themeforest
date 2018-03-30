<?php
/**
 * The Header for the template.
 *
 * @package WordPress
 */
 
if(session_id() == '') {
	session_start();
}
session_destroy();
$pp_theme_version = THEMEVERSION;
 
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
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/data/<?php echo $pp_favicon; ?>" />
<?php
	}
?>

<!-- Template stylesheet -->
<?php
	wp_enqueue_style("screen_css", get_template_directory_uri()."/css/screen.css", false, $pp_theme_version, "all");
	wp_enqueue_style("grid_css", get_template_directory_uri()."/css/grid.css", false, $pp_theme_version, "all");
	wp_enqueue_style("fancybox_css", get_template_directory_uri()."/js/fancybox/jquery.fancybox.css", false, $pp_theme_version, "all");
	wp_enqueue_style("videojs_css", get_template_directory_uri()."/js/video-js.css", false, $pp_theme_version, "all");
	wp_enqueue_style("vim_css", get_template_directory_uri()."/js/skins/vim.css", false, $pp_theme_version, "all");
	
	if(isset($_SESSION['pp_skin']))
	{
	    $pp_skin = $_SESSION['pp_skin'];
	}
	else
	{
	    $pp_skin = get_option('pp_skin');
	}
	
	if($pp_skin == 'dark')
	{
		wp_enqueue_style("dark.css", get_template_directory_uri()."/css/dark.css", false, $pp_theme_version, "all");
	}
?>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" charset="utf-8" src="http://ajax.googleapis.com/ajax/libs/swfobject/2.1/swfobject.js"></script>

<?php
	wp_enqueue_script("jquery", get_template_directory_uri()."/js/jquery.js", false, $pp_theme_version);
	wp_enqueue_script("jquery.ui_js", get_template_directory_uri()."/js/jquery.ui.js", false, $pp_theme_version);
	wp_enqueue_script("fancybox_js", get_template_directory_uri()."/js/fancybox/jquery.fancybox.pack.js", false, $pp_theme_version);
	wp_enqueue_script("jQuery_easing", get_template_directory_uri()."/js/jquery.easing.js", false, $pp_theme_version);
	wp_enqueue_script("jQuery_nivo", get_template_directory_uri()."/js/jquery.nivoslider.js", false, $pp_theme_version);
	wp_enqueue_script("jquery.touchwipe.1.1.1", get_template_directory_uri()."/js/jquery.touchwipe.1.1.1.js", false, $pp_theme_version);
	wp_enqueue_script("jquery.ppflip.js", get_template_directory_uri()."/js/jquery.ppflip.js", false, $pp_theme_version);
	wp_enqueue_script("jquery.tubular.js", get_template_directory_uri()."/js/jquery.tubular.js", false, $pp_theme_version);
	wp_enqueue_script("jQuery_gmap", get_template_directory_uri()."/js/gmap.js", false, $pp_theme_version);
	wp_enqueue_script("jQuery_validate", get_template_directory_uri()."/js/jquery.validate.js", false, $pp_theme_version);
	wp_enqueue_script("hint.js", get_template_directory_uri()."/js/hint.js", false, $pp_theme_version);
	wp_enqueue_script("browser_js", get_template_directory_uri()."/js/browser.js", false, $pp_theme_version);
	wp_enqueue_script("video_js", get_template_directory_uri()."/js/video.js", false, $pp_theme_version);
	wp_enqueue_script("jquery.jplayer.min.js", get_template_directory_uri()."/js/jquery.jplayer.min.js", false, $pp_theme_version);
	wp_enqueue_script("kenburns.js", get_template_directory_uri()."/js/kenburns.js", false, $pp_theme_version);
	wp_enqueue_script("custom_js", get_template_directory_uri()."/js/custom.js", false, $pp_theme_version);
	
	wp_register_script("script-contact-form", get_template_directory_uri()."/templates/script-contact-form.php", false, THEMEVERSION, true);
	$params = array(
	  'ajaxurl' => curPageURL(),
	  'ajax_nonce' => wp_create_nonce('tgajax-post-contact-nonce'),
	);
	wp_localize_script( 'script-contact-form', 'tgAjax', $params );
	wp_enqueue_script("script-contact-form", get_template_directory_uri()."/templates/script-contact-form.php", false, THEMEVERSION, true);
	
	if(isset($_SESSION['pp_font_family']))
	{
		$pp_font = $_SESSION['pp_font_family'];
	}
	else
	{
		$pp_font = get_option('pp_font_family');
	}
	$pp_font = urlencode($pp_font);
	
	if(!empty($pp_font))
	{
		wp_enqueue_style('google_fonts', "http://fonts.googleapis.com/css?family=".$pp_font."&subset=latin,cyrillic-ext,greek-ext,cyrillic", false, "", "all");
	}
	else
	{
		wp_enqueue_style('google_fonts', "http://fonts.googleapis.com/css?", false, "", "all");
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

<!--[if lte IE 8]>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/ie.css?v=<?php echo $pp_theme_version; ?>.css" type="text/css" media="all"/>
<![endif]-->

<!--[if lt IE 8]>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/ie7.css?v=<?php echo $pp_theme_version; ?>" type="text/css" media="all"/>
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

<?php
$pp_enable_dragging = get_option('pp_enable_dragging');

if(!empty($pp_enable_dragging))
{
?>
<script type="text/javascript" language="javascript">
    $j(document).ready(function(){ 
        $j("img").mousedown(function(){
		    return false;
		});
    }); 
</script>
<?php
}
?>

<style type="text/css">

<?php
	$pp_enable_stretch_menu = get_option('pp_enable_stretch_menu');
	
	if(!empty($pp_enable_stretch_menu))
	{
?>
.top_bar_wrapper { width: 96% !important; }
<?php
	}
	
?>

<?php
	$pp_page_font_size = get_option('pp_page_font_size');
	
	if(!empty($pp_page_font_size))
	{
?>
body, #page_content_wrapper .sidebar .content .posts.blog { font-size:<?php echo $pp_page_font_size; ?>px; }
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
	$pp_page_header_size = get_option('pp_page_header_size');
	
	if(!empty($pp_page_header_size))
	{
?>
.page_caption h1 { font-size:<?php echo $pp_page_header_size; ?>px; }
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
	$pp_flow_scroll_bar = get_option('pp_flow_scroll_bar');
	
	if(empty($pp_flow_scroll_bar))
	{
?>
#imageFlow .scrollbar { display:none; }
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
h1, h2, h3, h4, h5, h6, .nav, .subnav, #footer { font-family: '<?php echo $pp_font_family; ?>'; }		
<?php
	}
?>
@media only screen and (min-width: 768px) and (max-width: 960px) {
	.page_caption h1 { font-size: 90px; }
	#bg { margin-top: 0; }
}
@media only screen and (min-width: 480px) and (max-width: 767px) {
	.page_caption h1 { font-size: 65px; }
	#bg { margin-top: 0; }
}
@media only screen and (max-width: 767px) {
	.page_caption h1 { font-size: 50px; }
	#bg { margin-top: 0; }
}
</style>

</head>

<?php
	if(isset($_SESSION['pp_portfolio_style']))
	{
		$pp_portfolio_style_class = 'pp_'.$_SESSION['pp_portfolio_style'];
	}
	else
	{
		$pp_portfolio_style_class = 'pp_'.get_option('pp_portfolio_style');
	}
?>

<body <?php body_class(); ?> id="<?php echo $pp_portfolio_style_class; ?>">

	<?php
		if(isset($_SESSION['pp_skin']))
		{
		    $pp_skin = $_SESSION['pp_skin'];
		}
		else
		{
		    $pp_skin = get_option('pp_skin');
		}
	
		if($pp_skin == 'dark')
		{
	?>
		<input type="hidden" id="skin_color" name="skin_color" value="000000"/>
	<?php
		}
		else
		{
	?>
		<input type="hidden" id="skin_color" name="skin_color" value="ffffff"/>
	<?php
		}
	?>
	
	<?php
		$pp_auto_start = get_option('pp_auto_start');
	?>
	<input type="hidden" id="pp_auto_start" name="pp_auto_start" value="<?php echo $pp_auto_start; ?>"/>
	
	<?php
		$pp_enable_reflection = get_option('pp_enable_reflection');
	?>
	<input type="hidden" id="pp_enable_reflection" name="pp_enable_reflection" value="<?php echo $pp_enable_reflection; ?>"/>

	<!-- Begin template wrapper -->
	<div id="wrapper">
		<div id="top_bar">
			
			<div class="top_bar_wrapper">
			<!-- Begin logo -->
					
			<?php
				//get custom logo
				$pp_logo = get_option('pp_logo');
							
				if(empty($pp_logo))
				{
					if(isset($_SESSION['pp_skin']))
					{
					    $pp_skin = $_SESSION['pp_skin'];
					}
					else
					{
					    $pp_skin = get_option('pp_skin');
					}
	
					if($pp_skin == 'dark')
					{
						$pp_logo = get_template_directory_uri().'/images/logo_white.png';
					}
					else
					{
						$pp_logo = get_template_directory_uri().'/images/logo_grey.png';
					}
				}
				else
				{
					$pp_logo = get_template_directory_uri().'/data/'.$pp_logo;
				}

			?>
						
			<a id="custom_logo" class="logo_wrapper" href="<?php echo home_url(); ?>"><img src="<?php echo $pp_logo?>" alt=""/></a>
						
			<!-- End logo -->
		
		    <!-- Begin main nav -->
		    <div id="menu_border_wrapper">
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
		    
		    <div class="top_right">
		    <?php
		    	if(!isset($_GET['mode']) || $_GET['mode']!='f' || is_home())
		    	{
		    ?>
		    
		    	<div class="social_wrapper">
			    <ul>
			    	<?php
			    		$pp_twitter_username = get_option('pp_twitter_username');
			    		
			    		if(!empty($pp_twitter_username))
			    		{
			    	?>
			    	<li><a href="http://twitter.com/<?php echo $pp_twitter_username; ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/about_icon/twitter.png" alt=""/></a></li>
			    	<?php
			    		}
			    	?>
			    	<?php
			    		$pp_facebook_username = get_option('pp_facebook_username');
			    		
			    		if(!empty($pp_facebook_username))
			    		{
			    	?>
			    	<li><a href="http://facebook.com/<?php echo $pp_facebook_username; ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/about_icon/facebook.png" alt=""/></a></li>
			    	<?php
			    		}
			    	?>
			    	<?php
			    		$pp_pinterest_username = get_option('pp_pinterest_username');
			    		
			    		if(!empty($pp_pinterest_username))
			    		{
			    	?>
			    	<li><a href="http://pinterest.com/<?php echo $pp_pinterest_username; ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/about_icon/pinterest.png" alt=""/></a></li>
			    	<?php
			    		}
			    	?>
			    	<?php
			    		$pp_instagram_username = get_option('pp_instagram_username');
			    		
			    		if(!empty($pp_instagram_username))
			    		{
			    	?>
			    	<li><a href="http://instagram.com/<?php echo $pp_instagram_username; ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/about_icon/instagram.png" alt=""/></a></li>
			    	<?php
			    		}
			    	?>
			    	<?php
			    		$pp_flickr_username = get_option('pp_flickr_username');
			    		
			    		if(!empty($pp_flickr_username))
			    		{
			    	?>
			    	<li class="flickr"><a href="http://flickr.com/people/<?php echo $pp_flickr_username; ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/about_icon/flickr.png" alt=""/></a></li>
			    	<?php
			    		}
			    	?>
			    	<?php
			    		$pp_linkedin_url = get_option('pp_linkedin_url');
			    		
			    		if(!empty($pp_linkedin_url))
			    		{
			    	?>
			    	<li><a href="<?php echo $pp_linkedin_url; ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/about_icon/linkedin.png" alt=""/></a></li>
			    	<?php
			    		}
			    	?>
			    	<?php
			    		$pp_vimeo_username = get_option('pp_vimeo_username');
			    		
			    		if(!empty($pp_vimeo_username))
			    		{
			    	?>
			    	<li><a href="http://vimeo.com/<?php echo $pp_vimeo_username; ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/about_icon/vimeo.png" alt=""/></a></li>
			    	<?php
			    		}
			    	?>
			    	<?php
			    		$pp_tumblr_username = get_option('pp_tumblr_username');
			    		
			    		if(!empty($pp_tumblr_username))
			    		{
			    	?>
			    	<li><a href="http://<?php echo $pp_tumblr_username; ?>.tumblr.com" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/about_icon/tumblr.png" alt=""/></a></li>
			    	<?php
			    		}
			    	?>
			    </ul>
			</div>
			
			<?php
			if(isset($_SESSION['pp_homepage_slideshow_style']))
			{
				$pp_homepage_slideshow_style = $_SESSION['pp_homepage_slideshow_style'];
			}
			else
			{
				$pp_homepage_slideshow_style = get_option('pp_homepage_slideshow_style');
			}
			
			$isiPad = strpos($_SERVER['HTTP_USER_AGENT'],'iPad');
			$isiPhone = strpos($_SERVER['HTTP_USER_AGENT'],'iPhone');
			
			if(is_home() && $pp_homepage_slideshow_style != 'youtube_video' && !$isiPad && !$isiPhone)
			{
			    $pp_homepage_music_m4a = get_option('pp_homepage_music_m4a');
			    $pp_homepage_music_ogg = get_option('pp_homepage_music_ogg');
			    $pp_homepage_music_mp3 = get_option('pp_homepage_music_mp3');
			    			
			    if(!empty($pp_homepage_music_m4a) && !empty($pp_homepage_music_mp3) && !empty($pp_homepage_music_ogg))
			    {
			?>
			<!-- Audio Player -->
			<div id="jquery_jplayer_1"></div>
			<div id="jp_interface_1">
				<a href="#" class="jp-play">Play</a>
			    <a href="#" class="jp-pause">Pause</a>
			</div>
			<?php
				}
			?>
			<script>
			$j(document).ready(function() {
				<?php
				    if(!empty($pp_homepage_music_m4a) && !empty($pp_homepage_music_mp3) && !empty($pp_homepage_music_ogg))
				    {
				    	$pp_homepage_music_play_script = '';
						 $pp_homepage_music_play = get_option('pp_homepage_music_play');
						 
						 if(!empty($pp_homepage_music_play))
						 {
						 	$pp_homepage_music_play_script = '.jPlayer("play")';
						 }
				?>
			    $j("#jquery_jplayer_1").jPlayer({
			   	    ready: function () {
			   	        $j(this).jPlayer("setMedia", {
			   	        	mp3: "<?php echo get_template_directory_uri().'/data/'.$pp_homepage_music_mp3; ?>",
			   	           	m4a: "<?php echo get_template_directory_uri().'/data/'.$pp_homepage_music_m4a; ?>",
			   	            oga: "<?php echo get_template_directory_uri().'/data/'.$pp_homepage_music_ogg; ?>",
			   	            end: ""
			   	        })<?php echo $pp_homepage_music_play_script; ?>
			   	    },
			   	    //solution: "flash, html", // Flash with an HTML5 fallback.
			   	   	swfPath: "<?php echo get_template_directory_uri(); ?>/js/",
			   	    supplied: "mp3,m4a,oga"
			   	});
			   	<?php
			   		}
			   	?>
			});
			</script>
			<?php
			}
			?>
		    
		    <?php
		    	}
		    	else if(!is_home())
		    	{
		    		$gallery_link = get_permalink($post->ID);
		    ?>
		    	<a class="cufon" href="<?php echo $gallery_link; ?>">Return to main gallery</a>
		    	
		    <?php
		    	}
		    ?>
		    
		    </div>
		</div>
	</div>
