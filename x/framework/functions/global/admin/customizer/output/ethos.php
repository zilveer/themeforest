<?php
 
// =============================================================================
// FUNCTIONS/GLOBAL/ADMIN/CUSTOMIZER/OUTPUT/ETHOS.PHP
// -----------------------------------------------------------------------------
// Ethos CSS ouptut.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Site Link Color Accents
//   02. Layout Sizing
//   03. Navbar
//   04. Navbar - Positioning
//   05. Navbar - Dropdowns
//   06. Design Options
//   07. Post Slider
//   08. Custom Fonts - Colors
//   09. Responsive Styling
//   10. Adminbar Styling
// =============================================================================

$x_ethos_navbar_desktop_link_side_padding = x_get_option( 'x_ethos_navbar_desktop_link_side_padding' );
$x_ethos_topbar_background                = x_get_option( 'x_ethos_topbar_background' );
$x_ethos_navbar_background                = x_get_option( 'x_ethos_navbar_background' );
$x_ethos_sidebar_widget_headings_color    = x_get_option( 'x_ethos_sidebar_widget_headings_color' );
$x_ethos_sidebar_color                    = x_get_option( 'x_ethos_sidebar_color' );
$x_ethos_post_slider_blog_height          = x_get_option( 'x_ethos_post_slider_blog_height' );
$x_ethos_post_slider_archive_height       = x_get_option( 'x_ethos_post_slider_archive_height' );

$x_ethos_navbar_outer_border_width        = '2';

?>

/* Site Link Color Accents
// ========================================================================== */

/*
// Color.
*/

a,
h1 a:hover,
h2 a:hover,
h3 a:hover,
h4 a:hover,
h5 a:hover,
h6 a:hover,
.x-breadcrumb-wrap a:hover,
.x-comment-author a:hover,
.x-comment-time:hover,
.p-meta > span > a:hover,
.format-link .link a:hover,
.x-main .widget ul li a:hover,
.x-main .widget ol li a:hover,
.x-main .widget_tag_cloud .tagcloud a:hover,
.x-sidebar .widget ul li a:hover,
.x-sidebar .widget ol li a:hover,
.x-sidebar .widget_tag_cloud .tagcloud a:hover,
.x-portfolio .entry-extra .x-ul-tags li a:hover {
  color: <?php echo $x_site_link_color; ?>;
}

a:hover {
  color: <?php echo $x_site_link_color_hover; ?>;
}

<?php if ( X_WOOCOMMERCE_IS_ACTIVE ) : ?>

  .woocommerce .price > .amount,
  .woocommerce .price > ins > .amount,
  .woocommerce .star-rating:before,
  .woocommerce .star-rating span:before {
    color: <?php echo $x_site_link_color; ?>;
  }

<?php endif; ?>


/*
// Border color.
*/

a.x-img-thumbnail:hover {
  border-color: <?php echo $x_site_link_color; ?>;
}


/*
// Background color.
*/

<?php if ( X_WOOCOMMERCE_IS_ACTIVE ) : ?>

  .woocommerce .onsale,
  .widget_price_filter .ui-slider .ui-slider-range {
    background-color: <?php echo $x_site_link_color; ?>;
  }

<?php endif; ?>



/* Layout Sizing
// ========================================================================== */

/*
// Main structural elements.
*/

.x-main {
  width: <?php echo $x_layout_content_width . '%'; ?>;
}

.x-sidebar {
  width: <?php echo 100 - $x_layout_content_width . '%'; ?>;
}


/*
// Main content background.
*/

.x-post-slider-archive-active .x-container.main:before {
  top: 0;
}

.x-content-sidebar-active .x-container.main:before {
  right: <?php echo 100 - $x_layout_content_width . '%'; ?>;
}

.x-sidebar-content-active .x-container.main:before {
  left: <?php echo 100 - $x_layout_content_width . '%'; ?>;
}

.x-full-width-active .x-container.main:before {
  left: -5000em;
}



/* Navbar
// ========================================================================== */

/*
// Color.
*/

.x-navbar .desktop .x-nav > li > a,
.x-navbar .desktop .sub-menu a,
.x-navbar .mobile .x-nav li > a,
.x-breadcrumb-wrap a,
.x-breadcrumbs .delimiter {
  color: <?php echo $x_navbar_link_color; ?>;
}

.x-topbar .p-info a:hover,
.x-social-global a:hover,
.x-navbar .desktop .x-nav > li > a:hover,
.x-navbar .desktop .x-nav > .x-active > a,
.x-navbar .desktop .x-nav > .current-menu-item > a,
.x-navbar .desktop .sub-menu a:hover,
.x-navbar .desktop .sub-menu .x-active > a,
.x-navbar .desktop .sub-menu .current-menu-item > a,
.x-navbar .desktop .x-nav .x-megamenu > .sub-menu > li > a,
.x-navbar .mobile .x-nav li > a:hover,
.x-navbar .mobile .x-nav .x-active > a,
.x-navbar .mobile .x-nav .current-menu-item > a,
.x-widgetbar .widget a:hover,
.x-colophon .widget a:hover,
.x-colophon.bottom .x-colophon-content a:hover,
.x-colophon.bottom .x-nav a:hover {
  color: <?php echo $x_navbar_link_color_hover; ?>;
}


/*
// Box shadow.
*/

<?php

$locations = get_nav_menu_locations();
$items     = wp_get_nav_menu_items( $locations['primary'] );

foreach ( $items as $item ) {
  if ( $item->type == 'taxonomy' && $item->menu_item_parent == 0 ) {

    $t_id   = $item->object_id;
    $accent = x_ethos_category_accent_color( $t_id, $x_site_link_color );

    ?>

    <?php if ( $x_navbar_positioning == 'static-top' || $x_navbar_positioning == 'fixed-top' ) : ?>

      .x-navbar .desktop .x-nav > li.tax-item-<?php echo $t_id; ?> > a:hover,
      .x-navbar .desktop .x-nav > li.tax-item-<?php echo $t_id; ?>.x-active > a {
        box-shadow: 0 <?php echo $x_ethos_navbar_outer_border_width; ?>px 0 0 <?php echo $accent; ?>;
      }

    <?php elseif ( $x_navbar_positioning == 'fixed-left' ) : ?>

      .x-navbar .desktop .x-nav > li.tax-item-<?php echo $t_id; ?> > a:hover,
      .x-navbar .desktop .x-nav > li.tax-item-<?php echo $t_id; ?>.x-active > a {
        box-shadow: <?php echo $x_ethos_navbar_outer_border_width; ?>px 0 0 0 <?php echo $accent; ?>;
      }

    <?php elseif ( $x_navbar_positioning == 'fixed-right' ) : ?>

      .x-navbar .desktop .x-nav > li.tax-item-<?php echo $t_id; ?> > a:hover,
      .x-navbar .desktop .x-nav > li.tax-item-<?php echo $t_id; ?>.x-active > a {
        box-shadow: -<?php echo $x_ethos_navbar_outer_border_width; ?>px 0 0 0 <?php echo $accent; ?>;
      }

    <?php endif; ?>

    <?php

  }
}

?>



/* Navbar - Positioning
// ========================================================================== */

<?php if ( $x_navbar_positioning == 'static-top' || $x_navbar_positioning == 'fixed-top' ) : ?>

  .x-navbar .desktop .x-nav > li > a:hover,
  .x-navbar .desktop .x-nav > .x-active > a,
  .x-navbar .desktop .x-nav > .current-menu-item > a {
    box-shadow: 0 <?php echo $x_ethos_navbar_outer_border_width; ?>px 0 0 <?php echo $x_site_link_color; ?>;
  }

  .x-navbar .desktop .x-nav > li > a {
    height: <?php echo $x_navbar_height . 'px'; ?>;
    padding-top: <?php echo $x_navbar_adjust_links_top . 'px'; ?>;
  }

<?php endif; ?>

<?php if ( $x_navbar_positioning == 'fixed-left' || $x_navbar_positioning == 'fixed-right' ) : ?>

  .x-navbar .desktop .x-nav > li > a {
    padding-top: <?php echo round( ( $x_navbar_adjust_links_side - $x_navbar_font_size ) / 2 ) . 'px'; ?>;
    padding-bottom: <?php echo round( ( $x_navbar_adjust_links_side - $x_navbar_font_size ) / 2 ) . 'px'; ?>;
    padding-left: 7%;
    padding-right: 7%;
  }

  .desktop .x-megamenu > .sub-menu {
    width: <?php echo 879 - $x_navbar_width . 'px'; ?>
  }

<?php endif; ?>

<?php if ( $x_navbar_positioning == 'fixed-top' ) : ?>

  .x-navbar-fixed-top-active .x-navbar-wrap {
    margin-bottom: 2px;
  }

<?php endif; ?>

<?php if ( $x_navbar_positioning == 'fixed-left' ) : ?>

  .x-navbar .desktop .x-nav > li > a:hover,
  .x-navbar .desktop .x-nav > .x-active > a,
  .x-navbar .desktop .x-nav > .current-menu-item > a {
    box-shadow: <?php echo $x_ethos_navbar_outer_border_width; ?>px 0 0 0 <?php echo $x_site_link_color; ?>;
  }

  .x-widgetbar {
    left: <?php echo $x_navbar_width . 'px'; ?>;
  }

<?php endif; ?>

<?php if ( $x_navbar_positioning == 'fixed-right' ) : ?>

  .x-navbar .desktop .x-nav > li > a:hover,
  .x-navbar .desktop .x-nav > .x-active > a,
  .x-navbar .desktop .x-nav > .current-menu-item > a {
    box-shadow: -<?php echo $x_ethos_navbar_outer_border_width; ?>px 0 0 0 <?php echo $x_site_link_color; ?>;
  }

  .x-widgetbar {
    right: <?php echo $x_navbar_width . 'px'; ?>;
  }

<?php endif; ?>



/* Navbar - Dropdowns
// ========================================================================== */

.x-navbar .desktop .x-nav > li ul {
  top: <?php echo $x_navbar_height + $x_ethos_navbar_outer_border_width . 'px'; ?>;
}



/* Design Options
// ========================================================================== */

/*
// Color.
*/

.h-landmark,
.x-main .h-widget,
.x-main .h-widget a.rsswidget,
.x-main .h-widget a.rsswidget:hover,
.x-main .widget.widget_pages .current_page_item a,
.x-main .widget.widget_nav_menu .current-menu-item a,
.x-main .widget.widget_pages .current_page_item a:hover,
.x-main .widget.widget_nav_menu .current-menu-item a:hover,
.x-sidebar .h-widget,
.x-sidebar .h-widget a.rsswidget,
.x-sidebar .h-widget a.rsswidget:hover,
.x-sidebar .widget.widget_pages .current_page_item a,
.x-sidebar .widget.widget_nav_menu .current-menu-item a,
.x-sidebar .widget.widget_pages .current_page_item a:hover,
.x-sidebar .widget.widget_nav_menu .current-menu-item a:hover {
  color: <?php echo $x_ethos_sidebar_widget_headings_color; ?>;
}

.x-main .widget,
.x-main .widget a,
.x-main .widget ul li a,
.x-main .widget ol li a,
.x-main .widget_tag_cloud .tagcloud a,
.x-main .widget_product_tag_cloud .tagcloud a,
.x-main .widget a:hover,
.x-main .widget ul li a:hover,
.x-main .widget ol li a:hover,
.x-main .widget_tag_cloud .tagcloud a:hover,
.x-main .widget_product_tag_cloud .tagcloud a:hover,
.x-main .widget_shopping_cart .buttons .button,
.x-main .widget_price_filter .price_slider_amount .button,
.x-sidebar .widget,
.x-sidebar .widget a,
.x-sidebar .widget ul li a,
.x-sidebar .widget ol li a,
.x-sidebar .widget_tag_cloud .tagcloud a,
.x-sidebar .widget_product_tag_cloud .tagcloud a,
.x-sidebar .widget a:hover,
.x-sidebar .widget ul li a:hover,
.x-sidebar .widget ol li a:hover,
.x-sidebar .widget_tag_cloud .tagcloud a:hover,
.x-sidebar .widget_product_tag_cloud .tagcloud a:hover,
.x-sidebar .widget_shopping_cart .buttons .button,
.x-sidebar .widget_price_filter .price_slider_amount .button {
  color: <?php echo $x_ethos_sidebar_color; ?>;
}


/*
// Border color.
*/

.x-main .h-widget,
.x-main .widget.widget_pages .current_page_item,
.x-main .widget.widget_nav_menu .current-menu-item,
.x-sidebar .h-widget,
.x-sidebar .widget.widget_pages .current_page_item,
.x-sidebar .widget.widget_nav_menu .current-menu-item {
  border-color: <?php echo $x_ethos_sidebar_widget_headings_color; ?>;
}


/*
// Background color.
*/

.x-topbar,
.x-colophon.bottom {
  background-color: <?php echo $x_ethos_topbar_background; ?>;
}

.x-logobar,
.x-navbar,
.x-navbar .sub-menu,
.x-colophon.top {
  background-color: <?php echo $x_ethos_navbar_background; ?>;
}



/* Post Slider
// ========================================================================== */

.x-post-slider {
  height: <?php echo $x_ethos_post_slider_blog_height . 'px'; ?>;
}
 
.archive .x-post-slider {
  height: <?php echo $x_ethos_post_slider_archive_height . 'px'; ?>;
}

.x-post-slider .x-post-slider-entry {
  padding-bottom: <?php echo $x_ethos_post_slider_blog_height . 'px'; ?>;
}
 
.archive .x-post-slider .x-post-slider-entry {
  padding-bottom: <?php echo $x_ethos_post_slider_archive_height . 'px'; ?>;
}



/* Custom Fonts - Colors
// ========================================================================== */

/*
// Body.
*/

.format-link .link a,
.x-portfolio .entry-extra .x-ul-tags li a {
  color: <?php echo $x_body_font_color; ?>;
}


/*
// Headings.
*/

.p-meta > span > a,
.x-nav-articles a,
.entry-top-navigation .entry-parent,
.option-set .x-index-filters,
.option-set .x-portfolio-filters,
.option-set .x-index-filters-menu >li >a:hover,
.option-set .x-index-filters-menu >li >a.selected,
.option-set .x-portfolio-filters-menu > li > a:hover,
.option-set .x-portfolio-filters-menu > li > a.selected {
  color: <?php echo $x_headings_font_color; ?>;
}

.x-nav-articles a,
.entry-top-navigation .entry-parent,
.option-set .x-index-filters,
.option-set .x-portfolio-filters,
.option-set .x-index-filters i,
.option-set .x-portfolio-filters i {
  border-color: <?php echo $x_headings_font_color; ?>;
}

.x-nav-articles a:hover,
.entry-top-navigation .entry-parent:hover,
.option-set .x-index-filters:hover i,
.option-set .x-portfolio-filters:hover i {
  background-color: <?php echo $x_headings_font_color; ?>;
}



/* Responsive Styling
// ========================================================================== */

@media (max-width: 979px) {

  <?php if ( $x_navbar_positioning == 'fixed-top' ) : ?>

    .x-navbar-fixed-top-active .x-navbar-wrap {
      margin-bottom: 0;
    }

  <?php endif; ?>

  .x-content-sidebar-active .x-container.main:before,
  .x-sidebar-content-active .x-container.main:before {
    left: -5000em;
  }

  body .x-main .widget,
  body .x-main .widget a,
  body .x-main .widget a:hover,
  body .x-main .widget ul li a,
  body .x-main .widget ol li a,
  body .x-main .widget ul li a:hover,
  body .x-main .widget ol li a:hover,
  body .x-sidebar .widget,
  body .x-sidebar .widget a,
  body .x-sidebar .widget a:hover,
  body .x-sidebar .widget ul li a,
  body .x-sidebar .widget ol li a,
  body .x-sidebar .widget ul li a:hover,
  body .x-sidebar .widget ol li a:hover {
    color: <?php echo $x_body_font_color; ?>;
  }

  body .x-main .h-widget,
  body .x-main .widget.widget_pages .current_page_item a,
  body .x-main .widget.widget_nav_menu .current-menu-item a,
  body .x-main .widget.widget_pages .current_page_item a:hover,
  body .x-main .widget.widget_nav_menu .current-menu-item a:hover,
  body .x-sidebar .h-widget,
  body .x-sidebar .widget.widget_pages .current_page_item a,
  body .x-sidebar .widget.widget_nav_menu .current-menu-item a,
  body .x-sidebar .widget.widget_pages .current_page_item a:hover,
  body .x-sidebar .widget.widget_nav_menu .current-menu-item a:hover {
    color: <?php echo $x_headings_font_color; ?>;
  }

  body .x-main .h-widget,
  body .x-main .widget.widget_pages .current_page_item,
  body .x-main .widget.widget_nav_menu .current-menu-item,
  body .x-sidebar .h-widget,
  body .x-sidebar .widget.widget_pages .current_page_item,
  body .x-sidebar .widget.widget_nav_menu .current-menu-item {
    border-color: <?php echo $x_headings_font_color; ?>;
  }

}

@media (max-width: 767px) {
  .x-post-slider,
  .archive .x-post-slider {
    height: auto !important;
  }

  .x-post-slider .x-post-slider-entry,
  .archive .x-post-slider .x-post-slider-entry {
    padding-bottom: 65% !important;
  }
}



/* Adminbar Styling
// ========================================================================== */

<?php if ( is_admin_bar_showing() ) : ?>

  html body #wpadminbar {
    z-index: 99999 !important;
  }


  /*
  // Fixed navbar.
  */

  .admin-bar .x-navbar-fixed-top,
  .admin-bar .x-navbar-fixed-left,
  .admin-bar .x-navbar-fixed-right {
    top: 32px;
  }

  @media (max-width: 979px) {
    .admin-bar .x-navbar-fixed-top,
    .admin-bar .x-navbar-fixed-left,
    .admin-bar .x-navbar-fixed-right {
      top: 0;
    }
  }


  /*
  // Widgetbar.
  */

  .admin-bar .x-widgetbar     { top: 30px; }
  .admin-bar .x-btn-widgetbar { top: 32px; }

  @media screen and (max-width: 782px) {
    .admin-bar .x-widgetbar     { top: 44px; }
    .admin-bar .x-btn-widgetbar { top: 46px; }
  }

<?php endif; ?>