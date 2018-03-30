<?php if (!defined('ABSPATH')) {
    exit; // exit if accessed directly
}

/**
 * Ajax Video Player
 *
 * @access    private
 * @since     1.0.0
 * @version   1.0.0
 */
if ( ! function_exists( '_ut_get_video_player' ) ) {

	function _ut_get_video_player() {
        
        /* get video to check */
		$video = $_POST['video'];
                        
        /* needed variables */
        $embed_code = '';
        
        /* check if youtube has been used */
        preg_match('~(?:http|https|)(?::\/\/|)(?:www.|)(?:youtu\.be\/|youtube\.com(?:\/embed\/|\/v\/|\/watch\?v=|\/ytscreeningroom\?v=|\/feeds\/api\/videos\/|\/user\S*[^\w\-\s]|\S*[^\w\-\s]))([\w\-]{11})[a-z0-9;:@#?&%=+\/\$_.-]*~i', trim($video) , $matches);        
            
        if( !empty($matches[1]) ) {
            $embed_code = '<iframe height="315" width="560" src="http://www.youtube.com/embed/'.trim($matches[1]).'?wmode=transparent&vq=hd720&autoplay=1" wmode="Opaque" allowfullscreen="" frameborder="0"></iframe>';          
        }
        
        /* no video found so far , try to create a player  */
        if( empty($embed_code) ) {
            
            $video_embed = wp_oembed_get(trim($video));
            if( !empty($video_embed) ) {
                $embed_code = $video_embed;            
            }
            
        }
        
        /* still no video found, let's try to apply a shortcode */
        if( empty($embed_code) ) {
            $embed_code = do_shortcode(stripslashes($video));
        
        }
         
        echo $embed_code;
        
        exit();
        
    }   
    
}