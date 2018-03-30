<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 06/10/15
 * Time: 4:12 PM
 */

global $current_user, $hide_add_prop_fields, $required_fields;

wp_get_current_user();
$userID = $current_user->ID;

$enable_paid_submission = houzez_option('enable_paid_submission');
$remaining_listings = houzez_get_remaining_listings( $userID );
$select_packages_link = houzez_get_template_link('template/template-packages.php');

if( is_page_template( 'template/submit_property.php' ) ) {

        if ($enable_paid_submission == 'membership' && $remaining_listings != -1 && $remaining_listings < 1 && is_user_logged_in() ) {
            if (!houzez_user_has_membership($userID)) {
                print '<div class="user_package_status">
                    <h4>' . esc_html__('You don\'t have any package! You need to buy your package.', 'houzez') . '</h4>
                    <a href="' . $select_packages_link . '">' . esc_html__('Get Package', 'houzez') . '</a>
                    </div>';
            } else {
                print '<div class="user_package_status"><h4>' . esc_html__('Your current package doesn\'t let you publish more properties! You need to upgrade your membership.', 'houzez') . '</h4>
            <a href="' . $select_packages_link . '">' . esc_html__('Upgrade Package', 'houzez') . '</a>
            </div>';
            }
        } else { ?>

        <form id="submit_property_form" name="new_post" method="post" action="#" enctype="multipart/form-data"
              class="add-frontend-property">

            <?php if ( !is_user_logged_in() ) { ?>
            <div class="account-block">
                <div class="add-title-tab">
                    <h3><?php esc_html_e( 'Do you have an account?', 'houzez' ); ?></h3>
                    <div class="add-expand"></div>
                </div>
                <div class="add-tab-content">
                    <div class="add-tab-row push-padding-bottom">
                        <div class="row">
                            <div class="col-sm-12">
                                <p><?php _e( "If you don't have an account you can create one below by entering your email address. Your account details will be confirmed via email. Otherwise you can <a href='#'' data-toggle='modal' data-target='#pop-login'>login here</a>", 'houzez' ); ?></p>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="prop_title"><?php esc_html_e('Email Address', 'houzez'); ?>* </label>
                                    <input type="text" id="user_email" class="form-control" name="user_email" placeholder="<?php esc_html_e( 'Enter your email address', 'houzez' ); ?>">
                                    <span id="email_messages"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>

            <?php
            $layout = houzez_option('property_form_sections');
            $layout = $layout['enabled'];

            if ($layout): foreach ($layout as $key=>$value) {

                switch($key) {

                    case 'description-price':
                        get_template_part('template-parts/submit-property/description-price');
                        break;

                    case 'media':
                        get_template_part('template-parts/submit-property/media');
                        break;

                    case 'details':
                        get_template_part('template-parts/submit-property/details');
                        break;

                    case 'features':
                        get_template_part('template-parts/submit-property/features');
                        break;

                    case 'location':
                        get_template_part('template-parts/submit-property/location');
                        break;

                    case 'floorplans':
                        get_template_part('template-parts/submit-property/floorplans');
                        break;

                    case 'multi-units':
                        get_template_part('template-parts/submit-property/multi-units');
                        break;

                    case 'agent_info':
                        get_template_part('template-parts/submit-property/agent-info');
                        break;
                }

            }
            endif;
            ?>

            <div class="account-block text-right">
                <?php wp_nonce_field('submit_property', 'property_nonce'); ?>
                <input type="hidden" name="action" value="add_property"/>
                <input type="hidden" name="prop_featured" value="0"/>
                <!--<input type="hidden" name="prop_agent_display_option" value="author_info"/>-->
                <input type="hidden" name="prop_payment" value="not_paid"/>
                <?php if ( !is_user_logged_in() ) { ?>
                    <input type="hidden" name="user_submit_has_no_membership" value="yes"/>
                <?php } ?>
                <button <?php if ( !is_user_logged_in() ) { ?> disabled="disabled" <?php } ?> type="submit" id="add_new_property"
                        class="btn btn-primary"><?php esc_html_e('Submit Property', 'houzez'); ?></button>
            </div>

        </form>

        <?php
    }
}

