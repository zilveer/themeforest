<?php
/************************************************************************
* WooCommerce Settings
*************************************************************************/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

//Includes Admin Options
if ( file_exists( dirname( __FILE__ ) . '/woo-admin.php' ) ) {
	require dirname( __FILE__ ) . '/woo-admin.php';
}

//Own Styles
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

if ( !is_admin() ) {
	add_action( 'wp_enqueue_scripts', 'wbc_register_assets', 15 );
}

if( !function_exists( 'wbc_register_assets' )) {
	function wbc_register_assets() {
		wp_enqueue_style( 'wbc-custom-woocommerce-css', get_template_directory_uri().'/includes/config-woo/woo-custom-styles.css' );
		wp_enqueue_script( 'wbc-custom-woocommerce-js', get_template_directory_uri().'/includes/config-woo/woo-custom-script.js', array( 'jquery' ), 1, true );
	}
}

//Add Theme Support
add_theme_support( 'woocommerce' );

// Hides Page Title Shown above store
add_filter( 'woocommerce_show_page_title', '__return_false' );

//Remove Bread Crumb
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count' , 20 );


//Amount Shown per page
add_filter( 'loop_shop_per_page', 'wbc_shop_loop_count', 20 );
function wbc_shop_loop_count( $count ) {
	return apply_filters( 'wbc_shop_page_loop_count', $count );
}

// Remove Sidebar -
// Will be added if using right or left page sidebar pageoption
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

// Changes amount shown on shop page
add_filter( 'loop_shop_columns' , 'wbc_shop_column_count', 20 );
function wbc_shop_column_count( $count ) {
	return intval( apply_filters( 'wbc_shop_page_columns', 3 ) );
}


//Adds Columns Wrapper to shop page
add_action( 'woocommerce_before_shop_loop', 'wbc_before_shop_columns' );
add_action( 'woocommerce_after_shop_loop', 'wbc_after_shop_columns', 60 );

function wbc_before_shop_columns() {
	$wbc_shop_columns = intval( apply_filters( 'wbc_shop_page_columns', 3 ) );
	echo '<div class="shop-wrapper woocommerce columns-'.$wbc_shop_columns.'">';
}

function wbc_after_shop_columns() {
	echo '</div>';
}

//First remove default wrapper
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

// Add Wrappers
add_action( 'woocommerce_before_main_content', 'wbc_shop_wrapper_start', 10 );
add_action( 'woocommerce_after_main_content', 'wbc_shop_wrapper_end', 100 );
function wbc_shop_wrapper_start() {
	echo '<div class="main-content-area clearfix">';
	echo '<div class="container">';
	echo '<div class="row">';

	$template = apply_filters( 'wbc_shop_page_layout' , get_post_meta( wbc_shop_meta_post_id( 0 ) , '_wp_page_template', true ) );

	if ( $template ) {
		switch ( $template ) {
		case 'default':
			echo '<div class="col-sm-12">';
			break;

		case 'template-page-left.php':
			echo '<div class="col-sm-3">';
			get_sidebar();
			echo '</div><!--./col-sm-3-->';
			echo '<div class="col-sm-9">';
			break;

		default:
			echo '<div class="col-sm-9">';
			break;
		}
	}else{
		echo '<div class="col-sm-9">';
	}

}


function wbc_shop_wrapper_end() {

	$template = apply_filters( 'wbc_shop_page_layout' , get_post_meta( wbc_shop_meta_post_id( 0 ) , '_wp_page_template', true ) );

	if ( $template ) {

		switch ( $template ) {
		case 'default':
			echo '</div><!--./col-sm-12-->';
			break;

		case 'template-page-left.php':
			echo '</div><!--./col-sm-9-->';
			break;

		default:
			echo '</div><!--./col-sm-9-->';
			echo '<div class="col-sm-3">';
			get_sidebar();
			echo '</div><!--./col-sm-3-->';
			break;
		}

	}else{
			echo '</div><!--./col-sm-9-->';
			echo '<div class="col-sm-3">';
			get_sidebar();
			echo '</div><!--./col-sm-3-->';
	}


	echo '</div><!--./row-->';
	echo '</div><!--./container-->';
	echo '</div><!--./main-content-area-->';
}

/************************************************************************
* Cross Sells
*************************************************************************/

if( !function_exists( 'wbc_cross_sell_count' ) ){
	function wbc_cross_sell_count( $count ){
		return 2;
	}
	add_filter( 'woocommerce_cross_sells_total', 'wbc_cross_sell_count' );
}

/************************************************************************
* Related
*************************************************************************/

add_filter( 'woocommerce_output_related_products_args', 'wbc_related_products_args' );
function wbc_related_products_args( $args ) {
	$args['posts_per_page'] = intval( apply_filters( 'wbc_related_item_count', 3 ) );
	$args['columns']        = intval( apply_filters( 'wbc_related_column_count', 3 ) );

	return $args;
}

add_action( 'woocommerce_after_single_product_summary', 'wbc_before_related_products', 18 );
add_action( 'woocommerce_after_single_product_summary', 'wbc_after_related_products', 22 );

function wbc_before_related_products() {
	$related_columns = intval( apply_filters( 'wbc_related_column_count', 3 ) );
	echo '<div class="clearfix woocommerce related-wrap columns-'.$related_columns.'">';
}

function wbc_after_related_products() {
	echo '</div>';
}

/************************************************************************
* UpSell
*************************************************************************/

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );

add_action( 'woocommerce_after_single_product_summary', 'wbc_upsell_output_products', 15 );
function wbc_upsell_output_products() {

	$upsell_items   = intval( apply_filters( 'wbc_upsell_item_count', 3 ) );
	$upsell_columns = intval( apply_filters( 'wbc_upsell_column_count', 3 ) );

	$output = '';

	ob_start();

	woocommerce_upsell_display( $upsell_items , $upsell_columns );

	$content = ob_get_clean();

	if ( !empty( $content ) ) {
		echo '<div class="clearfix woocommerce upsell-wrap columns-'.$upsell_columns.'">';
		echo !empty( $content ) ? $content : '';
		echo '</div>';
	}
}


/************************************************************************
* Product Display
*************************************************************************/

add_action( 'woocommerce_before_shop_loop_item_title', 'wbc_wrap_before_title', 15 );

function wbc_wrap_before_title() {
	echo '<div class="item-info-wrap">';
}

add_action( 'woocommerce_after_shop_loop_item_title', 'wbc_wrap_after_title', 20 );
function wbc_wrap_after_title() {
	echo '</div>';
}

//Pagination
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination' , 10 );

if ( !function_exists( 'wbc_shop_pagination' ) ) {
	function wbc_shop_pagination() {
		global $wp_query;

		if ( $wp_query->max_num_pages <= 1 ) {
			return;
		}
		$shop_links = paginate_links( apply_filters( 'woocommerce_pagination_args', array(
					'base'         => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
					'format'       => '',
					'add_args'     => '',
					'current'      => max( 1, get_query_var( 'paged' ) ),
					'total'        => $wp_query->max_num_pages,
					'type'         => 'array',
					'end_size'     => 3,
					'mid_size'     => 3
				) ) );

		if ( is_array( $shop_links ) ) {
			echo '<div class="text-right">';
			echo '<ul class="wbc-pagination">';

			foreach ( $shop_links as $link ) {
				echo '<li>'.$link.'</li>';
			}

			echo '</ul></div>';
		}
	}
	add_action( 'woocommerce_after_shop_loop', 'wbc_shop_pagination', 10 );
}


if ( !function_exists( 'wbc_shop_cart_button' ) ) {

	function wbc_shop_cart_button() {
		?>
			<a class="cart-contents" href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" title="<?php esc_attr_e( esc_html__( 'View Shopping Cart', 'ninezeroseven' ) ); ?>">
				<i class="fa fa-shopping-cart"></i> <span class="count"><?php echo wp_kses_data( WC()->cart->get_cart_contents_count() );?></span>
			</a>
		<?php
	}

}

if ( !function_exists( 'wbc_add_shoping_cart' ) ) {
	function wbc_add_shoping_cart( $nav, $args ) {
		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

			if ( $args->theme_location == 'wbc907-primary' ) {
				ob_start();
				?>
					<li class="wbc-shop-cart">
						<?php wbc_shop_cart_button(); ?>
						<?php //the_widget( 'WC_Widget_Cart', 'title=' ); ?>
					</li>
		    	<?php

				$output = ob_get_clean();
				if ( $output ) {

					return $nav.$output;

				}
			}
		}

		return $nav;
	}
	add_filter( 'wp_nav_menu_items', 'wbc_add_shoping_cart', 10, 2 );
}


if ( !function_exists( 'wbc_cart_framents' ) ) {
	function wbc_cart_framents( $fragments ) {
		global $woocommerce;
		ob_start();
		wbc_shop_cart_button();

		$fragments['a.cart-contents'] = ob_get_clean();
		return $fragments;
	}
	add_filter( 'add_to_cart_fragments', 'wbc_cart_framents' );
}

/************************************************************************
* Wrap Product
*************************************************************************/
add_action( 'woocommerce_before_subcategory', 'wbc_before_shop_item');
add_action( 'woocommerce_after_subcategory', 'wbc_after_shop_item', 100);
add_action( 'woocommerce_before_shop_loop_item', 'wbc_before_shop_item');
add_action( 'woocommerce_after_shop_loop_item', 'wbc_after_shop_item', 100);
function wbc_before_shop_item(){
	echo '<div class="wbc-shop-item-wrap">';
}
function wbc_after_shop_item(){
	echo '</div>';
}
/************************************************************************
* Wrap Thumbnail
*************************************************************************/
add_action( 'woocommerce_before_shop_loop_item_title', 'wbc_before_shop_image', 9 );
add_action( 'woocommerce_before_shop_loop_item_title', 'wbc_after_shop_image', 11 );
function wbc_before_shop_image() {
	global $product;
	echo '<div class="wbc-shop-image-wrapper">';

	if ( in_array( $product->product_type, array( 'subscription', 'simple' ) ) ) {
		echo '<div class="wbc-cart-animation"></div>';
	}

}
function wbc_after_shop_image() {
	echo '</div>';
}
/************************************************************************
* Cart/View Details Shop Buttons
*************************************************************************/
remove_action( 'woocommerce_after_shop_loop_item' , 'woocommerce_template_loop_add_to_cart', 10 );

if ( !function_exists( 'wbc_template_loop_add_to_cart' ) ) {
	function wbc_template_loop_add_to_cart() {
		global $product;

		$ex_class = ' double-buttons';

		ob_start();
		woocommerce_template_loop_add_to_cart();
		$output = ob_get_clean();

		if ( empty( $output ) ) return;

		if ( !empty( $output ) ) {

			$pos = strpos( $output, ">" );

			if ( $pos !== false ) {
				$output = substr_replace( $output, "><i class=\"fa fa-shopping-cart\"></i> ", $pos , 1 );
			}
		}

		if ( in_array( $product->product_type, array( 'subscription', 'simple' ) ) ) {
			$output .= '<div class="wbc-sep-line"></div>';
			$output .= '<a class="button view-details-btn" href="'.esc_attr( get_permalink( $product->id ) ).'"><i class="fa fa-file-text-o"></i>  '. esc_html__( 'View Details', 'ninezeroseven' ) .'</a>';
		}else {
			$ex_class = ' single-shop-button';
		}

		echo '<div class="wbc-shop-buttons'. esc_attr( $ex_class ) .'">'.$output.'</div>';
	}

	add_action( 'woocommerce_after_shop_loop_item' , 'wbc_template_loop_add_to_cart', 10 );
}

/************************************************************************
* Theme Related Filters
*************************************************************************/

//Fitler to change title in 'breadcrumb' area for Woo Pages.
if ( !function_exists( 'wbc_shop_page_title' ) ) {

	function wbc_shop_page_title( $page_title ) {

		if ( is_woocommerce() ) {

			if ( is_search() ) {
				$page_title = sprintf( __( 'Search Results: &ldquo;%s&rdquo;', 'ninezeroseven' ), get_search_query() );

				if ( get_query_var( 'paged' ) )
					$page_title .= sprintf( __( '&nbsp;&ndash; Page %s', 'ninezeroseven' ), get_query_var( 'paged' ) );

			} elseif ( is_tax() ) {

				$page_title = single_term_title( "", false );

			} elseif ( is_shop() ) {

				$shop_page_id = wc_get_page_id( 'shop' );
				$page_title   = get_the_title( $shop_page_id );

			}

		}



		return $page_title;
	}

	add_filter( 'wbc_bread_crumb_title' , 'wbc_shop_page_title' );
}

// Breadcrumb for shop pages.
if ( !function_exists( 'wbc_shop_bread_crumb' ) ) {
	function wbc_shop_bread_crumb( $bread_crumb_html = '' ) {

		if ( is_woocommerce() ) {
			$args = array(
				'delimiter'   => '',
				'wrap_before' => '<ul class="breadcrumb" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '>',
				'wrap_after'  => '</ul>',
				'before'      => '<li>',
				'after'       => '</li>',
				'home'        => _x( 'Home', 'breadcrumb', 'ninezeroseven' )
			);

			ob_start();
			woocommerce_breadcrumb( $args );

			$output = ob_get_clean();

			if ( $output ) {

				$output = preg_replace( '/\s\s+/', "", $output );
				return $output;

			}

		}

		return $bread_crumb_html;
	}

	add_filter( 'wbc_bread_crumb_html' , 'wbc_shop_bread_crumb' );
}


if ( !function_exists( 'wbc_shop_meta_post_id' ) ) {

	function wbc_shop_meta_post_id( $id = '' ) {

		if ( is_woocommerce() ) {
			if ( is_product() && is_single() ) {
				return get_the_id();
			}elseif ( is_shop() || is_product_category() || is_product_tag() ) {
				return wc_get_page_id( 'shop' );
			}
		}

		return $id;
	}

	if ( is_woocommerce() ) {
		add_filter( 'redux_post_meta_id', 'wbc_shop_meta_post_id' );
	}
	
}


if ( !function_exists( 'wbc_shop_sidebar' ) ) {

	function wbc_shop_sidebar( $sidebar ) {
		if ( is_woocommerce() ) {
			if ( is_shop() || is_product_category() || is_product_tag() || ( is_product() && is_single() ) ) {
				$shop_sidebar = get_post_meta( wc_get_page_id( 'shop' ) , 'opts-single-page-sidebar', true );
				$sidebar = ( $shop_sidebar && !empty( $shop_sidebar ) ) ? $shop_sidebar : $sidebar;
			}
		}

		return $sidebar;
	}
	add_filter( 'wbc907_sidebar_return', 'wbc_shop_sidebar' );
}
?>