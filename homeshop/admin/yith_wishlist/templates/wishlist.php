<?php
/**
 * Wishlist page template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 1.0.0
 */
 
global $wpdb, $yith_wcwl, $woocommerce, $_SESSION;

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
    } elseif( yith_usecookies() ) {
        $count[0]['cnt'] = count( yith_getcookie( 'yith_wcwl_products' ) );
    } else {
        $count[0]['cnt'] = count( $_SESSION['yith_wcwl_products'] );
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

if( is_user_logged_in() )
    { $wishlist = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM `" . YITH_WCWL_TABLE . "` WHERE `user_id` = %s" . $limit_sql, $user_id ), ARRAY_A ); }
elseif( yith_usecookies() )
    { $wishlist = yith_getcookie( 'yith_wcwl_products' ); }
else
    { $wishlist = $_SESSION['yith_wcwl_products']; }

// Start wishlist page printing
wc_print_notices();  ?>
<div id="yith-wcwl-messages"></div>


<div class="row">
                    
	<!-- Heading -->
	<div class="col-lg-12 col-md-12 col-sm-12">
		
		<div class="carousel-heading">
		<?php
		do_action( 'yith_wcwl_before_wishlist_title' );

		$wishlist_title = get_option( 'yith_wcwl_wishlist_title' );
		if( !empty( $wishlist_title ) )
			{ echo apply_filters( 'yith_wcwl_wishlist_title', '<h4>' . $wishlist_title . '</h4>' ); }

		do_action( 'yith_wcwl_before_wishlist' );
		?>
		</div>
		
	</div>
	<!-- /Heading -->

						
	<div class="col-lg-6 col-md-6 col-sm-6">
		<div class="category-results">
			<p>
			<?php _e( 'Results', 'homeshop' ) ?> 1- <?php echo count( $wishlist ); ?>
			</p>
		</div>
	</div>					
						
	 <div class="col-lg-6 col-md-6 col-sm-6">

	</div>					
	
</div>					
						
						
						
<div class="row">
                    	
	<div class="col-lg-12 col-md-12 col-sm-12">						

<form id="yith-wcwl-form" action="<?php echo esc_url( $yith_wcwl->get_wishlist_url() ) ?>" method="post">

    <table class="wishlist-table" cellspacing="0">
	
	<tr>
		<th class="wishlist-image"><?php _e( 'Product Images', 'homeshop' ) ?></th>
		<th><?php _e( 'Title/Category', 'homeshop' ) ?></th>
		<th><?php _e( 'Price', 'homeshop' ) ?></th>
		<th><?php _e( 'Action', 'homeshop' ) ?></th>
	</tr>

	

            <?php            
            if( count( $wishlist ) > 0 ) :
                foreach( $wishlist as $values ) :   
                    if( !is_user_logged_in() ) {
        				if( isset( $values['add-to-wishlist'] ) && is_numeric( $values['add-to-wishlist'] ) ) {
        					$values['prod_id'] = $values['add-to-wishlist'];
        					$values['ID'] = $values['add-to-wishlist'];
        				} else {
        					$values['prod_id'] = $values['product_id'];
        					$values['ID'] = $values['product_id'];
        				}
        			}
                                     
                    $product_obj = new WC_Product( $values['prod_id'] );
                    
                    if( $product_obj->exists() ) : ?>
					
					
					
			    <tr id="yith-wcwl-row-<?php echo $values['ID'] ?>">
					<td class="wishlist-image">
						<a href="<?php echo esc_url( get_permalink( apply_filters( 'woocommerce_in_cart_product', $values['prod_id'] ) ) ) ?>">
							<?php echo $product_obj->get_image('shop_single'); ?>
						</a>
					</td>
					<td class="wishlist-info">
						<h5>
						 <a href="<?php echo esc_url( get_permalink( apply_filters( 'woocommerce_in_cart_product', $values['prod_id'] ) ) ) ?>"><?php echo apply_filters( 'woocommerce_in_cartproduct_obj_title', $product_obj->get_title(), $product_obj ) ?></a>
						</h5>
						
						
						<?php echo $product_obj->get_categories( ' ', '<span class="product-category">', '</span>' ); ?>

						<?php
						$availability = $product_obj->get_availability();
						$stock_status = $availability['class'];
						
						if( $stock_status == 'out-of-stock' ) {
							$stock_status = "Out";
							echo '<span class="wishlist-out-of-stock">' . __( 'Out of Stock', 'homeshop' ) . '</span>';   
						} else {
							$stock_status = "In";
							echo '<span class="wishlist-in-stock">' . __( 'In Stock', 'homeshop' ) . '</span>';
						}
						?>
						
						
						<?php	
						if (get_option('woocommerce_enable_review_rating') != 'no') {
							$num_rating = (int) $product_obj->get_average_rating();
						?>
						
						<br><div class="rating readonly-rating" data-score="<?php echo $num_rating; ?>"></div>
						
						<?php } ?>
						
						
						
					</td>
					<td class="wishlist-price">
						<span class="price">
						
						 <?php
                            if( get_option( 'woocommerce_display_cart_prices_excluding_tax' ) == 'yes' )
                                { echo apply_filters( 'woocommerce_cart_item_price_html', woocommerce_price( $product_obj->get_price_excluding_tax() ), $values, '' ); }
                            else
                                { echo apply_filters( 'woocommerce_cart_item_price_html', woocommerce_price( $product_obj->get_price() ), $values, '' ); }    
                            ?>
						
						</span>
					</td>
					<td class="wishlist-actions">
	
						
						<?php echo YITH_WCWL_UI::add_to_cart_button( $values['prod_id'], $availability['class'] ) ?>
						 
						<a href="javascript:void(0)" onclick="remove_item_from_wishlist( '<?php echo esc_url( $yith_wcwl->get_remove_url( $values['ID'] ) )?>', 'yith-wcwl-row-<?php echo $values['ID'] ?>');" class="remove" title="<?php _e( 'Remove this product', 'homeshop' ) ?>">
							<span class="add-to-trash">
								<span class="action-wrapper">
									<i class="icons icon-trash-8"></i>
									<span class="action-name"><?php _e( 'Remove', 'homeshop' ) ?></span>
								</span>
							</span>
						</a>
						
					</td>
				</tr>
					

                    <?php
                    endif;
                endforeach;
            else: ?>
                <tr>
                    <td colspan="4" class="wishlist-empty"><?php _e( 'No products were added to the wishlist', 'homeshop' ) ?></td>
                </tr>       
            <?php
            endif;
            
            if( isset( $page_links ) ) : ?>
            <tr>
                <td colspan="4"><?php echo $page_links ?></td>
            </tr>
            <?php endif ?>
      
		
     </table>
     <?php
     do_action( 'yith_wcwl_after_wishlist' );
     
     yith_wcwl_get_template( 'share.php' );
     
     do_action( 'yith_wcwl_after_wishlist_share' );
     ?>
</form>

	</div>					
	
</div>