<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<?php while ( have_posts() ) : the_post(); ?>

	<?php woocommerce_get_template_part( 'content', 'single-product' ); ?>

<?php endwhile; // end of the loop. ?>
