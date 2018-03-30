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

get_header( 'shop' ); 

$sidebar_id = get_meta_option('custom_sidebar', $post->ID);
$sidebar_position = get_meta_option('sidebar_position_meta_box', $post->ID);
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



		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

					</div>

		<!-- Sidebar -->
		<?php 
		if( $sidebar_position != 'full' ) {
			if( $sidebar_position == 'left' ) { ?>
			<div class="col-lg-3 col-md-3 col-sm-4 col-lg-pull-9 col-md-pull-9 col-sm-pull-8 sidebar  animate-onscroll">
			<?php } if( $sidebar_position == 'right' ) { ?>
			<div class="col-lg-3 col-md-3 col-sm-4 sidebar  animate-onscroll">
			<?php } ?>
			<?php candidat_mm_sidebar('blog',$sidebar_id);?>
			</div>
		<?php } ?>
		
		
		
		</div>
	
		</section>
		<!-- /Section -->
		
</section>

<?php get_footer( 'shop' ); ?>