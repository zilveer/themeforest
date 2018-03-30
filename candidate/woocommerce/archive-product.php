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

get_header( 'shop' ); 

$sidebar_position = '';
//$sidebar_position = get_option('sense_sidebar_cat');

global $wp_query;
$term = $wp_query->get_queried_object();

if( isset($term->term_id) ) {
$sidebar_position = get_tax_meta($term->term_id,'candidate_select_field_id');
}

if($sidebar_position == '') {

	$sidebar_position = get_option('sense_settings_sidebar_shop');

	if($sidebar_position == '') {
	$sidebar_position = 'right';
	}
}



$sidebar_class = 'col-lg-12 col-md-12 col-sm-12';

	if( $sidebar_position == 'left' ) { 
	$sidebar_class = 'col-lg-9 col-md-9 col-sm-8 col-lg-push-3 col-md-push-3 col-sm-push-4';
	 }
	if( $sidebar_position == 'right' ) { 
	$sidebar_class = 'col-lg-9 col-md-9 col-sm-8';
	 }
	if( $sidebar_position == 'full' ) {
	$sidebar_class = 'col-lg-12 col-md-12 col-sm-12';
	 } 
?>

<section id="content">	
			
			<!-- Page Heading -->
			<section class="section page-heading animate-onscroll">
				
				<div class="row">
					<div class="col-lg-9 col-md-9 col-sm-9">
						<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
						<h1><?php woocommerce_page_title(); ?></h1>
						<?php endif; ?>
						<?php woocommerce_breadcrumb(); ?>
						
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3 align-right">
					
						<?php include('shop/shopping-cart.php'); ?>
						
					</div>
				</div>
				
			</section>
			<!-- Page Heading -->


			

			<!-- Section -->
			<section class="section full-width-bg gray-bg">
				
				<div class="row">
				
					<div class="<?php echo $sidebar_class; ?>">
						
						<div class="shop-header animate-onscroll">
						
							<span class="results"><?php woocommerce_result_count(); ?></span>
							
							<div class="filter-filtering">

								<ul class="filter-dropdown">
									<li><span>Default Sorting</span>
										<ul>
											<li class="sort" data-sort="dateorder:asc">Default Sorting</li>
											<li class="sort" data-sort="popularorder:desc">Sort by popularity</li>
											<li class="sort" data-sort="avgratingorder:desc">Sort by average rating</li>
											<li class="sort" data-sort="dateorder:desc">Sort by newness</li>
											<li class="sort" data-sort="priceorder:asc">Sorty by price: low to high</li>
											<li class="sort" data-sort="priceorder:desc">Sort by price: high to low</li>
										</ul>
									</li>
								</ul>
							
							</div>
							
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
						//do_action( 'woocommerce_before_shop_loop' );
					?>
					
					
					<div class="row shop-items">
					<?php //woocommerce_product_loop_start(); ?>

					<?php woocommerce_product_subcategories(); ?>

					<?php while ( have_posts() ) : the_post(); ?>

						<?php wc_get_template_part( 'content', 'product' ); ?>

					<?php endwhile; // end of the loop. ?>

					<?php //woocommerce_product_loop_end(); ?>
					</div>
					

					
				
			
						<div class="animate-onscroll">
						
							<div class="divider"></div>
							
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
					
					<div class="row shop-items">
					<?php wc_get_template( 'loop/no-products-found.php' ); ?>
					</div>
					
				<?php endif; ?>
		
		
						
						
						
					</div>
		
		
		<!-- Sidebar -->
		<?php 
		if( $sidebar_position != 'full' ) {
			if( $sidebar_position == 'left' ) { ?>
			<div class="col-lg-3 col-md-3 col-sm-4 col-lg-pull-9 col-md-pull-9 col-sm-pull-8 sidebar  animate-onscroll">
			<?php } if( $sidebar_position == 'right' ) { ?>
			<div class="col-lg-3 col-md-3 col-sm-4 sidebar  animate-onscroll">
			<?php } ?>

			<?php dynamic_sidebar( 'shop' ); ?>

			</div>
		<?php } ?>
		
		
		
		</div>
	
		</section>
		<!-- /Section -->
		
</section>

		
		
	

<?php get_footer( 'shop' ); ?>