<?php
 
add_action( 'admin_init', 'ut_one_page_settings' );

function ut_one_page_settings() {
    
    /* main one page option - only for pages */
    $ut_one_page_settings = array(
        'id'          => 'ut_one_page_settings',
        'title'       => 'Page & Section Settings',
        'desc'        => '',
        'pages'       => array( 'page' ),
        'context'     => 'normal',
        'priority'    => 'high',
        'fields'      => array(
          
          array(
            'id'          	=> 'ut_section_settings',
            'metapanel'     => 'ut-section-settings',
            'label'       	=> 'Section Settings',
            'type'        	=> 'textblock',        
            'desc'        	=> '<h2><span>Section /</span> Settings</h2> Section settings are only affecting pages which are sections on the front page.',
            'section_class'	=> 'ut-settings-heading',
            'class'       	=> ''
          ),
          
          array(
            'id'          => 'ut_section_width',
            'metapanel'   => 'ut-section-settings',
            'label'       => 'Section Style',
            'type'        => 'select_group',
            'desc'        => 'Decide if your content is centered or full width. For regular content we recommend to use the "Centered Content" option and for Portfolios or Google Maps the "Full Width Content". If you use "Split Section" please use the featured image to display a poster image. This poster image is always located next to the content (left or right depending on "Split Content Align").',
            'choices'     => array(
              array(
                'label'       => 'Centered Content',
                'for'		  => array('ut_section_header_align'),
                'value'       => 'centered'
              ),
              array(
                'label'       => 'Full Width Content',
                'for'		  => array('ut_section_header_align'),
                'value'       => 'fullwidth'
              ),
              array(
                'label'       => 'Split Content',
                'for'		  => array('ut_split_content_align','ut_split_section_margin_top','ut_split_section_margin_bottom'),
                'value'       => 'split'
              )
            ),
            'std'         	=> 'centered',
            'rows'        	=> '',
            'class'       	=> '',
            'section_class' => ''
          ),
          
          array(
            'id'          => 'ut_split_content_align',
            'metapanel'   => 'ut-section-settings',
            'label'       => 'Split Content Align',
            'type'        => 'select',
            'choices'     => array(
              array(
                'label'     => 'left',
                'value'     => 'left'
              ),
              array(
                'label'     => 'right',
                'value'     => 'right'
              )
            ),
            'std'         	=> 'right',
            'class'       	=> '',
            'section_class' => ''
          ),
          
          array(
            'id'          	=> 'ut_split_section_margin_top',
            'metapanel'     => 'ut-section-settings',
            'label'       	=> 'Split Section Margin Top',
            'desc'        	=> '(optional) -  include "px" in your string. e.g. 150px (default : 140px)',
            'std'         	=> '',
            'type'        	=> 'text',
            'min_max_step'	=> '',
            'class'       	=> '',
            'section_class' => ''
          ),
          
          array(
            'id'          	=> 'ut_split_section_margin_bottom',
            'metapanel'     => 'ut-section-settings',
            'label'       	=> 'Split Section Margin Bottom',
            'desc'        	=> '(optional) -  include "px" in your string. e.g. 130px (default : 70px)',
            'std'         	=> '',
            'type'        	=> 'text',
            'min_max_step'	=> '',
            'class'       	=> '',
            'section_class' => ''
          ), 
          
          array(
            'id'          => 'ut_section_shadow',
            'metapanel'   => 'ut-section-settings',
            'label'       => 'Section Shadow',
            'type'        => 'select',
            'desc'        => 'Creates a smooth shadow for this section.',
            'choices'     => array(
              array(
                'label'     => 'On',
                'value'     => 'on'
              ),
              array(
                'label'     => 'Off',
                'value'     => 'off'
              )
            ),
            'std'         	=> 'off',
            'class'       	=> '',
            'section_class' => ''
          ),
          
          array(
            'id'          	=> 'ut_section_padding_top',
            'metapanel'     => 'ut-section-settings',
            'label'       	=> 'Section Padding Top',
            'desc'        	=> '(optional) -  include "px" in your string. e.g. 150px (default : 80px)',
            'std'         	=> '',
            'type'        	=> 'text',
            'min_max_step'	=> '',
            'class'       	=> '',
            'section_class' => ''
          ),
          
          array(
            'id'          	=> 'ut_section_padding_bottom',
            'metapanel'     => 'ut-section-settings',
            'label'       	=> 'Section Padding Bottom',
            'desc'        	=> '(optional) -  include "px" in your string. e.g. 130px (default : 60px)',
            'std'         	=> '',
            'type'        	=> 'text',
            'min_max_step'	=> '',
            'class'       	=> '',
            'section_class' => ''
          ),          
          
          array(
            'id'          => 'ut_section_border_top',
            'metapanel'   => 'ut-section-settings',
            'label'       => 'Activate Section Border at Top?',
            'desc'        => '',
            'type'        => 'select_group',
            'toplevel'    => false,
            'choices'     => array(              
              array(
                'label'       => 'yes, please!',
                'for'         => array(
                                'ut_section_border_top_color',
                                'ut_section_border_top_width',
                                'ut_section_border_top_style'
                ),
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
            'id'          	=> 'ut_section_border_top_color',
            'metapanel'     => 'ut-section-settings',
            'label'       	=> 'Section Border Top Color',
            'type'        	=> 'colorpicker',
            'desc'       	=> '(optional)',
            'std'         	=> '',
            'rows'        	=> '',
            'class'       	=> '',
            'section_class' => ''
          ),
          
          array(
            'id'          => 'ut_section_border_top_width',
            'metapanel'   => 'ut-section-settings',
            'label'       => 'Section Border Top Width',
            'desc'        => '<strong>(optional)</strong>',
            'type'        => 'numeric-slider',
            'min_max_step'=> '1,100'
          ),
          
          array(
            'id'          => 'ut_section_border_top_style',
            'metapanel'   => 'ut-section-settings',
            'label'       => 'Section Border Top Style',
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
          ),
          
          
          array(
            'id'          => 'ut_section_border_bottom',
            'metapanel'   => 'ut-section-settings',
            'label'       => 'Activate Section Border at Bottom?',
            'desc'        => '',
            'type'        => 'select_group',
            'toplevel'    => false,
            'choices'     => array(              
              array(
                'label'       => 'yes, please!',
                'for'         => array(
                                'ut_section_border_bottom_color',
                                'ut_section_border_bottom_width',
                                'ut_section_border_bottom_style'
                ),
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
            'id'          	=> 'ut_section_border_bottom_color',
            'metapanel'     => 'ut-section-settings',
            'label'       	=> 'Section Border Bottom Color',
            'type'        	=> 'colorpicker',
            'desc'       	=> '(optional)',
            'std'         	=> '',
            'rows'        	=> '',
            'class'       	=> '',
            'section_class' => ''
          ),
          
          array(
            'id'          => 'ut_section_border_bottom_width',
            'metapanel'   => 'ut-section-settings',
            'label'       => 'Section Border Bottom Width',
            'desc'        => '<strong>(optional)</strong>',
            'type'        => 'numeric-slider',
            'min_max_step'=> '1,100'
          ),
          
          array(
            'id'          => 'ut_section_border_bottom_style',
            'metapanel'   => 'ut-section-settings',
            'label'       => 'Section Border Bottom Style',
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
          ),
          array(
            'id'          => 'ut_section_fancy_border',
            'metapanel'   => 'ut-section-settings',
            'label'       => 'Activate Section Fancy Border',
            'desc'        => '',
            'type'        => 'select_group',
            'toplevel'    => false,
            'choices'     => array(              
              array(
                'label'       => 'yes, please!',
                'for'         => array(
                                'ut_section_fancy_border_color',
                                'ut_section_fancy_border_background_color',
                                'ut_section_fancy_border_size'
                ),
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
            'id'          	=> 'ut_section_fancy_border_color',
            'metapanel'     => 'ut-section-settings',
            'label'       	=> 'Color',
            'type'        	=> 'colorpicker',
            'desc'       	=> '(optional)',
          ),
          array(
            'id'          	=> 'ut_section_fancy_border_background_color',
            'metapanel'     => 'ut-section-settings',
            'label'       	=> 'Background Color',
            'type'        	=> 'colorpicker',
            'desc'       	=> '(optional)',
          ),    
          array(
            'id'            => 'ut_section_fancy_border_size',
            'metapanel'     => 'ut-section-settings',
            'label'         => 'Size',
            'desc'          => '(optional) - default 10px',
            'type'          => 'text',
          ),          
          array(
            'id'          	=> 'ut_parallax_section_head',
            'metapanel'     => 'ut-section-parallax-settings',
            'label'       	=> 'Parallax Settings',
            'type'        	=> 'textblock',
            'desc'       	=> '<h2><span>Parallax</span> Settings</h2>',
            'std'         	=> '',
            'rows'        	=> '',
            'class'       	=> '',
            'section_class' => 'ut-settings-heading'
          ),
          
          
          array(
            'id'          => 'ut_parallax_section',
            'metapanel'   => 'ut-section-parallax-settings',
            'label'       => 'Paralaxx',
            'type'        => 'select',
            'desc'        => '',
            'choices'     => array(
              array(
                'label'       => 'Off',
                'value'       => 'off'
              ),
              array(
                'label'       => 'On',
                'value'       => 'on'
              )              
            ),
            'std'         	=> 'off',
            'rows'        	=> '',
            'class'       	=> 'ut-section-parallax-state',
            'section_class' => ''
          ),
          
          array(
            'id'          	=> 'ut_parallax_image',
            'metapanel'     => 'ut-section-parallax-settings',
            'label'       	=> 'Upload Section Background Image',
            'desc'        	=> 'Keep in mind, that you are not able to set a background position or attachment if the parallax option above has been set to "on".',
            'std'         	=> '',
            'type'        	=> 'background',
            'rows'        	=> '',
            'min_max_step'	=> '',
            'section_class' => 'ut-section-parallax-opt'
          ),
          
          array(
            'id'            => 'ut_section_video_state',
            'metapanel'     => 'ut-section-video-settings',
            'label'       	=> 'Section Video Settings',
            'type'        	=> 'textblock',
            'desc'       	=> '<h2><span>Video</span> Settings</h2>',
            'std'         	=> '',
            'rows'        	=> '',
            'class'       	=> '',
            'section_class' => 'ut-settings-heading'
          ),
          
         array(
            'id'          => 'ut_section_video_state',
            'metapanel'   => 'ut-section-video-settings',
            'label'       => 'Activate Section Background Video?',
            'desc'        => 'Keep in mind, that video backgrounds do not support parallax effects. Activating the background video will also overwrite the section background settings like color and image.',
            'type'        => 'select_group',
            'toplevel'    => true,
            'choices'     => array(              
              array(
                'label'       => 'yes, please!',
                'for'         => array(
                                'ut_section_video_source',
                                'ut_section_video',
                                'ut_section_video_mp4',
                                'ut_section_video_ogg',
                                'ut_section_video_webm',
                                'ut_section_video_loop',
                                'ut_section_video_preload',
                                'ut_section_video_sound',
                                'ut_section_video_volume',
                                'ut_section_video_mute_button',
                ),
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
            'id'          => 'ut_section_video_source',
            'metapanel'   => 'ut-section-video-settings',
            'label'       => 'Video Source',
            'desc'        => '',
            'type'        => 'select_group',
            'std'		  => 'youtube',
            'choices'     => array( 
              array(
                'value'       => 'youtube',
                'for'         => array('ut_section_video'),
                'label'       => 'Youtube'
              ),
              array(
                'value'       => 'selfhosted',
                'for'         => array('ut_section_video_mp4','ut_section_video_ogg','ut_section_video_webm','ut_section_video_preload'),
                'label'       => 'Selfthosted'
              )
            ),
          ),
                    
          array(
            'id'          => 'ut_section_video',
            'metapanel'   => 'ut-section-video-settings',
            'label'       => 'Video URL',
            'desc'        => 'Please insert the url only e.g. http://youtu.be/gvt_YFuZ8LA . Please do not insert the complete embedded code!',
            'type'        => 'text',
          ),
          
          array(
            'id'          => 'ut_section_video_mp4',
            'metapanel'   => 'ut-section-video-settings',
            'label'       => 'MP4',
            'desc'        => '',
            'type'        => 'upload',    
          ),
          
           array(
            'id'          => 'ut_section_video_ogg',
            'metapanel'   => 'ut-section-video-settings',
            'label'       => 'OGG',
            'desc'        => '',
            'type'        => 'upload',    
          ),
          
           array(
            'id'          => 'ut_section_video_webm',
            'metapanel'   => 'ut-section-video-settings',
            'label'       => 'WEBM',
            'desc'        => '',
            'type'        => 'upload',   
          ),
          
          array(
            'id'          	=> 'ut_section_video_loop',
            'metapanel'     => 'ut-section-video-settings',
            'label'       	=> 'Loop Video',
            'desc'        	=> '',
            'type'        	=> 'select',
            'choices'     	=> array(
              
              array(
                'label'       => 'yes, please!',
                'value'       => 'on'
              ),
              array(
                'label'       => 'no, thanks!',
                'value'       => 'off'
              )
              
            ),
            'std'         	=> 'on'
          ),
          
          array(
            'id'          	=> 'ut_section_video_preload',
            'metapanel'     => 'ut-section-video-settings',
            'label'       	=> 'Preload Video',
            'desc'        	=> '',
            'type'        	=> 'select',
            'choices'     	=> array(
              
              array(
                'label'       => 'yes, please!',
                'value'       => 'on'
              ),
              array(
                'label'       => 'no, thanks!',
                'value'       => 'off'
              )
              
            ),
            'std'         	=> 'on'
          ),
          
          array(
            'id'          => 'ut_section_video_sound',
            'metapanel'   => 'ut-section-video-settings',
            'label'       => 'Activate video sound after page is loaded?',
            'desc'        => '<strong>(optional)</strong>. Play sound directly when page is loaded.',
            'std'         => 'off',
            'type'        => 'select',
            'choices'     => array( 
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
          array(
            'id'          => 'ut_section_video_volume',
            'metapanel'   => 'ut-section-video-settings',
            'label'       => 'Video Volume',
            'desc'        => '1-100 - default 5',
            'std'         => '5',
            'type'        => 'numeric-slider',
            'min_max_step'=> '0,100,1'
          ),
          
          array(
            'id'          	=> 'ut_section_video_mute_button',
            'metapanel'     => 'ut-section-video-settings',
            'label'       	=> 'Show Mute Button?',
            'desc'        	=> '',
            'type'        	=> 'select',
            'choices'     	=> array(
              
              array(
                'label'       => 'yes, please!',
                'value'       => 'on'
              ),
              array(
                'label'       => 'no, thanks!',
                'value'       => 'off'
              )
              
            ),
            'std'         	=> 'off'
          ),
          
          array(
            'id'          => 'ut_section_video_poster',
            'metapanel'   => 'ut-section-video-settings',
            'label'       => 'Poster Image',
            'desc'        => 'This image will be displayed instead of the video on mobile devices.',
            'type'        => 'upload',    
          ),
          
          array(
            'id'            => 'ut_section_video_bgcolor',
            'metapanel'     => 'ut-section-video-settings',
            'label'       	=> 'Background Color',
            'type'        	=> 'colorpicker',
            'desc'        	=> '(optional). If you do not wish to use a poster image on mobile devices, you can use a background color as well.',
          ),
          
          array(
            'id'         	=> 'ut_overlay_setting',
            'metapanel'     => 'ut-section-overlay-settings',
            'label'       	=> 'Overlay Settings',
            'type'        	=> 'textblock',
            'desc'        	=> '<h2><span>Overlay /</span> Settings</h2>',
            'std'         	=> '',
            'rows'        	=> '',
            'section_class' => 'ut-settings-heading ut-section-parallax-opt'
          ),          
          
          array(
            'id'          => 'ut_overlay_section',
            'metapanel'   => 'ut-section-overlay-settings',
            'label'       => 'Overlay',
            'type'        => 'select',
            'desc'        => '',
            'choices'     => array(
              array(
                'label'       => 'On',
                'value'       => 'on'
              ),
              array(
                'label'       => 'Off',
                'value'       => 'off'
              )
            ),
            'std'         	=> 'off',
            'rows'        	=> '',
            'class'       	=> 'ut-section-overlay-state',
            'section_class' => 'ut-section-parallax-opt'
          ),
          
          
          array(
            'id'          	=> 'ut_overlay_pattern',
            'metapanel'     => 'ut-section-overlay-settings',
            'label'       	=> 'Overlay Pattern',
            'section_class'	=> 'ut-section-overlay-opt',
            'type'        	=> 'select',
            'desc'        	=> '',
            'choices'     	=> array(
              array(
                'label'       => 'On',
                'value'       => 'on'
              ),
              array(
                'label'       => 'Off',
                'value'       => 'off'
              )
            ),
            'std'         	=> 'off',
            'rows'        	=> '',
            'class'         => '',
            'section_class' => 'ut-section-parallax-opt ut-section-overlay-opt'
          ),
          
          array(
            'id'          	=> 'ut_overlay_pattern_style',
            'metapanel'     => 'ut-section-overlay-settings',
            'label'       	=> 'Overlay Pattern Style',
            'section_class'	=> 'ut-section-overlay-opt',
            'type'        	=> 'select',
            'desc'        	=> '',
            'choices'     	=> array(
              array(
                'label'       => 'Style One',
                'value'       => 'style_one'
              ),
              array(
                'label'       => 'Style Two',
                'value'       => 'style_two'
              )
            ),
            'std'         	=> 'style_one',
            'rows'        	=> '',
            'class'         => '',
            'section_class' => 'ut-section-parallax-opt ut-section-overlay-opt'
          ),
          
          
          array(
            'id'          	=> 'ut_overlay_color',
            'metapanel'     => 'ut-section-overlay-settings',
            'label'       	=> 'Section Overlay Color',
            'type'        	=> 'colorpicker',
            'section_class'	=> 'ut-section-overlay-opt',
            'desc'        	=> '(optional)',
            'std'         	=> '',
            'rows'        	=> '',
            'class'       	=> '',
            'section_class' => 'ut-section-parallax-opt ut-section-overlay-opt'
          ),
          
          
          array(
            'id'          	=> 'ut_overlay_color_opacity',
            'metapanel'     => 'ut-section-overlay-settings',
            'label'       	=> '',
            'desc'        	=> 'Overlay Color Opacity',
            'section_class'	=> 'ut-section-overlay-opt',
            'std'        	=> '',
            'type'       	=> 'numeric-slider',
            'rows'       	=> '',
            'post_type'   	=> '',
            'taxonomy'    	=> '',
            'min_max_step'	=> '0,1,0.1',
            'class'       	=> '',
            'section_class' => 'ut-section-parallax-opt ut-section-overlay-opt'
          ),
                  
          array(
            'id'          	=> 'ut_member_in_row',
            'metapanel'     => 'ut-manage-team',
            'label'       	=> 'Team member per row',
            'type'        	=> 'select',
            'desc'        	=> '',
            'choices'     	=> array(
              
              array(
                'label'       => '1',
                'value'       => 'one'
              ),
              array(
                'label'       => '2',
                'value'       => 'two'
              ),
              array(
                'label'       => '3',
                'value'       => 'three'
              ),
              array(
                'label'       => '4',
                'value'       => 'four'
              )          
              
            ),
            'std'         	=> 'three',
            'rows'        	=> '',
            'class'         => '',
            'section_class'	=> 'ut-team-section'
          ),
          
          array(
            'id'          	=> 'ut_member_box_layout',
            'metapanel'     => 'ut-manage-team',
            'label'       	=> 'Team Box Layout',
            'type'        	=> 'select',
            'desc'        	=> '',
            'choices'     	=> array(
              
              array(
                'label'       => 'Style One',
                'value'       => 'style_one'
              ),
              array(
                'label'       => 'Style Two',
                'value'       => 'style_two'
              ),
              array(
                'label'       => 'Style Three',
                'value'       => 'style_three'
              ),
              array(
                'label'       => 'Style Four',
                'value'       => 'style_four'
              )
              
            ),
            'std'         	=> '',
            'rows'        	=> '',
            'class'         => '',
            'section_class'	=> 'ut-team-section'
          ),
          
          /*array(
            'label'       	=> 'Team Member Box Size',
            'id'          	=> 'ut_member_box_size',
            'type'        	=> 'select',
            'desc'        	=> '',
            'choices'     	=> array(
              
              array(
                'label'       => 'Small',
                'value'       => 'ut-m-small'
              ),
              array(
                'label'       => 'Large',
                'value'       => 'ut-m-big'
              )
              
            ),
            'std'         	=> 'smal',
            'rows'        	=> '',
            'class'         => '',
            'section_class'	=> 'ut-team-section'
          ),*/
          
          
          array(
            'id'          	=> 'ut_team_member',
            'metapanel'     => 'ut-manage-team',
            'label'       	=> 'Manager your Team Members',
            'type'        	=> 'list-item',
            'section_class'	=> 'ut-team-section',
            'desc'       	=> '',
            'settings'    	=> array(
             
             array(
                'label'       => 'Upload',
                'id'          => 'ut_member_pic',
                'type'        => 'upload',
                'desc'        => 'Member Avatar. Should be at least 560px x 420px.',
                'std'         => '',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => ''
              ),
              
              array(
                'label'       => 'Upload',
                'id'          => 'ut_member_pic_alt',
                'type'        => 'upload',
                'desc'        => 'Alternate Member Avatar ( only for style four ). Should be at least 560px x 420px.',
                'std'         => '',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => ''
              ),          
              /*array(
                'label'       	=> 'Avatar Style',
                'id'          	=> 'ut_avatar_style',
                'type'        	=> 'select',
                'choices'     	=> array(			  
                  array(
                    'label'       => 'Square',
                    'value'       => 'ut-square'
                  ),			  
                  array(
                    'label'       => 'Rounded',
                    'value'       => 'ut-rounded'
                  ),			  
                  array(
                    'label'       => 'Circle',
                    'value'       => 'ut-circle'
                  ),			  
                ),
                'std'         	=> 'square',
                'rows'        	=> '',
                'class'         => ''
              ),*/		  
              array(
                'label'       => 'Member Name',
                'id'          => 'ut_member_name',
                'type'        => 'text',
                'desc'        => '',
                'std'         => '',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => ''
              ),		  
              array(
                'label'       => 'Member Title',
                'id'          => 'ut_member_title',
                'type'        => 'text',
                'desc'        => '',
                'std'         => '',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => ''
              ),		  
              array(
                'label'       => 'Description',
                'id'          => 'ut_member_description',
                'type'        => 'textarea-simple',
                'desc'        => 'this field also accepts shortcodes, for example skillbar shortcode',
                'std'         => '',
                'rows'        => '5',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => ''
              ),
              array(
                'label'       => 'Member Email',
                'id'          => 'ut_member_email',
                'type'        => 'text',
                'class'       => ''
              ),
              array(
                'label'       => 'Member Website',
                'id'          => 'ut_member_website',
                'type'        => 'text',
                'class'       => ''
              ),		  
              array(
                'label'       => 'Facebook',
                'id'          => 'ut_member_facebook',
                'type'        => 'text',
                'class'       => ''
              ),		  
              array(
                'label'       => 'Twitter',
                'id'          => 'ut_member_twitter',
                'type'        => 'text',
                'class'       => ''
              ),		  
              array(
                'label'       => 'Google',
                'id'          => 'ut_member_google',
                'type'        => 'text',
                'class'       => ''
              ),		  
              array(
                'label'       => 'Github',
                'id'          => 'ut_member_github',
                'type'        => 'text',
                'class'       => ''
              ),		  
              array(
                'label'       => 'Skype',
                'id'          => 'ut_member_skype',
                'type'        => 'text',
                'class'       => ''
              ),		  
              array(
                'label'       => 'Dribbble',
                'id'          => 'ut_member_dribbble',
                'type'        => 'text',
                'class'       => ''
              ),		  
              array(
                'label'       => 'Dropbox',
                'id'          => 'ut_member_dropbox',
                'type'        => 'text',
                'class'       => ''
              ),		  
              array(
                'label'       => 'Flickr',
                'id'          => 'ut_member_flickr',
                'type'        => 'text',
                'class'       => ''
              ),		  
              array(
                'label'       => 'Xing',
                'id'          => 'ut_member_xing',
                'type'        => 'text',
                'class'       => ''
              ),		  
              array(
                'label'       => 'Youtube',
                'id'          => 'ut_member_youtube',
                'type'        => 'text',
                'class'       => ''
              ),		  
              array(
                'label'       => 'Vimeo',
                'id'          => 'ut_member_vimeo',
                'type'        => 'text',
                'class'       => ''
              ),		  
              array(
                'label'       => 'LinkedIn',
                'id'          => 'ut_member_linkedin',
                'type'        => 'text',
                'class'       => ''
              ),		  
              array(
                'label'       => 'Instagram',
                'id'          => 'ut_member_instagram',
                'type'        => 'text',
                'class'       => ''
              ),          
            ),
            'std'         => '',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => 'ut-team-manager'
          ),
          
	  
  	)
  );  
  ot_register_meta_box($ut_one_page_settings);
}