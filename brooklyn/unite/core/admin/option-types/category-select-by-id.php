<?php if (!defined('UT_VERSION')) {
    exit; // exit if accessed directly
}

/**
 * Categroy Select by ID
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     1.1.0
 * @version   1.0.0
 */
 
 if ( ! function_exists( 'ut_render_option_category_select_by_id' ) ) {
  
    function ut_render_option_category_select_by_id( $settings = array() ) {
    
        /* extract variables */
        extract( $settings );
        
        /* assign post ID */
        $post_ID ? !empty( $post_ID ) : get_the_ID();
        
        $dependency = ut_create_dependency( $settings['required'] );
        
        echo '<div class="ut-admin-panel-content ' , $grid , ' clearfix" '. $dependency .' data-optiontype="select" data-panel-for="' , esc_attr( $id ) , '">'; 
           
            echo '<div class="ut-select">';
            
                echo '<select name="' , esc_attr( $name ) , '" id="' , esc_attr( $id ) , '" class="ut-option-element">';
                
                     echo '<option value="">' , esc_html__( 'WordPress (default)', 'unite-admin' ) , '</option>';
                
                $categories = (array) get_the_category( $post_ID );    
                    
                if ( is_array( $categories ) && ! empty( $categories ) ) {
                                        
                    foreach( $categories as $category ) {
                        
                        echo '<option value="' , esc_attr( $category->term_id ) , '" ' , selected( $category->term_id, $value, false ) , '>' . ( !empty( $category->name ) ? $category->name : esc_html__( 'Untitled', 'unite-admin' ) ) . '</option>';                        
                        
                    }
                
                }
                
                echo '</select>';
            
            echo '</div>';
        
        echo '</div>'; 
               
    }

}