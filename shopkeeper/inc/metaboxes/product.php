<?php

//http://code.tutsplus.com/tutorials/how-to-create-custom-wordpress-writemeta-boxes--wp-20336



// CREATE

add_action( 'add_meta_boxes', 'product_options_meta_box_add' );

function product_options_meta_box_add()
{
    add_meta_box( 'product_options_meta_box', 'Product Options', 'product_options_meta_box_content', 'product', 'side', 'high' );
}

function product_options_meta_box_content()
{
    // $post is already set, and contains an object: the WordPress post
    global $post;
    $values = get_post_custom( $post->ID );
    $check = isset($values['product_full_screen_description_meta_box_check']) ? esc_attr($values['product_full_screen_description_meta_box_check'][0]) : 'off';
    ?>
         
    <p>
        <input type="checkbox" id="product_full_screen_description_meta_box_check" name="product_full_screen_description_meta_box_check" <?php checked( $check, 'on' ); ?> />
        <label for="product_full_screen_description_meta_box_check">Fullscreen Description</label>
    </p>
    
    <?php
	
	// We'll use this nonce field later on when saving.
    wp_nonce_field( 'product_options_meta_box', 'product_options_meta_box_nonce' );
}




// SAVE

add_action( 'save_post', 'product_options_meta_box_save' );

function product_options_meta_box_save($post_id)
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['product_options_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['product_options_meta_box_nonce'], 'product_options_meta_box' ) ) return;
     
    // if our current user can't edit this post, bail
    if ( !current_user_can( 'edit_post', $post_id ) ) return;

    $chk = isset($_POST['product_full_screen_description_meta_box_check']) ? 'on' : 'off';
    update_post_meta( $post_id, 'product_full_screen_description_meta_box_check', $chk );
}