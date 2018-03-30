<?php

//		CUSTOM POST TYPE
add_action("admin_init", "admin_init");
add_action('save_post', 'save_mypage_options');

function admin_init(){
	add_meta_box("mypagemeta", "Page Options", "my_write_panel", "page", "normal", "low");
}

function my_write_panel(){
	global $post;
	$custom = get_post_custom($post->ID);	
	$hidetitle = isset( $custom['hidetitle'][0] ) ? $custom["hidetitle"][0] : "";
	
	// We'll use this nonce field later on when saving.  
    wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' ); 
?>
<div class="form-wrap">
	
	<div class="form-field">
		<p><label for="hidetitle"><?php _e('Hide Page Heading?', 'circolare'); ?> :</label>
		<select name="hidetitle" style="width: 200px;">
			<option <?php if($hidetitle == "no") echo "selected"; ?> value="no">No</option>
			<option <?php if($hidetitle == "yes") echo "selected"; ?> value="yes">Yes</option>
		</select></p>
	</div>
	
</div>
<?php
}

function save_mypage_options($post_id){
	// Bail if we're doing an auto save  
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	
	// if our nonce isn't there, or we can't verify it, bail 
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
	
	// if our current user can't edit this post, bail  
    if( !current_user_can( 'edit_post' ) ) return;  
	
	if( isset( $_POST['hidetitle'] ) ) 
	update_post_meta($post_id, "hidetitle", $_POST["hidetitle"]);
}

?>