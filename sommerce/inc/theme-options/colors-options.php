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
        	   'std' => 'color-unit' ),        
        	
        array( 'name' => __('Body bg Color', 'yiw'),
        	   'desc' => __('Select the type of body background.', 'yiw'),
        	   'id' => 'body_bg_color',     
        	   'type' => 'color-picker',
        	   'std' => '#fff' ),            
        	
        array( 'name' => __('Body bg Image', 'yiw'),
        	   'desc' => __('Select the image of body background or if you want to upload a own bg image.', 'yiw') . '<br />' . __('NOTE: on the preview, to update the color informazione, you need to click on the preview, so the color will be updated with that selected above.', 'yiw'),
        	   'id' => 'body_bg_image',
        	   'id_colors' => 'body_bg_color',     
        	   'type' => 'bg_preview',
        	   'options' => array(                  
// 			   		'images/backgrounds/backgrounds/001.jpg' => __( 'Flowers 1', 'yiw' ),   
// 			   		'images/backgrounds/backgrounds/006.jpg' => __( 'Flowers 2', 'yiw' ),   
// 			   		'images/backgrounds/backgrounds/031.jpg' => __( 'Flowers 3', 'yiw' ),    
// 			   		'images/backgrounds/backgrounds/009.jpg' => __( 'Flowers 4', 'yiw' ),     
// 			   		'images/backgrounds/backgrounds/011.jpg' => __( 'Flowers 5', 'yiw' ), 
// 			   		'images/backgrounds/backgrounds/012.jpg' => __( 'Flowers 6', 'yiw' ),    
// 			   		'images/backgrounds/backgrounds/014.jpg' => __( 'Flowers 7', 'yiw' ), 
// 			   		'images/backgrounds/backgrounds/022.jpg' => __( 'Flowers 8', 'yiw' ),
// 			   		'images/backgrounds/backgrounds/032.jpg' => __( 'Flowers 9', 'yiw' ),    
// 			   		'images/backgrounds/backgrounds/015.jpg' => __( 'Flowers Black', 'yiw' ),  
// 			   		'images/backgrounds/backgrounds/018.jpg' => __( 'Flowers Blue', 'yiw' ),
// 			   		'images/backgrounds/backgrounds/019.jpg' => __( 'Flowers Black and light', 'yiw' ),
 			   		'images/backgrounds/backgrounds/020.jpg' => __( 'Flowers Gold and light', 'yiw' ),
// 			   		'images/backgrounds/backgrounds/021.jpg' => __( 'Flowers Red and light', 'yiw' ),    
// 			   		'images/backgrounds/backgrounds/030.jpg' => __( 'Painted Flowers', 'yiw' ),  
// 			   		//'images/backgrounds/backgrounds/007.jpg' => __( 'Abstract 1', 'yiw' ),       
// 			   		'images/backgrounds/backgrounds/029.jpg' => __( 'Abstract 2', 'yiw' ),
// 			   		'images/backgrounds/backgrounds/033.jpg' => __( 'Abstract 3', 'yiw' ),   
// 			   		'images/backgrounds/backgrounds/038.jpg' => __( 'Abstract 4', 'yiw' ),
// 			   		'images/backgrounds/backgrounds/039.jpg' => __( 'Abstract 5', 'yiw' ),
// 			   		'images/backgrounds/backgrounds/040.jpg' => __( 'Abstract 6', 'yiw' ),
// 			   		'images/backgrounds/backgrounds/041.jpg' => __( 'Abstract 7', 'yiw' ),  
// 			   		'images/backgrounds/backgrounds/034.jpg' => __( 'White', 'yiw' ),
 			   		'images/backgrounds/backgrounds/002.jpg' => __( 'Blue 1', 'yiw' ),       
// 			   		'images/backgrounds/backgrounds/008.jpg' => __( 'Blue 2', 'yiw' ),   
// 			   		'images/backgrounds/backgrounds/028.jpg' => __( 'Blue Grey', 'yiw' ),   
// 			   		'images/backgrounds/backgrounds/013.jpg' => __( 'Black 1', 'yiw' ),   
			   		'images/backgrounds/backgrounds/025.jpg' => __( 'Black 2', 'yiw' ),       
			   		'images/backgrounds/backgrounds/023.jpg' => __( 'Black Papyrus', 'yiw' ),
// 			   		'images/backgrounds/backgrounds/037.jpg' => __( 'Black Dirt', 'yiw' ),
// 			   		'images/backgrounds/backgrounds/003.jpg' => __( 'Black Wood', 'yiw' ),  
// 			   		'images/backgrounds/backgrounds/035.jpg' => __( 'Red Squares', 'yiw' ),
// 			   		'images/backgrounds/backgrounds/004.jpg' => __( 'Red Wood', 'yiw' ),
// 			   		'images/backgrounds/backgrounds/005.jpg' => __( 'Natural Wood', 'yiw' ),
// 			   		'images/backgrounds/backgrounds/010.jpg' => __( 'Birds', 'yiw' ),
// 			   		'images/backgrounds/backgrounds/016.jpg' => __( 'Stripes', 'yiw' ),
// 			   		'images/backgrounds/backgrounds/024.jpg' => __( 'Paper 1', 'yiw' ),
// 			   		'images/backgrounds/backgrounds/026.jpg' => __( 'Paper 2', 'yiw' ),
// 			   		'images/backgrounds/backgrounds/027.jpg' => __( 'Tissue', 'yiw' ),
// 			   		'images/backgrounds/backgrounds/036.jpg' => __( 'Tiles', 'yiw' ),
// 			   		'images/backgrounds/backgrounds/tx10.jpg' => __( 'Metallic 1', 'yiw' ),
// 			   		'images/backgrounds/backgrounds/tx13.jpg' => __( 'Metallic Flowers', 'yiw' ),
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
			   		'custom' => __( 'Custom', 'yiw' ),
			   ),
        	   'deps' => array(
			   		'id' => 'body_bg_type',
			   		'value' => 'bg-image'
			   ),
        	   'std' => '' ), 
        	
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
			   		'id' => 'body_bg_image',
			   		'value' => 'custom'
			   ),
        	   'std' => 'no-repeat' ),  
        	
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
			   		'id' => 'body_bg_image',
			   		'value' => 'custom'
			   ),
        	   'std' => 'bottom center' ),  
        	
        array( 'name' => __('Body bg Image Attachment', 'yiw'),
        	   'desc' => __('The attachment of the background image.', 'yiw'),
        	   'id' => 'body_bg_image_custom_attachment',     
        	   'type' => 'select',
        	   'options' => array(          
			   		'scroll' => __( 'Scroll', 'yiw' ),
			   		'fixed' => __( 'Fixed', 'yiw' ),
			   ),
        	   'deps' => array(
			   		'id' => 'body_bg_image',
			   		'value' => 'custom'
			   ),
        	   'std' => 'scroll' ),             
        	
        array( 'name' => __('Content background', 'yiw'),
        	   'desc' => __('Select the background of the content wrapper.', 'yiw'),
        	   'id' => 'content_bg_color',     
        	   'type' => 'color-picker',
        	   'std' => '#fff' ),  
        	
        array( "type" => "close")
	),     
 
); 

yiw_retrieve_color_options( $yiw_options['colors'] );

function yiw_remove_navigation_settings() {
    global $yiw_options;
    
    if ( yiw_get_option( 'nav_type', 'elegant' ) == 'elegant' )
        unset( $yiw_options['colors']['creative-navigation'] );
    elseif ( yiw_get_option( 'nav_type', 'elegant' ) == 'creative' )   
        unset( $yiw_options['colors']['elegant-navigation'] );
        
    if ( yiw_get_option( 'theme_layout', 'stretched' ) == 'stretched' ) {
        unset( $yiw_options['colors']['body-background'][4], $yiw_options['colors']['body-background'][9] );
        $yiw_options['colors']['body-background'][5]['deps'] = array( 'id' => 'body_bg_type', 'value' => 'bg-image' ); 
        $yiw_options['colors']['body-background'][6]['deps'] = array( 'id' => 'body_bg_type', 'value' => 'bg-image' ); 
        $yiw_options['colors']['body-background'][7]['deps'] = array( 'id' => 'body_bg_type', 'value' => 'bg-image' ); 
        $yiw_options['colors']['body-background'][8]['deps'] = array( 'id' => 'body_bg_type', 'value' => 'bg-image' );
    }
}                          
add_action( 'yiw_before_render_panel', 'yiw_remove_navigation_settings' );

?>