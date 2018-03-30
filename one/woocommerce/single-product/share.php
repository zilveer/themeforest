<?php
/**
 * Single Product Share
 *
 * Sharing plugins can hook into here or you can add your own code directly.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	global $post, $product;
	$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), false, '' );
?>

<div class="thb-content-share">
	<p class="thb-content-share-title">
		<?php _e('Share on', 'thb_text_domain'); ?>
	</p>
	<ul>
		<li>
			<a data-type="thb-facebook" href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" target="_blank" class="product_share_facebook">
				<span>
					<strong><?php _e('Share', 'thb_text_domain'); ?></strong> <?php _e('on Facebook', 'thb_text_domain'); ?>
				</span>
			</a>
		</li>
		<li>
			<a data-type="thb-pinterest" href="//pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $src[0] ?>&description=<?php the_title(); ?>" target="_blank" class="product_share_pinterest">
				<span>
					<strong><?php _e('Pin', 'thb_text_domain'); ?></strong> <?php _e('this item', 'thb_text_domain'); ?>
				</span>
			</a>
		</li>
		<li>
			<a data-type="thb-twitter" href="https://twitter.com/share?url=<?php the_permalink(); ?>" target="_blank" class="product_share_twitter">
				<span>
					<strong><?php _e('Tweet', 'thb_text_domain'); ?></strong> <?php _e('this item', 'thb_text_domain'); ?>
				</span>
			</a>
		</li>
		<li>
			<a data-type="thb-googleplus" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
				<span>
					<strong><?php _e('Google Plus', 'thb_text_domain'); ?></strong> <?php _e('this item', 'thb_text_domain'); ?>
				</span>
			</a>
		</li>
		<li>
			<a data-type="thb-email" href="mailto:enteryour@addresshere.com?subject=<?php the_title(); ?>&body=<?php echo strip_tags(apply_filters( 'woocommerce_short_description', $post->post_excerpt )); ?> <?php the_permalink(); ?>" class="product_share_email">
				<span>
					<strong><?php _e('Email', 'thb_text_domain'); ?></strong> <?php _e('a friend', 'thb_text_domain'); ?>
				</span>
			</a>
		</li>
	</ul>
</div>