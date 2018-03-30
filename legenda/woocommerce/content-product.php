<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

$hover = etheme_get_option('product_img_hover');

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 3 );

// Ensure visibility
if ( ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;


// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';

$lazy_images = false;
$style = 'default';

if (!empty($woocommerce_loop['lazy-load'])) {
	$lazy_images = true;
}

if (!empty($woocommerce_loop['style']) && $woocommerce_loop['style'] == 'advanced') {
	$style = 'advanced';
	$classes[] = 'content-product-advanced';
}
?>
<div <?php post_class( $classes ); ?>>

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

		<?php
			$width = etheme_get_option('product_page_image_width');
			$height = etheme_get_option('product_page_image_height');
			$crop = etheme_get_option('product_page_image_cropping');



			$hoverUrl = '';

            $url = etheme_get_image(false, $width, $height, $crop);
            if ($hover == 'swap') {
            	$hoverUrl = etheme_get_custom_field('hover_img');
            	if ($hoverUrl != '') {
					$hoverImg = vt_resize(false, $hoverUrl, $width, $height, $crop );
            	}
            }

		?>
		<?php if ($style == 'advanced'): ?>
			<div class="row-fluid">
				<div class="span6">
		<?php endif ?>
		<div class="product-image-wrapper hover-effect-<?php if (has_post_thumbnail()) echo $hover; ?>">
			<?php etheme_wc_product_labels(); ?>

	        <?php
				if ( !$product->is_in_stock() && etheme_get_option('out_of_label')):
	         ?>
	         	<span class="out-of-stock"><?php _e('Out of stock', ETHEME_DOMAIN) ?></span>
			<?php endif ?>

			<?php if (has_post_thumbnail()): ?>
				<?php
					$img_id = get_post_thumbnail_id($post->ID);
					$alt_text = get_post_meta($img_id , '_wp_attachment_image_alt', true);
				?>
				<a href="<?php the_permalink(); ?>" id="<?php echo etheme_get_image(false, 800, 1000, false); ?>" class="product-content-image <?php if($hover == 'tooltip'): ?>imageTooltip<?php endif; ?> <?php if ($hoverUrl != ''): ?>with-hover<?php endif ?>" data-images-list="<?php echo get_images_list($width, $height, $crop); ?>">
					<?php if ($hoverUrl != ''): ?>
						<img src="<?php echo $hoverImg['url']; ?>" class="show-image">
					<?php endif ?>
					<img <?php if($lazy_images): ?>data-<?php endif; ?>src="<?php echo $url; ?>" alt="<?php echo $alt_text; ?>" class="<?php if($lazy_images): ?>lazyOwl<?php endif; ?> hide-image">
				</a>
			<?php else: ?>
				<a href="<?php the_permalink(); ?>" class="product-content-image <?php if($hover == 'tooltip'): ?>imageTooltip<?php endif; ?> <?php if ($hoverUrl != ''): ?>with-hover<?php endif ?>" data-images-list="<?php echo get_images_list($width, $height, $crop); ?>">
					<?php echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', woocommerce_placeholder_img_src() ), $post->ID ); ?>
				</a>
			<?php endif ?>

			<?php if ($hover == 'description'): ?>
				<div class="product-mask">
					<div class="mask-text">
						<h4><?php _e('Product description', ETHEME_DOMAIN) ?></h4>
						<?php echo trunc(get_the_excerpt(), etheme_get_option('descr_length')) ?>
						<p><a href="<?php the_permalink(); ?>" class="read-more-link button"><?php _e('Read More', ETHEME_DOMAIN); ?></a></p>
					</div>
				</div>
			<?php endif ?>

			<?php if (etheme_get_option('quick_view')): ?>
				<span class="show-quickly" data-prodid="<?php echo $post->ID;?>" style="font-size:11px; cursor: pointer;"><?php _e('Quick View', ETHEME_DOMAIN) ?></span>
			<?php endif ?>
		</div>

		<?php if ($style == 'advanced'): ?>
		        </div>
				<div class="span6">
		<?php endif ?>

		<?php if (etheme_get_option('product_page_productname')): ?>
			<h3 class="product-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<?php endif ?>

		<?php if (etheme_get_option('product_page_cats')): ?>
			<div class="products-page-cats">
				<?php
					$size = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
					echo $product->get_categories( ', ' );
				?>
			</div>
		<?php endif ?>


		<?php woocommerce_template_loop_rating(); ?>

		<div class="product-excerpt">
			<?php echo do_shortcode(get_the_excerpt()); ?>
		</div>

		<div class="add-to-container">

			<?php
				/**
				 * woocommerce_after_shop_loop_item_title hook
				 *
				 * @hooked woocommerce_template_loop_price - 10
				 */
				if (etheme_get_option('product_page_price')) {
					do_action( 'woocommerce_after_shop_loop_item_title' );
				}
			?>

	        <?php
	        	if (etheme_get_option('product_page_addtocart')) {
	        		do_action( 'woocommerce_after_shop_loop_item' );
	        	}
	        ?>
        </div>



		<?php if ($style == 'advanced'): ?>
				</div>
			</div>
		<?php endif ?>
	<div class="clear"></div>
</div>
