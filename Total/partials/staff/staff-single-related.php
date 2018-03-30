<?php
/**
 * Staff single related template part
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
$posts_count = wpex_get_mod( 'staff_related_count', '3' );

// Return if count is empty or 0
if ( ! $posts_count || '0' == $posts_count ) {
	return;
}

// Related query arguments
$args = array(
	'post_type'      => 'staff',
	'posts_per_page' => $posts_count,
	'orderby'        => 'rand',
	'post__not_in'   => array( $post_id ),
	'no_found_rows'  => true,
);

// Query by terms
$cats     = wp_get_post_terms( $post_id, 'staff_category' ); 
$cats_ids = array();  
foreach( $cats as $wpex_related_cat ) {
	$cats_ids[] = $wpex_related_cat->term_id; 
}
if ( ! empty( $cats_ids ) ) {
	$args['tax_query'] = array (
		array (
			'taxonomy' => 'staff_category',
			'field'    => 'id',
			'terms'    => $cats_ids,
			'operator' => 'IN',
		),
	);
}

// Apply filters to query args
$args = apply_filters( 'wpex_related_staff_args', $args );

// Run Query - must be set to $wpex_related_query var!!
$wpex_related_query = new wp_query( $args );

// If posts were found display related items
if ( $wpex_related_query->have_posts() ) :

	// Wrap classes
	$wrap_classes = 'related-staff-posts clr';
	if ( 'full-screen' == wpex_global_obj( 'post_layout' ) ) {
		$wrap_classes .= ' container';
	} ?>

	<section id="staff-single-related" class="<?php echo esc_attr( $wrap_classes ); ?>">

		<?php
		// Get and translate heading text
		$heading = wpex_get_translated_theme_mod( 'staff_related_title' );
		$heading = $heading ? $heading : esc_html__( 'Related Staff', 'total' );

		// If Heading text isn't empty
		if ( $heading ) : ?>
			<?php
			// Display heading
			wpex_heading( array(
				'content'		=> $heading,
				'tag'			=> 'h2',
				'classes'		=> array( 'related-staff-posts-heading' ),
				'apply_filters'	=> 'staff_related',
			) ); ?>
		<?php endif; ?>

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
				if ( $template = locate_template( 'partials/staff/staff-entry.php' ) ) {
					include( $template );
				}

				// Reset counter
				if ( $wpex_count == wpex_get_mod( 'staff_related_columns', '3' ) ) {
					$wpex_count = '0';
				}

			// End loop
			endforeach; ?>

		</div><!-- .wpex-row -->

	</section><!-- .related-staff-posts -->

<?php
// End have_posts check
endif; ?>

<?php
// Reset the global $post data to prevent conflicts
wp_reset_postdata(); ?>