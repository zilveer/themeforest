<?php

/* remove default gallery shortcode */
remove_shortcode('gallery');

if( !function_exists('ut_gallery_shortcode') ) :

    function ut_gallery_shortcode( $attr ) {
        
        $post = get_post();
    
        static $instance = 0;
        $instance++;
    
        if ( ! empty( $attr['ids'] ) ) {
            // 'ids' is explicitly ordered, unless you specify otherwise.
            if ( empty( $attr['orderby'] ) )
                $attr['orderby'] = 'post__in';
            $attr['include'] = $attr['ids'];
        }
    
        /**
         * Filter the default gallery shortcode output.
         *
         * If the filtered output isn't empty, it will be used instead of generating
         * the default gallery template.
         *
         * @since 2.5.0
         *
         * @see gallery_shortcode()
         *
         * @param string $output The gallery output. Default empty.
         * @param array  $attr   Attributes of the gallery shortcode.
         */
        $output = apply_filters( 'post_gallery', '', $attr );
        if ( $output != '' )
            return $output;
    
        // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
        if ( isset( $attr['orderby'] ) ) {
            $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
            if ( !$attr['orderby'] )
                unset( $attr['orderby'] );
        }
    
        $html5 = current_theme_supports( 'html5', 'gallery' );
        extract(shortcode_atts(array(
            'order'                 => 'ASC',
            'orderby'               => 'menu_order ID',
            'id'                    => $post ? $post->ID : 0,
            'itemtag'               => $html5 ? 'figure'     : 'dl',
            'icontag'               => $html5 ? 'div'        : 'dt',
            'captiontag'            => $html5 ? 'figcaption' : 'dd',
            'columns'               => 3,
            'size'                  => 'thumbnail',
            'include'               => '',
            'exclude'               => '',
            'link'                  => '',
            'ut_gallery_lightbox' 	=> 'off',
            'ut_image_border'       => 'off',
            'ut_image_border_radius'=> '0px'            
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
    
        /**
         * Filter whether to print default gallery styles.
         *
         * @since 3.1.0
         *
         * @param bool $print Whether to print default gallery styles.
         *                    Defaults to false if the theme supports HTML5 galleries.
         *                    Otherwise, defaults to true.
         */
        if ( apply_filters( 'use_default_gallery_style', ! $html5 ) ) {
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
                #{$selector} img {
                    border: 2px solid #cfcfcf;
                }
                #{$selector} .gallery-caption {
                    margin-left: 0;
                }
                
                ".( $ut_image_border == 'on' ? "#{$selector} .gallery-item img { -webkit-border-radius:".$ut_image_border_radius."; -moz-border-radius:".$ut_image_border_radius."; border-radius:".$ut_image_border_radius."; }" : '' )."
                
                /* see gallery_shortcode() in wp-includes/media.php */
            </style>\n\t\t";
        }
    
        $size_class = sanitize_html_class( $size );
        $gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
    
        /**
         * Filter the default gallery shortcode CSS styles.
         *
         * @since 2.5.0
         *
         * @param string $gallery_style Default gallery shortcode CSS styles.
         * @param string $gallery_div   Opening HTML div container for the gallery shortcode output.
         */
        $output = apply_filters( 'gallery_style', $gallery_style . $gallery_div );
    
        $i = 0;
        foreach ( $attachments as $id => $attachment ) {
            if ( ! empty( $link ) && 'file' === $link )
                $image_output = wp_get_attachment_link( $id, $size, false, false );
            elseif ( ! empty( $link ) && 'none' === $link )
                $image_output = wp_get_attachment_image( $id, $size, false );
            else
                $image_output = wp_get_attachment_link( $id, $size, true, false );
    
            $image_meta  = wp_get_attachment_metadata( $id );
    
            $orientation = '';
            if ( isset( $image_meta['height'], $image_meta['width'] ) )
                $orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';
    
            $output .= "<{$itemtag} class='gallery-item'>";
            $output .= "
                <{$icontag} class='gallery-icon {$orientation}'>
                    $image_output
                </{$icontag}>";
            if ( $captiontag && trim($attachment->post_excerpt) ) {
                $output .= "
                    <{$captiontag} class='wp-caption-text gallery-caption'>
                    " . wptexturize($attachment->post_excerpt) . "
                    </{$captiontag}>";
            }
            $output .= "</{$itemtag}>";
            if ( ! $html5 && $columns > 0 && ++$i % $columns == 0 ) {
                $output .= '<br style="clear: both" />';
            }
        }
    
        if ( ! $html5 && $columns > 0 && $i % $columns !== 0 ) {
            $output .= "
                <br style='clear: both' />";
        }
        
        if( $ut_gallery_lightbox == "on" && empty( $attr['link'] ) ) {
			$output .= '<p>'.__('Lightbox has been activated. If you like to use the Lightbox Feature, please make sure you set "Link to" inside the Gallery Settings to "Media File"' , 'unitedthemes').'</p>';
		}
        
        if( $ut_gallery_lightbox == "on" && (! empty( $attr['link'] ) && 'file' === $attr['link']) ) {
            
            $ut_lightbox_script = ot_get_option('ut_lightbox_script' , 'prettyphoto');
            
            if( $ut_lightbox_script == 'prettyphoto' ) {
            
                $output .= '<script type="text/javascript">/* <![CDATA[ */';
                    $output .= '(function($){ "use strict"; $(document).ready(function(){';
                            
                            $output .= "$('#$selector .gallery-item a').prettyPhoto({social_tools : false});";
                        
                    $output .= '}); })(jQuery);';
                $output .= '/* ]]> */</script>';
            
            } else {
                
                $output .= '<script type="text/javascript">/* <![CDATA[ */';
                     $output .= '(function($){ "use strict"; $(document).ready(function(){';
                            
                           $output .= "$('#$selector').lightGallery({
                                selector: '.gallery-item a',
                                hash: false
                           });";                        
                        
                     $output .= '}); })(jQuery);';
                $output .= '/* ]]> */</script>';
            
            }
            
        }
        
        $output .= "</div>\n";
    
        return $output;
    }
    
    add_shortcode('gallery', 'ut_gallery_shortcode');
    
endif;


if(!function_exists('ut_add_prettyphoto_rel')) :
    
    add_filter( 'wp_get_attachment_link', 'ut_add_prettyphoto_rel', 10, 6);
    
    function ut_add_prettyphoto_rel($content, $id, $size, $permalink, $icon, $text) {
        
        if ($permalink) {
            return $content;    
        }
        
        /* add rel */
        $content = preg_replace("/<a/","<a data-rel=\"prettyPhoto[gallery]\"",$content,1);
        
        return $content;
        
    }
    
endif;
?>