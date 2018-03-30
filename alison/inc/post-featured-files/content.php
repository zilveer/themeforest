<?php 
// Prevent loading this file directly
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $gorilla_home_layout, $gorilla_is_mobile;
$gorilla_template_uri = get_template_directory_uri();

if($gorilla_is_mobile) {
	if((is_home() && $gorilla_home_layout == 'list') || (is_archive() && get_theme_mod( 'gorilla_archive_layout' ) == 'list')) {
		$images_size = 'thumbnail-grid-2';
	}
	else {
		$images_size = 'thumbnail-slider';
	}
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
		else if((is_home() && $gorilla_home_layout == 'list') || (is_archive() && get_theme_mod( 'gorilla_archive_layout' ) == 'list')) {
			$images_size = 'thumbnail-grid-2';
		}
		else {
			$images_size = 'thumbnail-slider';
		}
	}
}

?>

	<?php $gorilla_featured_image = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), $images_size ); ?>
	<?php $gorilla_caption = get_post_field('post_excerpt', $post->ID);

	if($gorilla_featured_image):

	?>
	<div class="post-featured-item">
		<div class="post-featured-item-inner">
			<?php if(!is_single()) : ?>
			<a href="<?php echo get_permalink(); ?>">
			<?php endif; ?>
				<?php the_post_thumbnail($gorilla_featured_image); ?>
				<?php 				
					if (get_post(get_post_thumbnail_id())->post_excerpt) {
						if( ($gorilla_home_layout == 'full' && is_home()) || (is_archive() && get_theme_mod( 'gorilla_archive_layout', 'full' ) == 'full') || is_singular() ){
						echo "<span class='custom-caption'>".get_post(get_post_thumbnail_id())->post_excerpt.'</span>';
						}
					}
				?>
			<?php if(!is_single()) : ?>
			</a>
			<?php endif; ?>

			<div class="arrow-bg"></div>
		</div>

	</div>

	<?php endif; ?>
