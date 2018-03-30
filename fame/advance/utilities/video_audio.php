<?php
/*
 * Detection of type of movie
 * returns array(type, video_id)
 */
if(!function_exists('a13_detect_movie')){
    function a13_detect_movie($src){
        //used to check if it is audio file
        $parts = pathinfo($src);
        $ext = isset($parts['extension'])? strtolower($parts['extension']) : false;

        //http://www.youtube.com/watch?v=e8Z0YTWDFXI
        if (preg_match("/(youtube\.com\/watch\?)?v=([a-zA-Z0-9\-_]+)&?/s", $src, $matches)){
            $type = 'youtube';
            $video_id = $matches[2];
        }
        //http://youtu.be/e8Z0YTWDFXI
        elseif (preg_match("/(https?:\/\/youtu\.be\/)([a-zA-Z0-9\-_]+)&?/s", $src, $matches)){
            $type = 'youtube';
            $video_id = $matches[2];
        }
        // regexp $src http://vimeo.com/16998178
        elseif (preg_match("/(vimeo\.com\/)([0-9]+)/s", $src, $matches)){
            $type = 'vimeo';
            $video_id = $matches[2];
        }
        elseif(strlen($ext) && in_array($ext, array('mp3', 'ogg', 'm4a'))){
            $type = 'audio';
            $video_id = $src;
        }
        else{
            $type = 'html5';
            $video_id = $src;
        }

        return array(
            'type' => $type,
            'video_id' => $video_id
        );
    }
}


/*
 * Returns movie thumb(for youtube, vimeo)
 */
if(!function_exists('a13_get_movie_thumb_src')){
    function a13_get_movie_thumb_src( $video_res, $thumb = '' ){
        if(!empty($thumb)){
            return $thumb;
        }

        $type = $video_res['type'];
        $v_id = $video_res['video_id'];

        if ( $type == 'youtube' ){
            return 'http://img.youtube.com/vi/'.$v_id.'/hqdefault.jpg';
        }
        elseif ( $type == 'vimeo' ){
            return A13_TPL_GFX . '/holders/vimeo.jpg';
        }
        elseif ( $type == 'html5' ){
            return A13_TPL_GFX . '/holders/video.jpg';
        }

        return false;
    }
}


/*
 * Returns movie link to insert it in iframe
 */
if(!function_exists('a13_get_movie_link')){
    function a13_get_movie_link( $video_res, $params = array()){
        $type = $video_res['type'];
        $v_id = $video_res['video_id'];

        if ( $type == 'youtube' ){
            return 'http://www.youtube.com/embed/'.$v_id.'?enablejsapi=1&amp;controls=1&amp;fs=1&amp;hd=1&amp;loop=0&amp;rel=0&amp;showinfo=1&amp;showsearch=0&amp;wmode=transparent';
        }
        elseif ( $type == 'vimeo' ){
            return 'http://player.vimeo.com/video/'.$v_id.'?api=1&amp;title=1&amp;loop=0';
        }
        else{
            return A13_TPL_ADV . '/inc/videojs/player.php?src=' . $v_id . '&amp;w=' . $params['width'] . '&amp;h=' . $params['height'] . '&amp;poster=' . $params['poster'];
        }
    }
}


/*
 * Returns movie iframe or link to movie
 */
if(!function_exists('a13_get_movie')){
    function a13_get_movie( $src, $width = 295, $height = 0 ){
        if( $height == 0){
            $height = ceil((9/16) * $width);
        }

        $video_res  = a13_detect_movie($src);
        $type       = $video_res['type'];

        $link       = a13_get_movie_link($video_res, array( 'width' => $width, 'height' => $height, 'poster' => "" ));

        return '<iframe data-vid-id="'.$video_res['video_id'].'" id="a13-crazy'.$type . mt_rand() . '" style="height: ' . $height . 'px; width: ' . $width . 'px; border: none;" src="' . esc_url($link) . '" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
    }
}


