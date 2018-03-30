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

if ( ! empty( $woocommerce_loop['hover'] ) )
    $hover = $woocommerce_loop['hover'];

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );


if(($woocommerce_loop['view_mode'] == 'list' || $woocommerce_loop['view_mode'] == 'list_grid') && $hover == 'mask') 
    $hover = 'slider';


if ( ! empty( $woocommerce_loop['hover'] ) )
    $hover = $woocommerce_loop['hover'];

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = '';
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes .= 'first ';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes .= 'last ';
	
$classes .= 'col-lg-4 col-sm-4 col-xs-6 ';

if(!class_exists('YITH_WCWL')) {
	$classes .= 'wishlist-disabled ';
}

$hoverUrl = '';
if ($hover == 'swap') {
	$hoverUrl = etheme_get_custom_field('hover_image');
	$size = get_option('shop_catalog_image_size');
	if ($hoverUrl != '') {
		$hoverImg = vt_resize(false, $hoverUrl, $size['width'], $size['height'], $size['crop'] );
    }
}

?>


<div class="product <?php echo $classes; ?>">
	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
	<div class="content-product">
		<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10 [REMOVED in woo.php]
			 * @hooked woocommerce_template_loop_product_thumbnail - 10 [REMOVED in woo.php]
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );
		?>
		<div class="product-image-wrapper hover-effect-<?php echo $hover; ?>">
				<a class="product-content-image" href="<?php the_permalink(); ?>" data-images="<?php echo et_get_image_list(); ?>">
					<?php woocommerce_show_product_sale_flash(); ?>
					<?php if (!empty($hoverImg['url'])): ?>
						<img src="<?php echo $hoverImg['url']; ?>" alt="<?php the_title(); ?>" width="<?php echo $hoverImg['width'] ?>" height="<?php echo $hoverImg['height'] ?>" class="show-image">
					<?php endif ?>
					<?php echo woocommerce_get_product_thumbnail(); ?>
                    <?php if($hover == 'mask'): ?>
                            <div class="hover-mask">
                                <div class="mask-content">
                                    <?php if (etheme_get_option('product_page_cats')): ?>
                                        <div class="products-page-cats">
                                            <?php
                                                $size = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
                                                echo $product->get_categories( ', ' );
                                            ?>
                                        </div>
                                    <?php endif ?>

                                    <?php if (etheme_get_option('product_page_productname')): ?>
                                        <div class="product-title">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </div>
                                    <?php endif ?>

                                    <?php
                                        /**
                                         * woocommerce_after_shop_loop_item_title hook
                                         *
                                         * @hooked woocommerce_template_loop_rating - 5
                                         * @hooked woocommerce_template_loop_price - 10
                                         */
                                        if (etheme_get_option('product_page_price')) {
                                            do_action( 'woocommerce_after_shop_loop_item_title' );
                                        }
                                    ?>


                                    <div class="product-excerpt">
                                            <?php echo do_shortcode(get_the_excerpt()); ?>
                                    </div>

                                    <?php 
                                    if (etheme_get_option('product_page_addtocart')) {
                                      do_action( 'woocommerce_after_shop_loop_item' ); 
                                        }
                                    ?>
                                </div>
                            </div>
                    <?php endif; ?>
				</a>
			<footer class="footer-product">
				<?php echo et_wishlist_btn(__('Wishlist', ET_DOMAIN)); ?>
				<?php if (etheme_get_option('quick_view')): ?>
					<span class="show-quickly" data-prodid="<?php echo $post->ID;?>"><?php _e('Quick View', ET_DOMAIN) ?></span>
				<?php endif ?>
			</footer>
		</div>

		<div class="text-center product-details">
	        <?php if (etheme_get_option('product_page_cats')): ?>
                <div class="products-page-cats">
                    <?php
                        $size = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
                        echo $product->get_categories( ', ' );
                    ?>
                </div>
	        <?php endif ?>
	
	        <?php if (etheme_get_option('product_page_productname')): ?>
	                <div class="product-title">
	                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	                </div>
	        <?php endif ?>
	
            <?php
                /**
                 * woocommerce_after_shop_loop_item_title hook
                 *
                 * @hooked woocommerce_template_loop_rating - 5
                 * @hooked woocommerce_template_loop_price - 10
                 */
                if (etheme_get_option('product_page_price')) {
                    do_action( 'woocommerce_after_shop_loop_item_title' );
            	}
            ?>
            
	        <div class="product-excerpt">
                <?php echo do_shortcode(get_the_excerpt()); ?>
	        </div>

			<?php 
				if (etheme_get_option('product_page_addtocart')) {
					do_action( 'woocommerce_after_shop_loop_item' ); 
				}
			?>
		</div>
	</div>
</div>