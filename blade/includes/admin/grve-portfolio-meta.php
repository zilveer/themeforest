<?php
/*
*	Greatives Portfolio Items
*
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

	add_action( 'add_meta_boxes', 'blade_grve_portfolio_options_add_custom_boxes' );
	add_action( 'save_post', 'blade_grve_portfolio_options_save_postdata', 10, 2 );

	$blade_grve_portfolio_options = array (
		//Media
		array(
			'name' => 'Media Selection',
			'id' => 'grve_portfolio_media_selection',
		),
		array(
			'name' => 'Media Image Mode',
			'id' => 'grve_portfolio_media_image_mode',
		),
		array(
			'name' => 'Masonry Size',
			'id' => 'grve_portfolio_media_masonry_size',
		),
		array(
			'name' => 'Video webm format',
			'id' => 'grve_portfolio_video_webm',
		),
		array(
			'name' => 'Video mp4 format',
			'id' => 'grve_portfolio_video_mp4',
		),
		array(
			'name' => 'Video ogv format',
			'id' => 'grve_portfolio_video_ogv',
		),
		array(
			'name' => 'Video Poster',
			'id' => 'grve_portfolio_video_poster',
		),
		array(
			'name' => 'Video embed Vimeo/Youtube',
			'id' => 'grve_portfolio_video_embed',
		),

		//Link Mode
		array(
			'name' => 'Link Mode',
			'id' => 'grve_portfolio_link_mode',
		),
		array(
			'name' => 'Link URL',
			'id' => 'grve_portfolio_link_url',
		),
		array(
			'name' => 'Open Link in a new window',
			'id' => 'grve_portfolio_link_new_window',
		),
		array(
			'name' => 'Link Extra Class',
			'id' => 'grve_portfolio_link_extra_class',
		),
		//Overview Mode
		array(
			'name' => 'Custom Overview Mode',
			'id' => 'grve_portfolio_overview_mode',
		),
		array(
			'name' => 'Overview Color',
			'id' => 'grve_portfolio_overview_color',
		),
		array(
			'name' => 'Overview Background Color',
			'id' => 'grve_portfolio_overview_bg_color',
		),
		array(
			'name' => 'Overview custom text',
			'id' => 'grve_portfolio_overview_text',
		),
		array(
			'name' => 'Overview custom text size',
			'id' => 'grve_portfolio_overview_text_heading',
		),
		
	);

	function blade_grve_portfolio_options_add_custom_boxes() {

		if ( function_exists( 'vc_is_inline' ) && vc_is_inline() ) {
			return;
		}

		add_meta_box(
			'portfolio_link_mode',
			esc_html__( 'Portfolio Link Options', 'blade' ),
			'blade_grve_portfolio_link_mode_box',
			'portfolio'
		);
		add_meta_box(
			'portfolio_overview_mode',
			esc_html__( 'Portfolio Overview Options', 'blade' ),
			'blade_grve_portfolio_overview_mode_box',
			'portfolio'
		);
		add_meta_box(
			'portfolio_media_section',
			esc_html__( 'Portfolio Media', 'blade' ),
			'blade_grve_portfolio_media_section_box',
			'portfolio'
		);

	}

	function blade_grve_portfolio_link_mode_box( $post ) {

		$link_mode = get_post_meta( $post->ID, 'grve_portfolio_link_mode', true );
		$link_url = get_post_meta( $post->ID, 'grve_portfolio_link_url', true );
		$new_window = get_post_meta( $post->ID, 'grve_portfolio_link_new_window', true );
		$link_class = get_post_meta( $post->ID, 'grve_portfolio_link_extra_class', true );

		wp_nonce_field( 'grve_nonce_save', 'grve_portfolio_save_nonce' );

	?>
		<table class="form-table grve-metabox">
			<tbody>
				<tr>
					<td colspan="2">
						<p class="howto"><?php esc_html_e( 'Select link mode for Portfolio Overview (Used in Portfolio Element Link Type: Custom Link).', 'blade' ); ?></p>
					</td>
				</tr>
			</tbody>
		</table>

		<div id="grve-portfolio-custom-overview">
	<?php

		blade_grve_print_admin_option(
			array(
				'type' => 'select',
				'name' => 'grve_portfolio_link_mode',
				'id' => 'grve-portfolio-link-mode',
				'options' => array(
					'' => esc_html__( 'Portfolio Item', 'blade' ),
					'link' => esc_html__( 'Custom Link', 'blade' ),
					'none' => esc_html__( 'None', 'blade' ),
				),
				'value' => $link_mode,
				'default_value' => '',
				'label' => array(
					'title' => esc_html__( 'Link Mode', 'blade' ),
					'desc' => esc_html__( 'Select Link Mode', 'blade' ),
				),
				'group_id' => 'grve-portfolio-custom-overview',
				'highlight' => 'highlight',
			)
		);

		blade_grve_print_admin_option(
			array(
				'type' => 'textfield',
				'name' => 'grve_portfolio_link_url',
				'value' => $link_url,
				'label' => array(
					'title' => esc_html__( 'Link URL', 'blade' ),
					'desc' => esc_html__( 'Enter the full URL of your link.', 'blade' ),
				),
				'width' => 'fullwidth',
				'dependency' =>
				'[
					{ "id" : "grve-portfolio-link-mode", "values" : ["link"] }
				]',
			)
		);
		blade_grve_print_admin_option(
			array(
				'type' => 'checkbox',
				'name' => 'grve_portfolio_link_new_window',
				'value' => $new_window ,
				'label' => array(
					'title' => esc_html__( 'Open Link in new window', 'blade' ),
					'desc' => esc_html__( 'If selected, link will open in a new window.', 'blade' ),
				),
				'dependency' =>
				'[
					{ "id" : "grve-portfolio-link-mode", "values" : ["link"] }
				]',
			)
		);
		blade_grve_print_admin_option(
			array(
				'type' => 'textfield',
				'name' => 'grve_portfolio_link_extra_class',
				'value' => $link_class,
				'label' => array(
					'title' => esc_html__( 'Link extra class name', 'blade' ),
				),
				'dependency' =>
				'[
					{ "id" : "grve-portfolio-link-mode", "values" : ["link"] }
				]',
			)
		);
	?>
		</div>
	<?php
	}
	
	function blade_grve_portfolio_overview_mode_box( $post ) {

		$overview_mode = get_post_meta( $post->ID, 'grve_portfolio_overview_mode', true );
		$overview_color = get_post_meta( $post->ID, 'grve_portfolio_overview_color', true );
		$overview_bg_color = get_post_meta( $post->ID, 'grve_portfolio_overview_bg_color', true );
		$overview_text = get_post_meta( $post->ID, 'grve_portfolio_overview_text', true );
		$overview_text_heading = get_post_meta( $post->ID, 'grve_portfolio_overview_text_heading', true );


		wp_nonce_field( 'grve_nonce_save', 'grve_portfolio_save_nonce' );

	?>
		<table class="form-table grve-metabox">
			<tbody>
				<tr>
					<td colspan="2">
						<p class="howto"><?php esc_html_e( 'Select overview mode for Portfolio Overview (Used in Portfolio Element Overview Type: Custom Overview).', 'blade' ); ?></p>
					</td>
				</tr>
			</tbody>
		</table>

		<div id="grve-portfolio-custom-overview">
	<?php
		global $blade_grve_button_color_selection;

		blade_grve_print_admin_option(
			array(
				'type' => 'select',
				'name' => 'grve_portfolio_overview_mode',
				'id' => 'grve-portfolio-overview-mode',
				'options' => array(
					'' => esc_html__( 'Featured Image', 'blade' ),
					'color' => esc_html__( 'Color', 'blade' ),
				),
				'value' => $overview_mode,
				'default_value' => '',
				'label' => esc_html__( 'Overview Mode', 'blade' ),
				'group_id' => 'grve-portfolio-custom-overview',
				'highlight' => 'highlight',
			)
		);
		blade_grve_print_admin_option(
			array(
				'type' => 'select',
				'name' => 'grve_portfolio_overview_bg_color',
				'options' => $blade_grve_button_color_selection,
				'value' => $overview_bg_color,
				'default_value' => 'primary-1',
				'label' => esc_html__( 'Background color', 'blade' ),
				'dependency' =>
				'[
					{ "id" : "grve-portfolio-overview-mode", "values" : ["color"] }
				]',
			)
		);
		blade_grve_print_admin_option(
			array(
				'type' => 'select',
				'name' => 'grve_portfolio_overview_color',
				'options' => $blade_grve_button_color_selection,
				'value' => $overview_color,
				'default_value' => 'black',
				'label' => esc_html__( 'Text Color', 'blade' ),
				'dependency' =>
				'[
					{ "id" : "grve-portfolio-overview-mode", "values" : ["color"] }
				]',
			)
		);
		blade_grve_print_admin_option(
			array(
				'type' => 'textarea',
				'name' => 'grve_portfolio_overview_text',
				'value' => $overview_text,
				'label' => array(
					'title' => esc_html__( 'Custom Text', 'blade' ),
					'desc' => esc_html__( 'If entered, this text will replace default title and description.', 'blade' ),
				),
				'width' => 'fullwidth',
				'dependency' =>
				'[
					{ "id" : "grve-portfolio-overview-mode", "values" : ["color"] }
				]',
			)
		);

		blade_grve_print_admin_option(
			array(
				'type' => 'select',
				'name' => 'grve_portfolio_overview_text_heading',
				'options' => array(
					'h2'  => 'h2',
					'h3'  => 'h3',
					'h4'  => 'h4',
					'h5'  => 'h5',
					'h6'  => 'h6',
					'leader-text' => esc_html__( 'Leader Text', 'blade' ),
					'subtitle-text' => esc_html__( 'Subtitle Text', 'blade' ),
					'small-text' => esc_html__( 'Small Text', 'blade' ),
					'link-text' => esc_html__( 'Link Text', 'blade' ),
				),
				'value' => $overview_text_heading,
				'default_value' => 'h3',
				'label' => array(
					'title' => esc_html__( 'Custom Text size', 'blade' ),
					'desc' => esc_html__( 'Custom Text size and typography', 'blade' ),
				),
				'dependency' =>
				'[
					{ "id" : "grve-portfolio-overview-mode", "values" : ["color"] }
				]',
			)
		);
	?>
		</div>
	<?php
	}	

	function blade_grve_portfolio_media_section_box( $post ) {

		wp_nonce_field( 'grve_nonce_save', 'grve_portfolio_media_save_nonce' );

		$portfolio_masonry_size = get_post_meta( $post->ID, 'grve_portfolio_media_masonry_size', true );
		$portfolio_media = get_post_meta( $post->ID, 'grve_portfolio_media_selection', true );
		$portfolio_image_mode = get_post_meta( $post->ID, 'grve_portfolio_media_image_mode', true );

		$grve_portfolio_video_webm = get_post_meta( $post->ID, 'grve_portfolio_video_webm', true );
		$grve_portfolio_video_mp4 = get_post_meta( $post->ID, 'grve_portfolio_video_mp4', true );
		$grve_portfolio_video_ogv = get_post_meta( $post->ID, 'grve_portfolio_video_ogv', true );
		$grve_portfolio_video_poster = get_post_meta( $post->ID, 'grve_portfolio_video_poster', true );
		$grve_portfolio_video_embed = get_post_meta( $post->ID, 'grve_portfolio_video_embed', true );

		$media_slider_items = get_post_meta( $post->ID, 'grve_portfolio_slider_items', true );
		$media_slider_settings = get_post_meta( $post->ID, 'grve_portfolio_slider_settings', true );
		$media_slider_speed = blade_grve_array_value( $media_slider_settings, 'slideshow_speed', '3500' );
		$media_slider_dir_nav = blade_grve_array_value( $media_slider_settings, 'direction_nav', '1' );
		$media_slider_dir_nav_color = blade_grve_array_value( $media_slider_settings, 'direction_nav_color', 'dark' );

	?>
			<table class="form-table grve-metabox">
				<tbody>
					<tr>
						<th>
							<label for="grve-portfolio-media-masonry-size">
								<strong><?php esc_html_e( 'Masonry Size', 'blade' ); ?></strong>
								<span>
									<?php esc_html_e( 'Select your masonry image size.', 'blade' ); ?>
									<br/>
									<strong><?php esc_html_e( 'Used in Portfolio Element with style Masonry.', 'blade' ); ?></strong>
								</span>
							</label>
						</th>
						<td>
							<select id="grve-portfolio-media-masonry-size" name="grve_portfolio_media_masonry_size">
								<option value="square" <?php selected( 'square', $portfolio_masonry_size ); ?>><?php esc_html_e( 'Square', 'blade' ); ?></option>
								<option value="large-square" <?php selected( 'large-square', $portfolio_masonry_size ); ?>><?php esc_html_e( 'Large Square', 'blade' ); ?></option>
								<option value="landscape" <?php selected( 'landscape', $portfolio_masonry_size ); ?>><?php esc_html_e( 'Landscape', 'blade' ); ?></option>
								<option value="portrait" <?php selected( 'portrait', $portfolio_masonry_size ); ?>><?php esc_html_e( 'Portrait', 'blade' ); ?></option>
							</select>
						</td>
					</tr>
					<tr>
						<th>
							<label for="grve-portfolio-media-selection">
								<strong><?php esc_html_e( 'Media Selection', 'blade' ); ?></strong>
								<span>
									<?php esc_html_e( 'Choose your portfolio media.', 'blade' ); ?>
									<br/>
									<strong><?php esc_html_e( 'In overview only Featured Image is displayed.', 'blade' ); ?></strong>
								</span>
							</label>
						</th>
						<td>
							<select id="grve-portfolio-media-selection" name="grve_portfolio_media_selection">
								<option value="" <?php selected( '', $portfolio_media ); ?>><?php esc_html_e( 'Featured Image', 'blade' ); ?></option>
								<option value="gallery" <?php selected( 'gallery', $portfolio_media ); ?>><?php esc_html_e( 'Classic Gallery', 'blade' ); ?></option>
								<option value="gallery-vertical" <?php selected( 'gallery-vertical', $portfolio_media ); ?>><?php esc_html_e( 'Vertical Gallery', 'blade' ); ?></option>
								<option value="slider" <?php selected( 'slider', $portfolio_media ); ?>><?php esc_html_e( 'Slider', 'blade' ); ?></option>
								<option value="video" <?php selected( 'video', $portfolio_media ); ?>><?php esc_html_e( 'YouTube/Vimeo Video', 'blade' ); ?></option>
								<option value="video-html5" <?php selected( 'video-html5', $portfolio_media ); ?>><?php esc_html_e( 'HMTL5 Video', 'blade' ); ?></option>
								<option value="none" <?php selected( 'none', $portfolio_media ); ?>><?php esc_html_e( 'None', 'blade' ); ?></option>
							</select>
						</td>
					</tr>
					<tr class="grve-portfolio-media-item grve-portfolio-video-html5"<?php if ( "video-html5" != $portfolio_media ) { ?> style="display:none;" <?php } ?>>
						<th>
							<label for="grve-portfolio-video-webm">
								<strong><?php esc_html_e( 'WebM File URL', 'blade' ); ?></strong>
								<span>
									<?php esc_html_e( 'Upload the .webm video file.', 'blade' ); ?>
									<br/>
									<strong><?php esc_html_e( 'This Format must be included for HTML5 Video.', 'blade' ); ?></strong>
								</span>
							</label>
						</th>
						<td>
							<input type="text" id="grve-portfolio-video-webm" class="grve-upload-simple-media-field grve-meta-text" name="grve_portfolio_video_webm" value="<?php echo esc_attr( $grve_portfolio_video_webm ); ?>"/>
							<input type="button" data-media-type="video" class="grve-upload-simple-media-button button" value="<?php esc_attr_e( 'Upload Media', 'blade' ); ?>"/>
							<input type="button" class="grve-remove-simple-media-button button" value="<?php esc_attr_e( 'Remove', 'blade' ); ?>"/>
						</td>
					</tr>
					<tr class="grve-portfolio-media-item grve-portfolio-video-html5"<?php if ( "video-html5" != $portfolio_media ) { ?> style="display:none;" <?php } ?>>
						<th>
							<label for="grve-portfolio-video-mp4">
								<strong><?php esc_html_e( 'MP4 File URL', 'blade' ); ?></strong>
								<span>
									<?php esc_html_e( 'Upload the .mp4 video file.', 'blade' ); ?>
									<br/>
									<strong><?php esc_html_e( 'This Format must be included for HTML5 Video.', 'blade' ); ?></strong>
								</span>
							</label>
						</th>
						<td>
							<input type="text" id="grve-portfolio-video-mp4" class="grve-upload-simple-media-field grve-meta-text" name="grve_portfolio_video_mp4" value="<?php echo esc_attr( $grve_portfolio_video_mp4 ); ?>"/>
							<input type="button" data-media-type="video" class="grve-upload-simple-media-button button" value="<?php esc_attr_e( 'Upload Media', 'blade' ); ?>"/>
							<input type="button" class="grve-remove-simple-media-button button" value="<?php esc_attr_e( 'Remove', 'blade' ); ?>"/>
						</td>
					</tr>
					<tr class="grve-portfolio-media-item grve-portfolio-video-html5"<?php if ( "video-html5" != $portfolio_media ) { ?> style="display:none;" <?php } ?>>
						<th>
							<label for="grve-portfolio-video-ogv">
								<strong><?php esc_html_e( 'OGV File URL', 'blade' ); ?></strong>
								<span>
									<?php esc_html_e( 'Upload the .ogv video file (optional).', 'blade' ); ?>
								</span>
							</label>
						</th>
						<td>
							<input type="text" id="grve-portfolio-video-ogv" class="grve-upload-simple-media-field grve-meta-text" name="grve_portfolio_video_ogv" value="<?php echo esc_attr( $grve_portfolio_video_ogv ); ?>"/>
							<input type="button" data-media-type="video" class="grve-upload-simple-media-button button" value="<?php esc_attr_e( 'Upload Media', 'blade' ); ?>"/>
							<input type="button" class="grve-remove-simple-media-button button" value="<?php esc_attr_e( 'Remove', 'blade' ); ?>"/>
						</td>
					</tr>
					<tr class="grve-portfolio-media-item grve-portfolio-video-html5"<?php if ( "video-html5" != $portfolio_media ) { ?> style="display:none;" <?php } ?>>
						<th>
							<label for="grve-portfolio-video-poster">
								<strong><?php esc_html_e( 'Poster Image', 'blade' ); ?></strong>
								<span>
									<?php esc_html_e( 'Use same resolution as video.', 'blade' ); ?>
								</span>
							</label>
						</th>
						<td>
							<input type="text" id="grve-portfolio-video-poster" class="grve-upload-simple-media-field grve-meta-text" name="grve_portfolio_video_poster" value="<?php echo esc_attr( $grve_portfolio_video_poster ); ?>"/>
							<input type="button" data-media-type="image" class="grve-upload-simple-media-button button" value="<?php esc_attr_e( 'Upload Media', 'blade' ); ?>"/>
							<input type="button" class="grve-remove-simple-media-button button" value="<?php esc_attr_e( 'Remove', 'blade' ); ?>"/>
						</td>
					</tr>
					<tr class="grve-portfolio-media-item grve-portfolio-video-embed"<?php if ( "video" != $portfolio_media ) { ?> style="display:none;" <?php } ?>>
						<th>
							<label for="grve-portfolio-video-embed">
								<strong><?php esc_html_e( 'Vimeo/YouTube URL', 'blade' ); ?></strong>
								<span>
									<?php esc_html_e( 'Enter the full URL of your video from Vimeo or YouTube.', 'blade' ); ?>
								</span>
							</label>
						</th>
						<td>
							<input type="text" id="grve-portfolio-video-embed" class="grve-meta-text" name="grve_portfolio_video_embed" value="<?php echo esc_attr( $grve_portfolio_video_embed ); ?>"/>
						</td>
					</tr>
					<tr class="grve-portfolio-media-item grve-portfolio-media-image-mode"<?php if ( "slider" != $portfolio_media || "gallery-vertical" != $portfolio_media ) { ?> style="display:none;" <?php } ?>>
						<th>
							<label for="grve-portfolio-media-image-mode">
								<strong><?php esc_html_e( 'Image Mode', 'blade' ); ?></strong>
								<span>
									<?php esc_html_e( 'Select image mode.', 'blade' ); ?>
								</span>
							</label>
						</th>
						<td>
							<select id="grve-portfolio-media-image-mode" name="grve_portfolio_media_image_mode">
								<option value="" <?php selected( '', $portfolio_image_mode ); ?>><?php esc_html_e( 'Auto Crop', 'blade' ); ?></option>
								<option value="resize" <?php selected( 'resize', $portfolio_image_mode ); ?>><?php esc_html_e( 'Resize', 'blade' ); ?></option>
							</select>
						</td>
					</tr>
					<tr id="grve-portfolio-media-slider-speed" class="grve-portfolio-media-item" <?php if ( "slider" != $portfolio_media ) { ?> style="display:none;" <?php } ?>>
						<th>
							<label for="grve-page-slider-speed">
								<strong><?php esc_html_e( 'Slideshow Speed', 'blade' ); ?></strong>
							</label>
						</th>
						<td>
							<input type="text" id="grve-page-slider-speed" name="grve_portfolio_slider_settings_speed" value="<?php echo esc_attr( $media_slider_speed ); ?>" /> ms
						</td>
					</tr>
					<tr id="grve-portfolio-media-slider-direction-nav" class="grve-portfolio-media-item" <?php if ( "slider" != $portfolio_media ) { ?> style="display:none;" <?php } ?>>
						<th>
							<label for="grve-page-slider-direction-nav">
								<strong><?php esc_html_e( 'Navigation Buttons', 'blade' ); ?></strong>
							</label>
						</th>
						<td>
							<select id="grve-page-slider-direction-nav" name="grve_portfolio_slider_settings_direction_nav">
								<option value="1" <?php selected( "1", $media_slider_dir_nav ); ?>><?php esc_html_e( 'Style 1', 'blade' ); ?></option>
								<option value="2" <?php selected( "2", $media_slider_dir_nav ); ?>><?php esc_html_e( 'Style 2', 'blade' ); ?></option>
								<option value="3" <?php selected( "3", $media_slider_dir_nav ); ?>><?php esc_html_e( 'Style 3', 'blade' ); ?></option>
								<option value="4" <?php selected( "4", $media_slider_dir_nav ); ?>><?php esc_html_e( 'Style 4', 'blade' ); ?></option>
								<option value="0" <?php selected( "0", $media_slider_dir_nav ); ?>><?php esc_html_e( 'No Navigation', 'blade' ); ?></option>
							</select>
						</td>
					</tr>
					<tr id="grve-portfolio-media-slider-direction-nav-color" class="grve-portfolio-media-item" <?php if ( "slider" != $portfolio_media ) { ?> style="display:none;" <?php } ?>>
						<th>
							<label for="grve-page-slider-direction-nav-color">
								<strong><?php esc_html_e( 'Navigation Buttons Color', 'blade' ); ?></strong>
							</label>
						</th>
						<td>
							<select id="grve-page-slider-direction-nav-color" name="grve_portfolio_slider_settings_direction_nav_color">
								<option value="dark" <?php selected( "dark", $media_slider_dir_nav_color ); ?>><?php esc_html_e( 'Dark', 'blade' ); ?></option>
								<option value="light" <?php selected( "light", $media_slider_dir_nav_color ); ?>><?php esc_html_e( 'Light', 'blade' ); ?></option>
							</select>
						</td>
					</tr>
					<tr id="grve-portfolio-media-slider" class="grve-portfolio-media-item" <?php if ( "" == $portfolio_media || "none" == $portfolio_media ) { ?> style="display:none;" <?php } ?>>
						<th>
							<label><?php esc_html_e( 'Media Items', 'blade' ); ?></label>
						</th>
						<td>
							<input type="button" class="grve-upload-slider-button button-primary" value="<?php esc_attr_e( 'Insert Images', 'blade' ); ?>"/>
							<span id="grve-upload-slider-button-spinner" class="grve-action-spinner"></span>
						</td>
					</tr>
				</tbody>
			</table>
			<div id="grve-slider-container" data-mode="minimal" class="grve-portfolio-media-item" <?php if ( "" == $portfolio_media || "none" == $portfolio_media ) { ?> style="display:none;" <?php } ?>>
				<?php
					if( !empty( $media_slider_items ) ) {
						blade_grve_print_admin_media_slider_items( $media_slider_items );
					}
				?>
			</div>


	<?php
	}

	function blade_grve_portfolio_options_save_postdata( $post_id , $post ) {
		global $blade_grve_portfolio_options;

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( ! isset( $_POST['grve_portfolio_save_nonce'] ) || !wp_verify_nonce( $_POST['grve_portfolio_save_nonce'], 'grve_nonce_save' ) ) {
			return;
		}

		// Check permissions
		if ( 'portfolio' == $_POST['post_type'] )
		{
			if ( !current_user_can( 'edit_page', $post_id ) ) {
				return;
			}
		}

		foreach ( $blade_grve_portfolio_options as $value ) {
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

		if ( isset( $_POST['grve_portfolio_media_save_nonce'] ) && wp_verify_nonce( $_POST['grve_portfolio_media_save_nonce'], 'grve_nonce_save' ) ) {


			//Media Slider Items
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
				delete_post_meta( $post->ID, 'grve_portfolio_slider_items' );
				delete_post_meta( $post->ID, 'grve_portfolio_slider_settings' );
			} else{
				update_post_meta( $post->ID, 'grve_portfolio_slider_items', $media_slider_items );

				$media_slider_speed = 3500;
				$media_slider_direction_nav = '1';
				$media_slider_direction_nav_color = 'dark';
				if ( isset( $_POST['grve_portfolio_slider_settings_speed'] ) ) {
					$media_slider_speed = $_POST['grve_portfolio_slider_settings_speed'];
				}
				if ( isset( $_POST['grve_portfolio_slider_settings_direction_nav'] ) ) {
					$media_slider_direction_nav = $_POST['grve_portfolio_slider_settings_direction_nav'];
				}
				if ( isset( $_POST['grve_portfolio_slider_settings_direction_nav_color'] ) ) {
					$media_slider_direction_nav_color = $_POST['grve_portfolio_slider_settings_direction_nav_color'];
				}

				$media_slider_settings = array (
					'slideshow_speed' => $media_slider_speed,
					'direction_nav' => $media_slider_direction_nav,
					'direction_nav_color' => $media_slider_direction_nav_color,
				);
				update_post_meta( $post->ID, 'grve_portfolio_slider_settings', $media_slider_settings );
			}

		}

	}

//Omit closing PHP tag to avoid accidental whitespace output errors.
