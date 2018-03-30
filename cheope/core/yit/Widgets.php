<?php
/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
 


/**
 * Class to instantiate Widgets
 * 
 * @since 1.0.0
 */
class YIT_Widgets {
	
	/**
	 * Widget Locations
	 * 
	 * @var array
	 * 
	 */
	public $locations = array(
        '/theme/widgets/',
		'/core/widgets/'
	);
	
	/**
	 * Widgets List
	 * 
	 * @var array
	 * 
	 */
	public $widgets = array();
	
	/**
	 * Unregistered widgets
	 * 
	 * @var array
	 */
	public $unregistered_widgets = array();
	
	/**
	 * Constructor
	 * 
	 */
	public function __construct() {}
	
	/**
	 * Init
	 * 
	 */
	public function init() {
		$unregistered_widgets = $this->unregistered_widgets;
		$this->unregistered_widgets = apply_filters( 'yit_unregister_widgets', $unregistered_widgets );

		add_action( 'widgets_init', array( &$this, 'loadWidgets') );
		add_action( 'widgets_init', array( &$this, 'unregister_widgets') );
		add_action( 'wp_enqueue_scripts', array(&$this, 'add_widgets_css_js'));
	}
	
	/**
	 * Load  Widgets
	 * 
	 */
	public function loadWidgets() {
		foreach( $this->locations as $location ) {
			$path = YIT_THEME_PATH . $location . '*.php';
			
			foreach( (array)glob($path) as $widget ) {       
		        if ( empty( $widget ) ) continue;
		    
				require_once($widget);
				
				$this->widgets[] = basename($widget, '.php');
				register_widget( basename($widget, '.php') );
			}
		}
	}
	
	
	/** 
	 * Unregister widgets
	 * 
	 */
	public function unregister_widgets() {
		foreach( $this->unregistered_widgets as $widget ) {
			unregister_widget($widget);
		}
	}
	
	/**
	 * Add shortcodes style
	 * 
	 */
	public function add_widgets_css_js() {
	  	if( file_exists(YIT_THEME_FUNC_DIR . '/assets/js/widgets.js') ) {
	    	wp_enqueue_script('widgets_theme_js', get_template_directory_uri() . '/theme/assets/js/widgets.js', array('jquery'), '', true );
	  	}
	 }
}

