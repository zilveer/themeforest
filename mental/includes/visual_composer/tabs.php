<?php
add_shortcode( 'vcm_mental_tabs', 'vcm_mental_tabs_shortcode' );
function vcm_mental_tabs_shortcode( $atts, $content = null ) {
	if ( isset( $GLOBALS['tabs_count'] ) ) {
		$GLOBALS['tabs_count'] ++;
	} else {
		$GLOBALS['tabs_count'] = 0;
	}
	$GLOBALS['tab_count']          = 0;
	$GLOBALS['tabs_default_count'] = 0;

	$atts_map = mental_attribute_map( $content );

	// Extract the tab titles for use in the tab widget.
	if ( $atts_map ) {

		$tabs = array();

		// Get active
		$GLOBALS['tabs_default_active'] = true;
		foreach ( $atts_map as $check ) {
			if ( ! empty( $check["vcm_mental_tab"]["active"] ) ) {
				$GLOBALS['tabs_default_active'] = false;
			}
		}

		// Generate nav-tabs
		$i = 0;
		foreach ( $atts_map as $tab ) {
			$nav_tab_class = ( ! empty( $tab["vcm_mental_tab"]["active"] ) || ( $GLOBALS['tabs_default_active'] && $i == 0 ) ) ? 'active' : '';
			if ( isset( $tab["vcm_mental_tab"]['highlight'] ) ) {
				$nav_tab_class .= ' highlight';
			}

			$tabs[] = sprintf(
				'<li class="%s"><a href="#%s" data-toggle="tab">%s</a></li>',
				$nav_tab_class,
				'custom-tab-' . $GLOBALS['tabs_count'] . '-' . $i,
				$tab["vcm_mental_tab"]["title"]
			);
			$i ++;
		}

	}

	return sprintf(
		'<ul class="nav nav-tabs">%s</ul><div class="tab-content">%s</div>',
		( $tabs ) ? implode( $tabs ) : '',
		do_shortcode( $content )
	);

}

/* ========================================================================= *\
   Tab
\* ========================================================================= */

add_shortcode( 'vcm_mental_tab', 'vcm_mental_tab_shortcode' );
function vcm_mental_tab_shortcode( $atts, $content = null ) {
	$atts = shortcode_atts( array(
		'title'     => '',
		'active'    => 'no',
		'highlight' => 'no',
	), $atts, 'vcm_mental_tab' );

	if ( $GLOBALS['tabs_default_active'] && $GLOBALS['tabs_default_count'] == 0 ) {
		$atts['active'] = true;
	}
	$GLOBALS['tabs_default_count'] ++;

	$class = 'tab-pane';
	$class .= ( $atts['active'] == 'yes' ) ? ' in active' : '';
	if ( isset( $atts['highlight'] ) && $atts['highlight'] == 'yes' ) {
		$class .= ' highlight';
	}
	$id = 'custom-tab-' . $GLOBALS['tabs_count'] . '-' . $GLOBALS['tab_count'];

	$GLOBALS['tab_count'] ++;

	return sprintf(
		'<div id="%s" class="%s">%s</div>',
		esc_attr( $id ),
		esc_attr( $class ),
		do_shortcode( $content )
	);
}

vc_map( array(
	'icon'            => 'vcm-mental-tabs',
	'name'                    => __( 'Mentas Tabs', 'mental' ),
	"base"                    => "vcm_mental_tabs", // bind with our shortcode
	"show_settings_on_create" => false,
	"as_parent"               => array( 'only' => 'vcm_mental_tab' ),
	"content_element"         => true, // set this parameter when element will has a content
	//"is_container" => true, // set this param when you need to add a content element in this element
	"category"                => __( 'Mentas Elements' ),
	// Here starts the definition of array with parameters of our compnent
	"params"                  => array(),
	"js_view"                 => 'VcColumnView'
) );

vc_map( array(
	'icon'            => 'vcm-mental-tabs-item',
	'name'            => __( 'Mentas Tab', 'mental' ),
	"base"            => "vcm_mental_tab", // bind with our shortcode
	"as_child"        => array( 'only' => 'vcm_mental_tabs' ),
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
			'param_name' => 'id',
			'heading'    => __( 'ID', 'mental' )
		),
		array(
			'type'       => 'dropdown',
			'param_name' => 'active',
			'heading'    => __( 'Active', 'mental' ),
			'value'      => array(
				__( 'No', 'mental' )  => 'no',
				__( 'Yes', 'mental' ) => 'yes',
			)
		),
		array(
			'type'       => 'dropdown',
			'param_name' => 'highlight',
			'heading'    => __( 'Highlight', 'mental' ),
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
	"js_view"         => 'VcColumnView'
) );

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Vcm_Mental_Tabs extends WPBakeryShortCodesContainer {
	}

	class WPBakeryShortCode_Vcm_Mental_Tab extends WPBakeryShortCodesContainer {
	}
}
