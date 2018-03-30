<?php
/**
 * Super Class for all options
 *
 * @package Smartbox
 * @subpackage Core
 * @since 1.0
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.5.8
 */


/**
 * Class for all options
 *
 * @since 1.0
 **/
abstract class OxyOption {
    /**
     * Stores the field data array
     *
     * @var array
     **/
    protected $_field;

    /**
     * Stores the fields value
     *
     * @var array
     **/
    protected $_value;

    /**
     * The attributes that will be used to create the option
     * @var array
     * @access protected
     */
    protected $attr = array();

    /**
     * Main options construct
     *
     * @return void
     * @since 1.0
     **/
    function __construct( $field, $value, $attr = array() ) {
        $this->_field = $field;
        $this->_value = $value;

        // set extra attributes
        if( isset( $this->_field['attr'] ) ) {
            $attr = array_merge( $attr, $this->_field['attr'] );
        }

        foreach( $attr as $name => $value ) {
            $this->set_attr( $name, $value );
        }
    }

    /**
     * Sets an attribute
     * @param string $attr Name of attribute to set
     * @param string $value Value of attribute
     * @return void
     * @access public
     */
    public function set_attr( $attr, $value ) {
        // special case for classes
        if( 'class' == $attr ) {
            if( isset( $this->attr[$attr] ) ) {
                $this->attr[$attr] .= ' ' . $value;
            }
            else {
                $this->attr[$attr] = $value;
            }
        }
        else {
            $this->attr[$attr] = $value;
        }
    }

    /**
     * Returns an attribute
     * @param string $attr Name of attribute to return
     * @return void
     * @access public
     */
    public function get_attr( $attr ) {
        if( isset( $this->attr[$attr] ) ) {
            return $this->attr[$attr];
        }
        return null;
    }


     /**
     * Standard save function ( can be overrided )
     * checks array for option id and returns its value
     * @param array $save_data array of form data
     * @return value value saved by this option null if no value found
     * @access protected
     */
    function save( $save_data ) {
        $id = $this->_field[ 'id' ];
        if( isset( $save_data[$id] ) ) {
            return $save_data[$id];
        }
    }



    /**
     * Creates an attribute string with the values
     * contained inside option $attr array
     * @return string HTML attributes
     * @access protected
     */
    protected function create_attributes() {
        $attr = '';
        if( !empty( $this->attr ) ) {
            foreach( $this->attr as $name => $value ) {
                $attr .= ' ' . $name . '="' . $value . '"';
            }
        }
        return $attr;
    }

    /**
     * Renders the option - to be overriden by sub classes
     *
     * @return string HTML for option
     * @since 1.0
     **/
    public function render( $echo = true ) {
        return 'No sub-class defined for ' . $this->_field['type'];
    }

    /**
     * Checks for any extra scripts defined by the option - can be overridden by sub classes
     * best to call this parent first
     *
     * @return void
     * @since 1.0
     **/
    public function enqueue() {
        if( isset( $this->_field['javascripts'] ) ) {
            foreach( $this->_field['javascripts'] as $js ) {
                wp_enqueue_script( $js['handle'], $js['src'], $js['deps'] );
            }
        }
    }
}