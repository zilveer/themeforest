<ul class="social">
	<?php if (get_option_tree('social_google')) : ?><li><a target="_blank" href="<?php echo get_option_tree('social_google'); ?>"><img src="<?php echo WP_THEME_URL; ?>/assets/images/theme/social-icons/google_plus_32.png" alt="google" title="Google+" /></a></li><?php endif; ?>
	<?php if (get_option_tree('social_twitter')) : ?><li><a target="_blank" href="<?php echo get_option_tree('social_twitter'); ?>"><img src="<?php echo WP_THEME_URL; ?>/assets/images/theme/social-icons/twitter_32.png" alt="twitter" title="Twitter"/></a></li><?php endif; ?>
	<?php if (get_option_tree('social_facebook')) : ?><li><a target="_blank" href="<?php echo get_option_tree('social_facebook'); ?>"><img src="<?php echo WP_THEME_URL; ?>/assets/images/theme/social-icons/facebook_32.png" alt="facebook" title="Facebook" /></a></li><?php endif; ?>					
	<?php if (get_option_tree('social_youtube')) : ?><li><a target="_blank" href="<?php echo get_option_tree('social_youtube'); ?>"><img src="<?php echo WP_THEME_URL; ?>/assets/images/theme/social-icons/youtube_32.png" alt="youtube" title="You Tube" /></a></li><?php endif; ?>
	<?php if (get_option_tree('social_vimeo')) : ?><li><a target="_blank" href="<?php echo get_option_tree('social_vimeo'); ?>"><img src="<?php echo WP_THEME_URL; ?>/assets/images/theme/social-icons/vimeo_32.png" alt="vimeo" title="Vimeo" /></a></li><?php endif; ?>
	<?php if (get_option_tree('social_linkedin')) : ?><li><a target="_blank" href="<?php echo get_option_tree('social_linkedin'); ?>"><img src="<?php echo WP_THEME_URL; ?>/assets/images/theme/social-icons/linkedin_32.png" alt="linkedin" title="LinkedIn" /></a></li><?php endif; ?>
	<?php if (get_option_tree('social_pinterest')) : ?><li><a target="_blank" href="<?php echo get_option_tree('social_pinterest'); ?>"><img src="<?php echo WP_THEME_URL; ?>/assets/images/theme/social-icons/pinterest_32.png" alt="pinterest" title="Pinterest"/></a></li><?php endif; ?>
	<?php if (get_option_tree('social_skype')) : ?><li><a target="_blank" href="<?php echo get_option_tree('social_skype'); ?>"><img src="<?php echo WP_THEME_URL; ?>/assets/images/theme/social-icons/skype_32.png" alt="skype" title="Skype"/></a></li><?php endif; ?>
		
		<?php
		if ( function_exists( 'ot_get_option' ) ) {
		if (ot_get_option('social_custom')) :
		  $slides = ot_get_option( 'social_custom', $option_tree );
		  foreach( $slides as $slide ) {
		  	
		  	$slidelink = '<a target="_blank" href="'.$slide['link'].'" '.$lightbox_link.' >'; 
			$slideendlink = '</a>';														
			
		    echo ' 
		    <li>
		     '.$slidelink.'<img src="'.$slide['image'].'" alt="'.$slide['title'].'" />'.$slideendlink.'
		    </li>';
		  }
		endif;
		}
		?>
	
		<?php if (get_option_tree('social_rss') == 'on' ) : ?>
		<li><a target="_blank" href="<?php bloginfo('rss2_url'); ?>"><img src="<?php echo WP_THEME_URL; ?>/assets/images/theme/social-icons/rss_32.png" alt="RSS" title="RSS" /></a></li>
		<?php endif; ?>
</ul>