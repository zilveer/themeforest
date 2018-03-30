<?php                 
/**
 * The functions for the colors of the theme 
 * 
 * @package WordPress
 * @subpackage YIW Themes
 * @since 1.0 
 */   

// the color 
include_once YIW_THEME_FUNC_DIR . 'colors.php';

function yiw_retrieve_color_options( &$yiw_options ) {
	$yiw_options = yiw_retrieve_customizable_options( $yiw_options, 'colors' );
}

function yiw_get_color($name, $echo = TRUE, $default = FALSE)
{
    global $yiw_colors, $color_theme;
           
	$color = '';
	                                    
    // retrieve the default colors
	$default_color = array();
	foreach ( $yiw_colors as $section => $the_ )
		foreach ( $the_['options'] as $id => $args )
			$default_color[$id] = $args['default'];
    
    $color = '';
    if( yiw_get_option( 'colors_' . $name, '' ) != '' )
        $color = yiw_get_option( 'colors_' . $name ); 
    else
		$default = TRUE;  
    
    if( $default && isset( $default_color[$name] ) )
    	$color = $default_color[$name]; 
    
    if($echo) echo $color;
    return $color;
}

function yiw_css_color( $name, $prop, $important = '', $echo = true )
{                          
    if ( substr( $name, 0, 1) == '#' )
        $color = $name;
    else
        $color = yiw_get_color( $name, false );
    
    if ( $important === true )
        $important = '!important';
        
    if ( $prop == '' || $color == '' )
    	return '';
        
	//echo $prop, ':', $color, ';';
	$r = "$prop:$color$important;";
	
	if ( $echo )
		echo $r;
	
	return $r;
}
     
// scale: 0 = black, 765 = white     
// $hex_color = color to change
// $hex_pattern = base color
// $default = default color
function yiw_compareColor ( $hex_color, $hex_pattern, $default )
{                                            
    if ( $hex_color == $hex_pattern )
        return $hex_color;
    
    $hex_color = str_replace( '#', '', $hex_color ); 
    $hex_pattern = str_replace( '#', '', $hex_pattern );
    $default = str_replace( '#', '', $default );
    
    $dec1 = hexdec( $hex_color );
    $dec2 = hexdec( $hex_pattern );
    $dec_default = hexdec( $default );   

    $diff = $dec1 - $dec_default;  
    
//     echo "
// hex_color: $hex_color;
// hex_pattern: $hex_pattern;
// default: $default;
// 
// dec_color: $dec1;
// dec_pattern: $dec2;
// dec_default: $dec_default;\n\n";
//     
//     echo "diff: $diff;\n\n";
    
    $new_dec = $dec2 + $diff;

    return '#'  . str_pad( dechex( $new_dec ), 2, '0', 0 );
}
?>