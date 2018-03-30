<?php

//http://code.tutsplus.com/tutorials/how-to-create-custom-wordpress-writemeta-boxes--wp-20336



// CREATE

add_action( 'add_meta_boxes', 'post_options_meta_box_add' );

function post_options_meta_box_add()
{
    add_meta_box( 'post_options_meta_box', 'Post Options', 'post_options_meta_box_content', 'post', 'side', 'high' );
}

function post_options_meta_box_content()
{
    // $post is already set, and contains an object: the WordPress post
    global $post;
    $values = get_post_custom( $post->ID );
	$check = isset($values['post_featured_image_meta_box_check']) ? esc_attr($values['post_featured_image_meta_box_check'][0]) : 'on';
	$selected = isset($values['page_header_transparency']) ? esc_attr( $values['page_header_transparency'][0]) : '';
    ?>
         
    <p>
        <input type="checkbox" id="post_featured_image_meta_box_check" name="post_featured_image_meta_box_check" <?php checked( $check, 'on' ); ?> />
        <label for="post_featured_image_meta_box_check">Show Featured Image</label>
    </p>
    
    <p><strong>Header Transparency</strong></p>

    <p>
        <select name="page_header_transparency" id="page_header_transparency" style="width:100%">
            <option value="inherit" <?php selected( $selected, 'inherit' ); ?>>Inherit</option>
            <option value="transparency_light" <?php selected( $selected, 'transparency_light' ); ?>>Light</option>
            <option value="transparency_dark" <?php selected( $selected, 'transparency_dark' ); ?>>Dark</option>
            <option value="no_transparency" <?php selected( $selected, 'no_transparency' ); ?>>No Transparency</option>
        </select>
    </p>
    
    <?php
	
	// We'll use this nonce field later on when saving.
    wp_nonce_field( 'post_options_meta_box', 'post_options_meta_box_nonce' );
}




// SAVE

add_action( 'save_post', 'post_options_meta_box_save' );

function post_options_meta_box_save($post_id)
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['post_options_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['post_options_meta_box_nonce'], 'post_options_meta_box' ) ) return;
     
    // if our current user can't edit this post, bail
    if ( !current_user_can( 'edit_post', $post_id ) ) return;
	
	$chk = isset($_POST['post_featured_image_meta_box_check']) ? 'on' : 'off';
    update_post_meta( $post_id, 'post_featured_image_meta_box_check', $chk );
	
	if( isset( $_POST['page_header_transparency'] ) )
    update_post_meta( $post_id, 'page_header_transparency', esc_attr( $_POST['page_header_transparency'] ) );
}