<?php
/**
 * Single product short description
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     99.99
 */

global $post, $product, $pmc_data , $wpdb;


?>

	<div class="titleSP">
		<h2><?php the_title(); ?></h2>
		<p>	
		<?php if ( $product->is_type( array( 'simple', 'variable' ) ) && get_option('woocommerce_enable_sku') == 'yes' && $product->get_sku() ) : ?>
		<span itemprop="productID" class="sku"><?php _e('SKU:', 'buler'); ?> <?php echo $product->get_sku(); ?></span>
		<?php endif; ?>
	</p>
	</div>
	<div class = "review-top">
		<div class="review-top-stock">

			<?php //echo $product->is_in_stock() ? __('In stock','buler') : __('Out of stock','buler') ; ?>

		</div>
		<div class = "review-top-stars">
		<?php
			$average = 0;
			$count = $wpdb->get_var("
				SELECT COUNT(meta_value) FROM $wpdb->commentmeta
				LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
				WHERE meta_key = 'rating'
				AND comment_post_ID = ".get_the_id()."
				AND comment_approved = '1'
				AND meta_value > 0
			");
			$rating = $wpdb->get_var("
				SELECT SUM(meta_value) FROM $wpdb->commentmeta
				LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
				WHERE meta_key = 'rating'
				AND comment_post_ID = ".get_the_id()."
				AND comment_approved = '1'
			");					
		?>
		<?php 
		if ( $count > 0 ) :
			$average = number_format($rating / $count, 2);
		endif;
			echo '<div class="star-rating" title="'.sprintf(__('Rated 0 out of 5', 'buler'), $average).'"><span style="width:'.($average*16).'px"></span></div>';

		?>	
		</div>
		<div class = "review-top-number-rating">
			<?php echo $product->get_rating_count();  ?> <?php echo __('Reviews', 'buler') ?>
		</div>
		<div class = "review-top-add-review">
			<a href="#review_form" class="show_review_form" title="Add Your Review">Add Review</a>
		</div>	
	</div>

	<?php if($post->post_excerpt) { ?>
	<div class="descriptionSP short">
		<?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ); ?>
	</div>
	<?php } ?>
	<div class="cart-wraper-SP">
	<div class="recentCart"><?php // woocommerce_template_loop_add_to_cart(  $product ); ?></div>
