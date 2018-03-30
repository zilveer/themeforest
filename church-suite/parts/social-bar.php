<?php
$webnus_options = webnus_options();
$webnus_options['webnus_facebook_ID'] = isset( $webnus_options['webnus_facebook_ID'] ) ? $webnus_options['webnus_facebook_ID'] : '';
$webnus_options['webnus_twitter_ID'] = isset( $webnus_options['webnus_twitter_ID'] ) ? $webnus_options['webnus_twitter_ID'] : '';
$webnus_options['webnus_dribbble_ID'] = isset( $webnus_options['webnus_dribbble_ID'] ) ? $webnus_options['webnus_dribbble_ID'] : '';
$webnus_options['webnus_pinterest_ID'] = isset( $webnus_options['webnus_pinterest_ID'] ) ? $webnus_options['webnus_pinterest_ID'] : '';
$webnus_options['webnus_vimeo_ID'] = isset( $webnus_options['webnus_vimeo_ID'] ) ? $webnus_options['webnus_vimeo_ID'] : '';
$webnus_options['webnus_youtube_ID'] = isset( $webnus_options['webnus_youtube_ID'] ) ? $webnus_options['webnus_youtube_ID'] : '';
$webnus_options['webnus_google_ID'] = isset( $webnus_options['webnus_google_ID'] ) ? $webnus_options['webnus_google_ID'] : '';
$webnus_options['webnus_linkedin_ID'] = isset( $webnus_options['webnus_linkedin_ID'] ) ? $webnus_options['webnus_linkedin_ID'] : '';
$webnus_options['webnus_rss_ID'] = isset( $webnus_options['webnus_rss_ID'] ) ? $webnus_options['webnus_rss_ID'] : '';
$webnus_options['webnus_instagram_ID'] = isset( $webnus_options['webnus_instagram_ID'] ) ? $webnus_options['webnus_instagram_ID'] : '';
$webnus_options['webnus_flickr_ID'] = isset( $webnus_options['webnus_flickr_ID'] ) ? $webnus_options['webnus_flickr_ID'] : '';
$webnus_options['webnus_reddit_ID'] = isset( $webnus_options['webnus_reddit_ID'] ) ? $webnus_options['webnus_reddit_ID'] : '';
$webnus_options['webnus_delicious_ID'] = isset( $webnus_options['webnus_delicious_ID'] ) ? $webnus_options['webnus_delicious_ID'] : '';
$webnus_options['webnus_lastfm_ID'] = isset( $webnus_options['webnus_lastfm_ID'] ) ? $webnus_options['webnus_lastfm_ID'] : '';
$webnus_options['webnus_tumblr_ID'] = isset( $webnus_options['webnus_tumblr_ID'] ) ? $webnus_options['webnus_tumblr_ID'] : '';
$webnus_options['webnus_skype_ID'] = isset( $webnus_options['webnus_skype_ID'] ) ? $webnus_options['webnus_skype_ID'] : '';
?>

<section class="footer-social-bar">
	<div class="container"><div class="row">
	<ul class="footer-social-items">
	<?php
		if($webnus_options['webnus_facebook_ID'])
			echo '<li><a href="'. esc_url($webnus_options['webnus_facebook_ID']) .'" class="facebook"><i class="fa-facebook"></i><div><strong>Facebook</strong><span>'.esc_html__('Join us on','webnus_framework').' Facebook</span></div></a></li>';
		if($webnus_options['webnus_twitter_ID'])
			echo '<li><a href="'. esc_url($webnus_options['webnus_twitter_ID']) .'" class="twitter"><i class="fa-twitter"></i><div><strong>Twitter</strong><span>'.esc_html__('Follow us on','webnus_framework').' Twitter</span></div></a></li>';
		if($webnus_options['webnus_dribbble_ID'])
			echo '<li><a href="'. esc_url($webnus_options['webnus_dribbble_ID']).'" class="dribble"><i class="fa-dribbble"></i><div><strong>Dribbble</strong><span>'.esc_html__('Join us on','webnus_framework').' Dribbble</span></div></a></li>';
		if($webnus_options['webnus_pinterest_ID'])
			echo '<li><a href="'. esc_url($webnus_options['webnus_pinterest_ID']) .'" class="pinterest"><i class="fa-pinterest"></i><div><strong>Pinterest</strong><span>'.esc_html__('Join us on','webnus_framework').' Pinterest</span></div></a></li>';
		if($webnus_options['webnus_vimeo_ID'])
			echo '<li><a href="'. esc_url($webnus_options['webnus_vimeo_ID']) .'" class="vimeo"><i class="fa-vimeo-square"></i><div><strong>Vimeo</strong><span>'.esc_html__('Join us on','webnus_framework').' Vimeo</span></div></a></li>';
		if($webnus_options['webnus_youtube_ID'])
			echo '<li><a href="'. esc_url($webnus_options['webnus_youtube_ID']) .'" class="youtube"><i class="fa-youtube"></i><div><strong>Youtube</strong><span>'.esc_html__('Join us on','webnus_framework').' Youtube</span></div></a></li>';	
		if($webnus_options['webnus_google_ID'])
			echo '<li><a href="'. esc_url($webnus_options['webnus_google_ID']) .'" class="google"><i class="fa-google"></i><div><strong>Google Plus</strong><span>'.esc_html__('Join us on','webnus_framework').' Google Plus</span></div></a></li>';	
		if($webnus_options['webnus_linkedin_ID'])
			echo '<li><a href="'. esc_url($webnus_options['webnus_linkedin_ID']) .'" class="linkedin"><i class="fa-linkedin"></i><div><strong>Linkedin</strong><span>'.esc_html__('Join us on','webnus_framework').' Linkedin</span></div></a></li>';	
		if($webnus_options['webnus_rss_ID'])
			echo '<li><a href="'. esc_url($webnus_options['webnus_rss_ID']) .'" class="rss"><i class="fa-rss"></i><div><strong>Rss</strong><span>'.esc_html__('Keep updated with','webnus_framework').' RSS</span></div></a></li>';
		if($webnus_options['webnus_instagram_ID'])
			echo '<li><a href="'. esc_url($webnus_options['webnus_instagram_ID']) .'" class="instagram"><i class="fa-instagram"></i><div><strong>Instagram</strong><span>'.esc_html__('Join us on','webnus_framework').' Instagram</span></div></a></li>';	
		if($webnus_options['webnus_flickr_ID'])
			echo '<li><a href="'. esc_url($webnus_options['webnus_flickr_ID']) .'" class="other-social"><i class="fa-flickr"></i><div><strong>Flickr</strong><span>'.esc_html__('Join us on','webnus_framework').' Flickr</span></div></a></li>';	
		if($webnus_options['webnus_reddit_ID'])
			echo '<li><a href="'. esc_url($webnus_options['webnus_reddit_ID']) .'" class="other-social"><i class="fa-reddit"></i><div><strong>Reddit</strong><span>'.esc_html__('Join us on','webnus_framework').' Reddit</span></div></a></li>';
		if($webnus_options['webnus_delicious_ID'])
			echo '<li><a href="'. esc_url($webnus_options['webnus_delicious_ID']) .'" class="other-social"><i class="fa-delicious"></i><div><strong>Delicious</strong><span>'.esc_html__('Join us on','webnus_framework').' Delicious</span></div></a></li>';	
		if($webnus_options['webnus_lastfm_ID'])
			echo '<li><a href="'. esc_url($webnus_options['webnus_lastfm_ID']) .'" class="other-social"><i class="fa-lastfm"></i><div><strong>Lastfm</strong><span>'.esc_html__('Join us on','webnus_framework').' Lastfm</span></div></a></li>';
		if($webnus_options['webnus_tumblr_ID'])
			echo '<li><a href="'. esc_url($webnus_options['webnus_tumblr_ID']) .'" class="other-social"><i class="fa-tumblr"></i><div><strong>Tumblr</strong><span>'.esc_html__('Join us on','webnus_framework').' Tumblr</span></div></a></li>';
		if($webnus_options['webnus_skype_ID'])
			echo '<li><a href="'. esc_url($webnus_options['webnus_skype_ID']) .'" class="other-social"><i class="fa-skype"></i><div><strong>Skype</strong><span>'.esc_html__('Join us on','webnus_framework').' Skype</span></div></a></li>';
	?>
	</ul>
	</div></div>
	</section>