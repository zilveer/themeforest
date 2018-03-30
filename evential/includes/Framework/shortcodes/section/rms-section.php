<?php

function section($atts, $content = null) {
    extract(shortcode_atts(array(
        'id' => '',
        'formate' => '',
        'class' => '',
        'bgimage' => '',
        'bgcolor' => ''
                    ), $atts));

    $section_return = '';
    $result = '';
    if ($formate == 'Simple-Section') {
        $result .= '<section id="' . esc_attr($id) . '" class="' . esc_attr($class) . '" style="background-color:#' . esc_attr($bgcolor) . '"><div class="container"><div class="row">';
        $result .= do_shortcode($content);
        $result .= '</div></section><div class="clear"></div></div>';
    } elseif ($formate == 'Parallax-Section') {
        $result .= '<section id="' . esc_attr($id) . '" class="' . esc_attr($class) . '" style="background: url('.esc_url($bgimage).') bottom center no-repeat;" ><div class="container"><div class="row">';
        $result .= do_shortcode($content);
        $result .= '</div></section><div class="clear"></div></div>';
    }
    return $section_return .= force_balance_tags($result);
}

add_shortcode("rms-section", "section");
