<?php

// =============================================================================
// FUNCTIONS/GLOBAL/ADMIN/ADDONS/MARKUP/PAGE-HOME-BOX-DEMO-CONTENT.PHP
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
  <div class="tco-box tco-box-min-height tco-box-demo-content" data-tco-module="x-demo-content">

    <header class="tco-box-header">
      <?php echo $status_icon_validated; ?>
      <h2 class="tco-box-title"><?php _e( 'Demo Content', '__x__' ); ?></h2>
    </header>

      <div class="tco-box-content tco-pan tco-ta-center">
        <form class="tco-form">
          <div class="tco-vam-outer">
            <div class="tco-vam-inner">
              <div class="tco-demo-content-control">
                <div class="tco-select">
                  <select class="tco-form-control" data-tco-module-target="select">
                    <optgroup label="Expanded Demos" data-tco-module-target="select-group-expanded"></optgroup>
                    <optgroup label="Standard Demos" data-tco-module-target="select-group-standard"></optgroup>
                  </select>
                </div>
                <a class="tco-demo-content-link" href="#" target="_blank" data-tco-module-target="demo-link"><?php x_tco()->admin_icon( 'external' ); ?></a>
              </div>
              <span class="tco-box-content-text"><?php _e( '<strong>Standard Demos</strong> include placeholder content for the home page along with example posts. <strong>Expanded Demos</strong> include everything you see in the demo&mdash;all content, graphics, widgets, sliders, settings, and more.', '__x__' ); ?></span>
            </div>
          </div>
          <button class="tco-demo-content-setup" data-tco-module-target="setup-button">
            <?php x_tco()->admin_icon( 'layout' ); ?>
            <span><?php _e( 'Setup Demo Content', '__x__' ); ?></span>
          </button>
        </form>
      </div>

      <!--
      <div class="tco-box-content">
        <ul class="tco-box-features">
          <li>
            <?php x_tco()->admin_icon( 'layout', 'tco-box-feature-icon' ); ?>
            <div class="tco-box-feature-info">
              <h4 class="tco-box-content-title"><?php _e( 'Get Free Content', '__x__' ); ?></h4>
              <span class="tco-box-content-text"><?php _e( 'Build on top of a firm foundation', '__x__' ); ?></span>
            </div>
          </li>
          <li>
            <?php x_tco()->admin_icon( 'lightbulb', 'tco-box-feature-icon' ); ?>
            <div class="tco-box-feature-info">
              <h4 class="tco-box-content-title"><?php _e( 'Spark Your Creativity', '__x__' ); ?></h4>
              <span class="tco-box-content-text"><?php _e( 'Great for any project', '__x__' ); ?></span>
            </div>
          </li>
          <li>
            <?php x_tco()->admin_icon( 'layers', 'tco-box-feature-icon' ); ?>
            <div class="tco-box-feature-info">
              <h4 class="tco-box-content-title"><?php _e( 'Customize Away', '__x__' ); ?></h4>
              <span class="tco-box-content-text"><?php _e( 'Tailor with our child theme', '__x__' ); ?></span>
            </div>
          </li>
        </ul>
        <?php x_addons_preview_unlock( '.tco-box-demo-content', 'Access Demos' ); ?>
      </div>

      <footer class="tco-box-footer">
        <div class="tco-box-bg" style="background-image: url(<?php x_tco()->admin_image( 'box-demo-content-1-tco-box-bg.jpg' ); ?>);"></div>
        <?php x_addons_preview_overlay( '.tco-box-demo-content' ); ?>
      </footer>
      -->

  </div>
</div>