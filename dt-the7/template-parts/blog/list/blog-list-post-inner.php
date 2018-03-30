<?php
/**
 * Blog simple post content
 * @package vogue
 * @since   1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$config = presscore_get_config();
?>

<?php if ( ! post_password_required() && has_post_thumbnail() ): ?>

	<div class="blog-media wf-td" <?php echo presscore_get_post_content_style_for_blog_list( 'media' ); ?>>

		<?php
		echo presscore_get_blog_post_fancy_date();

		$thumb_args = array(
			'class'  => 'rollover',
			'img_id' => get_post_thumbnail_id(),
			'href'   => get_permalink(),
			'wrap'   => '<a %HREF% %CLASS% %CUSTOM%><img %IMG_CLASS% %SRC% %ALT% %IMG_TITLE% %SIZE% /></a>',
		);

		if ( 'normal' == $config->get( 'post.preview.width' ) ) {
			$thumb_args['class'] .= ' alignleft';
		} else {
			$thumb_args['class'] .= ' alignnone';
		}

		$thumb_args = apply_filters( 'dt_post_thumbnail_args', $thumb_args );

		dt_get_thumb_img( $thumb_args );
		?>

	</div>

<?php endif; ?>

<div class="blog-content wf-td" <?php echo presscore_get_post_content_style_for_blog_list( 'content' ); ?>>

	<h3 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo the_title_attribute( 'echo=0' ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>

	<?php
	echo presscore_get_posted_on();

	if ( $config->get( 'show_excerpts' ) ) {
		presscore_the_excerpt();
	}

	if ( $config->get( 'show_details' ) ) {
		echo presscore_post_details_link();
	}

	echo presscore_post_edit_link();
	?>

</div>