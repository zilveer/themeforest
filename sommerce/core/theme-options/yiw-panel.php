<?php                  

/**
 * SETTINGS
 */ 
require_once 'settings-panel.php';
// -------------
                          
// the general array with all theme options
$yiw_options = array();          

// general array with all options get from database
$yiw_theme_options = array();       

// general array with all tabs options pathname
$yiw_tabs_path = array();         

include_once 'functions-panel.php';            
 
 // get all options from database
$yiw_theme_options = yiw_theme_options_from_db();     

$yiw_includes_file = array(
    'install' => dirname(__FILE__) . '/install/install.php',
);

$yiw_includes_file = apply_filters( 'yiw_includes_admin_files', $yiw_includes_file );

//include_once 'homepage/homepage.php';
if ( file_exists( $yiw_includes_file['install'] ) ) 
	include_once $yiw_includes_file['install'];

// retrieve all pathaname for all tabs and put it on array
$yiw_tabs_path = yiw_get_tabs_path_files();

// includes options array of current tab    
if ( _is_yiw_panel() )          
    require_once $yiw_tabs_path[ yiw_get_current_tab() ];    

// the function name mastun't be changed!
function yiw_add_admin() 
{     
    global $yiw_theme_options_items, $yiw_includes_file;
    
    $page = 'yiw-panel.php';   
    
    add_theme_page( __( 'Theme Options', 'yiw' ), __( 'Theme Options', 'yiw' ), 'edit_theme_options', 'yiw_panel', 'yiw_panel' );
    
    if( file_exists( $yiw_includes_file['install'] ) )
        add_theme_page( 'Install theme data', 'Import/Export', 'edit_theme_options', 'install', 'install_panel' );
    
    unset( $yiw_includes_file );
}      

function yiw_init_panel()
{
    global $yiw_options, $yiw_theme_options;          
    
    do_action( 'yiw_before_render_panel' );  // here some scripts that remove settings in base some controls
    
    $ajax = FALSE;
    if ( isset( $_REQUEST['type-send'] ) AND $_REQUEST['type-send'] == 'ajax' )
    	$ajax = TRUE;
    
    $tab = yiw_get_current_tab();
    
    $solo = false; // retrive the var for saving only specific options
    if ( isset( $_REQUEST['save_only'] ) )
    	$solo = $_REQUEST['save_only'];
    
    if ( isset( $_GET['page'] ) AND ( $_GET['page'] == 'yiw_panel' ) ) 
    {
        $vars = $yiw_options[ $tab ];                                 
    
	    // use another function to save, if request
		if ( isset( $_REQUEST['yiw-callback-save'] ) )
			call_user_func( $_REQUEST['yiw-callback-save'] );
			
		if ( isset( $_REQUEST['secondary-action'] ) )
		{
			// create example contact form                        
			switch ( $_REQUEST['secondary-action'] ) :
			 
			    case 'create-contact-form' :
        			if( yiw_post_option( 'name-form' ) != '' )
        			{
        				$forms = maybe_unserialize( $yiw_theme_options['contact_forms'] );
        				$new_form = yiw_check_if_exists( sanitize_title( yiw_post_option( 'name-form' ) ), $forms );
        				
        				// add new form
        				$forms[] = $new_form;
        				$yiw_theme_options['contact_forms'] = serialize( $forms );
        				
        				// choose form to configure
        				$yiw_theme_options['contact_form_choosen'] = $new_form;
        				
        				// create fields
        				$yiw_theme_options['contact_fields_' . $new_form] = YIW_DEFAULT_CONTACT_FORM;
        				
        				yiw_update_theme_options();
                                                                    
                		$url = admin_url( 'themes.php' ) . "?page=$_GET[page]&tab=$tab&message=saved"; 
                        yiw_end_process( $url, $ajax );
        			}   
        			break;
        		
        		default :
        		    do_action( 'yiw_theme_options_secondary_action_' . $_REQUEST['secondary-action'] );
        		    break;
        		
    		endswitch;
		}            
			
		if( !isset( $_REQUEST['action'] ) )
			return;
	    
		if ( 'save' == $_REQUEST['action'] ) 
        {                                     
        	foreach($vars as $section => $options)
            {
                foreach($options as $value)
                {   
                	if ( ! isset( $value['id'] ) ) 
						continue;  
                	
					// go next if is been set a specific option to save  
                	if( $solo != false AND $value['id'] != $solo )
                		continue;
                	
					// check if there is a cols key, to specific more values for the same var
        			$n = 1;
        			if( isset( $value['cols'] ) )
        			{
                        $n = $value['cols'];
                    }
                    
                    for($i=1;$i<=$n;$i++)
                    {                                        
                        $ext = ($n > 1) ? "_$i" : '';
                        $val = $value['id'] . $ext;
                        
//                         echo '<pre>';
//                         print_r();
//                         echo '</pre>';
                        
                        if ( yiw_post_option( $val, 'undefined' ) != 'undefined' ) 
                        {          
                            if ( isset( $value['data'] ) AND $value['data'] == 'array' )
		                    {    	
		                    	if ( ! isset( $value['control'] ) OR ( isset( $value['control'] ) AND !array_key_exists( strtolower( str_replace( ' ', '_', yiw_post_option( $value['id'] ) ) ), $value['control'] ) ) )
		                    	{
			                    	$data_array = yiw_get_option( $value['id'] );
			                    	
			                    	if ( yiw_post_option( $val ) != '' ) :
			                    	
    									if ( $data_array AND $data_array != '' )
    										$value_array = maybe_unserialize( $data_array ); 
    									else
    										$value_array = array(); 
    									
    									if ( isset( $value['mode'] ) AND $value['mode'] == 'merge' )
    										$value_array[] = yiw_post_option( $value['id'] );
    									else
    										$value_array = yiw_post_option( $value['id'] );
    									
    									$yiw_theme_options[ $val ] = serialize( yiw_cleanArray( $value_array ) );
    								
    								endif;
								}
								else
								{
									$url = admin_url( 'themes.php' ) . "?page=$_GET[page]&message=element_exists";
                					yiw_end_process( $url, $ajax );
								}
							}
                            elseif( is_array( yiw_post_option( $val ) ) )
                            {
                				$cats = "-1";
                                
                				foreach( yiw_post_option( $val ) as $cat )
                                {
                					$cats .= "," . $cat;
                				}
                				
                				$yiw_theme_options[ $val ] = str_replace( '-1,', '', $cats ); 
                            }
							else
							{
								$yiw_theme_options[ $val ] = yiw_post_option( $value['id'] ); 
                            }
                        } 
                        elseif ( isset( $value['type'] ) AND ( $value['type'] == 'cat' OR $value['type'] == 'multiselect' ) ) {
                            $yiw_theme_options[ $val ] = serialize( array() );    
                        }
                        else
                        { 
                            if( isset( $value['type'] ) AND $value['type'] == 'on-off' AND ! yiw_post_option( $value['id'] ) ) 
                            	$yiw_theme_options[ $val ] = false;
                        } 
                    }
                }
            }
            
            yiw_update_theme_options();
                                                            
			$url = admin_url( 'themes.php' ) . "?page=$_GET[page]&tab=$tab&message=saved"; 
            yiw_end_process( $url, $ajax );
        } 
        else if( 'reset' == $_REQUEST['action'] ) 
        {                                      	
            foreach ( $yiw_options[ $tab ] as $options )
            	foreach ( $options as $option )    
            		if ( isset( $option['std'] ) ) 
            			$yiw_theme_options[ $option['id'] ] = $option['std'];
			                                                                
        	yiw_update_theme_options();  
                          
            $url = admin_url( 'themes.php' ) . "?page=$_GET[page]&tab=$tab&message=reset";
            yiw_end_process( $url, $ajax );
        }
        else if( 'update-array' == $_REQUEST['action'] ) 
        {   
			$value_array = unserialize( yiw_get_option( $_REQUEST['id'] ) );
			$value_array[ $_REQUEST['c'] ] = $_REQUEST[ YIW_OPTIONS_DB ][ $_REQUEST['id'] ];
			                                                    
			//print_r($value_array);
			$yiw_theme_options[ $_REQUEST['id'] ] = serialize( $value_array );
            
            yiw_update_theme_options();
			
			$url = admin_url( 'themes.php' ) . "?page=$_GET[page]&tab=$tab&message=updated";  
            yiw_end_process( $url, $ajax );
        }
		elseif( 'delete' == $_REQUEST['action'] )
		{                      
        	if ( isset( $_GET[ 'id' ] )  ) {
				yiw_delete_option( $_GET[ 'id' ] );
				$url = admin_url( 'themes.php' ) . "?page=$_GET[page]&tab=$tab&message=delete";   
                yiw_end_process( $url, $ajax );
			}         
			
            foreach($vars as $section => $options)
            {
                foreach ($options as $value) 
                {
					if ( ! isset( $value[ $_GET[ 'key' ] ] ) ) 
						continue;  
                	
					// check if passed delete mode on querystr, to delete specific vars
					if( isset( $_GET[ $value[ $_GET[ 'key' ] ] ] ) )
					{
						$value_array = unserialize( yiw_get_option( $value[ $_GET[ 'key' ] ] ) ); 
						unset( $value_array[ $_GET[ $value[ $_GET[ 'key' ] ] ] ] );
						                                                    
						//print_r($value_array);
						$yiw_theme_options[ $value[ $_GET[ 'key' ] ] ] = serialize( $value_array );   
            
            			yiw_update_theme_options();
						
						$url = admin_url( 'themes.php' ) . "?page=$_GET[page]&tab=$tab&message=delete";   
                		yiw_end_process( $url, $ajax );
					}
                }
            }
		} 
		elseif( 'array-ord' == $_REQUEST['action'] AND isset( $_REQUEST['id'] ) AND isset( $_REQUEST['dir'] ) AND isset( $_REQUEST['from'] ) )
		{         
			$a = maybe_unserialize( yiw_get_option( $_REQUEST['id'], array() ) );
			
			if( empty( $a ) )
				return;
			
            $el1 = $_REQUEST['from'];
            
            $offset = 1;
            if( $_REQUEST['dir'] == 'up' )
            	$offset *= -1;
            
			$el2 = $el1 + $offset;
			
			// change
			$temp = $a[ $el1 ];
			$a[ $el1 ] = $a[ $el2 ];
			$a[ $el2 ] = $temp;
			
			$yiw_theme_options[ $_REQUEST['id'] ] = serialize( $a );    
            
            yiw_update_theme_options();
						
			$url = admin_url( 'themes.php' ) . "?page=$_GET[page]&tab=$tab&message=ord"; 
            yiw_end_process( $url, $ajax );
		}                          
    }
    elseif ( isset( $_GET['page'] ) AND $_GET['page'] == 'install' )
    {                       
		if( !isset( $_REQUEST['action'] ) )
			return;
			
		if( 'export' == $_REQUEST['action'] )
		{
			$export = yiw_export_theme();
			$export_size = strlen( $export['content'] );
			
			header("Content-type: application/gzip-compressed");
			header("Content-Disposition: attachment; filename=$export[filename]");
			header("Content-Length: $export_size");                           
			header("Content-Transfer-Encoding: binary");
 			header('Accept-Ranges: bytes');         
			 
			/* The three lines below basically make the 
			    download non-cacheable */
			header("Cache-control: private");
			header('Pragma: private');
			header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
			
			echo $export['content'];
			die;
		}
	}
}               


function yiw_add_styles() 
{
	if ( ! ( isset( $_GET['page'] ) AND ( $_GET['page'] == 'yiw_panel' ) ) )
		return;
	
    $file_dir = yiw_panel_url() . '/include';
                                                                                                    
    wp_enqueue_style( 'functions', $file_dir . '/functions.css', false, '1.0', 'all' );         
    wp_enqueue_style( 'functions-custom', get_template_directory_uri() . '/inc/theme-options/style.css', false, '1.0', 'all' );
	wp_enqueue_style( 'iphone-style-checkboxes', $file_dir . '/iphone-style-checkboxes.css', false, '1.0', 'all' );
    wp_enqueue_style( 'jquery-ui-overcast', $file_dir . '/overcast/jquery-ui-1.8.9.custom.css', false, '1.8.8', 'all' );   
    wp_enqueue_style( 'wp-admin' );
    wp_enqueue_style( 'thickbox' );
    wp_enqueue_style( 'farbtastic' );                                           
    //wp_admin_css( 'widgets' );
}        

function yiw_add_scripts() 
{		
	if ( ! ( isset( $_GET['page'] ) AND ( $_GET['page'] == 'yiw_panel' ) ) )
		return;
	
    $file_dir = yiw_panel_url() . '/include';
                                                                                                    
    $deps = array(
		'jquery',     
		'jquery-ui-custom',   
		//'jquery-ui-sortable',  
		//'jquery-ui-draggable', 
		//'jquery-ui-droppable',  
		//'admin-widgets',
		'media-upload', 
		'thickbox', 
		'farbtastic' 
	);
	
	wp_deregister_script( 'jquery-ui-core' );
	wp_deregister_script( 'jquery-ui-sortable' );
	wp_deregister_script( 'jquery-ui-draggable' );
	wp_deregister_script( 'jquery-ui-droppable' );
                                                                                                                    
    wp_enqueue_script( 'thickbox' );                                                                                                                                        
    wp_enqueue_script( 'jquery-ui-custom', $file_dir . '/jquery-ui-1.8.9.custom.min.js', array(), '1.8.9', true );                              
    wp_enqueue_script( 'farbtastic');                                 
    wp_enqueue_script( 'rm_script', $file_dir . '/rm_script.js', $deps, '1.0', true );
    wp_enqueue_script( 'iphone-style-checkboxes', $file_dir . '/iphone-style-checkboxes.js', '1', true );  
}             
   
function yiw_panel()
{
    global $yiw_options;
    
    $tab = yiw_get_current_tab();   
    
    yiw_admin( $yiw_options[ $tab ] );
}          

function yiw_panel_configuration_save() {
	
	if ( isset( $_REQUEST['action'] ) ) { 
		
		$tab = yiw_get_current_tab();
		
		switch ( $_REQUEST['action'] ) {
		
			case 'yiw-save-configuration' :
				$configs = get_option( 'yiw_configs' );
				$actual_config = array();
				
				if ( $configs != false ) {
					$configs = maybe_unserialize( $configs );
				} else {
					$configs = array();
				}                      
				
				$config_name = esc_attr( $_REQUEST['new_configuration'] ); 
				$config_slug = yiw_check_if_exists( sanitize_title( $config_name ), $configs, 'key' );  
				
				$actual_config[$config_slug] = array(
					'name' => $config_name,
					'values' => yiw_theme_options_from_db()
				);                    
				
// 				echo $config_slug;
// 				yiw_debug( $configs ); die;
				
				update_option( 'yiw_configs', array_merge( $configs, $actual_config ) );
				
				$url = admin_url( 'themes.php' ) . "?page=$_GET[page]&tab=$tab&message=saved";   
            	yiw_end_process( $url, false );
				
				break;
		
			case 'yiw-apply-configuration' :
				$configs = get_option( 'yiw_configs' );
				
				if ( ! $configs )
					break;
				
				$config_to_apply = esc_attr( $_REQUEST['name_configuration'] );
				
				yiw_update_theme_options( $configs[ $config_to_apply ]['values'] );       
				
				$url = admin_url( 'themes.php' ) . "?page=$_GET[page]&tab=$tab&message=saved";   
            	yiw_end_process( $url, false );
				
				break;
		
			case 'yiw-delete-config' :
				$configs = get_option( 'yiw_configs' );
				
				if ( $configs != false ) {
					$configs = maybe_unserialize( $configs );
				} else {
					$configs = array();
				}         
				
				$to_delete = esc_attr( $_REQUEST['id'] );
				if ( isset( $configs[ $to_delete ] ) ) {
					unset( $configs[ $to_delete ] );
				}
				
				update_option( 'yiw_configs', $configs );     
				
				$url = admin_url( 'themes.php' ) . "?page=$_GET[page]&tab=$tab&message=delete";   
            	yiw_end_process( $url, false );
				
				break;
		
			case 'yiw-import-configuration' :
				if ( ! isset( $_REQUEST['import-theme-options'] ) )
				    break;
				    
                $options = unserialize( base64_decode( $_REQUEST['import-theme-options'] ) ); 
                yiw_update_theme_options( $options );   
				
				$url = admin_url( 'themes.php' ) . "?page=$_GET[page]&tab=$tab&message=delete";   
            	yiw_end_process( $url, false );
				
				break;
		
		}
		
	}
	
}

// the html generating of panel
include_once 'panel.php';

?>