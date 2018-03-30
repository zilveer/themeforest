<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 09/09/16
 * Time: 12:49 PM
 */
?>
<h3 class="side-block-title"> <?php esc_attr_e( 'Pay Listing', 'houzez' ); ?> </h3>

<?php
$currency_symbol = houzez_option( 'currency_symbol' );
$where_currency = houzez_option( 'currency_position' );
$price_listing_submission = houzez_option('price_listing_submission');

if ( $where_currency == 'before' ) {
    $price_listing_submission = $currency_symbol.' '.$price_listing_submission;
} else {
    $price_listing_submission = $price_listing_submission.' '.$currency_symbol;
}
?>
<ul class="pkg-total-list">
    <li>
        <span class="pull-left"><?php esc_html_e('Listing Price:', 'houzez' ); ?></span>
        <span class="pull-right"><?php echo esc_attr( $price_listing_submission ); ?></span>
    </li>

    <li>
        <span class="pull-left"><?php esc_html_e('Total Price:', 'houzez' ); ?></span>
        <span class="pull-right"><?php echo esc_attr( $price_listing_submission ); ?></span>
    </li>
</ul>
