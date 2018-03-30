<?php
/**
 * The template for displaying post content
 *
 * @package    Reactor
 * @subpackage Post-Formats
 * @since      1.0.0
 */

$posts_animation = get_query_var('posts_animation');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-post '.$posts_animation ); ?>>

	<div class="thumbnail-entry">
			<?php echo crumina_post_quote();?>
	</div>

</article><!-- #post -->
