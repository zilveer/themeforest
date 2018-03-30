<?php

function option_image_upload_tabs ($tabs) {
	unset($tabs['type_url']);
    return $tabs;
}

function option_image_form_url($form_action_url, $type){
	$form_action_url = $form_action_url.'&option_image_upload=1&target='.$_GET['target'];
	return $form_action_url;
}
function option_type_url_form_media(){
	return '
	<p class="media-types"><input type="hidden" name="media_type" value="image" id="image-only" value="1" /></p>
	<table class="describe"><tbody>
		<tr>
			<th valign="top" scope="row" class="label" style="width:130px;">
				<span class="alignleft"><label for="src">' . __('URL','theme_admin') . '</label></span>
				<span class="alignright"><abbr id="status_img" title="required" class="required">*</abbr></span>
			</th>
			<td class="field"><input id="src" name="src" value="" type="text" aria-required="true" onblur="addExtImage.getImageData()" /></td>
		</tr>

		<tr>
			<th valign="top" scope="row" class="label">
				<span class="alignleft"><label for="title">' . __('Title','theme_admin') . '</label></span>
				<span class="alignright"><abbr title="required" class="required">*</abbr></span>
			</th>
			<td class="field"><input id="title" name="title" value="" type="text" aria-required="true" /></td>
		</tr>
		<tr class="image-only">
			<td></td>
			<td>
				<input type="button" class="button" id="go_button" style="color:#bbb;" onclick="mediaUploader.OptionUploaderImageByUrl(\''. $_REQUEST['target'].'\')" value="' . __( 'Use this' , 'theme_admin' ) . '" />
			</td>
		</tr>
	</tbody></table>
';
}

function option_image_attachment_fields_to_edit($form_fields, $post){
	unset($form_fields['align']);
	unset($form_fields['image-size']);
	$filename = basename( $post->guid );
	$attachment_id = $post->ID;
	if ( current_user_can( 'delete_post', $attachment_id ) ) {
		if ( !EMPTY_TRASH_DAYS ) {
			$delete = "<a href='" . wp_nonce_url( "post.php?action=delete&amp;post=$attachment_id", 'delete-attachment_' . $attachment_id ) . "' id='del[$attachment_id]' class='delete'>" . __( 'Delete Permanently' , 'theme_admin' ) . '</a>';
		} elseif ( !MEDIA_TRASH ) {
			$delete = "<a href='#' class='del-link' onclick=\"document.getElementById('del_attachment_$attachment_id').style.display='block';return false;\">" . __( 'Delete' , 'theme_admin' ) . "</a>
			 <div id='del_attachment_$attachment_id' class='del-attachment' style='display:none;'>" . sprintf( __( 'You are about to delete <strong>%s</strong>.' , 'theme_admin' ), $filename ) . "
			 <a href='" . wp_nonce_url( "post.php?action=delete&amp;post=$attachment_id", 'delete-attachment_' . $attachment_id ) . "' id='del[$attachment_id]' class='button'>" . __( 'Continue' , 'theme_admin' ) . "</a>
			 <a href='#' class='button' onclick=\"this.parentNode.style.display='none';return false;\">" . __( 'Cancel' , 'theme_admin' ) . "</a>
			 </div>";
		} else {
			$delete = "<a href='" . wp_nonce_url( "post.php?action=trash&amp;post=$attachment_id", 'trash-attachment_' . $attachment_id ) . "' id='del[$attachment_id]' class='delete'>" . __( 'Move to Trash' , 'theme_admin' ) . "</a>
			<a href='" . wp_nonce_url( "post.php?action=untrash&amp;post=$attachment_id", 'untrash-attachment_' . $attachment_id ) . "' id='undo[$attachment_id]' class='undo hidden'>" . __( 'Undo' , 'theme_admin' ) . "</a>";
		}
	} else {
		$delete = '';
	}
	$form_fields['buttons'] = array( 
		'tr' => "\t\t<tr><td></td><td><input type='button' class='button' onclick='mediaUploader.OptionUploaderImageByAttachmentId(".$post->ID.",\"". $_REQUEST['target']."\")' value='" . __( 'Use this' , 'theme_admin' ) . "' /> $delete</td></tr>\n"
	);
	return $form_fields;
}
function option_image_swfupload_post_params($params){
	$params['option_image_upload']=1;
	$params['target']=$_REQUEST['target'];
	return $params;
}
function option_image_upload_post_params($params){
	$params['option_image_upload']=1;
	$params['target']=$_REQUEST['target'];
	unset($params['short']);
	return $params;
}
function option_image_swfupload_success_handler($handler){
	return 'optionImageUploadSuccess';
}
function option_image_upload_init(){
	//add_filter('media_upload_tabs', 'option_image_upload_tabs');
	add_filter('attachment_fields_to_edit', 'option_image_attachment_fields_to_edit', 10, 2);
	add_filter('media_upload_form_url', 'option_image_form_url', 10, 2);
	add_filter('type_url_form_media', 'option_type_url_form_media', 10, 2); /* wordpree > 3.3 */
	add_filter('type_url_form_file', 'option_type_url_form_media', 10, 2); /* wordpree < 3.3 */
	wp_enqueue_script('theme-mediaUploader', THEME_ADMIN_ASSETS_URI . '/js/mediaUploader.js');
	add_filter('upload_post_params', 'option_image_upload_post_params');
	add_filter('swfupload_post_params', 'option_image_swfupload_post_params');
	add_filter('swfupload_success_handler','option_image_swfupload_success_handler');
}

if (isset($_GET['option_image_upload']) || isset($_POST['option_image_upload'])) {
	add_action('admin_init', 'option_image_upload_init');
}

//option insert image ajax action callback
function option_get_image_by_attachment_id() {
	$original = wp_get_attachment_image_src($_POST['id'],'full');
	if (! empty($original)) {
		echo json_encode(array(
			'src'=> $original[0],
			'width' => $original[1],
			'height' => $original[2],
		));
	} else {
		die(0);
	}
	die();
}
add_action('wp_ajax_theme-option-get-image-by-attachment-id', 'option_get_image_by_attachment_id');

//option insert image ajax action callback
function option_get_image_by_url() {
	$src = $_POST['src'];
	if (! empty($src)) {
		echo json_encode(array(
			'src'=> $src,
			'title' =>isset($_POST['title'])?$_POST['title']:''
		));
	} else {
		die(0);
	}
	die();
}
add_action('wp_ajax_theme-option-get-image-by-url', 'option_get_image_by_url');
