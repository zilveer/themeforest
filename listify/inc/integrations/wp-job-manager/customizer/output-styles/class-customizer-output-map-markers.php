<?php
/**
 * Output map markers
 *
 * @since 1.0.0
 * @package Customizer
 */
class 
	Listify_Customizer_OutputCSS_MapMarkers
extends
	Listify_Customizer_OutputCSS {

	public function __construct() {
		parent::__construct();
	}

	/**
	 * Add items to the CSS object that will be built and output.
	 *
	 * @since 1.5.0
	 * @return void
	 */
    public function output() {
		if ( ! listify_has_integration( 'wp-job-manager' ) ) {
			return;
		}

		$default = get_theme_mod( 'default-marker-color', '#555555' );

		Listify_Customizer_CSS::add( array(
			'selectors' => array( '.map-marker:after' ),
			'declarations' => array(
				'border-top-color' => esc_attr( $default )
			)
		) );

		Listify_Customizer_CSS::add( array(
			'selectors' => array( '.map-marker i:after' ),
			'declarations' => array(
				'background-color' => esc_attr( $default )
			)
		) );

		Listify_Customizer_CSS::add( array(
			'selectors' => array( '.map-marker i:before' ),
			'declarations' => array(
				'color' => esc_attr( $default )
			)
		) );

		$mods = Listify_Customizer_Utils::get_regex_theme_mods( 'marker-color-' );

        foreach ( $mods as $mod => $value ) {
			if ( '' == $value || '#555555' == $value ) {
				continue;
			}

			Listify_Customizer_CSS::add( array(
				'selectors' => array( '.map-marker.' . $mod . ':after' ),
				'declarations' => array(
					'border-top-color' => esc_attr( $value )
				)
			) );

			Listify_Customizer_CSS::add( array(
				'selectors' => array( '.map-marker.' . $mod . ' i:after' ),
				'declarations' => array(
					'background-color' => esc_attr( $value )
				)
			) );

			Listify_Customizer_CSS::add( array(
				'selectors' => array( '.map-marker.' . $mod . ' i:before' ),
				'declarations' => array(
					'color' => esc_attr( $value )
				)
			) );
		}
	}

}

new Listify_Customizer_OutputCSS_MapMarkers();
