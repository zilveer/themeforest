<?php
/**
 * Widgets
 * 
 * Main file for manage widget.     
 * 
 * @package WordPress
 * @subpackage WP Framework YI
 * @since 1.0
 */
 
define( 'YIW_WIDGETS_FOLDER', YIW_THEME_FUNC_DIR . 'widgets/' );  
define( 'YIW_DEFAULT_WIDGETS_FOLDER', YIW_FRAMEWORK_PATH . 'default-widgets/' );  

$yiw_widgets = yiw_get_widgets();

foreach ( $yiw_widgets as $location => $widgets )
	foreach ( $widgets as $widget )
		if ( $location == 'default' )
    		include_once YIW_DEFAULT_WIDGETS_FOLDER . $widget . '.php';
    	else
    		include_once YIW_WIDGETS_FOLDER . $widget . '.php';   
  
add_action( 'widgets_init', 'yiw_register_widgets' );  
add_action( 'widgets_init', 'yiw_unregister_widgets' ); 
                                                              

/**
 * Retrieve all widgets that are in the theme, both within 'core' folder, then 'inc' folder 
 * 
 * @since 1.0  
 *  
 * @return array An array with all widgets name 
 */
function yiw_get_widgets() {
	$widgets = array();  
	
	$file_widgets = yiw_list_files_into( YIW_WIDGETS_FOLDER );
	foreach ( $file_widgets as $file ) {
	    if ( ! preg_match( '/(.*).php/', $file ) ) continue;
		$name = preg_replace( '/(.*).php/', '$1', $file );
		$widgets['theme'][] = $name;
	}
	
	$file_widgets = yiw_list_files_into( YIW_DEFAULT_WIDGETS_FOLDER );
	foreach ( $file_widgets as $file ) {                      
	    if ( ! preg_match( '/(.*).php/', $file ) ) continue;
		$name = preg_replace( '/(.*).php/', '$1', $file );
		if ( ! in_array( $name, $widgets['theme'] ) )
		    $widgets['default'][] = $name;
	}
	
	return $widgets;			
}

/**
 * register all widgets of the theme
 * 
 * @since 1.0  
 */
function yiw_register_widgets() 
{
    global $yiw_widgets;
    
	foreach ( $yiw_widgets as $location => $widgets )
		foreach ( $widgets as $widget )
        	register_widget( $widget );
}                       

/**
 * unregister all default WP Widgets
 * 
 * @since 1.0  
 */
function yiw_unregister_widgets() 
{ 
	$excluded = array();
	$excluded = apply_filters( 'yiw_exlude_widgets', $excluded );
	
	foreach ( $excluded as $widget )
		unregister_widget( $widget );		
}
?>