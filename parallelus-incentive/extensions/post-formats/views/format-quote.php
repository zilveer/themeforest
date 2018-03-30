<div class="cf-elm-block" id="cfpf-format-quote-fields" style="display: none;">
	<!-- <div class="cf-elm-block">
		<label for="cfpf-format-quote-source-name"><?php _e('Source Name', 'cf-post-format'); ?></label>
		<input type="text" name="_format_quote_source_name" value="<?php echo esc_attr(get_post_meta($post->ID, '_format_quote_source_name', true)); ?>" id="cfpf-format-quote-source-name" tabindex="1" />
	</div>
	<div class="cf-elm-block">
		<label for="cfpf-format-quote-source-url"><?php _e('Source URL', 'cf-post-format'); ?></label>
		<input type="text" name="_format_quote_source_url" value="<?php echo esc_attr(get_post_meta($post->ID, '_format_quote_source_url', true)); ?>" id="cfpf-format-quote-source-url" tabindex="1" />
	</div> -->


	<div id="postbox-container-postformat" class="postbox-container">
		<!-- <div class="meta-box-sortables ui-sortable"> -->

			<div id="meta-box-postformat-video" class="postbox" style="display: block;">
				
				<div class="handlediv"><br></div>
				<h3><span><?php _e('Quote', 'framework'); ?></span></h3>
				
				<div class="inside">

					<table class="form-table">
						<tbody>
							<tr>
								<th>
									<label for="postformat_quote_text">
										<strong><?php _e('Quote', 'framework'); ?></strong>
										<span><?php _e('The text being quoted.', 'framework'); ?></span>
									</label>
								</th>
								<td>
									<textarea name="postformat_quote_text" id="postformat_quote_text" rows="8" cols="5"><?php echo esc_attr(get_post_meta($post->ID, 'postformat_quote_text', true)); ?></textarea>
								</td>
							</tr>
							<tr>
								<th>
									<label for="postformat_quote_source">
										<strong><?php _e('Source Name', 'framework'); ?></strong>
										<span><?php _e('The person being cited.', 'framework'); ?></span>
									</label>
								</th>
								<td>
									<input type="text" name="postformat_quote_source" id="postformat_quote_source" value="<?php echo esc_attr(get_post_meta($post->ID, 'postformat_quote_source', true)); ?>" size="30">
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