<?php 
// Prevent loading this file directly
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $gorilla_home_layout, $gorilla_is_mobile;
$gorilla_template_uri = get_template_directory_uri();

?>

	<?php $gorilla_audio_type = get_post_meta( $post->ID, 'gorilla_audio_list', true ); ?>
	<?php if ($gorilla_audio_type == "embed") :
		$gorilla_audio_embed_url = get_post_meta( $post->ID, "gorilla_embed_audio_url", true );
	?>

	<div class="post-featured-item audio-post">
		<div class="audio-wrapper embed">
			<?php echo wp_oembed_get($gorilla_audio_embed_url); ?>
		</div>
		<?php if(has_post_thumbnail()){ ?>
		<div class="arrow-bg"></div>
		<?php } ?>
	</div>

	<?php elseif ($gorilla_audio_type == "native") : ?>
	<div class="post-featured-item audio-post">
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

	wp_enqueue_script('wp-mediaelement');

	$gorilla_audio_file_mp3_url = $gorilla_audio_file_mp3_url_link = $gorilla_audio_file_oga_url = $gorilla_audio_file_oga_url_link = "";

	$gorilla_audio_file_mp3 = get_post_meta( $post->ID, "gorilla_audio_mp3_file" );
	foreach ( $gorilla_audio_file_mp3 as $info )
	{
		$gorilla_audio_file_mp3_url = wp_get_attachment_url($info);
		$gorilla_audio_file_mp3_url_link = wp_get_attachment_link($info);
	}

	$gorilla_audio_file_oga = get_post_meta( $post->ID, "gorilla_audio_oga_file" );
	foreach ( $gorilla_audio_file_oga as $info )
	{
		$gorilla_audio_file_oga_url = wp_get_attachment_url($info);
		$gorilla_audio_file_oga_url_link = wp_get_attachment_link($info);
	}

	the_post_thumbnail($images_size);

	?>

		<div class="audio-wrapper native">
			<audio preload="none">
				<?php if($gorilla_audio_file_mp3_url != ""){ ?>
				<source type="audio/mpeg" src="<?php echo esc_url($gorilla_audio_file_mp3_url); ?>">
				<?php } ?>
				<?php if($gorilla_audio_file_oga_url != ""){ ?>
				<source type="audio/ogg" src="<?php echo esc_url($gorilla_audio_file_oga_url); ?>">
				<?php } ?>
				<?php echo esc_url($gorilla_audio_file_mp3_url_link).esc_url($gorilla_audio_file_oga_url_link); ?>
			</audio>
		</div>
		<?php if(has_post_thumbnail()){ ?>
		<div class="arrow-bg"></div>
		<?php } ?>
	</div>
	<?php else :
	
	if(has_post_thumbnail()){ ?>
	<div class="post-featured-item audio-post">

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

		<?php if(has_post_thumbnail()){ ?>
		<div class="arrow-bg"></div>
		<?php } ?>

	</div>
	<?php }

	endif; ?>
