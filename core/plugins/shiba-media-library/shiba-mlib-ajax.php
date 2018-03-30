<?php
// don't load directly
if (!function_exists('is_admin')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

/**
 * Functions that support AJAX callbacks.
 *
 */
if (!class_exists("Shiba_Media_Ajax")) :
	 
class Shiba_Media_Ajax {

	function Shiba_Media_Ajax() {
		global $shiba_mlib;

		// Add attachment and gallery tags to tag box
		add_action('wp_ajax_shiba-get-tagcloud', array($this,'wp_ajax_get_tag_cloud'));

		// AJAX for Quick Edit button
		add_action('wp_ajax_shiba_media_quick_edit', array($this,'wp_ajax_update_media'));
		
		// AJAX for adding images in the Edit Gallery screen (WordPress 3.5 interface)
		add_action( 'wp_ajax_shiba-mlib-gallery-update', 
				   array($this,'wp_ajax_shiba_mlib_gallery_update'));
		
	}

	function wp_ajax_shiba_mlib_gallery_update() {
		global $shiba_mlib;
		if ( !isset( $_REQUEST['post_id'] ) || !isset( $_REQUEST['ids'] ))
			wp_send_json_error();

		if ( !($id = absint( $_REQUEST['post_id'] )) || !is_array($_REQUEST['ids']) )
			wp_send_json_error();
			
		check_ajax_referer( 'update-post_' . $id, 'nonce' );
		// Store ids
		update_post_meta($id, 'shiba_gallery_ids', $_REQUEST['ids']);

		$shiba_mlib->print_debug($_REQUEST);
		wp_send_json_success();
	}
	
	
	function wp_ajax_update_media() {
		global $wp_query, $shiba_mlib, $hook_suffix;

		check_ajax_referer( 'update-media', '_ajax_nonce-update-media' );
		
		$attachment_id = (int) $_POST['attachment_id'];

		if ( !current_user_can('edit_post', $attachment_id) )
			wp_die ( __('You are not allowed to edit this attachment.') );

		$hook_suffix = 'upload.php';
//		set_current_screen( esc_attr($_POST['screen']) );
		// Restructure data for media upload form handler
		foreach ($_POST as $key => $value) {
			if ( in_array($key, array('attachment_id', 'action', '_ajax_nonce-update-media','_wpnonce',  '_wp_http_referer')) )
				continue;
			$_POST['attachments'][$attachment_id][$key] = $value;
		}
		$errors = media_upload_form_handler();

		if (!class_exists("Shiba_Media_List_Table")) 
			require(SHIBA_MLIB_DIR.'shiba-media-table.php');
		$shiba_mlib->media_table = new Shiba_Media_List_Table();	
		
		if (isset($shiba_mlib->media_table)) {
		  	query_posts( "p={$attachment_id}&post_type=attachment" );
		  	ob_start();
  //			$wp_list_table->single_row( $attachment );
			  	$shiba_mlib->media_table->display_rows();
			  	$attachment_list_item = ob_get_contents();
		 	 ob_end_clean();
		}
		$x = new WP_Ajax_Response();
	
		$x->add( array(
			'what' => 'attachment',
			'id' => $attachment_id,
			'data' => $attachment_list_item
		));
	
		$x->send();
		
	}
	
	// From wp-admin/includes/ajax-actions.php
	function wp_ajax_get_tag_cloud() {
		if ( isset( $_POST['tax'] ) ) {
			$taxonomy = sanitize_key( $_POST['tax'] );
			$tax = get_taxonomy( 'post_tag' );
			if ( ! $tax )
				wp_die( 0 );
			if ( ! current_user_can( $tax->cap->assign_terms ) )
				wp_die( -1 );
		} else {
			wp_die( 0 );
		}
	  
		switch ($taxonomy) {
		  case 'post_tag-shiba_post':
			  $this->generate_tag_cloud('post');
			  break;
		  case 'post_tag-shiba_attachment':
			  $this->generate_tag_cloud('attachment');
			  break;
		  case 'post_tag-shiba_gallery':
			  $this->generate_tag_cloud('gallery');
			  break;
		}

	}
	
	
	function generate_tag_cloud($post_type) {
		global $wpdb;

		// database calls must be sensitive to multisite
		$query = $wpdb->prepare("SELECT ID FROM {$wpdb->posts} WHERE post_type = %s", $post_type);
		$attachment_ids = $wpdb->get_col($query);
		$terms = wp_get_object_terms($attachment_ids, 'post_tag', array('orderby' => 'count', 'order' => 'DESC'));
		$tags = array(); 
		// limit to 45 tags
		foreach ($terms as $term) {
			$tags[$term->term_id] = $term;	
			if (count($tags) >= 45) break;	
		}
	
		if ( empty( $tags ) )
			die( __('No tags found!') );
	
		if ( is_wp_error($tags) )
			die($tags->get_error_message());
	
		foreach ( $tags as $key => $tag ) {
			$tags[ $key ]->link = '#';
			$tags[ $key ]->id = $tag->term_id;
		}
	
		// We need raw tag names here, so don't filter the output
		$return = wp_generate_tag_cloud( $tags, array('filter' => 0) );
	
		if ( empty($return) )
			die('0');
	
		echo $return;
		exit;
	}

} // end class	
endif;
?>