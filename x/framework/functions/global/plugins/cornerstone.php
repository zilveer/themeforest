<?php

// =============================================================================
// FUNCTIONS/GLOBAL/PLUGINS/CORNERSTONE.PHP
// -----------------------------------------------------------------------------
// Plugin setup for theme compatibility.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. MEJS [audio]
//   02. MEJS [video]
//   03. Validation Box Replacement
//   04. Validation Overlay Replacement
//   05. Hide X validation notice on Cornertstone home page
//   06. Remove Cornerstone Validation Notice
//   07. Cornerstone Home Scripts
// =============================================================================


// MEJS [audio]
// =============================================================================

//
// 1. Library.
// 2. Output.
// 3. Class.
//


if ( !function_exists( 'x_native_wp_audio_shortcode_library' ) ) :

  function x_native_wp_audio_shortcode_library() { // 1
    wp_enqueue_script( 'mediaelement' );
    return false;
  }

  add_filter( 'wp_audio_shortcode_library', 'x_native_wp_audio_shortcode_library' );
endif;


if ( !function_exists( 'x_native_wp_audio_shortcode' ) ) :

  function x_native_wp_audio_shortcode( $html ) { // 2
    return '<div class="x-audio player" data-x-element="x_mejs">' . $html . '</div>';
  }

  add_filter( 'wp_audio_shortcode', 'x_native_wp_audio_shortcode' );
endif;


if ( !function_exists( 'x_native_wp_audio_shortcode_class' ) ) :

  function x_native_wp_audio_shortcode_class() { // 3
    return 'x-mejs x-wp-audio-shortcode advanced-controls';
  }

  add_filter( 'wp_audio_shortcode_class', 'x_native_wp_audio_shortcode_class' );
endif;

// MEJS [video]
// =============================================================================

//
// 1. Library.
// 2. Output.
// 3. Class.
//

if ( !function_exists( 'x_native_wp_video_shortcode_library' ) ) :

  function x_native_wp_video_shortcode_library() { // 1
    wp_enqueue_script( 'mediaelement' );
    return false;
  }

  add_filter( 'wp_video_shortcode_library', 'x_native_wp_video_shortcode_library' );
endif;


if ( !function_exists( 'x_native_wp_video_shortcode' ) ) :

  function x_native_wp_video_shortcode( $output ) { // 2
    return '<div class="x-video player" data-x-element="x_mejs">' . preg_replace('/<div(.*?)>/', '<div class="x-video-inner">', $output ) . '</div>';
  }

  add_filter( 'wp_video_shortcode', 'x_native_wp_video_shortcode' );
endif;


if ( !function_exists( 'x_native_wp_video_shortcode_class' ) ) :

  function x_native_wp_video_shortcode_class() { // 3
    return 'x-mejs x-wp-video-shortcode advanced-controls';
  }

  add_filter( 'wp_video_shortcode_class', 'x_native_wp_video_shortcode_class' );
endif;





// Validation Box Replacement
// =============================================================================


function x_cornerstone_validation_box() {

  ?>

  <div class="tco-box tco-box-validation">
    <div class="tco-box-content">
      <div class="tco-validation">
        <div class="tco-validation-graphic">
          <?php x_tco()->admin_icon( 'locked', 'tco-validation-graphic-icon' ); ?>
          <?php x_tco()->admin_icon( 'arrow-right', 'tco-validation-graphic-icon' ); ?>
          <?php x_tco()->admin_icon( 'key', 'tco-validation-graphic-icon' ); ?>
          <?php x_tco()->admin_icon( 'arrow-right', 'tco-validation-graphic-icon' ); ?>
          <?php x_tco()->admin_icon( 'unlocked', 'tco-validation-graphic-icon' ); ?>
        </div>
        <h1 class="tco-validation-title"><?php _e( 'You&apos;re almost finished!', '__x__' ); ?></h1>
        <p class="tco-validation-text"><?php _e( 'Great to see you&apos;re using Cornerstone with X, but it is ​<strong>not validated</strong>. Once X is validated, Cornerstone will automatically be validated as well. You&apos;ll also have instant access to support, automatic updates, custom templates, and more.', '__x__' ); ?></p>
        <a class="tco-btn tco-btn-lg" href="<?php echo x_addons_get_link_home(); ?>"><?php _e( 'CLICK HERE TO VALIDATE', '__x__' ); ?></a>
      </div>
    </div>
  </div>

  <?php

}

add_action( '_cornerstone_home_not_validated', 'x_cornerstone_validation_box' );



// Validation Box Replacement
// =============================================================================


function x_cornerstone_validation_overlay() {

  ?>

  <h4 class="tco-box-content-title"><?php _e( 'How do I unlock this feature?', '__x__' ); ?></h4>
  <p><?php printf( __( 'By validating X. Once X is validated, Cornerstone will automatically be validated as well.<br><br>You can validate X <a href="%s">here</a>.', '__x__' ), x_addons_get_link_home() ); ?></p>

  <?php

}

add_action( '_cornerstone_validation_overlay', 'x_cornerstone_validation_overlay' );



// Hide X validation notice on Cornertstone home page
// =============================================================================

function x_cornerstone_block_validation_notice( $screens ) {
  $screens[] = 'cornerstone-home';
  return $screens;
}

add_filter( 'x_validation_notice_blocked_screens', 'x_cornerstone_block_validation_notice' );



// Remove Cornerstone Validation Notice
// =============================================================================

if ( function_exists( 'cornerstone_theme_integration' ) ) {

  cornerstone_theme_integration( array( 'remove_global_validation_notice' => true ) );

}



// Cornerstone Home Scripts
// =============================================================================

//
// 1. Output.
// 2. Hook admin_print_scripts.
//

function x_cornerstone_home_page_scripts_output() {

  ?>

  <script type="text/javascript">

    jQuery( '[data-tco-module="cs-validation-revoke"]').remove();
    jQuery( '[data-tco-module="cs-purchase-another-license"]' ).click( function( e ) {

      e.preventDefault();

      tco.confirm( {
        accept:  { url: "https://theme.co/go/join-validation.php", newTab: true },
        decline: { url: jQuery( this ).attr( 'href' ), newTab: true },
        message: "<?php _e( 'We see this is an X site, would you like to purchase another X license? Cornerstone is always included for free with X.', '__x__' ); ?>",
        acceptClass: 'tco-btn-yep',
        acceptBtn: "<?php _e( 'Purchase X (includes Cornerstone)', '__x__' ); ?>",
        declineBtn: "<?php _e( 'Just Cornerstone', '__x__' ); ?>",
      } );

    } );

  </script>

  <?php
}

function x_cornerstone_home_page_scripts() {
  add_action( 'admin_print_footer_scripts', 'x_cornerstone_home_page_scripts_output' ); // 1
}

add_action( '_cornerstone_home_after', 'x_cornerstone_home_page_scripts' );
