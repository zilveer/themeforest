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

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $allaround_data;

	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked woocommerce_show_messages - 10
	 */
	function allaround_woo_title() {
		echo do_shortcode('[aa_title themecolor="yes"]' . get_the_title() . '[/aa_title]');
	}
	add_action( 'woocommerce_before_single_product', 'allaround_woo_title', 5 );
	do_action( 'woocommerce_before_single_product' );
?>

<div itemscope itemtype="http://schema.org/Product" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
        /**
         * woocommerce_show_product_images hook
         *
         * @hooked woocommerce_show_product_sale_flash - 10
         * @hooked woocommerce_show_product_images - 20
         */
        do_action( 'woocommerce_before_single_product_summary' );
    ?>
    
    <div class="product_page_content_wrapper">
        <div class="text_wrapper">
            <h3><?php the_title(); ?></h3>
            <span class="sub_header"><?php the_excerpt(); ?></span><!-- sub_header -->
            <span><?php the_content(); ?></span>
            </div><!-- text_wrapper -->
            
        <div class="order_box">
            <h3><?php _e('ORDER NOW', 'allaround'); ?></h3>
            
            <?php
                /**
                 * woocommerce_single_product_summary hook
                 *
                 * @hooked woocommerce_template_single_title - 5
                 * @hooked woocommerce_template_single_price - 10
                 * @hooked woocommerce_template_single_excerpt - 20
                 * @hooked woocommerce_template_single_add_to_cart - 30
                 * @hooked woocommerce_template_single_meta - 40
                 * @hooked woocommerce_template_single_sharing - 50
                 */
				 
                remove_action('woocommerce_single_product_summary','woocommerce_template_single_excerpt', 20);
                do_action( 'woocommerce_single_product_summary' );
				
                global $allaround_postmeta;
                ?>
                
            </div><!-- order_box -->
            
        <div class="clear"></div><!-- clear -->
		<?php
			if ( $allaround_data['product_evaluation'] !== '0' ) :
		?>
        <div class="separator2 margin-top48 margin-bottom24"></div><!-- separator2 -->
        
        <h3><?php _e('CUSTOMER EVALUATION', 'allaround'); ?></h3>
        <span class="sub_header"><?php echo $allaround_postmeta['product-text']; ?></span>
        <?php 
            echo do_shortcode("[aa_progressbar title='" . $allaround_postmeta['bar1-text'] . "' howmuch='" . $allaround_postmeta['bar1-progress'] . "' outof='100']");
            echo do_shortcode("[aa_progressbar title='" . $allaround_postmeta['bar2-text'] . "' howmuch='" . $allaround_postmeta['bar2-progress'] . "' outof='100']");
            echo do_shortcode("[aa_progressbar title='" . $allaround_postmeta['bar3-text'] . "' howmuch='" . $allaround_postmeta['bar3-progress'] . "' outof='100']");
            echo do_shortcode("[aa_progressbar title='" . $allaround_postmeta['bar4-text'] . "' howmuch='" . $allaround_postmeta['bar4-progress'] . "' outof='100']");
        ?>
		<?php endif; ?>
        </div><!-- product_page_content_wrapper -->
        
    <div class="clear"></div><!-- clear -->
    <div class="separator2 margin-bottom24"></div><!-- separator -->
<?php
		/**
		 * woocommerce_after_single_product_summary hook
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_output_related_products - 20
		 */
		 
		function woo_remove_product_tabs( $tabs ) {
			unset( $tabs['description'] );      	// Remove the description tab
			return $tabs;
		}
		add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

		do_action( 'woocommerce_after_single_product_summary' );
	?>
</div><!-- #product-<?php the_ID(); ?> -->
<?php do_action( 'woocommerce_after_single_product' ); ?>