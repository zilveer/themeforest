<?php
/*
*	Greatives Post Items
*
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

	add_action( 'add_meta_boxes', 'blade_grve_post_options_add_custom_boxes' );
	add_action( 'save_post', 'blade_grve_post_options_save_postdata', 10, 2 );

	$blade_grve_post_options = array (

		//Gallery Format
		array(
			'name' => 'Media Mode',
			'id' => 'grve_post_type_gallery_mode',
		),
		array(
			'name' => 'Media Image Mode',
			'id' => 'grve_post_type_gallery_image_mode',
		),
		//Link Format
		array(
			'name' => 'Link URL',
			'id' => 'grve_post_link_url',
		),
		array(
			'name' => 'Open Link in a new window',
			'id' => 'grve_post_link_new_window',
		),
		array(
			'name' => 'Link Background Color',
			'id' => 'grve_post_link_bg_color',
		),
		array(
			'name' => 'Link Background Hover Color',
			'id' => 'grve_post_link_bg_hover_color',
		),
		//Quote Format
		array(
			'name' => 'Quote Background Color',
			'id' => 'grve_post_quote_bg_color',
		),
		array(
			'name' => 'Link Background Hover Color',
			'id' => 'grve_post_quote_bg_hover_color',
		),
		//Audio Format
		array(
			'name' => 'Audio mp3 format',
			'id' => 'grve_post_audio_mp3',
		),
		array(
			'name' => 'Audio ogg format',
			'id' => 'grve_post_audio_ogg',
		),
		array(
			'name' => 'Audio wav format',
			'id' => 'grve_post_audio_wav',
		),
		array(
			'name' => 'Audio embed',
			'id' => 'grve_post_audio_embed',
		),
		//Video Format
		array(
			'name' => 'Video Mode',
			'id' => 'grve_post_type_video_mode',
		),
		array(
			'name' => 'Video webm format',
			'id' => 'grve_post_video_webm',
		),
		array(
			'name' => 'Video mp4 format',
			'id' => 'grve_post_video_mp4',
		),
		array(
			'name' => 'Video ogv format',
			'id' => 'grve_post_video_ogv',
		),
		array(
			'name' => 'Video Poster',
			'id' => 'grve_post_video_poster',
		),
		array(
			'name' => 'Video embed Vimeo/Youtube',
			'id' => 'grve_post_video_embed',
		),

	);

	function blade_grve_post_options_add_custom_boxes() {

		if ( function_exists( 'vc_is_inline' ) && vc_is_inline() ) {
			return;
		}

		add_meta_box(
			'grve-meta-box-post-format-gallery',
			esc_html__( 'Gallery Format Options', 'blade' ),
			'blade_grve_meta_box_post_format_gallery',
			'post'
		);
		add_meta_box(
			'grve-meta-box-post-format-link',
			esc_html__( 'Link Format Options', 'blade' ),
			'blade_grve_meta_box_post_format_link',
			'post'
		);
		add_meta_box(
			'grve-meta-box-post-format-quote',
			esc_html__( 'Quote Format Options', 'blade' ),
			'blade_grve_meta_box_post_format_quote',
			'post'
		);
		add_meta_box(
			'grve-meta-box-post-format-video',
			esc_html__( 'Video Format Options', 'blade' ),
			'blade_grve_meta_box_post_format_video',
			'post'
		);
		add_meta_box(
			'grve-meta-box-post-format-audio',
			esc_html__( 'Audio Format Options', 'blade' ),
			'blade_grve_meta_box_post_format_audio',
			'post'
		);

	}

	function blade_grve_meta_box_post_format_gallery( $post ) {

		wp_nonce_field( 'grve_nonce_save', 'grve_post_save_nonce' );
		wp_nonce_field( 'grve_nonce_save', 'grve_post_format_gallery_save_nonce' );

		$gallery_mode = get_post_meta( $post->ID, 'grve_post_type_gallery_mode', true );
		$gallery_image_mode = get_post_meta( $post->ID, 'grve_post_type_gallery_image_mode', true );

		$media_slider_items = get_post_meta( $post->ID, 'grve_post_slider_items', true );

		$media_slider_settings = get_post_meta( $post->ID, 'grve_post_slider_settings', true );
		$media_slider_speed = blade_grve_array_value( $media_slider_settings, 'slideshow_speed', '3500' );
		$media_slider_dir_nav = blade_grve_array_value( $media_slider_settings, 'direction_nav', '1' );
		$media_slider_dir_nav_color = blade_grve_array_value( $media_slider_settings, 'direction_nav_color', 'dark' );

	?>
			<table class="form-table grve-metabox">
				<tbody>
					<tr class="grve-border-bottom">
						<th>
							<label for="grve-post-gallery-mode">
								<strong><?php esc_html_e( 'Gallery Mode', 'blade' ); ?></strong>
								<span>
									<?php esc_html_e( 'Select Gallery mode.', 'blade' ); ?>
								</span>
							</label>
						</th>
						<td>
							<select id="grve-post-gallery-mode" name="grve_post_type_gallery_mode">
								<option value="" <?php selected( '', $gallery_mode ); ?>><?php esc_html_e( 'Gallery', 'blade' ); ?></option>
								<option value="slider" <?php selected( 'slider', $gallery_mode ); ?>><?php esc_html_e( 'Slider', 'blade' ); ?></option>
							</select>
						</td>
					</tr>
					<tr id="grve-post-gallery-image-mode-section" class="grve-post-media-item" <?php if ( "" == $gallery_mode ) { ?> style="display:none;" <?php } ?>>
						<th>
							<label for="grve-post-gallery-image-mode">
								<strong><?php esc_html_e( 'Image Mode', 'blade' ); ?></strong>
								<span>
									<?php esc_html_e( 'Select image mode.', 'blade' ); ?>
								</span>
							</label>
						</th>
						<td>
							<select id="grve-post-gallery-image-mode" name="grve_post_type_gallery_image_mode">
								<option value="" <?php selected( '', $gallery_image_mode ); ?>><?php esc_html_e( 'Auto Crop', 'blade' ); ?></option>
								<option value="resize" <?php selected( 'resize', $gallery_image_mode ); ?>><?php esc_html_e( 'Resize', 'blade' ); ?></option>
							</select>
						</td>
					</tr>
					<tr id="grve-post-media-slider-speed" class="grve-post-media-item" <?php if ( "" == $gallery_mode ) { ?> style="display:none;" <?php } ?>>
						<th>
							<label for="grve-post-slider-speed">
								<strong><?php esc_html_e( 'Slideshow Speed', 'blade' ); ?></strong>
							</label>
						</th>
						<td>
							<input type="text" id="grve-post-slider-speed" name="grve_post_slider_settings_speed" value="<?php echo esc_attr( $media_slider_speed ); ?>" /> ms
						</td>
					</tr>
					<tr id="grve-post-media-slider-direction-nav" class="grve-post-media-item" <?php if ( "" == $gallery_mode ) { ?> style="display:none;" <?php } ?>>
						<th>
							<label for="grve-post-slider-direction-nav">
								<strong><?php esc_html_e( 'Navigation Buttons', 'blade' ); ?></strong>
							</label>
						</th>
						<td>
							<select id="grve-post-slider-direction-nav" name="grve_post_slider_settings_direction_nav">
								<option value="1" <?php selected( "1", $media_slider_dir_nav ); ?>><?php esc_html_e( 'Style 1', 'blade' ); ?></option>
								<option value="2" <?php selected( "2", $media_slider_dir_nav ); ?>><?php esc_html_e( 'Style 2', 'blade' ); ?></option>
								<option value="3" <?php selected( "3", $media_slider_dir_nav ); ?>><?php esc_html_e( 'Style 3', 'blade' ); ?></option>
								<option value="4" <?php selected( "4", $media_slider_dir_nav ); ?>><?php esc_html_e( 'Style 4', 'blade' ); ?></option>
								<option value="0" <?php selected( "0", $media_slider_dir_nav ); ?>><?php esc_html_e( 'No Navigation', 'blade' ); ?></option>
							</select>
						</td>
					</tr>
					<tr id="grve-post-media-slider-direction-nav-color" class="grve-post-media-item" <?php if ( "" == $gallery_mode ) { ?> style="display:none;" <?php } ?>>
						<th>
							<label for="grve-post-slider-direction-nav-color">
								<strong><?php esc_html_e( 'Navigation Buttons Color', 'blade' ); ?></strong>
							</label>
						</th>
						<td>
							<select id="grve-post-slider-direction-nav-color" name="grve_post_slider_settings_direction_nav_color">
								<option value="dark" <?php selected( "dark", $media_slider_dir_nav_color ); ?>><?php esc_html_e( 'Dark', 'blade' ); ?></option>
								<option value="light" <?php selected( "light", $media_slider_dir_nav_color ); ?>><?php esc_html_e( 'Light', 'blade' ); ?></option>
							</select>
						</td>
					</tr>
					<tr>
						<th>
							<label><?php esc_html_e( 'Images', 'blade' ); ?></label>
						</th>
						<td>
							<input type="button" class="grve-upload-slider-button button-primary" value="<?php esc_attr_e( 'Insert Images to Gallery/Slider', 'blade' ); ?>"/>
							<span id="grve-upload-slider-button-spinner" class="grve-action-spinner"></span>
						</td>
					</tr>
				</tbody>
			</table>
			<div id="grve-slider-container" class="grve-slider-container-minimal" data-mode="minimal">
				<?php
					if( !empty( $media_slider_items ) ) {
						blade_grve_print_admin_media_slider_items( $media_slider_items );
					}
				?>
			</div>
	<?php
	}


	function blade_grve_meta_box_post_format_link( $post ) {

		global $blade_grve_post_color_selection;

		$link_url = get_post_meta( $post->ID, 'grve_post_link_url', true );
		$new_window = get_post_meta( $post->ID, 'grve_post_link_new_window', true );

		$grve_post_link_bg_color = blade_grve_admin_post_meta( $post->ID, 'grve_post_link_bg_color', 'primary-1' );
		$grve_post_link_bg_hover_color = blade_grve_admin_post_meta( $post->ID, 'grve_post_link_bg_hover_color', 'black' );

	?>
		<table class="form-table grve-metabox">
			<tbody>
				<tr>
					<td colspan="2">
						<p class="howto"><?php esc_html_e( 'Add your text in the content area. The text will be wrapped with a link.', 'blade' ); ?></p>
					</td>
				</tr>
			</tbody>
		</table>
<?php

			blade_grve_print_admin_option(
				array(
					'type' => 'textfield',
					'name' => 'grve_post_link_url',
					'value' => $link_url ,
					'label' => array(
						'title' => esc_html__( 'Link URL', 'blade' ),
						'desc' => esc_html__( 'Enter the full URL of your link.', 'blade' ),
					),
					'width' => 'fullwidth',
				)
			);

			blade_grve_print_admin_option(
				array(
					'type' => 'checkbox',
					'name' => 'grve_post_link_new_window',
					'value' => $new_window ,
					'label' => array(
						'title' => esc_html__( 'Open Link in new window', 'blade' ),
						'desc' => esc_html__( 'If selected, link will open in a new window.', 'blade' ),
					),
				)
			);

			blade_grve_print_admin_option(
				array(
					'type' => 'select',
					'name' => 'grve_post_link_bg_color',
					'options' => $blade_grve_post_color_selection,
					'value' => $grve_post_link_bg_color,
					'label' => esc_html__( 'Background color', 'blade' ),
				)
			);
			blade_grve_print_admin_option(
				array(
					'type' => 'select',
					'name' => 'grve_post_link_bg_hover_color',
					'options' => $blade_grve_post_color_selection,
					'value' => $grve_post_link_bg_hover_color,
					'label' => esc_html__( 'Background Hover color', 'blade' ),
				)
			);

	}

	function blade_grve_meta_box_post_format_quote( $post ) {

		global $blade_grve_post_color_selection;
		$grve_post_quote_bg_color = blade_grve_admin_post_meta( $post->ID, 'grve_post_quote_bg_color', 'primary-1' );
		$grve_post_quote_bg_hover_color = blade_grve_admin_post_meta( $post->ID, 'grve_post_quote_bg_hover_color', 'black' );
	?>
		<table class="form-table grve-metabox">
			<tbody>
				<tr>
					<td colspan="2">
						<p class="howto"><?php esc_html_e( 'Simply add some text in the content area. This text will automatically displayed as quote.', 'blade' ); ?></p>
					</td>
				</tr>
			</tbody>
		</table>

<?php

		blade_grve_print_admin_option(
			array(
				'type' => 'select',
				'name' => 'grve_post_quote_bg_color',
				'options' => $blade_grve_post_color_selection,
				'value' => $grve_post_quote_bg_color,
				'label' => esc_html__( 'Background color', 'blade' ),
			)
		);
		blade_grve_print_admin_option(
			array(
				'type' => 'select',
				'name' => 'grve_post_quote_bg_hover_color',
				'options' => $blade_grve_post_color_selection,
				'value' => $grve_post_quote_bg_hover_color,
				'label' => esc_html__( 'Background Hover color', 'blade' ),
			)
		);

	}

	function blade_grve_meta_box_post_format_video( $post ) {

		$video_mode = get_post_meta( $post->ID, 'grve_post_type_video_mode', true );
		$grve_post_video_webm = get_post_meta( $post->ID, 'grve_post_video_webm', true );
		$grve_post_video_mp4 = get_post_meta( $post->ID, 'grve_post_video_mp4', true );
		$grve_post_video_ogv = get_post_meta( $post->ID, 'grve_post_video_ogv', true );
		$grve_post_video_poster = get_post_meta( $post->ID, 'grve_post_video_poster', true );
		$grve_post_video_embed = get_post_meta( $post->ID, 'grve_post_video_embed', true );

	?>
		<table class="form-table grve-metabox">
			<tbody>
				<tr>
					<td colspan="2">
						<p class="howto"><?php esc_html_e( 'Select one of the choices below for the featured video.', 'blade' ); ?></p>
					</td>
				</tr>
				<tr class="grve-border-bottom">
					<th>
						<label for="grve-post-type-video-mode">
							<strong><?php esc_html_e( 'Video Mode', 'blade' ); ?></strong>
							<span>
								<?php esc_html_e( 'Select your Video Mode', 'blade' ); ?>
							</span>
						</label>
					</th>
					<td>
						<select id="grve-post-type-video-mode" name="grve_post_type_video_mode">
							<option value="" <?php selected( "", $video_mode ); ?>><?php esc_html_e( 'YouTube/Vimeo Video', 'blade' ); ?></option>
							<option value="html5" <?php selected( "html5", $video_mode ); ?>><?php esc_html_e( 'HTML5 Video', 'blade' ); ?></option>
						</select>
					</td>
				</tr>
				<tr class="grve-post-video-html5"<?php if ( "" == $video_mode ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-post-video-webm">
							<strong><?php esc_html_e( 'WebM File URL', 'blade' ); ?></strong>
							<span>
								<?php esc_html_e( 'Upload the .webm video file.', 'blade' ); ?>
								<br/>
								<strong><?php esc_html_e( 'This Format must be included for HTML5 Video.', 'blade' ); ?></strong>
							</span>
						</label>
					</th>
					<td>
						<input type="text" id="grve-post-video-webm" class="grve-upload-simple-media-field grve-meta-text" name="grve_post_video_webm" value="<?php echo esc_attr( $grve_post_video_webm ); ?>"/>
						<input type="button" data-media-type="video" class="grve-upload-simple-media-button button" value="<?php esc_attr_e( 'Upload Media', 'blade' ); ?>"/>
						<input type="button" class="grve-remove-simple-media-button button" value="<?php esc_attr_e( 'Remove', 'blade' ); ?>"/>
					</td>
				</tr>
				<tr class="grve-post-video-html5"<?php if ( "" == $video_mode ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-post-video-mp4">
							<strong><?php esc_html_e( 'MP4 File URL', 'blade' ); ?></strong>
							<span>
								<?php esc_html_e( 'Upload the .mp4 video file.', 'blade' ); ?>
								<br/>
								<strong><?php esc_html_e( 'This Format must be included for HTML5 Video.', 'blade' ); ?></strong>
							</span>
						</label>
					</th>
					<td>
						<input type="text" id="grve-post-video-mp4" class="grve-upload-simple-media-field grve-meta-text" name="grve_post_video_mp4" value="<?php echo esc_attr( $grve_post_video_mp4 ); ?>"/>
						<input type="button" data-media-type="video" class="grve-upload-simple-media-button button" value="<?php esc_attr_e( 'Upload Media', 'blade' ); ?>"/>
						<input type="button" class="grve-remove-simple-media-button button" value="<?php esc_attr_e( 'Remove', 'blade' ); ?>"/>
					</td>
				</tr>
				<tr class="grve-post-video-html5"<?php if ( "" == $video_mode ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-post-video-ogv">
							<strong><?php esc_html_e( 'OGV File URL', 'blade' ); ?></strong>
							<span>
								<?php esc_html_e( 'Upload the .ogv video file (optional).', 'blade' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="text" id="grve-post-video-ogv" class="grve-upload-simple-media-field grve-meta-text" name="grve_post_video_ogv" value="<?php echo esc_attr( $grve_post_video_ogv ); ?>"/>
						<input type="button" data-media-type="video" class="grve-upload-simple-media-button button" value="<?php esc_attr_e( 'Upload Media', 'blade' ); ?>"/>
						<input type="button" class="grve-remove-simple-media-button button" value="<?php esc_attr_e( 'Remove', 'blade' ); ?>"/>
					</td>
				</tr>
				<tr class="grve-post-video-html5"<?php if ( "" == $video_mode ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-post-video-poster">
							<strong><?php esc_html_e( 'Poster Image', 'blade' ); ?></strong>
							<span>
								<?php esc_html_e( 'Use same resolution as video.', 'blade' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="text" id="grve-post-video-poster" class="grve-upload-simple-media-field grve-meta-text" name="grve_post_video_poster" value="<?php echo esc_attr( $grve_post_video_poster ); ?>"/>
						<input type="button" data-media-type="image" class="grve-upload-simple-media-button button" value="<?php esc_attr_e( 'Upload Media', 'blade' ); ?>"/>
						<input type="button" class="grve-remove-simple-media-button button" value="<?php esc_attr_e( 'Remove', 'blade' ); ?>"/>
					</td>
				</tr>
				<tr class="grve-post-video-embed"<?php if ( "html5" == $video_mode ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-post-video-embed">
							<strong><?php esc_html_e( 'Vimeo/YouTube URL', 'blade' ); ?></strong>
							<span>
								<?php esc_html_e( 'Enter the full URL of your video from Vimeo or YouTube.', 'blade' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="text" id="grve-post-video-embed" class="grve-meta-text" name="grve_post_video_embed" value="<?php echo esc_attr( $grve_post_video_embed ); ?>"/>
					</td>
				</tr>
			</tbody>
		</table>

	<?php
	}

	function blade_grve_meta_box_post_format_audio( $post ) {

		$audio_mode = get_post_meta( $post->ID, 'grve_post_type_audio_mode', true );
		$grve_post_audio_mp3 = get_post_meta( $post->ID, 'grve_post_audio_mp3', true );
		$grve_post_audio_ogg = get_post_meta( $post->ID, 'grve_post_audio_ogg', true );
		$grve_post_audio_wav = get_post_meta( $post->ID, 'grve_post_audio_wav', true );
		$grve_post_audio_embed = get_post_meta( $post->ID, 'grve_post_audio_embed', true );

	?>
		<table class="form-table grve-metabox">
			<tbody>
				<tr>
					<td colspan="2">
						<p class="howto"><?php esc_html_e( 'Select one of the choices below for the featured audio.', 'blade' ); ?></p>
					</td>
				</tr>
				<tr class="grve-border-bottom">
					<th>
						<label for="grve-post-type-audio-mode">
							<strong><?php esc_html_e( 'Audio Mode', 'blade' ); ?></strong>
							<span>
								<?php esc_html_e( 'Select your Audio Mode', 'blade' ); ?>
							</span>
						</label>
					</th>
					<td>
						<select id="grve-post-type-audio-mode" name="grve_post_type_audio_mode">
							<option value="" <?php selected( "", $audio_mode ); ?>><?php esc_html_e( 'Embed Audio', 'blade' ); ?></option>
							<option value="html5" <?php selected( "html5", $audio_mode ); ?>><?php esc_html_e( 'HTML5 Audio', 'blade' ); ?></option>
						</select>
					</td>
				</tr>
				<tr class="grve-post-audio-html5"<?php if ( "" == $audio_mode ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-post-audio-mp3">
							<strong><?php esc_html_e( 'MP3 File URL', 'blade' ); ?></strong>
							<span>
								<?php esc_html_e( 'Upload the .mp3 audio file.', 'blade' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="text" id="grve-post-audio-mp3" class="grve-upload-simple-media-field grve-meta-text" name="grve_post_audio_mp3" value="<?php echo esc_attr( $grve_post_audio_mp3 ); ?>"/>
						<input type="button" data-media-type="audio" class="grve-upload-simple-media-button button" value="<?php esc_attr_e( 'Upload Media', 'blade' ); ?>"/>
						<input type="button" class="grve-remove-simple-media-button button" value="<?php esc_attr_e( 'Remove', 'blade' ); ?>"/>
					</td>
				</tr>
				<tr class="grve-post-audio-html5"<?php if ( "" == $audio_mode ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-post-audio-ogg">
							<strong><?php esc_html_e( 'OGG File URL', 'blade' ); ?></strong>
							<span>
								<?php esc_html_e( 'Upload the .ogg audio file.', 'blade' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="text" id="grve-post-audio-ogg" class="grve-upload-simple-media-field grve-meta-text" name="grve_post_audio_ogg" value="<?php echo esc_attr( $grve_post_audio_ogg ); ?>"/>
						<input type="button" data-media-type="audio" class="grve-upload-simple-media-button button" value="<?php esc_attr_e( 'Upload Media', 'blade' ); ?>"/>
						<input type="button" class="grve-remove-simple-media-button button" value="<?php esc_attr_e( 'Remove', 'blade' ); ?>"/>
					</td>
				</tr>
				<tr class="grve-post-audio-html5"<?php if ( "" == $audio_mode ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-post-audio-wav">
							<strong><?php esc_html_e( 'WAV File URL', 'blade' ); ?></strong>
							<span>
								<?php esc_html_e( 'Upload the .wav audio file (optional).', 'blade' ); ?>
							</span>
						</label>
					</th>
					<td>
						<input type="text" id="grve-post-audio-wav" class="grve-upload-simple-media-field grve-meta-text" name="grve_post_audio_wav" value="<?php echo esc_attr( $grve_post_audio_wav ); ?>"/>
						<input type="button" data-media-type="audio" class="grve-upload-simple-media-button button" value="<?php esc_attr_e( 'Upload Media', 'blade' ); ?>"/>
						<input type="button" class="grve-remove-simple-media-button button" value="<?php esc_attr_e( 'Remove', 'blade' ); ?>"/>
					</td>
				</tr>
				<tr class="grve-post-audio-embed"<?php if ( "html5" == $audio_mode ) { ?> style="display:none;" <?php } ?>>
					<th>
						<label for="grve-post-audio-embed">
							<strong><?php esc_html_e( 'Audio embed code', 'blade' ); ?></strong>
							<span>
								<?php esc_html_e( 'Type your audio embed code.', 'blade' ); ?>
							</span>
						</label>
					</th>
					<td>
						<textarea id="grve-post-audio-embed" name="grve_post_audio_embed" cols="40" rows="5"><?php echo wp_kses_post( $grve_post_audio_embed ); ?></textarea>
					</td>
				</tr>
			</tbody>
		</table>

	<?php
	}

	function blade_grve_post_options_save_postdata( $post_id , $post ) {
		global $blade_grve_post_options;

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( ! isset( $_POST['grve_post_save_nonce'] ) || !wp_verify_nonce( $_POST['grve_post_save_nonce'], 'grve_nonce_save' ) ) {
			return;
		}

		// Check permissions
		if ( 'post' == $_POST['post_type'] )
		{
			if ( !current_user_can( 'edit_post', $post_id ) ) {
				return;
			}
		}

		foreach ( $blade_grve_post_options as $value ) {
			$new_meta_value = ( isset( $_POST[$value['id']] ) ? $_POST[$value['id']] : '' );
			$meta_key = $value['id'];


			$meta_value = get_post_meta( $post_id, $meta_key, true );

			if ( $new_meta_value && '' == $meta_value ) {
				add_post_meta( $post_id, $meta_key, $new_meta_value, true );
			} elseif ( $new_meta_value && $new_meta_value != $meta_value ) {
				update_post_meta( $post_id, $meta_key, $new_meta_value );
			} elseif ( '' == $new_meta_value && $meta_value ) {
				delete_post_meta( $post_id, $meta_key, $meta_value );
			}
		}

		if ( isset( $_POST['grve_post_format_gallery_save_nonce'] ) && wp_verify_nonce( $_POST['grve_post_format_gallery_save_nonce'], 'grve_nonce_save' ) ) {


			//Feature Slider Items
			$media_slider_items = array();
			if ( isset( $_POST['grve_media_slider_item_id'] ) ) {

				$num_of_images = sizeof( $_POST['grve_media_slider_item_id'] );
				for ( $i=0; $i < $num_of_images; $i++ ) {

					$this_image = array (
						'id' => $_POST['grve_media_slider_item_id'][ $i ],
					);
					array_push( $media_slider_items, $this_image );
				}

			}

			if( empty( $media_slider_items ) ) {
				delete_post_meta( $post->ID, 'grve_post_slider_items' );
				delete_post_meta( $post->ID, 'grve_post_slider_settings' );
			} else{
				update_post_meta( $post->ID, 'grve_post_slider_items', $media_slider_items );
				$media_slider_speed = 3500;
				$media_slider_direction_nav = '1';
				$media_slider_direction_nav_color = 'dark';

				if ( isset( $_POST['grve_post_slider_settings_speed'] ) ) {
					$media_slider_speed = $_POST['grve_post_slider_settings_speed'];
				}
				if ( isset( $_POST['grve_post_slider_settings_direction_nav'] ) ) {
					$media_slider_direction_nav = $_POST['grve_post_slider_settings_direction_nav'];
				}
				if ( isset( $_POST['grve_post_slider_settings_direction_nav_color'] ) ) {
					$media_slider_direction_nav_color = $_POST['grve_post_slider_settings_direction_nav_color'];
				}

				$media_slider_settings = array (
					'slideshow_speed' => $media_slider_speed,
					'direction_nav' => $media_slider_direction_nav,
					'direction_nav_color' => $media_slider_direction_nav_color,
				);
				update_post_meta( $post->ID, 'grve_post_slider_settings', $media_slider_settings );
			}

		}

	}

//Omit closing PHP tag to avoid accidental whitespace output errors.
