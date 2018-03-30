<?php

// Icon Box Grid

function th_icon_box_grid($atts, $content = null) {
    extract(shortcode_atts(array(
        "icon" => 'heart-o',
        "title" => 'Hey! I am title',
        "text" => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.',
        "el_class" => '',
    ), $atts));

    $icon = str_replace('fa-','',$icon);


$output = '<div class="'.$el_class.' service-box">
                <!-- Icon -->
                <i class="fa fa-'.$icon.' fa-3x"></i>

                <!-- Title and Description -->
                <div class="service-title">
                    <h3>'.$title.'</h3>
                </div>
                <p>'.$text.'</p>
            </div>';

        return $output;
}

remove_shortcode('icon_box_grid');
add_shortcode('icon_box_grid', 'th_icon_box_grid');