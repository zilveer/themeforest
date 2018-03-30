<?php
/**
 * This file is part of the BTP_Framework package.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 * 
 * Table of contents: 
 *
 * 1. class BTP_Term_Option_Holder
 * 2. Public API for global Term Option Holder
 */



/* Prevent direct script access */
if ( !defined( 'BTP_FRAMEWORK_VERSION' ) ) exit( 'No direct script access allowed' );



/* ------------------------------------------------------------------------- */
/* ---------->>> TERM OPTION HOLDER <<<------------------------------------- */
/* ------------------------------------------------------------------------- */



/**
* Term Option Holder
*
* @author 				bringthepixel <bringthepixel@gmail.com>  
* @package 				BTP_Framework
* @subpackage			BTP_Option
* @since 				1.0.0
* @version 				1.0.0
*/
class BTP_Term_Option_Holder extends BTP_Option_Holder {
	
	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
		
		/* Set default configuration of an option */
		$this->set_base_item( array(
			'apply'				=> array(),
			'apply_callback'	=> null,
			'view'			=> 'String',
			'model'			=> 'Array',
			'prefix'		=> '_btp',
		));
	}
	
	
	
	/**
	 * Gets the scope of this option holder
	 */
	public function get_scope() { return 'term'; }


	
	/**
	 * Inits the holder, adds hooks
	 */
	public function init(){
		$this->sort();
		
		foreach( $this->hierarchy as $group_id => $group ) {
			$apply = $this->get_apply_set( $group_id );
			
			foreach( $apply as $taxonomy => $bool ) {
				/* Watch for dynamic function names - these will be resolved with the magical function __call() */
				add_action( $taxonomy . '_edit_form_fields', array( $this, 'render_group_wrapper_' . $group_id ) );
				add_action( 'edited_term_taxonomy', array( $this, 'update_group_wrapper_' . $group_id ) );
			}
 		}
	}	

	
	
	/**
	 * Captures group wrapper
	 *
	 * @param 			string $group_id
	 * @param 			object $term
	 * @return			string
	 */
	function capture_group_wrapper( $group_id, $term ) {
		$out = '';
		
		/* sort items before capturing */
		$this->sort();
		$group =& $this->hierarchy[ $group_id ];
				
		$out .= '<tr class="form-field">';
			$out .= '<td colspan="2">';
				$out .= '<div class="btp-option-group">';
					$out .= '<div class="btp-option-group-content">';
						/* Secure the form with the nonce field */
						$out .= wp_nonce_field( 'btp_' . $group_id, 'btp_' . $group_id . '_nonce', false );
		           	
						$models = array();
						
		           		foreach( $group[ 'subgroups' ] as $subgroup_id => &$subgroup ) {
		 					$out .= '<div class="btp-option-subgroup">';
		 					
				           		if ( count( $group[ 'subgroups' ] ) > 1 ) {
									$out .= '<div class="btp-option-subgroup-title">';		            
				            			$out .= '<h3>' . $subgroup[ 'args'][ 'label' ] . '</h3>';
				        			$out .= '</div>';
				           		}
			           		
				           		$out .= '<div class="btp-option-subgroup-content">';
					
									foreach( $subgroup['items'] as $item_id => $item ) {
										$option = $this->get_item( $item_id );
										
										/* Ommit the process if the model isn't defined */
										if ( !strlen( $option[ 'view' ] ) ) {					
											continue;
										}	
										
										/* Ommit the process if the option isn't applicable */
										if ( !array_key_exists( $term->taxonomy, array_filter( $option[ 'apply' ] ) ) ) {
											continue;
										}
										
										$value = null;

							        	if ( strlen( $option['model'] ) ) {
											$model_class = 'BTP_Option_Model_' . $option[ 'model' ];													
											/* Create each option model once */ 
											if( !isset( $models[ $model_class ] ) ) {
												$models[ $model_class ] = new $model_class( $this->get_scope(), $term->term_taxonomy_id );
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
		    $out .= '</td>';	    
		$out .= '</tr>';
		
		unset( $group );
		
		return $out;
	}	
	function render_group_wrapper( $group_id, $term ) {
		echo $this->capture_group_wrapper( $group_id, $term );
	}
	
	
	
	/**
	 * Updates group (wrapper function)
	 * 
	 * @param 			integer $group_id
	 * @param 			integer $object_id
	 */
	function update_group_wrapper( $group_id, $object_id ) {
		/* Save only when edittag form has been submitted */	
	    if ( !isset( $_POST['action'] ) || $_POST['action'] != 'editedtag' ) {
	    	return;
	    }	    	
	    	
	    /* Don't save data when using Quick Edit */	
	    if ( isset( $_POST['_inline_edit'] ) ) {		    
	    	return $post_id;		
	    }	
		
		$taxonomy = null;
		if ( isset( $_POST[ 'taxonomy' ] ) ) {
			$taxonomy = $_POST[ 'taxonomy' ];
		}	
			
		/* Ommit the group if it isn't applicable */	
		if ( !array_key_exists( $taxonomy, $this->get_apply_set( $group_id ) ) ) {
			return;				
		}		
	    	
		/* Check permissions */
	    $btp_taxonomy = get_taxonomy( $_POST[ 'taxonomy' ] );
		if ( !current_user_can( $btp_taxonomy->cap->edit_terms ) ) {
			wp_die( __('You do not have sufficient permissions to access this page.', 'btp_theme') );
		}

		/* Verify nonce */
	    if ( !check_admin_referer( 'btp_' . $group_id, 'btp_' . $group_id . '_nonce' ) ) {
	    	wp_die( __( 'Nonce incorrect!', 'btp_theme' ) ); 
	    }    
		
	    	
	    $group =& $this->hierarchy[ $group_id ];
	    
	    $models = array();
	    
		foreach( $group['subgroups'] as $subgroup_id => &$subgroup ) {		
			foreach( $subgroup[ 'items' ] as $item_id => $item ) {				
				$option = $this->get_item( $item_id );	
				
				/* Ommit the process if the model isn't defined */
				if ( !strlen( $option[ 'model' ] ) ) {					
					continue;
				}	
				
				/* Ommit the process if the option isn't appliable */
				if ( !array_key_exists( $taxonomy, array_filter( $option[ 'apply' ] ) ) ) {
					continue;
				}
				
				$model_class = 'BTP_Option_Model_' . $option[ 'model' ];													
				/* Create each option model once */ 
				if( !isset( $models[ $model_class ] ) ) {
					$models[ $model_class ] = new $model_class( $this->get_scope(), $object_id );
				}	
		
				/* Start update process */
				$models[ $model_class ]->update( $option );
				
			}	
		}		
		/* Break the reference with the last element. */
		/* See http://php.net/manual/en/control-structures.foreach.php */
		unset( $subgroup );
		
		/* Finish update process */
		foreach ( $models as $model ) {
			$model->after_updates(); 
		}
	        
	    unset( $group );
	}
	
	

	/**
	 * Invokes inaccessible methods
	 * 
	 * WordPress function add_action doesn't handle callback with custom argument, 
	 * like for example group_id. So this tricky function will help us.    
	 * 
	 * @param 			string $name Function name
	 * @param 			array $args Function arguments
	 */
	public function __call($name, $args ) {
		/* Check for render_group_wrapper */
		if ( strpos( $name, 'render_group_wrapper_') === 0 ) {			
			$group_id = substr( $name, 21 );
						
			return $this->render_group_wrapper( $group_id, $args[0] );
		/* Check for update_group_wrapper */	
		} elseif ( strpos( $name, 'update_group_wrapper_') === 0 ) {
			$group_id = substr( $name, 21 );
			
			return $this->update_group_wrapper( $group_id, $args[0] );
		}	
    }
}



/* ------------------------------------------------------------------------- */
/* ---------->>> API FOR THE GLOBAL TERM OPTION HOLDER <<<------------------ */
/* ------------------------------------------------------------------------- */



/* Add the global term option holder */
global $_BTP;
$_BTP[ 'term_option_holder' ] 	= new BTP_Term_Option_Holder();


/**
 * Inits global term option holder
 */
function btp_term_init_global_option_holder() {
	global $_BTP;
	
	$_BTP[ 'term_option_holder' ]->init();
}
add_action( 'init', 'btp_term_init_global_option_holder' );



/**
 * Adds term option group
 *
 * @param 			string $group_id 
 * @param 			array $group_args
 * @param			int $group_position   
 */
function btp_term_add_option_group( $group_id, $group_args, $group_position ) {
	global $_BTP;
	
	$_BTP[ 'term_option_holder' ]->add_group( $group_id, $group_args, $group_position );
}



/**
 * Adds term option subgroup
 * 
 * @param			string $subgroup_id
 * @param			array $subgroup_args
 * @param			string $group_id
 * @param			int $subgroup_position
 */
function btp_term_add_option_subgroup( $subgroup_id, $subgroup_args, $group_id, $subgroup_position ) {
	global $_BTP;	
	$_BTP[ 'term_option_holder' ]->add_subgroup( $subgroup_id, $subgroup_args, $group_id, $subgroup_position );
}



/**
 * Adds term option
 *
 * @param			string $option_id
 * @param			array $option_args
 */
function btp_term_add_option( $option_id, $option_args ) {
	global $_BTP;
	$_BTP[ 'term_option_holder' ]->add_item( 
		$option_id, 
		$option_args,
		isset ( $option_args[ 'group' ] ) ? $option_args[ 'group' ] : null, 
		isset ( $option_args[ 'subgroup' ] ) ? $option_args[ 'subgroup' ] : null,
		isset ( $option_args[ 'position' ] ) ? $option_args[ 'position' ] : null 
	);
}



/**
 * Gets term option value
 *  
 * @param 			int $tt_id
 * @param			string $option_id
 */
function btp_term_get_option_value( $tt_id, $option_id ) {
	global $_BTP;
	return $_BTP[ 'term_option_holder' ]->get_option_value( $tt_id, $option_id );		
}





btp_term_add_option_group( 
	'single', 
	array( 
		'label' => __( 'Single Term Elements', 'btp_theme' ),
	), 
	10 
);
btp_term_add_option_subgroup( 
	'main', 
	array( 
		'label' => __( 'Main', 'btp_theme' ),
	), 
	'single', 
	10
);


btp_term_add_option( 'posts_per_page', array(
	'label' 		=> __( 'Entries per page', 'btp_theme' ),
	'hint'			=> __( 'Leave empty to inherit', 'btp_theme' ),
	'group'			=> 'single',
	'subgroup'		=> 'main',
	'position'		=> 20,
));
btp_term_add_option( 'elem_sidebar_1', array(
	'view'			=> 'Choice',	
	'label' 		=> __( 'Sidebar', 'btp_theme' ),	
	'choices_cb'	=> 'btp_sidebar_get_choices',
	'null'			=> __( 'inherit', 'btp_theme' ),
	'group'			=> 'single',
	'subgroup'		=> 'main',
	'position'		=> 15,
));
btp_term_add_option( 'elem_title', array(
	'view'			=> 'Choice',
	'label' 		=> __( 'Title', 'btp_theme' ),
	'null'			=> __( 'inherit', 'btp_theme' ),
	'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'single',
	'subgroup'		=> 'main',
	'position'		=> 30,
));
btp_term_add_option( 'elem_featured_media', array(
	'view'			=> 'Choice',
	'label' 		=> __( 'Featured media', 'btp_theme' ),
	'null'			=> __( 'inherit', 'btp_theme' ),
	'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'single',
	'subgroup'		=> 'main',
	'position'		=> 40,
));
btp_term_add_option( 'elem_date', array(	
	'view'			=> 'Choice',
	'label' 		=> __( 'Date', 'btp_theme' ),
	'null'			=> __( 'inherit', 'btp_theme' ),
	'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'single',
	'subgroup'		=> 'main',
	'position'		=> 50,
));
btp_term_add_option( 'elem_comments_link', array(
	'view'			=> 'Choice',
	'label' 		=> __( 'Comments link', 'btp_theme' ),
	'null'			=> __( 'inherit', 'btp_theme' ),
	'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'single',
	'subgroup'		=> 'main',
	'position'		=> 60,
));
btp_term_add_option( 'elem_summary', array(
	'view'			=> 'Choice',
	'label' 		=> __( 'Summary', 'btp_theme' ),
	'null'			=> __( 'inherit', 'btp_theme' ),
	'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'single',
	'subgroup'		=> 'main',
	'position'		=> 70,
));
btp_term_add_option( 'elem_categories', array(
	'view'			=> 'Choice',
	'label' 		=> __( 'Categories', 'btp_theme' ),
	'null'			=> __( 'inherit', 'btp_theme' ),
	'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'single',
	'subgroup'		=> 'main',
	'position'		=> 80,
));
btp_term_add_option( 'elem_tags', array(	
	'view'			=> 'Choice',
	'label' 		=> __( 'Tags', 'btp_theme' ),
	'null'			=> __( 'inherit', 'btp_theme' ),
	'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'single',
	'subgroup'		=> 'main',
	'position'		=> 90,
));
btp_term_add_option( 'elem_button_1', array(	
	'view'			=> 'Choice',
	'label' 		=> __( 'Button', 'btp_theme' ),
	'null'			=> __( 'inherit', 'btp_theme' ),
	'choices'		=> array(
		'standard'		=> __( 'show', 'btp_theme' ),
		'none'			=> __( 'hide', 'btp_theme' ),
	),
	'group'			=> 'single',
	'subgroup'		=> 'main',
	'position'		=> 100,
));
?>