<?php
/*
 * Plumtree Favourite Vendor shops
 */

/**
 *  Enqueue scripts
 */
function pt_favourite_vendors_scripts() {
	wp_enqueue_script( 'pt_favourite_vendors', get_template_directory_uri() . '/js/favourite-vendor.js', array('jquery'), '1.0', true );
	wp_localize_script( 'pt_favourite_vendors', 'ajax_var', array(
		'url' => admin_url( 'admin-ajax.php' ),
		'nonce' => wp_create_nonce( 'ajax-nonce' )
		)
	);
}
add_action( 'init', 'pt_favourite_vendors_scripts' );

/**
 *  Save required data
 */
add_action( 'wp_ajax_nopriv_pt-favourite-vendor', 'pt_favourite_vendor' );
add_action( 'wp_ajax_pt-favourite-vendor', 'pt_favourite_vendor' );

function pt_favourite_vendor() {
	$nonce = $_POST['nonce'];
  if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
        die ( 'Nope!' );

	$vendor_id = $_POST['vendor_id'];

	if ( is_user_logged_in() ) {
		$user_id = get_current_user_id();
		$already_liked_shops = get_user_option( "_liked_vendors", $user_id );
		$liked_shops = NULL;

		if ( count($already_liked_shops) != 0 ) {
			$liked_shops = $already_liked_shops;
		}

    if ( !is_array( $liked_shops ) ) {
      $liked_shops = array();
		}

		if ( !in_array( $vendor_id, $liked_shops ) ) {
			$liked_shops[] = $vendor_id;
			update_user_option( $user_id, "_liked_vendors", $liked_shops );
			echo json_encode(array( 'added' => true, 'message' => esc_html__('Favourite Shop', 'plumtree'), 'title' => esc_html__('Remove this shop from your Favourites', 'plumtree') ));
		} else {
			if ( ($key = array_search($vendor_id, $liked_shops)) !== false ) {
    		unset($liked_shops[$key]);
			}
			$liked_shops = array_values($liked_shops);
			update_user_option( $user_id, "_liked_vendors", $liked_shops );
			echo json_encode(array( 'added' => false, 'message' => esc_html__('Add to Favourites', 'plumtree'), 'title' => esc_html__('Add this shop to your Favourites', 'plumtree') ));
		}

	} else {
		ob_start();
			$message = sprintf( __('Only registered users can add vendor shop to Favourite List. Please <a rel="nofollow" href="%s">log in or register here</a>!', 'plumtree'), esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ));
			wc_print_notice( $message, 'error' );
			$output = ob_get_contents();
			ob_end_clean();
			$output = str_replace("woocommerce-error", "woocommerce-error vendor-notice", $output);
			echo json_encode(array( 'added' => 'no-access', 'message' => $output ));
	}

	exit;
}

/**
 *  Front end button
 */
function pt_output_favourite_button( $vendor_id ) {
  if ( is_user_logged_in() ) { // user is logged in
    $user_id = get_current_user_id(); // current user
    $already_liked_shops = get_user_option( "_liked_vendors", $user_id ); // post ids from user meta
		$liked_shops = NULL; // setup array variable

		if ( count($already_liked_shops) != 0 ) { // meta exists, set up values
			$liked_shops = $already_liked_shops;
		}
		if ( !is_array( $liked_shops ) ) { // make array just in case
			$liked_shops = array();
		}

    if ( !in_array( $vendor_id, $liked_shops ) ) { // like the post
      $class = '';
      $title = esc_html__('Add this shop to your Favourites', 'plumtree');
			$msg = esc_html__('Add to Favourites', 'plumtree');
    } else {
      $class = ' added';
      $title = esc_html__('Remove this shop from your Favourites', 'plumtree');
			$msg = esc_html__('Favourite Shop', 'plumtree');
    }
	} else {
		$class = '';
		$title = esc_html__('Add this shop to your Favourites', 'plumtree');
		$msg = esc_html__('Add to Favourites', 'plumtree');
	}	?>
	<div class="favourite-wrapper">
		<a href="#" class="pt-favourite-vendor<?php echo esc_attr($class);?>" data-vendor_id="<?php echo esc_attr($vendor_id); ?>" title="<?php echo esc_attr($title); ?>">
				<i id="icon-like" class="post-icon-like fa fa-heart"></i>
				<span><?php echo esc_attr($msg); ?></span>
		</a>
	</div>
	<?php
}

/**
 *  Output favourite shops on my account page
 */
function pt_my_account_favourite_list() {
	if ( is_user_logged_in() ) {
    $user_id = get_current_user_id();
    $already_liked_shops = get_user_option( "_liked_vendors", $user_id );
		if ( is_array($already_liked_shops) && count($already_liked_shops)!=0 ) {
			echo '<div class="vendor-favourite-list">';
			echo '<h3>'.esc_html__('Favourite Vendors:', 'plumtree').'</h3>';
			foreach ($already_liked_shops as $vendor_id) {
				$store_url = WCVendors_Pro_Vendor_Controller::get_vendor_store_url( $vendor_id );
				$store_name = get_user_meta( $vendor_id, 'pv_shop_name', true );

				// Store logo
				$store_icon_src = wp_get_attachment_image_src( get_user_meta( $vendor_id, '_wcv_store_icon_id', true ), 'pt-vendor-main-logo' );
				$store_icon = '';
				if ( is_array( $store_icon_src ) ) {
					$store_icon = '<img src="'. esc_url($store_icon_src[0]) .'" alt="vendor logo" class="store-icon" />';
				}

				// Get all vendor products
				$vendor_products_ids = WCVendors_Pro_Vendor_Controller::get_products_by_id( $vendor_id );
				$products_count = count($vendor_products_ids);
				$all_sale_products = wc_get_product_ids_on_sale();
				if ( is_array( $all_sale_products ) && count($all_sale_products)!=0 ) {
					$products_onsale_count = count( array_intersect($vendor_products_ids, $all_sale_products) );
				}

				// Output all info
				echo '<div class="col-xs-12 col-sm-4">';
				echo '<div class="single-vendor">';
				if ($store_icon != '') {
					echo '<div class="store-brand"><a href="'.$store_url.'">'.$store_icon.'</a></div>';
				}
				if ($store_name != '') {
					echo '<h3 class="shop-name"><a href="'.$store_url.'">'.$store_name.'</a></h3>';
				}
				echo '<div class="meta-container">';
				if ( ! WCVendors_Pro::get_option( 'ratings_management_cap' ) ) {
					echo '<span class="rating-container">';
					echo WCVendors_Pro_Ratings_Controller::ratings_link( $vendor_id, true );
					echo '</span>';
				}
				echo '<div class="counters-wrapper">';
				if ($products_count && $products_count>0) echo '<span class="products-count"><i class="fa fa-shopping-basket" aria-hidden="true"></i>'.esc_html__( 'Products: ', 'plumtree' ).$products_count.'</span>';
				if ($products_onsale_count && $products_onsale_count>0) echo '<span class="products-onsale-count"><i class="fa fa-tag" aria-hidden="true"></i>'.esc_html__( 'On-Sale: ', 'plumtree' ).$products_onsale_count.'</span>';
				echo '</div>';
				echo '<a href="#" class="pt-favourite-vendor remove-vendor" data-vendor_id="'.esc_attr($vendor_id).'"><i class="fa fa-times" aria-hidden="true"></i>'.esc_html__('Remove from Favourites', 'plumtree').'</a>';
				echo '</div></div></div>';
			}
			unset($vendor_id);
			echo '</div>';
		}
	}
}
add_action('woocommerce_after_my_account', 'pt_my_account_favourite_list');
