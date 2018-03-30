<div id="tfuse_fields" class="wrap metabox-holder tfuse_fields">

    <?php $this->interface->page_header_info(); ?>
    <div style="clear:both;height:20px;">&nbsp</div>

    <form action="" method="post" id="tfuse_admin_options_form" enctype="multipart/form-data">

        <?php wp_nonce_field('closedpostboxes', 'closedpostboxesnonce', false) ?>
        <?php wp_nonce_field('meta-box-order', 'meta-box-order-nonce', false) ?>

        <?php wp_nonce_field('tfuse_framework_save_options') ?>
        <?php wp_nonce_field('tfuse_framework_reset_options') ?>
        <?php $_nonce = wp_create_nonce('tfuse_framework_save_options') ?>
        <input type="hidden" name="_ajax_nonce" value="<?php echo $_nonce; ?>" />

        <?php do_action('tfuse_framework_page'); ?>

        <p class="submit submit-footer">
            <input name="save" id="tfuse_submit_admin_form_button" type="submit" value="<?php _e('Save All Changes','tfuse'); ?>" class="button submit-button reset-button button-primary" />
            <input type="hidden" name="tfuse_save" value="save" />
        </p>

    </form>

    <form action="" method="post" id="tfuse_admin_options_form_reset">

        <?php wp_nonce_field('tfuse_framework_reset_options') ?>
        <?php $_nonce = wp_create_nonce('tfuse_framework_reset_options') ?>
        <input type="hidden" name="_ajax_nonce" value="<?php echo $_nonce; ?>" />

        <p class="submit submit-footer-reset">
            <input name="reset" id="tfuse_reset_admin_form_button" type="submit" value="<?php _e('Reset All Options', 'tfuse'); ?>" class="button submit-button reset-button" onclick="return confirm( '<?php print esc_attr( __('Click OK to reset all options. All settings will be lost!','tfuse') ); ?>' );" />
            <input type="hidden" name="tfuse_save" value="reset" />
        </p>
    </form>

</div>



<script type="text/javascript">
<?php

global $TFUSE;

if (!$TFUSE->request->empty_POST('tfuse_save') && $TFUSE->request->POST('tfuse_save') == 'reset') {
    ?>
        jQuery(document).ready(function($) {
            var reset_popup = jQuery('#tfuse-popup-reset');
            reset_popup.fadeIn().center();
            window.setTimeout(function(){
                reset_popup.fadeOut();
            }, 2000);
        });
    <?php
}
?>
</script>