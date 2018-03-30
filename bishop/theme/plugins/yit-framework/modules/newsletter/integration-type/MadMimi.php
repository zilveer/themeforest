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
 * YIT_Newsletter_MadMimi exists
 */
define( 'YIT_NEWSLETTER_MADMIMI', true );

/**
 * Perform Newsletter MadMimi init
 *
 * @class YIT_Newsletter_MadMimi
 * @package Yithemes
 * @since Version 1.0.0
 * @author Your Inspiration Themes
 */
class YIT_Newsletter_MadMimi{
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
     * Add mad mimi to integration list in newsletter plugin
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
        $types['madmimi'] = __( 'MadMimi', 'yit' );

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

        $options = array( '-1' => __( 'Select a list', 'yit' ) );

        // generate option array
        if( strcmp( $pagenow, 'post.php' ) == 0 && isset( $_REQUEST['post'] ) ){
            $post_id = intval( $_REQUEST['post'] );

            $lists = $this->get_madmimi_lists( false, $post_id );
            if( $lists !== false ){
                $options = $options + $lists;
            }
        }

        $args = array_merge(
            $args,
            array(
                'madmimi-usr' => array(
                    'label' => __( 'Mad Mimi Username', 'yit' ),
                    'desc' => __( 'The Mad Mimi username you use to log in', 'yit' ),
                    'type' => 'text',
                    'std' => '',
                    'deps'     => array(
                        'ids' => '_integration',
                        'values' => 'madmimi'
                    )
                ),
                'madmimi-apikey' => array(
                    'label' => __( 'Mad Mimi API Key', 'yit' ),
                    'desc' => __( 'The Mad Mimi API Key, used to connect wordpress to mailchimp service. If you need help to create a valid API Key, refer to this <a href="http://help.madmimi.com/where-can-i-find-my-api-key/">Tutorial</a>', 'yit' ),
                    'type' => 'text',
                    'std' => '',
                    'deps'     => array(
                        'ids' => '_integration',
                        'values' => 'madmimi'
                    )
                ),
                'madmimi-list' => array(
                    'label' => __( 'Madmimi List', 'yit' ),
                    'desc' => __( 'A valid Mad Mimi list name. You may need to save your configuration before the correct content displays. If the list is not up to date, click refresh button', 'yit' ),
                    'type' => 'select-mailchimp',
                    'std' => '-1',
                    'class'   => 'madmimi-list-refresh',
                    'button_name' => __( 'Refresh', 'yit' ),
                    'options' => $options,
                    'deps'     => array(
                        'ids' => '_integration',
                        'values' => 'madmimi'
                    )
                ),
                'madmimi-submit-label' => array(
                    'label' => __( 'Submit button label', 'yit' ),
                    'desc' => __( 'This field is not always used. Depends on the style of the form.', 'yit' ),
                    'type' => 'text',
                    'std' => 'Add Me',
                    'deps'     => array(
                        'ids' => '_integration',
                        'values' => 'madmimi'
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
        add_action( 'wp_ajax_subscribe_madmimi_user', array( $this, 'subscribe_madmimi_user' ) );
        add_action( 'wp_ajax_nopriv_subscribe_madmimi_user', array( $this, 'subscribe_madmimi_user'));
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
        add_action( 'wp_ajax_refresh_madmimi_list', array( $this, 'refresh_madmimi_list' ) );

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
            wp_enqueue_script('yit-refresh-madmimi-list', $this->plugin_url.'/assets/js/refresh-madmimi-list.js');
            wp_localize_script('yit-refresh-madmimi-list', 'madmimi_localization', array( 'url' => admin_url( 'admin-ajax.php'), 'nonce_field' => wp_create_nonce( 'yit_madmimi_refresh_list_nonce' ), 'refresh_label' => __( 'Refreshing...', 'yit' ) ) );
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
    public function subscribe_madmimi_user(){
        $post_id = $_REQUEST['yit_madmimi_newsletter_form_id'];

        $mail = $_REQUEST['yit_madmimi_newsletter_form_email'];
        $apikey = "";
        $username = "";
        $list = "";

        if( isset( $post_id ) && strcmp( $post_id, '' ) != 0 ){
            $apikey = YIT_Newsletter()->get_meta( '_madmimi-apikey', $post_id );
            $username = YIT_Newsletter()->get_meta( '_madmimi-usr', $post_id );
            $list = YIT_Newsletter()->get_meta( '_madmimi-list', $post_id );

        }

        if( isset( $mail ) && is_email( $mail ) ){
            if( isset( $list ) && strcmp( $list, '-1' ) != 0 && isset( $apikey ) && strcmp( $apikey, '' ) != 0 && isset( $username ) && strcmp( $username, '' ) != 0 && check_ajax_referer( 'yit_madmimi_newsletter_form_nonce', 'yit_madmimi_newsletter_form_nonce', false ) ){
                include_once( $this->plugin_path.'/lib/vendor/madmimi/MadMimi.class.php');

                $madmimi_wrapper = new Madmimi(
                    $username,
                    $apikey
                );

                $lists = $this->get_madmimi_lists( false, $post_id );
                $list_name = $lists[ $list ];

                $result = $madmimi_wrapper->addMembership($list_name, $mail);

                echo $result;

                _e( 'Email succesfully registered', 'yit' );
                die();
            }
            else{
                _e( 'Ops! Something went wrong', 'yit');
                die();
            }
        }
        else{
            _e( 'Ops! You have to insert a valid email', 'yit');
            die();
        }
    }

    /**
     * Refresh Madmimi List
     *
     * Refresh Madmimi list in db and return for ajax callback
     *
     * @return boolean|mixed array()
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function refresh_madmimi_list(){
        $post_id = $_REQUEST['post_id'];

        if( check_ajax_referer( 'yit_madmimi_refresh_list_nonce', 'yit_madmimi_refresh_list_nonce', false ) && isset( $post_id ) && strcmp( $post_id, '' ) != 0  ){
            echo json_encode( $this->get_madmimi_lists(true, $post_id) );
            die();
        }
        else{
            echo json_encode( false );
            die();
        }
    }

    /**
     * Get Madmimi list for the apikey set in db
     *
     * Get madmimi lists; if no apikey is set, return false. If lists are stored in a transient, return the transient.
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
    public function get_madmimi_lists($update = false, $post_id){
        $apikey = YIT_Newsletter()->get_meta('_madmimi-apikey', $post_id);
        $username = YIT_Newsletter()->get_meta('_madmimi-usr', $post_id);
        if( isset( $apikey ) && strcmp( $apikey, '' ) != 0 && isset( $username ) && strcmp( $username, '' ) != 0 ){
            if( ! $update ){
                $transient = get_transient('yit-madmimi-newsletter-list');
                if( $transient !== false ){
                    return $transient;
                }
                else{
                    return $this->set_madmimi_lists( $username, $apikey, $post_id );
                }
            }
            else{
                return $this->set_madmimi_lists( $username, $apikey, $post_id );
            }
        }
        else{
            return false;
        }
    }

    /**
     * Set Madmimi list transient and return the list
     *
     * @param $username string Madmimi user
     * @param $apikey  string Madmimi apikey
     * @param $post_id int Post id
     *
     * @return boolean|mixed array()
     * @since  1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function set_madmimi_lists($username, $apikey, $post_id){
        if( isset( $apikey ) && strcmp( $apikey, '' ) != 0 ){
            // include libraries
            include_once( $this->plugin_path.'/lib/vendor/madmimi/MadMimi.class.php' );

            // initialize mailchimp wrapper
            $madmimi_wrapper = new MadMimi(
                $username,
                $apikey
            );

            // fetch list
            $xml = $madmimi_wrapper->Lists();
            $result = new SimpleXMLElement( $xml );;

            // generate result array
            $lists = array();
            foreach( $result->list as $list ){
				$attrs = $list->attributes();
                $id = (string) $attrs['id'];
                $name = (string) $attrs['name'];
                $lists[ $id ] = $name;
            }

            // memorize result array in a transient
            set_transient('yit-madmimi-newsletter-'.$post_id.'-list', $lists, WEEK_IN_SECONDS );

            return $lists;
        }
        else{
            return false;
        }
    }
}