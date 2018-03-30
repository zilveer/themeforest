<?php if (!defined('UT_VERSION')) {
    exit; // exit if accessed directly
}

/**
 * Sidebar Select
 *
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     1.0.0
 * @version   1.1.0
 */
if ( ! function_exists( 'ut_render_option_sidebar_select' ) ) {
  
    function ut_render_option_sidebar_select( $settings = array() ) {
        
        global $wp_registered_sidebars;
        
        /* extract variables */
        extract( $settings );        
        
        $dependency = ut_create_dependency( $settings['required'] );
        
        $choices = array( '' => esc_html__( 'Default Sidebar', 'unite-admin' ) );
        
        /* inject default sidebars */
        if( !empty( $wp_registered_sidebars ) ) :
            
            $sidebar_exceptions = apply_filters('ut_strip_sidebars_from_options', array() );
            
            foreach( $wp_registered_sidebars as $single_sidebar ) {
                
                if( !in_array( $single_sidebar['id'], $sidebar_exceptions ) ) {
                    
                    $choices[$single_sidebar['id']] = $single_sidebar['name'];
                
                }
                
            }
            
        endif;        
        
        /* inject dynamic sidebars */
        $dynamic_sidebars = get_option('unite_theme_sidebars');
                
        if( !empty( $dynamic_sidebars ) && is_array( $dynamic_sidebars ) ) :
                          
            foreach( $dynamic_sidebars as $single_sidebar ) {
                                             
                 $choices[$single_sidebar['sidebar_id']] = $single_sidebar['sidebarname'];
                            
            }
        
        endif;
        
        echo '<div class="ut-admin-panel-content ' , $grid , ' clearfix" '. $dependency .' data-optiontype="select" data-panel-for="' , esc_attr( $id ) , '">'; 
            
            echo '<div class="ut-select">';
            
                echo '<select name="' , esc_attr( $name ) , '" id="' , esc_attr( $id ) , '" class="ut-option-element">';
                
                /* loop through choices */
                if( !empty($choices ) ) {
                    
                    foreach ( (array) $choices as $option => $label ) {
                        
                        echo '<option value="' , esc_attr( $option ) , '" ' , selected( $value, $option, false ) , '>' , esc_attr( $label ) , '</option>';                
                        
                    }        
                    
                }
                
                echo '</select>';
            
            echo '</div>';
            
        echo '</div>'; 
            
    }

}