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

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $product, $post, $woocommerce_loop,$woocommerce;

$product_page_productname = etheme_get_option('product_page_productname');
$product_page_price = etheme_get_option('product_page_price');
$product_page_addtocart = etheme_get_option('product_page_addtocart');
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

$woocolumns =  $woocommerce_loop['columns'];
$columns = etheme_get_option('prodcuts_per_row');
$product_img_hover = etheme_get_option('product_img_hover');

$class = '';
if($woocommerce_loop['loop'] % $columns == 0){
    $class .= ' last';
}

if ($woocommerce_loop['loop'] % $woocolumns  == 0)
    $class .= ' woolast';

?>

	<div class="product-grid <?php echo $class; ?>">
    	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
    		
    		<?php woocommerce_get_template( 'loop/sale-flash.php' ); ?>
            
    		<?php 
    			$placeholder_width = $placeholder_height = 400;
                $url = wp_get_attachment_image_src( get_post_thumbnail_id($product->ID), array(260,260) );
        		if ( has_post_thumbnail() ){
        			?>
                        <a id="<?php echo etheme_get_image( $product->ID, 400, 400, false ) ?>" href="<?php echo the_permalink(); ?>" class="product-image <?php if($product_img_hover == 'tooltip'): ?>imageTooltip<?php endif; ?>">
                            <?php if(etheme_get_custom_field('_etheme_hover') && $product_img_hover == 'swap'): ?><div class="img-wrapper"><img class="product_image" src="<?php echo etheme_get_custom_field('_etheme_hover'); ?>"/></div><?php endif; ?>
                            <div class="img-wrapper<?php if(etheme_get_custom_field('_etheme_hover') && $product_img_hover == 'swap') echo ' hideableHover' ?>"><img src="<?php echo etheme_get_image(false,300,300,false); ?>"/></div>
 
                        </a>
                    <?php
        		}
                else {
                    echo '<img src="'. woocommerce_placeholder_img_src() .'" alt="Placeholder" width="' . $placeholder_width . '" height="' . $placeholder_height . '" />';
                }
            
            ?>	
            <?php if($product_page_productname): ?>
    		  <div class="product-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
            <?php endif; ?>
                   
            
            <?php if($product_page_price): ?>
                <?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
            <?php endif; ?>
            <?php if($product_page_addtocart): ?>
                <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
            <?php endif; ?>
            
        <div class="clear"></div>
	</div>


<?php /* if($woocommerce_loop['loop']%3==0): ?>
    <hr class="hr3" />
<?php endif; ?>
<?php if($woocommerce_loop['loop']%4==0): ?>
    <hr class="hr4" />
<?php endif; ?>
<?php if($woocommerce_loop['loop']%5==0): ?>
    <hr class="hr5" />
<?php endif;*/ ?>