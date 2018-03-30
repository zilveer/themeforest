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
?>

<?php do_action( 'presscore_before_post' ); ?>

<article <?php wc_product_cat_class( 'post', $category ); ?>>

	<?php
	presscore_get_config()->set( 'subcategory', $category );

	if ( 'under_image' == presscore_get_config()->get( 'post.preview.description.style' ) ) {

		dt_woocommerce_template_subcategory_desc_under();

	} else {

		dt_woocommerce_template_subcategory_desc_rollover();
	}
	?>

</article>

<?php do_action( 'presscore_after_post' ); ?>