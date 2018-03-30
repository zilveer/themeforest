<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); 



$sidebar_position_mobile = get_option('sense_settings_sidebar_mobile');
$settings_category_pos = get_option('sense_settings_category_pos');
?>

	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>
	
	
	
	
	 <?php 
	if( $sidebar_position_mobile == 'top' && get_option('sense_sidebar_cat') != 'none'  ) { ?>	
	<!-- Sidebar -->
	<?php if( get_option('sense_sidebar_cat') == 'left' ) { ?>
	
	<aside class="sidebar col-lg-3 col-md-3 col-sm-3">
	<?php } 
	if( get_option('sense_sidebar_cat') == 'right' ) { ?>
	<aside class="sidebar right-sidebar col-lg-3 col-md-3 col-sm-3">
	<?php } ?>

	<?php dynamic_sidebar( 'Shop Category Sidebar' ); ?>
	
	
	</aside>
	<!-- /Sidebar -->
<?php } ?>	
	
	
	
	
	
	<?php if( get_option('sense_sidebar_cat') == 'left' ) { ?>
	<section class="main-content s-left col-lg-9 col-md-9 col-sm-9">
	<?php }
	if( get_option('sense_sidebar_cat') == 'right' ) { ?>
	<section class="main-content col-lg-9 col-md-9 col-sm-9">
	<?php } ?>
	
	<?php if( get_option('sense_sidebar_cat') == 'none' ) { ?>
	<section class="main-content col-lg-12 col-md-12 col-sm-12">
	<?php } ?>
	
	
	    <div class="row">
		
		
		
		
		
		
		 <?php 
	if( $settings_category_pos != 'bottom' ) { ?>
		
			<!-- Heading -->
			<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) {	
			?>
			<div class="col-lg-12 col-md-12 col-sm-12">
				
				<div class="carousel-heading">
					<h4><?php woocommerce_page_title(); ?></h4>
				</div>
				
				<?php if ( is_tax() ) { 
				global $wp_query;
				//thumbnail category
				$cat = $wp_query->get_queried_object();
				$thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
				$image = wp_get_attachment_url( $thumbnail_id );
				
				 ?>
				    <?php	if (get_option('sense_thumb_cat') != 'hide') 
					{
					?>
					<div class="categories-heading">
					
							<?php echo wp_get_attachment_image( $thumbnail_id, 'prod-archive'); ?>
						
						<?php do_action( 'woocommerce_archive_description' ); ?>
					</div>
					<?php } ?>
					
				<?php } ?>
				
			</div>
			<?php } ?>
			<!-- /Heading -->
		
	<?php } ?>
		
		
		
		
			<?php if ( is_tax() ) : ?>
			<div class="col-lg-12 col-md-12 col-sm-12">	
                <div class="row subcategories">
				<?php woocommerce_product_subcategories(); ?>
			    </div>		
			</div>
			<?php elseif ( ! empty( $shop_page ) && is_object( $shop_page ) ) : ?>
			<?php do_action( 'woocommerce_product_archive_description', $shop_page ); ?>
			<?php endif; ?>
			
		</div>	
		<!-- end row -->
		
		
		
				
		<div class="row">
		
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="category-heading">
					
				
				<?php woocommerce_catalog_ordering(); ?>
	
					<div class="category-buttons">
						<a href="#" id="grid" title="<?php _e('Grid', 'homeshop'); ?>"><i class="icons icon-th-3"></i></a>
						<a href="#" id="list" title="<?php _e('List', MAD_BASE_TEXTDOMAIN); ?>"><i class="icons icon-th-list-4"></i></a>
					</div>
				</div>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-6">
				<div class="category-results">
					<?php woocommerce_result_count(); ?>
				</div>
			</div>
		
			<div class="col-lg-6 col-md-6 col-sm-6">
				<?php woocommerce_pagination(); ?>
			</div>

		
		</div>
		
		
		
		<?php if ( have_posts() ) : ?>

		
		<div class="row"> 
		<?php
				/**
				 * woocommerce_before_shop_loop hook
				 *
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				 
				remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
				remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
				do_action( 'woocommerce_before_shop_loop' );
		?>

		<?php woocommerce_product_loop_start(); ?>

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
				 remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
				do_action( 'woocommerce_after_shop_loop' );
		?>
		
		</div>
		
		
		
		<div class="row">

			<div class="col-lg-6 col-md-6 col-sm-6">
				<div class="category-results">
					<?php woocommerce_result_count(); ?>
				</div>
			</div>
		
			<div class="col-lg-6 col-md-6 col-sm-6">
				<?php woocommerce_pagination(); ?>
			</div>

		
		</div>
		
		
		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>

	
		
	
	

	
	
	
	
	 <?php 
	if( $settings_category_pos == 'bottom' ) { ?>
	
	 <div class="row">
			<!-- Heading -->
			<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) {	
			?>
			<div class="col-lg-12 col-md-12 col-sm-12">
				
				<div class="carousel-heading">
					<h4><?php woocommerce_page_title(); ?></h4>
				</div>
				
				<?php if ( is_tax() ) { 
				global $wp_query;
				//thumbnail category
				$cat = $wp_query->get_queried_object();
				$thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
				$image = wp_get_attachment_url( $thumbnail_id );
				
				 ?>
				    <?php	if (get_option('sense_thumb_cat') != 'hide') 
					{
					?>
					<div class="categories-heading">
					
							<?php echo wp_get_attachment_image( $thumbnail_id, 'prod-archive'); ?>
						
						<?php do_action( 'woocommerce_archive_description' ); ?>
					</div>
					<?php } ?>
					
				<?php } ?>
				
			</div>
			<?php } ?>
			<!-- /Heading -->

			
		</div>	
		<!-- end row -->
	<?php } ?>
	
	
	
	
	
	
	
	
	</section>
	
	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>
	
	
	
	
	 <?php 
	if( $sidebar_position_mobile != 'top'  && get_option('sense_sidebar_cat') != 'none'  ) { ?>
	<!-- Sidebar -->
	<?php if( get_option('sense_sidebar_cat') == 'left' ) { ?>
	
	<aside class="sidebar col-lg-3 col-md-3 col-sm-3">
	<?php } 
	if( get_option('sense_sidebar_cat') == 'right' ) { ?>
	<aside class="sidebar right-sidebar col-lg-3 col-md-3 col-sm-3">
	<?php } ?>

	<?php dynamic_sidebar( 'Shop Category Sidebar' ); ?>
	
	
	</aside>
	<!-- /Sidebar -->
	
	<?php } ?>
   
	
	
	
	
<?php get_footer( 'shop' ); ?>