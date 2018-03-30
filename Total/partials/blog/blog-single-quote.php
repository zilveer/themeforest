<?php
/**
 * Blog entry layout
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.3.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="post-quote-entry-inner clr">

		<span class="fa fa-quote-right"></span>
		
		<div class="quote-entry-content clr">
			<?php the_content(); ?>
		</div><!-- .quote-entry-content -->

		<div class="quote-entry-author clr">
			<?php the_title(); ?>
		</div><!-- .quote-entry-author -->

	</div><!-- .post-quote-entry-inner -->

</article><!-- .blog-entry -->

<?php
// Display comments if enabled
$layout_blocks = wpex_blog_single_layout_blocks();
if ( in_array( 'comments', $layout_blocks ) ) {
	comments_template();
} ?>