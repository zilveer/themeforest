<?php

global $gt3_current_page_sidebar;

if (isset($pf) && $pf == "image") { echo '<div class="featured_image_full blog_post_image">';}
if (isset($pf) && $pf == "video") { echo '<div class="pf_video_container blog_post_image wrapped_video">';}
if (isset($pf) && $pf == "audio") { echo '<div class="pf_audio_container blog_post_image wrapped_audio">';}
if (!isset($compile)) {$compile='';}

/* IMAGE FORMAT */
if (isset($pf) && $pf == 'image')  {
    echo gt3_get_selected_pf_images($gt3_theme_pagebuilder);
}

/* VIDEO FORMAT */
if (isset($pf) && $pf == "video")  {

    $uniqid = mt_rand(0, 9999);
    global $YTApiLoaded, $allYTVideos;
    if (empty($YTApiLoaded)) {$YTApiLoaded = false;}
    if (empty($allYTVideos)) {$allYTVideos = array();}

    $video_url = $gt3_theme_pagebuilder['post-formats']['videourl'];
    if (isset($gt3_theme_pagebuilder['post-formats']['video_height'])) {
        $video_height = $gt3_theme_pagebuilder['post-formats']['video_height'];
    } else {
        $video_height = $GLOBALS["pbconfig"]['default_video_height'];
    }

    #YOUTUBE
    $is_youtube = substr_count($video_url, "youtu");
    if ($is_youtube > 0) {
        $videoid = substr(strstr($video_url, "="), 1);
        $compile .= "<div id='player{$uniqid}'></div><script>";

        if ($YTApiLoaded !== true) {
            $YTApiLoaded = true;
            $compile .= "
                    var tag = document.createElement('script');
                    tag.src = 'https://www.youtube.com/iframe_api';
                    var firstScriptTag = document.getElementsByTagName('script')[0];
                    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

                    function onPlayerReady(event) {}
                    function onPlayerStateChange(event) {}
                    function stopVideo() {
                        player.stopVideo();
                    }
                    ";

            function add_this_script_footer() {

                $result = "";

                global $allYTVideos;
                if (is_array($allYTVideos) && count($allYTVideos)>0) {
                    foreach ($allYTVideos as $key => $value) {
                        $result .= "
                                new YT.Player('player{$value['uniqid']}', {
                                    height: '{$value['h']}',
                                    width: '{$value['w']}',
                                    playerVars: { 'autoplay': 0, 'controls': 1 },
                                    videoId: '{$value['videoid']}',
                                    events: {
                                        'onReady': onPlayerReady,
                                        'onStateChange': onPlayerStateChange
                                    }
                                });
                                ";
                    }
                    echo "<script>function onYouTubeIframeAPIReady() {".$result."}</script>";
                }

            }
            add_action('wp_footer', 'add_this_script_footer');

        }

        array_push($allYTVideos, array("h" => $video_height, "w" => "100%", "videoid" => $videoid, "uniqid" => $uniqid));

        $compile .= "</script>";

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
if (isset($pf) && $pf == "audio")  {
	$compile .= $gt3_theme_pagebuilder['post-formats']['audiourl'];
    echo $compile;
}

if ((isset($pf) && $pf == "image") || (isset($pf) && $pf == "video") || (isset($pf) && $pf == "audio")) { echo '</div>';}
?>
