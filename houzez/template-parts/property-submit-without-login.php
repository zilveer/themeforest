<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 06/10/15
 * Time: 4:12 PM
 */
global $current_user, $hide_add_prop_fields, $required_fields;
?>
<form id="submit_property_form" name="new_post" method="post" action="" enctype="multipart/form-data" class="add-frontend-property">

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
        }

    }
    endif;

    ?>

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

    <div class="account-block text-right">
        <?php wp_nonce_field('submit_property_header_btn', 'property_header_btn_nonce'); ?>
        <input type="hidden" name="action" value="add_property"/>
        <input type="hidden" name="prop_featured" value="0"/>
        <input type="hidden" name="prop_payment" value="not_paid"/>
        <button disabled="disabled" type="submit" id="add_new_property" class="btn btn-primary"><?php esc_html_e( 'Submit Property', 'houzez' ); ?></button>
    </div>

</form>

