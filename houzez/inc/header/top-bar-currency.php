<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 11/08/16
 * Time: 8:06 PM
 * Since 1.3.0
 */


$currency_switcher_enable = houzez_option('currency_switcher_enable');

/* Currency Switcher for Header */
if( $currency_switcher_enable != 0 ) {
    if (class_exists('WP_Currencies')) {

        $supported_currencies = houzez_supported_currencies();

        if (0 < count($supported_currencies)) {

            $current_currency = houzez_get_current_currency();

            echo '<li class="btn-price-lang btn-price">';
            echo '<form id="houzez-currency-switcher-form" method="post" action="#" >';
            echo '<button id="houzez-selected-currency" class="btn dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span>' . $current_currency . '</span> <i class="fa fa-sort"></i></button>';
            echo '<ul id="houzez-currency-switcher-list" class="dropdown-menu" aria-labelledby="dropdown">';
            foreach ($supported_currencies as $currency_code) {
                echo '<li data-currency-code="' . $currency_code . '">' . $currency_code . '</li>';
            }
            echo '</ul>';


            echo '<input type="hidden" id="houzez-switch-to-currency" name="houzez_switch_to_currency" value="' . $current_currency . '" />';
            echo '<input type="hidden" id="currency_switch_security" name="nonce" value="' . wp_create_nonce('houzez_switch_currency_nonce') . '"/>';

            echo '</form>';
            echo '</li>';

        }
    }
}
?>