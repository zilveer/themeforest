<?php if (!defined('TFUSE')) die(__('Direct access forbidden.', 'tfuse'));

/**
 * Send emails
 */
class TF_MAILER extends TF_TFUSE
{
    public $_standalone     = TRUE;
    public $_the_class_name = 'MAILER';

    /** @var bool Prevent add option multiple times to admin options (filter is called twice) */
    private $options_added = false;

    /** @var object Visibility rules for static (css, js) */
    public $visibilities;

    public function __construct()
    {
        parent::__construct();
    }

    public function __init()
    {
        // Do not load extension if no folder exists in theme_config/
        if (!$this->load->ext_file_exists($this->_the_class_name, '')) return;

        $this->add_filters();
        $this->add_static();
    }

    private function add_filters()
    {
        /** public */
        {
            add_filter('tfuse_send_email', array($this, 'filter_send_email'), 10, 2);
        }

        /** private */
        {
            add_filter('tfuse_options_filter', array($this, 'filter_options'), 45, 2);
        }
    }

    private function add_static()
    {
        if (!is_admin())
            return;

        $this->visibilities = (object)array(
            'tfuse_settings_page' => array(
                'only_screens' => array(
                    array(
                        'base' => 'toplevel_page_themefuse',
                        'id'   => 'toplevel_page_themefuse',
                        'parent_base' => 'themefuse',
                    ),
                )
            )
        );

        /** js */
        {
            $this->include->register_type('tfuse_mailer_js', TFUSE_EXT_DIR .'/'. strtolower($this->_the_class_name) .'/static/js');

            $this->include->js('backend___settings', 'tfuse_mailer_js', 'tf_head', 10, '', $this->visibilities->tfuse_settings_page);
        }
    }

    /**
     * Add email settings option to framework options
     */
    public function filter_options($options, $type)
    {
        if ($this->options_added || $type != 'admin')
            return $options;

        require 'options/admin_tab_options.php';
        /**
         * @var array $tab_options
         */

        $options['tabs'][] = $tab_options;

        $this->options_added = true;

        return $options;
    }

    /**
     * Send email
     */
    public function filter_send_email($result, $data)
    {
        $result = false;

        $requiredKeys = array(
            'to'      => true,
            'subject' => true,
            'message' => true
        );

        if (empty($data) || count(array_intersect_key($requiredKeys, $data)) !== count($requiredKeys)) {
            trigger_error('Invalid data for email', E_USER_WARNING);
        } else {
            $result = $this->send(
                $data['to'],
                $data['subject'],
                $data['message']
            );
        }

        return $result;
    }

    /**
     * Return correct config array for requested method or false
     */
    private function get_conf()
    {
        $conf = false;

        $method = trim(tfuse_options('mail__general__method'));
        if (!in_array($method, array('wpmail', 'smtp')))
            $method = 'wpmail';

        switch ($method) {
            case 'wpmail':
                $conf = array();
                break;
            case 'smtp':
                $conf = array(
                    'host'      => trim(tfuse_options('mail__smtp__host')),
                    'port'      => trim(tfuse_options('mail__smtp__port')),
                    'username'  => trim(tfuse_options('mail__smtp__username')),
                    'password'  => trim(tfuse_options('mail__smtp__password')),
                    'secure'    => in_array(tfuse_options('mail__smtp__secure'), array('ssl', 'tls')) ? tfuse_options('mail__smtp__secure') : '',
                );

                /** complete optional fields, fix some fields */
                {
                    if (!in_array($conf['secure'], array('ssl', 'tls')))
                        $conf['secure'] = false;

                    if (empty($conf['port']) || !is_numeric($conf['port'])) {
                        $conf['port'] = 25;

                        if ($conf['secure']) {
                            $conf['port'] = 465;
                        }
                    }
                }

                /** validate */
                do {
                    if (!tf_is_valid_domain_name($conf['host']))
                        break;

                    if (
                        empty($conf['username'])
                        || empty($conf['password'])
                    ) {
                        break;
                    }

                    /** $conf is correct */
                    {
                        break 2;
                    }
                } while(false);

                /** verification failed */
                {
                    $conf = false;
                }
                break;
        }

        /** add general settings */
        if ($conf !== false) {
            $conf = array_merge($conf, array(
                'from_address'  => trim(tfuse_options('mail__general__from_address')),
                'from_name'     => trim(tfuse_options('mail__general__from_name')),
            ));

            do {
                do {
                    if (!empty($conf['from_email']) && !is_email($conf['from_email']))
                        break;

                    /** $conf is correct */
                    {
                        $conf['_method'] = $method;

                        break 2;
                    }
                } while(false);

                /** verification failed */
                {
                    $conf = false;
                }
            } while(false);
        }

        return $conf;
    }

    /**
     * Send email
     */
    private function send($to, $subject, $message)
    {
        static $_wpmail_filter_added = false; // prevent add filter on every call

        $conf = $this->get_conf();

        $response = array(
            'status'  => 0,
            'message' => __('Cannot send email', 'tfuse')
        );

        if (!$conf) {
            $response['message'] = __('Invalid email configuration', 'tfuse');
        } else {
            switch ($conf['_method']) {
                case 'smtp':
                    require_once ABSPATH . WPINC .'/class-phpmailer.php';

                    $mailer = new PHPMailer();

                    $mailer->isSMTP();
                    $mailer->IsHTML(true);
                    $mailer->Host         = $conf['host'];
                    $mailer->Port         = $conf['port'];
                    $mailer->SMTPSecure   = $conf['secure'];
                    $mailer->SMTPAuth     = TRUE;
                    $mailer->Username     = $conf['username'];
                    $mailer->Password     = $conf['password'];
                    $mailer->From         = $conf['from_address'];
                    $mailer->FromName     = $conf['from_name'];

                    //$mailer->SMTPDebug = true;

                    if (is_array($to)) {
                        foreach ($to as $mail)
                            $mailer->AddAddress($mail);
                    } else {
                        $mailer->AddAddress($to);
                    }

                    $mailer->Subject = $subject;
                    $mailer->Body    = $message;

                    $result = $mailer->send();

                    $mailer->ClearAddresses();
                    $mailer->ClearAllRecipients();

                    unset($mailer);

                    if ($result) {
                        $response['status']  = 1;
                        $response['message'] = __('Email sent', 'tfuse');
                    }
                    break;
                case 'wpmail':
                    $headers = array();

                    $headers[] = "From:". htmlspecialchars($conf['from_name'], null, 'UTF-8') ." <". htmlspecialchars($conf['from_address'], null, 'UTF-8') .">";

                    if (!$_wpmail_filter_added) {
                        add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));
                        $_wpmail_filter_added = true;
                    }

                    $result = wp_mail($to, $subject, $message, $headers);

                    if ($result) {
                        $response['status']  = 1;
                        $response['message'] = __('Email sent', 'tfuse');
                    }
                    break;
            }
        }

        return $response;
    }
}