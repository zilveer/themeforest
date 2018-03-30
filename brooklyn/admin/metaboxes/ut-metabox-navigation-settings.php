<?php 

if( !function_exists('ut_metabox_navigation_settings') ) :
    
    add_action( 'admin_init', 'ut_metabox_navigation_settings' );
    
    function ut_metabox_navigation_settings() {

        $ut_metabox_navigation_settings = array(
            
            'id'          => 'ut_metabox_navigation_settings',
            'title'       => 'United Themes - Navigation Settings',
            'desc'        => '',
            'pages'       => array( 'page' , 'portfolio' , 'product' ),
            'context'     => 'normal',
            'priority'    => 'low',
            'fields'      => array(
                
                array(
                    'id'          	=> 'ut_navigation_settings',
                    'metapanel'     => 'ut-navigation-section',
                    'label'       	=> 'Navigation Settings',
                    'type'        	=> 'textblock',
                    'desc'        	=> '<h2>Navigation Settings</h2>',
                    'section_class'	=> 'ut-settings-heading',        
                    'class'       	=> ''
                ),
                
                array(
                    'id'         	=> 'ut_navigation_config',
                    'metapanel'     => 'ut-navigation-section',
                    'label'       	=> 'Use Global Navigation Settings from Theme Options?',
                    'type'        	=> 'select_group',
                    'desc'        	=> '',
                    'choices'     	=> array(          
                      array(
                        'label'       => 'yes',
                        'for'         => array(''),
                        'value'       => 'on'
                      ),
                      array(
                        'label'       => 'no',
                        'for'         => array(
                            'ut_navigation_state',
                            'ut_navigation_transparent_border'
                        ),
                        'value'       => 'off'
                      )	  
                    ),
                    'std'         	=> 'yes'
                ),                
                
                array(
                    'id'          => 'ut_navigation_state',
                    'metapanel'   => 'ut-navigation-section',
                    'label'       => 'Always show Header with Navigation?',
                    'desc'        => 'This option makes the navigation visible all the time. If you choose "On (transparent)". The navigation will turn into the chosen skin when reaching the main content."',
                    'type'        => 'select_group',
                    'std'         => 'off',
                    'choices'     => array( 
                        array(
                            'value'       => 'on',
                            'label'       => 'On (with chosen skin)'
                        ),
                        array(
                            'value'       => 'on_transparent',
                            'for'         => array('ut_navigation_transparent_border'),
                            'label'       => 'On (transparent)'
                        ),
                        array(
                            'value'       => 'off',
                            'label'       => 'Off'
                        )
                    ),
                ),
                array(
                    'id'          => 'ut_navigation_transparent_border',
                    'metapanel'   => 'ut-navigation-section',
                    'label'       => 'Activate Navigation Border Bottom?',
                    'desc'        => '',
                    'type'        => 'select',
                    'std'         => 'off',
                    'choices'     => array( 
                        array(
                            'value'       => 'on',
                            'label'       => 'On'
                        ),
                        array(
                            'value'       => 'off',
                            'label'       => 'Off'
                        )
                    ),
                ),
                
                
               
               
               
                
                
            )
        
        );
        
        ot_register_meta_box( $ut_metabox_navigation_settings );
    }

endif;    

?>