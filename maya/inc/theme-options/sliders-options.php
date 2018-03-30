<?php    
                         
$yiw_slider = yiw_get_option( 'slider_choosen', 'none' );      

// configuration slides
switch ( $yiw_slider ) {
    case 'elegant' :
        $slide_config = 'title, image, caption, link';
        break;
    case 'cycle' :
        $slide_config = 'title, image, video, caption, link';
        break;
    case 'unoslider' :
        $slide_config = 'title, image, link';
        break;        
    case 'elastic' :
    	$slide_config = 'title, caption, image, link';
    	break;   
    case 'flash' :
        $slide_config = 'title, image, caption, link';
        break;
    case 'thumbnails' :       
        $slide_config = 'image, caption, tooltip, link';
        break;
    case 'nivo' :
        $slide_config = 'image, link';
        break;
    default :
        $slide_config = 'title, image, caption, link';
        break;
}

$yiw_options['sliders'] = array (         
    
    /* =================== ARROW FADE SLIDER =================== */
    'title' => array(    
        array( 'name' => __('Sliders Manager', 'yiw'),
               'type' => 'title'),
    ),        
            
    'config' => array(    
        array( 'name' => __('Select slider to show or configure', 'yiw'),
               'type' => 'section',
               'effect' => 0),
        array( 'type' => 'open'),         
        
        array( 'name' => __('Default Header image type', 'yiw'),
               'desc' => __('Select the default header type for homepage pages.', 'yiw') . ' <br />Note: ' . sprintf( __('for "Fixed Image", you can configure it on %s -> %s.', 'yiw' ), __( 'Appearance', 'yiw' ), __( 'Header', 'yiw' ) ),
               'id' => 'slider_type',
               'type' => 'radio',
               'options' => empty( $yiw_sliders ) ? array() : $yiw_sliders,
               'std' => 'nivo' ),             
         
        array( 'name' => __('Configure slider.', 'yiw'),
               'id' => 'slider_choosen',       
               'desc' => __('Choose a slider and save, to configure below your slider choosen.', 'yiw'),
               'type' => 'select',
               'options' => empty( $yiw_sliders ) ? array() : $yiw_sliders,
               'button' => __( 'Configure', 'yiw' ),
               'std' => 'none' ),            
         
        array( 'name' => __('Responsive Behavior', 'yiw'),
    	   'id' => 'slider_responsive',       
    	   'desc' => __('Say what you want to do when the website is loaded by lower resolution screen.', 'yiw' ) . ' <br /><br /><b>NB:</b> '.__('The option "Leave the slider" is available only for "elastic", "uno", "layers" and "minilayers"  sliders, because they are the only ones that have a correct responsive behavior. If you use another slider type, the slider will be hidden in lower resolutions.', 'yiw'),
    	   'type' => 'select',
		   'options' => array(                               
                'leave' => __( 'Leave the slider', 'yiw' ),
                'remove' => __( 'Remove the slider', 'yiw' ),
                'fixed-image' => __( 'Replace with "Fixed Image"', 'yiw' )
           ),
		   'std' => 'leave' ),	
            
        array( 'type' => 'close')
    ),                          
   
    'settings-flash' => array(  
        array( 'name' => __('Slider Settings', 'yiw'),
               'type' => 'section'),
        array( 'type' => 'open'),          
         
        array( 'name' => __('Settings flash slider', 'yiw'),
               'desc' => __('To configure the flash slider settings, go to the "Flash slider" tab.', 'yiw'),
               'type' => 'simple-text'),
            
        array( 'type' => 'close')       
    ),

    'settings-elegant' => array(    
        array( 'name' => __('Slider Settings', 'yiw'),
               'type' => 'section'),
        array( 'type' => 'open'),  
         
        array( 'name' => __('Effect', 'yiw'),
               'desc' => __('Select the effect you want for slides transiction.', 'yiw'),
               'id' => 'slider_elegant_effect',
               'type' => 'select',
               'options' => $GLOBALS['yiw_cycle_fxs'],
               'std' => 'fade'),    
         
        array( 'name' => __('Easing', 'yiw'),
               'desc' => __('Select the easing for effect transition.', 'yiw'),
               'id' => 'slider_elegant_easing',
               'type' => 'select',
               'options' => $GLOBALS['yiw_easings'],
               'std' => FALSE ),    
            
        array( 'name' => __('Speed (s)', 'yiw'),
               'desc' => __('Select the speed of transiction between slides, expressed in seconds.', 'yiw'),
               'id' => 'slider_elegant_speed',
               'min' => 0,
               'max' => 5,
               'step' => 0.1,
               'type' => 'slider_control',
               'std' => 0.5),  
            
        array( 'name' => __('Timeout (s)', 'yiw'),
               'desc' => __('Select the delay between slides, expressed in seconds.', 'yiw'),
               'id' => 'slider_elegant_timeout',
               'min' => 0,
               'max' => 20,
               'step' => 0.5,
               'type' => 'slider_control',
               'std' => 5),     
            
        array( 'name' => __('Caption position', 'yiw'),
               'desc' => __('Select the position of caption.', 'yiw'),
               'id' => 'slider_elegant_caption_position',
               'type' => 'select',
               'options' => array(
                    'top' => __( 'Top', 'yiw' ),
                    'bottom' => __( 'Bottom', 'yiw' ),
                    'left' => __( 'Left', 'yiw' ),
                    'right' => __( 'Right', 'yiw' ),
               ),
               'std' => 'right'),    
            
        array( 'name' => __('Caption Speed (s)', 'yiw'),
               'desc' => __('Select the speed of caption appearance.', 'yiw'),
               'id' => 'slider_elegant_caption_speed',
               'min' => 0,
               'max' => 5,
               'step' => 0.1,
               'type' => 'slider_control',
               'std' => 0.5),      
         
        array( 'name' => __('More text', 'yiw'),
               'desc' => __('Write what you want to show on more link, if you have selected "YES" on option above.', 'yiw'),
               'id' => 'slider_elegant_more_text',
               'type' => 'text',
               'std' => __( 'Read more...', 'yiw' ) ),
            
        array( 'type' => 'close')
    ),   
    
    'settings-thumbnails' => array(    
        array( 'name' => __('Slider Settings', 'yiw'),
        	   'type' => 'section'),
        array( 'type' => 'open'),  
         
        array( 'name' => __('Effect', 'yiw'),
        	   'desc' => __('Select the effect you want for slides transiction.', 'yiw'),
        	   'id' => 'slider_thumbnails_effect',
        	   'type' => 'select',
        	   'options' => array(
                'hslide' => 'hslide',
                'vslide' => 'vslide',
                'fade' => 'fade',
               ),
			   'std' => 'fade'),		
        	
        array( 'name' => __('Speed (s)', 'yiw'),
        	   'desc' => __('Select the speed of transiction between slides, expressed in seconds.', 'yiw'),
        	   'id' => 'slider_thumbnails_speed',
        	   'min' => 0,
        	   'max' => 5,
        	   'step' => 0.1,
        	   'type' => 'slider_control',
        	   'std' => 0.5),  
        	
        array( 'name' => __('Timeout (s)', 'yiw'),
        	   'desc' => __('Select the delay between slides, expressed in seconds.', 'yiw'),
        	   'id' => 'slider_thumbnails_timeout',
        	   'min' => 0,
        	   'max' => 20,
        	   'step' => 0.5,
        	   'type' => 'slider_control',
        	   'std' => 5),   
        	
        array( 'type' => 'close')
    ),
    
    'settings-cycle' => array(    
        array( 'name' => __('Slider Settings', 'yiw'),
               'type' => 'section'),
        array( 'type' => 'open'),  
         
        array( 'name' => __('Effect', 'yiw'),
               'desc' => __('Select the effect you want for slides transiction.', 'yiw'),
               'id' => 'slider_cycle_effect',
               'type' => 'select',
               'options' => $GLOBALS['yiw_cycle_fxs'],
               'std' => 'fade'),    
         
        array( 'name' => __('Easing', 'yiw'),
               'desc' => __('Select the easing for effect transition.', 'yiw'),
               'id' => 'slider_cycle_easing',
               'type' => 'select',
               'options' => $GLOBALS['yiw_easings'],
               'std' => FALSE ),    
            
        array( 'name' => __('Speed (s)', 'yiw'),
               'desc' => __('Select the speed of transiction between slides, expressed in seconds.', 'yiw'),
               'id' => 'slider_cycle_speed',
               'min' => 0,
               'max' => 5,
               'step' => 0.1,
               'type' => 'slider_control',
               'std' => 0.5),  
            
        array( 'name' => __('Timeout (s)', 'yiw'),
               'desc' => __('Select the delay between slides, expressed in seconds.', 'yiw'),
               'id' => 'slider_cycle_timeout',
               'min' => 0,
               'max' => 20,
               'step' => 0.5,
               'type' => 'slider_control',
               'std' => 5),     
               
        array( "name" => __("Show more text", 'yiw'),
               "desc" => __("Select if you want to show more text after tooltip content, linked with slide's link.", 'yiw'),
               "id" => 'slider_cycle_show_more_text',
               "type" => "on-off",
               "std" => 'no'),
         
        array( 'name' => __('More text', 'yiw'),
               'desc' => __('Write what you want to show on more link, if you have selected "YES" on option above.', 'yiw'),
               'id' => 'slider_cycle_more_text',
               'type' => 'text',
               'std' => __( 'Read more...', 'yiw' ) ),
            
        array( 'type' => 'close')
    ),       
    
    'settings-layers' => array(    
        array( 'name' => __('Slider Settings', 'yiw'),
               'type' => 'section',
               'effect' => 0),
        array( 'type' => 'open'),       
         
        array( 'name' => __('Select the slider', 'yiw'),
               'desc' => __('Select the slider you want to show in home page.', 'yiw'),
               'id' => 'slider_layers_choose',
               'type' => 'select',
               'options' => layerslider_get_sliders(),
               'std' => 1 ),     
         
        array( 'desc' => sprintf( __('You can set this slider in <a href="%s">this page</a> and configure it, adding your slides in that page. Then, select above the slider that you can want to show in the homepage.', 'yiw'), admin_url('admin.php?page=layerslider') ),
        	   'type' => 'simple-text'),      
            
        array( 'type' => 'close')
    ),
    
    'settings-minilayers' => array(    
        array( 'name' => __('Slider Settings', 'yiw'),
               'type' => 'section',
               'effect' => 0),
        array( 'type' => 'open'),     
         
        array( 'name' => __('Select the slider', 'yiw'),
               'desc' => __('Select the slider you want to show in home page. <b>We suggest to set the slider 608x271px size</b>', 'yiw'),
               'id' => 'slider_minilayers_choose',
               'type' => 'select',
               'options' => layerslider_get_sliders(),
               'std' => 1 ),     
         
        array( 'desc' => sprintf( __('You can set this slider in <a href="%s">this page</a> and configure it, adding your slides in that page. Then, select above the slider that you can want to show in the homepage.', 'yiw'), admin_url('admin.php?page=layerslider') ),
        	   'type' => 'simple-text'),  
        
         array( "name" => __( "Title", "yiw" ),
               "desc" => __( "This title will be shown up to the text (see next box for text details).", "yiw" ),
               "id"   => "slider_minilayers_static_title",
               "type" => "text",
               "std"  => ""
        ),
        
        array( "name" => __("Text", 'yiw'),
               "desc" => __("The static text of the slider.", 'yiw'),
               "id" => 'slider_minilayers_static_text',
               "type" => "textarea",
               "std" => ''),
        array( "name" => __( "Short text", 'yiw' ),
               "desc" => __( 'This text will be shown under the text (see previous box for text details).', 'yiw' ),
               "id"   => "slider_minilayers_static_short_text",
               "type" => "text",
               "std"  => ''
        ),    
            
        array( 'type' => 'close')
    ),         
    
    'settings-fixed-image' => array(    
        array( 'name' => __('Slider Settings', 'yiw'),
               'type' => 'section',
               'effect' => 0),
        array( 'type' => 'open'),

        array( "name" => __( "Static image URL", 'yiw' ),
            "desc" => __( 'The Fixed Image will link to this URL.', 'yiw' ),
            "id"   => "slider_fixed_image_url",
            "type" => "text",
            "std"  => ''
        ),

        array( "name" => __("Open in a new tab", 'yiw'),
            "desc" => __("Select if you want the link to open in a new tab of your browser or not.", 'yiw'),
            "id" => 'slider_fixed_image_target',
            "type" => "on-off",
            "std" => 'no'),

        array( 'desc' => sprintf( __('You can set a static image in <a href="%s">Appareance -> Header</a>.', 'yiw'), admin_url('themes.php?page=custom-header') ),
        	   'type' => 'simple-text'),      
            
        array( 'type' => 'close')
    ),        
    
    'settings-nivo' => array(    
        array( 'name' => __('Slider Settings', 'yiw'),
               'type' => 'section',
               'effect' => 0),
        array( 'type' => 'open'),
        
        array( "name" => __( "Title", "yiw" ),
               "desc" => __( "This title will be shown up to the text (see next box for text details).", "yiw" ),
               "id"   => "slider_nivo_static_title",
               "type" => "text",
               "std"  => ""
        ),        

        array( "name" => __("Text", 'yiw'),
               "desc" => __("The static text of the slider.", 'yiw'),
               "id" => 'slider_nivo_text',
               "type" => "textarea",
               "std" => ''),
        array( "name" => __( "Short text", 'yiw' ),
               "desc" => __( 'This text will be shown under the text (see previous box for text details).', 'yiw' ),
               "id"   => "slider_nivo_static_short_text",
               "type" => "text",
               "std"  => ''
        ),
        
        array( "name" => __( 'Effect', 'yiw' ),
               "desc" => __( 'The effect used to change slide.', 'yiw' ),
               "id" => 'slide_nivo_effect',
               "type" => 'select',
               "options" => array(
                    'random' => 'Random',
                    'fade' => 'Fade',
                    'fold' => 'Fold'
               ),
               "std" => 'fade'
        ),
            
        array( 'name' => __('Pause between slides', 'yiw'),
               'desc' => __('Select the delay between slides, expressed in seconds.', 'yiw'),
               'id' => 'slider_nivo_pause',
               'min' => 0,
               'max' => 10,
               'step' => 0.1,
               'type' => 'slider_control',
               'std' => 4),      

        array( 'name' => __('Animation speed', 'yiw'),
               'desc' => __('The speed of the animation between two slide, expressed in seconds.', 'yiw'),
               'id' => 'slider_nivo_speed',
               'min' => 0,
               'max' => 2,
               'step' => 0.1,
               'type' => 'slider_control',
               'std' => 0.5),
            
        array( 'type' => 'close')
    ),          

    'settings-unoslider' => array(    
        array( 'name' => __('Slider Settings', 'yiw'),
               'type' => 'section'),
        array( 'type' => 'open'),      

        array( "name" => __("Width", 'yiw'),
               "desc" => __("Set the width of the slider", 'yiw'),
               "id" => 'slider_unoslider_width',
               "type" => "text",
               "std" => 960),      

        array( "name" => __("Height", 'yiw'),
               "desc" => __("Set the height of the slider", 'yiw'),
               "id" => 'slider_unoslider_height',
               "type" => "text",
               "std" => 350),      

        array( "name" => __("Theme slider", 'yiw'),
               "desc" => __("Select the theme for the slider", 'yiw'),
               "id" => 'slider_unoslider_theme',
               "type" => "select",
               'options' => array(
                    'basic' => 'Basic',
                    'elegant' => 'Elegant',
                    'inline' => 'Inline',
                    'light' => 'Light',
                    'minimalist' => 'Minimalist',
                    'modern' => 'Modern',
                    'panel' => 'Panel',
                    'ribbon' => 'Ribbon',
                    'slick' => 'Slick',
                    'smooth' => 'Smooth',
                    'square' => 'Square',
                    'text' => 'Text'
               ),
               "std" => 'light'),          

        array( "name" => __("Indicator", 'yiw'),
               "desc" => __("Say if you want to show the indicators", 'yiw'),
               "id" => 'slider_unoslider_indicator',
               "type" => "on-off",
               "std" => 1),      

        array( "name" => __("Autohide Indicator", 'yiw'),
               "desc" => __("Say if you want that the indicators will hide automatically", 'yiw'),
               "id" => 'slider_unoslider_autohide_indicator',
               "type" => "on-off",
               "std" => 1),

        array( "name" => __("Navigation", 'yiw'),
               "desc" => __("Say if you want to show the navigation", 'yiw'),
               "id" => 'slider_unoslider_navigation',
               "type" => "on-off",
               "std" => 1),

        array( "name" => __("Autohide Navigation", 'yiw'),
               "desc" => __("Say if you want that the navigation will hide automatically", 'yiw'),
               "id" => 'slider_unoslider_autohide_navigation',
               "type" => "on-off",
               "std" => 1),

        array( "name" => __("Enable Slideshow", 'yiw'),
               "desc" => __("Say if you want that the slider play automatically", 'yiw'),
               "id" => 'slider_unoslider_enable_slideshow',
               "type" => "on-off",
               "std" => 1),

        array( "name" => __("Pause on mouse over", 'yiw'),
               "desc" => __("Say if you want that the slider will pause when the mouse is over", 'yiw'),
               "id" => 'slider_unoslider_pause_on_mouseover',
               "type" => "on-off",
               "std" => 1),

        array( "name" => __("Continuous", 'yiw'),
               "desc" => __("Say if you want that the slider will restart again if it finish", 'yiw'),
               "id" => 'slider_unoslider_continuous',
               "type" => "on-off",
               "std" => 1),

        array( "name" => __("Timebar", 'yiw'),
               "desc" => __("Say if you want to show the timebar", 'yiw'),
               "id" => 'slider_unoslider_timebar',
               "type" => "on-off",
               "std" => 1),

        array( "name" => __("Infinite Loop", 'yiw'),
               "desc" => __("Say if you want that the loop must be infinitive", 'yiw'),
               "id" => 'slider_unoslider_infinite_loop',
               "type" => "on-off",
               "std" => 1),

        array( "name" => __("Autostart", 'yiw'),
               "desc" => __("Say if you want that the slider start automatically after loading", 'yiw'),
               "id" => 'slider_unoslider_autostart',
               "type" => "on-off",
               "std" => 1),             
            
        array( 'name' => __('Change interval (s)', 'yiw'),
               'desc' => __('Select the delay between slides, expressed in seconds.', 'yiw'),
               'id' => 'slider_unoslider_interval',
               'min' => 0,
               'max' => 10,
               'step' => 0.1,
               'type' => 'slider_control',
               'std' => 3),         
         
        array( 'desc' => '<strong>' . __('Blocks', 'yiw') . '</strong>',
        	   'type' => 'simple-text'),      
            
        array( 'name' => __('Vertical blocks', 'yiw'),
               'desc' => __('Select the number of blocks in vertical.', 'yiw'),
               'id' => 'slider_unoslider_vertical_blocks',
               'min' => 0,
               'max' => 30,
               'step' => 1,
               'type' => 'slider_control',
               'std' => 10),     
            
        array( 'name' => __('Horizontal blocks', 'yiw'),
               'desc' => __('Select the number of blocks in horizontal.', 'yiw'),
               'id' => 'slider_unoslider_horizontal_blocks',
               'min' => 0,
               'max' => 30,
               'step' => 1,
               'type' => 'slider_control',
               'std' => 4),       
         
        array( 'desc' => '<strong>' . __('Transitions / Animation', 'yiw') . '</strong>',
        	   'type' => 'simple-text'),    

        array( "name" => __("Use preset", 'yiw'),
               "desc" => __("You can select an animation preset or configure a own configuration.", 'yiw'),
               "id" => 'slider_unoslider_use_preset',
               'options' => array(
                    0 => __( 'No', 'yiw' ),
                    1 => __( 'Yes', 'yiw' ),
               ),
               "type" => "select",
               "std" => 1),      
            
        array( 'name' => __('Animation', 'yiw'),
               'desc' => __("You can choose more than one animation to use randomly in the slider. If you want to use all randomly, don't select any effect.", 'yiw'),
               'id' => 'slider_unoslider_preset',
               'options' => ! empty( $yiw_unoslider_animations ) ? $yiw_unoslider_animations : array(),
               'type' => 'multiselect',   
               'deps' => array(
                    'id' => 'slider_unoslider_use_preset',
                    'value' => 1
               ),
               'std' => array()),        
            
        array( 'name' => __('Transition Speed (ms)', 'yiw'),
               'desc' => __('Select the speed of transiction between slides, expressed in seconds.', 'yiw'),
               'id' => 'slider_unoslider_speed',
               'min' => 200,
               'max' => 2000,
               'step' => 10,
               'type' => 'slider_control',   
               'deps' => array(
                    'id' => 'slider_unoslider_use_preset',
                    'value' => 0
               ),
               'std' => 500),    
            
        array( 'name' => __('Delay between blocks (ms)', 'yiw'),
               'desc' => __('Select the delay between the blocks.', 'yiw'),
               'id' => 'slider_unoslider_delay_blocks',
               'min' => 0,
               'max' => 500,
               'step' => 10,
               'type' => 'slider_control',    
               'deps' => array(
                    'id' => 'slider_unoslider_use_preset',
                    'value' => 0
               ),
               'std' => 50),    
         
        array( 'name' => __('Transition', 'yiw'),
               'desc' => __('Select the effect you want for slides transiction.', 'yiw'),
               'id' => 'slider_unoslider_transition',
               'type' => 'select',
               'options' => array(
                                'grow' => 'grow',
                                'swap' => 'swap',
                                'stretch' => 'stretch',
                                'squeeze' => 'squeeze',
                                'shrink' => 'shrink',
                                'slide_in' => 'slide_in',
                                'slide_out' => 'slide_out',
                                'drop' => 'drop',
                                'appear' => 'appear',
                                'flash' => 'flash',
                                'fade' => 'fade'
                            ),             
               'deps' => array(
                    'id' => 'slider_unoslider_use_preset',
                    'value' => 0
               ),
               'std' => 'grow'),  
         
        array( 'name' => __('Variation', 'yiw'),
               'desc' => __('Select the variation for slides transiction.', 'yiw'),
               'id' => 'slider_unoslider_variation',
               'type' => 'select',
               'options' => array(
                                'topleft' => 'topleft',
                                'topright' => 'topright',
                                'bottomleft' => 'bottomleft',
                                'bottomright' => 'bottomright'
                            ),              
               'deps' => array(
                    'id' => 'slider_unoslider_use_preset',
                    'value' => 0
               ),
               'std' => 'topleft'), 
         
        array( 'name' => __('Pattern', 'yiw'),
               'desc' => __('Select the pattern for slides transiction.', 'yiw'),
               'id' => 'slider_unoslider_pattern',
               'type' => 'select',
               'options' => array(
                                'diagonal' => 'diagonal',
                                'horizontal' => 'horizontal',
                                'vertical' => 'vertical',
                                'random' => 'random',
                                'spiral' => 'spiral',
                                'horizontal_zigzag' => 'horizontal_zigzag',
                                'vertical_zigzag' => 'vertical_zigzag',
                                'chess' => 'chess','explode' => 'explode',
                                'implode' => 'implode',
                                'example' => 'example'
                            ),        
               'deps' => array(
                    'id' => 'slider_unoslider_use_preset',
                    'value' => 0
               ),
               'std' => 'random'),   
         
        array( 'name' => __('Direction', 'yiw'),
               'desc' => __('Select the direction for slides transiction.', 'yiw'),
               'id' => 'slider_unoslider_direction',
               'type' => 'select',
               'options' => array(
                                'center' => 'center',
                                'top' => 'top',
                                'left' => 'left',
                                'bottom' => 'bottom',
                                'right' => 'right',
                            ),        
               'deps' => array(
                    'id' => 'slider_unoslider_use_preset',
                    'value' => 0
               ),
               'std' => 'center'),    
            
        array( 'type' => 'close')
    ),             
    
    'settings-elastic' => array(    
        array( 'name' => __('Slider Settings', 'yiw'),
               'type' => 'section'),
        array( 'type' => 'open'),    
            
        array( 'name' => __('Height of slider', 'yiw'),
               'desc' => __('Select the height of the slider, in base of the images that you want to add.', 'yiw'),
               'id' => 'slider_elastic_height',
               'type' => 'text',
               'std' => 400),     
            
        array( 'name' => __('Autoplay', 'yiw'),
               'desc' => __('Select if you want that the slider change the slide automatically.', 'yiw'),
               'id' => 'slider_elastic_autoplay',
               'type' => 'on-off',
               'std' => 1),     
            
        array( 'name' => __('Animation', 'yiw'),
               'desc' => __('Animation types -> "sides" : new slides will slide in from left / right; "center": new slides will appear in the center.', 'yiw'),
               'id' => 'slider_elastic_animation',
               'type' => 'select',
               'options' => array(
                    'sides' => __( 'Sides', 'yiw' ),
                    'center' => __( 'Center', 'yiw' )
               ),
               'std' => 'slide'),     
            
        array( 'name' => __('Speed (s)', 'yiw'),
               'desc' => __('Select the speed of transiction between slides, expressed in seconds.', 'yiw'),
               'id' => 'slider_elastic_speed',
               'min' => 0,
               'max' => 5,
               'step' => 0.1,
               'type' => 'slider_control',
               'std' => 0.8),  
            
        array( 'name' => __('Timeout (s)', 'yiw'),
               'desc' => __('Select the delay between slides, expressed in seconds.', 'yiw'),
               'id' => 'slider_elastic_timeout',
               'min' => 0,
               'max' => 20,
               'step' => 0.5,
               'type' => 'slider_control',
               'std' => 3),     
            
        array( 'type' => 'close')
    ),   

/*
    'settings-carousel' => array(    
        array( 'name' => __('Slider Settings', 'yiw'),
               'type' => 'section'),
        array( 'type' => 'open'),  
         
        array( 'name' => __('Speed (s)', 'yiw'),
               'desc' => __('Specifies how many seconds to periodically autoscroll the content. If set to 0 then autoscrolling is turned off. ', 'yiw'),
               'id' => 'slider_' . $yiw_slider . '_auto',
               'min' => 0,
               'max' => 5,
               'step' => 1,
               'type' => 'slider_control',
               'std' => 2),  
            
        array( 'name' => __('Animation (s)', 'yiw'),
               'desc' => __('Select the speed of the scroll animation.', 'yiw'),
               'id' => 'slider_' . $yiw_slider . '_animation',
               'min' => 0,
               'max' => 5,
               'step' => 0.1,
               'type' => 'slider_control',
               'std' => 1.6),     
            
        array( 'type' => 'close')
    ),          
*/

    'slides' => array(    
        array( 'name' => __('Slides', 'yiw'),
               'type' => 'section',
               'valueButton' => __('Add/Edit Slide', 'yiw'),
               'effect' => 0),
        array( 'type' => 'open'),  
         
        array( 'id' => 'slider_' . $yiw_slider . '_slides',
               'data' => 'array',
               'type' => 'slides-table',
               'config' => $slide_config,
               'max-height' => 180 ),   
            
        array( 'type' => 'close')
    )        
    /* =================== END ARROW FADE SLIDER =================== */
 
);         

if ( ! function_exists( 'yiw_show_right_sliders_settings' ) ) {
    function yiw_show_right_sliders_settings() {
        global $yiw_options;                       
        
        if ( ! isset( $yiw_options['sliders'] ) )
            return;
        
        $slider = yiw_get_option( 'slider_choosen', 'sheeva' );
        
        if ( $slider == 'none' || $slider == 'fixed-image' || $slider == 'layers' || $slider == 'minilayers' || $slider == 'carousel' )
        unset( $yiw_options['sliders']['slides'] );  
    
        foreach ( $yiw_options['sliders'] as $section => $options ) {
            if ( preg_match( '/settings-(.*)/', $section ) && $section != 'settings-' . $slider )
                unset( $yiw_options['sliders'][$section] );
        }  
    }
    add_action( 'yiw_before_render_panel', 'yiw_show_right_sliders_settings' );      
}   
?>