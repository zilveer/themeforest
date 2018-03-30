<?php
/**
 * Author: Bookmarks
 *
 * @since Listify 1.7.0
 * @package Listify
 * @subpackage Widget
 */
class Listify_Widget_Author_Bookmarks extends Listify_Widget {

    public function __construct() {
        $this->widget_description = __( 'Author bookmarks/favorites.', 'listify' );
        $this->widget_id          = 'listify_widget_author_bookmarks';
        $this->widget_name        = __( 'Listify - Author: Bookmarks', 'listify' );
        $this->settings           = array(
            'title' => array(
                'type'  => 'text',
                'std'   => '[username]&#39;s Favorites ([count])',
                'label' => __( 'Title:', 'listify' )
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
        $title = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance[ 'title' ] : '[username]&#39;s Favorites ([count])', $instance, $this->id_base );

		global $job_manager_bookmarks;

		$bookmarks = $job_manager_bookmarks->get_user_bookmarks( get_queried_object_id() );

		if ( empty( $bookmarks ) ) {
			return;
		}

		$bookmarks = wp_list_pluck( $bookmarks, 'post_id' );

		$listings = new WP_Query( array(
			'post_type' => 'job_listing',
			'post__in' => $bookmarks,
			'post_status' => 'publish',
			'posts_per_page' => -1
		) );

		if ( ! $listings->have_posts() ) {
			return;
		}

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
		
		while ( $listings->have_posts() ) {
			$listings->the_post();

			get_template_part( 'content', 'job_listing' );
		}

		echo '</ul>';

		wp_reset_query();

		echo $args[ 'after_widget' ];

        $content = ob_get_clean();

        echo apply_filters( $this->widget_id, $content );
    }

}
