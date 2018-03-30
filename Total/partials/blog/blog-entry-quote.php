<?php
/**
 * Blog entry layout
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Add post classes
$classes = wpex_blog_entry_classes(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
	<div class="post-quote-entry-inner clr">
		<span class="fa fa-quote-right"></span>
		<?php
		// Content for single posts
		if ( is_singular( 'post' ) ) : ?>
			<div class="quote-entry-content clr">
				<?php the_content(); ?>
			</div><!-- .quote-entry-content -->
		<?php else :
			// Content for entries ?>
			<div class="quote-entry-content clr">
				<?php the_content(); ?>
			</div><!-- .quote-entry-content -->
		<?php endif; ?>
		<div class="quote-entry-author clr">
			<?php the_title(); ?>
		</div><!-- .quote-entry-author -->
		</div><!-- .post-quote-entry-inner -->
</article><!-- .blog-entry -->