<?php
 
// =============================================================================
// FUNCTIONS/GLOBAL/ADMIN/CUSTOMIZER/OUTPUT/MASTHEAD.PHP
// -----------------------------------------------------------------------------
// Global CSS output for the masthead.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Body Layout
//   02. Widgetbar
//   03. Navbar
//   04. Navbar - Wrapper
//   05. Navbar - Inner Container
//   06. Navbar - Logo and Navigation Layout
//   07. Navbar - Brand
//   08. Navbar - Navigation
//   09. Responsive Styling
// =============================================================================

?>

/* Body Layout
// ========================================================================== */

<?php if ( $x_navbar_positioning == 'fixed-left' ) : ?>

  body.x-navbar-fixed-left-active {
    padding-left: <?php echo $x_navbar_width . 'px'; ?>;
  }

<?php endif; ?>

<?php if ( $x_navbar_positioning == 'fixed-right' ) : ?>

  body.x-navbar-fixed-right-active {
    padding-right: <?php echo $x_navbar_width . 'px'; ?>;
  }

<?php endif; ?>



/* Widgetbar
// ========================================================================== */

<?php if ( $x_header_widget_areas != 0 ) : ?>

  .x-btn-widgetbar {
    border-top-color: <?php echo $x_widgetbar_button_background; ?>;
    border-right-color: <?php echo $x_widgetbar_button_background; ?>;
  }

  .x-btn-widgetbar:hover {
    border-top-color: <?php echo $x_widgetbar_button_background_hover; ?>;
    border-right-color: <?php echo $x_widgetbar_button_background_hover; ?>;
  }

<?php endif; ?>


/* Navbar Overflow Scroll
// ========================================================================== */

<?php if ( $x_fixed_menu_scroll == 'overflow-scroll' && $x_navbar_positioning == 'fixed-left' || $x_navbar_positioning == 'fixed-right' ) : ?>

  .x-navbar {
    width: <?php echo $x_navbar_width . 'px'; ?>;
    overflow-y: auto;
  }

<?php endif; ?>


/* Navbar Overflow Visible
// ========================================================================== */

<?php if( $x_fixed_menu_scroll == 'overflow-visible' && $x_navbar_positioning == 'fixed-left' || $x_navbar_positioning == 'fixed-right' ) : ?>

	.x-navbar {
		width: <?php echo $x_navbar_width . 'px'; ?>;
		overflow-y: visible;
	}
	
<?php endif; ?>


/* Navbar - Wrapper
// ========================================================================== */

<?php if ( $x_navbar_positioning == 'fixed-top' ) : ?>

  body.x-navbar-fixed-top-active .x-navbar-wrap {
    height: <?php echo $x_navbar_height . 'px'; ?>;
  }

<?php endif; ?>



/* Navbar - Inner Container
// ========================================================================== */

.x-navbar-inner {
  min-height: <?php echo $x_navbar_height . 'px'; ?>;
}



/* Navbar - Logo and Navigation Layout
// ========================================================================== */

<?php if ( $x_logo_navigation_layout == 'stacked' ) : ?>

  .x-logobar-inner {
    padding-top: <?php echo $x_logobar_adjust_spacing_top . 'px'; ?>;
    padding-bottom: <?php echo $x_logobar_adjust_spacing_bottom . 'px'; ?>;
  }

<?php endif; ?>



/* Navbar - Brand
// ========================================================================== */

.x-brand {
  <?php if ( ( $x_navbar_positioning == 'static-top' || $x_navbar_positioning == 'fixed-top' ) && $x_logo_navigation_layout == 'inline' ) : ?>
    margin-top: <?php echo $x_logo_adjust_navbar_top . 'px'; ?>;
  <?php endif; ?>
  <?php if ( $x_navbar_positioning == 'fixed-left' || $x_navbar_positioning == 'fixed-right' ) : ?>
    margin-top: <?php echo $x_logo_adjust_navbar_side . 'px'; ?>;
  <?php endif; ?>
  font-family: <?php echo $x_logo_font_stack; ?>;
  font-size: <?php echo $x_logo_font_size . 'px'; ?>;
  font-style: <?php echo ( $x_logo_font_is_italic ) ? 'italic' : 'normal'; ?>;
  font-weight: <?php echo $x_logo_font_weight; ?>;
  letter-spacing: <?php echo $x_logo_letter_spacing . 'em'; ?>;
  <?php if ( $x_logo_uppercase_enable == '1' ) : ?>
    text-transform: uppercase;
  <?php endif; ?>
  color: <?php echo $x_logo_font_color; ?>;
}

.x-brand:hover,
.x-brand:focus {
  color: <?php echo $x_logo_font_color; ?>;
}

<?php if ( $x_logo_width != '' ) : ?>

  .x-brand img {
    width: <?php echo $x_logo_width / 2 . 'px'; ?>;
  }

<?php endif; ?>



/* Navbar - Navigation
// ========================================================================== */

.x-navbar .x-nav-wrap .x-nav > li > a {
  font-family: <?php echo $x_navbar_font_stack; ?>;
  font-style: <?php echo ( $x_navbar_font_is_italic ) ? 'italic' : 'normal'; ?>;
  font-weight: <?php echo $x_navbar_font_weight; ?>;
  letter-spacing: <?php echo $x_navbar_letter_spacing . 'em'; ?>;
  <?php if ( x_get_option( 'x_navbar_uppercase_enable' ) == '1' ) : ?>
    text-transform: uppercase;
  <?php endif; ?>
}

.x-navbar .desktop .x-nav > li > a {
  font-size: <?php echo $x_navbar_font_size . 'px'; ?>;
}

<?php if ( $x_navbar_positioning == 'static-top' || $x_navbar_positioning == 'fixed-top' ) : ?>

  .x-navbar .desktop .x-nav > li > a:not(.x-btn-navbar-woocommerce) {
    padding-left: <?php echo $x_navbar_adjust_links_top_spacing . 'px'; ?>;
    padding-right: <?php echo $x_navbar_adjust_links_top_spacing . 'px'; ?>;
  }

<?php endif; ?>

<?php if ( $x_stack != 'icon' ) : ?>

  .x-navbar .desktop .x-nav > li > a > span {
    margin-right: -<?php echo $x_navbar_letter_spacing . 'em'; ?>;
  }

<?php else : ?>

  .x-navbar .desktop .x-nav > li > a > span {
    padding-right: calc(1.25em - <?php echo $x_navbar_letter_spacing . 'em'; ?>);
  }

<?php endif; ?>

.x-btn-navbar {
  margin-top: <?php echo $x_navbar_adjust_button . 'px'; ?>;
}

.x-btn-navbar,
.x-btn-navbar.collapsed {
  font-size: <?php echo $x_navbar_adjust_button_size . 'px'; ?>;
}



/* Responsive Styling
// ========================================================================== */

@media (max-width: 979px) {

  <?php if ( $x_navbar_positioning == 'fixed-left' || $x_navbar_positioning == 'fixed-right' ) : ?>

    body.x-navbar-fixed-left-active,
    body.x-navbar-fixed-right-active {
      padding: 0;
    }

    .x-navbar {
      width: auto;
    }

    .x-navbar .x-navbar-inner > .x-container.width {
      width: <?php echo $x_layout_site_width . '%'; ?>;
    }

    .x-brand {
      margin-top: <?php echo $x_logo_adjust_navbar_top . 'px'; ?>;
    }

  <?php endif; ?>

  <?php if ( $x_navbar_positioning == 'fixed-top' && $x_layout_site == 'boxed' ) : ?>

    .x-navbar.x-navbar-fixed-top.x-container.max.width {
      left: 0;
      right: 0;
      width: 100%;
    }

  <?php endif; ?>

  <?php if ( $x_navbar_positioning == 'fixed-top' ) : ?>

    body.x-navbar-fixed-top-active .x-navbar-wrap {
      height: auto;
    }

  <?php endif; ?>

  .x-widgetbar {
    left: 0;
    right: 0;
  }

}