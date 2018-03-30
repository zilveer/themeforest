<?php if (!defined('UT_VERSION')) {
    exit; // exit if accessed directly
}

/**
 * Sortable List
 *
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     1.0.0
 * @version   1.1.0
 */

if ( ! function_exists( 'ut_render_option_sortable' ) ) {
  
    function ut_render_option_sortable( $settings = array() ) {
    
        /* extract variables */
        extract( $settings );
        
        $dependency = ut_create_dependency( $settings['required'] );
        
        echo '<div class="ut-admin-panel-content ' , $grid , ' clearfix" '. $dependency .' data-optiontype="sortable" data-panel-for="' , esc_attr( $id ) , '">';    
                      
            if( !empty( $fields ) ) {
                
                /* check if keys are changed ( custom order ) */
                $fields = !empty( $value ) ? ut_sort_array_by_array( $fields, array_keys( $value ) ) : $fields;
                                
                echo '<ul class="ut-sortable-list">';
                                                            
                    foreach( (array) $fields as $key => $field ) {
                        
                        $field_value = !empty( $value[$key] ) ? $value[$key] : '';
                        
                        echo '<li>';
                        
                            echo '<label for="' , esc_attr( $id ) , '-' . $key . '">' , $field , '</label>';
                            echo '<div class="ut-sortable-handle"><i class="fa fa-arrows"></i></div>';
                            echo '<input autocomplete="off" type="text" name="' , esc_attr( $name ) , '[' . $key . ']" id="' , esc_attr( $id ) , '-' . $key . '" value="' , esc_attr( $field_value ) , '" class="ut-full-width ut-option-element" />';
                        
                        echo '</li>';
                        
                    }
                
                echo '</ul>';
            
            }
        
        echo '</div>';           
        
    }

}