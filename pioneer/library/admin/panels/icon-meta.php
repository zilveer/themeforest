<?php 

/* Define the custom box */

// WP 3.0+
add_action('add_meta_boxes', 'icon_add_custom_box');
// backwards compatible
//add_action('admin_init', 'icon_add_custom_box', 1);

/* Do something with the data entered */
add_action('save_post', 'icon_save_postdata');

/* Adds a box to the main column on the Post and Page edit screens */
function icon_add_custom_box() {
    //add_meta_box( 'icon_sectionid', __( 'Post teaser', 'epic' ),'icon_inner_custom_box', 'news', 'side', 'low' );
	//add_meta_box( 'icon_sectionid', __( 'Post teaser', 'epic' ),'icon_inner_custom_box', 'products', 'side', 'low' );
	//add_meta_box( 'icon_sectionid', __( 'Post teaser', 'epic' ),'icon_inner_custom_box', 'testimonials', 'side', 'low' );
	add_meta_box( 'icon_sectionid', __( 'Icon', 'epic' ),'icon_inner_custom_box', 'post', 'side', 'low' );
	add_meta_box( 'icon_sectionid', __( 'Icon', 'epic' ),'icon_inner_custom_box', 'page', 'side', 'low' );
    add_meta_box( 'icon_sectionid', __( 'Icon', 'epic' ),'icon_inner_custom_box', 'portfolio', 'side', 'low'  );
}

/* Prints the box content */
function icon_inner_custom_box() {
 global $post,  $term;
  // Use nonce for verification
  wp_nonce_field( 'icon_sectionid', 'icon_noncename' );		
?>
<?php 

$icon = get_post_meta($post->ID,'epic_page_icon',true);
?>
	<div id="icon_preview" style="margin-bottom:6px;"><img src="<?php echo $icon; ?>" style="max-width:260px;"/></div>			
	
	<p><input id="upload_icon" type="text" name="upload_icon" value="<?php echo $icon;?>" /></p>
	<p></p><a title="Set icon" href="#" id="upload_icon_button" class="thickbox">Add icon</a>
	<a title="Remove icon" href="#" id="remove_icon_button">Remove icon</a></p>
		
<script type="text/javascript">
jQuery(document).ready(function() {
	
	var header_clicked = false;
	
	jQuery('#upload_icon_button').click(function() {
		formfield = jQuery('#upload_icon').attr('name');
		tb_show('', 'media-upload.php?type=image&TB_iframe=true');
		header_clicked = true;
		return false;
	});

	// Store original function
	window.original_send_to_editor_3 = window.send_to_editor;
	
		window.send_to_editor = function(html) {
			if (header_clicked == true) {
			imgurl = jQuery('img',html).attr('src');
			jQuery('#upload_icon').val(imgurl);
			jQuery('#icon_preview').html('<img  src="'+ imgurl + '" style="max-width:260px;"/>');

			jQuery('#upload_icon_button').hide();
			jQuery('#remove_icon_button').show();
			
			header_clicked = false;
			tb_remove();
			imgurl = null;
			} else {
			window.original_send_to_editor_3(html);
			}
	}

jQuery('#remove_icon_button').hide();
jQuery('#upload_icon_button').hide();

if( jQuery('#icon_preview img').attr('src') != ''){
	jQuery('#remove_icon_button').show();
	jQuery('#upload_icon_button').hide();
	}else{
	jQuery('#remove_icon_button').hide();
	jQuery('#upload_icon_button').show();
	}
	



jQuery('#remove_icon_button').click(function(){
	jQuery('#upload_icon').val('');
	jQuery('#icon_preview').html('');
	jQuery(this).hide();
	jQuery('#upload_icon_button').show();
	return false;

});


});
</script>
<?php
}

/* When the post is saved, saves our custom data */
function icon_save_postdata( $post_id ) {

  // verify this came from the our screen and with proper authorization,
  // because save_post can be triggered at other times

  if ( !wp_verify_nonce(isset( $_POST['icon_noncename']), 'icon_sectionid' )) {
    return $post_id;
  }

  // verify if this is an auto save routine. If it is our form has not been submitted, so we dont want
  // to do anything
  if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
    return $post_id;

  
  // Check permissions
  if ( 'page' == $_POST['post_type'] ) {
    if ( !current_user_can( 'edit_page', $post_id ) )
      return $post_id;
  } else {
    if ( !current_user_can( 'edit_post', $post_id ) )
      return $post_id;
  }

  // OK, we're authenticated: we need to find and save the data
	

  $icon = $_POST['upload_icon'];

  if($icon) { update_post_meta($post_id, 'epic_page_icon', $icon); } else { delete_post_meta($post_id, 'epic_page_icon');}

 
 
   //return $mydata;
} ?>