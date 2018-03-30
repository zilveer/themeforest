<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();

### AURUM ###
$of_options[] = array( 	"name" 		=> "Header",
						"type" 		=> "heading"
				);

$of_options[] = array(  "name"   	=> "Site Brand",
						"desc"   	=> "Enter the text that will appear as logo.",
						"id"   		=> "logo_text",
						"std"   	=> get_bloginfo('title'),
						"type"   	=> "text"
					);

$of_options[] = array(
						"desc"   	=> "Upload Custom Logo",
						"id"   		=> "use_uploaded_logo",
						"std"   	=> 0,
						"on"  		=> "Yes",
						"off"  		=> "No",
						"type"   	=> "switch",
						"folds"  	=> 1,
					);

$of_options[] = array(	"desc"   	=> "<strong>Transparent logo</strong> - when using header with transparent background, custom logo will be switched to this logo. <br /><small>* Only applied if you have uploaded custom logo.</small>",
						"id"   		=> "use_uploaded_logo_light",
						"std"   	=> 0,
						"on"  		=> "Yes",
						"off"  		=> "No",
						"type"   	=> "switch",
						"folds"  	=> 1,
						"fold"		=> "use_uploaded_logo"
					);

$of_options[] = array(	"name" 		=> "Custom Logo",
						"desc" 		=> "Upload/Choose your custom logo image from gallery if you want to use it instead of the default site title text.<br><small>Note: If you want to upload SVG logo please install SVG Support plugin.</small>",
						"id" 		=> "custom_logo_image",
						"std" 		=> "",
						"type" 		=> "media",
						"mod" 		=> "min",
						"fold" 		=> "use_uploaded_logo"
					);

$of_options[] = array( 	"desc" 		=> "You can set maximum width for the uploaded logo, mostly used when you use upload retina (@2x) logo. Pixels unit.",
						"id" 		=> "custom_logo_max_width",
						"std" 		=> "",
						"plc"		=> "Maximum Logo Width",
						"type" 		=> "text",
						"fold" 		=> "use_uploaded_logo"
				);

$of_options[] = array( 	"desc" 		=> "Set maximum logo width on mobile devices. Pixels unit.",
						"id" 		=> "custom_logo_max_width_mobile",
						"std" 		=> "",
						"plc"		=> "Maximum Logo Width on Mobile",
						"type" 		=> "text",
						"fold" 		=> "use_uploaded_logo"
				);

$of_options[] = array(	"name" 		=> "Transparent Header Logo",
						"desc" 		=> "Upload/Choose the transparent logo image (relative to custom logo).",
						"id" 		=> "custom_logo_image_light",
						"std" 		=> "",
						"type" 		=> "media",
						"mod" 		=> "min",
						"fold" 		=> "use_uploaded_logo_light"
					);

$of_options[] = array(	"name"		=> "Top Menu Bar",
						"desc"   	=> "Show or hide top menu links.",
						"id"   		=> "header_top_links",
						"std"   	=> 0,
						"folds"  	=> 1,
						"on"  		=> "Show",
						"off"  		=> "Hide",
						"type"   	=> "switch"
					);

$of_options[] = array( 	"desc" 		=> "Select style of the top header bar.",
						"id" 		=> "header_top_style",
						"std" 		=> "Hide",
						"type" 		=> "select",
						"options" 	=> array("" => "Default", "gray" => "Gray", "light" => "Light"),
						"fold"		=> "header_top_links"
				);


$available_menus   = array();
$menus_and_widgets = array();

if(is_admin()):

	global $sidebars_widgets, $wp_registered_widgets, $wp_registered_sidebars;
	$nav_menus         = wp_get_nav_menus( array('orderby' => 'name') );

	foreach($nav_menus as $item)
	{
		$available_menus["_{$item->term_id}"] = $item->name;
		$menus_and_widgets["menu-{$item->term_id}"] = "[Menu] {$item->name}\t";
	}

	if(function_exists('is_woocommerce'))
	{
		$menus_and_widgets["laborator_cart_totals"]               = "[Widget] Cart Totals";
		$menus_and_widgets["laborator_account_links_and_date"]    = "[Widget] Login/Register Links and Date";
	}

	$menus_and_widgets["laborator_current_date"]       = "[Widget] Current Date";
	$menus_and_widgets["laborator_social_networks"]    = "[Widget] Social Networks";

	$menus_and_widgets["wpml_lang_currency_switcher"]  = "[Widget] WPML Language & Currency Switcher";
	$menus_and_widgets["wpml_lang_switcher"]           = "[Widget] Language Switcher";
	$menus_and_widgets["wpml_currency_switcher"]       = "[Widget] WPML Currency Switcher";
	
	$menus_and_widgets["wc_currency_switcher"]         = "[Widget] WooCommerce Currency Switcher";
	
	$menus_and_widgets["navxt_breadcrubms"]            = "[Widget] Breadcrumb NavXT";

endif;

$of_options[] = array( 	"desc" 		=> "Left links (menu or widget).",
						"id" 		=> "header_top_links_left",
						"std" 		=> "Hide",
						"type" 		=> "select",
						"options" 	=> array_merge(array("" => "Hide"), $menus_and_widgets),
						"fold"		=> "header_top_links"
				);

$of_options[] = array( 	"desc" 		=> "Right links (menu or widget).",
						"id" 		=> "header_top_links_right",
						"std" 		=> "Hide",
						"type" 		=> "select",
						"options" 	=> array_merge(array("" => "Hide"), $menus_and_widgets),
						"fold"		=> "header_top_links"
				);

$of_options[] = array( 	"name" 		=> "Header Type",
						"desc" 		=> "",
						"id" 		=> "header_type",
						"std" 		=> "1",
						"type" 		=> "images",
						"options" 	=> array(
							'1'  => THEMEASSETS . 'images/admin/header-type-1.png',
							'2'  => THEMEASSETS . 'images/admin/header-type-2.png',
							'3'  => THEMEASSETS . 'images/admin/header-type-3.png',
							'4'  => THEMEASSETS . 'images/admin/header-type-4.png',
						)
				);

$of_options[] = array(	"name"		=> "Header Widgets",
						"desc"   	=> "Show or hide header links widget.",
						"id"   		=> "header_links",
						"std"   	=> 1,
						"folds"  	=> 1,
						"on"  		=> "Show",
						"off"  		=> "Hide",
						"type"   	=> "switch"
					);

$of_options[] = array(	"desc"   	=> "Show search form.",
						"id"   		=> "header_links_search_form",
						"std"   	=> 1,
						"on"  		=> "Show",
						"off"  		=> "Hide",
						"type"   	=> "switch",
						"fold"		=> "header_links"
					);

$of_options[] = array(	"desc"   	=> "Show cart link and items count.",
						"id"   		=> "header_cart_info",
						"std"   	=> 1,
						"on"  		=> "Show",
						"off"  		=> "Hide",
						"type"   	=> "switch",
						"fold"		=> "header_links",
						"folds"		=> 1
					);

$of_options[] = array(	"name"		=> "Cart Icon",
						"desc" 		=> "Choose cart icon to show.",
						"id" 		=> "header_cart_info_icon",
						"std" 		=> "1",
						"type" 		=> "images",
						"options" 	=> array(
							'1'  => THEMEASSETS . 'images/admin/cart-1.png',
							'2'  => THEMEASSETS . 'images/admin/cart-2.png',
							'3'  => THEMEASSETS . 'images/admin/cart-3.png',
							'4'  => THEMEASSETS . 'images/admin/cart-4.png',
							'5'  => THEMEASSETS . 'images/admin/cart-5.png',
						),
						"fold"		=> "header_cart_info"
				);

$of_options[] = array( 	"desc" 		=> "Show cart icon in the header (mobile)",
						"id" 		=> "header_cart_info_show_in_header",
						"std" 		=> 0,
						"type" 		=> "checkbox",
						"fold"		=> "header_cart_info"
				);

$of_options[] = array( 	"name" 		=> "Sticky Menu",
						"desc" 		=> "Enable or disable sticky menu (if supported by header type).",
						"id" 		=> "header_sticky_menu",
						"std" 		=> 1,
						"on" 		=> "Enable",
						"off" 		=> "Disable",
						"type" 		=> "switch"
				);

$of_options[] = array( 	"name" 		=> "Sticky Menu in Mobile",
						"desc" 		=> "Enable or disable sticky menu in mobile mode.",
						"id" 		=> "header_sticky_menu_mobile",
						"std" 		=> 0,
						"on" 		=> "Enable",
						"off" 		=> "Disable",
						"type" 		=> "switch"
				);


$of_options[] = array( 	"name" 		=> "Footer",
						"type" 		=> "heading"
				);

$of_options[] = array( 	"name" 		=> "Footer Style",
						"desc" 		=> "Select footer style color.",
						"id" 		=> "footer_style",
						"std" 		=> '',
						"type" 		=> "select",
						"options"	=> array(
							''           => 'Default',
							'inverted'   => 'Inverted'
						)
				);

$of_options[] = array( 	"name" 		=> "Footer Widgets",
						"desc" 		=> "Show or hide footer widgets.",
						"id" 		=> "footer_widgets",
						"std" 		=> 1,
						"on" 		=> "Show",
						"off" 		=> "Hide",
						"type" 		=> "switch",
						"folds"		=> 1
				);

$of_options[] = array( 	'name'		=> 'Collapse Footer Widgets',
						'desc' 		=> "Users still can see footer widgets (if collapsed) when they click <strong>three dots (...)</strong> link",
						'id' 		=> 'footer_collapse_mobile',
						'std' 		=> 1,
						'on' 		=> 'Collapsed',
						'off' 		=> 'Expanded',
						'type' 		=> 'switch',
						'fold'		=> 'footer_widgets',
				);


$of_options[] = array( 	"name" 		=> "Columns Count",
					 	"desc" 		=> "Select the type of footer widgets column to show.",
						"id" 		=> "footer_widgets_columns",
						"std" 		=> "six",
						"type" 		=> "select",
						"options" 	=> array(
							"two"    => "Two Columns per Row (1/2)",
							"three"  => "Three Columns per Row (1/3)",
							"four"   => "Four Columns per Row (1/4)",
							"six"    => "Six Columns per Row (1/6)"
						),
						"fold"		=> "footer_widgets"
				);

$of_options[] = array( 	"name" 		=> "Footer Left",
						"desc" 		=> "Copyrights text in the footer.",
						"id" 		=> "footer_text",
						"std" 		=> "Copyright &copy; ".date("Y")." - Aurum",
						"type" 		=> "textarea"
				);

$of_options[] = array( 	"desc" 		=> "Select menu list to display below the footer text (optional).",
						"id" 		=> "footer_menu",
						"std" 		=> "",
						"options"	=> array_merge(array("" => "None"), $available_menus),
						"type" 		=> "select"
				);

$site_url = site_url();

$assets_relative_url = THEMEASSETS;
$accepted_payments = '<ul class="payment-methods pull-right">
	<li>
		<a href="#">
			<img src="'.$assets_relative_url.'images/payments/payment-0.png" alt="ups" width="19" height="22">
		</a>
	</li>
	<li>
		<a href="#">
			<img src="'.$assets_relative_url.'images/payments/payment-1.png" alt="dhl" width="69" height="10">
		</a>
	</li>
	<li>
		<a href="#">
			<img src="'.$assets_relative_url.'images/payments/payment-2.png" alt="fedex" width="47" height="14">
		</a>
	</li>
	<li>
		<a href="#">
			<img src="'.$assets_relative_url.'images/payments/payment-3.png" alt="visa" width="35" height="11">
		</a>
	</li>
	<li>
		<a href="#">
			<img src="'.$assets_relative_url.'images/payments/payment-4.png" alt="paypal" width="56" height="15">
		</a>
	</li>
	<li>
		<a href="#">
			<img src="'.$assets_relative_url.'images/payments/payment-5.png" alt="mastercard" width="29" height="17">
		</a>
	</li>
</ul>';


$of_options[] = array( 	"name" 		=> "Footer Right",
						"desc" 		=> "You can include for example list of accepted credit cards or shipping companies with images.",
						"id" 		=> "footer_text_right",
						"std" 		=> $accepted_payments,
						"type" 		=> "textarea"
				);

$of_options[] = array( 	"name" 		=> "Tracking Code",
						"desc" 		=> "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template.",
						"id" 		=> "google_analytics",
						"std" 		=> "",
						"type" 		=> "textarea"
				);


$of_options[] = array( 	"name" 		=> "Shop Settings",
						"type" 		=> "heading"
				);

$of_options[] = array( 	"name" 		=> "General Shop Settings",
						"desc" 		=> "Shop head title (listing page).",
						"id" 		=> "shop_title_show",
						"std" 		=> 1,
						"type" 		=> "checkbox"
				);

$of_options[] = array( 	"desc" 		=> "Product sorting and results count.",
						"id" 		=> "shop_sorting_show",
						"std" 		=> 1,
						"type" 		=> "checkbox"
				);

$of_options[] = array( 	"desc" 		=> "Show <strong>sale</strong> badge (listing page).",
						"id" 		=> "shop_sale_ribbon_show",
						"std" 		=> 1,
						"type" 		=> "checkbox"
				);

$of_options[] = array( 	"desc" 		=> "Show <strong>out of stock</strong> badge (listing page).",
						"id" 		=> "shop_oos_ribbon_show",
						"std" 		=> 1,
						"type" 		=> "checkbox"
				);

$of_options[] = array( 	"desc" 		=> "Show <strong>featured</strong> badge (listing page).",
						"id" 		=> "shop_featured_ribbon_show",
						"std" 		=> 1,
						"type" 		=> "checkbox"
				);

$of_options[] = array( 	"desc" 		=> "Item category (listing page).",
						"id" 		=> "shop_product_category_listing",
						"std" 		=> 1,
						"type" 		=> "checkbox"
				);

$of_options[] = array( 	"desc" 		=> "Item price (listing page).",
						"id" 		=> "shop_product_price_listing",
						"std" 		=> 1,
						"type" 		=> "checkbox"
				);

$of_options[] = array( 	"desc" 		=> "Add to cart product (listing page).",
						"id" 		=> "shop_add_to_cart_listing",
						"std" 		=> 1,
						"type" 		=> "checkbox"
				);

$of_options[] = array( 	"desc" 		=> "Lazy Load product hover images.",
						"id" 		=> "shop_gallery_lazyload",
						"std" 		=> 1,
						"type" 		=> "checkbox"
				);

$of_options[] = array( 	"desc" 		=> "Show mini cart items count with AJAX.",
						"id" 		=> "shop_cart_counter_ajax",
						"std" 		=> 1,
						"type" 		=> "checkbox"
				);

$of_options[] = array( 	"desc" 		=> "Show mini cart on hover.",
						"id" 		=> "shop_cart_show_on_hover",
						"std" 		=> 0,
						"type" 		=> "checkbox"
				);

$of_options[] = array( 	"desc" 		=> "Show quantity for mini cart items.",
						"id" 		=> "shop_cart_show_quantity",
						"std" 		=> 1,
						"type" 		=> "checkbox"
				);

$of_options[] = array( 	"desc" 		=> "Show wishlist icon in item thumbnails",
						"id" 		=> "shop_wishlist_catalog_show",
						"std" 		=> 0,
						"type" 		=> "checkbox"
				);

$of_options[] = array(	"desc" 		=> "Disable image lightbox in mobile mode.",
						"id" 		=> "shop_lightbox_disable_mobile",
						"std" 		=> 0,
						"type" 		=> "checkbox",
					);

$of_options[] = array(	"desc" 		=> "Display \"Add to cart\" as text (catalog).",
						"id" 		=> "shop_add_to_cart_textual",
						"std" 		=> 0,
						"type" 		=> "checkbox",
					);

$of_options[] = array( 	"desc" 		=> "Enable <font color='#dd1f26'><strong>catalog</strong></font> mode only.",
						"id" 		=> "shop_catalog_mode",
						"std" 		=> 0,
						"type" 		=> "checkbox",
						"folds"		=> true
				);

$of_options[] = array( 	"desc" 		=> "<strong>Catalog mode</strong> &ndash; hide prices.",
						"id" 		=> "shop_catalog_mode_hide_prices",
						"std" 		=> 0,
						"type" 		=> "checkbox",
						"fold"		=> "shop_catalog_mode"
				);

$of_options[] = array( 	"desc" 		=> "Masonry mode",
						"id" 		=> "shop_loop_masonry",
						"std" 		=> 0,
						"type" 		=> "checkbox",
						"folds"		=> 1
				);

$of_options[] = array( 	"desc" 		=> "Item thumbnail preview type.",
						"id" 		=> "shop_item_preview_type",
						"std" 		=> "fade",
						"type" 		=> "select",
						"options" 	=> array(
							"fade"       => "Second Image on Hover (fade)",
							"slide"      => "Second Image on Hover (slide)",
							"gallery"    => "Product Gallery Slider",
							"none"       => "None"
						)
				);

$of_options[] = array( 	"desc" 		=> "Catalog thumbnail size. <br /><small>If you change dimensions you must <a href=\"admin.php?page=laborator_docs#regenerate-thumbnails\">regenerate thumbnails</a>.</small>",
						"id" 		=> "shop_catalog_image_size",
						"std" 		=> "",
						"plc"		=> "Default: 290x370",
						"type" 		=> "text"
				);

$of_options[] = array( 	"desc" 		=> "Product thumbnails placing (single product).",
						"id" 		=> "shop_product_thumbnails_placing",
						"std" 		=> "vertical",
						"type" 		=> "select",
						"options" 	=> array(
							"vertical"   => "Vertical",
							"horizontal" => "Horizontal",
						)
				);

$of_options[] = array( 	"desc" 		=> "Masonry Layout Mode<br /><small>Note: When <strong>Masonry Mode</strong> is activated you can choose layout renderer.</small>",
						"id" 		=> "shop_loop_masonry_layout_mode",
						"std" 		=> "fitRows",
						"type" 		=> "select",
						"options" 	=> array(
							"masonry"    => "Default Masonry",
							"fitRows"    => "Fit Rows"
						),
						"fold"		=> "shop_loop_masonry"
				);

$show_sidebar_options = array(
	"hide" => "Hide Sidebar",
	"right" => "Show Sidebar on Right",
	"left" => "Show Sidebar on Left",
);

$of_options[] = array( 	"name" 		=> "Product Columns",
						"desc" 		=> "Set how many products per row you want to display.<br /><small>If you choose <strong>Decide when sidebar is present</strong> will switch to 3 columns of products when sidebar is present otherwise it shows 4 products per row.</small>",
						"id" 		=> "shop_product_columns",
						"std" 		=> "decide",
						"type" 		=> "select",
						"options" 	=> array(
							"six"    => "6 columns",
							"five"   => "5 columns",
							"four"   => "4 columns", 
							"three"  => "3 columns", 
							"two"    => "2 columns",
							"decide" => "Decide when sidebar is present"
						)
				);

$of_options[] = array( 	"desc" 		=> "Set how many products to show in mobile devices.",
						"id" 		=> "shop_products_mobile_two_per_row",
						"std" 		=> "decide",
						"type" 		=> "select",
						"options" 	=> array(
							"one" => "One product per row",
							"two" => "Two products per row",
						)
				);

$of_options[] = array( 	"name" 		=> "Shop Sidebar",
						"desc" 		=> "Sidebar visibility (listing page).",
						"id" 		=> "shop_sidebar",
						"std" 		=> "right",
						"type" 		=> "select",
						"options" 	=> $show_sidebar_options
				);

$of_options[] = array( 	"desc" 		=> "Sidebar visibility (single page).",
						"id" 		=> "shop_single_sidebar",
						"std" 		=> "hide",
						"type" 		=> "select",
						"options" 	=> $show_sidebar_options
				);

$of_options[] = array( 	//"name" 		=> "Footer Sidebar Columns",
					 	"desc" 		=> "Set the number of columns to show in <strong>footer</strong> sidebar.",
						"id" 		=> "shop_sidebar_footer_columns",
						"std" 		=> "4",
						"type" 		=> "select",
						"options" 	=> array("2", "3", "4"),
						"fold"		=> "shop_sidebar_footer"
				);

$of_options[] = array( 	"desc" 		=> "Show <strong>footer</strong> sidebar.",
						"id" 		=> "shop_sidebar_footer",
						"std" 		=> 0,
						"type" 		=> "checkbox",
						"folds"		=> 1
				);

$of_options[] = array( 	"name" 		=> "Pagination",
					 	"desc" 		=> "Products to show per one page.",
						"id" 		=> "shop_products_per_page",
						"std" 		=> 4,
						"type" 		=> "select",
						"options" 	=> array(
							20 => "20 rows",
							19 => "19 rows",
							18 => "18 rows",
							17 => "17 rows",
							16 => "16 rows",
							15 => "15 rows",
							14 => "14 rows",
							13 => "13 rows",
							12 => "12 rows",
							11 => "11 rows",
							10 => "10 rows",
							9 => "9 rows",
							8 => "8 rows",
							7 => "7 rows",
							6 => "6 rows",
							5 => "5 rows",
							4 => "4 rows",
							3 => "3 rows",
							2 => "2 rows",
							1 => "1 row"
						)
				);


$of_options[] = array( 	"name" 		=> "Single Item Settings",
						"desc" 		=> "Show <strong>sale</strong> badge (single page).",
						"id" 		=> "shop_single_sale_ribbon_show",
						"std" 		=> 1,
						"type" 		=> "checkbox"
				);

$of_options[] = array( 	"desc" 		=> "Show <strong>out of stock</strong> badge (single page).",
						"id" 		=> "shop_single_oos_ribbon_show",
						"std" 		=> 1,
						"type" 		=> "checkbox"
				);

$of_options[] = array( 	"desc" 		=> "Show <strong>featured</strong> badge (single page).",
						"id" 		=> "shop_single_featured_ribbon_show",
						"std" 		=> 1,
						"type" 		=> "checkbox"
				);

$of_options[] = array( 	"desc" 		=> "Product <strong>Next-Prev</strong> navigation.",
						"id" 		=> "shop_single_next_prev",
						"std" 		=> 1,
						"type" 		=> "checkbox"
				);

$of_options[] = array( 	"desc" 		=> "Show product <strong>rating</strong> (below title).",
						"id" 		=> "shop_single_rating",
						"std" 		=> 1,
						"type" 		=> "checkbox"
				);

$of_options[] = array( 	"desc" 		=> "Show product category (below title).",
						"id" 		=> "shop_single_product_category",
						"std" 		=> 1,
						"type" 		=> "checkbox"
				);

$of_options[] = array( 	"desc" 		=> "Product meta (id, sku, category and tags).",
						"id" 		=> "shop_single_meta_show",
						"std" 		=> 1,
						"type" 		=> "checkbox"
				);

$of_options[] = array( 	"desc" 		=> "Product image size. <br /><small>If you change dimensions you must <a href=\"admin.php?page=laborator_docs#regenerate-thumbnails\">regenerate thumbnails</a>.</small>",
						"id" 		=> "shop_single_image_size",
						"std" 		=> "",
						"plc"		=> "Default: 555x710",
						"type" 		=> "text"
				);

$of_options[] = array( 	"desc" 		=> "Auto rotate product images.",
						"id" 		=> "shop_single_auto_rotate_image",
						"std" 		=> "",
						"plc"		=> "Default: 5 (seconds) - 0 to disable",
						"type" 		=> "text"
				);

$of_options[] = array( 	"desc" 		=> "Product aside thumbnails to show (they will be splitted).",
						"id" 		=> "shop_single_aside_thumbnails_count",
						"std" 		=> 5,
						"type" 		=> "select",
						"options" 	=> range(1, 10)
				);

$of_options[] = array( 	"desc" 		=> "Related products count (shown on single product page).",
						"id" 		=> "shop_related_products_per_page",
						"std" 		=> 4,
						"type" 		=> "select",
						"options" 	=> range(12, 0)
				);

$of_options[] = array( 	"name" 		=> "Image Magnifier",
						"desc" 		=> "Enable or disable product zoom feature when hovering into the image.",
						"id" 		=> "shop_magnifier",
						"std" 		=> 0,
						"on" 		=> "Enable",
						"off" 		=> "Disable",
						"type" 		=> "switch",
						"folds"		=> 1
				);

$of_options[] = array( 	"desc" 		=> "Magnifier zoom view size.",
						"id" 		=> "shop_magnifier_zoom_view_size",
						"std" 		=> "",
						"plc"		=> "If empty default will be used: 480x395",
						"type" 		=> "text",
						"fold"		=> "shop_magnifier"
				);

$of_options[] = array( 	"desc" 		=> "Set zoom level for the magnifier on scale from 1.00 to 15.00.",
						"id" 		=> "shop_magnifier_zoom_level",
						"std" 		=> "",
						"plc"		=> "If empty default will be used: 1.925",
						"type" 		=> "text",
						"fold"		=> "shop_magnifier"
				);

$of_options[] = array( 	"name" 		=> "Product Sharing",
						"desc" 		=> "Enable or disable sharing the product in popular Social Networks.",
						"id" 		=> "shop_share_product",
						"std" 		=> 0,
						"on" 		=> "Allow Share",
						"off" 		=> "No",
						"type" 		=> "switch",
						"folds"		=> 1
				);

$of_options[] = array( 	"name"		=> "Share Style",
						"desc" 		=> "Show social icons as icons or textual.",
						"id" 		=> "shop_share_product_icons",
						"std" 		=> 0,
						"on" 		=> "Icon",
						"off" 		=> "Text",
						"type" 		=> "switch",
						"fold"		=> "shop_share_product"
				);

$share_product_networks = array(
			"visible" => array (
				"placebo"	=> "placebo",
				"fb"   	 	=> "Facebook",
				"tw"   	 	=> "Twitter",
				"gp"       	=> "Google Plus",
				"pi"        => "Pinterest",
				"em"       	=> "Email",
			),

			"hidden" => array (
				"placebo"   => "placebo",
				"lin"       => "LinkedIn",
				"tlr"       => "Tumblr",
				"vk"        => "VKontakte",
			),
);

$of_options[] = array( 	"name" 		=> "Share Product Networks",
						"desc" 		=> "Select social networks that you allow users to share the products of your shop.",
						"id" 		=> "shop_share_product_networks",
						"std" 		=> $share_product_networks,
						"type" 		=> "sorter",
						"fold"		=> "shop_share_product"
				);

$of_options[] = array( 	"name"		=> "Category Settings",
						"desc" 		=> "Category columns per row.",
						"id" 		=> "shop_category_columns",
						"std" 		=> 4,
						"type" 		=> "select",
						"options" 	=> range(2, 4)
				);

$of_options[] = array( 	"desc" 		=> "Set how many categories to show in mobile devices.",
						"id" 		=> "shop_categories_mobile_per_row",
						"std" 		=> "decide",
						"type" 		=> "select",
						"options" 	=> array(
							"one" => "One category per row",
							"two" => "Two categories per row",
						)
				);

$of_options[] = array( 	"desc" 		=> "Show items count for category (category page).",
						"id" 		=> "shop_category_count",
						"std" 		=> 1,
						"type" 		=> "checkbox"
				);


$of_options[] = array( 	"name" 		=> "Blog Settings",
						"type" 		=> "heading"
				);

$of_options[] = array( 	"name" 		=> "Toggle Blog Functionality",
						"desc" 		=> "Thumbnails (post featured image)",
						"id" 		=> "blog_thumbnails",
						"std" 		=> 1,
						"type" 		=> "checkbox"
				);

$of_options[] = array( 	"desc" 		=> "Single post thumbnail (featured image)",
						"id" 		=> "blog_single_thumbnails",
						"std" 		=> 1,
						"type" 		=> "checkbox"
				);

$of_options[] = array( 	"desc" 		=> "Thumbnail hover effect",
						"id" 		=> "blog_thumbnail_hover_effect",
						"std" 		=> 1,
						"type" 		=> "checkbox"
				);

$of_options[] = array( 	"desc" 		=> "Author info (shown on single post)",
						"id" 		=> "blog_author_info",
						"std" 		=> 0,
						"type" 		=> "checkbox"
				);

$of_options[] = array( 	"desc" 		=> "Category (shown on single post)",
						"id" 		=> "blog_category",
						"std" 		=> 1,
						"type" 		=> "checkbox"
				);

$of_options[] = array( 	"desc" 		=> "Post date (shown on single post)",
						"id" 		=> "blog_post_date",
						"std" 		=> 1,
						"type" 		=> "checkbox"
				);

$of_options[] = array( 	"desc" 		=> "Tags (shown on single post)",
						"id" 		=> "blog_tags",
						"std" 		=> 1,
						"type" 		=> "checkbox"
				);

$of_options[] = array( 	"desc" 		=> "Blog next-prev post links on single page",
						"id" 		=> "blog_post_nextprev",
						"std" 		=> 0,
						"type" 		=> "checkbox"
				);

$of_options[] = array( 	"desc" 		=> "Enable lightbox on single blog post",
						"id" 		=> "blog_post_single_lightbox",
						"std" 		=> 1,
						"type" 		=> "checkbox"
				);

/*
$of_options[] = array( 	"desc" 		=> "Comments number",
						"id" 		=> "blog_comments_count",
						"std" 		=> 1,
						"type" 		=> "checkbox"
				);
*/

$of_options[] = array( 	"name" 		=> "Blog Sidebar",
					 	"desc" 		=> "Set blog sidebar position, you can even hide it.",
						"id" 		=> "blog_sidebar_position",
						"std" 		=> "right",
						"type" 		=> "select",
						"options" 	=> $show_sidebar_options
				);

$of_options[] = array( 	"name" 		=> "Pagination Position",
						"desc" 		=> "Set blog pagination position.",
						"id" 		=> "blog_pagination_position",
						"std" 		=> "Center",
						"type" 		=> "select",
						"options" 	=> array("Left", "Center", "Right")
				);

$of_options[] = array( 	"name" 		=> "Gallery Auto-Switch",
						"desc" 		=> "Set the interval of auto-switch for gallery images (in posts, 0 - disable).",
						"id" 		=> "blog_gallery_autoswitch",
						"std" 		=> "",
						"plc"		=> "Default: 5 (seconds)",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "Thumbnail Height",
						"desc" 		=> "Featured image thumbnail height (applied on single post only). If you change this value, you need to regenerate thumbnails again.",
						"id" 		=> "blog_thumbnail_height",
						"std" 		=> "",
						"plc"		=> "Default value is applied if set to empty: 640",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "Share Story",
						"desc" 		=> "Enable or disable sharing the story in popular Social Networks.",
						"id" 		=> "blog_share_story",
						"std" 		=> 0,
						"on" 		=> "Allow Share",
						"off" 		=> "No",
						"type" 		=> "switch",
						"folds"		=> 1
				);

$of_options[] = array( 	"name"		=> "Share Style",
						"desc" 		=> "Show social icons as icons or textual.",
						"id" 		=> "blog_share_post_icons",
						"std" 		=> 0,
						"on" 		=> "Icon",
						"off" 		=> "Text",
						"type" 		=> "switch",
						"fold"		=> "blog_share_story"
				);

$share_story_networks = array(
			"visible" => array (
				"placebo"	=> "placebo",
				"fb"   	 	=> "Facebook",
				"tw"   	 	=> "Twitter",
				"lin"       => "LinkedIn",
				"tlr"       => "Tumblr",
				"gp"       	=> "Google Plus",
			),

			"hidden" => array (
				"placebo"   => "placebo",
				"pi"       	=> "Pinterest",
				"em"       	=> "Email",
				"vk"       	=> "VKontakte",
			),
);

$of_options[] = array( 	"name" 		=> "Share Story Networks",
						"desc" 		=> "Select social networks that you allow users to share the content of your blog posts.",
						"id" 		=> "blog_share_story_networks",
						"std" 		=> $share_story_networks,
						"type" 		=> "sorter",
						"fold"		=> "blog_share_story"
				);


$of_options[] = array( 	"name" 		=> "Other Settings",
						"type" 		=> "heading"
				);

$of_options[] = array( 	"name"		=> "Search results",
						"desc" 		=> "Set how many rows you want to display on search page.",
						"id" 		=> "search_results_count",
						"std" 		=> 4,
						"type" 		=> "select",
						"options" 	=> range(12, 1)
				);

$post_types_obj = get_post_types(array('_builtin' => false, 'publicly_queryable' => true, 'exclude_from_search' => false), 'objects');

$post_types = array();

$post_types['post'] = __('Posts', TD);
$post_types['page'] = __('Pages', TD);

foreach($post_types_obj as $pt => $obj)
{
	$post_types[$pt] = $obj->labels->name;
}


$of_options[] = array( 	"desc" 		=> "Set available post types in search results.",
						"id" 		=> "search_post_types",
						"std" 		=> array('post', 'page', 'product'),
						"type" 		=> "multicheck",
						"options" 	=> $post_types
				);


$of_options[] = array( 	"name" 		=> "Add to cart link",
						"desc" 		=> "Show add to cart button for products in search results.",
						"id" 		=> "search_add_to_cart",
						"std" 		=> 1,
						"type" 		=> "switch",
						"on"		=> "Yes",
						"off"		=> "No",
				);


$of_options[] = array( 	"name" 		=> "Sidebar Borders",
						"desc" 		=> "Add or remove borders for sidebars.",
						"id" 		=> "sidebar_borders",
						"std" 		=> 1,
						"type" 		=> "switch",
						"on"		=> "Yes",
						"off"		=> "No",
				);


$of_options[] = array(	"name" 		=> "Favicon",
						"desc" 		=> "Select 64x64 favicon of the PNG format.",
						"id" 		=> "favicon_image",
						"std" 		=> "",
						"type" 		=> "media",
						"mod" 		=> "min"
					);


$of_options[] = array(	"name" 		=> "Apple Touch Icon",
						"desc" 		=> "Required image size 114x114 (png only)",
						"id" 		=> "apple_touch_icon",
						"std" 		=> "",
						"type" 		=> "media",
						"mod" 		=> "min"
					);


$of_options[] = array( 	"name"		=> 'Google Maps API Key',
						"desc" 		=> "Google maps requires unique API key for each site, click here to learn more about generating <a href='https://developers.google.com/maps/documentation/javascript/get-api-key' target='_blank'>Google API Key</a>",
						"id" 		=> "google_maps_api",
						"std" 		=> "",
						"plc"		=> "",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "Theme Styling",
						"type" 		=> "heading",
						"icon"		=> "fa fa-tint"
				);
				
$of_options[] = array(  "name"		=> "Custom Skin Builder",
						"desc"   	=> "Create your own skin for this theme",
						"id"   		=> "use_custom_skin",
						"std"   	=> 0,
						"folds"  	=> 1,
						"on"  		=> "Yes",
						"off"  		=> "No",
						"type"   	=> "switch"
					);

$of_options[] = array(	"name"		=> "Skin Colors",
						"desc"   	=> "Background color",
						"id"   		=> "custom_skin_bg_color",
						"std"   	=> '#ffffff',
						"type"   	=> "color",
						"fold"  	=> 'use_custom_skin',
					);

$of_options[] = array(	"desc"   	=> "Borders color",
						"id"   		=> "custom_skin_border_color",
						"std"   	=> '#eeeeee',
						"type"   	=> "color",
						"fold"  	=> 'use_custom_skin',
					);

$of_options[] = array(	"desc"   	=> "Text color (paragraphs)",
						"id"   		=> "custom_skin_text_color",
						"std"   	=> '#888',
						"type"   	=> "color",
						"fold"  	=> 'use_custom_skin',
					);

$of_options[] = array(	"desc"   	=> "Link color",
						"id"   		=> "custom_skin_link_color",
						"std"   	=> '#222222',
						"type"   	=> "color",
						"fold"  	=> 'use_custom_skin',
					);

$of_options[] = array(	"desc"   	=> "Secondary link color",
						"id"   		=> "custom_skin_secondary_link_color",
						"std"   	=> '#888888',
						"type"   	=> "color",
						"fold"  	=> 'use_custom_skin',
					);

$of_options[] = array(	"desc"   	=> "Button color",
						"id"   		=> "custom_skin_button_color",
						"std"   	=> '#7b599b',
						"type"   	=> "color",
						"fold"  	=> 'use_custom_skin',
					);

$of_options[] = array(	"desc"   	=> "Footer background color",
						"id"   		=> "custom_skin_footer_bg_color",
						"std"   	=> '#333333',
						"type"   	=> "color",
						"fold"  	=> 'use_custom_skin',
					);


$of_options[] = array( 	"name" 		=> "Custom CSS",
						"desc" 		=> "",
						"id" 		=> "custom_css_feature",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Custom CSS in a New Interface</h3>
						We have created a better interface for adding your custom CSS which is more flexible and includes syntax highlighting.
						<br />
						<br />
						<a href=\"admin.php?page=laborator_custom_css\" class=\"button\">Go to new Custom CSS Editor</a>",
						"icon" 		=> true,
						"type" 		=> "info"
				);



$of_options[] = array( 	"name" 		=> "Typography",
						"type" 		=> "heading"
				);

$font_primary_list		= array(
	"Open Sans" => "Open Sans",
);

$font_secondary_list	= array(
	"Open Sans" => "Open Sans",
	"Arimo" => "Arimo",
	"Lobster" => "Lobster",
);


asort($font_primary_list);
asort($font_secondary_list);

$font_primary_list      = array_merge(array("none" => "Use default"), $font_primary_list);
$font_secondary_list    = array_merge(array("none" => "Use default"), $font_secondary_list);

$of_options[] = array( 	"name" 		=> "Primary Font",
						"desc" 		=> "Font type that is used for body and paragraphs.",
						"id" 		=> "font_primary",
						"std" 		=> "Select a font",
						"type" 		=> "select_google_font",
						"preview" 	=> array(
										"text" => "This is how the text looks in the site",
										"size" => "18px"
						),
						"options" 	=> $font_primary_list
				);

$of_options[] = array( 	"name" 		=> "Heading Font",
						"desc" 		=> "Select main font to be used for menus and headings.",
						"id" 		=> "font_secondary",
						"std" 		=> "Select a font",
						"type" 		=> "select_google_font",
						"preview" 	=> array(
										"text" => "This is how the text looks in the site",
										"size" => "18px"
						),
						"options" 	=> $font_secondary_list
				);


$of_options[] = array( 	"name" 		=> "Custom Google Fonts",
						"desc" 		=> "",
						"id" 		=> "custom_gf",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Including Custom Google Fonts</h3>
						If you want to add your personal font to your site (from Google Webfonts) you can apply the font parameters in the below fields.<br />
						Firstly include the font URL that is given in Google Webfonts site, then enter the name of that font (without <em>font-family:</em>) next to that field.<br />
						Otherwise, leave the field empty to use default font selected in the list above.",
						"icon" 		=> true,
						"type" 		=> "info"
				);


$of_options[] = array( 	"name" 		=> "Primary Font",
						"desc" 		=> "Primary font URL",
						"id" 		=> "custom_primary_font_url",
						"std" 		=> "",
						"plc"		=> "i.e. http://fonts.googleapis.com/css?family=Oswald",
						"type" 		=> "text"
				);


$of_options[] = array( 	"desc" 		=> "Primary font name",
						"id" 		=> "custom_primary_font_name",
						"std" 		=> "",
						"plc"		=> "'Oswald', sans-serif",
						"type" 		=> "text"
				);


$of_options[] = array( 	"name" 		=> "Heading Font",
						"desc" 		=> "Heading font URL",
						"id" 		=> "custom_heading_font_url",
						"std" 		=> "",
						"plc"		=> "i.e. http://fonts.googleapis.com/css?family=Oswald",
						"type" 		=> "text"
				);


$of_options[] = array( 	"desc" 		=> "Heading font name",
						"id" 		=> "custom_heading_font_name",
						"std" 		=> "",
						"plc"		=> "'Oswald', sans-serif",
						"type" 		=> "text"
				);

/*

$of_options[] = array( 	"name" 		=> "Custom CSS",
						"desc" 		=> "Apply your own custom CSS to all site pages.<br /><br />CSS is automatically wrapped with &lt;style&gt;&lt;/style&gt; tags.",
						"id" 		=> "custom_css_general",
						"std" 		=> "",
						"type" 		=> "textarea"
				);


$of_options[] = array( 	"name" 		=> "Media Queries CSS",
						"desc" 		=> "Large Screen<br />For screen width: <strong>1200px</strong> - <strong>larger size</strong>.",
						"id" 		=> "custom_css_general_lg",
						"std" 		=> "",
						"type" 		=> "textarea"
				);


$of_options[] = array( 	"desc" 		=> "Laptop<br />For screen width: <strong>992px</strong> - <strong>larger size</strong>.",
						"id" 		=> "custom_css_general_md",
						"std" 		=> "",
						"type" 		=> "textarea"
				);


$of_options[] = array( 	"desc" 		=> "Tablet<br />For screen width: <strong>768px</strong> - <strong>991px</strong>.",
						"id" 		=> "custom_css_general_sm",
						"std" 		=> "",
						"type" 		=> "textarea"
				);


$of_options[] = array( 	"desc" 		=> "Mobile<br />For screen width: <strong>480px</strong> - <strong>767px</strong>.",
						"id" 		=> "custom_css_general_xs",
						"std" 		=> "",
						"type" 		=> "textarea"
				);


$of_options[] = array( 	"desc" 		=> "Mobile<br />For screen width: <strong>0px</strong> - <strong>479px</strong>.",
						"id" 		=> "custom_css_general_xxs",
						"std" 		=> "",
						"type" 		=> "textarea"
				);
*/


$of_options[] = array( 	"name" 		=> "Social Networks",
						"type" 		=> "heading"
				);

$social_networks_ordering = array(
			"visible" => array (
				"placebo"	=> "placebo",
				"fb"   	 	=> "Facebook",
				"tw"   	 	=> "Twitter",
			),

			"hidden" => array (
				"placebo"   => "placebo",
				"gp"        => "Google+",
				"lin"       => "LinkedIn",
				"yt"        => "YouTube",
				"vm"        => "Vimeo",
				"drb"       => "Dribbble",
				"ig"        => "Instagram",
				"pi"        => "Pinterest",
				"vk"        => "VKontakte",
				"sc"        => "SoundCloud",
				"tb"        => "Tumblr",
				"sn"        => "Snapchat",
				"rs"        => "RSS",
			),
);

$of_options[] = array( 	"name" 		=> "Social Networks Ordering",
						"desc" 		=> "Set the appearing order of social networks in the footer. To use social networks links list copy this shortcode: <code style='font-size: 10px; display: inline-block; margin-top: 10px;'>[lab_social_networks]</code>",
						"id" 		=> "social_order",
						"std" 		=> $social_networks_ordering,
						"type" 		=> "sorter"
				);

$of_options[] = array( 	"name" 		=> "Social Networks",
						"desc" 		=> "Facebook",
						"id" 		=> "social_network_link_fb",
						"std" 		=> "",
						"plc"		=> "http://facebook.com/username",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "",
						"desc" 		=> "Twitter",
						"id" 		=> "social_network_link_tw",
						"std" 		=> "",
						"plc"		=> "http://twitter.com/username",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "",
						"desc" 		=> "LinkedIn",
						"id" 		=> "social_network_link_lin",
						"std" 		=> "",
						"plc"		=> "http://linkedin.com/in/username",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "",
						"desc" 		=> "YouTube",
						"id" 		=> "social_network_link_yt",
						"std" 		=> "",
						"plc"		=> "http://youtube.com/username",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "",
						"desc" 		=> "Vimeo",
						"id" 		=> "social_network_link_vm",
						"std" 		=> "",
						"plc"		=> "http://vimeo.com/username",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "",
						"desc" 		=> "Dribbble",
						"id" 		=> "social_network_link_drb",
						"std" 		=> "",
						"plc"		=> "http://dribbble.com/username",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "",
						"desc" 		=> "Instagram",
						"id" 		=> "social_network_link_ig",
						"std" 		=> "",
						"plc"		=> "http://instagram.com/username",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "",
						"desc" 		=> "Pinterest",
						"id" 		=> "social_network_link_pi",
						"std" 		=> "",
						"plc"		=> "http://pinterest.com/username",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "",
						"desc" 		=> "Google Plus",
						"id" 		=> "social_network_link_gp",
						"std" 		=> "",
						"plc"		=> "http://plus.google.com/username",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "",
						"desc" 		=> "VKontakte",
						"id" 		=> "social_network_link_vk",
						"std" 		=> "",
						"plc"		=> "http://vk.com/username",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "",
						"desc" 		=> "SoundCloud",
						"id" 		=> "social_network_link_sc",
						"std" 		=> "",
						"plc"		=> "http://soundcloud.com/username",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "",
						"desc" 		=> "Tumblr",
						"id" 		=> "social_network_link_tb",
						"std" 		=> "",
						"plc"		=> "http://username.tumblr.com",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "",
						"desc" 		=> "Snapchat",
						"id" 		=> "social_network_link_sn",
						"std" 		=> "",
						"plc"		=> "https://www.snapchat.com/add/username",
						"type" 		=> "text"
				);

$of_options[] = array( 	"name" 		=> "",
						"desc" 		=> "RSS",
						"id" 		=> "social_network_link_rs",
						"std" 		=> "",
						"plc"		=> "",
						"type" 		=> "text"
				);

### END: AURUM ###


// Backup Options
$of_options[] = array( 	"name" 		=> "Backup Options",
						"type" 		=> "heading",
				);

$of_options[] = array( 	"name" 		=> "Backup and Restore Options",
						"id" 		=> "of_backup",
						"std" 		=> "",
						"type" 		=> "backup",
						"desc" 		=> 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
				);

$of_options[] = array( 	"name" 		=> "Transfer Theme Options Data",
						"id" 		=> "of_transfer",
						"std" 		=> "",
						"type" 		=> "transfer",
						"desc" 		=> 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".',
				);

$of_options[] = array( 	"name" 		=> "Changelog",
						"type" 		=> "heading",
				);

	}//End function: of_options()
}//End chack if function exists: of_options()
?>
