<?php


/* Add notices to header */
function flatsome_woocommerce_add_notice() {
    wc_print_notices();
}
add_action('flatsome_after_header','flatsome_woocommerce_add_notice', 100);


/* Fix refresh urls for my account after install */
function flatsome_endpoint_bug(){
    if(!current_user_can('manage_options') && !wp_get_post_parent_id(get_option( 'woocommerce_myaccount_page_id' ))) return;
    flush_rewrite_rules();
}
add_action('flatsome_before_404','flatsome_endpoint_bug');

function flatsome_my_account_menu_classes($classes){

    // Add Active Class
    if(in_array('is-active', $classes)){
      array_push($classes, 'active');
    }

    return $classes;
}
add_filter('woocommerce_account_menu_item_classes', 'flatsome_my_account_menu_classes');

/* My Account Dashboard overview */
function flatsome_my_account_dashboard(){
  return wc_get_template( 'myaccount/dashboard-links.php' );
}
add_action('woocommerce_account_dashboard','flatsome_my_account_dashboard');


// Remove logout from my account menu
function flatsome_remove_logout_account_item( $items ) {
  unset( $items['customer-logout'] ); 
  return $items;
}
add_filter( 'woocommerce_account_menu_items', 'flatsome_remove_logout_account_item' );


/* Setup Flatsome Scripts and CSS */
function flatsome_woocommerce_scripts_styles() {

  // Remove default WooCommerce Lightbox
  if(get_theme_mod('product_lightbox','default') !== 'woocommerce' || !is_product()){
      wp_deregister_style( 'woocommerce_prettyPhoto_css' );
      wp_dequeue_script( 'prettyPhoto' );
      wp_dequeue_script( 'prettyPhoto-init' );
  }

  if ( ! is_admin() ) {
    wp_deregister_style('woocommerce-layout');
    wp_deregister_style('woocommerce-smallscreen');
    wp_deregister_style('woocommerce-general');
  }

}
add_action( 'wp_enqueue_scripts', 'flatsome_woocommerce_scripts_styles',98);



// Set Layzy load Image height for Product Images
if(!is_admin() && get_theme_mod('lazy_load_images')){
  function flatsome_lazy_load_product_image_size() {
      $image_size = get_option( 'shop_catalog_image_size' );
      $new_height = 100 / ($image_size['width'] / $image_size['height']).'%';
      echo '<style>.product-gallery img.lazy-load, .product-small img.lazy-load, .product-small img[data-lazy-srcset]:not(.lazyloaded){ padding-top: '.$new_height.';}</style>';
  }
  add_filter('wp_head', 'flatsome_lazy_load_product_image_size');
}


// Add Shop  Widgets
function flatsome_shop_widgets_init() {

  register_sidebar( array(
    'name'          => __( 'Shop Sidebar', 'flatsome' ),
    'id'            => 'shop-sidebar',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h3 class="widget-title shop-sidebar">',
    'after_title'   => '</h3><div class="is-divider small"></div>',
  ) );

  register_sidebar( array(
    'name'          => __( 'Product Sidebar', 'flatsome' ),
    'id'            => 'product-sidebar',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h3 class="widget-title shop-sidebar">',
    'after_title'   => '</h3><div class="is-divider small"></div>',
  ) );


}
add_action( 'widgets_init', 'flatsome_shop_widgets_init' );



/* Modify define(name, value)ault Shop Breadcrumbs */
function flatsome_woocommerce_breadcrumbs() {

    $home = (get_theme_mod('breadcrumb_home',1)) ? _x( 'Home', 'breadcrumb', 'woocommerce' ) : false;

    return array(
        'delimiter'   => '&#47;',
        'wrap_before' => '<nav class="woocommerce-breadcrumb breadcrumbs" itemprop="breadcrumb">',
        'wrap_after'  => '</nav>',
        'before'      => '',
        'after'       => '',
        'home'        => $home
    );
}

add_filter( 'woocommerce_breadcrumb_defaults', 'flatsome_woocommerce_breadcrumbs' );



/* Update cart price */
function flatsome_header_add_to_cart_fragment( $fragments ) {
  global $woocommerce;
  ob_start();
  ?> <span class="cart-price"><?php echo $woocommerce->cart->get_cart_subtotal(); ?></span><?php
  $fragments['.cart-price'] = ob_get_clean();

  return $fragments;

}
add_filter('add_to_cart_fragments', 'flatsome_header_add_to_cart_fragment');

/* Update cart number */
function flatsome_header_add_to_cart_fragment_count( $fragments ) {
  global $woocommerce;
  ob_start();
  ?>
  <span class="cart-icon image-icon">
    <strong><?php echo $woocommerce->cart->cart_contents_count; ?></strong>
  </span><?php
  $fragments['.header .cart-icon'] = ob_get_clean();
  return $fragments;

}
add_filter('add_to_cart_fragments', 'flatsome_header_add_to_cart_fragment_count');


/* Update cart label */
if(get_theme_mod('cart_icon_style')){
  function flatsome_header_add_to_cart_fragment_count_label( $fragments ) {
    global $woocommerce;
    $icon = get_theme_mod('cart_icon','basket');
    ob_start();
    ?>
    <i class="icon-shopping-<?php echo $icon ;?>" data-icon-label="<?php echo $woocommerce->cart->cart_contents_count; ?>"><?php
    $fragments['i.icon-shopping-'.$icon] = ob_get_clean();
    return $fragments;
  }
  add_filter('add_to_cart_fragments', 'flatsome_header_add_to_cart_fragment_count_label');
}

// Add Pages and blog posts to top of search results if set.
function flatsome_pages_in_search_results(){
    if(!is_search() || !get_theme_mod('search_result', 0)) return;
    global $post;
    ?>
    <?php if( get_search_query() ) : ?>
    <?php
      /**
       * Include pages and posts in search
       */
      query_posts( array( 'post_type' => array( 'post', 'page' ), 's' => get_search_query() ) );
      $posts = array();
      while ( have_posts() ) : the_post();
        $wc_page = false;
        if($post->post_type == 'page'){
          foreach (array('shop', 'cart', 'checkout', 'view_order', 'terms') as $wc_page_type) {
            if( $post->ID == woocommerce_get_page_id($wc_page_type) ) $wc_page = true;
          }
        }
        if( !$wc_page ) array_push($posts, $post->ID);
      endwhile;

      if(!empty($posts)){
        echo '<hr/>';
        echo '<h4 class="uppercase">'.__('Pages and posts found','flatsome').'</h4>';
        echo do_shortcode('[blog_posts columns="3" image_height="16-9" ids="'.implode(',',$posts).'"]'); 
      }
      wp_reset_query();
    ?>
    <?php endif; ?>

    <?php
}
add_action('woocommerce_after_main_content','flatsome_pages_in_search_results', 10);



// Get presentage bubble
function flatsome_presentage_bubble($product, $before = '-', $after = '%'){
  $price = '';
  if($product->product_type == 'simple'){
      $price = $before.round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 ).$after;
  } else if($product->product_type == 'variable'){
    $price = ''; 
    $available_variations = $product->get_available_variations();               
    $maximumper = 0;
    for ($i = 0; $i < count($available_variations); ++$i) {
      $variation_id=$available_variations[$i]['variation_id'];
      $variable_product1= new WC_Product_Variation( $variation_id );
      $regular_price = $variable_product1 ->regular_price;
      $sales_price = $variable_product1 ->sale_price;
      $percentage= round((( ( $regular_price - $sales_price ) / $regular_price ) * 100),0) ;
        if ($percentage > $maximumper) {
          $maximumper = $percentage;
        }
    }
    $price = $before.$price . sprintf( __('%s', 'woocommerce' ), $maximumper . $after );
  }
  return $price;
}


// Account login style
function flatsome_account_login_lightbox(){
  // Show Login Lightbox if selected
  if ( !is_user_logged_in() && get_theme_mod('account_login_style','lightbox') == 'lightbox') {
    $is_facebook_login = in_array( 'nextend-facebook-connect/nextend-facebook-connect.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );
    $is_google_login = in_array( 'nextend-google-connect/nextend-google-connect.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );
    ?>
    <div id="login-form-popup" class="lightbox-content mfp-hide">
      <?php echo do_shortcode('[woocommerce_my_account]'); ?>
      <?php if($is_facebook_login || $is_google_login) echo woocommerce_get_template('myaccount/header.php'); ?>
    </div>
  <?php }
}
add_action('wp_footer', 'flatsome_account_login_lightbox', 10);

// Payment icons to footer
function flatsome_footer_payment_icons(){
  $icons = get_theme_mod('payment_icons_placement');
  if(is_array($icons) && !in_array('footer', $icons)) return;
  echo do_shortcode('[ux_payment_icons]');
}
add_action('flatsome_absolute_footer_secondary','flatsome_footer_payment_icons', 10);


/* Disable reviews globally */
if(get_theme_mod('disable_reviews')){
    remove_filter( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
    remove_filter( 'woocommerce_single_product_summary','woocommerce_template_single_rating', 10); 
    add_filter( 'woocommerce_product_tabs', 'wcs_woo_remove_reviews_tab', 98 );
    function wcs_woo_remove_reviews_tab($tabs) {
     unset($tabs['reviews']);
     return $tabs;
    }
}