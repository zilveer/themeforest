<?php

// =============================================================================
// FUNCTIONS/GLOBAL/ADMIN/ADDONS/CLASS-THEME-UPDATER.PHP
// -----------------------------------------------------------------------------
// The theme updater.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Theme Updater
// =============================================================================

// Theme Updater
// =============================================================================

class X_Theme_Updater {

  //
  // Setup hooks.
  //

  public function __construct() {

    if ( is_admin() && isset( $_GET['force-check'] ) ) {
      delete_site_transient( 'update_plugins' );
    }

    add_filter( 'pre_set_site_transient_update_themes', array( $this, 'pre_set_site_transient_update_themes' ) );

    if ( ! is_multisite() ) {
      add_filter( 'wp_prepare_themes_for_js', array( $this, 'customize_theme_update_html' ) );
    }

  }


  //
  // Filter the update transient and supply new version if one is detected.
  //

  public function pre_set_site_transient_update_themes( $data ) {

    $update_cache = x_tco()->updates()->get_update_cache();

    if ( !isset( $update_cache['themes'] ) || !isset( $update_cache['themes']['x'] ) ) {
      return $data;
    }

    $themes = ( is_multisite() ) ? $this->multisite_get_themes() : wp_get_themes();

    if ( isset( $themes['x'] ) ) {

      $remote = $update_cache['themes']['x'];

      if ( version_compare( $remote['new_version'], $themes['x']->get( 'Version' ), '<=' ) ) {
        return $data;
      }

      if ( !$remote['package'] ) {
        $remote['new_version'] = $remote['new_version'] . '<br/>' . X_Addons_Updates::get_validation_html_theme_updates();
      }

      $data->response[ 'x' ] = $remote;

    }

    return $data;

  }


  //
  // Get array of all themes in multisite.
  //
  // The wp_get_themes() function does not seem to work under network
  // activation in the same way as in a single install.
  //

  private function multisite_get_themes() {

    $themes     = array();
    $theme_dirs = scandir( get_theme_root() );
    $theme_dirs = array_diff( $theme_dirs, array( '.', '..', '.DS_Store' ) );

    foreach ( (array) $theme_dirs as $theme_dir ) {
      $themes[] = wp_get_theme( $theme_dir );
    }

    return $themes;

  }

  //
  // Customize the update HTML for the theme.
  //

  public function customize_theme_update_html( $prepared_themes ) {

    if ( isset( $prepared_themes['x'] ) ) {

      $update = $prepared_themes['x']['update'];
      $update = preg_replace( '/(details)[^(or)]*?<em>.*?<\/em>/', '', $update );

      $prepared_themes['x']['update'] = $update;

    }

    return $prepared_themes;

  }

}