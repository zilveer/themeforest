<?php
add_action('init', 'photo_type');
add_action('init', 'photo_taxonomies', 0);
add_action('admin_menu', 'gallery');
add_action('save_post', 'gallery_update');
add_filter('manage_edit-photo_columns', 'add_new_photo_columns');
add_action('manage_photo_posts_custom_column', 'manage_photo_columns', 10, 3);
function photo_type() {
    $imagepath = get_stylesheet_directory_uri() . '/images/posticon/';
    $labels    = array(
        'name' => __('Photos', 'clubber'),
        'singular_name' => __('Photo', 'clubber'),
        'add_new' => __('Add New', 'clubber', 'clubber'),
        'add_new_item' => __('Add New Photo', 'clubber'),
        'edit' => __('Edit', 'clubber'),
        'edit_item' => __('Edit Photo', 'clubber'),
        'new_item' => __('New Photo', 'clubber'),
        'view' => __('View Photo', 'clubber'),
        'view_item' => __('View Photo', 'clubber'),
        'search_items' => __('Search Photos', 'clubber'),
        'not_found' => __('No photos found', 'clubber'),
        'not_found_in_trash' => __('No photos found in Trash', 'clubber'),
        'parent_item_colon' => ''
    );
    $args      = array(
        'labels' => $labels,
        'description' => 'This is the holding location for all Photos',
        'public' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'show_ui' => true,
        'query_var' => true,
        'capability_type' => 'post',
        'rewrite' => true,
        'hierarchical' => false,
        'menu_position' => 4,
        'menu_icon' => $imagepath . '/photo.png',
        'supports' => array(
            'title',
            'thumbnail'
        )
    );
    register_post_type('photo', $args);
}
function photo_taxonomies() {
    register_taxonomy('photos', 'photo', array(
        'hierarchical' => true,
        'slug' => 'photos',
        'label' => __('Category', 'clubber'),
        'query_var' => true,
        'rewrite' => true
    ));
}
function generate_thumbnail_list($post_id = null) {
    if ($post_id == null)
        return;
    $images = get_posts(array(
        'numberposts' => -1,
        'post_type' => 'attachment',
        'post_mime_type' => 'image/jpeg, image/jpg, image/png, image/gif',
        'post_parent' => $post_id,
        'orderby' => 'menu_order',
        'order' => 'DESC'
    ));
    if (count($images) > 0) {
        echo '
    <div class="col-gallery">
       <div class="gallery"> ';
        foreach ($images as $image) {
            $cover_large   = wp_get_attachment_image_src($image->ID, 'photo-large');
            $cover_gallery = wp_get_attachment_image($image->ID, 'photo-gallery');
            echo '
        <div class="photo"><a href="' . $cover_large[0] . '" class="photo-preview" rel="prettyPhoto[pp_gal]">' . $cover_gallery . '</a>
        </div><!-- end .gallery -->';
        }
        echo '
</div>
    </div><!-- end .col-gallery -->';
 echo '
    <div class="clear"></div><!-- end .clear -->';
       
    }
}
function add_new_photo_columns() {
    $new_columns['cb']     = '<input type="checkbox" />';
    $new_columns['title']  = __('Title', 'clubber');
    $new_columns['author'] = __('Author', 'clubber');
    $new_columns['id']     = __('ID', 'clubber');
    $new_columns['date']   = __('Date', 'clubber');
    return $new_columns;
}
function manage_photo_columns($column_name, $id) {
    global $wpdb;
    switch ($column_name) {
        case 'id':
            echo $id;
            break;
        case 'images':
            $num_images = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $wpdb->posts WHERE post_parent = {$id};"));
            echo $num_images;
            break;
        default:
            break;
    }
}
function gallery() {
    add_meta_box('gallery', __('Photos', 'clubber'), 'gallery_meta_source', 'photo', 'normal', 'high');
}
function gallery_update($post_ID = 0) {
    $post_ID = (int) $post_ID;  
    $post_type = get_post_type( $post_ID );
    $post_status = get_post_status( $post_ID ); 
    if ( "photo" == $post_type && "auto-draft" != $post_status ) { 
    update_post_meta($post_ID, "slide_des", $_POST["slide_des"]);
    update_post_meta($post_ID, "slide_url", $_POST["slide_url"]);
    update_post_meta($post_ID, "slide_link_title", $_POST["slide_link_title"]);
    }
}
function gallery_meta_source() {
    global $post;
    $PostID = $post->ID;
    echo '
<div style="padding-top:10px;">
	<label style="display:block;padding:2px;">' . __('Upload your photos', 'clubber') . ': 	
    <input id="upload_button" class="button" type="button" value="Upload Photo" />
	</label>	
</div>';
}
?>