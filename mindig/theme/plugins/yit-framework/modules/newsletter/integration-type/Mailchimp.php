<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * @package Yithemes
 * @since   1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

/**
 * YIT_Newsletter_Mailchimp exists
 */
define( 'YIT_NEWSLETTER_MAILCHIMP', true );

/**
 * Perform Newsletter Mailchimp init
 *
 * @class YIT_Newsletter_Mailchimp
 * @package Yithemes
 * @since Version 1.0.0
 * @author Your Inspiration Themes
 */
class YIT_Newsletter_Mailchimp{
    /**
     * @var string $newsletter_post_type The post type name for the post type of all newsletter forms
     */
    public $newsletter_post_type;

    /**
     * @var string Plugin url
     */
    public $plugin_url;

    /**
     * @var string Plugin path
     */
    public $plugin_path;

    /**
     * Constructor
     *
     * Add mailchimp to integration list in newsletter plugin
     *
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function __construct( ){
        $this->newsletter_post_type = YIT_Newsletter()->newsletter_post_type;
        $this->plugin_url  = YIT_Newsletter()->plugin_url;
        $this->plugin_path = YIT_Newsletter()->plugin_path;
        // register integration type
        add_filter( 'yit-newsletter-integration-type', array( $this, 'add_integration_type' ) );
        add_filter( 'yit-newsletter-metabox', array($this, 'add_metabox_field') );

        // CUSTOM INTEGRATION TYPE HANDLING
        $this->add_form_handling();

        $this->add_admin_form_handling();
    }

    /**
     * Add Integration Type
     *
     * Add mailchimp integration to integration mode select in newsletter plugin
     *
     * @param $types
     *
     * @return mixed
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function add_integration_type( $types ){
        $types['mailchimp'] = __( 'Mailchimp', 'yit' );

        return $types;
    }

    /**
     * Add Metabox Field
     *
     * Add mailchimp specific fields to newsletter cpt metabox
     *
     * @param $args
     *
     * @return mixed
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function add_metabox_field( $args ){
        global $pagenow;
        // generate option array
        $options = array( '-1' => __( 'Select a list', 'yit' ) );

        if( strcmp( $pagenow, 'post.php' ) == 0 && isset( $_REQUEST['post'] ) ){
            $post_id = intval( $_REQUEST['post'] );

            $lists = $this->get_mailchimp_lists( false, $post_id );
            if( $lists !== false ){
                $options = array_merge($options, $lists);
            }
        }

        $args = array_merge(
            $args,
            array(
                'mailchimp-apikey' => array(
                    'label' => __( 'Mailchimp API Key', 'yit' ),
                    'desc' => __( 'The mailchimp API Key, used to connect wordpress to mailchimp service. If you need help to create a valid API Key, refer to this <a href="http://kb.mailchimp.com/article/where-can-i-find-my-api-key">Tutorial</a>', 'yit' ),
                    'type' => 'text',
                    'std' => '',
                    'deps'     => array(
                        'ids' => '_integration',
                        'values' => 'mailchimp'
                    )
                ),
                'mailchimp-list' => array(
                    'label' => __( 'Mailchimp List', 'yit' ),
                    'desc' => __( 'A valid mailchimp list name. You may need to save your configuration before the correct content displays. If the list is not up to date, click refresh button', 'yit' ),
                    'type' => 'select-mailchimp',
                    'std' => '-1',
                    'class'   => 'mailchimp-list-refresh',
                    'button_name' => __( 'Refresh', 'yit' ),
                    'options' => $options,
                    'deps'     => array(
                        'ids' => '_integration',
                        'values' => 'mailchimp'
                    )
                ),
                'mailchimp-submit-label' => array(
                    'label' => __( 'Submit button label', 'yit' ),
                    'desc' => __( 'This field is not always used. Depends on the style of the form.', 'yit' ),
                    'type' => 'text',
                    'std' => 'Add Me',
                    'deps'     => array(
                        'ids' => '_integration',
                        'values' => 'mailchimp'
                    )
                ),
            )
        );

        return $args;
    }

    /**
     * Add Form Handling
     *
     * Add the frontend form handling, if needed
     *
     * @return void
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function add_form_handling(){
        // add mailchimp subscription
        add_action( 'wp_ajax_subscribe_mailchimp_user', array( $this, 'subscribe_mailchimp_user' ) );
        add_action( 'wp_ajax_nopriv_subscribe_mailchimp_user', array( $this, 'subscribe_mailchimp_user'));
    }

    /**
     * Add Admin form handling
     *
     * Add the backend form handling formetabox, if needed
     *
     * @return void
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function add_admin_form_handling(){
        // add mailchimp lists refresh
        add_action( 'wp_ajax_refresh_mailchimp_list', array( $this, 'refresh_mailchimp_list' ) );

        // add admin-side scripts
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
    }

    /**
     * Enqueue admin script
     *
     * Enqueue backend scripts; constructor add it to admin_enqueue_scripts hook
     *
     * @return void
     * @since  1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function admin_enqueue_scripts(){
        global $pagenow;

        if( get_post_type() == $this->newsletter_post_type && ( strcmp( $pagenow, 'post.php' ) == 0 || strcmp( $pagenow, 'post-new.php' ) == 0 ) ){
            wp_enqueue_script('yit-refresh-mailchimp-list', $this->plugin_url.'/assets/js/refresh-mailchimp-list.js');
            wp_localize_script('yit-refresh-mailchimp-list', 'localization', array( 'url' => admin_url( 'admin-ajax.php'), 'nonce_field' => wp_create_nonce( 'yit_mailchimp_refresh_list_nonce' ), 'refresh_label' => __( 'Refreshing...', 'yit' ) ) );
        }
    }

    /**
     * Subscribe Mailchimp user
     *
     * Add user to a mailchinmp list posted via AJAX-Request to wp_ajax_subscribe_mailchimp_user action
     *
     * @return void
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function subscribe_mailchimp_user(){
        $post_id = $_REQUEST['yit_mailchimp_newsletter_form_id'];

        $mail = $_REQUEST['yit_mailchimp_newsletter_form_email'];
        $apikey = "";
        $list = "";

        if( isset( $post_id ) && strcmp( $post_id, '' ) != 0 ){
            $apikey = YIT_Newsletter()->get_meta( '_mailchimp-apikey', $post_id );
            $list = YIT_Newsletter()->get_meta( '_mailchimp-list', $post_id );
        }

        if( isset( $mail ) && is_email( $mail ) ){
            if( isset( $list ) && strcmp( $list, '-1' ) != 0 && isset( $apikey ) && strcmp( $apikey, '' ) != 0 && check_ajax_referer( 'yit_mailchimp_newsletter_form_nonce', 'yit_mailchimp_newsletter_form_nonce', false ) ){
                if( ! class_exists( 'Mailchimp' ) ) {
                    include_once( $this->plugin_path . '/lib/vendor/mailchimp/Mailchimp.php' );
                }

                $mailchimp_wrapper = new Mailchimp(
                    $apikey,
                    array(
                        'ssl_verifypeer' => false
                    )
                );

                $result = $mailchimp_wrapper->call(
                    'lists/batch-subscribe',
                    array(
                        'apikey' => $apikey,
                        'id' => $list,
                        'batch' => array(
                            array(
                                'email' => array(
                                    'email' => $mail,
                                    'email_type' => 'html'
                                )
                            )
                        ),
                        'double_optin' => true,
                    )
                );

                if($result['error_count'] != 0){
                    $message = 'Something went wrong:';
                    $message .= '<ul>';

                    foreach($result['errors'] as $error){
                        $code = $error['code'];
                        $message .= '<li>';

                        $error_message = '';

                        if( $code <= 0 ){
                            $error_message = __( 'Mailchimp server error', 'yit' );
                        }
                        elseif($code >= 100 && $code < 120 ){
                            $error_message = __( 'Mailchimp user related error', 'yit' );
                        }
                        elseif($code >= 120 && $code < 200 ){
                            $error_message = __( 'Mailchimp user related error (action)', 'yit' );
                        }
                        elseif($code >= 200 && $code < 210 ){
                            $error_message = __( 'Mailchimp list related error', 'yit' );
                        }
                        elseif($code >= 210 && $code < 213 ){
                            $error_message = __( 'Mailchimp list related error (basic action)', 'yit' );
                        }
                        elseif($code >= 214 && $code < 220 ){
                            $error_message = __( 'Mailchimp: This e-mail address is already subscribed to our list.', 'yit' );
                        }
                        elseif($code >= 220 && $code < 230 ){
                            $error_message = __( 'Mailchimp list related error (import)', 'yit' );
                        }
                        elseif($code == 230 ){
                            $error_message = __( 'Mailchimp: This email is already subscribed', 'yit' );
                        }
                        elseif($code == 231 ){
                            $error_message = __( 'Mailchimp: This email is already unsubscribed', 'yit' );
                        }
                        elseif($code == 232 ){
                            $error_message = __( 'Mailchimp: This email not exists', 'yit' );
                        }
                        elseif($code == 233 ){
                            $error_message = __( 'Mailchimp: This email is not subscribed', 'yit' );
                        }
                        elseif($code >= 234 && $code < 250 ){
                            $error_message = __( 'Mailchimp list related error (email)', 'yit' );
                        }
                        elseif($code >= 250 && $code < 270 ){
                            $error_message = __( 'Mailchimp list related error (merge)', 'yit' );
                        }
                        elseif($code >= 270 && $code < 300 ){
                            $error_message = __( 'Mailchimp list related error (interest group)', 'yit' );
                        }
                        elseif($code == 502 ){
                            $error_message = __( 'Mailchimp: This email is not valid', 'yit' );
                        }
                        else{
                            $error_message = __( 'Mailchimp general error', 'yit' );
                        }

                        $message .= apply_filters( 'yit_newsletter_error_message', $error_message, $code );

                        $message .= '</li>';
                    }

                    $message .= '</ul>';

                    echo $message;
                }
                else{
                    echo apply_filters( 'yit_newsletter_success_message', __( 'Email succesfully registered', 'yit' ) );
                }
                die();
            }
            else{
                echo apply_filters( 'yit_newsletter_general_error_message', __( 'Ops! Something went wrong', 'yit') );
                die();
            }
        }
        else{
            echo apply_filters( 'yit_newsletter_wrong_email_address', __( 'Ops! You have to insert a valid email', 'yit') );
            die();
        }
    }

    /**
     * Refresh Mailchimp List
     *
     * Refresh Mailchimp list in db and return for ajax callback
     *
     * @return boolean|mixed array()
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function refresh_mailchimp_list(){
        $post_id = $_REQUEST['post_id'];

        if( check_ajax_referer( 'yit_mailchimp_refresh_list_nonce', 'yit_mailchimp_refresh_list_nonce', false ) && isset( $post_id ) && strcmp( $post_id, '' ) != 0  ){
            echo json_encode( $this->get_mailchimp_lists(true, $post_id) );
            die();
        }
        else{
            echo json_encode( false );
            die();
        }
    }

    /**
     * Get Mailchimp list for the apikey set in db
     *
     * Get mailchimp lists; if no apikey is set, return false. If lists are stored in a transient, return the transient.
     * If no transient is set for lists, get the list from mailchimp server, store the transient and return the list.
     * If update is set, force the update of the list and of the transient
     *
     * @param boolean $update Whether to update list or no. Default false
     * @param int $post_id Post id
     *
     * @return boolean|mixed array()
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function get_mailchimp_lists($update = false, $post_id){
        $apikey = YIT_Newsletter()->get_meta('_mailchimp-apikey', $post_id);
        if( isset( $apikey ) && strcmp( $apikey, '' ) != 0 ){
            if( ! $update ){
                $transient = get_transient('yit-mailchimp-newsletter-list');
                if( $transient !== false ){
                    return $transient;
                }
                else{
                    return $this->set_mailchimp_lists( $apikey, $post_id );
                }
            }
            else{
                return $this->set_mailchimp_lists( $apikey, $post_id );
            }
        }
        else{
            return false;
        }
    }

    /**
     * Set Mailchimp list transient and return the list
     *
     * @param $apikey string Mailchimp apikey
     * @param $post_id int Post id
     *
     * @return boolean|mixed array()
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function set_mailchimp_lists($apikey, $post_id){
        if( isset( $apikey ) && strcmp( $apikey, '' ) != 0 ){
            // include libraries
            if( ! class_exists( 'Mailchimp' ) ) {
                include_once( $this->plugin_path . '/lib/vendor/mailchimp/Mailchimp.php' );
            }

            // initialize mailchimp wrapper
            $mailchimp_wrapper = new Mailchimp(
                $apikey,
                array(
                    'ssl_verifypeer' => false
                )
            );

            // fetch list
            $result = $mailchimp_wrapper->call(
                'lists/list',
                array(
                    'apikey' => $apikey,
                )
            );

            // generate result array
            $lists = array();
            if( ! empty( $result ) && isset( $result['total'] ) && $result['total'] > 0 ){
                foreach( $result['data'] as $list ){
                    $lists[ $list['id'] ] = $list['name'];
                }
            }

            // memorize result array in a transient
            set_transient('yit-mailchimp-newsletter-'.$post_id.'-list', $lists, WEEK_IN_SECONDS );

            return $lists;
        }
        else{
            return false;
        }
    }
}