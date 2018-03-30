<?php 

if( !function_exists('ut_metabox_portfolio_settings') ) :
    
    add_action( 'admin_init', 'ut_metabox_portfolio_settings' );
    
    function ut_metabox_portfolio_settings() {
        
        $ut_metabox_portfolio_settings = array(
            
            'id'          => 'ut_metabox_portfolio_settings',
            'title'       => 'United Themes - Portfolio Settings',
            'desc'        => '',
            'pages'       => array( 'portfolio' ),
            'context'     => 'normal',
            'priority'    => 'low',
            'fields'      => array(
                
                array(
                    'id'          	=> 'ut_portfolio_settings',
                    'metapanel'     => 'ut-portfolio-details',
                    'label'       	=> 'Portfolio Details',
                    'type'        	=> 'textblock',
                    'desc'        	=> '<h2><span>Portfolio /</span> Details</h2>',
                    'section_class'	=> 'ut-settings-heading',        
                    'class'       	=> ''
                ),
                                
                array(
                    'id'          => 'ut_portfolio_link_type',
                    'metapanel'   => 'ut-portfolio-details',
                    'label'       => 'Show Portfolio',
                    'type'        => 'select_group',
                    'desc'		  => 'Choose how the portfolio content should be displayed. If you choose "inside a lightbox or slideup box", the portfolio item gets opened inside a lightbox or slideup box ( depends on your showcase settings ). The option "on a separate portfolio page" will redirect the user to a single portfolio page, where you can add way more content and media.',
                    'std'		  => 'global',
                    'choices'     => array(     
                        array(
                            'value'       => 'global',
                            'for'         => array(),
                            'label'       => 'global (from showcase options)'
                        ),
                        array(
                            'value'       => 'onepage',
                            'for'         => array(),
                            'label'       => 'inside a slideup box'
                        ),
                        array(
                            'value'       => 'popup',
                            'for'         => array(),
                            'label'       => 'inside a lightbox'
                        ),
                        array(
                            'value'       => 'internal',
                            'for'         => array(),
                            'label'       => 'on a separate portfolio page'
                        ),
                        array(
                            'value'       => 'external',
                            'for'         => array('ut_external_link'),
                            'label'       => 'on an external website'
                        )
                    ),
                ),
                
                array(
                    'id'          => 'ut_external_link',
                    'metapanel'   => 'ut-portfolio-details',
                    'label'       => 'Project Link',
                    'type'        => 'text',
                    'desc'		  => 'Redirect the portfolio thumbnail directly to an external site. Only available for standard post format.'
                ),
                
                array(
                    'id'          => 'ut_portfolio_details',
                    'metapanel'   => 'ut-portfolio-details',
                    'label'       => 'Project Link',
                    'type'        => 'list-item',
                    'desc'		  => 'Add a nice portfolio description list to this portfolio.',
                    'settings'    => array(

                        array(
                            'id'        => 'value',
                            'label'     => 'Description',
                            'type'      => 'text'
                        )                    
                    
                    )
                )

            )
        
        );
        
        ot_register_meta_box( $ut_metabox_portfolio_settings );
        
    }
    
endif;


if( !function_exists('ut_metabox_portfolio_image_settings') ) :
    
    add_action( 'admin_init', 'ut_metabox_portfolio_image_settings' );
    
    function ut_metabox_portfolio_image_settings() {
        
        $ut_metabox_portfolio_image_settings = array(
            
            'id'          => 'ut_metabox_portfolio_image_settings',
            'title'       => 'Showcase Settings',
            'desc'        => 'Only affects portfolio items inside <br /><strong>Filterable Portfolio with Packery!</strong>',
            'pages'       => array( 'portfolio' ),
            'context'     => 'side',
            'priority'    => 'low',
            'fields'      => array(
                                
                array(
                    'id'          => 'ut_showcase_image_size',
                    'label'       => 'Showcase Image Size',
                    'type'        => 'select',
                    'std'		  => 'global',
                    'choices'     => array(     
                        array(
                            'value'       => 'standard',
                            'label'       => 'Standard'
                        ),
                        array(
                            'value'       => 'portrait',
                            'label'       => 'Portrait'
                        ),
                        array(
                            'value'       => 'panorama',
                            'label'       => 'Panorama'
                        ),
                        array(
                            'value'       => 'xxl',
                            'label'       => 'Extra Large'
                        ),
                     ),
                ),
                
                array(
                    'id'          => 'ut_showcase_custom_title',
                    'label'       => 'Custom Hover Text',
                    'type'        => 'text',
                ),
                

            )
        
        );
        
        ot_register_meta_box( $ut_metabox_portfolio_image_settings );
        
    }
    
endif;      

?>