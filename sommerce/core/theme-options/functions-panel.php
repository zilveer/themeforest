<?php                      

function yiw_message()
{
	$message = array(
		'element_exists' => yiw_error_message( __( 'The element you have written is already exists. Please, add another name.', 'yiw' ), false ),
		'saved' => yiw_updated_message( '<strong>'.__('Settings saved', 'yiw').'.</strong>', false ),
		'reset' => yiw_updated_message( '<strong>'.__('Settings reset', 'yiw').'.</strong>', false ),
		'delete' => yiw_updated_message( '<strong>' . __( 'Element deleted correctly.', 'yiw' ) . '</strong>', false ),
		'updated' => yiw_updated_message( '<strong>' . __( 'Element updated correctly.', 'yiw' ) . '</strong>', false ),
		'imported' => yiw_updated_message( '<strong>' . __( 'Database imported correctly.', 'yiw' ) . '</strong>', false ),
		'no-imported' => yiw_error_message( '<strong>' . __( 'An error encoured during during import. Please try again.', 'yiw' ) . '</strong>', false ),
	    'file-not-valid' => yiw_error_message( '<strong>' . __( "The file you have insert doesn't valid.", 'yiw' ) . '</strong>', false ),
	    'cant-import' => yiw_error_message( '<strong>' . __( "I'm sorry, the import featured is disabled.", 'yiw' ) . '</strong>', false ),
	    'ord' => yiw_updated_message( '<strong>' . __( "Sorting done correctly.", 'yiw' ) . '</strong>', false )
	); 
	
	if( isset( $_GET['message'] ) )
		echo $message[ $_GET['message'] ];
}                           

// retrieve all options form database and put them into an array
function yiw_theme_options_from_db() {     
	$current_theme = get_template();
	
	$options = get_option( YIW_OPTIONS_DB . '_' . $current_theme );
	
	if ( false === $options || ( isset( $_REQUEST['yiw-action'] ) && $_REQUEST['yiw-action'] == 'reset' ) ) {
	  	$options = yiw_get_default_options();
	  	yiw_update_theme_options( $options );
	}
	
	return $options;
}      

// generate array with all default values
function yiw_get_default_options() {
    global $yiw_theme_options_items;
    
    $yiw_options = array();                    
    
    foreach( $yiw_theme_options_items as $item => $v )
    {      
    	$path = YIW_THEME_FUNC_DIR . "theme-options/$item-options.php";
		if ( file_exists( $path ) )                                                
        	include $path;  
    }                               
    
    $default_options = array();
    foreach ( $yiw_options as $tab => $sections )
        foreach ( $sections as $section )
            foreach ( $section as $id => $value )
                if ( isset( $value['std'] ) && isset( $value['id'] ) )
                    $default_options[ $value['id'] ] = $value['std'];
    
    unset( $yiw_options );
    
    return $default_options;
}        

// get name of field for options
function yiw_option_name( $id, $echo = true ) {
	$name = YIW_OPTIONS_DB . '[' . $id . ']';
	
	if ( $echo )
		echo $name;
	else
		return $name;
}                     

// get id of field for options
function yiw_option_id( $id, $echo = true ) {
	$name = str_replace( '_', '-', YIW_OPTIONS_DB ) . '-' . $id;
	
	if ( $echo )
		echo $name;
	else
		return $name;
} 

function yiw_get_option( $var, $default = false )
{                               
    global $yiw_theme_options, $post;        
    
    if ( isset( $post->ID ) )
    	$option = get_post_meta( $post->ID, $var, true );
    else
    	$option = '';
    
    if ( $option != '' || $option != false )
    	return $option;
    
    if ( isset( $yiw_theme_options[ $var ] ) )
        return $yiw_theme_options[ $var ];
    else 
        return $default;
}  

function yiw_delete_option( $var )
{                               
    global $yiw_theme_options;        
    
    unset( $yiw_theme_options[$var] );
    yiw_update_theme_options();
}       

/**
 * Retrieve the defualt value of $var option and update the database with this missing value
 */
function yiw_get_default_option( $var )
{
	global $yiw_theme_options;
	
    $default_options = yiw_get_default_options();
    
    // update the database with default value, just retrieved
	$yiw_theme_options[ $var ] = $default_options[ $var ];
	yiw_update_theme_options();
    
    return $default_options[ $var ];
}                   

// add items to admin bar
if( version_compare($wp_version, "3.1", ">=") )
{
	function yiw_add_items_admin_bar()
	{
		global $yiw_theme_options_items, $wp_admin_bar; 
        
        if ( ! current_user_can('manage_options') )    
            return;    
			
		$wp_admin_bar->add_menu( array(   
			//'parent' => false,
			'title' => __( 'Theme Options', 'yiw' ),    
	        'id' => "theme-options",
	        'href' => admin_url('themes.php')."?page=yiw_panel" 
	    ) );
		
		foreach( $yiw_theme_options_items as $item => $title )
		{			
			$wp_admin_bar->add_menu( array(   
				'parent' => "theme-options",
				'title' => $title,    
		        'id' => "theme-options-$item",
		        'href' => admin_url('themes.php')."?page=yiw_panel&tab=$item" 
		    ) );                    
		}
	}
	//add_action( 'wp_before_admin_bar_render', 'yiw_add_items_admin_bar' );
	add_action( 'admin_bar_menu', 'yiw_add_items_admin_bar', 100 );
}                 

function yiw_get_tabs_path_files() {          
    $theme_files_path = YIW_THEME_FUNC_DIR . '/theme-options/';
    $core_files_path  = YIW_FRAMEWORK_PATH . '/theme-options/options/';
    
    $tabs = array();
    
    foreach ( glob( $theme_files_path . '*.php' ) as $filename ) {
		preg_match( '/(.*)-options\.(.*)/', basename( $filename ), $filename_parts );
		$tab = $filename_parts[1];
		
		$tabs[$tab] = $filename;
	}
    
    foreach ( glob( $core_files_path . '*.php' ) as $filename ) {
		preg_match( '/(.*)-options\.(.*)/', basename( $filename ), $filename_parts );
		$tab = $filename_parts[1];
		
		$tabs[$tab] = $filename;
	}
	
	return $tabs;
}               

function yiw_get_current_tab() {   
	global $yiw_tabs_path;
	       
    if ( !isset( $_GET['page'] ) || $_GET['page'] != 'yiw_panel' )
        return false;

    if ( isset( $_REQUEST['yiw_tab_options'] ) )
    	return $_REQUEST['yiw_tab_options'];
    elseif ( isset( $_GET['tab'] ) && isset( $yiw_tabs_path[ $_GET['tab'] ] ) )
    	return $_GET['tab'];
    else
        return 'general'; 
}   

// save all options into the database
function yiw_update_theme_options( $options = false ) {
	global $yiw_theme_options;
	
	if ( ! $options )
		$options = $yiw_theme_options;
	
	update_option( YIW_OPTIONS_DB . '_' . get_template(), $options );
}  

// get the options from the post request
function yiw_post_option( $request, $default = false ) {
	if ( ! isset( $_REQUEST[ YIW_OPTIONS_DB ][ $request ] ) )
		return $default;
	
	return $_REQUEST[ YIW_OPTIONS_DB ][ $request ];  
}  

function yiw_get_name_field( $id )
{
    return 'contact_options[' . $id . ']'; 
}

function yiw_name_field( $id )
{
    echo yiw_get_name_field( $id ); 
}

function yiw_cleanArray($arr)
{
	$new_array = $arr;
	
	$clean = false;
	
	foreach($new_array as $key => $values)
	{
		if( is_array($values) )
		{
			foreach($values as $k => $v)
			{
				if( $k == 'slide_title' OR $k == 'tooltip_content' OR $k == 'image_url' OR $k == 'url_video' ) {
    				if( empty( $v ) )
    				{                  
    					$clean = TRUE; 
    				}
    				else
    				{          
    					$clean = FALSE;
    					break;  
    				}
    			}
			}	
			
			if( $clean ) unset( $new_array[$key] ); 
		}
		else return $new_array;
	}
	
	return $new_array;
}    

function yiw_num_( $from, $to )
{
	$r = array();
	
	for( $i = $from; $i <= $to; $i++ )
		$r[$i] = $i;
	
	return $r;
}                   

function yiw_get_list_forms( $addFirst = true )
{
    global $yiw_theme_options;
    
	$forms = maybe_unserialize( yiw_get_option( 'contact_forms', array() ) );
	
	if ( empty( $forms ) )
	   return array();
	
	$return = array();
	
	if( $addFirst )
		$return[''] = '';
	
	foreach( ( array ) $forms as $form )
		$return[ sanitize_title( $form ) ] = $form;
	
	return $return;
}

function yiw_get_first_form()
{
	foreach( yiw_get_list_forms() as $id => $form )
		return $id;
}

function yiw_get_contact_form_shortcode()
{
    $name = yiw_get_option( 'contact_form_choosen' );
	
	return '[contact_form id="' . $name . '"]';
}

function yiw_check_if_exists( $value, $array, $check = 'value' )
{
	$match = array();
	
	if ( ( $check == 'value' && ! in_array( $value, $array ) ) || ( $check == 'key' && ! isset( $array[$value] ) ) )
		return $value;
	else {
		if ( ! preg_match( '/([a-z]+)-([0-9]+)/', $value, $match ) )
			$i = 1;
		else {
			$i = intval( $match[2] ) + 1;
			$value = $match[1];
		}
		return yiw_check_if_exists( $value . '-' . $i, $array, $check );
	}
}

function yiw_updated_message( $message, $echo = true ) {
	$message = '<div id="message" class="updated fade"><p>' . $message . '</p></div>';
	
	if ( $echo )
		echo $message;
	
	return $message;
}

function yiw_error_message( $message, $echo = true ) {
	$message = '<div id="message" class="error fade"><p>' . $message . '</p></div>';
	
	if ( $echo )
		echo $message;
	
	return $message;
}          

                                  
function yiw_panel_url()
{
	return get_template_directory_uri() . '/core/theme-options';
}           

function _is_yiw_panel() {
    return ( isset( $_GET['page'] ) && $_GET['page'] == 'yiw_panel' );
}           

// generate the css roles for customizable colors
function yiw_custom_css_roles( $type ) { 
	
	$roles = $callback = array();
	
	switch ( $type ) :
	
		case 'colors' :
			$roles = $GLOBALS['yiw_colors'];
			$callback = 'yiw_get_color';
			$pattern = '%s { %s:%s%s; }';
			break;
		
		case 'fonts' :
			$roles = $GLOBALS['yiw_sizes'];    
			$callback = 'yiw_get_font_option'; 
			$pattern = '%s { %s:%dpx%s; }';
			break;
	
	endswitch;
	
	$css = '';
	
	foreach ( $roles as $section => $the_ ) {
		foreach ( $the_['options'] as $id => $args ) {
			$value = call_user_func_array( $callback, array( $id, false ) );
			if ( $value != $args['default'] && $value != '' && $value != false ) {
                $roles = array();
                
                $important = ( isset( $args['important'] ) && $args['important'] ) ? ' !important' : '';
                
                if ( isset( $args['roles'] ) && is_array( $args['roles'] ) && ! empty( $args['roles'] ) )
                    foreach ( $args['roles'] as $role )
                        $roles[] = sprintf( $pattern . "\n", $role['css_role'], $role['css_attr'], $value, $important );
                else
                    $roles[] = sprintf( $pattern . "\n", $args['css_role'], $args['css_attr'], $value, $important );
                
				$css .= implode( ' ', $roles ); 
			}
		}
	}
	
	echo $css;
}     

// retrieve the options from external array (general used for fonts and colors)
function yiw_retrieve_customizable_options( $c_options, $type ) {
	$options = array();
	
	switch ( $type ) :
	
		case 'colors' :
			$options = $GLOBALS['yiw_colors'];
			$type_option = 'color-picker';
			break;
		
		case 'fonts' :
			$options = $GLOBALS['yiw_sizes'];     
			$type_option = 'slider_control';
			break;
	
	endswitch;
	
	foreach ( $options as $section => $the_ ) { 
		
		$c_options[ $section ][] = array( 'type' => 'section', 'name' => $the_['name-section'] );
		$c_options[ $section ][] = array( 'type' => 'open' );
		
		foreach ( $the_['options'] as $id => $args ) {
			$c_options[ $section ][] = array(
				'name' 	=> $args['panel_title'],
				'desc' 	=> $args['panel_desc'],
				'id'	=> $type . '_' . $id,
				'type'	=> $type_option,
				'std'	=> ( $type == 'colors' ) ? yiw_get_color( $id, false, true ) : $args['default'],
				'min'	=> 1,
				'max'	=> 50
			);	
		}
		
		$c_options[ $section ][] = array( 'type' => 'close' );
	}
	
	return $c_options;
}

function yiw_end_process( $url, $ajax = false ) { 
	if ( isset( $_REQUEST['section-opened'] ) )
	   $url = esc_url( add_query_arg( 'section_opened', str_replace( '-section', '', $_REQUEST['section-opened'] ), $url ) ) . '#' . $_REQUEST['section-opened'];
    
    if( !$ajax ) 
		wp_redirect( $url );
	else
		echo $url;
	die;
}

// print a message if the contact form choosen is empty
function yiw_message_contact_form_empty() {
    if ( basename($_SERVER['PHP_SELF']) != 'themes.php' && 
         ( ! isset( $_GET['page'] ) || isset( $_GET['page'] ) && $_GET['page'] != 'yiw_panel' ) &&
         ( ! isset( $_GET['tab'] ) || isset( $_GET['tab'] ) && $_GET['tab'] != 'contact' ) )
        return;
    
    $yiw_form_choosen = yiw_get_option( 'contact_form_choosen', '' );
    
    if ( empty( $yiw_form_choosen ) || $yiw_form_choosen == 'none' )
        return;
    
    $fields = yiw_get_option( 'contact_fields_' . $yiw_form_choosen );
    $fields = maybe_unserialize( $fields );
    
    if ( empty( $fields ) ) { ?>
        <div id="message" class="error fade"><p>
        <?php _e( 'The contact form choosen is empty, so the form will not shown in the page.', 'yiw' ) ?>
        </p></div>
    <?php }           
}
add_action( 'admin_notices', 'yiw_message_contact_form_empty' ); 
?>