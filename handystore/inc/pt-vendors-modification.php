<?php

/*------- WC Vendors modifications ----------*/

/* Contents:
	- Deactivate wcv pro styles
	- Vendor headers modifications
	- Remove link to dashboard from "my account" page
  - New Image Sizes for vendor images
	- Custom WC Vendors "Sold by" in product loop
	- Custom "Sold by" in product meta on single product page
	- Add extra fields to vendors settings
	- Related products by vendors
	- Add media Upload script for WC Vendors
	- Add extra info for vendors on "My Account"
	- Simple feedback form for customers in product tabs
	- Modifying Vendor's rating tab
  - Removing empty label on application page
  - Message seller on single vendor shop page
  - Extra tabs on single vendor shop page
 */


/* Deactivate wcv pro styles */
if ( class_exists('WCVendors_Pro') ) {
	add_action( 'wp_print_styles', 'pt_deregister_styles', 100 );
	function pt_deregister_styles() {
		wp_deregister_style( 'wcv-pro-store-style' );
	}
}


/* Vendor headers modifications */
// Disable mini header on single product page
if (WC_Vendors::$pv_options->get_option( 'shop_headers_enabled' ) ) {
	remove_action( 'woocommerce_before_single_product', array('WCV_Vendor_Shop', 'vendor_mini_header'));
}
if ( class_exists('WCVendors_Pro') ) {
	remove_action( 'woocommerce_before_single_product',	array($wcvendors_pro->wcvendors_pro_vendor_controller, 	'store_single_header') );
}
// Moving main header output
if ( class_exists('WCVendors_Pro') ) {
	remove_action( 'woocommerce_before_main_content',	array($wcvendors_pro->wcvendors_pro_vendor_controller, 	'store_main_content_header'), 30 );
	add_action( 'woocommerce_before_main_content',	array($wcvendors_pro->wcvendors_pro_vendor_controller, 	'store_main_content_header'), 8 );
}


/* Remove link to dashboard from "my account" page */
if ( class_exists('WCVendors_Pro') ) {
	remove_action( 'woocommerce_before_my_account', array($wcvendors_pro->wcvendors_pro_vendor_controller, 'pro_dashboard_link_myaccount') );
}

/* New Image Sizes for vendor images */
if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'pt-vendor-main-logo', 150, 150, false );
	add_image_size( 'pt-vendor-logo-icon', 30, 30, true );
}


/* Custom WC Vendors "Sold by" in product loop */
if (!function_exists('pt_template_loop_sold_by')) {
	function pt_template_loop_sold_by($product_id) {
		$vendor_id     = WCV_Vendors::get_vendor_from_product( $product_id );
		$store_title   = WCV_Vendors::get_vendor_sold_by( $vendor_id );
		if ( WCV_Vendors::is_vendor( $vendor_id ) ) {
			// for Pro version
			if ( class_exists('WCVendors_Pro') ) {
				$url = WCVendors_Pro_Vendor_Controller::get_vendor_store_url( $vendor_id );
				$store_icon_src = wp_get_attachment_image_src( get_user_meta( $vendor_id, '_wcv_store_icon_id', true ), 'pt-vendor-logo-icon' );
				$store_icon = '';
				if ( is_array( $store_icon_src ) ) {
					$store_icon = '<img src="'. esc_url($store_icon_src[0]).'" alt="vendor logo" class="store-icon" />';
				}
				echo '<div class="sold-by-container">';
				if ( $store_icon !='' ) {
					echo '<a href="'.esc_url($url).'" title="'.esc_html__('Sold by ', 'plumtree').esc_attr($store_title).'">'.$store_icon.'</a>';
				} else {
					echo '<span>'.esc_html__('Sold by ', 'plumtree').'</span><br /><a href="'.esc_url($url).'">'.esc_attr($store_title).'</a>';
				}
				echo "</div>";
			} // for free version
			else {
				$logo_src = get_user_meta( $vendor_id, 'pv_logo_image', true );
				$store_icon = '';
				if ( $logo_src && $logo_src != '') {
					global $wpdb;
					$id = $wpdb->get_var( $wpdb->prepare(
						"SELECT ID FROM $wpdb->posts WHERE BINARY guid = %s",
						$logo_src
					) );
					$store_icon_src = wp_get_attachment_image_src( $id, 'pt-vendor-logo-icon' );
					if ( is_array( $store_icon_src ) ) {
						$store_icon = '<img src="'.esc_url($store_icon_src[0]).'" alt="vendor logo" class="store-icon" />';
					}
				}
				$url = WCV_Vendors::get_vendor_shop_page( $vendor_id );
				echo '<div class="sold-by-container">';
				if ( $store_icon != '' ) {
					echo '<a href="'.esc_url($url).'" title="'.esc_html__('Sold by ', 'plumtree').esc_attr($store_title).'">'.$store_icon.'</a>';
				} else {
					echo '<span>'.esc_html__('Sold by ', 'plumtree').'</span><br /><a href="'.esc_url($url).'">'.esc_attr($store_title).'</a>';
				}
				echo "</div>";
			}
		}
	}
}

remove_action( 'woocommerce_after_shop_loop_item', array('WCV_Vendor_Shop', 'template_loop_sold_by'), 9 );
/*if ( class_exists('WCVendors_Pro') ) {
	remove_action( 'woocommerce_after_shop_loop_item', array( $wcvendors_pro->wcvendors_pro_store_controller, 'loop_sold_by'), 8 );
}*/
if ( handy_get_option('show_wcv_loop_sold_by')=='on' ) {
	add_action( 'woocommerce_after_shop_loop_item', 'pt_template_loop_sold_by', 15 );
}


/* Custom "Sold by" in product meta on single product page */
if (!function_exists('pt_sold_by_wrapper_start')) {
	function pt_sold_by_wrapper_start() {
		echo '<span class="sold-by-wrapper">';
	}
}
if (!function_exists('pt_sold_by_wrapper_end')) {
	function pt_sold_by_wrapper_end() {
		echo '</span>';
	}
}
if (!function_exists('pt_sold_by_meta_custom_message')) {
	function pt_sold_by_meta_custom_message($message) {
		$message = WC_Vendors::$pv_options->get_option( 'sold_by_label' ).': ';
    return $message;
	}
}
add_filter( 'wcvendors_cart_sold_by_meta', 'pt_sold_by_meta_custom_message', 10, 1);
add_action( 'woocommerce_product_meta_start', 'pt_sold_by_wrapper_start', 9 );
add_action( 'woocommerce_product_meta_start', 'pt_sold_by_wrapper_end', 11 );


/* Add extra fields to vendors settings */

// Fields for WC Vendors Free
if ( !class_exists('WCVendors_Pro') ) {
	// Add new fields to front end
	add_action( 'wcvendors_settings_before_paypal_frontend', 'pt_add_frontend_vendor_fields' );
	// Save data from new fields
	add_action( 'wcvendors_shop_settings_saved', 'pt_save_new_vendor_fields' );
	add_action( 'wcvendors_update_admin_user', 'pt_save_new_vendor_fields' );
	// Add new fields to user profile (for admin)
	add_action( 'show_user_profile', 'pt_add_backend_vendor_fields' );
	add_action( 'edit_user_profile', 'pt_add_backend_vendor_fields' );
	// Save data from user profile (for admin)
	add_action( 'personal_options_update', 'pt_save_new_vendor_fields' );
	add_action( 'edit_user_profile_update', 'pt_save_new_vendor_fields' );
}

// New fields on back end
if (!function_exists('pt_add_backend_vendor_fields')) {
	function pt_add_backend_vendor_fields($user) { ?>

		<?php $user_id = $user->ID; ?>
	  <h3><?php esc_html_e( 'Extra Vendor Options (Handy Store Modifications)', 'plumtree' ); ?></h3>

	  <table class="form-table">
	  	<tbody>
		  <tr>
		    <th><?php esc_html_e( 'Upload Logo Image', 'plumtree' ); ?></th>
		    <td>
		    	<input name="pv_logo_image" id="pv_logo_image" type="text" value="<?php echo esc_url( get_user_meta( $user_id, 'pv_logo_image', true ) ); ?>" />
				<span id="pv_logo_image_button" class="button pt_upload_image_button"><?php esc_html_e( 'Upload', 'plumtree' ); ?></span>
			</td>
		  </tr>

		  <tr>
		    <th><?php esc_html_e( 'Logo Position', 'plumtree' ); ?></th>
		    <td>
		    <?php $value = get_user_meta( $user_id,'pv_logo_position', true );
		    	  if ( $value == '' ) $value = 'left'; ?>
			    <input type="radio" class="input-radio" name="pv_logo_position" id="logo_position_left" value="left" <?php checked( $value, 'left'); ?>/><label for="logo_position_left"><?php esc_html_e( ' Left', 'plumtree' ); ?></label><br />
				<input type="radio" class="input-radio" name="pv_logo_position" id="logo_position_center" value="center" <?php checked( $value, 'center'); ?>/><label for="logo_position_center"><?php esc_html_e( ' Center', 'plumtree' ); ?></label><br />
				<input type="radio" class="input-radio" name="pv_logo_position" id="logo_position_right" value="right" <?php checked( $value, 'right'); ?>/><label for="logo_position_right"><?php esc_html_e( ' Right', 'plumtree' ); ?></label>
			</td>
		  </tr>

		  <tr>
		    <th><?php esc_html_e( 'Products Carousel', 'plumtree' ); ?></th>
		    <td>
		    <?php $value = get_user_meta( $user_id,'pv_featured_carousel', true ); ?>
		    	<label for="pv_featured_carousel">
		    		<input type="checkbox" name="pv_featured_carousel" id="pv_featured_carousel" <?php checked( $value, 'on' ); ?> />
		    		<?php esc_html_e( 'Check if you want to add carousel with featured products to your shop page', 'plumtree' ) ?>
		    	</label>
			</td>
		  </tr>

		  <tr>
		    <th><?php esc_html_e( 'Vendor question form', 'plumtree' ); ?></th>
		    <td>
		    <?php $value = get_user_meta( $user_id,'pv_question_form', true ); ?>
		    	<label for="pv_question_form">
		    		<input type="checkbox" name="pv_question_form" id="pv_question_form" <?php checked( $value, 'on' ); ?> />
		    		<?php esc_html_e( 'Check if you want to add "Ask a question about this product" form to "Seller Tab" on each of your products', 'plumtree' ) ?>
		    	</label>
			</td>
		  </tr>

		</tbody>
	  </table>

	<?php }
}

// New fields on front end
if (!function_exists('pt_add_frontend_vendor_fields')) {
	function pt_add_frontend_vendor_fields() { ?>

	  <?php $user_id = get_current_user_id(); ?>
	  <div class="pv_logo_image_container">
	    <p><strong><?php esc_html_e( 'Upload Logo Image', 'plumtree' ); ?></strong><br/><br/>
		    <input name="pv_logo_image" id="pv_logo_image" type="text" value="<?php echo esc_url( get_user_meta( $user_id, 'pv_logo_image', true ) ); ?>" />
			<span id="pv_logo_image_button" class="button pt_upload_image_button"><?php esc_html_e( 'Upload', 'plumtree' ); ?></span>
		</p>
	  </div>

	  <div class="pv_logo_position_container">
	    <p><strong><?php esc_html_e( 'Logo Position', 'plumtree' ); ?></strong></p>
	    <?php $value = get_user_meta( $user_id,'pv_logo_position', true );
	    	  if ( $value == '' ) $value = 'left'; ?>
	    <p>
		    <input type="radio" class="input-radio" name="pv_logo_position" id="logo_position_left" value="left" <?php checked( $value, 'left'); ?>/><label for="logo_position_left"><?php esc_html_e( ' Left', 'plumtree' ); ?></label><br />
			<input type="radio" class="input-radio" name="pv_logo_position" id="logo_position_center" value="center" <?php checked( $value, 'center'); ?>/><label for="logo_position_center"><?php esc_html_e( ' Center', 'plumtree' ); ?></label><br />
			<input type="radio" class="input-radio" name="pv_logo_position" id="logo_position_right" value="right" <?php checked( $value, 'right'); ?>/><label for="logo_position_right"><?php esc_html_e( ' Right', 'plumtree' ); ?></label>
		</p>
	  </div>

	  <div class="pv_featured_carousel_container">
	    <p><strong><?php esc_html_e( 'Products Carousel', 'plumtree' ); ?></strong></p>
	    <?php $value = get_user_meta( $user_id,'pv_featured_carousel', true ); ?>
	    <p>
	    	<input type="checkbox" class="input-checkbox" name="pv_featured_carousel" id="pv_featured_carousel" <?php checked( $value, 'on' ); ?> /><label class="checkbox" for="pv_featured_carousel"><?php esc_html_e( 'Check if you want to add carousel with featured products to your shop page', 'plumtree' ) ?></label>
		</p>
	  </div>

	  <div class="pv_question_form_container">
	    <p><strong><?php esc_html_e( 'Vendor question form', 'plumtree' ); ?></strong></p>
	    <?php $value = get_user_meta( $user_id,'pv_question_form', true ); ?>
	    <p>
	    	<input type="checkbox" class="input-checkbox" name="pv_question_form" id="pv_question_form" <?php checked( $value, 'on' ); ?> /><label class="checkbox" for="pv_question_form"><?php esc_html_e( 'Check if you want to add "Ask a question about this product" form to "Seller Tab" on each of your products', 'plumtree' ) ?></label>
		</p>
	  </div>

	<?php }
}

// Save new fields
if (!function_exists('pt_save_new_vendor_fields')) {
	function pt_save_new_vendor_fields($user_id) {
		if ( isset( $_POST['pv_logo_image'] ) ) {
			update_user_meta( $user_id, 'pv_logo_image', $_POST['pv_logo_image'] );
		}
		if ( isset( $_POST['pv_logo_position'] ) ) {
			update_user_meta( $user_id, 'pv_logo_position', $_POST['pv_logo_position'] );
		}
		if ( isset( $_POST['pv_featured_carousel'] ) ) {
		    update_user_meta( $user_id, 'pv_featured_carousel', $_POST['pv_featured_carousel'] );
		} else {
		  	update_user_meta( $user_id, 'pv_featured_carousel', 'off' );
		}
		if ( isset( $_POST['pv_question_form'] ) ) {
		    update_user_meta( $user_id, 'pv_question_form', $_POST['pv_question_form'] );
		} else {
		  	update_user_meta( $user_id, 'pv_question_form', 'off' );
		}
	}
}

// Fields for WC Vendors Pro
if ( class_exists('WCVendors_Pro') ) {
	// Add new fields to front end
	add_action( 'wcvendors_settings_after_vacation_mode', 'pt_add_frontend_vendor_pro_fields' );
	add_action( 'wcv_after_variations_tab', 'pt_add_frontend_product_vendor_pro_fields' );
	// Save data from new fields
	add_action( 'wcv_pro_store_settings_saved', 'pt_save_new_vendor_pro_fields' );
	add_action( 'wcv_save_product_meta', 'pt_save_new_vendor_pro_product_fields' );
}

// New fields on front end
if (!function_exists('pt_add_frontend_vendor_pro_fields')) {
	function pt_add_frontend_vendor_pro_fields() {
	$user_id = get_current_user_id(); ?>

		<hr style="clear: both;" />
		<h2><?php esc_html_e('Handy Store extra Settings', 'plumtree'); ?></h2>
		<div class="pv_featured_carousel_container">
	    <p><strong><?php esc_html_e( 'Products Carousel', 'plumtree' ); ?></strong></p>
	    <?php $value = get_user_meta( $user_id,'pv_featured_carousel', true ); ?>
	    <p>
	    	<input type="checkbox" class="input-checkbox" name="pv_featured_carousel" id="pv_featured_carousel" <?php checked( $value, 'on' ); ?> /><label class="checkbox" for="pv_featured_carousel"><?php esc_html_e( 'Check if you want to add carousel with featured products to your shop page', 'plumtree' ); ?></label>
		</p>
	  </div>

	  <div class="pv_question_form_container">
	    <p><strong><?php esc_html_e( 'Vendor question form in product tabs', 'plumtree' ); ?></strong></p>
	    <?php $value = get_user_meta( $user_id,'pv_question_form', true ); ?>
	    <p>
	    	<input type="checkbox" class="input-checkbox" name="pv_question_form" id="pv_question_form" <?php checked( $value, 'on' ); ?> /><label class="checkbox" for="pv_question_form"><?php esc_html_e( 'Check if you want to add "Ask a question about this product" form to "Seller Tab" on each of your products', 'plumtree' ); ?></label>
		</p>
	  </div>

		<div class="pv_message_sender_container">
			<p><strong><?php esc_html_e( 'Vendor question form on Single vendor shop page', 'plumtree' ); ?></strong></p>
			<?php $value = get_user_meta( $user_id,'pv_message_sender', true ); ?>
			<p>
				<input type="checkbox" class="input-checkbox" name="pv_message_sender" id="pv_message_sender" <?php checked( $value, 'on' ); ?> /><label class="checkbox" for="pv_message_sender"><?php esc_html_e( 'Check if you want to add "Message Sender" form & your gravatar to single vendor shop header', 'plumtree' ); ?></label>
		</p>
		</div>

	<?php }
}

// Product extra fields
if (!function_exists('pt_add_frontend_product_vendor_pro_fields')) {
	function pt_add_frontend_product_vendor_pro_fields( $object_id ) { ?>
	<hr style="clear: both;" />
	<h2><?php _e('Handy Store extra Settings', 'plumtree'); ?></h2>
	<div class="all-100">
			<!-- Extra Gallery -->
			<?php
				$pt_product_extra_gallery = ( get_post_meta($object_id, 'pt_product_extra_gallery', true) != '' ) ? get_post_meta($object_id, 'pt_product_extra_gallery') : 'off';
				$pt_vendor_special_offers_carousel = ( get_post_meta($object_id, 'pt_vendor_special_offers_carousel', true) != '' ) ? get_post_meta($object_id, 'pt_vendor_special_offers_carousel') : 'off';
			?>

			<div class="product-extra-gallery">
				<input type="checkbox" class="input-checkbox" name="pt_product_extra_gallery" id="pt_product_extra_gallery" <?php checked( $pt_product_extra_gallery[0], 'on', true ); ?> /><label class="checkbox" for="pt_product_extra_gallery"><?php _e( 'Use extra gallery for this product', 'plumtree' ) ?></label>
				<p><?php _e( 'Check the checkbox if you want to use extra gallery (appeared on hover) for this product. The first 3 images of the product gallery are going to be used for gallery.', 'plumtree'); ?></p>
			</div>
			<br />
			<div class="vendor-special-offers-carousel">
				<input type="checkbox" class="input-checkbox" name="pt_vendor_special_offers_carousel" id="pt_vendor_special_offers_carousel" <?php checked( $pt_vendor_special_offers_carousel[0], 'on', true ); ?> /><label class="checkbox" for="pt_vendor_special_offers_carousel"><?php _e( 'Add this product to "Special Offers" carousel', 'plumtree' ) ?></label>
				<p><?php _e( 'Check the checkbox if you want to add this product to the "Special Offers" carousel on your Vendor Store Page.', 'plumtree'); ?></p>
			</div>

	</div>
<?php }
}

// Save data from new fields
if (!function_exists('pt_save_new_vendor_pro_fields')) {
	function pt_save_new_vendor_pro_fields( $user_id ) {
		if ( isset( $_POST['pv_featured_carousel'] ) ) {
		    update_user_meta( $user_id, 'pv_featured_carousel', $_POST['pv_featured_carousel'] );
		} else {
		  	update_user_meta( $user_id, 'pv_featured_carousel', 'off' );
		}
		if ( isset( $_POST['pv_question_form'] ) ) {
		    update_user_meta( $user_id, 'pv_question_form', $_POST['pv_question_form'] );
		} else {
		  	update_user_meta( $user_id, 'pv_question_form', 'off' );
		}
		if ( isset( $_POST['pv_message_sender'] ) ) {
				update_user_meta( $user_id, 'pv_message_sender', $_POST['pv_message_sender'] );
		} else {
				update_user_meta( $user_id, 'pv_message_sender', 'off' );
		}
	}
}
if (!function_exists('pt_save_new_vendor_pro_product_fields')) {
	function pt_save_new_vendor_pro_product_fields( $post_id ) {
		if ( $_POST['pt_product_extra_gallery'] == 'on' ) {
				update_post_meta( $post_id, 'pt_product_extra_gallery', $_POST['pt_product_extra_gallery'] );
		} else {
				update_post_meta( $post_id, 'pt_product_extra_gallery', 'off' );
		}
		if ( $_POST['pt_vendor_special_offers_carousel'] == 'on' ) {
				update_post_meta( $post_id, 'pt_vendor_special_offers_carousel', $_POST['pt_vendor_special_offers_carousel'] );
		} else {
				update_post_meta( $post_id, 'pt_vendor_special_offers_carousel', 'off' );
		}
	}
}


/* Related products by vendors */
if (handy_get_option('show_wcv_related_products')=='on' ) {
	if (!function_exists('pt_output_vendors_related_products')) {
		function pt_output_vendors_related_products() {
			global $product;

			$vendor = get_the_author_meta('ID');
			$posts_per_page = (handy_get_option('wcv_qty') != '') ? handy_get_option('wcv_qty') : '3';
			$sold_by = WCV_Vendors::get_vendor_sold_by( $vendor );

			$args = apply_filters('woocommerce_related_products_args', array(
				'post_type'	=> 'product',
				'ignore_sticky_posts'	=> 1,
				'no_found_rows' => 1,
				'posts_per_page' => $posts_per_page,
				'orderby' => 'name',
				'author' => $vendor,
				'post__not_in' => array($product->id)
			) );

			$products = new WP_Query( $args );
			if ( $products->have_posts() ) : ?>

			<div class="wcv-related products">
				<h2><?php echo esc_html__( 'More Products by ', 'plumtree' ).$sold_by; ?></h2>
				<?php woocommerce_product_loop_start(); ?>
					<?php while ( $products->have_posts() ) : $products->the_post(); ?>
						<?php woocommerce_get_template_part( 'content', 'product' ); ?>
					<?php endwhile; ?>
				<?php woocommerce_product_loop_end(); ?>
			</div>

			<?php endif;
			wp_reset_postdata();
		}
	}
	add_action('woocommerce_after_single_product_summary', 'pt_output_vendors_related_products', 15);
}


/* Add media Upload script for WC Vendors */
if ( !class_exists('WCVendors_Pro') ) {
	if (!function_exists('pt_add_media_upload_scripts')) {
		function pt_add_media_upload_scripts(){
			$mode = get_user_option( 'media_library_mode', get_current_user_id() ) ? get_user_option( 'media_library_mode', get_current_user_id() ) : 'grid';
	        $modes = array( 'grid', 'list' );
	        if ( isset( $_GET['mode'] ) && in_array( $_GET['mode'], $modes ) ) {
	            $mode = $_GET['mode'];
	            update_user_option( get_current_user_id(), 'media_library_mode', $mode );
	        }
	        if( ! empty ( $_SERVER['PHP_SELF'] ) && 'upload.php' === basename( $_SERVER['PHP_SELF'] ) && 'grid' !== $mode ) {
	            wp_enqueue_script( 'media' );
	        }
	        if ( ! did_action( 'wp_enqueue_media' ) ) wp_enqueue_media();
	    	wp_enqueue_script( 'upload_media_script', get_template_directory_uri() .'/js/upload-media.js', array('jquery'), true);
		}
	}
  add_action( 'wp_enqueue_scripts', 'pt_add_media_upload_scripts' );
	add_action( 'admin_enqueue_scripts', 'pt_add_media_upload_scripts' );
}


/* Add extra info for vendors on "My Account" */
if (!function_exists('pt_add_vendors_info')) {
	function pt_add_vendors_info() {
		$user = wp_get_current_user();
		if ( in_array( 'vendor', (array) $user->roles ) ) { ?>
			<div class="account-vendor-options">
				<h2><?php esc_html_e("Vendor's Options", 'plumtree'); ?></h2>
			    <?php // Get url's for vendors pages
	        	$dashboard_url = get_permalink(WC_Vendors::$pv_options->get_option( 'vendor_dashboard_page' ));
	        	if ( class_exists('WCVendors_Pro') ) {
	            $dashboard_url = get_permalink(WCVendors_Pro::get_option( 'dashboard_page_id' ));
	        	} ?>
	        	<p><?php esc_html_e('Follow this link to get to the vendor dashboard, where you can control your store, add products, generate reports on accomplished deals etc.', 'plumtree'); ?></p>
	        	<a class="btn btn-primary rounded" href="<?php echo esc_url($dashboard_url); ?>" title="<?php esc_html_e('Go to Vendor Dashboard', 'plumtree'); ?>" rel="nofollow" target="_self"><?php esc_html_e('Go to Vendor Dashboard', 'plumtree'); ?></a>
			</div>
		<?php } elseif ( in_array( 'pending_vendor', (array) $user->roles ) ) { ?>
			<div class="account-vendor-options">
				<h2><?php esc_html_e("Vendor's Options", 'plumtree'); ?></h2>
	        	<p><?php esc_html_e('Your account has not yet been approved to become a vendor. When it is, you will receive an email telling you that your account is approved!', 'plumtree'); ?></p>
			</div>

		<?php }
	}
}
add_action( 'woocommerce_before_my_account', 'pt_add_vendors_info' );


/* Simple feedback form for customers in product tabs */

// Enqueue scripts
if (!function_exists('pt_vendor_feedback_on_product_scripts')) {
	function pt_vendor_feedback_on_product_scripts() {
		wp_enqueue_script( 'ajax-wcv-feedback-script', get_template_directory_uri(). '/js/ajax-wcv-feedback-script.js', array('jquery'), '1.0', true );
	  wp_localize_script( 'ajax-wcv-feedback-script', 'ajax_wcv_form_object', array(
	    'ajaxurl' => admin_url( 'admin-ajax.php' ),
	    'loadingmessage' => __('Sending e-mail, please wait...', 'plumtree')
	  ));
	}
}
add_action( 'wp_ajax_nopriv_pt_ajax_send_mail_to_vendor', 'pt_deliver_mail' );
add_action( 'wp_ajax_pt_ajax_send_mail_to_vendor', 'pt_deliver_mail' );
add_action( 'init', 'pt_vendor_feedback_on_product_scripts' );

// HTML code for form
if (!function_exists('pt_html_form_code')) {
	function pt_html_form_code() {
		global $product;
		// Start session for captcha validation
		if (!isset ($_SESSION)) session_start();
		$_SESSION['captcha-rand'] = isset($_SESSION['captcha-rand']) ? $_SESSION['captcha-rand'] : rand(100, 999);

		$output = '<div class="vendor-feed-container">';
		$output .= '<a class="btn btn-primary rounded" role="button" data-toggle="collapse" href="#collapseFeedForm" aria-expanded="false" aria-controls="collapseExample">
  				   '.esc_html__('Ask a question about this Product', 'plumtree').'
				    </a>';
		$output .= '<div class="collapse" id="collapseFeedForm">';
		$output .= '<form id="vendor-feedback" class="about-product-question" method="post">
				   '.wp_nonce_field('ajax-vendor-feedback-nonce', 'security').
				   '<input id="vendor-mail" type="hidden" name="cf-vendor-mail" value="'.get_the_author_meta('user_email').'">';
		$output .= '<div>';
		$output .= '<p class="form-row form-row-wide">
					<label for="sender-name">'.esc_html__('Your Name ', 'plumtree').'<abbr title="required" class="required">*</abbr></label>
					<input required aria-required="true" id="sender-name" type="text" name="name" pattern="[a-zA-Z0-9 ]+" value="' . ( isset( $_POST["name"] ) ? esc_attr( $_POST["name"] ) : '' ) . '" />
					<input type="text" name="firstname" id="sender-firstname" maxlength="50" value="' . ( isset( $_POST["firstname"] ) ? esc_attr( $_POST["firstname"] ) : '' ) . '" />
					<input type="text" name="lastname" id="sender-lastname" maxlength="50" value="' . ( isset( $_POST["lastname"] ) ? esc_attr( $_POST["lastname"] ) : '' ) . '" />
					</p>';
		$output .= '<p class="form-row form-row-wide">
					<label for="sender-email">'.esc_html__('Your Email ', 'plumtree').'<abbr title="required" class="required">*</abbr></label>
					<input required aria-required="true" id="sender-email" type="email" name="email" value="' . ( isset( $_POST["email"] ) ? esc_attr( $_POST["email"] ) : '' ) . '" />
					</p>';
		$output .= '<p class="form-row form-row-wide">
					<label for="subject">'.esc_html__('Subject ', 'plumtree').'<abbr title="required" class="required">*</abbr></label>
					<input required aria-required="true" id="subject" type="text" name="subject" pattern="[a-zA-Z ]+" value="' . ( isset( $_POST["subject"] ) ? esc_attr( $_POST["subject"] ) : esc_html__('Question about ', 'plumtree').esc_attr(get_the_title()) ) . '" />
					</p>';
		$output .= '</div>';
		$output .= '<div>';
		$output .= '<p class="form-row form-row-wide">
					<label for="captcha">'.esc_html__('Captcha, enter number: ', 'plumtree').$_SESSION['captcha-rand'].' <abbr title="required" class="required">*</abbr></label>
					<input required aria-required="true" id="captcha" type="text" name="captcha" maxlength="3" pattern="\d*" value="' . ( isset( $_POST["captcha"] ) ? esc_html( $_POST["captcha"] ) : '' ) . '" />
					</p>';
		$output .= '<p class="form-row form-row-wide">
					<label for="text-message">'.esc_html__('Your Message ', 'plumtree').'<abbr title="required" class="required">*</abbr></label>
					<textarea required aria-required="true" id="text-message" name="message">' . ( isset( $_POST["message"] ) ? esc_attr( $_POST["message"] ) : '' ) . '</textarea>
					</p>';
		$output .= '</div>';
		$output .= '<input class="submit-btn" type="submit" name="cf-submitted" value="'.esc_html__('Send', 'plumtree').'">
					<p class="status"></p>';
		$output .= '</form>';
		$output .= '</div></div>';

		$vendor_id = WCV_Vendors::get_vendor_from_product( $product->product_id );
		$question_form = get_user_meta( $vendor_id , 'pv_question_form', true );

		if ( $question_form === 'on' ) {
			return $output;
		}
	}
}
add_filter( 'wcv_after_seller_info_tab', 'pt_html_form_code' );

// Delivery handle for form
if (!function_exists('pt_deliver_mail')) {
	function pt_deliver_mail() {

		// First check the nonce, if it fails the function will break
    check_ajax_referer( 'ajax-vendor-feedback-nonce', 'security' );
		$error = false;
		$sent = false;

		// Sanitize form values
		$name      = sanitize_text_field( $_POST["sender"] );
		$email     = sanitize_email( $_POST["sender-email"] );
		$subject   = sanitize_text_field( $_POST["subject"] );
		$message   = esc_textarea( $_POST["text"] );
		$to        = sanitize_email( $_POST["to-email"] );
		$firstname = sanitize_text_field( $_POST["sender-first-name"] );
		$lastname  = sanitize_text_field( $_POST["sender-last-name"] );
		$captcha   = esc_html( $_POST["captcha"] );

		// Validate captcha
		if ( $captcha != $_SESSION['captcha-rand'] ) {
				$error = true;
				echo json_encode( array( 'message' => esc_html__('Please enter the correct number for captcha.', 'plumtree'), ) );
				die();
		}

		// Validate honeypot field
		if ( strlen($firstname)>0 || strlen($lastname)>0 ) {
				$error = true;
				echo json_encode( array( 'message' => esc_html__('An unexpected error occurred.', 'plumtree'), ) );
				die();
		}

		$headers[] = "Reply-To: $name <$email>" . "\r\n";

		if ( wp_mail( $to, $subject, $message, $headers ) && $error == false) {
				$sent = true;
				echo json_encode( array( 'message' => esc_html__('Thanks for contacting me, expect a response soon.', 'plumtree'), ) );
		} else {
				echo json_encode( array( 'message' => esc_html__('An unexpected error occurred.', 'plumtree'), ) );
		}

		// Send message and unset captcha variabele
		if(isset($sent) && $sent == true) {
			unset($_SESSION['captcha-rand']);
		}

		die();
	}
}


/* Modifying Vendor's rating tab */

if ( class_exists('WCVendors_Pro') ) {
	// Remove rating tab
	if (!function_exists('remove_vendors_rating_tab')) {
		function remove_vendors_rating_tab($tabs) {
			if ( $tabs['vendor_ratings_tab'] ) {
				unset( $tabs['vendor_ratings_tab'] );
			}
			return $tabs;
		}
	}
	add_filter( 'woocommerce_product_tabs', 'remove_vendors_rating_tab' );

	// Add rating to seller info tab
	if (!function_exists('additional_vendors_info')) {
		function additional_vendors_info() {
			$vendor_id = WCV_Vendors::get_vendor_from_product( get_the_ID() );
			if ( WCV_Vendors::is_vendor( $vendor_id ) ) {
				// Store logo
				$store_icon_src = wp_get_attachment_image_src( get_user_meta( $vendor_id, '_wcv_store_icon_id', true ), 'pt-vendor-main-logo' );
				$store_icon = '';
				if ( is_array( $store_icon_src ) ) {
					$store_icon = '<img src="'. esc_url($store_icon_src[0]).'" alt="vendor logo" class="store-icon" />';
				}
				// Socials
				$twitter_username 	= get_user_meta( $vendor_id , '_wcv_twitter_username', true );
				$instagram_username = get_user_meta( $vendor_id , '_wcv_instagram_username', true );
				$facebook_url 		  = get_user_meta( $vendor_id , '_wcv_facebook_url', true );
				$linkedin_url 		  = get_user_meta( $vendor_id , '_wcv_linkedin_url', true );
				$youtube_url 		    = get_user_meta( $vendor_id , '_wcv_youtube_url', true );
				$googleplus_url 	  = get_user_meta( $vendor_id , '_wcv_googleplus_url', true );
				$socials = '';
				if ( $facebook_url != '') { $socials .= '<li><a href="'.esc_url($facebook_url).'" target="_blank"><i class="fa fa-facebook-square"></i></a></li>'; }
				if ( $instagram_username != '') { $socials .= '<li><a href="//instagram.com/'.esc_attr($instagram_username).'" target="_blank"><i class="fa fa-instagram"></i></a></li>'; }
				if ( $twitter_username != '') { $socials .= '<li><a href="//twitter.com/'.esc_attr($twitter_username).'" target="_blank"><i class="fa fa-twitter-square"></i></a></li>'; }
				if ( $googleplus_url != '') { $socials .= '<li><a href="'.esc_url($googleplus_url).'" target="_blank"><i class="fa fa-google-plus-square"></i></a></li>'; }
				if ( $youtube_url != '') { $socials .= '<li><a href="'.esc_url($youtube_url).'" target="_blank"><i class="fa fa-youtube-square"></i></a></li>'; }
				if ( $linkedin_url != '') { $socials .= '<li><a href="'.esc_url($linkedin_url).'" target="_blank"><i class="fa fa-linkedin-square"></i></a></li>'; }
	  			// Ratings
	  			$ratings = '';
	  			if ( ! WCVendors_Pro::get_option( 'ratings_management_cap' ) ) {
	  				$average_rate = WCVendors_Pro_Ratings_Controller::get_ratings_average( $vendor_id );
	  				$rate_count = WCVendors_Pro_Ratings_Controller::get_ratings_count( $vendor_id );
	  				$url = WCVendors_Pro_Vendor_Controller::get_vendor_store_url( $vendor_id ) . 'ratings';
	  				if ( $average_rate !=0 ) {
		  				$ratings .= esc_html__('Rating: ', 'plumtree').'<span>'.esc_attr($average_rate).'</span>'.esc_html__(' based on ', 'plumtree').sprintf( _n( '1 rating.', '%s ratings.', $rate_count, 'plumtree' ), $rate_count);
		  				$ratings .= '<a href="'.esc_url($url).'">'.esc_html__('View all ratings', 'plumtree').'</a>';
	  				} else {
	  					$ratings .= esc_html__("Rating: This Seller still doesn't have any ratings yet.", 'plumtree');
	  				}
	  			}

	  			// Output all info
					$store_url = WCVendors_Pro_Vendor_Controller::get_vendor_store_url( $vendor_id );
					$store_name = get_user_meta( $vendor_id, 'pv_shop_name', true );
	  			$store_info = '<div class="pv_additional_seller_info">';
	  			if ($store_icon != '') {
	  				$store_info .= '<div class="store-brand">'.$store_icon.'</div>';
	  			}
			   	$store_info .= '<div class="store-info">';
			   	$store_info .= '<h3><a href="'.esc_url($store_url).'">'.esc_attr($store_name).'</a></h3>';
				$store_info .= '<div class="rating-container">'.$ratings.'</div>';
				if ($socials != '') {
	  				$store_info .= '<ul class="social-icons">'.$socials.'</ul>';
	  			}
			   	$store_info .= '</div></div>';
			   	return $store_info;
			}
		}
	}
	add_filter( 'wcv_before_seller_info_tab', 'additional_vendors_info' );
}


/* Removing empty label on application page */
if (!function_exists('pt_remove_label_on_signup')) {
	function pt_remove_label_on_signup() {
		return array(
			'type' => 'hidden',
			'id' => '_wcv_vendor_application_id',
			'value'	=> get_current_user_id(),
			'show_label' => false
		);
	}
}
add_filter( 'wcv_vendor_application_id', 'pt_remove_label_on_signup');


/* Message seller on single vendor shop page */
// Enque scripts
if (!function_exists('pt_message_sender_scripts')) {
	function pt_message_sender_scripts() {
		wp_enqueue_script( 'pt_vendor_message_sender', get_template_directory_uri() . '/js/ajax-message-sender.js', array('jquery'), '1.0', true );
		wp_localize_script( 'pt_vendor_message_sender', 'ajax_message_sender_var', array(
			'url' => admin_url( 'admin-ajax.php' ),
			'loadingmessage' => __('Sending e-mail, please wait...', 'plumtree')
			)
		);
	}
}
add_action( 'wp_ajax_nopriv_pt-message-sender', 'pt_deliver_message' );
add_action( 'wp_ajax_pt-message-sender', 'pt_deliver_message' );
add_action( 'init', 'pt_message_sender_scripts' );

// Form output
if (!function_exists('pt_message_seller_form')) {
	function pt_message_seller_form($vendor_id) {

		// Start session for captcha validation
		if (!isset ($_SESSION)) session_start();
		$_SESSION['captcha-rand'] = isset($_SESSION['captcha-rand']) ? $_SESSION['captcha-rand'] : rand(100, 999); ?>

		<div class="vendor-message-seller-container">
			<a class="btn btn-primary rounded" id="pt-message-seller" href="#">
				<i class="fa fa-envelope-o" aria-hidden="true"></i><?php esc_html_e('Message Sender', 'plumtree'); ?>
			</a>
		</div>

		<form id="vendor-message-seller" class="vendor-message-seller-form" method="post">
			<h4><?php esc_html_e('Send Vendor a Message', 'plumtree'); ?></h4>
			<p class="status"></p>
			<?php wp_nonce_field('ajax-vendor-message-seller-nonce', 'seller-security'); ?>
			<input id="vendor-mail" type="hidden" name="cf-vendor-mail" value="<?php $user_info = get_userdata($vendor_id); echo esc_attr($user_info->user_email); ?>">
				<p class="form-row form-row-wide">
					<label for="sender-name"><?php esc_html_e('Your Name ', 'plumtree'); ?><abbr title="required" class="required">*</abbr></label>
					<input required aria-required="true" id="sender-name" type="text" name="name" pattern="[a-zA-Z0-9 ]+" value="<?php echo ( isset( $_POST["name"] ) ? esc_attr( $_POST["name"] ) : '' ); ?>" />
					<input type="text" name="firstname" id="sender-firstname" maxlength="50" value="<?php echo ( isset( $_POST["firstname"] ) ? esc_attr( $_POST["firstname"] ) : '' ); ?>" />
					<input type="text" name="lastname" id="sender-lastname" maxlength="50" value="<?php echo ( isset( $_POST["lastname"] ) ? esc_attr( $_POST["lastname"] ) : '' ); ?>" />
				</p>
				<p class="form-row form-row-wide">
					<label for="sender-email"><?php esc_html_e('Your Email ', 'plumtree'); ?><abbr title="required" class="required">*</abbr></label>
					<input required aria-required="true" id="sender-email" type="email" name="email" value="<?php echo ( isset( $_POST["email"] ) ? esc_attr( $_POST["email"] ) : '' ); ?>" />
				</p>
				<p class="form-row form-row-wide">
					<label for="subject"><?php esc_html_e('Subject ', 'plumtree'); ?><abbr title="required" class="required">*</abbr></label>
					<input required aria-required="true" id="subject" type="text" name="subject" pattern="[a-zA-Z ]+" value="<?php echo ( isset( $_POST["subject"] ) ? esc_attr( $_POST["subject"] ) : '' ); ?>" />
				</p>
				<p class="form-row form-row-wide">
					<label for="text-message"><?php echo esc_html__('Your Message ', 'plumtree'); ?><abbr title="required" class="required">*</abbr></label>
					<textarea required aria-required="true" id="text-message" name="message"><?php echo ( isset( $_POST["message"] ) ? esc_attr( $_POST["message"] ) : '' ); ?></textarea>
				</p>
				<p class="form-row form-row-wide captcha">
					<label for="captcha"><?php echo esc_html__('Captcha, enter number: ', 'plumtree').$_SESSION['captcha-rand']; ?><abbr title="required" class="required">*</abbr></label>
					<input required aria-required="true" id="captcha" type="text" name="captcha" maxlength="3" pattern="\d*" value="<?php echo ( isset( $_POST["captcha"] ) ? esc_html( $_POST["captcha"] ) : '' ); ?>" />
				</p>
			<input class="submit-btn" type="submit" name="seller-form-submitted" value="<?php esc_html_e('Send', 'plumtree'); ?>">
			<a class="close" href=""><?php esc_html_e('(close)', 'plumtree');?></a>
		</form>

	<?php }
}

// Delivery handle for form
if (!function_exists('pt_deliver_message')) {
	function pt_deliver_message() {
		// First check the nonce, if it fails the function will break
		check_ajax_referer( 'ajax-vendor-message-seller-nonce', 'security' );
		$error = false;
		$sent = false;

		// sanitize form values
		$name      = sanitize_text_field( $_POST["sender"] );
		$email     = sanitize_email( $_POST["sender-email"] );
		$subject   = sanitize_text_field( $_POST["subject"] );
		$message   = esc_textarea( $_POST["text"] );
		$to        = sanitize_email( $_POST["to-email"] );
		$firstname = sanitize_text_field( $_POST["sender-first-name"] );
		$lastname  = sanitize_text_field( $_POST["sender-last-name"] );
		$captcha   = esc_html( $_POST["captcha"] );

		// Validate captcha
		if ( $captcha != $_SESSION['captcha-rand'] ) {
				$error = true;
				echo json_encode( array( 'message' => esc_html__('Please enter the correct number for captcha.', 'plumtree'), ) );
				die();
		}

		// Validate honeypot field
		if ( strlen($firstname)>0 || strlen($lastname)>0 ) {
				$error = true;
				echo json_encode( array( 'message' => esc_html__('An unexpected error occurred.', 'plumtree'), ) );
				die();
		}

		$headers[] = "Reply-To: $name <$email>" . "\r\n";

		if ( wp_mail( $to, $subject, $message, $headers ) && $error == false) {
				$sent = true;
				echo json_encode( array( 'message' => esc_html__('Thanks for contacting me, expect a response soon.', 'plumtree'), ) );
		} else {
				echo json_encode( array( 'message' => esc_html__('An unexpected error occurred.', 'plumtree'), ) );
		}

		// Send message and unset captcha variabele
		if(isset($sent) && $sent == true) {
			unset($_SESSION['captcha-rand']);
		}

		die();
	}
}


/* Extra tabs on single vendor shop page */
if (!function_exists('pt_output_vendor_tabs')) {
	function pt_output_vendor_tabs(){

		$vendor_shop = urldecode( get_query_var( 'vendor_shop' ) );
		$vendor_rating_page = urldecode( get_query_var( 'ratings' ) );
		$vendor_id = WCV_Vendors::get_vendor_id( $vendor_shop );
		$featured_carousel = get_user_meta( $vendor_id , 'pv_featured_carousel', true );
		$store_rates	= get_user_meta( $vendor_id, '_wcv_shipping', true );
		$default_shipping_settings = get_option( 'woocommerce_wcv_pro_vendor_shipping_settings' );

		$shipping_policy 	= ( empty( $store_rates[ 'shipping_policy' ] ) ) ? $default_shipping_settings[ 'shipping_policy'] : $store_rates[ 'shipping_policy' ];
		$return_policy		= ( empty( $store_rates[ 'return_policy' ] ) ) ? $default_shipping_settings[ 'return_policy'] : $store_rates[ 'return_policy' ];
		?>

		<?php if (!$vendor_rating_page) { ?>
		<div class="tabbable vendor-shop-tabs"><!-- start of vendor tabs -->

			<ul class="nav nav-tabs">
				<li class="active"><a href="#vendor-ratings" data-toggle="tab"><?php esc_html_e('Reviews', 'plumtree'); ?></a></li>
				<?php if ( $featured_carousel=='on' ) { ?>
				<li><a href="#vendor-feature-products" data-toggle="tab"><?php esc_html_e('Best Deals', 'plumtree'); ?></a></li>
				<?php }
				if ( !empty($shipping_policy) || !empty($return_policy) ) { ?>
				<li><a href="#vendor-policies" data-toggle="tab"><?php esc_html_e('Policies', 'plumtree'); ?></a></li>
				<?php } ?>
			</ul>

			<div class="tab-content"><!-- start of tab content -->

				<?php // Vendor ratings output
				if ( !$vendor_rating_page ) { ?>
				<div id="vendor-ratings" class="tab-pane active">
					<?php $vendor_ratings = WCVendors_Pro_Ratings_Controller::get_vendor_feedback( $vendor_id );
								$average_rate = WCVendors_Pro_Ratings_Controller::get_ratings_average( $vendor_id );
								$rate_count = WCVendors_Pro_Ratings_Controller::get_ratings_count( $vendor_id );
								$vendor_orders = WCVendors_Pro_Vendor_Controller::get_orders2( $vendor_id );
								$total_orders = count($vendor_orders);
								$reviews_url = WCVendors_Pro_Vendor_Controller::get_vendor_store_url( $vendor_id ) . 'ratings';

					if ( $vendor_ratings ) {
						$count = 0;

	  				if ( $average_rate !=0 ) {
							echo '<div class="vendor-reviews-meta col-xs-12 col-sm-3">';
		  				echo '<p class="rating-container"><i class="fa fa-star" aria-hidden="true"></i>'.esc_html__('Rating: ', 'plumtree').'<span>'.esc_attr($average_rate).'</span>'.esc_html__(' based on ', 'plumtree').sprintf( _n( '1 review.', '%s reviews.', $rate_count, 'plumtree' ), $rate_count).'</p>';
							echo '<p><i class="fa fa-calendar-check-o" aria-hidden="true"></i>'.esc_html__('Orders in total: ', 'plumtree').esc_attr($total_orders).'</p>';
							echo '<p>'.esc_html__('Latest reviews presented here ', 'plumtree').'<i class="fa fa-arrow-right" aria-hidden="true"></i></p>';
							echo '<p><a class="btn btn-primary rounded" href="'.esc_url($reviews_url).'">'.__('View all ratings', 'plumtree').'</a></p>';
							echo '</div>';
	  				}

						echo '<div class="vendor-reviews col-xs-12 col-sm-9">';
						foreach ( $vendor_ratings as $vendor_rating ) {
							/* Show only 3 latest reviews */
							if ($count > 2 ) {
								continue;
							}

							$customer = get_userdata( $vendor_rating->customer_id );
							$rating = $vendor_rating->rating;
							$rating_title	= $vendor_rating->rating_title;
							$comment = $vendor_rating->comments;
							$post_date = date_i18n( get_option( 'date_format' ), strtotime( $vendor_rating->postdate ) );
							$customer_name = ucfirst( $customer->display_name );
							$product_link	= get_permalink( $vendor_rating->product_id );
							$product_title = get_the_title( $vendor_rating->product_id );

							// This outputs the star rating
							$stars = '';
							for ($i = 1; $i<=stripslashes( $rating ); $i++) { $stars .= "<i class='fa fa-star'></i>"; }
							for ($i = stripslashes( $rating ); $i<5; $i++) { $stars .=  "<i class='fa fa-star-o'></i>"; }
							?>

							<div class="single-rating">
								<p>
									<?php esc_html_e('Product: ', 'plumtree'); ?>
									<a href="<?php echo esc_url($product_link); ?>" target="_blank"><?php echo esc_attr($product_title); ?></a>
								</p>
								<p>
									<span><?php _e( 'Posted on ', 'plumtree'); echo esc_attr($post_date); ?></span>
									<?php _e( ' by ', 'plumtree'); echo esc_attr($customer_name); ?>
								</p>
								<div class="review-container">
									<div class="value"><?php echo $stars; ?></div>
									<?php if ( ! empty( $rating_title ) ) { echo '<h6>'.esc_attr($rating_title).'</h6><br />'; } ?>
									<p><?php echo esc_textarea($comment); ?></p>
								</div>
							</div>

							<?php $count++;
						}
						echo '</div>';
					} else {  esc_html_e( 'No ratings have been submitted for this vendor yet.', 'plumtree' ); }  ?>
				</div>
				<?php } ?>

				<?php if ( $featured_carousel=='on' ) { // start of vendor featured carousel  ?>
				<div id="vendor-feature-products" class="tab-pane">
					<?php // New query for carousel products
					$args = array(
						'post_type'	=> 'product',
						'ignore_sticky_posts' => 1,
						'no_found_rows' => 1,
						'posts_per_page' => -1,
						'orderby' => 'name',
						'author' => $vendor_id,
							'meta_query' => array(
								array(
									'key'   => 'pt_vendor_special_offers_carousel',
									'value' => 'on'
								),
						),
					);
					$products = new WP_Query( $args );
					if ( $products->have_posts() ) : ?>
					<div class="pt-woo-shortcode with-slider"
						 data-owl="container"
						 data-owl-slides="4"
						 data-owl-type="woo_shortcode"
						 data-owl-pagi="true"
						 data-owl-navi="false">

						<ul class="special-offers">
							<?php while ( $products->have_posts() ) : $products->the_post(); ?>
								<?php woocommerce_get_template_part( 'content', 'product' ); ?>
							<?php endwhile; // end of the loop. ?>
						</ul>

						<?php endif;
						wp_reset_postdata(); ?>
					</div>
				</div>
				<?php } // end of vendor featured carousel ?>

				<?php if ( !empty($shipping_policy) || !empty($return_policy) ) { // start of vendor policies  ?>
					<div id="vendor-policies" class="tab-pane">

					<?php if ( $shipping_policy != '' ):  ?>
					<h5><?php esc_html_e( 'Shipping Policy', 'plumtree' ); ?></h5>
					<p>
					<?php echo $shipping_policy; ?>
					</p>
					<?php endif; ?>

					<?php if ( $return_policy != '' ):  ?>
					<h5><?php esc_html_e( 'Return Policy', 'plumtree' ); ?></h5>
					<p>
					<?php echo $return_policy; ?>
					</p>
					<?php endif; ?>

					</div>
				<?php } // end of vendor policies ?>

		</div><!-- end of tab content -->

	</div><!-- end of vendor tabs -->
	<?php } ?>

<?php	}
}
add_action('wcv_after_vendor_store_header', 'pt_output_vendor_tabs');
