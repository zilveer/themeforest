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

get_header( 'shop' ); ?>

			
			<div id="page-title">
				<div class="width-container paged-title">
					<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
					</div>
				<div id="page-title-divider"></div>
			</div><!-- #page-title -->
			<div class="clearfix"></div>
			<?php $page_for_posts = get_option('page_for_posts'); ?>
			<?php if(has_post_thumbnail($page_for_posts)): ?>
				<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($page_for_posts), 'progression-page-title'); ?>
				<script type='text/javascript'>
			
				jQuery(document).ready(function($) {  
				    $("#page-title").backstretch([
						"<?php echo $image[0]; ?>"
						<?php if( class_exists( 'kdMultipleFeaturedImages' ) ) {
							if( kd_mfi_get_featured_image_url( 'featured-image-2', 'page', 'progression-page-title', $thePostID ) != "" ) {
							    echo ',"', kd_mfi_get_featured_image_url( 'featured-image-2', 'page', 'progression-page-title', $thePostID ) , '"';
							}

							if( kd_mfi_get_featured_image_url( 'featured-image-3', 'page', 'progression-page-title', $thePostID ) != "" ) {
							    echo ',"', kd_mfi_get_featured_image_url( 'featured-image-3', 'page', 'progression-page-title', $thePostID ) , '"';
							}
						}
				 		?>
					],{
				            fade: 750,
				            duration: <?php echo of_get_option('slider_autoplay', 8000); ?>
				     });
				});
			
				</script>
			<?php endif; ?>
		
			<div id="main" class="site-main">
				<div class="width-container">
					
					<div id="container-sidebar"><!-- sidebar content container -->

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
	<div class="clearfix"></div>
	</div><!-- close #container-sidebar -->

	<?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action( 'woocommerce_sidebar' );
	?>

<?php get_footer( 'shop' ); ?>