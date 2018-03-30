<?php
/**
 * Centered blog layout template.
 */

// File Security Check.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$config = presscore_config();
?>

<div class="post-entry-title-content">
	<h3 class="entry-title">
		<a href="<?php the_permalink(); ?>" title="<?php echo the_title_attribute( 'echo=0' ); ?>" rel="bookmark"><?php the_title(); ?></a>
	</h3>

	<?php echo presscore_get_posted_on(); ?>
</div>

<?php if ( presscore_post_format_supports_media_content( get_post_format() ) ) : ?>

<div class="post-thumbnail-wrap">
	<div class="post-thumbnail">

		<?php
		if ( $config->get( 'post.fancy_date.enabled' ) ) {
			echo DT_Blog_Shortcode_HTML::get_fancy_date();
		}
		?>

		<?php
		if ( $config->get( 'post.fancy_category.enabled' ) ) {
			$fancy_category_args = ( isset( $fancy_category_args ) ? $fancy_category_args : array() );
			echo DT_Blog_Shortcode_HTML::get_fancy_category( $fancy_category_args );
		}
		?>

		<?php
		if ( isset( $post_media ) ) {
			echo $post_media;
		}
		?>

	</div>
</div>

<?php endif; ?>

<div class="post-entry-content">

	<?php
	if ( $config->get( 'show_excerpts' ) && isset( $post_excerpt ) ) {
		echo '<div class="entry-excerpt">';
		echo $post_excerpt;
		echo '</div>';
	}
	?>

	<?php
	if ( $config->get( 'show_details' ) && isset( $details_btn ) ) {
		echo $details_btn;
	}
	?>

	<?php
	// TODO: Uncomment on production.
	// echo presscore_post_edit_link();
	?>

</div>