<div class="cf-elm-block" id="cfpf-format-audio-fields" style="display: none;">
	<!-- <label for="cfpf-format-audio-embed"><?php _e('Audio URL (oEmbed) or Embed Code', 'cf-post-format'); ?></label>
	<textarea name="_format_audio_embed" id="cfpf-format-audio-embed" tabindex="1"><?php echo esc_textarea(get_post_meta($post->ID, '_format_audio_embed', true)); ?></textarea> -->


	<div id="postbox-container-postformat" class="postbox-container">
		<!-- <div class="meta-box-sortables ui-sortable"> -->

			<div id="meta-box-postformat-video" class="postbox" style="display: block;">
				
				<div class="handlediv"><br></div>
				<h3><span><?php _e('Audio Options', 'framework'); ?></span></h3>
				
				<div class="inside">

					<p style="padding:10px 0 0 0;"><?php _e('Enter the paths to your audio files in the fields below', 'framework'); ?></p>

					<table class="form-table">
						<tbody>
							<tr>
								<th>
									<label for="postformat_audio_mp3">
										<strong><?php _e('MP3 File URL', 'framework'); ?></strong>
										<span><?php _e('URL to an .mp3 file', 'framework'); ?></span>
									</label>
								</th>
								<td>
									<input type="text" name="postformat_audio_mp3" id="postformat_audio_mp3" value="<?php echo esc_attr(get_post_meta($post->ID, 'postformat_audio_mp3', true)); ?>" size="30">
								</td>
							</tr>
							<tr>
								<th>
									<label for="postformat_audio_ogg">
										<strong><?php _e('OGA File URL', 'framework'); ?></strong>
										<span><?php _e('URL to an .oga or .ogg file', 'framework'); ?></span>
									</label>
								</th>
								<td>
									<input type="text" name="postformat_audio_ogg" id="postformat_audio_ogg" value="<?php echo esc_attr(get_post_meta($post->ID, 'postformat_audio_ogg', true)); ?>" size="30">
								</td>
							</tr>
							<tr>
								<th>
									<label for="postformat_audio_embedded">
										<strong><?php _e('Embedded Audio', 'framework'); ?></strong>
										<span><?php _e('Add embedded audio formats.', 'framework'); ?></span>
									</label>
								</th>
								<td>
									<textarea name="postformat_audio_embedded" id="postformat_audio_embedded" rows="8" cols="5"><?php echo esc_textarea(get_post_meta($post->ID, 'postformat_audio_embedded', true)); ?></textarea>
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