<?php
require_once ADMIN_DIR . 'quick-uploader.php';

function oxy_create_logo_css() {
    // check if we using a logo
    $css = '';
    $header_height = oxy_get_option( 'header_height' );
    switch( oxy_get_option('logo_type') ) {
        case 'image':
            $img_id = oxy_get_option( 'logo_image' );
            $img = wp_get_attachment_image_src( $img_id, 'full' );
            $logo_width = $img[1];
            $logo_height = $img[2];
            $retina = '';
            // check for retina logo
            if( 'on' == oxy_get_option( 'logo_retina' ) ) {
                // set brand logo to be half width & height
                $retina .= 'width:' . ($logo_width / 2) . 'px;height:' . ($logo_height / 2 )  . 'px;';
                // use half logo height to calculate header size
                $logo_height = $logo_height / 2;
            }
            $css = oxy_create_header_css( $header_height, $logo_height, $retina );
        break;
        case 'text':
            $css = oxy_create_header_css( $header_height, 36 );
        break;
    }
    update_option( THEME_SHORT . '-header-css', $css );
}
add_action( 'oxy-options-updated-' . THEME_SHORT . '-general', 'oxy_create_logo_css' );

function oxy_create_header_css( $header_height, $brand_height, $retina = '' ) {
    $min_height     = $header_height.'px';
    $brand_padding  = ( ($header_height - $brand_height ) / 2).'px';
    $navbar_padding = ( ( $header_height -24 ) /2 ).'px';
    $navbar_margin  = ( $header_height / 2 - 14).'px';
    return <<< CSS
#masthead .navbar-inner {
min-height: $min_height;
}
#masthead .brand {
padding-top: $brand_padding;
padding-bottom: $brand_padding;
$retina
}

.navbar .nav > li > a {
padding-top: $navbar_padding;
padding-bottom: $navbar_padding;
}
navbar .btn, .navbar .btn-group {
margin-top: $navbar_margin;
}
CSS;
}

function oxy_update_permalinks() {
    //Ensure the $wp_rewrite global is loaded
    global $wp_rewrite;
    //Call flush_rules() as a method of the $wp_rewrite object
    $wp_rewrite->flush_rules();
}
add_action( 'oxy-options-updated-' . THEME_SHORT . '-permalinks', 'oxy_update_permalinks' );


// add custom type columns
function oxy_slideshow_edit_columns($columns) {
    $columns = array(
        'cb'          => '<input type="checkbox" />',
        'title'       => __('Image Title', THEME_ADMIN_TD),
        'slide-thumb' => __('Image', THEME_ADMIN_TD),
        'menu_order'  => __('Order', THEME_ADMIN_TD),
        'slideshows'  => __('Slideshows', THEME_ADMIN_TD),
    );
    return $columns;
}
add_filter('manage_edit-oxy_slideshow_image_columns', 'oxy_slideshow_edit_columns' );

function oxy_custom_slideshow_column($column) {
    global $post;
    switch( $column ) {
        case 'menu_order':
            echo $post->menu_order;
        break;
        case 'slide-thumb':
            $editlink = get_edit_post_link( $post->ID );
            echo '<a href="' . $editlink . '">' . get_the_post_thumbnail( $post->ID, 'thumbnail' ) . '</a>';
        break;

        case 'slideshows':
            echo get_the_term_list( $post->ID, 'oxy_slideshow_categories', '', ', ' );
        break;

        default:
            // do nothing
        break;
    }
}
add_action('manage_oxy_slideshow_image_posts_custom_column', 'oxy_custom_slideshow_column' );

// add sortable
function oxy_slideshow_sortable_columns( $columns ) {
    $columns['menu_order'] = 'menu_order';
    return $columns;
}
add_filter( 'manage_edit-oxy_slideshow_image_sortable_columns', 'oxy_slideshow_sortable_columns' );

/* Portfolio columns */

function oxy_portfolio_edit_columns($columns) {
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => __('Image Title', THEME_ADMIN_TD),
        'port-thumb' => __('Image', THEME_ADMIN_TD),
        'menu_order' => __('Order', THEME_ADMIN_TD),
        'category' => __('Categories', THEME_ADMIN_TD),
    );
    return $columns;
}
add_action('manage_edit-oxy_portfolio_image_columns', 'oxy_portfolio_edit_columns' );

function oxy_custom_portfolio_column($column) {
    global $post;
    switch( $column ) {
        case 'menu_order':
            echo $post->menu_order;
        break;

        case 'port-thumb':
            $editlink = get_edit_post_link( $post->ID );
            echo '<a href="' . $editlink . '">' . get_the_post_thumbnail( $post->ID, 'thumbnail' ) . '</a>';
        break;

        case 'category':
            echo get_the_term_list( $post->ID, 'oxy_portfolio_categories', '', ', ' );
        break;

        default:
            // do nothing
        break;
    }
}
add_action( 'manage_oxy_portfolio_image_posts_custom_column' , 'oxy_custom_portfolio_column', 10, 2 );

// add sortable
function oxy_portfolio_sortable_columns( $columns ) {
    $columns['menu_order'] = 'menu_order';
    return $columns;
}
add_filter( 'manage_edit-oxy_portfolio_image_sortable_columns', 'oxy_portfolio_sortable_columns' );

function oxy_service_edit_columns($columns) {
    $columns = array(
        'cb'          => '<input type="checkbox" />',
        'title' => __('Service Title', THEME_ADMIN_TD),
        'menu_order'  => __('Order', THEME_ADMIN_TD),
        'service_categories' => __('Categories', THEME_ADMIN_TD)
    );
    return $columns;
}
add_filter('manage_edit-oxy_service_columns', 'oxy_service_edit_columns' );

function oxy_custom_service_column($column) {
    global $post;
    switch( $column ) {
        case 'menu_order':
            echo $post->menu_order;
        break;
        case 'service_categories':
            echo get_the_term_list( $post->ID, 'oxy_service_category', '', ', ' );
        break;
        default:
            // do nothing
        break;
    }
}
add_action('manage_oxy_service_posts_custom_column', 'oxy_custom_service_column' );

/**
 * Do anything we need when a new version is created
 *
 * @return void
 * @author
 **/
function oxy_version_init() {
    $current_version = get_option( THEME_SHORT . '_version' );
    if( $current_version === false ) {
        update_option( THEME_SHORT . '_version', '1.5.8' );
    }
}
add_action( 'init', 'oxy_version_init' );