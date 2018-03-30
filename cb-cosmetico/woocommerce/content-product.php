<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

$woo_cols=get_option('cb5_woo_cols');

$cb_woo_per_page_value=get_option('cb5_woo_per_page');
if(!isset($woocommerce_loop['columns']))$woocommerce_loop['columns']='3';
if($woocommerce_loop['columns']!='1'&&$woocommerce_loop['columns']!='2'&&$woocommerce_loop['columns']!='3'&&$woocommerce_loop['columns']!='4') 
		$woocommerce_loop['columns'] = $woo_cols;

$woo_per_page='return '.$cb_woo_per_page_value.';';
add_filter( 'loop_shop_per_page', create_function( '$cols', $woo_per_page ), 40 );

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', $woo_cols );

// Ensure visibility
if ( ! $product->is_visible() )
return;


$classes[]=' col'.$woocommerce_loop['columns'];

$classes[]=' product ';
require(get_template_directory().'/inc/cb-page-options.php');
?>
<li <?php post_class( $classes ); ?>>
	<div class="product_in fade_woo">

		<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

		<?php
		/**
		 * woocommerce_before_shop_loop_item_title hook
		 *
		 * @hooked woocommerce_show_product_loop_sale_flash - 10
		 * @hooked woocommerce_template_loop_product_thumbnail - 10
		 */
		do_action( 'woocommerce_before_shop_loop_item_title' );
		?>



			<h3>
			<?php the_title(); ?>
			</h3>
			</a>
			<div class="product_desc">
			<?php
			echo $prod_slogan;
			echo '<div class="desci">'.strip_cn(get_the_content(), 140).'</div>';?>
			</div> <?php
			/**
			 * woocommerce_after_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_template_loop_price - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_open', 5 );
			?> 
		<div class="cart_container">
			<div class="fade_cart">
			<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
			</div>
			<div class="cart_placeholder">
			<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
			</div>
		</div>
		<div class="addi">
			<a class="bttn alt" href="<?php echo get_permalink();?>"><?php _e('Details','cb-cosmetico');?>
			</a>
			<?php if(in_array('yith-woocommerce-wishlist/init.php',apply_filters('active_plugins',get_option('active_plugins')))) echo do_shortcode('[yith_wcwl_add_to_wishlist]');?>
		</div>

	</div>
	<div class="rbor"></div>
	<div class="cl_hide">
		<div class="cl"></div>
	</div>
</li>
