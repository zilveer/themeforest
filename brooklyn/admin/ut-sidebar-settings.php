<?php

if ( ! function_exists( 'ut_sidebar_settings' ) ) :
 
    add_action( 'admin_init', 'ut_sidebar_settings' );
    
    function ut_sidebar_settings() {
        
        $ut_sidebar_settings = array(
            
            'id'          => 'ut_sidebar_settings',
            'title'       => 'Sidebar Settings',
            'desc'        => '',
            'pages'       => array( 'page' ),
            'context'     => 'side',
            'priority'    => 'low',
            'fields'      => array(
                
                array(
                    'label'       => 'Select Sidebar',
                    'id'          => 'ut_select_sidebar',
                    'desc'		  => '',
                    'type'        => 'select',
                    'desc'        => '',
                    'choices'     => array(
                        
                        array(
                          'label'       => 'No Sidebar',
                          'value'       => 'no_sidebar'
                        ),
                        
                        array(
                          'label'       => 'Default Page Sidebar',
                          'value'       => 'page-widget-area'
                        ),
                        
                        
                    ),
                    
                    'std'         => 'no_sidebar'
                    
                ),
                
            ) /* close fields */
        
        ); /* close settings array */
        
        
        /* inject dynamic sidebar */
        $dynamic_sidebars = get_option('ut_theme_sidebars');
                
        if( !empty( $dynamic_sidebars ) && is_array( $dynamic_sidebars ) ) :
                          
            foreach( $dynamic_sidebars as $single_sidebar ) {
                 
                 $sidebar_setting = array();
                 
                 $sidebar_setting['label'] = $single_sidebar['sidebarname'];
                 $sidebar_setting['value'] = $single_sidebar['sidebar_id'];
                 
                 $counter = count( $ut_sidebar_settings['fields'][0]['choices'] );                 
                 $ut_sidebar_settings['fields'][0]['choices'][$counter+1] = $sidebar_setting;
                            
            }
        
        endif;
        
        ot_register_meta_box( $ut_sidebar_settings );
        
    }

endif;

?>