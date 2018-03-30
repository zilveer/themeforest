<?php
// Prevent loading this file directly
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $gorilla_home_layout, $gorilla_is_mobile;
$gorilla_video_type = get_post_meta( $post->ID, 'gorilla_video_list', true );
$gorilla_template_uri = get_template_directory_uri();

$gorilla_video_file_mp4_url = $gorilla_video_file_mp4_url_link = $gorilla_video_file_webm_url = $gorilla_video_file_ogv_url = $gorilla_video_file_webm_url_link = $gorilla_video_file_ogv_url_link = "";

?>


	<?php if ($gorilla_video_type == "embed") :
		$gorilla_video_embed_url = get_post_meta( $post->ID, "gorilla_embed_video_url", true );
	?>

		<?php if($gorilla_video_embed_url): ?>
		<div class="post-featured-item video-post">
			<div class="video-wrapper embed">
				<?php echo wp_oembed_get($gorilla_video_embed_url); ?>
			</div>
			<div class="arrow-bg"></div>
		</div>
		<?php endif; ?>

	<?php elseif ($gorilla_video_type == "native") :

		if($gorilla_is_mobile) {
			$images_size = 'thumbnail-slider';
		}
		else {
			if(is_single()){
				$images_size = 'thumbnail-full';
			}
			else if(is_search()){
				$images_size = 'thumbnail-full';
			}
			else {
				if((is_home() && $gorilla_home_layout == 'full') || (is_archive() && get_theme_mod( 'gorilla_archive_layout', 'full' ) == 'full')) {
					$images_size = 'thumbnail-full';
				}
				else {
					$images_size = 'thumbnail-slider';
				}
			}
		}

		$gorilla_video_poster = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), $images_size );
		$gorilla_video_poster = $gorilla_video_poster[0];

		$gorilla_video_file_mp4 = get_post_meta( $post->ID, "gorilla_inner_video_file_mp4" );
		foreach ( $gorilla_video_file_mp4 as $info )
		{
			$gorilla_video_file_mp4_url = wp_get_attachment_url($info);
			$gorilla_video_file_mp4_url_link = wp_get_attachment_link($info);
		}

		$gorilla_video_file_webm = get_post_meta( $post->ID, "gorilla_inner_video_file_webm" );
		foreach ( $gorilla_video_file_webm as $info )
		{
			$gorilla_video_file_webm_url = wp_get_attachment_url($info);
			$gorilla_video_file_webm_url_link = wp_get_attachment_link($info);
		}

		$gorilla_video_file_ogv = get_post_meta( $post->ID, "gorilla_inner_video_file_ogv" );
		foreach ( $gorilla_video_file_ogv as $info )
		{
			$gorilla_video_file_ogv_url = wp_get_attachment_url($info);
			$gorilla_video_file_ogv_url_link = wp_get_attachment_link($info);
		}

		?>

		<?php if($gorilla_video_file_mp4 || $gorilla_video_file_webm): ?>
		<div class="post-featured-item video-post">
			<div class="video-wrapper native">
				<video preload="none" style="width:100%;height:100%;" poster="<?php echo esc_attr($gorilla_video_poster); ?>">
					<?php if($gorilla_video_file_webm_url != ""){ ?>
					<source type="video/webm" src="<?php echo esc_url($gorilla_video_file_webm_url); ?>">
					<?php } ?>
					<?php if($gorilla_video_file_mp4_url != ""){ ?>
					<source type="video/mp4" src="<?php echo esc_url($gorilla_video_file_mp4_url); ?>">
					<?php } ?>
					<?php if($gorilla_video_file_ogv_url != ""){ ?>
					<source type="video/ogg" src="<?php echo esc_url($gorilla_video_file_ogv_url); ?>">
					<?php } ?>
					<?php echo esc_url($gorilla_video_file_mp4_url_link).esc_url($gorilla_video_file_webm_url_link).esc_url($gorilla_video_file_ogv_url_link); ?>
				</video>
			</div>
			<div class="arrow-bg"></div>
		</div>
		<?php endif;

	else : ?>
	<?php if(has_post_thumbnail()){ ?>
	<div class="post-featured-item video-post">

	<?php
		if($gorilla_is_mobile) {
			$images_size = 'thumbnail-slider';
		}
		else {
			if(is_single()){
				$images_size = 'thumbnail-full';
			}
			else if(is_search()){
				$images_size = 'thumbnail-full';
			}
			else {
				if((is_home() && $gorilla_home_layout == 'full') || (is_archive() && get_theme_mod( 'gorilla_archive_layout', 'full' ) == 'full')) {
					$images_size = 'thumbnail-full';
				}
				else {
					$images_size = 'thumbnail-slider';
				}
			}
		}

		the_post_thumbnail($images_size); ?>

		<div class="arrow-bg"></div>
		
	</div>
	<?php } ?>
	<?php endif; ?>
