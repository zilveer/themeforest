<?php

/* Define the custom box */

add_action( 'add_meta_boxes', 'st_add_gallery_settings_box' );

add_action( 'save_post', 'st_gallery_save_postdata' );

/* Adds a box to the main column on the Post and Page edit screens */
function st_add_gallery_settings_box() {
    $screens = array('gallery');
    foreach ($screens as $screen) {
        add_meta_box(
            'st_gallery_box_id',
            __( 'Gallery Settings', 'smooththemes' ),
            'st_gallery_settings_box_content',
            $screen
        );
    }
}

/* Prints the box content */
function st_gallery_settings_box_content( $post ) {
  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'st_gallery_noncename' );

    $meta_name = '_st_gallery';
    $values =  get_post_meta($post->ID,$meta_name, true);
 ?>
 <div class="stpb_pd_w thumbnail_images gallery-builder">
    <?php stpb_images($meta_name,$values); ?>    
   <div style="clear: both;"></div>
  </div><!-- stpb_pd_w -->
 <?php
}

/* When the post is saved, saves our custom data */
function st_gallery_save_postdata( $post_id ) {

  // First we need to check if the current user is authorised to do this action. 
  if ( 'page' == $_POST['post_type'] ) {
    if ( ! current_user_can( 'edit_page', $post_id ) )
        return;
  } else {
    if ( ! current_user_can( 'edit_post', $post_id ) )
        return;
  }

  if ( ! isset( $_POST['st_gallery_noncename'] ) || ! wp_verify_nonce( $_POST['st_gallery_noncename'], plugin_basename( __FILE__ ) ) )
      return;
  $_st_gallery = isset($_POST['_st_gallery']) ?  $_POST['_st_gallery']  : array();
  update_post_meta($post_id,'_st_gallery',$_st_gallery);
 
}
