<?php
/**
 * Single Product title
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<?php if (is_product()): ?>

	<h1 itemprop="name" class="product_title entry-title"><?php the_title(); ?></h1>

<?php else: ?>

	<h1 itemprop="name" class="product_title entry-title">
		<a href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a>
	</h1>

<?php endif; ?>