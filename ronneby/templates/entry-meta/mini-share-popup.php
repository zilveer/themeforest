<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
	global $dfd_ronneby;
	$data_title = get_the_title();
	$data_link = get_permalink();
	$shared_image = get_the_post_thumbnail_url();

	if(!$shared_image) {
		$shared_image = get_template_directory_uri() . '/assets/images/no_image_resized_480-360.jpg';
	}
?>
<div class="dfd-share-popup-wrap">
	<a href="#" class="dfd-share-popup"><i class="dfd-icon-network"></i></a>
	<ul class="entry-share-popup rrssb-buttons" data-directory="<?php echo get_template_directory_uri(); ?>"<?php /* style="display: none;" */?>>
		<?php if(!isset($dfd_ronneby['single_enable_facebook']) || $dfd_ronneby['single_enable_facebook']) : ?>
		<li class="rrssb-facebook">
			<!--  Replace with your URL. For best results, make sure you page has the proper FB Open Graph tags in header:
				  https://developers.facebook.com/docs/opengraph/howtos/maximizing-distribution-media-content/ -->
			<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_attr($data_link) ?>" class="popup entry-share-link-facebook">
				<i class="soc_icon-facebook"></i>
			</a>
			<span class="box-name"><?php _e('Facebook', 'dfd'); ?></span>
		</li>
		<?php endif; ?>
		<?php if(!isset($dfd_ronneby['single_enable_twitter']) || $dfd_ronneby['single_enable_twitter']) : ?>
		<li class="rrssb-twitter">
			<!-- Replace href with your Meta and URL information  -->
			<a href="https://twitter.com/intent/tweet?text=<?php echo esc_attr($data_link) ?>" class="popup entry-share-link-twitter">
				<i class="soc_icon-twitter-2"></i>
			</a>
			<span class="box-name"><?php _e('Twitter', 'dfd'); ?></span>
		</li>
		<?php endif; ?>
		<?php if(!isset($dfd_ronneby['single_enable_google_plus']) || $dfd_ronneby['single_enable_google_plus']) : ?>
		<li class="rrssb-googleplus">
			<!-- Replace href with your meta and URL information.  -->
			<a href="https://plus.google.com/share?url=<?php echo esc_attr($data_link) ?>" class="popup entry-share-link-googleplus">
				<i class="soc_icon-google"></i>
			</a>
			<span class="box-name"><?php _e('Google Plus', 'dfd'); ?></span>
		</li>
		<?php endif; ?>
		<?php if(!isset($dfd_ronneby['single_enable_linkedin']) || $dfd_ronneby['single_enable_linkedin']) : ?>
		<li class="rrssb-linkedin">
			<!-- Replace href with your meta and URL information -->
			<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_attr($data_link) ?>" class="popup entry-share-link-linkedin">
				<i class="soc_icon-linkedin"></i>
			</a>
			<span class="box-name"><?php _e('LinkedIN', 'dfd'); ?></span>
		</li>
		<?php endif; ?>
		<?php if(!isset($dfd_ronneby['single_enable_pinterest']) || $dfd_ronneby['single_enable_pinterest']) : ?>
		<li class="rrssb-pinterest">
			<!-- Replace href with your meta and URL information.  -->
			<a href="http://pinterest.com/pin/create/button/?url=<?php echo esc_attr($data_link) ?>&image_url=<?php echo esc_url($shared_image) ?>" class="popup entry-share-link-pinterest">
				<i class="soc_icon-pinterest"></i>
			</a>
			<span class="box-name"><?php _e('Pinterest', 'dfd') ?></span>
		</li>
		<?php endif; ?>
	</ul>
</div>