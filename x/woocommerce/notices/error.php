<?php

// =============================================================================
// WOOCOMMERCE/NOTICES/ERROR.PHP
// -----------------------------------------------------------------------------
// @version 1.6.4
// =============================================================================

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

if ( ! $messages ) return;

?>

<ul class="woocommerce-error x-alert x-alert-danger x-alert-block">
  <?php foreach ( $messages as $message ) : ?>
    <li><?php echo wp_kses_post( $message ); ?></li>
  <?php endforeach; ?>
</ul>