<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-my-product.php
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     1.6.4
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

?>

<?php //get_template_part('templates/header/top', 'woocommerce'); ?>

<section id="layout">
    <div class="row">
		<?php get_template_part('templates/inside-pagination'); ?>
        <div class="twelve columns">
			<div class="row">

            <?php while (have_posts()) : the_post(); ?>

                <?php woocommerce_get_template_part('content', 'single-product'); ?>

            <?php endwhile; ?>
			
			</div>
		</div>
    </div>
	
	<?php
		/**
		 * dfd_woocommerce_single_product_footer hook
		 *
		 * @hooked dfd_woocommerce_single_product_footer - 10
		 */
		//do_action( 'dfd_woocommerce_single_product_footer' );
	?>
</section>