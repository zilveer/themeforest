<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 *
 * @author 		owwwlab
 * @package 	Toranj
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$side_class='no-side';
//Check if we have any active sidebar
if ( is_active_sidebar( 'shop-sidebar-1' ) ) {

	switch (ot_get_option("woocommerce_side_position")) {
		case 'left':
			$side_class='with-sidebar left-sidebar';
			break;
		case 'right':
			$side_class='with-sidebar right-sidebar';
			break;
		default: // no sidebar needed
			$side_class='no-side';
			break;
	}

}

get_header( 'shop' ); ?>

<!--Page main wrapper-->
<div id="main-content"> 
	<div class="page-wrapper regular-page">


		<div id="shop-header">
			<?php include( locate_template( OWLAB_WOO_TEMPLATES . '/parts/header.php') ); ?>
		</div>
		<!-- /shop-header	 -->

		<div id="shop-content">
		

				

				<?php if ( have_posts() ) : ?>
					
					<div class="shop-top-bar custom-grid-row">
						<div class="container">
							<?php
								/**
								 * woocommerce_before_shop_loop hook
								 *
								 * @hooked woocommerce_result_count - 20
								 * @hooked woocommerce_catalog_ordering - 30
								 */

								do_action( 'woocommerce_before_shop_loop' );
							?>	
						</div>
							
					</div>
					<!-- /.shop-top-bar -->

					<div class="container shop-main-wrapper custom-grid-row <?php echo $side_class ?>">
						
						<div class="shop-main">
							<?php woocommerce_product_loop_start(); ?>

								<?php woocommerce_product_subcategories(); ?>

								<?php while ( have_posts() ) : the_post(); ?>

									<?php wc_get_template_part( 'content', 'product' ); ?>

								<?php endwhile; // end of the loop. ?>

							<?php woocommerce_product_loop_end(); ?>

						</div>
						
						<?php if ( is_active_sidebar( 'shop-sidebar-1' ) ) : ?>
						   <div class="shop-sidebar widget-area">
						   <?php dynamic_sidebar( 'shop-sidebar-1' ); ?>
						   </div>
					    <?php endif; ?>
						<!-- /shop-sidebar  -->    
							
						  
						
						<!-- /shop-main  -->    
						<div class="clearfix"></div>
						
						<?php
							/**
							 * woocommerce_after_shop_loop hook
							 *
							 * @hooked woocommerce_pagination - 10
							 */
							do_action( 'woocommerce_after_shop_loop' );
						?>
					</div>


				<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
					
					<div class="container">
						<?php wc_get_template( 'loop/no-products-found.php' ); ?>
					</div>

				<?php endif; ?>

			
			<div class="container">
				<hr/>
				<a class="back-to-top" href="#"></a>
				<div class="clearfix"></div>
			</div>

		
		</div>

	</div>
</div>
				
		
	

<?php get_footer( 'shop' ); ?>



