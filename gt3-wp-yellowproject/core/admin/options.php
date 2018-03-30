<?php

$gt3_tabs = new Tabs();

$gt3_tabs->add(new Tab(array(
    'name' => 'General',
    'desc' => '',
    'icon' => 'general.png',
    'icon_active' => 'general_active.png',
    'icon_hover' => 'general_hover.png'
), array(
    new UploadOption(array(
        'name' => 'Header logo',
        'id' => 'logo',
        'desc' => 'Default: 222px x 43px',
        'default' => THEMEROOTURL . '/img/logo.png'
    )),
    new UploadOption(array(
        'name' => 'Logo (Retina)',
        'id' => 'logo_retina',
        'desc' => 'Default: 444px x 86px',
        'default' => THEMEROOTURL . '/img/retina/logo.png'
    )),
    new textOption(array(
        'name' => 'Header logo width',
        'id' => 'header_logo_standart_width',
        'not_empty' => true,
        'width' => '100px',
        'textalign' => 'center',
        'default' => '222'
    )),
    new textOption(array(
        'name' => 'Header logo height',
        'id' => 'header_logo_standart_height',
        'not_empty' => true,
        'width' => '100px',
        'textalign' => 'center',
        'default' => '43'
    )),
    new UploadOption(array(
        'name' => 'Footer logo',
        'id' => 'logo_footer',
        'desc' => 'Default: 222px x 43px',
        'default' => THEMEROOTURL . '/img/logo_footer.png'
    )),
    new UploadOption(array(
        'name' => 'Footer logo (Retina)',
        'id' => 'footer_logo_retina',
        'desc' => 'Default: 444px x 86px',
        'default' => THEMEROOTURL . '/img/retina/logo_footer.png'
    )),
    new textOption(array(
        'name' => 'Footer logo width',
        'id' => 'footer_logo_standart_width',
        'not_empty' => true,
        'width' => '100px',
        'textalign' => 'center',
        'default' => '222'
    )),
    new textOption(array(
        'name' => 'Footer logo height',
        'id' => 'footer_logo_standart_height',
        'not_empty' => true,
        'width' => '100px',
        'textalign' => 'center',
        'default' => '43'
    )),
    new UploadOption(array(
        'type' => 'upload',
        'name' => 'Favicon',
        'id' => 'favicon',
        'desc' => 'Icon must be 16x16px or 32x32px',
        'default' => THEMEROOTURL . '/img/favicon.ico'
    )),
    new UploadOption(array(
        'type' => 'upload',
        'name' => 'Apple touch icon (57px)',
        'id' => 'apple_touch_57',
        'desc' => 'Icon must be 57x57px',
        'default' => THEMEROOTURL . '/img/apple_icons_57x57.png'
    )),
    new UploadOption(array(
        'type' => 'upload',
        'name' => 'Apple touch icon (72px)',
        'id' => 'apple_touch_72',
        'desc' => 'Icon must be 72x72px',
        'default' => THEMEROOTURL . '/img/apple_icons_72x72.png'
    )),
    new UploadOption(array(
        'type' => 'upload',
        'name' => 'Apple touch icon (114px)',
        'id' => 'apple_touch_114',
        'desc' => 'Icon must be 114x114px',
        'default' => THEMEROOTURL . '/img/apple_icons_114x114.png'
    )),
    new TextareaOption(array(
        'name' => 'Google analytics tracking code',
        'id' => 'google_analytics',
        'default' => ''
    )),
    new SelectOption(array(
        'name' => 'Related Posts',
        'id' => 'related_posts',
        'desc' => '',
        'default' => 'on',
        'options' => array(
            'on' => 'On',
            'off' => 'Off'
        )
    )),
    new AjaxButtonOption(array(
        'title' => 'Import Sample Data',
        'id' => 'action_import',
        'name' => 'Import demo content',
        'confirm' => TRUE,
        'data' => array(
            'action' => 'ajax_import_dump'
        )
    ))
)));


$gt3_tabs->add(new Tab(array(
    'name' => 'Sidebars',
    'desc' => '',
    'icon' => 'layout.png',
    'icon_active' => 'layout_active.png',
    'icon_hover' => 'layout_hover.png'
), array(
    new SelectOption(array(
        'name' => 'Default sidebar layout',
        'id' => 'default_sidebar_layout',
        'desc' => '',
        'default' => 'no-sidebar',
        'options' => array(
            'left-sidebar' => 'Left sidebar',
            'right-sidebar' => 'Right sidebar',
            'no-sidebar' => 'Without sidebar'
        )
    )),
    new SidebarManager(array(
        'name' => 'Sidebar manager',
        'id' => 'sidebar_manager',
        'desc' => ''
    ))
)));


$gt3_tabs->add(new Tab(array(
    'name' => 'Fonts',
    'desc' => '',
    'icon' => 'fonts.png',
    'icon_active' => 'fonts_active.png',
    'icon_hover' => 'fonts_hover.png'
), array(
    new FontSelector(array(
        'name' => 'Additional font',
        'id' => 'additional_font',
        'desc' => '',
        'default' => 'Oxygen',
        'options' => get_fonts_array_only_key_name()
    )),
    new FontSelector(array(
        'name' => 'Headers',
        'id' => 'text_headers_font',
        'desc' => '',
        'default' => 'Oxygen',
        'options' => get_fonts_array_only_key_name()
    )),
    new FontSelector(array(
        'name' => 'Content',
        'id' => 'main_content_font',
        'desc' => '',
        'default' => 'Arial',
        'options' => get_fonts_array_only_key_name()
    )),
    new textOption(array(
        'name' => 'H1 font size',
        'id' => 'h1_font_size',
        'not_empty' => true,
        'default' => '34px',
        'width' => '100px',
        'textalign' => 'center',
        'desc' => ''
    )),
    new textOption(array(
        'name' => 'H2 font size',
        'id' => 'h2_font_size',
        'not_empty' => true,
        'default' => '28px',
        'width' => '100px',
        'textalign' => 'center',
        'desc' => ''
    )),
    new textOption(array(
        'name' => 'H3 font size',
        'id' => 'h3_font_size',
        'not_empty' => true,
        'default' => '24px',
        'width' => '100px',
        'textalign' => 'center',
        'desc' => ''
    )),
    new textOption(array(
        'name' => 'H4 font size',
        'id' => 'h4_font_size',
        'not_empty' => true,
        'default' => '22px',
        'width' => '100px',
        'textalign' => 'center',
        'desc' => ''
    )),
    new textOption(array(
        'name' => 'H5 font size',
        'id' => 'h5_font_size',
        'not_empty' => true,
        'default' => '20px',
        'width' => '100px',
        'textalign' => 'center',
        'desc' => ''
    )),
    new textOption(array(
        'name' => 'H6 font size',
        'id' => 'h6_font_size',
        'not_empty' => true,
        'default' => '16px',
        'width' => '100px',
        'textalign' => 'center',
        'desc' => ''
    )),
    new textOption(array(
        'name' => 'Content font size',
        'id' => 'main_content_font_size',
        'not_empty' => true,
        'default' => '13px',
        'width' => '100px',
        'textalign' => 'center',
        'desc' => ''
    )),
    new textOption(array(
        'name' => 'Content line height',
        'id' => 'main_content_line_height',
        'not_empty' => true,
        'default' => '18px',
        'width' => '100px',
        'textalign' => 'center',
        'desc' => ''
    )),
)));


$gt3_tabs->add(new Tab(array(
    'name'        => 'Socials',
    'icon'    => 'social.png',
    'icon_active' => 'social_active.png',
    'icon_hover' => 'social_hover.png'
), array(
    new TextOption(array(
        'name'     => 'Facebook',
        'id'       => 'social_facebook',
        'default'  => 'http://facebook.com',
        'desc' => 'Please specify http:// to the URL'
    )),
    new TextOption(array(
        'name'     => 'Flickr',
        'id'       => 'social_flickr',
        'default'  => 'http://flickr.com',
        'desc' => 'Please specify http:// to the URL'
    )),
    new TextOption(array(
        'name'     => 'Vimeo',
        'id'       => 'social_vimeo',
        'default'  => 'http://vimeo.com',
        'desc' => 'Please specify http:// to the URL'
    )),
    new TextOption(array(
        'name'     => 'Pinterest',
        'id'       => 'social_pinterest',
        'default'  => 'http://pinterest.com',
        'desc' => 'Please specify http:// to the URL'
    )),
    new TextOption(array(
        'name'     => 'Dribbble',
        'id'       => 'social_dribbble',
        'default'  => 'http://dribbble.com',
        'desc' => 'Please specify http:// to the URL'
    )),
    new TextOption(array(
        'name'     => 'LinkedIn',
        'id'       => 'social_linked_in',
        'default'  => 'http://linkedin.com',
        'desc' => 'Please specify http:// to the URL'
    )),
    new TextOption(array(
        'name'     => 'Tumblr',
        'id'       => 'social_tumblr',
        'default'  => 'http://tumblr.com',
        'desc' => 'Please specify http:// to the URL'
    )),
    new TextOption(array(
        'name'     => 'YouTube',
        'id'       => 'social_youtube',
        'default'  => 'http://youtube.com',
        'desc' => 'Please specify http:// to the URL'
    )),
    new TextOption(array(
        'name'     => 'Delicious',
        'id'       => 'social_delicious',
        'default'  => 'http://delicious.com',
        'desc' => 'Please specify http:// to the URL'
    )),
    new TextOption(array(
        'name'     => 'Google Plus',
        'id'       => 'social_gplus',
        'default'  => 'http://google.com',
        'desc' => 'Please specify http:// to the URL'
    )),
    new TextOption(array(
        'name'     => 'Instagram',
        'id'       => 'social_instagram',
        'default'  => 'http://instagram.com',
        'desc' => 'Please specify http:// to the URL'
    )),
    new TextOption(array(
        'name' => 'Twitter',
        'id' => 'social_twitter',
        'default' => 'http://twitter.com',
        'desc' => 'Please specify http:// to the URL'
    )),
    new TextOption(array(
        'name' => 'Twitter Consumer key',
        'id' => 'consumer_key',
        'default' => '',
        'desc' => 'For Twitter widget. Get it <a target="_blank" href="https://dev.twitter.com/apps">here</a>.'
    )),
    new TextOption(array(
        'name' => 'Twitter Consumer secret',
        'id' => 'consumer_secret',
        'default' => '',
        'desc' => 'For Twitter widget. Get it <a target="_blank" href="https://dev.twitter.com/apps">here</a>.'
    )),
    new TextOption(array(
        'name' => 'Twitter User token',
        'id' => 'user_token',
        'default' => '',
        'desc' => 'For Twitter widget. Get it <a target="_blank" href="https://dev.twitter.com/apps">here</a>.'
    )),
    new TextOption(array(
        'name' => 'Twitter User secret',
        'id' => 'user_secret',
        'default' => '',
        'desc' => 'For Twitter widget. Get it <a target="_blank" href="https://dev.twitter.com/apps">here</a>.'
    )),
)));


$gt3_tabs->add(new Tab(array(
    'name' => 'Contacts',
    'icon' => 'contacts.png',
    'icon_active' => 'contacts_active.png',
    'icon_hover' => 'contacts_hover.png'
), array(
    new TextOption(array(
        'name' => 'Send mails to',
        'id' => 'contacts_to',
        'default' => get_option("admin_email")
    )),
    /*new SelectOption(array(
        'name'    => 'Captcha',
        'id'      => 'captcha_status',
        'desc'    => '',
        'default' => 'enabled',
        'options' => array(
            'disabled'  => 'Disabled',
            'enabled' => 'Enabled'
        )
    )),*/
    new TextOption(array(
        'name' => 'Phone number',
        'id' => 'phone',
        'default' => '+1 800 789 50 12'
    )),
)));


$gt3_tabs->add(new Tab(array(
    'name' => 'View Options',
    'icon' => 'colors.png',
    'icon_active' => 'colors_active.png',
    'icon_hover' => 'colors_hover.png'
), array(
    new ColorOption(array(
        'name' => 'Color scheme',
        'id' => 'color_scheme',
        'desc' => '',
        'not_empty' => 'true',
        'default' => 'ffd600'
    )),
    new ColorOption(array(
        'name' => 'Default background color',
        'id' => 'default_bg_color',
        'desc' => '',
        'not_empty' => 'true',
        'default' => 'ffffff'
    )),
    new UploadOption(array(
        'type'    => 'upload',
        'name'    => 'Default custom background image',
        'id'      => 'bg_img',
        'desc'    => '',
        'default' => THEMEROOTURL.'/img/bg_user.jpg'
    )),
    new SelectOption(array(
        'name' => 'Show background color by default',
        'id' => 'show_bg_color_by_default',
        'desc' => 'This is the default settings. But you can change the settings for the new pages using page builder background color option.',
        'default' => 'off',
        'options' => array(
            'on' => 'Yes',
            'off' => 'No'
        )
    )),
    new SelectOption(array(
        'name' => 'Breadcrumb',
        'id' => 'show_breadcrumb',
        'desc' => '',
        'default' => 'off',
        'options' => array(
            'on' => 'Yes',
            'off' => 'No'
        )
    )),
    new ColorOption(array(
        'name' => 'Footer background',
        'id' => 'footer_background_color',
        'desc' => '',
        'not_empty' => 'true',
        'default' => '3D3D3D'
    )),
    new ColorOption(array(
        'name' => 'Footer text color',
        'id' => 'footer_text_color',
        'desc' => '',
        'not_empty' => 'true',
        'default' => 'FFFFFF'
    )),
    new ColorOption(array(
        'name' => 'Content text color',
        'id' => 'content_text_color',
        'desc' => '',
        'not_empty' => 'true',
        'default' => '3D3D3D'
    )),
)));


/* TRANSLATOR */
$gt3_tabs->add(new Tab(array(
    'name' => 'Translator',
    'icon' => 'translator.png',
    'icon_active' => 'translator_active.png',
    'icon_hover' => 'translator_hover.png'
), array(
    new SelectOption(array(
        'name' => 'Custom translator status',
        'id' => 'translator_status',
        'desc' => 'If you want to use .po .mo files, please disable custom translator, otherwise you can use the custom translator below.',
        'default' => 'enable',
        'options' => array(
            'enable' => 'Enable',
            'disable' => 'Disable'
        )
    )),
    new textOption(array(
        'name' => 'Copyright',
        'id' => 'copyright',
        'not_empty' => false,
        'default' => '&copy; 2020 Companyname Wordpress Business Theme. All Rights Reserved.',
        'desc' => 'In footer'
    )),
    new textOption(array(
        'name'    => 'Call us',
        'id'      => 'call_us',
        'not_empty'      => false,
        'default' => 'call us toll free ',
        'desc'  => ''
    )),
    new textOption(array(
        'name' => 'Top slogan',
        'id' => 'translator_top_slogan',
        'not_empty' => false,
        'default' => 'Lorem ipsum dolor sit amet egestas '
    )),
    new textOption(array(
        'name' => 'Search',
        'id' => 'translator_search_value',
        'not_empty' => false,
        'default' => 'Search the site...'
    )),
    new textOption(array(
        'name' => 'Reply button',
        'id' => 'translator_reply_value',
        'not_empty' => false,
        'desc' => 'Comments',
        'default' => 'Reply'
    )),
    new textOption(array(
        'name' => 'Post Comment',
        'id' => 'post_comment',
        'not_empty' => false,
        'desc' => 'Comments',
        'default' => 'Post Comment'
    )),
    new textOption(array(
        'name' => 'Awaiting moderation',
        'id' => 'translator_awaiting_moder_value',
        'not_empty' => false,
        'desc' => 'Comments',
        'default' => 'Your comment is awaiting moderation.'
    )),
    new textOption(array(
        'name' => 'Clear',
        'id' => 'tranlator_clear',
        'not_empty' => false,
        'desc' => 'In all forms',
        'default' => 'Clear form'
    )),
    new textOption(array(
        'name' => 'Send comment',
        'id' => 'tranlator_send_message',
        'not_empty' => false,
        'desc' => 'In all forms',
        'default' => 'Send comment'
    )),
    new textOption(array(
        'name' => '404 header',
        'id' => 'translator_header_404',
        'not_empty' => false,
        'desc' => 'Error 404 page header',
        'default' => 'Not Found'
    )),
    new TextareaOption(array(
        'name' => '404 text',
        'id' => 'translator_text_404',
        'not_empty' => false,
        'desc' => 'Error 404 page text',
        'default' => 'Apologies, but we were unable to find what you were looking for. Perhaps searching will help.'
    )),
    new textOption(array(
        'name' => 'All items',
        'id' => 'translator_portfolio_all',
        'not_empty' => false,
        'desc' => 'Portfolio page (filter)',
        'default' => 'All'
    )),
    new textOption(array(
        'name' => 'Load more button',
        'id' => 'translator_load_more',
        'not_empty' => false,
        'desc' => 'Portfolio page',
        'default' => 'Load more works'
    )),
    new textOption(array(
        'name' => 'Feedback form name',
        'id' => 'translator_feedback_form_name',
        'not_empty' => false,
        'desc' => 'Contact form',
        'default' => 'Name *'
    )),
    new textOption(array(
        'name' => 'Feedback form email',
        'id' => 'translator_feedback_form_email',
        'not_empty' => false,
        'desc' => 'Contact form',
        'default' => 'Email *'
    )),
    new textOption(array(
        'name' => 'Feedback form subject',
        'id' => 'translator_feedback_form_subject',
        'not_empty' => false,
        'desc' => 'Contact form',
        'default' => 'Subject'
    )),
    new textOption(array(
        'name' => 'Feedback form message',
        'id' => 'translator_feedback_form_message',
        'not_empty' => false,
        'desc' => 'Contact form',
        'default' => 'Message *'
    )),
    new TextOption(array(
        'name' => 'Message subject',
        'id' => 'contacts_subject',
        'default' => '[Website] Contact Form'
    )),
    new TextareaOption(array(
        'name' => 'Thank you message',
        'id' => 'contacts_thanx',
        'default' => 'Thank you! Your message has been sent.'
    )),
    new textOption(array(
        'name' => 'Please fill the required field',
        'id' => 'fill_the_required_field',
        'not_empty' => false,
        'desc' => 'Contact page',
        'default' => 'Please fill the required field.'
    )),
    new textOption(array(
        'name' => 'Password protected',
        'id' => 'password_protected',
        'not_empty' => false,
        'desc' => '',
        'default' => 'This post is password protected. Enter the password to view comments.'
    )),
    new textOption(array(
        'name' => 'Comments',
        'id' => 'leave_a_comment',
        'not_empty' => false,
        'desc' => '',
        'default' => 'Leave a Comment!'
    )),
    new textOption(array(
        'name' => 'Logged in',
        'id' => 'you_must_logged_in',
        'not_empty' => false,
        'desc' => 'Comments',
        'default' => 'You must be logged in to post a comment.'
    )),
    new textOption(array(
        'name' => 'Logged in as',
        'id' => 'logged_in_as',
        'not_empty' => false,
        'desc' => 'Comments',
        'default' => 'Logged in as'
    )),
    new textOption(array(
        'name' => 'Log out',
        'id' => 'log_out',
        'not_empty' => false,
        'desc' => 'Comments',
        'default' => 'Log out?'
    )),
    new textOption(array(
        'name' => 'Comment form is closed',
        'id' => 'comment_form_is_closed',
        'not_empty' => false,
        'desc' => 'Comments',
        'default' => 'Sorry, the comment form is closed at this time.'
    )),
    new textOption(array(
        'name' => 'Comments',
        'id' => 'comments_number',
        'not_empty' => false,
        'desc' => '',
        'default' => 'Comments'
    )),
    new textOption(array(
        'name' => 'Posted by',
        'id' => 'posted_by',
        'not_empty' => false,
        'desc' => '',
        'default' => 'Posted by'
    )),
    new textOption(array(
        'name' => 'Read more',
        'id' => 'read_more_link',
        'not_empty' => false,
        'desc' => 'All pages',
        'default' => 'Read more...'
    )),
    new textOption(array(
        'name' => 'Tags',
        'id' => 'tags_caption',
        'not_empty' => false,
        'desc' => '',
        'default' => 'Tags: '
    )),
    new textOption(array(
        'name' => 'Name',
        'id' => 'comment_form_name',
        'not_empty' => false,
        'desc' => 'Comment form',
        'default' => 'Name *'
    )),
    new textOption(array(
        'name' => 'Email',
        'id' => 'comment_form_email',
        'not_empty' => false,
        'desc' => 'Comment form',
        'default' => 'Email *'
    )),
    new textOption(array(
        'name' => 'URL',
        'id' => 'comment_form_url',
        'not_empty' => false,
        'desc' => 'Comment form',
        'default' => 'URL'
    )),
    new textOption(array(
        'name' => 'Message',
        'id' => 'comment_form_message',
        'not_empty' => false,
        'desc' => 'Comment form',
        'default' => 'Message...'
    )),
    new textOption(array(
        'name' => 'Back button',
        'id' => 'back_button',
        'not_empty' => false,
        'desc' => 'Portfolio page',
        'default' => 'Back'
    )),
    new textOption(array(
        'name' => 'Pages',
        'id' => 'translate_pages',
        'not_empty' => false,
        'desc' => '',
        'default' => 'Pages'
    )),
    new textOption(array(
        'name' => 'Related Projects',
        'id' => 'translate_related_projects',
        'not_empty' => true,
        'desc' => '',
        'default' => 'Related Projects'
    )),
    new textOption(array(
        'name' => 'Related Posts',
        'id' => 'translate_related_posts',
        'not_empty' => true,
        'desc' => '',
        'default' => 'Related Posts'
    )),
)));

?>