<?php
/**
 * Plugin Name: r+ Alert-Box Shortcode
 * Plugin URI: http://themes.required.ch/
 * Description: An [alert] shortcode plugin for the required+ Foundation parent theme and child themes, see <a href="http://foundation.zurb.com/docs/elements.php">Foundation Docs</a> for more info.
 * Version: 0.1.1
 * Author: required+ Team
 * Author URI: http://required.ch
 *
 * @package   required+ Foundation
 * @version   0.1.1
 * @author    Silvan Hagen <silvan@required.ch>
 * @copyright Copyright (c) 2012, Silvan Hagen
 * @link      http://themes.required.ch/theme-features/shortcodes/
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
/**
 * REQ_Alertbox Shortcode Class
 *
 * @version 0.1.0
 */
class REQ_Alertbox {

    /**
     * Sets up our actions/filters.
     *
     * @since 0.1.0
     * @access public
     * @return void
     */
    public function __construct() {

        /* Register shortcodes on 'init'. */
        add_action( 'init', array( &$this, 'register_shortcode' ) );

        /* Apply filters to the alert content. */
        add_filter( 'req_alertbox_content', 'shortcode_unautop' );
        add_filter( 'req_alertbox_content', 'do_shortcode' );
    }

    /**
     * Registers the [alert] shortcode.
     *
     * @since  0.1.0
     * @access public
     * @return void
     */
    public function register_shortcode() {
        add_shortcode( 'alert', array( &$this, 'do_shortcode' ) );
    }

    /**
     * Returns the content of the alert shortcode.
     *
     * @since  0.1.0
     * @access public
     * @param  array  $attr The user-inputted arguments.
     * @param  string $content The content to wrap in a shortcode.
     * @return string
     */
    public function do_shortcode( $attr, $content = null ) {

        /* If there's no content, just return back what we got. */
        if ( is_null( $content ) )
            return $content;

        /* Set up the default variables. */
        $output = '';

        /* Set up the default arguments. */
        $defaults = apply_filters(
            'req_alertbox_defaults',
            array(
                'timeout'  => '',
                'close'  => 'yes',
                'type' => '' // success, alert, secondary
            )
        );

        /* Parse the arguments. */
        $attr = shortcode_atts( $defaults, $attr );

        /* Allow devs to filter the arguments. */
        $attr = apply_filters( 'req_alertbox_args', $attr );

        /* Output */
        $timeout = '';
        $closebutton = '<a href="#" class="close">&times;</a>';
        $type = '';

        /* Check for a custom timeout */
        if ( !empty( $attr['timeout'] ) ) {
            $timeout = ' data-alert-timeout="' . esc_attr( $attr['timeout'] ) . '"';
        }

        /* Check if the close button is not desired */
        if ( 'no' == $attr['close'] ) {
            $closebutton = '';
        }

        /* Check if there is an attribute for the type */
        if ( !empty( $attr['type'] ) ) {
            $type = ' ' . esc_attr( $attr['type'] );
        }

        /* Create our output */
        $output = '<div class="alert-box' . $type . '"' . $timeout . '>' . apply_filters('req_alertbox_content', $content ) . $closebutton . '</div>';

        /* Return the output of the column. */
        return apply_filters( 'req_alertbox', $output );
    }
}

new REQ_Alertbox();