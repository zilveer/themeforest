<?php

// =============================================================================
// FUNCTIONS/GLOBAL/PLUGINS/WOOCOMMERCE.PHP
// -----------------------------------------------------------------------------
// Plugin setup for theme compatibility.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Administration
//   02. Global Setup
//   03. Shop
//   04. Product
//   05. Cart
//   06. Related Products
//   07. Upsells
//   08. Navbar
//   09. AJAX
// =============================================================================

// Administration
// =============================================================================

//
// Image sizes.
//
// 1. Product category thumbs.
// 2. Single product thumbs.
// 3. Image gallery thumbs.
//

function x_woocommerce_image_dimensions() {
  $catalog = array(
    'width'  => '250',
    'height' => '275',
    'crop'   => 1
  );

  $single = array(
    'width'  => '400',
    'height' => '400',
    'crop'   => 1
  );

  $thumbnail = array(
    'width'  => '100',
    'height' => '100',
    'crop'   => 1
  );

  update_option( 'shop_catalog_image_size', $catalog );     // 1
  update_option( 'shop_single_image_size', $single );       // 2
  update_option( 'shop_thumbnail_image_size', $thumbnail ); // 3
}

if ( isset( $_GET['activated'] ) ) {
  add_action( 'admin_init', 'x_woocommerce_image_dimensions', 1 );
}

//
// Modify variation images to use the X entry size like single simple products to avoid display issues
//

function x_woocommerce_modify_variable_image_size( $child_id, $instance, $variation ) {
	$attachment_id = get_post_thumbnail_id( $variation->get_variation_id() );
	$attachment = wp_get_attachment_image_src( $attachment_id, 'entry' );
	$image_src = $attachment ? current( $attachment) : '';
	$child_id['image_src'] = $image_src;

	return $child_id;
}

add_filter( 'woocommerce_available_variation', 'x_woocommerce_modify_variable_image_size', 10, 3);


//
// Remove plugin settings.
//

function x_woocommerce_remove_plugin_settings( $settings ) {

  foreach ( $settings as $key => $setting ) {

    $id = $setting['id'];

    if ( $id == 'image_options' || $id == 'shop_catalog_image_size' || $id == 'shop_single_image_size' || $id == 'shop_thumbnail_image_size' ) {
      unset( $settings[$key] );
    }

  }

  return $settings;

}

add_filter( 'woocommerce_product_settings', 'x_woocommerce_remove_plugin_settings', 10 );



// Global Setup
// =============================================================================

//
// Remove default wrapper.
//

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );


//
// Remove page title.
//

function x_woocommerce_show_page_title() {
  return false;
}

add_filter( 'woocommerce_show_page_title', 'x_woocommerce_show_page_title' );



// Shop
// =============================================================================

//
// Title.
//

function x_woocommerce_template_loop_product_title() {
  echo '<h3><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h3>';
}

add_action( 'woocommerce_shop_loop_item_title', 'x_woocommerce_template_loop_product_title', 10 );
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );



//
// Get shop link.
//

function x_get_shop_link() {

  $link = get_permalink( woocommerce_get_page_id( 'shop' ) );

  return $link;

}


//
// Columns and posts per page.
//

function x_woocommerce_shop_columns() {
  return x_get_option( 'x_woocommerce_shop_columns' );
}

add_filter( 'loop_shop_columns', 'x_woocommerce_shop_columns' );


function x_woocommerce_shop_posts_per_page() {
  return x_get_option( 'x_woocommerce_shop_count' );
}

add_filter( 'loop_shop_per_page', 'x_woocommerce_shop_posts_per_page' );


//
// Shop product thumbnails.
//

function x_woocommerce_shop_product_thumbnails() {

  GLOBAL $product;

  $id     = get_the_ID();
  $thumb  = 'entry';
  $rating = $product->get_rating_html();

  woocommerce_show_product_sale_flash();
  echo '<div class="entry-featured">';
    echo '<a href="' . get_the_permalink() . '">';
      echo get_the_post_thumbnail( $id, $thumb );
      if ( ! empty( $rating ) ) {
        echo '<div class="star-rating-container aggregate">' . $rating . '</div>';
      }
    echo '</a>';
  echo "</div>";

}

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'x_woocommerce_shop_product_thumbnails', 10 );


//
// Shop item wrapper.
//

function x_woocommerce_before_shop_loop_item() {
  echo '<div class="entry-product">';
}

function x_woocommerce_after_shop_loop_item() {
  echo '</div>';
}

function x_woocommerce_before_shop_loop_item_title() {
  echo '<div class="entry-wrap"><header class="entry-header">';
}

function x_woocommerce_after_shop_loop_item_title() {
  woocommerce_template_loop_add_to_cart();
  echo '</header></div>';
}

add_action( 'woocommerce_before_shop_loop_item', 'x_woocommerce_before_shop_loop_item', 10 );
add_action( 'woocommerce_after_shop_loop_item', 'x_woocommerce_after_shop_loop_item', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'x_woocommerce_before_shop_loop_item_title', 10 );
add_action( 'woocommerce_after_shop_loop_item_title', 'x_woocommerce_after_shop_loop_item_title', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );



// Product
// =============================================================================

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );


//
// Remove sale badge.
//

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );


//
// Large thumbnail size.
//

function x_woocommerce_single_product_large_thumbnail_size() {
  return 'entry';
}

add_filter( 'single_product_large_thumbnail_size', 'x_woocommerce_single_product_large_thumbnail_size' );


//
// Small thumbnail size.
//

function x_woocommerce_single_product_small_thumbnail_size() {
  return 'shop_single';
}

add_filter( 'single_product_small_thumbnail_size', 'x_woocommerce_single_product_small_thumbnail_size' );


//
// Product wrapper.
//

function x_woocommerce_before_single_product() {
  echo '<div class="entry-wrap"><div class="entry-content">';
}

function x_woocommerce_after_single_product() {
  echo '</div></div>';
}

add_action( 'woocommerce_before_single_product', 'x_woocommerce_before_single_product', 10 );
add_action( 'woocommerce_after_single_product', 'x_woocommerce_after_single_product', 10 );


//
// Add/remove product tabs.
//

function x_woocommerce_add_remove_product_tabs( $tabs ) {

  if ( x_get_option( 'x_woocommerce_product_tab_description_enable' ) == '' ) {
    unset( $tabs['description'] );
  }

  if ( x_get_option( 'x_woocommerce_product_tab_additional_info_enable' ) == '' ) {
    unset( $tabs['additional_information'] );
  }

  if ( x_get_option( 'x_woocommerce_product_tab_reviews_enable' ) == '' ) {
    unset( $tabs['reviews'] );
  }

  return $tabs;

}

add_filter( 'woocommerce_product_tabs', 'x_woocommerce_add_remove_product_tabs', 98 );



// Cart
// =============================================================================

//
// Get cart link.
//

function x_get_cart_link() {

  $link = WC()->cart->get_cart_url();

  return $link;

}


//
// No shipping available HTML.
//

function x_woocommerce_cart_no_shipping_available_html() {

  if ( is_cart() ) {
    return '<div class="woocommerce-info x-alert x-alert-info x-alert-block"><p>' . __( 'There doesn&lsquo;t seem to be any available shipping methods. Please double check your address, or contact us if you need any help.', '__x__' ) . '</p></div>';
  } else {
    return '<p>' . __( 'There doesn&lsquo;t seem to be any available shipping methods. Please double check your address, or contact us if you need any help.', '__x__' ) . '</p>';
  }

}

add_filter( 'woocommerce_cart_no_shipping_available_html', 'x_woocommerce_cart_no_shipping_available_html' );


//
// Cart actions.
//

function x_woocommerce_cart_actions() {

  $output = '';


  //
  // Check based off of wc_coupons_enabled(), which is only available in
  // WooCommerce v2.5+.
  //

  if ( apply_filters( 'woocommerce_coupons_enabled', 'yes' === get_option( 'woocommerce_enable_coupons' ) ) ) {
    $output .= '<input type="submit" class="button" name="apply_coupon" value="' . esc_attr__( 'Apply Coupon', '__x__' ) . '">';
  }

  echo $output;

}

add_action( 'woocommerce_cart_actions', 'x_woocommerce_cart_actions' );



// Related Products
// =============================================================================

function x_woocommerce_output_related_products() {

  $count   = x_get_option( 'x_woocommerce_product_related_count' );
  $columns = x_get_option( 'x_woocommerce_product_related_columns' );

  $args = array(
    'posts_per_page' => $count,
    'columns'        => $columns,
    'orderby'        => 'rand'
  );

  woocommerce_related_products( $args, true, true );

}

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
remove_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products', 10 );
add_action( 'woocommerce_after_single_product_summary', 'x_woocommerce_output_related_products', 20 );



// Upsells
// =============================================================================

function x_woocommerce_output_upsells() {

  $count   = x_get_option( 'x_woocommerce_product_upsell_count' );
  $columns = x_get_option( 'x_woocommerce_product_upsell_columns' );

  woocommerce_upsell_display( $count, $columns, 'rand' );

}

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product', 'woocommerce_upsell_display', 10 );
add_action( 'woocommerce_after_single_product_summary', 'x_woocommerce_output_upsells', 21 );



// Navbar
// =============================================================================

//
// Cart.
//

if ( ! function_exists( 'x_woocommerce_navbar_cart' ) ) :
  function x_woocommerce_navbar_cart() {

    $cart_info   = x_get_option( 'x_woocommerce_header_cart_info' );
    $cart_layout = x_get_option( 'x_woocommerce_header_cart_layout' );
    $cart_style  = x_get_option( 'x_woocommerce_header_cart_style' );
    $cart_outer  = x_get_option( 'x_woocommerce_header_cart_content_outer' );
    $cart_inner  = x_get_option( 'x_woocommerce_header_cart_content_inner' );

    $data = array(
      'icon'  => '<i class="x-icon-shopping-cart" data-x-icon="&#xf07a;" aria-hidden="true"></i>',
      'total' => WC()->cart->get_cart_total(),
      'count' => sprintf( _n( '%d Item', '%d Items', WC()->cart->cart_contents_count, '__x__' ), WC()->cart->cart_contents_count )
    );

    $modifiers = array(
      $cart_info,
      strpos( $cart_info, '-' ) === false ? 'inline' : $cart_layout,
      $cart_style
    );

    $cart_output = '<div class="x-cart ' . implode( ' ', $modifiers ) . '">';

      foreach ( explode( '-', $cart_info ) as $info ) {
        $key = ( $info == 'outer' ) ? $cart_outer : $cart_inner;
        $cart_output .= '<span class="' . $info . '">' . $data[$key] . '</span>';
      }

    $cart_output .= '</div>';

    return $cart_output;

  }
endif;


//
// Cart fragment.
//

if ( ! function_exists( 'x_woocommerce_navbar_cart_fragment' ) ) :
  function x_woocommerce_navbar_cart_fragment( $fragments ) {

    $fragments['div.x-cart'] = x_woocommerce_navbar_cart();
    return $fragments;

  }
  add_filter( 'woocommerce_add_to_cart_fragments', 'x_woocommerce_navbar_cart_fragment' );
endif;


//
// Outputs a navigation item with the cart.
//

if ( ! function_exists( 'x_woocommerce_navbar_menu_item' ) ) :
  function x_woocommerce_navbar_menu_item( $items, $args ) {

    if ( X_WOOCOMMERCE_IS_ACTIVE && x_get_option( 'x_woocommerce_header_menu_enable' ) == '1' ) {
      if ( $args->theme_location == 'primary' ) {
        $items .= '<li class="menu-item current-menu-parent x-menu-item x-menu-item-woocommerce">'
                  . '<a href="' . x_get_cart_link() . '" class="x-btn-navbar-woocommerce">'
                    . x_woocommerce_navbar_cart()
                  . '</a>'
                . '</li>';
      }
    }

    return $items;

  }
  add_filter( 'wp_nav_menu_items', 'x_woocommerce_navbar_menu_item', 9999, 2 );
endif;



// AJAX
// =============================================================================

if ( ! function_exists( 'x_woocommerce_navbar_cart_ajax_notification' ) ) :
  function x_woocommerce_navbar_cart_ajax_notification() {

    if ( x_is_product_index() && get_option( 'woocommerce_enable_ajax_add_to_cart' ) == 'yes' ) {
      $notification = '<div class="x-cart-notification">'
                      . '<div class="x-cart-notification-icon loading">'
                        . '<i class="x-icon-cart-arrow-down" data-x-icon="&#xf218;" aria-hidden="true"></i>'
                      . '</div>'
                      . '<div class="x-cart-notification-icon added">'
                        . '<i class="x-icon-check" data-x-icon="&#xf00c;" aria-hidden="true"></i>'
                      . '</div>'
                    . '</div>';
    } else {
      $notification = '';
    }

    echo $notification;

  }
  add_action( 'x_before_site_end', 'x_woocommerce_navbar_cart_ajax_notification' );
endif;