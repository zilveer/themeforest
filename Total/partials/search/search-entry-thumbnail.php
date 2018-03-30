<?php
/**
 * Search entry thumbnail
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.3.3
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Return if there isn't any thumbnail defined
if ( has_post_thumbnail() ) : ?>

	<div class="search-entry-thumb">
		<a href="<?php wpex_permalink(); ?>" title="<?php wpex_esc_title(); ?>" class="search-entry-img-link">
			<?php wpex_post_thumbnail( apply_filters( 'wpex_search_thumbnail_args', array(
				'size'   => 'search_results',
				'width'  => '',
				'height' => '',
				'alt'    => wpex_get_esc_title(),
			) ) ); ?>
		</a>
	</div><!-- .search-entry-thumb -->

<?php endif; ?>