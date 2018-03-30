<?php
/**
 * Description tab
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $post;

if ( $post->post_content ) : ?>
	
	<div class="tab-description-child">
		<?php $heading = apply_filters('woocommerce_product_description_heading', __('Product Description', 'woocommerce')); ?>

		<h2><?php echo $heading; ?></h2>

		<?php the_content(); ?>

	</div>
<?php endif; ?>