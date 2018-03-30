<?php
/**
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Theme03
 * @subpackage G1_Mailchimp_Module
 * @since G1_Mailchimp_Module 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php


class G1_Mailchimp_Module extends G1_Module {

    public function __construct() {
        parent::__construct();

        $this->set_version( '1.0.0' );
    }

    public function get_api_version () {
        return apply_filters( 'g1_mailchimp_api_version', '2.0' );
    }

    public function get_debug_mode () {
        return g1_get_theme_option('mailchimp', 'debug_mode', 'none') !== 'none';
    }

    /**
     * Set up all hooks
     */
    protected function setup_hooks() {
        parent::setup_hooks();

        add_action( 'widgets_init', array( $this, 'register_widgets' ) );
        add_action( get_redux_opts_sections_filter_name(), array( $this, 'add_theme_options' ) );
        add_action('wp_ajax_g1_mailchimp_add_to_mailing_list', array( $this, 'add_to_mailing_list' ));
        add_action('wp_ajax_nopriv_g1_mailchimp_add_to_mailing_list', array( $this, 'add_to_mailing_list' ));
    }

    public function add_to_mailing_list () {
        $ajax_data = $_POST['ajax_data'];

        // by default we set error message as response
        $response = __( 'An error occured while adding to the newsletter', 'g1_theme' );

        $api_key = g1_get_theme_option('mailchimp', 'api_key', '');
        $mailing_list = sanitize_text_field($ajax_data['mailing_list']);
        $subscriber_email = sanitize_text_field($ajax_data['subscriber_email']);

        // subscribe
        if ( !empty($api_key) && !empty($mailing_list) && is_email($subscriber_email) ) {
            $api_version = $this->get_api_version();
            $debug_mode = $this->get_debug_mode();

            $apiLoaded = false;
            $isCURLenabled = function_exists('curl_init');

            if ( $api_version === '2.0' && $isCURLenabled ) {
                if ( !class_exists('Mailchimp') ) {
                    require_once get_template_directory() . '/lib/g1-mailchimp/lib/Mailchimp.php';
                }

                $apiLoaded = true;

                $mcapi = new Mailchimp($api_key, array('debug' => $debug_mode));

                $subscribe_params = array(
                    'id' => $mailing_list,
                    'email' => array(
                        'email' => $subscriber_email
                    )
                );

                $subscribe_params = apply_filters( 'g1_mailchimp_subscribe_params', $subscribe_params );

                try {
                    $mcapi->call('lists/subscribe', $subscribe_params);

                    $response = 'success';
                } catch ( Mailchimp_Error $e ) {
                    $response = $this->get_error_message($e->getCode(), $e->getMessage());
                }
            }

            if ( $api_version === '1.0' || !$apiLoaded ) {
                if ( !class_exists('MCAPI') ) {
                    require_once get_template_directory() . '/lib/g1-mailchimp/lib/MCAPI.class.php';
                }

                $mcapi = new MCAPI($api_key);

                $subscribe_params = array(
                    'id'                => $mailing_list,
                    'email_address'     => $subscriber_email,
                    'merge_vars'        => NULL,
                    'email_type'        => 'html',
                    'double_optin'      => true,
                    'update_existing'   => false,
                    'replace_interests' => true,
                    'send_welcome'      => false
                );

                $subscribe_params = apply_filters( 'g1_mailchimp_subscribe_params', $subscribe_params );

                $res = $mcapi->listSubscribe(
                    $subscribe_params['id'],
                    $subscribe_params['email_address'],
                    $subscribe_params['merge_vars'],
                    $subscribe_params['email_type'],
                    $subscribe_params['double_optin'],
                    $subscribe_params['update_existing'],
                    $subscribe_params['replace_interests'],
                    $subscribe_params['send_welcome']
                );

                if ($res === true) {
                    $response = 'success';
                } else {
                    $response = $this->get_error_message( $mcapi->errorCode, $mcapi->errorMessage );
                }
            }
        }

        echo $response;
        exit;
    }

    protected function get_error_message ($code, $message) {
        if ($this->get_debug_mode()) {
            return $message . ' (code: '. $code .')';
        }

        switch ( $code ) {
            case 214:
                $msg = __( 'Email address already subscribed', 'g1_theme' );
                break;

            default:
                $msg = __( 'An error occured while adding to the newsletter', 'g1_theme' );
        }

        return $msg;
    }

    public function register_widgets() {
        register_widget( 'G1_Mailchimp_Widget' );
    }

    public function add_theme_options ( $sections ) {
        $sections['newsletter'] = array(
            'priority'   => 970,
            'icon'       => 'envelope-alt',
            'icon_class' => 'icon-large',
            'title'      => __( 'Newsletter', Redux_TEXT_DOMAIN ),
            'fields'     => array(
                array(
                    'id'        => 'mailchimp_info',
                    'priority'  => 10,
                    'type'      => 'info',
                    'desc'     =>   '<h4>' .
                                    __( 'MailChimp', Redux_TEXT_DOMAIN ) .
                                    '</h4>' .
                                    '<p>' .
                                    __( 'The theme is integrated with the MailChimp service so you can easily conduct your mailing campaigns.', Redux_TEXT_DOMAIN ) .
                                    '</p>',
                ),
                array(
                    'id'        => 'mailchimp_api_key',
                    'priority'  => 20,
                    'type'      => 'text',
                    'title'     => __( 'API Key', Redux_TEXT_DOMAIN ),
                    'sub_desc'     => __( 'You can find the key on your MailChimp Account, in the section API Keys & Authorized Apps', Redux_TEXT_DOMAIN ),
                ),
                array(
                    'id'        => 'mailchimp_debug_mode',
                    'priority'  => 30,
                    'type'      => 'select',
                    'title'     => __( 'Debug mode', Redux_TEXT_DOMAIN ),
                    'sub_desc'  => __( 'If subscription process doesn\'t work, enable this mode to see information about potential problems.', Redux_TEXT_DOMAIN ),
                    'options'   => array(
                        'none'          => __( 'disabled', Redux_TEXT_DOMAIN ),
                        'standard'      => __( 'enabled', Redux_TEXT_DOMAIN ),
                    ),
                    'switch'    => true,
                    'std'       => 'none',
                ),
            )
        );

        return $sections;
    }
}
function G1_Mailchimp_Module() {
    static $instance;

    if ( !isset( $instance ) )
        $instance = new G1_Mailchimp_Module();

    return $instance;
}
// Fire in the hole :)
G1_Mailchimp_Module();


class G1_Mailchimp_Shortcode extends G1_Shortcode {
    public function __construct( $id, $args = array() ) {
        parent::__construct( $id, $args );

        $this->set_content( 'content', array(
            'form_control' => 'Long_Text',
            'label' => __( 'text_before', 'g1_theme' ),
            'hint'	=> __( 'Text to show above subscription form', 'g1_theme' ),

        ));

        add_action( 'g1_shortcode_generator_register', array( $this, 'add_shortcode_generator_item' ) );
    }

    public function get_mailing_list_choices () {
        $api_key = g1_get_theme_option('mailchimp', 'api_key', '');
        $choices = array();

        if ( !empty( $api_key ) ) {
            $api_version = G1_Mailchimp_Module()->get_api_version();
            $debug_mode = true === G1_Mailchimp_Module()->get_debug_mode();

            if ( $api_version === '1.0' ) {
                if ( !class_exists('MCAPI') ) {
                    require_once dirname(__FILE__) . '/lib/MCAPI.class.php';
                }

                $mcapi = new MCAPI($api_key);
                $mc_lists = $mcapi->lists();

                if ( empty( $mcapi->errorCode ) && $mc_lists['total'] > 0 ) {
                    foreach ( $mc_lists['data'] as $mc_list ) {
                        $list_id = $mc_list['id'];
                        $list_name = $mc_list['name'];

                        $choices[$list_id] = $list_name;
                    }
                }
            }

            if ( $api_version === '2.0' ) {
                if ( !class_exists('Mailchimp') ) {
                    require_once dirname(__FILE__) . '/lib/Mailchimp.php';
                }

                $api = new Mailchimp($api_key, array( 'debug' => $debug_mode ));

                try {
                    $res = $api->call('lists/list', array());

                    if ( !empty($res['errors']) ) {
                        foreach ( $res['errors'] as $error ) {
                            $choices[] = $error;
                        }
                    } else if ( abs($res['total']) > 0 ) {
                        foreach ( $res['data'] as $list ) {
                            $id = $list['id'];
                            $name = $list['name'];

                            $choices[$id] = $name;
                        }
                    }
                } catch (Mailchimp_Error $e) {
                    if ( $debug_mode ) {
                        $choices[] = $e->getMessage() . ' (code: '. $e->getCode() .')';
                    }
                }
            }
        } else {
            $choices[] = __( 'To fetch the list you need to enter your MailChimp Api Key in the theme options panel.', 'g1_theme' );
        }

        if ( empty($choices) ) {
            $choices[] = __( 'Some errors occurred while fetching Mailchimp data.', 'g1_theme' );
        }

        return $choices;
    }

    /**
     * Add shortcode to the global shortcode generator
     *
     * @param G1_Shortcode_Generator $generator
     */
    public function add_shortcode_generator_item( $generator ) {
        $generator->add_item( $this, 'misc' );
    }

    protected function test_dependencies () {
        if ( !function_exists('curl_init') ) {
            $helpmode = G1_Helpmode(
                'curl_not_enabled',
                __( 'cURL not enabled.', 'g1_theme' ),
                __( 'cURL module is not enabled on your server. Please contact your hosting provider and ask about enabling cURL for your account.', 'g1_theme' ),
                'error'
            );

            $out = $helpmode->capture();

            if ( strlen( $out ) ) {
                $out = '<div style="position: relative; z-index: 10;">' . $out . '</div>';
            }

            echo $out;
            return false;
        }

        return true;
    }

    public function enqueue_scripts() {
        wp_enqueue_script('g1_mailchimp', get_template_directory_uri().'/lib/g1-mailchimp/js/g1-mailchimp.js', array('g1_main'), true);

        $config = array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'i18n' => array(
                'error_missing_email'           => __('You need to set your mail address', 'g1_theme'),
                'error_missing_mailing_list'    => __('You have not set mailing list. Please check your Mailchimp widget (save it once again) and clear page cache (if used).', 'g1_theme'),
                'subscription_success'          => __( 'Your mail was added to our newsletter', 'g1_theme' ),
                'subscription_error'            => __( 'An error occured while adding to the newsletter', 'g1_theme' )
            )
        );

        wp_localize_script('g1_mailchimp', 'g1_mailchimp_config', json_encode($config) );
    }

    protected function load_attributes() {
        $this->add_attribute( 'mailing_list', array(
            'form_control'  => 'Choice',
            'id_aliases' => array(
                'mailinglist',
                'mailing-list',
                'list',
            ),
            'choices_cb'    => array($this, 'get_mailing_list_choices'),
            'default'       => ''
        ));
    }

    /**
     * Shortcode callback function.
     *
     * @return string
     */
    protected function do_shortcode() {
        $this->test_dependencies();

        extract( $this->extract() );

        $content = preg_replace('#^<\/p>|<p>$#', '', $content);

        // Compose final HTML id attribute
        $final_id = strlen( $id ) ? $id : 'g1-mailchimp-counter-' . $this->get_counter();

        // Compose final HTML class attribute
        $final_class = array(
            'g1-mailchimp'
        );

        add_action( 'wp_footer', array( $this, 'enqueue_scripts') );

        $form = '';

        $form .= '<form action="' . esc_url( $_SERVER['PHP_SELF'] ) . '" method="post">';

        if (G1_Mailchimp_Module()->get_debug_mode()) {
            $form .= '<input type="hidden" name="g1_debug_mode" value="on" />';
        }

        $form .= '<input type="hidden" name="g1_mailing_list" value="'. esc_attr( $mailing_list ) .'" />';
        $form .= '<div class="g1-form-row g1-mailchimp-subscriber-email">';
        $form .= '<label for="g1-subscriber-email">' . __('Your Email', 'g1_theme' ) . '</label>';
        $form .= '<input id="g1-subscriber-email-'. $this->get_counter() .'" type="text" name="g1_subscriber_email" />';
        $form .= '</div>';

        $form .= '<div class="g1-form-actions">';
        $form .= '<input type="submit" value="'. __( 'Subscribe', 'g1_theme' ) .'" />';
        $form .= '</div>';
        $form .= '</form>';

        $out = '<div id="' . esc_attr( $final_id ) . '" class="' . sanitize_html_classes( $final_class ) . '">'."\n";

        $out .= '<div class="g1-mailchimp__intro">';
        $out .= do_shortcode( shortcode_unautop( $content ) );
        $out .= '</div>';

        $out .= '<div class="g1-subscription-status"></div>'."\n";
        $out .= $form;

        $out .= '</div>'."\n";

        return $out;

    }
}
function G1_Mailchimp_Shortcode() {
    static $instance;

    if ( !isset( $instance ) )
        $instance = new G1_Mailchimp_Shortcode( 'mailchimp_newsletter' );

    return $instance;
}
// Fire in the hole :)
G1_Mailchimp_Shortcode();


class G1_Mailchimp_Widget extends G1_Shortcode_Widget {
    public function get_id_base() { return 'g1_mailchimp_widget'; }
    public function get_name() { return __( 'G1 MailChimp Newsletter', 'g1_theme' ); }

    public function setup_shortcode() {
        $this->shortcode = G1_Mailchimp_Shortcode();
    }
}