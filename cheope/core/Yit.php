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
 * Main YIT hub class
 * 
 * @since      1.0.0
 * @package    YIT
 * @author     Your Inspiration Themes Team <info@yithemes.com>
 */
final class YIT {
	
	/**
	 * Config collection
	 * 
	 * @var array
	 */
	public $yit = array();
	
	/**
	 * Constructor method
	 * 
	 */
	public function __construct() {
		$this->init();
	}
	
	/**
	 * Init method
	 * 
	 */
	public function init() {
	    $this->_loadTheme();
	    $this->_loadThemeSpecifics();
		$this->_loadClasses();
		$this->_checkVersion();
		$this->_loadConfig();
	}
	
	/**
	 * Check WP version
	 * 
	 */
	protected function _checkVersion() {
		global $wp_version;

		if( version_compare($wp_version, YIT_MINIMUM_WP_VERSION, '<') && is_admin() ) {
			$this->getModel('message')
				 ->addMessage( __('You are using an older version of Wordpress. 
							   This theme should not work properly. 
							   Please update your <strong>Wordpress</strong> version to the 
							   latest as soon as possible.', 'yit'), 'error');
		}
	}

	/**
	 * Load initial config
	 * 
	 */
	protected function _loadConfig() {
		$config = $this->getModel('config');
		$this->yit['config'] = $config->load();
	}
	
	/**
	 * Load classes
	 * 
	 */
	protected function _loadClasses() {
		$corePath     = YIT_CORE_PATH . '/yit/*.php';
		$includesPath = YIT_THEME_FUNC_DIR . '/yit/*.php';
		
		//search overrides within includes folder
		foreach( (array)glob($includesPath) as $class ) {
		    if ( empty( $class ) ) continue;
		    
			$className = 'YIT_' . basename($class, '.php');
			
			require_once($class);
			$this->yit['class'][substr(strtolower($className),4)] = new $className;
			
			if( method_exists( $this->yit['class'][substr(strtolower($className),4)], 'init' ) ) {
				add_action( 'yit_loaded', array( &$this->yit['class'][substr(strtolower($className),4)], 'init' ) );
			}
		}
		
		//load core classes 
		foreach( (array)glob($corePath) as $class ) {      
		    if ( empty( $class ) ) continue;
		    
			$className = 'YIT_' . basename($class, '.php');
			
			if(!class_exists($className)) {
				require_once($class);
				$this->yit['class'][substr(strtolower($className),4)] = new $className;
				
				if( method_exists( $this->yit['class'][substr(strtolower($className),4)], 'init' ) ) {
					add_action( 'yit_loaded', array( &$this->yit['class'][substr(strtolower($className),4)], 'init' ), 1 );
				}
			}
		}                
	}
    
    /**
     * Load theme specific panel
     *
     * @param string $path
     */
    protected function _loadThemeSpecifics( $path = null ) {
        if( is_null( $path ) )
            { $path = YIT_THEME_FUNC_DIR . '/panel/*'; }

        foreach( (array)glob( $path ) as $file ) {
		    if ( empty( $file ) ) continue;

            if( is_dir( $file ) ) {
                $this->_loadThemeSpecifics( $file . '/*' );
            } else {
            	$file_info = pathinfo($file);
                $stylesheet = ltrim( str_replace( '\\', '/', get_stylesheet_directory() ), '/' );
                $template = ltrim( str_replace( '\\', '/', get_template_directory() ), '/' );
                $file_path = str_replace( array( $stylesheet, $template ), '', str_replace( '\\', '/', $file_info['dirname'] ) );
                $file = ltrim( $file_path, '/' ) . '/' . basename( $file );   //var_dump($stylesheet, $template, $file_path, $file, "\n");
                $file = locate_template( $file );

				if( isset( $file_info['extension'] ) && ( $file_info['extension'] == 'php' ) ) {
					require_once $file;
				}
            }
        }
    }

	/**
	 * Load theme specific files
	 */
	protected function _loadTheme() {
		$excluded_files = array( 'metaboxes.php', 'woocommerce.php', 'jigoshop.php' );
		$excluded_files = apply_filters( 'yit_excluded_theme_files', $excluded_files );

		foreach( $excluded_files as &$exfile ) {
			$exfile = YIT_THEME_FUNC_DIR . '/' . $exfile;
		}

        foreach( (array)glob( YIT_THEME_FUNC_DIR . '/*.php' ) as $file ) {
			if ( in_array( $file, $excluded_files ) ) { continue; }

            $file_info = pathinfo($file);
            $stylesheet = ltrim( str_replace( '\\', '/', get_stylesheet_directory() ), '/' );
            $template = ltrim( str_replace( '\\', '/', get_template_directory() ), '/' );
            $file_path = str_replace( array( $stylesheet, $template ), '', str_replace( '\\', '/', $file_info['dirname'] ) );
            $file = ltrim( $file_path, '/' ) . '/' . basename( $file );
            $file = locate_template( $file );

            if( $file_info['extension'] == 'php' && !empty( $file ) ) {
                require_once $file;
            }
        }
    }

	/**
	 * Get class instance from $yit['class'] array
	 * 
	 * @param $class
	 * 
	 * @return object
	 */
	public function getModel($class) {
		return $this->yit['class'][$class];
	}

    /**
     * Set/Get attribute wrapper
     *
     * @param   string $method
     * @param   array $args
     * @return  mixed
     */
	public function __call($method, $args = null) {
		switch (substr($method, 0, 3)) {
			case 'get' :
				$data = $this->yit;
                $keys = $this->_keys(substr($method,3));
				
				foreach( $keys as $key ) {
					$data = $data[strtolower($key)];
				}
				
                return $data;

			//case 'set' : break;
			default: break;
		}
	}
	
    /**
     * Get field names for setters and geters
     *
     * $this->getConfigFontWebsafe() === $this->yit['config']['font']['websafe']
     *
     * @param string $name
	 * 
     * @return array
     */
    protected function _keys($name)
    {
        preg_match_all('/([A-Z][a-z0-9]+)/', $name, $matches);
		return $matches[0];
    }
}

/**
 * Get class instance from $yit['class'] array
 * 
 * @param string $class
 * @return object
 * 
 * @since 1.0.0  
 */
function yit_get_model( $class ) {
    global $yit;
    return $yit->getModel( $class );
}