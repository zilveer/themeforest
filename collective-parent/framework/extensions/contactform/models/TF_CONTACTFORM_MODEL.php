<?php
if (!defined('TFUSE'))
    exit('Direct access forbidden.');


class TF_CONTACTFORM_MODEL extends TF_TFUSE {

    public $wp_option;
    public $wp_option_general;

    function __construct(){
        parent::__construct();
        $this->wp_option = TF_THEME_PREFIX . '_tfuse_contact_forms';
        $this->wp_option_general = TF_THEME_PREFIX . '_tfuse_contact_form_general';
    }

    function get_forms(){
       return get_option($this->wp_option);
    }

    function get_form($id){
        $forms = $this->get_forms();
        return $forms[$id];
    }

    function save_form($form_fields){
        return update_option($this->wp_option,$form_fields);
    }

    function get_forms_gen_options(){
        return get_option($this->wp_option_general);
    }

    function save_form_gen_options($form_fields){
        return update_option($this->wp_option_general,$form_fields);
    }
}