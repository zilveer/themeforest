<?php

class X_Addons_Customizer_Manager {

  public static $instance;

  public function __construct() {

    if ( isset( $_GET['page'] ) && 'x-addons-home' === $_GET['page'] && isset( $_POST['tco-customizer-export'] ) ) {
      $this->export();
    }

    X_Addons_Home::add_script_data( 'x-customizer-manager', array( $this, 'script_data' ) );

    add_action( 'wp_ajax_x_customizer_manager_reset', array( $this, 'ajax_reset' ) );
    add_action( 'wp_ajax_x_customizer_manager_import', array( $this, 'ajax_import' ) );

    add_action( 'x_customizer_manager_reset', 'x_bust_google_fonts_cache' );
    add_action( 'x_customizer_manager_import', 'x_bust_google_fonts_cache' );
  }

  public function import( $options ) {

    foreach ( $options as $key => $value ) {
      update_option( $key, $value );
    }

    do_action( 'x_customizer_manager_import' );

  }

  public function export() {

    global $customizer_settings_data;

    $blogname  = strtolower( str_replace( ' ', '-', get_option( 'blogname' ) ) );
    $file_name = $blogname . '-xcs';

    foreach ( $customizer_settings_data as $option => $default ) {
      $value         = maybe_unserialize( get_option( $option, $default ) );
      $data[$option] = $value;
    }

    header( 'Content-Type: text/json; charset=' . get_option( 'blog_charset' ) );
    header( 'Content-Disposition: attachment; filename="' . $file_name . '.json"' );

    echo json_encode( $data );
    exit;

  }

  public function reset() {

    global $customizer_settings_data;

    foreach ( $customizer_settings_data as $option => $default ) {
      delete_option( $option );
    }

    do_action( 'x_customizer_manager_reset' );

  }

  public function ajax_reset() {

    x_tco()->check_ajax_referer();

    if ( ! current_user_can( 'manage_options' ) ) {
      wp_send_json_error( array( 'message' => 'Unable to reset' ) );
    }

    $this->reset();
    wp_send_json_success();

  }

  public function ajax_import() {

    x_tco()->check_ajax_referer();

    if ( ! current_user_can( 'manage_options' ) || ! isset( $_POST['import'] ) || ! $_POST['import'] ) {
      wp_send_json_error( array( 'message' => 'Missing import data' ) );
    }

    if ( ! is_array( $_POST['import'] ) ) {
      wp_send_json_error( array( 'message' => 'Corrupt import data' ) );
    }

    $this->import( $_POST['import'] );

    wp_send_json_success();

  }

  public function script_data() {
    return array(
      'yep'              => __( 'Yes, Proceed', '__x__' ),
      'nope'             => __( 'No, Take me back', '__x__' ),
      'useModernBrowser' => __( 'Modern browser required to use importer.', '__x__' ),
      'importBegin'      => __( 'Importing&hellip;', '__x__' ),
      'importSuccess'    => __( 'All set! Settings imported.', '__x__' ),
      'importError'      => __( 'The uploaded file was not a valid XCS export.', '__x__' ),
      'importConfirm'    => __( 'This will overwrite your Customizer settings and is not reversible unless you have previously made a backup of your settings. Are you sure you want to proceed?', '__x__' ),
      'export'           => __( 'Downloading XCS file&hellip;', '__x__' ),
      'resetBegin'       => __( 'Resetting&hellip;', '__x__' ),
      'resetSuccess'     => __( 'Customizer settings successfully reset!', '__x__' ),
      'resetError'       => __( 'X was unable to reset the Customizer.', '__x__' ),
      'resetConfirm'     => __( 'This will reset your Customizer settings and is not reversible unless you have previously made a backup of your settings. Are you sure you want to proceed?', '__x__' )
    );
  }

  public static function instance() {
    if ( ! isset( self::$instance ) ) {
      self::$instance = new self;
    }
    return self::$instance;
  }

}