<!-- Begin mobile menu -->
<div class="mobile_menu_wrapper">
	<div class="fullmenu_wrapper">
		<div class="fullmenu_content">
		<a id="close_mobile_menu" href="javascript:;"><i class="fa fa-close"></i></a>
		<?php
			//get custom logo
		    $tg_retina_fullscreen_menu_logo = kirki_get_option('tg_retina_fullscreen_menu_logo');
	
		    if(!empty($tg_retina_fullscreen_menu_logo))
		    {	
		    	//Get image width and height
	        	$image_id = grandportfolio_get_image_id($tg_retina_fullscreen_menu_logo);
	        	$obj_image = wp_get_attachment_image_src($image_id, 'original');
	        	$image_width = 0;
	        	$image_height = 0;
	        	
	        	if(isset($obj_image[1]))
	        	{
	        		$image_width = intval($obj_image[1]/2);
	        	}
	        	if(isset($obj_image[2]))
	        	{
	        		$image_height = intval($obj_image[2]/2);
	        	}
		?>
		<div class="logo_container">
			<div class="logo_align">
	    	    <a id="custom_fullscreen_logo" class="logo_wrapper <?php if(!empty($page_menu_transparent)) { ?>hidden<?php } else { ?>default<?php } ?>" href="<?php echo esc_url(home_url('/')); ?>">
	    	    	<?php
	    				if($image_width > 0 && $image_height > 0)
	    				{
	    			?>
	    			<img src="<?php echo esc_url($tg_retina_fullscreen_menu_logo); ?>" alt="<?php esc_attr(get_bloginfo('name')); ?>" width="<?php echo esc_attr($image_width); ?>" height="<?php echo esc_attr($image_height); ?>"/>
	    			<?php
	    				}
	    				else
	    				{
	    			?>
	    	    	<img src="<?php echo esc_url($tg_retina_fullscreen_menu_logo); ?>" alt="<?php esc_attr(get_bloginfo('name')); ?>" width="48" height="58"/>
	    	    	<?php 
	        	    	}
	        	    ?>
	    	    </a>
			</div>
		</div>
		<?php
		    }
		?>
	
	    <?php
	    	$grandportfolio_homepage_style = grandportfolio_get_homepage_style();
	    
	    	//Get main menu layout
			$tg_menu_layout = grandportfolio_menu_layout();
	    
		    //Check if display search in header	
		    $tg_menu_search = kirki_get_option('tg_menu_search');
		    if($tg_menu_layout == 'leftmenu')
		    {
	    	    $tg_menu_search = 0;
		    }
		    
		    if(!empty($tg_menu_search))
		    {
		?>
		<form method="get" name="searchform" id="searchform" action="<?php echo esc_url(home_url('/')); ?>/">
		    <div>
		    	<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" autocomplete="off" placeholder="<?php esc_html_e('Search...', 'grandportfolio-translation' ); ?>"/>
		    	<button>
		        	<i class="fa fa-search"></i>
		        </button>
		    </div>
		    <div id="autocomplete"></div>
		</form>
		<?php
		    }
		?>
		
		<?php 
			//Working on page transparent logic
		
	    	//Get page ID
	    	if(is_object($post))
	    	{
	    	    $page = get_page($post->ID);
	    	}
	    	$current_page_id = '';
	    	
	    	if(isset($page->ID))
	    	{
	    	    $current_page_id = $page->ID;
	    	}
	    	elseif(is_home())
	    	{
	    	    $current_page_id = get_option('page_on_front');
	    	}
	    	
	        //If enable menu transparent
	        //Get Page Menu Transparent Option
			$page_on_front = get_option('page_on_front');
			if(is_home() && $page_on_front == 0)
			{
				$page_menu_transparent = 0;
			}
			else
			{
				$page_menu_transparent = get_post_meta($current_page_id, 'page_menu_transparent', true);
			}
	        
	        $pp_page_bg = '';
		    //Get page featured image
		    if(has_post_thumbnail($current_page_id, 'full'))
		    {
		        $image_id = get_post_thumbnail_id($current_page_id); 
		        $image_thumb = wp_get_attachment_image_src($image_id, 'full', true);
		        $pp_page_bg = $image_thumb[0];
		    }
	
	    	//Check if Woocommerce is installed	
	    	if(class_exists('Woocommerce') && grandportfolio_is_woocommerce_page())
	    	{
	    	    //Check if woocommerce page
	    		$shop_page_id = get_option( 'woocommerce_shop_page_id' );
	    		$page_menu_transparent = get_post_meta($shop_page_id, 'page_menu_transparent', true);
	    	}
	    	
	    	if(is_single() && !empty($pp_page_bg) && !grandportfolio_is_woocommerce_page())
			{
			    $post_type = get_post_type();
			    
			    switch($post_type)
			    {
			    	case 'events':
			    	default:
			    		$page_menu_transparent = 1;	
			    	break;
			    	
			    	case 'post':
					    $page_menu_transparent = get_post_meta($current_page_id, 'post_menu_transparent', true);
					break;
					
			    	case 'galleries':
			    		$page_menu_transparent = 0;	
			    	break; 
			    	
			    	case 'portfolios':
			    		$page_menu_transparent = get_post_meta($current_page_id, 'portfolio_menu_transparent', true);
			    	break;
			    }
			}
			else if(is_single() && empty($pp_page_bg) && !grandportfolio_is_woocommerce_page())
			{
				$page_menu_transparent = 0;	
			}
	    	
	    	if($grandportfolio_homepage_style == 'fullscreen')
	        {
	            $page_menu_transparent = 1;
	        }
	        
	        if(is_search())
	        {
	    	    $page_menu_transparent = 0;
	        }
	        
	        if(is_404())
	        {
	    	    $page_menu_transparent = 0;
	        }
	    ?>
		
		<div class="fullscreen_mainmenu">
	    <?php 
	    	//Check if has custom menu
	    	if(is_object($post) && $post->post_type == 'page')
	    	{
	    	    $page_menu = get_post_meta($post->ID, 'page_menu', true);
	    	}	
	    	
	    	if ( has_nav_menu( 'side-menu' ) ) 
	    	{
	    	    //Get page nav
	    	    wp_nav_menu( 
	    	        array( 
	    	            'menu_id'			=> 'mobile_main_menu',
	                    'menu_class'		=> 'mobile_main_nav',
	    	            'theme_location' 	=> 'side-menu',
	    	        )
	    	    ); 
	    	}
	    ?>
		</div>
		
		<?php
			//Check if display recent portfolios
			$tg_portfolio_fullscreen_menu_recent = kirki_get_option('tg_portfolio_fullscreen_menu_recent');
			
			if(!empty($tg_portfolio_fullscreen_menu_recent))
			{
		?>
		<div class="fullscreen_portfolios">
			<h2 class="widgettitle"><?php esc_html_e('Recent Projects', 'grandportfolio-translation' ); ?></h2>
			
			<?php
				//Get portfolio items
				$args = array(
				    'numberposts' => 10,
				    'order' => 'DESC',
				    'orderby' => 'post_date',
				    'post_type' => array('portfolios'),
				    'suppress_filters' => false,
				);
				
				$portfolios_arr = get_posts($args);
				
				if(!empty($portfolios_arr) && is_array($portfolios_arr))
				{
					foreach($portfolios_arr as $key => $portfolio)
					{
						$last_class = '';
						
						if(($key+1)%2 == 0)
						{
							$last_class = 'last';
						}
						
						echo '<div class="one_half '.$last_class.'">';
					
						$portfolio_ID = $portfolio->ID;
						$portfolio_link_url = get_post_meta($portfolio_ID, 'portfolio_link_url', true);
			
						if(empty($portfolio_link_url))
						{
						    $permalink_url = get_permalink($portfolio_ID);
						}
						else
						{
						    $permalink_url = $portfolio_link_url;
						}

						$portfolio_type = get_post_meta($portfolio_ID, 'portfolio_type', true);
					    $portfolio_video_id = get_post_meta($portfolio_ID, 'portfolio_video_id', true);
					    
					    switch($portfolio_type)
					    {
						    case 'External Link':
								$portfolio_link_url = get_post_meta($portfolio_ID, 'portfolio_link_url', true);
						
								echo '<a target="_blank" href="'.esc_url($portfolio_link_url).'">'.$portfolio->post_title.'</a>';
						        
						    break;
						    //end external link
						    
						    case 'Project Content':
			        	    default:
			
					        	echo '<a href="'.get_permalink($portfolio_ID).'">'.$portfolio->post_title.'</a>';
				        
						    break;
						    //end external link
						}
						
						echo '</div>';
					}
				}
			?>
		</div>
		<?php
			}
		?>
		
		<hr class="seperator"/>
		
		<?php
	    	//Display copyright text
	        $tg_footer_copyright_text = kirki_get_option('tg_footer_copyright_text');

	        if(!empty($tg_footer_copyright_text))
	        {
	        	echo '<div id="copyright_menu">'.wp_kses_post(htmlspecialchars_decode($tg_footer_copyright_text)).'</div>';
	        }
	    ?>
	    
	    <?php
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
			    		$pp_youtube_username = get_option('pp_youtube_username');
			    		
			    		if(!empty($pp_youtube_username))
			    		{
			    	?>
			    	<li class="youtube"><a <?php if(!empty($tg_footer_social_link)) { ?>target="_blank"<?php } ?> title="Youtube" href="http://youtube.com/channel/<?php echo esc_attr($pp_youtube_username); ?>"><i class="fa fa-youtube"></i></a></li>
			    	<?php
			    		}
			    	?>
			    	<?php
			    		$pp_vimeo_username = get_option('pp_vimeo_username');
			    		
			    		if(!empty($pp_vimeo_username))
			    		{
			    	?>
			    	<li class="vimeo"><a <?php if(!empty($tg_footer_social_link)) { ?>target="_blank"<?php } ?> title="Vimeo" href="http://vimeo.com/<?php echo esc_attr($pp_vimeo_username); ?>"><i class="fa fa-vimeo-square"></i></i></a></li>
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
			    		$pp_linkedin_username = get_option('pp_linkedin_username');
			    		
			    		if(!empty($pp_linkedin_username))
			    		{
			    	?>
			    	<li class="linkedin"><a <?php if(!empty($tg_footer_social_link)) { ?>target="_blank"<?php } ?> title="Linkedin" href="<?php echo esc_url($pp_linkedin_username); ?>"><i class="fa fa-linkedin"></i></a></li>
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
					<li class="behance"><a <?php if(!empty($pp_topbar_social_link_blank)) { ?>target="_blank"<?php } ?> title="Behance" href="http://behance.net/<?php echo esc_attr($pp_behance_username); ?>"><i class="fa fa-behance-square"></i></a></li>
					<?php
					    }
					?>
					<?php
			    		$pp_500px_url = get_option('pp_500px_url');
			    		
			    		if(!empty($pp_google_url))
			    		{
			    	?>
			    	<li class="500px"><a <?php if(!empty($tg_footer_social_link)) { ?>target="_blank"<?php } ?> title="500px" href="<?php echo esc_url($pp_500px_url); ?>"><i class="fa fa-500px"></i></a></li>
			    	<?php
			    		}
			    	?>
			    </ul>

			</div>
	    </div>
	</div>
</div>
<?php
	$grandportfolio_page_menu_transparent = grandportfolio_get_page_menu_transparent();
	grandportfolio_set_page_menu_transparent($page_menu_transparent);
?>
<!-- End mobile menu -->