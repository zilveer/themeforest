<?php

/*-----------------------------------------------------------------------------------*/
/* Slider Custom Metabox for Images */
/*-----------------------------------------------------------------------------------*/

function eq_slider_img_settings_metabox() {
	
	global $post;
	$slide_img_src = get_post_meta( $post->ID, 'slide-img-src', true );
	$slide_img_href = get_post_meta( $post->ID, 'slide-img-href', true );

?>
	<?php // Use nonce for verification ?>
    <input type="hidden" name="slider_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>" />
    
	<table class="form-table meta-box">
		<tr>
			<th><label for="slide-img-src"><?php _e( "Image", 'onioneye' ); ?></label></th>
			
			<td>
				<input id="slide-img-src" class="upload" type="text" name="slide-img-src" value="<?php echo $slide_img_src; ?>" />
				<input id="slide-img-uploader" class="upload_button button" type="button" value="<?php _e( 'Browse', 'onioneye' ); ?>" />
				<br />
				<p>
					<?php _e( 'Upload an image here to have it displayed as a slide. The image should not be smaller than 940 pixels in width.', 'onioneye' ); ?>
				</p>
			</td>
		</tr>
		
		<tr>
			<th><label for="slide-img-href"><?php _e( "Slide URL", 'onioneye' ); ?></label></th>
			<td><input id="slide-img-href" type="text" name="slide-img-href" value="<?php echo $slide_img_href; ?>" />
				<br />
				<p>
				<?php _e( "An optional, custom URL for the slide's image.", 'onioneye' ); ?>
				</p>
			</td>	
		</tr>
	</table>
<?php
}

/*-----------------------------------------------------------------------------------*/
/* Slider Custom Metabox for Videos */
/*-----------------------------------------------------------------------------------*/

function eq_slider_video_settings_metabox() {

	global $post;
	$video_embed_code = get_post_meta( $post->ID, 'slide-video-embed', true );

?>
	<?php // Use nonce for verification ?>
    <input type="hidden" name="slider_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>" />
    
	<table class="form-table meta-box">
		<tr>
			<th><label for="slide-video-embed"><?php _e("Video Embed Code:", 'onioneye'); ?></label></th>
			<td><textarea id="slide-video-embed" cols="60" rows="3" name="slide-video-embed"><?php echo $video_embed_code; ?></textarea>
				<br />
				<p>
				<?php _e( 'Add the video embed code, generated on the site the video is hosted on, to have a video displayed as your slide, instead of an image, or other custom content. The width of the video should be set at 940 pixels.', 'onioneye' ); ?>
				</p>
			</td>
		</tr>
	</table>
<?php
}

/*-----------------------------------------------------------------------------------*/
/* Process the custom metabox fields */
/*-----------------------------------------------------------------------------------*/

function save_slider_metabox_values( $post_id ) {
	global $post;
	
	//Verify nonce
    if ( !wp_verify_nonce( $_POST['slider_meta_box_nonce'], basename(__FILE__) ) ) {
        return $post_id;
    }
	
	//skip auto save
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
	
	//Check permissions
    if ( 'page' == $_POST['post_type'] ) {
        if ( !current_user_can( 'edit_page', $post_id ) ) {
            return $post_id;
        }
    } elseif ( !current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;
    }
	
	//check for slider post type only
    if( $post->post_type == "slider" ) {
        if( isset($_POST['slide-img-src']) ) { update_post_meta( $post->ID, 'slide-img-src', stripslashes( htmlspecialchars( esc_url( $_POST['slide-img-src'] ) ) ) ); }
        if( isset($_POST['slide-img-href']) ) { update_post_meta( $post->ID, 'slide-img-href', stripslashes( htmlspecialchars( esc_url( $_POST['slide-img-href'] ) ) ) ); }
		if( isset($_POST['slide-video-embed']) ) { update_post_meta( $post->ID, 'slide-video-embed', stripslashes( htmlspecialchars( $_POST['slide-video-embed'] ) ) ); }
    }	
}

// Add action hooks. Without these we are lost
add_action( 'admin_init', 'add_custom_slider_metabox' );
add_action( 'save_post', 'save_slider_metabox_values' );


/*-----------------------------------------------------------------------------------*/
/* Add the meta boxes */
/*-----------------------------------------------------------------------------------*/

function add_custom_slider_metabox() {

	add_meta_box( 'slider-img-settings-metabox', __("Image Settings", 'onioneye'), 'eq_slider_img_settings_metabox', 'slider', 'normal', 'high' );
	add_meta_box( 'slider-video-settings-metabox', __("Video Settings", 'onioneye'), 'eq_slider_video_settings_metabox', 'slider', 'normal', 'high' );
	
}

