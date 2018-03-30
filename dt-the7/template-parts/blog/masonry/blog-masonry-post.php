<?php
/**
 * Blog post template for masonry layout.
 */

// File Security Check.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Remove presscore_the_excerpt() filter.
remove_filter( 'presscore_post_details_link', 'presscore_return_empty_string', 15 );

$config = presscore_config();
?>

<?php do_action( 'presscore_before_post' ); ?>

	<article <?php post_class( 'post' ); ?>>

		<?php if ( ! post_password_required() && has_post_thumbnail() ): ?>

			<div class="blog-media wf-td">

				<?php
				echo presscore_get_blog_post_fancy_date();

				$thumb_args = array(
					'img_id'  => get_post_thumbnail_id(),
					'options' => presscore_set_image_dimesions(),
					'class'   => 'alignnone rollover',
					'href'    => get_permalink(),
					'wrap'    => '<p><a %HREF% %CLASS% %CUSTOM%><img %IMG_CLASS% %SRC% %ALT% %IMG_TITLE% %SIZE% /></a></p>',
				);

				$thumb_args = apply_filters( 'dt_post_thumbnail_args', $thumb_args );

				dt_get_thumb_img( $thumb_args );
				?>

			</div>

		<?php endif; ?>

		<div class="blog-content wf-td">
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

	</article>

<?php do_action( 'presscore_after_post' ); ?>