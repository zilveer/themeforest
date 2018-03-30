<?php
/**
 * @author Stylish Themes
 *
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Clubix_Blog_Shortcode {

    protected static $instance = null;

    public static function get_instance() {

        // If the single instance hasn't been set, set it now.
        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    private function __construct() {
        add_shortcode( 'clx_blog', array( &$this, 'shortcode' ) );
    }

    public function shortcode( $atts ) {
        $category = $author = $posts_per_page = $type = $orderby = $order = $has_widgets = '';

        extract( shortcode_atts( array(
            'type'              => '1',
            'posts_per_page'    => 5,
            'category'          => '',
            'author'            => '',
            'orderby'           => 'date',
            'order'             => 'DESC'
        ), $atts ) );

        // Explode all categories and authors ids into arrays
        if ($category == '') { $categories = array(); } else { $categories = explode(",", $category); }
        if ($author == '') { $authors = array(); } else { $authors = explode(",", $author); }

        // Construct the query
        if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
        elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
        else { $paged = 1; }
        $args = array(
            'post_type'         => 'post',
            'post_status'       => 'publish',
            'paged'             => $paged,
            'posts_per_page'    => (int)$posts_per_page,
            'orderby'           => $orderby,
            'order'             => $order,
            'category__in'      => $categories,
            'author__in'        => $authors
        );

        $query = new WP_Query($args);


        if ( $query->have_posts() ) :

            while ( $query->have_posts() ) : $query->the_post();


                /* Get the content template */
                switch($type) {
                    case '1':
                        get_template_part( 'content', get_post_format() );
                        break;
                    case '2':
                        get_template_part( 'lib/templates/blog/two/content', get_post_format() );
                        break;
                }



            endwhile;

        else :


            /* Get the none-content template (error) */
            get_template_part( 'content', 'none' );


        endif;

        wp_reset_postdata();
        // End The Loop

        return;

    }

}

Clubix_Blog_Shortcode::get_instance();