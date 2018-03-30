<?php 

/* Define the custom box */

// WP 3.0+
add_action('add_meta_boxes', 'background_add_custom_box');
// backwards compatible
//add_action('admin_init', 'background_add_custom_box', 1);

/* Do something with the data entered */
add_action('save_post', 'background_save_postdata');

/* Adds a box to the main column on the Post and Page edit screens */
function background_add_custom_box() {
    //add_meta_box( 'background_sectionid', __( 'Post teaser', 'epic' ),'background_inner_custom_box', 'news', 'side', 'low' );
	//add_meta_box( 'background_sectionid', __( 'Post teaser', 'epic' ),'background_inner_custom_box', 'products', 'side', 'low' );
	//add_meta_box( 'background_sectionid', __( 'Post teaser', 'epic' ),'background_inner_custom_box', 'testimonials', 'side', 'low' );
	add_meta_box( 'background_sectionid', __( 'Post background', 'epic' ),'background_inner_custom_box', 'post', 'side', 'low' );
	add_meta_box( 'background_sectionid', __( 'Page background', 'epic' ),'background_inner_custom_box', 'page', 'side', 'low' );
    add_meta_box( 'background_sectionid', __( 'Post background', 'epic' ),'background_inner_custom_box', 'portfolio', 'side', 'low'  );
}

/* Prints the box content */
function background_inner_custom_box() {
 global $post,  $term;
  // Use nonce for verification
  wp_nonce_field( 'background_sectionid', 'background_noncename' );		
?>
<?php 

$image = get_post_meta($post->ID,'epic_page_background',true);
$backgroundcolor = get_post_meta($post->ID,'epic_page_background_color',true);
$fit = get_post_meta($post->ID,'epic_page_background_stretch',true);
$knockout_header = get_post_meta($post->ID,'epic_header_background_knockout',true);
$knockout_content = get_post_meta($post->ID,'epic_content_background_knockout',true);

?>
	<label>Background-image</label>
	
	<div id="clientlogo_preview" style="margin-bottom:6px;"><img src="<?php echo $image; ?>" style="max-width:260px;"/></div>			
	
	<p><input id="upload_image" type="text" name="upload_image" value="<?php echo $image;?>" /></p>
	<p></p><a title="Set client logo" href="#" id="upload_image_button" class="thickbox">Set background image</a>
	<a title="Remove client logo" href="#" id="remove_image_button">Remove background image</a></p>
	<p><input type="checkbox" name="stretch" <?php if($fit){echo "checked=checked";}?>/><label> Fullscreen auto-scale</label></p>
	<hr/>
	<label>Background-color</label>
	<p><input id="epic_page_background_color" type="text" name="epic_page_background_color" value="<?php echo $backgroundcolor;?>" /></p>
	
	
	
<script type="text/javascript">
jQuery(document).ready(function() {
	
	var header_clicked = false;
	
	jQuery('#upload_image_button').click(function() {
		formfield = jQuery('#upload_image').attr('name');
		tb_show('', 'media-upload.php?type=image&TB_iframe=true');
		header_clicked = true;
		return false;
	});

	// Store original function
	window.original_send_to_editor_2 = window.send_to_editor;
	
		window.send_to_editor = function(html) {
			if (header_clicked == true) {
			imgurl = jQuery('img',html).attr('src');
			jQuery('#upload_image').val(imgurl);
			jQuery('#clientlogo_preview').html('<img  src="'+ imgurl + '" style="max-width:260px;"/>');

			jQuery('#upload_image_button').hide();
			jQuery('#remove_image_button').show();
			
			header_clicked = false;
			tb_remove();
			imgurl = null;
			} else {
			window.original_send_to_editor_2(html);
			}
	}

jQuery('#remove_image_button').hide();
jQuery('#upload_image_button').hide();

if( jQuery('#clientlogo_preview img').attr('src') != ''){
	jQuery('#remove_image_button').show();
	jQuery('#upload_image_button').hide();
	}else{
	jQuery('#remove_image_button').hide();
	jQuery('#upload_image_button').show();
	}
	



jQuery('#remove_image_button').click(function(){
	jQuery('#upload_image').val('');
	jQuery('#clientlogo_preview').html('');
	jQuery(this).hide();
	jQuery('#upload_image_button').show();
	return false;

});


});
</script>
<?php
}

/* When the post is saved, saves our custom data */
function background_save_postdata( $post_id ) {

  // verify this came from the our screen and with proper authorization,
  // because save_post can be triggered at other times

  if ( !wp_verify_nonce(isset( $_POST['background_noncename']), 'background_sectionid' )) {
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
	
  $backgroundcolor = $_POST['epic_page_background_color'];
  $clientimage = $_POST['upload_image'];
  $fittoscreen = isset($_POST['stretch']);

   // Do something with $mydata 
  // probably using add_post_meta(), update_post_meta(), or 
  // a custom table (see Further Reading section below)
  if($backgroundcolor) { update_post_meta($post_id, 'epic_page_background_color', $backgroundcolor); } else { delete_post_meta($post_id, 'epic_page_background_color');}
  if($clientimage) { update_post_meta($post_id, 'epic_page_background', $clientimage); } else { delete_post_meta($post_id, 'epic_page_background');}
  if($fittoscreen) { update_post_meta($post_id, 'epic_page_background_stretch', $fittoscreen); } else { delete_post_meta($post_id, 'epic_page_background_stretch');}
 
 
   //return $mydata;
} ?>