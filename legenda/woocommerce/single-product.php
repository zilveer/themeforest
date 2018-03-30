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

get_header('shop'); ?>

<?php 
	$sidebarname = 'single';
?>

<?php et_page_heading(); ?>

<div itemscope itemtype="http://schema.org/Product" id="product-<?php the_ID(); ?>" <?php post_class('container'); ?>>
	<div class="page-content">
		<div class="row">

			<div class="content span12">
			
					<?php while ( have_posts() ) : the_post(); ?>
			
						<?php woocommerce_get_template_part( 'content', 'single-product' ); ?>
			
					<?php endwhile; // end of the loop. ?>
			
				<?php
					/**
					 * woocommerce_after_main_content hook
					 *
					 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
					 */
					do_action('woocommerce_after_main_content');
				?>
			</div>
		</div>

	</div>
</div>

<?php get_footer('shop'); ?>