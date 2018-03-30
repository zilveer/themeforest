<?php if (!defined('UT_VERSION')) {
    exit; // exit if accessed directly
}

/**
 * Page Checkbox
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     1.0.0
 * @version   1.1.0
 */
if ( ! function_exists( 'ut_render_option_page_checkbox' ) ) {
  
    function ut_render_option_page_checkbox( $settings = array() ) {
    
        /* extract variables */
        extract( $settings );
        
        $dependency = ut_create_dependency( $settings['required'] );
        
        echo '<div class="ut-admin-panel-content ' , $grid , ' clearfix" '. $dependency .' data-optiontype="checkbox" data-panel-for="' , esc_attr( $id ) , '">'; 
        
            /* get posts */
            $the_pages = get_posts( array( 'post_type' => array( 'page' ), 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC', 'post_status' => 'any' ) );       
                    
            if ( is_array( $the_pages ) && ! empty( $the_pages ) ) {
            
                foreach( $the_pages as $the_page ) {
                    
                    echo '<label class="ut-checkbox">';   
                        echo '<input type="checkbox" name="' . esc_attr( $name ) . '[' . esc_attr( $the_page->ID ) . ']" id="' . esc_attr( $id ) . '-' . esc_attr( $the_page->ID ) . '" value="' . esc_attr( $the_page->ID ) . '" ' . ( isset( $value[$the_page->ID] ) ? checked( $value[$the_page->ID], $the_page->ID, false ) : '' ) . ' class="ut-option-element" />';
                        echo '<span>' . ( !empty( $the_page->post_title ) ? $the_page->post_title : esc_html__( 'Untitled', 'unite-admin' ) ) . '</span>';
                    echo '</label>';
                       
                }
            
            } else {            
    
                echo '<p>' . esc_html__( 'No Posts Found', 'unite-admin' ) . '</p>';            
            
            }
        
        echo '</div>';                
               
    }

}