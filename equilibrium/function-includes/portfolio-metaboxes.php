<?php

/*-----------------------------------------------------------------------------------*/
/* Portfolio Custom Metabox For Images */
/*-----------------------------------------------------------------------------------*/

function eq_image_settings_portfolio_metabox() {
	
	global $post;
	
	$preview_img = get_post_meta( $post->ID, 'portfolio-preview-img', true );
	$img1 = get_post_meta( $post->ID, 'portfolio-image-1', true );
	$img2 = get_post_meta( $post->ID, 'portfolio-image-2', true );
	$img3 = get_post_meta( $post->ID, 'portfolio-image-3', true );
	$img4 = get_post_meta( $post->ID, 'portfolio-image-4', true );
	$img5 = get_post_meta( $post->ID, 'portfolio-image-5', true );
	$img6 = get_post_meta( $post->ID, 'portfolio-image-6', true );
	$img7 = get_post_meta( $post->ID, 'portfolio-image-7', true );
	$img8 = get_post_meta( $post->ID, 'portfolio-image-8', true );
	$img9 = get_post_meta( $post->ID, 'portfolio-image-9', true );
	$img10 = get_post_meta( $post->ID, 'portfolio-image-10', true );
	
	?>
	
	<?php // Use nonce for verification ?>
    <input type="hidden" name="portfolio_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>" />
    
    <table class="form-table meta-box">
		<tr>
			<th><label for="portfolio-preview-img"><?php _e( "Preview Image:", 'onioneye' ); ?></label></th>
			<td>
				<input id="portfolio-preview-img" class="upload" type="text" name="portfolio-preview-img" value="<?php echo $preview_img; ?>" />
				<input id="portfolio-preview-img-uploader" class="upload_button button" type="button" value="<?php _e( 'Browse', 'onioneye' ); ?>" />
				<br />
				<p>
					<?php _e( "Minimum image dimensions: 218 x 175 for a portfolio template with four columns per row; 306 x 210 for a template with three columns per row; 460 x 330 for a two-columned template.", 'onioneye' ); ?>
				</p>
			</td>
		</tr>
		
		<tr>
			<th><label for="portfolio-image-1"><?php _e( "Image 1:", 'onioneye' ); ?></label></th>
			<td>
				<input id="portfolio-image-1" class="upload" type="text" name="portfolio-image-1" value="<?php echo $img1; ?>" />
				<input id="portfolio-image-1-uploader" class="upload_button button" type="button" value="<?php _e( 'Browse', 'onioneye' ); ?>" />
				<br />
				<p>
					<?php _e( 'Image dimensions best at 680 x unlimited.', 'onioneye' ); ?>
				</p>
			</td>
		</tr>
		
		<tr>
			<th><label for="portfolio-image-2"><?php _e( "Image 2:", 'onioneye' ); ?></label></th>
			<td>
				<input id="portfolio-image-2" class="upload" type="text" name="portfolio-image-2" value="<?php echo $img2; ?>" />
				<input id="portfolio-image-2-uploader" class="upload_button button" type="button" value="<?php _e( 'Browse', 'onioneye' ); ?>" />
				<br />
				<p>
					<?php _e( 'Image dimensions best at 680 x unlimited.', 'onioneye' ); ?>
				</p>
			</td>
		</tr>
		
		<tr>
			<th><label for="portfolio-image-3"><?php _e( "Image 3:", 'onioneye' ); ?></label></th>
			<td>
				<input id="portfolio-image-3" class="upload" type="text" name="portfolio-image-3" value="<?php echo $img3; ?>" />
				<input id="portfolio-image-3-uploader" class="upload_button button" type="button" value="<?php _e( 'Browse', 'onioneye' ); ?>" />
				<br />
				<p>
					<?php _e( 'Image dimensions best at 680 x unlimited.', 'onioneye' ); ?>
				</p>
			</td>
		</tr>
		
		<tr>
			<th><label for="portfolio-image-4"><?php _e( "Image 4:", 'onioneye' ); ?></label></th>
			<td>
				<input id="portfolio-image-4" class="upload" type="text" name="portfolio-image-4" value="<?php echo $img4; ?>" />
				<input id="portfolio-image-4-uploader" class="upload_button button" type="button" value="<?php _e( 'Browse', 'onioneye' ); ?>" />
				<br />
				<p>
					<?php _e( 'Image dimensions best at 680 x unlimited.', 'onioneye' ); ?>
				</p>
			</td>
		</tr>
		
		<tr>
			<th><label for="portfolio-image-5"><?php _e( "Image 5:", 'onioneye' ); ?></label></th>
			<td>
				<input id="portfolio-image-5" class="upload" type="text" name="portfolio-image-5" value="<?php echo $img5; ?>" />
				<input id="portfolio-image-5-uploader" class="upload_button button" type="button" value="<?php _e( 'Browse', 'onioneye' ); ?>" />
				<br />
				<p>
					<?php _e( 'Image dimensions best at 680 x unlimited.', 'onioneye' ); ?>
				</p>
			</td>
		</tr>
		
		<tr>
			<th><label for="portfolio-image-6"><?php _e( "Image 6:", 'onioneye' ); ?></label></th>
			<td>
				<input id="portfolio-image-6" class="upload" type="text" name="portfolio-image-6" value="<?php echo $img6; ?>" />
				<input id="portfolio-image-6-uploader" class="upload_button button" type="button" value="<?php _e( 'Browse', 'onioneye' ); ?>" />
				<br />
				<p>
					<?php _e( 'Image dimensions best at 680 x unlimited.', 'onioneye' ); ?>
				</p>
			</td>
		</tr>
		
		<tr>
			<th><label for="portfolio-image-7"><?php _e( "Image 7:", 'onioneye' ); ?></label></th>
			<td>
				<input id="portfolio-image-7" class="upload" type="text" name="portfolio-image-7" value="<?php echo $img7; ?>" />
				<input id="portfolio-image-7-uploader" class="upload_button button" type="button" value="<?php _e( 'Browse', 'onioneye' ); ?>" />
				<br />
				<p>
					<?php _e( 'Image dimensions best at 680 x unlimited.', 'onioneye' ); ?>
				</p>
			</td>
		</tr>
		
		<tr>
			<th><label for="portfolio-image-8"><?php _e( "Image 8:", 'onioneye' ); ?></label></th>
			<td>
				<input id="portfolio-image-8" class="upload" type="text" name="portfolio-image-8" value="<?php echo $img8; ?>" />
				<input id="portfolio-image-8-uploader" class="upload_button button" type="button" value="<?php _e( 'Browse', 'onioneye' ); ?>" />
				<br />
				<p>
					<?php _e( 'Image dimensions best at 680 x unlimited.', 'onioneye' ); ?>
				</p>
			</td>
		</tr>
		
		<tr>
			<th><label for="portfolio-image-9"><?php _e( "Image 9:", 'onioneye' ); ?></label></th>
			<td>
				<input id="portfolio-image-9" class="upload" type="text" name="portfolio-image-9" value="<?php echo $img9; ?>" />
				<input id="portfolio-image-9-uploader" class="upload_button button" type="button" value="<?php _e( 'Browse', 'onioneye' ); ?>" />
				<br />
				<p>
					<?php _e( 'Image dimensions best at 680 x unlimited.', 'onioneye' ); ?>
				</p>
			</td>
		</tr>
		
		<tr>
			<th><label for="portfolio-image-10"><?php _e( "Image 10:", 'onioneye' ); ?></label></th>
			<td>
				<input id="portfolio-image-10" class="upload" type="text" name="portfolio-image-10" value="<?php echo $img10; ?>" />
				<input id="portfolio-image-10-uploader" class="upload_button button" type="button" value="<?php _e( 'Browse', 'onioneye' ); ?>" />
				<br />
				<p>
					<?php _e( 'Image dimensions best at 680 x unlimited.', 'onioneye' ); ?>
				</p>
			</td>
		</tr>
		
	</table>
	
<?php
}


/*-----------------------------------------------------------------------------------*/
/* Portfolio Custom Metabox For Videos */
/*-----------------------------------------------------------------------------------*/

function url_custom_portfolio_metabox() {
	
	global $post;
	
	$video_embed_code = get_post_meta( $post->ID, 'portfolio-video-embed', true );	
	
	?>
	
	<?php // Use nonce for verification ?>
    <input type="hidden" name="portfolio_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>" />
    
    <table class="form-table meta-box">
		<tr>
			<th><label for="portfolio-video-embed"><?php _e("Video Embed Code:", 'onioneye'); ?></label></th>
			<td><textarea id="portfolio-video-embed" cols="60" rows="3" name="portfolio-video-embed"><?php echo $video_embed_code; ?></textarea>
				<br />
				
				<p>
				<?php _e( 'Add the video embed code, generated on the site the video is hosted on, such as youtube and vimeo, to have the video displayed on your project page. Width is best at 680px with any height.', 'onioneye' ); ?>
				</p>
			</td>
		</tr>
	</table>
	
<?php
}



/*
 * Process the custom metabox fields
 */
function save_portfolio_meta_box_values( $post_id ) {
	global $post;
	
	// Verify nonce
    if ( !wp_verify_nonce( $_POST['portfolio_meta_box_nonce'], basename(__FILE__) ) ) {
        return $post_id;
    }
	
	// Skip auto save
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
	
	//C heck permissions
    if ( 'page' == $_POST['post_type'] ) {
        if ( !current_user_can( 'edit_page', $post_id ) ) {
            return $post_id;
        }
    } elseif ( !current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;
    }
	
	//check for portfolio post type only
    if( $post->post_type == "portfolio" ) {
    	if ( isset( $_POST['portfolio-preview-img']) ) { update_post_meta( $post->ID, 'portfolio-preview-img', stripslashes( htmlspecialchars( esc_url( $_POST['portfolio-preview-img'] ) ) ) ); }
        if ( isset( $_POST['portfolio-image-1']) ) { update_post_meta( $post->ID, 'portfolio-image-1', stripslashes( htmlspecialchars( esc_url( $_POST['portfolio-image-1'] ) ) ) ); }
        if ( isset( $_POST['portfolio-image-2']) ) { update_post_meta( $post->ID, 'portfolio-image-2', stripslashes( htmlspecialchars( esc_url( $_POST['portfolio-image-2'] ) ) ) ); }
		if ( isset( $_POST['portfolio-image-3']) ) { update_post_meta( $post->ID, 'portfolio-image-3', stripslashes( htmlspecialchars( esc_url( $_POST['portfolio-image-3'] ) ) ) ); }
        if ( isset( $_POST['portfolio-image-4']) ) { update_post_meta( $post->ID, 'portfolio-image-4', stripslashes( htmlspecialchars( esc_url( $_POST['portfolio-image-4'] ) ) ) ); }
        if ( isset( $_POST['portfolio-image-5']) ) { update_post_meta( $post->ID, 'portfolio-image-5', stripslashes( htmlspecialchars( esc_url( $_POST['portfolio-image-5'] ) ) ) ); }
		if ( isset( $_POST['portfolio-image-6']) ) { update_post_meta( $post->ID, 'portfolio-image-6', stripslashes( htmlspecialchars( esc_url( $_POST['portfolio-image-6'] ) ) ) ); }
        if ( isset( $_POST['portfolio-image-7']) ) { update_post_meta( $post->ID, 'portfolio-image-7', stripslashes( htmlspecialchars( esc_url( $_POST['portfolio-image-7'] ) ) ) ); }
		if ( isset( $_POST['portfolio-image-8']) ) { update_post_meta( $post->ID, 'portfolio-image-8', stripslashes( htmlspecialchars( esc_url( $_POST['portfolio-image-8'] ) ) ) ); }
        if ( isset( $_POST['portfolio-image-9']) ) { update_post_meta( $post->ID, 'portfolio-image-9', stripslashes( htmlspecialchars( esc_url( $_POST['portfolio-image-9'] ) ) ) ); }
        if ( isset( $_POST['portfolio-image-10']) ) { update_post_meta( $post->ID, 'portfolio-image-10', stripslashes( htmlspecialchars( esc_url( $_POST['portfolio-image-10'] ) ) ) ); }
		if ( isset( $_POST['portfolio-video-embed']) ) { update_post_meta( $post->ID, 'portfolio-video-embed', stripslashes( htmlspecialchars( $_POST['portfolio-video-embed'] ) ) ); }
    }	
}

// Add action hooks. Without these we are lost
add_action( 'admin_init', 'add_portfolio_meta_boxes' );
add_action( 'save_post', 'save_portfolio_meta_box_values' );


/*
 * Add meta box
 */
function add_portfolio_meta_boxes() {
	add_meta_box( 'portfolio-img-settings-metabox', __( "Image Settings", 'onioneye' ), 'eq_image_settings_portfolio_metabox', 'portfolio', 'normal', 'high' );
	add_meta_box( 'portfolio-video-settings-metabox', __( "Video Settings", 'onioneye' ), 'url_custom_portfolio_metabox', 'portfolio', 'normal', 'high' );
}

?>