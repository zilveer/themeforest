<?php

// =============================================================================
// FUNCTIONS/GLOBAL/ADMIN/ADDONS/MARKUP/PAGE-HOME-BOX-EXTENSIONS.PHP
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
      <?php echo $status_icon_dynamic; ?>
      <h2 class="tco-box-title"><?php _e( 'Extensions', '__x__' ); ?></h2>
    </header>

    <?php if ( $is_validated ) : ?>

      <div class="tco-box-content tco-pan tco-ta-center">
        <p class="tco-extensions-info"><?php printf( __( 'Once installed, you can activate or deactivate each Extension on the <a href="%s">Plugins</a> page.', '__x__' ), admin_url( 'plugins.php' ) ); ?></p>
        <div class="tco-extensions">

          <?php

          $extensions = X_Addons_Extensions::get_extension_list();

          foreach ( $extensions as $extension ) :

          ?>

            <div class="tco-extension tco-extension-<?php echo $extension['slug']; ?> tco-extension-<?php echo ( $extension['installed'] ) ? 'installed' : 'not-installed'; ?>" id="<?php echo $extension['slug']; ?>" data-tco-module="x-extension" data-x-extension>

              <div class="tco-extension-content">
                <img class="tco-extension-img" src="<?php echo $extension['logo_url']; ?>" width="100" height="100">
                <h4 class="tco-extension-title"><?php echo $extension['title']; ?></h4>
                <div class="tco-extension-info">
                  <a class="tco-extension-info-details" href="#" data-tco-toggle=".tco-extension-<?php echo $extension['slug']; ?> .tco-overlay"><?php _e( 'Details', '__x__' ); ?></a>
                </div>
                <a class="tco-btn" data-tco-module-target="install"><?php _e( 'Install', '__x__' ); ?></a>
              </div>

              <footer class="tco-extension-footer">
                <span class="tco-extension-status-icon"><?php x_tco()->admin_icon( 'yes' ); ?></span>
                <span class="tco-status-text"></span>
                <div class="tco-overlay">
                  <a class="tco-overlay-close" href="#" data-tco-toggle=".tco-extension-<?php echo $extension['slug']; ?> .tco-overlay"><?php x_tco()->admin_icon( 'no' ); ?></a>
                  <h4 class="tco-box-content-title"><?php echo $extension['title']; ?> <?php _e( 'by', '__x__' ); ?> <?php echo $extension['author']; ?></h4>
                  <p><?php echo $extension['description']; ?></p>
                </div>
              </footer>

            </div>

          <?php endforeach; ?>

        </div>
      </div>

    <?php else : ?>

      <div class="tco-box-content tco-ta-center">
        <div class="tco-box-extensions-preview-content">
          <h4 class="tco-box-extensions-preview-title"><?php _e( 'Over $1,000 in Value!', '__x__' ); ?></h4>
          <p class="tco-box-extensions-preview-text"><?php _e( '20+ Extensions (plugins) created by Themeco and 3rd parties to work seamlessly with X. Instantly download with each verified purchase. <strong>Oh, and they are all free!</strong>', '__x__' ); ?></p>
          <?php x_addons_preview_unlock( '.tco-box-extensions', 'Unlock All Extensions' ); ?>
          <img class="tco-box-extensions-preview-img" src="<?php x_tco()->admin_image( 'box-extensions.png' ); ?>" alt="<?php _e( 'Extensions', '__x__' ); ?>">
        </div>
      </div>

      <footer class="tco-box-footer">
        <?php x_addons_preview_overlay( '.tco-box-extensions' ); ?>
      </footer>

    <?php endif; ?>

  </div>
</div>