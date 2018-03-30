<?php
if (!defined('THEME_FRAMEWORK')) exit('No direct script access allowed');

/**
 * Add support to WooCommerce plugin. overrides some of its core functionality
 *
 * @author      Bob Ulusoy
 * @copyright   Artbees LTD (c)
 * @link        http://artbees.net
 * @since       Version 5.1
 * @package     artbees
 */




// Do not proceed if WooCommerce plugin is not active
if (!class_exists('woocommerce')) return false;




/*
 * Declares support to woocommerce
*/
add_theme_support('woocommerce');




remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
remove_action('woocommerce_archive_description', 'woocommerce_product_archive_description', 10);
remove_action('woocommerce_proceed_to_checkout', 'woocommerce_button_proceed_to_checkout', 20);



/* Added Polyfil for increment and decrement of product quality for woocommerce using a plugin */
require_once (THEME_INCLUDES . "/woocommerce-quantity-increment/woocommerce-quantity-increment.php");





/*
 * Overrides woocommerce styles and scripts modified and created by theme
*/
if(!function_exists('mk_override_woocommerce_styles')) {

	function mk_override_woocommerce_styles() {
	    global $mk_options;

	    $theme_data = wp_get_theme("Jupiter");

	    $is_css_min = ( !(defined('MK_DEV') ? constant("MK_DEV") : true) || $mk_options['minify-css'] == 'true' );

	    wp_enqueue_style('woocommerce', THEME_STYLES . '/plugins'. ($is_css_min ? '/min' : '') .'/woocommerce.css', false, $theme_data['Version'], 'all');
	}
	add_filter('woocommerce_enqueue_styles', 'mk_override_woocommerce_styles');
}







/**
* overrides the archive loop product description
*/
if(!function_exists('mk_woocommerce_product_archive_description')) {
	
	function mk_woocommerce_product_archive_description() {
	    
	    if (is_post_type_archive('product')) {
	        $shop_page = get_post(wc_get_page_id('shop'));
	        if ($shop_page) {
	            $description = apply_filters('the_content', $shop_page->post_content);
	            if ($description) {
	                echo $description;
	            }
	        }
	    }

	}

	add_action('woocommerce_archive_description', 'mk_woocommerce_product_archive_description', 10);
}







/**
* Overrides to theme containers for wrapper starting part
*/
if(!function_exists('mk_woocommerce_output_content_wrapper_start')) {
	
	function mk_woocommerce_output_content_wrapper_start() {
	    
	    global $mk_options;
	    $padding = '';
	    
	    if (is_singular('product')) {
	        $page_layout = $mk_options['woocommerce_single_layout'];
	    
	    } else if (global_get_post_id()) {

	        $page_layout = get_post_meta(global_get_post_id() , '_layout', true);
	        $padding = get_post_meta(global_get_post_id() , '_padding', true);

	    } 

	    else if (mk_is_woo_archive()) {
	        $page_layout = get_post_meta(mk_is_woo_archive() , '_layout', true);
	    }
	    
	    if (isset($_REQUEST['layout']) && !empty($_REQUEST['layout'])) {
	        $page_layout = esc_html($_REQUEST['layout']);
	    }
	    
	    $page_layout = (isset($page_layout) && !empty($page_layout)) ? $page_layout : 'full';
	    
	    $padding = ($padding == 'true') ? 'no-padding' : '';

	    Mk_Static_Files::addAssets('mk_message_box');
	    Mk_Static_Files::addAssets('mk_swipe_slideshow');
	?>
	<div id="theme-page" class="master-holder clearfix" <?php echo get_schema_markup('main'); ?>>
	    <div class="mk-main-wrapper-holder">
	        <div class="theme-page-wrapper <?php echo $page_layout; ?>-layout <?php echo $padding; ?>  mk-grid">
				<div class="theme-content <?php echo $padding; ?>">
	<?php
	}

	add_action('woocommerce_before_main_content', 'mk_woocommerce_output_content_wrapper_start', 10);
}







/**
* Overrides to theme containers for wrapper ending part
*/
if(!function_exists('mk_woocommerce_output_content_wrapper_end')) {
	
	function mk_woocommerce_output_content_wrapper_end() {
	    global $mk_options;
	   
	    if (is_singular('product')) {
	        $page_layout = $mk_options['woocommerce_single_layout'];
	    } 
	    else if (global_get_post_id()) {
	        $page_layout = get_post_meta(global_get_post_id() , '_layout', true);
	    } 
	    else if (mk_is_woo_archive()) {
	        $page_layout = get_post_meta(mk_is_woo_archive() , '_layout', true);
	    }
	    
	    if (isset($_REQUEST['layout']) && !empty($_REQUEST['layout'])) {
	        $page_layout = $_REQUEST['layout'];
	    }
	    
	    $page_layout = (isset($page_layout) && !empty($page_layout)) ? $page_layout : 'full'; ?>

	    			</div>
	    	<?php if ($page_layout != 'full') get_sidebar(); ?>   
	        	<div class="clearboth"></div>   
	    		</div>
	    	</div>
		</div>
	
	<?php
	}

	add_action('woocommerce_after_main_content', 'mk_woocommerce_output_content_wrapper_end', 10);
}








/**
* Overrides the html template for cart fragments - desktop
*/
if (!function_exists('mk_woocommerce_header_add_to_cart_fragment')) {
    
    function mk_woocommerce_header_add_to_cart_fragment($fragments) {
        
        ob_start();
        ?>
        <a class="mk-shoping-cart-link" href="<?php echo WC()->cart->get_cart_url(); ?>">
            <?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-moon-cart-2', 16); ?>
            <span class="mk-header-cart-count"><?php echo WC()->cart->cart_contents_count; ?></span>
        </a>
        <?php
        $fragments['a.mk-shoping-cart-link'] = ob_get_clean();
            
        return $fragments;
    }
    add_filter('add_to_cart_fragments', 'mk_woocommerce_header_add_to_cart_fragment');

}







/**
* Output the proceed to checkout button.
*/
if (!function_exists('mk_woocommerce_button_proceed_to_checkout')) {
    
    function mk_woocommerce_button_proceed_to_checkout() {
        $checkout_url = WC()->cart->get_checkout_url(); ?>
        <a href="<?php echo $checkout_url; ?>" class="checkout-button shop-flat-btn shop-skin-btn"><?php _e('Proceed to Checkout', 'mk_framework'); ?></a>
        <?php
    }

    add_action('woocommerce_proceed_to_checkout', 'mk_woocommerce_button_proceed_to_checkout', 20);

}






/**
* Output Add to cart button for responsive
*/
if (!function_exists('mk_add_to_cart_responsive')) {
    
    function mk_add_to_cart_responsive() {
    	global $mk_options;

    	$show_cart = isset($mk_options['add_cart_responsive']) ? $mk_options['add_cart_responsive'] : 'true';
    	
    	if($show_cart == 'false') return false;

        ?>
        <div class="add-cart-responsive-state">
	        <a class="mk-shoping-cart-link" href="<?php echo WC()->cart->get_cart_url();?>">
				<?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-moon-cart-2', 16); ?>
				<span class="mk-header-cart-count"><?php echo WC()->cart->cart_contents_count;?></span>
			</a>
		</div>
        <?php
    }

    add_action('add_to_cart_responsive', 'mk_add_to_cart_responsive', 20);

}



