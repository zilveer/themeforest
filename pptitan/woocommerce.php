<?php
/**
 * The main template file for display page.
 *
 * @package WordPress
*/

get_header(); 
?>

<br class="clear"/>
</div>

<?php
//Get Page background style
$pp_shop_bg = get_option('pp_shop_bg'); 
			
if(empty($pp_shop_bg))
{
    $pp_shop_bg = get_template_directory_uri().'/example/bg.jpg';
}

wp_enqueue_script("script-static-bg", get_template_directory_uri()."/templates/script-static-bg.php?bg_url=".$pp_shop_bg, false, THEMEVERSION, true);

//Get Cart URL
global $woocommerce;
$cart_url = $woocommerce->cart->get_cart_url();
$checkout_url = $woocommerce->cart->get_checkout_url();
?>

<div id="page_content_wrapper" class="fade-in two">

    <div class="inner">
    
    <!-- Begin main content -->
    <div class="inner_wrapper">
    
    	<div id="page_caption">
    		<h1 class="cufon"><?php _e( 'Our Shop', THEMEDOMAIN ); ?></h1>
    		<a href="<?php echo $cart_url; ?>"><?php _e( 'Shopping Cart', THEMEDOMAIN ); ?></a> | <a href="<?php echo $checkout_url; ?>"><?php _e( 'Checkout', THEMEDOMAIN ); ?></a>
    	</div>
        
    		<div class="sidebar_content full_width transparentbg">
        	
        		<?php woocommerce_content();  ?>
        			
        	</div>
    
    </div>
    <!-- End main content -->
</div>

<?php get_footer(); ?>