<?php

// =============================================================================
// WOOCOMMERCE/SINGLE-PRODUCT/TABS/TABS.PHP
// -----------------------------------------------------------------------------
// @version 2.4.0
// =============================================================================

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) :

  $tab_num = count( $tabs );

  switch ( $tab_num ) {
    case '1' :
      $tab_num_class = 'one-up';
      break;
    case '2' :
      $tab_num_class = 'two-up';
      break;
    case '3' :
      $tab_num_class = 'three-up';
      break;
    case '4' :
      $tab_num_class = 'four-up';
      break;
    case '5' :
      $tab_num_class = 'five-up';
      break;
  }

  ?>

  <?php if ( x_get_option( 'x_woocommerce_product_tabs_enable' ) == '1' ) : ?>

    <?php ob_start(); ?>

      [x_tab_nav type="<?php echo $tab_num_class; ?>"]
        <?php foreach ( $tabs as $key => $tab ) : ?>
          [x_tab_nav_item class="<?php echo esc_attr( $key ); ?>_tab" title="<?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?>"]
        <?php endforeach; ?>
      [/x_tab_nav]
      [x_tabs]
        <?php foreach ( $tabs as $key => $tab ) : ?>
          [x_tab class="<?php echo esc_attr( $key ); ?>_pane"]<?php call_user_func( $tab['callback'], $key, $tab ); ?>[/x_tab]
        <?php endforeach; ?>
      [/x_tabs]

    <?php $tabs = ob_get_clean(); ?>

    <div class="woocommerce-tabs">
      <?php echo do_shortcode( $tabs ); ?>
    </div>

  <?php endif; ?>

<?php endif; ?>