<?php $facebook_url = get_theme_mod('oy_facebook', ''); ?>		
<?php $twitter_url = get_theme_mod('oy_twitter', ''); ?>		
<?php $googleplus_url = get_theme_mod('oy_googleplus', ''); ?>		
<?php $pinterest_url = get_theme_mod('oy_pinterest', ''); ?>		
<?php $instagram_url = get_theme_mod('oy_instagram', ''); ?>		
<?php $youtube_url = get_theme_mod('oy_youtube', ''); ?>		
<?php $vimeo_url = get_theme_mod('oy_vimeo', ''); ?>	
<?php $tumblr_url = get_theme_mod('oy_tumblr', ''); ?>
<?php $linkedin_url = get_theme_mod('oy_linkedin', ''); ?>
<?php $soundcloud_url = get_theme_mod('oy_soundcloud', ''); ?>
<?php $behance_url = get_theme_mod('oy_behance', ''); ?>
<?php $dribbble_url = get_theme_mod('oy_dribbble', ''); ?>
	
<ul class="social-networking group">
					
	<?php if($facebook_url) { ?>
		<li>
			<a target="_blank" class="facebook-link" href="<?php echo esc_url($facebook_url); ?>" title="<?php esc_attr_e('FaceBook', 'onioneye'); ?>">
				<span class="inner"></span>
				<span class="facebook-icon social-icon"></span>
			</a>
		</li>
	<?php } ?>
	<?php if($twitter_url) { ?>
		<li>
			<a target="_blank" class="twitter-link" href="<?php echo esc_url($twitter_url); ?>" title="<?php esc_attr_e('Twitter', 'onioneye'); ?>">
				<span class="inner"></span>
				<span class="twitter-icon social-icon"></span>
			</a>
		</li>
	<?php } ?>
	<?php if($googleplus_url) { ?>
		<li>
			<a target="_blank" class="googleplus-link" href="<?php echo esc_url($googleplus_url); ?>" title="<?php esc_attr_e('Google Plus', 'onioneye'); ?>">
				<span class="inner"></span>
				<span class="googleplus-icon social-icon"></span>
			</a>
		</li>
	<?php } ?>
	<?php if($pinterest_url) { ?>
		<li>
			<a target="_blank" class="pinterest-link" href="<?php echo esc_url($pinterest_url); ?>" title="<?php esc_attr_e('Pinterest', 'onioneye'); ?>">
				<span class="inner"></span>
				<span class="pinterest-icon social-icon"></span>
			</a>
		</li>
	<?php } ?>
	<?php if($instagram_url) { ?>
		<li> 
			<a target="_blank" class="instagram-link" href="<?php echo esc_url($instagram_url); ?>" title="<?php esc_attr_e('Instagram', 'onioneye'); ?>">
				<span class="inner"></span>
				<span class="instagram-icon social-icon"></span>
			</a>
		</li>
	<?php } ?>
	<?php if($youtube_url) { ?>
		<li>
			<a target="_blank" class="youtube-link" href="<?php echo esc_url($youtube_url); ?>" title="<?php esc_attr_e('YouTube', 'onioneye'); ?>">
				<span class="inner"></span>
				<span class="youtube-icon social-icon"></span>
			</a>
		</li>
	<?php } ?>
	<?php if($vimeo_url) { ?>
		<li>
			<a target="_blank" class="vimeo-link" href="<?php echo esc_url($vimeo_url); ?>" title="<?php esc_attr_e('Vimeo', 'onioneye'); ?>">
				<span class="inner"></span>
				<span class="vimeo-icon social-icon"></span>
			</a>
		</li>
	<?php } ?>
	<?php if($tumblr_url) { ?>
		<li>
			<a target="_blank" class="tumblr-link" href="<?php echo esc_url($tumblr_url); ?>" title="<?php esc_attr_e('Tumblr', 'onioneye'); ?>">
				<span class="inner"></span>
				<span class="tumblr-icon social-icon"></span>
			</a>
		</li>
	<?php } ?>
	<?php if($linkedin_url) { ?>
		<li>
			<a target="_blank" class="linkedin-link" href="<?php echo esc_url($linkedin_url); ?>" title="<?php esc_attr_e('LinkedIn', 'onioneye'); ?>">
				<span class="inner"></span>
				<span class="linkedin-icon social-icon"></span>
			</a>
		</li>
	<?php } ?>
	<?php if($soundcloud_url) { ?>
		<li>
			<a target="_blank" class="soundcloud-link" href="<?php echo esc_url($soundcloud_url); ?>" title="<?php esc_attr_e('SoundCloud', 'onioneye'); ?>">
				<span class="inner"></span>
				<span class="soundcloud-icon social-icon"></span>
			</a>
		</li>
	<?php } ?>
	<?php if($behance_url) { ?>
		<li>
			<a target="_blank" class="behance-link" href="<?php echo esc_url($behance_url); ?>" title="<?php esc_attr_e('Behance', 'onioneye'); ?>">
				<span class="inner"></span>
				<span class="behance-icon social-icon"></span>
			</a>
		</li>
	<?php } ?>
	<?php if($dribbble_url) { ?>
		<li>
			<a target="_blank" class="dribbble-link" href="<?php echo esc_url($dribbble_url); ?>" title="<?php esc_attr_e('Dribbble', 'onioneye'); ?>">
				<span class="inner"></span>
				<span class="dribbble-icon social-icon"></span>
			</a>
		</li>
	<?php } ?>
	
</ul><!-- /.social-networking -->