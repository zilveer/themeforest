<?php
if (!function_exists( 'themo_ot_default_setup')) {
	
	function themo_ot_default_setup() { // IMPORT DEFAULTS FUNCTION
		
		$themo_ot_set_defaults = get_option( 'themo_ot_set_defaults', 0 );
		
			if ($themo_ot_set_defaults == 0){ // IF ACTIVATION HAS NOT BE RUN BEFORE
				
				$your_default_settings = THEMEO_OT_DEFAULTS; // CONSTANT SET IN CONFIG.PHP
				 
				/* check and verify import theme options data nonce */
				if ( isset( $your_default_settings ) ) {
						
				  /* textarea value */
				  $options = isset( $your_default_settings ) ? unserialize( ot_decode( $your_default_settings ) ) : '';
				  
				  /* get settings array */
				  $settings = get_option( 'option_tree_settings' );
				  
				  /* has options */
				  if ( is_array( $options ) ) {
					
					/* validate options */
					if ( is_array( $settings ) ) {
					
					  foreach( $settings['settings'] as $setting ) {
					  
						if (isset($setting['id']) &&  isset( $options[$setting['id']] ) ) {
						  
						  $content = ot_stripslashes( $options[$setting['id']] );
						  
						  $options[$setting['id']] = ot_validate_setting( $content, $setting['type'], $setting['id'] );
						  
						}
					  
					  }
					
					}
					
					/* execute the action hook and pass the theme options to it */
					do_action( 'ot_before_theme_options_save', $options );
				  
					/* update the option tree array */
					update_option( 'option_tree', $options );
							
				  }
						
				}
				update_option( 'themo_ot_set_defaults', 1 );
			} // END IF ACTIVATION 
		return false;
		} // END IMPORT DEFAULTS FUNCTION
add_action( 'after_switch_theme', 'themo_ot_default_setup', 3 );  
}