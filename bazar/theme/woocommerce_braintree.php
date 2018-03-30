<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
if ( isset( $GLOBALS['wc_braintree'] ) && class_exists( 'WC_Braintree' ) ) :

    if ( version_compare( WC_Braintree::VERSION, "2.0.0", '<=' ) ) {
        add_action( 'woocommerce_after_checkout_form', 'woocommerce_braintree_compatibility_2_0_0' );
    } else {
        add_action( 'woocommerce_after_checkout_form', 'woocommerce_braintree_compatibility' );
    }

    if ( ! function_exists( "woocommerce_braintree_compatibility_2_0_0" ) ) {
        function woocommerce_braintree_compatibility_2_0_0() {
            if(!yit_get_option('shop-checkout-multistep')) return;
            ?>
            <script type='text/javascript' charset='utf-8'>
                jQuery(document).ready(function ($) {

                    if (typeof  Braintree !== 'undefined') {
                        var braintree_params = wc_braintree_vars;
                        var braintree = Braintree.create(braintree_params.cse_key);
                    }

                    // Perform validation on the card info entered and encrypt the card info when successful
                    function validateCardData($form) {

                        var savedCardSelected = $('input[name=braintree-card-token]:radio').filter(':checked').val();

                        // don't validate fields or encrypt data if a saved card is being used
                        if ('undefined' !== typeof savedCardSelected && '' !== savedCardSelected) {
                            return true;
                        }

                        var errors = [];
                        var card = $('#braintree-card-number').val();
                        var cvv = $('#braintree-card-cvv').val();
                        var month = $('#braintree-card-exp-month').val();
                        var year = $('#braintree-card-exp-year').val();
                        var types = wc_braintree_vars.valid_types;

                        if (!card || card == '') {
                            errors.push(wc_braintree_vars.msg_card_missing);
                        } else {
                            // replace any dashes or spaces in the card number
                            card = card.replace(/-|\s/g, '');

                            if (!$.payment.validateCardNumber(card)) {
                                errors.push(wc_braintree_vars.msg_card_invalid);
                            }

                            // if selected card types
                            if (wc_braintree_vars.valid_types && wc_braintree_vars.valid_types.length > 0) {
                                var type = $.payment.cardType(card);
                                type = type.toLowerCase().replace(/ /g, '-');

                                if ($.inArray(type, wc_braintree_vars.valid_types) < 0) {
                                    errors.push(wc_braintree_vars.msg_type_invalid);
                                }
                            }
                        }

                        if (!$.payment.validateCardExpiry(month, year)) {
                            errors.push(wc_braintree_vars.msg_expired_date);
                        }

                        // validate CVV if present
                        if ('undefined' !== typeof cvv) {
                            if (!$.payment.validateCardCVC(cvv)) {
                                errors.push(wc_braintree_vars.invalid_cvv);
                            }
                        }

                        if (errors.length > 0) {

                            // hide and remove any previous errors
                            $('.woocommerce-error, .woocommerce-message').remove();

                            // add errors
                            $form.prepend('<ul class="woocommerce-error"><li>' + errors.join('</li><li>') + '</li></ul>');

                            // unblock UI
                            $form.removeClass('processing').unblock();

                            $form.find('.input-text, select').blur();

                            // scroll to top
                            $('html, body').animate({
                                scrollTop: ( $form.offset().top - 100 )
                            }, 1000);

                            return false;

                        } else {

                            // reset to standard value
                            $('#braintree-card-number').val(card);
                            var braintree = Braintree.create(wc_braintree_vars.cse_key);

                            // encrypt the credit card fields
                            braintree.encryptForm($form);
                            return true;
                        }
                    }

                    jQuery(document).on('click', '#multistep_steps #order_review input#place_order', function () {
                        return validateCardData(jQuery('form.checkout'))
                    });

                });
            </script>
        <?php
        }
    }

    if ( ! function_exists( "woocommerce_braintree_compatibility" ) ) :
    function woocommerce_braintree_compatibility() {
          if(!yit_get_option('shop-checkout-multistep')) return;
        ?>
        <script type='text/javascript' charset='utf-8'>
            jQuery(document).ready(function ($) {

                if (typeof  Braintree !== 'undefined') {
                    var braintree = Braintree.create(braintree_params.cse_key);
                }

                // Perform validation on the card info entered and encrypt the card info when successful
                function validateCardData($form) {

                    var savedCardSelected = $('input[name=braintree-cc-token]:radio').filter(':checked').val();

                    // don't validate fields or encrypt data if a saved card is being used
                    if ('undefined' !== typeof savedCardSelected && '' !== savedCardSelected) {
                        return true;
                    }

                    var errors = [];

                    var cardNumber = $('#braintree-cc-number').val();
                    var cvv = $('#braintree-cc-cvv').val();
                    var expMonth = $('#braintree-cc-exp-month').val();
                    var expYear = $('#braintree-cc-exp-year').val();

                    if (typeof braintree_params != 'undefined') {
                        // replace any dashes or spaces in the card number
                        if (typeof cardNumber != 'undefined')
                            cardNumber = cardNumber.replace(/-|\s/g, '');

                        // validate card number
                        if (!cardNumber) {

                            errors.push(braintree_params.card_number_missing);

                        } else if (cardNumber.length < 12 || cardNumber.length > 19 || /\D/.test(cardNumber) || !luhnCheck(cardNumber)) {

                            errors.push(braintree_params.card_number_invalid);
                        }

                        // validate expiration date
                        var currentYear = new Date().getFullYear();
                        if (/\D/.test(expMonth) || /\D/.test(expYear) ||
                            expMonth > 12 ||
                            expMonth < 1 ||
                            expYear < currentYear ||
                            expYear > currentYear + 20) {
                            errors.push(braintree_params.card_exp_date_invalid);
                        }

                        // validate CVV if present
                        if ('undefined' !== typeof cvv) {

                            if (!cvv) {
                                errors.push(braintree_params.cvv_missing);
                            } else if (/\D/.test(cvv)) {
                                errors.push(braintree_params.cvv_invalid);
                            } else if (cvv.length < 3 || cvv.length > 4) {
                                errors.push(braintree_params.cvv_length_invalid);
                            }
                        }


                        if (errors != 'undefined' && errors.length > 0) {
                            console.log("err: " + errors);
                            // hide and remove any previous errors
                            $('.woocommerce-error, .woocommerce-message').remove();

                            // add errors
                            $form.prepend('<ul class="woocommerce-error"><li>' + errors.join('</li><li>') + '</li></ul>');

                            // unblock UI
                            $form.removeClass('processing').unblock();

                            $form.find('.input-text, select').blur();

                            // scroll to top
                            $('html, body').animate({
                                scrollTop: ( $form.offset().top - 100 )
                            }, 1000);

                            return false;

                        } else {

                            // get rid of any space/dash characters
                            $('#braintree-cc-number').val(cardNumber);

                            // encrypt the credit card fields
                            braintree.encryptForm($form);

                            return true;
                        }
                    }
                }

                // show/hide the credit cards when a saved card is de-selected/selected
                function handleSavedCards() {

                    $('input[name=braintree-cc-token]:radio').change(function () {

                        var savedCreditCardSelected = $(this).filter(':checked').val(),
                            $newCardSection = $('div.braintree-new-card');

                        // if a saved card is selected, hide the credit card form
                        if ('' !== savedCreditCardSelected) {
                            $newCardSection.slideUp(200);
                        } else {
                            // otherwise show it so customer can enter new card
                            $newCardSection.slideDown(200);
                        }
                    }).change();
                }

                // luhn check
                function luhnCheck(cardNumber) {
                    var sum = 0;
                    for (var i = 0, ix = cardNumber.length; i < ix - 1; i++) {
                        var weight = parseInt(cardNumber.substr(ix - ( i + 2 ), 1) * ( 2 - ( i % 2 ) ));
                        sum += weight < 10 ? weight : weight - 9;
                    }

                    return cardNumber.substr(ix - 1) == ( ( 10 - sum % 10 ) % 10 );
                }

                jQuery(document).on('click', '#multistep_steps #order_review input#place_order', function () {
                    return validateCardData(jQuery('form.checkout'))
                });

            });
        </script>
    <?php
    }
    endif;
endif;


