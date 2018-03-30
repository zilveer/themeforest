<?php

/*
|--------------------------------------------------------------------------
| Enhance Theme Customizer
|--------------------------------------------------------------------------
*/

if( !function_exists('unitedthemes_customize_register') ) {

	function unitedthemes_customize_register( $wp_customize ) {
		
		
		/*
		|--------------------------------------------------------------------------
		| Custom Color Picker with individual color palette
		|--------------------------------------------------------------------------
		*/
		if ( !class_exists('UT_Colorpicker_Extended') ) {
			
			class UT_Colorpicker_Extended extends WP_Customize_Control {
				
				public $type = 'colorpicker_extended';
				
				public function enqueue() {
					wp_enqueue_script( 'wp-color-picker' );
					wp_enqueue_style( 'wp-color-picker' );
				}
				
				public function render_content() {		
				
					$this_default = $this->setting->default;
					$default_attr = '';
									
					if ( $this_default ) {
						if ( false === strpos( $this_default, '#' ) )
							$this_default = '#' . $this_default;
						$default_attr = ' data-default-color="' . esc_attr( $this_default ) . '"';
					}
					
					?>
					
					<script type="text/javascript">
					/* <![CDATA[ */
					(function($){
							
						"use strict";
						
						$(document).ready(function(){
							
							$('#<?php echo strtolower($this->label); ?>').wpColorPicker({
	
								palettes: ['#9b59b6' , '#3498db' , '#FF6E00', '#7f8c8d' , '#2ecc71' , '#2c3e50' , '#d35400' , '#c0392b' , '#1abc9c' , '#f1c40f'],
								change: function(event, ui){
									
									$('#<?php echo strtolower($this->label); ?>').attr('value', ui.color.toString() );
									$(this).trigger( "keyup" );								
									
								}
								
							});
							
						});
	
					})(jQuery);
					/* ]]> */	
					</script>
									
					<label>
						<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
						<div class="customize-control-content">
							<input id="<?php echo esc_html( strtolower($this->label) ); ?>" class="color-picker-hex" type="text" maxlength="7" value="<?php echo esc_html( $this->value() ); ?>" placeholder="<?php esc_attr_e( 'Hex Value' , 'unitedthemes' ); ?>" <?php echo $default_attr; ?> <?php $this->link(); ?> />
						</div>
					</label>
		
					<?php
				
				}
				
			}
		
		}
		
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
		
		
		/* disable some of the default wordpress settings */	
		$wp_customize->remove_control('blogdescription');
		$wp_customize->remove_control('header_textcolor');
		
		
		
		/*
		|--------------------------------------------------------------------------
		| Custom Logo
		|--------------------------------------------------------------------------
		*/
				
		/* add section for custom logo  */ 	
		$wp_customize->add_section( 'ut_logo_section' , array(
			'title'       => __( 'Logo', 'unitedthemes' ),
			'priority'    => 30,
			'description' => __( 'Upload a logo to replace the default site name and description in the header' , 'unitedthemes' )
		) );
				
		/* add setting for custom logo */ 
		$wp_customize->add_setting('ut_site_logo');
		$wp_customize->add_setting('ut_site_logo_alt');
        $wp_customize->add_setting('ut_site_logo_retina');
		$wp_customize->add_setting('ut_site_logo_alt_retina');		
		
		/* add control for custom logo */ 
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ut_site_logo', array(
			'label'    => __( 'Main Logo', 'unitedthemes' ),
			'section'  => 'ut_logo_section',
			'settings' => 'ut_site_logo',
		) ) );
		
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ut_site_logo_alt', array(
			'label'    => __( 'Alternate Logo', 'unitedthemes' ),
			'section'  => 'ut_logo_section',
			'settings' => 'ut_site_logo_alt',
		) ) );
		
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ut_site_logo_retina', array(
			'label'    => __( 'Retina Main Logo', 'unitedthemes' ),
			'section'  => 'ut_logo_section',
			'settings' => 'ut_site_logo_retina',
		) ) );
		
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ut_site_logo_alt_retina', array(
			'label'    => __( 'Retina Alternate Logo', 'unitedthemes' ),
			'section'  => 'ut_logo_section',
			'settings' => 'ut_site_logo_alt_retina',
		) ) );
        
		
		/*
		|--------------------------------------------------------------------------
		| Custom Accentcolor
		|--------------------------------------------------------------------------
		*/
				
		/* add section for color management  */ 	
		$wp_customize->add_section( 'ut_color_section' , array(
			'title'       => __( 'Color', 'unitedthemes' ),
			'priority'    => 30,
			'description' => __( 'Define your desired accent color. Inside the colorpicker itself, you can find some nice pre defined colors!' , 'unitedthemes' )
		) );
		
		/* add setting for accentcolor */ 
		$wp_customize->add_setting( 'ut_accentcolor' , array( 'default' => '#F1C40F' , 'type' => 'option', 'capability' => 'edit_theme_options') );
		
		/* add control for accentcolor */ 
		$wp_customize->add_control( new UT_Colorpicker_Extended( $wp_customize, 'ut_accentcolor', array(
			'label'   	=> 'Accentcolor',
			'section' 	=> 'ut_color_section',
			'settings'  => 'ut_accentcolor',
		) ) );
		
		
		
	}
	
	add_action( 'customize_register', 'unitedthemes_customize_register' );

}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
if( !function_exists('unitedthemes_customize_preview_js') ) {
	
	function unitedthemes_customize_preview_js() {
		wp_enqueue_script( 'unitedthemes_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
	}

	add_action( 'customize_preview_init', 'unitedthemes_customize_preview_js' );
	
}