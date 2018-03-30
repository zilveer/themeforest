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
 * Generic class to create the YIThemes Admin Interface
 * 
 * 
 * @since 1.0.0
 */

abstract class YIT_Submenu_Abstract extends YIT_Panel {

	/**
	 * Subpage informations
	 * 
	 *	array(
	 *		'parent_slug' => '',
	 *		'page_title'  => '',
	 *		'menu_title'  => '',
	 *		'capability'  => '',
	 *		'menu_slug'   => '',
	 *		'function'    => ''
	 *	)
	 * 
	 * @var array
	 * 
	 */
	protected $_subpage = array();
    
    /**
     * Tab classes
     * 
     * @var array
     * @since 1.0.0
     */
    public $_tabClasses = array();
    
    public function __construct( $tabPath, $tabName ) {
        $this->_loadTab( $tabPath, $tabName );
    }                 
    
    public function get_header($id = '') {
        $this->init();
		global $yit;
        yit_get_template(
        	'admin/panel/header.php'
		);
        $this->get_menu($id) ;                
    }
	
	public function get_form($var){
		yit_get_template('admin/panel/form-start.php', $var );
	}
    
    public function get_footer() {
        yit_get_template('admin/panel/footer.php');
    }
    
    /**
     * Load tabs files
     * 
     * @param string $tabPath
     * @param string $tabName
     * @return void
     * @since 1.0.0
     */
    protected function _loadTab( $tabPath, $tabName ) {        
        $className = '';
        
        //load core classes 
		foreach( (array)glob( $tabPath ) as $class ) {       
		    if ( empty( $class ) ) continue;
		    
            $className = 'YIT_Submenu_Tabs_' . $tabName . '_' . basename($class, '.php');
            
			if(!class_exists($className)) {
   	            require_once($class);
                
                if( class_exists( $className ) ) {
                    $this->_tabClasses[substr(strtolower($className),12)] = new $className();
                
                    $this->panel[substr(strtolower($className),17)] = $this->_tabClasses[substr(strtolower($className),12)]->fields;
                }
			}
		}
        
        foreach( (array)glob( str_replace( YIT_CORE_PATH, YIT_THEME_FUNC_DIR, $tabPath ) ) as $class ) {
            if ( empty( $class ) ) continue;
		    
            $className = 'YIT_Submenu_Tabs_' . $tabName . '_' . basename($class, '.php');
            if(!class_exists($className)) {
   	            require_once($class);
                $this->_tabClasses[substr(strtolower($className),12)] = new $className();
                
                $this->panel[substr(strtolower($className),17)] = $this->_tabClasses[substr(strtolower($className),12)]->fields;
			}
        }
    }
    
    public function getPanel() {
        return $this->panel;
    }
	
	
	/**
	 * Add class iframe to body class
	 * 
	 */
	public function admin_body_class() {
		return "yit-framework_page_yit_panel_iframe";
	}
	
	/**
	 * Abstract definition of display page method
	 */
	abstract public function display_page();
    abstract public function get_menu( $id );
}
