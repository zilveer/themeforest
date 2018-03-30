<?php

global $woocommerce;


/*
* Check if Woocommerce plugin is enabled.
*/
function mk_woocommerce_enabled() {
	if ( class_exists( 'woocommerce' ) ) { return true; }
	return false;
}

if ( !mk_woocommerce_enabled() ) { return false; }
/******************/




require_once (THEME_INCLUDES . "/woocommerce-quantity-increment/woocommerce-quantity-increment.php");

/*
* Declares support to woocommerce
*/
add_theme_support( 'woocommerce' );
/******************/




/*
* Overrides woocommerce styles and scripts modified and created by theme
*/
if(!function_exists('mk_woocommerce_assets')) {
function mk_woocommerce_assets() {
	$theme_data = wp_get_theme("ken");
	wp_enqueue_style( 'mk-woocommerce', THEME_STYLES.'/mk-woocommerce.css', false, $theme_data['Version'], 'all'  );
}
}

add_filter( 'woocommerce_enqueue_styles', 'mk_woocommerce_assets' );
/******************/






/*
Adds Woocommerce Payment process in cart, checkout and order recieved page
*/

if(!function_exists('mk_woocommerce_cart_process_steps')) {
	function mk_woocommerce_cart_process_steps() {

		$cart = $checkout = $complete = '';

		if(is_cart() || is_checkout() || is_order_received_page()) {


		if(is_cart()) {
			$cart = 'active';
		}

		if(is_checkout()) {
			$checkout = 'active';
			$cart = 'active';	
		}
		if(is_order_received_page()) {
			$checkout = 'active';
			$cart = 'active';	
			$complete = 'active';		
		}

		?>

		<div class="woocommerce-process-steps">
			<ul>
				<li class="<?php echo $cart; ?>">
					<span><?php _e('SHOPPING CART', 'mk_framework'); ?></span>
					<i class="mk-icon-close"></i>
				</li>
				<li class="<?php echo $checkout; ?>">
					<span><?php _e('PROCEED TO CHECKOUT', 'mk_framework'); ?></span>
					<i class="mk-icon-close"></i>
				</li>
				<li class="<?php echo $complete; ?>">
					<span><?php _e('SUBMIT ORDER', 'mk_framework'); ?></span>
					<i class="mk-icon-close"></i>
				</li>
			</ul>
		</div>

		<?php

			}	
	}
}
add_action('page_add_before_content', 'mk_woocommerce_cart_process_steps');

/******************/


/*
* Removes woocommerce defaults
*/
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
remove_action( 'woocommerce_pagination', 'woocommerce_catalog_ordering', 20 );
remove_action( 'woocommerce_pagination', 'woocommerce_pagination', 10 );
remove_action( 'woocommerce_before_single_product', array( $woocommerce, 'show_messages' ), 10 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

remove_action( 'woocommerce_single_product_summary',  'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary',  'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary',  'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary',  'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary',  'woocommerce_template_single_meta', 40 );


add_action( 'woocommerce_single_product_summary',  'woocommerce_template_single_title', 6 );
add_action( 'woocommerce_single_product_summary',  'woocommerce_template_single_price', 5 );
add_action( 'woocommerce_single_product_summary',  'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_single_product_summary',  'woocommerce_template_single_add_to_cart', 30 );
add_action( 'woocommerce_single_product_summary',  'woocommerce_template_single_meta', 40 );







/******************/




/*
* Create theme global HTML wrappers.
*/
add_action( 'woocommerce_before_main_content', 'mk_woocommerce_output_content_wrapper', 10 );
add_action( 'woocommerce_after_main_content', 'mk_woocommerce_output_content_wrapper_end', 10 );


function mk_woocommerce_output_content_wrapper() {
	global $post, $mk_settings;


	if ( is_page() ) {
		$layout = get_post_meta( $post->ID, '_layout', true );
	} else if(is_single()) {
		$layout = $mk_settings['woo-single-layout'];
	} else {
		$layout = $mk_settings['woo-shop-layout'];
	}


?>
<div id="theme-page" class="page-master-holder" <?php echo get_schema_markup('main'); ?>>

  	<div class="background-img background-img--page"></div>
  	
	<div class="mk-main-wrapper-holder">
		<div class="theme-page-wrapper mk-main-wrapper <?php echo $layout; ?>-layout mk-grid vc_row-fluid">
			<div class="theme-content">
<?php
}


function mk_woocommerce_output_content_wrapper_end() {
	global $post, $mk_settings;

	if ( is_page() ) {
		$layout = get_post_meta( $post->ID, '_layout', true );
	} else if(is_single()) {
		$layout = $mk_settings['woo-single-layout'];
	} else {
		$layout = $mk_settings['woo-shop-layout'];
	}


?>
		</div>
		<?php if ( $layout != 'full' ) get_sidebar(); ?>
		<div class="clearboth"></div>
	</div>
	</div>
</div>

<?php
}

/******************/





/*
* Add woommerce share buttons
*/

add_action( 'woocommerce_share', 'mk_woocommerce_share' );

function mk_woocommerce_share() {
	global $post;
	$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );

	$output = '<div class="woocommerce-share"><ul class="single-social-share">';
		$output .= '<li><a class="facebook-share" data-title="'.get_the_title().'" data-url="'.get_permalink().'" href="#"><i class="mk-icon-facebook"></i></a></li>';
		$output .= '<li><a class="twitter-share" data-title="'.get_the_title().'" data-url="'.get_permalink().'" href="#"><i class="mk-icon-twitter"></i></a></li>';
		$output .= '<li><a class="googleplus-share" data-title="'.get_the_title().'" data-url="'.get_permalink().'" href="#"><i class="mk-icon-google-plus"></i></a></li>';
		$output .= '<li><a class="linkedin-share" data-title="'. get_the_title() .'" data-url="'.get_permalink().'" href="#"><i class="mk-icon-linkedin"></i></a></li>';
		$output .= '<li><a class="pinterest-share" data-image="'.$image_src_array[0].'" data-title="'.get_the_title().'" data-url="'.get_permalink().'" href="#"><i class="mk-icon-pinterest"></i></a></li>';
				if( function_exists('mk_love_this') ) {
					ob_start();
					mk_love_this();
					$output .= '<li><div class="mk-love-holder">'.ob_get_clean().'</div></li>';
				}
	$output .= '</ul><div class="clearboth"></div></div>';

	echo $output;

}



/*
* Updates Header Shopping cart fragment
*/
add_filter('add_to_cart_fragments', 'mk_header_add_to_cart_fragment');
if ( ! function_exists( 'mk_header_add_to_cart_fragment' ) ) { 
    function mk_header_add_to_cart_fragment( $fragments ) {
        ob_start();

?>
     <li class="mk-shopping-cart">

			<a href="<?php echo esc_url( WC()->cart->get_checkout_url() ); ?>" class="mk-cart-link">
				<i class="mk-theme-icon-cart2"></i><span><?php echo WC()->cart->cart_contents_count; ?></span> 
			</a>


				<div class="mk-shopping-box">
					<div class="shopping-box-header"><span><span class="mk-skin-color"><i class="mk-theme-icon-cart2"></i><?php echo WC()->cart->cart_contents_count; ?> <?php _e('Items', 'mk_framework'); ?></span> <?php _e('In your Shopping Bag', 'mk_framework'); ?></span></div>
                    <div class="mk-shopping-list">
                    <?php                                    
                        if (sizeof(WC()->cart->cart_contents)>0) : foreach (WC()->cart->cart_contents as $cart_item_key => $cart_item) :
                            $_product = $cart_item['data'];                                            
                            if ($_product->exists() && $cart_item['quantity']>0) : 

                          	echo '<div class="mini-cart-item">';

                          			echo '<a class="mini-cart-image" href="'.get_permalink($cart_item['product_id']).'">' . $_product->get_image().'</a>';	
                          		 
                          			 $product_title = $_product->get_title();
                                     echo '<a class="mini-cart-title" href="'.get_permalink($cart_item['product_id']).'">' . apply_filters('woocommerce_cart_widget_product_title', $product_title, $_product) . '</a>';
                                     echo '<div class="mini-cart-price">'.__('Unit Price', 'mk_framework').': '.woocommerce_price($_product->get_price()).'</div>';
                                     echo '<div class="mini-cart-quantity">'.__('Quantity', 'mk_framework').': '.$cart_item['quantity'].'</div>';
                                     echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="mini-cart-remove" title="%s"><i class="mk-theme-icon-close"></i></a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __('Remove this item', 'mk_framework') ), $cart_item_key );

                          	echo '</div>';
                       
                        endif;                                        
                        endforeach;
                    ?>

                    </div>
                    <?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>
                        <div class="mini-cart-buttons">
	                        <a href="<?php echo WC()->cart->get_cart_url(); ?>" class="mk-button mini-cart-button medium"><i class="mk-theme-icon-next-big"></i><?php _e('View Cart', 'mk_framework'); ?></a>   
	                        <a href="<?php echo WC()->cart->get_checkout_url(); ?>" class="mk-button mini-cart-button medium"><i class="mk-theme-icon-cart2"></i><?php _e('Checkout', 'mk_framework'); ?></a>
                    	</div>
                    <?php endif; ?>	
                        
                        <?php                                        
                        else: 
                        	echo '<p class="empty">'.__('No products in the cart.','mk_framework').'</p>'; 
                        endif;                                    
                    ?>                                                                        
                </div>
	</li>
<?php
        
        $fragments['li.mk-shopping-cart'] = ob_get_clean();        
        return $fragments;
    }
}





/*
* Header Checkout box.
*/
if ( !function_exists( 'mk_header_checkout' ) ) {
function mk_header_checkout($location) {

	global $woocommerce, $mk_settings;

	if ( !$woocommerce) { return false; }

		if($mk_settings['checkout-box']) :

		?>

<li class="mk-shopping-cart">

	
	<a href="<?php echo esc_url( WC()->cart->get_checkout_url() ); ?>" class="mk-cart-link">
		<i class="mk-theme-icon-cart2"></i><span><?php echo WC()->cart->cart_contents_count; ?></span> 
	</a>

	
	<?php /* Shopping Box, the content will be updated via ajax, you can edit @mk_header_add_to_cart_fragment() */ ?>
	<div class="mk-shopping-box">
		<div class="shopping-box-header"><span><span class="mk-skin-color"><i class="mk-theme-icon-cart2"></i><?php echo WC()->cart->cart_contents_count; ?> <?php _e('Items', 'mk_framework'); ?></span> <?php _e('In your Shopping Bag', 'mk_framework'); ?></span></div>
			<?php if (WC()->cart->cart_contents_count == 0) {
				echo '<p class="empty">'.__('No products in the cart.','mk_framework').'</p>';
			?>
			<?php } ?>
	</div>
	<?php /***********/ ?>


</li>
<li class="mk-responsive-shopping-cart">

	
	<a href="<?php echo esc_url( WC()->cart->get_checkout_url() ); ?>" class="mk-responsive-cart-link">
		<i class="mk-theme-icon-cart2"></i><span><?php echo WC()->cart->cart_contents_count; ?></span> 
	</a>

	
	<?php /* Shopping Box, the content will be updated via ajax, you can edit @mk_header_add_to_cart_fragment() */ ?>
	<div class="mk-shopping-box">
		<div class="shopping-box-header"><span><span class="mk-skin-color"><i class="mk-theme-icon-cart2"></i><?php echo WC()->cart->cart_contents_count; ?> <?php _e('Items', 'mk_framework'); ?></span> <?php _e('In your Shopping Bag', 'mk_framework'); ?></span></div>
			<?php if (WC()->cart->cart_contents_count == 0) {
				echo '<p class="empty">'.__('No products in the cart.','mk_framework').'</p>';
			?>
			<?php } ?>
	</div>
	<?php /***********/ ?>
</li>
		<?php 
		endif;	
	}
}

add_action( 'header_checkout', 'mk_header_checkout' );
/***************************************/





remove_action( 'woocommerce_proceed_to_checkout', 'woocommerce_button_proceed_to_checkout', 20 );

add_action( 'woocommerce_proceed_to_checkout', 'mk_woocommerce_button_proceed_to_checkout', 20 );

if ( ! function_exists( 'mk_woocommerce_button_proceed_to_checkout' ) ) {

	/**
	 * Output the proceed to checkout button.
	 *
	 * @subpackage	Cart
	 */
	function mk_woocommerce_button_proceed_to_checkout() {
		$checkout_url = WC()->cart->get_checkout_url();

		?>
		<div class="button-icon-holder alt checkout-button-holder"><a href="<?php echo $checkout_url; ?>" class="checkout-button"><i class="mk-theme-icon-cart"></i><?php _e( 'Proceed to Checkout', 'mk_framework' ); ?></a></div>
		<?php
	}
}



function mk_woocommerce_pagination($pages = '', $range = 2)
{  
	 ob_start();
     $showitems = ($range * 2)+1;  
     global $paged;
     if(empty($paged)) $paged = 1;
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
     if(1 != $pages)
     {
         echo "<ul>";
         if($paged > 1 && $showitems < $pages) echo "<li><a class='page-numbers prev' href='".get_pagenum_link($paged - 1)."'><i class='mk-theme-icon-prev-big'></i></a></li>";
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<li><span class='page-numbers current'>".$i."</span></li>":"<li><a class='page-numbers' href='".get_pagenum_link($i)."' >".$i."</a></li>";
             }
         }
         if ($paged < $pages && $showitems < $pages) echo "<li><a class='page-numbers next' href='".get_pagenum_link($paged + 1)."'><i class='mk-theme-icon-next-big'></i></a></li>"; 
         echo "</ul>\n";
     }
	 
	 return ob_get_clean();
}
