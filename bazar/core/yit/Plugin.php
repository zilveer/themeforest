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
 * Manage YITH plugins.
 * 
 * @since 1.0.0
 */
class YIT_Plugin {
	/**
	 * Plugins loaded
	 * 
	 * @var array
	 * @access public
	 * @since 1.0.0
	 */
	public $plugins = array();
	
	/**
	 * Folders in which plugins are stored
	 * 
	 * @var array
	 * @access public
	 * @since 1.0.0
	 */ 
	public $folders = array(
		'/theme/plugins/'
	);
	
	/**
	 * Constructor
	 */
	public function __construct() {
		$this->_loadPlugins();
	}
	
	/**
	 * Init
	 * 
	 */
	public function init() {
		
	}
	
	/**
	 * Load all plugins
	 * 
	 * @return void
	 * @access protected
	 * @since 1.0.0
	 */
	public function _loadPlugins() {
		foreach( $this->folders as $folder ) {
			foreach( (array)glob(YIT_THEME_PATH . $folder . '*', GLOB_ONLYDIR) as $plugin ) {
				$init = $plugin . '/init.php';
				if( file_exists($init) ) {
					$this->plugins[basename($plugin)] = array(
						'name' => basename($plugin),
						'path' => $plugin
					);
					require_once($init);
				}
				
			}
		}
	}
}