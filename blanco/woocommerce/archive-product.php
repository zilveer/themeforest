<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

    get_header('shop');
    do_action('woocommerce_before_main_content'); 
    $product_per_row = etheme_get_option('prodcuts_per_row'); 
    $product_sidebar = etheme_get_option('product_page_sidebar');
    $mobile_sidebar = etheme_get_option('blog_sidebar_mobile');
    if($product_per_row == 5){
        $product_sidebar = false;
    }
?>  
<section id="main" class="columns2-left">
    <?php if($mobile_sidebar == 'top'): ?>
        <?php if($product_sidebar) : ?>
        	<div id="products-sidebar" class="main-products-sidebar above-content">
        		<?php if ( is_active_sidebar( 'product-widget-area' ) ) : ?>
        			<?php dynamic_sidebar( 'product-widget-area' ); ?>
                <?php else: ?>
                    <?php etheme_get_wc_categories_menu() ?>
        		<?php endif; ?>	
            </div>
    	<?php endif; ?>	
    <?php endif; ?>
	<div id="default_products_page_container" class="<?php if(!$product_sidebar) echo 'no-sidebar'; else echo 'with-sidebar'?>">
    <?php
        global $wp_query;
        $image ='';
        $cat = $wp_query->get_queried_object();
        if(!property_exists($cat, 'term_id')){
            $image = etheme_get_option('product_bage_banner');
        }else if(property_exists($cat, 'term_id')){
            $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
            $image = wp_get_attachment_url( $thumbnail_id );
        }
        if($image && $image !=''){
            ?> <img class="cat-banner" src="<?php echo $image ?>" /> <?php
        }
        
     ?>
     	<?php do_action( 'woocommerce_archive_description' ); ?>

		<?php if ( is_tax() ) : ?>
			<?php do_action( 'woocommerce_taxonomy_archive_description' ); ?>
		<?php elseif ( ! empty( $shop_page ) && is_object( $shop_page ) ) : ?>
			<?php do_action( 'woocommerce_product_archive_description', $shop_page ); ?>
		<?php endif; ?>

		<?php if ( have_posts() ) : ?>

            <div class="toolbar">
                <?php do_action('woocommerce_before_shop_loop'); ?>
                <div class="clear"></div>
            </div>
            
            <div class="products-categoies">
				<?php woocommerce_product_subcategories(); ?>
		      <div class="clear"></div>
            </div>
                <div id="products-grid" class="products_grid rows-count<?php echo $product_per_row ?>">
    				<?php while ( have_posts() ) : the_post(); ?>
    		
    					<?php woocommerce_get_template_part( 'content', 'product' ); ?>
    		
    				<?php endwhile; // end of the loop. ?>
				</div>
    		<div class="clear"></div>
    
            <div class="toolbar bottom">
            	<?php do_action('woocommerce_after_shop_loop'); ?>
                <div class="clear"></div>
            </div>
    		
		<?php else : ?>
		
			<?php if ( ! woocommerce_product_subcategories( array( 'before' => '<ul class="products">', 'after' => '</ul>' ) ) ) : ?>
					
				<p class="error"><?php _e( 'No products found which match your selection.', ETHEME_DOMAIN ); ?></p>
					
			<?php endif; ?>
		
		<?php endif; ?>
		


        </div><script type="text/javascript">imageTooltip(jQuery('.imageTooltip'))</script>
    <?php if($mobile_sidebar == 'bottom'): ?>
        <?php if($product_sidebar) : ?>
        	<div id="products-sidebar" class="main-products-sidebar">
        		<?php if ( is_active_sidebar( 'product-widget-area' ) ) : ?>
        			<?php dynamic_sidebar( 'product-widget-area' ); ?>
                <?php else: ?>
                    <?php etheme_get_wc_categories_menu() ?>
        		<?php endif; ?>	
            </div>
    	<?php endif; ?>	
	<?php endif; ?>	
    <div class="clear"></div>
</section><!-- #container -->
<?php get_footer('shop'); ?>