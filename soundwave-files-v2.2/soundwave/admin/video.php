<?php
add_action('init', 'video_type');
add_action('init', 'video_taxonomies', 0);
add_action('admin_menu', 'videos_youtube_or_vimeo');
add_action('save_post', 'videos_save');
add_action('admin_menu', 'videos_settings');
add_action('save_post', 'videos_settings_save');
add_filter('manage_edit-video_columns', 'add_new_video_columns');
add_action('manage_video_posts_custom_column', 'manage_video_columns', 10, 2);
function video_type() {
    $imagepath = get_stylesheet_directory_uri() . '/images/posticon/';
    $labels    = array(
        'name' => __('Videos', 'clubber'),
        'singular_name' => __('Video', 'clubber'),
        'add_new' => __('Add New', 'clubber'),
        'add_new_item' => __('Add New Video', 'clubber'),
        'edit' => __('Edit', 'clubber'),
        'edit_item' => __('Edit Video', 'clubber'),
        'new_item' => __('New Video', 'clubber'),
        'view' => __('View Video', 'clubber'),
        'view_item' => __('View Video', 'clubber'),
        'search_items' => __('Search Videos', 'clubber'),
        'not_found' => __('No video found', 'clubber'),
        'not_found_in_trash' => __('No videos found in Trash', 'clubber'),
        'parent_item_colon' => ''
    );
    $args      = array(
        'labels' => $labels,
        'description' => 'This is the holding location for all Videos',
        'public' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'show_ui' => true,
        'query_var' => true,
        'capability_type' => 'post',
        'rewrite' => true,
        'hierarchical' => false,
        'menu_position' => 5,
        'menu_icon' => $imagepath . '/video.png',
        'supports' => array(
            'title',
            'thumbnail'
        )
    );
    register_post_type('video', $args);
}
function video_taxonomies() {
    register_taxonomy('videos', 'video', array(
        'hierarchical' => true,
        'slug' => 'videos',
        'label' => __('Category', 'clubber'),
        'query_var' => true,
        'rewrite' => true
    ));
}
function videos_youtube_or_vimeo() {
    add_meta_box('video_link', __('YouTube or Vimeo - Video', 'clubber'), 'video_link_meta_source', 'video', 'normal', 'high');
}
function videos_save($post_ID = 0) {
    $post_ID = (int) $post_ID;  
    $post_type = get_post_type( $post_ID );
    $post_status = get_post_status( $post_ID );    
    if ( "video" == $post_type && "auto-draft" != $post_status ) {
    update_post_meta($post_ID, "video_link", $_POST["video_link"]);
    }
}
function video_link_meta_source() {
    global $post;
    $video = get_post_meta($post->ID, 'video_link', true);
    echo '
<div style="padding-top:0px;">
<p>Enter the link to YouTube or Vimeo: <input name="video_link" value="' . $video . '" /></p>
<p>Example: http://youtu.be/PLYakIdyFtE or http://vimeo.com/28527293</p>
</div>';
}
function videos_settings() {
    add_meta_box('video_settings', __('Video settings', 'clubber'), 'video_settings_source', 'video', 'normal', 'core');
}
function videos_settings_save($post_ID = 0) {
    $post_ID = (int) $post_ID;  
    $post_type = get_post_type( $post_ID );
    $post_status = get_post_status( $post_ID );    
    if ( "video" == $post_type && "auto-draft" != $post_status ) {
    update_post_meta($post_ID, "vd_date", $_POST["vd_date"]);
	update_post_meta($post_ID, "vd_venue", $_POST["vd_venue"]);
    }
}
function video_settings_source() {
    global $post;
	$vd_date           = get_post_meta($post->ID, 'vd_date', true);
	$vd_venue          = get_post_meta($post->ID, 'vd_venue', true);
    echo '
<div style="padding-top:10px;">
   <label style="display:block;padding:2px;">' . __('Release video (yyyy/mm/dd)', 'clubber') . ': </label>
   <input style="width:220px;" name="vd_date" id="event-date" value="' . $vd_date . '" />
   Click inside the field, Data Picker.
</div>';
    echo '
<div style="padding-top:10px;">
   <label style="display:block;padding:2px;">' . __('Venue', 'clubber') . ': </label>
   <input style="width:220px;" name="vd_venue" value="' . $vd_venue . '" />
    Enter the venue.
</div>';
}
function add_new_video_columns() {
    $new_columns['cb']     = '<input type="checkbox" />';
    $new_columns['title']  = __('Title', 'clubber');
    $new_columns['author'] = __('Author', 'clubber');
    $new_columns['id']     = __('ID', 'clubber');
    $new_columns['date']   = __('Date', 'clubber');
    return $new_columns;
}
function manage_video_columns($column_name, $id) {
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
?>