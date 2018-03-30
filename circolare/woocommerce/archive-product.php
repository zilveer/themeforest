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

remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_result_count', 20 );
add_action( 'woocommerce_before_shop_loop' , 'woocommerce_result_count', 40 );

if(of_get_option('grid_view_mode', 'grid') == "list"){
	if (isset($_COOKIE['products_cookie']) && $_COOKIE['products_cookie'] == "grid")
		$product_view = "grid";
	else
		$product_view = "list";
} else {
	if (isset($_COOKIE['products_cookie']) && $_COOKIE['products_cookie'] == "list")
		$product_view = "list";
	else
		$product_view = "grid";
}

get_header('shop'); ?>
	
	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action('woocommerce_before_main_content');
	?>

		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
			<?php
			$hidetitle = "";
			if ( is_tax() || is_search() ) ;
			else {
				$shop_page_id = woocommerce_get_page_id( 'shop' );
				$bmeta = get_post_meta( $shop_page_id );
				if(isset($bmeta["hidetitle"][0]))
				$hidetitle = $bmeta["hidetitle"][0];
				
				if($hidetitle == "yes")
				$hidetitle = 'style="display: none;"';
				else
				$hidetitle = "";
			}
			?>
			<h1 class="page-title" <?php echo $hidetitle; ?>><?php woocommerce_page_title(); ?></h1>

		<?php endif; ?>

		<?php do_action( 'woocommerce_archive_description' ); ?>

		<?php if ( have_posts() ) : ?>

			<?php
				/**
				 * woocommerce_before_shop_loop hook
				 *
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */				
			?><div class="list-options">
				<div class="float-left">
					<img src="<?php echo THEME_DIR; ?>/images/icon_grid.png"><a id="switch-to-grid" class="regular<?php if($product_view == "grid") { ?> active-view<?php } ?>" href="#">View as grid</a>
					<img src="<?php echo THEME_DIR; ?>/images/icon_list.png"><a id="switch-to-list" class="regular<?php if($product_view == "list") { ?> active-view<?php } ?>" href="#">View as list</a>
				</div>
					
				<div class="float-right">
					<?php do_action( 'woocommerce_before_shop_loop' ); ?>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
			
			<div class="list-carousel responsive">
			<ul id="woo-product-items" class="products <?php echo $product_view ?>-view">
			<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php woocommerce_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>
			</ul>
			</div>
			
			<div class="clear"></div>
			
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