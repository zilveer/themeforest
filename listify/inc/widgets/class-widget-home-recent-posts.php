<?php
/**
 * Standard: Recent Blog Posts
 *
 * @since Listify 1.4.0
 */
class Listify_Widget_Recent_Posts extends Listify_Widget {

    public function __construct() {
        $this->widget_description = __( 'Display a grid of recent blog posts.', 'listify' );
        $this->widget_id          = 'listify_widget_recent_posts';
        $this->widget_name        = __( 'Listify - Page: Recent Posts', 'listify' );
        $this->settings           = array(
            'title' => array(
                'type'  => 'text',
                'std'   => '',
                'label' => __( 'Title:', 'listify' )
            ),
			'description' => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Description:', 'listify' )
			),
			'number' => array(
				'type' => 'number',
				'std'  => 3,
				'label' => __( 'Number to display:', 'listify' ),
				'min' => 1,
				'max' => 1000,
				'step' => 1
			),
			'excerpt' => array(
				'type' => 'checkbox',
				'std' => 1,
				'label' => __( 'Display excerpt', 'listify' )
			),
            'style' => array(
                'type'    => 'select',
                'std'     => 'cover',
				'label'   => __( 'Style:', 'listify' ),
				'options' => array(
					'cover' => __( 'Image Cover', 'listify' ),
					'standard' => __( 'Standard', 'listify' )
				)
            )
        );
        parent::__construct();
    }

    function widget( $args, $instance ) {
		global $style, $excerpt;

        extract( $args );

		$title = apply_filters( 'widget_title', isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '', $instance, $this->id_base );
		$description = isset( $instance[ 'description' ] ) ? esc_attr( $instance[ 'description' ] ) : false;
        $style = isset( $instance[ 'style' ] ) ? $instance[ 'style' ] : 'cover';
        $number = isset( $instance[ 'number' ] ) ? absint( $instance[ 'number' ] ) : 3;
        $excerpt = isset( $instance[ 'excerpt' ] ) && 1 == $instance[ 'excerpt' ] ? true : false;

        $after_title = '<h2 class="home-widget-description">' . $description . '</h2>' . $after_title;

		$posts = new WP_Query( apply_filters( $this->widget_id . '_query', array(
			'posts_per_page' => $number
		) ) );

		if ( ! $posts->have_posts() ) {
			return;
		}

		add_filter( 'excerpt_length', 'listify_short_excerpt_length' );

        ob_start();

        echo str_replace( 'class="widget', 'class="widget ' . $style, $before_widget );

        if ( $title ) {
            echo $before_title . $title . $after_title;
        }

		echo '<div class="blog-archive blog-archive--grid" data-columns>';

		while ( $posts->have_posts() ) : $posts->the_post();

			get_template_part( 'content', 'recent-posts' );

		endwhile;

		echo '</div>';

		echo '<p class="from-the-blog"><a href="' . get_permalink( get_option( 'page_for_posts' ) ) . '" class="button">' . __( 'View Blog', 'listify' ) . '</a></p>';

        echo $after_widget;

        $content = ob_get_clean();

		remove_filter( 'excerpt_length', 'listify_short_excerpt_length' );

        echo apply_filters( $this->widget_id, $content );

        $this->cache_widget( $args, $content );
    }

}
