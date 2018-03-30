<?php if (!defined('UT_VERSION')) {
    exit; // exit if accessed directly
}

/**
 * Taxonomy Checkbox
 *
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     1.0.0
 * @version   1.1.0
 */
if ( ! function_exists( 'ut_render_option_taxonomy_checkbox' ) ) {
  
    function ut_render_option_taxonomy_checkbox( $settings = array() ) {
    
        /* extract variables */
        extract( $settings );
        
        $dependency = ut_create_dependency( $settings['required'] );
        
        echo '<div class="ut-admin-panel-content ' , $grid , ' clearfix" '. $dependency .' data-optiontype="checkbox" data-panel-for="' , esc_attr( $id ) , '">'; 
        
            /* extract taxonomies */
            $taxonomies = !empty( $taxonomy ) ? explode( ',' , $taxonomy ) : array( 'category' );
                        
            /* get taxonomies */
            $taxonomies = get_categories( array( 'hide_empty' => false, 'taxonomy' => $taxonomies ), $id );       
                                
            if ( is_array( $taxonomies ) && ! empty( $taxonomies ) ) {
            
                foreach( $taxonomies as $taxonomy ) {
                    
                    echo '<label class="ut-checkbox">';
                        echo '<input type="checkbox" name="' . esc_attr( $name ) . '[' . esc_attr( $taxonomy->term_id ) . ']" id="' . esc_attr( $id ) . '-' . esc_attr( $taxonomy->term_id ) . '" value="' . esc_attr( $taxonomy->term_id ) . '" ' . ( isset( $value[$taxonomy->term_id] ) ? checked( $value[$taxonomy->term_id], $taxonomy->term_id, false ) : '' ) . ' class="ut-option-element" />';
                        echo '<span>' . ( !empty( $taxonomy->name ) ? $taxonomy->name : esc_html__( 'Untitled', 'unite-admin' ) ) . '</span>';
                    echo '</label>';
                       
                }
            
            } else {            
    
                echo '<p>' . esc_html__( 'No Taxonomies Found', 'unite-admin' ) . '</p>';            
            
            }
        
        echo '</div>';                
               
    }

}