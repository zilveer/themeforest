<?php
/**
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Theme03
 * @subpackage G1_Contact_Form_Module
 * @since G1_Contact_Form_Module 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php
/**
 * Basic Contact Form
 *
 * @package G1_FRAMEWORK
 * @subpackage G1_CONTACT_FORM
 */
class G1_Contact_Form_Module extends G1_Module {
    public function __construct() {
        parent::__construct();

        $this->set_version( '1.0.0' );
    }

    /**
     * Set up all hooks
     */
    protected function setup_hooks() {
        parent::setup_hooks();

        add_action( 'widgets_init', array( $this, 'register_widgets' ) );
        add_action('wp_ajax_g1_contact_form_send', array( $this, 'handle_send_action' ));
        add_action('wp_ajax_nopriv_g1_contact_form_send', array( $this, 'handle_send_action' ));
    }

    public function handle_send_action () {
        $result = '';

        $data = $_POST['contact_form_data'];

        if ( strlen($data) > 0 ) {
            $data = unserialize(base64_decode($data));
        }

        if ( $data !== false && is_array($data) ) {
            $attrs = array();
            $allowed_fields = array('id', 'class', 'name', 'email', 'subject', 'success', 'failure');

            foreach ( $data as $key => $value ) {
                if ( in_array($key, $allowed_fields) && !empty($data[$key]) ) {
                    $key = esc_attr($key);
                    $value = esc_attr($value);

                    $attrs[$key] = $value;
                }
            }

            $shortcode = G1_Contact_Form_Shortcode();
            $shortcode->set_contact_form_counter($data['counter']);

            $result = $shortcode->shortcode($attrs);
        }

        echo $result;
        exit;
    }

    /**
     * Registers widgets
     */
    function register_widgets() {
        register_widget( 'G1_Contact_Form_Widget' );
    }
}
function G1_Contact_Form_Module() {
    static $instance;

    if ( !isset( $instance ) )
        $instance = new G1_Contact_Form_Module();

    return $instance;
}
// Fire in the hole :)
G1_Contact_Form_Module();




class G1_Contact_Form_Shortcode extends G1_Shortcode {
    private $contact_form_counter;

    public function __construct( $id, $args = array() ) {
        parent::__construct( $id, $args );
        $this->contact_form_counter = null;

        add_action( 'g1_shortcode_generator_register', array( $this, 'add_shortcode_generator_item' ) );
    }

    public function set_contact_form_counter ( $value ) {
        if ( is_int($value) ) {
            $this->contact_form_counter = $value;
        }
    }

    /**
     * Add shortcode to the global shortcode generator
     *
     * @param       G1_Shortcode_Generator $generator
     */
    public function add_shortcode_generator_item( $generator ) {
        $generator->add_item( $this, 'misc' );
    }

    public function enqueue_scripts() {
        wp_enqueue_script('g1_contact_form', get_template_directory_uri().'/lib/g1-contact-form/js/g1-contact-form.js', array('g1_main'), true);

        $config = array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'i18n' => array(
                'error_message' => __( 'Some errors occurred. Form cannot be sent.', 'g1_theme' )
            )
        );

        wp_localize_script('g1_contact_form', 'g1_contact_form_config', json_encode($config) );
    }

    protected function load_attributes() {
        // email attribute
        $this->add_attribute( 'email', array(
            'form_control' => 'Text',
            'id_aliases' => array(
                'e-mail',
                'mail',
            ),
            'hint'		=> __( 'The recipient\'s email', 'g1_theme' ),
        ));

        // name attribute
        $this->add_attribute( 'name', array(
            'form_control' => 'Text',
            'hint'		=> __( 'The recipient\'s name', 'g1_theme' ),
        ));

        // subject attribute
        $this->add_attribute( 'subject', array(
            'form_control' => 'Text',
            'hint'		=> __( 'The subject of the email', 'g1_theme' ),
        ));

        // success attribute
        $this->add_attribute( 'success', array(
            'form_control' => 'Text',
            'hint'		=> __( 'The text to display after sending an email uccessfully', 'g1_theme' ),
            'translate' => true,
        ));

        // failure attribute
        $this->add_attribute( 'failure', array(
            'form_control' => 'Text',
            'hint'		=> __( 'The text to display, if the contact  form has errors', 'g1_theme' ),
            'translate' => true,
        ));

        // submit method
        $this->add_attribute( 'submit_method', array(
            'form_control'  => 'Choice',
            'id_aliases' => array(
                'submit',
            ),
            'choices'       => array(
                'standard'  => __( 'standard', 'g1_theme' ),
                'ajax'      => __( 'AJAX', 'g1_theme' ),
            )
        ));
    }

    /**
     * Shortcode callback function.
     *
     * @return string
     */
    protected function do_shortcode() {
        extract( $this->extract() );

        $counter = $this->contact_form_counter !== null ? $this->contact_form_counter : $this->get_counter();

        // Compose final HTML id attribute
        $final_id = strlen( $id ) ? $id : 'contact-form-counter-' . $counter;

        // Compose final HTML class attribute
        $final_class = array(
            'contact-form',
        );

        if ( strlen($class) > 0 ) {
            $final_class[] = $class;
        }

        if ( !empty($submit_method) && $submit_method === 'ajax' ) {
            $final_class[] = 'g1-ajax-submit';
        }

        add_action( 'wp_footer', array( $this, 'enqueue_scripts') );

        if ( !strlen( $email ) ) {
            $email = get_option( 'admin_email' );
        }

        if ( !strlen( $name ) ) {
            $name = get_option( 'blogname' );
        }

        if ( !strlen( $subject ) ) {
            $subject = __( 'Website Contact Form', 'g1_theme' );
        }

        if ( !strlen( $success ) ) {
            $success = __( 'We have received your email. Thank you.', 'g1_theme' );
        }

        if ( !strlen( $failure ) ) {
            $failure = __( 'Ooops, something has gone wrong.', 'g1_theme' );
        }

        $errors = array();
        $email_sent = null;

        // Captcha vars
        $captcha_n1 = rand(1, 15);
        $captcha_n2 = rand(1, 15);
        $captcha_hidden_hash = $this->encode_captcha( $captcha_n1 + $captcha_n2 );

        $field_ids = array(
            'name'          => 'contact_form_name_' . $counter,
            'email'         => 'contact_form_email_' . $counter,
            'message'       => 'contact_form_message_' . $counter,
            'captcha'       => 'contact_form_captcha_' . $counter ,
            'captcha_hash'  => 'contact_form_captcha_hash_' . $counter,
            'data'          => 'contact_form_data',
        );

        // Initialize data
        $field_name 		= '';
        $field_email 		= '';
        $field_message 		= '';
        $field_captcha		= '';

        // Check if form has been submitted
        if( isset($_POST['contact_form_submit_' . $counter]) ) {
            $form_fields = array();

            // Strip input data (remove slashes added by WP)

            foreach ( $field_ids as $id => $name ) {
                if ( isset($_POST[$name]) ) {
                    $form_fields[$id] = stripslashes_deep( $_POST[$name] );
                }
            }

            // Sanitize input data
            $field_name 		= trim( $form_fields['name'] );
            $field_email 		= trim( $form_fields['email'] );
            $field_message 		= trim( $form_fields['message'] );
            $field_captcha 		= trim( $form_fields['captcha'] );
            $field_captcha_hash	= trim( $form_fields['captcha_hash'] );

            // Validate input data
            if ( strlen( $field_name ) < 2 ) {
                $errors['name'] = true;
            }

            if ( is_email($field_email) !== $field_email ) {
                $errors['email'] = true;
            }

            if ( strlen( $field_message ) < 2 ) {
                $errors['message'] = true;
            }

            if ( $this->encode_captcha( $field_captcha ) != $field_captcha_hash ) {
                $errors['captcha'] = true;
            }

            if ( !count( $errors ) ) {
                // Send email
                $headers = 'From: ' . sanitize_mail_header( $field_name ) . ' <'. sanitize_mail_header( $field_email ) . '>' . "\r\n";
                $email_sent = wp_mail( $email, $subject, $field_message, $headers);

                // clear form fields
                $field_name = '';
                $field_email = '';
                $field_message = '';
            }
        }

        // Compose output
        $out = '';

        $out .= '<form action="' . get_permalink() . '#' . esc_attr( $final_id ) . '" method="post" id="' . esc_attr( $final_id ) . '" class="' . sanitize_html_classes( $final_class ) . '">';

        // Notification message
        if ( $email_sent === true ) {
            $out .= do_shortcode( sprintf( '[message type="%s"]%s[/message]', 'success', esc_html( $success ) ) );
        }
        elseif( $email_sent === false ) {
            $out .= do_shortcode( sprintf( '[message type="%s"]%s[/message]', 'error', esc_html( $failure ) ) );
        }

        if ( count( $errors ) ) {
            $out .= do_shortcode( sprintf( '[message type="%s"]%s[/message]', 'warning', esc_html( __( 'Please correct the errors on this form.', 'g1_theme' ) ) ) );
        }

        // Name field
        $_class = array( 'form-row' );
        $_msg = '';
        if ( isset ( $errors['name'] ) ) {
            $_class[] = 'form-row-error';
            $_msg = '<div class="form-message">' .
                        esc_html( __( 'Please enter your name', 'g1_theme' ) ) .
                    '</div>';
        }

        $out .= '<div class="' . sanitize_html_classes( $_class ) . '">' .
                    '<label for="' . esc_attr( $field_ids['name'] ) . '">' .
                        esc_html( __( 'Name', 'g1_theme' ) ) . ' ' .
                        '<em class="meta">' . __( '(required)', 'g1_theme' ) .
                        '</em>' .
                    '</label>' .
                    $_msg .
                    '<input type="text" id="' .esc_attr( $field_ids['name'] ) . '" name="' . esc_attr( $field_ids['name'] ) . '" value="' . esc_attr( $field_name ) . '" />' .
                '</div>';


        // Email field
        $_class = array( 'form-row' );
        $_msg = '';
        if ( isset ( $errors['email'] ) ) {
            $_class[] = 'form-row-error';
            $_msg = '<div class="form-message">' .
                        esc_html( __('Please enter a valid email address', 'g1_theme') ) .
                    '</div>';
        }

        $out .= '<div class="' . sanitize_html_classes( $_class ) . '">' .
                    '<label for="' . esc_attr( $field_ids['email'] ) . '">' .
                        esc_html( __( 'Email', 'g1_theme' ) ) . '  ' .
                        '<em class="meta">' . __( '(required)', 'g1_theme' ) . '</em>' .
                    '</label>' .
                    $_msg .
                    '<input type="text" id="' . esc_attr( $field_ids['email'] ) . '" name="' . esc_attr( $field_ids['email'] ) . '" value="' . esc_attr($field_email) . '" />' .
                '</div>';


        // Message field
        $_class = array( 'form-row' );
        $_msg = '';
        if ( isset ( $errors['message'] ) ) {
            $_class[] = 'form-row-error';
            $_msg = '<div class="form-message">' .
                        esc_html( __('Please leave a message', 'g1_theme') ) .
                    '</div>';
        }

        $out .= '<div class="' . sanitize_html_classes( $_class ) . '">' .
                    '<label for="' . esc_attr( $field_ids['message'] ) . '">' .
                        esc_html( __( 'Message', 'g1_theme' ) ) . ' ' .
                        '<em class="meta">' . __( '(required)', 'g1_theme' ) . '</em>' .
                    '</label>' .
                    $_msg .
                    '<textarea id="' . esc_attr( $field_ids['message'] ) . '" name="' .  esc_attr( $field_ids['message'] ) . '" rows="5" cols="5">' . esc_textarea( $field_message ) . '</textarea>' .
                '</div>';

        // Captcha field
        $_class = array( 'form-row' );
        $_msg = '';
        if ( isset ( $errors['captcha'] ) ) {
            $_class[] = 'form-row-error';
            $_msg = '<div class="form-message">' .
                        esc_html( __( 'Please enter a valid result', 'g1_theme') ) .
                    '</div>';
        }

        $out .= '<div class="' . sanitize_html_classes( $_class ) . '">' .
                    '<label for="' . esc_attr( $field_ids['captcha'] ) . '">' .
                        esc_html( $captcha_n1 . ' + ' . $captcha_n2 . ' ? ') . ' ' .
                        '<em class="meta">' . __( '(Are you human?)', 'g1_theme' ) . '</em>' .
                    '</label>' .
                    $_msg .
                    '<input type="text" class="u-2" id="' . esc_attr( $field_ids['captcha'] ) . '" name="' . esc_attr( $field_ids['captcha'] ) . '" value="" />' .
                '</div>';

        // Hidden captcha hash
        $out .= '<fieldset>' .
                    '<input type="hidden" id="' . esc_attr( $field_ids['captcha_hash'] ) . '" name="' . esc_attr( $field_ids['captcha_hash'] ) . '" value="' . esc_attr($captcha_hidden_hash) . '" />' .
                '</fieldset>';

        // Hidden config
        $encoded_data = serialize(array(
            'id'        => $id,
            'class'     => $class,
            'name'      => $name,
            'email'     => $email,
            'subject'   => $subject,
            'success'   => $success,
            'failure'   => $failure,
            'counter'   => $counter,
        ));

        $encoded_data = base64_encode($encoded_data);

        $out .= '<fieldset>' .
            '<input type="hidden" id="' . esc_attr( $field_ids['data'] ) . '" name="' . esc_attr( $field_ids['data'] ) . '" value="' . esc_attr($encoded_data) . '" />' .
            '</fieldset>';

        // Submit button
        $out .= '<div class="form-row">' .
                    '<input type="submit" name="contact_form_submit_' . esc_attr( $counter ) . '" id="contact_form_submit_' . esc_attr( $counter ) . '" value="' . __( 'Submit', 'g1_theme' ) . '" />' .
                '</div>';

        $out .= '</form>';

        return $out;
    }


    /**
     * Encodes captcha 'secret' value
     *
     * @param string $val
     * @return string
     */
    public function encode_captcha( $val ) {
        return md5( $val . '41' );
    }

}

/**
 * Quasi-singleton for our shortcode
 *
 * @return G1_Contact_Form_Shortcode
 */
function G1_Contact_Form_Shortcode() {
    static $instance;

    if ( ! isset( $instance ) )
        $instance = new G1_Contact_Form_Shortcode( 'contact_form' );


    return $instance;
}
// Fire in the hole :)
G1_Contact_Form_Shortcode();



class G1_Contact_Form_Widget extends G1_Shortcode_Widget {
    public function get_id_base() { return 'contact_form_widget'; }
    public function get_name() { return __( 'G1 Contact Form', 'g1_theme' ); }

    public function setup_shortcode() {
        $this->shortcode = G1_Contact_Form_Shortcode();
    }
}