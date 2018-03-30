<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_attachment_ids();

if ( $attachment_ids ) {
	?>
	<div id="product-carousel">
		<ul class="slides">
	
	<?php

		$loop = 0;
		$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );

		foreach ( $attachment_ids as $attachment_id ) {

			$classes = array( 'zoom' );

			if ( $loop == 0 || $loop % $columns == 0 )
				$classes[] = 'first';

			if ( ( $loop + 1 ) % $columns == 0 )
				$classes[] = 'last';

			$image_link = wp_get_attachment_url( $attachment_id );

			if ( ! $image_link )
				continue;

			$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
			$image_attributes = wp_get_attachment_image_src( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' )  );
			$image_class = esc_attr( implode( ' ', $classes ) );
			$image_title = esc_attr( get_the_title( $attachment_id ) );

			?>
			
			<li>
				<a  itemprop="image" data-rel="prettyPhoto[product-gallery]" class="" rel="product-images" href="<?php echo $image_link; ?>"></a>
				<img src="<?php echo $image_attributes[0] ?>" data-large="<?php echo $image_link; ?>" alt=""/>
			</li>
			<?php
			
			
			$loop++;
		}

	?>
	
		</ul>
		
		<?php
		if(count($attachment_ids) > 4) {
		echo '<div class="product-arrows">
				<div class="left-arrow">
					<i class="icons icon-left-dir"></i>
				</div>
				<div class="right-arrow">
					<i class="icons icon-right-dir"></i>
				</div>
			</div>';
		}	
		?>
		
		
	</div>
	<?php
}
?>











		<?php if ( get_option('sense_share-product-enable') == 'on' ) { 
			
			$extra_attr = 'target="_blank" ';
			$title = esc_attr(get_the_title());
			$permalink = esc_url( apply_filters( 'the_permalink', get_permalink() ) );
			$image = esc_url(wp_get_attachment_url( get_post_thumbnail_id() ));
			?>
				
				
			<div class="share-links-wrapper v_centered">

				<span class="title"><?php _e('Share this', 'homeshop') ?>:</span>

				<div class="share-links">

					<?php if (get_option('sense_share-product-facebook') == 'on' ): ?>
						<a href="http://www.facebook.com/sharer.php?u=<?php echo $permalink ?>&amp;text=<?php echo $title ?>&amp;images=<?php echo $image ?>" <?php echo $extra_attr ?> title="<?php _e('Facebook', 'homeshop') ?>" class="share-facebook share-link"><?php _e('Facebook', 'homeshop') ?></a>
					<?php endif; ?>

					<?php if (get_option('sense_share-product-twitter') == 'on' ): ?>
						<a href="https://twitter.com/intent/tweet?text=<?php echo $title ?>&amp;url=<?php echo $permalink ?>" <?php echo $extra_attr ?> title="<?php _e('Twitter', 'homeshop') ?>" class="share-twitter"><?php _e('Twitter', 'homeshop') ?></a>
					<?php endif; ?>

					<?php if (get_option('sense_share-product-linkedin') == 'on' ): ?>
						<a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $permalink ?>&amp;title=<?php echo $title ?>" <?php echo $extra_attr ?> title="<?php _e('LinkedIn', 'homeshop') ?>" class="share-linkedin"><?php _e('LinkedIn', 'homeshop') ?></a>
					<?php endif; ?>

					<?php if (get_option('sense_share-product-googleplus') == 'on' ): ?>
						<a href="https://plus.google.com/share?url=<?php echo $permalink ?>" <?php echo $extra_attr ?> title="<?php _e('Google +', 'homeshop') ?>" class="share-googleplus"><?php _e('Google +', 'homeshop') ?></a>
					<?php endif; ?>

					<?php if (get_option('sense_share-product-pinterest') == 'on' ): ?>
						<a href="https://pinterest.com/pin/create/link/?url=<?php echo $permalink ?>&amp;media=<?php echo $image ?>" <?php echo $extra_attr ?> title="<?php _e('Pinterest', 'homeshop') ?>" class="share-pinterest"><?php _e('Pinterest', 'homeshop') ?></a>
					<?php endif; ?>

					<?php if (get_option('sense_share-product-vk') == 'on' ): ?>
						<a href="https://vk.com/share.php?url=<?php echo $permalink ?>&amp;title=<?php echo $title ?>&amp;image=<?php echo $image ?>&amp;noparse=true" <?php echo $extra_attr ?> title="<?php _e('VK', 'homeshop') ?>" class="share-vk"><?php _e('VK', 'homeshop') ?></a>
					<?php endif; ?>

					<?php if (get_option('sense_share-product-tumblr') == 'on' ): ?>
						<a href="http://www.tumblr.com/share/link?url=<?php echo $permalink ?>&amp;name=<?php echo urlencode($title) ?>&amp;description=<?php echo urlencode(get_the_excerpt()) ?>" <?php echo $extra_attr ?> title="<?php _e('Tumblr', 'homeshop') ?>" class="share-tumblr"><?php _e('Tumblr', 'homeshop') ?></a>
					<?php endif; ?>

					<?php if (get_option('sense_share-product-xing') == 'on' ): ?>
						<a href="https://www.xing-share.com/app/user?op=share;sc_p=xing-share;url=<?php echo $permalink ?>" <?php echo $extra_attr ?> title="<?php _e('Xing', 'homeshop') ?>" class="share-xing"><?php _e('Xing', 'homeshop') ?></a>
					<?php endif; ?>

				</div><!--/ .share-links-->

			</div><!--/ .share-links-wrapper-->
	
			<?php } ?>



