<?php
/**
 * Contact Row
 *
 * @author      Ibrahim Ibn Dawood
 * @package     Framework/Templates
 * @version     1.0.6
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$header_support_phone = apply_filters( 'mc_header_support_phone', '' );
$header_support_email = apply_filters( 'mc_header_support_email', '' );
?>

<div class="contact-row">
    <?php if( ! empty( $header_support_phone ) ) : ?>
    <div class="phone inline">
        <i class="fa fa-phone"></i> <?php echo $header_support_phone; ?>
    </div>
    <?php endif; ?>
    <?php if( ! empty( $header_support_email ) ) : ?>
    <div class="contact inline">
        <i class="fa fa-envelope"></i> <?php echo $header_support_email; ?>
    </div>
    <?php endif; ?>
</div><!-- /.contact-row -->