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
 * Advanced managment of the Transient API of wordpress, by the theme.
 * 
 * @since 1.0.0
 */
class YIT_Transient {
    /**
     * Array of used transients in the theme
     * 
     * @var int
     * @access protected
     * @since 1.0.0
     */
    protected $_transients = array();
    
    /**
     * Prefix of transients name
     * 
     * @var int
     * @access protected
     * @since 1.0.0
     */
    protected $_prefix = 'yit_';  
      
    
    public function init() {
        $this->_prefix .= YIT_THEME_NAME . '_';
    }            
    
    /** 
     * Add the transient name in the $_transients property
     */
    protected function _add( $transient ) {
        if ( ! in_array( $transient, $this->_transients ) ) {
            $this->_transients[] = $transient;
        }   
    }        
    
    /**
     * Set/update the value of a transient.
     *
     * You do not need to serialize values. If the value needs to be serialized, then
     * it will be serialized before it is set.
     *
     * @since 2.8.0
     * @package WordPress
     * @subpackage Transient
     *
     * @uses apply_filters() Calls 'pre_set_transient_$transient' hook to allow overwriting the
     * 	transient value to be stored.
     * @uses do_action() Calls 'set_transient_$transient' and 'setted_transient' hooks on success.
     *
     * @param string $transient Transient name. Expected to not be SQL-escaped.
     * @param mixed $value Transient value. Expected to not be SQL-escaped.
     * @param int $expiration Time until expiration in seconds, default 0
     * @return bool False if value was not set and true if value was set.
     */
    public function set_transient( $transient, $value, $expiration = 0 ) {
        $this->_add( $transient );
        
        return set_transient( $this->_prefix . $transient, $value, $expiration );
    }
    
    /**
     * Get the value of a transient.
     *
     * If the transient does not exist or does not have a value, then the return value
     * will be false.
     *
     * @uses apply_filters() Calls 'pre_transient_$transient' hook before checking the transient.
     * 	Any value other than false will "short-circuit" the retrieval of the transient
     *	and return the returned value.
     * @uses apply_filters() Calls 'transient_$option' hook, after checking the transient, with
     * 	the transient value.
     *
     * @since 2.8.0
     * @package WordPress
     * @subpackage Transient
     *
     * @param string $transient Transient name. Expected to not be SQL-escaped
     * @return mixed Value of transient
     */   
    public function get_transient( $transient ) {
        $this->_add( $transient );
        
        return get_transient( $this->_prefix . $transient );
    }      

    /**
     * Delete a transient.
     *
     * @since 2.8.0
     * @package WordPress
     * @subpackage Transient
     *
     * @uses do_action() Calls 'delete_transient_$transient' hook before transient is deleted.
     * @uses do_action() Calls 'deleted_transient' hook on success.
     *
     * @param string $transient Transient name. Expected to not be SQL-escaped.
     * @return bool true if successful, false otherwise
     */
    public function delete_transient( $transient ) {    
        $this->_add( $transient );
        
        return delete_transient( $this->_prefix . $transient );
    }
}                         

if ( ! function_exists( 'yit_set_transient' ) ) {
    /**
     * Set/update the value of a transient.
     *
     * You do not need to serialize values. If the value needs to be serialized, then
     * it will be serialized before it is set.
     *
     * @since 2.8.0
     * @package WordPress
     * @subpackage Transient
     *
     * @uses apply_filters() Calls 'pre_set_transient_$transient' hook to allow overwriting the
     * 	transient value to be stored.
     * @uses do_action() Calls 'set_transient_$transient' and 'setted_transient' hooks on success.
     *
     * @param string $transient Transient name. Expected to not be SQL-escaped.
     * @param mixed $value Transient value. Expected to not be SQL-escaped.
     * @param int $expiration Time until expiration in seconds, default 0
     * @return bool False if value was not set and true if value was set.
     */
    function yit_set_transient( $transient, $value, $expiration = 0 ) {
        return yit_get_model( 'transient' )->set_transient( $transient, $value, $expiration );
    }
}

if ( ! function_exists( 'yit_get_transient' ) ) { 
    /**
     * Get the value of a transient.
     *
     * If the transient does not exist or does not have a value, then the return value
     * will be false.
     *
     * @uses apply_filters() Calls 'pre_transient_$transient' hook before checking the transient.
     * 	Any value other than false will "short-circuit" the retrieval of the transient
     *	and return the returned value.
     * @uses apply_filters() Calls 'transient_$option' hook, after checking the transient, with
     * 	the transient value.
     *
     * @since 2.8.0
     * @package WordPress
     * @subpackage Transient
     *
     * @param string $transient Transient name. Expected to not be SQL-escaped
     * @return mixed Value of transient
     */   
    function yit_get_transient( $transient ) {                 
        return yit_get_model( 'transient' )->get_transient( $transient );    
    }                           
}

if ( ! function_exists( 'yit_delete_transient' ) ) { 
    /**
     * Delete a transient.
     *
     * @since 2.8.0
     * @package WordPress
     * @subpackage Transient
     *
     * @uses do_action() Calls 'delete_transient_$transient' hook before transient is deleted.
     * @uses do_action() Calls 'deleted_transient' hook on success.
     *
     * @param string $transient Transient name. Expected to not be SQL-escaped.
     * @return bool true if successful, false otherwise
     */
    function yit_delete_transient( $transient ) {
        return yit_get_model( 'transient' )->delete_transient( $transient );
    }
}