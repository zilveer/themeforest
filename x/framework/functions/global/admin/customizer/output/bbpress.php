<?php
 
// =============================================================================
// FUNCTIONS/GLOBAL/ADMIN/CUSTOMIZER/OUTPUT/BBPRESS.PHP
// -----------------------------------------------------------------------------
// Global CSS output for bbPress.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Base Styles
// =============================================================================

?>

/* Base Styles
// ========================================================================== */

<?php if ( X_BBPRESS_IS_ACTIVE ) : ?>

  .x-context-title {
    font-weight: <?php echo $x_body_font_weight; ?>;
  }

  .bbp-forum-title,
  .bbp-topic-permalink,
  .x-bbp-general-form legend {
    font-weight: <?php echo $x_headings_font_weight; ?>;
    color: <?php echo $x_headings_font_color; ?>;
  }

  .x-bbp-item-info-header .x-item-info-permalink,
  .bbp-body .bbp-forum-freshness a,
  .bbp-body .bbp-topic-freshness a {
    color: <?php echo $x_body_font_color; ?>;
  }

  .x-bbp-item-info-content .x-bbp-item-info-author .bbp-author-name {
    color: <?php echo $x_headings_font_color; ?>;
  }

  .bbp-forum-title:hover,
  .bbp-topic-permalink:hover,
  .x-bbp-item-info-header .x-item-info-permalink:hover,
  .bbp-reply-header .bbp-admin-links a:hover,
  .x-bbp-item-info-content .x-bbp-item-info-author .bbp-author-name:hover,
  .bbp-body .bbp-forum-freshness a:hover,
  .bbp-body .bbp-topic-freshness a:hover,
  #bbp-user-navigation > ul > li a:hover,
  #bbp-user-navigation > ul > li.current a {
    color: <?php echo $x_site_link_color; ?>;
  }

  .x-bbp-count,
  .x-btn-bbp,
  .bbp-topic-tags a,
  .bbp-row-actions a,
  .x-bbp-header .actions a,
  .quicktags-toolbar input.button,
  .bbp-submit-wrapper button[type="submit"] {
    background-color: <?php echo $x_site_link_color; ?>;
  }

  .x-btn-bbp:hover,
  .bbp-topic-tags a:hover,
  .bbp-row-actions a:hover,
  .x-bbp-header .actions a:hover,
  .quicktags-toolbar input.button:hover,
  .bbp-submit-wrapper button[type="submit"]:hover {
    background-color: <?php echo $x_site_link_color_hover; ?>;
  }

<?php endif; ?>