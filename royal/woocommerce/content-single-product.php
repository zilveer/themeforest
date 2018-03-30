<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$l = et_page_config();

if (etheme_get_custom_field('et_single_layout') != '') {
    $layout = etheme_get_custom_field('et_single_layout');
} else {
    $layout = etheme_get_option('single_product_layout');
}

$image_class = 'col-lg-6 col-md-6 col-sm-12'; 
$infor_class = 'col-lg-6 col-md-6 col-sm-12'; 

if($layout == 'small') {
    $image_class = 'col-lg-4 col-md-5 col-sm-12'; 
    $infor_class = 'col-lg-8 col-md-7 col-sm-12'; 
}

if($layout == 'large') {
    $image_class = 'col-sm-12'; 
    $infor_class = 'col-lg-6 col-md-6 col-sm-12'; 
}


if($layout == 'fixed') {
    $image_class = 'col-sm-6'; 
    $infor_class = 'col-lg-3 col-md-3 col-sm-12'; 
}

?>

<?php
	
	$class = 'tabs-'.etheme_get_option('tabs_location');
    $class .= ' single-product-'.$layout;
    $class .= ' reviews-position-'.etheme_get_option('reviews_position');
    if(etheme_get_option('ajax_addtocart')) $class .= ' ajax-cart-enable';
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
     
?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class($class); ?>>

    <div class="row">
        <div class="<?php esc_attr_e( $l['content-class'] ); ?> product-content">
            <div class="row">
                 <?php if ($layout == 'fixed'): ?>
                    <div class="col-md-3 product-summary-fixed">
                        <div class="fixed-product-block">
                            <div class="fixed-content">
                                <?php
                                if(etheme_get_option('show_product_title')) {
                                    woocommerce_template_single_title();
                                }
                                    woocommerce_template_single_rating();
                                    echo '<hr class="divider short">';
                                    woocommerce_template_single_excerpt();
                                    echo do_shortcode('[share title="'.__('Share Social', ET_DOMAIN).'" text="'.get_the_title().'"]');
                                 ?>
                             </div>
                         </div>
                    </div>
                <?php endif ?>
                <div class="<?php esc_attr_e( $image_class ); ?> product-images">
                	<?php
                		/**
                		 * woocommerce_before_single_product_summary hook
                		 *
                		 * @hooked woocommerce_show_product_sale_flash - 10
                		 * @hooked woocommerce_show_product_images - 20
                		 */
                		do_action( 'woocommerce_before_single_product_summary' );
                	?>
                </div><!-- Product images/ END -->

                <?php 
                    if($layout == 'large') {
                        ?>
                        </div>
                        <div class="row">
                        <?php
                    } 
                ?>

                <div class="<?php esc_attr_e( $infor_class ); ?> product-information <?php if(etheme_get_option('ajax_addtocart')): ?>ajax-enabled<?php endif; ?>">
                    <div class="product-information-inner <?php if($layout == 'fixed') echo 'fixed-product-block' ?>">
                        <div class="fixed-content"> 
                            <div class="product-navigation clearfix">
        						<h4 class="meta-title"><span><?php _e('Product Description', ETHEME_DOMAIN); ?></span></h4>
        						<div class="product-arrows pull-right">
                                    <?php previous_post_link_product(); ?>
                                    <?php next_post_link_product(); ?>
        						</div>
        					</div>
                            
                    		<?php
                    			/**
                    			 * woocommerce_single_product_summary hook
                    			 *
                    			 * @hooked woocommerce_template_single_title - 5 
                    			 * @hooked woocommerce_template_single_rating - 10
                    			 * @hooked woocommerce_template_single_price - 10
                    			 * @hooked woocommerce_template_single_excerpt - 20
                    			 * @hooked woocommerce_template_single_add_to_cart - 30
                    			 * @hooked woocommerce_template_single_meta - 40
                    			 * @hooked woocommerce_template_single_sharing - 50
                    			 */
                    			do_action( 'woocommerce_single_product_summary' );
                    		?>
                	
                    		<?php if(etheme_get_option('share_icons') && $layout != 'fixed') echo do_shortcode('[share text="'.get_the_title().'"]'); ?>
                        </div>
                    </div>
                </div><!-- Product information/ END -->
                
                <?php 
                    if($layout == 'large') {
                        ?>
                            <div class="<?php esc_attr_e( $infor_class ); ?>">
                                <?php do_action( 'woocommerce_after_single_product_summary' ); ?>
                            </div>
                        <?php
                    } 
                ?>
            </div>
            
        	<?php
        		/**
        		 * woocommerce_after_single_product_summary hook
        		 *
        		 * @hooked woocommerce_output_product_data_tabs - 10
        		 * @hooked woocommerce_output_related_products - 20 [REMOVED in woo.php]
        		 */
        		 if(etheme_get_option('tabs_location') == 'after_content' && $layout != 'large') {
	        		 do_action( 'woocommerce_after_single_product_summary' );
        		 }
        	?>
            
        </div> <!-- CONTENT/ END -->
        

        <?php if($l['sidebar'] != '' && $l['sidebar'] != 'without' && $l['sidebar'] != 'no_sidebar'): ?>
            <div class="<?php esc_attr_e( $l['sidebar-class'] ); ?> single-product-sidebar sidebar-<?php esc_attr_e( $l['sidebar'] ); ?>">
                <?php et_product_brand_image(); ?>
                <?php if(etheme_get_option('upsell_location') == 'sidebar') woocommerce_upsell_display(); ?>
                <?php dynamic_sidebar('single-sidebar'); ?>
            </div>
        <?php endif; ?>
    </div>
    
    <?php if(etheme_get_option('upsell_location') == 'after_content') woocommerce_upsell_display(); ?>
    <?php
		if(etheme_get_custom_field('additional_block') != '') {
			echo '<div class="product-extra-content">';
				et_show_block(etheme_get_custom_field('additional_block'));
			echo '</div>';
		}     
    ?>
    <?php if(etheme_get_option('show_related')) woocommerce_output_related_products(); ?>


	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
