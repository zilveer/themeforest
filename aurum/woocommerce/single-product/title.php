<?php
/**
 * Single Product title
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

/* Note: This file has been altered by Laborator */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
<h1 itemprop="name" class="product_title entry-title">
	<?php the_title(); ?>

	<?php if(get_data('shop_single_product_category')): ?>
	<small class="product-terms">
		<?php the_terms(get_the_id(), 'product_cat'); ?>
	</small>
	<?php endif; ?>
</h1>