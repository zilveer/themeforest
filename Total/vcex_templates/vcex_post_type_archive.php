<?php
/**
 * Visual Composer Post Type Archive
 *
 * @package Total WordPress Theme
 * @subpackage VC Templates
 * @version 3.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Not needed in admin ever
if ( is_admin() ) {
    return;
}

// Required VC functions
if ( ! function_exists( 'vc_map_get_attributes' ) ) {
	vcex_function_needed_notice();
	return;
}

// Get and extract shortcode attributes
$atts = vc_map_get_attributes( 'vcex_post_type_archive', $atts );
extract( $atts );

// Build the WordPress query
$my_query = vcex_build_wp_query( $atts );

// Set post to blog
$post_type = ( 'post' == $post_type ) ? 'blog' : $post_type;

// Output posts
if ( $my_query->have_posts() ) :

	// Wrapper classes
	$wrapper_classes = array( 'vcex-post-type-archive', 'clr' );
	if ( $css_animation ) {
   		$wrapper_classes[] = vcex_get_css_animation( $css_animation );
	}
	if ( $classes ) {
	    $wrapper_classes[] = vcex_get_extra_class( $classes );
	}
	if ( $visibility ) {
	    $wrapper_classes[] = $visibility;
	} ?>
	
	<div class="<?php echo implode( ' ', $wrapper_classes ); ?>"<?php vcex_unique_id( $unique_id ); ?>>

		<?php
		get_template_part( 'partials/loop/loop-top', $post_type );

			// Define counter var to clear floats
			$wpex_count='';

			// Loop through posts
			while ( $my_query->have_posts() ) :

				// Get post from query
				$my_query->the_post();

				// Create new post object.
				$post = new stdClass();

					get_template_part( 'partials/loop/loop', $post_type );

			endwhile;

		get_template_part( 'partials/loop/loop-bottom', $post_type );
		
		// Display pagination if enabled
		if ( 'true' == $pagination ) :
			wpex_pagination( $my_query );
		endif; ?>

	</div>
	
	<?php
	// Reset the post data to prevent conflicts with WP globals
	wp_reset_postdata(); ?>

<?php
// If no posts are found display message
else : ?>

	<?php
	// Display no posts found error if function exists
	echo vcex_no_posts_found_message( $atts ); ?>

<?php
// End post check
endif; ?>