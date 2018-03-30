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

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
	
	<?php get_header('shop'); ?>
	
	<?php do_action('woocommerce_before_main_content'); ?>

	<?php //Display Page Header
		global $wp_query;
		$postid = $wp_query->post->ID;
		echo page_header( get_post_meta($postid, 'qns_page_header_image', true) );
		wp_reset_query();
	?>

	<!-- BEGIN .section -->
	<div class="section">

		<ul class="columns-content page-content clearfix">

			<!-- BEGIN .col-main -->
			<li class="<?php echo sidebar_position('primary-content'); ?>">

				<h2 class="page-title">

					<?php if ( is_search() ) : ?>
						
						<?php printf( __( 'Search Results: &ldquo;%s&rdquo;', 'qns' ), get_search_query() );
						if ( get_query_var( 'paged' ) )
							printf( __( '&nbsp;&ndash; Page %s', 'qns' ), get_query_var( 'paged' ) ); ?>
						
					<?php elseif ( is_tax() ) : ?>
						<?php echo single_term_title( "", false ); ?>
						
					<?php else : ?>
						<?php
						$shop_page = get_post( woocommerce_get_page_id( 'shop' ) );
						echo apply_filters( 'the_title', ( $shop_page_title = get_option( 'woocommerce_shop_page_title' ) ) ? $shop_page_title : $shop_page->post_title );
						?>
						
					<?php endif; ?>
					
				</h2>

				<?php do_action( 'woocommerce_archive_description' ); ?>

				<?php if ( is_tax() ) : ?>
					<?php do_action( 'woocommerce_taxonomy_archive_description' ); ?>
				<?php elseif ( ! empty( $shop_page ) && is_object( $shop_page ) ) : ?>
					<?php do_action( 'woocommerce_product_archive_description', $shop_page ); ?>
				<?php endif; ?>

				<?php if ( have_posts() ) : ?>

					<?php do_action('woocommerce_before_shop_loop'); ?>

					<ul class="columns-3 clearfix product-list">

						<?php woocommerce_product_subcategories(); ?>

						<?php while ( have_posts() ) : the_post(); ?>

							<?php woocommerce_get_template_part( 'content', 'product' ); ?>

						<?php endwhile; // end of the loop. ?>

					</ul>
					
					<?php if (function_exists('woocommerce_catalog_ordering')) woocommerce_catalog_ordering(); ?>
					<?php do_action('woocommerce_after_shop_loop'); ?>

				<?php else : ?>

					<?php if ( ! woocommerce_product_subcategories( array( 'before' => '<ul class="products">', 'after' => '</ul>' ) ) ) : ?>

						<p><?php _e( 'No products found which match your selection.', 'qns' ); ?></p>

					<?php endif; ?>

				<?php endif; ?>

				<div class="clear"></div>

		<?php
			/**
			 * woocommerce_pagination hook
			 *
			 * @hooked woocommerce_pagination - 10
			 * @hooked woocommerce_catalog_ordering - 20
			 */
			do_action( 'woocommerce_pagination' );
		?>
		
		
			<!-- END .col-main -->
			</li>
				
			<?php get_sidebar(); ?>
		
		</ul>
		
	<!-- END .section -->
	</div>
		
	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action('woocommerce_after_main_content');
	?>

	<?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action('woocommerce_sidebar');
	?>

<?php get_footer('shop'); ?>