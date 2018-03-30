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

global $unik_data;
get_header();

$layout = $unik_data['shop_layout'];

?>
<div id="primary" class="content-area">
	<div id="inside">
		
		<?php if($unik_data['breadcrumb']==1 && !is_front_page()) : ?><div class="breadcrumb bg-block-1"><?php woocommerce_breadcrumb(); ?></div><?php endif; ?>
		
		<div class="site-content" >
				
				<?php if ( have_posts() ) : ?>
				<div id="post-content">
			
					<div class="content-wrap bg-block-1">				
							
						
	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>	
						
					</div>
				</div>
			<?php endif; ?>
		</div><!-- site-content -->
	</div><!-- #inside -->
</div><!-- #primary -->	
<?php get_footer(); ?>







