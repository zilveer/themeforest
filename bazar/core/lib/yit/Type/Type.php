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
 * Load field types to be used in theme option panel
 * 
 * @since 1.0.0
 */
class YIT_Type {
	/**
	 * Load and print the correspondent field type.
	 * 
	 * @param @field
	 */
    public static function display( $field ) {
        $type      = ucfirst( $field['type'] );
        $className = 'YIT_Type_' . $type;
        if ( empty( $type ) ) {
            return false;
        }
        require_once( 'Types/' . $type . '.php' );
        if ( class_exists( $className ) ) {
            if ( $field['type'] != 'title' ) {
                //add id_container field to the array
                $field['id_container'] = $field['id'] ? $field['id'] . '-container' : '';
            }

            //print out the html
            $className = new $className();

            $dep = self::_getDeps( $field );
            echo $className->display( $field, $dep );
        }

        return false;
    }
    
    /**
     * Create the name for a field
     * 
     * @param string $id
     * @return string
     * @since 1.0.0
     */
    public static function name( $id ) {      
        return 'yit_panel_option[' . $id . ']';
    }
    
    /**
     * Check if the current value has dependencies. If yes, print the JS handler.
     * 
     * @param array $value
     * @return array
     * @access protected
     * @since 1.0.0
     */
    protected static function _getDeps( $value ) {
        if( !isset( $value['deps'] ) )
            { return false; }
        
        $deps = $value['deps'];
        
       	return array(
			'field' => $value['id'],
			'dep' => $deps['ids'],
			'value' => $deps['values']
		);
    }
}

if( !function_exists( 'yit_field_name' ) ) {
    /**
     * Format the name of the field
     * 
     * @param string $id
     * @return void
     * @since 1.0.0
     */
    function yit_field_name( $id ) {
        echo YIT_Type::name( $id );
    }
}

if( !function_exists( 'yit_get_field_name' ) ) {
    /**
     * Format the name of the field
     * 
     * @param string $id
     * @return void
     * @since 1.0.0
     */
    function yit_get_field_name( $id ) {
        return YIT_Type::name( $id );
    }
}