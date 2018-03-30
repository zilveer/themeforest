<?php

// =============================================================================
// FUNCTIONS/GLOBAL/ADMIN/ADDONS/CLASS-PLUGIN-UPDATER.PHP
// -----------------------------------------------------------------------------
// The plugin updater.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Plugin Updater
// =============================================================================

// Plugin Updater
// =============================================================================

class X_Plugin_Updater {

  //
  // Setup hooks.
  //

  public function __construct() {


    if ( is_admin() && isset( $_GET['force-check'] ) ) {
      delete_site_transient( 'update_plugins' );
    }

    add_action( 'admin_init', array( $this, 'replace_default_wp_update_message' ), 999 );
    add_filter( 'plugins_api', array( $this, 'plugins_api' ), 99, 3 );

    add_filter( 'extra_plugin_headers', array( $this, 'add_plugin_headers' ) );

    if ( empty( $_GET['action'] ) || ! in_array( $_GET['action'], array( 'do-core-reinstall', 'do-core-upgrade' ), true ) ) {
      add_filter( 'pre_set_site_transient_update_plugins', array( $this, 'pre_set_site_transient_update_plugins' ) );
    }

  }


  //
  // Replace the default WordPress update message.
  //

  public function replace_default_wp_update_message() {

    $plugins = $this->get_plugin_meta();

    foreach ( $plugins as $slug => $plugin ) {
      add_action( 'after_plugin_row_' . $slug, array( $this, 'custom_plugin_update_row' ), 10, 2 );
      remove_action( 'after_plugin_row_' . $slug, 'wp_plugin_update_row', 10, 2 );
    }

  }


  //
  // Allow WordPress to detect "X Plugin" as a header in a plugin file.
  //

  public function add_plugin_headers( $headers ) {

    return array_merge( $headers, array( 'X Plugin' ) );

  }


  //
  // Check for plugin updates and update transient.
  //

  public function pre_set_site_transient_update_plugins( $data ) {

    x_tco()->updates()->refresh();
    $update_cache = x_tco()->updates()->get_update_cache();

    if ( !isset( $update_cache['plugins'] ) || empty( $update_cache['plugins'] ) ) {
      return $data;
    }

    include_once( ABSPATH . '/wp-admin/includes/plugin.php' );

    $installed_plugins   = get_plugins();

    foreach ( (array) $installed_plugins as $plugin_file => $local ) {

      // Only check plugins in the Themeco update cache.
      if ( ! isset( $update_cache['plugins'][$plugin_file] ) ) continue;

      $remote = $update_cache['plugins'][$plugin_file];

      // Version check
      if ( version_compare( $remote['new_version'], $local['Version'], '<=' ) ) continue;

      if ( !$remote['package'] ) {
        $remote['upgrade_notice'] = X_Addons_Updates::get_validation_html_plugin_updates();
      }

      $data->response[ $plugin_file ] = (object) $remote;

    }

    return $data;

  }


  //
  // Returns meta data for all plugins with "X Plugin" header.
  //

  protected function get_plugin_meta() {

    include_once( ABSPATH . '/wp-admin/includes/plugin.php' );

    $plugins   = get_plugins();
    $x_plugins = array();

    foreach ( (array) $plugins as $plugin => $headers ) {

      if ( empty( $headers['X Plugin'] ) ) {
        continue;
      }

      $x_plugin['slug']                    = $plugin;
      $plugin_data                         = get_plugin_data( WP_PLUGIN_DIR . '/' . $x_plugin['slug'] );
      $x_plugin['product_slug']            = $headers['X Plugin'];
      $x_plugin['author']                  = $plugin_data['AuthorName'];
      $x_plugin['plugin_uri']              = $plugin_data['PluginURI'];
      $x_plugin['name']                    = $plugin_data['Name'];
      $x_plugin['local_version']           = $plugin_data['Version'];
      $x_plugin['sections']['description'] = $plugin_data['Description'];
      $x_plugins[$x_plugin['slug']]        = (object) $x_plugin;

    }

    return $x_plugins;

  }


  //
  // Replace "Plugins" page info.
  //

  public function plugins_api( $false, $action, $response ) {

    if ( ! ( 'plugin_information' === $action ) ) {
      return $false;
    }

    $plugins = $this->get_plugin_meta();

    foreach ( $plugins as $file => $plugin ) {

      $slug = dirname( $file );

      if ( $response->slug === $slug ) {

        $response->slug        = $slug;
        $response->plugin_name = $plugin->name;
        $response->name        = $plugin->name;
        $response->author      = $plugin->author;
        $response->homepage    = $plugin->plugin_uri;
        $response->sections    = $plugin->sections;

        return $response;

      }
    }

    return $false;

  }


  //
  // Adds different output for custom plugin updates.
  //

  function custom_plugin_update_row( $file, $plugin_data ) {

    $current = get_site_transient( 'update_plugins' );

    if ( ! isset( $current->response[$file] ) ) {
      return false;
    }

    $r = $current->response[$file];

    $allowed_tags  = array( 'a' => array( 'href' => array(), 'title' => array() ), 'abbr' => array( 'title' => array() ), 'acronym' => array( 'title' => array() ), 'code' => array(), 'em' => array(), 'strong' => array() );
    $plugin_name   = wp_kses( $plugin_data['Name'], $allowed_tags );
    $details_url   = self_admin_url( 'plugin-install.php?tab=plugin-information&plugin=' . $r->slug . '&section=changelog&TB_iframe=true&width=600&height=800' );
    $wp_list_table = _get_list_table( 'WP_Plugins_List_Table' );

    if ( is_network_admin() || ! is_multisite() ) {

      echo '<tr class="plugin-update-tr"><td colspan="' . $wp_list_table->get_column_count() . '" class="plugin-update colspanchange"><div class="update-message">';

      if ( ! current_user_can( 'update_plugins' ) ) {
        printf( __( 'There is a new version of %1$s available. <a href="%2$s" class="thickbox" title="%3$s">View version %4$s details</a>.' ), $plugin_name, esc_url( $details_url ), esc_attr( $plugin_name ), $r->new_version );
      } else if ( empty( $r->package ) ) {
        printf( __( 'There is a new version of %1$s available. <a href="%2$s" class="thickbox" title="%3$s">View version %4$s details</a>. %5$s' ), $plugin_name, esc_url( $details_url ), esc_attr( $plugin_name ), $r->new_version, X_Update_API::get_validation_html_plugin_main() );
      } else {
        printf( __( 'There is a new version of %1$s available. <a href="%2$s" class="thickbox" title="%3$s">View version %4$s details</a> or <a href="%5$s">update now</a>.' ), $plugin_name, esc_url( $details_url ), esc_attr( $plugin_name ), $r->new_version, wp_nonce_url( self_admin_url( 'update.php?action=upgrade-plugin&plugin=' ) . $file, 'upgrade-plugin_' . $file ) );
      }


      //
      // Fires at the end of the update message container in each row of the
      // plugins list table.
      //
      // The dymaic portion of the hook name, $file, refers to the path of
      // the plugin's primary file relative to the plugins directory.
      //
      // $plugin_data is an array of plugin metadata:
      //
      // * $name        (string) - The human-readable name of the plugin.
      // * $title       (string) - The human-readable title of the plugin.
      // * $plugin_uri  (string) - The plugin URI.
      // * $version     (string) - The plugin version.
      // * $description (string) - The plugin description.
      // * $author      (string) - The plugin author.
      // * $author_uri  (string) - The plugin author URI.
      // * $author_name (string) - The plugin author's name.
      // * $text_domain (string) - The plugin text domain.
      // * $domain_path (string) - The relative path to the plugin's .mo file(s).
      // * $network       (bool) - Whether the plugin can only be activated network wide.
      // * $update        (bool) - Whether there's an available update. Default is NULL.
      //
      // $r is an array of metadata about the available plugin update.
      //
      // * $id             (int) - The plugin ID.
      // * $slug        (string) - The plugin slug.
      // * $new_version (string) - The new plugin version.
      // * $url         (string) - The plugin URL.
      // * $package     (string) - The plugin update package URL.
      //

      do_action( 'in_plugin_update_message-' . $file, $plugin_data, $r );

      echo '</div></td></tr>';

    }

  }

}