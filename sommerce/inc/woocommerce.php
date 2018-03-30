<?php
/**
 * All functions and hooks for jigoshop plugin
 *
 * @package WordPress
 * @subpackage YIW Themes
 * @since 1.4
 */

include 'shortcodes-woocommerce.php';

define( 'WC_LATEST_VERSION', '2.6' );

/* fix 2.1 */
global $woo_shop_folder;


if ( defined( 'YIT_DEBUG' ) && ! YIT_DEBUG ){
    $message = get_option( 'woocommerce_admin_notices', array() );
    $message = array_diff( $message, array( 'template_files' ));
    update_option( 'woocommerce_admin_notices', $message );
}

if ( version_compare( $woocommerce->version , '2.1', '<' ) ) {

    add_filter( 'woocommerce_template_url', create_function( "", "return 'woocommerce_2.0.x/';" ) );
    add_action( 'wp_enqueue_scripts', 'yit_enqueue_woocommerce_styles', 11 );
    //add_action( 'woocommerce_single_product_summary', 'yit_rating_singleproduct', 10 );
    $woo_shop_folder = 'shop';

    // price filter
    global $woocommerce;
    // active the price filter
    if(version_compare($woocommerce->version,"2.0.0") < 0 ) {
        add_action('init', 'woocommerce_price_filter_init');
    }

}
else {

    if ( version_compare( $woocommerce->version , '2.2', '<' ) ) {
        add_filter( 'WC_TEMPLATE_PATH', create_function( "", "return 'woocommerce_2.1.x/';" ) );
    }/* woocommerce 2.2.x */
    else if ( version_compare( $woocommerce->version , '2.3', '<' ) ) {
        add_filter( 'woocommerce_template_path', create_function( "", "return 'woocommerce_2.2.x/';" ) );
    }/* woocommerce 2.3.x */
    else {
        add_action( 'wp_enqueue_scripts', 'yiw_enqueue_woocommerce_assets' );

        if ( version_compare( $woocommerce->version , '2.4', '<' ) ) {
            add_filter( 'woocommerce_template_path', create_function( '', "return 'woocommerce_2.3.x/';" ) );
        } else if ( version_compare( $woocommerce->version , '2.5', '<' ) ) {
            add_filter( 'woocommerce_template_path', create_function( '', "return 'woocommerce_2.4.x/';" ) );
        } else if ( version_compare( $woocommerce->version , '2.6', '<' ) ) {
            add_filter( 'woocommerce_template_path', create_function( '', "return 'woocommerce_2.5.x/';" ) );
        }  else { // WC 2.6

            add_filter( 'post_class', 'yiw_wc_product_post_class', 30, 3 );

            add_filter( 'product_cat_class', 'yit_wc_product_product_cat_class', 30, 3 );

            yiw_wc_2_6_removed_unused_template();

        }
    }

    add_filter( 'woocommerce_enqueue_styles', 'yit_enqueue_wc_styles' );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
    $woo_shop_folder = 'global';

}

// price filter
if ( ! is_active_widget( false, false, 'woocommerce_price_filter', true ) && version_compare( $woocommerce->version , '2.6', '<' ) ) {
    add_filter( 'loop_shop_post_in', array( WC()->query, 'price_filter' ) );
}

remove_action( 'woocommerce_pagination', 'woocommerce_catalog_ordering', 20 );

add_action( 'woocommerce_before_main_content' , create_function( '', 'if ( ! is_single() ) woocommerce_catalog_ordering();' ) );
// add theme support
add_theme_support('woocommerce');


/** 2.5 action */
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

add_action( 'woocommerce_shop_loop_item_title', 'yiw_shop_page_product_title', 10 );

/********
 * SHOP PAGE
 **********/

if ( !function_exists( 'yiw_shop_page_product_title' ) ) {
    /**
     * Add product title to main shop page
     *
     * @return void
     * @since  1.0.0
     * @author Francesco Licandro <francesco.licandro@yithemes.com>
     */
    function yiw_shop_page_product_title() {
        ?>

        <strong class="<?php echo yiw_get_option( 'shop_title_position' ); ?>"><?php echo get_the_title();?></strong>

        <?php
    }

}

if( ! function_exists('yiw_woocommerce_shop_loop_subcategory_title') ) {

    function yiw_woocommerce_shop_loop_subcategory_title( $category ) {

        $title_position = yiw_get_option( 'shop_title_position' );

        ?>
        <strong class="<?php echo $title_position ?>"><?php echo $category->name; ?></strong>
    <?php
    }
    remove_action( 'woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10 );
    add_action( 'woocommerce_shop_loop_subcategory_title' , 'yiw_woocommerce_shop_loop_subcategory_title' , 10 , 2 );
}



function yiw_set_posts_per_page( $cols ) {
    return yiw_get_option( 'shop_products_per_page', $cols );
}
add_filter('loop_shop_per_page', 'yiw_set_posts_per_page');

function yiw_estimate_n_cols() {
    global $content_width;

    return floor( $content_width / ( yiw_shop_thumbnail_w() + 35 ) );
}
add_filter( 'loop_shop_columns', 'yiw_estimate_n_cols' );

function yiw_add_style_woocommerce() {
    wp_enqueue_style( 'jquery-ui-style', (is_ssl()) ? 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css' : 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css' );
}
add_action( 'init', 'yiw_add_style_woocommerce' );

function yiw_add_to_cart_success_ajax( $datas ) {
    global $woocommerce;

	// quantity
    $qty     = yiw_get_option( 'shop-cart-count-items-mode' ) ? WC()->cart->get_cart_contents_count() : count( WC()->cart->get_cart() );

	if ( $qty == 1 )
	   $label = __( 'item', 'yiw' );
	else
	   $label = __( 'items', 'yiw' );

    $label = yiw_st_get_cart_label($qty);

    $datas['#linksbar .widget_shopping_cart'] = '<a class="widget_shopping_cart trigger" href="' . $woocommerce->cart->get_cart_url() . '">' . $qty . ' ' . $label . ' &ndash; ' . $woocommerce->cart->get_cart_total() . '</a>';
    $datas['span.minicart'] = $qty . ' ' . $label . ' &ndash; ' . $woocommerce->cart->get_cart_total();
    $datas['#linksbar .widget_shopping_cart .amount'] = $woocommerce->cart->get_cart_total();

    return $datas;
}

function yit_woocommerce_hooks() {
    global $woocommerce;

    if ( version_compare( $woocommerce->version , '2.4', '<' ) ) {
        add_filter( 'add_to_cart_fragments', 'yiw_add_to_cart_success_ajax' );
    } else {
        add_filter( 'woocommerce_add_to_cart_fragments', 'yiw_add_to_cart_success_ajax' );
    }
}
add_action( 'after_setup_theme', 'yit_woocommerce_hooks' );

function yiw_woocommerce_javascript_scripts() {
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($){
        $('body').bind('added_to_cart', function(){
            $('.add_to_cart_button.added').text('<?php echo apply_filters( 'yiw_added_to_cart_text', __( 'ADDED', 'yiw' ) ); ?>');
        });
    });
    </script>
    <?php
}
add_action( 'wp_head', 'yiw_woocommerce_javascript_scripts' );


/** SHOP
-------------------------------------------------------------------- */

// add the sale icon inside the product detail image container
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
add_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_sale_flash');

// decide the layout for the shop pages
function yiw_shop_layouts( $default_layout ) {
    if ( get_post_type() == 'product' && is_single() )
        return yiw_get_option( 'shop_layout_page_single', 'sidebar-no' );
    elseif ( is_post_type_archive( 'product' ) || ( get_post_type() == 'product' && is_search() ) || is_tax( 'product_cat' ) )
        return ( $l=get_post_meta( get_option( 'woocommerce_shop_page_id' ), '_layout_page', true )) ? $l : YIW_DEFAULT_LAYOUT_PAGE;
    else
        return $default_layout;
}
add_filter( 'yiw_layout_page', 'yiw_shop_layouts' );

// generate the main width for content and sidebar
function yiw_layout_widths() {
    global $content_width;

    $sidebar = YIW_SIDEBAR_WIDTH;

    if ( get_post_type() == 'product' || get_post_meta( get_the_ID(), '_sidebar_choose_page', true ) == 'Shop Sidebar' || is_tax( 'product_cat' ) )
        $sidebar = YIW_SIDEBAR_SHOP_WIDTH;

    $content_width = YIW_MAIN_WIDTH - ( $sidebar + 40 );

    ?>
        #content { width:<?php echo $content_width ?>px; }
        #sidebar { width:<?php echo $sidebar ?>px; }
        #sidebar.shop { width:<?php echo YIW_SIDEBAR_SHOP_WIDTH ?>px; }
    <?php
}
add_action( 'yiw_custom_styles', 'yiw_layout_widths' );

function yiw_minicart() {
    global $woocommerce;

	// quantity
	$qty = 0;
	if (sizeof($woocommerce->cart->get_cart())>0) : foreach ($woocommerce->cart->get_cart() as $item_id => $values) :

		$qty += $values['quantity'];

	endforeach; endif;

	if ( $qty == 1 )
	   $label = __( 'item', 'yiw' );
	else
	   $label = __( 'items', 'yiw' );

	echo '<a class="widget_shopping_cart trigger" href="' . $woocommerce->cart->get_cart_url() . '">
			<span class="minicart">' . $qty . ' ' . $label . ' &ndash; ' . $woocommerce->cart->get_cart_total() . ' </span>
		</a> | ';
}

// Decide if show the price and/or the button add to cart, on the product detail page
function yiw_remove_ecommerce() {
    if ( ! yiw_get_option( 'shop_show_button_add_to_cart_single_page', 1 ) )
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
    if ( ! yiw_get_option( 'shop_show_price_single_page', 1 ) )
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
}
add_action( 'wp_head', 'yiw_remove_ecommerce', 1 );

/**
 * LAYOUT
 */
function yiw_shop_layout_pages_before() {
    $layout = yiw_layout_page();
    if ( get_post_type() == 'product' && is_tax( 'product-category' ) )
        $layout = 'sidebar-no';
    elseif ( get_post_type() == 'product' && is_single() )
        $layout = yiw_get_option( 'shop_layout_page_single', 'sidebar-no' );
    elseif ( get_post_type() == 'product' && ! is_single() )
        $layout = ( $l=get_post_meta( get_option( 'woocommerce_shop_page_id' ), '_layout_page', true )) ? $l : YIW_DEFAULT_LAYOUT_PAGE;
    ?><div class="layout-<?php echo $layout ?> group"><?php
}

function yiw_shop_layout_pages_after() {
    ?></div><?php
}

//add_action( 'woocommerce_before_main_content', 'yiw_shop_layout_pages_before', 1 );
//add_action( 'woocommerce_sidebar', 'yiw_shop_layout_pages_after', 99 );

/**
 * SIZES
 */
if ( version_compare( $woocommerce->version , '2.1', '<' ) ) {
// shop small
function yiw_shop_small_w() { global $woocommerce; $size = $woocommerce->get_image_size('shop_thumbnail'); return $size['width']; }
function yiw_shop_small_h() { global $woocommerce; $size =$woocommerce->get_image_size('shop_thumbnail'); return $size['height']; }
// shop thumbnail
function yiw_shop_thumbnail_w() { global $woocommerce; $size = $woocommerce->get_image_size('shop_catalog'); return $size['width']; }
function yiw_shop_thumbnail_h() { global $woocommerce; $size =$woocommerce->get_image_size('shop_catalog'); return $size['height']; }
// shop large
function yiw_shop_large_w() { global $woocommerce; $size = $woocommerce->get_image_size('shop_single'); return $size['width']; }
function yiw_shop_large_h() { global $woocommerce; $size =$woocommerce->get_image_size('shop_single'); return $size['height']; }
}else{
    function yiw_shop_small_w() {  $size = wc_get_image_size('shop_thumbnail'); return $size['width']; }
    function yiw_shop_small_h() {  $size =wc_get_image_size('shop_thumbnail'); return $size['height']; }
// shop thumbnail
    function yiw_shop_thumbnail_w() {  $size = wc_get_image_size('shop_catalog'); return $size['width']; }
    function yiw_shop_thumbnail_h() {  $size = wc_get_image_size('shop_catalog'); return $size['height']; }
// shop large
    function yiw_shop_large_w() {  $size = wc_get_image_size('shop_single'); return $size['width']; }
    function yiw_shop_large_h() {  $size =wc_get_image_size('shop_single'); return $size['height']; }
}
/*
function yit_shop_small_w() { global $woocommerce; $size = $woocommerce->get_image_size('shop_catalog'); return $size['width']; }
function yit_shop_small_h() { global $woocommerce; $size =$woocommerce->get_image_size('shop_catalog'); return $size['height']; }
// shop thumbnail
function yit_shop_thumbnail_w() { global $woocommerce; $size = $woocommerce->get_image_size('shop_thumbnail'); return $size['width']; }
function yit_shop_thumbnail_h() { global $woocommerce; $size = $woocommerce->get_image_size('shop_thumbnail'); return $size['height']; }
// shop large
function yit_shop_large_w() { global $woocommerce; $size = $woocommerce->get_image_size('shop_single'); return $size['width']; }
function yit_shop_large_h() { global $woocommerce; $size = $woocommerce->get_image_size('shop_single'); return $size['height']; }
 */

// print style for small thumb size
function yiw_size_images_style() {
	?>
	.products li { width:<?php echo yiw_shop_thumbnail_w() + ( yiw_get_option( 'shop_border_thumbnail' ) ? 14 : 0 ) ?>px !important; }
	.products li a strong { width:<?php echo yiw_shop_thumbnail_w() - 30 ?>px !important; }
	.products li a strong.inside-thumb { top:<?php echo yiw_shop_thumbnail_h() - 41 ?>px !important; }
	.products li.border a strong.inside-thumb { top:<?php echo yiw_shop_thumbnail_h() + 7 - 41 ?>px !important; }
	.products li a img { width:<?php echo yiw_shop_thumbnail_w() ?>px !important;height:<?php echo yiw_shop_thumbnail_h() ?>px !important; }
	div.product div.images { width:<?php echo ( yiw_shop_large_w() + 14 ) / 750 * 100 ?>%; }
	.layout-sidebar-no div.product div.images { width:<?php echo ( yiw_shop_large_w() + 14 ) / 960 * 100 ?>%; }
	div.product div.images img { width:<?php echo yiw_shop_large_w() ?>px; }
	.layout-sidebar-no div.product div.summary { width:<?php echo ( 960 - ( yiw_shop_large_w() + 14 ) - 20 ) / 960 * 100 ?>%; }
	.layout-sidebar-right div.product div.summary, .layout-sidebar-left div.product div.summary { width:<?php echo ( 750 - ( yiw_shop_large_w() + 14 ) - 20 ) / 750 * 100 ?>%; }
	<?php
}
add_action( 'yiw_custom_styles', 'yiw_size_images_style' );

/**
 * PRODUCT PAGE
 */

function yiw_related_products_tab( $current_tab ) {
	    if ( ! yiw_if_related() ) {
	        return $current_tab;
        } else {
		 	return array_merge( array( 'related' => array (
		 					'title' => apply_filters( 'yiw_related_title', __('Related Products', 'yiw') ),
							'priority' => '15',
							'callback' => 'woocommerce_related_products_panel'
						) ), $current_tab
			);
        }
}

function yiw_if_related() {
    global $product;

    $related = $product->get_related();

    if ( !empty( $related ) ) {
        return true;
    }

    return false;
}

function woocommerce_related_products_panel() {
    if ( ! yiw_if_related() ) {
        return;
    } else {
        global $woocommerce;
        ?>
		<div class="group">
			<h2><?php echo apply_filters( 'yiw_related_title', __('Related Products', 'yiw') ) ?></h2>
			<?php
                    $cols = $prod = 5;
                    if ( yiw_get_option('shop_show_related_single_product') ){
                        $prod = apply_filters('shop_number_related_single_product', yiw_get_option( 'shop_number_related_single_product' ) );
                        $cols = apply_filters('related_products_columns', yiw_get_option( 'shop_columns_related_single_product' ) );
                    }

                    if ( ! version_compare( $woocommerce->version , '2.1', '<' ) ) {
                        $args = array(
                            'posts_per_page' => $prod,
                            'columns' => $cols,
                            'orderby' => 'rand'
                        );

                        woocommerce_related_products( apply_filters( 'woocommerce_output_related_products_args', $args ) );
                    } else {
                        woocommerce_related_products( $prod, $cols );
                    }
            }
               ?>
		</div>
		<?php

}


//add_action( 'woocommerce_product_tab_panels', 'woocommerce_related_products_panel', 1 );
if ( ! is_admin() ) {
    add_action( 'woocommerce_product_tabs', 'yiw_related_products_tab', 1 );
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
}

if ( ! isset( $_COOKIE["current_tab"] ) ) {
    setcookie( 'current_tab', '#related-products' );
    $_COOKIE["current_tab"] = '#related-products';
}

// product thumbnail
// function woocommerce_get_product_thumbnail( $size = 'shop_small', $placeholder_width = 0, $placeholder_height = 0 ) {
// 	global $post, $woocommerce;
//
// 	if (!$placeholder_width) $placeholder_width = $woocommerce->get_image_size('shop_catalog_image_width');
// 	if (!$placeholder_height) $placeholder_height = $woocommerce->get_image_size('shop_catalog_image_height');
//
// 	if ( has_post_thumbnail() )
// 	   $thumb = get_the_post_thumbnail($post->ID, $size);
// 	else
// 	   $thumb = '';
//
// 	if ( empty( $thumb ) )
//         $thumb = '<img src="'.woocommerce::plugin_url(). '/assets/images/placeholder.png" alt="Placeholder" width="'.$placeholder_width.'" height="'.$placeholder_height.'" />';
//
//     return $thumb;
// }

// number of products
function yiw_items_list_pruducts() {
    return 8;
}
//add_filter( 'loop_shop_per_page', 'yiw_items_list_pruducts' );



/** NAV MENU
-------------------------------------------------------------------- */

add_action('admin_init', array('yiwProductsPricesFilter', 'admin_init'));

class yiwProductsPricesFilter {
	// We cannot call #add_meta_box yet as it has not been defined,
    // therefore we will call it in the admin_init hook
	static function admin_init() {
		if ( ! is_plugin_active( 'woocommerce/woocommerce.php' ) || basename($_SERVER['PHP_SELF']) != 'nav-menus.php' )
			return;

		wp_enqueue_script('nav-menu-query', get_template_directory_uri() . '/inc/admin_scripts/metabox_nav_menu.js', 'nav-menu', false, true);
		add_meta_box('products-by-prices', 'Prices Filter', array(__CLASS__, 'nav_menu_meta_box'), 'nav-menus', 'side', 'low');
	}

	function nav_menu_meta_box() { ?>
	<div class="prices">
		<input type="hidden" name="woocommerce_currency" id="woocommerce_currency" value="<?php echo get_woocommerce_currency_symbol( get_option('woocommerce_currency') ) ?>" />
		<input type="hidden" name="woocommerce_shop_url" id="woocommerce_shop_url" value="<?php echo get_option('permalink_structure') == '' ? site_url() . '/?post_type=product' : get_permalink( get_option('woocommerce_shop_page_id') ) ?>" />
		<input type="hidden" name="menu-item[-1][menu-item-url]" value="" />
		<input type="hidden" name="menu-item[-1][menu-item-title]" value="" />
		<input type="hidden" name="menu-item[-1][menu-item-type]" value="custom" />

		<p>
		    <?php _e( sprintf( 'The values are already expressed in %s', get_woocommerce_currency_symbol( get_option('woocommerce_currency') ) ), 'yiw' ) ?>
		</p>

		<p>
			<label class="howto" for="prices_filter_from">
				<span><?php _e('From'); ?></span>
				<input id="prices_filter_from" name="prices_filter_from" type="text" class="regular-text menu-item-textbox input-with-default-title" title="<?php esc_attr_e('From'); ?>" />
			</label>
		</p>

		<p style="display: block; margin: 1em 0; clear: both;">
			<label class="howto" for="prices_filter_to">
				<span><?php _e('To'); ?></span>
				<input id="prices_filter_to" name="prices_filter_to" type="text" class="regular-text menu-item-textbox input-with-default-title" title="<?php esc_attr_e('To'); ?>" />
			</label>
		</p>

		<p class="button-controls">
			<span class="add-to-menu">
				<img class="waiting" src="<?php echo esc_url( admin_url( 'images/wpspin_light.gif' ) ); ?>" alt="" />
				<input type="submit" class="button-secondary submit-add-to-menu" value="<?php esc_attr_e('Add to Menu'); ?>" name="add-custom-menu-item" />
			</span>
		</p>

	</div>
<?php
	}
}

/**
 * Add 'On Sale Filter to Product list in Admin
 */
add_filter( 'parse_query', 'on_sale_filter' );
function on_sale_filter( $query ) {
    global $pagenow, $typenow, $wp_query;

    if ( $typenow=='product' && isset($_GET['onsale_check']) && $_GET['onsale_check'] ) :

        if ( $_GET['onsale_check'] == 'yes' ) :
            $query->query_vars['meta_compare']  =  '>';
            $query->query_vars['meta_value']    =  0;
            $query->query_vars['meta_key']      =  '_sale_price';
        endif;

        if ( $_GET['onsale_check'] == 'no' ) :
            $query->query_vars['meta_value']    = '';
            $query->query_vars['meta_key']      =  '_sale_price';
        endif;

    endif;
}

add_action('restrict_manage_posts','woocommerce_products_by_on_sale');
function woocommerce_products_by_on_sale() {
    global $typenow, $wp_query;
    if ( $typenow=='product' ) :

        $onsale_check_yes = '';
        $onsale_check_no  = '';

        if ( isset( $_GET['onsale_check'] ) && $_GET['onsale_check'] == 'yes' ) :
            $onsale_check_yes = ' selected="selected"';
        endif;

        if ( isset( $_GET['onsale_check'] ) && $_GET['onsale_check'] == 'no' ) :
            $onsale_check_no = ' selected="selected"';
        endif;

        $output  = "<select name='onsale_check' id='dropdown_onsale_check'>";
        $output .= '<option value="">'.__('Show all products (Sale Filter)', 'woothemes').'</option>';
        $output .= '<option value="yes"'.$onsale_check_yes.'>'.__('Show products on sale', 'woothemes').'</option>';
        $output .= '<option value="no"'.$onsale_check_no.'>'.__('Show products not on sale', 'woothemes').'</option>';
        $output .= '</select>';

        echo $output;

    endif;
}




add_action( 'admin_init', 'yit_woocommerce_update' ); //update image names after woocommerce update
/**
 * Update woocommerce options after update from 1.6 to 2.0
 */
function yit_woocommerce_update() {
	global $woocommerce;

	$field = 'yit_woocommerce_update_' . get_template();

	if( get_option($field) == false && version_compare($woocommerce->version,"2.0.0",'>=') ) {
		update_option($field, time());

		//woocommerce 2.0
		update_option(
			'shop_thumbnail_image_size',
			array(
				'width' => get_option('woocommerce_thumbnail_image_width', 90),
				'height' => get_option('woocommerce_thumbnail_image_height', 90),
				'crop' => get_option('woocommerce_thumbnail_image_crop', 1)
			)
		);

		update_option(
			'shop_single_image_size',
			array(
				'width' => get_option('woocommerce_single_image_width', 530 ),
				'height' => get_option('woocommerce_single_image_height', 345 ),
				'crop' => get_option('woocommerce_single_image_crop', 0)
			)
		);

		update_option(
			'shop_catalog_image_size',
			array(
				'width' => get_option('woocommerce_catalog_image_width', 150 ),
				'height' => get_option('woocommerce_catalog_image_height', 150 ),
				'crop' => get_option('woocommerce_catalog_image_crop', 1)
			)
		);
	}
}

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );


/* Function to add compatibility with WC 2.1 */
function yit_woocommerce_primary_start() {
    global $woo_shop_folder;
    yith_wc_get_template( $woo_shop_folder . '/primary-start.php' );
}

/*function yit_rating_singleproduct() {
    yith_wc_get_template( 'single-product/rating.php' );
}*/

function yit_woocommerce_primary_end() {
    global $woo_shop_folder;
    yith_wc_get_template( $woo_shop_folder . '/primary-end.php' );
}


if ( ! function_exists( 'yith_wc_get_page_id' ) ) {

    function yith_wc_get_page_id( $page ) {

        global $woocommerce;

        if ( version_compare( $woocommerce->version , '2.1', '<' ) ) {
            return function_exists('wc_get_page_id') ? wc_get_page_id( $page ) : woocommerce_get_page_id( $page );
        }
        else {

            if ( $page == 'pay' || $page == 'thanks' ) {
                $wc_order = new WC_Order();
                $page     = $wc_order->get_checkout_order_received_url();
            }

            return wc_get_page_id( $page );
        }

    }
}

if ( ! function_exists( 'yith_wc_get_template' ) ) {
    function yith_wc_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
        if ( function_exists( 'wc_get_template' ) ) {
            wc_get_template( $template_name, $args, $template_path, $default_path );
        }
        else {

            woocommerce_get_template( $template_name, $args, $template_path, $default_path );
        }
    }
}

function yit_enqueue_woocommerce_styles() {
    wp_deregister_style( 'woocommerce_frontend_styles' );
    wp_enqueue_style( 'woocommerce_frontend_styles', get_stylesheet_directory_uri() . '/woocommerce_2.0.x/style.css' );
}

function yit_enqueue_wc_styles( $styles ) {

    global $woocommerce;

    unset( $styles['woocommerce-layout'], $styles['woocommerce-smallscreen'], $styles['woocommerce-general'] );

    $style_version = '';
    if ( version_compare( $woocommerce->version , '2.4', '<' ) ) {
        $style_version = '_' . substr( $woocommerce->version, 0, 3 ) . '.x';
    }

    $styles ['yit-layout'] = array(
        'src'     => get_stylesheet_directory_uri() . '/woocommerce' . $style_version . '/style.css',
        'deps'    => '',
        'version' => '1.0',
        'media'   => ''
    );
    return $styles;
}

/* Other Actions */

/* compare button */
global $yith_woocompare;

if ( isset($yith_woocompare) ) {
    remove_action( 'woocommerce_after_shop_loop_item', array( $yith_woocompare->obj, 'add_compare_link' ), 20 );
    remove_action( 'woocommerce_single_product_summary', array( $yith_woocompare->obj, 'add_compare_link' ), 35 );
}

/* wishlist */
if ( isset($yith_wcwl) ) {
    remove_action( 'wp_head', array( $yith_wcwl, 'add_button' ));
}

add_filter( 'yith_wcwl_tab_options', 'yiw_remove_wishlist_text_option' );
add_action( 'woocommerce_single_product_summary', 'yiw_product_other_actions' ,31 );

function yiw_product_other_actions() {
    yith_wc_get_template( 'loop/other-actions.php' );
}

// Redirect to checkout page after add to cart
add_action( 'before_woocommerce_init', 'yiw_shop_redirect_to_checkout' );

function yiw_shop_redirect_to_checkout() {

    if ( yiw_get_option( 'shop-redirect-to-checkout' ) ) {
        add_filter ( yiw_get_add_to_cart_redirect_filter_name(), 'yiw_redirect_to_checkout' );
        add_filter ( 'wc_add_to_cart_params', 'yiw_redirect_cart_to_checkout' );
    }

}


function yiw_get_add_to_cart_redirect_filter_name() {
    /**
     * Get add to cart redirect filter name
     *
     *
     * @return string
     * @since  2.0.0
     * @author Andrea Frascaspata <andrea.frascaspata@yithemes.com>
     */
    $add_to_cart_redirect_filter = 'woocommerce_add_to_cart_redirect';

    //wc 2.2.x fix
    if ( version_compare( WC()->version, '2.3', '<' ) ) {
        $add_to_cart_redirect_filter = 'add_to_cart_redirect';
    }

    return $add_to_cart_redirect_filter;
}


if ( ! function_exists( 'yiw_redirect_to_checkout' ) ) {
    /**
     * Redirect to checkout page after add to cart
     *
     * @since 1.6.0
     *
     * @return string
     */
    function yiw_redirect_to_checkout() {

        if( function_exists( 'wc_get_checkout_url' ) ) {
            $checkout_url = wc_get_checkout_url();
        }  else {
            global $woocommerce;
            $checkout_url = $woocommerce->cart->get_checkout_url();
        }

        return $checkout_url;

    }
}

if ( ! function_exists( 'yiw_redirect_cart_to_checkout' ) ) {
    /**
     * Redirect to checkout after product is added to cart
     *
     * This function is called only on shop pages and shortcodes.
     *
     * @since 1.6.0
     *
     * @param $params
     * @return null
     */
    function yiw_redirect_cart_to_checkout( $params ) {
        return null;
    }
}

//--------------------------------------------------------------------------------------------
if ( ! function_exists( 'yit_woocommerce_default_shiptobilling' ) ) {

    function yit_woocommerce_default_shiptobilling() {
        return ( get_option( 'woocommerce_ship_to_destination' ) == 'billing' || get_option( 'woocommerce_ship_to_destination' ) == 'billing_only' );
    }

}

if ( ! function_exists( 'yit_woocommerce_default_shiptoaddress' ) ) {

    function yit_woocommerce_default_shiptoaddress() {
        return ( get_option( 'woocommerce_ship_to_destination' ) == 'shipping' );
    }
}
//-------------------------------------------------------------------------

function yiw_enqueue_woocommerce_assets() {
    wp_enqueue_script( 'yiw-woocommerce', get_template_directory_uri() . '/js/woocommerce.js',array( 'jquery', 'jquery-cookie' ), '1.0', true );
}

/* quick view compatibility */

function yith_load_product_quick_view() {
    if ( function_exists( 'YITH_WCQV_Frontend' ) && get_option( 'yith-wcqv-enable' ) == 'yes' ) {

        $quick_view = YITH_WCQV_Frontend();
        $position   = isset( $quick_view->position ) ? $quick_view->position : 'add-cart';

        add_filter( 'yith_quick_view_loader_gif', 'yiw_get_ajax_loader_gif_url' );

        remove_action( 'yith_wcqv_product_image', 'woocommerce_show_product_sale_flash', 10 );

    }
}

add_action( 'after_setup_theme', 'yith_load_product_quick_view' );


if ( ! function_exists( 'is_quick_view' ) ) {

    function is_quick_view() {
        return ( function_exists( 'YITH_WCQV_Frontend' ) && (( defined('DOING_AJAX') && DOING_AJAX && isset( $_REQUEST['action'] ) && $_REQUEST['action'] == 'yith_load_product_quick_view' )) );
    }
}

if( is_quick_view() && class_exists('WooCommerce_Product_Vendors') ){
    global $wc_product_vendors;
    remove_filter( 'request', array( $wc_product_vendors, 'restrict_media_library' ), 10, 1 );
    remove_filter( 'request', array( $wc_product_vendors, 'filter_booking_list' ) );
    remove_filter( 'request', array( $wc_product_vendors, 'filter_product_list' ) );
}

/* end quick view compatibility */

/* === WC 2.6 === */

function yiw_wc_product_post_class( $classes, $class = '', $post_id = '' ) {

    if ( !$post_id || 'product' !== get_post_type( $post_id ) ) {
        return $classes;
    }

    $product = wc_get_product( $post_id );

    if ( $product ) {

        global $woocommerce_loop;

        // Store loop count we're currently on
        if( ! ( isset( $woocommerce_loop['name'] ) || empty( $woocommerce_loop['name'] ) )  && ! isset( $woocommerce_loop['yiw_shortcodes'] ) )  {
            return $classes;
        }

        if (   yiw_get_option( 'shop_border_thumbnail' ) )        { $classes[] = 'border'; }
        if (   yiw_get_option( 'shop_shadow_thumbnail' ) )        { $classes[] = 'shadow'; }
        if ( ! yiw_get_option( 'shop_show_price' ) )              { $classes[] = 'hide-price'; }
        if ( ! yiw_get_option( 'shop_show_button_details' ) )     { $classes[] = 'hide-details-button'; }
        if ( ! yiw_get_option( 'shop_show_button_add_to_cart' ) ) { $classes[] = 'hide-add-to-cart-button'; }

    }

    return $classes;

}


function yit_wc_product_product_cat_class( $classes, $class, $category ) {

    if (   yiw_get_option( 'shop_border_thumbnail' ) )        { $li_class[] = 'border'; }
    if (   yiw_get_option( 'shop_shadow_thumbnail' ) )        { $li_class[] = 'shadow'; }
    if ( ! yiw_get_option( 'shop_show_price' ) )              { $li_class[] = 'hide-price'; }
    if ( ! yiw_get_option( 'shop_show_button_details' ) )     { $li_class[] = 'hide-details-button'; }
    if ( ! yiw_get_option( 'shop_show_button_add_to_cart' ) ) { $li_class[] = 'hide-add-to-cart-button'; }

    return $classes;

}

/**
 * @author Andrea Frascaspata
 */
function yiw_wc_2_6_removed_unused_template () {

    if( function_exists( 'yiw_theme_remove_unused_template' ) ) {

        $option = 'yit_wc_2_6_template_remove';

        $files = array( 'single-product/review.php' );

        yiw_theme_remove_unused_template( 'woocommerce' , $option , $files );

    }

}
