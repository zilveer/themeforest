<?php
 
// =============================================================================
// FUNCTIONS/GLOBAL/ADMIN/CUSTOMIZER/OUTPUT/WIDGETS.PHP
// -----------------------------------------------------------------------------
// Global CSS output for widgets.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Heading Icons
// =============================================================================

?>

/* Heading Icons
// ========================================================================== */

<?php if ( $x_headings_widget_icons_enable == '1' ) : ?>
  <?php if ( ! is_rtl() ) : ?>

  .h-widget:before,
  .x-flickr-widget .h-widget:before,
  .x-dribbble-widget .h-widget:before {
    position: relative;
    font-weight: normal;
    font-style: normal;
    line-height: 1;
    text-decoration: inherit;
    -webkit-font-smoothing: antialiased;
    speak: none;
  }

  .h-widget:before {
    padding-right: 0.4em;
    font-family: "fontawesome";
  }

  .x-flickr-widget .h-widget:before,
  .x-dribbble-widget .h-widget:before {
    top: 0.025em;
    padding-right: 0.35em;
    font-family: "foundationsocial";
    font-size: 0.785em;
  }

  .widget_archive .h-widget:before {
    content: "\f040";
    top: -0.045em;
    font-size: 0.925em;
  }

  .widget_calendar .h-widget:before {
    content: "\f073";
    top: -0.0825em;
    font-size: 0.85em;
  }

  .widget_categories .h-widget:before,
  .widget_product_categories .h-widget:before {
    content: "\f02e";
    font-size: 0.95em;
  }

  .widget_nav_menu .h-widget:before,
  .widget_layered_nav .h-widget:before {
    content: "\f0c9";
  }

  .widget_meta .h-widget:before {
    content: "\f0fe";
    top: -0.065em;
    font-size: 0.895em;
  }

  .widget_pages .h-widget:before {
    content: "\f0f6";
    top: -0.065em;
    font-size: 0.85em;
  }

  .widget_recent_reviews .h-widget:before,
  .widget_recent_comments .h-widget:before {
    content: "\f086";
    top: -0.065em;
    font-size: 0.895em;
  }

  .widget_recent_entries .h-widget:before {
    content: "\f02d";
    top: -0.045em;
    font-size: 0.875em;
  }

  .widget_rss .h-widget:before {
    content: "\f09e";
    padding-right: 0.2em;
  }

  .widget_search .h-widget:before,
  .widget_product_search .h-widget:before {
    content: "\f0a4";
    top: -0.075em;
    font-size: 0.85em;
  }

  .widget_tag_cloud .h-widget:before,
  .widget_product_tag_cloud .h-widget:before {
    content: "\f02c";
    font-size: 0.925em;
  }

  .widget_text .h-widget:before {
    content: "\f054";
    padding-right: 0.4em;
    font-size: 0.925em;
  }

  .x-dribbble-widget .h-widget:before {
    content: "\f009";
  }

  .x-flickr-widget .h-widget:before {
    content: "\f010";
    padding-right: 0.35em;
  }

  .widget_best_sellers .h-widget:before {
    content: "\f091";
    top: -0.0975em;
    font-size: 0.815em;
  }

  .widget_shopping_cart .h-widget:before {
    content: "\f07a";
    top: -0.05em;
    font-size: 0.945em;
  }

  .widget_products .h-widget:before {
    content: "\f0f2";
    top: -0.05em;
    font-size: 0.945em;
  }

  .widget_featured_products .h-widget:before {
    content: "\f0a3";
  }

  .widget_layered_nav_filters .h-widget:before {
    content: "\f046";
    top: 1px;
  }

  .widget_onsale .h-widget:before {
    content: "\f02b";
    font-size: 0.925em;
  }

  .widget_price_filter .h-widget:before {
    content: "\f0d6";
    font-size: 1.025em;
  }

  .widget_random_products .h-widget:before {
    content: "\f074";
    font-size: 0.925em;
  }

  .widget_recently_viewed_products .h-widget:before {
    content: "\f06e";
  }

  .widget_recent_products .h-widget:before {
    content: "\f08d";
    top: -0.035em;
    font-size: 0.9em;
  }

  .widget_top_rated_products .h-widget:before {
    content: "\f075";
    top: -0.145em;
    font-size: 0.885em;
  }

  <?php else : ?>

  .h-widget:after,
  .x-flickr-widget .h-widget:after,
  .x-dribbble-widget .h-widget:after {
    position: relative;
    font-weight: normal;
    font-style: normal;
    line-height: 1;
    text-decoration: inherit;
    -webkit-font-smoothing: antialiased;
    speak: none;
  }

  .h-widget:after {
    padding-left: 0.4em;
    font-family: "fontawesome";
  }

  .x-flickr-widget .h-widget:after,
  .x-dribbble-widget .h-widget:after {
    top: 0.025em;
    padding-left: 0.35em;
    font-family: "foundationsocial";
    font-size: 0.785em;
  }

  .widget_archive .h-widget:after {
    content: "\f040";
    top: -0.045em;
    font-size: 0.925em;
  }

  .widget_calendar .h-widget:after {
    content: "\f073";
    top: -0.0825em;
    font-size: 0.85em;
  }

  .widget_categories .h-widget:after,
  .widget_product_categories .h-widget:after {
    content: "\f02e";
    font-size: 0.95em;
  }

  .widget_nav_menu .h-widget:after,
  .widget_layered_nav .h-widget:after {
    content: "\f0c9";
  }

  .widget_meta .h-widget:after {
    content: "\f0fe";
    top: -0.065em;
    font-size: 0.895em;
  }

  .widget_pages .h-widget:after {
    content: "\f0f6";
    top: -0.065em;
    font-size: 0.85em;
  }

  .widget_recent_reviews .h-widget:after,
  .widget_recent_comments .h-widget:after {
    content: "\f086";
    top: -0.065em;
    font-size: 0.895em;
  }

  .widget_recent_entries .h-widget:after {
    content: "\f02d";
    top: -0.045em;
    font-size: 0.875em;
  }

  .widget_rss .h-widget:after {
    content: "\f09e";
    padding-left: 0.2em;
  }

  .widget_search .h-widget:after,
  .widget_product_search .h-widget:after {
    content: "\f0a5";
    top: -0.075em;
    font-size: 0.85em;
  }

  .widget_tag_cloud .h-widget:after,
  .widget_product_tag_cloud .h-widget:after {
    content: "\f02c";
    font-size: 0.925em;
  }

  .widget_text .h-widget:after {
    content: "\f053";
    padding-left: 0.4em;
    font-size: 0.925em;
  }

  .x-dribbble-widget .h-widget:after {
    content: "\f009";
  }

  .x-flickr-widget .h-widget:after {
    content: "\f010";
    padding-left: 0.35em;
  }

  .widget_best_sellers .h-widget:after {
    content: "\f091";
    top: -0.0975em;
    font-size: 0.815em;
  }

  .widget_shopping_cart .h-widget:after {
    content: "\f07a";
    top: -0.05em;
    font-size: 0.945em;
  }

  .widget_products .h-widget:after {
    content: "\f0f2";
    top: -0.05em;
    font-size: 0.945em;
  }

  .widget_featured_products .h-widget:after {
    content: "\f0a3";
  }

  .widget_layered_nav_filters .h-widget:after {
    content: "\f046";
    top: 1px;
  }

  .widget_onsale .h-widget:after {
    content: "\f02b";
    font-size: 0.925em;
  }

  .widget_price_filter .h-widget:after {
    content: "\f0d6";
    font-size: 1.025em;
  }

  .widget_random_products .h-widget:after {
    content: "\f074";
    font-size: 0.925em;
  }

  .widget_recently_viewed_products .h-widget:after {
    content: "\f06e";
  }

  .widget_recent_products .h-widget:after {
    content: "\f08d";
    top: -0.035em;
    font-size: 0.9em;
  }

  .widget_top_rated_products .h-widget:after {
    content: "\f075";
    top: -0.145em;
    font-size: 0.885em;
  }

  <?php endif; ?>
<?php endif; ?>