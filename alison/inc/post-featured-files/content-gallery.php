<?php 
// Prevent loading this file directly
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $gorilla_home_layout, $gorilla_is_mobile;

$gorilla_images = get_post_meta( $post->ID, 'gorilla_post_gallery_images' );
$gorilla_gallery_type = get_post_meta( $post->ID, 'gorilla_gallery_layout', true );
$gorilla_post_gallery_row_height = get_post_meta( $post->ID, 'gorilla_post_gallery_row_height', true );

$gorilla_template_uri = get_template_directory_uri();

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

?>
			
<?php if($gorilla_images) : ?>
<div class="post-featured-item gallery-post">

	<?php if($gorilla_gallery_type == "gallery-thumbnail") : ?>
	<div class="justified-gallery" data-row-height="<?php echo esc_attr($gorilla_post_gallery_row_height); ?>">

		<?php foreach($gorilla_images as $image) : ?>
			
			<?php

				$gorilla_image = wp_get_attachment_image_src( $image, $images_size );
				$gorilla_image_full = wp_get_attachment_image_src( $image, "full" );
				$gorilla_caption = get_post($image)->post_excerpt; 
			?>
			<div class="item">
				<a href="<?php echo esc_url($gorilla_image_full[0]); ?>">
					<img src="<?php echo esc_url($gorilla_image[0]); ?>" width="<?php echo esc_attr($gorilla_image[1]); ?>" height="<?php echo esc_attr($gorilla_image[2]); ?>" alt="<?php echo esc_html($gorilla_caption); ?>" />
					<?php if($gorilla_caption) : ?><span class="custom-caption"><?php echo esc_html($gorilla_caption); ?></span><?php endif; ?>
				</a>
			</div>
			
		<?php endforeach; ?>

	</div>
	<?php else : ?>
	<div class="fotorama" data-nav="false" data-allowfullscreen="true" data-click="false">

		<?php foreach($gorilla_images as $image) : ?>
			
			<?php
				$gorilla_image_full = wp_get_attachment_image_src( $image, $images_size );
				$gorilla_caption = get_post($image)->post_excerpt;
			?>
			<img src="<?php echo esc_url($gorilla_image_full[0]); ?>" width="<?php echo esc_attr($gorilla_image_full[1]); ?>" height="<?php echo esc_attr($gorilla_image_full[2]); ?>" alt="<?php echo esc_html($gorilla_caption); ?>" <?php if($gorilla_caption) : ?>data-caption="<?php echo esc_html($gorilla_caption); ?>"<?php endif; ?> />
		<?php endforeach; ?>

	</div>
	<?php endif; ?>

	<div class="arrow-bg"></div>

</div>

<?php else : ?>
<?php if(has_post_thumbnail()){ ?>
<div class="post-featured-item gallery-post">
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