<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if (!defined('YIT')) exit('Direct access forbidden.');

/**
 * Main YIT Class
 *
 * Load all theme stuffs
 *
 * @class YIT
 * @since 1.0.0
 * @package	Yithemes
 * @author Your Inspiration Themes
 */
final class YIT {

    /**
     * Paths in which look up for a class
     *
     * @var array|mixed|void
     */
    public $classPaths = array();

    /**
     * Constructor
     *
     * @since 1.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     */
    public function __construct() {
        do_action('yit_init');

        //class paths
        $this->classPaths = apply_filters('yit_class_paths', array(
            YIT_THEME_PATH . '/yit/',
            YIT_CORE_PATH . '/yit/'
        ));

        //add a new autoloader to the queue
        spl_autoload_register( array( $this, 'autoload' ) );

        //bootstrap
        new YIT_Bootstrap();

        do_action('yit_loaded');
    }

    /**
     * Auto-load classes on demand
     *
     * @param string $classname the name of the class
     * @return void
     * @since 1.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     *
     */
    public function autoload( $classname ) {
        if( strpos($classname, 'YIT_') == 0 ) {
            $classname = substr( $classname, 4 );
        }

        foreach( $this->classPaths as $path ) {
            $class = sprintf( '%s%s.php', $path , $classname );
            if( file_exists($class) ) {
                include_once( $class );
                break;
            }
        }
    }

}
