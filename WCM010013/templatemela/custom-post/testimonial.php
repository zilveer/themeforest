<?php 
function testimonial_theme_custom_posts(){
	//testimonial
	$labels = array(
	  'name' => _x('Testimonials', 'Testimonial','templatemela'),
	  'singular_name' => _x('Testimonial', 'testimonial','templatemela'),
	  'add_new' => _x('Add New', 'Testimonial','templatemela'),
	  'add_new_item' => __('Add New Testimonial','templatemela'),
	  'edit_item' => __('Edit Testimonial','templatemela'),
	  'new_item' => __('New Testimonial','templatemela'),
	  'view_item' => __('View Testimonial','templatemela'),
	  'search_items' => __('Search Testimonial','templatemela'),
	  'not_found' =>  __('No Testimonial found','templatemela'),
	  'not_found_in_trash' => __('No Testimonial found in Trash','templatemela'), 
	  'parent_item_colon' => ''
	);
	$args = array(
	  'labels' => $labels,
	  'public' => true,
	  'publicly_queryable' => true,
	  'show_ui' => true, 
	  'query_var' => true, 
	  'capability_type' => 'post', 
	  'menu_position' => null,
	  'menu_icon' => 'dashicons-format-chat',	 
	  'rewrite' => array('slug'=>'testimonial','with_front'=>''),
	  'supports' => array('title','editor','author','thumbnail','comments')
	); 
	register_post_type('testimonial',$args);	
}
add_filter('init', 'testimonial_theme_custom_posts' );

add_action( 'admin_init', 'remove_metabox_option' );
function remove_metabox_option() {
   	remove_meta_box( 'commentsdiv', 'testimonial', 'normal' );
	remove_meta_box( 'authordiv', 'testimonial', 'normal' );
	remove_meta_box( 'commentstatusdiv', 'testimonial', 'normal' );
}


add_action( 'add_meta_boxes', 'testimonial_add_custom_fields' );
add_action( 'save_post', 'testimonial_save_custom_fields' );

function testimonial_add_custom_fields() {
    add_meta_box( 
        'testimonial_options',
        'Testimonial Information',
        'testimonial_inner_custom_field',
        'testimonial' 
    );
}

function testimonial_inner_custom_field( $post ) {
	// Use nonce for verification
	wp_nonce_field( plugin_basename( __FILE__ ), '_templatemela' );	
	get_post_meta($post->ID, 'testimonial_position', TRUE) ? $testimonial_position = get_post_meta($post->ID, 'testimonial_position', TRUE) : $testimonial_position = '';
	get_post_meta($post->ID, 'testimonial_link', TRUE) ? $testimonial_link = get_post_meta($post->ID, 'testimonial_link', TRUE) : $testimonial_link = '';
?>

<table class="form-table">
  <tbody>
    <tr valign="top">
      <th><label for="testimonial_position">
        <?php _e('Email:', 'templatemela'); ?>
        </label></th>
      <td><input type="text" id="testimonial_position" name="testimonial_position" value=" <?php echo $testimonial_position; ?>" class="regular-text"/></td>
    </tr>
    <tr valign="top">
      <th><label for="testimonial_link">
        <?php _e('Link:', 'templatemela'); ?>
        </label></th>
      <td><input type="text" id="testimonial_link" name="testimonial_link" value=" <?php echo $testimonial_link; ?>" class="regular-text" /></td>
    </tr>
  </tbody>
</table>
<?php }


function testimonial_save_custom_fields( $post_id ) {
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;

  if ( !current_user_can( 'edit_post', $post_id ) )
        return;

  $mydata = array();

  foreach($_POST as $key => $data) {
    if($key == '_templatemela')
      continue;
	  
    if(preg_match('/^testimonial/i', $key)) {
      $mydata[$key] = $data;
	  update_post_meta($post_id, $key, $data);
    }
  }
 
  return $mydata;
  
} 
?>
