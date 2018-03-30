<?php
$output = $title = $title_align = $el_class = '';
extract(shortcode_atts(array(
    'title' => __("Title", "js_composer"),
    'title_size' => '',
    'title_color' => '',
    'text_in_box' => 'yes',
    'text_position' => 'center',
    'box_height' => '',
    'box_padding' => '',
    'box_background_color' => '',
    'box_border_color' => '',
    'box_border_width' => '',
    'box_border_radius' => '',
    'box_border_style' => 'solid',
    'line_color' => '',
    'line_width' => '',
    'line_thickness' => '',
    'line_border_style' => 'solid',
    'up' => '',
    'down' => '',
    'box_margin' => '',
    'line_dots' => '',
    'line_dots_size' => '6',
    'line_dots_color' => '',
    'el_class' => ''
), $atts));

$title = esc_html($title);
$title_size = esc_attr($title_size);
$title_color = esc_attr($title_color);
$box_height = esc_attr($box_height);
$box_padding = esc_attr($box_padding);
$box_background_color = esc_attr($box_background_color);
$box_border_color = esc_attr($box_border_color);
$box_border_width = esc_attr($box_border_width);
$box_border_radius = esc_attr($box_border_radius);
$line_color = esc_attr($line_color);
$line_width = esc_attr($line_width);
$line_thickness = esc_attr($line_thickness);
$up = esc_attr($up);
$down = esc_attr($down);
$box_margin = esc_attr($box_margin);
$line_dots_size = esc_attr($line_dots_size);
$line_dots_color = esc_attr($line_dots_color);
$el_class = esc_attr($el_class);

$el_class = $this->getExtraClass($el_class);
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_text_separator wpb_content_element full '.$title_align.$el_class, $this->settings['base']);

$separator_wrapper_styles  = array();
$separator_box_styles  = array();
$separator_lines_styles  = array();
$separator_line_dots_style = array();
$separator_box_classes  = '';
$separator_line_classes  = '';
$line_left_margin = '';
$line_right_margin = '';
$text_position_style = '';


if($title_color != ""){
    $separator_box_styles[] = "color:". $title_color;
}

if($title_size != ""){
    $title_size = (strstr($title_size, 'px', true)) ? $title_size : $title_size . "px";
    $separator_box_styles[] = "font-size:". $title_size;
}

// box styles which are always enabled
if($box_height != ""){
    $box_height = (strstr($box_height, 'px', true)) ? $box_height : $box_height . "px";
    $separator_box_styles[] = "line-height:". $box_height;
}

if($box_padding != "") {
    $box_padding = (strstr($box_padding, 'px', true)) ? $box_padding : $box_padding . "px";
    if ($text_in_box != 'yes') {
        if ($text_position == 'left') {
            $separator_box_styles[] = "padding-left: 0; padding-right: ".$box_padding;
        }
        elseif ($text_position == 'right') {
            $separator_box_styles[] = "padding-right: 0; padding-left: ".$box_padding;
        }
        else {
            $separator_box_styles[] = "padding: 0 ".$box_padding;
        }
    }
    else {
        $separator_box_styles[] = "padding: 0 ".$box_padding;
    }
}

if($box_margin != ""){
    $box_margin = (strstr($box_margin, 'px', true)) ? $box_margin : $box_margin . "px";
    $line_left_margin .= "margin-left:".$box_margin;
    $line_right_margin .= "margin-right:".$box_margin;
}


// only box style
if($text_in_box == 'yes'){
    $separator_box_classes .= "box";

    if($box_background_color != ""){
        $separator_box_styles[] = "background-color:". $box_background_color;
    }

    if($box_border_color != "") {
        $separator_box_styles[] = "border-color: ".$box_border_color;
    }

    if($box_border_width != "") {
        $box_border_width = (strstr($box_border_width, 'px', true)) ? $box_border_width : $box_border_width . "px";
        $separator_box_styles[] = "border-width:". $box_border_width;
    }

    if($box_border_radius != ""){
        $box_border_radius = (strstr($box_border_radius, 'px', true)) ? $box_border_radius : $box_border_radius . "px";
        $separator_box_styles[]= "border-radius:". $box_border_radius;
    }

    if($box_border_style != "" && $box_border_style  != "transparent") {
        $separator_box_styles[] = "border-style: ".$box_border_style;
    }
}

// wrapper style
if($up != ""){
    $up = (strstr($up, 'px', true)) ? $up : $up . "px";
    $separator_wrapper_styles[] = "margin-top:". $up;
}

if($down != ""){
    $down = (strstr($down, 'px', true)) ? $down : $down . "px";
    $separator_wrapper_styles[] = "margin-bottom:". $down;
}

// line style
if($line_color != "") {
    $separator_lines_styles[] = "border-color:". $line_color;
}

if($line_width != ""){
    $line_width = (strstr($line_width, 'px', true)) ? $line_width : $line_width . "px";
    $separator_lines_styles[]= "width:". $line_width;
}

if($line_thickness != "") {
    $line_thickness = filter_var($line_thickness, FILTER_SANITIZE_NUMBER_INT);
    $separator_lines_styles[] = "border-bottom-width: ".$line_thickness ."px";
    $separator_lines_styles[] = "margin-bottom:-". ceil($line_thickness/2) ."px";
}

if($line_border_style != "" && $line_border_style  != "transparent") {
    $separator_lines_styles[] = "border-style:".$line_border_style;
}

if($line_dots == "yes") {
    $separator_line_classes .= 'dots_on_line';
    if($line_dots_size != '') { // has default value
        $line_dots_size = filter_var($line_dots_size, FILTER_SANITIZE_NUMBER_INT);

        if($line_thickness != ''){
            // (border width - dot height) / 2
            $separator_line_dots_style[] = 'top: '.(ceil(($line_thickness - $line_dots_size)/2)).'px;';
        }

        $separator_line_dots_style[] = 'height:' . $line_dots_size . 'px';
        $separator_line_dots_style[] = 'width:' . $line_dots_size . 'px';
        $separator_line_left_dot_position = 'right:' . -ceil($line_dots_size / 2) . 'px';
        $separator_line_right_dot_position = 'left:' . -ceil($line_dots_size / 2) . 'px';
    }
    if($line_dots_color != ''){
        $separator_line_dots_style[] = 'background-color:'.$line_dots_color.';';
    }
}

$output .= '<div class="'.$css_class.' '.$text_position.'">';
    $output .= '<div class="separator_wrapper" style="'.implode(';', $separator_wrapper_styles).'">';
    if ($text_position == 'center' || $text_position == 'right') {
        $output .= '<div class="q_line_before '.$separator_line_classes.'"  style="'.implode(';', $separator_lines_styles).';'.$line_right_margin.'">';
    }
    if($line_dots == "yes") {
        $output .= '<span class="q_separator_line_inner" style="' . implode(';', $separator_line_dots_style) . ';' . $separator_line_left_dot_position . '"></span>';
    }
    if ($text_position == 'center' || $text_position == 'right') {
        $output .= '</div>'; // end q_line_before
    }
    $output .= '<div class="separator_content '.$separator_box_classes.'" style="'.implode(';', $separator_box_styles).'">';
        $output .= '<span>' . $title . '</span>';
    $output .='</div>'; // end separator_content
    if ($text_position == 'center' || $text_position == 'left') {
        $output .= '<div class="q_line_after '.$separator_line_classes.'"  style="'.implode(';', $separator_lines_styles).';'.$line_left_margin.'">';
    }
    if($line_dots == "yes") {
        $output .= '<span class="q_separator_line_inner" style="' . implode(';', $separator_line_dots_style) . ';' . $separator_line_right_dot_position . '"></span>';
    }
    if ($text_position == 'center' || $text_position == 'left') {
        $output .= '</div>'; // end q_line_after
    }
    $output .='</div>'; // end separator_wrapper
$output .= '</div>'.$this->endBlockComment('separator')."\n"; // end separator_content

print $output;