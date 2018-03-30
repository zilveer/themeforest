<?php
//remove woocommerce breradcrumb
remove_action ( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
remove_action ( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20, 0 );
remove_action ( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30, 0 );
remove_action ( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
remove_action ( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action ( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
remove_action ( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
remove_action ( "woocommerce_sidebar", "woocommerce_get_sidebar", 10 );
remove_action ( 'woocommerce_before_single_product_summary', "woocommerce_show_product_sale_flash", 10 );
remove_action ( "woocommerce_single_product_summary", "woocommerce_template_single_price", 10 );
remove_action ( 'woocommerce_proceed_to_checkout', 'woocommerce_button_proceed_to_checkout', 20 );
add_action('woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 );
remove_action ( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action ( "woocommerce_single_product_summary", "woocommerce_template_single_price", 21 );
remove_action ( "woocommerce_after_single_product_summary", "woocommerce_output_product_data_tabs", 10 );
remove_action ( "woocommerce_after_single_product_summary", "woocommerce_upsell_display", 15 );
remove_action ( "woocommerce_after_single_product_summary", "woocommerce_output_related_products", 20 );

add_action ( "woocommerce_single_product_summary", "mango_add_social_share", 42 );
add_filter ( 'woocommerce_show_page_title', function ( $args ) {
    return false;
} );

add_action ( "mango_shop_custom_action", "woocommerce_show_product_loop_sale_flash", 3 );
add_action ( "woocommerce_before_single_product_summary", "mango_product_tabs", 3 );

add_action ( "woocommerce_before_single_product_summary", "mango_upsells", 10 );
add_action ( "woocommerce_after_cart" , 'mango_cross_sell',20);

//woocommerce vendor start 


 if(class_exists('WC_Vendors') ){
add_action( 'woocommerce_after_shop_loop_item_title', 'mango_wpvendors_product_seller_name', 2 );
remove_action( 'woocommerce_product_meta_start', array( 'WCV_Vendor_Cart', 'sold_by_meta' ), 10, 2 );
add_action( 'woocommerce_product_meta_start', 'mango_wc_vendors_sold_by_meta', 25, 2 );
remove_action( 'woocommerce_after_shop_loop_item', array('WCV_Vendor_Shop', 'template_loop_sold_by'), 9 );
}

	


global $mango_settings;
 if(class_exists('WC_Vendors') ){
if(!$mango_settings['mango_wcvendors_product_tab']){
remove_filter( 'woocommerce_product_tabs', array( 'WCV_Vendor_Shop', 'seller_info_tab' ) );
}}


 if(class_exists('WC_Vendors') ){
add_filter( 'user_contactmethods', 'mango_add_to_author_profile', 10, 1);
function mango_add_to_author_profile( $contactmethods ) {

	$contactmethods['phone_number'] 	= __( 'Phone Number', 'mango' );
	$contactmethods['facebook_url'] 	= __( 'Facebook Profile URL', 'mango' );
	$contactmethods['gplus_url']		= __( 'Google Plus Profil URL', 'mango' );
	$contactmethods['twitter_url'] 		= __( 'Twitter Profile URL', 'mango' );
	$contactmethods['linkedin_url'] 	= __( 'Linkedin Profile URL', 'mango' );
	$contactmethods['youtube_url'] 		= __( 'Youtube Profile URL', 'mango' );
	$contactmethods['flickr_url'] 		= __( 'Flickr Profile URL', 'mango' );

	return $contactmethods;
}
 }

 if(class_exists('WC_Vendors') ){
function mango_wpvendors_product_seller_name() {
	  global $mango_settings;
	$product_id = get_the_ID();
	$author     = WCV_Vendors::get_vendor_from_product( $product_id );
	$vendor_display_name = WC_Vendors::$pv_options->get_option( 'vendor_display_name' ); 
	switch ($vendor_display_name) {
	    case 'display_name':
	    	$vendor = get_userdata( $author );
	        $vendor_name = $vendor->display_name;
	        break;
	    case 'user_login': 
	    	$vendor = get_userdata( $author );
	        $vendor_name = $vendor->user_login;
	        break;
	    default:
	        $vendor_name = WCV_Vendors::get_vendor_shop_name( $author ); 
	        break;
	}
	$sold_by = WCV_Vendors::is_vendor( $author ) ? sprintf( '<a href="%s">%s</a>', WCV_Vendors::get_vendor_shop_page( $author), $vendor_name ) : get_bloginfo( 'name' );
	if($mango_settings['mango_wcvendors_shop_soldby']){
	echo '<p class="product-seller-name">' . apply_filters('wcvendors_sold_by_in_loop', __( 'By', 'mango' )). ' <span>' . $sold_by . '</span> </p>';
	}
}
 }

 if(class_exists('WC_Vendors') ){
function mango_wc_vendors_sold_by_meta() {
	  global $mango_settings;
	$author_id = get_the_author_meta( 'ID' );
	$vendor_display_name = WC_Vendors::$pv_options->get_option( 'vendor_display_name' ); 
	switch ($vendor_display_name) {
	    case 'display_name':
	    	$vendor = get_userdata( $author_id );
	        $vendor_name = $vendor->display_name;
	        break;
	    case 'user_login': 
	    	$vendor = get_userdata( $author_id );
	        $vendor_name = $vendor->user_login;
	        break;
	    default:
	        $vendor_name = WCV_Vendors::get_vendor_shop_name( $author_id ); 
	        break;
	}
	$sold_by = WCV_Vendors::is_vendor( $author_id ) ? sprintf( '<a href="%s">%s</a>', WCV_Vendors::get_vendor_shop_page( $author_id ), $vendor_name ) :      get_bloginfo( 'name' );

if($mango_settings['mango_wcvendors_product_soldby']){
	echo '<ul class="list-item-details"><li><span class="data-type">'.__( 'Sold by : ', 'mango' ).'</span><span class="value">'.$sold_by.'</span></li></ul>';
}
}
 }

 
 
 
 
add_action( 'show_user_profile', 'mango_user_profile_fields' );
add_action( 'edit_user_profile', 'mango_user_profile_fields' );

function mango_user_profile_fields( $user ) { 

$r = get_user_meta( $user->ID, 'picture', true );
    ?>


<!-- Artist Photo Gallery -->
<h3><?php _e("Public Profile - Gallery", "blank"); ?></h3>

<table class="form-table">

<tr>
        <th scope="row">Picture</th>
        <td><input type="file" name="picture" value="" />
        </td>
	
    </tr>
	<tr>
		<td>
		
           <?php //print_r($r); 
           if($r){
                    $r = $r['url'];
                    echo "<img width='200px' src='$r' />";
		   }
           ?>
		</td>
	</tr>

</table> 



<?php
}
add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );
	
	function save_extra_user_profile_fields( $user_id ) {

if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }

$_POST['action'] = 'wp_handle_upload';
$r = wp_handle_upload( $_FILES['picture'] );
update_user_meta( $user_id, 'picture', $r, get_user_meta( $user_id, 'picture', true ) );

}


add_action('user_edit_form_tag', 'make_form_accept_uploads');
function make_form_accept_uploads() {
    echo ' enctype="multipart/form-data"';
}

//woocommerce vendor End  

function mango_product_tabs () {
    global $product, $post, $mango_settings;
    $ver = mango_single_product_version ();
    if ( $ver == "v_1" ) {
        add_action ( "woocommerce_after_single_product", "woocommerce_output_product_data_tabs", 44 );
    } elseif ( $ver == "v_2" ) {
        add_action ( "woocommerce_after_single_product_summary", "woocommerce_output_product_data_tabs", 10 );
    }
	 elseif ( $ver == "v_3" ) {
        add_action ( "woocommerce_after_single_product", "woocommerce_output_product_data_tabs", 10 );
    }
}

function mango_upsells () {
          add_action ( "woocommerce_after_single_product", "woocommerce_upsell_display", 45 );
    }
function mango_cross_sell () {
   woocommerce_cross_sell_display();
}

function mango_shop_view () {
    global $mango_settings;
    if ( isset( $_GET[ 'view' ] ) && ( $_GET[ 'view' ] == 'list' || $_GET[ 'view' ] == 'grid' ) ) {
        return apply_filters("mango_filter_shop_view",$_GET[ 'view' ]);
    } else {
        $view = '';
        if(is_tax( array("product_cat","product_tag") )){
            $tax_id = get_queried_object_id();
            $tax_data =  get_option( 'tax_meta_'.$tax_id);
            if(isset($tax_data["mango_product_cat_view"]) && $tax_data["mango_product_cat_view"] !=''){
                if(in_array($tax_data["mango_product_cat_view"], array("v_1","v_2","v_3","v_4") )){
                    $view= 'grid';
                }elseif(in_array($tax_data["mango_product_cat_view"], array("list","list_right") )){
                    $view = "list";
                }
            }
        }
        if(!$view){
            $view = $mango_settings[ 'mango_products_view' ];
        }
        return apply_filters("mango_filter_shop_view",$view);
    }
}
function mango_shop_cat_list_grid_ver(){
    if( is_product_taxonomy() ){
        $tax_id = get_queried_object_id();
        $tax_data =  get_option( 'tax_meta_'.$tax_id);
        if(isset($tax_data["mango_product_cat_view"]) && $tax_data["mango_product_cat_view"] !=''){

            return $tax_data["mango_product_cat_view"];
        }else{
            return "";
        }
    }else{
        return '';
    }
}
function mango_shop_grid_version () {
    global $mango_settings, $product, $post;
    $grid_version = '';
    $grid_version = mango_shop_cat_list_grid_ver();
    if(!$grid_version) {
        $grid_version = ( $mango_settings[ 'mango_products_grid_version' ] ) ? $mango_settings[ 'mango_products_grid_version' ] : "v_1";
    }
    return apply_filters("mango_filter_shop_grid_version",$grid_version);
}
function mango_shop_list_version (){
    global $mango_settings, $product, $post;
    $list_version = '';
    $list_version = mango_shop_cat_list_grid_ver();
    if(!$list_version) {
        $list_version = ( $mango_settings[ 'mango_products_list_version' ] ) ? $mango_settings[ 'mango_products_list_version' ] : "list";
    }
    return apply_filters("mango_filter_shop_list_version",$list_version);
}
function mango_shop_columns(){
    global $mango_settings;
    $columns = '';
    if ( is_tax( array( "product_cat","product_tag" ) ) ) {
        $tax_id = get_queried_object_id();
        $tax_data =  get_option( 'tax_meta_'.$tax_id);
        if(isset($tax_data["mango_product_cat_columns"]) && $tax_data["mango_product_cat_columns"] != ''){
            $columns = $tax_data["mango_product_cat_columns"];
        }
    }
    if(!$columns){
        $columns = ( $mango_settings[ 'mango_products_grid_columns' ] ) ? $mango_settings[ 'mango_products_grid_columns' ] : "4";
    }
    return $columns;
}
function mango_cart_version () {
    global $mango_settings;
    $cart_ver = ( isset($mango_settings[ 'mango_woo_cart_ver' ]) && $mango_settings[ 'mango_woo_cart_ver' ] ) ? $mango_settings[ 'mango_woo_cart_ver' ] : "v_1";
    return apply_filters("mango_filter_cart_version",$cart_ver);
}
//add_action("woocommerce_cart_collaterals","mango_action_shipping_calc",1);
$cart_ver = mango_cart_version ();
if ( $cart_ver == "v_1" ) {
    add_action ( "woocommerce_cart_collaterals", "mango_shipping_calculator", 3 );
} elseif ( $cart_ver == "v_2" ) {
    add_action ( "woocommerce_cart_collaterals", "mango_shipping_calculator", 23 );
}

function mango_shipping_calculator () {
    $cart_ver = mango_cart_version ();
    if ( WC ()->cart->needs_shipping () ) {
        if ( $cart_ver == "v_1" ) { ?>
            <div class="col-md-6">
        <?php } ?>
        <h4 class="title-border-tb"><?php _e ( "Get shipping Estimates", 'mango' );?> </h4>
        <?php
        if ( WC ()->cart->needs_shipping () && WC ()->cart->show_shipping () ) : ?>
            <?php do_action ( 'woocommerce_cart_totals_before_shipping' ); ?>
            <?php wc_cart_totals_shipping_html (); ?>
            <?php do_action ( 'woocommerce_cart_totals_after_shipping' ); ?>
        <?php elseif ( WC ()->cart->needs_shipping () ) : ?>
            <?php woocommerce_shipping_calculator (); ?>
        <?php endif;
        if ( $cart_ver == "v_1" ) { ?>
            </div>
        <?php }
    }
}

add_action ( 'woocommerce_proceed_to_checkout', 'mango_woocommerce_button_proceed_to_checkout', 20 );
function mango_woocommerce_button_proceed_to_checkout () {
    $checkout_url = WC ()->cart->get_checkout_url ();
    ?>
    <a href="<?php echo esc_url($checkout_url); ?>"
       class="btn btn-custom2 btn-block text-uppercase checkout-button button alt wc-forward"><?php _e ( 'Proceed to Checkout', 'woocommerce' ); ?></a>
<?php
}

function mango_single_product_version () {
    global $product, $post, $mango_settings;

    $ver = get_post_meta ( $post->ID, 'mango_product_page_style', true ) ? get_post_meta ( $post->ID, 'mango_product_page_style', true ) : '';
    if ( !$ver ) {
        $ver = isset( $mango_settings[ 'mango_product_page_style' ] ) ? $mango_settings[ 'mango_product_page_style' ] : 'v_1';
    }
    return $ver;
}

add_action ( "woocommerce_before_shop_loop", "mango_woocommerce_before_shop_loop" );
function mango_woocommerce_before_shop_loop () {  global $mango_settings;  
    mango_taxonomy_banner();?>
    <div class="filter-row clearfix">
    <?php if(!woocommerce_products_will_display()){ ?></div>   <?php return;  } ?>
        <?php
        add_filter ( "woocommerce_catalog_orderby", function ( $catalog_orderby_options ) {
            $catalog_orderby_options = array (
                'menu_order' => __ ( 'Default Sorting', 'mango' ),
                'popularity' => __ ( 'Popularity', 'mango' ),
                'rating' => __ ( 'Average Rating', 'mango' ),
                'date' => __ ( 'Latest', 'mango' ),
                'price' => __ ( 'Lowest Price', 'mango' ),
                'price-desc' => __ ( 'Highest Price', 'mango' ),
				'title-asc' => __ ( 'A-Z Name', 'mango' ),
                'title-desc' => __ ( 'Z-A Name', 'mango' )
            );
            return $catalog_orderby_options;
        } );
        woocommerce_catalog_ordering () ?>
        <div class="filter-row-box second">
            <form method="get">
                <?php if ( isset( $_GET ) && !empty( $_GET ) ) {
                    foreach ( $_GET as $k => $v ) {
                        if ( $k != 'view' ) { ?>
                            <input type="hidden" name="<?php echo esc_attr ( $k ) ?>"
                                   value="<?php echo esc_attr ( $v ); ?>"/>
                        <?php }
                    }
                } ?>
                <button type="submit" name="view" value="grid"
                        class="btn <?php echo ( mango_shop_view () == 'grid' ) ? 'active' : ''; ?>" title="Grid"><i
                        class="fa fa-th"></i></button>
                <button type="submit" name="view" value="list"
                        class="btn <?php echo ( mango_shop_view () == 'list' ) ? 'active' : ''; ?>" title="List"><i
                        class="fa fa-th-list"></i></button>
            </form>
        </div>
        <!-- End .filter-row-box -->
        <div class="clearfix visible-xs"></div>
        <!-- End .clearfix -->
        <div class="filter-row-box last">
            <span class="filter-row-label"><?php _e ( "Show", 'mango' ) ?></span>
            <div class="small-selectbox quantity-selectbox clearfix">
                <?php
                $products_perpage = ( isset( $mango_settings[ 'mango_products_perpage' ] ) && $mango_settings[ 'mango_products_perpage' ] ) ? $mango_settings[ 'mango_products_perpage' ] : '9,15,30';
                $pr_p_ar = explode ( ",", $products_perpage );
                if(isset($_GET['perpage']) && !in_array($_GET['perpage'],$pr_p_ar)){
                    $pr_p_ar[] = $_GET['perpage'];
                }
                $current = ( isset( $_GET[ 'perpage' ] ) && $_GET[ 'perpage' ] ) ? $_GET[ 'perpage' ] : $pr_p_ar[ 0 ];
                ?>
                <form method="get">
                    <?php if ( isset( $_GET ) && !empty( $_GET ) ) {
                        foreach ( $_GET as $k => $v ) {
                            if ( $k != 'perpage' ) { ?>
                                <input type="hidden" name="<?php echo esc_attr ( $k ) ?>"
                                       value="<?php echo esc_attr ( $v ); ?>"/>
                            <?php }
                        }
                    } ?>
                    <select id="number" name="perpage" class="selectbox" onchange="this.form.submit()">
                        <?php foreach ( $pr_p_ar as $number ) { ?>
                            <option
                                value="<?php echo esc_attr($number); ?>" <?php selected ( $number, $current ); ?>><?php echo esc_attr($number); ?></option>
                        <?php } ?>
                    </select>
                </form>
            </div>
            <!-- End .normal-selectbox-->
            <span class="filter-row-label hidden-xss"><?php _e ( "per page", 'mango' ) ?></span>
        </div>
        <!-- End .filter-row-box -->
        <nav class="filter-row-box right woocommerce-pagination">
            <?php woocommerce_pagination (); ?>
        </nav>
        <!-- End .filter-row-box -->
    </div><!-- End .filter-row -->
<?php }
if ( isset( $_GET[ 'perpage' ] ) && $_GET[ 'perpage' ] ) {
    add_filter ( 'loop_shop_per_page', create_function ( '$cols', 'return ' . $_GET[ 'perpage' ] . ';' ), 20 );
} else {
    $products_perpage = ( isset( $mango_settings[ 'mango_products_perpage' ] ) && $mango_settings[ 'mango_products_perpage' ] ) ? $mango_settings[ 'mango_products_perpage' ] : '9,15,30';
    $products_perpage_array = explode ( ',', $products_perpage );

    add_filter ( 'loop_shop_per_page', create_function ( '$cols', 'return ' . $products_perpage_array[ 0 ] . ';' ), 20 );
}
add_action ( "woocommerce_after_shop_loop", "mango_woocommerce_after_shop_loop", 9 );
function mango_woocommerce_after_shop_loop () { ?>
   <?php if(!woocommerce_products_will_display()) { return ; } ?>
    <nav class="pagination-container">
        <?php woocommerce_result_count (); ?>
        <nav class="woocommerce-pagination">
            <?php woocommerce_pagination ();?>
        </nav>
    </nav>
<?php }
add_action ( 'mango_shop_custom_action', 'mango_shop_image_carousel', 5 );
function mango_shop_image_carousel () {
    global $product, $post, $mango_shop_page_settings,$columns;
    if($mango_shop_page_settings['mango_shop_view'] == 'grid' &&  in_array($columns, array(1,2,3) ) ){
        $size = "shop_catalog";
     }else{
        $size = 'shop_catalog';
     }
     $multiple_images = apply_filters("mango_shop_multiple_images",true);
    if(!$multiple_images){ ?>
    <!--owl-carousel product-slider-->
        <figure class="">
                <a href="<?php echo esc_url ( $product->get_permalink () ); ?>"
                   title="<?php echo esc_attr ( $product->get_title () ); ?>">
                    <?php echo $product->get_image($size,array("class"=>"product-image")); ?>
                </a>
        </figure>  
 <?php }else{
    $images = $attachment_ids = array ();
    if ( $product->is_type ( 'variation' ) ) {
        if ( has_post_thumbnail ( $product->get_variation_id () ) ) {
            // Add variation image if set
            $attachment_ids[ ] = get_post_thumbnail_id ( $product->get_variation_id () );

        } elseif ( has_post_thumbnail ( $product->id ) ) {

            // Otherwise use the parent product featured image if set
            $attachment_ids[ ] = get_post_thumbnail_id ( $product->id );
        }
    } else {
        // Add featured image
        if ( has_post_thumbnail ( $product->id ) ) {
            $attachment_ids[ ] = get_post_thumbnail_id ( $product->id );
        }
        // Add gallery images
        $attachment_ids = array_merge ( $attachment_ids, $product->get_gallery_attachment_ids () );
    }
    if ( !empty( $attachment_ids ) ) { ?>
        <figure class="<?php echo esc_attr($size); ?> owl-carousel product-slider">
            <?php foreach ( $attachment_ids as $img ) { ?>
                <a href="<?php echo esc_url ( $product->get_permalink () ); ?>"
                   title="<?php echo esc_attr ( $product->get_title () ); ?>">
                    <?php $path = wp_get_attachment_image_src ( $img, $size ); ?>
                    <img src="<?php echo esc_url ( $path[ 0 ] ); ?>"
                         alt="<?php echo esc_attr ( $product->get_title () ); ?>" class="product-image">
                </a>
            <?php } ?>
        </figure>
    <?php }
	else{
		?>
		<img src="<?php echo get_bloginfo('template_directory'); ?>/images/shop-dumy.png">
	<?php 		
	}
    }
}
//actions for both grid and list
add_action ( "woocommerce_before_shop_loop_item_title", "mango_product_cats" );
function mango_product_cats () {
    global $mango_settings, $post, $product;
    if ( $mango_settings[ 'mango_show_product_category' ] ) {
        echo $product->get_categories ( ', ', '<div class="product-cats">', '</div>' );
    }
}
//add action depending on grid or list
add_action ( "woocommerce_after_shop_loop_item_title", "mango_shop_product_description", 6 );
function mango_shop_product_description () {
    global $product, $post, $mango_shop_page_settings;
    if ( $mango_shop_page_settings['mango_shop_view'] == 'list' ) {
        echo "<p>" . $post->post_excerpt . "</p>";
    }
}
add_action ( 'woocommerce_after_shop_loop_item_title', "mango_shop_action_buttons", 11 );
function mango_shop_action_buttons () {
    global $product, $mango_settings, $mango_shop_page_settings;
    if ( $mango_shop_page_settings['mango_shop_view'] == 'list' ) {
        ?>
        <div class="product-action">
            <?php if ( $mango_settings[ 'mango_show_add_to_cart_button' ] ) {
                woocommerce_template_loop_add_to_cart ();
            }
            if ( $mango_settings[ 'mango_show_wishlist_button' ] ) {
                if ( shortcode_exists ( 'yith_wcwl_add_to_wishlist' ) ) {
                    echo do_shortcode ( '[yith_wcwl_add_to_wishlist]' );
                }
            }
            if ( $mango_settings[ 'mango_show_compare_button' ] ) {
                if ( shortcode_exists ( 'yith_compare_button' ) ) {
                    echo do_shortcode ( '[yith_compare_button]' );
                }
            }

            ?>
        </div>
    <?php }
}
add_action ( "mango_shop_custom_action", "mango_grid_action_buttons", 6 );
function mango_grid_action_buttons () {
    global $mango_settings, $product, $post, $mango_shop_page_settings;
    if ( $mango_shop_page_settings['mango_shop_view'] == 'grid' && $mango_shop_page_settings['grid_ver'] != 'v_4' ) {
        $v[ 'v_1' ] = "product-action-container";
        $v[ 'v_2' ] = "product-action-container action-group";
        $v[ 'v_3' ] = "product-action-container action-group-vertical";
        $v_ = $mango_shop_page_settings['grid_ver']; ?>
        <div class="<?php echo esc_attr($v[ $v_ ]); ?>">
            <?php if ( $mango_settings[ 'mango_show_add_to_cart_button' ] ) {
                woocommerce_template_loop_add_to_cart ();
            }
            if ( $v_ != "v_1" ) {
                if ( $mango_settings[ 'mango_show_wishlist_button' ] ) {
                    if ( shortcode_exists ( 'yith_wcwl_add_to_wishlist' ) ) {
                        echo do_shortcode ( '[yith_wcwl_add_to_wishlist]' );
                    }
                }
                if ( $mango_settings[ 'mango_show_compare_button' ] ) {
                    if ( shortcode_exists ( 'yith_compare_button' ) ) {
                        echo do_shortcode ( '[yith_compare_button]' );
                    }
                }
            } ?>
        </div>
        <?php if ( $v_ == "v_1" ) {
            if ( $mango_settings[ 'mango_show_wishlist_button' ] ) {
                if ( shortcode_exists ( 'yith_wcwl_add_to_wishlist' ) ) {
                    echo do_shortcode ( '[yith_wcwl_add_to_wishlist]' );
                }
            }
            if ( $mango_settings[ 'mango_show_compare_button' ] ) {
                if ( shortcode_exists ( 'yith_compare_button' ) ) {
                    echo do_shortcode ( '[yith_compare_button]' );
                }
            }
        }
    }
}

function mango_cart_total () {
    global $mango_settings, $woocommerce;
    if ( class_exists ( "woocommerce" ) && $mango_settings[ 'show-minicart' ] ) {
        if ( sizeof ( WC ()->cart->get_cart () ) > 0 ) {
        echo '<a id="mango_minicart_price" href="'. get_permalink ( get_option ( 'woocommerce_cart_page_id' ) ).'" class="cart-link" title="'. __("Go to Cart",'mango') .'">
        <i class="fa fa-shopping-cart"></i>
        <span class="header-text">'.__("Shopping Cart",'mango').'</span>
        <span class="cart-text-price">'.WC ()->cart->get_cart_total ().'</span>
        </a>';
        }else{
            //echo "<div id='mango_minicart_price'>";
            //echo __("Shopping Cart ".WC ()->cart->get_cart_total (),'mango');
            //echo "</div>";
echo '<a id="mango_minicart_price" href="'. get_permalink ( get_option ( 'woocommerce_cart_page_id' ) ).'" class="cart-link" title="'. __("Go to Cart",'mango') .'">
        <i class="fa fa-shopping-cart"></i>
        <span class="header-text">'.__("Shopping Cart",'mango').'</span>
        <span class="cart-text-price">'.WC ()->cart->get_cart_total ().'</span>
        </a>';
        }
    }
}

function mango_compare_wishlist_links ($text = true) {
    //function to show wishlist and link in header
    global $mango_settings;

    if( function_exists( 'YITH_WCWL' )  && $mango_settings['show-wishlist-button']){
        $wishlist_url = YITH_WCWL()->get_wishlist_url();
        $in = ($text)? __("Wishlist",'mango'):'('.YITH_WCWL()->count_products().')';
            echo '<a href="'.$wishlist_url.'" class="header-link" title="'.__("wishlist",'mango').'"><i class="fa fa-heart-o"></i><span class="header-text">'.$in.'</span></a>';
    }
}

function mango_minicart ($btn_text = true, $show = "total") {
    global $mango_settings, $woocommerce;
    if ( class_exists ( "woocommerce" ) && $mango_settings[ 'show-minicart' ] ) {
        ?>
        <div class="dropdown cart-dropdown" id="mango_minicart_container">
            <a class="dropdown-toggle" href="#" id="cart-dropdown" data-toggle="dropdown" aria-expanded="true">
				<i class="icon-fo-color <?php echo $mango_settings['mango_cart_icon_select']; ?>"></i>
                <?php if($btn_text==true){ ?><span class="header-text"><?php _e ( "My Cart", 'mango' ) ?></span> <?php } ?>
                <?php if($show==="total"){ ?>
                    <span class="cart-text-price"><?php
                                    if ( sizeof ( WC ()->cart->get_cart () ) > 0 ) {
                                        echo WC ()->cart->get_cart_total ();
                                    } else {
                                        echo get_woocommerce_currency_symbol () . "0";
                                    } ?>
                    </span>
            <?php }elseif($show==='count'){ ?>
                    <span class="cart-text-count">(<?php echo  WC ()->cart->get_cart_contents_count(); ?>)</span>
            <?php } ?>
            </a>
                <div class="dropdown-menu pull-right" id="mango_minicart_container_content" role="menu">
                    <?php if ( sizeof ( WC ()->cart->get_cart () ) > 0 ) {
                        foreach ( WC ()->cart->get_cart () as $cart_item_key => $cart_item ) {
                            $_product = apply_filters ( 'woocommerce_cart_item_product', $cart_item[ 'data' ], $cart_item, $cart_item_key );
                            $product_id = apply_filters ( 'woocommerce_cart_item_product_id', $cart_item[ 'product_id' ], $cart_item, $cart_item_key );
                            if ( $_product && $_product->exists () && $cart_item[ 'quantity' ] > 0 && apply_filters ( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                                $product_name = apply_filters ( 'woocommerce_cart_item_name', $_product->get_title (), $cart_item, $cart_item_key );
                                $thumbnail = apply_filters ( 'woocommerce_cart_item_thumbnail', $_product->get_image ( "shop-widget" ), $cart_item, $cart_item_key );
                                $product_price = apply_filters ( 'woocommerce_cart_item_price', WC ()->cart->get_product_price ( $_product ), $cart_item, $cart_item_key ); ?>
                                 <div class="product clearfix">
                                  <div class="loader"></div>
                                </div><!-- End .product -->
                            <?php }
                        } ?>
                        <div class="cart-total">
                            <div class="dropdown-subtotal">
                                <span><?php _e ( "Subtotal", 'mango' ) ?>
                                    :</span> <?php echo WC ()->cart->get_cart_subtotal (); ?>
                            </div>
                            <!-- End .dropdown-subtotal -->
                            <div class="dropdown-total">
                                <span><?php _e ( "Grand Total", 'mango' ) ?>
                                    :</span> <?php echo WC ()->cart->get_cart_total (); ?>
                            </div>
                            <!-- End .dropdown-total -->
                        </div><!-- End .cart-total -->
                        <div class="cart-action clearfix">
                            <a href="<?php echo get_permalink ( get_option ( 'woocommerce_cart_page_id' ) ); ?>"
                               class="btn btn-custom4"><?php _e ( "View Cart", 'woocommerce' ) ?></a>
                            <a href="<?php echo get_permalink ( get_option ( 'woocommerce_checkout_page_id' ) ); ?>"
                               class="btn btn-custom"><?php _e ( "Checkout", 'woocommerce' ) ?></a>
                        </div><!-- End .cart-action -->
                    <?php } else { ?>
                        <div class="cart-total">
                            <?php echo __ ( 'No products in the cart.', 'woocommerce' ); ?>
                        </div>
                    <?php } ?>
                </div>
                <!-- End .dropdown-menu -->
        </div><!-- End .cart-dropdown -->

    <?php
    }
}

// get ajax cart fragment
add_filter ( 'woocommerce_add_to_cart_fragments', 'mango_mini_cart_ajax_load' );
function mango_mini_cart_ajax_load($fragments) {
global $woocommerce;
ob_start ();
echo '<span class="cart-text-price">';
if ( sizeof ( WC ()->cart->get_cart () ) > 0 ) {
    echo WC ()->cart->get_cart_total ();
} else {
    echo get_woocommerce_currency_symbol () . "0";
}
    echo '</span>';
    $fragments[ '#mango_minicart_container > #cart-dropdown .cart-text-price' ] = ob_get_clean ();
    ob_start();
    echo '<span class="cart-text-count">('.WC ()->cart->get_cart_contents_count().')</span>';
    $fragments[ '#mango_minicart_container > #cart-dropdown .cart-text-count' ] = ob_get_clean ();
    ob_start ();
    echo '<div class="dropdown-menu pull-right" id="mango_minicart_container_content" role="menu">';
         if ( sizeof ( WC ()->cart->get_cart () ) > 0 ) {
             foreach ( WC ()->cart->get_cart () as $cart_item_key => $cart_item ) {
                 $_product = apply_filters ( 'woocommerce_cart_item_product', $cart_item[ 'data' ], $cart_item, $cart_item_key );
                 $product_id = apply_filters ( 'woocommerce_cart_item_product_id', $cart_item[ 'product_id' ], $cart_item, $cart_item_key );
                 if ( $_product && $_product->exists () && $cart_item[ 'quantity' ] > 0 && apply_filters ( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                     $product_name = apply_filters ( 'woocommerce_cart_item_name', $_product->get_title (), $cart_item, $cart_item_key );
                     $thumbnail = apply_filters ( 'woocommerce_cart_item_thumbnail', $_product->get_image ( "shop-widget" ), $cart_item, $cart_item_key );
                     $product_price = apply_filters ( 'woocommerce_cart_item_price', WC ()->cart->get_product_price ( $_product ), $cart_item, $cart_item_key );
                     echo '<div class="product clearfix">';
                     echo apply_filters ( 'woocommerce_cart_item_remove_link', sprintf ( '<a href="%s" class="remove-btn remove" title="%s"><i class="fa fa-close"></i></a>', esc_url ( WC ()->cart->get_remove_url ( $cart_item_key ) ), __ ( 'Remove this item', 'woocommerce' ) ), $cart_item_key );
                     echo '<figure><a href="' . esc_url ( $_product->get_permalink ( $cart_item ) ) . '" title="Product Name">' . $thumbnail . '</a></figure>';
                     echo '<div class="product-meta">';
                     echo '<h4 class="product-title"><a href="' . esc_url ( $_product->get_permalink ( $cart_item ) ) . '">' . $product_name . '</a></h4>';
                     echo '<div class="product-quantity"><span>' . __ ( "Quantity", 'mango' ) . ':</span>' . $cart_item[ 'quantity' ] . '</div>';
                     echo '<div class="product-price-container">';
                     echo '<span class="product-price">' . $product_price . '</span>';
                     echo '</div>';
                     echo '</div>';
                     echo '</div>';
                 }
             }
             echo '<div class="cart-total">';
             echo '<div class="dropdown-subtotal">';
             echo '<span>' . __ ( "Subtotal", 'mango' ) . ':</span>' . WC ()->cart->get_cart_subtotal ();
             echo '</div>';
             echo '<div class="dropdown-total">';
             echo '<span>' . __ ( "Grand Total", 'mango' ) . ':</span>' . WC ()->cart->get_cart_total ();
             echo '</div>';
             echo '</div>';
             echo '<div class="cart-action clearfix">';
             echo '<a href="' . get_permalink ( get_option ( 'woocommerce_cart_page_id' ) ) . '"
                   class="btn btn-custom4">' . __ ( "View Cart", 'woocommerce' ) . '</a>
                <a href="' . get_permalink ( get_option ( 'woocommerce_checkout_page_id' ) ) . '" class="btn btn-custom">'.__( "Checkout", 'woocommerce' ) . '</a>';
          echo '</div>';
         }else{
            echo '<div class="cart-total">';
                  echo __ ( 'No products in the cart.', 'woocommerce' );
            echo '</div>';
         }
    echo '</div>';

    $fragments[ '#mango_minicart_container_content' ] = ob_get_clean ();
    ob_start();
    mango_cart_total ();
    $fragments['#mango_minicart_price'] = ob_get_clean();
return $fragments;
}

function mango_add_to_cart($product_id = ''){
    global $product, $mango_settings;

    if($product_id){
        $product = wc_get_product( $product_id );
    }
	if ( $mango_settings[ 'mango_show_add_to_cart_button' ] ) {
    echo apply_filters( 'woocommerce_loop_add_to_cart_link',
        sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="button %s product_type_%s btn btn-custom2 btn-sm min-width-sm" title="%s">%s</a>',
            esc_url( $product->add_to_cart_url() ),
            esc_attr( $product->id ),
            esc_attr( $product->get_sku() ),
            esc_attr( isset( $quantity ) ? $quantity : 1 ),
            $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
            esc_attr( $product->product_type ),
            esc_html($product->add_to_cart_text()),
            esc_html($product->add_to_cart_text())
        ),
        $product );
		}
}

function mango_woo_wishlist_attributes(){

}
function mango_woo_cart_attributes($cart_item){
    if(isset($cart_item['variation']) && !empty($cart_item['variation'])){ ?>
        <ul class='product-desc-list'>
        <?php foreach($cart_item['variation'] as $att){ ?>
            <li><?php echo esc_html($att); ?></li>
        <?php } ?>
        </ul>
    <?php }
}

function mango_woocommerce_show_product(){
	 global $mango_settings,$mango_shop_page_settings;
    $mango_shop_page_settings['grid_ver'] = 'v_1';
    $mango_shop_page_settings['list_ver']  = '';
    $mango_shop_page_settings['mango_shop_view']  = "grid";
    $meta_query = WC()->query->get_meta_query();
    $selecttype= $mango_settings['mango_product_bottom_products'];
	$count=0;
	foreach($selecttype as  $select){
		if($select){
			$count++;
		}
	}
		if($count>0){
		?>
		   <div class="container">
                <div class="row">
                    <div class="col-md-12">

                        <div role="tabpanel" class="product-tab-carousel">
                            <!-- Nav tabs -->
                            <ul class="nav nav-lava" role="tablist">
							<?php
							$active = "active";
								foreach($selecttype as $key => $select){
                                    if($select !='') {
                                        if ( $key == "TopRated" ) {

                                            $label = __ ( "Top Rated", 'mango' );
                                        } elseif ( $key == "Latest" ) {

                                            $label = __ ( "New Arrivals", 'mango' );
                                        } elseif ( $key == "Popular" ) {

                                            $label = __ ( "Popular Products", 'mango' );
                                        } elseif ( $key == "Featured" ) {

                                            $label = __ ( "Featured Products", 'mango' );
                                        }

                                        echo ' <li role="presentation" class="'.$active.'"  ><a href="#single_tab_' . $key . '" aria-controls="single_tab_' . $key . '" role="tab" data-toggle="tab">' . $label . '</a></li>';
                                        $active = '';
                                    }
								}
							?>
							</ul>
                            <!-- Tab Panes -->
                            <div class="tab-content">
							<?php
							  $active = " active";
								foreach($selecttype as $key => $select){
                                    if($select !=''){ ?>
									<div role="tabpanel" class="tab-pane<?php echo esc_attr($active); ?>"  id="single_tab_<?php echo esc_attr($key); ?>">
									<?php $active = ''; ?>
									<div class="owl-carousel product-featured-carousel">
									<?php
									$meta_query = WC()->query->get_meta_query();
									$args=array(
									    'post_type' => 'product',
									    'posts_per_page' => 10,
									    'post_status'         => 'publish',
									    );

									if($key=="TopRated"){
									    $atts = array(
									        'orderby' => 'title',
									        'order'   => 'asc'
									     );
									    $args['meta_query'] = $meta_query;
    									add_filter('posts_clauses', array( 'WC_Shortcodes', 'order_by_rating_post_clauses'));
    									$products = new WP_Query(apply_filters('woocommerce_shortcode_products_query', $args, $atts));
                                        remove_filter( 'posts_clauses', array( 'WC_Shortcodes', 'order_by_rating_post_clauses' ) );

									}elseif($key=="Latest"){

								        $args['meta_query'] = $meta_query;
									    $args['orderby'] = 'post_date';
									    $args['order'] = 'desc';
                                        $args['meta_query'] = $meta_query;
	                                    $products = new WP_Query($args);

									}elseif($key=="Popular"){
                                        $atts = array(
                                            'per_page' => '10',
                                            'columns'  => '4'
                                        );
										$args['meta_key']='total_sales';
                                        $args['orderby']='meta_value_num';
                                        $args['meta_query'] = $meta_query;
                                        $products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );

									}elseif($key=="Featured"){
		                            $meta_query[] = array(
			                                'key'   => '_featured',
			                                'value' => 'yes'
		                                );
		                                $args['meta_query'] = $meta_query;
                                        $args['orderby'] = 'date';
									    $args['order']  = 'desc';
                                        $atts = array(
									        'orderby' => 'post_date',
									        'order'   => 'desc'
									     );
									    $products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );

									}
									if ($products->have_posts()) :
								        while ( $products->have_posts() ) : $products->the_post();
					                        wc_get_template_part( 'content', 'product' );
				                        endwhile; // end of the loop.
				                    endif;
                                    $args = array();
                                    $atts = array();
                                    wp_reset_postdata();
                                    ?>
                                    </div>
                                </div>
	                            <?php } } ?>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
<?php
		}
}


// Woocommerce Vendor Function More Product


 if(class_exists('WC_Vendors') ){
	 
function mango_more_seller_product(){
global $product, $woocommerce_loop;
if ( empty( $product ) || ! $product->exists() ) {
	return;
}
global $post;
if ( ! WCV_Vendors::is_vendor( $post->post_author ) ) {
	return;
}
$meta_query = WC()->query->get_meta_query();
$args = array(
	'post_type'				=> 'product',
	'post_status'			=> 'publish',
	'ignore_sticky_posts'  	=> 1,
	'no_found_rows'        	=> 1,
	'posts_per_page'		=> 10,
	'author' 				=> get_the_author_meta( 'ID' ),
	'meta_query' 			=> $meta_query,
    'orderby'           	=> 'rand'
);

$products = new WP_Query( $args );
if ( $products->have_posts() ) : ?>
	<div class="container">
		<h2 class="vendor-moreseller"><?php _e( 'More from this seller&hellip;', 'mango' ); ?></h2>
		<?php woocommerce_product_loop_start(); ?>
        <div class="owl-carousel product-featured-carousel">
			<?php while ( $products->have_posts() ) : $products->the_post(); ?>
					<?php wc_get_template_part( 'content-product' ); ?>
			<?php endwhile; // end of the loop. ?>
		</div>
		<?php woocommerce_product_loop_end(); ?>
	</div>
<?php endif;
wp_reset_postdata();
}

 }
 
add_action ( "mango_shop_custom_action", "mango_out_of_stock", 4 ); 
 function mango_out_of_stock() {
    global $product;
    if ( ! $product->managing_stock() && ! $product->is_in_stock() ):
?>
     <span class="stock custom-out-stock"><?php _e("Out of Stock","mango");?></span>
	<?php
	endif;
}


function mango_sidebar_filter(){
	global $mango_settings;
	
	?>
	<?php 
	if($mango_settings['mango_sidefilter_layout']=='left'){;
	?>
	 <div id="shop-side" class="left">
	 <?php 
	}
	?>
	<?php 
	if($mango_settings['mango_sidefilter_layout']=='right'){;
	?>
	 <div id="shop-side" class="right">
	 <?php 
	}
	?>
        <div id="shop-side-wrapper">
				<header class="sidefilter-head">
					<a  class="sidefilter-close" href="#" id="shop-side-close" title="Close Panel"></a>
				</header>
				<aside>
                  <?php 
				 if($mango_settings['mango_sidefilter_layout']=='left'){;
				   $sidebarleft =$mango_settings["mango_sidebar_filter_left"];
				  dynamic_sidebar('"'.$sidebarleft.'"');
				 }
				  if($mango_settings['mango_sidefilter_layout']=='right'){;
				  $sidebarright =$mango_settings["mango_sidebar_filter_right"];
				  dynamic_sidebar('"'.$sidebarright.'"');
				 }
				  ?>
				</aside>
				
			
        </div>
        <div id="shop-side-overlay"></div>
    </div>
	
<?php } 
function next_post_link_product() {
global $mango_settings, $product, $post;
    $next_post = get_next_post(true,'','product_cat');
    if ( is_a( $next_post , 'WP_Post' ) ) { ?>
       <div class="prod-dropdown">
			<a title="Next Product" href="<?php echo get_the_permalink( $next_post->ID ); ?>" rel="next" class="right carousel-control flipbook-icon n-p-size"><i class="fa fa-angle-right flipbook-icon"></i></a>
                <div class="nav-dropdown-cs" style="display: none;">
                  <a title="<?php echo get_the_title( $next_post->ID ); ?>" href="<?php echo get_the_permalink( $next_post->ID ); ?>">
                  <?php echo get_the_post_thumbnail($next_post->ID, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' )) ?></a>
                </div>
            </div>
    <?php }
}

function previous_post_link_product() {
global $mango_settings, $product, $post;
    $prev_post = get_previous_post(true,'','product_cat');
    if ( is_a( $prev_post , 'WP_Post' ) ) { ?>
       <div class="prod-dropdown">
			<a title="Previous Product" href="<?php echo get_the_permalink( $prev_post->ID ); ?>" rel="next" class="left carousel-control flipbook-icon n-p-size"><i class="fa fa-angle-left flipbook-icon"></i></a>
                <div class="nav-dropdown-cs" style="display: none;">
                    <a  class="op" title="<?php echo get_the_title( $prev_post->ID ); ?>" href="<?php echo get_the_permalink( $prev_post->ID ); ?>">
                    <?php echo get_the_post_thumbnail($prev_post->ID, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' )) ?></a>
                </div>
            </div>
    <?php }
}

