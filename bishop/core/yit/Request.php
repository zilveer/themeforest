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
 * Advanced management for request methods
 *
 * Implements some method to easy manage the values from $_POST, $_GET and $_REQUEST.
 * From example, use $instance->get('var') from $_GET global array
 *
 * @class YIT_Request
 * @package	Yithemes
 * @since 2.0.0
 * @author Antonino Scarfi' <antonino.scarfi@gmail.com>
 */
class YIT_Request extends YIT_Object {

    /**
     * Flag to detect if ajax is active or not
     *
     * @var bool
     */
    public $is_ajax = false;

    /**
     * List of variables called by $_GET var
     *
     * @var array
     */
    protected $_get = array();

    /**
     * List of variables called by $_POST var
     *
     * @var array
     */
    protected $_post = array();

    /**
     * List of variables called by $_POST var
     *
     * @var array
     */
    protected $_request = array();

    /**
     * The name of the field for nonce value
     *
     * @var string
     */
    protected $_nonce_name = '_yitnonce';

    /**
     * Constructor
     *
     * @since 2.0.0
     * @author Antonino Scarfi <antonino.scarfi@yithemes.com>
     */
    public function __construct() {
        // define the flag $is_ajax
        $this->is_ajax = defined('DOING_AJAX') && DOING_AJAX ? true : false;

    }


    /**
     * Get the value from $_GET var
     *
     * @param string $var       The variable to get from $_GET var
     * @param array  $validate  The array with functions to use for validation of value
     *
     * @return mixed
     *
     * @since 2.0.0
     * @author Antonino Scarfi <antonino.scarfi@yithemes.com>
     */
    public function get( $var, $validate = array() ) {
        if ( isset( $this->_get[ $var ] ) ) {
            return $this->_get[ $var ];

        } elseif ( ! isset( $_GET[ $var ] ) ) {
            return false;
        }

        $value = $_GET[ $var ];

        // validate
        $value = $this->_validate( $value, $validate );

        $this->_get[ $var ] = $value;
        return $value;
    }

    /**
     * Get the value from $_POST var
     *
     * @param string $var       The variable to get from $_POST var
     * @param array  $validate  The array with functions to use for validation of value
     *
     * @return mixed
     *
     * @since 2.0.0
     * @author Antonino Scarfi <antonino.scarfi@yithemes.com>
     */
    public function post( $var, $validate = array() ) {
        if ( isset( $this->_post[ $var ] ) ) {
            return $this->_post[ $var ];

        } elseif ( ! isset( $_POST[ $var ] ) ) {
            return false;
        }

        $value = $_POST[ $var ];

        // validate
        $value = $this->_validate( $value, $validate );

        $this->_post[ $var ] = $value;
        return $value;
    }

    /**
     * Get the value from $_REQUEST var
     *
     * @param string $var       The variable to get from $_REQUEST var
     * @param array  $validate  The array with functions to use for validation of value
     *
     * @return mixed
     *
     * @since 2.0.0
     * @author Antonino Scarfi <antonino.scarfi@yithemes.com>
     */
    public function request( $var, $validate = array() ) {
        if ( isset( $this->_request[ $var ] ) ) {
            return $this->_request[ $var ];

        } elseif ( ! isset( $_REQUEST[ $var ] ) ) {
            return false;
        }

        $value = $_REQUEST[ $var ];

        // validate
        $value = $this->_validate( $value, $validate );

        $this->_request[ $var ] = $value;
        return $value;
    }

    /**
     * Validate the value passed in parameter
     *
     * @param mixed $value     The value to process
     * @param array $validate  The array with functions to use for validation of value
     *
     * @return mixed
     *
     * @since    Version 2.0.0
     * @author   Antonino Scarfi <antonino.scarfi@yithemes.com>
     */
    protected function _validate( $value, $validate = array() ) {
        if ( empty( $validate ) ) return $value;

        foreach ( $validate as $func ) {
            $value = call_user_func( $func, $value );
        }

        return $value;
    }

    /**********
     * NONCES *
     **********/

    /**
     * Generates and returns a nonce. The nonce is generated based on the current time, the $action argument,
     * and the current user ID.
     *
     * @param string $action  Action name. Should give the context to what is taking place. Optional but recommended.
     *
     * @return string
     *
     * @since    Version 2.0.0
     * @author   Antonino Scarfi <antonino.scarfi@yithemes.com>
     */
    public function create_nonce( $action ) {
        return wp_create_nonce('yit-' . $action );
    }

    /**
     * Return a nonce field.
     *
     * @param string $action  The name of the action to check
     * @param bool $referer If show referrer or not
     * @param bool $echo
     *
     * @return string
     *
     * @since    Version 2.0.0
     * @author   Antonino Scarfi <antonino.scarfi@yithemes.com>
     */
    public function nonce_field( $action, $referer = true, $echo = true ) {
        return wp_nonce_field('yit-' . $action, $this->_nonce_name, $referer, $echo );
    }

    /**
     * Return a url with a nonce appended.
     *
     * @param string $action  The name of the action to check
     * @param string $uri     The url where append nonce value
     *
     * @return string
     *
     * @since    Version 2.0.0
     * @author   Antonino Scarfi <antonino.scarfi@yithemes.com>
     */
    public function nonce_url( $action, $uri = '' ) {
        return wp_nonce_url( empty( $uri ) ? $_SERVER['REQUEST_URI'] : $uri, 'yit-' . $action, $this->_nonce_name );
    }

    /**
     * Check a nonce and sets yit error in case it is invalid.
     *
     * @param string $action  The name of the action to check
     * @param string $error_message The message to show in error case
     *
     * @return string
     *
     * @since    Version 2.0.0
     * @author   Antonino Scarfi <antonino.scarfi@yithemes.com>
     */
    public function verify_nonce( $action, $error_message = '' ) {
        $action = 'yit-' . $action;

        // set error message
        if ( empty( $error_message ) ) $error_message = __( 'You do not have permission to do this action.', 'yit' );

        // return true if action done successfully
        if ( wp_verify_nonce( $this->request( $this->_nonce_name ), $action ) ) return true;

        // else return error message
        if ( $error_message ) $this->getModel('message')->addMessage( $error_message, 'error', 'panel' );
    }

}

/**
 * Return the instance of class
 *
 * @return \YIT_Request
 *
 * @since    Version 2.0.0
 * @author   Antonino Scarfi <antonino.scarfi@yithemes.com>
 */
function YIT_Request() {
    return YIT_Registry::get_instance()->request;
}

/**
 * Return a nonce field.
 *
 * @param string $action  The name of the action to check
 * @param bool $referer If show referrer or not
 * @param bool $echo
 *
 * @return string
 *
 * @since    Version 2.0.0
 * @author   Antonino Scarfi <antonino.scarfi@yithemes.com>
 */
function yit_nonce_field( $action, $referer = true, $echo = true ) {
    YIT_Request()->nonce_field( $action, $referer, $echo );
}

/**
 * Return a url with a nonce appended.
 *
 * @param string $action  The name of the action to check
 * @param string $uri     The url where append nonce value
 *
 * @return string
 *
 * @since    Version 2.0.0
 * @author   Antonino Scarfi <antonino.scarfi@yithemes.com>
 */
function yit_nonce_url( $action, $uri = '' ) {
    YIT_Request()->nonce_url( $action, $uri );
}

/**
 * Check a nonce and sets yit error in case it is invalid.
 *
 * @param string $action  The name of the action to check
 * @param string $error_message The message to show in error case
 *
 * @return string
 *
 * @since    Version 2.0.0
 * @author   Antonino Scarfi <antonino.scarfi@yithemes.com>
 */
function yit_verify_nonce( $action, $error_message = '' ) {
    YIT_Request()->nonce_url( $action, $error_message );
}