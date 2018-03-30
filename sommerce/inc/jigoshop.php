<?php 
/**
 * All functions and hooks for jigoshop plugin  
 *
 * @package WordPress
 * @subpackage YIW Themes
 * @since 1.4
 */    
 
include 'shortcodes-jigoshop.php';


/** SHOP
-------------------------------------------------------------------- */

// add the sale icon inside the product detail image container
//add_action( 'jigoshop_before_shop_loop_item_title', 'jigoshop_show_product_sale_flash', 10, 2);
add_action( 'jigoshop_before_single_product_summary_thumbnails', 'jigoshop_show_product_sale_flash', 10, 2);

// decide the layout for the shop pages
function yiw_shop_layouts( $default_layout ) {
    $is_shop_page = ( get_option('jigoshop_shop_page_id') != false ) ? is_page( get_option('jigoshop_shop_page_id') ) : false;
    if ( is_tax('product_cat') || is_tax('product_tag') || is_post_type_archive('product') || $is_shop_page )
        return YIW_DEFAULT_LAYOUT_PAGE_SHOP;    
    else
        return $default_layout;
}
add_filter( 'yiw_layout_page', 'yiw_shop_layouts' );

// generate the main width for content and sidebar
function yiw_layout_widths() {
    global $content_width;
    
    $sidebar = YIW_SIDEBAR_WIDTH;
                                  
    if ( get_post_type() == 'product' || get_post_meta( get_the_ID(), '_sidebar_choose_page', true ) == 'Shop Sidebar' )
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
    if ( ! class_exists( 'Jigoshop_Widget_Cart' ) )
        return; 
        
	$cart = new Jigoshop_Widget_Cart();
	
	$args = array(
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		'before_widget' => '<div class="basketpopup">',
		'after_widget' => '</div>'
	);
	
	$instance = array(
		'title' => __( 'My Cart', 'yiw' )
	);
	
	// quantity
	$qty = 0;
	if (sizeof(jigoshop_cart::$cart_contents)>0) : foreach (jigoshop_cart::$cart_contents as $item_id => $values) :
	
		$qty += $values['quantity'];
	
	endforeach; endif;
	
	if ( $qty == 1 )
	   $label = __( 'item', 'yiw' );
	else             
	   $label = __( 'items', 'yiw' );
	   
	
	echo '<a class="trigger" href="' . jigoshop_cart::get_cart_url() . '">
			<span> ' . $qty . ' ' . $label . ' &ndash; ' . jigoshop_cart::get_cart_total() . ' </span>
		</a> | ';
	
	$cart->widget( $args, $instance );
}     

// Decide if show the price and/or the button add to cart, on the product detail page
function yiw_remove_ecommerce() {
    if ( ! yiw_get_option( 'shop_show_button_add_to_cart_single_page', 1 ) )                         
        remove_action( 'jigoshop_template_single_summary', 'jigoshop_template_single_add_to_cart', 30, 2 ); 
    if ( ! yiw_get_option( 'shop_show_price_single_page', 1 ) )                       
        remove_action( 'jigoshop_template_single_summary', 'jigoshop_template_single_price', 10, 2);
}
add_action( 'wp_head', 'yiw_remove_ecommerce', 1 );

function jigoshop_template_loop_add_to_cart( $post, $_product ) {
    ?><div class="buttons">
        <a href="<?php the_permalink(); ?>" class="details"><?php echo yiw_get_option( 'shop_button_details_label' ) ?></a>&nbsp;<?php
        
        // do not show "add to cart" button if product's price isn't announced
		if ( $_product->get_price() === '' AND ! ($_product->is_type(array('variable', 'grouped', 'external'))) ) return;
		
		if ( $_product->is_in_stock() OR $_product->is_type('external') ) :
			if ( $_product->is_type(array('variable', 'grouped')) ) :
				$output = '<a href="'.get_permalink($_product->id).'" class="add-to-cart">'.__('Select', 'yiw').'</a>';
			elseif ( $_product->is_type('external') ) :
				$output = '<a href="'.get_post_meta( $_product->id, 'external_url', true ).'" class="add-to-cart">'.__('Buy product', 'yiw').'</a>';
			else :
				$output = '<a href="'.esc_url($_product->add_to_cart_url()).'" class="add-to-cart">'.yiw_get_option( 'shop_button_addtocart_label', __('Add to cart', 'yiw') ).'</a>';
			endif;
		else :
			$output = '<span class="nostock">'.__('Out of Stock', 'yiw').'</span>';
		endif;
		echo $output;
		
	?></div><?php
}              

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
        $layout = ( $l=get_post_meta( get_option( 'jigoshop_shop_page_id' ), '_layout_page', true )) ? $l : YIW_DEFAULT_LAYOUT_PAGE;  
    ?><div class="layout-<?php echo $layout ?> group"><?php    
    
    if ( $layout == 'sidebar-no' )
        remove_action( 'jigoshop_sidebar', 'jigoshop_get_sidebar', 10);
} 

function yiw_shop_layout_pages_after() {
    ?></div><?php    
}                                                                   
  
add_action( 'jigoshop_before_main_content', 'yiw_shop_layout_pages_before', 1 );
add_action( 'jigoshop_sidebar', 'yiw_shop_layout_pages_after', 99 );
                    
/**
 * SIZES
 */

function yiw_get_jigoshop_size( $size ) {
    global $jigoshop_options;
    if( !isset( $jigoshop_options ) || empty( $jigoshop_options ) ) {
        $jigoshop_options = Jigoshop_Base::get_options();
    }

    return $jigoshop_options->get_option( $size );
}

// shop small
function yiw_shop_small_w() { return yiw_get_jigoshop_size('jigoshop_shop_small_w'); }
function yiw_shop_small_h() { return yiw_get_jigoshop_size('jigoshop_shop_small_h'); }
// shop tiny
function yiw_shop_tiny_w() { return yiw_get_jigoshop_size('jigoshop_shop_tiny_w'); }
function yiw_shop_tiny_h() { return yiw_get_jigoshop_size('jigoshop_shop_tiny_h'); }
// shop thumbnail
function yiw_shop_thumbnail_w() { return yiw_get_jigoshop_size('jigoshop_shop_thumbnail_w'); }
function yiw_shop_thumbnail_h() { return yiw_get_jigoshop_size('jigoshop_shop_thumbnail_h'); }
// shop large
function yiw_shop_large_w() { return yiw_get_jigoshop_size('jigoshop_shop_large_w'); }
function yiw_shop_large_h() { return yiw_get_jigoshop_size('jigoshop_shop_large_h'); }
      
function yiw_change_shop_sizes() {
    // shop small                          
    add_filter( 'jigoshop_get_var_shop_small_w', 'yiw_shop_small_w' );
    add_filter( 'jigoshop_get_var_shop_small_h', 'yiw_shop_small_h' );
    // shop tiny                          
    add_filter( 'jigoshop_get_var_shop_tiny_w', 'yiw_shop_tiny_w' );
    add_filter( 'jigoshop_get_var_shop_tiny_h', 'yiw_shop_tiny_h' );
    // shop thumbnail                          
    add_filter( 'jigoshop_get_var_shop_thumbnail_w', 'yiw_shop_thumbnail_w' );
    add_filter( 'jigoshop_get_var_shop_thumbnail_h', 'yiw_shop_thumbnail_h' );
    // shop large                          
    add_filter( 'jigoshop_get_var_shop_large_w', 'yiw_shop_large_w' );
    add_filter( 'jigoshop_get_var_shop_large_h', 'yiw_shop_large_h' );
}
//add_action( 'init', 'yiw_change_shop_sizes' ); 

// change size for large image on product page
function yiw_change_large_size() {
    return 'shop_large_image';
}
//add_filter( 'single_product_large_thumbnail_size', 'yiw_change_large_size' );

// print style for small thumb size
function yiw_size_images_style() {  
    $thumb_cols = apply_filters( 'single_thumbnail_columns', 3 );
	?>
	.products li { width:<?php echo yiw_shop_small_w() + ( yiw_get_option( 'shop_border_thumbnail' ) ? 14 : 0 ) ?>px !important; }
	.products li a strong { width:<?php echo yiw_shop_small_w() - 30 ?>px !important; }
	.products li a strong.inside-thumb { bottom:0px !important; }
	.products li.shadow a strong.inside-thumb { bottom:21px !important; }
	.products li.border a strong.inside-thumb { bottom:7px !important; }
	.products li.border.shadow a strong.inside-thumb { bottom:28px !important; }
	.products li a img { width:<?php echo yiw_shop_small_w() ?>px !important;height:<?php echo yiw_shop_small_h() ?>px !important; }
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

/**
 * After Single Products Summary Div
 **/
function jigoshop_output_product_data_tabs() {       
		
	global $_product;
	
	if ( get_the_content() == '' && ! yiw_if_related() && ! $_product->has_attributes() && ! comments_open() )
	   return;
	
	if ( yiw_if_related() )
	   $current_tab = '#related-products';
	elseif ( get_the_content() != '' )     
	   $current_tab = '#tab-description';
	elseif ( comments_open() )     
	   $current_tab = '#tab-reviews';
	elseif ( $_product->has_attributes() )     
	   $current_tab = '#tab-attributes';
	
	?>
	<div id="product-tabs">
		<ul class="tabs">
		
			<?php do_action('jigoshop_product_tabs', $current_tab); ?>
			
		</ul>			
		
		<div class="containers">
		  <?php do_action('jigoshop_product_tab_panels'); ?>
		</div>
		
	</div>
	<?php
	
}

function jigoshop_product_description_tab( $current_tab ) {
    if ( get_the_content() == '' )
        return;
	?>
	<li <?php if ($current_tab=='#tab-description') echo 'class="active"'; ?>><a href="#tab-description"><?php _e('Description', 'yiw'); ?></a></li>
	<?php
}                    
function jigoshop_product_description_panel() {  
    if ( get_the_content() == '' )
        return;
	echo '<div class="panel" id="tab-description">';
	the_content();
	echo '</div>';
}
function yiw_related_products_tab( $current_tab ) {  
    if ( ! yiw_if_related() )
        return;
	?>
 	<li <?php if ($current_tab=='#related-products') echo 'class="active"'; ?>><a href="#related-products"><?php _e('Related Products', 'yiw'); ?></a></li>
 	<?php
}                

function yiw_if_related() {
    $plugin = get_file_data( WP_PLUGIN_DIR . '/jigoshop/jigoshop.php', array( 'Version' => 'Version' ), 'plugin' );

    if ( version_compare( $plugin['Version'], '1.1.1', ">=" ) && get_option( 'jigoshop_enable_related_products' ) == 'no' )
        return false;

    global $_product, $post;

    if ( isset( $post->ID ) )
        $actual_product = $post->ID;
    else
        $actual_product = 0;

    $related = $_product->get_related();
    if ( $actual_product != 0 )
        { unset( $related[ array_search( $actual_product, $related ) ] ); }

    if( !empty( $related ) ) {
        return true;
    }

    return false;
}

function jigoshop_related_products_panel() {
    if ( ! yiw_if_related() )
        return;
	echo '<div class="panel" id="related-products">';
	
	if ( yiw_get_option('shop_show_related_single_product') ) {
		jigoshop_related_products( apply_filters( 'related_products_products_per_page', yiw_get_option('shop_number_related_single_product') ), apply_filters( 'related_products_columns', yiw_get_option( 'shop_columns_related_single_product' ) ) );
    } else {
		jigoshop_related_products( apply_filters( 'related_products_products_per_page', 4 ), apply_filters( 'related_products_columns', 4 ) );
    }
	
	echo '</div>';
}         

function jigoshop_related_products( $posts_per_page = 4, $post_columns = 4, $orderby = 'rand' ) {
	global $_product, $columns, $per_page, $post;
	
	if ( isset( $post->ID ) )
	   $actual_product = $post->ID;
	else
	   $actual_product = 0;
	                                  
	// Pass vars to loop
	$per_page = $posts_per_page;
	$columns = $post_columns;

    $limit = $actual_product != 0 ? $per_page + 1 : $per_page;

	$related = $_product->get_related( $limit );
	if ( $actual_product != 0 )
	    unset( $related[ array_search( $actual_product, $related ) ] );
	    
	if ( count( $related ) > 0 ) {
		$args = apply_filters( 'jigoshop_related_products_args', array(
			'post_type'	=> 'product',
			'ignore_sticky_posts'	=> 1,
			'posts_per_page' => $per_page,
			'orderby' => $orderby,
			'post__in' => $related
		) );

		query_posts( $args );
        
        if ( ! have_posts() )
            return '';
          
		echo '<div class="related products">';
		jigoshop_get_template_part( 'loop', 'shop' ); 
		echo '</div>';
    }

	wp_reset_query();
	
}                                                          
add_action( 'jigoshop_product_tab_panels', 'jigoshop_related_products_panel', 1 );
add_action( 'jigoshop_product_tabs', 'yiw_related_products_tab', 1 ); 
remove_action( 'jigoshop_after_single_product_summary', 'jigoshop_output_related_products', 20);

if ( ! isset( $_COOKIE["current_tab"] ) ) {
    setcookie( 'current_tab', apply_filters( 'yiw_current_product_tab', '#related-products' ) );
    $_COOKIE["current_tab"] = apply_filters( 'yiw_current_product_tab', '#related-products' );
}

// pagination
function jigoshop_pagination() {
    get_template_part('pagination');
}

// product thumbnail
function jigoshop_get_product_thumbnail( $size = 'shop_small', $placeholder_width = 0, $placeholder_height = 0 ) {
	
	global $post;
	
	if (!$placeholder_width) $placeholder_width = jigoshop::get_var('shop_small_w');
	if (!$placeholder_height) $placeholder_height = jigoshop::get_var('shop_small_h');
	
	if ( has_post_thumbnail() ) 
	   $thumb = get_the_post_thumbnail($post->ID, $size);
	else
	   $thumb = '';
	
	if ( empty( $thumb ) )
        $thumb = '<img src="'.jigoshop::plugin_url(). '/assets/images/placeholder.png" alt="Placeholder" width="'.$placeholder_width.'" height="'.$placeholder_height.'" />';
	
    return $thumb;
}

// number of products
function yiw_items_list_pruducts() {
    return 8;
}
//add_filter( 'loop_shop_per_page', 'yiw_items_list_pruducts' );



/** NAV MENU
-------------------------------------------------------------------- */

if ( !is_checkout() ){
   // add_action('admin_init', array('yiwProductsPricesFilter', 'admin_init'));
}

class yiwProductsPricesFilter {
	// We cannot call #add_meta_box yet as it has not been defined,
    // therefore we will call it in the admin_init hook
	function admin_init() {
		if ( ! is_plugin_active( 'jigoshop/jigoshop.php' ) || basename($_SERVER['PHP_SELF']) != 'nav-menus.php' ) 
			return;
			                                                    
		wp_enqueue_script('nav-menu-query', get_template_directory_uri() . '/inc/admin_scripts/metabox_nav_menu.js', 'nav-menu', false, true);
		add_meta_box('products-by-prices', 'Prices Filter', array(__CLASS__, 'nav_menu_meta_box'), 'nav-menus', 'side', 'low');
	}

	function nav_menu_meta_box() { ?>
	<div class="prices">        
		<input type="hidden" name="jigoshop_currency" id="jigoshop_currency" value="<?php echo get_jigoshop_currency_symbol( get_option('jigoshop_currency') ) ?>" />
		<input type="hidden" name="jigoshop_shop_url" id="jigoshop_shop_url" value="<?php echo get_option('permalink_structure') == '' ? site_url() . '/?post_type=product' : get_permalink( get_option('jigoshop_shop_page_id') ) ?>" />
		<input type="hidden" name="menu-item[-1][menu-item-url]" value="" />
		<input type="hidden" name="menu-item[-1][menu-item-title]" value="" />
		<input type="hidden" name="menu-item[-1][menu-item-type]" value="custom" />
		
		<p>
		    <?php _e( sprintf( 'The values are already expressed in %s', get_jigoshop_currency_symbol( get_option('jigoshop_currency') ) ), 'yiw' ) ?>
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
?>