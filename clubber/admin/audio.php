<?php
add_action('init', 'audio_type');
add_action('init', 'audio_taxonomies', 0);
add_action('admin_menu', 'audio_buy_link');
add_action('save_post', 'audio_buy_link_save');
add_action('admin_menu', 'audio_release_date');
add_action('save_post', 'audio_release_date_save');
add_action('admin_menu', 'audio_genre_date');
add_action('save_post', 'audio_genre_date_save');
add_filter('manage_edit-audio_columns', 'add_new_audio_columns');
add_action('manage_audio_posts_custom_column', 'manage_audio_columns', 10, 2);
function audio_type() {
    $imagepath = get_stylesheet_directory_uri() . '/images/posticon/';
    $labels    = array(
        'name' => __('Audio', 'clubber'),
        'singular_name' => __('Audio', 'clubber'),
        'add_new' => __('Add New', 'clubber'),
        'add_new_item' => __('Add New Audio', 'clubber'),
        'edit' => __('Edit', 'clubber'),
        'edit_item' => __('Edit Audio', 'clubber'),
        'new_item' => __('New Audio', 'clubber'),
        'view' => __('View Audio', 'clubber'),
        'view_item' => __('View Audio', 'clubber'),
        'search_items' => __('Search Audio', 'clubber'),
        'not_found' => __('No audio found', 'clubber'),
        'not_found_in_trash' => __('No audio found in Trash', 'clubber'),
        'parent_item_colon' => ''
    );
    $args      = array(
        'labels' => $labels,
        'description' => 'This is the holding location for all Audio',
        'public' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'show_ui' => true,
        'query_var' => true,
        'capability_type' => 'post',
        'rewrite' => true,
        'hierarchical' => false,
        'menu_position' => 5,
        'menu_icon' => $imagepath . '/audio-icon.png',
        'supports' => array(
            'title',
            'thumbnail',
            'editor'
        )
    );
    register_post_type('audio', $args);
}
function audio_taxonomies() {
    register_taxonomy('audios', 'audio', array(
        'hierarchical' => true,
        'slug' => 'audio',
        'label' => __('Category', 'clubber'),
        'query_var' => true,
        'rewrite' => true
    ));
}
function add_new_audio_columns() {
    $new_columns['cb']     = '<input type="checkbox" />';
    $new_columns['title']  = __('Title', 'clubber');
    $new_columns['author'] = __('Author', 'clubber');
    $new_columns['id']     = __('ID', 'clubber');
    $new_columns['date']   = __('Date', 'clubber');
    return $new_columns;
}
function manage_audio_columns($column_name, $id) {
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
function audio_release_date() {
    add_meta_box('my-metabox', __('Release date', 'clubber'), 'release_date_source', 'audio', 'normal', 'core');
}
function release_date_source() {
    global $post;
    $date = get_post_meta($post->ID, 'release_date', true);
    echo '<div style="padding-top:10px;">
<label style="display:block;padding:2px;">' . __('Event Date (mm/dd/yy)', 'clubber') . ': </label>
<input style="width:220px;" name="release_date" id="event-date" value="' . $date . '">
Click inside the field, Data Picker.
</div>';
}
function audio_release_date_save($post_ID = 0) {
    $post_ID = (int) $post_ID;  
    $post_type = get_post_type( $post_ID );
    $post_status = get_post_status( $post_ID );    
    if ( "audio" == $post_type && "auto-draft" != $post_status ) {
        update_post_meta($post_ID, "release_date", $_POST["release_date"]);
        update_post_meta($post_id, 'Date', $date);   
    }
}
function audio_genre_date() {
    add_meta_box('genre-metabox', __('Genre', 'clubber'), 'audio_genre_source', 'audio', 'normal', 'core');
}
function audio_genre_source() {
    global $post;
    $genre = get_post_meta($post->ID, 'audio_genre', true);
    echo '<div style="padding-top:10px;">
<label style="display:block;padding:2px;">' . __('Genre of music', 'clubber') . ': </label>
<input style="width:220px;" name="audio_genre" value="' . $genre . '">
Enter the genre of music.
</div>';
}
function audio_genre_date_save($post_ID = 0) {
    $post_ID = (int) $post_ID;  
    $post_type = get_post_type( $post_ID );
    $post_status = get_post_status( $post_ID );   
    if ( "audio" == $post_type && "auto-draft" != $post_status ) { 
    update_post_meta($post_ID, "audio_genre", $_POST["audio_genre"]);
    }
}
function audio_buy_link() {
    add_meta_box('audio_buy_link', __('Buy Link', 'clubber'), 'audio_buy_link_meta_source', 'audio', 'normal', 'high');
}
function audio_buy_link_save($post_ID = 0) { 
    $post_ID = (int) $post_ID;  
    $post_type = get_post_type( $post_ID );
    $post_status = get_post_status( $post_ID );    
    if ( "audio" == $post_type && "auto-draft" != $post_status ) {
        update_post_meta($post_ID, "audio_itunes", $_POST["audio_itunes"]);
        update_post_meta($post_ID, "audio_amazon", $_POST["audio_amazon"]);
        update_post_meta($post_ID, "audio_beatport", $_POST["audio_beatport"]);
        update_post_meta($post_ID, "audio_other", $_POST["audio_other"]);
        update_post_meta($post_ID, "audio_other_text", $_POST["audio_other_text"]);
    }
    return $post_ID; 
}
function audio_buy_link_meta_source() {
    global $post;
    $itunes = get_post_meta($post->ID, 'audio_itunes', true);
    $amazon = get_post_meta($post->ID, 'audio_amazon', true);
    $beatport = get_post_meta($post->ID, 'audio_beatport', true);
    $other = get_post_meta($post->ID, 'audio_other', true);
    $other_text = get_post_meta($post->ID, 'audio_other_text', true);
    echo '
			<div style="padding-top:0px;">
 
<p>iTunes: <input name="audio_itunes" value="' . $itunes . '" /> Enter the full URL on iTunes.</p>

<p>Amazon: <input name="audio_amazon" value="' . $amazon . '" /> Enter the full URL on Amazon.</p>

<p>Beatport: <input name="audio_beatport" value="' . $beatport . '" /> Enter the full URL on Beatport.</p>

<p>Other buying: <input name="audio_other" value="' . $other . '" /> Enter the full URL.</p>

<p>Buton text for other buying: <input name="audio_other_text" value="' . $other_text . '" /></p>

			</div>';
}
?>