<?php
/**
 * The Header for the template.
 *
 * @package WordPress
 */
 
if (!isset( $content_width ) ) $content_width = 1170;

if(session_id() == '') {
	session_start();
}
 
global $pp_homepage_style;
?><!DOCTYPE html>
<html <?php language_attributes(); ?> <?php if(isset($pp_homepage_style) && !empty($pp_homepage_style)) { echo 'data-style="'.$pp_homepage_style.'"'; } ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta name="format-detection" content="telephone=no">

<title><?php wp_title('&lsaquo;', true, 'right'); ?><?php bloginfo('name'); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
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
if(is_single())
{	
	if(has_post_thumbnail(get_the_ID(), 'thumbnail'))
	{
	    $image_id = get_post_thumbnail_id(get_the_ID());
	    $fb_thumb = wp_get_attachment_image_src($image_id, 'thumbnail', true);
	}
	
	if(isset($fb_thumb[0]) && !empty($fb_thumb[0]))
	{
		$image_desc = get_post_field('post_content', $post->ID);
	?>
	<meta property="og:image" content="<?php echo $fb_thumb[0]; ?>"/>
	<meta property="og:title" content="<?php the_title(); ?>"/>
	<meta property="og:url" content="<?php echo get_permalink($post->ID); ?>"/>
	<meta property="og:description" content="<?php echo strip_tags($image_desc); ?>"/>
	<?php
	}
}
?>

<?php
	/**
    *	Setup code before </head>
    **/
	$pp_before_head_code = get_option('pp_before_head_code');
	
	if(!empty($pp_before_head_code))
	{
		echo stripslashes($pp_before_head_code);
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

<body <?php body_class(); ?> <?php if(isset($pp_homepage_style) && !empty($pp_homepage_style)) { echo 'data-style="'.$pp_homepage_style.'"'; } ?>>
	<?php
		//Check if disable right click
		$pp_enable_right_click = get_option('pp_enable_right_click');
		
		//Check if disable image dragging
		$pp_enable_dragging = get_option('pp_enable_dragging');
		
		//Check auto display gallery info
		$pp_gallery_auto_info = get_option('pp_gallery_auto_info');
		
		//Check if use reflection in flow gallery
		$pp_flow_enable_reflection = get_option('pp_flow_enable_reflection');
		
		//Check if use AJAX search
		$pp_blog_ajax_search = get_option('pp_blog_ajax_search');
		
		//Check if hide gallery info
		$pp_gallery_auto_info = get_option('pp_gallery_auto_info');
	?>
	<input type="hidden" id="pp_enable_reflection" name="pp_enable_reflection" value="<?php echo $pp_flow_enable_reflection; ?>"/>
	<input type="hidden" id="pp_enable_right_click" name="pp_enable_right_click" value="<?php echo $pp_enable_right_click; ?>"/>
	<input type="hidden" id="pp_enable_dragging" name="pp_enable_dragging" value="<?php echo $pp_enable_dragging; ?>"/>
	<input type="hidden" id="pp_gallery_auto_info" name="pp_gallery_auto_info" value="<?php echo $pp_gallery_auto_info; ?>"/>
	<input type="hidden" id="pp_image_path" name="pp_image_path" value="<?php echo get_template_directory_uri(); ?>/images/"/>
	<input type="hidden" id="pp_homepage_url" name="pp_homepage_url" value="<?php echo home_url(); ?>"/>
	<input type="hidden" id="pp_blog_ajax_search" name="pp_blog_ajax_search" value="<?php echo $pp_blog_ajax_search; ?>"/>
	<input type="hidden" id="pp_gallery_auto_info" name="pp_gallery_auto_info" value="<?php echo $pp_gallery_auto_info; ?>"/>
	
	<?php
		//Check footer sidebar columns
		$pp_footer_style = get_option('pp_footer_style');
	?>
	<input type="hidden" id="pp_footer_style" name="pp_footer_style" value="<?php echo $pp_footer_style; ?>"/>
	
	<!-- Begin mobile menu -->
	<div class="mobile_menu_wrapper">
	    <?php 	
	    	if ( has_nav_menu( 'primary-menu' ) ) 
			{
			    //Get page nav
			    wp_nav_menu( 
			        	array( 
			        		'menu_id'			=> 'mobile_main_menu',
	    		    		'menu_class'		=> 'mobile_main_nav',
			        		'theme_location' 	=> 'primary-menu',
			        	) 
			    ); 
			}
	    ?>
	</div>
	<!-- End mobile menu -->

	<!-- Begin template wrapper -->
	<div id="wrapper">
	
	<div class="header_style_wrapper">
		<?php
			//Get header style
			$page = get_page($post->ID);
			$current_page_id = '';
			
			if(isset($page->ID))
			{
			    $current_page_id = $page->ID;
			}
			elseif(is_home())
			{
				$current_page_id = get_option('page_on_front');
			}

			$page_header_style = get_post_meta($current_page_id, 'page_header_style', true);
			
			if(!empty($page_header_style))
			{
				$pp_header_style = $page_header_style;
			}
			else
			{
				$pp_header_style = get_option('pp_header_style');
			}
			
			//If fullscreen template then overide all header style
			if($pp_homepage_style == 'fullscreen' OR $pp_homepage_style == 'kenburns' OR $pp_homepage_style == 'flow' OR $pp_homepage_style == 'flip' OR $pp_homepage_style == 'fullscreen_video')
			{
				$pp_header_style = 1;
			}
			
			if($pp_header_style == 2 OR $pp_header_style == 3 OR $pp_header_style == 4)
			{
		?>
		<div class="above_top_bar">
			<div class="page_content_wrapper">
				<div class="top_contact_info">
				    <?php
				    	//Display top contact info
				    	
				        $pp_header_phone = get_option('pp_header_phone');
				        
				        if(!empty($pp_header_phone))
				        {
				    ?>
				        <span><?php echo $pp_header_phone; ?></span>
				    <?php
				        }
				    ?>
				    <?php
				        $pp_header_email = get_option('pp_header_email');
				        
				        if(!empty($pp_header_email))
				        {	
				    ?>
				        <span><?php echo $pp_header_email; ?></span>
				    <?php
				        }
				    ?>
				</div>
				
				<?php
				    //Display top social icons
				    
				    //Get Social icons color scheme
				    $pp_header_social_scheme = get_option('pp_header_social_scheme');
				    if(empty($pp_header_social_scheme))
				    {
					    $pp_header_social_scheme = 'social_black';
				    }
				    
				    //Check if open link in new window
					$pp_header_social_link_blank = get_option('pp_header_social_link_blank');
				?>
				<div class="social_wrapper">
				    <ul>
				    	<?php
				    		$pp_facebook_username = get_option('pp_facebook_username');
				    		
				    		if(!empty($pp_facebook_username))
				    		{
				    	?>
				    	<li class="facebook"><a <?php if(!empty($pp_header_social_link_blank)) { ?>target="_blank"<?php } ?> href="http://facebook.com/<?php echo $pp_facebook_username; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/<?php echo $pp_header_social_scheme; ?>/facebook.png" alt=""/></a></li>
				    	<?php
				    		}
				    	?>
				    	<?php
				    		$pp_twitter_username = get_option('pp_twitter_username');
				    		
				    		if(!empty($pp_twitter_username))
				    		{
				    	?>
				    	<li class="twitter"><a <?php if(!empty($pp_header_social_link_blank)) { ?>target="_blank"<?php } ?> href="http://twitter.com/<?php echo $pp_twitter_username; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/<?php echo $pp_header_social_scheme; ?>/twitter.png" alt=""/></a></li>
				    	<?php
				    		}
				    	?>
				    	<?php
				    		$pp_flickr_username = get_option('pp_flickr_username');
				    		
				    		if(!empty($pp_flickr_username))
				    		{
				    	?>
				    	<li class="flickr"><a <?php if(!empty($pp_header_social_link_blank)) { ?>target="_blank"<?php } ?> title="Flickr" href="http://flickr.com/people/<?php echo $pp_flickr_username; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/<?php echo $pp_header_social_scheme; ?>/flickr.png" alt=""/></a></li>
				    	<?php
				    		}
				    	?>
				    	<?php
				    		$pp_youtube_username = get_option('pp_youtube_username');
				    		
				    		if(!empty($pp_youtube_username))
				    		{
				    	?>
				    	<li class="youtube"><a <?php if(!empty($pp_header_social_link_blank)) { ?>target="_blank"<?php } ?> title="Youtube" href="http://youtube.com/channel/<?php echo $pp_youtube_username; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/<?php echo $pp_header_social_scheme; ?>/youtube.png" alt=""/></a></li>
				    	<?php
				    		}
				    	?>
				    	<?php
				    		$pp_vimeo_username = get_option('pp_vimeo_username');
				    		
				    		if(!empty($pp_vimeo_username))
				    		{
				    	?>
				    	<li class="vimeo"><a <?php if(!empty($pp_header_social_link_blank)) { ?>target="_blank"<?php } ?> title="Vimeo" href="http://vimeo.com/<?php echo $pp_vimeo_username; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/<?php echo $pp_header_social_scheme; ?>/vimeo.png" alt=""/></a></li>
				    	<?php
				    		}
				    	?>
				    	<?php
				    		$pp_tumblr_username = get_option('pp_tumblr_username');
				    		
				    		if(!empty($pp_tumblr_username))
				    		{
				    	?>
				    	<li class="tumblr"><a <?php if(!empty($pp_header_social_link_blank)) { ?>target="_blank"<?php } ?> title="Tumblr" href="http://<?php echo $pp_tumblr_username; ?>.tumblr.com"><img src="<?php echo get_template_directory_uri(); ?>/images/<?php echo $pp_header_social_scheme; ?>/tumblr.png" alt=""/></a></li>
				    	<?php
				    		}
				    	?>
				    	<?php
				    		$pp_google_username = get_option('pp_google_username');
				    		
				    		if(!empty($pp_google_username))
				    		{
				    	?>
				    	<li class="google"><a <?php if(!empty($pp_header_social_link_blank)) { ?>target="_blank"<?php } ?> title="Google+" href="<?php echo $pp_google_username; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/<?php echo $pp_header_social_scheme; ?>/google.png" alt=""/></a></li>
				    	<?php
				    		}
				    	?>
				    	<?php
				    		$pp_dribbble_username = get_option('pp_dribbble_username');
				    		
				    		if(!empty($pp_dribbble_username))
				    		{
				    	?>
				    	<li class="dribbble"><a <?php if(!empty($pp_header_social_link_blank)) { ?>target="_blank"<?php } ?> title="Dribbble" href="http://dribbble.com/<?php echo $pp_dribbble_username; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/<?php echo $pp_header_social_scheme; ?>/dribbble.png" alt=""/></a></li>
				    	<?php
				    		}
				    	?>
				    	<?php
				    		$pp_linkedin_username = get_option('pp_linkedin_username');
				    		
				    		if(!empty($pp_linkedin_username))
				    		{
				    	?>
				    	<li class="linkedin"><a <?php if(!empty($pp_header_social_link_blank)) { ?>target="_blank"<?php } ?> title="Linkedin" href="<?php echo $pp_linkedin_username; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/<?php echo $pp_header_social_scheme; ?>/linkedin.png" alt=""/></a></li>
				    	<?php
				    		}
				    	?>
				    	<?php
				            $pp_pinterest_username = get_option('pp_pinterest_username');
				            
				            if(!empty($pp_pinterest_username))
				            {
				        ?>
				        <li class="pinterest"><a <?php if(!empty($pp_header_social_link_blank)) { ?>target="_blank"<?php } ?> title="Pinterest" href="http://pinterest.com/<?php echo $pp_pinterest_username; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/<?php echo $pp_header_social_scheme; ?>/pinterest.png" alt=""/></a></li>
				        <?php
				            }
				        ?>
				        <?php
				        	$pp_instagram_username = get_option('pp_instagram_username');
				        	
				        	if(!empty($pp_instagram_username))
				        	{
				        ?>
				        <li class="instagram"><a <?php if(!empty($pp_header_social_link_blank)) { ?>target="_blank"<?php } ?> title="Instagram" href="http://instagram.com/<?php echo $pp_instagram_username; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/<?php echo $pp_header_social_scheme; ?>/instagram.png" alt=""/></a></li>
				        <?php
				        	}
				        ?>
				    </ul>
				</div>
			</div>
		</div>
		<?php
			}
		?>
		
		<div class="top_bar <?php if(isset($pp_homepage_style) && !empty($pp_homepage_style)) { echo $pp_homepage_style; } ?> header_style<?php echo $pp_header_style; ?>">
		
			<div id="mobile_nav_icon"></div>
		
			<div id="menu_wrapper">
				
				<!-- Begin logo -->	
				<?php
				    //get custom logo
				    $pp_logo = get_option('pp_logo');
				    $pp_retina_logo = get_option('pp_retina_logo');
				    $pp_retina_logo_width = 0;
				    $pp_retina_logo_height = 0;
				    			
				    if(empty($pp_logo) && empty($pp_retina_logo))
				    {
				    	$pp_retina_logo = get_template_directory_uri().'/images/logo_bus@2x.png';
				    	$pp_retina_logo_width = 116;
				    	$pp_retina_logo_height = 21;
				    }
				    
				    if(!empty($pp_retina_logo))
				    {
				    	if(empty($pp_retina_logo_width) && empty($pp_retina_logo_height))
				    	{
				    		//Get image width and height
				    		$pp_retina_logo_id = pp_get_image_id($pp_retina_logo);
				    		$image_logo = wp_get_attachment_image_src($pp_retina_logo_id, 'original');
				    		
				    		$pp_retina_logo = $image_logo[0];
				    		$pp_retina_logo_width = $image_logo[1]/2;
				    		$pp_retina_logo_height = $image_logo[2]/2;
				    	}
				?>		
				    <a id="custom_logo" class="logo_wrapper" href="<?php echo home_url(); ?>">
				    	<img src="<?php echo $pp_retina_logo; ?>" alt="" width="<?php echo $pp_retina_logo_width; ?>" height="<?php echo $pp_retina_logo_height; ?>"/>
				    </a>
				<?php
				    }
				    else //if not retina logo
				    {
				?>
				    <a id="custom_logo" class="logo_wrapper" href="<?php echo home_url(); ?>">
				    	<img src="<?php echo $pp_logo?>" alt=""/>
				    </a>
				<?php
				    }
				?>
				<!-- End logo -->
				
				<?php
				    //Check if display search in header
				    $pp_ajax_search_header = get_option('pp_ajax_search_header');
				    
				    if(!empty($pp_ajax_search_header))
				    {
				?>
				<form role="search" method="get" name="searchform" id="searchform" action="<?php echo home_url(); ?>/">
				    <div>
				    	<label for="s"><?php echo _e( 'To Search, type and hit enter', THEMEDOMAIN ); ?></label>
				    	<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" autocomplete="off"/>
				    	<button>
				        	<i class="fa fa-search"></i>
				        </button>
				    </div>
				    <div id="autocomplete"></div>
				</form>
				<?php
				    }
				?>
				
			    <!-- Begin main nav -->
			    <div id="nav_wrapper" class="header_style<?php echo $pp_header_style; ?>">
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
		</div>
		<?php
			//Reset Header Style Session
			if(isset($_SESSION['pp_header_style']))
			{
				unset($_SESSION['pp_header_style']);
			}
		?>
		
		<?php
			//Check if theme demo then enable layout switcher
			if(THEMEDEMO)
		    {
		?>
		<form action="<?php echo get_stylesheet_directory_uri(); ?>/switcher.php" method="get" id="form_option" name="form_option">
		    <div id="option_wrapper">
		    <div class="inner">
		    	<strong class="header">Style Switcher</strong><br/>
		    	
		    	Choose Theme Layout<br/>
		    	<?php
		    		if(isset($_SESSION['pp_layout']) && !empty($_SESSION['pp_layout']))
					{
						$pp_layout = $_SESSION['pp_layout'];
					}
					else
					{
						$pp_layout = get_option('pp_layout');
					}
		    	?>
		    	<select name="pp_layout" id="pp_layout" style="margin-top:5px">
		    	    <option value="wide" <?php if($pp_layout == 'wide') { ?>selected=selected<?php } ?>>Wide</option>
		    	    <option value="boxed" <?php if($pp_layout == 'boxed') { ?>selected=selected<?php } ?>>Boxed</option>
		    	</select>
		    	
		    	<br/><br/><hr/><br/>
		    	Background For Boxed Layout<br/>
		    	<a href="<?php echo get_stylesheet_directory_uri(); ?>/switcher.php?pp_boxed_bg_image=<?php echo urlencode(site_url().'/wp-content/uploads/2014/03/shutterstock_110245013.jpg'); ?>" class="option_background" style="background:url('<?php echo site_url(); ?>/wp-content/uploads/2014/03/shutterstock_110245013-150x150.jpg')"></a>
		    	<a href="<?php echo get_stylesheet_directory_uri(); ?>/switcher.php?pp_boxed_bg_image=<?php echo urlencode(site_url().'/wp-content/uploads/2014/03/shutterstock_54860026.jpg'); ?>" class="option_background" style="background:url('<?php echo site_url(); ?>/wp-content/uploads/2014/03/shutterstock_54860026-150x150.jpg')"></a>
		    	<a href="<?php echo get_stylesheet_directory_uri(); ?>/switcher.php?pp_boxed_bg_image=<?php echo urlencode(site_url().'/wp-content/uploads/2014/03/shutterstock_60966694.jpg'); ?>" class="option_background" style="background:url('<?php echo site_url(); ?>/wp-content/uploads/2014/03/shutterstock_60966694-150x150.jpg')"></a>
		    	<a href="<?php echo get_stylesheet_directory_uri(); ?>/switcher.php?pp_boxed_bg_image=<?php echo urlencode(site_url().'/wp-content/uploads/2014/03/shutterstock_83069308.jpg'); ?>" class="option_background" style="background:url('<?php echo site_url(); ?>/wp-content/uploads/2014/03/shutterstock_83069308-150x150.jpg')"></a>
		    	
		    	<br class="clear"/><br/>
		    	<a style="color: #333;" href="<?php echo get_stylesheet_directory_uri(); ?>/switcher.php?reset=1">Reset Styles</a>
		    </div>
		    </div>
		    <div id="option_btn">
		    	<i class="fa fa-chevron-right"></i>
		    </div>
		</form>
		<?php
		    }
		?>