<?php
/**
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Theme03
 * @subpackage G1_Works_Module
 * @since G1_Works_Module 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php

/**
 * Adds "works" section to the global shortcode generator
 *
 * @param G1_Shortcode_Generator $generator
 */
function g1_shortgen_section_works( $generator ) {
    $generator->add_section( 'post_type_g1_work', array(
        'label' => __( 'Works', 'g1_theme' ),
        'priority' => 300,
    ));
}
add_action( 'g1_shortcode_generator_register', 'g1_shortgen_section_works' );




function G1_Custom_Works_Shortcode() {
    static $instance;

    if ( !isset( $instance ) ) {
        $instance = new G1_Custom_Collection_Shortcode( 'custom_works', array(
            'post_type' => 'g1_work',
            'id_aliases' => array(
                'customworks',
            )
        ));
    }

    return $instance;
}
// Fire in the hole :)
G1_Custom_Works_Shortcode();


class G1_Custom_Works_Widget extends G1_Collection_Shortcode_Widget {
    public function get_id_base() { return 'custom_works_widget'; }
    public function get_name() { return __( 'G1 Custom Works', 'g1_theme' ); }

    public function setup_shortcode() {
        $this->shortcode = G1_Custom_Works_Shortcode();
    }
}




function G1_Popular_Works_Shortcode() {
    static $instance;

    if ( !isset( $instance ) ) {
        $instance = new G1_Popular_Collection_Shortcode( 'popular_works', array(
            'post_type' => 'g1_work',
            'id_aliases' => array(
                'popularworks'
            ),
        ));
    }

    return $instance;
}
// Fire in the hole :)
G1_Popular_Works_Shortcode();

class G1_Popular_Works_Widget extends G1_Collection_Shortcode_Widget {
    public function get_id_base() { return 'popular_works_widget'; }
    public function get_name() { return __( 'G1 Popular Works', 'g1_theme' ); }

    public function setup_shortcode() {
        $this->shortcode = G1_Popular_Works_Shortcode();
    }
}





function G1_Recent_Works_Shortcode() {
    static $instance;

    if ( !isset( $instance ) ) {
        $instance = new G1_Recent_Collection_Shortcode( 'recent_works', array(
            'post_type' => 'g1_work',
            'id_aliases' => array(
                'recentworks',
                'latest_works',
                'latestworks',
                'last_works',
                'lastworks',
            ),
            'category_filter_taxonomy_name' => 'g1_work_category',
            'tag_filter_taxonomy_name' => 'g1_work_tag',
        ));
    }

    return $instance;
}
// Fire in the hole :)
G1_Recent_Works_Shortcode();

class G1_Recent_Works_Widget extends G1_Collection_Shortcode_Widget {
    public function get_id_base() { return 'recent_works_widget'; }
    public function get_name() { return __( 'G1 Recent Works', 'g1_theme' ); }

    public function setup_shortcode() {
        $this->shortcode = G1_Recent_Works_Shortcode();
    }
}


class G1_Related_Works_Widget extends G1_Collection_Shortcode_Widget {
    public function get_id_base() { return 'related_works_widget'; }
    public function get_name() { return __( 'G1 Related Works', 'g1_theme' ); }

    public function setup_shortcode() {
        $this->shortcode = G1_Related_Collection_Shortcode( 'g1_work' );
    }
}



/**
 * Register works widgets
 */
function g1_register_works_widget() {
    register_widget( 'G1_Custom_Works_Widget' );
    register_widget( 'G1_Popular_Works_Widget' );
    register_widget( 'G1_Recent_Works_Widget' );
    register_widget( 'G1_Related_Works_Widget' );
}
add_action( 'widgets_init', 'g1_register_works_widget' );