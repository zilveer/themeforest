<?php
/* CONTENT -------------------------------------------------------------------*/
add_shortcode('content', 'content');
function content($atts, $content = null) {
    return '<div class="bl1shr fixed"><div class="content-shr">' . do_shortcode($content) . '</div></div>';
}
/* COLUMNS -------------------------------------------------------------------*/
add_shortcode('one_half', 'one_half');
function one_half($atts, $content = null) {
    return '<div class="one_half">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_half_last', 'one_half_last');
function one_half_last($atts, $content = null) {
    return '<div class="one_half last">' . do_shortcode($content) . '</div>
        <div class="clearboth"></div>';
}
add_shortcode('one_third', 'one_third');
function one_third($atts, $content = null) {
    return '<div class="one_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_third_last', 'one_third_last');
function one_third_last($atts, $content = null) {
    return '<div class="one_third last">' . do_shortcode($content) . '</div>
        <div class="clearboth"></div>';
}
add_shortcode('two_third', 'two_third');
function two_third($atts, $content = null) {
    return '<div class="two_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_third_last', 'two_third_last');
function two_third_last($atts, $content = null) {
    return '<div class="two_third last">' . do_shortcode($content) . '</div>
        <div class="clearboth"></div>';
}
add_shortcode('one_fourth', 'one_fourth');
function one_fourth($atts, $content = null) {
    return '<div class="one_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fourth_last', 'one_fourth_last');
function one_fourth_last($atts, $content = null) {
    return '<div class="one_fourth last">' . do_shortcode($content) . '</div>
        <div class="clearboth"></div>';
}
add_shortcode('three_fourth', 'three_fourth');
function three_fourth($atts, $content = null) {
    return '<div class="three_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fourth_last', 'three_fourth_last');
function three_fourth_last($atts, $content = null) {
    return '<div class="three_fourth last">' . do_shortcode($content) . '</div>
        <div class="clearboth"></div>';
}
add_shortcode('one_fifth', 'one_fifth');
function one_fifth($atts, $content = null) {
    return '<div class="one_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fifth_last', 'one_fifth_last');
function one_fifth_last($atts, $content = null) {
    return '<div class="one_fifth last">' . do_shortcode($content) . '</div>
        <div class="clearboth"></div>';
}
add_shortcode('two_fifth', 'two_fifth');
function two_fifth($atts, $content = null) {
    return '<div class="two_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_fifth_last', 'two_fifth_last');
function two_fifth_last($atts, $content = null) {
    return '<div class="two_fifth last">' . do_shortcode($content) . '</div>
        <div class="clearboth"></div>';
}
add_shortcode('three_fifth', 'three_fifth');
function three_fifth($atts, $content = null) {
    return '<div class="three_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fifth_last', 'three_fifth_last');
function three_fifth_last($atts, $content = null) {
    return '<div class="three_fifth last">' . do_shortcode($content) . '</div>
        <div class="clearboth"></div>';
}
add_shortcode('four_fifth', 'four_fifth');
function four_fifth($atts, $content = null) {
    return '<div class="four_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('four_fifth_last', 'four_fifth_last');
function four_fifth_last($atts, $content = null) {
    return '<div class="four_fifth last">' . do_shortcode($content) . '</div>
        <div class="clearboth"></div>';
}
add_shortcode('one_sixth', 'one_sixth');
function one_sixth($atts, $content = null) {
    return '<div class="one_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_sixth_last', 'one_sixth_last');
function one_sixth_last($atts, $content = null) {
    return '<div class="one_sixth last">' . do_shortcode($content) . '</div>
        <div class="clearboth"></div>';
}
add_shortcode('five_sixth', 'five_sixth');
function five_sixth($atts, $content = null) {
    return '<div class="five_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('five_sixth_last', 'five_sixth_last');
function five_sixth_last($atts, $content = null) {
    return '<div class="five_sixth last">' . do_shortcode($content) . '</div>
        <div class="clearboth"></div>';
}
/* TITLE ------------------------------------------------------------------*/
add_shortcode('title', 'title');
function title($atts, $content = null) {
    $return = '
<div class="title-home"><h3>' . $content . '</h3></div>';
    return $return;
}
/* DROPCAPS ------------------------------------------------------------------*/
add_shortcode('dropcap', 'dropcap');
function dropcap($atts, $content = null, $code = "") {
    $return = '<span class="dropcap">' . $content . '</span>';
    return $return;
}
/* QUOTE -----------------------------------------------------------------*/
add_shortcode('quote_left', 'pullquote_left');
function pullquote_left($atts, $content = null, $code = "") {
    $return = '<span class="pullquote_left">' . $content . '</span>';
    return $return;
}
add_shortcode('quote_right', 'pullquote_right');
function pullquote_right($atts, $content = null, $code = "") {
    $return = '<span class="pullquote_right">' . $content . '</span>';
    return $return;
}
/* HIGHLIGHT -----------------------------------------------------------------*/
add_shortcode('highlight', 'wz_highlight');
function wz_highlight($atts, $content = null, $code = "") {
    $return = '<span class="highlight">' . $content . '</span>';
    return $return;
}
add_shortcode('highlight2', 'wz_highlight2');
function wz_highlight2($atts, $content = null, $code = "") {
    $return = '<span class="highlight2">' . $content . '</span>';
    return $return;
}
/* SPACE -----------------------------------------------------------------*/
add_shortcode('space', 'wz_space');
function wz_space($atts, $content = null) {
    return '<div class="space_hr"></div>';
}
/* BAR ------------------------------------------------------------------*/
add_shortcode('bar', 'wz_bar');
function wz_bar($atts, $content = null) {
    return '<div class="bar_hr"></div>';
}
/* TABS ----------------------------------------------------------------------*/
add_shortcode('tabs', 'tabgroup');
function tabgroup($atts, $content = null) {
    $tabs_count = 0;
    global $tabs_array, $tabs_count;
    do_shortcode($content);
    $return = '';
    if (is_array($tabs_array)) {
        $i = 0;
        $x = 0;
        $return .= '<div id="tabs"><ul class="tabs">';
        foreach ($tabs_array as $tab) {
            $i++;
            $return .= '<li><a title="' . $tab['title'] . '" href="#tab-' . $i . '">' . $tab['title'] . '</a></li>';
        }
        $return .= '</ul>';
        foreach ($tabs_array as $tab) {
            $x++;
            $return .= '<div class="pane" id="tab-' . $x . '">' . do_shortcode($tab['content']) . '</div>';
        }
        $return .= '</div>';
        return $return;
    }
}
add_shortcode('tab', 'tab');
function tab($atts, $content = null) {
    global $tabs_array, $tabs_count;
    extract(shortcode_atts(array(
        'title' => 'Title goes here'
    ), $atts));
    $tabs_array[] = array(
        'title' => $title,
        'content' => do_shortcode($content)
    );
    $tabs_count++;
}
/* TOGGLES--------------------------------------------------------------------*/
add_shortcode('toggle', 'wz_toggle');
function wz_toggle($atts, $content = null) {
    extract(shortcode_atts(array(
        'title' => 'Click To Open'
    ), $atts));
    return '<div class="trigger"><a href="#">' . $title . '</a></div>
                <div class="toggle_container">' . '<div class="block">' . do_shortcode($content) . '</div>' . '</div>';
}
/* BUTTTONS ------------------------------------------------------------------*/
add_shortcode('button', 'wz_button');
function wz_button($atts, $content = null) {
    extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
    return '<div class="button-link"><a href="' . $link . '">' . do_shortcode($content) . '</a></div>';
}
/* PLAYER ------------------------------------------------------------------*/
add_shortcode('player', 'wz_player');
function wz_player($atts, $content = null) {
    extract(shortcode_atts(array(
        'width' => ''
    ), $atts));
    $a        = $width;
    $b        = 153;
    $decrease = $a - $b;
    return '
<style>
.audiojsW {width:' . $width . ';}
.audiojsW .scrubberW  {width:' . $decrease . 'px;}
</style>

<div class="player-single">
<div class="audiojsW">
    <audio></audio>
    <div class="play-pauseW">
        <p class="playW"></p>
        <p class="pauseW"></p>
        <p class="loadingW"></p>
        <p class="errorW"></p>
    </div>
    <div class="scrubberW">
        <div class="progressW"></div>
        <div class="loadedW"></div>
    </div>
    <div class="timeW">
        <em class="playedW">00:00</em>/<strong class="durationW">00:00</strong>
    </div>
    <div class="error-messageW"></div>
</div>
<!-- end .audiojsW -->
<ol>
<li><a href="#" data-src="' . do_shortcode($content) . '"></a></li>
</ol>
</div>
';
}
add_shortcode('player_more', 'wz_player_more');
function wz_player_more($atts, $content = null) {
    extract(shortcode_atts(array(
        'width' => ''
    ), $atts));
    $a         = $width;
    $b         = 153;
    $c         = 10;
    $decrease  = $a - $b;
    $decrease2 = $a - $c;
    return '
<style>
.audiojsW {width:' . $width . ';}
.audiojsW .scrubberW {width:' . $decrease . 'px;}
.player-more li {width:' . $decrease2 . 'px;}
</style>

<div class="audiojsW">
<audio></audio>
<div class="play-pauseW">
<p class="playW"></p>
<p class="pauseW"></p>
<p class="loadingW"></p>
<p class="errorW"></p>
</div>
<div class="scrubberW">
<div class="progressW"></div>
<div class="loadedW"></div>
</div>
<div class="timeW">
<em class="playedW">00:00</em>/<strong class="durationW">00:00</strong>
</div>
<div class="error-messageW"></div>
</div><!-- end .audiojsW -->';
}
add_shortcode('song', 'wz_song');
function wz_song($atts, $content = null) {
    extract(shortcode_atts(array(
        'url' => ''
    ), $atts));
    $playlist = '<li><a href="#" data-src="' . $url . '">' . do_shortcode($content) . '</a></li>';
    return $playlist;
}
add_shortcode('ol', 'wz_ol');
function wz_ol($atts, $content = null) {
    return '<div class="player-more"><ol>' . do_shortcode($content) . '</ol></div>';
}
/* PRETTY - PHOTO, VIDEO -------------------------------------------------------------------*/
add_shortcode('photo_pretty', 'wz_photo_pretty');
function wz_photo_pretty($atts, $content = null) {
    extract(shortcode_atts(array(
        'width' => '',
        'height' => ''
    ), $atts));
    return '
   
<div class="pretty-photo-sc"><a href="' . do_shortcode($content) . '" data-rel="prettyPhoto[pp_gallery]"><img src="' . do_shortcode($content) . '" width="' . $width . '" height="' . $height . '" alt="Photo" /></a></div>';
}
add_shortcode('video_pretty', 'wz_video_pretty');
function wz_video_pretty($atts, $content = null) {
    extract(shortcode_atts(array(
        'width' => '',
        'height' => '',
        'img' => ''
    ), $atts));
    return '
   
<div class="video-photo-sc"><a href="' . do_shortcode($content) . '" data-rel="prettyPhoto"><img src="' . $img . '" width="' . $width . '" height="' . $height . '" alt="Video" /></a></div>';
}
?>