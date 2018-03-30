<?php
/**
 * @package cshero
 */
global $smof_data,$post;
$audio_type = get_post_meta($post->ID, 'cs_post_audio_type', true);
wp_enqueue_style( 'media-audio', get_template_directory_uri().'/css/media-audio.css',array(),'2.14.1');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
	<?php
		if($audio_type == 'ogg' || $audio_type == 'mp3' || $audio_type == 'wav'){
			$audio_url = get_post_meta($post->ID, 'cs_post_audio_url', true);
			if($audio_url){
				echo '<div class="single-post-thumb single-post-media">';
				echo do_shortcode('[audio '.$audio_type.'="'.$audio_url.'"][/audio]');
				echo '</div>';
			}
		}
	?>
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