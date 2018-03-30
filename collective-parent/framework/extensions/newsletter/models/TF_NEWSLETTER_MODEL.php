<?php

if (!defined('TFUSE'))
    exit('Direct access forbidden.');

/**
 * Description of TF_SLIDER_MODEL
 *
 */
class TF_NEWSLETTER_MODEL extends TF_TFUSE {

    public $_the_class_name = 'NEWSLETTER_MODEL';
    public $_ext_name = 'NEWSLETTER';
    public $_standalone = TRUE;
    protected $mc_key;
    protected $cm_key;
    protected $mc_list_id;
    public $wp_option;

    function __construct() {
        parent::__construct();
        $this->wp_option = TF_THEME_PREFIX . '_tfuse_newsletter';
    }

    function set_mc_key($api_key) {
        #MailChimp
        $db = (array) get_option($this->wp_option);
        if (isset($db['mc_key']) && $db['mc_key'] != $api_key) {
            unset($db['mc_list_id']);
        }
        $db['mc_key'] = $api_key;
        update_option($this->wp_option, $db);
    }

    function get_mc_key() {
        #MailChimp
        if (!$this->mc_key) {
            $db = get_option($this->wp_option);
            $this->mc_key = isset($db['mc_key']) ? $db['mc_key'] : NULL;
        }
        return $this->mc_key;
    }

    function set_cm_key($api_key) {
        #CampaignMonitor
        $db = (array) get_option($this->wp_option);
        if (isset($db['cm_key']) && $db['cm_key'] != $api_key) {
            unset($db['cm_list_id'], $db['cm_client_id']);
        }
        $db['cm_key'] = $api_key;
        update_option($this->wp_option, $db);
    }

    function get_cm_key() {
        #CampaignMonitor
        if (!$this->cm_key) {
            $db = get_option($this->wp_option);
            $this->cm_key = isset($db['cm_key']) ? $db['cm_key'] : NULL;
        }
        return $this->cm_key;
    }

    function set_mc_list($list_id) {
        #MailChimp
        $db = (array) get_option($this->wp_option);
        $db['mc_list_id'] = $list_id;
        update_option($this->wp_option, $db);
    }

    function get_mc_list() {
        #MailChimp
        if (!$this->mc_list_id) {
            $db = get_option($this->wp_option);
            $this->mc_list_id = isset($db['mc_list_id']) ? $db['mc_list_id'] : NULL;
        }
        return $this->mc_list_id;
    }

    function set_cm_list($list_id) {
        #CampaignMonitor
        $db = (array) get_option($this->wp_option);
        $db['cm_list_id'] = $list_id;
        update_option($this->wp_option, $db);
    }

    function get_cm_list() {
        #CampaignMonitor
        if (!$this->cm_list_id) {
            $db = get_option($this->wp_option);
            $this->cm_list_id = isset($db['cm_list_id']) ? $db['cm_list_id'] : NULL;
        }
        return $this->cm_list_id;
    }

    function set_cm_client($client_id) {
        #CampaignMonitor
        $db = (array) get_option($this->wp_option);
        if (isset($db['cm_client_id']) && $db['cm_client_id'] != $client_id) {
            unset($db['cm_list_id']);
        }
        $db['cm_client_id'] = $client_id;
        update_option($this->wp_option, $db);
    }

    function get_cm_client() {
        #CampaignMonitor
        if (!$this->cm_client_id) {
            $db = get_option($this->wp_option);
            $this->cm_client_id = isset($db['cm_client_id']) ? $db['cm_client_id'] : NULL;
        }
        return $this->cm_client_id;
    }

    function set_service($service) {
        $db = (array) get_option($this->wp_option);
        $db['newsletter_service'] = $service;
        update_option($this->wp_option, $db);
    }

    function get_service() {
        $db = (array) get_option($this->wp_option);
        if (!isset($db['newsletter_service']))
            return 'none';
        else
            return $db['newsletter_service'];
    }

}
