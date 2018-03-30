<?php
/**
 * Loop Rating
 *
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $product;

if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' )
	return;
?>
<?php if ( $rating_html = porto_get_rating_html( $product ) ) : ?>
<div class="rating-wrap">
    <span class="rating-before"><span class="rating-line"></span></span>
    <div class="rating-content"><?php echo $rating_html; ?></div>
    <span class="rating-after"><span class="rating-line"></span></span>
</div>
<?php endif; ?>
