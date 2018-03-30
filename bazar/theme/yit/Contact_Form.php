<?php
/**
 * Your Inspiration Themes
 *
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Sliders
 *
 * General structure for the sliders, portfolio and gallery pages (and other similar)
 * where you are able to add many items for each post of a custom post type.
 *
 * The logic is:
 * - each custom post type will be a general section (Sliders, Portfolios, Galleries, etc..)
 * - each post of a custom post type will be each individual element (a slider, a portfolio, a gallery, etc...)
 * - each post will contain several configurations and an array with all elements of each section,
 * all this in several custom post meta of the post
 *
 * Examples:
 * $args = array(
 *
 *     'name' => '',    // nome generale della sezione (usato nel menu e in qualche label delle pagine admin)
 *     'icon_menu' => '',  // url dell'icona da far apparire nel menu, accanto al name
 *     'settings' => array(),   // insieme di opzioni per la pagina di configurazione
 *     'settings_item' => array(),   // insieme di opzioni per la pagina di configurazione del singolo elemento
 *     'labels' => array(
 *         'item_name_sing' => ''  // nome dell'elemento singolo al singolare (slide, work, photo, etc...)
 *         'item_name_plur' => ''  // nome dell'elemento singolo al plurale (slides, works, photos, etc...)
 *     ),
 *
 * );
 *
 * $yit->getModel('cpt_unlimited')->add( 'sliders', $args = array() );
 * yit_add_unlimited_post_type( 'sliders', $args );
 *
 *
 * @since 1.0.0
 */

class YIT_Contact_Form {

    /**
     * The object of CPT_Unlimited, used to add the post type of the slider
     *
     * @var object
     * @since 1.0.0
     */
    protected $_theContactFormObj = null;

    /**
     * The html, after the text, for the links
     *
     * @since 1.0.0
     * @access public
     * @var array
     */
    public $shortcode_atts = array();

    /**
     * Actual form used for the loop
     *
     * @since 1.0.0
     * @access public
     * @var array
     */
    public $current_form = array();

    /**
     * The error messages to show
     *
     * @since 1.0.0
     * @access public
     * @var array
     */
    public $messages = array();

    /**
     * Constructor
     *
     */
    public function __construct() { }

    /**
     * Init
     *
     */
    public function init() {

        // add the post type for the contact form
        add_action( 'init', array( $this, 'add_post_type' ), 9 );
        add_action( 'admin_init', array( $this, 'createSampleContactForm' ) );

        // add the shortcode, used to show the contact form
        add_shortcode( 'contact_form', array( $this, 'contact_shortcode' ) );

        // ajax call for retrieving field option
        add_action( 'wp_ajax_add_contactform_field', array( $this, 'add_contactform_field' ) );

        // check if the form is submitted to send the email
        add_action( 'init', array( $this, '_sendEmail' ), 20 );

        // add the scripts js for the contact form
        add_action( 'wp_enqueue_scripts', array( $this, 'add_contact_scripts' ) );

        // add the custom css for the contact form
        add_action('wp_enqueue_scripts', array( $this, 'add_contact_css'));

    }

    /**
     * Add the post type
     *
     * @since 1.0.0
     */
    public function add_post_type() {
        $args = array(
            'settings' => array(
                array(
                    'name' => __( 'Receiver(s)', 'yit' ),
                    'id' => 'to',
                    'type' => 'text',
                    'std' => 'info@info.com',
                    'desc' => 'Define the emails used (separeted by comma) to receive emails.'
                ),
                array(
                    'name' => __( 'Sender Email', 'yit' ),
                    'id' => 'from',
                    'type' => 'text',
                    'std' => 'info@info.com',
                    'desc' => 'Define from what email send the message.'
                ),
                array(
                    'name' => __( 'Sender Name', 'yit' ),
                    'id' => 'from_name',
                    'type' => 'text',
                    'std' => 'Admin',
                    'desc' => 'Define the name of email that send the message.'
                ),
                array(
                    'name' => __( 'Subject', 'yit' ),
                    'id' => 'subject',
                    'type' => 'text',
                    'std' => '',
                    'desc' => 'Define the subject of the email sent to you.'
                ),
                array(
                    'name' => __( 'Body', 'yit' ),
                    'id' => 'body',
                    'type' => 'textarea',
                    'std' => '%message%  <small><i>This email is been sent by %name% (email. %email%).</i></small>',
                    'desc' => 'Define the body of the email sent to you.'
                ),
                array(
                    'name' => __( 'Submit Button Label', 'yit' ),
                    'id' => 'submit_label',
                    'type' => 'text',
                    'std' => 'Send Message',
                    'desc' => 'Define the label of submit button.'
                ),
                array(
                    'name' => __( 'Submit Button Alignment', 'yit' ),
                    'id' => 'submit_alignment',
                    'type' => 'select',
                    'options' => array( 'alignleft' => 'left', 'aligncenter' => 'center', 'alignright' => 'right'),
                    'desc' => 'Set the alignment of submit button.'
                ),
                array(
                    'name' => __( 'Success Message', 'yit' ),
                    'id' => 'success_sending',
                    'type' => 'text',
                    'std' => '<span>Email sent correctly, THANKS!</span> We will reply very soon.',
                    'desc' => 'Define the message when there is an error on send of email.'
                ),
                array(
                    'name' => __( 'Error Message', 'yit' ),
                    'id' => 'error_sending',
                    'type' => 'text',
                    'std' => '* Please fix the errors and send again the message',
                    'desc' => 'Define the message when there is an error on send of email.'
                ),
                array(
                    'name' => __( 'Enable reCaptcha', 'yit' ),
                    'id' => 'enable_captcha',
                    'type' => 'checkbox',
                    'desc' => 'Enable reCaptcha system',
                    'std' => ''
                ),
                array(
                    'name' => __( 'reCaptcha private API Key', 'yit' ),
                    'id' => 'captcha_private_key',
                    'type' => 'text',
                    'desc' => 'Insert the private api key of reCaptcha',
                    'std' => ''
                ),
                array(
                    'name' => __( 'reCaptcha public API Key', 'yit' ),
                    'id' => 'captcha_public_key',
                    'type' => 'text',
                    'desc' => 'Insert the public api key of reCaptcha',
                    'std' => ''
                ),

                array(
                    'type' => 'sep'
                ),
                array(
                    'desc' => __( 'Publish the contact form to configure it.', 'yit' ),
                    'type' => 'simple-text',
                    'only__not_saved' => true
                )
            ),
            'settings_items_file' => 'settings-contactform.php',
            'labels' => array(
                'singular_name' => __( 'Contact Form', 'yit' ),
                'plural_name' => __( 'Contact Forms', 'yit' ),
                'item_name_sing' => __( 'Form', 'yit' ),
                'item_name_plur' => __( 'Forms', 'yit' ),
            ),
            'publicly_queryable' => false,
            'icon_menu' => YIT_CORE_ASSETS_URL . '/images/menu/contact.png',
            'menu_position' => apply_filters( 'yit_contact_form_menu_position', 25 ),
        );

        // add the post type for the slider
        $this->_theContactFormObj = yit_add_unlimited_post_type( 'contactform', $args );

        // change the columns of the tables
        add_action( 'manage_contactform_posts_custom_column', array( &$this, 'custom_columns' ) );
        add_filter( 'manage_edit-contactform_columns', array( &$this, 'edit_columns' ) );
    }


    /**
     * The shortcode used to show theslider
     *
     * @since 1.0.0
     */
    public function contact_shortcode( $atts, $content = null ) {
        $atts = shortcode_atts(array(
            'name' => null,
            'action' => ''
        ), $atts);

        // don't show the slider if 'name' is empty or is 'none'
        if ( empty( $atts['name'] ) || 'none' == $atts['name'] ) return;

        // save the shortcode attributes in the global array, to get them with the ->get() method
        $this->shortcode_atts = $atts;

        return $this->module( $atts['name'],$atts['action'], false );

    }

    /**
     * Get a specific setting of the contact form
     *
     * @since 1.0.0
     */
    public function get( $setting, $post_id = false ) {
        if ( ! $post_id ) $post_id = $this->current_form;

        switch ( $setting ) {

            case 'fields':
                return array_values( yit_get_model('cpt_unlimited')->get_items( $post_id ) );

            default:
                return yit_get_model('cpt_unlimited')->get_setting( $setting, $post_id );

        }
    }

    /**
     * Stamp the form of recaptcha
     *
     * @since 1.0.0
     * @author Francesco Licandro <francesco.licandro@yithemes.it>
     */
    public function recaptcha( $echo = true ){

        if( $this->get('enable_captcha') == '1' ){

            require_once( YIT_CORE_LIB . '/vendors/recaptcha/recaptchalib.php' );

            $publickey = $this->get('captcha_public_key');

            $form = recaptcha_get_html( $publickey );

            if( $echo ){
                echo $form;
            }

            return $form;
        }
    }

    /**
     * Send the email if the form is submitted
     *
     * @since 1.0.0
     */
    public function _sendEmail()
    {
        $messages = $attachments = array();
        $qstr = '';

        if ( isset( $_POST['yit_bot'] ) && ! empty( $_POST['yit_bot'] ) )
            return;

        if ( isset( $_POST['yit_action'] ) AND ( $_POST['yit_action'] == 'sendemail' OR $_POST['yit_action'] == 'sendemail-ajax' ) AND wp_verify_nonce( $_REQUEST['_wpnonce'], 'yit-sendmail' ) )
        {
            $this->current_form = intval( $_POST['id_form'] );    // post_id

            if( $this->get('enable_captcha') == '1' ){

                require_once( YIT_CORE_LIB .'/vendors/recaptcha/recaptchalib.php');

                $privatekey = $this->get( 'captcha_private_key' );

                $resp = recaptcha_check_answer ( $privatekey,
                    $_SERVER["REMOTE_ADDR"],
                    $_POST["recaptcha_challenge_field"],
                    $_POST["recaptcha_response_field"]);

                if( ! $resp->is_valid ) {
                    $this->messages[ $this->current_form ]['general'] = '<div class="error"><p>' . $resp -> error . '</p></div>';
                    return;
                }
            }

            $fields = $this->get('fields');

            /* Check if there are a required checkbox */
            foreach( $fields as $field) {
                if( $field['type'] == 'checkbox' && $field['required'] == '1' && ! isset( $_POST['yit_contact'][ $field['data_name'] ])){
                    $_POST['yit_contact'][ $field['data_name'] ] = '';
                }
            }

            // body
            $body = nl2br( $this->get('body') );

            $yit_referer = $_POST['yit_referer'];

            $shortcodes = apply_filters( 'yit_contact_form_shortcodes', array(
                '%ipaddress%' => $_SERVER['REMOTE_ADDR'],
                '%referer%'   => $yit_referer
            ) );
            foreach ( $shortcodes as $shortcode => $val )
                $body = str_replace( $shortcode, $val, $body );

            $union_qstr = ( $qstr == '' ) ? '?' : '';

            $reply_to = $to = $from_email = $from_name ='';

            // to
            $to = apply_filters( 'yit_contact_form_email_to', $this->get('to') );

            // from
            $from_email = $this->get('from');
            $from_name  = $this->get('from_name');

            // subject
            $subject = stripslashes( $this->get('subject') );

            $post_data = array_map( 'stripslashes_deep', $_POST['yit_contact'] );
            foreach( $fields as $c => $field )
            {
                $id = $field['data_name'];

                if( $field['type'] == 'checkbox' && isset( $field['required'] ) && !isset( $post_data[$id] ) )
                { $this->messages[ $this->current_form ][$id] = stripslashes( $field['error'] ); }

                if(isset($post_data[$id]))
                    $var = $post_data[$id];

                // validate, adding message error, set up on admin panel, if var is not valid.
                if ( ( isset( $field['required'] ) AND $var == '' ) OR ( isset( $field['is_email'] ) AND !is_email( $var ) ) )
                    $this->messages[ $this->current_form ][$id] = stripslashes( $field['error'] );

                // if reply to
                if ( isset( $field['reply_to'] ) AND $field['reply_to'] == 'yes' )
                    $reply_to = $var;

                // convert \n to <br>
                if ( isset( $field['type'] ) AND $field['type'] == 'textarea' )
                    $var = nl2br( $var );

                ${$id} = $var;

                // replace tags of body config
                $body       = str_replace( "%$id%", $var, $body );
                $to         = str_replace( "%$id%", $var, $to );
                $from_email = str_replace( "%$id%", $var, $from_email );
                $from_name  = str_replace( "%$id%", $var, $from_name );
                $subject    = str_replace( "%$id%", $var, $subject );

                // add link to email, if it is ad email, for body email.
                if ( is_email( $var ) )
                    $var = '<a href="mailto:' . $var . '">' . $var . '</a>';
            }

            // sku
            if ( isset($post_data['sku']) ) {
                $body = str_replace("%sku%", $post_data['sku'], $body);
            }

            if ( isset($post_data['product_id']) ) {
                $body = str_replace("%product_id%", $post_data['product_id'], $body);
            }

            // if there are attachments
            if( isset( $_FILES['yit_contact']['tmp_name'] ) )
            {
                foreach( $_FILES['yit_contact']['tmp_name'] as $id => $a_file )
                {
                    $file = basename( $_FILES['yit_contact']['name'][$id] );
                    list( $file_name, $file_ext ) = explode( '.', $file );

                    if ( in_array( $file_ext, array( 'php', 'js', 'exe', 'sh', 'bat', 'com' ) ) ) {
                        continue;
                    }


                    $new_path = WP_CONTENT_DIR . '/uploads/' . basename( $_FILES['yit_contact']['name'][$id] );
                    move_uploaded_file( $a_file, $new_path );
                    $attachments[] = $new_path;
                }
            }

            // set content type
            add_filter( 'wp_mail_content_type', create_function( '$content_type', "return 'text/html';" ) );
            add_filter( 'wp_mail_from',         create_function( '$from', "return '$from_email';" ) );
            add_filter( 'wp_mail_from_name',    create_function( '$from', "return '$from_name';" ) );

            // if there ware some errors, return messages.
            if( !empty( $this->messages[ $this->current_form ] ) )
                return;


            // all header, that will be print with implode.
            $headers = array();

            if( $reply_to != FALSE )
                $headers[] = 'Reply-To: ' . $reply_to;

            if ( wp_mail( $to, $subject, $body, implode( "\r\n", $headers ), $attachments ) ) {
                $this->messages[ $this->current_form ]['general'] = '<div class="success"><p>' . $this->get('success_sending') . '</p></div>';
                do_action( 'yit-sendmail-success' );

            } else {
                $this->messages[ $this->current_form ]['general'] = '<p class="error">' . $this->get('error_sending') . '</p>';
            }
        }
    }

    /**
     * Generate the module
     *
     * @since 1.0.0
     */
    public function module( $name_or_id, $action, $echo = true )
    {
        global $is_footer;

        $this->current_form = is_int( $name_or_id ) ? $name_or_id : yit_post_id_from_slug( $name_or_id, 'contactform' );
        $form_name = yit_post_slug_from_id( $this->current_form );

        $general_message = $this->_generalMessage( $this->current_form, false );

        $fields = $this->get('fields');


        if( !is_array( $fields ) OR empty( $fields ) )
            return null;

        $max_width = '';
        foreach( $fields as $id => $field ) {
            preg_match( '/[\d]+/', $field['width'], $matches );

            if( $max_width < ( int ) $matches[0] )
            { $max_width = $matches[0]; }
        }

        $html = '<form id="contact-form-' . $form_name . '" class="contact-form' . ( !$is_footer ? ' row-fluid' : '' ) .'" method="post" action="'.$action.'" enctype="multipart/form-data">' . "\n\n";

        // div message feedback
        $html .= "\t<div class=\"usermessagea\">" . $general_message . "</div>\n";

        $html .= "\t<fieldset>\n\n";
        $html .= "\t\t<ul>\n\n";

        // array with all messages for js validate
        $js_messages = array();

        $current_total_width = 0; $i = 0;
        foreach( $fields as $id => $field )
        {
            // classes
            $input_class = array();   // array for print input's classes
            $li_class = array( $field['type'] . '-field' );    // array for print li's classes

            // errors
            $error_msg = '';
            $error = false;
            $js_messages[ $field['data_name'] ] = $field['error'];

            if ( isset( $field['data_name'] ) )
            {
                $error_msg = $this->_getMessage( $field['data_name'] );
                if ( ! empty( $error_msg ) ) $error = TRUE;
            }

            // li class
            if( $field['class'] != '' )
                $li_class[] = " $field[class]";

            if ( isset( $field['icon'] ) && $field['icon'] != '' )
                array_push( $li_class, 'with-icon');

            /** Clear left margin for first element */
            /*
            $current_total_width = $current_total_width + str_replace('span','',$field['width']);
            if ( $current_total_width > 12 ) {
                $current_total_width = str_replace('span','',$field['width']);
                array_push( $li_class, 'first-of-line');
            }
            */

            if( $error )
                array_push( $input_class, 'icon', 'error' );

            if ( isset( $field['icon'] ) && $field['icon'] != '' ) {
                array_push( $input_class, 'with-icon');
            }


            $html .= "\t\t\t<li class=\"" . implode( $li_class, ' ' ) . ' ' . $field['width'] . "\">\n";

            //Label
            /*
            if( $field['type'] != 'select' ) {
				if( $field['type'] != 'radio' )
        			$html .= "\t\t\t\t<label for=\"$field[data_name]-$form_name\">\n";
				else
					$html .= "\t\t\t\t<label>\n";

        		$html .= yit_string( "\t\t\t\t\t" . '<span class="mainlabel">', stripslashes_deep( $field['title'], 'highlight-text' ), '</span>' . "\n", false );
				if( isset( $field['required'] ) )
					$html .= "\t\t\t\t\t" . '<span class="required">' . __('(required)','yit') . '</span>' . "\n";
        		$html .= yit_string( "\t\t\t\t\t" . '<span class="sublabel">', stripslashes_deep( $field['description'] ), '</span>' . "\n", false );

        		$html .= "\t\t\t\t</label>\n";
            } else {
				if(isset($field['description']) || $field['description'] != '') {
					$html .= "\t\t\t\t<label>\n";
					if( isset( $field['required'] ) )
						$html .= "\t\t\t\t\t" . '<span class="required">' . __('(required)','yit') . '</span>' . "\n";
	        		$html .= yit_string( "\t\t\t\t\t" . '<span class="sublabel">', stripslashes_deep( $field['description'] ), '</span>' . "\n", false );
	        		$html .= "\t\t\t\t</label>\n";
				}
                $field['options'] = array( 'the-form-label' =>  $field['title'] ) + $field['options'];
            }
			*/

            // if required
            if( isset( $field['required'] ) AND intval( $field['required'] ) )
                $input_class[] = 'required';

            if( isset( $field['is_email'] ) AND intval( $field['is_email'] ) )
                $input_class[] = 'email-validate';



            // retrive value
            if( isset( $field['data_name'] ) && ( empty( $general_message ) || $error ) )
                $value = $this->_postValue( $field['data_name'] );
            else if ( isset( $_GET[ $field['data_name'] ] ) )
                $value = $_GET[ $field['data_name'] ];
            else
                $value = '';

            // only for clean code
            $html .= "\t\t\t\t";

            // Icon
            $html .= "<div class=\"input-prepend\">";
            if ( isset( $field['icon'] ) && $field['icon'] != '' ) {
                if( filter_var( $field['icon'], FILTER_VALIDATE_URL ) )
                { $html .= "<span class=\"add-on\"><img src=\"". $field['icon'] . "\" alt=\"\" title=\"\" /></span>"; }
                else
                { $html .= "<span class=\"add-on\"><i class=\"icon-" . $field['icon'] . "\"></i></span>"; }
            }

            // print type of input
            switch( $field['type'] )
            {
                // text
                case 'text':
                    $html .= "<input type=\"text\" name=\"yit_contact[" . $field['data_name'] . "]\" id=\"" . $field['data_name'] . "-$form_name\" class=\"" . implode( $input_class, ' ' ) . "\" value=\"$value\" placeholder=\"" . stripslashes_deep( $field['title'], 'highlight-text' ) . "\" />";
                    break;

                // hidden
                case 'hidden':
                    $html .= "<input type=\"hidden\" name=\"yit_contact[" . $field['data_name'] . "]\" id=\"" . $field['data_name'] . "-$form_name\" class=\"" . implode( $input_class, ' ' ) . "\" value=\"$value\" />";
                    break;

                // checkbox
                case 'checkbox':
                    $checked = '';

                    if( $value != '' AND $value )
                        $checked = ' checked="checked"';
                    else if( isset($field['already_checked']) && intval( $field['already_checked'] ) )
                        $checked = ' checked="checked"';

                    $html .= "<input type=\"checkbox\" name=\"yit_contact[" . $field['data_name'] . "]\" id=\"" . $field['data_name'] . "-$form_name\" value=\"1\" class=\"" . implode( $input_class, ' ' ) . "\"{$checked} />";
                    if ( isset( $field['title'] ) ) $html .= ' ' . $field['title'];
                    break;

                // select
                case 'select':
                    $html .= "<select name=\"yit_contact[" . $field['data_name'] . "]\" id=\"" . $field['data_name'] . "-$form_name\" class=\"" . implode( $input_class, ' ' ) . "\">\n";

                    // options
                    foreach( $field['options'] as $id => $option )
                    {
                        $selected = '';
                        if( isset($field['option_selected']) && $field['option_selected'] == $id )
                            $selected = ' selected="selected"';

                        if( $id === 'the-form-label' ) {
                            $html .= "\t\t\t\t\t\t<option value=\"\"$selected>$option</option>\n";
                        } else {
                            $html .= "\t\t\t\t\t\t<option value=\"$option\"$selected>$option</option>\n";
                        }
                    }

                    $html .= "\t\t\t\t\t</select>";
                    break;

                // textarea
                case 'textarea':
                    $html .= "<textarea name=\"yit_contact[" . $field['data_name'] . "]\" id=\"" . $field['data_name'] . "-$form_name\" rows=\"8\" cols=\"30\" class=\"" . implode( $input_class, ' ' ) . "\" placeholder=\"" . stripslashes_deep( $field['title'], 'highlight-text' ) . "\">$value</textarea>";
                    break;

                // radio
                case 'radio':
                    // options
                    foreach( $field['options'] as $i => $option )
                    {
                        $selected = '';
                        if( isset($field['option_selected']) && $field['option_selected'] == $i )
                            $selected = ' checked=""';

                        $html .= "\t\t\t\t\t\t<input type=\"radio\" name=\"yit_contact[{$field['data_name']}]\" id=\"{$field['data_name']}-$form_name-$i\" value=\"$option\"$selected /><label for=\"{$field['data_name']}-$form_name-$i\">$option</label>\n";
                    }
                    $html .= "\t\t\t\t<div class=\"clear\"></div>\n";
                    break;

                // password
                case 'password':
                    $html .= "<input type=\"password\" name=\"yit_contact[{$field['data_name']}]\" id=\"{$field['data_name']}-$form_name\" class=\"" . implode( $input_class, ' ' ) . "\" value=\"$value\" />";
                    break;

                // file
                case 'file':
                    $html .= "<input type=\"file\" name=\"yit_contact[{$field['data_name']}]\" id=\"{$field['data_name']}-$form_name\" class=\"" . implode( $input_class, ' ' ) . "\" />";
                    break;
            }

            // Icon
            $html .= "</div>";

            // only for clean code
            $html .= "\n";

            $html .= "\t\t\t\t<div class=\"msg-error\">" . $error_msg . "</div><div class=\"clear\"></div>\n";

            $html .= "\t\t\t</li>\n";
        }

        if ( $this->get('enable_captcha' ) == '1') {

            $html .= "<script type=\"text/javascript\">var RecaptchaOptions = {  theme : 'clean'  };</script>";
            $html .= "<li class=\"first-of-line span-12\">";
            $html .= $this->recaptcha( false );
            $html .= "</li><div class=\"clear\"></div>";
        }

        $html .= "\t\t\t<li class=\"submit-button span" . $max_width . "\">\n";
        $html .= "\t\t\t\t<input type=\"text\" name=\"yit_bot\" id=\"yit_bot\" />\n";
        $html .= "\t\t\t\t<input type=\"hidden\" name=\"yit_action\" value=\"sendemail\" id=\"yit_action\" />\n";
        $html .= "\t\t\t\t<input type=\"hidden\" name=\"yit_referer\" value=\"" . yit_curPageURL() . "\" />\n";
        $html .= "\t\t\t\t<input type=\"hidden\" name=\"id_form\" value=\"$this->current_form\" />\n";
        if ( is_shop_installed() && is_product() ) {
            $html .= "\t\t\t\t<input type=\"hidden\" name=\"yit_contact[sku]\" value=\"". $GLOBALS['product']->sku . "\" />";
            $html .= "\t\t\t\t<input type=\"hidden\" name=\"yit_contact[product_id]\" value=\"". $GLOBALS['product']->id . "\" />";
        }
        $html .= "\t\t\t\t<input type=\"submit\" name=\"yit_sendemail\" value=\"" . $this->get('submit_label') . "\" class=\"sendmail " . $this->get('submit_alignment') . "\" />";
        $html .= "\t\t\t\t" . wp_nonce_field( 'yit-sendmail', "_wpnonce", true, false );
        $html .= "\t\t\t\t<div class=\"clear\"></div>";
        $html .= "\t\t\t</li>\n";

        $html .= "\t\t</ul>\n\n";
        $html .= "\t</fieldset>\n";
        //$html .= "<div class=\"general-msg-error\">" . __('* Please fix the errors and send again the message', 'yit') . "</div>";

        $html .= "<div class=\"contact-form-error-messages\">";
        foreach( $js_messages as $id => $msg )
            if(isset($msg) && $msg != '')
                $html .= "<div class=\"contact-form-error-$id contact-form-error\">* $msg</div>\n";
        $html .= "</div>\n";

        $html .= "</form>\n\n";

        $html .= "<div class=\"clear\"></div>";

        /*
        // messages for javascript validation
        $html .= "<script type=\"text/javascript\">\n";
        $html .= "\tvar messages_form_" . $this->current_form . " = {\n";

        foreach( $js_messages as $id => $msg )
            if(isset($msg) && $msg != '')
                $html .= "\t\t$id: \"$msg\",\n";

        // remove last comma
        $html = str_replace( "\t\t$id: \"$msg\",\n", "\t\t$id: \"$msg\"\n", $html );

        $html .= "\t};\n";
        $html .= "</script>";
        */

        $html .= "<script type=\"text/javascript\" src=\"" . get_template_directory_uri() . "/theme/assets/js/contact.js\"></script>";

        if( $echo )
            echo $html;

        return $html;
    }

    /**
     * Get the value from the $_POST
     *
     * @since 1.0.0
     */
    protected function _postValue( $id )
    {
        return ( isset( $_POST['yit_contact'][$id] ) ) ? $_POST['yit_contact'][$id] : '';
    }

    /**
     * Print the messages for the panel
     *
     * @since 1.0.0
     */
    protected function _getMessage( $message, $form = false )
    {
        if ( ! $form ) $form = $this->current_form;

        if ( isset( $this->messages[$form][$message] ) )
            return $this->messages[$form][$message];
    }

    /**
     * Print the messages for the panel
     *
     * @since 1.0.0
     */
    protected function _generalMessage( $form = false, $echo = true )
    {
        if ( ! $form ) $form = $this->current_form;

        if ( ! $echo ) ob_start();

        echo $this->_getMessage( 'general', $form );

        if ( ! $echo ) return ob_get_clean();
    }

    /**
     * Add the scripts js for the contact form
     *
     * @since 1.0.0
     */
    public function add_contact_scripts() {
        global $is_IE;

        if( $is_IE ) {
            wp_enqueue_script( 'jquery-placeholder-plugin', YIT_CORE_ASSETS_URL . '/js/jquery.placeholder.js', array( 'jquery' ), '1.0', true );
        }

        wp_enqueue_script( 'contact-form-script', YIT_CORE_ASSETS_URL . '/js/contact.js', array( 'jquery', 'jquery-placeholder-plugin' ), '1.0', true );

        /* TEMP: DOESN'T WORK
         * wp_localize_script( 'contact-form-script', 'contactForm', array(
    		'wait' => __( 'wait...', 'yit' )
    	) );*/
    }

    /**
     * Add custom style
     *
     */
    public function add_contact_css() {
        $url = get_template_directory_uri() . '/theme/assets/css/contact_form.css';
        yit_wp_enqueue_style(1200,'contact_form', $url);
    }

    /* ADMIN
    ------------------------------------------------------------------------- */

    /**
     * Customize the columns in the table of all post types
     *
     * @since 1.0.0
     */
    public function custom_columns( $column ) {
        global $post;

        switch ( $column ) {
            //case "default":
            //    break;
            case "shortcode":
                if ( isset( $post->post_name ) && ! empty( $post->post_name ) ) echo '[contact_form name="' . $post->post_name . '"]';
                break;
        }

    }

    /**
     * Edit the columns in the table of all post types
     *
     * @since 1.0.0
     */
    public function edit_columns( $columns ) {
        //$columns['default'] = __( 'Set as Default', 'yit' );
        $columns['shortcode'] = __( 'Shortcode', 'yit' );

        return $columns;
    }

    /**
     * Ajax call used to retrieve contact form fields
     *
     * @since 1.0.0
     */
    public function add_contactform_field( $args = array() ) {
        extract( wp_parse_args( $args, array(
            'index'      => isset( $_POST['action'] ) && $_POST['action'] == 'add_contactform_field' && isset( $_POST['index'] )      ? intval( $_POST['index'] )      : 0,
            'post_id'    => isset( $_POST['action'] ) && $_POST['action'] == 'add_contactform_field' && isset( $_POST['post_id'] )    ? intval( $_POST['post_id'] )    : 0,
            'field_name' => isset( $_POST['action'] ) && $_POST['action'] == 'add_contactform_field' && isset( $_POST['field_name'] ) ? $_POST['field_name'] : 0,
            'die'        => true
        ) ) );

        $index++; // evita di salvare in array un valore con chiave 0, perchè viene cancellato dal sistema, durante il salvataggio

        $items = array_values( yit_get_model('cpt_unlimited')->get_items( $post_id ) );
        $value = wp_parse_args( isset( $items[$index-1] ) ? $items[$index-1] : array(), array(
            'order' => 0,
            'title' => '',
            'data_name' => '',
            'description' => '',
            'type' => 'text',
            'already_checked' => '',
            'options' => array(),
            'option_selected' => '',
            'error' => '',
            'required' => '',
            'is_email' => '',
            'reply_to' => '',
            'class' => '',
            'icon' => '',
        ) );

        $args = array(
            'name' => $field_name . '[items][' . $index . ']',
            'id' => $field_name . '_items_' . $index,
            'index' => $index,
            'value' => $value
        );
        yit_get_template( 'admin/post-type-unlimited/settings-contactform-field.php', $args );

        if ( $die ) die();
    }


    /**
     * Create a simple contact form on theme installation
     *
     * @since 1.0.0
     */
    public function createSampleContactForm() {
        if( is_admin() && ! get_option('default_contactform_created_' . YIT_THEME_NAME) ) {
            $post_meta = array(
                'to' => "yit@yopmail.com",
                "from" => "yit@yopmail.com",
                "from_name" => "Admin",
                "subject" => "",
                "body" => "Subject: %subject% Message: %message%  <small><i>This email is been sent by %name% (email. %email% phone. %phone%).</i></small>",
                "submit_label" => "Send Message",
                "submit_alignment" => "alignleft",
                "success_sending" => "Email sent correctly!",
                "error_sending" => "An error has been encountered. Please try again.",
                "items" => array(
                    array(
                        "order" => "0",
                        "title" => "Name",
                        "data_name" => "name",
                        "description" => "",
                        "type" => "text",
                        "error" => "Insert the name",
                        "required" => "1",
                        "class" => "",
                        "icon" => "",
                        "width" => "span6"
                    ),
                    array(
                        "order" => "1",
                        "title" => "Email",
                        "data_name" => "email",
                        "description" => "",
                        "type" => "text",
                        "error" => "Insert a valid email",
                        "required" => "1",
                        "is_email" => "1",
                        "reply_to" => "1",
                        "class" => "",
                        "icon" => "",
                        "width" => "span6"
                    ),
                    array(
                        "order" => "2",
                        "title" => "Phone",
                        "data_name" => "phone",
                        "description" => "",
                        "type" => "text",
                        "error" => "",
                        "class" => "",
                        "icon" => "",
                        "width" => "span6"
                    ),
                    array(
                        "order" => "3",
                        "title" => "Subject",
                        "data_name" => "subject",
                        "description" => "",
                        "type" => "text",
                        "error" => "Insert a subject",
                        "class" => "",
                        "icon" => "",
                        "width" => "span6"
                    ),
                    array(
                        "order" => "4",
                        "title" => "Message",
                        "data_name" => "message",
                        "description" => "",
                        "type" => "textarea",
                        "error" => "Insert a message",
                        "required" => "1",
                        "class" => "",
                        "icon" => "",
                        "width" => "span12"
                    )
                )
            );


            $id = wp_insert_post( array(
                'post_title'  => __( 'Contact Form', 'yit' ),
                'post_name'   => 'contact-form',
                'post_status' => 'publish',
                'post_author' => 1,
                'post_type'   => 'contactform'
            ) );
            add_post_meta( $id, '_settings_post_type', $post_meta );


            update_option( 'default_contactform_created_' . YIT_THEME_NAME, 1 );
        }
    }
}

/**
 * Return an array with all contact forms created.
 *
 * @param string $class Extra class.
 *
 * @since 1.0
 */
function yit_contact_forms() {
    $posts = yit_get_model('cpt_unlimited')->get_posts_types('contactform');
    $return = array(-1 => '');

    foreach ( $posts as $post ) {
        if( $post->post_title ) {
            $return["{$post->post_name}"] = $post->post_title;
        } else {
            $return["{$post->post_name}"] = "Contact Form ID: " . $post->post_name;
        }
    }

    return $return;
}
