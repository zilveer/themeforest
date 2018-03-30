<?php
/**
 * Wishlist page template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 1.0.6
 */
 
?>

<div class="container">

<?php
 
global $wpdb, $yith_wcwl, $woocommerce, $catalog_mode;

$myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );
$myaccount_page_url = $shop_url = "";
if ( $myaccount_page_id ) {
  $myaccount_page_url = get_permalink( $myaccount_page_id );
}

$shop_page_url = "";
if ( version_compare( WOOCOMMERCE_VERSION, "2.1.0" ) >= 0 ) {
	$shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
} else {
	$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
}

$user_id = "";

if( isset( $_GET['user_id'] ) && !empty( $_GET['user_id'] ) ) {
    $user_id = $_GET['user_id'];
} elseif( is_user_logged_in() ) {
    $user_id = get_current_user_id();
}

$current_page = 1;
$limit_sql = '';

if( $pagination == 'yes' ) {
    $count = array();
    
    if( is_user_logged_in() ) {
        $count = $wpdb->get_results( $wpdb->prepare( 'SELECT COUNT(*) as `cnt` FROM `' . YITH_WCWL_TABLE . '` WHERE `user_id` = %d', $user_id  ), ARRAY_A );
        $count = $count[0]['cnt'];
    } else {
        $count[0]['cnt'] = count( yith_getcookie( 'yith_wcwl_products' ) );
    } 
    
    $total_pages = $count/$per_page;
    if( $total_pages > 1 ) {
        $current_page = max( 1, get_query_var( 'page' ) );
        
        $page_links = paginate_links( array(
            'base' => get_pagenum_link( 1 ) . '%_%',
            'format' => '&page=%#%',
            'current' => $current_page,
            'total' => $total_pages,
            'show_all' => true
        ) );
    }
    
    $limit_sql = "LIMIT " . ( $current_page - 1 ) * 1 . ',' . $per_page;
}

if ($user_id != "") {
$wishlist = $wpdb->get_results(
				$wpdb->prepare( "SELECT * FROM `" . YITH_WCWL_TABLE . "` WHERE `user_id` = %s" . $limit_sql, $user_id ),
			ARRAY_A );
} else {
	$wishlist = yith_getcookie( 'yith_wcwl_products' );
} 

// Start wishlist page printing
if ( version_compare( WOOCOMMERCE_VERSION, "2.1.0" ) >= 0 ) {
wc_print_notices();
} else {
$woocommerce->show_messages();
}
 ?>
	<div id="yith-wcwl-messages"></div>
	
	<?php sf_woo_help_bar(); ?>
	
	<div class="my-account-left">
	
		<h4 class="lined-heading"><span><?php _e("My Account", "swiftframework"); ?></span></h4>
		<ul class="nav my-account-nav">
			<?php if( is_user_logged_in() ) { ?>
			<li><a href="<?php echo $myaccount_page_url; ?>"><?php _e("Back to my account", "swiftframework"); ?></a></li>	
			<?php } else { ?>
			<li><a href="<?php echo $shop_page_url; ?>"><?php _e("Shop", "swiftframework"); ?></a></li>		
			<li><a href="<?php echo $myaccount_page_url; ?>"><?php _e("Create Account / Login", "swiftframework"); ?></a></li>	
			<?php } ?>
		</ul>
	
	</div>
	
	<div class="my-account-right tab-content">
	
		<form id="yith-wcwl-form" action="<?php echo esc_url( $yith_wcwl->get_wishlist_url() ) ?>" method="post">
		    <?php
		    do_action( 'yith_wcwl_before_wishlist_title' );
		    
		    $wishlist_title = get_option( 'yith_wcwl_wishlist_title' );
		    if( !empty( $wishlist_title ) )
		        { echo apply_filters( 'yith_wcwl_wishlist_title', '<h3>' . $wishlist_title . '</h3>' ); }
		    
		    do_action( 'yith_wcwl_before_wishlist' );
		    ?>
		    <table class="shop_table cart wishlist_table" cellspacing="0">
		    	<thead>
		    		<tr>
		    			<th class="product-thumbnail"><span class="nobr"><?php _e( 'Item', 'swiftframework' ) ?></span></th>
		    			<th class="product-name"><span class="nobr"><?php _e( 'Product Name', 'swiftframework' ) ?></span></th>
		    			<?php if( get_option( 'yith_wcwl_price_show' ) == 'yes' ) { ?><th class="product-price"><span class="nobr"><?php _e( 'Unit Price', 'swiftframework' ) ?></span></th><?php } ?>
		    			<?php if( get_option( 'yith_wcwl_stock_show' ) == 'yes' ) { ?><th class="product-stock-status"><span class="nobr"><?php _e( 'Stock Status', 'swiftframework' ) ?></span></th><?php } ?>
		                <?php if (!$catalog_mode && get_option( 'yith_wcwl_add_to_cart_show' ) == 'yes') { ?>
		                <th class="product-add-to-bag"><span class="nobr"><?php _e( 'Actions', 'swiftframework' ) ?></span></th>
		                <?php } ?>
		    			<th class="product-remove"></th>
		    		</tr>
		    	</thead>
		        <tbody>
		            <?php            
		            if( count( $wishlist ) > 0 ) :
		                foreach( $wishlist as $item ) :   
		                    global $product;
            	            if ( function_exists( 'wc_get_product' ) ) {
            		            $product = wc_get_product( $item['prod_id'] );
            	            }
            	            else{
            		            $product = get_product( $item['prod_id'] );
            	            }
            
                            if( $product !== false && $product->exists() ) :
            	                $availability = $product->get_availability();
            	                $stock_status = $availability['class'];
                            ?>
                             <tr id="yith-wcwl-row-<?php echo $item['prod_id'] ?>" data-row-id="<?php echo $item['prod_id'] ?>">
		                        <td class="product-thumbnail">
		                            <a href="<?php echo esc_url( get_permalink( apply_filters( 'woocommerce_in_cart_product', $item['prod_id'] ) ) ) ?>">
		                                <?php echo $product->get_image() ?>
		    						</a>
								</td>
		                        <td class="product-name">
		                            <a href="<?php echo esc_url( get_permalink( apply_filters( 'woocommerce_in_cart_product', $item['prod_id'] ) ) ) ?>"><?php echo apply_filters( 'woocommerce_in_cartproduct_title', $product->get_title(), $product ) ?></a>
		                        </td>
		                        <?php if( get_option( 'yith_wcwl_price_show' ) == 'yes' ) { ?>
		                        <td class="product-price">
		                            <?php
		                            if( $product->price != '0' ) {
		                                if( get_option( 'woocommerce_tax_display_cart' ) == 'excl' )
		                                    { echo apply_filters( 'woocommerce_cart_item_price_html', woocommerce_price( $product->get_price_excluding_tax() ), $item, '' ); }
		                                else
		                                    { echo apply_filters( 'woocommerce_cart_item_price_html', woocommerce_price( $product->get_price() ), $item, '' ); }
		                            } else {
		                                echo apply_filters( 'yith_free_text', __( 'Free', 'swiftframework' ) );
		                            }
		                            ?>
		                        </td>
		                        <?php } ?>
		                        <?php if( get_option( 'yith_wcwl_stock_show' ) == 'yes' ) { ?>
		                        <td class="product-stock-status">
		                            <?php
		                            $availability = $product->get_availability();
		                            $stock_status = $availability['class'];
		                            
		                            if( $stock_status == 'out-of-stock' ) {
		                                $stock_status = "Out";
		                                echo '<span class="wishlist-out-of-stock">' . __( 'Out of Stock', 'swiftframework' ) . '</span>';   
		                            } else {
		                                $stock_status = "In";
		                                echo '<span class="wishlist-in-stock">' . __( 'In Stock', 'swiftframework' ) . '</span>';
		                            }
		                            ?>
		                        </td>
		                        <?php } ?>
		                        <?php if (!$catalog_mode && $show_add_to_cart) { ?>
		                        <td class="product-add-to-cart">
		                          <?php if ( isset( $stock_status ) && $stock_status != 'Out' ): ?>
		                              <?php
		                              if( function_exists( 'wc_get_template' ) ) {
		                                  wc_get_template( 'loop/add-to-cart.php' );
		                              }
		                              else{
		                                  woocommerce_get_template( 'loop/add-to-cart.php' );
		                              }
		                              ?>
		                          <?php endif ?>
		                        </td>
		                        <?php } ?>
		                        
		                        <?php if ( version_compare( get_option('yith_wcwl_version'), "2.0" ) >= 0 ) {    ?>
		                        			<td class="product-remove"><div> <a href="<?php echo esc_url( add_query_arg( 'remove_from_wishlist', $item['prod_id']) ) ?>" class="remove remove_from_wishlist" title="<?php _e( 'Remove this product', 'yit' ) ?>"><i class="fa-times"></i></a></div></td>
		                        <?php } else { ?>	
		                        			<td class="product-remove"><div><a href="javascript:void(0)" onclick="remove_item_from_wishlist( '<?php echo esc_url( $yith_wcwl->get_remove_url( $item['ID'] ) )?>', 'yith-wcwl-row-<?php echo $item['ID'] ?>');" class="remove"  data-product-id="<?php echo $item['prod_id']; ?>" title="<?php _e( 'Remove this product', 'swiftframework' ) ?>"><i class="fa-times"></i></a></td>
		                        <?php } ?>
		                    </tr>
		                    <?php
		                    endif;
		                endforeach;
		            else: ?>
		                <tr>
		                    <td colspan="6" class="wishlist-empty"><?php _e( 'Your wishlist is currently empty.', 'swiftframework' ) ?></td>
		                </tr>       
		            <?php
		            endif;
		            
		            if( isset( $page_links ) ) : ?>
		            <tr>
		                <td colspan="6"><?php echo $page_links ?></td>
		            </tr>
		            <?php endif ?>
		        </tbody>
		     </table>
		     <?php do_action( 'yith_wcwl_after_wishlist' );   
		     
		     yith_wcwl_get_template( 'share.php' );
		     
		     do_action( 'yith_wcwl_after_wishlist_share' );
		     ?>
		</form>
	</div>

</div>
