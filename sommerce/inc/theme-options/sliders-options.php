<?php    
                         
$yiw_slider = yiw_get_option( 'slider_choosen', 'elegant' );      

$yiw_sliders = array(
	'none'         => __( 'None', 'yiw' ),
	'fixed-image'  => __( 'Fixed Image', 'yiw' ),
	'elegant'      => __( 'Elegant', 'yiw' ),
	'flash'        => __( 'Flash', 'yiw' ),
	'rotating'     => __( 'Rotating', 'yiw' ),
	'thumbnails'   => __( 'With Thumbnails', 'yiw' ),
	'nivo'         => __( 'Nivo', 'yiw' ),
	'cycle'        => __( 'Cycle', 'yiw' )
);      

// configuration slides
switch ( $yiw_slider ) {
	case 'elegant' :
		$slide_config = 'title, image, caption, link';
		break;
	case 'flash' :
		$slide_config = 'title, image, caption, link';
		break;
	case 'rotating' :       
		$slide_config = 'title, image';
		break;
	case 'thumbnails' :       
		$slide_config = 'image, caption, tooltip, link';
		break;    
	case 'cycle' :
		$slide_config = 'title, image, caption, link, video';
		break;   
	case 'nivo' :
		$slide_config = 'image, link';
		break;
	default :
		$slide_config = 'title, image, caption, link';
		break;
}

$yiw_default_slider = 'elegant';
$yiw_default_slider_config = array(
    array(
        'order' => 0,
        'slide_title' => 'interior design',
        'tooltip_content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec pulvinar turpis velit. Morbi rutrum, neque non pulvinar faucibus, ligula eros viverra ligula, et aliquam libero neque ac nisl. 

[special_font size="24"]prices from [size px="42"]$45[/size][/special_font]',
        'content_type' => 'image',
        'image_url' => get_template_directory_uri() . '/images/slider/001.jpg',
        'link_type' => 'none'
    ),
    array(          
        'order' => 1,
        'slide_title' => 'Luxury gold',
        'tooltip_content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec pulvinar turpis velit. Morbi rutrum, neque non pulvinar faucibus, ligula eros viverra ligula, et aliquam libero neque ac nisl. ',
        'content_type' => 'image',
        'image_url' => get_template_directory_uri() . '/images/slider/002.jpg',
        'link_type' => 'none'
    ),
    array(         
        'order' => 2,
        'slide_title' => 'Gold Parquet',
        'tooltip_content' => 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum

[special_font size="24"]prices from [size px="42"]$37[/size][/special_font]',
        'content_type' => 'image',
        'image_url' => get_template_directory_uri() . '/images/slider/003.jpg',
        'link_type' => 'none'
    ),
);

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
        	   'desc' => __('Select the default header type for homepage pages.', 'yiw') . ' <br />NB: ' . sprintf( __('for "Fixed Image", you can configure it on %s -> %s.', 'yiw' ), __( 'Appearance' ), __( 'Header' ) ),
        	   'id' => 'slider_type',
        	   'type' => 'radio',
        	   'options' => $yiw_sliders,
        	   'std' => $yiw_default_slider ),             
         
        array( 'name' => __('Configure slider.', 'yiw'),
        	   'id' => 'slider_choosen',       
        	   'desc' => __('Choose a slider and save, to configure below your slider choosen.', 'yiw'),
        	   'type' => 'select',
			   'options' => $yiw_sliders,
        	   'button' => __( 'Configure', 'yiw' ),
			   'std' => $yiw_default_slider ),            
         
        array( 'name' => __('Responsive Behavior', 'yiw'),
        	   'id' => 'slider_responsive',       
        	   'desc' => __('Say what you want to do when the website is loaded by lower resolution screen.', 'yiw'),
        	   'type' => 'select',
			   'options' => array(                               
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
        	
        array( 'name' => __('Width', 'yiw'),
        	   'desc' => __('Select the width of the slider.', 'yiw'),
        	   'id' => 'slider_thumbnails_width',
        	   'min' => 1,
        	   'max' => 960,
        	   'step' => 1,
        	   'type' => 'slider_control',
        	   'std' => 960), 	
        	
        array( 'name' => __('Height', 'yiw'),
        	   'desc' => __('Select the height of the slider.', 'yiw'),
        	   'id' => 'slider_thumbnails_height',
        	   'min' => 1,
        	   'max' => 600,
        	   'step' => 1,
        	   'type' => 'slider_control',
        	   'std' => 350),  
         
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
                                                    
    'settings-rotating' => array(    
    
        array( 'name' => __('Rotating Slider Settings', 'yiw'),
        	   'type' => 'section'),
        array( 'type' => 'open'),  
         
        array( 'name' => __('Slider Title', 'yiw'),
        	   'desc' => __("The title that appears above slides (leave empty if you don't want this title).", 'yiw'),
        	   'id' => 'slider_rotating_title',
        	   'type' => 'text',
			   'std' => __( 'Fashion Explosion 2012', 'yiw' ) ),
         
        array( 'name' => __('Number of panel', 'yiw'),
        	   'desc' => __('Number of panels for each slide.', 'yiw'),
        	   'id' => 'slider_rotating_n_panels',
        	   'type' => 'slider_control',
        	   'min' => 2,
        	   'max' => 5,
			   'std' => 4 ),
			   
		array( 'name' => __('Speed (s)', 'yiw'),
        	   'desc' => __('Difference of animation time between the items.', 'yiw'),
        	   'id' => 'slider_rotating_speed1',
        	   'min' => 0,
        	   'max' => 5,
        	   'step' => 0.1,
        	   'type' => 'slider_control',
        	   'std' => 0.2), 
			   
		array( 'name' => __('Speed (s)', 'yiw'),
        	   'desc' => __('Time between each image animation (slideshow)', 'yiw'),
        	   'id' => 'slider_rotating_speed2',
        	   'min' => 0,
        	   'max' => 20,
        	   'step' => 0.1,
        	   'type' => 'slider_control',
        	   'std' => 7), 

        array( 'type' => 'close')
    ),                      

    'settings-nivo' => array(    
        array( 'name' => __('Slider Settings', 'yiw'),
               'type' => 'section'),
        array( 'type' => 'open'),  
         
        array( 'name' => __('Effect', 'yiw'),
               'desc' => __('Select the effect you want for slides transiction.', 'yiw'),
               'id' => 'slider_nivo_effect',
               'type' => 'select',
               'options' => isset( $yiw_nivo_fxs ) ? $yiw_nivo_fxs : array(),
               'std' => 'random'),    
            
        array( 'name' => __('Speed (s)', 'yiw'),
               'desc' => __('Select the speed of transiction between slides, expressed in seconds.', 'yiw'),
               'id' => 'slider_nivo_speed',
               'min' => 0,
               'max' => 5,
               'step' => 0.1,
               'type' => 'slider_control',
               'std' => 0.5),  
            
        array( 'name' => __('Timeout (s)', 'yiw'),
               'desc' => __('Select the delay between slides, expressed in seconds.', 'yiw'),
               'id' => 'slider_nivo_timeout',
               'min' => 0,
               'max' => 20,
               'step' => 0.5,
               'type' => 'slider_control',
               'std' => 5),     

        array( "name" => __("Next & Prev navigation", 'yiw'),
               "desc" => __("Choose if you want to show Next & Prev arrows", 'yiw'),
               "id" => 'slider_nivo_directionNav',
               "type" => "on-off",
               "std" => 1),
            
        array( "name" => __("Next & Prev navigation only on hover", 'yiw'),
               "desc" => __("Choose if you want to show Next & Prev arrows only on hover", 'yiw'), 
               "id" => 'slider_nivo_directionNavHide',
               "type" => "on-off",
               "std" => 1),
            
        array( "name" => __("Enable Bullets", 'yiw'),
               "desc" => __("Choose if you want to show bullets navigation below the slider", 'yiw'),
               "id" => 'slider_nivo_controlNav',
               "type" => "on-off",
               "std" => 0),
            
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
			   'max-height' => 180,
               'std' => serialize( $yiw_default_slider_config ) ),	
        	
        array( 'type' => 'close')
    )        
    /* =================== END ARROW FADE SLIDER =================== */
 
);         

function yiw_show_right_settings() {
    global $yiw_options;
    
    if ( ! isset( $yiw_options['sliders'] ) )
        return;
    
    $slider = yiw_get_option( 'slider_choosen', 'elegant' );
    
    if ( $slider == 'none' || $slider == 'fixed-image' )
    	unset( $yiw_options['sliders']['slides'] );          
    
    foreach ( $yiw_options['sliders'] as $section => $options ) {
    	if ( preg_match( '/settings-(.*)/', $section ) && $section != 'settings-' . $slider )
    		unset( $yiw_options['sliders'][$section] );
    }     
}
add_action( 'yiw_before_render_panel', 'yiw_show_right_settings' );
   
?>