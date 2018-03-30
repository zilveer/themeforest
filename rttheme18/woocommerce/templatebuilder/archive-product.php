<?php
/**
 *  Modified clone of main archive-product.php for tempalte builder
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

  

	<?php do_action( 'woocommerce_archive_description' ); ?>

	<?php if ( have_posts() ) : ?>

		<?php
			/**
			 * woocommerce_before_shop_loop hook
			 *
			 * @hooked woocommerce_result_count - 20
			 * @hooked woocommerce_catalog_ordering - 30
			 */
			do_action( 'woocommerce_before_shop_loop' );
		?>
			
		<?php  
			if ( is_shop() && get_option( 'woocommerce_shop_page_display' ) == 'subcategories' ){
				woocommerce_product_subcategories (array('before' => '<div class="product_boxes clearfix">', "after"=>'</div>') );	
			}else{
				woocommerce_product_subcategories (array('before' => '<div class="product_boxes clearfix">', "after"=>'</div>') );	
			}
		?> 

		<?php 
			global $woocommerce_loop, $wp_query, $page_product_count;
			$woocommerce_loop['loop'] = 0;
			$woocommerce_loop['columns'] = "";
			woocommerce_product_loop_start();


			//get page & post counts
			$page_product_count = $wp_query->post_count;  			
		?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php woocommerce_get_template_part( 'content', 'product' ); ?>

			<?php endwhile; // end of the loop. ?>

		<?php woocommerce_product_loop_end(); ?>

		<?php
			/**
			 * woocommerce_after_shop_loop hook
			 *
			 * @hooked woocommerce_pagination - 10
			 */
			do_action( 'woocommerce_after_shop_loop' );
		?>

	<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

		<?php woocommerce_get_template( 'loop/no-products-found.php' ); ?>

	<?php endif; ?>