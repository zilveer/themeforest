<?php

class X_Addons_Extensions {

  public static $instance;

  public function __construct() {

    X_Addons_Home::add_script_data( 'x-extension', array( $this, 'script_data_extensions' ) );
    X_Addons_Home::add_script_data( 'x-auto-configure-cornerstone', array( $this, 'script_data_auto_configure_cornerstone' ) );
    add_action( 'wp_ajax_x_extensions_installer', array( $this, 'ajax_install_plugin' ) );
    add_action( 'wp_ajax_x_auto_install_cornerstone', array( $this, 'ajax_auto_install_cornerstone' ) );
    add_action( 'wp_ajax_x_auto_activate_cornerstone', array( $this, 'ajax_auto_activate_cornerstone' ) );
    add_action( 'x_addons_before_home', array( $this, 'auto_install_cornerstone' ) );

    $this->cs_install_error  = sprintf( __( 'We attempted to installed Cornerstone (required by X) automatically, but were unable to. You may need to <a target="_blank" href="%s">install Cornerstone manually</a>. <a data-tco-error-details href="#">Error Details.</a>', '__x__' ), 'https://community.theme.co/kb/manual-plugin-installation/' );
    $this->cs_activate_error = sprintf( __( 'Cornerstone has been installed, but could not be automatically activated. Please activate from the <a href="%s">plugins page</a>. <a data-tco-error-details href="#">Error Details.</a>', '__x__' ), admin_url( 'plugins.php' ) );
  }

  public function script_data_extensions() {
    return array(
      'extensions'      => self::get_extension_list(),
      'approvedPlugins' => self::get_approved_plugins_list(),
      'error'           => __( 'Error encountered.', '__x__' ),
      'installed'       => __( 'Go Activate', '__x__' ),
      'activated'       => __( 'Installed & Activated', '__x__' ),
      'pluginsURI'      => admin_url( 'plugins.php' ),
      'errorBack'       => __( 'Go Back', '__x__' ),
    );
  }

  public function script_data_auto_configure_cornerstone() {
    return array(
      'errors' => array(
        'install'  => $this->cs_install_error,
        'activate' => $this->cs_activate_error
      )
    );
  }

  public function ajax_install_plugin() {

    x_tco()->check_ajax_referer();

    if ( ! current_user_can( 'install_plugins' ) || ! isset( $_POST['plugin'] ) || ! $_POST['plugin'] ) {
      wp_send_json_error( array( 'message' => 'No plugin specified' ) );
    }

    if ( ! isset( $_POST['package'] ) || ! $_POST['package'] ) {
      wp_send_json_error( array( 'message' => 'No package provided' ) );
    }

    $install = $this->install_plugin( array(
      'plugin'   => $_POST['plugin'],
      'package'  => $_POST['package'],
    ) );

    if ( is_wp_error( $install ) ) {
      wp_send_json_error( array( 'message' => $install->get_error_message() ) );
    }

    wp_send_json_success( array( 'plugin' => $_POST['plugin'] ) );

  }


  public function auto_install_cornerstone() {

    if ( self::cornerstone_installed() ) {
      $state = ( self::cornerstone_activated() ) ? 'ready' : 'activate';
    } else {
      $state = 'install';
    }

    echo '<div data-tco-module="x-auto-configure-cornerstone" data-tco-module-state="'. $state . '"></div>';

  }

  public function ajax_auto_install_cornerstone() {

    x_tco()->check_ajax_referer();

    if ( self::cornerstone_installed() || ! current_user_can( 'install_plugins' ) ) {
      wp_send_json_error();
    }


    $install = $this->install_plugin( array(
      'plugin'   => 'cornerstone/cornerstone.php',
      'package'  => X_TEMPLATE_PATH . '/framework/plugins/cornerstone.zip',
    ) );

    if ( is_wp_error( $install ) ) {
      wp_send_json_error( array(
        'message' => $this->cs_install_error,
        'errorDetails' => $install->get_error_message(),
      ) );
    } else {
      wp_send_json_success( array(
        'message' => __( 'Cornerstone (required by X) has been automatically installed.', '__x__' )
      ));
    }

  }

  public function ajax_auto_activate_cornerstone() {

    x_tco()->check_ajax_referer();

    $activate = activate_plugin( 'cornerstone/cornerstone.php', '', false, true );

    if ( is_wp_error( $activate ) ) {
      wp_send_json_error( array(
        'message' => $this->cs_activate_error,
        'errorDetails' => $activate->get_error_message(),
      ) );
    } else {
      wp_send_json_success( array(
        'message' => __( 'We noticed Cornerstone was installed but not activated. By visiting the X Addons page, Cornerstone has been activated automatically.', '__x__' )
      ) );
    }

  }

  public function silent_permission_check() {

    // Silent permission check
    ob_start();
    $creds = request_filesystem_credentials( '', '', false, false, null );
    ob_get_clean();

    // Abort if permissions were not available.
    if ( ! WP_Filesystem( $creds ) )
      return false;

    return true;

  }

  public function install_plugin( $args ) {

    $args = wp_parse_args( $args, array(
      'plugin'   => '',
      'package'  => '', //The full local path or URI of the package.
      'activate' => false
    ) );

    // Nothing to do if already installed
    if ( self::plugin_installed( $args['plugin'] ) ) {
      return new WP_Error( 'x-addons-extensions', __( 'Plugin already installed.', '__x__' ) );
    }

    // Run an early permissions check silently to avoid output from the native one
    if ( ! $this->silent_permission_check() ) {
      return new WP_Error( 'x-addons-extensions', __( 'Your WordPress file permissions do not allow plugins to be installed.', '__x__' ) );;
    }

    require_once ABSPATH . 'wp-admin/includes/plugin-install.php';
    require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
    require_once X_TEMPLATE_PATH . '/framework/functions/global/admin/addons/updates/class-x-plugin-upgrader-skin.php';

    $skin = new X_Plugin_Upgrader_Skin( array( 'plugin' => $args['plugin'] ) );
    $upgrader = new Plugin_Upgrader( $skin );
    $upgrader->install( $args['package'] );

    if ( $args['activate'] ) {
      $activate = activate_plugin( $upgrader->plugin_info(), '', false, true );
      if ( is_wp_error( $activate ) ) {
        return $activate;
      }
    }

    return $skin->result;

  }

  public static function get_extension_list() {
    return self::prepare_list( get_site_option( 'x_extension_list', array() ) );
  }

  public static function get_approved_plugins_list() {
    $plugins = include X_TEMPLATE_PATH . '/framework/functions/global/admin/addons/approved-plugins.php';
    return self::prepare_list( $plugins );
  }

  public static function prepare_list( $items ) {

    usort( $items, array( 'X_Addons_Extensions', 'extension_sort') );

    $list = array();

    foreach ( $items as $key => $value) {
      $value['installed'] = ( isset( $value['plugin'] ) ) ? self::plugin_installed( $value['plugin'] ) : false;
      if ( $value['installed'] ) {
        $value['activated'] = is_plugin_active( $value['plugin'] );
      }
      $list[$value['slug']] = $value;
    }

    return $list;

  }

  public static function extension_sort( $a, $b ) {
    if ( ! isset( $a['title'] ) || ! isset( $b['title'] ) ) {
      return false;
    }
    return strcmp( strtolower( $a['title'] ), strtolower( $b['title'] ) );
  }

  public static function plugin_installed( $plugin ) {
    return file_exists( WP_PLUGIN_DIR . '/' . $plugin );
  }

  public static function cornerstone_installed() {
    return self::plugin_installed( 'cornerstone/cornerstone.php' );
  }

  public static function cornerstone_activated() {
    return is_plugin_active( 'cornerstone/cornerstone.php' );
  }

  public static function instance() {
    if ( ! isset( self::$instance ) ) {
      self::$instance = new self;
    }
    return self::$instance;
  }

}