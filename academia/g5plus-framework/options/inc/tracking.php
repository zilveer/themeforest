<?php

    /**
     * @package Redux_Tracking
     */
    if ( ! class_exists( 'ReduxFramework' ) ) {
        return;
    }

    /**
     * Class that creates the tracking functionality for Redux, as the core class might be used in more plugins,
     * it's checked for existence first.
     * NOTE: this functionality is opt-in. Disabling the tracking in the settings or saying no when asked will cause
     * this file to not even be loaded.
     */
    if ( ! class_exists( 'Redux_Tracking' ) ) {

        /**
         * Class Redux_Tracking
         */
        class Redux_Tracking {

            public $options = array();
            public $parent;

            /** Refers to a single instance of this class. */
            private static $instance = null;

            /**
             * Creates or returns an instance of this class.
             *
             * @return Redux_Tracking A single instance of this class.
             */
            public static function get_instance() {

                if ( null == self::$instance ) {
                    self::$instance = new self;
                }

                return self::$instance;
            }
            // end get_instance;

            /**
             * Class constructor
             */

            function __construct() {


            }

            /**
             * @param ReduxFramework $parent
             */
            public function load( $parent ) {
                $this->parent = $parent;


                $this->options             = get_option( 'redux-framework-tracking' );
                $this->options['dev_mode'] = $parent->args['dev_mode'];


                $hash = md5( md5( AUTH_KEY . SECURE_AUTH_KEY . '-redux' ) . '-support' );
                add_action( 'wp_ajax_nopriv_' . $hash, array( $this, 'support_args' ) );
                add_action( 'wp_ajax_' . $hash, array( $this, 'support_args' ) );
            }

            function trackingObject() {
                global $blog_id, $wpdb;
                $pts = array();

                foreach ( get_post_types( array( 'public' => true ) ) as $pt ) {
                    $count      = wp_count_posts( $pt );
                    $pts[ $pt ] = $count->publish;
                }

                $comments_count = wp_count_comments();
                $theme_data     = wp_get_theme();
                $theme          = array(
                    'version'  => $theme_data->Version,
                    'name'     => $theme_data->Name,
                    'author'   => $theme_data->Author,
                    'template' => $theme_data->Template,
                );

                if ( ! function_exists( 'get_plugin_data' ) ) {
                    require_once( ABSPATH . 'wp-admin/includes/admin.php' );
                }

                $plugins = array();
                foreach ( get_option( 'active_plugins', array() ) as $plugin_path ) {
                    $plugin_info = get_plugin_data( WP_PLUGIN_DIR . '/' . $plugin_path );

                    $slug             = str_replace( '/' . wp_basename( $plugin_path ), '', $plugin_path );
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
                        $slug             = str_replace( '/' . wp_basename( $plugin_path ), '', $plugin_path );
                        $plugins[ $slug ] = array(
                            'version'    => $plugin_info['Version'],
                            'name'       => $plugin_info['Name'],
                            'plugin_uri' => $plugin_info['PluginURI'],
                            'author'     => $plugin_info['AuthorName'],
                            'author_uri' => $plugin_info['AuthorURI'],
                        );
                    }
                }


                $version = explode( '.', PHP_VERSION );
                $version = array(
                    'major'   => $version[0],
                    'minor'   => $version[0] . '.' . $version[1],
                    'release' => PHP_VERSION
                );

                $user_query     = new WP_User_Query( array( 'blog_id' => $blog_id, 'count_total' => true, ) );
                $comments_query = new WP_Comment_Query();
                $data           = array(
                    '_id'       => $this->options['hash'],
                    'localhost' => ( $_SERVER['REMOTE_ADDR'] === '127.0.0.1' ) ? 1 : 0,
                    'php'       => $version,
                    'site'      => array(
                        'hash'      => $this->options['hash'],
                        'version'   => get_bloginfo( 'version' ),
                        'multisite' => is_multisite(),
                        'users'     => $user_query->get_total(),
                        'lang'      => get_locale(),
                        'wp_debug'  => ( defined( 'WP_DEBUG' ) ? WP_DEBUG ? true : false : false ),
                        'memory'    => WP_MEMORY_LIMIT,
                    ),
                    'pts'       => $pts,
                    'comments'  => array(
                        'total'    => $comments_count->total_comments,
                        'approved' => $comments_count->approved,
                        'spam'     => $comments_count->spam,
                        'pings'    => $comments_query->query( array( 'count' => true, 'type' => 'pingback' ) ),
                    ),
                    'options'   => apply_filters( 'redux/tracking/options', array() ),
                    'theme'     => $theme,
                    'redux'     => array(
                        'mode'      => ReduxFramework::$_is_plugin ? 'plugin' : 'theme',
                        'version'   => ReduxFramework::$_version,
                        'demo_mode' => get_option( 'ReduxFrameworkPlugin' ),
                    ),
                    'developer' => apply_filters( 'redux/tracking/developer', array() ),
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
                if ( function_exists( 'mysql_get_server_info' ) ) {
                    $data['environment']['mysql'] = mysql_get_server_info();
                }
                if ( empty( $data['developer'] ) ) {
                    unset( $data['developer'] );
                }

                return $data;
            }


            function support_args() {
                header( "Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
                header( "Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" );
                header( 'Expires: Sat, 26 Jul 1997 05:00:00 GMT' );
                header( 'Cache-Control: no-store, no-cache, must-revalidate' );
                header( 'Cache-Control: post-check=0, pre-check=0', false );
                header( 'Pragma: no-cache' );
                $instances = ReduxFrameworkInstances::get_all_instances();

                if ( isset( $_REQUEST['i'] ) && ! empty( $_REQUEST['i'] ) ) {
                    if ( is_array( $instances ) && ! empty( $instances ) ) {
                        foreach ( $instances as $opt_name => $data ) {
                            if ( md5( $opt_name . '-debug' ) == $_REQUEST['i'] ) {
                                $array = $instances[ $opt_name ];
                            }
                        }
                    }
                    if ( isset( $array ) ) {
                        if ( isset( $array->extensions ) && is_array( $array->extensions ) && ! empty( $array->extensions ) ) {
                            foreach ( $array->extensions as $key => $extension ) {
                                if ( isset( $extension->$version ) ) {
                                    $array->extensions[ $key ] = $extension->$version;
                                } else {
                                    $array->extensions[ $key ] = true;
                                }
                            }
                        }
                        if ( isset( $array->import_export ) ) {
                            unset( $array->import_export );
                        }
                        if ( isset( $array->debug ) ) {
                            unset( $array->debug );
                        }
                    } else {
                        die();
                    }

                } else {
                    $array = $this->trackingObject();
                    if ( is_array( $instances ) && ! empty( $instances ) ) {
                        $array['instances'] = array();
                        foreach ( $instances as $opt_name => $data ) {
                            $array['instances'][] = $opt_name;
                        }
                    }
                    $array['key'] = md5( AUTH_KEY . SECURE_AUTH_KEY );
                }

                echo @json_encode( $array, true );
                die();
            }

        }

        Redux_Tracking::get_instance();
    }
