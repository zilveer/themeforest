<?php
/**
 * Custom functions that deal with the integration of WP Job Manager Job Tags.
 * See: https://wpjobmanager.com/add-ons/job-tags/
 *
 * @package Listable
 */


/* ------- UTILITY FUNCTIONS --------- */


/**
 * Prints HTML with meta information for the tags.
 */
function listable_tags_list( $content ) {

	$tags_content = '';

	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list();
		if ( $tags_list ) {
			$tags_content .= sprintf( '<span class="tags-links">' . esc_html__( '%1$s', 'listable' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	return $content . $tags_content;
}

//add this filter with a priority smaller than sharedaddy - it has 19
add_filter( 'the_content', 'listable_tags_list', 18 );


/* -------- WIDGETS -------- */

function listable_register_widget_areas_wpjm_tags() {
	register_widget( 'Listing_Tags_Widget' );

	// if we have this widget, remove the plugin's output
	global $job_manager_tags;
	if ( $job_manager_tags !== null ) {
		remove_filter( 'the_job_description', array( $job_manager_tags, 'display_tags' ), 10 );
	}
}

add_action( 'widgets_init', 'listable_register_widget_areas_wpjm_tags' );

class Listing_Tags_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
				'listing_tags', // Base ID
				'&#x1F536; ' . esc_html__( 'Listing', 'listable' ) . ' &raquo; ' . esc_html__( 'Tags', 'listable' ), // Name
				array( 'description' => esc_html__( 'A list of tags or amenities.', 'listable' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		global $post;
		echo $args['before_widget'];

		$tags = wp_get_object_terms( $post->ID, 'job_listing_tag' );

		if ( $tags ) : ?>

			<ul class="listing-tag-list">

				<?php foreach ( $tags as $tag ) : ?>

					<li>
						<?php $tag_link = esc_url( get_term_link( $tag ) ); ?>
						<a href="<?php echo $tag_link; ?>" class="listing-tag">
							<?php
							$tag_image = listable_get_term_icon_url( $tag->term_id );
							if ( $tag_image ) :
								?>
								<span class="tag__icon"><img src="<?php echo $tag_image ?>" alt=""/></span>
							<?php endif; ?>
							<span class="tag__text"><?php echo $tag->name; ?></span>
						</a><!-- .listing-tag -->
					</li>

				<?php endforeach; ?>

			</ul><!-- .listing-tag-list -->

		<?php endif;

		echo $args['after_widget'];
	}

	public function form( $instance ) {
		echo '<p>' . $this->widget_options['description'] . '</p>';
	}
} // class Listing_Tags_Widget