<?php
/**
 * Portfolio single related posts template part
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.3.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get post id
$post_id = get_the_ID();

// Return if disabled via post meta
if ( 'on' == get_post_meta( $post_id, 'wpex_disable_related_items', true ) ) {
	return;
}

// Posts count
$posts_count = wpex_get_mod( 'portfolio_related_count', '4' );

// Return if count is empty or 0
if ( ! $posts_count || '0' == $posts_count ) {
	return;
}

// Related query arguments
$args = array(
	'post_type'      => 'portfolio',
	'posts_per_page' => $posts_count,
	'orderby'        => 'rand',
	'post__not_in'   => array( $post_id ),
	'no_found_rows'  => true,
);

// Add categories to query
$cats     = wp_get_post_terms( $post_id, 'portfolio_category' ); 
$cats_ids = array();
foreach( $cats as $wpex_related_cat ) {
	$cats_ids[] = $wpex_related_cat->term_id; 
}

// Set tax query if there are categories to relate to the current post
if ( ! empty( $cats_ids ) ) {
	$args['tax_query'] = array (
		array (
			'taxonomy' => 'portfolio_category',
			'field'    => 'id',
			'terms'    => $cats_ids,
			'operator' => 'IN',
		),
	);
}

// Add filter so you can alter the query via child theme without having to modify this file
$args = apply_filters( 'wpex_related_portfolio_args', $args );

// Create new Query
$wpex_related_query = new wp_query( $args ); // IMPORTANT: Must be defined as $wpex_related_query

// If posts were found display related items
if ( $wpex_related_query->have_posts() ) :

	// Define wrap classes
	$wrap_classes = array( 'related-portfolio-posts', 'wpex-clr' );

	// Add container to the wrap classes for full-screen layouts to center it
	if ( 'full-screen' == wpex_global_obj( 'post_layout' ) ) {
		$wrap_classes[] = 'container';
	}

	// Turn classes into a string
	$wrap_classes = implode( ' ', $wrap_classes ); ?>

	<section id="portfolio-single-related" class="<?php echo esc_attr( $wrap_classes ); ?>">

		<?php
		// Output heading
		wpex_heading( array(
			'content'		=> wpex_portfolio_related_heading(),
			'tag'			=> 'h2',
			'classes'		=> array( 'related-portfolio-posts-heading' ),
			'apply_filters'	=> 'portfolio_related',
		) ); ?>

		<div class="wpex-row wpex-clr">

			<?php
			// Define post counter
			$wpex_count = '0';

			// Define loop type
			$wpex_loop = 'related';

			// Loop through posts
			foreach( $wpex_related_query->posts as $post ) : setup_postdata( $post );

				// Add to counter
				$wpex_count++;

				// Include template (use include to pass variables)
				if ( $template = locate_template( 'partials/portfolio/portfolio-entry.php' ) ) {
					include( $template );
				}

				// Reset counter
				if ( $wpex_count == wpex_get_mod( 'portfolio_related_columns', '4' ) ) {
					$wpex_count = '0';
				}

			// End loop
			endforeach; ?>

		</div><!-- .row -->
		
	</section><!-- .related-portfolio-posts -->
	
<?php
// End have_posts check
endif; ?>

<?php
// Reset the global $post data to prevent conflicts
wp_reset_postdata(); ?>