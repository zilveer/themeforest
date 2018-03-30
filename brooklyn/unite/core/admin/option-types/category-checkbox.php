<?php if (!defined('UT_VERSION')) {
    exit; // exit if accessed directly
}

/**
 * Categroy Checkbox
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     1.1.0
 * @version   1.0.0
 */
 
 if ( ! function_exists( 'ut_render_option_category_checkbox' ) ) {
  
    function ut_render_option_category_checkbox( $settings = array() ) {
    
        /* extract variables */
        extract( $settings );
        
        $dependency = ut_create_dependency( $settings['required'] );
        
        echo '<div class="ut-admin-panel-content ' , $grid , ' clearfix" '. $dependency .' data-optiontype="checkbox" data-panel-for="' , esc_attr( $id ) , '">'; 
        
            $categories = get_categories( array( 'hide_empty' => false ) );    
            
            if ( is_array( $categories ) && ! empty( $categories ) ) {
            
                foreach( $categories as $category ) {
                                        
                    echo '<label class="ut-checkbox-label">'; 
                        echo '<input type="checkbox" name="' . esc_attr( $name ) . '[' . esc_attr( $category->term_id ) . ']" id="' . esc_attr( $id ) . '-' . esc_attr( $category->term_id ) . '" value="' . esc_attr( $category->term_id ) . '" ' . ( isset( $value[$category->term_id] ) ? checked( $value[$category->term_id], $category->term_id, false ) : '' ) . ' class="ut-option-element" />';
                        echo '<span class="ut-checkbox"></span>';
                        echo '<span class="ut-checkbox-description">' . ( !empty( $category->name ) ? $category->name : esc_html__( 'Untitled', 'unite-admin' ) ) . '</span>';                 
                    echo '</label>';
                    
                }
            
            }            
            
        echo '</div>'; 
               
    }

}