<?php

if (!defined('TFUSE'))
    exit('Direct access forbidden.');

class TF_MOJAX extends TF_TFUSE {

    public $_the_class_name = 'MOJAX';

    public function __construct() {
        parent::__construct();
    }

    /**
     * @ajax
     */
    public function ajax_admin_save_options()
    {
        if (!tf_current_user_can(array('manage_options'), false))
            die('Access denied');

        // check security with nonce.
        check_ajax_referer('tfuse_framework_save_options', '_ajax_nonce');

        $tfuse_framework_options = array();

        $post_options   = $this->request->isset_POST('options') ? ($this->request->POST('options')) : '';
        $unserialized   = json_decode($post_options);
        $values         = get_object_vars($unserialized);
        $admin_options  = $this->get->options('admin');
        $admin_options  = tf_only_options($admin_options);

        $do_refresh = FALSE;

        foreach ($admin_options as $option_id => $option) {
            if (isset($option['on_update']) && $option['on_update'] == 'reload_page') {
                if ((!isset($values[$option_id]) && $this->get->option('admin', $option_id) == 'true') || isset($values[$option_id]) && $this->get->option('admin', $option_id) != $values[$option_id])
                    $do_refresh = TRUE;
            }
            if ($this->optisave->has_method("admin_{$option['type']}")) {
                $this->optisave->{"admin_{$option['type']}"}($option, $values, $tfuse_framework_options);
            } else {
                $this->optisave->admin_text($option, $values, $tfuse_framework_options);
            }
        }
        update_option(TF_THEME_PREFIX . '_tfuse_framework_options', $tfuse_framework_options);
        do_action('tfuse_admin_save_options', $values);
        if ($do_refresh)
            $this->ajax->out_json['reload_page'] = TRUE;
        $this->ajax->ajax_finish();
    }

    public function ajax_admin_reset_options() {
        if (!wp_verify_nonce($this->request->POST('_ajax_nonce'), 'tfuse_framework_reset_options'))
            die('Wrong nonce.');
        delete_option(TF_THEME_PREFIX . '_tfuse_framework_options');
    }

}
