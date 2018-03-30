<?php
if (!defined('TFUSE'))
    exit('Direct access forbidden.');


class TF_RESERVATIONFORM_MODEL extends TF_TFUSE
{
    public $wp_option_general;

    function __construct()
    {
        parent::__construct();
        $this->wp_option_general = TF_THEME_PREFIX . '_tfuse_reservation_form_general';
    }

    function get_forms_gen_options()
    {

        return get_option($this->wp_option_general);
    }

    function save_form_gen_options($form_fields)
    {
        return update_option($this->wp_option_general, $form_fields);
    }
}