<?php
/**
 * Created by PhpStorm.
 * User: cb-theme
 * Date: 23.10.13
 * Time: 18:52
 */
add_action( 'wp_ajax_nopriv_save_cb_footer', 'save_cb_footer' );
add_action( 'wp_ajax_save_cb_footer', 'save_cb_footer' );


function save_cb_footer() {
    check_ajax_referer('cb-modello', 'security');
    $data = $_POST;
    unset($data['security'], $data['action']);
    $response = '1';
    if (get_option('cb5_footer_upload_logo') != esc_attr($data['cb5_footer_upload_logo']))
        $response = '3';
    update_option('cb5_footer_upload_logo', esc_attr($data['cb5_footer_upload_logo']));
    update_option('cb5_fcols', esc_attr($data['cb5_fcols']));
    update_option('cb5_fstyle', esc_attr($data['cb5_fstyle']));
    update_option('cb5_fc', esc_attr($data['cb5_fc']));
    update_option('cb5_footer_logo', esc_attr($data['cb5_footer_logo']));

    die($response);
}

function show_cb_footer_page(){
?>
        <h3>Footer Settings</h3>
        <div class="tab_desc">Style and Columns</div>
        

<form method="post" class="cb-admin-form">
    <!-- FOOTER SECTION START -->
    <?php $footer_upload_logo = get_option('cb5_footer_upload_logo'); ?>
    <div class="pd5" style="border-top:none;">
        <?php echo generate_hint('Enter an URL or upload custom footer logo'); ?>
        <label for="cb5_footer_upload_logo"><?php _e('Footer Logo', 'cb-modello'); ?></label>
        <input id="cb5_footer_upload_logo" type="text" name="cb5_footer_upload_logo" class="upurl input-upload"
               value="<?php echo $footer_upload_logo; ?>"/><input class="upload_button2" type="button" value="Upload"/>
    </div>
    <div class="pd5" id="footer_general_logo">
        <?php if ($footer_upload_logo != '') {
            if (!function_exists('bfi_thumb'))
                require_once(get_template_directory() . '/inc/cb-lib/bfithumb.php');
            echo '<label class="info">Current footer logo:</label><a href="' . $footer_upload_logo . '" target="_blank">
                <img class="sele" src="' . bfi_thumb($footer_upload_logo, array('width' => 145, 'crop' => true)) . '" align="absmiddle" alt="logo" /></a>';
        } ?>
    </div>
        <div class="pd5" style="border-top:none;">
            <?php generate_select(__('Footer columns', 'cb-modello'),get_option('cb5_fcols'), array(
                array('1', __('1', 'cb-modello')),
                array('2', __('2', 'cb-modello')),
                array('3', __('3', 'cb-modello')),
                array('4', __('4', 'cb-modello'))), 'cb5_fcols');?>
        </div>
    <div class="pd5">
        <?php generate_select(__('Show Footer small logo', 'cb-modello'), get_option('cb5_footer_logo'), array(
            array('yes', __('yes', 'cb-modello')),
            array('no', __('no', 'cb-modello'))
        ), 'cb5_footer_logo');?>
    </div>

       
    <!-- ## FOOTER SECTION END ## -->

    <input type="hidden" name="tab" class="cb-tab" value="cb-footer-page" />
    <input type="hidden" name="action" value="save_cb_footer" />
    <input type="hidden" name="security" value="<?php echo wp_create_nonce('cb-modello'); ?>" />

    <div class="cb-submit-button"><input type="submit" value="<?php _e('Save settings', 'cb-modello');?>" class="cb-save" ></div>
</form>
<?php
}