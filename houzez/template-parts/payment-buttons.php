<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 03/02/16
 * Time: 6:48 PM
 */
global $post, $prop_featured, $payment_status, $property_status_text, $price_per_submission, $price_featured_submission, $currency, $paid_submission_type;

$enable_wireTransfer = houzez_option('enable_wireTransfer');
$enable_paypal = houzez_option('enable_paypal');
$enable_stripe = houzez_option('enable_stripe');
$per_listing_expire_unlimited = houzez_option('per_listing_expire_unlimited');
$per_listing_expire = houzez_option('per_listing_expire');
$postID = get_the_ID();

if( $paid_submission_type == 'per_listing' && $property_status_text != 'expired' ) {
    if ($payment_status != 'paid' ) {
        echo '<div class="btn-group">';
        echo '<button class="pay-btn action-btn">' . esc_html__('Pay Now', 'houzez') . ' <i class="fa fa-angle-down"></i></button>';
        echo '<div class="dropdown-menu">';
        echo '<div class="pay-options">';
        echo '<table>';
        echo '<tr>';
        echo '<td><div class="checkbox">' . esc_html__('Submission Fee:', 'houzez') . '</div></td>';
        echo '<td><span class="submission_price">' . floatval($price_per_submission) . '</span> ' . esc_html($currency) . '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td><div class="checkbox">';
        echo '<label for="prop_featured">';
        echo '<input type="checkbox" class="prop_featured" id="prop_featured" value="1">';
        echo esc_html__('Featured Fee:', 'houzez') . '</label>';
        echo '</div>';
        echo '</td>';
        echo '<td><span class="submission_featured_price">' . floatval($price_featured_submission) . '</span> ' . esc_html($currency) . '</td>';
        echo '</tr>';
        echo '<tfoot>';
        echo '<tr>';
        echo '<td>' . esc_html__('Total Fee:', 'houzez') . '</td>';
        echo '<td><span class="submission_total_price">' . floatval($price_per_submission) . '</span> ' . esc_html($currency) . '</td>';
        echo '</tr>';
        echo '</tfoot>';
        echo '</table>';
        echo '</div>';

        if( $enable_paypal != 0 || $enable_wireTransfer != 0 || $enable_stripe != 0 ) {
            echo '<ul>';
            if ($enable_paypal != 0) {
                echo '<li><a href="#" class="paypal_single_listing" data-propertyID="' . intval($post->ID) . '"><i class="fa fa-paypal"></i>' . esc_html__('Pay with PayPal', 'houzez') . '</a></li>';
            }
            if( $enable_stripe != 0 ){
            echo '<li class="houzez-stripe-btn">';
                houzez_show_stripe_form_per_listing( $postID, $price_per_submission, $price_featured_submission );
            echo '</li>';
            }
            if ($enable_wireTransfer != 0) {
                echo '<li><a href="#" class="wire_single_listing" data-propertyID="' . intval($post->ID) . '"><i class="fa fa-retweet"></i>' . esc_html__('Pay with Wire Transfer', 'houzez') . '</a></li>';
            }
            echo '</ul>';
        }

           echo '</div>';
        echo '</div>';

        } else {

        if( $prop_featured != 1 ) {

            echo '<div class="btn-group">';
                echo '<button class="pay-btn action-btn">'.esc_html__('Upgrade to Featured', 'houzez').'<i class="fa fa-angle-down"></i></button>';
                echo '<div class="dropdown-menu">';

                    echo '<div class="pay-options">';
                    echo '<table>';
                        echo '<tr>';
                            echo '<td><div class="checkbox">'.esc_html__('Featured Fee:', 'houzez').'</div></td>';
                            echo '<td><span>'.floatval($price_featured_submission).'</span> '.esc_html($currency).'</td>';
                        echo '</tr>';
                    echo '<tfoot>';
                        echo '<tr>';
                            echo '<td>'.esc_html__('Total Fee:', 'houzez').'</td>';
                            echo '<td><span class="submission_total_price">'.floatval($price_featured_submission).'</span> '.esc_html($currency).'</td>';
                        echo '</tr>';
                    echo '</tfoot>';
                    echo '</table>';
                    echo '</div>';

                    if( $enable_paypal != 0 || $enable_wireTransfer != 0 || $enable_stripe != 0 ) {
                        echo '<ul>';
                        if ($enable_paypal != 0) {
                            echo '<li><a href="#" class="paypal_single_listing_upgrade" data-propertyID="' . intval($post->ID) . '"><i class="fa fa-paypal"></i>' . esc_html__('Pay with PayPal', 'houzez') . '</a></li>';
                        }

                        if( $enable_stripe != 0 ){
                            echo '<li class="houzez-stripe-btn">';
                            houzez_show_stripe_form_upgrade($postID, $price_featured_submission);
                            echo '</li>';
                        }

                        if ($enable_wireTransfer != 0) {
                            echo '<li><a href="#" class="wire_single_listing" data-isupgrade="1" data-propertyID="' . intval($post->ID) . '"><i class="fa fa-retweet"></i>' . esc_html__('Pay with Wire Transfer', 'houzez') . '</a></li>';
                        }
                        echo '</ul>';
                    }
                echo '</div>';
            echo '</div>';
        }

   }
 } //End $paid_submission_type if condition ?>