<?php if(! defined('ABSPATH')){ return; }

/* FILTERS */
add_filter( 'zn_theme_pages', 'zn_woocommerce_pages' );
add_filter( 'zn_theme_options', 'zn_woocommerce_options' );

function zn_woocommerce_pages( $admin_pages ){
	$admin_pages['zn_woocommerce_options'] = array(
			'title' =>  'Woocommerce options',
			'submenus' => 	array(
					array(
						'slug' => 'zn_woocommerce_options',
						'title' =>  __( "General options", 'zn_framework' )
					),
					array(
						'slug' => 'woo_category_options',
						'title' =>  __( "Categories page", 'zn_framework' ),
					),
				)
		);

	return $admin_pages;
}

function zn_woocommerce_options( $admin_options ){

/**
 * ====================================================
 * GENERAL OPTIONS
 * ====================================================
 */

$admin_options[] = array (
				'slug'        => 'zn_woocommerce_options',
				'parent'      => 'zn_woocommerce_options',
				"name"        => __( 'General options', 'zn_framework' ),
				"description" => __( 'These options are generally applied for WooCommerce and Kallyas theme.', 'zn_framework' ),
				"id"          => "hd_title1",
				"type"        => "zn_title",
				"class"       => "zn_full zn-custom-title-large zn-top-separator"
);

$admin_options[] = array (
	'slug'        => 'zn_woocommerce_options',
	'parent'      => 'zn_woocommerce_options',
	"name"        => __( "Enable Catalog Mode?", 'zn_framework' ),
	"description" => __( "Choose yes if you want to turn your shop in a catalog mode shop ( all the purchase buttons will be removed. )", 'zn_framework' ),
	"id"          => "woo_catalog_mode",
	"std"         => "no",
	"type"        => "zn_radio",
	"options"     => array (
		"yes" => __( "Yes", 'zn_framework' ),
		"no"  => __( "No", 'zn_framework' )
	),
	"class"        => "zn_radio--yesno",
);
$admin_options[] = array (
	'slug'        => 'zn_woocommerce_options',
	'parent'      => 'zn_woocommerce_options',
	"name"        => __( "Show cart to visitors?", 'zn_framework' ),
	"description" => __( "Choose no if you want to hide the add to cart buttons for guest visitors (non-registered / logged-out).", 'zn_framework' ),
	"id"          => "show_cart_to_visitors",
	"std"         => "yes",
	"type"        => "zn_radio",
	"options"     => array (
		"yes" => __( "Yes", 'zn_framework' ),
		"no"  => __( "No", 'zn_framework' )
	),
	"class"        => "zn_radio--yesno",
);
$header_option = WpkZn::getThemeHeaders(true);
$admin_options[] = array (
	'slug'        => 'zn_woocommerce_options',
	'parent'      => 'zn_woocommerce_options',
	"name"        => __( "Header Style for main shop page", 'zn_framework' ),
	"description" => __( 'Select the background style you want to use.Please note that the styles can be created from the "Unlimited Headers" options in the theme admin\'s page.', 'zn_framework' ),
	"id"          => "woo_sub_header",
	"std"         => "",
	"type"        => "select",
	"options"     => $header_option,
	"class"       => ""
);

$admin_options[] = array (
	'slug'        => 'zn_woocommerce_options',
	'parent'      => 'zn_woocommerce_options',
	"name"        => __( "Search Type - <strong>General site search form</strong>", 'zn_framework' ),
	"description" => __( "Select the type of search functionality should the searchbox in general site search-forms to have. By default it performs a WordPress default search with it's results however you can switch to WooCommerce product search.", 'zn_framework' ),
	"id"          => "woo_site_search_type",
	"std"         => "wp",
	"type"        => "select",
	"options"     => array (
		"wp" => __( "Default WordPress results", 'zn_framework' ),
		"wc"  => __( "WooCommerce products search results", 'zn_framework' )
	),
);


/**
 * ====================================================
 * PRODUCTS LISTINGS
 * ====================================================
 */

$admin_options[] = array (
				'slug'        => 'zn_woocommerce_options',
				'parent'      => 'zn_woocommerce_options',
				"name"        => __( 'Product listing options', 'zn_framework' ),
				"description" => __( 'These options are applied for products in listings.', 'zn_framework' ),
				"id"          => "hd_title1",
				"type"        => "zn_title",
				"class"       => "zn_full zn-custom-title-large zn-top-separator"
);

$admin_options[] = array (
	'slug'        => 'zn_woocommerce_options',
	'parent'      => 'zn_woocommerce_options',
	"name"        => __( "Hide small description in catalog view and related products ?", 'zn_framework' ),
	"description" => __( "Choose yes if you want to hide the short description in the catalog mode and related products", 'zn_framework' ),
	"id"          => "woo_hide_small_desc",
	"std"         => "no",
	"type"        => "zn_radio",
	"options"     => array (
		"yes" => __( "Yes", 'zn_framework' ),
		"no"  => __( "No", 'zn_framework' )
	),
	"class"        => "zn_radio--yesno",
);

$admin_options[] = array (
	'slug'        => 'zn_woocommerce_options',
	'parent'      => 'zn_woocommerce_options',
	"name"        => __( "Products per page", 'zn_framework' ),
	"description" => __( "Enter the desired number of products to be displayed per page.", 'zn_framework' ),
	"id"          => "woo_show_products_per_page",
	"std"         => "9",
	"type"        => "text",
	"class"       => ""
);

$admin_options[] = array (
	'slug'        => 'zn_woocommerce_options',
	'parent'      => 'zn_woocommerce_options',
	"name"        => __( "Number of columns", 'zn_framework' ),
	"description" => __("Using this option you can choose how many columns to use on the shop archive pages.", 'zn_framework'),
	"id" => "woo_num_columns",
	"std" => "4",
	"options" => array(
		'' => __('Use default', 'zn_framework'),
		'3' => __('3', 'zn_framework'),
		'4' => __('4', 'zn_framework'),
		'5' => __('5', 'zn_framework'),
		'6' => __('6', 'zn_framework'),
	),
	"type" => "select",
);

$admin_options[] = array (
	'slug'        => 'zn_woocommerce_options',
	'parent'      => 'zn_woocommerce_options',
	'id'            => 'zn_use_second_image',
	'name'          => 'Show first gallery image on image hover ?',
	'description'   => 'Select if you want to show the first gallery image when you hover over the product in archive pages.',
	'type'          => 'toggle2',
	'std'           => 'yes',
	'value'         => 'yes'
);
$admin_options[] = array (
	'slug'        => 'zn_woocommerce_options',
	'parent'      => 'zn_woocommerce_options',
	"name"        => __( "Lazy Load Images ?", 'zn_framework' ),
	"description" => __( "This option creates a cool simple fade-in effect for images in category listing.", 'zn_framework' ),
	"id"          => "woo_img_lazyload",
	"std"         => "no",
	"type"        => "zn_radio",
	"options"     => array (
		"yes" => __( "Yes", 'zn_framework' ),
		"no"  => __( "No", 'zn_framework' )
	),
	"class"        => "zn_radio--yesno",
);


$admin_options[] = array (
   'slug'        => 'zn_woocommerce_options',
   'parent'      => 'zn_woocommerce_options',
   "name"        => __( " Products layout ", 'zn_framework' ),
   "description" => __( "Choose the products layout in archive listing.", 'zn_framework' ),
   "id"          => "woo_prod_layout",
   "std"         => "classic",
   "type"        => "radio_image",
	"class"       => "zn_full ri-bg-hover ri-3",
	"options"     => array(
		array(
			'value' => 'classic',
			'name'  => __( 'Classic', 'zn_framework' ),
			'image' => THEME_BASE_URI .'/images/admin/product-styles/product-style-01.svg'
		),
		array(
			'value' => 'style2',
			'name'  => __( 'Modern - Style #2', 'zn_framework' ),
			'image' => THEME_BASE_URI .'/images/admin/product-styles/product-style-02.svg'
		),
		array(
			'dummy' => true,
			'name'  => __( 'More soon!', 'zn_framework' ),
			'image' => THEME_BASE_URI .'/images/admin/product-styles/product-style-more.svg'
		),
	)
);


/**
 * ====================================================
 * PRODUCT ITEM PAGE OPTIONS
 * ====================================================
 */

$admin_options[] = array (
				'slug'        => 'zn_woocommerce_options',
				'parent'      => 'zn_woocommerce_options',
				"name"        => __( 'Product item page options', 'zn_framework' ),
				"description" => __( 'These options are applied for products pages.', 'zn_framework' ),
				"id"          => "hd_title1",
				"type"        => "zn_title",
				"class"       => "zn_full zn-custom-title-large zn-top-separator"
);
$admin_options[] = array (
   'slug'        => 'zn_woocommerce_options',
   'parent'      => 'zn_woocommerce_options',
   "name"        => __( " Products page layout ", 'zn_framework' ),
   "description" => __( "Choose the products page layout.", 'zn_framework' ),
   "id"          => "woo_prod_page_layout",
   "std"         => "classic",
   "options"     => array(
        array(
            'value' => 'classic',
            'name'  => __( 'Classic', 'zn_framework' ),
            'image' => THEME_BASE_URI .'/images/admin/shop-product-page-layouts/classic.gif'
        ),
        array(
            'value' => 'style2',
            'name'  => __( 'Modern - Style #2', 'zn_framework' ),
            'image' => THEME_BASE_URI .'/images/admin/shop-product-page-layouts/modern.gif'
        ),
        array(
            'value' => 'style3',
            'name'  => __( 'Modern - Full-width (No sidebar!)', 'zn_framework' ),
            'image' => THEME_BASE_URI .'/images/admin/shop-product-page-layouts/modern-full.gif'
        ),
    ),
    "type"        => "radio_image",
    "class"        => "ri-hover-line ri-3",
);

$admin_options[] = array (
	'slug'        => 'zn_woocommerce_options',
	'parent'      => 'zn_woocommerce_options',
	"name"        => __( "Override page title ?", 'zn_framework' ),
	"description" => __( "Choose if you want to show a custom title in the sub-header for single item pages. Normally, the current product title will be shown.", 'zn_framework' ),
	"id" => "zn_override_single_shop_title",
	"std" => '',
	"type" => "toggle2",
	"value" => "yes"
);
$admin_options[] = array (
	'slug'        => 'zn_woocommerce_options',
	'parent'      => 'zn_woocommerce_options',
	"name"           => __( "Single Page Title", 'zn_framework' ),
	"description"    => __( "Enter the desired page title that will appear in the sub-header.", 'zn_framework' ),
	"id"             => "single_shop_page_title",
	"type"           => "text",
	"std"            => __( "Shop", 'zn_framework' ),
	"class"          => "",
	'dependency'     => array(
		'element' => 'zn_override_single_shop_title',
		'value'  => array( 'yes' )
	)
);

$admin_options[] = array (
	'slug'        => 'zn_woocommerce_options',
	'parent'      => 'zn_woocommerce_options',
	'id'            => 'zn_show_thumb_on_hover',
	'name'          => __('Thumbnails Gallery Behavior', 'zn_framework'),
	'description'   => __( "Replace product main image when hovering/clicking a thumbnail ? <b>Please note that depending on your image sizes, it may be possible that your images won\'t look good if you enable this.</b>.", 'zn_framework' ),
	'type'          => 'select',
	'std'           => 'click',
	'options'     => array(
		'zn_dummy_value' => __( "Just open lightbox.", 'zn_framework' ),
		'yes' => __( "Hover on thumbs > Change main image > Open Lightbox.", 'zn_framework' ),
		'click' => __( "Click on thumbs > Change main image > Open Lightbox.", 'zn_framework' ),
		'disabled' => __( "Lightbox disabled (for plugin incompatibilities).", 'zn_framework' ),
	)
);

/**
 * ====================================================
 * HEADER MINI-CART
 * ====================================================
 */
$admin_options[] = array (
				'slug'        => 'zn_woocommerce_options',
				'parent'      => 'zn_woocommerce_options',
				"name"        => __( 'Header Mini-Cart', 'zn_framework' ),
				"description" => __( 'These options are applied to the mini-cart in header.', 'zn_framework' ),
				"id"          => "hd_title1",
				"type"        => "zn_title",
				"class"       => "zn_full zn-custom-title-large zn-top-separator"
);
$admin_options[] = array (
	'slug'        => 'zn_woocommerce_options',
	'parent'      => 'zn_woocommerce_options',
	"name"        => __( "Show MY CART in header", 'zn_framework' ),
	"description" => __( "Choose yes if you want to show a link to MY CART and the total value of the cart in
							the header", 'zn_framework' ),
	"id"          => "woo_show_cart",
	"std"         =>  "1",
	"type"        => "zn_radio",
	"options"     => array (
		"1" => __( "Show", 'zn_framework' ),
		"0" => __( "Hide", 'zn_framework' )
	),
	"class"        => "zn_radio--yesno",
);
$admin_options[] = array (
	'slug'        => 'zn_woocommerce_options',
	'parent'      => 'zn_woocommerce_options',
	"name"        => __( "Header Mini-Cart Style", 'zn_framework' ),
	"description" => __( "Select the mini-cart's style in header", 'zn_framework' ),
	"id"          => "woo_cart_style",
	"std"         =>  "",
	"options"     => array(
		array(
			'value' => '',
			'name'  => __( 'Default', 'zn_framework' ),
			'desc'  => __( 'Icon + "MY CART" Text.', 'zn_framework' ),
			'image' => THEME_BASE_URI .'/images/admin/various-theme-options/woocomerce-cartstyle-1.gif'
		),
		array(
			'value' => 'icononly',
			'name'  => __( 'Default - Icon Only', 'zn_framework' ),
			'image' => THEME_BASE_URI .'/images/admin/various-theme-options/woocomerce-cartstyle-1s.jpg'
		),
		array(
			'value' => 'style2',
			'name'  => __( 'Basket icon', 'zn_framework' ),
			'image' => THEME_BASE_URI .'/images/admin/various-theme-options/woocomerce-cartstyle-2.gif'
		),
	),
	"type"        => "smart_select",
);


/**
 * ====================================================
 * CART/CHECKOUT PAGES
 * ====================================================
 */

$admin_options[] = array (
				'slug'        => 'zn_woocommerce_options',
				'parent'      => 'zn_woocommerce_options',
				"name"        => __( 'WooCommerce pages options', 'zn_framework' ),
				"description" => __( 'These options are applied for the pages in WooCommerce.', 'zn_framework' ),
				"id"          => "hd_title1",
				"type"        => "zn_title",
				"class"       => "zn_full zn-custom-title-large zn-top-separator"
);
$admin_options[] = array (
   'slug'        => 'zn_woocommerce_options',
   'parent'      => 'zn_woocommerce_options',
   "name"        => __( " Checkout / Cart / My Account pages layout ", 'zn_framework' ),
   "description" => __( "Choose the pages layout.", 'zn_framework' ),
   "id"          => "woo_pages_layout",
   "std"         => "classic",
   "type"        => "select",
   "options"     => array (
	   "classic" => __( "Classic", 'zn_framework' ),
	   "style2"  => __( "Modern - Style #2", 'zn_framework' )
   )
);

/**
 * ====================================================
 * PRODUCTS BADGES
 * ====================================================
 */

$admin_options[] = array (
				'slug'        => 'zn_woocommerce_options',
				'parent'      => 'zn_woocommerce_options',
				"name"        => __( 'Product item badges', 'zn_framework' ),
				"description" => __( 'These options are applied for the badges of the products in listings.', 'zn_framework' ),
				"id"          => "hd_title1",
				"type"        => "zn_title",
				"class"       => "zn_full zn-custom-title-large zn-top-separator"
);
// Show new items badge
$show_new_badge = array (
	"1" => __( "Show", 'zn_framework' ),
	"0" => __( "Hide", 'zn_framework' )
);
$admin_options[]   = array (
	'slug'        => 'zn_woocommerce_options',
	'parent'      => 'zn_woocommerce_options',
	"name"        => __( "Show new items badge ?", 'zn_framework' ),
	"description" => __( "Choose yes if you want to show a NEW item badge over the new products", 'zn_framework' ),
	"id"          => "woo_new_badge",
	"std"         => "1",
	"type"        => "zn_radio",
	"options"     => $show_new_badge,
	"class"        => "zn_radio--yesno",
);

// Days to show as new
$admin_options[] = array (
	'slug'        => 'zn_woocommerce_options',
	'parent'      => 'zn_woocommerce_options',
	"name"        => __( "Days to show badge", 'zn_framework' ),
	"description" => __( "Please insert the number of days after a product is published to display the badge", 'zn_framework' ),
	"id"          => "woo_new_badge_days",
	"std"         => '3',
	"type"        => "text",
	'dependency'  => array ( 'element' => 'woo_new_badge', 'value' => array ( '1' ) ),
);

$admin_options[]   = array (
	'slug'        => 'zn_woocommerce_options',
	'parent'      => 'zn_woocommerce_options',
	"name"        => __( "Show 'Sale!' badge in items ?", 'zn_framework' ),
	"description" => __( "Choose yes if you want to show a SALE item badge over the products on sale.", 'zn_framework' ),
	"id"          => "woo_sale_badge",
	"std"         => "1",
	"type"        => "zn_radio",
	"options"     => $show_new_badge,
	"class"        => "zn_radio--yesno",
);

$admin_options[] = array (
	'slug'        => 'zn_woocommerce_options',
	'parent'      => 'zn_woocommerce_options',
	"name"        => __( "Display discount amount in sale flash?", 'zn_framework' ),
	"description" => __( "If checked, this option will display the discount amount as percentage in the products sale
	 flash badge.",'zn_framework' ),
	"id"          => "woo_show_sale_flash_discount",
	"std"         => "no",
	"type"        => "zn_radio",
	"options"     => array (
		"yes" => __( "Yes", 'zn_framework' ),
		"no"  => __( "No", 'zn_framework' )
	),
	"class"        => "zn_radio--yesno",
);

$admin_options[]   = array (
	'slug'        => 'zn_woocommerce_options',
	'parent'      => 'zn_woocommerce_options',
	"name"        => __( "Show 'SOLD OUT' badge in items ?", 'zn_framework' ),
	"description" => __( "Choose yes if you want to show a SOLD OUT badge on the product.", 'zn_framework' ),
	"id"          => "woo_soldout_badge",
	"std"         => "no",
	"type"        => "zn_radio",
	"options"     => array (
		"yes" => __( "Yes", 'zn_framework' ),
		"no"  => __( "No", 'zn_framework' )
	),
	"class"        => "zn_radio--yesno",
);

/*** CATEGORY PAGE ***/
if(!isset($sidebar_option) || empty($sidebar_option)){
	$sidebar_option = WpkZn::getThemeSidebars();
}

$admin_options[] = array (
	'slug'        => 'woo_category_options',
	'parent'      => 'zn_woocommerce_options',
	"name"           => __( "Shop Archive Page Title", 'zn_framework' ),
	"description"    => __( "Enter the desired page title for the shop archive page.", 'zn_framework' ),
	"id"             => "woo_arch_page_title",
	"std"            => __( "OUR PRODUCTS", 'zn_framework' ),
	"type"           => "text",
	"translate_name" => __( "Shop Archive Page Title", 'zn_framework' ),
	"class"          => ""
);

$admin_options[] = array (
	'slug'        => 'woo_category_options',
	'parent'      => 'zn_woocommerce_options',
	"name"           => __( "Shop Archive Page Subitle", 'zn_framework' ),
	"description"    => __( "Enter the desired page subtitle for the Shop archive page.", 'zn_framework' ),
	"id"             => "woo_arch_page_subtitle",
	"std"            => __( "Shop category here with product list", 'zn_framework' ),
	"type"           => "text",
	"translate_name" => __( "Shop Archive Page Subtitle", 'zn_framework' ),
	"class"          => ""
);



$desc = sprintf(
	__('
		Enter the desired image sizes for <br>the images <strong>in category listings (archives)</strong>.
		<br><br>Unlike sizes from <a href="%s">WooCommerce\'s options</a>, these are generated on the fly.
		<br><br>For automatic calculation of either the height or width of the image, simply leave one the field <strong>empty</strong>. If you leave both fields empty, then the sizes will fallback to <a href="%s">WC\'s default sizing options</a>.
		<br><br>Please note that the single item image sizes can be set from <a href="%s">WooCommerce Display options</a>, as these only apply to category listings/archives.',
		'zn_framework'),
	admin_url( 'admin.php?page=wc-settings&tab=products&section=display' ),
	admin_url( 'admin.php?page=wc-settings&tab=products&section=display' ),
	admin_url( 'admin.php?page=wc-settings&tab=products&section=display' )
);
$admin_options[] = array (
	'slug'        => 'woo_category_options',
	'parent'      => 'zn_woocommerce_options',
	"name"        => __( "Products Thumbnails sizes (Category listings/Archives)", 'zn_framework' ),
	"description" => $desc,
	"id"          => "woo_cat_image_size",
	"std"         => "",
	"type"        => "image_size",
	"class"       => ""
);


$sidebar_options = array( 'right_sidebar' => 'Right sidebar' , 'left_sidebar' => 'Left sidebar' , 'no_sidebar' => 'No sidebar' );
$admin_options[] = array(
	'slug'        => 'sidebar_settings',
	'parent'      => 'unlimited_sidebars',
	'id'          => 'woo_archive_sidebar',
	'name'        => 'Sidebar on Shop archive pages',
	'description' => 'Please choose the sidebar position for the shop archive pages.',
	'type'        => 'sidebar',
	'class'     => 'zn_full',
	'std'       => array (
		'layout' => 'sidebar_right',
		'sidebar' => 'default_sidebar',
	),
	'supports'  => array(
		'default_sidebar' => 'defaultsidebar',
		'sidebar_options' => $sidebar_options
	),
);

$admin_options[] = array(
	'slug'        => 'sidebar_settings',
	'parent'      => 'unlimited_sidebars',
	'id'          => 'woo_single_sidebar',
	'name'        => 'Sidebar on Shop product page',
	'description' => 'Please choose the sidebar position for the shop product pages.',
	'type'        => 'sidebar',
	'class'     => 'zn_full',
	'std'       => array (
		'layout' => 'sidebar_right',
		'sidebar' => 'default_sidebar',
	),
	'supports'  => array(
		'default_sidebar' => 'defaultsidebar',
		'sidebar_options' => $sidebar_options
	),
);
	return $admin_options;

}
