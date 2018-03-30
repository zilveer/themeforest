<?php if (!defined('UT_VERSION')) {
    exit; // exit if accessed directly
}

/**
 * Post Select
 *
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     1.0.0
 * @version   1.1.0
 */
if ( ! function_exists( 'ut_render_option_post_select' ) ) {
  
    function ut_render_option_post_select( $settings = array() ) {
    
        /* extract variables */
        extract( $settings );
        
        $dependency = ut_create_dependency( $settings['required'] );
        
        echo '<div class="ut-admin-panel-content ' , $grid , ' clearfix" '. $dependency .' data-optiontype="select" data-panel-for="' , esc_attr( $id ) , '">'; 
        
            /* get posts */
            $the_posts = get_posts( array( 'post_type' => array( 'post' ), 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC', 'post_status' => 'any' ) );       
                    
            if ( is_array( $the_posts ) && ! empty( $the_posts ) ) {
                
                echo '<label for="' , esc_attr( $id ) , '">' , $title , '</label>';
                echo '<select name="' , esc_attr( $name ) , '" id="' , esc_attr( $id ) , '" class="ut-option-element">';
                    
                    echo '<option value="">-- ' . __( 'Choose Post', 'unite-admin' ) . ' --</option>';
                    
                    foreach( $the_posts as $the_post ) {

                        echo '<option value="' . esc_attr( $the_post->ID ) . '"' . selected( $value, $the_post->ID, false ) . '>' . ( !empty( $the_post->post_title ) ? $the_post->post_title : esc_html__( 'Untitled', 'unite-admin' ) ) . '</option>';
                           
                    }
                
                echo '</select>';
                
            
            } else {            
    
                echo '<p>' . esc_html__( 'No Posts Found', 'unite-admin' ) . '</p>';            
            
            }
        
        echo '</div>';                
               
    }

}