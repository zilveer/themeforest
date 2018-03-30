<?php global $options_data; ?>
<div class="social-icons">
	<ul class="unstyled">
		<?php if($options_data['social_twitter'] != "") { ?>
			<li class="social-twitter"><a href="http://www.twitter.com/<?php echo $options_data['social_twitter']; ?>" target="_blank" title="<?php _e( 'Twitter', 'richer') ?>"><i class="fa fa-twitter"></i></a></li>
		<?php } ?>
		<?php if($options_data['social_forrst'] != "") { ?>
			<li class="social-forrst"><a href="<?php echo esc_url($options_data['social_forrst']); ?>" target="_blank" title="<?php _e( 'Forrst', 'richer') ?>"><i class="fa icon-forrst"></i></a></li>
		<?php } ?>
		<?php if($options_data['social_dribbble'] != "") { ?>
			<li class="social-dribbble"><a href="<?php echo esc_url($options_data['social_dribbble']); ?>" target="_blank" title="<?php _e( 'Dribbble', 'richer') ?>"><i class="fa fa-dribbble"></i></a></li>
		<?php } ?>
		<?php if($options_data['social_flickr'] != "") { ?>
			<li class="social-flickr"><a href="<?php echo esc_url($options_data['social_flickr']); ?>" target="_blank" title="<?php _e( 'Flickr', 'richer') ?>"><i class="fa sosa-flickr"></i></a></li>
		<?php } ?>
		<?php if($options_data['social_facebook'] != "") { ?>
			<li class="social-facebook"><a href="<?php echo esc_url($options_data['social_facebook']); ?>" target="_blank" title="<?php _e( 'Facebook', 'richer') ?>"><i class="fa fa-facebook"></i></a></li>
		<?php } ?>
		<?php if($options_data['social_skype'] != "") { ?>
			<li class="social-skype"><a href="skype:<?php echo esc_attr($options_data['social_skype']); ?>" title="<?php _e( 'Skype', 'richer') ?>"><i class="fa fa-skype"></i></a></li>
		<?php } ?>
		<?php if($options_data['social_digg'] != "") { ?>
			<li class="social-digg"><a href="<?php echo esc_url($options_data['social_digg']); ?>" target="_blank" title="<?php _e( 'Digg', 'richer') ?>"><i class="fa fa-digg"></i></a></li>
		<?php } ?>
		<?php if($options_data['social_google_plus'] != "") { ?>
			<li class="social-googleplus"><a href="<?php echo esc_url($options_data['social_google_plus']); ?>" target="_blank" title="<?php _e( 'Google plus', 'richer') ?>"><i class="fa fa-google-plus-square"></i></a></li>
		<?php } ?>
		<?php if($options_data['social_linkedin'] != "") { ?>
			<li class="social-linkedin"><a href="<?php echo esc_url($options_data['social_linkedin']); ?>" target="_blank" title="<?php _e( 'LinkedIn', 'richer') ?>"><i class="fa fa-linkedin"></i></a></li>
		<?php } ?>
		<?php if($options_data['social_vimeo'] != "") { ?>
			<li class="social-vimeo"><a href="<?php echo esc_url($options_data['social_vimeo']); ?>" target="_blank" title="<?php _e( 'Vimeo', 'richer') ?>"><i class="fa fa-vimeo-square"></i></a></li>
		<?php } ?>
		<?php if($options_data['social_yahoo'] != "") { ?>
			<li class="social-yahoo"><a href="<?php echo esc_url($options_data['social_yahoo']); ?>" target="_blank" title="<?php _e( 'Yahoo', 'richer') ?>"><i class="fa fa-yahoo"></i></a></li>
		<?php } ?>
		<?php if($options_data['social_tumblr'] != "") { ?>
			<li class="social-tumblr"><a href="<?php echo esc_url($options_data['social_tumblr']); ?>" target="_blank" title="<?php _e( 'Tumblr', 'richer') ?>"><i class="fa fa-tumblr"></i></a></li>
		<?php } ?>
		<?php if($options_data['social_youtube'] != "") { ?>
			<li class="social-youtube"><a href="<?php echo esc_url($options_data['social_youtube']); ?>" target="_blank" title="<?php _e( 'YouTube', 'richer') ?>"><i class="fa fa-youtube"></i></a></li>
		<?php } ?>
		<?php if($options_data['social_picasa'] != "") { ?>
			<li class="social-picasa"><a href="<?php echo esc_url($options_data['social_picasa']); ?>" target="_blank" title="<?php _e( 'Picasa', 'richer') ?>"><i class="fa icon-picasa"></i></a></li>
		<?php } ?>
		<?php if($options_data['social_deviantart'] != "") { ?>
			<li class="social-deviantart"><a href="<?php echo esc_url($options_data['social_deviantart']); ?>" target="_blank" title="<?php _e( 'DeviantArt', 'richer') ?>"><i class="fa fa-deviantart"></i></a></li>
		<?php } ?>
		<?php if($options_data['social_behance'] != "") { ?>
			<li class="social-behance"><a href="<?php echo esc_url($options_data['social_behance']); ?>" target="_blank" title="<?php _e( 'Behance', 'richer') ?>"><i class="fa fa-behance"></i></a></li>
		<?php } ?>
		<?php if($options_data['social_pinterest'] != "") { ?>
			<li class="social-pinterest"><a href="<?php echo esc_url($options_data['social_pinterest']); ?>" target="_blank" title="<?php _e( 'Pinterest', 'richer') ?>"><i class="fa fa-pinterest"></i></a></li>
		<?php } ?>
		<?php if($options_data['social_paypal'] != "") { ?>
			<li class="social-paypal"><a href="<?php echo esc_url($options_data['social_paypal']); ?>" target="_blank" title="<?php _e( 'PayPal', 'richer') ?>"><i class="fa fa-paypal"></i></a></li>
		<?php } ?>
		<?php if($options_data['social_delicious'] != "") { ?>
			<li class="social-delicious"><a href="<?php echo esc_url($options_data['social_delicious']); ?>" target="_blank" title="<?php _e( 'Delicious', 'richer') ?>"><i class="fa fa-delicious"></i></a></li>
		<?php } ?>
		<?php if($options_data['social_instagram'] != "") { ?>
			<li class="social-instagram"><a href="<?php echo esc_url($options_data['social_instagram']); ?>" target="_blank" title="<?php _e( 'Instagram', 'richer') ?>"><i class="fa fa-instagram"></i></a></li>
		<?php } ?>
		<?php if($options_data['social_rss'] == true) { ?>
			<li class="social-rss"><a href="<?php bloginfo('rss2_url'); ?>" target="_blank" title="<?php _e( 'RSS', 'richer') ?>"><i class="fa fa-rss"></i></a></li>
		<?php } ?>
	</ul>
</div>