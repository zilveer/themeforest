<?php
/**
 * Job Listing: Tags
 *
 * @since Listify 1.0.0
 */
class Listify_Widget_Listing_Tags extends Listify_Widget {

    public function __construct() {
        $this->widget_description = __( 'Display the listing tags.', 'listify' );
        $this->widget_id          = 'listify_widget_panel_listing_tags';
        $this->widget_name        = __( 'Listify - Listing: Tags', 'listify' );
        $this->settings           = array(
            'title' => array(
                'type'  => 'text',
                'std'   => '',
                'label' => __( 'Title:', 'listify' )
            ),
            'icon' => array(
                'type'    => 'text',
                'std'     => 'ion-ios-pricetag',
                'label'   => '<a href="http://ionicons.com/">' . __( 'Icon Class:', 'listify' ) . '</a>'
            )
        );

        parent::__construct();
    }

    function widget( $args, $instance ) {
        if ( $this->get_cached_widget( $args ) )
            return;

        if ( ! class_exists( 'WP_Job_Manager_Job_Tags' ) ) {
            return;
        }

        global $job_manager, $post;

        extract( $args );

        $title = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance[ 'title' ] : '', $instance, $this->id_base );
        $icon = isset( $instance[ 'icon' ] ) ? $instance[ 'icon' ] : null;

        if ( $icon ) {
            if ( strpos( $icon, 'ion-' ) !== false ) {
                $before_title = sprintf( $before_title, $icon );
            } else {
                $before_title = sprintf( $before_title, 'ion-' . $icon );
            }
        }

        $tags = get_the_terms( get_the_ID(), 'job_listing_tag' );

        if ( is_wp_error( $tags ) || empty( $tags ) ) {
            return;
        }

        ob_start();

        echo $before_widget;

        if ( $title ) {
            echo $before_title . $title . $after_title;
        }

        do_action( 'listify_widget_job_listing_tags_before' );

        echo '<div class="job_listing_tag-list">';

        foreach ( $tags as $term ) {
			$icon = get_theme_mod( 'listings-job_listing_tag-' . $term->slug . '-icon' );

			if ( ! $icon ) {
				$icon = get_theme_mod( 'listings-job_listing_tag-' . str_replace( '-', '_', $term->slug ) . '-icon' );
			}

			if ( ! $icon ) {
				$icon = get_theme_mod( 'listings-job_listing_tag-' . $term->term_id . '-icon', 'pricetag' );
			}

			if ( $icon ) {
				$icon = 'ion-' . $icon;
			}

            echo '<a href="' . esc_url( get_term_link( $term->slug, 'job_listing_tag' ) ) . '" class="' . esc_attr( $icon ) . '">' . esc_attr( $term->name ) . '</a>';
        }

        echo '</div>';

        do_action( 'listify_widget_job_listing_tags_after' );

        echo $after_widget;

        $content = ob_get_clean();

        echo apply_filters( $this->widget_id, $content );

        $this->cache_widget( $args, $content );
    }
}
