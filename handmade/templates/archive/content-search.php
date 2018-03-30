<?php
/**
 * The default template for displaying content
 *
 * Used for search.
 *
 * @package WordPress
 */
global $post;
$class = array();
$class[]= "clearfix";
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
	<div class="entry-content-wrap">
		<h3 class="entry-title p-font">
			<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
		</h3>
		<div class="entry-post-meta-wrap">
			<?php g5plus_post_meta(); ?>
		</div>
		<?php if ($post->post_type == 'post'): ?>
		<div class="entry-excerpt">
			<?php the_excerpt(); ?>
		</div>
		<?php else: ?>
			<a class="handmade-button style2 button-1x" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php esc_html_e('View more','g5plus-handmade') ?></a>
		<?php endif; ?>
	</div>
</article>


