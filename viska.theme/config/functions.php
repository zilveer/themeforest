<?php
/**
 * Project of Megadrupal.com
 * Author: duongle
 * Date: 6/16/14
 * Time: 9:43 AM
 */

/* Register Client Post Type */
if ( ! isset( $content_width ) ) $content_width = 900;
function register_client()
{
    $labels = array(
        'name'               => _x( 'Clients', 'post type general name', LANGUAGE ),
        'singular_name'      => _x( 'Client', 'post type singular name', LANGUAGE ),
        'menu_name'          => _x( 'Client', 'admin menu', LANGUAGE ),
        'name_admin_bar'     => _x( 'Client', 'add new on admin bar', LANGUAGE ),
        'add_new'            => _x( 'Add New', 'client', LANGUAGE ),
        'add_new_item'       => __( 'Add New Client', LANGUAGE ),
        'new_item'           => __( 'New Client', LANGUAGE ),
        'edit_item'          => __( 'Edit Client', LANGUAGE ),
        'view_item'          => __( 'View Client', LANGUAGE ),
        'all_items'          => __( 'All Clients', LANGUAGE ),
        'search_items'       => __( 'Search Client', LANGUAGE ),
        'parent_item_colon'  => __( 'Parent Client:', LANGUAGE ),
        'not_found'          => __( 'No Client found.', LANGUAGE ),
        'not_found_in_trash' => __( 'No Clients found in Trash.', LANGUAGE ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'client'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => true,
        'menu_position'      => 9,
        'menu_icon'          => 'dashicons-businessman',
        'supports'           => array('awe_client', 'title',)
    );

    register_post_type( 'awe_client', $args );
}

function register_skill()
{
        $labels = array(
            'name'              => _x( 'Project Skills', 'taxonomy general name',LANGUAGE ),
            'singular_name'     => _x( 'Project Skill', 'taxonomy singular name',LANGUAGE ),
            'search_items'      => __( 'Search Skills',LANGUAGE ),
            'all_items'         => __( 'All Skill',LANGUAGE ),
            'parent_item'       => __( 'Parent Skill',LANGUAGE ),
            'parent_item_colon' => __( 'Parent Skill:',LANGUAGE ),
            'edit_item'         => __( 'Edit Skill',LANGUAGE ),
            'update_item'       => __( 'Update Skill',LANGUAGE ),
            'add_new_item'      => __( 'Add New Skill',LANGUAGE ),
            'new_item_name'     => __( 'New Skill Name',LANGUAGE ),
            'menu_name'         => __( 'Skills',LANGUAGE ),
        );

        register_taxonomy('portfolio_skill',array('awe_portfolio'), array(
            'hierarchical' => false,
            'labels' => $labels,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav'   => false,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'portfolio_skill' ),
        ));
}
add_action( 'init', 'register_client' );
add_action( 'init', 'register_skill' );

post_type_supports( 'awe_aboutus', 'thumbnail' );


/**
 * Display Blog header
 * pirateS
 */
add_action( 'save_post', 'awe_save_blog_header_settings', 10, 2 );
function awe_save_blog_header_settings(  $post_id, $post )
{
    if ( 'page' != $post->post_type ) {
        return;
    }


    if ( isset( $_REQUEST['awe_display_block_header'] ) ) {
        update_post_meta( $post_id, '_awe_display_block_header', sanitize_text_field( $_REQUEST['awe_display_block_header'] ) );
    }
}

function awe_display_blog_header() {
    add_meta_box(
        'awe_display_blog_header',
        __( 'Enable Blog Header', LANGUAGE ),
        'awe_display_blog_header_settings',
        'page',
        'side'
    );
  
}
add_action( 'add_meta_boxes', 'awe_display_blog_header' );

function awe_display_blog_header_settings($post)
{
    $selected = get_post_meta($post->ID, "_awe_display_block_header", true);
    $selected = $selected ? $selected : 1;
    ?>
    <select name="awe_display_block_header" id="">
        <option value="1" <?php selected($selected, 1) ?>>Enable</option>
        <option  value="2" <?php selected($selected, 2) ?>>Disable</option>
    </select>
    <?php 
}

add_filter('awe_is_blog_header', 'awe_is_blog_header', 10, 1);
function awe_is_blog_header($post_id)
{
    $selected = get_post_meta($post_id, "_awe_display_block_header", true);

    if ( $selected == 2)
    {
        return false;
    }

    return true;
}

?>