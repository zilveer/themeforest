<?php


class bebelBaseBundleConfig  extends BebelBundleConfig
{

  public function __construct()
  {
    $this->bundleDir = 'bebelBaseBundle';
  }


  public function getAutoload()
  {
    $a = array(
      'bebelbasebundleadminconfig' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/config/bebelBaseBundleAdminConfig.class.php',
    );

    return $a;
  }


  public function getSettings()
  {
    $s = array(
        'static_mainpage_enable' => 'off',
        'static_mainpage_type' => 'page', // can be page or content
        'static_mainpage_page_id' => '',
        'static_mainpage_content' => 'Lorem Ipsum Sit Dolor...',
        'static_mainpage_background' => '',
        
        
        'bebel_base_bundle_version' => '1.0',
        'bebel_settings_last_update' => gmdate('D, d M Y H:i:s', time()),
        'theme_color_schema' => 'green',
        'enable_custom_colors' => 'false',
        'css' => '',
        'title_color' => '#0099cc',
        'default_background' => '%IMAGES_PATH%/examples/background.jpg',
        'blog_overview_page' => '',
        
        'logo_website' => '',
        'logo_mail' => '%IMAGES_PATH%/mail/logo.png',
        
        'contact_page' => '',
        'contact_email' => '',
        'contact_email2' => '',
        'contact_address' => '',
        'contact_address_html' => '',
        'contact_text' => '',
        
        'social_media_enable' => 'off',
        'social_facebook_enable' => 'off',
        'social_twitter_enable' => 'off',
        'social_linkedin_enable' => 'off',
        'social_facebook_url' => 'http://facebook.com',
        'social_twitter_url' => 'http://twitter.com',
        'social_linkedin_url' => 'http://linkedin.com',
        
        'slider_interval' => '5000',
        'slider_transition_effect' => 'fade',
        'slider_transition_speed' => '1000',
        'slider_image_protect' => '1',
        
        'google_analytics_name' => '',
        'update_notifications' => 'off',
        'sidebar_holder' => array(
          'sidebars' => array(
            'form' => array(
                'can_delete' => 'false',
                'title' => 'Form Sidebar'
            ),
          ),
          'defaults' => array(
              'category' => 'form',
              'post' => 'form',
              'page' => 'form',
              'misc' => 'form',
              'blog' => 'form',
          )
        ),
        
    );

    return $s;
  }

  public function getWordpress()
  {

    $w = array(
        'theme_support' => array(
            'menus',
            'post-thumbnails',
            'automatic-feed-links'
         ),
        'nav_menus' => array(
            'top_menu' => 'Main Menu (Footer)',
        ),
        'actions' => array(),
        'filters' => array(
            'widget_text' => 'do_shortcode',
            'get_search_form' => array('simpleUtils', 'getSearchForm'),
            
        ),
        'enqueue_scripts' => array(
            'comment-reply' => array(
                'environment' => 'frontend'
            ),
            'jquery' => array(
                'path' => '%BCP_CORE_PATH%/assets/js/jquery.min.js', // is version 1.7.1
                'environment' => 'frontend',
                'dependency' => null
            ),
        ),
        'image_sizes' => array(
            // unproportional blog style
            'post-unprop-small'   => array(200, 182, true),
        )
    );

    return $w;
  }

  // admin stuff
  public function getAdmin()
  {
    // get templates
    $templates = $this->getTemplates();
    $templates_main = $templates;
    $templates_misc = $templates;
    unset($templates_main['base']['full']);
    unset($templates_misc['base']['full']);
    $color_schemas = array(
        'black' => 'Black', 
        'blue' => 'Blue', 
        'brown' => 'Brown', 
        'gray' => 'Gray', 
        'green' => 'Green', 
        'red' => 'Red', 
        'white' => 'White', 
        'yellow' => 'Yellow'
    );
    
    $slider_effects = array(
        'none' => 'No Effect',
        'fade' => 'Fade', 
        'slideLeft' => 'Slide in from left', 
        'slideRight' => 'Slide in from right', 
        'slideTop' => 'Slide in from top', 
        'slideBottom' => 'Slide in from bottom', 
        'CarouseLeft' => 'Carousel from left to right',
        'carouselRight' => 'Carousel from right to left'
    );


    $modules = array(
        'general' => array(
            'title' => 'Basic',
            'submenu' => array(
                'general' => array(
                    'title' => 'General Settings',
                    'description' => 'Change your logo, ...'
                ),
                'mainpage' => array(
                    'title' => 'Main Page',
                    'description' => 'Set up a static page and more..'
                ),
                'contact' => array(
                    'title' => 'Contact Page',
                    'description' => 'Setup the contact page'
                ),
                'slider' => array(
                    'title' => 'Slider Settings',
                    'description' => 'Customize the slider seettings'
                ),
                'social' => array(
                    'title' => 'Social Media',
                    'description' => 'Set default links for social media'
                ),
            ),
            'widgets' => array(
                'theme_color_schema' => array(
                    'title' => 'Theme',
                    'description' => 'Select which theme you would like to use',
                    'help' => '',
                    'template' => 'select_custom',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'general',
                    'options' => array('options' => $color_schemas, 'first' => 'Color Schema')
                ),
                'default_background' => array(
                    'title' => 'Default Event Background Image',
                    'description' => 'If you do not want to define a custom background for each event, you can define a default background in here.',
                    'help' => '',
                    'template' => 'upload',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'general',
                    'options' => array('button_text' => 'Upload Background Image')
                ),
                'logo_website' => array(
                    'title' => 'Logo Website',
                    'description' => 'Change your logo for the website. Optimal size: 116x62px',
                    'help' => '',
                    'template' => 'upload',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'general',
                    'options' => array('button_text' => 'Upload Website Logo')
                ),
                'logo_mail' => array(
                    'title' => 'Logo Mails',
                    'description' => 'Change your logo for the email newsletter. Optimal size: 100x36px',
                    'help' => '',
                    'template' => 'upload',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'general',
                    'options' => array('button_text' => 'Upload Mail Logo')
                ),
                'google_analytics_name' => array(
                    'title' => 'Google Analytics Key',
                    'description' => 'Insert your google analytics key if you have one (The one beginning with UA)',
                    'help' => '',
                    'template' => 'input',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'general',
                    'options' => array()
                ),
                
                // main page
                
                
                
                
                'static_mainpage_enable' => array(
                    'title' => 'Enable static main page',
                    'description' => 'If enabled, there will be a static page set up as the front page, the events will be accessible through the menu',
                    'help' => '',
                    'template' => 'select_true_false',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'mainpage',
                    'options' => array()
                ),
                'static_mainpage_type' => array(
                    'title' => 'Contact Page',
                    'description' => 'Choose a page for the contact page layout.',
                    'help' => '',
                    'template' => 'select_custom',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'mainpage',
                    'options' => array('options' => array('page' => 'Page (select below)', 'content' => 'Custom Content (enter below)'), 'default' => 'page', 'first' => 'Type')
                ),
                'static_mainpage_page_id' => array(
                    'title' => 'Select Page',
                    'description' => 'Select a page you want to display on the main page, if the option above is set to page.',
                    'help' => '',
                    'template' => 'select_page',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'mainpage',
                    'options' => array()
                ),
                'static_mainpage_content' => array(
                    'title' => 'Static Content',
                    'description' => 'Enter the content of the main page you want to show, if the option above is set to content. <b>You may use HTML and shortcodes.</b>',
                    'help' => '',
                    'template' => 'textarea',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'mainpage',
                    'options' => array()
                ),
                'static_mainpage_background' => array(
                    'title' => 'Static Content Background Image',
                    'description' => 'Upload a background image for the static main page. If you do not upload one, the default one will be used. (<b>If you are using the "page" setting, you have to upload the background image when creating the page by using the featured image button</b>)',
                    'help' => '',
                    'template' => 'upload',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'mainpage',
                    'options' => array()
                ),
                
                
                
                
                // contact page
                
                'contact_page' => array(
                    'title' => 'Contact Page',
                    'description' => 'Choose a page for the contact page layout.',
                    'help' => '',
                    'template' => 'select_page',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'contact',
                    'options' => array()
                ),
                'contact_address' => array(
                    'title' => 'Address',
                    'description' => 'Enter your address in one line (seperate facts by a comma). Will be used for google maps. Example: Mystreet 32, 12345 New York, NY, USA',
                    'help' => '',
                    'template' => 'input',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'contact',
                    'options' => array()
                ),
                'contact_email' => array(
                    'title' => 'Email for Form',
                    'description' => 'Enter the email address the contact requests should be sent to.<strong>Warning:</strong> If empty, the default admin email address will be used.',
                    'help' => '',
                    'template' => 'input',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'contact',
                    'options' => array()
                ),
                'contact_email2' => array(
                    'title' => 'Email Settings',
                    'description' => 'The same settings as for the event mailing system will be used. Please make sure you set them up, go to the "Events" top-tab. (again, we recommend smtp)',
                    'help' => '',
                    'template' => 'help',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'contact',
                    'options' => array()
                ),
                'contact_address_html' => array(
                    'title' => 'Address (formatted)',
                    'description' => 'Enter your address as you would naturally enter it (with line breaks). This will be shown if google maps is not available.',
                    'help' => '',
                    'template' => 'textarea',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'contact',
                    'options' => array()
                ),
                'contact_text' => array(
                    'title' => 'Contact Text',
                    'description' => 'Enter the text you want to show on the contact page directly into the page\'s content field. Should not be longer than 80-100 words.',
                    'help' => '',
                    'template' => 'help',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'contact',
                    'options' => array()
                ),
                
                // slider settings
                
                'slider_interval' => array(
                    'title' => 'Interval',
                    'description' => 'How many seconds should a slide be displayed before the next one comes? (in milliseconds, 1000ms = 1s) (if you need a value bigger than the slider, enter it in the text field)',
                    'help' => '',
                    'template' => 'slider',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'slider',
                    'options' => array('min' => '100', 'max' => '10000')
                ),
                'slider_transition_effect' => array(
                    'title' => 'Interval',
                    'description' => 'How many seconds should a slide be displayed before the next one comes? (in milli seconds, 1000ms = 1s) (if you need a value bigger than the slider, enter it in the text field)',
                    'help' => '',
                    'template' => 'select_custom',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'slider',
                    'options' => array('options' => $slider_effects, 'default' => 'fade', 'first' => 'Effect')
                ),
                'slider_transition_speed' => array(
                    'title' => 'Interval',
                    'description' => 'How long should the transition between two slides take? (in milli seconds)',
                    'help' => '',
                    'template' => 'slider',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'slider',
                    'options' => array('min' => '10', 'max' => '10000')
                ),
                'slider_image_protect' => array(
                    'title' => 'Protect Images?',
                    'description' => 'You can protect your images by disabling the right click on the areas of the image. <strong>Important:</strong> This does not fully protect your images against theft. You can <u>never</u> protect any data fully on the internet.',
                    'help' => '',
                    'template' => 'select_true_false',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'slider',
                    'options' => array()
                ),
                
                // social media
                'social_media_enable' => array(
                    'title' => 'Enable Social Media Buttons',
                    'description' => 'You can enable social media buttons below your post. We support facebook, twitter and linked in. If you decide to enable it, you can provide default links for all events, but of course you can add a differnent link for each event, right when you create a new one (in the post options below the textarea)',
                    'help' => '',
                    'template' => 'select_true_false',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'social',
                    'options' => array()
                ),
                'social_facebook_enable' => array(
                    'title' => 'Enable Facebook Button',
                    'description' => 'Show facebook button?',
                    'help' => '',
                    'template' => 'select_true_false',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'social',
                    'options' => array()
                ),
                'social_facebook_url' => array(
                    'title' => 'Facebook Default Url',
                    'description' => 'default url for facebook',
                    'help' => '',
                    'template' => 'input',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'social',
                    'options' => array()
                ),
                'social_twitter_enable' => array(
                    'title' => 'Enable Twitter Button',
                    'description' => 'Show twitter button?',
                    'help' => '',
                    'template' => 'select_true_false',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'social',
                    'options' => array()
                ),
                'social_twitter_url' => array(
                    'title' => 'Twitter Default Url',
                    'description' => 'default url for twitter',
                    'help' => '',
                    'template' => 'input',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'social',
                    'options' => array()
                ),
                'social_linkedin_enable' => array(
                    'title' => 'Enable LinkedIn Button',
                    'description' => 'Show linkedin button?',
                    'help' => '',
                    'template' => 'select_true_false',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'social',
                    'options' => array()
                ),
                'social_linkedin_url' => array(
                    'title' => 'LinkedIn Default Url',
                    'description' => 'default url for linkedin',
                    'help' => '',
                    'template' => 'input',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'social',
                    'options' => array()
                ),
                
            ),
            'bundle' => 'core'
          ),
        'misc' => array(
            'title' => 'Misc',
            'submenu' => array(
                'updates' => array(
                    'title' => 'Updates',
                    'description' => 'Manage the theme updates'
                ),
                'styling' => array(
                    'title' => 'Styling',
                    'description' => 'All style / css related'
                ),
            ),
            'widgets' => array(
                'update_notifications' => array(
                    'title' => 'Update Notifications',
                    'description' => 'Do you want to get notifications if there is an update available?',
                    'help' => 'It will check once a week for new updates.',
                    'template' => 'select_true_false',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'updates',
                    'options' => array()
                ),
                'title_color' => array(
                    'title' => 'Color of Titles',
                    'description' => 'The Standard Blue Color of the title can be changed. Do that here.',
                    'help' => '',
                    'template' => 'colorpicker',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'styling',
                    'options' => array()
                ),
                'css' => array(
                    'title' => 'Custom CSS',
                    'description' => 'If you have css styling you want to load on every page, put it in here. It is loaded after our css, so you can override our classes. But it is also loaded after the custom.css file, so pay attention not to override your own classes.',
                    'help' => 'It will check once a week for new updates.',
                    'template' => 'textarea',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'styling',
                    'options' => array()
                ),
            ),
            'bundle' => 'core'
          ),
        'blog' => array(
            'title' => 'Blog',
            'submenu' => array(
                'general' => array(
                    'title' => 'General',
                    'description' => 'Set up the blog'
                ),
            ),
            'widgets' => array(
                'blog_overview_page' => array(
                    'title' => 'Blog Page',
                    'description' => 'Select a page where you want to display your complete blog. Best is: Create a page called "blog" and select it here.',
                    'help' => '',
                    'template' => 'select_page',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'general',
                    'options' => array()
                ),
            ),
            'bundle' => 'core'
          ),
            
      );

    $images = array();
    for($i=0;$i<4;$i++)
    {
      $images['slider_image_'.$i] = array(
          'menu_item' => 'slider',
          'title' => 'Slider Image '.($i+1),
          'description' => 'Upload an image to display in the slider. Insert the file url in here',
          'help' => '',
          'template' => 'upload',
          'permission' => 'edit_post',
          'scope' => array('event'),
          'options' => array()
      );
    }

    
    $post_modules = array(
        'meta_panel_type' => 'tab',
        'add_scope' => array('post', 'page', 'global'),
        'menu_items' => array(
          'layout' => array(
              'title' => 'Layout',
              'scope' => array('global'),
              'bundle' => 'core'
          ),
          'slider' => array(
              'title' => 'Slider',
              'scope' => array('post', 'page', 'event'),
              'bundle' => 'core',
          ),
          'misc' => array(
              'title' => 'Misc',
              'scope' => array('global'),
              'bundle' => 'core',
          )
        ),
        'widgets' => array(
            'css' => array(
                'menu_item' => 'misc',
                'title' => 'CSS',
                'description' => 'Create some custom CSS',
                'help' => '',
                'template' => 'textarea',
                'permission' => 'edit_post',
                'scope' => array('global'),
                'options' => array()
            ),
        )
    );

    $post_modules['widgets'] = array_merge_recursive($post_modules['widgets'], $images);

    $pages = array(
        
        'bebelHelp' =>
          array(
              'title' => 'Help & Support',
              'page_title' => 'You can get free support here',
              'parent' => 'bebelAdminTop',
              'permission' => 'edit_theme_options',
              'class' => $this->bundleDir
          )
      );
      
    return array('modules' =>$modules, 'pages' => $pages, 'post_modules' => $post_modules);
  }


  

}




