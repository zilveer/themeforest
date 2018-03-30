<?php
/**
 * @package cshero
 */
global $smof_data,$post;
$video_source = get_post_meta($post->ID, 'cs_post_video_source', true);
$video_height = get_post_meta($post->ID, 'cs_post_video_height', true);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
	<?php if($video_source){ ?>
		<div class="single-post-media">
			<?php
			switch ($video_source) {
				case 'youtube':
					$video_youtube = get_post_meta($post->ID, 'cs_post_video_youtube', true);
					if($video_youtube){
						echo do_shortcode('[cs-video width="100%" height="'.$video_height.'"]'.$video_youtube.'[/cs-video]');
					}
					break;
				case 'vimeo':
					$video_vimeo = get_post_meta($post->ID, 'cs_post_video_vimeo', true);
					if($video_vimeo){
						echo do_shortcode('[cs-video width="100%" height="'.$video_height.'"]'.$video_vimeo.'[/cs-video]');
					}
					break;
				case 'media':
					$video_type = get_post_meta($post->ID, 'cs_post_audio_type', true);
					$preview_image = get_post_meta($post->ID, 'cs_post_preview_image', true);
					$video_file = get_post_meta($post->ID, 'cs_post_video_url', true);
					if($video_file){
						echo do_shortcode('[video width="100%" height="'.$video_height.'" '.$video_type.'="'.$video_file.'" poster="'.$preview_image.'"][/video]');
					}
					break;
			}
			?>
		</div>
	<?php } elseif ($smof_data['post_featured_images'] == '1' ) { ?>
		<?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) : ?>
			<div class="single-post-thumbnail">
				<?php the_post_thumbnail('full'); ?>
			</div><!-- .entry-thumbnail -->
		<?php endif; ?>
	<?php } ?>
	
	<header class="single-post-header">
		<?php echo cshero_post_details_info_render();?>
		<?php if($smof_data['show_post_title'] == '1'): ?>
			<div class="single-post-title"><<?php echo esc_attr($smof_data['detail_title_heading']);?> class="cs-entry-title"><?php the_title(); ?></<?php echo esc_attr($smof_data['detail_title_heading']);?>></div>
		<?php endif; ?>
	</header><!-- .entry-header -->
	<div class="single-post-content">
		<?php
			the_content();
			wp_link_pages( array(
				'before'      => '<div class="pagination loop-pagination"><span class="page-links-title">' . __( 'Pages:',THEMENAME) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span class="page-numbers">',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->