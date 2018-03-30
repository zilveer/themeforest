<?php
/**
* The Template for displaying product archives, including the main shop page which is a post type archive.
*
* Override this template by copying it to yourtheme/woocommerce/archive-product.php
*
* @author WooThemes
* @package WooCommerce/Templates
* @version 2.0.0
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header( 'shop' );
list( $has_sidebar, $sidebar_position, $sidebar_area ) = setup_dynamic_sidebar( get_option( 'woocommerce_shop_page_id' ) );
?>
<?php
/**
* woocommerce_before_main_content hook
*
* @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
* @hooked woocommerce_breadcrumb - 20
*/
do_action( 'woocommerce_before_main_content' );
?>


<?php 
if($has_sidebar){
	?>
	<div class="container">
	<div class="boxed">
	<?php
}
?>
		
		
<?php if(empty($hide_page_title)): ?>
<div class="page-title">
	<span class="heading-t"></span>
	<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
	<span class="heading-b"></span>
</div>	
<?php endif; ?>



<?php
		if ( $has_sidebar ) :
?>
			<div class="content__wrapper<?php if ( 'left' === $sidebar_position ) echo ' content--rev'; ?>">
				<article id="post-<?php the_ID(); ?>" <?php post_class('content__main single-post'); ?>>
<?php
		else:
?>
			<article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
<?php
		endif;
?>


<?php do_action( 'woocommerce_archive_description' ); ?>

<div class="woocontent">
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
</div>



<?php
/**
* woocommerce_after_main_content hook
*
* @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
*/
//do_action( 'woocommerce_after_main_content' );
?>

<?php
/**
* woocommerce_sidebar hook
*
* @hooked woocommerce_get_sidebar - 10
*/
//do_action( 'woocommerce_sidebar' );
?>

<?php
		if ( $has_sidebar ) :
?>
				</article>

				<aside id="sidebar" class="content__side widget-area widget-area--<?php echo esc_attr( $sidebar_area ); ?>">
<?php
			do_action('before_ironband_sidebar_dynamic_sidebar', 'page.php');

			dynamic_sidebar( $sidebar_area );

			do_action('after_ironband_sidebar_dynamic_sidebar', 'page.php');
?>
				</aside>
			</div>
<?php
		else:
?>
			</article>
<?php
		endif;
?>		


<?php 
if($has_sidebar){
	?>
	</div>
	</div>
	<?php
}
?>

<?php get_footer( 'shop' ); ?>