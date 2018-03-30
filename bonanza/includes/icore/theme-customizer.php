<?php

/**
 * WP 3.4 Theme Customizer
 */

add_action( 'customize_register', 'theme_customize_register' );

function theme_customize_register( $wp_customize ) {	

	// extending the field type to textarea
	class theme_custom_css extends WP_Customize_Control {
		public $type = 'customarea';

		public function render_content() {
			$theme_options = get_option( 'bonanza_options' );
			$stored = "";
			if( isset( $theme_options['custom_css'] ) ) { $stored = $theme_options['custom_css']; }
			echo '<textarea style="width:100%;height:200px;">' . $stored . '</textarea>';
		}
		public function enqueue() {
			wp_enqueue_script( 'customarea', get_template_directory_uri() . '/icore/js/customizer.js', array( 'customize-controls' ), '20120607', true );
		}
	}

	// get our theme options so we can use defaults below
	$theme_options = get_option( 'bonanza_options' );

	// enables live change support
	$wp_customize->get_setting('blogname')->transport='postMessage';
	$wp_customize->get_setting('blogdescription')->transport='postMessage';
	$wp_customize->get_setting('header_textcolor')->transport='postMessage';

	// add a setting to an existing theme option
	$wp_customize->add_setting( 'bonanza_options[logo]', array(
		'default'        => $theme_options['logo'],
		'type'           => 'option',
		'capability'     => 'edit_theme_options',
		//'transport'      => 'postMessage'
	) );

	// intercept the theme option and control it
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo', array(
		'label'      => __( 'Upload Logo', 'Bonanza' ),
		'section'    => 'title_tagline',
		'settings'   => 'bonanza_options[logo]'
	) ) );

	
	// add a setting to an existing theme option
	$wp_customize->add_setting( 'bonanza_options[primary_color]', array(
		'default'        => '',
		'type'           => 'option',
		'capability'     => 'edit_theme_options',
		//'transport'      => 'postMessage'
	) );

	// intercept the theme option and control it
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bonanza_primary_color_customizer', array(
		'settings'		=> 'bonanza_options[primary_color]',
		'label'			=> __( 'Select header and footer background color', 'Bonanza' ),
		'section'		=> 'colors'
	) ) );
	
	
	
	// add a setting to an existing theme option
	$wp_customize->add_setting( 'bonanza_options[header_link_color]', array(
		'default'        => '',
		'type'           => 'option',
		'capability'     => 'edit_theme_options',
		//'transport'      => 'postMessage'
	) );

	// intercept the theme option and control it
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bonanza_header_link_color_customizer', array(
		'settings'		=> 'bonanza_options[header_link_color]',
		'label'			=> __( 'Select header and footer link color', 'Bonanza' ),
		'section'		=> 'colors'
	) ) );
	
	// add a setting to an existing theme option
	$wp_customize->add_setting( 'bonanza_options[header_text_color]', array(
		'default'        => '',
		'type'           => 'option',
		'capability'     => 'edit_theme_options',
		//'transport'      => 'postMessage'
	) );

	// intercept the theme option and control it
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bonanza_header_text_color_customizer', array(
		'settings'		=> 'bonanza_options[header_text_color]',
		'label'			=> __( 'Select header and footer text color', 'Bonanza' ),
		'section'		=> 'colors'
	) ) );
	
	
	
	
	// add a setting to an existing theme option
	$wp_customize->add_setting( 'bonanza_options[secondary_color]', array(
		'default'        => '',
		'type'           => 'option',
		'capability'     => 'edit_theme_options',
		//'transport'      => 'postMessage'
	) );

	// intercept the theme option and control it
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bonanza_secondary_color_customizer', array(
		'settings'		=> 'bonanza_options[secondary_color]',
		'label'			=> __( 'Select theme accent color', 'Bonanza' ),
		'section'		=> 'colors'
	) ) );
	
	// add a setting to an existing theme option
	$wp_customize->add_setting( 'bonanza_options[nav_bg_color]', array(
		'default'        => '',
		'type'           => 'option',
		'capability'     => 'edit_theme_options',
		//'transport'      => 'postMessage'
	) );

	// intercept the theme option and control it
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bonanza_nav_bg_color_customizer', array(
		'settings'		=> 'bonanza_options[nav_bg_color]',
		'label'			=> __( 'Select navigation background color', 'Bonanza' ),
		'section'		=> 'colors'
	) ) );
	
	// add a setting to an existing theme option
	$wp_customize->add_setting( 'bonanza_options[nav_color]', array(
		'default'        => '',
		'type'           => 'option',
		'capability'     => 'edit_theme_options',
		//'transport'      => 'postMessage'
	) );

	// intercept the theme option and control it
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bonanza_nav_color_customizer', array(
		'settings'		=> 'bonanza_options[nav_color]',
		'label'			=> __( 'Select navigation link color', 'Bonanza' ),
		'section'		=> 'colors'
	) ) );


	// add a setting to an existing theme option
	$wp_customize->add_setting( 'bonanza_options[nav_hover_color]', array(
		'default'        => '',
		'type'           => 'option',
		'capability'     => 'edit_theme_options',
		//'transport'      => 'postMessage'
	) );

	// intercept the theme option and control it
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bonanza_nav_hover_color_customizer', array(
		'settings'		=> 'bonanza_options[nav_hover_color]',
		'label'			=> __( 'Select navigation hover link color', 'Bonanza' ),
		'section'		=> 'colors'
	) ) );
	

	// add customizer section
	$wp_customize->add_section( 'bonanza_appearance', array(
		'title'			=> __( 'Appearance', 'Bonanza' ),
		'priority'		=> 50
	) );
	
	// add a setting to an existing theme option
		$wp_customize->add_setting( 'bonanza_options[search]', array(
			'default'        => '',
			'type'           => 'option',
			'capability'     => 'edit_theme_options',
			//'transport'      => 'postMessage'
		) );

		// intercept the theme option and control it
		$wp_customize->add_control( 'bonanza_search_customizer', array(
			'settings'		=> 'bonanza_options[search]',
			'label'			=> __( 'Display Search Bar', 'Bonanza' ),
			'section'		=> 'bonanza_appearance',
			'type'			=> 'checkbox'
		) );
		
	// add a setting to an existing theme option
	$wp_customize->add_setting( 'bonanza_options[call_to_action_enabled]', array(
		'default'        => '',
		'type'           => 'option',
		'capability'     => 'edit_theme_options',
		//'transport'      => 'postMessage'
	) );

	// intercept the theme option and control it
	$wp_customize->add_control( 'bonanza_call_to_action_enabled_customizer', array(
		'settings'		=> 'bonanza_options[call_to_action_enabled]',
		'label'			=> __( 'Display Homepage Message', 'Bonanza' ),
		'section'		=> 'bonanza_appearance',
		'type'			=> 'checkbox'
	) );
	
	// add a setting to an existing theme option
	$wp_customize->add_setting( 'bonanza_options[slider_enabled]', array(
		'default'        => '',
		'type'           => 'option',
		'capability'     => 'edit_theme_options',
		//'transport'      => 'postMessage'
	) );

	// intercept the theme option and control it
	$wp_customize->add_control( 'bonanza_slider_enabled_customizer', array(
		'settings'		=> 'bonanza_options[slider_enabled]',
		'label'			=> __( 'Display Homepage Slider', 'Bonanza' ),
		'section'		=> 'bonanza_appearance',
		'type'			=> 'checkbox'
	) );

	
	// add customizer section
	$wp_customize->add_section( 'bonanza_custom_css', array(
		'title'			=> __( 'Custom CSS', 'Bonanza' ),
		'priority'		=> 60
	) );

	// add a setting to an existing theme option
	$wp_customize->add_setting( 'bonanza_options[custom_css]', array(
		'default'        => '',
		'type'           => 'option',
		'capability'     => 'edit_theme_options',
		'transport'      => 'postMessage'
	) );

	// intercept the theme option and control it
	$wp_customize->add_control( new theme_custom_css( $wp_customize, 'custom_css', array(
		'settings'		=> 'bonanza_options[custom_css]',
		'label'			=> __( 'Custom CSS', 'Bonanza' ),
		'section'		=> 'bonanza_custom_css'
	) ) );


	/**
	 * Bind JS handlers to make Theme Customizer preview reload changes asynchronously.
	 * Used with fonts
	 *
	 * @since Bonanza 1.0
	 */
	function theme_customizer_preview_js() { ?>
		<?php
		$doc_ready_script = '
		<script type="text/javascript">
			(function($){
				$(document).ready(function() {

					wp.customize("blogname", function(value) {
						value.bind(function(to) {
							$(".logo a").html(to);
						});
					});

					wp.customize("blogdescription", function(value) {
						value.bind(function(to) {
							$("#tagline").html(to);
						});
					});

					wp.customize( "header_textcolor", function( value ) {
						value.bind( function( to ) {
							$(".site-title a, .site-description").css("color", to ? to : "" );
						});
					});
					
					
					wp.customize( "bonanza_options[secondary_color]", function( value ) {
						value.bind( function( to ) {
							$(".secondary-color").css("background-color", to ? to : "" );
						});
					});


					wp.customize("bonanza_options[logo]", function(value) {
						value.bind(function(to) {
							$(".logo a").html("<img id=\"logo\" alt=\"' . get_bloginfo( 'name' ) . '\" src=\"" + to + "\">" );
						});
					});


					wp.customize("bonanza_options[colorscheme]",function(value) {
						value.bind(function(to) {
							$("#alt-style-css").attr("href", "'. get_template_directory_uri() .'/css/"+to+".css");
						});
					});

					wp.customize("bonanza_options[custom_css]",function(value) {
						value.bind(function(to) {
							$("#tempcss").remove();
							var googlefont = to.split(",");
							$("body").append("<div id=\"tempcss\"><style type=\"text/css\">"+to+"</style></div>");
						});
					});
					
					wp.customize("bonanza_options[search]",function(value) {
						value.bind(function(to) {
							if( to == "1" )  { 
								$("#searchbar").show(); 
							} else {
								$("#searchbar").hide();
							}
						});
					});
					
			});
		})(jQuery);
		</script>';

		echo $doc_ready_script;
	}
	if ( $wp_customize->is_preview() && ! is_admin() )
		add_action( 'wp_footer', 'theme_customizer_preview_js', 21 );
}

?>