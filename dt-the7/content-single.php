<?php
/**
 * Single post content template.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	do_action( 'presscore_before_post_content' );

	// Post media.
	$hide_thumbnail = (bool) get_post_meta( $post->ID, '_dt_post_options_hide_thumbnail', true );

	if ( has_post_thumbnail() && ! $hide_thumbnail ) {
		$thumbnail_id = get_post_thumbnail_id();
		$video_url = esc_url( get_post_meta( $thumbnail_id, 'dt-video-url', true ) );

		if ( ! $video_url ) {
			$thumb_args = array(
				'class'    => 'alignnone',
				'img_id'   => $thumbnail_id,
				'wrap'     => '<img %IMG_CLASS% %SRC% %SIZE% %IMG_TITLE% %ALT% />',
				'echo'     => false,
			);

			// Thumbnail proportions.
			if ( 'resize' === of_get_option( 'blog-thumbnail_size' ) ) {
				$prop = of_get_option( 'blog-thumbnail_proportions' );
				$width = max( absint( $prop['width'] ), 1 );
				$height = max( absint( $prop['height'] ), 1 );

				$thumb_args['prop'] = $width / $height;
			}

			$post_media_html = dt_get_thumb_img( $thumb_args );
		} else {
			$post_media_html = '<div class="post-video alignnone">' . dt_get_embed( $video_url ) . '</div>';
		}

		echo '<div class="post-thumbnail">' . $post_media_html . '</div>';
	}

	// Post content.
	echo '<div class="entry-content">';
	the_content();
	wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'the7mk2' ), 'after' => '</div>' ) );
	echo '</div>';

	$config = presscore_config();

	// Post meta.
	$post_meta = presscore_get_single_posted_on();
	if ( $config->get( 'post.meta.fields.tags' ) ) {
		$post_meta .= presscore_get_post_tags_html();
	}

	if ( $post_meta ) {
		echo '<div class="post-meta wf-mobile-collapsed">' . $post_meta . '</div>';
	}

	presscore_display_share_buttons_for_post( 'post' );

	if ( $config->get( 'post.author_block' ) ) {
		presscore_display_post_author();
	}

	echo presscore_new_post_navigation();

	presscore_display_related_posts();

	do_action( 'presscore_after_post_content' );
	?>

</article>