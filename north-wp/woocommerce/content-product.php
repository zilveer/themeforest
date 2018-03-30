<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$shop_product_listing = ot_get_option('shop_product_listing', 'style1');
$shop_product_hover = ot_get_option('shop_product_hover', 'on');

$columns = 'medium-4 large-3 xlarge-2';
$vars = $wp_query->query_vars;
$columns = array_key_exists('thb_columns', $vars) ? $vars['thb_columns'] : $columns;

//woocommerce_before_shop_loop_item
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );

//woocommerce_after_shop_loop_item
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

//woocommerce_after_shop_loop_item_title
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

add_action( 'woocommerce_after_shop_loop_item_title_loop_price', 'woocommerce_template_loop_price', 10 );
add_action( 'woocommerce_after_shop_loop_item_title_loop_rating', 'woocommerce_template_loop_rating', 5 );
?>
<?php
	$featured = wp_get_attachment_url( get_post_thumbnail_id(), 'shop_catalog' );
	$attachment_ids = $product->get_gallery_attachment_ids();
	if ( $attachment_ids ) {
		$loop = 0;
		foreach ( $attachment_ids as $attachment_id ) {
			$image_link = wp_get_attachment_url( $attachment_id );
			if (!$image_link) continue;
			$loop++;
			$thumbnail_second = wp_get_attachment_image_src($attachment_id, 'shop_catalog');
			if ($image_link !== $featured) {
				if ($loop == 1) break;
			}
		}
	}
	$style = $class = '';
	if (isset($thumbnail_second[0])) {            
		$style = 'background-image:url(' . $thumbnail_second[0] . ')';
		$class = 'thb_hover';     
	}
?>
<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" <?php post_class("post product item small-6 ".$columns ." columns ". $shop_product_listing); ?>>
	<?php
		/**
		 * woocommerce_before_shop_loop_item hook.
		 *
		 * @hooked woocommerce_template_loop_product_link_open - 10
		 */
		do_action( 'woocommerce_before_shop_loop_item' );
	?>
	<figure class="product_thumbnail <?php echo esc_attr($class); ?>">	
		<?php do_action( 'thb_product_badge'); ?>
		<?php if ($shop_product_listing === 'style1') { thb_wishlist_button(); } ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php if ($shop_product_hover === 'on') { ?>
			<span class="product_thumbnail_hover" style="<?php echo esc_attr($style); ?>"></span>
			<?php } ?>
			<?php
				if ( has_post_thumbnail( $post->ID ) ) { 	
					echo  get_the_post_thumbnail( $post->ID, 'shop_catalog');
				}else{
					 echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', wc_placeholder_img_src() ), $post->ID );
				}
			?>
		</a>
	</figure><!--.product_thumbnail_wrapper-->
	<h3>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
		<?php if ($shop_product_listing === 'style2') { thb_wishlist_button(); } ?>
	</h3>
	<div class="product_after_title">
		<div class="product_after_shop_loop_price">
			<?php do_action( 'woocommerce_after_shop_loop_item_title_loop_price' ); ?>
		</div>

		<div class="product_after_shop_loop_buttons">
			<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
		</div>
	</div>
</div><!-- end product -->