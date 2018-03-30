<?php 

if( !function_exists('ut_metabox_header_settings') ) :
    
    add_action( 'admin_init', 'ut_metabox_header_settings' );
    
    function ut_metabox_header_settings() {

        $ut_metabox_header_settings = array(
            
            'id'          => 'ut_metabox_header_settings',
            'title'       => 'United Themes - Header Settings',
            'desc'        => '',
            'pages'       => array( 'page' , 'portfolio' , 'product' ),
            'context'     => 'normal',
            'priority'    => 'low',
            'fields'      => array(
                
                array(
                    'id'          	=> 'ut_page_settings',
                    'metapanel'     => 'ut-page-header-settings',
                    'label'       	=> 'Header Settings',
                    'type'        	=> 'textblock',
                    'desc'        	=> '<h2>Header Settings</h2>',
                    'section_class'	=> 'ut-settings-heading',        
                    'class'       	=> ''
                ),
                  
                array(
                    'id'          => 'ut_display_section_header',
                    'metapanel'   => 'ut-page-header-settings',
                    'label'       => 'Show Header?',
                    'desc'		  => 'A page or section header typically forms the first element inside a section or page. It\'s located right above the content and contains the page title as well as an optional lead slogan which can be entered a few option beneath this one. With the help of this option you can easily hide this element.',
                    'type'        => 'select_group',
                    'toplevel'    => true,
                    'choices'     => array(
                      array(
                        'label'       => 'Show',
                        'for'         => array('ut_section_slogan','ut_page_slogan','ut_section_header_style','ut_section_header_font_style','ut_section_slogan_padding'),
                        'value'       => 'show'
                      ),
                      array(
                        'label'       => 'Hide',
                        'for'         => array(),
                        'value'       => 'hide'
                      )
                    ),
                    'std'         	=> 'show',
                    'rows'        	=> '',
                    'class'       	=> 'ut-section-header-state',
                    'section_class' => ''
                ),
                  
                array(
                    'id'          => 'ut_section_header_align',
                    'metapanel'   => 'ut-page-header-settings',
                    'label'       => 'Header Alignment',
                    'desc'		  => 'only available when <strong>Section Width / Style</strong> width has been set to: "Centered" or "Fullwidth Content". This option can be found inside the "Section Settings" tab.',
                    'type'        => 'select',
                    'choices'     => array(
                      array(
                        'label'       => 'Center',
                        'value'       => 'center'
                      ),
                      array(
                        'label'       => 'Left',
                        'value'       => 'left'
                      ),
                      array(
                        'label'       => 'Right',
                        'value'       => 'right'
                      )
                    ),
                    'std'         	=> 'center',
                    'rows'        	=> '',
                    'class'       	=> 'ut-section-header-state',
                    'section_class' => ''
                ),
                
                array(
                    'id'          => 'ut_section_header_width',
                    'metapanel'   => 'ut-page-header-settings',
                    'label'       => 'Header Width',
                    'desc'		  => '',
                    'type'        => 'select',
                    'choices'     => array(
                      array(
                        'label'       => 'Default (Theme Options)',
                        'value'       => 'global'
                      ),
                      array(
                        'label'       => '7/10 (default)',
                        'value'       => 'seven'
                      ),
                      array(
                        'label'       => '10/10 (fullwidth)',
                        'value'       => 'ten'
                      )
                    ),
                    'std'         	=> 'global',
                    'rows'        	=> '',
                    'section_class' => ''
                ),
                
                array(
                    'id'          => 'ut_section_header_text_align',
                    'metapanel'   => 'ut-page-header-settings',
                    'label'       => 'Header Text Alignment',
                    'desc'		  => 'Not available for Section Style "Split Content"',
                    'type'        => 'select',
                    'choices'     => array(
                      array(
                        'label'       => 'Default (Theme Options)',
                        'value'       => 'global'
                      ),                        
                      array(
                        'label'       => 'Center',
                        'value'       => 'center'
                      ),
                      array(
                        'label'       => 'Left',
                        'value'       => 'left'
                      )
                    ),
                    'std'         	=> 'global',
                    'rows'        	=> '',
                    'section_class' => ''
                ),
                  
                array(
                    'id'          => 'ut_section_header_style',
                    'metapanel'   => 'ut-page-header-settings',
                    'label'       => 'Header Style',
                    'desc'		  => 'Choose between one of these 7 nice header styles. You can optionally change it\'s color inside the "Color Settings" tab. <a href="#" class="ut-header-preview">Preview Header Styles</a>',
                    'type'        => 'select_group',
                    'choices'     => array(
                      
                      array(
                        'label'       => 'Default (Theme Options)',
                        'value'       => 'global'
                      ),
                      
                      array(
                        'label'       => 'Style One',
                        'value'       => 'pt-style-1'
                      ),
                      
                      array(
                        'label'       => 'Style Two',
                        'for'         => array(
                            'ut_section_headline_style_2_color',
                            'ut_section_headline_style_2_height',
                            'ut_section_headline_style_2_width'
                        ),
                        'value'       => 'pt-style-2'
                      ),
                      
                      array(
                        'label'       => 'Style Three',
                        'value'       => 'pt-style-3'
                      ),
                      
                      array(
                        'label'       => 'Style Four',
                        'value'       => 'pt-style-4'
                      ),
                      
                      array(
                        'label'       => 'Style Five',
                        'value'       => 'pt-style-5'
                      ),
                      
                      array(
                        'label'       => 'Style Six',
                        'value'       => 'pt-style-6'
                      ),
                      
                      array(
                        'label'       => 'Style Seven',
                        'value'       => 'pt-style-7'
                      )
                      
                    ),
                    
                    'std'         	=> 'global'
                        
                ),
                
                array(
                    'id'          => 'ut_section_headline_style_2_color',
                    'metapanel'   => 'ut-page-header-settings',
                    'label'       => 'Style Two Decoration Line Color',
                    'desc'        => '',
                    'type'        => 'colorpicker',
                    'std'         => ''
                ),
                  
                array(
                    'id'          => 'ut_section_headline_style_2_height',
                    'metapanel'   => 'ut-page-header-settings',
                    'label'       => 'Style Two Decoration Line Height',
                    'desc'        => '<strong>(optional)</strong> - value in px , default: 1px',
                    'type'        => 'text',
                    'std'         => ''
                ),
                  
                array(
                    'id'          => 'ut_section_headline_style_2_width',
                    'metapanel'   => 'ut-page-header-settings',
                    'label'       => 'Style Two Decoration Line Width',
                    'desc'        => '<strong>(optional)</strong> - value in % or px , default: 30px',
                    'type'        => 'text',
                    'std'         => ''
                ),
                  
                array(
                    'id'          => 'ut_section_header_font_style',
                    'metapanel'   => 'ut-page-header-settings',
                    'label'       => 'Header Font Style',
                    'type'        => 'select',
                    'desc'        => 'Choose between 6 different font styles. <a href="#" class="ut-font-preview">Preview Theme Font Style</a>',
                    'choices'     => array(
                      
                      array(
                        'label'       => 'Default (Theme Options)',
                        'value'       => 'global'
                      ),
                      
                      array(
                        'label'       => 'Extralight',
                        'value'       => 'extralight'
                      ),
                      
                      array(
                        'label'       => 'Light',
                        'value'       => 'light'
                      ),
                      
                      array(
                        'label'       => 'Regular',
                        'value'       => 'regular'
                      ),
                      
                      array(
                        'label'       => 'Medium',
                        'value'       => 'medium'
                      ),
                      
                       array(
                        'label'       => 'Semi Bold',
                        'value'       => 'semibold'
                      ),
                      
                       array(
                        'label'       => 'Bold',
                        'value'       => 'bold'
                      ),
                      
                    ),
                    
                    'std'         	=> 'global'
                        
                ),      
                
                array(
                    'id'           	=> 'ut_section_slogan_padding',
                    'metapanel'     => 'ut-page-header-settings',
                    'label'        	=> 'Header Padding Bottom',
                    'desc'         	=> '(optional) -  include "px" in your string. e.g. 150px (default: 30px). This option defines the space between header and content.',
                    'type'        	=> 'text',
                    'section_class'	=> 'ut-section-header-opt',
                    'class'       	=> '',
                    
                ),
                
                 array(
                    'id'           	=> 'ut_section_header_margin_left',
                    'metapanel'     => 'ut-page-header-settings',
                    'label'        	=> 'Header Margin Left',
                    'desc'         	=> '(optional) -  include "px" in your string. e.g. 30px (default: 0px).',
                    'type'        	=> 'text',
                    'section_class'	=> 'ut-section-header-opt',
                    'class'       	=> '',
                    
                ),
                
                array(
                    'id'           	=> 'ut_section_header_margin_right',
                    'metapanel'     => 'ut-page-header-settings',
                    'label'        	=> 'Header Margin Right',
                    'desc'         	=> '(optional) -  include "px" in your string. e.g. 30px (default: 0px).',
                    'type'        	=> 'text',
                    'section_class'	=> 'ut-section-header-opt',
                    'class'       	=> '',
                    
                ),
                
                array(
                    'id'          	=> 'ut_section_slogan_headline',
                    'metapanel'     => 'ut-page-header-settings',
                    'label'       	=> 'Lead Settings',
                    'type'        	=> 'textblock',
                    'desc'        	=> '<h2>Header Lead Settings</h2>',
                    'section_class'	=> 'ut-settings-heading alt',        
                    'class'       	=> ''
                ),
                  
                array(
                    'id'          	=> 'ut_section_slogan',
                    'metapanel'     => 'ut-page-header-settings',
                    'label'       	=> 'Header Lead', /* slogan */
                    'desc'        	=> 'You can also insert HTML as well as for example button shortcodes. <a class="ut-faq-link" target="_blank" href="http://faq.unitedthemes.com/brooklyn/buttons/"> Learn more about: Button Shortcodes</a>',
                    'type'        	=> 'textarea-simple',
                    'rows'			=> '5',
                    'class'       	=> ''        
                ),
                
                array(
                    'id'           	=> 'ut_section_slogan_padding_left',
                    'metapanel'     => 'ut-page-header-settings',
                    'label'        	=> 'Header Lead Padding Left',
                    'desc'         	=> '(optional) -  include "px" in your string. e.g. 30px (default: 0px).',
                    'type'        	=> 'text',
                    'section_class'	=> 'ut-section-header-opt',
                    'class'       	=> '',
                    
                ),
                
                array(
                    'id'           	=> 'ut_section_slogan_padding_right',
                    'metapanel'     => 'ut-page-header-settings',
                    'label'        	=> 'Header Lead Padding Right',
                    'desc'         	=> '(optional) -  include "px" in your string. e.g. 30px (default: 0px).',
                    'type'        	=> 'text',
                    'section_class'	=> 'ut-section-header-opt',
                    'class'       	=> '',
                    
                )
                
                
            )
        
        );
        
        ot_register_meta_box( $ut_metabox_header_settings );
    }

endif;    

?>