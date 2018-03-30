<?php
/**
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Theme03
 * @subpackage G1_Pages_Module
 * @since G1_Pages_Module 1.0.0
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
function g1_shortgen_section_pages( $generator ) {
    $generator->add_section( 'post_type_page', array(
        'label' => __( 'Pages', 'g1_theme' ),
        'priority' => 200,
    ));
}
add_action( 'g1_shortcode_generator_register', 'g1_shortgen_section_pages' );





function G1_Custom_Pages_Shortcode() {
    static $instance = null;

    if ( null === $instance ) {
        $instance = new G1_Custom_Collection_Shortcode( 'custom_pages', array(
            'post_type' => 'page',
        ) );
    }

    return $instance;
}
// Fire in the hole :)
G1_Custom_Pages_Shortcode();


class G1_Custom_Pages_Widget extends G1_Collection_Shortcode_Widget {
    public function get_id_base() { return 'custom_pages_widget'; }
    public function get_name() { return __( 'G1 Custom Pages', 'g1_theme' ); }

    public function setup_shortcode() {
        $this->shortcode = G1_Custom_Pages_Shortcode();
    }
}


class G1_Related_Pages_Widget extends G1_Collection_Shortcode_Widget {
    public function get_id_base() { return 'related_pages_widget'; }
    public function get_name() { return __( 'G1 Related Pages', 'g1_theme' ); }

    public function setup_shortcode() {
        $this->shortcode = G1_Related_Collection_Shortcode( 'page' );
    }
}




/**
 * Register posts widgets
 */
function g1_register_pages_widget() {
    register_widget( 'G1_Custom_Pages_Widget' );
    register_widget( 'G1_Related_Pages_Widget' );
}
add_action( 'widgets_init', 'g1_register_pages_widget' );