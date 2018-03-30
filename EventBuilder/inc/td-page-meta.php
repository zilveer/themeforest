<?php

if ( !function_exists( 'td_meta_box_add' ) ) {

	add_action( 'add_meta_boxes', 'td_meta_box_add' );

	function td_meta_box_add() {
		add_meta_box( 'page_metabox', 'Settings', 'td_page_metabox', 'page', 'normal', 'high' );
	}

}

if ( !function_exists( 'td_page_metabox' ) ) {

	function td_page_metabox( $post ) {

		$values = get_post_custom( $post->ID );
		
		$selected = isset( $values['page_slider'] ) ? esc_attr( $values['page_slider'][0] ) : '';
		$layerslider_shortcode = isset( $values['layerslider_shortcode'] ) ? esc_attr( $values['layerslider_shortcode'][0] ) : '';
		$video_code = isset( $values['video_code'] ) ? esc_attr( $values['video_code'][0] ) : '';
		$video_code_bg = isset( $values['video_code_bg'] ) ? esc_attr( $values['video_code_bg'][0] ) : '';
		
		wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );

	?>
		
		<div style="padding:20px 0;">

			<div style="float: left; margin-bottom: 40px; width: 100%;">
		
				<label style="float: left; width: 160px;" for="page-title-text-align"><strong><?php _e( 'Page slider', 'themesdojo' ); ?></strong></label>
				
				<div style="margin-left: 30px; float: left; max-width: 300px;">
					<select name="page_slider" id="page_slider" style="width: 260px;">
						<option value="none" <?php selected( $selected, 'none' ); ?>><?php _e( 'None', 'themesdojo' ); ?></option>
						<option value="search-events" <?php selected( $selected, 'search-events' ); ?>><?php _e( 'Search Events Block', 'themesdojo' ); ?></option>
						<option value="bigmap" <?php selected( $selected, 'bigmap' ); ?>><?php _e( 'Big Map', 'themesdojo' ); ?></option>
						<option value="video" <?php selected( $selected, 'video' ); ?>><?php _e( 'Video', 'themesdojo' ); ?></option>
						<option value="layerslider" <?php selected( $selected, 'layerslider' ); ?>><?php _e( 'LayerSlider', 'themesdojo' ); ?></option>
					</select>
					<span style="font-style: italic; float: left; margin-top: 5px;"><?php _e( 'Select page slider.', 'themesdojo' ); ?></span>
				</div>
				
			</div>	

			<div id="layerslidershortcode" style="display: none; float: left; margin-bottom: 40px; width: 100%;">
			
				<label style="float: left; width: 160px;" for="layerslider_shortcode"><strong><?php _e( 'LayeSlider Shortcode', 'themesdojo' ); ?></strong></label>
				
				<div style="margin-left: 30px; float: left;">
					<input style="width: 260px; float: left" type="text" name="layerslider_shortcode" id="layerslider_shortcode" value="<?php echo $layerslider_shortcode; ?>" />
					<span style="font-style: italic; float: left; margin-top: 5px; width: 100%;">Enter layerslider shortcode (leave empty for "[layerslider id="1"]").</span>
				</div>
				
			</div>

			<div id="videocode" style="display: none; float: left; margin-bottom: 40px; width: 100%;">
			
				<label style="float: left; width: 160px;" for="video_code"><strong><?php _e( 'Youtube video id', 'themesdojo' ); ?></strong></label>
				
				<div style="margin-left: 30px; float: left;">
					<input style="width: 260px; float: left" type="text" name="video_code" id="video_code" value="<?php echo $video_code; ?>" />
					<span style="font-style: italic; float: left; margin-top: 5px; width: 100%;">Enter youtube video id.</span>
				</div>
				
			</div>

			<div id="videocode_bg" style="display: none; float: left; margin-bottom: 40px; width: 100%;">
			
				<label style="float: left; width: 160px;" for="video_code"><strong><?php _e( 'Youtube video background id', 'themesdojo' ); ?></strong></label>
				
				<div style="margin-left: 30px; float: left;">
					<input style="width: 260px; float: left" type="text" name="video_code_bg" id="video_code_bg" value="<?php echo $video_code_bg; ?>" />
					<span style="font-style: italic; float: left; margin-top: 5px; width: 100%;">Enter youtube video id (leave empty for image background)</span>
				</div>
				
			</div>
			
			<span style="visibility: hidden;"><p>Page meta end</p></span>
		
		</div>

		<script>
			jQuery(document).ready(function(){ 

				var val2 = jQuery("#page_slider").val();

				if( val2 === "layerslider" ) {
				    jQuery("#layerslidershortcode").css({"display":"block"});
				} else {
				    jQuery("#layerslidershortcode").css({"display":"none"});
				}

				if( val2 === "video" ) {
				    jQuery("#videocode").css({"display":"block"});
				} else {
				    jQuery("#videocode").css({"display":"none"});
				}

				if( val2 === "search-events" ) {
				    jQuery("#videocode_bg").css({"display":"block"});
				} else {
				    jQuery("#videocode_bg").css({"display":"none"});
				}
				
				jQuery("#page_slider").change(function() {
				    var val2 = jQuery(this).val();
				    if( val2 === "layerslider" ) {
				        jQuery("#layerslidershortcode").css({"display":"block"});
				    } else {
				        jQuery("#layerslidershortcode").css({"display":"none"});
				    }

				    if( val2 === "video" ) {
					    jQuery("#videocode").css({"display":"block"});
					} else {
					    jQuery("#videocode").css({"display":"none"});
					}

					if( val2 === "search-events" ) {
					    jQuery("#videocode_bg").css({"display":"block"});
					} else {
					    jQuery("#videocode_bg").css({"display":"none"});
					}
				});

			});
		</script>
		
		<?php	
	}

}

if ( !function_exists( 'td_meta_box_save' ) ) {

	add_action( 'save_post', 'td_meta_box_save' );

	function td_meta_box_save( $post_id ) {
		// Bail if we're doing an auto save
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
		
		// if our nonce isn't there, or we can't verify it, bail
		if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
		
		// if our current user can't edit this post, bail
		if( !current_user_can( 'edit_posts' ) ) return;
		
		// now we can actually save the data
		$allowed = array( 
			'a' => array( // on allow a tags
				'href' => array() // and those anchords can only have href attribute
			)
		);

		// Probably a good idea to make sure your data is set
		if( isset( $_POST['layerslider_shortcode'] ) )
			update_post_meta( $post_id, 'layerslider_shortcode', wp_kses( $_POST['layerslider_shortcode'], $allowed ) );

		// Probably a good idea to make sure your data is set
		if( isset( $_POST['video_code'] ) )
			update_post_meta( $post_id, 'video_code', wp_kses( $_POST['video_code'], $allowed ) );

		if( isset( $_POST['video_code_bg'] ) )
			update_post_meta( $post_id, 'video_code_bg', wp_kses( $_POST['video_code_bg'], $allowed ) );
		
		// Probably a good idea to make sure your data is set
		if( isset( $_POST['page_slider'] ) ) {
			$page_slider = sanitize_text_field($_POST['page_slider']);
			update_post_meta( $post_id, 'page_slider', $page_slider );
		}
	}

}

?>
