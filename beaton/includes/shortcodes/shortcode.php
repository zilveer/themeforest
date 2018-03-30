<?php

/* COLUMNS -------------------------------------------------------------------*/
function wize_one_half($atts, $content = null) {
    return '<div class="one_half">' . do_shortcode($content) . '</div>';
}

function wize_one_half_last($atts, $content = null) {
    return '<div class="one_half last">' . do_shortcode($content) . '</div>
        <div class="clearboth"></div>';
}

function wize_one_third($atts, $content = null) {
    return '<div class="one_third">' . do_shortcode($content) . '</div>';
}

function wize_one_third_last($atts, $content = null) {
    return '<div class="one_third last">' . do_shortcode($content) . '</div>
        <div class="clearboth"></div>';
}

function wize_two_third($atts, $content = null) {
    return '<div class="two_third">' . do_shortcode($content) . '</div>';
}

function wize_two_third_last($atts, $content = null) {
    return '<div class="two_third last">' . do_shortcode($content) . '</div>
        <div class="clearboth"></div>';
}

function wize_one_fourth($atts, $content = null) {
    return '<div class="one_fourth">' . do_shortcode($content) . '</div>';
}

function wize_one_fourth_last($atts, $content = null) {
    return '<div class="one_fourth last">' . do_shortcode($content) . '</div>
        <div class="clearboth"></div>';
}

function wize_three_fourth($atts, $content = null) {
    return '<div class="three_fourth">' . do_shortcode($content) . '</div>';
}

function wize_three_fourth_last($atts, $content = null) {
    return '<div class="three_fourth last">' . do_shortcode($content) . '</div>
        <div class="clearboth"></div>';
}

function wize_one_fifth($atts, $content = null) {
    return '<div class="one_fifth">' . do_shortcode($content) . '</div>';
}

function wize_one_fifth_last($atts, $content = null) {
    return '<div class="one_fifth last">' . do_shortcode($content) . '</div>
        <div class="clearboth"></div>';
}

function wize_two_fifth($atts, $content = null) {
    return '<div class="two_fifth">' . do_shortcode($content) . '</div>';
}

function wize_two_fifth_last($atts, $content = null) {
    return '<div class="two_fifth last">' . do_shortcode($content) . '</div>
        <div class="clearboth"></div>';
}

function wize_three_fifth($atts, $content = null) {
    return '<div class="three_fifth">' . do_shortcode($content) . '</div>';
}

function wize_three_fifth_last($atts, $content = null) {
    return '<div class="three_fifth last">' . do_shortcode($content) . '</div>
        <div class="clearboth"></div>';
}

function wize_four_fifth($atts, $content = null) {
    return '<div class="four_fifth">' . do_shortcode($content) . '</div>';
}

function wize_four_fifth_last($atts, $content = null) {
    return '<div class="four_fifth last">' . do_shortcode($content) . '</div>
        <div class="clearboth"></div>';
}

function wize_one_sixth($atts, $content = null) {
    return '<div class="one_sixth">' . do_shortcode($content) . '</div>';
}

function wize_one_sixth_last($atts, $content = null) {
    return '<div class="one_sixth last">' . do_shortcode($content) . '</div>
        <div class="clearboth"></div>';
}

function wize_five_sixth($atts, $content = null) {
    return '<div class="five_sixth">' . do_shortcode($content) . '</div>';
}

function wize_five_sixth_last($atts, $content = null) {
    return '<div class="five_sixth last">' . do_shortcode($content) . '</div>
        <div class="clearboth"></div>';
}

add_shortcode('one_half', 'wize_one_half');
add_shortcode('one_half_last', 'wize_one_half_last');
add_shortcode('one_third', 'wize_one_third');
add_shortcode('one_third_last', 'wize_one_third_last');
add_shortcode('two_third', 'wize_two_third');
add_shortcode('two_third_last', 'wize_two_third_last');
add_shortcode('one_fourth', 'wize_one_fourth');
add_shortcode('one_fourth_last', 'wize_one_fourth_last');
add_shortcode('three_fourth', 'wize_three_fourth');
add_shortcode('three_fourth_last', 'wize_three_fourth_last');
add_shortcode('one_fifth', 'wize_one_fifth');
add_shortcode('one_fifth_last', 'wize_one_fifth_last');
add_shortcode('two_fifth', 'wize_two_fifth');
add_shortcode('two_fifth_last', 'wize_two_fifth_last');
add_shortcode('three_fifth', 'wize_three_fifth');
add_shortcode('three_fifth_last', 'wize_three_fifth_last');
add_shortcode('four_fifth', 'wize_four_fifth');
add_shortcode('four_fifth_last', 'wize_four_fifth_last');
add_shortcode('one_sixth', 'wize_one_sixth');
add_shortcode('one_sixth_last', 'wize_one_sixth_last');
add_shortcode('five_sixth', 'wize_five_sixth');
add_shortcode('five_sixth_last', 'wize_five_sixth_last');

/* TEXT HOME ------------------------------------------------------------------*/
function wize_text_home($atts, $content = null) {
    $return = '
<div class="text-home">' . $content . '</div>';
    return $return;
}

add_shortcode('text', 'wize_text_home');


/* TITLE ------------------------------------------------------------------*/
function wize_title_top($atts, $content = null) {
    $return = '
<h3 class="sh-title">' . $content . '</h3>';
    return $return;
}

function wize_title_under($atts, $content = null) {
    $return = '
<h3 class="sh-title2">' . $content . '</h3>';
    return $return;
}

add_shortcode('tt', 'wize_title_top');
add_shortcode('tu', 'wize_title_under');


/* DROPCAPS ------------------------------------------------------------------*/
function wize_dropcap($atts, $content = null, $code = "") {
    $return = '<span class="dropcap">' . $content . '</span>';
    return $return;
}

add_shortcode('dropcap', 'wize_dropcap');


/* QUOTE -----------------------------------------------------------------*/
function wize_pullquote_left($atts, $content = null, $code = "") {
    $return = '<span class="pullquote_left">' . $content . '</span>';
    return $return;
}

function wize_pullquote_right($atts, $content = null, $code = "") {
    $return = '<span class="pullquote_right">' . $content . '</span>';
    return $return;
}

add_shortcode('quote_left', 'wize_pullquote_left');
add_shortcode('quote_right', 'wize_pullquote_right');


/* HIGHLIGHT -----------------------------------------------------------------*/
function wize_highlight($atts, $content = null, $code = "") {
    $return = '<span class="highlight">' . $content . '</span>';
    return $return;
}

function wize_highlight2($atts, $content = null, $code = "") {
    $return = '<span class="highlight2">' . $content . '</span>';
    return $return;
}

add_shortcode('highlight', 'wize_highlight');
add_shortcode('highlight2', 'wize_highlight2');


/* SPACE -----------------------------------------------------------------*/
function wize_space($atts, $content = null) {
    return '<div class="space_hr"></div>';
}

add_shortcode('space', 'wize_space');


/* BAR ------------------------------------------------------------------*/
function wize_bar($atts, $content = null) {
    return '<div class="bar_hr"></div>';
}

add_shortcode('bar', 'wize_bar');


/* TABS ----------------------------------------------------------------------*/
function wize_tabgroup($atts, $content = null) {
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
            $return .= '<li><a title="' . esc_attr($tab['title']) . '" href="#tab-' . $i . '">' . $tab['title'] . '</a></li>';
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

function wize_tab($atts, $content = null) {
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

add_shortcode('tabs', 'wize_tabgroup');
add_shortcode('tab', 'wize_tab');


/* TOGGLES--------------------------------------------------------------------*/
function wize_toggle($atts, $content = null) {
    extract(shortcode_atts(array(
        'title' => 'Click To Open'
    ), $atts));
    return '<div class="trigger"><a href="#">' . $title . '</a></div>
                <div class="toggle_container">' . '<div class="block">' . do_shortcode($content) . '</div>' . '</div>';
}

add_shortcode('toggle', 'wize_toggle');


/* BUTTTONS ------------------------------------------------------------------*/
function wize_button($atts, $content = null) {
    extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
    return '<div class="button-link"><a href="' . esc_url($link) . '" target="_blank">' . do_shortcode($content) . '</a></div>';
}

add_shortcode('button', 'wize_button');

/* SOUNDCLOUD ------------------------------------------------------------------*/
function wize_soundcloud($atts, $content = null) {
    extract(shortcode_atts(array(
        'link' => '#'
    ), $atts));
    return '<a href="' . esc_url($link) . '" class="fap-single-track" id="sdc">' . do_shortcode($content) . '</a>';
}

add_shortcode('sdc', 'wize_soundcloud');


/* PRETTY - PHOTO, VIDEO -------------------------------------------------------------------*/
function wize_photo_pretty($atts, $content = null) {
    extract(shortcode_atts(array(
        'width' => '',
        'height' => ''
    ), $atts));
    return '
   
<div class="pretty-photo-sc"><a href="' . esc_url(do_shortcode($content)) . '" data-rel="prettyPhoto[pp_gallery]"><img src="' . esc_url(do_shortcode($content)) . '" width="' . esc_attr($width) . '" height="' . esc_attr($height) . '" alt="Photo" /></a></div>';
}

function wize_video_pretty($atts, $content = null) {
    extract(shortcode_atts(array(
        'width' => '',
        'height' => '',
        'img' => ''
    ), $atts));
    return '
   
<div class="video-photo-sc"><a href="' . esc_url(do_shortcode($content)) . '" data-rel="prettyPhoto"><img src="' . esc_url($img) . '" width="' . esc_attr($width) . '" height="' . esc_attr($height) . '" alt="Video" /></a></div>';
}

add_shortcode('photo_pretty', 'wize_photo_pretty');
add_shortcode('video_pretty', 'wize_video_pretty');