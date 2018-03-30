<?php
$output = $title = $values = $units = $bgcolor = $custombgcolor = $options = $el_class = '';
extract( shortcode_atts( array(
    'values' => '',
    'units' => '',
    'el_class' => ''
), $atts ) );
wp_enqueue_script( 'waypoints' );

$el_class = $this->getExtraClass($el_class);

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'krown-progress-bars'.$el_class, $this->settings['base']);
$output = '<div class="'.$css_class.'"><ul>';

$graph_lines = explode(",", $values);
$max_value = 0.0;
$graph_lines_data = array();
foreach ($graph_lines as $line) {
    $new_line = array();
    $data = explode("|", $line);
    $new_line['value'] = isset($data[0]) ? $data[0] : 0;
    $new_line['percentage_value'] = isset($data[1]) && preg_match('/^\d{1,2}\%$/', $data[1]) ? (float)str_replace('%', '', $data[1]) : false;
    if($new_line['percentage_value']!=false) {
        $new_line['label'] = isset($data[2]) ? $data[2] : '';
    } else {
        $new_line['label'] = isset($data[1]) ? $data[1] : '';
    }

    if($new_line['percentage_value']===false && $max_value < (float)$new_line['value']) {
        $max_value = $new_line['value'];
    }

    $graph_lines_data[] = $new_line;
}

foreach ( $graph_lines_data as $line ) {

    $unit = ($units!='') ? ' <span>' . $units . '</span>' : '';

    if($line['percentage_value']!==false) {
        $percentage_value = $line['percentage_value'];
    } elseif($max_value > 100.00) {
        $percentage_value = (float)$line['value'] > 0 && $max_value > 100.00 ? round((float)$line['value']/$max_value*100, 4) : 0;
    } else {
        $percentage_value = $line['value'];
    }

    $output .= '<li data-value="' . ( $percentage_value ) . '">
        <h6>' . $line['label'] . '</h6>
        <p><span class="text"><span class="value">' . $line['value'] . '</span>' . $unit . '</span></p>
    </li>';

}

$output .= '</ul></div>';

echo $output . $this->endBlockComment('progress_bar') . "\n";