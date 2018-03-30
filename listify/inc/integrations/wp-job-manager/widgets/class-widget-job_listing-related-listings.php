<?php
/**
 * Listing: Related Listings
 *
 * @since Listify 1.6.0
 */
class Listify_Widget_Listing_Related_Listings extends Listify_Widget {

    public function __construct() {
        $this->widget_description = __( 'Display listings related to the listing currently being viewed.', 'listify' );
        $this->widget_id          = 'listify_related_listings';
        $this->widget_name        = __( 'Listify - Listing: Related Listings', 'listify' );
        $this->settings           = array(
            'title' => array(
                'type'  => 'text',
                'std'   => 'Related Listings',
                'label' => __( 'Title:', 'listify' )
            ),
            'location' => array(
                'type'  => 'checkbox',
                'std'   => 0,
                'label' => __( 'Limit based on location', 'listify' )
            ),
            'category' => array(
                'type'  => 'checkbox',
                'std'   => 1,
                'label' => __( 'Limit based on category', 'listify' )
            ),
            'featured' => array(
                'type'  => 'checkbox',
                'std'   => 0,
                'label' => __( 'Show only featured listings', 'listify' )
            ),
            'limit' => array(
                'type'  => 'number',
                'std'   => 3,
                'min'   => 3,
                'max'   => 30,
                'step'  => 3,
                'label' => __( 'Number to show:', 'listify' )
            )
        );
        parent::__construct();
    }

    function widget( $args, $instance ) {
        if ( $this->get_cached_widget( $args ) ) {
            return;
		}

        extract( $args );

        $title = apply_filters( 'widget_title', $instance[ 'title' ], $instance, $this->id_base );
        $featured = isset( $instance[ 'featured' ] ) && 1 == $instance[ 'featured' ] ? true : null;
        $limit = isset( $instance[ 'limit' ] ) ? absint( $instance[ 'limit' ] ) : 3;

        $location = isset( $instance[ 'location' ] ) && 1 == $instance[ 'location' ] ? true : null;
        $category = isset( $instance[ 'category' ] ) && 1 == $instance[ 'category' ] ? true : null;

		add_filter( 'get_job_listings_query_args', array( $this, 'exclude_current_listing' ) );

		$args = array(
            'posts_per_page' => $limit,
            'featured' => $featured,
            'no_found_rows' => true,
			'update_post_term_cache' => false,
		);

		if ( $location && get_post()->geolocation_state_long ) {
			$args[ 'search_location' ] = get_post()->geolocation_state_long;
		}

		if ( $category ) {
			$args[ 'search_categories' ] = wp_get_post_terms( get_post()->ID, 'job_listing_category', array( 'fields' => 'ids' ) );
		}

        $listings = get_job_listings( $args );

		remove_filter( 'get_job_listings_query_args', array( $this, 'exclude_current_listing' ) );

		if ( ! $listings->have_posts() ) {
			return;
		}

        ob_start();

        echo $before_widget;

        if ( $title ) echo $before_title . $title . $after_title;
        ?>

        <ul class="job_listings">
            <?php while ( $listings->have_posts() ) : $listings->the_post(); ?>

                <?php get_template_part( 'content', 'job_listing' ); ?>

            <?php endwhile; ?>
        </ul>

        <?php
        echo $after_widget;

        wp_reset_postdata();

        $content = ob_get_clean();

        echo apply_filters( $this->widget_id, $content );

        $this->cache_widget( $args, $content );
    }

	/**
	 * Exclude the current listing from the `get_job_listings()` call.
	 *
	 * @since 1.6.0
	 * @param array $query_args
	 * @return array $query_args
	 */
	public function exclude_current_listing( $query_args ) {
		$query_args[ 'post__not_in' ] = array( get_post()->ID );

		return $query_args;
	}
}
