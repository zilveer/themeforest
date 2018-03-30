					<?php global $page_id, $woocommerce, $shopkeeper_theme_options; ?>
                    
                    <?php

                    $page_footer_option = "on";
					
					if (get_post_meta( $page_id, 'footer_meta_box_check', true )) {
						$page_footer_option = get_post_meta( $page_id, 'footer_meta_box_check', true );
					}

					if (class_exists('WooCommerce')) {
						if (is_shop() && get_post_meta( get_option( 'woocommerce_shop_page_id' ), 'footer_meta_box_check', true )) {
							$page_footer_option = get_post_meta( get_option( 'woocommerce_shop_page_id' ), 'footer_meta_box_check', true );
						}
					}
					
					?>
					
					<?php if ( $page_footer_option == "on" ) : ?>
                    
                    <footer id="site-footer" role="contentinfo">
                        
                    	 <?php if ( is_active_sidebar( 'footer-widget-area' ) ) : ?>
						 
							<div class="trigger-footer-widget-area">
								<span class="trigger-footer-widget-icon"></span>
							</div>
						
							<div class="site-footer-widget-area">
								<div class="row">
									<?php dynamic_sidebar( 'footer-widget-area' ); ?>
								</div><!-- .row -->
							</div><!-- .site-footer-widget-area -->
                        
						<?php endif; ?>
                        
                        <div class="site-footer-copyright-area">
                            <div class="row">
								<div class="large-12 columns">
				
									<?php if ( (isset($shopkeeper_theme_options['footer_social_icons'])) && (trim($shopkeeper_theme_options['footer_social_icons']) == "1" ) ) : ?>
                                    
                                    <ul class="footer_socials_wrapper">
                                        
                                        <?php
                        
										$facebook = "";
										$pinterest = "";
										$linkedin = "";
										$twitter = "";
										$googleplus = "";
										$rss = "";
										$tumblr = "";
										$instagram = "";
										$youtube = "";
										$vimeo = "";
										$behance = "";
										$dribble = "";
										$flickr = "";
										$git = "";
										$skype = "";
										$weibo = "";
										$foursquare = "";
										$soundcloud = "";
										$vk = "";
										
										if ( isset ($shopkeeper_theme_options['facebook_link']) ) $facebook = $shopkeeper_theme_options['facebook_link'];
										if ( isset ($shopkeeper_theme_options['pinterest_link']) ) $pinterest = $shopkeeper_theme_options['pinterest_link'];
										if ( isset ($shopkeeper_theme_options['linkedin_link']) ) $linkedin = $shopkeeper_theme_options['linkedin_link'];
										if ( isset ($shopkeeper_theme_options['twitter_link']) ) $twitter = $shopkeeper_theme_options['twitter_link'];
										if ( isset ($shopkeeper_theme_options['googleplus_link']) ) $googleplus = $shopkeeper_theme_options['googleplus_link'];
										if ( isset ($shopkeeper_theme_options['rss_link']) ) $rss = $shopkeeper_theme_options['rss_link'];
										if ( isset ($shopkeeper_theme_options['tumblr_link']) ) $tumblr = $shopkeeper_theme_options['tumblr_link'];
										if ( isset ($shopkeeper_theme_options['instagram_link']) ) $instagram = $shopkeeper_theme_options['instagram_link'];
										if ( isset ($shopkeeper_theme_options['youtube_link']) ) $youtube = $shopkeeper_theme_options['youtube_link'];
										if ( isset ($shopkeeper_theme_options['vimeo_link']) ) $vimeo = $shopkeeper_theme_options['vimeo_link'];
										if ( isset ($shopkeeper_theme_options['behance_link']) ) $behance = $shopkeeper_theme_options['behance_link'];
										if ( isset ($shopkeeper_theme_options['dribble_link']) ) $dribble = $shopkeeper_theme_options['dribble_link'];
										if ( isset ($shopkeeper_theme_options['flickr_link']) ) $flickr = $shopkeeper_theme_options['flickr_link'];
										if ( isset ($shopkeeper_theme_options['git_link']) ) $git = $shopkeeper_theme_options['git_link'];
										if ( isset ($shopkeeper_theme_options['skype_link']) ) $skype = $shopkeeper_theme_options['skype_link'];
										if ( isset ($shopkeeper_theme_options['weibo_link']) ) $weibo = $shopkeeper_theme_options['weibo_link'];
										if ( isset ($shopkeeper_theme_options['foursquare_link']) ) $foursquare = $shopkeeper_theme_options['foursquare_link'];
										if ( isset ($shopkeeper_theme_options['soundcloud_link']) ) $soundcloud = $shopkeeper_theme_options['soundcloud_link'];
										if ( isset ($shopkeeper_theme_options['vk_link']) ) $vk = $shopkeeper_theme_options['vk_link'];
										
										if ( $facebook != "" ) echo('<li><a href="' . $facebook . '" target="_blank" class="social_media"><i class="fa fa-facebook"></i></a></li>' );
										if ( $pinterest != "" ) echo('<li><a href="' . $pinterest . '" target="_blank" class="social_media"><i class="fa fa-pinterest"></i></a></li>' );
										if ( $linkedin != "" ) echo('<li><a href="' . $linkedin . '" target="_blank" class="social_media"><i class="fa fa-linkedin"></i></a></li>' );
										if ( $twitter != "" ) echo('<li><a href="' . $twitter . '" target="_blank" class="social_media"><i class="fa fa-twitter"></i></a></li>' );
										if ( $googleplus != "" ) echo('<li><a href="' . $googleplus . '" target="_blank" class="social_media"><i class="fa fa-google-plus"></i></a></li>' );
										if ( $rss != "" ) echo('<li><a href="' . $rss . '" target="_blank" class="social_media"><i class="fa fa-rss"></i></a></li>' );
										if ( $tumblr != "" ) echo('<li><a href="' . $tumblr . '" target="_blank" class="social_media"><i class="fa fa-tumblr"></i></a></li>' );
										if ( $instagram != "" ) echo('<li><a href="' . $instagram . '" target="_blank" class="social_media"><i class="fa fa-instagram"></i></a></li>' );
										if ( $youtube != "" ) echo('<li><a href="' . $youtube . '" target="_blank" class="social_media"><i class="fa fa-youtube"></i></a></li>' );
										if ( $vimeo != "" ) echo('<li><a href="' . $vimeo . '" target="_blank" class="social_media"><i class="fa fa-vimeo-square"></i></a></li>' );
										if ( $behance != "" ) echo('<li><a href="' . $behance . '" target="_blank" class="social_media"><i class="fa fa-behance"></i></a></li>' );
										if ( $dribble != "" ) echo('<li><a href="' . $dribble . '" target="_blank" class="social_media"><i class="fa fa-dribbble"></i></a></li>' );
										if ( $flickr != "" ) echo('<li><a href="' . $flickr . '" target="_blank" class="social_media"><i class="fa fa-flickr"></i></a></li>' );
										if ( $git != "" ) echo('<li><a href="' . $git . '" target="_blank" class="social_media"><i class="fa fa-git"></i></a></li>' );
										if ( $skype != "" ) echo('<li><a href="' . $skype . '" target="_blank" class="social_media"><i class="fa fa-skype"></i></a></li>' );
										if ( $weibo != "" ) echo('<li><a href="' . $weibo . '" target="_blank" class="social_media"><i class="fa fa-weibo"></i></a></li>' );
										if ( $foursquare != "" ) echo('<li><a href="' . $foursquare . '" target="_blank" class="social_media"><i class="fa fa-foursquare"></i></a></li>' );
										if ( $soundcloud != "" ) echo('<li><a href="' . $soundcloud . '" target="_blank" class="social_media"><i class="fa fa-soundcloud"></i></a></li>' );
										if ( $vk != "" ) echo('<li><a href="' . $vk . '" target="_blank" class="social_media"><i class="fa fa-vk"></i></a></li>' );
										
										?>
                                        
									</ul>
                                    
                                    <?php endif; ?>
                                
									<nav class="footer-navigation-wrapper" role="navigation">                    
										<?php 
											wp_nav_menu(array(
												'theme_location'  => 'footer-navigation',
												'fallback_cb'     => false,
												'container'       => false,
												'depth' 		  => 1,
												'items_wrap'      => '<ul class="%1$s">%3$s</ul>',
											));
										?>           
									</nav><!-- #site-navigation -->   
								
                                    <div class="copyright_text">
                                        <?php if ( (isset($shopkeeper_theme_options['footer_copyright_text'])) && (trim($shopkeeper_theme_options['footer_copyright_text']) != "" ) ) { ?>
                                            <?php _e( $shopkeeper_theme_options['footer_copyright_text'], 'shopkeeper' ); ?>
                                        <?php } ?>
                                    </div><!-- .copyright_text -->  
                            
								</div><!--.large-12-->
							</div><!-- .row --> 
                        </div><!-- .site-footer-copyright-area -->
                               
                    </footer>
                    
                    <?php endif; ?>
                    
                </div><!-- #page_wrapper -->
                        
            </div><!-- /st-content -->
        </div><!-- /st-pusher -->        
        
        <?php if (class_exists('WooCommerce') && (is_shop() || is_product_category())) : ?>
        <nav class="st-menu slide-from-left <?php echo ( is_active_sidebar( 'catalog-widget-area' ) && ( isset($shopkeeper_theme_options['sidebar_style']) && ( $shopkeeper_theme_options['sidebar_style'] == "1" ) ) ) ? 'hide-for-large-up':''; ?> <?php echo ( is_active_sidebar( 'catalog-widget-area' ) ) ? 'shop-has-sidebar':''; ?>">
            <div class="nano">
                <div class="content">
					
                    <div class="offcanvas_content_left wpb_widgetised_column">
                    
                        <div id="filters-offcanvas">
                            <?php if ( is_active_sidebar( 'catalog-widget-area' ) ) : ?>
                                <?php dynamic_sidebar( 'catalog-widget-area' ); ?>
                            <?php endif; ?>
                        </div>
                    
                    </div>
                    
                </div>
            </div>
        </nav>
    	<?php endif; ?>
        
        <nav class="st-menu slide-from-right">
            <div class="nano">
                <div class="content">
                
                    <div class="offcanvas_content_right">                	
                        
                        <div id="mobiles-menu-offcanvas">
                                
                                <?php if ( (isset($shopkeeper_theme_options['main_header_search_bar'])) && ($shopkeeper_theme_options['main_header_search_bar'] == "1") ) : ?>

                                <div class="mobile-search hide-for-large-up">
									
										<?php
										if (class_exists('WooCommerce')) {
											the_widget( 'WC_Widget_Product_Search', 'title=' );
										} else {
											the_widget( 'WP_Widget_Search', 'title=' );
										}
										?>
										
										<div class="mobile_search_submit">
											<i class="fa fa-search"></i>
										</div>
								
                                </div>

                                <?php endif; ?>
                                
	                            <?php if ( (isset($shopkeeper_theme_options['main_header_layout'])) && ( $shopkeeper_theme_options['main_header_layout'] != "2" ) ) : ?>

	                                <nav class="mobile-navigation primary-navigation hide-for-large-up" role="navigation">
	                                <?php 
	                                    wp_nav_menu(array(
	                                        'theme_location'  => 'main-navigation',
	                                        'fallback_cb'     => false,
	                                        'container'       => false,
	                                        'items_wrap'      => '<ul id="%1$s">%3$s</ul>',
	                                    ));
	                                ?>
	                                </nav>
	                                
	                            <?php endif; ?>
	                            
	                            <?php if ( (isset($shopkeeper_theme_options['main_header_layout'])) && ( $shopkeeper_theme_options['main_header_layout'] == "2" ) ) : ?>
	                                
	                                <nav class="mobile-navigation hide-for-large-up" role="navigation">
	                                <?php 
	                                    wp_nav_menu(array(
	                                        'theme_location'  => 'centered_header_left_navigation',
	                                        'fallback_cb'     => false,
	                                        'container'       => false,
	                                        'items_wrap'      => '<ul id="%1$s">%3$s</ul>',
	                                    ));
	                                ?>
	                                </nav>
	                                
	                                <nav class="mobile-navigation hide-for-large-up" role="navigation">
	                                <?php 
	                                    wp_nav_menu(array(
	                                        'theme_location'  => 'centered_header_right_navigation',
	                                        'fallback_cb'     => false,
	                                        'container'       => false,
	                                        'items_wrap'      => '<ul id="%1$s">%3$s</ul>',
	                                    ));
	                                ?>
	                                </nav>
	                                
	                            <?php endif; ?>
								
								<?php if ( (isset($shopkeeper_theme_options['main_header_off_canvas'])) && (trim($shopkeeper_theme_options['main_header_off_canvas']) == "1" ) ) : ?>
	                                <nav class="mobile-navigation" role="navigation">
	                                <?php 
	                                    wp_nav_menu(array(
	                                        'theme_location'  => 'secondary_navigation',
	                                        'fallback_cb'     => false,
	                                        'container'       => false,
	                                        'items_wrap'      => '<ul id="%1$s">%3$s</ul>',
	                                    ));
	                                ?>
	                                </nav>
	                            <?php endif; ?>
	                            
	                            <?php						
								$theme_locations  = get_nav_menu_locations();
								if (isset($theme_locations['top-bar-navigation'])) {
									$menu_obj = get_term($theme_locations['top-bar-navigation'], 'nav_menu');
								}
								
								if ( (isset($menu_obj->count) && ($menu_obj->count > 0)) || (is_user_logged_in()) ) {
								?>
								
									<?php if ( (isset($shopkeeper_theme_options['top_bar_switch'])) && ($shopkeeper_theme_options['top_bar_switch'] == "1" ) ) : ?>
	                                    <nav class="mobile-navigation hide-for-large-up" role="navigation">								
	                                    <?php 
	                                        wp_nav_menu(array(
	                                            'theme_location'  => 'top-bar-navigation',
	                                            'fallback_cb'     => false,
	                                            'container'       => false,
	                                            'items_wrap'      => '<ul id="%1$s">%3$s</ul>',
	                                        ));
	                                    ?>
	                                    
	                                    <?php if ( is_user_logged_in() ) { ?>
	                                        <ul><li><a href="<?php echo get_site_url(); ?>/?<?php echo get_option('woocommerce_logout_endpoint'); ?>=true" class="logout_link"><?php _e('Logout', 'shopkeeper'); ?></a></li></ul>
	                                    <?php } ?>
	                                    </nav>
	                                <?php endif; ?>
								
								<?php } ?>
								
								<div class="language-and-currency-offcanvas hide-for-large-up">
								
									<?php if (function_exists('icl_get_languages')) { ?>
	                
	                                    <?php $additional_languages = icl_get_languages('skip_missing=N&orderby=KEY&order=DIR&link_empty_to=str'); ?>
	                                    
	                                    <select class="topbar-language-switcher">
	                                        <option><?php echo ICL_LANGUAGE_NAME; ?></option>
	                                        <?php
	                                                
	                                        if (count($additional_languages) > 1) {
	                                            foreach($additional_languages as $additional_language){
	                                              if(!$additional_language['active']) $langs[] = '<option value="'.$additional_language['url'].'">'.$additional_language['native_name'].'</option>';
	                                            }
	                                            echo join(', ', $langs);
	                                        }
	                                        
	                                        ?>
	                                    </select>
	                                
	                                <?php } ?>
	                                
	                                <?php if (class_exists('woocommerce_wpml')) { ?>
	                                    <?php echo(do_shortcode('[currency_switcher]')); ?>
	                                <?php } ?>
	                            
	                            </div>
                            
                        </div>

                        <?php if ( is_active_sidebar( 'offcanvas-widget-area' ) ) : ?>
                        	<div class="shop_sidebar wpb_widgetised_column">
                            	<?php dynamic_sidebar( 'offcanvas-widget-area' ); ?>
                            </div>
                        <?php endif; ?>
                                            
                    </div>
                
                </div>
            </div>
        </nav>
	
    </div><!-- /st-container -->

	<!-- ******************************************************************** -->
    <!-- * Site Search ****************************************************** -->
    <!-- ******************************************************************** -->

	<div class="site-search">
		<div class="site-search-inner">
		<?php
		if (class_exists('WooCommerce')) {
			the_widget( 'WC_Widget_Product_Search', 'title=' );
		} else {
			the_widget( 'WP_Widget_Search', 'title=' );
		}
		?>
		</div>
	</div><!-- .site-search -->

	<!-- ******************************************************************** -->
    <!-- * Back To Top Button *********************************************** -->
    <!-- ******************************************************************** -->
	<a href="#0" class="cd-top"></a>


	<!-- ******************************************************************** -->
    <!-- * Product Quick View *********************************************** -->
    <!-- ******************************************************************** -->
    <div id="quick_view_container">
		<div id="placeholder_product_quick_view" class="woocommerce"></div>
	</div>

    <!-- ******************************************************************** -->
    <!-- * Custom Footer JavaScript Code ************************************ -->
    <!-- ******************************************************************** -->
    
    <?php if ( (isset($shopkeeper_theme_options['footer_js'])) && ($shopkeeper_theme_options['footer_js'] != "") ) : ?>
		<?php echo $shopkeeper_theme_options['footer_js']; ?>
    <?php endif; ?>
	
    <!-- ******************************************************************** -->
    <!-- * WP Footer() ****************************************************** -->
    <!-- ******************************************************************** -->
	
	<?php wp_footer(); ?>
    
</body>

</html>