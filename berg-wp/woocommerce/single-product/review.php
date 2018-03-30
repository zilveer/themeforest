<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     19.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );
?>
<div class="item">
	<div class="reviews-author">
		<span><?php comment_author(); ?></span>
		<?php if ( $rating && get_option( 'woocommerce_enable_review_rating' ) == 'yes' ) : ?>
		<div class="rating">
			<span><span style="width: <?php echo ( $rating / 5 ) * 100; ?>%"></span></span>
		</div>
		<!-- <time itemprop="datePublished" datetime="<?php echo get_comment_date( 'c' ); ?>"><?php echo get_comment_date( __( get_option( 'date_format' ), 'woocommerce' ) ); ?></time> -->
		<?php endif; ?>
	</div>
	<div class="reviews-text">
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<p class="meta"><em><?php _e( 'Your comment is awaiting approval', 'woocommerce' ); ?></em></p>
		<?php else : ?>
			<?php comment_text(); ?>
		<?php endif; ?>
	</div>
</div>