<?php
if (!defined('ABSPATH')) exit();

if (is_single()) {

	global $post;

	if ( has_post_thumbnail( $post->ID ) ) {
		?>

		<a href="<?php the_permalink(); ?>" class="single-image link-icon">
			<img src="<?php echo esc_url(TMM_Helper::get_post_featured_image($post->ID, '')); ?>" alt="<?php echo esc_attr($post->post_title); ?>" />
		</a>

		<?php
	}

} else {

	$thumb_size = '460*290';

	if ( get_post_type(get_the_ID()) === 'car' ) {
		$thumb_src = tmm_get_car_cover_image( get_the_ID(), 'thumb' );
	} else {
		$thumb_src = TMM_Helper::get_post_featured_image( get_the_ID(), $thumb_size );
	}

	?>

	<a href="<?php the_permalink(); ?>" class="single-image link-icon">
		<img class="entry-image" src="<?php echo esc_url( $thumb_src ); ?>" alt="<?php the_title_attribute(); ?>" />
	</a>

	<?php
}