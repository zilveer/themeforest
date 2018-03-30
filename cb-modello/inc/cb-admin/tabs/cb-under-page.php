<?php
/**
 * Created by PhpStorm.
 * User: cb-theme
 * Date: 23.10.13
 * Time: 18:52
 */
add_action( 'wp_ajax_nopriv_save_cb_under', 'save_cb_under' );
add_action( 'wp_ajax_save_cb_under', 'save_cb_under' );


function save_cb_under() {
    check_ajax_referer('cb-modello', 'security');
    $data = $_POST;
    unset($data['security'], $data['action']);
    $response = '1';
    update_option('cb5_under', esc_attr($data['cb5_under']));

    update_option('cb5_under_start', esc_attr($data['cb5_under_start']));
    update_option('cb5_under_bg', esc_attr($data['cb5_under_bg']));
    update_option('cb5_under_bg_image', esc_attr($data['cb5_under_bg_image']));

    update_option('cb5_under_mailchimp', esc_attr($data['cb5_under_mailchimp']));
    update_option('cb5_under_tint', esc_attr($data['cb5_under_tint']));

    die($response);
}

function show_cb_under_page(){
?>
        <h3>Maintenance Mode</h3>
        <div class="tab_desc">Enable and setup Maintenance Mode</div>
        

<form method="post" class="cb-admin-form">
    <!-- Maintenance Mode SECTION START -->
    <div class="pd5">
        <?php echo generate_hint('Shows under construction page'); ?>
        <?php generate_check(__('Maintenance Mode?', 'cb-modello'), get_option('cb5_under'), 'cb5_under'); ?>

    </div>


        <div class="pd5">
            <label for="cb5_under_start"><?php _e('Start page date', 'cb-modello'); ?></label>
            <input type="text" name="cb5_under_start" id="cb5_under_start"
                   value="<?php echo get_option('cb5_under_start'); ?>"/>


        </div>

        <div class="pd5">
            <?php generate_select(__('Tint', 'cb-modello'), get_option('cb5_under_tint'), array(
                array('no', __('no', 'cb-modello')),
                array('skin', __('skin', 'cb-modello')),
                array('bdark', __('black dark', 'cb-modello')),
                array('blight', __('black light', 'cb-modello')),
                array('wdark', __('white dark', 'cb-modello')),
                array('wlight', __('white light', 'cb-modello')),
                array('tblack', __('top black shadow', 'cb-modello')),
                array('twhite', __('top white shadow', 'cb-modello'))), 'cb5_under_tint');?>
        </div>


        <div class="pd5"><label for="cb5_under_bg"><?php _e('Background color', 'cb-modello'); ?></label>
            <input type="text" name="cb5_under_bg" id="cb5_under_bg" class="color"
                   value="<?php echo get_option('cb5_under_bg'); ?>"/></div>
    <?php $cb5_under_bg_image = get_option('cb5_under_bg_image'); ?>
    <div class="pd5">
        <?php echo generate_hint('Enter an URL or upload background image'); ?>
        <label for="cb5_under_bg_image"><?php _e('Image', 'cb-modello'); ?></label>
        <input id="cb5_under_bg_image" type="text" name="cb5_under_bg_image" class="upurl input-upload"
               value="<?php echo $cb5_under_bg_image; ?>"/><input class="upload_button2" type="button" value="Upload"/>
    </div>

        <input type="hidden" name="cb5_under_mailchimp" value="<?php echo get_option('cb5_under_mailchimp'); ?>"/>
        <?php
        if (get_option('cb5_mailchimp_key') != "") {
            if (!class_exists('MailChimp')) require_once(get_template_directory() . '/inc/cb-lib/mailchimp-api-master/MailChimp.class.php');
            $MailChimp = new MailChimp(get_option('cb5_mailchimp_key'));
            $list = $MailChimp->call('lists/list');
            if (isset($list['status']) && $list['status'] == 'error') {
                echo '<div id="message" class="error"><p><strong>' . $list['name'] . '</strong> ' . $list['error'] . '<hr>' . __('"General Settings" tab, "MailChimp settings" section', 'cb-modello') . '</p></div>';

            } else {

                ?>

                <div class="pd5"><label for="cb5_under_mailchimp"><?php _e('MailChimp list', 'cb-modello'); ?></label>
                    <?php
                    if ($list['total'] > 0) {
                        ?>
                        <select name="cb5_under_mailchimp" id="cb5_under_mailchimp">
                            <option value="">select list</option>
                            <?php
                            foreach ($list['data'] as $lista) {
                                if (get_option('cb5_under_mailchimp') == $lista['id'])
                                    echo '<option value="' . $lista['id'] . '" selected>' . $lista['name'] . '</option>';
                                else
                                    echo '<option value="' . $lista['id'] . '">' . $lista['name'] . '</option>';
                            }
                            ?>

                        </select>
                    <?php
                    } else {
                        echo '<span>No lists added</span>';
                    }
                    ?>
                </div>
            <?php
            }
        }
        ?>


       
    <!-- ## Maintenance Mode SECTION END ## -->

    <input type="hidden" name="tab" class="cb-tab" value="cb-under-page" />
    <input type="hidden" name="action" value="save_cb_under" />
    <input type="hidden" name="security" value="<?php echo wp_create_nonce('cb-modello'); ?>" />

    <div class="cb-submit-button"><input type="submit" value="<?php _e('Save settings', 'cb-modello');?>" class="cb-save" ></div>
</form>
<?php
}