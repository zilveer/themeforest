<div class="cf-elm-block" id="cfpf-format-link-url" style="display: none;">
	<!-- <label for="cfpf-format-link-url-field"><?php _e('URL', 'cf-post-format'); ?></label>
	<input type="text" name="_format_link_url" value="<?php echo esc_attr(get_post_meta($post->ID, '_format_link_url', true)); ?>" id="cfpf-format-link-url-field" tabindex="1" /> -->

		<div id="postbox-container-postformat" class="postbox-container">
		<!-- <div class="meta-box-sortables ui-sortable"> -->

			<div id="meta-box-postformat-video" class="postbox" style="display: block;">
				
				<div class="handlediv"><br></div>
				<h3><span><?php _e('Link URL', 'framework'); ?></span></h3>
				
				<div class="inside">

					<table class="form-table">
						<tbody>
							<tr>
								<th>
									<label for="postformat_link_url">
										<strong><?php _e('Link URL', 'framework'); ?></strong>
										<span><?php _e('The URL of your link.', 'framework'); ?></span>
									</label>
								</th>
								<td>
									<input type="text" name="postformat_link_url" id="postformat_link_url" value="<?php echo esc_attr(get_post_meta($post->ID, 'postformat_link_url', true)); ?>" size="30">
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