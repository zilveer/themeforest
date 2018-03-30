<?php

if ($pf == "image" || $pf == "audio") { echo '<div class="featured_image_full">';}
if ($pf == "video") { echo '<div class="pf_video_container">';}
if (!isset($compile)) {$compile='';}


/* IMAGE FORMAT */
if ($pf == "image")  {
    echo get_selected_pf_images($gt3_pagebuilder);
}

/* VIDEO FORMAT */
if ($pf == "video")  {
    $video_url = $gt3_pagebuilder['post-formats']['videourl'];
    if (isset($gt3_pagebuilder['post-formats']['video_height'])) {
        $video_height = $gt3_pagebuilder['post-formats']['video_height'];
    } else {
        $video_height = $gt3_pbconfig['default_video_height'];
    }


    #YOUTUBE
    $is_youtube = substr_count($video_url, "youtu");
    if ($is_youtube > 0) {
        $videoid = substr(strstr($video_url, "="), 1);
        $compile .= "
            <iframe width=\"100%\" height=\"".$video_height."\" src=\"http://www.youtube.com/embed/" . $videoid . "\" frameborder=\"0\" allowfullscreen></iframe>
        ";
    }

    #VIMEO
    $is_vimeo = substr_count($video_url, "vimeo");
    if ($is_vimeo > 0) {
        $videoid = substr(strstr($video_url, "m/"), 2);
        $compile .= "
            <iframe src=\"http://player.vimeo.com/video/" . $videoid . "\" width=\"100%\" height=\"".$video_height."\" frameborder=\"0\" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
        ";
    }

    echo $compile;

}

/* AUDIO FORMAT */
if ($pf == "audio")  {
    $mp3_url = $gt3_pagebuilder['post-formats']['mp3'];
    $ogg_url = $gt3_pagebuilder['post-formats']['ogg'];

    $compile .= '
        <div id="jquery_jplayer_2" class="jp-jplayer blog-audio" data-mp3="'.$mp3_url.'" data-ogg="'.$ogg_url.'"></div>
        <div id="jp_container_2" class="jp-audio">
            <div class="jp-type-single">
                <div class="jp-gui jp-interface">
                    <ul class="jp-controls">
                        <li><a href="#" class="jp-play" tabindex="1">play</a></li>
                        <li><a href="#" class="jp-pause" tabindex="1">pause</a></li>
                        <li><a href="#" class="jp-mute" tabindex="1" title="mute">mute</a></li>
                        <li><a href="#" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>
                    </ul>
                    <div class="jp-progress">
                        <div class="jp-seek-bar">
                            <div class="jp-play-bar"></div>
                        </div>
                    </div>
                    <div class="jp-volume-bar">
                        <div class="jp-volume-bar-value"></div>
                    </div>
                    <div class="jp-current-time"></div>
                    <div class="jp-seperator">|</div>
                    <div class="jp-duration"></div>
                    <ul class="jp-toggles">
                    </ul>
                </div>
            </div>
        </div><!-- -->
    ';

    echo $compile;

}


if ($pf == "image" || $pf == "video" || $pf == "audio") { echo '</div>';}
?>
