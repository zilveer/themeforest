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
 * YIT Update Themes submenu page
 * 
 * 
 * @since 1.0.0
 */

class YIT_Submenu_Update extends YIT_Submenu_Abstract {
    
    /**
     * Menu items
     * 
     * @var array
     * @since 1.0.0
     */
    public $_menu = array();
    
    /**
     * Submenu items
     * 
     * @var array
     * @since 1.0.0
     */
    public $_submenu = array();
    

	/**
	 * Constructor
	 * 
	 */
	public function __construct($tabPath, $tabName) {
		$this->init();
		parent::__construct($tabPath, $tabName);
	}

    /**
	 * Init helper method
     * 
	 */
	public function init() {
	    $this->_menu = apply_filters( 'yit_admin_menu_update', array() );


	}
    
    /**
     * Should print the menu but here it's not needed.
     * 
     * @return bool
     * @since 1.0.0
     */
    public function get_menu($id) {
        return false;
    }
	
	/**
	 * Support forum url
	 * 
	 * @var string
	 */
	protected $_url = 'http://yithemes.com';
	
	
	/**
	 * Print an iframe for the shop
	 * 
	 * @return void
     * @since 1.0.0
	 */
	public function display_page() {
		$config = YIT_Config::load();
		$name = $config['theme']['name']; 
		yit_get_template('admin/panel/notifier.php', $config['theme']);
	}
	
}
