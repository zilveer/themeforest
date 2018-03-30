<?php
 
/**
* Create Metabox HTML.
*/
function custom_header_b($post) {
  global $metaBox;
  if (function_exists('wp_nonce_field')) {
    wp_nonce_field('awd_nonce_action','awd_nonce_field');
  }
 
  foreach ($metaBox['fields'] as $field) {
    echo '<div class="awdMetaBox">';
    //get attachment id if it exists.
    $meta = get_post_meta($post->ID, $field['id'], true);
    switch ($field['type']) {
      case 'media':
?>
        <span style="font-size:11px; color:#999; line-height:1.3;"><?php echo $field['desc']; ?></span><br/>
        <div class="awdMetaImage">
<?php 
        if ($meta) {
          echo wp_get_attachment_image( $meta, 'thumbnail', true);
          $attachUrl = wp_get_attachment_url($meta);
          echo 
          '<p>URL: <a target="_blank" href="'.$attachUrl.'">'.$attachUrl.'</a></p>';
        }
?>    
        </div><!-- end .awdMetaImage -->
        <p>
          <input type="hidden"   class="metaValueField" id="<?php echo $field['id']; ?>" name="<?php echo $field['id']; ?>" value="<?php echo $meta; ?>" /> 
          <input class="image_upload_button"  type="button" value="Choose File" /> 
          <input class="removeImageBtn" type="button" value="Remove File" />
        </p>
 
<?php
      break;
    }
    echo '</div> <!-- end .awdMetaBox -->';
  } //end foreach
}//end function custom_header_b
 
 
function saveMetaData($post_id, $post) {
  //make sure we're saving at the right time.
  //DOING_AJAX is set when saving a quick edit on the page that displays all posts/pages  
  //Not checking for this will cause our meta data to be overwritten with blank data.
  if ( empty($_POST)
    || !wp_verify_nonce(isset($_POST['awd_nonce_field']) && $_POST['awd_nonce_field'],'awd_nonce_action')
    || $post->post_type == 'revision'
    || defined('DOING_AJAX' )) {
    return;
  }
 
  global $metaBox;
  global $wpdb;
 
  foreach ($metaBox['fields'] as $field) {
    $value = $_POST[$field['id']];
	
 
    if ($field['type'] == 'media' && !is_numeric($value) ) {
      //Convert URL to Attachment ID.
      $value = $wpdb->get_var(
        "SELECT ID FROM $wpdb->posts 
         WHERE guid = '$value' 
         AND post_type='attachment' LIMIT 1");
    }
    update_post_meta($post_id, $field['id'], $value);
  }//end foreach
}//end function saveMetaData
 
/**
 * Add JavaScript to get URL from media uploader.
 */
function embedUploaderCode() {
  ?>
	<script type="text/javascript">
		jQuery(document).ready(function() {
		
		jQuery('.removeImageBtn').click(function() {
		  jQuery(this).closest('p').prev('.awdMetaImage').html('');   
		  jQuery(this).prev().prev().val('');
		  return false;
		});
		
		jQuery('.image_upload_button').click(function() {
		  inputField = jQuery(this).prev('.metaValueField');
		  tb_show('', 'media-upload.php?TB_iframe=true');
		  window.send_to_editor = function(html) {
			url = jQuery(html).attr('href');
			inputField.val(url);
			inputField.closest('p').prev('.awdMetaImage').html('<p>URL: '+ url + '</p>');  
			tb_remove();
		  };
		  return false;
		});
		});
    </script>
<?php } ?>