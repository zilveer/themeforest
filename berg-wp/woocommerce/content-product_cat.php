<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     19.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';

$classes[] .= 'menu-item';


// global $items_links; 

// $icon = YSettings::g('icon_food');
// $icon_output = '<span class="icon-food"></span>';
// if(isset($icon)) {
// 	$attachments = array_filter( explode( ',', $icon ) );
// 	if ( $attachments ) {
// 		$icon_output = '';
// 		foreach ( $attachments as $attachment_id ) {
// 			$icon_output .= '<span class="icon-food">'.wp_get_attachment_image( $attachment_id, 'thumbnail' ).'</span>';

// 		}
// 	}
// }

// $price = apply_filters('the_content', get_post_meta(get_the_id(),'menu_details', true ));
// // $icon = '<span class="icon-food">'. get_post_meta(get_the_id(),'icon_food', true ) .'</span>';
// $badge = apply_filters('the_content', get_post_meta(get_the_id(),'menu_badge', true ));

?>
<li <?php post_class( $classes ); ?>>

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
	<?php
	// print_r(wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'menu_thumb' ));
    // $args = array( 'post_type' => 'product', 'posts_per_page' => -1, 'product_cat' => $cat->slug );
    // $loop = new WP_Query( $args );

	if(YSettings::g('woocommerce_shop_display_images', 1) == 1) : ?>
		<a href="<?php echo esc_url( get_permalink()) ?>" class="shop-list-image">										
			<figure>
				<?php
				if (has_post_thumbnail()) {

					$image_link  = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'menu_thumb' );
					//$image       = get_the_post_thumbnail( $loop->post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_thumbnail' ), array('title' => $image_title) );
					echo '<img data-src="'.$image_link[0].'" src="'.THEME_DIR_URI.'/img/placeholder.png" alt="" />';
				} else {
					echo '<img src="'.THEME_DIR_URI.'/img/placeholder.png" alt="" />';
				}
				?>
			</figure>
		</a>
	<?php endif; ?>
	<div class="item-description <?php if(YSettings::g('woocommerce_shop_display_images', 1) == 1) echo 'shop-list-description';?> <?php if(YSettings::g('woocommerce_shop_display_images') == 0) echo 'shop-list-no-img';?>">
		<?php if ( ! $product->is_in_stock() ) : ?>
			<span class="onsale out-of-stock-button static-position"><span><?php echo apply_filters( 'out_of_stock_add_to_cart_text', __( 'Out of stock', 'woocommerce' ) ); ?></span></span>
		<?php else :?>
			<?php if ( $product->is_on_sale() ) : ?>
				<span class="onsale on-sale-button static-position"><span><?php echo apply_filters( 'sale_add_to_cart_text', __( 'Sale!', 'woocommerce' ) ); ?></span></span>
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
		<h5 class="entry-title"><a href="<?php echo esc_url( get_permalink()) ?>" class="item-title"><?php the_title(); ?><span class="icon-food"></span></a>
			<span class="dots"></span>
			<div class="menu-details">
				<p class="berg-price price item-price">
					<?php echo $product->get_price_html(); ?>
				</p>			
			</div>
		</h5>
		<?php if(YSettings::g('woocommerce_display_desc') == 1 ) {
			if(YSettings::g('woocommerce_type_desc') == 'short_desc' ) {
				echo '<p>';
					the_excerpt();
				echo '</p>';
			} else {
				echo '<p>';
					the_content();
				echo '</p>';
			}
		} ;?>
		
		<?php
		//if ( $product->is_in_stock() ) : ?>
			
		<?php
		// 	echo apply_filters('woocommerce_loop_add_to_cart_link',
		// 		sprintf( '<div class="shop-button shop-list-button add-to-cart-button-outer"><div class="add-to-cart-button-inner"><div class=""><a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="add-to-cart-button button %s product_type_%s">%s</a></div></div></div>',
		// 		esc_url( $product->add_to_cart_url() ),
		// 		esc_attr( $product->id ),
		// 		esc_attr( $product->get_sku() ),
		// 		$product->is_purchasable() ? 'add_to_cart_button' : '',
		// 		esc_attr( $product->product_type ),
		// 		esc_html( $product->add_to_cart_text() )
		// 		),
		// 	$product);
		// endif;
		?>

	</div>


	<!-- <div class="item-description"> -->
		<?php //if ($items_links == 0): ?>
		<?php //the_title( '<h5 class="entry-title">'.$badge.'<span class="item-title">', ''.$icon_output.'</span><span class="dots"></span><div class="menu-details">'.$price.'</div></h5>' ); ?>
		<?php //else: ?>
		<?php //the_title( sprintf( '<h5 class="entry-title">'.$badge.'<a href="%s" rel="bookmark" class="item-title">', esc_url( get_permalink() //) ), ''.$icon_output.'</a><span class="dots"></span><div class="menu-details">'.$price.'</div></h5>' ); ?>
		<?php //endif; ?>
		<?php //if (YSettings::g('food_menu_show_items_full_text', '0') == '1'): ?>
		<?php //the_content(); ?>
		<?php //else: ?>
		<?php //the_excerpt(); ?>
		<?php //endif; ?>
	<!-- 	<?php //if (YSettings::g('food_menu_show_items_full_text', '0') == '1'): ?>
		<?php the_content(); ?>
		<?php //else: ?> -->
		<?php //the_excerpt(); ?>
		<!-- <?php //endif; ?> -->
	<!-- </div> -->

	<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>

</li>
