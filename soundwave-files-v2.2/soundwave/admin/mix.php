<?php
add_action('init', 'mixes_type');
add_action('init', 'mixes_taxonomies', 0);
add_action('admin_menu', 'mixes_upload');
add_action('admin_menu', 'mixes_settings');
add_action('save_post', 'mixes_settings_update');
add_action('save_post', 'mixes_status_update');
add_filter('manage_edit-event_columns', 'add_new_mixes_columns');
add_action('manage_event_posts_custom_column', 'manage_mixes_columns', 10, 2);
function mixes_type() {
    $imagepath = get_stylesheet_directory_uri() . '/images/posticon/';
    $labels    = array(
        'name' => __('Dj Mixes', 'clubber'),
        'singular_name' => __('Mix', 'clubber'),
        'add_new' => __('Add New', 'clubber'),
        'add_new_item' => __('Add New Mix', 'clubber'),
        'edit' => __('Edit', 'clubber'),
        'edit_item' => __('Edit Mix', 'clubber'),
        'new_item' => __('New Mix', 'clubber'),
        'view' => __('View Mix', 'clubber'),
        'view_item' => __('View Mix', 'clubber'),
        'search_items' => __('Search Mix', 'clubber'),
        'not_found' => __('No mix found', 'clubber'),
        'not_found_in_trash' => __('No mix found in Trash', 'clubber'),
        'parent_item_colon' => ''
    );
    $args      = array(
        'labels' => $labels,
        'description' => 'This is the holding location for all Mixes',
        'public' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'show_ui' => true,
        'query_var' => true,
        'capability_type' => 'post',
        'rewrite' => true,
        'hierarchical' => false,
        'menu_position' => 5,
        'menu_icon' => $imagepath . '/mixes.png',
        'supports' => array(
            'title',
            'thumbnail'
        )
    );
    register_post_type('mix', $args);
}
function mixes_taxonomies() {
    register_taxonomy('mixes', 'mix', array(
        'hierarchical' => true,
        'slug' => 'mixes',
        'label' => __('Category', 'clubber'),
        'query_var' => true,
        'rewrite' => true
    ));
}
function add_new_mixes_columns() {
    $new_columns['cb']     = '<input type="checkbox" />';
    $new_columns['title']  = __('Title', 'clubber');
    $new_columns['author'] = __('Author', 'clubber');
    $new_columns['id']     = __('ID', 'clubber');
    $new_columns['date']   = __('Date', 'clubber');
    return $new_columns;
}
function manage_mixes_columns($column_name, $id) {
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
function mixes_upload() {
    add_meta_box('mix', __('Upload Mix', 'clubber'), 'mixes_upload_source', 'mix', 'normal', 'high');
}
function mixes_upload_source() {
    echo '
<div style="padding-top:10px;">
	<label style="display:block;padding:2px;">' . __('Upload your mix', 'clubber') . ': 	
	<input id="upload_button" class="button" type="button" value="Upload Mix" />
	</label>	
</div>';
}
function mixes_settings() {
    add_meta_box('mixes_settings', __('Mix settings', 'clubber'), 'mixes_settings_meta_source', 'mix', 'normal', 'high');
}
function mixes_settings_update($post_ID = 0) {
    $post_ID = (int) $post_ID;  
    $post_type = get_post_type( $post_ID );
    $post_status = get_post_status( $post_ID );
    if ( "mix" == $post_type && "auto-draft" != $post_status ) { 
    update_post_meta($post_ID, "mx_date", $_POST["mx_date"]);
	update_post_meta($post_ID, "mx_genre", $_POST["mx_genre"]);
	update_post_meta($post_ID, "mx_buy", $_POST["mx_buy"]);
    }
}

function mixes_status_update($post_id) {
if (!isset($_POST['my_download'])){
    $_POST['my_download'] = "undefine";
    } 
    if (!wp_verify_nonce($_POST['my_download'], 'my_download') || !current_user_can('edit_posts'))
        return;
    $value = isset($_POST['mx_download']) ? 'yes' : 'no';
        update_post_meta($post_id, 'mx_download', $value);
}

function mixes_settings_meta_source() {
    global $post;    
    $mx_date        = get_post_meta($post->ID, 'mx_date', true);
	$mx_genre       = get_post_meta($post->ID, 'mx_genre', true);
	$mx_download    = get_post_meta($post->ID, 'mx_download', true);
	$mx_buy         = get_post_meta($post->ID, 'mx_buy', true);
	 echo '		
<div style="padding-top:10px;">
   <label style="display:block;padding:2px;">' . __('Release Dates (yyyy/mm/dd)', 'clubber') . ': </label>
   <input style="width:220px;" name="mx_date" id="event-date" value="' . $mx_date . '" />
   Click inside the field, Data Picker.
</div>
<div style="padding-top:10px;">
   <label style="display:block;padding:2px;">' . __('Genre', 'clubber') . ': </label>
   <input style="width:220px;" name="mx_genre" value="' . $mx_genre . '" />
   Enter the mix genre.
</div>
<div style="padding-top:10px;">
   <label style="display:block;padding:2px;">' . __('Buy Mix', 'clubber') . ': </label>
   <input style="width:220px;" name="mx_buy" value="' . $mx_buy . '" />
   Example: http://site.com
</div>';

}
?>