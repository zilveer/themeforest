<?php

/*********** Shortcode: Chart Line ************************************************************/

$tcvpb_elements['chart_line_tc'] = array(
	'name' => esc_html__('Chart Line', 'ABdev_aeron' ),
	'type' => 'block',
	'icon' => 'pi-chart-line',
	'category' =>  esc_html__('Charts', 'ABdev_aeron'),
	'child' => 'chart_lines_tc',
	'child_button' => esc_html__('New Label', 'ABdev_aeron'),
	'child_title' => esc_html__('Label Section', 'ABdev_aeron'),
	'attributes' => array(
		'width' => array(
			'description' => esc_html__('Width', 'ABdev_aeron'),
			'info' => esc_html__('Width of the Chart, type % or px at the end of the number.', 'ABdev_aeron'),
			'default' => '100%',
		),
		'months' => array(
			'description' => esc_html__('Months', 'ABdev_aeron'),
			'info' => esc_html__('Type months (e.g. January,February,March,April,May,June,July)', 'ABdev_aeron'),
		),
		'id' => array(
			'description' => esc_html__('ID', 'ABdev_aeron'),
			'info' => esc_html__('Additional custom ID', 'ABdev_aeron'),
			'tab' => esc_html__('Advanced', 'ABdev_aeron'),
		),	
		'class' => array(
			'description' => esc_html__('Class', 'ABdev_aeron'),
			'info' => esc_html__('Additional custom classes for custom styling', 'ABdev_aeron'),
			'tab' => esc_html__('Advanced', 'ABdev_aeron'),
		),
	),
);

function tcvpb_chart_line_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('chart_line_tc'), $attributes));
	static $i = 0;
	$i++;

	$id_out = ($id!='') ? 'id='.$id.'' : '';
	$class_out = ($class!='') ? 'class='.$class.'' : '';

	$months = str_replace(',','","',$months);
	$months_out = '"' . implode("", explode(' ', $months)) . '"';

	return '<div '.esc_attr($id_out).' '.esc_attr($class_out).' style=" width:'.esc_attr($width).'; ">
				<canvas id="line_canvas'.$i.'"></canvas>
			</div>

		<script>
			var lineChartData'.$i.' = {
				labels : ['.$months_out.'],
				datasets : [
					'.do_shortcode($content).'
				]
			}
		
		window.addEventListener("load",function(event) {
			var ctx'.$i.' = document.getElementById("line_canvas'.$i.'").getContext("2d");
			window.myLine = new Chart(ctx'.$i.').Line(lineChartData'.$i.', {
				responsive: true
			});
		},false);

		</script>';
	
}

$tcvpb_elements['chart_lines_tc'] = array(
	'name' => esc_html__('Line Section', 'ABdev_aeron' ),
	'type' => 'child',
	'attributes' => array(
		'label' => array(
			'default' => 'My First dataset',
			'description' => esc_html__('Label', 'ABdev_aeron'),
		),
		'fillcolor' => array(
			'description' => esc_html__('Fill Color', 'ABdev_aeron'),
			'type' => 'coloralpha',
			'default' => 'rgba(220,220,220,0.2)',
		),
		'strokecolor' => array(
			'description' => esc_html__('Stroke Color', 'ABdev_aeron'),
			'type' => 'color',
			'default' => 'rgba(220,220,220,1)',
		),
		'pointcolor' => array(
			'description' => esc_html__('Point Color', 'ABdev_aeron'),
			'type' => 'color',
			'default' => 'rgba(220,220,220,1)',
		),
		'pointstrokecolor' => array(
			'description' => esc_html__('Point Stroke Color', 'ABdev_aeron'),
			'type' => 'color',
			'default' => '#fff',
		),
		'pointhighlightfill' => array(
			'description' => esc_html__('Point Highlight Fill Color', 'ABdev_aeron'),
			'type' => 'color',
			'default' => '#fff',
		),
		'pointhighlightstroke' => array(
			'description' => esc_html__('Point Highlight Stroke Color', 'ABdev_aeron'),
			'type' => 'color',
			'default' => 'rgba(220,220,220,1)',
		),
		'data' => array(
			'description' => esc_html__('Line Points', 'ABdev_aeron'),
			'info' => esc_html__('Seperate numbers with comma (e.g. 28, 48, 40, 19, 86, 27, 90)', 'ABdev_aeron'),
		),
	),
);

function tcvpb_chart_lines_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('chart_lines_tc'), $attributes));
	$line_attr = '
		label: "'.esc_attr($label).'",
		fillColor : "'.esc_attr($fillcolor).'",
		strokeColor : "'.esc_attr($strokecolor).'",
		pointColor : "'.esc_attr($pointcolor).'",
		pointStrokeColor : "'.esc_attr($pointstrokecolor).'",
		pointHighlightFill : "'.esc_attr($pointhighlightfill).'",
		pointHighlightStroke : "'.esc_attr($pointhighlightstroke).'",
		data : ['.esc_attr($data).']';

	$return = '{'.$line_attr.'},';
  
	return $return;
}

function tcvpb_enqueue_chart_line_script() {
	global $post;
	if( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'chart_line_tc') ) {
		wp_enqueue_script('chart', TCVPB_DIR.'js/chart.js', array('jquery'), TCVPB_VERSION, true);
	}
}
add_action( 'wp_enqueue_scripts', 'tcvpb_enqueue_chart_line_script' );