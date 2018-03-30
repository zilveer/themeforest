<?php

// =============================================================================
// FUNCTIONS/GLOBAL/ADMIN/ADDONS/MARKUP/PAGE-HOME-BOX-APPROVED-PLUGINS.PHP
// -----------------------------------------------------------------------------
// Addons home page output.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Page Output
// =============================================================================

// Page Output
// =============================================================================

?>

<div class="tco-column">
  <div class="tco-box tco-box-extensions">

    <header class="tco-box-header">
      <?php echo $status_icon_validated; ?>
      <h2 class="tco-box-title"><?php _e( 'Approved Plugins', '__x__' ); ?></h2>
    </header>

    <div class="tco-box-content tco-pan tco-ta-center">
      <p class="tco-extensions-info"><?php printf( __( 'Once installed, each can be activated or deactivated on the <a href="%s">Plugins</a> page.', '__x__' ), admin_url( 'plugins.php' ) ); ?></p>
      <div class="tco-extensions">

        <?php

        $approved_plugins = X_Addons_Extensions::get_approved_plugins_list();

        foreach ( $approved_plugins as $plugin ) :

        ?>

          <div class="tco-extension tco-extension-<?php echo $plugin['slug']; ?> tco-extension-<?php echo ( $plugin['installed'] ) ? 'installed' : 'not-installed'; ?>" id="<?php echo $plugin['slug']; ?>" data-tco-module="x-extension">

            <div class="tco-extension-content">
              <img class="tco-extension-img" src="<?php echo $plugin['logo_url']; ?>" width="100" height="100">
              <h4 class="tco-extension-title"><?php echo $plugin['title']; ?></h4>
              <div class="tco-extension-info">
                <a class="tco-extension-info-details" href="#" data-tco-toggle=".tco-extension-<?php echo $plugin['slug']; ?> .tco-overlay"><?php _e( 'Details', '__x__' ); ?></a>
              </div>
              <a class="tco-btn" data-tco-module-target="install"><?php _e( 'Install', '__x__' ); ?></a>
            </div>

            <footer class="tco-extension-footer">
              <span class="tco-extension-status-icon"><?php x_tco()->admin_icon( 'yes' ); ?></span>
              <span class="tco-status-text"></span>
              <div class="tco-overlay">
                <a class="tco-overlay-close" href="#" data-tco-toggle=".tco-extension-<?php echo $plugin['slug']; ?> .tco-overlay"><?php x_tco()->admin_icon( 'no' ); ?></a>
                <h4 class="tco-box-content-title"><?php echo $plugin['title']; ?> <?php _e( 'by', '__x__' ); ?> <?php echo $plugin['author']; ?></h4>
                <p><?php echo $plugin['description']; ?></p>
              </div>
            </footer>

          </div>

        <?php endforeach; ?>

      </div>
    </div>

  </div>
</div>