<?php /* The template for displaying posts in the Audio post format */

/* Add responsive bootstrap classes */
$classes = array();
if (function_exists('pt_single_content_class')) $classes[] = pt_single_content_class();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?> itemscope="itemscope" itemtype="http://schema.org/Article">
	<?php
	global $post;
	/* Get attached audios */
	$args = array(
		'post_parent' => get_the_ID(),
		'post_type' => 'attachment',
		'post_mime_type' => 'audio',
		'posts_per_page' => -1,
		'post_status' => 'any',
	);
	$audios = get_attached_media( 'audio', $post->ID );
	$ids = array();
	foreach ($audios as $audio) {
		$ids[] = $audio->ID;
	}
	$ids_string = implode(",", $ids);
	if ($ids_string && !is_single()) {

		if (count($ids)!=1) { ?>
			<div class="audio-wrapper">
		<?php } else { ?>
			<div class="audio-wrapper single-audio">
		<?php }
		echo do_shortcode( '[playlist ids="'.esc_attr($ids_string).'"]' );
		echo '</div>';

	} ?>

	<div class="content-wrapper" role="main">
		<header class="entry-header">
			<?php
				if ( is_single() ) :
					the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' );
				else :
					the_title( '<h1 class="entry-title" itemprop="headline"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" itemprop="url">', '</a></h1>' );
				endif;
			?>
		</header><!-- .entry-header -->

		<div class="entry-meta">
			<?php pt_entry_author(); ?>
			<?php pt_entry_post_cats(); ?>
			<?php pt_entry_publication_time()?>
			<?php edit_post_link( __( 'Edit', 'plumtree' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-meta -->

		<div class="entry-content" itemprop="articleBody">
			<?php the_content( apply_filters( 'pt_more', __('Continue Reading...', 'plumtree')) ); ?>

			<?php wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'plumtree' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '%',
				'separator'   => '&nbsp;',
			) ); ?>
		</div><!-- .entry-content -->

		<?php if ( !is_single() ) : ?>
			<div class="entry-additional-meta">
				<?php if ( ! post_password_required() ) { pt_entry_comments_counter(); } ?>
				<?php if (function_exists('pt_output_likes_counter')) {
					echo pt_output_likes_counter(get_the_ID());
				} ?>
			</div>
		<?php endif; ?>

		<?php /* Footer of the article */ get_template_part( 'partials/post-meta' ); ?>
	</div>

</article><!-- #post-## -->
