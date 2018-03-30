<?php

// Button

function th_button($atts, $content = null) {
    extract(shortcode_atts(array(
        "type" => 'gold-btn',
        "label" => 'Text on the button',
        "url" => '',
        "target" => '_self',
        "align" => 'left',
        "el_class" => '',
    ), $atts));

    switch ( $type ) {
        case 'gold-btn':
            $btn_class_type = 'gold-btn';
            break;

        case 'black-btn':
            $btn_class_type = 'black-btn';
            break;

        case 'black-btn':
            $btn_class_type = 'black-btn';
            break;

        case 'success-btn':
            $btn_class_type = 'btn-success';
            break;

        case 'info-btn':
            $btn_class_type = 'btn-info';
            break;

        case 'warning-btn':
            $btn_class_type = 'btn-warning';
            break;

        case 'danger-btn':
            $btn_class_type = 'btn-danger';
            break;

        case 'link-btn':
            $btn_class_type = 'btn-link';
            break;
    }

    $output = '<div class="margin-top-x2 text-'.$align.'">';
    $output .= '<a href="'.$url.'" target="'.$target.'" class="btn '.$btn_class_type.' '.$el_class.'">'.$label.'</a>';
    $output .= '</div>';

    return $output;

}

remove_shortcode('button');
add_shortcode('button', 'th_button');
