<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package berg-wp
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php berg_wp_posted_on(); ?>
		</div>
		<?php endif; ?>
	</header>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>
	<footer class="entry-footer">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				$categories_list = get_the_category_list( __( ' | ', 'BERG') );
				if ( $categories_list && berg_wp_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( 'Posted in %1$s', 'BERG'), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>
			<?php $tags_list = get_the_tag_list( '', __( ', ', 'BERG') ); ?>
			<?php if ($tags_list) : ?>
			<span class="tags-links">
				<?php printf( __( 'Tagged %1$s', 'BERG'), $tags_list ); ?>
			</span>
			<?php endif; ?>
		<?php endif; ?>
	</footer>
</article>