<?php

function cs_woocommerce_enabled()

{

	if ( class_exists( 'woocommerce' ) ){ return true; }

	return false;

}



//check if the plugin is enabled, otherwise stop the script

if(!cs_woocommerce_enabled()) { return false; }



//woocommerce support theme

add_theme_support( 'woocommerce' );

//define('WOOCOMMERCE_USE_CSS', false);
add_filter( 'woocommerce_enqueue_styles', '__return_false' );
add_action( 'wp_enqueue_scripts', 'child_manage_woocommerce_styles', 99 );

function child_manage_woocommerce_styles() {

    //remove generator meta tag

    remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );

 	

	wp_enqueue_style('shop_css', get_template_directory_uri() . '/css/shop.css');

	

    //first check that woo exists to prevent fatal errors

    if ( function_exists( 'is_woocommerce' ) ) {

        //dequeue scripts and styles

        if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() ) {

            wp_dequeue_style( 'woocommerce_frontend_styles' );

            wp_dequeue_style( 'woocommerce_fancybox_styles' );

            wp_dequeue_style( 'woocommerce_chosen_styles' );

            wp_dequeue_style( 'woocommerce_prettyPhoto_css' );

            wp_dequeue_script( 'wc_price_slider' );

            wp_dequeue_script( 'wc-single-product' );

            wp_dequeue_script( 'wc-add-to-cart' );

            wp_dequeue_script( 'wc-cart-fragments' );

            wp_dequeue_script( 'wc-checkout' );

            wp_dequeue_script( 'wc-add-to-cart-variation' );

            wp_dequeue_script( 'wc-single-product' );

            wp_dequeue_script( 'wc-cart' );

            wp_dequeue_script( 'wc-chosen' );

            wp_dequeue_script( 'woocommerce' );

            wp_dequeue_script( 'prettyPhoto' );

            wp_dequeue_script( 'prettyPhoto-init' );

            wp_dequeue_script( 'jquery-blockui' );

            wp_dequeue_script( 'jquery-placeholder' );

            wp_dequeue_script( 'fancybox' );

            wp_dequeue_script( 'jqueryui' );

        }

    }

 

}



//remove woo defaults

remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );







/**

* Define image sizes

*/

global $pagenow;

if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) add_action( 'init', 'cs_woocommerce_image_dimensions', 1 );



function cs_woocommerce_image_dimensions() {

$catalog = array(

'width' => '300',	// px

'height'	=> '300',	// px

'crop'	=> 1 // true

);

 

$single = array(

'width' => '300',	// px

'height'	=> '300',	// px

'crop'	=> 1 // true

);

 

$thumbnail = array(

'width' => '90',	// px

'height'	=> '90',	// px

'crop'	=> 1 // false

);

 

// Image sizes

update_option( 'shop_catalog_image_size', $catalog ); // Product category thumbs

update_option( 'shop_single_image_size', $single ); // Single product image

update_option( 'shop_thumbnail_image_size', $thumbnail ); // Image gallery thumbs

}





//Shop loop items changings starts

add_action( 'woocommerce_before_shop_loop_item_title', 'shop_loop_item_hover_desc' );

function shop_loop_item_hover_desc()

{

	global $post;

	$no_img = "";

	if(wp_get_attachment_image( get_post_thumbnail_id() ) == ""){

		$no_img = 'class="no-image"';

	}

?>

	<figure <?php echo $no_img; ?>>

        <figcaption>

            <p><?php echo substr(get_the_content(),0,110); if(strlen(get_the_content()) > 110){echo "...";} ?></p>

            <?php woocommerce_get_template( 'loop/rating.php' ); ?>

        </figcaption>

<?php

	woocommerce_get_template( 'loop/sale-flash.php' );

	echo wp_get_attachment_image( get_post_thumbnail_id() );

?>

	</figure>

    <div class="text">

<?php

}



add_action( 'woocommerce_after_shop_loop_item_title', 'cs_after_loop_title_code' );

function cs_after_loop_title_code()

{

	woocommerce_get_template( 'loop/price.php' );

?>

</div>

<?php

}

//Shop loop items changings ends



?>