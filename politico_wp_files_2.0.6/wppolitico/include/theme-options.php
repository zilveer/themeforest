<?php
////////////////////////////
//THEME CUSTOMIZER SETTINGS
////////////////////////////
add_action( 'customize_register', 'themolitor_customizer_register' );

function themolitor_customizer_register($wp_customize) {

	class Example_Customize_Textarea_Control extends WP_Customize_Control {
    public $type = 'textarea';
 
    public function render_content() {
        ?>
        <label>
        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
        </label>
        <?php
    }
	}
	
	
	//-------------------------------
	//ADD OPTIONS
	//-------------------------------
	
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
	
	//NUMBER CHECK
	function themolitor_sanitize_number( $input ) {
	   if(is_numeric($input)){
	        return $input;
	    } else {
	        return '';
	    }
	}

	//SLIDER TYPE
	function themolitor_sanitize_slider_type( $input ) {
	    $valid = array(
	        'dual' => 'Dual Slider',
   	 		'nivo' => 'Nivo Slider'
	    );
	 
	    if ( array_key_exists( $input, $valid ) ) {
	        return $input;
	    } else {
	        return '';
	    }
	}
	
	//TRANSITION EFFECT
	function themolitor_sanitize_transition( $input ) {
	    $valid = array(
	        'random' => 'Random',
   	 		'fade' => 'Fade',
   	 		'fold' => 'Fold',
   	 		'sliceUpDownLeft' => 'Slice Up Down Left',
   	 		'sliceUpDown' => 'Slice Up Down',
   	 		'sliceUpLeft' => 'Slice Up Left',
   	 		'sliceUp' => 'Slice Up',
   	 		'sliceDownLeft' => 'Slice Down Left',
   	 		'sliceDown' => 'Slice Down'
	    );
	 
	    if ( array_key_exists( $input, $valid ) ) {
	        return $input;
	    } else {
	        return '';
	    }
	}

	//ACTIVE COUTNING
	function themolitor_sanitize_counting( $input ) {
	    $valid = array(
	        'true' => 'Yes',
   	 		'false' => 'No'
	    );
	 
	    if ( array_key_exists( $input, $valid ) ) {
	        return $input;
	    } else {
	        return '';
	    }
	}
	
	
	//-------------------------------
	// TITLE & TAGLINE
	//-------------------------------
	
	//LOGO
	$wp_customize->add_setting( 'themolitor_customizer_logo', array(
		'default' => get_template_directory_uri().'/images/logo.png',
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
	
	//BANNER TOP GRADIENT COLOR
	$wp_customize->add_setting( 'themolitor_customizer_top_banner', array(
		'default' => '#25659D',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themolitor_customizer_top_banner', array(
		'label'   => __( 'Banner Top Gradient Color', 'themolitor'),
		'section' => 'colors',
		'settings'   => 'themolitor_customizer_top_banner',
		'priority' => 1
	)));
	//BANNER BOTTOM GRADIENT COLOR
	$wp_customize->add_setting( 'themolitor_customizer_bottom_banner', array(
		'default' => '#00427b',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themolitor_customizer_bottom_banner', array(
		'label'   => __( 'Banner Bottom Gradient Color', 'themolitor'),
		'section' => 'colors',
		'settings'   => 'themolitor_customizer_bottom_banner',
		'priority' => 2
	)));
	//LINK COLOR
	$wp_customize->add_setting( 'themolitor_customizer_link_color', array(
		'default' => '#12548c',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themolitor_customizer_link_color', array(
		'label'   => __( 'Link Color', 'themolitor'),
		'section' => 'colors',
		'settings'   => 'themolitor_customizer_link_color',
		'priority' => 3
	)));
	
	
	//-------------------------------
	//SLIDER SECTION
	//-------------------------------
	
	//ADD SLIDER SECTION
	$wp_customize->add_section( 'themolitor_customizer_slider_section', array(
		'title' => __( 'Slider', 'themolitor' ),
		'priority' => 200
	));
	
	//TYPE OF SLIDER
	$wp_customize->add_setting('themolitor_customizer_slider_type', array(
	    'capability'     => 'edit_theme_options',
	    'default'        => 'dual',
	    'sanitize_callback' => 'themolitor_sanitize_slider_type',
	));
	$wp_customize->add_control( 'themolitor_customizer_slider_type', array(
 	   	'label'   => __('Type of Slider','themolitor'),
		'section' => 'themolitor_customizer_slider_section',
   	 	'type'    => 'select',
   	 	'choices' => array(
   	 		'dual' => 'Dual Slider',
   	 		'nivo' => 'Nivo Slider'
   	 	),
   	 	'settings' => 'themolitor_customizer_slider_type',
   	 	'priority' => 1
	));
	
	//SLIDER CATEGORY
	$wp_customize->add_setting('themolitor_slider_category', array(
	    'capability'     => 'edit_theme_options',
	    'type'           => 'option',
	     'sanitize_callback' => 'themolitor_sanitize_number',
	));
	$wp_customize->add_control( 'themolitor_slider_category', array(
 	   'settings' => 'themolitor_slider_category',
 	   'label'   => __('Category','themolitor'),
   	 	'section' => 'themolitor_customizer_slider_section',
   	 	'type'    => 'select',
   	 	'choices' => $options_categories,
   	 	'priority' => 2
	));
	
	//NUMBER TO DISPLAY
    $wp_customize->add_setting( 'themolitor_customizer_slider_number', array(
    	'default' => '5',
    	'sanitize_callback' => 'themolitor_sanitize_number',
	));
	$wp_customize->add_control('themolitor_customizer_slider_number', array(
   		'label'   => __( 'Number of Items', 'themolitor'),
    	'section' => 'themolitor_customizer_slider_section',
    	'settings'   => 'themolitor_customizer_slider_number',
    	'type' => 'text',
    	'priority' => 3
	));
	
	//NIVO TRANSITION EFFECT
	$wp_customize->add_setting('themolitor_customizer_nivo_effect', array(
	    'capability'     => 'edit_theme_options',
	    'default'        => 'random',
	    'sanitize_callback' => 'themolitor_sanitize_transition',
	));
	$wp_customize->add_control( 'themolitor_customizer_nivo_effect', array(
 	   	'label'   => __('Nivo Slider Transition Effect (if used)','themolitor'),
		'section' => 'themolitor_customizer_slider_section',
   	 	'type'    => 'select',
   	 	'choices' => array(
   	 		'random' => 'Random',
   	 		'fade' => 'Fade',
   	 		'fold' => 'Fold',
   	 		'sliceUpDownLeft' => 'Slice Up Down Left',
   	 		'sliceUpDown' => 'Slice Up Down',
   	 		'sliceUpLeft' => 'Slice Up Left',
   	 		'sliceUp' => 'Slice Up',
   	 		'sliceDownLeft' => 'Slice Down Left',
   	 		'sliceDown' => 'Slice Down',
   	 	),
   	 	'settings' => 'themolitor_customizer_nivo_effect',
   	 	'priority' => 4
	));
	
	
	//-------------------------------
	//COUNTDOWN SECTION
	//-------------------------------
	
	//ADD COUNTDOWN SECTION
	$wp_customize->add_section( 'themolitor_customizer_countdown_section', array(
		'title' => __( 'Countdown', 'themolitor' ),
		'priority' => 300
	));
	
	//DISPLAY COUNTDOWN
	$wp_customize->add_setting( 'themolitor_customizer_countdown_onoff', array(
    	'default' => 1,
    	'sanitize_callback' => 'themolitor_sanitize_checkbox',
	));
	$wp_customize->add_control( 'themolitor_customizer_countdown_onoff', array(
    	'label' => 'Display Countdown',
    	'type' => 'checkbox',
    	'section' => 'themolitor_customizer_countdown_section',
    	'settings' => 'themolitor_customizer_countdown_onoff',
    	'priority' => 1
	));
	
	//CUSTOM TEXT
    $wp_customize->add_setting( 'themolitor_customizer_countdown_text', array(
    	'default' => 'Election Countdown',
    	'sanitize_callback' => 'themolitor_sanitize_text',
	));
	$wp_customize->add_control('themolitor_customizer_countdown_text', array(
   		'label'   => __( 'Custom Text', 'themolitor'),
    	'section' => 'themolitor_customizer_countdown_section',
    	'settings'   => 'themolitor_customizer_countdown_text',
    	'type' => 'text',
    	'priority' => 2
	));
	
	//TEXT COLOR
	$wp_customize->add_setting( 'themolitor_customizer_countdown_color', array(
		'default' => '#a72205',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themolitor_customizer_countdown_color', array(
		'label'   => __( 'Text Color', 'themolitor'),
		'section' => 'themolitor_customizer_countdown_section',
		'settings'   => 'themolitor_customizer_countdown_color',
		'priority' => 3
	)));
	
	//LINK
    $wp_customize->add_setting( 'themolitor_customizer_countdown_link', array(
    	'default' => '#',
    	'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control('themolitor_customizer_countdown_link', array(
   		'label'   => __( 'Link URL', 'themolitor'),
    	'section' => 'themolitor_customizer_countdown_section',
    	'settings'   => 'themolitor_customizer_countdown_link',
    	'type' => 'text',
    	'priority' => 4
	));
	
	//END DATE
    $wp_customize->add_setting( 'themolitor_customizer_countdown_end', array(
    	'default' => '11/02/2016 12:00 AM',
    	'sanitize_callback' => 'themolitor_sanitize_text',
	));
	$wp_customize->add_control('themolitor_customizer_countdown_end', array(
   		'label'   => __( 'End Date', 'themolitor'),
    	'section' => 'themolitor_customizer_countdown_section',
    	'settings'   => 'themolitor_customizer_countdown_end',
    	'type' => 'text',
    	'priority' => 5
	));
			
	//FINISH MESSAGE
    $wp_customize->add_setting( 'themolitor_customizer_countdown_finished', array(
    	'default' => 'Countdown Finished!',
    	'sanitize_callback' => 'themolitor_sanitize_text',
	));
	$wp_customize->add_control('themolitor_customizer_countdown_finished', array(
   		'label'   => __( 'Finish Message', 'themolitor'),
    	'section' => 'themolitor_customizer_countdown_section',
    	'settings'   => 'themolitor_customizer_countdown_finished',
    	'type' => 'text',
    	'priority' => 6
	));
	
	//ACTIVE COUNTING
	$wp_customize->add_setting('themolitor_customizer_countdown_active', array(
	    'capability'     => 'edit_theme_options',
	    'default'        => 'true',
	    'sanitize_callback' => 'themolitor_sanitize_counting',
	));
	$wp_customize->add_control( 'themolitor_customizer_countdown_active', array(
 	   	'label'   => __('Active Counting','themolitor'),
		'section' => 'themolitor_customizer_countdown_section',
   	 	'type'    => 'select',
   	 	'choices' => array(
   	 		'true' => 'Yes',
   	 		'false' => 'No'
   	 	),
   	 	'settings' => 'themolitor_customizer_countdown_active',
   	 	'priority' => 7
	));
	
	
	//-------------------------------
	//DONATE SECTION
	//-------------------------------

	//ADD DONATE SECTION
	$wp_customize->add_section( 'themolitor_customizer_donate_section', array(
		'title' => __( 'Donate', 'themolitor' ),
		'priority' => 400
	));
	
	//DISPLAY DONATE BUTTON
	$wp_customize->add_setting( 'themolitor_customizer_donate_onoff', array(
    	'default' => 1,
    	'sanitize_callback' => 'themolitor_sanitize_checkbox',
	));
	$wp_customize->add_control( 'themolitor_customizer_donate_onoff', array(
    	'label' => 'Display Donate Button',
    	'type' => 'checkbox',
    	'section' => 'themolitor_customizer_donate_section',
    	'settings' => 'themolitor_customizer_donate_onoff',
    	'priority' => 1
	));
	
	//OPEN IN NEW WINDOW
	$wp_customize->add_setting( 'themolitor_customizer_donate_new', array(
    	'default' => 1,
    	'sanitize_callback' => 'themolitor_sanitize_checkbox',
	));
	$wp_customize->add_control( 'themolitor_customizer_donate_new', array(
    	'label' => 'Open in new window?',
    	'type' => 'checkbox',
    	'section' => 'themolitor_customizer_donate_section',
    	'settings' => 'themolitor_customizer_donate_new',
    	'priority' => 2
	));
	
	//LINK
    $wp_customize->add_setting( 'themolitor_customizer_donate_link', array(
    	'default' => '#',
    	'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control('themolitor_customizer_donate_link', array(
   		'label'   => __( 'Link URL', 'themolitor'),
    	'section' => 'themolitor_customizer_donate_section',
    	'settings'   => 'themolitor_customizer_donate_link',
    	'type' => 'text',
    	'priority' => 3
	));
	
	//CUSTOM TEXT
    $wp_customize->add_setting( 'themolitor_customizer_donate_text', array(
    	'default' => 'DONATE NOW',
    	'sanitize_callback' => 'themolitor_sanitize_text',
	));
	$wp_customize->add_control('themolitor_customizer_donate_text', array(
   		'label'   => __( 'Text', 'themolitor'),
    	'section' => 'themolitor_customizer_donate_section',
    	'settings'   => 'themolitor_customizer_donate_text',
    	'type' => 'text',
    	'priority' => 4
	));
	
	//TEXT COLOR
	$wp_customize->add_setting( 'themolitor_customizer_donate_color', array(
		'default' => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themolitor_customizer_donate_color', array(
		'label'   => __( 'Text Color', 'themolitor'),
		'section' => 'themolitor_customizer_donate_section',
		'settings'   => 'themolitor_customizer_donate_color',
		'priority' => 5
	)));
	
	//TOP GRADIENT COLOR
	$wp_customize->add_setting( 'themolitor_customizer_donate_top_color', array(
		'default' => '#be5a45',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themolitor_customizer_donate_top_color', array(
		'label'   => __( 'Top Gradient Color', 'themolitor'),
		'section' => 'themolitor_customizer_donate_section',
		'settings'   => 'themolitor_customizer_donate_top_color',
		'priority' => 6
	)));
	
	//BOTTOM GRADIENT COLOR
	$wp_customize->add_setting( 'themolitor_customizer_donate_bottom_color', array(
		'default' => '#a72306',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'themolitor_customizer_donate_bottom_color', array(
		'label'   => __( 'Bottom Gradient Color', 'themolitor'),
		'section' => 'themolitor_customizer_donate_section',
		'settings'   => 'themolitor_customizer_donate_bottom_color',
		'priority' => 7
	)));
	
	
	//-------------------------------
	//FOOTER SECTION
	//-------------------------------

	//ADD FOOTER SECTION
	$wp_customize->add_section( 'themolitor_customizer_footer_section', array(
		'title' => __( 'Footer', 'themolitor' ),
		'priority' => 500
	));
	
	//DISPLAY FOOTER WIDGETS
	$wp_customize->add_setting( 'themolitor_customizer_footer_onoff', array(
    	'default' => 1,
    	'sanitize_callback' => 'themolitor_sanitize_checkbox',
	));
	$wp_customize->add_control( 'themolitor_customizer_footer_onoff', array(
    	'label' => 'Display Footer Widgets',
    	'type' => 'checkbox',
    	'section' => 'themolitor_customizer_footer_section',
    	'settings' => 'themolitor_customizer_footer_onoff',
    	'priority' => 1
	));
	
	//TWITTER
    $wp_customize->add_setting( 'themolitor_customizer_twitter', array(
    	'default' => '',
    	'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control('themolitor_customizer_twitter', array(
   		'label'   => __( 'Twitter URL', 'themolitor'),
    	'section' => 'themolitor_customizer_footer_section',
    	'settings'   => 'themolitor_customizer_twitter',
    	'type' => 'text',
    	'priority' => 2
	));
	
	//FACEBOOK
    $wp_customize->add_setting( 'themolitor_customizer_facebook', array(
    	'default' => '',
    	'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control('themolitor_customizer_facebook', array(
   		'label'   => __( 'Footer URL', 'themolitor'),
    	'section' => 'themolitor_customizer_footer_section',
    	'settings'   => 'themolitor_customizer_facebook',
    	'type' => 'text',
    	'priority' => 3
	));
	
	//FLIKr
    $wp_customize->add_setting( 'themolitor_customizer_flikr', array(
    	'default' => '',
    	'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control('themolitor_customizer_flikr', array(
   		'label'   => __( 'Flikr URL', 'themolitor'),
    	'section' => 'themolitor_customizer_footer_section',
    	'settings'   => 'themolitor_customizer_flikr',
    	'type' => 'text',
    	'priority' => 4
	));
	
	//LINKEDIN
    $wp_customize->add_setting( 'themolitor_customizer_linkedin', array(
    	'default' => '',
    	'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control('themolitor_customizer_linkedin', array(
   		'label'   => __( 'LinkedIn URL', 'themolitor'),
    	'section' => 'themolitor_customizer_footer_section',
    	'settings'   => 'themolitor_customizer_linkedin',
    	'type' => 'text',
    	'priority' => 6
	));
	
	//YOUTUBE
    $wp_customize->add_setting( 'themolitor_customizer_youtube', array(
    	'default' => '',
    	'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control('themolitor_customizer_youtube', array(
   		'label'   => __( 'YouTube URL', 'themolitor'),
    	'section' => 'themolitor_customizer_footer_section',
    	'settings'   => 'themolitor_customizer_youtube',
    	'type' => 'text',
    	'priority' => 7
	));
	
	//GOOGLE PLUS
    $wp_customize->add_setting( 'themolitor_customizer_gplus', array(
    	'default' => '',
    	'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control('themolitor_customizer_gplus', array(
   		'label'   => __( 'Google+ URL', 'themolitor'),
    	'section' => 'themolitor_customizer_footer_section',
    	'settings'   => 'themolitor_customizer_gplus',
    	'type' => 'text',
    	'priority' => 8
	));
	
	//INSTAGRAM
    $wp_customize->add_setting( 'themolitor_customizer_instagram', array(
    	'default' => '',
    	'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control('themolitor_customizer_instagram', array(
   		'label'   => __( 'Instagram URL', 'themolitor'),
    	'section' => 'themolitor_customizer_footer_section',
    	'settings'   => 'themolitor_customizer_instagram',
    	'type' => 'text',
    	'priority' => 9
	));
	
	//PINTEREST
    $wp_customize->add_setting( 'themolitor_customizer_pinterest', array(
    	'default' => '',
    	'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control('themolitor_customizer_pinterest', array(
   		'label'   => __( 'Pinterest URL', 'themolitor'),
    	'section' => 'themolitor_customizer_footer_section',
    	'settings'   => 'themolitor_customizer_pinterest',
    	'type' => 'text',
    	'priority' => 10
	));
	
	//VIMEO
    $wp_customize->add_setting( 'themolitor_customizer_vimeo', array(
    	'default' => '',
    	'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control('themolitor_customizer_vimeo', array(
   		'label'   => __( 'Vimeo URL', 'themolitor'),
    	'section' => 'themolitor_customizer_footer_section',
    	'settings'   => 'themolitor_customizer_vimeo',
    	'type' => 'text',
    	'priority' => 11
	));
	
	
	//-------------------------------
	//CUSTOM CSS SECTION
	//-------------------------------
	
	//ADD CSS SECTION
	$wp_customize->add_section( 'themolitor_customizer_custom_css', array(
		'title' => __( 'CSS', 'themolitor' ),
		'priority' => 600
	));
			
	//CUSTOM CSS
    $wp_customize->add_setting( 'themolitor_customizer_css', array(
    	'default'        => '',
    	'sanitize_callback' => 'themolitor_sanitize_text',
	));
	$wp_customize->add_control( new Example_Customize_Textarea_Control( $wp_customize, 'themolitor_customizer_css', array(
   		'label'   => __( 'Custom CSS', 'themolitor'),
    	'section' => 'themolitor_customizer_custom_css',
    	'settings'   => 'themolitor_customizer_css'
	)));
}