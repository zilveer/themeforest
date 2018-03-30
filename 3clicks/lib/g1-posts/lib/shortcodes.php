<?php
/**
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Theme03
 * @subpackage G1_Posts_Module
 * @since G1_Posts_Module 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php


/**
 * Adds "posts" section to the global shortcode generator
 *
 * @param G1_Shortcode_Generator $generator
 */
function g1_shortgen_section_posts( $generator ) {
    $generator->add_section( 'post_type_post', array(
        'label' => __( 'Posts', 'g1_theme' ),
        'priority' => 210,
    ));
}
add_action( 'g1_shortcode_generator_register', 'g1_shortgen_section_posts' );





function G1_Custom_Posts_Shortcode() {
    static $instance = null;

    if ( null === $instance ) {
        $instance = new G1_Custom_Collection_Shortcode( 'custom_posts', array(
            'post_type' => 'post',
        ) );
    }

    return $instance;
}
// Fire in the hole :)
G1_Custom_Posts_Shortcode();


class G1_Custom_Posts_Widget extends G1_Collection_Shortcode_Widget {
    public function get_id_base() { return 'custom_posts_widget'; }
    public function get_name() { return __( 'G1 Custom Posts', 'g1_theme' ); }

    public function setup_shortcode() {
        $this->shortcode = G1_Custom_Posts_Shortcode();
    }
}





function G1_Popular_Posts_Shortcode() {
    static $instance = null;

    if ( null === $instance ) {
        $instance = new G1_Popular_Collection_Shortcode( 'popular_posts', array(
            'post_type' => 'post',
        ));
    }

    return $instance;
}
// Fire in the hole :)
G1_Popular_Posts_Shortcode();

class G1_Popular_Posts_Widget extends G1_Collection_Shortcode_Widget {
    public function get_id_base() { return 'popular_posts_widget'; }
    public function get_name() { return __( 'G1 Popular Posts', 'g1_theme' ); }

    public function setup_shortcode() {
        $this->shortcode = G1_Popular_Posts_Shortcode();
    }
}





function G1_Recent_Posts_Shortcode() {
    static $instance = null;

    if ( null === $instance ) {
        $instance = new G1_Recent_Collection_Shortcode( 'recent_posts', array(
            'post_type' => 'post',
        ));
    }

    return $instance;
}
// Fire in the hole :)
G1_Recent_Posts_Shortcode();

class G1_Recent_Posts_Widget extends G1_Collection_Shortcode_Widget {
    public function get_id_base() { return 'recent_posts_widget'; }
    public function get_name() { return __( 'G1 Recent Posts', 'g1_theme' ); }

    public function setup_shortcode() {
        $this->shortcode = G1_Recent_Posts_Shortcode();
    }
}




class G1_Related_Posts_Widget extends G1_Collection_Shortcode_Widget {
    public function get_id_base() { return 'related_posts_widget'; }
    public function get_name() { return __( 'G1 Related Posts', 'g1_theme' ); }

    public function setup_shortcode() {
        $this->shortcode = G1_Related_Collection_Shortcode( 'post' );
    }
}




/**
 * Register posts widgets
 */
function g1_register_posts_widget() {
    register_widget( 'G1_Custom_Posts_Widget' );
    register_widget( 'G1_Popular_Posts_Widget' );
    register_widget( 'G1_Recent_Posts_Widget' );
    register_widget( 'G1_Related_Posts_Widget' );
}
add_action( 'widgets_init', 'g1_register_posts_widget' );