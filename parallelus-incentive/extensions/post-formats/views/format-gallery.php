<div id="cfpf-format-gallery-preview" class="cf-elm-block cf-elm-block-image" style="display: none;">
	<!-- <label><span><?php _e('Gallery Images', 'framework'); ?></span></label> -->
	<div class="cf-elm-container">
		<div id="post-format-gallery-items">
		<?php

			// running this in the view so it can be used by multiple functions

			$ids = esc_attr(get_post_meta($post->ID, 'postformat_gallery_ids', true));
			$attachments = get_posts( array(
				        'post__in' => explode(",", $ids),
			            // 'post_parent' => $postid,
			            'orderby' => 'post__in',
			            'post_type' => 'attachment',
			            // 'post_parent' => $post->ID,
			            'post_mime_type' => 'image',
			            'post_status' => 'any',
			            'numberposts' => -1
			        ));
			if ($attachments) {
				echo '<ul class="gallery">';
				foreach ($attachments as $attachment) {
					echo '<li>'.wp_get_attachment_image($attachment->ID, 'thumbnail').'</li>';
				}
				echo '</ul>';
			}
		?>
		</div>
		<p class="none"><a href="#" class="button"><?php ($ids) ? _e('Edit Gallery', 'framework') : _e('Add Images to Gallery', 'framework'); ?></a></p>
		<input type="hidden" name="postformat_gallery_ids" value="<?php echo esc_attr(get_post_meta($post->ID, 'postformat_gallery_ids', true)); ?>" id="cfpf-format-gallery-ids-field">
		<input type="hidden" name="_format_gallery_nonce" value="<?php echo wp_create_nonce( 'do_ajax' ); ?>" id="cfpf-format-gallery-nonce-field" >
	</div>
</div>