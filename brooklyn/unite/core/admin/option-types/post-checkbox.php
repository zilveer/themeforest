<?php if (!defined('UT_VERSION')) {
    exit; // exit if accessed directly
}

/**
 * Post Checkbox
 *
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     1.0.0
 * @version   1.1.0
 */
if ( ! function_exists( 'ut_render_option_post_checkbox' ) ) {
  
    function ut_render_option_post_checkbox( $settings = array() ) {
    
        /* extract variables */
        extract( $settings );
        
        $dependency = ut_create_dependency( $settings['required'] );
        
        echo '<div class="ut-admin-panel-content ' , $grid , ' clearfix" '. $dependency .' data-optiontype="checkbox" data-panel-for="' , esc_attr( $id ) , '">'; 
        
            /* get posts */
            $the_posts = get_posts( array( 'post_type' => array( 'post' ), 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC', 'post_status' => 'any' ) );       
                    
            if ( is_array( $the_posts ) && ! empty( $the_posts ) ) {
            
                foreach( $the_posts as $the_post ) {
                    
                    echo '<label class="ut-checkbox">';                        
                        echo '<input type="checkbox" name="' , esc_attr( $name ) , '[' , esc_attr( $the_post->ID ) , ']" id="' , esc_attr( $id ) , '-' , esc_attr( $the_post->ID ) , '" value="' , esc_attr( $the_post->ID ) , '" ' , ( isset( $value[$the_post->ID] ) ? checked( $value[$the_post->ID], $the_post->ID, false ) : '' ) , ' class="ut-option-element" />';                        
                        echo '<span>' , ( !empty( $the_post->post_title ) ? $the_post->post_title : esc_html__( 'Untitled', 'unite-admin' ) ) , '</span>';                        
                    echo '</label>';
                       
                }
            
            } else {            
    
                echo '<p>' , esc_html__( 'No Posts Found', 'unite-admin' ) , '</p>';            
            
            }
        
        echo '</div>';                
               
    }

}