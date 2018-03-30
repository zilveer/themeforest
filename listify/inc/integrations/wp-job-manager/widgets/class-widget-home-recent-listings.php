<?php
/**
 * Home: Recent Listings
 *
 * @since Listify 1.0.0
 */
class Listify_Widget_Recent_Listings extends Listify_Widget {

    public function __construct() {
        $this->widget_description = __( 'Display a grid of recent or featured listings', 'listify' );
        $this->widget_id          = 'listify_widget_recent_listings';
        $this->widget_name        = __( 'Listify - Page: Recent Listings', 'listify' );
        $this->settings           = array(
            'title' => array(
                'type'  => 'text',
                'std'   => 'Recent Listings',
                'label' => __( 'Title:', 'listify' )
            ),
            'description' => array(
                'type'  => 'text',
                'std'   => 'Discover some of our best listings',
                'label' => __( 'Description:', 'listify' )
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
            ),
        );
        parent::__construct();
    }

    function widget( $args, $instance ) {
        if ( $this->get_cached_widget( $args ) )
            return;

        extract( $args );

        $title = apply_filters( 'widget_title', $instance[ 'title' ], $instance, $this->id_base );
        $description = isset( $instance[ 'description' ] ) ? esc_attr( $instance[ 'description' ] ) : false;
        $featured = isset( $instance[ 'featured' ] ) && 1 == $instance[ 'featured' ] ? true : null;
        $limit = isset( $instance[ 'limit' ] ) ? absint( $instance[ 'limit' ] ) : 3;

        $after_title = '<h2 class="home-widget-description">' . $description . '</h2>' . $after_title;

        $listings = get_job_listings( array(
            'posts_per_page' => $limit,
            'featured' => $featured,
            'no_found_rows' => true,
			'update_post_term_cache' => false
        ) );

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
}
