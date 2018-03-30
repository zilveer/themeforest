<?php
add_shortcode( 'vcm_mental_accordion', 'vcm_mental_accordion_shortcode' );
function vcm_mental_accordion_shortcode( $atts, $content = null ) {
	$atts = shortcode_atts( array(
		'id' => 'accordion',
	), $atts, 'vcm_mental_accordion' );

	ob_start();
	?>

	<div id="<?php echo esc_attr( $atts['id'] ); ?>">
		<?php echo do_shortcode( $content ) ?>
	</div>

	<?php
	return ob_get_clean();
}

/* ========================================================================= *\
   Accordion Panel
\* ========================================================================= */

add_shortcode( 'vcm_mental_accordion_panel', 'vcm_mental_accordion_panel_shortcode' );
function vcm_mental_accordion_panel_shortcode( $atts, $content = null ) {
	$atts = shortcode_atts( array(
		'title'     => '',
		'parent_id' => 'accordion',
		'opened'    => 'no',
	), $atts, 'vcm_mental_accordion_panel' );

	$collapse_id = 'collapse' . rand( 0, 9999 );

	ob_start();
	?>

	<div class="accordion-group panel">
		<a class="accordion-header" data-toggle="collapse" data-parent="#<?php echo esc_attr( $atts['parent_id'] ) ?>" href="#<?php echo esc_attr( $collapse_id ); ?>">
			<?php echo esc_html( $atts['title'] ); ?>
		</a>

		<div id="<?php echo esc_attr( $collapse_id ); ?>" class="collapse <?php echo ( $atts['opened'] == 'yes' ) ? 'in' : '' ?>">
			<div class="accordion-body">
				<?php echo wpautop( do_shortcode( $content ) ) ?>
			</div>
		</div>
	</div>

	<?php
	return ob_get_clean();
}

vc_map( array(
	'icon'                    => 'vcm-mental-accordion',
	'name'                    => __( 'Mentas Accordion', 'mental' ),
	"base"                    => "vcm_mental_accordion", // bind with our shortcode
	"show_settings_on_create" => false,
	"as_parent"               => array( 'only' => 'vcm_mental_accordion_panel' ),
	"content_element"         => true, // set this parameter when element will has a content
	//"is_container" => true, // set this param when you need to add a content element in this element
	"category"                => __( 'Mentas Elements' ),
	// Here starts the definition of array with parameters of our compnent
	"params"                  => array(
		array(
			'type'       => 'textfield',
			'param_name' => 'id',
			'heading'    => __( 'ID', 'mental' ),
			'value'      => 'accordion'
		),
	),
	"js_view"                 => 'VcColumnView'
) );

vc_map( array(
	'icon'                    => 'vcm-mental-accordion-panel',
	'name'                    => __( 'Mentas Accordion Panel', 'mental' ),
	"base"                    => "vcm_mental_accordion_panel", // bind with our shortcode
	"show_settings_on_create" => false,
	"as_child"                => array( 'only' => 'vcm_mental_accordion' ),
	"content_element"         => true, // set this parameter when element will has a content
	"is_container"            => true, // set this param when you need to add a content element in this element
	"category"                => __( 'Mentas Elements' ),
	// Here starts the definition of array with parameters of our compnent
	"params"                  => array(
		array(
			'type'       => 'textfield',
			'param_name' => 'title',
			'heading'    => __( 'Title', 'mental' )
		),
		array(
			'type'       => 'textfield',
			'param_name' => 'parent_id',
			'heading'    => __( 'Parent ID', 'mental' ),
			'value'      => 'accordion'
		),
		array(
			'type'       => 'dropdown',
			'param_name' => 'opened',
			'heading'    => __( 'Opened on start', 'mental' ),
			'value'      => array(
				__( 'No', 'mental' )  => 'no',
				__( 'Yes', 'mental' ) => 'yes',
			)
		),
		array(
			'type'       => 'textarea_html',
			'param_name' => 'content'
		)
	),
	"js_view"                 => 'VcColumnView'
) );

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Vcm_Mental_Accordion extends WPBakeryShortCodesContainer {
	}

	class WPBakeryShortCode_Vcm_Mental_Accordion_Panel extends WPBakeryShortCodesContainer {
	}
}