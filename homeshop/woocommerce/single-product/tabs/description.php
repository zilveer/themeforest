<?php
/**
 * Description tab
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $post, $product;
$cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
$tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) );
$heading = esc_html( apply_filters( 'woocommerce_product_description_heading', __( 'Product Description', 'homeshop' ) ) );
?>

<h2><?php echo $heading; ?></h2>

<?php the_content(); ?>

 <?php echo $product->get_categories( ' ', '<p class="tags home-green"><strong>' . _n( 'Category:', 'Categories:', $cat_count, 'homeshop' ) . '</strong> ', '</p>' ); ?>

 <?php echo $product->get_tags( ' ', '<p class="tags home-green"><strong>' . _n( 'Tag:', 'Tags:', $tag_count, 'homeshop' ) . '</strong> ', '</p>' ); ?>



