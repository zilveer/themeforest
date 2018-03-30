<?php
function tm_custom_post_staff(){
		$labels = array(
			'name' => _x( 'Staff', 'post type general name', 'templatemela' ),
			'singular_name' => _x( 'Staff', 'post type singular name', 'templatemela' ),
			'add_new' => _x( 'Add Staff', '', 'templatemela' ),
			'add_new_item' => __( 'Add Staff ', 'templatemela' ),
			'edit_item' => __( 'Edit Staff', 'templatemela' ),
			'new_item' => __( 'New Staff', 'templatemela' ),
			'view_item' => __( 'View Staff', 'templatemela' ),
			'search_items' => __( 'Search Staff', 'templatemela' ),
			'not_found' =>  __( 'No Staff found', 'templatemela' ),
			'not_found_in_trash' => __( 'No Staff found in Trash', 'templatemela' ), 
			'parent_item_colon' => ''
		);
		
		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true, 
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_position' => null, 
			'menu_icon' => 'dashicons-groups',
			'taxonomies' => array( '' ), 
			'supports' => array( 'title', 'editor', 'page-attributes', 'thumbnail', 'excerpt')
		);
		
		register_post_type( 'staff', $args );	
}
add_filter( 'init', 'tm_custom_post_staff' );
add_action( 'add_meta_boxes', 'staff_add_custom_fields' );
add_action( 'save_post', 'staff_save_custom_fields' );

function staff_add_custom_fields() {
    add_meta_box( 
        'staff_options',
        'Staff Details',
        'staff_inner_custom_field',
        'staff' 
    );
}

function staff_inner_custom_field( $post ) {

	// Use nonce for verification
	wp_nonce_field( plugin_basename( __FILE__ ), '_templatemela' );	
	get_post_meta($post->ID, 'staff_position', TRUE) ? $staff_position = get_post_meta($post->ID, 'staff_position', TRUE) : $staff_position = '';
	get_post_meta($post->ID, 'staff_link', TRUE) ? $staff_link = get_post_meta($post->ID, 'staff_link', TRUE) : $staff_link = '';
	get_post_meta($post->ID, 'staff_phone', TRUE) ? $staff_phone = get_post_meta($post->ID, 'staff_phone', TRUE) : $staff_phone = '';
	get_post_meta($post->ID, 'staff_email', TRUE) ? $staff_email = get_post_meta($post->ID, 'staff_email', TRUE) : $staff_email = '';
	get_post_meta($post->ID, 'staff_twitter', TRUE) ? $staff_twitter = get_post_meta($post->ID, 'staff_twitter', TRUE) : $staff_twitter = '';
	get_post_meta($post->ID, 'staff_facebook', TRUE) ? $staff_facebook = get_post_meta($post->ID, 'staff_facebook', TRUE) : $staff_facebook = '';
	get_post_meta($post->ID, 'staff_google_plus', TRUE) ? $staff_google_plus = get_post_meta($post->ID, 'staff_google_plus', TRUE) : $staff_google_plus = '';
	get_post_meta($post->ID, 'staff_linkedin', TRUE) ? $staff_linkedin = get_post_meta($post->ID, 'staff_linkedin', TRUE) : $staff_linkedin = '';
	get_post_meta($post->ID, 'staff_youtube', TRUE) ? $staff_youtube = get_post_meta($post->ID, 'staff_youtube', TRUE) : $staff_youtube = '';
	get_post_meta($post->ID, 'staff_rss', TRUE) ? $staff_rss = get_post_meta($post->ID, 'staff_rss', TRUE) : $staff_rss = '';
	get_post_meta($post->ID, 'staff_pinterest', TRUE) ? $staff_pinterest = get_post_meta($post->ID, 'staff_pinterest', TRUE) : $staff_pinterest = '';
	get_post_meta($post->ID, 'staff_skype', TRUE) ? $staff_skype = get_post_meta($post->ID, 'staff_skype', TRUE) : $staff_skype = '';
?>
<table class="form-table">
	<tbody>
	<tr valign="top">
		<th><label for="staff_position">Position:</label></th>
		<td><input type="text" id="staff_position" name="staff_position" value=" <?php echo $staff_position; ?>" class="regular-text"/><br/>
		<span class="description">Enter the person's position or title (e.g. CEO, Manager etc.)</span> </td>
	</tr>
	
	<tr valign="top">
		<th><label for="staff_link">Personal blog / website:</label></th>
		<td><input type="text" id="staff_link" name="staff_link" value=" <?php echo $staff_link; ?>" class="regular-text" /></td>
	</tr>
	<tr valign="top">
		<th><label for="staff_phone">Phone:</label></th>
		<td><input type="text" id="staff_phone" name="staff_phone" value=" <?php echo $staff_phone; ?>" class="regular-text" /></td>
	</tr>
	<tr valign="top">
		<th><label for="staff_email">Email:</label></th>
		<td><input type="text" id="staff_email" name="staff_email" value=" <?php echo $staff_email; ?>" class="regular-text" /></td>
	</tr>
	<tr valign="top">
		<th><label for="staff_twitter">Twitter:</label></th>
		<td><input type="text" id="staff_twitter" name="staff_twitter" value=" <?php echo $staff_twitter; ?>" class="regular-text" /></td>
	</tr>
	<tr valign="top">
		<th><label for="staff_facebook">Facebook:</label></th>
		<td><input type="text" id="staff_facebook" name="staff_facebook" value=" <?php echo $staff_facebook; ?>" class="regular-text" /></td>
	</tr>
	<tr valign="top">
		<th><label for="staff_google_plus">Google Plus:</label></th>
		<td><input type="text" id="staff_google_plus" name="staff_google_plus" value=" <?php echo $staff_google_plus; ?>" class="regular-text" /></td>
	</tr>
	<tr valign="top">
		<th><label for="staff_linkedin">Linkedin:</label></th>
		<td><input type="text" id="staff_linkedin" name="staff_linkedin" value=" <?php echo $staff_linkedin; ?>" class="regular-text" /></td>
	</tr>
	<tr valign="top">
		<th><label for="staff_youtube">Youtube:</label></th>
		<td><input type="text" id="staff_youtube" name="staff_youtube" value=" <?php echo $staff_youtube; ?>" class="regular-text" /></td>
	</tr>
	<tr valign="top">
		<th><label for="staff_rss">RSS:</label></th>
		<td><input type="text" id="staff_rss" name="staff_rss" value=" <?php echo $staff_rss; ?>" class="regular-text" /></td>
	</tr>
	<tr valign="top">
		<th><label for="staff_pinterest">Pinterest:</label></th>
		<td><input type="text" id="staff_pinterest" name="staff_pinterest" value=" <?php echo $staff_pinterest; ?>" class="regular-text" /></td>
	</tr>
	<tr valign="top">
		<th><label for="staff_skype">Skype:</label></th>
		<td><input type="text" id="staff_skype" name="staff_skype" value=" <?php echo $staff_skype; ?>" class="regular-text" /></td>
	</tr>	
	</tbody>
</table>

<?php }

function staff_save_custom_fields( $post_id ) {
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;

  if ( !current_user_can( 'edit_post', $post_id ) )
        return;

  $mydata = array();

  foreach($_POST as $key => $data) {
    if($key == '_templatemela')
      continue;
	  
    if(preg_match('/^staff/i', $key)) {
      $mydata[$key] = $data;
	  update_post_meta($post_id, $key, $data);
    }
  }  
  return $mydata;
  
} 