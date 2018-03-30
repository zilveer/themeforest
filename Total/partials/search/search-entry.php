<?php
/**
 * Search entry layout
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Add classes to the post_class
$classes   = array();
$classes[] = 'search-entry';
$classes[] = 'clr';
if ( ! has_post_thumbnail() ) {
	$classes[] = 'search-entry-no-thumb';
} ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
	<?php get_template_part( 'partials/search/search-entry-thumbnail' ); ?>
	<div class="search-entry-text">
		<?php get_template_part( 'partials/search/search-entry-header' ); ?>
		<?php get_template_part( 'partials/search/search-entry-excerpt' ); ?>
	</div><!-- .search-entry-text -->
</article><!-- .entry -->