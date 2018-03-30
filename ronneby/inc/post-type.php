<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
function my_custom_post_product() {
	global $dfd_ronneby;
	
    $labels = array(
        'name'               => __( 'Portfolios' , 'dfd' ),
        'singular_name'      => __( 'Portfolio' , 'dfd' ),
        'add_new'            => __( 'Add New' , 'dfd' ),
        'add_new_item'       => __( 'Add New Portfolio item' , 'dfd' ),
        'edit_item'          => __( 'Edit Portfolio item' , 'dfd' ),
        'new_item'           => __( 'New Portfolio item' , 'dfd' ),
        'all_items'          => __( 'All Portfolio items' , 'dfd' ),
        'view_item'          => __( 'View Portfolio item' , 'dfd' ),
        'search_items'       => __( 'Search Portfolios item' , 'dfd' ),
        'not_found'          => __( 'No products found' , 'dfd' ),
        'not_found_in_trash' => __( 'No products found in the Trash' , 'dfd' ),
        'parent_item_colon'  => '',
        'menu_name'          => 'Portfolios'
    );
    $args = array(
        'labels'        => $labels,
        'description'   => 'Holds our products and product specific data',
        'public'        => true,
        'supports'      => array( 'title', 'editor', 'author', 'thumbnail', 'sticky', 'comments', ),
        'has_archive'   => true,
        'menu_icon'		=> '',
        //'taxonomies'    => array('post_tag')
    );
	
	if(isset($dfd_ronneby['portfolio_url_slug']) && !empty($dfd_ronneby['portfolio_url_slug']))
		$args['rewrite'] = array('slug' => $dfd_ronneby['portfolio_url_slug']);
		
    register_post_type( 'my-product', $args );
}
add_action( 'init', 'my_custom_post_product' );

function my_updated_messages( $messages ) {
    global $post, $post_ID;
    $messages['my-product'] = array(
        0 => '',
        1 => sprintf( __('Portfolio updated. <a href="%s">View product</a>', 'dfd'), esc_url( get_permalink($post_ID) ) ),
        2 => __('Custom field updated.', 'dfd'),
        3 => __('Custom field deleted.', 'dfd'),
        4 => __('Portfolio updated.', 'dfd'),
        5 => isset($_GET['revision']) ? sprintf( __('Portfolio restored to revision from %s', 'dfd'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6 => sprintf( __('Portfolio published. <a href="%s">View product</a>', 'dfd'), esc_url( get_permalink($post_ID) ) ),
        7 => __('Portfolio saved.', 'dfd'),
        8 => sprintf( __('Portfolio submitted. <a target="_blank" href="%s">Preview product</a>', 'dfd'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
        9 => sprintf( __('Portfolio scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview product</a>', 'dfd'), date_i18n( __( 'M j, Y @ G:i', 'dfd' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
        10 => sprintf( __('Portfolio draft updated. <a target="_blank" href="%s">Preview product</a>', 'dfd'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    );
    return $messages;
}
add_filter( 'post_updated_messages', 'my_updated_messages' );

function my_contextual_help( $contextual_help, $screen_id, $screen ) {
    if ( 'my-product' == $screen->id ) {

        $contextual_help = '<h2>Portfolios</h2>
		<p>Portfolios show the details of the items that we sell on the website. You can see a list of them on this page in reverse chronological order - the latest one we added is first.</p>
		<p>You can view/edit the details of each product by clicking on its name, or you can perform bulk actions using the dropdown menu and selecting multiple items.</p>';

    } elseif ( 'edit-product' == $screen->id ) {

        $contextual_help = '<h2>Editing products</h2>
		<p>This page allows you to view/modify product details. Please make sure to fill out the available boxes with the appropriate details (product image, price, brand) and <strong>not</strong> add these details to the product description.</p>';

    }
    return $contextual_help;
}
add_action( 'contextual_help', 'my_contextual_help', 10, 3 );

function my_taxonomies_product() {
	global $dfd_ronneby;
	
    $labels = array(
        'name'              => __( 'Portfolio Categories', 'dfd' ),
        'singular_name'     => __( 'Portfolio Category', 'dfd' ),
        'search_items'      => __( 'Search Portfolio Categories', 'dfd' ),
        'all_items'         => __( 'All Portfolio Categories', 'dfd' ),
        'parent_item'       => __( 'Parent Portfolio Category', 'dfd' ),
        'parent_item_colon' => __( 'Parent Portfolio Category:', 'dfd' ),
        'edit_item'         => __( 'Edit Portfolio Category', 'dfd' ),
        'update_item'       => __( 'Update Portfolio Category', 'dfd' ),
        'add_new_item'      => __( 'Add New Portfolio Category', 'dfd' ),
        'new_item_name'     => __( 'New Portfolio Category', 'dfd' ),
        'menu_name'         => __( 'Portfolio Categories', 'dfd' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,

    );
	if(isset($dfd_ronneby['portfolio_url_slug']) && !empty($dfd_ronneby['portfolio_url_slug']))
		$args['rewrite'] = array('slug' => $dfd_ronneby['portfolio_url_slug'].'-category');
	
    register_taxonomy( 'my-product_category', 'my-product', $args );
}
add_action( 'init', 'my_taxonomies_product', 0 );

function dfd_portfolio_tags() {
    $labels = array(
        'name'              => __( 'Portfolio Tags', 'dfd' ),
        'singular_name'     => __( 'Portfolio Tag', 'dfd' ),
        'search_items'      => __( 'Search Portfolio Tags', 'dfd' ),
        'all_items'         => __( 'All Portfolio Tags', 'dfd' ),
        'parent_item'       => __( 'Parent Portfolio Tag', 'dfd' ),
        'parent_item_colon' => __( 'Parent Portfolio Tag:', 'dfd' ),
        'edit_item'         => __( 'Edit Portfolio Tag', 'dfd' ),
        'update_item'       => __( 'Update Portfolio Tag', 'dfd' ),
        'add_new_item'      => __( 'Add New Portfolio Tag', 'dfd' ),
        'new_item_name'     => __( 'New Portfolio Tag', 'dfd' ),
        'menu_name'         => __( 'Portfolio Tags', 'dfd' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,

    );
    register_taxonomy( 'my-product_tags', 'my-product', $args );
}
add_action( 'init', 'dfd_portfolio_tags', 0 );

function dfd_register_taxonomy_for_object_type() {
    register_taxonomy_for_object_type( 'post_tag', 'my_product' );
}
add_action( 'init', 'dfd_register_taxonomy_for_object_type' );

function gallery_post_type() {
    $labels = array(
        'name'               => __( 'Galleries' , 'dfd' ),
        'singular_name'      => __( 'Gallery' , 'dfd' ),
        'add_new'            => __( 'Add New' , 'dfd' ),
        'add_new_item'       => __( 'Add New Gallery item' , 'dfd' ),
        'edit_item'          => __( 'Edit Gallery item' , 'dfd' ),
        'new_item'           => __( 'New Gallery item' , 'dfd' ),
        'all_items'          => __( 'All Gallery items' , 'dfd' ),
        'view_item'          => __( 'View Gallery item' , 'dfd' ),
        'search_items'       => __( 'Search Galleries item' , 'dfd' ),
        'not_found'          => __( 'No Galleries found' , 'dfd' ),
        'not_found_in_trash' => __( 'No Galleries found in the Trash' , 'dfd' ),
        'parent_item_colon'  => '',
        'menu_name'          => 'Galleries'
    );
    $args = array(
        'labels'        => $labels,
        'description'   => 'Holds our products and product specific data',
        'public'        => true,
        'supports'      => array( 'title', 'author', 'thumbnail', 'tags', 'sticky', 'comments' ),
        'has_archive'   => true,
        'menu_icon'		=> '',
        'taxonomies'    => array('post_tag')
    );
    register_post_type( 'gallery', $args );
}
add_action( 'init', 'gallery_post_type' );

function gallery_updated_messages( $messages ) {
    global $post, $post_ID;
    $messages['gallery'] = array(
        0 => '',
        1 => sprintf( __('Gallery updated. <a href="%s">View gallery</a>', 'dfd'), esc_url( get_permalink($post_ID) ) ),
        2 => __('Custom field updated.', 'dfd'),
        3 => __('Custom field deleted.', 'dfd'),
        4 => __('Gallery updated.', 'dfd'),
        5 => isset($_GET['revision']) ? sprintf( __('Gallery restored to revision from %s', 'dfd'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6 => sprintf( __('Gallery published. <a href="%s">View gallery</a>', 'dfd'), esc_url( get_permalink($post_ID) ) ),
        7 => __('Gallery saved.', 'dfd'),
        8 => sprintf( __('Gallery submitted. <a target="_blank" href="%s">Preview gallery</a>', 'dfd'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
        9 => sprintf( __('Gallery scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview gallery</a>', 'dfd'), date_i18n( __( 'M j, Y @ G:i', 'dfd' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
        10 => sprintf( __('Gallery draft updated. <a target="_blank" href="%s">Preview gallery</a>', 'dfd'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    );
    return $messages;
}
add_filter( 'post_updated_messages', 'gallery_updated_messages' );

function gallery_contextual_help( $contextual_help, $screen_id, $screen ) {
    if ( 'gallery' == $screen->id ) {

        $contextual_help = '<h2>Galleries</h2>
		<p>Galleries show the details of the items that we sell on the website. You can see a list of them on this page in reverse chronological order - the latest one we added is first.</p>
		<p>You can view/edit the details of each gallery by clicking on its name, or you can perform bulk actions using the dropdown menu and selecting multiple items.</p>';

    } elseif ( 'edit-gallery' == $screen->id ) {

        $contextual_help = '<h2>Editing galleries</h2>
		<p>This page allows you to view/modify product details. Please make sure to fill out the available boxes with the appropriate details (product image, price, brand) and <strong>not</strong> add these details to the product description.</p>';

    }
    return $contextual_help;
}
add_action( 'contextual_help', 'gallery_contextual_help', 10, 3 );

function gallery_taxonomies() {
    $labels = array(
        'name'              => __( 'Gallery Categories', 'dfd' ),
        'singular_name'     => __( 'Gallery Category', 'dfd' ),
        'search_items'      => __( 'Search Gallery Categories', 'dfd' ),
        'all_items'         => __( 'All Gallery Categories', 'dfd' ),
        'parent_item'       => __( 'Parent Gallery Category', 'dfd' ),
        'parent_item_colon' => __( 'Parent Gallery Category:', 'dfd' ),
        'edit_item'         => __( 'Edit Gallery Category', 'dfd' ),
        'update_item'       => __( 'Update Gallery Category', 'dfd' ),
        'add_new_item'      => __( 'Add New Gallery Category', 'dfd' ),
        'new_item_name'     => __( 'New Gallery Category', 'dfd' ),
        'menu_name'         => __( 'Gallery Categories', 'dfd' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,

    );
    register_taxonomy( 'gallery_category', 'gallery', $args );
}
add_action( 'init', 'gallery_taxonomies', 0 );

/*Testimonials*/
function my_custom_post_author() {
    $labels = array(
        'name'               => __( 'Autors' , 'dfd' ),
        'singular_name'      => __( 'Author' , 'dfd' ),
        'add_new'            => __( 'Add New' , 'dfd' ),
        'add_new_item'       => __( 'Add New author' , 'dfd' ),
        'edit_item'          => __( 'Edit author' , 'dfd' ),
        'new_item'           => __( 'New author' , 'dfd' ),
        'all_items'          => __( 'All authors' , 'dfd' ),
        'view_item'          => __( 'View author' , 'dfd' ),
        'search_items'       => __( 'Search author' , 'dfd' ),
        'not_found'          => __( 'No items found' , 'dfd' ),
        'not_found_in_trash' => __( 'No items found in the Trash' , 'dfd' ),
        'parent_item_colon'  => '',
        'menu_name'			 => 'Author'
    );
    $args = array(
        'labels'        => $labels,
        'description'   => 'Holds author information that can be used in Author widget. Visual builder modules are not allowed here.',
        'public'        => true,
        'supports'      => array( 'title', 'editor', 'thumbnail', ),
        'has_archive'   => false,
        'menu_icon' => '',
		'rewrite' => array('slug' => 'dfd-author'),
        //'taxonomies'    => array('post_tag')
    );
    register_post_type( 'dfd-author', $args );
}
add_action( 'init', 'my_custom_post_author' );

function my_updated_messages_author( $messages ) {
    global $post, $post_ID;
    $messages['dfd-author'] = array(
        0 => '',
        1 => sprintf( __('Author info updated. <a href="%s">View author</a>', 'dfd'), esc_url( get_permalink($post_ID) ) ),
        2 => __('Custom field updated.', 'dfd'),
        3 => __('Custom field deleted.', 'dfd'),
        4 => __('Author updated.', 'dfd'),
        5 => isset($_GET['revision']) ? sprintf( __('Author restored to revision from %s', 'dfd'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6 => sprintf( __('Author published. <a href="%s">View author</a>', 'dfd'), esc_url( get_permalink($post_ID) ) ),
        7 => __('Author saved.', 'dfd'),
        8 => sprintf( __('Author submitted. <a target="_blank" href="%s">Preview author</a>', 'dfd'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
        9 => sprintf( __('Author scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview author</a>', 'dfd'), date_i18n( __( 'M j, Y @ G:i', 'dfd' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
        10 => sprintf( __('Author draft updated. <a target="_blank" href="%s">Preview Author</a>', 'dfd'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    );
    return $messages;
}
add_filter( 'post_updated_messages', 'my_updated_messages_author' );

function my_contextual_help_author( $contextual_help, $screen_id, $screen ) {
    if ( 'dfd-author' == $screen->id ) {

        $contextual_help = '<h2>Authors</h2>
		<p>Author taxonomy is used to display author widget in widgets section, You can see a list of them on this page in reverse chronological order - the latest one we added is first.</p>
		<p>You can view/edit the details of each author by clicking on its name, or you can perform bulk actions using the dropdown menu and selecting multiple items.</p>';

    } elseif ( 'edit-presentation' == $screen->id ) {

        $contextual_help = '<h2>Editing authors</h2>
		<p>This page allows you to view/modify author details. Please make sure to fill out the available boxes with the appropriate details and <strong>not</strong> add these details to the product description.</p>';

    }
    return $contextual_help;
}
add_action( 'contextual_help', 'my_contextual_help_author', 10, 3 );