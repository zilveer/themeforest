<?php

class Porto_Admin {

    public function __construct() {
        add_action( 'admin_init', array( $this, 'admin_init' ) );
        add_action( 'wp_before_admin_bar_render', array( $this, 'add_wp_toolbar_menu' ) );
        add_action( 'admin_menu', array( $this, 'admin_menu' ) );
        add_action( 'after_switch_theme', array( $this, 'activation_redirect' ) );
    }

    public function add_wp_toolbar_menu() {

        if ( current_user_can( 'edit_theme_options' ) ) {

            $porto_parent_menu_title = '<span class="ab-icon"></span><span class="ab-label">Porto</span>';

            $this->add_wp_toolbar_menu_item( $porto_parent_menu_title, false, admin_url( 'admin.php?page=porto' ), array( 'class' => 'porto-menu' ), 'porto' );
            $this->add_wp_toolbar_menu_item( __( 'System Status', 'Porto' ), 'porto', admin_url( 'admin.php?page=porto-system' ) );
            $this->add_wp_toolbar_menu_item( __( 'Plugins', 'Porto' ), 'porto', admin_url( 'admin.php?page=porto-plugins' ) );
            $this->add_wp_toolbar_menu_item( __( 'Install Demos', 'Porto' ), 'porto', admin_url( 'admin.php?page=porto-demos' ) );
            $this->add_wp_toolbar_menu_item( __( 'Theme Options', 'Porto' ), 'porto', admin_url( 'themes.php?page=porto_settings' ) );
        }
    }

    public function add_wp_toolbar_menu_item( $title, $parent = false, $href = '', $custom_meta = array(), $custom_id = '' ) {

        global $wp_admin_bar;

        if ( current_user_can( 'edit_theme_options' ) ) {
            if ( ! is_super_admin() || ! is_admin_bar_showing() ) {
                return;
            }

            // Set custom ID
            if ( $custom_id ) {
                $id = $custom_id;
            } else { // Generate ID based on $title
                $id = strtolower( str_replace( ' ', '-', $title ) );
            }

            // links from the current host will open in the current window
            $meta = strpos( $href, site_url() ) !== false ? array() : array( 'target' => '_blank' ); // external links open in new tab/window
            $meta = array_merge( $meta, $custom_meta );

            $wp_admin_bar->add_node( array(
                'parent' => $parent,
                'id'     => $id,
                'title'  => $title,
                'href'   => $href,
                'meta'   => $meta,
            ) );
        }

    }

    public function activation_redirect() {
        if ( current_user_can( 'edit_theme_options' ) ) {
            header( 'Location:' . admin_url() . 'admin.php?page=porto' );
        }
    }

    public function admin_init() {

        if ( current_user_can( 'edit_theme_options' ) ) {
            if ( isset( $_GET['porto-deactivate'] ) && 'deactivate-plugin' == $_GET['porto-deactivate'] ) {
                check_admin_referer( 'porto-deactivate', 'porto-deactivate-nonce' );

                $plugins = TGM_Plugin_Activation::$instance->plugins;

                foreach ( $plugins as $plugin ) {
                    if ( $plugin['slug'] == $_GET['plugin'] ) {
                        deactivate_plugins( $plugin['file_path'] );
                    }
                }
            } if ( isset( $_GET['porto-activate'] ) && 'activate-plugin' == $_GET['porto-activate'] ) {
                check_admin_referer( 'porto-activate', 'porto-activate-nonce' );

                $plugins = TGM_Plugin_Activation::$instance->plugins;

                foreach ( $plugins as $plugin ) {
                    if ( isset( $_GET['plugin'] ) && $plugin['slug'] == $_GET['plugin'] ) {
                        activate_plugin( $plugin['file_path'] );

                        wp_redirect( admin_url( 'admin.php?page=porto-plugins' ) );
                        exit;
                    }
                }
            }
        }
    }

    public function admin_menu(){

        if ( current_user_can( 'edit_theme_options' ) ) {
            $welcome_screen = add_menu_page( 'Porto', 'Porto', 'administrator', 'porto', array( $this, 'welcome_screen' ), 'dashicons-porto-logo', 59 );

            $welcome       = add_submenu_page( 'porto', __( 'Welcome', 'Porto' ), __( 'Welcome', 'Porto' ), 'administrator', 'porto', array( $this, 'welcome_screen' ) );
            $system_status = add_submenu_page( 'porto', __( 'System Status', 'Porto' ), __( 'System Status', 'Porto' ), 'administrator', 'porto-system', array( $this, 'system_tab' ) );
            $plugins       = add_submenu_page( 'porto', __( 'Plugins', 'Porto' ), __( 'Plugins', 'Porto' ), 'administrator', 'porto-plugins', array( $this, 'plugins_tab' ) );
            $demos         = add_submenu_page( 'porto', __( 'Install Demos', 'Porto' ), __( 'Install Demos', 'Porto' ), 'administrator', 'porto-demos', array( $this, 'demos_tab' ) );
            $theme_options = add_submenu_page( 'porto', __( 'Theme Options', 'Porto' ), __( 'Theme Options', 'Porto' ), 'administrator', 'themes.php?page=porto_settings' );
        }
    }

    public function welcome_screen() {
        require_once( porto_admin . '/admin_pages/welcome.php' );
    }

    public function system_tab() {
        require_once( porto_admin . '/admin_pages/system-status.php' );
    }

    public function demos_tab() {
        require_once( porto_admin . '/admin_pages/install-demos.php' );
    }

    public function plugins_tab() {
        require_once( porto_admin . '/admin_pages/porto-plugins.php' );
    }

    public function plugin_link( $item ) {
        $installed_plugins = get_plugins();

        $item['sanitized_plugin'] = $item['name'];

        $actions = array();

        // We have a repo plugin
        if ( ! $item['version'] ) {
            $item['version'] = TGM_Plugin_Activation::$instance->does_plugin_have_update( $item['slug'] );
        }

        /** We need to display the 'Install' hover link */
        if ( ! isset( $installed_plugins[$item['file_path']] ) ) {
            $actions = array(
                'install' => sprintf(
                    '<a href="%1$s" class="button button-primary" title="Install %2$s">Install</a>',
                    esc_url( wp_nonce_url(
                        add_query_arg(
                            array(
                                'page'          => urlencode( TGM_Plugin_Activation::$instance->menu ),
                                'plugin'        => urlencode( $item['slug'] ),
                                'plugin_name'   => urlencode( $item['sanitized_plugin'] ),
                                'plugin_source' => urlencode( $item['source'] ),
                                'tgmpa-install' => 'install-plugin',
                                'return_url'    => 'porto-plugins',
                            ),
                            TGM_Plugin_Activation::$instance->get_tgmpa_url()
                        ),
                        'tgmpa-install',
                        'tgmpa-nonce'
                    ) ),
                    $item['sanitized_plugin']
                ),
            );
        }
        /** We need to display the 'Activate' hover link */
        elseif ( is_plugin_inactive( $item['file_path'] ) ) {
            $actions = array(
                'activate' => sprintf(
                    '<a href="%1$s" class="button button-primary" title="Activate %2$s">Activate</a>',
                    esc_url( add_query_arg(
                        array(
                            'plugin'               => urlencode( $item['slug'] ),
                            'plugin_name'          => urlencode( $item['sanitized_plugin'] ),
                            'plugin_source'        => urlencode( $item['source'] ),
                            'porto-activate'       => 'activate-plugin',
                            'porto-activate-nonce' => wp_create_nonce( 'porto-activate' ),
                        ),
                        admin_url( 'admin.php?page=porto-plugins' )
                    ) ),
                    $item['sanitized_plugin']
                ),
            );
        }
        /** We need to display the 'Update' hover link */
        elseif ( version_compare( $installed_plugins[$item['file_path']]['Version'], $item['version'], '<' ) ) {
            $actions = array(
                'update' => sprintf(
                    '<a href="%1$s" class="button button-primary" title="Install %2$s">Update</a>',
                    wp_nonce_url(
                        add_query_arg(
                            array(
                                'page'          => urlencode( TGM_Plugin_Activation::$instance->menu ),
                                'plugin'        => urlencode( $item['slug'] ),

                                'tgmpa-update'  => 'update-plugin',
                                'plugin_source' => urlencode( $item['source'] ),
                                'version'       => urlencode( $item['version'] ),
                                'return_url'    => 'porto-plugins',
                            ),
                            TGM_Plugin_Activation::$instance->get_tgmpa_url()
                        ),
                        'tgmpa-update',
                        'tgmpa-nonce'
                    ),
                    $item['sanitized_plugin']
                ),
            );
        } elseif ( is_plugin_active( $item['file_path'] ) ) {
            $actions = array(
                'deactivate' => sprintf(
                    '<a href="%1$s" class="button button-primary" title="Deactivate %2$s">Deactivate</a>',
                    esc_url( add_query_arg(
                        array(
                            'plugin'                 => urlencode( $item['slug'] ),
                            'plugin_name'            => urlencode( $item['sanitized_plugin'] ),
                            'plugin_source'          => urlencode( $item['source'] ),
                            'porto-deactivate'       => 'deactivate-plugin',
                            'porto-deactivate-nonce' => wp_create_nonce( 'porto-deactivate' ),
                        ),
                        admin_url( 'admin.php?page=porto-plugins' )
                    ) ),
                    $item['sanitized_plugin']
                ),
            );
        }

        return $actions;
    }

    public function let_to_num( $size ) {
        $l   = substr( $size, -1 );
        $ret = substr( $size, 0, -1 );
        switch ( strtoupper( $l ) ) {
            case 'P':
                $ret *= 1024;
            case 'T':
                $ret *= 1024;
            case 'G':
                $ret *= 1024;
            case 'M':
                $ret *= 1024;
            case 'K':
                $ret *= 1024;
        }
        return $ret;
    }
}

new Porto_Admin();

require_once(porto_admin . '/theme_options.php');


