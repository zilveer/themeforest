<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 */
add_filter ( 'rwmb_meta_boxes', 'mango_register_meta_boxes' );
/**
 * Register meta boxes
 * @return void
 */
function mango_register_meta_boxes ( $meta_boxes ) {
    /**
     * prefix of meta keys (optional)
     * Use underscore (_) at the beginning to make keys hidden
     * Alt.: You also can make prefix empty to disable it
     */
    // Better has an underscore as last sign
    $prefix = 'mango_';
    $mango_sidebar_nosidebar = array ();
    $mango_sidebar = array ();
    $mango_sidebar_nosidebar[ '' ] = "No Sidebar";
    global $post;
    $post_id = ( isset( $_GET[ 'post' ] ) && $_GET[ 'post' ] ) ? $_GET[ 'post' ] : '';
    $post_id = ( isset( $_REQUEST[ 'post' ] ) && $_REQUEST[ 'post' ] ) ? $_REQUEST[ 'post' ] : '';
    //if(isset($_GET['post'])||isset($_POST['post_ID'])):
    //	$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
    //endif;
    $template_file = get_post_meta ( $post_id, '_wp_page_template', TRUE );
    $categories = get_terms ( 'portfolio-category', 'orderby=count&hide_empty=0' );
    $mango_portfolio_categories[ 'all' ] = __ ( 'All Categories', 'mango' );
    if ( $categories && !is_wp_error ( $categories ) ) {
        foreach ( $categories as $category ) {
            $mango_portfolio_categories[ $category->name ] =  $category->name;
        }
    }
    foreach ( $mango_portfolio_categories as $key => $value ) {
        if ( $key == 'uncategorized' ) continue;
        $mango_portfolio_default[ ] = $key;
    }
    $wp_registered_sidebars = wp_get_sidebars_widgets ();
    foreach ( $wp_registered_sidebars as $sidebar => $sidebar_info ) {
        if ( $sidebar == 'wp_inactive_widgets' ) continue;
        $mango_sidebar[ $sidebar ] = ucwords ( str_replace ( array ( '_', '-' ), ' ', $sidebar ) );
        $mango_sidebar_nosidebar[ $sidebar ] = ucwords ( str_replace ( array ( '_', '-' ), ' ', $sidebar ) );
    }
// Page
    require_once ( mango_functions.'/metaboxes/meta-page.php' );
// Portfolio
   require_once(mango_functions.'/metaboxes/meta-portfolio.php');
// Post
    require_once ( mango_functions.'/metaboxes/meta-post.php' );
// Client
    require_once( mango_functions.'/metaboxes/meta-clients.php');
// testimonials
    require_once( mango_functions.'/metaboxes/meta-testimonial.php');
// Faqs
    require_once(mango_functions.'/metaboxes/meta-faqs.php');
// Product
    require_once(mango_functions.'/metaboxes/meta-product.php');
    //general
    require_once ( mango_functions.'/metaboxes/meta-general.php' );
    //meta popup
    require_once ( mango_functions.'/metaboxes/meta-popup.php' );
	require_once ( mango_functions.'/metaboxes/meta-members.php' );
    return $meta_boxes;
}