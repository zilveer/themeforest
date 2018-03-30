<?php
/**
 * Author: Listings
 *
 * @since Listify 1.7.0
 * @package Listify
 * @subpackage Widget
 */
class Listify_Widget_Author_Listings extends Listify_Widget {

    public function __construct() {
        $this->widget_description = __( 'Author recent listings.', 'listify' );
        $this->widget_id          = 'listify_widget_author_listings';
        $this->widget_name        = __( 'Listify - Author: Recent Listings', 'listify' );
        $this->settings           = array(
            'title' => array(
                'type'  => 'text',
                'std'   => '[username]&#39;s Recent Listings ([count])',
                'label' => __( 'Title:', 'listify' )
            ),
            'per_page' => array(
                'type'  => 'number',
                'std'   => 3,
                'min'   => 3,
                'max'   => 30,
                'step'  => 3,
                'label' => __( 'Number to per page:', 'listify' )
            )
        );
        parent::__construct();
    }

	/**
	 * Echoes the widget content.
	 *
	 * @since 1.7.0
	 * @access public
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance The settings for the particular instance of the widget.
	 */
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance[ 'title' ] : '[username]&#39;s Recent Listings ([count])', $instance, $this->id_base );
        $per_page = isset( $instance[ 'per_page' ] ) ? absint( $instance[ 'per_page' ] ) : 3;

		// get the listings
		add_filter( 'get_job_listings_query_args', array( $this, 'listings_by_author' ) );

		$listings = get_job_listings( array(
            'posts_per_page' => $per_page
		) );
		
		if ( ! $listings->have_posts() ) {
			return;
		}

		remove_filter( 'get_job_listings_query_args', array( $this, 'listings_by_author' ) );

        ob_start();

		echo $args[ 'before_widget' ];

        if ( $title ) {
			$title = str_replace( 
				array( '[username]', '[count]' ), 
				array( get_the_author_meta( 'display_name', get_queried_object_id() ), $listings->found_posts ),
				$title
			);

			echo $args[ 'before_title' ] . $title . $args[ 'after_title' ];
        }

		// output listings
		echo '<ul class="job_listings">';
		
		while ( have_posts() ) {
		   the_post();

			get_template_part( 'content', 'job_listing' );
		}

		echo '</ul>';

		get_template_part( 'content', 'pagination' );

		wp_reset_query();

		echo $args[ 'after_widget' ];

        $content = ob_get_clean();

        echo apply_filters( $this->widget_id, $content );
    }

	/**
	 * Only show listings for the current author when this widget is output.
	 *
	 * @since 1.7.0
	 * @param $query_args
	 * @return $query_args
	 */
	public static function listings_by_author( $query_args ) {
		$query_args[ 'post_author' ] = get_queried_object_id();

		return $query_args;
	}
}
