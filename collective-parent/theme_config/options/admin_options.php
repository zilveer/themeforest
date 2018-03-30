<?php

/* ----------------------------------------------------------------------------------- */
/* Initializes all the theme settings option fields for admin area. */
/* ----------------------------------------------------------------------------------- */

$options = array(
    'tabs' => array(
        array(
            'name' => __('General','tfuse'),
            'type' => 'tab',
            'id' => TF_THEME_PREFIX . '_general',
            'headings' => array(
                array(
                    'name' => __('General Settings','tfuse'),
                    'options' => array(/* 1 */
                        // Custom Logo Option
                        array(
                            'name' => __('Select logo type','tfuse'),
                            'desc' => __('Select logo type.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_logo_type',
                            'value' => 'image',
                            'options' => array('image' => __('Image','tfuse'), 'text' => __('Text','tfuse')),
                            'type' => 'select'
                        ),
                        array(
                            'name' => __('Custom Logo','tfuse'),
                            'desc' => __('Upload a logo for your theme, or specify the image address of your online logo. (http://yoursite.com/logo.png)','tfuse'),
                            'id' => TF_THEME_PREFIX . '_logo',
                            'value' => '',
                            'type' => 'upload'
                        ),
                        array(
                            'name' => __('Text Logo','tfuse'),
                            'desc' => __('Enter the text for logo.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_text_logo',
                            'value' => 'Collective',
                            'type' => 'text',
                            'divider' => true
                        ),
                        // Custom Favicon Option
                        array(
                            'name' => __('Custom Favicon <br /> (16px x 16px)','tfuse'),
                            'desc' => __('Upload a 16px x 16px Png/Gif image that will represent your website\'s favicon.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_favicon',
                            'value' => '',
                            'type' => 'upload',
                            'divider' => true
                        ),
                        // Search Box Text
                        array(
                            'name' => __('Search Box text','tfuse'),
                            'desc' => __('Enter your Search Box text','tfuse'),
                            'id' => TF_THEME_PREFIX . '_search_box_text',
                            'value' => 'enter keywords',
                            'type' => 'text',
                            'divider' => true
                        ),
                        // Color 1
                        array(
                            'name' => __('Primary Color','tfuse'),
                            'desc' => __('This will change the color of certain elements and links in order to give your theme a different flavor','tfuse'),
                            'id' => TF_THEME_PREFIX . '_color1',
                            'value' => '#669966',
                            'type' => 'colorpicker',
                            'divider' => true
                        ),
                        // Color 2
                        array(
                            'name' => __('Secondary Color','tfuse'),
                            'desc' => __('This controls the text color that appears over the theme color','tfuse'),
                            'id' => TF_THEME_PREFIX . '_color2',
                            'value' => '#bfdcbf',
                            'type' => 'colorpicker',
                            'divider' => true
                        ),
                         // Change default avatar
                        array(
                            'name' => __('Default Avatar','tfuse'),
                            'desc' => __('For users without a custom avatar of their own, you can either display a generic logo or a generated one based on their e-mail address.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_default_avatar',
                            'value' => '',
                            'type' => 'upload',
                            'divider' => true
                        ),
                        // Tracking Code Option
                        array(
                            'name' => __('Tracking Code','tfuse'),
                            'desc' => __('Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_google_analytics',
                            'value' => '',
                            'type' => 'textarea',
                            'divider' => true
                        ),
                        // Custom CSS Option
                        array(
                            'name' => __('Custom CSS','tfuse'),
                            'desc' => __('Quickly add some CSS to your theme by adding it to this block.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_custom_css',
                            'value' => '',
                            'type' => 'textarea'
                        )
                    ) /* E1 */
                ),
                array(
                    'name' => __('RSS Settings','tfuse'),
                    'options' => array(
                        // RSS URL Options
                        array('name' => __('RSS URL','tfuse'),
                            'desc' => __('Enter your preferred RSS URL. (Feedburner or other)','tfuse'),
                            'id' => TF_THEME_PREFIX . '_feedburner_url',
                            'value' => '',
                            'type' => 'text',
                            'divider' => true
                        ),
                        // E-Mail URL Option
                        array('name' => __('E-Mail URL','tfuse'),
                            'desc' => __('Enter your preferred E-mail subscription URL. (Feedburner or other)','tfuse'),
                            'id' => TF_THEME_PREFIX . '_feedburner_id',
                            'value' => '',
                            'type' => 'text'
                        ),
                    )
                ),
                array(
                    'name' => __('Twitter','tfuse'),
                    'options' => array(
                        array(
                            'name' => __('Consumer Key','tfuse'),
                            'desc' => __('Set your <a href="http://screencast.com/t/zHu17C7nXy1">twitter</a> application <a href="http://screencast.com/t/yb44HiF2NZ">consumer key</a>.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_twitter_consumer_key',
                            'value' => 'XW7t8bECoR6ogYtUDNdjiQ',
                            'type' => 'text',
                            'divider' => true
                        ),
                        array(
                            'name' => __('Consumer Secret','tfuse'),
                            'desc' => __('Set your <a href="http://screencast.com/t/zHu17C7nXy1">twitter</a> application <a href="http://screencast.com/t/eaKJHG1omN">consumer secret key</a>.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_twitter_consumer_secret',
                            'value' => 'Z7UzuWU8a4obyOOlIguuI4a5JV4ryTIPKZ3POIAcJ9M',
                            'type' => 'text',
                            'divider' => true
                        ),
                        array(
                            'name' => __('User Token','tfuse'),
                            'desc' => __('Set your <a href="http://screencast.com/t/zHu17C7nXy1">twitter</a> application <a href="http://screencast.com/t/QEEG2O4H">access token key</a>.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_twitter_user_token',
                            'value' => '1510587853-ugw6uUuNdNMdGGDn7DR4ZY4IcarhstIbq8wdDud',
                            'type' => 'text',
                            'divider' => true
                        ),
                        array(
                            'name' => __('User Secret','tfuse'),
                            'desc' => __('Set your <a href="http://screencast.com/t/zHu17C7nXy1">twitter</a>  application <a href="http://screencast.com/t/Yv7nwRGsz">access token secret key</a>.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_twitter_user_secret',
                            'value' => '7aNcpOUGtdKKeT1L72i3tfdHJWeKsBVODv26l9C0Cc',
                            'type' => 'text'
                        )
                    )
                ),
                array(
                    'name' => __('Enable Theme Settings','tfuse'),
                    'options' => array(
                        // Enable Image for All Single Posts
                        array('name' => __('Image on Single Post','tfuse'),
                            'desc' => __('Enable Image on All Single Posts? These settings may be overridden for individual articles.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_enable_image',
                            'value' => true,
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Enable Video for All Single Posts
                        array('name' => __('Video on Single Post','tfuse'),
                            'desc' => __('Enable Video on All Single Posts? These settings may be overridden for individual articles.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_enable_video',
                            'value' => true,
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Enable Comments for All Pages
                        array('name' => __('Page Comments','tfuse'),
                            'desc' => __('Enable Comments for All Pages? These settings may be overridden for individual articles.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_enable_pages_comments',
                            'value' => false,
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Enable Comments for All Posts
                        array('name' => __('Post Comments','tfuse'),
                            'desc' => __('Enable Comments for All Posts? These settings may be overridden for individual articles.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_enable_posts_comments',
                            'value' => true,
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Enable Comments for All Services
                        array('name' => __('Services Comments','tfuse'),
                            'desc' => __('Enable Comments for All Services? These settings may be overridden for individual articles.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_enable_services_comments',
                            'value' => true,
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Enable Post Meta
                        array('name' => __('Post meta','tfuse'),
                            'desc' => __('Enable Post meta? These settings may be overridden for individual articles.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_enable_post_meta',
                            'value' => true,
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Enable Author Post
                        array('name' => __('Author Post','tfuse'),
                            'desc' => __('Enable Author Post? These settings may be overridden for individual articles.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_enable_author_post',
                            'value' => true,
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        array('name' => __('Portfolio Likes','tfuse'),
                            'desc' => __('Enable Post Likes? These settings may be overridden for individual articles.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_enable_portfolio_likes',
                            'value' => true,
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        array('name' => __('Portfolio Views','tfuse'),
                            'desc' => __('Enable Post Views? These settings may be overridden for individual articles.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_enable_portfolio_views',
                            'value' => true,
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        array('name' => __('Date','tfuse'),
                            'desc' => __('Enable Date?','tfuse'),
                            'id' => TF_THEME_PREFIX . '_date_time',
                            'value' => true,
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Enable Post Published Date
                        array('name' => __('Post Published Date','tfuse'),
                            'desc' => __('Enable Post Published Date? These settings may be overridden for individual articles.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_enable_published_date',
                            'value' => true,
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Enable posts lightbox (prettyPhoto) Option
                        array('name' => __('prettyPhoto on Categories','tfuse'),
                            'desc' => __('Enable opening image and attachemnts in prettyPhoto on Categories listings? If YES, image link go to post.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_enable_listing_lightbox',
                            'value' => true,
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Enable posts lightbox (prettyPhoto) Option
                        array('name' => __('prettyPhoto on Single Post','tfuse'),
                            'desc' => __('Enable opening image and attachemnts in prettyPhoto on Single Post?','tfuse'),
                            'id' => TF_THEME_PREFIX . '_enable_single_lightbox',
                            'value' => true,
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Enable preloadCssImages plugin
                        array('name' => __('preloadCssImages','tfuse'),
                            'desc' => __('Enable jQuery-Plugin "preloadCssImages"? This plugin loads automatic all images from css.If you prefer performance(less requests) deactivate this plugin','tfuse'),
                            'id' => TF_THEME_PREFIX . '_enable_preload_css',
                            'value' => true,
                            'type' => 'checkbox',
                            'on_update' => 'reload_page',
                            'divider' => true
                        ),
						array('name' => __('Image from content','tfuse'),
                            'desc' => __('If no thumbnail is specified then the first uploaded image in the post is used.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_enable_content_img',
                            'value' => false,
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Disable Dynamic Image Resizer Option
                        array('name' => __('Dynamic Image Resizer','tfuse'),
                            'desc' => __('This will Enable the thumb.php script that dynamicaly resizes images on your site. We recommend you keep this enabled, however note that for this to work you need to have "GD Library" installed on your server. This should be done by your hosting server administrator.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_disable_resize',
                            'value' => false,
                            'type' => 'checkbox',
                            'divider'   => true
                        ),
                        // Disable SEO
                        array('name' => __('SEO Tab','tfuse'),
                            'desc' => __('Disable SEO option?','tfuse'),
                            'id' => TF_THEME_PREFIX . '_disable_tfuse_seo_tab',
                            'value' => false,
                            'type' => 'checkbox',
                            'on_update' => 'reload_page',
                            'divider' => true
                        ),
                        // Remove wordpress versions for security reasons
                        array(
                            'name' => __('Remove Wordpress Versions','tfuse'),
                            'desc' => __('Remove Wordpress versions from the source code, for security reasons.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_remove_wp_versions',
                            'value' => false,
                            'type' => 'checkbox'
                        )
                    )
                ),
                array(
                    'name' => __('WordPress Admin Style','tfuse'),
                    'options' => array(
                        // Disable Themefuse Style
                        array('name' => __('Disable Themefuse Style','tfuse'),
                            'desc' => __('Disable Themefuse Style','tfuse'),
                            'id' => TF_THEME_PREFIX . '_deactivate_tfuse_style',
                            'value' => 'false',
                            'type' => 'checkbox',
                            'on_update' => 'reload_page'
                        )
                    )
                )
            )
        ),
        array(
            'name' => __('Homepage','tfuse'),
            'id' => TF_THEME_PREFIX . '_homepage',
            'headings' => array(
                array(
                    'name' => __('Homepage Population','tfuse'),
                    'options' => array(
                        array('name' => __('Homepage Population','tfuse'),
                            'desc' => __('Select which categories to display on homepage. More over you can choose to load a specific page or change the number of posts on the homepage from <a target="_blank" href="' . network_admin_url('options-reading.php') . '">here</a>','tfuse'),
                            'id' => TF_THEME_PREFIX . '_homepage_category',
                            'value' => '',
                            'options' => array('all' => 'From All Categories', 'specific' => 'From Specific Categories','page' =>'From Specific Page','all_tax' => 'From All Portfolios', 'specific_tax' => 'From Specific Portfolio'),
                            'type' => 'select',
                            'install' => 'cat'
                        ),
                        array(
                            'name' => __('Select specific categories to display on homepage','tfuse'),
                            'desc' => __('Pick one or more categories by starting to type the category name.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_categories_select_categ',
                            'type' => 'multi',
                            'subtype' => 'category',
                        ),
                        array(
                            'name' => __('Select specific portfolio to display on homepage','tfuse'),
                            'desc' => __('Pick one or more categories by starting to type the portfolio name.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_categories_select_tax',
                            'type' => 'multi',
                            'subtype' => 'group',
                        ),
                        // page on homepage
                        array('name' => __('Select Page','tfuse'),
                            'desc' => __('Select the page','tfuse'),
                            'id' => TF_THEME_PREFIX . '_home_page',
                            'value' => 'image',
                            'options' => tfuse_list_page_options(),
                            'type' => 'select',
                        ),
                        array('name' => __('Use page options','tfuse'),
                            'desc' => __('Use page options','tfuse'),
                            'id' => TF_THEME_PREFIX . '_use_page_options',
                            'value' => false,
                            'type' => 'checkbox'
                        ),
                        // Columns
                        array('name' => __('Columns','tfuse'),
                            'desc' => __('Select column type of portfolio.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_portfolio_column',
                            'value' => '2',
                            'options' => array('2' => __('Two Columns','tfuse'), '3' => __('Three Columns','tfuse')),
                            'type' => 'select'
                        ),
                        // Show filter
                        array('name' => __('Show filter ?','tfuse'),
                            'desc' => __('Show filter for portfolio ?','tfuse'),
                            'id' => TF_THEME_PREFIX . '_show_filter',
                            'value' => true,
                            'type' => 'checkbox'
                        ),
                    )
                ),
                array(
                    'name' => __('Homepage Header','tfuse'),
                    'options' => array(
                        // Element of Header
                        array('name' => __('Header Element','tfuse'),
                            'desc' => __('Select what do you want in your post header','tfuse'),
                            'id' => TF_THEME_PREFIX . '_header_element',
                            'value' => 'none',
                            'options' => array('none' => __('Without Element','tfuse'), 'image' => __('Image','tfuse'), 'slider' => __('Slider','tfuse'), 'full_slider' => __('Full Slider','tfuse'), 'map' => __('Map','tfuse')),
                            'type' => 'select',
                        ),
                        // Image of Header
                        array('name' => __('Image','tfuse'),
                            'desc' => __('Upload an image for your header, or specify the image address of your online image. (http://yoursite.com/image.png)','tfuse'),
                            'id' => TF_THEME_PREFIX . '_header_image',
                            'value' => '',
                            'type' => 'upload',
                        ),
                        // Select Slider
                        $this->ext->slider->model->has_sliders() ?
                            array(
                                'name' => __('Slider','tfuse'),
                                'desc' => __('Select a slider for your post. The sliders are created on the <a href="' . admin_url( 'admin.php?page=tf_slider_list' ) . '" target="_blank">Sliders page</a>.','tfuse'),
                                'id' => TF_THEME_PREFIX . '_select_slider',
                                'value' => '',
                                'options' => $TFUSE->ext->slider->get_sliders_dropdown(array('image_video','fullbanner','featured')),
                                'type' => 'select'
                            ) :
                            array(
                                'name' => __('Slider','tfuse'),
                                'desc' => '',
                                'id' => TF_THEME_PREFIX . '_select_slider',
                                'value' => '',
                                'html' => __('No sliders created yet. You can start creating one <a href="' . admin_url('admin.php?page=tf_slider_list') . '">here</a>.','tfuse'),
                                'type' => 'raw'
                            ),
                        // Select After Header Slider
                        $this->ext->slider->model->has_sliders() ?
                            array(
                                'name' => __('Full Slider','tfuse'),
                                'desc' => __('Select a slider for your post. The sliders are created on the <a href="' . admin_url( 'admin.php?page=tf_slider_list' ) . '" target="_blank">Sliders page</a>.','tfuse'),
                                'id' => TF_THEME_PREFIX . '_select_slider_after_header',
                                'value' => '',
                                'options' => $TFUSE->ext->slider->get_sliders_dropdown('carousel'),
                                'type' => 'select'
                            ) :
                            array(
                                'name' => __('Full Slider','tfuse'),
                                'desc' => '',
                                'id' => TF_THEME_PREFIX . '_select_slider_after_header',
                                'value' => '',
                                'html' => __('No sliders created yet. You can start creating one <a href="' . admin_url('admin.php?page=tf_slider_list') . '">here</a>.','tfuse'),
                                'type' => 'raw'
                            ),
                        //map on header
                        array(
                            'name' => __('Map position','tfuse'),
                            'desc' => '',
                            'value' => '',
                            'id' => TF_THEME_PREFIX . '_page_map',
                            'type' => 'maps'
                        ),
                        array(
                            'name' => __('Text','tfuse'),
                            'desc'=> __('Enter the text for location.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_map_text',
                            'value' => 'We are here',
                            'type' => 'text'
                        ),
                        array(
                            'name' => __('Zoom','tfuse'),
                            'desc'=> __('Enter the zoom of map.Ex: 13, 14, 15','tfuse'),
                            'id' => TF_THEME_PREFIX . '_map_zoom',
                            'value' => '13',
                            'type' => 'text'
                        ),
                    )
                ),
                array(
                    'name' => __('Homepage Elements','tfuse'),
                    'options' => array(
                        // Page Title
                        array('name' => __('Title','tfuse'),
                            'desc' => __('Select your preferred Page Title.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_page_title',
                            'value' => 'default_title',
                            'options' => array('hide_title' => __('Hide Title','tfuse'), 'custom_title' => __('Custom Title','tfuse')),
                            'type' => 'select'
                        ),
                        // Custom Title
                        array('name' => __('Custom Title','tfuse'),
                            'desc' => __('Enter your custom title for this page.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_custom_title',
                            'value' => '',
                            'type' => 'text'
                        ),
                        // Custom Subtitle
                        array('name' => __('Custom Subtitle','tfuse'),
                            'desc' => __('Enter your custom subtitle for this page.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_custom_subtitle',
                            'value' => '',
                            'type' => 'text'
                        ),
                        // Subtitle alignment
                        array('name' => __('Subtitle Alignment','tfuse'),
                            'desc' => __('Select your preferred Subtitle Alignment.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_subtitle_alignment',
                            'value' => 'right',
                            'options' => array('right' => __('Right','tfuse'), 'center' => __('Center','tfuse')),
                            'type' => 'select',
                            'divider' => true
                        ),
                        // Top Shortcodes
                        array('name' => __('Shortcodes before Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_content_top',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                        // Element of Footer
                        array('name' => __('Element of Content','tfuse'),
                            'desc' => __('Select type of element on the footer.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_footer_element',
                            'value' => 'none',
                            'options' => array('none' => __('Without Content Element','tfuse'), 'slider' => __('Slider','tfuse')),
                            'type' => 'select',
                        ),
                        // Select Footer Slider
                        $this->ext->slider->model->has_sliders() ?
                            array(
                                'name' => __('Slider','tfuse'),
                                'desc' => __('Select a slider for your post. The sliders are created on the <a href="' . admin_url( 'admin.php?page=tf_slider_list' ) . '" target="_blank">Sliders page</a>.','tfuse'),
                                'id' => TF_THEME_PREFIX . '_select_slider_footer',
                                'value' => '',
                                'options' => $TFUSE->ext->slider->get_sliders_dropdown('carousel'),
                                'type' => 'select'
                            ) :
                            array(
                                'name' => __('Slider','tfuse'),
                                'desc' => '',
                                'id' => TF_THEME_PREFIX . '_select_slider_footer',
                                'value' => '',
                                'html' => __('No sliders created yet. You can start creating one <a href="' . admin_url('admin.php?page=tf_slider_list') . '">here</a>.','tfuse'),
                                'type' => 'raw'
                            ),
                        // Bottom Shortcodes
                        array('name' => __('Shortcodes After Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_content_bottom',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                    )
                ),
                array(
                    'name' => __('Homepage Background','tfuse'),
                    'options' => array(
                        // Background Image
                        array('name' => __('Background Image','tfuse'),
                            'desc' => __('Upload an image for your background.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_background_image',
                            'value' => '',
                            'type' => 'upload',
                        ),
                        // Repeat Image
                        array('name' => __('Repeat Image','tfuse'),
                            'desc' => __('Select type for repeat image.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_repeat_image',
                            'value' => '',
                            'options' => array('' => 'repeat-x repeat-y', 'no-repeat' => 'no-repeat', 'repeat-x' => 'repeat-x', 'repeat-y' => 'repeat-y'),
                            'type' => 'select',
                            'divider' =>true
                        ),
                        // Background-color
                        array('name' => __('Background-color','tfuse'),
                            'desc' => __('Enter background-color ex: #ccc','tfuse'),
                            'id' => TF_THEME_PREFIX . '_background_color',
                            'value' => '',
                            'type' => 'colorpicker',
                        ),
                        // Background-position
                        array('name' => __('Background-position','tfuse'),
                            'desc' => __('Enter background-position ex: center top','tfuse'),
                            'id' => TF_THEME_PREFIX . '_background_position',
                            'value' => '',
                            'type' => 'text',
                            'divider' =>true
                        ),
                    )
                ),
                array(
                    'name' => __('Homepage Banners','tfuse'),
                    'options' => array(
                        //top ad
                        array('name' => __('Enable 728x90 Banner','tfuse'),
                            'desc' => __('Enable the top banner ad space. Note: you can set a specific banner for all categories and posts in the <a href="' . admin_url('admin.php?page=themefuse') . '">theme framowork options</a>','tfuse'),
                            'id' => TF_THEME_PREFIX . '_home_top_ad_space',
                            'value' => 'false',
                            'options' => array('false' => __('No','tfuse'), 'true' => __('Yes','tfuse')),
                            'type' => 'select',
                        ),
                        array(
                            'name'=>__('Ad Image(728px x 90px)','tfuse'),
                            'desc'=>__('Enter the URL to the ad image 728x90 location','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_top_ad_image',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL','tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_top_ad_url',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense Code','tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_top_ad_adsense',
                            'value' => '',
                            'type' =>'textarea',
                            'divider' => true
                        ),
                        //Advertising
                        array('name' => __('Enable 125x125 Banners','tfuse'),
                            'desc' => __('Enable before content banner space. Note: you can set specific banners for all categories and posts in the <a href="' . admin_url('admin.php?page=themefuse') . '">theme framowork options</a>','tfuse'),
                            'id' => TF_THEME_PREFIX . '_home_bfcontent_ads_space',
                            'value' => 'false',
                            'options' => array('false' => __('No','tfuse'), 'true' => __('Yes','tfuse')),
                            'type' => 'select'
                        ),
                        array('name' => __('Type of Ads','tfuse'),
                            'desc' => __('Choose the type of your adds.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_home_bfcontent_type',
                            'value' => 'image',
                            'options' => array('image' => __('Image Type','tfuse'), 'adsense' => __('Adsense Type','tfuse')),
                            'type' => 'select'
                        ),
                        array('name' => __('No of 125x125 Ads','tfuse'),
                            'desc' => __('Choose the numbers of ads to display before content.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_home_bfcontent_number',
                            'value' => '7',
                            'options' => array('one' => '1', 'two' => '2' , 'three' => '3', 'four' => '4', 'five' => '5', 'six' => '6', 'seven' => '7'),
                            'type' => 'select'
                        ),
                        array(
                            'name'=>__('Ad Image (125px x 125px)','tfuse'),
                            'desc'=>__('Enter the URL to the ad image 125x125 location','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_image1',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL','tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_url1',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense Code for Before Content Ads','tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_adsense1',
                            'value' => '',
                            'type' =>'textarea'
                        ),
                        array(
                            'name'=>__('Ad Image (125px x 125px)','tfuse'),
                            'desc'=>__('Enter the URL to the ad image 125x125 location','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_image2',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL','tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_url2',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense Code for Before Content Ads','tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_adsense2',
                            'value' => '',
                            'type' =>'textarea'
                        ),
                        array(
                            'name'=>__('Ad Image (125px x 125px)','tfuse'),
                            'desc'=>__('Enter the URL to the ad image 125x125 location','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_image3',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL','tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_url3',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense Code for Before Content Ads','tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_adsense3',
                            'value' => '',
                            'type' =>'textarea'
                        ),
                        array(
                            'name'=>__('Ad Image (125px x 125px)','tfuse'),
                            'desc'=>__('Enter the URL to the ad image 125x125 location','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_image4',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL','tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_url4',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense Code for Before Content Ads','tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_adsense4',
                            'value' => '',
                            'type' =>'textarea'
                        ),
                        array(
                            'name'=>__('Ad Image (125px x 125px)','tfuse'),
                            'desc'=>__('Enter the URL to the ad image 125x125 location','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_image5',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL','tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_url5',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense Code for Before Content Ads','tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_adsense5',
                            'value' => '',
                            'type' =>'textarea'
                        ),
                        array(
                            'name'=>__('Ad Image (125px x 125px)','tfuse'),
                            'desc'=>__('Enter the URL to the ad image 125x125 location','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_image6',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL','tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_url6',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense Code for Before Content Ads','tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_adsense6',
                            'value' => '',
                            'type' =>'textarea'
                        ),
                        array(
                            'name'=>__('Ad Image (125px x 125px)','tfuse'),
                            'desc'=>__('Enter the URL to the ad image 125x125 location','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_image7',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL','tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_url7',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense Code for Before Content Ads','tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_bfcontent_ads_adsense7',
                            'value' => '',
                            'type' =>'textarea',
                            'divider' => true
                        ),
                        //hook manager
                        array('name' => __('Enable 468x60 Banner','tfuse'),
                            'desc' => __('Enable after content banner space. Note: you can set a specific banner for all categories and posts in the <a href="' . admin_url('admin.php?page=themefuse') . '">theme framowork options</a>','tfuse'),
                            'id' => TF_THEME_PREFIX . '_home_hook_space',
                            'value' => 'false',
                            'options' => array('false' => __('No','tfuse'), 'true' => __('Yes','tfuse')),
                            'type' => 'select',
                        ),
                        array(
                            'name'=>__('Ad Image(468px x 60px)','tfuse'),
                            'desc'=>__('Enter the URL to the ad image 468x60 location','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_hook_image',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL','tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_hook_url',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense Code','tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_home_hook_adsense',
                            'value' => '',
                            'type' =>'textarea',
                        )
                    )
                ),
            )
        ),
        array(
            'name' => __('Blog','tfuse'),
            'id' => TF_THEME_PREFIX . '_blogpage',
            'headings' => array(
                array(
                    'name' => __('Blog Page Population','tfuse'),
                    'options' => array(
                        array('name' => __('Select Page','tfuse'),
                            'desc' => __('Select the page','tfuse'),
                            'id' => TF_THEME_PREFIX . '_blog_page',
                            'value' => '',
                            'options' => tfuse_list_page_options(),
                            'type' => 'select',
                        ),
                        array('name' => __('Blog Page Population','tfuse'),
                            'desc' => __('Select which categories to display on blog page. More over you can choose to load a specific page or change the number of posts on the blog page from <a target="_blank" href="' . network_admin_url('options-reading.php') . '">here</a>','tfuse'),
                            'id' => TF_THEME_PREFIX . '_blogpage_category',
                            'value' => '',
                            'options' => array('all' => 'From All Categories', 'specific' => 'From Specific Categories','all_tax' => 'From All Portfolios', 'specific_tax' => 'From Specific Portfolio'),
                            'type' => 'select',
                            'install' => 'cat'
                        ),
                        array(
                            'name' => __('Select specific categories to display on blog page','tfuse'),
                            'desc' => __('Pick one or more categories by starting to type the category name.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_categories_select_categ_blog',
                            'type' => 'multi',
                            'subtype' => 'category',
                        ),
                        array(
                            'name' => __('Select specific portfolio to display on blog page','tfuse'),
                            'desc' => __('Pick one or more categories by starting to type the portfolio name.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_categories_select_tax_blog',
                            'type' => 'multi',
                            'subtype' => 'group'
                        ),
                        // Columns
                        array('name' => __('Columns','tfuse'),
                            'desc' => __('Select column type of portfolio.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_portfolio_column_blog',
                            'value' => '2',
                            'options' => array('2' => __('Two Columns','tfuse'), '3' => __('Three Columns','tfuse')),
                            'type' => 'select'
                        ),
                        // Show filter
                        array('name' => __('Show filter ?','tfuse'),
                            'desc' => __('Show filter for portfolio ?','tfuse'),
                            'id' => TF_THEME_PREFIX . '_show_filter_blog',
                            'value' => true,
                            'type' => 'checkbox'
                        ),
                    )
                ),
                array(
                    'name' => __('Blog Page Header','tfuse'),
                    'options' => array(
                        // Element of Header
                        array('name' => __('Header Element','tfuse'),
                            'desc' => __('Select what do you want in your post header','tfuse'),
                            'id' => TF_THEME_PREFIX . '_header_element_blog',
                            'value' => 'none',
                            'options' => array('none' => __('Without Element','tfuse'), 'image' => __('Image','tfuse'), 'slider' => __('Slider','tfuse'), 'full_slider' => __('Full Slider','tfuse'), 'map' => __('Map','tfuse')),
                            'type' => 'select',
                        ),
                        // Image of Header
                        array('name' => __('Image','tfuse'),
                            'desc' => __('Upload an image for your header, or specify the image address of your online image. (http://yoursite.com/image.png)','tfuse'),
                            'id' => TF_THEME_PREFIX . '_header_image_blog',
                            'value' => '',
                            'type' => 'upload',
                        ),
                        // Select Slider
                        $this->ext->slider->model->has_sliders() ?
                            array(
                                'name' => __('Slider','tfuse'),
                                'desc' => __('Select a slider for your post. The sliders are created on the <a href="' . admin_url( 'admin.php?page=tf_slider_list' ) . '" target="_blank">Sliders page</a>.','tfuse'),
                                'id' => TF_THEME_PREFIX . '_select_slider_blog',
                                'value' => '',
                                'options' => $TFUSE->ext->slider->get_sliders_dropdown(array('image_video','fullbanner','featured')),
                                'type' => 'select'
                            ) :
                            array(
                                'name' => __('Slider','tfuse'),
                                'desc' => '',
                                'id' => TF_THEME_PREFIX . '_select_slider_blog',
                                'value' => '',
                                'html' => __('No sliders created yet. You can start creating one <a href="' . admin_url('admin.php?page=tf_slider_list') . '">here</a>.','tfuse'),
                                'type' => 'raw'
                            ),
                        // Select After Header Slider
                        $this->ext->slider->model->has_sliders() ?
                            array(
                                'name' => __('Full Slider','tfuse'),
                                'desc' => __('Select a slider for your post. The sliders are created on the <a href="' . admin_url( 'admin.php?page=tf_slider_list' ) . '" target="_blank">Sliders page</a>.','tfuse'),
                                'id' => TF_THEME_PREFIX . '_select_slider_after_header_blog',
                                'value' => '',
                                'options' => $TFUSE->ext->slider->get_sliders_dropdown('carousel'),
                                'type' => 'select'
                            ) :
                            array(
                                'name' => __('Full Slider','tfuse'),
                                'desc' => '',
                                'id' => TF_THEME_PREFIX . '_select_slider_after_header_blog',
                                'value' => '',
                                'html' => __('No sliders created yet. You can start creating one <a href="' . admin_url('admin.php?page=tf_slider_list') . '">here</a>.','tfuse'),
                                'type' => 'raw'
                            ),
                        //map on header
                        array(
                            'name' => __('Map position','tfuse'),
                            'desc' => '',
                            'value' => '',
                            'id' => TF_THEME_PREFIX . '_page_map_blog',
                            'type' => 'maps'
                        ),
                        array(
                            'name' => __('Text','tfuse'),
                            'desc'=> __('Enter the text for location.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_map_text_blog',
                            'value' => 'We are here',
                            'type' => 'text'
                        ),
                        array(
                            'name' => __('Zoom','tfuse'),
                            'desc'=> __('Enter the zoom of map.Ex: 13, 14, 15','tfuse'),
                            'id' => TF_THEME_PREFIX . '_map_zoom_blog',
                            'value' => '13',
                            'type' => 'text'
                        ),
                    )
                ),
                array(
                    'name' => __('Blog Page Elements','tfuse'),
                    'options' => array(
                        // Page Title
                        array('name' => __('Title','tfuse'),
                            'desc' => __('Select your preferred Page Title.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_page_title_blog',
                            'value' => 'hide_title',
                            'options' => array('hide_title' => __('Hide Title','tfuse'), 'custom_title' => __('Custom Title','tfuse')),
                            'type' => 'select'
                        ),
                        // Custom Title
                        array('name' => __('Custom Title','tfuse'),
                            'desc' => __('Enter your custom title for this page.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_custom_title_blog',
                            'value' => '',
                            'type' => 'text'
                        ),
                        // Custom Subtitle
                        array('name' => __('Custom Subtitle','tfuse'),
                            'desc' => __('Enter your custom subtitle for this page.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_custom_subtitle_blog',
                            'value' => '',
                            'type' => 'text'
                        ),
                        // Subtitle alignment
                        array('name' => __('Subtitle Alignment','tfuse'),
                            'desc' => __('Select your preferred Subtitle Alignment.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_subtitle_alignment_blog',
                            'value' => 'right',
                            'options' => array('right' => __('Right','tfuse'), 'center' => __('Center','tfuse')),
                            'type' => 'select',
                            'divider' => true
                        ),
                        // Top Shortcodes
                        array('name' => __('Shortcodes before Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_content_top_blog',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                        // Element of Footer
                        array('name' => __('Element of Content','tfuse'),
                            'desc' => __('Select type of element on the footer.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_footer_element_blog',
                            'value' => 'none',
                            'options' => array('none' => __('Without Content Element','tfuse'), 'slider' => __('Slider','tfuse')),
                            'type' => 'select',
                        ),
                        // Select Footer Slider
                        $this->ext->slider->model->has_sliders() ?
                            array(
                                'name' => __('Slider','tfuse'),
                                'desc' => __('Select a slider for your post. The sliders are created on the <a href="' . admin_url( 'admin.php?page=tf_slider_list' ) . '" target="_blank">Sliders page</a>.','tfuse'),
                                'id' => TF_THEME_PREFIX . '_select_slider_footer_blog',
                                'value' => '',
                                'options' => $TFUSE->ext->slider->get_sliders_dropdown('carousel'),
                                'type' => 'select'
                            ) :
                            array(
                                'name' => __('Slider','tfuse'),
                                'desc' => '',
                                'id' => TF_THEME_PREFIX . '_select_slider_footer_blog',
                                'value' => '',
                                'html' => __('No sliders created yet. You can start creating one <a href="' . admin_url('admin.php?page=tf_slider_list') . '">here</a>.','tfuse'),
                                'type' => 'raw'
                            ),
                        // Bottom Shortcodes
                        array('name' => __('Shortcodes After Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_content_bottom_blog',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                    )
                ),
                array(
                    'name' => __('Blog Page Background','tfuse'),
                    'options' => array(
                        // Background Image
                        array('name' => __('Background Image','tfuse'),
                            'desc' => __('Upload an image for your background.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_background_image_blog',
                            'value' => '',
                            'type' => 'upload',
                        ),
                        // Repeat Image
                        array('name' => __('Repeat Image','tfuse'),
                            'desc' => __('Select type for repeat image.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_repeat_image_blog',
                            'value' => '',
                            'options' => array('' => 'repeat-x repeat-y', 'no-repeat' => 'no-repeat', 'repeat-x' => 'repeat-x', 'repeat-y' => 'repeat-y'),
                            'type' => 'select',
                            'divider' =>true
                        ),
                        // Background-color
                        array('name' => __('Background-color','tfuse'),
                            'desc' => __('Enter background-color ex: #ccc','tfuse'),
                            'id' => TF_THEME_PREFIX . '_background_color_blog',
                            'value' => '',
                            'type' => 'colorpicker',
                        ),
                        // Background-position
                        array('name' => __('Background-position','tfuse'),
                            'desc' => __('Enter background-position ex: center top','tfuse'),
                            'id' => TF_THEME_PREFIX . '_background_position_blog',
                            'value' => '',
                            'type' => 'text'
                        )
                    )
                ),
                array(
                    'name' => __('Blog Page Banners','tfuse'),
                    'options' => array(
                        //top ad
                        array('name' => __('Enable 728x90 banner','tfuse'),
                            'desc' => __('Enable the top banner ad space. Note: you can set a specific banner for all categories and posts in the <a href="' . admin_url('admin.php?page=themefuse') . '">theme framowork options</a>','tfuse'),
                            'id' => TF_THEME_PREFIX . '_blog_top_ad_space',
                            'value' => 'false',
                            'options' => array('false' => __('No','tfuse'), 'true' => __('Yes','tfuse')),
                            'type' => 'select',
                        ),
                        array(
                            'name'=>__('Ad image(728px x 90px)','tfuse'),
                            'desc'=>__('Enter the URL to the ad image 728x90 location','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_top_ad_image',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL','tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_top_ad_url',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense code','tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_top_ad_adsense',
                            'value' => '',
                            'type' =>'textarea',
                            'divider' => true
                        ),
                        //Advertising
                        array('name' => __('Enable 125x125 banners','tfuse'),
                            'desc' => __('Enable before content banner space. Note: you can set specific banners for all categories and posts in the <a href="' . admin_url('admin.php?page=themefuse') . '">theme framowork options</a>','tfuse'),
                            'id' => TF_THEME_PREFIX . '_blog_bfcontent_ads_space',
                            'value' => 'false',
                            'options' => array('false' => __('No','tfuse'), 'true' => __('Yes','tfuse')),
                            'type' => 'select'
                        ),
                        array('name' => __('Type of ads','tfuse'),
                            'desc' => __('Choose the type of your adds.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_blog_bfcontent_type',
                            'value' => 'image',
                            'options' => array('image' => __('Image Type','tfuse'), 'adsense' => __('Adsense Type','tfuse')),
                            'type' => 'select'
                        ),
                        array('name' => __('No of 125x125 ads','tfuse'),
                            'desc' => __('Choose the numbers of ads to display before content.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_blog_bfcontent_number',
                            'value' => '7',
                            'options' => array('one' => '1', 'two' => '2' , 'three' => '3', 'four' => '4', 'five' => '5', 'six' => '6', 'seven' => '7'),
                            'type' => 'select'
                        ),
                        array(
                            'name'=>__('Ad image (125px x 125px)','tfuse'),
                            'desc'=>__('Enter the URL to the ad image 125x125 location','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_image1',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL','tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_url1',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense code for before content ads','tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_adsense1',
                            'value' => '',
                            'type' =>'textarea'
                        ),
                        array(
                            'name'=>__('Ad image (125px x 125px)','tfuse'),
                            'desc'=>__('Enter the URL to the ad image 125x125 location','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_image2',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL','tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_url2',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense code for before content ads','tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_adsense2',
                            'value' => '',
                            'type' =>'textarea'
                        ),
                        array(
                            'name'=>__('Ad image (125px x 125px)','tfuse'),
                            'desc'=>__('Enter the URL to the ad image 125x125 location','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_image3',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL','tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_url3',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense code for before content ads','tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_adsense3',
                            'value' => '',
                            'type' =>'textarea'
                        ),
                        array(
                            'name'=>__('Ad image (125px x 125px)','tfuse'),
                            'desc'=>__('Enter the URL to the ad image 125x125 location','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_image4',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL','tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_url4',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense code for before content ads','tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_adsense4',
                            'value' => '',
                            'type' =>'textarea'
                        ),
                        array(
                            'name'=>__('Ad image (125px x 125px)','tfuse'),
                            'desc'=>__('Enter the URL to the ad image 125x125 location','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_image5',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL','tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_url5',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense code for before content ads','tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_adsense5',
                            'value' => '',
                            'type' =>'textarea'
                        ),
                        array(
                            'name'=>__('Ad image (125px x 125px)','tfuse'),
                            'desc'=>__('Enter the URL to the ad image 125x125 location','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_image6',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL','tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_url6',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense code for before content ads','tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_adsense6',
                            'value' => '',
                            'type' =>'textarea'
                        ),
                        array(
                            'name'=>__('Ad image (125px x 125px)','tfuse'),
                            'desc'=>__('Enter the URL to the ad image 125x125 location','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_image7',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL','tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_url7',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense code for before content ads','tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_bfcontent_ads_adsense7',
                            'value' => '',
                            'type' =>'textarea',
                            'divider' => true
                        ),
                        //hook manager
                        array('name' => __('Enable 468x60 banner','tfuse'),
                            'desc' => __('Enable after content banner space. Note: you can set a specific banner for all categories and posts in the <a href="' . admin_url('admin.php?page=themefuse') . '">theme framowork options</a>','tfuse'),
                            'id' => TF_THEME_PREFIX . '_blog_hook_space',
                            'value' => 'false',
                            'options' => array('false' => __('No','tfuse'), 'true' => __('Yes','tfuse')),
                            'type' => 'select',
                        ),
                        array(
                            'name'=>__('Ad image(468px x 60px)','tfuse'),
                            'desc'=>__('Enter the URL to the ad image 468x60 location','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_hook_image',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL','tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_hook_url',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense code','tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_blog_hook_adsense',
                            'value' => '',
                            'type' =>'textarea',
                        )
                    )
                ),
            )
        ),
        array(
            'name' => __('Posts','tfuse'),
            'id' => TF_THEME_PREFIX . '_posts',
            'headings' => array(
                array(
                    'name' => __('Default Post Options','tfuse'),
                    'options' => array(
                        // Post Content
                        array('name' => __('Post Content','tfuse'),
                            'desc' => __('Select if you want to show the full content (use <em>more</em> tag) or the excerpt on posts listings (categories).','tfuse'),
                            'id' => TF_THEME_PREFIX . '_post_content',
                            'value' => 'excerpt',
                            'options' => array('excerpt' => __('The Excerpt','tfuse'), 'content' => __('Full Content','tfuse')),
                            'type' => 'select',
                            'divider' => true
                        ),
                        // Single Image Dimensions
                        array('name' => __('Image Resize (px)','tfuse'),
                            'desc' => __('These are the default width and height values. If you want to resize the image change the values with your own. If you input only one, the image will get resized with constrained proportions based on the one you specified.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_single_image_dimensions',
                            'value' => array(630, 269),
                            'type' => 'textarray',
                            'divider' => true
                        ),
                        // Posts Thumbnail Dimensions
                        array('name' => __('Thumbnail Resize (px)','tfuse'),
                            'desc' => __('These are the default width and height values. If you want to resize the thumbnail change the values with your own. If you input only one, the thumbnail will get resized with constrained proportions based on the one you specified.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_thumbnail_dimensions',
                            'value' => array(630, 269),
                            'type' => 'textarray',
                            'divider' => true
                        ),
                        // Video Dimensions
                        array('name' => __('Video Resize (px)','tfuse'),
                            'desc' => __('These are the default width and height values. If you want to resize the video change the values with your own. If you input only one, the video will get resized with constrained proportions based on the one you specified.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_video_dimensions',
                            'value' => array(630, 269),
                            'type' => 'textarray'
                        )
                    )
                )
            )
        ),

        array(
            'name' => __('Footer','tfuse'),
            'id' => TF_THEME_PREFIX . '_footer',
            'headings' => array(
                array(
                    'name' => __('Footer Content','tfuse'),
                    'options' => array(
                        //copyright
                        array('name' => __('Custom Copyright','tfuse'),
                            'desc' => __('Create your custom copyright','tfuse'),
                            'id' => TF_THEME_PREFIX . '_custom_copyright',
                            'value' => 'Copyright © <a href="http://themefuse.com/">Themefuse.com</a> 2013. All rights reserved',
                            'type' =>'textarea'
                        )
                    )
                ),
                array(
                    'name' => __('Footer Social','tfuse'),
                    'options' => array(
                        array('name' => __('Twitter','tfuse'),
                            'desc' => __('Enter twitter link','tfuse'),
                            'id' => TF_THEME_PREFIX . '_social_twitter',
                            'value' => '',
                            'type' => 'text'
                        ),
                        array('name' => __('Facebook','tfuse'),
                            'desc' => __('Enter facebook link','tfuse'),
                            'id' => TF_THEME_PREFIX . '_social_facebook',
                            'value' => '',
                            'type' => 'text'
                        ),
                        array('name' => __('Google +','tfuse'),
                            'desc' => __('Enter google link','tfuse'),
                            'id' => TF_THEME_PREFIX . '_social_google',
                            'value' => '',
                            'type' => 'text'
                        ),
                        array('name' => __('Vimeo','tfuse'),
                            'desc' => __('Enter vimeo link','tfuse'),
                            'id' => TF_THEME_PREFIX . '_social_vimeo',
                            'value' => '',
                            'type' => 'text'
                        ),
                        array('name' => __('Flickr','tfuse'),
                            'desc' => __('Enter flickr link','tfuse'),
                            'id' => TF_THEME_PREFIX . '_social_flickr',
                            'value' => '',
                            'type' => 'text'
                        ),
                        array('name' => __('LinkedIn','tfuse'),
                            'desc' => __('Enter LinkedIn link','tfuse'),
                            'id' => TF_THEME_PREFIX . '_social_linked',
                            'value' => '',
                            'type' => 'text'
                        ),
                        array('name' => __('Dribble','tfuse'),
                            'desc' => __('Enter dribble link','tfuse'),
                            'id' => TF_THEME_PREFIX . '_social_dribble',
                            'value' => '',
                            'type' => 'text'
                        ),
                        array('name' => __('Pinterest','tfuse'),
                            'desc' => __('Enter pinterest link','tfuse'),
                            'id' => TF_THEME_PREFIX . '_social_pinterest',
                            'value' => '',
                            'type' => 'text'
                        ),
                        array('name' => __('Behance','tfuse'),
                            'desc' => __('Enter behance link','tfuse'),
                            'id' => TF_THEME_PREFIX . '_social_behance',
                            'value' => '',
                            'type' => 'text'
                        ),
                    )
                )
            )
        ),
        array(
            'name' => __('Page elements','tfuse'),
            'id' => TF_THEME_PREFIX . '_page_elements',
            'headings' => array(
                array(
                    'name' => __('Portfolio Archive','tfuse'),
                    'options' => array(
                        // Page Title
                        array('name' => __('Title','tfuse'),
                            'desc' => __('Select your preferred Page Title.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_page_title_all',
                            'value' => 'default_title',
                            'options' => array('hide_title' => __('Hide Title','tfuse'), 'custom_title' => __('Custom Title','tfuse')),
                            'type' => 'select'
                        ),
                        // Custom Title
                        array('name' => __('Custom Title','tfuse'),
                            'desc' => __('Enter your custom title for this page.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_custom_title_all',
                            'value' => '',
                            'type' => 'text'
                        ),
                        // Custom Subtitle
                        array('name' => __('Custom Subtitle','tfuse'),
                            'desc' => __('Enter your custom subtitle for this page.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_custom_subtitle_all',
                            'value' => '',
                            'type' => 'text'
                        ),
                        // Subtitle alignment
                        array('name' => __('Subtitle Alignment','tfuse'),
                            'desc' => __('Select your preferred Subtitle Alignment.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_subtitle_alignment_all',
                            'value' => 'right',
                            'options' => array('right' => __('Right','tfuse'), 'center' => __('Center','tfuse')),
                            'type' => 'select'
                        ),
                        // Columns
                        array('name' => __('Columns','tfuse'),
                            'desc' => __('Select column type of portfolio.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_portfolio_column_all',
                            'value' => '2',
                            'options' => array('2' => __('Two Columns','tfuse'), '3' => __('Three Columns','tfuse')),
                            'type' => 'select'
                        ),
                        // Show filter
                        array('name' => __('Show filter ?','tfuse'),
                            'desc' => __('Show filter for portfolio ?','tfuse'),
                            'id' => TF_THEME_PREFIX . '_show_filter_all',
                            'value' => true,
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Element of Header
                        array('name' => __('Header Element','tfuse'),
                            'desc' => __('Select what do you want in your post header','tfuse'),
                            'id' => TF_THEME_PREFIX . '_header_element_port_archive',
                            'value' => 'none',
                            'options' => array('none' => __('Without Element','tfuse'), 'image' => __('Image','tfuse'), 'slider' => __('Slider','tfuse'), 'full_slider' => __('Full Slider','tfuse'), 'map' => __('Map','tfuse')),
                            'type' => 'select',
                        ),
                        // Image of Header
                        array('name' => __('Image','tfuse'),
                            'desc' => __('Upload an image for your header, or specify the image address of your online image. (http://yoursite.com/image.png)','tfuse'),
                            'id' => TF_THEME_PREFIX . '_header_image_port_archive',
                            'value' => '',
                            'type' => 'upload',
                        ),
                        // Select Slider
                        $this->ext->slider->model->has_sliders() ?
                            array(
                                'name' => __('Slider','tfuse'),
                                'desc' => __('Select a slider for your post. The sliders are created on the <a href="' . admin_url( 'admin.php?page=tf_slider_list' ) . '" target="_blank">Sliders page</a>.','tfuse'),
                                'id' => TF_THEME_PREFIX . '_select_slider_port_archive',
                                'value' => '',
                                'options' => $TFUSE->ext->slider->get_sliders_dropdown(array('image_video','fullbanner','featured')),
                                'type' => 'select'
                            ) :
                            array(
                                'name' => __('Slider','tfuse'),
                                'desc' => '',
                                'id' => TF_THEME_PREFIX . '_select_slider_port_archive',
                                'value' => '',
                                'html' => __('No sliders created yet. You can start creating one <a href="' . admin_url('admin.php?page=tf_slider_list') . '">here</a>.','tfuse'),
                                'type' => 'raw'
                            ),
                        // Select After Header Slider
                        $this->ext->slider->model->has_sliders() ?
                            array(
                                'name' => __('Full Slider','tfuse'),
                                'desc' => __('Select a slider for your post. The sliders are created on the <a href="' . admin_url( 'admin.php?page=tf_slider_list' ) . '" target="_blank">Sliders page</a>.','tfuse'),
                                'id' => TF_THEME_PREFIX . '_select_slider_after_header_port_archive',
                                'value' => '',
                                'options' => $TFUSE->ext->slider->get_sliders_dropdown('carousel'),
                                'type' => 'select'
                            ) :
                            array(
                                'name' => __('Full Slider','tfuse'),
                                'desc' => '',
                                'id' => TF_THEME_PREFIX . '_select_slider_after_header_port_archive',
                                'value' => '',
                                'html' => __('No sliders created yet. You can start creating one <a href="' . admin_url('admin.php?page=tf_slider_list') . '">here</a>.','tfuse'),
                                'type' => 'raw'
                            ),
                        //map on header
                        array(
                            'name' => __('Map position','tfuse'),
                            'desc' => '',
                            'value' => '',
                            'id' => TF_THEME_PREFIX . '_page_map_port_archive',
                            'type' => 'maps'
                        ),
                        array(
                            'name' => __('Text','tfuse'),
                            'desc'=> __('Enter the text for location.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_map_text_port_archive',
                            'value' => 'We are here',
                            'type' => 'text'
                        ),
                        array(
                            'name' => __('Zoom','tfuse'),
                            'desc'=> __('Enter the zoom of map.Ex: 13, 14, 15','tfuse'),
                            'id' => TF_THEME_PREFIX . '_map_zoom_port_archive',
                            'value' => '13',
                            'type' => 'text',
                            'divider' => true
                        ),
                        // Top Shortcodes
                        array('name' => __('Shortcodes before Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_content_top_port_archive',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                        // Element of Footer
                        array('name' => __('Element of Content','tfuse'),
                            'desc' => __('Select type of element on the footer.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_footer_element_port_archive',
                            'value' => 'none',
                            'options' => array('none' => __('Without Content Element','tfuse'), 'slider' => __('Slider','tfuse')),
                            'type' => 'select',
                        ),
                        // Select Footer Slider
                        $this->ext->slider->model->has_sliders() ?
                            array(
                                'name' => __('Slider','tfuse'),
                                'desc' => __('Select a slider for your post. The sliders are created on the <a href="' . admin_url( 'admin.php?page=tf_slider_list' ) . '" target="_blank">Sliders page</a>.','tfuse'),
                                'id' => TF_THEME_PREFIX . '_select_slider_footer_port_archive',
                                'value' => '',
                                'options' => $TFUSE->ext->slider->get_sliders_dropdown('carousel'),
                                'type' => 'select'
                            ) :
                            array(
                                'name' => __('Slider','tfuse'),
                                'desc' => '',
                                'id' => TF_THEME_PREFIX . '_select_slider_footer_port_archive',
                                'value' => '',
                                'html' => __('No sliders created yet. You can start creating one <a href="' . admin_url('admin.php?page=tf_slider_list') . '">here</a>.','tfuse'),
                                'type' => 'raw'
                            ),
                        // Bottom Shortcodes
                        array('name' => __('Shortcodes After Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_content_bottom_port_archive',
                            'value' => '',
                            'type' => 'textarea',
                            'divider' => true
                        ),
                        // Background Image
                        array('name' => __('Background Image','tfuse'),
                            'desc' => __('Upload an image for your background.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_background_image_port_archive',
                            'value' => '',
                            'type' => 'upload',
                        ),
                        // Repeat Image
                        array('name' => __('Repeat Image','tfuse'),
                            'desc' => __('Select type for repeat image.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_repeat_image_port_archive',
                            'value' => '',
                            'options' => array('' => 'repeat-x repeat-y', 'no-repeat' => 'no-repeat', 'repeat-x' => 'repeat-x', 'repeat-y' => 'repeat-y'),
                            'type' => 'select',
                        ),
                        // Background-color
                        array('name' => __('Background-color','tfuse'),
                            'desc' => __('Enter background-color ex: #ccc','tfuse'),
                            'id' => TF_THEME_PREFIX . '_background_color_port_archive',
                            'value' => '',
                            'type' => 'colorpicker',
                        ),
                        // Background-position
                        array('name' => __('Background-position','tfuse'),
                            'desc' => __('Enter background-position ex: center top','tfuse'),
                            'id' => TF_THEME_PREFIX . '_background_position_port_archive',
                            'value' => '',
                            'type' => 'text',
                        ),
                    )
                ),
                array(
                    'name' => __('Search','tfuse'),
                    'options' => array(
                        // Page Title
                        array('name' => __('Title','tfuse'),
                            'desc' => __('Select your preferred Page Title.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_page_title_search',
                            'value' => 'default_title',
                            'options' => array('hide_title' => __('Hide Title','tfuse'), 'custom_title' => __('Custom Title','tfuse')),
                            'type' => 'select'
                        ),
                        // Custom Title
                        array('name' => __('Custom Title','tfuse'),
                            'desc' => __('Enter your custom title for this page.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_custom_title_search',
                            'value' => '',
                            'type' => 'text'
                        ),
                        // Custom Subtitle
                        array('name' => __('Custom Subtitle','tfuse'),
                            'desc' => __('Enter your custom subtitle for this page.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_custom_subtitle_search',
                            'value' => '',
                            'type' => 'text'
                        ),
                        // Subtitle alignment
                        array('name' => __('Subtitle Alignment','tfuse'),
                            'desc' => __('Select your preferred Subtitle Alignment.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_subtitle_alignment_search',
                            'value' => 'right',
                            'options' => array('right' => __('Right','tfuse'), 'center' => __('Center','tfuse')),
                            'type' => 'select',
                            'divider' => true
                        ),
                        // Element of Header
                        array('name' => __('Header Element','tfuse'),
                            'desc' => __('Select what do you want in your post header','tfuse'),
                            'id' => TF_THEME_PREFIX . '_header_element_search',
                            'value' => 'none',
                            'options' => array('none' => __('Without Element','tfuse'), 'image' => __('Image','tfuse'), 'slider' => __('Slider','tfuse'), 'full_slider' => __('Full Slider','tfuse'), 'map' => __('Map','tfuse')),
                            'type' => 'select',
                        ),
                        // Image of Header
                        array('name' => __('Image','tfuse'),
                            'desc' => __('Upload an image for your header, or specify the image address of your online image. (http://yoursite.com/image.png)','tfuse'),
                            'id' => TF_THEME_PREFIX . '_header_image_search',
                            'value' => '',
                            'type' => 'upload',
                        ),
                        // Select Slider
                        $this->ext->slider->model->has_sliders() ?
                            array(
                                'name' => __('Slider','tfuse'),
                                'desc' => __('Select a slider for your post. The sliders are created on the <a href="' . admin_url( 'admin.php?page=tf_slider_list' ) . '" target="_blank">Sliders page</a>.','tfuse'),
                                'id' => TF_THEME_PREFIX . '_select_slider_search',
                                'value' => '',
                                'options' => $TFUSE->ext->slider->get_sliders_dropdown(array('image_video','fullbanner','featured')),
                                'type' => 'select'
                            ) :
                            array(
                                'name' => __('Slider','tfuse'),
                                'desc' => '',
                                'id' => TF_THEME_PREFIX . '_select_slider_search',
                                'value' => '',
                                'html' => __('No sliders created yet. You can start creating one <a href="' . admin_url('admin.php?page=tf_slider_list') . '">here</a>.','tfuse'),
                                'type' => 'raw'
                            ),
                        // Select After Header Slider
                        $this->ext->slider->model->has_sliders() ?
                            array(
                                'name' => __('Full Slider','tfuse'),
                                'desc' => __('Select a slider for your post. The sliders are created on the <a href="' . admin_url( 'admin.php?page=tf_slider_list' ) . '" target="_blank">Sliders page</a>.','tfuse'),
                                'id' => TF_THEME_PREFIX . '_select_slider_after_header_search',
                                'value' => '',
                                'options' => $TFUSE->ext->slider->get_sliders_dropdown('carousel'),
                                'type' => 'select'
                            ) :
                            array(
                                'name' => __('Full Slider','tfuse'),
                                'desc' => '',
                                'id' => TF_THEME_PREFIX . '_select_slider_after_header_search',
                                'value' => '',
                                'html' => __('No sliders created yet. You can start creating one <a href="' . admin_url('admin.php?page=tf_slider_list') . '">here</a>.','tfuse'),
                                'type' => 'raw'
                            ),
                        //map on header
                        array(
                            'name' => __('Map position','tfuse'),
                            'desc' => '',
                            'value' => '',
                            'id' => TF_THEME_PREFIX . '_page_map_search',
                            'type' => 'maps'
                        ),
                        array(
                            'name' => __('Text','tfuse'),
                            'desc'=> __('Enter the text for location.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_map_text_search',
                            'value' => 'We are here',
                            'type' => 'text'
                        ),
                        array(
                            'name' => __('Zoom','tfuse'),
                            'desc'=> __('Enter the zoom of map.Ex: 13, 14, 15','tfuse'),
                            'id' => TF_THEME_PREFIX . '_map_zoom_search',
                            'value' => '13',
                            'type' => 'text',
                            'divider' => true
                        ),
                        // Top Shortcodes
                        array('name' => __('Shortcodes before Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_content_top_search',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                        // Element of Footer
                        array('name' => __('Element of Content','tfuse'),
                            'desc' => __('Select type of element on the footer.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_footer_element_search',
                            'value' => 'none',
                            'options' => array('none' => __('Without Content Element','tfuse'), 'slider' => __('Slider','tfuse')),
                            'type' => 'select',
                        ),
                        // Select Footer Slider
                        $this->ext->slider->model->has_sliders() ?
                            array(
                                'name' => __('Slider','tfuse'),
                                'desc' => __('Select a slider for your post. The sliders are created on the <a href="' . admin_url( 'admin.php?page=tf_slider_list' ) . '" target="_blank">Sliders page</a>.','tfuse'),
                                'id' => TF_THEME_PREFIX . '_select_slider_footer_search',
                                'value' => '',
                                'options' => $TFUSE->ext->slider->get_sliders_dropdown('carousel'),
                                'type' => 'select'
                            ) :
                            array(
                                'name' => __('Slider','tfuse'),
                                'desc' => '',
                                'id' => TF_THEME_PREFIX . '_select_slider_footer_search',
                                'value' => '',
                                'html' => __('No sliders created yet. You can start creating one <a href="' . admin_url('admin.php?page=tf_slider_list') . '">here</a>.','tfuse'),
                                'type' => 'raw'
                            ),
                        // Bottom Shortcodes
                        array('name' => __('Shortcodes After Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_content_bottom_search',
                            'value' => '',
                            'type' => 'textarea',
                            'divider' => true
                        ),
                        // Background Image
                        array('name' => __('Background Image','tfuse'),
                            'desc' => __('Upload an image for your background.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_background_image_search',
                            'value' => '',
                            'type' => 'upload',
                        ),
                        // Repeat Image
                        array('name' => __('Repeat Image','tfuse'),
                            'desc' => __('Select type for repeat image.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_repeat_image_search',
                            'value' => '',
                            'options' => array('' => 'repeat-x repeat-y', 'no-repeat' => 'no-repeat', 'repeat-x' => 'repeat-x', 'repeat-y' => 'repeat-y'),
                            'type' => 'select',
                        ),
                        // Background-color
                        array('name' => __('Background-color','tfuse'),
                            'desc' => __('Enter background-color ex: #ccc','tfuse'),
                            'id' => TF_THEME_PREFIX . '_background_color_search',
                            'value' => '',
                            'type' => 'colorpicker',
                        ),
                        // Background-position
                        array('name' => __('Background-position','tfuse'),
                            'desc' => __('Enter background-position ex: center top','tfuse'),
                            'id' => TF_THEME_PREFIX . '_background_position_search',
                            'value' => '',
                            'type' => 'text',
                        ),
                    )
                ),
                array(
                    'name' => __('404','tfuse'),
                    'options' => array(
                        // Page Title
                        array('name' => __('Title','tfuse'),
                            'desc' => __('Select your preferred Page Title.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_page_title_404',
                            'value' => 'default_title',
                            'options' => array('hide_title' => __('Hide Title','tfuse'), 'custom_title' => __('Custom Title','tfuse')),
                            'type' => 'select'
                        ),
                        // Custom Title
                        array('name' => __('Custom Title','tfuse'),
                            'desc' => __('Enter your custom title for this page.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_custom_title_404',
                            'value' => '',
                            'type' => 'text'
                        ),
                        // Custom Subtitle
                        array('name' => __('Custom Subtitle','tfuse'),
                            'desc' => __('Enter your custom subtitle for this page.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_custom_subtitle_404',
                            'value' => '',
                            'type' => 'text'
                        ),
                        // Subtitle alignment
                        array('name' => __('Subtitle Alignment','tfuse'),
                            'desc' => __('Select your preferred Subtitle Alignment.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_subtitle_alignment_404',
                            'value' => 'right',
                            'options' => array('right' => __('Right','tfuse'), 'center' => __('Center','tfuse')),
                            'type' => 'select',
                            'divider' => true
                        ),
                        // Element of Header
                        array('name' => __('Header Element','tfuse'),
                            'desc' => __('Select what do you want in your post header','tfuse'),
                            'id' => TF_THEME_PREFIX . '_header_element_404',
                            'value' => 'none',
                            'options' => array('none' => __('Without Element','tfuse'), 'image' => __('Image','tfuse'), 'slider' => __('Slider','tfuse'), 'full_slider' => __('Full Slider','tfuse'), 'map' => __('Map','tfuse')),
                            'type' => 'select',
                        ),
                        // Image of Header
                        array('name' => __('Image','tfuse'),
                            'desc' => __('Upload an image for your header, or specify the image address of your online image. (http://yoursite.com/image.png)','tfuse'),
                            'id' => TF_THEME_PREFIX . '_header_image_404',
                            'value' => '',
                            'type' => 'upload',
                        ),
                        // Select Slider
                        $this->ext->slider->model->has_sliders() ?
                            array(
                                'name' => __('Slider','tfuse'),
                                'desc' => __('Select a slider for your post. The sliders are created on the <a href="' . admin_url( 'admin.php?page=tf_slider_list' ) . '" target="_blank">Sliders page</a>.','tfuse'),
                                'id' => TF_THEME_PREFIX . '_select_slider_404',
                                'value' => '',
                                'options' => $TFUSE->ext->slider->get_sliders_dropdown(array('image_video','fullbanner','featured')),
                                'type' => 'select'
                            ) :
                            array(
                                'name' => __('Slider','tfuse'),
                                'desc' => '',
                                'id' => TF_THEME_PREFIX . '_select_slider_404',
                                'value' => '',
                                'html' => __('No sliders created yet. You can start creating one <a href="' . admin_url('admin.php?page=tf_slider_list') . '">here</a>.','tfuse'),
                                'type' => 'raw'
                            ),
                        // Select After Header Slider
                        $this->ext->slider->model->has_sliders() ?
                            array(
                                'name' => __('Full Slider','tfuse'),
                                'desc' => __('Select a slider for your post. The sliders are created on the <a href="' . admin_url( 'admin.php?page=tf_slider_list' ) . '" target="_blank">Sliders page</a>.','tfuse'),
                                'id' => TF_THEME_PREFIX . '_select_slider_after_header_404',
                                'value' => '',
                                'options' => $TFUSE->ext->slider->get_sliders_dropdown('carousel'),
                                'type' => 'select'
                            ) :
                            array(
                                'name' => __('Full Slider','tfuse'),
                                'desc' => '',
                                'id' => TF_THEME_PREFIX . '_select_slider_after_header_404',
                                'value' => '',
                                'html' => __('No sliders created yet. You can start creating one <a href="' . admin_url('admin.php?page=tf_slider_list') . '">here</a>.','tfuse'),
                                'type' => 'raw'
                            ),
                        //map on header
                        array(
                            'name' => __('Map position','tfuse'),
                            'desc' => '',
                            'value' => '',
                            'id' => TF_THEME_PREFIX . '_page_map_404',
                            'type' => 'maps'
                        ),
                        array(
                            'name' => __('Text','tfuse'),
                            'desc' => __('Enter the text for location.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_map_text_404',
                            'value' => 'We are here',
                            'type' => 'text'
                        ),
                        array(
                            'name' => __('Zoom','tfuse'),
                            'desc' => __('Enter the zoom of map.Ex: 13, 14, 15','tfuse'),
                            'id' => TF_THEME_PREFIX . '_map_zoom_404',
                            'value' => '13',
                            'type' => 'text',
                            'divider' => true
                        ),
                        // Text 404
                        array('name' => __('Text in page 404','tfuse'),
                            'desc' => __('In this textarea you can input your prefered text for page 404.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_text_404',
                            'value' => '<img src="http://localhost/whb/wp-content/uploads/2013/08/error_ico.png" alt=""><div class="error_text"><h3>Error 404 :(</h3><p>It seems that this page does not exist on our servers.</p><a href="javascript:history.go(-1)">Go Back</a></div>',
                            'type' => 'textarea',
                            'divider' => true
                        ),
                        // Top Shortcodes
                        array('name' => __('Shortcodes before Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_content_top_404',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                        // Element of Footer
                        array('name' => __('Element of Content','tfuse'),
                            'desc' => __('Select type of element on the footer.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_footer_element_404',
                            'value' => 'none',
                            'options' => array('none' => __('Without Content Element','tfuse'), 'slider' => __('Slider','tfuse')),
                            'type' => 'select',
                        ),
                        // Select Footer Slider
                        $this->ext->slider->model->has_sliders() ?
                            array(
                                'name' => __('Slider','tfuse'),
                                'desc' => __('Select a slider for your post. The sliders are created on the <a href="' . admin_url( 'admin.php?page=tf_slider_list' ) . '" target="_blank">Sliders page</a>.','tfuse'),
                                'id' => TF_THEME_PREFIX . '_select_slider_footer_404',
                                'value' => '',
                                'options' => $TFUSE->ext->slider->get_sliders_dropdown('carousel'),
                                'type' => 'select'
                            ) :
                            array(
                                'name' => __('Slider','tfuse'),
                                'desc' => '',
                                'id' => TF_THEME_PREFIX . '_select_slider_footer_404',
                                'value' => '',
                                'html' => __('No sliders created yet. You can start creating one <a href="' . admin_url('admin.php?page=tf_slider_list') . '">here</a>.','tfuse'),
                                'type' => 'raw'
                            ),
                        // Bottom Shortcodes
                        array('name' => __('Shortcodes After Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_content_bottom_404',
                            'value' => '',
                            'type' => 'textarea',
                            'divider' => true
                        ),
                        // Background Image
                        array('name' => __('Background Image','tfuse'),
                            'desc' => __('Upload an image for your background.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_background_image_404',
                            'value' => '',
                            'type' => 'upload',
                        ),
                        // Repeat Image
                        array('name' => __('Repeat Image','tfuse'),
                            'desc' => __('Select type for repeat image.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_repeat_image_404',
                            'value' => '',
                            'options' => array('' => 'repeat-x repeat-y', 'no-repeat' => 'no-repeat', 'repeat-x' => 'repeat-x', 'repeat-y' => 'repeat-y'),
                            'type' => 'select',
                        ),
                        // Background-color
                        array('name' => __('Background-color','tfuse'),
                            'desc' => __('Enter background-color ex: #ccc','tfuse'),
                            'id' => TF_THEME_PREFIX . '_background_color_404',
                            'value' => '',
                            'type' => 'colorpicker',
                        ),
                        // Background-position
                        array('name' => __('Background-position','tfuse'),
                            'desc' => __('Enter background-position ex: center top','tfuse'),
                            'id' => TF_THEME_PREFIX . '_background_position_404',
                            'value' => '',
                            'type' => 'text',
                        ),
                    )
                ),
                array(
                    'name' => __('Tag','tfuse'),
                    'options' => array(
                        // Page Title
                        array('name' => __('Title','tfuse'),
                            'desc' => __('Select your preferred Page Title.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_page_title_tag',
                            'value' => 'default_title',
                            'options' => array('hide_title' => __('Hide Title','tfuse'), 'custom_title' => __('Custom Title','tfuse')),
                            'type' => 'select'
                        ),
                        // Custom Title
                        array('name' => __('Custom Title','tfuse'),
                            'desc' => __('Enter your custom title for this page.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_custom_title_tag',
                            'value' => '',
                            'type' => 'text'
                        ),
                        // Custom Subtitle
                        array('name' => __('Custom Subtitle','tfuse'),
                            'desc' => __('Enter your custom subtitle for this page.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_custom_subtitle_tag',
                            'value' => '',
                            'type' => 'text'
                        ),
                        // Subtitle alignment
                        array('name' => __('Subtitle Alignment','tfuse'),
                            'desc' => __('Select your preferred Subtitle Alignment.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_subtitle_alignment_tag',
                            'value' => 'right',
                            'options' => array('right' => __('Right','tfuse'), 'center' => __('Center','tfuse')),
                            'type' => 'select',
                            'divider' => true
                        ),
                        // Element of Header
                        array('name' => __('Header Element','tfuse'),
                            'desc' => __('Select what do you want in your post header','tfuse'),
                            'id' => TF_THEME_PREFIX . '_header_element_tag',
                            'value' => 'none',
                            'options' => array('none' => __('Without Element','tfuse'), 'image' => __('Image','tfuse'), 'slider' => __('Slider','tfuse'), 'full_slider' => __('Full Slider','tfuse'), 'map' => __('Map','tfuse')),
                            'type' => 'select',
                        ),
                        // Image of Header
                        array('name' => __('Image','tfuse'),
                            'desc' => __('Upload an image for your header, or specify the image address of your online image. (http://yoursite.com/image.png)','tfuse'),
                            'id' => TF_THEME_PREFIX . '_header_image_tag',
                            'value' => '',
                            'type' => 'upload',
                        ),
                        // Select Slider
                        $this->ext->slider->model->has_sliders() ?
                            array(
                                'name' => __('Slider','tfuse'),
                                'desc' => __('Select a slider for your post. The sliders are created on the <a href="' . admin_url( 'admin.php?page=tf_slider_list' ) . '" target="_blank">Sliders page</a>.','tfuse'),
                                'id' => TF_THEME_PREFIX . '_select_slider_tag',
                                'value' => '',
                                'options' => $TFUSE->ext->slider->get_sliders_dropdown(array('image_video','fullbanner','featured')),
                                'type' => 'select'
                            ) :
                            array(
                                'name' => __('Slider','tfuse'),
                                'desc' => '',
                                'id' => TF_THEME_PREFIX . '_select_slider_tag',
                                'value' => '',
                                'html' => __('No sliders created yet. You can start creating one <a href="' . admin_url('admin.php?page=tf_slider_list') . '">here</a>.','tfuse'),
                                'type' => 'raw'
                            ),
                        // Select After Header Slider
                        $this->ext->slider->model->has_sliders() ?
                            array(
                                'name' => __('Full Slider','tfuse'),
                                'desc' => __('Select a slider for your post. The sliders are created on the <a href="' . admin_url( 'admin.php?page=tf_slider_list' ) . '" target="_blank">Sliders page</a>.','tfuse'),
                                'id' => TF_THEME_PREFIX . '_select_slider_after_header_tag',
                                'value' => '',
                                'options' => $TFUSE->ext->slider->get_sliders_dropdown('carousel'),
                                'type' => 'select'
                            ) :
                            array(
                                'name' => __('Full Slider','tfuse'),
                                'desc' => '',
                                'id' => TF_THEME_PREFIX . '_select_slider_after_header_tag',
                                'value' => '',
                                'html' => __('No sliders created yet. You can start creating one <a href="' . admin_url('admin.php?page=tf_slider_list') . '">here</a>.','tfuse'),
                                'type' => 'raw'
                            ),
                        //map on header
                        array(
                            'name' => __('Map position','tfuse'),
                            'desc' => '',
                            'value' => '',
                            'id' => TF_THEME_PREFIX . '_page_map_tag',
                            'type' => 'maps'
                        ),
                        array(
                            'name' => __('Text','tfuse'),
                            'desc' => __('Enter the text for location.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_map_text_tag',
                            'value' => 'We are here',
                            'type' => 'text'
                        ),
                        array(
                            'name' => __('Zoom','tfuse'),
                            'desc' => __('Enter the zoom of map.Ex: 13, 14, 15','tfuse'),
                            'id' => TF_THEME_PREFIX . '_map_zoom_tag',
                            'value' => '13',
                            'type' => 'text',
                            'divider' => true
                        ),
                        // Top Shortcodes
                        array('name' => __('Shortcodes before Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_content_top_tag',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                        // Element of Footer
                        array('name' => __('Element of Content','tfuse'),
                            'desc' => __('Select type of element on the footer.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_footer_element_tag',
                            'value' => 'none',
                            'options' => array('none' => __('Without Content Element','tfuse'), 'slider' => __('Slider','tfuse')),
                            'type' => 'select',
                        ),
                        // Select Footer Slider
                        $this->ext->slider->model->has_sliders() ?
                            array(
                                'name' => __('Slider','tfuse'),
                                'desc' => __('Select a slider for your post. The sliders are created on the <a href="' . admin_url( 'admin.php?page=tf_slider_list' ) . '" target="_blank">Sliders page</a>.','tfuse'),
                                'id' => TF_THEME_PREFIX . '_select_slider_footer_tag',
                                'value' => '',
                                'options' => $TFUSE->ext->slider->get_sliders_dropdown('carousel'),
                                'type' => 'select'
                            ) :
                            array(
                                'name' => __('Slider','tfuse'),
                                'desc' => '',
                                'id' => TF_THEME_PREFIX . '_select_slider_footer_tag',
                                'value' => '',
                                'html' => __('No sliders created yet. You can start creating one <a href="' . admin_url('admin.php?page=tf_slider_list') . '">here</a>.','tfuse'),
                                'type' => 'raw'
                            ),
                        // Bottom Shortcodes
                        array('name' => __('Shortcodes After Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_content_bottom_tag',
                            'value' => '',
                            'type' => 'textarea',
                            'divider' => true
                        ),
                        // Background Image
                        array('name' => __('Background Image','tfuse'),
                            'desc' => __('Upload an image for your background.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_background_image_tag',
                            'value' => '',
                            'type' => 'upload',
                        ),
                        // Repeat Image
                        array('name' => __('Repeat Image','tfuse'),
                            'desc' => __('Select type for repeat image.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_repeat_image_tag',
                            'value' => '',
                            'options' => array('' => 'repeat-x repeat-y', 'no-repeat' => 'no-repeat', 'repeat-x' => 'repeat-x', 'repeat-y' => 'repeat-y'),
                            'type' => 'select',
                        ),
                        // Background-color
                        array('name' => __('Background-color','tfuse'),
                            'desc' => __('Enter background-color ex: #ccc','tfuse'),
                            'id' => TF_THEME_PREFIX . '_background_color_tag',
                            'value' => '',
                            'type' => 'colorpicker',
                        ),
                        // Background-position
                        array('name' => __('Background-position','tfuse'),
                            'desc' => __('Enter background-position ex: center top','tfuse'),
                            'id' => TF_THEME_PREFIX . '_background_position_tag',
                            'value' => '',
                            'type' => 'text',
                        ),
                    )
                ),
                array(
                    'name' => __('Archive','tfuse'),
                    'options' => array(
                        // Page Title
                        array('name' => __('Title','tfuse'),
                            'desc' => __('Select your preferred Page Title.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_page_title_archive',
                            'value' => 'default_title',
                            'options' => array('hide_title' => __('Hide Title','tfuse'), 'custom_title' => __('Custom Title','tfuse')),
                            'type' => 'select'
                        ),
                        // Custom Title
                        array('name' => __('Custom Title','tfuse'),
                            'desc' => __('Enter your custom title for this page.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_custom_title_archive',
                            'value' => '',
                            'type' => 'text'
                        ),
                        // Custom Subtitle
                        array('name' => __('Custom Subtitle','tfuse'),
                            'desc' => __('Enter your custom subtitle for this page.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_custom_subtitle_archive',
                            'value' => '',
                            'type' => 'text'
                        ),
                        // Subtitle alignment
                        array('name' => __('Subtitle Alignment','tfuse'),
                            'desc' => __('Select your preferred Subtitle Alignment.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_subtitle_alignment_archive',
                            'value' => 'right',
                            'options' => array('right' => __('Right','tfuse'), 'center' => __('Center','tfuse')),
                            'type' => 'select',
                            'divider' => true
                        ),
                        // Element of Header
                        array('name' => __('Header Element','tfuse'),
                            'desc' => __('Select what do you want in your post header','tfuse'),
                            'id' => TF_THEME_PREFIX . '_header_element_archive',
                            'value' => 'none',
                            'options' => array('none' => __('Without Element','tfuse'), 'image' => __('Image','tfuse'), 'slider' => __('Slider','tfuse'), 'full_slider' => __('Full Slider','tfuse'), 'map' => __('Map','tfuse')),
                            'type' => 'select',
                        ),
                        // Image of Header
                        array('name' => __('Image','tfuse'),
                            'desc' => __('Upload an image for your header, or specify the image address of your online image. (http://yoursite.com/image.png)','tfuse'),
                            'id' => TF_THEME_PREFIX . '_header_image_archive',
                            'value' => '',
                            'type' => 'upload',
                        ),
                        // Select Slider
                        $this->ext->slider->model->has_sliders() ?
                            array(
                                'name' => __('Slider','tfuse'),
                                'desc' => __('Select a slider for your post. The sliders are created on the <a href="' . admin_url( 'admin.php?page=tf_slider_list' ) . '" target="_blank">Sliders page</a>.','tfuse'),
                                'id' => TF_THEME_PREFIX . '_select_slider_archive',
                                'value' => '',
                                'options' => $TFUSE->ext->slider->get_sliders_dropdown(array('image_video','fullbanner','featured')),
                                'type' => 'select'
                            ) :
                            array(
                                'name' => __('Slider','tfuse'),
                                'desc' => '',
                                'id' => TF_THEME_PREFIX . '_select_slider_archive',
                                'value' => '',
                                'html' => __('No sliders created yet. You can start creating one <a href="' . admin_url('admin.php?page=tf_slider_list') . '">here</a>.','tfuse'),
                                'type' => 'raw'
                            ),
                        // Select After Header Slider
                        $this->ext->slider->model->has_sliders() ?
                            array(
                                'name' => __('Full Slider','tfuse'),
                                'desc' => __('Select a slider for your post. The sliders are created on the <a href="' . admin_url( 'admin.php?page=tf_slider_list' ) . '" target="_blank">Sliders page</a>.','tfuse'),
                                'id' => TF_THEME_PREFIX . '_select_slider_after_header_archive',
                                'value' => '',
                                'options' => $TFUSE->ext->slider->get_sliders_dropdown('carousel'),
                                'type' => 'select'
                            ) :
                            array(
                                'name' => __('Full Slider','tfuse'),
                                'desc' => '',
                                'id' => TF_THEME_PREFIX . '_select_slider_after_header_archive',
                                'value' => '',
                                'html' => __('No sliders created yet. You can start creating one <a href="' . admin_url('admin.php?page=tf_slider_list') . '">here</a>.','tfuse'),
                                'type' => 'raw'
                            ),
                        //map on header
                        array(
                            'name' => __('Map position','tfuse'),
                            'desc' => '',
                            'value' => '',
                            'id' => TF_THEME_PREFIX . '_page_map_archive',
                            'type' => 'maps'
                        ),
                        array(
                            'name' => __('Text','tfuse'),
                            'desc' => __('Enter the text for location.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_map_text_archive',
                            'value' => 'We are here',
                            'type' => 'text'
                        ),
                        array(
                            'name' => __('Zoom','tfuse'),
                            'desc' => __('Enter the zoom of map.Ex: 13, 14, 15','tfuse'),
                            'id' => TF_THEME_PREFIX . '_map_zoom_archive',
                            'value' => '13',
                            'type' => 'text',
                            'divider' => true
                        ),
                        // Top Shortcodes
                        array('name' => __('Shortcodes before Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_content_top_archive',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                        // Element of Footer
                        array('name' => __('Element of Content','tfuse'),
                            'desc' => __('Select type of element on the footer.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_footer_element_archive',
                            'value' => 'none',
                            'options' => array('none' => __('Without Content Element','tfuse'), 'slider' => __('Slider','tfuse')),
                            'type' => 'select',
                        ),
                        // Select Footer Slider
                        $this->ext->slider->model->has_sliders() ?
                            array(
                                'name' => __('Slider','tfuse'),
                                'desc' => __('Select a slider for your post. The sliders are created on the <a href="' . admin_url( 'admin.php?page=tf_slider_list' ) . '" target="_blank">Sliders page</a>.','tfuse'),
                                'id' => TF_THEME_PREFIX . '_select_slider_footer_archive',
                                'value' => '',
                                'options' => $TFUSE->ext->slider->get_sliders_dropdown('carousel'),
                                'type' => 'select'
                            ) :
                            array(
                                'name' => __('Slider','tfuse'),
                                'desc' => '',
                                'id' => TF_THEME_PREFIX . '_select_slider_footer_archive',
                                'value' => '',
                                'html' => __('No sliders created yet. You can start creating one <a href="' . admin_url('admin.php?page=tf_slider_list') . '">here</a>.','tfuse'),
                                'type' => 'raw'
                            ),
                        // Bottom Shortcodes
                        array('name' => __('Shortcodes After Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_content_bottom_archive',
                            'value' => '',
                            'type' => 'textarea',
                            'divider' => true
                        ),
                        // Background Image
                        array('name' => __('Background Image','tfuse'),
                            'desc' => __('Upload an image for your background.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_background_image_archive',
                            'value' => '',
                            'type' => 'upload',
                        ),
                        // Repeat Image
                        array('name' => __('Repeat Image','tfuse'),
                            'desc' => __('Select type for repeat image.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_repeat_image_archive',
                            'value' => '',
                            'options' => array('' => 'repeat-x repeat-y', 'no-repeat' => 'no-repeat', 'repeat-x' => 'repeat-x', 'repeat-y' => 'repeat-y'),
                            'type' => 'select',
                        ),
                        // Background-color
                        array('name' => __('Background-color','tfuse'),
                            'desc' => __('Enter background-color ex: #ccc','tfuse'),
                            'id' => TF_THEME_PREFIX . '_background_color_archive',
                            'value' => '',
                            'type' => 'colorpicker',
                        ),
                        // Background-position
                        array('name' => __('Background-position','tfuse'),
                            'desc' => __('Enter background-position ex: center top','tfuse'),
                            'id' => TF_THEME_PREFIX . '_background_position_archive',
                            'value' => '',
                            'type' => 'text',
                        ),
                    )
                )
            )
        ),
        array(
            'name' => __('Background','tfuse'),
            'id' => TF_THEME_PREFIX . '_background',
            'headings' => array(
                array(
                    'name' => __('Default Background Options','tfuse'),
                    'options' => array(
                        // Background Image
                        array('name' => __('Background Image','tfuse'),
                            'desc' => __('Upload an image for your background.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_background_image_default',
                            'value' => '',
                            'type' => 'upload',
                        ),
                        // Repeat Image
                        array('name' => __('Repeat Image','tfuse'),
                            'desc' => __('Select type for repeat image.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_repeat_image_default',
                            'value' => '',
                            'options' => array('' => 'repeat-x repeat-y', 'no-repeat' => 'no-repeat', 'repeat-x' => 'repeat-x', 'repeat-y' => 'repeat-y'),
                            'type' => 'select',
                            'divider' =>true
                        ),
                        // Background-color
                        array('name' => __('Background-color','tfuse'),
                            'desc' => __('Enter background-color ex: #ccc','tfuse'),
                            'id' => TF_THEME_PREFIX . '_background_color_default',
                            'value' => '',
                            'type' => 'colorpicker',
                        ),
                        // Background-position
                        array('name' => __('Background-position','tfuse'),
                            'desc' => __('Enter background-position ex: center top','tfuse'),
                            'id' => TF_THEME_PREFIX . '_background_position_default',
                            'value' => '',
                            'type' => 'text',
                            'divider' =>true
                        ),
                    )
                ),
                array(
                    'name' => __('Background for Smartphones and Tablets','tfuse'),
                    'options' => array(
                        // Mobile Options
                        array('name' => __('Mobile','tfuse'),
                            'id' => TF_THEME_PREFIX . '_phone_option_default',
                            'type' => 'metabox',
                            'context' => 'normal'
                        ),
                        // Background for smartphones and tablets
                        array('name' => __('Background for smartphones and tablets','tfuse'),
                            'desc' => __('This is the background that will be displayed when the website will be viewed on smartphones or tablets','tfuse'),
                            'id' => TF_THEME_PREFIX . '_phone_background_default',
                            'value' => '',
                            'type' => 'upload',
                            'divider' =>true
                        ),
                        array('name' => __('Background color for smartphones and tablets','tfuse'),
                            'desc' => __('The background color for when the website will be viewed on smartphones or tablets','tfuse'),
                            'id' => TF_THEME_PREFIX . '_phone_color_default',
                            'value' => '',
                            'type' => 'colorpicker',
                            'divider' =>true
                        ),
                        // Repeat Image Phone
                        array('name' => __('Repeat Image','tfuse'),
                            'desc' => __('Select type for repeat image.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_repeat_image_phone_default',
                            'value' => 'repeat',
                            'options' => array('repeat' => 'repeat', 'no-repeat' => 'no-repeat', 'repeat-x' => 'repeat-x', 'repeat-y' => 'repeat-y'),
                            'type' => 'select'
                        )
                    )
                )
            )
        ),
        array(
            'name' => __('Ads','tfuse'),
            'id' => TF_THEME_PREFIX . '_adds',
            'headings' => array(
                array(
                    'name' => __('728 x 90 General Ad Options','tfuse'),
                    'options' => array(

                        array('name' => __('Enable the ad','tfuse'),
                            'desc' => __('Enable the 728x90 ad across the website.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_top_ads_space',
                            'value' => 'false',
                            'type' => 'checkbox',
                        ),
                        array(
                            'name'=>__('Ad Image (728px x 90px)','tfuse'),
                            'desc'=>__('This banner will appear across the website if you don\'t specify otherwise from the posts categories.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_top_ads_image',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL','tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_top_ads_url',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense Code','tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_top_ads_adsense',
                            'value' => '',
                            'type' =>'textarea'
                        )
                    ),

                ),
                array(
                    'name' => __('125 x 125 General Ad Options','tfuse'),
                    'options' => array(

                        array('name' => __('Enable the ad','tfuse'),
                            'desc' => __('Enable the 125x125 ad across the website.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_bfc_ads_space',
                            'value' => 'false',
                            'type' => 'checkbox',
                        ),

                        array('name' => __('Type of ads','tfuse'),
                            'desc' => __('Choose the type of your adds.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_bfcontent_type1',
                            'value' => 'image',
                            'options' => array('image' => __('Image Type','tfuse'), 'adsense' => __('Adsense Type','tfuse')),
                            'type' => 'select'
                        ),
                        array('name' => __('No of 125x125 ads','tfuse'),
                            'desc' => __('Choose the numbers of ads to display before content.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_bfcontent_number',
                            'value' => '7',
                            'options' => array('one' => '1', 'two' => '2' , 'three' => '3', 'four' => '4', 'five' => '5', 'six' => '6', 'seven' => '7'),
                            'type' => 'select'
                        ),
                        array(
                            'name'=>__('Ad image (125px x 125px)','tfuse'),
                            'desc'=>__('Enter the URL to the ad image 125x125 location','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_image1',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL','tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_url1',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense Code','tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_adsense1',
                            'value' => '',
                            'type' =>'textarea'
                        ),
                        array(
                            'name'=>__('Ad image (125px x 125px)','tfuse'),
                            'desc'=>__('Enter the URL to the ad image 125x125 location','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_image2',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL','tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_url2',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense Code','tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_adsense2',
                            'value' => '',
                            'type' =>'textarea'
                        ),
                        array(
                            'name'=>__('Ad image (125px x 125px)','tfuse'),
                            'desc'=>__('Enter the URL to the ad image 125x125 location','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_image3',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL','tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_url3',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense Code','tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_adsense3',
                            'value' => '',
                            'type' =>'textarea'
                        ),
                        array(
                            'name'=>__('Ad image (125px x 125px)','tfuse'),
                            'desc'=>__('Enter the URL to the ad image 125x125 location','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_image4',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL','tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_url4',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense Code','tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_adsense4',
                            'value' => '',
                            'type' =>'textarea'
                        ),
                        array(
                            'name'=>__('Ad image (125px x 125px)','tfuse'),
                            'desc'=>__('Enter the URL to the ad image 125x125 location','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_image5',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL','tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_url5',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense Code','tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_adsense5',
                            'value' => '',
                            'type' =>'textarea'
                        ),
                        array(
                            'name'=>__('Ad image (125px x 125px)','tfuse'),
                            'desc'=>__('Enter the URL to the ad image 125x125 location','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_image6',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL','tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_url6',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense Code','tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_adsense6',
                            'value' => '',
                            'type' =>'textarea'
                        ),
                        array(
                            'name'=>__('Ad image (125px x 125px)','tfuse'),
                            'desc'=>__('Enter the URL to the ad image 125x125 location','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_image7',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL','tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_url7',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense Code','tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_bfcontent_ads_adsense7',
                            'value' => '',
                            'type' =>'textarea',
                        ),

                    )
                ),
                array(
                    'name' => __('468 x 60 General Ad Options','tfuse'),
                    'options' => array(

                        array('name' => __('Enable the ad','tfuse'),
                            'desc' => __('Enable the 468x60 ad across the website.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_content_ads_space',
                            'value' => 'false',
                            'type' => 'checkbox',
                        ),
                        array(
                            'name'=>__('Ad Image (468px x 60px)','tfuse'),
                            'desc'=>__('This banner will appear across the website if you don\'t specify otherwise from the posts categories.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_hook_image_admin',
                            'value' => '',
                            'type' =>'upload'
                        ),
                        array(
                            'name'=>__('Ad URL','tfuse'),
                            'desc'=>__('Enter the URL where this ad points to.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_hook_url_admin',
                            'value' => '',
                            'type' =>'text'
                        ),
                        array(
                            'name'=>__('Adsense Code','tfuse'),
                            'desc'=>__('Enter your adsense code (or other ad network code) here.','tfuse'),
                            'id'=> TF_THEME_PREFIX . '_hook_adsense_admin',
                            'value' => '',
                            'type' =>'textarea'
                        )

                    )
                )
            )
        )
    )
);

?>