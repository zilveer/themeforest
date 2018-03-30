<?php
/**
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */ 
 
global $yit;
 
yit_register_slider_style(  $slider_type, 'slider-flash', 'css/flash.css' );
yit_register_slider_script( $slider_type, 'swfobject' );  

// set here if the slider is reponsive or not
$this->responsive_sliders[ $slider_type ] = false;

// add support to slide
yit_add_slide_support( $slider_type, 'title, content-editor, link' );
 
// add the slider fields for the admin
yit_add_slider_config( $slider_type, array(
    array(
        'name' => __( 'Width content', 'yit' ),
        'id' => 'width',
        'type' => 'number',        
        'desc' => __( 'Select the width of container (default is 1170).', 'yit' ),
        'min' => 0,
        'max' => 2000,
        'std' => 1170
    ),
    array(
        'name' => __( 'Height content', 'yit' ),
        'id' => 'height',
        'type' => 'number',        
        'desc' => __( 'Select the height of container.', 'yit' ),
        'min' => 10,
        'max' => 2000,
        'std' => 395
    ),
    array( 'type' => 'sep' ),  
    
    // TRANSITIONS
    array(
        'type' => 'simple-text',        
        'desc' => '<b>' . __( 'Transitions', 'yit' ) . '</b>'
    ),  
	array( 	"name" => __( 'Pieces', 'yit' ),
			"desc" => __( 'Number of pieces to which the image is sliced', 'yit' ),
			"id" => "Pieces",
			"type" => "slider",
			"min" => 0,
			"max" => 40,
			"std" => 9),
	
	array( 	"name" => __( 'Time', 'yit' ),
			"desc" => __( 'Time for one cube to turn (expressed in seconds).', 'yit' ),
			"id" => "Time",
			"type" => "slider",
			"min" => 0,
			"max" => 5,
			"step" => 0.1,
			"std" => 1),
	
	array( 	"name" => __( 'Transition', 'yit' ),
			"desc" => __( 'Transition type of the Tweener class', 'yit' ),
			"id" => "Transition",
			"type" => "select",
			"options" => $yit->getConfigEasings(),
			"std" => "easeInOutBack"),    
	
	array( 	"name" => __( 'Depth Offset', 'yit' ),
			"desc" => __( 'The offset during transition on the z-axis. Value between 100 and 1000 are recommended.', 'yit' ),
			"id" => "DepthOffset",
			"type" => "slider",
			"min" => 100,
			"max" => 1000,
			"step" => 50,
			"std" => 300), 
	
	array( 	"name" => __( 'Cube Distance', 'yit' ),
			"desc" => __( 'The distance between the cubes during transition. Values between 5 and 50 are recommended.', 'yit' ),
			"id" => "CubeDistance",
			"type" => "slider",
			"min" => 5,
			"max" => 50,
			"std" => 30),   
    array( 'type' => 'sep' ),  
    
    // GENERAL CONFIGURATION
    array(
        'type' => 'simple-text',        
        'desc' => '<b>' . __( 'General Configuration', 'yit' ) . '</b>'
    ),   
	
	array( 	"name" => __( 'Loader Color', 'yit' ),
			"desc" => __( 'Color of the cubes before the first image appears, also the color of the back sides of the cube, which become visible at some transition types', 'yit' ),
			"id" => "LoaderColor",
			"type" => "colorpicker",
			"std" => "#333333"),
	
	array( 	"name" => __( 'Inner Side Color', 'yit' ),
			"desc" => __( 'Color of the inner sides of the cube when sliced', 'yit' ),
			"id" => "InnerSideColor",
			"type" => "colorpicker",
			"std" => "#222222"),    
	
	array( 	"name" => __( 'Autoplay', 'yit' ),
			"desc" => __( 'Number of seconds from one transition to another, if not stopped. Set to 0 to disable autoplay', 'yit' ),
			"id" => "Autoplay",
			"type" => "slider",
			"min" => 0,
			"max" => 20,
			"label" => "s",
			"std" => 4),    
    array( 'type' => 'sep' ),  
    
    // SHADOW
    array(
        'type' => 'simple-text',        
        'desc' => '<b>' . __( 'Shadow', 'yit' ) . '</b>'
    ),   
    	              	
	array( 	"name" => __( 'Side Shadow Alpha', 'yit' ),
			"desc" => __( 'Sides get darker when moved away from the front. This is the degree of darkness - 0 == no change, 1 == 100% black.', 'yit' ),
			"id" => "SideShadowAlpha",
			"type" => "slider",
			"min" => 0,
			"max" => 1,
			"step" => 0.1,
			"std" => 0.8),
	
	array( 	"name" => __( 'Drop Shadow Alpha', 'yit' ),
			"desc" => __( 'Alpha of the drop shadow - 0 == no shadow, 1 == opaque', 'yit' ),
			"id" => "DropShadowAlpha",
			"type" => "slider",
			"min" => 0,
			"max" => 1,
			"step" => 0.1,
			"std" => 0.7),
	
	array( 	"name" => __( 'Drop Shadow Distance', 'yit' ),
			"desc" => __( 'Distance of the shadow from the bottom of the image', 'yit' ),
			"id" => "DropShadowDistance",
			"type" => "slider",
			"min" => 0,
			"max" => 100,
			"std" => 25),     
	
	array( 	"name" => __( 'Drop Shadow Scale', 'yit' ),
			"desc" => __( 'As the shadow is blurred, it appears wider that the actual image, when not resized. Thus it\'s a good idea to make it slightly smaller. - 1 would be no resizing at all.', 'yit' ),
			"id" => "DropShadowScale",
			"type" => "slider",
			"min" => 0,
			"max" => 1,
			"step" => 0.05,
			"std" => 0.95),
	
	array( 	"name" => __( 'Drop Shadow Blur X', 'yit' ),
			"desc" => __( 'Blur of the drop shadow on the x-axis', 'yit' ),
			"id" => "DropShadowBlurX",
			"type" => "slider",
			"min" => 0,
			"max" => 200,
			"std" => 40),
	
	array( 	"name" => __( 'Drop Shadow Blur Y', 'yit' ),
			"desc" => __( 'Blur of the drop shadow on the y-axis', 'yit' ),
			"id" => "DropShadowBlurY",
			"type" => "slider",
			"min" => 0,
			"max" => 200,
			"std" => 4),     
    array( 'type' => 'sep' ),  
    
    // SHADOW
    array(
        'type' => 'simple-text',        
        'desc' => '<b>' . __( 'Menu', 'yit' ) . '</b>'
    ),       
	
	array( 	"name" => __( 'Menu Distance X', 'yit' ),
			"desc" => __( 'Distance between two menu items (from center to center).', 'yit' ),
			"id" => "MenuDistanceX",
			"type" => "slider",
			"min" => 0,
			"max" => 400,
			"std" => 20),
	
	array( 	"name" => __( 'Menu Distance Y', 'yit' ),
			"desc" => __( 'Distance of the menu from the bottom of the image.', 'yit' ),
			"id" => "MenuDistanceY",
			"type" => "slider",
			"min" => 0,
			"max" => 400,
			"std" => 50),      
	
	array( 	"name" => __( 'Menu Color Inactive Item', 'yit' ),
			"desc" => __( 'Color of an inactive menu item.', 'yit' ),
			"id" => "MenuColor1",
			"type" => "colorpicker",
			"std" => "#999999"),
	
	array( 	"name" => __( 'Menu Color Active Item', 'yit' ),
			"desc" => __( 'Color of an active menu item.', 'yit' ),
			"id" => "MenuColor2",
			"type" => "colorpicker",
			"std" => "#333333"),
	
	array( 	"name" => __( 'Menu Color Inner Circle od Active Item', 'yit' ),
			"desc" => __( 'Color of the inner circle of an active menu item. Should equal the background color of the whole thing.', 'yit' ),
			"id" => "MenuColor3",
			"type" => "colorpicker",
			"std" => "#FFFFFF"),
    array( 'type' => 'sep' ),  
    
    // SHADOW
    array(
        'type' => 'simple-text',        
        'desc' => '<b>' . __( 'Controls', 'yit' ) . '</b>'
    ),       
	
	array( 	"name" => __( 'Control Size', 'yit' ),
			"desc" => __( 'Size of the controls, which appear on rollover (play, stop, info, link)', 'yit' ),
			"id" => "ControlSize",
			"type" => "slider",
			"min" => 0,
			"max" => 400,
			"step" => 10,
			"std" => 100),  
	
	array( 	"name" => __( 'Control Distance', 'yit' ),
			"desc" => __( 'Distance between the controls (from the borders).', 'yit' ),
			"id" => "ControlDistance",
			"type" => "slider",
			"min" => 0,
			"max" => 100,
			"std" => 20),         
	
	array( 	"name" => __( 'Bg Color', 'yit' ),
			"desc" => __( 'Background color of the controls', 'yit' ),
			"id" => "ControlColor1",
			"type" => "colorpicker",
			"std" => "#222222"),  
	
	array( 	"name" => __( 'Font Color', 'yit' ),
			"desc" => __( 'Font color of the controls', 'yit' ),
			"id" => "ControlColor2",
			"type" => "colorpicker",
			"std" => "#FFFFFF"),
	
	array( 	"name" => __( 'Control Alpha', 'yit' ),
			"desc" => __( 'Alpha of a control, when mouse is not over', 'yit' ),
			"id" => "ControlAlpha",
			"type" => "slider",
			"min" => 0,
			"max" => 1,
			"step" => 0.05,
			"std" => 0.8),
	
	array( 	"name" => __( 'Control Alpha Hover status', 'yit' ),
			"desc" => __( 'Alpha of a control, when mouse is hover.', 'yit' ),
			"id" => "ControlAlphaOver",
			"type" => "slider",
			"min" => 0,
			"max" => 1,
			"step" => 0.05,
			"std" => 0.95),
	
	array( 	"name" => __( 'Control X', 'yit' ),
			"desc" => __( 'X-position of the point, which aligns the controls (measured from [0,0] of the image)', 'yit' ),
			"id" => "ControlsX",
			"type" => "slider",
			"min" => 0,
			"max" => 1170,
			"step" => 10,
			"std" => 585),
	
	array( 	"name" => __( 'Control Y', 'yit' ),
			"desc" => __( 'Y-position of the point, which aligns the controls (measured from [0,0] of the image)', 'yit' ),
			"id" => "ControlsY",
			"type" => "slider",
			"min" => 0,
			"max" => 350,
			"step" => 10,
			"std" => 240),
	
	array( 	"name" => __( 'Controls Align', 'yit' ),
			"desc" => __( 'Type of alignment from the point [controlsX, controlsY]', 'yit' ),
			"id" => "ControlsAlign",
			"type" => "select",
			"options" => array( 
				'center' => __( 'center', 'yit' ),
				'left' => __( 'left', 'yit' ),
				'right' => __( 'right', 'yit' ), 
			),
			"std" => 'center'),   
    array( 'type' => 'sep' ),  
    
    // SHADOW
    array(
        'type' => 'simple-text',        
        'desc' => '<b>' . __( 'Tooltip', 'yit' ) . '</b>'
    ),     
	
	array( 	"name" => __( 'Tooltip Height', 'yit' ),
			"desc" => __( 'Height of the tooltip surface in the menu', 'yit' ),
			"id" => "TooltipHeight",
			"type" => "slider",
			"min" => 0,
			"max" => 200,
			"std" => 30),  
	
	array( 	"name" => __( 'Tooltip Color', 'yit' ),
			"desc" => __( 'Color of the tooltip surface in the menu', 'yit' ),
			"id" => "TooltipColor",
			"type" => "colorpicker",
			"std" => "#222222"),  
	
	array( 	"name" => __( 'Tooltip Text Y', 'yit' ),
			"desc" => __( 'Y-distance of the tooltip text field from the top of the tooltip', 'yit' ),
			"id" => "TooltipTextY",
			"type" => "slider",
			"min" => 0,
			"max" => 200,
			"std" => 5),          
	
	array( 	"name" => __( 'Tooltip Text Color', 'yit' ),
			"desc" => __( 'Color of the tooltip text', 'yit' ),
			"id" => "TooltipTextColor",
			"type" => "colorpicker",
			"std" => "#FFFFFF"),     
	
	array( 	"name" => __( 'Tooltip Margin Left', 'yit' ),
			"desc" => __( 'Margin of the text to the left end of the tooltip', 'yit' ),
			"id" => "TooltipMarginLeft",
			"type" => "slider",
			"min" => 0,
			"max" => 50,
			"std" => 5),      
	
	array( 	"name" => __( 'Tooltip Margin Right', 'yit' ),
			"desc" => __( 'Margin of the text to the right end of the tooltip', 'yit' ),
			"id" => "TooltipMarginRight",
			"type" => "slider",
			"min" => 0,
			"max" => 50,
			"std" => 7),       
	
	array( 	"name" => __( 'Tooltip Text Sharpness', 'yit' ),
			"desc" => __( 'Sharpness of the tooltip text (-400 to 400)', 'yit' ),
			"id" => "TooltipTextSharpness",
			"type" => "slider",
			"min" => -400,
			"max" => 400,   
			"step" => 10,
			"std" => 50),      
	
	array( 	"name" => __( 'Tooltip Text Thickness', 'yit' ),
			"desc" => __( 'Thickness of the tooltip text (-400 to 400)', 'yit' ),
			"id" => "TooltipTextThickness",
			"type" => "slider",
			"min" => -400,
			"max" => 400,    
			"step" => 10,
			"std" => -100),   
    array( 'type' => 'sep' ),  
    
    // SHADOW
    array(
        'type' => 'simple-text',        
        'desc' => '<b>' . __( 'Info box', 'yit' ) . '</b>'
    ),         
	
	array( 	"name" => __( 'Info Width', 'yit' ),
			"desc" => __( 'The width of the info text field', 'yit' ),
			"id" => "InfoWidth",
			"type" => "slider",
			"min" => 0,
			"max" => 1170,
			"step" => 20,
			"std" => 400), 
	
	array( 	"name" => __( 'Info Background', 'yit' ),
			"desc" => __( 'The background color of the info text field', 'yit' ),
			"id" => "InfoBackground",
			"type" => "colorpicker",
			"std" => "#FFFFFF"),    
	
	array( 	"name" => __( 'Info Background Alpha', 'yit' ),
			"desc" => __( 'The alpha of the background of the info text, the image shines through, when smaller than 1', 'yit' ),
			"id" => "InfoBackgroundAlpha",
			"type" => "slider",
			"min" => 0,
			"max" => 1,
			"step" => 0.05,
			"std" => 0.95),         
	
	array( 	"name" => __( 'Info Margin', 'yit' ),
			"desc" => __( 'The margin of the text field in the info section to all sides', 'yit' ),
			"id" => "InfoMargin",
			"type" => "slider",
			"min" => 0,
			"max" => 100,
			"std" => 15),       
	
	array( 	"name" => __( 'Info Text Sharpness', 'yit' ),
			"desc" => __( 'Sharpness of the Info text (-400 to 400)', 'yit' ),
			"id" => "InfoTextSharpness",
			"type" => "slider",
			"min" => -400,
			"max" => 400, 
			"step" => 10,
			"std" => 0),      
	
	array( 	"name" => __( 'Info Text Thickness', 'yit' ),
			"desc" => __( 'Thickness of the Info text (-400 to 400)', 'yit' ),
			"id" => "InfoTextThickness",
			"type" => "slider",
			"min" => -400,
			"max" => 400,
			"step" => 10,
			"std" => 0),    
) );        