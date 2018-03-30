<?php    
                         
$yiw_options['flashsettings'] = array (            
	    
	"title" => array(    
        array( 	"name" => __('Flash Slider Settings', 'yiw'),
        	   	"type" => "title")
    ),            
    
    "transitions" => array(
        array( "name" => __("Transitions", 'yiw'),
        	   "type" => "section"),
        array( "type" => "open"),  
		
		array( 	"name" => __( 'Pieces', 'yiw' ),
				"desc" => __( 'Number of pieces to which the image is sliced', 'yiw' ),
				"id" => "slider_flash_Pieces",
				"type" => "slider_control",
				"min" => 0,
				"max" => 40,
				"std" => 9),
		
		array( 	"name" => __( 'Time', 'yiw' ),
				"desc" => __( 'Time for one cube to turn', 'yiw' ),
				"id" => "slider_flash_Time",
				"type" => "slider_control",
				"min" => 0,
				"max" => 5,
				"step" => 0.1,
				"label" => "s",
				"std" => 1),
		
		array( 	"name" => __( 'Transition', 'yiw' ),
				"desc" => __( 'Transition type of the Tweener class', 'yiw' ),
				"id" => "slider_flash_Transition",
				"type" => "select",
				"options" => $GLOBALS['yiw_easings'],
				"std" => "easeInOutBack"),    
		
		array( 	"name" => __( 'Depth Offset', 'yiw' ),
				"desc" => __( 'The offset during transition on the z-axis. Value between 100 and 1000 are recommended.', 'yiw' ),
				"id" => "slider_flash_DepthOffset",
				"type" => "slider_control",
				"min" => 100,
				"max" => 1000,
				"step" => 50,
				"std" => 300), 
		
		array( 	"name" => __( 'Cube Distance', 'yiw' ),
				"desc" => __( 'The distance between the cubes during transition. Values between 5 and 50 are recommended.', 'yiw' ),
				"id" => "slider_flash_CubeDistance",
				"type" => "slider_control",
				"min" => 5,
				"max" => 50,
				"std" => 30),
        	
        array( "type" => "close")
	),
    
    "general" => array(
        array( "name" => __("General Configuration", 'yiw'),
        	   "type" => "section"),
        array( "type" => "open"),  
		
		array( 	"name" => __( 'Loader Color', 'yiw' ),
				"desc" => __( 'Color of the cubes before the first image appears, also the color of the back sides of the cube, which become visible at some transition types', 'yiw' ),
				"id" => "slider_flash_LoaderColor",
				"type" => "color-picker",
				"std" => "#333333"),
		
		array( 	"name" => __( 'Inner Side Color', 'yiw' ),
				"desc" => __( 'Color of the inner sides of the cube when sliced', 'yiw' ),
				"id" => "slider_flash_InnerSideColor",
				"type" => "color-picker",
				"std" => "#222222"),    
		
		array( 	"name" => __( 'Autoplay', 'yiw' ),
				"desc" => __( 'Number of seconds from one transition to another, if not stopped. Set to 0 to disable autoplay', 'yiw' ),
				"id" => "slider_flash_Autoplay",
				"type" => "slider_control",
				"min" => 0,
				"max" => 20,
				"label" => "s",
				"std" => 4),
        	
        array( "type" => "close")
	),
    
    "shadow" => array(
        array( "name" => __("Shadow", 'yiw'),
        	   "type" => "section"),
        array( "type" => "open"),  
		
		array( 	"name" => __( 'Side Shadow Alpha', 'yiw' ),
				"desc" => __( 'Sides get darker when moved away from the front. This is the degree of darkness - 0 == no change, 1 == 100% black.', 'yiw' ),
				"id" => "slider_flash_SideShadowAlpha",
				"type" => "slider_control",
				"min" => 0,
				"max" => 1,
				"step" => 0.1,
				"std" => 0.8),
		
		array( 	"name" => __( 'Drop Shadow Alpha', 'yiw' ),
				"desc" => __( 'Alpha of the drop shadow - 0 == no shadow, 1 == opaque', 'yiw' ),
				"id" => "slider_flash_DropShadowAlpha",
				"type" => "slider_control",
				"min" => 0,
				"max" => 1,
				"step" => 0.1,
				"std" => 0.7),
		
		array( 	"name" => __( 'Drop Shadow Distance', 'yiw' ),
				"desc" => __( 'Distance of the shadow from the bottom of the image', 'yiw' ),
				"id" => "slider_flash_DropShadowDistance",
				"type" => "slider_control",
				"min" => 0,
				"max" => 100,
				"std" => 25),     
		
		array( 	"name" => __( 'Drop Shadow Scale', 'yiw' ),
				"desc" => __( 'As the shadow is blurred, it appears wider that the actual image, when not resized. Thus it\'s a good idea to make it slightly smaller. - 1 would be no resizing at all.', 'yiw' ),
				"id" => "slider_flash_DropShadowScale",
				"type" => "slider_control",
				"min" => 0,
				"max" => 1,
				"step" => 0.05,
				"std" => 0.95),
		
		array( 	"name" => __( 'Drop Shadow Blur X', 'yiw' ),
				"desc" => __( 'Blur of the drop shadow on the x-axis', 'yiw' ),
				"id" => "slider_flash_DropShadowBlurX",
				"type" => "slider_control",
				"min" => 0,
				"max" => 200,
				"std" => 40),
		
		array( 	"name" => __( 'Drop Shadow Blur Y', 'yiw' ),
				"desc" => __( 'Blur of the drop shadow on the y-axis', 'yiw' ),
				"id" => "slider_flash_DropShadowBlurY",
				"type" => "slider_control",
				"min" => 0,
				"max" => 200,
				"std" => 4),
        	
        array( "type" => "close")
	),     
    
    "menu" => array(
        array( "name" => __("Menu", 'yiw'),
        	   "type" => "section"),
        array( "type" => "open"),   
		
		array( 	"name" => __( 'Menu Distance X', 'yiw' ),
				"desc" => __( 'Distance between two menu items (from center to center).', 'yiw' ),
				"id" => "slider_flash_MenuDistanceX",
				"type" => "slider_control",
				"min" => 0,
				"max" => 400,
				"std" => 20),
		
		array( 	"name" => __( 'Menu Distance Y', 'yiw' ),
				"desc" => __( 'Distance of the menu from the bottom of the image.', 'yiw' ),
				"id" => "slider_flash_MenuDistanceY",
				"type" => "slider_control",
				"min" => 0,
				"max" => 400,
				"std" => 50),      
		
		array( 	"name" => __( 'Menu Color Inactive Item', 'yiw' ),
				"desc" => __( 'Color of an inactive menu item.', 'yiw' ),
				"id" => "slider_flash_MenuColor1",
				"type" => "color-picker",
				"std" => "#999999"),
		
		array( 	"name" => __( 'Menu Color Active Item', 'yiw' ),
				"desc" => __( 'Color of an active menu item.', 'yiw' ),
				"id" => "slider_flash_MenuColor2",
				"type" => "color-picker",
				"std" => "#333333"),
		
		array( 	"name" => __( 'Menu Color Inner Circle od Active Item', 'yiw' ),
				"desc" => __( 'Color of the inner circle of an active menu item. Should equal the background color of the whole thing.', 'yiw' ),
				"id" => "slider_flash_MenuColor3",
				"type" => "color-picker",
				"std" => "#FFFFFF"),
        	
        array( "type" => "close")
	),
    
    "control" => array(
        array( "name" => __("Controls", 'yiw'),
        	   "type" => "section"),
        array( "type" => "open"),     
		
		array( 	"name" => __( 'Control Size', 'yiw' ),
				"desc" => __( 'Size of the controls, which appear on rollover (play, stop, info, link)', 'yiw' ),
				"id" => "slider_flash_ControlSize",
				"type" => "slider_control",
				"min" => 0,
				"max" => 400,
				"step" => 10,
				"std" => 100),  
		
		array( 	"name" => __( 'Control Distance', 'yiw' ),
				"desc" => __( 'Distance between the controls (from the borders).', 'yiw' ),
				"id" => "slider_flash_ControlDistance",
				"type" => "slider_control",
				"min" => 0,
				"max" => 100,
				"std" => 20),         
		
		array( 	"name" => __( 'Bg Color', 'yiw' ),
				"desc" => __( 'Background color of the controls', 'yiw' ),
				"id" => "slider_flash_ControlColor1",
				"type" => "color-picker",
				"std" => "#222222"),  
		
		array( 	"name" => __( 'Font Color', 'yiw' ),
				"desc" => __( 'Font color of the controls', 'yiw' ),
				"id" => "slider_flash_ControlColor2",
				"type" => "color-picker",
				"std" => "#FFFFFF"),
		
		array( 	"name" => __( 'Control Alpha', 'yiw' ),
				"desc" => __( 'Alpha of a control, when mouse is not over', 'yiw' ),
				"id" => "slider_flash_ControlAlpha",
				"type" => "slider_control",
				"min" => 0,
				"max" => 1,
				"step" => 0.05,
				"std" => 0.8),
		
		array( 	"name" => __( 'Control Alpha Hover status', 'yiw' ),
				"desc" => __( 'Alpha of a control, when mouse is hover.', 'yiw' ),
				"id" => "slider_flash_ControlAlphaOver",
				"type" => "slider_control",
				"min" => 0,
				"max" => 1,
				"step" => 0.05,
				"std" => 0.95),
		
		array( 	"name" => __( 'Control X', 'yiw' ),
				"desc" => __( 'X-position of the point, which aligns the controls (measured from [0,0] of the image)', 'yiw' ),
				"id" => "slider_flash_ControlsX",
				"type" => "slider_control",
				"min" => 0,
				"max" => 960,
				"step" => 10,
				"std" => 480),
		
		array( 	"name" => __( 'Control Y', 'yiw' ),
				"desc" => __( 'Y-position of the point, which aligns the controls (measured from [0,0] of the image)', 'yiw' ),
				"id" => "slider_flash_ControlsY",
				"type" => "slider_control",
				"min" => 0,
				"max" => 350,
				"step" => 10,
				"std" => 240),
		
		array( 	"name" => __( 'Controls Align', 'yiw' ),
				"desc" => __( 'Type of alignment from the point [controlsX, controlsY]', 'yiw' ),
				"id" => "slider_flash_ControlsAlign",
				"type" => "select",
				"options" => array( 
					'center' => __( 'center', 'yiw' ),
					'left' => __( 'left', 'yiw' ),
					'right' => __( 'right', 'yiw' ), 
				),
				"std" => 'center'),
        	
        array( "type" => "close")
	),
    
    "tooltip" => array(
        array( "name" => __("Tooltip", 'yiw'),
        	   "type" => "section"),
        array( "type" => "open"),    
		
		array( 	"name" => __( 'Tooltip Height', 'yiw' ),
				"desc" => __( 'Height of the tooltip surface in the menu', 'yiw' ),
				"id" => "slider_flash_TooltipHeight",
				"type" => "slider_control",
				"min" => 0,
				"max" => 200,
				"std" => 30),  
		
		array( 	"name" => __( 'Tooltip Color', 'yiw' ),
				"desc" => __( 'Color of the tooltip surface in the menu', 'yiw' ),
				"id" => "slider_flash_TooltipColor",
				"type" => "color-picker",
				"std" => "#222222"),  
		
		array( 	"name" => __( 'Tooltip Text Y', 'yiw' ),
				"desc" => __( 'Y-distance of the tooltip text field from the top of the tooltip', 'yiw' ),
				"id" => "slider_flash_TooltipTextY",
				"type" => "slider_control",
				"min" => 0,
				"max" => 200,
				"std" => 5),          
		
		array( 	"name" => __( 'Tooltip Text Color', 'yiw' ),
				"desc" => __( 'Color of the tooltip text', 'yiw' ),
				"id" => "slider_flash_TooltipTextColor",
				"type" => "color-picker",
				"std" => "#FFFFFF"),     
		
		array( 	"name" => __( 'Tooltip Margin Left', 'yiw' ),
				"desc" => __( 'Margin of the text to the left end of the tooltip', 'yiw' ),
				"id" => "slider_flash_TooltipMarginLeft",
				"type" => "slider_control",
				"min" => 0,
				"max" => 50,
				"std" => 5),      
		
		array( 	"name" => __( 'Tooltip Margin Right', 'yiw' ),
				"desc" => __( 'Margin of the text to the right end of the tooltip', 'yiw' ),
				"id" => "slider_flash_TooltipMarginRight",
				"type" => "slider_control",
				"min" => 0,
				"max" => 50,
				"std" => 7),       
		
		array( 	"name" => __( 'Tooltip Text Sharpness', 'yiw' ),
				"desc" => __( 'Sharpness of the tooltip text (-400 to 400)', 'yiw' ),
				"id" => "slider_flash_TooltipTextSharpness",
				"type" => "slider_control",
				"min" => -400,
				"max" => 400,   
				"step" => 10,
				"std" => 50),      
		
		array( 	"name" => __( 'Tooltip Text Thickness', 'yiw' ),
				"desc" => __( 'Thickness of the tooltip text (-400 to 400)', 'yiw' ),
				"id" => "slider_flash_TooltipTextThickness",
				"type" => "slider_control",
				"min" => -400,
				"max" => 400,    
				"step" => 10,
				"std" => -100),       
        	
        array( "type" => "close")
	),
    
    "info" => array(
        array( "name" => __("Info Box", 'yiw'),
        	   "type" => "section"),
        array( "type" => "open"),    
		
		array( 	"name" => __( 'Info Width', 'yiw' ),
				"desc" => __( 'The width of the info text field', 'yiw' ),
				"id" => "slider_flash_InfoWidth",
				"type" => "slider_control",
				"min" => 0,
				"max" => 960,
				"step" => 20,
				"std" => 400), 
		
		array( 	"name" => __( 'Info Background', 'yiw' ),
				"desc" => __( 'The background color of the info text field', 'yiw' ),
				"id" => "slider_flash_InfoBackground",
				"type" => "color-picker",
				"std" => "#FFFFFF"),    
		
		array( 	"name" => __( 'Info Background Alpha', 'yiw' ),
				"desc" => __( 'The alpha of the background of the info text, the image shines through, when smaller than 1', 'yiw' ),
				"id" => "slider_flash_InfoBackgroundAlpha",
				"type" => "slider_control",
				"min" => 0,
				"max" => 1,
				"step" => 0.05,
				"std" => 0.95),         
		
		array( 	"name" => __( 'Info Margin', 'yiw' ),
				"desc" => __( 'The margin of the text field in the info section to all sides', 'yiw' ),
				"id" => "slider_flash_InfoMargin",
				"type" => "slider_control",
				"min" => 0,
				"max" => 100,
				"std" => 15),       
		
		array( 	"name" => __( 'Info Text Sharpness', 'yiw' ),
				"desc" => __( 'Sharpness of the Info text (-400 to 400)', 'yiw' ),
				"id" => "slider_flash_InfoTextSharpness",
				"type" => "slider_control",
				"min" => -400,
				"max" => 400, 
				"step" => 10,
				"std" => 0),      
		
		array( 	"name" => __( 'Info Text Thickness', 'yiw' ),
				"desc" => __( 'Thickness of the Info text (-400 to 400)', 'yiw' ),
				"id" => "slider_flash_InfoTextThickness",
				"type" => "slider_control",
				"min" => -400,
				"max" => 400,
				"step" => 10,
				"std" => 0),      
        	
        array( "type" => "close")
	),      
 
);    
?>