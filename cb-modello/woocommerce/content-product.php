<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

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

$classes[]=' colshop'.$woocommerce_loop['columns'];

$classes[]=' product ';

$cb_woo=cb_get_woo_options($post->ID);
?>
<div <?php post_class( $classes ); ?>>
<div class="col-lg-offset-0 product-holder">
    <div class="product-item text-center" itemscope itemtype ="http://schema.org/Product">
       <?php $attachment_count   = count( $product->get_gallery_attachment_ids() );
       if($attachment_count>0){
       ?> <a href="#next" class="mini-next"></a>
        <a href="#prev" class="mini-prev"></a>
<?php }?>

		<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

		<?php
		/**
		 * woocommerce_before_shop_loop_item_title hook
		 *
		 * @hooked woocommerce_show_product_loop_sale_flash - 10
		 * @hooked woocommerce_template_loop_product_thumbnail - 10
		 */
		do_action( 'woocommerce_before_shop_loop_item_title' );

        /* modello_added*/
		?>

        <hr>
        <?php
        $brand_id  = get_post_meta($post->ID,'_cb5_brand',true);
        if($brand_id!=''){
       $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($brand_id),'full');
$url = $thumb['0'];
            ?>
        <div class="brand">
            <img alt="" src="<?php echo $url;?>" />
        </div>
        <?php }?>
        <div class="title uppercase bold">
            <a href="<?php the_permalink(); ?>" itemprop="name"><?php the_title(); ?></a>
        </div>

        
                            <div class="star-holder">
                                <?php
                                if (get_option('woocommerce_enable_review_rating') == 'yes') {
                                    $count = $product->get_rating_count();
                                    if ($count > 0) {
                                           $average = $product->get_average_rating();
                                           $average=ceil($average);

                                           for($i=1;$i<$average+1;$i++) {
                                           ?><img src="<?php echo WP_THEME_URL;?>/img/modello/star-on.png" alt="1" ><?php
                                           }
                                           $fin_c=5-$average;
                         		            for($i=1;$i<$fin_c+1;$i++) {
                                           ?><img src="<?php echo WP_THEME_URL;?>/img/modello/star-off.png" alt="1"><?php
                                            }
                                           
                                          /* echo '<div itemprop="aggregateRating" class="single_ratings" itemscope itemtype="http://schema.org/AggregateRating">';
                                         // echo '<div class="star-rating" title="' . sprintf(__('Rated %s out of 5', 'woocommerce'), $average) . '"><span style="width:' . (($average / 5) * 100) . '%"><strong itemprop="ratingValue" class="rating">' . $average . '</strong></span></div>';
                                        // echo '<span class="number_reviews">' . sprintf(_n('%s review', '%s reviews', $count, 'woocommerce'), '<span itemprop="ratingCount" class="count">' . $count . '</span>', '') . '</span>';
                                       // echo '<div class="cl"></div></div><div class="cl"></div>';*/
                                    }
                                } ?>
                            </div>
        
        
        
        <div class="shorty"><?php  echo strip_cn(get_the_content(),250); ?></div>
        <div class="price">

            <?php if($cb_woo['woo_catalog']!='hide') { ?> <?php

                do_action( 'woocommerce_after_shop_loop_item_title' );
                } ?>

        </div>

        <div class="buttons-holder">
            <div class="add-cart-holder">

            <?php if($cb_woo['woo_catalog']!='hide'&&$cb_woo['woo_catalog']!='show_prices') { ?>
                <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
            <?php } ?></div>
            <?php if(in_array('yith-woocommerce-wishlist/init.php',apply_filters('active_plugins',get_option('active_plugins')))) { ?>
            <div class="add-wishlist-holder">
                    <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]');?>
            </div> <?php } ?>
        </div>
			<?php /*<div class="quick_preview_icon" data-id="<?php echo $post->ID; ?>" data-url="<?php echo get_permalink(); ?>"><i class="fa fa-desktop prod_preview"></i>
			</div>
			<?php if(in_array('yith-woocommerce-wishlist/init.php',apply_filters('active_plugins',get_option('active_plugins')))) echo do_shortcode('[yith_wcwl_add_to_wishlist]');?>
			
			<a href="<?php the_permalink(); ?>" itemprop="name"><h3>
			<span class="divider_h"></span>
			<?php the_title(); ?>
			</h3></a>
			<?php if($cb_woo['woo_catalog']!='hide') { ?> <?php

			do_action( 'woocommerce_after_shop_loop_item_title' );
			?> <?php } ?>
			
			<?php if($cb_woo['woo_previews']=='yes') { ?>
			
			<div class="quick_preview" data-id="<?php echo $post->ID; ?>">
			</div>
			<?php } ?>
			
			
		<div class="cart_container">
			<?php if($cb_woo['woo_catalog']!='hide'&&$cb_woo['woo_catalog']!='show_prices') { ?>
			<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
			<?php } ?>
			<a class="bttn alt" href="<?php echo get_permalink();?>"><?php _e('Details','cb-modello');?>
			</a>
			</div>

 */ ?>
		<div class="cl"></div></div>

</div></div>
