<?php 
add_action('init', 'themnific_service_register');
 
function themnific_service_register() {
 
	$labels = array(
		'name' => 'Services', 'post type general name',
		'singular_name' => 'Service Item', 'post type singular name',
		'add_new' => 'Add New', 'Service item',
		'add_new_item' => 'Add New Service', 'themnific',
		'edit_item' => 'Edit Services', 'themnific',
		'new_item' => 'New Service', 'themnific',
		'view_item' => 'View Services', 'themnific',
		'search_items' => 'Search Services', 'themnific',
		'menu_icon' => get_stylesheet_directory_uri() . '/functions/images/ptype.png',
		'not_found' =>  'Nothing found', 'themnific',
		'not_found_in_trash' => 'Nothing found in Trash', 'themnific',
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'exclude_from_search' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_icon' => get_stylesheet_directory_uri() . '/functions/images/ptype.png',
		'rewrite' => false,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','excerpt'),
		'register_meta_box_cb' => 'themnific_add_service_meta'
	  ); 
 
	register_post_type( 'service' , $args );
}
//Service Link Meta Box
add_action("admin_init", "themnific_add_service_meta");
 
function themnific_add_service_meta(){
  add_meta_box("themnific_credits_service_meta", "Link", "themnific_credits_service_meta", "service", "normal", "low");
}
 

function themnific_credits_service_meta( $post ) {

  // Use nonce for verification
  $themnificdata = get_post_meta($post->ID, 'themnific_service_link', TRUE);
  wp_nonce_field( 'themnific_meta_box_nonce', 'meta_box_nonce' ); 

  // The actual fields for data entry
  echo '<input type="text" id="themnific_sldurl" name="themnific_sldurl" value="'.$themnificdata.'" size="75" />';
}

//Save Service Link Value
add_action('save_post', 'themnific_save_service_details');
function themnific_save_service_details($post_id){
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
      return;

if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'themnific_meta_box_nonce' ) ) return; 

  if ( !current_user_can( 'edit_post', $post_id ) )
        return;

$themnificdata = esc_url( $_POST['themnific_sldurl'] );
update_post_meta($post_id, 'themnific_service_link', $themnificdata);
return $themnificdata;  
}






// get the first image of the post Function
function themnific_get_service_ico($overrides = '', $exclude_thumbnail = false)
{
    return get_posts(wp_parse_args($overrides, array(
        'numberposts' => -1,
        'post_parent' => get_the_ID(),
        'post_type' => 'attachment',
        'post_mime_type' => 'image',
        'order' => 'ASC',
        'exclude' => $exclude_thumbnail ? array(get_post_thumbnail_id()) : array(),
        'orderby' => 'menu_order ID'
    )));
}
?>