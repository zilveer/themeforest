<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }
/**
 * REQ_Clearing Shortcode Class
 *
 * @version 0.1.0
 */
class REQ_Clearing {

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

        add_action( 'wp_head', array( &$this, 'admin_bar_fix' ), 5);
    }

    /**
     * Registers the [clearing] shortcode.
     *
     * @since  0.1.0
     * @access public
     * @return void
     */
    public function register_shortcode() {
        add_shortcode( 'clearing', array( &$this, 'do_shortcode' ) );
    }

    /**
     * Returns the content of the clearing shortcode.
     *
     * @since  0.1.0
     * @access public
     * @param  array  $attr The user-inputted arguments.
     * @param  string $content The content to wrap in a shortcode.
     * @return string
     */
    public function do_shortcode( $attr ) {

        global $post;

        // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
        if ( isset( $attr['orderby'] ) ) {
            $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
            if ( !$attr['orderby'] )
                unset( $attr['orderby'] );
        }

        /* Set up the default variables. */
        $output = '';
        $column_classes = '';
        $fearued_class = '';

        /* Set up the default arguments. */
        $defaults = apply_filters(
            'req_clearing_defaults',
            array(
                'order'      => 'ASC',
                'orderby'    => 'menu_order ID',
                'id'         => $post->ID,
                'columns'    => 3,
                'size'       => 'thumbnail',
                'include'    => '',
                'exclude'    => '',
                'featured'   => ''
            )
        );

        $attr = shortcode_atts( $defaults, $attr );

        /* Allow devs to filter the arguments. */
        $attr = apply_filters( 'req_clearing_args', $attr );

        /* Parse the arguments. */
        extract( $attr );

        $id = intval( $id );

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

        if ( empty($attachments) )
            return '';

        if ( is_feed() ) {
            $output = "\n";
            foreach ( $attachments as $att_id => $attachment )
                $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
            return $output;
        }

        /* Assign correct classes */
        $columns = intval($columns);
        switch ( $columns ) {
            case 1:
                $column_classes = '';
                break;
            case 2:
                $column_classes = 'block-grid two-up mobile-two-up';
                break;
            case 4:
                $column_classes = 'block-grid four-up mobile-two-up';
                break;
            case 5:
                $column_classes = 'block-grid five-up mobile-two-up';
                break;
            case 6:
                $column_classes = 'block-grid six-up mobile-two-up';
                break;
            case 3:
            default:
                $column_classes = 'block-grid three-up mobile-two-up';
                break;
        }

        /* Check for featured image and remove column_classes if there is a match */
        $featured = intval( $featured );
        if ( $featured != '' ) {
            $column_classes = '';
            $fearued_class = ' has-featured';
            $size = 'large';
        }

        /* Let the magic happen */
        $output = '<div class="req-clearing-container"><ul class="' . $column_classes . $fearued_class . '" data-clearing>';

        foreach ( $attachments as $id => $attachment ) {

            /* Image source for the thumbnail image */
            $img_src = wp_get_attachment_image_src( $id, $size );

            /* Image source for the full image to show on the plate */
            $img_src_full = wp_get_attachment_image_src( $id, 'full' );

            /* Check for a caption */
            $caption = '';
            if ( trim($attachment->post_excerpt) ) {
                $caption = ' data-caption="' . strip_tags( $attachment->post_excerpt ) . '"';
            }

            /* Check if we have a featured image for this clearing */
            $item_classes = '';
            if ( $featured == $id ) {
                $item_classes = ' class="clearing-feature"';
            }

            /* Generate final item output */
            $output .= '<li' . $item_classes . '><a href="' . esc_url( $img_src_full[0] ) . '"><img src="' . esc_url( $img_src[0] ) . '"' . $caption . ' /></a></li>';
        }

        $output .= '</ul></div>';

        /* Return the output of the column. */
        return apply_filters( 'req_clearing', $output );
    }
    /**
     * Helper to fix the admin bar positioning issue
     * @return string css
     */
    public function admin_bar_fix() {
        if( !is_admin() && is_admin_bar_showing() ) {
            remove_action( 'wp_head', '_admin_bar_bump_cb' );
            $output  = '<style type="text/css">'."\n\t";
            $output .= 'body.admin-bar .clearing-close { top: 28px; }'."\n";
            $output .= '</style>'."\n";
            echo $output;
        }
    }

}

new REQ_Clearing();
