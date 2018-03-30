<?php
/* Currency Switcher for Header */
if( class_exists( 'WP_Currencies' ) ) {

    $supported_currencies = inspiry_supported_currencies();

    if ( 0 < count( $supported_currencies ) ) {

        echo '<form id="currency-switcher-form" method="post" action="'. admin_url( 'admin-ajax.php' ) .'" >';

            echo '<div id="currency-switcher">';

                $current_currency = inspiry_get_current_currency();

                echo '<div id="selected-currency">' . $current_currency . '</div>';

                echo '<ul id="currency-switcher-list">';
                    foreach( $supported_currencies as $currency_code ) {
                        echo '<li data-currency-code="' . $currency_code . '">' . $currency_code . '</li>';
                    }
                echo '</ul>';

            echo '</div>';

            echo '<input type="hidden" id="switch-to-currency" name="switch_to_currency" value="'. $current_currency .'" />';
            echo '<input type="hidden" name="action" value="switch_currency" />';
            echo '<input type="hidden" name="nonce" value="'. wp_create_nonce('switch_currency_nonce') .'"/>';

        echo '</form>';

    }

}
?>