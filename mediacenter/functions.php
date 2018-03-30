<?php
/**
 * MediaCenter engine room
 *
 * @package mediacenter
 */

/**
 * Initialize all things
 */
require get_template_directory() . '/inc/init.php';

/**
 * Note: Do not add any custom code here. Please use a child theme so that your customizations aren't lost during updates.
 * http://codex.wordpress.org/Child_Themes
 */

define( 'MC_TEMPLATE_PATH', get_template_directory() );

#-----------------------------------------------------------------
# Includes
#-----------------------------------------------------------------

// Pagination function
include_once get_template_directory() . '/framework/inc/pagination.php';

//WP Alchemy
if( ! class_exists( 'WPAlchemy_MetaBox' ) ) {
	include_once get_template_directory() . '/framework/inc/wpalchemy/MetaBox-mod.php';	
}

if( ! class_exists( 'WPAlchemy_MediaAccess' ) ) {
	include_once get_template_directory() . '/framework/inc/wpalchemy/MediaAccess-mod.php';
}

$wpalchemy_media_access = new WPAlchemy_MediaAccess();

//Include metaboxes
include_once get_template_directory() . '/framework/metaboxes/mc-page-spec.php';

//Include Post Formats
include_once get_template_directory() . '/framework/inc/post-formats/load.php';

function register_mc_widgets() { 
	if ( class_exists( 'WC_Widget' ) ) {
		get_template_part( 'framework/widgets/class-mc-widget-brands-filter');
		get_template_part( 'framework/widgets/class-mc-widget-vertical-menu');
	}
	if ( class_exists( 'StaticBlockContent' ) && class_exists( 'WC_Widget' ) ) {
		get_template_part( 'framework/widgets/class-mc-static-block-widget');
	}
	get_template_part( 'framework/widgets/class-mc-widget', 'recent-posts' );
}

add_action( 'widgets_init', 'register_mc_widgets', 15 );

#-----------------------------------------------------------------
# Rev Slider Setup
#-----------------------------------------------------------------

if( function_exists( 'set_revslider_as_theme' ) ){
	set_revslider_as_theme();
}

#-----------------------------------------------------------------
# AJAX URL
#-----------------------------------------------------------------

add_action('wp_head','media_center_ajaxurl');
function media_center_ajaxurl() {
?>
    <script type="text/javascript">
        var media_center_ajaxurl = '<?php echo admin_url('admin-ajax.php', 'relative'); ?>';
    </script>
<?php
}

#-----------------------------------------------------------------
# Media Center Theme Setup
#-----------------------------------------------------------------

function iframe_the_content_filter( $content ){
	$content = str_replace( '<iframe', '<div class="embed-responsive embed-responsive-16by9"><iframe', $content );
	$content = str_replace( '</iframe>', '</iframe></div>', $content );
	return $content;
}

add_filter( 'the_content', 'iframe_the_content_filter' );

#-----------------------------------------------------------------
# WooCommerce Template Settings
#-----------------------------------------------------------------

require_once get_template_directory() . '/framework/inc/woocommerce-template-functions.php';

#-----------------------------------------------------------------
# Media Center Blog Functions
#-----------------------------------------------------------------

require_once get_template_directory() . '/framework/inc/mediacenter-blog-functions.php';

#-----------------------------------------------------------------
# Header
#-----------------------------------------------------------------

// Displays part of the header

function media_center_display_header_part ( $part ){
	get_template_part( 'framework/templates/header/' . $part );
}


// Check to hide title

function media_center_should_hide_title() {
	global $mc_page_metabox;
	
	$postID = get_the_ID(); $cart_page_ID = get_option( 'woocommerce_cart_page_id' );

	return ( $mc_page_metabox->get_the_value( 'hide_title' ) === '1' ) || ( $cart_page_ID == $postID );
}

#-----------------------------------------------------------------
# The Breadcrumb
#-----------------------------------------------------------------
if( ! function_exists( 'media_center_get_category_parents' ) ) :
function media_center_get_category_parents( $id, $link = false, $separator = '/', $nicename = false, $visited = array() ) {
	$category_parents = get_category_parents( $id, $link, $separator, $nicename, $visited );
	if( is_wp_error( $category_parents ) ) {
		$category_parents = '';
	} else {
		$category_parents = str_replace( '</a>', '</a></li>', str_replace( '<a', '<li><a', $category_parents ) );
	}
	return $category_parents;
}
endif;

if( ! function_exists( 'media_center_blog_link' ) ) :
function media_center_blog_link() {
	$blog_page_link = '';
	if ( get_option( 'show_on_front' ) == 'page' ){
		$blog_page_ID = get_option( 'page_for_posts' );
		$page = get_page( $blog_page_ID );
		$blog_page_link = '<a href="' . get_permalink( $blog_page_ID ) . '">' . $page->post_title . '</a>';
	}
	return $blog_page_link;
}
endif;


get_template_part( 'framework/inc/mediacenter-breadcrumb' );

#-----------------------------------------------------------------
# Navigation
#-----------------------------------------------------------------

// Top Bar Left Nav Menu
if( ! function_exists( 'media_center_top_left_nav_menu' ) ) :
function media_center_top_left_nav_menu(){

	$enable_language_switcher = apply_filters( 'mc_is_top_bar_left_language_switcher', false );
	$enable_currency_switcher = apply_filters( 'mc_is_top_bar_left_currency_switcher', false );
	
	$top_left_menu 		= '';
	$languages_menu 	= '';
	$currencies_menu 	= '';

	if( is_wpml_activated() ) {
		$languages_menu 	= $enable_language_switcher ? media_center_get_languages_menu() : '';
		$currencies_menu 	= $enable_currency_switcher ? media_center_get_currencies_menu() : '';
	}

	if ( has_nav_menu ( 'top-left' ) ) {
		$top_left_menu .= wp_nav_menu( 
            array(
				'menu' 			    => 'top-left',
				'theme_location' 	=> 'top-left',
				'depth' 			=> 2,
				'container' 		=> false,
				'menu_class' 		=> 'top-left',
				'echo' 			    => 0 ,
				'walker' 			=> new wp_bootstrap_navwalker(),
				'items_wrap' 		=> '%3$s',
            )
        );
	} else {
		$pages = get_pages( array( 'parent' => 0, 'number' => '5', ) );
		foreach ( $pages as $page ){
			$top_left_menu .= '<li><a href="' . get_permalink( $page->ID ) .'">' . $page->post_title . '</a></li>';
		}
	}

	$top_left_menu = '<ul id="menu-top-left" class="top-left">' . $top_left_menu . $languages_menu . $currencies_menu . '</ul>';

	return $top_left_menu ;
}
endif;

// Top Bar Right Nav Menu
if( ! function_exists( 'media_center_top_right_nav_menu' ) ) :
function media_center_top_right_nav_menu(){

	$enable_language_switcher = apply_filters( 'mc_is_top_bar_right_language_switcher', false );
	$enable_currency_switcher = apply_filters( 'mc_is_top_bar_right_currency_switcher', false );
	
	$top_right_menu 	= '';
	$languages_menu 	= '';
	$currencies_menu 	= '';

	if( is_wpml_activated() ) {
		$languages_menu 	= $enable_language_switcher ? media_center_get_languages_menu() : '';
		$currencies_menu 	= $enable_currency_switcher ? media_center_get_currencies_menu() : '';
	}

	if ( has_nav_menu ( 'top-right' ) ) {
		
		$top_right_menu .= wp_nav_menu( 
            array(
				'menu' 			    => 'top-right',
				'theme_location' 	=> 'top-right',
				'depth' 			=> 2,
				'container' 		=> false,
				'menu_class' 		=> 'right top-right',
				'echo' 			    => 0 ,
				'walker' 			=> new wp_bootstrap_navwalker(),
				'items_wrap' 		=> '%3$s',
            )
        );
	} else {
		$top_right_menu .= media_center_woocommerce_pages( true, '', '') ;
	}

	$top_right_menu = '<ul class="right top-right">' . $languages_menu . $currencies_menu . $top_right_menu . '</ul>';

	return $top_right_menu ;
}
endif;

// Primary Navigation
if( ! function_exists( 'media_center_primary_nav_menu' ) ) :
function media_center_primary_nav_menu(){
	$primary_nav_menu = '';

	if ( has_nav_menu( 'primary' ) ) {

        $primary_nav_menu .= wp_nav_menu( 
            array(
                'menu' 				=> 'primary',
                'theme_location' 	=> 'primary',
                'depth' 			=> 0,
                'container' 		=> false,
                'menu_class' 		=> 'navbar-nav nav',
                'echo' 				=> 0,
                'walker' 			=> new wp_bootstrap_navwalker()
            )
        );

    } else {
        $primary_nav_menu .= '<ul class="navbar-nav nav">';
        $primary_nav_menu .=  wp_list_categories(
            array(
                'title_li'     => '', 
                'hide_empty'   => 1 , 
                'taxonomy'     => 'product_cat',
                'hierarchical' => 1 ,
                'echo'         => 0 ,
                'depth'        => 1 ,
            )
        );
        $primary_nav_menu .= '</ul>';
    }

    return $primary_nav_menu;
}
endif;

// Departments Navigation
if( ! function_exists( 'media_center_department_nav_menu' ) ) :
function media_center_department_nav_menu(){
	$department_nav_menu = '';

	if ( has_nav_menu( 'departments' ) ) {

        $department_nav_menu .= wp_nav_menu( 
            array(
                'menu' 				=> 'departments',
                'theme_location' 	=> 'departments',
                'depth' 			=> 0,
                'container' 		=> false,
                'menu_class' 		=> 'dropdown-menu',
                'echo' 				=> 0,
                'walker' 			=> new wp_bootstrap_navwalker()
            )
        );

    } else {
        $department_nav_menu .= '<ul class="dropdown-menu">';
        $department_nav_menu .=  wp_list_categories(
			array(
				'title_li'		=> '', 
				'hide_empty'	=> 1 , 
				'taxonomy'		=> 'product_cat',
				'depth'			=> 2 ,
				'echo'			=> 0 ,
				'walker'		=> new wp_bootstrap_categorieswalker(),
				'dropdown_class'	=> 'submenu',
			)
		);
        $department_nav_menu .= '</ul>';
    }

    return $department_nav_menu;
}
endif;

if( ! function_exists( 'media_center_filter_products_query' ) ) :
function media_center_filter_products_query( $args, $atts ){
	global $woocommerce_loop;

	if( isset($atts['product_item_size']) ){
		$woocommerce_loop['product_item_size'] = $atts['product_item_size'];
		$woocommerce_loop['screen_width'] = 100;
	}

	return $args;
}
endif;

add_filter( 'woocommerce_shortcode_products_query', 'media_center_filter_products_query', 10, 2 );

if( ! function_exists( 'woocommerce_products_live_search' ) ) :
function woocommerce_products_live_search(){
	if ( isset( $_REQUEST['fn'] ) && 'get_ajax_search' == $_REQUEST['fn'] ) {

		$query_args = array(
			'posts_per_page' 	=> 10,
			'no_found_rows' 	=> true,
			'post_type'			=> 'product',
			'post_status'		=> 'publish',
			'meta_query'		=> array(
				array(
					'key' 		=> '_visibility',
					'value' 	=> array( 'search', 'visible' ),
					'compare' 	=> 'IN'
				)
			)
		);

		if( isset( $_REQUEST['terms'] ) ) {
			$query_args['s'] = $_REQUEST['terms'];
		}

        $search_query = new WP_Query( $query_args );
 
        $results = array();
        if ( $search_query->get_posts() ) {
            foreach ( $search_query->get_posts() as $the_post ) {
                $title = get_the_title( $the_post->ID );
                if ( has_post_thumbnail( $the_post->ID ) ) {
					$post_thumbnail_ID = get_post_thumbnail_id( $the_post->ID );
					$post_thumbnail_src = wp_get_attachment_image_src( $post_thumbnail_ID, 'thumbnail' );
				}else{
					$dimensions = wc_get_image_size( 'thumbnail' );
					$post_thumbnail_src = array(
						wc_placeholder_img_src(),
						esc_attr( $dimensions['width'] ),
						esc_attr( $dimensions['height'] )
					);
				}

				$product = new WC_Product( $the_post->ID );
				$price = $product->get_price_html();
				$brand = woocommerce_show_brand( $the_post->ID, true );
				$title = html_entity_decode( $title , ENT_QUOTES, 'UTF-8' );
                
                $results[] = array(
                    'value' 	=> $title,
                    'url' 		=> get_permalink( $the_post->ID ),
                    'tokens' 	=> explode( ' ', $title ),
                    'image' 	=> $post_thumbnail_src[0],
                    'price'		=> $price,
                    'brand'		=> $brand,
                    'id'		=> $the_post->ID
                );
            }
        }
 
        wp_reset_postdata();
        echo json_encode( $results );
    }
    die();
}
endif;

add_action( 'wp_ajax_nopriv_products_live_search', 'woocommerce_products_live_search' );
add_action( 'wp_ajax_products_live_search', 'woocommerce_products_live_search' );