<?php

/*********** Shortcode: Chart Pie ************************************************************/

$tcvpb_elements['chart_pie_tc'] = array(
	'name' => esc_html__('Chart Pie', 'ABdev_aeron' ),
	'type' => 'block',
	'icon' => 'pi-chart',
	'category' =>  esc_html__('Charts', 'ABdev_aeron'),
	'child' => 'chart_pies_tc',
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

function tcvpb_chart_pie_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('chart_pie_tc'), $attributes));
	static $i = 0;
	$i++;

	$id_out = ($id!='') ? 'id='.$id.'' : '';
	$class_out = ($class!='') ? 'class='.$class.'' : '';

	return '<div '.esc_attr($id_out).' '.esc_attr($class_out).' style=" width:'.esc_attr($width).'; ">
				<canvas id="pie_canvas'.$i.'" style="width: 100%; height: 100%;"></canvas>
			</div>

		<script>
			var pieData'.$i.' = [
				'.do_shortcode($content).'
			];

			window.addEventListener("load",function(event) {
				var ctx'.$i.' = document.getElementById("pie_canvas'.$i.'").getContext("2d");
				window.myPie = new Chart(ctx'.$i.').Pie(pieData'.$i.');
			},false);

		</script>';
	
}

$tcvpb_elements['chart_pies_tc'] = array(
	'name' => esc_html__('Line Section', 'ABdev_aeron' ),
	'type' => 'child',
	'attributes' => array(
		'value' => array(
			'default' => '300',
			'description' => esc_html__('Value', 'ABdev_aeron'),
		),
		'color' => array(
			'description' => esc_html__('Color', 'ABdev_aeron'),
			'type' => 'coloralpha',
			'default' => '#F7464A',
		),
		'highlight' => array(
			'description' => esc_html__('Highlight', 'ABdev_aeron'),
			'type' => 'coloralpha',
			'default' => '#FF5A5E',
		),
		'label' => array(
			'description' => esc_html__('Label', 'ABdev_aeron'),
			'type' => 'text',
		),
	),
);

function tcvpb_chart_pies_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('chart_pies_tc'), $attributes));
	$pie_attr = '
		value: '.esc_attr($value).',
		color : "'.esc_attr($color).'",
		highlight : "'.esc_attr($highlight).'",
		label : "'.esc_attr($label).'",
	';

	$return = '{'.$pie_attr.'},';
  
	return $return;
}

function tcvpb_enqueue_chart_pie_script() {
	global $post;
	if( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'chart_pie_tc') ) {
		wp_enqueue_script('chart', TCVPB_DIR.'js/chart.js', array('jquery'), TCVPB_VERSION, true);
	}
}
add_action( 'wp_enqueue_scripts', 'tcvpb_enqueue_chart_pie_script' );