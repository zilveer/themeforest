<?php

function st_theme_customizer($wp_customize) {

    $normal_font = st_get_normal_fonts();
    $g_fonts = st_google_font_to_options();
    $fonts = array();
    foreach ($g_fonts as $k => $v) {
        $fonts[$k] = $k;
    }

    foreach ($normal_font as $k => $v) {
        $fonts[$k] = $k;
    }

    $name = ucfirst('smooththemes');
    
    $wp_customize->add_section('_st_heading_font', array(
        'title' => 'Fonts ', // The title of section
        'description' => '', // The description of section
        ));


      // ------------------- FOR PAGE MOD  ------------------------
      
       $wp_customize->add_section('_st_page_mod', array(
        'title' => 'Page Mod ', // The title of section
        'description' => '', // The description of section
        ));
        
        $wp_customize->add_setting('page_full_boxed', array(
            'default' =>'b'
        ));
        
        $wp_customize->add_control('page_full_boxed', array(
            'label' => 'Boxed of Full-Width Layout',
            'section' => '_st_page_mod',
            'type' => 'select',
                'choices' => array(
                    'f'           =>__('Full-Width','smooththemes'),
                    'b'           =>__('Boxed','smooththemes')
                ),
        ));
        
      // ------------------- END FOR PAGE MOD  --------------------  
        
        
    
     // ------------------- FOR SKIN  ------------------------
       $wp_customize->add_section('_st_global_skin', array(
            'title' => 'Global Skin ', // The title of section
            'description' => '', // The description of section
        ));
        
        global $predefined_colors;
        
        $wp_customize->add_setting('predefined_colors', array( //'type' => 'option',
            'default' => '16A1E7'));

        $wp_customize->add_control('predefined_colors', array(
                'label' => 'Pre-Defined Skins',
                'section' => '_st_global_skin',
                'type' => 'select',
                'choices' => $predefined_colors
            )
        );
        
        
         $wp_customize->add_setting('enable_custom_global_skin', array( //'type' => 'option',
                'default' => 'n'));
    
        $wp_customize->add_control('enable_custom_global_skin', array(
                'label' => 'Enable custom global skin',
                'section' => '_st_global_skin',
                'type' => 'radio',
                'choices' => array('y'=>__('Yes'), 'n'=>__('No'))
            )
        );
        
        
        $wp_customize->add_setting('custom_global_skin', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color_no_hash',
        'sanitize_js_callback' => 'maybe_hash_hex_color',
        ));

    // sanitize_hex_color_no_hash();

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
        'custom_global_skin', array(
            'label' => 'Custom Global Skin',
            'section' => '_st_global_skin',
        )));
     // ------------------- END FOR SKIN ------------------------


    // ------------------- FOR background ------------------------
    $wp_customize->add_section('_st_background', array(
        'title' => 'Background ', // The title of section
        'description' => '', // The description of section
        ));


    $wp_customize->add_setting('bg_color', array(
        'default' => '#cccccc',
        //  'type' => 'option',
        'sanitize_callback' => 'sanitize_hex_color_no_hash',
        'sanitize_js_callback' => 'maybe_hash_hex_color',
        ));

    // sanitize_hex_color_no_hash();

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
        'bg_color', array(
        'label' => 'Color',
        'section' => '_st_background',
        )));


    // ---- back fround image
    $wp_customize->add_setting('bg_img', array( //'type' => 'option'
            ));


    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,
        'bg_img', array('label' => 'Background image', 'section' =>
            '_st_background')));


    // select bg positon

    $wp_customize->add_setting('bg_positon', array( //'type' => 'option',
            'default' => 'tc'));

    $wp_customize->add_control('bg_positon', array(
        'label' => 'Postion',
        'section' => '_st_background',
        'type' => 'select',
        'choices' => array(
            'tl' => __('Top left', 'smooththemes'),
            'tc' => __('Top center', 'smooththemes'),
            'tr' => __('Top right', 'smooththemes'),
            'cc' => __('Center', 'smooththemes'),
            'bl' => __('Bottom left', 'smooththemes'),
            'br' => __('Bottom right', 'smooththemes'),
            'bc' => __('Bottom center', 'smooththemes')))
    );
    
     $wp_customize->add_setting('bg_repreat', array( //'type' => 'option',
            'default' => 'r'));

    $wp_customize->add_control('bg_repreat', array(
        'label' => 'Background Reapeat',
        'section' => '_st_background',
        'type' => 'select',
        'choices' =>  array(
                'r'=>__('Repeat','smooththemes'),
                'n'=>__('No repeat','smooththemes'),
                'x'=>__('Repeat X','smooththemes'),
                'y'=>__('Repeat Y','smooththemes')
                )
            )
    );
    
     $wp_customize->add_setting('bg_fixed', array( //'type' => 'option',
            'default' => 'n'));

    $wp_customize->add_control('bg_fixed', array(
        'label' => 'Background fixed',
        'section' => '_st_background',
        'type' => 'select',
        'choices' => array(
                    'n'=>__('No','smooththemes'),
                    'y'=>__('Yes','smooththemes')
                )
            )
    );
    
     // ------------------- END  FOR background ------------------------


} // end function


add_action('customize_register', 'st_theme_customizer');

function st_customize_preview_js_footer() {
    wp_enqueue_style('chosen', ST_THEME_URL .
        'st-framework/admin/css/admin-style.css');
    wp_enqueue_script('jquery');
    wp_enqueue_script('chosen', ST_THEME_URL .
        'st-framework/admin/js/chosen.jquery.min.js', array('jquery'));
    wp_enqueue_script('st-customize', ST_THEME_URL .
        'st-framework/admin/js/customize.js', array('jquery', 'chosen'));
}

// add_action('customize_controls_init', 'st_customize_preview_js_footer');



// 	do_action( 'customize_save', $this ); // use this
// wp_ajax_customize_save
// add_action( 'wp_ajax_customize_save', array( $this, 'save' ) );


/**
 * Save customize Settings
 * @return none
 */ 
function st_customize_save($obj){
    $st_default_lang_code = get_bloginfo('language'); // DO NOT REMOVE
    if(st_is_wpml()){
        
        $langs = array();
        $langs = icl_get_languages('skip_missing=0');
       
          // sync preview for all langs
          foreach($langs as $l){ 
                $st_options  =  __st_preview_options(get_option(ST_SETTINGS_OPTION.'_'.$l['language_code'],array()),$_POST['customized']);
                update_option(ST_SETTINGS_OPTION.'_'.$l['language_code'],$st_options);
          }
          
          $st_options  =  __st_preview_options(get_option(ST_SETTINGS_OPTION,array()),$_POST['customized']);
          update_option(ST_SETTINGS_OPTION,$st_options);
          
        }else{
             // default settings
           $st_options  =  __st_preview_options(get_option(ST_SETTINGS_OPTION,array()),$_POST['customized']);
            update_option(ST_SETTINGS_OPTION,$st_options);
        }
}

// add_action('customize_save','st_customize_save');



/* get theme mod */
// 	return apply_filters( "theme_mod_$name", $default ); // get_theme_mods();
// 	update_option( "theme_mods_$theme", $mods ); // set_theme_mod()

