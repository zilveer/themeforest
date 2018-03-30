<?php

function gallery_image_upload_tabs ($tabs) {
	unset($tabs['type_url']);
	return $tabs;
}

function gallery_image_form_url($form_action_url, $type){
	$form_action_url = $form_action_url.'&gallery_image_upload=1';
	return $form_action_url;
}
function gallery_image_swfupload_post_params($params){
	$params['gallery_image_upload']=1;
	return $params;
}
function gallery_image_swfupload_success_handler($handler){
	return 'galleryImageUploadSuccess';
}

function gallery_image_attachment_fields_to_edit($form_fields, $post){

	unset($form_fields['url'], $form_fields['align'], $form_fields['image-size']);
	$filename = basename( $post->guid );
	$attachment_id = $post->ID;
	if ( current_user_can( 'delete_post', $attachment_id ) ) {
		if ( !EMPTY_TRASH_DAYS ) {
			$delete = "<a href='" . wp_nonce_url( "post.php?action=delete&amp;post=$attachment_id", 'delete-attachment_' . $attachment_id ) . "' id='del[$attachment_id]' class='delete'>" . __('Delete Permanently','theme_admin') . '</a>';
		} elseif ( !MEDIA_TRASH ) {
			$delete = "<a href='#' class='del-link' onclick=\"document.getElementById('del_attachment_$attachment_id').style.display='block';return false;\">" . __('Delete','theme_admin') . "</a>
			 <div id='del_attachment_$attachment_id' class='del-attachment' style='display:none;'>" . sprintf( __('You are about to delete <strong>%s</strong>.','theme_admin'), $filename ) . "
			 <a href='" . wp_nonce_url( "post.php?action=delete&amp;post=$attachment_id", 'delete-attachment_' . $attachment_id ) . "' id='del[$attachment_id]' class='button'>" . __('Continue','theme_admin') . "</a>
			 <a href='#' class='button' onclick=\"this.parentNode.style.display='none';return false;\">" . __('Cancel','theme_admin') . "</a>
			 </div>";
		} else {
			$delete = "<a href='" . wp_nonce_url( "post.php?action=trash&amp;post=$attachment_id", 'trash-attachment_' . $attachment_id ) . "' id='del[$attachment_id]' class='delete'>" . __('Move to Trash','theme_admin') . "</a>
			<a href='" . wp_nonce_url( "post.php?action=untrash&amp;post=$attachment_id", 'untrash-attachment_' . $attachment_id ) . "' id='undo[$attachment_id]' class='undo hidden'>" . __('Undo','theme_admin') . "</a>";
		}
	} else {
		$delete = '';
	}
	
	$form_fields['buttons'] = array( 
		'tr' => "\t\t<tr><td></td><td><input type='button' class='button' onclick='themeImageInsertIntoGallery(".$post->ID.")' value='" . esc_attr__('Insert into Gallery','theme_admin') . "' /> $delete<input type='hidden' value='".$post->ID."' name='gallery_image_ids[]'></td></tr>\n"
	);
	return $form_fields;
}

function gallery_image_upload_init(){
	add_filter('media_upload_tabs', 'gallery_image_upload_tabs');
	add_filter('attachment_fields_to_edit', 'gallery_image_attachment_fields_to_edit', 10, 2);
	add_filter('media_upload_form_url', 'gallery_image_form_url', 10, 2);

	wp_register_script('theme-gallery-image-upload', THEME_ADMIN_ASSETS_URI . '/js/gallery-image-upload.js');
	wp_enqueue_script('theme-gallery-image-upload');
	add_filter('swfupload_post_params', 'gallery_image_swfupload_post_params');
	add_filter('swfupload_success_handler','gallery_image_swfupload_success_handler');
}

add_action('admin_init', 'gallery_image_upload_init');
