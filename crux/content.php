<?php
/**
 * The template used for displaying content in index.php.
 *
 * @package StagFramework
 * @subpackage Crux
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); stag_markup_helper( array( 'context' => 'entry' ) ); ?>>
	<header class="entry-header">
		<?php if ( has_post_thumbnail() ) : ?>
			<figure class="post-thumbnail">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail('full'); ?></a>
			</figure>
		<?php endif; ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php stag_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>

		<h1 class="entry-title"<?php stag_markup_helper( array( 'context' => 'title' ) ); ?>><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary"<?php stag_markup_helper( array( 'context' => 'entry_content' ) ); ?>>
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content"<?php stag_markup_helper( array( 'context' => 'entry_content' ) ); ?>>
		<?php the_content( __( 'Read More<span class="meta-nav">&hellip;</span>', 'stag' ) ); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'stag' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>
</article><!-- #post-## -->
