<?php
add_shortcode( 'vcm_mental_pie_chart', 'vcm_mental_pie_chart_shortcode' );
function vcm_mental_pie_chart_shortcode( $atts, $content = null ) {
	if ( $skin_preset = get_mental_option( 'skin_preset' ) ) {
		$preset = Azl_Settings_Machine::instance()->get_skin( $skin_preset );;
		$color = get_mental_option( 'color_primary', isset( $preset['color_primary'] ) ? $preset['color_primary'] : '' );
	}

	$atts = shortcode_atts( array(
		'title' => '',
		'value' => 50,
		'color' => empty( $color ) ? '#76d898' : $color,
	), $atts, 'vcm_mental_pie_chart' );

	ob_start();
	?>

	<div class="text-center">
		<input class="knob animate" data-width="170" data-min="0" data-max="100" data-percents="true" data-readOnly=true
		       data-fgColor="<?php echo esc_attr( $atts['color'] ); ?>" data-thickness=".15"
		       value="<?php echo esc_attr( $atts['value'] ); ?>">
		<span class="pie-label"><?php echo esc_html( $atts['title'] ); ?></span>
	</div>

	<?php
	return ob_get_clean();
}

vc_map( array(
	'icon'            => 'vcm-mental-pie-chart',
	'name'            => __( 'Mentas Pie Chart', 'mental' ),
	"base"            => "vcm_mental_pie_chart", // bind with our shortcode
	"content_element" => true, // set this parameter when element will has a content
	//"is_container" => true, // set this param when you need to add a content element in this element
	"category"        => __( 'Mentas Elements' ),
	// Here starts the definition of array with parameters of our compnent
	"params"          => array(
		array(
			'type'       => 'textfield',
			'param_name' => 'title',
			'heading'    => __( 'Title', 'mental' )
		),
		array(
			'type'       => 'textfield',
			'param_name' => 'value',
			'heading'    => __( 'Value %', 'mental' )
		),
		array(
			'type'       => 'colorpicker',
			'param_name' => 'color',
			'heading'    => __( 'Color', 'mental' )
		),
	)
) );