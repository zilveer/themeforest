<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 */
 
?>

<?php
	//Check if blank template
	$grandportfolio_screen_class = grandportfolio_get_screen_class();
	$grandportfolio_homepage_style = grandportfolio_get_homepage_style();
	
	//If display photostream
	$pp_photostream = get_option('pp_photostream');
	if(THEMEDEMO && isset($_GET['footer']) && !empty($_GET['footer']))
	{
		$pp_photostream = 0;
	}

	if(!empty($pp_photostream))
	{
		$photos_arr = array();
	
		if($pp_photostream == 'flickr')
		{
			$pp_flickr_id = get_option('pp_flickr_id');
			$photos_arr = grandportfolio_get_flickr(array('type' => 'user', 'id' => $pp_flickr_id, 'items' => 27));
		}
		else
		{
			$pp_instagram_username = get_option('pp_instagram_username');
			$pp_instagram_access_token = get_option('pp_instagram_access_token');
			$photos_arr = grandportfolio_get_instagram($pp_instagram_username, $pp_instagram_access_token, 27);
		}
		
		if(!empty($photos_arr) && $grandportfolio_screen_class != 'split' && $grandportfolio_screen_class != 'split wide' && $grandportfolio_homepage_style != 'fullscreen' && $grandportfolio_homepage_style != 'flow')
		{
			wp_enqueue_script("modernizr", get_template_directory_uri()."/js/modernizr.js", false, THEMEVERSION, true);
			wp_enqueue_script("gridrotator", get_template_directory_uri()."/js/jquery.gridrotator.js", false, THEMEVERSION, true);
			wp_enqueue_script("grandportfolio-script-gridrotator", get_template_directory_uri()."/js/script/script-gridrotator.js", false, THEMEVERSION, true);
?>
<br class="clear"/>
<div id="footer_photostream" class="footer_photostream_wrapper ri-grid ri-grid-size-3">
	<h2 class="widgettitle photostream">
		<?php
			if($pp_photostream == 'instagram')
			{
		?>
			<i class="fa fa-instagram marginright"></i><?php echo esc_html($pp_instagram_username); ?>
		<?php
			}
			else
			{
		?>
			<i class="fa fa-flickr marginright"></i>Flickr
		<?php
			}
		?>
	</h2>
	<ul>
		<?php
			foreach($photos_arr as $photo)
			{
		?>
			<li><a target="_blank" href="<?php echo esc_url($photo['link']); ?>"><img src="<?php echo esc_url($photo['thumb_url']); ?>" alt="" /></a></li>
		<?php
			}
		?>
	</ul>
</div>
<?php
		}
	}
?>

<?php
	//Get Footer Sidebar
	$tg_footer_sidebar = kirki_get_option('tg_footer_sidebar');
	if(THEMEDEMO && isset($_GET['footer']) && !empty($_GET['footer']))
	{
	    $tg_footer_sidebar = 0;
	}
?>
<div class="footer_bar <?php if(isset($grandportfolio_homepage_style) && !empty($grandportfolio_homepage_style)) { echo esc_attr($grandportfolio_homepage_style); } ?> <?php if(!empty($grandportfolio_screen_class)) { echo esc_attr($grandportfolio_screen_class); } ?>">

	<?php
	    if(!empty($tg_footer_sidebar))
	    {
	    	$footer_class = '';
	    	
	    	switch($tg_footer_sidebar)
	    	{
	    		case 1:
	    			$footer_class = 'one';
	    		break;
	    		case 2:
	    			$footer_class = 'two';
	    		break;
	    		case 3:
	    			$footer_class = 'three';
	    		break;
	    		case 4:
	    			$footer_class = 'four';
	    		break;
	    		default:
	    			$footer_class = 'four';
	    		break;
	    	}
	    	
	    	$grandportfolio_homepage_style = grandportfolio_get_homepage_style();
	?>
	<div id="footer" class="<?php if(isset($grandportfolio_homepage_style) && !empty($grandportfolio_homepage_style)) { echo esc_attr($grandportfolio_homepage_style); } ?>">
	<ul class="sidebar_widget <?php echo esc_attr($footer_class); ?>">
	    <?php dynamic_sidebar('Footer Sidebar'); ?>
	</ul>
	</div>
	<br class="clear"/>
	<?php
	    }
	?>

	<div class="footer_bar_wrapper <?php if(isset($grandportfolio_homepage_style) && !empty($grandportfolio_homepage_style)) { echo esc_attr($grandportfolio_homepage_style); } ?>">
		<?php
			//Check if display social icons or footer menu
			$tg_footer_copyright_right_area = kirki_get_option('tg_footer_copyright_right_area');
			
			if($tg_footer_copyright_right_area=='social')
			{
				if($grandportfolio_homepage_style!='flow' && $grandportfolio_homepage_style!='fullscreen' && $grandportfolio_homepage_style!='carousel' && $grandportfolio_homepage_style!='flip' && $grandportfolio_homepage_style!='fullscreen_video')
				{	
					//Check if open link in new window
					$tg_footer_social_link = kirki_get_option('tg_footer_social_link');
			?>
			<div class="social_wrapper">
			    <ul>
			    	<?php
			    		$pp_facebook_url = get_option('pp_facebook_url');
			    		
			    		if(!empty($pp_facebook_url))
			    		{
			    	?>
			    	<li class="facebook"><a <?php if(!empty($tg_footer_social_link)) { ?>target="_blank"<?php } ?> href="<?php echo esc_url($pp_facebook_url); ?>"><i class="fa fa-facebook-official"></i></a></li>
			    	<?php
			    		}
			    	?>
			    	<?php
			    		$pp_twitter_username = get_option('pp_twitter_username');
			    		
			    		if(!empty($pp_twitter_username))
			    		{
			    	?>
			    	<li class="twitter"><a <?php if(!empty($tg_footer_social_link)) { ?>target="_blank"<?php } ?> href="http://twitter.com/<?php echo esc_attr($pp_twitter_username); ?>"><i class="fa fa-twitter"></i></a></li>
			    	<?php
			    		}
			    	?>
			    	<?php
			    		$pp_flickr_username = get_option('pp_flickr_username');
			    		
			    		if(!empty($pp_flickr_username))
			    		{
			    	?>
			    	<li class="flickr"><a <?php if(!empty($tg_footer_social_link)) { ?>target="_blank"<?php } ?> title="Flickr" href="http://flickr.com/people/<?php echo esc_attr($pp_flickr_username); ?>"><i class="fa fa-flickr"></i></a></li>
			    	<?php
			    		}
			    	?>
			    	<?php
			    		$pp_youtube_url = get_option('pp_youtube_url');
			    		
			    		if(!empty($pp_youtube_url))
			    		{
			    	?>
			    	<li class="youtube"><a <?php if(!empty($tg_footer_social_link)) { ?>target="_blank"<?php } ?> title="Youtube" href="<?php echo esc_url($pp_youtube_url); ?>"><i class="fa fa-youtube"></i></a></li>
			    	<?php
			    		}
			    	?>
			    	<?php
			    		$pp_vimeo_username = get_option('pp_vimeo_username');
			    		
			    		if(!empty($pp_vimeo_username))
			    		{
			    	?>
			    	<li class="vimeo"><a <?php if(!empty($tg_footer_social_link)) { ?>target="_blank"<?php } ?> title="Vimeo" href="http://vimeo.com/<?php echo esc_attr($pp_vimeo_username); ?>"><i class="fa fa-vimeo-square"></i></a></li>
			    	<?php
			    		}
			    	?>
			    	<?php
			    		$pp_tumblr_username = get_option('pp_tumblr_username');
			    		
			    		if(!empty($pp_tumblr_username))
			    		{
			    	?>
			    	<li class="tumblr"><a <?php if(!empty($tg_footer_social_link)) { ?>target="_blank"<?php } ?> title="Tumblr" href="http://<?php echo esc_attr($pp_tumblr_username); ?>.tumblr.com"><i class="fa fa-tumblr"></i></a></li>
			    	<?php
			    		}
			    	?>
			    	<?php
			    		$pp_google_url = get_option('pp_google_url');
			    		
			    		if(!empty($pp_google_url))
			    		{
			    	?>
			    	<li class="google"><a <?php if(!empty($tg_footer_social_link)) { ?>target="_blank"<?php } ?> title="Google+" href="<?php echo esc_url($pp_google_url); ?>"><i class="fa fa-google-plus"></i></a></li>
			    	<?php
			    		}
			    	?>
			    	<?php
			    		$pp_dribbble_username = get_option('pp_dribbble_username');
			    		
			    		if(!empty($pp_dribbble_username))
			    		{
			    	?>
			    	<li class="dribbble"><a <?php if(!empty($tg_footer_social_link)) { ?>target="_blank"<?php } ?> title="Dribbble" href="http://dribbble.com/<?php echo esc_attr($pp_dribbble_username); ?>"><i class="fa fa-dribbble"></i></a></li>
			    	<?php
			    		}
			    	?>
			    	<?php
			    		$pp_linkedin_url = get_option('pp_linkedin_url');
			    		
			    		if(!empty($pp_linkedin_url))
			    		{
			    	?>
			    	<li class="linkedin"><a <?php if(!empty($tg_footer_social_link)) { ?>target="_blank"<?php } ?> title="Linkedin" href="<?php echo esc_url($pp_linkedin_url); ?>"><i class="fa fa-linkedin"></i></a></li>
			    	<?php
			    		}
			    	?>
			    	<?php
			            $pp_pinterest_username = get_option('pp_pinterest_username');
			            
			            if(!empty($pp_pinterest_username))
			            {
			        ?>
			        <li class="pinterest"><a <?php if(!empty($tg_footer_social_link)) { ?>target="_blank"<?php } ?> title="Pinterest" href="http://pinterest.com/<?php echo esc_attr($pp_pinterest_username); ?>"><i class="fa fa-pinterest"></i></a></li>
			        <?php
			            }
			        ?>
			        <?php
			        	$pp_instagram_username = get_option('pp_instagram_username');
			        	
			        	if(!empty($pp_instagram_username))
			        	{
			        ?>
			        <li class="instagram"><a <?php if(!empty($tg_footer_social_link)) { ?>target="_blank"<?php } ?> title="Instagram" href="http://instagram.com/<?php echo esc_attr($pp_instagram_username); ?>"><i class="fa fa-instagram"></i></a></li>
			        <?php
			        	}
			        ?>
			        <?php
			        	$pp_behance_username = get_option('pp_behance_username');
			        	
			        	if(!empty($pp_behance_username))
			        	{
			        ?>
			        <li class="behance"><a <?php if(!empty($tg_footer_social_link)) { ?>target="_blank"<?php } ?> title="Behance" href="http://behance.net/<?php echo esc_attr($pp_behance_username); ?>"><i class="fa fa-behance-square"></i></a></li>
			        <?php
			        	}
			        ?>
			        <?php
					    $pp_500px_url = get_option('pp_500px_url');
					    
					    if(!empty($pp_500px_url))
					    {
					?>
					<li class="500px"><a <?php if(!empty($tg_footer_social_link)) { ?>target="_blank"<?php } ?> title="500px" href="<?php echo esc_url($pp_500px_url); ?>"><i class="fa fa-500px"></i></a></li>
					<?php
					    }
					?>
			    </ul>
			</div>
		<?php
				}
			} //End if display social icons
			else
			{
				if ( has_nav_menu( 'footer-menu' ) ) 
			    {
				    wp_nav_menu( 
				        	array( 
				        		'menu_id'			=> 'footer_menu',
				        		'menu_class'		=> 'footer_nav',
				        		'theme_location' 	=> 'footer-menu',
				        	) 
				    ); 
				}
			}
		?>
	    <?php
	    	//Display copyright text
	        $tg_footer_copyright_text = kirki_get_option('tg_footer_copyright_text');

	        if(!empty($tg_footer_copyright_text))
	        {
	        	echo '<div id="copyright">'.wp_kses_post(htmlspecialchars_decode($tg_footer_copyright_text)).'</div><br class="clear"/>';
	        }
	    ?>
	    
	    <?php
	    	//Check if display to top button
	    	$tg_footer_copyright_totop = kirki_get_option('tg_footer_copyright_totop');
	    	
	    	if(!empty($tg_footer_copyright_totop))
	    	{
	    ?>
	    	<a id="toTop"><i class="fa fa-angle-up"></i></a>
	    <?php
	    	}
	    ?>
	</div>
</div>

<?php
	//Check if fullscreen menu layout
	$tg_menu_layout = grandportfolio_menu_layout();
	
	if($tg_menu_layout != 'hammenufull' && $tg_menu_layout != 'hammenuside')
	{
?>
</div>
<?php
	}
?>

<div id="overlay_background">
	<?php
		grandportfolio_get_page_gallery_id();
		
		//Check global sharing option
		$tg_global_sharing = kirki_get_option('tg_global_sharing');
		
		if(is_single() OR !empty($grandportfolio_page_gallery_id) OR !empty($tg_global_sharing))
		{
	?>
	<div id="fullscreen_share_wrapper">
		<div class="fullscreen_share_content">
	<?php
			get_template_part("/templates/template-share");
	?>
		</div>
	</div>
	<?php
		}
	?>
</div>

<?php
    //Check if theme demo then enable layout switcher
    if(THEMEDEMO)
    {
?>
    <div id="option_wrapper">
    <div class="inner">
    	<div style="text-align:center">
    	<strong>EXAMPLE USAGES</strong><br/><br/>
    	<p>
    	<?php echo esc_html(THEMENAME); ?> is so powerful theme allow you to easily create your own style of portfolio site. Here are example demo that can be imported with one click.</p>
    	<?php
    		$customizer_styling_arr = array( 
    			array(
					'id'	=>	'demo99', 
					'title' => 'Classic', 
					'url' => 'http://themes.themegoods2.com/grandportfolio/landing'
				),
				array(
					'id'	=>	'demo1', 
					'title' => 'Architect', 
					'url' => 'http://themes.themegoods2.com/grandportfolio/demo1'
				),
				array(
					'id'	=>	'demo2', 
					'title' => 'Blogger', 
					'url' => 'http://themes.themegoods2.com/grandportfolio/demo2'
				),
				array(
					'id'	=>	'demo3', 
					'title' => 'Creative & Design Agency', 
					'url' => 'http://themes.themegoods2.com/grandportfolio/demo3'
				),
				array(
					'id'	=>	'demo4', 
					'title' => 'Fashion Designer', 
					'url' => 'http://themes.themegoods2.com/grandportfolio/demo4'
				),
				array(
					'id'	=>	'demo5', 
					'title' => 'Music Band & Singer', 
					'url' => 'http://themes.themegoods2.com/grandportfolio/demo5'
				),
				array(
					'id'	=>	'demo6', 
					'title' => 'Photographer', 
					'url' => 'http://themes.themegoods2.com/grandportfolio/demo6'
				),
				array(
					'id'	=>	'demo7', 
					'title' => 'Magazine & Publisher', 
					'url' => 'http://themes.themegoods2.com/grandportfolio/demo7'
				),
				array(
					'id'	=>	'demo8', 
					'title' => 'Agency Company', 
					'url' => 'http://themes.themegoods2.com/grandportfolio/demo8'
				),
				array(
					'id'	=>	'demo9', 
					'title' => 'Creative Company', 
					'url' => 'http://themes.themegoods2.com/grandportfolio/demo9'
				),
			);
    	?>
    	<ul class="demo_list">
    		<?php
    			foreach($customizer_styling_arr as $customizer_styling)
    			{
    		?>
    		<li>
        		<img src="<?php echo get_template_directory_uri(); ?>/cache/demos/customizer/screenshots/<?php echo esc_html($customizer_styling['id']); ?>.png" alt=""/>
        		<div class="demo_thumb_hover_wrapper">
        		    <div class="demo_thumb_hover_inner">
        		    	<div class="demo_thumb_desc">
    	    	    		<h6><?php echo esc_html($customizer_styling['title']); ?></h6>
    	    	    		<a href="<?php echo esc_url($customizer_styling['url']); ?>" target="_blank" class="button white">Launch</a>
        		    	</div> 
        		    </div>	   
        		</div>		   
    		</li>
    		<?php
    			}
    		?>
    	</ul>
    	</div>
    </div>
    </div>
    <div id="option_btn">
    	<a href="javascript:;" class="demotip" title="Choose Theme Demo"><i class="fa fa-cog"></i></a>
    	<a href="http://themes.themegoods2.com/grandportfolio/test/wp-content/plugins/gt-custom/gt-custom.php?gtlo" class="demotip" title="Test Customizer of Theme" target="_blank"><i class="fa fa-edit"></i></a>
    	<a href="http://themes.themegoods2.com/grandportfolio/doc" class="demotip" title="Theme Documentation" target="_blank"><i class="fa fa-book"></i></a>
    	<a href="http://themeforest.net/item/grand-portfolio-responsive-portfolio/14496218?ref=ThemeGoods&amp;license=regular&amp;open_purchase_for_item_id=14496218&amp;purchasable=source&amp;ref=ThemeGoods" class="demotip" title="Purchase Theme" target="_blank"><i class="fa fa-shopping-basket"></i></a>
    </div>
<?php
    	wp_enqueue_script("cookie", get_template_directory_uri()."/js/jquery.cookie.js", false, THEMEVERSION, true);
    	wp_enqueue_script("grandportfolio-demo", get_template_directory_uri()."/js/script/script-demo.js", false, THEMEVERSION, true);
    }
?>

<?php
    $tg_frame = kirki_get_option('tg_frame');
    if(THEMEDEMO && isset($_GET['frame']) && !empty($_GET['frame']))
    {
	    $tg_frame = 1;
    }
    
    if(!empty($tg_frame))
    {
    	wp_enqueue_style("grandportfolio-frame", get_template_directory_uri()."/css/tg_frame.css", false, THEMEVERSION, "all");
?>
    <div class="frame_top"></div>
    <div class="frame_bottom"></div>
    <div class="frame_left"></div>
    <div class="frame_right"></div>
<?php
    }
    if(THEMEDEMO && isset($_GET['frame_color']) && !empty($_GET['frame_color']))
    {
?>
<style>
.frame_top, .frame_bottom, .frame_left, .frame_right { background: <?php echo esc_html($_GET['frame_color']); ?> !important; }
</style>
<?php
	}
?>

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>
