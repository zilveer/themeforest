<?php
/**
 * @package cshero
 */
?>
<?php global $smof_data,$post; ?>
<?php
	wp_enqueue_style( 'media-audio', get_template_directory_uri().'/css/media-audio.css',array(),'2.14.1');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
	<div class="cs-blog">
		<header class="cs-blog-header">
		<div class="cs-blog-media">
		<div class="cs-blog-thumbnail">
			<?php
			$audio_type = get_post_meta($post->ID, 'cs_post_audio_type', true);
			$audio_url = get_post_meta($post->ID, 'cs_post_audio_url', true);
			if($audio_type):
				?>
				<?php
				if ($audio_type == 'content'){
					$shortcode = cshero_get_shortcode_from_content('playlist');
					if(!$shortcode){
						$shortcode = cshero_get_shortcode_from_content('audio');
					}
					if($shortcode):
						echo do_shortcode($shortcode);
					endif;
				} elseif ($audio_type == 'ogg' || $audio_type == 'mp3' || $audio_type == 'wav'){
					if($audio_url){
						echo do_shortcode('[audio '.$audio_type.'="'.$audio_url.'" preload="metadata"][/audio]');
					}
				}
				?>
				<?php elseif (has_post_thumbnail() && ! post_password_required() && ! is_attachment() && wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false)): ?>
						<?php
							$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false);
			                $image_resize = mr_image_resize( $attachment_image[0], 570, 385, true, 'c', false );
			                echo '<img alt="" class="" src="'. esc_url($image_resize)  .'"/>';
						?>
	    			<?php echo cshero_read_more_overlay_render();?>
	    			<!-- .entry-thumbnail -->
				<?php endif; ?>
			</div>
		</header><!-- .entry-header -->
		<div class="cs-blog-content">
			<div class="cs-blog-meta cs-itemBlog-meta">
				<?php echo cshero_title_render(); ?>
				<?php echo cshero_info_bar_render(); ?>
			</div>
			<?php cshero_content_render(); ?>
			<?php echo cshero_info_footer_render(); ?>
		</div><!-- .entry-content -->
		
	</div>
</article><!-- #post-## -->
