<?php
/**
 * The template part for displaying single posts
 *
 * @package Pile
 * @since   Pile 1.0
 */

$classes = array( 'entry--single', 'pr', 'clearfix' );
if ( has_post_thumbnail() ) {
	$classes[] = 'has-thumbnail';
} else {
	$classes[] = 'has-no-thumbnail';
}
?>

<article id="post-<?php the_ID(); ?>"  <?php post_class( $classes ); ?>>

	<div class="post__header">
		<div class="post__meta   meta meta--post">

			<?php echo pile_get_cats_list(); ?>
			<?php if ( pile_option( 'blog_show_date' ) ) : ?>
				<span class="post__date"><?php the_time( 'j F' ); ?></span>
			<?php endif; ?>

		</div><!-- .post__meta -->
		<h1 class="post__title"><?php the_title(); ?></h1>
	</div>

	<?php if ( has_post_thumbnail() ) : ?>
	<figure class="entry-thumbnail  aligncenter">
		 <?php the_post_thumbnail('full'); ?>
	</figure>
	<?php endif; ?>

	<div class="entry-content  js-post-gallery  clearfix">
		<?php the_content();

		global $numpages;
		if ( $numpages > 1 ): ?>

			<div class="entry__meta-box  meta-box--pagination">
				<span class="meta-box__title"><?php esc_html_e( 'Pages', 'pile' ); ?></span>

				<?php
				$args = array(
					'before'           => '<ol class="nav  pagination--single">',
					'after'            => '</ol>',
					'next_or_number'   => 'next_and_number',
					'previouspagelink' => esc_html__( '&laquo;', 'pile' ),
					'nextpagelink'     => esc_html__( '&raquo;', 'pile' )
				);
				wp_link_pages( $args ); ?>

			</div>

		<?php endif; ?>

	</div><!-- .entry-content -->

	<div class="entry-footer">

		<?php
		$tags = get_the_tags();
		if ( ! is_wp_error( $tags ) && ! empty( $tags ) ) : ?>

			<div class="meta  meta--tags">
				<span class="meta__head"><?php esc_html_e( 'Tagged with ', 'pile' ); ?></span>

				<?php foreach ( $tags as $tag ) {
					echo '<a href="' . get_tag_link( $tag->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s", 'pile' ), $tag->name ) ) . '" rel="tag">' . $tag->name . '</a>';
				}; ?>

			</div><!-- .meta-list.meta-list-tags -->

		<?php endif; ?>

		<?php
		edit_post_link(
			sprintf(
			/* translators: %s: Name of current post */
				__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'pile' ),
				get_the_title()
			),
			'<div class="edit-link">',
			'</div>'
		); ?>

	</div><!--entry-footer-->
</article><!-- .entry-single -->
