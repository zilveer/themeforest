<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     19.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header( 'shop' );

$shopLayout = YSettings::g('woocommerce_shop_layout', 'chessboard'); // chessboard or standard

$orderby_new = 'menu_order title';
$order_temp = WC()->query->get_catalog_ordering_args();
$order_new = $order_temp['order'];
// $columns_count = YSettings::g('berg_food_menu_squares_columns');
$page_sidebar_pos = YSettings::g('berg_shop_sidebar_pos');
if ($page_sidebar_pos == 'left' ) {
	$sidebar_class = 'shop-sidebar';
	$container = 'container';
	$sidebar = 'col-md-4 col-md-pull-8 widget-sidebar sidebar-left';
	$posts_size_content = 'col-md-8 col-md-push-4';
} elseif ($page_sidebar_pos == 'right' ) {
	$sidebar_class = 'shop-sidebar';
	$container = 'container';
	$sidebar = 'col-md-4 widget-sidebar sidebar-right';
	$posts_size_content = 'col-md-8';
} else {
	$sidebar = $sidebar_class = '';
	if(YSettings::g('woocommerce_type_cat') == 'full') {
		$container = 'container-fluid';
		$posts_size_content =  '';
	} else {
		$container = 'container';
		// $posts_size_content =  '';
		$posts_size_content = 'col-md-12';
	}
	
}
?>
<div id="mobile-added-to-cart" style="opacity: 0; display: none; z-index:999;  position: fixed; left: 0; bottom: 0; right: 0; color: #fff; text-align: center; padding: 15px 30px; width: 100%; background: rgba(0,0,0,0.9);"><h4><?php echo __('Product added to cart', 'BERG');?></h4></div>

<?php $category = get_queried_object();
$catName = $category->name;

;?>

<section id="menu-list-new" class="section-scroll main-section menu woocommerce products products-archive product-archive-categories <?php echo $sidebar_class ;?>">
	<?php include THEME_INCLUDES . '/woocommerce_menu.php'; ?>
	<div class="<?php echo $container ;?> menu-content mixitup">
	<?php if ($page_sidebar_pos == 'left' || $page_sidebar_pos == 'right' || ($page_sidebar_pos == 'none' && YSettings::g('woocommerce_type_cat') == 'boxed' ) ) : ?>
		<div class="row">
			<div class="<?php echo $posts_size_content ;?> items-content">
				<div class="mix">
					<div class="boxed-section-header"><h2><?php echo $catName ?></h2></div>
	<?php endif; ?>
<?php if ( have_posts() ) : ?>
	<?php
		/**
		 * woocommerce_before_shop_loop hook
		 *
		 * @hooked woocommerce_result_count - 20
		 * @hooked woocommerce_catalog_ordering - 30
		 */
		// if ($redux['woo_show_sort'] == '1') {
			do_action( 'woocommerce_before_shop_loop' );
		// }
	?>
	<?php woocommerce_product_loop_start(); ?>
		<?php woocommerce_product_subcategories(); ?>

		<?php while ( have_posts() ) : the_post(); ?>
			<?php wc_get_template_part( 'content', 'product_cat' ); ?>
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

	<?php if ($page_sidebar_pos == 'left' || $page_sidebar_pos == 'right' ) : ?>
				</div>
			</div>
			<div class="<?php echo $sidebar ;?>"><?php do_action( 'woocommerce_sidebar' ); ?></div>
		</div>
		<?php endif; ?>
	</div>

	<!-- </div> -->
	<!-- <div class="col-md-3 widget-sidebar sidebar-right">sidebar</div> -->

</section>



<?php //endif; ?>
<?php
	berg_getFooter();
	get_template_part('footer'); 
?>
<?php //get_footer( 'shop' ); ?>
