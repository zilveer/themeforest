<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $unik_data;

$layout = $unik_data['shop_layout'];

get_header(); ?>



<div id="primary" class="content-area">
	<div id="inside">
		<?php if($unik_data['breadcrumb']==1 && !is_front_page()) : ?><div class="breadcrumb bg-block-1"><?php woocommerce_breadcrumb(); ?></div><?php endif; ?>
	
		<div class="site-content" >
			<div class="row">
				<?php if ( have_posts() ) : ?>
				<div id="post-content" class=" <?php if($layout=='left'){echo 'right col-lg-9';} elseif($layout=='nosidebar'){echo 'full col-lg-12' ;} else{echo 'col-lg-9';} ?>">
					<div class="bg-block-1">				
						<div class="page-title">
							<h1 class="entry-title"><?php echo $unik_data['shop_title']; ?></h1>
						</div>
			

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

			<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

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

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>

					</div><!--blog bloc -->
				</div><!--Left column -->
				
				<?php if($layout!=='nosidebar'): ?>				
				<div class="col-lg-3 <?php echo $layout; ?> sidebar">					
					<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('woocommerce-sidebar') ); ?>				
				</div>				
				<?php endif; ?><!--RIght column -->
				
			<?php endif; ?>
			</div><!-- row -->
		</div><!-- site-content -->
	</div><!-- #inside -->
</div><!-- #primary -->	
<?php get_footer(); ?>