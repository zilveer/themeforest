<?php

/*******************************************************************************************************************
 * Add custom meta boxes
 */

$pages_arr = array('page', 'post', 'portfolio-post');
if ( ishyoboy_woocommerce_plugin_active() ){
    $pages_arr[] = 'product';
}

add_ishyo_meta_box('ishyoboy_lead_area', array(
    'title'     => 'Lead Section',
    'pages'		=> $pages_arr,
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(
        array(
            'name' => __('Display Lead Area', 'ishyoboy'),
            'id' => 'ishyoboy_display_lead',
            'default' => 'true',
            'desc' => __('If checked, lead area will be displayed on the current page.', 'ishyoboy'),
            'type' => 'checkbox',
        ),
        array(
            'name' => __('Lead Section type', 'ishyoboy'),
            'id' => 'ishyoboy_lead_type',
            'default' => 'boxed',
            'desc' => '',//__('Choose how the lead content will be displayed. The "unboxed" version is usually used for full-width slider shortcodes.', 'ishyoboy'),
            'type' => 'radio',
            'options' => array(
                'boxed' => __('Boxed', 'ishyoboy'),
                'unboxed' => __('Unboxed (Full-width)', 'ishyoboy'),
            )
        ),
        array(
            'name' => __('Lead Section content', 'ishyoboy'),
            'id' => 'ishyoboy_lead',
            'default' => '',
            'desc' => __('Content to be displayed in the Lead area', 'ishyoboy'),
            'type' => 'wp_editor',
        )
    )
));

add_ishyo_meta_box('ishyoboy_meta_post_link', array(
    'title'     => __('Link settings', 'ishyoboy'),
    'pages'		=> array('post'),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(
        array(
            'name' => __('URL', 'ishyoboy'),
            'id' => 'ishyoboy_post_url',
            'desc' => __('Add an URL link.', 'ishyoboy'),
            'type' => 'text'
        )
    )
));

add_ishyo_meta_box('ishyoboy_meta_post_quote', array(
    'title'     => __('Quote settings', 'ishyoboy'),
    'pages'		=> array('post'),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(
        array(
            'name' => __('Quote', 'ishyoboy'),
            'id' => 'ishyoboy_post_quote',
            'desc' => __('Add a quote', 'ishyoboy'),
            'type' => 'textarea'
        ),
        array(
            'name' => __('Quote Source', 'ishyoboy'),
            'id' => 'ishyoboy_post_quote_source',
            'desc' => __('Add the quote source', 'ishyoboy'),
            'type' => 'text'
        ),
        array(
            'name' => __('URL', 'ishyoboy'),
            'id' => 'ishyoboy_post_quote_url',
            'desc' => __('Add the quote source URL', 'ishyoboy'),
            'type' => 'text'
        )
    )
));

add_ishyo_meta_box('ishyoboy_meta_post_audio', array(
    'title'     => __('Audio settings', 'ishyoboy'),
    'pages'		=> array('post', 'portfolio-post'),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(
        array(
            'name' => __('Adio file URL', 'ishyoboy'),
            'id' => 'ishyoboy_post_audio',
            'default' => '',
            'desc' => __('Please enter the URL of the audio file.', 'ishyoboy'),
            'type' => 'text'
        )
    )
));

add_ishyo_meta_box('ishyoboy_meta_post_video', array(
    'title'     => __('Video settings', 'ishyoboy'),
    'pages'		=> array('post', 'portfolio-post'),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(
        array(
            'name' => __('Embedded or Selfhosted video', 'ishyoboy'),
            'id' => 'ishyoboy_post_embedded_video',
            'default' => 'true',
            'desc' => __('Use embedded video.', 'ishyoboy'),
            'type' => 'checkbox',
        ),
        array(
            'name' => __('URL or Embedded Code', 'ishyoboy'),
            'id' => 'ishyoboy_post_video',
            'desc' => __('Enter the URL or embed code of Vimeo.com or YouTube.com streaming services.<br>To get the code, go to the external video page, click "share" button and copy the Embed code.', 'ishyoboy'),
            'type' => 'textarea'
        ),
        array(
            'name' => __('MP4 file URL', 'ishyoboy'),
            'id' => 'ishyoboy_post_video_mp4',
            'default' => '',
            'desc' => __('Please enter the URL of the .mp4 video file.', 'ishyoboy'),
            'type' => 'text'
        ),
        array(
            'name' => __('WebM file URL', 'ishyoboy'),
            'id' => 'ishyoboy_post_video_webm',
            'default' => '',
            'desc' => __('Please enter the URL of the .webm video file.', 'ishyoboy'),
            'type' => 'text'
        ),
        array(
            'name' => __('Poster image', 'ishyoboy'),
            'id' => 'ishyoboy_post_video_poster',
            'default' => '',
            'desc' => __('Please enter the URL of the poster image file.', 'ishyoboy'),
            'type' => 'text',
            'std' => ''
        ),
    )
));

$pages_arr = array('page', 'post', 'portfolio-post');
if ( ishyoboy_woocommerce_plugin_active() ){
    $pages_arr[] = 'product';
}

add_ishyo_meta_box('ishyoboy_page_settings', array(
    'title'     => 'Page Settings',
    'pages'		=> $pages_arr,
    'context'   => 'side',
    'priority'  => 'default',
    'fields'    => array(
        array(
            'name' => __('Show breadcrumbs:', 'ishyoboy'),
            'id' => 'ishyoboy_show_breadcrumbs',
            'default' => '',
            'desc' => __('To show/hide the breadcrumbs on all pages go to ', 'ishyoboy' ) . '<a href="' . admin_url('themes.php?page=optionsframework') . '" target="_blank">Theme Options</a>',
            'type' => 'select',
            'options' => array(
                ''		=> 'Default setting',
                '0'		=> 'Hide',
                '1'		=> 'Show'
            )
        ),
        array(
            'name' => __('Page Boxed / Unboxed layout:', 'ishyoboy'),
            'id' => 'ishyoboy_boxed_layout',
            'default' => '',
            'desc' => __('To change the layout of the whole website go to ', 'ishyoboy' ) . '<a href="' . admin_url('themes.php?page=optionsframework') . '" target="_blank">Theme Options</a>',
            'type' => 'select',
            'options' => array(
                ''		    => 'Default setting',
                'boxed'		=> 'Boxed',
                'unboxed'	=> 'Unboxed'
            )
        )
    )
));

$pages_arr = array('page', 'post', 'portfolio-post');
if ( ishyoboy_woocommerce_plugin_active() ){
    $pages_arr[] = 'product';
}

if ( !ishyoboy_seo_plugin_active() ){
    add_ishyo_meta_box('ishyoboy_seo_fields', array(
        'title'     => __('SEO Options', 'ishyoboy'),
        'pages'		=> $pages_arr,
        'context'   => 'normal',
        'priority'  => 'default',
        'fields'    => array(
            array(
                'name' => __('SEO Title', 'ishyoboy'),
                'id' => 'ishyoboy_seo_title',
                'default' => '',
                'desc' => __('Short title. Circa 60 characters.', 'ishyoboy'),
                'type' => 'text',
            ),
            array(
                'name' => __('SEO Description', 'ishyoboy'),
                'id' => 'ishyoboy_seo_description',
                'default' => '',
                'desc' => __('Short description. Circa 160 characters.', 'ishyoboy'),
                'type' => 'text',
            ),
            array(
                'name' => __('SEO Keywords', 'ishyoboy'),
                'id' => 'ishyoboy_seo_keywords',
                'default' => '',
                'desc' => __('Comma separated list of keywords.', 'ishyoboy'),
                'type' => 'text',
            ),
        )
    ));
}

add_ishyo_meta_box('ishyoboy_slides_urls', array(
    'title'     => __('Slide Settings', 'ishyoboy'),
    'pages'		=> array('ishyoboy_slides'),
    'context'   => 'side',
    'priority'  => 'default',
    'fields'    => array(
        array(
            'name' => __('Slide type', 'ishyoboy'),
            'id' => 'ishyoboy_slide_type',
            'default' => 'content',
            'desc' => '',//__('Choose how the lead content will be displayed. The "unboxed" version is usually used for full-width slider shortcodes.', 'ishyoboy'),
            'type' => 'radio',
            'options' => array(
                'content' => __('Content', 'ishyoboy'),
                'image' => __('Image', 'ishyoboy'),
            )
        ),
        array(
            'name' => __('Slide url link', 'ishyoboy'),
            'id' => 'ishyoboy_slide_url',
            'default' => '',
            'desc' => __('Enter the url which the slide will link to. E.g. http://www.ishyoboy.com', 'ishyoboy'),
            'type' => 'text',
        ),
        array(
            'name' => __('New window', 'ishyoboy'),
            'id' => 'ishyoboy_slide_url_new_window',
            'default' => 'true',
            'desc' => __('Open link in a new window.', 'ishyoboy'),
            'type' => 'checkbox'
        )
    )
));


$pages_arr = array('page', 'post', 'portfolio-post');
if ( ishyoboy_woocommerce_plugin_active() ){
    $pages_arr[] = 'product';
}

// Page, Blog & Portfolio Sidebars
add_ishyo_meta_box('ishyoboy_blog_sidebars', array(
    'title'     => 'Sidebar',
    'pages'		=> $pages_arr,
    'context'   => 'side',
    'priority'  => 'default',
    'fields'    => array(
        array(
            'name' => __('Sidebar position', 'ishyoboy'),
            'id' => 'ishyoboy_sidebar_position',
            'default' => '',
            'desc' => '', //__('', 'ishyoboy'),
            'type' => 'select',
            'options' => array(
                ''		=> 'Default setting',
                'none'		=> 'No Sidebar',
                'left'		=> 'Left',
                'right'		=> 'Right'
            ),
        ),
        array(
            'name' => __('Sidebar', 'ishyoboy'),
            'desc' => __('<strong>IMPORTANT:</strong><br>Page breaks and Sections will be removed if a sidebar is added.', 'ishyoboy'),
            'id' => 'ishyoboy_sidebar',
            'default' => '',
            'type' => 'sidebar_select'
        )
    )
));

$pages_arr = array('page', 'post', 'portfolio-post');
if ( ishyoboy_woocommerce_plugin_active() ){
    $pages_arr[] = 'product';
}

// Expandable header
add_ishyo_meta_box('ishyoboy_expandable_header', array(
    'title'     => 'Expandable header',
    'pages'		=> $pages_arr,
    'context'   => 'side',
    'priority'  => 'default',
    'fields'    => array(
        array(
            'name' => __('Make header expandable:', 'ishyoboy'),
            'id' => 'ishyoboy_use_header_sidebar',
            'default' => '',
            'desc' => '', //__('', 'ishyoboy'),
            'type' => 'select',
            'options' => array(
                ''		=> 'Default setting',
                '0'		=> 'Disable',
                '1'		=> 'Enable'
            )
        ),
        array(
            'name' => __('Use expandable sidebar:', 'ishyoboy'),
            'id' => 'ishyoboy_header_sidebar',
            'default' => '',
            'type' => 'sidebar_select'
        ),
        array(
            'name' => __('Defaulf expandable state:', 'ishyoboy'),
            'id' => 'ishyoboy_header_sidebar_on',
            'default' => '0',
            'desc' => '', //__('', 'ishyoboy'),
            'type' => 'select',
            'options' => array(
                '0'		=> 'Closed',
                '1'		=> 'Opened'
            )
        )
    )
));

$pages_arr = array('page', 'post', 'portfolio-post');
if ( ishyoboy_woocommerce_plugin_active() ){
    $pages_arr[] = 'product';
}

// Footer widget area
add_ishyo_meta_box('ishyoboy_footer_widgets', array(
    'title'     => 'Footer Widget Area',
    'pages'		=> $pages_arr,
    'context'   => 'side',
    'priority'  => 'default',
    'fields'    => array(
        array(
            'name' => __('Footer widget area:', 'ishyoboy'),
            'id' => 'ishyoboy_use_footer_widget_area',
            'default' => '',
            'desc' => '', //__('', 'ishyoboy'),
            'type' => 'select',
            'options' => array(
                ''		=> 'Default setting',
                '0'		=> 'Disable',
                '1'		=> 'Enable'
            )
        ),
        array(
            'name' => __('Use footer sidebar:', 'ishyoboy'),
            'id' => 'ishyoboy_footer_sidebar',
            'default' => 'sidebar-footer',
            'type' => 'sidebar_select'
        ),
    )
));

add_ishyo_meta_box('ishyoboy_portfolio_images_box', array(
    'title'     => __('Portfolio Gallery', 'ishyoboy'),
    'pages'		=> array('portfolio-post'),
    'context'   => 'side',
    'priority'  => 'default',
    'fields'    => array(
        array(
            'name' => '', //__('Upload images', 'ishyoboy'),
            'id' => 'ishyoboy_porfolio_images',
            'default' => '',
            'desc' => '',
            'type' => 'images2',
        )
    )
));

