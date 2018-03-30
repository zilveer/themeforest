<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibilty
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

$layout = stag_sidebar_layout();

$rating = $product->get_rating_html();

$availability = $product->get_availability();

?>

		<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

        <li <?php post_class( $classes ); ?>>

            <div class="inner-product-wrapper">

            	<div class="thumbnail-container">
            	    <?php woocommerce_get_template( 'loop/sale-flash.php' ); ?>

                      <?php if ( $availability['availability'] === 'Out of stock' ): ?>
                      <span class="out-of-stock"><?php _e( 'Out of stock', 'stag' ); ?></span>
                      <?php endif; ?>

            	    <a href="<?php the_permalink(); ?>">
            	        <div class="product-thumbnail-wrapper"><?php echo get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', array( 370, 453 ) ) ); ?></div>
            	    </a>

            	    <div class="product-buttons">
            	    	<div class="product-buttons-inner">
            	    		<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
            	    		<?php if ( $product->product_type != 'variable' && $availability['availability'] != 'Out of stock' ): ?>
            	    		<a href="<?php echo get_permalink(get_the_ID()) ?>" class="button"><?php _e( 'Details', 'stag' ); ?></a>
            	    		<?php endif ?>
            	    	</div>
            	    </div><!-- .product-buttons -->

            	    <div class="product-actions">
            	    	<?php
            	    		/**
            	    		 * product_thumbnail_container hook
            	    		 *
            	    		 * @hooked woocommerce_template_loop_price 5
            	    		 * @hooked woocommerce_template_loop_rating 10
            	    		 */
            	    		do_action('product_thumbnail_container');
            	    	?>
            	    </div><!-- .product-actions -->
            	</div><!-- .thumbnail-container -->

				<?php

				$rating_status = ( stag_get_option('shop_ratings') == "on" ) ? 'show-ratings' : 'hide-ratings';

				?>

            	<div class="product-info <?php echo $rating_status; ?>">
	            	<?php
	            		/**
	            		 * woocommerce_before_shop_loop_item_title hook
	            		 *
	            		 * @hooked woocommerce_show_product_loop_sale_flash - 10
	            		 * @hooked woocommerce_template_loop_product_thumbnail - 10
	            		 */
	            		do_action( 'woocommerce_before_shop_loop_item_title' );
	            	?>
            		<h3 class="product-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            		<?php
            			/**
            			 * woocommerce_after_shop_loop_item_title hook
            			 *
            			 * @hooked woocommerce_template_loop_price - 10
            			 */
            			do_action( 'woocommerce_after_shop_loop_item_title' );
            		?>
            	</div><!-- .product-info -->

            </div><!-- .inner-product-wrapper -->

        </li>
