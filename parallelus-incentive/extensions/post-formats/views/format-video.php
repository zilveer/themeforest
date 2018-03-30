<div class="cf-elm-block" id="cfpf-format-video-fields" style="display: none;">
	<!-- <label for="cfpf-format-video-embed"><?php _e('Video URL (oEmbed) or Embed Code', 'cf-post-format'); ?></label>
	<textarea name="_format_video_embed" id="cfpf-format-video-embed" tabindex="1"><?php echo esc_textarea(get_post_meta($post->ID, '_format_video_embed', true)); ?></textarea> -->


	<div id="postbox-container-postformat" class="postbox-container">
		<!-- <div class="meta-box-sortables ui-sortable"> -->

			<div id="meta-box-postformat-video" class="postbox" style="display: block;">
				
				<div class="handlediv"><br></div>
				<h3><span><?php _e('Video Options', 'framework'); ?></span></h3>
				
				<div class="inside">

					<p style="padding:10px 0 0 0;"><?php _e('For HTML5 video support and Flash fallback please include an M4V file. Include an OGV file optionally to increase cross browser support.', 'framework'); ?></p>

					<table class="form-table">
						<tbody>
							<!-- <tr>
								<th>
									<label for="postformat_video_height">
										<strong><?php _e('Video Height', 'framework'); ?></strong>
										<span><?php _e('The video height (e.g. 500).', 'framework'); ?></span>
									</label>
								</th>
								<td>
									<input type="text" name="postformat_video_height" id="postformat_video_height" value="<?php echo esc_attr(get_post_meta($post->ID, 'postformat_video_height', true)); ?>" size="30">
								</td>
							</tr> -->
							<tr>
								<th>
									<label for="postformat_video_m4v">
										<strong><?php _e('M4V File URL', 'framework'); ?></strong>
										<span><?php _e('The URL to the .m4v video file', 'framework'); ?></span>
									</label>
								</th>
								<td>
									<input type="text" name="postformat_video_m4v" id="postformat_video_m4v" value="<?php echo esc_attr(get_post_meta($post->ID, 'postformat_video_m4v', true)); ?>" size="30">
								</td>
							</tr>
							<tr>
								<th>
									<label for="postformat_video_ogv">
										<strong><?php _e('OGV File URL', 'framework'); ?></strong>
										<span><?php _e('The URL to the .ogv video file', 'framework'); ?></span>
									</label>
								</th>
								<td>
									<input type="text" name="postformat_video_ogv" id="postformat_video_ogv" value="<?php echo esc_attr(get_post_meta($post->ID, 'postformat_video_ogv', true)); ?>" size="30">
								</td>
							</tr>
							<tr>
								<th>
									<label for="postformat_video_webm">
										<strong><?php _e('WEBM File URL', 'framework'); ?></strong>
										<span><?php _e('The URL to the .webm video file', 'framework'); ?></span>
									</label>
								</th>
								<td>
									<input type="text" name="postformat_video_webm" id="postformat_video_webm" value="<?php echo esc_attr(get_post_meta($post->ID, 'postformat_video_webm', true)); ?>" size="30">
								</td>
							</tr>
							<tr>
								<th>
									<label for="postformat_video_poster">
										<strong><?php _e('Video Poster', 'framework'); ?></strong>
										<span><?php _e('A preivew image.', 'framework'); ?></span>
									</label>
								</th>
								<td>
									<input type="text" name="postformat_video_poster" id="postformat_video_poster" value="<?php echo esc_attr(get_post_meta($post->ID, 'postformat_video_poster', true)); ?>" size="30">
								</td>
							</tr>
							<tr style="border-top: 1px solid #eeeeee;">
								<th>
									<label for="postformat_video_embed">
										<strong><?php _e('Embedded Code', 'framework'); ?></strong>
										<span><?php _e('If not using self hosted video you can include embeded code here.', 'framework'); ?></span>
									</label>
								</th>
								<td>
									<textarea name="postformat_video_embed" id="postformat_video_embed" rows="8" cols="5"><?php echo esc_textarea(get_post_meta($post->ID, 'postformat_video_embed', true)); ?></textarea>
								</td>
							</tr>
						</tbody>
					</table>

				</div>
			</div>

		<!-- </div> -->
	</div>

	<div class="clear"></div>

</div>



