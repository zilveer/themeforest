<?php
/**
 * This file is part of the BTP_Framework package.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 * 
 * Table of contents: 
 *
 * 1. Tools
 * 2. class BTP_Theme_Option_Holder
 * 3. Public API for global Theme Option Holder
 */



/* Prevent direct script access */
if ( !defined( 'BTP_FRAMEWORK_VERSION' ) ) exit( 'No direct script access allowed' );



/* ------------------------------------------------------------------------- */
/* ---------->>> TOOLS <<<-------------------------------------------------- */
/* ------------------------------------------------------------------------- */



function btp_theme_save_current_template( $t ){
	global $_BTP;
    $_BTP[ 'current_theme_template' ] = basename($t);
    return $t;
}
add_filter( 'template_include', 'btp_theme_save_current_template', 1000 );



/**
 * Generic function for capturing custom styles
 * 
 * @return			string 
 * @since			1.1.0
 */
function btp_theme_capture_custom_styles(){
	$css = '';
	$css = apply_filters( 'btp_theme_custom_styles', $css );
	$css = trim($css);
	
	return $css;
}
function btp_theme_render_custom_styles(){	
	$css = btp_theme_capture_custom_styles();
	
	if ( !empty( $css ) ) {
		$css = 	"\n" .		
				'<style type="text/css">'. "\n" .
				'/* AUTO-GENERATED BASED ON THEME OPTIONS -------------------------------------------------- */' . "\n" .
				//str_replace(array("\n", "\r"), '', $css) .
				$css .
				'</style>' . "\n" ;	
	}
	
	echo $css;
}
add_action( 'wp_head', 'btp_theme_render_custom_styles' );	



/* ------------------------------------------------------------------------- */
/* ---------->>> THEME OPTION HOLDER <<<------------------------------------ */
/* ------------------------------------------------------------------------- */



/**
* Theme Option holder
* 
* Organizes theme options using a two-levels hierarchy ( subgroups inside groups ).
* Each group represents individual tab, each subgroup individual subtab.
* 
* @package 				BTP_Framework
* @subpackage			BTP_Options
*/
class BTP_Theme_Option_Holder extends BTP_Option_Holder {
	
	/**
	 * Constructor
	 */
	public function __construct( $base_item = array() ) {
		parent::__construct();
		
		$this->set_base_item( array_merge( array(
			'apply'				=> array(),
			'apply_callback'	=> null,
			'view'				=> 'String',
			'model'				=> 'Array',
			'prefix'			=> 'btp_theme',
			),
			$base_item	
		));
	}
	
	
	
	/**
	 * Gets the scope of this holder
	 * 
	 * @return			string
	 */
	public function get_scope() { return 'theme'; }
	
	
	
	
	
	/**
	 * Initializes options, adds hooks
	 */
	public function init(){
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_resources' ) );	
		add_action( 'admin_menu', array( $this, 'add_update_options_page' ) );
		add_action( 'admin_menu', array( $this, 'add_import_options_page' ) );
		add_action( 'admin_menu', array( $this, 'add_export_options_page' ) );
		add_action( 'init', array( $this, 'insert_options' ) );		
		add_action( 'init', array( $this, 'register_wpml_strings' ) );
	}
	
	
	
	/**
	 * Adds "Import Theme Options" page
	 */
	public function add_import_options_page() {		
		add_theme_page( 
	    	__( 'Import Theme Options', 'btp_theme' ),		// page_title 
	        __( 'Import Theme Options', 'btp_theme' ),		// menu_title
	        'edit_theme_options', 							// capability
	        'import-theme-options',	 						// menu_slug
	        array( $this, 'render_import_options_page' )	// function
    	);
    	
    	$this->import_options();
	}	
	
	
	
	/**
	 * Adds "Export Theme Options" page
	 */
	public function add_export_options_page() {		
		add_theme_page( 
	    	__( 'Export Theme Options', 'btp_theme' ),		// page_title 
	        __( 'Export Theme Options', 'btp_theme' ),		// menu_title
	        'edit_theme_options', 							// capability
	        'export-theme-options',	 						// menu_slug
	        array( $this, 'render_export_options_page' )	// function
    	);
    	
    	$this->export_options();
	}
	
	
	
	/**
	 * Exports options to an XML file 
	 */
	public function export_options(){
		$page = 'export-theme-options';
		
		if ( !isset( $_GET['page' ] ) || $page !== $_GET['page'] ) {
			return;
		}	
			
	    if ( 'POST' !== $_SERVER[ 'REQUEST_METHOD' ] ) {
	    	return;	
	    }
	    
     	/* Check credentials */
		if ( !current_user_can( 'edit_theme_options' ) ) {
			wp_die( __('You do not have sufficient permissions to access this page.', 'btp_theme') );
		}
		
		/* Verify nonce */
	    if ( !check_admin_referer( 'btp_export_theme_options' , 'btp_export_theme_options_nonce' ) ) {
	    	wp_die( __( 'Nonce incorrect!', 'btp_theme' ) ); 
	    }
		
        /* Create document */
		$dom = new DomDocument("1.0");
	  	$dom->formatOutput = true;
		header( "Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0" );
		header( "Pragma: no-cache " );
		header( "Content-Type: text/plain" );
		header( 'Content-Disposition: attachment; filename="theme-options-'.date("Y-m-d").'.xml"' );
		  				  
		/* Create root */
		$root = $dom->createElement( 'btp_theme_options' );
		$root = $dom->appendChild($root);				  

		
		$models = array();
		
		foreach( $this->hierarchy as $group_id => &$group ) {
			foreach( $group['subgroups'] as $subgroup_id => &$subgroup ) {		
				foreach( $subgroup[ 'items' ] as $item_id => $item ) {							
					$option = $this->get_item( $item_id );			
					
					if ( strlen( $option['model'] ) ) {							
						$model_class = 'BTP_Option_Model_' . $option[ 'model' ];													
						/* Create each option model once */ 
						if( !isset( $models[ $model_class ] ) ) {
							$models[ $model_class ] = new $model_class( $this->get_scope(), null );
						}									
						
						$value = $models[ $model_class ]->select( $option );
		        	}	
					
				}	
			}
			unset( $subgroup );		
		}
		unset( $group );
		
		foreach ( $models as $model ) {
			$array = $model->after_selects();					
			if ( count( $array ) ) {
				foreach ( $array as $k => $v ) {
					/* Create root */
					$child = $dom->createElement( 'row' );
					$child = $root->appendChild( $child );
					/* Option ID */ 
					$item = $dom->createElement( 'option_name' );
					$item = $child->appendChild( $item );
					$text = $dom->createTextNode( $k );
					$text = $item->appendChild( $text );				      
					/* Option value */
					$item = $dom->createElement( 'option_value' );
					$item = $child->appendChild( $item );
					$text = $dom->createCDATASection( serialize( $v ) );
					$text = $item->appendChild( $text );
				}	
			}
		}				
						
		/* Save */
		echo $dom->saveXML();
		die();		
	}
	
	
	
	/**
	 * Imports options from an XML file	 
	 */
	public function import_options() {
		$page = 'import-theme-options';
		
		if ( !isset( $_GET[ 'page' ] ) || $page !== $_GET[ 'page'] ) {
			return;
		}
		
		if ( 'POST' !== $_SERVER[ 'REQUEST_METHOD' ] ) {
			return;
		}
		
		/* Check credentials */
		if ( !current_user_can( 'edit_theme_options' ) ) {
			wp_die( __('You do not have sufficient permissions to access this page.', 'btp_theme') );
		}
		
		/* Verify nonce */
	    if ( !check_admin_referer( 'btp_import_theme_options' , 'btp_import_theme_options_nonce' ) ) {
	    	wp_die( __( 'Nonce incorrect!', 'btp_theme' ) ); 
	    }
	    	 
		/* Handle upload  */	   
	    if ( $_FILES[ 'import' ][ 'name' ] == null ) {
	    	header( 'Location: admin.php?page=' . $page . '&error=missing-file' );
	        die();
	    } else if ( $_FILES[ 'import' ][ 'error' ] > 0 ) {
	        header( 'Location: admin.php?page=' . $page . '&error=true' );
	        die();
	    } else if ( preg_match( "/(.xml)$/i", $_FILES[ 'import' ][ 'name' ] ) ) {
            $mimes = apply_filters( 'upload_mimes', array( 'xml' => 'text/xml' ) );	         
	        $overrides = array( 'test_form' => false, 'mimes' => $mimes );
	        
	        $import = wp_handle_upload( $_FILES[ 'import' ], $overrides );
	 
	        if ( !empty( $import[ 'error' ] ) ) { 
	           	header( 'Location: admin.php?page=' . $page . '&error=true' );
	           	die();
	        }
	         
	        $file = file_get_contents( $import[ 'file' ] );
	        $options = new SimpleXMLElement( $file );
	          
        	/* Import options */
	        foreach ( $options->row as $row ) {
	        	$option = get_option( $row->option_name );
	        	if ( empty( $option ) ) {
					$option = array();
	        	}	
	        	
	        	$option = array_multimerge( $option, mb_unserialize( $row->option_value ) );
	        	 
	        	update_option( $row->option_name, $option );
	        }

	        /* Delete the file. We don't need it anymore */
	        @unlink( $import[ 'file' ] );
	        
	        /* Redirect */
	        header( 'Location: admin.php?page=' . $page . '&import-xml=true' );
	        die();
		}
	}
	
	
	
	/**
	 * Captures the HTML code of the "Import Theme Options" page
	 * 
	 * @return			string
	 */
	public function capture_import_options_page() {
		$out = '';
		$out .= '<div class="wrap">';
			$out .= '<div id="import-theme-options">';
			
				if ( isset( $_REQUEST[ 'import-xml'] ) ) {
					$out .= '<div id="message" class="updated">';
						$out .= '<p>';
							$out .= '<strong>';
								$out .= esc_html( __( 'Theme Options have been successfully imported', 'btp_theme' ) );
							$out .= '</strong>';
						$out .= '</p>';
					$out .= '</div>';
				}
				
				if ( isset( $_REQUEST[ 'error'] ) ) {
					$out .= '<div class="error">';
						$out .= '<p>';
							$out .= '<strong>';
								switch ( $_REQUEST[ 'error' ] ) {
									case 'missing-file':
										$out .= esc_html( __( 'Please provide an XML file', 'btp_theme' ) );
										break;
									default:
										$out .= esc_html( __( 'There was an error during the import', 'btp_theme' ) );
										break;
								}
							$out .= '</strong>';
						$out .= '</p>';
					$out .= '</div>';
				}
			
			
				$out .= '<h2>' . __( 'Import Theme Options XML', 'btp_theme' ) . '</h2>';				
			
		          	$out .= '<form method="post" action="admin.php?page=import-theme-options" enctype="multipart/form-data">';
		          		$out .= wp_nonce_field( 'btp_import_theme_options', 'btp_import_theme_options_nonce', false );
		          		
		              	$out .= '<div class="section desc-text">';
		                	$out .= '<p>';		                		 
		                		$out .= __( 'Here you can import theme options from an XML file', 'btp_theme' );		                		
		        			$out .= '</p>';        		
		        
		                	$out .= '<input name="import" type="file" class="file" size="40" /><br />';
		                	$out .= '<input type="submit" value="' . __( 'Import XML', 'btp_theme' ) . '" class="button-primary" />';
		                	
		              	$out .= '</div>';
		              	            
		          	$out .= '</form>';				
		
			$out .= '</div>';
		$out .= '</div>';
		
		return $out;
	}
	public function render_import_options_page() {
		echo $this->capture_import_options_page();
	}
	
	
	
	/**
	 * Captures the HTML code of the "Export Theme Options" page
	 * 
	 * @return			string
	 */
	public function capture_export_options_page() {
		$out = '';
		$out .= '<div class="wrap">';
			$out .= '<div id="export-theme-options">';
				$out .= '<h2>' . __( 'Export Theme Options', 'btp_theme' ) . '</h2>';

				$out .= '<form method="post" action="admin.php?page=export-theme-options">';
					$out .= wp_nonce_field( 'btp_export_theme_options', 'btp_export_theme_options_nonce', false );
					$out .= '<div class="section desc-text">';
                		$out.= '<p>';
                			$out .= __( 'Click the Export XML button to export your Theme Options.', 'btp_theme');
                		$out .= '</p>';	
                		
                		$out .= '<input type="submit" value="' . __( 'Export XML', 'btp_theme' ) . '" class="button-primary" />';
              		$out .= '</div>';
					
				$out .= '</form>';
			$out .= '</div>';
		$out .= '';
		
		return $out;
	}
	public function render_export_options_page() {
		echo $this->capture_export_options_page();
	}	
		
	
	
	/**
	 * Adds "Theme Options" page
	 */
	public function add_update_options_page() {
		$this->sort();
		
		add_theme_page( 
	    	__( 'Theme Options', 'btp_theme' ),		// page_title 
	        __( 'Theme Options', 'btp_theme' ),		// menu_title
	        'edit_theme_options', 					// capability
	        'update-theme-options',	 				// menu_slug
	        array( $this, 'render_update_options' )	// function
    	);		
    	
    	global $_BTP;
		$_BTP[ 'theme_option_holder' ]->update_options();
	}
	
	
	
	/**
	 * Register strings for WPML Plugin
	 */
	public function register_wpml_strings() {
		if ( !is_admin() || !function_exists( 'icl_register_string' ) ) {
			return;	
		}		
    
		foreach( $this->hierarchy as $group_id => &$group ) {
			foreach( $group['subgroups'] as $subgroup_id => &$subgroup ) {		
				foreach( $subgroup[ 'items' ] as $item_id => $item ) {
					$option = $this->get_item( $item_id );

					/* Is translatable? */
					if ( !empty( $option['i18n'] ) ) {
						/* Register string for translation */
						icl_register_string( 
							'btp_theme_options', 
							$item_id, 
							btp_theme_get_option_value( $item_id )
						);
					}	
					
					/* Process children */
					if ( $option->has_children() ) {
						foreach( $option['children'] as $child_id => $child ) {
							/* Is translatable */
							if ( !empty( $child['i18n'] ) ) {
								$item_value = btp_theme_get_option_value( $item_id );
								$child_value = isset( $item_value[ $child_id ] ) ? $item_value[ $child_id ] : '';
								
								/* Register string for translation */
								icl_register_string( 
									'btp_theme_options', 
									$item_id . '[' . $child_id . ']', 
									$child_value
								);	
							}
						}
					}
				}	
			}
			/* Break the reference with the last element. */
			/* See http://php.net/manual/en/control-structures.foreach.php */
			unset( $subgroup );		
		}
		/* Break the reference with the last element. */
		/* See http://php.net/manual/en/control-structures.foreach.php */
		unset( $group );	
	}
	
	
 
	/**
	 * Inserts default options
	 */
	public function insert_options() {
		global $pagenow;		
		if ( !is_admin() || 'themes.php' != $pagenow || !isset( $_GET[ 'activated' ] ) ) {
			return;	
		}	

		/* An array of used option models */
		$models = array();
    
		foreach( $this->hierarchy as $group_id => &$group ) {
			foreach( $group['subgroups'] as $subgroup_id => &$subgroup ) {		
				foreach( $subgroup[ 'items' ] as $item_id => $item ) {
					$option = $this->get_item( $item_id );			
					
					/* Start Model Layer */
					if ( strlen ( $option[ 'model' ] ) ) {					
						$model_class = 'BTP_Option_Model_'.$option[ 'model' ];
						
						/* Create each option model once */ 
						if ( !isset( $models[ $model_class ] ) ) {
							$models[ $model_class ] = new $model_class( $this->get_scope(), null );
						}	
	
						/* Start the insert process */
						$models[ $model_class ]->insert( $option );
					}	
				}	
			}
			/* Break the reference with the last element. */
			/* See http://php.net/manual/en/control-structures.foreach.php */
			unset( $subgroup );		
		}
		/* Break the reference with the last element. */
		/* See http://php.net/manual/en/control-structures.foreach.php */
		unset( $group );	
	
		/* End the insert process */
		foreach ( $models as $model ) {
			$model->after_inserts();
		}	
	}

	
	
	/**
	 * Enqueues javascripts and stylesheets
	 */
	public function enqueue_resources() {
		wp_enqueue_style( 
			'btp_admin', 
			get_template_directory_uri() . '/framework/css/btp_admin.css', 
			false,			 
			'1.0'
		);
	
		wp_enqueue_style( 
			'rangeinput', 
			get_template_directory_uri() . '/framework/js/jquery.tools.rangeinput/jquery.tools.rangeinput.css'
		);
	
	
		
		wp_enqueue_style( 'farbtastic' );	
		
		wp_enqueue_style( 'thickbox' );
		
	
	
		/* Include custom JS for proper behaviour of admin options */
		wp_enqueue_script( 
	        'rangeinput', 
	        get_template_directory_uri() . '/framework/js/jquery.tools.rangeinput/jquery.tools.rangeinput.min.js', 
	        array( 'jquery' ) 
	    );  
		
		wp_enqueue_script('thickbox');	 
	        
	    wp_enqueue_script( 'farbtastic' );
	                
	    wp_enqueue_script( 
	    	'metadata', 
	       	get_template_directory_uri().'/js/jquery-metadata/jquery.metadata.js', 
	        array('jquery')
	    );
    
    
	    wp_enqueue_script('jquery-ui-sortable');
	    //wp_enqueue_script( array("jquery", "jquery-ui-core", "interface", "jquery-ui-sortable", "wp-lists", "jquery-ui-sortable") );
	    	    
	    /* Include custom JS for proper behaviour of admin options */
		wp_enqueue_script( 
	        'main', 
	        get_template_directory_uri() . '/framework/js/main.js', 
	        array( 'jquery' ) 
	    );		
	}
	
	
	
	/**
	 * Captures the HTML code of the "Theme Options" page
	 * 
	 * @return			string
	 */
	public function capture_update_options() {
		$out = '';
		
		if ( isset( $_REQUEST[ 'saved' ] ) ) {
			$out .= '<div id="message" class="updated fade">';
				$out .= '<p>';
					$out .= '<strong>';
						$out .= esc_html( __( 'Theme Options saved', 'btp_theme' ) );
					$out .= '</strong>';
				$out .= '</p>';
			$out .= '</div>';
		}

		$out .= '<div class="wrap">';
			$out .= '<h2>' . __( 'Theme Options', 'btp_theme' ) . '</h2>';
			
			$out .= '<form method="post" onsubmit="btpFixAction(this)">';
				$out .= '<div class="btp-theme-options">';
				
				$this->sort();

				foreach ( $this->hierarchy as $group_id => &$group ) {
					$out .= '<div id="option-group-' . $group_id . '" class="btp-option-group">';
						$out .= '<div class="btp-option-group-title">';
							$out .= '<h2>' . $group[ 'args'][ 'label' ] . '</h2>';
						$out .= '</div>';	
			
						$out .= '<div class="btp-option-group-content">';
							$out .= wp_nonce_field( 'btp_' . $group_id, 'btp_' . $group_id . '_nonce', false );
							foreach( $this->hierarchy[ $group_id ][ 'subgroups' ] as $subgroup_id => &$subgroup ) {								
								$out .= '<div id="option-subgroup-' . $group_id . '-' . $subgroup_id . '" class="btp-option-subgroup">';
								
									$out .= '<div class="btp-option-subgroup-title">';
										$out .= '<h3>' . $subgroup[ 'args'][ 'label' ] . '</h3>';
							        $out .= '</div>';								
								
									$out .= '<div class="btp-option-subgroup-content">';
									
									foreach( $subgroup['items'] as $item_id => $item ) {					
										$option = $this->get_item( $item_id );
																			
										/* Ommit the process if the view isn't defined */
										if ( !strlen( $option[ 'view' ] ) ) {					
											continue;
										}							
										
							        	$value = null;
		
							        	if ( strlen( $option['model'] ) ) {
											$model_class = 'BTP_Option_Model_' . $option[ 'model' ];													
											/* Create each option model once */ 
											if( !isset( $models[ $model_class ] ) ) {
												$models[ $model_class ] = new $model_class( $this->get_scope(), null );
											}									
											
											$value = $models[ $model_class ]->select( $option );
							        	}	
										
							        	
										 /* Render value by using the View Layer */
		        						$view_class = 'BTP_Option_View_' . $option[ 'view' ];
								    	$view = new $view_class(
								    		$option->id,
								        	$option->config,							
								           	$value 		
								        );
								            
								        $out .= $view->capture();				  
									}  
									
									$out .= '</div>';
								$out .= '</div><!-- .btp-option-subgroup -->';								
							}
							/* Break the reference with the last element. */
							/* See http://php.net/manual/en/control-structures.foreach.php */
							unset( $subgroup );
							
						$out .= '</div>';
					$out .= '</div><!-- .btp-option-group -->';					
				}	
				/* Break the reference with the last element. */
				/* See http://php.net/manual/en/control-structures.foreach.php */		
				unset( $group);
					
				$out .= '</div>';
				
				$out .= '<div class="btp-form-actions">';
			    	$out .= '<input type="submit" class="button-primary" name="submit" value="' . __( 'Save', 'btp_theme' ) . '" />';
			    $out .= '</div>';
			$out .= '</form>';
		$out .= '</div>';
		
		return $out;
	}	
	public function render_update_options(){
		echo $this->capture_update_options();
	}
	
	
	
	/**
	 * Updates options
	 */
	public function update_options() {
		$page = 'update-theme-options';
		
	    if ( !isset( $_GET[ 'page' ] ) || $page !== $_GET[ 'page' ] ) {
	    	return; 
	    }	

	    if ( 'POST' !== $_SERVER[ 'REQUEST_METHOD' ] ) {
	    	return;
	    }	
	        	
        /* Check credentials */
		if ( !current_user_can( 'edit_theme_options' ) ) {
			wp_die( __('You do not have sufficient permissions to access this page.', 'btp_theme') );
		}
        
		/* Sort hierarchy array */
		$this->sort();
		
		$models = array();
        
        foreach( $this->hierarchy as $group_id => &$group ) {
			/* Verify nonce */
		    if ( !check_admin_referer( 'btp_' . $group_id, 'btp_' . $group_id . '_nonce' ) ) {
		    	wp_die( __( 'Nonce incorrect!', 'btp_theme' ) ); 
		    }
			
			foreach( $group['subgroups'] as $subgroup_id => &$subgroup ) {		
				foreach( $subgroup[ 'items' ] as $item_id => $item ) {											
					$option = $this->get_item( $item_id );
					
					/* Ommit the process if the model isn't defined */
					if ( !strlen( $option[ 'model' ] ) ) {					
						continue;
					}					
					
					$model_class = 'BTP_Option_Model_' . $option[ 'model' ];													
					/* Create each option model once */ 
					if( !isset( $models[ $model_class ] ) ) {
						$models[ $model_class ] = new $model_class( $this->get_scope(), null );
					}	
										
					/* Start update process */
					$models[ $model_class ]->update( $option );
				}		
			}
			/* Break the reference with the last element. */
			/* See http://php.net/manual/en/control-structures.foreach.php */
			unset( $subgroup );				
		}	
		/* Break the reference with the last element. */
		/* See http://php.net/manual/en/control-structures.foreach.php */
		unset( $group );
		
         /* End update process */
    	foreach( $models as $model ) { 
    		$model->after_updates();
    	}
                
        header( 'Location: admin.php?page=' . $page . '&saved=true' );
        die;
    }	
}



/* ------------------------------------------------------------------------- */
/* ---------->>> API FOR THE GLOBAL THEME OPTION HOLDER <<<----------------- */
/* ------------------------------------------------------------------------- */



/* Add the global entry option holder */
global $_BTP;
$_BTP[ 'theme_option_holder' ] 	= new BTP_Theme_Option_Holder();



/**
 * Inits global theme option holder
 */
function btp_theme_init_global_option_holder() {
	global $_BTP;
	
	$_BTP[ 'theme_option_holder' ]->init();
}
add_action( 'after_setup_theme', 'btp_theme_init_global_option_holder' );



/**
 * Adds theme option group
 *
 * @param 			string $group_id 
 * @param 			array $group_args
 * @param			int $group_position   
 */
function btp_theme_add_option_group( $group_id, $group_args, $group_position ) {
	global $_BTP;	
	$_BTP[ 'theme_option_holder' ]->add_group( $group_id, $group_args, $group_position );
}



/**
 * Removes theme option group
 *
 * @param 			string $group_id
 */
function btp_theme_remove_option_group( $group_id ) {
	global $_BTP;	
	$_BTP[ 'theme_option_holder' ]->remove_group( $group_id );
}


	
/**
 * Adds theme option subgroup
 * 
 * @param			string $subgroup_id
 * @param			array $subgroup_args
 * @param			string $group_id
 * @param			int $subgroup_position
 */
function btp_theme_add_option_subgroup( $subgroup_id, $subgroup_args, $group_id, $subgroup_position ) {
	global $_BTP;
	$_BTP[ 'theme_option_holder' ]->add_subgroup( $subgroup_id, $subgroup_args, $group_id, $subgroup_position );
}



/**
 * Removes theme option subgroup
 *
 * @param 			string $subgroup_id
 * @param 			string $group_id
 */
function btp_theme_remove_option_subgroup( $subgroup_id, $group_id ) {
	global $_BTP;	
	$_BTP[ 'theme_option_holder' ]->remove_subgroup( $subgroup_id, $group_id );
}



/**
 * Adds theme option
 *
 * @param			string $option_id
 * @param			array $option_args 
 */
function btp_theme_add_option( $option_id, $option_args ) {
	global $_BTP;	
	$_BTP[ 'theme_option_holder' ]->add_item( 
		$option_id, 
		$option_args, 
		$option_args[ 'group' ], 
		$option_args[ 'subgroup' ], 
		$option_args[ 'position' ] 
	);
}



/**
 * Removes theme option
 *
 * @param 			string $option_id
 */
function btp_theme_remove_option( $option_id ) {
	global $_BTP;	
	$_BTP[ 'theme_option_holder' ]->remove_item( $option_id );
}



/**
 * Gets theme option
 * 
 * @param 			string $option_id
 * @param 			mixed $default
 */
function btp_theme_get_option_value( $option_id, $default = false ) {
	global $_BTP;
	return $_BTP['theme_option_holder' ]->get_option_value( null, $option_id );
}

/**
 * Customize supported upload mime types
 */
add_filter('upload_mimes', 'btp_theme_upload_mimes');

function btp_theme_upload_mimes($existing_mimes = array()) {
    $existing_mimes['xml'] = 'text/xml';

    return $existing_mimes;
}
?>