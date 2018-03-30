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
 * Instance of the model
 *
 * @class YIT_Object
 * @package	Yithemes
 * @since 2.0.0
 * @abstract
 * @author Your Inspiration Themes
 */
abstract class YIT_Object {

    /**
     * Return an instance of the model called
     *
     * @param string $class The name of class that I want the instance
     * @since 2.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     * @return mixed
     */
    public function getModel( $class ) {
        return YIT_Registry::get_instance()->$class;
    }

    /**
     * Magic method for this class
     *
     * @param $name string The name of magic property
     * @since 2.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     * @return mixed
     */
    public function __get( $name ) {
        if( $name == 'request' ) {
            if( ! $this->_request instanceof YIT_Request ) {
                $this->_request = YIT_Registry::get_instance()->request;
            }

            return $this->_request;
        }
    }

}