<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product_cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}
//$GLOBALS['woocm_subcat_loop']++;

// Increase loop count
$woocommerce_loop['loop'] ++;
?>
<div class="span<?php
	if( ($woocommerce_loop['loop'] - 1) % 6 == 0 )
		echo ' span-first-child';
	?>">

	<?php do_action( 'woocommerce_before_subcategory', $category ); ?>
            <div class="image">
            <a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">
            <?php
                do_action( 'woocommerce_before_subcategory_title', $category );
            ?>
            </a></div>
            <div class="name subcatname"><a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>"><?php echo $category->name; ?><?php if ( $category->count > 0 ) : ?> (<?php echo $category->count; ?>)
<?php endif; ?></a></div>
	
		<?php
			/**
			 * woocommerce_after_subcategory_title hook
			 */
			//do_action( 'woocommerce_after_subcategory_title', $category );
		?>

	<?php //do_action( 'woocommerce_after_subcategory', $category ); ?>

</div>