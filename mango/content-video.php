<?php 
		global $blog_settings, $mango_settings, $post;
		$video_embed = get_post_meta($post->ID, 'mango_video_embed', true); 
?>
<?php
		if($video_embed){ 
?>
		<div class="entry-media embed-responsive embed-responsive-16by9">
			<?php echo wp_oembed_get( esc_url($video_embed), array( 'width' => '500', 'height' => '281') ); ?>
		</div><!-- End .entry-media -->
<?php 	} ?>