<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
	$data_title = get_the_title();
	$data_link = get_permalink();
				
	$shared_image = get_the_post_thumbnail_url();

	if(!$shared_image) {
		$shared_image = get_template_directory_uri() . '/assets/images/no_image_resized_480-360.jpg';
	}
?>
<div class="dfd-blog-share-popup-wrap" data-directory="<?php echo get_template_directory_uri(); ?>" data-url="<?php echo esc_url($data_link) ?>" data-text="<?php _e('Share','dfd') ?>" data-title="<?php _e('Share','dfd') ?>">
	<div class="box">
		<div class="dfd-share-icons">
			<?php
			/*
			<a href="#" class="facebook soc_icon-facebook"></a>
			<a href="#" class="googleplus soc_icon-google"></a>
			<a href="#" class="linkedin soc_icon-linkedin"></a>
			<a href="#" class="pinterest soc_icon-pinterest"></a>
			<a href="#" class="twitter soc_icon-twitter-3"></a>
			*/
			?>
			<ul>
				<li class="rrssb-facebook facebook soc_icon-facebook">
					<!--  Replace with your URL. For best results, make sure you page has the proper FB Open Graph tags in header:
						  https://developers.facebook.com/docs/opengraph/howtos/maximizing-distribution-media-content/ -->
					<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_attr($data_link) ?>" class="popup"></a>
				</li>
				<li class="rrssb-googleplus googleplus soc_icon-google">
					<!-- Replace href with your meta and URL information.  -->
					<a href="https://plus.google.com/share?url=<?php echo esc_attr($data_link) ?>" class="popup"></a>
				</li>
				<li class="rrssb-linkedin linkedin soc_icon-linkedin">
					<!-- Replace href with your meta and URL information -->
					<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_attr($data_link) ?>" class="popup"></a>
				</li>
				<li class="rrssb-pinterest pinterest soc_icon-pinterest">
					<!-- Replace href with your meta and URL information.  -->
					<a href="http://pinterest.com/pin/create/button/?url=<?php echo esc_attr($data_link) ?>&image_url=<?php echo esc_url($shared_image) ?>" class="popup"></a>
				</li>
				<li class="rrssb-twitter twitter soc_icon-twitter-3">
					<!-- Replace href with your Meta and URL information  -->
					<a href="https://twitter.com/intent/tweet?text=<?php echo esc_attr($data_link) ?>" class="popup"></a>
				</li>
			</ul>
		</div>
		<div class="dfd-share-title box-name"><?php esc_html_e('Share','dfd') ?></div>
	</div>
</div>