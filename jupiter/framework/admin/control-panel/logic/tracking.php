<?php
if (!defined('THEME_FRAMEWORK')) exit('No direct script access allowed');

/**
 * Class that creates the tracking functionality. Plugin, shortcode, widget and some other
 * statisics will be anonymously be sent to the athor of theme
 * NOTE: this functionality is opt-in. Disabling the tracking in the settings or saying no when asked will cause 
 * this file to not even be loaded.
 *
 * @author      Bob Ulusoy
 * @copyright   Artbees LTD (c)
 * @link        http://artbees.net
 * @since       Version 5.1
 * @package     artbees
 */


   class Mk_Tracking
   {
       
       function __construct()
       {

        $this->allow_tracking = get_option( 'jupiter-data-tracking' );
        $this->hash = get_option( 'jupiter-data-tracking-hash' );

        // We send a hashed identifier to recognise this site without compromising the privacy
        if ( ! isset( $this->hash ) || ! $this->hash || empty( $this->hash ) ) {
            $this->hash = md5( network_site_url() . '-' . $_SERVER['REMOTE_ADDR'] . time() );
            update_option( 'jupiter-data-tracking-hash', $this->hash );
        }

        add_action( 'wp_ajax_mk_allow_tracking', array(&$this, 'allow_tracking_callback') );

        // Load scripts
        if(empty($this->allow_tracking)) {
            add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_media' ) );
        }


        if ( !empty( $this->allow_tracking ) && $this->allow_tracking == 'yes' ) {
            // The tracking checks daily, but only sends new data every 7 days.
            if ( ! wp_next_scheduled( 'jupiter_theme_tracking' ) ) {
                wp_schedule_event( time(), 'daily', 'jupiter_theme_tracking' );
            }
            add_action( 'jupiter_theme_tracking', array( $this, 'tracking' ) );
        }
           
       }


       function enqueue_media() {
            wp_enqueue_style( 'wp-pointer' );
            wp_enqueue_script( 'jquery' );
            wp_enqueue_script( 'jquery-ui' );
            wp_enqueue_script( 'wp-pointer' );
            wp_enqueue_script( 'utils' );
            add_action( 'admin_print_footer_scripts', array( $this, 'tracking_request' ) );
       }


        /**
         * Shows a popup that asks for permission to allow tracking.
         */
        function tracking_request() {
            $id    = '#wpadminbar';
            $nonce = wp_create_nonce( 'mk_activate_tracking' );

            $content = '<h3>' . __( 'Help us make a better Jupiter for you!', 'mk_framework' ) . '</h3>';
            $content .= '<p>' . __( 'By allowing us to learn how you are using Jupiter, you can help us to fix hidden bugs and release more useful features and flawless updates over the time. We assure you that your privacy will never be compromised and only non-sensitive usage of data will be transferred through a safe Wordpress native channel.', 'mk_framework' ) . '</p>';
            $opt_arr = array(
                'content'  => $content,
                'pointerWidth' => 370,
                'position' => array( 'edge' => 'top', 'align' => 'center' )
            );
            $button2 = __( 'Allow tracking', 'mk_framework' );

            $function2 = 'mk_store_answer("yes","' . $nonce . '")';
            $function1 = 'mk_store_answer("no","' . $nonce . '")';

            $this->print_scripts( $id, $opt_arr, __( 'Do not allow tracking', 'mk_framework' ), $button2, $function2, $function1 );
        }

         function allow_tracking_callback() {

            if ( wp_verify_nonce( $_REQUEST['nonce'], 'mk_activate_tracking' ) ) {

                if ( update_option( 'jupiter-data-tracking', $_REQUEST['allow_tracking'] ) ) {

                    die( '1' );

                } else {
                    die( '0' );
                }
            } else {
                die( '-1' );
            }
        }

         /**
         * Prints the pointer script
         *
         * @param string      $selector         The CSS selector the pointer is attached to.
         * @param array       $options          The options for the pointer.
         * @param string      $button1          Text for button 1
         * @param string|bool $button2          Text for button 2 (or false to not show it, defaults to false)
         * @param string      $button2_function The JavaScript function to attach to button 2
         * @param string      $button1_function The JavaScript function to attach to button 1
         */
        function print_scripts( $selector, $options, $button1, $button2 = false, $button2_function = '', $button1_function = '' ) {
            ?>
            <script type="text/javascript">
                //<![CDATA[
                //
                (function( $ ) {
                    $( document ).ready(
                        function() {
                            var mk_pointer_options = <?php echo json_encode($options); ?>, setup;

                            function mk_store_answer( input, nonce ) {
                                var mk_tracking_data = {
                                    action: 'mk_allow_tracking',
                                    allow_tracking: input,
                                    nonce: nonce
                                }
                                jQuery.post(
                                    ajaxurl, mk_tracking_data, function() {
                                        jQuery( '#wp-pointer-0' ).remove();
                                    }
                                );
                            }

                            mk_pointer_options = $.extend(
                                mk_pointer_options, {
                                    buttons: function( event, t ) {
                                        button = jQuery( '<a id="pointer-close" style="margin-left:5px" class="button-secondary">' + '<?php echo $button1; ?>' + '</a>' );
                                        button.bind(
                                            'click.pointer', function() {
                                                t.element.pointer( 'close' );
                                            }
                                        );
                                        return button;
                                    },
                                    close: function() {
                                    }
                                }
                            );

                            setup = function() {
                                $( '<?php echo $selector; ?>' ).pointer( mk_pointer_options ).pointer( 'open' );
                                <?php if ($button2) { ?>
                                jQuery( '#pointer-close' ).after( '<a id="pointer-primary" class="button-primary">' + '<?php echo $button2; ?>' + '</a>' );
                                jQuery( '#pointer-primary' ).click(
                                    function() {
                                        <?php echo $button2_function; ?>
                                    }
                                );
                                jQuery( '#pointer-close' ).click(
                                    function() {
                                        <?php if ($button1_function == '') { ?>
                                        mk_store_answer( input, nonce )
                                        <?php } else { ?>
                                        <?php echo $button1_function; ?>
                                        <?php } ?>
                                    }
                                );
                                <?php } else if ($button1 && !$button2) { ?>
                                jQuery( '#pointer-close' ).click(
                                    function() {
                                        <?php if ($button1_function != '') { ?>
                                        <?php echo $button1_function; ?>
                                        <?php } ?>
                                    }
                                );
                                <?php } ?>
                            };

                            if ( mk_pointer_options.position && mk_pointer_options.position.defer_loading )
                                $( window ).bind( 'load.wp-pointers', setup );
                            else
                                $( document ).ready( setup );
                        }
                    );
                })( jQuery );
                //]]>
            </script>
        <?php
        }


        function trackingObject() {
                global $blog_id, $wpdb, $mk_options;
                $posts_count = array();


                /**
                * Removing useless data from theme options array.
                */     
                unset(
                        $mk_options['custom_js'],
                        $mk_options['custom_css'],
                        $mk_options['twitter_consumer_key'],
                        $mk_options['twitter_consumer_secret'],
                        $mk_options['twitter_access_token'],
                        $mk_options['twitter_access_token_secret'],
                        $mk_options['typekit_id'],
                        $mk_options['analytics'],
                        $mk_options['custom_favicon'],
                        $mk_options['logo'],
                        $mk_options['light_header_logo'],
                        $mk_options['responsive_logo'],
                        $mk_options['footer_logo'],
                        $mk_options['iphone_icon'],
                        $mk_options['iphone_icon_retina'],
                        $mk_options['ipad_icon'],
                        $mk_options['sticky_header_logo'],
                        $mk_options['preloader_logo'],
                        $mk_options['_wp_http_referer'],
                        $mk_options['button_clicked'],
                        $mk_options['theme_import_options'],
                        $mk_options['mailchimp_api_key'],
                        $mk_options['ipad_icon_retina'],
                        $mk_options['header_toolbar_tagline'],
                        $mk_options['header_toolbar_phone'],
                        $mk_options['header_toolbar_email'],
                        $mk_options['mailchimp_action_url'],
                        $mk_options['vertical_menu_copyright'],
                        $mk_options['header_social_sites_select'],
                        $mk_options['header_social_url'],
                        $mk_options['header_social_networks_site'],
                        $mk_options['header_social_networks_url'],
                        $mk_options['add_sidebar'],
                        $mk_options['sidebars'],
                        $mk_options['copyright'],
                        $mk_options['quick_contact_title'],
                        $mk_options['quick_contact_email'],
                        $mk_options['quick_contact_desc']
                );


                /**
                * Posts Count
                */      
                foreach ( get_post_types( array( 'public' => true ) ) as $pt ) {
                    $count      = wp_count_posts( $pt );
                    if($count->publish != 0) {
                        $posts_count[ $pt ] = $count->publish;
                    }
                }

                $comments_count = wp_count_comments();
                $theme_data     = wp_get_theme();
                $imported_template = get_option('jupiter_template_installed');
                $theme          = array(
                    'version'  => $theme_data->Version,
                    'name'     => $theme_data->Name,
                    'author'   => $theme_data->Author,
                );
                if(isset($imported_template)) {
                    $theme['template'] = $imported_template;
                }


                if ( ! function_exists( 'get_plugin_data' ) ) {
                    require_once( ABSPATH . 'wp-admin/includes/admin.php' );
                }

                $plugins = array();
                foreach ( get_option( 'active_plugins', array() ) as $plugin_path ) {
                    $plugin_info = get_plugin_data( WP_PLUGIN_DIR . '/' . $plugin_path );

                    $slug             = str_replace( '/' . basename( $plugin_path ), '', $plugin_path );
                    $plugins[ $slug ] = array(
                        'version'    => $plugin_info['Version'],
                        'name'       => $plugin_info['Name'],
                        'plugin_uri' => $plugin_info['PluginURI'],
                        'author'     => $plugin_info['AuthorName'],
                        'author_uri' => $plugin_info['AuthorURI'],
                    );
                }
                if ( is_multisite() ) {
                    foreach ( get_option( 'active_sitewide_plugins', array() ) as $plugin_path ) {
                        $plugin_info      = get_plugin_data( WP_PLUGIN_DIR . '/' . $plugin_path );
                        $slug             = str_replace( '/' . basename( $plugin_path ), '', $plugin_path );
                        $plugins[ $slug ] = array(
                            'version'    => $plugin_info['Version'],
                            'name'       => $plugin_info['Name'],
                            'plugin_uri' => $plugin_info['PluginURI'],
                            'author'     => $plugin_info['AuthorName'],
                            'author_uri' => $plugin_info['AuthorURI'],
                        );
                    }
                }


                $user_query     = new WP_User_Query( array( 'blog_id' => $blog_id, 'count_total' => true, ) );
                $comments_query = new WP_Comment_Query();
                $data           = array(
                    'id'        => $this->hash,
                    'php'       => PHP_VERSION,
                    'site'      => array(
                        'version'   => get_bloginfo( 'version' ),
                        'multisite' => is_multisite(),
                        'users'     => $user_query->get_total(),
                        'lang'      => get_locale(),
                        'wp_debug'  => ( defined( 'WP_DEBUG' ) ? WP_DEBUG ? true : false : false ),
                        'memory'    => WP_MEMORY_LIMIT,
                    ),
                    'posts'       => $posts_count,
                    'shortcodes'  => $this->get_active_shortcodes(),
                    'widgets'     => $this->get_active_widgets(),
                    'options'   => $mk_options,
                    'theme'     => $theme,
                    'plugins'   => $plugins,
                );

                $parts    = explode( ' ', $_SERVER['SERVER_SOFTWARE'] );
                $software = array();
                foreach ( $parts as $part ) {
                    if ( $part[0] == "(" ) {
                        continue;
                    }
                    if ( strpos( $part, '/' ) !== false ) {
                        $chunk                               = explode( "/", $part );
                        $software[ strtolower( $chunk[0] ) ] = $chunk[1];
                    }
                }
                $software['full']    = $_SERVER['SERVER_SOFTWARE'];
                $data['environment'] = $software;
                if ( empty( $data['developer'] ) ) {
                    unset( $data['developer'] );
                }

                // Check if user registered the product
                $mk_artbees_products = new mk_artbees_products();
                
                $data['is_verified'] = $mk_artbees_products->is_verified_artbees_customer(false);

                return $data;
            }

            /**
             * Main tracking function.
             */
            function tracking() {

                $data = get_transient( 'jupiter_tracking_cache' );
                if ( ! $data ) {

                    $args = array(
                        'body' => $this->trackingObject()
                    );

                    $response = wp_remote_post( 'https://artbees.net/api/v1/tracking', $args );

                    // Store for a week, then push data again.
                    set_transient( 'jupiter_tracking_cache', true, WEEK_IN_SECONDS );
                }
            }


            /**
             * Gets the list of active and used shortcodes. It only applies for theme built-in shortcodes
             */
            private function get_active_shortcodes(){
                global $wpdb;
                
                $table_name = $wpdb->prefix . 'mk_components';
                
                $results =  $wpdb->get_results("SELECT name FROM $table_name");

                $shortcodes = array();
                if(!empty($results)) {
                    foreach ($results as $shortcode) {
                        $shortcodes[] = $shortcode->name;
                    }
                }

                return $shortcodes;
            }


            /**
             * Get list of active widgets
             */

            function get_active_widgets() {
                $widgets = get_option( 'sidebars_widgets' );

                // Remove inactive widgets from the array
                unset($widgets['wp_inactive_widgets']);

                foreach ($widgets as $sidebar) {
                    if(is_array($sidebar) && !empty($sidebar)) {
                        foreach ($sidebar as $widget) {
                            $widget_list[] = substr_replace($widget, '', strpos($widget, '-'));
                        }
                    }
                }

                return array_unique($widget_list);
            }



   }   

   new Mk_Tracking();