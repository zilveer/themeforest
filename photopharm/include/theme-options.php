<?php
////////////////////////////
//THEME CUSTOMIZER SETTINGS
////////////////////////////
add_action( 'customize_register', 'themolitor_customizer_register' );

function themolitor_customizer_register($wp_customize) {

	//CREATE TEXTAREA OPTION
	class Example_Customize_Textarea_Control extends WP_Customize_Control {
    	public $type = 'textarea';
 
    	public function render_content() { ?>
        	<label>
        	<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        	<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
        	</label>
        <?php }
	}
	
	//CREATE CATEGORY DROP DOWN OPTION
	$options_categories = array();  
	$options_categories_obj = get_categories();
	$options_categories[''] = 'Select a Category';
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	//-------------------------------
	//-------------------------------
	//SANITIZATION FUNCTIONS
	//-------------------------------
	//-------------------------------
	
	//TEXT -- ALL
	function themolitor_sanitize_text( $input ) {
	    return wp_kses_post($input);
	}
	
	//CHECKBOX -- ALL
	function themolitor_sanitize_checkbox( $input ) {
	    if ( $input == 1 ) {
	        return 1;
	    } else {
	        return '';
	    }
	}

	
	//-------------------------------
	//TITLE & TAGLINE SECTION
	//-------------------------------
	
	//LOGO
	$wp_customize->add_setting( 'themolitor_customizer_logo',array(
		'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themolitor_customizer_logo', array(
    	'label'    => __('Logo', 'themolitor'),
    	'section'  => 'title_tagline',
    	'settings' => 'themolitor_customizer_logo',
    	'priority' => 1
	)));
				
	//-------------------------------
	//COLORS SECTION
	//-------------------------------
	
	//LINK COLOR
	$wp_customize->add_setting( 'themolitor_customizer_link_color', array(
		'default' => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themolitor_customizer_link_color', array(
		'label'   => __( 'Link Color', 'themolitor'),
		'section' => 'colors',
		'settings'   => 'themolitor_customizer_link_color',
		'priority' => 1
	)));
	
	//THEME SKIN
	$wp_customize->add_setting( 'themolitor_customizer_theme_skin', array(
    	'default' => 0,
    	'sanitize_callback' => 'themolitor_sanitize_checkbox',
	));
	$wp_customize->add_control( 'themolitor_customizer_theme_skin', array(
    	'label' => 'Display Light Theme Skin',
    	'type' => 'checkbox',
    	'section' => 'colors',
    	'settings' => 'themolitor_customizer_theme_skin',
    	'priority' => 2
	));	
	
	//-------------------------------
	//GENERAL SECTION
	//-------------------------------
	
	//ADD GENERAL SECTION
	$wp_customize->add_section( 'themolitor_customizer_general_section', array(
		'title' => __( 'General', 'themolitor' ),
		'priority' => 198
	));
	
	//DEFAUL BACKGROUND IMAGE
   	$wp_customize->add_setting( 'themolitor_customizer_bg',array(
   		'sanitize_callback' => 'esc_url_raw',
   	));
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themolitor_customizer_bg', array(
    	'label'    => __('Default Background Image', 'themolitor'),
    	'section'  => 'themolitor_customizer_general_section',
    	'settings' => 'themolitor_customizer_bg',
    	'priority' => 2
	)));
			
	//FAVICON URL
    $wp_customize->add_setting( 'themolitor_customizer_favicon',array(
    	'sanitize_callback' => 'esc_url_raw',
    ));
	$wp_customize->add_control('themolitor_customizer_favicon', array(
   		'label'   => __( 'Favicon URL (optional)', 'themolitor'),
    	'section' => 'themolitor_customizer_general_section',
    	'settings'   => 'themolitor_customizer_favicon',
    	'type' => 'text',
    	'priority' => 3
	));
		
	//-------------------------------
	//FOOTER SECTION
	//-------------------------------

	//ADD FOOTER SECTION
	$wp_customize->add_section( 'themolitor_customizer_footer_section', array(
		'title' => __( 'Footer', 'themolitor' ),
		'priority' => 199
	));
	
	//FOOTER TEXT
    $wp_customize->add_setting( 'themolitor_customizer_footer',array(
    	'default' => 'Site by <a href="http://themolitor.com/portfolio" title="Site by THE MOLITOR">THE MOLITOR</a>',
    	'sanitize_callback' => 'themolitor_sanitize_text',
    ));
	$wp_customize->add_control('themolitor_customizer_footer', array(
   		'label'   => __( 'Footer Text', 'themolitor'),
    	'section' => 'themolitor_customizer_footer_section',
    	'settings'   => 'themolitor_customizer_footer',
    	'type' => 'text',
    	'priority' => 1
	));
	
	//-------------------------------
	//GOOGLE FONT SECTION
	//-------------------------------

	//ADD GOOGLE FONT SECTION
	$wp_customize->add_section( 'themolitor_customizer_googlefont_section', array(
		'title' => __( 'Google Custom Font', 'themolitor' ),
		'description' => 'Visit <a target="_blank" href="http://google.com/fonts">google.com/fonts</a> to view fonts available.',
		'priority' => 200
	));
	
	//GOOGLE API
    $wp_customize->add_setting( 'themolitor_customizer_google_api',array(
    	'sanitize_callback' => 'esc_url_raw',
    ));
	$wp_customize->add_control('themolitor_customizer_google_api', array(
   		'label'   => __( 'Google Font API URL', 'themolitor'),
    	'section' => 'themolitor_customizer_googlefont_section',
    	'settings'   => 'themolitor_customizer_google_api',
    	'type' => 'text',
    	'priority' => 1
	));
	
	//GOOGLE KEYWORD
    $wp_customize->add_setting( 'themolitor_customizer_google_key',array(
    	'sanitize_callback' => 'themolitor_sanitize_text',
    ));
	$wp_customize->add_control('themolitor_customizer_google_key', array(
   		'label'   => __( 'Google Font Keyword', 'themolitor'),
    	'section' => 'themolitor_customizer_googlefont_section',
    	'settings'   => 'themolitor_customizer_google_key',
    	'type' => 'text',
    	'priority' => 2
	));
		
	//-------------------------------
	//CUSTOM CSS SECTION
	//-------------------------------
	
	//ADD CSS SECTION
	$wp_customize->add_section( 'themolitor_customizer_custom_css', array(
		'title' => __( 'CSS', 'themolitor' ),
		'priority' => 201
	));
			
	//CUSTOM CSS
    $wp_customize->add_setting( 'themolitor_customizer_css',array(
    	'sanitize_callback' => 'themolitor_sanitize_text',
    ));
	$wp_customize->add_control( new Example_Customize_Textarea_Control( $wp_customize, 'themolitor_customizer_css', array(
   		'label'   => __( 'Custom CSS', 'themolitor'),
    	'section' => 'themolitor_customizer_custom_css',
    	'settings'   => 'themolitor_customizer_css'
	)));
}