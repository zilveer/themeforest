<?php
$output = $color = $el_class = '';
extract(shortcode_atts(array(
    'color' => 'alert-info',
    'el_class' => ''
), $atts));
$el_class = $this->getExtraClass($el_class);

switch ($color) {
    case 'alert-success':
        $output .= '<div class="alert '.$color.' '.$el_class.'">';
		$output .= '<div class="icon-alert">';
		$output .= '<i class="fa fa-check"></i>';

        break;
    case 'alert-warning':
        $output .= '<div class="alert '.$color.' '.$el_class.'">';
        $output .= '<div class="icon-alert">';
        $output .= '<i class="fa fa-exclamation-triangle"></i>';

        break;
    case 'alert-danger':
        $output .= '<div class="alert '.$color.' '.$el_class.'">';
        $output .= '<div class="icon-alert">';
        $output .= '<i class="fa fa-times"></i>';

        break;
    case 'alert-info':
        $output .= '<div class="alert '.$color.' '.$el_class.'">';
        $output .= '<div class="icon-alert">';
        $output .= '<i class="fa fa-info"></i>';
        break;
}

$output .= '</div>';
$output .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
$output .= $content;
$output .= '</div>';

echo $output .= $this->endBlockComment('alert box')."\n";