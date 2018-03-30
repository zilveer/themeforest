<?php
add_action('init', 'artist_type');
add_action('init', 'artist_taxonomies', 0);
add_action('admin_menu', 'artist_settings');
add_action('save_post', 'artist_settings_update');
add_filter('manage_edit-artist_columns', 'add_new_artist_columns');
add_action('manage_artist_posts_custom_column', 'manage_artist_columns', 10, 2);
function artist_type() {
    $imagepath = get_stylesheet_directory_uri() . '/images/posticon/';
    $labels    = array(
        'name' => __('Artists', 'clubber'),
        'singular_name' => __('Artist', 'clubber'),
        'add_new' => __('Add New', 'clubber'),
        'add_new_item' => __('Add New Artist', 'clubber'),
        'edit' => __('Edit', 'clubber'),
        'edit_item' => __('Edit Artist', 'clubber'),
        'new_item' => __('New Artist', 'clubber'),
        'view' => __('View Artist', 'clubber'),
        'view_item' => __('View Artist', 'clubber'),
        'search_items' => __('Search Artists', 'clubber'),
        'not_found' => __('No artists found', 'clubber'),
        'not_found_in_trash' => __('No artists found in Trash', 'clubber'),
        'parent_item_colon' => ''
    );
    $args      = array(
        'labels' => $labels,
        'description' => 'This is the holding location for all Artists',
        'public' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'show_ui' => true,
        'query_var' => true,
        'capability_type' => 'post',
        'rewrite' => true,
        'hierarchical' => false,
        'menu_position' => 5,
        'menu_icon' => $imagepath . '/artist.png',
        'supports' => array(
            'title',
            'editor',
            'thumbnail'
        )
    );
    register_post_type('artist', $args);
}
function artist_taxonomies() {
    register_taxonomy('artists', 'artist', array(
        'hierarchical' => true,
        'slug' => 'artists',
        'label' => __('Category', 'clubber'),
        'query_var' => true,
        'rewrite' => true
    ));
}
function add_new_artist_columns() {
    $new_columns['cb']     = '<input type="checkbox" />';
    $new_columns['title']  = __('Title', 'clubber');
    $new_columns['author'] = __('Author', 'clubber');
    $new_columns['id']     = __('ID', 'clubber');
    $new_columns['date']   = __('Date', 'clubber');
    return $new_columns;
}
function manage_artist_columns($column_name, $id) {
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
function artist_settings() {
    add_meta_box('artist_settings', __('Artist settings', 'clubber'), 'artist_settings_meta_source', 'artist', 'normal', 'high');
}
function artist_settings_update($post_ID = 0) {
    $post_ID = (int) $post_ID;  
    $post_type = get_post_type( $post_ID );
    $post_status = get_post_status( $post_ID );
    if ( "artist" == $post_type && "auto-draft" != $post_status ) { 
    update_post_meta($post_ID, "at_name", $_POST["at_name"]);
	update_post_meta($post_ID, "at_born", $_POST["at_born"]);
	update_post_meta($post_ID, "at_genres", $_POST["at_genres"]);
	update_post_meta($post_ID, "at_active", $_POST["at_active"]);
	update_post_meta($post_ID, "at_place", $_POST["at_place"]);
	update_post_meta($post_ID, "at_website", $_POST["at_website"]);
    }
}
function artist_settings_meta_source() {
    global $post;    
    $at_name      = get_post_meta($post->ID, 'at_name', true);
    $at_born      = get_post_meta($post->ID, 'at_born', true); 	
	$at_genres      = get_post_meta($post->ID, 'at_genres', true);
	$at_active      = get_post_meta($post->ID, 'at_active', true);
	$at_place      = get_post_meta($post->ID, 'at_place', true);
	$at_website      = get_post_meta($post->ID, 'at_website', true);
    echo '		
<div style="padding-top:10px;">
   <label style="display:block;padding:2px;">' . __('Birth name', 'clubber') . ': </label>
   <input style="width:220px;" name="at_name" value="' . $at_name . '" />
   Enter the birth name of the artist.
</div>
<div style="padding-top:10px;">
   <label style="display:block;padding:2px;">' . __('Born (yyyy/mm/dd)', 'clubber') . ': </label>
   <input style="width:220px;" name="at_born" id="event-date" value="' . $at_born . '" />
   Click inside the field, data picker.
</div>
<div style="padding-top:10px;">
   <label style="display:block;padding:2px;">' . __('Birthplace', 'clubber') . ': </label>
   <input style="width:220px;" name="at_place" value="' . $at_place . '" />
   Enter the birthplace of the artist.
</div>
<div style="padding-top:10px;">
   <label style="display:block;padding:2px;">' . __('Genres', 'clubber') . ': </label>
   <input style="width:220px;" name="at_genres" value="' . $at_genres . '" />
   Enter of the artist musical genres.
</div>
<div style="padding-top:10px;">
   <label style="display:block;padding:2px;">' . __('Years active', 'clubber') . ': </label>
   <input style="width:220px;" name="at_active" value="' . $at_active . '" />
   Enter years of activity of the artist.
</div>
<div style="padding-top:10px;">
   <label style="display:block;padding:2px;">' . __('Website', 'clubber') . ': </label>
   <input style="width:220px;" name="at_website" value="' . $at_website . '" />
   Enter the website of the artist.
</div>
';
}
?>