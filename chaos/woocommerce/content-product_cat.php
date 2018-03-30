<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product_cat.php.
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
	exit;
}

global $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Increase loop count
$woocommerce_loop['loop']++;
?>
<div class="product-category product<?php
    if ( ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] == 0 || $woocommerce_loop['columns'] == 1 )
        echo ' first';
	if ( $woocommerce_loop['loop'] % $woocommerce_loop['columns'] == 0 )
		echo ' last';
	if($woocommerce_loop['loop'] % 2 == 0){
		echo ' even';
	} else {
		echo ' odd';
	}
	?>">

	<?php do_action( 'woocommerce_before_subcategory', $category ); ?>

	<div class="category-image">
	<?php
		/**
		 * woocommerce_before_subcategory_title hook
		 *
		 * @hooked woocommerce_subcategory_thumbnail - 10
		 */
		//do_action( 'woocommerce_before_subcategory_title', $category );

		$thumbnail_id           = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true  );
		if ( $thumbnail_id ) {
			$image = wp_get_attachment_url( $thumbnail_id );
		} else {
			$image = wc_placeholder_img_src();
		}
		if ( $image ) {
			// Prevent esc_url from breaking spaces in urls for image embeds
			// Ref: http://core.trac.wordpress.org/ticket/23605
			$image = str_replace( ' ', '%20', $image );

			echo '<img src="' . esc_url( $image ) . '" alt="' . esc_attr( $category->name ) . '" />';
		}
	?>
	</div>
	<div class="category-info">
		<label><?php echo esc_html($woocommerce_loop['loop']);?>.</label>
		<h1><?php echo $category->name; ?></h1>
		<div class="category-desc"><?php echo $category->description; ?></div>
		<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">
			<?php _e('Browse Category', 'roadthemes');?>
		</a>
	</div>
	<?php
		/**
		 * woocommerce_after_subcategory_title hook
		 */
		do_action( 'woocommerce_after_subcategory_title', $category );
	?>
	<?php do_action( 'woocommerce_after_subcategory', $category ); ?>

</div>
