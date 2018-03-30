<?php

if( !function_exists('ut_metabox_csection_settings') ) :
    
    add_action( 'admin_init', 'ut_metabox_csection_settings' );
    
    function ut_metabox_csection_settings() {

        $ut_metabox_csection_settings = array(
            
            'id'          => 'ut_metabox_csection_settings',
            'title'       => 'United Themes - Contact Section Settings',
            'desc'        => '',
            'pages'       => array( 'page' , 'post' , 'portfolio' , 'product' ),
            'context'     => 'normal',
            'priority'    => 'low',
            'fields'      => array(
                    
                  array(
                    'id'         	=> 'ut_contact_section',
                    'metapanel'     => 'ut-contact-section',
                    'label'       	=> 'Contact Section Settings',
                    'type'        	=> 'textblock',
                    'desc'        	=> '<h2>Contact Section Settings</h2>',
                    'section_class' => 'ut-settings-heading'
                  ),
                  
                  array(
                    'id'         	=> 'ut_activate_csection',
                    'metapanel'     => 'ut-contact-section',
                    'label'       	=> 'Display Contact Section?',
                    'type'        	=> 'select',
                    'desc'        	=> '',
                    'choices'     	=> array(          
                      array(
                        'label'       => 'Default (Theme Options)',
                        'value'       => 'global'
                      ),
                      array(
                        'label'       => 'yes, please!',
                        'value'       => 'on'
                      ),
                      array(
                        'label'       => 'no, thanks!',
                        'for'         => array(),
                        'value'       => 'off'
                      )	  
                    ),
                    'std'         	=> 'global'
                  ),
                  
                  /*array(
                    'id'         	=> 'ut_activate_csection_border',
                    'metapanel'     => 'ut-contact-section',
                    'label'       	=> 'Activate Contact Section Border at Top?',
                    'type'        	=> 'select_group',
                    'desc'        	=> '',
                    'choices'     	=> array(          
                      array(
                        'label'       => 'yes, please!',
                        'for'         => array('ut_csection_border_color','ut_csection_border_width','ut_csection_border_style'),
                        'value'       => 'on'
                      ),
                      array(
                        'label'       => 'no, thanks!',
                        'for'         => array(''),
                        'value'       => 'off'
                      )	  
                    ),
                    'std'         	=> 'off'
                  ),
                                    
                  array(
                    'id'          	=> 'ut_csection_border_color',
                    'metapanel'     => 'ut-contact-section',
                    'label'       	=> 'Contact Section Border Top Color',
                    'type'        	=> 'colorpicker',
                    'desc'       	=> '(optional)',
                  ),
                  
                  array(
                    'id'          => 'ut_csection_border_width',
                    'metapanel'   => 'ut-contact-section',
                    'label'       => 'Contact Section Border Top Width',
                    'desc'        => '<strong>(optional)</strong>',
                    'type'        => 'numeric-slider',
                    'min_max_step'=> '1,100'
                  ),
                  
                  array(
                    'id'          => 'ut_csection_border_style',
                    'metapanel'   => 'ut-contact-section',
                    'label'       => 'Contact Section Border Top Style',
                    'type'        => 'select',
                    'desc'        => '',
                    'choices'     => array(
                      array(
                        'label'     => 'dashed',
                        'value'     => 'dashed'
                      ),
                      array(
                        'label'     => 'dotted',
                        'value'     => 'dotted'
                      ),
                      array(
                        'label'     => 'solid',
                        'value'     => 'solid'
                      ),
                      array(
                        'label'     => 'double',
                        'value'     => 'double'
                      )
                    ),
                    'std'         	=> 'solid',
                  ),*/                   
                  
                  array(
                    'id'          => 'ut_csection_background_image',
                    'metapanel'   => 'ut-contact-section',
                    'label'       => 'Background Image',
                    'desc'        => 'You can individually change the Background Image per page.',
                    'type'        => 'background',
                  ),
                  
                  array(
                    'id'          => 'ut_csection_overlay',
                    'metapanel'   => 'ut-contact-section',                    
                    'label'       => 'Overlay',
                    'type'        => 'select_group',
                    'choices'     => array( 
                      array(
                        'value'       => 'on',
                        'for'         => array('ut_csection_overlay_color','ut_csection_overlay_opacity'),
                        'label'       => 'On'
                      ),
                      array(
                        'value'       => 'off',
                        'for'         => array(),
                        'label'       => 'Off'
                      )
                    ),
                  ),
                  
                  array(
                    'id'          => 'ut_csection_overlay_color',
                    'metapanel'   => 'ut-contact-section',
                    'label'       => 'Overlay Color',
                    'desc'        => '<strong>(optional)</strong>',
                    'type'        => 'colorpicker',
                  ),
                  
                  array(
                    'id'          => 'ut_csection_overlay_opacity',
                    'metapanel'   => 'ut-contact-section',
                    'label'       => 'Overlay Color Opacity',
                    'desc'        => '<strong>(optional)</strong> - default 0.8',
                    'std'         => '0.8',
                    'type'        => 'numeric-slider',
                    'min_max_step'=> '0,1,0.1'
                  ),
                  
                  array(
                    'id'          => 'ut_show_scroll_up_button',
                    'metapanel'   => 'ut-contact-section',
                    'label'       => 'Scroll To Top Button',
                    'desc'        => 'Display "Scroll To Top" button?',
                    'std'         => 'global',                   
                    'type'        => 'select',
                    'choices'     => array( 
                       array(
                        'label'       => 'Default (Theme Options)',
                        'value'       => 'global'
                      ),
                      array(
                        'value'       => 'on',
                        'label'       => 'yes, please!'
                      ),
                      array(
                        'value'       => 'off',
                        'label'       => 'no, thanks!'
                      )
                    ),
                  ),
                  
                
            )
        );
        
        ot_register_meta_box( $ut_metabox_csection_settings );
        
    }
    
endif; ?>