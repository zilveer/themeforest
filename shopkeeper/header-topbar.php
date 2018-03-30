<?php
	global $shopkeeper_theme_options;
?>

<div id="site-top-bar">

	<?php if ( (isset($shopkeeper_theme_options['header_width'])) && ($shopkeeper_theme_options['header_width'] == "custom") ) : ?>
    <div class="row">		
        <div class="large-12 columns">
    <?php endif; ?>

        <div class="site-top-bar-inner" style="max-width:<?php echo esc_html($header_max_width_style); ?>">
             
			<div class="language-and-currency">
				
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
				
			</div><!--.language-and-currency-->
            
            <div class="site-top-message"><?php if ( isset($shopkeeper_theme_options['top_bar_text']) ) _e( $shopkeeper_theme_options['top_bar_text'], 'shopkeeper' ); ?></div> 
            
            <?php if ( (isset($shopkeeper_theme_options['top_bar_social_icons'])) && ($shopkeeper_theme_options['top_bar_social_icons'] == "1") ) : ?>
            
            <div class="site-social-icons-wrapper">
                <div class="site-social-icons">
                    <ul>
                                        
                        <?php
                        
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
                        
                        if ( $facebook ) echo('<li><a href="' . $facebook . '" target="_blank" class="social_media"><i class="fa fa-facebook"></i></a></li>' );
                        if ( $pinterest ) echo('<li><a href="' . $pinterest . '" target="_blank" class="social_media"><i class="fa fa-pinterest"></i></a></li>' );
                        if ( $linkedin ) echo('<li><a href="' . $linkedin . '" target="_blank" class="social_media"><i class="fa fa-linkedin"></i></a></li>' );
                        if ( $twitter ) echo('<li><a href="' . $twitter . '" target="_blank" class="social_media"><i class="fa fa-twitter"></i></a></li>' );
                        if ( $googleplus ) echo('<li><a href="' . $googleplus . '" target="_blank" class="social_media"><i class="fa fa-google-plus"></i></a></li>' );
                        if ( $rss ) echo('<li><a href="' . $rss . '" target="_blank" class="social_media"><i class="fa fa-rss"></i></a></li>' );
                        if ( $tumblr ) echo('<li><a href="' . $tumblr . '" target="_blank" class="social_media"><i class="fa fa-tumblr"></i></a></li>' );
                        if ( $instagram ) echo('<li><a href="' . $instagram . '" target="_blank" class="social_media"><i class="fa fa-instagram"></i></a></li>' );
                        if ( $youtube ) echo('<li><a href="' . $youtube . '" target="_blank" class="social_media"><i class="fa fa-youtube"></i></a></li>' );
                        if ( $vimeo ) echo('<li><a href="' . $vimeo . '" target="_blank" class="social_media"><i class="fa fa-vimeo-square"></i></a></li>' );
                        if ( $behance ) echo('<li><a href="' . $behance . '" target="_blank" class="social_media"><i class="fa fa-behance"></i></a></li>' );
                        if ( $dribble ) echo('<li><a href="' . $dribble . '" target="_blank" class="social_media"><i class="fa fa-dribbble"></i></a></li>' );
                        if ( $flickr ) echo('<li><a href="' . $flickr . '" target="_blank" class="social_media"><i class="fa fa-flickr"></i></a></li>' );
                        if ( $git ) echo('<li><a href="' . $git . '" target="_blank" class="social_media"><i class="fa fa-git"></i></a></li>' );
                        if ( $skype ) echo('<li><a href="' . $skype . '" target="_blank" class="social_media"><i class="fa fa-skype"></i></a></li>' );
                        if ( $weibo ) echo('<li><a href="' . $weibo . '" target="_blank" class="social_media"><i class="fa fa-weibo"></i></a></li>' );
                        if ( $foursquare ) echo('<li><a href="' . $foursquare . '" target="_blank" class="social_media"><i class="fa fa-foursquare"></i></a></li>' );
                        if ( $soundcloud ) echo('<li><a href="' . $soundcloud . '" target="_blank" class="social_media"><i class="fa fa-soundcloud"></i></a></li>' );
                        if ( $vk ) echo('<li><a href="' . $vk . '" target="_blank" class="social_media"><i class="fa fa-vk"></i></a></li>' );
                        
                        ?>
                    
                    </ul>
                </div>
            </div>
            
            <?php endif; ?>
            
            <nav id="site-navigation-top-bar" class="main-navigation" role="navigation">                    
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
            </nav><!-- #site-navigation -->
            
        </div><!-- .site-top-bar-inner -->
    
    <?php if ( (isset($shopkeeper_theme_options['header_width'])) && ($shopkeeper_theme_options['header_width'] == "custom") ) : ?>
        </div><!-- .columns -->
    </div><!-- .row -->
    <?php endif; ?>
    
</div><!-- #site-top-bar -->