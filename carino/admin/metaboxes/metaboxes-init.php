<?php
/**
* MetaBoxes Init.
*
* @author : VanThemes ( http://www.vanthemes.com )
* 
*/
require VAN_META . "/meta-options.php";
require VAN_META . "/metaboxes.class.php";

$meta_fields = new vanMetaFields();

/*
*  Add meta box
******************************************/

add_action('admin_init', 'van_boxes_init');
function van_boxes_init() {
	add_meta_box("Post_options", THEME_NAME ." - Post Options", 'van_post_options', "post", "normal", "high");
	add_meta_box("Post_options", THEME_NAME ." - Page Options", 'van_page_options', "page", "normal", "high");
}

/*
* Post Options Render
**************************************/

function van_post_options(){
	global $post,$post_options,$meta_fields;
	?>
	<input type="hidden" name="van_metabox_nonce" value="<?php echo wp_create_nonce(basename(__FILE__)); ?>" />
	<div class="van-post-options">
	<?php
		foreach($post_options as $field){
			$meta_fields->van_meta_fields($field);
		}
	?>
	</div> <!-- .van-fields -->
        <?php 
}

/*
* Page Options Render
**************************************/

function van_page_options(){
	global $post,$page_options,$meta_fields;
	?>
	<input type="hidden" name="van_metabox_nonce" value="<?php echo wp_create_nonce(basename(__FILE__)); ?>" />
	<div class="van-fields">
	<?php
	foreach($page_options as $field){
		$meta_fields->van_meta_fields($field);;
	}
	?>
	</div> <!-- .van-fields -->
	<?php  
}

/*
* Save Options
**************************************/

add_action('save_post', 'van_save_data');
function van_save_data($post_id) {

	global $post_options,$page_options;

	if ( !isset( $_POST['van_metabox_nonce'] ) || !wp_verify_nonce($_POST['van_metabox_nonce'], basename(__FILE__)) ){
		return $post_id;
	}

	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
		return $post_id;
	}
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)){
			return $post_id;
		}else{
			foreach ($page_options as $meta_value) {
				if ( isset( $meta_value['id'] ) ) {

					if ( isset($_POST[$meta_value['id']]) and !empty($_POST[$meta_value['id']])) {
						update_post_meta($post_id, $meta_value['id'], $_POST[$meta_value['id']] );
					}else {
						delete_post_meta($post_id, $meta_value['id']);
					}
				}
			}
		}
	} else {
		if(!current_user_can('edit_post', $post_id)){
			return $post_id;
		}else{
			foreach ($post_options as $meta_value) {
				if ( isset( $meta_value['id'] ) ) {
					if ( isset($_POST[$meta_value['id']]) and !empty($_POST[$meta_value['id']])){
						update_post_meta($post_id, $meta_value['id'], $_POST[$meta_value['id']] );
					}else{
						delete_post_meta($post_id, $meta_value['id']);
					}
				}
			}
		}
	}
}