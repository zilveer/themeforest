<?php
/**
 * This file is part of the BTP_Flare_Theme package.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 * 
 * @package			BTP_Flare_Theme
 * @subpackage		BTP_Shortcodes
 */



/* Prevent direct script access */
if ( !defined( 'BTP_FRAMEWORK_VERSION' ) ) exit( 'No direct script access allowed' );



/* Add "Panels" subgroup to the global shortcode generator */
btp_shortgen_add_subgroup( 
	'panels', 
	array( 
		'label' => __( 'Panels', 'btp_theme' ),
	), 
	'general', 
	60
);



/* Add [toggle] shortcode to the global shortcode generator */
btp_shortgen_add_item(
	'toggle', 
	array(
		'label' 	=> '[toggle]',
		'atts' 		=> array(
			'title' 	=> array( 'view' => 'String' ),				    	
			'on'		=> array( 
				'view' 			=> 'Checkbox',
				'hint'			=> __( 'Check/uncheck  to  expand/collapse', 'btp_theme' ), 
			),
		),
		'content'	=> array( 'view' => 'Text' ),
		'type' 		=> 'block',
		'group'		=> 'general',
		'subgroup'	=> 'panels',	
		'position'	=> 100,
	)	
);



/**
 * [toggle] shortcode callback function.
 * 
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_toggle( $atts, $content = null ) {
	/* We need a static counter to trace a shortcode without the id attribute */
	static $counter = 0;
	$counter++;
	
	extract( shortcode_atts( array(
	 	'id'		=> '',
	 	'class'		=> '',
		'title' 	=> '...',
		'on'		=> false,			
		), $atts 
	));
	$content = preg_replace('#^<\/p>|<p>$#', '', $content);
	
	/* Compose final HTML id attribute */
	$final_id = strlen( $id ) ? $id : 'toggle-counter-' . $counter;
		
	/* Compose final HTML class attribute */
	$final_class = '';
	$final_class .= 'toggle ';	
	$final_class .= $on ? 'toggle-on ' : 'toggle-off '; 
	$final_class .= sanitize_html_classes( $class );
	$final_class = trim( $final_class ); 
	
	$out = '';
	
	$out .= '<div id="' . esc_attr( $final_id ) . '" class="' . esc_attr( $final_class ) . '">';
	$out .= '<div class="toggle-title"><h4>'.$title.'</h4></div>';
	$out .= '<div class="toggle-content"><div class="block">'.do_shortcode( shortcode_unautop( $content ) ).'</div></div>';
	$out .= '</div>';
	
	return $out;
}
add_shortcode( 'toggle', 'btp_shortcode_toggle' );
	
	

/* Add [accordion] shortcode to the global shortcode generator */
btp_shortgen_add_item(
	'accordion', 
	array(
		'label' 	=> '[accordion]',
		'atts' 		=> array(
				'title' 		=> array( 'view' => 'String' ),
		),
		'content' 	=> array( 'view' => 'Text' ),
		'type' 		=> 'block',
		'group'		=> 'general',
		'subgroup'	=> 'panels',
		'position'	=> 200,		
	)	
);



/* Add [accordion_last] shortcode to the global shortcode generator */
btp_shortgen_add_item(
	'accordion_last', 
	array(
		'label' 	=> '[accordion_last]',
		'atts' 		=> array(
				'title' 		=> array( 'view' => 'String' ),
		),
		'content' 	=> array( 'view' => 'Text' ),
		'type' 		=> 'block',
		'group'		=> 'general',
		'subgroup'	=> 'panels',
		'position'	=> 202,		
	)	
);



/* Add shortcode set to the global shortcode generator */
btp_shortgen_add_item(
	'*** 2 accordions',
	array(
		'label'		=> __('2 accordions', 'btp_theme'),
		'result'	=> '[accordion title="Title 1"]' 
						. "\n\n" 
						. 'some text goes here...' 
						. "\n\n"
						. '[/accordion]'
						. "\n\n" 	
						. '[accordion_last title="Title 2"]'
						. "\n\n"
						. 'some text goes here...'
						. "\n\n"
						. '[/accordion_last]',
		'group'		=> 'general',
		'subgroup'	=> 'panels',
		'position'	=> 400,														
	)
); 



/* Add shortcode set to the global shortcode generator */
btp_shortgen_add_item(
	'*** 3 accordions',
	array(
		'label'		=> __('3 accordions', 'btp_theme'),
		'result'	=> '[accordion title="Title 1"]' 
						. "\n\n" 
						. 'some text goes here...' 
						. "\n\n"
						. '[/accordion]'
						. "\n\n" 	
						. '[accordion title="Title 2"]'
						. "\n\n"
						. 'some text goes here...'
						. "\n\n"
						. '[/accordion]'
						. "\n\n"
						. '[accordion_last title="Title 3"]'
						. "\n\n"
						. 'some text goes here...'
						. "\n\n"
						. '[/accordion_last]',
		'group'		=> 'general',
		'subgroup'	=> 'panels',
		'position'	=> 401,						
	)			 
); 



/* Add shortcode set to the global shortcode generator */
btp_shortgen_add_item(
	'*** 4 accordions',
	array(
		'label'		=> __('4 accordions', 'btp_theme'),
		'result'	=> '[accordion title="Title 1"]' 
						. "\n\n" 
						. 'some text goes here...' 
						. "\n\n"
						. '[/accordion]'
						. "\n\n" 	
						. '[accordion title="Title 2"]'
						. "\n\n"
						. 'some text goes here...'
						. "\n\n"
						. '[/accordion]'
						. "\n\n"
						. '[accordion title="Title 3"]'
						. "\n\n"
						. 'some text goes here...'
						. "\n\n"
						. '[/accordion]'
						. "\n\n"
						. '[accordion_last title="Title 4"]'
						. "\n\n"
						. 'some text goes here...'
						. "\n\n"
						. '[/accordion_last]',
		'group'		=> 'general',
		'subgroup'	=> 'panels',
		'position'	=> 402,	
	)			 
); 

	

	
/**
 * Accordion shortcode helper function
 */
function btp_shortcode_accordion_x($atts, $content = null) {
	/* We need a static counter to trace a shortcode without the id attribute */
	static $counter = 0;		
	$counter++;
	
	/* Prepare attributes */	
	extract( shortcode_atts( array(
		'id'		=> '',
		'class'		=> '',
		'title' 	=> '...',
		'last'		=> false,
		), $atts 
	));		
	$content = preg_replace('#^<\/p>|<p>$#', '', $content);
	
	/* Compose final HTML id attribute */
	$final_id = strlen( $id ) ? $id : 'accordion-counter-' . $counter;
		
	/* Compose final HTML class attribute */
	$final_class = '';
	$final_class .= 'accordion-panel ';
	$final_class .= sanitize_html_classes( $class );
	$final_class = trim( $final_class ); 
	
	/* Compose output */
	$out = '';
	
	if ( 1 === $counter ) { 
		$out .= '<div class="accordion">';
	}	
	
	$out .= '<div id="' . esc_attr( $final_id ) . '" class="' . esc_attr( $final_class ) . '">';
		$out .= '<div class="accordion-panel-title"><h4>'.$title.'</h4></div>';
		$out .= '<div class="accordion-panel-content"><div class="block">'.do_shortcode( shortcode_unautop( $content ) ).'</div></div>';
	$out .= '</div>';
	
	if ( $last ) {
		$out .= '</div><!-- END: .accordion -->';
		// Reset counter
		$counter = 0;
	}	
	
	return $out;	
}



/**
 * [accordion] shortcode callback function.
 * 
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_accordion($atts, $content = null) { 
	return btp_shortcode_accordion_x( array_merge( $atts, array( 'last' => false ) ), $content); 
}
add_shortcode( 'accordion', 'btp_shortcode_accordion' );



/**
 * [accordion_last] shortcode callback function.
 * 
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_accordion_last($atts, $content = null) { 
	return btp_shortcode_accordion_x( array_merge( $atts, array( 'last' => true ) ), $content); 
}
add_shortcode( 'accordion_last', 'btp_shortcode_accordion_last' );
	


/* Add [tabs] shortcode to the global shortcode generator */	
btp_shortgen_add_item(
	'tabs', 
	array(
		'label' 	=> '[tabs]',
		'help'		=> 
			'<p>' . 
				__( 'This shortcode should be used along with the tab_title and the tab_content shortcodes.', 'btp_theme' ) . 
			'</p>',
		'atts' 		=> array(
			'position'		=> array( 
				'view' 			=> 'Choice',
				'choices'		=> array(
						'top-left' 		=> 'top-left',
						'top-center'	=> 'top-center',
						'top-right'		=> 'top-right',
						'bottom-left'	=> 'bottom-left',
						'bottom-center'	=> 'bottom-center',
						'bottom-right'	=> 'bottom-right',
						'left-top' 		=> 'left-top',
						'right-top' 	=> 'right-top',	
				),
			),
			'type'		=> array( 
				'view' 			=> 'Choice',
				'choices'		=> array(
						'simple' 		=> 'simple',
						'button'		=> 'button',
						'transparent'	=> 'transparent',
				),
			),
		),
		'content' 	=> array( 'view' => 'Text' ),
		'type' 		=> 'block',
		'group'		=> 'general',
		'subgroup'	=> 'panels',
		'position'	=> 300,	
	)	
);



/**
 * [tabs] shortcode callback function 
 * 
 * @param			array $atts
 * @param			string $content							
 * @return			string	 
 */
function btp_shortcode_tabs($atts, $content = null) {
	/* We need a static counter to trace a shortcode without the id attribute */
	static $counter = 0;		
	$counter++;

	/* Prepare attributes */	
	extract( shortcode_atts( array(
		'id'		=> '',
		'class'		=> '',
		'type'		=> 'simple',
		'position'	=> 'top-left'
	), $atts ) );		
	$content = preg_replace('#^<\/p>|<p>$#', '', $content);
	
	/* Compose final HTML id attribute */
	$final_id = strlen( $id ) ? $id : 'tabs-counter-' . $counter;
	
	
		
	/* Compose final HTML class attribute */
	$final_class = '';
	$final_class .= 'btp-tabs tabs ';
	$final_class .= 'type-' . sanitize_html_class( $type ) . ' ';
	
	switch ( $position ) {
		case 'top-left':
		case 'top_left':
			$final_class .= 'layout-horizontal tabs-top align-left ';
			break;	
			
		case 'top-center':
		case 'top_center':
			$final_class .= 'layout-horizontal tabs-top align-center ';
			break;

		case 'top-right':
		case 'top_right':
			$final_class .= 'layout-horizontal tabs-top align-right ';
			break;		
			
		case 'bottom-left':
		case 'bottom_left':
			$final_class .= 'layout-horizontal tabs-bottom align-left ';
			break;	
			
		case 'bottom-center':
		case 'bottom_center':
			$final_class .= 'layout-horizontal tabs-bottom align-center ';
			break;

		case 'bottom-right':
		case 'bottom_right':
			$final_class .= 'layout-horizontal tabs-bottom align-right ';
			break;	
			
		case 'left-top':
		case 'left_top':
			$final_class .= 'layout-vertical tabs-left align-top ';
			break;	
			
		case 'left_center':
		case 'left_center':
		case 'left_middle':
		case 'left_middle':
			$final_class .= 'layout-vertical tabs-left align-middle ';
			break;

		case 'left-bottom':
		case 'left_bottom':
			$final_class .= 'layout-vertical tabs-left align-bottom';
			break;		
			
		case 'right-top':
		case 'right_top':
			$final_class .= 'layout-vertical tabs-right align-top ';
			break;	
			
		case 'right-center':
		case 'right_center':
		case 'right-middle':
		case 'right_middle':
			$final_class .= 'layout-vertical tabs-right align-middle ';
			break;

		case 'right-bottom':
		case 'right_bottom':
			$final_class .= 'layout-vertical tabs-right align-bottom';
			break;	
	}
	
	$final_class .= sanitize_html_classes( $class );
	$final_class = trim( $final_class ); 
	
	/* Compose output */
	$out = '';
		
	
	$out .= '<div id="' . esc_attr( $final_id ) . '" class="' . esc_attr( $final_class ) . '">';
		$out .= do_shortcode( shortcode_unautop( $content ) );
	$out .= '</div>';
	
		
	return $out;	
}
add_shortcode( 'tabs', 'btp_shortcode_tabs' );



/* Add [tab_title] shortcode to the global shortcode generator */
btp_shortgen_add_item(
	'tab_title', 
	array(
		'label' 	=> '[tab_title]',
		'help'		=> 
			'<p>' . 
				__( 'This shortcode should be used along with the tabs and the tab_content shortcodes.', 'btp_theme' ) . 
			'</p>',		
		'content' 	=> array( 'view' => 'Text' ),		
		'group'		=> 'general',
		'subgroup'	=> 'panels',
		'position'	=> 301,	
	)	
);



/**
 * [tab_title] shortcode callback function 
 * 
 * @param			array $atts
 * @param			string $content							
 * @return			string	 
 */
function btp_shortcode_tab_title($atts, $content = null) {
	/* We need a static counter to trace a shortcode without the id attribute */
	static $counter = 0;		
	$counter++;

	/* Prepare attributes */	
	extract( shortcode_atts( array(
		'id'		=> '',
		'class'		=> '',
	), $atts ) );		
	$content = preg_replace('#^<\/p>|<p>$#', '', $content);
	
	/* Compose final HTML id attribute */
	$final_id = strlen( $id ) ? $id : 'tab-title-counter-' . $counter;
		
	/* Compose final HTML class attribute */
	$final_class = '';
	$final_class .= 'tab-title ';
	$final_class .= sanitize_html_classes( $class );
	$final_class = trim( $final_class ); 
	
	/* Compose output */
	$out = '';
		
	
	$out .= '<div id="' . esc_attr( $final_id ) . '" class="' . esc_attr( $final_class ) . '">';
		$out .= do_shortcode( shortcode_unautop( $content ) );
	$out .= '</div>';
	
		
	return $out;	
}
add_shortcode( 'tab_title', 'btp_shortcode_tab_title' );



/* Add [tab_content] shortcode to the global shortcode generator */
btp_shortgen_add_item(
	'tab_content', 
	array(
		'label' 	=> '[tab_content]',
		'help'		=> 
			'<p>' . 
				__( 'This shortcode should be used along with the tabs and the tab_title shortcodes.', 'btp_theme' ) . 
			'</p>',		
		'content' 	=> array( 'view' => 'Text' ),
		'type' 		=> 'block',
		'group'		=> 'general',
		'subgroup'	=> 'panels',
		'position'	=> 302,	
	)	
);



/**
 * [tab_content] shortcode callback function 
 * 
 * @param			array $atts
 * @param			string $content							
 * @return			string	 
 */
function btp_shortcode_tab_content($atts, $content = null) {
	/* We need a static counter to trace a shortcode without the id attribute */
	static $counter = 0;		
	$counter++;

	/* Prepare attributes */	
	extract( shortcode_atts( array(
		'id'		=> '',
		'class'		=> '',
	), $atts ) );		
	$content = preg_replace('#^<\/p>|<p>$#', '', $content);
	
	/* Compose final HTML id attribute */
	$final_id = strlen( $id ) ? $id : 'tab-content-counter-' . $counter;
		
	/* Compose final HTML class attribute */
	$final_class = '';
	$final_class .= 'tab-content ';
	$final_class .= sanitize_html_classes( $class );
	$final_class = trim( $final_class ); 
	
	/* Compose output */
	$out = '';
		
	
	$out .= '<div id="' . esc_attr( $final_id ) . '" class="' . esc_attr( $final_class ) . '">';
		$out .= do_shortcode( shortcode_unautop( $content ) );
	$out .= '</div>';
	
		
	return $out;	
}
add_shortcode( 'tab_content', 'btp_shortcode_tab_content' );



/* Add shortcode set to the global shortcode generator */
btp_shortgen_add_item(
	'*** 2 tabs',
	array(
		'label'		=> __('2 tabs', 'btp_theme'),
		'result'	=> '[tabs type="simple" position="top-left"]' . 
						"\n\n" .
						'[tab_title]Tab 1[/tab_title]' . 
						"\n\n" .
						'[tab_content]' .
						"\n\n" .
						'here goes some tab content...' .
						"\n\n" .
						'[/tab_content]' .	
						"\n\n" .
						'[tab_title]Tab 2[/tab_title]' . 
						"\n\n" .
						'[tab_content]' .
						"\n\n" .
						'here goes some tab content...' .
						"\n\n" .
						'[/tab_content]' .
						"\n\n" .
						'[/tabs]',
		'group'		=> 'general',
		'subgroup'	=> 'panels',
		'position'	=> 303,						
	)			 
);
/* Add shortcode set to the global shortcode generator */
btp_shortgen_add_item(
	'*** 3 tabs',
	array(
		'label'		=> __('3 tabs', 'btp_theme'),
		'result'	=> '[tabs type="simple" position="top-left"]' . 
						"\n\n" .
						'[tab_title]Tab 1[/tab_title]' . 
						"\n\n" .
						'[tab_content]' .
						"\n\n" .
						'here goes some tab content...' .
						"\n\n" .
						'[/tab_content]' .	
						"\n\n" .
						'[tab_title]Tab 2[/tab_title]' . 
						"\n\n" .
						'[tab_content]' .
						"\n\n" .
						'here goes some tab content...' .
						"\n\n" .
						'[/tab_content]' .
						"\n\n" .
						'[tab_title]Tab 3[/tab_title]' . 
						"\n\n" .
						'[tab_content]' .
						"\n\n" .
						'here goes some tab content...' .
						"\n\n" .
						'[/tab_content]' .
						"\n\n" .
						'[/tabs]',
		'group'		=> 'general',
		'subgroup'	=> 'panels',
		'position'	=> 304,						
	)			 
); 
/* Add shortcode set to the global shortcode generator */
btp_shortgen_add_item(
	'*** 4 tabs',
	array(
		'label'		=> __('4 tabs', 'btp_theme'),
		'result'	=> '[tabs type="simple" position="top-left"]' . 
						"\n\n" .
						'[tab_title]Tab 1[/tab_title]' . 
						"\n\n" .
						'[tab_content]' .
						"\n\n" .
						'here goes some tab content...' .
						"\n\n" .
						'[/tab_content]' .	
						"\n\n" .
						'[tab_title]Tab 2[/tab_title]' . 
						"\n\n" .
						'[tab_content]' .
						"\n\n" .
						'here goes some tab content...' .
						"\n\n" .
						'[/tab_content]' .
						"\n\n" .
						'[tab_title]Tab 3[/tab_title]' . 
						"\n\n" .
						'[tab_content]' .
						"\n\n" .
						'here goes some tab content...' .
						"\n\n" .
						'[/tab_content]' .
						"\n\n" .
						'[tab_title]Tab 4[/tab_title]' . 
						"\n\n" .
						'[tab_content]' .
						"\n\n" .
						'here goes some tab content...' .
						"\n\n" .
						'[/tab_content]' .
						"\n\n" . 
						'[/tabs]',
		'group'		=> 'general',
		'subgroup'	=> 'panels',
		'position'	=> 305,						
	)			 
);



/* Add [before_after] shortcode to the global shortcode generator */
btp_shortgen_add_item( 
	'before_after',
	array(
		'label'			=> '[before_after]',
		'atts'			=> array(
			'id' 			=> array( 
				'view' 			=> 'String',
				'hint'			=> 
					__( 'The id attribute specifies an id for an HTML element.', 'btp_theme' ) . '<br />' .
					__( 'It must be unique within the HTML document.', 'btp_theme' ) . '<br />' .
					__( '(Mainly for additional styling/scripting purposes)', 'btp_theme' ),	 
			),
			'class'			=> array(
				'view'			=> 'String',
				'hint'			=> 
					__( 'The class attribute specifies a class name for an HTML element.', 'btp_theme' ) . '<br />' .
					__( '(Mainly for additional styling/scripting purposes)', 'btp_theme' ),
			),
			'before_src' 	=> array( 'view' => 'String' ),
			'after_src' 	=> array( 'view' => 'String' ),
			'width' 		=> array( 
				'view' 			=> 'String',
				'hint'			=> __( 'The width in pixels', 'btp_theme' ), 
			),			
			'height' 		=> array( 
				'view' 			=> 'String',
				'hint'			=> __( 'The height in pixels', 'btp_theme' ), 
			),
		),			
		'group'			=> 'general',
		'subgroup'		=> 'sliders',	
		'position'		=> 200,
	)						 
); 


/**
 * [before_after] shortcode callback function 
 * 
 * @param			array $atts
 * @param			string $content							
 * @return			string	 
 */
function btp_shortcode_before_after($atts, $content = null) {
	/* We need a static counter to trace a shortcode without the id attribute */
	static $counter = 0;		
	$counter++;

	/* Prepare attributes */	
	extract( shortcode_atts( array(
		'id'			=> '',
		'class'			=> '',
		'width'			=> '',
		'height'		=> '',
		'before_src'	=> '',
		'after_src'		=> '',
	), $atts ) );		
	$content = preg_replace('#^<\/p>|<p>$#', '', $content);
	
	$width = absint( $width );
	$height = absint( $height );
	
	/* Compose final HTML id attribute */
	$final_id = strlen( $id ) ? $id : 'before-after-counter-' . $counter;
		
	/* Compose final HTML class attribute */
	$final_class = '';
	$final_class .= 'before-after ';
	$final_class .= sanitize_html_classes( $class );
	$final_class = trim( $final_class ); 
							
	/* Compose output */	
	$out =	'<div id="%id%" class="%class%">' .
				'[fluid_wrapper %width% %height%]' .
					'<div class="layer-before">' .
						'<img src="%before_src%" %width% %height% alt="%before_alt%" />' .
					'</div>' .  
					'<div class="layer-after">' .
						'<img src="%after_src%" %width% %height% alt="%after_alt%" />' .
					'</div>' .
					'<div class="handle">' .
						'<span></span>' .
						'<span></span>' .
					'</div>' .
				'[/fluid_wrapper]' .				
			'</div>';

	$out = str_replace(
		array(
			'%id%',
			'%class%',
			'%width%',
			'%height%',
			'%before_src%',
			'%before_alt%',	
			'%after_src%',
			'%after_alt%',
		),
		array(
			esc_attr( $final_id ),
			esc_attr( $final_class ),
			( $width ? 'width="' . absint( $width ) . '" ' : '' ),
			( $height ? 'height="' . absint( $height ) . '" ' : '' ),
			esc_url( $before_src ),
			esc_attr( __( 'Before', 'btp_theme' ) ),	
			esc_url( $after_src ),
			esc_attr( __( 'After', 'btp_theme' ) ),
		),
		$out
	);	
	
	$out = do_shortcode( shortcode_unautop( $out ) );
	
	return $out;
}
add_shortcode( 'before_after', 'btp_shortcode_before_after' );
?>