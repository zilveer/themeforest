<?php 

if( !function_exists('ut_metabox_page_settings') ) :
    
    add_action( 'admin_init', 'ut_metabox_page_settings' );
    
    function ut_metabox_page_settings() {

        $ut_metabox_page_settings = array(
            
            'id'          => 'ut_metabox_page_settings',
            'title'       => 'United Themes - Page Settings',
            'desc'        => '',
            'pages'       => array( 'page', 'portfolio' ),
            'context'     => 'normal',
            'priority'    => 'low',
            'fields'      => array(
                
                array(
                    'id'          	=> 'ut_page_settings',
                    'metapanel'     => 'ut-page-settings',
                    'label'       	=> 'Page Settings',
                    'type'        	=> 'textblock',
                    'desc'        	=> '<h2>Page Settings</h2>',
                    'section_class'	=> 'ut-settings-heading',        
                    'class'       	=> ''
                ),
                
                array(
                    'id'         	=> 'ut_page_fullwidth',
                    'metapanel'     => 'ut-page-settings',
                    'label'       	=> 'Make Page Full Width?',
                    'type'        	=> 'select',
                    'desc'        	=> '',
                    'std'         	=> 'off',
                    'choices'     	=> array(
                      array(
                        'label'       => 'yes, please!',
                        'value'       => 'on'
                      ),
                      array(
                        'label'       => 'no, thanks!',
                        'for'         => array(),
                        'value'       => 'off'
                      )	  
                    )
                    
                ),
                
                array(
                    'id'           	=> 'ut_page_padding_top',
                    'metapanel'     => 'ut-page-settings',
                    'label'        	=> 'Page Padding Top',
                    'desc'         	=> '(optional) -  include "px" in your string. e.g. 150px (default: 80px).',
                    'type'        	=> 'text',
                    'section_class'	=> 'ut-section-header-opt',
                    'class'       	=> '',
                    
                ),
                
                array(
                    'id'           	=> 'ut_page_padding_bottom',
                    'metapanel'     => 'ut-page-settings',
                    'label'        	=> 'Page Padding Bottom',
                    'desc'         	=> '(optional) -  include "px" in your string. e.g. 150px (default: 40px).',
                    'type'        	=> 'text',
                    'section_class'	=> 'ut-section-header-opt',
                    'class'       	=> '',
                    
                )
                
            )
        
        );
        
        ot_register_meta_box( $ut_metabox_page_settings );
    }

endif;    

?>