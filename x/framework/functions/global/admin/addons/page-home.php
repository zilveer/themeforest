<?php

// =============================================================================
// FUNCTIONS/GLOBAL/ADMIN/ADDONS/PAGE-HOME.PHP
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

function x_addons_page_home() {

  $is_validated            = x_is_validated();
  $status_icon_validated   = '<div class="tco-box-status tco-box-status-validated">' . x_tco()->get_admin_icon( 'unlocked' ) . '</div>';
  $status_icon_unvalidated = '<div class="tco-box-status tco-box-status-unvalidated">' . x_tco()->get_admin_icon( 'locked' ) . '</div>';
  $status_icon_dynamic     = ( $is_validated ) ? $status_icon_validated : $status_icon_unvalidated;

  do_action( 'x_addons_before_home' );

  ?>

  <div class="tco-reset tco-wrap tco-wrap-about">

    <div class="tco-content">

      <div class="wrap"><h2>WordPress Wrap</h2></div>

      <!--
      START MAIN
      -->

      <div class="tco-main">

        <?php do_action( 'x_addons_main_content_start' ); ?>

        <?php if ( ! $is_validated ) : ?>
          <div class="tco-row">
            <?php require( 'markup/page-home-box-validation.php' ); ?>
          </div>
        <?php endif; ?>

        <div class="tco-row">
          <?php require( 'markup/page-home-box-automatic-updates.php' ); ?>
          <?php require( 'markup/page-home-box-support.php' ); ?>
        </div>

        <div class="tco-row">
          <?php require( 'markup/page-home-box-demo-content.php' ); ?>
          <?php require( 'markup/page-home-box-customizer-manager.php' ); ?>
        </div>

        <div class="tco-row">
          <?php require( 'markup/page-home-box-extensions.php' ); ?>
        </div>

        <?php if ( $is_validated ) : ?>
          <div class="tco-row">
            <?php require( 'markup/page-home-box-approved-plugins.php' ); ?>
          </div>
        <?php endif; ?>

        <?php do_action( 'x_addons_main_content_end' ); ?>

      </div>

      <!--
      END MAIN and START SIDEBAR
      -->

      <div class="tco-sidebar">
        <div class="tco-cta">
          <a href="https://theme.co/x/" target="_blank"><?php x_tco()->x_logo( 'tco-cta-logo-product' ); ?></a>
          <hr class="tco-cta-spacing">
          <a href="https://theme.co/" target="_blank"><?php x_tco()->themeco_logo( 'tco-cta-logo-company' ); ?></a>
          <hr class="tco-cta-spacing">
          <p class="tco-cta-note"><?php _e( '<strong>NOTE:</strong> A separate license is required for each site using X. Each X purchase includes a Cornerstone license.', '__x__' ); ?></p>
          <hr class="tco-cta-spacing">
          <div class="tco-cta-actions">
            <a class="tco-cta-action" href="https://community.theme.co/my-licenses/" target="_blank"><?php _e( 'Manage Licenses', '__x__' ); ?></a>
            <a class="tco-cta-action" href="https://theme.co/go/join-validation.php" target="_blank"><?php _e( 'Purchase Another License', '__x__' ); ?></a>
          </div>
          <?php if ( $is_validated ) : ?>
            <hr class="tco-cta-spacing">
            <p class="tco-cta-note" data-tco-module="x-validation-revoke"><?php _e( 'Your site is validated. <a href="#" data-tco-module-target="revoke">Revoke validation</a>.', '__x__' ); ?></p>
          <?php endif; ?>
        </div>
      </div>

      <!--
      END SIDEBAR
      -->

    </div>
  </div>

<?php }