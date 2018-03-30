<div class="gbtr_tools_wrapper">
    <div class="container_12">
        <div class="grid_6">
			<div class="top_bar_left">
				<?php
				
				if ( (isset($theretailer_theme_options['social_media_in_header'])) && ($theretailer_theme_options['social_media_in_header'] == 1) ) {
				
					if ( (isset($theretailer_theme_options['social_media_facebook'])) && (trim($theretailer_theme_options['social_media_facebook']) != "" ) ) echo('<a href="' . $theretailer_theme_options['social_media_facebook'] . '" target="_blank" class="social_media social_media_facebook"><i class="fa fa-facebook"></i></a>' );
					if ( (isset($theretailer_theme_options['social_media_pinterest'])) && (trim($theretailer_theme_options['social_media_pinterest']) != "" ) ) echo('<a href="' . $theretailer_theme_options['social_media_pinterest'] . '" target="_blank" class="social_media social_media_pinterest"><i class="fa fa-pinterest"></i></a>' );
					if ( (isset($theretailer_theme_options['social_media_linkedin'])) && (trim($theretailer_theme_options['social_media_linkedin']) != "" ) ) echo('<a href="' . $theretailer_theme_options['social_media_linkedin'] . '" target="_blank" class="social_media social_media_linkedin"><i class="fa fa-linkedin"></i></a>' );
					if ( (isset($theretailer_theme_options['social_media_twitter'])) && (trim($theretailer_theme_options['social_media_twitter']) != "" ) ) echo('<a href="' . $theretailer_theme_options['social_media_twitter'] . '" target="_blank" class="social_media social_media_twitter"><i class="fa fa-twitter"></i></a>' );
					if ( (isset($theretailer_theme_options['social_media_googleplus'])) && (trim($theretailer_theme_options['social_media_googleplus']) != "" ) ) echo('<a href="' . $theretailer_theme_options['social_media_googleplus'] . '" target="_blank" class="social_media social_media_googleplus"><i class="fa fa-google-plus"></i></a>' );
					if ( (isset($theretailer_theme_options['social_media_rss'])) && (trim($theretailer_theme_options['social_media_rss']) != "" ) ) echo('<a href="' . $theretailer_theme_options['social_media_rss'] . '" target="_blank" class="social_media social_media_rss"><i class="fa fa-rss"></i></a>' );
					if ( (isset($theretailer_theme_options['social_media_tumblr'])) && (trim($theretailer_theme_options['social_media_tumblr']) != "" ) ) echo('<a href="' . $theretailer_theme_options['social_media_tumblr'] . '" target="_blank" class="social_media social_media_tumblr"><i class="fa fa-tumblr"></i></a>' );
					if ( (isset($theretailer_theme_options['social_media_instagram'])) && (trim($theretailer_theme_options['social_media_instagram']) != "" ) ) echo('<a href="' . $theretailer_theme_options['social_media_instagram'] . '" target="_blank" class="social_media social_media_instagram"><i class="fa fa-instagram"></i></a>' );
					if ( (isset($theretailer_theme_options['social_media_youtube'])) && (trim($theretailer_theme_options['social_media_youtube']) != "" ) ) echo('<a href="' . $theretailer_theme_options['social_media_youtube'] . '" target="_blank" class="social_media social_media_youtube"><i class="fa fa-youtube-play"></i></a>' );
					if ( (isset($theretailer_theme_options['social_media_vimeo'])) && (trim($theretailer_theme_options['social_media_vimeo']) != "" ) ) echo('<a href="' . $theretailer_theme_options['social_media_vimeo'] . '" target="_blank" class="social_media social_media_vimeo"><i class="fa fa-vimeo-square"></i></a>' );
					if ( (isset($theretailer_theme_options['social_media_behance'])) && (trim($theretailer_theme_options['social_media_behance']) != "" ) ) echo('<a href="' . $theretailer_theme_options['social_media_behance'] . '" target="_blank" class="social_media social_media_behance"><i class="fa fa-behance"></i></a>' );
					if ( (isset($theretailer_theme_options['social_media_dribble'])) && (trim($theretailer_theme_options['social_media_dribble']) != "" ) ) echo('<a href="' . $theretailer_theme_options['social_media_dribble'] . '" target="_blank" class="social_media social_media_dribble"><i class="fa fa-dribbble"></i></a>' );
					if ( (isset($theretailer_theme_options['social_media_flickr'])) && (trim($theretailer_theme_options['social_media_flickr']) != "" ) ) echo('<a href="' . $theretailer_theme_options['social_media_flickr'] . '" target="_blank" class="social_media social_media_flickr"><i class="fa fa-flickr"></i></a>' );
					if ( (isset($theretailer_theme_options['social_media_git'])) && (trim($theretailer_theme_options['social_media_git']) != "" ) ) echo('<a href="' . $theretailer_theme_options['social_media_git'] . '" target="_blank" class="social_media social_media_git"><i class="fa fa-git"></i></a>' );
					if ( (isset($theretailer_theme_options['social_media_skype'])) && (trim($theretailer_theme_options['social_media_skype']) != "" ) ) echo('<a href="' . $theretailer_theme_options['social_media_skype'] . '" target="_blank" class="social_media social_media_skype"><i class="fa fa-skype"></i></a>' );
					if ( (isset($theretailer_theme_options['social_media_weibo'])) && (trim($theretailer_theme_options['social_media_weibo']) != "" ) ) echo('<a href="' . $theretailer_theme_options['social_media_weibo'] . '" target="_blank" class="social_media social_media_weibo"><i class="fa fa-weibo"></i></a>' );
					if ( (isset($theretailer_theme_options['social_media_foursquare'])) && (trim($theretailer_theme_options['social_media_foursquare']) != "" ) ) echo('<a href="' . $theretailer_theme_options['social_media_foursquare'] . '" target="_blank" class="social_media social_media_foursquare"><i class="fa fa-foursquare"></i></a>' );
					if ( (isset($theretailer_theme_options['social_media_soundcloud'])) && (trim($theretailer_theme_options['social_media_soundcloud']) != "" ) ) echo('<a href="' . $theretailer_theme_options['social_media_soundcloud'] . '" target="_blank" class="social_media social_media_soundcloud"><i class="fa fa-soundcloud"></i></a>' );
					if ( (isset($theretailer_theme_options['social_media_vk'])) && (trim($theretailer_theme_options['social_media_vk']) != "" ) ) echo('<a href="' . $theretailer_theme_options['social_media_vk'] . '" target="_blank" class="social_media social_media_vk"><i class="fa fa-vk"></i></a>' );
					if ( (isset($theretailer_theme_options['social_media_snapchat'])) && (trim($theretailer_theme_options['social_media_snapchat']) != "" ) ) echo('<a href="' . $theretailer_theme_options['social_media_snapchat'] . '" target="_blank" class="social_media social_media_snapchat"><i class="fa fa-snapchat" aria-hidden="true"></i></a>' );
					if ( (isset($theretailer_theme_options['social_media_houzz'])) && (trim($theretailer_theme_options['social_media_houzz']) != "" ) ) echo('<a href="' . $theretailer_theme_options['social_media_houzz'] . '" target="_blank" class="social_media social_media_houzz"><i class="fa fa-houzz"></i></a>' );
				
				}
				
				?>
				
				<span class="gbtr_tools_info">
					<?php if ( (isset($theretailer_theme_options['topbar_text'])) && (trim($theretailer_theme_options['topbar_text']) != "" ) ) { ?>
						<?php _e( $theretailer_theme_options['topbar_text'], 'theretailer' ); ?>
					<?php } ?>
				</span>
		
			</div><!--.top_bar_left-->
        </div>
        <div class="grid_6">
            <div class="gbtr_tools_search <?php if ( ($theretailer_theme_options['search_input_style']) && ($theretailer_theme_options['search_input_style'] == 1) ) { ?>open_always<?php } ?>">
				<button class="gbtr_tools_search_trigger"><i class="fa fa-search"></i></button>
				<button class="gbtr_tools_search_trigger_mobile"><i class="fa fa-search"></i></button>
                <form method="get" action="<?php echo home_url(); ?>">
                    <input class="gbtr_tools_search_inputtext" type="text" value="<?php echo esc_html($s, 1); ?>" name="s" id="s" />
                    <button type="submit" class="gbtr_tools_search_inputbutton"><i class="fa fa-search"></i></button>
                    <?php 
                    /**
                    * Check if WooCommerce is active
                    **/
                    if (class_exists('WooCommerce')) {
                    ?>
                    <input type="hidden" name="post_type" value="product">
                    <?php } ?>
                </form>
            </div>
            
		<?php if ( is_user_logged_in() ) { ?>
			<div class="logout-wrapper">
				<a href="<?php echo get_site_url(); ?>/?<?php echo get_option('woocommerce_logout_endpoint'); ?>=true" class="logout_link"><i class="fa fa-power-off"></i></a>
			</div>
		<?php } ?>
			
		<?php $menu_to_count = wp_nav_menu(array(
										'echo' => false,
										'theme_location' => 'tools'
									));
		$top_bar_menu_items = substr_count($menu_to_count,'class="menu-item '); 
			
		if ( $top_bar_menu_items > 2 ) :
		?>
		<div class="gbtr_tools_account_wrapper">
			<div class="top-bar-menu-trigger-mobile">
				<i class="fa fa-bars"></i>
			</div>
			
			<div class="top-bar-menu-trigger">
				<i class="fa fa-bars"></i>
			</div>
			
		<?php endif; ?>
				
			<div class="gbtr_tools_account desktop <?php echo $top_bar_menu_items > 2 ? 'menu-hidden' : '';?>">
				<ul class="topbar-menu">
					<?php if ( has_nav_menu( 'tools' ) ) : ?>
					<?php  
					wp_nav_menu(array(
						'theme_location' => 'tools',
						'container' =>false,
						'menu_class' => '',
						'echo' => true,
						'items_wrap'      => '%3$s',
						'before' => '',
						'after' => '',
						'link_before' => '',
						'link_after' => '',
						'depth' => 0,
						'fallback_cb' => false,
					));
					?>
					
					<?php else: ?>
						<li>Define your top bar navigation.</li>
					<?php endif; ?>
				</ul>
			</div><!--.gbtr_tools_account-->
			<?php	if ( $top_bar_menu_items > 2 ) :?>
				</div>
			<?php endif; ?>
        </div><!--.grid-8-->
    </div><!--.container-12-->
	
	<?php if ( $top_bar_menu_items > 2 ) : ?>
	
		<div class="gbtr_tools_account mobile <?php echo $top_bar_menu_items > 2 ? 'menu-hidden' : '';?>">
			<ul class="topbar-menu">
				<?php if ( has_nav_menu( 'tools' ) ) : ?>
				<?php  
				wp_nav_menu(array(
					'theme_location' => 'tools',
					'container' =>false,
					'menu_class' => '',
					'echo' => true,
					'items_wrap'      => '%3$s',
					'before' => '',
					'after' => '',
					'link_before' => '',
					'link_after' => '',
					'depth' => 0,
					'fallback_cb' => false,
				));
				?>
				
				<?php else: ?>
					<li>Define your top bar navigation.</li>
				<?php endif; ?>
			</ul>
		</div><!--.gbtr_tools_account-->
	
	<?php endif; ?>
	
</div>