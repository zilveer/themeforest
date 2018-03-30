<?php
/**
 * @package cshero
 */
	global $smof_data,$post; 
	$audio_type = get_post_meta($post->ID, 'cs_post_audio_type', true);
	$audio_url = get_post_meta($post->ID, 'cs_post_audio_url', true);
	wp_enqueue_style( 'media-audio', get_template_directory_uri().'/css/media-audio.css',array(),'2.14.1');

	if ( $audio_type || has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) { 
		$class1 = 'col-xs-12 col-sm-12 col-md-6 col-lg-6 nopaddingall';
		$class2 = 'col-xs-12 col-sm-12 col-md-6 col-lg-6';
	} else {
		$class1 ='col-xs-12 col-sm-12 col-md-12 col-lg-12 nopaddingall';
		$class2 ='col-xs-12 col-sm-12 col-md-12 col-lg-12';
	}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="cs-blog row">
		<div class="<?php echo $class1;?>">
			<div class="cs-blog-media">
				<div class="cs-blog-thumbnail">
				<?php
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
					<?php elseif (has_post_thumbnail() && ! post_password_required() && ! is_attachment()): ?>
		    			<?php the_post_thumbnail(); ?>
		    			<?php echo cshero_read_more_overlay_render();?>
		    			<!-- .entry-thumbnail -->
					<?php endif; ?>
				</div>
			</div>
		</div><!-- .entry-header -->
		<div class="cs-blog-content <?php echo $class2;?>">
			<div class="cs-blog-meta cs-itemBlog-meta">
				<?php echo cshero_title_render(); ?>
				<?php echo cshero_info_bar_render(); ?>
			</div>
			<?php cshero_content_render(); ?>
			
			<?php echo cshero_info_footer_render(); ?>
			
		</div><!-- .entry-content -->
		
	</div>
</article><!-- #post-## -->
