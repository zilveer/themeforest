<?php
 
// =============================================================================
// FUNCTIONS/GLOBAL/ADMIN/CUSTOMIZER/OUTPUT/BUTTONS.PHP
// -----------------------------------------------------------------------------
// Global CSS output for buttons.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Base Styles
//   02. Button Style - Real
//   03. Button Style - Flat
//   04. Button Style - Transparent
// =============================================================================

?>

/* Base Styles
// ========================================================================== */

.x-btn,
.button,
[type="submit"] {

  /*
  // Colors.
  */

  color: <?php echo $x_button_color; ?>;
  border-color: <?php echo $x_button_border_color; ?>;
  background-color: <?php echo $x_button_background_color; ?>;


  /*
  // Style.
  */

  <?php if ( $x_button_style == 'real' ) : ?>
    margin-bottom: 0.25em;
    text-shadow: 0 0.075em 0.075em rgba(0, 0, 0, 0.5);
    box-shadow: 0 0.25em 0 0 <?php echo $x_button_bottom_color; ?>, 0 4px 9px rgba(0, 0, 0, 0.75);
  <?php elseif ( $x_button_style == 'flat' ) : ?>
    text-shadow: 0 0.075em 0.075em rgba(0, 0, 0, 0.5);
  <?php elseif ( $x_button_style == 'transparent' ) : ?>
    border-width: 3px;
    text-transform: uppercase;
    background-color: transparent;
  <?php endif; ?>


  /*
  // Shape.
  */

  <?php if ( $x_button_shape == 'rounded' ) : ?>
    border-radius: 0.25em;
  <?php elseif ( $x_button_shape == 'pill' ) : ?>
    border-radius: 100em;
  <?php endif; ?>


  /*
  // Size.
  */

  <?php if ( $x_button_size == 'mini' ) : ?>
    padding: 0.385em 0.923em 0.538em;
    font-size: 13px;
  <?php elseif ( $x_button_size == 'small' ) : ?>
    padding: 0.429em 1.143em 0.643em;
    font-size: 14px;
  <?php elseif ( $x_button_size == 'large' ) : ?>
    padding: 0.579em 1.105em 0.842em;
    font-size: 19px;
  <?php elseif ( $x_button_size == 'x-large' ) : ?>
    padding: 0.714em 1.286em 0.952em;
    font-size: 21px;
  <?php elseif ( $x_button_size == 'jumbo' ) : ?>
    padding: 0.643em 1.429em 0.857em;
    font-size: 28px;
  <?php endif; ?>

}

.x-btn:hover,
.button:hover,
[type="submit"]:hover {

  /*
  // Colors.
  */

  color: <?php echo $x_button_color_hover; ?>;
  border-color: <?php echo $x_button_border_color_hover; ?>;
  background-color: <?php echo $x_button_background_color_hover; ?>;


  /*
  // Style.
  */

  <?php if ( $x_button_style == 'real' ) : ?>
    margin-bottom: 0.25em;
    text-shadow: 0 0.075em 0.075em rgba(0, 0, 0, 0.5);
    box-shadow: 0 0.25em 0 0 <?php echo $x_button_bottom_color_hover; ?>, 0 4px 9px rgba(0, 0, 0, 0.75);
  <?php elseif ( $x_button_style == 'flat' ) : ?>
    text-shadow: 0 0.075em 0.075em rgba(0, 0, 0, 0.5);
  <?php elseif ( $x_button_style == 'transparent' ) : ?>
    border-width: 3px;
    text-transform: uppercase;
    background-color: transparent;
  <?php endif; ?>

}



/* Button Style - Real
// ========================================================================== */

.x-btn.x-btn-real,
.x-btn.x-btn-real:hover {
  margin-bottom: 0.25em;
  text-shadow: 0 0.075em 0.075em rgba(0, 0, 0, 0.65);
}

.x-btn.x-btn-real {
  box-shadow: 0 0.25em 0 0 <?php echo $x_button_bottom_color; ?>, 0 4px 9px rgba(0, 0, 0, 0.75);
}

.x-btn.x-btn-real:hover {
  box-shadow: 0 0.25em 0 0 <?php echo $x_button_bottom_color_hover; ?>, 0 4px 9px rgba(0, 0, 0, 0.75);
}



/* Button Style - Flat
// ========================================================================== */

.x-btn.x-btn-flat,
.x-btn.x-btn-flat:hover {
  margin-bottom: 0;
  text-shadow: 0 0.075em 0.075em rgba(0, 0, 0, 0.65);
  box-shadow: none;
}



/* Button Style - Transparent
// ========================================================================== */

.x-btn.x-btn-transparent,
.x-btn.x-btn-transparent:hover {
  margin-bottom: 0;
  border-width: 3px;
  text-shadow: none;
  text-transform: uppercase;
  background-color: transparent;
  box-shadow: none;
}