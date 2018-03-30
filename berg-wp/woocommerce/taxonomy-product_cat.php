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
<div id="mobile-added-to-cart" style="opacity: 0; display: none; z-index:999;  position: fixed; left: 0; bottom: 0; right: 0; color: #fff; text-align: center; padding: 15px 30px; width: 100%; background: rgba(0,0,0,0.9);"><h4><?php echo __('Product added to cart', 'BERG'); ?></h4></div>
<?php if($shopLayout == 'chessboard') : ?>
<section id="<?php if(YSettings::g('woocommerce_shop_display_images', 1) == 1) echo 'menu'; else echo 'second-menu'; ?>" class="section-scroll main-section menu shop">
	<?php include THEME_INCLUDES . '/woocommerce_menu.php'; ?>
	<div class="container-fluid menu-content mixitup three_columns <?php //echo $columns_count ;?> <?php if(YSettings::g('woocommerce_shop_display_images', 1) != 1) echo 'no-images';?>">
<?php

$args = array(
	'taxonomy'     => 'product_cat',
	'show_count'   => 0,
	'pad_counts'   => 0,
	'hierarchical' => 1,
	'title_li'     => '',
	'hide_empty'   => 1
);

$all_categories = get_categories($args);
foreach ($all_categories as $cat) :
    if ($cat->category_parent == 0) : ?>
		<div class="mix category-<?php echo $cat->term_id;?>" data-myorder="<?php echo $cat->term_id;?>">
			<div class="row">

				<div class="col-xs-12 menu-category sticky-header sticky-header first-header fixed visible">
					<h2><?php echo $cat->name; ?></h2>
				</div>
			</div>

			<div class="row">
				<?php

				$args = array( 'post_type' => 'product', 'posts_per_page' => -1, 'product_cat' => $cat->slug, 'orderby'=>$orderby_new, 'order'=>$order_new);
				$loop = new WP_Query( $args );
				
				while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
				<div class="menu-item">
					<a href="<?php echo get_permalink( $loop->post->ID ) ?>" <?php if(YSettings::g('woocommerce_shop_display_images', 1) != 1) echo 'class="hidden"';?> >
						<?php if ( ! $product->is_in_stock() ) : ?>
							<span class="onsale out-of-stock-button hidden-xs hidden-sm"><span><?php echo apply_filters( 'out_of_stock_add_to_cart_text', __( 'Out of stock', 'woocommerce' ) ); ?></span></span>
						<?php else :?>
						<?php if ( $product->is_on_sale() ) : ?>
							<span class="onsale on-sale-button hidden-xs hidden-sm"><span><?php echo apply_filters( 'sale_add_to_cart_text', __( 'Sale!', 'woocommerce' ) ); ?></span></span>
						<?php endif;?>
						<?php endif;?>
						<figure>
							<?php
							if (has_post_thumbnail($loop->post->ID)) {
								$image_title = esc_attr( get_the_title( get_post_thumbnail_id($loop->post->ID) ) );
								$image_link  = wp_get_attachment_image_src( get_post_thumbnail_id($loop->post->ID), 'menu_thumb' );
								//$image       = get_the_post_thumbnail( $loop->post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_thumbnail' ), array('title' => $image_title) );
								echo '<img data-src="'.$image_link[0].'" src="'.THEME_DIR_URI.'/img/placeholder.png" alt="" />';
							} else {
								echo '<img src="'.THEME_DIR_URI.'/img/placeholder.png" alt="" />';
							}
							?>
							<div class="actions"><i class="icon-magnifier-add"></i></div>
						</figure>
					</a>
							<!-- <span style="position: absolute; top: 0; width: 100%; height: auto; display: block; background: rgba(0,0,0,0.5); color: #fff; z-index: 9; padding: 15px; font-size: 14px; ">
								
								<?php //echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?>
							</span> -->

					<div class="item-description">
						<div class="">
							<div class="">
								<?php if ( ! $product->is_in_stock() ) : ?>
									<span class="onsale out-of-stock-button"><span><?php echo apply_filters( 'out_of_stock_add_to_cart_text', __( 'Out of stock', 'woocommerce' ) ); ?></span></span>
								<?php else :?>
								<?php if ( $product->is_on_sale() ) : ?>
									<span class="onsale on-sale-button"><span><?php echo apply_filters( 'sale_add_to_cart_text', __( 'Sale!', 'woocommerce' ) ); ?></span></span>
								<?php endif;?>
								<?php endif;?>								
								<?php if (get_option('woocommerce_enable_review_rating') !== 'no' && YSettings::g('woocommerce_show_rating_on_archive', 1) == 1): ?>
								<?php
								$count   = $product->get_rating_count();
								$average = $product->get_average_rating();

								if ($count > 0) : ?>
								<div class="rating">
									<span title="<?php printf( __( 'Rated %s out of 5', 'woocommerce' ), $average ); ?>"><span style="width:<?php echo ( ( $average / 5 ) * 100 ); ?>%"></span></span>
								</div>								
								<?php endif; ?>
								<?php endif; ?>
								<h6><a href="<?php echo get_permalink( $loop->post->ID ) ?>"><?php the_title(); ?></a></h6>
								<div class="price">
									<?php echo $product->get_price_html(); ?>
								</div>
								<?php
								if ( ! $product->is_in_stock() ) : ?>
									
								<?php else :
										remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_price');
									add_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_add_to_cart', 15);
									do_action( 'woocommerce_after_shop_loop_item_title' );
								endif; ?>
								<!-- <div class="shop-button"><a href="#" class="btn btn-default btn-sm"><?php _e('buy now', 'woocommerce'); ?></a></div> -->
							</div>
						</div>
					</div>
				</div>

			<?php endwhile; ?>
			<?php wp_reset_query(); ?>
			</div>
		</div>
<?php endif; ?>
<?php endforeach; ?>
		

	</div>
	
</section>

<?php //do_action( 'woocommerce_sidebar' ); ?>

<?php else : ?>
<?php $category = get_queried_object();
$catName = $category->name;

;?>

<section id="menu-list-new" class="section-scroll main-section menu woocommerce products products-archive product-archive-categories <?php echo $sidebar_class ;?>">
	<?php include THEME_INCLUDES . '/woocommerce_menu.php'; ?>
	<div class="<?php echo $container ;?> menu-content">
	<?php if ($page_sidebar_pos == 'left' || $page_sidebar_pos == 'right' || ($page_sidebar_pos == 'none' && YSettings::g('woocommerce_type_cat') == 'boxed' ) ) : ?>
		<div class="row">
			<div class="<?php echo $posts_size_content ;?> items-content">
				<div class="">
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



<?php endif; ?>
<?php
	berg_getFooter();
	get_template_part('footer'); 
?>
<?php //get_footer( 'shop' ); ?>
