<?php
/**
 * Checks for an updated version of the theme
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
 * Simple Text Input Box
 */
class OxyThemecheckupdatebutton extends OxyOption {

    /**
     * Creates option
     *
     * @return void
     * @since 1.0
     **/
    function __construct( $field, $value, $attr ) {
        parent::__construct( $field, $value, $attr );
        $this->set_attr( 'class', 'btn btn-primary' );
        $this->set_attr( 'value', __('Check for theme update', THEME_ADMIN_TD) );
    }

    /**
     * Overrides super class render function
     *
     * @return string HTML for option
     * @since 1.0
     **/
    public function render() {
        print_r( $_POST );
        echo '<input type="submit" name="check_theme_update" ' . $this->create_attributes() . ' />';
    }
}