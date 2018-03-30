<?php if (!defined('UT_VERSION')) {
    exit; // exit if accessed directly
}

/**
 * Taxonomy Select
 *
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     1.0.0
 * @version   1.1.0
 */
if ( ! function_exists( 'ut_render_option_taxonomy_select' ) ) {
  
    function ut_render_option_taxonomy_select( $settings = array() ) {
    
        /* extract variables */
        extract( $settings );
        
        $dependency = ut_create_dependency( $settings['required'] );
        
        echo '<div class="ut-admin-panel-content ' , $grid , ' clearfix" '. $dependency .' data-optiontype="select" data-panel-for="' , esc_attr( $id ) , '">'; 
        
            /* extract taxonomies */
            $taxonomies = !empty( $taxonomy ) ? explode( ',' , $taxonomy ) : array( 'category' );
                        
            /* get taxonomies */
            $taxonomies = get_categories( array( 'hide_empty' => false, 'taxonomy' => $taxonomies ), $id );
                                
            if ( is_array( $taxonomies ) && ! empty( $taxonomies ) ) {
                
                echo '<label for="' , esc_attr( $id ) , '">' , $title , '</label>';
                echo '<select name="' , esc_attr( $name ) , '" id="' , esc_attr( $id ) , '" class="ut-option-element">';
                    
                    echo '<option value="">-- ' . __( 'Choose Taxonomy', 'unite-admin' ) . ' --</option>';
                    
                    foreach( $taxonomies as $taxonomy ) {

                        echo '<option value="' . esc_attr( $taxonomy->term_id ) . '"' . selected( $value, $taxonomy->term_id, false ) . '>' . ( !empty( $taxonomy->name ) ? $taxonomy->name : esc_html__( 'Untitled', 'unite-admin' ) ) . '</option>';
                           
                    }
                
                echo '</select>';
                
            
            } else {            
    
                echo '<p>' . esc_html__( 'No Taxnomies Found', 'unite-admin' ) . '</p>';            
            
            }
        
        echo '</div>';                
               
    }

}