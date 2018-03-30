<?php  
function thb_ocdi_import_files() {
    return array(
        array(
            'import_file_name'       => 'North',
            'import_file_url'        => "http://themes.fuelthemes.net/theme-demo-files/north/north/demo-content.xml",
            'import_widget_file_url' => "http://themes.fuelthemes.net/theme-demo-files/north/north/widget_data.json",
            'import_theme_options_url' => "http://themes.fuelthemes.net/theme-demo-files/north/north/theme-options.txt"
        ),
        array(
            'import_file_name'       => 'Sophie',
            'import_file_url'        => "http://themes.fuelthemes.net/theme-demo-files/north/sophie/demo-content.xml",
            'import_widget_file_url' => "http://themes.fuelthemes.net/theme-demo-files/north/sophie/widget_data.json",
            'import_theme_options_url' => "http://themes.fuelthemes.net/theme-demo-files/north/sophie/theme-options.txt"
        )
    );
}
add_filter( 'pt-ocdi/import_files', 'thb_ocdi_import_files' );

function thb_ocdi_after_import( $selected_import ) {
	
	/* Set Pages */
	$home = get_page_by_title('Home');
	$blog = get_page_by_title('Blog');
	$myaccount = get_page_by_title('My Account');
	
	
	$shop = get_page_by_title('Shop');
	$cart = get_page_by_title('Cart');
	$checkout = get_page_by_title('Checkout');
	
	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $home->ID );
	update_option( 'page_for_posts', $blog->ID );
	
	update_option( 'woocommerce_myaccount_page_id', $myaccount->ID );
	update_option( 'woocommerce_shop_page_id', $shop->ID );
	update_option( 'woocommerce_cart_page_id', $cart->ID );
	update_option( 'woocommerce_checkout_page_id', $checkout->ID );
	update_option( 'yith_wcwl_button_position', 'shortcode');
	
	// We no longer need to install pages for WooCommerce
  delete_option( '_wc_needs_pages' );
  delete_transient( '_wc_activation_redirect' );

  // Flush rules after install
  flush_rewrite_rules();
	
	/* Set Menus */
	$navigation = get_term_by('name', 'navigation', 'nav_menu');
	$secondary_in = get_term_by('name', 'secondary-in', 'nav_menu');
	$secondary_out = get_term_by('name', 'secondary-out', 'nav_menu');
	
	set_theme_mod( 'nav_menu_locations' , array('mobile-menu' => $navigation->term_id, 'nav-menu' => $navigation->term_id, 'acc-menu-in' => $secondary_in->term_id, 'acc-menu-out' => $secondary_out->term_id, 'mobile-secondary-menu' => $mini->term_id ) );
}
add_action( 'pt-ocdi/after_import', 'thb_ocdi_after_import' );