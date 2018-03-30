<?php
add_action('init', 'slide_type');
add_action('admin_menu', 'slide_settings');
add_action('save_post', 'slide_settings_save');
add_filter('manage_edit-slide_columns', 'add_new_slide_columns');
add_action('manage_slide_posts_custom_column', 'manage_slide_columns', 10, 2);
function slide_type() {
    $imagepath = get_stylesheet_directory_uri() . '/images/posticon/';
    $labels    = array(
        'name' => __('Slides', 'clubber'),
        'singular_name' => __('Slide', 'clubber'),
        'add_new' => __('Add New', 'clubber'),
        'add_new_item' => __('Add New Slide', 'clubber'),
        'edit' => __('Edit', 'clubber'),
        'edit_item' => __('Edit Slide', 'clubber'),
        'new_item' => __('New Slide', 'clubber'),
        'view' => __('View Slide', 'clubber'),
        'view_item' => __('View Slide', 'clubber'),
        'search_items' => __('Search Slides', 'clubber'),
        'not_found' => __('No slides found', 'clubber'),
        'not_found_in_trash' => __('No slides found in Trash', 'clubber'),
        'parent_item_colon' => ''
    );
    $args      = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'show_ui' => true,
        'query_var' => true,
        'capability_type' => 'post',
        'rewrite' => true,
        'hierarchical' => false,
        'menu_icon' => $imagepath . '/slide.png',
        'supports' => array(
            'title',
            'thumbnail'
        )
    );
    register_post_type('slide', $args);
}
function add_new_slide_columns() {
    $new_columns['cb']     = '<input type="checkbox" />';
    $new_columns['title']  = __('Title', 'clubber');
    $new_columns['author'] = __('Author', 'clubber');
    $new_columns['id']     = __('ID', 'clubber');
    $new_columns['date']   = __('Date', 'clubber');
    return $new_columns;
}
function manage_slide_columns($column_name, $id) {
    global $wpdb;
    switch ($column_name) {
        case 'id':
            echo $id;
            break;
        case 'images':
            // Get number of images in gallery
            $num_images = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $wpdb->posts WHERE post_parent = {$id};"));
            echo $num_images;
            break;
        default:
            break;
    } // end switch
}
function slide_settings() {
    add_meta_box('slide_settings', __('Slide settings', 'clubber'), 'slide_settings_meta_source', 'slide', 'normal', 'high');
}
function slide_settings_save($post_ID = 0) {
    $post_ID = (int) $post_ID;  
    $post_type = get_post_type( $post_ID );
    $post_status = get_post_status( $post_ID );  
    if ( "slide" == $post_type && "auto-draft" != $post_status ) { 
    update_post_meta($post_ID, "slide_des", $_POST["slide_des"]);
    update_post_meta($post_ID, "slide_url", $_POST["slide_url"]);
    update_post_meta($post_ID, "slide_link_title", $_POST["slide_link_title"]);
    }
}
function slide_settings_meta_source() {
    global $post;
    $slide_des = get_post_meta($post->ID, 'slide_des', true);
    $slide_url = get_post_meta($post->ID, 'slide_url', true);
    echo '
			<div style="padding-top:10px;">
				<label style="display:block;padding:2px;">' . __('Slide Description', 'clubber') . ': </label><input style="width:420px;" name="slide_des" value="' . $slide_des . '">
60 characters
			</div>

			<div style="padding-top:10px;">
				<label style="display:block;padding:2px;">' . __('Slide URL', 'clubber') . ': </label><input style="width:220px;" name="slide_url" value="' . $slide_url . '">
Example: http://domain.com/name.html
			</div>';
}
?>