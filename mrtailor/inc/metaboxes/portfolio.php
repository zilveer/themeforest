<?php

//http://code.tutsplus.com/tutorials/how-to-create-custom-wordpress-writemeta-boxes--wp-20336



// CREATE

add_action( 'add_meta_boxes', 'portfolio_options_meta_box_add' );

function portfolio_options_meta_box_add()
{
    add_meta_box( 'portfolio_options_meta_box', 'Portfolio Item Options', 'portfolio_options_meta_box_content', 'portfolio', 'side', 'high' );
}

function portfolio_options_meta_box_content()
{
    // $post is already set, and contains an object: the WordPress post
    global $post;
    $values = get_post_custom( $post->ID );
	$check = isset($values['portfolio_title_meta_box_check']) ? esc_attr($values['portfolio_title_meta_box_check'][0]) : 'off';
	$portfolio_color_meta_box_value = isset($values['portfolio_color_meta_box']) ? esc_attr($values['portfolio_color_meta_box'][0]) : '';
	$selected = isset($values['page_header_transparency']) ? esc_attr( $values['page_header_transparency'][0]) : '';
    ?>
         
    <p>
        <input type="checkbox" id="portfolio_title_meta_box_check" name="portfolio_title_meta_box_check" <?php checked( $check, 'on' ); ?> />
        <label for="portfolio_title_meta_box_check">Hide Portfolio Item Title</label>
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
    
    <p>
        <label for="portfolio_color_meta_box"><strong>Portfolio Item Color</strong></label><br /><br />
        <input type="text" name="portfolio_color_meta_box" id="portfolio_color_meta_box" value="<?php echo esc_attr($portfolio_color_meta_box_value); ?>" />
    </p>
    
    <?php
	
	// We'll use this nonce field later on when saving.
    wp_nonce_field( 'portfolio_options_meta_box', 'portfolio_options_meta_box_nonce' );
}




// SAVE

add_action( 'save_post', 'portfolio_options_meta_box_save' );

function portfolio_options_meta_box_save($post_id)
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['portfolio_options_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['portfolio_options_meta_box_nonce'], 'portfolio_options_meta_box' ) ) return;
     
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post' ) ) return;
	
	$chk = isset($_POST['portfolio_title_meta_box_check']) ? 'on' : 'off';
    update_post_meta( $post_id, 'portfolio_title_meta_box_check', $chk );
	
	if( isset( $_POST['page_header_transparency'] ) )
    update_post_meta( $post_id, 'page_header_transparency', esc_attr( $_POST['page_header_transparency'] ) );
	
	if( isset( $_POST['portfolio_color_meta_box'] ) ) update_post_meta( $post_id, 'portfolio_color_meta_box', wp_kses($_POST['portfolio_color_meta_box'], wp_kses_allowed_html('post') ) );
}