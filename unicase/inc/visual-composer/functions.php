<?php

if( ! function_exists( 'unicase_setup_visual_composer' ) ) {
	/**
	 * Setup Visual Composer for unicase
	 * 
	 * @return void
	 */
	function unicase_setup_visual_composer() {
		// Setup Visual Composer as part of theme
		if( function_exists( 'vc_set_as_theme' ) ) {
			vc_set_as_theme( true );
		}
	}
}

if( ! function_exists( 'add_unicase_vc_params' ) ) {
	/**
	 * Modified or added options for Visual Composer default elements
	 *
	 * @since 1.0.0
	 */
	function add_unicase_vc_params() {

		$extra_params = array(
			array(
				'base' 		=>  'vc_row',
				'args' 		=> array(
					array(
						'type' 			=> 'dropdown',
						'heading'		=> esc_html__( 'CSS3 Animation', 'unicase' ),
						'param_name'	=> 'row_animation',
						'description'	=> esc_html__( 'Choose the animation effect on the row when scrolled into view.', 'unicase' ),
						'value'			=> array(
							esc_html__( 'No Animation', 'unicase' ) 			=> 	'none',
				        	esc_html__( 'BounceIn', 'unicase' ) 				=> 	'bounceIn',
				        	esc_html__( 'BounceInDown', 'unicase' ) 			=> 	'bounceInDown',
				        	esc_html__( 'BounceInLeft', 'unicase' ) 			=> 	'bounceInLeft',
				        	esc_html__( 'BounceInRight', 'unicase' ) 			=> 	'bounceInRight',
				        	esc_html__( 'BounceInUp', 'unicase' ) 				=> 	'bounceInUp',
							esc_html__( 'FadeIn', 'unicase' ) 					=> 	'fadeIn',
							esc_html__( 'FadeInDown', 'unicase' ) 				=> 	'fadeInDown',
							esc_html__( 'FadeInDown Big', 'unicase' ) 			=> 	'fadeInDownBig',
							esc_html__( 'FadeInLeft', 'unicase' ) 				=> 	'fadeInLeft',
							esc_html__( 'FadeInLeft Big', 'unicase' ) 			=> 	'fadeInLeftBig',
							esc_html__( 'FadeInRight', 'unicase' ) 			=> 	'fadeInRight',
							esc_html__( 'FadeInRight Big', 'unicase' ) 		=> 	'fadeInRightBig',
							esc_html__( 'FadeInUp', 'unicase' ) 				=> 	'fadeInUp',
							esc_html__( 'FadeInUp Big', 'unicase' ) 			=> 	'fadeInUpBig',
							esc_html__( 'FlipInX', 'unicase' ) 				=> 	'flipInX',
							esc_html__( 'FlipInY', 'unicase' ) 				=> 	'flipInY',
							esc_html__( 'Light SpeedIn', 'unicase' ) 			=> 	'lightSpeedIn',
							esc_html__( 'RotateIn', 'unicase' ) 				=> 	'rotateIn',
							esc_html__( 'RotateInDown Left', 'unicase' ) 		=> 	'rotateInDownLeft',
							esc_html__( 'RotateInDown Right', 'unicase' ) 		=> 	'rotateInDownRight',
							esc_html__( 'RotateInUp Left', 'unicase' ) 		=> 	'rotateInUpLeft',
							esc_html__( 'RotateInUp Right', 'unicase' ) 		=> 	'rotateInUpRight',
							esc_html__( 'RoleIn', 'unicase' ) 					=> 	'roleIn',
				        	esc_html__( 'ZoomIn', 'unicase' ) 					=> 	'zoomIn',
							esc_html__( 'ZoomInDown', 'unicase' ) 				=> 	'zoomInDown',
							esc_html__( 'ZoomInLeft', 'unicase' ) 				=> 	'zoomInLeft',
							esc_html__( 'ZoomInRight', 'unicase' ) 			=> 	'zoomInRight',
							esc_html__( 'ZoomInUp', 'unicase' ) 				=> 	'zoomInUp',
						),
					),
				),
			),
			array(
				'base' 		=>  'vc_wp_custommenu',
				'args' 		=> array(
					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__( 'Icon Class', 'unicase' ),
						'param_name'	=> 'icon_class',
						'description'	=> esc_html__( 'Icon Class of Menu Title', 'unicase' )
					),
					array(
						'type' 			=> 'dropdown',
						'heading'		=> esc_html__( 'Choose Type', 'unicase' ),
						'param_name'	=> 'display_type',
						'description'	=> esc_html__( 'Choose the display type of widget.', 'unicase' ),
						'value'			=> array(
							esc_html__( 'Choose Type', 'unicase' ) 			=> 	'',
							esc_html__( 'Type 1', 'unicase' ) 				=> 	'type-1',
							esc_html__( 'Type 2', 'unicase' ) 				=> 	'type-2',
						),
					),
				),
			)
		);
		
		foreach( $extra_params as $param ) {

			$base = $param['base'];
			$args = $param['args'];

			foreach( $args as $arg ) {
				vc_add_param( $base, $arg );	
			}

			vc_map_update( $base );	
		}
	}
}

if( ! function_exists( 'unicase_apply_custom_css' ) ) {
	function unicase_apply_custom_css( $css_classes, $base, $atts ) {
		if( $base == 'vc_row' ) {
			extract( shortcode_atts( array(
				'row_animation'		=> '',
			), $atts ) );

			if( ! empty( $row_animation ) && $row_animation != 'none' ) {
				$css_classes .= ' wow ' . $row_animation;
			}
		}

		return $css_classes;
	}
}