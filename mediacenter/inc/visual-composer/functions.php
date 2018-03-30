<?php
/**
 * Setup Visual Composer for mediacenter
 * 
 * @return void
 */
if( ! function_exists( 'mc_setup_visual_composer' ) ) {
	function mc_setup_visual_composer() {
		// Setup Visual Composer as part of theme
		if( function_exists( 'vc_set_as_theme' ) ) {
			vc_set_as_theme( true );
		}

		// Disable frontend editor
		vc_disable_frontend();
	}
}

/**
 * Remove VC teaser
 * 
 * @return void
 */
if( ! function_exists( 'mc_remove_vc_teaser' ) ) {
	function mc_remove_vc_teaser() {
		remove_meta_box( 'vc_teaser', '' , 'side' );
	}
}

/**
 * Set additional VC params for mediacenter
 *
 * @return void
 */
if( ! function_exists( 'mc_add_vc_params' ) ) {
	function mc_add_vc_params() {
		if ( function_exists( 'vc_add_param' ) ) {

			// Add parameters to 'vc_row'
			$base = 'vc_row';
			$extraParams = array(
				array(
					'type' 			=> 'dropdown',
					'heading'		=> __( 'CSS3 Animation', 'mediacenter' ),
					'param_name'	=> 'row_animation',
					'value'			=> array(
						__( 'No Animation', 'mediacenter' ) 			=> 	'',
			        	__( 'BounceIn', 'mediacenter' ) 				=> 	'bounceIn',
			        	__( 'BounceInDown', 'mediacenter' ) 			=> 	'bounceInDown',
			        	__( 'BounceInLeft', 'mediacenter' ) 			=> 	'bounceInLeft',
			        	__( 'BounceInRight', 'mediacenter' ) 			=> 	'bounceInRight',
			        	__( 'BounceInUp', 'mediacenter' ) 				=> 	'bounceInUp',
						__( 'FadeIn', 'mediacenter' ) 					=> 	'fadeIn',
						__( 'FadeInDown', 'mediacenter' ) 				=> 	'fadeInDown',
						__( 'FadeInDown Big', 'mediacenter' ) 			=> 	'fadeInDownBig',
						__( 'FadeInLeft', 'mediacenter' ) 				=> 	'fadeInLeft',
						__( 'FadeInLeft Big', 'mediacenter' ) 			=> 	'fadeInLeftBig',
						__( 'FadeInRight', 'mediacenter' ) 			=> 	'fadeInRight',
						__( 'FadeInRight Big', 'mediacenter' ) 		=> 	'fadeInRightBig',
						__( 'FadeInUp', 'mediacenter' ) 				=> 	'fadeInUp',
						__( 'FadeInUp Big', 'mediacenter' ) 			=> 	'fadeInUpBig',
						__( 'FlipInX', 'mediacenter' ) 				=> 	'flipInX',
						__( 'FlipInY', 'mediacenter' ) 				=> 	'flipInY',
						__( 'Light SpeedIn', 'mediacenter' ) 			=> 	'lightSpeedIn',
						__( 'RotateIn', 'mediacenter' ) 				=> 	'rotateIn',
						__( 'RotateInDown Left', 'mediacenter' ) 		=> 	'rotateInDownLeft',
						__( 'RotateInDown Right', 'mediacenter' ) 		=> 	'rotateInDownRight',
						__( 'RotateInUp Left', 'mediacenter' ) 		=> 	'rotateInUpLeft',
						__( 'RotateInUp Right', 'mediacenter' ) 		=> 	'rotateInUpRight',
						__( 'RoleIn', 'mediacenter' ) 					=> 	'roleIn',
			        	__( 'ZoomIn', 'mediacenter' ) 					=> 	'zoomIn',
						__( 'ZoomInDown', 'mediacenter' ) 				=> 	'zoomInDown',
						__( 'ZoomInLeft', 'mediacenter' ) 				=> 	'zoomInLeft',
						__( 'ZoomInRight', 'mediacenter' ) 			=> 	'zoomInRight',
						__( 'ZoomInUp', 'mediacenter' ) 				=> 	'zoomInUp',
					),
					'description'	=> __( 'Choose the animation effect on the row when scrolled into view.', 'mediacenter' ),
				),
			);
			
			foreach ($extraParams as $params) {
				vc_add_param( $base, $params );
			}

			// Update 'vc_row' to include custom shortcode template and re-map shortcode
			vc_map_update( 'vc_row');
		}
	}
}

if( ! function_exists( 'mc_apply_custom_css' ) ) {
	/**
	 * Applies CSS animation class to vc_row element
	 */
	function mc_apply_custom_css( $css_classes, $base, $atts ) {
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