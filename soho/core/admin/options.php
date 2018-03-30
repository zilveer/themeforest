<?php

$gt3_tabs_admin_theme = new Tabs_admin_theme();

$gt3_tabs_admin_theme->add(new Tab_admin_theme(array(
    'name' => 'General',
    'desc' => '',
    'icon' => 'general.png',
    'icon_active' => 'general_active.png',
    'icon_hover' => 'general_hover.png'
), array(
    new UploadOption_admin_theme(array(
        'name' => 'Header logo',
        'id' => 'logo',
        'desc' => 'Default: 130px x 30px',
        'default' => THEMEROOTURL . '/img/logo.png'
    )),
    new UploadOption_admin_theme(array(
        'name' => 'Logo (Retina)',
        'id' => 'logo_retina',
        'desc' => 'Default: 260px x 60px',
        'default' => THEMEROOTURL . '/img/retina/logo.png'
    )),
    new textOption_admin_theme(array(
        'name' => 'Header logo width',
        'id' => 'header_logo_standart_width',
        'not_empty' => true,
        'width' => '100px',
        'textalign' => 'center',
        'default' => '130'
    )),
    new textOption_admin_theme(array(
        'name' => 'Header logo height',
        'id' => 'header_logo_standart_height',
        'not_empty' => true,
        'width' => '100px',
        'textalign' => 'center',
        'default' => '30'
    )),
    new UploadOption_admin_theme(array(
        'name' => 'Landing logo',
        'id' => 'logo_landing',
        'desc' => 'Default: 140px x 100px',
        'default' => THEMEROOTURL . '/img/landing_logo.png'
    )),
    new UploadOption_admin_theme(array(
        'name' => 'Landing Logo (Retina)',
        'id' => 'logo_landing_retina',
        'desc' => 'Default: 280px x 200px',
        'default' => THEMEROOTURL . '/img/retina/landing_logo.png'
    )),	
    new textOption_admin_theme(array(
        'name' => 'Landing logo width',
        'id' => 'landing_logo_standart_width',
        'not_empty' => true,
        'width' => '100px',
        'textalign' => 'center',
        'default' => '140'
    )),
    new textOption_admin_theme(array(
        'name' => 'Landing logo height',
        'id' => 'landing_logo_standart_height',
        'not_empty' => true,
        'width' => '100px',
        'textalign' => 'center',
        'default' => '100'
    )),	
    new UploadOption_admin_theme(array(
        'type' => 'upload',
        'name' => 'Favicon',
        'id' => 'favicon',
        'desc' => 'Icon must be 16x16px or 32x32px',
        'default' => THEMEROOTURL . '/img/favico.ico'
    )),
    new UploadOption_admin_theme(array(
        'type' => 'upload',
        'name' => 'Apple touch icon (57px)',
        'id' => 'apple_touch_57',
        'desc' => 'Icon must be 57x57px',
        'default' => THEMEROOTURL . '/img/apple_icons_57x57.png'
    )),
    new UploadOption_admin_theme(array(
        'type' => 'upload',
        'name' => 'Apple touch icon (72px)',
        'id' => 'apple_touch_72',
        'desc' => 'Icon must be 72x72px',
        'default' => THEMEROOTURL . '/img/apple_icons_72x72.png'
    )),
    new UploadOption_admin_theme(array(
        'type' => 'upload',
        'name' => 'Apple touch icon (114px)',
        'id' => 'apple_touch_114',
        'desc' => 'Icon must be 114x114px',
        'default' => THEMEROOTURL . '/img/apple_icons_114x114.png'
    )),
    new TextareaOption_admin_theme(array(
        'name' => 'Google analytics or any other code<br>(before &lt;/head&gt;)',
        'id' => 'code_before_head',
        'default' => ''
    )),
    new TextareaOption_admin_theme(array(
        'name' => 'Any code <br>(before &lt;/body&gt;)',
        'id' => 'code_before_body',
        'default' => ''
    )),
    new TextareaOption_admin_theme(array(
        'name' => 'Copyright',
        'id' => 'copyright',
        'default' => 'Copyright &copy; 2014 Soho WordPress Theme. All Rights Reserved.'
    )),
    new AjaxButtonOption_admin_theme(array(
        'title' => 'Import Sample Data',
        'id' => 'action_import',
        'name' => __('Import demo content', 'theme_localization'),
        'confirm' => TRUE,
        'data' => array(
            'action' => 'ajax_import_dump'
        )
    ))
)));

$gt3_tabs_admin_theme->add(new Tab_admin_theme(array(
    'name' => 'Sidebars',
    'desc' => '',
    'icon' => 'sidebars.png',
    'icon_active' => 'sidebars_active.png',
    'icon_hover' => 'sidebars_hover.png'
), array(
    new SelectOption_admin_theme(array(
        'name' => 'Default sidebar layout',
        'id' => 'default_sidebar_layout',
        'desc' => '',
        'default' => 'right-sidebar',
        'options' => array(
            'left-sidebar' => 'Left sidebar',
            'right-sidebar' => 'Right sidebar',
            'no-sidebar' => 'Without sidebar'
        )
    )),
    new SidebarManager_admin_theme(array(
        'name' => 'Sidebar manager',
        'id' => 'sidebar_manager',
        'desc' => ''
    ))
)));

$gt3_tabs_admin_theme->add(new Tab_admin_theme(array(
    'name' => 'Fonts',
    'desc' => '',
    'icon' => 'fonts.png',
    'icon_active' => 'fonts_active.png',
    'icon_hover' => 'fonts_hover.png'
), array(
    new FontSelector_admin_theme(array(
        'name' => 'Content font',
        'id' => 'main_font',
        'desc' => '',
        'default' => 'Roboto',
        'options' => get_fonts_array_only_key_name()
    )),
    new textOption_admin_theme(array(
        'name' => 'Main font parameters',
        'id' => 'google_font_parameters_main_font',
        'not_empty' => true,
        'default' => ':300,400',
        'width' => '100%',
        'textalign' => 'left',
        'desc' => 'Google font. Click <a href="https://developers.google.com/webfonts/docs/getting_started" target="_blank">here</a> for help.'
    )),
    new FontSelector_admin_theme(array(
        'name' => 'Main menu font',
        'id' => 'main_menu_font',
        'desc' => '',
        'default' => 'Roboto',
        'options' => get_fonts_array_only_key_name()
    )),
    new textOption_admin_theme(array(
        'name' => 'Main menu font parameters',
        'id' => 'google_font_parameters_menu_font',
        'not_empty' => true,
        'default' => ':300,900',
        'width' => '100%',
        'textalign' => 'left',
        'desc' => 'Google font. Click <a href="https://developers.google.com/webfonts/docs/getting_started" target="_blank">here</a> for help.'
    )),
    new FontSelector_admin_theme(array(
        'name' => 'Headers',
        'id' => 'text_headers_font',
        'desc' => '',
        'default' => 'Roboto',
        'options' => get_fonts_array_only_key_name()
    )),
    new textOption_admin_theme(array(
        'name' => 'Headers font parameters',
        'id' => 'google_font_parameters_headers_font',
        'not_empty' => true,
        'default' => ':900',
        'width' => '100%',
        'textalign' => 'left',
        'desc' => 'Google font. Click <a href="https://developers.google.com/webfonts/docs/getting_started" target="_blank">here</a> for help.'
    )),
    new textOption_admin_theme(array(
        'name' => 'Content font weight',
        'id' => 'content_weight',
        'not_empty' => true,
        'default' => '400',
        'width' => '100px',
        'textalign' => 'center',
        'desc' => ''
    )),
    new textOption_admin_theme(array(
        'name' => 'Headings font weight',
        'id' => 'headings_weight',
        'not_empty' => true,
        'default' => '900',
        'width' => '100px',
        'textalign' => 'center',
        'desc' => ''
    )),
    new textOption_admin_theme(array(
        'name' => 'Main menu font weight',
        'id' => 'menu_weight',
        'not_empty' => true,
        'default' => '900',
        'width' => '100px',
        'textalign' => 'center',
        'desc' => ''
    )),
    new textOption_admin_theme(array(
        'name' => 'Sub-menu font weight',
        'id' => 'submenu_weight',
        'not_empty' => true,
        'default' => '300',
        'width' => '100px',
        'textalign' => 'center',
        'desc' => ''
    )),
    new textOption_admin_theme(array(
        'name' => 'Main menu font size',
        'id' => 'menu_font_size',
        'not_empty' => true,
        'default' => '13px',
        'width' => '100px',
        'textalign' => 'center',
        'desc' => ''
    )),
    new textOption_admin_theme(array(
        'name' => 'Sub-menu font size',
        'id' => 'submenu_font_size',
        'not_empty' => true,
        'default' => '12px',
        'width' => '100px',
        'textalign' => 'center',
        'desc' => ''
    )),
    new textOption_admin_theme(array(
        'name' => 'H1 font size',
        'id' => 'h1_font_size',
        'not_empty' => true,
        'default' => '22px',
        'width' => '100px',
        'textalign' => 'center',
        'desc' => ''
    )),
    new textOption_admin_theme(array(
        'name' => 'H2 font size',
        'id' => 'h2_font_size',
        'not_empty' => true,
        'default' => '20px',
        'width' => '100px',
        'textalign' => 'center',
        'desc' => ''
    )),
    new textOption_admin_theme(array(
        'name' => 'H3 font size',
        'id' => 'h3_font_size',
        'not_empty' => true,
        'default' => '18px',
        'width' => '100px',
        'textalign' => 'center',
        'desc' => ''
    )),
    new textOption_admin_theme(array(
        'name' => 'H4 font size',
        'id' => 'h4_font_size',
        'not_empty' => true,
        'default' => '16px',
        'width' => '100px',
        'textalign' => 'center',
        'desc' => ''
    )),
    new textOption_admin_theme(array(
        'name' => 'H5 font size',
        'id' => 'h5_font_size',
        'not_empty' => true,
        'default' => '14px',
        'width' => '100px',
        'textalign' => 'center',
        'desc' => ''
    )),
    new textOption_admin_theme(array(
        'name' => 'H6 font size',
        'id' => 'h6_font_size',
        'not_empty' => true,
        'default' => '12px',
        'width' => '100px',
        'textalign' => 'center',
        'desc' => ''
    )),
    new textOption_admin_theme(array(
        'name' => 'Content font size',
        'id' => 'main_content_font_size',
        'not_empty' => true,
        'default' => '12px',
        'width' => '100px',
        'textalign' => 'center',
        'desc' => ''
    )),
    new textOption_admin_theme(array(
        'name' => 'Content line height',
        'id' => 'main_content_line_height',
        'not_empty' => true,
        'default' => '22px',
        'width' => '100px',
        'textalign' => 'center',
        'desc' => ''
    )),
)));


$gt3_tabs_admin_theme->add(new Tab_admin_theme(array(
    'name' => 'Socials',
    'icon' => 'social.png',
    'icon_active' => 'social_active.png',
    'icon_hover' => 'social_hover.png'
), array(
    new TextOption_admin_theme(array(
        'name' => 'Facebook',
        'id' => 'social_facebook',
        'default' => 'http://facebook.com',
        'desc' => 'Please specify http:// to the URL'
    )),
    new TextOption_admin_theme(array(
        'name' => 'Flickr',
        'id' => 'social_flickr',
        'default' => 'http://flickr.com',
        'desc' => 'Please specify http:// to the URL'
    )),
    new TextOption_admin_theme(array(
        'name' => 'Tumblr',
        'id' => 'social_tumblr',
        'default' => 'http://tumblr.com',
        'desc' => 'Please specify http:// to the URL'
    )),
    new TextOption_admin_theme(array(
        'name' => 'Instagram',
        'id' => 'social_instagram',
        'default' => 'http://instagram.com',
        'desc' => 'Please specify http:// to the URL'
    )),
    new TextOption_admin_theme(array(
        'name' => 'Twitter',
        'id' => 'social_twitter',
        'default' => 'http://twitter.com',
        'desc' => 'Please specify http:// to the URL'
    )),

    new TextOption_admin_theme(array(
        'name' => 'Youtube',
        'id' => 'social_youtube',
        'default' => 'https://www.youtube.com/',
        'desc' => 'Please specify http:// to the URL'
    )),
    new TextOption_admin_theme(array(
        'name' => 'Dribbble',
        'id' => 'social_dribbble',
        'default' => 'http://dribbble.com/',
        'desc' => 'Please specify http:// to the URL'
    )),
    new TextOption_admin_theme(array(
        'name' => 'Google+',
        'id' => 'social_gplus',
        'default' => 'https://plus.google.com/',
        'desc' => 'Please specify http:// to the URL'
    )),
    new TextOption_admin_theme(array(
        'name' => 'Vimeo',
        'id' => 'social_vimeo',
        'default' => 'https://vimeo.com/',
        'desc' => 'Please specify http:// to the URL'
    )),
    new TextOption_admin_theme(array(
        'name' => 'Delicious',
        'id' => 'social_delicious',
        'default' => 'https://delicious.com/',
        'desc' => 'Please specify http:// to the URL'
    )),
    new TextOption_admin_theme(array(
        'name' => 'Linked In',
        'id' => 'social_linked',
        'default' => 'https://www.linkedin.com/',
        'desc' => 'Please specify http:// to the URL'
    )),
    new TextOption_admin_theme(array(
        'name' => 'Pinterest',
        'id' => 'social_pinterest',
        'default' => 'http://pinterest.com',
        'desc' => 'Please specify http:// to the URL'
    )),
)));


$gt3_tabs_admin_theme->add(new Tab_admin_theme(array(
    'name' => 'Contacts',
    'icon' => 'contacts.png',
    'icon_active' => 'contacts_active.png',
    'icon_hover' => 'contacts_hover.png'
), array(
    new TextOption_admin_theme(array(
        'name' => 'Phone number',
        'id' => 'phone',
        'default' => '+1 800 356 17 49'
    )),
)));


$gt3_tabs_admin_theme->add(new Tab_admin_theme(array(
    'name' => 'View Options',
    'icon' => 'layout.png',
    'icon_active' => 'layout_active.png',
    'icon_hover' => 'layout_hover.png'
), array(
    new SelectOption_admin_theme(array(
        'name' => 'Responsive',
        'id' => 'responsive',
        'desc' => '',
        'default' => 'on',
        'options' => array(
            'on' => 'On',
            'off' => 'Off'
        )
    )),
    new SelectOption_admin_theme(array(
        'name' => 'Sticky Menu',
        'id' => 'sticky',
        'desc' => '',
        'default' => 'off',
        'options' => array(
            'on' => 'On',
            'off' => 'Off'
        )
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Theme color',
        'id' => 'theme_color1',
        'desc' => '',
        'not_empty' => 'true',
        'default' => 'ef969a'
    )),	
    new UploadOption_admin_theme(array(
        'type' => 'upload',
        'name' => 'Default background image',
        'id' => 'bg_img',
        'desc' => '',
        'default' => THEMEROOTURL . '/img/def_bg.jpg'
    )),
    new textOption_admin_theme(array(
        'name' => 'Fullscreen blog Items per page',
        'id' => 'fw_posts_per_page',
        'not_empty' => true,
        'width' => '100px',
        'textalign' => 'center',
        'default' => '14'
    )),
    /*new textOption_admin_theme(array(
        'name' => 'Fullscreen blog Items per load',
        'id' => 'fw_posts_per_load',
        'not_empty' => true,
        'width' => '100px',
        'textalign' => 'center',
        'default' => '5'
    )),*/
    new textOption_admin_theme(array(
        'name' => 'Fullscreen Portfolio Items per page',
        'id' => 'fw_port_per_page',
        'not_empty' => true,
        'width' => '100px',
        'textalign' => 'center',
        'default' => '20'
    )),
    /*new textOption_admin_theme(array(
        'name' => 'Fullscreen Portfolio Items per load',
        'id' => 'fw_port_per_load',
        'not_empty' => true,
        'width' => '100px',
        'textalign' => 'center',
        'default' => '5'
    )),*/
    new SelectOption_admin_theme(array(
        'name' => 'Related Posts',
        'id' => 'related_posts',
        'desc' => '',
        'default' => 'on',
        'options' => array(
            'on' => 'On',
            'off' => 'Off'
        )
    )),	
    new SelectOption_admin_theme(array(
        'name' => 'Default gallery style',
        'id' => 'default_gallery_style',
        'desc' => '',
        'default' => 'fw-gallery-post',
        'options' => array(
            'fw-gallery-post' => 'Fullscreen Slider',
			'ribbon-gallery-post' => 'Fullscreen Ribbon',
			'grid-gallery-post' => 'Grid Style',
			'masonry-gallery-post' => 'Masonry Style'
        )
    )),	
    new SelectOption_admin_theme(array(
        'name' => 'Default portfolio posts style',
        'id' => 'default_portfolio_style',
        'desc' => '',
        'default' => 'fw-portfolio-post',
        'options' => array(
            'fw-portfolio-post' => 'Fullscreen Slider',
			'ribbon-portfolio-post' => 'Fullscreen Ribbon',
			'flow-portfolio-post' => 'Flow',
            'simple-portfolio-post' => 'Simple'			
        )
    )),
    new SelectOption_admin_theme(array(
        'name' => 'Default posts style',
        'id' => 'default_post_style',
        'desc' => '',
        'default' => 'simple-post',
        'options' => array(
			'fw-post' => 'Fullwidth',
            'simple-post' => 'Simple'			
        )
    )),	
    new SelectOption_admin_theme(array(
        'name' => 'Portfolio comments',
        'id' => 'portfolio_comments',
        'desc' => '',
        'default' => 'disabled',
        'options' => array(
            'disabled' => 'Disabled',
            'enabled' => 'Enabled'
        )
    )),
    new SelectOption_admin_theme(array(
        'name' => 'Page comments',
        'id' => 'page_comments',
        'desc' => '',
        'default' => 'disabled',
        'options' => array(
            'disabled' => 'Disabled',
            'enabled' => 'Enabled'
        )
    )),
    new TextareaOption_admin_theme(array(
        'name' => 'Custom CSS',
        'id' => 'custom_css',
        'default' => ''
    )),
)));

$gt3_tabs_admin_theme->add(new Tab_admin_theme(array(
    'name' => 'Gallery Options',
    'icon' => 'landing.png',
    'icon_active' => 'landing_active.png',
    'icon_hover' => 'landing_hover.png'
), array(
    new SelectOption_admin_theme(array(
        'name' => 'Fit Style',
        'id' => 'default_fit_style',
        'desc' => '',
        'default' => 'no_fit',
        'options' => array(
            'no_fit' => 'Cover Slide',
			'fit_always' => 'Fit Always',
            'fit_width' => 'Fit Horizontal',
			'fit_height' => 'Fit Vertical'
        )
    )),	
    new SelectOption_admin_theme(array(
        'name' => 'Show Controls',
        'id' => 'default_controls',
        'desc' => '',
        'default' => 'on',
        'options' => array(
            'on' => 'Yes',
            'off' => 'No'
        )
    )),
    new SelectOption_admin_theme(array(
        'name' => 'Autoplay',
        'id' => 'default_autoplay',
        'desc' => '',
        'default' => 'on',
        'options' => array(
            'on' => 'Yes',
            'off' => 'No'
        )
    )),
    new textOption_admin_theme(array(
        'name' => 'Slide Interval In Milliseconds',
        'id' => 'gallery_interval',
        'not_empty' => true,
        'width' => '100px',
        'textalign' => 'center',
        'default' => '3000'
    ))
)));

$gt3_tabs_admin_theme->add(new Tab_admin_theme(array(
    'name' => 'Color options',
    'icon' => 'colors.png',
    'icon_active' => 'colors_active.png',
    'icon_hover' => 'colors_hover.png'
), array(
    new ColorOption_admin_theme(array(
        'name' => 'Main content color',
        'id' => 'content_color',
        'desc' => '',
        'not_empty' => 'true',
        'default' => '7e7f81'
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Headings color',
        'id' => 'heading_color',
        'desc' => '',
        'not_empty' => 'true',
        'default' => '3f4041'
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Body Background',
        'id' => 'body_bg',
        'desc' => '',
        'not_empty' => 'true',
        'default' => 'ffffff'
    )),
	
    new ColorOption_admin_theme(array(
        'name' => 'Logo Background',
        'id' => 'logo_bg',
        'desc' => '',
        'not_empty' => 'true',
        'default' => '2e3032'
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Header Background',
        'id' => 'header_bg',
        'desc' => '',
        'not_empty' => 'true',
        'default' => '1d1e1f'
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Main Menu Color',
        'id' => 'menu_color',
        'desc' => '',
        'not_empty' => 'true',
        'default' => 'c7cacc'
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Active Menu Color',
        'id' => 'active_menu_color',
        'desc' => '',
        'not_empty' => 'true',
        'default' => '616364'
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Hover Menu Color',
        'id' => 'hover_menu_color',
        'desc' => '',
        'not_empty' => 'true',
        'default' => 'ef969a'
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Sub-menu Background',
        'id' => 'submenu1_bg',
        'desc' => '',
        'not_empty' => 'true',
        'default' => '2e3032'
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Sub-menu 2nd Level Background',
        'id' => 'submenu2_bg',
        'desc' => '',
        'not_empty' => 'true',
        'default' => '1d1e1f'
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Sub-menu Color',
        'id' => 'submenu1_color',
        'desc' => '',
        'not_empty' => 'true',
        'default' => 'c8c9cc'
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Sub-menu 2nd Level Color',
        'id' => 'submenu2_color',
        'desc' => '',
        'not_empty' => 'true',
        'default' => 'a1a2a4'
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Sub-menu Active Color',
        'id' => 'submenu_act_color',
        'desc' => '',
        'not_empty' => 'true',
        'default' => 'ef969a'
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Sub-menu Border Color',
        'id' => 'submenu_border',
        'desc' => '',
        'not_empty' => 'true',
        'default' => '45484a'
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Sub-menu 2nd Level Border Color',
        'id' => 'submenu2_border',
        'desc' => '',
        'not_empty' => 'true',
        'default' => '45484a'
    )),
	
    new ColorOption_admin_theme(array(
        'name' => 'Sidebar Border',
        'id' => 'sidebar_border',
        'desc' => '',
        'not_empty' => 'true',
        'default' => 'e4e7e9'
    )),	
    new ColorOption_admin_theme(array(
        'name' => 'Footer Background',
        'id' => 'footer_bg',
        'desc' => '',
        'not_empty' => 'true',
        'default' => '1d1e1f'
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Footer Color',
        'id' => 'footer_color',
        'desc' => '',
        'not_empty' => 'true',
        'default' => 'c7cacc'
    ))

)));

?>