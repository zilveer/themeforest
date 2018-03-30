<?php
if (!function_exists('is_admin')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

if (!class_exists("Shiba_Media_Library_QEdit")) :

class Shiba_Media_Library_QEdit {
	var $inline_edit_args = array( 'toggle' => false, 'send' => false, 'delete' => false, 'show_title' => false, 'errors' => null );

	function Shiba_Media_Library_QEdit() {
		// For Quick Edit functionality
		wp_enqueue_style( 'imgareaselect' ); // needed for cropping
		wp_enqueue_script('image-edit');
		
//		wp_enqueue_style( 'media' ); // handles radio button layout
//		wp_enqueue_script('plupload-handlers'); // handles the link button presses in qe form
		wp_enqueue_script('shiba-mlib-qe', SHIBA_MLIB_URL.'js/shiba-mlib-qe.dev.js', array(), '1.1', true);
		add_filter( 'media_row_actions', array($this,'expanded_media_actions'), 10, 2);
	}
		

	function expanded_media_actions($actions, $post ) {
		global $shiba_mlib;
		
		$type = get_post_mime_type($post->ID);
		if (strpos($type, 'image') !== FALSE) {
  			$actions['quickedit'] = '<a onclick="shibaAttachmentQE.open('.$post->ID.');return false;" class="vim-q" title="'.esc_attr__( 'Quick Edit' ).'" href="#">' . __( 'Quick&nbsp;Edit' ) . '</a>';
		
			// Extra input values for Quick Edit menu
			$shiba_mlib->qedit->inline_edit_fields($post->ID);
		}
		return $actions;
		
	}

	function process_inline_edit_form($form) {	
		global $shiba_mlib;
		// Get the id on form
//		$id = $shiba_mlib->substring($form, 'thumbnail-head', '\'');
		// Remove all ids
//		$form = str_replace($id, '', $form);

		// Add unique class to -
		// media-head thumbnail-head media-dims imgedit-open-btn image-editor
		$form = str_replace("id='imgedit-open-btn", "class='shiba-imgedit-open-btn' id='imgedit-open-btn", $form);
		$form = str_replace("class='image-editor'", "class='shiba-image-editor image-editor'", $form);

		return $form;
	}
	
	
	function inline_edit_fields($attachment_id) { 
		$post = get_post( $attachment_id );
		if (!is_object($post)) return;
		$attachment_id = $post->ID;
		$attachment_url = get_permalink( $post->ID );
		$filename = esc_html( basename( $post->guid ) );
		$title = esc_attr( $post->post_title );
		if ( $thumb_url = wp_get_attachment_image_src( $post->ID, 'thumbnail', true ) )
			$thumb_url = $thumb_url[0];
		else
			$thumb_url = false;

		$meta = wp_get_attachment_metadata( $post->ID );
		$media_dims = '';
		if ( is_array( $meta ) && array_key_exists( 'width', $meta ) && array_key_exists( 'height', $meta ) )
			$media_dims = "<span id='media-dims-{$post->ID}'>{$meta['width']}&nbsp;&times;&nbsp;{$meta['height']}</span> ";
		$media_dims = apply_filters( 'media_meta', $media_dims, $post );

		$file_info = "<p><strong>" . __('File name:') . "</strong> $filename</p>
			<p><strong>" . __('File type:') . "</strong> $post->post_mime_type</p>
		<p><strong>" . __('Upload date:') . "</strong> " . mysql2date( get_option('date_format'), $post->post_date ). '</p>';
		if ( !empty( $media_dims ) )
			$file_info .= "<p><strong>" . __('Dimensions:') . "</strong> $media_dims</p>\n";

		if (  wp_image_editor_supports( array( 'mime_type' => $post->post_mime_type ) )) {
//											  gd_edit_image_support( $post->post_mime_type ) ) {
			$nonce = wp_create_nonce( "image_editor-$post->ID" );
			$image_edit_button = "imageEdit.open( $post->ID, \"$nonce\" )";
		}
		
		// This filter prevents the align, and image_size buttons from showing.
		// These buttons are used for image insertion and does not apply for edits.
		add_filter('attachment_fields_to_edit', 'media_single_attachment_fields_to_edit', 10, 2);
		$errors = NULL;
 		$form_fields = get_attachment_fields_to_edit( $post, $errors );
		remove_filter('attachment_fields_to_edit', 'media_single_attachment_fields_to_edit', 10, 2);
		?>
		<div id="inline-<?php echo $post->ID;?>" class="hidden">
          	<div class="id"><?php echo $post->ID;?></div>
          	<div class="attachment_url"><?php echo $attachment_url;?></div>
          	<div class="thumb_url"><?php echo $thumb_url;?></div>
          	<div class="file_info"><?php echo $file_info;?></div>
          	<div class="image_edit_button"><?php echo $image_edit_button;?></div>
			<?php // Render form fields
			foreach ($form_fields as $id => $field) {
				if (isset($field['input']) && ($field['input'] == 'html')) {
					// Change string so that we are not inserting input elements 
					// which causes URL too long error.
					$newStr = str_replace('<', '+', $field['html']);
					$newStr = str_replace('>', '-', $newStr);
					echo "<div class=\"{$id} is-html\">{$newStr}</div>\n"; // {$field['html']}
				} else	
					echo "<div class=\"{$id}\">{$field['value']}</div>\n";
			}
			?>
 		</div>
		<?php 
		
	}
	
	function render_inline_edit_form($id=0, $col_count=1, $table_row=TRUE) {
		
		$form_class = 'media-upload-form'; //type-form validate
		
		// Form from wp-admin/media.php
		?>
		<form method="post" id="shiba-media-upload-form" action="" id="media-single-form">
		<?php if ( $table_row ) : ?>
			<table style="display:none;"><tbody id="att-reply"><tr id="attrow" class="<?php echo $form_class;?>" style="display:none;"><td colspan="<?php echo $col_count; ?>">
		<?php else : ?>
			<div id="att-reply" style="display:none;"><div id="attrow" style="display:none;">
		<?php endif; ?>

		<div class="media-single">
		<div id='media-item-<?php echo $id; ?>' class='media-item'>
        <?php 
			// no link URL, alignment, or image_size
			add_filter('attachment_fields_to_edit', 'media_single_attachment_fields_to_edit', 10, 2);
			$form = get_media_item($id, $this->inline_edit_args); 
			remove_filter('attachment_fields_to_edit', 'media_single_attachment_fields_to_edit', 10, 2);
			$form = $this->process_inline_edit_form($form);
			echo $form;
		?>
        </div>
        </div>
        
        <p id="replysubmit" class="submit">
        <a href="#" class="cancel button-secondary alignleft"><?php _e('Cancel'); ?></a>
        
        <a href="#" class="save button-primary alignright"> 
        <span id="savebtn"><?php _e('Update Image'); ?></span></a>
        <img class="waiting" style="display:none;" src="<?php echo esc_url( admin_url( 'images/wpspin_light.gif' ) ); ?>" alt="" />
        <span class="error" style="display:none;"></span>
        <br class="clear" /> 
        </p><br/>
		<?php if ( $table_row ) : ?>
			</td></tr></tbody></table>
		<?php else : ?>
			</div></div>
		<?php endif; ?>
        
        <input type="hidden" name="attachment_id" id="attachment_id" value="<?php echo esc_attr($id); ?>" />
        <input type="hidden" name="action" value="shiba_media_quick_edit" />
        <?php wp_nonce_field( 'update-media', '_ajax_nonce-update-media', false ); ?>
        <?php wp_nonce_field('media-form'); ?>
		</form>
 		<?php
	}


} // end Shiba_Widget_QEdit class
endif;

?>