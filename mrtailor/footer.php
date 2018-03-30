					<?php global $woocommerce, $yith_wcwl, $mr_tailor_theme_options, $page_id; ?>
                    
                    <?php

                    $page_id = "";
                    if ( is_single() || is_page() ) {
                        $page_id = get_the_ID();
                    } else if ( is_home() ) {
                        $page_id = get_option('page_for_posts');		
                    }
					
					if (get_post_meta( $page_id, 'footer_meta_box_check', true )) {
						$page_footer_option = get_post_meta( $page_id, 'footer_meta_box_check', true );
					} else {
						$page_footer_option = "off";
					}
					
					?>
                    
                    <?php if ( $page_footer_option == "off" ) : ?>

                    <footer id="site-footer" role="contentinfo">
						
						 <?php if ( is_active_sidebar( 'footer-widget-area' ) ) : ?>
						 
                            <?php if ( isset($mr_tailor_theme_options['expandable_footer']) && ($mr_tailor_theme_options['expandable_footer'] == 1 ) ) { ?>
    							<div class="trigger-footer-widget-area">
    								<span class="trigger-footer-widget-icon"></span>
    							</div>
						    <?php } ?>

							<div class="site-footer-widget-area" style="<?php if ( isset($mr_tailor_theme_options['expandable_footer']) && ($mr_tailor_theme_options['expandable_footer'] == 0 ) ) echo 'display:block'; ?>">
								<div class="row">
									<?php dynamic_sidebar( 'footer-widget-area' ); ?>
								</div><!-- .row -->
							</div><!-- .site-footer-widget-area -->
                        
						<?php endif; ?>
						
                        <div class="site-footer-copyright-area">
                            <div class="row">
                                <div class="medium-4 columns">	
                                    <div class="payment_methods">
                                        
                                        <?php
                                        if ( (isset($mr_tailor_theme_options['credit_card_icons']['url'])) && (trim($mr_tailor_theme_options['credit_card_icons']['url']) != "" ) ) {
                                            if (is_ssl()) {
                                                $credit_card_icons = str_replace("http://", "https://", $mr_tailor_theme_options['credit_card_icons']['url']);		
                                            } else {
                                                $credit_card_icons = $mr_tailor_theme_options['credit_card_icons']['url'];
                                            }
                                        ?>
                
                                        <img src="<?php echo $credit_card_icons; ?>" alt="<?php _e( 'Payment methods', 'mr_tailor' )?>" />
                                        
                                        <?php } ?>
            
                                    </div><!-- .payment_methods -->
                                </div><!-- .large-4 .columns -->
                                
                                <div class="medium-8 columns">
                                    <div class="copyright_text">
                                        <?php if ( (isset($mr_tailor_theme_options['footer_copyright_text'])) && (trim($mr_tailor_theme_options['footer_copyright_text']) != "" ) ) { ?>
                                            <?php _e( $mr_tailor_theme_options['footer_copyright_text'], 'mr_tailor' ); ?>
                                        <?php } ?>
                                    </div><!-- .copyright_text -->  
                                </div><!-- .large-8 .columns -->            
                            </div><!-- .row --> 
                        </div><!-- .site-footer-copyright-area -->
                               
                    </footer>

                    <?php endif; ?>
                    
                </div><!-- #page -->
                        
            </div><!-- /st-content -->
        </div><!-- /st-pusher -->
        
        <nav class="st-menu slide-from-left">
            <div class="nano">
                <div class="nano-content">
                    <div id="mobiles-menu-offcanvas" class="offcanvas-left-content">
                    	
                        <nav id="mobile-main-navigation" class="mobile-navigation" role="navigation">
						<?php 
							wp_nav_menu(array(
								'theme_location'  => 'main-navigation',
								'fallback_cb'     => false,
								'container'       => false,
								'items_wrap'      => '<ul id="%1$s">%3$s</ul>',
							));
						?>
                        </nav>
                        
                        <?php 
						
						$theme_locations  = get_nav_menu_locations();
						if (isset($theme_locations['top-bar-navigation'])) {
							$menu_obj = get_term($theme_locations['top-bar-navigation'], 'nav_menu');
						}
						
						if ( (isset($menu_obj->count) && ($menu_obj->count > 0)) || (is_user_logged_in()) ) {
						?>
                        
                            <nav id="mobile-top-bar-navigation" class="mobile-navigation" role="navigation">
                            <?php 
                                wp_nav_menu(array(
                                    'theme_location'  => 'top-bar-navigation',
                                    'fallback_cb'     => false,
                                    'container'       => false,
                                    'items_wrap'      => '<ul id="%1$s">%3$s</ul>',
                                ));
                            ?>
                            
                            <?php if ( is_user_logged_in() ) { ?>
                                <ul><li><a href="<?php echo get_site_url(); ?>/?<?php echo get_option('woocommerce_logout_endpoint'); ?>=true" class="logout_link"><?php _e('Logout', 'mr_tailor'); ?></a></li></ul>
                            <?php } ?>
                            </nav>
                        
                        <?php } ?>
                        
                        <?php if ( function_exists('icl_get_languages') || class_exists('woocommerce_wpml') ) { ?>

                        <div class="language-and-currency-offcanvas hide-for-large-up">
							
							
            
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
                            
                           
                            <?php if (class_exists('woocommerce_wpml')) { ?>
                                <?php echo(do_shortcode('[currency_switcher]')); ?>
                            <?php } ?>
                        
                        </div>

                        <?php } ?>
                        
                        <div class="mobile-socials">
                            <div class="site-social-icons">
                                <ul class="//animated //flipY">
                                    <?php if ( (isset($mr_tailor_theme_options['facebook_link'])) && (trim($mr_tailor_theme_options['facebook_link']) != "" ) ) { ?><li class="site-social-icons-facebook"><a target="_blank" href="<?php echo $mr_tailor_theme_options['facebook_link']; ?>"><i class="fa fa-facebook"></i><span>Facebook</span></a></li><?php } ?>
                                    <?php if ( (isset($mr_tailor_theme_options['twitter_link'])) && (trim($mr_tailor_theme_options['twitter_link']) != "" ) ) { ?><li class="site-social-icons-twitter"><a target="_blank" href="<?php echo $mr_tailor_theme_options['twitter_link']; ?>"><i class="fa fa-twitter"></i><span>Twitter</span></a></li><?php } ?>
                                    <?php if ( (isset($mr_tailor_theme_options['vkontakte_link'])) && (trim($mr_tailor_theme_options['vkontakte_link']) != "" ) ) { ?><li class="site-social-icons-vkontakte"><a target="_blank" href="<?php echo $mr_tailor_theme_options['vkontakte_link']; ?>"><i class="fa fa-vk"></i><span>VKontakte</span></a></li><?php } ?>
                                    <?php if ( (isset($mr_tailor_theme_options['pinterest_link'])) && (trim($mr_tailor_theme_options['pinterest_link']) != "" ) ) { ?><li class="site-social-icons-pinterest"><a target="_blank" href="<?php echo $mr_tailor_theme_options['pinterest_link']; ?>"><i class="fa fa-pinterest"></i><span>Pinterest</span></a></li><?php } ?>
                                    <?php if ( (isset($mr_tailor_theme_options['linkedin_link'])) && (trim($mr_tailor_theme_options['linkedin_link']) != "" ) ) { ?><li class="site-social-icons-linkedin"><a target="_blank" href="<?php echo $mr_tailor_theme_options['linkedin_link']; ?>"><i class="fa fa-linkedin"></i><span>LinkedIn</span></a></li><?php } ?>
                                    <?php if ( (isset($mr_tailor_theme_options['googleplus_link'])) && (trim($mr_tailor_theme_options['googleplus_link']) != "" ) ) { ?><li class="site-social-icons-googleplus"><a target="_blank" href="<?php echo $mr_tailor_theme_options['googleplus_link']; ?>"><i class="fa fa-google-plus"></i><span>Google+</span></a></li><?php } ?>
                                    <?php if ( (isset($mr_tailor_theme_options['rss_link'])) && (trim($mr_tailor_theme_options['rss_link']) != "" ) ) { ?><li class="site-social-icons-rss"><a target="_blank" href="<?php echo $mr_tailor_theme_options['rss_link']; ?>"><i class="fa fa-rss"></i><span>RSS</span></a></li><?php } ?>
                                    <?php if ( (isset($mr_tailor_theme_options['tumblr_link'])) && (trim($mr_tailor_theme_options['tumblr_link']) != "" ) ) { ?><li class="site-social-icons-tumblr"><a target="_blank" href="<?php echo $mr_tailor_theme_options['tumblr_link']; ?>"><i class="fa fa-tumblr"></i><span>Tumblr</span></a></li><?php } ?>
                                    <?php if ( (isset($mr_tailor_theme_options['instagram_link'])) && (trim($mr_tailor_theme_options['instagram_link']) != "" ) ) { ?><li class="site-social-icons-instagram"><a target="_blank" href="<?php echo $mr_tailor_theme_options['instagram_link']; ?>"><i class="fa fa-instagram"></i><span>Instagram</span></a></li><?php } ?>
                                    <?php if ( (isset($mr_tailor_theme_options['youtube_link'])) && (trim($mr_tailor_theme_options['youtube_link']) != "" ) ) { ?><li class="site-social-icons-youtube"><a target="_blank" href="<?php echo $mr_tailor_theme_options['youtube_link']; ?>"><i class="fa fa-youtube-play"></i><span>Youtube</span></a></li><?php } ?>
                                    <?php if ( (isset($mr_tailor_theme_options['vimeo_link'])) && (trim($mr_tailor_theme_options['vimeo_link']) != "" ) ) { ?><li class="site-social-icons-vimeo"><a target="_blank" href="<?php echo $mr_tailor_theme_options['vimeo_link']; ?>"><i class="fa fa-vimeo-square"></i><span>Vimeo</span></a></li><?php } ?>
                                </ul>
                            </div>
                        </div>
                        
                    </div>
                    <div id="filters-offcanvas" class="offcanvas-left-content wpb_widgetised_column">
						<?php if ( is_active_sidebar( 'catalog-widget-area' ) ) : ?>
                            <?php dynamic_sidebar( 'catalog-widget-area' ); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>
        
        <nav class="st-menu slide-from-right">
            <div class="nano">
                <div class="nano-content">
					<div id="minicart-offcanvas" class="offcanvas-right-content"><?php if ( class_exists( 'WC_Widget_Cart' ) ) { the_widget( 'mr_tailor_WC_Widget_Cart' ); } ?></div>
                    <div id="wishlist-offcanvas" class="offcanvas-right-content"><div class="widget"></div></div>
                </div>
            </div>
        </nav>
    
    </div><!-- /st-container -->
    
    <!-- ******************************************************************** -->
    <!-- * Custom Footer JavaScript Code ************************************ -->
    <!-- ******************************************************************** -->
    
    <?php if ( (isset($mr_tailor_theme_options['footer_js'])) && ($mr_tailor_theme_options['footer_js'] != "") ) : ?>
		<script type="text/javascript">
			<?php echo $mr_tailor_theme_options['footer_js']; ?>
		</script>
    <?php endif; ?>
    
    <?php if ( (isset($mr_tailor_theme_options['sticky_header'])) && (trim($mr_tailor_theme_options['sticky_header']) == "1" ) ) : ?>
    
	<!-- ******************************************************************** -->
    <!-- * Sticky Header **************************************************** -->
    <!-- ******************************************************************** -->
	
	<div class="site-header-sticky">
        <div class="row">		
		<div class="large-12 columns">
		    <div class="site-header-sticky-inner">
                    
                <?php
                
                if ( (isset($mr_tailor_theme_options['site_logo']['url'])) && (trim($mr_tailor_theme_options['site_logo']['url']) != "" ) ) {
                    if (is_ssl()) {
                        $sticky_header_logo = str_replace("http://", "https://", $mr_tailor_theme_options['site_logo']['url']);		
                    } else {
                        $sticky_header_logo = $mr_tailor_theme_options['site_logo']['url'];
                    }
                }

                if ( (isset($mr_tailor_theme_options['sticky_header_logo']['url'])) && (trim($mr_tailor_theme_options['sticky_header_logo']['url']) != "" ) ) {
                    if (is_ssl()) {
                        $sticky_header_logo = str_replace("http://", "https://", $mr_tailor_theme_options['sticky_header_logo']['url']);		
                    } else {
                        $sticky_header_logo = $mr_tailor_theme_options['sticky_header_logo']['url'];
                    }
                }

                ?>

                <div class="site-branding">

                    <?php if ( (isset($mr_tailor_theme_options['site_logo']['url'])) && (trim($mr_tailor_theme_options['site_logo']['url']) != "" ) ) : ?>

                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img class="site-logo" src="<?php echo $sticky_header_logo; ?>" title="<?php bloginfo( 'description' ); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>

                    <?php else : ?>

                        <div class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></div>

                <?php endif; ?>

                </div><!-- .site-branding -->
                
                <div id="site-menu">
                    
                    <nav id="site-navigation" class="main-navigation" role="navigation">                    
                        <?php 
                            $walker = new rc_scm_walker;
                            wp_nav_menu(array(
                                'theme_location'  => 'main-navigation',
                                'fallback_cb'     => false,
                                'container'       => false,
                                'items_wrap'      => '<ul id="%1$s">%3$s</ul>',
                                'walker' 		  => $walker
                            ));
                        ?>           
                    </nav><!-- #site-navigation -->                  
                    
                    <div class="site-tools">
                        <ul>
                            
                            <li class="mobile-menu-button"><a href="javascript:void(0)"><i class="getbowtied-icon-menu"></i></a></li>
                            
                            <?php if (class_exists('YITH_WCWL')) : ?>
                            <?php if ( (isset($mr_tailor_theme_options['main_header_wishlist'])) && (trim($mr_tailor_theme_options['main_header_wishlist']) == "1" ) ) : ?>
                            <li class="wishlist-button">
                                <a href="<?php echo esc_url($yith_wcwl->get_wishlist_url()); ?>">
                                    <?php if ( (isset($mr_tailor_theme_options['main_header_wishlist_icon']['url'])) && ($mr_tailor_theme_options['main_header_wishlist_icon']['url'] != "") ) : ?>
                                    <img src="<?php echo esc_url($mr_tailor_theme_options['main_header_wishlist_icon']['url']); ?>">
                                    <?php else : ?>
                                    <i class="getbowtied-icon-heart"></i>
                                    <?php endif; ?>
                                    <span class="wishlist_items_number"><?php echo yith_wcwl_count_products(); ?></span>
                                </a>
                            </li>							
							<?php endif; ?>
                            <?php endif; ?>
                            
                            
                            
                            <?php if (class_exists('WooCommerce')) : ?>
                            <?php if ( (isset($mr_tailor_theme_options['main_header_shopping_bag'])) && (trim($mr_tailor_theme_options['main_header_shopping_bag']) == "1" ) ) : ?>
                            <?php if ( (isset($mr_tailor_theme_options['catalog_mode'])) && ($mr_tailor_theme_options['catalog_mode'] == 1) ) : ?>
                            <?php else : ?>
                            <li class="shopping-bag-button" class="right-off-canvas-toggle">
                                <a href="javascript:void(0)">
                                    <?php if ( (isset($mr_tailor_theme_options['main_header_shopping_bag_icon']['url'])) && ($mr_tailor_theme_options['main_header_shopping_bag_icon']['url'] != "") ) : ?>
                                    <img src="<?php echo esc_url($mr_tailor_theme_options['main_header_shopping_bag_icon']['url']); ?>">
                                    <?php else : ?>
                                    <i class="getbowtied-icon-shop"></i>
                                    <?php endif; ?>
                                    <span class="shopping_bag_items_number"><?php echo $woocommerce->cart->cart_contents_count; ?></span>
                                </a>
                            </li>
							<?php endif; ?>
                            <?php endif; ?>
                            <?php endif; ?>

                            <?php if ( (isset($mr_tailor_theme_options['main_header_search_bar'])) && (trim($mr_tailor_theme_options['main_header_search_bar']) == "1" ) ) : ?>
                            <li class="search-button">
                                <a href="javascript:void(0)">
                                    <?php if ( (isset($mr_tailor_theme_options['main_header_search_bar_icon']['url'])) && ($mr_tailor_theme_options['main_header_search_bar_icon']['url'] != "") ) : ?>
                                    <img class="getbowtied-icon-search" src="<?php echo esc_url($mr_tailor_theme_options['main_header_search_bar_icon']['url']); ?>">
                                    <?php else : ?>
                                    <i class="getbowtied-icon-search"></i>
                                    <?php endif; ?>
                                </a>
                            </li>
                            <?php endif; ?>
                            
                        </ul>	
                    </div>
                
                </div><!-- #site-menu -->
                
                <div class="clearfix"></div>
			</div><!--.site-header-sticky-inner-->	
		</div><!-- .large-12-->
		</div><!--.row--> 
    </div><!-- .site-header-sticky -->
    
    <?php endif; ?>
	
	
    <!-- ******************************************************************** -->
    <!-- * WP Footer() ****************************************************** -->
    <!-- ******************************************************************** -->
	
	<div class="login_header">
		<a class="go_home" href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a>
	</div>
	
<?php wp_footer(); ?>
</body>

</html>