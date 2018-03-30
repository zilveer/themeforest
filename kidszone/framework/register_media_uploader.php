<?php
/** dt_theme_image_upload_option()
  * Objective:
  *		1.To remove the unnecessary tabs
  *		2.To alter the "Insert into Post" text
  *		3.To disable flash uploader
**/
function dt_theme_image_upload_option(){
	add_action('admin_head_media_upload_type_form', 'dt_theme_html_uploader');
	add_filter('flash_uploader', 'disable_flash_uploader');
	
	add_filter('media_upload_form_url', 'option_image_form_url', 10, 2);
	
	add_filter('media_upload_tabs', 'dt_theme_disable_image_tabs');
	add_filter('attachment_fields_to_edit', 'dt_theme_image_attachment_option', 10, 2);
}
### --- ****  dt_theme_image_upload_option() *** --- ###


/** dt_theme_html_uploader()
  * Objective:
  *		To disable flash uploader
**/
function dt_theme_html_uploader(){
	global $wp_version;
	if( version_compare( $wp_version, '3.3', '>=' ) ) {
	?><script type="text/javascript">
	/* <![CDATA[ */
	jQuery(document).ready(function(){
		setUserSetting('uploader', '1'); // 1 == html uploader
		jQuery('.media-upload-form').addClass('html-uploader');
		jQuery('.upload-html-bypass').css('display','none');
		jQuery('.after-file-upload').css('display','none');
	});
	/* ]]> */
	</script>
<?php
	}
}
### --- ****  dt_theme_html_uploader() *** --- ###


/** disable_flash_uploader()
  * Objective:
  *		To disable flash uploader
**/
function disable_flash_uploader($flash){
	return false;
}
### --- ****  disable_flash_uploader() *** --- ###

function option_image_form_url($form_action_url, $type){
	$form_action_url = $form_action_url.'&mytheme_upload_button=1';
	return $form_action_url;
}

function dt_theme_disable_image_tabs ($tabs) {
	unset($tabs['type_url'], $tabs['gallery']);
    	return $tabs;
}

function dt_theme_image_attachment_option($form_fields, $post){
	unset($form_fields);
	
	$filename = basename( $post->guid );
	$attachment_id = $post->ID;
	$attachment['post_title'] = '';
	$attachment['url'] = '';
	$attachment['post_excerpt'] = '';
	
	if ( current_user_can( 'delete_post', $attachment_id ) ) {
		if ( !EMPTY_TRASH_DAYS ) {
			$delete = "<a href='" . wp_nonce_url( "post.php?action=delete&amp;post=$attachment_id", 'delete-attachment_' . $attachment_id ) . "' id='del[$attachment_id]' class='delete'>" . __( 'Delete Permanently' , 'iamd_text_domain') . '</a>';
		} elseif ( !MEDIA_TRASH ) {
			$delete = "<a href='#' class='del-link' onclick=\"document.getElementById('del_attachment_$attachment_id').style.display='block';return false;\">" . __( 'Delete' , 'iamd_text_domain' ) . "</a>
			 <div id='del_attachment_$attachment_id' class='del-attachment' style='display:none;'>" . sprintf( __( 'You are about to delete <strong>%s</strong>.' , 'iamd_text_domain' ), $filename ) . "
			 <a href='" . wp_nonce_url( "post.php?action=delete&amp;post=$attachment_id", 'delete-attachment_' . $attachment_id ) . "' id='del[$attachment_id]' class='button'>" . __( 'Continue' , 'iamd_text_domain' ) . "</a>
			 <a href='#' class='button' onclick=\"this.parentNode.style.display='none';return false;\">" . __( 'Cancel' , 'iamd_text_domain' ) . "</a>
			 </div>";
		} else {
			$delete = "<a href='" . wp_nonce_url( "post.php?action=trash&amp;post=$attachment_id", 'trash-attachment_' . $attachment_id ) . "' id='del[$attachment_id]' class='delete'>" . __( 'Move to Trash' , 'iamd_text_domain' ) . "</a>
			<a href='" . wp_nonce_url( "post.php?action=untrash&amp;post=$attachment_id", 'untrash-attachment_' . $attachment_id ) . "' id='undo[$attachment_id]' class='undo hidden'>" . __( 'Undo' , 'iamd_text_domain' ) . "</a>";
		}
	} else {
		$delete = '';
	}
	
	$send = "<input type='submit' class='button' name='send[$attachment_id]' value='" . esc_attr__( 'Insert this Image' , 'iamd_text_domain' ) . "' />";
	$send .= "<input type='radio' checked='checked' value='full' id='image-size-full-$attachment_id' name='attachments[$attachment_id][image-size]' style='display:none;' />";
	$send .= "<input type='hidden' value='' name='attachments[$attachment_id][post_title]' id='attachments[$attachment_id][post_title]' />";
	$send .= "<input type='hidden' value='' name='attachments[$attachment_id][url]' id='attachments[$attachment_id][url]' />";
	$send .= "<input type='hidden' value='' name='attachments[$attachment_id][post_excerpt]' id='attachments[$attachment_id][post_excerpt]' />";
	
	$form_fields['buttons'] = array( 'tr' => "\t\t<tr class='submit'><td></td><td class='savesend'>$send $delete</td></tr>\n" );
	
	return $form_fields;
}?>