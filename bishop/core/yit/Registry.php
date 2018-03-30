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
 * Create and Store Object
 *
 * @class YIT_Registry
 * @package	Yithemes
 * @author Your Inspiration Themes
 * @since 2.0.0
 */
class YIT_Registry {

    /**
     * Registry singleton
     *
     * @var YIT_Registry Create and Store object
     */
    public static $registry;

    /**
     * Instances
     *
     * @var array $instances This array contains the instantiated objects
     */
    private $instances = array();

    /**
     * Constructor
     *
     * @since 2.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     */
    private function __construct() {}

    /**
     * Get the instance of a class
     *
     * @param mixed $instance
     * @return mixed
     * @since 2.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     */
    public function __get( $instance ) {
        if( !isset( $this->instances[ $instance ] ) ) {
            try {
                $this->save_instance( $instance );
            } catch( YIT_Exception $e ) {
                echo $e->getTraceAsString();
            }
        }

        return $this->instances[ $instance ];
    }

    /**
     * Load required classes
     *
     * @since 2.0.0
     * @return void
     * @author Simone D'Amico <simone.damico@yithemes.com>
     */
    public function load() {
        $classes = func_get_args();
        foreach( $classes as $class ) {
            $this->save_instance( $class );
        }
    }

    /**
     * Create instance for the class
     *
     * @param mixed $class
     * @return mixed instance for the class
     * @throws YIT_Exception
     * @since 2.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     */
    private function save_instance( $class ) {
        $classname = 'YIT_' . ucfirst($class);
        if( is_string($class) && !isset($this->$class) && class_exists($classname) ) {
            $this->instances[ $class ] = new $classname;
        }
        // else {
        //     throw new YIT_Exception("Class $classname does not exist.");
        // }
    }

    /**
     * Get registry singleton
     *
     * @return YIT_Registry registry
     * @since 2.0.0
     * @return YIT_Registry
     * @author Simone D'Amico <simone.damico@yithemes.com>
     */
    static public function get_instance() {
        if( ! self::$registry instanceof YIT_Registry ) {
            self::$registry = new YIT_Registry();
        }
        return self::$registry;
    }

}