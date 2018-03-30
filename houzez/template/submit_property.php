<?php
/**
 * Template Name: Submit Property
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 06/10/15
 * Time: 3:49 PM
 */
/*if ( !is_user_logged_in() ) {
    wp_redirect( home_url('url') );
}
set_time_limit (600);*/

global $houzez_local, $current_user, $properties_page, $hide_add_prop_fields, $required_fields;

wp_get_current_user();
$userID = $current_user->ID;

$user_email = $current_user->user_email;
$admin_email =  get_bloginfo('admin_email');

$invalid_nonce = false;
$submitted_successfully = false;
$updated_successfully = false;
$dashboard_listings = houzez_dashboard_listings();
$hide_add_prop_fields = houzez_option('hide_add_prop_fields');
$required_fields = houzez_option('required_fields');
$enable_paid_submission = houzez_option('enable_paid_submission');
$payment_page_link = houzez_get_template_link('template/template-payment.php');
$thankyou_page_link = houzez_get_template_link('template/template-thankyou.php');
$select_packages_link = houzez_get_template_link('template/template-packages.php');
$allowed_html = array();

if( isset( $_POST['action'] ) ) {

    $submission_action = $_POST['action'];

    if (wp_verify_nonce($_POST['property_nonce'], 'submit_property')) {

        $new_property = array(
            'post_type'	=> 'property'
        );

        if( $enable_paid_submission == 'per_listing' ) {

            if ( !is_user_logged_in() ) {
                $email = wp_kses( $_POST['user_email'], $allowed_html );
                if( email_exists( $email ) ) {
                    $errors[] = $houzez_local['email_already_registerd'];
                }

                if( !is_email( $email ) ) {
                    $errors[] = $houzez_local['invalid_email'];
                }

                if( empty($errors) ) {
                    $username = explode("@", $email);

                    $username = $username[0];

                    $random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
                    $user_id = wp_create_user( $username, $random_password, $email );

                    $user = get_user_by('login', $username );
                    if( $user_id ) {

                        houzez_update_profile( $user_id );
                        houzez_wp_new_user_notification( $user_id, $random_password );
                        $user_as_agent = houzez_option('user_as_agent');
                        if( $user_as_agent == 'yes' ) {
                            houzez_register_as_agent ( $username, $email, $user_id );
                        }

                        if( !is_wp_error($user) ) {
                            wp_clear_auth_cookie();
                            wp_set_current_user ( $user->ID );
                            wp_set_auth_cookie  ( $user->ID );

                            $property_id = apply_filters( 'houzez_submit_listing', $new_property );

                            if (!empty($payment_page_link)) {
                                $separator = (parse_url($payment_page_link, PHP_URL_QUERY) == NULL) ? '?' : '&';
                                $parameter = 'prop-id=' . $property_id;
                                wp_redirect($payment_page_link . $separator . $parameter);

                            } else {
                                if (!empty($dashboard_listings)) {
                                    $separator = (parse_url($dashboard_listings, PHP_URL_QUERY) == NULL) ? '?' : '&';
                                    $parameter = ($updated_successfully) ? '' : '';
                                    wp_redirect($dashboard_listings . $separator . $parameter);
                                }
                            }
                            exit();
                        }

                    }

                }

            } else {
                $property_id = apply_filters('houzez_submit_listing', $new_property);
                if (!empty($payment_page_link) && $submission_action != 'update_property' ) {
                    $separator = (parse_url($payment_page_link, PHP_URL_QUERY) == NULL) ? '?' : '&';
                    $parameter = 'prop-id=' . $property_id;
                    wp_redirect($payment_page_link . $separator . $parameter);

                } else {
                    if (!empty($dashboard_listings)) {
                        $separator = (parse_url($dashboard_listings, PHP_URL_QUERY) == NULL) ? '?' : '&';
                        $parameter = 'updated=1';
                        wp_redirect($dashboard_listings . $separator . $parameter);
                    }
                }
            }
        // End per listing if
        } else if( $enable_paid_submission == 'membership' ) {

            if ( !is_user_logged_in() ) {
                $email = wp_kses( $_POST['user_email'], $allowed_html );
                if( email_exists( $email ) ) {
                    $errors[] = $houzez_local['email_already_registerd'];
                }

                if( !is_email( $email ) ) {
                    $errors[] = $houzez_local['invalid_email'];
                }

                if( empty($errors) ) {
                    $username = explode("@", $email);

                    $username = $username[0];

                    $random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
                    $user_id = wp_create_user( $username, $random_password, $email );
                    wp_update_user( array( 'ID' => $user_id, 'role' => 'houzez_agent' ) );

                    $user = get_user_by('login', $username );
                    if( $user_id ) {

                        houzez_update_profile( $user_id );
                        houzez_wp_new_user_notification( $user_id, $random_password );
                        $user_as_agent = houzez_option('user_as_agent');
                        if( $user_as_agent == 'yes' ) {
                            houzez_register_as_agent ( $username, $email, $user_id );
                        }

                        if( !is_wp_error($user) ) {
                            wp_clear_auth_cookie();
                            wp_set_current_user ( $user->ID );
                            wp_set_auth_cookie  ( $user->ID );

                            $property_id = apply_filters( 'houzez_submit_listing', $new_property );

                            $args = array(
                                'listing_title'  =>  get_the_title($property_id),
                                'listing_id'     =>  $property_id
                            );

                            /*
                             * Send email
                             * */
                            houzez_email_type( $user_email, 'free_submission_listing', $args);
                            houzez_email_type( $admin_email, 'admin_free_submission_listing', $args);

                            $separator = (parse_url($select_packages_link, PHP_URL_QUERY) == NULL) ? '?' : '&';
                            $parameter = '';//'prop-id=' . $property_id;
                             wp_redirect($select_packages_link . $separator . $parameter);
                            exit();
                        }

                    }

                }

            // end is_user_logged_in if
            } else {
                $property_id = apply_filters('houzez_submit_listing', $new_property);
                $args = array(
                    'listing_title'  =>  get_the_title($property_id),
                    'listing_id'     =>  $property_id
                );

                /*
                 * Send email
                 * */
                houzez_email_type( $user_email, 'free_submission_listing', $args);
                houzez_email_type( $admin_email, 'admin_free_submission_listing', $args);

                if (houzez_user_has_membership($userID)) {
                    wp_redirect($thankyou_page_link);
                } // end membership check
            }

        // End membership else if
        } else {

            if ( !is_user_logged_in() ) {
                $email = wp_kses( $_POST['user_email'], $allowed_html );
                if( email_exists( $email ) ) {
                    $errors[] = $houzez_local['email_already_registerd'];
                }

                if( !is_email( $email ) ) {
                    $errors[] = $houzez_local['invalid_email'];
                }

                if( empty($errors) ) {
                    $username = explode("@", $email);

                    $username = $username[0];

                    $random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
                    $user_id = wp_create_user( $username, $random_password, $email );

                    $user = get_user_by('login', $username );
                    if( $user_id ) {

                        houzez_update_profile( $user_id );
                        houzez_wp_new_user_notification( $user_id, $random_password );
                        $user_as_agent = houzez_option('user_as_agent');
                        if( $user_as_agent == 'yes' ) {
                            houzez_register_as_agent ( $username, $email, $user_id );
                        }

                        if( !is_wp_error($user) ) {
                            wp_clear_auth_cookie();
                            wp_set_current_user ( $user->ID );
                            wp_set_auth_cookie  ( $user->ID );

                            $property_id = apply_filters( 'houzez_submit_listing', $new_property );

                            $args = array(
                                'listing_title'  =>  get_the_title($property_id),
                                'listing_id'     =>  $property_id
                            );

                            /*
                             * Send email
                             * */
                            houzez_email_type( $user_email, 'free_submission_listing', $args);
                            houzez_email_type( $admin_email, 'admin_free_submission_listing', $args);

                            if (!empty($payment_page_link)) {
                                wp_redirect($thankyou_page_link);

                            } else {
                                if (!empty($dashboard_listings)) {
                                    $separator = (parse_url($dashboard_listings, PHP_URL_QUERY) == NULL) ? '?' : '&';
                                    $parameter = ($updated_successfully) ? '' : '';
                                    wp_redirect($dashboard_listings . $separator . $parameter);
                                }
                            }
                            exit();
                        }

                    }

                }

            } else {

                $property_id = apply_filters('houzez_submit_listing', $new_property);

                $args = array(
                    'listing_title'  =>  get_the_title($property_id),
                    'listing_id'     =>  $property_id
                );

                /*
                 * Send email
                 * */
                houzez_email_type( $user_email, 'free_submission_listing', $args);
                houzez_email_type( $admin_email, 'admin_free_submission_listing', $args);
                wp_redirect($thankyou_page_link);
            }
        }

    }// end verify nonce
}


get_header(); ?>

<div class="membership-page-top">
    <?php get_template_part('template-parts/create-listing-top'); ?>
</div>

<div class="membership-content-area">

    <?php
    if( !empty($errors) ) {
        foreach ($errors as $error ) {
            echo esc_attr( $error );
        }
    }
    if (is_plugin_active('houzez-theme-functionality/houzez-theme-functionality.php')) {
        if (isset($_GET['edit_property']) && !empty($_GET['edit_property'])) {

            get_template_part('template-parts/property-edit');

        } else {

            get_template_part('template-parts/property-submit');

        } /* end of add/edit property*/
    } else {
        echo $houzez_local['houzez_plugin_required'];
    }
    ?>

</div>

<?php get_footer();?>
