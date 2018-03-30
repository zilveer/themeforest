<?php
/**
 * Job Listing: Social Profiles
 *
 * @since Listify 1.0.0
 */
class Listify_Widget_Listing_Social_Profiles extends Listify_Widget {

    public function __construct() {
        $this->widget_description = __( 'Display the social profiles of the listing author', 'listify' );
        $this->widget_id          = 'listify_widget_panel_listing_social_profiles';
        $this->widget_name        = __( 'Listify - Listing: Social Profiles', 'listify' );
        $this->settings           = array(
            'title' => array(
                'type'  => 'text',
                'std'   => '',
                'label' => __( 'Title:', 'listify' )
            ),
            'icon' => array(
                'type'    => 'text',
                'std'     => 'ion-person',
                'label'   => '<a href="http://ionicons.com/">' . __( 'Icon Class:', 'listify' ) . '</a>'
            )
        );
        parent::__construct();
    }

    function widget( $args, $instance ) {
        extract( $args );

        $title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
        $icon = isset( $instance[ 'icon' ] ) ? $instance[ 'icon' ] : null;

        if ( $icon ) {
            if ( strpos( $icon, 'ion-' ) !== false ) {
                $before_title = sprintf( $before_title, $icon );
            } else {
                $before_title = sprintf( $before_title, 'ion-' . $icon );
            }
        }

        $methods = wp_get_user_contact_methods();
        $output = array();
		$look = 'post';

		// determine where to look for the social profiles
		if ( 'user' == get_theme_mod( 'social-association', true ) ) {
			$look = 'user';
			$post = get_post();
			$author = 0;

			if ( is_a( $post, 'WP_Post' ) ) {
				$author = $post->post_author;
			} else if (is_author() ) {
				$author = get_queried_object_id();
			}
		} else {
			$post = get_post();
			$post_id = 0;

			if ( $post ) {
				$post_id = $post->ID;
			}
		}

        foreach ( $methods as $method => $label ) {
			$value = '';

            if ( 'user' == $look ) {
				$value = get_the_author_meta( $method, (int) $author );
            } else {
                $value = get_post_meta( $post_id, '_company_' . $method, true );
            }

            if ( '' == $value ) {
                continue;
            }

            if ( $value && ! strstr( $value, 'http:' ) && ! strstr( $value, 'https:' ) ) {
                $value = 'http://' . $value;
            }

            $output[] = sprintf( '<a href="%s" target="_blank" class="ion-social-%s">%s</a>', $value, $method, $label );
        }

        if ( empty( $methods ) || empty( $output ) ) {
            return;
        }

        ob_start();

        echo $before_widget;

        if ( $title ) {
            echo $before_title . $title . $after_title;
        }

        do_action( 'listify_widget_job_listing_social_before' );

        echo '<ul class="social-profiles"><li>' . implode( '</li><li>', $output ) . '</li></ul>';

        do_action( 'listify_widget_job_listing_social_after' );

        echo $after_widget;

        $content = ob_get_clean();

        echo apply_filters( $this->widget_id, $content );
    }
}
