<?php
/**
 * @package WordPress
 * @subpackage YIT
 * @author Your Inspiration Themes
 * @copyright 2012
 */

/**
 * Media shortcodes
 * 
 * @version 1.0
 * @since 1.0
 */
class YIT_Media {
    
    public function __construct() {
        add_shortcode( 'video', array( &$this, 'video' ) );
    }
    
    /**
     * Call the correct method or call a user custom function if the type is unknown
     * 
     * @since   1.0
     */
    public function video( $atts, $content = null ) {
        extract(shortcode_atts(array(
            "type" => null,
            "id" => null,
            "width" => 640,
            "height" => 385
        ), $atts));
        
        if( function_exists( 'yit_sc_video_' . $type ) ) {
            $html = apply_filters( 'yit_sc_video_' . $type . '_html', call_user_func( 'yit_sc_video_' . $type , $id, $width, $height ) );
            $html = apply_filters( 'yit_sc_video_html', $html );
            
            return $html;
        }
        
        if( !method_exists( $this, $type ) || is_null( $id ) ) {
            return;
        }
            
        
        $html = apply_filters( 'yit_sc_video_' . $type . '_html', call_user_func( array( &$this, $type ), $id, $width, $height ) );
        $html = apply_filters( 'yit_sc_video_html', $html );
        
        return $html;
    }
    
    /**
     * Return YouTube video
     * 
     * @param   string  $id
     * @param   int     $width
     * @param   int     $height
     * @return  string  iframe HTML tag
     * @since   1.0
     */
    protected function youtube( $id, $width, $height ) {
        return '<iframe src="//youtube.com/embed/' . $id . '?wmode=transparent" width="' . $width . '" height="' . $height . '" frameborder="0" allowfullscreen></iframe>';
    }
    
    /**
     * Return Vimeo video
     * 
     * @param   string  $id
     * @param   int     $width
     * @param   int     $height
     * @return  string  iframe HTML tag
     * @since   1.0
     */
    protected function vimeo( $id, $width, $height ) {
        return '<iframe src="//player.vimeo.com/video/' . $id . '?wmode=transparent&amp;title=0&amp;byline=0&amp;portrait=0" width="' . $width . '" height="' . $height . '" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
    }
    
    /**
     * Return DailyMotion video
     * 
     * @param   string  $id
     * @param   int     $width
     * @param   int     $height
     * @return  string  iframe HTML tag
     * @since   1.0
     */
    protected function dailymotion( $id, $width, $height ) {
        return '<iframe src="http://www.dailymotion.com/embed/video/' . $id . '" width="' . $width . '" height="' . $height . '" frameborder="0" ></iframe>';
    }
    
    /**
     * Return Yahoo! Screen video
     * 
     * @param   string  $id
     * @param   int     $width
     * @param   int     $height
     * @return  string  iframe HTML tag
     * @since   1.0
     */
    protected function yahoo( $id, $width, $height ) {
        return '<iframe src="http://d.yimg.com/nl/vyc/site/player.html#vid=' . $id . '" width="' . $width . '" height="' . $height . '" frameborder="0" ></iframe>';
    }
    
    /**
     * Return Blip.TV video
     * 
     * @param   string  $id
     * @param   int     $width
     * @param   int     $height
     * @return  string  iframe HTML tag
     * @since   1.0
     */
    protected function bliptv( $id, $width, $height ) {
        return '<iframe src="http://a.blip.tv/scripts/shoggplayer.html#file=http://blip.tv/rss/flash/' . $id . '" width="' . $width . '" height="' . $height . '" frameborder="0" ></iframe>';
    }
    
    /**
     * Return Veoh video
     * 
     * @param   string  $id
     * @param   int     $width
     * @param   int     $height
     * @return  string  iframe HTML tag
     * @since   1.0
     */
    protected function veoh( $id, $width, $height ) {
        return '<iframe src="http://www.veoh.com/static/swf/veoh/SPL.swf?videoAutoPlay=0&permalinkId=' . $id . '" width="' . $width . '" height="' . $height . '" frameborder="0" ></iframe>';
    }
    
    /**
     * Return Viddler video
     * 
     * @param   string  $id
     * @param   int     $width
     * @param   int     $height
     * @return  string  iframe HTML tag
     * @since   1.0
     */
    protected function viddler( $id, $width, $height ) {
        return '<iframe src="http://www.viddler.com/simple/' . $id . '" width="' . $width . '" height="' . $height . '" frameborder="0" ></iframe>';
    }
}

if( !isset( $yit_media ) ) {
    $yit_media = new YIT_Media();
}


/******************
RETROCOMPATIBILITY
******************/
if ( ! function_exists( 'yiw_sc_youtube_func' ) ) :
/** 
 * YOUTUBE     
 * 
 * @description
 *    Embed the player youtube video.    
 * 
 * @example
 *   [youtube width="640" height="385" id="wSBIcNmCAX0"]
 * 
 * @attr  
 *   width - the width of player
 *   height - the height of player   
 *   id - the id of video 
**/
function yiw_sc_youtube_func( $atts, $content = null ) {
    global $yit_media;
    
    $atts = array(
        'type' => 'youtube',
        'id' => $atts['video_id'],
        'width' => $atts['width'],
        'height' => $atts['height']
    );
    
    return $yit_media->video( $atts, $content );
}
endif;
add_shortcode("youtube", "yiw_sc_youtube_func");

if ( ! function_exists( 'yiw_sc_vimeo_func' ) ) :
/** 
 * VIMEO     
 * 
 * @description
 *    Embed the player vimeo video.    
 * 
 * @example
 *   [vimeo width="640" height="385" id="wSBIcNmCAX0"]
 * 
 * @attr  
 *   width - the width of player
 *   height - the height of player   
 *   id - the id of video 
**/
function yiw_sc_vimeo_func( $atts, $content = null ) {
    global $yit_media;
    
    $atts = array(
        'type' => 'vimeo',
        'id' => $atts['video_id'],
        'width' => $atts['width'],
        'height' => $atts['height']
    );
    
    return $yit_media->video( $atts, $content );
}
endif;
add_shortcode("vimeo", "yiw_sc_vimeo_func");

if ( ! function_exists( 'yiw_sc_dailymotion_func' ) ) :
/** 
 * DAILYMOTION     
 * 
 * @description
 *    Embed the player dailymotion video.    
 * 
 * @example
 *   [dailymotion width="640" height="385" id="wSBIcNmCAX0"]
 * 
 * @attr  
 *   width - the width of player
 *   height - the height of player   
 *   id - the id of video 
**/
function yiw_sc_dailymotion_func( $atts, $content = null ) {
    global $yit_media;
    
    $atts = array(
        'type' => 'dailymotion',
        'id' => $atts['video_id'],
        'width' => $atts['width'],
        'height' => $atts['height']
    );
    
    return $yit_media->video( $atts, $content );
}
endif;
add_shortcode("dailymotion", "yiw_sc_dailymotion_func");

if ( ! function_exists( 'yiw_sc_yahoo_func' ) ) :
/** 
 * YAHOO SCREEN     
 * 
 * @description
 *    Embed the player yahoo screen video.    
 * 
 * @example
 *   [yahoo width="640" height="385" id="wSBIcNmCAX0"]
 * 
 * @attr  
 *   width - the width of player
 *   height - the height of player   
 *   id - the id of video 
**/
function yiw_sc_yahoo_func( $atts, $content = null ) {
    global $yit_media;
    
    $atts = array(
        'type' => 'yahoo',
        'id' => $atts['video_id'],
        'width' => $atts['width'],
        'height' => $atts['height']
    );
    
    return $yit_media->video( $atts, $content );
}
endif;
add_shortcode("yahoo", "yiw_sc_yahoo_func");

if ( ! function_exists( 'yiw_sc_bliptv_func' ) ) :
/** 
 * BLIPTV     
 * 
 * @description
 *    Embed the player dailymotion video.    
 * 
 * @example
 *   [dailymotion width="640" height="385" id="wSBIcNmCAX0"]
 * 
 * @attr  
 *   width - the width of player
 *   height - the height of player   
 *   id - the id of video 
**/
function yiw_sc_bliptv_func( $atts, $content = null ) {
    global $yit_media;
    
    $atts = array(
        'type' => 'bliptv',
        'id' => $atts['video_id'],
        'width' => $atts['width'],
        'height' => $atts['height']
    );
    
    return $yit_media->video( $atts, $content );
}
endif;
add_shortcode("bliptv", "yiw_sc_bliptv_func");

if ( ! function_exists( 'yiw_sc_veoh_func' ) ) :
/** 
 * VEOH     
 * 
 * @description
 *    Embed the player veoh video.    
 * 
 * @example
 *   [veoh width="640" height="385" id="wSBIcNmCAX0"]
 * 
 * @attr  
 *   width - the width of player
 *   height - the height of player   
 *   id - the id of video 
**/
function yiw_sc_veoh_func( $atts, $content = null ) {
    global $yit_media;
    
    $atts = array(
        'type' => 'veoh',
        'id' => $atts['video_id'],
        'width' => $atts['width'],
        'height' => $atts['height']
    );
    
    return $yit_media->video( $atts, $content );
}
endif;
add_shortcode("veoh", "yiw_sc_veoh_func");

if ( ! function_exists( 'yiw_sc_viddler_func' ) ) :
/** 
 * VIDDLER     
 * 
 * @description
 *    Embed the player viddler video.    
 * 
 * @example
 *   [viddler width="640" height="385" id="wSBIcNmCAX0"]
 * 
 * @attr  
 *   width - the width of player
 *   height - the height of player   
 *   id - the id of video 
**/
function yiw_sc_viddler_func( $atts, $content = null ) {
    global $yit_media;
    
    $atts = array(
        'type' => 'viddler',
        'id' => $atts['video_id'],
        'width' => $atts['width'],
        'height' => $atts['height']
    );
    
    return $yit_media->video( $atts, $content );
}
endif;
add_shortcode("viddler", "yiw_sc_viddler_func");
