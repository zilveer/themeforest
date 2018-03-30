<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

/**
 * YIT_Logos exists
 */
define('YIT_CONTACT_FORM', true);

class YIT_Contact_Form
{

    /**
     * @var string Version
     */
    public $version = YIT_CONTACT_FORM_VERSION;

    /**
     * @var string Plugin url
     */
    public $plugin_url;

    /**
     * @var string
     */
    public $plugin_path;

    /**
     * @var string
     */
    public $plugin_assets_url;


    /**
     * @var string plugin assets path
     */
    public $plugin_assets_path;

    /**
     * @var string plugin template url
     */
    public $plugin_template_url;

    /**
     * @var string plugin template path
     */
    public $plugin_template_path;

    /**
     * @var int current form id
     */
    public $current_form_id = 0;

    /**
     * The error messages to show
     *
     * @since 1.0.0
     * @access public
     * @var array
     */
    public $messages = array();

    /**
     * @var string $contact_form_post_type The post type name for the post type of all contact forms
     */
    public $contact_form_post_type = 'contact-form';

    /**
     * @var object The single instance of the class
     * @since 1.0
     */
    protected static $_instance = null;

    /**
     * @var object The instance of the panel
     * @since 1.0
     */
    protected $_panel = null;

    /**
     * @var object The instance of the panel
     * @since 2.0
     */
    protected $_is_captcha_invalid = false;


    protected $is_old_php_version = false;

    /**
     * Main plugin Instance
     *
     * @static
     * @return object Main instance
     *
     * @since  1.0
     * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * Return if captcha is correct after a post
     *
     * @static
     * @return boolean
     *
     * @since  2.0
     * @author Andrea Frascaspata <andrea.frascaspata@yithemes.com>
     */
    public function isCaptchaInvalid()
    {
        return $this->_is_captcha_invalid;
    }

    /**
     * Constructor
     *
     * @since  1.0
     * @author Francesco Licandro <francesco.licandro@yithemes.it>
     */
    public function __construct()
    {
        // define local attributes
        $this->plugin_url = untrailingslashit(get_template_directory_uri() . '/theme/plugins/yit-framework/modules/contact-form');
        $this->plugin_path = untrailingslashit(get_template_directory() . '/theme/plugins/yit-framework/modules/contact-form');
        $this->plugin_assets_url = $this->plugin_url . '/assets';
        $this->plugin_assets_path = $this->plugin_path . '/assets';
        $this->plugin_template_url = $this->plugin_url . '/templates';
        $this->plugin_template_path = $this->plugin_path . '/templates';

        $this->is_old_php_version = version_compare(preg_replace('/-beta-([0-9]+)/', '', phpversion()), '5.5', '<');

        // fix the base url and base path in case is the plugin
        add_action('after_setup_theme', array($this, 'set_path_and_url_by_plugin'));

        // register post type
        add_action('init', array($this, 'register_post_type'));

        //register metabox
        add_action('init', array($this, 'add_metabox'), 1);

        //enqueue script and style for admin
        add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_script'));

        //enqueue script and style
        add_action('wp_enqueue_scripts', array($this, 'enqueue_script'));

        // add the shortcode for the logos
        foreach ($this->contactform_shortcode() as $shortcode => $atts) {
            add_shortcode($shortcode, array(&$this, 'shortcode_callback'));
            add_filter('yit_shortcode_' . $shortcode . '_icon', array(&$this, 'shortcode_icon'), 10, 2);
        }
        add_filter('yit-shortcode-plugin-init', array(&$this, 'add_shortcode'));

        // check if the form is submitted to send the email
        if (!defined('DOING_AJAX') || (!DOING_AJAX)) {
            add_action('init', array($this, 'send_email') , 20);
        }

        //Ajax submit
        $this->add_form_handling();

    }

    /**
     * Fix the base path and base url of plugin
     *
     * As soon as the plugin is instantiated, the base path and url are from the YIT theme, but this method is hook
     * inside 'plugins_loaded', so if it is called, the base path and url must be from plugin
     */
    public function set_path_and_url_by_plugin()
    {
        if (file_exists(get_template_directory() . '/theme/plugins/yit-framework/')) {
            return;
        }

        $this->plugin_url = untrailingslashit(plugins_url('/', __FILE__));
        $this->plugin_path = untrailingslashit(plugin_dir_path(__FILE__));
        $this->plugin_assets_url = $this->plugin_url . '/assets';
        $this->plugin_assets_path = $this->plugin_path . '/assets';
        $this->plugin_template_url = $this->plugin_url . '/templates';
        $this->plugin_template_path = $this->plugin_path . '/templates';
    }

    /**
     * Register post type
     *
     * Register the post type for the creation of testimonials
     *
     * @return void
     * @since  1.0
     * @author Francesco Licandro <francesco.licandro@yithemes.it>
     */
    public function register_post_type()
    {
        $labels = array(
            'name' => __('Contact Forms', 'yit'),
            'singular_name' => __('Contact Form', 'yit'),
            'plural_name' => __('Contact Forms', 'yit'),
            'item_name_sing' => __('Contact Form', 'yit'),
            'item_name_plur' => __('Contact Forms', 'yit'),
            'add_new' => __('Add New Contact Form', 'yit'),
            'add_new_item' => __('Add New Contact Form', 'yit'),
            'edit' => __('Edit', 'yit'),
            'edit_item' => __('Edit Contact Form', 'yit'),
            'new_item' => __('New Contact Form', 'yit'),
            'view' => __('View Contact Form', 'yit'),
            'view_item' => __('View Contact Form', 'yit'),
            'search_items' => __('Search Contact Forms', 'yit'),
            'not_found' => __('No Contact Forms', 'yit'),
            'not_found_in_trash' => __('No Contact Forms in the Trash', 'yit'),
        );

        $args = array(
            'labels' => $labels,
            'public' => false,
            'public_queryable' => false,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => false,
            'capability_type' => 'post',
            'hierarchical' => false,
            'has_archive' => 'contact-form',
            'rewrite' => array('slug' => apply_filters('yit_contact_form_rewrite', 'contact-form')),
            'menu_position' => null,
            'supports' => array('title'),
            'description' => "Contact Forms"

        );

        register_post_type($this->contact_form_post_type, apply_filters('yit_contact_form_args', $args));
        add_action('manage_posts_custom_column', array(&$this, 'custom_columns'));
        add_filter('manage_edit-' . $this->contact_form_post_type . '_columns', array(&$this, 'edit_columns_logo'));
    }

    /**
     * Add metabox to contact form custom post
     *
     * Add metabox to the custom post
     *
     * @return void
     * @since  1.0
     * @author Francesco Licandro <francesco.licandro@yithemes.it>
     */
    public function add_metabox()
    {

        $args = array(
            'label' => __('Form Settings', 'yit'),
            'pages' => $this->contact_form_post_type,
            'context' => 'normal', //('normal', 'advanced', or 'side')
            'priority' => 'default',
            'tabs' => array(
                'configuration' => array(
                    'label' => __('Contact Form Configuration', 'yit'),
                    'fields' => array(
                        'receiver' => array(
                            'label' => __('Receiver(s)', 'yit'),
                            'desc' => 'Define the emails used (separeted by comma) to receive emails.',
                            'type' => 'text',
                            'std' => 'info@info.com'
                        ),
                        'sender_mail' => array(
                            'label' => __('Sender Email', 'yit'),
                            'desc' => 'Define from what email send the message.',
                            'type' => 'text',
                            'std' => 'info@info.com'
                        ),
                        'sender_name' => array(
                            'label' => __('Sender Name', 'yit'),
                            'desc' => 'Define the name of email that send the message.',
                            'type' => 'text',
                            'std' => 'Admin'
                        ),
                        'subject' => array(
                            'label' => __('Subject', 'yit'),
                            'desc' => 'Define the subject of the email sent to you.',
                            'type' => 'text',
                            'std' => ''
                        ),
                        'body' => array(
                            'label' => __('Body', 'yit'),
                            'desc' => 'Define the body of the email sent to you.',
                            'type' => 'textarea',
                            'std' => '%message%  <small><i>This email is been sent by %name% (email. %email%).</i></small>',
                        ),
                        'title_position' => array(
                            'label' => __('Position of the field title', 'yit'),
                            'desc' => 'Select the position of the field title',
                            'type' => 'select',
                            'options' => array(
                                'placeholder' => __('Placeholder', 'yit'),
                                'label' => __('Label', 'yit'),
                                'both' => __('Both', 'yit')
                            ),
                            'std' => 'placeholder'
                        ),
                        'submit_label' => array(
                            'label' => __('Submit Button Label', 'yit'),
                            'desc' => 'Define the label of submit button.',
                            'type' => 'text',
                            'std' => 'Send Message'
                        ),
                        'submit_alignment' => array(
                            'label' => __('Submit Button Alignment', 'yit'),
                            'desc' => 'Set the alignment of submit button.',
                            'type' => 'select',
                            'options' => array(
                                'alignleft' => 'left',
                                'aligncenter' => 'center',
                                'alignright' => 'right'
                            )
                        ),
                        'submit_style' => array(
                            'label' => __('Submit Button Style', 'yit'),
                            'desc' => 'Set the style of submit button.',
                            'type' => 'select',
                            'options' => apply_filters('yit_contact_form_buttons_style', array(
                                    'flat' => 'Flat',
                                    'alternative' => 'Alternative',
                                )
                            )
                        ),
                        'do_ajax' => array(
                            'label' => __('Ajax Activate', 'yit'),
                            'desc' => '',
                            'type' => 'checkbox',
                            'std' => 'yes'
                        ),
                        'success_sending' => array(
                            'label' => __('Success Message', 'yit'),
                            'desc' => 'Define the message when email send correctly.',
                            'type' => 'text',
                            'std' => 'Email send correctly!'
                        ),
                        'error_sending' => array(
                            'label' => __('Error Message', 'yit'),
                            'desc' => 'Define the message when there is an error on send of email.',
                            'type' => 'text',
                            'std' => 'An error has been encountered. Please try again.'
                        ),

                        'captcha' => array(
                            'label' => __('reCaptcha System', 'yit'),
                            'desc' => 'Check if you want to use reCaptcha system.',
                            'type' => 'checkbox',
                            'std' => '',
                        ),
                        'nocaptcha_recaptcha' => array(
                            'label' => __('Use No CAPTCHA reCAPTCHA System', 'yit'),
                            'desc' => 'Check if you want to use the new No CAPTCHA reCAPTCHA System or leave the old reCAPTCHA system.',
                            'type' => 'checkbox',
                            'deps' => array(
                                'ids' => '_captcha',
                                'values' => 'yes'
                            )
                        ),
                        'private_key' => array(
                            'label' => __('Private API Key', 'yit'),
                            'desc' => 'Insert the private api key of reCaptcha',
                            'type' => 'text',
                            'std' => '',
                            'deps' => array(
                                'ids' => '_captcha',
                                'values' => 'yes'
                            )
                        ),
                        'public_key' => array(
                            'label' => __('Public API Key', 'yit'),
                            'desc' => 'Insert the public api key of reCaptcha',
                            'type' => 'text',
                            'std' => '',
                            'deps' => array(
                                'ids' => '_captcha',
                                'values' => 'yes'
                            )
                        ),
                    )
                ),
                'edit' => array(
                    'label' => __('Add\Edit Form', 'yit'),
                    'fields' => array(
                        'items' => array(
                            'type' => 'contactform',
                            'std' => array()
                        )
                    )
                ),
            )
        );

        if ($this->is_old_php_version) {
            $configuration = &$args['tabs']['configuration']['fields'];
            unset($configuration['nocaptcha_recaptcha']);
        }

        $metabox = new YIT_Metabox('yit-contact-form-info');
        $metabox->init($args);

    }


    /**
     * Customize link column
     *
     * Customize the columns in the table of all post types
     *
     * @param $column Column name
     *
     * @return void
     * @since 1.0.0
     * @author Antonio La Rocca <francesco.licandro@yithemes.it>
     */
    public function custom_columns($column)
    {
        global $post;

        switch ($column) {
            case "shortcode":
                if (isset($post->post_name) && !empty($post->post_name) && $post->post_type == $this->contact_form_post_type) echo '[contact_form name="' . $post->post_name . '"]';
                break;
        }

    }

    /**
     * Add columns to Contact Forms admin
     *
     * Edit the columns in the table of contact forms post types
     *
     * @param $columns array() Columns array
     *
     * @return array()
     * @since 1.0.0
     * @author Francesco Licandro <francesco.licandro@yithemes.it>
     */
    public function edit_columns_logo($columns)
    {
        $columns['shortcode'] = __('Shortcode', 'yit');
        return $columns;
    }

    /**
     * Add Form Handling
     *
     * Add the frontend form handling, if needed
     *
     * @return void
     * @since 1.0.0
     * @author Emanuela Castorina
     */
    public function add_form_handling()
    {
        // add contact form submit
        add_action('wp_ajax_yit_contact_form_submit', array($this, 'ajax_submit'));
        add_action('wp_ajax_nopriv_yit_contact_form_submit', array($this, 'ajax_submit'));
    }

    public function ajax_submit()
    {
        if (isset($_REQUEST['yit_ajax']) && $_REQUEST['yit_ajax'] == 1) {
            $this->send_email();
            $response = array(
                'msg' => '',
                'type' => 'error',
            );

            if ($this->isCaptchaInvalid()) {
                $response['msg'] = __("CAPTCHA not valid.", "yit");
            }

            if (isset($this->messages[$this->current_form_id])) {
                foreach ($this->messages[$this->current_form_id] as $key => $msg) {

                    if ($key == 'general') {
                        if (strpos($msg, 'success') !== false) {
                            $response['type'] = 'success';
                        }

                        $response['msg'] = $msg;
                    } else {

                        $response['msg'] .= $key . ': ' . $msg . '<br>';

                    }
                }
            }

            echo json_encode($response);
            die();

        }
    }


    /**
     * Add shortcode
     *
     * Register contact forms shortcode on yit_shortcode plugin
     *
     * @param $shortcodes_array array() Array of shortcodes
     *
     * @return array()
     * @since  1.0.0
     * @author Francesco Licandro <francesco.licandro@yithemes.it>
     */
    public function add_shortcode($shortcodes_array)
    {
        return array_merge($shortcodes_array, $this->contactform_shortcode());
    }

    /**
     * Shortcode icon
     *
     * Return the shortcode icone to display on shortcode panel
     *
     * @param $icon_url  string Icone url found by yit_shortcode plugin
     * @param $shortcode string Tag shortcode
     *
     * @return string
     * @since  1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function shortcode_icon($icon_url, $shortcode)
    {
        return $this->plugin_assets_url . '/images/' . $shortcode . '.png';
    }

    /**
     * Shortcode list for contact forms
     *
     * Return shortcode list for contact forms
     *
     * @return array()
     * @since 1.0.0
     * @author Francesco Licandro <francesco.licandro@yithemes.it>
     */
    public function contactform_shortcode()
    {

        $args = array(
            'posts_per_page' => -1,
            'post_type' => 'contact-form'
        );

        $options = array();

        if ( is_admin() ) {
            foreach ( get_posts( $args ) as $post ) {
                $options[ $post->post_name ] = $post->post_title;
            }
        }

        return array(
            'contact_form' => array(
                'title' => __('Contact Form', 'yit'),
                'description' => __('Print a created contact form', 'yit'),
                'tab' => 'cpt',
                'create' => false,
                'has_content' => false,
                'in_visual_composer' => true,
                'attributes' => array(
                    'name' => array(
                        'title' => __('Name', 'yit'),
                        'type' => 'select',
                        'options' => $options,
                        'std' => ''
                    ),
                    'button_style' => array(
                        'title' => __('Button Style', 'yit'),
                        'type' => 'text',
                        'std' => 'btn btn-flat',
                        'hide' => true
                    ),
                )
            )
        );
    }

    /**
     * Shortcode Callback
     *
     * Callback for contact forms shortcode; load the correct template whit variables inserted and return the html markup
     *
     * @param $atts      array() Attributes array for shortcode
     * @param $content   string Shortcode content
     * @param $shortcode string Shortcode Tag
     *
     * @return string
     * @since  1.0.0
     * @author Francesco Licandro <francesco.licandro@yithemes.it>
     */
    public function shortcode_callback($atts, $content = null, $shortcode)
    {
        //$shortcode_contact = $this->contactform_shortcode();

        //foreach( $shortcode_contact as $short ){}

        global $wpdb;
        $all_atts = $atts;
        $all_atts['content'] = $content;
        $all_atts['button_style'] = isset($all_atts['button_style']) ? $all_atts['button_style'] : 'btn btn-flat';

        // get post id of contact form
        $this->current_form_id = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE post_name = %s AND post_type = %s", $all_atts['name'], 'contact-form'));
        //wpml control
        //$this->current_form_id = yit_wpml_get_translated_id($this->current_form_id, 'contact-form');

        $fields = $this->get('_items');

        if (!is_array($fields) OR empty($fields)) {
            return null;
        }

        ob_start();
        yit_plugin_get_template(untrailingslashit($this->plugin_path), 'contact-form/contactform-template.php', array('fields' => $fields, 'post_id' => $this->current_form_id, 'button_style' => $all_atts['button_style'], 'title_position' => $this->get('_title_position')));
        $shortcode_html = ob_get_clean();


        //  Check if nocaptcha script is needed and enqueue it
        if ($this->get('_nocaptcha_recaptcha') == '1' && !$this->is_old_php_version) {
            wp_enqueue_script("ywqa-recaptcha", '//www.google.com/recaptcha/api.js', array(), false, true);
        }

        return apply_filters('yit_shortcode_' . $shortcode, $shortcode_html, $shortcode);

    }

    /**
     * Get a post meta of the contact form
     *
     * @param $key
     *
     * @internal param $id
     * @return array
     * @since    1.0.0
     * @author   Francesco Licandro <francesco.licandro@yithemes.it>
     */
    public function get($key)
    {
        return get_post_meta($this->current_form_id, $key, true);
    }

    /**
     * Stamp the form of recaptcha
     *
     * @since 1.0.0
     * @author Francesco Licandro <francesco.licandro@yithemes.it>
     */
    public function recaptcha()
    {
        if ($this->get('_captcha') == '1') {
            if (YIT_Contact_Form()->get('_nocaptcha_recaptcha') == '1' && !$this->is_old_php_version) {
                $publickey = YIT_Contact_Form()->get('_public_key');
                echo '<div class="g-recaptcha" data-sitekey="' . $publickey . '"></div>';

            } else {
                require_once(YIT_Contact_Form()->plugin_path . '/vendors/recaptchalib.php');
                $publickey = YIT_Contact_Form()->get('_public_key');
                echo recaptcha_get_html($publickey, null, is_ssl());
            }
        }
    }

    /**
     * Send the email if the form is submitted
     *
     * @since 1.0.0
     * @author Francesco Licandro <francesco.licandro@yithemes.it>
     */
    public function send_email()
    {
        $messages = $attachments = array();
        $qstr = '';

//        if ( isset( $_POST['yit_bot'] ) && ! empty( $_POST['yit_bot'] ) )
//            return;


        if (isset($_POST['yit_action']) AND ($_POST['yit_action'] == 'sendemail' OR $_POST['yit_action'] == 'sendemail-ajax') AND wp_verify_nonce($_REQUEST['yit_contact_form_nonce'], 'yit-sendmail')) {

            $this->current_form_id = intval($_POST['id_form']);    // post_id

            if ($this->get('_captcha') == '1') {
                if (YIT_Contact_Form()->get('_nocaptcha_recaptcha') == '1' && !$this->is_old_php_version) {
                    $this->_is_captcha_invalid = false;

                    if (!isset($_POST["g-recaptcha-response"])) {
                        $this->_is_captcha_invalid = true;
                        return;
                    } else {
                        $remote_ip = $_SERVER['REMOTE_ADDR'];
                        $sec_token = $_POST["g-recaptcha-response"];
                        $secret_key = $this->get('_private_key');

                        $recaptcha = new \ReCaptcha\ReCaptcha($secret_key);
                        $resp = $recaptcha->verify($sec_token, $remote_ip);

                        if (!$resp->isSuccess()) {
                            //$errors = $resp->getErrorCodes();
                            $this->_is_captcha_invalid = true;
                            return;
                        }
                    }

                } else {
                    require_once(YIT_Contact_Form()->plugin_path . '/vendors/recaptchalib.php');
                    $privatekey = $this->get('_private_key');
                    $resp = recaptcha_check_answer($privatekey,
                        $_SERVER["REMOTE_ADDR"],
                        $_POST["recaptcha_challenge_field"],
                        $_POST["recaptcha_response_field"]);

                    if (!$resp->is_valid) {
                        $this->_is_captcha_invalid = true;
                        return;
                    } else {
                        $this->_is_captcha_invalid = false;
                    }
                }
            }


            $fields = $this->get('_items'); //get the fields

            // body
            $body = nl2br($this->get('_body'));

            $yit_referer = $_POST['yit_referer'];

            // add ip and referer
            $shortcodes = apply_filters('yit_contact_form_shortcodes', array(
                '%ipaddress%' => $_SERVER['REMOTE_ADDR'],
                '%referer%' => $yit_referer
            ));


            foreach ($shortcodes as $shortcode => $val)
                $body = str_replace($shortcode, $val, $body);

            $union_qstr = ($qstr == '') ? '?' : '';

            $reply_to = $to = $from_email = $from_name ='';

            // to
            $to = apply_filters( 'yit_contact_form_email_to', $this->get('_receiver') );

            // from
            $from_email = $this->get('_sender_mail');
            $from_name  = $this->get('_sender_name');

            /// subject
            $subject = stripslashes($this->get('_subject'));

            $post_data = isset($_POST['yit_contact']) ? array_map('stripslashes_deep', $_POST['yit_contact']) : array();


            // sku
            if ( isset($post_data['sku']) ) {
                $body = str_replace("%sku%", $post_data['sku'], $body);
            }

            if ( isset($post_data['product_id']) ) {
                $body = str_replace("%product_id%", $post_data['product_id'], $body);
            }

            foreach ($fields as $c => $field) {
                $id = $field['data_name'];
                $type = $field['type'];

                if ($type == 'file') {
                    continue;
                }

                if ($field['type'] == 'checkbox' && isset($field['required']) && !isset($post_data[$id])) {
                    $this->messages[$this->current_form_id][$id] = stripslashes($field['error']);
                }

                if (isset($post_data[$id])) {
                    if( $field['type'] == 'checkbox' ){
                        $var = __( 'Yes', 'yit' );
                    }

                    else {
                        $var = $post_data[$id];
                    }
                }

                elseif( ! isset($post_data[$id]) &&  $field['type'] == 'checkbox' ){
                    $var = __( 'No', 'yit' );
                }

                // validate, adding message error, set up on admin panel, if var is not valid.
                if ((isset($field['required']) AND $var == '') OR (isset($field['is_email']) AND !is_email($var)))
                    $this->messages[$this->current_form_id][$id] = stripslashes($field['error']);

                // if reply to
                if (isset($field['reply_to']) AND ($field['reply_to'] == 'yes' || $field['reply_to'] == '1')) {
                    $reply_to = $var;
                }

                // convert \n to <br>
                if (isset($field['type']) AND $field['type'] == 'textarea') {
                    $var = nl2br($var);
                }

                ${$id} = $var;

                // replace tags of body config
                $body = str_replace("%$id%", $var, $body);
                $to = str_replace("%$id%", $var, $to);
                $from_email = str_replace("%$id%", $var, $from_email);
                $from_name = str_replace("%$id%", $var, $from_name);
                $subject = str_replace("%$id%", $var, $subject);
            }
            /*
                        var_dump($body);
                        var_dump($to);
                        var_dump($from_email);
                        var_dump($from_name);
                        var_dump($subject);
            */
            // if there ware some errors, return messages.

            if (!empty($this->messages[$this->current_form_id]))
                return;

            // if there are attachments
            if (isset($_FILES['yit_contact']['tmp_name'])) {
                foreach ($_FILES['yit_contact']['tmp_name'] as $id => $a_file) {
                    $file = basename($_FILES['yit_contact']['name'][$id]);
                    if( empty( $file ) ) {
                        continue;
                    }
                    list($file_name, $file_ext) = explode('.', $file);

                    if (in_array($file_ext, array('php', 'js', 'exe', 'sh', 'bat', 'com'))) {
                        continue;
                    }

                    $new_path = WP_CONTENT_DIR . '/uploads/' . basename($_FILES['yit_contact']['name'][$id]);
                    move_uploaded_file($a_file, $new_path);
                    $attachments[] = $new_path;
                }
            }

            // set content type
            add_filter('wp_mail_content_type', create_function('$content_type', "return 'text/html';"));
            add_filter('wp_mail_from', create_function('$from', "return '$from_email';"));
            add_filter('wp_mail_from_name', create_function('$from', "return '$from_name';"));


            // all header, that will be print with implode.
            $headers = array();

            if ($reply_to) {
                $headers[] = 'Reply-To: ' . $reply_to;
            }


            if (wp_mail($to, $subject, $body, implode("\r\n", $headers), $attachments)) {
                $this->messages[$this->current_form_id]['general'] = '<div class="success"><p>' . $this->get('_success_sending') . '</p></div>';
                do_action('yit-sendmail-success');

            } else {
                $this->messages[$this->current_form_id]['general'] = '<p class="error">' . $this->get('_error_sending') . '</p>';
            }


        }
    }


    /**
     * Enqueue style & script for admin
     *
     * Enqueue admin style and js script; constructor add it to wp_enqueue_script hook
     *
     * @return void
     * @since  1.0.0
     * @author Francesco Licandro <francesco.licandro@yithemes.it>
     */
    public function admin_enqueue_script()
    {
        wp_enqueue_media();
        wp_enqueue_style('contact-form', $this->plugin_assets_url . '/css/contact_form.css');
        wp_enqueue_script('select-icon-script', $this->plugin_assets_url . '/js/select-icon.min.js', array('jquery'));
    }

    /**
     * Enqueue style & script
     *
     * Enqueue frontend style and js script; constructor add it to wp_enqueue_script hook
     *
     * @return void
     * @since  1.0.0
     * @author Francesco Licandro <francesco.licandro@yithemes.it>
     * @author Lorenzo Giuffrida
     */
    public function enqueue_script()
    {
        wp_enqueue_script('contact-script', $this->plugin_assets_url . '/js/contact.min.js', array('jquery'), '', true);


        wp_enqueue_style('font-awesome', $this->plugin_assets_url . '/css/font-awesome.min.css');
        wp_localize_script('contact-script', 'contact_localization', array('url' => admin_url('admin-ajax.php'), 'wait' => __('Sending...', 'yit')));
    }


    public function getMessage($message, $form = false)
    {
        if (!$form) $form = $this->current_form_id;
        if (isset($this->messages[$form][$message]))
            return $this->messages[$form][$message];
    }

    public function generalMessage($form = false, $echo = true)
    {
        if (!$form) $form = $this->current_form_id;

        if (!$echo) ob_start();

        echo $this->getMessage('general', $form);

        if (!$echo) return ob_get_clean();
    }

}

/**
 * Main instance of plugin
 *
 * @return object
 * @since  1.0
 * @author Francesco Licandro <francsco.licandro@yithemes.it>
 */
function YIT_Contact_Form()
{
    return YIT_Contact_Form::instance();
}

/**
 * Create a new YIT_Contact_Form object
 */
YIT_Contact_Form();