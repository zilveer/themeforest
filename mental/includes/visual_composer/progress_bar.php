<?php
add_shortcode( 'vcm_mental_progress_bar', 'vcm_mental_progress_bar_shortcode' );
function vcm_mental_progress_bar_shortcode( $atts, $content = null ) {
	$atts = shortcode_atts( array(
		'title' => '',
		'value' => '',
	), $atts, 'vcm_mental_progress_bar' );

	ob_start();
	?>

	<div class="progress-bar-block">
		<label><?php echo esc_html( $atts['title'] ); ?></label>

		<div class="value"><?php echo esc_html( $atts['value'] ); ?>%</div>
		<div class="progress">
			<div class="progress-bar animate" role="progressbar" aria-valuenow="<?php echo (int) $atts['value'] ?>"
			     aria-valuemin="0" aria-valuemax="100" style="width: <?php echo (int) $atts['value'] ?>%;">
			</div>
		</div>
	</div>

	<?php
	return ob_get_clean();
}

vc_map( array(
	'icon'            => 'vcm-mental-progress-bar',
	'name'            => __( 'Mentas Progress Bar', 'mental' ),
	"base"            => "vcm_mental_progress_bar", // bind with our shortcode
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
	)
) );