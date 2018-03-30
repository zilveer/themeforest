<?php
/**
 * Created by PhpStorm.
 * User: cb-theme
 * Date: 23.10.13
 * Time: 18:53
 */
add_action('wp_ajax_nopriv_save_cb_recaptcha', 'save_cb_recaptcha');
add_action('wp_ajax_save_cb_recaptcha', 'save_cb_recaptcha');


function save_cb_recaptcha()
{
    check_ajax_referer('cb-modello', 'security');
    $data = $_POST;
    unset($data['security'], $data['action']);
    $response = '1';
    update_option('cb5_r_use', esc_attr($data['cb5_r_use']));
    update_option('cb5_r_public', esc_attr($data['cb5_r_public']));
    update_option('cb5_r_private', esc_attr($data['cb5_r_private']));
    update_option('cb5_r_template', esc_attr($data['cb5_r_template']));
    die($response);
}

function show_cb_recaptcha_page()
{
?>

<form method="post" class="cb-admin-form">

    <!-- RECAPTCHA SECTION START-->

        <div class="pd5" style="border-top:none;">
            <?php generate_select(__('Use reCAPTCHA ?', 'cb-modello'), get_option('cb5_r_use'), array(
                array('no', __('no', 'cb-modello')),
                array('yes', __('yes', 'cb-modello'))), 'cb5_r_use'); ?>
         <div><?php _e('Get reCAPTCHA keys from','cb-modello'); ?> <a href="http://www.google.com/recaptcha" target="_blank"><?php _e('here','cb-modello'); ?></a></div></div>

        <div class="pd5"><label for="cb5_r_public"><?php _e('reCAPTCHA public key','cb-modello'); ?></label>
            <input type="text" name="cb5_r_public" id="cb5_r_public" style="width:250px;" value="<?php echo get_option('cb5_r_public');?>"/></div>

        <div class="pd5"><label for="cb5_r_private"><?php _e('reCAPTCHA private key','cb-modello'); ?></label>
            <input type="text" name="cb5_r_private" id="cb5_r_private" style="width:250px;" value="<?php echo get_option('cb5_r_private');?>"/></div>

        <div class="pd5">
            <?php generate_select(__('reCAPTCHA template', 'cb-modello'), get_option('cb5_r_template'), array(
                array('white', __('white', 'cb-modello')),
                array('red', __('red', 'cb-modello')),
                array('clean', __('clean', 'cb-modello')),
                array('blackglass', __('blackglass', 'cb-modello')),
                array('red', __('red', 'cb-modello'))), 'cb5_r_template'); ?>
        </div>

    <!-- ## RECAPTCHA SECTION END ##-->

    <input type="hidden" name="tab" class="cb-tab" value="cb-recaptcha-page"/>
    <input type="hidden" name="action" value="save_cb_recaptcha"/>
    <input type="hidden" name="security" value="<?php echo wp_create_nonce('cb-modello'); ?>"/>

    <div class="cb-submit-button"><input type="submit" value="<?php _e('Save settings', 'cb-modello'); ?>"
                                         class="button-primary btn" style="padding: 0 5px!important;"></div>
</form>
<?php
}