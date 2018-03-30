<?php
/**
 * Plugin Name: r+ Orbit Shortcode
 * Plugin URI: http://themes.required.ch/
 * Description: A [orbit] shortcode plugin for the required+ Foundation parent theme and child themes.
 * Version: 0.1.2
 * Author: required+ Team
 * Author URI: http://required.ch
 *
 * @package   required+ Foundation
 * @version   0.1.2
 * @author    Silvan Hagen <silvan@required.ch>
 * @copyright Copyright (c) 2012, Silvan Hagen
 * @link      http://themes.required.ch/theme-features/shortcodes/
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
/**
 * REQ_Orbit Shortcode Class
 *
 * @version 0.1.0
 */
class REQ_Orbit {

    /**
     * Holds the stuff we want to output in the footer
     *
     * @since  0.1.0
     * @access public
     * @var    int
     */
    public $footer_content = array();

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

        add_action( 'wp_footer', array( &$this, 'add_footer_output' ), 640 );
    }

    /**
     * Registers the [orbit] shortcode.
     *
     * @since  0.1.0
     * @access public
     * @return void
     */
    public function register_shortcode() {
        add_shortcode( 'orbit', array( &$this, 'do_shortcode' ) );
    }

    /**
     * Returns the content of the orbit shortcode.
     *
     * @since  0.1.0
     * @access public
     * @param  array  $attr The user-inputted arguments.
     * @param  string $content The content to wrap in a shortcode.
     * @return string
     */
    public function do_shortcode( $attr, $content = null ) {

        global $post;

        // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
        if ( isset( $attr['orderby'] ) ) {
            $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
            if ( !$attr['orderby'] )
                unset( $attr['orderby'] );
        }

        /* Set up the default variables. */
        $output = '';
        $caption = '';

        /* Set up the default arguments. */
        $defaults = apply_filters(
            'req_orbit_defaults',
            array(
                'order'      => 'ASC',
                'orderby'    => 'menu_order ID',
                'id'         => $post->ID,
                'size'       => 'large',
                'include'    => '',
                'exclude'    => ''
            )
        );

        $attr = shortcode_atts( $defaults, $attr );

        /* Allow devs to filter the arguments. */
        $attr = apply_filters( 'req_orbit_args', $attr );

        /* Parse the arguments. */
        extract( $attr );

        $id = intval( $id );

        /* Global script options */
        $orbit_script_args = apply_filters(
            'req_orbit_script_args',
            array()
        );

        $orbit_script_args = apply_filters(
            "req_orbit_script_args_{$id}",
            $orbit_script_args
        );

        if ( 'RAND' == $order )
            $orderby = 'none';

        if ( !empty( $include ) ) {
            $include = preg_replace( '/[^0-9,]+/', '', $include );
            $_attachments = get_posts( array( 'include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );

            $attachments = array();
            foreach ( $_attachments as $key => $val ) {
                $attachments[$val->ID] = $_attachments[$key];
            }
        } elseif ( !empty( $exclude ) ) {
            $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
            $attachments = get_children( array( 'post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
        } else {
            $attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
        }

        if ( empty( $attachments ) )
            return '';

        if ( is_feed() ) {
            $output = "\n";
            foreach ( $attachments as $att_id => $attachment )
                $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
            return $output;
        }



        /* Let the magic happen */
        $output = '<div class="req-orbit" id="req-orbit-' . $id . '">';


        $orbit_script_options = '';

        if ( !empty( $orbit_script_args ) ) {
            $orbit_script_options = json_encode( $orbit_script_args );
        }
        $this->footer_content[] = "$('#req-orbit-{$id}').orbit({$orbit_script_options});";

        foreach ( $attachments as $id => $attachment ) {

            /* Image source for the thumbnail image */
            $img_src = wp_get_attachment_image_src( $id, $size );

            /* Check for a caption */
            $data_caption = '';

            if ( trim($attachment->post_excerpt) ) {
                $caption_id = 'req-caption-' . $id;
                $data_caption = ' data-caption="#' . $caption_id . '"';
                $caption .= '<span class="orbit-caption" id="' . $caption_id . '">' . wptexturize( $attachment->post_excerpt ) . '</span>';
            }

            /* Generate final item output */
            $output .= '<img src="' . esc_url( $img_src[0] ) . '"' . $data_caption . ' />';
        }

        $output .= '</div>' . $caption;

        /* Return the output of the orbit. */
        return apply_filters( 'req_orbit', $output );
    }

    /**
     * Retuns the $content of the modal as reveal html
     */
    public function add_footer_output() {

        if ( !empty( $this->footer_content ) ) {

            echo '<!-- Output generated by [orbit] shortcode in this page: --><script id="req-orbit-script" type="text/javascript">(function($) {';

            foreach ( $this->footer_content as $orbit_script ) {
                echo $orbit_script;
            }

            echo '}(jQuery));</script><!-- / [orbit] output -->';
        }

    }

}

//new REQ_Orbit();
