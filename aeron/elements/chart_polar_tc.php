<?php

/*********** Shortcode: Chart Polar Area ************************************************************/

$tcvpb_elements['chart_polar_tc'] = array(
	'name' => esc_html__('Chart Polar Area', 'ABdev_aeron' ),
	'type' => 'block',
	'icon' => 'pi-chart-polar',
	'category' =>  esc_html__('Charts', 'ABdev_aeron'),
	'child' => 'chart_polars_tc',
	'child_button' => esc_html__('New Label', 'ABdev_aeron'),
	'child_title' => esc_html__('Label Section', 'ABdev_aeron'),
	'attributes' => array(
		'width' => array(
			'description' => esc_html__('Width', 'ABdev_aeron'),
			'info' => esc_html__('Width of the Chart, type % or px at the end of the number.', 'ABdev_aeron'),
			'default' => '100%',
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

function tcvpb_chart_polar_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('chart_polar_tc'), $attributes));
	static $i = 0;
	$i++;

	$id_out = ($id!='') ? 'id='.$id.'' : '';
	$class_out = ($class!='') ? 'class='.$class.'' : '';

	return '<div '.esc_attr($id_out).' '.esc_attr($class_out).' style=" width:'.esc_attr($width).'; ">
				<canvas id="polar_canvas'.$i.'"></canvas>
			</div>

		<script>
			var polarData'.$i.' = [
				'.do_shortcode($content).'
			];

			window.addEventListener("load",function(event) {
				var ctx'.$i.' = document.getElementById("polar_canvas'.$i.'").getContext("2d");
				window.myPolarArea = new Chart(ctx'.$i.').PolarArea(polarData'.$i.', {
					responsive:true
				});
			},false);

		</script>';
	
}

$tcvpb_elements['chart_polars_tc'] = array(
	'name' => esc_html__('Line Section', 'ABdev_aeron' ),
	'type' => 'child',
	'attributes' => array(
		'value' => array(
			'default' => '300',
			'description' => esc_html__('Value', 'ABdev_aeron'),
		),
		'color' => array(
			'description' => esc_html__('Color', 'ABdev_aeron'),
			'type' => 'color',
			'default' => '#F7464A',
		),
		'highlight' => array(
			'description' => esc_html__('Highlight', 'ABdev_aeron'),
			'type' => 'color',
			'default' => '#FF5A5E',
		),
		'label' => array(
			'description' => esc_html__('Label', 'ABdev_aeron'),
			'type' => 'color',
			'default' => 'Red',
		),
	),
);

function tcvpb_chart_polars_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('chart_polars_tc'), $attributes));
	$polar_attr = '
		value: '.esc_attr($value).',
		color : "'.esc_attr($color).'",
		highlight : "'.esc_attr($highlight).'",
		label : "'.esc_attr($label).'",
	';

	$return = '{'.$polar_attr.'},';
  
	return $return;
}

function tcvpb_enqueue_chart_polar_script() {
	global $post;
	if( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'chart_polar_tc') ) {
		wp_enqueue_script('chart', TCVPB_DIR.'js/chart.js', array('jquery'), TCVPB_VERSION, true);
	}
}
add_action( 'wp_enqueue_scripts', 'tcvpb_enqueue_chart_polar_script' );