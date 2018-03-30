<?php
/**
 * Loop Rating
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' )
	return;
?>

<?php if ( $rating_html = $product->get_rating_html() ) : ?>
    <?php echo wp_kses($rating_html, array(
        'div' => array(
            'class' => true,
            'title' => true,
            'style' => true,
            'id' => true
        ),
        'span' => array(
            'style' => true,
            'class' => true,
            'id' => true,
            'title' => true
        ),
        'strong' => array(
            'class' => true,
            'id' => true,
            'style' => true,
            'title' => true
        )
    )); ?>
<?php else: ?>
        <div class="star-rating">
            <span style="width: 0%"></span>
        </div>
<?php endif; ?>