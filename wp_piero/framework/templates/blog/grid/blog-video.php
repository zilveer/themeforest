<?php
/**
 * @package cshero
 */
global $smof_data,$post; 
$video_source = get_post_meta($post->ID, 'cs_post_video_source', true);
$video_height = get_post_meta($post->ID, 'cs_post_video_height', true);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="cs-blog">
		<header class="cs-blog-header">
		<div class="cs-blog-media">
			<div class="cs-blog-thumbnail <?php if($video_source) echo 'has-video';?>">
    			<?php if($video_source): ?>
					<?php
					switch ($video_source) {
						case 'post':
							$shortcode = cshero_get_shortcode_from_content('playlist');
							if(!$shortcode){
								$shortcode = cshero_get_shortcode_from_content('video');
							}
							if($shortcode):
								echo do_shortcode($shortcode);
							endif;
							break;
						case 'youtube':
							$video_youtube = get_post_meta($post->ID, 'cs_post_video_youtube', true);
							if($video_youtube){
								echo do_shortcode('[cs-video height="'.$video_height.'"]'.$video_youtube.'[/cs-video]');
							}
							break;
						case 'vimeo':
							$video_vimeo = get_post_meta($post->ID, 'cs_post_video_vimeo', true);
							if($video_vimeo){
								echo do_shortcode('[cs-video height="'.$video_height.'"]'.$video_vimeo.'[/cs-video]');
							}
							break;
						case 'media':
							$video_type = get_post_meta($post->ID, 'cs_post_audio_type', true);
							$preview_image = get_post_meta($post->ID, 'cs_post_preview_image', true);
							$video_file = get_post_meta($post->ID, 'cs_post_video_url', true);
							if($video_file){
								echo do_shortcode('[video height="'.$video_height.'" '.$video_type.'="'.$video_file.'" poster="'.$preview_image.'"][/video]');
							}
							break;
					}
					?>
				<?php elseif (has_post_thumbnail() && ! post_password_required() && ! is_attachment() && wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false)) : ?>
					<?php
						$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false);
		                $image_resize = mr_image_resize( $attachment_image[0], 570, 385, true, 'c', false );
		                echo '<img alt="" class="" src="'. esc_url($image_resize)  .'"/>';
					?>
					<a class="cshero-post-link video pe-7s-video" href="<?php the_permalink(); ?>"></a>
    				<!-- .entry-thumbnail -->
				<?php endif; ?>
				<?php echo cshero_info_category_render('categories'); ?>
			</div>
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
