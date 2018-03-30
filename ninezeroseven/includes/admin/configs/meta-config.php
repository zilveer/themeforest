<?php

/************************************************************************
* Meta Box Options/fields
*
* 1- Post Formats
*         1a Link Format
*         1b Quote Format
*         1c Video Format
*         1d Audio Format
*         1e Gallery Format
*     1.1 Post SideBar
*
* 2- Page Options
*
* 3- Portfolio Options
*     3.1 Portfolio Sidebar
*
*
* 4- Page, Post, wbc_portfolio Options
*     4.1 General
*     4.2 Header Options
*     4.3 Footer Options
*     
*************************************************************************/

$redux_opt_name = "wbc907_data";

$post_type = (isset($_GET['post_type'])) ? $_GET['post_type'] : 'post';


if ( !function_exists( "wbc907_add_metaboxes" ) ):
    function wbc907_add_metaboxes($metaboxes) {

    global $post_type;

    /**
     * Gets FontAwesome Array
     * $sort = true // Sorts the Icons
     * $w_name = true // Adds named array like array(fa-cogs => Cogs)
     * $no_fa = true // Removes 'fa' from 'fa fa-cogs'
     */
    $iconArray = wbc_fontawesome_array( true, true, true );


    $metaboxes = array();

    // Grab options panel values.
    $options_values = get_option('wbc907_data');


    /************************************************************************
    * 1- Begin Post Formats
    *************************************************************************/

    /* 1a Link Format*/
    $link_options = array();
    $link_options[] = array(
        'icon_class'    => 'icon-large',
        'icon'          => 'el-icon-home',
        'fields'        => array(
            array(
                'id'       => 'wbc-link-format-text',
                'type'     => 'text',
                'title'    => esc_html__('Link Title', 'ninezeroseven'),
                'validate' => 'no_html',
            ),
            array(
                'id'        => 'wbc-link-format-link',
                'type'      => 'text',
                'title'     => esc_html__('Enter Link Here', 'ninezeroseven'),
                'subtitle'  => esc_html__('This must be a URL starting with http://', 'ninezeroseven'),
                'validate'  => 'url',
                'default'   => '',
            )
            
        ),
    );

    $metaboxes[] = array(
        'id'          => 'link-format',
        'title'       => esc_html__( 'Link Format', 'ninezeroseven' ),
        'post_types'  => array('post'),
        'post_format' => array('link'),
        'position'    => 'normal', // normal, advanced, side
        'priority'    => 'high', // high, core, default, low
        'sidebar'     => false, // enable/disable the sidebar in the normal/advanced positions
        'sections'    => $link_options,
    );
    /* 1a End Link Format*/



    /* 1b QUOTE FORMAT*/
    $quote_options = array();
    $quote_options[] = array(
        'icon_class'    => 'icon-large',
        'icon'          => 'el-icon-home',
        'fields'        => array(
            array(
                'id'       => 'wbc-quote-who',
                'type'     => 'text',
                'title'    => esc_html__('Quote\'s Credit/Name', 'ninezeroseven'),
                'validate' => 'no_html',
                'default'  => ''
            ),
            array(
                'id'        => 'wbc-quote-message',
                'type'      => 'textarea',
                'title'     => esc_html__('Quote Message', 'ninezeroseven'),
                'subtitle'  => esc_html__('Enter quote below', 'ninezeroseven'),
                'validate'  => 'no_html',
                'default'   => ''
            ),
            
        ),
    );

    $metaboxes[] = array(
        'id'          => 'quote-format',
        'title'       => esc_html__( 'Quote Format', 'ninezeroseven' ),
        'post_types'  => array('post'),
        'post_format' => array('quote'),
        'position'    => 'normal', // normal, advanced, side
        'priority'    => 'high', // high, core, default, low
        'sidebar'     => false, // enable/disable the sidebar in the normal/advanced positions
        'sections'    => $quote_options,
    );
    /* 1b End QUOTE FORMAT*/

  
    /* 1c Video Format*/

    $video_options = array();
    $video_options[] = array(
        'icon_class'    => 'icon-large',
        'icon'          => 'el-icon-home',
        'fields'        => array(
            array(
                'id'       => 'wbc-video-embed',
                'type'     => 'textarea',
                'title'    => esc_html__('Video Embed Code', 'ninezeroseven'),
                'subtitle' => esc_html__('Enter embed code below', 'ninezeroseven'),
                'validate' => 'html_custom',
                'default'  => ''
            ),
            
        ),
    );

    $metaboxes[] = array(
        'id'          => 'video-format',
        'title'       => esc_html__( 'Video Format', 'ninezeroseven' ),
        'post_types'  => array('post'),
        'post_format' => array('video'),
        'position'    => 'normal', // normal, advanced, side
        'priority'    => 'high', // high, core, default, low
        'sidebar'     => false, // enable/disable the sidebar in the normal/advanced positions
        'sections'    => $video_options,
    );
    /* 1c End Video Format*/

    /* 1d Audio Format*/

    $audio_options = array();
    $audio_options[] = array(
        // 'title'         => esc_html__(' ', 'ninezeroseven'),
        'icon_class'    => 'icon-large',
        'icon'          => 'el-icon-home',
        'fields'        => array(

            array(
                'id'      => 'wbc-audio-mp3',
                'type'    => 'text',
                'title'   => esc_html__('Enter MP3 URL Here', 'ninezeroseven'),
                'default' => ''
            ),

            array(
                'id'      => 'wbc-audio-ogg',
                'type'    => 'text',
                'title'   => esc_html__('Enter OGG URL Here', 'ninezeroseven'),
                'default' => ''
            ),
            array(
                'id'       => 'wbc-audio-embed',
                'type'     => 'textarea',
                'title'    => esc_html__('Audio Embed Code', 'ninezeroseven'),
                'subtitle' => esc_html__('Optional: Enter Embed/Shortcode code Here', 'ninezeroseven'),
                'validate' => 'html_custom',
                'default'  => ''
            ),
            
        ),
    );

    $metaboxes[] = array(
        'id'          => 'audio-format',
        'title'       => esc_html__( 'Audio Format', 'ninezeroseven' ),
        'post_types'  => array('post'),
        'post_format' => array('audio'),
        'position'    => 'normal', // normal, advanced, side
        'priority'    => 'high', // high, core, default, low
        'sidebar'     => false, // enable/disable the sidebar in the normal/advanced positions
        'sections'    => $audio_options,
    );
    /* 1d End Audio Format*/

    /* 1e Gallery Format*/
    $gallery_options = array();
    $gallery_options[] = array(
        // 'title'         => esc_html__(' ', 'ninezeroseven'),
        'icon_class'    => 'icon-large',
        'icon'          => 'el-icon-home',
        'fields'        => array(
            array(
                'id'        => 'wbc-gallery-format',
                'type'      => 'gallery',
                'title'     => esc_html__('Gallery Images', 'ninezeroseven'),
                'subtitle'  => esc_html__('You can add images here for slider/gallery.', 'ninezeroseven'),
            ),
            
        ),
    );

    $metaboxes[] = array(
        'id'          => 'gallery-format',
        'title'       => esc_html__( 'Gallery Format', 'ninezeroseven' ),
        'post_types'  => array('post'),
        'post_format' => array('gallery'),
        'position'    => 'normal', // normal, advanced, side
        'priority'    => 'high', // high, core, default, low
        'sidebar'     => false, // enable/disable the sidebar in the normal/advanced positions
        'sections'    => $gallery_options,
    );
    /* 1e END Gallery Format*/

    /************************************************************************
    * 1- END POST FORMATS
    *************************************************************************/
     
    
    /************************************************************************
    * 1.1 Post Sidebar
    *************************************************************************/
    
    $boxSections = array();
    $boxSections[] = array(
        'icon_class' => 'icon-large',
        'icon' => 'el-icon-home',
        'fields' => array(
            array(

                'id'        => 'opts-blog-layout',
                'type'      => 'image_select',
                'title'     => esc_html__('Page Layout', 'ninezeroseven'),
                'options'   => array(
                        'no-sidebar'   => array('alt' => 'Full Width',     'img' => get_template_directory_uri() . '/includes/admin/configs/img/1col.png' ),
                        'sidebar-left' => array('alt' => 'Left Sidebar',   'img' => get_template_directory_uri() . '/includes/admin/configs/img/2cl.png' ),
                        'default'      => array('alt' => 'Right Sidebar',  'img' => get_template_directory_uri() . '/includes/admin/configs/img/2cr.png' ),
                        )
            ),
            array(
                'id'       => 'opts-single-page-sidebar',
                'title'    => esc_html__( 'Sidebar', 'ninezeroseven' ),
                'desc'     => esc_html__('You can create additional sidebars under Appearance > Widgets.','ninezeroseven'),
                'type'     => 'select',
                'data'     => 'sidebars',
                'required' => array('opts-blog-layout', '!=', 'no-sidebar')
            ),
            array(
                'id'       => 'opts-page-menu-override',
                'title'    => esc_html__( 'Main Menu', 'ninezeroseven' ),
                'desc'     => esc_html__('You can create additional menus under Appearance > Menus.','ninezeroseven'),
                'type'     => 'select',
                'data'     => 'menus',
            ),
            array(
                'id'       => 'opts-page-menu-footer-override',
                'title'    => esc_html__( 'Footer Menu', 'ninezeroseven' ),
                'desc'     => esc_html__('You can create additional menus under Appearance > Menus.','ninezeroseven'),
                'required'  => array(
                            array('opts-footer-disable', "=", 1),
                            array('opts-footer-copyright-disable', "=", 1),
                            ),
                'type'     => 'select',
                'data'     => 'menus',
            ),
            array(
                'id'       => 'opts-bread-crumb',
                'type'     => 'switch',
                'title'    => esc_html__('Show/Hide Breadcrumb', 'ninezeroseven'),
                'on'       => 'Enabled',
                'off'      => 'Disabled',

            ),array(
                'id'       => 'opts-parent-options',
                'type'     => 'select',
                'title'    => esc_html__('Inherit Options', 'ninezeroseven'),
                'desc'     => esc_html__('This option will inherit some options from the selected page(ie menus, logo/title)', 'ninezeroseven'),
                'data'     => 'pages',
                'args'     => array('meta_key' => 'opts-is-parent','meta_value' =>'1','posts_per_page' => -1), 
                'default'  => '',
            ),

        )
    );
  
    $metaboxes[] = array(
        'id'            => 'wbc-page-layout',
        'title'         => esc_html__('Page Options', 'ninezeroseven'),
        'post_types'    => array('post'),
        //'page_template' => array('page-test.php'),
        //'post_format'   => array('image'),
        'position'      => 'side', // normal, advanced, side
        'priority'      => 'core', // high, core, default, low
        'sections'      => $boxSections
    );

    /************************************************************************
    * 1.1 End Post Sidebar
    *************************************************************************/


    /************************************************************************
    * 2- Page Options
    *************************************************************************/
    
    $pageSections = array();
    $pageSections[] = array(
        'icon_class' => 'icon-large',
        'icon' => 'el-icon-home',
        'fields' => array(
            array(
                'id'       => 'opts-single-page-sidebar',
                'title'    => esc_html__( 'Sidebar', 'ninezeroseven' ),
                'desc'     => esc_html__('You can create additional sidebars under Appearance > Widgets.','ninezeroseven'),
                'type'     => 'select',
                'data'     => 'sidebars'
            ),

        )
    );

    $metaboxes[] = array(
        'id'            => 'wbc-page-sidebar-option',
        'title'         => esc_html__('Sidebar', 'ninezeroseven'),
        'post_types'    => array('page'),
        'page_template' => array('template-page-right.php','template-page-left.php'),
        //'post_format'   => array('image'),
        'position'      => 'side', // normal, advanced, side
        'priority'      => 'core', // high, core, default, low
        'sections'      => $pageSections,
    );


    $pageSections = array();
    $pageSections[] = array(
        'icon_class' => 'icon-large',
        'icon' => 'el-icon-home',
        'fields' => array(
            array(
                'id'        => 'opts-page-menu-position',
                'type'      => 'select',
                'title'     => esc_html__('Menu Position', 'ninezeroseven'),
                'desc'     => esc_html__('Select where you\'d like the menu bar','ninezeroseven'),
                
                //Must provide key => value pairs for select options
                'options'   => array(
                    'top' => 'Top of Browser',
                    'bottom' => 'Bottom of Browser',
                    'after_num' => 'After X amount rows',
                    
                ),
                'default'   => ''
            ),
            array(
                'id'        => 'opts-page-menu-after',
                'type'      => 'select',
                'title'     => esc_html__('Show Menu After', 'ninezeroseven'),
                'desc'     => esc_html__('Select what row you want the menu displayed below.','ninezeroseven'),
                
                //Must provide key => value pairs for select options
                'options'   => array(
                    '1'  => 'First Row',
                    '2'  => 'Second Row',
                    '3'  => 'Third Row',
                    '4'  => 'Fourth Row',
                    '5'  => 'Fifth Row',
                    '6'  => 'Sixth Row',
                    '7'  => 'Seventh Row',
                    '8'  => 'Eighth Row',
                    '9'  => 'Nineth Row',
                    '10' => 'Tenth Row',
                    
                ),
                'default'   => '1',
                'required'  => array(
                            array('opts-page-menu-position', "=", 'after_num'),
                            ),
            ),

        )//HERE
    );

    $metaboxes[] = array(
        'id'            => 'wbc-page-menu-option',
        'title'         => esc_html__('Menu Position', 'ninezeroseven'),
        'post_types'    => array('page'),
        'page_template' => array('template-page-full.php'),
        //'post_format'   => array('image'),
        'position'      => 'side', // normal, advanced, side
        'priority'      => 'core', // high, core, default, low
        'sections'      => $pageSections,
    );

    $boxSections = array();
    $boxSections[] = array(
        'icon_class' => 'icon-large',
        'icon' => 'el-icon-home',
        'fields' => array(
            array(
                'id'       => 'opts-page-menu-override',
                'title'    => esc_html__( 'Main Menu', 'ninezeroseven' ),
                'desc'     => esc_html__('You can create additional menus under Appearance > Menus.','ninezeroseven'),
                'type'     => 'select',
                'data'     => 'menus',
            ),
            array(
                'id'       => 'opts-page-menu-footer-override',
                'title'    => esc_html__( 'Footer Menu', 'ninezeroseven' ),
                'desc'     => esc_html__('You can create additional menus under Appearance > Menus.','ninezeroseven'),
                'required'  => array(
                            array('opts-footer-disable', "=", 1),
                            array('opts-footer-copyright-disable', "=", 1),
                            ),
                'type'     => 'select',
                'data'     => 'menus',
            ),
            array(
                'id'       => 'opts-bread-crumb',
                'type'     => 'switch',
                'title'    => esc_html__('Show/Hide Breadcrumb', 'ninezeroseven'),
                'on'       => 'Enabled',
                'off'      => 'Disabled',

            ),
            array(
                'id'       => 'opts-is-parent',
                'type'     => 'switch',
                'title'    => esc_html__('Is Parent', 'ninezeroseven'),
                'desc'     => esc_html__('Will set it as a parent/main page for other posts to inherit from.','ninezeroseven'),
                'on'       => 'Enabled',
                'off'      => 'Disabled',
                'default'  => ''

            ),

        )
    );
  
    $metaboxes[] = array(
        'id'            => 'wbc-page-options',
        'title'         => esc_html__('Page Options', 'ninezeroseven'),
        'post_types'    => array('page'),
        //'page_template' => array('page-test.php'),
        //'post_format'   => array('image'),
        'position'      => 'side', // normal, advanced, side
        'priority'      => 'core', // high, core, default, low
        'sections'      => $boxSections
    );


    /************************************************************************
    * 2- END Page Options
    *************************************************************************/
    

    /************************************************************************
    * 3- Portfolio Options
    *************************************************************************/

    $portfolioBoxes = array();
    $portfolioBoxes[] = array(
        'icon_class'    => 'icon-large',
        'icon'          => 'el-icon-home',
        'fields'        => array(
            array(
                'id'        => 'opts-portfolio-type',
                'type'      => 'button_set',
                'title'     => esc_html__('Portfolio Type', 'ninezeroseven'),
                'subtitle'  => esc_html__('You can chose the content type here', 'ninezeroseven'),
                'desc'      => esc_html__('If left on "Image" it will use the "Featured Image".', 'ninezeroseven'),
                
                //Must provide key => value pairs for radio options
                'options'   => array(
                    'image' => 'Image', 
                    'video'   => 'Video', 
                    'gallery' => 'Gallery'
                ), 
                'default'   => 'image'
            ),
            array(
                'id'       => 'wbc-portfolio-video-embed',
                'type'     => 'textarea',
                'title'    => esc_html__('Video Embed Code', 'ninezeroseven'),
                'subtitle' => esc_html__('Enter embed code below', 'ninezeroseven'),
                'validate' => 'html_custom',
                'required' => array('opts-portfolio-type', '=', 'video'),
                'default'  => ''
            ),
            array(
                'id'        => 'wbc-portfolio-gallery-format',
                'type'      => 'gallery',
                'title'     => esc_html__('Gallery Images', 'ninezeroseven'),
                'subtitle'  => esc_html__('You can add images here for slider/gallery.', 'ninezeroseven'),
                'required' => array('opts-portfolio-type', '=', 'gallery')
            ),
            // array(
            //     'id'        => 'wbc-image-format',
            //     'type'      => 'media',
            //     'title'     => esc_html__('Image (Optional)', 'ninezeroseven'),
            //     'desc'      => esc_html__('This is optional, you can just use the "Featured Image".', 'ninezeroseven'),
            //     'subtitle'  => esc_html__('If you upload image to here it will be used instead of featured image.', 'ninezeroseven'),
            //     'required' => array('opts-portfolio-type', '=', 'image'),
            // ),
            array(
                'id'        => 'opts-portfolio-image-size',
                'type'      => 'button_set',
                'title'     => esc_html__('Image Size', 'ninezeroseven'),
                'subtitle'  => esc_html__('This will be used for masonry galleries.', 'ninezeroseven'),
                'desc'      => esc_html__('Make sure to set the "Featured Image"', 'ninezeroseven'),
                
                //Must provide key => value pairs for radio options
                'options'   => array(
                    'square'     => esc_html__( 'Square', 'ninezeroseven'),
                    'landscape'  => esc_html__( '2x Width', 'ninezeroseven'),
                    'portrait'   => esc_html__( '2x Height', 'ninezeroseven'), 
                    'dbl-square' => esc_html__( '2x Width & Height' , 'ninezeroseven'),
                ), 
                'default'   => 'square'
            ),
    
        ),
    );

    $metaboxes[] = array(
        'id'          => 'portfolio-options',
        'title'       => esc_html__( 'Portfolio Options', 'ninezeroseven' ),
        'post_types'  => array('wbc-portfolio'),
        'position'    => 'normal', // normal, advanced, side
        'priority'    => 'high', // high, core, default, low
        'sidebar'     => false, // enable/disable the sidebar in the normal/advanced positions
        'sections'    => $portfolioBoxes,
    );

    // 3.1 Portfolio Sidebar
    $boxSections = array();
    $boxSections[] = array(
        'icon_class' => 'icon-large',
        'icon' => 'el-icon-home',
        'fields' => array(
            array(

                'id'        => 'opts-portfolio-layout',
                'type'      => 'image_select',
                'title'     => esc_html__('Page Layout', 'ninezeroseven'),
                'options'   => array(
                        'full-width'   => array('alt' => 'Full Screen Width',     'img' => get_template_directory_uri() . '/includes/admin/configs/img/full-width.png'),
                        'no-sidebar'   => array('alt' => 'Full Width',     'img' => get_template_directory_uri() . '/includes/admin/configs/img/1col.png' ),
                        'sidebar-left' => array('alt' => 'Left Sidebar',   'img' => get_template_directory_uri() . '/includes/admin/configs/img/2cl.png' ),
                        'default'      => array('alt' => 'Right Sidebar',  'img' => get_template_directory_uri() . '/includes/admin/configs/img/2cr.png' ),
                        )
            ),
            array(
                'id'       => 'opts-single-portfolio-sidebar',
                'title'    => esc_html__( 'Sidebar', 'ninezeroseven' ),
                'desc'     => esc_html__('You can create additional sidebars under Appearance > Widgets.','ninezeroseven'),
                'type'     => 'select',
                'data'     => 'sidebars',
                'required' => array('opts-portfolio-layout', '=', array('sidebar-left','default'))
            ),
            array(
                'id'        => 'opts-portfolio-menu-position',
                'type'      => 'select',
                'title'     => esc_html__('Menu Position', 'ninezeroseven'),
                'desc'     => esc_html__('Select where you\'d like the menu bar','ninezeroseven'),
                'required' => array('opts-portfolio-layout', '=', array('full-width')),
                
                //Must provide key => value pairs for select options
                'options'   => array(
                    'top'       => 'Top of Browser',
                    'bottom'    => 'Bottom of Browser',
                    'after_num' => 'After X amount rows',
                    
                ),
                'default'   => ''
            ),
            array(
                'id'        => 'opts-portfolio-menu-after',
                'type'      => 'select',
                'title'     => esc_html__('Show Menu After', 'ninezeroseven'),
                'desc'     => esc_html__('Select what row you want the menu displayed below.','ninezeroseven'),
                
                //Must provide key => value pairs for select options
                'options'   => array(
                    '1'  => 'First Row',
                    '2'  => 'Second Row',
                    '3'  => 'Third Row',
                    '4'  => 'Fourth Row',
                    '5'  => 'Fifth Row',
                    '6'  => 'Sixth Row',
                    '7'  => 'Seventh Row',
                    '8'  => 'Eighth Row',
                    '9'  => 'Nineth Row',
                    '10' => 'Tenth Row',
                    
                ),
                'default'   => '1',
                'required'  => array(
                            array('opts-portfolio-menu-position', "=", 'after_num'),
                            ),
            ),
            array(
                'id'       => 'opts-page-menu-override',
                'title'    => esc_html__( 'Main Menu', 'ninezeroseven' ),
                'desc'     => esc_html__('You can create additional menus under Appearance > Menus.','ninezeroseven'),
                'type'     => 'select',
                'data'     => 'menus',
            ),
            array(
                'id'       => 'opts-page-menu-footer-override',
                'title'    => esc_html__( 'Footer Menu', 'ninezeroseven' ),
                'desc'     => esc_html__('You can create additional menus under Appearance > Menus.','ninezeroseven'),
                'required'  => array(
                            array('opts-footer-disable', "=", 1),
                            array('opts-footer-copyright-disable', "=", 1),
                            ),
                'type'     => 'select',
                'data'     => 'menus',
            ),
             array(
                'id'       => 'opts-parent-options',
                'type'     => 'select',
                'title'    => esc_html__('Inherit Options', 'ninezeroseven'),
                'desc'     => esc_html__('This option will inherit some options from the selected page(ie menus, logo/title)', 'ninezeroseven'),
                'data'     => 'pages',
                'args'     => array('meta_key' => 'opts-is-parent','meta_value' =>'1','posts_per_page' => -1), 
                'default'  => '',
            ),
            array(
                'id'       => 'opts-bread-crumb',
                'type'     => 'switch',
                'title'    => esc_html__('Show/Hide Breadcrumb', 'ninezeroseven'),
                'on'       => 'Enabled',
                'off'      => 'Disabled',

            ),

        )
    );
  
    $metaboxes[] = array(
        'id'            => 'wbc-portfolio-options',
        'title'         => esc_html__('Page Options', 'ninezeroseven'),
        'post_types'    => array('wbc-portfolio'),
        //'page_template' => array('page-test.php'),
        //'post_format'   => array('image'),
        'position'      => 'side', // normal, advanced, side
        'priority'      => 'core', // high, core, default, low
        'sections'      => $boxSections
    );
    // 3.1 END Portfolio Sidebar

    /************************************************************************
    * 3- Reuseables
    *************************************************************************/
    // 3.1 Portfolio Sidebar
    $boxSections = array();
    $boxSections[] = array(
        'icon_class' => 'icon-large',
        'icon' => 'el-icon-home',
        'fields' => array(
            array(
                'id'       => 'opts-reuseable-switch',
                'type'     => 'switch',
                'title'    => esc_html__('Reuseables', 'ninezeroseven'),
                'on'       => 'Enabled',
                'off'      => 'Disabled',
                'default'   => 1,

            ),
            array(
                'id'       => 'opts-reuseable-before-switch',
                'type'     => 'switch',
                'title'    => esc_html__('Reuseable Befores', 'ninezeroseven'),
                'required'  => array(
                            array('opts-reuseable-switch', "=", 1)
                            ),
                'on'       => 'Enabled',
                'off'      => 'Disabled',
                'default'   => 1,

            ),
            array(
                'id'       => 'opts-single-reuse-before',
                'multi'    => true,
                'title'    => esc_html__( 'Before', 'ninezeroseven' ),
                'required'  => array(
                            array('opts-reuseable-switch', "=", 1),
                            array('opts-reuseable-before-switch', "=", 1),
                            ),
                'desc'     => esc_html__('Sets sections to displayed at top of page','ninezeroseven'),
                'args'     => array('post_type' => array('wbc-reuseables'),'posts_per_page' => -1),
                'type'     => 'select',
                'sortable' => true,
                'data'     => 'posts',
            ),
            array(
                'id'       => 'opts-reuseable-after-switch',
                'type'     => 'switch',
                'title'    => esc_html__('Reuseables Afters', 'ninezeroseven'),
                'required'  => array(
                            array('opts-reuseable-switch', "=", 1)
                            ),
                'on'       => 'Enabled',
                'off'      => 'Disabled',
                'default'   => 1,

            ),
            array(
                'id'       => 'opts-single-reuse-after',
                'multi'    => true,
                'title'    => esc_html__( 'After', 'ninezeroseven' ),
                'desc'     => esc_html__('Sets sections to displayed at bottom of page','ninezeroseven'),
                'required'  => array(
                            array('opts-reuseable-switch', "=", 1),
                            array('opts-reuseable-after-switch', "=", 1),
                            ),
                'args'     => array('post_type' => array('wbc-reuseables'),'posts_per_page' => -1),
                'type'     => 'select',
                'sortable' => true,
                'data'     => 'posts',
            ),

        )
    );
  
    $metaboxes[] = array(
        'id'            => 'wbc-reuseable-options',
        'title'         => esc_html__('Reuseables', 'ninezeroseven'),
        'post_types'    => apply_filters('wbc_reuseable_support', array('wbc-portfolio','page','post')),
        //'page_template' => array('page-test.php'),
        //'post_format'   => array('image'),
        'position'      => 'side', // normal, advanced, side
        'priority'      => 'low', // high, core, default, low
        'sections'      => $boxSections
    );





    /************************************************************************
    * 4- Page, Post, wbc_portfolio Options
    *************************************************************************/


    // Extended Options
    $boxSections = array();


    // 4.1 Header Options
    $boxSections[] = array(
        'title' => esc_html__('General', 'ninezeroseven'),
        'icon_class' => 'icon-large',
        'icon' => 'fa fa-cog',
        'fields' => array(
            ///BOXED
                    array(
                        'id'        => 'opts-boxed-layout',
                        'type'      => 'switch',
                        'title'     => esc_html__('Boxed Layout', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Enables boxed layout', 'ninezeroseven'),
                        'on'        => esc_html__('Enable', 'ninezeroseven'),
                        'off'       => esc_html__('Disable', 'ninezeroseven'),
                        // 'hint' => array(
                        //     'title' => 'Hint Title',
                        //     'content' => 'This is a <b>hint</b> for the media field with a Title.',
                        // )
                    ),
                    array(
                        'id'       => 'opts-boxed-bg',
                        'type'     => 'background',
                        'title'    => esc_html__('Body Background', 'ninezeroseven'),
                        'output'    => array('body'),
                        'required'  => array('opts-boxed-layout', "=", 1),
                        'subtitle' => esc_html__('Body background with image, color, etc.', 'ninezeroseven'),
                    ),
                    array(
                        'id'        => 'opts-boxed-width',
                        'type'      => 'slider',
                        'required'  => array('opts-boxed-layout', "=", 1),
                        'title'     => esc_html__('Boxed Width', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Changes width of boxed area, default is 1240px', 'ninezeroseven'),
                        "min"       => 500,
                        "step"      => 1,
                        "max"       => 2000,
                        'display_value' => 'text'
                    ),
                    array(
                        'id'        => 'opts-page-font-color-override',
                        'type'      => 'color',
                        'title'     => esc_html__('Font Color', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Change the body font color', 'ninezeroseven'),
                        'transparent' => false,
                        'default'   => '',
                        'output'    => array(
                                'color' => 'body'
                            )
                    ),
                  array(
                        'id'        => 'opts-primary-color-override',
                        'type'      => 'color',
                        'title'     => esc_html__('Primary Color', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Change the main colors(links,buttons,etc)', 'ninezeroseven'),
                        'transparent' => false,
                        'default'   => '',
                        'output'    => apply_filters( 'opts-primary-color', array() )
                    ),
                    array(
                        'id'        => 'opts-page-bg-color-override',
                        'type'      => 'color',
                        'title'     => esc_html__('Page BG Color', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Change the page background color', 'ninezeroseven'),
                        'transparent' => false,
                        'default'   => '',
                        'output'    => array(
                                'background-color' => '.page-wrapper'
                            )
                    ),
                    array(
                        'id'        => 'opts-page-content-color-override',
                        'type'      => 'color',
                        'title'     => esc_html__('Page Content Color', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Change the primary color.(boxes,borders,etc)', 'ninezeroseven'),
                        'transparent' => false,
                        'default'   => '',
                        'output'    => apply_filters('opts-page-content-color', array())
                    ),
                    array(
                        'id'        => 'opts-page-forms-color-override',
                        'type'      => 'color',
                        'title'     => esc_html__('Form Field BG color', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Change Form Field background color.(textarea,inputs,etc)', 'ninezeroseven'),
                        'transparent' => false,
                        'default'   => '',
                        'output'    => array(
                                'background-color' => 'input[type="text"], input[type="password"], input[type="email"], input[type="search"], select,textarea',
                            )
                    ),


            ));


    // 4.2 Header Options
    $boxSections[] = array(
        'title' => esc_html__('Header', 'ninezeroseven'),
        'icon_class' => 'icon-large',
        'icon' => 'fa fa-sliders',
        'fields' => array(
            array(
                'id'        => 'opts-show-bread-options',
                'type'      => 'switch',
                'title'     => esc_html__('Page Title Options', 'ninezeroseven'),
                'required'  => array('opts-bread-crumb', "=", 1),
                'subtitle'  => esc_html__('You can choose to show/hide the options for this.', 'ninezeroseven'),
                'default'   => 0,
                'on'        => 'Show',
                'off'       => 'Hide',

            ),
            array(
                'id'        => 'opts-breadcrumb-override-background',
                'type'      => 'background',
                'required'  => array(
                                    array('opts-bread-crumb', "=", 1),
                                    array('opts-show-bread-options', "=", 1)
                                ),
                'output'    => array('.page-title-wrap'),
                'transparent' => false,
                'title'     => esc_html__('Bread Crumb Background', 'ninezeroseven'),
                'subtitle'  => esc_html__('You can set background here for breadcrumb area.', 'ninezeroseven'),
                'default'   => array(
                    'background-color'      => '',
                    'background-repeat'     => '',
                    'background-attachment' => '',
                    'background-position'   => '',
                    'background-image'      => '',
                    'background-clip'       => '',
                    'background-origin'     => '',
                    'background-size'       => '',
                    )
                ,
            ),
            array(
                'id'             => 'opts-breadcrumb-title-font-override',
                'type'           => 'typography',
                'title'          => esc_html__('Page Title Font', 'ninezeroseven'),
                'subtitle'       => esc_html__('Changes the font for the page title within the breadcrumb bar', 'ninezeroseven'),
                'google'         => true,
                'required'  => array(
                        array('opts-bread-crumb', "=", 1),
                        array('opts-show-bread-options', "=", 1)
                    ),
                'text-align'     => false,
                'letter-spacing' => true,
                'font-backup'    => true,
                'default'        => array(
                    'font-size'     => '',
                    'font-family'   => '',
                    'font-weight'   => ''
                ),
                'output'         => array('.page-title-wrap .entry-title')
        
            ),
            array(
                'id'        => 'opts-breadcrumb-override-color',
                'type'      => 'color',
                'title'     => esc_html__('Bread Crumb Font Color', 'ninezeroseven'),
                'subtitle'  => esc_html__('Change the breadcrumb color.', 'ninezeroseven'),
                'required'  => array(
                                    array('opts-bread-crumb', "=", 1),
                                    array('opts-show-bread-options', "=", 1)
                                ),
                'transparent' => false,
                'default'   => '',
                'output'    => array(
                        'color' => '.page-title-wrap,.page-title-wrap .entry-title'
                    )
            )
            ,
            array(
                'id'          => 'opts-breadcrumb-override-link-color',
                'type'        => 'color',
                'title'       => esc_html__('Bread Crumb Link Color', 'ninezeroseven'),
                'subtitle'    => esc_html__('Change the breadcrumb link color.', 'ninezeroseven'),
                'required'    => array(
                                    array('opts-bread-crumb', "=", 1),
                                    array('opts-show-bread-options', "=", 1)
                                ),
                'transparent' => false,
                'default'     => '',
                'output'      => array(
                                'color' => '.page-title-wrap a'
                                )
            )
            ,
            array(
                'id'          => 'opts-breadcrumb-override-hover-color',
                'type'        => 'color',
                'title'       => esc_html__('Bread Crumb Hover Link Color', 'ninezeroseven'),
                'subtitle'    => esc_html__('Change the breadcrumb hover color.', 'ninezeroseven'),
                'required'    => array(
                                    array('opts-bread-crumb', "=", 1),
                                    array('opts-show-bread-options', "=", 1)
                                ),
                'transparent' => false,
                'default'     => '',
                'output'      => array(
                        'color' => '.page-title-wrap a:hover'
                    )
            ),
            array(
                'id'             => 'opts-override-spacing',
                'type'           => 'spacing',
                'output'         => array('.page-title-wrap'),
                'required'       => array(
                                        array('opts-bread-crumb', "=", 1),
                                        array('opts-show-bread-options', "=", 1)
                                    ),
                'units'          => 'px',
                'left'           => false,
                'right'          => false,
                'units_extended' => false,
                'title'          => esc_html__('Bread Crumb Padding', 'ninezeroseven'),
                'subtitle'       => esc_html__('Set breadcrumb padding top/bottom :)', 'ninezeroseven'),
                'desc'           => esc_html__('Please enter a pixel value without the \'px\'', 'ninezeroseven'),
            ),
            array(
                'id'        => 'opts-main-logo-override',
                'type'      => 'checkbox',
                'title'     => esc_html__('Override Nav logo/text', 'ninezeroseven'),
                'subtitle'  => esc_html__('If you\'d like to override default logo/text', 'ninezeroseven'),
                'default'   => 0 // 1 = on | 0 = off
            ),
            array(
                'id'        => 'logo-enabled-override',
                'type'      => 'switch',
                'title'     => esc_html__('Logo Type', 'ninezeroseven'),
                'required'  => array('opts-main-logo-override', "=", 1),
                'subtitle'  => esc_html__('Select logo type you\'d like in nav bar', 'ninezeroseven'),
                'default'   => 0,
                'on'        => 'Image',
                'off'       => 'Text',

            ),
            array(
                'id'        => 'opts-nav-text-override',
                'type'      => 'text',
                'title'     => esc_html__('Site Name', 'ninezeroseven'),
                'subtitle'  => esc_html__('If you\'d like your site name different in nav bar then what you\'ve set on settings page.', 'ninezeroseven'),
                'validate'  => 'no_html',
                'required'  => array(
                                array('opts-main-logo-override', "=", 1),
                                array('logo-enabled-override', "=", 0),
                            ),
                'default'   => get_bloginfo( 'name' )
            ),
            array(
                'id'        => 'opts-nav-logo-override',
                'type'      => 'media',
                'title'     => esc_html__('Site Navbar Logo', 'ninezeroseven'),
                'mode'      => 'image', // Can be set to false to allow any media type, or can also be set to any mime type.
                'subtitle'  => esc_html__('Upload logo', 'ninezeroseven'),
                'required'  => array(
                                array('opts-main-logo-override', "=", 1),
                                array('logo-enabled-override', "=", 1),
                            ),
                'default' => '',
            ),
            array(
                'id'        => 'opts-nav-transparent-logo-override',
                'type'      => 'media',
                'title'     => esc_html__('Transparent Logo', 'ninezeroseven'),
                'mode'      => 'image', // Can be set to false to allow any media type, or can also be set to any mime type.
                'subtitle'  => esc_html__('Upload logo', 'ninezeroseven'),
                'required'  => array(
                                array('opts-main-logo-override', "=", 1),
                                array('logo-enabled-override', "=", 1),
                            ),
                'default' => '',
            ),
            array(
                'id'                => 'opts-menu-height-override',
                'type'              => 'dimensions',
                'width' => false,
                'title'             => esc_html__('Menu Bar Height', 'ninezeroseven'),
                'subtitle'          => esc_html__('If you\'d like to change the height of the menu bar, enter value here', 'ninezeroseven'),
                'required'  => array('opts-main-logo-override', "=", 1),

            ),
            //menu
            array(
                'id'        => 'opts-sticky-menu',
                'type'      => 'switch',
                'title'     => esc_html__('Sticky Menu', 'ninezeroseven'),
                'subtitle'  => esc_html__('Here you can choose to enable/disable the sticky menu(menu follows on scroll)', 'ninezeroseven'),
                'on'        => 'Enabled',
                'off'       => 'Disabled',

            ),array(
                'id'       => 'opts-elastic-menu',
                'type'     => 'switch',
                'title'    => esc_html__('Elastic Menu', 'ninezeroseven'),
                'subtitle' => esc_html__('Here you can choose to enable/disable the shrinking menu feature.', 'ninezeroseven'),
                'required' => array('opts-sticky-menu', "=", 1),
                'on'       => 'Enabled',
                'off'      => 'Disabled',

            ),
            array(
                'id'                => 'opts-elastic-height-override',
                'type'              => 'dimensions',
                // 'units'             => 'px',    // You can specify a unit value. Possible: px, em, %
                'width' => false,
                'title'             => esc_html__('Menu Bar Shrink To', 'ninezeroseven'),
                'subtitle'          => esc_html__('If you\'d like to change the small menu height, do so here', 'ninezeroseven'),
                'required' => array(
                                array('opts-main-logo-override', "=", 1),
                                array('opts-elastic-menu', "=", 1),
                            ),

            ),

            /************************************************************************
            * TOP Bar
            *************************************************************************/
            array(
                'id'        => 'opts-topbar',
                'type'      => 'switch',
                'title'     => esc_html__('Show/Hide Topbar', 'ninezeroseven'),
                'subtitle'  => esc_html__('You can choose to show/hide the top bar here.', 'ninezeroseven'),
                'on'        => 'Enabled',
                'off'       => 'Disabled',

            ),

            //group
            array(
                'id'        => 'opts-content-topbar-override',
                'type'      => 'checkbox',
                'title'     => esc_html__('Override Topbar Content', 'ninezeroseven'),
                'subtitle'  => esc_html__('Check this if you\'d like to override topbar content', 'ninezeroseven'),
                'required'  => array('opts-topbar', "=", 1),
                'default'   => '0'// 1 = on | 0 = off
            ),
            //Left Group
            array(
                'id'           => 'opts-topbar-left-override',
                'type'         => 'repeater',
                'title'        => 'Left Topbar Items',
                'subtitle'     => 'Select a social icon to append a link to.',
                'group_values' => true,
                'item_name' => 'Item',
                'required'  => array('opts-content-topbar-override', "=", 1),
                'fields'    => array(
                    array(
                        'id'       => 'field-icon',
                        'type'     => 'select',
                        'select2'  => array( 'containerCssClass' => ' el' ),
                        'title'    => esc_html__('Icon', 'ninezeroseven'),
                        'subtitle' => esc_html__('Select a icon to appear before.', 'ninezeroseven'),
                        'class'    => ' font-icons ef',
                        'options'  => $iconArray
                    ),
                    array(
                        'id'          => 'field-info',
                        'type'        => 'text',
                        'class'       => ' large-text',
                        'title'       => esc_html__('Text','ninezeroseven'),
                        'subtitle'    => esc_html__('Text you would like displayed.','ninezeroseven'),
                        'default'     => '',
                    )
                )
            ),
            //Right Group
            array(
                'id'           => 'opts-topbar-right-override',
                'type'         => 'repeater',
                'title'        => esc_html__('Right Topbar Social', 'ninezeroseven'),
                'subtitle'     => esc_html__('Select a social icon to append a link to.', 'ninezeroseven'),
                'group_values' => true,
                'item_name' => 'Social Icons',
                'required'  => array('opts-content-topbar-override', "=", 1),
                'fields'    => array(
                    array(
                        'id'       => 'field-icon',
                        'type'     => 'select',
                        'select2'  => array( 'containerCssClass' => ' el' ),
                        'title'    => esc_html__('Social Icon', 'ninezeroseven'),
                        'subtitle' => esc_html__('Select a social icon to append a link to.', 'ninezeroseven'),
                        'class'    => ' font-icons ef',
                        'options'  => $iconArray
                    ),
                    array(
                        'id'        => 'field-info',
                        'type'      => 'text',
                        'title'     => esc_html__('Link URL', 'ninezeroseven'),
                        'subtitle'  => esc_html__('This must be a valid URL i.e http://www.twitter.com/username', 'ninezeroseven'),
                        'desc'      => esc_html__('This will make the icon linked.', 'ninezeroseven'),
                        'validate'  => 'url',
                        'default'   => '',
                    )
                )
            ),
            //Coloring
            array(
                'id'        => 'opts-enable-topmenu-color-override',
                'type'      => 'checkbox',
                'title'     => esc_html__('Top Bar Coloring', 'ninezeroseven'),
                'subtitle'  => esc_html__('Check to enable color fields for top bar.', 'ninezeroseven'),
                'required'  => array('opts-topbar', "=", 1),
                'default'   => '0'// 1 = on | 0 = off
            ),
            array(
                'id'        => 'opts-topmenu-link-color-border-override',
                'type'      => 'color',
                'title'     => esc_html__('Top Bar Background Color', 'ninezeroseven'),
                'subtitle'  => esc_html__('Change the background color.', 'ninezeroseven'),
                'required'  => array('opts-enable-topmenu-color-override', "=", 1),
                'transparent' => false,
                'default'   => '',
                'output'    => array(
                        'background-color' => '.top-extra-bar',
                        'border-color' => '.top-extra-bar'
                    )
            ),
            array(
                'id'          => 'opts-topmenu-color-override',
                'type'        => 'color',
                'title'       => esc_html__('Top Bar Text Color', 'ninezeroseven'),
                'subtitle'    => esc_html__('Change the text color.', 'ninezeroseven'),
                'required'    => array('opts-enable-topmenu-color-override', "=", 1),
                'transparent' => false,
                'default'     => '',
                'output'      => array(
                        'color' => '.top-extra-bar'
                    )
            ),
            array(
                'id'        => 'opts-topmenu-link-color-override',
                'type'      => 'color',
                'title'     => esc_html__('Top Bar Link Color', 'ninezeroseven'),
                'subtitle'  => esc_html__('Change the link color.', 'ninezeroseven'),
                'required'  => array('opts-enable-topmenu-color-override', "=", 1),
                'transparent' => false,
                'default'   => '',
                'output'    => array(
                        'color' => '.top-extra-bar a,.header-bar .social-links a'
                    )
            ),
            array(
                'id'        => 'opts-topmenu-link-color-hover-override',
                'type'      => 'color',
                'title'     => esc_html__('Top Bar Link Hover Color', 'ninezeroseven'),
                'subtitle'  => esc_html__('Change the link hover color.', 'ninezeroseven'),
                'required'  => array('opts-enable-topmenu-color-override', "=", 1),
                'transparent' => false,
                'default'   => '',
                'output'    => array(
                        'color' => '.top-extra-bar a:hover,.header-bar .social-links a:hover'
                    )
            ),
            /************************************************************************
            * Main Nav Colors
            *************************************************************************/
            array(
                'id'        => 'opts-enable-menu-color-override',
                'type'      => 'checkbox',
                'title'     => esc_html__('Nav Bar Coloring', 'ninezeroseven'),
                'subtitle'  => esc_html__('Check to hide/show options for menu bar', 'ninezeroseven'),
                'default'   => '0'// 1 = on | 0 = off
            ),
            array(
                'id'        => 'opts-nav-background-override',
                'type'      => 'color',
                 // 'output'    => array('.header-bar'),
                'title'     => esc_html__('Main Nav Background Color', 'ninezeroseven'),
                'subtitle'  => esc_html__('Change the main navigation background color.', 'ninezeroseven'),
                'required'  => array('opts-enable-menu-color-override', "=", 1),
                'transparent' => false,
                'default'   => '',
                'output'    => array(
                        'background-color' => '.menu-bar-wrapper,.menu-bar-wrapper.is-sticky'
                    )
            ),
            array(
                'id'        => 'opts-nav-link-color-override',
                'type'      => 'color',
                'output'    => array('.header-inner'),
                'title'     => esc_html__('Main Nav Link Color', 'ninezeroseven'),
                'subtitle'  => esc_html__('Change the main navigation link color.', 'ninezeroseven'),
                'required'  => array('opts-enable-menu-color-override', "=", 1),
                'transparent' => false,
                'default'   => '',
                'output'    => array(
                        'color' => '.header-inner a','.wbc_menu > li > a,.mobile-menu .primary-menu .wbc_menu a'
                    )
            ),
            array(
                'id'        => 'opts-nav-link-color-hover-override',
                'type'      => 'color',
                'output'    => array('.header-inner'),
                'title'     => esc_html__('Main Nav Hover Color', 'ninezeroseven'),
                'subtitle'  => esc_html__('Change the main navigation hover color.', 'ninezeroseven'),
                'required'  => array('opts-enable-menu-color-override', "=", 1),
                'transparent' => false,
                'default'   => '',
                'output'    => array(
                        'color' => '.header-inner a:hover','.wbc_menu > li > a:hover,.mobile-menu .primary-menu .wbc_menu a:hover'
                    )
            ),
            array(
                'id'        => 'opts-nav-link-color-active-override',
                'type'      => 'color',
                'output'    => array('.header-bar'),
                'title'     => esc_html__('Main Nav Active Color', 'ninezeroseven'),
                'subtitle'  => esc_html__('Change the main navigation active color.', 'ninezeroseven'),
                'required'  => array('opts-enable-menu-color-override', "=", 1),
                'transparent' => false,
                'default'   => '',
                'output'    => array(
                        'color' => '.wbc_menu li.active > a,.mobile-menu .primary-menu .wbc_menu li.active a'
                    )
            ),

            /************************************************************************
            * Sub Nav Colors
            *************************************************************************/
            array(
                'id'        => 'opts-subnav-background-override',
                'type'      => 'color',
                'title'     => esc_html__('Sub Nav Background Color', 'ninezeroseven'),
                'subtitle'  => esc_html__('Change the sub navigation background color.', 'ninezeroseven'),
                'required'  => array('opts-enable-menu-color-override', "=", 1),
                'transparent' => false,
                'default'   => '',
                'output'    => array(
                        'background-color' => '.wbc_menu li > ul, .primary-menu.mobile-show, .primary-menu.mobile-show a'
                    )
            ),
            array(
                'id'        => 'opts-subnav-link-color-border-override',
                'type'      => 'color',
                'title'     => esc_html__('Sub Nav border Color', 'ninezeroseven'),
                'subtitle'  => esc_html__('Change the sub navigation border color.', 'ninezeroseven'),
                'required'  => array('opts-enable-menu-color-override', "=", 1),
                'transparent' => false,
                'default'   => '',
                'output'    => array(
                        'border-color' => '.wbc_menu ul li a, .mobile-show .wbc_menu li a,.mobile-show ul li:last-child > a'
                    )
            ),
            array(
                'id'        => 'opts-subnav-link-color-override',
                'type'      => 'color',
                'title'     => esc_html__('Sub Nav Link Color', 'ninezeroseven'),
                'subtitle'  => esc_html__('Change the sub navigation link color.', 'ninezeroseven'),
                'required'  => array('opts-enable-menu-color-override', "=", 1),
                'transparent' => false,
                'default'   => '',
                'output'    => array(
                        'color' => '.wbc_menu ul li a'
                    )
            ),
            array(
                'id'        => 'opts-subnav-link-color-hover-override',
                'type'      => 'color',
                'title'     => esc_html__('Sub Nav Hover Color', 'ninezeroseven'),
                'subtitle'  => esc_html__('Change the sub navigation hover color.', 'ninezeroseven'),
                'required'  => array('opts-enable-menu-color-override', "=", 1),
                'transparent' => false,
                'default'   => '',
                'output'    => array(
                        'color' => '.wbc_menu ul li a:hover'
                    )
            ),
            /************************************************************************
            * transpartent Nav Colors
            *************************************************************************/
            array(
                'id'        => 'opts-enable-transparent',
                'type'      => 'checkbox',
                'title'     => esc_html__('Enable Transparent Menu', 'ninezeroseven'),
                'subtitle'  => esc_html__('Only works when using full page/width template with menu set to top or bottom of browser', 'ninezeroseven'),
                'default'   => '0'// 1 = on | 0 = off
            ),
            array(
                'id'        => 'opts-transparent-links',
                'type'      => 'color',
                 // 'output'    => array('.header-bar'),
                'title'     => esc_html__('Link Color', 'ninezeroseven'),
                'subtitle'  => esc_html__('Changes the link color', 'ninezeroseven'),
                'required'  => array('opts-enable-transparent', "=", 1),
                'transparent' => false,
                'default'   => '',
                'output'    => array(
                        'color' => '.has-transparent-menu .menu-bar-wrapper:not(.is-sticky),.has-transparent-menu .menu-bar-wrapper:not(.is-sticky) .menu-icon,.has-transparent-menu .menu-bar-wrapper:not(.is-sticky) .wbc_menu > li > a'
                    )
            ),
            array(
                'id'        => 'opts-transparent-link-hovers',
                'type'      => 'color',
                'title'     => esc_html__('Hover Link Color', 'ninezeroseven'),
                'subtitle'  => esc_html__('Changes the link hover color', 'ninezeroseven'),
                'required'  => array('opts-enable-transparent', "=", 1),
                'transparent' => false,
                'default'   => '',
                'output'    => array(
                        'color' => '.has-transparent-menu .menu-bar-wrapper:not(.is-sticky) .menu-icon:hover,.has-transparent-menu .menu-bar-wrapper:not(.is-sticky) .menu-icon.menu-open,.has-transparent-menu .menu-bar-wrapper:not(.is-sticky) .wbc_menu > li > a:hover,.has-transparent-menu .menu-bar-wrapper:not(.is-sticky) .wbc_menu > li.active > a'
                    )
            ),
            array(
                'id'        => 'opts-transparent-heading-text',
                'type'      => 'color',
                'title'     => esc_html__('Logo/Title Color', 'ninezeroseven'),
                'subtitle'  => esc_html__('Changes color of site title.', 'ninezeroseven'),
                'required'  => array('opts-enable-transparent', "=", 1),
                'transparent' => false,
                'default'   => '',
                'output'    => array(
                        'color' => '.has-transparent-menu .menu-bar-wrapper:not(.is-sticky) .site-logo-title a'
                    )
            ),
            //END MAIN NAV COLOR
            


        )
    );
    // 4.2 END Header Options

    // 4.3 Footer Options
    $boxSections[] = array(
        'title' => esc_html__('Footer', 'ninezeroseven'),
        //'desc' => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'ninezeroseven'),
        'icon_class' => 'icon-large',
        'icon' => 'fa fa-th-large',
        'fields' => array(
            
            /************************************************************************
            * Footer Options
            *************************************************************************/
            array(
                'id'       => 'opts-footer-disable',
                'type'     => 'switch',
                'title'    => esc_html__('Show/Hide Footer', 'ninezeroseven'),
                'on'       => 'Enabled',
                'off'      => 'Disabled',
                // 'default'  => 1,

            ),
            array(
                'id'       => 'opts-footer-widget-area-disable',
                'type'     => 'switch',
                'required'  => array('opts-footer-disable', "=", 1),
                'title'    => esc_html__('Show/Hide Footer Widget Area', 'ninezeroseven'),
                'on'       => 'Enabled',
                'off'      => 'Disabled',
                // 'default'  => 1,

            ),
            array(
                'id'       => 'opts-footer-copyright-disable',
                'type'     => 'switch',
                'required'  => array('opts-footer-disable', "=", 1),
                'title'    => esc_html__('Show/Hide Footer Copyright area.', 'ninezeroseven'),
                'on'       => 'Enabled',
                'off'      => 'Disabled',
                // 'default'  => 1,

            ),
            array(
                'id'        => 'opts-enable-footer-color-override',
                'type'      => 'checkbox',
                'required'  => array(
                                array('opts-footer-disable', "=", 1),
                                array('opts-footer-widget-area-disable', "=", 1),
                                ),

                'title'     => esc_html__('Footer Coloring', 'ninezeroseven'),
                'subtitle'  => esc_html__('Check to enable color fields for footer.', 'ninezeroseven'),
                'default'   => '0' // 1 = on | 0 = off
            ),
            array(
                'id'        => 'opts-footer-background-color-override',
                'type'      => 'color',
                'title'     => esc_html__('Footer Background Color', 'ninezeroseven'),
                'subtitle'  => esc_html__('Change the background color.', 'ninezeroseven'),
                'required'  => array(
                                array('opts-footer-disable', "=", 1),
                                array('opts-footer-widget-area-disable', "=", 1),
                                array('opts-enable-footer-color-override', "=", 1),
                                ),
                'transparent' => false,
                'default'   => '',
                'output'    => array(
                        'background-color' => '.main-footer'
                    )
            ),
            array(
                'id'        => 'opts-footer-color-override',
                'type'      => 'color',
                'title'     => esc_html__('Footer Text Color', 'ninezeroseven'),
                'subtitle'  => esc_html__('Change the background color.', 'ninezeroseven'),
                'required'  => array(
                                array('opts-footer-disable', "=", 1),
                                array('opts-footer-widget-area-disable', "=", 1),
                                array('opts-enable-footer-color-override', "=", 1),
                                ),
                'transparent' => false,
                'default'   => '',
                'output'    => array(
                        'color' => '.main-footer'
                    )
            ),
            array(
                'id'        => 'opts-footer-heading-color-override',
                'type'      => 'color',
                'title'     => esc_html__('Footer Heading Color', 'ninezeroseven'),
                'subtitle'  => esc_html__('Change the background color.', 'ninezeroseven'),
                'required'  => array(
                                array('opts-footer-disable', "=", 1),
                                array('opts-footer-widget-area-disable', "=", 1),
                                array('opts-enable-footer-color-override', "=", 1),
                                ),
                'transparent' => false,
                'default'   => '',
                'output'    => array(
                        'color' => '.main-footer .widgets-area h4'
                    )
            ),
            array(
                'id'        => 'opts-footer-link-color-override',
                'type'      => 'color',
                'title'     => esc_html__('Footer Link Color', 'ninezeroseven'),
                'subtitle'  => esc_html__('Change the background color.', 'ninezeroseven'),
                'required'  => array(
                                array('opts-footer-disable', "=", 1),
                                array('opts-footer-widget-area-disable', "=", 1),
                                array('opts-enable-footer-color-override', "=", 1),
                                ),
                'transparent' => false,
                'default'   => '',
                'output'    => array(
                        'color' => '.main-footer a'
                    )
            ),
            array(
                'id'        => 'opts-footer-link-color-hover-override',
                'type'      => 'color',
                'title'     => esc_html__('Footer Hover Color', 'ninezeroseven'),
                'subtitle'  => esc_html__('Change the background color.', 'ninezeroseven'),
                'required'  => array(
                                array('opts-footer-disable', "=", 1),
                                array('opts-footer-widget-area-disable', "=", 1),
                                array('opts-enable-footer-color-override', "=", 1),
                                ),
                'transparent' => false,
                'default'   => '',
                'output'    => array(
                        'color' => '.main-footer a:hover'
                    )
            ),

            /************************************************************************
            * Second Footer
            *************************************************************************/
            array(
                'id'        => 'opts-enable-footer2-color-override',
                'type'      => 'checkbox',
                'required'  => array(
                            array('opts-footer-disable', "=", 1),
                            array('opts-footer-copyright-disable', "=", 1),
                            ),
                'title'     => esc_html__('Bottom Footer Coloring', 'ninezeroseven'),
                'subtitle'  => esc_html__('Check to enable color fields for bottom footer, this is the band at the bottom of the page.', 'ninezeroseven'),
                'default'   => '0'// 1 = on | 0 = off
            ),
            array(
                'id'        => 'opts-footer2-background-color-override',
                'type'      => 'color',
                'title'     => esc_html__('Bottom Footer Background Color', 'ninezeroseven'),
                'subtitle'  => esc_html__('Change the background color.', 'ninezeroseven'),
                'required'  => array(
                                array('opts-footer-disable', "=", 1),
                                array('opts-footer-copyright-disable', "=", 1),
                                array('opts-enable-footer2-color-override', "=", 1),
                                ),
                'transparent' => false,
                'default'   => '',
                'output'    => array(
                        'background-color' => '.bottom-band,body'
                    )
            ),
            array(
                'id'        => 'opts-footer2-color-override',
                'type'      => 'color',
                'title'     => esc_html__('Bottom Footer Text Color', 'ninezeroseven'),
                'subtitle'  => esc_html__('Change the background color.', 'ninezeroseven'),
                'required'  => array(
                                array('opts-footer-disable', "=", 1),
                                array('opts-footer-copyright-disable', "=", 1),
                                array('opts-enable-footer2-color-override', "=", 1),
                                ),
                'transparent' => false,
                'default'   => '',
                'output'    => array(
                        'color' => '.bottom-band'
                    )
            ),
            array(
                'id'        => 'opts-footer2-link-color-override',
                'type'      => 'color',
                'title'     => esc_html__('Bottom Footer Link Color', 'ninezeroseven'),
                'subtitle'  => esc_html__('Change the background color.', 'ninezeroseven'),
                'required'  => array(
                                array('opts-footer-disable', "=", 1),
                                array('opts-footer-copyright-disable', "=", 1),
                                array('opts-enable-footer2-color-override', "=", 1),
                                ),
                'transparent' => false,
                'default'   => '',
                'output'    => array(
                        'color' => '.bottom-band a'
                    )
            ),
            array(
                'id'        => 'opts-footer2-link-color-hover-override',
                'type'      => 'color',
                'title'     => esc_html__('Bottom Footer Hover Color', 'ninezeroseven'),
                'subtitle'  => esc_html__('Change the background color.', 'ninezeroseven'),
                'required'  => array(
                                array('opts-footer-disable', "=", 1),
                                array('opts-footer-copyright-disable', "=", 1),
                                array('opts-enable-footer2-color-override', "=", 1),
                                ),
                'transparent' => false,
                'default'   => '',
                'output'    => array(
                        'color' => '.bottom-band a:hover'
                    )
            ),

        )
    );
    // 4.3 END Footer Options
    // 4.3 Footer Options
    $boxSections[] = array(
        'title' => esc_html__('Typography', 'ninezeroseven'),
        //'desc' => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'ninezeroseven'),
        'icon_class' => 'icon-large',
        'icon' => 'fa fa-font',
        'fields' => array(
            array(
                'id'             => 'opts-typography-body-override',
                'type'           => 'typography',
                'title'          => esc_html__('Body Font', 'ninezeroseven'),
                'subtitle'       => esc_html__('Specify the body font properties.', 'ninezeroseven'),
                'google'         => true,
                'text-align'     => false,
                'letter-spacing' => true,
                'font-backup'    => true,
                'output'         => array('body')
        
            ),
            array(
                'id'             => 'opts-typography-menu-override',
                'type'           => 'typography',
                'title'          => esc_html__('Main Menu Font', 'ninezeroseven'),
                'subtitle'       => esc_html__('Specify the main menu font properties.', 'ninezeroseven'),
                'google'         => true,
                'text-align'     => false,
                'letter-spacing' => true,
                'color'          => false,
                'line-height'    => false,
                'font-backup'    => true,
                'default'        => array(
                    'font-size'     => '',
                    'font-family'   => '',
                    'font-weight'   => ''
                ),
                'output'    => array('.wbc_menu > li > a')
        
            ),
            array(
                'id'             => 'opts-typography-submenu-override',
                'type'           => 'typography',
                'title'          => esc_html__('Sub Menu Font', 'ninezeroseven'),
                'subtitle'       => esc_html__('Specify the Sub menu font properties.', 'ninezeroseven'),
                'google'         => true,
                'text-align'     => false,
                'letter-spacing' => true,
                'color'          => false,
                'line-height'    => false,
                'font-backup'    => true,
                'default'        => array(
                    'font-size'     => '',
                    'font-family'   => '',
                    'font-weight'   => ''
                ),
                'output'    => array('.wbc_menu ul li a')
        
            ),

            /************************************************************************
            * HEADINGS
            *************************************************************************/
            array(
                'id'        => 'opts-enable-heading-advance-override',
                'type'      => 'checkbox',
                'title'     => esc_html__('Advanced Headings (H tags)', 'ninezeroseven'),
                'subtitle'  => esc_html__('Check to enable advanced headings/control', 'ninezeroseven'),
                'default'   => '0'// 1 = on | 0 = off
            ),
            array(
                'id'             => 'opts-typography-heading-override',
                'type'           => 'typography',
                'required'       => array('opts-enable-heading-advance-override', "=", 0),
                'title'          => esc_html__('Headings Font (H1-H6 tags)', 'ninezeroseven'),
                'subtitle'       => esc_html__('Specify the heading tags font properties.', 'ninezeroseven'),
                'google'         => true,
                'text-align'     => false,
                'letter-spacing' => false,
                'font-size'      => false,
                'line-height'    =>false,
                'font-backup'    => true,
                'default'        => array(
                    'font-size'     => '',
                    'font-family'   => '',
                    'font-weight'   => ''
                ),
                'output'    => array('h1,h2,h3,h4,h5,h6')
        
            ),

            array(
                'id'             => 'opts-typography-h1-override',
                'type'           => 'typography',
                'required'       => array('opts-enable-heading-advance-override', "=", 1),
                'title'          => esc_html__('H1 Font', 'ninezeroseven'),
                'subtitle'       => esc_html__('Specify the H1 font properties.', 'ninezeroseven'),
                'google'         => true,
                'text-align'     => false,
                'letter-spacing' => true,
                'font-backup'    => true,
                'default'        => array(
                    'font-size'     => '',
                    'font-family'   => '',
                    'font-weight'   => ''
                ),
                'output'    => array('h1')
        
            ),
            array(
                'id'             => 'opts-typography-h2-override',
                'type'           => 'typography',
                'required'       => array('opts-enable-heading-advance-override', "=", 1),
                'title'          => esc_html__('H2 Font', 'ninezeroseven'),
                'subtitle'       => esc_html__('Specify the h2 font properties.', 'ninezeroseven'),
                'google'         => true,
                'text-align'     => false,
                'letter-spacing' => true,
                'font-backup'    => true,
                'default'        => array(
                    'font-size'     => '',
                    'font-family'   => '',
                    'font-weight'   => ''
                ),
                'output'    => array('h2')
        
            ),
            array(
                'id'             => 'opts-typography-h3-override',
                'type'           => 'typography',
                'required'       => array('opts-enable-heading-advance-override', "=", 1),
                'title'          => esc_html__('H3 Font', 'ninezeroseven'),
                'subtitle'       => esc_html__('Specify the h3 font properties.', 'ninezeroseven'),
                'google'         => true,
                'text-align'     => false,
                'letter-spacing' => true,
                'font-backup'    => true,
                'default'        => array(
                    'font-size'     => '',
                    'font-family'   => '',
                    'font-weight'   => ''
                ),
                'output'    => array('h3')
        
            ),
            array(
                'id'             => 'opts-typography-h4-override',
                'type'           => 'typography',
                'required'       => array('opts-enable-heading-advance-override', "=", 1),
                'title'          => esc_html__('H4 Font', 'ninezeroseven'),
                'subtitle'       => esc_html__('Specify the h4 font properties.', 'ninezeroseven'),
                'google'         => true,
                'text-align'     => false,
                'letter-spacing' => true,
                'font-backup'    => true,
                'default'        => array(
                    'font-size'     => '',
                    'font-family'   => '',
                    'font-weight'   => ''
                ),
                'output'    => array('h4')
        
            ),
            array(
                'id'             => 'opts-typography-h5-override',
                'type'           => 'typography',
                'required'       => array('opts-enable-heading-advance-override', "=", 1),
                'title'          => esc_html__('H5 Font', 'ninezeroseven'),
                'subtitle'       => esc_html__('Specify the H5 font properties.', 'ninezeroseven'),
                'google'         => true,
                'customCSS'      => '.chicken',
                'text-align'     => false,
                'letter-spacing' => true,
                'font-backup'    => true,
                'default'        => array(
                    'font-size'     => '',
                    'font-family'   => '',
                    'font-weight'   => ''
                ),
                'output'    => array('h5')
        
            ),
            array(
                'id'             => 'opts-typography-h6-override',
                'type'           => 'typography',
                'required'       => array('opts-enable-heading-advance-override', "=", 1),
                'title'          => esc_html__('H6 Font', 'ninezeroseven'),
                'subtitle'       => esc_html__('Specify the H6 font properties.', 'ninezeroseven'),
                'google'         => true,
                'text-align'     => false,
                'letter-spacing' => true,
                'font-backup'    => true,
                'default'        => array(
                    'font-size'     => '',
                    'font-family'   => '',
                    'font-weight'   => ''
                ),
                'output'    => array('h6')
        
            ),




            ));

        /************************************************************************
                * Extra Heading Options
                *************************************************************************/
            $boxSections[] = array(
                'title'     => esc_html__('Extra Headings', 'ninezeroseven'),
                //'desc'      => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'ninezeroseven'),
                'icon'      => 'fa fa-caret-right',
                'subsection' => true,
                // 'subsection' => true, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields'    => array(
                    array(
                        'id'             => 'opts-special-heading1-override',
                        'type'           => 'typography',
                        'title'          => esc_html__('Heading Styling 1, used in shortcodes.', 'ninezeroseven'),
                        // 'subtitle'       => esc_html__('Specify the Sub menu font properties.', 'ninezeroseven'),
                        'google'         => true,
                        'text-align'     => false,
                        'letter-spacing' => true,
                        'color'          => false,
                        'line-height'    => false,
                        'font-backup'    => true,
                        'default'        => array(
                            'font-size'     => '',
                            'font-family'   => '',
                            'font-weight'   => ''
                        ),
                        'output'    => array('.special-heading-1')
                
                    ),
                    array(
                        'id'             => 'opts-special-heading2-override',
                        'type'           => 'typography',
                        'title'          => esc_html__('Heading Styling 2, used in shortcodes.', 'ninezeroseven'),
                        // 'subtitle'       => esc_html__('Specify the Sub menu font properties.', 'ninezeroseven'),
                        'google'         => true,
                        'text-align'     => false,
                        'letter-spacing' => true,
                        'color'          => false,
                        'line-height'    => false,
                        'font-backup'    => true,
                        'default'        => array(
                            'font-size'     => '',
                            'font-family'   => '',
                            'font-weight'   => ''
                        ),
                        'output'    => array('.special-heading-2')
                
                    ),
                    array(
                        'id'             => 'opts-special-heading3-override',
                        'type'           => 'typography',
                        'title'          => esc_html__('Heading Styling 3, used in shortcodes.', 'ninezeroseven'),
                        // 'subtitle'       => esc_html__('Specify the Sub menu font properties.', 'ninezeroseven'),
                        'google'         => true,
                        'text-align'     => false,
                        'letter-spacing' => true,
                        'color'          => false,
                        'line-height'    => false,
                        'font-backup'    => true,
                        'default'        => array(
                            'font-size'     => '',
                            'font-family'   => '',
                            'font-weight'   => ''
                        ),
                        'output'    => array('.special-heading-3')
                
                    ),
                    array(
                        'id'             => 'opts-special-heading4-override',
                        'type'           => 'typography',
                        'title'          => esc_html__('Heading Styling 4, used in shortcodes.', 'ninezeroseven'),
                        // 'subtitle'       => esc_html__('Specify the Sub menu font properties.', 'ninezeroseven'),
                        'google'         => true,
                        'text-align'     => false,
                        'letter-spacing' => true,
                        'color'          => false,
                        'line-height'    => false,
                        'font-backup'    => true,
                        'default'        => array(
                            'font-size'     => '',
                            'font-family'   => '',
                            'font-weight'   => ''
                        ),
                        'output'    => array('.special-heading-4')
                
                    ),

                    





                    )
                );

    $metaboxes[] = array(
        'id'            => 'wbc-page-layout-extended',
        'title'         => esc_html__('Page Options', 'ninezeroseven'),
        'post_types'    => array('post','page','wbc-portfolio'),
        //'page_template' => array('page-test.php'),
        //'post_format'   => array('image'),
        'position'      => 'normal', // normal, advanced, side
        'priority'      => 'default', // high, core, default, low
        'sections'      => $boxSections
    );

    /************************************************************************
    * 4- END Page, Post, wbc_portfolio Options
    *************************************************************************/



    // Kind of overkill, but ahh well.  ;)
    $metaboxes = apply_filters( 'wbc_theme_meta_boxes', $metaboxes );

    return $metaboxes;
  }
  add_action('redux/metaboxes/'.$redux_opt_name.'/boxes', 'wbc907_add_metaboxes');
endif;
?>