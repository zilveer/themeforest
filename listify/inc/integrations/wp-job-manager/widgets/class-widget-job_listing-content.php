<?php
/**
 * Job Listing: Content
 *
 * @since Listify 1.0.0
 */
class Listify_Widget_Listing_Content extends Listify_Widget {

    public function __construct() {
        $this->widget_description = __( 'Display the listing description.', 'listify' );
        $this->widget_id          = 'listify_widget_panel_listing_content';
        $this->widget_name        = __( 'Listify - Listing: Description', 'listify' );
        $this->settings           = array(
            'title' => array(
                'type'  => 'text',
                'std'   => '',
                'label' => __( 'Title:', 'listify' )
            ),
            'icon' => array(
                'type'    => 'text',
                'std'     => '',
                'label'   => '<a href="http://ionicons.com/">' . __( 'Icon Class:', 'listify' ) . '</a>'
            )
        );
        parent::__construct();
    }

    function widget( $args, $instance ) {
        global $job_manager, $wp_embed;

        extract( $args );

        if ( '' == get_the_content() ) {
            return;
        }

        $title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
        $icon = isset( $instance[ 'icon' ] ) ? $instance[ 'icon' ] : null;

        if ( $icon ) {
            if ( strpos( $icon, 'ion-' ) !== false ) {
                $before_title = sprintf( $before_title, $icon );
            } else {
                $before_title = sprintf( $before_title, 'ion-' . $icon );
            }
        }

        ob_start();

        echo $before_widget;

        if ( $title ) {
            echo $before_title . $title . $after_title;
        }

        do_action( 'listify_widget_job_listing_content_before' );
        do_action( 'job_content_start' );

        remove_filter( 'the_content', array( $job_manager->post_types, 'job_content' ) );

		// make sure some things run
        add_filter( 'the_job_description', 'do_shortcode' );
		add_filter( 'the_job_description', array( $wp_embed, 'autoembed' ), 9 );

        echo apply_filters( 'the_job_description', get_the_content() );

        do_action( 'listify_widget_job_listing_content_after' );
        do_action( 'job_content_end' );

        echo $after_widget;

        $content = ob_get_clean();

        echo apply_filters( $this->widget_id, $content );
    }
}
