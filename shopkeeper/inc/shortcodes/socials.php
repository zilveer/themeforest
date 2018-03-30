<?php

function shopkeeper_socials($atts, $content = null) {	
	global $shopkeeper_theme_options;
	extract(shortcode_atts(array(
		"items_align" => 'left'
	), $atts));
    ob_start();
    ?>

    <div class="site-social-icons-shortcode">
        <ul class="<?php echo esc_html($items_align); ?>">
            <?php if ( (isset($shopkeeper_theme_options['facebook_link'])) && (trim($shopkeeper_theme_options['facebook_link']) != "" ) ) { ?><li class="site-social-icons-facebook"><a target="_blank" href="<?php echo esc_url($shopkeeper_theme_options['facebook_link']); ?>"><i class="fa fa-facebook"></i><span>Facebook</span></a></li><?php } ?>
            <?php if ( (isset($shopkeeper_theme_options['twitter_link'])) && (trim($shopkeeper_theme_options['twitter_link']) != "" ) ) { ?><li class="site-social-icons-twitter"><a target="_blank" href="<?php echo esc_url($shopkeeper_theme_options['twitter_link']); ?>"><i class="fa fa-twitter"></i><span>Twitter</span></a></li><?php } ?>
            <?php if ( (isset($shopkeeper_theme_options['pinterest_link'])) && (trim($shopkeeper_theme_options['pinterest_link']) != "" ) ) { ?><li class="site-social-icons-pinterest"><a target="_blank" href="<?php echo esc_url($shopkeeper_theme_options['pinterest_link']); ?>"><i class="fa fa-pinterest"></i><span>Pinterest</span></a></li><?php } ?>
            <?php if ( (isset($shopkeeper_theme_options['linkedin_link'])) && (trim($shopkeeper_theme_options['linkedin_link']) != "" ) ) { ?><li class="site-social-icons-linkedin"><a target="_blank" href="<?php echo esc_url($shopkeeper_theme_options['linkedin_link']); ?>"><i class="fa fa-linkedin"></i><span>LinkedIn</span></a></li><?php } ?>
            <?php if ( (isset($shopkeeper_theme_options['googleplus_link'])) && (trim($shopkeeper_theme_options['googleplus_link']) != "" ) ) { ?><li class="site-social-icons-googleplus"><a target="_blank" href="<?php echo esc_url($shopkeeper_theme_options['googleplus_link']); ?>"><i class="fa fa-google-plus"></i><span>Google+</span></a></li><?php } ?>
            <?php if ( (isset($shopkeeper_theme_options['rss_link'])) && (trim($shopkeeper_theme_options['rss_link']) != "" ) ) { ?><li class="site-social-icons-rss"><a target="_blank" href="<?php echo esc_url($shopkeeper_theme_options['rss_link']); ?>"><i class="fa fa-rss"></i><span>RSS</span></a></li><?php } ?>
            <?php if ( (isset($shopkeeper_theme_options['tumblr_link'])) && (trim($shopkeeper_theme_options['tumblr_link']) != "" ) ) { ?><li class="site-social-icons-tumblr"><a target="_blank" href="<?php echo esc_url($shopkeeper_theme_options['tumblr_link']); ?>"><i class="fa fa-tumblr"></i><span>Tumblr</span></a></li><?php } ?>
            <?php if ( (isset($shopkeeper_theme_options['instagram_link'])) && (trim($shopkeeper_theme_options['instagram_link']) != "" ) ) { ?><li class="site-social-icons-instagram"><a target="_blank" href="<?php echo esc_url($shopkeeper_theme_options['instagram_link']); ?>"><i class="fa fa-instagram"></i><span>Instagram</span></a></li><?php } ?>
            <?php if ( (isset($shopkeeper_theme_options['youtube_link'])) && (trim($shopkeeper_theme_options['youtube_link']) != "" ) ) { ?><li class="site-social-icons-youtube"><a target="_blank" href="<?php echo esc_url($shopkeeper_theme_options['youtube_link']); ?>"><i class="fa fa-youtube-play"></i><span>Youtube</span></a></li><?php } ?>
            <?php if ( (isset($shopkeeper_theme_options['vimeo_link'])) && (trim($shopkeeper_theme_options['vimeo_link']) != "" ) ) { ?><li class="site-social-icons-vimeo"><a target="_blank" href="<?php echo esc_url($shopkeeper_theme_options['vimeo_link']); ?>"><i class="fa fa-vimeo-square"></i><span>Vimeo</span></a></li><?php } ?>            
            <?php if ( (isset($shopkeeper_theme_options['behance_link'])) && (trim($shopkeeper_theme_options['behance_link']) != "" ) ) { ?><li class="site-social-icons-behance"><a target="_blank" href="<?php echo esc_url($shopkeeper_theme_options['behance_link']); ?>"><i class="fa fa-behance"></i><span>Behance</span></a></li><?php } ?>
            <?php if ( (isset($shopkeeper_theme_options['dribble_link'])) && (trim($shopkeeper_theme_options['dribble_link']) != "" ) ) { ?><li class="site-social-icons-dribbble"><a target="_blank" href="<?php echo esc_url($shopkeeper_theme_options['dribble_link']); ?>"><i class="fa fa-dribbble"></i><span>Dribbble</span></a></li><?php } ?>
            <?php if ( (isset($shopkeeper_theme_options['flickr_link'])) && (trim($shopkeeper_theme_options['flickr_link']) != "" ) ) { ?><li class="site-social-icons-flickr"><a target="_blank" href="<?php echo esc_url($shopkeeper_theme_options['flickr_link']); ?>"><i class="fa fa-flickr"></i><span>Flickr</span></a></li><?php } ?>
            <?php if ( (isset($shopkeeper_theme_options['git_link'])) && (trim($shopkeeper_theme_options['git_link']) != "" ) ) { ?><li class="site-social-icons-git"><a target="_blank" href="<?php echo esc_url($shopkeeper_theme_options['git_link']); ?>"><i class="fa fa-git"></i><span>Git</span></a></li><?php } ?>
            <?php if ( (isset($shopkeeper_theme_options['skype_link'])) && (trim($shopkeeper_theme_options['skype_link']) != "" ) ) { ?><li class="site-social-icons-skype"><a target="_blank" href="<?php echo esc_url($shopkeeper_theme_options['skype_link']); ?>"><i class="fa fa-skype"></i><span>Skype</span></a></li><?php } ?>
            <?php if ( (isset($shopkeeper_theme_options['weibo_link'])) && (trim($shopkeeper_theme_options['weibo_link']) != "" ) ) { ?><li class="site-social-icons-weibo"><a target="_blank" href="<?php echo esc_url($shopkeeper_theme_options['weibo_link']); ?>"><i class="fa fa-weibo"></i><span>Weibo</span></a></li><?php } ?>
            <?php if ( (isset($shopkeeper_theme_options['foursquare_link'])) && (trim($shopkeeper_theme_options['foursquare_link']) != "" ) ) { ?><li class="site-social-icons-foursquare"><a target="_blank" href="<?php echo esc_url($shopkeeper_theme_options['foursquare_link']); ?>"><i class="fa fa-foursquare"></i><span>Foursquare</span></a></li><?php } ?>
            <?php if ( (isset($shopkeeper_theme_options['soundcloud_link'])) && (trim($shopkeeper_theme_options['soundcloud_link']) != "" ) ) { ?><li class="site-social-icons-soundcloud"><a target="_blank" href="<?php echo esc_url($shopkeeper_theme_options['soundcloud_link']); ?>"><i class="fa fa-soundcloud"></i><span>Soundcloud</span></a></li><?php } ?>
            <?php if ( (isset($shopkeeper_theme_options['vk_link'])) && (trim($shopkeeper_theme_options['vk_link']) != "" ) ) { ?><li class="site-social-icons-vk"><a target="_blank" href="<?php echo esc_url($shopkeeper_theme_options['vk_link']); ?>"><i class="fa fa-vk"></i><span>VK</span></a></li><?php } ?>
        </ul>
    </div>
    
    <?php
    $content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("social-media", "shopkeeper_socials");