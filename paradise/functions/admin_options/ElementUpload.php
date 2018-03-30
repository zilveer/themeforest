<?php
class ElementUpload extends ElementBase {

	public function __construct($page, $section, $params = array()) {
		if (!empty($params)) {
			if (!isset($params['id'])) {
				$params['id'] = $params['name'];
			}
			if (!isset($params['class'])) {
				$params['class'] = 'regular-text';
			}
			if (!isset($params['button_text'])) {
				$params['button_text'] = __('Insert image', TEMPLATENAME);
			}
		}
		parent::__construct($page, $section, $params);
	}

	public function render($args) {
		require(dirname(__FILE__) . '/template-upload.php');
	}

}


function option_image_upload_tabs ($tabs) {
	unset($tabs['type_url'], $tabs['gallery']);
	 return $tabs;
}

function option_image_form_url($form_action_url, $type){
	$form_action_url = $form_action_url.'&option_image_upload=1&target='.$_GET['target'];
	return $form_action_url;
}

function disable_option_flash_uploader($flash){
	return false;
}

function option_image_attachment_fields_to_edit($form_fields, $post){
	unset($form_fields);
	$filename = basename( $post->guid );
	$attachment_id = $post->ID;
	if ( current_user_can( 'delete_post', $attachment_id ) ) {
		if ( !EMPTY_TRASH_DAYS ) {
			$delete = "<a href='" . wp_nonce_url( "post.php?action=delete&amp;post=$attachment_id", 'delete-attachment_' . $attachment_id ) . "' id='del[$attachment_id]' class='delete'>" . __( 'Delete Permanently' , TEMPLATENAME ) . '</a>';
		} elseif ( !MEDIA_TRASH ) {
			$delete = "<a href='#' class='del-link' onclick=\"document.getElementById('del_attachment_$attachment_id').style.display='block';return false;\">" . __( 'Delete' , TEMPLATENAME ) . "</a>
			 <div id='del_attachment_$attachment_id' class='del-attachment' style='display:none;'>" . sprintf( __( 'You are about to delete <strong>%s</strong>.' , TEMPLATENAME ), $filename ) . "
			 <a href='" . wp_nonce_url( "post.php?action=delete&amp;post=$attachment_id", 'delete-attachment_' . $attachment_id ) . "' id='del[$attachment_id]' class='button'>" . __( 'Continue' , TEMPLATENAME ) . "</a>
			 <a href='#' class='button' onclick=\"this.parentNode.style.display='none';return false;\">" . __( 'Cancel' , TEMPLATENAME ) . "</a>
			 </div>";
		} else {
			$delete = "<a href='" . wp_nonce_url( "post.php?action=trash&amp;post=$attachment_id", 'trash-attachment_' . $attachment_id ) . "' id='del[$attachment_id]' class='delete'>" . __( 'Move to Trash' , TEMPLATENAME ) . "</a>
			<a href='" . wp_nonce_url( "post.php?action=untrash&amp;post=$attachment_id", 'untrash-attachment_' . $attachment_id ) . "' id='undo[$attachment_id]' class='undo hidden'>" . __( 'Undo' , TEMPLATENAME ) . "</a>";
		}
	} else {
		$delete = '';
	}
	$form_fields['buttons'] = array(
		'tr' => "\t\t<tr><td></td><td><input type='button' class='button' onclick='mediaUploader.OptionUploaderUseThisImage(".$post->ID.",\"". $_GET['target']."\")' value='" . __( 'Use this' , TEMPLATENAME ) . "' /> $delete</td></tr>\n"
	);
	return $form_fields;
}

function option_image_upload_init(){
	add_filter('flash_uploader', 'disable_option_flash_uploader');
	add_filter('media_upload_tabs', 'option_image_upload_tabs');
	add_filter('attachment_fields_to_edit', 'option_image_attachment_fields_to_edit', 10, 2);
	add_filter('media_upload_form_url', 'option_image_form_url', 10, 2);
	wp_enqueue_script('media-uploader', get_bloginfo('template_directory') . '/functions/admin_options/js/media-uploader.js');
}

if (isset($_GET['option_image_upload']) || isset($_POST['option_image_upload'])) {
	add_action('admin_init', 'option_image_upload_init');
}

function option_get_image_action_callback() {
	$original = wp_get_attachment_image_src($_POST['id'],'full');
	if (! empty($original)) {
		echo $original[0];
	} else {
		die(0);
	}
	die();
}



function rt_image_attachment_fields_to_edit($form_fields, $post) {
    
  /*---------------------------------*/
   
		unset($form_fields);
	$filename = basename( $post->guid );
	$attachment_id = $post->ID;
	if ( current_user_can( 'delete_post', $attachment_id ) ) {
		if ( !EMPTY_TRASH_DAYS ) {
			$delete = "<a href='" . wp_nonce_url( "post.php?action=delete&amp;post=$attachment_id", 'delete-attachment_' . $attachment_id ) . "' id='del[$attachment_id]' class='delete'>" . __( 'Delete Permanently' , TEMPLATENAME ) . '</a>';
		} elseif ( !MEDIA_TRASH ) {
			$delete = "<a href='#' class='del-link' onclick=\"document.getElementById('del_attachment_$attachment_id').style.display='block';return false;\">" . __( 'Delete' , TEMPLATENAME ) . "</a>
			 <div id='del_attachment_$attachment_id' class='del-attachment' style='display:none;'>" . sprintf( __( 'You are about to delete <strong>%s</strong>.' , TEMPLATENAME ), $filename ) . "
			 <a href='" . wp_nonce_url( "post.php?action=delete&amp;post=$attachment_id", 'delete-attachment_' . $attachment_id ) . "' id='del[$attachment_id]' class='button'>" . __( 'Continue' , TEMPLATENAME ) . "</a>
			 <a href='#' class='button' onclick=\"this.parentNode.style.display='none';return false;\">" . __( 'Cancel' , TEMPLATENAME ) . "</a>
			 </div>";
		} else {
			$delete = "<a href='" . wp_nonce_url( "post.php?action=trash&amp;post=$attachment_id", 'trash-attachment_' . $attachment_id ) . "' id='del[$attachment_id]' class='delete'>" . __( 'Move to Trash' , TEMPLATENAME ) . "</a>
			<a href='" . wp_nonce_url( "post.php?action=untrash&amp;post=$attachment_id", 'untrash-attachment_' . $attachment_id ) . "' id='undo[$attachment_id]' class='undo hidden'>" . __( 'Undo' , TEMPLATENAME ) . "</a>";
		}
	} else {
		$delete = '';
	}
	$form_fields['buttons'] = array(
		'tr' => "\t\t<tr><td></td><td><input type='button' class='button' onclick='mediaUploader.OptionUploaderUseThisImage(".$post->ID.",\"". $_GET['target']."\")' value='" . __( 'Use this' , TEMPLATENAME ) . "' />$delete</td></tr>\n"
	);
	return $form_fields;
	
}
// now attach our function to the hook
add_filter("attachment_fields_to_edit", "rt_image_attachment_fields_to_edit", null, 2);



add_action('wp_ajax_theme-option-get-image', 'option_get_image_action_callback');

?>
