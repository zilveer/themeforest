<?php

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }


class Haze_Shortcodes {

    protected $prefix = 'clx_shortcodes_';

    public $accordion_instance = array(
        'id'    => 0,
        'type'  => '',
        'tab_id'=> 0,
    );

    protected static $instance = null;

    private function __construct() {

        add_filter( 'post_gallery', array($this, 'zen_gallery_shortcode'), 15, 2 );

        require_once(THEMEDIR.'/lib/functions/shortcodes/social_icons.php');

        require_once(THEMEDIR.'/lib/functions/shortcodes/divider.php');

        require_once(THEMEDIR.'/lib/functions/shortcodes/blockquote.php');

        require_once(THEMEDIR.'/lib/functions/shortcodes/dropcap.php');

        require_once(THEMEDIR.'/lib/functions/shortcodes/lists.php');

        require_once(THEMEDIR.'/lib/functions/shortcodes/tables.php');

        require_once(THEMEDIR.'/lib/functions/shortcodes/download.php');

        require_once(THEMEDIR.'/lib/functions/shortcodes/blog.php');

        require_once(THEMEDIR.'/lib/functions/shortcodes/player.php');

        require_once(THEMEDIR.'/lib/functions/shortcodes/latest_album.php');

        require_once(THEMEDIR.'/lib/functions/shortcodes/event.php');

        require_once(THEMEDIR.'/lib/functions/shortcodes/event_slider.php');


        // Setup the visual composer new shortcodes.
        require_once(THEMEDIR.'/lib/functions/vc_setup.php');

        // Button for lists shortcode
        require_once(THEMEDIR.'/lib/functions/EditorButtons/ListButton.php');


    }

    /**
     * Return an instance of this class.
     *
     * @since     1.0.0
     *
     * @return    object    A single instance of this class.
     */
    public static function get_instance() {

        // If the single instance hasn't been set, set it now.
        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function zen_gallery_shortcode( $content = '', $attr = array() ) {
        static $instance = 0; $style = $order = $orderby = $id = $itemtag = $icontag = $captiontag = $columns = $size = $include = $exclude = $link = '';

        // return if this is standard mode or gallery already modified
        if ( !empty($content) ) {
            return $content;
        }

        $instance++;

        $post = get_post();

        if ( ! empty( $attr['ids'] ) ) {
            // 'ids' is explicitly ordered, unless you specify otherwise.
            if ( empty( $attr['orderby'] ) )
                $attr['orderby'] = 'post__in';
            $attr['include'] = $attr['ids'];
        }

        // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
        if ( isset( $attr['orderby'] ) ) {
            $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
            if ( !$attr['orderby'] )
                unset( $attr['orderby'] );
        }

        extract(shortcode_atts(array(
            'order'      => 'ASC',
            'orderby'    => 'menu_order ID',
            'id'         => $post ? $post->ID : 0,
            'itemtag'    => 'dl',
            'icontag'    => 'dt',
            'captiontag' => 'dd',
            'columns'    => 3,
            'size'       => 'thumbnail',
            'include'    => '',
            'exclude'    => '',
            'link'       => '',
            'style'      => ''
        ), $attr, 'gallery'));

        $id = intval($id);
        if ( 'RAND' == $order )
            $orderby = 'none';

        if ( !empty($include) ) {
            $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

            $attachments = array();
            foreach ( $_attachments as $key => $val ) {
                $attachments[$val->ID] = $_attachments[$key];
            }
        } elseif ( !empty($exclude) ) {
            $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
        } else {
            $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
        }

        if ( empty($attachments) )
            return '';

        if ( is_feed() ) {
            $output = "\n";
            foreach ( $attachments as $att_id => $attachment )
                $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
            return $output;
        }

        $itemtag = tag_escape($itemtag);
        $captiontag = tag_escape($captiontag);
        $icontag = tag_escape($icontag);
        $valid_tags = wp_kses_allowed_html( 'post' );
        if ( ! isset( $valid_tags[ $itemtag ] ) )
            $itemtag = 'dl';
        if ( ! isset( $valid_tags[ $captiontag ] ) )
            $captiontag = 'dd';
        if ( ! isset( $valid_tags[ $icontag ] ) )
            $icontag = 'dt';

        $columns = intval($columns);
        $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
        $float = is_rtl() ? 'right' : 'left';

        $selector = "gallery-{$instance}";

        $gallery_style = $gallery_div = '';

        switch ( $style ) {

            default :

                if ( apply_filters( 'use_default_gallery_style', true ) )
                    $gallery_style = "
                    <style type='text/css'>
                        #{$selector} {
                            margin: auto;
                        }
                        #{$selector} .gallery-item {
                            float: {$float};
                            margin-top: 10px;
                            text-align: center;
                            width: {$itemwidth}%;
                        }
                        #{$selector} .gallery-caption {
                            margin-left: 0;
                        }

                        #{$selector} dt {
                            margin: 0px 10px !important;
                        }
                        /* see gallery_shortcode() in wp-includes/media.php */
                    </style>";
                $size_class = sanitize_html_class( $size );
                $gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
                $output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

                $i = 0;
                foreach ( $attachments as $id => $attachment ) {

                    $img_html = wp_get_attachment_image( $id, 'thumbnail', false );

                    $img_link = wp_get_attachment_url( $id );
                    $img_video_url = get_post_meta( $id, 'zen_video_url', true );

                    if ( $img_video_url != '' ) {
                        $image_output = '<a href="'.$img_video_url.'" rel="prettyPhoto[pp_gal]" alt="">'.$img_html.'</a>';
                    } else {
                        $image_output = '<a href="'.$img_link.'" rel="prettyPhoto[pp_gal]" alt="">'.$img_html.'</a>';
                    }

                    $image_meta  = wp_get_attachment_metadata( $id );

                    $orientation = '';
                    if ( isset( $image_meta['height'], $image_meta['width'] ) )
                        $orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';

                    $output .= "<{$itemtag} class='gallery-item'>";
                    $output .= "
                        <{$icontag} class='gallery-icon {$orientation}'>
                            $image_output
                        </{$icontag}>";
                    $output .= "</{$itemtag}>";
                    if ( $columns > 0 && ++$i % $columns == 0 )
                        $output .= '<br style="clear: both" />';
                }

                $output .= "
                        <br style='clear: both;' />
                    </div>\n";
        }

        return $output;
    }

}
Haze_Shortcodes::get_instance();