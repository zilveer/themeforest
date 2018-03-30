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
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce_loop, $mk_options;


// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ){
	$woocommerce_loop['loop'] = 0;
}


$grid_width = $mk_options['grid_width'];
$content_width = $mk_options['content_width'];

$height = $mk_options['woo_loop_img_height'];

$columns = isset($mk_options['shop_archive_columns']) && $mk_options['shop_archive_columns'] != 'default' ? $mk_options['shop_archive_columns'] : false;

if ( !empty( $woocommerce_loop['columns'] ) ){
	$columns = $woocommerce_loop['columns'];
}

$layout = false;
if(global_get_post_id()) {
	
	$layout = get_post_meta( global_get_post_id(), '_layout', true );
	if (isset($_REQUEST['layout']) && !empty($_REQUEST['layout'])) {
        $layout = esc_html($_REQUEST['layout']);
    }
}

if($columns) {

	switch ($columns) {
		case 1:
			$grid = 'mk--col--12-12';
			break;
		case 2:
			$grid = 'mk--col--1-2';
			break;
		case 3:
			$grid = 'mk--col--4-12';
			break;
		case 4:
			$grid = 'mk--col--3-12';
			break;			
		default:
			$grid = 'mk--col--3-12';
			break;
	}

	// Custom columns taken from theme options > woocommerce > Shop Loop columns option.
	$classes = 'item mk--col '.$grid;
	$width = absint($grid_width/$columns);
	$column_width = absint($grid_width/$columns);

} else {
	if(empty($layout) || $layout != 'full') {
		$classes = 'item mk--col mk--col--4-12';
		$width = round((($content_width / 100) * $grid_width)/3);
		$column_width = round($grid_width/3);
	} else {
		$classes = 'item mk--col mk--col--3-12';
		$width = round($grid_width/4);
		$column_width = round($grid_width/4);
	}
}

$image_size = isset($mk_options['woo_category_image_size']) ? $mk_options['woo_category_image_size'] : 'crop';

?>
<article class="product-category product <?php echo $classes; ?>" style="max-width:<?php echo $column_width; ?>px">
	<div class="item-holder">
	<?php do_action( 'woocommerce_before_subcategory', $category ); ?>

	<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">
		<h4>
			<?php
				echo $category->name;

				if ( $category->count > 0 )
					echo apply_filters( 'woocommerce_subcategory_count_html', ' <span class="count">' . $category->count . ' '.__('Items', 'mk_framework').'</span>', $category );
			?>
		</h4>

		<?php
	        $small_thumbnail_size   = apply_filters( 'single_product_small_thumbnail_size', 'shop_catalog' );
	        $thumbnail_id           = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true  );

	        $featured_image_src = Mk_Image_Resize::resize_by_id_adaptive( $thumbnail_id, $image_size, $width, $height, $crop = false, $dummy = true);

	        echo '<img src="'.$featured_image_src['dummy'].'" '.$featured_image_src['data-set'].' width="'.$width.'" height="'.$height.'" alt="' . esc_attr( $category->name ) . '" title="' . esc_attr( $category->name ) . '" />';
		?>

		<?php
			/**
			 * woocommerce_after_subcategory_title hook
			 */
			do_action( 'woocommerce_after_subcategory_title', $category );
		?>

	</a>

	<?php do_action( 'woocommerce_after_subcategory', $category ); ?>
</div>
</article>