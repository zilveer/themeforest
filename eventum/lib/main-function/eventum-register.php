<?php 
/*-------------------------------------------*
 *      Themeum Widget Registration
 *------------------------------------------*/

if(!function_exists('thmtheme_widdget_init')):

    function thmtheme_widdget_init()
    {

        register_sidebar(array( 'name'          => esc_html__( 'Sidebar', 'eventum' ),
                                'id'            => 'sidebar',
                                'description'   => esc_html__( 'Widgets in this area will be shown on Sidebar.', 'eventum' ),
                                'before_title'  => '<div class="themeum-title"><h3 class="widget_title">',
                                'after_title'   => '</h3></div>',
                                'before_widget' => '<div id="%1$s" class="widget %2$s" >',
                                'after_widget'  => '</div>'
                    )
        );
        global $woocommerce;
        if($woocommerce) {
            register_sidebar(array(
                'name'          => __( 'Shop', 'eventum' ),
                'id'            => 'shop',
                'description'   => __( 'Widgets in this area will be shown on Shop Sidebar.', 'eventum' ),
                'before_title'  => '<div class="themeum-title"><h3 class="widget_title">',
                'after_title'   => '</h3></div>',
                'before_widget' => '<div id="%1$s" class="widget %2$s" >',
                'after_widget'  => '</div>'
                )
            );
        }  

    }
    
    add_action('widgets_init','thmtheme_widdget_init');

endif;




/*-------------------------------------------*
 *      Themeum Style
 *------------------------------------------*/

if(!function_exists('themeum_style')):

    function themeum_style(){
        global $themeum_options;

        wp_enqueue_style('thm-style',get_stylesheet_uri());
        wp_enqueue_script('bootstrap',THMJS.'bootstrap.min.js',array(),false,true);
        wp_enqueue_script('jquery.countdown',THMJS.'jquery.countdown.min.js',array(),false,true);
        wp_enqueue_script( 'googlemap', 'https://maps.google.com/maps/api/js?sensor=false', array(), '',false,true );
        wp_enqueue_script('google-map',THMJS.'gmaps.js',array(),false,true);
        wp_enqueue_script('queryloader2',THMJS.'queryloader2.min.js',array(),false,true);
    
        wp_enqueue_media();
       

        if( isset($themeum_options['custom-preset-en']) && $themeum_options['custom-preset-en']==0 ) {
            wp_enqueue_style( 'themeum-preset', get_template_directory_uri(). '/css/presets/preset' . $themeum_options['preset'] . '.css', array(),false,'all' );       
        }else {
            wp_enqueue_style('quick-preset',get_template_directory_uri().'/quick-preset.php',array(),false,'all');
        }
        wp_enqueue_style('quick-preset',get_template_directory_uri().'/quick-preset.php',array(),false,'all');
        wp_enqueue_style('quick-style',get_template_directory_uri().'/quick-style.php',array(),false,'all');

        wp_enqueue_script('main',THMJS.'main.js',array(),false,true);

    }

    add_action('wp_enqueue_scripts','themeum_style');

endif;




if(!function_exists('themeum_admin_style')):

    function themeum_admin_style(){
        wp_register_script('thmpostmeta', get_template_directory_uri() .'/js/admin/post-meta.js');
        wp_enqueue_script('thmpostmeta');
    }

    add_action('admin_enqueue_scripts','themeum_admin_style');

endif;


/*-------------------------------------------------------
*           Include the TGM Plugin Activation class
*-------------------------------------------------------*/

require_once( get_template_directory()  . '/lib/class-tgm-plugin-activation.php');

add_action( 'tgmpa_register', 'themeum_plugins_include');

if(!function_exists('themeum_plugins_include')):

    function themeum_plugins_include()
    {
        $plugins = array(
                array(
                    'name'                  => 'WPBakery Visual Composer',
                    'slug'                  => 'js_composer',
                    'source'                => get_stylesheet_directory() . '/lib/plugins/js_composer.zip',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),    
                array(
                    'name'                  => 'Revolution Slider',
                    'slug'                  => 'revslider',
                    'source'                => get_stylesheet_directory() . '/lib/plugins/revslider.zip',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),                              
                array(
                    'name'                  => 'Group Meta Box',
                    'slug'                  => 'meta-box-group',
                    'source'                => get_stylesheet_directory() . '/lib/plugins/meta-box-group.zip',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),
                array(
                    'name'                  => 'Themeum Eventum',
                    'slug'                  => 'themeum-eventum',
                    'source'                => get_stylesheet_directory() . '/lib/plugins/themeum-eventum.zip',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ), 
                array(
                    'name'                  => 'Woocoomerce', // The plugin name
                    'slug'                  => 'woocommerce', // The plugin slug (typically the folder name)
                    'required'              => false, // If false, the plugin is only 'recommended' instead of required
                    'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                    'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                    'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                    'external_url'          => 'https://downloads.wordpress.org/plugin/woocommerce.2.5.5.zip', // If set, overrides default API URL and points to an external URL
                ),                               
                array(
                    'name'                  => 'MailChimp for WordPress',
                    'slug'                  => 'mailchimp-for-wp',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => 'https://downloads.wordpress.org/plugin/mailchimp-for-wp.3.1.6.zip',
                ),                                 
                array(
                    'name'                  => 'Widget Settings Importer/Exporter',
                    'slug'                  => 'widget-settings-importexport',
                    'required'              => false,
                    'version'               => '',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => 'https://downloads.wordpress.org/plugin/widget-settings-importexport.1.5.0.zip',
                ),
                array(
                    'name'                  => 'Contact Form 7', // The plugin name
                    'slug'                  => 'contact-form-7', // The plugin slug (typically the folder name)
                    'required'              => false, // If false, the plugin is only 'recommended' instead of required
                    'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                    'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                    'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                    'external_url'          => 'https://downloads.wordpress.org/plugin/contact-form-7.4.4.1.zip', // If set, overrides default API URL and points to an external URL
                ),

            );
    $config = array(
            'domain'            => 'eventum',           // Text domain - likely want to be the same as your theme.
            'default_path'      => '',                           // Default absolute path to pre-packaged plugins
            'parent_menu_slug'  => 'themes.php',                 // Default parent menu slug
            'parent_url_slug'   => 'themes.php',                 // Default parent URL slug
            'menu'              => 'install-required-plugins',   // Menu slug
            'has_notices'       => true,                         // Show admin notices or not
            'is_automatic'      => false,                        // Automatically activate plugins after installation or not
            'message'           => '',                           // Message to output right before the plugins table
            'strings'           => array(
                        'page_title'                                => esc_html__( 'Install Required Plugins', 'eventum' ),
                        'menu_title'                                => esc_html__( 'Install Plugins', 'eventum' ),
                        'installing'                                => esc_html__( 'Installing Plugin: %s', 'eventum' ), // %1$s = plugin name
                        'oops'                                      => esc_html__( 'Something went wrong with the plugin API.', 'eventum'),
                        'return'                                    => esc_html__( 'Return to Required Plugins Installer', 'eventum'),
                        'plugin_activated'                          => esc_html__( 'Plugin activated successfully.','eventum'),
                        'complete'                                  => esc_html__( 'All plugins installed and activated successfully. %s', 'eventum' ) // %1$s = dashboard link
                )
    );

    tgmpa( $plugins, $config );

    }

endif;