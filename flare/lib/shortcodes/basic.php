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



/* Add [button] shortcode to the global shortcode generator */
btp_shortgen_add_item( 
	'button',
	array(
		'label'			=> '[button]',
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
			'link' 			=> array( 
				'view' 			=> 'String',
				'hint'			=> 
					__( 'The destination to which the link leads', 'btp_theme' ),	 
			),		
			'linking'		=> array( 
				'view' 			=> 'Choice',
				'hint'			=> __( 'What to do when user clicks the button?', 'btp_theme' ) ,
				'choices'		=> array(
						'default' 		=> __( 'open in the same window', 'btp_theme' ),
						'new-window'	=> __( 'open in a new window', 'btp_theme' ),
						'lightbox'		=> __( 'open in a lightbox', 'btp_theme' ),
				),
			),	
			'size'			=> array( 
				'view'			=> 'Choice',
				'choices'		=> array(
						'small' 	=> 'small',
						'medium'	=> 'medium',
						'big'	  	=> 'big',
				),
			),
			'type'		=> array( 
				'view' 			=> 'Choice',
				'choices'		=> array(
						'simple' 		=> 'simple',
						'wide'			=> 'wide',
						'divider'		=> 'divider',
				),
			),			
			'title' 		=> array( 
				'view'			=> 'String',
				'hint'			=> __( 'The title of the link, mainly for SEO purposes', 'btp_theme' ), 
			),			
			'text_color'		=> array(
				'view' 			=> 'Color',
				'hint'			=> __( 'Text Color', 'btp_theme' ),
			),
			'bg_color'		=> array(
				'view' 			=> 'Color',
				'hint'			=> __( 'Background Color', 'btp_theme' ),
			),
		),
		'content'		=> array( 
			'view' 	=> 'String', 
			'label'	=> __( 'label', 'btp_theme' ),
			'hint'	=> __( 'Add a second line by wrapping part of the label with a &lt;small&gt; tag', 'btp_theme' ), 
		),
		'group'			=> 'general',
		'subgroup'		=> 'basic',	
		'position'		=> 180,
	)						 
); 
	


/**
 * [button] shortcode callback function.
 * 
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_button( $atts, $content = null ) {
	/* We need a static counter to trace a shortcode without the id attribute */
	static $counter = 0;
	$counter++;
		
	extract( shortcode_atts( array(
		'id'				=> '',
		'class'				=> '',
		'bg_color'			=> '',
		'text_color'		=> '',
		'link' 				=> '',
	    'priority'			=> 'primary',
		'size'				=> 'small',
		'type'				=> 'simple',
		'title'				=> '',
		'linking'			=> 'default',
		'arrow'				=> '',		
		'lightbox_group'	=> ''			
		), $atts 
	));
	
	if ( !strlen( $link ) || $linking == 'none') {
		return '';
	}
	
	/* Compose final HTML id attribute */
	$final_id = strlen( $id ) ? $id : 'button-counter-' . $counter;
	
	/* Compose final HTML class attribute */
	$final_class  = '';
	$final_class .= 'button ';
	$final_class .= sanitize_html_class( $size ) . ' ';	
	$final_class .= 'type-' . sanitize_html_class( $type ) . ' ';
	
	$final_class .= in_array( $arrow, array( 'right', 'forward' ) ) ? 'with-forward-arrow ' : '';
	$final_class .= in_array( $arrow, array( 'left', 'backward' ) ) ? 'with-backward-arrow ' : '';
	

	
	/* Compose HTML rel attribute */
	$rel = '';
	
	switch ( $linking ) {			
		case 'lightbox':		
			$rel = 'prettyPhoto';
			$rel .= strlen( $lightbox_group ) ? '[' . $lightbox_group . ']' : '';
			break;
		case 'new_window':	
		case 'new-window':
			$final_class .= 'new-window ';
			break;
		default:
			break;
	}	
	
	$final_class .= sanitize_html_classes( $class );
	$final_class = trim( $final_class );	
	
	/* Compose CSS */
	$css = '';
	if ( strlen( $text_color ) ) {
		$color = new BTP_Color($text_color);
		$css .= '#' . esc_attr($final_id) . '.button > span > span,' . "\n" .
				'#' . esc_attr($final_id) . '.button:hover > span > span {' . "\n" .
					'color: #' . $color->get_hex() . ';' ."\n" .
				'}' ."\n";
	}
	
	if ( strlen( $bg_color ) ) {
		$color = new BTP_Color($bg_color);
		$hex = $color->get_hex();
		list($from, $to) = BTP_Colorgen::get_warm_gradient( $color );
		$from_hex = $from->get_hex();
		$to_hex = $to->get_hex();
		
		$button = clone $from;
		$button_l = $button->get_lightness();		
		$button_l += ( $button_l > 20 ) ? -20 : 20;
	
		$button->set_lightness( $button_l );
		$button_hex = $button->get_hex();
		
		$css .= '#' . esc_attr($final_id) . '.button {' . "\n" .
					'background-color: #' . $button_hex . ';' . "\n" . 
				'}' . "\n";
		
		$css .= '#' . esc_attr($final_id) . '.button > span > span {' . "\n" .
					'background-color: #' . $hex . ';' . "\n" .
					'filter: progid:DXImageTransform.Microsoft.gradient(GradientType=0, startColorstr=#' . $from_hex . ', endColorstr=#ff' . $to_hex . ');' . "\n" .
					'-ms-filter: "progid:DXImageTransform.Microsoft.gradient (GradientType=0, startColorstr=#' . $from_hex . ', endColorstr=#' . $to_hex. ')";' . "\n" .
				
					'background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#' . $from_hex . '), to(#'. $to_hex . '));' . "\n" .
					'background-image: -webkit-linear-gradient(top, #' . $from_hex . ', #' . $to_hex . ');' . "\n" . 
  					'background-image:    -moz-linear-gradient(top, #' . $from_hex . ', #' . $to_hex . ');' . "\n" .
    				'background-image:     -ms-linear-gradient(top, #' . $from_hex . ', #' . $to_hex . ');' . "\n" .
    				'background-image:      -o-linear-gradient(top, #' . $from_hex . ', #' . $to_hex . ');' . "\n" .
    				'background-image:         linear-gradient(top, #' . $from_hex . ', #' . $to_hex . ');' . "\n" .
				'}' . "\n";
		
		$css .=	'#' . esc_attr($final_id) . '.button:hover > span > span {' . "\n" .
					'filter: progid:DXImageTransform.Microsoft.gradient(GradientType=0, startColorstr=#' . $to_hex . ', endColorstr=#ff' . $from_hex . ');' . "\n" .
					'-ms-filter: "progid:DXImageTransform.Microsoft.gradient (GradientType=0, startColorstr=#' . $to_hex . ', endColorstr=#' . $from_hex. ')";' . "\n" .
		
					'background-image: -webkit-gradient(linear, 0% 0%, 0% 200%, from(#' . $to_hex . '), to(#'. $from_hex . '));' . "\n" .
    				'background-image: -webkit-linear-gradient(top, #' . $to_hex . ' 0%, #' . $from_hex . ' 200%);' . "\n" . 
    				'background-image:    -moz-linear-gradient(top, #' . $to_hex . ' 0%, #' . $from_hex . ' 200%);' . "\n" .
    				'background-image:     -ms-linear-gradient(top, #' . $to_hex . ' 0%, #' . $from_hex . ' 200%);' . "\n" .
    				'background-image:      -o-linear-gradient(top, #' . $to_hex . ' 0%, #' . $from_hex . ' 200%);' . "\n" .
    				'background-image:         linear-gradient(top, #' . $to_hex . ' 0%, #' . $from_hex . ' 200%);' . "\n" .
				'}' . "\n";	
	}
	//$css = str_replace(array("\n", "\r"), '', $css);	
	
	/* Compose output */
	$out = '';
	
	$out .= strlen($css) ? "\n" . '<style type="text/css" scoped="scoped">' . $css . '</style>' . "\n" : '';
	
	
	$out .= 'divider' === $type ? '<div class="button-divider"><span><span class="helper-1"></span><span class="helper-2"></span>' : ''; 
	
	$out .= '<a ';
	$out .= 'id="' 		. esc_attr( $final_id ) . '" ';
	$out .= 'class="' 	. esc_attr( $final_class ) . '" ';
	$out .= 'href="' 	. esc_url( $link ) . '" ';
	
	$out .= strlen( $title ) ? 'title="'	. esc_attr( wp_strip_all_tags( $title ) ) . '" ' : '';
	$out .= strlen( $rel ) ? 'rel="' . esc_attr( wp_strip_all_tags( $rel ) ) . '" ' : '';
	
	$out .= '><span><span>' 	. do_shortcode( $content ) . '</span></span></a>';
	
	$out .= 'divider' === $type ? '</span></div>' : '';
			
	return $out;
}
add_shortcode( 'button', 'btp_shortcode_button' );



/* Add [pullquote] shortcode to the global shortcode generator */
btp_shortgen_add_item(
	'pullquote', 
	array(
		'label' 	=> '[pullquote]',
		'atts' 		=> array(
			'align'		=> array( 
		    	'view' 		=> 'Choice', 
		    	'choices' 	=> array(
					'left'		=> 'left',
					'right'		=> 'right',
				), 
			),
			'type'		=> array( 
		    	'view' 		=> 'Choice', 
		    	'choices' 	=> array(
					'simple'	=> 'simple',
				), 
			),
		),
		'content' 	=> array( 'view' => 'Text' ),
		'group'		=> 'general',
		'subgroup'	=> 'basic',
		'position'	=> 1580,	
	)	
);



/**
 * [pullquote] shortcode callback function.
 * 
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_pullquote( $atts, $content = null ) {
	extract( shortcode_atts( array(			
		'align'	=> 'left',		
		'type'	=> 'simple',	
		), $atts ) );
	$content = preg_replace('#^<\/p>|<p>$#', '', $content);

	/* Compose final HTML class attribute */
	$final_class  = '';
	$final_class .= 'pullquote ';
	$final_class .= 'type-' . sanitize_html_class( $type ) . ' ';
	$final_class .= 'align-' . sanitize_html_class( $align ) . ' ';	
	
	/* Compose output */
	$out = '';		
	$out .= '<span class="' . $final_class . '">' . $content . '</span>';
	
	return $out;
}
add_shortcode( 'pullquote', 'btp_shortcode_pullquote' );
	
	

/* Add [message] shortcode to the global shortcode generator */
btp_shortgen_add_item(
	'message', 
	array(
		'label' 	=> '[message]',
		'atts' 		=> array(
			'type'		=> array( 
		    	'view' 		=> 'Choice', 
		    	'choices' 	=> array(
					'success'	=> 'success',
					'info'		=> 'info',
					'warning'	=> 'warning',
					'error'		=> 'error',
				), 
			),
		),
		'content' 	=> array( 'view' => 'Text' ),
		'type' 		=> 'block',
		'group'		=> 'general',
		'subgroup'	=> 'basic',
		'position'	=> 1240,
	)	
);
	


/**
 * [message] shortcode callback function.
 * 
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_message( $atts, $content = null ) {
	extract( shortcode_atts( array(			
		'type'	=> 'success',			
		), $atts 
	));
	$content = preg_replace('#^<\/p>|<p>$#', '', $content);

	$out = '';	
	$out .= '<div class="'.sanitize_html_class( $type ).' message"><div class="inner">'.$content.'</div></div>';		
	
	return $out;
}
add_shortcode( 'message', 'btp_shortcode_message' );
	


/* Add [dropcap] shortcode to the global shortcode generator */
btp_shortgen_add_item(
	'dropcap', 
	array(
		'label' 	=> '[dropcap]',
		'atts' 		=> array(
			'type'		=> array( 
		    	'view' 		=> 'Choice', 
		    	'choices' 	=> array(
					'simple'	=> 'simple',
					'square'	=> 'square',
				), 
			),
		),
		'content' 	=> array( 'view' => 'String' ),
		'group'		=> 'general',
		'subgroup'	=> 'basic',
		'position'	=> 350,
	)	
);
	


/**
 * [dropcap] shortcode callback function.
 * 
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_dropcap( $atts, $content = null ) {
	/* We need a static counter to trace a shortcode without the id attribute */
	static $counter = 0;
	$counter++;
	
	extract( shortcode_atts( array(
		'id'			=> '',
		'class'			=> '',	
		'bg_color'		=> '',
		'text_color'	=> '',
		'type'			=> 'simple'	
		), $atts ) );
		
	$content = preg_replace('#^<\/p>|<p>$#', '', $content);	
		
	/* Compose final HTML id attribute */
	$final_id = strlen( $id ) ? $id : 'dropcap-counter-' . $counter;

	/* Compose final HTML class attribute */
	$final_class = '';
	$final_class .= 'dropcap ';
	$final_class .= 'type-' . sanitize_html_class( $type ) . ' ';
	$final_class .= sanitize_html_classes( $class );
	$final_class = trim( $final_class ); 

	
	/* Compose CSS */
	$css = '';
	if ( strlen( $text_color ) ) {
		$color = new BTP_Color($text_color);		
		$css .= '#' . esc_attr($final_id) . '.dropcap.type-simple,' . "\n" .
				'#' . esc_attr($final_id) . '.dropcap.type-square {' . "\n" .
					'color: #' . $color->get_hex() . ';' ."\n" .
				'}' ."\n";
	}
	
	if ( strlen( $bg_color ) ) {
		$color = new BTP_Color($bg_color);
		$hex = $color->get_hex();
		list($from, $to) = BTP_Colorgen::get_warm_gradient( $color );
		$from_hex = $from->get_hex();
		$to_hex = $to->get_hex();
		
		$css .= '#' . esc_attr($final_id) . '.dropcap.type-square > span {' . "\n" .
					'background-color: #' . $hex . ';' . "\n" .
					'filter: progid:DXImageTransform.Microsoft.gradient(GradientType=0, startColorstr=#' . $from_hex . ', endColorstr=#ff' . $to_hex . ');' . "\n" .
					'-ms-filter: "progid:DXImageTransform.Microsoft.gradient (GradientType=0, startColorstr=#' . $from_hex . ', endColorstr=#' . $to_hex. ')";' . "\n" .
				
					'background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#' . $from_hex . '), to(#'. $to_hex . '));' . "\n" .
					'background-image: -webkit-linear-gradient(top, #' . $from_hex . ', #' . $to_hex . ');' . "\n" . 
  					'background-image:    -moz-linear-gradient(top, #' . $from_hex . ', #' . $to_hex . ');' . "\n" .
    				'background-image:     -ms-linear-gradient(top, #' . $from_hex . ', #' . $to_hex . ');' . "\n" .
    				'background-image:      -o-linear-gradient(top, #' . $from_hex . ', #' . $to_hex . ');' . "\n" .
    				'background-image:         linear-gradient(top, #' . $from_hex . ', #' . $to_hex . ');' . "\n" .
				'}' . "\n";
	}
	//$css = str_replace(array("\n", "\r"), '', $css);	
	
	/* Compose output */
	$out = '';
	
	$out .= strlen($css) ? "\n" . '<style type="text/css">' . $css . '</style>' . "\n" : '';
		
	$out .= '<span id="' . esc_attr( $final_id ) . '" ';
	$out .= 'class="' . esc_attr( $final_class ) . '" ';
	$out .= '><span>';
		$out .= $content;
	$out .= '</span></span>';
	
	return $out;			
}
add_shortcode( 'dropcap', 'btp_shortcode_dropcap' );
	


/* Add [dropcap] shortcode to the global shortcode generator */
btp_shortgen_add_item(
	'flag', 
	array(
		'label' 	=> '[flag]',
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
			'text_color'		=> array(
				'view' 			=> 'Color',
				'hint'			=> __( 'Text Color', 'btp_theme' ),
			),
			'bg_color'		=> array(
				'view' 			=> 'Color',
				'hint'			=> __( 'Background Color', 'btp_theme' ),
			),
		),	
		'content' 	=> array( 'view' => 'String' ),
		'group'		=> 'general',
		'subgroup'	=> 'basic',
		'position'	=> 650,
	)	
);



/**
 * [flag] shortcode callback function.
 * 
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_flag( $atts, $content = null ) {
	/* We need a static counter to trace a shortcode without the id attribute */
	static $counter = 0;
	$counter++;
		
	extract( shortcode_atts( array(
		'id'			=> '',
		'class'			=> '',	
		'bg_color'		=> '',
		'text_color'	=> '',	
		), $atts ) );
		
	/* Compose final HTML id attribute */
	$final_id = strlen( $id ) ? $id : 'flag-counter-' . $counter;

	/* Compose final HTML class attribute */
	$final_class = '';
	$final_class .= 'flag ';
	$final_class .= sanitize_html_classes( $class );
	$final_class = trim( $final_class );

	/* Compose final HTML style attribute */
	$final_style = '';
	if ( strlen($text_color) ) {		
		$color = new BTP_Color( $text_color );
		$final_style .= 'color: #' . $color->get_hex() . '; ';
	}
	if ( strlen($bg_color) ) {		
		$color = new BTP_Color( $bg_color );
		$final_style .= 'background: #' . $color->get_hex() . '; ';
	}
		
	/* Compose output */
	$out = '';	
	
	$out .= '<mark id="' . esc_attr( $final_id ) . '" ';
	$out .= 'class="' . esc_attr( $final_class ) . '" ';
	$out .= strlen( $final_style ) ? 'style="' . $final_style . '" ' : '';
	$out .= '>';
		$out .= htmlspecialchars(strip_tags( $content ) );
	$out .= '</mark>';
	
	return $out;
}
add_shortcode( 'flag', 'btp_shortcode_flag' );
	

/**
 * [mark] shortcode callback function.
 * 
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_mark( $atts, $content = null ) {		
	return '<span class="mark">'.$content.'</span>';				
}
add_shortcode( 'mark', 'btp_shortcode_mark' );



/* Add [lead] shortcode to the global shortcode generator */	
btp_shortgen_add_item( 
	'lead',
	array(
		'label'			=> '[lead]',
		'content'		=> array( 'view' => 'Text' ),
		'type'			=> 'block',
		'group'			=> 'general',
		'subgroup'		=> 'basic',	
		'position'		=> 1130,
	)						 
); 



/**
 * [lead] shortcode callback function.
 * 
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_lead( $atts, $content = null ) {
	/* We need a static counter to trace a shortcode without the id attribute */
	static $counter = 0;
	$counter++;
		
	extract( shortcode_atts( array(
		'id'			=> '',
		'class'			=> '',		
		), $atts ) );
		
	$content = preg_replace('#^<\/p>|<p>$#', '', $content);	
		
	/* Compose final HTML id attribute */
	$final_id = strlen( $id ) ? $id : 'lead-counter-' . $counter;

	/* Compose final HTML class attribute */
	$final_class = '';
	$final_class .= 'lead ';
	$final_class .= sanitize_html_classes( $class );
	$final_class = trim( $final_class ); 
		
	/* Compose output */
	$out = '';	
	
	$out .= '<div id="' . esc_attr( $final_id ) . '" ';
	$out .= 'class="' . esc_attr( $final_class ) . '" ';
	$out .= '>';
		$out .= do_shortcode(shortcode_unautop($content));
	$out .= '</div>';
	
	return $out;
}
add_shortcode( 'lead', 'btp_shortcode_lead' );

	

/* Add [mark] shortcode to the global shortcode generator */	
btp_shortgen_add_item( 
	'list',
	array(
		'label'			=> '[list]',
		'atts'			=> array(
			'type'			=> array( 
				'view'			=> 'Choice',
				'choices'		=> array(
						'check'			=> 'check',
						'cross'			=> 'cross',
						'plus'			=> 'plus',
						'arrow'			=> 'arrow',
						'heart'			=> 'heart',
						'pin'			=> 'pin',
						'goldstar'		=> 'goldstar',
						'silverstar'	=> 'silverstar',
						'upper-alpha' 	=> 'upper-alpha',
						'lower-alpha'	=> 'lower-alpha',
						'upper-roman'	=> 'upper-roman',
						'lower-roman'	=> 'lower-roman',
						'circle'		=> 'circle',
						'decimal'		=> 'decimal',
						'disc'			=> 'disc',							
						'square'		=> 'square',
				),
			),
		),
		'content'		=> array( 'view' => 'Text' ),
		'type' 			=> 'block',
		'group'			=> 'general',
		'subgroup'		=> 'basic',	
		'position'		=> 1150,
	)						 
); 
	


/**
 * [list] shortcode callback function.
 * 
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_list( $atts, $content = null ) {
	extract( shortcode_atts( array(			
		'type'	=> 'square',			
		), 
		$atts 
	));    
	
    $content = preg_replace('#^<\/p>|<p>$#', '', $content);
	$type = 'type-' . sanitize_html_class( $type );
	
	$content = str_replace( 
		array( '<ul', '<ol' ), 
		array( '<ul class="' . $type .'"', '<ol class="' . $type .'"' ),
		do_shortcode($content)
	);    	
    
    return $content;
}
add_shortcode( 'list', 'btp_shortcode_list' );
		
	
	
/* Add [divider] shortcode to the global shortcode generator */
btp_shortgen_add_item(
	'divider', 
	array(
		'label' 	=> '[divider]',
		'atts'			=> array(
			'type'			=> array( 
				'view'			=> 'Choice',
				'choices'		=> array(
					''					=> 'simple',
					'fish-right'		=> 'fish-right',
					'fish-left'			=> 'fish-left',
					'hand-right'		=> 'hand-right',
					'hand-left'			=> 'hand-left',
                    'help-right'		=> 'help-right',
                    'help-left'			=> 'help-left',
					'kite-right'		=> 'kite-right',
					'kite-left'			=> 'kite-left',
                    'ladybug-right'		=> 'ladybug-right',
                    'ladybug-left'		=> 'ladybug-left',
					'leaf-right'		=> 'leaf-right',
					'leaf-left'			=> 'leaf-left',
					'music-right'		=> 'music-right',	
					'music-left'		=> 'music-left',
					'origami-right'		=> 'origami-right',	
					'origami-left'		=> 'origami-left',
					'plane-right'		=> 'plane-right',
					'plane-left'		=> 'plane-left',
					'pointer-right'		=> 'pointer-right',
					'pointer-left'		=> 'pointer-left',
					'rocket-right'		=> 'rocket-right',
					'rocket-left'		=> 'rocket-left',
					'ufo-right'			=> 'ufo-right',
					'ufo-left'			=> 'ufo-left',
                    'vinyl-right'		=> 'vinyl-right',
                    'vinyl-left'		=> 'vinyl-left',
				),
			),
		),
		'type' 		=> 'block',
		'group'		=> 'general',
		'subgroup'	=> 'basic',
		'position'	=> 360, 
	)	
);



/**
 * [divider] shortcode callback function.
 * 
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_divider( $atts, $content = null ) {
	extract( shortcode_atts( array(			
		'type'	=> 'simple',			
	), $atts ));
	
	$type = preg_replace('/[^0-9a-zA-Z_-]/', '', $type);
	
	$final_class = 'divider ';
	if ( strlen( $type ) && 'simple' !== $type  ) {
		$final_class .= 'fancy ';
	}
	$final_class .= 'type-' . $type . ' ';
	$final_class = trim($final_class);
	
	$out = '';
	$out .= '<div class="' . sanitize_html_classes( $final_class ) . '">';
	if ( strlen( $type ) && 'simple' !== $type  ) {
		$out .=	'<img src="' . get_template_directory_uri() . '/images/decorator-' . $type . '.png' . '" alt="" />';
	}	
	$out .= '</div>';
	
	return $out;    
}
add_shortcode( 'divider', 'btp_shortcode_divider' );
	

/* Add [divider_top] shortcode to the global shortcode generator */
btp_shortgen_add_item(
	'divider_top', 
	array(
		'label' 	=> '[divider_top]',
		'result' 	=> '[divider_top]',
		'type' 		=> 'block',
		'group'		=> 'general',
		'subgroup'	=> 'basic',
		'position'	=> 362, 
	)	
);

	

/**
 * [divider_top] shortcode callback function.
 * 
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_divider_top( $atts, $content = null ) {			
	$out = '';	
	$out = '<div class="divider-top meta"><a class="meta" href="#">'.__('Top', 'btp_theme').'</a><div></div></div>';
	    
	return $out;    
}
add_shortcode( 'divider_top', 'btp_shortcode_divider_top' );



/* Add [divider_arrow] shortcode to the global shortcode generator */
btp_shortgen_add_item(
	'divider_arrow', 
	array(
		'label' 	=> '[divider_arrow]',
		'result' 	=> '[divider_arrow]',
		'type' 		=> 'block',
		'group'		=> 'general',
		'subgroup'	=> 'basic',
		'position'	=> 363, 
	)	
);

	

/**
 * [divider_arrow] shortcode callback function.
 * 
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_divider_arrow( $atts, $content = null ) {			
	$out = '';	
	$out = '<div class="divider-arrow"><div></div></div>';
	    
	return $out;    
}
add_shortcode( 'divider_arrow', 'btp_shortcode_divider_arrow' );




/* Add [space] shortcode to the global shortcode generator */
btp_shortgen_add_item(
	'space', 
	array(
		'label' 	=> '[space]',
		'atts' 		=> array(
			'px' 		=> array( 
				'view'		=> 'String',
				'hint'		=> __( 'The height in pixels (can be negative).', 'btp_theme' ), 
			),	
		),
		'type'		=> 'block', 
		'group'		=> 'general',
		'subgroup'	=> 'basic',
		'position'	=> 1860,	
	)
);
	


/**
 * [space] shortcode callback function.
 * 
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_space( $atts, $content = null ) {
	extract( shortcode_atts( array(			
		'px'	=> 0,			
	), $atts 
	));
	
	$px = intval( $px );
	$style = '';
	$style .= 'style="';	
	$style .= $px > 0 ? 'height: ' : 'margin-top: ';
	$style .= $px .'px;"';  
			
	$out = '';
	
	$out .= '<span class="space" ' . $style . '></span>';

	return $out;
}
add_shortcode( 'space', 'btp_shortcode_space' );
	


/**
 * [clear] shortcode callback function.
 * 
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_clear( $atts, $content = null ) {
	return '<span class="clear"></span>';
}
add_shortcode( 'clear', 'btp_shortcode_clear' );

	
	
/* Add [link] shortcode to the global shortcode generator */
btp_shortgen_add_item(
	'link', 
	array(
		'label' 	=> '[link]',
		'atts' 		=> array(
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
			'link'		=> array( 
				'view' 		=> 'String',
				'hint'		=> __( 'The destination to which the link leads', 'btp_theme' ), 
			),
			'linking'	=> array( 
		    	'view' 		=> 'Choice',
				'hint'			=> __( 'What to do when user clicks the link?', 'btp_theme' ) , 
		    	'choices' 		=> array(
					'default'		=> __( 'open in the same window', 'btp_theme' ), 
					'new-window'	=> __( 'open in a new window', 'btp_theme' ),
					'lightbox'		=> __( 'open in a lightbox', 'btp_theme' ),
				), 
			),	
			'title' 		=> array( 
				'view'			=> 'String',
				'hint'			=> __( 'The title of the link, mainly for SEO purposes', 'btp_theme' ), 
			),
		),
		'content' 	=> array( 
			'view' 		=> 'String',
			'label'		=> __( 'label', 'btp_theme' ), 
		),
		'group'		=> 'general',
		'subgroup'	=> 'basic',
		'position'	=> 1140,
	)	
);



/**
 * [link] shortcode callback function.
 * 
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_link( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'id'			=> '',
		'class'			=> '',
		'link' 			=> '#',
		'title'			=> '',
		'linking'		=> 'default',				
		), $atts 
	));
	
	if ( !strlen( $link ) || $linking == 'none') {
		return '';
	}
	
	$content = preg_replace('#^<\/p>|<p>$#', '', $content);
	
	$id = sanitize_html_class( $id );
	
	/* Compose output */
	$out 	= '';
	$rel 	= '';
	$final_class  = 'link ';	
	
	if ( !empty( $class ) ) {
		$class = explode( "\n", $class );
		if (  is_array( $class ) ) {
			$class = array_map( 'sanitize_html_class', $class );
			$class = implode( ' ', $class );
			$final_class = ' ' . $class;
		}	
	}

	
	
	switch ( $linking ) {			
		case 'lightbox':
			$rel .= 'prettyPhoto ';
			break;
		case 'new_window':	
		case 'new-window':
			$class .= 'new-window ';
			break;
		default:
			break;
	}	
	
	$out .= '<a href="' . esc_url( $link ) . '" ';
	$out .= strlen( $id ) ? 'id="' . esc_attr( $id ) . '" ' : '';
	$out .= strlen( $final_class ) ? 'class="' . $final_class . '" ' : '';
	$out .= strlen( $title ) ? 'title="' . esc_attr( $title ) . '" ' : '';
	$out .= strlen( $rel ) ? 'rel="' . esc_attr( $rel ) . '"' : '';		
	$out .= '>';		
	$out .= do_shortcode( shortcode_unautop( $content ) );
	$out .= '</a>';
			
	return $out;
}
add_shortcode( 'link', 'btp_shortcode_link' );
	
	

/* Add [table] shortcode to the global shortcode generator */
btp_shortgen_add_item(
	'table', 
	array(
		'label' 	=> '[table]',
		'atts' 		=> array(
			'type'	=> array( 
		    	'view' 		=> 'Choice', 
		    	'choices' 		=> array(
					'simple'		=> 'simple',
				), 
			),
		),
		'content' 	=> array( 'view' => 'Text' ),
		'type'		=> 'block',	
		'group'		=> 'general',
		'subgroup'	=> 'basic',
		'position'	=> 1905,
	)	
);



/**
 * [table] shortcode callback function.
 * 
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_table( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'type'			=> 'simple',
	), $atts ) );		
	$content = preg_replace('#^<\/p>|<p>$#', '', $content);
	
	$type = sanitize_html_class( str_replace( '.', '-',  $type ) );
	
	$content = 	str_replace( 
					array('<table', '</table>'),
					array( '<div class="table-wrapper"><table class="' . $type . '"', '</table></div>' ), 
					$content 
				);
	
	return do_shortcode( shortcode_unautop( $content ) );		
}
add_shortcode( 'table', 'btp_shortcode_table' );



/* Add [icon] shortcode to the global shortcode generator */
btp_shortgen_add_item(
	'icon', 
	array(
		'label' 	=> '[icon]',
		'atts' 		=> array(
			'name' 		=> array( 'view' => 'String' ),
		),
		'group'		=> 'general',
		'subgroup'	=> 'basic',
		'position'	=> 830,
	)	
);



/**
 * [icon] shortcode callback function.
 * 
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_icon( $atts, $content = null ) {
 	extract( shortcode_atts( array(
		'name' => 'check',					
		), $atts 
	));
		
	$name = preg_replace('/[^0-9a-zA-Z_-]*/', '', $name);
			
	$out = '';
	$out .= '<img class="icon" src="' . get_template_directory_uri() . '/images/shortcode_icon/'.esc_attr($name).'.png" alt="Icon: '.esc_attr($name).'" />';
					
	return $out;
}
add_shortcode( 'icon', 'btp_shortcode_icon' );
	
	
	
/**
 * [img_caption] shortcode callback function.
 * 
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_img_caption($attr, $content = null) {

	// Allow plugins/themes to override the default caption template.
	$output = apply_filters( 'img_caption_shortcode', '', $attr, $content );
	if ( $output != '' )
		return $output;

	extract(shortcode_atts(array(
		'id'	=> '',
		'align'	=> 'alignnone',
		'width'	=> '',
		'caption' => ''
	), $attr));

	if ( 1 > (int) $width || empty($caption) )
		return $content;

	if ( $id ) $id = 'id="' . esc_attr($id) . '" ';

	return '<div ' . $id . 'class="wp-caption ' . esc_attr($align) . '" style="width: ' . (10 + (int) $width) . 'px">'
	. do_shortcode( $content ) . '<p class="meta wp-caption-text">' . $caption . '</p></div>';
}
	


/* Add [visitors_only] shortcode to the global shortcode generator */
btp_shortgen_add_item(
	'only_visitors', 
	array(
		'label' 	=> '[only_visitors]',
		'atts' 		=> array(
			'message' 	=> array( 
				'view' 		=> 'String',
				'hint'		=> __( 'This will be visible to members only', 'btp_theme' ),
				 
			),
		),
		'content'	=> array( 
			'view' 		=> 'Text',
			'hint' 		=> __( 'This will be visible to visitors only', 'btp_theme' ),
		),
		'group'		=> 'general',
		'subgroup'	=> 'basic',
		'position'	=> 1480,
	)	
);

	

/**
 * [only_visitors] shortcode callback function.
 * 
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_only_visitors( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'message'	=> '',
	), $atts));

	$content = preg_replace('#^<\/p>|<p>$#', '', $content);		
			
	if ( !is_user_logged_in() ) {
		return do_shortcode( shortcode_unautop( $content ) );
	}		
	
	if ( strlen( $message ) ) {
		return '<p class="only-visitors-message">' . esc_html( $message ) . '</p>';
	}
	
	return '';
}
add_shortcode( 'only_visitors', 'btp_shortcode_only_visitors' );



/* Add [members_only] shortcode to the global shortcode generator */
btp_shortgen_add_item(
	'only_members', 
	array(
		'label' 	=> '[only_members]',
		'atts' 		=> array(
			'message' 	=> array( 
				'view' 		=> 'String',
				'hint'		=> __( 'This will be visible to visitors', 'btp_theme' ),
				 
			),
		),
		'content'	=> array( 
			'view' 		=> 'Text',
			'hint' 		=> __( 'This will be visible to members only', 'btp_theme' ),
		),
		'group'		=> 'general',
		'subgroup'	=> 'basic',
		'position'	=> 1430,
	)	
);



/**
 * [only_members] shortcode callback function.
 * 
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_only_members( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'message'	=> '',
	), $atts));

	$content = preg_replace('#^<\/p>|<p>$#', '', $content);		
	
	if ( is_user_logged_in() ) {
		return do_shortcode( shortcode_unautop( $content ) );
	}
	
	if ( strlen( $message ) ) {
		return '<p class="only-members-message">' . esc_html( $message ) . '</p>';
	}
	
	return '';
}	
add_shortcode( 'only_members', 'btp_shortcode_only_members' );



/* Add [placeholder] shortcode to the global shortcode generator */
btp_shortgen_add_item( 
	'placeholder',
	array(
		'label'			=> '[placeholder]',
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
			'width'			=> array(
				'view'			=> 'String',
				'hint'			=> __( 'The width in pixels', 'btp_theme' ),
			),
			'height'			=> array(
				'view'			=> 'String',
				'hint'			=> __( 'The height in pixels', 'btp_theme' ),
			),
			'type'		=> array( 
				'view' 			=> 'Choice',
				'choices'		=> array(
						'empty'				=> 'empty',	
						'no-image' 			=> 'no-image',
						'password-required'	=> 'password-required',
						'user'				=> 'user',
						'users'				=> 'users',
				),
			),	
		),
		'group'			=> 'general',
		'subgroup'		=> 'basic',	
		'position'		=> 1550,
	)						 
); 



/**
 * [placeholder] shortcode callback function.
 * 
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_placeholder( $atts, $content = null ) {
	/* We need a static counter to trace a shortcode without the id attribute */
	static $counter = 0;
	$counter++;
	
	extract(shortcode_atts(array(
		'id'				=> '',
		'class'				=> '',
		'align'				=> '',
		'type'				=> '',
		'size'				=> '',
		'width'				=> '',
		'height'			=> '',
	), $atts));

	$content = preg_replace('#^<\/p>|<p>$#', '', $content);
	
	/* Compose final HTML id attribute */
	$final_id = strlen( $id ) ? $id : 'placeholder-counter-' . $counter;
	
	/* Compose final HTML class attribute */
	$final_type = strlen( $type ) ? 'placeholder-' . $type .' ' : 'placeholder-default ';
	$final_align = strlen( $type ) ? 'align' . $align .' ' : ''; 
	$final_class = '';
	$final_class .= 'placeholder ';
	$final_class .= sanitize_html_classes( $final_type );
	$final_class .= sanitize_html_classes( $final_align );
	$final_class .= sanitize_html_classes( $class );
	$final_class = trim( $final_class );

	if ( strlen( $size ) ) {
		global $_wp_additional_image_sizes;	
		$value = $_wp_additional_image_sizes[ $size ];
		
		$value = array(
			'width'		=> $value[ 'width' ],
			'height' 	=> $value[ 'height' ],
		);
	
		/* Apply custom filters */
		$value = apply_filters( 'btp_shortcode_placeholder_size', $value, $size, $type );
		
		$width = $value[ 'width' ];
		$height = $value[ 'height' ];
	}
	$width = absint( $width );
	$width = $width ? $width : 1;
	
	$height = absint( $height );
	$height = $height ? $height : 1; 
	
	
	$out = '<span ' .
				'id="' . esc_attr( $final_id) . '" ' .
				'class="' . esc_attr( $final_class ) . '" ' . 
				'style="width:' . $width . 'px;" ' . 
			'>'.
				'<span class="inner" style="padding-bottom:' . $height/$width * 100 . '%;">' .
				'</span>' .
			'</span>';
		
	return $out;
}	
add_shortcode( 'placeholder', 'btp_shortcode_placeholder' );



/* Add [button] shortcode to the global shortcode generator */
btp_shortgen_add_item( 
	'frame',
	array(
		'label'			=> '[frame]',
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
			'link' 			=> array( 
				'view' 			=> 'String',
				'hint'			=> 
					__( 'The destination to which the link leads', 'btp_theme' ),	 
			),		
			'linking'		=> array( 
				'view' 			=> 'Choice',
				'hint'			=> __( 'What to do when user clicks the button?', 'btp_theme' ) ,
				'choices'		=> array(
						'default' 		=> __( 'open in the same window', 'btp_theme' ),
						'new-window'	=> __( 'open in a new window', 'btp_theme' ),
						'lightbox'		=> __( 'open in a lightbox', 'btp_theme' ),
				),
			),	
			'lightbox_group'	=> array( 
				'view' 			=> 'String',
				'hint'			=> __( 'Fill in this field, if you want different elements to be in one gallery', 'btp_theme' ) ,
			),	
			'align'			=> array( 
				'view'			=> 'Choice',
				'choices'		=> array(
						'left' 		=> 'left',
						'center'	=> 'center',
						'right'	  	=> 'right',
				),
			),
			'type'			=> array( 
				'view'			=> 'Choice',
				'choices'		=> array(
						'simple-shadow'		=> 'simple-shadow',
						'simple'			=> 'simple',
						'shadow'	 		=> 'shadow',
						'easel'				=> 'easel',
						'board'				=> 'board',
						'projector-screen'	=> 'projector-screen',
						'paper-stack'		=> 'paper-stack',
				),
			),
		),
		'content'		=> array( 'view' => 'Text' ),
		'group'			=> 'general',
		'subgroup'		=> 'basic',	
		'position'		=> 680,
	)						 
); 



/**
 * [frame] shortcode callback function.
 * 
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_frame( $atts, $content = null ) {
	/* We need a static counter to trace a shortcode without the id attribute */
	static $counter = 0;
	$counter++;
	
	extract(shortcode_atts(array(
		'id'				=> '',
		'class'				=> '',
		'align'				=> '',
		'link'				=> '',
		'title'				=> '',
		'linking'			=> 'default',
		'lightbox_group'	=> '',
		'type'				=> 'simple',
	), $atts));

	$content = preg_replace('#^<\/p>|<p>$#', '', $content);
	
	$is_link = strlen( $link ) ? true : false;
	$rel = '';
	$indicator = '';
	$helpers = '';
	
	/* Compose final HTML id attribute */
	$final_id = strlen( $id ) ? $id : 'frame-counter-' . $counter;
	
	/* Compose final HTML class attribute */
	$final_class = 	'frame '.	
					'type-' . $type . ' ' .
					( strlen( $align ) ? 'align' . $align . ' ' : '' );
			
	/* Process the linking attribute */ 
	switch( $linking ) {
		case 'new-window':
		case 'new_window':
			$final_class .= 'new-window ';
			$indicator = do_shortcode('[indicator type="new-window"]');
			break;

		case 'lightbox':
			$rel = strlen( $lightbox_group) ? 'prettyPhoto[' . $lightbox_group . ']' : 'prettyPhoto';
			$indicator = do_shortcode('[indicator type="zoom"]');
			break;			
				
		case 'standard':
		case 'default':
		default:	
			$indicator = do_shortcode('[indicator type="document"]');
			break;		
	}

	/* Build helpers based on the type attribute */
	switch( $type ) {
		case 'easel':
			$helpers = 	'<span class="hlp-1"></span>' .
						'<span class="hlp-2"></span>';
			break;
									
		case 'paper-stack':
			$helpers = 	'<span class="hlp-1"></span>' .
						'<span class="hlp-2"></span>' .
						'<span class="hlp-3"></span>' .
						'<span class="hlp-4"></span>';
			break;

		case 'projector-screen':
			$helpers = 	'<span class="hlp-1"></span>' .
						'<span class="hlp-2"></span>' .
						'<span class="hlp-3"></span>' .
						'<span class="hlp-4"></span>' .
						'<span class="hlp-5"></span>';
			break;		
					
		case 'board':
			$helpers = 	'<span class="hlp-1"></span>' .
						'<span class="hlp-2"></span>' .
						'<span class="hlp-3"></span>' .
						'<span class="hlp-4"></span>' .
						'<span class="hlp-5"></span>' .
						'<span class="hlp-6"></span>';
			break;	
	}
	
	/* Trim the class value */
	$final_class = trim( $final_class );
	
	/* Compose the template */
	$out =	'<%tag%%href%%id%%class%%rel%%title%>' . "\n" .
				"\t" . '<span class="decorator">' . "\n" .
					"\t\t" . '<span class="outer">' . "\n" .
						"\t\t\t" . '<span class="inner">' . "\n" .
							"\t\t\t\t" . '%content%' .  "\n" .
							"\t\t\t\t" . '%indicator%' .  "\n" .
						"\t\t\t" . '</span>' . 
						"\t\t\t" .'%helpers%' .  "\n" .
					 "\t\t" . '</span>' .  "\n" .
				"\t" . '</span>' .  "\n" .	
			'</%tag%>';

	/* Fill in the template */
	$out = str_replace(
		array(
			'%tag%',
			'%href%',
			'%id%',
			'%class%',
			'%rel%',
			'%title%',
			'%content%',
			'%indicator%',
			'%helpers%',
		),
		array(
			$is_link ? 'a' : 'span',
			$is_link ? ' href="' . esc_url( $link ) . '"' : '',
			' id="' . esc_attr( $final_id ) . '"',
			' class="' . sanitize_html_classes( $final_class ) . '"',
			strlen( $rel ) ? ' rel="' . esc_attr( $rel ) . '"' : '',
			strlen( $title ) ? ' title="' . esc_attr( $title ) . '"' : '',
			do_shortcode( $content ),
			$indicator,
			$helpers,
		),
		$out
	);				
						
	return $out;
}	
add_shortcode( 'frame', 'btp_shortcode_frame' );



/* Add [testimonial] shortcode to the global shortcode generator */
btp_shortgen_add_item( 
	'testimonial',
	array(
		'label'			=> '[testimonial]',
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
			'name' 			=> array( 'view' => 'String' ),
			'job_title' 	=> array( 'view' => 'String' ),
			'company' 		=> array( 'view' => 'String' ),
			'company_link'	=> array( 'view' => 'String' ),
			'size'			=> array( 
				'view'			=> 'Choice',
				'choices'		=> array(
						'small' 	=> 'small',
						'medium'	=> 'medium',
						'big'	  	=> 'big',
				),
			),
			'type'		=> array( 
				'view' 			=> 'Choice',
				'choices'		=> array(
						'simple' 		=> 'simple',
						'quote'			=> 'quote',
						'bubble'		=> 'bubble',
				),
			),
		),
		'content'		=> array( 'view' 	=> 'Text'),
		'type'			=> 'block',	
		'group'			=> 'general',
		'subgroup'		=> 'basic',		
		'position'		=> 1940,
	)						 
); 



/**
 * [testimonial] shortcode callback function.
 * 
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_testimonial( $atts, $content = null ) {
	/* We need a static counter to trace a shortcode without the id attribute */
	static $counter = 0;
	$counter++;
	
	extract(shortcode_atts(array(
		'id'				=> '',		
		'class'				=> '',
		'size'				=> 'small',
		'type'				=> 'simple',
		'name'				=> '',		
		'job_title'			=> '',
		'company'			=> '',
		'company_link'		=> '',
	), $atts));

	$content = preg_replace('#^<\/p>|<p>$#', '', $content);
	
	/* Compose final HTML id attribute */
	$final_id = strlen( $id ) ? $id : 'testimonial-counter-' . $counter;
	
	/* Compose final HTML class attribute */
	$final_class = '';
	$final_class .= 'testimonial ';
	$final_class .= sanitize_html_classes( 'type-' . $type ). ' ';
	$final_class .= sanitize_html_classes( 'size-' . $size ). ' ';
	$final_class .= sanitize_html_classes( $class );
	$final_class = trim( $final_class );
	
	$out = '';
	$out .= '<div id="' . esc_attr( $final_id ) . '" ';
	$out .= 'class="' . esc_attr( $final_class ) . '" ';
	$out .= '>';
		$out .= '<div class="inner">';
			$out .= do_shortcode( $content );
			$out .= '<div class="meta helper">&#8220;</div>';
		$out .= '</div>';
		
		$meta = '';
		$meta .= strlen( $name ) ? '<strong>' . esc_html( $name ) . '</strong>' : '';
		$meta .= strlen( $job_title ) ? '<span>' . esc_html( $job_title ) . '</span>' : '';
		$meta .= strlen( $company_link ) ? '<a href="' . esc_url( $company_link ) . '">' : '';
		$meta .= strlen( $company ) ? '<span>' . esc_html( $company ) . '</span>' : '';
		$meta .= strlen( $company_link ) ? '</a>' : '';
		$meta = trim( $meta );
		
		if ( strlen( $meta ) ) {
			$out .= '<p class="meta">' . $meta . '</p>';
		}	
		
	$out .= '</div>';
		
	return $out;
}	
add_shortcode( 'testimonial', 'btp_shortcode_testimonial' );



foreach ( array( 
			'heading_1', 
			'heading_2',
			'heading_3',
			'heading_4',
			'heading_5',
			'heading_6' ) as $i => $s ) {
	btp_shortgen_add_item(
		$s, 
		array(
			'label' 	=> '[' . $s. ']',
			'atts' 		=> array(
				'type'		=> array( 
			    	'view' 		=> 'Choice', 
			    	'choices' 	=> array(
						'simple'	=> 'simple',
						'divider'	=> 'divider',
					),
				),
			),
			'content' 	=> array( 'view' => 'Text' ),
			'type'		=> 'inline',
			'group'		=> 'general',
			'subgroup'	=> 'basic',
			'position'	=> 820 + $i,	
		)	
	);
}



/**
 * [heading] shortcode callback function.
 * 
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_heading_x( $x, $atts, $content = null ) {
	/* We need a static counter to trace a shortcode without the id attribute */
	static $counter = 0;
	$counter++;
	
	extract(shortcode_atts(array(
		'id'				=> '',		
		'class'				=> '',
		'type'				=> 'simple',		
	), $atts));

	$content = preg_replace('#^<\/p>|<p>$#', '', $content);
	
	$x = absint( $x );
	
	/* Compose final HTML id attribute */
	$final_id = strlen( $id ) ? $id : 'heading-counter-' . $counter;
	
	/* Compose final HTML class attribute */
	$final_class = '';
	$final_class .= 'heading heading-' . $x . ' ';
	$final_class .= sanitize_html_classes( 'type-' . $type ). ' ';
	$final_class .= sanitize_html_classes( $class );
	$final_class = trim( $final_class );
	
	$out = '';
	$out .= '<div id="' . esc_attr( $final_id ) . '" ';
	$out .= 'class="' . esc_attr( $final_class ) . '" ';
	$out .= '>';		
		$out .= '<h' . $x . '>';
		$out .= '<span class="inner"><span class="helper-1"></span>' . do_shortcode( $content ) . '<span class="helper-2"></span></span>';
		$out .= '</h' . $x .'>';		
	$out .= '</div>';
		
	return $out;
}	
function btp_shortcode_heading_1( $atts, $content = null ) { return btp_shortcode_heading_x( 1, $atts, $content ); }
add_shortcode( 'heading_1',	'btp_shortcode_heading_1' );	
function btp_shortcode_heading_2( $atts, $content = null ) { return btp_shortcode_heading_x( 2, $atts, $content ); }
add_shortcode( 'heading_2',	'btp_shortcode_heading_2' );	
function btp_shortcode_heading_3( $atts, $content = null ) { return btp_shortcode_heading_x( 3, $atts, $content ); }
add_shortcode( 'heading_3',	'btp_shortcode_heading_3' );	
function btp_shortcode_heading_4( $atts, $content = null ) { return btp_shortcode_heading_x( 4, $atts, $content ); }
add_shortcode( 'heading_4',	'btp_shortcode_heading_4' );	
function btp_shortcode_heading_5( $atts, $content = null ) { return btp_shortcode_heading_x( 5, $atts, $content ); }
add_shortcode( 'heading_5',	'btp_shortcode_heading_5' );	
function btp_shortcode_heading_6( $atts, $content = null ) { return btp_shortcode_heading_x( 6, $atts, $content ); }
add_shortcode( 'heading_6',	'btp_shortcode_heading_6' );



foreach ( array( 
			'subheading_1', 
			'subheading_2',
			'subheading_3',
			'subheading_4',
			'subheading_5',
			'subheading_6' ) as $i => $s ) {
	btp_shortgen_add_item(
		$s, 
		array(
			'label' 	=> '[' . $s. ']',
			'content' 	=> array( 'view' => 'Text' ),
			'type'		=> 'inline',
			'group'		=> 'general',
			'subgroup'	=> 'basic',
			'position'	=> 1870 + $i,	
		)	
	);
}



/**
 * [subheading] shortcode callback function.
 * 
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_subheading_x( $x, $atts, $content = null ) {
	/* We need a static counter to trace a shortcode without the id attribute */
	static $counter = 0;
	$counter++;
	
	extract(shortcode_atts(array(
		'id'				=> '',		
		'class'				=> '',
	), $atts));

	$content = preg_replace('#^<\/p>|<p>$#', '', $content);
	
	$x = absint( $x );
	
	/* Compose final HTML id attribute */
	$final_id = strlen( $id ) ? $id : 'subheading-counter-' . $counter;
	
	/* Compose final HTML class attribute */
	$final_class = '';
	$final_class .= 'subheading h' . $x . ' ';
	$final_class .= sanitize_html_classes( $class );
	$final_class = trim( $final_class );
	
	$out = '';
	$out .= '<p id="' . esc_attr( $final_id ) . '" ';
	$out .= 'class="' . esc_attr( $final_class ) . '" ';
	$out .= '>';
		$out .= do_shortcode( $content );
	$out .= '</p>';
		
	return $out;
}	
function btp_shortcode_subheading_1( $atts, $content = null ) { return btp_shortcode_subheading_x( 1, $atts, $content ); }
add_shortcode( 'subheading_1',	'btp_shortcode_subheading_1' );	
function btp_shortcode_subheading_2( $atts, $content = null ) { return btp_shortcode_subheading_x( 2, $atts, $content ); }
add_shortcode( 'subheading_2',	'btp_shortcode_subheading_2' );	
function btp_shortcode_subheading_3( $atts, $content = null ) { return btp_shortcode_subheading_x( 3, $atts, $content ); }
add_shortcode( 'subheading_3',	'btp_shortcode_subheading_3' );	
function btp_shortcode_subheading_4( $atts, $content = null ) { return btp_shortcode_subheading_x( 4, $atts, $content ); }
add_shortcode( 'subheading_4',	'btp_shortcode_subheading_4' );	
function btp_shortcode_subheading_5( $atts, $content = null ) { return btp_shortcode_subheading_x( 5, $atts, $content ); }
add_shortcode( 'subheading_5',	'btp_shortcode_subheading_5' );	
function btp_shortcode_subheading_6( $atts, $content = null ) { return btp_shortcode_subheading_x( 6, $atts, $content ); }
add_shortcode( 'subheading_6',	'btp_shortcode_subheading_6' );	



/**
 * [fluid_wrapper] shortcode callback function.
 * 
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_fluid_wrapper( $atts, $content = null ) {
	/* We need a static counter to trace a shortcode without the id attribute */
	static $counter = 0;
	$counter++;
		
	extract( shortcode_atts( array(
		'id'			=> '',
		'class'			=> '',
		'width'			=> '',
		'height'		=> '',		
		), $atts ) );
		
	$content = preg_replace('#^<\/p>|<p>$#', '', $content);	
		
	/* Compose final HTML id attribute */
	$final_id = strlen( $id ) ? $id : 'fluid-wrapper-counter-' . $counter;

	/* Compose final HTML class attribute */
	$final_class = '';
	$final_class .= 'fluid-wrapper ';
	$final_class .= sanitize_html_classes( $class );
	$final_class = trim( $final_class );
	
	/* Get width and height values */
	$width = absint( $width );
	$height = absint( $height );
	
	if ( !$width ) {
		$re = '/width=[\'"]?(\d+)[\'"]?/';	
		$width = preg_match($re, $content, $match);
		$width = $width ? absint($match[1]) : 0;
	}	
		
	if ( !$height ) {
		$re = '/height=[\'"]?(\d+)[\'"]?/';	
		$height = preg_match($re, $content, $match);
		$height = $height ? absint($match[1]) : 0;
	}	
	
	/* Compose output */
	$out = 	'<div id="%id%" class="%class%" %outer_style%>' .
				'<div class="inner" %inner_style%>' .
					'%content%' .
				'</div>' .
			'</div>';
	$out = str_replace(
		array(
			'%id%',
			'%class%',
			'%outer_style%',
			'%inner_style%',
			'%content%',
		),
		array(
			esc_attr( $final_id ),
			esc_attr( $final_class ),
			( $width && $height ? 'style="width:' . absint($width).  'px;"' : '' ), 
			( $width && $height ? 'style="padding-bottom:' . ( absint($height) / absint( $width ) ) * 100 . '%;"' : '' ),
			do_shortcode(shortcode_unautop($content))
		),
		$out
	);	
	
	return $out;
}
add_shortcode( 'fluid_wrapper', 'btp_shortcode_fluid_wrapper' );



function btp_shortcode_fluid_wrapper_embed_oembed_html( $html, $url, $attr ) {	
   	return do_shortcode( '[fluid_wrapper]' . $html . '[/fluid_wrapper]');
}
add_filter( 'embed_oembed_html', 'btp_shortcode_fluid_wrapper_embed_oembed_html', 10, 999 );



/**
 * [indicator] shortcode callback function.
 * 
 * @param 			array $atts
 * @param			string $content
 * @return			string
 */
function btp_shortcode_indicator( $atts, $content = null ) {	
	extract( shortcode_atts( array(
		'type'			=> 'document',
		), $atts ) );
	
	/* Compose output */
	$out = '<span class="indicator indicator-' . sanitize_html_class( $type ) . '"><span></span><span></span></span>';
	
	return $out;
}
add_shortcode( 'indicator', 'btp_shortcode_indicator' );

?>