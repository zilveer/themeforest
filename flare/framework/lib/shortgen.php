<?php
/**
 * This file is part of the BTP_Framework package.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 * 
 * Table of contents: 
 * 
 * 1. class BTP_Shortgen
 * 2. API for global BTP_Shortgen      
 */



/* Prevent direct script access */
if ( !defined( 'BTP_FRAMEWORK_VERSION' ) ) exit( 'No direct script access allowed' );



/* ------------------------------------------------------------------------- */
/* ---------->>> SHORTCODE GENERATOR <<<------------------------------------ */
/* ------------------------------------------------------------------------- */



require_once( BTP_FRAMEWORK_DIR .'/lib/hierarchy.php');

/**
 * Shortcode Generator
 * 
 * @package			BTP_FRAMEWORK
 * @subpackage		BTP_SHORTCODES
 */
class BTP_Shortgen extends BTP_Hierarchy {
	
	/**
	 * Constructor
	 */	
	public function __construct() {
		parent::__construct();
		
		$this->set_base_item( array(	
			'apply'				=> array(),
			'apply_callback'	=> null,
			'prefix'			=> '_btp',
			'type'				=> 'inline',
			'help'				=> null,
			'atts'				=> array(),
		));
		
		$this->init();
	}		
	
	
	
	/**
	 * Inits shortcode generator, adds hooks
	 */
	public function init() {
		if ( !is_admin() ) {
			return;
		}
		
		add_action( 'admin_enqueue_scripts', array( &$this, 'enqueue_admin_scripts' ) );
		
		add_filter( 'tiny_mce_version', array( &$this, 'increase_tiny_mce_version' ) );
		add_filter( 'mce_external_plugins', array( &$this, 'register_tinymce_shortcode_generator_plugin') );
		add_filter( 'mce_buttons', array( $this, 'add_tinymce_shortcode_generator_button'), 0);
		add_filter( 'admin_footer', array( &$this, 'render' ) );
		
		/*
			
		
	   	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
			return;
		*/	   
		//if ( get_user_option('rich_editing') == 'true') {
			
			//add_filter('tiny_mce_version', 'btp_tiny_mce_version' );
	   		
			
			////add_action( 'admin_init', array(&$this, 'admin_init') ); // this must be first
			
	   	//}
	}
	
	
	/**
	 * Enqueues javascripts
	 */
	public function enqueue_admin_scripts() {
		wp_register_script( 
			'btp_shortcode_generator', 
			get_template_directory_uri() . '/framework/js/btp-shortgen.js', 
			array( 'jquery' ) 
		);	
		
		wp_enqueue_script( 'btp_shortcode_generator' );
	}
		
	
	
	/**
	 * Increase version number to prevent caching
	 * 
	 * @param 			int $version
	 * @return			int
	 */
	public function increase_tiny_mce_version( $version ) {
		return ++$version;
	}
	
	
	
	/**
	 * Adds shortcode generator button to TinyMCE visual editor
	 * 
	 * @param 			array $buttons
	 * @return			array
	 */
	public function add_tinymce_shortcode_generator_button( $buttons ) {
		$buttons[] = 'separator';
		$buttons[] = 'separator';
		foreach ( $this->hierarchy as $group_id => $group ) {
			$buttons[]  = esc_attr( 'btp_shortcode_generator_' . $group_id );
		}
		$buttons[] = 'separator';
		$buttons[] = 'separator';
	    
	    return $buttons;
	}
	
	
	
	/**
	 * Registers shortcode generator as TinyMCE plugin
	 * 
	 * @param 			array $plugin_array
	 * @return			array
	 */
	public function register_tinymce_shortcode_generator_plugin( $plugin_array ) {
		foreach( $this->hierarchy as $group_id => $group ) {    
	    	$plugin_array[ 'btp_shortcode_generator_' . $group_id ] = get_template_directory_uri() . '/framework/js/btp-shortgen.js';
		}	
	    
	    return $plugin_array;
	}
	
	
	
	/**
	 * Captures the UI for the Shortcode Generator
	 * 
	 * @return			string
	 */
	public function capture() {
		/* Sort items before capturing */
		$this->sort();	
		
		$out = '';
		foreach( $this->hierarchy as $group_id => $group ) {
			$out .= '<div id="' . esc_attr( 'btp-shortcode-generator-' . $group_id ) . '">';
				$out .= '<div class="btp-shortcode-generator">';
				
					$out .= '<h1>';
						if ( !empty( $group[ 'icon' ] ) ) {
                            $img_src = esc_url( $group[ 'icon' ] );

							$out .= '<img src="' . $img_src . '" alt="' . $img_src . '" />';
							
						} else {
							$img_src = get_template_directory_uri() . '/framework/images/icon_shortcode.png';

                            $out .= '<img src="' . $img_src . '" alt="' . $img_src . '" />';
						}					
						
						$out .= !empty( $group[ 'args' ][ 'label' ] ) ? esc_html( $group[ 'args' ][ 'label' ] ) : $group_id;
					$out .= '</h1>';

					
					$out .= $this->capture_nav( $group_id );
					$out .= $this->capture_viewport( $group_id );
					$out .= $this->capture_actions( $group_id );		
				$out .= '</div><!-- .btp-shortcode-generator -->';
			$out .= '</div>';
		}	
		
		return $out;
	} 	
	public function render() {
		echo $this->capture();
	}
	
	
	
	/**
	 * Captures the navigation section of the Shortcode Generator
	 * 
	 * @param 			string $group_id
	 * @return			string
	 */
	protected function capture_nav( $group_id ) {
		$out = '';
		
		$group = &$this->hierarchy[ $group_id ];
		
		$out .= '<div class="btp-nav">';
			$out .= '<label for="' . esc_attr( $group_id . '_navigation' ) . '">' . esc_html( __( 'Select Item', 'btp_theme' ) ) . '</label>';
			$out .= '<select name="' . esc_attr( $group_id . '_navigation' ) . '">';	
			$out .= '<option value="" selected="selected">- - -</option>';
			
			foreach( $group[ 'subgroups' ] as $subgroup_id => &$subgroup ) {				
				$out .= '<optgroup label="' . esc_attr( $subgroup[ 'args' ][ 'label' ]) . '">';
			
				foreach( $subgroup[ 'items' ] as $item_id => $item_args ) {
					$out .= '<option value="' . esc_attr( $item_id ) . '">' . esc_html( $item_id ) . '</option>';
				}
				
				$out .= '</optgroup>';			
			}
			/* Break the reference with the last element. */
			/* See http://php.net/manual/en/control-structures.foreach.php */
			unset( $subgroup );
	
			$out .= '</select>';
		$out .= '</div>';	
		
		unset( $group );
		
		return $out;
	}	
	
	
	
	/**
	 * Captures the viewport section of the Shortcode Generator
	 * 
	 * @param 			string $group_id
	 * @return			string
	 */
	protected function capture_viewport( $group_id ) {
		$out = '';	
		$out .= '<div class="btp-viewport">';
		
		$group = &$this->hierarchy[ $group_id ];
		
		foreach( $group[ 'subgroups' ] as $subgroup_id => &$subgroup ) {
			foreach( $subgroup[ 'items' ] as $item_id => $item_args ) {
				$item = $this->get_item( $item_id );
				$out .= '<div class="btp-viewport-item">';					
					$out .= '<div class="btp-shortcode">';				
						$out .= '<div class="btp-shortcode-meta"><input type="hidden" name="display" value="' . esc_attr( $item[ 'type' ] ) . '"/></div>';
					
						$out .= '<h2>' . esc_html( $item[ 'label' ] ) . '</h2>';
						
						if ( strlen( $item[ 'help' ] ) ) {
							$out .= '<div class="btp-shortcode-help">';
								$out .= $item[ 'help' ];
							$out .= '</div>';
						}
						
						/* Proceed with shortcode attributes & content */
						if ( ( isset( $item[ 'atts' ] ) && count( $item[ 'atts' ] ) ) || isset( $item[ 'content' ] ) ) {	

							/* Proceed with shortcode attributes */
							if ( isset( $item[ 'atts' ] ) && count( $item[ 'atts' ] ) ) {	
								$out .= '<div class="btp-shortcode-attributes">';
									foreach( $item[ 'atts'] as $attr_id => $attr ) {
										if ( empty ( $attr[ 'view' ] ) ) {
											continue;
										}
										
        								$view_class = 'BTP_Option_View_' . $attr[ 'view' ];
		
									    $view = new $view_class(
									       $attr_id,    	   
									       $attr,							
									       null		
									    );
									            
									    $out .= $view->capture();
									}
								$out .= '</div>';	
							}
							
							/* Proceed with shortcode content */
							if ( isset( $item[ 'content' ] ) ) {	
								$out .= '<div class="btp-shortcode-content">'; 
						        	$view = 'BTP_Option_View_'.$item[ 'content' ][ 'view' ];
							
				    		        $view = new $view( 
				            			'content',
				            			$item[ 'content' ],							
				            			null	
				            		);
				            		
				               		$out .= $view->capture();
				               		
								$out .= '</div>';	
							}
						/* Proceed with shortcode result */
						} else {	
							$out .= '<div class="btp-shortcode-result">';
								$out .= '<textarea>'. $item[ 'result' ] . '</textarea>';					
							$out .= '</div>';	
						}
					
					$out .= '</div>';
				
				$out .= '</div>';
			}
			/* Break the reference with the last element. */
			/* See http://php.net/manual/en/control-structures.foreach.php */
			unset( $subgroup );
		}		
		unset( $group );
		
		$out .= '</div><!-- .btp-viewport -->';
		
		return $out;
	}
	
	
	
	/**
	 * Captures the actions section of the Shortcode Generator
	 * 
	 * @param 			string $group_id
	 * @return			string
	 */
	protected function capture_actions( $group_id ) {
		$out = '';
		$out .= '<div class="btp-actions">';
			$out .=	'<a href="" class="button-secondary">' . __('Insert', 'btp_theme') . '</a>';
		$out .=	'</div>';
		
		return $out;
	}	
}



/* ------------------------------------------------------------------------- */
/* ---------->>> API FOR THE GLOBAL SHORTCODE GENERATOR <<<----------------- */
/* ------------------------------------------------------------------------- */



global $_BTP;
$_BTP[ 'shortgen' ]	= new BTP_Shortgen();



/**
 * Adds shortcode generator item group
 *
 * @param 			string $group_id 
 * @param 			array $group_args
 * @param			int $group_position   
 */
function btp_shortgen_add_group( $group_id, $group_args, $group_position ) {
	global $_BTP;
	
	$_BTP[ 'shortgen' ]->add_group( $group_id, $group_args, $group_position );
}



/**
 * Adds shortcode generator item subgroup
 * 
 * 
 * @param			string $subgroup_id
 * @param			array $subgroup_args
 * @param			string $group_id
 * @param			int $subgroup_position
 */
function btp_shortgen_add_subgroup( $subgroup_id, $subgroup_args, $group_id, $subgroup_position ) {
	global $_BTP;	
	$_BTP[ 'shortgen' ]->add_subgroup( $subgroup_id, $subgroup_args, $group_id, $subgroup_position );
}



/**
 * Adds shortcode generator item
 *
 * @param			string $option_id
 * @param			array $option_args
 */
function btp_shortgen_add_item( $option_id, $option_args ) {
	global $_BTP;
	$_BTP['shortgen' ]->add_item( 
		$option_id, 
		$option_args, 
		$option_args[ 'group' ],
		$option_args[ 'subgroup' ],
		$option_args[ 'position' ] 
	);
}





btp_shortgen_add_group( 
	'general', 
	array( 
		'label' => __( 'General Shortcode Generator', 'btp_theme' ),
	),  
	10
);

btp_shortgen_add_subgroup( 
	'basic', 
	array( 
		'label' => __( 'Basic', 'btp_theme' ),
	),  
	'general',
	10
);
?>