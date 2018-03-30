<?php

// =============================================================================
// FUNCTIONS/GLOBAL/ADMIN/ADDONS/MARKUP/PAGE-HOME-BOX-AUTOMATIC-UPDATES.PHP
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
  <div class="tco-box tco-box-min-height tco-box-automatic-updates" data-tco-module="x-automatic-updates">

    <header class="tco-box-header">
      <?php echo $status_icon_dynamic; ?>
      <h2 class="tco-box-title"><?php _e( 'Automatic Updates', '__x__' ); ?></h2>
    </header>

    <?php if ( $is_validated ) : ?>

      <div class="tco-box-content">
        <ul class="tco-box-features">
          <li>
            <?php x_tco()->admin_icon( 'dl-laptop', 'tco-box-feature-icon' ); ?>
            <div class="tco-box-feature-info">
              <h4 class="tco-box-content-title"><?php _e( 'Installed Version', '__x__' ); ?></h4>
              <span class="tco-box-content-text"><?php echo X_VERSION; ?> <a class="tco-automatic-updates-changelog" href="https://theme.co/changelog/" target="_blank"><?php _e( 'Changelog', '__x__' ); ?></a></span>
            </div>
          </li>
          <li>
            <?php x_tco()->admin_icon( 'bullhorn', 'tco-box-feature-icon' ); ?>
            <div class="tco-box-feature-info">
              <h4 class="tco-box-content-title"><?php _e( 'Latest Version Available', '__x__' ); ?></h4>
              <span class="tco-box-content-text"><span data-tco-module-target="latest-available"><?php echo X_VERSION; ?></span> <a class="tco-automatic-updates-changelog" href="https://theme.co/changelog/" target="_blank"><?php _e( 'Changelog', '__x__' ); ?></a></span>
            </div>
          </li>
          <li>
            <?php x_tco()->admin_icon( 'refresh', 'tco-box-feature-icon' ); ?>
            <div class="tco-box-feature-info">
              <h4 class="tco-box-content-title"><?php _e( 'Checked Every 12 Hours', '__x__' ); ?></h4>
              <span class="tco-box-content-text" data-tco-module-target="check-now"><a class="tco-automatic-updates-check-now" href="#"><?php _e( 'Check Now', '__x__' ); ?></a></span>
            </div>
          </li>
        </ul>
      </div>

    <?php else : ?>

      <div class="tco-box-content">
        <ul class="tco-box-features">
          <li>
            <?php x_tco()->admin_icon( 'bell', 'tco-box-feature-icon' ); ?>
            <div class="tco-box-feature-info">
              <h4 class="tco-box-content-title"><?php _e( 'Admin Notifications', '__x__' ); ?></h4>
              <span class="tco-box-content-text"><?php _e( 'Get updates in WordPress', '__x__' ); ?></span>
            </div>
          </li>
          <li>
            <?php x_tco()->admin_icon( 'refresh', 'tco-box-feature-icon' ); ?>
            <div class="tco-box-feature-info">
              <h4 class="tco-box-content-title"><?php _e( 'Stay Up to Date', '__x__' ); ?></h4>
              <span class="tco-box-content-text"><?php _e( 'Use the latest features right away', '__x__' ); ?></span>
            </div>
          </li>
          <li>
            <?php x_tco()->admin_icon( 'dl-desktop', 'tco-box-feature-icon' ); ?>
            <div class="tco-box-feature-info">
              <h4 class="tco-box-content-title"><?php _e( 'Manual No More', '__x__' ); ?></h4>
              <span class="tco-box-content-text"><?php _e( 'Say goodbye to your FTP client', '__x__' ); ?></span>
            </div>
          </li>
        </ul>
        <?php x_addons_preview_unlock( '.tco-box-automatic-updates', 'Setup Now' ); ?>
      </div>

    <?php endif; ?>

    <footer class="tco-box-footer">
      <div class="tco-box-bg" style="background-image: url(<?php x_tco()->admin_image( 'box-automatic-updates-tco-box-bg-x.jpg' ); ?>);"></div>
      <?php if ( ! $is_validated ) : ?>
        <?php x_addons_preview_overlay( '.tco-box-automatic-updates' ); ?>
      <?php endif; ?>
    </footer>

  </div>
</div>