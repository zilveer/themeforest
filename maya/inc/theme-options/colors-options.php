<?php               
    
$yiw_options['colors'] = array (         
    
    /* =================== COLORS =================== */
    'title' => array(    
        array( 'name' => __('Colors Settings', 'yiw'),
               'type' => 'title'),   
    ), 
                                  
    "body-background" => array(    
        array( "name" => __("Body Background", 'yiw'), 
               "type" => "section"),
        array( "type" => "open"),          
            
        array( 'name' => __('Body Background', 'yiw'),
               'desc' => __('Select the type of body background.', 'yiw'),
               'id' => 'body_bg_type',     
               'type' => 'select',
               'options' => array(
                    'color-unit' => __( 'Color Unit', 'yiw' ),
                    'bg-image' => __( 'Image', 'yiw' )
               ),
               'std' => 'bg-image' ),        
            
        array( 'name' => __('Body bg Color', 'yiw'),
               'desc' => __('Select the background color of body.', 'yiw'),
               'id' => 'body_bg_color',     
               'type' => 'color-picker',
               'std' => '#fff' ),            
            
        array( 'name' => __('Body bg Image', 'yiw'),
               'desc' => __('Select the image of body background or if you want to upload a own bg image.', 'yiw') . '<br />' . __('NOTE: on the preview, to update the color informazione, you need to click on the preview, so the color will be updated with that selected above.', 'yiw'),
               'id' => 'body_bg_image',
               'id_colors' => 'body_bg_color',     
               'type' => 'bg_preview',  
        	   'options' => array(                    
			   		'custom' => __( 'Custom', 'yiw' ),
// 			   		'images/backgrounds/backgrounds/001.jpg' => __( 'Background 1', 'yiw' ),  
// 			   		'images/backgrounds/backgrounds/002.jpg' => __( 'Background 2', 'yiw' ),  
// 			   		'images/backgrounds/backgrounds/003.jpg' => __( 'Background 3', 'yiw' ),  
// 			   		'images/backgrounds/backgrounds/004.jpg' => __( 'Background 4', 'yiw' ),  
// 			   		'images/backgrounds/backgrounds/005.jpg' => __( 'Background 5', 'yiw' ),  
// 			   		'images/backgrounds/backgrounds/006.jpg' => __( 'Background 6', 'yiw' ),  
// 			   		'images/backgrounds/backgrounds/007.jpg' => __( 'Background 7', 'yiw' ), 
 			   		'images/backgrounds/backgrounds/008.jpg' => __( 'Background 8', 'yiw' ),  
// 			   		'images/backgrounds/backgrounds/045.jpg' => __( 'Background 45', 'yiw' ),  
// 			   		'images/backgrounds/backgrounds/009.jpg' => __( 'Background 9', 'yiw' ),  
// 			   		'images/backgrounds/backgrounds/046.jpg' => __( 'Background 10', 'yiw' ),  
// 			   		'images/backgrounds/backgrounds/011.jpg' => __( 'Background 11', 'yiw' ),  
// 			   		'images/backgrounds/backgrounds/012.jpg' => __( 'Background 12', 'yiw' ),  
// 			   		'images/backgrounds/backgrounds/013.jpg' => __( 'Background 13', 'yiw' ),  
// 			   		'images/backgrounds/backgrounds/014.jpg' => __( 'Background 14', 'yiw' ),  
 			   		'images/backgrounds/backgrounds/015.jpg' => __( 'Background 15', 'yiw' ),  
// 			   		'images/backgrounds/backgrounds/016.jpg' => __( 'Background 16', 'yiw' ),  
// 			   		'images/backgrounds/backgrounds/017.jpg' => __( 'Background 17', 'yiw' ),  
// 			   		'images/backgrounds/backgrounds/018.jpg' => __( 'Background 18', 'yiw' ),  
 			   		'images/backgrounds/backgrounds/019.jpg' => __( 'Background 19', 'yiw' ),  
// 			   		'images/backgrounds/backgrounds/020.jpg' => __( 'Background 20', 'yiw' ),
//                                         'images/backgrounds/backgrounds/021.jpg' => __( 'Background 21', 'yiw' ),  
// 			   		'images/backgrounds/backgrounds/022.jpg' => __( 'Background 22', 'yiw' ),  
// 			   		'images/backgrounds/backgrounds/023.jpg' => __( 'Background 23', 'yiw' ),  
// 			   		'images/backgrounds/backgrounds/024.jpg' => __( 'Background 24', 'yiw' ),  
// 			   		'images/backgrounds/backgrounds/025.jpg' => __( 'Background 25', 'yiw' ),  
// 			   		'images/backgrounds/backgrounds/026.jpg' => __( 'Background 26', 'yiw' ),  
// 			   		'images/backgrounds/backgrounds/027.jpg' => __( 'Background 27', 'yiw' ),  
// 			   		'images/backgrounds/backgrounds/028.jpg' => __( 'Background 28', 'yiw' ),  
// 			   		'images/backgrounds/backgrounds/029.jpg' => __( 'Background 29', 'yiw' ),  
// 			   		'images/backgrounds/backgrounds/047.jpg' => __( 'Background 30', 'yiw' ),  
// 			   		'images/backgrounds/backgrounds/031.jpg' => __( 'Background 31', 'yiw' ),  
 			   		'images/backgrounds/backgrounds/032.jpg' => __( 'Background 32', 'yiw' ),  
// 			   		'images/backgrounds/backgrounds/033.jpg' => __( 'Background 33', 'yiw' ),  
// 			   		'images/backgrounds/backgrounds/034.jpg' => __( 'Background 34', 'yiw' ),  
// 			   		'images/backgrounds/backgrounds/035.jpg' => __( 'Background 35', 'yiw' ),  
// 			   		'images/backgrounds/backgrounds/036.jpg' => __( 'Background 36', 'yiw' ),  
// 			   		'images/backgrounds/backgrounds/037.jpg' => __( 'Background 37', 'yiw' ),  
// 			   		'images/backgrounds/backgrounds/038.jpg' => __( 'Background 38', 'yiw' ),  
// 			   		'images/backgrounds/backgrounds/039.jpg' => __( 'Background 39', 'yiw' ),  
// 			   		'images/backgrounds/backgrounds/040.jpg' => __( 'Background 40', 'yiw' ),
//                                         'images/backgrounds/backgrounds/041.jpg' => __( 'Background 41', 'yiw' ),
//                                         'images/backgrounds/backgrounds/042.jpg' => __( 'Background 42', 'yiw' ),
//                                         'images/backgrounds/backgrounds/043.jpg' => __( 'Background 43', 'yiw' ),
//                                         'images/backgrounds/backgrounds/044.jpg' => __( 'Background 44', 'yiw' ),
// 			   		'images/backgrounds/patterns/bg_t_3.png' => __( 'Pattern 1', 'yiw' ),
// 			   		'images/backgrounds/patterns/bg_t_7.png' => __( 'Pattern 2', 'yiw' ),
// 			   		'images/backgrounds/patterns/bg_t_10.png' => __( 'Pattern 3', 'yiw' ),
// 			   		'images/backgrounds/patterns/bg_t_11.png' => __( 'Pattern 4', 'yiw' ),
// 			   		'images/backgrounds/patterns/bgNoiseHatch.png' => __( 'Pattern 5', 'yiw' ),
// 			   		'images/backgrounds/patterns/bg-page.png' => __( 'Pattern 6', 'yiw' ),
// 			   		'images/backgrounds/patterns/bgStripeNoise.png' => __( 'Pattern 7', 'yiw' ),
// 			   		'images/backgrounds/patterns/circle_pattern.png' => __( 'Pattern 8', 'yiw' ),
// 			   		'images/backgrounds/patterns/diagonal-line1.png' => __( 'Pattern 9', 'yiw' ),
// 			   		'images/backgrounds/patterns/diagonal-line2.png' => __( 'Pattern 10', 'yiw' ),   
// 			   		'images/backgrounds/patterns/flower_pattern.png' => __( 'Pattern 11', 'yiw' ),
// 			   		'images/backgrounds/patterns/flower6_pattern.png' => __( 'Pattern 12', 'yiw' ),
// 			   		'images/backgrounds/patterns/flower-swirl4.png' => __( 'Pattern 13', 'yiw' ),
// 			   		'images/backgrounds/patterns/flower-swirl10.png' => __( 'Pattern 14', 'yiw' ),
// 			   		'images/backgrounds/patterns/grid3.png' => __( 'Pattern 15', 'yiw' ),
// 			   		'images/backgrounds/patterns/horizontal-line1.png' => __( 'Pattern 16', 'yiw' ),
// 			   		'images/backgrounds/patterns/img-bg.png' => __( 'Pattern 17', 'yiw' ),
// 			   		'images/backgrounds/patterns/mozaic2.png' => __( 'Pattern 18', 'yiw' ),
// 			   		'images/backgrounds/patterns/pattern9.png' => __( 'Pattern 19', 'yiw' ), 
// 			   		'images/backgrounds/patterns/pattern10.png' => __( 'Pattern 20', 'yiw' ),   
// 			   		'images/backgrounds/patterns/pattern19.png' => __( 'Pattern 21', 'yiw' ),
// 			   		'images/backgrounds/patterns/pixelite.png' => __( 'Pattern 22', 'yiw' ),
// 			   		'images/backgrounds/patterns/right_strip_pattern.png' => __( 'Pattern 23', 'yiw' ),
// 			   		'images/backgrounds/patterns/scan-lines.png' => __( 'Pattern 24', 'yiw' ), 
			   ),
               'deps' => array(
                    'id' => 'body_bg_type',
                    'value' => 'bg-image'
               ),
               'std' => 'images/backgrounds/backgrounds/019.jpg' ), 
            
        array( 'name' => __('Body bg Image Custom', 'yiw'),
               'desc' => __('Upload your background image.', 'yiw'),
               'id' => 'body_bg_image_custom',     
               'type' => 'upload',
               'deps' => array(
                    'id' => 'body_bg_image',
                    'value' => 'custom'
               ),
               'std' => '' ),    
            
        array( 'name' => __('Body bg Image Repeat', 'yiw'),
               'desc' => __('The repeat attribute of body image uploaded above.', 'yiw'),
               'id' => 'body_bg_image_custom_repeat',     
               'type' => 'select',
               'options' => array(                          
                    'repeat' => __( 'Repeat', 'yiw' ),
                    'repeat-x' => __( 'Repeat Horizontally', 'yiw' ),
                    'repeat-y' => __( 'Repeat Vertically', 'yiw' ),
                    'no-repeat' => __( 'No Repeat', 'yiw' ),
               ),
               'deps' => array(
                    'id' => 'body_bg_type',
                    'value' => 'bg-image'
               ),
               'std' => 'repeat' ),  
            
        array( 'name' => __('Body bg Image Position', 'yiw'),
               'desc' => __('The position attribute of body image uploaded above.', 'yiw'),
               'id' => 'body_bg_image_custom_position',     
               'type' => 'select',
               'options' => array(          
                    'center' => __( 'Center', 'yiw' ),
                    'top left' => __( 'Top left', 'yiw' ),
                    'top center' => __( 'Top center', 'yiw' ),
                    'top right' => __( 'Top right', 'yiw' ),
                    'bottom left' => __( 'Bottom left', 'yiw' ),
                    'bottom center' => __( 'Bottom center', 'yiw' ),
                    'bottom right' => __( 'Bottom right', 'yiw' ),
               ),
               'deps' => array(
                    'id' => 'body_bg_type',
                    'value' => 'bg-image'
               ),
               'std' => 'top center' ),  
            
        array( 'name' => __('Body bg Image Attachment', 'yiw'),
               'desc' => __('The attachment of the background image.', 'yiw'),
               'id' => 'body_bg_image_custom_attachment',     
               'type' => 'select',
               'options' => array(          
                    'scroll' => __( 'Scroll', 'yiw' ),
                    'fixed' => __( 'Fixed', 'yiw' ),
               ),
               'deps' => array(
                    'id' => 'body_bg_type',
                    'value' => 'bg-image'
               ),
               'std' => 'fixed' ),     

            
        array( "type" => "close")
    ),     
 
); 

yiw_retrieve_color_options( $yiw_options['colors'] );

?>