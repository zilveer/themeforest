<?php
$output = $title = $values = $cls = $striped = $animate = $tooltip = $style = $animate_c = '';
extract( shortcode_atts( array(
	'title' => '',
	'values' => '',
	'bar_size' => '',
	'option' => '',
	'show_per' => 'Show',
	'title_align' => 'none'
), $atts ) );

if(!empty($title))
	$output .= '<h2 class="md-margin">'.esc_attr($title).'</h2>';

if($bar_size == 'Large')
	$cls = 'progress progress-lg';
elseif($bar_size == 'Normal')
	$cls = 'progress';
elseif($bar_size == 'small')
	$cls = 'progress progress-sm';
elseif($bar_size == 'mini')
	$cls = 'progress progress-xs';

$graph_lines = explode( ",", $values );
$graph_lines_data = array();
foreach ( $graph_lines as $line ) {
	$new_line = array();
	$color_index = 2;
	$data = explode( "|", $line );
	$new_line['value'] = isset( $data[0] ) ? $data[0] : 0;
	$new_line['percentage_value'] = isset( $data[1] ) && preg_match( '/^\d{1,2}\%$/', $data[1] ) ? (float)str_replace( '%', '', $data[1] ) : false;
	if ( $new_line['percentage_value'] != false ) {
		$color_index += 1;
		$new_line['label'] = isset( $data[2] ) ? $data[2] : '';
	} else {
		$new_line['label'] = isset( $data[1] ) ? $data[1] : '';
	}
	$new_line['color'] = ( isset( $data[$color_index] ) ) ?  $data[$color_index] : $custombgcolor;

	if ( $new_line['percentage_value'] === false && $max_value < (float)$new_line['value'] ) {
		$max_value = $new_line['value'];
	}

	$graph_lines_data[] = $new_line;
}
$options = explode( ",", $option );
if(in_array( "striped", $options ))	$striped = ' progress-bar-striped';
if(in_array( "tooltip", $options ))	$tooltip = 'progress-tooltip';
	
foreach ( $graph_lines_data as $line ) {
	
	if(!empty($line['value'])){
		if(in_array( "Animated", $options )){ $animate = ' progress-animate'; $animate_c = 'data-width="'.strip_tags($line['value']).'"'; }else{
			$style = 'style="width: '.strip_tags($line['value']).'%;"';
		}
		$output .= '<div class="'.$cls.'">
			<div class="progress-bar progress-bar-'.trim($line['color']).$striped.$animate.'" role="progressbar" '.$animate_c.' aria-valuenow="40"  aria-valuemin="0" aria-valuemax="100" '.$style.'>
				<span class="sr-only">'.strip_tags($line['value']).'% Complete (custom)</span>';
		if(!empty($tooltip)) 
			$output .=  '<span class="progress-text progress-tooltip">';
		if($show_per == 'Show')		
			$output .= ''.strip_tags($line['value']).'%';
		if(!empty($tooltip))
			$output .= '</span>'; 
		$output .= '</div><!-- End .progress-bar -->
		</div><!-- End .progress -->';
	}
}

echo $output . "\n";