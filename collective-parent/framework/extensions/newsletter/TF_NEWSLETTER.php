<?php

if (!defined('TFUSE'))
    exit('Direct access forbidden.');

class TF_NEWSLETTER extends TF_TFUSE {

    public $_standalone = TRUE;
    public $_the_class_name = 'NEWSLETTER';
    public $valid_services = array('none', 'mailchimp', 'campaignmonitor');

    function __construct()
    {
        parent::__construct();
    }

    function __init()
    {
        if (is_admin())
            $this->add_static();
        else
            $this->add_static_clientside();

        $this->ajax->_add_action('tfuse_ajax_newsletter', $this);

        add_action('admin_menu', array($this, 'add_menu'), 20);
    }

    function add_static()
    {
        $this->include->register_type('ext_newsletter_css', TFUSE_EXT_DIR . '/' . strtolower($this->_the_class_name) . '/static/css');
        $this->include->register_type('ext_newsletter_js', TFUSE_EXT_DIR . '/' . strtolower($this->_the_class_name) . '/static/js');
        $this->include->css('newsletter', 'ext_newsletter_css');
        $this->include->js('newsletter', 'ext_newsletter_js', 'tf_footer');
    }

    function add_static_clientside()
    {
        add_action('init', array($this, 'init_action'));

        $this->include->register_type('ext_newsletter_css', TFUSE_EXT_DIR . '/' . strtolower($this->_the_class_name) . '/static/css');
        $this->include->register_type('ext_newsletter_js', TFUSE_EXT_DIR . '/' . strtolower($this->_the_class_name) . '/static/js');
        $this->include->css('newsletter_clientside', 'ext_newsletter_css');
        $this->include->js('newsletter_clientside', 'ext_newsletter_js', 'tf_footer');
    }

    public function init_action()
    {
        wp_enqueue_script('jquery');
    }

    function add_menu() {
        add_submenu_page('themefuse', __('Newsletter Settings', 'tfuse'), __('Newsletter', 'tfuse'), 'manage_options', 'tf_newsletter', array($this, 'display'));
    }

    function common_html() {
        echo '<div id="tfuse_fields" class="wrap">';
        $this->interface->page_header_info();
    }

    function end_footer() {
        echo '</div>';
    }

    function display() {
        $newsletter_service = $this->model->get_service();
        $this->common_html();
        $this->load->ext_view($this->_the_class_name, 'newsletter_service', array(
            'newsletter_service' => $newsletter_service,
            'mc_key' => $this->model->get_mc_key(),
            'cm_key' => $this->model->get_cm_key()
        ));
        if (!in_array($this->model->get_service(), array('none'))) {
            $this->{$newsletter_service}();
        }
        $this->end_footer();
    }

    function mailchimp() {
        $lists = array();
        if ($this->mc_api) {
            $lists = $this->mc_api->lists();
            $tmp = $lists['data'];
            $lists = array();
            foreach ($tmp as $list) {
                $lists[$list['id']] = $list['name'];
            }
        }
        $this->load->ext_view($this->_the_class_name, 'mailchimp_settings', array('mc_key' => $this->model->get_mc_key(), 'mc_list_id' => $this->model->get_mc_list(), 'lists' => $lists));
        $this->include->js_enq('newsletter_service', 'mailchimp');
        $this->include->js_enq('newsletter_service_name', __('MailChimp', 'tfuse'));
    }

    function campaignmonitor() {
        $lists = $clients = array();
        if ($this->cm_general) {
            $clients = $this->cm_general->get_clients();
            $tmp = $clients->response;
            $clients = array();
            foreach ($tmp as $client) {
                $clients[$client->ClientID] = $client->Name;
            }
        }
        if ($this->cm_clients) {
            $lists = $this->cm_clients->set_client_id($this->model->get_cm_client())->get_lists();
            if ($lists->http_status_code == 200) {
                $tmp = $lists->response;
                $lists = array();
                foreach ($tmp as $list) {
                    $lists[$list->ListID] = $list->Name;
                }
            }
        }
        $this->load->ext_view($this->_the_class_name, 'campaignmonitor_settings', array('cm_key' => $this->model->get_cm_key(), 'cm_client_id' => $this->model->get_cm_client(),
            'cm_list_id' => $this->model->get_cm_list(), 'clients' => $clients, 'lists' => $lists));
        $this->include->js_enq('newsletter_service', 'campaignmonitor');
        $this->include->js_enq('newsletter_service_name', __('CampaignMonitor', 'tfuse'));
    }

    #ajax functions

    /**
     * @ajax
     */
    function tfuse_ajax_newsletter_save_api_key() {
        tf_can_ajax();
        $ret = $this->tfuse_ajax_newsletter_save_service();
        if ($ret !== 1)
            tfjecho($ret);
        if ($this->request->POST('service') != 'none') {
            $this->{'tfuse_ajax_newsletter_save_' . strtolower($this->request->POST('service')) . '_api_key'}();
        }
        else
            tfjecho(array('status' => 1));
    }

    function tfuse_ajax_newsletter_save_mailchimp_api_key() {
        #MailChimp
        tf_can_ajax();
        require_once(dirname(__FILE__) . '/library/MCAPI.class.php');
        $api_key = $this->request->POST('api_key');
        $api = new MCAPI($api_key);
        $api->ping();
        if ($api->errorCode)
            tfjecho(array('status' => -1, 'message' => __('API key is invalid.', 'tfuse')));
        else {
            $this->model->set_mc_key($api_key);
            tfjecho(array('status' => 1));
        }
        die();
    }

    function tfuse_ajax_newsletter_save_campaignmonitor_api_key() {
        #CampaignMonitor
        tf_can_ajax();
        require_once(dirname(__FILE__) . '/library/csrest_general.php');
        $api_key = $this->request->POST('api_key');
        $api = new CS_REST_General($api_key);
        $result = $api->get_clients();
        if ($result->http_status_code == 401)
            tfjecho(array('status' => -1, 'message' => __('API key is invalid.', 'tfuse')));
        else {
            $this->model->set_cm_key($api_key);
            tfjecho(array('status' => 1));
        }
        die();
    }

    /**
     * @ajax
     */
    function tfuse_ajax_newsletter_save_campaignmonitor_client() {
        #CampaignMonitor
        tf_can_ajax();
        if ($this->cm_clients) {
            $client = $this->cm_clients->set_client_id($this->request->POST('client_id'))->get();
            if ($client->http_status_code == 200) {
                $this->model->set_cm_client($this->request->POST('client_id'));
                tfjecho(array('status' => 1));
            } else {
                tfjecho(array('status' => -1, 'message' => __('Invalid client ID or somethinf else went wrong.', 'tfuse')));
            }
        }
        else
            tfjecho(array('status' => -1, 'message' => __('Could not connect to the CampaignMonitor API service.', 'tfuse')));
        die();
    }

    /**
     * @ajax
     */
    function tfuse_ajax_newsletter_save_mailchimp_list() {
        #MailChimp
        tf_can_ajax();
        if ($this->mc_api) {
            $list = $this->mc_api->lists(array('list_id' => $this->request->POST('list_id')));
            if (!$this->mc_api->errorCode) {
                $this->model->set_mc_list($this->request->POST('list_id'));
                tfjecho(array('status' => 1));
            } else {
                tfjecho(array('status' => -1, 'message' => __('Invalid list ID or somethin else went wrong.', 'tfuse')));
            }
        }
        else
            tfjecho(array('status' => -1, 'message' => __('Could not connect to the MailChimp API service.', 'tfuse')));
        die();
    }

    /**
     * @ajax
     */
    function tfuse_ajax_newsletter_save_campaignmonitor_list() {
        #CampaignMonitor
        tf_can_ajax();
        if ($this->cm_lists) {
            $list = $this->cm_lists->set_list_id($this->request->POST('list_id'))->get();
            if ($list->http_status_code == 200) {
                $this->model->set_cm_list($this->request->POST('list_id'));
                tfjecho(array('status' => 1));
            } else {
                tfjecho(array('status' => -1, 'message' => __('Invalid list ID or somethin else went wrong.', 'tfuse')));
            }
        }
        else
            tfjecho(array('status' => -1, 'message' => __('Could not connect to the CampaignMonitor API service.', 'tfuse')));
        die();
    }

    /**
     * @ajax
     */
    function tfuse_ajax_newsletter_fetch_emails_subscribed_mailchimp() {
        #MailChimp
        tf_can_ajax();
        if ($this->mc_api) {
            $list_id = $this->model->get_mc_list();
            if (!$list_id)
                tfjecho(array('status' => -1, 'message' => __('List ID is not set. Please select your list ID.', 'tfuse')));
            $api_key = explode('-', $this->model->get_mc_key());
            $dc = $api_key[1];
            $api_key = $api_key[0];
            $data = file_get_contents('http://' . $dc . '.api.mailchimp.com/export/1.0/list?output=php&apikey=' . $api_key . '&id=' . $this->model->get_mc_list() . '&status=subscribed');
            $data = array_filter(explode("\n", $data));
            $out = '';
            for ($i = 1; $i < count($data); $i++) {
                $member = json_decode($data[$i]);
                $out.=$member[0] . ',';
            }
            $out = rtrim($out, ',');
            tfjecho(array('status' => 1, 'count' => (count($data) - 1), 'emails' => $out));
        }
        else
            tfjecho(array('status' => -1, 'message' => __('Could not connect to the MailChimp API service.', 'tfuse')));
        die();
    }

    /**
     * @ajax
     */
    function tfuse_ajax_newsletter_fetch_emails_subscribed_campaignmonitor() {
        #CampaignMonitor
        tf_can_ajax();
        if ($this->cm_lists) {
            $list_id = $this->model->get_cm_list();
            if (!$list_id)
                tfjecho(array('status' => -1, 'message' => __('List ID is not set. Please select your list ID.', 'tfuse')));
            $current_page = 1;
            $out = '';
            do {
                $members = $this->cm_lists->set_list_id($list_id)->get_active_subscribers(date('Y-m-d', strtotime('-30 years')), $current_page++);
                if ($members->http_status_code != 200)
                    tfjecho(array('status' => -1, 'message' => __('Could not fetch subscribed members list. Check your API key.', 'tfuse')));
                foreach ($members->response->Results as $member) {
                    $out.=$member->EmailAddress . ',';
                }
            } while (($members->response->PageNumber - 1) < $members->response->NumberOfPages);
            $out = rtrim($out, ',');
            tfjecho(array('status' => 1, 'count' => $members->response->TotalNumberOfRecords, 'emails' => $out));
        }
        else
            tfjecho(array('status' => -1, 'message' => __('Could not connect to the MailChimp API service.', 'tfuse')));
        die();
    }

    /**
     * @ajax
     */
    function tfuse_ajax_newsletter_save_email() {
        $newsletter_service = $this->model->get_service();
        if (!$newsletter_service || $newsletter_service == 'none') {
            tfjecho(array('status' => -1, 'message' => __('Newsletter service not configured.', 'tfuse')));
        }
        if (!is_email($this->request->POST('email')))
            tfjecho(array('status' => -2, 'message' => __('Invalid email provided.', 'tfuse')));
        if (!method_exists($this, 'save_email_' . $newsletter_service))
            tfjecho(array('status' => -1, __('Save function not defined for ', 'tfuse') . $newsletter_service . ' newsletter service.'));
        if ($this->{'save_email_' . $newsletter_service}($this->request->POST('email')))
            tfjecho(array('status' => 1));
        else
            tfjecho(array('status' => -1, 'message' => __('Could not save this email with the newsletter service.', 'tfuse')));
        die();
    }

    function tfuse_ajax_newsletter_save_service() {
        tf_can_ajax();
        if ($this->request->POST('service') == '')
            return(array('status' => -1, 'message' => __('No newsletter service provided.', 'tfuse')));
        if (!in_array($this->request->POST('service'), $this->valid_services))
            return(array('status' => -1, 'message' => __('Invalid Service Provided.', 'tfuse')));
        $this->model->set_service($this->request->POST('service'));
        return 1;
    }

    #/ajax functions
    #email saving functions

    protected function save_email_mailchimp($email) {
        #MailChimp
        if ($this->mc_api) {
            $list_id = $this->model->get_mc_list();
            if (!$list_id)
                return FALSE;
            $merges = array();
            if ($this->request->POST('name') != '')
                $merges['FNAME'] = $this->request->POST('name');
            $saved = $this->mc_api->listSubscribe($list_id, $email, $merges);
            if ($saved)
                return TRUE;
            return FALSE;
        }
    }

    protected function save_email_campaignmonitor($email) {
        #CampaignMonitor
        if ($this->cm_subscribers) {
            $list_id = $this->model->get_cm_list();
            if (!$list_id)
                return FALSE;
            $merges = array('EmailAddress' => $email);
            if ($this->request->POST('name') != '')
                $merges['Name'] = $this->request->POST('name');
            $saved = $this->cm_subscribers->set_list_id($list_id)->add($merges);
            if ($saved->was_successful())
                return TRUE;
            return FALSE;
        }
    }

    #/email saving functions

    function __get($name) {
        if ($name == 'mc_api') {
            require_once(dirname(__FILE__) . '/library/MCAPI.class.php');
            $api_key = $this->model->get_mc_key();
            if (!$api_key)
                return NULL;
            $this->mc_api = new MCAPI($api_key);
            return $this->mc_api;
        }

        if ($name == 'cm_general') {
            require_once(dirname(__FILE__) . '/library/csrest_general.php');
            $api_key = $this->model->get_cm_key();
            if (!$api_key)
                return NULL;
            $this->cm_general = new CS_REST_General($api_key);
            return $this->cm_general;
        }

        if (in_array(strtolower($name), array('cm_clients', 'cm_lists', 'cm_subscribers'))) {
            $lib = str_replace('cm_', '', strtolower($name));
            require_once(dirname(__FILE__) . '/library/csrest_' . $lib . '.php');
            $api_key = $this->model->get_cm_key();
            if (!$api_key)
                return NULL;
            $class_name = 'CS_REST_' . ucfirst($lib);
            $this->{'cm_' . $lib} = new $class_name('', $api_key);
            return $this->{'cm_' . $lib};
        }

        return parent::__get($name);
    }

}
