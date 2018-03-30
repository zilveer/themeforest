<div class="<?php echo esc_attr($class); ?>" data-count="<?php echo count( $attachments ); ?>">
	<?php foreach( $attachments as $a_id ) : ?>
		<div class="gallery-item">
			<?php
				$attachment = get_post( $a_id );

				if ( $attachment ) {
					thb_image( $a_id, $size, array(
						'link' => true,
						'link_size' => $size_big,
						'link_title' => $attachment->post_excerpt
					) );
				}
			?>
		</div>
	<?php endforeach; ?>
</div>