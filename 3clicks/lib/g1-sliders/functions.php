<?php
/**
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Theme03
 * @subpackage G1_Sliders_Module
 * @since G1_Sliders_Module 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php


class G1_Sliders_Base_Module extends G1_Module {
    private $prefix;

    public function __construct() {
        parent::__construct();

        $this->set_version('1.0.0');
        $this->set_prefix( 'g1_slider' );
    }



    public function set_prefix( $val ) { $this->prefix = $val; }
    public function get_prefix() { return $this->prefix; }


    /**
     * Set up all hooks
     */
    protected function setup_hooks() {
        parent::setup_hooks();

        add_action( 'g1_single_elements_register',      array( $this, 'register_slider_single_element' ) );
        add_action( 'g1_precontent',                    array( $this, 'precontent_render_helpmode') );
    }


    /**
     * Adds "basic" section to the global shortcode generator
     *
     * @param G1_Shortcode_Generator $generator
     */
    function shortcode_generator_register( $generator ) {
        $generator->add_section( 'sliders', array(
            'label' => __( 'Sliders', 'g1_theme' ),
            'priority' => 150,
        ));
    }



    public function register_slider_single_element( $manager ) {
        $manager->add_element( 'slider', array(
            'label' => __( 'Slider', 'g1_theme' ),
            'choices' => array(
                '' => ' ',
            ),
            'help' =>
                '<p>' . __( 'Here you can choose a slider that will be displayed in the precontent theme area (right after the header and just before the content).', 'g1_theme' ) . '<p>' .
                '<p>' . __( 'The drop-down list will be empty, until you add some new slider.', 'g1_theme' ) . '</p>',
            'priority' => 205,
        ));
    }

    /**
     * Renders help information about the slider in the Precontent Theme Area.
     */
    public function precontent_render_helpmode() {
        $slider = G1_Elements()->get( 'slider' );

        // Render helpmode only when there's no slider
        if ( !(is_string($slider) && strlen($slider) > 0) ) {

            $out = '';

            $helpmode = G1_Helpmode(
                'slider_here',
                __( 'Do you want a slider here?', 'g1_theme' ),
                '<ol>' .
                    '<li>' . __( 'Create a slider ( check the WordPress Admin Menu - there should be some slider types to choose).', 'g1_theme' ) . '</li>' .
                    '<li>' . __( 'When editing a single entry scroll down to the "Single Page Elements" meta box, and choose your previously created slider from the "Slider" dropdown.' ) . '</li>' .
                    '<li>' . __( 'When editing a single category or a tag choose your previously created slider from the "Slider" dropdown.' ) . '</li>' .
                    '<li>' . __( 'Save', 'g1_theme' ) . '</li>' .
                    '</ol>',
                'info'
            );

            $out .= $helpmode->capture();

            if ( strlen( $out ) ) {
                $out = '<div style="position: relative; z-index: 10;">' . $out . '</div>';
            }

            echo $out;
        }
    }
}


if ( !class_exists( 'G1_Sliders_Module' ) ) :
    /**
     * Final class for our module
     *
     * This class is intentionally left empty!
     * To extend (modify) the base class, define the G1_Sliders_Module class in your child theme.
     */
    final class G1_Sliders_Module extends G1_Sliders_Base_Module {
    }
endif;