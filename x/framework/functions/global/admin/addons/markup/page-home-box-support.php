<?php

// =============================================================================
// FUNCTIONS/GLOBAL/ADMIN/ADDONS/MARKUP/PAGE-HOME-BOX-SUPPORT.PHP
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
  <div class="tco-box tco-box-min-height tco-box-support">

    <header class="tco-box-header">
      <?php echo $status_icon_dynamic; ?>
      <h2 class="tco-box-title"><?php _e( 'Support', '__x__' ); ?></h2>
    </header>

    <div class="tco-box-content">
      <ul class="tco-box-features">
        <li>
          <?php x_tco()->admin_icon( 'woman', 'tco-box-feature-icon' ); ?>
          <div class="tco-box-feature-info">
            <h4 class="tco-box-content-title"><?php _e( 'Real People', '__x__' ); ?></h4>
            <span class="tco-box-content-text"><?php _e( 'A professional and courteous staff', '__x__' ); ?></span>
          </div>
        </li>
        <li>
          <?php x_tco()->admin_icon( 'tfs', 'tco-box-feature-icon' ); ?>
          <div class="tco-box-feature-info">
            <h4 class="tco-box-content-title"><?php _e( 'Around the Clock', '__x__' ); ?></h4>
            <span class="tco-box-content-text"><?php _e( 'Get help at any time, day or night', '__x__' ); ?></span>
          </div>
        </li>
        <li>
          <?php x_tco()->admin_icon( 'docs', 'tco-box-feature-icon' ); ?>
          <div class="tco-box-feature-info">
            <h4 class="tco-box-content-title"><?php _e( 'Knowledge Base', '__x__' ); ?></h4>
            <span class="tco-box-content-text"><?php _e( 'Dozens of articles and videos', '__x__' ); ?></span>
          </div>
        </li>
      </ul>
      <?php if ( $is_validated ) : ?>
        <div class="tco-btn-group-horizontal">
          <a class="tco-btn" href="https://community.theme.co/kb/" target="_blank"><?php _e( 'Knowledge Base', '__x__' ); ?></a><a class="tco-btn" href="https://community.theme.co/forums/group/support-center/" target="_blank"><?php _e( 'Forum', '__x__' ); ?></a>
        </div>
      <?php else : ?>
        <?php x_addons_preview_unlock( '.tco-box-support', 'Get World-Class Support' ); ?>
      <?php endif; ?>
    </div>

    <footer class="tco-box-footer">
      <div class="tco-box-bg" style="background-image: url(<?php x_tco()->admin_image( 'box-support-tco-box-bg.jpg' ); ?>);"></div>
      <?php if ( ! $is_validated ) : ?>
        <?php x_addons_preview_overlay( '.tco-box-support' ); ?>
      <?php endif; ?>
    </footer>

  </div>
</div>