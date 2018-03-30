<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php //Display Page Header
	global $wp_query;
	$postid = $wp_query->post->ID;
	echo page_header( get_post_meta($postid, 'qns_page_header_image', true) );
	wp_reset_query();
?>

<!-- BEGIN .section -->
<div class="section">
	
	<?php do_action( 'woocommerce_before_single_product' ); ?>
	
	<div itemscope itemtype="http://schema.org/Product" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<ul class="columns-content page-content clearfix">
		
		<!-- BEGIN .col-main -->
		<li class="<?php echo sidebar_position('primary-content'); ?>">
	
			<h2 class="page-title"><?php the_title(); ?></h2>

			<ul class="columns-2 product-single-content clearfix">
				
				<li class="col2 clearfix">
					<?php do_action( 'woocommerce_before_single_product_summary' ); ?>
				</li>
				
				<li class="col2 clearfix">
					<div class="summary">
						<?php do_action( 'woocommerce_single_product_summary' ); ?>
					</div><!-- .summary -->
				</li>
			
			</ul>

			<?php do_action( 'woocommerce_after_single_product_summary' ); ?>
			<?php do_action( 'woocommerce_after_single_product' ); ?>

		<!-- END .col-main -->
		</li>
	
		<?php get_sidebar(); ?>

	</ul>
	
	</div><!-- #product-<?php the_ID(); ?> -->

<!-- END .section -->
</div>