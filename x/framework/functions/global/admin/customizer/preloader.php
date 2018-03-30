<?php 

// =============================================================================
// FUNCTIONS/GLOBAL/ADMIN/CUSTOMIZER/PRELOADER.PHP
// -----------------------------------------------------------------------------
// Outputs the Customizer preloader.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Preloader
// =============================================================================

// Preloader
// =============================================================================

function x_customizer_preloader() {

  ob_start();

  ?>

  <style type="text/css" id="x-customizer-preloader-css">

    body {
      overflow: hidden !important;
    }

    .x-preloader {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      text-align: center;
      background-color: #fff;
      z-index: 999999999;
      -webkit-perspective: 1000px;
          -ms-perspective: 1000px;
              perspective: 1000px;
    }

    .x-preloader-logo {
      display: block;
      position: absolute;
      top: 50%;
      left: 50%;
      width: 250px;
      height: 250px;
      margin: -150px 0 0 -125px;
      font-size: 250px;
      font-weight: 600;
      line-height: 1;
      animation: pulseRotate 6s ease infinite;
    }

    .x-preloader-logo svg {
      width: 100%;
      height: 100%;
    }

    .x-preloader-text {
      position: absolute;
      left: 100px;
      right: 100px;
      bottom: 25px;
      margin: 0 -7px 0 0;
      font-size: 12px;
      font-weight: 400;
      letter-spacing: 7px;
      text-align: center;
      text-transform: uppercase;
      color: #222;
    }


    /*
    // Animation.
    */

    @keyframes pulseRotate {
      0%  { transform: rotateY(0deg); }
      10% { transform: rotateY(180deg); }
      20% { transform: rotateY(360deg); }
      50% { transform: rotateY(360deg); }
      60% { transform: rotateY(180deg); }
      70% { transform: rotateY(0deg); }
    }

  </style>

  <div class="x-preloader" id="x-customizer-preloader">
    <div class="x-preloader-logo"><?php x_tco()->x_logo(); ?></div>
    <div class="x-preloader-text"><?php _e( 'Powered by Themeco', '__x__' ); ?></div>
  </div>

  <?php

  $output = ob_get_contents(); ob_end_clean();

  echo $output;

}

add_action( 'customize_controls_print_styles', 'x_customizer_preloader' );